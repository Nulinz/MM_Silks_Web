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
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('c_name')->nullable();
            $table->string('c_contact')->nullable();
            $table->string('c_location')->nullable();
            $table->string('c_type')->nullable();
            $table->string('permission_type')->nullable();
            $table->dateTime('permission_time')->nullable();
            $table->string('cby')->nullable();
            $table->date('joindate')->nullable();
            $table->string('status')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
