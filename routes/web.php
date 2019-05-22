<?php

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
Auth::routes([
    'register' => true, // Registration Routes...
    'reset' => false, // Password Reset Routes...
    'verify' => false, // Email Verification Routes...
]);

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/home/categorie', 'HomeController@categorie')->name('home');
Route::get('/home/moderator', 'moderatorsController@index')->name('home');
Route::get('/home/contact', 'HomeController@contact')->name('home');
Route::get('/home/edithome', 'HomepageArtikelController@index')->name('home');
Route::get('/home/gebruikers', 'HomeController@gebruikers')->name('home');
Route::get('/home/help', 'HomeController@help')->name('home');
Route::get('/home/agreement', 'HomeController@agreement')->name('home');
Route::get('/home/mail', 'HomeController@mail')->name('home');
Route::get('/home/posts', 'HomeController@posts')->name('home');

Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');
Route::get('home/Uitloggen', '\App\Http\Controllers\Auth\LoginController@logout');

// admin stuff
Route::post('/home/newCategorie', 'CategorieController@store');
Route::post('/home/updateCategorie', 'CategorieController@updateCat');
Route::post('/home/storeContact', 'ContactController@store');
Route::post('/home/updateHelp', 'helpController@updateHelp');
Route::post('/home/updateAgreement', 'agreementController@updateAgreement');

Route::post('/home/deleteCategorie', 'CategorieController@delete');
Route::post('/home/updateHome', 'HomepageArtikelController@update');
Route::post('/home/update_moderator', 'moderatorsController@update');
Route::post('/home/delete_moderator', 'moderatorsController@delete');

Route::post('add_carousel', 'HomeController@add_carousel');
Route::post('/home/del_carousel', 'HomeController@del_carousel');

Route::post('/home/delete_gebruiker', 'GebruikerController@delete_gebruiker');
Route::post('/home/delete_mail', 'HomeController@delete_mail');

Route::post('/posts/deletePostWithId', 'PostController@deleteWithId');
Route::post('/posts/deleteReplyWithId', 'PostReplyController@deleteWithId');

Route::post('/home/admin_verify_post', 'PostController@admin_verify_post');
Route::post('/home/admin_handelaf_post', 'PostController@admin_handelaf_post');
Route::post('/home/admin_delete_post', 'PostController@admin_delete_post');




// home
Route::get('/', 'CategorieController@home');

//cats 
Route::get('/categorieen', 'CategorieController@categorieen');

// USER STUFF

//creating a post
Route::get('/posts/create', 'PostController@create');
//showing one post
Route::get('/posts/{post}/', 'PostController@showPost');
//posting the post
Route::post('posts/create', 'PostController@store');

//contact
Route::get('contact', 'ContactController@index');
Route::post('verstuur_contact_formulier', 'ContactController@sendmail');

//help 
Route::get('help', 'helpController@index');
Route::get('voorwaarden', 'agreementController@index');

//reageren op een post
Route::get('reageren/{post}/', 'PostReplyController@reageren');
//reageren op de post - post
Route::post('reageren/create', 'PostReplyController@create_reactie');
//reageren op een reactie van een reactie :P
Route::get('reageer_op/{hash}', 'reageerController@index');
Route::post('reageer', 'reageerController@reageer');
//email verify
Route::get('verificatie/p/{hash}', 'PostController@verify');
Route::get('verificatie/r/{hash}', 'reageerController@verify');

Route::get('verwijder_post/{hash}', 'PostController@user_verify_remove');
Route::post('verwijder_post', 'PostController@user_remove');

Route::get('verwijder_bericht/{hash}', 'reageerController@user_verify_remove');
Route::post('verwijder_bericht', 'reageerController@user_remove');

Route::get('bericht_afhandelen/{hash}', 'PostController@user_verify_afhandellen');
Route::post('bericht_afhandelen', 'PostController@user_afhandellen');
//showing all posts
Route::get('/{slug}/', 'PostController@posts');

// USER STUFF END

