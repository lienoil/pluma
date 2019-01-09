import $ from 'jquery'
import './checkbox'
// import 'datatables'

$(document).ready(function () {
  $('[data-table]').each(function (i) {
    const options = $(this).data('options') ? JSON.parse($(this).data('options')) : {}
    // $(this).DataTable(options)
  })
})
