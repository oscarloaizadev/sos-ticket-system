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

$query = 'SELECT name FROM companies WHERE id = :id';
$company = $db->query($query, ['id' => $ticket["company_id"]])->find();

$query = 'SELECT * FROM users WHERE id = :assigned_to';
$assignedTo = $db->query($query, ['assigned_to' => $ticket["assigned_to"]])->find();

$query = 'SELECT * FROM users WHERE id = :requester_id';
$requester = $db->query($query, ['requester_id' => $ticket["requester_id"]])->findOrFail();

$query = '
    SELECT th.*, u.name AS created_by
    FROM ticket_history th
    INNER JOIN users u ON th.user_id = u.id
    WHERE th.ticket_id = :id
    ORDER BY th.created_at DESC
';
$ticketHistory = $db->query($query, ['id' => $id])->get();

$query = 'SELECT id, name FROM users WHERE role IN (:technician, :super_user)';
$technicians = $db->query($query, ['technician' => 'technician', 'super_user' => 'super_user'])->get();

view("tickets/show.view.php", [
    'heading'       => 'Mis tickets',
    'user'          => $user,
    'company'       => $company,
    'ticket'        => $ticket,
    'ticketHistory' => $ticketHistory,
    'assignedTo'    => $assignedTo,
    'requester'     => $requester,
    'technicians'   => $technicians,
]);
