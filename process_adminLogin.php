<?php

session_start();

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the username and password from the form
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Database connection details
    include_once('db_connection_short.php');

    // user detail array
    $response=array();

    // SQL query to retrieve the hashed password from the database
    $sql = "SELECT * FROM admin_users WHERE username = '$username'";
    $result = $conn->query($sql);

    // Check if there is a matching record
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $hashedPassword = $row['password'];
        // $name = $row['name'];

        // Verify the entered password against the stored hashed password
        if (password_verify($password, $hashedPassword)) {
            // Successful login
            // echo "Login successful! Welcome, $username!";
            $_SESSION['admin_id'] = $row['admin_id'];
            $_SESSION['username'] = $username;
            $_SESSION['name'] = $row['name'];
            // $_SESSION['dob'] = $row['dob'];
            // $_SESSION['gender'] = $row['gender'];
            // $_SESSION['blood_group'] = $row['blood_group'];
            $_SESSION['phone_number'] = $row['phone_number'];
            $_SESSION['email'] = $row['email'];
            $_SESSION['city'] = $row['city'];
            // $_SESSION['age'] = $row['age'];
            header("Location: adminDashboard.php");
            exit();


            // $_SESSION['user_id'] = $row['id']; // You may use the user ID or any unique identifier

            // Data back to JS
            // $response['success'] = true;
            // $response['username'] = $row['username'];
            // $response['profile'] = $row['profile'];




        } else {
            // Invalid credentials
            // echo "Invalid username or password. Please try again.";
            header("Location: popups/failAdminlogin_popup.html");
            exit();
        }
    } else {
        // Username not found
        // echo "Invalid username or password. Please try again.";
        header("Location: popups/failAdminlogin_popup.html");
        exit();
    }

    // Close the database connection
    $conn->close();
} else {
    // Redirect or handle other cases as needed
    echo "Invalid request.";
}

header('Content-Type: application/json');
echo json_encode($response);
?>
