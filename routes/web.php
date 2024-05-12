<?php

use App\Http\Controllers\AbsensiController;
use App\Http\Controllers\DepartementController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HistoryLogController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ApprovalRegisterController;
use App\Http\Controllers\DataAlternatifController;
use App\Http\Controllers\DataKriteriaController;
use App\Http\Controllers\DataPembobotanController;
use App\Http\Controllers\DataSanggarTariController;
use App\Http\Controllers\GaleryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\JenisKendaraanController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\ParkirKeluarController;
use App\Http\Controllers\ParkirMasukController;
use App\Http\Controllers\PerhitunganController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\TreeDModelController;
use App\Http\Controllers\VidioYoutubeController;
use App\Models\DataPembobotan;
use App\Models\VidioYoutube;
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


Route::get('/', function () {
    $data['page_title'] = "Login";
    return view('auth.login', $data);
})->name('user.login');

Route::get('register', [RegisterController::class, 'index'])->name('register');
Route::post('loginPost2', [UserController::class, 'loginPost2'])->name('loginPost2');


Route::middleware('auth:web')->group(function () {
    
    Route::get('dashboard', [DashboardController::class, 'dashboard'])->name('dashboard.index');

    Route::get('approval-list', [ApprovalRegisterController::class, 'notifikasi'])->name('approval-list');

    Route::post('approve-register/{id}', [ApprovalRegisterController::class, 'approval'])->name('approve-register');
    Route::post('not-approve-register/{id}', [ApprovalRegisterController::class, 'notApprove'])->name('not-approve-register');

    Route::get('sanggar-tari-list', [DataSanggarTariController::class, 'index'])->name('sanggar-tari-list');
    Route::get('sanggar-tari-create', [DataSanggarTariController::class, 'create'])->name('sanggar-tari-create');
    Route::post('sanggar-tari-store', [DataSanggarTariController::class, 'store'])->name('sanggar-tari-store');
    Route::get('sanggar-tari-edit/{id}', [DataSanggarTariController::class, 'edit'])->name('sanggar-tari-edit');
    Route::post('sanggar-tari-update/{id}', [DataSanggarTariController::class, 'update'])->name('sanggar-tari-update');
    Route::get('sanggar-tari-delete/{id}', [DataSanggarTariController::class, 'destroy'])->name('sanggar-tari-delete');

    Route::get('data-alternatif-list', [DataAlternatifController::class, 'index'])->name('data-alternatif-list');
    Route::get('data-alternatif-create', [DataAlternatifController::class, 'create'])->name('data-alternatif-create');
    Route::post('data-alternatif-store', [DataAlternatifController::class, 'store'])->name('data-alternatif-store');
    Route::get('data-alternatif-edit/{id}', [DataAlternatifController::class, 'edit'])->name('data-alternatif-edit');
    Route::post('data-alternatif-update/{id}', [DataAlternatifController::class, 'update'])->name('data-alternatif-update');
    Route::get('data-alternatif-delete/{id}', [DataAlternatifController::class, 'destroy'])->name('data-alternatif-delete');

    Route::get('data-kriteria-list', [DataPembobotanController::class, 'index'])->name('data-kriteria-list');
    Route::get('data-kriteria-create', [DataPembobotanController::class, 'create'])->name('data-kriteria-create');
    Route::post('data-kriteria-store', [DataPembobotanController::class, 'store'])->name('data-kriteria-store');
    Route::get('data-kriteria-edit/{id}', [DataPembobotanController::class, 'edit'])->name('data-kriteria-edit');
    Route::post('data-kriteria-update/{id}', [DataPembobotanController::class, 'update'])->name('data-kriteria-update');
    Route::get('data-kriteria-delete/{id}', [DataPembobotanController::class, 'destroy'])->name('data-kriteria-delete');
    
  
    Route::get('data-pembobotan-list', [DataPembobotanController::class, 'index'])->name('data-pembobotan-list');
    Route::get('data-pembobotan-create', [DataPembobotanController::class, 'create'])->name('data-pembobotan-create');
    Route::post('data-pembobotan-store', [DataPembobotanController::class, 'store'])->name('data-pembobotan-store');
    Route::get('data-pembobotan-edit/{id}', [DataPembobotanController::class, 'edit'])->name('data-pembobotan-edit');
    Route::post('data-pembobotan-update/{id}', [DataPembobotanController::class, 'update'])->name('data-pembobotan-update');
    Route::get('data-pembobotan-delete/{id}', [DataPembobotanController::class, 'destroy'])->name('data-pembobotan-delete');
    Route::get('perhitungan', [PerhitunganController::class, 'index'])->name('perhitungan');

    
     Route::get('master-data', function () {
        $data['page_title'] = 'Master Data';
        $data['breadcumb'] = 'Master Data';
        return view('master-data.index', $data);
    })->name('master-data.index');

    Route::resource('departements', DepartementController::class);

    Route::patch('change-password', [UserController::class, 'changePassword'])->name('users.change-password');

    Route::resource('users', UserController::class)->except([
        'show'
    ]);;

    Route::get('user-destroy/{id}', [UserController::class, 'destroy'])->name('user-destroy');

   
    Route::resource('profile', ProfileController::class)->except([
        'show','create', 'store'
    ]);

    Route::patch('change-password-profile', [ProfileController::class, 'changePassword'])->name('profile.change-password');


});

