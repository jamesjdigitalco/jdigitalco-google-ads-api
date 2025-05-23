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
        Schema::create('calls', function (Blueprint $table) {
            $table->id();
            $table->string('contact_id', 64)->index()->unique();
            $table->string('location_id', 64)->nullable();
            $table->dateTime('timestamp')->nullable()->index();
            $table->string('conversation_id', 64)->nullable();
            $table->string('converted', 8)->index()->default('NO');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('calls');
    }
};
