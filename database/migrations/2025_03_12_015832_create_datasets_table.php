<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('datasets', function (Blueprint $table) {
            $table->id();
            $table->string('nama_puskesmas');
            $table->integer('dokter_asn')->default(0);
            $table->integer('dokter_non_asn')->default(0);
            $table->integer('perawat_asn')->default(0);
            $table->integer('perawat_non_asn')->default(0);
            $table->integer('bidan_asn')->default(0);
            $table->integer('bidan_non_asn')->default(0);
            $table->integer('sanitarian_asn')->default(0);
            $table->integer('sanitarian_non_asn')->default(0);
            $table->integer('ahli_gizi_asn')->default(0);
            $table->integer('ahli_gizi_non_asn')->default(0);
            $table->integer('tenaga_asn')->default(0);
            $table->integer('tenaga_non_asn')->default(0);
            $table->integer('non_tenaga_asn')->default(0);
            $table->integer('non_tenaga_non_asn')->default(0);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('datasets');
    }
};
