<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('road_map_data', function (Blueprint $table) {
            $table->id();
            $table->string('trip_id');
            $table->string('from_place');
            $table->string('to_place');
            $table->string('by_transport');
            $table->string('descrip');
            $table->string('time_taken')->default(0);
            $table->string('created_by');
            $table->string('updated_by')->default(0);
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
        Schema::dropIfExists('road_map_data');
    }
};
