<?php
    include "dbconfig/config.php";

if($_SERVER["REQUEST_METHOD"] == "POST"){
    // include dbconfig
    // get username and pw
    $username = $_POST["username"] ;
    $password = $_POST["password"];
    
    $query ="SELECT * FROM `admin` WHERE nameAdmin='$username' AND pwAdmin='$password'";
    $result=mysqli_query($conn,$query);
    if (mysqli_num_rows($result) == 1 && $username === "admin"){

        $_SESSION["username"]=$username;
        header("Location: fullEvent.php");
        exit();
      
    }else 
    if (mysqli_num_rows($result) == 1 && $username === "user"){

        $_SESSION["username"]=$username;
        header("Location: user.php");
    }else{
        $_SESSION["error"] = "Invalid username or password.";

    }
}
else{
    header("Location:adminLogin.php");
}


?> 
