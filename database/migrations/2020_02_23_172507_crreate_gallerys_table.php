<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CrreateGallerysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('gallerys', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->datetime('created')->nullable();
            $table->timestamp('modified')->useCurrent();
            $table->string('title')->notnull();
            $table->string('picture')->notnull();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
