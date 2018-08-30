/**
 * @file
 * Global utilities.
 *
 */
(function ($, Drupal) {

  'use strict';

  Drupal.behaviors.ucr_library_subtheme = {
    attach: function (context, settings) {
      $(document).ready(function () {
        /*
        if ($(window).width() >= 980) {
          $(".navbar .dropdown-toggle").hover(function () {
            $(this).parent().toggleClass("show");
            $(this).parent().find(".dropdown-menu").toggleClass("show");
          });

          $(".navbar .dropdown-menu").mouseleave(function () {
            $(this).removeClass("show");
          });
        }*/
      });
    }
  };

})(jQuery, Drupal);
