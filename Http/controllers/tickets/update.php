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
    $id = $_POST['VAFq1F6R'] ?? '';
    $requesterId = $_POST['cNnKa1tU'] ?? '';
    $assignedTo = $_POST['Cjc4ATMw'] ?? '';
    $editordata = $_POST['editordata'] ?? '';
    
    if (empty($id) || empty($requesterId) || empty($editordata)) {
        throw new Exception('Bad request');
    }
    
    $ticket = $db->query(
        "SELECT id, requester_id, assigned_to FROM tickets WHERE id = :id",
        ['id' => $id],
    )->find();
    
    if (!$ticket) {
        throw new Exception('Ticket no encontrado');
    }
    
    $db->query(
        "INSERT INTO ticket_history (ticket_id, user_id, message, created_at)
         VALUES (:ticket_id, :user_id, :message, :created_at)",
        [
            'ticket_id'  => $id,
            'user_id'    => $user['id'],
            'message'    => $editordata,
            'created_at' => date('Y-m-d H:i:s'),
        ],
    );
    
    $fields = [
        'status'      => $_POST['status'] ?? false,
        'type'        => $_POST['type'] ?? false,
        'category'    => $_POST['category'] ?? false,
        'priority'    => $_POST['priority'] ?? false,
        'assigned_to' => $_POST['assigned_to'] ?? false,
    ];
    
    $setClauses = [];
    $params = ['id' => $id];
    
    foreach ($fields as $column => $value) {
        if ($value && $value !== 'default') {
            $setClauses[] = "$column = :$column";
            $params[$column] = htmlspecialchars($value);
        }
    }
    
    if (!empty($setClauses)) {
        $sql = "UPDATE tickets SET " . implode(', ', $setClauses) . " WHERE id = :id";
        $db->query($sql, $params);
    }
    
    echo json_encode([
                         'success' => true,
                         'message' => 'Ticket actualizado correctamente',
                     ]);
} catch (Exception $e) {
    // Respuesta de error
    echo json_encode([
                         'success' => false,
                         'message' => $e->getMessage(),
                     ]);
}
