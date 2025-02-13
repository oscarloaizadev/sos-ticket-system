<?php
require base_path('views/partials/head.php');
require base_path('components/shared/Translations.variables.php');

$statusText = $statusTranslations[$ticket["status"]] ?? 'Desconocido';
$priorityText = $priorityTranslations[$ticket["priority"]] ?? 'Desconocido';
$typeText = $ticketTypes[$ticket["type"]] ?? 'Desconocido';
?>

<nav class="navbar text-center bg-light shadow-sm p-0">
  <div
    class="container my-2 my-xl-3 text-center navbar-nav d-flex gap-2 flex-row align-items-center justify-content-between">
    <a href="#" class="btn btn-light">&larr; Back</a>
    <h5 class="m-0">Ticket: "<?= htmlspecialchars($ticket["code"]); ?>"</h5>
  </div>
</nav>

<div class="container d-flex flex-column gap-4 mx-2 my-4">
  <div class="d-flex flex-column gap-2">
    <h3 class="m-0">Detalles</h3>
    <div><b class="d-block">Fecha de solicitud</b> <?= htmlspecialchars($ticket["request_date"]); ?></div>
    <div><b class="d-block">Tipo</b> <?= htmlspecialchars($typeText); ?></div>
    <div><b class="d-block">Estado</b> <?= htmlspecialchars($statusText); ?></div>
    <div><b class="d-block">Categoría</b> <?= htmlspecialchars($priorityText); ?></div>
    <div><b class="d-block">Asignado a</b> <?= htmlspecialchars($ticket["assigned_to"]); ?></div>
    <div><b class="d-block">Solicitado por</b> <?= htmlspecialchars($ticket["requester_id"]); ?></div>
  </div>
  <div class="d-flex flex-column gap-2">
    <h3 class="m-0">Descripción</h3>
    <div><?= htmlspecialchars($ticket["description"]); ?></div>
  </div>
  <div>
    <h3 class="m-0">Historial</h3>
      <?php foreach ($ticketHistory as $history) : ?>
        <div>
          <b class="d-block">Comentario realizado el: </b> <?= htmlspecialchars($history["created_at"]); ?>
          <div><?= htmlspecialchars($history["message"]); ?></div>
        </div>
      <?php endforeach; ?>
  </div>
</div>