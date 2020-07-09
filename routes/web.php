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

Route::get('downloadfree/{id}','SellerController@downloadfreesong')->name('song.download');
Route::get('playlist','FrontendController@GetPlaylist')->name('playlists');
Route::get('playlist/{id}','FrontendController@SinglePlayList')->name('playlist');

Route::get('downloadfreebeat/{id}','SellerController@downloadfreebeat')->name('beat.download');
Route::get('downloadfreestem/{id}','SellerController@downloadfreestem')->name('stem.download');
//Ajax
Route::get('getajaxrecord/{id}','FrontendController@GetAjax');
Route::get('getajaxbeatsrecord/{id}','FrontendController@GetAjaxBeats');
Route::get('getmoodsajaxrecord/{id}','FrontendController@GetAjaxMoodsRecord');
Route::get('getajaxbeats/{id}','FrontendController@GetAjaxAllBeats');
Route::get('getajaxpricedata','FrontendController@PriceFilterBeats');
Route::get('pricefilter','FrontendController@PriceFilter');
Route::get('getfreesongs/{id}','FrontendController@GetFreeSongs');
//verify user
Route::get('/user/verify/{token}', 'Auth\RegisterController@verifyUser');
//My Account

Route::get('mysongs/{id}','FrontendController@MyPurchases')->name('user.purchases');
	Route::get('download/{id}','SellerController@downloadsong')->name('song.downloadtest');


//Cart

Route::get('cart','FrontendController@Cart')->name('cart');

Route::get('emailview','PaymentController@EmailView')->name('emailview');
Route::get('upgradationemailview','PaymentController@UpdgradationEMail')->name('upgradationemailview');
Route::get('addcart/{id}','FrontendController@AddToCart')->name('cart.add');
Route::post('addcartbeat/{id}','FrontendController@AddToCartBeat')->name('cart.addbeat');
Route::get('addstemtocart/{id}','FrontendController@AddToCartStem')->name('cart.addstem');
Route::get('removecart/{id}','FrontendController@RemoveCart')->name('cart.destroy');

Route::post('updatecart','FrontendController@updateCart')->name('cart.update');

Route::get('itemscheckout','FrontendController@CheckOut')->name('cart.checkout');
Route::get('checkout','FrontendController@CheckOutStem')->name('cart.checkoutstem');
Route::get('packegecheckout/{id}','FrontendController@PackegeCheckout')->name('packege.checkout');

Route::post('packegepayment/{id}','PaymentController@PackegePayment')->name('packege.payment');

Route::get('paymentstatus', 'PaymentController@PaymentStatus');
Route::get('beats','FrontendController@GetBeats')->name('beats.all');
//Route::get('emaildownlaod/{id}','FrontendController@DownloadEmailSong');
//search
Route::post('getajaxsearch','FrontendController@SearchData');
Route::post('mainsearch','FrontendController@Search')->name('main.search');
//Route::get('payment-status',array('as'=>'payment.status','uses'=>'PaymentController@paymentInfo'));
//single album
Route::get('album/{id}','FrontendController@SingleAlbum')->name('album.show');
Route::post('payment', 'PaymentController@payWithpaypal')->name('payment');
Route::post('stempayment', 'PaymentController@StemPayment')->name('paymentstem');
Route::get('cancel', 'PaymentController@cancel')->name('payment.cancel');
Route::get('stemstatus', 'PaymentController@getStemPaymentStatus');
Route::get('status', 'PaymentController@getPaymentStatus');
//comment
Route::post('addcomment','FrontendController@Comment')->name('comment.add');
Route::post('comment','FrontendController@AddComment')->name('playlistcomment.add');
//email
Route::get('paidemail','FrontendController@PaidEmail')->name('paid.email');
//Admin

Route::group(['middleware' => 'admin'], function () {

	Route::get('admin','AdminController@index')->name('admin.index');

	//Packege

	Route::get('adminpackege','AdminController@Packeges')->name('packege.all');;

	Route::get('addpackege','AdminController@AddPackege')->name('packege.add');

	Route::post('storepackege','AdminController@StorePackege')->name('packege.store');

	Route::get('editpackege/{id}','AdminController@EditPackege')->name('packege.edit');

	Route::post('updatepackege/{id}','AdminController@UpdatePackege')->name('packege.update');

	Route::get('deletepackege/{id}','AdminController@DeletePackege')->name('packege.delete');

	//Payments

	Route::get('allpayments','AdminController@GetPayments')->name('admin.payments');
	Route::get('systempayments','AdminController@SystemPayments')->name('system.packeges');
	Route::post('buyerpayments','AdminController@GetSystemPayments')->name('payment.filter');
	Route::get('getajaxpayments/{id}','AdminController@GetSpecificPayment');
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
	Route::get('getajaxsales/{id}','AdminController@GetSpecificSale');
	Route::post('filtersales','AdminController@FilterSales')->name('sales.filter');

	//Users

	Route::get('allusers','AdminController@AllUsers')->name('admin.users');

	Route::get('deactiveusers/{id}','AdminController@DeActiveusers')->name('users.deactive');

	Route::get('activeusers/{id}','AdminController@Activateusers')->name('users.active');

	//Account
	

	//My Account

	Route::get('myaccount','AdminController@MyAccount')->name('admin.profile');

	Route::post('updateadminaccount/{id}','AdminController@UpdateAccount')->name('adminprofile.update');
	//Comments
	Route::get('comments','AdminController@Comments')->name('comments.all');
	Route::get('approvecomments/{id}','AdminController@ApproveComments')->name('comment.approve');
	Route::get('disapprovecomments/{id}','AdminController@DisapproveComments')->name('comment.disapprove');

});

Route::group(['middleware' => 'seller'], function () {
	
	Route::post('beat-sortable','SellerController@updateOrderBeat');
	Route::get('dashboard','SellerController@index')->name('seller.index');

	Route::get('seller/beats','SellerController@allbeats')->name('seller.allbeats');

	Route::get('upload','SellerController@uploadBeats')->name('beat.upload');

	Route::get('uploadform','SellerController@ShowBeatForm')->name('beat.uploadform');

	Route::post('addbeat','SellerController@StoreBeat')->name('beat.store');

	Route::get('seller/beat/{id}/edit','SellerController@EditBeat')->name('beat.edit');

	Route::post('updatebeat/{id}','SellerController@UpdateBeat')->name('beat.update');

	Route::get('deletebeat/{id}','SellerController@deleteBeat')->name('beat.delete');

	//songs
	Route::post('song-sortable','SellerController@updateOrderSong');
	Route::get('seller/songs','SellerController@AllSongs')->name('seller.allsongs');

	Route::get('songupload','SellerController@uploadSongs')->name('song.showupload');

	Route::get('songuploadform','SellerController@ShowSongForm')->name('songs.uploadform');

	Route::post('addsong','SellerController@StoreSong')->name('songs.store');

	Route::get('seller/song/{id}/edit','SellerController@EditSong')->name('song.edit');

	Route::post('updatesong/{id}','SellerController@UpdateSong')->name('song.update');

	Route::get('deletesong/{id}','SellerController@deleteSong')->name('song.delete');

	//Trackouts
	Route::get('stems','SellerController@AllStems')->name('seller.stem');
	Route::get('uploadstems','SellerController@UploadStems')->name('stem.upload');
	Route::post('storestems','SellerController@StoreStems')->name('stem.add');
	Route::get('deletestems/{id}','SellerController@DeleteStems')->name('stem.delete');
	Route::get('editstems/{id}','SellerController@EditStems')->name('stem.edit');
	Route::post('updatestems/{id}','SellerController@UpdateStems')->name('stem.update');

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
	Route::get('removesong/{songid}/{albumid}','SellerController@RemoveSong')->name('album.removesong');
	Route::get('removeplaylistsong/{songid}/{playlistid}','SellerController@RemovePlaylistSong')->name('playlist.removesong');
	Route::get('editalbum/{id}','SellerController@EditAlbum')->name('album.edit');

	Route::post('albumaddsong/{id}','SellerController@AlbumAddSong')->name('album.addsong');

	//Mysales
	Route::post('getsales','SellerController@FilterSellerSales')->name('seller.filter');
	Route::get('allsales','SellerController@AllSales')->name('seller.sales');

	//Artwork

	Route::get('artwork','SellerController@Artwork')->name('seller.artwork');

	Route::post('addartwork','SellerController@AddArtwork')->name('artwork.add');

	Route::post('assignart','SellerController@AssignImage')->name('artwork.assign');

	//VoiceTag

	Route::get('voicetag','SellerController@VoiceTag')->name('seller.voicetag');

	Route::post('addvoicetag','SellerController@AddVoiceTag')->name('voicetag.add');

	Route::get('deletevoice/{id}','SellerController@DeleteTag')->name('voicetag.delete');
	//Music Store
	Route::post('addstore','SellerController@AddStore')->name('store.add');
	//Brand Logo
	Route::get('store/widget/settings','SellerController@storewidgetsettings')->name('store.widget.settings');
	Route::post('storebrand','SellerController@StoreBrand')->name('brand.store');
	Route::post('storebanner','SellerController@StoreBanner')->name('banner.store');
	Route::get('accountsettings','SellerController@AccountSetting')->name('account.setting');
	Route::post('storesetting','SellerController@StoreSettings')->name('setting.store');
	// my account
	Route::get('selleraccount','SellerController@MyAccount')->name('seller.profile');
	

	Route::post('updateaccount/{id}','SellerController@UpdateSellerAccount')->name('sellerprofile.update');
	Route::get('stores/html5', 'SellerController@html5Index');
	Route::post('store/config/new', 'SellerController@createCofig');
	Route::post('store/config/update', 'SellerController@updateCofig');
	//Subscription
	Route::get('subscription','SellerController@Subscribe')->name('subscription');
	Route::post('upgrade/{id}','PaymentController@UpgradePackege');
	Route::get('upgradepkg/{expiry}/{token}','PaymentController@GetPakegeDetail');
	Route::get('packegepaymentstatus', 'PaymentController@PackegePaymentStatus');
	Route::get('updateuserpackege/{packege_id}/{userid}','PaymentController@RenewPackege')->name('renewpkg');
	Route::get('renewpaymentstatus','PaymentController@RenewPackegePayment');
	Route::get('upgradepaymentstatus/{id}', 'PaymentController@UpgradePaymentStatus');
	Route::get('stores/demostore', function () {
		
    	return view('dashboard.seller.musicstore.store');

	});

});

Auth::routes();

Route::get('widgets/html5/{id}/{configid?}', 'SellerController@getWidgetHTML5');

Route::get('register/{id}' ,'Auth\RegisterController@registeruser');
Route::get('/home', 'HomeController@index')->name('home');

