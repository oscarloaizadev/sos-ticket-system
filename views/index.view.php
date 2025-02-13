<?php require('partials/head.php') ?>
<?php require('partials/nav.php') ?>

<main class="container px-3 my-4 px-md-0">
  <pre><?php var_dump($user ?? 'Usuario no definido'); ?></pre>
    
    <?php component('TicketsGrid.php', [
        'title'   => "Estado de tus solicitudes",
        'tickets' => $requesterTickets,
    ]) ?>
    
    <?php component('TicketsGrid.php', [
        'title'   => "Panel de tickets por gestionar",
        'tickets' => $assignedTickets,
    ]) ?>
</main>

<?php require('partials/footer.php') ?>
