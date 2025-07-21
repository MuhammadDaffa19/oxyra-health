<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFavoriteCitiesTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('favorite_cities', function (Blueprint $table) {
            $table->id();

            // Relasi ke user yang menyimpan favorit
            $table->foreignId('user_id')->constrained()->onDelete('cascade');

            // Informasi lokasi kota
            $table->string('city_name');
            $table->string('state')->nullable();
            $table->string('country');
            $table->string('country_code', 2);
            $table->string('flag', 10)->nullable();

            // Koordinat lokasi
            $table->decimal('lat', 10, 6);
            $table->decimal('lng', 10, 6);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('favorite_cities');
    }
}
