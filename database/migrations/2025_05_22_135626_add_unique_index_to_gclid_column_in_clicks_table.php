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
        // Remove duplicate GCLIDs
        $duplicates = \DB::table('clicks')
            ->select('gclid')
            ->groupBy('gclid')
            ->havingRaw('COUNT(*) > 1')
            ->pluck('gclid');
        foreach ($duplicates as $gclid) {
            $ids = \DB::table('clicks')
                ->where('gclid', $gclid)
                ->orderBy('id')
                ->pluck('id');

            $idsToDelete = $ids->slice(1); // keep the first one
            \DB::table('clicks')->whereIn('id', $idsToDelete)->delete();
        }

        // Add the unique property for gclid
        Schema::table('clicks', function (Blueprint $table) {
            $table->unique('gclid');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('clicks', function (Blueprint $table) {
            $table->dropUnique(['gclid']);
        });
    }
};
