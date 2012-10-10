<?php
	require 'database_connection.php';

//get the q parameter from URL

	$word=$_POST['q'];
	$count=str_word_count($word, 0);
	$arr1=array();
	$arr2=array();
	$arr2=str_word_count($word, 1);
	
	foreach($arr2 as $x){
	
	$query="SELECT *
			 FROM `user_word`
			 WHERE `words` like '{$x}'";
	
	$result=mysql_query($query,$con);
	
	$row=mysql_fetch_array($result);

	
	
	if($row["words"] != ""){
				$feq=$row["frequency"]+1;
				$query2="UPDATE `user_word` SET `frequency`='{$feq}' WHERE `words` like '{$x}'";
				$result2=mysql_query($query2,$con);
					
				}
		else{
		$query1="INSERT INTO `user_word`(`words`,`frequency`) VALUES ('{$x}',1)";
		$result1=mysql_query($query1,$con);
	}
	}

?>