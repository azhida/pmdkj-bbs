<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTopicsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('topics', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->comment('发布的用户ID');
            $table->string('title')->unique()->comment('标题');
            $table->longText('content')->nullable()->comment('内容');
            $table->integer('read_count')->default(0)->comment('阅读次数');
            $table->integer('reply_count')->default(0)->comment('评论次数');
            $table->integer('like_count')->default(0)->comment('点赞次数');
            $table->timestamps();
        });
        \DB::statement("ALTER TABLE `topics` comment '话题表'");

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('topics');
    }
}
