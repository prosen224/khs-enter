<?php
use App\Http\Controllers\Auth\User\AuthController as UserAuthController;
use App\Http\Controllers\ClientsController;
use App\Http\Controllers\Frontend\LocalController;
use App\Http\Controllers\InfromationController;
use App\Http\Controllers\TechnicianController;
use App\Http\Controllers\TypeofworkController;
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
// Language Route start
Route::group(['middleware' => ['verify.web','local'] ], function () {
    Route::get('locale/{locale}',[LocalController::class ,'switchlang'])->name('locale.set');
    Route::post('set-lang',[LocalController::class,"langDataUpdate"])->name("set-language");
    Route::get('lang-page',function(){
        return view('language');
    });
});
// Language Route end
Route::group(['middleware' => ['verify.web','can:isSuparAdmin'] ], function () {
    Route::get('register',[UserAuthController::class, 'register'])->name('registration');
    Route::post('register',[UserAuthController::class, 'store'])->name('registration');
    
    
    Route::get('/all-user', [UserAuthController::class,"alluser"])->name("all-user");
    Route::get('/user/edit/{id}', [UserAuthController::class,"edit"])->name("edit-user");
    Route::get('/user/change-status/{id}/{status?}', [UserAuthController::class,"changeStatus"])->name("user.change-status");
    Route::get('/user-permission/new', [UserAuthController::class, "new"])->name("user-permission.new");
    Route::post('/user-permission/store', [UserAuthController::class, "store2"])->name("user-permission.store");
});

// User Route start
Route::group(['middleware' => ['verify.web'] ], function () {
    Route::post("change_password",[UserAuthController::class,"changePassword"])->name("change-password");
    
    Route::get("/",[UserAuthController::class,"index"])->name("home");
    // Technician Route start
    Route::get('/technician', [TechnicianController::class,"index"])->name("technician");
    Route::get('/technician/new', [TechnicianController::class,"new"])->name("technician.new");
    Route::post('/technician/store', [TechnicianController::class,"store"])->name("technician.store");
    Route::get('/technician/edit/{id}', [TechnicianController::class,"edit"])->name("technician.edit");
    Route::post('/technician/update/{id}', [TechnicianController::class,"update"])->name("technician.update");
    Route::get('/technician/delete/{id}', [TechnicianController::class,"delete"])->name("technician.delete");


    // Clients Route start
    Route::get('/clients', [ClientsController::class,"index"])->name("clients");
    Route::get('/clients/new', [ClientsController::class,"new"])->name("clients.new");
    Route::post('/clients/store', [ClientsController::class,"store"])->name("clients.store");
    Route::get('/clients/edit/{id}', [ClientsController::class,"edit"])->name("clients.edit");
    Route::post('/clients/update/{id}', [ClientsController::class,"update"])->name("clients.update");
    Route::get('/clients/delete/{id}', [ClientsController::class,"delete"])->name("clients.delete");


    // Typeofwork Route start

    Route::get('/type-of-work', [TypeofworkController::class,"index"])->name("type-of-work");
    Route::get('/type-of-work/new', [TypeofworkController::class, "new"])->name("type-of-work.new");
    Route::post('/type-of-work/store', [TypeofworkController::class, "store"])->name("type-of-work.store");
    Route::get('/type-of-work/edit/{id}', [TypeofworkController::class,"edit"])->name("type-of-work.edit");
    Route::post('/type-of-work/update/{id}', [TypeofworkController::class,"update"])->name("type-of-work.update");
    Route::get('/type-of-work/delete/{id}', [TypeofworkController::class,"delete"])->name("type-of-work.delete");

    // Information Route Start
    Route::get('/information',[InfromationController::class, "index"])->name('information');
    Route::get('/information/new',[InfromationController::class, "new"])->name('information.new');
    Route::post('/information/store',[InfromationController::class, "store"])->name('information.store');
    // Route::get('/information/edit/{id}',[InfromationController::class, "edit"])->name('information.edit');
    Route::get('/information/report',[InfromationController::class, "report"])->name('information.report');
    Route::get('/information/show/{id}',[InfromationController::class, "view"])->name('information.show');
    Route::get('/information/status/{id}',[InfromationController::class, "changeStatus"])->name('information.change-status');
    Route::get('/information/delete/{id}',[InfromationController::class, "delete"])->name('information.delete')->middleware('can:isSuparAdmin');
    // Route::get('/information/pdf',[InfromationController::class, "reportpdf"])->name('information.report');

});

Route::group(['prefix' => '/'], function () {

    Route::get("show-mail-template",function(){
        return view('mail');
    });
    Route::group(['middleware'=>'if.login'],function(){
        Route::get('login', [UserAuthController::class,'login'])->name('login');
        Route::post('login', [UserAuthController::class,'authenticate']);
    });
    Route::get('logout', [UserAuthController::class,'logout'])->name("logout");

    // Route::get('verify-email',function(){
    //     return view("Frontend.user.email-verify");
    // });
    Route::get('verify-email',[UserAuthController::class,'verifyEmail']);
    Route::get('sent-email',[UserAuthController::class,'sendMail']);

    Route::get('forgot-password', function () {
        return view("Frontend.User.forgot-password");
    })->name("forgot-password");
    Route::post('forgot-password',[UserAuthController::class,'forgotPassword']);

    Route::get('set-password', function () {
        return view("Frontend.User.set-password");
    })->name("set-password");

    Route::post("set-password/{id}",[UserAuthController::class,"setPassword"]);

});
// User Route end

