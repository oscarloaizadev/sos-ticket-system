<?php
header('Content-Type: application/json');

use Core\App;
use Core\Database;
use Core\Session;
use Core\Authenticator;

$db = App::resolve(Database::class);
$session = new Session();
$auth = new Authenticator();

$user = $session->getUser();

try {
    $requiredFields = ['subject', 'description', 'status', 'priority', 'requester_id', 'company_id', 'request_date'];
    
    foreach ($requiredFields as $field) {
        if (!isset($_POST[$field]) || empty($_POST[$field])) {
            echo json_encode(['success' => false, 'message' => "El campo $field es obligatorio."]);
            exit;
        }
    }
    
    $subject = htmlspecialchars($_POST['subject']);
    $description = htmlspecialchars($_POST['description']);
    $status = htmlspecialchars($_POST['status']);
    $priority = htmlspecialchars($_POST['priority']);
    $requesterId = (int) htmlspecialchars($_POST['requester_id']);
    $companyId = (int) htmlspecialchars($_POST['company_id']);
    $requestDate = htmlspecialchars($_POST['request_date']);
    
    $companyQuery = "SELECT prefix FROM companies WHERE id = :companyId";
    $companyData = $db->query($companyQuery, ['companyId' => $companyId])->find();
    
    if (!$companyData) {
        echo json_encode(['success' => false, 'message' => "No se encontró la compañía."]);
    }
    
    $prefix = $companyData['prefix'];
    
    $lastCodeQuery = "SELECT code FROM tickets WHERE code LIKE :prefix ORDER BY id DESC LIMIT 1";
    $lastCodeData = $db->query($lastCodeQuery, ['prefix' => "$prefix-%"])->find();
    
    if ($lastCodeData) {
        preg_match('/(\d+)$/', $lastCodeData['code'], $matches);
        $number = isset($matches[1]) ? intval($matches[1]) : 0;
        
        $newNumber = $number + 1;
    } else {
        $newNumber = 1;
    }
    
    // Generar el nuevo código asegurando 4 dígitos
    $code = $prefix . "-" . str_pad($newNumber, 4, "0", STR_PAD_LEFT);
    
    // Insertar el ticket en la base de datos
    $query = "INSERT INTO tickets (code, subject, description, status, priority, requester_id, company_id, request_date)
              VALUES (:code, :subject, :description, :status, :priority, :requesterId, :companyId, :requestDate)";
    
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
    
    $query = "SELECT id FROM tickets WHERE code = :code";
    $ticketData = $db->query($query, ['code' => $code])->find();
    
    $ticketId = $ticketData['id'] ?? null;
    
    if (!$ticketId) {
        echo json_encode([
                             'success' => false,
                             'message' => "No se pudo obtener el ID del ticket después de la inserción.",
                         ]);
        exit;
    }
    
    // Agregar historial del ticket
    $message = "Ticket creado y a la espera de su gestión.";
    $query = "INSERT INTO ticket_history (ticket_id, user_id, message, created_at)
              VALUES (:ticket_id, :user_id, :message, :created_at)";
    
    $db->query($query, [
        'ticket_id'  => $ticketId,
        'user_id'    => $requesterId,
        'message'    => htmlspecialchars($message),
        'created_at' => $requestDate,
    ]);
    
    // Respuesta exitosa
    echo json_encode([
                         'success'   => true,
                         'message'   => "Ticket creado exitosamente.",
                         'ticket_id' => $ticketId,
                         'redirect'  => urlRedirect("/ticket?id=" . $ticketId),
                     ]);
} catch (Exception $e) {
    echo json_encode([
                         'success' => false,
                         'message' => "Error en el servidor: " . $e->getMessage(),
                     ]);
}
