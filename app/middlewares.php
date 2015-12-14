<?php

$app->add( new App\Middleware\Auth( $app ) );
$app->add( new App\Middleware\JSON() );
