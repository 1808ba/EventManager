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
    // // Search form
    // echo "<form method='GET' action='displayEvents.php'>";
    // echo "<input type='text' name='search' placeholder='Search events...' value='".htmlspecialchars($searchTerm, ENT_QUOTES)."'>";
    // echo "<button type='submit'>Search</button>";
    // echo "</form>";

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
        echo "<p>";
        for ($i = 0; $i < 14 && $i < strlen($description); $i++) {
            echo $description[$i];
        }
        echo "...<a href='event.php?id=$id'>Read more</a></p>";
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
