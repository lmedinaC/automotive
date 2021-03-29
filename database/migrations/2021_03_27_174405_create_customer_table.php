<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('last_name');
            $table->string('dni', 8)->nullable(false)->change();
            $table->string('phone_number',9);
            $table->string('address');
            $table->enum('state', ['1', '0'])->default('1')->comment('State flag ');
            $table->date('birth_date')->nullable();  
            $table->unsignedInteger('concessionaire_id');
            $table->unsignedInteger('district_id');
            $table->foreign('concessionaire_id')->references('id')->on('concessionaires');
            $table->foreign('district_id')->references('id')->on('districts');
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
        Schema::dropIfExists('customers');
    }
}
