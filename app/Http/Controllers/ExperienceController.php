<?php

namespace App\Http\Controllers;

use App\Handler\UpdateExperienceHandler;
use App\Handler\FindExperienceHandler;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ExperienceController extends Controller
{
    /**
     * Actualiza una experiencia
     *
     * @param Request $request
     * @param $experienceId
     * @return JsonResponse
     */
    public function update(Request $request, $experienceId)
    {
        $data = $request->all();
        $data['experienceId'] = $experienceId;

        $handler = new UpdateExperienceHandler($data);
        $handler->processHandler();

        if ($handler->isSuccess()) {
            return new JsonResponse($handler->getData());
        }

        return new JsonResponse($handler->getErrors(), $handler->getStatusCode());
    }

    /**
     * consulta una experiencia
     *
     * @param $experience_id
     * @return JsonResponse
     */
    public function find($experience_id)
    {
        $handler = new FindExperienceHandler(['experiencia_id' => $experience_id]);
        $handler->processHandler();

        if ($handler->isSuccess()) {
            return new JsonResponse($handler->getData());
        }

        return new JsonResponse($handler->getErrors(), $handler->getStatusCode());
    }
}
