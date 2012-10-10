<html>
<head>
</head>
<body><form enctype="multipart/form-data" method="post" action="file_Up_head.php">
<input type="hidden" name="MAX_FILE_SIZE" value="102400" />
<label for="name" >Name:</label>
<input type="text" id="name" name="name" value="<?php if(!empty($name)) echo $name; ?>" />
<br />
<label for="file">File Name:</label>
<input type="file" id="file" name="file" />
<br />
<input type="submit" value="Add" name="Submit" />
</form>
</body>
</html>