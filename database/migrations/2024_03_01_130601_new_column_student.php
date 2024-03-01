<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('student', function (Blueprint $table) {
            $table->string('city');
            $table->string('grade_level');
            $table->string('strand');
            $table->string('course');
            $table->string('school_name');
            $table->string('g_name');
            $table->string('g_relationship');
            $table->string('email_address');
            $table->string('fbaccount');


        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('student', function (Blueprint $table) {
            //
        });
    }
};
