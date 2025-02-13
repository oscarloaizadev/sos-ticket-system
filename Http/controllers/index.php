<?php

use Core\Database;
use Core\App;
use Core\Session;
use Core\Authenticator;

$db = App::resolve(Database::class);

$session = new Session();
$auth = new Authenticator();

$user = $session->getUser();

//$query = 'SELECT * FROM tickets WHERE requester_id = :id';
//$tickets = $db->query($query, ['id' => $user['id']])->get();

$query = 'SELECT status, COUNT(*) as count FROM tickets WHERE assigned_to = :id GROUP BY status';
$assignedTickets = $db->query($query, ['id' => $user['id']])->get();

$query = 'SELECT status, COUNT(*) as count FROM tickets WHERE requester_id = :id GROUP BY status';
$requesterTickets = $db->query($query, ['id' => $user['id']])->get();

view("index.view.php", [
    'heading'          => 'Inicio',
    'user'             => $user,
    'assignedTickets'  => $assignedTickets,
    'requesterTickets' => $requesterTickets,
]);