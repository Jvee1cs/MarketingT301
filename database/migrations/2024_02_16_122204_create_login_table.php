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
        Schema::create('login', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('user_login');
            $table->string('username');
            $table->string('password');
            $table->string('confirm_pass');
            $table->string('user_lastname');
            $table->string('user_firstname');
            $table->string('user_middlename');
            $table->string('email_address');
            $table->string('user_type');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('login');
    }
};
