<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('contact_messages', function (Blueprint $table) {
            $table->string('reference_number', 36)
                ->nullable()
                ->unique();
        });

        // Assign a reference to existing messages without sending emails.
        DB::table('contact_messages')
            ->select('id')
            ->whereNull('reference_number')
            ->chunkById(100, function ($messages): void {
                foreach ($messages as $message) {
                    DB::table('contact_messages')
                        ->where('id', $message->id)
                        ->update([
                            'reference_number' => (string) Str::uuid(),
                        ]);
                }
            });

        Schema::table('contact_messages', function (Blueprint $table) {
            $table->string('reference_number', 36)
                ->nullable(false)
                ->change();
        });
    }

    public function down(): void
    {
        Schema::table('contact_messages', function (Blueprint $table) {
            $table->dropUnique(['reference_number']);
            $table->dropColumn('reference_number');
        });
    }
};