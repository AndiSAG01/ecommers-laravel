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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('invoice')->unique();
            $table->string('customer_id')->index();
            $table->string('customer_name');
            $table->string('customer_phone');
            $table->string('customer_address');
            $table->string('customer_postal_code');
            $table->unsignedBigInteger('district_id')->index();
            $table->integer('subtotal');
            $table->string('courier')->nullable();
            $table->integer('cost')->default(0);
            $table->string('tracking_number')->nullable();
            $table->char('status', 1)->default(0)->comment('0: new, 1: confirm, 2: process, 3: shipping, 4: done');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
