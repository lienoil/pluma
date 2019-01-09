import $ from 'jquery'
import { Sortable } from '@shopify/draggable/lib/es5/draggable.bundle.js'

$(document).ready(function () {
  $('[data-dragdrop]').each(function (i) {
    let $instance = $(this)
    let id = 'data-dragdrop' + i
    let options = Object.assign({
      group: 'dragdrop:default',
      draggable: '[data-dragdrop-item]',
    }, JSON.parse($(this).attr('data-dragdrop-options') || '{}'))

    $instance.attr('id', id)
    $instance.attr('data-dragdrop-options', null)
    $instance.attr('data-dragdrop-group', options.group)

    $(function () {
      new Sortable(document.getElementById(id))
    })
    // Sortable.create(document.getElementById(id), options)
  })

  $(document).on('click', '[data-dragdrop-item-remove]', function () {
    $(this).closest('[data-dragdrop-item]').remove()
  })
})
