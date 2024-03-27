<?php
session_start();
include_once('db_connection_short.php');

// Check if the user is logged in as an admin
if (!isset($_SESSION['superAdmin'])) {
    header("Location: superAdminLogin.php"); // Redirect to login page if not logged in
    exit();
}

// Handle admin approval logic
if (isset($_GET['approve_admin'])) {
    $adminId = $_GET['approve_admin'];

    // Fetch admin data from admin_users table
    $sql = "SELECT * FROM requested_admin WHERE admin_id = $adminId";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $adminData = $result->fetch_assoc();

        // Insert into approved_admin_users table
        $approveSql = "INSERT INTO admin_users (name, username, email, phone_number, city, password)
                        VALUES ('{$adminData['name']}', '{$adminData['username']}', '{$adminData['email']}',
                                '{$adminData['phone_number']}', '{$adminData['city']}', '{$adminData['password']}')";
        $conn->query($approveSql);

        // Delete from admin_users table
        $deleteSql = "DELETE FROM requested_admin WHERE admin_id = $adminId";
        $conn->query($deleteSql);

        echo "Admin user approved successfully.";
    } else {
        echo "Invalid admin user ID.";
    }
}

if (isset($_GET['reject_admin'])) {
    $adminId = $_GET['reject_admin'];

    // Fetch admin data from admin_users table
    $sql = "SELECT * FROM requested_admin WHERE admin_id = $adminId";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $adminData = $result->fetch_assoc();

        // Delete from admin_users table
        $deleteSql = "DELETE FROM requested_admin WHERE admin_id = $adminId";
        $conn->query($deleteSql);

        echo "Admin user rejected successfully.";
    } else {
        echo "Invalid admin user ID.";
    }
}

// Fetch data from the admin_users table
$sql = "SELECT * FROM requested_admin";
$result = $conn->query($sql);

// Check if data is available
if ($result->num_rows > 0) {
    // Display the data in a table
    ?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Admin Approval Page</title>
        <style>
            table {
                border-collapse: collapse;
                width: 100%;
            }

            th, td {
                border: 1px solid #ddd;
                padding: 8px;
                text-align: left;
            }

            th {
                background-color: #f2f2f2;
            }

            .approve-btn {
                background-color: #28a745;
                color: #fff;
                padding: 8px;
                border: none;
                border-radius: 5px;
                cursor: pointer;
            }

            .approve-btn:hover {
                background-color: #218838;
            }

            .reject-btn {
                background-color: red;
                color: #fff;
                padding: 8px;
                border: none;
                border-radius: 5px;
                cursor: pointer;
            }

            .reject-btn:hover {
                background-color: pink;
            }

            .logout-btn {
                background-color: #dc3545;
                color: #fff;
                padding: 10px;
                border: none;
                border-radius: 5px;
                cursor: pointer;
                transition: background-color 0.3s ease;
                /* position: relative;
                left: 200px; */
            }

            .logout-btn:hover {
                background-color: #c82333;
            }
        </style>
    </head>

    <body>
        <a href="superAdminLogout.php"><button type="submit" class="logout-btn">Logout</button></a>
        <h2>Admin Users Approval</h2>
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Phone Number</th>
                    <th>City</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Display data in table rows
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>{$row['name']}</td>";
                    echo "<td>{$row['username']}</td>";
                    echo "<td>{$row['email']}</td>";
                    echo "<td>{$row['phone_number']}</td>";
                    echo "<td>{$row['city']}</td>";
                    echo "<td><button class='approve-btn' onclick='approveAdmin({$row['admin_id']})'>Approve as Admin</button>
                    <button class='reject-btn' onclick='rejectAdmin({$row['admin_id']})'>Reject Admin</button></td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>

        <script>
            // JavaScript function to handle admin approval
            function approveAdmin(adminId) {
                if (confirm("Are you sure you want to approve this user as admin?")) {
                    // Redirect to handle approval
                    window.location.href = "superAdmin.php?approve_admin=" + adminId;
                }
            }

            function rejectAdmin(adminId) {
                if (confirm("Are you sure you want to reject this user as admin?")) {
                    // Redirect to handle approval
                    window.location.href = "superAdmin.php?reject_admin=" + adminId;
                }
            }
        </script>
    </body>

    </html>
<?php
} else {
    
    echo "No admin users to approve.";
    
    echo "<a href='superAdminLogout.php'>
    <button type='submit' style='
    background-color: #dc3545;
    color: #fff;
    padding: 10px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s ease;
    '>Logout</button>
    </a>";
}

$conn->close();
?>
