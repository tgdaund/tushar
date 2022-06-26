<?php

	$db_name = "u972264077_vtc";
	$mysql_username = "u972264077_pda";
	$mysql_password = "pda2008";
	$server_name = "mysql.hostinger.in";
	$conn = mysqli_connect($server_name, $mysql_username, $mysql_password, $db_name);

	$shtml = $_POST["shtml"]; // Source HTML
	//$myfile = fopen("newfile.txt", "w") or die("Unable to open file!");
	//fwrite($myfile, $shtml);
	//fclose($myfile);
	//echo "Successfully Created File.";

 	/* $myfile = fopen("CEWB.htm", "r") or die("Unable to open file!");
	$shtml = fread($myfile,filesize("CEWB.htm"));
	fclose($myfile); */

	$dom = new DOMDocument();
	$dom->loadHTML($shtml);

	$rows = $dom->getElementsByTagName('tr');

	$sql="";
	$firstrow=true;
	foreach ($rows as $row)
	{
		if($firstrow)
		{
			$firstrow=false;
			continue;
		}
		$cols = $row->getElementsByTagName('td');
		$td1 = $cols->item(0)->nodeValue;
		$arr = explode("\n", $td1);
		$CEWBNO = $arr[0];
		//$EWBDate = $arr[1];
		$CEWBDate = DateTime::createFromFormat('d/m/Y H:i:s', ltrim($arr[1]))->format('Y-m-d H:i:s');

		$fromplace = $cols->item(1)->nodeValue;
		$Mode = $cols->item(2)->nodeValue;
		$VehicleNo = $cols->item(3)->nodeValue;
		//$Status = $cols->item(4)->nodeValue;

		$sql .= "INSERT INTO CEwb(CEwbNo, Date, VehicleNo, FromPlace, Mode)
					 VALUES ('$CEWBNO', '$CEWBDate', '$fromplace', '$VehicleNo', '$Mode'); \n";
	}
	if ($conn->multi_query($sql) === TRUE)
	{
		echo "Records Created successfully.";
	}
?>