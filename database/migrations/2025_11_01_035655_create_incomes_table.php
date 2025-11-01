<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('incomes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('income_id')->nullable();
            $table->unsignedBigInteger('item_id')->nullable();
            $table->string('item_name')->nullable();
            $table->integer('quantity')->default(0);
            $table->decimal('price', 10, 2)->nullable();
            $table->dateTime('income_date')->nullable();
            $table->string('supplier_article')->nullable();
            $table->string('warehouse')->nullable();
            $table->string('status')->nullable();
            $table->timestamps();

            $table->index(['income_id', 'item_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('incomes');
    }
};
