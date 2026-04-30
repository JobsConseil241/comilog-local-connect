<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('opportunities', function (Blueprint $table) {
            $table->id();
            $table->string('reference')->unique();
            $table->string('titre');
            $table->text('description');
            $table->enum('type', ['appel_offres', 'consultation', 'devis', 'manifestation_interet'])->default('consultation');
            $table->date('deadline')->nullable();
            $table->string('budget_estime')->nullable();
            $table->string('lieu_execution')->nullable();
            $table->string('contact_email')->nullable();
            $table->string('contact_nom')->nullable();
            $table->string('piece_jointe')->nullable();
            $table->enum('status', ['draft', 'published', 'closed'])->default('draft');
            $table->timestamp('published_at')->nullable();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();

            $table->index(['status', 'deadline']);
            $table->index('published_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('opportunities');
    }
};
