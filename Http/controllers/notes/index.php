<?php

use Core\App;
use Core\Database;
use Core\Session;

$db = App::resolve(Database::class);

$session = new Session();

$user = $session->getUser();

$query = 'SELECT * FROM notes WHERE user_id = :id';
$notes = $db->query($query, ['id' => $user['id']])->get();

view("notes/index.view.php", [
    'heading' => 'Mis notas',
    'notes'   => $notes,
]);
