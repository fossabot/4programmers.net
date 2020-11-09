<?php

use Faker\Generator as Faker;

$factory->define(\Coyote\User::class, function (Faker $faker) {
    return [
        'name' => $faker->userName . $faker->randomDigit,
        'email' => $faker->unique()->safeEmail,
        'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm',
        'is_confirm' => true,
        'alert_login' => true,
        'guest_id'  => $faker->uuid,
        'allow_subscribe' => true
    ];
});

$factory->state(\Coyote\User::class, 'id', function (Faker $faker) {
    return [
        'id' => $faker->numberBetween(10000000)
    ];
});

$factory->state(\Coyote\User::class, 'blocked', ['is_blocked' => true]);
$factory->state(\Coyote\User::class, 'deleted', ['deleted_at' => now()]);

