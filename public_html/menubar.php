<?php
include'connection.php';


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

/*$_SESSION["Depot"] = "PUNE";*/
$depot = $_SESSION['Depot'];
$ID=$_SESSION['login_user'];
$name=$_SESSION['FullName'];

?>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Sofia">

<style>
#tt {
  font-family: "Sofia", sans-serif;
  font-size: 50px;
  text-shadow: 3px 3px 3px #ababab;
}
nav#t1  {
  position: -webkit-sticky;
  position: sticky;
  top: 0;
 /* background-color:;
  padding: 50px;
  font-size: 20px;*/
}


</style>
<!--Navbar -->
<nav id="t1" class="navbar navbar-expand-sm bg-dark navbar-dark" >
   <!-- <img src="image/LOGO/logistics_logo.jpg"  width="200" height="100" 
            alt="avatar image">-->
  
  <a class="navbar-brand" href="#" id="tt">1 LOGISTIC</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent-555"
    aria-controls="navbarSupportedContent-555" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarSupportedContent-555">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="index.php">Home
          <span class="sr-only">(current)</span>
        </a>
      </li>
     <!-- <li class="nav-item">
        <a class="nav-link" href="#">Features</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Pricing</a>
      </li>-->
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink-555" data-toggle="dropdown"
          aria-haspopup="true" aria-expanded="false">Operation
        </a>
        <div class="dropdown-menu dropdown-secondary" aria-labelledby="navbarDropdownMenuLink-555">
          <a class="dropdown-item" href="bookingmaterial.php">Booking Material</a>
          <a class="dropdown-item" href="bookingarrival.php">Booking Arrival</a>
          <a class="dropdown-item" href="editbookingmaterial.php">Edit Booking</a>
        </div>
      </li>
      
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink-555" data-toggle="dropdown"
          aria-haspopup="true" aria-expanded="false">Reports
        </a>
        <div class="dropdown-menu dropdown-secondary" aria-labelledby="navbarDropdownMenuLink-555">
          <a class="dropdown-item" href="bookingreport.php">Booking Material Report</a>
          
        </div>
      </li>
      
      
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink-555" data-toggle="dropdown"
          aria-haspopup="true" aria-expanded="false">UTILITIES
        </a>
        <div class="dropdown-menu dropdown-secondary" aria-labelledby="navbarDropdownMenuLink-555">
          <a class="dropdown-item" href="bookingmaterial.php">Booking Material</a>
          <a class="dropdown-item" href="bookingarrival.php">Booking Arrival</a>
          <a class="dropdown-item" href="purchaseordernew1.php">Purchase Order</a>
        </div>
      </li>
    </ul>
    <ul class="navbar-nav ml-auto nav-flex-icons">
      <li class="nav-item">
        <a class="nav-link waves-effect waves-light">
            <?php echo $depot; echo"| $ID | $name"; ?>
          <i class="fas fa-envelope"></i>
        </a>
      </li>
      <li class="nav-item avatar dropdown">
        <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink-55" data-toggle="dropdown"
          aria-haspopup="true" aria-expanded="false">
          <!--<img src="https://mdbootstrap.com/img/Photos/Avatars/avatar-2.jpg" class="rounded-circle z-depth-0"
            alt="avatar image">-->
            <img src="image/tusharpic.jpeg" width="50px" height="50px"  class="rounded-circle z-depth-0"
            alt="avatar image">
        </a>
        <div class="dropdown-menu dropdown-menu-lg-right dropdown-secondary"
          aria-labelledby="navbarDropdownMenuLink-55">
          <a class="dropdown-item" href="logout.php">Logout</a>
          <a class="dropdown-item" href="#">Another action</a>
          <a class="dropdown-item" href="#">Something else here</a>
        </div>
      </li>
    </ul>
  </div>
</nav>

<script>

window.onscroll = function() {myFunction()};
/*
var navbar = document.getElementByClass("navbar navbar-expand-sm bg-dark navbar-dark");
var sticky = navbar.offsetTop;

function myFunction() {
  if (window.pageYOffset >= sticky) {
    navbar.classList.add("sticky")
  } else {
    navbar.classList.remove("sticky");
  }
}*/
</script>

