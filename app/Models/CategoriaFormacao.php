<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoriaFormacao extends Model
{
    use HasFactory;

    protected $table = "categoria_formacao";

    protected $fillable = [
        'nome',
    ];
}
