<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use PayPal\Api\Amount;
use PayPal\Api\Item;
use PayPal\Api\WebProfile;
use PayPal\Api\ItemList;
use PayPal\Api\InputFields;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Rest\ApiContext;
use App\Accountsetting;
use Redirect;
use Session;
use App\Stem;
use URL;
use App\Order;
use Str;
use App\Order_Item;
use Auth;
use Config;
use App\VerifyUser;
use Cart;
use Mail; 
use App\Song;
use App\Packege;
use App\User;
use App\Packege_Payment;
use Illuminate\Http\Request as RequestVar;
use Request;
class PaymentController extends Controller
{
    private $apiContext;
    private $apiContextSeller;
    public function __construct()
    {
        # Main configuration in constructor
        $paypalConfig = config('paypal');

        
        $this->apiContextSeller = "";
        
        $this->apiContext = new ApiContext(new OAuthTokenCredential(
                $paypalConfig['client_id'],
                $paypalConfig['secret'])
        );
        $this->apiContext->setConfig($paypalConfig['settings']);
    }
    
    public function payWithpaypal(RequestVar $request)
    {

        Validator::make($request->all(), [
        'firstname' => 'required',
        'lastname' => 'required',
        'phone' => 'required',
        'email' => 'required',
        'address' => 'required',
        
        
      ])->validate();

        $carttotal = Cart::getTotal();
        $order = new Order();
        $order->unique_key = Str::random(12);
        $order->Address = $request->address;
        $order->email = $request->email;
        $order->phone=$request->phone;
        $order->total =$carttotal;
        $order->save();
        # We initialize the payer object and set the payment method to PayPal
        $payer = new Payer();
        $payer->setPaymentMethod('paypal');

        
        # We need to update the order if the payment is complete, so we save it to the session
       Session::put('orderId', $order->getKey());
       Session::put('orderkey', $order->unique_key);
       Session::put('email',$request->email);

        # We get all the items from the cart and parse the array into the Item object
        $items = [];

        foreach (Cart::getContent() as $item) {

            $itemid=$item->id;

            $items[] = (new Item())
                ->setName($item->name)
                ->setCurrency('USD')
                ->setQuantity(1)
                ->setPrice((int)$item->price);
        }

        $getbeatsuser = Accountsetting::join('users','users.id','=','accountsettings.user_id')->join('beats','beats.user_id','=','users.id')->Where('beats.id',$itemid)->first();
        $getsongsuser = Accountsetting::join('users','users.id','=','accountsettings.user_id')->join('songs','songs.user_id','=','users.id')->Where('songs.id',$itemid)->first();
         $getstemsuser = Accountsetting::join('users','users.id','=','accountsettings.user_id')->join('stems','stems.user_id','=','users.id')->Where('stems.id',$itemid)->first();

       
        if (!$getbeatsuser && !$getsongsuser && !$getstemsuser) {
             return redirect('cart')->with('error','User not exist');
        }
        if(!empty($getbeatsuser)){
            $clientid = $getbeatsuser->PAYPAL_LIVE_API_CLIENT_ID;
            $clientsecret = $getbeatsuser->PAYPAL_LIVE_API_SECRET;
        }else if(!empty($getsongsuser)){
            $clientid = $getsongsuser->PAYPAL_LIVE_API_CLIENT_ID;
            $clientsecret = $getsongsuser->PAYPAL_LIVE_API_SECRET;
         }else{
            $clientid =  $getstemsuser->PAYPAL_LIVE_API_CLIENT_ID;
            $clientsecret =  $getstemsuser->PAYPAL_LIVE_API_SECRET;
        }
        
        $paypalsetting = config('paypal');
        $settings = $paypalsetting['settings'];
        $paypalSellerConfig = ['client_id'=>$clientid,'client_secret'=>$clientsecret, 'settings'=>$settings];
        $this->apiContextSeller = new ApiContext(new OAuthTokenCredential(
               $paypalSellerConfig['client_id'],
                $paypalSellerConfig['client_secret'])
        );
        $this->apiContextSeller->setConfig($paypalSellerConfig['settings']);
        # We create a new item list and assign the items to it
        $itemList = new ItemList();
        $itemList->setItems($items);

        # Disable all irrelevant PayPal aspects in payment
        $inputFields = new InputFields();
        $inputFields->setAllowNote(true)
            ->setNoShipping(1)
            ->setAddressOverride(0);

        $webProfile = new WebProfile();
        $webProfile->setName(uniqid())
            ->setInputFields($inputFields)
            ->setTemporary(true);

        $createProfile = $webProfile->create($this->apiContextSeller);
        
        # We get the total price of the cart
        $amount = new Amount();
        $amount->setCurrency('USD')
            ->setTotal((int)$carttotal);

        $transaction = new Transaction();
        $transaction->setAmount($amount);
        $transaction->setItemList($itemList)
            ->setDescription('Your transaction description');

        $redirectURLs = new RedirectUrls();
        $redirectURLs->setReturnUrl(URL::to('status'))
            ->setCancelUrl(URL::to('status'));

        $payment = new Payment();
        $payment->setIntent('Sale')
            ->setPayer($payer)
            ->setRedirectUrls($redirectURLs)
            ->setTransactions(array($transaction));

        $payment->setExperienceProfileId($createProfile->getId());

        $payment->create($this->apiContext);

        foreach ($payment->getLinks() as $link) {
            if ($link->getRel() == 'approval_url') {
                $redirectURL = $link->getHref();
                break;
            }
        }

        # We store the payment ID into the session
        Session::put('paypalPaymentId', $payment->getId());

        if (isset($redirectURL)) {
            return Redirect::away($redirectURL);
        }

        Session::put('error', 'There was a problem processing your payment. Please contact support.');

        return Redirect::to('categories');
    }

    public function getPaymentStatus()
    {
        $paymentId = Session::get('paypalPaymentId');

         $orderId = Session::get('orderId');

        # We now erase the payment ID from the session to avoid fraud
       

        # If the payer ID or token isn't set, there was a corrupt response and instantly abort
        if (empty(Request::get('PayerID')) || empty(Request::get('token'))) {
            Session()->put('error', 'There was a problem processing your payment. Please contact support.');
            return Redirect::to('categories');
        }

        $payment = Payment::get($paymentId, $this->apiContext);
        $execution = new PaymentExecution();
        $execution->setPayerId(Request::get('PayerID'));

        $result = $payment->execute($execution, $this->apiContext);

        // # Payment is processing but may still fail due e.g to insufficient funds
         $order = Order::find($orderId);
         $order->status = 'processing';

        if ($result->getState() == 'approved') {
                    
            $items = Cart::getContent();

            $order=Order::all();
            foreach(Cart::getContent() as $item ){
                $orderItem = new Order_item();
                $orderItem->order_id=$orderId;
                $orderItem->payment_id=$paymentId;
                $orderItem->item_id=$item->id;
                $orderItem->Qty=1;
                $orderItem->price= $result->transactions[0]->getAmount()->getTotal();
                $orderItem->subtotal=Cart::getSubTotal();
                $orderItem->save();
               $uniqueOrderKey = Session::get('orderkey');
               $getZip  =Stem::find($item->attributes->stem_id);
               if( $getZip){
                Mail::send(array(),array(),function($message) use($getZip) {
                        $message->to(Session::get('email'), "Test")
                        ->from('no-reply@beatbyte.co')
                        ->subject("Download Link")
                        ->attach($getZip->zipfile);
                    });
               }
                try{
                    $songfile = Song::find($item->id);
                    Mail::send('frontend.emailview',['pagelink'=>'http://beatbyte.co/mysongs', 'unique'=>$uniqueOrderKey],function($message) {
                        $message->to(Session::get('email'), "Test")
                        ->from('no-reply@beatbyte.co')
                        ->subject("Download Link");
                        
                    });
                }catch(JWTException $exception){
                    $serverstatuscode = "0";
                    $serverstatusdes = $exception->getMessage();
                }
                
            }
             Session::forget('paypalPaymentId');
            Session::forget('email');
            Cart::clear();

            

            return Redirect::to('cart')->with('success','Your payment was successful.A Download Link Has Been Sent To Your Email. Thank you.');
        }

        Session::put('error', 'There was a problem processing your payment. Please contact support.');

        return Redirect::to('/');
    }

  
    public function EmailView()
    {
        return view('frontend.emailview');
    }
    public function PackegePayment(RequestVar $request,$id)
    {
        Validator::make($request->all(), [ 
            'username' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed','required_with:password_confirmed'],
        ])->validate();
        
        $checkoutpkg = Packege::find($id);
        $items = [];
        $payer = new Payer();
        $payer->setPaymentMethod('paypal');

        $items[] = (new Item())
                ->setName($checkoutpkg->packege_name)
                ->setCurrency('USD')
                ->setQuantity(1)
                ->setPrice((int)$checkoutpkg->packege_price);
       $itemList = new ItemList();
        $itemList->setItems($items);

        # Disable all irrelevant PayPal aspects in payment
        $inputFields = new InputFields();
        $inputFields->setAllowNote(true)
            ->setNoShipping(1)
            ->setAddressOverride(0);

        $webProfile = new WebProfile();
        $webProfile->setName(uniqid())
            ->setInputFields($inputFields)
            ->setTemporary(true);

        $createProfile = $webProfile->create($this->apiContext);

        # We get the total price of the cart
        $amount = new Amount();
        $amount->setCurrency('USD')
            ->setTotal((int)$checkoutpkg->packege_price);

        $transaction = new Transaction();
        $transaction->setAmount($amount);
        $transaction->setItemList($itemList)
            ->setDescription('Your transaction description');

        $redirectURLs = new RedirectUrls();
        $redirectURLs->setReturnUrl(URL::to('paymentstatus'))
            ->setCancelUrl(URL::to('paymentstatus'));

        $payment = new Payment();
        $payment->setIntent('Sale')
            ->setPayer($payer)
            ->setRedirectUrls($redirectURLs)
            ->setTransactions(array($transaction));

        $payment->setExperienceProfileId($createProfile->getId());

        $payment->create($this->apiContext);

        foreach ($payment->getLinks() as $link) {
            if ($link->getRel() == 'approval_url') {
                $redirectURL = $link->getHref();
                break;
            }
        }

        # We store the payment ID into the session
        $unquekey = Str::random(12);
         Session::put('request',$request->all());
        Session::put('email',$request->email);
        Session::put('key',$unquekey);
        Session::put('pkgid',$checkoutpkg->id);
        Session::put('paypalPaymentId', $payment->getId());

        if (isset($redirectURL)) {
            return Redirect::away($redirectURL);
        }

        Session::put('error', 'There was a problem processing your payment. Please contact support.');

        return Redirect::to('categories');
    }
    public function PaymentStatus()
    {
        $paymentId = Session::get('paypalPaymentId');

        # We now erase the payment ID from the session to avoid fraud
        

        # If the payer ID or token isn't set, there was a corrupt response and instantly abort
        if (empty(Request::get('PayerID')) || empty(Request::get('token'))) {
            Session()->put('error', 'There was a problem processing your payment. Please contact support.');
            return Redirect::to('categories');
        }

        $payment = Payment::get($paymentId, $this->apiContext);
        $execution = new PaymentExecution();
        $execution->setPayerId(Request::get('PayerID'));

        $result = $payment->execute($execution, $this->apiContext);

        // # Payment is processing but may still fail due e.g to insufficient funds

        if ($result->getState() == 'approved') {
             $userregister = new User();
            $alluserdata = Session::get('request');
            $userregister->name = $alluserdata['username'];
            $userregister->email = $alluserdata['email'];
            $userregister->password = bcrypt($alluserdata['password']);
            $userregister->save(); 
            $userregister->attachRole(2);      
            $packegepayment = new Packege_Payment;
            $packegepayment->packege_id = Session::get('pkgid');
            $packegepayment->payment_id = $paymentId;
            $packegepayment->user_id  =$userregister->id;
            $packegepayment->unique_key = Session::get('key');
            $packegepayment->email =Session::get('email');
            $packegepayment->flag=0;
            $mytime = Carbon::now();
            $packegepayment->expires_on = $mytime->addDays(30);
            $packegepayment->save();
            
            Session::forget('paypalPaymentId');
            $toeknname = sha1(time());
            $verifyUser = VerifyUser::create([
            'user_id' => $userregister->id,
            
            'token' => $toeknname,
            ]);
            $paiduser = User::find($userregister->id);
            $paiduser->is_paid = 1;
            $paiduser->update();
             $pageurl = 'http://beatbyte.co/user/verify/'.$toeknname;
                try{
                  
                   Mail::send('emails.paiduseremail',['pagelink'=>'http://beatbyte.co/user/verify/', 'token'=>$toeknname],function($message) {
                        $message->to(Session::get('email'), "Test")
                        ->from('gulraizazam0@gmail.com')
                        ->subject("Email Verification");
                        
                        
                    });
                }catch(JWTException $exception){
                    $serverstatuscode = "0";
                    $serverstatusdes = $exception->getMessage();
                }
                
            }
            
            Session::forget('key');
            Session::forget('email');
            Session::forget('pkgid');
            

            return Redirect::to('login')->with('success','Your payment was successful.Email Activation Link Has Been Sent To Your Email. Thank you.');
        

       
        return Redirect::to('login')->with('error','There was a problem processing your payment. Please contact support.');
    }
    public function UpdgradationEMail()
    {
        return view('frontend.upgradationemail');
    }
    public function UpgradePackege(RequestVar $request,$id)
    {
       
        $checkoutpkg = Packege::find($request->packege_id);

        $items = [];

        $payer = new Payer();
        $payer->setPaymentMethod('paypal');
        if($request->packegeprice == 90){
            Session::put('pkg_price', $request->packegeprice);  
             $items[] = (new Item())
                ->setName($request->packege_name)
                ->setCurrency('USD')
                ->setQuantity(1)
                ->setPrice(90);
        }else{
            $items[] = (new Item())
                ->setName($checkoutpkg->packege_name)
                ->setCurrency('USD')
                ->setQuantity(1)
                ->setPrice((int)$checkoutpkg->packege_price);
        }
        
              
       $itemList = new ItemList();
        $itemList->setItems($items);

        # Disable all irrelevant PayPal aspects in payment
        $inputFields = new InputFields();
        $inputFields->setAllowNote(true)
            ->setNoShipping(1)
            ->setAddressOverride(0);

        $webProfile = new WebProfile();
        $webProfile->setName(uniqid())
            ->setInputFields($inputFields)
            ->setTemporary(true);

        $createProfile = $webProfile->create($this->apiContext);

        # We get the total price of the cart
        if($request->packegeprice == 90){
            $amount = new Amount();
            $amount->setCurrency('USD')
            ->setTotal(90);
        }else{
            $amount = new Amount();
            $amount->setCurrency('USD')
            ->setTotal((int)$checkoutpkg->packege_price);
        }
        

        $transaction = new Transaction();
        $transaction->setAmount($amount);
        $transaction->setItemList($itemList)
            ->setDescription('Your transaction description');

        $redirectURLs = new RedirectUrls();
        $redirectURLs->setReturnUrl(URL::to('packegepaymentstatus'))
            ->setCancelUrl(URL::to('packegepaymentstatus'));

        $payment = new Payment();
        $payment->setIntent('Sale')
            ->setPayer($payer)
            ->setRedirectUrls($redirectURLs)
            ->setTransactions(array($transaction));

        $payment->setExperienceProfileId($createProfile->getId());

        $payment->create($this->apiContext);

        foreach ($payment->getLinks() as $link) {
            if ($link->getRel() == 'approval_url') {
                $redirectURL = $link->getHref();
                break;
            }
        }

        # We store the payment ID into the session
        $unquekey = Str::random(12);
         
        Session::put('key',$unquekey);
        Session::put('pkgid',$checkoutpkg->id);
        
        
        Session::put('paypalPaymentId', $payment->getId());

        if (isset($redirectURL)) {
            return Redirect::away($redirectURL);
        }

        Session::put('error', 'There was a problem processing your payment. Please contact support.');

        return Redirect::to('categories');
    }
    public function PackegePaymentStatus()
    {
         $user = Auth::user()->id;
        $paymentId = Session::get('paypalPaymentId');

        # We now erase the payment ID from the session to avoid fraud
       

        # If the payer ID or token isn't set, there was a corrupt response and instantly abort
        if (empty(Request::get('PayerID')) || empty(Request::get('token'))) {
            Session()->put('error', 'There was a problem processing your payment. Please contact support.');
            return Redirect::to('categories');
        }

        $payment = Payment::get($paymentId, $this->apiContext);
        $execution = new PaymentExecution();
        $execution->setPayerId(Request::get('PayerID'));

        $result = $payment->execute($execution, $this->apiContext);

        // # Payment is processing but may still fail due e.g to insufficient funds

        if ($result->getState() == 'approved') {
            $userregister =User::find($user);
            $userregister->is_paid = 1;
            $userregister->update();
            Session::put('email',$userregister->email);
                 
            $packegepayment = new Packege_Payment;
            $packegepayment->packege_id = Session::get('pkgid');
            $packegepayment->user_id  =$userregister->id;
             $packegepayment->payment_id = $paymentId;
            $packegepayment->unique_key = Session::get('key');
            $packegepayment->email =$userregister->email;
            $packegepayment->flag=0;
            $mytime = Carbon::now();
            
            if(Session::get('pkg_price') == 90){
               
                $mytime = Carbon::now();
                $packegepayment->expires_on = $mytime->addDays(365);
            }else{
                $packegepayment->expires_on = $mytime->addDays(30);
            }
            
            
            $packegepayment->save();
            
            
                try{
                  
                   Mail::send('frontend.upgradationemail',array(),function($message) {
                        $message->to(Session::get('email'), "Test")
                        ->from('gulraizazam0@gmail.com')
                        ->subject("Email Verification");
                        
                        
                    });
                }catch(JWTException $exception){
                    $serverstatuscode = "0";
                    $serverstatusdes = $exception->getMessage();
                }
                
            }
             Session::forget('paypalPaymentId');
            Session::forget('key');
            Session::forget('email');
            Session::forget('pkgid');
            Session::forget('pkg_price');
            

            return Redirect::to('dashboard')->with('success','Your payment was successful.Confirmation Email Has Been Sent To Your Email. Thank you.');
        

       
        return Redirect::to('login')->with('error','There was a problem processing your payment. Please contact support.');
    }
     public function UpgradeExistingPackege($id)
    {
        
        $checkoutpkg = Packege::join('packege_paymets','packeges.id','=','packege_paymets.packege_id')->join('users','users.id','=','packege_paymets.user_id')->where('packeges.id',$id)->get();
       
        $items = [];
        $payer = new Payer();
        $payer->setPaymentMethod('paypal');
        foreach ($checkoutpkg as $item) {
        $items[] = (new Item())
                ->setName( $item->packege_name)
                ->setCurrency('USD')
                ->setQuantity(1)
                ->setPrice((int) $item->packege_price);
            }
       $itemList = new ItemList();
        $itemList->setItems($items);

        # Disable all irrelevant PayPal aspects in payment
        $inputFields = new InputFields();
        $inputFields->setAllowNote(true)
            ->setNoShipping(1)
            ->setAddressOverride(0);

        $webProfile = new WebProfile();
        $webProfile->setName(uniqid())
            ->setInputFields($inputFields)
            ->setTemporary(true);

        $createProfile = $webProfile->create($this->apiContext);

        # We get the total price of the cart
        $amount = new Amount();
        $amount->setCurrency('USD')
            ->setTotal((int)$items->packege_price);

        $transaction = new Transaction();
        $transaction->setAmount($amount);
        $transaction->setItemList($itemList)
            ->setDescription('Your transaction description');

        $redirectURLs = new RedirectUrls();
        $redirectURLs->setReturnUrl(URL::to('upgradepaymentstatus/'.$checkoutpkg->id))
            ->setCancelUrl(URL::to('upgradepaymentstatus/'.$checkoutpkg->id));

        $payment = new Payment();
        $payment->setIntent('Sale')
            ->setPayer($payer)
            ->setRedirectUrls($redirectURLs)
            ->setTransactions(array($transaction));

        $payment->setExperienceProfileId($createProfile->getId());

        $payment->create($this->apiContext);

        foreach ($payment->getLinks() as $link) {
            if ($link->getRel() == 'approval_url') {
                $redirectURL = $link->getHref();
                break;
            }
        }

        # We store the payment ID into the session
        $unquekey = Str::random(12);
         
        Session::put('key',$unquekey);
        Session::put('pkgid',$checkoutpkg->id);
        Session::put('paypalPaymentId', $payment->getId());

        if (isset($redirectURL)) {
            return Redirect::away($redirectURL);
        }

        Session::put('error', 'There was a problem processing your payment. Please contact support.');

        return Redirect::to('categories');
    }
     public function UpgradePaymentStatus($id)
    {
        
        $paymentId = Session::get('paypalPaymentId');

        # We now erase the payment ID from the session to avoid fraud
        Session::forget('paypalPaymentId');

        # If the payer ID or token isn't set, there was a corrupt response and instantly abort
        if (empty(Request::get('PayerID')) || empty(Request::get('token'))) {
            Session()->put('error', 'There was a problem processing your payment. Please contact support.');
            return Redirect::to('categories');
        }

        $payment = Payment::get($paymentId, $this->apiContext);
        $execution = new PaymentExecution();
        $execution->setPayerId(Request::get('PayerID'));

        $result = $payment->execute($execution, $this->apiContext);

        // # Payment is processing but may still fail due e.g to insufficient funds

        if ($result->getState() == 'approved') {
            $userregister =User::find($user);
            $userregister->is_paid = 1;
            $userregister->update();
            Session::put('email',$userregister->email);
                 
            $packegepayment = Packege_Payment::find($id);
            $packegepayment->expires_on = '30-3-2222';
            $packegepayment->update();
            
            $toeknname = sha1(time());
            
             $pageurl = 'http://beatbyte.co/user/verify/'.$toeknname;
                try{
                  
                   Mail::send(array(),array(),function($message) {
                        $message->to(Session::get('email'), "Test")
                        ->from('gulraizazam0@gmail.com')
                        ->subject("Email Verification");
                        
                        
                    });
                }catch(JWTException $exception){
                    $serverstatuscode = "0";
                    $serverstatusdes = $exception->getMessage();
                }
                
            }
            
            Session::forget('key');
            Session::forget('email');
            Session::forget('pkgid');
            

            return Redirect::to('dashboard')->with('success','Your payment was successful.Confirmation Email Has Been Sent To Your Email. Thank you.');
        

       
        return Redirect::to('login')->with('error','There was a problem processing your payment. Please contact support.');
    }
     public function GetPakegeDetail($expiry,$token)
    {
        $getuser = User::join('verify_users','users.id','=','verify_users.user_id')->join('packege_paymets','packege_paymets.user_id','=','users.id')->join('packeges','packeges.id','=','packege_paymets.packege_id')->select('users.id as userid','packeges.packege_price','users.email as useremail','packege_paymets.packege_id')->first();
        
         Auth::loginUsingId($getuser->userid);
        return redirect()->route(
            'renewpkg', [$getuser->packege_id,$getuser->userid],
        );
         
    }
    public function RenewPackege($pkgid,$userid){
        

        $packegedetail = User::join('packege_paymets','packege_paymets.user_id','=','users.id')->where('packege_paymets.user_id',$userid)->join('packeges','packeges.id','=','packege_paymets.packege_id')->select('packege_paymets.id as pkgid','users.id as userid','users.email','packeges.packege_price','packeges.packege_name')->first();
       
              $items = [];
        $payer = new Payer();
        $payer->setPaymentMethod('paypal');
        
        $items[] = (new Item())
                ->setName( $packegedetail->packege_name)
                ->setCurrency('USD')
                ->setQuantity(1)
                ->setPrice((int) $packegedetail->packege_price);
            
       $itemList = new ItemList();
        $itemList->setItems($items);

        # Disable all irrelevant PayPal aspects in payment
        $inputFields = new InputFields();
        $inputFields->setAllowNote(true)
            ->setNoShipping(1)
            ->setAddressOverride(0);

        $webProfile = new WebProfile();
        $webProfile->setName(uniqid())
            ->setInputFields($inputFields)
            ->setTemporary(true);

        $createProfile = $webProfile->create($this->apiContext);

        # We get the total price of the cart
        $amount = new Amount();
        $amount->setCurrency('USD')
            ->setTotal((int)$packegedetail->packege_price);

        $transaction = new Transaction();
        $transaction->setAmount($amount);
        $transaction->setItemList($itemList)
            ->setDescription('Your transaction description');

        $redirectURLs = new RedirectUrls();
        $redirectURLs->setReturnUrl(URL::to('renewpaymentstatus'))
            ->setCancelUrl(URL::to('renewpaymentstatus'));

        $payment = new Payment();
        $payment->setIntent('Sale')
            ->setPayer($payer)
            ->setRedirectUrls($redirectURLs)
            ->setTransactions(array($transaction));

        $payment->setExperienceProfileId($createProfile->getId());

        $payment->create($this->apiContext);

        foreach ($payment->getLinks() as $link) {
            if ($link->getRel() == 'approval_url') {
                $redirectURL = $link->getHref();
                break;
            }
        }

        # We store the payment ID into the session
        $unquekey = Str::random(12);
         
        Session::put('key',$unquekey);
        Session::put('pkgid',$packegedetail->pkgid);
        Session::put('paypalPaymentId', $payment->getId());
        Session::put('email',$packegedetail->email);
        if (isset($redirectURL)) {
            return Redirect::away($redirectURL);
        }

        Session::put('error', 'There was a problem processing your payment. Please contact support.');

        return Redirect::to('categories');
    }
    public function RenewPackegePayment()
    {
        $paymentId = Session::get('paypalPaymentId');

        # We now erase the payment ID from the session to avoid fraud
        Session::forget('paypalPaymentId');

        # If the payer ID or token isn't set, there was a corrupt response and instantly abort
        if (empty(Request::get('PayerID')) || empty(Request::get('token'))) {
            Session()->put('error', 'There was a problem processing your payment. Please contact support.');
            return Redirect::to('categories');
        }

        $payment = Payment::get($paymentId, $this->apiContext);
        $execution = new PaymentExecution();
        $execution->setPayerId(Request::get('PayerID'));

        $result = $payment->execute($execution, $this->apiContext);

        // # Payment is processing but may still fail due e.g to insufficient funds

        if ($result->getState() == 'approved') {
            
            $upgradepkg = Session::get('pkgid');     
            $packegepayment = Packege_Payment::find($upgradepkg);
            $expirydate = $packegepayment->expires_on;

            $date = strtotime($expirydate); 
            
            $newDate = date('Y-m-d', $date);
            $newdate =strtotime("+30 Days");
            $packegepayment->expires_on = date('Y-m-d',$newdate);
            
            
            $packegepayment->update();
            
            $toeknname = sha1(time());
            
             $pageurl = 'http://beatbyte.co/user/verify/'.$toeknname;
                try{
                  
                   Mail::send(array(),array(),function($message) {
                        $message->to(Session::get('email'), "Test")
                        ->from('gulraizazam0@gmail.com')
                        ->subject("Email Verification");
                        
                        
                    });
                }catch(JWTException $exception){
                    $serverstatuscode = "0";
                    $serverstatusdes = $exception->getMessage();
                }
                
            }
            
            Session::forget('key');
            Session::forget('email');
            Session::forget('pkgid');
            

            return Redirect::to('/')->with('success','Your payment was successful.Confirmation Email Has Been Sent To Your Email. Thank you.');
        

       
        return Redirect::to('login')->with('error','There was a problem processing your payment. Please contact support.');
    }

}