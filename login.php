<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
</head>
<body>

<form  action = "login.php" method="post">
        <input type="text" name="email" placeholder="Enter your email">
        <br>
        <input type="text" name="password" placeholder="Enter your password">
        <br>
        <input type="submit" name="button" value="Login"></input>
</form>

</body>
</html>


<?php
//Check if the button is clicked
if (isset($_POST["button"])){
    //User infos
    $loginEmail = $_POST["email"];
    $loginPassword = $_POST["password"];

    $db = mysqli_connect("localhost", "root", "", "online_shop");

    //Get email and password from database
    $sql_email = "SELECT * FROM barber_shop WHERE email = '".mysqli_real_escape_string($db,$loginEmail)."'";
    $sql_password = "SELECT * FROM barber_shop WHERE password = '".mysqli_real_escape_string($db,$loginPassword)."'";
    //Query the database
    $result_email = mysqli_query($db,$sql_email);
    $result_password = mysqli_query($db,$sql_password);
    //Check if there is any duplicates
    $duplicate_email = mysqli_num_rows($result_email);
    $duplicate_password = mysqli_num_rows($result_password);

    //If there are not duplicates index to mainpage
    if ($duplicate_email > 0 && $duplicate_password > 0){
        header('location:mainpage.php');
    }else{
        echo "Email or password not found!!";
    }
}

?>