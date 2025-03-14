<?php


use App\Http\Controllers\{
    AdminController,
    AdminPanelSittingController,
    BrancheController,
    DepartmentController,
    EmployerController,
    FinanceCalenderController,
    JopCategoriesController,
    NationalityController,
    OccasionsController,
    QualificationController,
    ReligionController,
    ResignationController,
    ShiftsTypeController
};

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

define('PC', 4);

Route::prefix('admin')->middleware('guest:admin')->group(function () {
    // Show the login form
    Route::get('/login', [AdminController::class, 'showLogin'])->name('admin.login');
    

    // Process the login form submission
    Route::post('login', [AdminController::class, 'login'])->name('admin.submit');
});

Route::prefix('admin')->middleware('auth:admin')->group(function () {
    // Show the login form

    Route::get('/register', [AdminController::class, 'ShowRegister'])->name('ShowRegister');
    Route::post('/register', [AdminController::class, 'register'])->name('register');

    
    Route::get('dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

    // Process the login form submission
    Route::get('logout', [AdminController::class, 'logout'])->name('admin.logout');

    //adminSittings
    
    Route::get('adminSittings', [AdminPanelSittingController::class, 'index'])->name('adminSittings');

    Route::get('/admin-panel/edit', [AdminPanelSittingController::class, 'edit'])->name('admin.panel.edit');

    Route::post('/admin-panel/update', [AdminPanelSittingController::class, 'update'])->name('admin.panel.update');

    //finance_calenders START
    Route::get('/finance_calender/delete/{id}', [FinanceCalenderController::class, 'destroy'])->name('finance_calender.delete');
    Route::post('/finance_calender/show_year_monthes', [FinanceCalenderController::class, 'show_year_monthes'])->name('finance_calender.show_year_monthes');
    Route::get('/finance_calender/do_open/{id}', [FinanceCalenderController::class, 'do_open'])->name('finance_calender.do_open');


    Route::resource('/finance_calender', FinanceCalenderController::class);
    Route::resource('/Shifts', ShiftsTypeController::class);
    Route::post('/Shiftsajax_search', [ShiftsTypeController::class, 'ajax_search'])->name('ShiftsTypes.ajax_search');
    Route::resource('/Departments', DepartmentController::class);
    Route::resource('/JopCategories', JopCategoriesController::class);
    Route::resource('/Qualification', QualificationController::class);
    Route::resource('/Occasions', OccasionsController::class);
    Route::resource('/Resignations', ResignationController::class);
    Route::resource('/Nationality', NationalityController::class);
    Route::resource('/Religion', ReligionController::class);
    Route::resource('/branches', BrancheController::class);
    Route::resource('/Employers', EmployerController::class);
    
});

route::fallback(function () {
    return redirect()->route('admin.login');
});
