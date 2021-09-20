<?php
//Back Use Controller
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashbordController;
use App\Http\Controllers\Admin\NewController;
use App\Http\Controllers\Admin\DefaultController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\RolesController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Login\ResetPasswords;

//Front Use Controller
use App\Http\Controllers\Front\NewsController;

//Front Use Controller Finish

//Auth Support
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

//Front Route start
Route::get('/', [NewsController::class, 'index'])->name('Main');


//Front Route finish


//Login ve .ENV Dosya kurulum routeları
Route::get('sql/install', [DefaultController::class, 'index'])->name('install')->middleware('DataControl');
Route::get('/redirect', [DefaultController::class, 'redirectToProvider'])->name('auth.google');
Route::get('/callback', [DefaultController::class, 'handleProviderCallback']);
Route::get('/login', [DefaultController::class, 'login'])->name('Admin.login')->middleware('Login');
Route::post('/login', [DefaultController::class, 'authenticate'])->name('Admin.authenticate');

//Şifre Sıfırlama Routeları
Route::prefix('/password/reset')->group(function () {
    Route::middleware(['PasswordReset'])->group(function () {
        Route::get('/', [ResetPasswords::class, 'resetPassword'])->name('reset.password');
        Route::get('/{token}', [ResetPasswords::class, 'resetPasswordShow'])->name('reset.password2');
        Route::post('/{token}', [ResetPasswords::class, 'reset_Password']);
        Route::post('/', [ResetPasswords::class, 'reset'])->name('password_reset');
    });

});
//Hesap Doğrulama
if (Auth::check()) {
    return redirect(route('admin.dashboard'));
} else {
    Route::get('/login/account-verified-success/{token}', [UsersController::class, 'AccountVerified'])->name('Verified_Account');
}
//Hesap Doğrulama Bitiş

//Admin kontrol paneli route tanımları
Route::prefix('admin')->group(function () {
    Route::middleware(['Adminn'])->group(function () {
        Route::get('/', [DashbordController::class, 'index'])->name('admin.dashboard');
        Route::get('/new', [NewController::class, 'index'])->name('admin.new');
        Route::get('/category', [CategoryController::class, 'index'])->name('admin.category');
        Route::get('/category/create', [CategoryController::class, 'create'])->name('admin.category.create');
        Route::post('/category/store', [CategoryController::class, 'store'])->name('admin.category.store');
        Route::get('/editcategory/{id2}', [CategoryController::class, 'getCategory']);
        Route::get('/category/getAll', [CategoryController::class, 'getAll'])->name('admin.category.getAll');
        Route::post('/category/update', [CategoryController::class, 'updateCategory'])->name('category.update');
        Route::post('/category/delete', [CategoryController::class, 'deleteCategory'])->name('category.delete');
        Route::get('profile', [ProfileController::class, 'index'])->name('profiles');
        Route::post('/profile/profileSave', [ProfileController::class, 'update'])->name('profilesCreate');


        //giriş çıkış route
        Route::get('/exit', [DashbordController::class, 'exit'])->name('admin.exit');
        //giriş çıkış route bitiş


        //google giriş-çıkış route
        Route::post('/google-disconnect/{delete}', [DefaultController::class, 'googleLogout'])->name('GoogleLogout');
        //google giriş-çıkış route bitiş


        //Yetki Ve Kullanıcı Routeları

        Route::resource('users', '\App\Http\Controllers\Admin\UsersController');
        Route::resource('roles', '\App\Http\Controllers\Admin\RolesController');
        Route::resource('permission', '\App\Http\Controllers\Admin\PermissionController');
        Route::get('/manage-role/{role}', [RolesController::class, 'ManagePermission'])->name('roles.manage-permissions');
        Route::post('/manage-role-permissions', [RolesController::class, 'ManagePermissionStore'])->name('roles.manage-permissionsStore');


        //Yetki Ve Kullanıcı Routeları Bitiş
    });
});
//Log Kayıtları İnceleme
Route::get('admin/logs', 'Rap2hpoutre\LaravelLogViewer\LogViewerController@index')->middleware('Adminn');
//Log Kayıtları İnceleme Bitiş
