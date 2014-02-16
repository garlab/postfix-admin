<?php

require '../app/vendor/autoload.php';

$app = new \Slim\Slim(array(
    'templates.path' => '../app/views'
));

$app->get('/', function() use($app) {
    $app->render('index.php');
});

$app->run();