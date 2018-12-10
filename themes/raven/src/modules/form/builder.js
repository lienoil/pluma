import $ from 'jquery';

$(document).ready(function () {
  $(document).on('load', '[data-form-builder]', function () {
    console.log('loaded');
  });
});
