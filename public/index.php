<?php

require '../app/vendor/autoload.php';

$app = new \Slim\Slim(array(
    'mode' => 'development',
    'templates.path' => '../app/views'
));

$app->get('/', function() use($app) {
    $app->render('index.php');
});

$app->get('/domaines', function() use($app) {
    echo $app->render('index.php');
});

$app->run();