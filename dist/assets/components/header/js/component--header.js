jQuery($ => {
  $('.header-menu-toggle').on('click', () => {
    $('.header-menu').toggleClass('js-menu-active');
    $('body').toggleClass('js-no-scroll');
  });
});