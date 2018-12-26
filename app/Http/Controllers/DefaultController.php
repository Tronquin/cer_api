<?php

namespace App\Http\Controllers;


use App\Exports\KeyTranslationExport;
use App\Imports\KeyTranslationImport;
use App\KeyTranslation;
use App\Language;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class DefaultController extends Controller
{
    /**
     * Obtiene el csv para las traducciones
     */
    public function excel($device = null)
    {
        return Excel::download(new KeyTranslationExport($device), 'translations.xlsx');
    }

    /**
     * Carga un nuevo idioma
     */
    public function importTranslation(Request $request)
    {
        DB::beginTransaction();

        $language = new Language();
        $language->name = $request->name;
        $language->iso = $request->iso;
        $language->order = 1;
        $language->status = Language::STATUS_ACTIVE;
        $language->flag = $this->uploadImage($request->flag, 'languages/', str_slug($request->iso));
        $language->save();

        $base64 = $request->file;
        $base64 = str_replace('data:application/vnd.openxmlformats-officedocument.spreadsheetml.sheet;base64,', '', $base64);

        $path = 'test/' . uniqid() . '.xlsx';
        Storage::disk('public')->put($path, base64_decode($base64));

        $data = Excel::toArray(new KeyTranslationImport, $path, 'public');

        foreach ($data as $keys) {
            foreach ($keys as $keyAndTranslation) {

                $keyInstance = KeyTranslation::query()->where('key', $keyAndTranslation[0])->first();

                if ($keyInstance && isset($keyAndTranslation[1])) {

                    $language->keyTranslations()->attach($keyInstance->id, ['translation' => $keyAndTranslation[1]]);
                }
            }
        }

        DB::commit();

        return new JsonResponse(['res' => 1, 'msg' => 'Idioma Cargado', 'data' => $language]);
    }

    /**
     * Carga una imagen
     *
     * @param string $base64
     * @param string $folder
     * @param string|null $filename
     * @return string
     */
    private function uploadImage($base64, $folder, $filename = null)
    {
        $base64 = explode(',', $base64);
        $upload = base64_decode($base64[1]);
        $extension = str_replace('image/png', '', $base64[0]) !== $base64[0] ? '.png' : '.jpg';

        if (! $filename) {
            $filename = uniqid();
        }

        $filename = $filename . $extension;
        $path = $folder . $filename;

        Storage::disk('public')->put($path, $upload);

        return $path;
    }
}
