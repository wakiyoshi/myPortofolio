<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->comment('ユーザー名');
            $table->string('password')->comment('パスワード');
            $table->string('email')->unique()->comment('メールアドレス');
            $table->string('name_kana')->nullable()->comment('ユーザー名カナ');
            $table->string('phone_number')->nullable()->comment('電話番号');
            $table->string('shipping_address')->nullable()->comment('配送先住所');
            $table->integer('card_number')->nullable()->comment('クレジットカード番号');
            $table->string('card_name')->nullable()->comment('カード名義');
            $table->integer('expiration_date')->nullable()->comment('有効期限');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
