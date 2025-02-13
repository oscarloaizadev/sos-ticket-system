<?php
use Core\App;
use Core\Database;
use Core\Session;
use Core\Authenticator;

$db = App::resolve(Database::class);

$session = new Session();
$auth = new Authenticator();

$code = htmlspecialchars("GZEA-0029");
$subject = htmlspecialchars($_POST['subject']);
$description = htmlspecialchars($_POST['description']);
$status = htmlspecialchars($_POST['status']);
$priority = htmlspecialchars($_POST['priority']);
$requesterId = htmlspecialchars($_POST['requester_id']);
$companyId = htmlspecialchars($_POST['company_id']);
$requestDate = htmlspecialchars($_POST['request_date']);

$query = "INSERT INTO tickets
    (code, subject, description, status, priority, requester_id, company_id, request_date)
       VALUES
    (:code, :subject, :description, :status, :priority, :requesterId, :companyId, :requestDate)";

$db->query($query, [
    'code'        => $code,
    'subject'     => $subject,
    'description' => $description,
    'status'      => $status,
    'priority'    => $priority,
    'requesterId' => $requesterId,
    'companyId'   => $companyId,
    'requestDate' => $requestDate,
]);

// Obtener el ID del ticket recién insertado
$query = 'SELECT id FROM tickets WHERE code = :code';
$ticketData = $db->query($query, ['code' => $code])->find();
$ticketId = $ticketData['id'] ?? null;

// Verificar que el ticket_id es válido antes de continuar
if (!$ticketId) {
    die("Error: No se pudo obtener el ID del ticket.");
}

$message = htmlspecialchars("Ticket creado y a la espera de su gestión.");

$query = 'INSERT INTO ticket_history
        (ticket_id, user_id, message, created_at)
            VALUES
        (:ticket_id, :user_id, :message, :created_at)';

$db->query($query, [
    'ticket_id'  => $ticketId,
    'user_id'    => $requesterId,
    'message'    => $message,
    'created_at' => $requestDate,
]);
