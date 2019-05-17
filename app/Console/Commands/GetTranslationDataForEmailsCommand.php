<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use App\Service\EmailsTranslationsGetData;


class GetTranslationDataForEmailsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'get:TranslationsEmails';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Actualiza los archivos lang/iso/emails en la api para el envio de correo multi-idioma';

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
        $response = EmailsTranslationsGetData::getData();
        Log::info('Servicio Ejecutado!');
    }
}
