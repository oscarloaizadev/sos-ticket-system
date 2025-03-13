<?php require('partials/head.php') ?>
<?php require('partials/nav.php') ?>

<?php $user = (new Core\Session())->getUser(); ?>

<main>
  <div class="container px-3 py-2 text-center bg-light rounded-4 shadow-sm border border-light">
    <div class="m-0 mb-2 fw-bold">¡Bienvenid@, <?= $user['name'] ?>! (<?= $user['company'] ?>)</div>
    <div class="row justify-content-center gap-2">
      <div class="col-12 col-md-auto">
    <span class="alert alert-info m-0 py-1 rounded-pill w-100 d-block text-center">Haz creado
      <?= component('Badges.php',
                    [
                        'status' => 'info',
                        'text'   => $totalRequesterTickets,
                    ]) ?>
        <?= $totalRequesterTickets == 1 ? 'ticket que sigue abierto.' : 'tickets que siguen abiertos.' ?>
    </span>
      </div>

      <div class="col-12 col-md-auto">
    <span class="alert alert-info m-0 py-1 rounded-pill w-100 d-block text-center">Tienes asignado
      <?= component('Badges.php',
                    [
                        'status' => 'info',
                        'text'   => $totalAssignedTickets,
                    ]) ?>
        <?= $totalAssignedTickets == 1 ? 'ticket esperando tu gestión.' : 'tickets esperando tu gestión.' ?>
    </span>
      </div>
        <?php if ($user['role'] == 'admin' || $user['role'] == 'technician' || $user['role'] == 'super_user'): ?>

          <div class="col-12 col-md-auto">
    <span class="alert alert-danger m-0 py-1 rounded-pill w-100 d-block text-center">Cuidado, hay
      <?= component('Badges.php',
                    [
                        'status' => 'denied',
                        'text'   => $totalWithoutAssigned,
                    ]) ?>
        <?= $totalWithoutAssigned == 1 ? 'ticket ' : 'tickets ' ?> sin un técnico asignado. Por favor, realiza la gestión necesaria.
    </span>
          </div>
        <?php endif; ?>
    </div>

  </div>
    
    <?php component('TicketsGrid.php', [
        'title'   => "Tickets creados por ti",
        'tickets' => $requesterTickets,
        'owner'   => '1',
    ]) ?>
    
    <?php component('TicketsGrid.php', [
        'title'   => "Tickets esperando tu gestión",
        'tickets' => $assignedTickets,
        'owner'   => '0',
    ]) ?>
    
    <?php if ($user['role'] == 'admin' || $user['role'] == 'technician' || $user['role'] == 'super_user'): ?>
        <?php component('TicketsGrid.php', [
            'title'   => "Tickets sin un técnico asignado",
            'tickets' => $withoutAssigned,
            'owner'   => 'unassigned',
        ]) ?>
    <?php endif; ?>
</main>

<?php require('partials/footer.php') ?>
