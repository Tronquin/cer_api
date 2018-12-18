<?php

namespace App\Http\Controllers;

use App\KeyTranslation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;

class DefaultController extends Controller
{
    /**
     * Obtiene el csv para las traducciones
     */
    public function excel()
    {
        $path = 'excel/' . uniqid() . '.xls';
        $storagePath = storage_path('app/public/' . $path);

        $keyTranslations = KeyTranslation::with(['languages'])->get();

        Storage::disk('public')->put($path, view('excel', compact('keyTranslations')));

        return Response::download($storagePath, 'translations.xls', [
            'Content-Type', 'application/excel; charset=utf-8'
        ]);
    }
}
