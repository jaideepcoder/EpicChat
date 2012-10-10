<div id="chatMessageArea"></div>
<div id="chatFriendList"></div>
<div id="chatControl"><?= $smiley_table; ?></div>
<textarea id="chatTextArea" onkeyup="showResult(this.value)"></textarea>
<form id="chatUpload" enctype="multipart/form-data" method="post" action="http:////localhost/EpicChat/file_Up_head.php">
<input type="hidden" name="MAX_FILE_SIZE" value="102400000000000" />
<label for="file">File Name:</label>
<input type="file" id="file" name="file" />
<input type="submit" value="Add" name="Submit" />
<input type="hidden" value="" id="user_store" name="user_store"/>
<input type="hidden" value="" id="listener_store" name="listener_store"/>
</form>
<button id="chatSubmit">Send</button>
<div id="livesearch"></div>