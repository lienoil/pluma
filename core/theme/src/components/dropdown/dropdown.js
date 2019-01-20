import $ from 'jquery';

$('.dropdown a, .sidebar a').keydown(function(e){
  const $this = $(this);

  switch (e.which) {
    case 38: // up arrow
      e.preventDefault();
      var focused = $(':focus');
      if (focused.hasClass('dropdown-toggle') || focused.is(':first-child')) {
        $this.parents('.dropdown').find('.dropdown-item').last().focus();
      } else {
        focused.prev().focus();
      }
      break;

    case 40: // down arrow
      e.preventDefault();
      var focused = $(':focus');
      if (focused.hasClass('dropdown-toggle') || focused.is(':last-child')) {
        $this.parents('.dropdown').find('.dropdown-item').first().focus();
      } else {
        focused.next().focus();
      }
      break;

    case 36: // home
      e.preventDefault();
      $this.closest('.dropdown-menu').find('a:first').focus();
      break;

    case 35: // end
      e.preventDefault();
      $this.closest('.dropdown-menu').find('a:last').focus();
      break;
  }
});
