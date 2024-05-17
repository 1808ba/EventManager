
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link
    href="https://cdn.jsdelivr.net/npm/remixicon@3.2.0/fonts/remixicon.css"
    rel="stylesheet"/>
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

 
    <link rel="stylesheet" href="styles/adminArea.css" />
   
    <title>Document</title>
</head>
<body>
<nav>
        <div class="nav__content">
          <div class="logo"><a href="#" style="text-decoration: none;">InEvent</a></div>
          <label for="check" class="checkbox">
            <i class="ri-menu-line"></i>
          </label>
          <input type="checkbox" name="check" id="check" />
          <ul>
          
          
            <form class="form-inline" method="GET" action="user.php" style="padding-top: 10px;">
            <input class="form-control mr-sm-2" type="search" name="search" placeholder="Search events..." aria-label="Search" value="<?= htmlspecialchars($searchTerm ?? '', ENT_QUOTES) ?>">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
        </form>
   </div>
            
  
</ul>
    


</nav> 

<!-- Modal -->
   <div style="background-color: #000;" class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div style="background-color: #000;" class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Join The Event</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div style="background-color: #000;" class="modal-body">
                    <!-- Form to add new event------ -->
                    <form style="background-color: #000;" id="eventtForm" method="post" action="joinEvent.php" enctype="multipart/form-data">>
                     
                        <label for="eventTitle">Your name:</label><br>
                        <input type="text" id="username" name="username" required value=""><br>
        
                        <label for="eventDescription">Email:</label><br>
                        <input type="email" id="email" name="email"  required ></input><br>

                         <script>
                
                        </script>
        
                        <button type="submit" class="btn btn-primary btnStyle" onclick="setJoinedValue()">Join the event</button>
    
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

<!-- events -->

<?php

include "dbconfig/config.php";

// Handle search input
$searchTerm = "";
if(isset($_GET['search'])) {
    $searchTerm = $_GET['search'];
}

// Create the query with a WHERE clause if there is a search term
if(!empty($searchTerm)) {
    $query = "SELECT * FROM event WHERE title LIKE '%$searchTerm%' OR description LIKE '%$searchTerm%' OR eventPlace LIKE '%$searchTerm%'";
} else {
    $query = "SELECT * FROM event";
}

$result = mysqli_query($conn, $query);

if($result){
 

    echo "<div class='eventsSection'>";
    while($row = mysqli_fetch_assoc($result)){
        $id = $row['id'];
        $imageUrl = $row['image'];
        $title = $row['title'];
        $description = $row['description'];
        $datePub = $row['datePub'];
        $dateEvent = $row['dateEvent'];
        $eventPlace = $row['eventPlace'];

        // Convert dates to DateTime objects
        $datePubFormatted = (new DateTime($datePub))->format('Y-m-d H:i');
        $dateEventFormatted = (new DateTime($dateEvent))->format('Y-m-d H:i');

        // Display event details
        echo "<div class='fullEvent'>";
        echo "<img src='$imageUrl' alt='' class='eventImage' style='width: 405px; height: 250px;'/>";
        echo "<h2>$title</h2>";
        echo "<p>Published in: $datePubFormatted</p>";
        
        // echo "<p  >Event Date: $dateEventFormatted</p>";
        echo "<p>Event Place: $eventPlace | $dateEventFormatted</p>";
        echo "<p class='desc' >Event Place: $description</p>";
       
        echo "<a href='#' id='joinedB' class='btnStyle' data-toggle='modal' data-target='#exampleModal'>join</a>";
        echo "</div>";
        echo "<hr>";
    }
    echo "</div>";
    mysqli_free_result($result);
} else {
    echo "Can't get the data";
}

mysqli_close($conn);
?>
  
<!-- end events -->


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
        function setJoinedValue() {
            var joinedLink = document.getElementById('joinedB');
            if (joinedLink) {
                joinedLink.style.display = 'none';
                // Optionally, if you want to change the href attribute as well
                joinedLink.href = '#joined';
            }
        }
    </script>
</body>
</html>