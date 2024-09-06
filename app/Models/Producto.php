<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_cat',
        'pro_name',
        'pro_descripcion',
        'pro_avatar',
        'pro_link',
    ];
    public function Categoria()
    {
        return $this->belongsTo('App\Models\Categoria', 'id_cat');
    }

}
