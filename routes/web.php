<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth;

use App\Http\Controllers\MailController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\PricingController;

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CollectionController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Admin\CategoryProductsController;
use App\Http\Controllers\Admin\DashboardController;

use App\Http\Controllers\Guest\CategoryController as GuestCategoryController;
use App\Http\Controllers\Guest\CategoryProductController;
use App\Http\Controllers\Guest\CollectionController as GuestCollectionController;
use App\Http\Controllers\Guest\ProductController as GuestProductController;
use App\Http\Controllers\Guest\SuggestionsController;
use App\Http\Controllers\User\CategoryController as UserCategoryController;
use App\Http\Controllers\User\CollectionController as UserCollectionController;
use App\Http\Controllers\User\DashboardController as UserDashboardController;
use App\Http\Controllers\User\ProductController as UserProductController;
use App\Http\Controllers\User\ProductImportController;


Route::get('/custom_collections', function () {
    return view('custom_collections');
})->name('custom.collections');

Route::get('/coming_soon_collections', function () {
    return view('coming_soon_collections');
})->name('coming.soon.collections');

Route::post('suggestions', [SuggestionsController::class, 'index'])->name('suggestions');

/***************************************** GUEST ROUTES **********************************/
Route::get('/', [WelcomeController::class, 'index'])->name('welcome');
Route::get('/subscribe', [MailController::class, 'subscribe'])->name('subscribe');
Route::post('subscribePost', [MailController::class, 'subscribePost'])->name('subscribePost');
Route::get('pricing', [PricingController::class, 'index'])->name('pricing');

Route::get('/categories/products/{id}', [CategoryProductController::class, 'products'])->name('guest.category.product');

Route::resource('categories', GuestCategoryController::class, [
    'names' => [ 'index' => 'guest.category.index', 'store' => 'guest.category.store','create' => 'guest.category.create','edit' => 'guest.category.edit','show' => 'guest.category.show','update' => 'guest.category.update','destroy' => 'guest.category.destroy'
]]);

Route::resource('collections', GuestCollectionController::class, [
    'names' => [ 'index' => 'guest.collection.index', 'store' => 'guest.collection.store','create' => 'guest.collection.create','edit' => 'guest.collection.edit','show' => 'guest.collection.show','update' => 'guest.collection.update','destroy' => 'guest.collection.destroy'
]]);
Route::resource('products', GuestProductController::class, [
    'names' => [ 'index' => 'guest.product.index', 'store' => 'guest.product.store','create' => 'guest.product.create','edit' => 'guest.product.edit','show' => 'guest.product.show','update' => 'guest.product.update','destroy' => 'guest.category.destroy'
]]);



/***************************************** USER ROUTES **********************************/
Route::group(['prefix'=>'user'], function(){
    Route::get('dashboard', [UserDashboardController::class, 'index'])->name('users.dashboard');
    Route::resource('category', UserCategoryController::class);
    Route::resource('collection', UserCollectionController::class);
    Route::post('product/import', [ProductImportController::class, 'ProductImport'])->name('ProductImport');
    Route::resource('product', UserProductController::class);
});



/***************************************** ADMIN ROUTES **********************************/
Route::group(['prefix'=>'admin'], function(){
    Route::resource('product', ProductController::class, [
        'names' => [ 'index' => 'admin.product.index', 'store' => 'admin.product.store','create' => 'admin.product.create','edit' => 'admin.product.edit','show' => 'admin.product.show','update' => 'admin.product.update','destroy' => 'admin.product.destroy']]);
    
    Route::resource('collection', CollectionController::class, [
        'names' => ['index' => 'admin.collection.index','store' => 'admin.collection.store','create' => 'admin.collection.create','edit' => 'admin.collection.edit','show' => 'admin.collection.show','update' => 'admin.collection.update','destroy' => 'admin.collection.destroy']]);
        
    Route::get('products/collections/{id}', [CategoryProductsController::class, 'products'])->name('products.collections');
    Route::get('products/collections/show/{id}', [CategoryProductsController::class, 'show'])->name('products.collections.show');
    
    Route::resource('category', CategoryController::class,[
    'names' => [ 'index' => 'admin.category.index','store' => 'admin.category.store','create' => 'admin.category.create','edit' => 'admin.category.edit','show' => 'admin.category.show','update' => 'admin.category.update','destroy' => 'admin.category.destroy']]);

    Route::get('user', [UsersController::class, 'index'])->name('admin.user.index');
    Route::get('user/{id}', [UsersController::class, 'show'])->name('admin.user.show');
    Route::get('premium', [UsersController::class, 'premium'])->name('admin.user.premium');
    Route::get('standard', [UsersController::class, 'standard'])->name('admin.user.standard');
    Route::get('basic', [UsersController::class, 'basic'])->name('admin.user.basic');
    
    Route::get('visibleProducts', [DashboardController::class, 'visibleProducts'])->name('admin.visibleProducts');
    Route::get('hiddenProducts', [DashboardController::class, 'hiddenProducts'])->name('admin.hiddenProducts'); 
});

/*------------------------------------------------------------------------------------------------------------------
=============================================== AUTH ROUTES ======================================================
-------------------------------------------------------------------------------------------------------------------*/

Route::get('login', [Auth\LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [Auth\LoginController::class, 'login']);

Route::post('logout', [Auth\LoginController::class, 'logout'])->name('logout');

Route::get('register/{flag}', [Auth\RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [Auth\RegisterController::class, 'register'])->name('post.register');

Route::get('password/reset', [Auth\ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('password/email', [Auth\ForgotPasswordController::class , 'sendResetLinkEmail'])->name('password.email');
Route::get('password/reset/{token}', [Auth\ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('password/reset', [Auth\ResetPasswordController::class, 'reset'])->name('password.update');

Route::get('password/confirm', [Auth\ConfirmPasswordController::class, 'showConfirmForm'])->name('password.confirm');
Route::post('password/confirm', [Auth\ConfirmPasswordController::class, 'confirm']);

Route::get('email/verify', [Auth\VerificationController::class, 'show'])->name('verification.notice');
Route::get('email/verify/{id}/{hash}', [Auth\VerificationController::class, 'verify'])->name('verification.verify');
Route::post('email/resend', [Auth\VerificationController::class, 'resend'])->name('verification.resend');

/*------------------------------------------------------------------------------------------------------------------
=============================================== AUTH ROUTES END ======================================================
-------------------------------------------------------------------------------------------------------------------*/

/* Auth::routes(); */

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
