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
        Schema::create('movies', function (Blueprint $table) {
            $table->id();
            $table->int('user_id');
            $table->FOREIGN('user_id')->REFERENCE('id')->ON('users')->ondelete('RESTRICTS');
            $table->string('title');
            $table->text('plot');
            $table->string('poster');
            $table->string('genre');
            $table->string('year');
            $table->string('runtime');
            $table->string('director');
            $table->string('writer');
            $table->string('country');
            $table->string('language');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('movies');
    }
};
