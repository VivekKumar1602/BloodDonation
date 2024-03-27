<?php
// Replace with your database connection logic
include_once('db_connection.php');

// Get the username from the AJAX request
$usernameToCheck = $_POST['username'];

// Check if the username exists in the database
$sql = "SELECT * FROM users WHERE username = '$usernameToCheck'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo 'Username already exists!';
} else {
    echo '<p style="color: green;">Username is available!</p>';
}

$conn->close();
?>
