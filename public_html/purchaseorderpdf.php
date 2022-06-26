<?php
include'connection.php';
session_start();

$msg = "";

if (!isset($_SESSION['login_user'])) {
    header("location:login.php");
}
/*if(!in_array('purchaseordertushar',$_SESSION['PageAccess']))
{
    exit("You are not authorised to view this page.");
}*/
$User = $_SESSION['login_user'];

if ($_SESSION['UserRole'] != 'Admin') {
    exit("You are not authorised to view this page.");
}
 date_default_timezone_set('Asia/Kolkata');
    $date = new DateTime(); 
    $datestr2 = $date->format('d/m/Y');
    $date->sub(new DateInterval('P1D'));
    $datestr1 = $date->format('d/m/Y');
    if (isset($_GET["date1"])) { $d1 = $_GET["date1"]; } else { $d1=$datestr1; };
    if (isset($_GET["date2"])) { $d2 = $_GET["date2"]; } else { $d2=$datestr2; };
?>




<!DOCTYPE html>
<html>
<head>
    <script src='js/jquery-1.8.3.min.js'></script>
<script src="js/jquery-ui.js"></script>
<script src="script.js"></script>
<script src="menuscript.js"></script>
<link rel="stylesheet" href="menustyle.css">
<link rel="stylesheet" href="js/jquery-ui.css" />
<script src='js/jquery.elevatezoom.js'></script>
<link rel="stylesheet" href="styles.css">
<link rel="stylesheet" href="tablestyle.css">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta charset="utf-8">
	<title>PURCHASE ORDER</title>

	<style type="text/css">
	
	#space {
        border: 0px;
}
    #kk,table, td, th {
  border: 1px solid black;
}

#kk,table {
    border: 2px solid black ;
  border-collapse: collapse;

  width: 70%;
}

th {
 
}
#kk, table.center {
  margin-left: auto; 
  margin-right: auto;}

</style>


</head>
<body onload="javascript:myApp.printTable()">
	<form method="post" action="">
	<?php //include 'menubar.php';?>

	<?php
       $PONUM = $_GET['PONUM'];




	$sql="SELECT `id`, `porderId`, DATE_FORMAT(`date1`,'%d/%m/%Y') as date1, `custid`,`company_name`, `invoicenum`, `paymentmode`, `paymentschedule`, `GSTNO`,`required_for`, `buyer`, `purchaseitem`, `vendorname`, `shipname`, `vendorcompanyname`, `shipcompanyname`, `vendorgst`, `shipgst`, `vendoraaddres`, `shipaddress`, `vendorcontactperson`, `shipcontactperson`, `vendorcontact`, `shipcontact`, `vendoremail`, `shipemail`, `total`, `payment_term`, `distribution_schedule`, `warranty`,  left(`Quotation`, 40) as Quotation,AmountToWords(`total`) AS amount_to_words FROM `purchaseorder2021` WHERE `porderId`='$PONUM'";
	//echo"$sql";
	 $result=mysqli_query($conn,$sql);
	 if(mysqli_num_rows($result)>0){
	 	while($row=mysqli_fetch_assoc($result)){
	 		$porderId=$row['porderId'];
	 		$date=$row['date1'];
	 		$custid=$row['custid'];
            $company_name=$row['company_name'];
	 		$invoicenum=$row['invoicenum'];
	 		$paymentmode=$row['paymentmode'];
	 		$paymentschedule=$row['paymentschedule'];
	 		$GSTNO=$row['GSTNO'];
            $required_for=$row['required_for'];
	 		$buyer=$row['buyer'];
	 		$purchaseitem=$row['purchaseitem'];
	 		$vendorname=$row['vendorname'];
	 		$shipname=$row['shipname'];
	 		$vendorcompanyname=$row['vendorcompanyname'];
	 		$shipcompanyname=$row['shipcompanyname'];
	 		$vendorgst=$row['vendorgst'];
	 		$shipgst=$row['shipgst'];
	 		$vendoraaddres=$row['vendoraaddres'];
	 		$shipaddress=$row['shipaddress'];
	 		$vendorcontactperson=$row['vendorcontactperson'];
	 		$shipcontactperson=$row['shipcontactperson'];
	 		$vendorcontact=$row['vendorcontact'];
	 		$shipcontact=$row['shipcontact'];
	 		$vendoremail=$row['vendoremail'];
	 		$shipemail=$row['shipemail'];
	 		$total=$row['total'];
	 		$payment_term=$row['payment_term'];
	 		$distribution_schedule=$row['distribution_schedule'];
	 		$warranty=$row['warranty'];
	 		$Quotation=$row['Quotation'];
            $amount_to_words=$row['amount_to_words'];
	 		







	 	}
	 }


	?>
		

       <div id='tab'>
		 <table class='center'>

				<!-- <tr>
            <th colspan='5'style= "background-color:#ddd; text-align:center; height: 30px;">VTC 3 PL SERVICES PVT.LTD</th>
        </tr> -->
         
         <tr>
            <th colspan='5' style= "background-color:#ddd;text-align:center;height: 30px;"> PURCHASE ORDER</th>

         </tr>
				<tr>
         	<td rowspan ='6' style= "background-color:white;width:55%;text-align:left;font-family:verdana"> 

<?php  
if ($company_name=='VTC 3 PL SERVICES PVT.LTD'){

echo"
<h5>
<b> $company_name<br>
H.O.: Vishal House, Sr.No.166, Gajanan Nagar,<BR>
A/P:Fursungi, Tal: Haveli, Dist: Pune-412308.<BR>
CIN No: U60200PN2012PTC142997 <BR>
GST Code: 996511 PAN: AAECV0781E  </h5>";

}

elseif ($company_name=='NORTHEN STAR PVT LTD'){

echo"
<h5>
<b> $company_name<br>
H.O.: Vishal House, Sr.No.166, Gajanan Nagar,<BR>
A/P:Fursungi, Tal: Haveli, Dist: Pune-412308.<BR>
CIN No:  <BR>
GST Code: 27BEIPA7237J2ZD PAN:BEIPA7237J   </h5>";

}
elseif ($company_name=='VISHAL SCM PVT.LTD'){

echo"
<h5>
<b> $company_name<br>
H.O.: Vishal House, Sr.No.166, Gajanan Nagar,<BR>
A/P:Fursungi, Tal: Haveli, Dist: Pune-412308.<BR>
CIN No: U60230PN2012PTC142891 <BR>
GST Code: 27AAECU0068j126 PAN: AAECV0068J  </h5>";

}

else {
    exit("Company Name Not Found Please Check .");

     echo"  <script>
         
             
        window.location.replace('purchaseordernew.php');</script>";
}








                 
            ?>
             </b>
         	</td>
            
             <td ><b> DATE:</b></td>
             <td> <?php echo"$date"; ?></td>

             <tr>
            <td> <b>PO NO:</b> </td>
            <td><?php echo"$porderId"; ?></td>
            </tr>

            <tr>
               <td><b> CUSTOMER ID:</b> </td>
               <td><?php echo"$custid"; ?></td>
             </tr>

              <tr>
               <td> <!-- INVOICE NO --> </td>
               <td> &nbsp;&nbsp;<?PHP  // echo"$invoicenum"; ?></td>
             </tr>
             
             <tr>
                <td colspan='4'> <b>  MODE OF PAYMENT:</b> &nbsp;&nbsp;
                    
                <?php echo"$paymentmode"; ?> </td>

             </tr>
             
             <tr>
                <td  colspan='4' style="height: 20px;">  <b>PAYMENT SCHEDULE:</b>&nbsp;

                    <?php echo"$paymentschedule"; ?>
                  </td>
             </tr>

            

             <tr>
    <td style= "width:55%;"><!--GST NO:-->

    <?php //echo"$GSTNO"; ?></td>

    <td colspan='3'> <b>PURCHASE ITEM REQUIRED FOR: </b> <?php echo"$required_for"; ?></td>
    </tr>
    <tr>
        <td  style= "width:55%; height: 45px"><b>BUYER:</b> <?php echo"$buyer"; ?>  </td>

        <td colspan="4"> <b>PURCHASED ITEM:</b> <?php echo"$purchaseitem"; ?>   </td>
    </tr>

    <!--<tr>
        <td colspan="5" style="text-align:center;background-color:#ddd;"><b> PAYMENT STATUS</td></b>
    </tr>-->

    <tr>
        <td style= "width:55%;background-color:#ddd;"> <h4>VENDOR</h4> </td>
        <td colspan='4'style=  "background-color:#ddd;"> <h4>SHIP TO </h4></td>
    </tr>
    <tr>


    <td style= "width:10%;"><b>PERSON NAME:</b> <?php echo"$vendorname"; ?>  </td>
        <td colspan='4'style= ""><b>PERSON NAME:</b><?php echo"$shipname"; ?></td>
    </tr>

    <tr>
    <td style= "width:55%;"><b> COMPANY NAME:</b> &nbsp;<?php echo"$vendorcompanyname "; ?> </td>
       <td colspan='4'style= ""><b> COMPANY NAME:</b> <?php echo"$shipcompanyname"; ?></td>
    </tr>

    <!--<tr>
    <td style= "width:55%;"> GST NO: <?php //echo"$vendorgst"; ?> </td>
        <td colspan='4'style= ""> GST NO: <?php //echo"$shipgst "; ?> </td>
    </tr>-->

    <tr>
    <td style= "width:55%;"><b> ADDRES:</b> &nbsp; </td>
        <td colspan='4'style= ""> ADDRES: &nbsp;</td>
    </tr>

    <tr>
    <td style= "width:55%; height: 50px"> <?php echo"$vendoraaddres"; ?></td>

        <td colspan='4'style= "height: 50px"> <?php echo"$shipaddress"; ?></td>
    </tr>

    <tr>
    <td style= "width:55%;"><b>CONTACT PERSON:</b> <?php echo"$vendorcontactperson"; ?> </td>

        <td colspan='4'style= ""><b>CONTACT PERSON:</b><?php echo"$shipcontactperson"; ?> </td>
    </tr>

    <tr>
    <td style= "width:55%;"><b>CONTACT NUMBER:</b> <?php echo"$vendorcontact"; ?>  </td>

        <td colspan='4'style= ""><b>CONTACT NUMBER:</b> <?php echo"$shipcontact"; ?> </td>
    </tr>

    <tr>
    <td style= "width:55%;"><b>EMAIL:</b> <?php echo"$vendoremail"; ?> </td>

        <td colspan='4'style= ""><b>EMAIL: </b><?php echo"$shipemail"; ?> </td>
    </tr>

    <tr>
        <td colspan="5" style="text-align:center;background-color:#ddd; height: 20px"></td>
    </tr>
</table>
<table style=" background-color:#ddd;   " class="center" > 
    <b> <tr style="" id="addrow">
        <th  style="height: 25px; width:2%; ">SR.NO</th>
        <th style=" width:20%;">ITEM</th>
        <th style=" width:20%;">DISCRIPTION</th>
        <th style=" width:10%;">QUANTITY</th>
        <th style=" width:10%;">UNIT</th>
        <th>RATE</th>
        <th>TOTAL</th></b>
</tr> 

<?php
$sqlitem="SELECT `porderId`, `Item`,`discription`,`unit`, `Qty`, `Rate`, `Total` FROM `purchaseorderitems` WHERE `porderId`='$porderId'";
//echo"$sqlitem";

$resultitem=mysqli_query($conn,$sqlitem);

$ii=1;

while($rowsitem=mysqli_fetch_assoc($resultitem)){

   $Item=$rowsitem['Item'];
   $discription=$rowsitem['discription'];
   $unit=$rowsitem['unit'];
   $Qty=$rowsitem['Qty'];
   $Rate= $rowsitem['Rate'];
   $Total= $rowsitem['Total'];

   echo" <tr class='addRowFirst' id='row1' class=m111 height= style='mso-height-source:userset;'>
        <td style='height: 5px;' >$ii</td>
        <td >$Item</td>
        <td>$discription</td>
        <td>$unit</td>
        <td >$Qty</td>
        <td >$Rate</td>
        <td >$Total</td>
    </tr>";
    $ii++;



}


?>


    <tr>
        <td colspan="4" style="height:30px">
        <b>AMOUNT IN WORDS:</b>
        <?php echo" $amount_to_words";?></td>

        <td colspan="2"><b>TOTAL</b> </td>
        <td>
            <?php echo"$total";?> </td>

     </tr>

     <tr>
        <td colspan="4"><b>Terms & Conditions :</b>   </td>
        <td colspan="3"style="text-align:center;"><b>For VTC 3PL Services Pvt.Ltd </b></td>
     </tr>
     <?php
    $sqlterms="SELECT `porderId`, `terms` FROM `purchaseterms` WHERE  `porderId`='$porderId'";

    $resultterms=mysqli_query($conn,$sqlterms);
    $termscount= mysqli_num_rows($resultterms);
    //echo"tushar  $termscount";

$it=1;
 $termscount= $termscount+4;


?>
<tr>
    <td id="space" colspan=4></td>
    <td id="space" rowspan ="<?php echo"$termscount"; ?>" colspan='4'></td>
    </tr>


<?php




while($rowsterms=mysqli_fetch_assoc($resultterms)){
       
     
       $terms=$rowsterms['terms'];
       
        //echo"$terms";
      echo" <tr id='srow2' class='addRowSecond'>
        <td colspan='4' style='text-align:left'> <b>$it</b>.$terms
            
        </td>
        
       </tr>";
       $it++;

   }
   

     ?>
     
    <tr>
        <td colspan="4" style='text-align:left'>
        Payment Terms:<?php echo"$payment_term"; ?>
       </td>
       
     </tr>

     <tr>
        <td colspan="4" style='text-align:left'>
        Distribution Schedule:
        <?php echo"$distribution_schedule"; ?>
       </td>
       
</tr>

<tr>
        <td colspan="4" style='text-align:left'>
        Warranty:<?php echo"$warranty"; ?>
       </td>
     
       

</tr>
<tr>

    <td colspan="4" style='text-align:left'> Quatation Upload:<?php echo"$Quotation"; ?></td>
    <td  colspan="3"style="text-align: center;">
        Authorized Signatory
       </td>
</tr>





	
   
             

          </table>
		</div>

	</form>
	<p>
        <!--<input type="button" value="Create PDF" 
            id="btPrint" onclick="createPDF()" />-->
            
            <input type="button" value="Print" onclick="myApp.printTable()" />
    </p>


	

</body>
<script type="text/javascript">
	
	
   




/* function createPDF() {
        



         var sTable = document.getElementById('tab').innerHTML;

         var style = "<style>";
         style = style + "table {width: 100%;font: 17px Calibri;}";
         style = style + "table, th, td {border: solid 1px black; border-collapse: collapse;";
         style = style + "th{background-color:#ddd;}";         style = style + "#space{ border: 0px;}";
         style = style + "padding: 2px 3px;text-align:;}";
         style = style + "</style>";

          CREATE A WINDOW OBJECT.
        var win = window.open('', '', 'height=700,width=700');

         win.document.write('<html><head>');
         //win.document.write('<title>Profile</title>');   // <title> FOR PDF HEADER.
        win.document.write(style);          // ADD STYLE INSIDE THE HEAD TAG.
         win.document.write('</head>');
         win.document.write('<body>');
         win.document.write(sTable);         // THE TABLE CONTENTS INSIDE THE BODY TAG.
         win.document.write('</body></html>');

         win.document.close();   // CLOSE THE CURRENT WINDOW.

         win.print();    // PRINT THE CONTENTS.
     }*/
    var myApp = new function () {
        this.printTable = function () {
            var tab = document.getElementById('tab');

            var style = "<style>";
                style = style + "table {width: 100%;font: 17px Calibri;}";
                style = style + "table, th, td {border: solid 1px black; border-collapse: collapse;";
                style = style + "padding: 2px 3px;text-align: left;}";
                style = style + "</style>";

            var win = window.open('', '', 'height=700,width=700');
            win.document.write(style);          //  add the style.
            win.document.write(tab.outerHTML);
            win.document.close();
            win.print();
        }
    }
    
</script>

</html>	
