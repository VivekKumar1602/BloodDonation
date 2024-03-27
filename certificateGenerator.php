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
            padding: 0 25px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            display:flex;
            flex-direction:column;
            align-items:center;
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
            margin:25px;
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

        input {
            width: 100%;
            padding: 10px;
            box-sizing: border-box;
            border: none;
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
            width:50%;
            margin:0 25%;
            
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }

        .activeField{
            input{
                border: 2px solid #ced4da;
                cursor: text;
            }
        }

        .fetch{
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            align-items:center;
            margin:auto;
        }

        .home-btn {
            background-color: #dc3545;
            color: #fff;
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            margin:10px;
        }

        .home-btn:hover {
            background-color: #c82333;
        }
    </style>
</head>
<body>

    <div class="container">
        
        <a href="adminDashboard.php"><button type="submit" class="home-btn">Home</button></a>
        <?php
    // Replace these values with your actual database credentials
    include_once('db_connection_short.php');
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $id = $_POST['id'];
        
        // Query to fetch data by ID
        $sql = "SELECT * FROM users WHERE id = $id";
        $result = $conn->query($sql);
        
        if ($result->num_rows > 0) {
            // Display form with fetched data
            $row = $result->fetch_assoc();
            ?>

            <h2>Data for ID: <?php echo $row['id']; ?></h2>

            <form action="certInsertion.php" method="post">
                <div class="form-group">
                    <label for="id">ID:</label>
                    <input type="text" id="id" name="id" value="<?php echo $row['id']; ?>" readonly>
                </div>
                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" id="name" name="name" value="<?php echo $row['name']; ?>" readonly>
                </div>

                <div class="form-group">
                    <label for="age">Age:</label>
                    <input type="text" id="age" name="age" value="<?php echo $row['age']; ?>" readonly>
                </div>

                <div class="form-group">
                    <label for="gender">Gender:</label>
                    <input type="text" id="gender" name="gender" value="<?php echo $row['gender']; ?>" readonly>
                </div>

                <div class="form-group">
                    <label for="blood_group">Blood Group:</label>
                    <input type="text" id="blood_group" name="blood_group" value="<?php echo $row['blood_group']; ?>" readonly>
                </div>

                <div class="form-group">
                    <label for="dob">DOB:</label>
                    <input type="text" id="dob" name="dob" value="<?php echo $row['dob']; ?>" readonly>
                </div>

                <div class="form-group">
                    <label for="mobile_number">Mobile Number:</label>
                    <input type="text" id="mobile_number" name="mobile_number" value="<?php echo $row['mobile_number']; ?>" readonly>
                </div>

                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="text" id="email" name="email" value="<?php echo $row['email']; ?>" readonly>
                </div>

                <div class="form-group">
                    <label for="city">City:</label>
                    <input type="text" id="city" name="city" value="<?php echo $row['city']; ?>" readonly>
                </div>
                
                <div class="form-group activeField">
                    <label for="receivers_name">Reciever's Name:</label>
                    <input type="text" id="receivers_name" name="receivers_name" required>
                </div>
                <!-- <div class="form_group"> -->
                    <input type="submit" value="Generate Certificate">
                <!-- </div> -->
            </form>
            <br>

            <?php
        } else {
            echo "<h2>No data found for ID: $id</h2>";
        }
    }

    $conn->close();
    ?>

    <form action="" method="post">

        <div class="fetch activeField">

            <label for="id">Enter ID:</label>
            <input type="text" id="id" name="id" required>
            <input type="submit" value="Fetch Data">
        </div>
    </form>
</div>

</body>
</html>
