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
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Booking Arrival</title>
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

<script type="text/javascript">

document.addEventListener("change", checkSelect);

function checkSelect(evt) {
  const origin = evt.target;

  if (origin.dataset.dependentSelector) {
    const selectedOptFrom = origin.querySelector("option:checked")
      .dataset.dependentOpt || "n/a";
    const addRemove = optData => (optData || "") === selectedOptFrom 
      ? "add" : "remove";
    document.querySelectorAll(`${origin.dataset.dependentSelector} option`)
      .forEach( opt => 
        opt.classList[addRemove(opt.dataset.fromDependent)]("display") );
  }
}
    </script>

    <script type="text/javascript">
    $( function() {
    $( "#d1" ).datepicker({dateFormat:"dd/mm/yy", maxDate: 0,minDate: 0});
    $("#datepicker").datepicker({dateFormat: "dd/mm/yy", changeMonth: true, changeYear: true, maxDate: 0,minDate: 0});
    
     $("#licexpdate").datepicker({ minDate: +9 ,dateFormat: "dd/mm/yy" });
    } );

function updateoption(){
 
  $("#vendorname option").prop("selected", false);
  $("#vehiclenumber option").prop("selected", false);

}

function updateoption1(){
 
  $("#vehiclenumber option").prop("selected", false);

}

 var lastrowid = 0;
  function add_row() {

            document.getElementById('btnaddrow').disabled = true;
            var lrnolist = document.getElementsByName('bookingid[]');
            var iLen = lrnolist.length;
            var val = document.getElementById('txtlrno').value.trim();
            for (var i = 0; i < iLen; i++) {
                if (lrnolist[i].value == val.toUpperCase()) {
                    document.getElementById('warntext').innerText = "Booking  ID. already Present.";
                    document.getElementById('txtlrno').value = "";
                    //alert("LR No. already Present.");
                    document.getElementById('btnaddrow').disabled = false;
                    return;
                }
            }
            $.ajax({
                type: 'post',
                url: 'getbookingdata.php',
                data: {
                    bookingid: document.getElementById('txtlrno').value
                    
                },
                success: function (response) {
                    alert(response);
                    
                   
                    if (response == "No Data.") {
                        document.getElementById('warntext').innerText = "Booking Request ID Not Found"; //alert("LR No. Not Found");
                        document.getElementById('txtlrno').value = "";
                        document.getElementById('btnaddrow').disabled = false;
                    } 
                    
                    
                    else {
                        
                       
                         console.log(response);
                      
                        
                        lastrowid = lastrowid + 1;
                        /*$("#lrdetails tr:last").before("<tr id='row" + lastrowid + "'>" + response + "<td><input type='button' value='DELETE' onclick=delete_row('row" + lastrowid + "')></td></tr>");*/

                        $("#lrdetails tr:last").before(  response  );
                        var tabrow = document.getElementById('row' + lastrowid);
                      /*  var tabcells = tabrow.getElementsByTagName("td");*/

                        document.getElementById('txtlrno').value = "";
                        document.getElementById('warntext').innerText = "";
                        document.getElementById('btnaddrow').disabled = false;
                    }
                }
                ,
                error: function (response) {
                    alert(response);
                    document.getElementById('btnaddrow').disabled = false;
                }
            });
            
        }       
       $(document).ready(function(){
        $("#lrdetails").on('click', '.btnDelete', function () {
    $(this).closest('tr').remove();

    wt = document.getElementsByName('total[]');
   var m=0;
    for(i = 0; i < wt.length; i++){
                if(wt[i].value != ""){                    
                   // tqty += parseFloat(qty[i].value);

                  m= m+parseFloat(wt[i].value);
                }
            }
                  document.getElementById("total1").value = m;



});
        });
</script>
<script>
 
 $(function() {
     $( "#txtlrno" ).autocomplete({
       source: 'getbookingmumber.php',
     });
  });
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
  
    [data-from-dependent] {
  display: none;
}

[data-from-dependent].display {
  display: initial;
}
</style>


</head>
 <?php include "menubar.php"?>
<body class="inset">
   
    <form action="actionbookingarrival.php" method="POST" >

	<table class="table">
    <thead>
      <th>BOOKING ARRIVAL  </th>
      <th><?php echo"$datestr2"; ?></th>
      <th></th>
      <th></th>
      <th></th>
      <th></th>
    </thead>
    <tbody>
      <tr>
        <td>Date </td>
<td><input type="text" name="d1" id="d1" readonly="" class="form-control mb-2 mr-sm-2"  value='<?php echo $datestr2; ?>' required></td>

        <td> </td>
<td><!-- <input type="text" name="companyname" id="companyname" placeholder="Enter Company Name " class="form-control mb-2 mr-sm-2" onkeyup="this.value = this.value.toUpperCase();"  required> --></td>
        <td></td>
<td><!-- <select name="mode" id="mode" class="form-control mb-2 mr-sm-2" required>
    <option value="">select </option>
    <option value="URGENT">URGENT</option>
    <option value="REGULAR">REGULAR</option>
</select> --></td>
      </tr>
      <tr>
        

        <td>Select Vendor Type  </td>
        <td>
            <select id="vendortype" name="vendortype" data-dependent-selector="#vendorname" class="form-control mb-2 mr-sm-2" onchange="updateoption()";  required="">
            	<option  value='' selected>select </option>
            <option data-dependent-opt="ATTACHED" value="ATTACHED">ATTACHED</option>
            <option data-dependent-opt="OWN" value="OWN">OWN</option>
            
            
        </select>
        </td>
        <td> Select Vendor
        </td>
        <td>
        	<select id="vendorname" name="vendorname" data-dependent-selector="#vehiclenumber"  class="form-control mb-2 mr-sm-2" onchange="updateoption1()";  >
        	<option  value='' selected>select</option>
            <option data-from-dependent='OWN' data-dependent-opt="OWN_FASE_1"   Value="OWN_FASE_1" >OWN FASE 1</option>
            <option data-from-dependent='OWN' data-dependent-opt="OWN_FASE_2"   Value="OWN_FASE_2" >OWN FASE 2</option>
            <option data-from-dependent='OWN' data-dependent-opt="OWN_FASE_3"   Value="OWN_FASE_3" >OWN FASE 3</option>
            <option data-from-dependent='OWN' data-dependent-opt="OWN_FASE_4"   Value="OWN_FASE_4" >OWN FASE 4</option>
            <option data-from-dependent='ATTACHED' data-dependent-opt="LOGIC TRANSPORT"   Value="LOGIC TRANSPORT" >LOGIC TRANSPORT</option>
            <option data-from-dependent='ATTACHED' data-dependent-opt="LAKSHMI TRANSPORT"   Value="LAKSHMI TRANSPORT" >LAKSHMI TRANSPORT</option>
             <option data-from-dependent='ATTACHED' data-dependent-opt="SUNSHINE ROADWAYS"   Value="SUNSHINE ROADWAYS" >SUNSHINE ROADWAYS</option>
             <option data-from-dependent='ATTACHED' data-dependent-opt="DROOM VEHICLE"   Value="DROOM VEHICLE" >DROOM VEHICLE</option>
             <option data-from-dependent='ATTACHED' data-dependent-opt="NIGHT STAR TRANSPORT"   Value="NIGHT STAR TRANSPORT" >NIGHT STAR TRANSPORT</option>
             <option data-from-dependent='ATTACHED' data-dependent-opt="MEERA TRANSPORT"   Value="MEERA TRANSPORT" >MEERA TRANSPORT</option>
             <option data-from-dependent='ATTACHED' data-dependent-opt="TARKARI EXPRESS WAYS"   Value="TARKARI EXPRESS WAYS" >TARKARI EXPRESS WAYS</option>
             <option data-from-dependent='ATTACHED' data-dependent-opt="MAHARSHTRA TRANSPORT"   Value="MAHARSHTRA TRANSPORT" >MAHARSHTRA TRANSPORT</option>

      </select>
        </td>
        <td></td>
        <td></td>
      </tr>
      <tr>
        <td>
            Vehicle Number
        </td>
        <td><select id="vehiclenumber" name="vehiclenumber" class="form-control mb-2 mr-sm-2"required>
            <option  value='' selected>select</option>
            <option data-from-dependent='OWN_FASE_1'    Value="MH12 1226" >MH12 1226</option>
            <option data-from-dependent='OWN_FASE_1'    Value="MH12 1227" >MH12 1227</option>
            <option data-from-dependent='OWN_FASE_1'    Value="MH12 1228" >MH12 1228</option>
            <option data-from-dependent='OWN_FASE_1'    Value="MH12 1229" >MH12 1229</option>
            <option data-from-dependent='OWN_FASE_1'    Value="MH12 1230" >MH12 1230</option>
            <option data-from-dependent='OWN_FASE_1'    Value="MH12 1231" >MH12 1231</option>
            <option data-from-dependent='OWN_FASE_1'    Value="MH12 1232" >MH12 1232</option>
            <option data-from-dependent='OWN_FASE_1'    Value="MH12 1233" >MH12 1233</option>
            <option data-from-dependent='OWN_FASE_1'    Value="MH12 1234" >MH12 1234</option>
            <option data-from-dependent='OWN_FASE_1'    Value="MH12 1235" >MH12 1235</option>
            <option data-from-dependent='OWN_FASE_1'    Value="MH12 1236" >MH12 1236</option>
            <option data-from-dependent='OWN_FASE_1'    Value="MH12 1237" >MH12 1237</option>
            
            <option data-from-dependent='OWN_FASE_2'    Value="MH13 1238" >MH13 1238</option>
            <option data-from-dependent='OWN_FASE_2'    Value="MH13 1239" >MH13 1239</option>
            <option data-from-dependent='OWN_FASE_2'    Value="MH13 1240" >MH13 1240</option>
            <option data-from-dependent='OWN_FASE_2'    Value="MH13 1241" >MH13 1241</option>
            <option data-from-dependent='OWN_FASE_2'    Value="MH13 1242" >MH13 1242</option>
            <option data-from-dependent='OWN_FASE_2'    Value="MH13 1243" >MH12 1243</option>
            <option data-from-dependent='OWN_FASE_2'    Value="MH13 1244" >MH13 1244</option>
            <option data-from-dependent='OWN_FASE_2'    Value="MH13 1245" >MH13 1245</option>
            
            <option data-from-dependent='OWN_FASE_3'    Value="MH11 1246" >MH11 1246</option>
            <option data-from-dependent='OWN_FASE_3'    Value="MH11 1247" >MH11 1247</option>
            <option data-from-dependent='OWN_FASE_3'    Value="MH11 1248" >MH11 1248</option>
            
            <option data-from-dependent='OWN_FASE_4'    Value="MH17 1246" >MH17 1246</option>
            <option data-from-dependent='OWN_FASE_4'    Value="MH17 1247" >MH17 1247</option>
            <option data-from-dependent='OWN_FASE_4'    Value="MH17 1248" >MH17 1248</option>
            
            <option data-from-dependent='LOGIC TRANSPORT'    Value="MH17 1246" >MH17 1246</option>
            <option data-from-dependent='LOGIC TRANSPORT'    Value="MH17 1247" >MH17 1247</option>
            <option data-from-dependent='LOGIC TRANSPORT'    Value="MH17 1248" >MH17 1248</option>
            
            <option data-from-dependent='LAKSHMI TRANSPORT'    Value="MH16 1246" >MH16 1246</option>
            <option data-from-dependent='LAKSHMI TRANSPORT'    Value="MH16 1247" >MH16 1247</option>
            <option data-from-dependent='LAKSHMI TRANSPORT'    Value="MH16 1248" >MH16 1248</option>
            
            <option data-from-dependent='SUNSHINE ROADWAYS'    Value="MH19 1246" >MH19 1246</option>
            <option data-from-dependent='SUNSHINE ROADWAYS'    Value="MH19 1247" >MH19 1247</option>
            <option data-from-dependent='DROOM VEHICLE'    Value="MH19 1248" >MH19 1248</option>
            <option data-from-dependent='NIGHT STAR TRANSPORT'    Value="MH19 1246" >MH19 1246</option>
            <option data-from-dependent='TARKARI EXPRESS WAYS'    Value="MH19 1247" >MH19 1247</option>
            <option data-from-dependent='MAHARSHTRA TRANSPORT'    Value="MH19 1248" >MH19 1248</option>
            
            
            
        </select></td>
        
        <td>Vehicle Meter Reading </td>
        <td><input type="number" name="meterreading" id="meterreading" class="form-control mb-2 mr-sm-2"    required></td>
        <td></td>
        <td></td>
      </tr>
      <tr>

        <td>Driver Name </td>
        <td><input type="text" name="drivername" id="drivername" class="form-control mb-2 mr-sm-2" onkeyup="this.value = this.value.toUpperCase();"  required>
        </td>
        <td>Vehicle Capacity Model No </td>
        <td><select id="FTLType" name="FTLType" style='width:200px'
                            oninvalid="this.setCustomValidity('Please select Vehicle Capacity.')"
                            oninput="this.setCustomValidity('')" class="form-control mb-2 mr-sm-2" required>
                                <option value="">SELECT</option>
                                <option value="MINI TEMPO UPTO 1 MT">MINI TEMPO UPTO 1 MT</option>
                                <option value="PICK UP 1 MT TO 2 MT">PICK UP 1 MT TO 2 MT</option>
                                <option value="TEMPO 2 MT TO 3.5 MT">TEMPO 2 MT TO 3.5 MT</option>
                                <option value="TEMPO 3.5 MT TO 5 MT">TEMPO 3.5 MT TO 5 MT</option>
                                <option value="TEMPO 5 MT TO 7 MT">TEMPO 5 MT TO 7 MT</option>
                                <option value="TRUCK 7 MT TO 9 MT">TRUCK 7 MT TO 9 MT</option>
                                <option value="TAURAS 9 MT TO 16 MT">TAURAS 9 MT TO 16 MT</option>
                                <option value="TAURAS 16 MT TO 21 MT">TAURAS 16 MT TO 21 MT</option>
                                <option value="20 FT MULTI EXLE 13 TO 21 MT">20 FT MULTI EXLE 13 TO 21 MT</option>
                                <option value="20 FT MULTI EXLE 21 TO 26 MT">20 FT MULTI EXLE 21 TO 26 MT</option>
                                <option value="20 FT MULTI EXLE UPTO 13 MT">20 FT MULTI EXLE UPTO 13 MT</option>
                                <option value="40 FT MULTI EXLE 13 TO 21 MT">40 FT MULTI EXLE 13 TO 21 MT</option>
                                <option value="40 FT MULTI EXLE 21 TO 26 MT">40 FT MULTI EXLE 21 TO 26 MT</option>
                                <option value="40 FT MULTI EXLE UPTO 13 MT">40 FT MULTI EXLE UPTO 13 MT</option>
                            </select>  </td>

        <td></td>
        <td></td>
      </tr>
     
      <td>License Number </td>
                <td><input type="text" id="licenseno" name="licenseno" class="form-control mb-2 mr-sm-2" required></td>
                <td>License Expiry Date </td>
                <td><input type="text" id="licexpdate" name="licexpdate"class="form-control mb-2 mr-sm-2"  readonly
                required ></td>
            </tr>
            <tr>
            <td colspan="5">
<p>ENTER BOOKING  ID:</p>
        <input type="text" id="txtlrno" maxlength=15><input type="button"
                                                            id="btnaddrow"
                                                            onclick="add_row()"
                                                            value="Add Row"><span
                id="warntext"
                style='margin-left:5px;color:red'></span></td>
                </tr>
    </tbody>
  </table>
  
  <table id="lrdetails" align='center' class="table" border="2" width="50" >
            <tr style=" background-color:#ddd; "  align='center'>
                <th style="height: 25px; width:2%; ">BOOKING ID</th>
                <th style="height: 25px; width:10%; ">Booking DATE </th>
                <th  style="width:10%;" >PAYMENT TYPE</th>
                <th style="width:10%;">FROM</th>
                <th style="width:5%;">TO</th>
                <th style="width:5%;">TOTAL PACKAGES</th>
                <th style="width:5%;">ACTUAL WEIGHT</th>
                <th style="width:5%;">DELETE</th>
            </tr>
            <tr>
                
            </tr>
        </table>
        
        <table  class="table" > 
        <tr>
            <td>Hamali</td>
            <td>
            <input type="number" name="hamali" id="hamali" required>
            </td>
            <td>Advance</td>
            <td>
            <input type="number" name="advance" id="advance" required>
            </td>
            
            <td>Extra Amount</td>
            <td>
            <input type="number" name="extraamount" id="extraamount" required>
            </td>
            </tr>
            
            <tr>
            <td>Driver Mobile Number</td>
            <td>
            <input type="number" name="drivermobile" id="drivermobile" required>
            </td>
            
            <td>Disel Expense</td>
            <td>
            <input type="number" name="disel" id="disel" required>
            </td>
             <td>Toll Expense</td>
            <td>
            <input type="number" name="toll" id="toll" required>
            </td>
            
            </tr>
            <tfoot  ><tr style=" background-color:#ddd; "><td><input type="submit" name="submit" id="submit"></td><td></td><td></td>
            
            </tr> </tfoot>
        </table>


    
   <!-- <tr>
        <td colspan="4" style="height:30px">
        AMOUNT IN WORDS:
        <textarea id=word name=word rows="2" cols="40" required readonly></textarea>

        <td colspan="2">TOTAL </td>
        <td>
            <input style=width:70px type=number id=total1 name=total1 min='0' onblur="word.innerHTML=convertNumberToWords(this.value)"  required readonly>
             <input type='button' onclick="add_row();" value='Add Row'>  </td>

     </tr>-->

	</form>
</body>
</html>