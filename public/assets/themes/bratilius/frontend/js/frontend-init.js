new WOW().init();

jQuery(document).ready(function($) {

    /* Sticky bars */

    $(function() { "use strict";

        $('.sticky-nav').hcSticky({
            top: 50
        });

    });

    /* Main nav */

    $(function() { "use strict";

      $('.main-nav').superfish({
          animation:     {opacity:'show'},
          animationOut:  {opacity:'hide'},
      });

    });

    /* Responsive nav */

    $(function() { "use strict";

        $('#responsive-menu').click(function(){
            $('.main-header ul.main-nav').toggle();
        });

    });

});