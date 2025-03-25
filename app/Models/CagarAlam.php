<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CagarAlam extends Model
{
    use HasFactory;

    protected $table = 'cagar_alam';

    protected $fillable = ['nama', 'deskripsi', 'foto'];
}
