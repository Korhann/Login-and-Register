<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register page</title>
</head>
<body>
    
    <form  action = "index.php" method="post">
        <input type="text" name="first" placeholder="Enter your name">
        <br>
        <input type="text" name="email" placeholder="Enter your email">
        <br>
        <input type="text" name="password" placeholder="Enter your password">
        <br>
        <input type="text" name="repassword" placeholder="Confirm password">
        <br>
        <input type="submit" name="button" value="Register"></input>
        <br>
    </form>
    
</body> 
</html>

<?php

function connect_database(){
    //Check if the button is clicked
    if (isset($_POST["button"])){
        //User infos
        $dbemail = $_POST["email"];
        $dbusername = $_POST["first"];
        $dbpassword = $_POST["password"];
        $dbrepassword = $_POST["repassword"];

        if (!filter_var($dbemail,FILTER_VALIDATE_EMAIL)){
            echo "Invalid email!!";
        }elseif(empty($dbemail) || empty($dbusername) || empty($dbpassword)){
            echo "Empty email , username or password!!";
        }else{
            //Connect the db
            $conn = mysqli_connect("localhost", "root", "", "online_shop");
            //Run a query on username and email
            $sqli_username = ("SELECT * FROM barber_shop WHERE name = '$dbusername'");
            $sqli_email = ("SELECT * FROM barber_shop WHERE email = '$dbemail'");
            //Connect the query to database
            $result_username = mysqli_query($conn,$sqli_username);
            $result_email = mysqli_query($conn,$sqli_email);
            //Check if there is duplicate email or username
            $duplicate_username = mysqli_num_rows($result_username);
            $duplicate_email = mysqli_num_rows($result_email);
            //If there is duplicate echo
            if ($duplicate_username > 0 || $duplicate_email > 0){
                echo "Username or email is already taken";
            }if ($dbpassword !== $dbrepassword){
                echo "Password and repassword should match!!";
            }else{
                // If there is no duplicate check the connection
                if (!$conn) {
                    die("Connection failed: " . mysqli_connect_error());
                }
                //Insert data to database
                $sql = "INSERT INTO barber_shop (name,email,password) VALUES ('$dbusername','$dbemail','$dbpassword')";
                if (mysqli_query($conn, $sql)) {
                    echo "Data inserted";
                    header('location:login.php');
                }else {
                    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                }
                mysqli_close($conn);
            }
        }
    }
}
connect_database();

?>




 
