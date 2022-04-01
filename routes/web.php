<?php

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

require __DIR__ . '/crud.php';

require __DIR__ . '/auth.php';

Route::view('/privacy', 'privacy')->name('privacy');

Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['auth', 'role:admin|super-admin']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'role:admin|super-admin'])->group(function () {
    Route::get('/home', App\Http\Livewire\Admin\Home::class)
        ->name('home');
    Route::get('/profile', App\Http\Livewire\Admin\ProfilePage::class)
        ->name('profile');
});

Route::middleware(['auth', 'role:super-admin'])->group(function () {

    Route::get('/user', App\Http\Livewire\User\UserPage::class)
        ->name('user');
    Route::get('/user/form/{user_id?}', App\Http\Livewire\User\UserForm::class)
        ->name('user.form');

    Route::get("/setting", App\Http\Livewire\Setting\SettingPage::class)
        ->name("setting");

    Route::get("/slider", App\Http\Livewire\Slider\SliderPage::class)
        ->name("slider");

    Route::get("/category", App\Http\Livewire\Category\CategoryPage::class)
        ->name("category");

    Route::get("/berita", App\Http\Livewire\Berita\BeritaPage::class)
        ->name("berita");
    Route::get("/berita/form/{id?}", App\Http\Livewire\Berita\BeritaForm::class)
        ->name("berita.form");

    Route::get("/gallery", App\Http\Livewire\Gallery\GalleryPage::class)
        ->name("gallery");

    Route::get("/halaman", App\Http\Livewire\Halaman\HalamanPage::class)
        ->name("halaman");
    Route::get("/halaman/form/{halaman_id?}", App\Http\Livewire\Halaman\HalamanForm::class)
        ->name("halaman.form");

    Route::get("/contact", App\Http\Livewire\Contact\ContactPage::class)
        ->name("contact");

    Route::get("/link-terkait", App\Http\Livewire\LinkTerkait\LinkTerkaitPage::class)
        ->name("link-terkait");

    Route::get("/pengumuman", App\Http\Livewire\Pengumuman\PengumumanPage::class)
        ->name("pengumuman");

    Route::get("/youtube", App\Http\Livewire\Youtube\YoutubePage::class)
        ->name("youtube");

    Route::get("/menu", App\Http\Livewire\Menu\MenuPage::class)
        ->name("menu");

});
