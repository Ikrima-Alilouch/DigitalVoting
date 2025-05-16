<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('firstname')->nullable()->after('name');
        });

        // Kopieer de data van 'name' naar 'firstname'
        DB::table('users')->update([
            'firstname' => DB::raw('name')
        ]);

        // Verwijder de oude kolom 'name'
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('name');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('name')->nullable()->after('firstname');
        });

        DB::table('users')->update([
            'name' => DB::raw('firstname')
        ]);

        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('firstname');
        });
    }
};
