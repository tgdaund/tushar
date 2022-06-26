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

//$_SESSION["Depot"] = "PUNE";
$depot = $_SESSION['Depot'];


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

<!-- Script -->
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>

<!-- jQuery UI -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.css" />
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>

<!-- Bootstrap Css -->
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">

<style>

        div.ui-datepicker {
            font-size: 12px;
        }
        body.inset {border-style: inset;
                   border-width: 5px 20px;
        }
        
        .danger {
  background-color: #ffdddd;
  border-left: 5px solid #f44336;
}

.success {
  background-color: #ddffdd;
  border-left: 5px solid #04AA6D;
}

.info {
  background-color: #e7f3fe;
  border-left: 5px solid #2196F3;
}


.warning {
  background-color: #ffffcc;
  border-left: 5px solid #ffeb3b;
}
body {
  background-image: url('image/indeximages.jpg');
  background-repeat: no-repeat;
  background-attachment: fixed;  
  background-size: cover;
}
  
    
</style>

</head>
<body class="inset">
    <?php include'menubar.php'; ?>
    
    INDEX
</body>
</html>
