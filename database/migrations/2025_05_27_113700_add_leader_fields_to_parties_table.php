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
        Schema::table('parties', function (Blueprint $table) {
            $table->string('leader_firstname')->after('status');
            $table->string('leader_infix')->nullable()->after('leader_firstname');
            $table->string('leader_lastname')->after('leader_infix');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('parties', function (Blueprint $table) {
            $table->dropColumn(['leader_firstname', 'leader_infix', 'leader_lastname']);
        });
    }
}; 