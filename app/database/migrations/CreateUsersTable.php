<?php
use Illuminate\Database\Capsule\Manager as DB;

/**
 * Migrations for users table
 */
class CreateUsersTable
{
    /**
     * Run the migrations
     *
     * @return void
     */
    function run()
    {
        DB::schema()->dropIfExists('users');
        DB::schema()->create('users', function($table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password', 60);
            $table->timestamps();
        });
    }
}
