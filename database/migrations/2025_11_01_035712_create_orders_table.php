<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_id')->nullable();
            $table->unsignedBigInteger('item_id')->nullable();
            $table->string('item_name')->nullable();
            $table->integer('quantity')->default(0);
            $table->decimal('price', 10, 2)->nullable();
            $table->dateTime('order_date')->nullable();
            $table->dateTime('delivery_date')->nullable();
            $table->string('supplier_article')->nullable();
            $table->string('warehouse')->nullable();
            $table->string('status')->nullable();
            $table->timestamps();

            $table->index(['order_id', 'item_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('orders');
    }
};
