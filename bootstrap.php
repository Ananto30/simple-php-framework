<?php

require('config.php');

require('core/autoload/autoload.php');

$autoloader = new Autoload();

spl_autoload_register([$autoloader, 'load']);

$autoloader->register('viewloader', function(){
    return require(BASEPATH.'/core/view/viewLoader.php');
});

$view = new View( new ViewLoader(BASEPATH.'/views/') ); 

//As we can see, both View & ViewLoader are being lazyloaded (loaded on demand), so we don't have to call require everytime we want to use them. They get loaded either by standart (core/...) or by registred loader ($autoloader->register...)

$router = new Router();