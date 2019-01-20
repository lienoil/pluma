import $ from 'jquery';
import moment from 'moment';
import './daterangepicker.scss';
import 'daterangepicker/daterangepicker.css';
import 'daterangepicker/daterangepicker.js';

$(document).ready(function () {
  const drp_options = {
    autoUpdateInput: true,
    locale: { cancelLabel: 'Clear' },
    applyButtonClasses: 'btn-secondary',
    opens: 'left',
  }

  $('[data-datepicker]').each(function () {
    const options = $(this).data('daterangepicker');
    $(this).daterangepicker(Object.assign(drp_options, {
      singleDatePicker: true,
      autoApply: true,
    }, options));
  });

  $('[data-daterangepicker]').each(function () {
    const options = $(this).data('daterangepicker');
    $(this).daterangepicker(Object.assign(drp_options, {
      applyButtonClasses: 'btn-secondary',
      alwaysShowCalendars: true,
      showCustomRangeLabel: false,
      ranges: {
        'Today': [moment(), moment()],
        'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
        'Tomorrow': [moment().add(1, 'days'), moment().add(24, 'hours')],
        'Last 7 Days': [moment().subtract(6, 'days'), moment()],
        'Last 30 Days': [moment().subtract(29, 'days'), moment()],
        'This Month': [moment().startOf('month'), moment().endOf('month')],
        'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
      },
    }, options));
  });

  $('[data-timepicker]').each(function () {
    const options = $(this).data('daterangepicker');
    $(this).daterangepicker(Object.assign(drp_options, {
      timePicker: true,
    }, options));
  });

  $('[data-daterangepicker]').on('cancel.daterangepicker', function(ev, picker) {
    $('[data-daterangepicker]').val('');
  });
  $('[data-datepicker]').on('cancel.daterangepicker', function(ev, picker) {
    $('[data-datepicker]').val('');
  });
  $('[data-timepicker]').on('cancel.daterangepicker', function(ev, picker) {
    $('[data-timepicker]').val('');
  });
});
