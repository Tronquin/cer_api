<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Imagen extends Model
{
    /** Categorias */
    const CATEGORY_ERP = 'erp';
    const CATEGORY_GENERAL = 'general';
    const CATEGORY_ICON = 'icon';
    const CATEGORY_LOGO = 'logo';

    protected $table = 'imagenes';

    protected $fillable = [
        'slug',
        'url',
    ];
}
