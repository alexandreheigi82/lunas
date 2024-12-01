<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Package extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'packages';

    protected $fillable = [
        'titulo',
        'descricao',
        'valor',
        'vagas',
        'imagem',
        'link',
        'categoria',
        'tipo',
        'situacao',
    ];

    protected $dates = ['deleted_at'];

    public function sales() { return $this->hasMany(Sale::class); }
}
