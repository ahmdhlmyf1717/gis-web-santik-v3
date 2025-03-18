<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dataset extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_puskesmas',
        'dokter_asn',
        'dokter_non_asn',
        'perawat_asn',
        'perawat_non_asn',
        'bidan_asn',
        'bidan_non_asn',
        'sanitarian_asn',
        'sanitarian_non_asn',
        'ahli_gizi_asn',
        'ahli_gizi_non_asn',
        'tenaga_asn',
        'tenaga_non_asn',
        'non_tenaga_asn',
        'non_tenaga_non_asn',
    ];
}
