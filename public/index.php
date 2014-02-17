<?php

require '../app/vendor/autoload.php';

spl_autoload_register(function($class) {
    $path = "../app/models/$class.php";
    if (is_file($path)) {
        require $path;
    }
});

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

$app->get('/alias', function() use($app) {
    $aliases = AliasDao::getAll();
    $app->render('alias.php', array('aliases' => $aliases));
});

$app->get('/comptes', function() use($app) {
    $app->render('comptes.php');
});

$app->get('/domaines', function() use($app) {
    $domaines = DomainesDao::getAll();
    $app->render('domaines.php', array('domaines' => $domaines));
});

$app->run();