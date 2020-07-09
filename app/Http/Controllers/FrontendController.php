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
use App\Album;
use App\Playlist;
use App\Stem;
use App\Comment;
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
    public function GetAjax($id){
      if($id=="all"){
         
         $allsongs = DB::table('songs')->join('users','songs.user_id','=','users.id')->select('songs.name as songname','songs.song_file','songs.image','song_price','songs.song_category','songs.id','users.name')->get();
      }else{
        $allsongs = DB::table('songs')->join('users','songs.user_id','=','users.id')->select('songs.name as songname','songs.song_file','songs.image','song_price','songs.song_category','songs.id','users.name')->where('song_generation',$id)->get();
      }
      if(!count($allsongs)){
        return response()->json(['error'=>'Sorry No Data Available']);
      }else{
        return view('frontend.ajax',compact('allsongs'));
      }
    }
    public function GetAjaxBeats($id)
    {
      $beats = DB::table('beats')->join('users','beats.user_id','=','users.id')->select('beats.name as beatname','beats.file','beats.image','beats.basic_price','beats.is_free','beats.id','users.name')->where('is_free',$id)->get();

       if(!count($beats)){
        return response()->json(['error'=>'Sorry No Data Available']);
      }else{
        return view('frontend.ajaxbeats',compact('beats'));
      }
      
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
    		return redirect('login')->with('error','Invalid Credentials!');
    	}
    }
    public function PostLogout(){
    	Auth::logout();
     	return redirect('login');
  	}
  	public function ErrorPage()
  	{
  		return view('frontend.error');
  	}
    public function Allcategories($id)
    {
      $allgnerations = Generation::all();
      $allmoods = Mood::all();
     if($id == "all"){
        $allalbums = Album::all();
        $allplaylist = Playlist::all();
         $allsongs = Song::join('users','songs.user_id','=','users.id')->select('songs.name as songname','songs.song_file','songs.image','song_price','songs.song_category','songs.id','users.name')->paginate(5);
      }else{
        $allalbums = Album::all();
        $allplaylist = Playlist::all();
        $generation = Generation::find($id);
        $allsongs = Song::join('users','songs.user_id','=','users.id')->select('songs.name as songname','songs.song_file','songs.image','song_price','songs.song_category','songs.id','users.name')->where('song_generation',$generation->id)->paginate(5);

      }
      
      return view('frontend.categories',compact('allsongs','allgnerations','allmoods','allalbums','allplaylist'));
      
     
    }
     public function SingleAlbum($id)
    {
      $getalbumdetail = Album::find($id);

      if(empty($getalbumdetail->song_id)){
        return redirect()->back()->with('error','Sorry There is No Song In This Album!.');
      }
      $allsongs = DB::table('songs')->whereRaw('id IN ('.$getalbumdetail->song_id.')')->get();
      
      return view('frontend.singlealbum',compact('getalbumdetail','allsongs'));
    }
    public function Cart()
    {
      return view('frontend.cart');
    }
    public function AddToCart($id)
    {
      $song=Song::find($id);

      $CartItems = Cart::getContent();
      foreach($CartItems as $items){
       $items->attributes->userid;
       if($song->user_id != $items->attributes->userid){
        return redirect()->back()->with('error','Sorry You Can Not Add Items Of More Than One Seller!');
       }
      }
         Cart::add(array(
            'id' => $song->id, // inique row ID
            'name' => $song->name,
            'price' => $song->song_price,
            
            'quantity'=>1,
            'attributes' => array('image'=>$song->image,'userid'=>$song->user_id)
        ));

      return redirect()->back();
    }
    public function AddToCartBeat(Request $request,$id)
    {
       
      $beat=Beat::find($request->beatid);

      $CartItems = Cart::getContent();
      foreach($CartItems as $items){
       $items->attributes->userid;
       if($beat->user_id != $items->attributes->userid){
        return redirect()->back()->with('error','Sorry You Can Not Add Items Of More Than One Seller!');
       }
      }
         Cart::add(array(
            'id' => $beat->id, // inique row ID
            'name' => $beat->name,
            'price' => $request->beatprice,
            'quantity'=>1,
            'attributes' => array('image'=>$beat->image,'userid'=>$beat->user_id)
        ));
         
      return redirect()->back();
    } 
    public function AddToCartStem($id)
    {
      $stem = Stem::find($id);
      $CartItems = Cart::getContent();
      foreach($CartItems as $items){
       $items->attributes->userid;
       if($stem->user_id != $items->attributes->userid){
        return redirect()->back()->with('error','Sorry You Can Not Add Items Of More Than One Seller!');
       }
     }
       Cart::add(array(
            'id' => $stem->id, // inique row ID
            'name' => $stem->stem_name,
            'price' => $stem->price,
            
            'quantity'=>1,
            'attributes' => array('stem_image'=>$stem->image,'userid'=>$stem->user_id,'stem_id'=>$stem->id)
        ));

     return redirect()->back();

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
      
      if(Cart::isEmpty()){
        return Redirect('cart')->with('warning','Please Add Item To Cart!');
      }else{
        return view('frontend.checkout');
      }
      
        
      }
      public function CheckOutStem()
      {
        if(Cart::isEmpty()){
          return Redirect('cart')->with('warning','Please Add Item To Cart!');
        }else{
          return view('frontend.checkoutstem');
        }
      
      }
    public function DownloadEmailSong(Request $request)
    {
      
      return response()->download('storage/app/uploads/files/'.$request->audio);
    }
    public function MyPurchases($id)
    {
      
     
      $order = DB::table('orders')->select('id')->where('unique_key',$id)->get();
      $getitems = [];
      foreach ($order as $key => $value) {
        array_push($getitems, $value->id);
      }
      $allId = implode(',', $getitems);
      $allsongs = DB::table('order_items')->join('songs','songs.id','=','order_items.item_id')->whereRaw('order_id IN ('.$allId.')')->get();
      $allbeats = DB::table('order_items')->join('beats','beats.id','=','order_items.item_id')->whereRaw('order_id IN ('.$allId.')')->get();
      return view('frontend.mypurchases',compact('allsongs','allbeats'));
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
     
      return redirect('login');
    }
    public function Comment(Request $request)
    {
      if($request->userid==''){
         return redirect('login');
      }else{
        $comment  = new Comment();
      $comment->userid = $request->userid;
      $comment->comment = $request->comment;
      $comment->albumid = $request->albumid;
      $comment->save();
      return redirect()->back();
      }
      
    }
    public function GetBeats()
    {
      $allstems = Stem::all();
      $allbeats = Beat::join('users','users.id','=','beats.user_id')->select('beats.name as beatname','beats.basic_price','users.name as username','beats.is_free','beats.image','beats.file','beats.id','beats.premium_price','beats.unlimited_price')->where('is_purchased',0)->paginate(10);
      $allgnerations = Generation::all();
      $allmoods = Mood::all();
      return view('frontend.beats',compact('allbeats','allgnerations','allmoods','allstems'));
    }
    public function SearchData(Request $request)
    {
      if(is_null($request->searcdata)){
         $allsongs = DB::table('songs')->join('users','songs.user_id','=','users.id')->select('songs.name as songname','songs.song_file','songs.image','song_price','songs.song_category','songs.id','users.name')->paginate(10);
         $allbeats = DB::table('beats')->join('users','beats.user_id','=','users.id')->select('beats.name as beatname','beats.file','beats.image','beats.basic_price','beats.is_free','beats.id','users.name')->where('is_purchased',0)->paginate(10);
      }else{
        $allsongs = DB::table('songs')->join('users','songs.user_id','=','users.id')->select('songs.name as songname','songs.song_file','songs.image','song_price','songs.song_category','songs.id','users.name')->where('songs.name', 'like',$request->searcdata)->get();
      $allbeats = DB::table('beats')->join('users','beats.user_id','=','users.id')->select('beats.name as beatname','beats.file','beats.image','beats.basic_price','beats.is_free','beats.id','users.name')->where('beats.name', 'like',$request->searcdata)->where('is_purchased',0)->get();
      }
      
      if(!count($allsongs) && !count($allbeats)){
        return response()->json(['error'=>'Sorry No Record Available!']);
      }else{
        return view('frontend.ajaxsearch',compact('allsongs','allbeats'));
      }

      
    }
    public function Search(Request $request)
    {

      
      if(is_null($request->search)){
        $allalbums = Album::all();
       $allgnerations = Generation::all();
        $allsongs = DB::table('songs')->join('users','songs.user_id','=','users.id')->select('songs.name as songname','songs.song_file','songs.image','song_price','songs.song_category','songs.id','users.name')->paginate(10);
        $allbeats = DB::table('beats')->join('users','beats.user_id','=','users.id')->select('beats.name as beatname','beats.file','beats.image','beats.basic_price','beats.is_free','beats.id','users.name')->where('is_purchased',0)->paginate(10);
      }else{
         $allalbums = Album::all();
       $allgnerations = Generation::all();
       $allsongs = DB::table('songs')->join('users','songs.user_id','=','users.id')->select('songs.name as songname','songs.song_file','songs.image','song_price','songs.song_category','songs.id','users.name')->where('songs.name', 'like',$request->search)->paginate(10);
     $allbeats = DB::table('beats')->join('users','beats.user_id','=','users.id')->select('beats.name as beatname','beats.file','beats.image','beats.basic_price','beats.is_free','beats.id','users.name')->where('beats.name', 'like',$request->search)->where('is_purchased',0)->paginate(10);
      }
     
      return view('frontend.categories',compact('allsongs','allbeats','allgnerations','allalbums'));
    }
    public function PaidEmail()
    {
      $toeknname = sha1(time());
      return view('emails.paiduseremail',compact('toeknname'));
    }
    public function GetAjaxMoodsRecord($id)
    {

      $beats = DB::table('beats')->join('users','beats.user_id','=','users.id')->select('beats.name as beatname','beats.file','beats.image','beats.basic_price','beats.is_free','beats.id','users.name')->where('moods',$id)->get();
      if(!count( $beats)){
        return response()->json(['error'=>'Sorry No Data Available']);
      }else{
      return view('frontend.ajaxbeats',compact('beats'));
    }
    }
    public function GetAjaxAllBeats($id)
    {
      if($id=='all'){
        $beats = DB::table('beats')->join('users','beats.user_id','=','users.id')->select('beats.name as beatname','beats.file','beats.image','beats.basic_price','beats.is_free','beats.id','users.name')->get();
      }else{
        $beats = DB::table('beats')->join('users','beats.user_id','=','users.id')->select('beats.name as beatname','beats.file','beats.image','beats.basic_price','beats.is_free','beats.id','users.name')->where('generation',$id)->get();
      }
      if(!count( $beats)){
          return response()->json(['error'=>'Sorry No Data Available']);
      }else{
        return view('frontend.ajaxbeats',compact('beats'));
      }
      
    }
    public function GetFreeSongs($id)
    {

      $allsongs =  DB::table('songs')->join('users','songs.user_id','=','users.id')->select('songs.name as songname','songs.song_file','songs.image','songs.song_price','songs.song_category','songs.id','users.name')->where('song_category',$id)->paginate(10);
      
      if(!count($allsongs)){
        return response()->json(['error'=>'Sorry No Data Available']);
      }else{
        return view('frontend.ajax',compact('allsongs'));
      }
    }
    public function PriceFilter(Request $request)
    {
      $minprice = (int)$request->minPrice;
      $maxprice = (int)$request->maxPrice;
      $allsongs = DB::table('songs')->join('users','songs.user_id','=','users.id')->select('songs.name as songname','songs.song_file','songs.image','songs.song_price','songs.song_category','songs.id','users.name')->whereBetween('song_price',[$minprice,$maxprice])->get();
     
      return view('frontend.ajax',compact('allsongs'));
    }
    public function PriceFilterBeats(Request $request)
    {

     
      $minprice = (int)$request->minPrice;
      $maxprice = (int)$request->maxPrice;
      $beats = DB::table('beats')->join('users','beats.user_id','=','users.id')->select('beats.name as beatname','beats.file','beats.image','beats.basic_price','beats.is_free','beats.id','users.name')->whereBetween('beats.basic_price',[$minprice,$maxprice])->get();
      if(!count($beats)){
        return response()->json(['error'=>'Sorry No Data Available']);
      }else{
        return view('frontend.ajaxbeats',compact('beats'));
      }
    }

    public function GetPlaylist()
    {
      $allplaylists = Playlist::join('users','users.id','=','playlists.user_id')->select('users.name','playlists.playlist_name','playlists.id')->paginate(10);
      return view('frontend.playlists',compact('allplaylists'));
    }
    public function SinglePlayList($id)
    {

      $getplaylistdetail = DB::table('playlists')->where('id',$id)->first();
      
      $allsongs = DB::table('songs')->whereRaw('id IN ('.$getplaylistdetail->song_id.')')->get();
      return view('frontend.detailplaylist',compact('allsongs','getplaylistdetail'));
    }
    public function AddComment(Request $request)
    {
      if($request->userid==''){
         return redirect('login');
      }else{
      $addcomment = new Comment();
      $addcomment->userid  = $request->userid;
      $addcomment->albumid = $request->playlisid;
      $addcomment->comment = $request->comment;
      $addcomment->save();
      return redirect()->back();
    }
    }
}
