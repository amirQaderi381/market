<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Market\BrandController;
use App\Http\Controllers\Admin\AdminDashbordController;
use App\Http\Controllers\Admin\Market\CommentController;
use App\Http\Controllers\Admin\Market\CategoryController;
use App\Http\Controllers\Admin\Market\DeliveryController;
use App\Http\Controllers\Admin\Market\Discount\CopanController;

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


/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
*/

Route::prefix('admin')->namespace('Admin')->group(function () {

    Route::get('/', [AdminDashbordController::class, 'index'])->name('admin.home');

    Route::prefix('market')->namespace('Market')->group(function () {

        //category

        Route::prefix('category')->group(function () {

            Route::get('/', [CategoryController::class, 'index'])->name('admin.market.category.index');
            Route::get('/create', [CategoryController::class, 'create'])->name('admin.market.category.create');
            Route::post('/store', [CategoryController::class, 'store'])->name('admin.market.category.store');
            Route::get('/edit/{id}', [CategoryController::class, 'edit'])->name('admin.market.category.edit');
            Route::put('/update/{id}', [CategoryController::class, 'update'])->name('admin.market.category.update');
            Route::delete('/destroy/{id}', [CategoryController::class, 'destroy'])->name('admin.market.category.destroy');
        });

        //brand

        Route::prefix('brand')->group(function () {

            Route::get('/', [BrandController::class, 'index'])->name('admin.market.brand.index');
            Route::get('/create', [BrandController::class, 'create'])->name('admin.market.brand.create');
            Route::post('/store', [BrandController::class, 'store'])->name('admin.market.brand.store');
            Route::get('/edit/{id}', [BrandController::class, 'edit'])->name('admin.market.brand.edit');
            Route::put('/update/{id}', [BrandController::class, 'update'])->name('admin.market.brand.update');
            Route::delete('/destroy/{id}', [BrandController::class, 'destroy'])->name('admin.market.brand.destroy');
        });

        //comment

        Route::prefix('comment')->group(function () {

            Route::get('/', [CommentController::class, 'index'])->name('admin.market.comment.index');
            Route::get('/show', [CommentController::class, 'show'])->name('admin.market.comment.show');
            Route::post('/store', [CommentController::class, 'store'])->name('admin.market.comment.store');
            Route::get('/edit/{id}', [CommentController::class, 'edit'])->name('admin.market.comment.edit');
            Route::put('/update/{id}', [CommentController::class, 'update'])->name('admin.market.comment.update');
            Route::delete('/destroy/{id}', [CommentController::class, 'destroy'])->name('admin.market.comment.destroy');
        });

        //delivery

        Route::prefix('delivery')->group(function () {

            Route::get('/', [DeliveryController::class, 'index'])->name('admin.market.delivery.index');
            Route::get('/create', [DeliveryController::class, 'create'])->name('admin.market.delivery.create');
            Route::post('/store', [DeliveryController::class, 'store'])->name('admin.market.delivery.store');
            Route::get('/edit/{id}', [DeliveryController::class, 'edit'])->name('admin.market.delivery.edit');
            Route::put('/update/{id}', [DeliveryController::class, 'update'])->name('admin.market.delivery.update');
            Route::delete('/destroy/{id}', [DeliveryController::class, 'destroy'])->name('admin.market.delivery.destroy');
        });

        //discount

        Route::prefix('discount')->group(function () {

            Route::get('/copan', [DisCountController::class, 'copan'])->name('admin.market.discount.copan');
            Route::get('/copan-create', [DisCountController::class, 'copanCreate'])->name('admin.market.discount.copan.create');
            Route::get('/common-discount', [DisCountController::class, 'commonDiscount'])->name('admin.market.discount.common.discount');
            Route::get('/common-discount/create', [DisCountController::class, 'commonDiscountCreate'])->name('admin.market.discount.common.discount.create');
            Route::get('/amazing-sale', [DisCountController::class, 'amazingSale'])->name('admin.market.discount.amazing.sale');
            Route::delete('/amazing-sale-create', [DisCountController::class, 'amazingSaleCreate'])->name('admin.market.discount.amazing.sale.create');
        });
    });
});
