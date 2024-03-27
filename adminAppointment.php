<?php
session_start();
include_once('db_connection_short.php');

// Check if the 'mark as completed' button is clicked
if (isset($_POST['mark_completed'])) {
    $completed_appointment_id = $_POST['appointment_id'];

    // Move appointment to completedAppointment table
    $move_to_completed_sql = "INSERT INTO completedappointment 
    (appointment_id, user_id, admin_id, preferredDate, preferredTime, weight, created_at, completed_at) 
    SELECT appointment_id, user_id, admin_id, preferredDate, preferredTime, weight, created_at, CURRENT_TIMESTAMP
    FROM appointment 
    WHERE appointment_id = $completed_appointment_id";
    $conn->query($move_to_completed_sql);

    // Delete the appointment from the appointment table
    $delete_appointment_sql = "DELETE FROM appointment WHERE appointment_id = $completed_appointment_id";
    $conn->query($delete_appointment_sql);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Appointments</title>

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
            width: 80%;
            max-width: 800px;
        }

        h2 {
            color: #007bff;
            margin-bottom: 20px;
            display:inline-block;
        }

        .appointment-list {
            margin-top: 20px;
        }

        .appointment-item {
            border: 1px solid #ced4da;
            border-radius: 5px;
            margin-bottom: 10px;
            padding: 10px;
            position: relative;
        }

        .mark-completed-btn {
            position: absolute;
            top: 5px;
            right: 5px;
            background-color: #28a745;
            color: #fff;
            padding: 5px 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .home-btn {
            background-color: #dc3545;
            color: #fff;
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            margin:15px
        }

        .home-btn:hover {
            background-color: #c82333;
        }
    </style>
</head>

<body>

    <a href="adminDashboard.php"><button type="submit" class="home-btn">Home</button></a>
    <div class="container">
        <?php
        // Fetch admin details based on session
        $admin_id = $_SESSION['admin_id'];
        $admin_sql = "SELECT * FROM admin_users WHERE admin_id = $admin_id";
        $admin_result = $conn->query($admin_sql);

        if ($admin_result->num_rows > 0) {
            $admin_row = $admin_result->fetch_assoc();
            ?>

            <h2>Appointments at <?php echo $admin_row['name']; ?></h2>

            <div class="appointment-list">
                <?php
                // Fetch appointments for the current admin
                $appointments_sql = "SELECT * FROM appointment WHERE admin_id = $admin_id";
                $appointments_result = $conn->query($appointments_sql);

                if ($appointments_result->num_rows > 0) {
                    while ($appointment_row = $appointments_result->fetch_assoc()) {
                        ?>
                        <div class="appointment-item">
                            <p><strong>User ID:</strong> <?php echo $appointment_row['user_id']; ?></p>
                            <p><strong>Preferred Date:</strong> <?php echo $appointment_row['preferredDate']; ?></p>
                            <p><strong>Preferred Time:</strong> <?php echo $appointment_row['preferredTime']; ?></p>
                            <p><strong>Weight:</strong> <?php echo $appointment_row['weight']; ?></p>
                            <form method="post" action="">
                                <input type="hidden" name="appointment_id" value="<?php echo $appointment_row['appointment_id']; ?>">
                                <button type="submit" class="mark-completed-btn" name="mark_completed">Mark Completed</button>
                            </form>
                        </div>
                        <?php
                    }
                } else {
                    echo "<p>No appointments found.</p>";
                }
                ?>
            </div>

            <?php
        } else {
            echo "<h2>Error fetching admin details.</h2>";
        }
        ?>
    </div>

</body>

</html>
