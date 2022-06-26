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
    
    if (isset($_GET["d1"])) { $d1 = $_GET["d1"]; } else { $d1=$datestr1; };
    if (isset($_GET["d2"])) { $d2 = $_GET["d2"]; } else { $d2=$datestr2; };
    $d2 = date('d/m/Y', strtotime('30 days'));




$_SESSION["DEPO"] = "PUNE";
$depot = $_SESSION['DEPO'];
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

    <script type="text/javascript">
    $( function() {
    $( "#d1" ).datepicker({dateFormat:"dd/mm/yy"});
    } );

    $( function() {
    $( "#exceptdelivery" ).datepicker({dateFormat:"dd/mm/yy"});
    } );
    
    $( function() {
    $( "#invdate1" ).datepicker({dateFormat:"dd/mm/yy"});
    } );

 var lastrowid = 1;
function add_row() {
            if ($("#invtab tr").length > 8) {
                alert("Cannot add more than 7 rows.");
                return;
            }
            lastrowid = lastrowid + 1;
            var htmltxt = document.getElementById("row1").innerHTML.replace("hasDatepicker", "");
            htmltxt = htmltxt.replace("invdate1", "invdate" + lastrowid);
            $("#invtab tr:last").before("<tr id='row" + lastrowid + "'>" + htmltxt + "<td><input type='button' value='DELETE' onclick=delete_row('row" + lastrowid + "','enrexp')></td></tr>");

            $(function () {
                $("#invdate" + lastrowid).datepicker({dateFormat: "dd/mm/yy"});
            });
        }

        function delete_row(rowno) {
            $('#' + rowno).remove();
            calinvamt();

            var twt = 0;
            var tqty = 0;
            var tewtchrg = 0;

            var qty = document.getElementsByName('pkgno[]');
            var wt = document.getElementsByName('actwt[]');
            var ewtchrg = document.getElementsByName('Exwtchrgs[]');

            for (var i = 0, iLen = wt.length; i < iLen; i++) {
                if (wt[i].value != "")
                    twt += parseFloat(wt[i].value);
                if (qty[i].value != "")
                    tqty += parseFloat(qty[i].value);
                if (qty[i].value != "" && ewtchrg[i].value != "")
                    tewtchrg += parseFloat(qty[i].value) * parseFloat(ewtchrg[i].value);
            }
            document.getElementById("tactwt").value = twt;
            document.getElementById("tpkgno").value = tqty;
            document.getElementById("excesscharge").value = tewtchrg;
        }

        function validate() {
            if ($("#form1")[0].checkValidity()) {
                $("#form1").find("input,select,textarea").prop('disabled', false);
                if (document.form1.Consignorfrom.value == "From Master")
                    radclick('crfm');
                else
                    radclick('crwi');
                if (document.form1.Consigneefrom.value == "From Master")
                    radclick('cefm');
                else
                    radclick('cewi');
                document.getElementById("Submit").disabled = true;
                $("#form1").submit();
            } else
                $("#form1")[0].reportValidity();
        }

        function calamt(e) {
            var qty;
            //var wtcharg;
            var wtperpkg;
            var wt;
            var twt = 0;
            var tqty = 0;
            var tewtchrg = 0;
            var index = 99;
            var i = 0;

            qty = document.getElementsByName('pkgno[]');
            wtperpkg = document.getElementsByName('actwtperpkg[]');
            wt = document.getElementsByName('actwt[]');
            var ewtchrg = document.getElementsByName('Exwtchrgs[]');

            for (i = 0; i < qty.length; i++) {
                if (qty[i] == e) {
                    index = i;
                    break;
                }
            }
            if (index == 99)
                for (i = 0; i < wtperpkg.length; i++) {
                    if (wtperpkg[i] == e) {
                        index = i;
                        break;
                    }
                }

            wt[index].value = parseFloat(qty[index].value) * parseFloat(wtperpkg[index].value);

            i/*f (ewobj != undefined) {
                for (var j = 0, jLen = ewobj.Rates.length; j < jLen; j++) {
                    if (wtperpkg[index].value >= ewobj.Rates[j].FromWeight && wtperpkg[index].value <= ewobj.Rates[j].ToWeight) {
                        ewtchrg[index].value = ewobj.Rates[j].Rate;
                        break;
                    } else
                        ewtchrg[index].value = 0;
                }
            } else
                ewtchrg[index].value = 0;*/

            for (var i = 0, iLen = wt.length; i < iLen; i++) {
                if (wt[i].value != "")
                    twt += parseFloat(wt[i].value);
                if (qty[i].value != "")
                    tqty += parseFloat(qty[i].value);
                if (qty[i].value != "" && ewtchrg[i].value != "")
                    tewtchrg += parseFloat(qty[i].value) * parseFloat(ewtchrg[i].value);
            }
            document.getElementById("tactwt").value = twt;
            document.getElementById("tpkgno").value = tqty;
            document.getElementById("excesscharge").value = tewtchrg;
        }

        function calinvamt() {
            var tinvamt = 0;
            var invamt = document.getElementsByName('declval[]');

            for (var i = 0, iLen = invamt.length; i < iLen; i++)
                if (invamt[i].value != "")
                    tinvamt += parseFloat(invamt[i].value);
            document.getElementById("tdeclval").value = tinvamt;
            alert(tinvamt);
        }

    </script>
    <script>
function showUser(str) {
  if (str == "") {
    document.getElementById("route").innerHTML = "";
    return;
  } else {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        document.getElementById("tocity").innerHTML = this.responseText;
      }
    };
    xmlhttp.open("GET","gettocity.php?q="+str,true);
    xmlhttp.send();
  }
}
</script>
<script type='text/javascript'>
        
        
        
        
        $( function() {
    $( "#dialog" ).dialog();
  } );
    </script>
    <style>
     div.ui-datepicker {
            font-size: 12px;
        }
        body.formborder {border-style: inset;
                   border-width: 5px 20px;
        }
    </style>
    
</head>
<?php include"menubar.php"; ?>
<body class="formborder" >

<div class="container">
<form method="post" class="form-inline" action="">
    
   
    





<table class="table">
    <thead>
      <th>BOOKING MATERIALS  </th>
      <th><?php echo"$d1"; ?></th>
      <th></th>
      <th></th>
      <th></th>
      <th></th>
    </thead>
    <tbody>
      <tr>
        <td>Date </td>
<td><input type="text" name="d1" id="d1" readonly="" class="form-control mb-2 mr-sm-2"  value='<?php echo $d1; ?>' required></td>

        <td>Enter Company Name </td>
<td><input type="text" name="companyname" id="companyname" placeholder="Enter Company Name " class="form-control mb-2 mr-sm-2" onkeyup="this.value = this.value.toUpperCase();"  required></td>
        
<td>Ente Consignee Name</td>
<td><input type="text" name="Consignee" id="Consignee" placeholder="Enter Consignee Name " class="form-control mb-2 mr-sm-2" onkeyup="this.value = this.value.toUpperCase();"  required></td>
      </tr>
      
      <tr>
          <td>Material Receive Location</td>
          <td><input type="text" name="receivelocation" id="receivelocation" placeholder="receive location " class="form-control mb-2 mr-sm-2" onkeyup="this.value = this.value.toUpperCase();"  required></td>
          <td>Company Number</td>
          <td><input type="number" id="companynumber" name="companynumber" class="form-control mb-2 mr-sm-2" requird></td>
          <td>Consignee Number</td>
          <td><input type="number" id="consigneenumber" name="consigneenumber" class="form-control mb-2 mr-sm-2" required></td></tr>
      <tr>
          <td>Mode Of Transport</td>
          <td><select name="mode" id="mode" class="form-control mb-2 mr-sm-2" required>
    <option value="">select </option>
    <option value="URGENT">URGENT</option>
    <option value="REGULAR">REGULAR</option>
</select></td>
        

        <td>Select Payment Type  </td>
        <td>
            <select id="paymenttype" name="paymenttype" class="form-control mb-2 mr-sm-2" required="">
            <option value="">SELECT</option>
            <option value="CASH">CASH</option>
            <option value="CASHONDELIVERY">CASHONDELIVERY</option>
            <option value="BANK">BANK</option>
            <option value="CREDIT">CREDIT</option>
            <option value="OTHER">OTHER</option>
            
        </select>
        </td>
        <td> Material Condition 
        </td>
        <td><input type="text" name="materialcondition" id="materialconfition" class="form-control mb-2 mr-sm-2" required=""></td>
        <td></td>
        <td></td>
      </tr>
      <tr>
        <td>
            Type Of Moment 
        </td>
        <td><select id="momenttype" name="momenttype" class="form-control mb-2 mr-sm-2"required>
            <option value="ROAD">ROAD</option>
            <option value="SHIP">SHIP</option>
            <option value="RAIL">RAIL</option>
            
        </select></td>
        
        <td>
        Except Delivery 
        </td>
        <td><input type="text" name="exceptdelivery" id="exceptdelivery" class="form-control mb-2 mr-sm-2" readonly="" required value="<?php echo"$d2"; ?>"></td>
        <td>Consignee Address</td>
        <td><input type="text" name="consigneeaddress" id="consigneeaddress" placeholder="Enter condignee address " class="form-control mb-2 mr-sm-2" onkeyup="this.value = this.value.toUpperCase();"  required></td>
      </tr>
      <tr>

        <td>Route No </td>
        <td><select id="route" name="route" class="form-control mb-2 mr-sm-2" onchange="showUser(this.value)" required>
            <option value="">SELECT</option>
            <?php
        //$sql="SELECT `city`,`route` FROM `india` GROUP BY `route`";
        $sql="SELECT `CityNameEng` as city,`RouteNo` as route FROM `India` GROUP BY `RouteNo`";
        $resultroute=mysqli_query($conn,$sql);
        while($row=mysqli_fetch_assoc($resultroute)){
            echo"<option value=".$row['route'].">".$row['route']."</option>";
        }


         ?>
         </select> </td>
        <td>From City </td>
        <td><?php echo"$depot"; ?></td>

        <td>To City</td>
        <td><select id="tocity" name="tocity" class="form-control mb-2 mr-sm-2">
             <option value="">select</option>
         </select></td>
      </tr>
      <tr>
          
          </tr>
    

    </tbody>
  </table>
  <hr>
  <table id='invtab' class='blueTable' border='2' >
            <tr align='center'>
                <th>Invoice No</th>
                <th>Invoice Date</th>
                <th>Packaging Type</th>
                <th>Product Type</th>
                <th>Invoice Gross Value</th>
                <th>No of Pkgs.</th>
                <th>Actual Weight/Pkg</th>
                <th>Actual Weight</th>
                <th>Excess Rate(In Rs.)</th>
            </tr>
            <tr id='row1'>
                <td><input type='text' name='invoiceno[]' size=10></td>
               <td><input type='text' id="invdate1" name='invoicedate[]' value="<?php echo $d1; ?>" size=10
                           readonly></td> 
                <td><select name='pkgtype[]'>
                        <option value="BAGS">BAGS</option>
                        <option value="BOX">BOX</option>
                        <option value="BUCKETS">BUCKETS</option>
                        <option value="BUNDAL">BUNDAL</option>
                        <option value="CAN">CAN</option>
                        <option value="DRUM">DRUM</option>
                        <option value="PACKET">PACKET</option>
                        <option value="PIPE">PIPE</option>
                        <option value="TYRES">TYRES</option>
                        
                    </select></td>
                <td><select name='prodtype[]'>
                        <option value="ADVERTISE MATERIAL">ADVERTISE MATERIAL</option>
                        <option value="Auto parts">Auto parts</option>
                        <option value="FERTILIZERS">FERTILIZERS</option>
                        <option value="MEDICINE">MEDICINE</option>
                        <option value="PALLETS">PALLETS</option>
                        <option value="PESTICIDES">PESTICIDES</option>
                        <option value="SEEDS">SEEDS</option>
                        <option value="SPRAY PUMP">SPRAY PUMP</option>
                        <option value="STATIONERY">STATIONERY</option>
                        <option value="E-Goods">E-Goods</option>
                        <option value="CHEMICAL">CHEMICAL</option>
                        <option value="PAINT">PAINT</option>
                        <option value="MOTOR">MOTOR</option>
                        <option value="ELECTRICS">ELECTRICS</option>
                        <option value="TYRE">TYRE</option>
                        <option value="COSMETIC">COSMETIC</option>
                        <option value="PVC">PVC</option>
                        <option value="Packaging Material">Packaging Material</option>
                        <option value="WOODEN FRAME">WOODEN FRAME</option>
                        <option value="ITEM">ITEM</option>
                        <option value="TARPAULIN">TARPAULIN</option>
                        <option value="ROLL">ROLL</option>
                        <option value="CLOTHES">CLOTHES</option>
                        <option value="WOODENSTICKS">WOODENSTICKS</option>
                        <option value="INCENSESTICKS">INCENSESTICKS</option>
                        <option value="RACK">RACK</option>
                        <option value="POT">POT</option>
                        <option value="SUNMICA">SUNMICA</option>
                        <option value="PLYWOOD">PLYWOOD</option>
                        <option value="WIRE">WIRE</option>
                        <option value="GLASS">GLASS</option>
                        <option value="PLASTICS">PLASTICS</option>
                        <option value="HARDWARE">HARDWARE</option>
                        <option value="GLOSORY">GLOSORY</option>
                        <option value="FOODS">FOODS</option>
                        <option value="CERAMIC">CERAMIC</option>
                        <option value="POP">POP</option>
                        <option value="ELECTONICS">ELECTONICS</option>
                    </select></td>
                <td><input type='text' name='declval[]' size=10 onchange="calinvamt()" pattern="[0-9]+"
                           oninvalid="chkvalidity(this)" oninput="this.setCustomValidity('')"></td>
                <td><input type='text' name='pkgno[]' size=10 onchange="calamt(this)" pattern="[0-9]+"
                           oninvalid="chkvalidity(this)" oninput="this.setCustomValidity('')"></td>
                <td><input type='text' name='actwtperpkg[]' size=10 onchange="calamt(this)" pattern="[0-9]+"
                           oninvalid="chkvalidity(this)" oninput="this.setCustomValidity('')"></td>
                <td><input type='text' name='actwt[]' size=10 readonly></td>
                <td><input type='text' name='Exwtchrgs[]' size=10 ></td>
            </tr>
            <tr>
                <td colspan=4 align='right'>Total</td>
                <td><input type='text' id='tdeclval' name='tdeclval' size=10 readonly></td>
                <td><input type='text' id='tpkgno' name='tpkgno' size=10 readonly></td>
                <td></td>
                <td><input type='text' id='tactwt' name='tactwt' size=10 ></td>
                <td></td>
                <td><input type='button' id="addrow" onclick="add_row()" value='Add Row'></td>
            </tr>
        </table>

        
   <input type="submit" name="submit" id="submit" class="form-control mb-2 mr-sm-2">   
</form> 
<h1> </h1>



</div>

</body>
</html>



<?php
if (isset($_POST['submit'])) {

    // code...
    $bookingdate=$_POST['d1'];
    $mode_of_transport=$_POST['mode'];
    $companyname=$_POST['companyname'];
    $Consignee=$_POST['Consignee'];
    $companynumber=$_POST['companynumber'];
    $consigneenumber=$_POST['consigneenumber'];
    $paymenttype=$_POST['paymenttype'];
    $materialcondition=$_POST['materialcondition'];
    $momenttype=$_POST['momenttype'];
    $exceptdelivery=$_POST['exceptdelivery'];
    $receivelocation=$_POST['receivelocation'];
    $route=$_POST['route'];
    
    //$depot=$_POST['depot'];

    $fromcity=$depot;
    $tocity=$_POST['tocity'];
    $consigneeaddress=$_POST['consigneeaddress'];
    
    $invoiceno=isset($_POST['invoiceno']) ? $_POST['invoiceno'] : '';
    $invoicedate=isset($_POST['invoicedate']) ? $_POST['invoicedate'] : '';
     $pkgtype=isset($_POST['pkgtype']) ? $_POST['pkgtype'] : '';
    $prodtype=isset($_POST['prodtype']) ? $_POST['prodtype'] : '';
    $invoicevalue=isset($_POST['declval']) ? $_POST['declval'] : '';
    $pkgno=isset($_POST['pkgno']) ? $_POST['pkgno'] : '';
    $actwtperpkg= isset($_POST['actwtperpkg']) ? $_POST['actwtperpkg'] : '';
    $actwt= isset($_POST['actwt']) ? $_POST['actwt'] : '';
    $Exwtchrgs= isset($_POST['Exwtchrgs']) ? $_POST['Exwtchrgs'] : '';
    
    $tdeclval=$_POST['tdeclval'];
    $tpkgno=$_POST['tpkgno'];
    $tactwt=$_POST['tactwt'];


    $sql1="SELECT MAX(CAST(SUBSTRING(BookingNumber,7,6) AS UNSIGNED)) as ss FROM Booking_Materials WHERE BookingNumber like'%$depot%' ";
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
    
                    $bookingno="BO$depot".str_pad($temp, 6,0,STR_PAD_LEFT);



   $sql="";
    $sql .="INSERT INTO `Booking_Materials`( `BookingNumber`, `Bdate`, `Mode`,customer_name,consignee_name
,receiveing_location,Customer_Number,consignee_number, `Payemnt_type`, `Material_condition`, `Momenttype`, `Exceptdelivery`, `Route`, `Depot`, `Fromcity`, `Tocity`, consigneeaddress,`Invoicegross`, `Totalpackages`, `Actualweight`, `Status_Booking`) VALUES ('$bookingno',STR_TO_DATE('$bookingdate', '%d/ %m/ %Y'),'$mode_of_transport','$companyname','$Consignee','$receivelocation','$companynumber','$consigneenumber','$paymenttype','$materialcondition','$momenttype',STR_TO_DATE('$exceptdelivery','%d/%m/%Y'),'$route','$depot','$depot','$tocity','$consigneeaddress','$tdeclval','$tpkgno','$tactwt',0);";
       for ($i = 0; $i < count($invoiceno); $i++){
         $sql .="INSERT INTO `Booking_details`(`Booking_no`, `invoice_date`, `InvoiceNo`, `PkgsType`, `Production_Type`, `Invoice_value`, `PkgsNO`, `ActualWeightPerKg`, `Weight_total`, `wt_charges`) VALUES ('$bookingno',STR_TO_DATE('$invoicedate[$i]', '%d /%m/ %Y'),'$pkgtype[$i]','$prodtype[$i]','$invoicevalue[$i]','$pkgno[$i]','$actwtperpkg[$i]','$actwtperpkg[$i]','$actwt[$i]','$Exwtchrgs[$i]');";



     }
     $result=mysqli_multi_query($conn,$sql);
     if($result==true){
         
         echo"<div id='dialog' title='Basic dialog'><h2>
  <p>Your Booking Is Done.<br>The Booking Number Is:$bookingno  </p>
</div></h2>";
         echo"<script>if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href);
            //window.location.replace('purchaseordernew.php');

        }


        window.onbeforeunload = function() {
            return 'you can not refresh the page';
            window.location.replace('bookingmaterial.php');

        }</script>";
         
     }
     else{
         
         
         echo"<div id='dialog' title='Basic dialog'><h2>
      <p>something wrong Please Fill Again<br>$sql </p>
      </div></h2>";
     }
     

    
    
    
    

}

?>