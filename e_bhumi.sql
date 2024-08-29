-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 21, 2024 at 07:29 PM
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
-- Database: `e_bhumi`
--

-- --------------------------------------------------------

--
-- Table structure for table `feedbacks`
--

CREATE TABLE `feedbacks` (
  `_id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `subject` varchar(30) NOT NULL,
  `message` text NOT NULL,
  `posted_by_id` int(11) NOT NULL,
  `is_resolved` tinyint(1) DEFAULT 0,
  `is_reviewed` tinyint(1) DEFAULT 0,
  `is_spam` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `feedbacks`
--

INSERT INTO `feedbacks` (`_id`, `email`, `subject`, `message`, `posted_by_id`, `is_resolved`, `is_reviewed`, `is_spam`) VALUES
(2, 'suman@gmail.com', 'This is test', 'This is a test feedback.', 1, 0, 0, 0),
(3, 'Suman@gmail.com', 'Test 2', 'This is also test', 1, 0, 0, 0),
(4, 'suman@gmail.com', 'Test 3', 'Thiss is alssso testtt.', 1, 0, 0, 0),
(5, 'suman@gmail.com', 'Test 4', 'This is another tesst again', 1, 0, 0, 0),
(6, 'suman@gmail.com', 'Test 5', 'This iss anotnetjaopsdj ', 1, 0, 0, 0),
(7, 'suman@gmail.com', 'Test 6', 'This is once again another tesst, yessssss', 1, 0, 0, 0),
(8, 'Suman@gmail.com', 'Modal test', 'This is modal test for expected outcome of success.', 1, 0, 0, 0),
(9, 'suman@dhungana.com', 'Final modal success', 'Color change test', 1, 0, 0, 0),
(10, 'Suman@gmail.com', 'Test 10', 'Colorrrrrrrr', 1, 0, 0, 0),
(11, 'Suman@gmail.com', 'Posting Test', 'This is form posting test.', 1, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `properties`
--

CREATE TABLE `properties` (
  `_id` int(11) NOT NULL,
  `title` varchar(20) NOT NULL,
  `type` varchar(10) NOT NULL,
  `status` varchar(4) NOT NULL,
  `bhk` varchar(10) DEFAULT NULL,
  `description` text NOT NULL,
  `num_bedroom` int(11) DEFAULT NULL,
  `num_bathroom` int(11) DEFAULT NULL,
  `num_kitchen` int(11) DEFAULT NULL,
  `land_area` double DEFAULT NULL,
  `land_unit` varchar(7) DEFAULT NULL,
  `price` int(11) NOT NULL,
  `year_build` year(4) DEFAULT NULL,
  `view` varchar(6) NOT NULL,
  `province` varchar(30) NOT NULL,
  `municipality` varchar(30) NOT NULL,
  `district` varchar(30) NOT NULL,
  `tole` varchar(30) NOT NULL,
  `ward_no` int(11) NOT NULL,
  `latitude` double DEFAULT NULL,
  `longitude` double DEFAULT NULL,
  `registered_date` datetime NOT NULL,
  `is_active` tinyint(1) DEFAULT 1,
  `is_deleted` tinyint(1) DEFAULT 0,
  `posted_by_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `properties`
--

INSERT INTO `properties` (`_id`, `title`, `type`, `status`, `bhk`, `description`, `num_bedroom`, `num_bathroom`, `num_kitchen`, `land_area`, `land_unit`, `price`, `year_build`, `view`, `province`, `municipality`, `district`, `tole`, `ward_no`, `latitude`, `longitude`, `registered_date`, `is_active`, `is_deleted`, `posted_by_id`) VALUES
(1, 'Property 1', 'Apartment', 'Rent', '2 BHK', 'This is nice property.', 0, 1, 2, 2, '', 13442, '2013', 'North', 'Koshi', 'Itahari', 'Sunsari', 'JuteBikash', 6, NULL, NULL, '2024-03-19 14:02:31', 0, 1, 1),
(2, 'Land 1', 'House', 'Sale', '5 BHK', 'Asdadqwqwer12ewraesadss', 0, 0, 0, 23, 'Khatha', 123435, '1905', 'East', 'Koshi', 'Itahari', 'Sunsari', 'JuteBikash', 5, NULL, NULL, '2024-03-19 14:08:13', 1, 0, 1),
(3, 'Flat  1', 'Flat', 'Rent', '5 BHK', 'agsdfgwertwrsdfassdfsasdasdasgfasdss', 0, 1, 2, 2, 'Aana', 2132, '2009', 'East', 'Koshi', 'Birtanagar', 'Morang', 'Sansari', 15, NULL, NULL, '2024-03-19 14:11:25', 0, 1, 1),
(4, 'asdasdas', 'Flat', 'Sale', '', 'sadasdasdasdasfassdasdasdasdsadass', 0, 0, 0, 0, NULL, 231412312, '0000', 'East', 'Madhesh', 'assdasdas', 'asdasdas', 'sadasdas', 2, NULL, NULL, '2024-03-21 14:06:59', 1, 0, 1),
(5, 'sadasdasass', 'Flat', 'Rent', '', 'asdasdasdasdasdasdas', 0, 0, 0, 0, NULL, 12312312, '0000', 'West', 'Gandaki', 'assdassd', 'sadsadsa', 'dasdassd', 2, NULL, NULL, '2024-03-21 14:09:55', 1, 0, 1),
(6, 'asdas', 'House', 'Sale', '', 'assdassdasdas', 0, 0, 0, 0, NULL, 12311231, '0000', 'East', 'Gandaki', 'sasdas', 'asdasdsa', 'assdasdas', 1, NULL, NULL, '2024-03-21 14:23:29', 0, 1, 1),
(7, 'asdas', 'House', 'Sale', '', 'assdassdasdas', 0, 0, 0, 0, NULL, 12311231, '0000', 'East', 'Gandaki', 'sasdas', 'asdasdsa', 'assdasdas', 1, NULL, NULL, '2024-03-21 14:23:41', 1, 0, 1),
(8, 'asdas', 'House', 'Sale', '', 'assdassdasdas', 0, 0, 0, 0, NULL, 12311231, '0000', 'East', 'Gandaki', 'sasdas', 'asdasdsa', 'assdasdas', 1, NULL, NULL, '2024-03-21 14:24:10', 1, 0, 1),
(9, 'asdasdassdass', 'House', 'Sale', '', 'asgasssdasdas', 0, 0, 0, 0, NULL, 2131, '0000', 'East', 'Gandaki', 'sasdasd', 'asdasdas', 'sasdas', 2, NULL, NULL, '2024-03-21 14:24:31', 1, 0, 1),
(10, 'asdasdas', 'Apartment', 'Sale', '', 'asfassfdadfcsadsfas', 0, 0, 0, 0, NULL, 12312, '0000', 'West', 'Bagmati', 'asdasdas', 'asdsas', 'asdas', 2, NULL, NULL, '2024-03-21 14:25:32', 1, 0, 1),
(11, 'asdasd', 'Villa', 'Sale', '', 'safgasdfsdassdasasds', 0, 0, 0, 0, NULL, 12312, '0000', 'West', 'Gandaki', 'assdas', 'assdasdas', 'asdsfdassda', 2, NULL, NULL, '2024-03-21 14:28:40', 1, 0, 1),
(12, 'asdassdasasd', 'Apartment', 'Rent', '', 'asdasadsfasfassdasdasdasassd', 0, 0, 0, 0, NULL, 21312312, '0000', 'East', 'Madhesh', 'sadsasdas', 'asdasdass', 'asdas', 2, NULL, NULL, '2024-03-21 14:34:58', 1, 0, 1),
(13, 'asdassdasasd', 'Apartment', 'Rent', '', 'asdasadsfasfassdasdasdasassd', 0, 0, 0, 0, NULL, 21312312, '0000', 'East', 'Madhesh', 'sadsasdas', 'asdasdass', 'asdas', 2, NULL, NULL, '2024-03-21 14:35:15', 1, 0, 1),
(14, 'assdasdasads', 'Apartment', 'Rent', '', 'asdgasdfddasdasdassdas', 0, 1, 0, 0, NULL, 2131223, '0000', 'West', 'Bagmati', 'assssdassdas', 'asdasdsadas', 'asdasdsa', 2, NULL, NULL, '2024-03-21 14:43:21', 1, 0, 1),
(15, 'sazdgasdq2ewasasds', 'Flat', 'Sale', '', 'assfassdassdassdsa', 0, 0, 0, 0, NULL, 2312, '0000', 'West', 'Gandaki', 'asdfasgfasd', 'asdfasfdasds', 'dgfaSdfcas', 2, NULL, NULL, '2024-03-21 14:46:55', 1, 0, 1),
(16, 'sadfadssads', 'Flat', 'Sale', '', 'asdfasdasgbazdsfaxszsczx', 0, 0, 0, 0, NULL, 2312, '0000', 'North', 'Gandaki', 'asfas', 'dasdas', 'asdassdas', 2, NULL, NULL, '2024-03-21 14:48:51', 1, 0, 1),
(17, 'asfgasdsass', 'Villa', 'Sale', '', 'asgasdassdsad', 0, 0, 0, 0, NULL, 21312, '0000', 'East', 'Madhesh', 'asdas', 'asdfas', 'asdas', 3, NULL, NULL, '2024-03-21 14:51:22', 1, 0, 1),
(18, 'ASFDASFASDFAS', 'Flat', 'Sale', '', 'SGADASSFASDFASSDASDAS', 0, 0, 0, 0, NULL, 1231212, '0000', 'West', 'Madhesh', 'ASSDASDAS', 'ASDASDAS', 'ASDASD', 2, NULL, NULL, '2024-03-21 14:55:42', 1, 0, 1),
(19, 'ASFASSDASDAS', 'House', 'Sale', '', 'ASGFADASDAS', 0, 0, 0, 0, NULL, 21312321, '0000', 'East', 'Bagmati', '12124SSDASDS', 'ASDASSD', 'ASFASSDFSAS', 12, NULL, NULL, '2024-03-21 14:57:29', 1, 0, 1),
(20, 'asfassdf', 'Villa', 'Rent', '', 'safasdasdsa', 0, 0, 0, 0, NULL, 2131, '0000', 'North', 'Gandaki', 'assdasd', 'asdasdsas', '23esasdsas', 2, NULL, NULL, '2024-03-21 14:59:40', 1, 0, 1),
(21, 'sadasdas', 'House', 'Sale', '', 'asfasdfasdasdas', 0, 0, 0, 0, NULL, 21312312, '0000', 'North', 'Gandaki', 'asdassd', 'asdas', 'asddas', 2, NULL, NULL, '2024-03-21 15:02:42', 1, 0, 1),
(22, 'sadasdas', 'Flat', 'Rent', '', 'adasdasdasdasdadsaadsassdasdasdasdasdadassadasdasd', 0, 0, 0, 0, NULL, 2312, '0000', 'West', 'Sudurpashchim', 'asdas', 'dasdasdas', 'dasdass', 2, NULL, NULL, '2024-03-21 15:04:54', 1, 0, 1),
(23, 'asdasdassdas', 'Flat', 'Rent', '', 'gasasdasdsadasdasdasdassdass', 0, 0, 0, 0, NULL, 21312, '0000', 'North', 'Koshi', 'assdas', 'sadasdassdsa', 'saasssdasdas', 3, NULL, NULL, '2024-03-21 15:06:20', 1, 0, 1),
(24, 'sadassdasdas', 'Apartment', 'Sale', '', 'agsdgfasssdasdasdasdsasdasdasdasdasdas', 0, 0, 0, 0, NULL, 21312, '0000', 'West', 'Gandaki', 'asdasd', 'asdasdsa', 'asdasdas', 2, NULL, NULL, '2024-03-21 15:08:52', 1, 0, 1),
(25, 'asdasdasdasdas', 'Flat', 'Sale', '', 'asfasdfasdsadasdasdasdasdasdasdasd', 0, 0, 0, 0, NULL, 1231231212, '0000', 'North', 'Bagmati', 'assdsad', 'asdsasdas', 'dasdas', 2, NULL, NULL, '2024-03-21 15:14:23', 1, 0, 1),
(26, 'asdasdassad', 'House', 'Sale', '', 'asdasdsadasdasdasdas', 0, 0, 0, 0, NULL, 2133123, '0000', 'North', 'Bagmati', 'asdasdas', 'asdasdas', 'asdasd2', 2, NULL, NULL, '2024-03-21 15:16:17', 1, 0, 1),
(27, 'asdasdas', 'Apartment', 'Sale', '', 'asdagdsasdasdasdasdasdasdas', 0, 0, 0, 0, NULL, 12312312, '0000', 'West', 'Gandaki', 'asdasdas', 'asdasdasss', 'asdasdas', 2, NULL, NULL, '2024-03-21 15:17:31', 1, 0, 1),
(28, 'sadasd', 'Flat', 'Rent', '', 'asdfasdasdasdasdasdas', 0, 0, 0, 0, NULL, 21312, '0000', 'West', 'Madhesh', 'asssdas', 'assdasdas', 'asddasdas', 2, NULL, NULL, '2024-03-21 15:20:40', 0, 1, 1),
(29, 'asdasd', 'Flat', 'Sale', '', 'asgfasdasdadasdasdas', 0, 0, 1, 0, NULL, 21312, '0000', 'West', 'Bagmati', 'asd', 'dasdasdsa', 'asdas', 2, NULL, NULL, '2024-03-21 15:21:52', 0, 1, 1),
(30, 'Asdasdasdasdas', 'House', 'Sale', '', 'Asdassdasfassdasdasdasdasdasdas', 0, 0, 0, 0, NULL, 21312312, '1901', 'South', 'Madhesh', 'Asdasdas', 'Asdasdasdsa', 'Assdasdass', 4, NULL, NULL, '2024-03-21 15:23:04', 1, 0, 1),
(31, 'sadsassdas', 'House', 'Rent', '', 'asdasdasdasdasasdasdassdas', 0, 0, 0, 0, NULL, 12312, '0000', 'North', 'Madhesh', 'asdasdass', 'assdasdas', 'assdasdas', 1, NULL, NULL, '2024-03-21 15:49:36', 1, 0, 1),
(32, 'asasdasdasd', 'Villa', 'Sale', '', 'assdasdasdsadasda', 0, 0, 0, 0, NULL, 12312, '0000', 'West', 'Bagmati', 'assdass', 'asdasdas', 'asdas', 2, NULL, NULL, '2024-03-21 15:51:41', 1, 0, 1),
(33, 'ssadsasd', 'Flat', 'Sale', '', 'asafassdasxczxcxzacfas', 0, 0, 0, 0, NULL, 21312, '0000', 'West', 'Bagmati', 'asdassd', 'asdas', 'asdasdas', 2, NULL, NULL, '2024-03-21 15:55:23', 1, 0, 1),
(34, 'sfafdas', 'House', 'Rent', '3 BHK', 'asdasdassdasdass', 0, 0, 0, 0, NULL, 123, '0000', 'East', 'Gandaki', 'asdas', 'asdasd', 'asassdasdas', 2, NULL, NULL, '2024-03-21 15:58:12', 1, 0, 1),
(35, 'asssdass', 'Flat', 'Sale', '', 'assdasdassdassdasdas', 0, 0, 0, 0, NULL, 1233, '0000', 'North', 'Madhesh', 'asdass', 'asdas', 'asdas', 2, NULL, NULL, '2024-03-21 15:59:07', 1, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `property_images`
--

CREATE TABLE `property_images` (
  `_id` int(11) NOT NULL,
  `file_name` text NOT NULL,
  `file_path` text NOT NULL,
  `is_deleted` tinyint(1) DEFAULT 0,
  `image_hash` text NOT NULL,
  `property_id` int(11) NOT NULL,
  `is_thumbnail` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `property_images`
--

INSERT INTO `property_images` (`_id`, `file_name`, `file_path`, `is_deleted`, `image_hash`, `property_id`, `is_thumbnail`) VALUES
(1, '65f98efdc1eb1_636931242356747337.jpg', 'images/property/65f98efdc1eb1_636931242356747337.jpg', 0, '391e77247b8e16b1bf639f76dbeaf8ac4da792306afa319363790ca4780f148d', 3, 0),
(2, '65f98efdc6085_951020794967196019.jpg', 'images/property/65f98efdc6085_951020794967196019.jpg', 0, '43acaa1846287fb1619bfff90a0dda567ad7d8cbcf827a5669f147f56cb3fdb1', 3, 0),
(3, '65f98efdca7c2_951020794967196020.jpg', 'images/property/65f98efdca7c2_951020794967196020.jpg', 0, '78be43218d58d462c76c4ed901961f54a5831abcb72e69c0764a5624e8536d0b', 3, 0),
(4, '65f98efdcedc9_1072261458757909808.jpg', 'images/property/65f98efdcedc9_1072261458757909808.jpg', 0, '39270b0dc31b1abed877853f333511fd1392e498df85804f3b6b88570909e75b', 3, 0),
(5, '65f98efdd2909_1836759992344366409.jpg', 'images/property/65f98efdd2909_1836759992344366409.jpg', 0, 'ff8b098b8de61d0d0979aa49e9bd7cba1edb487608477283208ab594153e4fc4', 3, 0),
(6, '65fc3608abbe4_k8I1VTJ.jpeg', 'images/property/65fc3608abbe4_k8I1VTJ.jpeg', 0, '21e699e6b06a192fcd2439d793b0de2e0eba3d1e75cb970531a0d16bdc891d32', 11, 0),
(7, '65fc378252b2d_k8I1VTJ.jpeg', 'images/property/65fc378252b2d_k8I1VTJ.jpeg', 0, '21e699e6b06a192fcd2439d793b0de2e0eba3d1e75cb970531a0d16bdc891d32', 12, 0),
(8, '65fc3793b6847_k8I1VTJ.jpeg', 'images/property/65fc3793b6847_k8I1VTJ.jpeg', 0, '21e699e6b06a192fcd2439d793b0de2e0eba3d1e75cb970531a0d16bdc891d32', 13, 0),
(9, '65fc39797a8ed_k8I1VTJ.jpeg', 'images/property/65fc39797a8ed_k8I1VTJ.jpeg', 0, '21e699e6b06a192fcd2439d793b0de2e0eba3d1e75cb970531a0d16bdc891d32', 14, 0),
(10, '65fc3a4f6c52a_k8I1VTJ.jpeg', 'images/property/65fc3a4f6c52a_k8I1VTJ.jpeg', 0, '21e699e6b06a192fcd2439d793b0de2e0eba3d1e75cb970531a0d16bdc891d32', 15, 0),
(11, '65fc3b5a5dda6_1fd1c73fd72698fb1195f54b6c7b9341.jpg', 'images/property/65fc3b5a5dda6_1fd1c73fd72698fb1195f54b6c7b9341.jpg', 0, '402dbe03e462a586948bba463ae7f5a2351ebace435883b2c0152e6c5691f10c', 17, 0),
(12, '65fc3c5e0a0df_1fd1c73fd72698fb1195f54b6c7b9341.jpg', 'images/property/65fc3c5e0a0df_1fd1c73fd72698fb1195f54b6c7b9341.jpg', 0, '402dbe03e462a586948bba463ae7f5a2351ebace435883b2c0152e6c5691f10c', 18, 0),
(13, '65fc3cc958217_1fd1c73fd72698fb1195f54b6c7b9341.jpg', 'images/property/65fc3cc958217_1fd1c73fd72698fb1195f54b6c7b9341.jpg', 0, '402dbe03e462a586948bba463ae7f5a2351ebace435883b2c0152e6c5691f10c', 19, 0),
(14, '65fc3d4c49a06_1fd1c73fd72698fb1195f54b6c7b9341.jpg', 'images/property/65fc3d4c49a06_1fd1c73fd72698fb1195f54b6c7b9341.jpg', 0, '402dbe03e462a586948bba463ae7f5a2351ebace435883b2c0152e6c5691f10c', 20, 0),
(15, '65fc3e020bd11_1fd1c73fd72698fb1195f54b6c7b9341.jpg', 'images/property/65fc3e020bd11_1fd1c73fd72698fb1195f54b6c7b9341.jpg', 0, '402dbe03e462a586948bba463ae7f5a2351ebace435883b2c0152e6c5691f10c', 21, 0),
(16, '65fc3f741c3d5_1fd1c73fd72698fb1195f54b6c7b9341.jpg', 'images/property/65fc3f741c3d5_1fd1c73fd72698fb1195f54b6c7b9341.jpg', 0, '402dbe03e462a586948bba463ae7f5a2351ebace435883b2c0152e6c5691f10c', 24, 0),
(17, '65fc40bf1b7dc_1fd1c73fd72698fb1195f54b6c7b9341.jpg', 'images/property/65fc40bf1b7dc_1fd1c73fd72698fb1195f54b6c7b9341.jpg', 0, '402dbe03e462a586948bba463ae7f5a2351ebace435883b2c0152e6c5691f10c', 25, 0),
(18, '65fc4131e9339_k8I1VTJ.jpeg', 'images/property/65fc4131e9339_k8I1VTJ.jpeg', 0, '21e699e6b06a192fcd2439d793b0de2e0eba3d1e75cb970531a0d16bdc891d32', 26, 0),
(19, '65fc417b89b84_k8I1VTJ.jpeg', 'images/property/65fc417b89b84_k8I1VTJ.jpeg', 0, '21e699e6b06a192fcd2439d793b0de2e0eba3d1e75cb970531a0d16bdc891d32', 27, 0),
(20, '65fc42c89c508_mountainRange.jpg', 'images/property/65fc42c89c508_mountainRange.jpg', 0, '090616a77f6802b6573821bbf33cc06b0d75ffdca7c208c253737b3ca72ac6f9', 30, 1),
(21, '65fc4a5bb0153_mountainRange.jpg', 'images/property/65fc4a5bb0153_mountainRange.jpg', 0, '090616a77f6802b6573821bbf33cc06b0d75ffdca7c208c253737b3ca72ac6f9', 33, 1),
(22, '65fc4b04b241c_mountainRange.jpg', 'images/property/65fc4b04b241c_mountainRange.jpg', 0, '090616a77f6802b6573821bbf33cc06b0d75ffdca7c208c253737b3ca72ac6f9', 34, 1),
(23, '65fc4b3bdbc2b_mountainRange.jpg', 'images/property/65fc4b3bdbc2b_mountainRange.jpg', 0, '090616a77f6802b6573821bbf33cc06b0d75ffdca7c208c253737b3ca72ac6f9', 35, 1),
(24, '65fc4b3bdccaa_1fd1c73fd72698fb1195f54b6c7b9341.jpg', 'images/property/65fc4b3bdccaa_1fd1c73fd72698fb1195f54b6c7b9341.jpg', 0, '402dbe03e462a586948bba463ae7f5a2351ebace435883b2c0152e6c5691f10c', 35, 0),
(25, '65fc4b3be0556_54aa604b08a204ed73fc55530d7c60b9.jpg', 'images/property/65fc4b3be0556_54aa604b08a204ed73fc55530d7c60b9.jpg', 0, '30e20afbfda3504fec12e4979dae7f0f255712c33be13098976733b1d4245659', 35, 0);

-- --------------------------------------------------------

--
-- Table structure for table `teams`
--

CREATE TABLE `teams` (
  `_id` int(11) NOT NULL,
  `first_name` varchar(10) NOT NULL,
  `last_name` varchar(15) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `country_code` varchar(4) DEFAULT NULL,
  `phone_number` varchar(10) DEFAULT NULL,
  `description` text NOT NULL,
  `social_link` text NOT NULL,
  `file_path` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `teams`
--

INSERT INTO `teams` (`_id`, `first_name`, `last_name`, `email`, `country_code`, `phone_number`, `description`, `social_link`, `file_path`) VALUES
(1, 'Suman', 'Dhungana', 'Sumandhungana85@gmail.com', '+977', '9817357297', 'Developed robust server-side functionality and integrated it seamlessly to Bootstrap frontend using php.', 'https://www.facebook.com/SumanDhng/', 'images/team/03.jpg'),
(2, 'Bikesh', 'Kc', 'Bikeshkc321@gmail.com', '+977', '9824330782', 'Crafted visually appealing and responsive website interfaces using Bootstrap, HTML, and CSS.', 'https://www.facebook.com/bikesh.kc.90', 'images/team/02.jpg'),
(3, 'Aayush', 'Luitel', 'Aayushluitel797@gmail.com', '+977', '9840279841', 'Produced clear and concise documentation outlining the development process and architecture.', 'https://www.facebook.com/aayush.luitel', 'images/team/01.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `_id` int(11) NOT NULL,
  `first_name` varchar(10) NOT NULL,
  `last_name` varchar(15) NOT NULL,
  `email` varchar(255) NOT NULL,
  `country_code` varchar(4) NOT NULL,
  `phone_number` varchar(10) NOT NULL,
  `password` text NOT NULL,
  `role` varchar(15) NOT NULL,
  `is_active` tinyint(1) DEFAULT 1,
  `is_deleted` tinyint(1) DEFAULT 0,
  `registered_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`_id`, `first_name`, `last_name`, `email`, `country_code`, `phone_number`, `password`, `role`, `is_active`, `is_deleted`, `registered_date`) VALUES
(1, 'Suman', 'Dhungana', 'suman@gmail.com', '+977', '9817357297', '$2y$10$6UJz3JA7.fu933c1t7.L1eE9i0R4xDB/6JuBsnJ/BEoQXwRfXfsO6', 'super_admin', 1, 0, '2024-03-19 13:38:30'),
(2, 'Bikesh', 'KC', 'Bikesh@gmail.com', '+977', '9821451511', '$2y$10$EucdJGEeYg/I46v27B5r7OwPwayVu/P/YhN8zlCEez0ixxu0LcIEe', 'admin', 1, 0, '2024-03-19 13:41:54'),
(4, 'Aayush', 'Luitel', 'aayush@gmail.com', '+977', '9857329211', '$2y$10$hHefq2r7d/wJ4Qa7KcWqfOdruXgeLiad6ThNM8KblmhLEtultSLdi', 'user', 1, 0, '2024-03-20 13:11:39'),
(6, 'Susan', 'Dahal', 'Susan@gmail.com', '+977', '9812332141', '$2y$10$I50oHM4AnztOVxxNRfKnz.zyPaVP03EC90x48T2FMR3YZwd/Ep47m', 'user', 0, 1, '2024-03-20 15:02:28');

-- --------------------------------------------------------

--
-- Table structure for table `user_images`
--

CREATE TABLE `user_images` (
  `_id` int(11) NOT NULL,
  `file_name` text NOT NULL,
  `file_path` text NOT NULL,
  `is_deleted` tinyint(1) DEFAULT 0,
  `image_hash` text NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_images`
--

INSERT INTO `user_images` (`_id`, `file_name`, `file_path`, `is_deleted`, `image_hash`, `user_id`) VALUES
(1, '65f987461d299_Suman.jpg', 'images/users/65f982aba8fdc_Suman.jpg', 0, 'c350c3381c8eef22899c4adcd1ac5a4c9c4f392c4faf328e6285d8ca302b37a3', 1),
(2, '65f98812c7be7_02.jpg', 'images/users/65f98812c7be7_02.jpg', 0, 'b08bc98769fdce4a2dd4ee6e70a23f8a00b25e35b33d79a7aa24b62a96b3306a', 2),
(3, '65fad27be0b0b_01.jpg', 'images/users/65fad27be0b0b_01.jpg', 0, '9a9b740b781e6dabf4fac33c44c53cc98734ffe5cd6d9341d1f5e5a222af1fc8', 4);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `feedbacks`
--
ALTER TABLE `feedbacks`
  ADD PRIMARY KEY (`_id`),
  ADD KEY `feedback_by_fk_auth_users` (`posted_by_id`);

--
-- Indexes for table `properties`
--
ALTER TABLE `properties`
  ADD PRIMARY KEY (`_id`),
  ADD KEY `posted_by_fk` (`posted_by_id`);

--
-- Indexes for table `property_images`
--
ALTER TABLE `property_images`
  ADD PRIMARY KEY (`_id`),
  ADD KEY `posted_on_property` (`property_id`);

--
-- Indexes for table `teams`
--
ALTER TABLE `teams`
  ADD PRIMARY KEY (`_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`_id`);

--
-- Indexes for table `user_images`
--
ALTER TABLE `user_images`
  ADD PRIMARY KEY (`_id`),
  ADD KEY `image_of_users` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `feedbacks`
--
ALTER TABLE `feedbacks`
  MODIFY `_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `properties`
--
ALTER TABLE `properties`
  MODIFY `_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `property_images`
--
ALTER TABLE `property_images`
  MODIFY `_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `teams`
--
ALTER TABLE `teams`
  MODIFY `_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `user_images`
--
ALTER TABLE `user_images`
  MODIFY `_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `feedbacks`
--
ALTER TABLE `feedbacks`
  ADD CONSTRAINT `feedback_by_fk_users` FOREIGN KEY (`posted_by_id`) REFERENCES `users` (`_id`) ON UPDATE CASCADE;

--
-- Constraints for table `properties`
--
ALTER TABLE `properties`
  ADD CONSTRAINT `posted_by_fk` FOREIGN KEY (`posted_by_id`) REFERENCES `users` (`_id`) ON UPDATE CASCADE;

--
-- Constraints for table `property_images`
--
ALTER TABLE `property_images`
  ADD CONSTRAINT `posted_on_property` FOREIGN KEY (`property_id`) REFERENCES `properties` (`_id`) ON UPDATE CASCADE;

--
-- Constraints for table `user_images`
--
ALTER TABLE `user_images`
  ADD CONSTRAINT `image_of_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`_id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
