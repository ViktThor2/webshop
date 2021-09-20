<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\Product\{
    ProductController, BrandController, CategoryController, AmountUnitController
};
use App\Http\Controllers\Admin\User\{
    UserController, RoleController, PermissionController
};
use App\Http\Controllers\Admin\Company\{
    CompanyController, PartnerController, DescriptionController
};

Auth::routes();
Route::get('/home', [App\Http\Controllers\Admin\HomeController::class, 'index'])->name('home');

Route::middleware('auth')->group(function () {

    // Products
    Route::resource('product', ProductController::class);
    Route::get('product/active/{id}', [ProductController::class, 'changeActive'])->name('product.change.active');
    Route::get('product/fetch/{id}', [ProductController::class, 'fetch'])->name('product.fetch');
    Route::post('product/image/upload', [ProductController::class, 'imageUpload'])->name('product.image.upload');
    Route::post('product/image/delete', [ProductController::class, 'imageDelete'])->name('product.image.delete');

    Route::resource('brand', BrandController::class);
    Route::resource('unit', AmountUnitController::class);
    Route::resource('category', CategoryController::class);
    Route::get('subcategory/{id}/edit', [CategoryController::class, 'editsub'])->name('edit.subcategory');
    Route::delete('subcategory/{id}', [CategoryController::class, 'destroysub'])->name('delete.subcategory');


    // User
    Route::resource('user', UserController::class);
    Route::resource('role', RoleController::class);
    Route::resource('permission', PermissionController::class);


    // Company
//    Route::resource('company', CompanyController::class);
    Route::get('company', [CompanyController::class, 'index'])->name('company.index');
    Route::post('company/store', [CompanyController::class, 'store'])->name('company.store');

    Route::post('description/profile', [DescriptionController::class, 'profile'])->name('description.profile');
    Route::post('description/delivery', [DescriptionController::class, 'delivery'])->name('description.delivery');
    Route::post('description/faq', [DescriptionController::class, 'faq'])->name('description.faq');
    Route::resource('partner', PartnerController::class);
});
