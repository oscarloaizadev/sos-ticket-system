<?php

$router->get('/', 'index.php')->only("auth");
$router->get('/home', 'authorized/index.php')->only("auth");
$router->get('/about', 'about.php');
$router->get('/contact', 'contact.php');

$router->get('/tickets', 'tickets/index.php')->only("auth");
$router->get('/ticket/new', 'tickets/create.php')->only("auth");
$router->post('/ticket/store', 'tickets/store.php')->only('auth');
$router->post('/ticket/update', 'tickets/update.php')->only("auth");
$router->get('/ticket', 'tickets/show.php')->only("auth");

$router->get('/notes', 'notes/index.php')->only('auth');
$router->get('/note', 'notes/show.php')->only('auth');
$router->delete('/note', 'notes/destroy.php')->only('auth');

$router->get('/note/edit', 'notes/edit.php')->only('auth');
$router->patch('/note', 'notes/update.php')->only('auth');

$router->get('/notes/create', 'notes/create.php')->only('auth');
$router->post('/notes', 'notes/store.php')->only('auth');

// Registro de usuarios
$router->get('/register', 'registration/create.php')->only('guest');
$router->post('/register', 'registration/store.php')->only('guest');

// Manejo de sesiones
$router->get('/login', 'session/create.php')->only('guest');
$router->post('/login', 'session/store.php')->only('guest');
$router->delete('/logout', 'session/destroy.php')->only('auth');
