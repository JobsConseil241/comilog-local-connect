<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('opportunity_business_category', function (Blueprint $table) {
            $table->foreignId('opportunity_id')->constrained()->cascadeOnDelete();
            $table->foreignId('business_category_id')->constrained()->cascadeOnDelete();
            $table->primary(['opportunity_id', 'business_category_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('opportunity_business_category');
    }
};
