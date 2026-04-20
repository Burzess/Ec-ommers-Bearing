<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProfileController;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', function (Request $request) {
    $search = trim((string) $request->query('q', ''));

    $products = Product::with('category')
        ->when($search !== '', function ($query) use ($search) {
            $query->where(function ($subQuery) use ($search) {
                $subQuery
                    ->where('name', 'like', "%{$search}%")
                    ->orWhere('sku', 'like', "%{$search}%")
                    ->orWhereHas('category', function ($categoryQuery) use ($search) {
                        $categoryQuery->where('name', 'like', "%{$search}%");
                    });
            });
        })
        ->get();

    return view('dashboard', compact('products', 'search'));
})->name('dashboard');

Route::get('/about', [AboutController::class, 'index'])->name('about');

Route::post('/contact', [\App\Http\Controllers\ContactController::class, 'store'])->name('contact.store');

Route::get('/products/{product}', function (Product $product) {
    $product->load('category');
    return view('products.show', compact('product'));
})->name('products.show');

Route::middleware(['auth', 'buyer'])->group(function () {
    Route::get('/cart', [\App\Http\Controllers\CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/{product}', [\App\Http\Controllers\CartController::class, 'add'])->name('cart.add');
    Route::put('/cart/items/{cartItem}', [\App\Http\Controllers\CartController::class, 'update'])->name('cart.update');
    Route::delete('/cart/items/{cartItem}', [\App\Http\Controllers\CartController::class, 'destroy'])->name('cart.destroy');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::patch('/profile/address', [ProfileController::class, 'updateAddress'])->name('profile.address.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/payment', [PaymentController::class, 'index'])->name('payment.index');
});

Route::middleware(['auth', 'owner'])->prefix('owner')->name('owner.')->group(function () {
    Route::get('/dashboard', [\App\Http\Controllers\Owner\DashboardController::class, 'index'])->name('dashboard');
});

// Admin Routes
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [\App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');
    Route::resource('/products', \App\Http\Controllers\Admin\ProductController::class)->except('show');
    Route::resource('/categories', \App\Http\Controllers\Admin\CategoryController::class)->except('show');
    Route::resource('/orders', \App\Http\Controllers\Admin\OrderController::class)->only(['index', 'show', 'update', 'destroy']);
    Route::resource('/customers', \App\Http\Controllers\Admin\CustomerController::class)->only(['index']);
    Route::get('/company-setting', [\App\Http\Controllers\Admin\CompanySettingController::class, 'edit'])->name('company-setting.edit');
    Route::patch('/company-setting', [\App\Http\Controllers\Admin\CompanySettingController::class, 'update'])->name('company-setting.update');
    Route::resource('/shipping-cities', \App\Http\Controllers\Admin\ShippingCityController::class)->except('show');
    Route::resource('/payment-methods', \App\Http\Controllers\Admin\PaymentMethodController::class)->except('show');
    Route::get('/profile', [\App\Http\Controllers\Admin\ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [\App\Http\Controllers\Admin\ProfileController::class, 'update'])->name('profile.update');
});

require __DIR__.'/auth.php';
