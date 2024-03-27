<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fetch Data by ID</title>

    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            background-color: #ffffff;
            border: 1px solid #ced4da;
            border-radius: 5px;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            color: #007bff;
            margin-bottom: 20px;
        }

        form {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            align-items:center;
            margin:30px;
        }

        .form-group {
            flex-basis: calc(33.33% - 10px);
            margin-bottom: 15px;
        }

        label {
            font-weight: bold;
            display: block;
            margin-bottom: 5px;
        }

        input, select {
            width: 100%;
            padding: 10px;
            box-sizing: border-box;
            border:none;
            border-radius: 4px;
            background-color: #f8f9fa;
        }

        input[type="text"] {
            font-size: 16px;
            color: #495057;
            cursor: not-allowed;
        }

        input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }

        .editableField{
            input, select{
                border: 2px solid #ced4da;
                cursor: text;
            }
        }
    </style>
</head>

<body>

    <div class="container">

        <?php
        include_once('db_connection_short.php');
        $id = $_SESSION['id'];

        // Query to fetch data by ID
        $sql = "SELECT * FROM users WHERE id = $id";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Display form with fetched data
            $row = $result->fetch_assoc();
            ?>

        <h2>Update Panel for ID:
            <?php echo $row['id']; ?>
        </h2>

        <form action="update_process.php" method="post">
            <div class="form-group">
                <label for="id">ID:</label>
                <input type="text" id="id" name="id" value="<?php echo $row['id']; ?>" readonly>
            </div>
            <div class="form-group editableField">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" value="<?php echo $row['name']; ?>">
            </div>

            <div class="form-group editableField">
                <label for="age">DOB:</label>
                <input type="date" id="dob" name="dob" value="<?php echo $row['dob']; ?>">
            </div>

            <div class="form-group">
                <label for="age">Age:</label>
                <input type="text" id="age" name="age" value="<?php echo $row['age']; ?>" readonly>
            </div>

            <div class="form-group editableField">
                <label for="gender">Gender:</label>
                <select name="gender" required>
                    <option value="Male" <?php echo ($row['gender'] === 'Male') ? 'selected' : ''; ?>>Male</option>
                    <option value="Female" <?php echo ($row['gender'] === 'Female') ? 'selected' : ''; ?>>Female</option>
                    <option value="Prefer not to say" <?php echo ($row['gender'] === 'Prefer not to say') ? 'selected' : ''; ?>>Prefer not to say</option>
                </select>
            </div>

            <div class="form-group editableField">
                <label for="blood_group">Blood Group:</label>
                <select name="blood_group" required>
                    <option value="A+" <?php echo ($row['blood_group'] === 'A+') ? 'selected' : ''; ?>>A+</option>
                    <option value="B+" <?php echo ($row['blood_group'] === 'B+') ? 'selected' : ''; ?>>B+</option>
                    <option value="AB+" <?php echo ($row['blood_group'] === 'AB+') ? 'selected' : ''; ?>>AB+</option>
                    <option value="O+" <?php echo ($row['blood_group'] === 'O+') ? 'selected' : ''; ?>>O+</option>
                    <option value="A-" <?php echo ($row['blood_group'] === 'A-') ? 'selected' : ''; ?>>A-</option>
                    <option value="B-" <?php echo ($row['blood_group'] === 'B-') ? 'selected' : ''; ?>>B-</option>
                    <option value="AB-" <?php echo ($row['blood_group'] === 'AB-') ? 'selected' : ''; ?>>AB-</option>
                    <option value="O-" <?php echo ($row['blood_group'] === 'O-') ? 'selected' : ''; ?>>O-</option>
                </select>

            </div>

            <div class="form-group">
                <label for="email">Email:</label>
                <input type="text" id="email" name="email" value="<?php echo $row['email']; ?>" readonly>
            </div>
            
            <div class="form-group editableField">
                <label for="mobile_number">Mobile Number:</label>
                <input type="text" id="mobile_number" name="mobile_number" value="<?php echo $row['mobile_number']; ?>">
            </div>

            <div class="form-group editableField">
                <label for="city">City:</label>
                <input type="text" id="city" name="city" value="<?php echo $row['city']; ?>">
            </div>
            <!-- <div class="form_group"> -->
                <input type="submit" value="Update">
            <!-- </div> -->
        </form>

        <?php
        } else {
            echo "<h2>No data found for ID: $id</h2>";
        }

    $conn->close();
    ?>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        const maxDate = new Date();
        maxDate.setFullYear(maxDate.getFullYear() - 18);
        const formattedMaxDate = maxDate.toISOString().split('T')[0];
        document.getElementById('dob').setAttribute('max', formattedMaxDate);
        
        $(document).ready(function () {
            // Function to calculate age based on DOB
            function calculateAge() {
                var dob = new Date($('#dob').val());
                var today = new Date();
                var age = today.getFullYear() - dob.getFullYear();

                // Adjust age if birthday hasn't occurred yet this year
                if (today.getMonth() < dob.getMonth() || (today.getMonth() === dob.getMonth() && today.getDate() < dob.getDate())) {
                    age--;
                }

                // Set the calculated age to the age input field
                $('#age').val(age);
            }

            // Attach event listener to the DOB input
            $('#dob').change(calculateAge);

            // Initial calculation on page load
            calculateAge();
        });
    </script>

</body>

</html>