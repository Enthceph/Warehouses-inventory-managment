<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();

            $table->foreignId('account_id')->constrained(table: 'accounts');
            $table->foreignId('suppliers_id')->constrained(table: 'suppliers')->nullable();
            $table->foreignId('outlets_id')->constrained(table: 'outlets')->nullable();
            $table->foreignId('type_id')->constrained(table: 'transactions_categories', column: "id");

            $table->BigInteger('amount');
            $table->string('description')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactions');
    }
};
