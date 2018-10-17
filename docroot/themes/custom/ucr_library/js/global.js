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


        // Make news carousel multi-column, single increment
        $('#news-carousel').on('slide.bs.carousel', function (e) {
          var $e = $(e.relatedTarget);
          var idx = $e.index();
          var itemsPerSlide = 2;
          var totalItems = $('.carousel-item').length;

          if (idx >= totalItems - (itemsPerSlide - 1)) {
            var it = itemsPerSlide - (totalItems - idx);
            for (var i = 0; i < it; i++) {
              // append slides to end
              if (e.direction == "left") {
                $('.carousel-item').eq(i).addClass('active').appendTo('.carousel-inner');
              } else {
                $('.carousel-item').eq(0).addClass('active').appendTo('.carousel-inner');
              }
            }
          }
        });
      });
    }
  };

})(jQuery, Drupal);
