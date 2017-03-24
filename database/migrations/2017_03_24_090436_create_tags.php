<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateTags
 */
class CreateTags extends Migration
{
    const TABLE_NAME = 'tags';

    /**
     * Run the migrations.
     * @return void
     */
    public function up()
    {
        Schema::create(self::TABLE_NAME, function (Blueprint $table) {
            $table->increments('id');

            $table->string('slug')->unique()->nullable();

            $table->string('name');

            $table->integer('created_by')->unsigned()->nullable()->index();
            $table->integer('updated_by')->unsigned()->nullable()->index();
            $table->integer('deleted_by')->unsigned()->nullable()->index();

            $table->foreign('created_by')->references('id')->on('users')->onUpdate('cascade')->onDelete('set null');
            $table->foreign('updated_by')->references('id')->on('users')->onUpdate('cascade')->onDelete('set null');
            $table->foreign('deleted_by')->references('id')->on('users')->onUpdate('cascade')->onDelete('set null');

            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('news_item_' . self::TABLE_NAME, function (Blueprint $table) {
            $table->integer('news_item_id')->unsigned()->index();
            $table->foreign('news_item_id')->references('id')->on(CreateNewsItems::TABLE_NAME)->onUpdate('cascade')->onDelete('cascade');
            $table->integer('tag_id')->unsigned()->index();
            $table->foreign('tag_id')->references('id')->on(self::TABLE_NAME)->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     * @return void
     */
    public function down()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        Schema::dropIfExists('news_item_' . self::TABLE_NAME);
        Schema::dropIfExists(self::TABLE_NAME);
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
