<?php
include'connection.php';

session_start();
/*if (!isset($_SESSION['login_user'])) {
    header("location:login.php");
}*/
date_default_timezone_set('Asia/Kolkata');
    $date = new DateTime(); 
    $datestr2 = $date->format('d/m/Y');
    $date->sub(new DateInterval('P1D'));
    $datestr1 = $date->format('d/m/Y');
    echo"";
    
    if (isset($_GET["d1"])) { $d1 = $_GET["d1"]; } else { $d1=$datestr1; };
    if (isset($_GET["d2"])) { $d2 = $_GET["d2"]; } else { $d2=$datestr2; };
    $d2 = date('d/m/Y', strtotime('+5 days'));

$_SESSION["Depot"] = "PUNE";
$depot = $_SESSION['Depot'];


if(isset($_POST["submit"])){
    
    
    
    $d1=$_POST["d1"];
    $vendortype=$_POST["vendortype"];
    $vendorname=$_POST["vendorname"];
     $vehiclenumber=$_POST["vehiclenumber"];
      $meterreading=$_POST["meterreading"];
       $drivername=$_POST["drivername"];
        $FTLType=$_POST["FTLType"];
         $licenseno=$_POST["licenseno"];
          $licexpdate=$_POST["licexpdate"];
          
          $bookingid = isset($_POST['bookingid']) ? $_POST['bookingid'] : '';
          $bookingdate = isset($_POST['bookingdate']) ? $_POST['bookingdate'] : '';
          $Payemnt_type = isset($_POST['Payemnt_type']) ? $_POST['Payemnt_type'] : '';
          $Fromcity = isset($_POST['Fromcity']) ? $_POST['Fromcity'] : '';
          $Tocity = isset($_POST['Tocity']) ? $_POST['Tocity'] : '';
          $Totalpackages = isset($_POST['Totalpackages']) ? $_POST['Totalpackages'] : '';
          $Actualweight = isset($_POST['Actualweight']) ? $_POST['Actualweight'] : '';
         // print_r($bookingid);
            $hamali=$_POST["hamali"];
             $advance=$_POST["advance"];
              $extraamount=$_POST["extraamount"];
               $drivermobile=$_POST["drivermobile"];
                $disel=$_POST["disel"];
                 $toll=$_POST["toll"];
                 
                 
                 
        $sql2="SELECT MAX(CAST(SUBSTRING(`BAS_NUMBER`,9,10) AS UNSIGNED)) FROM BAS where `DEPO` like'%$depot%'";
        echo"$sql2<br>";
         $query2=mysqli_query($conn,$sql2);

          $rows=mysqli_fetch_row($query2);
          $temp="";
          $mid=$rows[0];
   
   
          if($mid=="")
          {
          $temp=1;
          }
          else
          {
             $temp=$mid+1;
          }
         $basnumber="BAS/$depot".str_pad($temp, 10,0,STR_PAD_LEFT);
        
                 $sql="";
                 $sql .="INSERT INTO `BAS`( `BAS_NUMBER`, `BASDATE`, `DEPO`, `VENDORTYPE`, `VENDORNAME`, `VEHICLE_NUMBER`, `METER_READING`, `DRIVER_NAME`, `FTLTYPE`, `LICENSENO`, `LICENSE_EXPIRY`, `HAMALI`, `ADVANCE`, `EXTRA_AMOUNT`, `DRIVER_MOBILE`, `DISEL`, `TOLL`, `STATUS`) VALUES ('$basnumber',STR_TO_DATE('$d1', '%d/%m/%Y'),'$depot','$vendortype','$vendorname','$vehiclenumber','$meterreading','$drivername','$FTLType','$licenseno',STR_TO_DATE('$licexpdate', '%d/%m/%Y'),'$hamali','$advance','$extraamount','$drivermobile','$disel','$toll','1');";
                 
               
               for ($i = 0; $i < count($bookingid); $i++){
                 $sql .="INSERT INTO `BAS_datails`( BAS_NUMBER,`booking_id`, `bookingdate`, `payment_type`, `Fromcity`, `Tocity`, `totalpackages`, `actualweight`) VALUES ('$basnumber','$bookingid[$i]','$bookingdate[$i]','$Payemnt_type[$i]','$Fromcity[$i]','$Tocity[$i]','$Totalpackages[$i]','$Actualweight[$i]');";
                 $sql .="UPDATE `Booking_Materials` SET `Status_Booking`='1' WHERE `BookingNumber`='$bookingid[$i]';";
               }
              // echo"$sql";
               
            $query1=mysqli_multi_query($conn,$sql);

         if($query1== true)
        {
               echo"<div class='success'>
            <p><strong>Success!BOOKING ARRIVAL DONE ID - $basnumber<br>";
              
              /* echo "<script>alert('Data Inserted Successfully');
              </script>";
              echo"<p style='color:green;text-align: center;font-size: 20px;'>PO NO. </p>";*/

         }
         else
         {
             echo"<div class='danger'>
      <p><strong>Error Found !!</strong> </p>
      <p><a href='bookingarrival.php'>CLICK TO CREATE OTHER Arrival</a></p>

          </div>";
            /*echo "<script>alert('Data  Not Inserted');
               </script>";*/
               //window.location.replace('grnarrivalkirti.php')
         }
    
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Booking Material</title>
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

<style>

        div.ui-datepicker {
            font-size: 12px;
        }
        body.inset {border-style: inset;
                   border-width: 5px 20px;
        }
        
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
           
        }
    </script>


</head>
<body class="inset">
    
    
</body>
</html>