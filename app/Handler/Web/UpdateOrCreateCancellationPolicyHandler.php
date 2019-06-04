<?php
namespace App\Handler\Web;

use App\Handler\BaseHandler;
use Illuminate\Support\Facades\DB;
use App\CancellationPolicy;
use App\Location;
use App\Service\UploadImage;
use App\Service\UrlGenerator;

class UpdateOrCreateCancellationpolicyHandler extends BaseHandler
{
    /**
     * Proceso de este handler
     *
     * @return array
     */
    protected function handle()
    {
        DB::beginTransaction();

        $location = Location::where('ubicacion_id',$this->params['ubicacion_id'])->firstOrFail();
        $cancellation_policy_erp = CancellationPolicy::where('politica_cancelacion_id','=',$this->params['politica_cancelacion_id'])->where('type','=','erp')->first();
        $cancellation_policy = CancellationPolicy::where('politica_cancelacion_id','=',$this->params['politica_cancelacion_id'])->where('type','=','web')->first();

        if(! $cancellation_policy){
            $cancellation_policy = new CancellationPolicy();
        }

        $cancellation_policy->politica_cancelacion_id = $this->params['politica_cancelacion_id'];
        $cancellation_policy->type = 'web';
        $cancellation_policy->parent_id = $cancellation_policy_erp->id;
        $cancellation_policy->ubicacion_id = $this->params['ubicacion_id'];
        $cancellation_policy->nombre = $this->params['nombre'];
        $cancellation_policy->nombre_cliente = $this->params['nombre_cliente'];
        $cancellation_policy->incidencia_porcentaje = $this->params['incidencia_porcentaje'];
        $cancellation_policy->activo = $this->params['activo'];

        $front_image_name = $location->pais.'_'.$location->ciudad.'_cancellationPolicy_Image_';
        $icon_name = $location->pais.'_'.$location->ciudad.'_cancellationPolicy_Icon_';

        if (isset($this->params['front_image'])) {
            // Imagen
            $path = UploadImage::upload($this->params['front_image'], 'cancellationPolicy/',$front_image_name);

            $cancellation_policy->front_image = $path;
        }

        if (isset($this->params['icon'])) {
            // Icon
            $path = UploadImage::upload($this->params['icon'], 'cancellationPolicy/',$icon_name);

            $cancellation_policy->icon = $path;
        }

        $cancellation_policy->save();
        $cancellation_policy->updateFieldTranslations($this->params['fieldTranslations']);

        DB::commit();
        return [
            'res' => 1,
            'msg' => 'Operación exitosa',
            'data' => $cancellation_policy
        ];
    }

    /**
     * Reglas de validacion
     *
     * @return array
     */
    protected function validationRules()
    {
        return [
            'fieldTranslations' => 'required',
        ];
    }

}