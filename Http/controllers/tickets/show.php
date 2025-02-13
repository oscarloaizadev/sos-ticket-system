<?php

use Core\App;
use Core\Database;
use Core\Session;
use Core\Authenticator;

$db = App::resolve(Database::class);

$session = new Session();
$auth = new Authenticator();

$user = $session->getUser();

$id = htmlspecialchars($_GET['id']);

$query = 'SELECT * FROM tickets WHERE id = :id';
$ticket = $db->query($query, ['id' => $id])->findOrFail();

$query = 'SELECT * FROM ticket_history WHERE ticket_id = :id ORDER BY created_at DESC';
$ticketHistory = $db->query($query, ['id' => $id])->get();

view("tickets/show.view.php", [
    'heading'       => 'Mis tickets',
    'user'          => $user,
    'ticket'        => $ticket,
    'ticketHistory' => $ticketHistory,
]);
