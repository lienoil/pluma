import $ from 'jquery'
import 'datatables'

$(document).ready(function () {
  $('[data-table]').each(function (i) {
    $(this).DataTable(JSON.parse($(this).data('options')))
  })
})
