<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/







Route::get('commentform', function()
{
    return view('admin.test');
});



/*Route::group(['prefix'=>'home'], function()
{
    Route::get('/index', ['as' => 'home.index', 'uses' => 'WEB\HomeController@index']);
});*/





/*Route::get('/', function () {
    return view('welcome');
});*/

Route::get('/', 'WEB\AngularController@serveApp');

Route::get('/unsupported-browser', 'WEB\AngularController@unsupported');

Route::get('/data', 'WEB\DataController@index');



Route::post('/api/register', ['as' => 'api.register', 'uses' => 'API\AuthController@register']);
//Route::post('/login', ['as' => 'api.login', 'uses' => 'API\AuthController@login']);


Route::post('/api/login', function(Request $request) {

    //return Response::json(Authorizer::issueAccessToken());});
    //return Response::json(Authorizer::issueAccessToken());
    $message = "Login successfully";

    if(Authorizer::issueAccessToken()){

        $user_logged= \App\User::where('email',$request::input('username'))->get();

        return Response::json([
                'code' => '200',
                'token' =>Authorizer::issueAccessToken(),
                'data' => [
                'message' => $message,
                'user' => $user_logged
            ]]);
    }else{

        return Response::json(Authorizer::issueAccessToken());

    }



});

//Route::get('/car-brands', ['as' => 'api.car-brands.index', 'uses' => 'API\CarBrandController@CarBands']);

Route::group(['prefix'=>'api','before' => 'oauth'], function()
{
//    Route::get('/posts',  'PostController@index');


    //Route::get('/register', ['as' => 'api.register', 'uses' => 'API\AuthController@register']);

});


Route::group(['prefix'=>'api'], function()
{
    //vehicles
    Route::any('/car-brands', ['as' => 'api.car-brands.index', 'uses' => 'API\VehicleControllerAPI@CarBrands']);
    Route::any('/car-years', ['as' => 'api.car-years.index', 'uses' => 'API\VehicleControllerAPI@CarYears']);
    Route::any('/SaveAngular', ['as' => 'api.car-years.ind', 'uses' => 'API\VehicleControllerAPI@SaveAngular']);
    Route::any('/car-models-trims', ['as' => 'api.car-models-trims.index', 'uses' => 'API\VehicleControllerAPI@CarModelsTrims']);

    //servies
    Route::any('/service-categories','API\ServiceControllerAPI@ServiceCategories');
    Route::any('/category-services','API\ServiceControllerAPI@CategoryServices');


});









//Route::group(['prefix' => 'api', 'middleware' => 'isAdmin'], function() {

/*Route::group(['prefix' => 'api'], function() {

  Route::get('/cars', ['as' => 'api.cars.index', 'uses' => 'API\CarController@index']);
});*/






// Authentication routes...
/*Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');*/

// Registration routes...
/*Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');
*/

Route::controllers([
    'password' => 'Auth\PasswordController',
]);
// ################################## PUBLIC WEBSITE BELOW   ################################################################
//
//

Route::get('/', ['as' => 'home.index' ,'uses' => 'WEB\HomeController@index']);

Route::get('/administrator', function () {
    return view('admin.layouts.master');
});
Route::resource('items', 'ItemController');

Route::get('/items-home', function () {
    return view('admin.items.home');
});

Route::get('/items-dirPagination', function () {
    return view('admin.items.dirPagination');
});

//Route::get('/items-dirPagination', ['as' => 'items.dirPagination', 'uses' => 'ItemController@dirPagination']);

Route::get('/items-views', function () {
    return view('admin.items.items_view');
});




Route::get('/auth/register', ['as' => 'auth.register.index', 'uses' => 'Auth\AuthController@register']);
Route::post('/auth/register', ['as' => 'auth.register.store', 'uses' => 'Auth\AuthController@storeRegister']);

Route::get('/facebook-login', ['as' => 'facebook.login', 'uses' => 'Auth\AuthController@LoginFacebook']);

Route::get('/auth/login', ['as' => 'auth.login.index', 'uses' => 'Auth\AuthController@login']);
Route::post('/auth/login', ['as' => 'auth.login', 'uses' => 'Auth\AuthController@authenticate']);
Route::get('/auth/logout', ['as' => 'auth.logout', 'uses' => 'Auth\AuthController@destroy']);


Route::get('/mechanics-join-us', ['as' => 'mechanic.join-us', 'uses' => 'WEB\HomeController@MechanicJoinUs']);
Route::post('/mechanics-join-us', ['as' => 'mechanic.join-us.submit', 'uses' => 'WEB\HomeController@MechanicJoinUsSubmit']);



Route::get('/how-it-works', ['as' => 'home.how-it-works' ,'uses' => 'WEB\HomeController@HowItWorks']);
Route::get('/reviews', ['as' => 'home.reviews' ,'uses' => 'WEB\HomeController@Reviews']);
Route::get('/services', ['as' => 'home.services' ,'uses' => 'WEB\HomeController@services']);
Route::get('/pricing', ['as' => 'home.pricing' ,'uses' => 'WEB\HomeController@Pricing']);

Route::get('/Advice', ['as' => 'home.advice' ,'uses' => 'WEB\HomeController@Advice']);
Route::get('/contact', ['as' => 'home.contact' ,'uses' => 'WEB\HomeController@Contact']);
Route::get('/quotation', ['as' => 'home.quotation' ,'uses' => 'WEB\HomeController@Quotation']);
Route::get('/about-us', ['as' => 'home.about-us' ,'uses' => 'WEB\HomeController@AboutUs']);
Route::get('/faqs', ['as' => 'home.faqs' ,'uses' => 'WEB\HomeController@Faqs']);
Route::get('/privacy-policy', ['as' => 'home.privacy-policy' ,'uses' => 'WEB\HomeController@PrivacyPolicy']);



Route::get('/terms-and-conditions', ['as' => 'home.terms-and-conditions' ,'uses' => 'WEB\HomeController@TermsConditions']);



// ################################## CUSTOMER PART BELOW   ################################################################

Route::group(['prefix' => 'customer', 'middleware' => 'isCustomer'], function() {

//    Route::get('/ddashboard', ['as' => 'admin.dashboard.index', 'uses' => 'Admin\DashboardController@index']);
      Route::get('/dashboard', ['as' => 'customer.dashboard', 'uses' => 'WEB\CustomerController@index']);
      Route::get('/account-settings', ['as' => 'customer.account-settings', 'uses' => 'WEB\CustomerController@AccountSettings']);
      Route::get('/help', ['as' => 'customer.help', 'uses' => 'WEB\CustomerController@Help']);

    Route::post('/personal-info-update', ['as' => 'customer.update.personal-info' ,'uses' => 'WEB\CustomerController@PersonalInfoUpdate']);
    Route::post('/profile-picture-update', ['as' => 'customer.update.profile-picture' ,'uses' => 'WEB\CustomerController@ProfilePictureUpdate']);
    Route::post('/profile-change-password', ['as' => 'customer.update.password' ,'uses' => 'WEB\CustomerController@ChangePassword']);
/*    Route::post('/personal-info-update', function(){
        return "asdasdas";
    });*/

/*    Route::get('/dashboard',function(){
        return "asdasdas";
    });*/
});



// ################################## CUSTOMER PART BELOW   ################################################################

Route::group(['prefix' => 'mechanics'], function() {

    Route::get('/', ['as' => 'mechanics.index' ,'uses' => 'WEB\HomeController@MechanicsIndex']);
    Route::get('/profile/{id}/{title}',['as'=>'mechanics.profile','uses'=>'WEB\HomeController@MechanicProfile']);
    Route::get('/{mechanic_id}/review/new', ['as' => 'mechanics.review-mechanic', 'uses' => 'WEB\CustomerController@NewReview']);
    Route::post('/review/add-review', ['as' => 'mechanics.review-mechanic-post', 'uses' => 'WEB\CustomerController@AddReview']);

    //Route::get('/profile', ['as' => 'mechanic.profile' ,'uses' => 'WEB\HomeController@MechanicProfile']);

});


//##################### PRICING
Route::get('/pricing/service-categories','Admin\PricingControllerAdmin@IndexServiceCategories');
Route::any('/pricing/category-services/{s_category_id}','Admin\PricingControllerAdmin@IndexCategoryServices');
Route::any('/pricing/service-optionals/{s_id}','Admin\PricingControllerAdmin@IndexServiceOptionals');
Route::any('/pricing/service-brands/{s_id}','Admin\PricingControllerAdmin@IndexServiceBrands');
Route::any('/pricing/service-brand-types/{s_brand_id}','Admin\PricingControllerAdmin@IndexServiceBrandTypes');


Route::any('/pricing/vehicle-brands/','Admin\PricingControllerAdmin@IndexVehicleBrands');
Route::any('/pricing/brand-years/{brand_id}','Admin\PricingControllerAdmin@IndexBrandYears');
Route::any('/pricing/vehicle-models/{brand_id}/{year_id}','Admin\PricingControllerAdmin@IndexVehicleModels');



Route::get('/Pricing/list', ['as' => 'admin.pricing.view', 'uses' => 'Admin\PricingControllerAdmin@PricingView']);
Route::post('/Pricing/search', ['as' => 'admin.pricing.search', 'uses' => 'Admin\PricingControllerAdmin@PricingSearch']);
Route::get('/Pricing/new', ['as' => 'admin.pricing.new', 'uses' => 'Admin\PricingControllerAdmin@PricingNew']);
Route::post('/Pricing/add', ['as' => 'admin.pricing.add', 'uses' => 'Admin\PricingControllerAdmin@AddPricing']);
Route::post('/Pricing/updatestatus', ['as' => 'admin.pricing.updatestatus', 'uses' => 'Admin\PricingControllerAdmin@PricingUpdateStatus']);


Route::post('/vehicle/search', ['as' => 'admin.vehicle.search', 'uses' => 'Admin\VehicleControllerAdmin@VehicleSearch']);

// ################################## ADMIN PART BELOW   ################################################################


/*Route::group(['prefix' => 'admin'], function() {

    Route::get('/index', ['as' => 'admin.index', 'uses' => 'WEB\CarController@index']);
});*/

Route::get('/vehicles/list', ['as' => 'admin.vehicle.list', 'uses' => 'Admin\VehicleControllerAdmin@VehiclesList']);

Route::group(['prefix' => 'admin', 'middleware' => 'isAdmin'], function() {


    Route::get('/dashboard', ['as' => 'admin.dashboard', 'uses' => 'Admin\AdminController@index']);

//Customer management
    Route::get('/customers-list', ['as' => 'admin.customer.index', 'uses' => 'Admin\CustomerControllerAdmin@Index']);
    Route::post('/customers/updatestatus', ['as' => 'admin.customer.updatestatus', 'uses' => 'Admin\CustomerControllerAdmin@UpdateStatus']);
    Route::get('/customers/{id}/edit', ['as' => 'admin.customer.edit', 'uses' => 'Admin\CustomerControllerAdmin@Edit']);
    Route::patch('/customers/{id}', ['as' => 'admin.customer.update', 'uses' => 'Admin\CustomerControllerAdmin@Update']);
    Route::delete('/customers/{id}/delete', ['as' => 'admin.customer.destroy', 'uses' => 'Admin\CustomerControllerAdmin@Destroy']);
    Route::get('/customers/search', ['as' => 'admin.customer.search', 'uses' => 'Admin\CustomerControllerAdmin@Search']);


//Mechanic management
    Route::get('/mechanics-list', ['as' => 'admin.mechanic.index', 'uses' => 'Admin\MechanicControllerAdmin@Index']);
    Route::post('/mechanics/updatestatus', ['as' => 'admin.mechanic.updatestatus', 'uses' => 'Admin\MechanicControllerAdmin@UpdateStatus']);
    Route::get('/mechanics/{id}/edit', ['as' => 'admin.mechanic.edit', 'uses' => 'Admin\MechanicControllerAdmin@Edit']);
    Route::patch('/mechanics/{id}', ['as' => 'admin.mechanic.update', 'uses' => 'Admin\MechanicControllerAdmin@Update']);
    Route::delete('/mechanics/{id}/delete', ['as' => 'admin.mechanic.destroy', 'uses' => 'Admin\MechanicControllerAdmin@Destroy']);
    Route::get('/mechanics/search', ['as' => 'admin.mechanic.search', 'uses' => 'Admin\MechanicControllerAdmin@Search']);


//################   Services Management

    //Service Category

    Route::get('/service-categories-list', ['as' => 'admin.service.categories.index', 'uses' => 'Admin\ServiceControllerAdmin@IndexCategories']);
    Route::post('/service-categories-list/updatestatus', ['as' => 'admin.service.categories.updatestatus', 'uses' => 'Admin\ServiceControllerAdmin@UpdateStatusCategory']);
    Route::get('/service-categories/{id}/edit', ['as' => 'admin.service.categories.edit', 'uses' => 'Admin\ServiceControllerAdmin@EditCategory']);
    Route::patch('/service-categories/{id}/update', ['as' => 'admin.service.categories.update', 'uses' => 'Admin\ServiceControllerAdmin@UpdateCategory']);
    Route::delete('/service-categories/{id}/delete', ['as' => 'admin.service.categories.destroy', 'uses' => 'Admin\ServiceControllerAdmin@DestroyCategory']);
    Route::get('/service-categories/search', ['as' => 'admin.service.categories.search', 'uses' => 'Admin\ServiceControllerAdmin@SearchCategory']);
    Route::get('/service-categories/new', ['as' => 'admin.service.categories.new', 'uses' => 'Admin\ServiceControllerAdmin@NewCategory']);
    Route::post('/service-categories/add', ['as' => 'admin.service.categories.add', 'uses' => 'Admin\ServiceControllerAdmin@AddCategory']);
    Route::get('/service-categories/{id}/services', ['as' => 'admin.service.categories.services', 'uses' => 'Admin\ServiceControllerAdmin@CategoryServices']);
    Route::get('/service-categories-list/{id}', ['as' => 'admin.service.category.index', 'uses' => 'Admin\ServiceControllerAdmin@IndexCategory']);




    //Services
    Route::get('/services-list', ['as' => 'admin.service.index', 'uses' => 'Admin\ServiceControllerAdmin@IndexServices']);
    Route::post('/services-list/updatestatus', ['as' => 'admin.service.updatestatus', 'uses' => 'Admin\ServiceControllerAdmin@UpdateStatusService']);
    Route::get('/services/{id}/edit', ['as' => 'admin.service.edit', 'uses' => 'Admin\ServiceControllerAdmin@EditService']);
    Route::get('/services/{id}/add-optionals', ['as' => 'admin.service.add-optionals', 'uses' => 'Admin\ServiceControllerAdmin@AddOptionals']);
    Route::post('/services/{id}/save-optionals', ['as' => 'admin.service.save-optionals', 'uses' => 'Admin\ServiceControllerAdmin@SaveOptionals']);
    Route::get('/services/{id}/view-optionals', ['as' => 'admin.service.view-optionals', 'uses' => 'Admin\ServiceControllerAdmin@ViewServiceOptionals']);
    Route::patch('/services/{id}/update', ['as' => 'admin.service.update', 'uses' => 'Admin\ServiceControllerAdmin@UpdateService']);
    Route::delete('/services/{id}/delete', ['as' => 'admin.service.destroy', 'uses' => 'Admin\ServiceControllerAdmin@DestroyService']);
    Route::get('/services/search', ['as' => 'admin.service.search', 'uses' => 'Admin\ServiceControllerAdmin@SearchService']);

    Route::get('/services/new', ['as' => 'admin.service.new', 'uses' => 'Admin\ServiceControllerAdmin@NewService']);
    Route::post('/services/add', ['as' => 'admin.service.add', 'uses' => 'Admin\ServiceControllerAdmin@AddService']);


    //Service brands

    Route::get('/service-brands-list', ['as' => 'admin.service-brand.index', 'uses' => 'Admin\ServiceControllerAdmin@IndexServiceBrands']);
    Route::post('/service-brands-list/updatestatus', ['as' => 'admin.service-brand.updatestatus', 'uses' => 'Admin\ServiceControllerAdmin@UpdateStatusServiceBrand']);
    Route::get('/service-brands/{id}/edit', ['as' => 'admin.service-brand.edit', 'uses' => 'Admin\ServiceControllerAdmin@EditServiceBrand']);
    Route::patch('/service-brands/{id}/update', ['as' => 'admin.service-brand.update', 'uses' => 'Admin\ServiceControllerAdmin@UpdateServiceBrand']);
    Route::delete('/service-brands/{id}/delete', ['as' => 'admin.service-brand.destroy', 'uses' => 'Admin\ServiceControllerAdmin@DestroyServiceBrand']);
    Route::get('/service-brands/search', ['as' => 'admin.service-brand.search', 'uses' => 'Admin\ServiceControllerAdmin@SearchServiceBrand']);

    Route::get('/service-brands/new', ['as' => 'admin.service-brand.new', 'uses' => 'Admin\ServiceControllerAdmin@NewServiceBrand']);
    Route::post('/service-brands/add', ['as' => 'admin.service-brand.add', 'uses' => 'Admin\ServiceControllerAdmin@AddServiceBrand']);

    Route::get('/service-brands/{id}/services', ['as' => 'admin.service-brand.services', 'uses' => 'Admin\ServiceControllerAdmin@BrandServices']);


    //brand's Services

    Route::get('/service-brands/services-list', ['as' => 'admin.service-brand-services.index', 'uses' => 'Admin\ServiceControllerAdmin@IndexBrandServices']);
    Route::post('/service-brand-services-list/updatestatus', ['as' => 'admin.service-brand-services.updatestatus', 'uses' => 'Admin\ServiceControllerAdmin@UpdateStatusBrandService']);
    Route::get('/service-brand-services/{id}/edit', ['as' => 'admin.service-brand-services.edit', 'uses' => 'Admin\ServiceControllerAdmin@EditBrandService']);
    Route::patch('/service-brand-services/{id}/update', ['as' => 'admin.service-brand-services.update', 'uses' => 'Admin\ServiceControllerAdmin@UpdateBrandService']);
    Route::delete('/service-brand-services/{id}/delete', ['as' => 'admin.service-brand-services.destroy', 'uses' => 'Admin\ServiceControllerAdmin@DestroyBrandService']);
    Route::get('/service-brand-services/search', ['as' => 'admin.service-brand-services.search', 'uses' => 'Admin\ServiceControllerAdmin@SearchBrandService']);

    Route::get('/service-brand-services/new', ['as' => 'admin.service-brand-services.new', 'uses' => 'Admin\ServiceControllerAdmin@NewBrandService']);
    Route::post('/service-brand-services/add', ['as' => 'admin.service-brand-services.add', 'uses' => 'Admin\ServiceControllerAdmin@AddBrandService']);




    // Service Optionals
    Route::get('/optional-services-list', ['as' => 'admin.optional-services.index', 'uses' => 'Admin\ServiceControllerAdmin@IndexOptionalServices']);
    Route::post('/optional-services-list/updatestatus', ['as' => 'admin.optional-services.updatestatus', 'uses' => 'Admin\ServiceControllerAdmin@UpdateStatusOptionalService']);
    Route::get('/optional-services/{id}/edit', ['as' => 'admin.optional-services.edit', 'uses' => 'Admin\ServiceControllerAdmin@EditOptionalService']);
    Route::patch('/optional-services/{id}/update', ['as' => 'admin.optional-services.update', 'uses' => 'Admin\ServiceControllerAdmin@UpdateOptionalService']);
    Route::delete('/optional-services/{id}/delete', ['as' => 'admin.optional-services.destroy', 'uses' => 'Admin\ServiceControllerAdmin@DestroyOptionalService']);
    Route::get('/optional-services/search', ['as' => 'admin.optional-services.search', 'uses' => 'Admin\ServiceControllerAdmin@SearchOptionalService']);

    Route::get('/optional-services/new', ['as' => 'admin.optional-services.new', 'uses' => 'Admin\ServiceControllerAdmin@NewOptionalService']);
    Route::post('/optional-services/add', ['as' => 'admin.optional-services.add', 'uses' => 'Admin\ServiceControllerAdmin@AddOptionalService']);

    /*Route::get('/customers-messages', ['as' => 'admin.customer.messages', 'uses' => 'Admin\UserController@ViewMessages']);*/





    Route::get('/lov-car-brands',function(){
        $lov_car_brands = \App\Models\Vehicles\LOVCarYear::all();
        return $lov_car_brands;
    });
// Vehicles




    Route::get('/vehicles/list-of-values', ['as' => 'admin.vehicle.lov', 'uses' => 'Admin\VehicleControllerAdmin@IndexLOV']);
    Route::get('/vehicles/list-of-years', ['as' => 'admin.vehicle.lov-year.index', 'uses' => 'Admin\VehicleControllerAdmin@IndexLOVYear']);
    Route::get('/vehicles/new/list-of-years', ['as' => 'admin.vehicle.lov-year.new', 'uses' => 'Admin\VehicleControllerAdmin@NewLOVYear']);
    Route::post('/vehicles/add/list-of-years', ['as' => 'admin.vehicle.lov-year.add', 'uses' => 'Admin\VehicleControllerAdmin@AddLOVYear']);
    Route::get('/vehicles/edit/list-of-year/{id}', ['as' => 'admin.vehicle.lov-year.edit', 'uses' => 'Admin\VehicleControllerAdmin@EditLOVYear']);
    Route::post('/vehicles/update/list-of-years', ['as' => 'admin.vehicle.lov-year.update', 'uses' => 'Admin\VehicleControllerAdmin@UpdateLOVYear']);


    Route::get('/vehicles/list-of-brands', ['as' => 'admin.vehicle.lov-brand.index', 'uses' => 'Admin\VehicleControllerAdmin@IndexLOVBrand']);
    Route::get('/vehicles/new/list-of-brands', ['as' => 'admin.vehicle.lov-brand.new', 'uses' => 'Admin\VehicleControllerAdmin@NewLOVBrand']);
    Route::post('/vehicles/add/list-of-brands', ['as' => 'admin.vehicle.lov-brand.add', 'uses' => 'Admin\VehicleControllerAdmin@AddLOVBrand']);
    Route::get('/vehicles/edit/list-of-brand/{id}', ['as' => 'admin.vehicle.lov-brand.edit', 'uses' => 'Admin\VehicleControllerAdmin@EditLOVBrand']);
    Route::post('/vehicles/update/list-of-brands', ['as' => 'admin.vehicle.lov-brand.update', 'uses' => 'Admin\VehicleControllerAdmin@UpdateLOVBrand']);



    // LOV Models

    Route::get('/vehicles/list-of-models', ['as' => 'admin.vehicle.lov-model.index', 'uses' => 'Admin\VehicleControllerAdmin@IndexLOVmodel']);
    Route::get('/vehicles/new/list-of-models', ['as' => 'admin.vehicle.lov-model.new', 'uses' => 'Admin\VehicleControllerAdmin@NewLOVmodel']);
    Route::post('/vehicles/add/list-of-models', ['as' => 'admin.vehicle.lov-model.add', 'uses' => 'Admin\VehicleControllerAdmin@AddLOVmodel']);
    Route::get('/vehicles/edit/list-of-model/{id}', ['as' => 'admin.vehicle.lov-model.edit', 'uses' => 'Admin\VehicleControllerAdmin@EditLOVmodel']);
    Route::post('/vehicles/update/list-of-models', ['as' => 'admin.vehicle.lov-model.update', 'uses' => 'Admin\VehicleControllerAdmin@UpdateLOVmodel']);

    Route::get('/vehicles/search/list-of-models', ['as' => 'admin.vehicle.lov-model.search', 'uses' => 'Admin\VehicleControllerAdmin@SearchLOVmodel']);





    //Make vehicle
    Route::get('/vehicles/new', ['as' => 'admin.vehicle.new', 'uses' => 'Admin\VehicleControllerAdmin@NewVehicle']);
    Route::post('/vehicles/add', ['as' => 'admin.vehicle.add', 'uses' => 'Admin\VehicleControllerAdmin@AddVehicle']);
    /*Route::post('/make_vehicle_partial', ['as' => 'admin.vehicle.make-brand.partial', 'uses' => 'Admin\VehicleControllerAdmin@AddMakeBrandPartial']);*/

    //List vehicles
    Route::get('/vehicles/list/search', ['as' => 'admin.vehicle-list.search', 'uses' => 'Admin\VehicleControllerAdmin@SearchVehicles']);
    Route::get('/vehicles/list', ['as' => 'admin.vehicle.list', 'uses' => 'Admin\VehicleControllerAdmin@VehiclesList']);

    Route::post('/vehicles/updatestatus', ['as' => 'admin.vehicle.updatestatus', 'uses' => 'Admin\VehicleControllerAdmin@VehicleUpdateStatus']);


    //Pricing


    /*Route::get('/service-categories/search', ['as' => 'admin.service.categories.search', 'uses' => 'Admin\ServiceControllerAdmin@SearchCategory']);*/






    //Service Category

/*    Route::post('/service-categories-list/updatestatus', ['as' => 'admin.service.categories.updatestatus', 'uses' => 'Admin\ServiceControllerAdmin@UpdateStatusCategory']);
    Route::get('/service-categories/{id}/edit', ['as' => 'admin.service.categories.edit', 'uses' => 'Admin\ServiceControllerAdmin@EditCategory']);
    Route::patch('/service-categories/{id}/update', ['as' => 'admin.service.categories.update', 'uses' => 'Admin\ServiceControllerAdmin@UpdateCategory']);
    Route::delete('/service-categories/{id}/delete', ['as' => 'admin.service.categories.destroy', 'uses' => 'Admin\ServiceControllerAdmin@DestroyCategory']);
    Route::get('/service-categories/search', ['as' => 'admin.service.categories.search', 'uses' => 'Admin\ServiceControllerAdmin@SearchCategory']);
    Route::get('/service-categories/new', ['as' => 'admin.service.categories.new', 'uses' => 'Admin\ServiceControllerAdmin@NewCategory']);
    Route::post('/service-categories/add', ['as' => 'admin.service.categories.add', 'uses' => 'Admin\ServiceControllerAdmin@AddCategory']);
    Route::get('/service-categories/{id}/services', ['as' => 'admin.service.categories.services', 'uses' => 'Admin\ServiceControllerAdmin@CategoryServices']);
    Route::get('/service-categories-list/{id}', ['as' => 'admin.service.category.index', 'uses' => 'Admin\ServiceControllerAdmin@IndexCategory']);
*/






//    Route::get('/ddashboard', ['as' => 'admin.dashboard.index', 'uses' => 'Admin\DashboardController@index']);

    /*    Route::get('/users', ['as' => 'admin.users.index', 'uses' => 'Admin\UserController@index']);
        Route::post('/users/updatestatus', ['as' => 'admin.users.updatestatus', 'uses' => 'Admin\UserController@updateStatus']);
        Route::get('/users/{id}/edit', ['as' => 'admin.users.edit', 'uses' => 'Admin\UserController@edit']);
        Route::patch('/users/{id}', ['as' => 'admin.users.update', 'uses' => 'Admin\UserController@update']);
        Route::delete('/users/{id}/delete', ['as' => 'admin.users.destroy', 'uses' => 'Admin\UserController@destroy']);
        Route::get('/users/search', ['as' => 'admin.users.search', 'uses' => 'Admin\UserController@search']);


        Route::get('/experiences-new', ['as' => 'admin.experiences.index-new', 'uses' => 'Admin\ExperienceController@indexNew']);
        Route::get('/experiences-active', ['as' => 'admin.experiences.index-active', 'uses' => 'Admin\ExperienceController@indexActive']);



        Route::get('{id}/experience-destroy',['as'=>'admin.experience.destroy','uses'=>'Admin\ExperienceController@Destroy']);

        Route::post('/experience/updatestatus', ['as' => 'admin.experiences.updatestatus', 'uses' => 'Admin\ExperienceController@updateStatus']);

        Route::get('/experiences/search-new', ['as' => 'admin.experiences.search-new', 'uses' => 'Admin\ExperienceController@searchNew']);

        Route::get('/users/search-active', ['as' => 'admin.experiences.search-active', 'uses' => 'Admin\ExperienceController@searchActive']);*/

    /*    Route::post('/users/updatestatus', ['as' => 'admin.users.updatestatus', 'uses' => 'Admin\UserController@updateStatus']);

        Route::get('/users/{id}/edit-new', ['as' => 'admin.users.edit-new', 'uses' => 'Admin\UserController@editNew']);
        Route::get('/users/{id}/edit-active', ['as' => 'admin.users.edit-active', 'uses' => 'Admin\UserController@editActive']);


        Route::patch('/users-new/{id}', ['as' => 'admin.users.update-new', 'uses' => 'Admin\UserController@updateNew']);
        Route::patch('/users-active/{id}', ['as' => 'admin.users.update-active', 'uses' => 'Admin\UserController@updateActive']);

        Route::delete('/users/{id}/delete', ['as' => 'admin.users.destroy', 'uses' => 'Admin\UserController@destroy']);


        Route::get('/users/search-new', ['as' => 'admin.users.search-new', 'uses' => 'Admin\UserController@searchNew']);
        Route::get('/users/search-active', ['as' => 'admin.users.search-active', 'uses' => 'Admin\UserController@searchActive']);*/

});



// ################################ FACEBOOK LOGIN


// Generate a login URL
Route::get('/facebook/login', function(SammyK\LaravelFacebookSdk\LaravelFacebookSdk $fb)
{
    // Send an array of permissions to request
    $login_url = $fb->getLoginUrl(['email']);

    // Obviously you'd do this in blade :)
    //return $login_url;
   return redirect($login_url);

   // echo '<a href="' . $login_url . '">Login with Facebook</a>';
});

// Endpoint that is redirected to after an authentication attempt
Route::get('/facebook/callback', function(SammyK\LaravelFacebookSdk\LaravelFacebookSdk $fb)
{
    // Obtain an access token.
    try {
        $token = $fb->getAccessTokenFromRedirect();
    } catch (Facebook\Exceptions\FacebookSDKException $e) {
        dd($e->getMessage());
    }

    // Access token will be null if the user denied the request
    // or if someone just hit this URL outside of the OAuth flow.
    if (! $token) {
        // Get the redirect helper
        $helper = $fb->getRedirectLoginHelper();

        if (! $helper->getError()) {
            abort(403, 'Unauthorized action.');
        }

        // User denied the request
        dd(
            $helper->getError(),
            $helper->getErrorCode(),
            $helper->getErrorReason(),
            $helper->getErrorDescription()
        );
    }

    if (! $token->isLongLived()) {
        // OAuth 2.0 client handler
        $oauth_client = $fb->getOAuth2Client();

        // Extend the access token.
        try {
            $token = $oauth_client->getLongLivedAccessToken($token);
        } catch (Facebook\Exceptions\FacebookSDKException $e) {
            dd($e->getMessage());
        }
    }

    $fb->setDefaultAccessToken($token);

    // Save for later
    Session::put('fb_user_access_token', (string) $token);

    // Get basic info on the user from Facebook.
    try {
        $response = $fb->get('/me?fields=id,first_name,last_name,email');

    } catch (Facebook\Exceptions\FacebookSDKException $e) {
        dd($e->getMessage());
    }

    // Convert the response to a `Facebook/GraphNodes/GraphUser` collection
    $fb_user = $response->getGraphUser();

    //return $fb_user;

  $user = \App\User::createOrUpdateGraphNode($fb_user);

    //$url = "http://graph.facebook.com/1396104483739904/picture?type=large";
    Auth::login($user);

    $url = "http://graph.facebook.com/"+$fb_user->getId()+"/picture?type=large";

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_HEADER, true);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true); // Must be set to true so that PHP follows any "Location:" header
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $a = curl_exec($ch); // $a will contain all headers
    $url = curl_getinfo($ch, CURLINFO_EFFECTIVE_URL); // This is what you need, it will return you the last effective URL


    $id = Auth::user()->id;
    $user = \App\User::find($id);
    $user->image_url=$url;
    $user->save();


    return redirect()->route('home.index');

    // alert()->success("You have been logged through Facebook", 'Great !')->autoclose(3500);
});
