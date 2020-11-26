<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ContactTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->browse(function (Browser $browser) {
            //$browser->visit('/')
                    //->assertSee('Laravel')
                    //->press('@contact_list_button')
                    //->pause(1000)
                    //->assertSee('List des contacts')
                    //->resize(500, 500);
                    /*->press('@contact_delete_button')
                    ->whenAvailable('.modal', function ($modal) {
                        $modal->assertSee('Confirmation')
                              ->press('confirmation');
                    })
                    ->waitUntilMissing('.table_rows');*/
        });
    }
}
