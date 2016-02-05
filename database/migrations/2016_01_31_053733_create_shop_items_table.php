<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShopItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shop_items', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->text('description');
            $table->integer('category');
            $table->integer('price');
            $table->integer('discount');
            $table->integer('item_id');
            $table->integer('item_count');
            $table->integer('times_bought');
            $table->tinyInteger('custom_quantity');
            $table->tinyInteger('shareable');
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
        Schema::drop('shop_items');
    }
}
