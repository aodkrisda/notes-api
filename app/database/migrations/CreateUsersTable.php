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
    public function create()
    {
        DB::schema()->dropIfExists('users');
        DB::schema()->create('users', function($table) {
            $table->increments('id');
            $table->string('name');
            $table->string('username');
            $table->string('email')->unique();
            $table->string('password');
            $table->timestamps();
        });
    }

    public function drop()
    {
        DB::schema()->dropIfExists('users');
    }
}
