<?php

namespace Core\Middleware;

use Core\Authenticator;

class Authenticated
{
    
    public function handle()
    {
        if (!isset($_SESSION['user']['username']) || trim($_SESSION['user']['username']) === '') {
            if (trim($_SESSION['user']['username']) === '') {
                (new Authenticator())->logout();
            }
            header('Location: ' . BASE_ROUTE . '/login');
            exit();
        }
    }
    
}
