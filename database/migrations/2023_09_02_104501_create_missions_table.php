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

        Schema::create('missions', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->foreignUuid('user_id')->constrained();
            $table->foreignId('category_id')->constrained();
            $table->json('sub_category');
            $table->text('description')->nullable();
            $table->json('files')->nullable();
            $table->decimal('budget', 8, 2);
            $table->date('begin_mission')->nullable();
            $table->date('end_mission')->nullable();
            $table->integer('progress')->nullable();
            $table->foreignId('transaction_id')->constrained();
            $table->dateTime('is_paid')->nullable();
            $table->enum('status', ["active","inactive","completed"])->default('active');
            $table->timestamps();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('missions');
    }
};
