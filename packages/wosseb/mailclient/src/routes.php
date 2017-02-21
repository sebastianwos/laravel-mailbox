<?php
/**
 * Created by PhpStorm.
 * User: Luxite
 * Date: 2017-02-10
 * Time: 10:11
 */


Route::group(['middleware' => 'web'], function () {

    Route::get('home', 'Wosseb\Mailclient\Http\Controllers\HomeController@index');
    Route::get('mailbox/{id}', 'Wosseb\Mailclient\Http\Controllers\HomeController@getMessages')->name('messages');
    Route::get('mailbox/{mailbox_id}/{message_id}', 'Wosseb\Mailclient\Http\Controllers\HomeController@getMessage')->name('message');

});