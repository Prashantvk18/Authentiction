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
        Schema::create('user_data', function (Blueprint $table) {
            $table->id();
            $table->string('trip_id')->nullable();
            $table->string('user_name')->nullable();
            $table->string('mobile_no')->nullable();
            $table->string('total_contro')->default(0);
            $table->string('total_balance')->default(0);
            $table->date('add_date')->nullable();
            $table->string('is_admin')->nullable();
            $table->string('is_delete')->nullable();
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
        Schema::dropIfExists('user_data');
    }
};
