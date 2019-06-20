<?php
namespace App\Handler\GeneralHandlers;

use App\Handler\BaseHandler;
use App\SearchHistory;

/**
 * Obtiene la busqueda mas frecuente
 *
 * @author Emilio Ochoa <emilioaor@gmail.com>
 */
class FindSearchFavoriteHandler extends BaseHandler {

    protected $cache = true;

    /**
     * Proceso de este handler
     */
    protected function handle()
    {
        // Obtengo las cantidades buscadas para adultos, niños y apartamentos
        $searchAdults = SearchHistory::query()->select(['adults'])->distinct()->get()->toArray();
        $searchKids = SearchHistory::query()->select(['kids'])->distinct()->get()->toArray();
        $searchApartments = SearchHistory::query()->select(['apartments'])->distinct()->get()->toArray();

        // Obtengo cantidad de adultos mas buscados
        $max = 0;
        $favoriteAdults = 0;
        foreach ($searchAdults as $adults) {
            $count = SearchHistory::query()->select(['id'])->where('adults', $adults['adults'])->count();

            if ($count > $max) {
                $max = $count;
                $favoriteAdults = $adults['adults'];
            }
        }

        // Obtengo cantidad de niños mas buscados
        $max = 0;
        $favoriteKids = 0;
        foreach ($searchKids as $kids) {
            $count = SearchHistory::query()->select(['id'])->where('kids', $kids['kids'])->count();

            if ($count > $max) {
                $max = $count;
                $favoriteKids = $kids['kids'];
            }
        }

        // Obtengo cantidad de apartamentos mas buscados
        $max = 0;
        $favoriteApartments = 0;
        foreach ($searchApartments as $apartments) {
            $count = SearchHistory::query()->select(['id'])->where('apartments', $apartments['apartments'])->count();

            if ($count > $max) {
                $max = $count;
                $favoriteApartments = $apartments['apartments'];
            }
        }

        return [
            'adults' => $favoriteAdults,
            'kids' => $favoriteKids,
            'apartments' => $favoriteApartments
        ];
    }

    /**
     * Reglas de validacion
     *
     * @return array
     */
    protected function validationRules()
    {
        return [];
    }

}