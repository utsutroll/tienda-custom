<?php

use App\Http\Controllers\Admin\BusinessPartnerController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ProductEntryController;
use App\Http\Controllers\Admin\ProductOutputController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Livewire\Admin\AdminBankAccountComponent;
use App\Http\Livewire\Admin\AdminCategoryComponent;
use App\Http\Livewire\CartComponent;
use App\Http\Livewire\DetailsComponent;
use App\Http\Livewire\CheckoutComponent;
use App\Http\Livewire\HomeComponent;
use App\Http\Livewire\Admin\AdminDashboardComponent;
use App\Http\Livewire\Admin\AdminOrderComponent;
use App\Http\Livewire\Admin\AdminOrderDetailsComponent;
use App\Http\Livewire\Admin\AdminOrderReportsComponent;
use App\Http\Livewire\Admin\AdminPresentationComponent;
use App\Http\Livewire\Admin\AdminProductComponent;
use App\Http\Livewire\Admin\AdminSaleComponent;
use App\Http\Livewire\Admin\AdminTagComponent;
use App\Http\Livewire\Admin\AdminUsersComponent;
use App\Http\Livewire\Admin\AdminWalletComponent;
use App\Http\Livewire\CategoryComponent;
use App\Http\Livewire\SendPaymentComponent;
use App\Http\Livewire\TagComponent;
use App\Http\Livewire\ThankyouComponent;
use App\Http\Livewire\User\UserChangePasswordComponent;
use App\Http\Livewire\User\UserDashboardComponent;
use App\Http\Livewire\User\UserOrdersComponent;
use App\Http\Livewire\User\UserOrdersDetailsComponent;
use App\Http\Livewire\WishlistComponent;
use App\Models\Order;
use App\Models\User;
use App\Notifications\ApprovedPaymentMail;
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

/* Route::get('/', function () {
    return view('welcome');
}); */

Route::get('/', HomeComponent::class);
Route::get('/cart', CartComponent::class)->name('cart');
Route::get('/wishlist', WishlistComponent::class)->name('wishlist');
Route::get('/checkout', CheckoutComponent::class)->name('checkout');
Route::get('/send-payment/{order_id}', SendPaymentComponent::class)->name('sendpayment');
Route::get('/product/{slug}', DetailsComponent::class)->name('product.details');
Route::get('/product-category/{category_slug}', CategoryComponent::class)->name('product.category');
Route::get('/product-tag/{tag_slug}', TagComponent::class)->name('product.tag');
Route::get('/thank-you', ThankyouComponent::class)->name('thankyou');

/* Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard'); */

//For User
Route::middleware(['auth:sanctum', 'verified'])->group(function(){
    Route::get('/user/dashboard', UserDashboardComponent::class)->name('user.dashboard');
    Route::get('/user/orders', UserOrdersComponent::class)->name('user.orders');
    Route::get('/user/orders/{order_id}', UserOrdersDetailsComponent::class)->name('user.orderdetails');
    Route::get('/user/change-password', UserChangePasswordComponent::class)->name('user.changepassword');

    Route::get('markReadUser', function(){
        auth()->user()->unreadNotifications->markAsRead();
        return redirect()->back();
    })->name('markReadUser');
});


//For Admin
Route::middleware(['auth:sanctum', 'verified', 'authadmin'])->group(function(){
    Route::get('/admin/dashboard', AdminDashboardComponent::class)->name('admin.dashboard');
    Route::get('/admin/categories', AdminCategoryComponent::class)->name('admin.categories');
    Route::get('/admin/presentations', AdminPresentationComponent::class)->name('admin.presentations');
    Route::get('/admin/tags', AdminTagComponent::class)->name('admin.tags');
    Route::resource('/admin/products', ProductController::class)->names('admin.products');
    Route::resource('/admin/product-entry', ProductEntryController::class)->names('admin.product-entry');
    Route::get('/admin/stock', [ProductEntryController::class, 'stock'])->name('admin.product-entry.stock');
    Route::resource('/admin/product-output', ProductOutputController::class)->names('admin.product-output');
    Route::resource('/admin/slider', SliderController::class)->names('admin.slider');
    Route::resource('/admin/business-partners', BusinessPartnerController::class)->names('admin.business-partners');
    Route::get('/admin/bank-accounts',AdminBankAccountComponent::class)->name('admin.bank-accounts');
    Route::get('/admin/wallets', AdminWalletComponent::class)->name('admin.wallets');

    Route::get('/admin/orders', AdminOrderComponent::class)->name('admin.orders');
    Route::get('/admin/orders/{order_id}', AdminOrderDetailsComponent::class)->name('admin.orderdetails');
    Route::get('/admin/orders/{order_id}', AdminOrderDetailsComponent::class)->name('admin.orderdetails');
    Route::get('/admin/users', AdminUsersComponent::class)->name('admin.users');
    Route::post('/import-price-products', [ProductController::class, 'import'])->name('admin.productimport');
    Route::post('/import-price-products-offer', [ProductController::class, 'importOffer'])->name('admin.productimportoffer');
    Route::get('/admin/sale', AdminSaleComponent::class)->name('admin.sale');
    Route::get('/admin/orders-reports', AdminOrderReportsComponent::class)->name('admin.orders.reports');
    
    /*Export PDF */
    Route::get('/admin/export-stock-pdf', [ProductEntryController::class, 'exportStockPDF'])->name('admin.stock.pdf');
    Route::get('/admin/export-offer-pdf', [ProductController::class, 'exportOfferPDF'])->name('admin.offer.pdf');


    Route::get('markReadAdmin', function(){
        auth()->user()->unreadNotifications->markAsRead();
        return redirect()->back();
    })->name('markReadAdmin');
});