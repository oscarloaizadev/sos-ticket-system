<?php

use Core\App;
use Core\Container;
use Core\Database;

/**
 * Inicializa el contenedor de dependencias y registra las dependencias
 * necesarias.
 *
 * @return void
 */
$container = new Container();

/**
 * Registra la dependencia para la clase Database.
 *
 * @return void
 */
$container->bind('Core\\Database', function () {
    $config = require base_path('config.php');
    
    return new Database($config['database']);
});

$container->bind('Htpp\\Services\\LDAPService', function () {
    $config = require base_path('Http/Services/LDAPService/config/config.php');
    
    return new \App\Services\LDAPService($config['database']);
});

// Asocia la instancia del contenedor a la clase App para acceso global.
App::setContainer($container);
