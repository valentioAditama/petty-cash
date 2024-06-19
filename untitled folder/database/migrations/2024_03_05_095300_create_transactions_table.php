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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->integer('account_id');
            $table->double('debit', 12, 2)->default(0.00);
            $table->double('credit', 12, 2)->default(0.00);
            $table->string('note', 155)->nullable();
            $table->dateTime('transaction_datetime')->default(now());
            $table->string('currency', 3);
            $table->timestamps();
            $table->foreign('currency')->references('symbol')->on('currencies')->onDelete('cascade')->onUpdate('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
