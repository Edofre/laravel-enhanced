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
    static $password;

    return [
        'name'           => $faker->name,
        'email'          => $faker->unique()->safeEmail,
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
    return [
        'is_public'   => $faker->boolean(80), // We want more yes than no
        'name'        => ucfirst($faker->word),
        'description' => $faker->text,
        'image_url'   => $faker->image,
    ];
});

$factory->define(App\Models\NewsItem::class, function ($faker) {
    return [
        'is_public'        => $faker->boolean(80), // We want more yes than no
        'news_category_id' => function () {
            return factory(App\Models\NewsCategory::class)->create()->id;
        },
        'title'            => ucfirst($faker->words(3, true)),
        'intro'            => $faker->text(100),
        'content'          => $faker->text,
        'image_url'        => $faker->image,
    ];
});