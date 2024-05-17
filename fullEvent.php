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
<body>
<nav>
        <div class="nav__content">
          <div class="logo"><a href="#">InEvent</a></div>
          <label for="check" class="checkbox">
            <i class="ri-menu-line"></i>
          </label>
          <input type="checkbox" name="check" id="check" />
          <ul>
            <!-- <li><a href="#">Home</a></li> -->
            <!-- Button to trigger modal --> 
            <li><a href="#" data-toggle="modal" data-target="#exampleModal">           
                Add Event
            </a></li>
            <form class="form-inline" method="GET" action="displayEvents.php" style="padding-top: 10px;">
            <input class="form-control mr-sm-2" type="search" name="search" placeholder="Search events..." aria-label="Search" value="<?= htmlspecialchars($searchTerm ?? '', ENT_QUOTES) ?>">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
        </form>
   </div>
            <!-- <li><a href="#">register</a></li>
            <li><a href="#">login</a></li> -->

  
          </ul>
    
        <!-- // Search form -->
  <!-- Search form -->

</nav> 

<!-- Modal -->
   <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div style="background-color: #000;" class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add New Event</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Form to add new event------ -->
                    <form id="eventtForm" method="post" action="addEvent.php" enctype="multipart/form-data">>
                        <label for="imageURL">Image</label><br>
                        <input type="file" id="imageURL1" name="imageURL" required  value="" ><br>
        
                        <label for="eventTitle">Title:</label><br>
                        <input type="text" id="eventTitle1" name="eventTitle" required value=""><br>
        
                        <label for="eventDescription">Description:</label><br>
                        <textarea id="eventDescription1" name="eventDescription" rows="4" cols="50" required ></textarea><br>

                        <label for="datePublication">Date Publication:</label><br>
                        <input type="datetime-local" id="datePublication" name="datePublication" required><br>
                        <script>
                        // Get the current date and time in the format required for datetime-local input
                        var currentDate = new Date().toISOString().slice(0, 16);

                        // Set the value of the datePublication input field to the current date and time
                        document.getElementById("datePublication").value = currentDate;
                        </script>
                        <label for="dateEvent">Date Event:</label><br>
                        <input type="datetime-local" id="dateEvent" name="dateEvent" required><br>

                        <label for="eventPlace">Event Place:</label><br>
                        <input type="text" id="eventPlace" name="eventPlace" required><br>


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

<!-- events -->

<?php
include "displayEvents.php";
?>
  
<!-- end events -->


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>