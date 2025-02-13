<?php
require base_path('views/partials/head.php');
require base_path('views/partials/nav.php');
?>

  <main class="container px-0 my-4">
      <?php component('TicketsList.php', [
          'title'   => "Estado de tus solicitudes",
          'tickets' => $tickets,
          'type'    => $type,
      ]) ?>
  </main>
<?php
require base_path('views/partials/footer.php');
?>