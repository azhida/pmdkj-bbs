<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRepliesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('replies', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->comment('发布的用户ID');
            $table->unsignedBigInteger('topic_id')->comment('话题ID，关联 topics.id');
            $table->unsignedBigInteger('parent_id')->default(0)->comment('父级ID，关联 replies.id');
            $table->longText('content')->comment('回复内容');
            $table->boolean('is_best')->default(false)->comment('是否最佳');
            $table->integer('read_count')->default(0)->comment('阅读次数');
            $table->integer('reply_count')->default(0)->comment('评论次数');
            $table->integer('like_count')->default(0)->comment('点赞次数');
            $table->timestamps();
        });
        \DB::statement("ALTER TABLE `replies` comment '话题回复表'");

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('replies');
    }
}
