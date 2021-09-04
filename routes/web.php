<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\Product\{
    ProductController, BrandController, CategoryController, AmountUnitController
};

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::middleware('auth')->group(function () {

    Route::get('/admin', [AdminController::class, 'index'])->name('admin');

    Route::resource('product', ProductController::class);
    Route::resource('brand', BrandController::class);
    Route::resource('unit', AmountUnitController::class);
    Route::resource('category', CategoryController::class);
    Route::get('subcategory/{id}/edit', [CategoryController::class, 'editsub'])->name('edit.subcategory');
    Route::delete('subcategory/{id}', [CategoryController::class, 'destroysub'])->name('delete.subcategory');

});
