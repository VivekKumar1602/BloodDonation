-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 27, 2024 at 10:17 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `logindetails`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_users`
--

CREATE TABLE `admin_users` (
  `admin_id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `username` varchar(100) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone_number` varchar(20) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_users`
--

INSERT INTO `admin_users` (`admin_id`, `name`, `username`, `email`, `phone_number`, `city`, `password`) VALUES
(1, 'PMCH', 'admin1', 'admin1@hospital.com', '1234567890', 'Patna', '$2y$10$97b4yPk1xECMXIVIsvV9rucu6wpoyFRJTuK5hodlnJyDNGSYuUMda'),
(2, 'NMCH', 'admin2', 'nsklnkls@gmail.com', '', 'Patna', '$2y$10$gjpCWbE59Lc6llFpiFyp7u.ouzhArEpwHuMGGVkWQgdRfihBxnWRO'),
(3, 'bfdkjbils', 'nfnililgse', 'patna.ngp@gmail.com', '654436', 'ndkllgns', '$2y$10$.GCPWhumpZe74vdxYF22qufR45urvQY3xT7H22a3a7yRWr1FSXtS.');

-- --------------------------------------------------------

--
-- Table structure for table `appointment`
--

CREATE TABLE `appointment` (
  `appointment_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `preferredDate` date NOT NULL,
  `preferredTime` time NOT NULL,
  `weight` float NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `appointment`
--

INSERT INTO `appointment` (`appointment_id`, `user_id`, `admin_id`, `preferredDate`, `preferredTime`, `weight`, `created_at`) VALUES
(6, 48, 1, '2024-01-22', '16:48:00', 50, '2024-01-21 12:18:32'),
(7, 1, 1, '2024-01-23', '13:49:00', 55, '2024-01-21 12:19:18'),
(8, 48, 1, '2024-01-24', '16:45:00', 48, '2024-01-22 21:15:10');

-- --------------------------------------------------------

--
-- Table structure for table `certificates`
--

CREATE TABLE `certificates` (
  `certificate_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `issue_date` date DEFAULT NULL,
  `receivers_name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `certificates`
--

INSERT INTO `certificates` (`certificate_id`, `user_id`, `issue_date`, `receivers_name`) VALUES
(11, 48, '2023-12-26', 'Shayam'),
(12, 48, '2023-12-26', 'Ram'),
(13, 48, '2023-12-26', 'Mohan'),
(14, 48, '2023-12-26', 'Rohan'),
(15, 25, '2023-12-28', 'vivek'),
(16, 48, '2024-01-09', 'LLLL'),
(17, 48, '2024-01-09', 'LLLL'),
(18, 1, '2024-01-20', 'knvekf');

-- --------------------------------------------------------

--
-- Table structure for table `completedappointment`
--

CREATE TABLE `completedappointment` (
  `id` int(11) NOT NULL,
  `appointment_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `admin_id` int(11) DEFAULT NULL,
  `preferredDate` date DEFAULT NULL,
  `preferredTime` time DEFAULT NULL,
  `weight` float DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `completed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `completedappointment`
--

INSERT INTO `completedappointment` (`id`, `appointment_id`, `user_id`, `admin_id`, `preferredDate`, `preferredTime`, `weight`, `created_at`, `completed_at`) VALUES
(1, 4, 48, 1, '2024-01-19', '15:16:00', 48, '2024-01-19 07:46:27', '2024-01-20 18:23:35');

-- --------------------------------------------------------

--
-- Table structure for table `requested_admin`
--

CREATE TABLE `requested_admin` (
  `admin_id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `username` varchar(100) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone_number` varchar(20) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `requested_admin`
--

INSERT INTO `requested_admin` (`admin_id`, `name`, `username`, `email`, `phone_number`, `city`, `password`) VALUES
(0, 'NMCH', 'admin3', 'dakiy81117@armablog.com', '6205565634', 'Patna', '$2y$10$nlsbENg0Jnjc8aoCdEno3ehe2acsjrNza9Ejq749/sYsq5a.nssti'),
(0, 'Akhand Jyoti', 'admin4', 'nsklnkls@gmail.com', '6205565634', 'Patna', '$2y$10$xdXOcgUJJQgR.I4FoMiibOax8rEMKAeTWXIS2taZtfUBIRJqNXIK2');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `username` varchar(50) NOT NULL,
  `dob` date NOT NULL,
  `gender` varchar(30) DEFAULT NULL,
  `blood_group` varchar(5) NOT NULL,
  `mobile_number` varchar(15) NOT NULL,
  `email` varchar(255) NOT NULL,
  `city` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `age` int(11) GENERATED ALWAYS AS (timestampdiff(YEAR,`dob`,curdate())) VIRTUAL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `dob`, `gender`, `blood_group`, `mobile_number`, `email`, `city`, `password`) VALUES
(1, 'Akrity Singh', 'ak', '2005-12-12', 'Female', 'A-', '5345646', 'theversion1602@gmail.com', 'khilwat', '$2y$10$3VjLln52qUXeGgbBN7H6WO5BsnIPphL8xxtFYcMltKDzKYJJlNhRO'),
(2, 'John Doe', 'john_doe', '1990-05-15', 'Male', 'A+', '1234567890', 'john.doe@example.com', 'New York', '$2y$10$gSvMF1oJhF2h2i4DVpJ1ZuZsZsSdK8pC1Kw3qNTND.GDFZStEQdNi'),
(3, 'Jane Smith', 'jane_smith', '1985-08-20', 'Female', 'O-', '9876543210', 'jane.smith@example.com', 'Los Angeles', '$2y$10$jvpTyfHCjkBtZGQGKRD6aumvskvTpe5cpqQk7lUouy8OjKg/pcHdK'),
(4, 'Bob Johnson', 'bob_johnson', '1992-03-10', 'Male', 'B-', '8765432109', 'bob.johnson@example.com', 'Chicago', '$2y$10$0NrPcr6.cXhChDkeDlGjXu3rBW8Ek4Oy.6y1LNdIgshji8VCDSpsC'),
(5, 'Emily Davis', 'emily_davis', '1988-11-25', 'Female', 'AB+', '7654321098', 'emily.davis@example.com', 'Houston', '$2y$10$fmbY9DOsLu5tkvd.G9FtmeVgz3sI0v/HVmaJzK/NPO9/Jst9gS3Y2'),
(6, 'Michael Wilson', 'michael_wilson', '1995-06-12', 'Male', 'O+', '6543210987', 'michael.wilson@example.com', 'Phoenix', '$2y$10$1.Ul7dOc8ytAhKSyqsoxEOkjImy.U4TqR8ftfI1aGGup5kYXT4NRu'),
(7, 'Amanda Brown', 'amanda_brown', '1983-09-18', 'Female', 'A-', '5432109876', 'amanda.brown@example.com', 'Philadelphia', '$2y$10$lDFwRfNUvzRXuBpkN/0TOe0wrHX6smwzWp2g9z8cgeD8ZCJ.UZseS'),
(8, 'Chris Miller', 'chris_miller', '1998-02-03', 'Male', 'B+', '4321098765', 'chris.miller@example.com', 'San Antonio', '$2y$10$fXoBzIx6qsH/Ehtu3.E7lucDwn5MN4iC97x.JJoCLPZDjUSQTH3kG'),
(9, 'Jessica Turner', 'jessica_turner', '1980-07-08', 'Female', 'AB-', '3210987654', 'jessica.turner@example.com', 'San Diego', '$2y$10$6bK/GDB/GsSK5.ZmohT4iOOPs3aEbd2DWyF9nbjUccs2t3tpfuHcK'),
(10, 'David Clark', 'david_clark', '1990-12-30', 'Male', 'O-', '2109876543', 'david.clark@example.com', 'Dallas', '$2y$10$FQUZDk7g1ztEEsgckRL2NuT.dmcU7/nT4wNBpRHzD0hr5S61vIj22'),
(11, 'Melissa Hall', 'melissa_hall', '1987-04-22', 'Female', 'B-', '1098765432', 'melissa.hall@example.com', 'Seattle', '$2y$10$OhsCgBXC9L24bB2BdJGq8e/KX8v4rjPNBnE9K6jThOnp9gQmzUZCe'),
(22, 'Sarah Turner', 'sarah_turner', '1993-04-14', 'Female', 'A+', '9876543211', 'sarah.turner@example.com', 'Miami', '$2y$10$NHdnB.FjUpnDLyNqfLxMLuzd4CZQGEG3.v.E/4ZRu5r7EGUbTYdQK'),
(23, 'Daniel White', 'daniel_white', '1982-11-09', 'Male', 'B+', '8765432101', 'daniel.white@example.com', 'Denver', '$2y$10$CoNEnUPEBi2s.BQl0EFKuuw5iPc1N.KDAPb3/KI/j7U8iLwhZXpEK'),
(24, 'Olivia Harris', 'olivia_harris', '1996-07-22', 'Female', 'O-', '7654321090', 'olivia.harris@example.com', 'Atlanta', '$2y$10$n37g1hS/CoZnjeDud9dy4.0pHCzLkwX.gKzHC3GQ1OfwIUvS9.17u'),
(25, 'William Davis', 'william_davis', '1989-01-31', 'Male', 'AB+', '6543210989', 'william.davis@example.com', 'Detroit', '$2y$10$ZVTWq.wBqoQYeNUnzx3o9u4wJeSUUTAeDz1d8WG8zPjYYvZqUbLT2'),
(26, 'Ella Moore', 'ella_moore', '1985-12-18', 'Female', 'A-', '5432109877', 'ella.moore@example.com', 'Minneapolis', '$2y$10$F3QTItwnKSh.DSGOSx6e4.78YCFVxdWZI56X.TglL4fZ3/3O.qK4q'),
(27, 'Christopher Brown', 'christopher_brown', '1991-08-05', 'Male', 'B-', '4321098766', 'christopher.brown@example.com', 'St. Louis', '$2y$10$2RUTRfkwAjotyP.kpRnOseRy5er18HXu3LoY2GcMtVxfgZCBmtYY6'),
(28, 'Sophia Taylor', 'sophia_taylor', '1987-03-27', 'Female', 'O+', '3210987655', 'sophia.taylor@example.com', 'Tampa', '$2y$10$k0QYgtIl8xi1kz3m5T7/zetP/iJ9UvLJZt8eY5KfiTczOnK07xxyW'),
(29, 'Jackson Martinez', 'jackson_martinez', '1994-10-10', 'Male', 'A+', '2109876544', 'jackson.martinez@example.com', 'Raleigh', '$2y$10$XlD/gszN/DZtM.ZGArYpAO4YLyhZLmNFC4RwRnshsz9OpEMaXZgGq'),
(30, 'Ava Adams', 'ava_adams', '1980-05-03', 'Female', 'B+', '1098765433', 'ava.adams@example.com', 'Cleveland', '$2y$10$Y75xTWVgeQHRdMeq7FtOQO9a8A2KbLScPo1SDIkjA3hq9FCW1ze0O'),
(31, 'Gabriel Rodriguez', 'gabriel_rodriguez', '1997-02-18', 'Male', 'AB-', '9876543212', 'gabriel.rodriguez@example.com', 'Indianapolis', '$2y$10$Sj4LDAc4lu0wn7CpvR/wfu0CBmRl9AT/3Vp3t5SfCChKr1iDGrFCe'),
(32, 'Mia Campbell', 'mia_campbell', '1984-09-07', 'Female', 'O-', '8765432102', 'mia.campbell@example.com', 'Kansas City', '$2y$10$3FDmlqQSE6F8vq7U/Q6nK.AOL84X2qSeZgVD/YMcXzTc0zeo4aL7a'),
(33, 'Samuel Evans', 'samuel_evans', '1992-06-24', 'Male', 'A-', '7654321091', 'samuel.evans@example.com', 'Charlotte', '$2y$10$Zi8v3V9lkQOaZml4.eV72.DRrPv5J99lq2I4StnWrgF5ezAM54ElW'),
(34, 'Aria Phillips', 'aria_phillips', '1988-01-14', 'Female', 'B+', '6543210988', 'aria.phillips@example.com', 'San Francisco', '$2y$10$fCqs2zOc5WMMY9/KvDghLO7yf5hKmRjPWUHZubHWhwrgF7slZMS0e'),
(35, 'Liam Nelson', 'liam_nelson', '1995-08-29', 'Male', 'O+', '5432109878', 'liam.nelson@example.com', 'Portland', '$2y$10$VcbRlljWcGWXJV5r3c9ta.EZ5oJfhrBeeImz5UD1EaA8nq/M7hIC2'),
(36, 'Harper Foster', 'harper_foster', '1986-04-02', 'Female', 'A+', '4321098767', 'harper.foster@example.com', 'Orlando', '$2y$10$vM79Dp5oYgVY/QFcpHlf4eZD8U1p9wSLuFGRfz3vVH4kSazRCFN1K'),
(37, 'Grace Powell', 'grace_powell', '1993-03-09', 'Female', 'AB+', '9876543213', 'grace.powell@example.com', 'Houston', '$2y$10$szIyY77obPq1xVmWnxQm2OQdw3bdtGjJZ0RffIDvHy0otA9jVjIWe'),
(38, 'Caleb Simmons', 'caleb_simmons', '1982-12-15', 'Male', 'O-', '8765432103', 'caleb.simmons@example.com', 'Phoenix', '$2y$10$Ays5RsU1mYZmWs8ST8XC0e3Yf7P4SfazDFlkMj0a.cYOh7F9t5l5K'),
(39, 'Aubrey Hayes', 'aubrey_hayes', '1996-06-28', 'Female', 'B+', '7654321092', 'aubrey.hayes@example.com', 'Dallas', '$2y$10$Sk/MynGbb6sUSwpVCbhQCOUVUs/AkKAsdhtQ2kiTVSZ9Uc.DnmkVC'),
(40, 'Isaac Ward', 'isaac_ward', '1989-02-04', 'Male', 'A-', '6543210987', 'isaac.ward@example.com', 'San Diego', '$2y$10$KTRBz2NrQjg1fUkNq8IjvewWWQFHXWgOpblq8uRHpUW0Xf0iaX7Fq'),
(41, 'Stella Ford', 'stella_ford', '1985-10-19', 'Female', 'O+', '5432109879', 'stella.ford@example.com', 'Chicago', '$2y$10$j4ezYdshFpK4.A1ZcX/U..eylmW2OBikNvfxlcH4SEsqYDLcG8rdi'),
(42, 'Elijah Olson', 'elijah_olson', '1991-05-05', 'Male', 'AB+', '4321098768', 'elijah.olson@example.com', 'Atlanta', '$2y$10$KEm6dRGlmLKn/OErQqETiePIRYYzgoOZ1NkCn4FipZKgfqDs9XRDu'),
(43, 'Natalie Daniels', 'natalie_daniels', '1987-11-30', 'Female', 'A-', '3210987657', 'natalie.daniels@example.com', 'Seattle', '$2y$10$Qf4wQjX/ezF/W1fRsgNDPeydRTzYjL0m9eg.XyXXIMRR9H5z6wJk2'),
(44, 'Jameson Ramirez', 'jameson_ramirez', '1994-08-14', 'Male', 'O+', '2109876545', 'jameson.ramirez@example.com', 'Los Angeles', '$2y$10$FSywnZs4fuGpYN2p9OLBvOohVhq1RKivhA9mY/APO3KxJgH86Knuy'),
(45, 'Avery Mason', 'avery_mason', '1983-03-23', 'Female', 'B-', '1098765434', 'avery.mason@example.com', 'Miami', '$2y$10$kqCQf.mg9FgFf4akqM1VZeqVE4NvklfMo7w3H0.VuG8CtOjEOqjLO'),
(46, 'Logan Hayes', 'logan_hayes', '1998-01-07', 'Male', 'AB-', '9876543214', 'logan.hayes@example.com', 'New York', '$2y$10$RqFz/w5j4i7IUZImnXSYG.Xa7J0YRJvgLg4KGo6xvjFnR7jgPl.m2'),
(48, 'Vivek Kumar', 'vk', '2004-02-16', 'Male', 'B+', '6205565634', 'theversion160258@gmail.com', 'Patna', '$2y$10$97b4yPk1xECMXIVIsvV9rucu6wpoyFRJTuK5hodlnJyDNGSYuUMda');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_users`
--
ALTER TABLE `admin_users`
  ADD PRIMARY KEY (`admin_id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `appointment`
--
ALTER TABLE `appointment`
  ADD PRIMARY KEY (`appointment_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `admin_id` (`admin_id`);

--
-- Indexes for table `certificates`
--
ALTER TABLE `certificates`
  ADD PRIMARY KEY (`certificate_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `completedappointment`
--
ALTER TABLE `completedappointment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `admin_id` (`admin_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_users`
--
ALTER TABLE `admin_users`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `appointment`
--
ALTER TABLE `appointment`
  MODIFY `appointment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `certificates`
--
ALTER TABLE `certificates`
  MODIFY `certificate_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `completedappointment`
--
ALTER TABLE `completedappointment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `appointment`
--
ALTER TABLE `appointment`
  ADD CONSTRAINT `appointment_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `appointment_ibfk_2` FOREIGN KEY (`admin_id`) REFERENCES `admin_users` (`admin_id`);

--
-- Constraints for table `certificates`
--
ALTER TABLE `certificates`
  ADD CONSTRAINT `certificates_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `completedappointment`
--
ALTER TABLE `completedappointment`
  ADD CONSTRAINT `completedappointment_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `completedappointment_ibfk_2` FOREIGN KEY (`admin_id`) REFERENCES `admin_users` (`admin_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
