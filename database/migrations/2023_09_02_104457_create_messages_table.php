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

        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            $table->foreignUuid('sender_id')->constrained('users');
            $table->foreignUuid('receiver_id')->constrained('users');
            $table->foreignId('conversation_id')->constrained();
            $table->foreignId('proposal_id')->nullable();
            $table->text('body')->nullable();
            $table->string('file')->nullable();
            $table->boolean('is_read')->default(false);
            $table->string('type')->nullable();
            $table->foreignId('service_id')->nullable()->constrained();
            $table->foreignId('order_id')->nullable()->constrained();
            $table->timestamps();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('messages');
    }
};
