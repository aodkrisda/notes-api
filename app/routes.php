<?php

$app->get('/', 'App\Action\HomeAction:dispatch')->setName('home');

$app->get('/notes', 'App\Action\Notes\IndexAction:dispatch')->setName('notes');

$app->post('/login', 'App\Action\LoginAction:dispatch')->setName('login');
