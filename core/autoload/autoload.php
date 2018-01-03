<?php

class Autoload{

    private $autoloadable = [];

    public function register($name, $loader = false){
        if( is_callable($loader) || $loader == false){
            $this->autoloadable[$name] = $loader;
            return;
        }
        throw new Exception('Loader must be callable '.$name);
    }

    public function load($name){
        $name = strtolower($name);
        $filepath = BASEPATH.'/core/'.$name.'/'.$name.'.php';
        if( !empty($this->autoloadable[$name]) ){
            return $this->autoloadable[$name]($name);
        }
        if( file_exists($filepath) ){
            return require($filepath);
        }
        throw new Exception($name.' is not loaded or registred for autoloading');
    }

    //Method register enables us to register a class to be loaded using a custom loader, which is a function called when class is required to be loaded. Load method is called by splautoloadregister function, which is shown below. Everytime when we request a class which is not yet available for us, splautoloadregister calls our load method in order to load the requested class. If we haven't registred the class which is requested to be loaded, autoloader attempts to load it by following a basic standart: core/classname/classname.php
}