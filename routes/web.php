<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ArchiveController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\InvoicesAttachmentsController;
use App\Http\Controllers\InvoicesDetalesController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});



Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified','check_status'])->name('dashboard');




Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';



Route::resource('invoices',InvoiceController::class)->middleware(['auth','check_status']);
Route::get('/section/{id}',[InvoiceController::class,'getproduct'])->middleware('auth');
Route::post('invoices_update',[InvoiceController::class,'update'])->middleware('auth');
Route::get('/edit_invoice/{id}',[InvoiceController::class,'edit'])->middleware('auth');
Route::get('/Status_show/{id}',[InvoiceController::class,'show'])->middleware('auth')->name('Status_show');
Route::post('/Status_Update/{id}',[InvoiceController::class,'Status_Update'])->middleware('auth')->name('Status_Update');
Route::get('invoice_paid',[InvoiceController::class,'invoice_paid'])->middleware('auth');
Route::get('invoice_unpaid',[InvoiceController::class,'invoice_unpaid'])->middleware('auth');
Route::get('invoice_partail',[InvoiceController::class,'invoice_partail'])->middleware('auth');
Route::get('/Print_invoice/{id}',[InvoiceController::class,'Print_invoice'])->middleware('auth');





Route::resource('sections',SectionController::class)->middleware('auth');
Route::resource('products',ProductController::class)->middleware('auth');



Route::resource('InvoiceAttachments',InvoicesAttachmentsController::class)->middleware('auth');
Route::post('InvoiceAttachments',[InvoicesAttachmentsController::class,'store'])->middleware('auth');



Route::resource('InvoicesDetales',InvoicesDetalesController::class)->middleware('auth');
Route::get('/invoicesDetales/{id}',[InvoicesDetalesController::class,'edit'])->middleware('auth');
Route::get('/View_file/{invoice_number}/{file_name}',[InvoicesDetalesController::class, 'open_file'])->middleware('auth');
Route::get('/download/{invoice_number}/{file_name}',[InvoicesDetalesController::class, 'get_file'])->middleware('auth');
Route::post('delete_file',[InvoicesDetalesController::class, 'destroy'])->middleware('auth');




Route::resource('Archive',ArchiveController::class)->middleware('auth');


Route::group(['middleware' => ['auth']], function() {
    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);
});



Route::get('/{page}', [AdminController::class, 'index']);




