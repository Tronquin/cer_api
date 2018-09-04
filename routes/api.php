<?php


Route::group(['prefix' => 'v1'], function () {

    // Reservation Checkin
    Route::get('/checkin/{reserva_id}', 'ReservationController@reservationCheckin');
    // Find all Reservation to checkin by date
    Route::get('/reservation/checkin/{ubicacion_id}/{date}', 'ReservationController@findReservationToCheckin');
    // Reservation por localizador o apellido
    Route::get('/reservation/{numberCodeOrName}/{ubicacion_id}', 'ReservationController@findReservation');
    // Reservation por id (url)
    Route::get('/find/reservation/{numberCodeOrName}', 'ReservationController@findReservationById');
    // Reservation por id (post)
    //Route::get('/reservation/find/{reserva_id}', 'ReservationController@reservationFindById');
    // Reservation busqueda de habitaciones disponibles
    Route::get('/reservation/find/room/{reserva_id}', 'ReservationController@availabilityRoom');
    // Reservation busqueda de planes disponibles
    Route::get('/reservation/find/plan/{reserva_id}', 'ReservationController@availabilityPlan');
    // Reservation busqueda de experiencias disponibles
    Route::get('/reservation/find/experiences/{reserva_id}', 'ReservationController@availabilityExperience');
    // Reservation busqueda de servicios disponibles
    Route::get('/reservation/find/services/{reserva_id}/{funcion}', 'ReservationController@availabilityService');
    // Guarda los datos modificados de la reserva en cer-api
    Route::post('/persistence/reservation', 'ReservationController@reservationPersistence');
    // Obtiene los datos modificados de la reserva de cer-api
    Route::get('/persistence/reservation/{reserva_id}', 'ReservationController@reservationFindPersistence');
    // Guarda los datos modificados de los huespedes de la reserva
    Route::post('/persistence/guest', 'ReservationController@reservationGuestPersistence');
    // Envia la imagen del pasaporte del huesped al erp para guardarla y procesarla
    Route::post('/scan/guest', 'ReservationController@scanGuestPassport');
    // Envia al erp los datos modificados de la reserva al realizar el pago
    Route::post('/reservation/payment', 'ReservationController@reservationPayment');

});
