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
        $deviceTypes = \App\DeviceType::all();

        $language = new \App\Language();
        $language->name = 'Español';
        $language->iso = 'es';
        $language->flag = '';
        $language->status = \App\Language::STATUS_ACTIVE;
        $language->order = 1;
        $language->save();

        foreach ($deviceTypes as $deviceType) {

            for ($x = 0; $x < 10; $x++) {

                $translation = new \App\KeyTranslation();
                $translation->device_type_id = $deviceType->id;
                $translation->key = 'key.' . $language->iso . '.device.' . $deviceType->code . '.' . ($x+1);
                $translation->save();

                $translation->languages()->attach($language, [
                    'translation' => 'translation.' . $language->iso . '.device.' . $deviceType->code . '.' . ($x+1)
                ]);
            }
        }

        $language = new \App\Language();
        $language->name = 'English';
        $language->iso = 'en';
        $language->flag = '';
        $language->status = \App\Language::STATUS_ACTIVE;
        $language->order = 2;
        $language->save();

        foreach ($deviceTypes as $deviceType) {

            for ($x = 0; $x < 10; $x++) {

                $translation = new \App\KeyTranslation();
                $translation->device_type_id = $deviceType->id;
                $translation->key = 'key.' . $language->iso . '.device.' . $deviceType->code . '.' . ($x+1);
                $translation->save();

                $translation->languages()->attach($language, [
                    'translation' => 'translation.' . $language->iso . '.device.' . $deviceType->code . '.' . ($x+1)
                ]);
            }
        }
    }
}
