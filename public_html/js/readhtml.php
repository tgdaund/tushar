<?php

/* 	$db_name = "u972264077_vtc";
	$mysql_username = "u972264077_pda";
	$mysql_password = "pda2008";
	$server_name = "mysql.hostinger.in";
	$conn = mysqli_connect($server_name, $mysql_username, $mysql_password, $db_name); */

	$myfile = fopen("newfile.txt", "r") or die("Unable to open file!");
	$html = fread($myfile,filesize("newfile.txt"));
	fclose($myfile);

	//echo $html;
	//repair bad HTML
	/*     $tidy = tidy_parse_string($html);
    $tidy->cleanRepair();
    $html = (string)$tidy; */

	$html = str_replace("\"=\"\"", "", $html);
	$html = str_replace("<nav", "<div", $html);
	$html = str_replace("</nav>", "</div>", $html);

	// load into dom
	$dom = new DOMDocument();
	$dom->loadHTML($html);

	 //make xpath-able
    //$xpath = new DOMXPath($dom);

	//$element = $xpath->query("//*[@id='ctl00_ContentPlaceHolder1_tr_data']")->item(0);
	//$element = $xpath->query("/html/body/form/table/div[@id='ctl00_ContentPlaceHolder1_tr_data']");
	$tablerow = $dom->getElementById('ctl00_ContentPlaceHolder1_tr_data');
	$tables = $tablerow->getElementsByTagName('table');
	//$Header = $tables->item(0)->getElementsByTagName('th');

	$rows = $tables->item(0)->getElementsByTagName('tr');

	#Get header name of the table
	/* foreach($Header as $NodeHeader)
	{
		$aDataTableHeaderHTML[] = trim($NodeHeader->textContent);
	}
	print_r($aDataTableHeaderHTML); die();

	foreach ($rows as $row)
	{
	   // get each column by tag name
		$cols = $row->getElementsByTagName('td');
		$row = array();

		foreach ($cols as $node) {
			# code...
			//print $node->nodeValue."\n";
				$row[] = $node->nodeValue;
		}
		$table[] = $row;
	} */
	$sql="";
	$str="<table border=1><tr><th>EWBNO</th><th>EWBDate</th><th>DocNo</th><th>DocDate</th><th>FromGSTN</th><th>FromName</th><th>FromAddLine1</th>
				<th>FromAddLine2</th><th>ToGSTN</th><th>ToName</th><th>ToAddLine1</th><th>ToAddLine2</th><th>Status</th><th>ValidUntill</th></tr>";
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

		$td2 = $cols->item(2)->nodeValue;
		$arr1 = explode("\n", $td2);
		$DocNo = $arr1[0];
		//$DocDate = $arr1[1];
		$DocDate = DateTime::createFromFormat('d/m/Y', trim($arr1[1]))->format('Y-m-d');
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
		$ValidUntill = date_format($date, 'Y-m-d');
		
		$str .= "<tr><td>$EWBNO</td><td>$EWBDate</td><td>$DocNo</td><td>$DocDate</td><td>$FromGSTN</td><td>$FromName</td><td>$FromAddLine1</td>".
				"<td>$FromAddLine2</td><td>$ToGSTN</td><td>$ToName</td><td>$ToAddLine1</td><td>$ToAddLine2</td><td>$Status</td><td>$ValidUntill</td></tr>\n";
				
		/* $sql .= "INSERT INTO ewaybill(EWBNO, EWBDate, DocNo, DocDate, FromGSTN, FromName, FromAddLine1, FromAddLine2, ToGSTN, ToName, ToAddLine1, ToAddLine2, Status, ValidUntill)
					VALUES ('$EWBNO', '$EWBDate', '$DocNo', '$DocDate', '$FromGSTN', '$FromName', '$FromAddLine1', '$FromAddLine2', '$ToGSTN', '$ToName', '$ToAddLine1', '$ToAddLine2', '$Status', '$ValidUntill')";

		if ($conn->multi_query($sql) === TRUE)
		{
			echo "Records Created successfully.";
		}*/
	}
	$str .= "</table>";
	echo $str;
	//var_dump($table);
?>