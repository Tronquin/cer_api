<?php
namespace App\Service;

use App\MachineLog;

/**
 * Servicio para registrar los a las maquinas
 *
 * @author Emilio Ochoa <emilioaor@gmail.com>
 */
class MachineLogService
{
    /**
     * Registra un log a la maquina
     *
     * @param int $machine
     * @param string $content
     */
    public static function log($machine, $content)
    {
        $log = new MachineLog();
        $log->machine_id = $machine;
        $log->content = $content;
        $log->save();
    }

    /**
     * Registra un log a la maquina. Identifica la maquina
     * por medio del token
     *
     * @param int $machine
     * @param string $content
     */
    public static function logByToken($token, $content)
    {
       /* $log = new MachineLog();
        $log->machine_id = $machine;
        $log->content = $content;
        $log->save();*/
    }
}