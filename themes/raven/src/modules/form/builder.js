import $ from 'jquery';

$(document).ready(function () {
  $(document).on('DOMNodeInserted', '[data-form-builder]', function () {
    console.log('loaded');
  });
});
