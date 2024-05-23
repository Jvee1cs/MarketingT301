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
    public function up(): void
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('stud_last_name');
            $table->string('stud_first_name');
            $table->string('stud_middle_name');
            $table->text('address');
            $table->string('city');
            $table->integer('grade_level');
            $table->string('strand');
            $table->string('course')->nullable();
            $table->string('school_name');
            $table->string('g_name');
            $table->string('g_relationship');
            $table->string('email_address');
            $table->string('fbaccount')->nullable();
            $table->string('phone');
            $table->string('g_phone');
            $table->timestamps();
        });
    }   

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {

        Schema::dropIfExists('students');
    }
};
