<?php
include "dbconfig/config.php";

if($_SERVER["REQUEST_METHOD"] == "POST"){
    
    $title = $_POST["eventTitle"];
    $eventDescription = $_POST["eventDescription"];
    $datePublication = $_POST["datePublication"];
    $dateEvent = $_POST["dateEvent"];
    $eventPlace =  $_POST["eventPlace"];

    if(isset($_FILES['imageURL']) && $_FILES['imageURL']['error'] === UPLOAD_ERR_OK) {
        $fileName = $_FILES['imageURL']['name'];

        $uploadDirectory = "images/";

        $filePath = $uploadDirectory . $fileName;
        if(move_uploaded_file($_FILES['imageURL']['tmp_name'], $filePath)) {
            echo "<script>console.log('Image uploaded successfully. Path: $filePath')</script>";
        } else {
            // Error moving file
            echo "<script>console.log('Error uploading image.')</script>";
        }
    } else {
        echo "<script>console.log('No image uploaded or error occurred.')</script>";
        exit(); 
    }

    // Concatenate base directory path with filename to get full path
    $imageURL = "images/" . $fileName;

    $query = "INSERT INTO event (image,title,description,datePub,dateEvent,eventPlace) VALUES ('$imageURL','$title','$eventDescription','$datePublication','$dateEvent','$eventPlace')";
    $result=mysqli_query($conn,$query);
    if($result){
        $_SESSION["error"] = "saved";
        header("location: fullEvent.php");
    }else{
        $_SESSION["error"]="failed";
        header("location: fullEvent.php");

    }

} else {
    header("location: fullEvent.php");
}
?>