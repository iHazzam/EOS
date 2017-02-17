<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('contact_name');
            $table->string('company_name')->nullable();
            $table->string('contact_phone')->nullable();
            $table->string('email')->unique();
            $table->string('password');
            $table->string('address_line1')->nullable();
            $table->string('address_line2')->nullable();
            $table->string('city')->nullable();
            $table->string('postcode')->nullable();
            $table->string('country')->nullable();
            $table->integer('shipping_percent')->unsigned()->default(0);
            $table->decimal('shipping_flat', 6, 2)->default(0);
            $table->enum('default_currency', ['gbp', 'eur', 'usd'])->default('gbp');
            $table->integer('sage_uid')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
