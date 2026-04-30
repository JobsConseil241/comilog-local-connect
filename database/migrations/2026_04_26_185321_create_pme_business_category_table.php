<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pme_business_category', function (Blueprint $table) {
            $table->foreignId('pme_id')->constrained()->cascadeOnDelete();
            $table->foreignId('business_category_id')->constrained()->cascadeOnDelete();
            $table->primary(['pme_id', 'business_category_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pme_business_category');
    }
};
