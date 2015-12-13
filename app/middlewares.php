<?php

$app->add( new App\Middleware\Auth() );
$app->add( new App\Middleware\JSON() );
