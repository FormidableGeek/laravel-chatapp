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
        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()
            ->onDelete("cascade");
            $table->string('conversation_id');

            $table->foreign('conversation_id')->references('conversation_id')->on('conversations')->onDelete('cascade');

            $table->foreignId('receiver_id')
                  ->constrained('users')->onDelete("cascade");
            $table->text('message');
            $table->timestamps();


        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('messages');
    }
};
