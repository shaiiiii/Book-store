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
        Schema::create('book_issuances', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('book_id'); // Changed to unsignedBigInteger
            $table->unsignedBigInteger('user_id'); // Changed to unsignedBigInteger
            $table->date('issued_date');
            $table->date('received_date')->nullable();
            $table->string('status')->default('issued');
            $table->timestamps();
            $table->foreign('book_id')->references('id')->on('books')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('book_issuances');
    }
};
