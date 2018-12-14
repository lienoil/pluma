import $ from 'jquery';
import List from 'list.js';

$(document).ready(function () {
  $(document).find('[data-toggle=search]').each(function (i, el) {
    let $this = $(el);
    let id = $this.attr('id');
    let options = Object.assign({
      valueNames: [
        'name',
        {
          data: ['name']
        },
      ],
    }, $this.data('options'));

    let list = new List(id, options);
  });
});
