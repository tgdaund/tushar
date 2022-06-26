<!DOCTYPE html>
<html>
<head>
<style>

</style>
</head>
<body>

<?php
include'connection.php';
$q = $_GET['q'];


if (!$conn) {
  die('Could not connect: ' . mysqli_error($conn));
}

$sql="SELECT `CityNameEng` FROM `India` WHERE `RouteNo` = '".$q."' group by `CityNameEng`";

//$sql="SELECT `city` FROM `india` WHERE `route` = '".$q."' group by city";
$result = mysqli_query($conn,$sql);


while($row = mysqli_fetch_array($result)) {
  $tocity= $row['CityNameEng'];
  //echo"<option value=''> SELECT</option>";
  echo"<option value='$tocity'> $tocity</option>";
  
}

mysqli_close($con);
?>
</body>
</html>