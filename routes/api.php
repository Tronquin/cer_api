<?php


Route::group(['prefix' => 'v1'], function () {

    // Reservation
    Route::get('/reservation/{reservation}', 'ReservationController@findReservation');

});
