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
        Schema::create('parties', function (Blueprint $table) {
            $table->id('partyID');
            $table->string('name');
            $table->string('logo')->nullable();
            $table->string('description')->nullable();
            $table->integer('seats')->nullable();
            $table->string('status')->default('deactivated');
            $table->string('leader_firstname');
            $table->string('leader_infix')->nullable();
            $table->string('leader_lastname');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('parties');
    }
};
