<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Redirect;
use App\Beat;
use App\Song;
use App\Packege;
use Cart;
use DB;
use App\User;
use App\Mood;
use App\Generation;
use Illuminate\Support\Facades\Validator;

class FrontendController extends Controller
{
    public function index()
    {
    	return view('frontend.index');
    }
    public function ShowLogin()
    {
    	return view('frontend.login');
    }
    public function PostLogin(Request $request)
    {
      Validator::make($request->all(), [ 
        'email' => 'required',
        'password' => 'required',
      ])->validate();

    	$checkUser = Auth::attempt(['email'=>$request->email, 'password' => $request->password,'is_active'=>1]);

    	if($checkUser ){
          return Redirect('/');
       }else{
    		return redirect('showlogin')->with('error','Invalid Credentials!');
    	}
    }
    public function PostLogout(){
    	Auth::logout();
     	return view('frontend.login');
  	}
  	public function ErrorPage()
  	{
  		return view('frontend.error');
  	}
    public function Allcategories($id)
    {
      $allgnerations = Generation::all();
      $allmoods = Mood::all();
      if($id=="free"){
         $allbeats = DB::table('beats')->where('is_free',1)->get();
         $allsongs = DB::table('songs')->join('users','songs.user_id','=','users.id')->select('songs.name as songname','songs.song_file','songs.image','song_price','songs.song_category','songs.id','users.name')->get();
      }else{
        $allbeats =Beat::all();
        $generation = Generation::find($id);
        $allsongs = DB::table('songs')->join('users','songs.user_id','=','users.id')->select('songs.name as songname','songs.song_file','songs.image','song_price','songs.song_category','songs.id','users.name')->where('song_generation',$generation->generation_name)->get();

      }
      
      return view('frontend.categories',compact('allbeats','allsongs','allgnerations','allmoods'));
      
     
    }
    public function Cart()
    {
      $user=Auth::user();
      if($user){
         return view('frontend.cart');
       }else{
        return view('frontend.login');
       }
     
     
    }
    public function AddToCart($id)
    {
      $song=Song::find($id);
     
         Cart::add(array(
            'id' => $song->id, // inique row ID
            'name' => $song->name,
            'price' => $song->song_price,
            'quantity'=>1,
            'attributes' => array('image'=>$song->image)
        ));
      return Redirect('cart');
    }
    public function RemoveCart($id)
    {
      Cart::remove($id);
      return Redirect('cart');
     
    }
    // public function updateCart(Request $request)
    // {
    //   $updateQuantity= $request->quantity;
    //   $updateQ= $request->requestId;
    //   Cart::update( $updateQ, array(
    //     'quantity' =>$updateQuantity, 
    //   ));
    //   return Redirect('cart');
    // }
    public function CheckOut()
    {
      $user=Auth::user();
      if(Cart::isEmpty()){
        return Redirect('cart')->with('warning','Please Add Item To Cart!');
      }
      if($user ){
        return view('frontend.checkout');
      }else{
        return view('frontend.login');
      }

      
    }
    public function DownloadEmailSong(Request $request)
    {
      
      return response()->download('storage/app/uploads/files/'.$request->audio);
    }
    public function MyPurchases($id)
    {

      $user_id =  DB::table('orders')->select('user_id')->where('unique_key',$id)->first();
      $order = DB::table('orders')->select('id')->where('user_id',$user_id->user_id)->get();
      $getitems = [];
      foreach ($order as $key => $value) {
        array_push($getitems, $value->id);
      }
      $allId = implode(',', $getitems);
      $allsongs = DB::table('order_items')->join('songs','songs.id','=','order_items.item_id')->whereRaw('order_id IN ('.$allId.')')->get();
      
      return view('frontend.mypurchases',compact('allsongs'));
    }
    public function RegisterUser()
    {
      $getPackege = DB::table('packeges')->take(2)->latest()->get();
      return view('frontend.package',compact('getPackege'));
    }
    public function PackegeCheckout($id)
    {
      $purchasePkg = Packege::find($id);
      return view('frontend.packegecheckout',compact('purchasePkg'));
    }
    public function CompleteRegister(Request $request)
    {
      if(isset($request->key) && !empty($request->key)){

        $unique = $request->key;
       
      }else{
         $unique  = '';
       
      }
      return view('frontend.signup',compact('unique'));
      
      
    }
    public function PostRegister(Request $request)
    {
      Validator::make($request->all(), [
        'username' => 'required',
        'email' => 'required',
        'password' => 'required',
        'confirmpassword' => 'required',
        
      ])->validate();
      $user = new User();
      $user->name = $request->username;
      $user->email = $request->email;
      $user->password = bcrypt($request->password);
      $user->is_active = 1;
      $user->remember_token = $request->uniqueid;
      if($request->password == $request->confirmpassword){
         $user->save();
       }else{
        return redirect('completesignup')->with('error','Password do Not Match!');
       }
     
      return redirect('showlogin');
    }
}
