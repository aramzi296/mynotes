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
        Schema::table('notes', function (Illuminate\Database\Schema\Blueprint $table) {
            $table->string('title')->after('id')->nullable();
            $table->string('slug')->after('title')->nullable()->unique();
            $table->string('status')->after('content')->default('draft');
            $table->foreignId('category_id')->nullable()->after('status')->constrained()->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('notes', function (Illuminate\Database\Schema\Blueprint $table) {
            $table->dropForeign(['category_id']);
            $table->dropColumn(['title', 'slug', 'status', 'category_id']);
        });
    }
};
