<?php
const IS_PRODUCTION_ENV = true;
const APPLICATION_VERSION = '0.2-alpha';

if (IS_PRODUCTION_ENV) {
    define('BASE_ROUTE', '/sos/simple-tickets');
} else {
    define('BASE_ROUTE', '/ruta/del/servidor');
}

use Core\Session;
use Core\ValidationException;

const BASE_PATH = __DIR__ . '/../';

session_start();

require BASE_PATH . 'vendor/autoload.php';
require BASE_PATH . 'Core/functions.php';
require BASE_PATH . 'bootstrap.php';

$router = new \Core\Router();
require BASE_PATH . 'routes.php';

$uri = parse_url($_SERVER['REQUEST_URI'])['path'];
$method = $_POST['_method'] ?? $_SERVER['REQUEST_METHOD'];

try {
    $router->route($uri, $method);
} catch (ValidationException $exception) {
    Session::flash('errors', $exception->errors);
    Session::flash('old', $exception->old);
    
    return redirect($router->previousUrl());
}

Session::unflash();


