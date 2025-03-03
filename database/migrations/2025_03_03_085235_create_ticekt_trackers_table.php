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
        Schema::create('ticekt_trackers', function (Blueprint $table) {
            $table->id();
            $table->string('subject')->default('');
            $table->string('description')->default('');
            $table->string('assign_by')->default(0);
            $table->string('assign_to')->default(0);
            $table->date('assign_date')->nullable();
            $table->date('submit_date')->nullable();
            $table->string('status')->default('P');//p = pending
            $table->string('is_delete')->default(0);
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
        Schema::dropIfExists('ticekt_trackers');
    }
};
