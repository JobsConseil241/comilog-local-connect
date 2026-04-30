<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pmes', function (Blueprint $table) {
            $table->id();
            $table->string('raison_sociale');
            $table->string('rccm')->nullable()->unique();
            $table->string('nif')->nullable()->unique();
            $table->string('ville')->nullable();
            $table->string('telephone')->nullable();
            $table->string('email_contact')->nullable();
            $table->string('representant_nom')->nullable();
            $table->string('representant_fonction')->nullable();
            $table->text('description')->nullable();
            $table->enum('status', ['pending', 'active', 'suspended', 'rejected'])->default('pending');
            $table->boolean('imported_from_anpi')->default(false);
            $table->timestamp('validated_at')->nullable();
            $table->foreignId('validated_by')->nullable()->constrained('users')->nullOnDelete();
            $table->text('rejection_reason')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pmes');
    }
};
