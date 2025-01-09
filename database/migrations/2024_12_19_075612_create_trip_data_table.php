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
        Schema::create('trip_data', function (Blueprint $table) {
            $table->id();
            $table->string('trip_name')->nullable();
            $table->string('final_expanse')->default(0);
            $table->date('start_date');
            $table->date('End_date');
            $table->string('submit_roadmap')->default(0);
            $table->string('is_delete')->nullable();
            $table->string('created_by')->nullable();
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
        Schema::dropIfExists('trip_data');
    }
};
