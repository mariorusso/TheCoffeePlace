-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 01, 2015 at 08:36 PM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `intro_php`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `category_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT '0',
  `in_navigation` tinyint(1) DEFAULT '0',
  `add_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`category_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_id`, `name`, `description`, `is_active`, `in_navigation`, `add_date`, `updated_date`, `deleted`) VALUES
(1, 'Snacks', 'We have a great variety of snacks, so you can have a quick and tastefull food.', 1, 1, '2015-01-21 22:43:47', '2015-01-21 22:43:47', 0),
(2, 'Coffee', 'Take a look at our variety so you can choose the perfect for you.', 1, 1, '2015-01-21 22:43:47', '2015-01-21 22:43:47', 0),
(3, 'Hot Beverages', 'Have a hot drink and enjoy our options to warm your day.', 1, 1, '2015-01-21 22:43:47', '2015-01-21 22:43:47', 0),
(4, 'Cold Beverages', 'Milkshakes and another great options to refresh your day.', 1, 1, '2015-01-21 22:43:47', '2015-01-21 22:43:47', 0),
(5, 'Soups', 'More than 20 options of soups for you.', 1, 1, '2015-01-21 22:43:47', '2015-01-21 22:43:47', 0),
(6, 'Breakfast Specials', 'Start your day with a great and healthy choice.', 1, 1, '2015-01-21 22:43:47', '2015-01-21 22:43:47', 0),
(7, 'Sandwiches', 'The most tastefull sandwiches that you can have.', 1, 1, '2015-01-21 22:43:47', '2015-01-21 22:43:47', 0),
(8, 'Drinks', 'Special alcoholic drinks made with coffee.', 1, 1, '2015-01-21 22:43:47', '2015-01-21 22:43:47', 0),
(9, 'Catering', 'Take a look at our catering options for your parties.', 1, 1, '2015-01-21 22:43:47', '2015-01-21 22:43:47', 0);

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE IF NOT EXISTS `customer` (
  `customer_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `street_1` varchar(255) DEFAULT NULL,
  `street_2` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `province` varchar(255) DEFAULT NULL,
  `postal_code` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`customer_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customer_id`, `email`, `password`, `first_name`, `last_name`, `street_1`, `street_2`, `city`, `province`, `postal_code`, `phone`, `created_at`, `updated_at`, `deleted`) VALUES
(2, 'clebersilva@gmail.com', '$2y$10$54c91730f1ff24.174333uiVTw6xRG3N7Z3Ivb3FWEzIaulJ3v3/W', 'Cleber', 'Silva', '1010 Portage Ave..', 'null', 'Winnipeg', 'MB', 'R3G0R6', '204-123-4567', '2015-01-28 17:06:57', NULL, 0),
(3, 'mr@gmail.com', '$2y$10$54c919175876e8.403885usO.lm4M2hOaN1mHuoKuxl1j8lcpu2BS', 'Mario', 'Russo', '595 River Ave.', '', 'Winnipeg', 'MB', 'R3L-0E6', '204-330-3249', '2015-01-28 17:15:03', NULL, 0),
(5, 'nu@yahoo.ca', '12345', 'New', 'User', '596 Main St.', '', 'Winnipeg', 'MB', 'R4L 4O8', '204-123-1234', '2015-01-29 16:20:17', NULL, 0),
(6, 'om@hotmail.com', '1234', 'One', 'More', 'rijsn', '', 'Winnipeg', 'MB', 'R3G0R6', '204-345-6789', '2015-01-29 16:29:24', NULL, 0),
(7, 'om@hotmail.com', NULL, 'One', 'More Try', 'rijsn', '', 'Winnipeg', 'Select Province', 'R3G0R6', '204-345-6789', '2015-01-29 16:30:45', NULL, 0),
(8, 'mm@globe.com', '$2y$10$54ca61a8ed75d0.161758uXjTORP5cdm3ws6AQVjdSUc6pY38ZNcW', 'Myname', 'MyLastName', '457 RIver Ave.', '120', 'Winnipeg', 'MB', 'R3L-0E6', '204-123-1234', '2015-01-29 16:36:57', NULL, 0),
(9, 'mm@globe.com', '$2y$10$54ca62d072a350.559172u5PI5c6C80YXsfYzcgpJoURL4Vc7ZqlS', 'Myname', 'MyLastName', '457 RIver Ave.', '120', 'Winnipeg', 'Select Province', 'R3L-0E6', '204-123-1234', '2015-01-29 16:41:52', NULL, 0),
(10, 'cu@yahoo.ca', '$2y$10$54ca6506265181.745017u3i3opC56nXLLRNmeGkQkqpd0YkXjPiW', 'Crazy', 'User', '345 Portage', '', 'Winnipeg', 'MB', 'R3L-0E6', '204-098-9876', '2015-01-29 16:51:18', NULL, 0),
(11, 'qwqw', '$2y$10$54ca7403d5fda0.039084uKb.j2i7Y5gyF3q2uTIsnpK3KodK5CF.', '1155', 'qwee', 'qwqwq', 'qwqw', 'asdas', 'MB', 'asdsa', 'qwqw', '2015-01-29 17:55:16', NULL, 0),
(12, 'amama', '$2y$10$54ca77fcf10480.313039ufHR/m43It.NZSasULVJ8JfbS0ZWf8qK', '2111', 'amam', 'amamam', '', 'amams', 'BC', 'msmsm', 'amamam', '2015-01-29 18:12:13', NULL, 0),
(13, 'snmand', '$2y$10$54cd11ed762042.250212uI7WqX.lXcUp1xkHMPdOE8e8n.16vI16', 'amnsa', 'anmdnsa', 'snmadn', 'snamdn', 'snmasdnasm', 'MB', 'ansdmns', 'snamdns', '2015-01-31 17:33:35', NULL, 0),
(14, NULL, '$2y$10$54ce6e427f1ae5.522073uibzLWoLhA1GIOBe88uKDE1yvMZ2.fb6', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2015-02-01 18:19:46', NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE IF NOT EXISTS `products` (
  `prod_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `category_id` bigint(20) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `quantity` bigint(20) DEFAULT NULL,
  `lowstock_qty` bigint(20) DEFAULT NULL,
  `short_description` varchar(255) DEFAULT NULL,
  `long_description` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `price` decimal(5,2) DEFAULT NULL,
  `cost` decimal(5,2) DEFAULT NULL,
  `add_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_date` timestamp NULL DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `featured` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`prod_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=37 ;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`prod_id`, `category_id`, `name`, `quantity`, `lowstock_qty`, `short_description`, `long_description`, `image`, `price`, `cost`, `add_date`, `update_date`, `deleted`, `featured`) VALUES
(1, 1, 'Chicken drop (coxinha de frango)', 100, 10, 'The classic savory in The Coffee Place, a stuffed flatbread with seasoned chicken.', 'The drumstick is a Brazilian snack, also common in Portugal, the dough base made with wheat flour and chicken broth, which involves a filling made with seasoned chicken.', 'coxinha.jpg', '2.99', '1.50', '2015-02-01 17:08:36', NULL, 0, 1),
(2, 1, 'Chocolate chip cookie', 100, 10, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce cursus eget urna nec interdum.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce cursus eget urna nec interdum. Ut vel ex consequat, aliquam diam ut, dignissim sem. Pellentesque lobortis mi eget venenatis gravida. Pellentesque volutpat consectetur est, in maximus elit plac', 'chochipcookie.jpg', '1.29', '0.60', '2015-02-01 17:10:47', NULL, 0, 0),
(3, 1, 'Triple chocolate cookie', 100, 10, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce cursus eget urna nec interdum.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce cursus eget urna nec interdum. Ut vel ex consequat, aliquam diam ut, dignissim sem. Pellentesque lobortis mi eget venenatis gravida. Pellentesque volutpat consectetur est, in maximus elit plac', 'trichocookie.jpg', '1.29', '0.60', '2015-02-01 17:13:54', NULL, 0, 0),
(4, 1, 'White chocolate cookie', 100, 10, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce cursus eget urna nec interdum.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce cursus eget urna nec interdum.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce cursus eget urna nec interdum.', 'whtchocookie.jpg', '1.29', '0.60', '2015-02-01 17:20:23', NULL, 0, 0),
(5, 1, 'Chocolate dip donut', 100, 10, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce cursus eget urna nec interdum.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce cursus eget urna nec interdum.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce cursus eget urna nec interdum.', 'chocdipdonut.jpg', '1.99', '0.99', '2015-02-01 17:21:50', NULL, 0, 0),
(6, 1, 'Vanilla dip donut', 100, 10, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin accumsan posuere molestie.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin accumsan posuere molestie. Ut dictum est elit, ut scelerisque purus egestas in. Curabitur eget laoreet nisl. Aliquam erat volutpat.', 'vandipdonut.jpg', '1.99', '0.99', '2015-02-01 17:25:34', NULL, 0, 0),
(7, 1, 'Boston cream donut', 100, 10, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin accumsan posuere molestie.', 'Ut dictum est elit, ut scelerisque purus egestas in. Curabitur eget laoreet nisl. Aliquam erat volutpat.Ut dictum est elit, ut scelerisque purus egestas in. Curabitur eget laoreet nisl. Aliquam erat volutpat.', 'bcrdonut.jpg', '1.99', '0.99', '2015-02-01 17:26:49', NULL, 0, 0),
(8, 2, 'House Blend', 100, 10, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce cursus eget urna nec interdum.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce cursus eget urna nec interdum. Ut vel ex consequat, aliquam diam ut, dignissim sem. Pellentesque lobortis mi eget venenatis gravida. Pellentesque volutpat consectetur est, in maximus elit plac', 'hb_coffee.jpg', '1.50', '0.75', '2015-02-01 17:30:01', NULL, 0, 0),
(9, 1, 'Cheese Bread (pao de queijo)', 100, 10, 'This Brazilian snack made is a bun made of cheese and flour.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce cursus eget urna nec interdum. Ut vel ex consequat, aliquam diam ut, dignissim sem. Pellentesque lobortis mi eget venenatis gravida. Pellentesque volutpat consectetur est, in maximus elit plac', 'cheesebread.jpg', '1.99', '0.99', '2015-02-01 17:32:54', NULL, 0, 1),
(10, 2, 'Dark Blend', 100, 10, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce cursus eget urna nec interdum.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce cursus eget urna nec interdum. Ut vel ex consequat, aliquam diam ut, dignissim sem. Pellentesque lobortis mi eget venenatis gravida. Pellentesque volutpat consectetur est, in maximus elit plac', 'dbcofee.jpg', '1.50', '0.75', '2015-02-01 17:37:23', NULL, 0, 0),
(11, 2, 'Decaf Blend', 100, 10, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce cursus eget urna nec interdum.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce cursus eget urna nec interdum. Ut vel ex consequat, aliquam diam ut, dignissim sem. Pellentesque lobortis mi eget venenatis gravida. Pellentesque volutpat consectetur est, in maximus elit plac', 'decafcofee.jpg', '1.50', '0.75', '2015-02-01 17:37:23', NULL, 0, 0),
(12, 5, '4 Cheese cream', 100, 10, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce cursus eget urna nec interdum.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce cursus eget urna nec interdum. Ut vel ex consequat, aliquam diam ut, dignissim sem. Pellentesque lobortis mi eget venenatis gravida. Pellentesque volutpat consectetur est, in maximus elit plac', '4cheesecr.jpg', '5.59', '2.75', '2015-02-01 17:37:23', NULL, 0, 0),
(13, 5, 'Broccoli cream', 100, 10, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce cursus eget urna nec interdum.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce cursus eget urna nec interdum. Ut vel ex consequat, aliquam diam ut, dignissim sem. Pellentesque lobortis mi eget venenatis gravida. Pellentesque volutpat consectetur est, in maximus elit plac', 'brocream.jpg', '5.59', '2.75', '2015-02-01 17:37:23', NULL, 0, 0),
(14, 5, 'Baked potato and bacon cream', 100, 10, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce cursus eget urna nec interdum.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce cursus eget urna nec interdum. Ut vel ex consequat, aliquam diam ut, dignissim sem. Pellentesque lobortis mi eget venenatis gravida. Pellentesque volutpat consectetur est, in maximus elit plac', 'potbacon.jpg', '5.59', '2.75', '2015-02-01 17:37:23', NULL, 0, 0),
(15, 5, 'Mushroom cream', 100, 10, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce cursus eget urna nec interdum.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce cursus eget urna nec interdum. Ut vel ex consequat, aliquam diam ut, dignissim sem. Pellentesque lobortis mi eget venenatis gravida. Pellentesque volutpat consectetur est, in maximus elit plac', 'mushcream.jpg', '5.59', '2.75', '2015-02-01 17:37:23', NULL, 0, 0),
(16, 4, 'Chocolate milk shake', 100, 10, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce cursus eget urna nec interdum.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce cursus eget urna nec interdum. Ut vel ex consequat, aliquam diam ut, dignissim sem. Pellentesque lobortis mi eget venenatis gravida. Pellentesque volutpat consectetur est, in maximus elit plac', 'chmilkshake.jpg', '3.49', '1.75', '2015-02-01 17:37:23', NULL, 0, 0),
(17, 4, 'Vanilla milk shake', 100, 10, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce cursus eget urna nec interdum.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce cursus eget urna nec interdum. Ut vel ex consequat, aliquam diam ut, dignissim sem. Pellentesque lobortis mi eget venenatis gravida. Pellentesque volutpat consectetur est, in maximus elit plac', 'vnmilkshake.jpg', '3.49', '1.75', '2015-02-01 17:37:23', NULL, 0, 0),
(18, 7, 'Cheese steak', 100, 10, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce cursus eget urna nec interdum.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce cursus eget urna nec interdum. Ut vel ex consequat, aliquam diam ut, dignissim sem. Pellentesque lobortis mi eget venenatis gravida. Pellentesque volutpat consectetur est, in maximus elit plac', 'cheesesteak.jpg', '8.99', '3.50', '2015-02-01 17:37:23', NULL, 0, 0),
(19, 7, 'Ham and Cheese paninni', 100, 10, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce cursus eget urna nec interdum.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce cursus eget urna nec interdum. Ut vel ex consequat, aliquam diam ut, dignissim sem. Pellentesque lobortis mi eget venenatis gravida. Pellentesque volutpat consectetur est, in maximus elit plac', 'hmpanini.jpg', '8.99', '3.50', '2015-02-01 17:37:23', NULL, 0, 0),
(35, 8, 'Irish Coffee', 100, 10, 'The perfect blend of Coffee, Wiskey and Chantilly.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin accumsan posuere molestie. Ut dictum est elit, ut scelerisque purus egestas in. Curabitur eget laoreet nisl. Aliquam erat volutpat.', 'irishcoffee.jpg', '12.99', '6.00', '2015-02-01 19:33:06', NULL, 0, 0),
(36, 6, 'Egg Muffin', 100, 10, 'Egg Muffin is the best for breakfast.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin accumsan posuere molestie. Ut dictum est elit, ut scelerisque purus egestas in. Curabitur eget laoreet nisl. Aliquam erat volutpat.', 'eggmuffin.jpg', '5.69', '2.50', '2015-02-01 19:34:13', NULL, 0, 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
