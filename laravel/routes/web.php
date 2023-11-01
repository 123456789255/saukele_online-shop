<?php

use GuzzleHttp\Middleware;
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

Auth::routes();
Route::get('/', [App\Http\Controllers\ProductController::class, 'about'])->name('about');
Route::get('/home', [App\Http\Controllers\ProductController::class, 'index'])->name('home')->middleware('auth');
Route::get('/profile', [App\Http\Controllers\ProfileController::class, 'index'])->name('profile')->middleware('auth');
Route::post('/profile/update', [App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update')->middleware('auth');
Route::post('/profile/update-password', [App\Http\Controllers\ProfileController::class, 'updatePassword'])->name('profile.update-password')->middleware('auth');

Route::post('/bookings', [App\Http\Controllers\BookingController::class, 'store'])->middleware('auth'); // Защита маршрута аутентификацией
Route::delete('/bookings/{booking}', [App\Http\Controllers\BookingController::class, 'destroy'])->name('bookings.destroy')->middleware('auth');
Route::get('/check-occupied-dates', [App\Http\Controllers\BookingController::class, 'occupied']);

Route::get('/catalog', [App\Http\Controllers\CatalogController::class, 'catalog'])->name('catalog');
Route::get('/categories/{gender}', [App\Http\Controllers\CatalogController::class, 'getCategoriesByGender'])->name('getCategoriesByGender');
Route::get('/get-subcategories/{categoryId}', [App\Http\Controllers\CatalogController::class, 'getSubcategoriesByCategory'])->name('getSubcategoriesByCategory');
Route::get('/product/{product}', [App\Http\Controllers\ProductController::class, 'show'])->name('product');

Route::get('/cart', [App\Http\Controllers\CartController::class, 'showCart'])->name('cart.show')->middleware('auth');
Route::post('/add-to-cart/{productId}', [App\Http\Controllers\CartController::class, 'addToCart'])->name('cart.add')->middleware('auth');
Route::get('/add-on-cart/{productId}', [App\Http\Controllers\CartController::class, 'addOnCart'])->name('cart.add.inside')->middleware('auth');
Route::get('/remove-from-card/{productId}', [App\Http\Controllers\CartController::class, 'removeFromCart'])->name('cart.remove.one')->middleware('auth');
Route::get('/remove-all-from-card/{cartId}', [App\Http\Controllers\CartController::class, 'removeAllFromCart'])->name('cart.remove.all')->middleware('auth');

Route::get('/orders', [App\Http\Controllers\OrderController::class, 'index'])->name('orders.index')->middleware('auth')->middleware('auth');
Route::get('/orders/{order}', [App\Http\Controllers\OrderController::class, 'show'])->name('orders.show')->middleware('auth')->middleware('auth');
Route::post('/orders', [App\Http\Controllers\CartController::class, 'store'])->name('orders.store')->middleware('auth')->middleware('auth');
Route::delete('/orders/{order}', [App\Http\Controllers\OrderController::class, 'destroy'])->name('orders.destroy')->middleware('auth')->middleware('auth');


/*Админка*/
Route::get('/admin', [\App\Http\Controllers\AdminController::class, 'adminIndex'])->name('admin.index')->middleware('auth');
// просмотр списка всех заказов
Route::get('/admin/orders', [App\Http\Controllers\AdminController::class, 'orders'])->name('admin.orders')->middleware('auth');

// просмотр информации о конкретном заказе и его элементах
Route::get('/admin/order/{id}', [App\Http\Controllers\AdminController::class, 'viewOrder'])->name('admin.viewOrder')->middleware('auth');

// отмена заказа администратором
Route::post('/admin/order/cancel/{id}', [App\Http\Controllers\AdminController::class, 'cancelOrder'])->name('admin.cancelOrder')->middleware('auth');

// подтверждение заказа администратором
Route::post('/admin/order/confirm/{id}', [App\Http\Controllers\AdminController::class, 'confirmOrder'])->name('admin.confirmOrder')->middleware('auth');

// просмотр списка всех товаров
Route::get('/admin/products', [App\Http\Controllers\AdminController::class, 'products'])->name('admin.products')->middleware('auth');

// добавление товара
Route::post('/admin/product', [App\Http\Controllers\AdminController::class, 'addProduct'])->name('admin.addProduct')->middleware('auth');

// удаление товара
Route::delete('/admin/product/delete/{id}', [App\Http\Controllers\AdminController::class, 'deleteProduct'])->name('admin.deleteProduct')->middleware('auth');

// редактирование товара
Route::get('/admin/product/edit/{id}', [App\Http\Controllers\AdminController::class, 'editProduct'])->name('admin.editProduct')->middleware('auth');
Route::put('/admin/product/update/{id}', [App\Http\Controllers\AdminController::class, 'updateProduct'])->name('admin.updateProduct')->middleware('auth');

//категории
Route::get('/admin/category', [App\Http\Controllers\AdminController::class, 'categories'])->name('admin.category')->middleware('auth');
Route::post('/admin/category/add/', [App\Http\Controllers\AdminController::class, 'addCategory'])->name('admin.addCategory')->middleware('auth');
Route::post('/admin/category/addsub/', [App\Http\Controllers\AdminController::class, 'addSubcategory'])->name('admin.addSubcategory')->middleware('auth');
Route::delete('/admin/category/delete/{id}', [App\Http\Controllers\AdminController::class, 'deleteCategory'])->name('admin.deleteCategories')->middleware('auth');
Route::delete('/admin/category/delete/sub/{id}', [App\Http\Controllers\AdminController::class, 'deleteSubcategory'])->name('admin.deleteSubcategories')->middleware('auth');
Route::get('/admin/category/edit/{id}', [App\Http\Controllers\AdminController::class, 'editCategory'])->name('admin.editCategories')->middleware('auth');
Route::put('/admin/category/update/{id}', [App\Http\Controllers\AdminController::class, 'updateCategory'])->name('admin.updateCategories')->middleware('auth');
Route::put('/admin/category/update/sub/{id}', [App\Http\Controllers\AdminController::class, 'updateSubcategory'])->name('admin.updateSubcategory')->middleware('auth');

//Пользователи
Route::get('/admin/users', [App\Http\Controllers\AdminController::class, 'users'])->name('admin.users')->middleware('auth');
Route::delete('/admin/users/{id}', [App\Http\Controllers\AdminController::class, 'deleteUser'])->name('admin.deleteUser')->middleware('auth');
Route::put('/admin/user/update/{id}', [App\Http\Controllers\AdminController::class, 'updateUser'])->name('admin.updateUser')->middleware('auth');

//Бронь
Route::get('/admin/booking', [App\Http\Controllers\AdminController::class, 'showBooking'])->name('admin.showBooking')->middleware('auth');

// отмена Брони администратором
Route::post('/admin/booking/cancel/{id}', [App\Http\Controllers\AdminController::class, 'cancelBooking'])->name('admin.cancelBooking');

// подтверждение Брони администратором
Route::post('/admin/booking/confirm/{id}', [App\Http\Controllers\AdminController::class, 'confirmBooking'])->name('admin.confirmBooking');