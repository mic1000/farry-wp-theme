var behancekey = "uf11P1eeobqacXMzQfGegtV8ry3SO8WR";
var behancUser = "FarryDKH";

(function($) {
    $('.button-collapse').sideNav({
      menuWidth: 300, // Default is 240
      edge: 'left', // Choose the horizontal origin
      closeOnClick: true // Closes side-nav on <a> clicks, useful for Angular/Meteor
    }
  );

      $(".element").typed({
         stringsElement: $('#typed-strings'),
            typeSpeed: 100,
            backDelay: 600,
            loop: true,
            contentType: 'html', // or text
            // defaults to false for infi	nite loop
            loopCount: false,
            resetCallback: function() { newTyped(); }
      });

$(".fancybox").fancybox();

})(jQuery);