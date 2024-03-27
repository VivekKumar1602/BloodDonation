<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: login.html");
    exit();
}
include_once('db_connection_short.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blood Donation Appointment</title>
    <style>
        body {
    font-family: 'Arial', sans-serif;
    background-color: #f4f4f4;
    margin: 0;
    padding: 0;
}

h1 {
    text-align: center;
    color: #333;
}

form {
    max-width: 600px;
    margin: 20px auto;
    padding: 20px;
    background-color: #fff;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

label {
    display: block;
    margin-bottom: 8px;
    color: #333;
}

input,
select,
button {
    width: 100%;
    padding: 10px;
    margin-bottom: 15px;
    box-sizing: border-box;
}

button {
    background-color: #4caf50;
    color: #fff;
    padding: 12px;
    cursor: pointer;
    border: none;
    border-radius: 4px;
    font-size: 16px;
}

button:disabled {
    background-color: #ccc;
    cursor: not-allowed;
}

#weightError {
    font-size: 14px;
}

input[type='text']{
    cursor: not-allowed;
}

/* Add more styles as needed */

    </style>
</head>
<body>
    

<h1>Blood Donation Appointment</h1>

<form id="appointmentForm" action="appointmentInsertion.php" method="post">
    <label for="fullName">Full Name:</label>
    <input type="text" id="fullName" name="fullName" value="<?php echo $_SESSION['name'];?>" readonly>

    <label for="dob">Date of Birth:</label>
    <input type="text" id="dob" name="dob" value="<?php echo $_SESSION['dob'];?>" readonly>

    <label for="gender">Gender:</label>
    <input type="text" id="gender" name="gender" value="<?php echo $_SESSION['gender'];?>" readonly>

    <label for="bloodType">Blood Type:</label>
    <input type="text" id="bloodType" name="bloodType" value="<?php echo $_SESSION['blood_group'];?>" readonly>

    <label for="weight">Weight (kg):</label>
    <input type="number" id="weight" name="weight" required>
    <span id="weightError" style="color: red;"></span>

    <label for="preferredDate">Preferred Date:</label>
    <input type="date" id="preferredDate" name="preferredDate" min="<?php echo date('Y-m-d'); ?>" required>

    <label for="preferredTime">Preferred Time:</label>
    <input type="time" id="preferredTime" name="preferredTime" required>

    <label for="location">Preferred Location:</label>

    <select id="location" name="location" required>
        <option value="" disabled selected>---Select---</option>
        <?php
        $sql = "SELECT admin_id,name, city FROM admin_users";
        $result = $conn->query($sql);
        // Loop through all rows in the result set
        while ($row = $result->fetch_assoc()) {
            echo '<option value="' . $row['admin_id'] . '">' . $row['name'] . ', '. $row['city'] . '</option>';
        }
        ?>
    </select>




    <button type="button" onclick="checkEligibility()">Check Eligibility</button>
    <button type="submit" id="submitBtn" disabled>Submit</button>
</form>

<script>
    function checkEligibility() {
        var weight = document.getElementById('weight').value;

        if (weight < 45) {
            document.getElementById('weightError').innerText = 'Not eligible (Weight must be 45 kg or more)';
            document.getElementById('submitBtn').disabled = true;
        } else {
            document.getElementById('weightError').innerText = '';
            document.getElementById('submitBtn').disabled = false;
        }
    }

    document.getElementById('preferredTime').addEventListener('input', function () {
    var selectedTime = this.value;

    // Set the time boundaries
    var startTime = '09:00';
    var endTime = '17:00';

    if (selectedTime < startTime || selectedTime > endTime) {
        alert('Please select a time between 09:00 and 17:00.');
        this.value = ''; // Clear the input value
    } else {
        // Check if the selected time is in the past
        validateTime();
    }
});

document.getElementById('preferredDate').addEventListener('input', validateTime);

function validateTime() {
    var selectedDate = new Date(document.getElementById('preferredDate').value);
    var selectedTime = document.getElementById('preferredTime').value;
    var selectedDateTime = new Date(selectedDate.getFullYear(), selectedDate.getMonth(), selectedDate.getDate(), selectedTime.split(':')[0], selectedTime.split(':')[1]);

    // Get the current date and time
    var currentTime = new Date();

    // If the selected date is today and the selected time is in the past, show an alert
    if (selectedDate.getDate() === currentTime.getDate() &&
        selectedDate.getMonth() === currentTime.getMonth() &&
        selectedDate.getFullYear() === currentTime.getFullYear() &&
        selectedDateTime <= currentTime) {
        alert('Please select a future time.');
        document.getElementById('preferredTime').value = ''; // Clear the input value
    }
}




</script>

</body>
</html>
