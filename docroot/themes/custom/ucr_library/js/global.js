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

        // Make dropdown header links clickable
        $('li.dropdown :first-child').once().on('click', function () {
          var $el = $(this).parent();
          var $a = $el.children('a.dropdown-toggle');
          if ($a.length && $a.attr('href')) {
            location.href = $a.attr('href');
          }
          // This code will make the header links work on a double click, or require the section to be open first.
          /*
          if ($el.hasClass('show')) {
            var $a = $el.children('a.dropdown-toggle');
            if ($a.length && $a.attr('href')) {
              location.href = $a.attr('href');
            }
          }*/

        });
      });
    }
  };

})(jQuery, Drupal);
