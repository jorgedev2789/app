   /* Prevent default on # hrefs */

  $(function() { "use strict";
      $('a[href="#"]').click(function(event) {
          event.preventDefault();
      });
  });

  /* Todo check toggle */

  $(function() { "use strict";
      $(".todo-box li input").on('click', function() {
          $(this).parent().toggleClass('todo-done');
      });
  });

  /* Horizontal timeline */

  $(function() { "use strict";

      var overall_width = 0;

      $('.timeline-scroll .tl-row').each(function(index, elem) {
          var $elem = $(elem);
          overall_width += $elem.outerWidth() + parseInt($elem.css('margin-left'), 10) + parseInt($elem.css('margin-right'), 10);
      });

      $('.timeline-horizontal', this).width(overall_width);
  });

  /* Custom scrollbar */

  $(document).on('ready', function() {

      $(".scrollable-nice").niceScroll({
          horizrailenabled: false,
          cursorborder: "0",
          cursorwidth: "6px",
          cursorcolor: "#363636",
          zindex: "5555",
          autohidemode: true,
          bouncescroll: true,
          mousescrollstep: '40',
          scrollspeed: '100',
          background: "#cdcdcd",
          cursoropacitymax: "0.6",
          cursorborderradius: "0"
      });

      $(".scrollable-nice").getNiceScroll().resize();

  });

  /* Loading buttons */

  $(function() { "use strict";

      $('.loading-button').click(function() {
          var btn = $(this)
          btn.button('loading');
      });

  });

  /* Custom Inputs */

  $(function() { "use strict";

      $('input[type="checkbox"].custom-checkbox').uniform();
      $('input[type="radio"].custom-radio').uniform();
      $('.custom-select').uniform();

      $(".selector").append('<i class="glyph-icon icon-caret-down"></i>');

      $('.checker span').append('<i class="glyph-icon icon-check"></i>');
      $('.radio span').append('<i class="glyph-icon icon-circle"></i>');

  });

  /* Chosen select */

  $(function() { "use strict";

      $(".chosen-select").chosen();

      $(".chosen-search").append('<i class="glyph-icon icon-search"></i>');
      $(".chosen-single div").html('<i class="glyph-icon icon-caret-down"></i>');

  });

  /* jQuery UI autocomplete */

  $(function() { "use strict";
      var availableTags = [
          "ActionScript",
          "AppleScript",
          "Asp",
          "BASIC",
          "C",
          "C++",
          "Clojure",
          "COBOL",
          "ColdFusion",
          "Erlang",
          "Fortran",
          "Groovy",
          "Haskell",
          "Java",
          "JavaScript",
          "Lisp",
          "Perl",
          "PHP",
          "Python",
          "Ruby",
          "Scala",
          "Scheme"
      ];
      $(".autocomplete-input").autocomplete({
          source: availableTags
      });
  });

  /* Image hover */

  $(function() { "use strict";

      $('.thumbnail-box').hover(function() {

              $('.thumbnail-overlay', this).fadeIn('fast');
              $('.thumbnail-content', this).slideDown('fast');

          },
          function() {

              $('.thumbnail-overlay', this).fadeOut('fast');
              $('.thumbnail-content', this).slideUp('fast');

          });

  });

  /* Tooltips */

  $(function() { "use strict";

      $('.tooltip-button').tooltip({
          container: 'body'
      });

  });

  /* Close response message */

  $(function() { "use strict";
      $('.alert-close-btn').click(function() {
          $(this).parent().addClass('animated fadeOutDown');
      });
  });

  /* Popovers */

  $(function() { "use strict";

      $('.popover-button').popover({
          container: 'body',
          html: true,
          animation: true,
          content: function() {
              var dataID = $(this).attr('data-id');
              return $(dataID).html();
          }
      }).click(function(evt) {
          evt.preventDefault();
      });

  });

  $(function() { "use strict";

      $('.popover-button-default').popover({
          container: 'body',
          html: true,
          animation: true
      }).click(function(evt) {
          evt.preventDefault();
      });
  });

  /* Slidebars */

  (function($) {
      $(document).ready(function() {
          $.slidebars();
      });
  })(jQuery);
