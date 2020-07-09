<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Packege;
use DB;
use App\Mood;
use App\Generation;
use App\User;
use Illuminate\Support\Facades\Validator;
class AdminController extends Controller
{
   public function index()
   {
   	 $AllSales = DB::table('orders')->selectRaw("COUNT(*) as sales , DATE_FORMAT(created_at, '%Y  ') date")
    ->groupBy('date')
    ->get();
   	return view('dashboard.index',compact('AllSales'));
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
   	$allsales = DB::table('order_items')->join('orders','orders.id','=','order_items.order_id')->join('songs','songs.id','=','order_items.Item_id')->get();
   	return view('dashboard.admin.All Sales.allsales',compact('allsales'));
   }

   //Users
   public function AllUsers()
   {
   	$allusers = User::all();
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

}
