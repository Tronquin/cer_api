<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use App\Service\TripavisorGetData;


class GetDataTripavisorCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'get:Tripavisor';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Llena la tabla tripavisor con datos para mostrarse en la web';

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
        $response = TripavisorGetData::getData();
        Log::info('Servicio Ejecutado!');
    }
}
