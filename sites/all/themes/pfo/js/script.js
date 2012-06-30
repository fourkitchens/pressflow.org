/**
 * Pressflow-specific logic
 */
(function ($) {

/**
 * Mega-awesome real-time search thingy!!
 * Filters FAQs as you type
 *
 * @author
 *   Chris Ruppel
 */

Drupal.behaviors.faqSearch = {
  attach: function (context) {

    // vars
    var faqs = [];
    var i = 0; // start at 1 to stay in sync with Views classes

    // Fetch FAQs once to save cycles
    $('.views-row').each(function(){

      // collect data from markup
      faqs[i] = {
        q: $(this).find('.question span').html(),
        a: $(this).find('.answer div').html(),
        id: i++,
      };

    });

    // insert search box
    $('.page-faq .view-faq-view').prepend('<input id="magic-search" type="text" placeholder="type to search">');
    $('#magic-search').focus();

    // Search code. Does simple searching on each key press,
    // then shows/hides individual FAQs
    $('#magic-search').keyup(function(){

      // More vars
      var val = $(this).val().toLowerCase(),
          test = '';

      // Loop through data and see which ones match
      for(var x=0; x <= $(faqs).length; x++){

        // Moar vars!!!
        var thisFaq = faqs[x];
        var question = '';
        var answer = '';

        // flatten
        question = thisFaq.q.toString().toLowerCase();
        answer = thisFaq.a.toString().toLowerCase();

        // Filter this entry, then show/hide
        if ((question.indexOf(val)) >= 0 || (answer.indexOf(val) >= 0)) {
          $('.views-row-'+(x+1)).show('fast');
        }
        else {
          $('.views-row-'+(x+1)).hide('fast');
        }

      }
    });

  }
};

/*

// Drupal.behaviors Example

Drupal.behaviors.nameSpace = {
  attach: function (context) {

    // code goes here

  }
};

*/

})(jQuery);