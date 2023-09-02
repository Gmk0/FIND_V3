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

        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_numero');
            $table->foreignUuid('user_id')->constrained();
            $table->foreignId('service_id')->constrained();
            $table->string('type')->nullable();
            $table->decimal('total_amount', 8, 2);
            $table->string('quantity')->nullable();
            $table->string('transaction_id')->nullable();
            $table->integer('progress')->nullable();
            $table->dateTime('is_paid')->nullable();
            $table->enum('status', ["pending","completed","failed"]);
            $table->timestamps();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
