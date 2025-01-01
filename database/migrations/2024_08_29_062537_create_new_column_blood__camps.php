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
        Schema::table('blood__camps', function (Blueprint $table) {
            //
            $table->string('hospital')->nullable()->after('address');
            $table->boolean('gainer')->default(0)->after('reason');
            $table->string('product')->nullable()->after('weight');
            $table->string('reference')->nullable()->after('occupation');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('blood__camps', function (Blueprint $table) {
            //
        });
    }
};
