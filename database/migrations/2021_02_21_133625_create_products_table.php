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
            $table->string('code', '11')->unique();
            $table->string('slug');
            $table->text('nama', '255');
            $table->bigInteger('price')->nullable();
            $table->bigInteger('qty')->nullable();
            $table->string('size')->nullable();
            $table->string('variant')->nullable();
            $table->integer('returns')->nullable();
            $table->integer('delivery')->nullable();
            $table->boolean('featured')->default(false);
            $table->longText('keterangan')->nullable();
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
