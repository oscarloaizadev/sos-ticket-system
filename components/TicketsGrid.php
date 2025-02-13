<?php include('shared/Tickets.variables.php') ?>
<?php include('shared/Translations.variables.php') ?>

<div class="container mt-4 p-3 bg-light rounded-4 shadow-sm border border-light">
  <h4 class="mb-3 text-dark"><?= $title; ?></h4>
  <div class="row row-cols-2 g-3">
      <?php
      foreach ($tickets as $ticket):
          $status = $ticket['status'];
          $colorClass = $statusColors[$status] ?? 'bg-danger';
          $statusText = $statusTranslations[$status] ?? 'Desconocido';
          ?>
        <div class="col col-md-4 col-lg-3">
          <a href="<?= htmlspecialchars(urlRedirect('/tickets?type=' . $status)) ?>"
             class="card h-100 <?= $colorClass ?> rounded-3 shadow-sm text-decoration-none">
            <div class="card-body align-content-center text-center">
              <h5 class="card-title"><?= $statusText ?></h5>
              <div class="d-flex align-items-center justify-content-center gap-2">
                <span class="badge bg-light text-dark"><?= $ticket['count'] ?? 0 ?></span>
                <span class="badge bg-light text-dark d-flex align-content-center justify-content-center">
                  Ver todos
                  <span class="material-symbols-rounded" style="font-size: 14px">arrow_right_alt</span>
                </span>
              </div>
            </div>
          </a>
        </div>
      <?php endforeach; ?>
  </div>
</div>