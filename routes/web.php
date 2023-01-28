<?php

use App\Http\Controllers\Admin\BusinessPartnerController;
use App\Http\Controllers\Admin\OrderReportController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ProductEntryController;
use App\Http\Controllers\Admin\ProductOutputController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\InvoiceController;
use App\Http\Livewire\AboutComponent;
use App\Http\Livewire\Admin\AdminBankAccountComponent;
use App\Http\Livewire\Admin\AdminBrandComponent;
use App\Http\Livewire\Admin\AdminCategoryComponent;
use App\Http\Livewire\Admin\AdminCharacteristicComponent;
use App\Http\Livewire\CartComponent;
use App\Http\Livewire\DetailsComponent;
use App\Http\Livewire\CheckoutComponent;
use App\Http\Livewire\HomeComponent;
use App\Http\Livewire\Admin\AdminDashboardComponent;
use App\Http\Livewire\Admin\AdminOrderComponent;
use App\Http\Livewire\Admin\AdminOrderDetailsComponent;
use App\Http\Livewire\Admin\AdminOrderReportsComponent;
use App\Http\Livewire\Admin\AdminSaleComponent;
use App\Http\Livewire\Admin\AdminSaleOpenComponent;
use App\Http\Livewire\Admin\AdminSalePriceComponent;
use App\Http\Livewire\Admin\AdminSubcategoryComponent;
use App\Http\Livewire\Admin\AdminUsersComponent;
use App\Http\Livewire\Admin\AdminWalletComponent;
use App\Http\Livewire\CategoryComponent;
use App\Http\Livewire\Offer;
use App\Http\Livewire\SendPaymentComponent;
use App\Http\Livewire\ShopComponent;
use App\Http\Livewire\ThankyouComponent;
use App\Http\Livewire\User\UserChangePasswordComponent;
use App\Http\Livewire\User\UserOrdersComponent;
use App\Http\Livewire\User\UserOrdersDetailsComponent;
use App\Http\Livewire\WishlistComponent;
use App\Models\CharacteristicProduct;
use App\Models\Subcategory;
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
Route::get('/shop', ShopComponent::class)->name('shop');
Route::get('/about', AboutComponent::class)->name('about');
Route::get('/cart', CartComponent::class)->name('cart');
Route::get('/offer', Offer::class)->name('offer');
Route::get('/wishlist', WishlistComponent::class)->name('wishlist');

Route::middleware(['cart.is.empty'])->group(function() {
    Route::get('/checkout', CheckoutComponent::class)->name('checkout');
    Route::get('/send-payment/{order_id}', SendPaymentComponent::class)->name('sendpayment');
});

Route::get('/product/{slug}', DetailsComponent::class)->name('product.details');
Route::get('/categories', CategoryComponent::class)->name('categories');
Route::get('/thank-you', ThankyouComponent::class)->name('thankyou');

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

//For User
Route::middleware(['auth:sanctum', 'verified'])->group(function(){
    /* Route::get('/user/dashboard', UserDashboardComponent::class)->name('user.dashboard'); */
    Route::get('/user/orders', UserOrdersComponent::class)->name('user.orders');
    Route::get('/user/orders/{order_id}', UserOrdersDetailsComponent::class)->name('user.orderdetails');
    Route::get('/user/invoice-report', [InvoiceController::class, 'userInvoiceReport'])->name('user.invoice.report');
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
    Route::get('/admin/subcategories', AdminSubcategoryComponent::class)->name('admin.subcategories');
    Route::get('/admin/brands', AdminBrandComponent::class)->name('admin.brands');
    Route::get('/admin/characteristics', AdminCharacteristicComponent::class)->name('admin.characteristics');
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
    Route::get('/admin/sale-price', AdminSalePriceComponent::class)->name('admin.sale-price');
    Route::get('/admin/sale-open', AdminSaleOpenComponent::class)->name('admin.sale-open');
    Route::get('/admin/orders-reports', AdminOrderReportsComponent::class)->name('admin.orders.reports');
    Route::get('/admin/invoice-report', [InvoiceController::class, 'userInvoiceReport'])->name('admin.invoice.report');
    
    
    
    /* Select Dependiente */
    Route::get('select/{id}', function ($id) {
        $subcategories = Subcategory::where('category_id',$id)->get();
        return response()->json($subcategories);
    });

    Route::post('delete_char/{id}', function ($id) {
        CharacteristicProduct::where('characteristic_id', $id)->delete();
        return response()->json('La característica se eliminó con éxito');
    });


    /* Export PDF */
    Route::get('/admin/export-stock-pdf', [ProductEntryController::class, 'exportStockPDF'])->name('admin.stock.pdf');
    Route::get('/admin/export-entry-pdf', [ProductEntryController::class, 'exportEntryPDF'])->name('admin.entry.pdf');
    Route::get('/admin/export-output-pdf', [ProductOutputController::class, 'exportOutputPDF'])->name('admin.output.pdf');
    Route::get('/admin/export-offer-pdf', [ProductController::class, 'exportOfferPDF'])->name('admin.offer.pdf');
    Route::get('/admin/all-orders-day', [OrderReportController::class, 'allOrdersDay'])->name('admin.allordersday.pdf');
    Route::get('/admin/all-orders-month', [OrderReportController::class, 'allOrdersMonth'])->name('admin.allordersmonth.pdf');
    Route::get('/admin/all-orders-range', [OrderReportController::class, 'allOrdersRange'])->name('admin.allordersrange.pdf');
    Route::get('/admin/all-orders-aproved-day', [OrderReportController::class, 'allOrdersAprovedDay'])->name('admin.allordersaprovedday.pdf');
    Route::get('/admin/all-orders-aproved-month', [OrderReportController::class, 'allOrdersAprovedMonth'])->name('admin.allordersaprovedmonth.pdf');
    Route::get('/admin/all-orders-aproved-range', [OrderReportController::class, 'allOrdersAprovedRange'])->name('admin.allordersaprovedrange.pdf');
    Route::get('/admin/all-orders-canceled-day', [OrderReportController::class, 'allOrdersCanceledDay'])->name('admin.allorderscanceledday.pdf');
    Route::get('/admin/all-orders-canceled-month', [OrderReportController::class, 'allOrdersCanceledMonth'])->name('admin.allorderscanceledmonth.pdf');
    Route::get('/admin/all-orders-canceled-range', [OrderReportController::class, 'allOrdersCanceledRange'])->name('admin.allorderscanceledrange.pdf');


    Route::get('markReadAdmin', function(){
        auth()->user()->unreadNotifications->markAsRead();
        return redirect()->back();
    })->name('markReadAdmin');
});