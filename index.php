<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blood Donation</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="animation.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css?family=Merriweather&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Lilita+One&family=Rubik+Bubbles&display=swap" rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Lilita+One&family=Permanent+Marker&family=Rubik+Bubbles&display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Kalam:wght@700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Whisper&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Shizuru&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Kaushan+Script&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@600&family=Poppins&display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Zeyada&display=swap" rel="stylesheet">
    <link rel="icon" href="Images/icon1.png">
</head>

<body>

    <!-- --HEADER-- -->

    <div class="header">
        <div class="heading">
            <img src="Images/icon3.png" alt="" class="logoimg">
            <h1 class="firstText">Blood Donation</h1>
        </div>
        <div class="nav">
            <ul>
                <li class="active"><a href="#">HOME</a></li>
                <li><a href="#">ABOUT</a></li>
                <!-- <li><a href="login.html">LOGIN</a></li> -->
                <?php

                // Check if the user is logged in
                if (isset($_SESSION['username'])) {
                    // Assuming you have a profile picture URL stored in $_SESSION['profile_picture']
                    // $profilePicture = $_SESSION['profile_picture'] ?? '';

                    echo '<li>';
                    echo '<a href="profile.php">';
                    echo 'Welcome! '.$_SESSION['name'];
                    echo '</a>';
                    // echo '<div class="profile-picture-frame">';
                    // echo '<img src="' . $profilePicture . '" alt="Profile Picture" class="profile-picture">';
                    // echo '</div>';
                    echo '</li>';
                    // echo '<li><a href="logout.php">LOGOUT</a></li>';
                } else {
                    echo '<li><a href="login.html">LOGIN</a></li>';
                }
                ?>
            </ul>

        </div>
    </div>
    <hr class="hrhead">

    <!-- --BODY-- -->

    <div class="body">
        <div class="bgImage"></div>
        <div class="bodytext">
            <p class="dhead">Welcome to Our Website, a dedicated platform where compassion meets action. Our mission is
                simple but profound: to save lives through the selfless act of blood donation. In every drop of blood,
                there lies the power to heal, the strength to endure, and the hope for a brighter tomorrow.</p>
            <button class="bodybtn">Be Someone's Hero!!</button>
        </div>
    </div>

    <!-- --DONER SEARCH-- -->

    <section id="searcher">

        <div class="doner">
            <p class="donerP">Your search for a hero starts here. Enter your criteria below and be the lifeline someone
                desperately
                needs. Join the lifesaving mission now!</p>
            <div class="form">
                <form action="searchResult.php" method="post">
                    <div>
                        <span>Blood Group</span>
                        <select name="blood_group" required>
                            <option value="" disabled selected>Select the blood group</option>
                            <option value="A+">A+</option>
                            <option value="B+">B+</option>
                            <option value="AB+">AB+</option>
                            <option value="O+">O+</option>
                            <option value="A-">A-</option>
                            <option value="B-">B-</option>
                            <option value="AB-">AB-</option>
                            <option value="O-">O-</option>
                        </select>
                    </div>
                    <div>
                        <input type="submit" value="Search" class="btn">
                    </div>
                </form>
            </div>
            <div class="SImage"></div>
        </div>
    </section>


    <section id="appoint">

        <div class="appointContainer">
            <div class="AImage"></div>
            <div class="appointbtn">
                <p>Book your blood donation appointment now! Your quick and easy scheduling ensures a seamless process,
                    saving lives efficiently. Join us in the mission of giving the gift of life. <br> <br> Reserve Your
                    Spot Today!</p>
                <a href="appointment.php"><button>Book Appointment</button></a>
                <!-- <a href="#"><button>Book Appointment</button></a> -->
            </div>

        </div>

    </section>

    <!-- --FOOTER-- -->


    <footer class="footer">
        <div class="waves">
            <div class="wave" id="wave1"></div>
            <div class="wave" id="wave2"></div>
            <div class="wave" id="wave3"></div>
            <div class="wave" id="wave4"></div>
        </div>
        <ul class="social-icon">
            <li class="social-icon__item"><a class="social-icon__link" href="https://www.facebook.com/">
                    <ion-icon name="logo-facebook"></ion-icon>
                </a></li>
            <li class="social-icon__item"><a class="social-icon__link" href="https://twitter.com/">
                    <ion-icon name="logo-twitter"></ion-icon>
                </a></li>
            <li class="social-icon__item"><a class="social-icon__link" href="https://www.linkedin.com/">
                    <ion-icon name="logo-linkedin"></ion-icon>
                </a></li>
            <li class="social-icon__item"><a class="social-icon__link" href="https://www.instagram.com/">
                    <ion-icon name="logo-instagram"></ion-icon>
                </a></li>
        </ul>
        <ul class="menu">
            <li class="menu__item"><a class="menu__link" href="">Home</a></li>
            <li class="menu__item"><a class="menu__link" href="#">About</a></li>
            <li class="menu__item"><a class="menu__link" href="#">Services</a></li>
            <li class="menu__item"><a class="menu__link" href="#">Team</a></li>
            <li class="menu__item"><a class="menu__link" href="#">Contact</a></li>

        </ul>
        <p>&copy;2024 Blood Donation | All Rights Reserved</p>
        <div class="sign">
            <svg class='fontawesomesvg' xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512" width="20px"
                fill="#f8f8f8">
                <path
                    d="M192 128c0-17.7 14.3-32 32-32s32 14.3 32 32v7.8c0 27.7-2.4 55.3-7.1 82.5l-84.4 25.3c-40.6 12.2-68.4 49.6-68.4 92v71.9c0 40 32.5 72.5 72.5 72.5c26 0 50-13.9 62.9-36.5l13.9-24.3c26.8-47 46.5-97.7 58.4-150.5l94.4-28.3-12.5 37.5c-3.3 9.8-1.6 20.5 4.4 28.8s15.7 13.3 26 13.3H544c17.7 0 32-14.3 32-32s-14.3-32-32-32H460.4l18-53.9c3.8-11.3 .9-23.8-7.4-32.4s-20.7-11.8-32.2-8.4L316.4 198.1c2.4-20.7 3.6-41.4 3.6-62.3V128c0-53-43-96-96-96s-96 43-96 96v32c0 17.7 14.3 32 32 32s32-14.3 32-32V128zm-9.2 177l49-14.7c-10.4 33.8-24.5 66.4-42.1 97.2l-13.9 24.3c-1.5 2.6-4.3 4.3-7.4 4.3c-4.7 0-8.5-3.8-8.5-8.5V335.6c0-14.1 9.3-26.6 22.8-30.7zM24 368c-13.3 0-24 10.7-24 24s10.7 24 24 24H64.3c-.2-2.8-.3-5.6-.3-8.5V368H24zm592 48c13.3 0 24-10.7 24-24s-10.7-24-24-24H305.9c-6.7 16.3-14.2 32.3-22.3 48H616z" />
            </svg>
            <span>Designed by Vivek Kumar</span>
        </div>
    </footer>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <script src="home.js"></script>

</body>

</html>