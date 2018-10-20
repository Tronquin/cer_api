<?php


Route::group(['prefix' => 'v1','middleware' => 'oauth2'], function () {

    // Rutas validadas por Oauth2
    
    Route::post('/singup', 'UserController@create');
    Route::post('/login', 'UserController@login');

    Route::group(['middleware' => 'sessionAuth'], function () {
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
        // Obtiene los datos modificados de la reserva de cer-api
        Route::get('/persistence/reservation/{reserva_id}', 'ReservationController@reservationFindPersistence');
        // Obtiene la disponibilidad de un apartamento
        Route::get('/reservation/find/disponibility/{reserva_id}/{apartamento_id}/{tipologia_id}', 'ReservationController@apartmentDisponibility');
        // elimina la persistencia de una reserva
        Route::delete('/persistence/delete/{reserva_id}', 'ReservationController@deletePersistence');
        // Envia al erp los datos modificados de la reserva al realizar el pago
        Route::get('/reservation/find/earlycheckin/{reserva_id}', 'ReservationController@earlyAndLateCheckin');
        // Guarda los datos modificados de la reserva en cer-api
        Route::post('/persistence/reservation', 'ReservationController@reservationPersistence');
        // Guarda los datos modificados de los huespedes de la reserva
        Route::post('/persistence/guest', 'ReservationController@reservationGuestPersistence');
        // Envia la imagen del pasaporte del huesped al erp para guardarla y procesarla
        Route::post('/scan/guest', 'ReservationController@scanGuestPassport');
        // Modifica los datos de los pasaportes/guest
        Route::post('/edit/guest', 'ReservationController@updateGuestPassaport');
        // Envia al erp los datos modificados de la reserva al realizar el pago
        Route::post('/reservation/payment', 'ReservationController@reservationPayment');
        // Envia al erp los datos modificados de la reserva al realizar el pago
        Route::post('/reservation/rate', 'ReservationController@generateRate');
        // Envia al erp los datos modificados de la reserva al realizar el pago
        Route::post('/persistence/service', 'ReservationController@reservationServicePersistence');
        // Envia al erp los datos modificados de la reserva al realizar el pago
        Route::post('/persistence/oneservice', 'ReservationController@oneServicePeristence');
        // guarda el feedback de la reserva
        Route::post('/reservation/feedback', 'ReservationController@reservationFeedback');
        // guarda el numero de llaves entregadas
        Route::post('/reservation/keydelivered', 'ReservationController@keysDelivered');
        // guarda el numero de llaves recibidas
        Route::post('/reservation/keyreceived', 'ReservationController@KeyReceived');
        // edita el email del cliente
        Route::post('/reservation/editmail', 'ReservationController@editMail');
        // Obtener extra llave no entregada
        Route::get('/extra/undelivered_key/{reserva_id}', 'ReservationController@undeliveredKey');
        // Obtener extra para la propina
        Route::get('/extra/baksheesh/{reserva_id}', 'ReservationController@baksheesh');
        // Checkout de una reserva
        Route::post('/reservation/checkout', 'ReservationController@checkout');
    });
});
