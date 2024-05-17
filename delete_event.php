<?php
    include "dbconfig/config.php";
    if(isset($_GET['id'])){
        $eventId = $_GET['id'];
    $query="DELETE FROM event WHERE id='$eventId'";
    // $query="DELETE FROM event WHERE `event`.`id` = 7";
    $result=mysqli_query($conn,$query);
    if($result){
        $_SESSION["error"]="saved";

        echo "<script>alert('event deleted.')</script>";
        
        header("location: fullEvent.php");
    }else{
        $_SESSION["error"]="failed";
        echo "<script>alert('event couldn't be delete.')</script>";
        
        header("location: fullEvent.php");

    }
    }