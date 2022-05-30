<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchases', function (Blueprint $table) {
            $table->id();
            $table->string('date');
            $table->string('invoice_no')->unique();
            $table->foreignId('supplier_id')->constrained();
            $table->enum('status', ['running', 'completed', 'cancelled']);
            $table->enum('purchase_type', ['Direct', 'Order', 'Return']);
            $table->string('shipping_charge')->default(0);
            $table->string('adjustable_discount')->default(0);
            $table->string('total_discount')->default(0);
            $table->string('total_amount')->default(0);
            $table->string('rounding_amount')->default(0);
            $table->string('net_amount')->default(0);
            $table->foreignId('user_id')->constrained();
            $table->string('remark')->nullable();
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
        Schema::dropIfExists('purchases');
    }
}
