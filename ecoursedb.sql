-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.1.16-MariaDB - mariadb.org binary distribution
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

-- Dumping structure for table ecoursedb.admin
CREATE TABLE IF NOT EXISTS `admin` (
  `id_admin` int(11) NOT NULL AUTO_INCREMENT,
  `id_role` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `photo_url` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_admin`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `photo_url` (`photo_url`),
  KEY `id_role` (`id_role`),
  CONSTRAINT `admin_ibfk_1` FOREIGN KEY (`id_role`) REFERENCES `role` (`id_role`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Dumping data for table ecoursedb.admin: ~2 rows (approximately)
/*!40000 ALTER TABLE `admin` DISABLE KEYS */;
INSERT INTO `admin` (`id_admin`, `id_role`, `name`, `email`, `password`, `photo_url`, `created_at`) VALUES
	(1, 1, 'Muhamad Syihabudin', 'syihab@gmail.com', 'syihab', 'http://localhost/ecourse/assets/image/Admin/78976eaa1038decea46d3543318f3a28.jpg', '2018-07-27 14:03:05'),
	(2, 1, 'admin', 'admin@coderealm.com', 'admincoderealm', '', '2017-12-14 21:58:52');
/*!40000 ALTER TABLE `admin` ENABLE KEYS */;

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
	(7, 'Database Badge', 'http://localhost/ecourse/assets/image/Badge/badge-database.png');
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
  CONSTRAINT `fk_mmbadge_user` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table ecoursedb.badgenuser: ~0 rows (approximately)
/*!40000 ALTER TABLE `badgenuser` DISABLE KEYS */;
INSERT INTO `badgenuser` (`id`, `id_badge`, `id_user`, `date_received`) VALUES
	(1, 1, 1, '0000-00-00 00:00:00'),
	(2, 2, 1, '0000-00-00 00:00:00');
/*!40000 ALTER TABLE `badgenuser` ENABLE KEYS */;

-- Dumping structure for table ecoursedb.course
CREATE TABLE IF NOT EXISTS `course` (
  `id_course` int(11) NOT NULL AUTO_INCREMENT,
  `course_name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `course_badge` varchar(255) NOT NULL,
  `enroll_url` varchar(255) NOT NULL,
  `course_file` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_course`),
  UNIQUE KEY `skill_badge` (`course_badge`),
  UNIQUE KEY `enroll_url` (`enroll_url`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

-- Dumping data for table ecoursedb.course: ~7 rows (approximately)
/*!40000 ALTER TABLE `course` DISABLE KEYS */;
INSERT INTO `course` (`id_course`, `course_name`, `description`, `course_badge`, `enroll_url`, `course_file`, `created_at`) VALUES
	(1, 'HTML - CSS', 'Learn the fundamentals of design, front-end development, and crafting user experiences that are easy on the eyes.', 'http://localhost/ecourse/assets/image/Badge/badge-html-css.png', 'courses/html-css', 'css.docx', '2018-07-28 20:57:30'),
	(2, 'JavaScript', 'Spend some time with this powerful scripting language and learn to build lightweight applications with enhanced user interfaces. ', 'http://localhost/ecourse/assets/image/Badge/badge-javascript.png', 'courses/javascript', 'javascript.docx', '2018-07-28 20:57:34'),
	(3, 'Ruby', 'Master your Ruby skills and increase your Rails street cred by learning to build dynamic, sustainable applications for the web.', 'http://localhost/ecourse/assets/image/Badge/badge-ruby.png', 'courses/ruby', 'ruby.docx', '2018-07-28 20:57:37'),
	(4, 'PHP', 'Dig into one of the most prevalent programming languages and learn how PHP can help you develop various applications for the web.', 'http://localhost/ecourse/assets/image/Badge/badge-php.png', 'courses/php', 'php.docx', '2018-07-28 20:57:40'),
	(5, 'Python', 'Explore what it means to store and manipulate data, make decisions with your program, and leverage the power of Python.', 'http://localhost/ecourse/assets/image/Badge/badge-python.png', 'courses/python', 'python.docx', '2018-07-28 20:57:43'),
	(6, 'Git', 'Build a solid foundation in Git, then pair it with advanced version control skills. Learn how to collaborate on projects effectively with GitHub.', 'http://localhost/ecourse/assets/image/Badge/badge-git.png', 'courses/git', 'git.docx', '2018-07-28 20:57:47'),
	(7, 'Database', 'Take control of your application’s data layer by learning SQL, and take NoSQL for a spin if you’re feeling non-relational.', 'http://localhost/ecourse/assets/image/Badge/badge-database.png', 'courses/database', 'database.docx', '2018-07-28 20:57:50');
/*!40000 ALTER TABLE `course` ENABLE KEYS */;

-- Dumping structure for table ecoursedb.course_lesson
CREATE TABLE IF NOT EXISTS `course_lesson` (
  `id_course_lesson` int(11) NOT NULL AUTO_INCREMENT,
  `id_course_path` int(11) NOT NULL,
  `name_lesson` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `course_lesson_url` varchar(255) NOT NULL,
  `course_lesson_badge` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_course_lesson`),
  UNIQUE KEY `skill_course_url` (`course_lesson_url`,`course_lesson_badge`),
  KEY `id_skill_path` (`id_course_path`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;

-- Dumping data for table ecoursedb.course_lesson: ~19 rows (approximately)
/*!40000 ALTER TABLE `course_lesson` DISABLE KEYS */;
INSERT INTO `course_lesson` (`id_course_lesson`, `id_course_path`, `name_lesson`, `description`, `course_lesson_url`, `course_lesson_badge`, `created_at`) VALUES
	(1, 1, 'Front-end Foundations', 'Learn how to build a website with HTML and CSS.', 'http://localhost/ecourse/skills/html-css', 'http://localhost/ecourse/assets/image/Course/frontend-foundation.png', '2018-07-26 00:13:25'),
	(2, 1, 'Front-end Formations', 'Learn the latest versions of HTML and CSS.', 'http://localhost/ecourse/skills/html-css', 'http://localhost/ecourse/assets/image/Course/frontend-formation.png', '2018-07-26 00:13:28'),
	(3, 2, 'CSS Cross-Country', 'Explore the fundamentals of CSS.', 'http://localhost/ecourse/skills/html-css', 'http://localhost/ecourse/assets/image/Course/css.png', '2018-07-26 00:13:32'),
	(4, 2, 'Journey Into Mobile', 'Learn mobile-first, adaptive, and responsive web design.', 'http://localhost/ecourse/skills/html-css', 'http://localhost/ecourse/assets/image/Course/css-mobile.png', '2018-07-26 00:13:36'),
	(5, 3, 'JavaScript Road Trip Part 1', 'An introduction to the very basics of the JavaScript language.', 'http://localhost/CodeRealm/skills/javascript', 'http://localhost/CodeRealm/assets/image/Course/javascript-01.png', '2017-12-05 20:06:36'),
	(6, 3, 'JavaScript Road Trip Part 2', 'A continued introduction to the very basics of the JavaScript language.', 'http://localhost/CodeRealm/skills/javascript', 'http://localhost/CodeRealm/assets/image/Course/javascript-02.png', '2017-12-05 20:06:56'),
	(7, 3, 'JavaScript Road Trip Part 3', 'Build important intermediate skills within the JavaScript language.', 'http://localhost/CodeRealm/skills/javascript', 'http://localhost/CodeRealm/assets/image/Course/javascript-03.png', '2017-12-05 20:07:17'),
	(8, 4, 'Ruby Bits', 'Learn the core bits every Ruby programmer should know.', 'http://localhost/CodeRealm/skills/ruby', 'http://localhost/CodeRealm/assets/image/Course/ruby-bits.png', '2017-12-05 20:08:06'),
	(9, 4, 'Ruby Bits Part 2', 'Learn the advanced bits of expert Ruby programming.', 'http://localhost/CodeRealm/skills/ruby', 'http://localhost/CodeRealm/assets/image/Course/ruby-bits-2.png', '2017-12-05 20:08:27'),
	(10, 5, 'Try PHP', 'Begin building a foundation in one of the most widely used programming languages.', 'http://localhost/CodeRealm/skills/php', 'http://localhost/CodeRealm/assets/image/Course/try-php.png', '2017-12-05 20:09:03'),
	(11, 5, 'Close Encounters With PHP', 'Look to the skies and work with forms, validation, and custom libraries.', 'http://localhost/CodeRealm/skills/php', 'http://localhost/CodeRealm/assets/image/Course/close-php.png', '2017-12-05 20:09:33'),
	(12, 6, 'Try Python', 'Begin scaling up your Python knowledge and open the door to plentiful programming possibilities.', 'http://localhost/CodeRealm/skills/python', 'http://localhost/CodeRealm/assets/image/Course/try-python.png', '2017-12-05 20:10:19'),
	(13, 6, 'Flying Through Python', 'Continue learning the basics of Python and use them to manage our circus\' Spam Van food truck.', 'http://localhost/CodeRealm/skills/python', 'http://localhost/CodeRealm/assets/image/Course/flying-through-python.png', '2017-12-05 20:10:39'),
	(14, 7, 'Try Git', 'Be introduced to the basic concepts of Git version control.', 'http://localhost/CodeRealm/skills/git', 'http://localhost/CodeRealm/assets/image/Course/try-git.png', '2017-12-05 20:11:46'),
	(15, 7, 'Git Real', 'Get a more advanced introduction and guide to Git.', 'http://localhost/CodeRealm/skills/git', 'http://localhost/CodeRealm/assets/image/Course/git-real.png', '2017-12-05 20:12:04'),
	(16, 7, 'Git Real 2', 'Learn more advanced Git techniques.', 'http://localhost/CodeRealm/skills/git', 'http://localhost/CodeRealm/assets/image/Course/git-real-2.png', '2017-12-05 20:12:22'),
	(17, 7, 'Mastering Github', 'Better collaboration through GitHub.', 'http://localhost/CodeRealm/skills/git', 'http://localhost/CodeRealm/assets/image/Course/mastering-github.png', '2017-12-05 20:12:42'),
	(18, 8, 'Try SQL', 'Learn basic database manipulation with SQL.', 'http://localhost/CodeRealm/skills/database', 'http://localhost/CodeRealm/assets/image/Course/try-sql.png', '2017-12-05 20:13:44'),
	(19, 8, 'The Sequel to SQL', 'Move beyond the basics and learn the most powerful features of relational databases.', 'http://localhost/CodeRealm/skills/database', 'http://localhost/CodeRealm/assets/image/Course/sequel-sql.png', '2017-12-05 20:14:10');
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
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

-- Dumping data for table ecoursedb.course_path: ~8 rows (approximately)
/*!40000 ALTER TABLE `course_path` DISABLE KEYS */;
INSERT INTO `course_path` (`id_course_path`, `id_course`, `title_path`, `description`, `created_at`) VALUES
	(1, 1, 'Getting Started With HTML and CSS', 'HTML and CSS are the languages you can use to build and style websites. In these courses, you’ll learn the basics of HTML and CSS, build your first website, and then review some of the current HTML5 and CSS3 best practices.', '2017-12-05 19:01:32'),
	(2, 1, 'Intermediate CSS', 'Simple CSS can get you pretty far, but once you start getting serious about front-end development, you need to get exposed to more advanced topics, such as specificity, floating, animations, and responsive design. These courses teach you some best practices for working with CSS and building responsive websites to get your users moving in the right direction.', '2017-12-05 19:01:47'),
	(3, 2, 'JavaScript Language', 'JavaScript is a powerful and popular language for programming on the web. These courses will give you a strong foundation in the JavaScript language so you’ll be ready to move up to frameworks like Angular and Node.js.', '2017-12-05 19:31:34'),
	(4, 3, 'Ruby Language', 'Once you understand the basics of Ruby, learning more about the language will help you write better Ruby code and, therefore, better software. These courses give an overview of some of the most important parts of the Ruby programming language.', '2017-12-05 19:07:17'),
	(5, 4, 'Getting Started With PHP', 'PHP is a server-side language with the ability to power everything from personal blogs to hugely popular websites. In these courses, you’ll learn the foundational elements of this versatile programming language, including its data types, conditionals, and more.', '2017-12-05 19:07:45'),
	(6, 5, 'Getting Started With Python', 'Python is a fast and powerful language that is also easy to use and read, making it great for beginners and experts alike. These courses will take you through the basics of Python, helping you scale up your knowledge and preparing you to build a wide variety of Python applications.', '2017-12-05 19:11:16'),
	(7, 6, 'Git', 'Git is the most popular version control system that developers use to track and share code. These courses will take you from a complete beginner to proficiency using Git and GitHub.', '2017-12-05 19:11:42'),
	(8, 7, 'SQL', 'Discover how to manipulate relational database systems using SQL. In these courses, you’ll learn how to create a database and work with data inside of it, as well as best practices for modeling data in your apps.', '2017-12-05 19:12:10');
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
  CONSTRAINT `enroll_course_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Dumping data for table ecoursedb.enroll_course: ~0 rows (approximately)
/*!40000 ALTER TABLE `enroll_course` DISABLE KEYS */;
INSERT INTO `enroll_course` (`id_enroll_course`, `id_course`, `id_user`, `enroll_status`) VALUES
	(1, 1, 1, 1),
	(2, 2, 1, 1);
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
  CONSTRAINT `fk_mmenrollcourse_course` FOREIGN KEY (`id_lesson`) REFERENCES `lesson` (`id`),
  CONSTRAINT `fk_mmenrollcourse_user` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table ecoursedb.enroll_lesson: ~2 rows (approximately)
/*!40000 ALTER TABLE `enroll_lesson` DISABLE KEYS */;
/*!40000 ALTER TABLE `enroll_lesson` ENABLE KEYS */;

-- Dumping structure for table ecoursedb.friend
CREATE TABLE IF NOT EXISTS `friend` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ida` int(11) NOT NULL,
  `idb` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Dumping data for table ecoursedb.friend: ~0 rows (approximately)
/*!40000 ALTER TABLE `friend` DISABLE KEYS */;
INSERT INTO `friend` (`id`, `ida`, `idb`) VALUES
	(1, 1, 2);
/*!40000 ALTER TABLE `friend` ENABLE KEYS */;

-- Dumping structure for table ecoursedb.lecture
CREATE TABLE IF NOT EXISTS `lecture` (
  `id_lecture` int(11) NOT NULL AUTO_INCREMENT,
  `id_role` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `photo_url` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_lecture`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `photo_url` (`photo_url`),
  KEY `id_role` (`id_role`),
  CONSTRAINT `lecture_ibfk_1` FOREIGN KEY (`id_role`) REFERENCES `role` (`id_role`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Dumping data for table ecoursedb.lecture: ~3 rows (approximately)
/*!40000 ALTER TABLE `lecture` DISABLE KEYS */;
INSERT INTO `lecture` (`id_lecture`, `id_role`, `name`, `email`, `password`, `photo_url`, `created_at`) VALUES
	(1, 2, 'Muhamad Syihabudin', 'syihablecture@gmail.com', 'syihablecture', 'http://localhost/ecourse/assets/image/Lecture/1.jpg', '2018-07-28 20:26:49');
/*!40000 ALTER TABLE `lecture` ENABLE KEYS */;

-- Dumping structure for table ecoursedb.lesson
CREATE TABLE IF NOT EXISTS `lesson` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `id_lecture` int(10) NOT NULL,
  `lesson_name` varchar(255) DEFAULT NULL,
  `description` char(255) DEFAULT NULL,
  `img` text,
  `status` int(1) NOT NULL DEFAULT '1',
  `enroll_url` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_course_lecture` (`id_lecture`),
  CONSTRAINT `fk_course_lecture` FOREIGN KEY (`id_lecture`) REFERENCES `lecture` (`id_lecture`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table ecoursedb.lesson: ~3 rows (approximately)
/*!40000 ALTER TABLE `lesson` DISABLE KEYS */;
INSERT INTO `lesson` (`id`, `id_lecture`, `lesson_name`, `description`, `img`, `status`, `enroll_url`) VALUES
	(1, 1, 'Teknologi Web', 'Teknologi Web', 'https://4.bp.blogspot.com/-mhgMLE82f0Q/WBqemZLyVjI/AAAAAAAACIU/Njp2fUIYFSM1PDBcSE3NmU7sCbRCTaeswCLcB/s1600/a.JPG', 1, 'quest/teknologi-web'),
	(2, 2, 'Data Mining', 'Data Mining', 'https://www.sas.com/en_us/insights/analytics/data-mining/_jcr_content/socialShareImage.img.png', 1, 'quest/data-mining'),
	(3, 1, 'Android', 'Android Development', 'https://cnet4.cbsistatic.com/img/QJcTT2ab-sYWwOGrxJc0MXSt3UI=/2011/10/27/a66dfbb7-fdc7-11e2-8c7c-d4ae52e62bcc/android-wallpaper5_2560x1600_1.jpg', 1, 'quest/android');
/*!40000 ALTER TABLE `lesson` ENABLE KEYS */;

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
  CONSTRAINT `fk_course_detail` FOREIGN KEY (`id_lesson`) REFERENCES `lesson` (`id`)
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

-- Dumping structure for table ecoursedb.permission
CREATE TABLE IF NOT EXISTS `permission` (
  `id` int(122) unsigned NOT NULL AUTO_INCREMENT,
  `user_type` varchar(250) DEFAULT NULL,
  `data` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Dumping data for table ecoursedb.permission: ~2 rows (approximately)
/*!40000 ALTER TABLE `permission` DISABLE KEYS */;
INSERT INTO `permission` (`id`, `user_type`, `data`) VALUES
	(1, 'Member', '{"users":{"own_create":"1","own_read":"1","own_update":"1","own_delete":"1"}}'),
	(2, 'admin', '{"users":{"own_create":"1","own_read":"1","own_update":"1","own_delete":"1","all_create":"1","all_read":"1","all_update":"1","all_delete":"1"}}');
/*!40000 ALTER TABLE `permission` ENABLE KEYS */;

-- Dumping structure for table ecoursedb.role
CREATE TABLE IF NOT EXISTS `role` (
  `id_role` int(11) NOT NULL AUTO_INCREMENT,
  `role_name` varchar(10) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_role`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Dumping data for table ecoursedb.role: ~3 rows (approximately)
/*!40000 ALTER TABLE `role` DISABLE KEYS */;
INSERT INTO `role` (`id_role`, `role_name`, `created_at`) VALUES
	(1, 'admin', '2017-12-02 20:18:34'),
	(2, 'lecture', '2017-12-02 20:18:34'),
	(3, 'user', '2017-12-02 20:18:34');
/*!40000 ALTER TABLE `role` ENABLE KEYS */;

-- Dumping structure for table ecoursedb.setting
CREATE TABLE IF NOT EXISTS `setting` (
  `id` int(122) unsigned NOT NULL AUTO_INCREMENT,
  `keys` varchar(255) DEFAULT NULL,
  `value` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

-- Dumping data for table ecoursedb.setting: ~17 rows (approximately)
/*!40000 ALTER TABLE `setting` DISABLE KEYS */;
INSERT INTO `setting` (`id`, `keys`, `value`) VALUES
	(1, 'website', 'ECourse'),
	(2, 'logo', 'logo.png'),
	(3, 'favicon', 'favicon.ico'),
	(4, 'SMTP_EMAIL', ''),
	(5, 'HOST', ''),
	(6, 'PORT', ''),
	(7, 'SMTP_SECURE', ''),
	(8, 'SMTP_PASSWORD', ''),
	(9, 'mail_setting', 'simple_mail'),
	(10, 'company_name', 'Company Name'),
	(11, 'crud_list', 'users,User'),
	(12, 'EMAIL', ''),
	(13, 'UserModules', 'yes'),
	(14, 'register_allowed', '1'),
	(15, 'email_invitation', '1'),
	(16, 'admin_approval', '0'),
	(17, 'user_type', '["Member"]');
/*!40000 ALTER TABLE `setting` ENABLE KEYS */;

-- Dumping structure for table ecoursedb.stats
CREATE TABLE IF NOT EXISTS `stats` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `attack` int(11) NOT NULL,
  `hp` int(11) NOT NULL,
  `def` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Dumping data for table ecoursedb.stats: ~2 rows (approximately)
/*!40000 ALTER TABLE `stats` DISABLE KEYS */;
INSERT INTO `stats` (`id`, `id_user`, `attack`, `hp`, `def`) VALUES
	(1, 1, 700, 3000, 200),
	(2, 2, 500, 5000, 100);
/*!40000 ALTER TABLE `stats` ENABLE KEYS */;

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

-- Dumping structure for table ecoursedb.user
CREATE TABLE IF NOT EXISTS `user` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `id_role` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `photo_url` varchar(255) DEFAULT NULL,
  `Avatar` varchar(30) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_user`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `photo_url` (`photo_url`),
  KEY `id_role` (`id_role`),
  CONSTRAINT `user_ibfk_1` FOREIGN KEY (`id_role`) REFERENCES `role` (`id_role`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Dumping data for table ecoursedb.user: ~3 rows (approximately)
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` (`id_user`, `id_role`, `name`, `email`, `username`, `password`, `photo_url`, `Avatar`, `created_at`) VALUES
	(1, 3, 'Muhamad Syihabudin', 'syihab@gmail.com', 'syihab', 'syihab', 'http://localhost/ecourse/assets/image/User/rasyadh.jpg', 'Yuuki Yuuki-1', '2018-07-28 20:24:39'),
	(3, 3, 'Ryan Darmawan', 'ryan@gmail.com', 'ryan', 'ryan1234', 'http://localhost/ecourse/assets/image/logo.svg', '', '2018-07-25 19:08:09');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;

-- Dumping structure for table ecoursedb.users
CREATE TABLE IF NOT EXISTS `users` (
  `users_id` int(121) NOT NULL AUTO_INCREMENT,
  `user_id` varchar(255) DEFAULT NULL,
  `var_key` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `is_deleted` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `profile_pic` varchar(255) DEFAULT NULL,
  `user_type` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`users_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Dumping data for table ecoursedb.users: ~0 rows (approximately)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`users_id`, `user_id`, `var_key`, `status`, `is_deleted`, `name`, `password`, `email`, `profile_pic`, `user_type`) VALUES
	(1, '1', '', 'active', '0', 'admin', '$2y$10$SBPAe/GEVj1qvvo22D9lLuS5Ob2dlMjCoquz6XDYWp2JLe7QFCk6e', 'syehab94@gmail.com', '78976eaa1038decea46d3543318f3a28_1532622790.jpg', 'admin');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
