import $ from 'jquery'
import './plugin.js'
import './dragdrop.scss'

$(document).ready(function () {
  $('[data-dragdrop]').each(function (i) {
    let $instance = $(this)
    let id = 'data-dragdrop' + i
    let options = Object.assign({
      group: 'dragdrop:default',
      sort: true,
      onDragStart: function ($item, container, _super) {
        // Duplicate items of the no drop area
        if (!container.options.drop) {
          $item.clone().insertAfter($item)
        }
        _super($item, container)
      },
      onDrop: function($item, container, _super) {
        $item.parents('[data-dragdrop]').children('[data-dragdrop-item]').each(function (j) {
          $(this).find('[data-dragdrop-sort]').val(j)
          $(this).find('ol, ul').find('[data-dragdrop-item]').each(function (k) {
            $(this).find('[data-dragdrop-sort]').val(k)
          })
        })

        _super($item, container)

        let parent = $item.closest('[data-dragdrop-children]').parent('[data-dragdrop-item]')
        let key = parent.attr('data-dragdrop-key')
        $item.find('[data-dragdrop-parent]').val(key)
      },
    }, JSON.parse($(this).attr('data-dragdrop-options') || '{}'))
    $instance.attr('id', id)
    $instance.attr('data-dragdrop-options', null)
    $instance.attr('data-dragdrop-group', options.group)

    $(function () {
      $instance.sortable(options)
    })
    // Sortable.create(document.getElementById(id), options)
  })

  $(document).on('click', '[data-dragdrop-item-remove]', function () {
    $(this).closest('[data-dragdrop-item]').remove()
  })
})
