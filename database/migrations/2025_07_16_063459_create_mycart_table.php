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
        Schema::create('mycart', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('c_id');
            $table->unsignedBigInteger('item_id');
            $table->string('order_id')->nullable();
            $table->json('o_apply')->nullable(); 
            $table->string('status')->default('Active');  
             $table->string('c_by');  
            $table->decimal('amount', 10, 2);
            $table->integer('qty');
           
           
           // $table->string('variation')->nullable();
            
        
            // $table->foreign('c_id')->references('id')->on('customers');
            // $table->foreign('product_id')->references('id')->on('product');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mycart');
    }
};
