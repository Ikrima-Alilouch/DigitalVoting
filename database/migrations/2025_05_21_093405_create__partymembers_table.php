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
        Schema::create('partymembers', function (Blueprint $table) {
            $table->id('partyMemberID');
            $table->integer('partyID')->index();
            $table->string('firstname');
            $table->string('infix')->nullable();
            $table->string('lastname');
            $table->string('role');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('partymembers');
    }
};
