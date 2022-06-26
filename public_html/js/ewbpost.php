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

 	/* $myfile = fopen("ewb.htm", "r") or die("Unable to open file!");
	$shtml = fread($myfile,filesize("ewb.htm"));
	fclose($myfile); */

	if(!isset($_POST["shtml"]))
	{
	exit("Post values not set.");
	}
	$dom = new DOMDocument();
	$dom->loadHTML($shtml);

	$CEwbNo = $dom->getElementById('ctl00_ContentPlaceHolder1_lblTripSheetNoDetails')->nodeValue;;
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
		$td1 = $cols->item(1)->nodeValue;
		$arr = explode(" - ", $td1);
		$EwbNo = $arr[0];
		$EwbDate = DateTime::createFromFormat('d/m/Y', ltrim($arr[1]))->format('Y-m-d');

		$EwbBy = $cols->item(2)->nodeValue;
		$td3 = $cols->item(3)->nodeValue;
		$arr1 = explode(" - ", $td3);
		$DocNo = $arr1[0];
		$DocDate = DateTime::createFromFormat('d/m/Y', ltrim($arr1[1]))->format('Y-m-d');
		$Value = $cols->item(4)->nodeValue;
		$ToPlace = $cols->item(5)->nodeValue;
		$Validtill = $cols->item(6)->nodeValue;
		$Validtill = DateTime::createFromFormat('d/m/Y',$Validtill)->format('Y-m-d');

		//$Status = $cols->item(4)->nodeValue;

		$sql .= "INSERT IGNORE INTO Ewb(EwbNo, CEwbNo, EwbDate, EwbBy, DocNo, DocDate, Value, ToPlace, Validtill )
					 VALUES ('$EwbNo', '$CEwbNo', '$EwbDate', '$EwbBy', '$DocNo','$DocDate', '$Value', '$ToPlace', '$Validtill');\n";
	}
	//echo $sql;
	if ($conn->multi_query($sql) === TRUE)
	{
		echo "Records Created successfully.";
	}
?>