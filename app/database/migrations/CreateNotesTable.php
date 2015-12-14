<?php
use Illuminate\Database\Capsule\Manager as DB;

/**
 * Migrations for users table
 */
class CreateNotesTable
{
    /**
     * Run the migrations
     *
     * @return void
     */
    public function create()
    {
        DB::schema()->create('notes', function($table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->mediumText('body');
            $table->timestamps();

            $table->foreign('user_id')
                ->references('id')->on('users')
                ->onDelete('cascade');
        });
    }

    public function drop() {
        DB::schema()->dropIfExists('notes');
    }
}
