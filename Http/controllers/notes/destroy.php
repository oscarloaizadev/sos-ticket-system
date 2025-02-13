<?php

use Core\App;
use Core\Database;
use Core\Session;
use Core\Authenticator;

$db = App::resolve(Database::class);

$session = new Session();
$auth = new Authenticator();

$user = $session->getUser();

$query = 'SELECT * FROM notes WHERE id = :id';
$note = $db->query($query, ['id' => $_POST['id']])->findOrFail();

$auth->authorize($note['user_id'] === $user['id']);

$query = 'DELETE FROM notes WHERE id = :id';
$db->query($query, ['id' => $_POST['id']]);

header('location: ' . urlRedirect('/notes'));
exit();
