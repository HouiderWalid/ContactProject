<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contacts', function (Blueprint $table) {
            $table->increments('contact_id');
            $table->integer('societe_id')->unsigned();
            $table->string('contact_civilite');
            $table->string('contact_prenom');
            $table->string('contact_nom');
            $table->string('contact_fonction');
            $table->string('contact_service');
            $table->string('contact_telephone');
            $table->string('contact_e_mail');
            $table->string('contact_date_naissance');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contacts');
    }
}
