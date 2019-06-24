<?php

#plugin
    Route::prefix('dt')->name('dt.')->group(function () {
        Route::get('/kpsk', 'KPSKController@dt')->name('kpsk');
        Route::get('/kpsk/kp/{sk}', 'KPSKController@dtKP')->name('kpsk.kp');
    });

#custom
    Route::prefix('kpsk')->name('kpsk.')->group(function () {
        Route::prefix('kp')->name('kp.')->group(function () {
            Route::get('/{sk}', 'KPSKController@kp')->name('index');
            Route::post('/', 'KPSKController@kpStore')->name('store');
        });
    });

#resource
    Route::resource('kpsk', 'KPSKController', ['only' => [
        'index', 'create', 'store'
    ]]);