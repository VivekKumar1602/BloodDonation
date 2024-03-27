<?php
// Include database connection code here
// Replace these values with your MySQL database credentials
include_once('db_connection_short.php');

// Create a connection
$conn = new mysqli($servername, $db_username, $db_password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_POST['id'];
    $receivers_name=$_POST['receivers_name'];
    // Fetch user details from the users table based on the provided username
    // ...

    // Generate certificate text (customize as needed)

    // Insert the certificate into the certificates table
    $issue_date = date("Y-m-d");
    $insert_query = "INSERT INTO certificates (user_id, issue_date,receivers_name) 
                     VALUES ('$user_id', '$issue_date','$receivers_name')";

    if ($conn->query($insert_query) === TRUE) {
        // echo "Registration successful!";
        header("Location: popups/success_popup.html");
        exit();
    } 
    else {
        echo "Error: " . $insert_query . "<br>" . $conn->error;
    }
    // Execute the query (add error handling)
    // ...

    // Redirect back to the admin interface or display a success message
    // ...
}
?>
<!-- </html> -->
