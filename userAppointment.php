<?php
session_start();
include_once('db_connection_short.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Appointments</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 20px;
        }

        h2 {
            color: #333;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        p {
            color: #555;
        }
    </style>
</head>

<body>
    <?php
    // Get user ID from the session
    $user_id = $_SESSION['id'];

    // Retrieve user's appointments with admin names from the database using a JOIN
    $sql = "SELECT a.appointment_id, a.preferredDate, a.preferredTime, u.name, u.city
            FROM appointment a
            JOIN admin_users u ON a.admin_id = u.admin_id
            WHERE a.user_id = '$user_id'";
    $result = $conn->query($sql);
    ?>

    <h2>Your Active Appointments</h2>

    <?php
    // Check if there are appointments
    if ($result->num_rows > 0) {
        // Display appointments in a table
        echo "<table>
                <tr>
                    <th>Appointment ID</th>
                    <th>Hospital Name</th>
                    <th>Preferred Date</th>
                    <th>Preferred Time</th>
                </tr>";

        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>" . $row['appointment_id'] . "</td>
                    <td>" . $row['name'] . ", ". $row['city']. "</td>
                    <td>" . $row['preferredDate'] . "</td>
                    <td>" . $row['preferredTime'] . "</td>
                </tr>";
        }

        echo "</table>";
    } else {
        echo "<p>You have no appointments yet.</p>";
    }

    // Close the database connection
    $conn->close();
    ?>
</body>

</html>
