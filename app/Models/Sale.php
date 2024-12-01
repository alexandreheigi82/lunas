<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    protected $fillable = [
        'client_id',
        'user_id',
        'package_id',
        'quantidade'
    ];

    // Relacionamentos
    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id', 'users_tabela');
    }

    public function package()
    {
        return $this->belongsTo(Package::class);
    }
}
