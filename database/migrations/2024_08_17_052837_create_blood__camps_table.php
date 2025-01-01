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
        Schema::create('blood__camps', function (Blueprint $table) {
            $table->id();
            $table->string('Donar_name')->nullable();
            $table->string('mobile_no')->nullable();
            $table->string('address')->nullable();
            $table->string('gender')->nullable();
            $table->date('DOB')->nullable();
            $table->string('weight')->nullable();
            $table->string('blood_grp')->nullable();
            $table->string('occupation')->nullable();
            $table->boolean('is_success')->default(0);
            $table->string('reason')->nullable();
            $table->boolean('is_delete')->default(0);
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
        Schema::dropIfExists('blood__camps');
    }
};
