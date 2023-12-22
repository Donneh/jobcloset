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
        Schema::create('adyen_settings', function (Blueprint $table) {
            $table->id();
            $table->string('environment');
            $table->string('merchant_account');
            $table->string('api_key');
            $table->string('client_key');
            $table->foreignId('tenant_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('adyen_settings');
    }
};
