import $ from 'jquery';
import './avatar-upload.js';

$(document).ready(function () {
  $(document).on('change', '[data-avatar-preview-target]', function () {
    let target = $(this).data('avatar-preview-target');
    let value = $(this).val();
    let $target = $(target);

    $target.attr('src', value);
  });
});
