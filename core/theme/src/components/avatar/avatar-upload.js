import $ from 'jquery';
import './avatar-upload.scss';

function readURL(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();

    reader.onload = function(e) {
      $('[data-avatar]').css('background-image', 'url('+e.target.result +')');
      $('[data-avatar]').hide();
      $('[data-avatar]').fadeIn(650);
    }

    reader.readAsDataURL(input.files[0]);
  }
}

$('[data-avatar-upload]').change(function() {
  readURL(this);
});

$(document).ready(function () {
  $('[data-avatar]').cropper({
    aspectRatio: 16 / 9,
  })
});
