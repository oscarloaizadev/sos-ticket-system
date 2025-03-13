<?php require base_path('views/partials/head.php') ?>
<?php require base_path('views/partials/nav.php') ?>

<?php
$ticketTypes = HELPER_getArray('translations', 'type');
$ticketCategories = HELPER_getArray('translations', 'category');
$priorityTranslations = HELPER_getArray('translations', 'priority');
?>

<main>
  <section class="container px-3 py-2 bg-light rounded-4 shadow-sm border border-light">
    <form id="create_ticket"
          method="POST"
          action="<?= urlRedirect('/ticket/store') ?>">
      <input type="hidden" name="_method" value="POST">
      <input type="hidden" name="company_id" value="<?= $companyId ?>">
      <input type="hidden" name="requester_id" value="<?= $requesterId ?>">
      <input type="hidden" name="assigned_to" value="<?= $assignedTo ?? '' ?>">
      <input type="hidden" name="status" value="<?= $status ?? '' ?>">
      <div class="d-flex flex-column gap-3">

        <!-- Asunto -->
        <div>
          <label for="subject" class="form-label fw-bold mb-1">Asunto</label>
          <input type="text" class="form-control p-2" id="subject" name="subject"
                 value="<?= $_POST['subject'] ?? '' ?>" required placeholder="¿En qué necesitas ayuda?">
        </div>
          <?php if (isset($errors['subject'])) : ?>
            <div class="alert alert-warning alert-dismissible fade show m-0" role="alert">
              <b><?= $errors['subject'] ?></b>
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
          <?php endif; ?>

        <!-- Descripción -->
        <div>
          <label for="description" class="form-label fw-bold mb-1">Descripción</label>
          <textarea id="description" name="editordata"></textarea>
        </div>
          <?php if (isset($errors['description'])) : ?>
            <div class="alert alert-warning alert-dismissible fade show m-0" role="alert">
              <b><?= $errors['description'] ?></b>
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
          <?php endif; ?>

        <!-- Tipo de Ticket -->
        <div>
          <label for="type" class="form-label fw-bold mb-1">Tipo de Ticket</label>
          <select class="form-control p-2" id="type" name="type" required>
            <option value="" disabled selected>Selecciona el tipo...</option>
              <?php
              foreach ($ticketTypes as $value => $label) {
                  $selected = ($_POST['type'] ?? '') === $value ? 'selected' : '';
                  echo "<option value=\"$value\" $selected>$label</option>";
              }
              ?>
          </select>
        </div>

        <!-- Categoría -->
        <div>
          <label for="category" class="form-label fw-bold mb-1">Categoría</label>
          <select class="form-control p-2" id="category" name="category" required>
            <option value="" disabled selected>Selecciona la categoría...</option>
              <?php
              foreach ($ticketCategories as $value => $label) {
                  $selected = ($_POST['category'] ?? '') === $value ? 'selected' : '';
                  echo "<option value=\"$value\" $selected>$label</option>";
              }
              ?>
          </select>
        </div>

        <!-- Prioridad -->
        <div>
          <label for="priority" class="form-label fw-bold mb-1">Prioridad</label>
          <select class="form-control p-2" id="priority" name="priority" required>
            <option value="" disabled selected>Selecciona la prioridad...</option>
              <?php
              foreach ($priorityTranslations as $value => $label) {
                  $selected = ($_POST['priority'] ?? '') === $value ? 'selected' : '';
                  echo "<option value=\"$value\" $selected>$label</option>";
              }
              ?>
          </select>
        </div>

        <!-- Fecha de Solicitud -->
        <div>
          <label for="request_date" class="form-label fw-bold mb-1">Fecha de Solicitud</label>
          <input type="datetime-local" class="form-control p-2" id="request_date" name="request_date"
                 value="<?= $_POST['request_date'] ?? date('Y-m-d\TH:i') ?>" required>
        </div>

        <!-- Botón de Envío -->
        <div class="align-self-end">
          <button type="submit" id="send_button" class="btn btn-yellow rounded-pill shadow-sm">
            <span class="material-symbols-rounded fs-5 align-content-center">save</span>
            Crear Ticket
          </button>
        </div>
      </div>
    </form>
  </section>
</main>

<script>
  $(document).ready(function () {
    $('#description').summernote({
      lang: 'es-ES',
      placeholder: 'Describe el problema que estás presentando, en dónde (oficina, en casa, etc), y con qué elemento (tu equipo personal, wifi, etc)',
      tabsize: 2,
      minHeight: 80,
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
      const editorContent = $('#description').summernote('code');
      const updateButton = $('#send_button');

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
    $('#create_ticket').on('submit', function (e) {
      e.preventDefault(); // Prevenir el envío tradicional del formulario

      const sendButton = $('#send_button');
      const originalContent = sendButton.html();
      sendButton.prop('disabled', true).html(`
            <div class="spinner-border spinner-border-sm" role="status"></div>
            <span>Creando Ticket...</span>
        `);

      const formData = {
        _method: $('#create_ticket input[name="_method"]').val(),
        company_id: $('input[name="company_id"]').val(),
        requester_id: $('input[name="requester_id"]').val(),
        assigned_to: $('input[name="assigned_to"]').val(),
        status: $('input[name="status"]').val(),
        subject: $('input[name="subject"]').val(),
        description: $('#description').summernote('code'),
        type: $('select[name="type"]').val(),
        category: $('select[name="category"]').val(),
        priority: $('select[name="priority"]').val(),
        request_date: $('input[name="request_date"]').val(),
      };

      $.ajax({
        url: $('#create_ticket').attr('action'),
        type: 'POST',
        data: formData,
        dataType: 'json',
        success: function (response) {
          if (response.success) {
            Swal.fire({
              title: 'Ticket Creado',
              text: response.message,
              icon: 'success',
              confirmButtonText: 'Ir al Ticket',
            }).then((result) => {
              if (result.isConfirmed) {
                window.location.href = response.redirect; // Redirigir solo si el usuario lo confirma
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
        complete: function () {
          setTimeout(function () {
            sendButton.prop('disabled', false).html(originalContent);
          }, 1000);
        },
      });
    });
  });

</script>

<?php require base_path('views/partials/footer.php') ?>
