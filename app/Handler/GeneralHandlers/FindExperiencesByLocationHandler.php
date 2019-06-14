<?php
namespace App\Handler\GeneralHandlers;

use App\Handler\BaseHandler;
use App\Experience;
use App\Galery;
use App\Extra;
use App\Location;
use App\Photo;
use App\Service\UrlGenerator;
use function GuzzleHttp\json_decode;
use function GuzzleHttp\json_encode;

class FindExperiencesByLocationHandler extends BaseHandler
{

    /**
     * Proceso de este handler
     */
    protected function handle()
    {
        $response = [];
        $experiences = [];
        $ubicacionId = $this->params['ubicacion_id'];

        if (is_null($ubicacionId)) {
            // Obtengo las experiencias de la ubicacion predeterminada
            $location = Location::query()->whereRaw('default_experience = true')->first();
            $ubicacionId = $location->ubicacion_id;
        }

        $experiencesCollection = Experience::where('ubicacion_id', $ubicacionId)
            ->where('type', 'erp')
            ->with(['child', 'extras', 'apartamentos'])
            ->orderBy('experiencia_id')
            ->get();

        $extraIdsAll = [];
        foreach ($experiencesCollection as $expErp) {
            foreach ($expErp->extras as $extraErp) {
                $extraIdsAll[] = $extraErp->id;
            }
        }
        //Extras Not Included associated to an EXPERIENCE
        // $extraNotIncluded = Extra::where('ubicacion_id', $ubicacionId)->where('type', 'erp')->whereIn('id', $extraIdsAll)->with(['child'])->get();

<<<<<<< HEAD
        //All Extras Not Included that are of type 'ERP' associated to that Ubication 
        $extraNotIncluded = Extra::where('ubicacion_id', $ubicacionId)->where('type', 'erp')->with(['child'])->get();
=======
        //$extraNotIncluded = Extra::where('ubicacion_id', $ubicacionId)->where('type', 'erp')->whereIn('id', $extraIdsAll)->with(['child'])->get();
        $extraNotIncluded = Extra::query()->whereIn('id', [1, 2, 17, 18])->get();
>>>>>>> 4221501b14104d20cadc43101a3e33966f3dcd90

        foreach ($experiencesCollection as $expErp) {

            $webOrErp = $expErp->child ? $expErp->child->toArray() : $expErp->toArray();

            if ($webOrErp['front_page']) {
                $webOrErp['front_page'] = UrlGenerator::generate('storage.image', ['image' => str_replace('/', '-', $webOrErp['front_page'])]);
            }

            $extraIds = [];
            $available = [];
            foreach ($expErp->extras as $extraErp) {

                $temp = $extraErp->child ? $extraErp->child->toArray() : $extraErp->toArray();

                $temp['front_image'] = $temp['front_image'] ? UrlGenerator::generate('storage.image', ['image' => str_replace('/', '-', $temp['front_image'])]) : null;
                $temp['icon'] = $temp['icon'] ? UrlGenerator::generate('storage.image', ['image' => str_replace('/', '-', $temp['icon'])]) : null;

                $temp['fieldTranslations'] = $extraErp->child ? $extraErp->child->fieldTranslations() : $extraErp->fieldTranslations();
                $activo = $extraErp->experiences()->find($expErp->id);
                $activo = $activo->pivot->is_published;
                $temp['activo'] = $activo;

                $available[] = $temp;
                $extraIds[] = $temp['id'];
            }

            $noAvailable = [];
            foreach ($extraNotIncluded as $extraNot) {
                $temp = $extraNot->child ? $extraNot->child->toArray() : $extraNot->toArray();
                //if (!in_array($temp['id'], $extraIds)) {
                    $temp['front_image'] = $temp['front_image'] ? UrlGenerator::generate('storage.image', ['image' => str_replace('/', '-', $temp['front_image'])]) : null;
                    $temp['icon'] = $temp['icon'] ? UrlGenerator::generate('storage.image', ['image' => str_replace('/', '-', $temp['icon'])]) : null;
                    $temp['fieldTranslations'] = $extraNot->child ? $extraNot->child->fieldTranslations() : $extraNot->fieldTranslations();
                    //$temp['activo'] = (bool)$expErp->extras_experiences_not_included()->where('extras.id', $temp['id'])->count() > 0;
                    $temp['activo'] = true;

                    $noAvailable[] = $temp;
                //}
            }


            unset($webOrErp['extras']);
            $webOrErp['extras']['disponibles'] = $available;
            $webOrErp['extras']['no_disponibles'] = $noAvailable;

            $aparments = [];
            foreach ($expErp->apartamentos as $aparmentErp) {
                $aparments[] = $aparmentErp->child ? $aparmentErp->child->toArray() : $aparmentErp->toArray();
            }

            unset($webOrErp['apartamentos']);
            $webOrErp['apartamentos'] = $aparments;

            $webOrErp['fieldTranslations'] = $expErp->child ? $expErp->child->fieldTranslations() : $expErp->fieldTranslations();

            $experiences[] = $webOrErp;
        }

        $response['res'] = count($experiences);
        $response['msg'] = 'experiencias de la ubicacion: ' . $ubicacionId;
        $response['data'] = $experiences;

        return $response;
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
