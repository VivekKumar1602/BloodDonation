<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the username and password from the form

    // Database connection details
    $servername = "localhost";
    $db_username = "root";
    $db_password = "";
    $dbname = "loginDetails";

    // Create a connection
    $conn = new mysqli($servername, $db_username, $db_password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
}
?>