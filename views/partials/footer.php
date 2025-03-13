<?php
$ticketTypes = HELPER_getArray('translations', 'type');
$ticketCategories = HELPER_getArray('translations', 'category');
$ticketPriorities = HELPER_getArray('translations', 'priority');
$ticketStatus = HELPER_getArray('translations', 'status');
?>

<footer class="bg-light z-3">
  <div
    class="container px-3 my-2 my-xl-3 navbar-nav d-flex flex-row align-items-center justify-content-evenly">
    <a class="btn rounded-pill p-2 <?= urlIs(urlRedirect("/")) ? 'btn-primary shadow-sm'
        : 'btn-light' ?> d-inline-flex gap-1"
       href="<?= urlRedirect("/") ?>">
      <span class="material-symbols-rounded align-content-center">home</span>
      Inicio
    </a>
    <a
      class="btn rounded-pill p-2 <?= urlIs(urlRedirect("/ticket/new")) ? 'btn-primary shadow-sm'
          : 'btn-light' ?> d-inline-flex gap-1"
      href="<?= urlRedirect("/ticket/new") ?>">
      <span class="material-symbols-rounded align-content-center">add_circle</span>
      Nuevo ticket
    </a>

    <button
      class="btn rounded-pill p-2 <?= urlIs(urlRedirect("/tickets")) ? 'btn-primary shadow-sm'
          : 'btn-light' ?> d-inline-flex gap-1" data-bs-toggle="modal" data-bs-target="#exampleModal">
      <span class="material-symbols-rounded align-content-center">search</span>
      Buscar
    </button>
    <!--
      <?php require base_path('views/partials/offcanvas.php') ?>
      -->
  </div>
</footer>

<!-- Modal -->
<div class="modal fade modal-slide-up" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel">
  <div class="modal-dialog modal-dialog-scrollable align-content-end"> <!-- Habilita el scroll -->
    <div class="modal-content">
      <form id="search_form" method="POST" action="<?= urlRedirect("/tickets") ?>">
        <input type="hidden" name="_method" value="GET">

        <!-- Encabezado del Modal -->
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">
              <?= HELPER_getIcon('ui', "filter_tune"); ?> Filtros de búsqueda
          </h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <!-- Cuerpo del Modal con Scroll -->
        <div class="modal-body d-flex flex-column" style="max-height: 50dvh">

          <!-- Estado -->
          <h6 class="mb-2">Asignación de ticket</h6>
          <div class="btn-group-toggle d-flex flex-wrap gap-2" data-toggle="buttons">
            <label class="btn btn-outline-dark px-2 py-1 rounded-4">
              <input type="radio" name="owner" value="1" autocomplete="off" checked>
              Creado por mí
            </label>
            <label class="btn btn-outline-dark px-2 py-1 rounded-4">
              <input type="radio" name="owner" value="0" autocomplete="off">
              Para ser gestionado por mí
            </label>
          </div>

          <!-- Estado -->
          <h6 class="mb-2 mt-4">Estado del ticket</h6>
          <div class="btn-group-toggle d-flex flex-wrap gap-2" data-toggle="buttons">
            <label class="btn btn-outline-dark px-2 py-1 rounded-4">
              <input type="radio" name="status" value="default" autocomplete="off">
              Todos
            </label>
              <?php foreach ($ticketStatus as $value => $label): ?>
                <label class="btn btn-outline-dark px-2 py-1 rounded-4">
                  <input type="radio" name="status" value="<?= htmlspecialchars($value) ?>" autocomplete="off">
                    <?= htmlspecialchars($label) ?>
                </label>
              <?php endforeach; ?>
          </div>

          <!-- Tipo -->
          <h6 class="mb-2 mt-4">Tipo de ticket</h6>
          <div class="btn-group-toggle d-flex flex-wrap gap-2" data-toggle="buttons">
            <label class="btn btn-outline-dark px-2 py-1 rounded-4">
              <input type="radio" name="type" value="default" autocomplete="off">
              Todos
            </label>
              <?php foreach ($ticketTypes as $value => $label): ?>
                <label class="btn btn-outline-dark px-2 py-1 rounded-4">
                  <input type="radio" name="type" value="<?= htmlspecialchars($value) ?>" autocomplete="off">
                    <?= htmlspecialchars($label) ?>
                </label>
              <?php endforeach; ?>
          </div>

          <!-- Categoría -->
          <h6 class="mt-4 mb-2">Categoría del ticket</h6>
          <div class="btn-group-toggle d-flex flex-wrap gap-2" data-toggle="buttons">
            <label class="btn btn-outline-dark px-2 py-1 rounded-4">
              <input type="radio" name="category" value="default" autocomplete="off">
              Todos
            </label>
              <?php foreach ($ticketCategories as $value => $label): ?>
                <label class="btn btn-outline-dark px-2 py-1 rounded-4">
                  <input type="radio" name="category" value="<?= htmlspecialchars($value) ?>" autocomplete="off">
                    <?= htmlspecialchars($label) ?>
                </label>
              <?php endforeach; ?>
          </div>

          <!-- Prioridad -->
          <h6 class="mt-4 mb-2">Prioridad del ticket</h6>
          <div class="btn-group-toggle d-flex flex-wrap gap-2" data-toggle="buttons">
            <label class="btn btn-outline-dark px-2 py-1 rounded-4">
              <input type="radio" name="priority" value="default" autocomplete="off">
              Todos
            </label>
              <?php foreach ($ticketPriorities as $value => $label): ?>
                <label class="btn btn-outline-dark px-2 py-1 rounded-4">
                  <input type="radio" name="priority" value="<?= htmlspecialchars($value) ?>" autocomplete="off">
                    <?= htmlspecialchars($label) ?>
                </label>
              <?php endforeach; ?>
          </div>

        </div>

        <!-- Pie del Modal -->
        <div class="modal-footer justify-content-center">
          <button type="button" class="btn btn-outline-dark rounded-4" data-bs-dismiss="modal">Cancelar
          </button>
          <button type="submit" class="btn btn-primary rounded-4">
              <?= HELPER_getIcon('ui', "search"); ?> Realizar búsqueda
          </button>
        </div>
      </form>
    </div>
  </div>
</div>

</body>
</html>