<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table)
        {
            $table->string('last_name')->after('name');
            $table->string('phone_number')->after('email');
            $table->string('address')->after('phone_number');
            $table->integer('country_id')->after('address');
            $table->integer('state_id')->after('country_id');
            $table->integer('city_id')->after('state_id');
            $table->integer('pincode')->after('city_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
