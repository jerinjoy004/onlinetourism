<?php
if (isset($_GET['query']) && isset($_GET['location'])) {
    $query = htmlspecialchars($_GET['query']);
    $location = htmlspecialchars($_GET['location']);

    // In a real-world scenario, you would query your database here.
    // For demonstration, we'll just echo the search term and location.
    echo "You searched for: " . $query . "<br>";
    if (!empty($location)) {
        echo "Location: " . $location;
    } else {
        echo "Location: Any";
    }
} else {
    echo "No search query provided.";
}
?>
