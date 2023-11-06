<?php
use Illuminate\Support\Facades\Route;
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
// Route::get('/', function () {
//   return view('welcome');
// })->middleware('auth');
Auth::routes();
Route::get('/config-cache', function() {
    Artisan::call('config:cache');
	Artisan::call('cache:clear');
	Artisan::call('route:clear');
	Artisan::call('view:clear');
    return '<h1>Clear Config cleared</h1>';
});
Route::group(['middleware' => ['web']], function ()
{
	Auth::routes(['verify'=>true]);
	Route::get('clear_cache', function () {
		\Artisan::call('cache:clear');
		dd("Cache is cleared");
	});
	Route::get('route_clear', function () {
		\Artisan::call('route:clear');
		dd("Route is cleared");
	});
	Route::get('view_clear', function () {
		\Artisan::call('view:clear');
		dd("View is cleared");
	});
	Route::get('config_cache', function () {
		\Artisan::call('config:cache');
		dd("Create a cache file for faster configuration loading");
	});
	// social login/register routes
	Route::get('/', 'Website\HomeController@landingPage')->name('homepage');
	//about page
	Route::get('/about', 'Website\AboutUsController@getAbout')->name('about');
	//service page
	Route::get('/service', 'Website\AboutUsController@getService')->name('service');
	//contact page
	Route::get('/contact', 'Website\AboutUsController@getContact')->name('contact');
	Route::post('contactStore', 'Website\ContactUsController@contactStore');
	//blog page
	Route::get('/blog', 'Website\AboutUsController@getBlog')->name('blog');
	Route::get('/detail/{id}','Website\AboutUsController@blogDetail');
	Route::post('commentStore', 'Website\AboutUsController@commentStore');
	//feature page
	Route::get('/feature', 'Website\AboutUsController@getFeature')->name('feature');
	//quote page
	Route::get('/quote', 'Website\AboutUsController@getQuote')->name('quote');
	Route::post('freeQuoteStore', 'Website\AboutUsController@store');
	//team page
	Route::get('/team', 'Website\AboutUsController@getTeam')->name('team');
	//testimonial page
	Route::get('/testimonial', 'Website\AboutUsController@getTestimonial')->name('testimonial');
	//CMS Pages
	//privacyPolicy page
	Route::get('/privacyPolicy', 'Website\AboutUsController@getPrivacyPolicy')->name('privacyPolicy');
	//terms and condition page
	Route::get('/terms', 'Website\AboutUsController@getTerms')->name('terms');
	//faq page
	Route::get('/faq', 'Website\AboutUsController@getFaq')->name('faq');

	Route::group(['middleware' => ['auth']], function()
	{
		Route::get('/home','Website\HomeController@landingPage');
		Route::group(['prefix' => 'admin', 'middleware' => ['role:admin']], function() {
			// Dashboard
			Route::get('/dashboard', 'DashboardController')->name('adminDashboard'); //Dashboard page
			Route::post('/dashboardFilterData', 'DashboardController@dashboardFilterData'); //Dashboard page
			// admin profile Routing
			Route::resource('/profile','ProfileController');
      		Route::post('/qrcode-scan', 'ProfileController@qrcodeScan');
			// User Routing
			Route::resource('/users','UserController');
			Route::post('/users/status-change', 'UserController@changeStatus');
			Route::get('/users/chat/{username}','UserController@usersChat')->name('users.chat');
			Route::get('/verified/{id}','UserController@verify');
			Route::resource('/reseller','ResellerController');
			//CMS Pages Routing
			Route::resource('/pages','CMSPagesController');
			Route::post('/pages/status-change','CMSPagesController@changeStatus');
			//FAQ Pages Routing
			Route::resource('/faq','FAQController');
			Route::post('/faq/status-change','FAQController@changeStatus');
			// Contact US
			Route::get('/contact-us-messages', 'Admin\ContactUSController@index')->name('adminContactUSDashboard');
			//header-footer
			Route::resource('/header_footer','HeaderFooterSettingsController');
			//ourTeam
			Route::resource('/ourTeam', 'OurTeamController');
			Route::get('/ourTeam/delete/{id}', 'OurTeamController@destroy');
			Route::post('/ourTeam/status-change', 'OurTeamController@changeStatus');
			//freequote
			Route::resource('/freeQuote', 'FreeQuoteController');
			//ourClientSay
			Route::resource('/ourClientSay', 'OurClientSayController');
			Route::get('/ourClientSay/delete/{id}', 'OurClientSayController@destroy');
			Route::post('/ourClientSay/status-change', 'OurClientSayController@changeStatus');
			//Category
			Route::resource('/categories', 'CategoryController');
			Route::get('/categories/delete/{id}', 'CategoryController@destroy');
			Route::get('/check-category-exist', 'CategoryController@categoryExist');
			Route::post('/categories/status-change', 'CategoryController@changeStatus')->name('offer-categories.change-status');
			//ourClientSay
			Route::resource('/blog', 'BlogController');
			Route::get('/blog/delete/{id}', 'BlogController@destroy');
			Route::post('/blog/status-change', 'BlogController@changeStatus');
		});
	});
});
