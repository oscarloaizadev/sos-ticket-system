<div
  class="container d-flex flex-column gap-3 p-3 pe-2 bg-light rounded-4 shadow-sm border border-light lh-sm position-relative h-100 overflow-hidden">
  <div class="position-sticky top-0 bg-light p-0 z-10">
    <h4 class="m-0 text-dark">
        <?= $title; ?>
    </h4>
    <div data-badges></div>
  </div>
    <?php
    if (!empty($tickets)): ?>
      <section class="flex-grow-1 overflow-auto">
        <div class="row gap-2 m-0 pe-2">
            <?php foreach ($tickets as $key => $ticket):
                $status = $ticket['status'];
                $colorClass = HELPER_getClass('status', $status);
                $statusText = HELPER_getText('status', $status);
                $category = HELPER_getText('category', $ticket['category']);
                $priority = HELPER_getText('priority', $ticket['priority']);
                $type = HELPER_getText('type', $ticket['type']);
                ?>

              <div class="card <?= ($key === array_key_first($tickets)) ? 'm-0'
                  : '' ?> p-0 h-100 <?= $colorClass ?> rounded-3 shadow-sm text-decoration-none">
                <a href="<?= htmlspecialchars(urlRedirect('/ticket?id=' . $ticket['id'])) ?>"
                   class="card-body align-content-center text-decoration-none py-2">
                  <div class="card-title">
                    <h6 class="d-block m-0"><?= $ticket['subject'] ?></h6>
                    <div class="d-flex justify-content-between align-items-center gap-2">
                      <span class="opacity-75 fs-7"><?= $ticket['code'] ?></span>
                    </div>
                  </div>
                  <div class="card-text lh-sm d-flex gap-2 justify-content-between mb-2">
                    <div>
                      <span class="opacity-75 d-block fs-7">Creado el</span>
                      <span class="d-block fs-7"><?= formatDate($ticket['created_at']) ?></span>
                    </div>
                    <div>
                      <span class="opacity-75 d-block fs-7">Última actualización</span>
                      <span class="d-block fs-7"><?= formatDate($ticket['updated_at']) ?></span>
                    </div>
                    <div>
                      <span class="opacity-75 d-block fs-7">Estado</span>
                      <span class="d-block fs-7"><?php component('Badges.php', ['status' => $status]); ?></span>
                    </div>
                  </div>
                  <div class="card-text lh-sm d-flex gap-2 justify-content-between mb-0">
                    <div>
                      <span class="opacity-75 d-block fs-7">Tipo</span>
                      <span class="d-block fs-7"><?= $type; ?></span>
                    </div>
                    <div>
                      <span class="opacity-75 d-block fs-7">Categoría</span>
                      <span class="d-block fs-7"><?= $category; ?></span>
                    </div>
                    <div>
                      <span class="opacity-75 d-block fs-7">Prioridad</span>
                      <span class="5 d-block fs-7"><?= $priority; ?></span>
                    </div>
                  </div>
                </a>
              </div>
            <?php endforeach; ?>
        </div>
      </section>
    <?php else: ?>
      <div class="alert alert-warning m-0" role="alert">
        <div class="card-body align-content-center text-decoration-none">
          <div class="card-title">
            <h6 class="d-block m-0">No hay tickets que coincidan con los criterios de búsqueda seleccionados.</h6>
          </div>
        </div>
      </div>
      <div class="d-flex flex-column gap-2">
        <a href="<?= urlRedirect('/') ?>" class="btn btn-outline-dark border rounded-4 p-2">
            <?= HELPER_getIcon('ui', "back"); ?> Volver al inicio
        </a>
        <button
          class="btn btn-primary border rounded-4 p-2" data-bs-toggle="modal" data-bs-target="#exampleModal">
          <span class="material-symbols-rounded fs-2 align-content-center">search</span>
          Realizar otra búsqueda
        </button>
      </div>
    <?php endif; ?>
</div>

<script defer>
  $(document).ready(function () {
    const badgeContainer = $('[data-badges]');

    const loadBadgesFromStorage = () => {
      let storedData = localStorage.getItem('ticketFilters');
      try {
        storedData = JSON.parse(storedData);

        if (typeof storedData !== 'object' || storedData === null) {
          storedData = {};
        }
      } catch (e) {
        storedData = {};
      }

      badgeContainer.empty();
      badgeContainer.append('<h6 class="mt-1 mb-0">Filtros activos</h6>');

      Object.entries(storedData).forEach(([key, value]) => {
        if (value !== 'default') {
          addBadge(`${key}: ${value}`);
        }
      });
    };

    const addBadge = (text) => {
      const badge = $(`<span class="badge bg-primary me-1">${text}</span>`);
      badgeContainer.append(badge);
    };

    loadBadgesFromStorage();
  });
</script>
