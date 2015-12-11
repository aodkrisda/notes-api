<?php
use Illuminate\Database\Capsule\Manager as DB;

require 'CreateUsersTable.php';
require 'CreateNotesTable.php';

/**
 * Migrations for users table
 */
class CreateTables
{
    /**
     * Run the migrations
     *
     * @return void
     */
    function run()
    {
        $usersTable = new CreateUsersTable;
        $notesTable = new CreateNotesTable;

        $notesTable->drop();
        $usersTable->drop();

        $usersTable->create();
        $notesTable->create();
    }
}
