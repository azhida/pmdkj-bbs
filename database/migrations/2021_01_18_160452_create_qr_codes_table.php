<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQrCodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('qr_codes', function (Blueprint $table) {
            $table->id();
            $table->string('short_code')->unique()->comment('短码');
            $table->string('qr_code_content')->comment('二维码内容');
            $table->string('file_url')->nullable()->comment('二维码图片地址');
            $table->timestamps();
        });
        \DB::statement("ALTER TABLE `qr_codes` comment '二维码信息表'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('qr_codes');
    }
}
