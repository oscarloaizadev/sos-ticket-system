<?php include('shared/Tickets.variables.php') ?>
<?php include('shared/Translations.variables.php') ?>

<div class="container mt-4 px-4 bg-light rounded-4 shadow-sm border border-light">
  <h4 class="mb-3 text-dark"><?= $title; ?></h4>
  <div class="row g-3">
      <?php
      foreach ($tickets as $ticket):
          $status = $ticket['status'];
          $colorClass = $statusColors[$status] ?? 'bg-danger';
          $statusText = $statusTranslations[$status] ?? 'Desconocido';
          ?>

        <div class="card mt-2 p-0 h-100 <?= $colorClass ?> rounded-3 shadow-sm text-decoration-none">
          <a href="<?= htmlspecialchars(urlRedirect('/ticket?id=' . $ticket['id'])) ?>"
             class="card-body align-content-center text-decoration-none">
            <div class="card-title">
              <h6 class="d-block m-0"><?= $ticket['subject'] ?></h6>
              <div class="d-flex justify-content-between align-items-center gap-2">
                <span class="opacity-50 fs-6"><?= $ticket['code'] ?></span>
                  <?php component('Badges.php', ['status' => $type]); ?>
              </div>
            </div>
            <div class="card-text lh-sm d-flex gap-2 justify-content-between">
              <div>
                <span class="opacity-75 d-block">Creado el</span>
                  <?= date('d/m/Y - H:i', strtotime($ticket['created_at'])) ?>
              </div>
              <div>
                <span class="opacity-75 d-block">Última actualización</span>
                  <?= date('d/m/Y - H:i', strtotime($ticket['updated_at'])) ?>
              </div>
            </div>
          </a>
        </div>
      <?php endforeach; ?>
  </div>
</div>