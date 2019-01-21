import $ from 'jquery';
import './avatar-upload.js';

$(document).ready(function () {
  $(document).on('change', '[data-avatar-preview-target]', function () {
    let target = $(this).data('avatar-preview-target');
    let value = $(this).val();
    let $target = $(target);

    $target.attr('src', value);
  });

  $(document).find('[data-avatar-preview-remove]').on('click', function () {
    const $avatar = $(this).parents('[data-avatar]');
    const target = $avatar.find('[data-avatar-preview-target]').data('avatar-preview-target');

    $(target).attr('src', '');
    $avatar.find('[data-avatar-preview-target]').val('').trigger('change');
  });
});
