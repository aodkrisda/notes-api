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
        $files = glob(self::MIGRATIONS_PATH . '/*.php');
        $this->run($files);
    }

    public function runSeeds()
    {
        $files = glob(self::SEEDS_PATH . '/*.php');
        $this->run($files);
    }

    private function run($files) {
        foreach ($files as $file) {
            require_once $file;
            $class = basename($file, '.php');
            $obj = new $class;
            $obj->run();
        }
    }
}
