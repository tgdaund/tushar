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
    $d2 = date('d/m/Y', strtotime('+5 days'));

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
<?php //include"menubar.php"; ?>
<body class="formborder" >

<div class="container">
<form method="post" class="form-inline" action="">
    
   
    




<!--
<table class="table">
    <thead>
      <th>Insert Book  </th>
      <th><?php// echo"$d1"; ?></th>
      <th></th>
      <th></th>
      <th></th>
      <th></th>
    </thead>
    <tbody>
      <tr>
        <td>Date </td>
<td><input type="text" name="d1" id="d1" readonly="" class="form-control mb-2 mr-sm-2"  value='<?php echo $d1; ?>' required></td>

        <td>Enter Book  Name </td>
<td><input type="text" name="Bname" id="Bname" placeholder="Enter BOOK  Name " class="form-control mb-2 mr-sm-2" onkeyup="this.value = this.value.toUpperCase();"  required></td>
        
<td>Enter Booking  Register</td>
<td><input type="text" name="breg" id="breg" placeholder="Enter Booking Register " class="form-control mb-2 mr-sm-2" onkeyup="this.value = this.value.toUpperCase();"  required></td>
      </tr>
      
      <tr>
          <td>Author Name </td>
          <td><input type="text" name="Authorname" id="Authorname" placeholder="Author name " class="form-control mb-2 mr-sm-2" onkeyup="this.value = this.value.toUpperCase();"  required></td>
          <td>Edition</td>
          <td><input type="number" id="edition" name="edition" class="form-control mb-2 mr-sm-2" requird></td>
          

    </tbody>
  </table>-->
  <hr>
  <table id='invtab' class='blueTable' border='2' >
            <tr align='center'>
                <th>Booking Register Number</th>
                <th>Book Name </th>
                <th>Author Name </th>
                <th>Author Edition</th>
                <th>Book Type</th>
                <th>Prise </th>
                
            </tr>
            <tr id='row1'>
                <td><input type='text' name='bookreg[]' id='bookreg[]' size=10></td>
               <td><input type='text' id="bookname" name='bookname[]'  size=10
                           ></td> 
              <td><input type='text' id="authorname" name='authorname[]'  size=10
                           ></td> 
                           <td><input type='text' id="edition" name='edition[]'  size=10
                           ></td> 
                           <td><input type='text' id="booktype" name='booktype[]'  size=10
                           ></td> 
                           
          
               
            </tr>
            <tr>
                
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
    /*$bookingdate=$_POST['d1'];
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
    $route=$_POST['route'];*/
    
    //$depot=$_POST['depot'];
/*
    $fromcity=$depot;
    $tocity=$_POST['tocity'];
    $consigneeaddress=$_POST['consigneeaddress'];*/
    
    $bookreg=isset($_POST['bookreg']) ? $_POST['bookreg'] : '';
    $bookname=isset($_POST['bookname']) ? $_POST['bookname'] : '';
     $authorname=isset($_POST['authorname']) ? $_POST['authorname'] : '';
    $edition=isset($_POST['edition']) ? $_POST['edition'] : '';
    $booktype=isset($_POST['booktype']) ? $_POST['booktype'] : '';
    $price=isset($_POST['price']) ? $_POST['price'] : '';
    


                    



   $sql="";
   
       for ($i = 0; $i < count($bookreg); $i++){
         $sql .="INSERT INTO `Books`( `bookname`, `author`, `edition`, `booktype`, `prise`, `bookregnumber`) VALUES VALUES  ('$bookname','$authorname[$i]','$edition[$i]','$booktype[$i]','$price[$i]','$bookreg[$i]');";


echo"$sql";
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