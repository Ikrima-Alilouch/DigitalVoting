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
        Schema::rename('_partymembers', 'partymembers');
        Schema::rename('_user_vote', 'user_vote');
        Schema::rename('_vote', 'vote');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::rename('partymembers', '_partymembers');
        Schema::rename('user_vote', '_user_vote');
        Schema::rename('vote', '_vote');
    }
};
