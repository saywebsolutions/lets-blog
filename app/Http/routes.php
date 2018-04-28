<?php

foreach (config('letsblog.routes') as $k => $v) {
    Route::get($k, $v);
}

if(config('letsblog.app.admin')){

    // admin section
    Route::group(['middleware' => ['web']], function () {

        Route::get('/admin', '\SayWebSolutions\LetsBlog\Http\Controllers\Admin\AdminController@index');
        Route::resource('/admin/posts', '\SayWebSolutions\LetsBlog\Http\Controllers\Admin\PostController');
        Route::resource('/admin/tags', '\SayWebSolutions\LetsBlog\Http\Controllers\Admin\TagController');

    });

}
