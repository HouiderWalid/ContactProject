<?php

use Faker\Generator as Faker;

$factory->define(App\Contact::class, function (Faker $faker) {
    return [
        'contact_civilite' => $faker->randomElement([ 'madame', 'monsieur']),
        'contact_prenom' => $faker->firstName,
        'contact_nom' => $faker->lastName,
        'contact_telephone' => $faker->phoneNumber,
        'contact_e_mail' => $faker->email,
        'contact_fonction' => $faker->jobTitle,
        'contact_service' => $faker->jobTitle,
        'contact_date_naissance' => $faker->date,
    ];
});
