<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Results</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 20px;
        }

        .back{
            display: block;
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .back:hover {
            background-color: #45a049;
        }

        h2 {
            color: #333;
        }

        table {
            border-collapse: collapse;
            width: 100%;
            margin-top: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        .print {
            display: block;
            margin: 20px auto; /* Center the button */
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .print:hover {
            background-color: #45a049;
        }
    </style>
    <script src="https://rawgit.com/eKoopmans/html2pdf/master/dist/html2pdf.bundle.js"></script>
</head>

<body>

<button class="back" onclick="redirectToPage()">&#8592</button>

    <h2>Search Results</h2>

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
    echo "<table id='resultTable'>";
    echo "<tr><th>ID</th><th>Name</th><th>Age</th><th>Gender</th><th>Blood Group</th><th>Mobile Number</th><th>Email</th><th>City</th></tr>";
    
    $rowNumber =1;

    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $rowNumber . "</td>";
        echo "<td>" . $row["name"] . "</td>";
        echo "<td>" . $row["age"] . "</td>";
        echo "<td>" . $row["gender"] . "</td>";
        echo "<td>" . $row["blood_group"] . "</td>";
        echo "<td>" . $row["mobile_number"] . "</td>";
        echo "<td>" . $row["email"] . "</td>";
        echo "<td>" . $row["city"] . "</td>";
        echo "</tr>";

        $rowNumber++;
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
        case 'A-':
            $compatible_blood_groups = array('A-', 'O-');
            break;
        case 'A+':
            $compatible_blood_groups = array('A+', 'A-', 'O+', 'O-');
            break;
        case 'B-':
            $compatible_blood_groups = array('B-', 'O-');
            break;
        case 'B+':
            $compatible_blood_groups = array('B+', 'B-', 'O+', 'O-');
            break;
        case 'AB-':
            $compatible_blood_groups = array('A-', 'B-', 'AB-', 'O-');
            break;
        case 'AB+':
            $compatible_blood_groups = array('A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-');
            break;
        case 'O-':
            $compatible_blood_groups = array('O-');
            break;
        case 'O+':
            $compatible_blood_groups = array('O+', 'O-');
            break;
    }

    return $compatible_blood_groups;
}
?>


<button class="print" onclick="exportToPDF()">Print as PDF</button>

    <script>
        function exportToPDF() {
            const element = document.getElementById('resultTable'); // Assuming your table has an ID 'resultTable'

            const options = {
                margin: 10,
                filename: 'search_results.pdf',
                image: { type: 'jpeg', quality: 1 },
                html2canvas: { scale: 2 },
                jsPDF: { unit: 'mm', format: 'a4', orientation: 'landscape' } // Set orientation to 'landscape'
            };
            
            html2pdf(element, options);
        }

        function redirectToPage() {
            window.location.href = 'index.php#searcher';
        }
    </script>


</body>

</html>
