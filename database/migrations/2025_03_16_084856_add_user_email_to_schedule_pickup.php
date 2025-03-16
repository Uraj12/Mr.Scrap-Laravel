<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::table('schedule_pickup', function (Blueprint $table) {
        $table->string('user_email')->nullable();
    });
}

public function down()
{
    Schema::table('schedule_pickup', function (Blueprint $table) {
        $table->dropColumn('user_email');
    });
}

    /**
     * Reverse the migrations.
     */
   
};
