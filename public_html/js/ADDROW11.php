<!DOCTYPE html>
<html>
<head>
	 <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>VTC</title>


	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

        <!-- jQuery library -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>

        <!-- Latest minified bootstrap js -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

        <script src='js/jquery-1.8.3.min.js'></script>
        <script src="js/jquery-ui.js"></script>
        <script src="script.js"></script>
        <link rel="stylesheet" href="js/jquery-ui.css"/>

        <script type="text/javascript">
        	



            var lastrowid = 1, lastrowend = 1, lastrowd = 1;

            function add_row() {
                
                    
                        lastrowid = lastrowid + 1;
                        
                        var htmltxt = document.getElementById("row1").innerHTML.replace("hasDatepicker", "");
                        htmltxt = htmltxt.replace("date1", "date" + lastrowid);
                        $("#enrexp tr:last").before("<tr id='row" + lastrowid + "'>" + htmltxt + "<td><input type='button' value='DELETE' onclick=delete_row('row" + lastrowid + "','enrexp')></td></tr>");}


                        $(document).ready(function () {

                $("#date").datepicker({dateFormat: "dd-mm-yy", changeMonth: true, changeYear: true});
                      }
        </script>

       

</head>
<body>
<form method="post" action="">  
<div class="table-responsive text-nowrap">
                    <table id='enrexp' border="1" class='table'>
                        <tr style="background-color: #b0d3e8;">
                            <th>Company Name</th>
                            <th>Date</th>
                            <th>Depo</th>
                            <th>Package Type</th>
                            <th>Weight</th>
                            <th>Quantity</th>
                            <th>Rate</th>
                            <th>Amount</th>
                        </tr>
                        <tr id='row1'>
                            
        <td> <input type="text" name="company[]" id="company[]" placeholder="company[]" class="form-control"required></td>
         <td><input type='text' name='d[]' id='d[]' required readonly autocomplete='off'  class="datepick"></td>

       <td><select id="depot[]" name="depot[]" class="form-control">
       <option value='All'>All</option>
		<option value='PNA'>PNA-PUNE</option>
		<option value='NSK'>NSK-NASHIK</option>
		<option value='AKL'>AKL-AKOLA</option>
		<option value='AUR'>AUR-AURANGABAD</option>
		<option value='SHV'>SHV-SHIVARI</option>
		<option value='ISL'>ISL-ISLAMPUR</option>
		<option value='SOL'>SOL-SOLAPUR</option>
		<option value='SGL'>SGL-SANGLI</option>
		<option value='URL'>URL-URULIDEVACHI</option>
		<option value='ANK'>ANK-ANKLESHWAR</option>
		<option value='ASL'>ASL-ASLALI</option>
		<option value='BEL'>BEL-BELLARY</option>
		<option value='BNH'>BNH-BANGLORE</option>
		<option value='BRD'>BRD-BARODA</option>
		<option value='HYD'>HYD-HYDERABAD</option>
		<option value='IND'>IND-INDORE</option>
		<option value='NAG'>NAG-NAGPUR</option>
		<option value='JNPT'>JNPT-NAVA-SHIVA</option>
		<option value='TRI'>TRI-TRICHY</option>
		<option value='OZAR'>OZAR-OZAR</option>
		</select></td>

		<td><select name='package[]' id='package[]' class='form-control' required>
		   <option>BOX</option>
		   <option>BAG</option>
		   <option>DRUM</option>
		   <option>BUCKET</option></select>

        </td>

         <td><input type="number" name="weight[]" id="weight[]"class="form-control" required></td>

      <td><input type="number" name="quantity[]" id="quantity[]" required class="form-control" onchange="dss(this)"> </td>
       
		   		
		   	
	  <td><input type="text" name="rate[]" id="rate[]" required onchange="dss(this)"class="form-control"></td>	
		   
	  <td><input type="number" name="ammount[]" id="ammount[]" required readonly class="form-control"></td>
      
<td></td>
<td><input type='button' onclick="add_row('enrexp');" value='Add Row'></td>
</tr>
</table>
</form>

</body>
</html>