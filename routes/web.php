<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdministradorController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
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

/* Route::get('/', HomeController::class)->name('home'); */

//Solo para mostrar una vista y no acceda a la base de datos
/* Route::view('sobreNosotros', 'sobreNosotros')->name('sobreNosotros'); */

// Poner en array ProductControler para llamar al metodo que queremos porque sino llama al metodo __invoke
/* Route::get('products', [ProductController::class, 'index'])->name('products.index');

Route::get('products/create', [ProductController::class,'create'])->name('products.create');

Route::post('products', [ProductController::class,'store'])->name('products.store');

Route::get('products/{product}', [ProductController::class, 'show'])->name('products.show');

Route::get('products/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');

Route::put('products/{product}', [ProductController::class, 'update'])->name('products.update');

Route::delete('products/{product}', [ProductController::class, 'destroy'])->name('products.destroy'); */


// Con el método resource no hace falta poner todas las anteriores
/* Route::resource('products', ProductController::class);

Route::get('contact', [ContactController::class, 'index'])->name('contact.index');

Route::post('contact',[ContactController::class, 'store'])->name('contact.store');

 Route::post('register/signUp',[AuthController::class,'signUp'])->name('register.signUp');


Route::post('login/login',[AuthController::class,'login'])->name('login.login');


Route::get('user',[AuthController::class,'user'])->names('user');
Route::get('logout',[AuthController::class,'logout'])->name('logout'); 
Route::get('register',[AuthController::class,'index'])->name('register.index');
Route::view('login.index', 'login.index')->name('login.index');
 */

Route::post('/administrador/login',[AdminController::class,'login'])->name('administrador.login');

/* Route::view('/administrador','administrador.login')->name('dashboard'); */
Route::get('/administrador',[AdminController::class,'index'])->name('dashboard');

Route::group(['prefix' => 'administrador'   ,'middleware' => 'admin'],function () {
    Route::get('/home',[AdminController::class,'home'])->name('administrador.home');
    Route::get('/houses',[AdminController::class,'houses'])->name('dashboard.houses');
    Route::get('/houses/add-house', [AdminController::class,'addHouse'])->name('dashboard.addHouse');
    Route::get('/houses/{house}', [AdminController::class, 'getHouse'])->name('dashboard.edit');
    Route::post('/house/{house}',[AdminController::class,'update'])->name('dashboard.update');
    Route::get('/logout',[AdminController::class,'logout'])->name('dashboard.logout');

    /* Route::resource('houses', AdminController::class); */

    
    Route::post('/houses/destroy',[AdminController::class,'destroy'])->name('dashboard.destroy');
    Route::post('/houses/store',[AdminController::class,'store'])->name('dashboard.store'); 

    Route::resource('categories', CategoryController::class);
    /* Route::get('/categories',[CategoryController::class,'categories'])->name('categories'); */
    });

Route::get('{any}', function () {
    return view('app');
})->where('any', '.*');