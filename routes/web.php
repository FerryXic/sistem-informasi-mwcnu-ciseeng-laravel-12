<?php

// SUPERADMIN

use App\Http\Controllers\SuperAdmin\AdArtController as SuperAdminAdArtController;
use App\Http\Controllers\SuperAdmin\DashboardController as SuperAdminDashboardController;
use App\Http\Controllers\SuperAdmin\ProfileController  as SuperAdminProfileController;
use App\Http\Controllers\SuperAdmin\ManajemenPostController as SuperAdminManajemenPostController;
use App\Http\Controllers\SuperAdmin\AktivitasController as SuperAdminAktivitasController;
use App\Http\Controllers\SuperAdmin\ManajemenSuratController as SuperAdminManajemenSuratController;
use App\Http\Controllers\SuperAdmin\SkController as SuperAdminSkController;
use App\Http\Controllers\SuperAdmin\StrukturOrganisasiController as SuperAdminStrukturOrganisasiController;
use App\Http\Controllers\SuperAdmin\ProgramKerjaController as SuperAdminProgramKerjaController;
use App\Http\Controllers\SuperAdmin\ManajemenAkunController;

// ADMIN
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\AktivitasController as AdminAktivitasController;
use App\Http\Controllers\Admin\ProfileController  as AdminProfileController;
use App\Http\Controllers\Admin\ManajemenPostController as AdminManajemenPostController;
use App\Http\Controllers\Admin\ManajemenSuratController as AdminManajemenSuratController;
use App\Http\Controllers\Admin\ProgramKerjaController as AdminProgramKerjaController;
use App\Http\Controllers\Admin\SkController as AdminSkController;
use App\Http\Controllers\Admin\StrukturOrganisasiController as AdminStrukturOrganisasiController;
use App\Http\Controllers\Admin\AdArtController as AdminAdArtController;

// USER
use App\Http\Controllers\User\DashboardController;
use App\Http\Controllers\User\PostController;
use App\Http\Controllers\User\ProfileController;
use App\Http\Controllers\User\SuratController;
use App\Http\Controllers\User\Tupoksi\SkController;
use App\Http\Controllers\User\TupoksiController;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\User\AdArtController;
use App\Http\Controllers\User\ProgramKerjaController;
use App\Http\Controllers\User\SkController as UserSkController;
use App\Http\Controllers\User\StrukturOrganisasiController;

// user
Route::get('/', [DashboardController::class, 'index'])->name('Index.Dashboard');

Route::prefix('posts')->group(function () {
    Route::get('/program-kerja', [ProgramKerjaController::class, 'index'])->name('Index.ProgramKerja');
    Route::get('/program-kerja/{post:title}', [ProgramKerjaController::class, 'show'])->name('Show.ProgramKerja');

    Route::get('/', [PostController::class, 'index'])->name('Index.Post');
    Route::get('/{post:title}', [PostController::class, 'show'])->name('Show.Post');
});


Route::get('/profil/{section}', [ProfileController::class, 'index'])->name('Index.Profile');

Route::get('/surat/{tipe}', [SuratController::class, 'index'])->name('Index.Surat');

Route::prefix('tupoksi')->group(function () {
    Route::get('/sk', [UserSkController::class, 'index'])->name('Index.Tupoksi.SK');
    Route::get('/struktur-organisasi', [StrukturOrganisasiController::class, 'index'])->name('Index.Tupoksi.StrukturOrganisasi');
    Route::get('/ad-art', [AdArtController::class, 'index'])->name('Index.Tupoksi.AdArt');
});


// auth
Route::get('/login', [AuthController::class, 'index'])->name('Index');
Route::post('/login', [AuthController::class, 'login'])->name('login');

// pengecekan login
Route::middleware(['AuthCheck'])->group(function () {
    // admin
    Route::prefix('admin')->group(function () {

        // dashboard
        Route::get('/', [AdminDashboardController::class, 'index'])->name('Index.Dashboard.A');

        // aktivitas
        Route::get('/aktivitas', [AdminAktivitasController::class, 'index'])->name('Index.Aktivitas.A');

        // profile
        Route::prefix('/profile')->group(function () {
            Route::get('/', [AdminProfileController::class, 'index'])->name('Index.Profile.A');
            Route::put('/update', [AdminProfileController::class, 'update'])->name('Update.Profile.A');
        });

        // manajemen post
        Route::prefix('/manajemen-post')->group(function () {
            Route::get('/', [AdminManajemenPostController::class, 'index'])->name('Index.ManajemenPost.A');
            Route::post('/store', [AdminManajemenPostController::class, 'store'])->name('Store.ManajemenPost.A');
            Route::put('/update/{id}', [AdminManajemenPostController::class, 'update'])->name('Update.ManajemenPost.A');
            Route::delete('/destroy/{id}', [AdminManajemenPostController::class, 'destroy'])->name('Destroy.ManajemenPost.A');
        });

        // manajemen tupoksi
        Route::prefix('/manajemen-tupoksi')->group(function () {

            Route::prefix('/sk')->group(function () {
                Route::get('/', [AdminSkController::class, 'index'])->name('Index.SK.A');
                Route::post('/store', [AdminSkController::class, 'store'])->name('Store.SK.A');
                Route::delete('/delete/{id}', [AdminSkController::class, 'destroy'])->name('Delete.SK.A');
            });

            // struktur organisasi
            Route::prefix('/struktur-organisasi')->group(function () {
                Route::get('/', [AdminStrukturOrganisasiController::class, 'index'])->name('Index.StrukturOrganisasi.A');
                Route::post('/store', [AdminStrukturOrganisasiController::class, 'store'])->name('Store.StrukturOrganisasi.A');
                Route::put('/update/{id}', [AdminStrukturOrganisasiController::class, 'update'])->name('Update.StrukturOrganisasi.A');
                Route::delete('/delete/{id}', [AdminStrukturOrganisasiController::class, 'destroy'])->name('Delete.StrukturOrganisasi.A');
            });

            // ad art
            Route::prefix('/ad-art')->group(function () {
                Route::get('/', [AdminAdArtController::class, 'index'])->name('Index.AdArt.A');
                Route::post('/store', [AdminAdArtController::class, 'store'])->name('Store.AdArt.A');
                Route::put('/update/{id}', [AdminAdArtController::class, 'update'])->name('Update.AdArt.A');
                Route::delete('/delete/{id}', [AdminAdArtController::class, 'destroy'])->name('Delete.AdArt.A');
            });
        });

        // manajemen surat
        Route::prefix('/manajemen-surat')->group(function () {
            Route::get('/', [AdminManajemenSuratController::class, 'index'])->name('Index.ManajemenSurat.A');
            Route::post('/store', [AdminManajemenSuratController::class, 'store'])->name('Store.ManajemenSurat.A');
            Route::put('/update/{id}', [AdminManajemenSuratController::class, 'update'])->name('Update.ManajemenSurat.A');
            Route::delete('/delete/{id}', [AdminManajemenSuratController::class, 'destroy'])->name('Delete.ManajemenSurat.A');
        });

        // logout
        Route::post('/logout', [AuthController::class, 'logout'])->name('logout.A');

    });

    // superadmin
    Route::prefix('super-admin')->group(function () {

        // dashboard
        Route::get('/', [SuperAdminDashboardController::class, 'index'])->name('Index.Dashboard.SA');
        
        // aktivitas
        Route::get('/aktivitas', [SuperAdminAktivitasController::class, 'index'])->name('Index.Aktivitas.SA');

        // profile
        Route::prefix('/profile')->group(function () {
            Route::get('/', [SuperAdminProfileController::class, 'index'])->name('Index.Profile.SA');
            Route::put('/update', [SuperAdminProfileController::class, 'update'])->name('Update.Profile.SA');
        });

        // manajemen akun
        Route::prefix('/manajemen-akun')->group(function () {
            Route::get('/', [ManajemenAkunController::class, 'index'])->name('Index.ManajemenAkun.SA');
            Route::post('/store', [ManajemenAkunController::class, 'store'])->name('Store.ManajemenAkun.SA');
            Route::put('/update/{id}', [ManajemenAkunController::class, 'update'])->name('Update.ManajemenAkun.SA');
            Route::delete('/destroy/{id}', [ManajemenAkunController::class, 'destroy'])->name('Destroy.ManajemenAkun.SA');
        });

        // manajemen post
        Route::prefix('/manajemen-post')->group(function () {
            Route::get('/', [SuperAdminManajemenPostController::class, 'index'])->name('Index.ManajemenPost.SA');
            Route::post('/store', [SuperAdminManajemenPostController::class, 'store'])->name('Store.ManajemenPost.SA');
            Route::put('/update/{id}', [SuperAdminManajemenPostController::class, 'update'])->name('Update.ManajemenPost.SA');
            Route::delete('/destroy/{id}', [SuperAdminManajemenPostController::class, 'destroy'])->name('Destroy.ManajemenPost.SA');
        });

        // manajemen tupoksi
        Route::prefix('/manajemen-tupoksi')->group(function () {

            // sk
            Route::prefix('/sk')->group(function () {
                Route::get('/', [SuperAdminSkController::class, 'index'])->name('Index.SK.SA');
                Route::post('/store', [SuperAdminSkController::class, 'store'])->name('Store.SK.SA');
                Route::delete('/delete/{id}', [SuperAdminSkController::class, 'destroy'])->name('Delete.SK.SA');
            });

            // struktur organisasi
            Route::prefix('/struktur-organisasi')->group(function () {
                Route::get('/', [SuperAdminStrukturOrganisasiController::class, 'index'])->name('Index.StrukturOrganisasi.SA');
                Route::post('/store', [SuperAdminStrukturOrganisasiController::class, 'store'])->name('Store.StrukturOrganisasi.SA');
                Route::put('/update/{id}', [SuperAdminStrukturOrganisasiController::class, 'update'])->name('Update.StrukturOrganisasi.SA');
                Route::delete('/delete/{id}', [SuperAdminStrukturOrganisasiController::class, 'destroy'])->name('Delete.StrukturOrganisasi.SA');
            });

            // ad art
            Route::prefix('/ad-art')->group(function () {
                Route::get('/', [SuperAdminAdArtController::class, 'index'])->name('Index.AdArt.SA');
                Route::post('/store', [SuperAdminAdArtController::class, 'store'])->name('Store.AdArt.SA');
                Route::put('/update/{id}', [SuperAdminAdArtController::class, 'update'])->name('Update.AdArt.SA');
                Route::delete('/delete/{id}', [SuperAdminAdArtController::class, 'destroy'])->name('Delete.AdArt.SA');
            });
        });

        // manajemen surat
        Route::prefix('/manajemen-surat')->group(function () {
            Route::get('/', [SuperAdminManajemenSuratController::class, 'index'])->name('Index.ManajemenSurat.SA');
            Route::post('/store', [SuperAdminManajemenSuratController::class, 'store'])->name('Store.ManajemenSurat.SA');
            Route::put('/update/{id}', [SuperAdminManajemenSuratController::class, 'update'])->name('Update.ManajemenSurat.SA');
            Route::delete('/delete/{id}', [SuperAdminManajemenSuratController::class, 'destroy'])->name('Delete.ManajemenSurat.SA');
        });
        

        // logout
        Route::post('/logout', [AuthController::class, 'logout'])->name('logout.SA');
        
    });
});
