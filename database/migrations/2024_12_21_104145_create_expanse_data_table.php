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
        Schema::create('expanse_data', function (Blueprint $table) {
            $table->id();
            $table->string('trip_id')->nullable();
            $table->string('user_id')->nullable();
            $table->string('expanse_name')->nullable();
            $table->string('expanse_amount')->nullable();
            $table->string('desc')->nullable();
            $table->string('include_all')->default(0);
            $table->string('date');
            $table->string('added_by')->nullable();
            $table->string('update_by')->nullable();
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
        Schema::dropIfExists('expanse_data');
    }
};
