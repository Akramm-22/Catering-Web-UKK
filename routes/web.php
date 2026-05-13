<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\SocialAuthController;
use App\Http\Controllers\User\HomeController;
use App\Http\Controllers\User\PackageController;
use App\Http\Controllers\User\CartController;
use App\Http\Controllers\User\CheckoutController;
use App\Http\Controllers\User\OrderController;
use App\Http\Controllers\User\TrackingController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\OrderManagementController;
use App\Http\Controllers\Admin\PackageManagementController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\PaymentController;

// === PUBLIC ROUTES ===
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/packages', [PackageController::class, 'index'])->name('packages.index');
Route::get('/packages/{slug}', [PackageController::class, 'show'])->name('packages.show');

// === About Us ===
Route::get('/tentang-kami', function () {
    return view('about');
})->name('about');

// === OAUTH ===
Route::get('/auth/{provider}', [SocialAuthController::class, 'redirect'])->name('social.login');
Route::get('/auth/{provider}/callback', [SocialAuthController::class, 'callback']);

// === USER ROUTES (auth required) ===
Route::middleware(['auth'])->group(function () {
    // Cart
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
    Route::patch('/cart/{id}', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/cart/{id}', [CartController::class, 'remove'])->name('cart.remove');

    // Checkout
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');
    Route::get('/checkout/success/{order}', [CheckoutController::class, 'success'])->name('checkout.success');

    // Payment
    Route::post('/payment/process', [PaymentController::class, 'process'])->name('payment.process');
    Route::post('/payment/callback', [PaymentController::class, 'callback'])->name('payment.callback');
    Route::get('/payment/simulate/{order}', [PaymentController::class, 'simulate'])->name('payment.simulate');
    Route::post('/payment/simulate/{order}/pay', [PaymentController::class, 'simulatePay'])->name('payment.simulate.pay');

    // Orders
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{order}', [OrderController::class, 'show'])->name('orders.show');

    // Tracking
    Route::get('/track', [TrackingController::class, 'index'])->name('tracking.index');
    Route::get('/track/{receiptNumber}', [TrackingController::class, 'show'])->name('tracking.show');
});

// === ADMIN ROUTES ===
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/orders', [OrderManagementController::class, 'index'])->name('orders.index');
    Route::get('/orders/{order}', [OrderManagementController::class, 'show'])->name('orders.show');
    Route::patch('/orders/{order}/status', [OrderManagementController::class, 'updateStatus'])->name('orders.update-status');
    Route::post('/orders/{order}/tracking', [OrderManagementController::class, 'addTracking'])->name('orders.add-tracking');

    Route::resource('packages', PackageManagementController::class);
    Route::get('/customers', [CustomerController::class, 'index'])->name('customers.index');
    Route::get('/reports', [\App\Http\Controllers\Admin\ReportController::class, 'index'])->name('reports.index');
});

require __DIR__.'/auth.php';
