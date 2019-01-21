import $ from 'jquery';
import './croppie.scss';
import 'croppie/croppie.css';
import Croppie from 'croppie';

$(document).ready(function () {
  $(document).find('[data-crop]').each(function () {
    new Croppie.Croppie(this, {
      url: $('.my-s').attr('src'),
      viewport: {width: 120, height: 120},
      boundary: {width: 300, height: 300},
      enableResize: true,
      enableOrientation: true,
    });
  })
});
