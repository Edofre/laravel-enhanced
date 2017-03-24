<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $email;
    static $name;
    static $password;

    return [
        'name'           => !empty($name) ? $name : $faker->name,
        'email'          => !empty($email) ? $email : $faker->unique()->safeEmail,
        'password'       => !empty($password) ? $password : bcrypt('hunter'),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Models\Tag::class, function (Faker\Generator $faker) {
    static $tag_name;

    return [
        'name' => !empty($tag_name) ? $tag_name : ucfirst($faker->word),
    ];
});

$factory->define(App\Models\NewsCategory::class, function ($faker) {
    static $is_public;
    static $name;
    static $description;
    static $image_url;

    return [
        'is_public'   => !is_null($is_public) ? $is_public : $faker->boolean(80), // We want more yes than no
        'name'        => !empty($name) ? $name : ucfirst($faker->word),
        'description' => !empty($description) ? $description : $faker->text,
        'image_url'   => !empty($image_url) ? $image_url : $faker->imageUrl,
    ];
});

$factory->define(App\Models\NewsItem::class, function ($faker) {
    static $is_public;
    static $title;
    static $intro;
    static $content;
    static $image_url;

    return [
        'is_public'        => !is_null($is_public) ? $is_public : $faker->boolean(80), // We want more yes than no
        'news_category_id' => function () {
            return factory(App\Models\NewsCategory::class)->create()->id;
        },
        'title'            => !empty($title) ? $title : ucfirst($faker->words(3, true)),
        'intro'            => !empty($intro) ? $intro : $faker->text(100),
        'content'          => !empty($content) ? $content : $faker->text,
        'image_url'        => !empty($image_url) ? $image_url : $faker->imageUrl,
    ];
});