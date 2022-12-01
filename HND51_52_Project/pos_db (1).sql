-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 22, 2022 at 06:23 AM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.2.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pos_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `brand`
--

CREATE TABLE `brand` (
  `brandid` int(11) NOT NULL,
  `brandname` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `brand`
--

INSERT INTO `brand` (`brandid`, `brandname`) VALUES
(1, 'Lenovo'),
(2, 'HP'),
(3, 'ThinkPad');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `categoryid` int(11) NOT NULL,
  `categoryname` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`categoryid`, `categoryname`) VALUES
(1, 'Monitor');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `customerid` int(11) NOT NULL,
  `customername` varchar(30) NOT NULL,
  `customeremail` varchar(30) NOT NULL,
  `phonenumber` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL,
  `address` varchar(50) NOT NULL,
  `customerprofile` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customerid`, `customername`, `customeremail`, `phonenumber`, `password`, `address`, `customerprofile`) VALUES
(1, 'Su Su', 'susu@gmail.com', '8687688', 'aaa', 'Yangon', 'images/_Screenshot (2).png');

-- --------------------------------------------------------

--
-- Table structure for table `orderdetail`
--

CREATE TABLE `orderdetail` (
  `orderid` varchar(20) NOT NULL,
  `productid` int(11) NOT NULL,
  `unitprice` int(11) NOT NULL,
  `unitquantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orderdetail`
--

INSERT INTO `orderdetail` (`orderid`, `productid`, `unitprice`, `unitquantity`) VALUES
('OR-000001', 1, 30000, 3),
('OR-000001', 2, 3000, 1),
('OR-000002', 1, 30000, 1);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `OrderID` varchar(20) NOT NULL,
  `OrderDate` date NOT NULL,
  `customerid` int(11) NOT NULL,
  `totalamount` int(11) NOT NULL,
  `totalquantity` int(11) NOT NULL,
  `orderstatus` varchar(30) NOT NULL,
  `cardtype` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`OrderID`, `OrderDate`, `customerid`, `totalamount`, `totalquantity`, `orderstatus`, `cardtype`) VALUES
('OR-000001', '2022-02-21', 1, 93000, 4, 'Pending', 'Visa'),
('OR-000002', '2022-02-22', 1, 30000, 1, 'Pending', 'Visa');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `productid` int(11) NOT NULL,
  `productname` varchar(30) NOT NULL,
  `brandid` int(11) NOT NULL,
  `categoryid` int(11) NOT NULL,
  `unitprice` int(11) NOT NULL,
  `unitquantity` int(11) NOT NULL,
  `productimage` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`productid`, `productname`, `brandid`, `categoryid`, `unitprice`, `unitquantity`, `productimage`) VALUES
(1, 'USB Keyboard', 1, 1, 30000, 90, 'images/__images.jpg'),
(2, 'KB', 1, 1, 3000, 67, 'images/__Drake.jpg');

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
('PUR-000001', '2021-10-14', 1, 4, 700000, 30, 'Pending'),
('PUR-000002', '2021-12-21', 1, 4, 1200000, 50, 'confirm');

-- --------------------------------------------------------

--
-- Table structure for table `purchasedetail`
--

CREATE TABLE `purchasedetail` (
  `purchaseid` varchar(30) NOT NULL,
  `productid` int(11) NOT NULL,
  `unitprice` int(11) NOT NULL,
  `unitquantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `purchasedetail`
--

INSERT INTO `purchasedetail` (`purchaseid`, `productid`, `unitprice`, `unitquantity`) VALUES
('PUR-000001', 1, 30000, 20),
('PUR-000001', 2, 10000, 10),
('PUR-000002', 2, 30000, 20),
('PUR-000002', 1, 20000, 30);

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
  `staffprofile` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`staffid`, `staffname`, `staffemail`, `password`, `phonenumber`, `address`, `staffprofile`) VALUES
(4, 'Su Su Aung', 'susu@gmail.com', 'susu', '8687688', '					Yangon				', 'images/_Screenshot (2).png'),
(5, 'Min Thurein Tun', 'susu1@gmail.com', '111', '8687688', '															          sfsfsf\r\n            												', 'images/__02-Post-Malone-press-by-Adam-Degross-2019-billboard-1548.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `supplierid` int(11) NOT NULL,
  `suppliername` varchar(30) NOT NULL,
  `address` varchar(100) NOT NULL,
  `phonenumber` varchar(30) NOT NULL,
  `emailaddress` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`supplierid`, `suppliername`, `address`, `phonenumber`, `emailaddress`) VALUES
(1, 'Kyaw Phone Thu', 'Yangon', '34224242', 'kpt@gmail.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `brand`
--
ALTER TABLE `brand`
  ADD PRIMARY KEY (`brandid`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`categoryid`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customerid`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`OrderID`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`productid`);

--
-- Indexes for table `purchase`
--
ALTER TABLE `purchase`
  ADD PRIMARY KEY (`purchaseid`);

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
-- AUTO_INCREMENT for table `brand`
--
ALTER TABLE `brand`
  MODIFY `brandid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `categoryid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `customerid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `staffid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `supplierid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
