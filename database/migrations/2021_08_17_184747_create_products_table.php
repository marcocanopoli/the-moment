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
            
            $table->unsignedBigInteger('anime_id');
            $table->foreign('anime_id')
                ->references('id')
                ->on('anime')
                ->onDelete('SET NULL');

            $table->unsignedBigInteger('season_id');
            $table->foreign('season_id')
                ->references('id')
                ->on('seasons')
                ->onDelete('SET NULL');

            $table->string('thumb')->nullable();
            $table->string('name', 100);
            $table->string('slug')->unique();
            $table->string('prod_group');
            $table->text('desc')->nullable();
            $table->string('color', 50);
            $table->enum('gender', ['Man', 'Woman', 'Unisex', 'Boy', 'Girl', 'Baby Boy', 'Baby Girl']);
            $table->float('price', 5, 2);
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
