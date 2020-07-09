<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Beat;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Auth;
use DB;
use App\Song;
use App\Musickit;
use App\Mood;
use App\Generation;
use App\Album;
use App\Artwork;
use App\Playlist;
use App\Voicetag;
use App\Packege;
use App\User;
use App\Music_store;
use App\WidgetConfig;
use App\ Accountsetting;
class SellerController extends Controller
{
    public function index()
   	{
      $user = Auth::user()->id;
      $SellerSales = DB::table('orders')->selectRaw("COUNT(*) as sales , DATE_FORMAT(created_at, '%Y  ') date")
    ->groupBy('date')
    ->get();
     
    
   		return view('dashboard.index',compact('SellerSales'));
   	}
   	public function allbeats()
   	{
   		$user = Auth::user()->id;
   		$allbeats = DB::table('beats')->join('generations','beats.generation','=','generations.id')->select('beats.*','generations.generation_name')->where('beats.user_id',$user)->get();
   		
   		return view('dashboard.seller.beats.allbeats',compact('allbeats'));
   	}
   	public function uploadBeats()
   	{
      $user=Auth::user()->id;
      $allbeats = DB::table('beats')->where('user_id',$user)->get();
   		return view('dashboard.seller.beats.uploadbeat',compact('allbeats'));
   	}
   	public function ShowBeatForm()
   	{
      $user=Auth::user()->id;
      $allmoods = Mood::all();
      $allgen = Generation::all();
      $allbeats = DB::table('beats')->where('user_id',$user)->get();
      
   		return view('dashboard.seller.beats.addbeat',compact('allmoods','allgen','allbeats'));
   	}
   	public function StoreBeat(Request $request)
   	{
      $user = Auth::user();
   		Validator::make($request->all(), [
		    'beatname' => 'required',
		    'tempo' => 'required',
		    'musicgeneration' => 'required',
		    'musicmode' => 'required',
		    'audios'=> 'required|mimes:mp3,wav',
		])->validate();
   		$addbeat  = new Beat();
   		$addbeat->name = $request->beatname;
   		$addbeat->tempo = $request->tempo;
   		$addbeat->generation = $request->musicgeneration;
   		$addbeat->moods = $request->musicmode;
   		$addbeat->basic_price = $request->basic_price;
   		$addbeat->tags = $request->tags;

      $addbeat->is_free = $request->category;
      
   		$addbeat->premium_price = $request->premium_price;
   		$addbeat->unlimited_price = $request->unlimited_price;
   		$addbeat->exclusive_price = $request->exclusive_price;
   		$addbeat->user_id = $request->userid;
   		if(is_array($request->file('audios')))
        {

	         $audios=array();
           $audio_format = array();
	         foreach($request->file('audios') as $file) {
	            $uniqueid=uniqid();
	            $original_name=$file->getClientOriginalName();

	            $size=$file->getSize();

	            $extension=$file->getClientOriginalExtension();

	             $filename=Carbon::now()->format('Ymd').'_'.$uniqueid.'.'.$extension;

	            $audiopath=url('/storage/app/uploads/files/'.$filename);
	            $path=$file->storeAs('/uploads/files',$filename);
	            array_push($audios,$audiopath);
              array_push($audio_format, $extension);
	         }
	         $all_audios=implode(",",$audios);
           $all_audios_extensions = implode(",", $audio_format);
           $addbeat->format = $all_audios_extensions;
	         $addbeat->file = $all_audios;
   		}

   		$addbeat->release_date = $request->release_date;
      if($user->is_paid==0)
      {
        if($request->category == "paid"){
          return redirect()->back()
                    ->with('warning',"Sorry You Can Not Upload Paid Music. This Feature Is Available In Premium Account. Upgrade Your Account <a href='{{url('upgrade',$packege->id)}}'> upgrade</a> ")
                    ->with('status', 'warning');
        }else{
          $addbeat->save();
        }
      }else{
        $addbeat->save();
      }
   		
   		return redirect('allbeats')->with('success','Beat added successfully!');
   	}
    public function EditBeat($id)
    {
      $allmoods = Mood::all();
      $allgen = Generation::all();
      $editbeat = Beat::find($id);
      return view('dashboard.seller.beats.editbeat',compact('editbeat','allmoods','allgen'));
    }
    public function UpdateBeat(Request $request,$id)
    {
      $user = Auth::user();
      Validator::make($request->all(), [
        'beatname' => 'required',
        'tempo' => 'required',
        'musicgeneration' => 'required',
        'musicmode' => 'required',
        'audios'=> 'required|mimes:mp3,wav',
        'beat_image'=> 'mimes:png,jpg,jpeg',

      ])->validate();
      $updatebeat = Beat::find($id);
      $updatebeat->name = $request->beatname;
      $updatebeat->tempo = $request->tempo;
      $updatebeat->generation = $request->musicgeneration;
      $updatebeat->moods = $request->musicmode;
      $updatebeat->basic_price = $request->basic_price;
      $updatebeat->tags = $request->tags;
       $updatebeat->is_free = $request->category;
      $updatebeat->premium_price = $request->premium_price;
      $updatebeat->unlimited_price = $request->unlimited_price;
      $updatebeat->exclusive_price = $request->exclusive_price;
      $updatebeat->user_id = $request->userid;
      if(is_array($request->file('audios')))
        {
           $audios=array();
           foreach($request->file('audios') as $file) {
              $uniqueid=uniqid();
              $original_name=$file->getClientOriginalName();
              $size=$file->getSize();

              $extension=$file->getClientOriginalExtension();

               $filename=Carbon::now()->format('Ymd').'_'.$uniqueid.'.'.$extension;

              $audiopath=url('/storage/app/uploads/files/'.$filename);
              $path=$file->storeAs('/uploads/files',$filename);
              array_push($audios,$audiopath);
           }
           $all_audios=implode(",",$audios);
           $updatebeat->file = $all_audios;
      }
      if($request->file('beat_image'))
        {
          $songuniqueid=uniqid();
          $song_image=$request->file('beat_image')->getClientOriginalName();
          $size=$request->file('beat_image')->getSize();
          $extension=$request->file('beat_image')->getClientOriginalExtension();
          if (!in_array($extension, $allowed)) {
              
          }
          $filename=Carbon::now()->format('Ymd').'_'.$songuniqueid.'.'.$extension;
          $imagepath=url('/storage/app/uploads/images/'. $song_image);
          $path=$request->file('beat_image')->storeAs('/uploads/images',$song_image);
           $updatebeat->image = $imagepath;
        }
      $updatebeat->release_date = $request->release_date;
      if($user->is_paid==0)
      {
        if($request->category == "paid"){
          return redirect()->back()
                    ->with('warning',"Sorry You Can Not Upload Paid Music. This Feature Is Available In Premium Account. Upgrade Your Account <a href='{{url('upgrade',$packege->id)}}'> upgrade</a> ")
                    ->with('status', 'warning');
        }else{
          $updatebeat->update();
        }
      }else{
        $updatebeat->update();
      }
     
      return redirect('seller/beats')->with('success','Beat Updated successfully!');

    }
    public function deleteBeat($id)
    {
      $deletebeat=Beat::find($id);
      $deletebeat->delete();
       return redirect('allbeats')->with('error','Beat Deleted successfully!');
    }
    //songs
   	public function AllSongs()
   	{
   		$user = Auth::user()->id;
   		$allsong = DB::table('songs')->join('generations','songs.song_generation','=','generations.id')->select('songs.*','generations.generation_name')->where('songs.user_id',$user)->get();
   		return view('dashboard.seller.songs.allsongs',compact('allsong'));
   	}
   	public function uploadSongs()
   	{
   		$user = Auth::user()->id;
      $allgen = Generation::all();
   		$beats = DB::table('beats')->where('user_id',$user)->get();
   		return view('dashboard.seller.songs.uploadsong',compact('beats','allgen'));
   	}
   	public function ShowSongForm()
   	{
   		return view('dashboard.seller.songs.uploadform');
   	}
   	public function StoreSong(Request $request)
   	{

   		
      $user = Auth::user();

   		$addsong = new Song();
   		$addsong->name = $request->songname;
   		$addsong->song_generation = $request->songmusicgeneration;
   		$addsong->song_price = $request->price;
   		$addsong->song_category = $request->Category;
   		$addsong->user_id = $request->userid;
   		if(is_array($request->file('audios')))
        {
        	
	         $Song_audios=array();
	         foreach($request->file('audios') as $file) {
	            $uniqueid=uniqid();
	            $songs_name=$file->getClientOriginalName();
	            $songsize=$file->getSize();
	            $songextension=$file->getClientOriginalExtension();
	            // $filename=Carbon::now()->format('Ymd').'_'.$uniqueid.'.'.$extension;
	            $audiopath=url('/storage/app/uploads/files/'.$songs_name);
	            $path=$file->storeAs('/uploads/files',$songs_name);
	            array_push($Song_audios,$audiopath);
	         }
	         $songall_audios=implode(",",$Song_audios);
	         $addsong->song_file = $songall_audios;
   		}
    
   		$addsong->song_beat = $request->linkedbeat;
      if($user->is_paid==0)
      {

        if($request->Category == "Paid"){
          return redirect()->back()
                    ->with('warning',"Sorry You Can Not Upload Paid Music. This Feature Is Available In Premium Account. Upgrade Your Account <a href='{{url('upgrade',$packege->id)}}'> upgrade</a> ")
                    ->with('status', 'warning');
        
        }else{
          $addsong->save();
        }
      }else{
        $addsong->save();
      }
   		
   		return redirect('seller/songs')->with('success','Song added successfully!');
   	}
    public function EditSong($id)
    {
      $user = Auth::user()->id;
      $allgen = Generation::all();
      $beats = DB::table('beats')->where('user_id',$user)->get();
      $editsong  = Song::find($id);
      return view('dashboard.seller.songs.editsong',compact('editsong','allgen','beats'));
    }
    public function UpdateSong(Request $request,$id)
    {   
      $user = Auth::user();
      Validator::make($request->all(), [
        'name' => 'required',
        'songmusicgeneration' => 'required',
        'audio'=> 'required|mimes:mp3,wav',
        
      ])->validate();
     
      $updatesong = Song::find($id);
      $updatesong->name = $request->name;
      $updatesong->song_generation = $request->songmusicgeneration;
      $updatesong->song_price = $request->price;
      $updatesong->song_category = $request->category;
      $updatesong->user_id = $request->userid;
      if($request->file('audio'))
        {
          $songuniqueid=uniqid();
          $song_name=$request->file('audio')->getClientOriginalName();
          $size=$request->file('audio')->getSize();
          $extension=$request->file('audio')->getClientOriginalExtension();
          $filename=Carbon::now()->format('Ymd').'_'.$songuniqueid.'.'.$extension;
          $songpath=url('/storage/uploads/files/'. $filename);
          $updatesong->song_file = $songpath;
      }
      if($request->file('songimage'))
        {
          $songuniqueid=uniqid();
          $song_image=$request->file('songimage')->getClientOriginalName();
          $size=$request->file('songimage')->getSize();
          $extension=$request->file('songimage')->getClientOriginalExtension();
          $filename=Carbon::now()->format('Ymd').'_'.$songuniqueid.'.'.$extension;
          $imagepath=url('/storage/uploads/images/'. $filename);
           $updatesong->image = $imagepath;
        }
      $updatesong->song_beat = $request->linkedbeat;
      if($user->is_paid==0)
      {
        if($request->category == "paid"){
          return redirect()->back()
                    ->with('warning',"Sorry You Can Not Upload Paid Music. This Feature Is Available In Premium Account. Upgrade Your Account <a href='{{url('upgrade',$packege->id)}}'> upgrade</a> ")
                    ->with('status', 'warning');
        }else{
          $updatesong->update();
        }
      }else{
        $updatesong->update();
      }
     
      
      return redirect('seller/songs')->with('success','Song Updated successfully!');

    }
     public function deleteSong($id)
    {
      $deletebeat=Song::find($id);
      $deletebeat->delete();
       return redirect('seller/songs')->with('error','Song Deleted successfully!');
    }

   									//All Kits
   	public function Allkits()
   	{
   		$user = Auth::user()->id;
   		$getkits = DB::table('musickits')->where('user_id',$user)->get();
   		return view('dashboard.seller.soundkits.allkits',compact('getkits'));
   	}
   	public function uploadKits()
   	{
   		return view('dashboard.seller.soundkits.kitsupload');
   	}
   	public function StoreKits(Request $request)
   	{
      $user = Auth::user();
   		Validator::make($request->all(), [
		    'name' => 'required',
		    
		    'price' => 'required',
		    'kitsong' => 'required',
		    'kitimage' => 'required',
		    
		])->validate();
   		$addkit = new Musickit();
   		$addkit->name = $request->name;
   		$addkit->description = $request->description;
   		$addkit->price = $request->price;
   		$addkit->user_id = $request->userid;
   		if(is_array($request->file('kitsong')))
        {
         $kitaudios=array();
         foreach($request->file('kitsong') as $file) {
            $kitsonguniqueid=uniqid();
            $kitsong_name=$file->getClientOriginalName();
            $kitsongsize=$file->getSize();
            $kitsongextension=$file->getClientOriginalExtension();
            // $filename=Carbon::now()->format('Ymd').'_'.$uniqueid.'.'.$extension;
            $kitaudiopath=url('/storage/uploads/files/'.$kitsong_name.$kitsongextension);
            $kitsongpath=$file->storeAs('/uploads/files',$kitsong_name.$kitsongextension);
            array_push($kitaudios,$kitaudiopath);
         }
         $kit_all_audios=implode(",",$kitaudios);
         $addkit->kit_file = $kit_all_audios;
   		}
   		if($request->file('kitimage'))
        {
        	$kituniqueid=uniqid();
	        $kit_name=$request->file('kitimage')->getClientOriginalName();
	        $size=$request->file('kitimage')->getSize();
	        $extension=$request->file('kitimage')->getClientOriginalExtension();
	        // $filename=Carbon::now()->format('Ymd').'_'.$uniqueid.'.'.$extension;
	        $imagepath=url('/storage/uploads/images/'. $kit_name.$extension);
	        $imapath=$file->storeAs('/uploads/images', $kit_name.$extension);
	        
	         $addkit->artwork = $kit_name;
   		}
   		if($request->file('zipfile'))
        {
        	$zipuniqueid=uniqid();
	        $zip_name=$request->file('zipfile')->getClientOriginalName();
	        $zipsize=$request->file('zipfile')->getSize();
	        $zipextension=$request->file('zipfile')->getClientOriginalExtension();
	        // $filename=Carbon::now()->format('Ymd').'_'.$uniqueid.'.'.$extension;
	        $zippath=url('/storage/uploads/files/'.$zip_name.$zipextension);
	        $path=$file->storeAs('/uploads/files',$zip_name.$zipextension);
	        
	         $addkit->kit_zip = $zip_name;
   		}
      if($user->is_paid==0)
      {
        if($request->price){
          return redirect()->back()
                    ->with('warning',"Sorry You Can Not Upload Paid Music. This Feature Is Available In Premium Account. Upgrade Your Account <a href='{{url('upgrade',$packege->id)}}'> upgrade</a> ")
                    ->with('status', 'warning');
        }else{
          $addkit->save();
        }
      }else{
        $addkit->save();
      }
   		
   		return redirect('allkits')->with('success','Kit added successfully!');
   	}
    public function editKit($id)
    {
      $editkit = Musickit::find($id);
      return view('dashboard.seller.soundkits.editkit',compact('editkit'));
    }
    public function UpdateKit(Request $request,$id)
    {
      $user = Auth::user();
      Validator::make($request->all(), [
        'name' => 'required',
        'price' => 'required',
        'kit_file' => 'required',
        
        
      ])->validate();

      $updatekit = Musickit::find($id);
      $updatekit->name = $request->name;
      $updatekit->description = $request->description;
      $updatekit->price = $request->price;
      $updatekit->user_id = $request->userid;

      if(is_array($request->file('kit_file')))
        {
         $updatekitaudios=array();
         foreach($request->file('kit_file') as $kitfile) {
            $updatekituniqueid=uniqid();
            $updatekit_name=$kitfile->getClientOriginalName();
            $updatekitsongsize=$kitfile->getSize();
            $updatekitsongextension=$kitfile->getClientOriginalExtension();
            // $filename=Carbon::now()->format('Ymd').'_'.$uniqueid.'.'.$extension;
            $updatekitaudiopath=url('/storage/uploads/files/'.$updatekit_name.$updatekitsongextension);
            $updatekitsongpath=$kitfile->storeAs('/uploads/files',$updatekit_name.$updatekitsongextension);
            array_push($updatekitaudios,$updatekitaudiopath);
         }
         $update_kit_all_audios=implode(",",$updatekitaudios);

         $updatekit->kit_file = $update_kit_all_audios;
      }
      if($request->file('kitImage'))
        {
          $file = $request->file('kitImage');
          $kituniqueid=uniqid();
          $kit_name=$request->file('kitImage')->getClientOriginalName();

          $size=$request->file('kitImage')->getSize();
          $extension=$request->file('kitImage')->getClientOriginalExtension();
          // $filename=Carbon::now()->format('Ymd').'_'.$uniqueid.'.'.$extension;
          $imagepath=url('/storage/uploads/images/'. $kit_name);
          $imapath=$file->storeAs('/uploads/images', $kit_name);
          
           $updatekit->artwork = $kit_name;
      }
      if($request->file('Zip'))
        {
          $updatezipuniqueid=uniqid();
          $updatezip_name=$request->file('Zip')->getClientOriginalName();
          $updatezipsize=$request->file('Zip')->getSize();
          $updatezipextension=$request->file('Zip')->getClientOriginalExtension();
          // $filename=Carbon::now()->format('Ymd').'_'.$uniqueid.'.'.$extension;
          $updatezippath=url('/storage/uploads/files/'.$updatezip_name.$updatezipextension);
          // $updatepath=$file->storeAs('/uploads/files',$updatezip_name.$updatezipextension);
          $updatekit->kit_zip = $updatezip_name;
      }
      if($user->is_paid==0)
      {
        if($request->price){
          return redirect()->back()
                    ->with('warning',"Sorry You Can Not Upload Paid Music. This Feature Is Available In Premium Account. Upgrade Your Account <a href='{{url('upgrade',$packege->id)}}'> upgrade</a> ")
                    ->with('status', 'warning');
        }else{
           $updatekit->update();
        }
      }else{
         $updatekit->update();
      }
      
      
      return redirect('allkits')->with('success','Kit added successfully!');
    }
    public function deleteKit($id)
    {
      $deletekit=Musickit::find($id);
      $deletekit->delete();
       return redirect('allkits')->with('error','Kit Deleted successfully!');
    }

    //All Albums
    public function AllAlbums()
    {
      $user = Auth::user()->id;
      $getAlbums = DB::table('albums')->where('user_id',$user)->get();
      $getPlaylist = DB::table('playlists')->where('user_id',$user)->get();
      return view ('dashboard.seller.playlist_albums.allalbums',compact('getAlbums','getPlaylist'));
    }
    public function AddCollection(Request $request)
    {
      $user = Auth::user();
      if($request->collection_type=="beat_play"|| $request->collection_type=="song_play"){
        $addplaylist = new Playlist();
        $addplaylist->playlist_type = $request->collection_type;
        $addplaylist->playlist_name = $request->name;
         $addplaylist->user_id=$request->userid;
        $addplaylist->save();
        return redirect('allalbums')->with('success','PlayList added successfully!');
      }else{
        $addalbium = new Album();
        $addalbium->collection_type = $request->collection_type;
        $addalbium->album_name = $request->name;
        $addalbium->user_id=$request->userid;
         $addalbium->price=$request->price;
         if($request->file('albumimage'))
        {

          $adduniqueid=uniqid();
          $addalbum_name=$request->file('albumimage')->getClientOriginalName();
          $updatezipsize=$request->file('albumimage')->getSize();
          $updatezipextension=$request->file('albumimage')->getClientOriginalExtension();
          // $filename=Carbon::now()->format('Ymd').'_'.$uniqueid.'.'.$extension;
          $updatezippath=url('/storage/app/uploads/images/'.$addalbum_name.$updatezipextension);
           $updatepath=$request->file('albumimage')->storeAs('/uploads/images', $addalbum_name);
           $addalbium->album_image = $addalbum_name;
      }
      if($user->is_paid==0)
      {
        if($request->price){
          return redirect()->back()
                    ->with('warning',"Sorry You Can Not Upload Paid Music. This Feature Is Available In Premium Account. Upgrade Your Account <a href='{{url('upgrade',$packege->id)}}'> upgrade</a> ")
                    ->with('status', 'warning');
        }else{
           $addalbium->save();
        }
      }else{
         $addalbium->save();
      }
      
       
        return redirect('allalbums')->with('success','Album added successfully!');
      }
    }
     public function deletePlaylist($id)
    {
      $deletelist=Playlist::find($id);
      $deletelist->delete();
       return redirect('allalbums')->with('error','Playlist Deleted successfully!');
    }
    public function deleteAlbum($id)
    {
      $deletealbum=Album::find($id);
      $deletealbum->delete();
       return redirect('allalbums')->with('error','Album Deleted successfully!');
    }
    //My sales
    public function AllSales()
    {
      $user = Auth::user()->id;
      $allsales = DB::table('orders')->join('order_items','orders.id','=','order_items.order_id')->join('songs','order_items.item_id','=','songs.id')->where('user_id',$user)->get();
      
      return view('dashboard.seller.sales.allsales',compact('allsales'));
    }
    public function FilterSellerSales(Request $request)
    {
      $user = Auth::user()->id;
      $fromdate = $request->fromdate;
      $todate = $request->todate;
      $allsales = DB::table('orders')->join('order_items','orders.id','=','order_items.order_id')->join('songs','order_items.item_id','=','songs.id')->where('user_id',$user)->whereBetween('order_items.created_at',[$fromdate,$todate])->get();
      
      return view('dashboard.seller.sales.allsales',compact('allsales'));
    }
    public function EditPlaylist($id)
    {
      $editplaylist = Playlist::find($id);
      $songId = $editplaylist->song_id;
      $getPlayListSongs = DB::table('songs')->whereRaw("id IN ('.$songId')")->get();
      
      $allsongs = Song::all();
      return view('dashboard.seller.playlist_albums.editplaylist',compact('editplaylist','allsongs','getPlayListSongs'));
    }

    public function AddSongToPlaylist(Request $request,$id)
    {
      $addsong = Playlist::find($id);
      $addsong->song_id  = implode(',',$request->addsong);
      $addsong->update();
      return redirect('allalbums')->with('success','Song Added successfully!');

    }
    public function UpdatePlaylist(Request $request,$id)
    {

      $updateplaylist = Playlist::find($id);
      $updateplaylist->playlist_name = $request->name;
      $updateplaylist->playlist_type = $request->collection_type;
      $updateplaylist->update();
      return redirect('allalbums')->with('success','Playlist Updated successfully!');
    }
    public function UpdateAlbum(Request $request,$id)
    {

      $updateplaylist = Album::find($id);
      $updateplaylist->album_name = $request->name;
      $updateplaylist->collection_type = $request->collection_type;
      $updateplaylist->update();
      return redirect('allalbums')->with('success','Album Updated successfully!');
    }
    
    public function EditAlbum($id)
    {
      $allsongs = Song::all();
      $editalbum = Album::find($id);
      return view('dashboard.seller.playlist_albums.editalbum',compact('editalbum','allsongs'));
    }
    public function AlbumAddSong(Request $request,$id)
    {
      $addsongToAlbum = Album::find($id);
      $addsongToAlbum->song_id  = implode(',',$request->addsong);
      $addsongToAlbum->update();
      return redirect('allalbums')->with('success','Song Added successfully!');
    }
    public function downloadsong($id)
    {

      $songfind = Song::find($id);
      $getsongname = explode('/files/', $songfind->song_file);
      return response()->download('storage/app/uploads/files/'.$getsongname[1]);
      //return response()->download($songfind->song_file);
    }
    public function downloadfreesong($id)

    {
      $songfind = Song::find($id);
      $getsongname = explode('/files/', $songfind->song_file);
      return response()->download('storage/app/uploads/files/'.$getsongname[1]);
    }
    public function downloadfreebeat($id)

    {
      $beatfind = Beat::find($id);
      $getbeatname = explode('/files/', $beatfind->file);
      return response()->download('storage/app/uploads/files/'.$getbeatname[1]);
    }
    //ArtWOrk

    public function Artwork()
    {
      $user = Auth::user()->id;
      $allbeats = Beat::where('user_id',$user)->get();
      $allsongs = Song::where('user_id',$user)->get();
      $allartwork = Artwork::where('user_id',$user)->get();

      return view('dashboard.seller.artwork.artwork',compact('allartwork','allsongs','allbeats'));
    }
    public function AddArtwork(Request $request)
    {
      $storeArtwork = new Artwork();
      $storeArtwork->user_id = $request->userid;
      if($request->file('artwork'))
        {
          $artwork_id=uniqid();
          $artwork_name=$request->file('artwork')->getClientOriginalName();
          $artworksize=$request->file('artwork')->getSize();
          $artworkextension=$request->file('artwork')->getClientOriginalExtension();
          // $filename=Carbon::now()->format('Ymd').'_'.$uniqueid.'.'.$extension;
          $artworkpath=url('/uploads/images/'.$artwork_name);
          
          $artworkpath=$request->file('artwork')->storeAs('uploads/images',$artwork_name);
          
          $storeArtwork->image = $artwork_name;
      }
      $storeArtwork->save();
      return redirect('artwork')->with('success','Artwork added Successfully.');
    }

    public function AssignImage(Request $request)
    {
      
      if($request->assignbeat != null){
         if($request->file('art_image'))
          {
            $artwork_id=uniqid();
            $artwork_name=$request->file('art_image')->getClientOriginalName();
            $artworksize=$request->file('art_image')->getSize();
            $artworkextension=$request->file('art_image')->getClientOriginalExtension();
           // $filename=Carbon::now()->format('Ymd').'_'.$uniqueid.'.'.$extension;
            $artworkpath=url('/uploads/images/'.$artwork_name);
          
            $artworkpath=$request->file('art_image')->storeAs('uploads/images',$artwork_name);
          
            
            DB::table('beats')->where('id',$beatid)->update(['image'=>$request->art_image]);
           }
        
       
      }
      if($request->assignsong != null){
        $updatesong = Song::find($request->assignsong);
        $updatesong->image = $request->art_image;
        $updatesong->update();
      }
      return redirect('artwork')->with('success','Artwork Assigned Successfully.');
    
   } 
   //Voicetag
   public function VoiceTag()
   {
    $user = Auth::user()->id;
    $getVoiceTag= DB::table('voicetags')->where('user_id',$user)->first();
    return view('dashboard.seller.voicetags.allvoicetags',compact('getVoiceTag'));
   }
   public function AddVoiceTag(Request $request)
   {
    $addvoicetag =new Voicetag();
    $addvoicetag->user_id = $request->userid;
    if($request->file('voicetag'))
        {
          
          $voicetag_name=$request->file('voicetag')->getClientOriginalName();
          $voicetagsize=$request->file('voicetag')->getSize();
          $voicetagextension=$request->file('voicetag')->getClientOriginalExtension();
          // $filename=Carbon::now()->format('Ymd').'_'.$uniqueid.'.'.$extension;
          $voicetagpath=url('/uploads/files/'.$voicetag_name);
          
          $voicetagpath=$request->file('voicetag')->storeAs('uploads/files',$voicetag_name);
          
          $addvoicetag->voicetag_file = $voicetag_name;
      }
      $addvoicetag->save();
      return redirect('voicetag')->with('success','VoiceTag Added Successfully.');
   }
   public function DeleteTag($id)
   {
      $deleteVoice = Voicetag::find($id);
      $deleteVoice->delete();
      return redirect('voicetag')->with('Error','VoiceTag Deleted Successfully.');
   }
   //my accoun
   public function MyAccount($id)
   {
      $user = User::find($id);
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
   public function CreateStore()
   {
    $user = Auth::user()->id;
    $getstore = Music_store::where('user_id',$user)->get();
    return view('dashboard.seller.musicstore.index',compact('getstore'));
   }
   public function html5Index (){
    $user = Auth::user()->id;
    $configs = WidgetConfig::where('user_id',$user)->get();
    $defaultConfig = WidgetConfig::where('user_id',$user)->first();

    return view('dashboard.seller.musicstore.index', compact('configs','defaultConfig'));
   }
   public function AddStore(Request $request)
   {
    $addmusicstore = new Music_store();
    $addmusicstore->store_name =  $request->storename;
    $addmusicstore->user_id =$request->userid;
    $addmusicstore->store_url =$request->storeurl;
    $addmusicstore->save();
    return redirect()->back()->with('success','Your Store has Been Created Successfully!');

   }
   public function createCofig(Request $request){
    $config = new WidgetConfig();
    

    $config->name = $request->name;
    $userid = Auth::user()->id;
    $config->user_id = $userid;
    $config->width = 820;
    $config->height = 820;
    
    $config->save();
    $configs = WidgetConfig::where('user_id',$userid)->get();
    
    return redirect()->back()->with(['success'=>'Success! Configuration Created!','configs'=>$configs]);
   }
   public function updateCofig(Request $request){

    $config = WidgetConfig::find($request->configid);
    $config->name = $request->name;
    $userid = Auth::user()->id;
    $config->user_id = $userid;
    $config->width = $request->width??820;
    $config->height = $request->height??820;
    $config->update();
    $configs = WidgetConfig::where('user_id',$userid)->get();
    
    return redirect()->back()->with(['success'=>'Success! Configuration Updated!','configs'=>$configs]);
   }
   public function getWidgetHTML5($id, $configid = ''){
    $user = Auth::user();
    $userid = null;
    $uid = $id;
    if (!isset($uid)) {
      return view('dashboard.seller.musicstore.storewidget',['error'=>'Invalid code, please copy the code entirely without removing any data']);
    }
    $userconfig = WidgetConfig::where('uid','like','%'.$uid.'%')->get();
    if (count($userconfig) == 0) {
      return view('dashboard.seller.musicstore.storewidget',['error'=>'This user does not exist']);
    }
    $widgetuserid = $userconfig[0]->user_id;
    $widgetUser = User::find($widgetuserid);
    $allbeats = DB::table('beats')->where('user_id',$widgetuserid)->orderBy("created_at","desc")->paginate(10);
    return view('dashboard.seller.musicstore.storewidget',compact('widgetUser','allbeats'));
   }
   public function AccountSetting()
   {
      return view('dashboard.seller.accountsetting.index');
   }
   public function StoreSettings(Request $request)
   {
      Validator::make($request->all(), [
        'liveApiname' => 'required',
        'liveApiPassword' => 'required',
        'liveSecret' => 'required',
        'liveApiCertificate' => 'required',
        
      ])->validate();
      $storesetting = new Accountsetting();
      $storesetting->user_id = $request->userid;
      $storesetting->PAYPAL_LIVE_API_USERNAME = $request->liveApiname;
      $storesetting->PAYPAL_LIVE_API_PASSWORD = $request->liveApiPassword;
      $storesetting->PAYPAL_LIVE_API_SECRET = $request->liveSecret;
      $storesetting->PAYPAL_LIVE_API_CERTIFICATE = $request->liveApiCertificate;
      $storesetting->save();
      return redirect()->back()->with('success','Settings saved Successfully!');

   }
   //Subscription
   public function Subscribe()
   {
    
    $getpackege = DB::table('packeges')->whereRaw('packege_price > 0')->latest()->get();
    
      return view('dashboard.seller.subscription.index',compact('getpackege'));
   }

}
