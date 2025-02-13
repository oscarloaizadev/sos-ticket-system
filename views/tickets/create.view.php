<?php require base_path('views/partials/head.php') ?>
<?php require base_path('views/partials/nav.php') ?>
<?php require base_path('components/shared/Translations.variables.php') ?>

<main class="container px-0">
  <div>
    <form class="shadow-sm rounded-4 overflow-hidden"
          method="POST"
          action="<?= urlRedirect('/ticket/store') ?>">
      <input type="hidden" name="company_id" value="<?= $companyId ?>">
      <input type="hidden" name="requester_id" value="<?= $requesterId ?>">
      <input type="hidden" name="assigned_to" value="<?= $assignedTo ?? '' ?>">
      <input type="hidden" name="status" value="<?= $status ?? '' ?>">
      <div class="d-flex flex-column gap-4 bg-white p-4">

        <!-- Asunto -->
        <div>
          <label for="subject" class="form-label fw-bold">Asunto</label>
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
          <label for="description" class="form-label fw-bold">Descripción</label>
          <textarea class="form-control p-2" id="description" name="description"
                    rows="3"
                    placeholder="Describe el problema que estás presentando, en dónde (oficina, en casa, etc), y con qué elemento (tu equipo personal, wifi, etc)"><?= $_POST['description']
                  ?? '' ?></textarea>
        </div>
          <?php if (isset($errors['description'])) : ?>
            <div class="alert alert-warning alert-dismissible fade show m-0" role="alert">
              <b><?= $errors['description'] ?></b>
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
          <?php endif; ?>

        <!-- Tipo de Ticket -->
        <div>
          <label for="type" class="form-label fw-bold">Tipo de Ticket</label>
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
          <label for="category" class="form-label fw-bold">Categoría</label>
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
          <label for="priority" class="form-label fw-bold">Prioridad</label>
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
          <label for="request_date" class="form-label fw-bold">Fecha de Solicitud</label>
          <input type="datetime-local" class="form-control p-2" id="request_date" name="request_date"
                 value="<?= $_POST['request_date'] ?? date('Y-m-d\TH:i') ?>" required>
        </div>

        <!-- Botón de Envío -->
        <div class="align-self-end">
          <button type="submit" class="btn btn-yellow rounded-pill shadow-sm">
            <span class="material-symbols-rounded fs-5 align-content-center">save</span>
            Guardar Ticket
          </button>
        </div>
      </div>
    </form>
  </div>
</main>

<?php require base_path('views/partials/footer.php') ?>
