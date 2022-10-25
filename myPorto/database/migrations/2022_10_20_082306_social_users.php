<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SocialUsers extends Migration
{

    public function up()
    {
        Schema::create('user_socials', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id');
            $table->string('provider');
            $table->string('account_id');
            $table->timestamps();

            $table->unique(['provider', 'account_id']);

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
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
