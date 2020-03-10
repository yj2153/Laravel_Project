<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInquireTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inquire', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->datetime('created')->nullable();
            $table->timestamp('modified')->useCurrent();
            $table->string('member_id');
            $table->string('reply_id')->nullable();
            $table->string('title')->nullable();
            $table->string('message');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('inquire');
    }
}
