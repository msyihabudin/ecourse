-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.1.34-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win32
-- HeidiSQL Version:             9.4.0.5125
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Dumping database structure for ecoursedb
CREATE DATABASE IF NOT EXISTS `ecoursedb` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `ecoursedb`;

-- Dumping structure for table ecoursedb.badge
CREATE TABLE IF NOT EXISTS `badge` (
  `id` int(10) NOT NULL,
  `nama_badge` varchar(255) NOT NULL,
  `img` char(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table ecoursedb.badge: ~7 rows (approximately)
/*!40000 ALTER TABLE `badge` DISABLE KEYS */;
INSERT INTO `badge` (`id`, `nama_badge`, `img`) VALUES
	(1, 'HTML-CSS Badge', 'http://localhost/ecourse/assets/image/Badge/badge-html-css.png'),
	(2, 'JavaScript Badge', 'http://localhost/ecourse/assets/image/Badge/badge-javascript.png'),
	(3, 'Ruby Badge', 'http://localhost/ecourse/assets/image/Badge/badge-ruby.png'),
	(4, 'PHP Badge', 'http://localhost/ecourse/assets/image/Badge/badge-php.png'),
	(5, 'Python Badge', 'http://localhost/ecourse/assets/image/Badge/badge-python.png'),
	(6, 'Git Badge', 'http://localhost/ecourse/assets/image/Badge/badge-git.png'),
	(7, 'Database Badge', 'http://localhost/ecourse/assets/image/Badge/badge-database.png'),
	(18, 'tes untuk bad Badge', 'http://ecourse.work/./assets/image/Badge/1-012.jpg');
/*!40000 ALTER TABLE `badge` ENABLE KEYS */;

-- Dumping structure for table ecoursedb.badgenuser
CREATE TABLE IF NOT EXISTS `badgenuser` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `id_badge` int(10) NOT NULL,
  `id_user` int(10) NOT NULL,
  `date_received` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `fk_mmbadge_user` (`id_user`),
  KEY `fk_mmbadge_badge` (`id_badge`),
  CONSTRAINT `fk_mmbadge_badge` FOREIGN KEY (`id_badge`) REFERENCES `badge` (`id`),
  CONSTRAINT `fk_mmbadge_user` FOREIGN KEY (`id_user`) REFERENCES `users` (`users_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table ecoursedb.badgenuser: ~5 rows (approximately)
/*!40000 ALTER TABLE `badgenuser` DISABLE KEYS */;
INSERT INTO `badgenuser` (`id`, `id_badge`, `id_user`, `date_received`) VALUES
	(1, 1, 1, '0000-00-00 00:00:00'),
	(2, 2, 5, '2018-08-19 10:24:05'),
	(3, 1, 6, '0000-00-00 00:00:00'),
	(4, 5, 5, '0000-00-00 00:00:00'),
	(6, 18, 6, '0000-00-00 00:00:00');
/*!40000 ALTER TABLE `badgenuser` ENABLE KEYS */;

-- Dumping structure for table ecoursedb.categories
CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(60) DEFAULT NULL,
  `url_name` varchar(200) DEFAULT NULL,
  `description` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- Dumping data for table ecoursedb.categories: ~4 rows (approximately)
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` (`id`, `name`, `url_name`, `description`) VALUES
	(2, 'Uncategories', 'uncategories', 'Uncategories'),
	(3, 'Blogs', 'blogs', 'Blogs categories'),
	(4, 'Events', 'events', 'Events categories'),
	(5, 'News', 'news', 'News categories');
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;

-- Dumping structure for table ecoursedb.course
CREATE TABLE IF NOT EXISTS `course` (
  `id_course` int(11) NOT NULL AUTO_INCREMENT,
  `course_name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `course_badge` varchar(255) NOT NULL,
  `enroll_url` varchar(255) NOT NULL,
  `id_quest` int(11) NOT NULL,
  `price` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_course`),
  UNIQUE KEY `skill_badge` (`course_badge`),
  UNIQUE KEY `enroll_url` (`enroll_url`),
  KEY `FK_course_quest` (`id_quest`),
  CONSTRAINT `FK_course_quest` FOREIGN KEY (`id_quest`) REFERENCES `quest` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

-- Dumping data for table ecoursedb.course: ~7 rows (approximately)
/*!40000 ALTER TABLE `course` DISABLE KEYS */;
INSERT INTO `course` (`id_course`, `course_name`, `description`, `course_badge`, `enroll_url`, `id_quest`, `price`, `created_at`) VALUES
	(1, 'HTML - CSS', 'Learn the fundamentals of design, front-end development, and crafting user experiences that are easy on the eyes.', 'http://localhost/ecourse/assets/image/Badge/badge-html-css.png', 'courses/html-css', 1, 0, '2018-08-18 22:44:08'),
	(2, 'JavaScript', 'Spend some time with this powerful scripting language and learn to build lightweight applications with enhanced user interfaces. ', 'http://localhost/ecourse/assets/image/Badge/badge-javascript.png', 'courses/javascript', 1, 0, '2018-08-18 22:44:13'),
	(3, 'Ruby', 'Master your Ruby skills and increase your Rails street cred by learning to build dynamic, sustainable applications for the web.', 'http://localhost/ecourse/assets/image/Badge/badge-ruby.png', 'courses/ruby', 1, 100000, '2018-08-21 09:21:48'),
	(4, 'PHP', 'Dig into one of the most prevalent programming languages and learn how PHP can help you develop various applications for the web.', 'http://localhost/ecourse/assets/image/Badge/badge-php.png', 'courses/php', 1, 0, '2018-08-18 22:44:15'),
	(5, 'Python', 'Explore what it means to store and manipulate data, make decisions with your program, and leverage the power of Python.', 'http://localhost/ecourse/assets/image/Badge/badge-python.png', 'courses/python', 1, 250000, '2018-08-21 13:36:37'),
	(6, 'Git', 'Build a solid foundation in Git, then pair it with advanced version control skills. Learn how to collaborate on projects effectively with GitHub.', 'http://localhost/ecourse/assets/image/Badge/badge-git.png', 'courses/git', 1, 0, '2018-08-18 22:44:29'),
	(7, 'Database', 'Take control of your application’s data layer by learning SQL, and take NoSQL for a spin if you’re feeling non-relational.', 'http://localhost/ecourse/assets/image/Badge/badge-database.png', 'courses/database', 2, 0, '2018-08-18 22:44:26');
/*!40000 ALTER TABLE `course` ENABLE KEYS */;

-- Dumping structure for table ecoursedb.course_lesson
CREATE TABLE IF NOT EXISTS `course_lesson` (
  `id_course_lesson` int(11) NOT NULL AUTO_INCREMENT,
  `id_course_path` int(11) NOT NULL,
  `name_lesson` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `course_lesson_url` varchar(255) NOT NULL,
  `course_lesson_file` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_course_lesson`),
  UNIQUE KEY `skill_course_url` (`course_lesson_url`,`course_lesson_file`),
  KEY `id_skill_path` (`id_course_path`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=latin1;

-- Dumping data for table ecoursedb.course_lesson: ~19 rows (approximately)
/*!40000 ALTER TABLE `course_lesson` DISABLE KEYS */;
INSERT INTO `course_lesson` (`id_course_lesson`, `id_course_path`, `name_lesson`, `description`, `course_lesson_url`, `course_lesson_file`, `created_at`) VALUES
	(1, 1, 'Front-end Foundations', 'Learn how to build a website with HTML and CSS.', 'http://localhost/ecourse/skills/html-css', 'http://localhost/ecourse/assets/image/Course/frontend-foundation.png', '2018-07-26 00:13:25'),
	(2, 1, 'Front-end Formations', 'Learn the latest versions of HTML and CSS.', 'http://localhost/ecourse/skills/html-css', 'http://localhost/ecourse/assets/image/Course/frontend-formation.png', '2018-07-26 00:13:28'),
	(3, 2, 'CSS Cross-Country', 'Explore the fundamentals of CSS.', 'http://localhost/ecourse/skills/html-css', 'http://localhost/ecourse/assets/image/Course/css.png', '2018-07-26 00:13:32'),
	(4, 2, 'Journey Into Mobile', 'Learn mobile-first, adaptive, and responsive web design.', 'http://localhost/ecourse/skills/html-css', 'http://localhost/ecourse/assets/image/Course/css-mobile.png', '2018-07-26 00:13:36'),
	(5, 3, 'JavaScript Road Trip Part 1', 'An introduction to the very basics of the JavaScript language.', 'http://localhost/ecourse/skills/javascript', 'http://localhost/ecourse/assets/image/Course/javascript-01.png', '2018-07-28 22:32:31'),
	(6, 3, 'JavaScript Road Trip Part 2', 'A continued introduction to the very basics of the JavaScript language.', 'http://localhost/ecourse/skills/javascript', 'http://localhost/ecourse/assets/image/Course/javascript-02.png', '2018-07-28 22:32:41'),
	(7, 3, 'JavaScript Road Trip Part 3', 'Build important intermediate skills within the JavaScript language.', 'http://localhost/ecourse/skills/javascript', 'http://localhost/ecourse/assets/image/Course/javascript-03.png', '2018-07-28 22:32:44'),
	(8, 4, 'Ruby Bits', 'Learn the core bits every Ruby programmer should know.', 'http://localhost/ecourse/skills/ruby', 'http://localhost/ecourse/assets/image/Course/ruby-bits.png', '2018-07-28 22:32:48'),
	(9, 4, 'Ruby Bits Part 2', 'Learn the advanced bits of expert Ruby programming.', 'http://localhost/ecourse/skills/ruby', 'http://localhost/ecourse/assets/image/Course/ruby-bits-2.png', '2018-07-28 22:32:51'),
	(10, 5, 'Try PHP', 'Begin building a foundation in one of the most widely used programming languages.', 'http://localhost/ecourse/skills/php', 'http://localhost/ecourse/assets/image/Course/try-php.png', '2018-07-28 22:32:54'),
	(11, 5, 'Close Encounters With PHP', 'Look to the skies and work with forms, validation, and custom libraries.', 'http://localhost/ecourse/skills/php', 'http://localhost/ecourse/assets/image/Course/close-php.png', '2018-07-28 22:32:57'),
	(12, 6, 'Try Python', 'Begin scaling up your Python knowledge and open the door to plentiful programming possibilities.', 'http://localhost/ecourse/skills/python', 'http://localhost/ecourse/assets/image/Course/try-python.png', '2018-07-28 22:33:00'),
	(13, 6, 'Pendahuluan mengenai decision tree', 'decision tree adalah pohon keputusannnn', 'lesson-11', 'http://localhost/ecourse/assets/image/Course/flying-through-python.png', '2018-08-22 00:34:07'),
	(14, 7, 'coba1lesson', 'wwwwwwww', 'coba1lesson', 'http://localhost/ecourse/assets/image/Course/try-git.png', '2018-08-22 00:17:00'),
	(15, 7, 'Git Real', 'Get a more advanced introduction and guide to Git.', 'http://localhost/ecourse/skills/git', 'http://localhost/ecourse/assets/image/Course/git-real.png', '2018-07-28 22:33:11'),
	(16, 7, 'Git Real 2', 'Learn more advanced Git techniques.', 'http://localhost/ecourse/skills/git', 'http://localhost/ecourse/assets/image/Course/git-real-2.png', '2018-07-28 22:33:14'),
	(17, 7, 'Mastering Github', 'Better collaboration through GitHub.', 'http://localhost/ecourse/skills/git', 'http://localhost/ecourse/assets/image/Course/mastering-github.png', '2018-07-28 22:33:16'),
	(18, 8, 'Try SQL', 'Learn basic database manipulation with SQL.', 'http://localhost/ecourse/skills/database', 'http://localhost/ecourse/assets/image/Course/try-sql.png', '2018-07-28 22:33:20'),
	(19, 8, 'The Sequel to SQL', 'Move beyond the basics and learn the most powerful features of relational databases.', 'http://localhost/ecourse/skills/database', 'http://localhost/ecourse/assets/image/Course/sequel-sql.png', '2018-07-28 22:33:23');
/*!40000 ALTER TABLE `course_lesson` ENABLE KEYS */;

-- Dumping structure for table ecoursedb.course_path
CREATE TABLE IF NOT EXISTS `course_path` (
  `id_course_path` int(11) NOT NULL AUTO_INCREMENT,
  `id_course` int(11) NOT NULL,
  `title_path` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_course_path`),
  KEY `id_skill` (`id_course`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

-- Dumping data for table ecoursedb.course_path: ~9 rows (approximately)
/*!40000 ALTER TABLE `course_path` DISABLE KEYS */;
INSERT INTO `course_path` (`id_course_path`, `id_course`, `title_path`, `description`, `created_at`) VALUES
	(1, 1, 'Getting Started With HTML and CSS', 'HTML and CSS are the languages you can use to build and style websites. In these courses, you’ll learn the basics of HTML and CSS, build your first website, and then review some of the current HTML5 and CSS3 best practices.', '2017-12-05 19:01:32'),
	(2, 1, 'Intermediate CSS', 'Simple CSS can get you pretty far, but once you start getting serious about front-end development, you need to get exposed to more advanced topics, such as specificity, floating, animations, and responsive design. These courses teach you some best practices for working with CSS and building responsive websites to get your users moving in the right direction.', '2017-12-05 19:01:47'),
	(3, 2, 'JavaScript Language', 'JavaScript is a powerful and popular language for programming on the web. These courses will give you a strong foundation in the JavaScript language so you’ll be ready to move up to frameworks like Angular and Node.js.', '2017-12-05 19:31:34'),
	(4, 3, 'Ruby Language', 'Once you understand the basics of Ruby, learning more about the language will help you write better Ruby code and, therefore, better software. These courses give an overview of some of the most important parts of the Ruby programming language.', '2017-12-05 19:07:17'),
	(5, 4, 'Getting Started With PHP', 'PHP is a server-side language with the ability to power everything from personal blogs to hugely popular websites. In these courses, you’ll learn the foundational elements of this versatile programming language, including its data types, conditionals, and more.', '2017-12-05 19:07:45'),
	(6, 5, 'Getting Started With Python', 'Python is a fast and powerful language that is also easy to use and read, making it great for beginners and experts alike. These courses will take you through the basics of Python, helping you scale up your knowledge and preparing you to build a wide variety of Python applications.', '2017-12-05 19:11:16'),
	(7, 6, 'Git', 'Git is the most popular version control system that developers use to track and share code. These courses will take you from a complete beginner to proficiency using Git and GitHub.', '2017-12-05 19:11:42'),
	(8, 7, 'SQL', 'Discover how to manipulate relational database systems using SQL. In these courses, you’ll learn how to create a database and work with data inside of it, as well as best practices for modeling data in your apps.', '2017-12-05 19:12:10'),
	(9, 1, 'Bootstrap Learning', 'Bootstrap is a css framework.', '2018-08-02 23:16:51');
/*!40000 ALTER TABLE `course_path` ENABLE KEYS */;

-- Dumping structure for table ecoursedb.enroll_course
CREATE TABLE IF NOT EXISTS `enroll_course` (
  `id_enroll_course` int(11) NOT NULL AUTO_INCREMENT,
  `id_course` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `enroll_status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0 = false, 1 = true',
  PRIMARY KEY (`id_enroll_course`),
  KEY `id_skill` (`id_course`),
  KEY `id_user` (`id_user`),
  CONSTRAINT `enroll_course_ibfk_1` FOREIGN KEY (`id_course`) REFERENCES `course` (`id_course`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `enroll_course_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `users` (`users_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

-- Dumping data for table ecoursedb.enroll_course: ~5 rows (approximately)
/*!40000 ALTER TABLE `enroll_course` DISABLE KEYS */;
INSERT INTO `enroll_course` (`id_enroll_course`, `id_course`, `id_user`, `enroll_status`) VALUES
	(1, 1, 1, 1),
	(2, 2, 5, 1),
	(3, 2, 6, 1),
	(4, 1, 6, 1),
	(5, 5, 5, 1);
/*!40000 ALTER TABLE `enroll_course` ENABLE KEYS */;

-- Dumping structure for table ecoursedb.enroll_lesson
CREATE TABLE IF NOT EXISTS `enroll_lesson` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `id_lesson` int(10) NOT NULL,
  `id_user` int(10) NOT NULL,
  `enroll_status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0 = false, 1 = true',
  `total_poin` int(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `fk_mmenrollcourse_course` (`id_lesson`),
  KEY `fk_mmenrollcourse_user` (`id_user`),
  CONSTRAINT `fk_mmenrollcourse_course` FOREIGN KEY (`id_lesson`) REFERENCES `quest` (`id`),
  CONSTRAINT `fk_mmenrollcourse_user` FOREIGN KEY (`id_user`) REFERENCES `students` (`id_user`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table ecoursedb.enroll_lesson: ~0 rows (approximately)
/*!40000 ALTER TABLE `enroll_lesson` DISABLE KEYS */;
/*!40000 ALTER TABLE `enroll_lesson` ENABLE KEYS */;

-- Dumping structure for table ecoursedb.lesson_detail
CREATE TABLE IF NOT EXISTS `lesson_detail` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `id_lesson` int(10) NOT NULL,
  `detail_name` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `img` char(255) DEFAULT NULL,
  `point` int(10) NOT NULL DEFAULT '0',
  `status` int(1) NOT NULL DEFAULT '1',
  `file` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_course_detail` (`id_lesson`),
  CONSTRAINT `fk_course_detail` FOREIGN KEY (`id_lesson`) REFERENCES `quest` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table ecoursedb.lesson_detail: ~5 rows (approximately)
/*!40000 ALTER TABLE `lesson_detail` DISABLE KEYS */;
INSERT INTO `lesson_detail` (`id`, `id_lesson`, `detail_name`, `description`, `img`, `point`, `status`, `file`) VALUES
	(1, 1, 'jQuery', 'jQuery', 'https://www.javatpoint.com/jquerypages/images/jquery-tutorial.jpg', 100, 1, 'https://www.w3schools.com/jquery/'),
	(2, 1, 'Node JS', 'Node JS', 'https://upload.wikimedia.org/wikipedia/commons/thumb/d/d9/Node.js_logo.svg/1200px-Node.js_logo.svg.png', 100, 1, 'https://www.w3schools.com/nodejs/'),
	(3, 2, 'Text Mining', 'Text Mining', 'https://www.kdnuggets.com/wp-content/uploads/videolectures-most-popular-text-mining-words.jpg', 100, 1, 'https://www.tutorialspoint.com/data_mining/dm_mining_text_data.htm'),
	(4, 2, 'Image Retrieval', 'Content Based Image Retrieval', 'http://www.ics.uci.edu/~djp3/classes/2009_01_02_INF141/Misc/wordle.jpg', 100, 1, 'https://www.pyimagesearch.com/2014/12/01/complete-guide-building-image-search-engine-python-opencv/'),
	(5, 3, 'User Interface', 'Android User Interface', 'https://developer.android.com/images/ui/ui_index.png', 100, 1, 'https://www.tutorialspoint.com/android/android_user_interface_layouts.htm');
/*!40000 ALTER TABLE `lesson_detail` ENABLE KEYS */;

-- Dumping structure for table ecoursedb.navigation
CREATE TABLE IF NOT EXISTS `navigation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) DEFAULT NULL,
  `description` varchar(100) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `external` enum('0','1') NOT NULL DEFAULT '0',
  `position` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- Dumping data for table ecoursedb.navigation: ~4 rows (approximately)
/*!40000 ALTER TABLE `navigation` DISABLE KEYS */;
INSERT INTO `navigation` (`id`, `title`, `description`, `url`, `external`, `position`) VALUES
	(6, 'About', 'About Us', 'about', '0', '2'),
	(7, 'Contact', 'Contact Us', 'contact', '0', '4'),
	(8, 'Courses', 'Courses', 'courses', '0', '3');
/*!40000 ALTER TABLE `navigation` ENABLE KEYS */;

-- Dumping structure for table ecoursedb.notifications
CREATE TABLE IF NOT EXISTS `notifications` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email_address` varchar(200) NOT NULL,
  `verify_code` varchar(200) NOT NULL,
  `verified` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table ecoursedb.notifications: ~0 rows (approximately)
/*!40000 ALTER TABLE `notifications` DISABLE KEYS */;
/*!40000 ALTER TABLE `notifications` ENABLE KEYS */;

-- Dumping structure for table ecoursedb.order_confirm
CREATE TABLE IF NOT EXISTS `order_confirm` (
  `order_id` bigint(20) NOT NULL,
  `no_rekening` bigint(20) NOT NULL,
  `atas_nama` varchar(100) NOT NULL,
  `image` varchar(225) NOT NULL,
  `jumlah` bigint(20) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  KEY `order_id` (`order_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table ecoursedb.order_confirm: ~4 rows (approximately)
/*!40000 ALTER TABLE `order_confirm` DISABLE KEYS */;
INSERT INTO `order_confirm` (`order_id`, `no_rekening`, `atas_nama`, `image`, `jumlah`, `created_at`) VALUES
	(2, 1222121212, 'torik', 'http://ecourse.work/./assets/image/bukalapak_12.png', 250000, '2018-08-21 22:43:53'),
	(2, 1222121212, 'torik', 'http://ecourse.work/./assets/image/bukalapak_13.png', 250000, '2018-08-21 22:46:47'),
	(5, 2312312, 'asdfasdf', 'http://ecourse.work/./assets/image/1.JPG', 250000, '2018-08-22 01:05:53'),
	(6, 1222121212, 'Muhamad Syihabudin', 'http://ecourse.work/./assets/image/3.JPG', 3500000, '2018-08-22 02:36:08'),
	(7, 1222121212, 'torik', 'http://ecourse.work/./assets/image/2.JPG', 3500000, '2018-08-22 02:40:29');
/*!40000 ALTER TABLE `order_confirm` ENABLE KEYS */;

-- Dumping structure for table ecoursedb.order_items
CREATE TABLE IF NOT EXISTS `order_items` (
  `order_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `order_item_id` bigint(20) unsigned NOT NULL DEFAULT '0',
  `order_item_name` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total` bigint(20) NOT NULL,
  `is_edited` int(5) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`order_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ecoursedb.order_items: ~7 rows (approximately)
/*!40000 ALTER TABLE `order_items` DISABLE KEYS */;
INSERT INTO `order_items` (`order_id`, `order_item_id`, `order_item_name`, `status`, `total`, `is_edited`, `created_at`) VALUES
	(1, 1, 'Ruby', 'Pending Payment', 100000, 1, '2018-08-21 15:14:47'),
	(2, 2, 'Python', 'Completed', 250000, 1, '2018-08-21 15:30:42'),
	(3, 3, 'Ruby', 'Pending Payment', 100000, 0, '2018-08-21 15:53:54'),
	(4, 4, 'Python', 'Pending Payment', 250000, 0, '2018-08-21 15:55:06'),
	(5, 5, 'uweuwe', 'Failed', 200000, 1, '2018-08-22 01:05:20'),
	(6, 6, 'tes untuk bad', 'Completed', 3500000, 1, '2018-08-22 02:35:41'),
	(7, 7, 'tes untuk bad', 'Failed', 3500000, 1, '2018-08-22 02:39:49');
/*!40000 ALTER TABLE `order_items` ENABLE KEYS */;

-- Dumping structure for table ecoursedb.pages
CREATE TABLE IF NOT EXISTS `pages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(200) DEFAULT NULL,
  `url_title` varchar(200) DEFAULT NULL,
  `author` int(11) DEFAULT '0',
  `date` date NOT NULL,
  `content` text,
  `status` enum('active','inactive') DEFAULT 'active',
  `is_home` int(1) NOT NULL DEFAULT '0',
  `meta_title` varchar(200) NOT NULL,
  `meta_keywords` varchar(200) NOT NULL,
  `meta_description` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- Dumping data for table ecoursedb.pages: ~2 rows (approximately)
/*!40000 ALTER TABLE `pages` DISABLE KEYS */;
INSERT INTO `pages` (`id`, `title`, `url_title`, `author`, `date`, `content`, `status`, `is_home`, `meta_title`, `meta_keywords`, `meta_description`) VALUES
	(3, 'About', 'about-us', 1, '2018-08-05', 'About Us', 'active', 0, '', '', ''),
	(4, 'Contact', 'contact-us', 1, '2018-08-08', 'Contact Us', 'active', 0, '', '', '');
/*!40000 ALTER TABLE `pages` ENABLE KEYS */;

-- Dumping structure for table ecoursedb.posts
CREATE TABLE IF NOT EXISTS `posts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `author` int(11) NOT NULL DEFAULT '0',
  `cat_id` int(11) NOT NULL DEFAULT '0',
  `date_posted` date DEFAULT NULL,
  `title` varchar(200) NOT NULL,
  `url_title` varchar(200) NOT NULL,
  `excerpt` text NOT NULL,
  `content` longtext NOT NULL,
  `feature_image` varchar(255) DEFAULT NULL,
  `allow_comments` enum('0','1') NOT NULL DEFAULT '1',
  `sticky` enum('0','1') NOT NULL DEFAULT '0',
  `status` enum('draft','published') NOT NULL DEFAULT 'published',
  `meta_title` varchar(200) NOT NULL,
  `meta_keywords` varchar(200) NOT NULL,
  `meta_description` varchar(200) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `author` (`author`),
  KEY `cat_id` (`cat_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

-- Dumping data for table ecoursedb.posts: ~6 rows (approximately)
/*!40000 ALTER TABLE `posts` DISABLE KEYS */;
INSERT INTO `posts` (`id`, `author`, `cat_id`, `date_posted`, `title`, `url_title`, `excerpt`, `content`, `feature_image`, `allow_comments`, `sticky`, `status`, `meta_title`, `meta_keywords`, `meta_description`) VALUES
	(4, 1, 0, '2018-08-05', 'post1', 'post1', 'post1', 'post1', '20140121105633195.jpg', '1', '0', 'published', '', '', ''),
	(5, 1, 0, '2018-08-05', 'post2', 'post2', 'post2', 'post2', 'counselling.jpg', '1', '0', 'published', '', '', ''),
	(6, 1, 0, '2018-08-23', 'post3', 'post3', 'post3 asdfasdf asdf asdfasdfasd asdjf askdfhaskdfh askdhf asdh flahsdfkljahs dfkjhasdkfha sdkfhasdkjfh asdjfh askjldfh askdhf aksdhfkaljsdhf kashdf klashd fkjahsdjkfah sdkhf asjkdfh aksdjhfakshdfkjasdhfklahsdflkjah sdkf haskd faks dhflkjasdh fkah sdkf', 'post3', '81588.jpg', '1', '0', 'published', '', '', ''),
	(7, 1, 0, '2018-08-23', 'events1', 'events1', 'events1 fasdfasd asdfasdf a', 'events1 asdfasd fasdfa sdfasdfas dfas dfa sdfa sdfasdfasd fasdf asdf', '273904_-_Copy.jpg', '1', '0', 'published', '', '', ''),
	(8, 1, 0, '2018-08-23', 'events3', 'events3', 'adfasdfasdf asd fasdfasd fasdfasdfa sdfa sdfasdfasdf asdf asdfasdfasdfasd asd fa sdfasd fasdfasd fasdf asfasd fasd fas dfasd fasdjfa sdfgaksdjf ajksd adfasdfasdf asd fasdfasd fasdfasdfa sdfa sdfasdfasdf asdf asdfasdfasdfasd asd fa sdfasd fasdfasd fasdf asfasd fasd fas dfasd fasdjfa sdfgaksdjf ajksd adfasdfasdf asd fasdfasd fasdfasdfa sdfa sdfasdfasdf asdf asdfasdfasdfasd asd fa sdfasd fasdfasd fasdf asfasd fasd fas dfasd fasdjfa sdfgaksdjf ajksd adfasdfasdf asd fasdfasd fasdfasdfa sdfa sdfasdfasdf asdf asdfasdfasdfasd asd fa sdfasd fasdfasd fasdf asfasd fasd fas dfasd fasdjfa sdfgaksdjf ajksd adfasdfasdf asd fasdfasd fasdfasdfa sdfa sdfasdfasdf asdf asdfasdfasdfasd asd fa sdfasd fasdfasd fasdf asfasd fasd fas dfasd fasdjfa sdfgaksdjf ajksd ', 'adfasdfasdf asd fasdfasd fasdfasdfa sdfa sdfasdfasdf asdf asdfasdfasdfasd asd fa sdfasd fasdfasd fasdf asfasd fasd fas dfasd fasdjfa sdfgaksdjf ajksd adfasdfasdf asd fasdfasd fasdfasdfa sdfa sdfasdfasdf asdf asdfasdfasdfasd asd fa sdfasd fasdfasd fasdf asfasd fasd fas dfasd fasdjfa sdfgaksdjf ajksd adfasdfasdf asd fasdfasd fasdfasdfa sdfa sdfasdfasdf asdf asdfasdfasdfasd asd fa sdfasd fasdfasd fasdf asfasd fasd fas dfasd fasdjfa sdfgaksdjf ajksd adfasdfasdf asd fasdfasd fasdfasdfa sdfa sdfasdfasdf asdf asdfasdfasdfasd asd fa sdfasd fasdfasd fasdf asfasd fasd fas dfasd fasdjfa sdfgaksdjf ajksd adfasdfasdf asd fasdfasd fasdfasdfa sdfa sdfasdfasdf asdf asdfasdfasdfasd asd fa sdfasd fasdfasd fasdf asfasd fasd fas dfasd fasdjfa sdfgaksdjf ajksd adfasdfasdf asd fasdfasd fasdfasdfa sdfa sdfasdfasdf asdf asdfasdfasdfasd asd fa sdfasd fasdfasd fasdf asfasd fasd fas dfasd fasdjfa sdfgaksdjf ajksd adfasdfasdf asd fasdfasd fasdfasdfa sdfa sdfasdfasdf asdf asdfasdfasdfasd asd fa sdfasd fasdfasd fasdf asfasd fasd fas dfasd fasdjfa sdfgaksdjf ajksd adfasdfasdf asd fasdfasd fasdfasdfa sdfa sdfasdfasdf asdf asdfasdfasdfasd asd fa sdfasd fasdfasd fasdf asfasd fasd fas dfasd fasdjfa sdfgaksdjf ajksd adfasdfasdf asd fasdfasd fasdfasdfa sdfa sdfasdfasdf asdf asdfasdfasdfasd asd fa sdfasd fasdfasd fasdf asfasd fasd fas dfasd fasdjfa sdfgaksdjf ajksd ', '521145.jpg', '1', '0', 'published', '', '', ''),
	(9, 1, 0, '2018-08-24', 'blog1', 'blog1', 'blog1', 'blog1', '79587.jpg', '1', '0', 'published', '', '', '');
/*!40000 ALTER TABLE `posts` ENABLE KEYS */;

-- Dumping structure for table ecoursedb.posts_to_categories
CREATE TABLE IF NOT EXISTS `posts_to_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `post_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

-- Dumping data for table ecoursedb.posts_to_categories: ~7 rows (approximately)
/*!40000 ALTER TABLE `posts_to_categories` DISABLE KEYS */;
INSERT INTO `posts_to_categories` (`id`, `post_id`, `category_id`) VALUES
	(5, 5, 5),
	(6, 4, 5),
	(7, 6, 4),
	(8, 6, 5),
	(9, 7, 4),
	(10, 8, 4),
	(11, 9, 3);
/*!40000 ALTER TABLE `posts_to_categories` ENABLE KEYS */;

-- Dumping structure for table ecoursedb.quest
CREATE TABLE IF NOT EXISTS `quest` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `quest_name` varchar(255) DEFAULT NULL,
  `description` char(255) DEFAULT NULL,
  `img` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table ecoursedb.quest: ~4 rows (approximately)
/*!40000 ALTER TABLE `quest` DISABLE KEYS */;
INSERT INTO `quest` (`id`, `quest_name`, `description`, `img`) VALUES
	(1, 'Teknologi Web', 'Teknologi Web', 'https://4.bp.blogspot.com/-mhgMLE82f0Q/WBqemZLyVjI/AAAAAAAACIU/Njp2fUIYFSM1PDBcSE3NmU7sCbRCTaeswCLcB/s1600/a.JPG'),
	(2, 'Data Mining', 'Data Mining', 'https://www.sas.com/en_us/insights/analytics/data-mining/_jcr_content/socialShareImage.img.png'),
	(3, 'Android', 'Android Development', 'https://cnet4.cbsistatic.com/img/QJcTT2ab-sYWwOGrxJc0MXSt3UI=/2011/10/27/a66dfbb7-fdc7-11e2-8c7c-d4ae52e62bcc/android-wallpaper5_2560x1600_1.jpg');
/*!40000 ALTER TABLE `quest` ENABLE KEYS */;

-- Dumping structure for table ecoursedb.redirects
CREATE TABLE IF NOT EXISTS `redirects` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `old_slug` varchar(200) NOT NULL,
  `new_slug` varchar(200) NOT NULL,
  `type` varchar(4) NOT NULL DEFAULT 'post',
  `code` varchar(3) NOT NULL DEFAULT '301',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- Dumping data for table ecoursedb.redirects: ~3 rows (approximately)
/*!40000 ALTER TABLE `redirects` DISABLE KEYS */;
INSERT INTO `redirects` (`id`, `old_slug`, `new_slug`, `type`, `code`) VALUES
	(2, 'post1', 'about', 'page', '301'),
	(3, 'page/contact-us', 'contact', 'page', '301'),
	(4, '/index.php', 'index', 'page', '301');
/*!40000 ALTER TABLE `redirects` ENABLE KEYS */;

-- Dumping structure for table ecoursedb.settings
CREATE TABLE IF NOT EXISTS `settings` (
  `name` varchar(255) NOT NULL,
  `value` varchar(255) NOT NULL,
  `tab` varchar(50) NOT NULL,
  `field_type` varchar(50) NOT NULL,
  `options` varchar(200) NOT NULL,
  `required` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table ecoursedb.settings: ~23 rows (approximately)
/*!40000 ALTER TABLE `settings` DISABLE KEYS */;
INSERT INTO `settings` (`name`, `value`, `tab`, `field_type`, `options`, `required`) VALUES
	('admin_email', 'admin@ecource.com', 'email', 'text', '', 1),
	('allow_registrations', 'true', 'users', 'dropdown', 'true=yes|false=no', 1),
	('bank_account', '121239878922 a/n Muhamad Syihabudin (Mandiri)', 'general', 'text', '', 1),
	('email_activation', 'true', 'users', 'dropdown', 'true=yes|false=no', 1),
	('latest_news', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec vel gravida arcu. Vestibulum feugiat, sapien ultrices fermentum congue, quam velit venenatis sem', 'general', 'text', '', 1),
	('mail_protocol', 'mail', 'email', 'dropdown', 'mail=mail|smtp=smtp|sendmail=sendmail', 1),
	('manual_activation', 'false', 'users', 'dropdown', 'true=yes|false=no', 1),
	('our_mision', 'Lorem ipsum dolor sit , consectet adipisi elit, sed do eiusmod tempor for enim en consectet adipisi elit, sed do consectet adipisi elit, sed doadesg.', 'general', 'text', '', 1),
	('our_stories', 'Lorem ipsum dolor sit , consectet adipisi elit, sed do eiusmod tempor for enim en consectet adipisi elit, sed do consectet adipisi elit, sed doadesg.', 'general', 'text', '', 1),
	('our_vision', 'Lorem ipsum dolor sit , consectet adipisi elit, sed do eiusmod tempor for enim en consectet adipisi elit, sed do consectet adipisi elit, sed doadesg.', 'general', 'text', '', 1),
	('popular_course', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec vel gravida arcu. Vestibulum feugiat, sapien ultrices fermentum congue, quam velit venenatis sem', 'general', 'text', '', 1),
	('register_now', 'Simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry’s standard dumy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 'general', 'text', '', 1),
	('sendmail_path', '/usr/sbin/sendmail', 'email', 'text', '', 0),
	('server_email', 'admin@ecourse.com', 'email', 'text', '', 1),
	('site_description', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec vel gravida arcu. Vestibulum feugiat, sapien ultrices fermentum congue, quam velit venenatis sem', 'general', 'text', '', 0),
	('site_info1', 'tes', 'general', 'text', '', 1),
	('site_info2', 'tes', 'general', 'text', '', 1),
	('site_info3', 'tes', 'general', 'text', '', 1),
	('site_info4', 'tes', 'general', 'text', '', 1),
	('site_name', 'ECourse', 'general', 'text', '', 1),
	('smtp_crypto', 'tls', 'email', 'dropdown', 'tls=TLS|ssl=SSL', 0),
	('smtp_host', '', 'email', 'text', '', 0),
	('smtp_pass', '', 'email', 'text', '', 0),
	('smtp_port', '', 'email', 'text', '', 0),
	('smtp_user', '', 'email', 'text', '', 0),
	('upcoming_events', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec vel gravida arcu. Vestibulum feugiat, sapien ultrices fermentum congue, quam velit venenatis sem', 'general', 'text', '', 1);
/*!40000 ALTER TABLE `settings` ENABLE KEYS */;

-- Dumping structure for table ecoursedb.templates
CREATE TABLE IF NOT EXISTS `templates` (
  `id` int(121) unsigned NOT NULL AUTO_INCREMENT,
  `module` varchar(255) DEFAULT NULL,
  `code` varchar(255) DEFAULT NULL,
  `template_name` varchar(255) DEFAULT NULL,
  `html` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Dumping data for table ecoursedb.templates: ~2 rows (approximately)
/*!40000 ALTER TABLE `templates` DISABLE KEYS */;
INSERT INTO `templates` (`id`, `module`, `code`, `template_name`, `html`) VALUES
	(1, 'forgot_pass', 'forgot_password', 'Forgot password', '<html xmlns="http://www.w3.org/1999/xhtml"><head>\r\n  <meta name="viewport" content="width=device-width, initial-scale=1.0">\r\n  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">\r\n  <style type="text/css" rel="stylesheet" media="all">\r\n    /* Base ------------------------------ */\r\n    *:not(br):not(tr):not(html) {\r\n      font-family: Arial, \'Helvetica Neue\', Helvetica, sans-serif;\r\n      -webkit-box-sizing: border-box;\r\n      box-sizing: border-box;\r\n    }\r\n    body {\r\n      \r\n    }\r\n    a {\r\n      color: #3869D4;\r\n    }\r\n\r\n\r\n    /* Masthead ----------------------- */\r\n    .email-masthead {\r\n      padding: 25px 0;\r\n      text-align: center;\r\n    }\r\n    .email-masthead_logo {\r\n      max-width: 400px;\r\n      border: 0;\r\n    }\r\n    .email-footer {\r\n      width: 570px;\r\n      margin: 0 auto;\r\n      padding: 0;\r\n      text-align: center;\r\n    }\r\n    .email-footer p {\r\n      color: #AEAEAE;\r\n    }\r\n  \r\n    .content-cell {\r\n      padding: 35px;\r\n    }\r\n    .align-right {\r\n      text-align: right;\r\n    }\r\n\r\n    /* Type ------------------------------ */\r\n    h1 {\r\n      margin-top: 0;\r\n      color: #2F3133;\r\n      font-size: 19px;\r\n      font-weight: bold;\r\n      text-align: left;\r\n    }\r\n    h2 {\r\n      margin-top: 0;\r\n      color: #2F3133;\r\n      font-size: 16px;\r\n      font-weight: bold;\r\n      text-align: left;\r\n    }\r\n    h3 {\r\n      margin-top: 0;\r\n      color: #2F3133;\r\n      font-size: 14px;\r\n      font-weight: bold;\r\n      text-align: left;\r\n    }\r\n    p {\r\n      margin-top: 0;\r\n      color: #74787E;\r\n      font-size: 16px;\r\n      line-height: 1.5em;\r\n      text-align: left;\r\n    }\r\n    p.sub {\r\n      font-size: 12px;\r\n    }\r\n    p.center {\r\n      text-align: center;\r\n    }\r\n\r\n    /* Buttons ------------------------------ */\r\n    .button {\r\n      display: inline-block;\r\n      width: 200px;\r\n      background-color: #3869D4;\r\n      border-radius: 3px;\r\n      color: #ffffff;\r\n      font-size: 15px;\r\n      line-height: 45px;\r\n      text-align: center;\r\n      text-decoration: none;\r\n      -webkit-text-size-adjust: none;\r\n      mso-hide: all;\r\n    }\r\n    .button--green {\r\n      background-color: #22BC66;\r\n    }\r\n    .button--red {\r\n      background-color: #dc4d2f;\r\n    }\r\n    .button--blue {\r\n      background-color: #3869D4;\r\n    }\r\n  </style>\r\n</head>\r\n<body style="width: 100% !important;\r\n      height: 100%;\r\n      margin: 0;\r\n      line-height: 1.4;\r\n      background-color: #F2F4F6;\r\n      color: #74787E;\r\n      -webkit-text-size-adjust: none;">\r\n  <table class="email-wrapper" width="100%" cellpadding="0" cellspacing="0" style="\r\n    width: 100%;\r\n    margin: 0;\r\n    padding: 0;">\r\n    <tbody><tr>\r\n      <td align="center">\r\n        <table class="email-content" width="100%" cellpadding="0" cellspacing="0" style="width: 100%;\r\n      margin: 0;\r\n      padding: 0;">\r\n          <!-- Logo -->\r\n\r\n          <tbody>\r\n          <!-- Email Body -->\r\n          <tr>\r\n            <td class="email-body" width="100%" style="width: 100%;\r\n    margin: 0;\r\n    padding: 0;\r\n    border-top: 1px solid #edeef2;\r\n    border-bottom: 1px solid #edeef2;\r\n    background-color: #edeef2;">\r\n              <table class="email-body_inner" align="center" width="570" cellpadding="0" cellspacing="0" style=" width: 570px;\r\n    margin:  14px auto;\r\n    background: #fff;\r\n    padding: 0;\r\n    border: 1px outset rgba(136, 131, 131, 0.26);\r\n    box-shadow: 0px 6px 38px rgb(0, 0, 0);\r\n       ">\r\n                <!-- Body content -->\r\n                <thead style="background: #3869d4;"><tr><th><div align="center" style="padding: 15px; color: #000;"><a href="{var_action_url}" class="email-masthead_name" style="font-size: 16px;\r\n      font-weight: bold;\r\n      color: #bbbfc3;\r\n      text-decoration: none;\r\n      text-shadow: 0 1px 0 white;">{var_sender_name}</a></div></th></tr>\r\n                </thead>\r\n                <tbody><tr>\r\n                  <td class="content-cell" style="padding: 35px;">\r\n                    <h1>Hi {var_user_name},</h1>\r\n                    <p>You recently requested to reset your password for your {var_website_name} account. Click the button below to reset it.</p>\r\n                    <!-- Action -->\r\n                    <table class="body-action" align="center" width="100%" cellpadding="0" cellspacing="0" style="\r\n      width: 100%;\r\n      margin: 30px auto;\r\n      padding: 0;\r\n      text-align: center;">\r\n                      <tbody><tr>\r\n                        <td align="center">\r\n                          <div>\r\n                            <!--[if mso]><v:roundrect xmlns:v="urn:schemas-microsoft-com:vml" xmlns:w="urn:schemas-microsoft-com:office:word" href="{{var_action_url}}" style="height:45px;v-text-anchor:middle;width:200px;" arcsize="7%" stroke="f" fill="t">\r\n                              <v:fill type="tile" color="#dc4d2f" />\r\n                              <w:anchorlock/>\r\n                              <center style="color:#ffffff;font-family:sans-serif;font-size:15px;">Reset your password</center>\r\n                            </v:roundrect><![endif]-->\r\n                            <a href="{var_varification_link}" class="button button--red" style="background-color: #dc4d2f;display: inline-block;\r\n      width: 200px;\r\n      background-color: #3869D4;\r\n      border-radius: 3px;\r\n      color: #ffffff;\r\n      font-size: 15px;\r\n      line-height: 45px;\r\n      text-align: center;\r\n      text-decoration: none;\r\n      -webkit-text-size-adjust: none;\r\n      mso-hide: all;">Reset your password</a>\r\n                          </div>\r\n                        </td>\r\n                      </tr>\r\n                    </tbody></table>\r\n                    <p>If you did not request a password reset, please ignore this email or reply to let us know.</p>\r\n                    <p>Thanks,<br>{var_sender_name} and the {var_website_name} Team</p>\r\n                   <!-- Sub copy -->\r\n                    <table class="body-sub" style="margin-top: 25px;\r\n      padding-top: 25px;\r\n      border-top: 1px solid #EDEFF2;">\r\n                      <tbody><tr>\r\n                        <td> \r\n                          <p class="sub" style="font-size:12px;">If you are having trouble clicking the password reset button, copy and paste the URL below into your web browser.</p>\r\n                          <p class="sub"  style="font-size:12px;"><a href="{var_varification_link}">{var_varification_link}</a></p>\r\n                        </td>\r\n                      </tr>\r\n                    </tbody></table>\r\n                  </td>\r\n                </tr>\r\n              </tbody></table>\r\n            </td>\r\n          </tr>\r\n        </tbody></table>\r\n      </td>\r\n    </tr>\r\n  </tbody></table>\r\n\r\n\r\n</body></html>'),
	(3, 'users', 'invitation', 'Invitation', '<p>Hello <strong>{var_user_email}</strong></p>\r\n\r\n<p>Click below link to register&nbsp;<br />\r\n{var_inviation_link}</p>\r\n\r\n<p>Thanks&nbsp;</p>\r\n');
/*!40000 ALTER TABLE `templates` ENABLE KEYS */;

-- Dumping structure for table ecoursedb.users
CREATE TABLE IF NOT EXISTS `users` (
  `users_id` int(121) NOT NULL AUTO_INCREMENT,
  `user_id` varchar(255) DEFAULT NULL,
  `var_key` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `is_deleted` varchar(255) DEFAULT NULL,
  `fullname` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `profile_pic` varchar(255) DEFAULT NULL,
  `user_type` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`users_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

-- Dumping data for table ecoursedb.users: ~6 rows (approximately)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`users_id`, `user_id`, `var_key`, `status`, `is_deleted`, `fullname`, `name`, `password`, `email`, `profile_pic`, `user_type`) VALUES
	(1, '1', '', 'active', '0', 'Muhamad Syihabudin', 'admin', '$2y$10$SBPAe/GEVj1qvvo22D9lLuS5Ob2dlMjCoquz6XDYWp2JLe7QFCk6e', 'syehab94@gmail.com', '78976eaa1038decea46d3543318f3a28_1533013050.jpg', 'admin'),
	(4, NULL, NULL, 'active', NULL, 'Muthi Nafisa', 'muthi', '', 'muthinafisa@gmail.com', 'user.png', 'student'),
	(5, '1', NULL, 'active', '0', 'torik alkatiriee', 'torik', '$2y$10$rAFtF.H8NjtK0tCok6Nu4eE6Qm2FrZtVF6TE0cwo7oS9IMCSQ6JlG', 'torik@gmail.com', 'user.png', 'student'),
	(6, '1', NULL, 'active', '0', 'muhamad syihabudin', 'syihabudin', '$2y$10$TjR7X2IXm9Y6R1/RmWWQMO//b5YeHw1ZSwXGze.hTGIyTxe6mp4Lq', 'syihabudin@gmail.com', 'user.png', 'student'),
	(7, '1', NULL, 'active', '0', 'Muhamad Syihabudin', 'syihabu', '$2y$10$0jMsqWtA81rvHT7oYQOrEexaDAFKPN2fcrQcOsQZg1b5xYuJDBiQW', 'shb@outlook.co.id', '6a010536e486db970b01a3fd2b55a6970b-700wi2.jpg', 'instructor'),
	(8, '1', NULL, 'active', '0', 'user 01', 'user01', '$2y$10$c1gGz.ilwdA4mCq5vnFAEeim4E0CvqNKJpMvQJZNpEFP92Njd.WQG', 'user01@gmail.com', '75842_-_Copy.jpg', 'author');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

-- Dumping structure for table ecoursedb.user_items
CREATE TABLE IF NOT EXISTS `user_items` (
  `user_item_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL DEFAULT '0',
  `item_id` bigint(20) unsigned NOT NULL DEFAULT '0',
  `flag` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`user_item_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table ecoursedb.user_items: ~5 rows (approximately)
/*!40000 ALTER TABLE `user_items` DISABLE KEYS */;
INSERT INTO `user_items` (`user_item_id`, `user_id`, `item_id`, `flag`, `created_at`) VALUES
	(1, 5, 3, 'delete', '2018-08-21 15:14:45'),
	(2, 5, 5, 'delete', '2018-08-21 15:30:36'),
	(5, 6, 17, 'delete', '2018-08-21 23:14:31'),
	(6, 6, 18, 'delete', '2018-08-22 02:35:40'),
	(7, 5, 18, 'delete', '2018-08-22 02:39:47');
/*!40000 ALTER TABLE `user_items` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
