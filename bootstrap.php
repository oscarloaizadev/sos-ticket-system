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
    $config = require base_path('config/connection/config.php');
    
    return new Database($config['database']);
});

// Asocia la instancia del contenedor a la clase App para acceso global.
App::setContainer($container);
