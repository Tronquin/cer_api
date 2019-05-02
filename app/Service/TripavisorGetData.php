<?php
namespace App\Service;

use App\FieldTranslation;
use App\Tripavisor;
use App\Language;
use Illuminate\Support\Facades\Storage;

class TripavisorGetData {

    /**
     * Guarda la data en la tabla tripavisor
     *
     * @param $data
     * @return array
     */
    public static function getData()
    {
        /**
         * Llenamos la tabla
         */
        $tripavisorData = [
            [
                'autor' => 'Familia Morey',
                'descripcion' => 'We where there whole family and I can fully recommend this place'
            ],
            [
                'autor' => 'Suzanne H',
                'descripcion' => 'Beautiful Modern Apartment - Roomy, comfortable and so clean!'
            ],
            [
                'autor' => 'PaulaAT',
                'descripcion' => 'Our stay has been unbeatable, we have spent an ideal family vacation.'
            ],
            [
                'autor' => 'XanA B',
                'descripcion' => 'Lovely apartments for couples and families alike. Attentive at all times, and a perfect location to live'
            ],
            [
                'autor' => 'Miguel G',
                'descripcion' => 'The apartments are very large and spacious, and their decoration is exquisite, modern and cozy ...'
            ],
            [
                'autor' => 'Michael D',
                'descripcion' => 'Perfect location, well furnished apartments. Useful to have the kitchenette and lounge area, as well as sleeping five.'
            ],
            [
                'autor' => 'MLR172014',
                'descripcion' => 'Huge apartment. We were 4 and had an apartment big enough for 6. Great kitchen equipment if you wanted to cook and extremely comfortable beds. Very clean.'
            ],
            [
                'autor' => 'kjohn2015',
                'descripcion' => 'Recently had a trip with family to this wonderful city,Check in was made easier as we checked in with the sister apartments Right in the centre of the city and near all the buzz Lovely rooms although beds for children small and creaked Great location and highly recommend for families.'
            ],
            [
                'autor' => 'fiesta30',
                'descripcion' => 'Here with 6 adults and stayed on 5th floor room 5.1. Facilities excellent rooms emaculate. Price is well worth it. Would stay again ...'
            ],
            [
                'autor' => 'Alfadhly',
                'descripcion' => 'Great location, very comfortable bed, I loved how friendly the staff could not do enough for us, smoking in the room, kitchen ❤ ️ is very large and u what you need to find, good for the family.'
            ],
        ];
        $findtripavisor = Tripavisor::query()->delete();
        $findTranslation = FieldTranslation::query()->where('content_type',Tripavisor::class)->delete();
        $languages = Language::all();

        foreach ($tripavisorData as $data){

            $tripavisor = new Tripavisor();
            $tripavisor->autor = $data['autor'];
            $tripavisor->status = 1;
            $tripavisor->save();

            foreach ($languages as $language) {

                $translation = FieldTranslation::where('content_id', $tripavisor->id)
                    ->where('content_type', Tripavisor::class)
                    ->where('field', 'description')
                    ->where('language_id', $language['id'])
                    ->firstOrNew([]);
    
                $trans = '';
                if ($language->iso === 'en') {
                    $trans = $data['descripcion'];
                } elseif (! empty($data['descripcion'])) {
                    $trans = TranslationService::trans($data['descripcion'], 'en', $language['iso'])['text'][0];
                }
    
                $translation->content_id = $tripavisor->id;
                $translation->content_type = Tripavisor::class;
                $translation->language_id = $language['id'];
                $translation->field = 'description';
                $translation->translation = $trans;
                $translation->save();
            }
        }

        return 'do it';
    }

}