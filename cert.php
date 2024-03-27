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
    <style type='text/css'>
        body, html {
            margin: 0;
            padding: 0;
        }
        body {
            color: black;
            display: table;
            font-family: Georgia, serif;
            font-size: 24px;
            text-align: center;
        }
        .container {
            border: 20px solid tan;
            width: 750px;
            height: 563px;
            display: table-cell;
            vertical-align: middle;
        }
        .logo {
            color: tan;
        }

        .marquee {
            color: tan;
            font-size: 48px;
            margin: 20px;
        }
        .assignment {
            margin: 20px;
        }
        .person {
            border-bottom: 2px solid black;
            font-size: 32px;
            font-style: italic;
            margin: 20px auto;
            width: 400px;
        }
        .reason {
            margin: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="logo">
            An Organization
        </div>

        <div class="marquee">
            Certificate of Completion
        </div>

        <div class="assignment">
            This certificate is presented to
        </div>

        <?php

            if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["receivers_name"])) {
                $receivers_name = $_POST["receivers_name"];
                echo '<div class="person">' . $_SESSION['name'] . '</div>';
                echo 'Receiver\'s Name : ' .$receivers_name;

            } 
            else {
                 echo "Invalid request";
            }
        
        ?>

        <div class="reason">
            For saving a Life<br/>
            !!You are Someones's Hero!!
        </div>
    </div>
</body>
</html>
