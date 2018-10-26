import './treeview.css'

// Hide the child tree when $('[data-tree-header] [data-tree-label]') is clicked
$(document).on('click', '[data-tree] [data-tree-header] [data-tree-label]', function (e) {
  $(this).parents('[data-tree-item]').children('[data-tree-child]').fadeToggle()
  e.stopPropagation()
})

// Check/uncheck all child tree
$(document).on('change', '[data-tree] [data-tree-header] input[type=checkbox]', function (e) {
  $(this).parents('[data-tree-item]').children('[data-tree-child]').find('input[type="checkbox"]').prop('checked', this.checked)
  $(this).parentsUntil('[data-tree]').children('input[type="checkbox"]').prop('checked', this.checked)
  e.stopPropagation()
})

// Change parent tree according to children's states
$(document).on('change', '[data-tree-child] [data-tree-checkbox]', function (e) {
  let $parent = $(this).parents('[data-tree-child]').parents('[data-tree-item]')
  let $children = $parent.children('[data-tree-child]').find('input[type=checkbox]').length
  let $checked = $parent.children('[data-tree-child]').find('input[type=checkbox]:checked').length

  $parent.children('[data-tree-header]').find('input[type="checkbox"]').prop('indeterminate', false)
  if ($checked === 0) {
    $parent.children('[data-tree-header]').find('input[type="checkbox"]').prop('checked', false)
  } else if ($children === $checked) {
    $parent.children('[data-tree-header]').find('input[type="checkbox"]').prop('checked', true)
  } else {
    $parent.children('[data-tree-header]').find('input[type="checkbox"]').prop('indeterminate', true)
  }
  e.stopPropagation()
})

// Adjustments on page loads
$(document).ready(function () {
  let $tree = $(document).find('[data-tree]')

  $tree.find('[data-tree-child]').each(function (i, el) {
    let $child = $(el)
    let $children = $child.find('input[type=checkbox]').length
    let $checked = $child.find('input[type=checkbox]:checked').length
    let $parent = $child.parents('[data-tree-item]')

    const $header = $parent.children('[data-tree-header]')
    $header.find('input[type="checkbox"]').prop('indeterminate', false)
    if ($checked === 0) {
      $header.find('input[type="checkbox"]').prop('checked', false)
    } else if ($children === $checked) {
      $header.find('input[type="checkbox"]').prop('checked', true)
    } else {
      $header.find('input[type="checkbox"]').prop('indeterminate', true)
    }
  })
})

// Toggle buttons
$(document).on('click', '[data-tree-toggle]', function (e) {
  let $parent = $(this).parents('.treeview')
  let $instance = $parent.find('[data-tree]')

  switch ($(this).attr('data-tree-toggle')) {
    case 'collapse':
      $instance.find('[data-tree-child]').fadeOut()
      break
    case 'expand':
      $instance.find('[data-tree-child]').fadeIn()
      break
    case 'check':
      $instance.find('input[type="checkbox"]').prop('checked', true)
      break
    case 'uncheck':
      $instance.find('input[type="checkbox"]').prop('checked', false)
      break
    default:
  }
})
