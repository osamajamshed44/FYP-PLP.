-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 31, 2023 at 04:27 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `finalyearproject`
--

-- --------------------------------------------------------

--
-- Table structure for table `alumni`
--

CREATE TABLE `alumni` (
  `alumni_id` int(50) NOT NULL,
  `fullname` text NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(72) NOT NULL,
  `department` varchar(50) NOT NULL,
  `Batch Year` year(4) NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp(),
  `gender` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `alumni`
--

INSERT INTO `alumni` (`alumni_id`, `fullname`, `email`, `password`, `department`, `Batch Year`, `date`, `gender`) VALUES
(1, 'admin', 'admin@gmail.com', 'admin123', 'Computer Science', '2020', '2023-08-29 01:12:46', 'male'),
(2, 'Osama Jamshed', 'osamajamshed@gmail.com', '$2y$10$H500z8beGeAb990IEdGLseDxCPfE8VSzZEmJVszyIMIcFcQO7ku1a', 'Computer Science', '2020', '2023-08-29 01:22:19', 'on');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(50) NOT NULL,
  `category_description` text NOT NULL,
  `created_at` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_id`, `category_name`, `category_description`, `created_at`) VALUES
(1, 'Python', 'Python is a high-level, general-purpose programming language. Its design philosophy emphasizes code readability with the use of significant indentation. Python is dynamically typed and garbage-collected.', '2023-09-23'),
(2, 'JavaScript', 'JavaScript, often abbreviated as JS, is a programming language that is one of the core technologies of the World Wide Web, alongside HTML and CSS. As of 2023, 98.7% of websites use JavaScript on the client side for webpage behavior, often incorporating third-party libraries.', '2023-09-23'),
(3, 'Php', 'PHP is a general-purpose scripting language geared towards web development. It was originally created by Danish-Canadian programmer Rasmus Lerdorf in 1993 and released in 1995. The PHP reference implementation is now produced by the PHP Group.', '2023-09-23'),
(4, 'React.js', 'React is a free and open-source front-end JavaScript library for building user interfaces based on components. It is maintained by Meta and a community of individual developers and companies. React can be used to develop single-page, mobile, or server-rendered applications with frameworks like Next.js.', '2023-09-23');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `comment_id` int(11) NOT NULL,
  `question_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `teacher_id` int(11) NOT NULL,
  `alumni_id` int(11) NOT NULL,
  `comment_context` text NOT NULL,
  `comment_time` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`comment_id`, `question_id`, `student_id`, `teacher_id`, `alumni_id`, `comment_context`, `comment_time`) VALUES
(1, 1, 1, 1, 1, 'fjhsiudf idsjfpoids fdsjf df sjdpof dsfo', '2023-10-19 19:22:13'),
(4, 1, 3, 0, 0, 'comment testing', '2023-10-19 22:54:11'),
(5, 1, 3, 0, 0, 'first test of comments', '2023-10-19 22:54:27'),
(6, 2, 1, 0, 0, 'k das; asfpasfsafasfja fasfapsi f ffashdff sa', '2023-10-19 23:30:01'),
(7, 2, 3, 0, 0, 'hello there i am new tester', '2023-10-19 23:30:51'),
(8, 2, 1, 0, 0, 'comment testing', '2023-10-24 18:29:18'),
(9, 2, 1, 0, 0, 'hello new tester from comment box', '2023-10-24 19:33:29'),
(10, 2, 1, 0, 0, 'another comment', '2023-10-24 19:50:28'),
(11, 37, 1, 0, 0, 'probably you should start with next.js. It is only my opinion because i am also beginner. Probably any faculty member will be better in guiding you in this. hope someone answer your comment.', '2023-10-24 20:18:11'),
(12, 37, 1, 0, 0, 'second commment', '2023-10-24 20:58:11');

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `question_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `teacher_id` int(11) NOT NULL,
  `alumni_id` int(11) NOT NULL,
  `question_desc` text NOT NULL,
  `category_id` int(11) NOT NULL,
  `privacy` varchar(20) NOT NULL,
  `created_at` date NOT NULL DEFAULT current_timestamp(),
  `question_title` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`question_id`, `student_id`, `teacher_id`, `alumni_id`, `question_desc`, `category_id`, `privacy`, `created_at`, `question_title`) VALUES
(1, 1, 0, 0, 'help mw with this code instructions', 1, 'public', '2023-09-26', 'this is first question'),
(2, 1, 0, 0, 'A big, or essential, question (BQ) is open-ended, taps into the heart of the discipline, provides an opportunity for integration and connection to personal/social/professional issues, and addresses the question of “what can I do with this learning?”', 1, 'public', '2023-09-26', 'Second Question'),
(3, 0, 3, 0, 'uhdsasaui dsadiuadasd h uhsadushadas <script> IadiuadsI </script> asdbaiusd', 2, 'public', '2023-09-26', 'testing 3'),
(24, 1, 0, 0, 'testing from form for student id in question table', 2, 'public', '2023-09-27', 'testing no 8'),
(25, 3, 0, 0, 'from different user account.', 2, 'public', '2023-09-27', 'testing 8'),
(26, 1, 0, 0, 'tesing is done one bfalfai fasf', 2, 'public', '2023-09-27', 'testing 9'),
(29, 0, 3, 0, 'Testing from the teachers portal again.', 1, 'public', '2023-09-28', 'Testing 12'),
(30, 0, 0, 2, 'Testing form alumni portal.', 4, 'public', '2023-09-28', 'Testing 13'),
(31, 1, 0, 0, 'i am trying to do complete this page by using css and other stuff <script> fabaif </script>', 4, '', '2023-10-05', 'testing there is on going problem with indexQ&A.php'),
(32, 1, 0, 0, 'i am trying to do complete this page by using css and other stuff <script> fabaif </script>', 4, '', '2023-10-05', 'testing there is on going problem with indexQ&A.php'),
(33, 1, 0, 0, 'sdlsaiufisauhfsa kjdsaouhoisaduab uhdsayoaudsouhoihdsaoisa', 1, '', '2023-10-05', 'testing 19'),
(34, 0, 3, 0, 'lorem alshalish iasas iasajsmas huahsan ??', 2, '', '2023-10-18', 'Testing no 20'),
(35, 1, 0, 0, 'hfoiusaf gfouaygfasf gf osafoasuifiudsahf goiufasfoiuydsa', 2, '', '2023-10-18', 'Testing 21'),
(36, 1, 0, 0, 'gdia haiuds asd ohsad asdh bio dsao sa', 1, '', '2023-10-19', 'testing of python'),
(37, 1, 0, 0, 'is React a better framework of javaScript or there are other better than this?. If any mention which one i should get grip as a beginner.', 4, '', '2023-10-24', 'the new question about react.js category ?');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `student_id` int(11) NOT NULL,
  `enrollment` varchar(50) NOT NULL,
  `fullname` text NOT NULL,
  `email` varchar(50) NOT NULL,
  `number` varchar(20) NOT NULL,
  `password` varchar(72) NOT NULL,
  `gender` text NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`student_id`, `enrollment`, `fullname`, `email`, `number`, `password`, `gender`, `date`) VALUES
(1, '01-135201-083', 'Osama Jamshed', '01-135201-083@student.bahria.edu.pk', '03003847621', '$2y$10$KocuTnif.Ng.3Z5zpc7GIOkJXnYI9ywlg1peM1JMM3lNcBpW/4kgC', '', '2023-08-28 20:46:26'),
(2, '01-135201-099', 'sijeel sajid', '01-135201-099@student.bahria.edu.pk', '34272983', '$2y$10$rWpQfO5N7Yb75of8pKTFGeXE0WX3cxeT.5FHRFhfw/mQVkySV3lea', 'on', '2023-08-29 13:38:13'),
(3, '01-135201-109', 'Zain ul Abideen', '01-135201-109@student.bahria.edu.pk', '03001020002', '$2y$10$nD.QBe3MgSmH5RndGlnTWu5e7p1ncD25W21TDb6/pk5ehppLfT8p6', '', '2023-08-28 20:52:26'),
(4, '01-135201-116', 'Hassan Nisar', '01-135201-116@student.bahria.edu.pk', '03001234524', '$2y$10$VM9PPFGQSXAJAkxndtLxHO8Ktq0y.tspQNl8G/8CdsqSxlHxglI7.', 'on', '2023-08-28 21:57:21'),
(5, '00-000000-000', 'Admin', 'admin@student.bahria.edu.pk', '00000000000', 'admin', '', '2023-08-27 18:32:08');

-- --------------------------------------------------------

--
-- Table structure for table `teachers`
--

CREATE TABLE `teachers` (
  `teacher_id` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(72) NOT NULL,
  `fullname` text NOT NULL,
  `department` text NOT NULL,
  `gender` text NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `teachers`
--

INSERT INTO `teachers` (`teacher_id`, `email`, `password`, `fullname`, `department`, `gender`, `date`) VALUES
(1, 'admin@bahria.edu.pk', 'admin', 'admin', 'admin', 'male', '2023-08-28 22:00:05'),
(3, 'osama.buic@bahria.edu.pk', '$2y$10$zaVKY0Lcb7glKZEev0C6Ue2PY8igHi0fdk9FNCssli9bW3rGnLxiS', 'Osama Jamshed', 'Computer Science', 'on', '2023-08-28 22:19:17'),
(5, 'admin1@bahria.edu.pk', '0000', 'admin', 'admin', 'oooo', '2023-10-19 22:46:26');

-- --------------------------------------------------------

--
-- Table structure for table `threads`
--

CREATE TABLE `threads` (
  `thread_id` int(7) NOT NULL,
  `thread_title` varchar(255) NOT NULL,
  `thread_desc` text NOT NULL,
  `thread_cat_id` int(7) NOT NULL,
  `thread_user_id` int(7) NOT NULL,
  `timestamp` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `alumni`
--
ALTER TABLE `alumni`
  ADD PRIMARY KEY (`alumni_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`),
  ADD KEY `student_id` (`student_id`),
  ADD KEY `teacher_id` (`teacher_id`),
  ADD KEY `alumni_id` (`alumni_id`),
  ADD KEY `question_id` (`question_id`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`question_id`),
  ADD KEY `teacher_id` (`teacher_id`),
  ADD KEY `foriegn key` (`alumni_id`),
  ADD KEY `foreign key` (`student_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`student_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `teachers`
--
ALTER TABLE `teachers`
  ADD PRIMARY KEY (`teacher_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `threads`
--
ALTER TABLE `threads`
  ADD PRIMARY KEY (`thread_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `alumni`
--
ALTER TABLE `alumni`
  MODIFY `alumni_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `question_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `student_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `teachers`
--
ALTER TABLE `teachers`
  MODIFY `teacher_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `threads`
--
ALTER TABLE `threads`
  MODIFY `thread_id` int(7) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `question_id` FOREIGN KEY (`question_id`) REFERENCES `questions` (`question_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `questions`
--
ALTER TABLE `questions`
  ADD CONSTRAINT `category_id` FOREIGN KEY (`category_id`) REFERENCES `categories` (`category_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
