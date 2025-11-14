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
        Schema::table('character', function (Blueprint $table) {
            $table->string('title')->after('id');
            $table->string('slug')->unique()->after('title');
            $table->enum('status', ['active', 'inactive'])->default('active')->after('slug');
        });
    }

    public function down(): void
    {
        Schema::table('character', function (Blueprint $table) {
            $table->dropColumn(['title', 'slug', 'status']);
        });
    }
};
