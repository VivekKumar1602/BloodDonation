<?php
// Replace these values with your MySQL database credentials
include_once('db_connection.php');


// Get the attribute value from the user (e.g., email)
$search_value = $_POST['blood_group']; // Assuming you are using POST method

// SQL query to search for a row based on the attribute
$compatible_blood_groups = getCompatibleBloodGroups($search_value);

// Convert the array to a string for use in the SQL query
$compatible_blood_groups_str = implode("','", $compatible_blood_groups);

// SQL query to search for blood groups that can be accepted
$sql = "SELECT * FROM users WHERE blood_group IN ('$compatible_blood_groups_str')";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table>";
    echo "<tr><th>ID</th><th>Name</th><th>DOB</th><th>Gender</th><th>Blood Group</th><th>Mobile Number</th><th>Email</th><th>City</th></tr>";
    
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["id"] . "</td>";
        echo "<td>" . $row["name"] . "</td>";
        echo "<td>" . $row["dob"] . "</td>";
        echo "<td>" . $row["gender"] . "</td>";
        echo "<td>" . $row["blood_group"] . "</td>";
        echo "<td>" . $row["mobile_number"] . "</td>";
        echo "<td>" . $row["email"] . "</td>";
        echo "<td>" . $row["city"] . "</td>";
        echo "</tr>";
    }

    echo "</table>";
} else {
    echo "No results found for the given attribute.";
}

// Close the database connection
$conn->close();


function getCompatibleBloodGroups($blood_group)
{
    $compatible_blood_groups = array();

    switch ($blood_group) {
        case 'A+':
            $compatible_blood_groups = array('A+', 'O+');
            break;
        case 'A-':
            $compatible_blood_groups = array('A+', 'A-', 'O+', 'O-');
            break;
        case 'B+':
            $compatible_blood_groups = array('B+', 'O+');
            break;
        case 'B-':
            $compatible_blood_groups = array('B+', 'B-', 'O+', 'O-');
            break;
        case 'AB+':
            $compatible_blood_groups = array('A+', 'B+', 'AB+', 'O+');
            break;
        case 'AB-':
            $compatible_blood_groups = array('A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-');
            break;
        case 'O+':
            $compatible_blood_groups = array('O+');
            break;
        case 'O-':
            $compatible_blood_groups = array('O+', 'O-');
            break;
    }

    return $compatible_blood_groups;
}
?>
