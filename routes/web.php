<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\auth\LoginController;
use App\Http\Controllers\index\CartController;
use App\Http\Controllers\index\HomeController;
use App\Http\Controllers\index\ContactController;
use App\Http\Controllers\index\ProductController;
use App\Http\Controllers\index\CheckoutController;
use App\Http\Controllers\admin\AdminHomeController;
use App\Http\Controllers\admin\AdminUserController;
use App\Http\Controllers\index\OrderListController;
use App\Http\Controllers\admin\AdminAdminController;
use App\Http\Controllers\admin\AdminOrderController;
use App\Http\Controllers\admin\AdminProductController;
use App\Http\Controllers\index\DetailProductController;
use App\Http\Controllers\admin\AdminOrderItemController;
use App\Http\Controllers\auth\user\UserLogoutController;
use App\Http\Controllers\auth\admin\AdminLogoutController;
use App\Http\Controllers\auth\user\UserRegisterController;
use App\Http\Controllers\index\CheckoutNowController;
use App\Http\Controllers\index\WishlistController;

// Auth Login Route
Route::get('/login', [LoginController::class, 'index'])
    ->name('login');
Route::post('/login', [LoginController::class, 'store']);

// Auth Admin Route
Route::get('admin/logout', [AdminLogoutController::class, 'store'])
    ->name('admin.logout');
// Auth User Route  
Route::get('/register', [UserRegisterController::class, 'index'])
    ->name('user.register');
Route::post('/register', [UserRegisterController::class, 'store']);

Route::get('/logout', [UserLogoutController::class, 'store'])
    ->name('user.logout');

// Index Route
Route::get('/', [HomeController::class, 'index'])->name('home.index');
Route::get('/product', [ProductController::class, 'index'])->name('product.index');
Route::get('/contact', [ContactController::class, 'index']);
Route::get('/detail-product/{id}/{slug}', [DetailProductController::class, 'show'])
    ->name('product.isi');

Route::group(['middleware' => ['auth', 'ceklevel:1,2']], function () {
    Route::get('/cart', [CartController::class, 'cartList'])->name('product.cart');
    Route::post('/add-to-cart', [DetailProductController::class, 'addToCart']);
    Route::post('/add-to-wishlist', [WishlistController::class, 'addToWishlist']);
    Route::post('/edit-to-cart', [CartController::class, 'cartEdit']);
    // Route::post('/checkout-cart', [CartController::class, 'checkoutCart']);
    Route::post('/order-now', [DetailProductController::class, 'orderNow'])
        ->name('order.now');
    Route::post('/add-rate', [OrderListController::class, 'addRate']);
    Route::get('/delete-product-cart/delete/{id}', [CartController::class, 'cartDelete']);
    Route::get('/delete-product-wishlist/delete/{id}', [WishlistController::class, 'deleteWishlist']);
    // Route::get('/detail-product', [DetailProductController::class, 'index']);
    Route::get('/checkout', [CheckoutController::class, 'index']);
    Route::post('/checkout-success', [CheckoutController::class, 'orderPlace']);
    Route::get('/checkout-now', [CheckoutNowController::class, 'index'])
        ->name('checkout.now');
    Route::post('/checkout-now-success/{id}', [CheckoutNowController::class, 'orderNowPlace']);
    Route::get('/list-order', [OrderListController::class, 'orderList']);
    Route::get('/wish-list', [WishlistController::class, 'wishList']);
});

// Custom Middleware CekLevel 
// Admin Route
Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'ceklevel:1']], function () {
    Route::get('/', [AdminHomeController::class, 'index'])
        ->name('admin.dashboard');

    // Menu Admin Route
    Route::prefix('user')->group(function () {
        Route::get('/user-admin', [AdminAdminController::class, 'index'])
            ->name('admin.admin');

        Route::get('/insert-admin', [AdminAdminController::class, 'insert'])
            ->name('admin.admin-insert');
        Route::post('/insert-admin', [AdminAdminController::class, 'insertAction']);

        Route::get('/edit-admin/{id}', [AdminAdminController::class, 'edit']);
        Route::post('/edit-admin', [AdminAdminController::class, 'editAction'])
            ->name('admin.admin-edit');

        Route::get('/delete-admin/{id}', [AdminAdminController::class, 'delete']);

        // Menu User Route
        Route::get('/', [AdminUserController::class, 'index'])
            ->name('admin.user');

        Route::get('/insert-user', [AdminUserController::class, 'insert'])
            ->name('admin.user-insert');
        Route::post('/insert-user', [AdminUserController::class, 'insertAction']);

        Route::get('/edit-user/{id}', [AdminUserController::class, 'edit']);
        Route::post('/edit-user', [AdminUserController::class, 'editAction'])
            ->name('admin.user-edit');

        Route::get('/delete/{id}', [AdminUserController::class, 'delete']);
    });

    Route::prefix('product')->group(function () {
        Route::get('/', [AdminProductController::class, 'index'])
            ->name('admin.product');

        Route::get('/insert-product', [AdminProductController::class, 'insert'])
            ->name('admin.product-insert');
        Route::post('/insert-product', [AdminProductController::class, 'insertAction'])
            ->name('admin.insert-product');

        Route::get('/edit-product/{id}', [AdminProductController::class, 'edit']);
        Route::post('/edit-product', [AdminProductController::class, 'editAction'])
            ->name('admin.product-edit');

        Route::get('/delete/{id}', [AdminProductController::class, 'delete']);

        // Tambah Kategori
        Route::get('/tambah-kategori', [AdminProductController::class, 'indexKategori'])
            ->name('admin.kategori');

        Route::get('/tambah-kategori/insert-kategori', [AdminProductController::class, 'tambahKategori'])
            ->name('admin.kategori-insert');
        Route::post('/tambah-kategori/insert-kategori', [AdminProductController::class, 'tambahKategoriAction']);

        Route::get('/tambah-kategori/edit-kategori/{id}', [AdminProductController::class, 'editKategori']);
        Route::post('/tambah-kategori/edit-kategori', [AdminProductController::class, 'editKategoriAction'])
            ->name('admin.kategori-edit');

        Route::get('/tambah-kategori/delete/{id}', [AdminProductController::class, 'deleteKategori']);

        // Tambah Variant
        Route::get('/tambah-variant', [AdminProductController::class, 'indexVariant'])
            ->name('admin.variant');

        Route::get('/tambah-variant/insert-variant', [AdminProductController::class, 'tambahVariant'])
            ->name('admin.variant-insert');
        Route::post('/tambah-variant/insert-variant', [AdminProductController::class, 'tambahVariantAction']);

        Route::get('/tambah-variant/edit-variant/{id}', [AdminProductController::class, 'editVariant']);
        Route::post('/tambah-variant/edit-variant', [AdminProductController::class, 'editVariantAction'])
            ->name('admin.variant-edit');

        Route::get('/tambah-variant/delete/{id}', [AdminProductController::class, 'deleteVariant']);
    });

    Route::prefix('order')->group(function () {
        Route::get('/', [AdminOrderController::class, 'index'])
            ->name('admin.order');

        Route::get('/insert-order', [AdminOrderController::class, 'insert'])
            ->name('admin.order-insert');
        Route::post('/insert-order', [AdminOrderController::class, 'insertAction']);

        Route::get('/edit-order/{id}', [AdminOrderController::class, 'edit']);
        Route::post('/edit-order/{id}', [AdminOrderController::class, 'editAction']);

        Route::get('/delete/{id}', [AdminOrderController::class, 'delete']);

		Route::get('/orders_item/{id}', [AdminOrderItemController::class, 'index'])
            ->name('admin.order-item');
		Route::post('/orders_item/{id}', [AdminOrderItemController::class, 'insert']);

		Route::get('/orders_item/edit/{id}', [AdminOrderItemController::class, 'edit']);
		Route::put('/orders_item/edit/{id}', [AdminOrderItemController::class, 'editAction']);

		Route::post('/orders_item/delete/{id}', [AdminOrderItemController::class, 'delete']);
    });

});
