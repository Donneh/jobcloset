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
        Schema::create('sku_product_attribute', function (Blueprint $table) {
            $table->primary(['product_attribute_id', 'sku_id']);
            $table->foreignId('product_attribute_id')->constrained()->cascadeOnDelete();
            $table->foreignId('sku_id')->constrained()->cascadeOnDelete();
            $table->foreignId('tenant_id');
            $table->string('value');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sku_product_attribute');
    }
};
