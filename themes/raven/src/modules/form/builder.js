import $ from 'jquery';
import * as Survey from 'survey-jquery';

$(document).ready(function () {
  $('[data-form-builder]').each(function (i, el) {
    let $this = $(this);
    let options = Object.assign({}, $this.data('form-builder'));

    $this.attr('data-form-builder', '');
    // $this.Survey()
  });
});
