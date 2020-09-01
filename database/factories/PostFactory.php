<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\EloquentPost;
use Faker\Generator as Faker;

$factory->define(EloquentPost::class, function (Faker $faker) {
    return [
        'content' => $faker->text
    ];
});
