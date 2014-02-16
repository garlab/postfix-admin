<?php

require '../app/vendor/autoload.php';

$app = new \Slim\Slim(array(
    'mode' => 'development',
    'templates.path' => '../app/views'
));

/* Hooks */

$app->hook('slim.before.dispatch', function () use ($app) {
	$app->render('header.php');
});
  
$app->hook('slim.after.dispatch', function () use ($app) {
	$app->render('footer.php');
});

/* Routes */

$app->get('/', function() use($app) {
    $app->render('home.php');
});

$app->run();