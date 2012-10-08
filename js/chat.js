$(document).ready(function() {
	$('#splash').hide();
	if(state == 0) {
		$('#splash').show('slow');
	}
	$("button#submit").click(function() {
		var _user = $('#user').val();
		$("#splash").hide('slow', function() {
		$.ajax({
			type: 'POST',
			url: base_url+'index.php/chat/setUser',
			data: {
				user: _user,
				online: 1
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
					for(y in data[x]) {
						$('#chatMessageArea').append(data[x][y]+"<br />");
					}
				}
			}
		});
	}
	//initGetMessages();
	function getMessages() {
		$.ajax({
			type: 'POST',
			url: base_url+'index.php/chat/messages',
			dataType: 'json',
			success: function(data) {
				for(x in data) {
					for(y in data[x]) {
						$('#chatMessageArea').append(data[x][y]+"<br />");
					}
				}
			}
		});
	}
	setInterval(getMessages, 500);
	window.setInterval(function() {
  	var elem = document.getElementById('chatMessageArea');
  	elem.scrollTop = elem.scrollHeight;
	}, 500);
	
	$('#chatSubmit').click(function() {
		var message = $('#chatTextArea').val();
		$.ajax({
			type: 'POST',
			url: base_url+'index.php/chat/addMessage',
			data: {
				message: message
			}
		})
	});
});


