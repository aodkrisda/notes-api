<?php
use Illuminate\Database\Capsule\Manager as Capsule;

$settings = $container->get('settings');

$capsule = new Capsule;
$capsule->addConnection($settings['db']);

// Make this Capsule instance available globally via static methods
$capsule->setAsGlobal();
// Setup the Eloquent ORM
$capsule->bootEloquent();

date_default_timezone_set($settings['timezone']);
