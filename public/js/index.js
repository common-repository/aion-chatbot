
var $messages = $('.an-messages-content');
var serverResponse = "wala";


var suggession;
//speech reco
// try {
//   var SpeechRecognition = window.SpeechRecognition || window.webkitSpeechRecognition;
//   var recognition = new SpeechRecognition();
// }
// catch(e) {
//   console.error(e);
//   $('.no-browser-support').show();
// }

// $('#start-record-btn').on('click', function(e) {
//   recognition.start();
// });

// if(recognition){
//   recognition.onresult = (event) => {
//     const speechToText = event.results[0][0].transcript;
//    document.getElementById("MSG").value= speechToText;
//     //console.log(speechToText)
//     insertMessage()
//   }
  
// }


function listendom(no){
  console.log(no)
  //console.log(document.getElementById(no))
document.getElementById("MSG").value= no.innerHTML;
  insertMessage();
}

$(window).load(function() {
  $messages.mCustomScrollbar();
  setCookie('sayhello', '', 1);
  // getimgchat();
  // setTimeout(function() {
  //   serverMessage("hello i am customer support bot type hi and i will show you quick buttions");
  // }, 100);
  // $('#chatblock').addClass('hidechat');

});

function updateScrollbar() {
  $messages.mCustomScrollbar("update").mCustomScrollbar('scrollTo', 'bottom', {
    scrollInertia: 10,
    timeout: 0,
  });
}



function insertMessage() {
  msg = $('.an-message-input').val();
  if ($.trim(msg) == '') {
    return false;
  }
  $('<div class="message message-personal">' + msg + '</div>').appendTo($('.mCSB_container')).addClass('new');
   fetchmsg() 
  
  $('.an-message-input').val(null);
  updateScrollbar();

}

document.getElementById("mymsg").onsubmit = (e)=>{
  e.preventDefault() 
  insertMessage();
  //serverMessage("Hello");
  //speechSynthesis.speak( new SpeechSynthesisUtterance("IAM Aion chat assistant"))
}

function serverMessage(response2) {


  if ($('.an-message-input').val() != '') {
    return false;
  }
  $('<div class="message loading new"><figure class="avatar"><img id="an-avatar-img" src="'+ retimg() +'"  /></figure><span></span></div>').appendTo($('.mCSB_container'));
  // getimgchat();
  updateScrollbar();
  

  setTimeout(function() {
    $('.message.loading').remove();
    $('<div class="message new"><figure class="avatar"><img id="an-avatar-img" src="'+ retimg() +'" /></figure>' + response2 + '</div>').appendTo($('.mCSB_container')).addClass('new');
    // getimgchat();
    updateScrollbar();
  }, 100 + (Math.random() * 20) * 100);


}

function getimgchat(){
  let el = document.getElementById('an-logo');
  let img = el.getAttribute('data-an-logo');
  let imgdist = document.getElementById('an-avatar-img');
  console.log('image dist :',imgdist.src);
  imgdist.src=img;
  //imgdist.src=img;
  console.log('image url: ',img);
}


function fetchmsg(){

    //  var url = 'http://localhost:5000/send-msg';
     var url = 'http://51.68.172.81:8080/communication_front';

      let agent_id= document.getElementById('user-agent-id');
      console.log('Agent id:', agent_id.value);
      const data = new URLSearchParams();
      let body = [];

      for (const pair of new FormData(document.getElementById("mymsg"))) {
          data.append(pair[0], pair[1]);
          // console.log(pair);
          // console.log(body)
          var varjson = {'payload' : pair[1], 'agent-id': agent_id.value}
          var mydata = JSON.stringify(varjson);
      }
      
      console.log("data : =>",mydata)
        fetch(url, {
          method: 'POST',
          // headers: {
          //   'Content-Type': 'application/json'
          // },
          body:mydata
        }).then(res => res.json())
         .then(response => {
           
          console.log(response.answer);
          serverMessage(response.answer);
          //  speechSynthesis.speak( new SpeechSynthesisUtterance(response.said))
         })
          .catch(error => console.error('Error :', error));

}


$(document).ready(function(){
  $('#chatblock').addClass('hidechat');
})

/**
 * 
 * create a cookie
 */
function setCookie(cname, cvalue, exdays) {
  const d = new Date();
  d.setTime(d.getTime() + (exdays*24*60*60*1000));
  let expires = "expires="+ d.toUTCString();
  document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}

/**
 * 
 * get Cookie name
 */
function getCookie(cookieName) {
  let cookie = {};
  document.cookie.split(';').forEach(function(el) {
    let [key,value] = el.split('=');
    cookie[key.trim()] = value;
  })
  return cookie[cookieName];
}

/**
 * get welcome message value
 */
function getchatwelcomemessage(){
  let elm = document.getElementById('user-welcome-message');
  console.log('elm welcome message :', elm.value)
  return elm.value;
}

/**
 * action to show chatbot messenger
 */
function btnaction(){
  var el = document.querySelector("#chatblock");
  
  console.log('coooookies : ',getCookie("sayhello"));
  if(el.classList.contains('hidechat') ){
    setTimeout(function() {
    $('#chatblock').removeClass('hidechat');
    $('#chatblock').addClass('showchat');
    }, 100);

    setTimeout(function(){
      $('#chatbtnsection').hide();
    }, 100);

    $messages.mCustomScrollbar();
    setTimeout(function() {
      if(getCookie("sayhello") != "activate"){
        if(getchatwelcomemessage() === ""){
          serverMessage("hello i am customer support bot type hi and i will show you quick buttions");
        }else{
          serverMessage(getchatwelcomemessage());
        }
          
          setCookie('sayhello', 'activate', 1);
      }
      
    }, 100);

  }else if(el.classList.contains('showchat'))
  {
    setTimeout(function() {
      $('#chatblock').removeClass('showchat');
      $('#chatblock').addClass('hidechat');
      
    }, 100);
    setTimeout(function(){
      $('#chatbtnsection').show();
    }, 100);
  }
  
}

/**
 * get chatbot url image|icon
 * @returns string
 */
function retimg(){
  let el = document.getElementById('an-logo');
  let img = el.getAttribute('data-an-logo');
  console.log('image src :', img);
  return img;
  
}

/**
 * custom
 */
$(document).ready(function(){

  setTimeout(function () {
    $('#chatbtnsection').addClass('loading')
  }, 4000);

  setTimeout(function () {
    $('#chatbtnsection').removeClass('loading');
  }, 10000);
});

$('#chatbtnsection').mouseover(function(){
  $('#chatbtnsection').removeClass('loading');
});
