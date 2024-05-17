<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link
    href="https://cdn.jsdelivr.net/npm/remixicon@3.2.0/fonts/remixicon.css"
    rel="stylesheet"
  />
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

 
    <link rel="stylesheet" href="styles/adminArea.css" />
   
    <title>Document</title>
</head>

<?php
    include "dbconfig/config.php";
// Check if the ID parameter is set in the URL
if(isset($_GET['id'])) {
    // Get the event ID from the URL
    $eventId = $_GET['id'];
    $query="SELECT * FROM `event` WHERE id='$eventId'";
    $result=mysqli_query($conn,$query);
    if (mysqli_num_rows($result) == 1){

        $row = mysqli_fetch_assoc($result);
        $imageUrl = $row['image'];
        $title = $row['title'];
        $description = $row['description'];
        $datePub = $row['datePub'];
        $dateEvent = $row['dateEvent'];
        $eventPlace = $row['eventPlace'];
        
        // Convert dates to DateTime objects
$datePubFormatted = (new DateTime($datePub))->format('Y-m-d H:i');
$dateEventFormatted = (new DateTime($dateEvent))->format('Y-m-d H:i');
        // Display
        echo "<div class='fullEvent'>";
        echo "<img src='$imageUrl' alt='' class='eventImage' style='width: 405px;height: 250px;'/>";
        echo "<h2 class=''>$title</h2>";
        echo "<p>Published in: $datePubFormatted</p>";
        
        // echo "<p  >Event Date: $dateEventFormatted</p>";
        echo "<p>Event Place: $eventPlace | $dateEventFormatted</p>";
        echo "<p class=''>$description</p>";

        echo "<a class='btnStyle' href='#' data-toggle='modal' data-target='#exampleModal'>Edit Event</a>";
        echo "<a class='btnStyle' href='delete_event.php?id=$eventId'>Delete Event</a>";
        echo "</div>";
        echo "<hr>";
        
            
        
      
        mysqli_free_result($result);
      
    }else{
      
       echo "Invalid username or password.";
    }

} else {
    echo "id not provided.";
}
?>
<body>
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">edit New Event</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Form to add new event------ -->
                    <form id="eventtForm" method="post" action="update_event.php?id=<?php echo $eventId?>" enctype="multipart/form-data">>
                        <label for="imageURL">Image</label><br>
                        <input type="file" id="imageURL1" name="imageURL" required  value="" ><br>
        
                        <label for="eventTitle">Title:</label><br>
                        <input type="text" id="eventTitle1" name="eventTitle" required value="<?php echo $title ?>"><br>
        
                        <label for="eventDescription">Description:</label><br>
                        <textarea id="eventDescription1" name="eventDescription" rows="4" cols="50"  required ><?php echo $description ?></textarea><br>

                        <label for="datePublication">Date Publication:</label><br>
                        <input type="datetime-local" id="datePublication" name="datePublication" value="<?php echo date('Y-m-d\TH:i', strtotime($datePub)) ?>" required><br>
                        <!-- <script>
                        // Get the current date and time in the format required for datetime-local input
                        var currentDate = new Date().toISOString().slice(0, 16);

                        // Set the value of the datePublication input field to the current date and time
                        document.getElementById("datePublication").value = currentDate;
                        </script> -->
                        <label for="dateEvent">Date Event:</label><br>
                        <input type="datetime-local" id="dateEvent" name="dateEvent" value="<?php echo date('Y-m-d\TH:i', strtotime($dateEvent)) ?>" required><br>

                        <label for="eventPlace">Event Place:</label><br>
                        <input type="text" id="eventPlace" name="eventPlace" value="<?php echo $eventPlace ?>" required><br>


                        <button type="submit" class="btn btn-primary btnStyle">Save</button>
    
                    </form>
                    <!-- end form---------- -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
<!-- Modale End  -->

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>