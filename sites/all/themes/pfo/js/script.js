(function ($) {

// Allows the FAQ page functionality. 
Drupal.behaviors.pfoFAQpage = {
  attach: function (context) {

    $('.faq-title').each(function() {
      var hideID = this.id.replace("faq-title-id-", "hidden-answer-id-");
      $(this).click(function(e) {
        $("#"+hideID).slideToggle();
        e.preventDefault();
      });
    });
  }
};

})(jQuery);