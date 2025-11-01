<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('stocks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('item_id')->nullable();
            $table->string('item_name')->nullable();
            $table->integer('quantity')->default(0);
            $table->string('warehouse')->nullable();
            $table->string('supplier_article')->nullable();
            $table->string('barcode')->nullable();
            $table->decimal('price', 10, 2)->nullable();
            $table->string('brand')->nullable();
            $table->string('category')->nullable();
            $table->timestamps();

            $table->index(['item_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('stocks');
    }
};
