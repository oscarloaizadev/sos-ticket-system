<?php

use Core\App;
use Core\Database;
use Core\Session;
use Core\Authenticator;

$db = App::resolve(Database::class);

$session = new Session();
$auth = new Authenticator();

$user = $session->getUser();

// Obtener filtros desde GET (compatibles con PHP 8.1+)
$type = isset($_GET['type']) ? trim(htmlspecialchars($_GET['type'], ENT_QUOTES, 'UTF-8')) : null;
$category = isset($_GET['category']) ? trim(htmlspecialchars($_GET['category'], ENT_QUOTES, 'UTF-8')) : null;
$status = isset($_GET['status']) ? trim(htmlspecialchars($_GET['status'], ENT_QUOTES, 'UTF-8')) : null;
$priority = isset($_GET['priority']) ? trim(htmlspecialchars($_GET['priority'], ENT_QUOTES, 'UTF-8')) : null;
$owner = isset($_GET['owner']) ? trim(htmlspecialchars($_GET['owner'], ENT_QUOTES, 'UTF-8')) : null;

$title = 'Todos los tickets';

$params = [];
$conditions = [];

// Aplicar filtros si están definidos
if ($type && $type !== 'default') {
    $conditions[] = 'type = :type';
    $params['type'] = $type;
}
if ($category && $category !== 'default') {
    $conditions[] = 'category = :category';
    $params['category'] = $category;
}
if ($status && $status !== 'default') {
    $conditions[] = 'status = :status';
    $params['status'] = $status;
}
if ($priority && $priority !== 'default') {
    $conditions[] = 'priority = :priority';
    $params['priority'] = $priority;
}

if ($owner === '0') {
    $conditions[] = 'assigned_to = :assigned_to';
    $params['assigned_to'] = $user['id'];
    $title = 'Tickets asignados para tu gestión';
} else {
    $conditions[] = 'requester_id = :id';
    $params['id'] = $user['id'];
    $title = 'Tus tickets creados';
}

$query = 'SELECT * FROM tickets';
if (!empty($conditions)) {
    $query .= ' WHERE ' . implode(' AND ', $conditions);
}
$query .= ' ORDER BY created_at DESC';

$tickets = $db->query($query, $params)->get();

view("tickets/index.view.php", [
    'title'   => $title,
    'user'    => $user,
    'tickets' => $tickets,
]);
