import $ from 'jquery';
import 'fl-form-builder/dist/fl-form-builder.css';
import * as FormBuilder from 'fl-form-builder';

$(document).ready(function () {
  let formBuilder = new FormBuilder(document.querySelector('[data-form-builder]'));
//   $('[data-form-builder]').each(function (i, el) {
//     let $this = $(this);
//     let options = Object.assign({}, $this.data('form-builder'));

//     $this.attr('data-form-builder', '');
//   });
});
