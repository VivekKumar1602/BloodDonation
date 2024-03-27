<?php
session_start();
include_once('db_connection_short.php');

// Create a connection
$conn = new mysqli($servername, $db_username, $db_password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Certificates</title>

    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f8f9fa;
            margin: 25px;
            padding: 0;
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            align-items: flex-start;
        }

        .certificate-box {
            background-color: #ffffff;
            border: 1px solid #ced4da;
            border-radius: 18px;
            padding: 25px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.3);
            margin: 10px;
            width: calc(50% - 20px);
            box-sizing: border-box;
            transition: background-color 0.3s ease, color 0.3s ease; /* Add transition for hover effect */
        }

        .certificate-box:hover {
            background-color: #007bff; /* Change background color on hover */
            color: #fff; /* Change text color on hover */
            box-shadow: 0 0 25px rgba(245, 246, 240, 0.5);
            h2{
                color:white;
            }
            button{
                background-color:white;
                color:#007bff
            }
        }

        h2 {
            color: #007bff;
            margin-bottom: 10px;
        }

        p {
            margin-bottom: 10px;
        }

        .view-button {
            background-color: #007bff;
            color: #fff;
            padding: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s ease; /* Add transition for hover effect */
        }
    </style>
</head>
<body>

<?php 
//include_once('db_connection.php');
$user_id=$_SESSION['id'];

// Fetch data from the database
$sql = "SELECT * FROM certificates WHERE user_id=$user_id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        ?>

        <div class="certificate-box">
            <h2>Certificate ID: <?php echo $row['certificate_id']; ?></h2>
            <p>User ID: <?php echo $row['user_id']; ?></p>
            <p>Issue Date: <?php echo $row['issue_date']; ?></p>
            <p>Receiver's Name: <?php echo $row['receivers_name']; ?></p>
            <form id="viewCertificateForm" action="cert.php" method="post">
            <!-- Hidden input field to store receivers_name -->
            <input type="hidden" name="receivers_name" value="<?php echo $row['receivers_name']; ?>">

            <!-- View Certificate button -->
            <button type="submit" class="view-button">View Certificate</button>
            </form>
        </div>

        <?php
    }
} else {
    echo "<p>No certificates found.</p>";
    echo "<br>";
    echo "<button> Book Appointment </button>";
}

$conn->close();
?>

</body>
</html>
