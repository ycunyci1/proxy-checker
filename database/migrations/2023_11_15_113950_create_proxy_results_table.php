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
        Schema::create('proxy_results', function (Blueprint $table) {
            $table->id();
            $table->string('ip_port')->nullable();
            $table->string('country')->nullable();
            $table->string('type')->nullable();
            $table->string('query')->nullable();
            $table->string('timing')->nullable();
            $table->string('key')->nullable();
            $table->boolean('kind')->default(0);
            $table->boolean('work')->default(0);
            $table->timestamps();
            $table->index('key');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('proxy_results');
    }
};
