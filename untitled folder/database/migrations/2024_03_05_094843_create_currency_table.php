<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('currencies', function (Blueprint $table) {
            $table->id();
            $table->string('name', 155);
            $table->string('symbol', 3)->index();
            $table->timestamps();
        });

        DB::table('currencies')->insert([
            [
                'name' => 'Myanmar Kyat',
                'symbol' => 'MMK',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Thia Baht',
                'symbol' => 'THB',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('currency');
    }
};
