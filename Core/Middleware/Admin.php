<?php

namespace Core\Middleware;
use Core\Authenticator;
use Core\Response;

class Admin
{
    const ADMIN = [
        "sseguram",
        "smendozr",
        "srojasga",
        "jrodrsal",
        "wperezz",
        "jrodriguez",
        "ygomezru",
        "jvelasgu",
        "yquirozc",
        "wochoaar",
        "mhenaoa",
        "dvelaa",
        "oloaizc",
        "ADMIN_TEST"
    ];

    public function handle()
    {
        // Verificar si 'user' no está definida o es una cadena vacía
        if (!isset($_SESSION['user']) || trim($_SESSION['user']) === '') {
            if (trim($_SESSION['user']) === '') {
                (new Authenticator)->logout();
            }
            header('Location: ' . BASE_ROUTE . '/login');
            exit();
        }
        // Verificar si 'user' no está en la lista de ADMIN
        else if (!$this->isAdmin()) {
            abort(Response::NOT_FOUND);
            exit();
        }
    }

    public function isAdmin()
    {
        if (in_array($_SESSION['user'], self::ADMIN)) {
            return true;
        }
    }
}
