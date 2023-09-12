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
        Schema::disableForeignKeyConstraints();

        Schema::create('mission_responses', function (Blueprint $table) {
            $table->id();
            $table->string('response_numero')->unique();
            $table->foreignId('freelance_id')->constrained();
            $table->foreignId('mission_id')->constrained();
            $table->text('content');
            $table->decimal('budget', 8, 2);
            $table->enum('status', ["pending","approved","rejected"])->default('pending');
            $table->dateTime('is_paid')->nullable();
            $table->timestamps();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mission_responses');
    }
};
