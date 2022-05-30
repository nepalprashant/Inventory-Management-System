<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchaseItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchase_items', function (Blueprint $table) {
            $table->id();
            $table->string('quantity');
            $table->string('rate');
            $table->string('amount');
            $table->string('discount');
            $table->string('discount_amount')->default(0);
            $table->foreignId('product_id')->constrained();
            $table->foreignId('purchase_id')->constrained();
            $table->enum('purchase_item_type', ['Purchase', 'Return']);
            $table->enum('status', ['running', 'completed', 'cancelled']);
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
        Schema::dropIfExists('purchase_items');
    }
}
