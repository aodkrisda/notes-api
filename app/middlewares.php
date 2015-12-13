<?php

$app->add( new App\Middleware\JSON() );
$app->add( new App\Middleware\Auth() );
