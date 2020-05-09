<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdvertismentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('advertisments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('mainCategoryId');
            $table->integer('subCategoryId');
            $table->string('productName');
            $table->integer('yearOfPurchase');
            $table->integer('expSellPrice');
            $table->string('name');
            $table->string('mobile');
            $table->string('email');
            $table->string('state');
            $table->string('city');
            $table->text('photos');
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
        Schema::dropIfExists('advertisments');
    }
}
