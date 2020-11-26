<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Support\Str;

class contactTest extends TestCase
{
    //use DatabaseMigrations;

    /**
     * A basic test example.
     *
     * @test
     *
     * @return void
     */
    public function addContactTest()
    {
        $add_uri = $this->post('/contact', 
        [   'contact_civilite'           => 'monsieur',
            'contact_prenom'             => 'prenon1',
            'contact_nom'                => 'nom1',
            'contact_fonction'           => 'fonction1',
            'societe_id'                 => 25,
            'contact_service'            => 'service1',
            'contact_e_mail'             => 'email1',
            'contact_telephone'          => '0147896325',
            'contact_date_naissance'     => '1990-10-05',
        ], array('HTTP_X-Requested-With' => 'XMLHttpRequest'));

        $add_uri->assertStatus(200);
    }

    /**
     * @test
     *
     */

    public function updateContactTest(){

        $update_uri = $this->put('/contact/12', 
        [   'contact_civilite'           => 'monsieur',
            'contact_prenom'             => 'prenon1',
            'contact_nom'                => 'nom1',
            'contact_fonction'           => 'fonction1',
            'societe_id'                 => 28,
            'contact_service'            => 'service1',
            'contact_e_mail'             => 'email1',
            'contact_telephone'          => '0147896325',
            'contact_date_naissance'     => '1990-10-05',
        ], array('HTTP_X-Requested-With' => 'XMLHttpRequest'));

        $update_uri->assertStatus(200);
    }

    /**
     * @test
     *
     */

    public function deleteContactTest(){
        $delete_uri = $this->delete('/contact/12', array() ,array('HTTP_X-Requested-With' => 'XMLHttpRequest'));
        $delete_uri->assertStatus(200);
    }
}
