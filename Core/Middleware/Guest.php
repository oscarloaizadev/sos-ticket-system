<?php

namespace Core\Middleware;
use Core\Session;

class Guest
{
    public function handle()
    {
        if (isset($_SESSION['user'])) {
            header('Location: ' . BASE_ROUTE);
            exit();
        }
    }
}
