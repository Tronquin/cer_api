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
        $language = [];

        $language[0] = new \App\Language();
        $language[0]->name = 'Español';
        $language[0]->iso = 'es';
        $language[0]->flag = '';
        $language[0]->status = \App\Language::STATUS_ACTIVE;
        $language[0]->order = 1;
        $language[0]->save();

        $language[1] = new \App\Language();
        $language[1]->name = 'English';
        $language[1]->iso = 'en';
        $language[1]->flag = '';
        $language[1]->status = \App\Language::STATUS_ACTIVE;
        $language[1]->order = 2;
        $language[1]->save();

        foreach ($deviceTypes as $deviceType) {

            for ($x = 0; $x < 10; $x++) {

                $translation = new \App\KeyTranslation();
                $translation->device_type_id = $deviceType->id;
                $translation->key = 'key.device.' . $deviceType->code . '.' . ($x+1);
                $translation->save();

                foreach ($language as $lang) {

                    $translation->languages()->attach($lang, [
                        'translation' => 'translation.' . $lang->iso . '.device.' . $deviceType->code . '.' . ($x+1)
                    ]);
                }
            }
        }
    }
}
