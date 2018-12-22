<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FixKeyTranslations extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $keyTranslation = \App\KeyTranslation::query()->where('key', 'layouts.navbar.pau')->first();

        foreach ($keyTranslation->languages as $language) {
            if ($language->iso === 'es') {
                $language->pivot->translation = 'Sant Pau';
                $language->pivot->save();
            }
        }

        $device = \App\DeviceType::query()->where('code', 'web')->first();
        $languages = \App\Language::all();

        $key = new \App\KeyTranslation();
        $key->key = 'pages.register.field.error.name.required';
        $key->device_type_id = $device->id;
        $key->save();

        foreach ($languages as $language) {
            $key->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? 'El campo nombre es obligatorio' : ''
            ]);
        }

        $key = new \App\KeyTranslation();
        $key->key = 'pages.register.field.error.last_name.required';
        $key->device_type_id = $device->id;
        $key->save();

        foreach ($languages as $language) {
            $key->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? 'El campo apellido es obligatorio' : ''
            ]);
        }

        $key = new \App\KeyTranslation();
        $key->key = 'pages.register.field.error.email.required';
        $key->device_type_id = $device->id;
        $key->save();

        foreach ($languages as $language) {
            $key->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? 'El campo correo electrónico es obligatorio' : ''
            ]);
        }

        $key = new \App\KeyTranslation();
        $key->key = 'pages.register.field.error.email.format';
        $key->device_type_id = $device->id;
        $key->save();

        foreach ($languages as $language) {
            $key->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? 'El formato es invalido' : ''
            ]);
        }

        $key = new \App\KeyTranslation();
        $key->key = 'pages.register.field.error.phone.required';
        $key->device_type_id = $device->id;
        $key->save();

        foreach ($languages as $language) {
            $key->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? 'El campo teléfono es obligatorio' : ''
            ]);
        }

        $key = new \App\KeyTranslation();
        $key->key = 'pages.register.field.error.password.required';
        $key->device_type_id = $device->id;
        $key->save();

        foreach ($languages as $language) {
            $key->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? 'El campo contraseña es obligatorio' : ''
            ]);
        }

        $key = new \App\KeyTranslation();
        $key->key = 'pages.register.field.error.password.min';
        $key->device_type_id = $device->id;
        $key->save();

        foreach ($languages as $language) {
            $key->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? 'Minimo :min: caracteres' : ''
            ]);
        }

        $key = new \App\KeyTranslation();
        $key->key = 'pages.register.field.error.password.confirmation';
        $key->device_type_id = $device->id;
        $key->save();

        foreach ($languages as $language) {
            $key->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? 'Contraseña no coincide' : ''
            ]);
        }

        $key = new \App\KeyTranslation();
        $key->key = 'layouts.navbar.field.error.email.required';
        $key->device_type_id = $device->id;
        $key->save();

        foreach ($languages as $language) {
            $key->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? 'Correo electrónico obligatorio' : ''
            ]);
        }

        $key = new \App\KeyTranslation();
        $key->key = 'layouts.navbar.field.error.email.format';
        $key->device_type_id = $device->id;
        $key->save();

        foreach ($languages as $language) {
            $key->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? 'Formato invalido' : ''
            ]);
        }

        $key = new \App\KeyTranslation();
        $key->key = 'layouts.navbar.field.error.password.required';
        $key->device_type_id = $device->id;
        $key->save();

        foreach ($languages as $language) {
            $key->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? 'Contraseña obligatoria' : ''
            ]);
        }

        $key = new \App\KeyTranslation();
        $key->key = 'layouts.navbar.loginFail';
        $key->device_type_id = $device->id;
        $key->save();

        foreach ($languages as $language) {
            $key->languages()->attach($language->id, [
                'translation' => $language->iso === 'es' ? 'Usuario o contraseña incorrecta' : ''
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
        //
    }
}
