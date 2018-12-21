<?php

use Illuminate\Database\Seeder;

class LanguageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->machineTranslations();
        $this->webTranslations();
    }

    private function webTranslations()
    {
        $device = \App\DeviceType::where('code', 'web')->first();
        $languages = \App\Language::all();


        $key = new App\KeyTranslation();
        $key->key = trim("layouts.footer.whatsreserve	");
        $key->device_type_id = $device->id;
        $key->save();

        foreach ($languages as $language) {
            $key->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? trim("¿Por qué <span class='highligth'>reservar</span> aquí?               ") : ""
            ]);
        }

        $key = new App\KeyTranslation();
        $key->key = trim("layouts.footer.doubts	");
        $key->device_type_id = $device->id;
        $key->save();

        foreach ($languages as $language) {
            $key->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? trim("¿Dudas?") : ""
            ]);
        }

        $key = new App\KeyTranslation();
        $key->key = trim("layouts.footer.emaicastro	");
        $key->device_type_id = $device->id;
        $key->save();

        foreach ($languages as $language) {
            $key->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? trim("welcome@castroexclusiveresidences.com    ") : ""
            ]);
        }

        $key = new App\KeyTranslation();
        $key->key = trim("layouts.footer.expience	");
        $key->device_type_id = $device->id;
        $key->save();

        foreach ($languages as $language) {
            $key->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? trim("Experiencias") : ""
            ]);
        }

        $key = new App\KeyTranslation();
        $key->key = trim("layouts.footer.sant	");
        $key->device_type_id = $device->id;
        $key->save();

        foreach ($languages as $language) {
            $key->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? trim("Sant Pau") : ""
            ]);
        }

        $key = new App\KeyTranslation();
        $key->key = trim("layouts.footer.checkin	");
        $key->device_type_id = $device->id;
        $key->save();

        foreach ($languages as $language) {
            $key->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? trim("Máquina Check-in") : ""
            ]);
        }

        $key = new App\KeyTranslation();
        $key->key = trim("layouts.footer.spa	");
        $key->device_type_id = $device->id;
        $key->save();

        foreach ($languages as $language) {
            $key->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? trim("SPA Sagrada Familia  ") : ""
            ]);
        }

        $key = new App\KeyTranslation();
        $key->key = trim("layouts.footer.exxp	");
        $key->device_type_id = $device->id;
        $key->save();

        foreach ($languages as $language) {
            $key->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? trim("Check-in Express") : ""
            ]);
        }

        $key = new App\KeyTranslation();
        $key->key = trim("layouts.footer.knock	");
        $key->device_type_id = $device->id;
        $key->save();

        foreach ($languages as $language) {
            $key->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? trim("Knock Knock") : ""
            ]);
        }

        $key = new App\KeyTranslation();
        $key->key = trim("layouts.footer.name	");
        $key->device_type_id = $device->id;
        $key->save();

        foreach ($languages as $language) {
            $key->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? trim("Tu nombre") : ""
            ]);
        }

        $key = new App\KeyTranslation();
        $key->key = trim("layouts.footer.email	");
        $key->device_type_id = $device->id;
        $key->save();

        foreach ($languages as $language) {
            $key->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? trim("Tu correo*") : ""
            ]);
        }

        $key = new App\KeyTranslation();
        $key->key = trim("layouts.footer.message	");
        $key->device_type_id = $device->id;
        $key->save();

        foreach ($languages as $language) {
            $key->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? trim("Mensaje") : ""
            ]);
        }

        $key = new App\KeyTranslation();
        $key->key = trim("layouts.footer.send	");
        $key->device_type_id = $device->id;
        $key->save();

        foreach ($languages as $language) {
            $key->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? trim("Enviar") : ""
            ]);
        }

        $key = new App\KeyTranslation();
        $key->key = trim("layouts.footer.copyright	");
        $key->device_type_id = $device->id;
        $key->save();

        foreach ($languages as $language) {
            $key->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? trim("Copyright 2018 castro Exclusive Residences - All rights reserved") : ""
            ]);
        }

        $key = new App\KeyTranslation();
        $key->key = trim("layouts.navbar.home	");
        $key->device_type_id = $device->id;
        $key->save();

        foreach ($languages as $language) {
            $key->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? trim("Home ") : ""
            ]);
        }

        $key = new App\KeyTranslation();
        $key->key = trim("layouts.navbar.apartament	");
        $key->device_type_id = $device->id;
        $key->save();

        foreach ($languages as $language) {
            $key->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? trim("Apartament") : ""
            ]);
        }

        $key = new App\KeyTranslation();
        $key->key = trim("layouts.navbar.sagrada	");
        $key->device_type_id = $device->id;
        $key->save();

        foreach ($languages as $language) {
            $key->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? trim("SPA Sagrada Familia") : ""
            ]);
        }

        $key = new App\KeyTranslation();
        $key->key = trim("layouts.navbar.pau	");
        $key->device_type_id = $device->id;
        $key->save();

        foreach ($languages as $language) {
            $key->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? trim("San Pau") : ""
            ]);
        }

        $key = new App\KeyTranslation();
        $key->key = trim("layouts.navbar.gracia	");
        $key->device_type_id = $device->id;
        $key->save();

        foreach ($languages as $language) {
            $key->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? trim("Gracia") : ""
            ]);
        }

        $key = new App\KeyTranslation();
        $key->key = trim("layouts.navbar.tecnology	");
        $key->device_type_id = $device->id;
        $key->save();

        foreach ($languages as $language) {
            $key->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? trim("Technology") : ""
            ]);
        }

        $key = new App\KeyTranslation();
        $key->key = trim("layouts.navbar.blog	");
        $key->device_type_id = $device->id;
        $key->save();

        foreach ($languages as $language) {
            $key->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? trim("Blog") : ""
            ]);
        }

        $key = new App\KeyTranslation();
        $key->key = trim("layouts.navbar.guide	");
        $key->device_type_id = $device->id;
        $key->save();

        foreach ($languages as $language) {
            $key->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? trim("Guía de la ciudad") : ""
            ]);
        }

        $key = new App\KeyTranslation();
        $key->key = trim("layouts.navbar.register	");
        $key->device_type_id = $device->id;
        $key->save();

        foreach ($languages as $language) {
            $key->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? trim("Registrarme") : ""
            ]);
        }

        $key = new App\KeyTranslation();
        $key->key = trim("layouts.navbar.ingresar	");
        $key->device_type_id = $device->id;
        $key->save();

        foreach ($languages as $language) {
            $key->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? trim("Ingresar") : ""
            ]);
        }

        $key = new App\KeyTranslation();
        $key->key = trim("layouts.navbar.email	");
        $key->device_type_id = $device->id;
        $key->save();

        foreach ($languages as $language) {
            $key->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? trim("Correo electrónico") : ""
            ]);
        }

        $key = new App\KeyTranslation();
        $key->key = trim("layouts.navbar.password	");
        $key->device_type_id = $device->id;
        $key->save();

        foreach ($languages as $language) {
            $key->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? trim("Contraseña") : ""
            ]);
        }

        $key = new App\KeyTranslation();
        $key->key = trim("layouts.navbar.forgot	");
        $key->device_type_id = $device->id;
        $key->save();

        foreach ($languages as $language) {
            $key->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? trim("¿Olvidastes tu contraseña?") : ""
            ]);
        }

        $key = new App\KeyTranslation();
        $key->key = trim("layouts.wrapSearch.barce	");
        $key->device_type_id = $device->id;
        $key->save();

        foreach ($languages as $language) {
            $key->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? trim("Your serviced apartments in <b>Barcelona</b> ") : ""
            ]);
        }

        $key = new App\KeyTranslation();
        $key->key = trim("layouts.wrapSearch.servApto	");
        $key->device_type_id = $device->id;
        $key->save();

        foreach ($languages as $language) {
            $key->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? trim("Serviced Apartments") : ""
            ]);
        }

        $key = new App\KeyTranslation();
        $key->key = trim("layouts.wrapSearch.spa	");
        $key->device_type_id = $device->id;
        $key->save();

        foreach ($languages as $language) {
            $key->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? trim("SPA Sagrada Familia") : ""
            ]);
        }

        $key = new App\KeyTranslation();
        $key->key = trim("components.payment.toReturnTo	");
        $key->device_type_id = $device->id;
        $key->save();

        foreach ($languages as $language) {
            $key->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? trim("volver a") : ""
            ]);
        }

        $key = new App\KeyTranslation();
        $key->key = trim("components.payment.addServices	");
        $key->device_type_id = $device->id;
        $key->save();

        foreach ($languages as $language) {
            $key->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? trim("añadir servicios") : ""
            ]);
        }

        $key = new App\KeyTranslation();
        $key->key = trim("components.payment.credito	");
        $key->device_type_id = $device->id;
        $key->save();

        foreach ($languages as $language) {
            $key->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? trim("Tarjeta de crédito") : ""
            ]);
        }

        $key = new App\KeyTranslation();
        $key->key = trim("components.payment.int	");
        $key->device_type_id = $device->id;
        $key->save();

        foreach ($languages as $language) {
            $key->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? trim("Introduce los datos de tu tarjeta de crédito para realizar el pago") : ""
            ]);
        }

        $key = new App\KeyTranslation();
        $key->key = trim("components.payment.fieldRequired	");
        $key->device_type_id = $device->id;
        $key->save();

        foreach ($languages as $language) {
            $key->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? trim("Este campo es requerido") : ""
            ]);
        }

        $key = new App\KeyTranslation();
        $key->key = trim("components.payment.14digits	");
        $key->device_type_id = $device->id;
        $key->save();

        foreach ($languages as $language) {
            $key->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? trim("Minimo 14 digitos") : ""
            ]);
        }

        $key = new App\KeyTranslation();
        $key->key = trim("components.payment.placeCardNumber	");
        $key->device_type_id = $device->id;
        $key->save();

        foreach ($languages as $language) {
            $key->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? trim("Número de tarjeta") : ""
            ]);
        }

        $key = new App\KeyTranslation();
        $key->key = trim("components.payment.placeCardName	");
        $key->device_type_id = $device->id;
        $key->save();

        foreach ($languages as $language) {
            $key->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? trim("Nombre completo") : ""
            ]);
        }

        $key = new App\KeyTranslation();
        $key->key = trim("components.payment.3digits	");
        $key->device_type_id = $device->id;
        $key->save();

        foreach ($languages as $language) {
            $key->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? trim("Minimo 3 digitos") : ""
            ]);
        }

        $key = new App\KeyTranslation();
        $key->key = trim("components.payment.placeCardExpiry	");
        $key->device_type_id = $device->id;
        $key->save();

        foreach ($languages as $language) {
            $key->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? trim("Mes/Año de expiracion") : ""
            ]);
        }

        $key = new App\KeyTranslation();
        $key->key = trim("components.payment.invalidFormat	");
        $key->device_type_id = $device->id;
        $key->save();

        foreach ($languages as $language) {
            $key->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? trim("Formato no válido") : ""
            ]);
        }

        $key = new App\KeyTranslation();
        $key->key = trim("components.payment.placeCardCode	");
        $key->device_type_id = $device->id;
        $key->save();

        foreach ($languages as $language) {
            $key->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? trim("Código CVC") : ""
            ]);
        }

        $key = new App\KeyTranslation();
        $key->key = trim("components.payment.placeAmount	");
        $key->device_type_id = $device->id;
        $key->save();

        foreach ($languages as $language) {
            $key->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? trim("Monto a pagar") : ""
            ]);
        }

        $key = new App\KeyTranslation();
        $key->key = trim("components.payment.ofertCastro	");
        $key->device_type_id = $device->id;
        $key->save();

        foreach ($languages as $language) {
            $key->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? trim("Deseo recibir las ofertas de Castro Exclusive Residences Sant Pau") : ""
            ]);
        }

        $key = new App\KeyTranslation();
        $key->key = trim("components.payment.termins	");
        $key->device_type_id = $device->id;
        $key->save();

        foreach ($languages as $language) {
            $key->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? trim("He leído y acepto las condiciones de reserva, cancelación y la<br>información sobre la privacidad") : ""
            ]);
        }

        $key = new App\KeyTranslation();
        $key->key = trim("components.payment.pay	");
        $key->device_type_id = $device->id;
        $key->save();

        foreach ($languages as $language) {
            $key->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? trim("pagar") : ""
            ]);
        }

        $key = new App\KeyTranslation();
        $key->key = trim("components.payment.extraServices	");
        $key->device_type_id = $device->id;
        $key->save();

        foreach ($languages as $language) {
            $key->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? trim("servicios extra") : ""
            ]);
        }

        $key = new App\KeyTranslation();
        $key->key = trim("components.searchd.bestPrice	");
        $key->device_type_id = $device->id;
        $key->save();

        foreach ($languages as $language) {
            $key->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? trim("¡Mejor precio garantizado y servicios extra gratis!") : ""
            ]);
        }

        $key = new App\KeyTranslation();
        $key->key = trim("components.searchd.titleSearch	");
        $key->device_type_id = $device->id;
        $key->save();

        foreach ($languages as $language) {
            $key->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? trim("Realiza aquí tu búsqueda") : ""
            ]);
        }

        $key = new App\KeyTranslation();
        $key->key = trim("components.searchd.hasCode	");
        $key->device_type_id = $device->id;
        $key->save();

        foreach ($languages as $language) {
            $key->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? trim("¡Tengo un código!") : ""
            ]);
        }

        $key = new App\KeyTranslation();
        $key->key = trim("components.searchd.checkAvailability	");
        $key->device_type_id = $device->id;
        $key->save();

        foreach ($languages as $language) {
            $key->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? trim("Comprobar disponibilidad") : ""
            ]);
        }

        $key = new App\KeyTranslation();
        $key->key = trim("components.searchd.nadults	");
        $key->device_type_id = $device->id;
        $key->save();

        foreach ($languages as $language) {
            $key->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? trim("{n} adultos") : ""
            ]);
        }

        $key = new App\KeyTranslation();
        $key->key = trim("components.searchd.nkids	");
        $key->device_type_id = $device->id;
        $key->save();

        foreach ($languages as $language) {
            $key->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? trim("{n} niños") : ""
            ]);
        }

        $key = new App\KeyTranslation();
        $key->key = trim("components.searchd.all	");
        $key->device_type_id = $device->id;
        $key->save();

        foreach ($languages as $language) {
            $key->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? trim("Todos") : ""
            ]);
        }

        $key = new App\KeyTranslation();
        $key->key = trim("components.searchd.nochesSelected	");
        $key->device_type_id = $device->id;
        $key->save();

        foreach ($languages as $language) {
            $key->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? trim("NOCHES SELECCIONADAS") : ""
            ]);
        }

        $key = new App\KeyTranslation();
        $key->key = trim("components.searchd.nApartments	");
        $key->device_type_id = $device->id;
        $key->save();

        foreach ($languages as $language) {
            $key->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? trim("N° apartamentos") : ""
            ]);
        }

        $key = new App\KeyTranslation();
        $key->key = trim("components.loginIndex.header.start	");
        $key->device_type_id = $device->id;
        $key->save();

        foreach ($languages as $language) {
            $key->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? trim("Inicio") : ""
            ]);
        }

        $key = new App\KeyTranslation();
        $key->key = trim("components.loginIndex.header.reservations	");
        $key->device_type_id = $device->id;
        $key->save();

        foreach ($languages as $language) {
            $key->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? trim("Reservaciones") : ""
            ]);
        }

        $key = new App\KeyTranslation();
        $key->key = trim("components.loginIndex.header.addServices	");
        $key->device_type_id = $device->id;
        $key->save();

        foreach ($languages as $language) {
            $key->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? trim("Añadir Servicios") : ""
            ]);
        }

        $key = new App\KeyTranslation();
        $key->key = trim("components.loginIndex.header.frequentQuestions	");
        $key->device_type_id = $device->id;
        $key->save();

        foreach ($languages as $language) {
            $key->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? trim("Preguntas Frecuentes") : ""
            ]);
        }

        $key = new App\KeyTranslation();
        $key->key = trim("components.loginIndex.header.userData	");
        $key->device_type_id = $device->id;
        $key->save();

        foreach ($languages as $language) {
            $key->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? trim("Datos de Usuario") : ""
            ]);
        }

        $key = new App\KeyTranslation();
        $key->key = trim("components.modals.isUser.exists	");
        $key->device_type_id = $device->id;
        $key->save();

        foreach ($languages as $language) {
            $key->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? trim("El Usuario ya existe") : ""
            ]);
        }

        $key = new App\KeyTranslation();
        $key->key = trim("components.modals.isUser.ok	");
        $key->device_type_id = $device->id;
        $key->save();

        foreach ($languages as $language) {
            $key->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? trim("OK") : ""
            ]);
        }

        $key = new App\KeyTranslation();
        $key->key = trim("components.modals.loading.pay	");
        $key->device_type_id = $device->id;
        $key->save();

        foreach ($languages as $language) {
            $key->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? trim("Procesando el pago") : ""
            ]);
        }

        $key = new App\KeyTranslation();
        $key->key = trim("components.sagradaFamilia.header.serApto	");
        $key->device_type_id = $device->id;
        $key->save();

        foreach ($languages as $language) {
            $key->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? trim("Serviced Apartments") : ""
            ]);
        }

        $key = new App\KeyTranslation();
        $key->key = trim("components.sagradaFamilia.header.welcome	");
        $key->device_type_id = $device->id;
        $key->save();

        foreach ($languages as $language) {
            $key->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? trim("Bienvenida") : ""
            ]);
        }

        $key = new App\KeyTranslation();
        $key->key = trim("components.sagradaFamilia.header.exServices	");
        $key->device_type_id = $device->id;
        $key->save();

        foreach ($languages as $language) {
            $key->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? trim("Servicios Exclusivos") : ""
            ]);
        }

        $key = new App\KeyTranslation();
        $key->key = trim("components.sagradaFamilia.header.experience	");
        $key->device_type_id = $device->id;
        $key->save();

        foreach ($languages as $language) {
            $key->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? trim("Experiencia") : ""
            ]);
        }

        $key = new App\KeyTranslation();
        $key->key = trim("components.sagradaFamilia.header.spaGym	");
        $key->device_type_id = $device->id;
        $key->save();

        foreach ($languages as $language) {
            $key->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? trim("Metropolitan SPA & Gym") : ""
            ]);
        }

        $key = new App\KeyTranslation();
        $key->key = trim("components.sagradaFamilia.header.more	");
        $key->device_type_id = $device->id;
        $key->save();

        foreach ($languages as $language) {
            $key->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? trim("Fotos y más") : ""
            ]);
        }

        $key = new App\KeyTranslation();
        $key->key = trim("pages.home.toda	");
        $key->device_type_id = $device->id;
        $key->save();

        foreach ($languages as $language) {
            $key->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? trim("Toda la familia bajo el mismo techo o un grupo de amigos compartiendo apartamento hace que, además de tener un viaje más interesante se pueda destinar mayor parte del presupuesto a conocer Barcelona</p><p>Una ciudad con una oferta gastronómica única, eso sí, al tener cocina en “casa” puedes hacer ese plato que se te resiste y ahorrar algún euro") : ""
            ]);
        }

        $key = new App\KeyTranslation();
        $key->key = trim("pages.home.whats	");
        $key->device_type_id = $device->id;
        $key->save();

        foreach ($languages as $language) {
            $key->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? trim("¿Por qué un apartamento es mejor que un hotel?") : ""
            ]);
        }

        $key = new App\KeyTranslation();
        $key->key = trim("pages.home.vivir	");
        $key->device_type_id = $device->id;
        $key->save();

        foreach ($languages as $language) {
            $key->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? trim("¿Que experiencia quieres vivir?") : ""
            ]);
        }

        $key = new App\KeyTranslation();
        $key->key = trim("pages.home.conoces	");
        $key->device_type_id = $device->id;
        $key->save();

        foreach ($languages as $language) {
            $key->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? trim("Conoce los apartamentos") : ""
            ]);
        }

        $key = new App\KeyTranslation();
        $key->key = trim("pages.home.servpto	");
        $key->device_type_id = $device->id;
        $key->save();

        foreach ($languages as $language) {
            $key->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? trim("Serviced Apartments") : ""
            ]);
        }

        $key = new App\KeyTranslation();
        $key->key = trim("pages.home.mas	");
        $key->device_type_id = $device->id;
        $key->save();

        foreach ($languages as $language) {
            $key->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? trim("Ver más") : ""
            ]);
        }

        $key = new App\KeyTranslation();
        $key->key = trim("pages.home.guessOp	");
        $key->device_type_id = $device->id;
        $key->save();

        foreach ($languages as $language) {
            $key->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? trim("¿Que opinan nuestros huéspedes?") : ""
            ]);
        }

        $key = new App\KeyTranslation();
        $key->key = trim("pages.home.SasOp	");
        $key->device_type_id = $device->id;
        $key->save();

        foreach ($languages as $language) {
            $key->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? trim("Basado en opiniones de") : ""
            ]);
        }

        $key = new App\KeyTranslation();
        $key->key = trim("pages.home.vol	");
        $key->device_type_id = $device->id;
        $key->save();

        foreach ($languages as $language) {
            $key->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? trim("VOLVERÍAN") : ""
            ]);
        }

        $key = new App\KeyTranslation();
        $key->key = trim("pages.home.lee	");
        $key->device_type_id = $device->id;
        $key->save();

        foreach ($languages as $language) {
            $key->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? trim("Leer otras") : ""
            ]);
        }

        $key = new App\KeyTranslation();
        $key->key = trim("pages.home.opine	");
        $key->device_type_id = $device->id;
        $key->save();

        foreach ($languages as $language) {
            $key->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? trim("opiniones verificadas") : ""
            ]);
        }

        $key = new App\KeyTranslation();
        $key->key = trim("pages.home.ubica	");
        $key->device_type_id = $device->id;
        $key->save();

        foreach ($languages as $language) {
            $key->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? trim("Ubicación") : ""
            ]);
        }

        $key = new App\KeyTranslation();
        $key->key = trim("pages.home.wifi	");
        $key->device_type_id = $device->id;
        $key->save();

        foreach ($languages as $language) {
            $key->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? trim("Wifi") : ""
            ]);
        }

        $key = new App\KeyTranslation();
        $key->key = trim("pages.home.calid	");
        $key->device_type_id = $device->id;
        $key->save();

        foreach ($languages as $language) {
            $key->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? trim("Calidad de sueño") : ""
            ]);
        }

        $key = new App\KeyTranslation();
        $key->key = trim("pages.home.person	");
        $key->device_type_id = $device->id;
        $key->save();

        foreach ($languages as $language) {
            $key->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? trim("Personal") : ""
            ]);
        }

        $key = new App\KeyTranslation();
        $key->key = trim("pages.home.clean	");
        $key->device_type_id = $device->id;
        $key->save();

        foreach ($languages as $language) {
            $key->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? trim("Limpieza") : ""
            ]);
        }

        $key = new App\KeyTranslation();
        $key->key = trim("pages.home.precio	");
        $key->device_type_id = $device->id;
        $key->save();

        foreach ($languages as $language) {
            $key->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? trim("Calidad/Precio") : ""
            ]);
        }

        $key = new App\KeyTranslation();
        $key->key = trim("pages.home.look	");
        $key->device_type_id = $device->id;
        $key->save();

        foreach ($languages as $language) {
            $key->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? trim("Mira dónde estamos") : ""
            ]);
        }

        $key = new App\KeyTranslation();
        $key->key = trim("pages.register.name	");
        $key->device_type_id = $device->id;
        $key->save();

        foreach ($languages as $language) {
            $key->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? trim("Nombre") : ""
            ]);
        }

        $key = new App\KeyTranslation();
        $key->key = trim("pages.register.last	");
        $key->device_type_id = $device->id;
        $key->save();

        foreach ($languages as $language) {
            $key->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? trim("Apellido") : ""
            ]);
        }

        $key = new App\KeyTranslation();
        $key->key = trim("pages.register.email	");
        $key->device_type_id = $device->id;
        $key->save();

        foreach ($languages as $language) {
            $key->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? trim("Correo electrónico") : ""
            ]);
        }

        $key = new App\KeyTranslation();
        $key->key = trim("pages.register.phone	");
        $key->device_type_id = $device->id;
        $key->save();

        foreach ($languages as $language) {
            $key->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? trim("Teléfono") : ""
            ]);
        }

        $key = new App\KeyTranslation();
        $key->key = trim("pages.register.password	");
        $key->device_type_id = $device->id;
        $key->save();

        foreach ($languages as $language) {
            $key->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? trim("Contraseña") : ""
            ]);
        }

        $key = new App\KeyTranslation();
        $key->key = trim("pages.register.repassword	");
        $key->device_type_id = $device->id;
        $key->save();

        foreach ($languages as $language) {
            $key->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? trim("Confirmar contraseña") : ""
            ]);
        }

        $key = new App\KeyTranslation();
        $key->key = trim("pages.register.sendregister	");
        $key->device_type_id = $device->id;
        $key->save();

        foreach ($languages as $language) {
            $key->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? trim("¡Registrame!") : ""
            ]);
        }

        $key = new App\KeyTranslation();
        $key->key = trim("pages.register.facebook	");
        $key->device_type_id = $device->id;
        $key->save();

        foreach ($languages as $language) {
            $key->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? trim("Ingresar con facebook") : ""
            ]);
        }

        $key = new App\KeyTranslation();
        $key->key = trim("pages.register.google	");
        $key->device_type_id = $device->id;
        $key->save();

        foreach ($languages as $language) {
            $key->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? trim("Ingresar con Google") : ""
            ]);
        }

        $key = new App\KeyTranslation();
        $key->key = trim("pages.searchResult.results	");
        $key->device_type_id = $device->id;
        $key->save();

        foreach ($languages as $language) {
            $key->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? trim("Disponible {n} resultado para tu búsqueda") : ""
            ]);
        }

        $key = new App\KeyTranslation();
        $key->key = trim("pages.searchResult.modify	");
        $key->device_type_id = $device->id;
        $key->save();

        foreach ($languages as $language) {
            $key->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? trim("Modificar") : ""
            ]);
        }

        $key = new App\KeyTranslation();
        $key->key = trim("pages.searchResult.apartir	");
        $key->device_type_id = $device->id;
        $key->save();

        foreach ($languages as $language) {
            $key->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? trim("A partir de") : ""
            ]);
        }

        $key = new App\KeyTranslation();
        $key->key = trim("pages.searchResult.pord	");
        $key->device_type_id = $device->id;
        $key->save();

        foreach ($languages as $language) {
            $key->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? trim("por<span> 1 </span>noche") : ""
            ]);
        }

        $key = new App\KeyTranslation();
        $key->key = trim("pages.searchResult.aptohab	");
        $key->device_type_id = $device->id;
        $key->save();

        foreach ($languages as $language) {
            $key->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? trim("APARTAMENTO HABITACIÓN") : ""
            ]);
        }

        $key = new App\KeyTranslation();
        $key->key = trim("pages.searchResult.rooms	");
        $key->device_type_id = $device->id;
        $key->save();

        foreach ($languages as $language) {
            $key->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? trim("Dormitorios") : ""
            ]);
        }

        $key = new App\KeyTranslation();
        $key->key = trim("pages.searchResult.bathrooms	");
        $key->device_type_id = $device->id;
        $key->save();

        foreach ($languages as $language) {
            $key->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? trim("Baños") : ""
            ]);
        }

        $key = new App\KeyTranslation();
        $key->key = trim("pages.searchResult.guests	");
        $key->device_type_id = $device->id;
        $key->save();

        foreach ($languages as $language) {
            $key->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? trim("Huéspedes") : ""
            ]);
        }

        $key = new App\KeyTranslation();
        $key->key = trim("pages.searchResult.detail	");
        $key->device_type_id = $device->id;
        $key->save();

        foreach ($languages as $language) {
            $key->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? trim("Detalles y reserva") : ""
            ]);
        }

        $key = new App\KeyTranslation();
        $key->key = trim("pages.searchResult.regimen	");
        $key->device_type_id = $device->id;
        $key->save();

        foreach ($languages as $language) {
            $key->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? trim("RÉGIMEN Y POLÍTICA DE CANCELACIÓN") : ""
            ]);
        }

        $key = new App\KeyTranslation();
        $key->key = trim("pages.searchResult.experiencie	");
        $key->device_type_id = $device->id;
        $key->save();

        foreach ($languages as $language) {
            $key->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? trim("EXPERIENCIA") : ""
            ]);
        }

        $key = new App\KeyTranslation();
        $key->key = trim("pages.searchResult.add	");
        $key->device_type_id = $device->id;
        $key->save();

        foreach ($languages as $language) {
            $key->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? trim("A partir de") : ""
            ]);
        }

        $key = new App\KeyTranslation();
        $key->key = trim("pages.searchResult.por	");
        $key->device_type_id = $device->id;
        $key->save();

        foreach ($languages as $language) {
            $key->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? trim("por") : ""
            ]);
        }

        $key = new App\KeyTranslation();
        $key->key = trim("pages.searchResult.night	");
        $key->device_type_id = $device->id;
        $key->save();

        foreach ($languages as $language) {
            $key->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? trim("noche") : ""
            ]);
        }

        $key = new App\KeyTranslation();
        $key->key = trim("pages.searchResult.select	");
        $key->device_type_id = $device->id;
        $key->save();

        foreach ($languages as $language) {
            $key->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? trim("Seleccionar") : ""
            ]);
        }

        $key = new App\KeyTranslation();
        $key->key = trim("pages.searchResult.cantd	");
        $key->device_type_id = $device->id;
        $key->save();

        foreach ($languages as $language) {
            $key->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? trim("CANTIDAD DE APARTAMENTOS") : ""
            ]);
        }

        $key = new App\KeyTranslation();
        $key->key = trim("pages.searchResult.politicac	");
        $key->device_type_id = $device->id;
        $key->save();

        foreach ($languages as $language) {
            $key->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? trim("Política de cancelación") : ""
            ]);
        }

        $key = new App\KeyTranslation();
        $key->key = trim("pages.searchResult.reserve	");
        $key->device_type_id = $device->id;
        $key->save();

        foreach ($languages as $language) {
            $key->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? trim("Reserva") : ""
            ]);
        }

        $key = new App\KeyTranslation();
        $key->key = trim("pages.payment.destc	");
        $key->device_type_id = $device->id;
        $key->save();

        foreach ($languages as $language) {
            $key->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? trim("Servicios destacados") : ""
            ]);
        }

        $key = new App\KeyTranslation();
        $key->key = trim("pages.payment.contra	");
        $key->device_type_id = $device->id;
        $key->save();

        foreach ($languages as $language) {
            $key->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? trim("¡Contrata el servicio o los productos que desees cuando tu quieras!<br>Puedes hacerlo <span>antes o durante</span> tu estadía") : ""
            ]);
        }

        $key = new App\KeyTranslation();
        $key->key = trim("pages.payment.contra_mobile	");
        $key->device_type_id = $device->id;
        $key->save();

        foreach ($languages as $language) {
            $key->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? trim("¡Contrata el servicio o los productos que desees cuando tu quieras! Puedes hacerlo <span>antes o durante</span> tu estadía") : ""
            ]);
        }

        $key = new App\KeyTranslation();
        $key->key = trim("pages.payment.llave	");
        $key->device_type_id = $device->id;
        $key->save();

        foreach ($languages as $language) {
            $key->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? trim("por llave") : ""
            ]);
        }

        $key = new App\KeyTranslation();
        $key->key = trim("pages.payment.intro	");
        $key->device_type_id = $device->id;
        $key->save();

        foreach ($languages as $language) {
            $key->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? trim("Introduce tus datos") : ""
            ]);
        }

        $key = new App\KeyTranslation();
        $key->key = trim("pages.payment.register	");
        $key->device_type_id = $device->id;
        $key->save();

        foreach ($languages as $language) {
            $key->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? trim("Regístrese con su cuenta social para hacer la reserva rápidamente") : ""
            ]);
        }

        $key = new App\KeyTranslation();
        $key->key = trim("pages.payment.facebook	");
        $key->device_type_id = $device->id;
        $key->save();

        foreach ($languages as $language) {
            $key->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? trim("Ingresar con facebook") : ""
            ]);
        }

        $key = new App\KeyTranslation();
        $key->key = trim("pages.payment.google	");
        $key->device_type_id = $device->id;
        $key->save();

        foreach ($languages as $language) {
            $key->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? trim("Ingresar con Google") : ""
            ]);
        }

        $key = new App\KeyTranslation();
        $key->key = trim("pages.payment.dateif	");
        $key->device_type_id = $device->id;
        $key->save();

        foreach ($languages as $language) {
            $key->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? trim("INTRODUCE TUS DATOS") : ""
            ]);
        }

        $key = new App\KeyTranslation();
        $key->key = trim("pages.payment.name	");
        $key->device_type_id = $device->id;
        $key->save();

        foreach ($languages as $language) {
            $key->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? trim("Nombre") : ""
            ]);
        }

        $key = new App\KeyTranslation();
        $key->key = trim("pages.payment.last	");
        $key->device_type_id = $device->id;
        $key->save();

        foreach ($languages as $language) {
            $key->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? trim("Apellido") : ""
            ]);
        }

        $key = new App\KeyTranslation();
        $key->key = trim("pages.payment.email	");
        $key->device_type_id = $device->id;
        $key->save();

        foreach ($languages as $language) {
            $key->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? trim("Email") : ""
            ]);
        }

        $key = new App\KeyTranslation();
        $key->key = trim("pages.payment.phone	");
        $key->device_type_id = $device->id;
        $key->save();

        foreach ($languages as $language) {
            $key->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? trim("Teléfono") : ""
            ]);
        }

        $key = new App\KeyTranslation();
        $key->key = trim("pages.payment.user	");
        $key->device_type_id = $device->id;
        $key->save();

        foreach ($languages as $language) {
            $key->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? trim("Para poder concretarse si fuese necesario, usaremos los datos de la reserva") : ""
            ]);
        }

        $key = new App\KeyTranslation();
        $key->key = trim("pages.payment.required	");
        $key->device_type_id = $device->id;
        $key->save();

        foreach ($languages as $language) {
            $key->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? trim("Este campo es requerido") : ""
            ]);
        }

        $key = new App\KeyTranslation();
        $key->key = trim("pages.payment.min	");
        $key->device_type_id = $device->id;
        $key->save();

        foreach ($languages as $language) {
            $key->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? trim("Minimo 3 caracteres") : ""
            ]);
        }

        $key = new App\KeyTranslation();
        $key->key = trim("pages.payment.min14	");
        $key->device_type_id = $device->id;
        $key->save();

        foreach ($languages as $language) {
            $key->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? trim("Minimo 14 caracteres") : ""
            ]);
        }

        $key = new App\KeyTranslation();
        $key->key = trim("pages.payment.invalid	");
        $key->device_type_id = $device->id;
        $key->save();

        foreach ($languages as $language) {
            $key->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? trim("Formato no válido") : ""
            ]);
        }

        $key = new App\KeyTranslation();
        $key->key = trim("pages.payment.tarifa	");
        $key->device_type_id = $device->id;
        $key->save();

        foreach ($languages as $language) {
            $key->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? trim("Estás reservando a la mejor tarifa disponible y con las mejores condiciones") : ""
            ]);
        }

        $key = new App\KeyTranslation();
        $key->key = trim("pages.payment.ventaja	");
        $key->device_type_id = $device->id;
        $key->save();

        foreach ($languages as $language) {
            $key->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? trim("Ventajas de la reserva directa") : ""
            ]);
        }

        $key = new App\KeyTranslation();
        $key->key = trim("pages.payment.carg	");
        $key->device_type_id = $device->id;
        $key->save();

        foreach ($languages as $language) {
            $key->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? trim("sin cargos por reserva") : ""
            ]);
        }

        $key = new App\KeyTranslation();
        $key->key = trim("pages.payment.ofertEx	");
        $key->device_type_id = $device->id;
        $key->save();

        foreach ($languages as $language) {
            $key->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? trim("Ofertas y beneficios exclusivos") : ""
            ]);
        }

        $key = new App\KeyTranslation();
        $key->key = trim("pages.payment.garantiza	");
        $key->device_type_id = $device->id;
        $key->save();

        foreach ($languages as $language) {
            $key->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? trim("Mejor precio garantizado") : ""
            ]);
        }

        $key = new App\KeyTranslation();
        $key->key = trim("pages.payment.Exc	");
        $key->device_type_id = $device->id;
        $key->save();

        foreach ($languages as $language) {
            $key->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? trim("Ofertas y beneficios exclusivos") : ""
            ]);
        }

        $key = new App\KeyTranslation();
        $key->key = trim("pages.payment.credito	");
        $key->device_type_id = $device->id;
        $key->save();

        foreach ($languages as $language) {
            $key->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? trim("Tarjeta de crédito") : ""
            ]);
        }

        $key = new App\KeyTranslation();
        $key->key = trim("pages.payment.int	");
        $key->device_type_id = $device->id;
        $key->save();

        foreach ($languages as $language) {
            $key->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? trim("Introduce los datos de tu tarjeta de crédito para realizar el pago") : ""
            ]);
        }

        $key = new App\KeyTranslation();
        $key->key = trim("pages.payment.placeCardNumber	");
        $key->device_type_id = $device->id;
        $key->save();

        foreach ($languages as $language) {
            $key->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? trim("Número de tarjeta") : ""
            ]);
        }

        $key = new App\KeyTranslation();
        $key->key = trim("pages.payment.placeCardName	");
        $key->device_type_id = $device->id;
        $key->save();

        foreach ($languages as $language) {
            $key->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? trim("Nombre completo") : ""
            ]);
        }

        $key = new App\KeyTranslation();
        $key->key = trim("pages.payment.placeCardExpiry	");
        $key->device_type_id = $device->id;
        $key->save();

        foreach ($languages as $language) {
            $key->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? trim("Mes/Año de expiracion") : ""
            ]);
        }

        $key = new App\KeyTranslation();
        $key->key = trim("pages.payment.placeCardCode	");
        $key->device_type_id = $device->id;
        $key->save();

        foreach ($languages as $language) {
            $key->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? trim("Código CVC") : ""
            ]);
        }

        $key = new App\KeyTranslation();
        $key->key = trim("pages.payment.placeAmount	");
        $key->device_type_id = $device->id;
        $key->save();

        foreach ($languages as $language) {
            $key->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? trim("Monto a pagar") : ""
            ]);
        }

        $key = new App\KeyTranslation();
        $key->key = trim("pages.payment.solicitud	");
        $key->device_type_id = $device->id;
        $key->save();

        foreach ($languages as $language) {
            $key->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? trim("Solicitudes especiales") : ""
            ]);
        }

        $key = new App\KeyTranslation();
        $key->key = trim("pages.payment.send	");
        $key->device_type_id = $device->id;
        $key->save();

        foreach ($languages as $language) {
            $key->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? trim("Enviar") : ""
            ]);
        }

        $key = new App\KeyTranslation();
        $key->key = trim("pages.payment.ofertCastro	");
        $key->device_type_id = $device->id;
        $key->save();

        foreach ($languages as $language) {
            $key->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? trim("Deseo recibir las ofertas de Castro Exclusive Residences Sant Pau") : ""
            ]);
        }

        $key = new App\KeyTranslation();
        $key->key = trim("pages.payment.termins	");
        $key->device_type_id = $device->id;
        $key->save();

        foreach ($languages as $language) {
            $key->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? trim("He leído y acepto las condiciones de reserva, cancelación y la<br>información sobre la privacidad") : ""
            ]);
        }

        $key = new App\KeyTranslation();
        $key->key = trim("pages.payment.termins_mobile	");
        $key->device_type_id = $device->id;
        $key->save();

        foreach ($languages as $language) {
            $key->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? trim("He leído y acepto las condiciones de <strong>reserva, cancelación</strong> y la <strong>información sobre la privacidad</strong>") : ""
            ]);
        }

        $key = new App\KeyTranslation();
        $key->key = trim("pages.payment.terminsError	");
        $key->device_type_id = $device->id;
        $key->save();

        foreach ($languages as $language) {
            $key->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? trim("Debe aceptar los terminos y condiciones de la reserva") : ""
            ]);
        }

        $key = new App\KeyTranslation();
        $key->key = trim("pages.payment.sendComision	");
        $key->device_type_id = $device->id;
        $key->save();

        foreach ($languages as $language) {
            $key->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? trim("Reservar<span> de forma segura y sin comisiones</span>") : ""
            ]);
        }

        $key = new App\KeyTranslation();
        $key->key = trim("pages.payment.tu	");
        $key->device_type_id = $device->id;
        $key->save();

        foreach ($languages as $language) {
            $key->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? trim("Tu reserva") : ""
            ]);
        }

        $key = new App\KeyTranslation();
        $key->key = trim("pages.payment.checkin	");
        $key->device_type_id = $device->id;
        $key->save();

        foreach ($languages as $language) {
            $key->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? trim("Check - in") : ""
            ]);
        }

        $key = new App\KeyTranslation();
        $key->key = trim("pages.payment.checkout	");
        $key->device_type_id = $device->id;
        $key->save();

        foreach ($languages as $language) {
            $key->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? trim("Check - out") : ""
            ]);
        }

        $key = new App\KeyTranslation();
        $key->key = trim("pages.payment.concept	");
        $key->device_type_id = $device->id;
        $key->save();

        foreach ($languages as $language) {
            $key->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? trim("CONCEPTO") : ""
            ]);
        }

        $key = new App\KeyTranslation();
        $key->key = trim("pages.payment.import	");
        $key->device_type_id = $device->id;
        $key->save();

        foreach ($languages as $language) {
            $key->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? trim("IMPORTE") : ""
            ]);
        }

        $key = new App\KeyTranslation();
        $key->key = trim("pages.payment.tax	");
        $key->device_type_id = $device->id;
        $key->save();

        foreach ($languages as $language) {
            $key->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? trim("City tax") : ""
            ]);
        }

        $key = new App\KeyTranslation();
        $key->key = trim("pages.payment.tasa	");
        $key->device_type_id = $device->id;
        $key->save();

        foreach ($languages as $language) {
            $key->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? trim("Tasa turística de la <br>ciudad de Barcelona") : ""
            ]);
        }

        $key = new App\KeyTranslation();
        $key->key = trim("pages.payment.upgradeApt	");
        $key->device_type_id = $device->id;
        $key->save();

        foreach ($languages as $language) {
            $key->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? trim("Mejora tipo de apartamento") : ""
            ]);
        }

        $key = new App\KeyTranslation();
        $key->key = trim("pages.payment.upgradeAptText	");
        $key->device_type_id = $device->id;
        $key->save();

        foreach ($languages as $language) {
            $key->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? trim("3 DORMITORIOS, 2 BAÑOS") : ""
            ]);
        }

        $key = new App\KeyTranslation();
        $key->key = trim("pages.payment.upgradePlan	");
        $key->device_type_id = $device->id;
        $key->save();

        foreach ($languages as $language) {
            $key->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? trim("Mejora Plan de apartamento") : ""
            ]);
        }

        $key = new App\KeyTranslation();
        $key->key = trim("pages.payment.upgradePlanText	");
        $key->device_type_id = $device->id;
        $key->save();

        foreach ($languages as $language) {
            $key->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? trim("DESAYUNO INCLUIDO") : ""
            ]);
        }

        $key = new App\KeyTranslation();
        $key->key = trim("pages.payment.upgradeExperience	");
        $key->device_type_id = $device->id;
        $key->save();

        foreach ($languages as $language) {
            $key->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? trim("Mejora Experiencia") : ""
            ]);
        }

        $key = new App\KeyTranslation();
        $key->key = trim("pages.payment.upgradeExperienceText	");
        $key->device_type_id = $device->id;
        $key->save();

        foreach ($languages as $language) {
            $key->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? trim("EXCLUSIVE") : ""
            ]);
        }

        $key = new App\KeyTranslation();
        $key->key = trim("pages.payment.servics	");
        $key->device_type_id = $device->id;
        $key->save();

        foreach ($languages as $language) {
            $key->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? trim("Servicios") : ""
            ]);
        }

        $key = new App\KeyTranslation();
        $key->key = trim("pages.payment.free	");
        $key->device_type_id = $device->id;
        $key->save();

        foreach ($languages as $language) {
            $key->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? trim("GRATIS") : ""
            ]);
        }

        $key = new App\KeyTranslation();
        $key->key = trim("pages.payment.total	");
        $key->device_type_id = $device->id;
        $key->save();

        foreach ($languages as $language) {
            $key->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? trim("Total") : ""
            ]);
        }

        $key = new App\KeyTranslation();
        $key->key = trim("pages.payment.othor	");
        $key->device_type_id = $device->id;
        $key->save();

        foreach ($languages as $language) {
            $key->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? trim("Añadir otro apartamento") : ""
            ]);
        }

        $key = new App\KeyTranslation();
        $key->key = trim("pages.payment.prot	");
        $key->device_type_id = $device->id;
        $key->save();

        foreach ($languages as $language) {
            $key->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? trim("Toda la información está protegida medtante el") : ""
            ]);
        }

        $key = new App\KeyTranslation();
        $key->key = trim("pages.payment.cifra	");
        $key->device_type_id = $device->id;
        $key->save();

        foreach ($languages as $language) {
            $key->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? trim("cifrado de datos con tecnología SSL a 2048 bit") : ""
            ]);
        }

        $key = new App\KeyTranslation();
        $key->key = trim("message.spg.experiencias.question  	");
        $key->device_type_id = $device->id;
        $key->save();

        foreach ($languages as $language) {
            $key->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? trim("¿Porqué te proponemos {n} <span>experiencias?</span>             ") : ""
            ]);
        }

        $key = new App\KeyTranslation();
        $key->key = trim("message.spg.experiencias.answer    	");
        $key->device_type_id = $device->id;
        $key->save();

        foreach ($languages as $language) {
            $key->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? trim("La experiencia castro Exclusive Residences consiste en llenar los 80 metros cuadrados de tu apartamento de vivencias y recuerdos donde tú eliges qué herramientas usar para ello             ") : ""
            ]);
        }

        $key = new App\KeyTranslation();
        $key->key = trim("message.spg.servicedApartments     	");
        $key->device_type_id = $device->id;
        $key->save();

        foreach ($languages as $language) {
            $key->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? trim("Serviced Apartments         ") : ""
            ]);
        }

        $key = new App\KeyTranslation();
        $key->key = trim("message.spg.label.apartament       	");
        $key->device_type_id = $device->id;
        $key->save();

        foreach ($languages as $language) {
            $key->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? trim("Apartamento         ") : ""
            ]);
        }

        $key = new App\KeyTranslation();
        $key->key = trim("message.spg.label.general          	");
        $key->device_type_id = $device->id;
        $key->save();

        foreach ($languages as $language) {
            $key->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? trim("General     ") : ""
            ]);
        }

        $key = new App\KeyTranslation();
        $key->key = trim("message.spg.label.roomDouble       	");
        $key->device_type_id = $device->id;
        $key->save();

        foreach ($languages as $language) {
            $key->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? trim("Habitación doble         ") : ""
            ]);
        }

        $key = new App\KeyTranslation();
        $key->key = trim("message.spg.label.room             	");
        $key->device_type_id = $device->id;
        $key->save();

        foreach ($languages as $language) {
            $key->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? trim("Habitación ") : ""
            ]);
        }

        $key = new App\KeyTranslation();
        $key->key = trim("message.spg.label.bathroom         	");
        $key->device_type_id = $device->id;
        $key->save();

        foreach ($languages as $language) {
            $key->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? trim("Baño     ") : ""
            ]);
        }

        $key = new App\KeyTranslation();
        $key->key = trim("message.spg.label.bathrooms        	");
        $key->device_type_id = $device->id;
        $key->save();

        foreach ($languages as $language) {
            $key->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? trim("Baños         ") : ""
            ]);
        }

        $key = new App\KeyTranslation();
        $key->key = trim("message.spg.label.people           	");
        $key->device_type_id = $device->id;
        $key->save();

        foreach ($languages as $language) {
            $key->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? trim("Personas     ") : ""
            ]);
        }

        $key = new App\KeyTranslation();
        $key->key = trim("message.spg.label.kitchen          	");
        $key->device_type_id = $device->id;
        $key->save();

        foreach ($languages as $language) {
            $key->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? trim("Cocina     ") : ""
            ]);
        }

        $key = new App\KeyTranslation();
        $key->key = trim("message.spg.label.livingroom       	");
        $key->device_type_id = $device->id;
        $key->save();

        foreach ($languages as $language) {
            $key->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? trim("Salón         ") : ""
            ]);
        }

        $key = new App\KeyTranslation();
        $key->key = trim("message.spg.label.drawingRoom      	");
        $key->device_type_id = $device->id;
        $key->save();

        foreach ($languages as $language) {
            $key->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? trim("Sala de estar         ") : ""
            ]);
        }

        $key = new App\KeyTranslation();
        $key->key = trim("message.spg.label.terrace          	");
        $key->device_type_id = $device->id;
        $key->save();

        foreach ($languages as $language) {
            $key->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? trim("Terraza     ") : ""
            ]);
        }

        $key = new App\KeyTranslation();
        $key->key = trim("message.spg.label.balcony          	");
        $key->device_type_id = $device->id;
        $key->save();

        foreach ($languages as $language) {
            $key->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? trim("Fachada     ") : ""
            ]);
        }

        $key = new App\KeyTranslation();
        $key->key = trim("message.spg.label.suite            	");
        $key->device_type_id = $device->id;
        $key->save();

        foreach ($languages as $language) {
            $key->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? trim("Suite     ") : ""
            ]);
        }

        $key = new App\KeyTranslation();
        $key->key = trim("message.spg.label.featuredServices 	");
        $key->device_type_id = $device->id;
        $key->save();

        foreach ($languages as $language) {
            $key->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? trim("Servicios Destacados             ") : ""
            ]);
        }

        $key = new App\KeyTranslation();
        $key->key = trim("message.spg.label.msg1             	");
        $key->device_type_id = $device->id;
        $key->save();

        foreach ($languages as $language) {
            $key->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? trim("Un viaje al centro del ") : ""
            ]);
        }

        $key = new App\KeyTranslation();
        $key->key = trim("message.spg.label.msg2             	");
        $key->device_type_id = $device->id;
        $key->save();

        foreach ($languages as $language) {
            $key->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? trim("triángulo modernista ") : ""
            ]);
        }

        $key = new App\KeyTranslation();
        $key->key = trim("message.spg.label.bedroom          	");
        $key->device_type_id = $device->id;
        $key->save();

        foreach ($languages as $language) {
            $key->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? trim("Dormitorio     ") : ""
            ]);
        }

        $key = new App\KeyTranslation();
        $key->key = trim("message.spg.label.spa              	");
        $key->device_type_id = $device->id;
        $key->save();

        foreach ($languages as $language) {
            $key->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? trim("SPA ") : ""
            ]);
        }

        $key = new App\KeyTranslation();
        $key->key = trim("message.spg.label.gym              	");
        $key->device_type_id = $device->id;
        $key->save();

        foreach ($languages as $language) {
            $key->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? trim("Gimnasio ") : ""
            ]);
        }

        $key = new App\KeyTranslation();
        $key->key = trim("message.spg.label.wellness         	");
        $key->device_type_id = $device->id;
        $key->save();

        foreach ($languages as $language) {
            $key->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? trim("Wellness     ") : ""
            ]);
        }

        $key = new App\KeyTranslation();
        $key->key = trim("message.spg.label.extras.msg1      	");
        $key->device_type_id = $device->id;
        $key->save();

        foreach ($languages as $language) {
            $key->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? trim("Un viztazo a Barcelona         ") : ""
            ]);
        }

        $key = new App\KeyTranslation();
        $key->key = trim("message.spg.label.extras.msg2      	");
        $key->device_type_id = $device->id;
        $key->save();

        foreach ($languages as $language) {
            $key->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? trim("y Castro Exclusive desde el aire         ") : ""
            ]);
        }

        $key = new App\KeyTranslation();
        $key->key = trim("message.spg.label.notsopporthtml   	");
        $key->device_type_id = $device->id;
        $key->save();

        foreach ($languages as $language) {
            $key->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? trim("Su navegador no soporta video HTML5             ") : ""
            ]);
        }

        $key = new App\KeyTranslation();
        $key->key = trim("message.spg.castroservices 	");
        $key->device_type_id = $device->id;
        $key->save();

        foreach ($languages as $language) {
            $key->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? trim("CASTRO SERVICES             ") : ""
            ]);
        }

        $key = new App\KeyTranslation();
        $key->key = trim("message.spg.previous       	");
        $key->device_type_id = $device->id;
        $key->save();

        foreach ($languages as $language) {
            $key->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? trim("Previous         ") : ""
            ]);
        }

        $key = new App\KeyTranslation();
        $key->key = trim("message.spg.next           	");
        $key->device_type_id = $device->id;
        $key->save();

        foreach ($languages as $language) {
            $key->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? trim("Next     ") : ""
            ]);
        }

        $key = new App\KeyTranslation();
        $key->key = trim("message.spg.spa            	");
        $key->device_type_id = $device->id;
        $key->save();

        foreach ($languages as $language) {
            $key->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? trim("SPA     ") : ""
            ]);
        }

        $key = new App\KeyTranslation();
        $key->key = trim("message.spg.city           	");
        $key->device_type_id = $device->id;
        $key->save();

        foreach ($languages as $language) {
            $key->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? trim("DESCUBRE LA CIUDAD     ") : ""
            ]);
        }

        $key = new App\KeyTranslation();
        $key->key = trim("message.spg.contract       	");
        $key->device_type_id = $device->id;
        $key->save();

        foreach ($languages as $language) {
            $key->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? trim("¡Contrata el servicio o los productos que desees cuando tu quieras!          ") : ""
            ]);
        }

        $key = new App\KeyTranslation();
        $key->key = trim("message.spg.can            	");
        $key->device_type_id = $device->id;
        $key->save();

        foreach ($languages as $language) {
            $key->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? trim("Puedes hacerlo     ") : ""
            ]);
        }

        $key = new App\KeyTranslation();
        $key->key = trim("message.spg.before         	");
        $key->device_type_id = $device->id;
        $key->save();

        foreach ($languages as $language) {
            $key->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? trim("antes o durante     ") : ""
            ]);
        }

        $key = new App\KeyTranslation();
        $key->key = trim("message.spg.service        	");
        $key->device_type_id = $device->id;
        $key->save();

        foreach ($languages as $language) {
            $key->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? trim("¡Contrata el servicio o los productos que desees cuando tu quieras! Puedes hacerlo         ") : ""
            ]);
        }

        $key = new App\KeyTranslation();
        $key->key = trim("message.spg.stay           	");
        $key->device_type_id = $device->id;
        $key->save();

        foreach ($languages as $language) {
            $key->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? trim("tu estadía     ") : ""
            ]);
        }

        $key = new App\KeyTranslation();
        $key->key = trim("message.spg.travel         	");
        $key->device_type_id = $device->id;
        $key->save();

        foreach ($languages as $language) {
            $key->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? trim("Un viaje al centro del     ") : ""
            ]);
        }

        $key = new App\KeyTranslation();
        $key->key = trim("message.spg.triangle       	");
        $key->device_type_id = $device->id;
        $key->save();

        foreach ($languages as $language) {
            $key->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? trim("triángulo modernista         ") : ""
            ]);
        }

        $key = new App\KeyTranslation();
        $key->key = trim("message.spg.holidays       	");
        $key->device_type_id = $device->id;
        $key->save();

        foreach ($languages as $language) {
            $key->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? trim("8.000m de SPA, unas vacaciones         ") : ""
            ]);
        }

        $key = new App\KeyTranslation();
        $key->key = trim("message.spg.body           	");
        $key->device_type_id = $device->id;
        $key->save();

        foreach ($languages as $language) {
            $key->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? trim("EN CUERPO Y ALMA     ") : ""
            ]);
        }

        $key = new App\KeyTranslation();
        $key->key = trim("message.spg.discover       	");
        $key->device_type_id = $device->id;
        $key->save();

        foreach ($languages as $language) {
            $key->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? trim("Descubre más         ") : ""
            ]);
        }

        $key = new App\KeyTranslation();
        $key->key = trim("layout.loginIndex.userData.modifyYourData           	");
        $key->device_type_id = $device->id;
        $key->save();

        foreach ($languages as $language) {
            $key->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? trim("¿Quieres modificar tus datos?                ") : ""
            ]);
        }

        $key = new App\KeyTranslation();
        $key->key = trim("layout.loginIndex.userData.beginNow                 	");
        $key->device_type_id = $device->id;
        $key->save();

        foreach ($languages as $language) {
            $key->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? trim("¡Empieza ahora!        ") : ""
            ]);
        }

        $key = new App\KeyTranslation();
        $key->key = trim("layout.loginIndex.userData.registerDate             	");
        $key->device_type_id = $device->id;
        $key->save();

        foreach ($languages as $language) {
            $key->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? trim("Fecha de registro            ") : ""
            ]);
        }

        $key = new App\KeyTranslation();
        $key->key = trim("layout.loginIndex.userData.woman                    	");
        $key->device_type_id = $device->id;
        $key->save();

        foreach ($languages as $language) {
            $key->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? trim("Mujer        ") : ""
            ]);
        }

        $key = new App\KeyTranslation();
        $key->key = trim("layout.loginIndex.userData.men                      	");
        $key->device_type_id = $device->id;
        $key->save();

        foreach ($languages as $language) {
            $key->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? trim("Hombre    ") : ""
            ]);
        }

        $key = new App\KeyTranslation();
        $key->key = trim("layout.loginIndex.userData.save                     	");
        $key->device_type_id = $device->id;
        $key->save();

        foreach ($languages as $language) {
            $key->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? trim("Guardar    ") : ""
            ]);
        }

        $key = new App\KeyTranslation();
        $key->key = trim("layout.loginIndex.userData.name                     	");
        $key->device_type_id = $device->id;
        $key->save();

        foreach ($languages as $language) {
            $key->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? trim("Nombre    ") : ""
            ]);
        }

        $key = new App\KeyTranslation();
        $key->key = trim("layout.loginIndex.userData.lastName                 	");
        $key->device_type_id = $device->id;
        $key->save();

        foreach ($languages as $language) {
            $key->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? trim("Apellido        ") : ""
            ]);
        }

        $key = new App\KeyTranslation();
        $key->key = trim("layout.loginIndex.userData.email                    	");
        $key->device_type_id = $device->id;
        $key->save();

        foreach ($languages as $language) {
            $key->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? trim("email        ") : ""
            ]);
        }

        $key = new App\KeyTranslation();
        $key->key = trim("layout.loginIndex.userData.phone                    	");
        $key->device_type_id = $device->id;
        $key->save();

        foreach ($languages as $language) {
            $key->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? trim("Teléfono        ") : ""
            ]);
        }

        $key = new App\KeyTranslation();
        $key->key = trim("layout.loginIndex.userData.address                  	");
        $key->device_type_id = $device->id;
        $key->save();

        foreach ($languages as $language) {
            $key->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? trim("Dirección        ") : ""
            ]);
        }

        $key = new App\KeyTranslation();
        $key->key = trim("layout.loginIndex.userData.postalCode               	");
        $key->device_type_id = $device->id;
        $key->save();

        foreach ($languages as $language) {
            $key->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? trim("Código postal            ") : ""
            ]);
        }

        $key = new App\KeyTranslation();
        $key->key = trim("layout.loginIndex.userData.birthday                 	");
        $key->device_type_id = $device->id;
        $key->save();

        foreach ($languages as $language) {
            $key->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? trim("Fecha de nacimiento        ") : ""
            ]);
        }

        $key = new App\KeyTranslation();
        $key->key = trim("layout.loginIndex.faq.firstCollapse                 	");
        $key->device_type_id = $device->id;
        $key->save();

        foreach ($languages as $language) {
            $key->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? trim("Lorem ipsum dolor sit amet consectetur adipiscing elit lectus pharetra quisque sociis mollis        ") : ""
            ]);
        }

        $key = new App\KeyTranslation();
        $key->key = trim("layout.loginIndex.faq.firstCollapseDescription      	");
        $key->device_type_id = $device->id;
        $key->save();

        foreach ($languages as $language) {
            $key->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? trim("Lorem ipsum dolor sit amet consectetur adipiscing elit lectus pharetra quisque sociis mollis, eleifend porttitor habitant consequat hac blandit vivamus mi mattis molestie. Interdum penatibus volutpat velit montes sollicitudin et at vel suscipit, posuere sapien felis nullam morbi libero fames sed ultricies cum, luctus tristique imperdiet tempus augue tempor ligula potenti. Nunc rhoncus iaculis nec sociosqu duis, dictum posuere senectus lobortis dui ultricies, non vitae hendrerit suspendisse.                    ") : ""
            ]);
        }

        $key = new App\KeyTranslation();
        $key->key = trim("layout.loginIndex.faq.secondCollapse                	");
        $key->device_type_id = $device->id;
        $key->save();

        foreach ($languages as $language) {
            $key->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? trim("Lorem ipsum dolor sit amet consectetur adipiscing elit lectus pharetra quisque sociis mollis            ") : ""
            ]);
        }

        $key = new App\KeyTranslation();
        $key->key = trim("layout.loginIndex.faq.secondCollapseDescription     	");
        $key->device_type_id = $device->id;
        $key->save();

        foreach ($languages as $language) {
            $key->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? trim("Lorem ipsum dolor sit amet consectetur adipiscing elit lectus pharetra quisque sociis mollis, eleifend porttitor habitant consequat hac blandit vivamus mi mattis molestie. Interdum penatibus volutpat velit montes sollicitudin et at vel suscipit, posuere sapien felis nullam morbi libero fames sed ultricies cum, luctus tristique imperdiet tempus augue tempor ligula potenti. Nunc rhoncus iaculis nec sociosqu duis, dictum posuere senectus lobortis dui ultricies, non vitae hendrerit suspendisse.                    ") : ""
            ]);
        }

        $key = new App\KeyTranslation();
        $key->key = trim("layout.loginIndex.faq.thirdCollapse                 	");
        $key->device_type_id = $device->id;
        $key->save();

        foreach ($languages as $language) {
            $key->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? trim("Lorem ipsum dolor sit amet consectetur adipiscing elit lectus pharetra quisque sociis mollis        ") : ""
            ]);
        }

        $key = new App\KeyTranslation();
        $key->key = trim("layout.loginIndex.faq.thirdCollapseDescription      	");
        $key->device_type_id = $device->id;
        $key->save();

        foreach ($languages as $language) {
            $key->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? trim("Lorem ipsum dolor sit amet consectetur adipiscing elit lectus pharetra quisque sociis mollis, eleifend porttitor habitant consequat hac blandit vivamus mi mattis molestie. Interdum penatibus volutpat velit montes sollicitudin et at vel suscipit, posuere sapien felis nullam morbi libero fames sed ultricies cum, luctus tristique imperdiet tempus augue tempor ligula potenti. Nunc rhoncus iaculis nec sociosqu duis, dictum posuere senectus lobortis dui ultricies, non vitae hendrerit suspendisse.                    ") : ""
            ]);
        }

        $key = new App\KeyTranslation();
        $key->key = trim("layout.loginIndex.faq.fourthCollapse                	");
        $key->device_type_id = $device->id;
        $key->save();

        foreach ($languages as $language) {
            $key->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? trim("Lorem ipsum dolor sit amet consectetur adipiscing elit lectus pharetra quisque sociis mollis            ") : ""
            ]);
        }

        $key = new App\KeyTranslation();
        $key->key = trim("layout.loginIndex.faq.fourthCollapseDescription     	");
        $key->device_type_id = $device->id;
        $key->save();

        foreach ($languages as $language) {
            $key->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? trim("Lorem ipsum dolor sit amet consectetur adipiscing elit lectus pharetra quisque sociis mollis, eleifend porttitor habitant consequat hac blandit vivamus mi mattis molestie. Interdum penatibus volutpat velit montes sollicitudin et at vel suscipit, posuere sapien felis nullam morbi libero fames sed ultricies cum, luctus tristique imperdiet tempus augue tempor ligula potenti. Nunc rhoncus iaculis nec sociosqu duis, dictum posuere senectus lobortis dui ultricies, non vitae hendrerit suspendisse.                    ") : ""
            ]);
        }

        $key = new App\KeyTranslation();
        $key->key = trim("layout.loginIndex.faq.fiveCollapse                  	");
        $key->device_type_id = $device->id;
        $key->save();

        foreach ($languages as $language) {
            $key->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? trim("Lorem ipsum dolor sit amet consectetur adipiscing elit lectus pharetra quisque sociis mollis        ") : ""
            ]);
        }

        $key = new App\KeyTranslation();
        $key->key = trim("layout.loginIndex.faq.fiveCollapseDescription       	");
        $key->device_type_id = $device->id;
        $key->save();

        foreach ($languages as $language) {
            $key->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? trim("Lorem ipsum dolor sit amet consectetur adipiscing elit lectus pharetra quisque sociis mollis, eleifend porttitor habitant consequat hac blandit vivamus mi mattis molestie. Interdum penatibus volutpat velit montes sollicitudin et at vel suscipit, posuere sapien felis nullam morbi libero fames sed ultricies cum, luctus tristique imperdiet tempus augue tempor ligula potenti. Nunc rhoncus iaculis nec sociosqu duis, dictum posuere senectus lobortis dui ultricies, non vitae hendrerit suspendisse.                    ") : ""
            ]);
        }

        $key = new App\KeyTranslation();
        $key->key = trim("layout.loginIndex.faq.sixCollapse                   	");
        $key->device_type_id = $device->id;
        $key->save();

        foreach ($languages as $language) {
            $key->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? trim("Lorem ipsum dolor sit amet consectetur adipiscing elit lectus pharetra quisque sociis mollis        ") : ""
            ]);
        }

        $key = new App\KeyTranslation();
        $key->key = trim("layout.loginIndex.faq.sixCollapseDescription        	");
        $key->device_type_id = $device->id;
        $key->save();

        foreach ($languages as $language) {
            $key->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? trim("Lorem ipsum dolor sit amet consectetur adipiscing elit lectus pharetra quisque sociis mollis, eleifend porttitor habitant consequat hac blandit vivamus mi mattis molestie. Interdum penatibus volutpat velit montes sollicitudin et at vel suscipit, posuere sapien felis nullam morbi libero fames sed ultricies cum, luctus tristique imperdiet tempus augue tempor ligula potenti. Nunc rhoncus iaculis nec sociosqu duis, dictum posuere senectus lobortis dui ultricies, non vitae hendrerit suspendisse.                    ") : ""
            ]);
        }

        $key = new App\KeyTranslation();
        $key->key = trim("layout.loginIndex.index.checkinExpress              	");
        $key->device_type_id = $device->id;
        $key->save();

        foreach ($languages as $language) {
            $key->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? trim("Check-in express            ") : ""
            ]);
        }

        $key = new App\KeyTranslation();
        $key->key = trim("layout.loginIndex.index.checkinExpressDescription   	");
        $key->device_type_id = $device->id;
        $key->save();

        foreach ($languages as $language) {
            $key->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? trim("Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolo                        ") : ""
            ]);
        }

        $key = new App\KeyTranslation();
        $key->key = trim("layout.loginIndex.index.bookingDetails              	");
        $key->device_type_id = $device->id;
        $key->save();

        foreach ($languages as $language) {
            $key->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? trim("View your booking details            ") : ""
            ]);
        }

        $key = new App\KeyTranslation();
        $key->key = trim("layout.loginIndex.index.bookingDetailsDescription   	");
        $key->device_type_id = $device->id;
        $key->save();

        foreach ($languages as $language) {
            $key->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? trim("Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolo                        ") : ""
            ]);
        }

        $key = new App\KeyTranslation();
        $key->key = trim("layout.loginIndex.index.addServices                 	");
        $key->device_type_id = $device->id;
        $key->save();

        foreach ($languages as $language) {
            $key->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? trim("Add services to your reservation        ") : ""
            ]);
        }

        $key = new App\KeyTranslation();
        $key->key = trim("layout.loginIndex.index.addServicesDescription      	");
        $key->device_type_id = $device->id;
        $key->save();

        foreach ($languages as $language) {
            $key->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? trim("Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolo                    ") : ""
            ]);
        }

        $key = new App\KeyTranslation();
        $key->key = trim("layout.loginIndex.reservation.details               	");
        $key->device_type_id = $device->id;
        $key->save();

        foreach ($languages as $language) {
            $key->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? trim("Detalles            ") : ""
            ]);
        }

        $key = new App\KeyTranslation();
        $key->key = trim("layout.loginIndex.reservation.checkin               	");
        $key->device_type_id = $device->id;
        $key->save();

        foreach ($languages as $language) {
            $key->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? trim("Check In            ") : ""
            ]);
        }

        $key = new App\KeyTranslation();
        $key->key = trim("layout.loginIndex.reservation.checkout              	");
        $key->device_type_id = $device->id;
        $key->save();

        foreach ($languages as $language) {
            $key->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? trim("Check Out            ") : ""
            ]);
        }

        $key = new App\KeyTranslation();
        $key->key = trim("layout.loginIndex.reservation.servicesAndAdds       	");
        $key->device_type_id = $device->id;
        $key->save();

        foreach ($languages as $language) {
            $key->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? trim("Servicios y/o extras contratados                    ") : ""
            ]);
        }

        $key = new App\KeyTranslation();
        $key->key = trim("layout.loginIndex.reservation.portableInternet      	");
        $key->device_type_id = $device->id;
        $key->save();

        foreach ($languages as $language) {
            $key->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? trim("Internet portable                    ") : ""
            ]);
        }

        $key = new App\KeyTranslation();
        $key->key = trim("layout.loginIndex.reservation.tablet                	");
        $key->device_type_id = $device->id;
        $key->save();

        foreach ($languages as $language) {
            $key->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? trim("Tablet            ") : ""
            ]);
        }

        $key = new App\KeyTranslation();
        $key->key = trim("layout.loginIndex.reservation.spaAccess             	");
        $key->device_type_id = $device->id;
        $key->save();

        foreach ($languages as $language) {
            $key->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? trim("Acceso al spa            ") : ""
            ]);
        }

        $key = new App\KeyTranslation();
        $key->key = trim("layout.loginIndex.reservation.keys                  	");
        $key->device_type_id = $device->id;
        $key->save();

        foreach ($languages as $language) {
            $key->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? trim("Llaves x2        ") : ""
            ]);
        }

        $key = new App\KeyTranslation();
        $key->key = trim("layout.loginIndex.reservation.bluRay                	");
        $key->device_type_id = $device->id;
        $key->save();

        foreach ($languages as $language) {
            $key->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? trim("Blu-Ray            ") : ""
            ]);
        }

        $key = new App\KeyTranslation();
        $key->key = trim("layout.loginIndex.reservation.name                  	");
        $key->device_type_id = $device->id;
        $key->save();

        foreach ($languages as $language) {
            $key->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? trim("Nombre        ") : ""
            ]);
        }

        $key = new App\KeyTranslation();
        $key->key = trim("layout.loginIndex.reservation.city                  	");
        $key->device_type_id = $device->id;
        $key->save();

        foreach ($languages as $language) {
            $key->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? trim("Ciudad        ") : ""
            ]);
        }

        $key = new App\KeyTranslation();
        $key->key = trim("layout.loginIndex.reservation.country               	");
        $key->device_type_id = $device->id;
        $key->save();

        foreach ($languages as $language) {
            $key->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? trim("País            ") : ""
            ]);
        }

        $key = new App\KeyTranslation();
        $key->key = trim("layout.loginIndex.reservation.experience            	");
        $key->device_type_id = $device->id;
        $key->save();

        foreach ($languages as $language) {
            $key->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? trim("Experiencia                ") : ""
            ]);
        }

        $key = new App\KeyTranslation();
        $key->key = trim("layout.loginIndex.reservation.postalCode            	");
        $key->device_type_id = $device->id;
        $key->save();

        foreach ($languages as $language) {
            $key->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? trim("Código postal                ") : ""
            ]);
        }

        $key = new App\KeyTranslation();
        $key->key = trim("layout.loginIndex.reservation.phone                 	");
        $key->device_type_id = $device->id;
        $key->save();

        foreach ($languages as $language) {
            $key->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? trim("Teléfono        ") : ""
            ]);
        }

        $key = new App\KeyTranslation();
        $key->key = trim("layout.loginIndex.reservation.amount                	");
        $key->device_type_id = $device->id;
        $key->save();

        foreach ($languages as $language) {
            $key->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? trim("Importe            ") : ""
            ]);
        }

        $key = new App\KeyTranslation();
        $key->key = trim("layout.loginIndex.reservation.email                 	");
        $key->device_type_id = $device->id;
        $key->save();

        foreach ($languages as $language) {
            $key->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? trim("Correo        ") : ""
            ]);
        }

        $key = new App\KeyTranslation();
        $key->key = trim("layout.loginIndex.reservation.id                    	");
        $key->device_type_id = $device->id;
        $key->save();

        foreach ($languages as $language) {
            $key->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? trim("ID        ") : ""
            ]);
        }

        $key = new App\KeyTranslation();
        $key->key = trim("layout.loginIndex.reservation.date                  	");
        $key->device_type_id = $device->id;
        $key->save();

        foreach ($languages as $language) {
            $key->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? trim("FECHA        ") : ""
            ]);
        }

        $key = new App\KeyTranslation();
        $key->key = trim("layout.loginIndex.reservation.ota                   	");
        $key->device_type_id = $device->id;
        $key->save();

        foreach ($languages as $language) {
            $key->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? trim("OTA        ") : ""
            ]);
        }

        $key = new App\KeyTranslation();
        $key->key = trim("layout.loginIndex.reservation.service               	");
        $key->device_type_id = $device->id;
        $key->save();

        foreach ($languages as $language) {
            $key->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? trim("SERVICIO            ") : ""
            ]);
        }

        $key = new App\KeyTranslation();
        $key->key = trim("layout.loginIndex.reservation.quantity              	");
        $key->device_type_id = $device->id;
        $key->save();

        foreach ($languages as $language) {
            $key->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? trim("CANTIDAD            ") : ""
            ]);
        }

        $key = new App\KeyTranslation();
        $key->key = trim("layout.loginIndex.reservation.amount                	");
        $key->device_type_id = $device->id;
        $key->save();

        foreach ($languages as $language) {
            $key->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? trim("Importe            ") : ""
            ]);
        }

        $key = new App\KeyTranslation();
        $key->key = trim("layout.loginIndex.reservation.estate                	");
        $key->device_type_id = $device->id;
        $key->save();

        foreach ($languages as $language) {
            $key->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? trim("ESTADO            ") : ""
            ]);
        }

        $key = new App\KeyTranslation();
        $key->key = trim("layout.loginIndex.reservation.edit                  	");
        $key->device_type_id = $device->id;
        $key->save();

        foreach ($languages as $language) {
            $key->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? trim("EDITAR        ") : ""
            ]);
        }

        $key = new App\KeyTranslation();
        $key->key = trim("layout.loginIndex.reservation.reservaId             	");
        $key->device_type_id = $device->id;
        $key->save();

        foreach ($languages as $language) {
            $key->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? trim("ID RESERVA            ") : ""
            ]);
        }

        $key = new App\KeyTranslation();
        $key->key = trim("layout.loginIndex.reservation.nameAndLastName       	");
        $key->device_type_id = $device->id;
        $key->save();

        foreach ($languages as $language) {
            $key->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? trim("Nombre y Apellido                    ") : ""
            ]);
        }

        $key = new App\KeyTranslation();
        $key->key = trim("layout.loginIndex.reservation.tipology              	");
        $key->device_type_id = $device->id;
        $key->save();

        foreach ($languages as $language) {
            $key->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? trim("Tipología            ") : ""
            ]);
        }

        $key = new App\KeyTranslation();
        $key->key = trim("layout.loginIndex.reservation.experience            	");
        $key->device_type_id = $device->id;
        $key->save();

        foreach ($languages as $language) {
            $key->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? trim("Experiencia                ") : ""
            ]);
        }

        $key = new App\KeyTranslation();
        $key->key = trim("layout.loginIndex.reservation.adults                	");
        $key->device_type_id = $device->id;
        $key->save();

        foreach ($languages as $language) {
            $key->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? trim("Adultos            ") : ""
            ]);
        }

        $key = new App\KeyTranslation();
        $key->key = trim("layout.loginIndex.reservation.withoutReservation   	");
        $key->device_type_id = $device->id;
        $key->save();

        foreach ($languages as $language) {
            $key->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? trim("Sin Reservas                        ") : ""
            ]);
        }

        $key = new App\KeyTranslation();
        $key->key = trim("layout.loginIndex.reservation.ReservationResume     	");
        $key->device_type_id = $device->id;
        $key->save();

        foreach ($languages as $language) {
            $key->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? trim("RESUMEN DE LA RESERVA                    ") : ""
            ]);
        }

        $key = new App\KeyTranslation();
        $key->key = trim("layout.loginIndex.services.selected                 	");
        $key->device_type_id = $device->id;
        $key->save();

        foreach ($languages as $language) {
            $key->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? trim("SELECCIONADO        ") : ""
            ]);
        }

        $key = new App\KeyTranslation();
        $key->key = trim("layout.loginIndex.services.select                   	");
        $key->device_type_id = $device->id;
        $key->save();

        foreach ($languages as $language) {
            $key->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? trim("SELECCIONAR        ") : ""
            ]);
        }

        $key = new App\KeyTranslation();
        $key->key = trim("layout.loginIndex.services.saveSuitcases            	");
        $key->device_type_id = $device->id;
        $key->save();

        foreach ($languages as $language) {
            $key->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? trim("Si te vas tarde puedes guardar las maletas con nosotros por sólo 10€                ") : ""
            ]);
        }

        $key = new App\KeyTranslation();
        $key->key = trim("layout.loginIndex.services.loadServices             	");
        $key->device_type_id = $device->id;
        $key->save();

        foreach ($languages as $language) {
            $key->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? trim("cargar todos los servicios            ") : ""
            ]);
        }

        $key = new App\KeyTranslation();
        $key->key = trim("layout.loginIndex.services.pendingPayments          	");
        $key->device_type_id = $device->id;
        $key->save();

        foreach ($languages as $language) {
            $key->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? trim("Pagos pendientes                ") : ""
            ]);
        }

        $key = new App\KeyTranslation();
        $key->key = trim("layout.loginIndex.services.concept                  	");
        $key->device_type_id = $device->id;
        $key->save();

        foreach ($languages as $language) {
            $key->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? trim("CONCEPTO        ") : ""
            ]);
        }

        $key = new App\KeyTranslation();
        $key->key = trim("layout.loginIndex.services.amount                   	");
        $key->device_type_id = $device->id;
        $key->save();

        foreach ($languages as $language) {
            $key->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? trim("IMPORTE        ") : ""
            ]);
        }

        $key = new App\KeyTranslation();
        $key->key = trim("layout.loginIndex.services.customizeStay            	");
        $key->device_type_id = $device->id;
        $key->save();

        foreach ($languages as $language) {
            $key->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? trim("PERSONALIZA TU ESTANCIA                ") : ""
            ]);
        }

        $key = new App\KeyTranslation();
        $key->key = trim("layout.loginIndex.services.subtotal                 	");
        $key->device_type_id = $device->id;
        $key->save();

        foreach ($languages as $language) {
            $key->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? trim("SUBTOTAL        ") : ""
            ]);
        }

        $key = new App\KeyTranslation();
        $key->key = trim("layout.loginIndex.services.iva                      	");
        $key->device_type_id = $device->id;
        $key->save();

        foreach ($languages as $language) {
            $key->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? trim("IVA    ") : ""
            ]);
        }

        $key = new App\KeyTranslation();
        $key->key = trim("layout.loginIndex.services.total                    	");
        $key->device_type_id = $device->id;
        $key->save();

        foreach ($languages as $language) {
            $key->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? trim("TOTAL        ") : ""
            ]);
        }

        $key = new App\KeyTranslation();
        $key->key = trim("layout.loginIndex.services.pay                      	");
        $key->device_type_id = $device->id;
        $key->save();

        foreach ($languages as $language) {
            $key->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? trim("Pagar    ") : ""
            ]);
        }

        $key = new App\KeyTranslation();
        $key->key = trim("layouts.default.btnreserve");
        $key->device_type_id = $device->id;
        $key->save();

        foreach ($languages as $language) {
            $key->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? trim("Reservar") : ""
            ]);
        }
    }

    private function machineTranslations()
    {
        $deviceType = \App\DeviceType::where('code', 'machine')->first();

        $language = new \App\Language();
        $language->name = 'Español';
        $language->iso = 'es';
        $language->flag = 'languages/spain.png';
        $language->status = \App\Language::STATUS_ACTIVE;
        $language->order = 1;
        $language->save();

        $json = '{"message":{"castro":"castro Exclusive Residences","contact":"Contacto","idioma":"Idioma","continue":"Continuar","checkin":"Check - in","checkout":"Check - out","pPax":"p/pax","pNight":"p/noche","pStay":"p/estancia","floor1":"Piso 0 |1er Piso|2do Piso","floor2":"3er Piso|4to Piso|5to Piso","floors":[{"floor":"Piso 0"},{"floor":"1er Piso"},{"floor":"2do Piso"},{"floor":"3er Piso"},{"floor":"4to Piso"},{"floor":"5to Piso"}]},"screensaver":{"touch":"Toca la pantalla para continuar"},"welcome":{"bienvenido":"Bienvenido a","residencias":"Exclusive Residences","castro":"castro","selecciona":"Selecciona el idioma"},"selectoption":{"select":"Selecciona una opción","others":"Otros"},"others":{"select":"Selecciona una opción","others":"Otros","lostkeys":"perdí mis llaves","duplicatekeys":"Duplicado de llaves","suggestions":"sugerencias","recorde":"RECORDAR Nº DE APTo"},"listreserve":{"reservation":"Reserva","yourReservation":"Tu reserva","locator":"Localizador","nPax":"N° pax","typeApt":"Tipo de apto","planApt":"Plan apto","experience":"Experiencia","area":"Superficie de","pPax":"p/pax","pNight":"p/noche","pStay":"p/estancia","photos":"Fotos del apartamento","better":"mejorar","modify":"modificar","skip":"Omitir","save":"guardar","bedrooms":"Dormitorio | Dormitorios","bathrooms":"Baño | Baños","changeExperienceTo":"Cámbia tu experiencia a ","forCost":" por un costo de ","adults":"Adultos","children":"Niños","onlyroom":"Lorem ipsum dolor, ut wisi enim ad minim ve","aptReserved":"Apartamento reservado","knowApt":"Conoce el Apartamento","noUpgradeApt":"No mejorar apartamento","noUpgradePlanApt":"No mejorar plan de apartamento","notUpgradeExperience":"No mejorar experiencia","selectExperience":"Selecciona qué experiencia quieres vivir","selectPlan":"Selecciona para mejorar tu plan de apartamento","descriptionApts":["Descubre Barcelona de una manera diferente, anímate a disfrutar de nuestros maravillosos dúplex","Apartamentos de dos habitaciones decorados con la esencia de la ciudad de Barcelona","Sumérgete en el ambiente de diseño que te ofrecen nuestros apartamentos de 3 habitaciones"],"descriptionExp":["La experiencia BASIC ofrece alojamientos equipados para el máximo confort, en cualquier momento de tu estancia podrás contratar otros servicios complementarios","Con la experiencia DELUXE, disfrutarás de apartamentos decorados con toda la esencia de la ciudad de Barcelona","Una estancia de ensueño en nuestra ciudad. Dispondrás de todos los servicios exclusivos ¡y mucho más!"]},"checkin":{"title":"Para iniciar, indícanos tu apellido o localizador de reserva","noFound":"No pudimos encontrar tu reserva,","tryAgain":" ¡Inténtalo de nuevo!","lastname":"Apellido o localizador","search":"Buscar","loading":"Buscando reserva"},"guests":{"title":"Datos de los huéspedes","adult":"Adulto","child":"Niño","add":"Agregar huésped","edit":"editar"},"gratitude":{"support":"Tu apartamento está ubicado en el","thanks":"Gracias por confiar en castro Exclusive Residences","wish":"¡Deseamos que tengas una estancia extraordinaria!","checkin":"Recuerda que al realizar check - out debe ser antes de las","checkin1":"11:00 AM,","checkon":"si requieres salir después, contrata el servicio de","checkon1":"Late Check - Out","luggage":"o utiliza los lockers para guardar tu equipaje","footer":"Para cualquier duda o información adicional:","footer1":"Llámanos al 7000 pulsando","phone":"O a través de","contract":"¡Contrata ahora el servicio Late Check - out","obtain":"y obtén","discount":"de descuento!","want_late":"Quiero contratar Late Check - out","want":"Quiero contratar "},"loading":{"title":"Cargando","titleServices":"SERVICIOS QUE PUEDES DISFRUTAR DURANTE TU ESTADÍA"},"scan":{"child":"Niño","adult":"Adulto","passport":"Por favor escanea el pasaporte del huésped","scan":"Escanear","scanning":"Escaneando"},"contact":{"you":"¿Tienes dudas o necesitas información adicional?","problem":"¿Tienes inconvenientes con tu reserva?","call":"llamando al","contactus":"Contacta con nosotros ","across":"O a través de"},"summary":{"concept":"Concepto","import":"Importe","select":"Selecciona tu apto","pending":"Pendiente de pago","summarypayment":"Resumen de pago","make":"Realizar pago","total":"total","free":"gratis","tax":"City tax","choosed":"Seleccion de apto","bedrooms":"Dormitorio | Dormitorios","bathrooms":"Baño | Baños","upgradeApt":"Mejora tipo de apartamento","upgradePlan":"Mejora Plan de apartamento","upgradeExperience":"Mejora Experiencia","termns":"Acepto los términos y condiciones de uso","advise":"Acepto recibir notificaciones, beneficios y promociones","servics":"Servicios","correctPayment":"Pago procesado correctamente","errorSavePayment":"error al guardar el pago","errorTpv":"Error al procesar el pago por el TPV","chargerERP":"Llamar para ayuda","insertCard":"Por favor, introduce la tarjeta de crédito<br><span>en la ranura</span> y sigue las instrucciones del TPV"},"numberapto":{"select":"¿Deseas seleccionar el número de apartamento?","preference":"Puedes seleccionar el apartamento de tu preferencia","additional":"por un costo adicional de","cash":"20€","yes":"¡Si quiero! ","no":"No"},"earlycheck":{"cancel":"cancelar","remember":"Recuerda que podrás acceder a tu apartamento a partir de las 16:00h, o entrar antes contratando Early Check - in","contract":"Contratar Early Check - in","early":"Early Check - in"},"termsConditions":{"gree":"Acepto","terms":"Términos y condiciones de uso"},"notifications":{"receive":"Si no aceptas recibir notificaciones, tu factura no podrá","email":"ser enviada a tu correo electrónico","sure":"¿Estás seguro que no quieres aceptar el recibo de notificaciones?","yes":"Si","no":"No"},"keyPrinting":{"apartment":"Tu apartamento está ubicado en el","thkForReg":"Gracias por registrarte en","sendVoucher":"Te hemos enviado el comprobante","sendVoucher2":"de pago vía correo electrónico","printingKeys":"Estamos imprimiendo tus llaves","waitMoment":"Por favor espera un momento","thanks":"GRACIAS POR UTILIZAR NUESTRO SERVICIO","footer":"Para cualquier duda o información adicional:","footer1":"Llámanos al 7000 pulsando","phone":"O a través de"},"gueststay":{"stay":"esperamos que hayas tenido una estancia extraordinaria con nosotros","inserted":"Llaves insertadas","inserkeys":"Por favor inserta todas las llaves<br>que te suministramos en el check-in","nopkeys":"No tengo más llaves","inserborder":"Inserta una llave en la ranura para identificarte","staying":"¡Gracias por alojarte en"},"comments":{"email":"welcome@castroexclusiveresidences.com","submit":"Enviar","send":"O envíanos un correo electrónico a","as":"¿Cómo podemos mejorar?","tell":"Cuéntanos","sugges":"Tus sugerencias son muy importantes para","white":"Escribe aquí tus comentarios"},"alreadychecked":{"seems":"¡Parece que ya hiciste check-in con tu teléfono!","set":"Continúa para configurar tu apartamento","continue":"Continuar","not":"No hice check-in con mi teléfono"},"someonechekin":{"seems":"¡Alguien de tu apartamento ya ha hecho Check-in!","set":"Por favor accede a duplicar tus llaves","continue":"Si, alguien ya hizo check - in","not":"No hice check - in"},"tipcheckout":{"happy":"¡Nos alegra que estés contento!","fullHappy":"Si lo deseas, puedes dar al equipo castro Exclusive Residences la propina que consideres","perso":"Personalizar","select":"Selecciona una opción","not":"No dar propina"},"TechnicalFailure":{"hey":"¡Hey!","moment":"Ocurrió una falla técnica","soon":"Por favor, intenta nuevamente","contactus":"Si tienes inconvenientes, contáctanos","slant":"O a través de","retry":"Reintentar"},"gratitudecheckout":{"thanks":"GRACIAS POR VIVIR LA EXPERIENCIA","finish":"Finalizar"},"maintenance":{"sorry":"Disculpa","moment":"En este momento estamos en mantenimiento","soon":"¡Pronto estaremos de vuelta!","contactus":"Contacta con nosotros llamando al","slant":"O a través de"},"home":{"star":"¡Hey! ¿Estás seguro que quieres volver al al inicio?","fact":"¡Se perderá todo lo que has hecho!","yes":"Si, quiero volver","no":"No quiero"},"selectApto":{"selectApt":"Selecciona el apartamento de tu preferencia","topApto":"Tu apartamento está ubicado en el","sunny":"Soleado todo el día","seeCity":"Con vista a la ciudad","available":"Disponible","occupied":"Ocupados","select":"Seleccionado","youSelect":"Tu selección","seePict":"Ver fotos","toAccept":"Aceptar","Floor":"Piso"},"AddLateCheckout":{"notDateCheckOut":"¡todavía no se cumple tu fecha de Check - out!","dateIsday":"Tu fecha correspondiente es el día","lateCheckOut":"Late Check - out","addLateCheckOut":"Contratar Late Check - out","cancel":"Cancelar"},"ThanksShareGoogle":{"thankLifeExp":"GRACIAS POR VIVIR LA EXPERIENCIA","opinion":"¡PARA NOSOTROS TU OPINIÓN ES IMPORTANTE!","yourCompanions":"Nos encantaría que tú y tus acompañantes","assessInstance":"valoren la estancia ¡No te quitará mucho tiempo!","assess":"VALORA TU ESTANCIA EN","finalize":"finalizar"},"gridresults":{"results":"Resultados para","select":"Selecciona tu reserva"},"problemskeys":{"keyFor":"Ubica una llave de emergencia en el punto que te indicamos en la imagen","entrer":"Ingresa el código de seguridad y retira una llave de tu apartamento","apto":"Tu apartamento","floor":"Piso","code":"Código de seguridad","problems":"¿Problemas para imprimir tus llaves?"},"keysbasic":{"desactivekeys":"Tus llaves anteriores han sido desactivados <br> por seguridad","sorry":"disculpa la molestias ocasionadas, no cuentas con el servicio de duplicado de llaves","moment":"Si deseas imprimir una nueva llave debes realizar un pago de {priceKey}€ por cada una","nameKeys":"Número de llaves","apartment":"Apartamento","follow":"Tus llaves anteriores seguirán en funcionamiento","print":"Imprimir"},"keysnobasic":{"desactivekeys":"Tus llaves anteriores han sido desactivados <br> por seguridad","sorry":"indícanos cuántas llaves de tu apartamento necesitarás","moment":"Si deseas imprimir una nueva llave debes realizar un pago de {priceKey}€ por cada una","nameKeys":"Número de llaves","apartment":"Apartamento","follow":"Tus llaves anteriores seguirán en funcionamiento","print":"Imprimir","inserted":"Imprimiendo llaves"},"loskeys":{"title":"Indícanos la siguiente información para obtener nuevas llaves","moment":"Si deseas imprimir una nueva llave debes realizar un pago de {priceKey}€ por cada una","tryAgain":"¡Intentémoslo de nuevo!","lastname":"APELLIDO O LOCALIZADOR / No DE APTO","search":"Buscar","noFound":"No pudimos encontrar tus llaves","inputLastname":""},"remember":{"title":"Indícanos la siguiente información para recordar tu apartamento","moment":"Si deseas imprimir una nueva llave debes realizar un pago de {priceKey}€ por cada una","tryAgain":"¡Intentémoslo de nuevo!","lastname":" APELLIDO - FECHA CHECK - OUT","continue":"Continuar","noFound":"No pudimos encontrar tus llaves"},"gratitudeothers":{"thanks":"GRACIAS POR UTILIZAR NUESTRO SERVICIO","footer":"Para cualquier duda o información adicional:","footer1":"Llámanos al 7000 pulsando","phone":"O a través de"},"keyprintbasic":{"correctly":"El pago se procesó correctamente","remember":"Recuerda que tus llaves anteriores","disable":"han sido desactivadas por seguridad","print":"Estamos imprimiendo","apartment":"Tu apartamento está ubicado en el","thkForReg":"Gracias por registrarte en","sendVoucher":"Te hemos enviado el comprobante","sendVoucher2":"de pago vía correo electrónico","printingKeys":"Estamos imprimiendo tus llaves","waitMoment":"Por favor espera un momento"},"assessment":{"staying":"Gracias por alojarte en","invoice":"Si deseas recibir tu factura","confirm":"por favor confirma tu correo electrónico","waths":"¿Qué te pareció la estancia?","valore":"Valora tu experiencia siendo 10 la nota más alta"},"pendingpayments":{"pending":"Tus pagos pendientes","resumen":"Resumen de pagos","concept":"Concepto","cantid":"cantidad","import":"importe","pendingpayment":"Pagos pendientes","additional":"Llaves adicionales","total":"TOTAL","iva":"IVA incluido","intro":"Por favor, introduce la tarjeta de crédito en la ranura para realizar el pago de tus gastos pendientes"},"modalspenttime":{"title":"¡Se está agotando el tiempo! ","msg":"Toca la pantalla o el botón para continuar","yes":"¡Aquí estoy!"},"modalchargererp":{"title":"¡Hey! ","errortpv":"Para procesar tu pago satisfactoriamente","error":"Ocurrió un error procesando tu pago","msg":"Por favor comunícate con nosotros, en breve te atenderemos","contact":"Contacta con nosotros llamando al "},"keyRequest":{"Has":"Has insertado","llaves":"llaves","inserted":"Inserta las llaves restantes","costed":"Las llaves no insertadas tendran un coste adicional de 10€ por cada una","via":"O llámanos via","insertll":"Insertar llave","noll":"No tengo más llaves"},"flag":"/dist/images/png/spain.png"}';
        $data = json_decode($json, true);

        $translationResponse = $this->buildTranslations($data);

        foreach ($translationResponse as $tr) {

            $translation = new \App\KeyTranslation();
            $translation->device_type_id = $deviceType->id;
            $translation->key = $tr['key'];
            $translation->save();

            $translation->languages()->attach($language->id, ['translation' => $tr['translation']]);
        }

        $language = new \App\Language();
        $language->name = 'English';
        $language->iso = 'en';
        $language->flag = 'languages/uk.png';
        $language->status = \App\Language::STATUS_ACTIVE;
        $language->order = 2;
        $language->save();

        $json = '{"message":{"castro":"castro Exclusive Residences","contact":"Contact","idioma":"Language","continue":"continue","checkin":"Check - in","checkout":"Check - out","pPax":"p/pax","pNight":"p/night","pStay":"p/stay","floor1":"Floor 0|1st Floor|2nd Floor","floor2":"3rd Floor|4th Floor|5th Floor","floors":[{"floor":"Piso 0"},{"floor":"1st Piso"},{"floor":"2nd Piso"},{"floor":"3rd Piso"},{"floor":"4th Piso"},{"floor":"5th Piso"}]},"screensaver":{"touch":"Touch the creen to continue"},"welcome":{"bienvenido":"Welcome to","residencias":"Exclusive Residences","castro":"castro","selecciona":"Select the language"},"selectoption":{"select":"Select an option","others":"Others"},"others":{"select":"Select an option","others":"Others","lostkeys":"I lost my keys","duplicatekeys":"Duplicate keys","suggestions":"suggestions","recorde":"REMEMBER Nº DE APTo"},"listreserve":{"reservation":"Reservation","yourReservation":"Your Reservation","locator":"Locator","nPax":"N° pax","typeApt":"Type of apt","planApt":"Plan apt","experience":"Experience","area":"Surface of","pPax":"p/pax","pNight":"p/night","photos":"Photos of the apartment","better":"better","modify":"modify","skip":"Skyp","save":"save","bedrooms":"Bedroom | Bedrooms","bathrooms":"Bathroom | Bathrooms","changeExperienceTo":"Change your experience to ","forCost":" for a cost of ","adults":"Adults","children":"Children","onlyroom":"","aptReserved":"Apartment reserved","knowApt":"Know the Apartment","noUpgradeApt":"Do not improve apartment","noUpgradePlanApt":"Do not improve plan of apartment","notUpgradeExperience":"Do not improve experience","selectExperience":"Select what experience you want to live","selectPlan":"Select to improve your apartment plan","descriptionApts":["Discover Barcelona in a different way, go ahead and enjoy our wonderful duplex","Two-room apartments decorated with the essence of the city of Barcelona","Immerse yourself in the design atmosphere offered by our 3-room apartments"],"descriptionExp":["The BASIC experience offers equipped accommodations for maximum comfort, at any time during your stay you can hire other complementary services","With the DELUXE experience, you will enjoy apartments decorated with the essence of the city of Barcelona","A dream stay in our city. You will have all the exclusive services and much more!"]},"checkin":{"title":"To start, tell us your last name or reservation locator","noFound":"We could not find your reservation, ","tryAgain":"let\'s try it again!","lastname":"Lastname o locator","search":"Search","loading":"Looking for a reservation"},"guests":{"title":"Guests information","adult":"Adult","child":"Child","add":"add guests","edit":"edit"},"gratitude":{"support":"Your apartment is located in the","thanks":"Thank you for trusting castro Exclusive Residences","wish":"We wish you an extraordinary stay!","checkin":"Remember that when checking out, it must be before the","checkin1":"11:00 AM,","checkon":"If you need to leave later, hire the service","checkon1":"Late Check - Out","luggage":"or use the lockers to store your luggage","footer":"Para cualquier duda o información adicional:","footer1":"Llámanos al 7000 pulsando","phone":"Or through the","contract":"Contract now the Late Check - out service","obtain":"and get","discount":"de descuento!","want_late":"I want to hire Late Check - out","want":"I want to hire "},"loading":{"title":"Loading","titleServices":"SERVICES YOU CAN ENJOY DURING YOUR STAY"},"scan":{"child":"child","adult":"adult","passport":"Please scan the guest\'s passport","scan":"scan","scaning":"scanning"},"contact":{"you":"¿You have questions or need additional information?","problem":"¿Tienes inconvenientes con tu reserva?","call":"calling 7000","contactus":"Contact us","across":"Or through the"},"summary":{"concept":"Concept","import":"Amount","select":"Select your apt","pending":"Pending payment","summarypayment":"Payment summary","make":"Make payment","total":"total","free":"free","tax":"City tax","choosed":"Select your apt","bedrooms":"Bedroom | Bedrooms","bathrooms":"Bathroom | Bathrooms","upgradeApt":"Improved type of apartment","upgradePlan":"Improved apartment plan","upgradeExperience":"Improved Experience","termns":"I accept the terms and conditions of use","advise":"I agree to receive notifications, benefits and promotions","servics":"Services","correctPayment":"Payment processed correctly","errorSavePayment":"error when saving the payment","errorTpv":"Error processing the payment by TPV","chargerERP":"Call for help","insertCard":"Please enter the credit card <br> <span> in the slot </ span> and follow the instructions of the POS"},"numberapto":{"select":"Do you want to select the apartment number?","preference":"You can select the apartment of your preference","additional":"for an additional cost of","cash":"20€","yes":"Yes, I want!","no":"Do not"},"earlycheck":{"cancel":"cancel","remember":"Recuerda que podrás acceder a tu apartamento a partir de las 16:00h, o entrar antes contratando Early Check - in","contract":"Hire Early Check - in","early":"Early Check - in"},"termsConditions":{"gree":"I agree","terms":"Terms and conditions of use"},"notifications":{"receive":"If you do not accept receiving notifications, your bill can not","email":"be sent to your email","sure":"Are you sure you do not want to accept the notification receipt?","yes":"Yes","no":"No"},"keyPrinting":{"apartment":"Your apartment is located in the","thkForReg":"Thanks for signing up","sendVoucher":"We have sent you the receipt","sendVoucher2":"payment via email","printingKeys":"We are printing your keys","waitMoment":"Please wait a moment","thanks":"THANK YOU FOR USING OUR SERVICE","footer":"For any questions or additional information:","footer1":"Call us at 7000 by pressing","phone":"Or through the"},"gueststay":{"stay":"we hope you had an extraordinary stay with us","inserted":"Inserted keys","inserkeys":"Please insert all the keys<br>that we supply you at check-in","nopkeys":"I do not have more keys","inserborder":"Insert a key into the slot to identify yourself","staying":"Thanks for staying in"},"comments":{"email":"welcome@castroexclusiveresidences.com","submit":"Submit","send":"Or send us an email to","as":"¿How can we improve?","tell":"Tell us","sugges":"Your suggestions are very important for","white":"Write your comments here"},"alreadychecked":{"seems":"¡It seems that you already checked in with your phone!","set":"Continue to set up your apartment","continue":"Continue","not":"I did not check-in with my phone"},"someonechekin":{"seems":"¡Someone in your apartment has already done Check-in!","set":"Continue to set up your apartment","continue":"Yes, someone has already checked in","not":"I did not check-in"},"tipcheckout":{"happy":"¡We\'re glad you\'re happy!","fullHappy":"If you wish, you can give the castro Exclusive Residences team the tip you consider","perso":"Personalize","select":"Select an option","not":"Do not give a tip"},"TechnicalFailure":{"hey":"¡Hey!","moment":"A technical failure occurred","soon":"Please, try again","contactus":"If you have problems, contact us","slant":"Or through the","retry":"retry"},"gratitudecheckout":{"thanks":"THANKS FOR LIVING THE EXPERIENCE","finish":"Finalize"},"maintenance":{"sorry":"Sorry","moment":"At this moment we are in maintenance","soon":"Soon we will be back!","contactus":"Contact us by calling","slant":"Or through the"},"home":{"star":"Hey! Are you sure you want to go back to the beginning?","fact":"Everything you have done will be lost!","yes":"Yes, I want to go back","no":"I do not want"},"selectApto":{"selectApt":"Select the apartment of your choice","topApto":"Your apartment is located in the","sunny":"Sunny all day","seeCity":"With a view of the city","available":"Available","occupied":"Busy","select":"Selected","youSelect":"Your selection","seePict":"To see photos","toAccept":"To accept","Floor":"Floor"},"AddLateCheckout":{"notDateCheckOut":"¡todavía no se cumple tu fecha de Check - out!","dateIsday":"Tu fecha correspondiente es el día","lateCheckOut":"Late Check - out","addLateCheckOut":"Contratar Late Check - out","cancel":"Cancelar"},"ThanksShareGoogle":{"thankLifeExp":"THANKS FOR LIVING THE EXPERIENCE","opinion":"FOR US YOUR OPINION IS IMPORTANT!","yourCompanions":"We would love that you and your companions","assessInstance":"value the stay It will not take much time!","assess":"VALUE YOUR STAY IN","finalize":"Finalize"},"gridresults":{"results":"results for","select":"Select your reservation"},"problemskeys":{"keyFor":"Locate an emergency key at the point indicated in the image","entrer":"Enter the security code and remove a key from your apartment","apto":"Your apartment","floor":"Floor","code":"Security code","problems":"¿Problems printing your keys?"},"keysbasic":{"desactivekeys":"Your previous keys have been disabled <br> for security","sorry":"tell us how many keys of your apartment will you need","moment":"If you want to print a new key you must make a payment of {priceKey}€ for each one","nameKeys":"Number of keys","apartment":"Apartment","follow":"Your previous keys will remain in operation","print":"To print","inserted":"Printing keys"},"loskeys":{"title":"Tell us the following information to obtain new keys","moment":"If you want to print a new key you must make a payment of € 15 for each one","tryAgain":"¡Let\'s try it again!","lastname":"SURNAME OR LOCATOR / No DE APTO","search":"Search","noFound":"We could not find your keys","inputLastname":""},"remember":{"title":"Tell us the following information to remember your apartment","moment":"If you want to print a new key you must make a payment of € 15 for each one","tryAgain":"¡Let\'s try it again!","lastname":"LAST NAME - DATE CHECK - OUT","continue":"continue","noFound":"We could not find your keys"},"gratitudeothers":{"thanks":"THANK YOU FOR USING OUR SERVICE","footer":"For any questions or additional information:","footer1":"Call us at 7000 by pressing","phone":"Or through the"},"keyprintbasic":{"correctly":"The payment was processed correctly","remember":"Remember that your previous keys","disable":"have been disabled for security","print":"We are printing","apartment":"Your apartment is located in the","thkForReg":"Thanks for signing up","sendVoucher":"We have sent you the receipt","sendVoucher2":"payment via email","printingKeys":"We are printing your keys","waitMoment":"Please wait a moment"},"assessment":{"staying":"Thanks for staying in","invoice":"If you want to receive your invoice","confirm":"please confirm your email","waths":"What did you think of the stay?","valore":"Rate your experience with 10 being the highest"},"pendingpayments":{"pending":"Your pending payments","resumen":"Payment summary","concept":"Concept","cantid":"quantity","import":"amount","pendingpayment":"Pending payments","additional":"Additional keys","total":"TOTAL","iva":"IVA included","intro":"Please enter the credit card in the slot <br>to make the payment of your pending expenses"},"modalspenttime":{"title":"¡Time is running out! ","msg":"Touch the screen or button to continue","yes":"¡I\'m here!"},"modalchargererp":{"title":"¡Hey! ","errortpv":"To process your payment successfully","error":"An error occurred processing your payment","msg":"Please contact us, we will answer you shortly","contact":"Contact us by calling"},"keyRequest":{"Has":"You have inserted","llaves":"Keys","inserted":"Insert the remaining keys","costed":"The keys not inserted will have an additional cost of € 10 for each one","via":"Or call us via","insertll":"Insert key","noll":"I do not have more keys"},"flag":"/dist/images/png/uk.png"}';
        $data = json_decode($json, true);

        $translationResponse = $this->buildTranslations($data);

        foreach ($translationResponse as $tr) {

            $translation = \App\KeyTranslation::where('key', $tr['key'])->first();

            if (! $translation) {
                $translation = new \App\KeyTranslation();
                $translation->device_type_id = $deviceType->id;
                $translation->key = $tr['key'];
                $translation->save();
            }

            $translation->languages()->attach($language->id, ['translation' => $tr['translation']]);
        }

        $language = new \App\Language();
        $language->name = 'Frances';
        $language->iso = 'fr';
        $language->flag = 'languages/francia.png';
        $language->status = \App\Language::STATUS_ACTIVE;
        $language->order = 3;
        $language->save();

        $json = '{"message":{"castro":"castro Exclusive Residences","contact":"Contact","idioma":"Langue","continue":"Contacter","checkin":"Check - in","checkout":"Check - out","pPax":"p/pax","pNight":"p/nuit","pStay":"p/réservation","floor1":"Red de chausez| 1er étage| 2ème étage ","floor2":"3ème étage| 4ème étage| 5ème étage","floors":[{"floor":"Red de chausez"},{"floor":"1er étage"},{"floor":"2do étage"},{"floor":"3er étage"},{"floor":"4to étage"},{"floor":"5to étage"}]},"screensaver":{"touch":"Touche l\'écran pour continuer"},"welcome":{"bienvenido":"Bienvenu","residencias":"Exclusive Residences","castro":"castro","selecciona":"sélectionne la langue"},"selectoption":{"select":"sélectionne une option","others":"Autres"},"others":{"select":"sélectionne une option","others":"Autres","lostkeys":"J\'ai perdu mes clés","duplicatekeys":"copie des clefs","suggestions":"Suggestions","recorde":"N\'oubliez pas le numéro de l\'appartement"},"listreserve":{"reservation":"Réservation","yourReservation":"Votre réservation","locator":"Localizador","nPax":"Número de personnes","typeApt":"type d\'appartement","planApt":"plan d\'appartement","experience":"expérience","area":"surface","pPax":"p/pax","pNight":"p/nuit","pStay":"p/réservation","photos":"Photos de l\'appartement ","better":"améliorer ","modify":"modifier","skip":"omettre","save":"garder","bedrooms":"chambre| chambres","bathrooms":"salle de bain| salles de bain","changeExperienceTo":"changer votre expérience","forCost":"pour un prix de","adults":"adultes","children":"enfants","onlyroom":"Lorem ipsum dolor, ut wisi enim ad minim ve","aptReserved":"appartement réservé","knowApt":"Connaître l\'Appartement","noUpgradeApt":"Ne pas améliorer","noUpgradePlanApt":"Ne pas améliorer le type d\'appartement","notUpgradeExperience":"Ne pas améliorer la catégorie de l\'appartement","selectExperience":"Ne pas améliorer l\'expérience","selectPlan":"Sélectionne quelle expérience vous voulez vivre","descriptionApts":["Découvre Barcelone de différente manière, encourage-vous à profiter de notre merveilleux duplex","Appartements de deux chambres décorés avec l\'essence de la ville de Barcelone "," Plonge dans l\'atmosphère du dessin que nos appartements de 3 chambres vous offrent"],"descriptionExp":["L\'expérience BASIQUE offre des logements équipés pour le confort total, à tout moment de votre séjour vous pouvez ajouter d\'autres services complémentaires","Avec l\'expérience DELUXE, vous profiterez des appartements décorés avec toute l\'essence de la ville de Barcelone","Un séjour de rêve dans notre ville. Tous les services exclusifs : et beaucoup plus!"]},"checkin":{"title":"Pour commencer, indiquez-nous votre nom de famille ou localisateur de réservation","noFound":" nous n\'avons pas reussit à trouver votre réservation","tryAgain":"réessayer","lastname":"nom de famille ou un localisateur","search":"chercher","loading":"en cherchant la réservation"},"guests":{"title":"cordonées du client","adult":"adulte","child":"enfant","add":"ajouter un voyageur","edit":"editer"},"gratitude":{"support":"Votre appartement est situé dans le","thanks":"Merci de faire confiance à Castro Exclusive Résidence","wish":"¡Nous vous souhaitons un séjour extraordinaire!","checkin":"N’oubliez pas qu’au moment de votre check - out doit être avant","checkin1":"11:00 AM,","checkon":"Si vous souhaitez quitter l\'appartement plus tard contactez le service de","checkon1":"plus tard check out","luggage":"utilisez les casiers pour laisser vos bagages","footer":"Pour toutes questions ou informations supplémentaires:","footer1":"appellez nous au 7000 en appuyant sur","phone":"et profitez","contract":"Demandez dès à présent le service de tardif Check out","obtain":"et profitez","discount":"d’une réduction!","want_late":"Je veux profiter du tardif check out.","want":"Je veux profiter du "},"loading":{"title":"en train de charger","titleServices":"Services dont vous pourrez profiter lors de votre séjour"},"scan":{"child":"enfant","adult":"adulte","passport":"S\'il vous plaît scannez le passeport de l\'hôte","scan":"scanner","scanning":"scanner"},"contact":{"you":"Vous avez besoin d\'information additionnelle ?","problem":"¿Tienes inconvenientes con tu reserva?","call":"En appelant le número","contactus":"contactez nous","across":"ou à travers du"},"summary":{"concept":"concept","import":"Montant","select":"Sélectionnez votre appartement","pending":"pas encore payé","summarypayment":"récapitulatif du paiement","make":"effectuer le paiement","total":"total","free":"gratuit","tax":"taxe de séjour","choosed":"sélection d\'appartement","bedrooms":"chambre| chambres","bathrooms":"salle de bain| salles de bain","upgradeApt":"améliorer le type d\'appartement","upgradePlan":"Améliorer le Plan d\'appartement ","upgradeExperience":"Améliorer l\'Expérience","termns":"J\'accepte les conditions d\'utilisation","advise":"J\'accepte de recevoir des notifications, des avantages et des promotions","servics":"Services","correctPayment":"Paiement correct","errorSavePayment":"Une erreur s\'est produite lors du traitement de votre paiement","errorTpv":"Erreur lors du traitement du paiement par TPV","chargerERP":"Appeler à l\'aide","insertCard":"Veuillez entrer la carte de crédit <br> <span> dans l\'emplacement </ span> et suivez les instructions du PDV"},"numberapto":{"select":"Voulez-vous sélectionner le numéro d’appartement?","preference":"Vous pouvez sélectionner l\'appartement de votre choix","additional":"pour un coût supplémentaire de","cash":"20€","yes":"Si je veux!","no":"Non"},"earlycheck":{"cancel":"annuler","remember":"Recuerda que podrás acceder a tu apartamento a partir de las 16:00h, o entrar antes contratando Early Check - in","contract":"enregistrement anticipé","early":"acquérir un engresitrement anticipé"},"termsConditions":{"gree":"Vous avez accepté","terms":"Conditions d\'utilisation"},"notifications":{"receive":"Si vous n\'acceptez pas de recevoir des notifications, votre facture ne peut pas","email":"être envoyé à votre email","sure":"Êtes-vous sûr de ne pas vouloir accepter le reçu de notification?","yes":"oui","no":"non"},"keyPrinting":{"apartment":"Votre appartement est situé dans le","thkForReg":"Merci pour votre inscription","sendVoucher":"Nous vous avons envoyé le reçu","sendVoucher2":"de paiement par email","printingKeys":"Nous imprimons vos clés","waitMoment":"Veuillez patienter un instant","thanks":"MERCI D\'UTILISER NOTRE SERVICE","footer":"Pour toutes questions ou informations supplémentaires:","footer1":"appellez nous au 7000 en appuyant sur","phone":"O à travers"},"gueststay":{"stay":"nous espérons que vous avez passé un séjour extraordinaire avec nous","inserted":"Clés insérées","inserkeys":"Veuillez insérer toutes les clés <br> que nous vous fournissons dans le check-in","nopkeys":"Je n\'ai pas plus de clefs","inserborder":"Insérez une clé dans la fente pour vous identifier","staying":"¡Merci de rester dans"},"comments":{"email":"welcome@castroexclusiveresidences.com","submit":"Envoyer","send":"Ou envoyez-nous un email à","as":"Comment pouvons-nous améliorer?","tell":"Dites nous","sugges":"Vos suggestions sont très importantes pour","white":"Écrivez vos commentaires ici"},"alreadychecked":{"seems":"On dirait que vous avez déjà fait le check in avec votre téléphone!","set":"Continuer avec la configuration de  votre appartement","continue":"continuer","not":"Je ne me suis pas enregistré avec mon téléphone"},"someonechekin":{"seems":"Quelqu\'un de votre appartement a déjà fait le check-in!","set":"Veuillez accepter de dupliquer vos clés","continue":"Oui, quelqu\'un à dejà fait le check in","not":"Je n\'ai pas fait la check in"},"tipcheckout":{"happy":"Nous sommes heureux que vous soyez heureux!","fullHappy":"Si vous le souhaitez, vous pouvez donner à l\'équipe castro Exclusive Residences le conseil que vous considérez","perso":"Personnaliser","select":"Sélectionnez une option","not":"Ne donne pas de pourboire"},"TechnicalFailure":{"hey":"¡Hey!","moment":"Ocurrió una falla técnica","soon":"Por favor, intenta nuevamente","contactus":"Si tienes inconvenientes, contáctanos","slant":"Ou par","retry":"Reintentar"},"gratitudecheckout":{"thanks":"MERCI DE VIVRE L\'EXPÉRIENCE","finish":"finaliser"},"maintenance":{"sorry":"Excuse-nous","moment":"En ce moment nous sommes en réparation","soon":"Bientôt nous reviendrons!","contactus":"Contactez-nous en appelant le","slant":"Ou par"},"home":{"star":"Êtes-vous êtes sûr de vouloir revenir au début?","fact":"Tout ce que vous avez fait sera perdu!","yes":"Oui, je veux y retourner","no":"Je ne veux pas"},"selectApto":{"selectApt":"Sélectionnez l\'appartement de votre choix","topApto":"Votre appartement est situé dans le","sunny":"Ensoleillé toute la journée","seeCity":"Vue sur la ville","available":"Disponible","occupied":"Occupé","select":"Sélectionné","youSelect":"Votre choix","seePict":"Voir les photos","toAccept":"Accepter","Floor":"Étage"},"AddLateCheckout":{"notDateCheckOut":"Votre date de départ n\'est pas encore arrivé","dateIsday":"La date correcte est le jour","lateCheckOut":"Départ tardif","addLateCheckOut":"Avoir un départ tardif","cancel":"Annuler"},"ThanksShareGoogle":{"thankLifeExp":"MERCI DE VIVRE L\'EXPÉRIENCE","opinion":"POUR NOUS, VOTRE AVIS EST IMPORTANT!","yourCompanions":"Nous aimerions que vous et vos compagnons","assessInstance":"faite une valoration de votre séjour! Ça ne vous prendra pas longtemps!","assess":"Faire une valoration de votre séjour à","finalize":"finaliser"},"gridresults":{"results":"Résultats pour","select":"Sélectionnez votre réservation"},"problemskeys":{"keyFor":"Localisez une clé d\'urgence à l\'endroit indiqué dans l\'image","entrer":"Entrez le code de sécurité et prenez la clé de votre appartement","apto":"Votre appartement","floor":"floor","code":"Code de sécurité","problems":"¿Problèmes d\'impression de vos clés?"},"keysbasic":{"desactivekeys":"Vos clés précédentes ont été désactivées pour des raisons de sécurité","sorry":"Désolé pour le désagrément causé, vous n\'avez pas le service de duplication de clé","moment":"Si vous souhaitez imprimer une nouvelle clé, vous devez effectuer un paiement en {priceKey}€ pour chaque clé   ","nameKeys":"Número de clés","apartment":"Appartement","follow":"Vos clés précédentes resteront activées","print":"Imprimer"},"keysnobasic":{"desactivekeys":"Vos clés précédentes ont été désactivées pour des raisons de sécurité","sorry":"indícanos cuántas llaves de tu apartamento necesitarás","moment":"Si vous souhaitez imprimer une nouvelle clé, vous devez effectuer un paiement en {priceKey}€ pour chaque clé","nameKeys":"Número de clés","apartment":"Appartement","follow":"Vos clés précédentes resteront activées","print":"Imprimer","inserted":"Touches d\'impression"},"loskeys":{"title":"Dites-nous les informations suivantes pour obtenir de nouvelles clés","moment":"Si vous souhaitez imprimer une nouvelle clé, vous devez effectuer un paiement en {priceKey}€ pour chaque clé","tryAgain":"¡Essayons encore!","lastname":"nom de famille ou un localisateur / No DE APTO","search":"chercher","noFound":"Nous n\'avons pas trouvé vos clés","inputLastname":""},"remember":{"title":"Indícanos la siguiente información para recordar tu apartamento","moment":"Si vous souhaitez imprimer une nouvelle clé, vous devez effectuer un paiement en {priceKey}€ pour chaque clé","tryAgain":"¡Intentémoslo de nuevo!","lastname":" Nom de la réservation - date de départ","continue":"Contacter","noFound":"Nous n\'avons pas trouvé vos clés"},"gratitudeothers":{"thanks":"MERCI D\'UTILISER NOTRE SERVICE","footer":"Pour toutes questions ou informations supplémentaires:","footer1":"Contactez-nous en appelant le 7000","phone":"Ou par"},"keyprintbasic":{"correctly":"Paiement correct","remember":"Rappelez-vous que vos clés précédentes","disable":"han sido desactivadas por seguridad","print":"Nous imprimons vos clés","apartment":"Votre appartement est situé dans le","thkForReg":"Merci pour votre inscription","sendVoucher":"Nous vous avons envoyé le reçu","sendVoucher2":"de paiement par email","printingKeys":"Nous imprimons vos clés","waitMoment":"Veuillez patienter un instant"},"assessment":{"staying":"Merci d\'avoir séjourné dans les","invoice":"Si vous voulez recevoir votre facture","confirm":"veuillez confirmer votre email","waths":"¿Quest ce que vous avez pensé du votre séjour?","valore":"aluez votre expérience avec 10 étant le plus élevé"},"pendingpayments":{"pending":"les paiements en suspens","resumen":"récapitulatif du paiement","concept":"concept","cantid":"quantité","import":"Montant","pendingpayment":"Les paiements en suspens","additional":"Clés supplémentaires","total":"TOTAL","iva":"TVA incluse","intro":"Veuillez entrer la carte de crédit pour effectuer le paiement de vos dépenses en attente."},"modalspenttime":{"title":"¡Ce presque la fin du temps! ","msg":"Touchez l\'écran ou le bouton pour continuer","yes":"¡Je suis ici!"},"modalchargererp":{"title":"¡Hé! ","errortpv":"Pour traiter votre paiement avec succès","error":"Une erreur s\'est produite lors du traitement de votre paiement","msg":"S\'il vous plaît contactez-nous, nous vous répondrons sous peu","contact":"Contactez-nous par téléphone"},"keyRequest":{"Has":"Vous avez inséré","llaves":"clés","inserted":"insérer les clés restantes","costed":"les clés non insérées auront un coût supplémentaire de # pour chacune","via":"ou appelez-nous via","insertll":"insérer les clés","noll":"Je n\'ai pas plus de clefs"},"flag":"/dist/images/png/francia.png"}';
        $data = json_decode($json, true);

        $translationResponse = $this->buildTranslations($data);

        foreach ($translationResponse as $tr) {

            $translation = \App\KeyTranslation::where('key', $tr['key'])->first();

            if (! $translation) {
                $translation = new \App\KeyTranslation();
                $translation->device_type_id = $deviceType->id;
                $translation->key = $tr['key'];
                $translation->save();
            }

            $translation->languages()->attach($language->id, ['translation' => $tr['translation']]);
        }

        $language = new \App\Language();
        $language->name = 'Aleman';
        $language->iso = 'al';
        $language->flag = 'languages/alemania.png';
        $language->status = \App\Language::STATUS_ACTIVE;
        $language->order = 3;
        $language->save();

        $json = '{"message":{"castro":"castro Exclusive Residences","contact":"Kontakt","idioma":"Sprache","continue":"Fortsetzen","checkin":"Check - in","checkout":"Check - out","pPax":"p/pax","pNight":"p/nacht","pStay":"p/aufenthalt","floor1":"Etage 0 |1er Etage|2do Etage","floor2":"3er Stock|4to Stock|5to Stock","floors":[{"floor":"Erdgeschoss 0"},{"floor":"1er Stock"},{"floor":"2do Stock"},{"floor":"3er Stock"},{"floor":"4to Stock"},{"floor":"5to Stock"}]},"screensaver":{"touch":"Drücken Sie zum Fortfahren"},"welcome":{"bienvenido":"Willkommen bei","residencias":"Exclusive Residences","castro":"castro","selecciona":"Wählen Sie die Sprache"},"selectoption":{"select":"Wählen Sie eine Option","others":"Andere"},"others":{"select":"Bitte wählen Sie eine Option","others":"Andere","lostkeys":"Ich habe meine Schlüssel verloren","duplicatekeys":"Schlüssel Duplikat","suggestions":"Vorschläge","recorde":"Wohnungsnummer erinnern"},"listreserve":{"reservation":"Reservierung","yourReservation":"Ihre Reservierung","locator":"Reservierungsnummer","nPax":"Personenanzahl","typeApt":"Appartment Typ","planApt":"Grundrißplan","experience":"Bewertung","area":"Grundfläche","pPax":"p/pax","pNight":"p/Nacht","pStay":"p/Aufenthalt","photos":"Fotos des Appartments","better":"Verbessern","modify":"Verändern","skip":"Unterdrücken","save":"Speichern","bedrooms":"Schlafzimmer | Schlafzimmer","bathrooms":"Bad | Bäder","changeExperienceTo":"Ändere deine Erfahrung auf","forCost":"für einen Preis von","adults":"Erwachsene","children":"Kinder","onlyroom":"Lorem ipsum dolor, ut wisi enim ad minim ve","aptReserved":"Appartment reserviert","knowApt":"Kennt das Appartment","noUpgradeApt":"Das Appartment nicht verbessern","noUpgradePlanApt":"Das Appartment nicht verbessern","notUpgradeExperience":"Das Appartment nicht verbessern","selectExperience":"Wähle aus, was Du von dem Appartment erwatest","selectPlan":"Wähle aus, was Du von dem Appartment erwatest","descriptionApts":["Entdecke Barcelona auf eine andere Art und Weise, entdecke unsere fantastische Duplex","Ferienwohnungen mit 2 Schlafzimmern dekoriert damit Sie Barcelona total erleben","Tauche ein in unsere 3 Zimmer Designer Appartments"],"descriptionExp":["accommodations for maximum comfort, at any time during your stay you can hire other complementary services","Mit der Deluxe Austattung genießen Sie Barcelona total","Ein Aufenthalt, der keine Wünsche offen läßt und vieles mehr. Mit allen extra Leistungen inbegriffen"]},"checkin":{"title":"1er Schritt, geben Sie ihren Nachnamen oder Buchungsnummer ein","noFound":"Wir können Ihre Reservierung nicht finden","tryAgain":"Probieren wir es noch einmal!","lastname":"Nachname oder Buchungsnummer","search":"Suchen","loading":"Reservierungssuche"},"guests":{"title":"Gästeinformation","adult":"Erwachsene","child":"Kinder","add":"Gast hinzufügen","edit":"Anpassen"},"gratitude":{"support":"Ihre Wohnung befindet sich im","thanks":"Danke für Ihr Vertrauen in Castro Exclusive Residences","wish":"Wir wünschen Ihnen einen aussergewöhnlichen Aufenthalt","checkin":"Check-out vor","checkin1":"12 Uhr Mittags","checkon":"Wenn Sie nach 12 Uhr Mittags auschecken möchten, fragen Sie nach dem","checkon1":"Late Check - Out","luggage":"alternativ können Sie unsere Schliessfächer für Ihr Gepäck benutzen","footer":"Für Fragen oder zusätzliche Informationen","footer1":"Sie können uns unter der Nummer 7000 erreichen","phone":"oder unter folgender Nummer","contract":"Bitten Sie um Ihren Late Check-out","obtain":"Erhalten Sie Vergünstigungen","discount":"Rabatt","want_late":"Late Check - Out Bitten","want":"Ich möchte einstellen"},"loading":{"title":"Lädt","titleServices":"Leistungen die in Ihrem Aufenthalt inbegriffen sind"},"scan":{"child":"Kinder","adult":"Erwachsene","passport":"Bitte scannen Sie den Reisepass des Gästes","scan":"Scannen","scanning":"Scannen"},"contact":{"you":"Haben Sie Fragen oder brauchen Sie Hilfe?","problem":"Haben Sie Probleme mit Ihrer Reservierung?","call":"Rufen Sie an","contactus":"Erreichen Sie uns unter","across":"oder unter folgender Nummer <br>"},"summary":{"concept":"Konzept","import":"Betrag","select":"Wählen Sie das Appartment aus","pending":"Zahlung steht noch aus","summarypayment":"Zahlungsübersicht","make":"Mit der Zahlung fortfahren","total":"Insgesamt","free":"Umsonst","tax":"Stadtsteuern","choosed":"Appartment auswahl","bedrooms":"Schlafzimmer | Schlafzimmer","bathrooms":"Bad| Bäder","upgradeApt":"Das Appartment verbessern","upgradePlan":"Das Appartment verbessern","upgradeExperience":"Das Appartment verbessern","termns":"Ich akzeptiere die Nutzungsbedingungen","advise":"Ich stimme zu, Benachrichtigungen und Aktionen zu erhalten","servics":"Leistungen","correctPayment":"Zahlung korrekt verarbeitet","insertCard":"Bitte geben Sie die Kreditkarte ein und <span> in dem Slot </ span> und folgen Sie den Anweisungen des POS"},"numberapto":{"select":"Möchten Sie die Apartmentnummer auswählen?","preference":"Sie können das Apartment Ihrer Wahl auswählen","additional":"mit einer zusätslichen Gebühr von","cash":"20€","yes":"Ja, möchte ich","no":"No"},"earlycheck":{"cancel":"Abbrechen","remember":"00h, oder geben Sie vor der Einstellung ein Early Check - in ein","contract":"Frühes Einchecken","early":"früh einchecken"},"termsConditions":{"gree":"Aktezptieren","terms":"Nutzungsbedingungen"},"notifications":{"receive":"Wenn Sie nicht zustimmen Benachrichtigungen zu erhalten, kann Ihre Rechnung nicht","email":"an Ihre E-Mail gesendet werden","sure":"Sind Sie sicher, dass Sie keine Benachrichtungen erhalten wollen?","yes":"Ja","no":"Nein"},"keyPrinting":{"apartment":"Ihre Wohnung befindet sich in der","thkForReg":"Danke für die Anmeldung","sendVoucher":"Wir haben Ihnen die Quittung geschickt","sendVoucher2":"Zahlung per E-Mail","printingKeys":"Wir drucken Ihre Schlüssel","waitMoment":"Bitte warte einen Moment","thanks":"Wir bedanken uns dass Sie unseren Service benutzt haben","footer":"Für Fragen oder zusätsliche Information:","footer1":"Sie können uns unter der Nummer 7000 erreichen","phone":"oder unter folgender Nummer"},"gueststay":{"stay":"Wir hoffen das Sie einen schönen Aufenthalt bei uns hatten","inserted":"Eingefügte Tasten","inserkeys":"Por favor inserta todas las llaves<br>que te suministramos en el check-in","nopkeys":"Ich habe meine Schlüssel nicht","inserborder":"Stecken Sie einen Schlüssel in den Steckplatz, um sich zu identifizieren","staying":"¡Wir bedanken uns dafür dass Sie"},"comments":{"email":"welcome@castroexclusiveresidences.com","submit":"Senden","send":"Oder schicken Sie uns eine E-Mail an","as":"Wie können wir verbessern?","tell":"Teilen Sie mit uns mit","sugges":"Ihre Vorschläge sind sehr wichtig für","white":"Schreiben Sie Ihre Kommentare hier"},"alreadychecked":{"seems":"Es sieht so aus, als ob Sie schon per Handy eingecheckt haben!","set":"Setze deine Wohnung fort","continue":"Setze deine Wohnung fort","not":"Ich habe nicht per Handy eingecheckt"},"someonechekin":{"seems":"Jemand in Ihrem Appartment hat bereits eingechekt!","set":"Bitte stimmen Sie zu, Ihre Schlüssel zu kopieren","continue":"Ja, jemand hat bereits eingecheckt","not":"Ich habe nicht eingecheckt"},"tipcheckout":{"happy":"Wir freuen uns das es Ihnen gefallen hat","fullHappy":"Wenn Sie möchten können Sie dem Team von Castro Exclusive Residences Trinkgeld hinterlassen","perso":"Personalisieren","select":"Wählen Sie eine Option","not":"Kein Trinkgeld hinterlassen"},"TechnicalFailure":{"hey":"¡Hey!","moment":"Ein technischer Fehler ist aufgetreten","soon":"Versuchen Sie es erneut","contactus":"Sollten Sie Probleme haben, melden Sie sich bei uns","slant":"Oder durch","retry":"Erneut versuchen"},"gratitudecheckout":{"thanks":"Wir bedanken uns für Ihrer Erfahrung","finish":"beenden"},"maintenance":{"sorry":"Entschuldigen Sie","moment":"In diesem Moment sind wir in Wartung","soon":"Wir sind bald zurück","contactus":"Kontaktieren Sie uns, indem Sie anrufen","slant":"Oder durch"},"home":{"star":"Hey! Sind Sie sicher, dass Sie zurück zum Anfang gehen wollen?","fact":"Sie werden alle Fortschritte verlieren","yes":"Ja, ich möchte zurück","no":"Nein, ich möchte nicht"},"selectApto":{"selectApt":"Wählen Sie das Appartment Ihrer Wahl aus","topApto":"Ihre Wohnung befindet sich im","sunny":"Während des ganzen Tages sehr Sonnig","seeCity":"Mit Stadtaussicht","available":"Verfügbar","occupied":"Nicht verfügbar","select":"Ausgewählt","youSelect":"Ihre Auswahl","seePict":"Fotos ansehen","toAccept":"Aktezptieren","Floor":"Appartment"},"AddLateCheckout":{"notDateCheckOut":"Ihr Check-Out-Datum ist noch nicht erfüllt!","dateIsday":"Ihr entsprechendes Datum ist der Tag","lateCheckOut":"Late Check - out","addLateCheckOut":"Später Check - out","cancel":"Abbrechen"},"ThanksShareGoogle":{"thankLifeExp":"Wir bedanken uns für Ihrer Erfahrung","opinion":"IHRE MEINUNG IST UNS SEHR WICHTIG!","yourCompanions":"Wir würden es sehr Schätzen wenn Sie und Ihre Begleiter, Ihren aufenthalt bewerten würden","assessInstance":"Wert den Aufenthalt Es wird nicht viel Zeit brauchen!","assess":"Bewerten Sie Ihren Aufenthalt in","finalize":"beenden"},"gridresults":{"results":"Ergebnisse für","select":"Wählen Sie ihre Buchung aus"},"problemskeys":{"keyFor":"Finden Sie an der im Bild angegebenen Stelle einen Notfallschlüssel","entrer":"Geben Sie den Sicherheitscode ein und entfernen Sie einen Schlüssel aus Ihrer Wohnung","apto":"Ihre Wohnung","floor":"Stock","code":"Sicherheitscode","problems":"¿Probleme beim Drucken der Schlüssel?"},"keysbasic":{"desactivekeys":"Ihre vorherigen Schlüssel wurden aus Sicherheitsgründen <br> deaktiviert","sorry":"Wir entschuldigen uns für die verursachten Unannehmlichkeiten, doch Sie haben keinen","moment":"Wenn Sie einen neuen Schlüssel drucken möchten, hätte die einen Zuschlagpreis von {priceKey}€ por Schlüssel","nameKeys":"Anzahl der Schlüssel","apartment":"Appartments","follow":"Ihre bisherigen Schlüssel bleiben funktionsfähig","print":"drucken"},"keysnobasic":{"desactivekeys":"Ihre vorherigen Schlüssel wurden aus Sicherheitsgründen <br> deaktiviert","sorry":"Wir entschuldigen uns für die verursachten Unannehmlichkeiten, doch Sie haben keinen","moment":"Wenn Sie einen neuen Schlüssel drucken möchten, hätte die einen Zuschlagpreis von {priceKey}€ por Schlüssel","nameKeys":"Anzahl der Schlüssel","apartment":"Appartments","follow":"Ihre bisherigen Schlüssel bleiben funktionsfähig","print":"drucken","inserted":"Schlüssel drucken"},"loskeys":{"title":"Um neue Schlüssel zu erhalten, bräuchten wir folgende Information","moment":"Wenn Sie einen neuen Schlüssel drucken möchten, hätte die einen Zuschlagpreis von {priceKey}€ por Schlüssel","tryAgain":"¡Probieren wir es noch einmal!","lastname":"Nachname oder Buchungsnummer / Grundri","search":"Suchen","noFound":"Wir konnten Ihre Schlüssel nicht finden","inputLastname":""},"remember":{"title":"Um neue Schlüssel zu erhalten, bräuchten wir folgende Information","moment":"Wenn Sie einen neuen Schlüssel drucken möchten, hätte die einen Zuschlagpreis von {priceKey}€ por Schlüssel","tryAgain":"¡Probieren wir es noch einmal!","lastname":" Reservierungsname - check-out Datum","continue":"Fortsetzen","noFound":"Wir konnten Ihre Schlüssel nicht finden"},"gratitudeothers":{"thanks":"Wir bedanken uns dass Sie unseren Service benutzt haben","footer":"Für Fragen oder zusätsliche Information:","footer1":"Sie können uns unter der Nummer 7000 erreichen","phone":"Oder durch"},"keyprintbasic":{"correctly":"Zahlung korrekt verarbeitet","remember":"Denken Sie daran, dass Ihre vorherigen Schlüssel","disable":"wurden aus Sicherheitsgründen deaktiviert","print":"Wir drucken Ihre Schlüssel","apartment":"Ihre Wohnung befindet sich in","thkForReg":"Danke für die Anmeldung","sendVoucher":"Wir haben Ihnen die Quittung per E-mail geschickt","sendVoucher2":"Zahlung per E-Mail","printingKeys":"Wir drucken Ihre Schlüssel","waitMoment":"Bitte warte Sie einen Moment"},"assessment":{"staying":"Wir bedanken uns dafür dass Sie","invoice":"Wenn Sie Ihre Rechnung erhalten möcthen","confirm":"Bitte bestätigen Sie Ihre email Adresse","waths":"¿Was halten Sie über Ihren Aufenthalt?","valore":"Bewerten Sie Ihren Aufenthalt, wobei 10 die beste Note ist"},"pendingpayments":{"pending":"Ihre ausstehenden Zahlungen","resumen":"Zusammenfassung der Zahlungen","concept":"Konzept","cantid":"menge","import":"Betrag","pendingpayment":"Ausstehende Zahlungen","additional":"Zusätzliche Schlüssel","total":"Insgesamt","iva":"Inklusive MwSt.","intro":"Bitte geben Sie Ihre Kreditkarte ein,<br> um die ausstehenden Kosten aus zu gleichen"},"modalspenttime":{"title":"¡Die Zeit läuft ab! ","msg":"Berühren Sie den Bildschirm um fortzufahren","yes":"¡Hier bin ich!"},"modalchargererp":{"title":"¡Hey! ","errortpv":"Um Ihre Zahlung erfolgreich zu bearbeiten","error":"Bei der Verarbeitung Ihrer Zahlung ist ein Fehler aufgetreten","msg":"Por favor comunícate con nosotros, en breve te atenderemos","contact":"Kontaktieren Sie uns, indem Sie anrufen "},"keyRequest":{"Has":"Sie haben eingefügt","llaves":"Schlüssel","inserted":"Restliche Schlüssel einfügen","costed":"Die nicht eingefügten Schlüssel haben einen Zuschlagspreis von € pro Schlüssel","via":"Oder rufen Sie uns unter unter folgender Nummer an","insertll":"Schlüssel einfügen","noll":"Ich habe meine Schlüssel nicht"},"flag":"/dist/images/png/alemania.png"}';
        $data = json_decode($json, true);

        $translationResponse = $this->buildTranslations($data);

        foreach ($translationResponse as $tr) {

            $translation = \App\KeyTranslation::where('key', $tr['key'])->first();

            if (! $translation) {
                $translation = new \App\KeyTranslation();
                $translation->device_type_id = $deviceType->id;
                $translation->key = $tr['key'];
                $translation->save();
            }

            $translation->languages()->attach($language->id, ['translation' => $tr['translation']]);
        }
    }

    /**
     * Arma las claves de traducciones a partir de un json
     */
    private function buildTranslations($data, $k = '', $base = true)
    {
        $response = [];
        $currentKey = $k;

        foreach ($data as $key => $translation) {

            $currentTranslation = $translation;
            if (! is_int($key)) {
                $currentKey .= (empty($currentKey) ? $key : '.' . $key);
            }

            if (! is_array($translation)) {

                $response[] = [
                    'key' => $currentKey,
                    'translation' => $currentTranslation
                ];

                if ($base) {
                    $currentKey = '';
                } else {

                    $explode = explode('.', $currentKey);
                    unset($explode[ count($explode) - 1 ]);
                    $currentKey = implode('.', $explode);
                }
            } else {

                $responseRecursive = $this->buildTranslations($currentTranslation, $currentKey, false);

                foreach ($responseRecursive as $recursive) {
                    $response[] = $recursive;
                }
            }

            if ($base) {
                $currentKey = '';
            }
        }

        return $response;
    }
}
