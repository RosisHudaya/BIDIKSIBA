<?php

use App\Http\Controllers\AkunUjianController;
use App\Http\Controllers\AsalJurusanController;
use App\Http\Controllers\BiodataController;
use App\Http\Controllers\BiodataSpkController;
use App\Http\Controllers\BobotController;
use App\Http\Controllers\DataSpkController;
use App\Http\Controllers\DemoController;
use App\Http\Controllers\GajiOrtuController;
use App\Http\Controllers\HutangController;
use App\Http\Controllers\JumlahKamarController;
use App\Http\Controllers\JurusanController;
use App\Http\Controllers\KamarMandiController;
use App\Http\Controllers\LaporanNilaiController;
use App\Http\Controllers\LoginUjianController;
use App\Http\Controllers\LuasTanahController;
use App\Http\Controllers\Menu\MenuGroupController;
use App\Http\Controllers\Menu\MenuItemController;
use App\Http\Controllers\PajakController;
use App\Http\Controllers\PekerjaanOrtuController;
use App\Http\Controllers\ProdiController;
use App\Http\Controllers\RoleAndPermission\AssignPermissionController;
use App\Http\Controllers\RoleAndPermission\AssignUserToRoleController;
use App\Http\Controllers\RoleAndPermission\ExportPermissionController;
use App\Http\Controllers\RoleAndPermission\ExportRoleController;
use App\Http\Controllers\RoleAndPermission\ImportPermissionController;
use App\Http\Controllers\RoleAndPermission\ImportRoleController;
use App\Http\Controllers\RoleAndPermission\PermissionController;
use App\Http\Controllers\RoleAndPermission\RoleController;
use App\Http\Controllers\SaudaraController;
use App\Http\Controllers\SesiUjianController;
use App\Http\Controllers\SesiUserController;
use App\Http\Controllers\SoalUjianController;
use App\Http\Controllers\StatusOrtuController;
use App\Http\Controllers\TagihanListrikController;
use App\Http\Controllers\TokenUjianController;
use App\Http\Controllers\UjianController;
use App\Http\Controllers\VerifikasiPendaftarController;
use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Http\Controllers\UserController;
use App\Models\Category;

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

// Route::get('/', function () {
//     return view('auth/login');
// });

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [BiodataController::class, 'index_dash'])->name('welcome');

Route::get('/login', function () {
    if (auth()->check()) {
        return redirect('/dashboard');
    } else {
        return view('auth/login');
    }
})->name('login');

Route::group(['middleware' => ['auth', 'verified']], function () {
    Route::get('/dashboard', function () {
        return view('home', ['users' => User::get(),]);
    });
    //user list
    Route::prefix('user-management')->group(function () {
        Route::resource('user', UserController::class);
        Route::match(['get', 'post'], '/verify-email/{id}/{hash}', [UserController::class, 'verifyEmail'])
            ->name('user.verify-email');
        Route::delete('/verify-email/{id}/{hash}', [UserController::class, 'verifyEmail'])
            ->name('user.delete-verify-email');
        Route::post('import', [UserController::class, 'import'])->name('user.import');
        Route::get('export', [UserController::class, 'export'])->name('user.export');
        Route::get('demo', DemoController::class)->name('user.demo');
        Route::post('user/update-roles/{user}', [UserController::class, 'updateRoles'])->name('user.update-roles');
        Route::resource('verifikasi-pendaftar', VerifikasiPendaftarController::class);
        Route::put('verifikasi-pendaftar/verifikasi/{biodata}', [VerifikasiPendaftarController::class, 'verif'])->name('verifikasi-pendaftar.verif');
        Route::put('verifikasi-pendaftar/reject/{biodata}', [VerifikasiPendaftarController::class, 'reject'])->name('verifikasi-pendaftar.reject');
        Route::get('akun-ujian', [AkunUjianController::class, 'index'])->name('akun-ujian.index');
    });

    Route::prefix('menu-management')->group(function () {
        Route::resource('menu-group', MenuGroupController::class);
        Route::resource('menu-item', MenuItemController::class);
    });

    //menu kriteria pendaftar
    Route::prefix('menu-kriteria-pendaftar')->group(function () {
        Route::resource('pekerjaan-ortu', PekerjaanOrtuController::class);
        Route::resource('penghasilan-ortu', GajiOrtuController::class);
        Route::resource('saudara', SaudaraController::class);
        Route::resource('status-ortu', StatusOrtuController::class);
    });

    //menu kriteria ekonomi
    Route::prefix('menu-kriteria-ekonomi')->group(function () {
        Route::resource('luas-tanah', LuasTanahController::class);
        Route::resource('kamar', JumlahKamarController::class);
        Route::resource('kamar-mandi', KamarMandiController::class);
        Route::resource('tagihan-listrik', TagihanListrikController::class);
        Route::resource('pajak', PajakController::class);
        Route::resource('hutang', HutangController::class);
    });

    //hasil ranking
    Route::prefix('menu-ranking')->group(function () {
        Route::resource('bobot-kriteria', BobotController::class);
        Route::get('data-spk', [DataSpkController::class, 'index'])->name('menu-ranking.data-spk');
    });

    //menu pendidikan
    Route::prefix('menu-pendidikan')->group(function () {
        Route::resource('asal-jurusan', AsalJurusanController::class);
        Route::resource('jurusan', JurusanController::class);
        Route::resource('program-studi', ProdiController::class);
    });

    //menu ujian
    Route::prefix('menu-ujian')->group(function () {
        Route::resource('ujian', UjianController::class);
        Route::get('ujian/{ujian}', [UjianController::class, 'soal_ujian'])->name('soalUjian');
        Route::get('soal-ujian/{ujian}/create', [SoalUjianController::class, 'create'])->name('soal-ujian.create');
        Route::post('soal-ujian/{ujian}', [SoalUjianController::class, 'store'])->name('soal-ujian.store');
        Route::get('soal-ujian/{soalUjian}/{ujian}/edit', [SoalUjianController::class, 'edit'])->name('soal-ujian.edit');
        Route::put('soal-ujian/{soalUjian}/{ujian}', [SoalUjianController::class, 'update'])->name('soal-ujian.update');
        Route::delete('soal-ujian/{soalUjian}/{ujian}', [SoalUjianController::class, 'destroy'])->name('soal-ujian.destroy');
        Route::post('soal-ujian/import/{ujian}', [SoalUjianController::class, 'import'])->name('soal-ujian.import');
        Route::resource('sesi-ujian', SesiUjianController::class);
        Route::get('sesi-user/{sesi_ujian}', [SesiUjianController::class, 'sesi_user'])->name('sesiUjian');
        Route::get('sesi-user/{sesi_ujian}/create', [SesiUserController::class, 'create'])->name('sesi-user.create');
        Route::post('sesi-user/{sesi_ujian}', [SesiUserController::class, 'store'])->name('sesi-user.store');
        Route::delete('sesi-user/{sesiUser}/{sesi_ujian}', [SesiUserController::class, 'destroy'])->name('sesi-user.destroy');
        Route::get('laporan-nilai', [LaporanNilaiController::class, 'index'])->name('laporan-nilai.index');
        Route::get('laporan-nilai/export', [LaporanNilaiController::class, 'export'])->name('laporan-nilai.export');
    });

    Route::group(['prefix' => 'role-and-permission'], function () {
        //role
        Route::resource('role', RoleController::class);
        Route::get('role/export', ExportRoleController::class)->name('role.export');
        Route::post('role/import', ImportRoleController::class)->name('role.import');

        //permission
        Route::resource('permission', PermissionController::class);
        Route::get('permission/export', ExportPermissionController::class)->name('permission.export');
        Route::post('permission/import', ImportPermissionController::class)->name('permission.import');

        //assign permission
        Route::get('assign', [AssignPermissionController::class, 'index'])->name('assign.index');
        Route::get('assign/create', [AssignPermissionController::class, 'create'])->name('assign.create');
        Route::get('assign/{role}/edit', [AssignPermissionController::class, 'edit'])->name('assign.edit');
        Route::put('assign/{role}', [AssignPermissionController::class, 'update'])->name('assign.update');
        Route::post('assign', [AssignPermissionController::class, 'store'])->name('assign.store');

        //assign user to role
        Route::get('assign-user', [AssignUserToRoleController::class, 'index'])->name('assign.user.index');
        Route::get('assign-user/create', [AssignUserToRoleController::class, 'create'])->name('assign.user.create');
        Route::post('assign-user', [AssignUserToRoleController::class, 'store'])->name('assign.user.store');
        Route::get('assing-user/{user}/edit', [AssignUserToRoleController::class, 'edit'])->name('assign.user.edit');
        Route::put('assign-user/{user}', [AssignUserToRoleController::class, 'update'])->name('assign.user.update');
    });

    Route::get('biodata', [BiodataController::class, 'index'])->name('biodata.index');
    Route::post('biodata/store-or-update', [BiodataController::class, 'storeOrUpdate'])->name('biodata.storeOrUpdate');
    Route::post('biodata/store-or-update-spk', [BiodataSpkController::class, 'storeOrUpdate'])->name('biodata.storeOrUpdateSpk');
    Route::post('load-filter-prodi', [BiodataController::class, 'loadFilterProdi'])->name('loadFilterProdi');
    Route::get('get-prodi', [BiodataController::class, 'getProdis'])->name('getProdis');
    Route::post('load-filter-jurusan', [BiodataController::class, 'loadFilterJurusan'])->name('loadFilterJurusan');
    Route::get('get-jurusan', [BiodataController::class, 'getJurusans'])->name('getJurusans');

    Route::get('token-ujian', [TokenUjianController::class, 'index'])->name('token-ujian.index');
    Route::get('login-ujian', function () {
        return view('ujian-user.login');
    })->name('login.ujian');
    Route::post('login-ujian', [LoginUjianController::class, 'login_ujian'])->name('login.ujian.post');
    Route::middleware(['loggedin.ujian'])->group(function () {
        Route::get('list-ujian', [LoginUjianController::class, 'list_ujian'])->name('list.ujian');
        Route::get('detail-ujian/{sesiUjian}', [LoginUjianController::class, 'show_ujian'])->name('detail.ujian');
        Route::get('ujian/{sesiUjian}', [LoginUjianController::class, 'soal'])->name('ujian');
        Route::post('ujian/jawab/{soalUjian}/{sesiUjian}', [LoginUjianController::class, 'jawab'])->name('ujian.soal');
        Route::post('ujian/reset/{soalUjian}/{sesiUjian}', [LoginUjianController::class, 'reset_jawaban'])->name('reset.jawaban');
        Route::post('ujian/selesai/{sesiUjian}', [LoginUjianController::class, 'selesai'])->name('selesai.ujian');
    });
    Route::post('logout-ujian', [LoginUjianController::class, 'logout_ujian'])->name('logout.ujian');
});
