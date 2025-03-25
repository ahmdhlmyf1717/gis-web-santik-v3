<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('cagar_alam', function (Blueprint $table) {
            $table->dropColumn(['latitude', 'longitude']);
        });
    }

    public function down()
    {
        Schema::table('cagar_alam', function (Blueprint $table) {
            $table->decimal('latitude', 10, 6)->nullable();
            $table->decimal('longitude', 10, 6)->nullable();
        });
    }
};
