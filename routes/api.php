<?php


Route::group(['prefix' => 'v1'], function () {

    // Reservation
    Route::get('/reservation/checkin/{ubicacion_id}/{date}', 'ReservationController@findReservationToCheckin');
    // Reservation to checkin
    Route::get('/reservation/{numberCodeOrName}', 'ReservationController@findReservation');
    // Reservation edicion
    Route::get('/reservation/change/{numberOrCode}', 'ReservationController@changeReservation');

});
