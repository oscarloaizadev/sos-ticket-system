<?php
use Core\App;
use Core\Database;
use Core\Authenticator;
use Core\Session;

$db = App::resolve(Database::class);

$session = new Session();
$auth = new Authenticator();

$user = $session->getUser();

$query = 'SELECT * FROM notes WHERE id = :id';
$note = $db->query($query, ['id' => $_GET['id']])->findOrFail();

$auth->authorize($note['user_id'] === $user['id']);

view("notes/edit.view.php", [
    'heading' => 'Editar nota',
    'errors'  => [],
    'note'    => $note,
]);