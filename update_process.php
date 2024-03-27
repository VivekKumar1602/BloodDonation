<?php
// Include your database connection
include_once('db_connection_short.php');

// Get user input from the edit form
$user_id=$_POST['id'];
$name = $_POST['name'];
$dob = $_POST['dob'];
$age = $_POST['age'];
$gender = $_POST['gender'];
$blood_group = $_POST['blood_group'];
$mobile_number = $_POST['mobile_number'];
$city = $_POST['city'];
// Include other fields as needed

// Update user data in the database
$sql = "UPDATE users SET
        name = '$name',
        dob = '$dob',
        age = '$age',
        gender = '$gender',
        blood_group = '$blood_group',
        mobile_number = '$mobile_number',
        city = '$city'
        WHERE id = '$user_id'";

if ($conn->query($sql) === TRUE) {
    header("Location: login.html");

    exit();
} else {
    echo "Error updating record: " . $conn->error;
}

// Close the database connection
$conn->close();
?>