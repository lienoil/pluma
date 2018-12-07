import $ from 'jquery';
import InlineEditor from '@ckeditor/ckeditor5-build-inline';

$(document).ready(function () {
  $('[data-editor]').each(function () {
    let options = Object.assign({}, $(this).data('editor'));
    let $target = $($(this).data('target'));

    InlineEditor.create(this, options)
      .then(editor => {
        editor.setData($target.val());

        $(document).on('submit', 'form', function () {
          let content = editor.getData();
          $target && $target.val(content);
        });
      })
      .catch(error => {
        console.log(error);
      });
  });
});
