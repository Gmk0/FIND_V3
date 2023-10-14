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

        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->string('service_numero');
            $table->string('title');
            $table->json('tag');
            $table->text('description');
            $table->decimal('basic_price', 8, 2);
            $table->string('basic_support');
            $table->integer('basic_revision');
            $table->integer('basic_delivery_time');
            $table->decimal('premium_price', 8, 2)->nullable();
            $table->string('premium_support')->nullable();
            $table->integer('premium_revision')->nullable();
            $table->integer('premium_delivery_time')->nullable();
            $table->decimal('extra_price', 8, 2)->nullable();
            $table->string('extra_support')->nullable();
            $table->integer('extra_revision')->nullable();
            $table->integer('extra_delivery_time')->nullable();
            $table->string('example', 1000)->nullable();
            $table->string('files')->nullable();
            $table->string('format')->nullable();
            $table->longText('need_service')->nullable();
            $table->string('delivery_time_unit')->nullable();
            $table->json('sub_category')->nullable();
            $table->string('video_url')->nullable();
            $table->bigInteger('view_count')->default(0);
            $table->bigInteger('like')->default(0);
            $table->boolean('is_publish',)->default(false);
            $table->foreignId('freelance_id')->constrained();
            $table->foreignId('category_id')->constrained();
            $table->timestamps();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};
