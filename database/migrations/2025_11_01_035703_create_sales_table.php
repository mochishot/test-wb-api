<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('sale_id')->nullable();
            $table->unsignedBigInteger('item_id')->nullable();
            $table->string('item_name')->nullable();
            $table->integer('quantity')->default(0);
            $table->decimal('price', 10, 2)->nullable();
            $table->decimal('total_price', 10, 2)->nullable();
            $table->dateTime('sale_date')->nullable();
            $table->string('supplier_article')->nullable();
            $table->string('warehouse')->nullable();
            $table->string('order_id')->nullable();
            $table->timestamps();

            $table->index(['sale_id', 'item_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('sales');
    }
};
