<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('model_number');
            $table->foreignId('category_id')->constrained();
            $table->foreignId('deparment_id')->constrained();
            $table->foreignId('manufacturer_id')->constrained();
            $table->bigInteger('upc');
            $table->bigInteger('sku');
            $table->decimal('regular_price',10,2);
            $table->decimal('sale_price',10,2);
            $table->text('description')->nullable();
            $table->text('url');
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
        Schema::dropIfExists('products');
    }
}
