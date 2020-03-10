<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nails', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->datetime('created')->nullable();
            $table->timestamp('modified')->useCurrent();
            $table->string('type');
            $table->string('title_ko');
            $table->string('title_jp');
            $table->string('price_ko');
            $table->string('price_jp');
            $table->time('useTime');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('nails');
    }
}
