<?php
require base_path('views/partials/head.php');
require base_path('views/partials/nav.php');
?>

  <main>
      <?php component('TicketsList.php', [
          'title'   => $title,
          'tickets' => $tickets,
      ]) ?>
  </main>
<?php
require base_path('views/partials/footer.php');
?>