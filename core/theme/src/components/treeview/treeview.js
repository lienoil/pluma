import './treeview.css'
import './plugin.js'

$(document).ready(function () {
  $('[data-treeview]').each(function () {
    // let data = JSON.parse($(this).attr('data-treeview'))
    let data = [
      {
        text: "Parent 1",
        nodes: [
          {
            text: "Child 1",
            nodes: [
              {
                text: "Grandchild 1"
              },
              {
                text: "Grandchild 2"
              }
            ]
          },
          {
            text: "Child 2"
          }
        ]
      },
      {
        text: "Parent 2"
      },
      {
        text: "Parent 3"
      },
      {
        text: "Parent 4"
      },
      {
        text: "Parent 5"
      }
    ]
    let options = JSON.parse($(this).attr('data-options') || '{}')

    options = Object.assign({}, {multiSelect: true}, options)
    console.log(data)
    $(this).treeview({data: data})
    $(this).attr('data-treeview', null)
  })
})
