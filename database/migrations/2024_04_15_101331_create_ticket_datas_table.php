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
        Schema::create('ticket_datas', function (Blueprint $table) {
            $table->id();
            $table->string('ticket_no')->unique();
            $table->string('ticket_sub')->nullable();
            $table->string('ticket_description')->nullable();
            $table->string('receive_from')->nullable();
            $table->string('forword_to')->nullable();
            $table->date('start_date');
            $table->date('End_date');
            $table->string('user_id')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('ticket_datas');
    }
};
