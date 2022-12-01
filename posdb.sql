-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 01, 2022 at 01:01 PM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `posdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `categoryid` int(11) NOT NULL,
  `categoryname` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`categoryid`, `categoryname`) VALUES
(7, 'Chair'),
(8, 'Sofa'),
(9, 'New Test');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `comment_id` int(11) NOT NULL,
  `comment_subject` varchar(250) NOT NULL,
  `comment_text` text NOT NULL,
  `comment_status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `customerid` int(11) NOT NULL,
  `customername` varchar(30) NOT NULL,
  `customerpassword` varchar(30) NOT NULL,
  `customeremail` varchar(30) NOT NULL,
  `customerphonenumber` varchar(30) NOT NULL,
  `customeraddress` varchar(30) NOT NULL,
  `customerprofile` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customerid`, `customername`, `customerpassword`, `customeremail`, `customerphonenumber`, `customeraddress`, `customerprofile`) VALUES
(32, 'oop', 'oop', 'oop@gmail.com', 'oop', '					oop				', 'images/_https___hypebeast.com_image_2021_06_brabus-900-rocket-edition-mercedes-amg-g63-g-wagon-tuned-custom-900hp-power-speed-0.jpg'),
(34, 'Andrew edit', 'kmd', 'soe153appleid@gmail.com', '009', '					ygn				', 'images/_244333954_244200051056011_7250399859362412248_n.jpg'),
(35, 'fsdf', 'ssdf34', 'kljhafdasfdgjkj@gmali.com', '34243', 'sdf', 'images/_catcat.jpg'),
(36, 'tset78', '89s', 'oo56p@gmail.com', '099', 'ygn', 'images/_catcat.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `delivery`
--

CREATE TABLE `delivery` (
  `deliveryID` int(11) NOT NULL,
  `cusName` varchar(30) NOT NULL,
  `orderid` varchar(50) NOT NULL,
  `cusAddress` varchar(50) NOT NULL,
  `cusPhone` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `delivery`
--

INSERT INTO `delivery` (`deliveryID`, `cusName`, `orderid`, `cusAddress`, `cusPhone`) VALUES
(6, 'Andrew', 'OR-000106', 'YGN', '0988'),
(7, 'Andrew 001 ', 'OR-000107', 'YYGN', '0989898'),
(8, 'Andrew89', 'OR-000108', '88', '88'),
(9, 'Andrew56', 'OR-000109', '56', '56');

-- --------------------------------------------------------

--
-- Table structure for table `fileupload`
--

CREATE TABLE `fileupload` (
  `files` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `fileupload`
--

INSERT INTO `fileupload` (`files`) VALUES
('images/_277734912_389341183196917_2606121371545654812_n.jpg'),
('images/_wanted.php'),
('images/_PDF Store_v1.0_apkpure.com.xapk'),
('images/_274040960_1144073663023273_5233969900527279082_n.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `item`
--

CREATE TABLE `item` (
  `id` int(11) NOT NULL,
  `categoryid` int(11) NOT NULL,
  `productid` int(11) NOT NULL,
  `item_name` int(50) NOT NULL,
  `item_quantity` int(11) NOT NULL,
  `item_name1` int(50) NOT NULL,
  `item_quantity1` int(11) NOT NULL,
  `item_name2` int(11) NOT NULL,
  `item_quantity2` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `item`
--

INSERT INTO `item` (`id`, `categoryid`, `productid`, `item_name`, `item_quantity`, `item_name1`, `item_quantity1`, `item_name2`, `item_quantity2`) VALUES
(96, 7, 23, 18, 12, 0, 0, 0, 0),
(97, 8, 14, 17, 30, 18, 20, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `itemdetail`
--

CREATE TABLE `itemdetail` (
  `categoryid` int(11) NOT NULL,
  `productid` int(11) NOT NULL,
  `rawid` int(11) NOT NULL,
  `rawqty` int(11) NOT NULL,
  `staffid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `itemdetail`
--

INSERT INTO `itemdetail` (`categoryid`, `productid`, `rawid`, `rawqty`, `staffid`) VALUES
(7, 13, 17, 100, 45),
(7, 13, 18, 100, 45),
(7, 13, 19, 100, 45),
(7, 15, 17, 44, 45),
(7, 15, 18, 4, 45),
(7, 19, 17, 5, 46),
(7, 19, 18, 1, 46),
(7, 44, 17, 11, 46),
(8, 14, 17, 10, 46),
(8, 14, 18, 10, 46),
(7, 47, 17, 3, 46);

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `staffid` int(11) NOT NULL,
  `messageid` int(11) NOT NULL,
  `messagedate` datetime NOT NULL,
  `message_title` varchar(200) NOT NULL,
  `messagedescription` varchar(900) NOT NULL,
  `message_status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`staffid`, `messageid`, `messagedate`, `message_title`, `messagedescription`, `message_status`) VALUES
(46, 30, '2022-06-15 21:41:15', 'Today Evening Meeting', '3rd floor, K-36 room, at 5:00 p.m. (To all staff))', 1),
(46, 31, '2022-06-16 07:33:49', 'Meeting at Tomorrow', 'At 12.00 a.m.', 1),
(46, 32, '2022-12-01 12:10:29', 'Test_1', 'This is the test message', 1);

-- --------------------------------------------------------

--
-- Table structure for table `orderdetail`
--

CREATE TABLE `orderdetail` (
  `orderid` varchar(30) NOT NULL,
  `productid` int(11) NOT NULL,
  `unitprice` int(11) NOT NULL,
  `unitquantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orderdetail`
--

INSERT INTO `orderdetail` (`orderid`, `productid`, `unitprice`, `unitquantity`) VALUES
('OR-000001', 12, 170000, 1),
('OR-000002', 18, 100000, 5),
('OR-000003', 18, 100000, 1),
('OR-000004', 14, 500000, 10),
('OR-000005', 16, 250000, 2),
('OR-000006', 20, 130000, 2),
('OR-000006', 19, 120000, 1),
('OR-000006', 13, 200000, 1),
('OR-000006', 21, 999, 1),
('OR-000007', 23, 50000, 50),
('OR-000008', 21, 999, 98),
('OR-000009', 18, 100000, 1),
('OR-000009', 19, 120000, 5),
('OR-000010', 18, 100000, 1),
('OR-000010', 19, 120000, 5),
('OR-000010', 23, 50000, 3),
('OR-000011', 18, 100000, 1),
('OR-000011', 19, 120000, 5),
('OR-000011', 23, 50000, 3),
('OR-000012', 18, 100000, 1),
('OR-000012', 19, 120000, 5),
('OR-000012', 23, 50000, 3),
('OR-000013', 18, 100000, 1),
('OR-000013', 19, 120000, 5),
('OR-000013', 23, 50000, 3),
('OR-000013', 25, 500, 2),
('OR-000014', 18, 100000, 1),
('OR-000014', 19, 120000, 5),
('OR-000014', 23, 50000, 3),
('OR-000014', 25, 500, 2),
('OR-000015', 18, 100000, 1),
('OR-000015', 19, 120000, 5),
('OR-000015', 23, 50000, 3),
('OR-000015', 25, 500, 2),
('OR-000015', 16, 250000, 2),
('OR-000016', 18, 100000, 1),
('OR-000016', 19, 120000, 5),
('OR-000016', 23, 50000, 3),
('OR-000016', 25, 500, 2),
('OR-000016', 16, 250000, 2),
('OR-000016', 26, 500, 2),
('OR-000017', 18, 100000, 1),
('OR-000017', 19, 120000, 5),
('OR-000017', 23, 50000, 3),
('OR-000017', 25, 500, 2),
('OR-000017', 16, 250000, 2),
('OR-000017', 26, 500, 2),
('OR-000018', 24, 10000, 2),
('OR-000019', 24, 10000, 2),
('OR-000019', 20, 130000, 2),
('OR-000019', 17, 50000, 1),
('OR-000020', 24, 10000, 2),
('OR-000020', 20, 130000, 2),
('OR-000020', 17, 50000, 1),
('OR-000020', 12, 170000, 1),
('OR-000021', 24, 10000, 2),
('OR-000021', 20, 130000, 2),
('OR-000021', 17, 50000, 1),
('OR-000021', 12, 170000, 1),
('OR-000021', 14, 500000, 2),
('OR-000022', 24, 10000, 2),
('OR-000022', 20, 130000, 2),
('OR-000022', 17, 50000, 1),
('OR-000022', 12, 170000, 1),
('OR-000022', 14, 500000, 2),
('OR-000023', 24, 10000, 2),
('OR-000023', 20, 130000, 2),
('OR-000023', 17, 50000, 1),
('OR-000023', 12, 170000, 1),
('OR-000023', 14, 500000, 2),
('OR-000024', 13, 200000, 1),
('OR-000025', 14, 500000, 1),
('OR-000026', 14, 500000, 1),
('OR-000027', 14, 500000, 1),
('OR-000027', 21, 999, 1),
('OR-000028', 17, 50000, 1),
('OR-000029', 15, 300000, 6),
('OR-000030', 15, 300000, 6),
('OR-000031', 17, 50000, 1),
('OR-000032', 17, 50000, 1),
('OR-000033', 15, 300000, 6),
('OR-000034', 15, 300000, 6),
('OR-000035', 15, 300000, 6),
('OR-000036', 17, 50000, 1),
('OR-000037', 16, 250000, 1),
('OR-000038', 16, 250000, 1),
('OR-000039', 13, 200000, 1),
('OR-000040', 13, 200000, 1),
('OR-000041', 24, 10000, 1),
('OR-000042', 13, 200000, 1),
('OR-000043', 13, 200000, 1),
('OR-000044', 13, 200000, 1),
('OR-000045', 13, 200000, 1),
('OR-000046', 13, 200000, 3),
('OR-000047', 14, 500000, 1),
('OR-000048', 14, 500000, 1),
('OR-000049', 24, 10000, 1),
('OR-000050', 24, 10000, 1),
('OR-000050', 14, 500000, 2),
('OR-000051', 14, 500000, 1),
('OR-000052', 20, 130000, 1),
('OR-000053', 20, 130000, 1),
('OR-000054', 20, 130000, 1),
('OR-000055', 20, 130000, 1),
('OR-000056', 20, 130000, 1),
('OR-000057', 20, 130000, 1),
('OR-000058', 15, 300000, 1),
('OR-000059', 44, 100000, 2),
('OR-000060', 44, 100000, 2),
('OR-000061', 44, 100000, 2),
('OR-000061', 12, 170000, 1),
('OR-000062', 44, 100000, 2),
('OR-000062', 12, 170000, 1),
('OR-000063', 44, 100000, 2),
('OR-000063', 12, 170000, 1),
('OR-000064', 44, 100000, 1),
('OR-000065', 44, 100000, 1),
('OR-000065', 16, 250000, 1),
('OR-000066', 44, 100000, 1),
('OR-000066', 16, 250000, 1),
('OR-000067', 14, 500000, 1),
('OR-000068', 14, 500000, 1),
('OR-000069', 14, 500000, 1),
('OR-000069', 44, 100000, 2),
('OR-000070', 14, 500000, 1),
('OR-000071', 14, 500000, 1),
('OR-000071', 13, 200000, 1),
('OR-000072', 15, 300000, 1),
('OR-000073', 18, 100000, 6),
('OR-000073', 12, 170000, 1),
('OR-000074', 20, 130000, 1),
('OR-000074', 13, 200000, 2),
('OR-000075', 12, 170000, 10),
('OR-000075', 13, 200000, 7),
('OR-000076', 15, 300000, 1),
('OR-000077', 15, 300000, 1),
('OR-000078', 14, 500000, 1),
('OR-000079', 16, 250000, 1),
('OR-000080', 15, 300000, 1),
('OR-000081', 20, 130000, 1),
('OR-000082', 17, 50000, 1),
('OR-000083', 17, 50000, 1),
('OR-000084', 14, 500000, 1),
('OR-000085', 14, 500000, 1),
('OR-000086', 14, 500000, 1),
('OR-000087', 14, 500000, 1),
('OR-000088', 14, 500000, 1),
('OR-000089', 14, 500000, 1),
('OR-000090', 14, 500000, 1),
('OR-000091', 15, 300000, 1),
('OR-000092', 14, 500000, 1),
('OR-000093', 14, 500000, 1),
('OR-000094', 14, 500000, 1),
('OR-000095', 15, 300000, 2),
('OR-000096', 14, 500000, 1),
('', 14, 500000, 1),
('OR-000097', 14, 500000, 1),
('OR-000098', 14, 500000, 2),
('OR-000098', 17, 50000, 1),
('OR-000099', 14, 500000, 1),
('OR-000100', 15, 300000, 1),
('OR-000101', 18, 100000, 3),
('OR-000102', 18, 100000, 1),
('OR-000103', 47, 10000, 3),
('OR-000104', 13, 200000, 3),
('OR-000105', 14, 500000, 3),
('OR-000106', 14, 500000, 1),
('OR-000107', 14, 500000, 1),
('OR-000108', 14, 500000, 1),
('OR-000106', 14, 500000, 4),
('OR-000106', 18, 100000, 3),
('OR-000107', 16, 250000, 1),
('OR-000108', 14, 500000, 1),
('OR-000106', 14, 500000, 1),
('OR-000107', 13, 200000, 8),
('OR-000108', 14, 500000, 1),
('OR-000109', 14, 500000, 10);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `orderid` varchar(20) NOT NULL,
  `orderdate` date NOT NULL,
  `customerid` int(11) NOT NULL,
  `totalamount` int(11) NOT NULL,
  `totalquantity` int(11) NOT NULL,
  `orderstatus` varchar(30) NOT NULL,
  `cardtype` varchar(30) NOT NULL,
  `Delivery` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`orderid`, `orderdate`, `customerid`, `totalamount`, `totalquantity`, `orderstatus`, `cardtype`, `Delivery`) VALUES
('', '1970-01-01', 34, 500000, 1, 'Pending', 'ok', ''),
('OR-000001', '2022-01-22', 32, 170000, 1, 'confirm', 'Visa', ''),
('OR-000002', '2022-02-22', 32, 500000, 5, 'confirm', 'COD', ''),
('OR-000003', '2022-02-22', 32, 100000, 1, 'confirm', 'Visa', ''),
('OR-000004', '2022-01-26', 32, 5000000, 10, 'Conform', 'Visa', ''),
('OR-000005', '2022-02-26', 32, 500000, 2, 'Conform', 'COD', ''),
('OR-000006', '2022-03-09', 32, 580999, 5, 'Pending', 'Master', ''),
('OR-000007', '2022-03-22', 32, 2500000, 50, 'Pending', 'Visa', ''),
('OR-000008', '2022-03-31', 32, 97902, 98, 'Pending', 'Master', ''),
('OR-000009', '2022-02-11', 34, 700000, 6, 'Pending', 'Visa', ''),
('OR-000010', '2021-02-12', 34, 850000, 9, 'Pending', 'COD', ''),
('OR-000011', '2022-04-12', 34, 850000, 9, 'Pending', 'COD', ''),
('OR-000012', '2022-05-12', 34, 850000, 9, 'Pending', 'COD', ''),
('OR-000013', '2022-06-12', 34, 851000, 11, 'Pending', 'Visa', ''),
('OR-000014', '2022-02-12', 34, 851000, 11, 'Pending', 'Visa', ''),
('OR-000015', '2022-02-12', 34, 1351000, 13, 'Pending', 'Visa', ''),
('OR-000016', '2022-04-12', 34, 1352000, 15, 'Pending', 'Visa', ''),
('OR-000017', '2022-04-12', 34, 1352000, 15, 'Pending', 'Visa', ''),
('OR-000018', '2022-06-12', 34, 20000, 2, 'Pending', 'Master', ''),
('OR-000019', '2022-02-12', 34, 330000, 5, 'Pending', 'Visa', ''),
('OR-000020', '2022-06-12', 34, 500000, 6, 'Pending', 'Visa', ''),
('OR-000021', '2022-05-12', 34, 1500000, 8, 'Pending', 'Visa', ''),
('OR-000022', '2022-04-12', 34, 1500000, 8, 'Pending', 'Visa', ''),
('OR-000023', '2021-04-12', 34, 1500000, 8, 'Pending', 'Visa', ''),
('OR-000024', '2021-05-12', 34, 200000, 1, 'Pending', 'Visa', ''),
('OR-000025', '2021-06-12', 34, 500000, 1, 'Pending', 'Visa', ''),
('OR-000026', '2021-06-12', 34, 500000, 1, 'Pending', 'Visa', ''),
('OR-000027', '2022-05-12', 34, 500999, 2, 'Pending', 'Visa', ''),
('OR-000028', '2022-05-12', 34, 50000, 1, 'Pending', 'Visa', ''),
('OR-000029', '2022-06-12', 34, 1800000, 6, 'Pending', 'Visa', ''),
('OR-000030', '2022-06-12', 34, 1800000, 6, 'Pending', 'Visa', ''),
('OR-000031', '2021-07-12', 34, 50000, 1, 'Pending', 'Visa', ''),
('OR-000032', '2021-08-12', 34, 50000, 1, 'Pending', 'Visa', ''),
('OR-000033', '2022-05-12', 34, 1800000, 6, 'Pending', 'Visa', ''),
('OR-000034', '2021-09-12', 34, 1800000, 6, 'Pending', 'Visa', ''),
('OR-000035', '2021-10-12', 34, 1800000, 6, 'Pending', 'Visa', ''),
('OR-000036', '2021-11-12', 34, 50000, 1, 'Pending', 'Visa', ''),
('OR-000037', '2022-04-18', 34, 250000, 1, 'Pending', 'Visa', ''),
('OR-000038', '2022-04-18', 34, 250000, 1, 'Pending', 'Visa', ''),
('OR-000039', '2022-04-18', 34, 200000, 1, 'Pending', 'Visa', ''),
('OR-000040', '2022-04-18', 34, 200000, 1, 'Pending', 'Visa', ''),
('OR-000041', '2022-04-19', 34, 10000, 1, 'Pending', 'Visa', ''),
('OR-000042', '2022-04-19', 34, 200000, 1, 'Pending', 'COD', ''),
('OR-000043', '2022-04-19', 34, 200000, 1, 'Pending', 'Visa', ''),
('OR-000044', '2022-03-19', 34, 200000, 1, 'Pending', 'Visa', ''),
('OR-000045', '2022-04-19', 34, 200000, 1, 'Pending', 'Visa', ''),
('OR-000046', '2022-04-19', 34, 600000, 3, 'Pending', 'Visa', ''),
('OR-000047', '2022-04-19', 34, 500000, 1, 'Pending', 'Visa', ''),
('OR-000048', '2022-04-19', 34, 500000, 1, 'Pending', 'Visa', ''),
('OR-000049', '2022-04-19', 34, 10000, 1, 'Pending', 'Visa', ''),
('OR-000050', '2022-03-19', 34, 1010000, 3, 'Pending', 'Visa', ''),
('OR-000051', '2022-05-24', 34, 500000, 1, 'Pending', 'Visa', ''),
('OR-000052', '2022-06-08', 34, 130000, 1, 'Pending', 'Visa', ''),
('OR-000053', '2022-06-08', 34, 130000, 1, 'Pending', 'Visa', ''),
('OR-000054', '2022-05-08', 34, 130000, 1, 'Pending', 'Visa', ''),
('OR-000055', '2022-06-08', 34, 130000, 1, 'Pending', 'Visa', ''),
('OR-000056', '2022-06-08', 34, 130000, 1, 'Pending', 'Visa', ''),
('OR-000057', '2022-05-08', 34, 130000, 1, 'Pending', 'Visa', ''),
('OR-000058', '2022-06-09', 34, 300000, 1, 'Pending', 'Visa', ''),
('OR-000059', '2022-06-12', 34, 200000, 2, 'Pending', 'Visa', ''),
('OR-000060', '2022-06-12', 34, 200000, 2, 'Pending', 'Visa', ''),
('OR-000061', '2022-06-12', 34, 370000, 3, 'Pending', 'Visa', ''),
('OR-000062', '2022-06-12', 34, 370000, 3, 'Pending', 'Visa', ''),
('OR-000063', '2022-06-12', 34, 370000, 3, 'Pending', 'Visa', ''),
('OR-000064', '2022-06-12', 34, 100000, 1, 'Pending', 'Visa', ''),
('OR-000065', '2022-06-12', 34, 350000, 2, 'Pending', 'Visa', ''),
('OR-000066', '2022-06-12', 34, 350000, 2, 'Pending', 'Visa', ''),
('OR-000067', '2022-06-12', 34, 500000, 1, 'Pending', 'Visa', ''),
('OR-000068', '2022-06-12', 34, 500000, 1, 'Pending', 'Visa', ''),
('OR-000069', '2022-06-12', 34, 700000, 3, 'Pending', 'Visa', ''),
('OR-000070', '2022-06-13', 34, 500000, 1, 'Pending', 'Visa', ''),
('OR-000071', '2022-06-13', 34, 700000, 2, 'Pending', 'Visa', ''),
('OR-000072', '2022-06-13', 34, 300000, 1, 'Pending', 'Visa', ''),
('OR-000073', '2022-06-13', 34, 770000, 7, 'Pending', 'Visa', ''),
('OR-000074', '2022-06-13', 34, 530000, 3, 'Pending', 'Visa', ''),
('OR-000075', '2022-06-15', 34, 3100000, 17, 'Pending', 'Visa', ''),
('OR-000076', '2022-06-15', 34, 300000, 1, 'Pending', 'Visa', ''),
('OR-000077', '2022-06-15', 34, 300000, 1, 'Pending', 'Visa', ''),
('OR-000078', '2022-06-15', 34, 500000, 1, 'Pending', 'Visa', ''),
('OR-000079', '2022-06-15', 34, 250000, 1, 'Pending', 'Visa', ''),
('OR-000080', '2022-06-15', 34, 300000, 1, 'Pending', 'Visa', ''),
('OR-000081', '2022-06-15', 34, 130000, 1, 'Pending', 'Visa', ''),
('OR-000082', '2022-06-15', 34, 50000, 1, 'Pending', 'Visa', ''),
('OR-000083', '2022-06-15', 34, 50000, 1, 'Pending', 'Visa', ''),
('OR-000084', '2022-06-15', 34, 500000, 1, 'Pending', 'Visa', ''),
('OR-000085', '2022-06-15', 34, 500000, 1, 'Pending', 'Visa', ''),
('OR-000086', '2022-06-15', 34, 500000, 1, 'Pending', 'Visa', ''),
('OR-000087', '2022-06-15', 34, 500000, 1, 'Pending', 'Visa', ''),
('OR-000088', '2022-06-15', 34, 500000, 1, 'Pending', 'Visa', ''),
('OR-000089', '2022-06-15', 34, 500000, 1, 'Pending', 'Visa', ''),
('OR-000090', '2022-06-15', 34, 500000, 1, 'Pending', 'Visa', ''),
('OR-000091', '2022-06-15', 34, 300000, 1, 'Pending', 'Visa', ''),
('OR-000092', '2022-06-15', 34, 500000, 1, 'Pending', 'Visa', ''),
('OR-000093', '2022-06-15', 34, 500000, 1, 'Pending', 'Visa', ''),
('OR-000094', '2022-06-15', 34, 500000, 1, 'Pending', 'Visa', ''),
('OR-000095', '2022-06-15', 34, 600000, 2, 'Pending', 'ok', ''),
('OR-000096', '2022-06-15', 34, 500000, 1, 'Pending', 'ok', ''),
('OR-000097', '2022-06-15', 34, 500000, 1, 'Pending', 'ok', ''),
('OR-000098', '2022-06-15', 34, 1050000, 3, 'Pending', 'Visa', ''),
('OR-000099', '2022-06-15', 34, 500000, 1, 'Pending', 'Visa', ''),
('OR-000100', '2022-06-15', 34, 300000, 1, 'Pending', '', ''),
('OR-000101', '2022-06-15', 34, 300000, 3, 'Pending', '', ''),
('OR-000102', '2022-06-15', 34, 100000, 1, 'Pending', '', ''),
('OR-000103', '2022-06-15', 34, 30000, 3, 'Pending', '', ''),
('OR-000104', '2022-06-16', 34, 600000, 3, 'Pending', '', ''),
('OR-000105', '2022-06-29', 34, 1500000, 3, 'Pending', 'AYA', ''),
('OR-000106', '2022-06-29', 34, 500000, 1, 'Conform', 'AYA Bank', 'YES'),
('OR-000107', '2022-06-29', 34, 1600000, 8, 'Pending', 'PayPal', 'YES'),
('OR-000108', '2022-06-29', 34, 500000, 1, 'Pending', 'Cheque Payment', 'YES'),
('OR-000109', '2022-06-29', 34, 5000000, 10, 'Conform', 'Cheque Payment', 'YES');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `productid` int(11) NOT NULL,
  `productname` varchar(50) NOT NULL,
  `categoryid` int(11) NOT NULL,
  `unitprice` int(11) NOT NULL,
  `unitquantity` int(11) NOT NULL,
  `productdescription` varchar(100) NOT NULL,
  `productprofile` text NOT NULL,
  `3D` text NOT NULL,
  `AR` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`productid`, `productname`, `categoryid`, `unitprice`, `unitquantity`, `productdescription`, `productprofile`, `3D`, `AR`) VALUES
(12, 'Sofa Chair', 7, 170000, 50, 'Sofa Chair', 'images/_chair sofa.png', '', ''),
(13, 'Gaming Chair', 7, 200000, 39, 'Gaming Chair', 'images/_chair.png', '', ''),
(14, 'Sofa Lux', 8, 500000, 962, 'Sofa Luxury Chair', 'images/_Luxury-Designer-Contemporary-Leather-Italian-Sofa-1.jpg', '', ''),
(15, 'Gaming Chair RGB', 7, 300000, 16, 'RGB Gaming Chair', 'images/_Gaming Chair RGB.jpg', '', ''),
(16, 'Death Pool Gaming Chair', 7, 250000, 3, 'Edition Gaming Chair', 'images/_gaming chair.jpg', '', ''),
(17, 'Wooden Chair Modern', 7, 50000, 7, 'Wooden Chair', 'images/_wooden chair modern.jpg', '', ''),
(18, 'Modern Wooden Chair Oak', 7, 100000, 37, 'Oak Chair Modern', 'images/_modern wooden chair.jpg', '', ''),
(19, 'Wooden Stylish Chair', 7, 120000, 0, 'Wooden Stylish', 'images/_stylish wooden chair.webp', '', ''),
(20, 'Wooden Awsome Chair', 7, 130000, 8, 'Wooden Awsome', 'images/_awsome wooden chair.jpg', '', ''),
(49, 'Test Chair 3D', 7, 10000, 0, 'Test', 'images/_cc.jpg', '3D/_01.glb', 'AR/_01.usdz');

-- --------------------------------------------------------

--
-- Table structure for table `production`
--

CREATE TABLE `production` (
  `productionid` varchar(100) NOT NULL,
  `productiondate` date NOT NULL,
  `staffid` int(11) NOT NULL,
  `totalquantity` int(11) NOT NULL,
  `productionstatus` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `production`
--

INSERT INTO `production` (`productionid`, `productiondate`, `staffid`, `totalquantity`, `productionstatus`) VALUES
('PRO-000001', '2022-05-14', 46, 1, 'Pending'),
('PRO-000002', '2022-05-14', 46, 1, 'Pending'),
('PRO-000003', '2022-05-14', 45, 2, 'Pending'),
('PRO-000004', '2022-05-14', 46, 2, 'Pending'),
('PRO-000005', '2022-05-14', 46, 3, 'Pending'),
('PRO-000006', '2022-05-24', 45, 10, 'Pending'),
('PRO-000007', '2022-06-12', 46, 3, 'Pending'),
('PRO-000008', '2022-06-12', 46, 10, 'Pending'),
('PRO-000009', '2022-06-12', 46, 10, 'Pending'),
('PRO-000010', '2022-06-12', 46, 10, 'Pending'),
('PRO-000011', '2022-06-13', 46, 1, 'Pending'),
('PRO-000012', '2022-06-13', 46, 20, 'Pending'),
('PRO-000013', '2022-06-13', 47, 20, 'Pending'),
('PRO-000014', '2022-06-13', 47, 20, 'Pending'),
('PRO-000015', '2022-06-13', 50, 20, 'Pending'),
('PRO-000016', '2022-06-13', 46, 20, 'Pending'),
('PRO-000017', '2022-06-13', 47, 20, 'Pending'),
('PRO-000018', '2022-06-13', 46, 1, 'Pending'),
('PRO-000019', '2022-06-13', 46, 1, 'Pending'),
('PRO-000020', '2022-06-13', 46, 1, 'Pending'),
('PRO-000021', '2022-06-13', 46, 1, 'Pending'),
('PRO-000022', '2022-06-13', 46, 1, 'Pending'),
('PRO-000023', '2022-06-13', 45, 1, 'Pending'),
('PRO-000024', '2022-06-13', 47, 1, 'Pending'),
('PRO-000025', '2022-06-13', 50, 1, 'Pending'),
('PRO-000026', '2022-06-13', 47, 1, 'Pending'),
('PRO-000027', '2022-06-13', 50, 1, 'Pending'),
('PRO-000028', '2022-06-15', 46, 10, 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `productiondetail`
--

CREATE TABLE `productiondetail` (
  `productionid` varchar(100) NOT NULL,
  `categoryid` int(11) NOT NULL,
  `productid` int(11) NOT NULL,
  `totalquantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `productiondetail`
--

INSERT INTO `productiondetail` (`productionid`, `categoryid`, `productid`, `totalquantity`) VALUES
('PRO-000001', 8, 14, 1),
('PRO-000002', 8, 14, 1),
('PRO-000003', 8, 14, 2),
('PRO-000004', 8, 14, 2),
('PRO-000005', 8, 14, 2),
('PRO-000005', 7, 15, 1),
('PRO-000006', 7, 13, 6),
('PRO-000006', 7, 15, 4),
('PRO-000007', 8, 14, 2),
('PRO-000007', 7, 13, 1),
('PRO-000008', 7, 19, 10),
('PRO-000009', 7, 19, 10),
('PRO-000010', 7, 19, 10),
('PRO-000011', 8, 14, 1),
('PRO-000012', 8, 14, 20),
('PRO-000013', 8, 14, 20),
('PRO-000014', 8, 14, 20),
('PRO-000015', 8, 14, 20),
('PRO-000016', 8, 14, 20),
('PRO-000017', 8, 14, 20),
('PRO-000018', 8, 14, 1),
('PRO-000019', 8, 14, 1),
('PRO-000020', 8, 14, 1),
('PRO-000021', 8, 14, 1),
('PRO-000022', 8, 14, 1),
('PRO-000023', 8, 14, 1),
('PRO-000024', 8, 14, 1),
('PRO-000025', 8, 14, 1),
('PRO-000026', 8, 14, 1),
('PRO-000027', 8, 14, 1),
('PRO-000028', 7, 47, 10);

-- --------------------------------------------------------

--
-- Table structure for table `purchase`
--

CREATE TABLE `purchase` (
  `purchaseid` varchar(20) NOT NULL,
  `purchasedate` date NOT NULL,
  `supplierid` int(11) NOT NULL,
  `staffid` int(11) NOT NULL,
  `totalamount` int(11) NOT NULL,
  `totalquantity` int(11) NOT NULL,
  `purchasestatus` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `purchase`
--

INSERT INTO `purchase` (`purchaseid`, `purchasedate`, `supplierid`, `staffid`, `totalamount`, `totalquantity`, `purchasestatus`) VALUES
('PUR-000001', '2022-05-13', 8, 45, 100000, 1000, 'Pending'),
('PUR-000002', '2022-05-13', 4, 50, 1100000, 11000, 'Pending'),
('PUR-000003', '2022-05-15', 4, 50, 12100, 110, 'Pending'),
('PUR-000004', '2022-05-18', 8, 45, 12000000, 800, 'Pending'),
('PUR-000005', '2022-06-02', 8, 46, 200, 20, 'Pending'),
('PUR-000006', '2022-06-02', 8, 45, 200, 20, 'Pending'),
('PUR-000007', '2022-06-02', 9, 50, 200, 20, 'Pending'),
('PUR-000008', '2022-06-02', 8, 45, 20, 2, 'Pending'),
('PUR-000009', '2022-06-13', 4, 47, 1000, 10, 'confirm'),
('PUR-000010', '2022-06-13', 4, 46, 100, 10, 'Pending'),
('PUR-000011', '2022-06-13', 4, 46, 100, 10, 'Pending'),
('PUR-000012', '2022-06-14', 4, 46, 100, 10, 'Pending'),
('PUR-000013', '2022-06-14', 4, 45, 1, 1, 'Pending'),
('PUR-000014', '2022-06-14', 8, 45, 100, 10, 'Pending'),
('PUR-000015', '2022-06-14', 9, 46, 100, 10, 'Pending'),
('PUR-000016', '2022-06-14', 4, 46, 100, 10, 'Pending'),
('PUR-000017', '2022-06-14', 8, 46, 100, 10, 'Pending'),
('PUR-000018', '2022-06-14', 8, 47, 100, 10, 'Pending'),
('PUR-000019', '2022-06-14', 8, 45, 100, 10, 'Pending'),
('PUR-000020', '2022-06-14', 4, 46, 100, 10, 'Pending'),
('PUR-000021', '2022-06-14', 8, 47, 100, 10, 'Pending'),
('PUR-000022', '2022-06-14', 8, 46, 100, 10, 'Pending'),
('PUR-000023', '2022-06-14', 4, 46, 1, 1, 'Pending'),
('PUR-000024', '2022-06-14', 4, 50, 100, 10, 'Pending'),
('PUR-000025', '2022-06-14', 4, 46, 100, 10, 'Pending'),
('PUR-000026', '2022-06-14', 4, 46, 100, 10, 'Pending'),
('PUR-000027', '2022-06-14', 8, 45, 100, 10, 'Pending'),
('PUR-000028', '2022-06-14', 9, 47, 100, 10, 'Pending'),
('PUR-000029', '2022-06-14', 4, 45, 100, 10, 'Pending'),
('PUR-000030', '2022-06-14', 4, 46, 100, 10, 'Pending'),
('PUR-000031', '2022-06-14', 9, 50, 10000, 100, 'Pending'),
('PUR-000032', '2022-06-15', 8, 46, 10000, 10, 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `purchasedetail`
--

CREATE TABLE `purchasedetail` (
  `purchaseid` varchar(30) NOT NULL,
  `rawid` int(11) NOT NULL,
  `rawtype` varchar(30) NOT NULL,
  `unitprice` int(11) NOT NULL,
  `unitquantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `purchasedetail`
--

INSERT INTO `purchasedetail` (`purchaseid`, `rawid`, `rawtype`, `unitprice`, `unitquantity`) VALUES
('PUR-000001', 17, 'Teak', 100, 1000),
('PUR-000002', 17, 'Teak', 100, 1000),
('PUR-000002', 18, 'Padauk', 100, 10000),
('PUR-000003', 18, 'Padauk', 110, 110),
('PUR-000004', 25, 'Sofa', 15000, 800),
('PUR-000005', 17, 'Teak', 10, 10),
('PUR-000005', 18, 'Padauk', 10, 10),
('PUR-000006', 17, 'Teak', 10, 10),
('PUR-000006', 18, 'Padauk', 10, 10),
('PUR-000007', 17, 'Teak', 10, 10),
('PUR-000007', 18, 'Padauk', 10, 10),
('PUR-000008', 17, 'Teak', 10, 1),
('PUR-000008', 18, 'Padauk', 10, 1),
('PUR-000009', 17, 'Teak', 100, 10),
('PUR-000010', 18, 'Padauk', 10, 10),
('PUR-000011', 18, 'Padauk', 10, 10),
('PUR-000012', 17, 'Teak', 10, 10),
('PUR-000013', 17, 'Teak', 1, 1),
('PUR-000014', 17, 'Teak', 10, 10),
('PUR-000015', 17, 'Teak', 10, 10),
('PUR-000016', 17, 'Teak', 10, 10),
('PUR-000017', 17, 'Teak', 10, 10),
('PUR-000018', 17, 'Teak', 10, 10),
('PUR-000019', 17, 'Teak', 10, 10),
('PUR-000020', 17, 'Teak', 10, 10),
('PUR-000021', 17, 'Teak', 10, 10),
('PUR-000022', 17, 'Teak', 10, 10),
('PUR-000023', 17, 'Teak', 1, 1),
('PUR-000024', 17, 'Teak', 10, 10),
('PUR-000025', 17, 'Teak', 10, 10),
('PUR-000026', 17, 'Teak', 10, 10),
('PUR-000027', 17, 'Teak', 10, 10),
('PUR-000028', 17, 'Teak', 10, 10),
('PUR-000029', 17, 'Teak', 10, 10),
('PUR-000030', 17, 'Teak', 10, 10),
('PUR-000031', 17, 'Teak', 100, 100),
('PUR-000032', 17, 'Teak', 1000, 10);

-- --------------------------------------------------------

--
-- Table structure for table `raw`
--

CREATE TABLE `raw` (
  `rawid` int(11) NOT NULL,
  `rawtype` varchar(30) NOT NULL,
  `rawdes` varchar(100) NOT NULL,
  `rawtp` int(11) NOT NULL,
  `rawqtyleft` int(11) NOT NULL,
  `rawprofile` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `raw`
--

INSERT INTO `raw` (`rawid`, `rawtype`, `rawdes`, `rawtp`, `rawqtyleft`, `rawprofile`) VALUES
(17, 'Teak', 'Wood', 112692, 90, 'images/__3.jpg'),
(18, 'Padauk', 'Wood', 10317, -40, 'images/__5410165.jpg'),
(19, 'testtest', 'testtest', 1000, 0, 'images/__5410165.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `staffid` int(11) NOT NULL,
  `staffname` varchar(30) NOT NULL,
  `staffemail` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL,
  `phonenumber` varchar(50) NOT NULL,
  `address` varchar(100) NOT NULL,
  `staffrole` varchar(100) NOT NULL,
  `staffskill` varchar(500) NOT NULL,
  `staffprofile` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`staffid`, `staffname`, `staffemail`, `password`, `phonenumber`, `address`, `staffrole`, `staffskill`, `staffprofile`) VALUES
(45, 'Andrew staff', 'andrew@gmail.com', 'andrew', 'oop', 'Yangon, Tarmwe, Myanmar.', 'Sales Manager', 'Sales, Management , Casher', 'images/_2.jpg'),
(46, 'Tom edit', 'tom@gmail.com', 'tom', '009', '																																																																		 Yangon 																										', 'Staff Manager', 'HTML, Java, C++', 'images/_243331689_244200037722679_4809425692561492596_n.jpg'),
(50, 'Deli man', 'deliman@gmail.com', 'deliman', '09457825664', 'YGN, Pyay Road.', 'Delivery', 'Driving, Delivery Process', 'images/_3.jpg'),
(53, 'Dummy Staff', 'dummystaff@gmail.com', 'dummystaff123', '09876543223', 'MDY, 23x34 road', 'Staff', 'Sales, Casher', 'images/_274221186_4214469081989220_4115262161069774631_n.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `supplierid` int(11) NOT NULL,
  `suppliername` varchar(30) NOT NULL,
  `supplieraddress` varchar(50) NOT NULL,
  `supplierphone` varchar(30) NOT NULL,
  `supplieremail` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`supplierid`, `suppliername`, `supplieraddress`, `supplierphone`, `supplieremail`) VALUES
(4, 'Nature Wood', 'Yangon Port', '09456321558', 'sale@naturewood.com.sg'),
(8, 'Asia Wood Col,Ltd', 'Hlaing Tharyar , Industrial Zone (4), Yangon.', '09854782114', 'asiawood.ygn@gmail.com'),
(9, 'New Test Supplier', 'Yangon', '099898989', 'test@gmail.com'),
(10, 'aaaaaaaaaaaa', 'aaaaaaaaaaa', '999999999', 'sdf@gmail.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`categoryid`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customerid`);

--
-- Indexes for table `delivery`
--
ALTER TABLE `delivery`
  ADD PRIMARY KEY (`deliveryID`);

--
-- Indexes for table `item`
--
ALTER TABLE `item`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`messageid`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`orderid`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`productid`);

--
-- Indexes for table `production`
--
ALTER TABLE `production`
  ADD PRIMARY KEY (`productionid`);

--
-- Indexes for table `purchase`
--
ALTER TABLE `purchase`
  ADD PRIMARY KEY (`purchaseid`);

--
-- Indexes for table `raw`
--
ALTER TABLE `raw`
  ADD PRIMARY KEY (`rawid`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`staffid`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`supplierid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `categoryid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `customerid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `delivery`
--
ALTER TABLE `delivery`
  MODIFY `deliveryID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `item`
--
ALTER TABLE `item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=98;

--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `messageid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `productid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `raw`
--
ALTER TABLE `raw`
  MODIFY `rawid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `staffid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `supplierid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
