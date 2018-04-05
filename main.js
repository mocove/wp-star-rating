jQuery(document).ready(function($) {
  $('#wpsr_rate_1').click(function() {
    $('#wpsr_rate').val(1);
  });
  $('#wpsr_rate_2').click(function() {
    $('#wpsr_rate').val(2);
  });
  $('#wpsr_rate_3').click(function() {
    $('#wpsr_rate').val(3);
  });
  $('#wpsr_rate_4').click(function() {
    $('#wpsr_rate').val(4);
  });
  $('#wpsr_rate_5').click(function() {
    $('#wpsr_rate').val(5);
  });
  $('#wpsr_rate_clear').click(function() {
    $('#wpsr_rate').val('');
    reflectCurrentRatingInForm(0);
  });

  $('.wpsr_rating').mouseover(function() {

    $('.wpsr_rating').removeClass('gold');
    var id = $(this).attr('id');
    $('#' + id).addClass('gold');
    $('#' + id).prevAll().addClass('gold');
  }).mouseleave(function() {
    $('.wpsr_rating').removeClass('gold');
    var currentRating = $('#wpsr_rate').val();
    reflectCurrentRatingInForm(currentRating);
  });

  function reflectCurrentRatingInForm(rating) {
    if (rating === 0) {
      $('.wpsr_rating').removeClass('gold');
    } else {
      var idRating = "wpsr_rate_" + rating;
      $('#' + idRating).addClass('gold');
      $('#' + idRating).prevAll().addClass('gold');
    }
  }

});
