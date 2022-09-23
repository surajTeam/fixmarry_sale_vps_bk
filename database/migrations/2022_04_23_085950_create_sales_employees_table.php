<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalesEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales_employees', function (Blueprint $table) {
            $table->id();
            $table->string('fixmarry_employee_id')->unique();
            $table->string('name');
            $table->integer('role_id');
            $table->string('email')->unique();
            $table->bigInteger('contact_number')->unique();
            $table->date('date_of_birth');
            $table->string('gender');
            $table->text('languages_known');
            $table->text('address');
            $table->string('profile_photo_url');
            $table->string('password');
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
        Schema::dropIfExists('sales_employees');
    }
}
