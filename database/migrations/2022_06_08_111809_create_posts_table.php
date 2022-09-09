<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('title'); // max 255 символов
            $table->text('content'); // Неограничено символов
            $table->string('image')->nullable(); // url картинки
            $table->unsignedBigInteger('likes')->nullable(); // Большое число
            $table->boolean('is_published')->default(1); // Посты по дефоту добавлены
            $table->timestamps();

            $table->softDeletes();

            $table->unsignedBigInteger('category_id')->nullable();

            $table->index('category_id','post_category_idx');
            $table->foreign('category_id','post_category_fk')->on('categories')->references('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
}
