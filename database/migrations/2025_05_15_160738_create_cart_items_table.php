<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCartItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cart_items', function (Blueprint $table) {
             $table->id();
            $table->integer("user_id");
            $table->foreignId("product_id")->constrained();
            $table->foreignId("cart_id")->constrained();
            $table->unsignedInteger("quantity");
            $table->decimal('amount', total: 10, places: 2);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cart_items');
    }
}
