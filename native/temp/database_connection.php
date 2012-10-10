<?php $con=mysql_connect("localhost","root");
        if(!$con)
			echo "failed";
        $db_select=mysql_select_db("chat",$con);
        if(!$db_select)
			echo ("not working".mysql_error());
			?>
			