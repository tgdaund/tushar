<?php
require_once 'connection.php';
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
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta charset="utf-8">
    <title>Edit Booking</title>
    <link rel="stylesheet" type="text/css" href="style/formborder.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<!-- Script -->
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>

<!-- jQuery UI -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.css" />
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>

<!-- Bootstrap Css -->
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">

	
	<title>PURCHASE ORDER</title>
	<style type="text/css">
	/*popover__content {
        -webkit-box-sizing:unset;
        box-sizing: unset;
    }
    .popover__content, ::after, ::before {
        box-sizing: unset;
    }
    .modal-content {
        display: block;
    }
    .bs-example{
        margin: 20px;
    }
    .error{
        color: #FF0000;
    }
    .col-sm-1{
        width: 10%;
    }
    .form-group{
        margin-right: 20px;
    }
*/



.danger {
  background-color: #ffdddd;
  border-left: 5px solid #f44336;
}

.success {
  background-color: #ddffdd;
  border-left: 5px solid #04AA6D;
}

.info {
  background-color: #e7f3fe;
  border-left: 5px solid #2196F3;
}


.warning {
  background-color: #ffffcc;
  border-left: 5px solid #ffeb3b;
}

	</style>
    <script type="text/javascript">
        
        
        if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href);
            //window.location.replace('purchaseordernew.php');

        }


        window.onbeforeunload = function() {
            return "you can not refresh the page";
            window.location.replace('purchaseordernew.php');

        }
    </script>
  
</head>
<body>
    
	<?php include'menubar.php'; ?>
  

<?php
include('connection.php');
if(isset($_POST['submit']))
{

     $sql1="SELECT MAX(CAST(SUBSTRING(porderId,3,6) AS UNSIGNED)) as ss FROM purchaseorder2021";
     $query2=mysqli_query($conn,$sql1);
     $rows=mysqli_fetch_assoc($query2);
              $temp="";
               $mid=$rows['ss'];
               //echo"$mid 5151";
               if($mid==""){
                 $temp=1;
                }
                 else{
                   $temp=$mid+1;
                      }
    
                    $ponum="PO".str_pad($temp, 6,0,STR_PAD_LEFT);


   


    $date=$_POST['d1'];
    //$ponum=$_POST['ponum'];
    $custid=$_POST['custid'];
    //$invoicenum=$_POST['invoiceno'];
    $paymentmode=$_POST['paymentmode'];
    $paymentschedule=$_POST['pschedule'];
   // $cnameadd=$_POST['//'];//company name and address
    $company_name=$_POST['company_name'];
    
    //echo"<script>alert($company_name)</script>";
   // $GST=$_POST['gst'];
    $requiredfor=$_POST['requiredfor'];
     $buyer=$_POST['buyer'];
      $purchaseitem=$_POST['purchaseitem'];
    $vname=$_POST['vname'];// vendor name
    $shipname=$_POST['shipname'];
    $cname=$_POST['cname'];
    $shipcompany=$_POST['shipcompany'];
   // $vgstno=$_POST['cgstno'];
   // $sgstno=$_POST['sgstno'];
    $vadd=$_POST['cadress'];
    $sadd=$_POST['sadress'];
    $ccontact=$_POST['ccontact'];
    $scontact=$_POST['scontact'];
    $ccontactnum=$_POST['ccontactnum'];
    $scontactnum=$_POST['scontactnum'];
    $cemail=$_POST['cemail'];
    $semail=$_POST['semail'];

   // $sno = isset($_POST['srno']) ? $_POST['srno'] : '';
    
    $item = isset($_POST['item']) ? $_POST['item'] : '';
    $discription = isset($_POST['discription']) ? $_POST['discription'] : '';
    $unit = isset($_POST['unit']) ? $_POST['unit'] : '';
    $quantity = isset($_POST['quantity']) ? $_POST['quantity'] : '';
    $rate = isset($_POST['rate']) ? $_POST['rate'] : '';
    $total1 = isset($_POST['total']) ? $_POST['total'] : '';
    
    /*echo"<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>";
      print_r($item);
      print_r($discription);
      print_r($unit);
      print_r($quantity);
      print_r($rate);
       print_r($total1);
     echo" srno=$sno<br>
    item=$item<br>
    discription=$discription<br>
    unit=$unit<br>
    quantity=$quantity<br>
    rate=$rate<br>
    total1=$total1<br>
    
    
    
    ";*/

    $total=$_POST['total1'];
    
   
    $terms = isset($_POST['terms']) ? $_POST['terms'] : '';
    $pterms=$_POST['pterms'];
    $dschedule=$_POST['dschedule'];

    $Warranty=$_POST['Warranty'];
    //$qt=$_POST['qt'];
 $qt1=1;
  // $quotationpath="";
     foreach ($_FILES['qt']['tmp_name'] as $key => $value) {
  
    if($_FILES["qt"]["size"] != 0 )
    {
        move_uploaded_file($_FILES['qt']['tmp_name'][$key], "purchaseorderquatation/{$ponum}($qt1).pdf");

       
        
        $quotationpath1[]="purchaseorderquatation/{$ponum}($qt1).pdf";
        
         $qt1++;
    }
    }
    //print_r($quotationpath1);
     $quotationpath=implode(', ', $quotationpath1);
    

    $sql="";
    /*$sql .="INSERT INTO `purchaseorder2021`( `porderId`, `date`, `custid`,  company_name,`paymentmode`, `paymentschedule`,`GSTNO`,`required_for`, `buyer`, `purchaseitem`, `vendorname`, `shipname`, `vendorcompanyname`, `shipcompanyname`, `vendorgst`, `shipgst`, `vendoraaddres`, `shipaddress`, `vendorcontactperson`, `shipcontactperson`, `vendorcontact`, `shipcontact`, `vendoremail`, `shipemail`,total, `payment_term`, `distribution_schedule`, `warranty`,Quotation) 

    VALUES ('$ponum',STR_TO_DATE('$date','%d/%m/%Y'),'$custid','$company_name','$paymentmode','$paymentschedule','$GST','$requiredfor','$buyer','$purchaseitem','$vname','$shipname','$cname','$shipname','$vgstno','$sgstno','$vadd','$sadd','$ccontact','$scontact','$ccontactnum','$scontactnum','$cemail','$semail',$total,'$pterms','$dschedule','$Warranty','$quotationpath');";*/
    
    
    $sql .="INSERT INTO `purchaseorder2021`( `porderId`, `date1`, `custid`,  company_name,`paymentmode`, `paymentschedule`,`required_for`, `buyer`, `purchaseitem`, `vendorname`, `shipname`, `vendorcompanyname`, `shipcompanyname`, `vendoraaddres`, `shipaddress`, `vendorcontactperson`, `shipcontactperson`, `vendorcontact`, `shipcontact`, `vendoremail`, `shipemail`,total, `payment_term`, `distribution_schedule`, `warranty`,Quotation) 

    VALUES ('$ponum',STR_TO_DATE('$date','%d/%m/%Y'),'$custid','$company_name','$paymentmode','$paymentschedule','$requiredfor','$buyer','$purchaseitem','$vname','$shipname','$cname','$shipname','$vadd','$sadd','$ccontact','$scontact','$ccontactnum','$scontactnum','$cemail','$semail',$total,'$pterms','$dschedule','$Warranty','$quotationpath');";

    for ($i = 0; $i < count($item); $i++)


     $sql .="INSERT INTO `purchaseorderitems`( `porderId`,`Item`, `Qty`,`discription`,`unit`, `Rate`, `Total`) VALUES ('$ponum','$item[$i]','$quantity[$i]','$discription[$i]','$unit[$i]','$rate[$i]','$total1[$i]');";

        for ($j = 0; $j < count($terms); $j++)
        $sql .= "INSERT INTO `purchaseterms`( `porderId`, `terms`) VALUES ('$ponum','$terms[$j]');";
        
       
       
       ECHO"
       
       
       
       <br>
       <br>
       ";
    
         
          $query1=mysqli_multi_query($conn,$sql);
   
           //$query2=mysqli_query($conn,$sql2);
    
            /* $rows=mysqli_fetch_assoc($query2);
              $temp="";
               $mid=$rows['ss'];
               //echo"$mid 5151";
               if($mid==""){
                 $temp=1;
                }
                 else{
                   $temp=$mid+1;
                      }
    
                    $ponum="PO".str_pad($temp, 6,0,STR_PAD_LEFT);

    */


        

        //echo "$query1";
        //echo "$sql";

if($query1== true)
    {
        mysqli_close($conn);
        echo"<div id='dialog' title='Basic dialog'>
  <p>PO successfully generated</p>
</div>";
        
         

         echo"<div class='success'>
            <p><strong>Success!<br>


  </strong>PO ID -'$ponum' </p>
  <p><a href='purchaseordernew.php'>CLICK TO CREATE OTHER PO</a></p><br><br><br><br>



         <script>window.open('purchaseorderpdf.php?PONUM=$ponum','_blank','width=1200,height=600');</script>
  <p><input type='button' value= 'PRINT'  onclick=\"window.open('purchaseorderpdf.php?PONUM=$ponum','_blank','width=1200,height=600');\" />

   </p>
   
  
</div>";

/*echo"<script>window.location.replace('purchaseordernew.php'); </script>";*/
       

           
    }
    else
    {
        

         echo"<div class='danger'>
      <p><strong>Error Found !!</strong> </p>
      <p><a href='purchaseordernew.php'>CLICK TO CREATE OTHER PO</a></p>

          </div>";

        echo "<script>alert('Data not inserted successfully');window.location.replace('purchaseordernew.php');</script>";
    
      
    }

 /*echo"$date, $ponum, $custid,$invoicenum, $paymentmode,$paymentschedule, $GST,$vname,$shipname,$cname,$shipcompany,$vgstno,$sgstno,$vadd,$sadd,$ccontact,$scontact,$ccontactnum,$scontactnum,$cemail,$semail";
*/




//mysqli_close($conn);
}


else

{
    echo"";
}





?>


</form>
</body>
<script>

  $( function() {
    $( "#dialog" ).dialog();
  } );
 



function go() {
    window.location.replace('purchaseordernew.php');
  
}

$(window).on('beforeunload', function() {
  $(window).on('unload', function() {
    window.location.href = 'index.html';
  });

  return 'Not an empty string';
});
</script>

</html>