$(document).on("DOMContentLoaded", function () {
  $("#usabilidad").DataTable({
    language: {
      url: "public/libraries/datatables/i18n/es-CO.json",
    },
    layout: {
      topStart: {
        buttons: [
          {
            extend: "excelHtml5",
            filename: "Tigo_Wall-e_Usabilidad",
            className: "btn btn-outline-success",
            text: `<i class="bi bi-save-fill me-1"></i> Exportar esta tabla`,
            init: function (api, node, config) {
              $(node).removeClass("btn-secondary");
            },
          },
        ],
        pageLength: {
          menu: [
            [10, 25, 50, 100, -1],
            [10, 25, 50, 100, "Todos"],
          ],
        },
      },
    },
    processing: true,
    serverSide: true,
    order: [],
    ajax: {
      url: "admin/retrieve",
      type: "POST",
    },
    columnsDefs: [{ targets: [0, 1, 2] }, { orderable: false }],
  });
});
