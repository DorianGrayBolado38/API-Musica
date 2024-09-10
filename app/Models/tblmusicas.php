<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tblmusicas extends Model
{
    use HasFactory;
    protected $primaryKey = 'codigo';
    
    protected $fillable = [
        'nomeMusica',
        'generoMusica',
        'albumMusica',
    ];
}
