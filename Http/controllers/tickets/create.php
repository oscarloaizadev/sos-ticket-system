<?php

use Core\App;
use Core\Database;
use Core\Session;
use Core\Authenticator;

$db = App::resolve(Database::class);

$session = new Session();
$auth = new Authenticator();

$user = $session->getUser();

$companyId = $user['company_id'];
$requesterId = $user['id'];

/* TODO:
    Hace falta definir adecuadamente el ID de la persona a la que se le va a asignar el ticket
*/
$assignedTo = 0;

$status = 'pending';

view("tickets/create.view.php", [
    'heading'     => 'Crea tu ticket',
    'companyId'   => $companyId,
    'requesterId' => $requesterId,
    'assignedTo'  => $assignedTo,
    'status'      => $status,
    'errors'      => [],
]);