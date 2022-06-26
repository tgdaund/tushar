<?php
session_start();
/*if(!isset($_SESSION['login_user'])){
      header("location:login.php");
    }*/
include("connection.php");


$userdepot = $_SESSION['Depot'];
$searchTerm = $_GET['term'];
$data = array(); 
$sql="SELECT `BookingNumber` FROM Booking_Materials WHERE `BookingNumber` LIKE'%$searchTerm%' LIMIT 0,10";

$result = mysqli_query($conn,$sql);
while($row = mysqli_fetch_assoc($result))
{
    
    
 $data[] = $row['BookingNumber'];
 
}
//return json data
//echo"<script>alert('heelo booingnumber');</script>";
echo json_encode($data);
//print_r($data);
?>