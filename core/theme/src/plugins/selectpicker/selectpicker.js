import $ from 'jquery';
import 'bootstrap-select/js/bootstrap-select.js';
import 'bootstrap-select/sass/bootstrap-select.scss';

$(document).ready(function () {
  $(document).find('select[data-selectpicker]').selectpicker();
  $(document).on('dynamic-item-added', 'select[data-selectpicker]', function () {
    $(document).find('select[data-selectpicker]').selectpicker('refresh')
  });
});
