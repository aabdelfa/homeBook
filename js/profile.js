
$(document).ready(function(){

  /* 
  add mask to phone number
  */
  $('#phone').mask('(000) 000-0000');

  /* 
  validate password and confirm password are equal to each other
  */
  $('#password2').on('input',function(e) { 
    if( $('#password2').val() != $('#password').val()) {
      $('#passwordCheck').addClass('has-error');
      $('#submitButton').prop('disabled', true);
    } else if( $('#password2').val() == $('#password').val()) {
      $('#passwordCheck').removeClass('has-error');
      $('#submitButton').prop('disabled', false);
    }else if($('#password2').val() == '' && $('#password').val() == '') {
      $('#submitButton').prop('disabled', false);
      $('#passwordCheck').removeClass('has-error');
    }
  });
  $('#password').on('input',function(e) { 
    if( $('#password2').val() != $('#password').val()) {
      $('#submitButton').prop('disabled', true);
    } else if( $('#password2').val() == $('#password').val()) {
      $('#submitButton').prop('disabled', false);
    }else if($('#password').val() == '' && $('#password').val() == '') {
      $('#submitButton').prop('disabled', false);
      $('#passwordCheck').removeClass('has-error');
    }
  });
  /* 
  Uploading Image
  */
  $('#image').on('change', function() {
    if (this.files[0].size >=3000000) {
      $('#image').val('');
      new PNotify({
        title: 'Oops',
        text: 'Image size exceeded maximum limit (3 Mb)',
        type: 'error'
      });
    }
    else {
      $('#imageSubmit').removeClass('hidden');
    }
  });
  /* 
  Profile form submit
  */
  $('#profileForm').submit(function(event) {
    event.preventDefault();
    $("#body").addClass('disable');
    $('#loading-image').removeClass('hidden');

    $.ajax({

      url: "../Controllers/profileController.php",
      data: {
        submit: true,
        username: $('#username').val(),
        first_name: $('#first_name').val(),
        last_name: $('#last_name').val(),
        password: $('#password').val(),
        email: $('#email').val(),
        phone: $('#phone').val(),
      },
      dataType: 'html',
      method: "GET",
      success: function(data) {
        new PNotify({
          title: 'Congratulations',
          text: data,
          type: 'success'
        });
      },
      error: function(responseText) {
        new PNotify({
          title: 'Oops',
          text: responseText.responseText,
          type: 'error'
        });
      }
    });

    $("#body").removeClass('disable');
    $('#loading-image').hide();
  });

});
