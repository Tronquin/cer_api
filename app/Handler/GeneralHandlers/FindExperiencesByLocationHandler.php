<?php
namespace App\Handler\GeneralHandlers;

use App\Handler\BaseHandler;
use App\Experience;
use App\Galery;
use App\Extra;
use App\Location;
use App\Photo;
use App\Service\UrlGenerator;

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
            ->with([
                'child',
                'extras.child.experiences',
                'extras.experiences',
                'apartamentos.child',
                'extras_experiences_not_included',

                'child.extras.child.experiences',
                'child.extras.experiences',
                'child.apartamentos.child',
                'child.extras_experiences_not_included',
            ])
            ->orderBy('experiencia_id')
            ->get();

        $extraIdsAll = [];
        foreach ($experiencesCollection as $expErp) {
            foreach ($expErp->extras as $extraErp) {
                $extraIdsAll[] = $extraErp->id;
            }
        }

        //All Extras Not Included that are of type 'ERP' associated to that Ubication 
        $extraNotIncluded = Extra::where('type', 'erp')->with(['child'])->get();

        foreach ($experiencesCollection as  $expErp) {

            $webOrErp =  $expErp->child ?  $expErp->child->toArray() : $expErp->toArray();

            if ($webOrErp['front_page']) {
                $webOrErp['front_page'] = UrlGenerator::generate('storage.image', ['image' => str_replace('/', '-',  $webOrErp['front_page'])]);
            }

            $extraIds = [];
            $available = [];
            foreach ($expErp->extras as  $extraErp) {

                $temp =  $extraErp->child ?  $extraErp->child->toArray() : $extraErp->toArray();

                $temp['front_image'] =  $temp['front_image'] ? UrlGenerator::generate('storage.image', ['image' => str_replace('/', '-',  $temp['front_image'])]) : null;
                $temp['icon'] =  $temp['icon'] ? UrlGenerator::generate('storage.image', ['image' => str_replace('/', '-',  $temp['icon'])]) : null;

                $activo = false;
                foreach ($extraErp->experiences as $exp) {
                    if ($expErp->id === $exp->id) {
                        $activo = $exp->pivot->is_published;
                        break;
                    }
                }
                $temp['activo'] =  $activo;

                $available[] =  $temp;
                $extraIds[] =  $temp['id'];
            }

            $noAvailable = [];
            foreach ($extraNotIncluded as  $extraNot) {
                $temp =  $extraNot->child ?  $extraNot->child->toArray() : $extraNot->toArray();
                if (!in_array($temp['id'],  $extraIds)) {
                    $temp['front_image'] =  $temp['front_image'] ? UrlGenerator::generate('storage.image', ['image' => str_replace('/', '-',  $temp['front_image'])]) : null;
                    $temp['icon'] =  $temp['icon'] ? UrlGenerator::generate('storage.image', ['image' => str_replace('/', '-',  $temp['icon'])]) : null;
                    $temp['activo'] = false;
                    foreach ($expErp->extras_experiences_not_included as $noInclude) {
                        if ($noInclude->id === $temp['id']) {
                            $temp['activo'] = true;
                            break;
                        }
                    }

                    if ((isset($this->params['admin_call']) && $this->params['admin_call']) || $temp['activo']) {
                        $noAvailable[] =  $temp;
                    }
                }
            }

            unset($webOrErp['extras']);
            $webOrErp['extras']['disponibles'] =  $available;
            $webOrErp['extras']['no_disponibles'] =  $noAvailable;

            $aparments = [];
            foreach ($expErp->apartamentos as  $aparmentErp) {
                $aparments[] =  $aparmentErp->child ?  $aparmentErp->child->toArray() : $aparmentErp->toArray();
            }

            unset($webOrErp['apartamentos']);
            $webOrErp['apartamentos'] =  $aparments;

            $experiences[] =  $webOrErp;
        }

        $response['res'] = count($experiences);
        $response['msg'] = 'experiencias de la ubicacion: ' .  $ubicacionId;
        $response['data'] =  $experiences;

        return  $response;
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
