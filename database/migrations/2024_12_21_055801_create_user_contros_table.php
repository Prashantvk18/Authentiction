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
        Schema::create('user_contros', function (Blueprint $table) {
            $table->id();
            $table->string('user_id')->nullable();
            $table->string('trip_id')->nullable();
            $table->string('contro_amount')->default(0);
            $table->string('contro_name')->nullable();
            $table->string('to_user')->default(0);
            $table->string('split')->default(0);
            $table->string('added_by')->nullable();
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
        Schema::dropIfExists('user_contros');
    }
};
