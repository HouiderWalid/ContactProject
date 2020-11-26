<?php

use Faker\Generator as Faker;

$factory->define(App\Societe::class, function (Faker $faker) {
    return [
        'societe_nom' => $faker->company,
        'societe_adresse' => $faker->address,
        'societe_code_postal' => $faker->postcode,
        'societe_ville' => $faker->city,
        'societe_telephone' => $faker->phoneNumber,
        'societe_site_web' => $faker->domainName
    ];
});
