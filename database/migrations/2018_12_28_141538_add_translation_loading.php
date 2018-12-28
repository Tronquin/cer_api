<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTranslationLoading extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $device = \App\DeviceType::query()->where('code', 'web')->first();
        $languages = \App\Language::all();

        $keyTranslation = new \App\KeyTranslation();
        $keyTranslation->device_type_id = $device->id;
        $keyTranslation->key = 'components.modals.loading';
        $keyTranslation->save();

        foreach ($languages as $language) {
            $keyTranslation->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? 'Cargando' : ''
            ]);
        }


        $keyTranslation = new App\KeyTranslation();
        $keyTranslation->key = 'pages.customizestay.index.titlePersonStay';
        $keyTranslation->device_type_id = $device->id;
        $keyTranslation->save();

        foreach ($languages as $language) {
            $keyTranslation->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? 'Personaliza tu estancia' : ''
            ]);
        }

        $keyTranslation = new App\KeyTranslation();
        $keyTranslation->key = 'pages.customizestay.index.general';
        $keyTranslation->device_type_id = $device->id;
        $keyTranslation->save();

        foreach ($languages as $language) {
            $keyTranslation->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? 'Generales' : ''
            ]);
        }

        $keyTranslation = new App\KeyTranslation();
        $keyTranslation->key = 'pages.customizestay.index.habitacion';
        $keyTranslation->device_type_id = $device->id;
        $keyTranslation->save();

        foreach ($languages as $language) {
            $keyTranslation->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? 'Habitación' : ''
            ]);
        }

        $keyTranslation = new App\KeyTranslation();
        $keyTranslation->key = 'pages.customizestay.index.bat';
        $keyTranslation->device_type_id = $device->id;
        $keyTranslation->save();

        foreach ($languages as $language) {
            $keyTranslation->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? 'Baño' : ''
            ]);
        }

        $keyTranslation = new App\KeyTranslation();
        $keyTranslation->key = 'pages.customizestay.index.cocina';
        $keyTranslation->device_type_id = $device->id;
        $keyTranslation->save();

        foreach ($languages as $language) {
            $keyTranslation->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? 'Cocina' : ''
            ]);
        }

        $keyTranslation = new App\KeyTranslation();
        $keyTranslation->key = 'pages.customizestay.index.salon';
        $keyTranslation->device_type_id = $device->id;
        $keyTranslation->save();

        foreach ($languages as $language) {
            $keyTranslation->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? 'Salón' : ''
            ]);
        }

        $keyTranslation = new App\KeyTranslation();
        $keyTranslation->key = 'pages.customizestay.index.out';
        $keyTranslation->device_type_id = $device->id;
        $keyTranslation->save();

        foreach ($languages as $language) {
            $keyTranslation->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? 'Outdoors' : ''
            ]);
        }

        $keyTranslation = new App\KeyTranslation();
        $keyTranslation->key = 'pages.customizestay.index.concept';
        $keyTranslation->device_type_id = $device->id;
        $keyTranslation->save();

        foreach ($languages as $language) {
            $keyTranslation->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? 'concepto' : ''
            ]);
        }

        $keyTranslation = new App\KeyTranslation();
        $keyTranslation->key = 'pages.customizestay.index.amount';
        $keyTranslation->device_type_id = $device->id;
        $keyTranslation->save();

        foreach ($languages as $language) {
            $keyTranslation->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? 'Importe' : ''
            ]);
        }

        $keyTranslation = new App\KeyTranslation();
        $keyTranslation->key = 'pages.customizestay.index.paymmentPend';
        $keyTranslation->device_type_id = $device->id;
        $keyTranslation->save();

        foreach ($languages as $language) {
            $keyTranslation->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? 'Pagos pendientes' : ''
            ]);
        }

        $keyTranslation = new App\KeyTranslation();
        $keyTranslation->key = 'pages.customizestay.index.subtotal';
        $keyTranslation->device_type_id = $device->id;
        $keyTranslation->save();

        foreach ($languages as $language) {
            $keyTranslation->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? 'SUBTOTAL' : ''
            ]);
        }

        $keyTranslation = new App\KeyTranslation();
        $keyTranslation->key = 'pages.customizestay.index.iva';
        $keyTranslation->device_type_id = $device->id;
        $keyTranslation->save();

        foreach ($languages as $language) {
            $keyTranslation->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? 'IVA' : ''
            ]);
        }

        $keyTranslation = new App\KeyTranslation();
        $keyTranslation->key = 'pages.customizestay.index.total';
        $keyTranslation->device_type_id = $device->id;
        $keyTranslation->save();

        foreach ($languages as $language) {
            $keyTranslation->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? 'TOTAL' : ''
            ]);
        }

        $keyTranslation = new App\KeyTranslation();
        $keyTranslation->key = 'pages.customizestay.index.paymmet';
        $keyTranslation->device_type_id = $device->id;
        $keyTranslation->save();

        foreach ($languages as $language) {
            $keyTranslation->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? 'Pagar' : ''
            ]);
        }

        $keyTranslation = new App\KeyTranslation();
        $keyTranslation->key = 'components.customizeGeneral.StayGeneral.portan';
        $keyTranslation->device_type_id = $device->id;
        $keyTranslation->save();

        foreach ($languages as $language) {
            $keyTranslation->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? 'Por tan solo' : ''
            ]);
        }

        $keyTranslation = new App\KeyTranslation();
        $keyTranslation->key = 'components.customizeGeneral.StayGeneral.free';
        $keyTranslation->device_type_id = $device->id;
        $keyTranslation->save();

        foreach ($languages as $language) {
            $keyTranslation->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? 'GRATIS' : ''
            ]);
        }

        $keyTranslation = new App\KeyTranslation();
        $keyTranslation->key = 'components.modals.PaymmentReserve';
        $keyTranslation->device_type_id = $device->id;
        $keyTranslation->save();

        foreach ($languages as $language) {
            $keyTranslation->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? 'El pago de tu reserva se realizó con éxito' : ''
            ]);
        }

        $keyTranslation = new App\KeyTranslation();
        $keyTranslation->key = 'components.modals.PaymmentReserve';
        $keyTranslation->device_type_id = $device->id;
        $keyTranslation->save();

        foreach ($languages as $language) {
            $keyTranslation->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? 'Le hemos enviado el comprobante y confirmación de pago a su correo electrónico' : ''
            ]);
        }

        $keyTranslation = new App\KeyTranslation();
        $keyTranslation->key = 'components.modals.PaymmentReserve';
        $keyTranslation->device_type_id = $device->id;
        $keyTranslation->save();

        foreach ($languages as $language) {
            $keyTranslation->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? 'CHECK-IN' : ''
            ]);
        }

        $keyTranslation = new App\KeyTranslation();
        $keyTranslation->key = 'components.modals.PaymmentReserve';
        $keyTranslation->device_type_id = $device->id;
        $keyTranslation->save();

        foreach ($languages as $language) {
            $keyTranslation->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? 'CHECK-OUT' : ''
            ]);
        }

        $keyTranslation = new App\KeyTranslation();
        $keyTranslation->key = 'components.modals.PaymmentReserve.nombre';
        $keyTranslation->device_type_id = $device->id;
        $keyTranslation->save();

        foreach ($languages as $language) {
            $keyTranslation->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? 'Nombre' : ''
            ]);
        }

        $keyTranslation = new App\KeyTranslation();
        $keyTranslation->key = 'components.modals.PaymmentReserve.regimen';
        $keyTranslation->device_type_id = $device->id;
        $keyTranslation->save();

        foreach ($languages as $language) {
            $keyTranslation->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? 'Régimen' : ''
            ]);
        }

        $keyTranslation = new App\KeyTranslation();
        $keyTranslation->key = 'components.customizeGeneral.StayGeneral.polit';
        $keyTranslation->device_type_id = $device->id;
        $keyTranslation->save();

        foreach ($languages as $language) {
            $keyTranslation->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? 'Política de cancelación' : ''
            ]);
        }

        $keyTranslation = new App\KeyTranslation();
        $keyTranslation->key = 'components.modals.PaymmentReserve.adult';
        $keyTranslation->device_type_id = $device->id;
        $keyTranslation->save();

        foreach ($languages as $language) {
            $keyTranslation->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? 'No° de Adultos' : ''
            ]);
        }

        $keyTranslation = new App\KeyTranslation();
        $keyTranslation->key = 'components.modals.PaymmentReserve.nin';
        $keyTranslation->device_type_id = $device->id;
        $keyTranslation->save();

        foreach ($languages as $language) {
            $keyTranslation->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? 'No° de Niños' : ''
            ]);
        }

        $keyTranslation = new App\KeyTranslation();
        $keyTranslation->key = 'components.modals.PaymmentReserve.night';
        $keyTranslation->device_type_id = $device->id;
        $keyTranslation->save();

        foreach ($languages as $language) {
            $keyTranslation->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? 'No° de noches' : ''
            ]);
        }

        $keyTranslation = new App\KeyTranslation();
        $keyTranslation->key = 'components.modals.PaymmentReserve.basic';
        $keyTranslation->device_type_id = $device->id;
        $keyTranslation->save();

        foreach ($languages as $language) {
            $keyTranslation->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? 'Experiencia BASIC' : ''
            ]);
        }

        $keyTranslation = new App\KeyTranslation();
        $keyTranslation->key = 'components.modals.PaymmentReserve.extras';
        $keyTranslation->device_type_id = $device->id;
        $keyTranslation->save();

        foreach ($languages as $language) {
            $keyTranslation->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? 'Servicios y/o extras seleccionados' : ''
            ]);
        }

        $keyTranslation = new App\KeyTranslation();
        $keyTranslation->key = 'components.modals.PaymmentReserve.thanks';
        $keyTranslation->device_type_id = $device->id;
        $keyTranslation->save();

        foreach ($languages as $language) {
            $keyTranslation->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? '¡Gracias por reservar en' : ''
            ]);
        }

        $keyTranslation = new App\KeyTranslation();
        $keyTranslation->key = 'components.modals.PaymmentReserve.castro';
        $keyTranslation->device_type_id = $device->id;
        $keyTranslation->save();

        foreach ($languages as $language) {
            $keyTranslation->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? 'castroexclusiveresidences.com!' : ''
            ]);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $keyTranslation = \App\KeyTranslation::query()->where('key', 'components.modals.loading')->first();
        \Illuminate\Support\Facades\DB::table('language_translation')->where('key_translation_id', $keyTranslation->id)->delete();
        $keyTranslation->delete();

        $keyTranslation = \App\KeyTranslation::where('key', 'pages.customizestay.index.titlePersonStay')->first();
        \Illuminate\Support\Facades\DB::table('language_translation')->where('key_translation_id', $keyTranslation->id)->delete();
        $keyTranslation->delete();

        $keyTranslation = \App\KeyTranslation::where('key', 'pages.customizestay.index.general')->first();
        \Illuminate\Support\Facades\DB::table('language_translation')->where('key_translation_id', $keyTranslation->id)->delete();
        $keyTranslation->delete();

        $keyTranslation = \App\KeyTranslation::where('key', 'pages.customizestay.index.habitacion')->first();
        \Illuminate\Support\Facades\DB::table('language_translation')->where('key_translation_id', $keyTranslation->id)->delete();
        $keyTranslation->delete();

        $keyTranslation = \App\KeyTranslation::where('key', 'pages.customizestay.index.bat')->first();
        \Illuminate\Support\Facades\DB::table('language_translation')->where('key_translation_id', $keyTranslation->id)->delete();
        $keyTranslation->delete();

        $keyTranslation = \App\KeyTranslation::where('key', 'pages.customizestay.index.cocina')->first();
        \Illuminate\Support\Facades\DB::table('language_translation')->where('key_translation_id', $keyTranslation->id)->delete();
        $keyTranslation->delete();

        $keyTranslation = \App\KeyTranslation::where('key', 'pages.customizestay.index.salon')->first();
        \Illuminate\Support\Facades\DB::table('language_translation')->where('key_translation_id', $keyTranslation->id)->delete();
        $keyTranslation->delete();

        $keyTranslation = \App\KeyTranslation::where('key', 'pages.customizestay.index.out')->first();
        \Illuminate\Support\Facades\DB::table('language_translation')->where('key_translation_id', $keyTranslation->id)->delete();
        $keyTranslation->delete();

        $keyTranslation = \App\KeyTranslation::where('key', 'pages.customizestay.index.concept')->first();
        \Illuminate\Support\Facades\DB::table('language_translation')->where('key_translation_id', $keyTranslation->id)->delete();
        $keyTranslation->delete();

        $keyTranslation = \App\KeyTranslation::where('key', 'pages.customizestay.index.amount')->first();
        \Illuminate\Support\Facades\DB::table('language_translation')->where('key_translation_id', $keyTranslation->id)->delete();
        $keyTranslation->delete();

        $keyTranslation = \App\KeyTranslation::where('key', 'pages.customizestay.index.paymmentPend')->first();
        \Illuminate\Support\Facades\DB::table('language_translation')->where('key_translation_id', $keyTranslation->id)->delete();
        $keyTranslation->delete();

        $keyTranslation = \App\KeyTranslation::where('key', 'pages.customizestay.index.subtotal')->first();
        \Illuminate\Support\Facades\DB::table('language_translation')->where('key_translation_id', $keyTranslation->id)->delete();
        $keyTranslation->delete();

        $keyTranslation = \App\KeyTranslation::where('key', 'pages.customizestay.index.iva')->first();
        \Illuminate\Support\Facades\DB::table('language_translation')->where('key_translation_id', $keyTranslation->id)->delete();
        $keyTranslation->delete();

        $keyTranslation = \App\KeyTranslation::where('key', 'pages.customizestay.index.total')->first();
        \Illuminate\Support\Facades\DB::table('language_translation')->where('key_translation_id', $keyTranslation->id)->delete();
        $keyTranslation->delete();

        $keyTranslation = \App\KeyTranslation::where('key', 'pages.customizestay.index.paymmet')->first();
        \Illuminate\Support\Facades\DB::table('language_translation')->where('key_translation_id', $keyTranslation->id)->delete();
        $keyTranslation->delete();

        $keyTranslation = \App\KeyTranslation::where('key', 'components.customizeGeneral.StayGeneral.portan')->first();
        \Illuminate\Support\Facades\DB::table('language_translation')->where('key_translation_id', $keyTranslation->id)->delete();
        $keyTranslation->delete();

        $keyTranslation = \App\KeyTranslation::where('key', 'components.customizeGeneral.StayGeneral.free')->first();
        \Illuminate\Support\Facades\DB::table('language_translation')->where('key_translation_id', $keyTranslation->id)->delete();
        $keyTranslation->delete();

        $keyTranslation = \App\KeyTranslation::where('key', 'components.modals.PaymmentReserve')->first();
        \Illuminate\Support\Facades\DB::table('language_translation')->where('key_translation_id', $keyTranslation->id)->delete();
        $keyTranslation->delete();

        $keyTranslation = \App\KeyTranslation::where('key', 'components.modals.PaymmentReserve')->first();
        \Illuminate\Support\Facades\DB::table('language_translation')->where('key_translation_id', $keyTranslation->id)->delete();
        $keyTranslation->delete();

        $keyTranslation = \App\KeyTranslation::where('key', 'components.modals.PaymmentReserve')->first();
        \Illuminate\Support\Facades\DB::table('language_translation')->where('key_translation_id', $keyTranslation->id)->delete();
        $keyTranslation->delete();

        $keyTranslation = \App\KeyTranslation::where('key', 'components.modals.PaymmentReserve')->first();
        \Illuminate\Support\Facades\DB::table('language_translation')->where('key_translation_id', $keyTranslation->id)->delete();
        $keyTranslation->delete();

        $keyTranslation = \App\KeyTranslation::where('key', 'components.modals.PaymmentReserve.nombre')->first();
        \Illuminate\Support\Facades\DB::table('language_translation')->where('key_translation_id', $keyTranslation->id)->delete();
        $keyTranslation->delete();

        $keyTranslation = \App\KeyTranslation::where('key', 'components.modals.PaymmentReserve.regimen')->first();
        \Illuminate\Support\Facades\DB::table('language_translation')->where('key_translation_id', $keyTranslation->id)->delete();
        $keyTranslation->delete();

        $keyTranslation = \App\KeyTranslation::where('key', 'components.customizeGeneral.StayGeneral.polit')->first();
        \Illuminate\Support\Facades\DB::table('language_translation')->where('key_translation_id', $keyTranslation->id)->delete();
        $keyTranslation->delete();

        $keyTranslation = \App\KeyTranslation::where('key', 'components.modals.PaymmentReserve.adult')->first();
        \Illuminate\Support\Facades\DB::table('language_translation')->where('key_translation_id', $keyTranslation->id)->delete();
        $keyTranslation->delete();

        $keyTranslation = \App\KeyTranslation::where('key', 'components.modals.PaymmentReserve.nin')->first();
        \Illuminate\Support\Facades\DB::table('language_translation')->where('key_translation_id', $keyTranslation->id)->delete();
        $keyTranslation->delete();

        $keyTranslation = \App\KeyTranslation::where('key', 'components.modals.PaymmentReserve.night')->first();
        \Illuminate\Support\Facades\DB::table('language_translation')->where('key_translation_id', $keyTranslation->id)->delete();
        $keyTranslation->delete();

        $keyTranslation = \App\KeyTranslation::where('key', 'components.modals.PaymmentReserve.basic')->first();
        \Illuminate\Support\Facades\DB::table('language_translation')->where('key_translation_id', $keyTranslation->id)->delete();
        $keyTranslation->delete();

        $keyTranslation = \App\KeyTranslation::where('key', 'components.modals.PaymmentReserve.extras')->first();
        \Illuminate\Support\Facades\DB::table('language_translation')->where('key_translation_id', $keyTranslation->id)->delete();
        $keyTranslation->delete();

        $keyTranslation = \App\KeyTranslation::where('key', 'components.modals.PaymmentReserve.thanks')->first();
        \Illuminate\Support\Facades\DB::table('language_translation')->where('key_translation_id', $keyTranslation->id)->delete();
        $keyTranslation->delete();

        $keyTranslation = \App\KeyTranslation::where('key', 'components.modals.PaymmentReserve.castro')->first();
        \Illuminate\Support\Facades\DB::table('language_translation')->where('key_translation_id', $keyTranslation->id)->delete();
        $keyTranslation->delete();
    }
}
