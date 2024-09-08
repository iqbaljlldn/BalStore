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
        Schema::table('users', function(Blueprint $table) {
            $table->string('address_one')->nullable()->change();
            $table->string('address_two')->nullable()->change();
            $table->integer('provincies_id')->nullable()->change();
            $table->integer('regencies_id')->nullable()->change();
            $table->integer('zip_code')->nullable()->change();
            $table->string('country')->nullable()->change();
            $table->string('mobile')->nullable()->change();
            $table->string('store_name')->nullable()->change();
            $table->foreignId('categories_id')->nullable()->change();
            $table->boolean('store_status')->nullable()->change();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function(Blueprint $table) {
            $table->string('address_one')->nullable(false)->change();
            $table->string('address_two')->nullable(false)->change();
            $table->integer('provincies_id')->nullable(false)->change();
            $table->integer('regencies_id')->nullable(false)->change();
            $table->integer('zip_code')->nullable(false)->change();
            $table->string('country')->nullable(false)->change();
            $table->string('mobile')->nullable(false)->change();
            $table->string('store_name')->nullablefalse()->change();
            $table->foreignId('categories_id')->nullable(false)->change();
            $table->boolean('store_status')->nullable(false)->change();
            $table->dropSoftDeletes();
        });
    }
};
