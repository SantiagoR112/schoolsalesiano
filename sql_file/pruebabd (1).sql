-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 04-10-2023 a las 18:04:34
-- Versión del servidor: 8.0.31
-- Versión de PHP: 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `pruebabd`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `academic_syllabus`
--

DROP TABLE IF EXISTS `academic_syllabus`;
CREATE TABLE IF NOT EXISTS `academic_syllabus` (
  `id` int NOT NULL AUTO_INCREMENT,
  `academic_syllabus_code` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `class_id` int NOT NULL,
  `subject_id` int NOT NULL,
  `description` varchar(500) NOT NULL,
  `uploader_type` varchar(255) NOT NULL,
  `uploader_id` varchar(255) NOT NULL,
  `session` varchar(255) NOT NULL,
  `timestamp` int NOT NULL,
  `file_name` varchar(255) NOT NULL,
  `school_id` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `accountant`
--

DROP TABLE IF EXISTS `accountant`;
CREATE TABLE IF NOT EXISTS `accountant` (
  `accountant_id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(31) NOT NULL,
  `accountant_number` varchar(255) NOT NULL,
  `birthday` date NOT NULL,
  `sex` varchar(30) NOT NULL,
  `religion` varchar(50) NOT NULL,
  `blood_group` varchar(20) NOT NULL,
  `address` varchar(200) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `facebook` varchar(50) NOT NULL,
  `twitter` varchar(50) NOT NULL,
  `googleplus` varchar(50) NOT NULL,
  `linkedin` varchar(50) NOT NULL,
  `qualification` varchar(20) NOT NULL,
  `marital_status` varchar(25) NOT NULL,
  `file_name` varchar(50) NOT NULL,
  `password` varchar(20) NOT NULL,
  `session` varchar(10) NOT NULL,
  `school_id` int NOT NULL,
  `login_status` int NOT NULL,
  PRIMARY KEY (`accountant_id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `accountant`
--

INSERT INTO `accountant` (`accountant_id`, `name`, `accountant_number`, `birthday`, `sex`, `religion`, `blood_group`, `address`, `phone`, `email`, `facebook`, `twitter`, `googleplus`, `linkedin`, `qualification`, `marital_status`, `file_name`, `password`, `session`, `school_id`, `login_status`) VALUES
(16, 'Accountant', '09f94645c8', '2019-08-27', 'Male', 'Muslim', 'o+', 'Address Accountant', '+912345667', 'accountant@accountant.com', 'facebook', 'twitter', 'googleplus', 'linkedin', 'PhD', 'Married', 'Terms of Service.docx', '7110eda4d09e062aa5e4', '', 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `activity`
--

DROP TABLE IF EXISTS `activity`;
CREATE TABLE IF NOT EXISTS `activity` (
  `activity_id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `colour` varchar(255) NOT NULL,
  `icon` varchar(255) NOT NULL,
  `club_id` int NOT NULL,
  `school_id` int NOT NULL,
  `session` varchar(255) NOT NULL,
  `description` varchar(500) NOT NULL,
  `date` varchar(255) NOT NULL,
  PRIMARY KEY (`activity_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `admin_id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(31) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `password` varchar(100) NOT NULL,
  `school_id` int NOT NULL,
  `session` varchar(20) NOT NULL,
  `level` int NOT NULL,
  `login_status` int NOT NULL,
  PRIMARY KEY (`admin_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `admin`
--

INSERT INTO `admin` (`admin_id`, `name`, `email`, `phone`, `password`, `school_id`, `session`, `level`, `login_status`) VALUES
(1, 'Administrador', 'admin@admin.com', '07133445656', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 1, '', 1, 0),
(9, 'Udemy Instructor', 'udemy@udemy.com', '+1564783934', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 0, '', 2, 0),
(10, 'Coordinador', 'coordination@cordination.com', '3104651387', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 0, '', 2, 0),
(12, 'Rector', 'rectoriasale@gmail.com', '3147852369', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 0, '', 2, 0);

--
-- Disparadores `admin`
--
DROP TRIGGER IF EXISTS `prevent_duplicate_admin_email`;
DELIMITER $$
CREATE TRIGGER `prevent_duplicate_admin_email` BEFORE INSERT ON `admin` FOR EACH ROW BEGIN
    IF EXISTS (
        SELECT 1 FROM admin
        WHERE email = NEW.email
    ) THEN
        SIGNAL SQLSTATE '45002' SET MESSAGE_TEXT = 'El correo electrónico ya existe';
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `admin_role`
--

DROP TABLE IF EXISTS `admin_role`;
CREATE TABLE IF NOT EXISTS `admin_role` (
  `admin_role_id` int NOT NULL AUTO_INCREMENT,
  `admin_id` int NOT NULL,
  `dashboard` int NOT NULL,
  `manage_academics` int NOT NULL,
  `manage_employee` int NOT NULL,
  `manage_student` int NOT NULL,
  `manage_attendance` int NOT NULL,
  `download_page` int NOT NULL,
  `manage_parent` int NOT NULL,
  `manage_alumni` int NOT NULL,
  `school_id` int NOT NULL,
  `session` varchar(20) NOT NULL,
  PRIMARY KEY (`admin_role_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `admin_role`
--

INSERT INTO `admin_role` (`admin_role_id`, `admin_id`, `dashboard`, `manage_academics`, `manage_employee`, `manage_student`, `manage_attendance`, `download_page`, `manage_parent`, `manage_alumni`, `school_id`, `session`) VALUES
(4, 1, 1, 1, 1, 1, 1, 1, 1, 1, 0, ''),
(7, 9, 1, 1, 1, 1, 1, 1, 1, 1, 0, ''),
(8, 10, 1, 1, 1, 1, 0, 0, 1, 0, 0, ''),
(9, 11, 1, 1, 0, 1, 0, 0, 1, 0, 0, ''),
(10, 12, 0, 0, 0, 0, 0, 0, 0, 0, 0, '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alumni`
--

DROP TABLE IF EXISTS `alumni`;
CREATE TABLE IF NOT EXISTS `alumni` (
  `alumni_id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(31) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `sex` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `profession` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `marital_status` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `g_year` date NOT NULL,
  `club_id` int NOT NULL,
  `interest` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `school_id` int NOT NULL,
  `session` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`alumni_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `alumni`
--

INSERT INTO `alumni` (`alumni_id`, `name`, `sex`, `phone`, `email`, `address`, `profession`, `marital_status`, `g_year`, `club_id`, `interest`, `school_id`, `session`) VALUES
(4, 'Alumni Learner', 'Male', '09066021052', 'd@d.com', 'Address', 'Engineer', 'married', '2019-09-04', 1, 'Reading', 0, '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `application`
--

DROP TABLE IF EXISTS `application`;
CREATE TABLE IF NOT EXISTS `application` (
  `application_id` int NOT NULL AUTO_INCREMENT,
  `applicant_name` varchar(31) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `vacancy_id` int NOT NULL,
  `apply_date` varchar(31) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(31) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `school_id` int NOT NULL,
  `session` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`application_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `application`
--

INSERT INTO `application` (`application_id`, `applicant_name`, `vacancy_id`, `apply_date`, `status`, `school_id`, `session`) VALUES
(2, 'Udemy Application', 3, '1567965600', 'interviewed', 0, '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `assignment`
--

DROP TABLE IF EXISTS `assignment`;
CREATE TABLE IF NOT EXISTS `assignment` (
  `assignment_id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `subject_id` int NOT NULL,
  `class_id` int NOT NULL,
  `teacher_id` int NOT NULL,
  `description` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_name` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_type` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `timestamp` date NOT NULL,
  `school_id` int NOT NULL,
  `session` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`assignment_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `assignment`
--

INSERT INTO `assignment` (`assignment_id`, `name`, `subject_id`, `class_id`, `teacher_id`, `description`, `file_name`, `file_type`, `timestamp`, `school_id`, `session`) VALUES
(1, 'Assignment for Nursery One', 4, 2, 1, 'DESC', 'invoice.docx', 'xlsx', '2018-08-19', 0, '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `attendance`
--

DROP TABLE IF EXISTS `attendance`;
CREATE TABLE IF NOT EXISTS `attendance` (
  `attendance_id` int NOT NULL AUTO_INCREMENT,
  `status` int NOT NULL COMMENT '0 undefined , 1 present , 2  absent, 3 holiday, 4 half day, 5 late',
  `student_id` int NOT NULL,
  `date` date NOT NULL,
  `session` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `school_id` int NOT NULL,
  PRIMARY KEY (`attendance_id`)
) ENGINE=InnoDB AUTO_INCREMENT=58 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `attendance`
--

INSERT INTO `attendance` (`attendance_id`, `status`, `student_id`, `date`, `session`, `school_id`) VALUES
(39, 1, 45, '2019-12-20', '2019-2020', 0),
(40, 1, 45, '2019-12-22', '2019-2020', 0),
(41, 0, 23, '2019-12-28', '2019-2020', 0),
(44, 1, 45, '2020-01-28', '2019-2020', 0),
(45, 2, 46, '2020-01-28', '2019-2020', 0),
(46, 1, 45, '2020-03-08', '2019-2020', 0),
(47, 2, 46, '2020-03-08', '2019-2020', 0),
(48, 0, 45, '2020-08-20', '', 0),
(49, 0, 46, '2020-08-20', '', 0),
(50, 1, 1070457127, '2023-10-09', '', 0),
(51, 1, 1077451788, '2023-10-09', '', 0),
(52, 1, 1070457127, '2023-09-10', '', 0),
(53, 1, 1077451788, '2023-09-10', '', 0),
(54, 0, 1070457127, '2023-09-18', '', 0),
(55, 0, 1077451788, '2023-09-18', '', 0),
(56, 1, 1070457127, '2023-09-25', '', 0),
(57, 2, 1077451788, '2023-09-25', '', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `author`
--

DROP TABLE IF EXISTS `author`;
CREATE TABLE IF NOT EXISTS `author` (
  `author_id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `description` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `school_id` int NOT NULL,
  `session` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  PRIMARY KEY (`author_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `author`
--

INSERT INTO `author` (`author_id`, `name`, `description`, `school_id`, `session`) VALUES
(2, 'Esther and Atorise.', 'The book is written by Esther and Atorise', 0, '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `award`
--

DROP TABLE IF EXISTS `award`;
CREATE TABLE IF NOT EXISTS `award` (
  `award_id` int NOT NULL AUTO_INCREMENT,
  `award_code` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `gift` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `user_id` varchar(10) NOT NULL,
  `school_id` int NOT NULL,
  `session` varchar(20) NOT NULL,
  PRIMARY KEY (`award_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `award`
--

INSERT INTO `award` (`award_id`, `award_code`, `name`, `gift`, `amount`, `date`, `user_id`, `school_id`, `session`) VALUES
(2, '4675HD', 'Most Dedicated', 'Award', '1000', '2019-09-19', 'teacher-2', 0, '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bank`
--

DROP TABLE IF EXISTS `bank`;
CREATE TABLE IF NOT EXISTS `bank` (
  `bank_id` int NOT NULL AUTO_INCREMENT,
  `account_holder_name` varchar(31) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `account_number` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `bank_name` varchar(31) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `branch` varchar(31) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `school_id` int NOT NULL,
  `session` varchar(20) NOT NULL,
  PRIMARY KEY (`bank_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `bank`
--

INSERT INTO `bank` (`bank_id`, `account_holder_name`, `account_number`, `bank_name`, `branch`, `school_id`, `session`) VALUES
(2, 'Udemy Instructor', '1234567', 'Payoneer or paypal', 'USA', 0, ''),
(3, 'Udemy Instructor', '1234567', 'Payoneer or paypal', 'USA', 0, ''),
(4, 'Udemy Instructor', '1234567', 'Payoneer or paypal', 'USA', 0, ''),
(5, 'Udemy Instructor', '1234567', 'Payoneer or paypal', 'USA', 0, ''),
(6, 'Adelaidagu123', '185561213', 'Bancolombia', 'Bancolombia', 0, ''),
(7, 'asdsadasd', '5154213', 'Bancolombia', 'Ahorro', 0, ''),
(8, 'asdsadasd', '65456136', 'Bancolombia', 'Ahorro', 0, ''),
(9, 'account', '457912369', 'Bancolombia', 'Ahorro', 0, ''),
(10, 'account', '4512364', 'Davivienda', 'Ahorro', 0, ''),
(11, 'account', '4512364', 'Bancolombia', 'Ahorro', 0, ''),
(12, 'account', '65456136', 'Bancolombia', 'Ahorro', 0, '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `banner_table`
--

DROP TABLE IF EXISTS `banner_table`;
CREATE TABLE IF NOT EXISTS `banner_table` (
  `banner_id` int NOT NULL AUTO_INCREMENT,
  `banner_image` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `banner_text` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `school_id` int NOT NULL,
  `session` varchar(20) NOT NULL,
  PRIMARY KEY (`banner_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `banner_table`
--

INSERT INTO `banner_table` (`banner_id`, `banner_image`, `banner_text`, `school_id`, `session`) VALUES
(1, 'sample.jpg', '       Meet our able, gallant and most competent teachers that will help your children/child to attain higher success in life. We teach to become a creative thinker and to be useful to the society.....', 0, ''),
(2, 'sam2.jpg', 'Descubre cómo la música se convierte en armonía y melodía en nuestro colegio', 0, '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `book`
--

DROP TABLE IF EXISTS `book`;
CREATE TABLE IF NOT EXISTS `book` (
  `book_id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(31) NOT NULL,
  `description` varchar(200) NOT NULL,
  `author_id` int NOT NULL,
  `publisher_id` int NOT NULL,
  `book_category_id` int NOT NULL,
  `isbn` varchar(20) NOT NULL,
  `edition` varchar(20) NOT NULL,
  `subject_id` int NOT NULL,
  `quantity` int NOT NULL,
  `timestamp` int NOT NULL,
  `class_id` int NOT NULL,
  `status` int NOT NULL,
  `price` int NOT NULL,
  `school_id` int NOT NULL,
  `session` varchar(20) NOT NULL,
  PRIMARY KEY (`book_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `book`
--

INSERT INTO `book` (`book_id`, `name`, `description`, `author_id`, `publisher_id`, `book_category_id`, `isbn`, `edition`, `subject_id`, `quantity`, `timestamp`, `class_id`, `status`, `price`, `school_id`, `session`) VALUES
(1, 'Advance Java.', 'This is the newly released book by Sheg', 2, 1, 2, 'DS34FD', '1st', 5, 1, 1579370400, 2, 1, 200, 0, ''),
(2, 'Python', 'Python', 2, 1, 2, 'DS34FD', '1st', 4, 2, 1574186400, 2, 2, 500, 0, '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `book_category`
--

DROP TABLE IF EXISTS `book_category`;
CREATE TABLE IF NOT EXISTS `book_category` (
  `book_category_id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(31) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `school_id` int NOT NULL,
  `session` varchar(20) NOT NULL,
  PRIMARY KEY (`book_category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `book_category`
--

INSERT INTO `book_category` (`book_category_id`, `name`, `description`, `school_id`, `session`) VALUES
(2, 'Non fictional.', 'This is another non-fictional book', 0, '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `book_request`
--

DROP TABLE IF EXISTS `book_request`;
CREATE TABLE IF NOT EXISTS `book_request` (
  `book_request_id` int NOT NULL AUTO_INCREMENT,
  `book_id` int NOT NULL,
  `return_date` int NOT NULL,
  `request_date` int NOT NULL,
  `status` int NOT NULL,
  `student_id` int NOT NULL,
  `school_id` int NOT NULL,
  `session` varchar(20) NOT NULL,
  PRIMARY KEY (`book_request_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `book_request`
--

INSERT INTO `book_request` (`book_request_id`, `book_id`, `return_date`, `request_date`, `status`, `student_id`, `school_id`, `session`) VALUES
(2, 1, 1579716000, 1579716000, 2, 45, 0, ''),
(4, 1, 1697479200, 1695578400, 2, 1077451788, 0, '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `circular`
--

DROP TABLE IF EXISTS `circular`;
CREATE TABLE IF NOT EXISTS `circular` (
  `circular_id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(155) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `reference` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` varchar(155) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `school_id` int NOT NULL,
  `session` varchar(20) NOT NULL,
  PRIMARY KEY (`circular_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `circular`
--

INSERT INTO `circular` (`circular_id`, `title`, `reference`, `content`, `date`, `school_id`, `session`) VALUES
(2, 'Circular dirigida a toda la comunidad educativa de la institucion', 'DF46SFGH', 'Estimados alumnos, profesores y personal del colegio:\r\nEs un placer darles la bienvenida a este nuevo curso escolar. Esperamos que hayan disfrutado de unas', '2023-02-06', 0, '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ci_sessions`
--

DROP TABLE IF EXISTS `ci_sessions`;
CREATE TABLE IF NOT EXISTS `ci_sessions` (
  `id` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `ip_address` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `timestamp` int UNSIGNED NOT NULL DEFAULT '0',
  `data` blob NOT NULL,
  `school_id` int NOT NULL,
  `session` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  PRIMARY KEY (`id`),
  KEY `ci_sessions_timestamp` (`timestamp`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `ci_sessions`
--

INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`, `school_id`, `session`) VALUES
('0b95togtlv7fief8mlttlu8jcjmh9i8g', '127.0.0.1', 1580149963, 0x5f5f63695f6c6173745f726567656e65726174657c693a313538303134393936333b6c6f67696e5f747970657c733a353a2261646d696e223b61646d696e5f6c6f67696e7c623a313b61646d696e5f69647c733a313a2231223b6c6f67696e5f757365725f69647c733a313a2231223b7363686f6f6c5f69647c733a313a2230223b6e616d657c733a31333a2241646d696e6973747261746f72223b, 0, ''),
('0o55lsviqm8i8evg7i1164p53mkp4vup', '127.0.0.1', 1576400835, 0x5f5f63695f6c6173745f726567656e65726174657c693a313537363430303833353b6c6f67696e5f747970657c733a353a2261646d696e223b61646d696e5f6c6f67696e7c733a313a2231223b61646d696e5f69647c733a313a2238223b6c6f67696e5f757365725f69647c733a313a2238223b6e616d657c733a31333a2241646d696e6973747261746f72223b, 0, ''),
('2ufimsr9d2l1dv7a92mlj3reugfm99uh', '127.0.0.1', 1580151698, 0x5f5f63695f6c6173745f726567656e65726174657c693a313538303135313639383b6c6f67696e5f747970657c733a353a2261646d696e223b61646d696e5f6c6f67696e7c623a313b61646d696e5f69647c733a313a2231223b6c6f67696e5f757365725f69647c733a313a2231223b7363686f6f6c5f69647c733a313a2231223b6e616d657c733a31333a2241646d696e6973747261746f72223b, 0, ''),
('3g222s46b287jjd8ofllb190eu6uan2a', '127.0.0.1', 1580198069, 0x5f5f63695f6c6173745f726567656e65726174657c693a313538303139383034363b, 0, ''),
('3ugsbjsngkopbot3qs3ln2plta1r8fj4', '127.0.0.1', 1580142864, 0x5f5f63695f6c6173745f726567656e65726174657c693a313538303134323836343b6c6f67696e5f747970657c733a353a2261646d696e223b61646d696e5f6c6f67696e7c623a313b61646d696e5f69647c733a313a2231223b6c6f67696e5f757365725f69647c733a313a2231223b6e616d657c733a31333a2241646d696e6973747261746f72223b, 0, ''),
('4acm0tmki28r1ks7vh2slmchqekb8i51', '127.0.0.1', 1580134785, 0x5f5f63695f6c6173745f726567656e65726174657c693a313538303133343738353b6c6f67696e5f747970657c733a353a2261646d696e223b61646d696e5f6c6f67696e7c623a313b61646d696e5f69647c733a313a2231223b6c6f67696e5f757365725f69647c733a313a2231223b6e616d657c733a31333a2241646d696e6973747261746f72223b, 0, ''),
('4epqfrpppooeai89mbl0mnj47kd0k56n', '127.0.0.1', 1580197950, 0x5f5f63695f6c6173745f726567656e65726174657c693a313538303139373935303b, 0, ''),
('5k29uj9otbufutr4sl6sm1sgqajns7q3', '127.0.0.1', 1576401225, 0x5f5f63695f6c6173745f726567656e65726174657c693a313537363430313232353b6c6f67696e5f747970657c733a353a2261646d696e223b61646d696e5f6c6f67696e7c733a313a2231223b61646d696e5f69647c733a313a2238223b6c6f67696e5f757365725f69647c733a313a2238223b6e616d657c733a31333a2241646d696e6973747261746f72223b, 0, ''),
('5saecp39nggb7jbaifrfmb0hgtr2vtnh', '127.0.0.1', 1580135141, 0x5f5f63695f6c6173745f726567656e65726174657c693a313538303133353130303b6c6f67696e5f747970657c733a353a2261646d696e223b61646d696e5f6c6f67696e7c623a313b61646d696e5f69647c733a313a2231223b6c6f67696e5f757365725f69647c733a313a2231223b6e616d657c733a31333a2241646d696e6973747261746f72223b, 0, ''),
('6fuugjkndr9s9sehs6sdunr55df7of8e', '127.0.0.1', 1580150361, 0x5f5f63695f6c6173745f726567656e65726174657c693a313538303135303336313b6c6f67696e5f747970657c733a353a2261646d696e223b61646d696e5f6c6f67696e7c623a313b61646d696e5f69647c733a313a2231223b6c6f67696e5f757365725f69647c733a313a2231223b7363686f6f6c5f69647c733a313a2230223b6e616d657c733a31333a2241646d696e6973747261746f72223b, 0, ''),
('6im67b8kff8f9rs1e66r6splnqnsjgdj', '127.0.0.1', 1580143924, 0x5f5f63695f6c6173745f726567656e65726174657c693a313538303134333932343b, 0, ''),
('6qlbqi95gm56km49cioacibnpl1d6qap', '127.0.0.1', 1575989622, 0x5f5f63695f6c6173745f726567656e65726174657c693a313537353938393632323b, 0, ''),
('7k1ho15mjeg7u9lbsua6a6f0fl3okgf5', '127.0.0.1', 1575989675, 0x5f5f63695f6c6173745f726567656e65726174657c693a313537353938393637353b, 0, ''),
('8ch31n4ojv6t1m49v9mkk771lav20kf3', '127.0.0.1', 1580145703, 0x5f5f63695f6c6173745f726567656e65726174657c693a313538303134353730333b, 0, ''),
('8esqiumpgo03rthcimbnehv3b2e9bc2p', '127.0.0.1', 1575989062, 0x5f5f63695f6c6173745f726567656e65726174657c693a313537353938393036323b6c6f67696e5f747970657c733a353a2261646d696e223b61646d696e5f6c6f67696e7c733a313a2231223b61646d696e5f69647c733a313a2238223b6c6f67696e5f757365725f69647c733a313a2238223b6e616d657c733a31333a2241646d696e6973747261746f72223b, 0, ''),
('8o86nb7heqf8lkc69mve4nn7jds4vdqk', '127.0.0.1', 1580149325, 0x5f5f63695f6c6173745f726567656e65726174657c693a313538303134393332353b6c6f67696e5f747970657c733a353a2261646d696e223b61646d696e5f6c6f67696e7c623a313b61646d696e5f69647c733a313a2231223b6c6f67696e5f757365725f69647c733a313a2231223b7363686f6f6c5f69647c733a313a2230223b6e616d657c733a31333a2241646d696e6973747261746f72223b, 0, ''),
('d2uf1rm07jin7o0v77qt6j7eg3nvmnh7', '127.0.0.1', 1580133139, 0x5f5f63695f6c6173745f726567656e65726174657c693a313538303133333133393b6c6f67696e5f747970657c733a353a2261646d696e223b61646d696e5f6c6f67696e7c733a313a2231223b61646d696e5f69647c733a313a2231223b6c6f67696e5f757365725f69647c733a313a2231223b6e616d657c733a31333a2241646d696e6973747261746f72223b, 0, ''),
('d4ma7pisr50ilsg1f4gj6onhn03lkest', '127.0.0.1', 1580150998, 0x5f5f63695f6c6173745f726567656e65726174657c693a313538303135303939383b6c6f67696e5f747970657c733a353a2261646d696e223b61646d696e5f6c6f67696e7c623a313b61646d696e5f69647c733a313a2231223b6c6f67696e5f757365725f69647c733a313a2231223b7363686f6f6c5f69647c733a313a2230223b6e616d657c733a31333a2241646d696e6973747261746f72223b, 0, ''),
('e04jj0ac23c5a0r1ahco34m1s31tm203', '127.0.0.1', 1580196565, 0x5f5f63695f6c6173745f726567656e65726174657c693a313538303139363434313b, 0, ''),
('ea738lb5ik6v0kmm7dm2pbud27k02glr', '127.0.0.1', 1576397281, 0x5f5f63695f6c6173745f726567656e65726174657c693a313537363339373238313b6c6f67696e5f747970657c733a353a2261646d696e223b61646d696e5f6c6f67696e7c733a313a2231223b61646d696e5f69647c733a313a2238223b6c6f67696e5f757365725f69647c733a313a2238223b6e616d657c733a31333a2241646d696e6973747261746f72223b, 0, ''),
('eabpblg34h6fvvhr3s69uk2do8fsekng', '127.0.0.1', 1580151384, 0x5f5f63695f6c6173745f726567656e65726174657c693a313538303135313338343b6c6f67696e5f747970657c733a353a2261646d696e223b61646d696e5f6c6f67696e7c623a313b61646d696e5f69647c733a313a2231223b6c6f67696e5f757365725f69647c733a313a2231223b7363686f6f6c5f69647c733a313a2231223b6e616d657c733a31333a2241646d696e6973747261746f72223b, 0, ''),
('eei01td8856q3j4fj0uhmps08k0vkiel', '127.0.0.1', 1580132809, 0x5f5f63695f6c6173745f726567656e65726174657c693a313538303133323830393b6c6f67696e5f747970657c733a353a2261646d696e223b61646d696e5f6c6f67696e7c733a313a2231223b61646d696e5f69647c733a313a2231223b6c6f67696e5f757365725f69647c733a313a2231223b6e616d657c733a31333a2241646d696e6973747261746f72223b, 0, ''),
('eq1rl61eoblqth5bguakb048tc56dq6s', '127.0.0.1', 1580144226, 0x5f5f63695f6c6173745f726567656e65726174657c693a313538303134343232363b6c6f67696e5f747970657c733a353a2261646d696e223b61646d696e5f6c6f67696e7c623a313b61646d696e5f69647c733a313a2231223b6c6f67696e5f757365725f69647c733a313a2231223b6e616d657c733a31333a2241646d696e6973747261746f72223b666c6173685f6d6573736167657c733a31383a225375636365737366756c6c79204c6f67696e223b5f5f63695f766172737c613a313a7b733a31333a22666c6173685f6d657373616765223b733a333a226f6c64223b7d, 0, ''),
('fac5otroqnebqctd03003efvlsubhfm5', '127.0.0.1', 1580146285, 0x5f5f63695f6c6173745f726567656e65726174657c693a313538303134363238353b6c6f67696e5f747970657c733a353a2261646d696e223b61646d696e5f6c6f67696e7c623a313b61646d696e5f69647c733a313a2231223b6c6f67696e5f757365725f69647c733a313a2231223b6e616d657c733a31333a2241646d696e6973747261746f72223b, 0, ''),
('fofehi7eaeqj2bk5eit5ekp41gd147hi', '127.0.0.1', 1576397948, 0x5f5f63695f6c6173745f726567656e65726174657c693a313537363339373934383b6c6f67696e5f747970657c733a353a2261646d696e223b61646d696e5f6c6f67696e7c733a313a2231223b61646d696e5f69647c733a313a2238223b6c6f67696e5f757365725f69647c733a313a2238223b6e616d657c733a31333a2241646d696e6973747261746f72223b, 0, ''),
('ftnqt7kl410guj0fr4bpqmlim5vnjt49', '127.0.0.1', 1580152392, 0x5f5f63695f6c6173745f726567656e65726174657c693a313538303135323339323b, 0, ''),
('gvkpoe8jk1di4l5cj7a964sb35eid9te', '127.0.0.1', 1580140181, 0x5f5f63695f6c6173745f726567656e65726174657c693a313538303134303136303b, 0, ''),
('im9ufld1cfeaafkd5qtnnireqm3grrsq', '127.0.0.1', 1580142000, 0x5f5f63695f6c6173745f726567656e65726174657c693a313538303134323030303b6c6f67696e5f747970657c733a353a2261646d696e223b61646d696e5f6c6f67696e7c623a313b61646d696e5f69647c733a313a2231223b6c6f67696e5f757365725f69647c733a313a2231223b6e616d657c733a31333a2241646d696e6973747261746f72223b, 0, ''),
('iosktdb2q4b4lf37p2em2hemrpadn21j', '127.0.0.1', 1580152164, 0x5f5f63695f6c6173745f726567656e65726174657c693a313538303135323136343b6c6f67696e5f747970657c733a353a2261646d696e223b61646d696e5f6c6f67696e7c623a313b61646d696e5f69647c733a313a2231223b6c6f67696e5f757365725f69647c733a313a2231223b7363686f6f6c5f69647c733a313a2231223b6e616d657c733a31333a2241646d696e6973747261746f72223b, 0, ''),
('jjgc5umr0p2np4aneuua2t7tm89v1voj', '127.0.0.1', 1576239186, 0x5f5f63695f6c6173745f726567656e65726174657c693a313537363233393138363b6c6f67696e5f747970657c733a353a2261646d696e223b61646d696e5f6c6f67696e7c733a313a2231223b61646d696e5f69647c733a313a2238223b6c6f67696e5f757365725f69647c733a313a2238223b6e616d657c733a31333a2241646d696e6973747261746f72223b, 0, ''),
('k97ukhp6f9v8n4h9r92ifcomo3a7758c', '127.0.0.1', 1580135100, 0x5f5f63695f6c6173745f726567656e65726174657c693a313538303133353130303b6c6f67696e5f747970657c733a353a2261646d696e223b61646d696e5f6c6f67696e7c623a313b61646d696e5f69647c733a313a2231223b6c6f67696e5f757365725f69647c733a313a2231223b6e616d657c733a31333a2241646d696e6973747261746f72223b, 0, ''),
('l1e17mk7cdg71do9qouos1q5249fetn7', '127.0.0.1', 1576239187, 0x5f5f63695f6c6173745f726567656e65726174657c693a313537363233393138373b, 0, ''),
('l46es3qrhtcgi7kcc8daopocsam1knfg', '127.0.0.1', 1576401563, 0x5f5f63695f6c6173745f726567656e65726174657c693a313537363430313536333b6c6f67696e5f747970657c733a353a2261646d696e223b61646d696e5f6c6f67696e7c733a313a2231223b61646d696e5f69647c733a313a2238223b6c6f67696e5f757365725f69647c733a313a2238223b6e616d657c733a31333a2241646d696e6973747261746f72223b, 0, ''),
('m9sj7su5id61c0rfj53c718pqrbt4hq6', '127.0.0.1', 1576396972, 0x5f5f63695f6c6173745f726567656e65726174657c693a313537363339363937323b6c6f67696e5f747970657c733a353a2261646d696e223b61646d696e5f6c6f67696e7c733a313a2231223b61646d696e5f69647c733a313a2238223b6c6f67696e5f757365725f69647c733a313a2238223b6e616d657c733a31333a2241646d696e6973747261746f72223b666c6173685f6d6573736167657c733a31383a225375636365737366756c6c79204c6f67696e223b5f5f63695f766172737c613a313a7b733a31333a22666c6173685f6d657373616765223b733a333a226f6c64223b7d, 0, ''),
('meplpbi7pgntsb4qv37j8qcmj3lui8e9', '127.0.0.1', 1580132495, 0x5f5f63695f6c6173745f726567656e65726174657c693a313538303133323439353b6c6f67696e5f747970657c733a353a2261646d696e223b61646d696e5f6c6f67696e7c733a313a2231223b61646d696e5f69647c733a313a2231223b6c6f67696e5f757365725f69647c733a313a2231223b6e616d657c733a31333a2241646d696e6973747261746f72223b, 0, ''),
('ndto2l4cv384prfveod69n5duullmo4o', '127.0.0.1', 1576401722, 0x5f5f63695f6c6173745f726567656e65726174657c693a313537363430313732323b, 0, ''),
('nlsv86sund074adiho5j6lgpau6mkha4', '127.0.0.1', 1580144529, 0x5f5f63695f6c6173745f726567656e65726174657c693a313538303134343532393b6c6f67696e5f747970657c733a353a2261646d696e223b61646d696e5f6c6f67696e7c623a313b61646d696e5f69647c733a313a2231223b6c6f67696e5f757365725f69647c733a313a2231223b6e616d657c733a31333a2241646d696e6973747261746f72223b, 0, ''),
('pe1j2egh567gfcr07nu9tnm8ukj7ma83', '127.0.0.1', 1580134458, 0x5f5f63695f6c6173745f726567656e65726174657c693a313538303133343435383b, 0, ''),
('pk4m8lpu6igmqgieqnm547i4q2h99gud', '127.0.0.1', 1575988659, 0x5f5f63695f6c6173745f726567656e65726174657c693a313537353938383635393b6c6f67696e5f747970657c733a353a2261646d696e223b61646d696e5f6c6f67696e7c733a313a2231223b61646d696e5f69647c733a313a2238223b6c6f67696e5f757365725f69647c733a313a2238223b6e616d657c733a31333a2241646d696e6973747261746f72223b, 0, ''),
('qhcrmmb8gppl38vmtu8jd806a7l0oksa', '127.0.0.1', 1575989414, 0x5f5f63695f6c6173745f726567656e65726174657c693a313537353938393431343b6c6f67696e5f747970657c733a353a2261646d696e223b61646d696e5f6c6f67696e7c733a313a2231223b61646d696e5f69647c733a313a2238223b6c6f67696e5f757365725f69647c733a313a2238223b6e616d657c733a31333a2241646d696e6973747261746f72223b, 0, ''),
('qhn13rfd38a69mgt1tmtanlsjq9fbbft', '127.0.0.1', 1580197042, 0x5f5f63695f6c6173745f726567656e65726174657c693a313538303139373034323b, 0, ''),
('r20i0a41mmc9gh253p7nljk2h4srv77u', '127.0.0.1', 1580196441, 0x5f5f63695f6c6173745f726567656e65726174657c693a313538303139363434313b6c6f67696e5f747970657c733a353a2261646d696e223b61646d696e5f6c6f67696e7c623a313b61646d696e5f69647c733a313a2231223b6c6f67696e5f757365725f69647c733a313a2231223b7363686f6f6c5f69647c733a313a2231223b6e616d657c733a31333a2241646d696e6973747261746f72223b666c6173685f6d6573736167657c733a31383a225375636365737366756c6c79204c6f67696e223b5f5f63695f766172737c613a313a7b733a31333a22666c6173685f6d657373616765223b733a333a226f6c64223b7d, 0, ''),
('rmfhfvjo4ef5f1tked46rpgesjg9qt2d', '127.0.0.1', 1580142313, 0x5f5f63695f6c6173745f726567656e65726174657c693a313538303134323331333b6c6f67696e5f747970657c733a353a2261646d696e223b61646d696e5f6c6f67696e7c623a313b61646d696e5f69647c733a313a2231223b6c6f67696e5f757365725f69647c733a313a2231223b6e616d657c733a31333a2241646d696e6973747261746f72223b, 0, ''),
('rphh8b2kjmqvjhqfkd0ga0otd0u9c283', '127.0.0.1', 1580148728, 0x5f5f63695f6c6173745f726567656e65726174657c693a313538303134383732383b, 0, ''),
('s13biocd47pn1ahjppg6fa37vnsuq608', '127.0.0.1', 1580147431, 0x5f5f63695f6c6173745f726567656e65726174657c693a313538303134373433313b6c6f67696e5f747970657c733a353a2261646d696e223b61646d696e5f6c6f67696e7c623a313b61646d696e5f69647c733a313a2231223b6c6f67696e5f757365725f69647c733a313a2231223b6e616d657c733a31333a2241646d696e6973747261746f72223b, 0, ''),
('sg07lpdss70ie7gm42cu3oejlpnorlpv', '127.0.0.1', 1580146940, 0x5f5f63695f6c6173745f726567656e65726174657c693a313538303134363934303b6c6f67696e5f747970657c733a353a2261646d696e223b61646d696e5f6c6f67696e7c623a313b61646d696e5f69647c733a313a2231223b6c6f67696e5f757365725f69647c733a313a2231223b6e616d657c733a31333a2241646d696e6973747261746f72223b, 0, ''),
('va552nqf2us2ta7nm0vlkol6qpjate8t', '127.0.0.1', 1580149648, 0x5f5f63695f6c6173745f726567656e65726174657c693a313538303134393634383b6c6f67696e5f747970657c733a353a2261646d696e223b61646d696e5f6c6f67696e7c623a313b61646d696e5f69647c733a313a2231223b6c6f67696e5f757365725f69647c733a313a2231223b7363686f6f6c5f69647c733a313a2230223b6e616d657c733a31333a2241646d696e6973747261746f72223b, 0, ''),
('vjolml4hvc7u0g6aug66qjsugegh8c2c', '127.0.0.1', 1580144853, 0x5f5f63695f6c6173745f726567656e65726174657c693a313538303134343835333b6c6f67696e5f747970657c733a353a2261646d696e223b61646d696e5f6c6f67696e7c623a313b61646d696e5f69647c733a313a2231223b6c6f67696e5f757365725f69647c733a313a2231223b6e616d657c733a31333a2241646d696e6973747261746f72223b, 0, '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `class`
--

DROP TABLE IF EXISTS `class`;
CREATE TABLE IF NOT EXISTS `class` (
  `class_id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(31) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name_numeric` varchar(31) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `teacher_id` int NOT NULL,
  `school_id` int NOT NULL,
  `session` varchar(20) NOT NULL,
  PRIMARY KEY (`class_id`),
  KEY `fk_teacher_class` (`teacher_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `class`
--

INSERT INTO `class` (`class_id`, `name`, `name_numeric`, `teacher_id`, `school_id`, `session`) VALUES
(2, 'Once uno', '11-01', 12456781, 0, ''),
(3, 'Once dos', '11-02', 61254632, 0, '');

--
-- Disparadores `class`
--
DROP TRIGGER IF EXISTS `prevent_duplicate_class_name`;
DELIMITER $$
CREATE TRIGGER `prevent_duplicate_class_name` BEFORE INSERT ON `class` FOR EACH ROW BEGIN
    DECLARE class_count INT;

    -- Verificar si el campo 'name' ya existe en la tabla para otro docente
    SELECT COUNT(*) INTO class_count FROM class WHERE name = NEW.name AND teacher_id = NEW.teacher_id;
    
    -- Verificar si el campo 'name_numeric' ya existe en la tabla para otro docente
    IF class_count > 0 OR EXISTS (SELECT 1 FROM class WHERE name_numeric = NEW.name_numeric AND teacher_id = NEW.teacher_id) THEN
        SIGNAL SQLSTATE '45002'
        SET MESSAGE_TEXT = 'El nombre o el número de clase ya existe para este docente';
    END IF;
END
$$
DELIMITER ;
DROP TRIGGER IF EXISTS `prevent_update_duplicate_class_name`;
DELIMITER $$
CREATE TRIGGER `prevent_update_duplicate_class_name` BEFORE UPDATE ON `class` FOR EACH ROW BEGIN
    DECLARE class_count INT;

    -- Verificar si el campo 'name' ya existe en otro registro de la tabla para otro docente
    SELECT COUNT(*) INTO class_count FROM class WHERE name = NEW.name AND teacher_id = NEW.teacher_id AND class_id <> NEW.class_id;
    
    -- Verificar si el campo 'name_numeric' ya existe en otro registro de la tabla para otro docente
    IF class_count > 0 OR EXISTS (SELECT 1 FROM class WHERE name_numeric = NEW.name_numeric AND teacher_id = NEW.teacher_id AND class_id <> NEW.class_id) THEN
        SIGNAL SQLSTATE '45002'
        SET MESSAGE_TEXT = 'El nombre o el número de clase ya existe en otro registro para este docente';
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `class_routine`
--

DROP TABLE IF EXISTS `class_routine`;
CREATE TABLE IF NOT EXISTS `class_routine` (
  `class_routine_id` int NOT NULL AUTO_INCREMENT,
  `class_id` int NOT NULL,
  `section_id` int NOT NULL,
  `subject_id` int NOT NULL,
  `time_start` int NOT NULL,
  `time_end` int NOT NULL,
  `time_start_min` int NOT NULL,
  `time_end_min` int NOT NULL,
  `day` varchar(15) NOT NULL,
  `year` varchar(20) NOT NULL,
  `school_id` int NOT NULL,
  `session` varchar(20) NOT NULL,
  PRIMARY KEY (`class_routine_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `class_routine`
--

INSERT INTO `class_routine` (`class_routine_id`, `class_id`, `section_id`, `subject_id`, `time_start`, `time_end`, `time_start_min`, `time_end_min`, `day`, `year`, `school_id`, `session`) VALUES
(5, 2, 3, 4, 3, 17, 20, 20, 'monday', '2019-2020', 0, '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `club`
--

DROP TABLE IF EXISTS `club`;
CREATE TABLE IF NOT EXISTS `club` (
  `club_id` int NOT NULL AUTO_INCREMENT,
  `club_name` varchar(31) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `desc` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `school_id` int NOT NULL,
  `se` varchar(20) NOT NULL,
  PRIMARY KEY (`club_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `club`
--

INSERT INTO `club` (`club_id`, `club_name`, `desc`, `date`, `school_id`, `se`) VALUES
(1, 'Jet club', 'This is for those who love science.', '2019-08-25', 0, '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contact_table`
--

DROP TABLE IF EXISTS `contact_table`;
CREATE TABLE IF NOT EXISTS `contact_table` (
  `contact_id` int NOT NULL AUTO_INCREMENT,
  `visitor_name` varchar(31) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `visitor_email` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `visitor_content` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `school_id` int NOT NULL,
  `session` varchar(20) NOT NULL,
  PRIMARY KEY (`contact_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `contact_table`
--

INSERT INTO `contact_table` (`contact_id`, `visitor_name`, `visitor_email`, `visitor_content`, `school_id`, `session`) VALUES
(1, 'Sheg', 'optimumproblemsolver@gmail.com', 'Just want to know more about your school payment.', 0, ''),
(2, '', '', '', 0, '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `department`
--

DROP TABLE IF EXISTS `department`;
CREATE TABLE IF NOT EXISTS `department` (
  `department_id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(31) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `department_code` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `school_id` int NOT NULL,
  `session` varchar(20) NOT NULL,
  PRIMARY KEY (`department_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `department`
--

INSERT INTO `department` (`department_id`, `name`, `department_code`, `school_id`, `session`) VALUES
(2, 'Bursar', 'aed7c689d676c7c', 0, '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `designation`
--

DROP TABLE IF EXISTS `designation`;
CREATE TABLE IF NOT EXISTS `designation` (
  `designation_id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(31) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `department_id` int NOT NULL,
  `school_id` int NOT NULL,
  `session` varchar(20) NOT NULL,
  PRIMARY KEY (`designation_id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `designation`
--

INSERT INTO `designation` (`designation_id`, `name`, `department_id`, `school_id`, `session`) VALUES
(4, 'Udemy', 2, 0, ''),
(5, 'Tutorial', 2, 0, ''),
(6, 'Student', 2, 0, '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dormitory`
--

DROP TABLE IF EXISTS `dormitory`;
CREATE TABLE IF NOT EXISTS `dormitory` (
  `dormitory_id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(31) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `hostel_room_id` int NOT NULL,
  `hostel_category_id` int NOT NULL,
  `capacity` int NOT NULL,
  `address` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `school_id` int NOT NULL,
  `session` varchar(20) NOT NULL,
  PRIMARY KEY (`dormitory_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `dormitory`
--

INSERT INTO `dormitory` (`dormitory_id`, `name`, `hostel_room_id`, `hostel_category_id`, `capacity`, `address`, `description`, `school_id`, `session`) VALUES
(2, 'Wiz Hostel', 2, 3, 200, 'Address for hostel location', 'Address for hostel location', 0, '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `enquiry`
--

DROP TABLE IF EXISTS `enquiry`;
CREATE TABLE IF NOT EXISTS `enquiry` (
  `enquiry_id` int NOT NULL AUTO_INCREMENT,
  `category` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `purpose` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `whom_to_meet` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` timestamp NOT NULL,
  `school_id` int NOT NULL,
  `session` varchar(20) NOT NULL,
  PRIMARY KEY (`enquiry_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `enquiry_category`
--

DROP TABLE IF EXISTS `enquiry_category`;
CREATE TABLE IF NOT EXISTS `enquiry_category` (
  `enquiry_category_id` int NOT NULL AUTO_INCREMENT,
  `category` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `purpose` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `whom` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `school_id` int NOT NULL,
  `session` varchar(20) NOT NULL,
  PRIMARY KEY (`enquiry_category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `enquiry_category`
--

INSERT INTO `enquiry_category` (`enquiry_category_id`, `category`, `purpose`, `whom`, `school_id`, `session`) VALUES
(3, 'This is for ID 3 information.', 'Payment', 'Tutorial', 0, ''),
(4, 'This is Udemy Information', 'School fees information', 'Just edited now', 0, '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `exam`
--

DROP TABLE IF EXISTS `exam`;
CREATE TABLE IF NOT EXISTS `exam` (
  `exam_id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(31) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `comment` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `timestamp` date NOT NULL,
  `school_id` int NOT NULL,
  `session` varchar(20) NOT NULL,
  PRIMARY KEY (`exam_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `exam`
--

INSERT INTO `exam` (`exam_id`, `name`, `comment`, `timestamp`, `school_id`, `session`) VALUES
(1, 'Calificaciones año 2023', 'Calificaciones', '2023-11-30', 0, '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `exam_question`
--

DROP TABLE IF EXISTS `exam_question`;
CREATE TABLE IF NOT EXISTS `exam_question` (
  `exam_question_id` int NOT NULL AUTO_INCREMENT,
  `name` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `teacher_id` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `subject_id` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `class_id` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_name` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_type` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `timestamp` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `school_id` int NOT NULL,
  `session` longtext NOT NULL,
  PRIMARY KEY (`exam_question_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `expense_category`
--

DROP TABLE IF EXISTS `expense_category`;
CREATE TABLE IF NOT EXISTS `expense_category` (
  `expense_category_id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(31) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `school_id` int NOT NULL,
  `session` varchar(20) NOT NULL,
  PRIMARY KEY (`expense_category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `expense_category`
--

INSERT INTO `expense_category` (`expense_category_id`, `name`, `school_id`, `session`) VALUES
(5, 'Reading Books.', 0, '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `general_message`
--

DROP TABLE IF EXISTS `general_message`;
CREATE TABLE IF NOT EXISTS `general_message` (
  `general_message_id` int NOT NULL AUTO_INCREMENT,
  `message` varchar(200) NOT NULL,
  `user_id` varchar(50) NOT NULL,
  `school_id` int NOT NULL,
  `session` varchar(20) NOT NULL,
  PRIMARY KEY (`general_message_id`)
) ENGINE=InnoDB AUTO_INCREMENT=213 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `general_message`
--

INSERT INTO `general_message` (`general_message_id`, `message`, `user_id`, `school_id`, `session`) VALUES
(1, 'Hey cool man, are you there to chat with me', 'admin-1', 0, ''),
(2, 'hey', 'admin-1', 0, ''),
(3, 'ok', 'student-45', 0, ''),
(4, 'hey', 'admin-1', 0, ''),
(5, 'am here all the time sir', 'student-45', 0, ''),
(6, 'I am the admin', 'admin-1', 0, ''),
(7, 'This is the student page sir', 'student-45', 0, ''),
(8, 'Hola', 'admin-1', 0, '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `group_message`
--

DROP TABLE IF EXISTS `group_message`;
CREATE TABLE IF NOT EXISTS `group_message` (
  `group_message_id` int NOT NULL AUTO_INCREMENT,
  `group_message_thread_code` longtext,
  `sender` longtext,
  `message` longtext,
  `timestamp` longtext,
  `read_status` int DEFAULT NULL,
  `attached_file_name` longtext,
  PRIMARY KEY (`group_message_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `group_message_thread`
--

DROP TABLE IF EXISTS `group_message_thread`;
CREATE TABLE IF NOT EXISTS `group_message_thread` (
  `group_message_thread_id` int NOT NULL AUTO_INCREMENT,
  `group_message_thread_code` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `members` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `group_name` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `last_message_timestamp` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `created_timestamp` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `school_id` int NOT NULL,
  PRIMARY KEY (`group_message_thread_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `hostel`
--

DROP TABLE IF EXISTS `hostel`;
CREATE TABLE IF NOT EXISTS `hostel` (
  `hostel_id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(31) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `hostel_number` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `birthday` date NOT NULL,
  `sex` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `religion` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `blood_group` varchar(5) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `address` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `phone` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `email` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `facebook` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `twitter` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `googleplus` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `linkedin` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `qualification` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `marital_status` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `file_name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `password` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `login_status` int NOT NULL,
  `school_id` int NOT NULL,
  `session` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  PRIMARY KEY (`hostel_id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `hostel`
--

INSERT INTO `hostel` (`hostel_id`, `name`, `hostel_number`, `birthday`, `sex`, `religion`, `blood_group`, `address`, `phone`, `email`, `facebook`, `twitter`, `googleplus`, `linkedin`, `qualification`, `marital_status`, `file_name`, `password`, `login_status`, `school_id`, `session`) VALUES
(15, 'Hostel Udemy', '78e39debb4', '2019-08-27', 'Male', 'Muslim', 'o+', 'This is the new address for the new hostel manager.', '+912345667', 'hostel@hostel.com', 'facebook', 'twitter', 'googleplus', 'linkedin', 'PhD', 'Married', 'Welcome to Optimum Linkup.docx', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 0, 0, '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `hostel_category`
--

DROP TABLE IF EXISTS `hostel_category`;
CREATE TABLE IF NOT EXISTS `hostel_category` (
  `hostel_category_id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(31) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `school_id` int NOT NULL,
  `session` varchar(20) NOT NULL,
  PRIMARY KEY (`hostel_category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `hostel_category`
--

INSERT INTO `hostel_category` (`hostel_category_id`, `name`, `description`, `school_id`, `session`) VALUES
(2, 'Female', 'This is for female only.', 0, ''),
(3, 'Male', 'This is for male only. Female are not allowed.', 0, '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `hostel_room`
--

DROP TABLE IF EXISTS `hostel_room`;
CREATE TABLE IF NOT EXISTS `hostel_room` (
  `hostel_room_id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(31) NOT NULL,
  `room_type` varchar(10) NOT NULL,
  `num_bed` int NOT NULL,
  `cost_bed` int NOT NULL,
  `description` varchar(200) NOT NULL,
  `school_id` int NOT NULL,
  `session` varchar(20) NOT NULL,
  PRIMARY KEY (`hostel_room_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `hostel_room`
--

INSERT INTO `hostel_room` (`hostel_room_id`, `name`, `room_type`, `num_bed`, `cost_bed`, `description`, `school_id`, `session`) VALUES
(2, 'Room One', 'Single', 2, 5000, 'This is for the big guys among us.', 0, '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `house`
--

DROP TABLE IF EXISTS `house`;
CREATE TABLE IF NOT EXISTS `house` (
  `house_id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(31) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `school_id` int NOT NULL,
  `session` varchar(20) NOT NULL,
  PRIMARY KEY (`house_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `house`
--

INSERT INTO `house` (`house_id`, `name`, `description`, `school_id`, `session`) VALUES
(1, 'Purple House', 'This is for students in purple house', 0, '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `hrm`
--

DROP TABLE IF EXISTS `hrm`;
CREATE TABLE IF NOT EXISTS `hrm` (
  `hrm_id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(31) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `hrm_number` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `birthday` date NOT NULL,
  `sex` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `religion` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `blood_group` varchar(3) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `facebook` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `twitter` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `googleplus` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `linkedin` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `qualification` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `marital_status` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `login_status` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `school_id` int NOT NULL,
  `session` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`hrm_id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `hrm`
--

INSERT INTO `hrm` (`hrm_id`, `name`, `hrm_number`, `birthday`, `sex`, `religion`, `blood_group`, `address`, `phone`, `email`, `facebook`, `twitter`, `googleplus`, `linkedin`, `qualification`, `marital_status`, `file_name`, `password`, `login_status`, `school_id`, `session`) VALUES
(15, 'Human Udemy', '414bbf2d2a', '2019-08-27', 'Male', 'Christianity', 'B+', 'This is the newly added human resources manager address', '+912345667', 'hrm@hrm.com', 'facebook', 'twitter', 'googleplus', 'linkedin', 'PhD', 'Married', 'index.html', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', '0', 0, '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `invoice`
--

DROP TABLE IF EXISTS `invoice`;
CREATE TABLE IF NOT EXISTS `invoice` (
  `invoice_id` int NOT NULL AUTO_INCREMENT,
  `invoice_number` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `student_id` int NOT NULL,
  `title` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `description` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `amount` int NOT NULL,
  `discount` int NOT NULL,
  `amount_paid` int NOT NULL,
  `due` int NOT NULL,
  `creation_timestamp` date NOT NULL,
  `payment_method` int NOT NULL,
  `status` int NOT NULL,
  `year` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `school_id` int NOT NULL,
  PRIMARY KEY (`invoice_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `invoice`
--

INSERT INTO `invoice` (`invoice_id`, `invoice_number`, `student_id`, `title`, `description`, `amount`, `discount`, `amount_paid`, `due`, `creation_timestamp`, `payment_method`, `status`, `year`, `school_id`) VALUES
(2, '742593INV2019', 45, 'Another Part payment for eLibrary', 'Another Part payment for eLibrary.', 7000, 0, 6200, 800, '2019-11-12', 1, 2, '2019-2020', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `language`
--

DROP TABLE IF EXISTS `language`;
CREATE TABLE IF NOT EXISTS `language` (
  `phrase_id` int NOT NULL AUTO_INCREMENT,
  `phrase` longtext CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `english` longtext CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci,
  `arabic` longtext CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci,
  `french` longtext CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci,
  `korea` longtext CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci,
  `blabla` longtext CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci,
  PRIMARY KEY (`phrase_id`)
) ENGINE=MyISAM AUTO_INCREMENT=40559 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Volcado de datos para la tabla `language`
--

INSERT INTO `language` (`phrase_id`, `phrase`, `english`, `arabic`, `french`, `korea`, `blabla`) VALUES
(1, 'Manage Language', 'Manage Language', 'إدارة اللغة', NULL, NULL, NULL),
(2, 'active language', 'Active Language', 'اللغة النشطة', NULL, NULL, NULL),
(40558, 'dashboard', 'Dashboard', '', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `language_list`
--

DROP TABLE IF EXISTS `language_list`;
CREATE TABLE IF NOT EXISTS `language_list` (
  `language_list_id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(500) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `db_field` varchar(300) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`language_list_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `language_list`
--

INSERT INTO `language_list` (`language_list_id`, `name`, `db_field`, `status`) VALUES
(1, 'English', 'english', 'ok'),
(2, 'Arabic', 'arabic', 'ok');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `leave`
--

DROP TABLE IF EXISTS `leave`;
CREATE TABLE IF NOT EXISTS `leave` (
  `leave_id` int NOT NULL AUTO_INCREMENT,
  `leave_code` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `teacher_id` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `start_date` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `end_date` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `reason` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `session` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `school_id` int NOT NULL,
  PRIMARY KEY (`leave_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `librarian`
--

DROP TABLE IF EXISTS `librarian`;
CREATE TABLE IF NOT EXISTS `librarian` (
  `librarian_id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(31) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `librarian_number` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `birthday` date NOT NULL,
  `sex` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `religion` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `blood_group` varchar(3) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `address` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `phone` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `email` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `facebook` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `twitter` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `googleplus` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `linkedin` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `qualification` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `marital_status` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `file_name` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `password` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `login_status` varchar(3) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `school_id` int NOT NULL,
  `session` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  PRIMARY KEY (`librarian_id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `librarian`
--

INSERT INTO `librarian` (`librarian_id`, `name`, `librarian_number`, `birthday`, `sex`, `religion`, `blood_group`, `address`, `phone`, `email`, `facebook`, `twitter`, `googleplus`, `linkedin`, `qualification`, `marital_status`, `file_name`, `password`, `login_status`, `school_id`, `session`) VALUES
(13, 'Udemy Librarian', '42ed75d802', '2019-08-26', 'Male', 'Muslim', 'O-', 'Address', '+912345667', 'librarian@librarian.com', 'facebook', 'twitter', 'googleplus', 'linkedin', 'PhD', 'Married', 'invoice.docx', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', '0', 0, '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mark`
--

DROP TABLE IF EXISTS `mark`;
CREATE TABLE IF NOT EXISTS `mark` (
  `mark_id` int NOT NULL AUTO_INCREMENT,
  `student_id` int NOT NULL,
  `subject_id` int NOT NULL,
  `exam_id` int NOT NULL,
  `class_id` int NOT NULL,
  `class_score1` decimal(5,1) DEFAULT NULL,
  `class_score2` decimal(5,1) DEFAULT NULL,
  `class_score3` decimal(5,1) DEFAULT NULL,
  `exam_score` decimal(5,1) DEFAULT NULL,
  `comment` varchar(500) NOT NULL,
  `school_id` int NOT NULL,
  `session` varchar(30) NOT NULL,
  PRIMARY KEY (`mark_id`),
  KEY `fk_student_mark` (`student_id`),
  KEY `fk_subject_mark` (`subject_id`),
  KEY `fk_class_mark` (`class_id`)
) ENGINE=MyISAM AUTO_INCREMENT=42 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `mark`
--

INSERT INTO `mark` (`mark_id`, `student_id`, `subject_id`, `exam_id`, `class_id`, `class_score1`, `class_score2`, `class_score3`, `exam_score`, `comment`, `school_id`, `session`) VALUES
(1, 45, 5, 1, 2, '5.0', '2.5', '3.5', '5.0', 'Good performance.', 0, ''),
(2, 45, 4, 1, 2, '4.5', '4.1', '1.5', '2.5', 'Excellent performance.', 0, ''),
(3, 46, 5, 1, 2, '4.0', '3.0', '3.0', '5.0', 'good', 0, ''),
(4, 46, 4, 1, 2, '1.0', '4.5', '2.0', '5.0', '', 0, ''),
(5, 0, 5, 1, 2, '0.0', '0.0', '0.0', '0.0', '', 0, ''),
(6, 0, 4, 1, 2, '0.0', '0.0', '0.0', '0.0', '', 0, ''),
(7, 45, 5, 3, 2, '9.0', '9.0', '9.0', '70.0', 'xd', 0, ''),
(8, 45, 4, 3, 2, '5.0', '4.0', '9.0', '60.0', 'bien', 0, ''),
(9, 0, 5, 3, 2, '0.0', '0.0', '0.0', '0.0', '', 0, ''),
(10, 0, 4, 3, 2, '0.0', '0.0', '0.0', '0.0', '', 0, ''),
(11, 46, 5, 3, 2, '0.0', '0.0', '0.0', '0.0', '', 0, ''),
(12, 46, 4, 3, 2, '0.0', '0.0', '0.0', '0.0', '', 0, ''),
(13, 45, 0, 1, 2, '0.0', '0.0', '0.0', '0.0', '', 0, ''),
(14, 46, 0, 1, 2, '0.0', '0.0', '0.0', '0.0', '', 0, ''),
(15, 47, 6, 1, 3, '5.0', '1.5', '2.8', '4.5', 'Mejorar la disciplina', 0, ''),
(16, 47, 0, 1, 3, NULL, NULL, NULL, NULL, '', 0, ''),
(17, 0, 6, 1, 3, NULL, NULL, NULL, NULL, '', 0, ''),
(18, 1077451788, 5, 1, 2, '4.5', '3.2', '2.5', '3.7', 'Buen trabajo', 0, ''),
(19, 1070457127, 4, 1, 2, '4.0', '3.0', '2.5', '1.8', '', 0, ''),
(20, 1077451788, 4, 1, 2, '5.0', '3.6', '2.8', '4.6', '', 0, ''),
(21, 1070457127, 0, 1, 2, NULL, NULL, NULL, NULL, '', 0, ''),
(22, 1077451788, 0, 1, 2, NULL, NULL, NULL, NULL, '', 0, ''),
(23, 1003145752, 6, 1, 3, '4.5', '5.0', '4.2', '3.0', 'Buen desempeño', 0, ''),
(24, 1003145752, 0, 1, 3, NULL, NULL, NULL, NULL, '', 0, ''),
(25, 1004152463, 6, 1, 3, '1.5', '2.8', '3.5', '4.0', 'Regular', 0, ''),
(26, 1070457127, 5, 1, 2, '2.5', '4.5', '3.7', '3.5', 'Puede mejorar', 0, ''),
(27, 1004152463, 0, 1, 3, NULL, NULL, NULL, NULL, '', 0, ''),
(28, 1070457127, 9, 1, 2, '1.0', '2.5', '3.2', '4.0', 'Pudo ser mejor', 0, ''),
(29, 0, 9, 1, 2, NULL, NULL, NULL, NULL, '', 0, ''),
(30, 1077451788, 9, 1, 2, '5.0', '4.5', '3.8', '3.9', 'Excelente estudiante', 0, ''),
(31, 1003145752, 8, 1, 3, '4.2', '3.0', '2.0', '1.0', '', 0, ''),
(32, 1004152463, 8, 1, 3, '4.5', '4.0', '1.8', '3.9', 'Buena estudiante, pero puede mejorar', 0, ''),
(33, 1004152463, 10, 1, 3, '3.6', '4.2', '5.0', '2.9', 'Regular', 0, ''),
(34, 1003412785, 5, 1, 2, '1.0', '4.0', '5.0', '3.0', 'nose', 0, ''),
(35, 1003412785, 0, 1, 2, NULL, NULL, NULL, NULL, '', 0, ''),
(36, 1003412785, 4, 1, 2, '3.0', '4.0', '4.5', '2.8', '', 0, ''),
(37, 1003412785, 9, 1, 2, '5.0', '5.0', '5.0', '1.9', '', 0, ''),
(38, 107541263, 10, 1, 3, '3.0', '4.0', '5.0', '1.0', '', 0, ''),
(39, 107541263, 0, 1, 3, NULL, NULL, NULL, NULL, '', 0, ''),
(40, 107541263, 6, 1, 3, '4.0', '4.0', '1.0', '3.8', '', 0, ''),
(41, 107541263, 8, 1, 3, '4.2', '5.0', '1.8', '3.0', '', 0, '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `material`
--

DROP TABLE IF EXISTS `material`;
CREATE TABLE IF NOT EXISTS `material` (
  `material_id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(31) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `class_id` int NOT NULL,
  `subject_id` int NOT NULL,
  `teacher_id` int NOT NULL,
  `description` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_type` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `timestamp` date NOT NULL,
  `school_id` int NOT NULL,
  `session` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`material_id`),
  KEY `fk_teacher_material` (`teacher_id`),
  KEY `fk_subject_material` (`subject_id`),
  KEY `fk_class_material` (`class_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `material`
--

INSERT INTO `material` (`material_id`, `name`, `class_id`, `subject_id`, `teacher_id`, `description`, `file_name`, `file_type`, `timestamp`, `school_id`, `session`) VALUES
(4, 'Principios de economia', 2, 5, 12456781, 'Texto para estudiar', 'Dialnet-ConceptosYPrincipiosDeEconomiaYMetodologia', 'pdf', '2023-09-23', 0, ''),
(6, 'Economia para no economistas', 2, 5, 12456781, 'Libro fundamental para la asignatura', 'Student MarksCOLEGIO SALESIANO.pdf', 'pdf', '2023-09-29', 0, '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `message`
--

DROP TABLE IF EXISTS `message`;
CREATE TABLE IF NOT EXISTS `message` (
  `message_id` int NOT NULL AUTO_INCREMENT,
  `message_thread_code` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `sender` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `timestamp` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `read_status` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `attached_file_name` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `school_id` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`message_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `message_thread`
--

DROP TABLE IF EXISTS `message_thread`;
CREATE TABLE IF NOT EXISTS `message_thread` (
  `message_thread_id` int NOT NULL AUTO_INCREMENT,
  `message_thread_code` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `sender` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `reciever` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `last_message_timestamp` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `school_id` int NOT NULL,
  PRIMARY KEY (`message_thread_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `noticeboard`
--

DROP TABLE IF EXISTS `noticeboard`;
CREATE TABLE IF NOT EXISTS `noticeboard` (
  `noticeboard_id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `location` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `timestamp` int NOT NULL,
  `description` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `school_id` int NOT NULL,
  `session` varchar(20) NOT NULL,
  PRIMARY KEY (`noticeboard_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `noticeboard`
--

INSERT INTO `noticeboard` (`noticeboard_id`, `title`, `location`, `timestamp`, `description`, `school_id`, `session`) VALUES
(3, 'Second meeting coming up soon', 'Udemy Forum', 1694541600, 'The meeting is coming up soon. Ensure you are fully prepared.', 0, ''),
(4, 'Parent Teacher Association Meeting.', 'Ontario Location', 1697479200, 'This is the new updated information as regards the meeting.', 0, '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `online_exam`
--

DROP TABLE IF EXISTS `online_exam`;
CREATE TABLE IF NOT EXISTS `online_exam` (
  `online_exam_id` int NOT NULL AUTO_INCREMENT,
  `code` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `class_id` int NOT NULL,
  `section_id` int NOT NULL,
  `subject_id` int NOT NULL,
  `exam_date` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `time_start` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `time_end` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `duration` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `minimum_percentage` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `instruction` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `running_year` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `school_id` int NOT NULL,
  PRIMARY KEY (`online_exam_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `online_exam_result`
--

DROP TABLE IF EXISTS `online_exam_result`;
CREATE TABLE IF NOT EXISTS `online_exam_result` (
  `online_exam_result_id` int NOT NULL AUTO_INCREMENT,
  `online_exam_id` int NOT NULL,
  `student_id` int NOT NULL,
  `answer_script` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `obtained_mark` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exam_started_timestamp` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `result` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`online_exam_result_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `parent`
--

DROP TABLE IF EXISTS `parent`;
CREATE TABLE IF NOT EXISTS `parent` (
  `parent_id` int NOT NULL,
  `name` varchar(31) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `profession` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `login_status` varchar(2) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `school_id` int NOT NULL,
  `session` varchar(20) NOT NULL,
  PRIMARY KEY (`parent_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `parent`
--

INSERT INTO `parent` (`parent_id`, `name`, `email`, `password`, `phone`, `address`, `profession`, `login_status`, `school_id`, `session`) VALUES
(56412895, 'Viviana Puentes', 'vivi25@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', '3102547896', 'Calle 76 # 24 - 60', 'Pedagoga', '', 0, ''),
(70154862, 'Alejandro Anaya', 'parent@parent.com', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', '312345667', 'Carrera 50 A # 13-04', 'Albañil', '1', 0, '');

--
-- Disparadores `parent`
--
DROP TRIGGER IF EXISTS `prevent_duplicate_parent_email`;
DELIMITER $$
CREATE TRIGGER `prevent_duplicate_parent_email` BEFORE INSERT ON `parent` FOR EACH ROW BEGIN
    IF EXISTS (
        SELECT 1 FROM parent
        WHERE email = NEW.email
    ) THEN
        SIGNAL SQLSTATE '45002' SET MESSAGE_TEXT = 'El correo electrónico ya existe';
    END IF;
END
$$
DELIMITER ;
DROP TRIGGER IF EXISTS `prevent_duplicate_parent_id`;
DELIMITER $$
CREATE TRIGGER `prevent_duplicate_parent_id` BEFORE INSERT ON `parent` FOR EACH ROW BEGIN
    IF EXISTS (
        SELECT 1 FROM parent
        WHERE parent_id = NEW.parent_id
    ) THEN
        SIGNAL SQLSTATE '45001'
        SET MESSAGE_TEXT = 'El numero de documento ya existe';
    END IF;
END
$$
DELIMITER ;
DROP TRIGGER IF EXISTS `prevent_update_duplicate_parent_email`;
DELIMITER $$
CREATE TRIGGER `prevent_update_duplicate_parent_email` BEFORE UPDATE ON `parent` FOR EACH ROW BEGIN
    IF NEW.email <> OLD.email AND EXISTS (
        SELECT 1 FROM parent
        WHERE email = NEW.email
    ) THEN
        SIGNAL SQLSTATE '45002' SET MESSAGE_TEXT = 'El correo electrónico ya existe';
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `payment`
--

DROP TABLE IF EXISTS `payment`;
CREATE TABLE IF NOT EXISTS `payment` (
  `payment_id` int NOT NULL AUTO_INCREMENT,
  `expense_category_id` int NOT NULL,
  `title` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payment_type` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `invoice_id` int NOT NULL,
  `student_id` int NOT NULL,
  `method` varchar(3) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` int NOT NULL,
  `discount` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `timestamp` int NOT NULL,
  `year` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `school_id` int NOT NULL,
  PRIMARY KEY (`payment_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `payment`
--

INSERT INTO `payment` (`payment_id`, `expense_category_id`, `title`, `payment_type`, `invoice_id`, `student_id`, `method`, `description`, `amount`, `discount`, `timestamp`, `year`, `school_id`) VALUES
(11, 5, 'Purchase of school Books', 'expense', 0, 0, '3', 'Purchase of school Books<br>', 4000, '', 2020, '2019-2020', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `payroll`
--

DROP TABLE IF EXISTS `payroll`;
CREATE TABLE IF NOT EXISTS `payroll` (
  `payroll_id` int NOT NULL AUTO_INCREMENT,
  `payroll_code` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int NOT NULL,
  `allowances` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `deductions` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int NOT NULL,
  `school_id` int NOT NULL,
  `session` varchar(20) NOT NULL,
  PRIMARY KEY (`payroll_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `payroll`
--

INSERT INTO `payroll` (`payroll_id`, `payroll_code`, `user_id`, `allowances`, `deductions`, `date`, `status`, `school_id`, `session`) VALUES
(3, 'a8c4ae9', 1, '[{\"type\":\"Food\",\"amount\":\"5000\"},{\"type\":\"House\",\"amount\":\"2000\"}]', '[{\"type\":\"Tax1\",\"amount\":\"1000\"},{\"type\":\"Tax2\",\"amount\":\"500\"}]', '9,2019', 1, 0, ''),
(4, 'c94d9d7', 1, '[{\"type\":\"A\",\"amount\":\"1000\"},{\"type\":\"B\",\"amount\":\"1000\"}]', '[{\"type\":\"A\",\"amount\":\"200\"},{\"type\":\"B\",\"amount\":\"700\"}]', '10,2019', 0, 0, ''),
(5, '75c1f3d', 1, '[{\"type\":\"A\",\"amount\":\"2000\"},{\"type\":\"B\",\"amount\":\"1000\"}]', '[{\"type\":\"A\",\"amount\":\"500\"},{\"type\":\"B\",\"amount\":\"500\"}]', '12,2019', 1, 0, ''),
(6, '31bccf0', 1, '[{\"type\":\"A\",\"amount\":\"10\"}]', '[{\"type\":\"A\",\"amount\":\"5\"}]', '3,2020', 0, 0, '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `periodtime`
--

DROP TABLE IF EXISTS `periodtime`;
CREATE TABLE IF NOT EXISTS `periodtime` (
  `id` int NOT NULL AUTO_INCREMENT,
  `deadline_date` date NOT NULL,
  `school_id` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `periodtime`
--

INSERT INTO `periodtime` (`id`, `deadline_date`, `school_id`) VALUES
(1, '2023-08-12', 0),
(2, '2023-10-12', 0),
(3, '2023-10-12', 0),
(4, '2023-10-12', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `publisher`
--

DROP TABLE IF EXISTS `publisher`;
CREATE TABLE IF NOT EXISTS `publisher` (
  `publisher_id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(31) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `school_id` int NOT NULL,
  `session` varchar(20) NOT NULL,
  PRIMARY KEY (`publisher_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `publisher`
--

INSERT INTO `publisher` (`publisher_id`, `name`, `description`, `school_id`, `session`) VALUES
(1, 'Amazon.', 'The book is published by Amazon', 0, '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `question_bank`
--

DROP TABLE IF EXISTS `question_bank`;
CREATE TABLE IF NOT EXISTS `question_bank` (
  `question_bank_id` int NOT NULL AUTO_INCREMENT,
  `online_exam_id` int NOT NULL,
  `question_title` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `number_of_options` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `correct_answers` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `mark` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`question_bank_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `school`
--

DROP TABLE IF EXISTS `school`;
CREATE TABLE IF NOT EXISTS `school` (
  `school_id` int NOT NULL AUTO_INCREMENT,
  `school_code` varchar(15) NOT NULL,
  `name` varchar(31) NOT NULL,
  PRIMARY KEY (`school_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `school`
--

INSERT INTO `school` (`school_id`, `school_code`, `name`) VALUES
(1, '2343HD', 'Odeda Branch'),
(2, '2334GDBG', 'Lagos Branch');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `section`
--

DROP TABLE IF EXISTS `section`;
CREATE TABLE IF NOT EXISTS `section` (
  `section_id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(31) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `nick_name` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `class_id` int NOT NULL,
  `teacher_id` int NOT NULL,
  `school_id` int NOT NULL,
  `session` varchar(20) NOT NULL,
  PRIMARY KEY (`section_id`),
  KEY `fk_class_section` (`class_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `section`
--

INSERT INTO `section` (`section_id`, `name`, `nick_name`, `class_id`, `teacher_id`, `school_id`, `session`) VALUES
(3, 'Uno', '01', 2, 12456781, 0, ''),
(5, 'Dos', '02', 3, 61254632, 0, '');

--
-- Disparadores `section`
--
DROP TRIGGER IF EXISTS `before_insert_section`;
DELIMITER $$
CREATE TRIGGER `before_insert_section` BEFORE INSERT ON `section` FOR EACH ROW BEGIN
    DECLARE section_count INT;
    
    -- Verificar si ya existe una sección con el mismo nombre y clase
    SELECT COUNT(*) INTO section_count
    FROM section
    WHERE name = NEW.name AND class_id = NEW.class_id;
    
    -- Si ya existe, generar un error
    IF section_count > 0 THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'Ya existe una sección con el mismo nombre en esta clase.';
    END IF;
    
    -- Verificar si ya existe una sección con el mismo nick_name y clase
    SELECT COUNT(*) INTO section_count
    FROM section
    WHERE nick_name = NEW.nick_name AND class_id = NEW.class_id;
    
    -- Si ya existe, generar un error
    IF section_count > 0 THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'Ya existe una sección con el mismo apodo en esta clase.';
    END IF;
END
$$
DELIMITER ;
DROP TRIGGER IF EXISTS `prevent_duplicate_section_name`;
DELIMITER $$
CREATE TRIGGER `prevent_duplicate_section_name` BEFORE INSERT ON `section` FOR EACH ROW BEGIN
    DECLARE section_count INT;

    -- Verificar si el campo 'name' o 'nick_name' ya existe en la tabla
    SELECT COUNT(*) INTO section_count FROM section WHERE name = NEW.name OR nick_name = NEW.nick_name;
    
    IF section_count > 0 THEN
        SIGNAL SQLSTATE '45002'
        SET MESSAGE_TEXT = 'Ya existe un registro con ese nombre en la clase';
    END IF;
END
$$
DELIMITER ;
DROP TRIGGER IF EXISTS `prevent_update_duplicate_section_name`;
DELIMITER $$
CREATE TRIGGER `prevent_update_duplicate_section_name` BEFORE UPDATE ON `section` FOR EACH ROW BEGIN
    DECLARE section_count INT;

    -- Verificar si el campo 'name' o 'nick_name' ya existe en otro registro de la tabla
    SELECT COUNT(*) INTO section_count FROM section WHERE (name = NEW.name OR nick_name = NEW.nick_name) AND section_id <> NEW.section_id;
    
    IF section_count > 0 THEN
        SIGNAL SQLSTATE '45002'
        SET MESSAGE_TEXT = 'El nombre o el nick_name ya existe en otro registro de la tabla section';
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `settings`
--

DROP TABLE IF EXISTS `settings`;
CREATE TABLE IF NOT EXISTS `settings` (
  `settings_id` int NOT NULL AUTO_INCREMENT,
  `type` varchar(31) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`settings_id`)
) ENGINE=InnoDB AUTO_INCREMENT=123 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `settings`
--

INSERT INTO `settings` (`settings_id`, `type`, `description`) VALUES
(1, 'system_name', 'SISTEMA COLEGIO SALESIANO'),
(2, 'system_title', 'COLEGIO SALESIANO'),
(3, 'address', 'Carrera 14 # 4 - 100, Neiva'),
(4, 'phone', '320 847 5512'),
(6, 'currency', 'usd'),
(7, 'system_email', 'salesianoneiva@gmail.com'),
(11, 'language', 'english'),
(12, 'text_align', 'left-to-right'),
(16, 'skin_colour', 'green'),
(21, 'session', '2023'),
(22, 'footer', 'Copyright © 2023 Salesiano Neiva - All Rights Reserved'),
(116, 'paypal_email', 'salesianoneiva@gmail.com'),
(119, 'stripe_setting', '[{\"stripe_active\":\"1\",\"testmode\":\"off\",\"secret_key\":\"test secret key\",\"public_key\":\"test public key\",\"secret_live_key\":\"live secret key\",\"public_live_key\":\"live public key\"}]'),
(122, 'paypal_setting', '[{\"paypal_active\":\"1\",\"paypal_mode\":\"sandbox\",\"sandbox_client_id\":\"client id sandbox\",\"production_client_id\":\"client - production\"}]');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sms_settings`
--

DROP TABLE IF EXISTS `sms_settings`;
CREATE TABLE IF NOT EXISTS `sms_settings` (
  `sms_setting_id` int NOT NULL AUTO_INCREMENT,
  `type` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `info` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `school_id` int NOT NULL,
  PRIMARY KEY (`sms_setting_id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `sms_settings`
--

INSERT INTO `sms_settings` (`sms_setting_id`, `type`, `info`, `school_id`) VALUES
(8, 'clickatell_username', 'clickattel username', 0),
(9, 'clickatell_password', 'clickattel paasword', 0),
(10, 'clickatell_apikey', 'clickattel api', 0),
(11, 'msg91_authentication_key', 'msg91 auth key', 0),
(12, 'msg91_sender_id', 'sender id', 0),
(13, 'msg91_route', 'route', 0),
(14, 'msg91_country_code', 'country code', 0),
(15, 'active_sms_gateway', 'msg91', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `social_category`
--

DROP TABLE IF EXISTS `social_category`;
CREATE TABLE IF NOT EXISTS `social_category` (
  `social_category_id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(31) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `colour` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `school_id` int NOT NULL,
  `session` varchar(20) NOT NULL,
  PRIMARY KEY (`social_category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `social_category`
--

INSERT INTO `social_category` (`social_category_id`, `name`, `colour`, `icon`, `description`, `school_id`, `session`) VALUES
(2, 'Romance', 'danger', 'fa-male', 'This is for romance chat room', 0, ''),
(3, 'Event', 'primary', 'fa-book', 'This is for event chat room', 0, '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `student`
--

DROP TABLE IF EXISTS `student`;
CREATE TABLE IF NOT EXISTS `student` (
  `student_id` int NOT NULL,
  `name` varchar(31) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `birthday` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `age` int NOT NULL,
  `place_birth` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `sex` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `m_tongue` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `religion` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `blood_group` varchar(3) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `address` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `city` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `state` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `nationality` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `phone` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `email` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `ps_attended` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `ps_address` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `ps_purpose` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `class_study` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `date_of_leaving` date NOT NULL,
  `am_date` date NOT NULL,
  `tran_cert` varchar(5) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `dob_cert` varchar(5) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `mark_join` varchar(5) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `physical_h` varchar(5) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `password` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `father_name` varchar(31) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `mother_name` varchar(31) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `class_id` int NOT NULL,
  `section_id` int NOT NULL,
  `parent_id` int NOT NULL,
  `roll` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `transport_id` int NOT NULL,
  `dormitory_id` int DEFAULT NULL,
  `house_id` int DEFAULT NULL,
  `student_category_id` int DEFAULT NULL,
  `club_id` int DEFAULT NULL,
  `session` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `card_number` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `issue_date` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `expire_date` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `dormitory_room_number` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `more_entries` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `login_status` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `school_id` int NOT NULL,
  PRIMARY KEY (`student_id`),
  KEY `fk_class_student` (`class_id`),
  KEY `fk_parent_student` (`parent_id`),
  KEY `fk_transport_student` (`transport_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `student`
--

INSERT INTO `student` (`student_id`, `name`, `birthday`, `age`, `place_birth`, `sex`, `m_tongue`, `religion`, `blood_group`, `address`, `city`, `state`, `nationality`, `phone`, `email`, `ps_attended`, `ps_address`, `ps_purpose`, `class_study`, `date_of_leaving`, `am_date`, `tran_cert`, `dob_cert`, `mark_join`, `physical_h`, `password`, `father_name`, `mother_name`, `class_id`, `section_id`, `parent_id`, `roll`, `transport_id`, `dormitory_id`, `house_id`, `student_category_id`, `club_id`, `session`, `card_number`, `issue_date`, `expire_date`, `dormitory_room_number`, `more_entries`, `login_status`, `school_id`) VALUES
(107541263, 'Angelica Perez', '09/27/2007', 16, 'Neiva', 'femenino', 'Español', 'Cristiano', 'O+', 'Calle 26 # 30-45', 'Neiva', 'Huila', 'Colombiana', '3145872369', 'anper@gmail.com', 'Atanasio Girardot', 'Carrera 26 # 30-50', 'Motivo de salida', '10-01', '2022-08-19', '2023-08-19', 'No', NULL, 'No', 'No', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', '', '', 3, 0, 70154862, 'f1dd0ab', 2, NULL, NULL, NULL, NULL, '2023', '', '', '', '', '', '', 0),
(1004152463, 'Andrea Vargas', '09/06/2006', 17, 'Neiva', 'femenino', 'Español', 'Cristiano', 'B+', 'Calle 76 # 24-60', 'Neiva', 'Colombia', 'Colombiana', '', 'andreava@gmail.com', 'Atanasio Girardot', '', 'Cambio de zona de residencia', '10-01', '2022-06-22', '2023-02-02', 'No', NULL, 'No', 'No', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', '', '', 3, 0, 56412895, '45a7afa', 2, NULL, NULL, NULL, NULL, '2023-2024', '', '', '', '', '', '0', 0),
(1070457127, 'Alejandro Burgos', '01/07/2003', 17, 'Lagos', 'masculino', 'Español', 'Islam', 'B+', 'Calle 15 B # 20-65', 'Palermo', 'Huila', 'Colombiano', '3224571489', 'sheg@sheg.com', 'JER', 'Carrera 31 # 34-47', 'Motivo de salida', '10-02', '2018-06-24', '2021-06-26', '', NULL, '', 'No', '687f13b741f2b1049b8e47522b31b23e07484542', '', '', 2, 0, 70154862, '7bdc9ce', 2, NULL, NULL, NULL, NULL, '2019-2020', '', '', '', '', '', '', 0),
(1077412893, 'Wolfang Mozart', '09/29/2008', 15, 'Neiva', 'otro', 'Español', 'Cristiano', 'O+', 'Calle 31 # 40-89', 'Neiva', 'Huila', 'Colombiano', '3114578612', 'Wolfang@gmail.com', 'Jose Eustasio Rivera', 'Calle 21 # 23 43', 'Motivo de salida', '10-01', '2022-08-19', '2023-08-19', 'No', NULL, 'No', 'Si', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', '', '', 3, 0, 70154862, '8ec9827', 2, NULL, NULL, NULL, NULL, '2023', '', '', '', '', '', '', 0),
(1077451788, 'Ana Florez', '09/30/2003', 16, 'Palermo', 'femenino', 'Quechua', 'Cristiana', 'B+', 'Carrera 24 # 29-82', 'Neiva', 'Huila', 'Canadian', '3178451236', 'student@student.com', 'Previous school attended', 'Previous school address', 'Purpose Of Leaving', 'Class In Which Was Studying', '2011-08-10', '2011-08-19', '', NULL, '', 'No', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', '', '', 2, 0, 70154862, '5bf8161', 2, NULL, NULL, NULL, NULL, '2019-2020', '', '', '', '', '', '0', 1);

--
-- Disparadores `student`
--
DROP TRIGGER IF EXISTS `insert_prevent_underage_student`;
DELIMITER $$
CREATE TRIGGER `insert_prevent_underage_student` BEFORE INSERT ON `student` FOR EACH ROW BEGIN
    DECLARE min_date DATE;
    SET min_date = DATE_SUB(CURDATE(), INTERVAL 5 YEAR);
    
    IF NEW.birthday > min_date THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'El estudiante debe tener al menos 5 años de edad.';
    END IF;
END
$$
DELIMITER ;
DROP TRIGGER IF EXISTS `prevent_duplicate_student_email`;
DELIMITER $$
CREATE TRIGGER `prevent_duplicate_student_email` BEFORE INSERT ON `student` FOR EACH ROW BEGIN
    IF EXISTS (
        SELECT 1 FROM student
        WHERE email = NEW.email
    ) THEN
        SIGNAL SQLSTATE '45002' SET MESSAGE_TEXT = 'El correo electrónico ya existe';
    END IF;
END
$$
DELIMITER ;
DROP TRIGGER IF EXISTS `prevent_duplicate_student_id`;
DELIMITER $$
CREATE TRIGGER `prevent_duplicate_student_id` BEFORE INSERT ON `student` FOR EACH ROW BEGIN
    IF EXISTS (
        SELECT 1 FROM student
        WHERE student_id = NEW.student_id
    ) THEN
        SIGNAL SQLSTATE '45001'
        SET MESSAGE_TEXT = 'El numero de documento ya existe';
    END IF;
END
$$
DELIMITER ;
DROP TRIGGER IF EXISTS `prevent_update_duplicate_student_email`;
DELIMITER $$
CREATE TRIGGER `prevent_update_duplicate_student_email` BEFORE UPDATE ON `student` FOR EACH ROW BEGIN
    IF NEW.email <> OLD.email AND EXISTS (
        SELECT 1 FROM student
        WHERE email = NEW.email
    ) THEN
        SIGNAL SQLSTATE '45002' SET MESSAGE_TEXT = 'El correo electrónico ya existe';
    END IF;
END
$$
DELIMITER ;
DROP TRIGGER IF EXISTS `update_prevent_underage_student`;
DELIMITER $$
CREATE TRIGGER `update_prevent_underage_student` BEFORE UPDATE ON `student` FOR EACH ROW BEGIN
    DECLARE min_date DATE;
    SET min_date = DATE_SUB(CURDATE(), INTERVAL 5 YEAR);
    
    IF NEW.birthday > min_date THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'El estudiante debe tener al menos 5 años de edad.';
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `student_category`
--

DROP TABLE IF EXISTS `student_category`;
CREATE TABLE IF NOT EXISTS `student_category` (
  `student_category_id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(31) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `school_id` int NOT NULL,
  `session` varchar(20) NOT NULL,
  PRIMARY KEY (`student_category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `student_category`
--

INSERT INTO `student_category` (`student_category_id`, `name`, `description`, `school_id`, `session`) VALUES
(2, 'Boarding Student', 'This is for the boarding student.', 0, '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `subject`
--

DROP TABLE IF EXISTS `subject`;
CREATE TABLE IF NOT EXISTS `subject` (
  `subject_id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(31) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `class_id` int NOT NULL,
  `teacher_id` int NOT NULL,
  `school_id` int NOT NULL,
  `session` varchar(20) NOT NULL,
  PRIMARY KEY (`subject_id`),
  KEY `fk_class_subject` (`class_id`),
  KEY `fk_teacher_subject` (`teacher_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `subject`
--

INSERT INTO `subject` (`subject_id`, `name`, `class_id`, `teacher_id`, `school_id`, `session`) VALUES
(4, 'Matematicas', 2, 107564812, 0, ''),
(5, 'Economia', 2, 12456781, 0, ''),
(6, 'Fisica', 3, 107564812, 0, ''),
(8, 'Matematicas', 3, 107564812, 0, ''),
(9, 'Fisica', 2, 107564812, 0, ''),
(10, 'Economia', 3, 77412589, 0, '');

--
-- Disparadores `subject`
--
DROP TRIGGER IF EXISTS `prevent_duplicate_subject_name`;
DELIMITER $$
CREATE TRIGGER `prevent_duplicate_subject_name` BEFORE INSERT ON `subject` FOR EACH ROW BEGIN
    DECLARE subject_count INT;

    -- Verificar si el campo 'name' ya existe en otro registro con el mismo 'class_id'
    SELECT COUNT(*) INTO subject_count FROM subject WHERE name = NEW.name AND class_id = NEW.class_id;

    IF subject_count > 0 THEN
        SIGNAL SQLSTATE '45002'
        SET MESSAGE_TEXT = 'Una asignatura con ese nombre ya existe en la clase';
    END IF;
END
$$
DELIMITER ;
DROP TRIGGER IF EXISTS `prevent_update_duplicate_subject_name`;
DELIMITER $$
CREATE TRIGGER `prevent_update_duplicate_subject_name` BEFORE UPDATE ON `subject` FOR EACH ROW BEGIN
    DECLARE subject_count INT;

    -- Verificar si el campo 'name' ya existe en otro registro con el mismo 'class_id' y distinto 'subject_id'
    SELECT COUNT(*) INTO subject_count FROM subject WHERE name = NEW.name AND class_id = NEW.class_id AND subject_id <> NEW.subject_id;

    IF subject_count > 0 THEN
        SIGNAL SQLSTATE '45002'
        SET MESSAGE_TEXT = 'Ya existe una asignatura con ese nombre en la clase';
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `subscriber_table`
--

DROP TABLE IF EXISTS `subscriber_table`;
CREATE TABLE IF NOT EXISTS `subscriber_table` (
  `subscriber_id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `school_id` int NOT NULL,
  `session` varchar(20) NOT NULL,
  PRIMARY KEY (`subscriber_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `subscriber_table`
--

INSERT INTO `subscriber_table` (`subscriber_id`, `email`, `school_id`, `session`) VALUES
(6, 'optimumproblemsolver@gmail.com', 0, ''),
(7, 'clohithchandru@gmail.com', 0, ''),
(8, 'jovah2019@gmail.com', 0, '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `teacher`
--

DROP TABLE IF EXISTS `teacher`;
CREATE TABLE IF NOT EXISTS `teacher` (
  `teacher_id` int NOT NULL,
  `name` varchar(31) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `role` varchar(2) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `teacher_number` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `birthday` date NOT NULL,
  `sex` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `religion` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `blood_group` varchar(3) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `address` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `phone` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `email` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `facebook` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `twitter` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `googleplus` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `linkedin` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `qualification` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `marital_status` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `file_name` varchar(31) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `password` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `department_id` int DEFAULT NULL,
  `designation_id` int DEFAULT NULL,
  `date_of_joining` date NOT NULL,
  `joining_salary` int DEFAULT NULL,
  `status` int NOT NULL,
  `date_of_leaving` date NOT NULL,
  `bank_id` int DEFAULT NULL,
  `login_status` int NOT NULL,
  `school_id` int NOT NULL,
  `session` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  PRIMARY KEY (`teacher_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `teacher`
--

INSERT INTO `teacher` (`teacher_id`, `name`, `role`, `teacher_number`, `birthday`, `sex`, `religion`, `blood_group`, `address`, `phone`, `email`, `facebook`, `twitter`, `googleplus`, `linkedin`, `qualification`, `marital_status`, `file_name`, `password`, `department_id`, `designation_id`, `date_of_joining`, `joining_salary`, `status`, `date_of_leaving`, `bank_id`, `login_status`, `school_id`, `session`) VALUES
(12456781, 'Fernando Pastrana', '1', 'f82e5cc', '1993-08-19', 'masculino', 'Christianity', 'B+', 'Carrera 31 # 45-78', '3004512389', 'teacher@teacher.com', 'facebook', 'twitter', 'googleplus', 'linkedin', 'PhD', 'Married', 'profile.png', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 2, 4, '2019-09-15', 5000, 1, '2019-09-18', 3, 0, 1, ''),
(61254632, 'Armando Perez', '1', 'dbc680f', '1996-02-13', 'masculino', 'Islam', 'B+', 'Carrera 34 # 67-34', '3054128951', 'tech@tech.com', 'facebook', 'twitter', 'googleplu', 'linkedin', 'PhD', 'Single', 'Customizations_version1.pdf', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 2, 4, '2020-08-01', 6000, 1, '2020-01-08', 5, 0, 0, ''),
(77412589, 'Adelaida Gutierrez', '2', '9acf13b', '1973-02-06', 'femenino', 'Cristiano', 'O+', 'Carrera 45 # 58-41', '3154781236', 'adegu@gmail.com', 'Facebook', 'Twitter', 'Googleplus', 'Linkedin', 'Licenciada', 'Married', 'comu_pren_2004_006.doc', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 2, 6, '2023-09-01', 1160000, 1, '2023-09-01', 6, 0, 0, ''),
(107564812, 'Pedro Paramo', '2', 'fc79828', '1989-06-13', 'masculino', 'Cristian', 'O+', 'Carrera 19 # 30 - 20, Neiva', '325141565', 'pedro12@hotmail.com', 'pedro21', 'pedro21', 'pedro21', 'pedro21', 'Magister', 'Single', 'invoice.docx', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 2, 6, '2023-05-20', 5000000, 1, '2023-05-20', 6, 0, 0, '');

--
-- Disparadores `teacher`
--
DROP TRIGGER IF EXISTS `insert_prevent_underage_teacher`;
DELIMITER $$
CREATE TRIGGER `insert_prevent_underage_teacher` BEFORE INSERT ON `teacher` FOR EACH ROW BEGIN
    DECLARE min_date DATE;
    SET min_date = DATE_SUB(CURDATE(), INTERVAL 18 YEAR);
    
    IF NEW.birthday > min_date THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'La edad del profesor no puede ser menor a 18 años.';
    END IF;
END
$$
DELIMITER ;
DROP TRIGGER IF EXISTS `prevent_duplicate_teacher_email`;
DELIMITER $$
CREATE TRIGGER `prevent_duplicate_teacher_email` BEFORE INSERT ON `teacher` FOR EACH ROW BEGIN
    IF EXISTS (
        SELECT 1 FROM teacher
        WHERE email = NEW.email
    ) THEN
        SIGNAL SQLSTATE '45002' SET MESSAGE_TEXT = 'El correo electrónico ya existe';
    END IF;
END
$$
DELIMITER ;
DROP TRIGGER IF EXISTS `prevent_duplicate_teacher_id`;
DELIMITER $$
CREATE TRIGGER `prevent_duplicate_teacher_id` BEFORE INSERT ON `teacher` FOR EACH ROW BEGIN
    IF EXISTS (
        SELECT 1 FROM teacher
        WHERE teacher_id = NEW.teacher_id
    ) THEN
        SIGNAL SQLSTATE '45001'
        SET MESSAGE_TEXT = 'El numero de documento ya existe en la tabla docentes';
    END IF;
END
$$
DELIMITER ;
DROP TRIGGER IF EXISTS `prevent_update_duplicate_teacher_email`;
DELIMITER $$
CREATE TRIGGER `prevent_update_duplicate_teacher_email` BEFORE UPDATE ON `teacher` FOR EACH ROW BEGIN
    IF NEW.email <> OLD.email AND EXISTS (
        SELECT 1 FROM teacher
        WHERE email = NEW.email
    ) THEN
        SIGNAL SQLSTATE '45002' SET MESSAGE_TEXT = 'El correo electrónico ya existe';
    END IF;
END
$$
DELIMITER ;
DROP TRIGGER IF EXISTS `update_prevent_underage_teacher`;
DELIMITER $$
CREATE TRIGGER `update_prevent_underage_teacher` BEFORE UPDATE ON `teacher` FOR EACH ROW BEGIN
    DECLARE min_date DATE;
    SET min_date = DATE_SUB(CURDATE(), INTERVAL 18 YEAR);
    
    IF NEW.birthday > min_date THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'La edad del docente no puede ser menor a 18 años.';
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `testimony_table`
--

DROP TABLE IF EXISTS `testimony_table`;
CREATE TABLE IF NOT EXISTS `testimony_table` (
  `testimony_id` int NOT NULL AUTO_INCREMENT,
  `parent_id` int NOT NULL,
  `content` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(20) NOT NULL,
  `school_id` int NOT NULL,
  `session` varchar(20) NOT NULL,
  PRIMARY KEY (`testimony_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `testimony_table`
--

INSERT INTO `testimony_table` (`testimony_id`, `parent_id`, `content`, `status`, `school_id`, `session`) VALUES
(2, 4, 'Good school all the time', 'Approved', 0, '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `transport`
--

DROP TABLE IF EXISTS `transport`;
CREATE TABLE IF NOT EXISTS `transport` (
  `transport_id` int NOT NULL AUTO_INCREMENT,
  `name` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `transport_route_id` int NOT NULL,
  `vehicle_id` int NOT NULL,
  `route_fare` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `school_id` int NOT NULL,
  `session` longtext NOT NULL,
  PRIMARY KEY (`transport_id`),
  KEY `fk_transport_transport_route` (`transport_route_id`),
  KEY `fk_transport_vehicle` (`vehicle_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `transport`
--

INSERT INTO `transport` (`transport_id`, `name`, `transport_route_id`, `vehicle_id`, `route_fare`, `description`, `school_id`, `session`) VALUES
(2, 'Transporte bus escolar', 4, 2, '5000', 'Transporte escolar para estudiantes', 0, '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `transport_route`
--

DROP TABLE IF EXISTS `transport_route`;
CREATE TABLE IF NOT EXISTS `transport_route` (
  `transport_route_id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(31) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `school_id` int NOT NULL,
  `session` varchar(20) NOT NULL,
  PRIMARY KEY (`transport_route_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `transport_route`
--

INSERT INTO `transport_route` (`transport_route_id`, `name`, `description`, `school_id`, `session`) VALUES
(4, 'Ruta Centro', 'Calle 12 a calle 6', 0, '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vacancy`
--

DROP TABLE IF EXISTS `vacancy`;
CREATE TABLE IF NOT EXISTS `vacancy` (
  `vacancy_id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(31) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `number_of_vacancies` int NOT NULL,
  `last_date` date NOT NULL,
  `school_id` int NOT NULL,
  `session` varchar(20) NOT NULL,
  PRIMARY KEY (`vacancy_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `vacancy`
--

INSERT INTO `vacancy` (`vacancy_id`, `name`, `number_of_vacancies`, `last_date`, `school_id`, `session`) VALUES
(3, 'Position for class teachers', 4, '2019-12-21', 0, '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vehicle`
--

DROP TABLE IF EXISTS `vehicle`;
CREATE TABLE IF NOT EXISTS `vehicle` (
  `vehicle_id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(31) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `vehicle_number` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `vehicle_model` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `vehicle_quantity` int NOT NULL,
  `year_made` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `driver_name` varchar(31) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `driver_license` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `driver_contact` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `school_id` int NOT NULL,
  `session` varchar(20) NOT NULL,
  PRIMARY KEY (`vehicle_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `vehicle`
--

INSERT INTO `vehicle` (`vehicle_id`, `name`, `vehicle_number`, `vehicle_model`, `vehicle_quantity`, `year_made`, `driver_name`, `driver_license`, `driver_contact`, `description`, `status`, `school_id`, `session`) VALUES
(2, 'Bus escolar chevrolet', 'HUJ554', 'Chevrolet npr', 2, '2020', 'Alfonso Lopez', 'C1', '3145478921', 'Bus adquirido por la institucion ', 'disponible', 0, '');

--
-- Disparadores `vehicle`
--
DROP TRIGGER IF EXISTS `prevent_duplicate_vehicle_number`;
DELIMITER $$
CREATE TRIGGER `prevent_duplicate_vehicle_number` BEFORE INSERT ON `vehicle` FOR EACH ROW BEGIN
    DECLARE vehicle_count INT;

    -- Verificar si el campo 'vehicle_number' ya existe en la tabla
    SELECT COUNT(*) INTO vehicle_count FROM vehicle WHERE vehicle_number = NEW.vehicle_number;
    
    -- Si ya existe un registro con el mismo 'vehicle_number', generar una señal de error
    IF vehicle_count > 0 THEN
        SIGNAL SQLSTATE '45001'
        SET MESSAGE_TEXT = 'El número de la placa del vehículo ya se encuentra registrado';
    END IF;
END
$$
DELIMITER ;
DROP TRIGGER IF EXISTS `prevent_duplicate_vehicle_number_update`;
DELIMITER $$
CREATE TRIGGER `prevent_duplicate_vehicle_number_update` BEFORE UPDATE ON `vehicle` FOR EACH ROW BEGIN
    DECLARE vehicle_count INT;

    -- Verificar si el campo 'vehicle_number' ya existe en otro registro de la tabla
    SELECT COUNT(*) INTO vehicle_count FROM vehicle WHERE vehicle_number = NEW.vehicle_number AND vehicle_id <> NEW.vehicle_id;
    
    -- Si ya existe otro registro con el mismo 'vehicle_number' y la 'vehicle_id' es diferente
    -- y el usuario realizó un cambio en 'vehicle_number', generar una señal de error
    IF vehicle_count > 0 AND NOT (OLD.vehicle_number <=> NEW.vehicle_number) THEN
        SIGNAL SQLSTATE '45001'
        SET MESSAGE_TEXT = 'El número de vehículo ya existe en otro registro';
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `website_settings`
--

DROP TABLE IF EXISTS `website_settings`;
CREATE TABLE IF NOT EXISTS `website_settings` (
  `id` int NOT NULL AUTO_INCREMENT,
  `type` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `school_id` int NOT NULL,
  `session` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `website_settings`
--

INSERT INTO `website_settings` (`id`, `type`, `description`, `school_id`, `session`) VALUES
(1, 'about_us', '<p>La empresa ofrece una visi&oacute;n para el futuro y una perspicacia pr&aacute;ctica con gran conocimiento y experiencia en la b&uacute;squeda de soluciones inform&aacute;ticas. Nuestro equipo de expertos trabaja en estrecha colaboraci&oacute;n con los clientes para identificar sus requisitos y, por lo tanto, desarrollar e implementar la automatizaci&oacute;n del sistema.</p>\r\n<p><br /> <strong>Nuestra Visi&oacute;n</strong><br /> Desarrollarnos de manera sostenida y crecer como un importante proveedor de soluciones inform&aacute;ticas para nuestros valiosos clientes. Convertimos las ideas comerciales de los clientes en nuevos productos y aplicaciones para aumentar su productividad y eficiencia en la gesti&oacute;n de los procesos comerciales.</p>\r\n<p><br /> <strong>Ideas Centrales</strong><br /> Planificamos nuestras tareas para ofrecer m&aacute;s all&aacute; de las expectativas de nuestros clientes porque creemos que la tecnolog&iacute;a de la informaci&oacute;n no deber&iacute;a limitarse solo a la entrada de datos y la visualizaci&oacute;n de informaci&oacute;n, sino que tambi&eacute;n deber&iacute;a actuar como un lugar perfecto para la toma de decisiones y como una plataforma que ahorra tiempo.</p>\r\n<p><br /> <strong>1. Experiencias web.</strong><br /> El dise&ntilde;o de sitios web requiere experiencia en el dise&ntilde;o de bases s&oacute;lidas.</p>\r\n<p><br /> <strong>2. Opciones potentes.</strong><br /> Su sitio web debe ser m&aacute;s que un folleto en l&iacute;nea; debe ser una presentaci&oacute;n integral de su negocio.</p>\r\n<p><br /> <strong>3. Personalizaci&oacute;n sencilla.</strong><br /> Todo nuestro software est&aacute; impulsado por un equipo de ingenieros t&eacute;cnicos que se aseguran proactivamente de que el software sea suave y f&aacute;cil de personalizar. Convertimos las ideas comerciales de los clientes en nuevos productos y aplicaciones para aumentar la productividad y eficiencia del personal de oficina/gesti&oacute;n. Nuestro objetivo final es la satisfacci&oacute;n del cliente en la medida en que los clientes est&eacute;n contentos con los productos y servicios que les proporcionamos.</p>', 0, ''),
(2, 'video_link', 'https://youtu.be/h-omI-tje4M', 0, ''),
(3, 'mission', 'Somos una Comunidad Educativa Pastoral, de carácter privado católico, orientada por la Sociedad Salesiana que, con renovado compromiso evangelizador, acompaña en su proceso de formación integral, a niños, niñas y jóvenes, mediante una educación de calidad fundamentada en el Sistema Preventivo de Don Bosco, educando para nuestra sociedad: Buenos Cristianos y Honestos Ciudadanos.', 0, ''),
(4, 'vission', 'Para el año 2025, el Colegio Salesiano San Medardo de Neiva, continuará siendo una Comunidad Educativa Pastoral, certificada en calidad, reconocida por la formación integral de niños, niñas y jóvenes, capaces de asumir un proyecto de vida coherente como Buenos Cristianos y Honestos Ciudadanos, desde una propuesta pedagógica basada en competencias, con intensificación en Lengua Extranjera inglés, que permite el acceso a carreras profesionales de acuerdo con sus intereses.', 0, ''),
(5, 'goal', 'ara el año 2025, el Colegio Salesiano San Medardo de Neiva, continuará siendo una Comunidad Educativa Pastoral, certificada en calidad, reconocida por la formación integral de niños, niñas y jóvenes, capaces de asumir un proyecto de vida coherente como Buenos Cristianos y Honestos Ciudadanos, desde una propuesta pedagógica basada en competencias, con intensificación en Lengua Extranjera inglés, que permite el acceso a carreras profesionales de acuerdo con sus intereses.', 0, ''),
(6, 'testimony_message', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 0, ''),
(7, 'map_code', '<iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d967.7957205809622!2d-75.27930845471171!3d2.925889290677953!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8e3b7471a9e3ee65%3A0x780265b3d051950d!2sColegio%20Salesiano%20San%20Medardo!5e0!3m2!1ses!2sco!4v1696025959412!5m2!1ses!2sco\" width=\"600\" height=\"450\" frameborder=\"0\" style=\"border:0;\" allowfullscreen=\"\"></iframe>', 0, ''),
(8, 'facebook_like_code', 'https://web.facebook.com/Colsalesianosanmedardo/', 0, ''),
(9, 'contact_message', 'Institución Educativa de carácter privado orientado por la Sociedad Salesiana, que atiende niños y jóvenes desde el grado transición hasta el grado 11° de educación media. Nuestro Proyecto Educativo nos ha permitido estar en un nivel muy superior por más de 30 años. Fundada en el año 1945 el 17 de enero, cuando llegan los Salesianos de Don Bosco a la ciudad de Neiva. La presencia salesiana se debe en gran parte al esfuerzo del P. Medardo Charry Viatela, sacerdote salesiano nacido en esta ciudad, quien con su familia siempre manifestaron su amor y predilección por su tierra natal y sumado a estos sentimientos el deseo de fundar una casa salesiana en Neiva. En el año 2020 cumple 75 años de fundación.', 0, '');

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `class`
--
ALTER TABLE `class`
  ADD CONSTRAINT `fk_teacher_class` FOREIGN KEY (`teacher_id`) REFERENCES `teacher` (`teacher_id`) ON DELETE RESTRICT;

--
-- Filtros para la tabla `material`
--
ALTER TABLE `material`
  ADD CONSTRAINT `fk_class_material` FOREIGN KEY (`class_id`) REFERENCES `class` (`class_id`) ON DELETE RESTRICT,
  ADD CONSTRAINT `fk_subject_material` FOREIGN KEY (`subject_id`) REFERENCES `subject` (`subject_id`) ON DELETE RESTRICT,
  ADD CONSTRAINT `fk_teacher_material` FOREIGN KEY (`teacher_id`) REFERENCES `teacher` (`teacher_id`) ON DELETE RESTRICT;

--
-- Filtros para la tabla `section`
--
ALTER TABLE `section`
  ADD CONSTRAINT `fk_class_section` FOREIGN KEY (`class_id`) REFERENCES `class` (`class_id`) ON DELETE RESTRICT;

--
-- Filtros para la tabla `student`
--
ALTER TABLE `student`
  ADD CONSTRAINT `fk_class_student` FOREIGN KEY (`class_id`) REFERENCES `class` (`class_id`) ON DELETE RESTRICT,
  ADD CONSTRAINT `fk_parent_student` FOREIGN KEY (`parent_id`) REFERENCES `parent` (`parent_id`) ON DELETE RESTRICT,
  ADD CONSTRAINT `fk_transport_student` FOREIGN KEY (`transport_id`) REFERENCES `transport` (`transport_id`) ON DELETE RESTRICT;

--
-- Filtros para la tabla `subject`
--
ALTER TABLE `subject`
  ADD CONSTRAINT `fk_class_subject` FOREIGN KEY (`class_id`) REFERENCES `class` (`class_id`) ON DELETE RESTRICT,
  ADD CONSTRAINT `fk_teacher_subject` FOREIGN KEY (`teacher_id`) REFERENCES `teacher` (`teacher_id`) ON DELETE RESTRICT;

--
-- Filtros para la tabla `transport`
--
ALTER TABLE `transport`
  ADD CONSTRAINT `fk_transport_transport_route` FOREIGN KEY (`transport_route_id`) REFERENCES `transport_route` (`transport_route_id`) ON DELETE RESTRICT,
  ADD CONSTRAINT `fk_transport_vehicle` FOREIGN KEY (`vehicle_id`) REFERENCES `vehicle` (`vehicle_id`) ON DELETE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
