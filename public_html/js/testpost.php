<?php

	$db_name = "u972264077_vtc";
	$mysql_username = "u972264077_pda";
	$mysql_password = "pda2008";
	$server_name = "mysql.hostinger.in";
	$conn = mysqli_connect($server_name, $mysql_username, $mysql_password, $db_name);
	
	$shtml = $_POST["shtml"];	// Source HTML
	//$myfile = fopen("newfile.txt", "w") or die("Unable to open file!");	
	//fwrite($myfile, $shtml);
	//fclose($myfile);	
	//echo "Successfully Created File.";
	
/* 	$myfile = fopen("newfile.txt", "r") or die("Unable to open file!");
	$html = fread($myfile,filesize("newfile.txt"));
	fclose($myfile); */

	
	$shtml = str_replace("\"=\"\"", "", $shtml);
	$shtml = str_replace("<nav", "<div", $shtml);
	$shtml = str_replace("</nav>", "</div>", $shtml);
	
	$dom = new DOMDocument();
	$dom->loadHTML($shtml);
	
	$tablerow = $dom->getElementById('ctl00_ContentPlaceHolder1_tr_data');
	$tables = $tablerow->getElementsByTagName('table');	
	$rows = $tables->item(0)->getElementsByTagName('tr');

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
		$EWBNO = $arr[0];
		//$EWBDate = $arr[1];
		$EWBDate = DateTime::createFromFormat('d/m/Y H:i:s', ltrim($arr[1]))->format('Y-m-d H:i:s');

		$mysql_qry = "select EWBNO from vtcpod where EWBNO = '$EWBNO'";
		$result = $conn->query($mysql_qry);
		//echo "No. of rows = ".$result->num_rows."<br><br>";
		if($result->num_rows > 0) // $result->num_rows  $result->fetch_assoc()
		{
			echo "EWBNO $EWBNO Already Exist.<br><br>";
			$result->close();
			continue;
		}
		
		$td2 = $cols->item(2)->nodeValue;
		$arr1 = explode("\n", $td2);
		$DocNo = $arr1[0];
		//$DocDate = $arr1[1];
		$DocDate = DateTime::createFromFormat('d/m/Y', ltrim($arr1[1]))->format('Y-m-d');
		//var_dump($arr1);

		$td3 = $cols->item(3)->c14n();
		$td3 = str_replace("<td>", "", $td3);
		$td3 = str_replace("</td>", "", $td3);
		$td3 = str_replace("<br></br>", "\n", $td3);
		$arr2 = explode("\n", $td3);
		$FromGSTN = substr($arr2[0],0,15);
		$FromName = substr($arr2[0],16);
		$FromAddLine1 = $arr2[1];
		$FromAddLine2 = $arr2[2];
		//var_dump($arr2);

		$td4 = $cols->item(4)->c14n();
		$td4 = str_replace("<td>", "", $td4);
		$td4 = str_replace("</td>", "", $td4);
		$td4 = str_replace("<br></br>", "\n", $td4);
		$arr3 = explode("\n", $td4);
		$ToGSTN = substr($arr3[0],0,15);
		$ToName = substr($arr3[0],16);
		$ToAddLine1 = $arr3[1];
		$ToAddLine2 = $arr3[2];
		//var_dump($arr3);

		$Status = $cols->item(5)->nodeValue;

		$ValidUntill = $cols->item(6)->nodeValue;
		$date = date_create_from_format('d/m/Y', trim($ValidUntill));		
		if ($date === FALSE)
			$ValidUntill="";
		else
			$ValidUntill = date_format($date, 'Y-m-d');
		
		$sql .= "INSERT INTO ewaybill(EWBNO, EWBDate, DocNo, DocDate, FromGSTN, FromName, FromAddLine1, FromAddLine2, ToGSTN, ToName, ToAddLine1, ToAddLine2, Status, ValidUntill)
					VALUES ('$EWBNO', '$EWBDate', '$DocNo', '$DocDate', '$FromGSTN', '$FromName', '$FromAddLine1', '$FromAddLine2', '$ToGSTN', '$ToName', '$ToAddLine1', '$ToAddLine2', '$Status', '$ValidUntill');";		
	}
	
	if ($conn->multi_query($sql) === TRUE)
	{
		echo "Records Created successfully.";
	}
?>