<html>
<head>
<script src="jquery.min.js" type="text/javascript" charset="utf-8"></script>
    <script type="text/javascript" charset="utf-8">

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
xmlhttp.open("GET","livesearchs.php?q="+str,true);
xmlhttp.send();
}
</script>
</head>
<body>

<form>
<textarea id="chatTextArea" size="30" onkeyup="showResult(this.value)" ></textarea>
<div id="livesearch"></div>
</form>

</body>
</html> 