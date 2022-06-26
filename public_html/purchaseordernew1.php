<?php
include'connection.php';
session_start();

$msg = "";

if (!isset($_SESSION['login_user'])) {
    header("location:login.php");
}
/*if(!in_array('purchaseordernew',$_SESSION['PageAccess']))
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


//$conn=mysqli_connect('localhost','root','','tushar');

?>

<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" type="text/css" href="style/formborder.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


  <meta charset="utf-8">
  <title>PURCHASE ORDER</title>
<script type="text/javascript">



function convertNumberToWords(amount) {
    var words = new Array();
    words[0] = '';
    words[1] = 'One';
    words[2] = 'Two';
    words[3] = 'Three';
    words[4] = 'Four';
    words[5] = 'Five';
    words[6] = 'Six';
    words[7] = 'Seven';
    words[8] = 'Eight';
    words[9] = 'Nine';
    words[10] = 'Ten';
    words[11] = 'Eleven';
    words[12] = 'Twelve';
    words[13] = 'Thirteen';
    words[14] = 'Fourteen';
    words[15] = 'Fifteen';
    words[16] = 'Sixteen';
    words[17] = 'Seventeen';
    words[18] = 'Eighteen';
    words[19] = 'Nineteen';
    words[20] = 'Twenty';
    words[30] = 'Thirty';
    words[40] = 'Forty';
    words[50] = 'Fifty';
    words[60] = 'Sixty';
    words[70] = 'Seventy';
    words[80] = 'Eighty';
    words[90] = 'Ninety';
    amount = amount.toString();
    var atemp = amount.split(".");
    var number = atemp[0].split(",").join("");
    var n_length = number.length;
    var words_string = "";
    if (n_length <= 9) {
        var n_array = new Array(0, 0, 0, 0, 0, 0, 0, 0, 0);
        var received_n_array = new Array();
        for (var i = 0; i < n_length; i++) {
            received_n_array[i] = number.substr(i, 1);
        }
        for (var i = 9 - n_length, j = 0; i < 9; i++, j++) {
            n_array[i] = received_n_array[j];
        }
        for (var i = 0, j = 1; i < 9; i++, j++) {
            if (i == 0 || i == 2 || i == 4 || i == 7) {
                if (n_array[i] == 1) {
                    n_array[j] = 10 + parseInt(n_array[j]);
                    n_array[i] = 0;
                }
            }
        }
        value = "";
        for (var i = 0; i < 9; i++) {
            if (i == 0 || i == 2 || i == 4 || i == 7) {
                value = n_array[i] * 10;
            } else {
                value = n_array[i];
            }
            if (value != 0) {
                words_string += words[value] + " ";
            }
            if ((i == 1 && value != 0) || (i == 0 && value != 0 && n_array[i + 1] == 0)) {
                words_string += "Crores ";
            }
            if ((i == 3 && value != 0) || (i == 2 && value != 0 && n_array[i + 1] == 0)) {
                words_string += "Lakhs ";
            }
            if ((i == 5 && value != 0) || (i == 4 && value != 0 && n_array[i + 1] == 0)) {
                words_string += "Thousand ";
            }
            if (i == 6 && value != 0 && (n_array[i + 1] != 0 && n_array[i + 2] != 0)) {
                words_string += "Hundred and ";
            } else if (i == 6 && value != 0) {
                words_string += "Hundred ";
            }
        }
        words_string = words_string.split("  ").join(" ");
    }
    return words_string;
}

function calamt(e) {
            var qty;
            var wtperpkg;
            var wt;
            var twt = 0;
            var tqty = 0;
            var index = 99;
            var i = 0;

            qty = document.getElementsByName('quantity[]');
            wtperpkg = document.getElementsByName('rate[]');
            wt = document.getElementsByName('total[]');

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

            for(i = 0; i < qty.length; i++){
                if(qty[i].value != ""){                    
                    tqty += parseFloat(qty[i].value);
                }
                if(wt[i].value != ""){
                    twt += parseFloat(wt[i].value);
                }
            }
            //document.getElementById("dtltr").value = tqty;
            document.getElementById("total1").value = twt;
        }
    
  
        var lastrowid1 = 1;
        function add_row1() {
        
         
                    lastrowid1 = lastrowid1 + 1;
                    var htmltxt = document.getElementById("srow2").innerHTML.replace("hasDatepicker", "");
                    htmltxt = htmltxt.replace("terms1", "terms" + lastrowid1);
                    $(".addRowSecond:last").after("<tr class='addRowSecond' id='srow2" + lastrowid1 + "'>" + htmltxt + "<td>&nbsp;<input type='button' value='DELETE' onclick=delete_row1('srow2" + lastrowid1 + "')></td></tr>");
           
        }
        function delete_row1(rowno) {
            $('#' + rowno).remove();
            
            /*document.getElementById("total").value = twt;
             wt = document.getElementsByName('total1[]');
             twt=
*/
        }


        function validateCondition() {
            if (validatecond(document.getElementById('terms')))
                document.getElementById('vehtxtter').innerHTML = "";
            else
                document.getElementById('vehtxtter').innerHTML = "Invalid";
        }   

        $( function() {
      $( "#d1" ).datepicker({dateFormat : "dd/mm/yy", changeMonth: true, changeYear: true});

   });

        $("#ponum").keydown(function(e){
  if(!(e.key=='/'||e.key=='-' || (e.key>=0 && e.key<=9) || (e.which>=65 && e.which<=90) || e.which==8)){
   e.preventDefault();
   e.stopPropagation();
   }
     }); 

        $("#address").keydown(function(e){
  if(!(e.key=='/'||e.key=='-' || (e.key>=0 && e.key<=9) || (e.which>=65 && e.which<=90) || e.which==8)){
   e.preventDefault();
   e.stopPropagation();
   }
     }); 
//////////////////////////////add row///////////////////////////////////////        
 

 var lastrowid = 0;
  function add_row() {

            document.getElementById('btnaddrow').disabled = true;
            var lrnolist = document.getElementsByName('AssetreqID[]');
            var iLen = lrnolist.length;
            var val = document.getElementById('txtlrno').value.trim();
            for (var i = 0; i < iLen; i++) {
                if (lrnolist[i].value == val.toUpperCase()) {
                    document.getElementById('warntext').innerText = "Asset Request ID. already Present.";
                    document.getElementById('txtlrno').value = "";
                    //alert("LR No. already Present.");
                    document.getElementById('btnaddrow').disabled = false;
                    return;
                }
            }
            $.ajax({
                type: 'post',
                url: 'getassetreqdata.php',
                data: {
                    AssetreqID: document.getElementById('txtlrno').value
                    
                },
                success: function (response) {
                    alert(response);
                    
                   
                    if (response == "No Data.") {
                        document.getElementById('warntext').innerText = "Asset Request ID Not Found"; //alert("LR No. Not Found");
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

/*function delete_row(rowno1) {
         var tabrow = document.getElementById(rowno1);
            var tabcells = tabrow.getElementsByTagName("td");

            $(this).closest('tr').remove();
            
            $('#' + rowno1).remove();
        }*/

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
   $(document).ready(function() {   
 $("#txtlrno").autocomplete({
                minLength: 3,
                source: 'assetidsearch.php'
            });
 });
 </script>
<style type="text/css">

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
  
  #kk,table, td, th {
  border: 1px solid black;
}

#kk,table {
    border: 2px solid black ;
  border-collapse: collapse;
  width: 91%;
}

th,td { background-color:#ddd;
 
}
#kk, table.table {
  margin-left: auto; 
  margin-right: auto;}

  .m111{
        margin : 5px;
         height:35.1pt ;
    }

    input[type=text] {
  
  padding: 2px 20px;
  margin: 8px 0;
  box-sizing: border-box;
}

.tooltip {
    display: inline-block;    
}
.tooltip .tooltiptext {
    margin-left:9px;
    width : 100px;
    visibility: hidden;
    background-color: #FFF;
    border-radius:4px;
    border: 1px solid #aeaeae;
    position: absolute;
    z-index: 1;
    padding: 5px;
    margin-top : -15px; 
    opacity: 0;
    transition: opacity 0.5s;
}
.tooltip .tooltiptext::after {
    content: " ";
    position: absolute;
    top: 5%;
    right: 100%;  
    margin-top: -5px;
    border-width: 5px;
    border-style: solid;
    border-color: transparent #aeaeae transparent transparent;
}


.tooltip:hover .tooltiptext {
    visibility: visible;
    opacity: 1;
}
</style>

</head>
<body bgcolor="aliceblue">
    <?php include 'menubar.php';?>
    <div class="container">
    <form method="post" action="insrtpurchaseoeder.php" enctype="multipart/form-data">

  <div id="tab">
    <table   style=""   id='main' class="table">
    <!-- <tr>
      <th colspan="5"style= "background-color:#ddd; text-align:center; height: 30px;">VTC 3 PL SERVICES PVT.LTD</th>
    </tr> -->
         
         <tr>
          <th colspan="5" style= "background-color:#ddd;text-align:center;height: 30px;"> PURCHASE ORDER</th>

         </tr>

         <tr>
          <td rowspan ="6" style= "background-color:white;width:55%;"> 

            
             <select id="company_name" name="company_name" required>   
             <option VALUE="" selected>--SELECT--</option>
             <option VALUE="OM LOGIC">OM LOGIC</option>
             <option VALUE="NORTHEN STAR PVT LTD">NORTHEN STAR PVT LTD </option>
            <option VALUE="VISHAL SCM PVT.LTD">VISHAL SCM PVT.LTD</option>
           </select> 
            <br>

               <!--  H.O.: Vishal House, Sr.No.166, Gajanan Nagar,<BR>
               A/P:Fursungi, Tal: Haveli, Dist: Pune-412308.<BR>
               CIN No: U60200PN2012PTC142997 <BR>
               GST Code: 996511 PAN: AAECV0781E -->
                 
            <!-- C/O-VTC 3PL SERVICES PVT.LTD.,<BR>
             Gat No.1191/5-8,A/p: Yamai Shivari,Pune,Jejuri<br>
             Road,Near Yamai Mata Mandir,Tal:Purandar,<br>
             Dist:Pune-412301.  -->
           <!-- <label>TO:</label> <br>    
           <textarea id="cnameadd" name="cnameadd" rows="8" cols="60" placeholder="Company Details">
           </textarea> -->
             </b>
          </td>
            
             <td > DATE</td>
             <td>&nbsp; &nbsp;&nbsp;<input type='text' name='d1' id='d1'  readonly value="<?php echo"$d2"; ?>"></td>
             
            
          <?php
/*
          $sql2="SELECT MAX(CAST(SUBSTRING(porderId,3,6) AS UNSIGNED)) as ss FROM purchaseorder2021";
   
           $query2=mysqli_query($conn,$sql2);
    
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
*/


          ?>

            <tr>
            <td> PO NO </td>
            <td>
               <div class="tooltip">
                &nbsp; &nbsp;&nbsp;<input type='text' name='ponum' id='ponum' placeholder="PURCHASE ORDER NUMBER SYSTEM GENERATED" value="<?php //echo"$ponum"; ?>" readonly >

            <span class="tooltiptext">This PO(PURCHASE ORDER) Number Are System Generated. </span>
</div>
            </td>
            </tr>

             <tr>
               <td> CUSTOMER ID </td>
               <td>&nbsp; &nbsp;&nbsp;<input type='text' name='custid' id='custid' placeholder="CUSTOMER ID" required ></td>
             </tr>

              <tr>
               <td> <!--INVOICE NO--> </td>
               <td>&nbsp; &nbsp;&nbsp;<!--<input type='text' name='invoiceno' id='invoiceno'>--></td>
             </tr>
             <tr>
                <td colspan='4'>   MODE OF PAYMENT &nbsp;&nbsp;
                    
                <!--<input type='text' name='paymentmode' id='paymentmode' required>-->
                <select name="paymentmode" id="paymentmode" required> 
                <option value="" selected>select</option>
                 <option value="CASH">CASH</option>
                 <option value="BANK">BANK</option>
                 <select>
                
                
                
                </td>

             </tr>
             
             <tr>
                <td  colspan="4" style="height: 20px;">  PAYMENT SCHEDULE&nbsp;

                    <input type="text" name="pschedule" id="pschedule" placeholder="PAYMENT SCHEDULE" required>
                  </td>
             </tr>

</tr>

<tr>
    <td style= "width:55%;">&nbsp;<!--GST NO:

    <input type='text' name='gst' id='gst' required>--></td>

    <td colspan="3"> PURCHASE ITEM REQUIRED FOR <input type="text" name="requiredfor" name="requiredfor" required placeholder="PURCHASE ITEM REQUIRED FOR"></td>
    
    <!-- <td colspan="4"> PURCHASED ITEM </td> -->


    </tr>

    <tr>
        <td  style= "width:55%; height: 45px">BUYER: <input type="text" name="buyer" id="buyer" placeholder="Buyer" required>  </td>

        <td colspan="4"> PURCHASED ITEM: <input type="text" name="purchaseitem" id="purchaseitem" placeholder="purchaseitem" required="">  </td>
    </tr>

    <tr>
        <td colspan="5" style="text-align:center;background-color:#ddd;"><b>&nbsp; <!--PAYMENT STATUS--></td></b>
    </tr>

    <tr>
        <td style= "width:55%;background-color:#ddd;"><h4> VENDOR </h4></td>
        <td colspan='4'style=  "background-color:#ddd;"><h4> SHIP TO </h4></td>
    </tr>

    <tr>


    <td style= "width:10%;">PERSON NAME: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="vname" id="vname" placeholder="PERSON NAME" required> </td>
        <td colspan='4'style= ""> PERSON NAME:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="shipname" id="shipname"placeholder="PERSON NAME" required></td>
    </tr>

    <tr>
    <td style= "width:55%;"> COMPANY NAME: &nbsp;<input type="text" name="cname" id="cname" required> </td>
        <td colspan='4'style= ""> COMPANY NAME: &nbsp;<input type="text" name="shipcompany" id="shipcompany" required></td>
    </tr>

    <tr>
    <td style= "width:55%;">&nbsp; <!--GST NO:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input type="hidden"><input type="text" name="cgstno" id="cgstno" required>--> </td>
        <td colspan='4'style= "">&nbsp; <!--GST NO:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input type="hidden"><input type="text" name="sgstno" id="sgstno" required>--></td>
    </tr>

    <tr>
    <td style= "width:55%;"> ADDRESS: &nbsp; </td>
        <td colspan='4'style= ""> ADDRESS: &nbsp;</td>
    </tr>

    <tr>
    <td style= "width:55%; height: 50px"> <textarea rows="4" cols="50" name="cadress" placeholder="company  Address"></textarea></td>

        <td colspan='4'style= "height: 50px"> <textarea rows="4" cols="50" name="sadress" placeholder="Shipment  Address"></textarea></td>
    </tr>


    <tr>
    <td style= "width:55%;">CONTACT PERSON: <input type="text" name="ccontact" id='ccontact' required> </td>

        <td colspan='4'style= "">CONTACT PERSON: <input type="text" name="scontact" id='scontact' required></td>
    </tr>

    <tr>
    <td style= "width:55%;">CONTACT NUMBER: <input type="tel" name="ccontactnum" id='ccontactnum' pattern="[0-9]{10}" required> </td>

        <td colspan='4'style= "">CONTACT NUMBER: <input type="tel" name="scontactnum" id='scontactnum'pattern="[0-9]{10}" required></td>
    </tr>

    <tr>
    <td style= "width:55%;">EMAIL:  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input type="email" name="cemail" id='cemail' > </td>

        <td colspan='4'style= "">EMAIL:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input type="email" name="semail" id='semail' ></td>
    </tr>

    <tr>
        <td colspan="5" style="text-align:center;background-color:#ddd; height: 20px"></td>
    </tr>
   <tr>
       <td colspan="5">
<p>ENTER ASSET REQUEST ID:</p>
        <input type="text" id="txtlrno" maxlength=15><input type="button"
                                                            id="btnaddrow"
                                                            onclick="add_row()"
                                                            value="Add Row"><span
                id="warntext"
                style='margin-left:5px;color:red'></span></td>
                </tr>
              </table>   
<table id="lrdetails" align='center' class="table" >
            <tr  align='center'>
                <th style="height: 25px; width:2%; ">ASSET REQUEST ID</th>
                <th style="height: 25px; width:10%; ">ITEM</th>
                <th  style="width:10%;" >DISCRIPTION</th>
                <th style="width:10%;">QUANTITY</th>
                <th style="width:5%;">UNIT</th>
                <th style="width:5%;">RATE</th>
                <th style="width:5%;">Total</th>
                <th style="width:5%;">DELETE</th>
            </tr>
            <tr>
                <!--<td></td>class='blueTable'
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>-->
            </tr>
        </table>


     <table style=" background-color:#ddd; " class="table" > 
<!--     <tr style="" id="addrow">
        <th style="height: 25px; width:2%; ">SR.NO</th>
        <th style=" width:20%;">ITEM</th>
        <th style=" width:20%;">DISCRIPTION</th>
        
        <th style=" width:10%;">QUANTITY</th>
        <th style=" width:10%;">UNIT</th>
        <th>RATE</th>
        <th>TOTAL</th>
    </tr>
    <tr class="addRowFirst" id='row1' class=m111 height=46 style='mso-height-source:userset;'>
        <td class='m111'><input type='text' name="srno[]"  id="srno[]" size="1" required></td>
        <td class='m111'><input type='text' name="item[]"  id="item[]" size="30"  required></td>
        <td class='m111'><input type='text' name="discription[]"  size="30"   id="discription[]" required></td>
        
        <td class='m111'><input type='text' name="quantity[]"  id="quantity[]"size="2" onkeyup="calamt(this)" required></td>
        <td class='m111'><input type='text' name="unit[]"  id="unit[]" size="1" required></td>
        <td class='m111'><input type='text' name="rate[]"  id="rate[]" size="1" size="2" onkeyup="calamt(this)" required></td>
        <td class='m111'>  <input type='text' name="total13[]"  id="total13[]" size ='2'required readonly></td>
    </tr> -->
    <tr>
        <td colspan="4" style="height:30px">
        AMOUNT IN WORDS:
        <textarea id=word name=word rows="2" cols="40" required readonly></textarea>

        <td colspan="2">TOTAL </td>
        <td>
            <input style=width:70px type=number id=total1 name=total1 min='0' onblur="word.innerHTML=convertNumberToWords(this.value)"  required readonly>
            <!-- <input type='button' onclick="add_row();" value='Add Row'> --> </td>

     </tr>

     <tr>
        <td colspan="4"><b>Terms & Conditions :</b> <input type='button' onclick="add_row1();" value='Add Row'>  </td></td>
        <td colspan="3"style="text-align:center;"><b>For VTC 3PL Services Pvt.Ltd.</b></td>
     </tr>
     <tr id="srow2" class='addRowSecond'>
        <td colspan="4"> 

        <input  class=match style=width:400px  type=text id=terms[] name=terms[] autocomplete='off' onchange="validateCondition()" required><span id="vehtxtter" style="color:red;">
        
     </tr>
     <tr>
        <td colspan="4">
        Payment Terms:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <input type="text" name="pterms" id="pterms" size="68"  >
       </td>

     </tr>

     <tr>
        <td colspan="4">
        Distribution Schedule:
        <input type="text" name="dschedule" id="dschedule" size="68"  >
       </td>

</tr>

<tr>
        <td colspan="4">
        Warranty:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <input type="text" name="Warranty" id="Warranty" size="68"  >
       </td>
       

</tr>
<tr>

    
    <td colspan="4"> Quatation Upload:<input type="file" name="qt[]" id="qt" multiple required ></td>
    
    <td  colspan="3"style="text-align: center;">
        Authorized Signatory
       </td>
</tr>





  
    </table>
    <center> <input type="submit" name="submit" id="submit"> </center> 
     </div>

     </form>
<!--      <p>
        <input type="button" value="Create PDF" 
            id="btPrint" onclick="createPDF()" />
    </p> -->
</div>
</body>
<script type="text/javascript">
    $("#txtlrno").keyup(function (event) {
        if (event.keyCode === 13) {
            add_row();
        }
    });
   
</script>
<script>
    function createPDF() {
        var sTable = document.getElementById('tab').innerHTML;

        var style = "<style>";
        style = style + "table {width: 100;font: 17px Calibri;}";
        style = style + "table, th, td {border: solid 1px black; border-collapse: collapse;";
        style = style + "padding: 2px 3px;text-align: center;}";
        style = style + "</style>";

        // CREATE A WINDOW OBJECT.
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
    }
</script>
</html>
