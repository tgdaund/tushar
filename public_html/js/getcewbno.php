<?php

	$db_name = "u972264077_vtc";
	$mysql_username = "u972264077_pda";
	$mysql_password = "pda2008";
	$server_name = "mysql.hostinger.in";
	$conn = mysqli_connect($server_name, $mysql_username, $mysql_password, $db_name);

	$result = mysqli_query($conn,"SELECT CEwbNo FROM CEwb WHERE CEwbNo NOT IN (SELECT CEwbNo FROM Ewb)");
	if (mysqli_num_rows($result) > 0)
	{
		while($row = mysqli_fetch_assoc($result))
			echo $row["CEwbNo"] . " ";
	}
?>	