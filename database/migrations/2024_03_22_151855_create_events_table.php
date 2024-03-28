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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('Title');
            $table->text('Description');
            $table->dateTime('Date');
            $table->string('Time');
            $table->string('Location');
            $table->integer('Capacity');
            $table->enum('Type', ['workshop', 'seminar', 'conference', 'other']);
            $table->enum('Status', ['draft', 'published', 'canceled']);
            $table->dateTime('Registration_deadline');
            $table->binary('Image')->nullable();
            $table->timestamps();
        });    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
