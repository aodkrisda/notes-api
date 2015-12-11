<?php

/**
 *
 */
class InitDB
{
    const MIGRATIONS_PATH = __DIR__ . '/migrations';
    const SEEDS_PATH = __DIR__ . '/seeds';

    public function exec()
    {
        $this->runMigrations();
        $this->runSeeds();
    }

    public function runMigrations()
    {
        $this->run(self::MIGRATIONS_PATH . '/CreateTables.php');
    }

    public function runSeeds()
    {
        $this->run(self::SEEDS_PATH . '/DatabaseSeeder.php');
    }

    private function run($file) {
        require_once $file;
        $class = basename($file, '.php');
        $obj = new $class;
        $obj->run();
    }
}
