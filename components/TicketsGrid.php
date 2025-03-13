<?php
$ticketTypes = HELPER_getArray('translations', 'type');
$ticketCategories = HELPER_getArray('translations', 'category');
$ticketPriorities = HELPER_getArray('translations', 'priority');
?>

<?php if (!empty($tickets)): ?>
  <div class="container p-3 bg-light rounded-4 shadow-sm border border-light lh-sm">
    <div class="row">
      <div class="col mb-3 text-dark"><?= $title; ?></div>
    </div>
    <div class="row row-cols-2 g-3">
        <?php foreach ($tickets as $ticket):
            $status = $ticket['status'];
            $colorClass = HELPER_getClass('status', $status);
            $statusText = HELPER_getText('status', $status);
            ?>
          <div class="col col-md-4 col-lg-3">
            <a href="<?= htmlspecialchars(urlRedirect('/tickets?status=' . urlencode($status) . '&owner='
                                                      . urlencode($owner))) ?>"
               class="card h-100 <?= $colorClass ?> rounded-3 shadow-sm text-decoration-none">
              <div class="card-body align-content-center text-center">
                <h6 class="card-title"><?= $statusText ?></h6>
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
<?php endif; ?>

