<?php

function dd($value)
{
    echo "<pre>";
    var_dump($value);
    echo "</pre>";
    
    die();
}

function urlIs($value)
{
    return $_SERVER['REQUEST_URI'] === $value;
}

function abort($code = 404, $message = null)
{
    http_response_code($code);
    
    $message;
    require base_path("views/{$code}.php");
    
    die();
}

/*function authorize($condition, $status = Response::FORBIDDEN)
{
    if (!$condition) {
        abort($status);
    }
    
    return true;
}*/

/**
 * Genera una ruta completa relativa a la raíz del proyecto.
 *
 * Esta función toma una ruta relativa proporcionada como parámetro
 * y la concatena con la constante `BASE_PATH`, que debe representar
 * la raíz del proyecto. Devuelve la ruta completa resultante.
 *
 * @param  string  $path  La ruta relativa a la raíz del proyecto.
 *                      Ejemplo: '/carpeta/archivo.php'.
 *
 * @return string La ruta completa generada concatenando `BASE_PATH` con `$path`.
 */
function base_path($path)
{
    return BASE_PATH . $path;
}

function view($path, $attributes = [])
{
    extract($attributes);
    
    require base_path('views/' . $path);
}

function component($path, $attributes = [])
{
    extract($attributes);
    
    require base_path('components/' . $path);
}

function redirect($path)
{
    header("location: {$path}");
    exit();
}

function urlRedirect($path = '')
{
    return BASE_ROUTE . $path;
}

function old($key, $default = '')
{
    return Core\Session::get('old')[$key] ?? $default;
}