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
				list = "<ul>";
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
			$(this).addClass('active');
		});
	//}
	
	
	function initGetMessages() {
		$.ajax({
			type: 'POST',
			url: base_url+'index.php/chat/initMessages',
			dataTpye: 'json',
			success: function(data) {
				for(x in data) {
					var obj = jQuery.parseJSON(data[x]);
					$('#chatMessageArea').append(obj.sender+"<br />");
					$('#chatMessageArea').append(obj.reciever+"<br />");
					$('#chatMessageArea').append(obj.message+"<br />");
					
				}
				/*for(x in data) {
					
					for(y in data[x]) {
						$('#chatMessageArea').append(data[x][y]+"<br />");
					}
				}*/
			}
		});
	}
	setTimeout(initGetMessages, 0);
	function getMessages() {
		$.ajax({
			type: 'POST',
			url: base_url+'index.php/chat/messages',
			dataType: 'json',
			success: function(data) {
				var ob = jQuery.parseJSON(data);
				alert(ob.sender);
				alert()
				for(x in data) {
					/*for(y in data[x]) {
						$('#chatMessageArea').append("<div id='sender'>"+data[x][y]+"</div>");
					}*/
					var obj = jQuery.parseJSON(data[x]);
					$('#chatMessageArea').append(obj.sender+"<br />");
					$('#chatMessageArea').append(obj.reciever+"<br />");
					$('#chatMessageArea').append(obj.message+"<br />");
				}
			}
		});
	}
	setTimeout(setInterval(getMessages, 500), 1000);
	
	
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


