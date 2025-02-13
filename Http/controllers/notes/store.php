<?php

use Core\App;
use Core\Validator;
use Core\Database;
use Core\Session;

// Primero importamos todas las clases que dependen del contenedor de dependencias
$db = App::resolve(Database::class);

// Creamos todas las instancias de las clases que no dependen del contenedor
$session = new Session();

// Comenzamos con la lógica de nuestro controlador
$user = $session->getUser();
$errors = [];

if (!Validator::string($_POST['body'], 1, 1000)) {
    $errors['body'] = 'Se requiere una nota entre 1 y 1000 caracteres mínimo.';
}

if (!empty($errors)) {
    return view("notes/create.view.php", [
        'heading' => 'Crea tu nota',
        'errors'  => $errors,
    ]);
}

$query = 'INSERT INTO notes(body, user_id) VALUES(:body, :user_id)';
$db->query($query, [
    'body'    => $_POST['body'],
    'user_id' => $user['id'],
]);

header('location: ' . urlRedirect('/notes'));
die();
