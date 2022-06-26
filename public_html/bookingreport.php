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
    $d2 = date('d/m/Y', strtotime('-1 days'));

//$_SESSION["Depot"] = "PUNE";
$depot = $_SESSION['Depot'];
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Booking Arrival</title>
    <!--<link rel="stylesheet" type="text/css" href="style/formborder.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
-->
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

<script type="text/javascript">




    </script>

    <script type="text/javascript">
    $( function() {
    //$( "#d1" ).datepicker({dateFormat:"dd/mm/yy", maxDate: 0,minDate: 0});
    $( "#d1" ).datepicker({dateFormat:"dd/mm/yy",changeMonth: true, changeYear: true});
    $("#d2").datepicker({dateFormat: "dd/mm/yy", changeMonth: true, changeYear: true});
    
     //$("#licexpdate").datepicker({ minDate: +9 ,dateFormat: "dd/mm/yy" });
    } );


</script>

 
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
        body.inset {border-style: inset;
                   border-width: 5px 20px;
        }

         #tabel1 {
  font-family: Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;
            }
  #tabel1 td, #tabel1 th {
  border: 1px solid #add;
  padding: 8px;
         }

  #tabel1 tr:nth-child(even){background-color: #f2f2f2;}

  #tabel1 tr:hover {background-color: #ddd;}

   #tabel1 th {
   padding-top: 12px;
   padding-bottom: 12px;
   text-align: left;
   background-color: #5592bb;
   color: white;
}
  
    
</style>


</head>
 <?php include "menubar.php"?>
<body class="inset">
   
    <form  method="GET" >

	
      <br><br>
      Date from<input type="text" name="d1" id='d1' readonly  value='<?php echo $d1; ?>' required>- TO <input type="text" name="d2" id="d2" readonly value='<?php echo $datestr2; ?>' required>

         Select Depo
    <select name="depo" id="depo"   required>
    <option value="">select </option>
    <option value="PUNE">PUNE-PUNE</option>
    <option value="NGR">ANGR-AHMEDNAGAR</option>
</select>

<input type="submit" id="submit" name="submit">
      

<?php
if(isset($_GET['d1']) && isset($_GET['d2'])  ){

    $d1=$_GET['d1'];
    $d2=$_GET['d2'];
    $depo=$_GET['depo'];
  
  $sql="SELECT ID, BookingNumber, Bdate, Mode, customer_name, consignee_name, receiveing_location, Customer_Number, consignee_number, Payemnt_type, Material_condition, Momenttype, Exceptdelivery, Route, Depot, Fromcity, `Tocity`, consigneeaddress, Invoicegross, Totalpackages, Actualweight, Status_Booking FROM Booking_Materials WHERE Bdate>=STR_TO_DATE('$d1','%d/%m/%Y') AND Bdate<=STR_TO_DATE('$d2','%d/%m/%Y') AND Depot='$depo' ";
//echo"$sql";
  echo"<table id='tabel1' size='50'><thead><tr><th>Booking Number</th><th>Booking Date</th><th>Booking Mode</th><th>Customer</th><th>Consignee</th><th>Receive Location</th><th>customer contact number</th><th>Consignee Contact Number</th><th>Payment Type</th><th>Material Condition </th><th>Moment Type</th><th>Except Delivery </th><th>Route</th><th>Depot </th> <th>From city </th><th>To city </th><th>consignee address</th><th>invoice gross</th><th>Total packages </th><th>actual weight</th><th>Booking Status </th></tr></thead><tbody>";

  $result=mysqli_query($conn,$sql);
  if(mysqli_num_rows($result)>0){
    while($row=mysqli_fetch_assoc($result)){


        echo"<tr>
          <td>".$row['BookingNumber']."</td><td>".$row['Bdate']."</td><td>".$row['Mode']."</td><td>".$row['customer_name']."</td><td>".$row['consignee_name']."</td><td>".$row['receiveing_location']."</td><td>".$row['Customer_Number']."</td><td>".$row['consignee_number']."</td><td>"
          .$row['Payemnt_type']."</td><td>".$row['Material_condition']."</td><td>".$row['Momenttype']."</td><td>".$row['Exceptdelivery']."</td><td>".$row['Route']."</td><td>".$row['Depot']."</td><td>".$row['Fromcity']."</td><td>".$row['Tocity']."</td><td>".$row['consigneeaddress']."</td><td>".$row['Invoicegross']."</td><td>".$row['Totalpackages']."</td><td>".$row['Actualweight']."</td><td>".$row['Status_Booking']."</td>

        </tr>";
    }

  }
  else{

    echo"No Data Found ";
  }




}
else 
{
    echo"No Data Found";
}


?>
</form>
</body>
</html>