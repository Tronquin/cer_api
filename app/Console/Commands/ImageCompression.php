<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class ImageCompression extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'image:compression';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Compress all Images on the Storage Directory Using the ShortPixel Php library';

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
     * Recursively traverses all subfolders from a given directory search for images
     * @param array
     * @return array 
     */
    public function getImagesFromDirectory($dir, &$results = array())
    {
        $files = scandir($dir);

        foreach ($files as $key => $value) {
            $path = realpath($dir . DIRECTORY_SEPARATOR . $value);
            if (!is_dir($path)) {
                $results[] = $path;
            } else if ($value != "." && $value != "..") {
                $this->getImagesFromDirectory($path, $results);
                $results[] = glob($path . '*.{jpg,png,gif}', GLOB_BRACE);
            }
        }

        return array_values($this->cleanArray(array_filter($results)));
    }

    /**
     * Cleans array from unwanted file formats, .gitignore and .shortpixel paths
     * @param array
     * @return array
     */
    public function cleanArray($arr)
    {
        foreach ($arr as $key => $value) {
            $info = pathinfo($value);
            if ($info["extension"] == "pdf" || $info["extension"] == "xlsx" || $info["extension"] == "gitignore" || $info["extension"] == "shortpixel") {
                unset($arr[$key]);
            }
        }

        return array_values($arr);
    }

    /**
     * Gets Parent Folder Path 
     * @param string
     * @return string
     */
    public function getParentFolderPath($string)
    {
        $explode = explode('/', $string);
        unset($explode[count($explode) - 1]);
        $string = implode('/', $explode);

        return $string;
    }
    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        if (!getenv("SHORTPIXEL_KEY")) {
            exit("Set the SHORTPIXEL_KEY environment variable.\n");
        }
        \ShortPixel\ShortPixel::setOptions(array(
            "lossy" => 1, // 1 - lossy, 2 - glossy, 0 - lossless
            "keep_exif" => 0, // 1 - EXIF is preserved, 0 - EXIF is removed
            "resize" => 0, // 0 - don't resize, 1 - outer resize, 3 - inner resize
            "resize_width" => null, // in pixels. null means no resize
            "resize_height" => null, // in pixels. null means no resize
            "cmyk2rgb" => 1, // convert CMYK to RGB: 1 yes, 0 no
            "convertto" => "", // if '+webp' then also the WebP version will be generated
            // **** return options ****
            "notify_me" => null, // should contain full URL of of notification script (notify.php) - to be implemented
            "wait" => 30, // seconds
            // **** local options ****
            "total_wait" => 30, //seconds
            "base_url" => null, // base url of the images - used to generate the path for toFile by extracting from original URL and using the remaining path as relative path to base_path
            "base_source_path" => "", // base path of the local files
            "base_path" => false, // base path to save the files
            "backup_path" => false, // backup path, relative to the optimization folder (base_source_path)
            // **** persist options ****
            "persist_type" => "text", // null - don't persist, otherwise "text" (.shortpixel text file in each folder), "exif" (mark in the EXIF that the image has been optimized) or "mysql" (to be implemented)
            "persist_name" => ".shortpixel"
        ));
        \ShortPixel\setKey(env("SHORTPIXEL_KEY", "O4rvdcTTXBPbPM70xWtI"));

        $storagePath  = Storage::disk('public')->getDriver()->getAdapter()->getPathPrefix();
        $optimizedPath = storage_path('app/optimized') . '/';
        $publicImagesPath = $this->getImagesFromDirectory($storagePath);
        $optimizedPaths = [];
        foreach ($publicImagesPath as $key => $value) {
            $optimizedImagePath = str_replace($storagePath, $optimizedPath, $value);
            if (!file_exists($optimizedImagePath)) {
                $optimizedFolder = $this->getParentFolderPath($optimizedImagePath);
                $optimizedPaths[] = [
                    'original' => $value, //Original Path in Public
                    'optimized' => $optimizedFolder //Optimized Destiny folder Path 
                ];
            }
        }

        $this->info('Pending Image: ' . count($optimizedPaths));
        foreach ($optimizedPaths as $key => $value) {
            $this->info('Image number ' . $key . ' to Compress: ' . $value['original']);
            $this->info('Image Compressed to route: ' . $value['optimized']);
            $this->info('--------------------------');
            \ShortPixel\fromFile($value['original'])->wait(300)->toFiles($value['optimized']);
        }

        $this->info('All Images have been Optimized Successfully');
    }
}
