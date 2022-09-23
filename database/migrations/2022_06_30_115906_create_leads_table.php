<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLeadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leads', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->unique();
            $table->bigInteger('contact_number')->unique();
            $table->string('gender');
            $table->date('date_of_birth');
            $table->string('marital_status');
            $table->string('no_of_child')->nullable();
            $table->string('religion');
            $table->string('caste');
            $table->string('mother_tongue');
            $table->string('country');
            $table->string('state');
            $table->string('city');
            $table->text('address')->nullable();
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
        Schema::dropIfExists('leads');
    }
}
