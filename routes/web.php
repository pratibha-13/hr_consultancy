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
	Route::get('/about', 'Website\AboutUsController@getAbout')->name('about');
	Route::get('/service', 'Website\AboutUsController@getService')->name('service');
	Route::get('/contact', 'Website\AboutUsController@getContact')->name('contact');
	Route::get('/blog', 'Website\AboutUsController@getBlog')->name('blog');
	Route::get('/detail', 'Website\AboutUsController@getBlogDetail')->name('detail');
	Route::get('/feature', 'Website\AboutUsController@getFeature')->name('feature');
	Route::get('/quote', 'Website\AboutUsController@getQuote')->name('quote');
	Route::get('/team', 'Website\AboutUsController@getTeam')->name('team');
	Route::get('/testimonial', 'Website\AboutUsController@getTestimonial')->name('testimonial');
	Route::post('contactStore', 'Website\AboutUsController@store');


	Route::get('/check-email-exsist', 'UserController@emailExsist');
	Route::get('confirm_email', 'UserController@confirmEmail');
	Route::get('/check-number-exsist', 'UserController@mobilenumberExsist');
	Route::get('/forgotPassword', 'Website\UserController@forgotPassword');
	Route::post('/updatePassword', 'Auth\ResetPasswordController@updatePassword')->name('updatePassword');

	// City , State , Country
	Route::post('/getCountry', 'CountryController@getCountry');
	Route::post('/getState', 'CountryController@getStates');
	Route::post('/getCity', 'CountryController@getCities');


	// Route::group(['middleware' => ['auth']], function()
	// {
	// 	Route::get('/home','Website\HomeController@landingPage');

	// 	Route::group(['prefix' => 'admin', 'middleware' => ['role:admin']], function() {

	// 		// Dashboard
	// 		Route::get('/dashboard', 'DashboardController')->name('adminDashboard'); //Dashboard page
	// 		Route::post('/dashboardFilterData', 'DashboardController@dashboardFilterData'); //Dashboard page

	// 		// admin profile Routing
	// 		Route::resource('/profile','ProfileController');
    //   		Route::post('/qrcode-scan', 'ProfileController@qrcodeScan');


	// 		// User Routing
	// 		Route::resource('/users','UserController');
	// 		Route::post('/users/status-change', 'UserController@changeStatus');
	// 		Route::get('/users/chat/{username}','UserController@usersChat')->name('users.chat');
	// 		Route::get('/verified/{id}','UserController@verify');

	// 		Route::resource('/reseller','ResellerController');

	// 		//CMS Pages Routing
	// 		Route::resource('/pages','CMSPagesController');
	// 		Route::post('/pages/status-change','CMSPagesController@changeStatus');

	// 		//FAQ Pages Routing
	// 		Route::resource('/faq','FAQController');
	// 		Route::post('/faq/status-change','FAQController@changeStatus');


	// 		//Roles Routing
	// 		// Route::resource('/roles','RoleController');
	// 		Route::resource('roles','Admin\RoleController');
	// 		Route::post('/permission/getPermissions', 'Admin\RoleController@getPermissions');

	// 		//Role Users Routing
	// 		// Route::resource('/roleuser','RoleUserController');
	// 		Route::resource('/roleuser','Admin\RoleUserController');

	// 		//banner
	// 		Route::resource('/banner','Admin\BannerController');
	// 		Route::post('/banner/status-change', 'Admin\BannerController@changeStatus')->name('offer-banner.change-status');

	// 		//Country/State/city
	// 		Route::resource('/countries','CountryController');
	// 		Route::post('/countries/status-change', 'CountryController@changeStatus');
	// 		Route::get('/countries/{id}', 'CountryController@show');
	// 		Route::get('/state/{id}/edit', 'CountryController@editState');
	// 		Route::post('/state/update', 'CountryController@updateState');
	// 		Route::get('/state/{id}', 'CountryController@showCity')->name('viewCityList');
	// 		Route::get('/city/{id}/edit', 'CountryController@editCity')->name('editCity');
	// 		Route::post('/city/update', 'CountryController@updateCity')->name('updateCity');
	// 		Route::get('/country/delete/{id}', 'CountryController@destroy');
	// 		Route::post('/city/new', 'CountryController@storeCity');
	// 		Route::post('/state/new', 'CountryController@storeState');
	// 		Route::get('/city/delete/{id}', 'CountryController@deleteCity');
	// 		Route::post('/city/status-change', 'CountryController@cityChangeStatus');
	// 		Route::post('/state/status-change', 'CountryController@stateChangeStatus');
	// 		Route::post('/countries/status-change', 'CountryController@countryChangeStatus');
	// 		Route::get('/state/delete/{id}', 'CountryController@deleteState');

	// 		// Contact US
	// 		Route::get('/contact-us-messages', 'Admin\ContactUSController@index')->name('adminContactUSDashboard');

	// 		//Category
	// 		Route::resource('/categories', 'CategoryController');
	// 		Route::get('/categories/delete/{id}', 'CategoryController@destroy');
	// 		Route::get('/check-category-exist', 'CategoryController@categoryExist');
	// 		Route::post('/categories/status-change', 'CategoryController@changeStatus')->name('offer-categories.change-status');

	// 		//Sub Category
	// 		Route::resource('/sub-categories', 'SubCategoryController');
	// 		Route::get('/sub-categories/delete/{id}', 'SubCategoryController@destroy');
	// 		Route::post('/sub-categories/status-change', 'SubCategoryController@changeStatus');
	// 	});
	// });
});
