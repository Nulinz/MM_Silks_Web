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
        Schema::create('order', function (Blueprint $table) {
            $table->id();
            $table->string('c_id')->nullable();
            $table->string('order_id')->nullable();
            $table->string('amount')->nullable();
            $table->string('no_of_products')->nullable();
            $table->string('status')->nullable();
            $table->string('transport_name')->nullable();
            $table->string('address_id')->nullable();
            $table->string('c_by')->nullable();
            $table->timestamps();
            $table->string('transaction_id')->nullable();
            $table->string('payment_sts')->nullable();
            $table->string('payment_mode')->nullable();
            $table->string('paid_at')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order');
    }
};
