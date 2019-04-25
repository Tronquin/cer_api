<?php


Route::group(['prefix' => 'v1','middleware' => 'oauth2'], function () {

    // Rutas validadas por Oauth2
    
    Route::post('/singup', 'UserController@create');
    Route::post('/login', 'UserController@login');
    Route::post('/is-auth/{token}', 'UserController@isAuth');
    Route::post('/logout', 'UserController@logout');
    Route::get('/sitemap', 'General\SearchdController@siteMap');
    // Obtiene extras por ubicacion y tag al que pertenecen
    Route::get('/find/extra_by_tags/{type}/{ubicacion_id}', 'General\SearchdController@findExtraByLocationTag');

    // Busca logs de la maquina
    Route::get('find/machine/logs/{limit?}', 'General\SearchdController@machineLogs');
    // Obtiene historial de busquedas
    Route::get('find/search_history', 'General\SearchdController@findSearchFavorite');
    // obtiene los apartamentos de una ubicacion
    Route::get('/find/apartments/{ubicacion_id}', 'General\SearchdController@findApartmentsByLocation');
    // Busca la disponibilidad de los apartamentos por fechas y personas
    Route::post('/find/apartmenstDisponibility', 'General\SearchdController@findApartmentsDisponibility');
    // Busca la disponibilidad de los apartamentos por fechas y personas
    Route::post('/find/priceByNight', 'General\SearchdController@findPriceByNight');
    // Busca los POI por ubicacion
    Route::get('/find/poiByLocation/{ubicacion_id}', 'General\SearchdController@findPOIByLocation');
    // Busca las experiencias por ubicacion
    Route::get('/find/experiencesByLocation/{ubicacion_id?}', 'General\SearchdController@findExperiencesByLocation');
    // Busca los extras por ubicacion
    Route::get('/find/extrasByLocation/{ubicacion_id}', 'General\SearchdController@findExtrasByLocation');
    // Busca las tipologias por ubicacion
    Route::get('/find/typologyByLocation/{ubicacion_id}', 'General\SearchdController@findTypologyByLocation');
    // Busca las tipologias por ubicacion
    Route::get('/find/packagesByLocation/{ubicacion_id}', 'General\SearchdController@findPackagesByLocation');
    // Busca los extras destacados por ubicacion
    Route::get('/find/extras/outstanding/{ubicacion_id}', 'General\SearchdController@findExtrasOutstanding');
    // Busca las ubicaciones
    Route::get('/find/Locations', 'General\SearchdController@findLocations');
    // Obtiene todos los idiomas disponibles con su traduccion
    Route::get('language/list_translation/{device}', 'LanguageController@listTranslation');
    // Indicar falla en un dispositivo
    Route::post('/machine/device/fail/{device}/{machine}', 'MachineController@fail');
    // Obtener configuracion de maquinas
    Route::get('/machine/config/{publicId}', 'MachineController@config');
    // Obtener extras no-disponibles de una experiencia
    Route::get('/find/extrasForPurchase/{experience_id}/{ubicacion_id}', 'General\SearchdController@findExtrasForPurchase');
    // Obtener imagenes por galeria
    Route::get('/photo/{galleryCode}', 'PhotoController@photos');
    // Obtener imagenes por ubicacion
    Route::get('/photo/location/{ubicacion_id}', 'PhotoController@photosByLocation');
    // Obtener informacion del spa
    Route::get('/location/sagrada_familia/spa', 'SpaController@info');
    // Obtener cards
    Route::get('/find/cardinfo', 'Admin\CardInfoController@getCardInfo');
    // Obtener frequent questions
    Route::get('/find/frequentquestion', 'Admin\FrequentQuestionController@getFrequentquestions');
    // Obtener Section Apartment
    Route::get('/find/sectionapartment/{ubicacion_id}', 'Admin\SectionApartmentController@getSectionApartment');
    // Obtener fotos y mas
    Route::get('/find/photos_and_more/{ubicacionId}', 'PhotoAndMoreController@photoAndMore');
    // Obtener extras Oustanding
    Route::get('/find/extrasoustanding/{ubicacionId}', 'ExtrasOustandingController@getExtras');
    // Datos del usuario
    Route::get('/find/user/{email}', 'UserController@find');
    // Registrar una reserva
    Route::post('/reservation/create', 'ReservationController@createReservation');
    
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
        Route::delete('/persistence/statuschange/{reserva_id}', 'ReservationController@persistenceStatusChange');
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
        Route::get('/reservation/find/undelivered_key/{reserva_id}', 'ReservationController@undeliveredKey');
        // Obtener extra para la propina
        Route::get('/reservation/find/baksheesh/{reserva_id}', 'ReservationController@baksheesh');
        // Checkout de una reserva
        Route::post('/reservation/checkout', 'ReservationController@checkout');
        // Obtener reserva por codigo de llave
        Route::get('/reservation/find/bykey/{key}', 'ReservationController@findReservationByKey');
        // Pago por gateway
        Route::post('/reservation/paymentgateway', 'ReservationController@reservationPaymentGateway');
        // Obtiene la galeria por id
        Route::get('/reservation/find/gallery/{gallery_id}', 'ReservationController@getGallery');
        // Actualiza el checkin movil
        Route::post('/reservation/hascheckinmovil', 'ReservationController@hasCheckinMovil');
        // desactiva las llaves de una reserva
        Route::post('/reservation/deactivateKey', 'ReservationController@deactivateKey');
        // Datos de un usuario
        Route::get('user/{email}', 'UserController@find');
        // Actualizar Usuario
        Route::put('user/update/{user_id}', 'UserController@update');
        // Historial de reservas
        Route::get('/reservation/user/history/{email}', 'ReservationController@reservationHistory');
        // Obtener Reservas activas
        Route::get('/find/reservation/actives/{email}', 'ReservationController@reservationActiveByUser');
        
        //Rutas admin
        Route::group(['middleware' => 'adminAuth'], function () {
            // Obtiene tags
            Route::get('find/extra_tags', 'General\SearchdController@findExtraByTag');
            // massive extra by tags save
            Route::post('/admin/save/extra_tags', 'General\SearchdController@saveMasiveExtraTags');
            // Obtiene las experiencias version erp
            Route::get('/admin/experiences/{ubicacion_id}', 'Admin\HomeController@findExperiencesByLocation');
            //Obtiene los extras version erp
            Route::get('/admin/extras/{ubicacion_id}', 'Admin\HomeController@findExtrasByLocation');
            //Guarda o Modifica los extras version web
            Route::post('/admin/extras', 'Admin\HomeController@saveExtras');
            //Guarda o Modifica los packs version web
            Route::post('/admin/packages', 'Admin\HomeController@savePacks');
            // Administracion de maquinas
            Route::resource('/admin/machine', 'MachineController');
            // Listado de idiomas con traducciones
            Route::get('/admin/language/list', 'LanguageController@languageDevice');
            // Actualizar ubicaciones
            Route::put('/admin/location/{ubicationId}', 'LocationController@update');
            // Actualizar experiencias
            Route::put('/admin/experience/{experienceId}', 'ExperienceController@update');
            // Actualizar idiomas
            Route::put('/admin/language/list', 'LanguageController@update');
            // Crear galeria
            Route::post('/galery/create', 'GaleryController@create');
            // Obtener Imagenes de ERP
            Route::get('/find/galery/erp', 'GaleryController@erpGalery');
            // Guardar imagenes en galeria
            Route::post('/photo/create/{galleryCode}', 'PhotoController@create');
            
            //Obtener Documentos
            Route::get('/document', 'DocumentController@index');
            //Guarda Documentos
            Route::post('/document', 'DocumentController@store');
            //Eliminar Documentos
            Route::delete('/document/{documentId}', 'DocumentController@destroy');

            // Actualizar informacion del spa
            Route::put('/admin/sagrada_familia/spa', 'SpaController@update');
            // Agregar / Actualizar idiomas
            Route::post('/admin/translation/excel', 'DefaultController@importTranslation');
            Route::put('/admin/translation/excel', 'DefaultController@updateTranslation');
            // Actualizar card
            Route::post('/admin/cardinfo', 'Admin\CardInfoController@updateOrCreateCardInfo');
            // Actualizar las pregunta frecuente
            Route::post('/admin/frequentquestion', 'Admin\FrequentQuestionController@updateOrCreateFrequentQuestion');
            // Actualizar las secciones de apartamentos
            Route::post('/admin/sectionapartment/{ubicacion_id}', 'Admin\SectionApartmentController@updateOrCreateSectionApartment');
            // Gestion de fotos y mas
            Route::post('/admin/photos_and_more/{ubicacionId}', 'PhotoAndMoreController@store');
            // Crea o Actualiza extras Oustanding
            Route::put('/admin/extrasoustanding/{ubicacionId}', 'ExtrasOustandingController@updateOrCreateExtras');
            // Elimina Documento de extra Outstanding
            Route::delete('/admin/extrasoustanding/{documentId}', 'ExtrasOustandingController@destroyDocument');
            // Configura experiencia predeterminada del home
            Route::put('/admin/home/default_experience/{ubicacion_id}', 'Admin\HomeController@setDefaultExperience');
            // Configura caracteristicas
            Route::resource('/admin/master/characteristic', 'Admin\CharacteristicController');
        });
    });
});
