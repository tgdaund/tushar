<?php

session_start();

$msg = "";

if (!isset($_SESSION['login_user'])) {
    header("location:login.php");
}
if ($_SESSION['UserRole'] != 'Admin') {
    exit("You are not authorised to view this page.");
}


include 'connection.php';
if(isset($_GET['workId']))
{
    $workId=$_GET['workId'];

//$WorkID = $_GET["workId"];

$sql="SELECT `workId`, `name`,`address`,`Cgstno`,`po`, `podate`, `gstno`, `TotalAmt`, `AmtInWord` FROM `Workordershruti1` WHERE `workId`='$workId'";

$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);


$workid = $row['workId'];
$toname = $row['name'];
$address = $row['address'];
$Cgstno = $row['Cgstno'];
$po = $row['po'];
$podt = $row['podate'];
$gstno = $row['gstno'];
$totalAmt = $row['TotalAmt'];
$amtword = $row['AmtInWord'];
}
?>
<html xmlns:v="urn:schemas-microsoft-com:vml"
xmlns:o="urn:schemas-microsoft-com:office:office"
xmlns:x="urn:schemas-microsoft-com:office:excel"
xmlns="http://www.w3.org/TR/REC-html40">

<head>
<meta http-equiv=Content-Type content="text/html; charset=windows-1252">
<meta name=ProgId content=Excel.Sheet>
<meta name=Generator content="Microsoft Excel 12">
<link rel="stylesheet" href="documentpurchase.css">
 <meta charset="utf-8">
 <meta name="viewport" content="width=device-width, initial-scale=1">
 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
  <link href = "https://code.jquery.com/ui/1.10.4/themes/ui-lightness/jquery-ui.css" rel = "stylesheet">
  <script src = "https://code.jquery.com/jquery-1.10.2.js"></script>
  <script src = "https://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
  <script src='js/jquery-1.8.3.min.js'></script>
<script src="js/jquery-ui.js"></script>
<script src="script.js"></script>
<script src="menuscript.js"></script>
<link rel="stylesheet" href="menustyle.css">
<link rel="stylesheet" href="js/jquery-ui.css" />
<script src='js/jquery.elevatezoom.js'></script>
<link rel="stylesheet" href="styles.css">
<link rel="stylesheet" href="tablestyle.css">

<style>
 .popover__content {
            -webkit-box-sizing: unset;
            box-sizing: unset;
        }
        .popover__content, ::after, ::before {
            box-sizing: unset;
        }
        .modal-content {
            display: block;
        }
        .ui-widget-header {
            color: black;
        }
        div.ui-datepicker {
            font-size: 12px;
        }
    
    input[type=button]{
        background-color: #b0d3e8;
        height: 35px;
    }
    
    

</style>


</head>

<body>
    <?php include 'menubar.php';?>
<form id="form1" name="form1" method="GET">

<div id="Purchase Order (1)._8672" align=center x:publishsource="Excel">

<table border=0 cellpadding=0 cellspacing=0 width=882 class=xl658672
 style='border-collapse:collapse;table-layout:fixed;width:662pt'>
 <col class=xl658672 width=69 style='mso-width-source:userset;mso-width-alt:
 2523;width:52pt'>
 <col class=xl658672 width=298 style='mso-width-source:userset;mso-width-alt:
 10898;width:224pt'>
 <col class=xl888672 width=91 style='mso-width-source:userset;mso-width-alt:
 3328;width:68pt'>
 <col class=xl658672 width=52 style='mso-width-source:userset;mso-width-alt:
 1901;width:39pt'>
 <col class=xl658672 width=61 style='mso-width-source:userset;mso-width-alt:
 2230;width:46pt'>
 <col class=xl938672 width=144 style='mso-width-source:userset;mso-width-alt:
 5266;width:108pt'>
 <col class=xl938672 width=167 style='mso-width-source:userset;mso-width-alt:
 6107;width:125pt'>
 <tr height=37 style='height:27.75pt'>
  <td colspan=2 rowspan=4 height=113 width=367 style='border-bottom:1.0pt solid black;
  height:84.75pt;width:276pt' align=left valign=top>
      <![if !vml]><span style='mso-ignore:vglayout;
  position:absolute;z-index:1;margin-left:19px;margin-top:8px;width:252px;
  height:97px'><img width=252 height=97
  src="VTCLogo.png" v:shapes="Picture_x0020_1"></span><![endif]><span
  style='mso-ignore:vglayout2'>
  <table cellpadding=0 cellspacing=0>
   <tr>
    <td colspan=2 rowspan=4 height=113 class=xl1518672 width=367
    style='border-bottom:1.0pt solid black;height:84.75pt;width:276pt'>&nbsp;</td>
   </tr>
  </table>
  </span></td>
  <td colspan=5 class=xl1578672 width=515 style='border-right:1.0pt solid black;
  width:386pt'>VTC 3PL SERVICES PVT LTD<span style='mso-spacerun:yes'> </span></td>
 </tr>
 <tr height=20 style='height:15.0pt'>
  <td colspan=5 rowspan=3 height=76 class=xl1398672 width=515 style='border-right:
  1.0pt solid black;border-bottom:1.0pt solid black;height:57.0pt;width:386pt'>S.No.
  166, Vishal House, Gajanan Nagar Phursungi Pune 412308.</td>
 </tr>
 <tr height=35 style='mso-height-source:userset;height:26.25pt'>
 </tr>
 <tr height=21 style='height:15.75pt'>
 </tr>
 <tr height=20 style='height:15.0pt'>
  <td height=20 class=xl668672 style='height:15.0pt;border-top:none'>&nbsp;</td>
  <td class=xl678672 style='border-top:none'>&nbsp;</td>
  <td class=xl1058672 style='border-top:none'>&nbsp;</td>
  <td class=xl678672 style='border-top:none'>&nbsp;</td>
  <td class=xl678672 style='border-top:none'>&nbsp;</td>
  <td class=xl1068672 style='border-top:none'>&nbsp;</td>
  <td class=xl1078672 style='border-top:none'>&nbsp;</td>
 </tr>
 <tr height=35 style='height:26.25pt'>
  <td colspan=7 height=35 class=xl1488672 style='border-right:1.0pt solid black;
  height:26.25pt'>WORK ORDER<span style='mso-spacerun:yes'> </span></td>
 </tr>
 <tr height=21 style='height:15.75pt'>
  <td height=21 class=xl798672 style='height:15.75pt'>&nbsp;</td>
  <td class=xl658672></td>
  <td class=xl888672></td>
  <td class=xl658672></td>
  <td class=xl658672></td>
  <td class=xl938672></td>
  <td class=xl948672>&nbsp;</td>
 </tr>
 <tr height=21 style='height:15.75pt'>
  <td height=21 class=xl1178672 style='height:15.75pt'>&nbsp;</td>
  <td class=xl678672>&nbsp;</td>
  <td class=xl1188672>&nbsp;&nbsp;Work Order No.</td>
  <td class=xl678672>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo "$workid";?></td>
  <td class=xl678672>&nbsp;</td>
  <td class=xl1068672>&nbsp;</td>
  <td class=xl1078672>&nbsp;</td>
 </tr>
 <tr height=21 style='height:15.75pt'>
  <td height=21 class=xl688672 colspan=2 style='height:15.75pt'>&nbsp;To:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo "$toname";?></td>
  <td class=xl728672 colspan=4>&nbsp;PO:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo "$po";?></td>
  <td class=xl968672 width=167 style='width:125pt'>&nbsp;</td>
 </tr>
 <tr height=21 style='height:15.75pt'>
  <td height=21 class=xl688672 style='height:15.75pt'>&nbsp;Address:&nbsp;<?php echo "$address";?></td>
  <td class=xl708672 width=298 style='width:224pt'></td>
  <td class=xl728672 colspan=3>&nbsp;PO Date:&nbsp;&nbsp;<?php echo "$podt";?></td>
  <td class=xl938672></td>
  <td class=xl948672>&nbsp;</td>
 </tr>
 <tr height=21 style='height:15.75pt'>
  <td height=21 class=xl688672 style='height:15.75pt'>&nbsp;GSTNO:&nbsp;&nbsp;<?php echo "$Cgstno";?></td>
  <td class=xl718672></td>
  <td class=xl728672 colspan=4>&nbsp;GSTNO:&nbsp;&nbsp;&nbsp;&nbsp;<?php echo "$gstno";?></td>
  <td class=xl948672>&nbsp;</td>
 </tr>
 <tr height=21 style='height:15.75pt'>
  <td height=21 class=xl688672 style='height:15.75pt'>&nbsp;</td>
  <td class=xl718672></td>
  <td class=xl728672>&nbsp;</td>
  <td class=xl738672></td>
  <td class=xl718672></td>
  <td class=xl938672></td>
  <td class=xl948672>&nbsp;</td>
 </tr>
 <tr height=21 style='height:15.75pt'>
  <td height=21 class=xl748672 style='height:15.75pt'>&nbsp;</td>
  <td class=xl758672>&nbsp;</td>
  <td class=xl1198672>&nbsp;</td>
  <td class=xl758672>&nbsp;</td>
  <td class=xl758672>&nbsp;</td>
  <td class=xl978672>&nbsp;</td>
  <td class=xl988672>&nbsp;</td>
 </tr>
 <tr class=xl1348672 height=42 style='mso-height-source:userset;height:32.1pt'>
  <td height=42 class=xl1308672 width=69 style='height:32.1pt;border-top:none;
  width:52pt'>S.No</td>
  <td class=xl1318672 width=298 style='border-top:none;border-left:none;
  width:224pt'>Particulars</td>
  <td class=xl1318672 width=91 style='border-top:none;border-left:none;
  width:68pt'>Remark</td>
  <td class=xl1318672 width=52 style='border-top:none;border-left:none;
  width:39pt'>Qty<span style='mso-spacerun:yes'> </span></td>
  <td class=xl1318672 width=61 style='border-top:none;border-left:none;
  width:46pt'>Unit</td>
  <td class=xl1328672 width=144 style='border-top:none;border-left:none;
  width:108pt'><span style='mso-spacerun:yes'> </span>Rate<span
  style='mso-spacerun:yes'> </span></td>
  <td class=xl1338672 width=167 style='border-top:none;border-left:none;
  width:125pt'><span style='mso-spacerun:yes'> </span>Amount (Rs)<span
  style='mso-spacerun:yes'> </span></td>
 </tr>
 <?php
$sql="SELECT `workId`, `SNo`, `Particular`, `Remark`, `Qty`, `Unit`, `Rate`, `Amount` FROM `Workordershruti` WHERE `workId`='$workid'";

$result1= mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0)
{
while($row1 = mysqli_fetch_assoc($result1)){

$workid1= $row1['workId'];
$sno = $row1['SNo'];
$particular = $row1['Particular'];
$remark = $row1['Remark'];
$qty = $row1['Qty'];
$unit = $row1['Unit'];
$rate = $row1['Rate'];
$amount = $row1['Amount'];

echo"
 <tr class=xl1088672 height=46 style='mso-height-source:userset;height:35.1pt'>
  <td height=46 class=xl1258672 style='height:35.1pt;border-top:none'>&nbsp;$sno</td>
  <td class=xl1268672 width=298 style='border-top:none;border-left:none;
  width:224pt'>&nbsp;$particular</td>
  <td class=xl1278672 style='border-top:none;border-left:none'>&nbsp;$remark</td>
  <td class=xl1278672 style='border-top:none;border-left:none'>&nbsp;$qty</td>
  <td class=xl1278672 style='border-top:none;border-left:none'>&nbsp;$unit</td>
  <td class=xl1288672 style='border-top:none;border-left:none'>&nbsp;$rate</td>
  <td class=xl1298672 style='border-top:none;border-left:none'>&nbsp;$amount</td>
 </tr>";
}
}

 ?>
 <tr class=xl1088672 height=84 style='mso-height-source:userset;height:63.0pt'>
  <td colspan=5 height=84 class=xl1608672 width=571 style='border-right:.5pt solid black;
  height:63.0pt;width:429pt'>&nbsp;&nbsp;Amount in words Rs.:&nbsp;<?php echo "$amtword";?><span
  style='mso-spacerun:yes'>  </span></td>
  <td class=xl1158672 style='border-top:none;border-left:none'><span
  style='mso-spacerun:yes'> </span>Total<span
  style='mso-spacerun:yes'>  </span></td>
  <td class=xl1168672 style='border-top:none;border-left:none'><span
  style='mso-spacerun:yes'>                    </span><?php echo "$totalAmt";?>  </td>
 </tr>
 <tr height=24 style='height:18.0pt'>
  <td height=24 class=xl668672 style='height:18.0pt;border-top:none'>&nbsp;</td>
  <td class=xl1098672 style='border-top:none'>&nbsp;</td>
  <td class=xl1058672 style='border-top:none'>&nbsp;</td>
  <td class=xl1098672 style='border-top:none'>&nbsp;</td>
  <td class=xl1098672 style='border-top:none'>&nbsp;</td>
  <td class=xl1118672>&nbsp;</td>
  <td class=xl1108672>&nbsp;</td>
 </tr>
 <tr height=24 style='mso-height-source:userset;height:18.0pt'>
  <td height=24 class=xl1048672 colspan=2 style='height:18.0pt'>&nbsp;Terms &amp;
  Conditions<span style='mso-spacerun:yes'> </span></td>
  <td class=xl888672></td>
  <td class=xl808672></td>
  <td class=xl808672></td>
  <td colspan=2 class=xl1358672 style='border-right:1.0pt solid black'><span
  style='mso-spacerun:yes'> </span>For VTC 3PL Services Pvt Ltd<span
  style='mso-spacerun:yes'>  </span></td>
 </tr>
<?php
$sql="SELECT `workId`, `terms` FROM `workorderterms` WHERE `workId`='$workid'";

$result2= mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0)
{
while($row2 = mysqli_fetch_assoc($result2)){

$workid2= $row2['workId'];
$terms = $row2['terms'];

echo"
 <tr height=24 style='height:18.0pt'>
  <td height=24 class=xl798672 colspan=2 style='height:18.0pt'>&nbsp;$terms</td>
  <td class=xl908672></td>
  <td class=xl818672></td>
  <td class=xl818672></td>
  <td class=xl1128672>&nbsp;</td>
  <td class=xl1018672>&nbsp;</td>
 </tr>";
}
}

?>
 <tr height=24 style='height:18.0pt'>
  <td height=24 class=xl798672 colspan=2 style='height:18.0pt'>&nbsp;Taxes -<span style='mso-spacerun:yes'> 
  </span>&nbsp;Extra As Applicable<span style='mso-spacerun:yes'> </span></td>
  <td class=xl908672></td>
  <td class=xl818672></td>
  <td class=xl818672></td>
  <td class=xl1128672>&nbsp;</td>
  <td class=xl1018672>&nbsp;</td>
 </tr>
 <tr height=21 style='height:15.75pt'>
  <td height=21 class=xl828672 colspan=2 style='height:15.75pt'>&nbsp;Payment Terms -<span
  style='mso-spacerun:yes'>  </span>&nbsp;15 Days</td>
  <td class=xl918672></td>
  <td class=xl838672></td>
  <td class=xl838672></td>
  <td class=xl798672>&nbsp;</td>
  <td class=xl1028672>&nbsp;</td>
 </tr>
 <tr height=21 style='height:15.75pt'>
  <td height=21 class=xl828672 colspan=2 style='height:15.75pt'>&nbsp;Follow the
  annexure A</td>
  <td class=xl918672></td>
  <td class=xl838672></td>
  <td class=xl838672></td>
  <td class=xl798672>&nbsp;</td>
  <td class=xl1028672>&nbsp;</td>
 </tr>
 <tr height=21 style='height:15.75pt'>
  <td colspan=5 rowspan=2 height=42 class=xl1638672 width=571 style='border-right:
  1.0pt solid black;height:31.5pt;width:429pt'>&nbsp;Signing of Contract Employee
  Agreement and take Vendor Code is  Mandatory before 1st Billing Cycle.</td>
  <td class=xl1138672 style='border-left:none'>&nbsp;</td>
  <td class=xl1028672>&nbsp;</td>
 </tr>
 <tr height=21 style='height:15.75pt'>
  <td colspan=2 height=21 class=xl1378672 style='border-right:1.0pt solid black;
  height:15.75pt;border-left:none'><span
  style='mso-spacerun:yes'> </span>Authorized Signature.<span
  style='mso-spacerun:yes'> </span></td>
 </tr>
 <tr height=22 style='height:16.5pt'>
  <td height=22 class=xl858672 style='height:16.5pt'>&nbsp;</td>
  <td class=xl868672>&nbsp;</td>
  <td class=xl928672>&nbsp;</td>
  <td class=xl868672>&nbsp;</td>
  <td class=xl868672>&nbsp;</td>
  <td class=xl1148672>&nbsp;</td>
  <td class=xl1038672>&nbsp;</td>
 </tr>
 <![if supportMisalignedColumns]>
 <tr height=0 style='display:none'>
  <td width=69 style='width:52pt'></td>
  <td width=298 style='width:224pt'></td>
  <td width=91 style='width:68pt'></td>
  <td width=52 style='width:39pt'></td>
  <td width=61 style='width:46pt'></td>
  <td width=144 style='width:108pt'></td>
  <td width=167 style='width:125pt'></td>
 </tr>
 <![endif]>
</table>

</div>
</div>
<div class="form-group"><br><br>
                    <div class="row">
                        <div class="col-sm" style="text-align: center;">
                            <input type="button" value="Print"  id="btPrint" onclick="createPDF()" />
                            
                        </div>
                    </div>
                </div>


</form>

</body>

<script>
    function createPDF() {
        var sTable = document.getElementById('Purchase Order (1)._8672').innerHTML;
    
        // CREATE A WINDOW OBJECT.
        var win = window.open('', '', 'height=700,width=700');

        win.document.write('<html><head>');
        win.document.write('<title>Work Order PDF</title>');   // <title> FOR PDF HEADER.
        win.document.write('<link rel="stylesheet" type="text/css"  href="documentpurchase.css"/>');
        win.document.write('</head>');
        win.document.write('<body>');
        win.document.write(sTable);         // THE TABLE CONTENTS INSIDE THE BODY TAG.
        win.document.write('</body></html>');
        win.document.close();
        win.print();
        
    }

</script>
</html>