import $ from 'jquery';
import './cardreveal.scss';

$(document).ready(function () {
  $(document).find('[data-card-reveal]').each(function () {
    const $this = $(this);

    $this.find('[data-card-reveal-btn]').on('click', function () {
      $this.find('[data-card-reveal-body]').slideToggle();
    });
  });
});
