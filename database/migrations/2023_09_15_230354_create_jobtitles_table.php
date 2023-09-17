<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('jobtitles', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignId('tenant_id');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('jobtitles');
    }
};
