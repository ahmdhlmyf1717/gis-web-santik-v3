<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dataset;

class PuskesmasController extends Controller
{
    public function getPuskesmasData($namaPuskesmas)
    {
        $data = Dataset::where('nama_puskesmas', $namaPuskesmas)->first();

        if (!$data) {
            return response()->json(['error' => 'Data tidak ditemukan'], 404);
        }

        return response()->json([
            'title' => $data->nama_puskesmas,
            'data' => [
                'Dokter' => [
                    'ASN' => $data->dokter_asn,
                    'Non-ASN' => $data->dokter_non_asn
                ],
                'Perawat' => [
                    'ASN' => $data->perawat_asn,
                    'Non-ASN' => $data->perawat_non_asn
                ],
                'Bidan' => [
                    'ASN' => $data->bidan_asn,
                    'Non-ASN' => $data->bidan_non_asn
                ],
                'Sanitarian' => [
                    'ASN' => $data->sanitarian_asn,
                    'Non-ASN' => $data->sanitarian_non_asn
                ],
                'Ahli Gizi' => [
                    'ASN' => $data->ahli_gizi_asn,
                    'Non-ASN' => $data->ahli_gizi_non_asn
                ],
                'Tenaga Kesehatan' => [
                    'ASN' => $data->tenaga_asn,
                    'Non-ASN' => $data->tenaga_non_asn
                ],
                'Non-Tenaga Kesehatan' => [
                    'ASN' => $data->non_tenaga_asn,
                    'Non-ASN' => $data->non_tenaga_non_asn
                ]
            ]
        ]);
    }
}
