TRUNCATE TABLE `roles`;
INSERT INTO `roles` (`id`, `name`, `description`) VALUES
(1,'admin', 'Add, remove, and edit users, categories and workouts'),
(2, 'instructor', 'Add, remove, and edit your workouts');


-- --------------------------------------------------------

TRUNCATE TABLE `users`;
INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `password`, `role_id`, `created_at`, `updated_at`) VALUES
(1, 'Marlene', 'Boyce', 'marlenemariaboyce@gmail.com', '$2y$10$azV8RRfkKkDzWHZ8UHFGzeHQB', 1, '2021-09-30 04:14:23', '2021-09-30 04:14:23'),
(2, 'Preston ', 'Boyce', 'jpb3130@gmail.com', '$2y$10$azV8RRfkKkDzWHZ8UHFGzeHQB', 1, '2021-09-30 04:15:42', '2021-09-30 04:15:42'),
(3, 'Colin ', 'Whittington', 'colinwhittington@gmail.com', '$2y$10$azV8RRfkKkDzWHZ8UHFGzeHQB', 2, '2021-09-30 04:16:04', '2021-09-30 04:16:04'),
(4, 'Randy ', 'Karyle', 'randykaryle@gmail.com', '$2y$10$azV8RRfkKkDzWHZ8UHFGzeHQB', 2, '2021-09-30 04:17:20', '2021-09-30 04:17:20'),
(5, 'Maria ', 'Morles', 'mariamorles@gmail.com', '$2y$10$azV8RRfkKkDzWHZ8UHFGzeHQB', 2, '2021-09-30 04:17:20', '2021-09-30 04:17:20');


-- --------------------------------------------------------

TRUNCATE TABLE `categories`;
INSERT INTO `categories` (`id`, `name`) VALUES
(1, 'AMRAP'),
(2, 'For Time'),
(3, 'EMOM'),
(4, 'HERO WODs'),
(5, 'Tabata'),
(6, 'Bootcamp'),
(7, 'Crossfit');


-- --------------------------------------------------------

TRUNCATE TABLE `workouts`;
INSERT INTO `workouts` (`user_id`, `title`, `description`, `equipment`, `image`, `duration`, `video_id`) VALUES 
( 1, 'FRAN', '21-15-9\r\nThrusters\r\nPull Ups', 'barbell\r\npull up bar ', 'https://images.pexels.com/photos/2247179/pexels-photo-2247179.jpeg', 5, 'RGPm3QiA3sI'),
( 2, 'MURPH', '1 mile run\r\n100 pull ups\r\n 200 push ups\r\n300 squats\r\n1 mile run','pull up bar', 'https://images.pexels.com/photos/841130/pexels-photo-841130.jpeg', 12, '8i1ZC7TBa8Y');

-- --------------------------------------------------------


TRUNCATE TABLE `workout_category`;
INSERT INTO `workout_category` (`workout_id`, `category_id`) VALUES
(1, 2),
(1, 7),
(2, 2),
(2, 7);


-- -------------------------------

-- Table structure for table `contact_us`
--

CREATE TABLE `contact_us` (
  `first_name` varchar(32) NOT NULL,
  `last_name` varchar(32) NOT NULL,
  `email` varchar(60) NOT NULL,
  `phone_number` varchar(20) NOT NULL,
  `subject` varchar(60) NOT NULL,
  `message` text NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `contact_us`
--
ALTER TABLE `contact_us`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `contact_us`
--
ALTER TABLE `contact_us`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
