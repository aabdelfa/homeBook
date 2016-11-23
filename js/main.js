$(document).ready(function(){

  $('#notDropdown').one('click', function() {
    $.ajax({
      url: "../Controllers/welcomeController.php",
      type: "post",
      data: {
        seen: 1,
        validate_seen: true
      },
      success: function(data) {
        console.log(data);
        $('#notificationsNot').hide();
      },
      error: function(responseText) {
       console.log(responseText);
      }
    });
  });

  $('#messagesDropdown').on('click', function() {
    $('#messagesNot').hide();
  });

  $('#tasksDropdown').on('click', function() {
    $('#tasksNot').hide();
  });

  $('#notDropdown').click( function() {
    $('#dropdown').toggleClass('open');
  })

  $('body').on('click', function (e) {
    if (!$('#dropdown').is(e.target) 
        && $('#dropdown').has(e.target).length === 0 
        && $('.open').has(e.target).length === 0
        && !$("[data-toggle=popover]").data('clicked')
    ) {
        $('#dropdown').removeClass('open');
      console.log($("[data-toggle=popover]").data('clicked'));
      }
  });
  $('.tooltip-demo').tooltip({
      selector: "[data-toggle=tooltip]",
      container: "body"
  })
  // popover demo
  $("[data-toggle=popover]")
      .popover({html:true})

});
function spanShow(id, id2) {
  $(id).removeClass('hidden');
  $(id2).removeClass('hidden');
}
function spanHide(id, id2) {
  $(id).addClass('hidden');
  $(id2).addClass('hidden');
}
function hideNotification(id) {
  $.ajax({
      url: "../Controllers/welcomeController.php",
      type: "post",
      data: {
        hidden: 1,
        id: id,
        validate_hidden: true
      },
      success: function(data) {
        console.log(data);
        $("[data-toggle=popover]").popover('hide');
      },
      error: function(responseText) {
       console.log(responseText);
      }
    });
}