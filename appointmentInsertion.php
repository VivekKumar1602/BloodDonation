<?php
session_start();
include_once('db_connection_short.php');

// Get user input from the registration form
$user_id = $_SESSION['id'];
$admin_id = $_POST['location'];
$preferredDate = $_POST['preferredDate'];
$preferredTime = $_POST['preferredTime'];
$weight = $_POST['weight'];


$error_message = '';

// Insert user data into the database
$sql = "INSERT INTO appointment (user_id, admin_id, preferredDate, preferredTime, weight) 
        VALUES ('$user_id','$admin_id' , '$preferredDate', '$preferredTime', '$weight')";
if ($conn->query($sql) === TRUE) {
    // echo "Registration successful!";
    header("Location: popups/app_success_popup.html");
    exit();
} 
else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}


// Close the database connection
$conn->close();
?>