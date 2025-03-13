<?php

use Core\Session;

/*
use Core\App;
use Core\Database;

// Creamos la instancia de la base de datos
$db = App::resolve(Database::class);

$newPassword = '123456789';
$hashedPassword = password_hash($newPassword, PASSWORD_BCRYPT);

// Actualizar contraseña en la base de datos
$db->query(
    "UPDATE users SET password = :password WHERE id = :user_id",
    ['password' => $hashedPassword, 'user_id' => 3],
);
*/

view('session/create.view.php', [
    'heading' => 'Bienvenid@ a nuestra mesa de ayuda',
    'errors'  => Session::get('errors'),
]);


