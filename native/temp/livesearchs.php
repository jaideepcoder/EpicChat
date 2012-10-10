<?php

include 'database_connection.php';


//get the q parameter from URL
	$q=$_GET["q"];

//lookup all links from the xml file if length of q>0

$count=str_word_count($q, 0);

$arr1=array();

$arr2=array();


$arr2=str_word_count($q, 1);

$hint = "";
$str = "";
$c=0;
	
if ($count>0)
{
	$str=$arr2[($count-1)];
			
	
	$tquery = "SELECT `words`
			 FROM `user_word` ";
	
	$tresult = mysql_query($tquery);
	
	if($tresult)
	{
		
		while($trows=mysql_fetch_array($tresult)){
		
			$arr1[$c]=$trows["words"];
			$c++;
		}
	}
	
	for($x=0;$x<$c;$x++) {
		
		$len=strlen($str);
		$str1=substr($arr1[$x],0,$len);
			if( strcmp ($str,$str1)==0){
				$hint=$hint."<div id=\"value\">".$arr1[$x]."</div>";		
			}
	
	
	}
	
}

// Set output to "no suggestion" if no hint were found
// or to the correct values
if ($hint=="")
  {
  $response="no suggestion";
  }
else
  {
  $response=$hint;
  }

//output the response
echo $response;
?> 