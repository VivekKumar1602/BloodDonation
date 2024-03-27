<?php
session_start();
include_once('db_connection_short.php');

// Logout logic
if (isset($_POST['logout'])) {
    session_destroy();
    header("Location: login.php"); // Redirect to the login page after logout
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>

    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .container {
            background-color: #ffffff;
            border: 1px solid #ced4da;
            border-radius: 5px;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
            width: 100%; /* Full-width container */
            max-width: 1200px; /* Adjust max-width as needed */
            box-sizing: border-box;
        }

        h2 {
            color: #007bff;
            margin-bottom: 20px;
            position: relative;
            left: 265px;
        }

        .dashboard {
            display: flex;
            justify-content: space-around; /* Adjust spacing */
            margin-bottom: 20px;
        }

        .dashboard-item {
            flex-basis: 45%; /* Adjust width */
            margin-bottom: 20px; /* Adjust spacing */
        }

        .dashboard-item a {
            display: block;
            text-align: center;
            padding: 40px; /* Adjust button size */
            background-color: #007bff;
            color: #fff;
            text-decoration: none;
            border-radius: 10px;
            transition: background-color 0.3s ease;
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }

        .dashboard-item a:hover {
            background-color: #0056b3;
        }

        .dashboard-item a.view-appointments {
            background-image: url('view_appointments_image.jpg');
        }

        .dashboard-item a.certificate-generation {
            background-image: url('certificate_generation_image.jpg');
        }

        .logout-btn {
            background-color: #dc3545;
            color: #fff;
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            position: relative;
            left: 200px;
        }

        .logout-btn:hover {
            background-color: #c82333;
        }
    </style>
</head>

<body>

    <div class="container">
        <?php
        // Fetch admin details based on session
        $admin_id = $_SESSION['admin_id'];
        $admin_sql = "SELECT * FROM admin_users WHERE admin_id = $admin_id";
        $admin_result = $conn->query($admin_sql);

        if ($admin_result->num_rows > 0) {
            $admin_row = $admin_result->fetch_assoc();
            ?>

            <div class="dashboard">
                <h2>Welcome, <?php echo $admin_row['name']; ?></h2>
                <a href="logout.php"><button type="submit" class="logout-btn">Logout</button></a>
            </div>

            <div class="dashboard">
                <div class="dashboard-item">
                    <a href="adminAppointment.php" class="view-appointments">View Appointments</a>
                </div>
                <div class="dashboard-item">
                    <a href="certificateGenerator.php" class="certificate-generation">Certificate Generation</a>
                </div>
            </div>

            <?php
        } else {
            echo "<h2>Error fetching admin details.</h2>";
        }
        ?>
    </div>

</body>

</html>
