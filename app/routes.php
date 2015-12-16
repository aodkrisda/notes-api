<?php

$app->get('/', 'App\Action\HomeAction:dispatch')->setName('home');

$app->get('/notes', 'Notes\IndexAction:dispatch')->setName('notes');
$app->get('/notes/{id:[0-9]+}', 'Notes\IndexAction:dispatch')->setName('single-notes');
$app->post('/notes', 'Notes\SaveAction:dispatch')->setName('add-notes');
$app->put('/notes/{id:[0-9]+}', 'Notes\SaveAction:dispatch')->setName('update-notes');
$app->delete('/notes', 'Notes\DeleteAction:dispatch')->setName('del-notes');
$app->delete('/notes/{id:[0-9]+}', 'Notes\DeleteAction:dispatch')->setName('del-one-notes');

$app->post('/login', 'App\Action\LoginAction:dispatch')->setName('login');
