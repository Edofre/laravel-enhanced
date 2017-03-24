<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNewsCategories extends Migration
{
    const TABLE_NAME = 'news_categories';

    /**
     * Run the migrations.
     * @return void
     */
    public function up()
    {
        Schema::create(self::TABLE_NAME, function (Blueprint $table) {
            $table->increments('id');

            $table->string('slug')->unique()->nullable();
            $table->boolean('is_public')->default(0);

            $table->string('name');
            $table->text('description')->nullable();
            $table->string('image_url')->nullable();

            $table->integer('created_by')->unsigned()->nullable()->index();
            $table->integer('updated_by')->unsigned()->nullable()->index();
            $table->integer('deleted_by')->unsigned()->nullable()->index();

            $table->foreign('created_by')->references('id')->on('users')->onUpdate('cascade')->onDelete('set null');
            $table->foreign('updated_by')->references('id')->on('users')->onUpdate('cascade')->onDelete('set null');
            $table->foreign('deleted_by')->references('id')->on('users')->onUpdate('cascade')->onDelete('set null');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists(self::TABLE_NAME);
    }
}
