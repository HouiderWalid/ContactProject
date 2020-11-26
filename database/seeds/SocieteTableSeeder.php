<?php

use Illuminate\Database\Seeder;

class SocieteTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Societe::class, 10)->create()->each(function ($u) {
            $u->contacts()->save(factory(App\Contact::class)->make());
        });
    }
}
