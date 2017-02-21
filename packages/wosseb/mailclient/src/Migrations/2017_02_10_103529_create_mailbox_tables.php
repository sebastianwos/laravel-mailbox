<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMailboxTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mailboxes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->timestamps();
        });

        Schema::create('messages', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('mailbox_id');
            $table->string('message_id', 255);
            $table->integer('message_number');
            $table->text('subject')->nullable();
            $table->text('body_html')->nullable();
            $table->text('body_text')->nullable();
            $table->string('from');
            $table->string('to');
            $table->dateTime('date');
            $table->boolean('answered');
            $table->boolean('deleted');
            $table->boolean('seen');
            $table->boolean('draft');
            $table->timestamps();
            $table->foreign('mailbox_id')->references('id')->on('mailboxes');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mailboxes');
        Schema::dropIfExists('messages');
    }
}
