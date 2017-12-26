$( document ).ready(function() {
    console.log( "ready!" );
//    aCall();
});

function buildUserSegment(userInput){
  var segment = '<div class="segments load">'
              +   '<div class="from-user top">'
              +     '<div class="summary">'
              +       '&nbsp;'
              +     '</div>'
              +     '<div class="message-inner">'
              +       '<p>' + userInput + '</p>'
              +     '</div>'
              +   '</div>'
              + '</div>';

    $('#scrollingChat').append(segment);
    scrollToChatBottom();
//  $('#scrollingChat').html('what');
}

function buildWatsonSegment(userInput){
  var segment = '<div class="segments load">'
              +   '<div class="from-watson latest top">'
              +     '<div class="summary">'
              +       '&nbsp;'
              +     '</div>'
              +     '<div class="message-inner">'
              +       '<p>' + userInput + '</p>'
              +     '</div>'
              +   '</div>'
              + '</div>';

    $('#scrollingChat').append(segment);
    scrollToChatBottom();
//  $('#scrollingChat').html('what');
}



function userInputEvent(event,inputBox){
  // Submit on enter key, dis-allowing blank messages
  if (event.keyCode === 13 && inputBox.value) {
    console.log("Detected");
    var userInput = $('#textInputOne').val();
    console.log(userInput);
    buildUserSegment(userInput);
    $('#textInputOne').val('');
    aCall(userInput);
  }
}


function aCall(userInput){
//  $.ajax({url: "/api/message", success: function(result){
//    console.log('Success call');
//  }})  

   if(userInput){
   // Built http request
   var http = new XMLHttpRequest();
   http.open('POST', '/api/message', true);
   http.setRequestHeader('Content-type', 'application/json');
   http.onreadystatechange = function() {
     if (http.readyState === 4 && http.status === 200 && http.responseText) {
       //Api.setResponsePayload(http.responseText);
       console.log(http.responseText);
       buildWatsonSegment(http.responseText);
     }
  };
  http.send(JSON.stringify({input: userInput}));
  }
                                    
}

 // Scroll to the bottom of the chat window (to the most recent messages)
 //   // Note: this method will bring the most recent user message into view,
 //     //   even if the most recent message is from Watson.
 //       //   This is done so that the "context" of the conversation is maintained in the view,
 //         //   even if the Watson message is long.
function scrollToChatBottom() {
  var scrollingChat = document.querySelector('#scrollingChat');
  // Scroll to the latest message sent by the user
  var scrollEl = scrollingChat.querySelector('.fromUser' + '.latest');
  if (scrollEl) {
    scrollingChat.scrollTop = scrollEl.offsetTop;
  }
}
