(function ($) {
  $(function () {

    $('.mobile-menu__overlay').on('click', function (e) {
      e.preventDefault();
      $('.header__menu-toggle').trigger('click');
    });

    $('.header__menu-toggle, .mobile-menu__toggle').on('click', function (e) {
      e.preventDefault();
      $('body').toggleClass('js-mobile-menu-active');
    });

  });
}(jQuery));