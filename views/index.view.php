<?php require('partials/head.php') ?>
<?php require('partials/nav.php') ?>

<main class="container mt-4 d-flex flex-column gap-4 px-3 px-md-0">
  <div class="container px-3 py-2 text-center bg-light rounded-4 shadow-sm border border-light">
    <span class="m-0 fw-bold">¡Bienvenid@, <?= $user['username'] ?>!</span>
    <span>Tienes
        <?= component('Badges.php',
                      [
                          'status' => 'dark',
                          'text'   => $totalRequesterTickets,
                      ]) ?>
        <?= $totalRequesterTickets == 1 ? 'ticket abierto.'
            : 'tickets abiertos.' ?></span>
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
</main>

<?php require('partials/footer.php') ?>
