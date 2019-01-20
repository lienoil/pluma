import hotkeys from 'hotkeys-js';
import $ from 'jquery';

$(document).ready(function () {
  $('[data-hotkey]').each(function () {
    const $el = $(this);
    const $target = $el;
    const key = $el.data('hotkey');

    hotkeys(key, function (e) {
      $target.focus();
      $target.click();

      if ($el.is('[data-hotkey-link]')) {
        const link = $el.attr('href');
        window.location.href = link;
      }

      e.preventDefault();
    });
  });
});
