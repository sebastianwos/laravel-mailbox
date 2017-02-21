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

Route::group(['middleware' => 'auth'], function () {

    Route::get('/home', 'HomeController@index');
    Route::get('mailbox/{id}', 'HomeController@getMessages')->name('messages');

});

//Route::get('/', function () {
//
//    $server = new Server(('imap.gmail.com'));
//    $connection = $server->authenticate(env('MAIL_USERNAME'), env('MAIL_PASSWORD'));
//
//    $mailboxes = $connection->getMailboxes();
//
//    return view('welcome', compact('mailboxes'));
//
//
//});
//
//Route::get('/mailbox/{name}', function ($name) {
//
//    $server = new Server(('imap.gmail.com'));
//    $connection = $server->authenticate(env('MAIL_USERNAME'), env('MAIL_PASSWORD'));
//
//    $mailbox = $connection->getMailbox(decrypt($name));
//
//    return view('mailbox', compact('mailbox'));
//
//
//});
