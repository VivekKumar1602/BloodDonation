<?php
// Replace these values with your MySQL database credentials
include_once('db_connection.php');

// Get user input from the registration form
$name = $_POST['name'];
$username = $_POST['username'];
$dob = $_POST['dob'];
$gender = $_POST['gender'];
$blood_group = $_POST['blood_group'];
$mobile_number = $_POST['mobile_number'];
$email = $_POST['email'];
$city = $_POST['city'];
$password = $_POST['password'];
$confirm_password = $_POST['confirm_password'];



$error_message = '';

// Hash the password for security
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// Insert user data into the database
$sql = "INSERT INTO users (name, username, dob, gender, blood_group, mobile_number, email, city, password) 
        VALUES ('$name','$username' , '$dob', '$gender', '$blood_group', '$mobile_number', '$email', '$city', '$hashed_password')";
if ($conn->query($sql) === TRUE) {
    // echo "Registration successful!";
    header("Location: popups/success_popup.html");
    exit();
} 
else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}


// Close the database connection
$conn->close();
?>