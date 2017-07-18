<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->timestamps();
        });

        Schema::create('taxes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->unsignedInteger('rate');
            $table->timestamps();
        });

        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('category_id');
            $table->unsignedInteger('tax_id');
            $table->string('name');
            $table->unsignedInteger('price_net');
            $table->unsignedInteger('price_gross');
            $table->timestamps();
            $table->foreign('category_id', 'fk_categories')
                ->references('id')
                ->on('categories')
                ->onUpdate('CASCADE')
                ->onDelete('RESTIRCT');
            $table->foreign('tax_id', 'fk_taxes')
                ->references('id')
                ->on('taxes')
                ->onUpdate('CASCADE')
                ->onDelete('RESTRICT');

        });

        Schema::create('carts', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
        });

        Schema::create('cart_items', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('cart_id');
            $table->unsignedInteger('product_id');
            $table->unsignedInteger('quantity');
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

    }
}
