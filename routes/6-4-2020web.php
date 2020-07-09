<?php



/*

|--------------------------------------------------------------------------

| Web Routes

|--------------------------------------------------------------------------

|

| Here is where you can register web routes for your application. These

| routes are loaded by the RouteServiceProvider within a group which

| contains the "web" middleware group. Now create something great!

|

*/



Route::get('/', function () {

    return view('welcome');

});

//Frontend

Route::get('/','FrontendController@index')->name('index');

Route::get('showlogin','FrontendController@ShowLogin')->name('showlogin');

Route::post('actlogin','FrontendController@PostLogin')->name('postlogin');

Route::get('actlogout','FrontendController@PostLogout')->name('getlogout');

Route::get('categories/{id}','FrontendController@Allcategories')->name('categories');

Route::get('error','FrontendController@ErrorPage')->name('error');

Route::get('signup','FrontendController@RegisterUser')->name('user.signup');

Route::get('completesignup','FrontendController@CompleteRegister')->name('user.register');

Route::post('getregister','FrontendController@PostRegister')->name('user.getRegister');

Route::get('downloadfree/{id}','SellerController@downloadfreesong')->name('song.downloadtest');
//Ajax
Route::get('getajaxrecord/{id}','FrontendController@GetAjax');
//My Account

Route::get('mysongs/{id}','FrontendController@MyPurchases')->name('user.purchases');
	Route::get('download/{id}','SellerController@downloadsong')->name('song.downloadtest');


//Cart

Route::get('cart','FrontendController@Cart')->name('cart');

Route::get('emailview','PaymentController@EmailView')->name('emailview');

Route::get('addcart/{id}','FrontendController@AddToCart')->name('cart.add');

Route::get('removecart/{id}','FrontendController@RemoveCart')->name('cart.destroy');

Route::post('updatecart','FrontendController@updateCart')->name('cart.update');

Route::get('checkout','FrontendController@CheckOut')->name('cart.checkout');

Route::get('packegecheckout/{id}','FrontendController@PackegeCheckout')->name('packege.checkout');

Route::post('packegepayment/{id}','PaymentController@PackegePayment')->name('packege.payment');

Route::get('paymentstatus', 'PaymentController@PaymentStatus');

//Route::get('emaildownlaod/{id}','FrontendController@DownloadEmailSong');

//Route::get('payment-status',array('as'=>'payment.status','uses'=>'PaymentController@paymentInfo'));

Route::post('payment', 'PaymentController@payWithpaypal')->name('payment');

Route::get('cancel', 'PaymentController@cancel')->name('payment.cancel');

Route::get('status', 'PaymentController@getPaymentStatus');

//Admin

Route::group(['middleware' => 'admin'], function () {

	Route::get('admin','AdminController@index')->name('admin.index');

	//Packege

	Route::get('adminpackege','AdminController@Packeges');

	Route::get('addpackege','AdminController@AddPackege')->name('packege.add');

	Route::post('storepackege','AdminController@StorePackege')->name('packege.store');

	Route::get('editpackege/{id}','AdminController@EditPackege')->name('packege.edit');

	Route::post('updatepackege/{id}','AdminController@UpdatePackege')->name('packege.update');

	Route::get('deletepackege/{id}','AdminController@DeletePackege')->name('packege.delete');

	//Payments

	Route::get('allpayments','AdminController@GetPayments')->name('admin.payments');

	//Moods

	Route::get('allmoods','AdminController@AllMoods')->name('admin.moods');

	Route::get('addmood','AdminController@AddMood')->name('mood.add');

	Route::post('storemood','AdminController@StoreMood')->name('mood.store');

	Route::get('editmood/{id}','AdminController@EditMood')->name('mood.edit');

	Route::post('updatemood/{id}','AdminController@UpdateMood')->name('mood.update');

	Route::get('deletemood/{id}','AdminController@DeleteMood')->name('mood.delete');

	//Generations

	Route::get('allgenerations','AdminController@AllGenerations')->name('admin.generation');

	Route::get('addgenerations','AdminController@AddGenerations')->name('generations.add');

	Route::post('storegenerations','AdminController@StoreGenerations')->name('generations.store');

	Route::get('editgenerations/{id}','AdminController@EditGenerations')->name('generations.edit');

	Route::post('updategenerations/{id}','AdminController@UpdateGenerations')->name('generations.update');

	Route::get('deletegenerations/{id}','AdminController@DeleteGenerations')->name('generations.delete');

	//Sales

	Route::get('adminsales','AdminController@AllSales')->name('admin.sales');



	//Users

	Route::get('allusers','AdminController@AllUsers')->name('admin.users');

	Route::get('deactiveusers/{id}','AdminController@DeActiveusers')->name('users.deactive');

	Route::get('activeusers/{id}','AdminController@Activateusers')->name('users.active');



	//My Account

	Route::get('myaccount/{id}','AdminController@MyAccount')->name('admin.profile');

	Route::post('updateaccount/{id}','AdminController@UpdateAccount')->name('profile.update');

});

Route::group(['middleware' => 'seller'], function () {

	Route::get('dashboard','SellerController@index')->name('seller.index');

	Route::get('allbeats','SellerController@allbeats')->name('seller.allbeats');

	Route::get('upload','SellerController@uploadBeats')->name('beat.upload');

	Route::get('uploadform','SellerController@ShowBeatForm')->name('beat.uploadform');

	Route::post('addbeat','SellerController@StoreBeat')->name('beat.store');

	Route::get('editbeat/{id}','SellerController@EditBeat')->name('beat.edit');

	Route::post('updatebeat/{id}','SellerController@UpdateBeat')->name('beat.update');

	Route::get('deletebeat/{id}','SellerController@deleteBeat')->name('beat.delete');

	//songs

	Route::get('allsongs','SellerController@AllSongs')->name('seller.allsongs');

	Route::get('songupload','SellerController@uploadSongs')->name('song.showupload');

	Route::get('songuploadform','SellerController@ShowSongForm')->name('songs.uploadform');

	Route::post('addsong','SellerController@StoreSong')->name('songs.store');

	Route::get('editsong/{id}','SellerController@EditSong')->name('song.edit');

	Route::post('updatesong/{id}','SellerController@UpdateSong')->name('song.update');

	Route::get('deletesong/{id}','SellerController@deleteSong')->name('song.delete');





	//Sound Kits

	Route::get('allkits','SellerController@Allkits')->name('seller.allkits');

	Route::get('uploadkits','SellerController@uploadKits')->name('kits.uploadform');

	Route::post('addkit','SellerController@StoreKits')->name('kit.add');

	Route::get('editkit/{id}','SellerController@editKit')->name('kit.edit');

	Route::post('updatekit/{id}','SellerController@UpdateKit')->name('kit.update');

	Route::get('deletekit/{id}','SellerController@deleteKit')->name('kitt.delete');

	//Playlists & Albums

	Route::get('allalbums','SellerController@AllAlbums')->name('seller.allalbums');

	Route::post('addcollection','SellerController@AddCollection')->name('collection.add');

	Route::get('deleteplaylist/{id}','SellerController@deletePlaylist')->name('playlist.delete');

	Route::get('deletealbum/{id}','SellerController@deleteAlbum')->name('album.delete');

	Route::get('editplaylist/{id}','SellerController@EditPlaylist')->name('playlist.edit');

	Route::post('addplaylistsong/{id}','SellerController@AddSongToPlaylist')->name('playlist.addsong');

	Route::post('updateplaylist/{id}','SellerController@UpdatePlaylist')->name('playlist.update');
	Route::post('updatealbum/{id}','SellerController@UpdateAlbum')->name('album.update');

	Route::get('editalbum/{id}','SellerController@EditAlbum')->name('album.edit');

	Route::post('albumaddsong/{id}','SellerController@AlbumAddSong')->name('album.addsong');

	//Mysales

	Route::get('allsales','SellerController@AllSales')->name('seller.sales');

	//Artwork

	Route::get('artwork','SellerController@Artwork')->name('seller.artwork');

	Route::post('addartwork','SellerController@AddArtwork')->name('artwork.add');

	Route::post('assignart','SellerController@AssignImage')->name('artwork.assign');

	//VoiceTag

	Route::get('voicetag','SellerController@VoiceTag')->name('seller.voicetag');

	Route::post('addvoicetag','SellerController@AddVoiceTag')->name('voicetag.add');

	Route::get('deletevoice/{id}','SellerController@DeleteTag')->name('voicetag.delete');



	// my account

	Route::get('myaccount/{id}','SellerController@MyAccount')->name('seller.profile');

	Route::post('updateaccount/{id}','SellerController@UpdateAccount')->name('profile.update');
	Route::get('craetestore', function () {
		
    return view('dashboard.seller.musicstore.index');

});


});

Auth::routes();



Route::get('/home', 'HomeController@index')->name('home');

