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
            $table->id();
            $table->string('phone')->unique()->comment('手机号码');
            $table->string('name')->unique()->comment('用户名');
            $table->string('email')->unique()->comment('邮箱');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('weixin_mp_openid')->unique()->nullable()->comment('微信公众号openID');
            $table->string('weixin_miniapp_openid')->unique()->nullable()->comment('微信小程序openID');
            $table->string('weixin_unionid')->unique()->nullable()->comment('微信unionID');
            $table->string('avatar')->nullable()->comment('用户头像');
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
