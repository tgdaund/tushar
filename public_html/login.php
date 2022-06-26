<?php
include("connection.php");
session_start();
$error = "";

if (isset($_SESSION['login_user'])) {
    header("location:index.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    $sql = "SELECT * FROM users WHERE Name = '$username' and Password = '$password' AND ActiveFlag=1";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    $count = mysqli_num_rows($result);

    // If result matched $username and $password, table row must be 1 row

    if ($count == 1) {
        $_SESSION['login_user'] = $username;
        $_SESSION['login_Id'] = $row['id'];
        $_SESSION['UserRole'] = $row['UserRole'];
        $_SESSION['FullName'] = $row['FullName'];
        $_SESSION['PageAccess'] = explode(",", $row["PageAccess"]);
        $_SESSION['Depot'] = $row['Depot'];
        if($row['imageurl'] == "")
            $_SESSION['imageurl'] = "images1/profile.png?1";
        else
            $_SESSION['imageurl'] = $row['imageurl'];

        header("location: index.php");
        //header("location: indexbirthday.php");
    } else {
        $error = "<span style='color:red'> Your Login Name or Password is invalid </span>";
    }
}
?>
<html>

<head>
    
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
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Sofia">
    <title>Login Page</title>

    <style type="text/css">
        fieldset {
            font-family: Verdana;
            border: none;
            border-radius: 10px;
            background-color: aliceblue;
        }

        legend {
            border-radius: 20px;
            background-color: darkgray;
            color: white;
            padding: 5px 20px;
        }

        .btn {
            background-color: cornflowerblue;
            border: 1px solid gray;
            padding: 5px 20px;
            border-radius: 5px;
            color: white;
            line-height: unset;
        }

        input {
            color: #737373;
            border: 1px solid darkgray;
            line-height: 20px;
        }
    </style>

</head>

<body>
<div style="text-align: center;width: 500px;margin: auto;border-radius: 5px;border: 1px solid darkgray;padding: 20px;height: 80%;">
    <br><br> <p class="navbar-brand" href="index.php" id="tt">1 LOGISTIC</p><br><br><br><br>
    <form action="" method="post">
        <fieldset>
            <legend align="middle">Log In</legend>
            <table cellpadding="10" style="color: #555555">
                <tr>
                    <td>UserName</td>
                    <td>:</td>
                    <td><input type="text" name="username" onkeyup="this.value = this.value.toUpperCase();"/></td>
                </tr>
                <tr>
                    <td>Password</td>
                    <td>:</td>
                    <td><input type="password" name="password"/></td>
                </tr>
                <tr>
                    <td colspan="3"><input class="btn" type="submit" value=" Submit "></td>
                </tr>
            </table>
            <?php echo $error; ?> <br/><br/>
        </fieldset>
    </form>
</div>
</body>
</html>