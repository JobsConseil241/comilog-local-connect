<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('trainings', function (Blueprint $table) {
            $table->id();
            $table->string('titre');
            $table->text('description');
            $table->date('date_debut');
            $table->date('date_fin')->nullable();
            $table->string('lieu')->nullable();
            $table->unsignedInteger('places_disponibles')->nullable();
            $table->string('contact_email')->nullable();
            $table->string('piece_jointe')->nullable();
            $table->enum('status', ['draft', 'published', 'closed'])->default('draft');
            $table->timestamp('published_at')->nullable();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();

            $table->index(['status', 'date_debut']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('trainings');
    }
};
