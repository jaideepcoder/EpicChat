$(document).ready(function() {
	
	$("button#submit").click(function() {
		var _user = $('#user').val();
		$("#splash").hide('slow', function() {
		$.ajax({
			type: 'POST',
			url: base_url+'index.php/chat/setUser',
			data: {
				user: _user
			},
			success: function() {
				$('html').load(base_url);
			} 
		});	
		});
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
						list += "<li id='"+data[x][y]+"'>"
						list += data[x][y]+"</li>";
					}
				}
				list += "</ul>";
				$('#chatFriendList').html(list);
			}
		});
	}
	setInterval(getOnline, 500);

	//function selectReciever() {
		$('li').click(function() {
			var listener = $(this).attr();
			alert (listener);
		});
	//}
	
	
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
	}
	//setTimeout(initGetMessages, 0);
	
	function getMessages() {
		var count = 0;
		$.ajax({
			type: 'POST',
			url: base_url+'index.php/chat/messages',
			dataType: 'json',
			success: function(data) {
				for(var i=0; i<data.length; i++) {
					$('#chatMessageArea').append("<div id='data'><div id='sender'>"+data[i].sender+"</div>");
					$('#chatMessageArea').append("<div id='timestamp'>"+data[i].timestamp+"</div>");
					$('#chatMessageArea').append("<div id='message'>"+data[i].message+"</div></div><hr />");
				}
			}
		});
	}
	setTimeout(setInterval(getMessages, 500), 1000);
	$('#data').hover(function() {
		$('#timestamp').css('color', '#000000');
	});
	
	$('#chatSubmit').click(function() {
		var message = $('#chatTextArea').val();
		document.getElementById('chatTextArea').value = '';
		$.ajax({
			type: 'POST',
			url: base_url+'index.php/chat/addMessage',
			data: {
				sender: 'Jaideep',
				reciever: 'Tanay',
				message: message
			}
		});
	});
});


