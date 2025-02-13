<?php

use Core\App;
use Core\Database;
use Core\Session;
use Core\Authenticator;

$db = App::resolve(Database::class);

$session = new Session();
$auth = new Authenticator();

$user = $session->getUser();

$type = htmlspecialchars($_GET['type']);

$query = 'SELECT * FROM tickets WHERE status = :type';
$tickets = $db->query($query, ['type' => $type])->get();

view("tickets/index.view.php", [
    'heading' => 'Mis tickets',
    'user'    => $user,
    'tickets' => $tickets,
    'type'    => $type,
]);
