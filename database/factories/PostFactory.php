<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\EloquentUser;
use App\Models\EloquentPost;
use Faker\Generator as Faker;

$factory->define(EloquentPost::class, function (Faker $faker) {
    return [
        'id' => $faker->uuid,
        'content' => $faker->text,
        'user_id' => factory(EloquentUser::class)
    ];
});
