<?php

use Core\App;
use Core\Database;
use Core\Validator;
use Core\Session;
use Core\Authenticator;

$db = App::resolve(Database::class);

$session = new Session();
$auth = new Authenticator();

$user = $session->getUser();

$query = 'SELECT * FROM notes WHERE id = :id';
$note = $db->query($query, ['id' => $_POST['id']])->findOrFail();

$auth->authorize($note['user_id'] === $user['id']);

$errors = [];

if (!Validator::string($_POST['body'], 1, 1000)) {
    $errors['body'] = 'Tu nota debe contener un mínimo de 1 y un máximo de 1000 caracteres.';
}

if (count($errors)) {
    return view('notes/edit.view.php', [
        'heading' => 'Edit Note',
        'errors'  => $errors,
        'note'    => $note,
    ]);
}

$query = 'UPDATE notes SET body = :body WHERE id = :id';
$db->query($query, [
    'id'   => $_POST['id'],
    'body' => $_POST['body'],
]);

header('location:' . urlRedirect('/notes'));
die();
