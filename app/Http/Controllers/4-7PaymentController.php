<?php

namespace App\Http\Controllers;

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
use Redirect;
use Session;
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

    public function __construct()
    {
        # Main configuration in constructor
        $paypalConfig = config('paypal');

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
        $order->user_id = Auth::user()->id;
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
            $items[] = (new Item())
                ->setName($item->name)
                ->setCurrency('USD')
                ->setQuantity(1)
                ->setPrice((int)$item->price);
        }

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

        $createProfile = $webProfile->create($this->apiContext);

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
         $order = Order::find($orderId);
         $order->status = 'processing';

        if ($result->getState() == 'approved') {
                    
            $items = Cart::getContent();
            $order=Order::all();
            foreach(Cart::getContent() as $item ){
                $orderItem = new Order_item();
                $orderItem->order_id=$orderId;
                $orderItem->item_id=$item->id;
                $orderItem->Qty=1;
                $orderItem->price= $result->transactions[0]->getAmount()->getTotal();
                $orderItem->subtotal=Cart::getSubTotal();
                $orderItem->save();
               $uniqueOrderKey = Session::get('orderkey');
                try{
                    $songfile = Song::find($item->id);
                    Mail::send('frontend.emailview',['pagelink'=>'http://beatbyte.co/mysongs', 'unique'=>$uniqueOrderKey],function($message) {
                        $message->to(Session::get('email'), "Test")
                        ->from('gulraizazam0@gmail.com')
                        ->subject("Download Link");
                    });
                }catch(JWTException $exception){
                    $serverstatuscode = "0";
                    $serverstatusdes = $exception->getMessage();
                }
                
            }
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
                    
            $packegepayment = new Packege_Payment;
            $packegepayment->packege_id = Session::get('pkgid');
            $packegepayment->unique_key = Session::get('key');
            $packegepayment->email =Session::get('email');
            $packegepayment->flag=0;
            $packegepayment->save();
            $userregister = new User();
            $alluserdata = Session::get('request');
            $userregister->name = $alluserdata['username'];
            $userregister->email = $alluserdata['email'];
            $userregister->password = bcrypt($alluserdata['password']);
            $userregister->save();
            $toeknname = sha1(time());
            $verifyUser = VerifyUser::create([
            'user_id' => $userregister->id,
            'token' => $toeknname,
            ]);

             $pageurl = 'http://beatbyte.co/user/verify/'.$toeknname;
                try{
                  
                    Mail::send(array(),array(),function($message) use($pageurl) {
                        $message->to(Session::get('email'), "Test")
                        ->from('gulraizazam0@gmail.com')
                        ->subject("SignUp Link")
                        ->setBody($pageurl);
                    });
                }catch(JWTException $exception){
                    $serverstatuscode = "0";
                    $serverstatusdes = $exception->getMessage();
                }
                
            }
            
            Session::forget('key');
            Session::forget('email');
            Session::forget('pkgid');
            Session::put('success', 'Your payment was successful.A Download Link Has Been Sent To Your Email. Thank you.');

            return Redirect::to('/');
        

        Session::put('error', 'There was a problem processing your payment. Please contact support.');

        return Redirect::to('/');
    }
}