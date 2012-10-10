
$(document).ready(function() {
	//alert(sessionStorage.user);
	$('#container').hide();
	if(typeof(Storage)!=="undefined") {
		if(sessionStorage.user != '') {
			$('#container').show('slow');
			$('#splash').hide('hide');
			$('#chatMessageArea').html('');			$.ajax({
			type: 'POST',
			url: base_url+'index.php/chat/setUser',
			data: {
				user: sessionStorage.user
			},
		});
		}
		else {
			//sessionStorage.user="NA";
		}
	}
	else
	{
		document.write("Sorry! No web storage support..");
	}

	
	$("button#submit").click(function() {
		var user = $('#user').val();
		var trim = user.replace(/^\s+|\s+$/g, '');
		if(trim != '') {
		$("#splash").hide('slow', function() {
		$.ajax({
			type: 'POST',
			url: base_url+'index.php/chat/setUser',
			data: {
				user: user
			},
		});
		});
		$('#container').show('slow');
		}
		sessionStorage.user = trim;
	});
		
	function getOnline() {
		var list="";
		$.ajax({
			type: 'POST',
			url: base_url+'index.php/chat/showOnline',
			dataType: 'json',
			success: function(data) {
				for(x in data) {
					for(y in data[x]) {
						list += "<div id='online'>"
						list += data[x][y]+"</div>";
					}
				}
				list += "</ul>";
				$('#chatFriendList').html(list);
			}
		});
	}
	getOnline();
	setInterval(getOnline, 2000);

	//function selectReciever() {
		$('#chatFriendList').delegate('div#online', 'click', function() {
			var listener = $(this).text();
			//alert (listener);
			if(sessionStorage.listener != listener) {
				sessionStorage.listener = listener;
				$('#chatMessageArea').html('');
			}
			
		});
		
		$('#livesearch').delegate('div#value', 'click', function() {
			var text = $(this).text();
			//alert (listener);
			var adapt = $('#chatTextArea').val();
			var lastIndex = adapt.lastIndexOf(" ");
			var str = adapt.substring(0, lastIndex);
			str = str+" "+text;
			document.getElementById('chatTextArea').value=str;
			
		});
		
	//}
	
	/*
	function initGetMessages() {
		$.ajax({
			type: 'POST',
			url: base_url+'index.php/chat/initMessages',
			dataTpye: 'json',
			success: function(data) {
				for(var i=0; i<data.length; i++) {
					$('#chatMessageArea').append("<div id='data'><div id='sender'>"+data[i].sender+"</div>");
					$('#chatMessageArea').append("<div id='timestamp'>"+data[i].timestamp+"</div>");
					$('#chatMessageArea').append("<div id='message'>"+data[i].message+"</div></div><hr />");
				}
			}
		});
	}*/
	//setTimeout(initGetMessages, 0);
	
	function getMessages() {
		var count = 0;
		$.ajax({
			type: 'POST',
			url: base_url+'index.php/chat/messages',
			data: {
				sender: sessionStorage.user,
				reciever: sessionStorage.listener
			},
			dataType: 'json',
			success: function(data) {
				for(var i=0; i<data.length; i++) {
					$('#chatMessageArea').append("<div id='sender'>"+data[i].sender+"</div>");
					$('#chatMessageArea').append("<div id='timestamp'>"+data[i].timestamp+"</div>");
					$('#chatMessageArea').append("<div id='message'>"+data[i].message+"</div><hr />");
				}
			}
		});
	}
	setInterval(getMessages, 5000);
	$('#data').hover(function() {
		$('#timestamp').css('color', '#000000');
	});
	function scroller(){
		var myDiv = document.getElementById('chatMessageArea');
		myDiv.scrollTop = myDiv.scrollHeight;
}
setInterval(scroller,500);

	$('#chatSubmit').click(function() {
		var message = $('#chatTextArea').val();
		var trimmed = message.replace(/^\s+|\s+$/g, '');
		document.getElementById('chatTextArea').value = '';
		if(trimmed != "") {
		$.ajax({
			type: 'POST',
			url: base_url+'native/temp/add_word.php',
			data: {
				q: trimmed
			}
		});
		$.ajax({
			type: 'POST',
			url: base_url+'index.php/chat/addMessage',
			data: {
				sender: sessionStorage.user,
				reciever: sessionStorage.listener,
				message: trimmed
			},
			dataType: 'json',
			success: function(data) {
					$('#chatMessageArea').append("<div id='sender'>"+data.sender+"</div>");
					$('#chatMessageArea').append("<div id='timestamp'>"+data.timestamp+"</div>");
					$('#chatMessageArea').append("<div id='message'>"+data.message+"</div><hr />");
			}
		});
		}
	});
	setInterval(getMessages, 500);
	function scroller(){
		var myDiv = document.getElementById('chatMessageArea');
		myDiv.scrollTop = myDiv.scrollHeight;
	}
	setInterval(scroller, 500);
	$('#close').click(function () {
		$.ajax({
			type: 'POST',
			url: base_url+'index.php/chat/unsetUser',
			data: {
				user: sessionStorage.user
			}
		});
		alert("Good bye "+sessionStorage.user+".");
		sessionStorage.user = "";
		$('#container').hide('slow');
		$('#chatMessageArea').html('');
		$('#splash').show('slow');
	});
	
	function initFile() {
		document.getElementById('user_store').value=sessionStorage.user;
		document.getElementById('listener_store').value=sessionStorage.listener;
	}
	setInterval(initFile, 500);
});


function showResult(str)
{
if (str.length==0)
  {
  document.getElementById("livesearch").innerHTML="";
  document.getElementById("livesearch").style.border="0px";
  return;
  }
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
  //redundant code
  // else
  // {// code for IE6, IE5
  // xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  // }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById("livesearch").innerHTML=xmlhttp.responseText;
    document.getElementById("livesearch").style.border="1px solid #A5ACB2";
    }
  }
xmlhttp.open("GET","http://localhost/EpicChat/native/temp/livesearchs.php?q="+str,true);
xmlhttp.send();
}

