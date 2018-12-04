<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use App\Service\ERPGetData;


class GetDataFromErpCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'get:Data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Actualizacion de version ERP de la BD';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $response = ERPGetData::getData();
        Log::info('Servicio Ejecutado!');
    }
}
