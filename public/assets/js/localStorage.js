const form = $('#search_form');

export const initLocalStorage = () => {
  loadFilters();
  form.on('click', saveFilters);
  form.on('change', 'input[type="radio"]', saveFilters);

  form.on('submit', function (e) {
    e.preventDefault();

    let localFilters = '';
    $.each(getFilters(), function (key, value) {
      localFilters = localFilters + key + '=' + value + '&';
    });

    if (localFilters === '') {
      window.location.href = form.attr('action');
    } else {
      window.location.href = form.attr('action') + '?' + localFilters;
    }
  });
};

function loadFilters() {
  let savedFilters = null;
  const currentPath = window.location.pathname;

  if (currentPath.endsWith('/tickets')) {
    savedFilters = getFiltersFromURL();
  } else {
    savedFilters = getFilters();
  }

  $.each(savedFilters, function (key, value) {
    if (value) {
      const input = $(`input[name="${key}"][value="${value}"]`);
      input.prop('checked', true);
      input.addClass('btn-primary');
    }
  });

  localStorage.setItem('ticketFilters', JSON.stringify(savedFilters));
}

function getFiltersFromURL() {
  const urlParams = new URLSearchParams(window.location.search);
  return {
    type: urlParams.get('type') || 'default',
    category: urlParams.get('category') || 'default',
    status: urlParams.get('status') || 'default',
    priority: urlParams.get('priority') || 'default',
    owner: urlParams.get('owner') || 'default',
  };
}

function saveFilters() {
  const filters = {
    type: $('input[name="type"]:checked').val() || 'default',
    category: $('input[name="category"]:checked').val() || 'default',
    priority: $('input[name="priority"]:checked').val() || 'default',
    status: $('input[name="status"]:checked').val() || 'default',
    owner: $('input[name="owner"]:checked').val() || 'default',
  };

  localStorage.setItem('ticketFilters', JSON.stringify(filters));
}

function getFilters() {
  return JSON.parse(localStorage.getItem('ticketFilters')) || {};
}