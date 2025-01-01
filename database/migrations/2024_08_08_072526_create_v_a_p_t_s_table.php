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
        Schema::create('v_a_p_t_s', function (Blueprint $table) {
            $table->id();
            $table->string('ticket_no')->unique();
            $table->string('Client_name')->nullable();
            $table->string('updatation_data')->nullable();
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
        Schema::dropIfExists('v_a_p_t_s');
    }
};
