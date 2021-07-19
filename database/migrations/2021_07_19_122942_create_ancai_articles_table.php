<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAncaiArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ancai_articles', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('course_id')->default(0)->comment('课程ID');
            $table->unsignedInteger('catalog_id')->default(0)->comment('目录ID');
            $table->string('title')->comment('文章标题');
            $table->text('content')->comment('文章内容');
            $table->string('video_link')->nullable()->comment('视频地址');
            $table->unsignedInteger('sort')->default(0);
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
        Schema::dropIfExists('ancai_articles');
    }
}
