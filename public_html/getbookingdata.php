<?php

session_start();
/*if(!isset($_SESSION['login_user'])){
    header("location:login.php");
}*/

include("connection.php");
$userdepot = $_SESSION['Depot'];


if($bookingid = $_POST['bookingid']){
    $sql="SELECT `BookingNumber`,`Bdate`,`Payemnt_type`,`Fromcity`,`Tocity`,`Totalpackages`,`Actualweight` FROM `Booking_Materials` WHERE `BookingNumber`='$bookingid' ";
    
$result=mysqli_query($conn,$sql);

while($row = mysqli_fetch_assoc($result)){
	

/*	echo"<tr>
    <td class='m111'><input type='hidden' name='bookingid[]'  id='bookingid[]'  value= readonly required> '" . $row["BookingNumber"] . "'</td>
        <td class='m111'><input type='text' name='bookingdate[]'  id='bookingdate[]'   value='" . $row["Bdate"] . "' readonly required></td>
        <td class='m111'><input type='text' name='Payemnt_type[]'     id='Payemnt_type[]' value='" . $row["Payemnt_type"] . "' readonly required></td>
        <td class='m111'><input type='text' name='Fromcity[]'  id='Fromcity[]'  onkeyup='calamt(this)' value='" . $row["Fromcity"] . "' readonly required></td>
        <td class='m111'><input type='text' name='Tocity[]'  id='Tocity[]''  value='" . $row["Tocity"] . "' readonly required></td>
        <td style='width:5%;' class='m111'><input type='number' name='Totalpackages[]'  id='Totalpackages[]'  onkeyup='calamt(this)'  min='0' value='" . $row["Totalpackages"] . "' autocomplete='off' required></td>
        <td  class='m111'><input type='number' name='Actualweight[]'  id='Actualweight[]'  value='" . $row["Actualweight"] . "'  min='0'  readonly required></td>

         <td class='m111' > <input type='button' class='btnDelete' value='DELETE'>              </td>
        </tr>";	*/
        
        echo"<tr>
    <td class='m111'><input type='text' name='bookingid[]'  id='bookingid[]'  value=" . $row["BookingNumber"] . " readonly required> </td>
        <td class='m111'><input type='hidden' name='bookingdate[]'  id='bookingdate[]' value=" . $row["Bdate"] . "   readonly required>" . $row["Bdate"] . "</td>
        
        <td class='m111'><input type='hidden' name='Payemnt_type[]'     id='Payemnt_type[]' value=" . $row["Payemnt_type"] . " readonly required>" . $row["Payemnt_type"] . "</td>
        
        <td class='m111'><input type='hidden' name='Fromcity[]'  id='Fromcity[]'  onkeyup='calamt(this)' value=" . $row["Fromcity"] . " readonly required>" . $row["Fromcity"] . "</td>
        <td class='m111'><input type='hidden' name='Tocity[]'  id='Tocity[]'  value=" . $row["Tocity"] . " readonly required>" . $row["Tocity"] . "</td>
        <td style='width:5%;' class='m111'><input type='hidden' name='Totalpackages[]'  id='Totalpackages[]'  onkeyup='calamt(this)'  min='0' value=" . $row["Totalpackages"] . " autocomplete='off' required>" . $row["Totalpackages"] . "</td>
        <td  class='m111'><input type='hidden' name='Actualweight[]'  id='Actualweight[]'  value=" . $row["Actualweight"] . "  min='0'  readonly required>" . $row["Actualweight"] . "</td>

         <td class='m111' > <input type='button' class='btnDelete' value='DELETE'>              </td>
        </tr>";
        
       
    }
}
else
	echo "No Data."; 
mysqli_close($conn);
?>