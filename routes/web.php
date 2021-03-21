<?php

use App\Http\Controllers\ContactController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;


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

Route::get('/', HomeController::class)->name('home');

//Solo para mostrar una vista y no acceda a la base de datos
Route::view('sobreNosotros', 'sobreNosotros')->name('sobreNosotros');

// Poner en array ProductControler para llamar al metodo que queremos porque sino llama al metodo __invoke
/* Route::get('products', [ProductController::class, 'index'])->name('products.index');

Route::get('products/create', [ProductController::class,'create'])->name('products.create');

Route::post('products', [ProductController::class,'store'])->name('products.store');

Route::get('products/{product}', [ProductController::class, 'show'])->name('products.show');

Route::get('products/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');

Route::put('products/{product}', [ProductController::class, 'update'])->name('products.update');

Route::delete('products/{product}', [ProductController::class, 'destroy'])->name('products.destroy'); */


// Con el método resource no hace falta poner todas las anteriores
Route::resource('products', ProductController::class);

Route::get('contact', [ContactController::class, 'index'])->name('contact.index');

Route::post('contact',[ContactController::class, 'store'])->name('contact.store');