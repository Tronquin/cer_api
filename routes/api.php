<?php


Route::group(['prefix' => 'v1'], function () {

    // Reservation Checkin
    Route::get('/checkin/{reserva_id}', 'ReservationController@reservationCheckin');
    // Find all Reservation to checkin by date
    Route::get('/reservation/checkin/{ubicacion_id}/{date}', 'ReservationController@findReservationToCheckin');
    // Reservation por localizador o apellido
    Route::get('/reservation/{numberCodeOrName}', 'ReservationController@findReservation');
    // Reservation por id
    Route::get('/find/reservation/{numberCodeOrName}', 'ReservationController@findReservationById');
    // Reservation edicion
    Route::get('/reservation/change/data/', 'ReservationController@changeReservation');
    // Reservation busqueda de cambios disponibles
    Route::get('/reservation/find/room', 'ReservationController@availabilityRoom');

});
