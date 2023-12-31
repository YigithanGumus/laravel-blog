<?php

use Illuminate\Support\Facades\Route;



/*
|--------------------------------------------------------------------------
| Backend Routes
|--------------------------------------------------------------------------
*/

Route::prefix('admin')->name('admin.')->middleware('isLogin')->group(function () {
    Route::get('giris', 'Back\AuthController@login')->name('login');
    Route::post('giris', 'Back\AuthController@loginPost')->name('login.post');
});

Route::prefix('admin')->name('admin.')->middleware('isAdmin')->group(function () {
    Route::get('panel', 'Back\Dashboard@index')->name('dashboard');
    // MAKALE ROUTE'S
    Route::get('makaleler/silinenler', 'Back\ArticleController@trashed')->name('trashed.article');
    Route::resource('makaleler','Back\ArticleController');
    Route::get('/switch','Back\ArticleController@switch')->name('switch');
    Route::get('/deletearticle/{id}','Back\ArticleController@delete')->name('delete.article');
    Route::get('/harddeletearticle/{id}','Back\ArticleController@hardDelete')->name('hard.delete.article');
    Route::get('/recoverarticle/{id}','Back\ArticleController@recover')->name('recover.article');
    // KATEGORİ ROUTE'S
    Route::get('kategoriler','Back\CategoryController@index')->name('category.index');
    Route::post('kategoriler/create','Back\CategoryController@create')->name('category.create');
    Route::post('kategoriler/update','Back\CategoryController@update')->name('category.update');
    Route::get('kategoriler/delete','Back\CategoryController@delete')->name('category.delete');
    Route::get('kategoriler/status','Back\CategoryController@switch')->name('category.switch');
    Route::get('kategoriler/getData','Back\CategoryController@getData')->name('category.getdata');
    //Page's route's
    Route::get('/sayfalar','Back\PageController@index')->name('page.index');
    Route::get('/sayfalar/olustur','Back\PageController@create')->name('page.create');
    Route::get('/sayfalar/guncelle/{id}','Back\PageController@update')->name('page.edit');
    Route::post('/sayfalar/guncelle/{id}','Back\PageController@updatePost')->name('page.edit.post');
    Route::post('/sayfalar/olustur','Back\PageController@post')->name('page.create.post');
    Route::get('/sayfalar/switch','Back\PageController@switch')->name('page.switch');
    Route::get('/sayfalar/sil/{id}','Back\PageController@delete')->name('page.delete');
    Route::get('/sayfalar/siralama','Back\PageController@orders')->name('page.orders');
    //
    Route::get('/ayarlar','Back/ConfigController@index')->name('config.index');
    Route::get('cikis', 'Back\AuthController@logout')->name('logout');
});

/*
|--------------------------------------------------------------------------
| Front Routes
|--------------------------------------------------------------------------
*/

Route::get('/', 'Front\Homepage@index')->name('homepage');
Route::get('/sayfa', 'Front\Homepage@index');
Route::get('/iletisim', 'Front\Homepage@contact')->name('contact');
Route::post('/iletisim', 'Front\Homepage@contactpost')->name('contact.post');
Route::get('/kategori/{category}', 'Front\Homepage@category')->name('category');
Route::get('/{category}/{slug}', 'Front\Homepage@single')->name('single');
Route::get('/{sayfa}', 'Front\Homepage@page')->name('page');
