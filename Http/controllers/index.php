<?php

use Core\Database;
use Core\App;
use Core\Session;
use Core\Authenticator;

$db = App::resolve(Database::class);

$session = new Session();
$auth = new Authenticator();

$user = $session->getUser();

$query = 'SELECT status, COUNT(*) as count FROM tickets WHERE assigned_to = :id GROUP BY status';
$assignedTickets = $db->query($query, ['id' => $user['id']])->get();

$totalAssignedTickets = 0;
foreach ($assignedTickets as $ticket) {
    $totalAssignedTickets += $ticket['count'];
}

$query = 'SELECT status, COUNT(*) as count FROM tickets WHERE requester_id = :id GROUP BY status';
$requesterTickets = $db->query($query, ['id' => $user['id']])->get();

$totalRequesterTickets = 0;
foreach ($requesterTickets as $ticket) {
    $totalRequesterTickets += $ticket['count'];
}

$query = 'SELECT status, COUNT(*) as count FROM tickets WHERE assigned_to IS NULL GROUP BY status';
$withoutAssigned = $db->query($query)->get();

$totalWithoutAssigned = 0;
foreach ($withoutAssigned as $ticket) {
    $totalWithoutAssigned += $ticket['count'];
}

view("index.view.php", [
    'heading'               => 'Inicio',
    'user'                  => $user,
    'assignedTickets'       => $assignedTickets,
    'totalAssignedTickets'  => $totalAssignedTickets,
    'requesterTickets'      => $requesterTickets,
    'totalRequesterTickets' => $totalRequesterTickets,
    'withoutAssigned'       => $withoutAssigned,
    'totalWithoutAssigned'  => $totalWithoutAssigned,
]);