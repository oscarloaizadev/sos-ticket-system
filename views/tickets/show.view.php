<?php
require base_path('views/partials/head.php');
?>

<?php
$status = htmlspecialchars($ticket["status"]);
$statusText = HELPER_getText('status', $status);

$priority = htmlspecialchars($ticket["priority"]);
$priorityText = HELPER_getText('priority', $priority);

$type = htmlspecialchars($ticket["type"]);
$typeText = HELPER_getText('type', $type);

$category = htmlspecialchars($ticket["category"]);
$categoryText = HELPER_getText('category', $category);

$class = HELPER_getClass('status', $status);

$ticketTypes = HELPER_getArray('translations', 'type');
$ticketCategories = HELPER_getArray('translations', 'category');
$ticketPriorities = HELPER_getArray('translations', 'priority');
$ticketStatus = HELPER_getArray('translations', 'status');

unset($ticketTypes['not_defined']);
unset($ticketCategories['not_defined']);
unset($ticketPriorities['not_defined']);
unset($ticketStatus['not_defined']);
?>
  <nav class="navbar p-0 bg-light shadow-sm z-3 <?= $class ?>">
    <div
      class="container justify-content-between p-0 my-2 mx-4 my-xl-3 text-center navbar-nav d-flex gap-2 flex-row align-items-center">
      <a href="<?= urlRedirect('/tickets?status=' . $status) ?>" class="btn btn-light border rounded-pill p-2">
          <?= HELPER_getIcon('ui', "back"); ?> Volver
      </a>
      <div class="lh-sm">
        <span class="fs-6 d-block">Detalles del ticket</span>
        <h1 class="fs-4 m-0"><?= htmlspecialchars($ticket["code"]); ?></h1>
      </div>
    </div>
  </nav>

  <main>
    <section class="container p-3 bg-light rounded-4 shadow-sm border border-light">
      <div class="row row-cols-2 lh-sm" style="row-gap: 0.5rem">
        <div class="col col-12"><b class="d-block">Asunto</b> <?= htmlspecialchars($ticket["subject"]); ?></div>
        <div class="col"><b class="d-block">Fecha de
            solicitud</b> <?= htmlspecialchars(formatDate($ticket["request_date"])); ?>
        </div>
        <div class="col"><b class="d-block">Tipo</b> <?= $typeText ?></div>
        <div class="col"><b class="d-block">Estado</b> <?= $statusText ?></div>
        <div class="col"><b class="d-block">Prioridad</b> <?= $priorityText ?></div>
        <div class="col col-12"><b class="d-block">Categoría</b> <?= $categoryText ?></div>
        <div class="col"><b class="d-block">Asignado a</b> <?= $assignedTo ? htmlspecialchars($assignedTo["name"])
                : "Sin asignar"; ?></div>
        <div class="col"><b class="d-block">Solicitado por</b> <?= htmlspecialchars($requester["name"]); ?></div>
      </div>
    </section>

    <section class="container p-3 bg-light rounded-4 shadow-sm border border-light">
      <div class="row row-cols-1 lh-sm">
        <h3 class="col m-0">Descripción del ticket</h3>
        <div class="col"><?= htmlspecialchars($ticket["description"]); ?></div>
      </div>
    </section>

    <section class="container p-3 bg-light rounded-4 shadow-sm border border-light lh-sm">
      <h3 class="m-0 mb-3">Historial de actualización</h3>
        <?php if (empty($ticketHistory)): ?>
          <p class="alert alert-warning">No hay comentarios en este ticket.</p>
        <?php else: ?>
          <div class="d-flex flex-column gap-2">
              <?php foreach ($ticketHistory as $history) : ?>
                  <?php
                  component("HistoryMessages.php",
                            [
                                "history" => $history,
                                "user" => $user,
                                "assignedTo" => $assignedTo,
                                "requester" => $requester,
                            ]);
                  ?>
              <?php endforeach; ?>
          </div>
        <?php endif; ?>
    </section>
      
      <?php if ($status != 'closed' && $status != 'denied' && $status != 'resolved'): ?>
    <section class="container p-3 bg-light rounded-4 shadow-sm border border-light lh-sm">
      <form id="update_form"
            method="POST"
            action="<?= urlRedirect('/ticket/update') ?>">
        <input type="hidden" name="_method" value="POST">
        <input type="hidden" name="VAFq1F6R" value="<?= $ticket['id'] ?? '' ?>">
        <input type="hidden" name="cNnKa1tU" value="<?= $ticket['requester_id'] ?? '' ?>">
        <input type="hidden" name="Cjc4ATMw" value="<?= $ticket['assigned_to'] ?? '' ?>">

        <h3 class="m-0 mb-3">Realizar una actualización</h3>
          
          <?php if ($user['role'] === 'super_user' || $user['role'] === 'admin'): ?>
            <!-- Estado -->
            <label for="status" class="mb-1">Estado del ticket</label>
            <select class="form-control" name="status" id="status" required>
              <option value="" disabled selected>Seleccionar..</option>
                <?php foreach ($ticketStatus as $value => $label): ?>
                  <option value="<?= htmlspecialchars($value) ?>" <?= (isset($ticket['status'])
                      && $ticket['status'] === $value) ? 'selected' : '' ?>>
                      <?= htmlspecialchars($label) ?>
                  </option>
                <?php endforeach; ?>
            </select>

            <!-- Tipo -->
            <label for="type" class="mb-1 mt-2">Tipo de ticket</label>
            <select class="form-control" name="type" id="type" required>
              <option value="" disabled selected>Seleccionar..</option>
                <?php foreach ($ticketTypes as $value => $label): ?>
                  <option value="<?= htmlspecialchars($value) ?>" <?= (isset($ticket['type'])
                      && $ticket['type'] === $value)
                      ? 'selected' : '' ?>>
                      <?= htmlspecialchars($label) ?>
                  </option>
                <?php endforeach; ?>
            </select>

            <!-- Categoría -->
            <label for="category" class="mb-1 mt-2">Categoría del ticket</label>
            <select class="form-control" name="category" id="category" required>
              <option value="" disabled selected>Seleccionar..</option>
                <?php foreach ($ticketCategories as $value => $label): ?>
                  <option value="<?= htmlspecialchars($value) ?>" <?= (isset($ticket['category'])
                      && $ticket['category'] === $value) ? 'selected' : '' ?>>
                      <?= htmlspecialchars($label) ?>
                  </option>
                <?php endforeach; ?>
            </select>

            <!-- Prioridad -->
            <label for="priority" class="mb-1 mt-2">Prioridad del ticket</label>
            <select class="form-control" name="priority" id="priority" required>
              <option value="" disabled selected>Seleccionar..</option>
                <?php foreach ($ticketPriorities as $value => $label): ?>
                  <option value="<?= htmlspecialchars($value) ?>" <?= (isset($ticket['priority'])
                      && $ticket['priority'] === $value) ? 'selected' : '' ?>>
                      <?= htmlspecialchars($label) ?>
                  </option>
                <?php endforeach; ?>
            </select>

            <!-- Reasignar -->
            <label for="assigned_to" class="mb-1 mt-2">Asignado a</label>
            <select class="form-control" name="assigned_to" id="assigned_to" required>
              <option value="" disabled selected>Seleccionar...</option>
                <?php foreach ($technicians as $value => $label): ?>
                  <option value="<?= htmlspecialchars($value) ?>" <?= (isset($ticket['assigned_to'])
                      && $ticket['assigned_to'] === $value) ? 'selected' : '' ?>>
                      <?= htmlspecialchars($label["name"]) ?>
                  </option>
                <?php endforeach; ?>
            </select>
          <?php endif; ?>

        <h5 class="mt-3 mb-2">Realizar un comentario</h5>
        <textarea id="summernote" name="editordata"></textarea>
        <button id="update_button" class="btn btn-yellow w-100 shadow-sm fs-6 mt-3" type="submit">
          Enviar actualización del ticket
        </button>
      </form>
    </section>
  </main>
    
    <?php require base_path('views/partials/footer.php'); ?>

  <script>
    $(document).ready(function () {
      $('#summernote').summernote({
        lang: 'es-ES',
        placeholder: 'Describe la actualización que deseas realizar',
        tabsize: 2,
        minHeight: 60,
        toolbar: [
          ['font', ['bold', 'italic', 'underline', 'clear']],
          ['color', ['color']],
          ['insert', ['link']],

          ['view', ['fullscreen']],
        ],
        styleTags: ['h1', 'h4', 'p'],
        callbacks: {
          onChange: function (content, $editable) {
            updateButtonState();
          },
        },
      });

      function isEmptyContent(html) {
        var temp = html.replace(/&nbsp;|&ensp;|&emsp;/g, '');
        temp = temp.replace(/<[^>]+>/g, '');
        temp = temp.replace(/\s+/g, '');
        return temp.length === 0;
      }

      function updateButtonState() {
        const editorContent = $('#summernote').summernote('code');
        const updateButton = $('#update_button');

        if (isEmptyContent(editorContent)) {
          updateButton.prop('disabled', true);
        } else {
          updateButton.prop('disabled', false);
        }
      }

      updateButtonState();
    });
  </script>

  <script>
    $(document).ready(function () {
      $('#update_form').on('submit', function (e) {
        e.preventDefault();
        let valid = true;

        // Validar selects
        $('select[required]').each(function () {
          if ($(this).val() === '') {
            $(this).addClass('is-invalid'); // Agrega clase de error visual
            valid = false;
          } else {
            $(this).removeClass('is-invalid'); // Remueve error si está seleccionado
          }
        });

        // Validar Summernote
        const editorContent = $('#summernote').summernote('code');
        if (editorContent.replace(/(<([^>]+)>|\s)/g, '').length === 0) {
          alert('Debe ingresar una actualización en el comentario.');
          valid = false;
        }

        if (!valid) {
          e.preventDefault(); // Evita el envío si hay errores
          return;
        }

        // Continuar con AJAX si todo es válido
        const formData = {
          _method: $('input[name="_method"]').val(),
          VAFq1F6R: $('input[name="VAFq1F6R"]').val(),
          cNnKa1tU: $('input[name="cNnKa1tU"]').val(),
          Cjc4ATMw: $('input[name="Cjc4ATMw"]').val(),
          status: $('input[name="status"]').val(),
          assigned_to: $('input[name="assigned_to"]').val(),
          priority: $('input[name="priority"]').val(),
          type: $('input[name="type"]').val(),
          category: $('input[name="category"]').val(),
          editordata: editorContent,
        };

        $.ajax({
          url: $('#update_form').attr('action'),
          type: 'POST',
          data: formData,
          dataType: 'json',
          success: function (response) {
            if (response.success) {
              Swal.fire({
                title: 'Actualización exitosa',
                text: response.message,
                icon: 'success',
                confirmButtonText: 'Volver al ticket',
              }).then((result) => {
                if (result.isConfirmed) {
                  window.location.reload();
                }
              });
            } else {
              Swal.fire({
                title: 'Error',
                text: response.message,
                icon: 'error',
                confirmButtonText: 'Aceptar',
              });
            }
          },
          error: function (error) {
            Swal.fire({
              title: 'Error en servidor',
              text: error.statusText,
              icon: 'error',
              confirmButtonText: 'Aceptar',
            });
          },
        });
      });
    });
  </script>
<?php else: ?>
  </div>
<?php endif; ?>