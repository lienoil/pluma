import $ from 'jquery';

$(document).ready(function () {
  // On Load
  $('[data-settings]').each(function () {
    let $this = $(this);
    let $target = $($this.data('target'));
    let key = $this.data('settings');
    let value = window.localStorage.getItem(key);
    $target.toggleClass(value)
  });

  $(document).on('click change', '[data-settings]', function () {
    let $this = $(this);
    let key = $this.data('settings');
    let state = (window.localStorage.getItem('STATE_'+key) || $this.data('state')) == 'true';
    let stateValue = state ? 'false' : 'true';
    let value = $this.data(stateValue+'-value');

    window.localStorage.setItem(key, value);
    window.localStorage.setItem('STATE_'+key, !state);
  });
});
