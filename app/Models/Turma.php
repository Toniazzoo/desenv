<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Turma extends Model
{
    use HasFactory;

    protected $table = "turma";

    protected $fillable = [
        'nome',
        'professor_id',
        'curso_id',
        'codigo',
        'data_inicio',
        'data_fim',
    ];

    protected $cast =[
        'professor_id' => 'integer',
        'curso_id' => 'integer',
        'date_inicio' => 'date',
        'date_fim' => 'date',
    ];

    public function professor(){
        return $this->belongsTo(Professor::class, 'professor_id');
    }

    public function curso(){
        return $this->belongsTo(Curso::class, 'curso_id');
    }
}

