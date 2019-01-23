import $ from 'jquery';
import './avatar-upload.scss';

function readURL(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();

    reader.onload = function(e) {
      $(input).closest('[data-avatar]').find('[data-avatar-preview]').css('background-image', 'url('+e.target.result +')');
      $(input).closest('[data-avatar]').find('[data-avatar-preview]').hide();
      $(input).closest('[data-avatar]').find('[data-avatar-preview]').fadeIn(650);
    }

    reader.readAsDataURL(input.files[0]);
  }
}

$('[data-avatar-upload]').change(function() {
  readURL(this);
});
