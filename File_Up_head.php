<html>
<head>
<?php
$sender=$_POST['user_store'];
$reciever=$_POST['listener_store'];
$name=$_FILES["file"]["name"];
echo $name;
$con = mysql_connect("localhost","root","");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db("chat", $con);
if ($_FILES["file"]["error"] > 0)
  {
  echo "Error: " . $_FILES["file"]["error"] . "<br />";
  }
else
  {
  $allowedExts = array("jpg", "jpeg", "gif", "png");
$extension = end(explode(".", $_FILES["file"]["name"]));
if ((($_FILES["file"]["type"] == "image/gif")
|| ($_FILES["file"]["type"] == "image/jpeg")
|| ($_FILES["file"]["type"] == "image/png")
|| ($_FILES["file"]["type"] == "image/pjpeg"))
&& ($_FILES["file"]["size"] < 200000000000000)
&& in_array($extension, $allowedExts))
  {
    echo "Upload: " . $_FILES["file"]["name"] . "<br />";
    echo "Type: " . $_FILES["file"]["type"] . "<br />";
    echo "Size: " . ($_FILES["file"]["size"] / 1024) . " Kb<br />";

    if (file_exists("upload/" . $_FILES["file"]["name"]))
      {
      echo $_FILES["file"]["name"] . " already exists. ";
      }
    else
      {
      move_uploaded_file($_FILES["file"]["tmp_name"],
      "upload/" . $_FILES["file"]["name"]);
      echo "Stored in: " . "upload/" . $_FILES["file"]["name"];
      }
    }
  }
  //move_uploaded_file($_FILES['file']['tmp_name'],$target);
	$query2="INSERT INTO chat(sender,reciever,message,recd,file_name) VALUES('{$sender}','{$reciever}','Image',0,'{$name}')";
	//echo $query2;
	$r=mysql_query($query2);
    if(!$r)
	echo mysql_error();
	
	header('location: ' . $_SERVER['HTTP_REFERER']);
	?>
</head>
<html>