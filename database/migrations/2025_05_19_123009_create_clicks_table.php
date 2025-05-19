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
        Schema::create('clicks', function (Blueprint $table) {
            $table->id();
            $table->string('gclid', 128)->nullable()->index();
            $table->string('resource_name', 256)->nullable();
            $table->string('group_ad', 64)->nullable();
            $table->string('group_name', 128)->nullable();
            $table->string('group_id', 32)->nullable()->index();
            $table->dateTime('date_time')->nullable()->index();
            $table->date('segments_date')->nullable()->index();
            $table->string('account_id', 32)->nullable()->index();
            $table->string('account_name', 128)->nullable()->index();
            $table->dateTime('date_time_no_timezone')->nullable()->index();
            $table->string('conversion_name', 128)->nullable();
            $table->string('converted', 8)->index()->default('NO');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clicks');
    }
};
