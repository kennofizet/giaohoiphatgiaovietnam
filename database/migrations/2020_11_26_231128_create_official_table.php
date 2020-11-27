<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOfficialTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('official', function (Blueprint $table) {
            $table->id();
            $table->longText('name');
            $table->longText('card_number')->nullable();
            $table->longText('photo_profile')->nullable();
            $table->longText('alias')->nullable();
            $table->longText('category')->nullable();
            $table->longText('date_of_birth')->nullable();
            $table->longText('cmnd')->nullable();
            $table->longText('position')->nullable();
            $table->longText('address')->nullable();
            $table->longText('qr_code')->nullable();
            $table->longText('slug');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('official');
    }
}
