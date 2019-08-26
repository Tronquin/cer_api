<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class ImageWebp extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cer:image:webp';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Convierte las imagenes optimizadas en formato webp';

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
        $this->info('Convirtiendo imagenes a formato webp');

        $path = storage_path('app/public/');
        $images = [];
        $locate = "locate '{$path}'";
        $this->info($locate);
        exec($locate, $images);

        foreach ($images as $image) {
            $explode = explode('/', $image);
            $lastPartUrl = last($explode);

            $nameAndFormat = explode('.', $lastPartUrl);

            if (count($nameAndFormat) === 2 && ! empty($nameAndFormat[0]) && ! empty($nameAndFormat[1])) {
                // Comprueba si tiene nombre y formato, en este caso se asume que es una imagen

                $currentPath = $image;
                $newPath = str_replace('/public/', '/webp/', $image); // Cambio la carpeta

                $dir = str_replace($lastPartUrl, '', $newPath);
                $dirRelative = str_replace(storage_path('app/'), '', $dir);

                $newPath = str_replace(".{$nameAndFormat[1]}", '.webp', $newPath); // Cambio el formato

                if (! file_exists($dir)) {
                    Storage::makeDirectory($dirRelative);
                }

                if (file_exists($currentPath) && ! file_exists($newPath)) {

                    $this->info('DESDE: ' . $currentPath);
                    $this->info('HASTA: ' . $newPath);

                    $response = '';
                    exec("cwebp -q 80 '{$currentPath}' -o '{$newPath}'", $response);

                    $this->info('COMPLETO!!');
                    $this->info('--------------------------------------------------');
                }
            }
        }


    }
}
