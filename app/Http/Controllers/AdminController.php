<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Packege;
use DB;
use App\Mood;
use App\Generation;
use App\User;
use App\Comment;
use Illuminate\Support\Facades\Validator;
class AdminController extends Controller
{
   public function index()
   {

   	 $AllSongsSales = DB::table('order_items')->join('songs','songs.id','=','order_items.item_id')->selectRaw("COUNT(*) as sales , DATE_FORMAT(order_items.created_at, '%Y  ') date")
    ->groupBy('date')
    ->get();
    $AllBeatsSales = DB::table('order_items')->join('beats','beats.id','=','order_items.item_id')->selectRaw("COUNT(*) as sales , DATE_FORMAT(order_items.created_at, '%Y  ') date")
    ->groupBy('date')
    ->get();
   	return view('dashboard.index',compact('AllSongsSales','AllBeatsSales'));
   }
   public function Packeges()
   {
   	$allpackeges = Packege::all();
   	return view('dashboard.admin.packeges.allpackeges',compact('allpackeges'));
   }
   public function AddPackege()
   {
   	return view('dashboard.admin.packeges.addpackege');
   }
   public function StorePackege(Request $request)
   {
      Validator::make($request->all(), [
        'pkgname' => 'required',
        'pkgdescription' => 'required',
        ])->validate();
		$storepkg = new Packege();
		$storepkg->packege_name = $request->pkgname;
		if($request->pkgcategory=="free"){
			$storepkg->packege_price = 0;
		}else{
			$storepkg->packege_price = $request->pkgprice;
		}
		$storepkg->packege_description	= $request->pkgdescription;
		$storepkg->save();
		return redirect('adminpackege')->with('success','Packege Added Successfully!.');
   }
   public function EditPackege($id)
   {
   	$editpkg = Packege::find($id);
   	return view('dashboard.admin.packeges.editpackege',compact('editpkg'));
   }
   public function UpdatePackege(Request $request,$id)
   {
   		$updatepkg = Packege::find($id);
   		$updatepkg->packege_name = $request->pkgname;
   		if($request->pkgcategory=="free"){
         $storepkg->packege_price = 0;
   		}else{
   			$updatepkg->packege_price = $request->pkgprice;
   		}
   		$updatepkg->packege_description	= $request->pkgdescription;
   		$updatepkg->update();
   		return redirect('adminpackege')->with('success','Packege Updated Successfully!.');
   }
   public function DeletePackege($id)
   {
   		$delpkg = Packege::find($id);
   		$delpkg->delete();
   		return redirect('adminpackege')->with('error','Packege Deleted Successfully!.');
   }
   //Payments
   public function GetPayments()
   {
   	$allorders  = DB::table('order_items')->join('orders','orders.id','=','order_items.order_id')->join('songs','songs.id','=','order_items.Item_id')->get();

   	return view('dashboard.admin.payments.allpayments',compact('allorders'));
   }
  
   public function SystemPayments()
   {

      $systempaymets = DB::table('packege_paymets')->join('packeges','packeges.id','=','packege_paymets.packege_id')->join('users','users.id','=','packege_paymets.user_id')->select('packege_paymets.id','packege_paymets.payment_id','packege_paymets.email','packeges.packege_name','packeges.packege_price','packege_paymets.expires_on')->get();
     return view('dashboard.admin.payments.systempayments',compact('systempaymets'));
   }
   public function GetSystemPayments(Request $request)

   {
      $fromdate = $request->fromdate;
      $todate = $request->todate;

      $systempaymets = DB::table('packege_paymets')->join('packeges','packeges.id','=','packege_paymets.packege_id')->select('packege_paymets.id','packege_paymets.payment_id','packege_paymets.email','packeges.packege_name','packeges.packege_price','packege_paymets.expires_on')->whereBetween("packege_paymets.created_at",[$fromdate,$todate])->get();
     
     return view('dashboard.admin.payments.systempayments',compact('systempaymets'));
   }
   public function GetSpecificPayment($seller)
   {
      if($seller == 'all'){
        $allorders  = DB::table('order_items')->join('orders','orders.id','=','order_items.order_id')->join('songs','songs.id','=','order_items.Item_id')->get();
      }else{
         $allorders  = DB::table('order_items')->join('orders','orders.id','=','order_items.order_id')->join('songs','songs.id','=','order_items.Item_id')->where('songs.user_id',$seller)->get();
      }
      
      return view('dashboard.admin.ajaxpayments',compact('allorders'));
   }
   //Moods
   public function AllMoods()
   {
   	$allmoods = Mood::all();
   	return view('dashboard.admin.moods.allmoods',compact('allmoods'));
   }
   public function AddMood()
   {
   	return view('dashboard.admin.moods.addmood');
   }
   public function StoreMood(Request $request)
   {  Validator::make($request->all(), [
        'moodname' => 'required',
        
      ])->validate();
   		$storemood =new Mood();
   		$storemood->mood_name = $request->moodname;
   		$storemood->save();
   		return redirect('allmoods')->with('success','Mood Added Successfully!');
   }
   public function EditMood($id)
   {
   		$editmood  = Mood::find($id);
   		return view('dashboard.admin.moods.editmood',compact('editmood'));
   }
   public function UpdateMood(Request $request,$id)
   {
   		$updatemood  = Mood::find($id);
   		$updatemood->mood_name = $request->moodname;
   		$updatemood->update();
   		return redirect('allmoods')->with('success','Mood Updated Successfully!');
   }
   public function DeleteMood($id)
   {
   		$delmood = Mood::find($id);
   		$delmood->delete();
   		return redirect('allmoods')->with('error','Mood Deleted Successfully!.');
   }
   //Generations
   public function AllGenerations()
   {
   	$allgenerations = Generation::all();
   	return view('dashboard.admin.generations.allgenerations',compact('allgenerations'));
   }
   public function AddGenerations()
   {
   	return view('dashboard.admin.generations.addgeneration');
   }
   public function StoreGenerations(Request $request)
   {  Validator::make($request->all(), [
        'generationname' => 'required',
        
      ])->validate();
		$storegen =new Generation();
		$storegen->generation_name = $request->generationname;
		$storegen->save();
		return redirect('allgenerations')->with('success','Generation Added Successfully!');
   }
   public function EditGenerations($id)
   {
   		$editgen  = Generation::find($id);
   		return view('dashboard.admin.generations.editgeneration',compact('editgen'));
   }
   public function UpdateGenerations(Request $request,$id)
   {
   		$updategen  = Generation::find($id);
   		$updategen->generation_name = $request->generationname;
   		$updategen->update();
   		return redirect('allgenerations')->with('success','Generation Updated Successfully!');
   }
   public function DeleteGenerations($id)
   {
   		$delgen = Generation::find($id);
   		$delgen->delete();
   		return redirect('allgenerations')->with('error','Generation Deleted Successfully!.');
   }
   //Sales
   public function AllSales()
   {
   	$allsales = DB::table('order_items')->join('orders','orders.id','=','order_items.order_id')->join('songs','songs.id','=','order_items.Item_id')->join('users','users.id','=','songs.user_id')->select('order_items.id','order_items.payment_id','songs.name as songname','order_items.price','orders.email as selleremail','order_items.created_at','users.name as sellername')->get();
   	return view('dashboard.admin.All Sales.allsales',compact('allsales'));
   }
   public function GetSpecificSale($id)
   {
      if($id == 'all'){
         $allsales = DB::table('orders')->join('order_items','orders.id','=','order_items.order_id')->join('songs','order_items.item_id','=','songs.id')->join('users','users.id','=','songs.user_id')->select('order_items.id','order_items.payment_id','songs.name as songname','order_items.price','orders.email as selleremail','order_items.created_at','users.name as sellername')->get();
      }else{
         $allsales = DB::table('orders')->join('order_items','orders.id','=','order_items.order_id')->join('songs','order_items.item_id','=','songs.id')->join('users','users.id','=','songs.user_id')->select('order_items.id','order_items.payment_id','songs.name as songname','order_items.price','orders.email as selleremail','order_items.created_at','users.name as sellername')->where('user_id',$id)->get();
      }
      
      return view('dashboard.admin.ajaxsales',compact('allsales'));
   }
   public function FilterSales(Request $request)
   {
      $fromdate = $request->fromdate;
      $todate = $request->todate;
      $allsales = DB::table('orders')->join('order_items','orders.id','=','order_items.order_id')->join('songs','order_items.item_id','=','songs.id')->join('users','users.id','=','songs.user_id')->select('order_items.id','order_items.payment_id','songs.name as songname','order_items.price','orders.email as selleremail','order_items.created_at','users.name as sellername')->whereBetween("order_items.created_at",[$fromdate,$todate])->get();
      
      return view('dashboard.admin.All Sales.allsales',compact('allsales'));
   }


   //Users
   public function AllUsers()
   {
   	$allusers = User::join('role_user','users.id','=','role_user.user_id')->join('roles','roles.id','=','role_user.role_id')->select('users.name as username','roles.name','users.email','users.id','users.is_active')->get();
   	return view('dashboard.admin.Users.allusers',compact('allusers'));
   }
   public function DeActiveusers($id)
   {
   		$user = User::find($id);
   		$user->is_active = 0;
   		$user->update();
   		return redirect('allusers')->with('error','User Deactivated Successfully!');
   }
   public function Activateusers($id)
   {
   		$user = User::find($id);
   		$user->is_active = 1;
   		$user->update();
   		return redirect('allusers')->with('success','User Activated Successfully!');
   	
   		
   }
   //My acoount

   public function MyAccount()
   {
      $user =Auth::user();
      return view('dashboard.admin.account.myaccount',compact('user'));
   }

   public function UpdateAccount(Request $request,$id)

   {
      
      $updateaccount = User::find($id);
      $updateaccount->name = $request->username;
      $updateaccount->email =$request->useremail;
      $updateaccount->password  = bcrypt($request->password);
       if($request->password ==$request->password2 ){
          $updateaccount->update();
          return redirect()->back()->with('success','Account Updated Successfully!');
       }else{
         return redirect()->back()->with('error','Please Provide Correct Information!');
       }
      
   }
   public function Comments()
   {
      $getcomments = Comment::all();

     
      return view('dashboard.admin.comments.index',compact('getcomments'));
   }
   public function ApproveComments($id)
   {

      $approvecomment = Comment::find($id);
      
      $approvecomment->is_approved = 1;
      $approvecomment->update();
      return redirect()->back()->with('success','Comment Approved Successfully!');
   }
   public function DisapproveComments($id)
   {
      $disapprovecomment = Comment::find($id);
      $disapprovecomment->is_approved = 0;
      $disapprovecomment->update();
      return redirect()->back()->with('error','Comment Dispproved Successfully!');
   }

   

}
