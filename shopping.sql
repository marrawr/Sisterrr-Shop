-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 28, 2023 at 05:52 AM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shopping`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `creationDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updationDate` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `creationDate`, `updationDate`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', '2017-01-24 16:21:18', '26-06-2023 09:58:41 PM'),
(2, 'lisa', '', '2023-06-28 03:03:08', ''),
(3, 'zizi', 'zizi123', '2023-06-28 03:57:45', '');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int NOT NULL,
  `categoryName` varchar(255) DEFAULT NULL,
  `categoryDescription` longtext,
  `creationDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updationDate` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `categoryName`, `categoryDescription`, `creationDate`, `updationDate`) VALUES
(7, 'Bawal', 'Fashion', '2023-06-26 16:29:51', '26-06-2023 10:00:19 PM'),
(8, 'Accessories', 'Fashion Accessories', '2023-06-26 16:44:03', '28-06-2023 10:50:55 AM');

-- --------------------------------------------------------

--
-- Table structure for table `manager`
--

CREATE TABLE `manager` (
  `id` int NOT NULL,
  `musername` varchar(255) NOT NULL,
  `mpassword` varchar(255) NOT NULL,
  `mcreationDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `mupdationDate` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `manager`
--

INSERT INTO `manager` (`id`, `musername`, `mpassword`, `mcreationDate`, `mupdationDate`) VALUES
(1, 'manager', 'manager123', '2023-06-26 16:18:55', '');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int NOT NULL,
  `userId` int DEFAULT NULL,
  `productId` varchar(255) DEFAULT NULL,
  `quantity` int DEFAULT NULL,
  `orderDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `paymentMethod` varchar(50) DEFAULT NULL,
  `orderStatus` varchar(55) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `userId`, `productId`, `quantity`, `orderDate`, `paymentMethod`, `orderStatus`) VALUES
(7, 4, '21', 2, '2023-06-26 17:14:13', 'Internet Banking', NULL),
(8, 4, '29', 1, '2023-06-26 17:14:13', 'Internet Banking', NULL),
(9, 5, '21', 2, '2023-06-27 15:51:26', 'Internet Banking', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ordertrackhistory`
--

CREATE TABLE `ordertrackhistory` (
  `id` int NOT NULL,
  `orderId` int DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `remark` mediumtext,
  `postingDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `productreviews`
--

CREATE TABLE `productreviews` (
  `id` int NOT NULL,
  `productId` int DEFAULT NULL,
  `quality` int DEFAULT NULL,
  `price` int DEFAULT NULL,
  `value` int DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `summary` varchar(255) DEFAULT NULL,
  `review` longtext,
  `reviewDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `productreviews`
--

INSERT INTO `productreviews` (`id`, `productId`, `quality`, `price`, `value`, `name`, `summary`, `review`, `reviewDate`) VALUES
(5, 22, 3, 3, 3, 'mar', 'best quality', 'the best quality fabric ever!', '2023-06-26 17:59:05');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int NOT NULL,
  `category` int NOT NULL,
  `subCategory` int DEFAULT NULL,
  `productName` varchar(255) DEFAULT NULL,
  `productCompany` varchar(255) DEFAULT NULL,
  `productPrice` int DEFAULT NULL,
  `productPriceBeforeDiscount` int DEFAULT NULL,
  `productDescription` longtext,
  `productImage1` varchar(255) DEFAULT NULL,
  `productImage2` varchar(255) DEFAULT NULL,
  `productImage3` varchar(255) DEFAULT NULL,
  `shippingCharge` int DEFAULT NULL,
  `productAvailability` varchar(255) DEFAULT NULL,
  `postingDate` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updationDate` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `category`, `subCategory`, `productName`, `productCompany`, `productPrice`, `productPriceBeforeDiscount`, `productDescription`, `productImage1`, `productImage2`, `productImage3`, `shippingCharge`, `productAvailability`, `postingDate`, `updationDate`) VALUES
(21, 7, 13, 'Bawal Cotton Baby Blue', 'Hijab Society', 18, 20, 'Bidang 45', 'tudung bawal baby blue.jpg', 'tudung bawal baby blue.jpg', 'tudung bawal baby blue.jpg', 3, 'In Stock', '2023-06-26 16:34:48', NULL),
(22, 7, 13, 'Bawal Cotton Dusty Purple', 'Hijab Society', 15, 20, 'Bidang 45', 'tudung bawal dusty purple.jpg', 'tudung bawal dusty purple.jpg', 'tudung bawal dusty purple.jpg', 3, 'In Stock', '2023-06-26 16:35:58', NULL),
(23, 7, 13, 'Bawal Cotton Black', 'Hijab Society', 15, 20, 'Bidang 45', 'tudung bawal hitam.jpg', 'tudung bawal hitam.jpg', 'tudung bawal hitam.jpg', 3, 'In Stock', '2023-06-26 16:37:04', NULL),
(24, 7, 13, 'Bawal Cotton Olive', 'Hijab Society', 15, 20, 'Bidang 45', 'tudung bawal olive.jpg', 'tudung bawal olive.jpg', 'tudung bawal olive.jpg', 3, 'In Stock', '2023-06-26 16:37:49', NULL),
(25, 7, 13, 'Bawal Cotton Orange Brick', 'Hijab Society', 15, 20, 'Bidang 45', 'tudung bawal orange brick.jpg', 'tudung bawal orange brick.jpg', 'tudung bawal orange brick.jpg', 3, 'In Stock', '2023-06-26 16:39:05', NULL),
(26, 7, 13, 'Bawal Cotton Peanut Butter', 'Hijab Society', 15, 20, 'Bidang 45', 'tudung bawal peanut butter.jpg', 'tudung bawal peanut butter.jpg', 'tudung bawal peanut butter.jpg', 3, 'In Stock', '2023-06-26 16:39:54', NULL),
(27, 7, 13, 'Bawal Cotton Red', 'Hijab Society', 15, 20, 'Bidang 45', 'tudung bawal red.jpg', 'tudung bawal red.jpg', 'tudung bawal red.jpg', 3, 'In Stock', '2023-06-26 16:40:48', NULL),
(28, 7, 13, 'Bawal Cotton Royal Blue', 'Hijab Society', 15, 20, 'Bidang 45', 'tudung bawal royal blue.jpg', 'tudung bawal royal blue.jpg', 'tudung bawal royal blue.jpg', 3, 'In Stock', '2023-06-26 16:41:33', NULL),
(29, 8, 14, 'Red Diamond Flower Brooch', 'Hijab Society', 8, 10, 'Brooch', 'Red Diamond Flower Brooch.webp', 'Red Diamond Flower Brooch.webp', 'Red Diamond Flower Brooch.webp', 3, 'In Stock', '2023-06-26 16:50:36', NULL),
(30, 8, 14, 'White Diamond Flower Brooch', 'Hijab Society', 8, 10, 'Brooch', 'White Diamond Flower Brooch.webp', 'White Diamond Flower Brooch.webp', 'White Diamond Flower Brooch.webp', 3, 'In Stock', '2023-06-26 16:51:20', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `subcategory`
--

CREATE TABLE `subcategory` (
  `id` int NOT NULL,
  `categoryid` int DEFAULT NULL,
  `subcategory` varchar(255) DEFAULT NULL,
  `creationDate` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updationDate` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subcategory`
--

INSERT INTO `subcategory` (`id`, `categoryid`, `subcategory`, `creationDate`, `updationDate`) VALUES
(13, 7, 'Bawal Cotton', '2023-06-26 16:30:50', '26-06-2023 10:00:58 PM'),
(14, 8, 'Brooch', '2023-06-26 16:44:51', '26-06-2023 10:15:00 PM'),
(15, 7, 'Bawal Chiffon', '2023-06-26 17:17:52', '26-06-2023 10:48:48 PM');

-- --------------------------------------------------------

--
-- Table structure for table `userlog`
--

CREATE TABLE `userlog` (
  `id` int NOT NULL,
  `userEmail` varchar(255) DEFAULT NULL,
  `userip` binary(16) DEFAULT NULL,
  `loginTime` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `logout` varchar(255) DEFAULT NULL,
  `status` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `userlog`
--

INSERT INTO `userlog` (`id`, `userEmail`, `userip`, `loginTime`, `logout`, `status`) VALUES
(24, 'mar@gmail.com', 0x3a3a3100000000000000000000000000, '2023-06-26 17:10:19', NULL, 1),
(25, 'nisa@gmail.com', 0x3132372e302e302e3100000000000000, '2023-06-27 15:50:05', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `contactno` bigint DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `shippingAddress` longtext,
  `shippingState` varchar(255) DEFAULT NULL,
  `shippingCity` varchar(255) DEFAULT NULL,
  `shippingPincode` int DEFAULT NULL,
  `billingAddress` longtext,
  `billingState` varchar(255) DEFAULT NULL,
  `billingCity` varchar(255) DEFAULT NULL,
  `billingPincode` int DEFAULT NULL,
  `regDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updationDate` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `contactno`, `password`, `shippingAddress`, `shippingState`, `shippingCity`, `shippingPincode`, `billingAddress`, `billingState`, `billingCity`, `billingPincode`, `regDate`, `updationDate`) VALUES
(4, 'mar', 'mar@gmail.com', 113162383, '9880c35d8804ed40f467de976963966b', 'Saujana Putra', 'Selangor', 'Jenjarom', 42610, 'Saujana Putra', 'Selangor', 'Jenjarom', 42610, '2023-06-26 17:10:04', NULL),
(5, 'nisa', 'nisa@gmail.com', 1111111111, 'ff6d11fad3287047fcafb104c276e63a', 'Ijok', 'Selangor', 'Bestari Jaya', 45600, NULL, NULL, NULL, NULL, '2023-06-27 15:49:52', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

CREATE TABLE `wishlist` (
  `id` int NOT NULL,
  `userId` int DEFAULT NULL,
  `productId` int DEFAULT NULL,
  `postingDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `manager`
--
ALTER TABLE `manager`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ordertrackhistory`
--
ALTER TABLE `ordertrackhistory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `productreviews`
--
ALTER TABLE `productreviews`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subcategory`
--
ALTER TABLE `subcategory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `userlog`
--
ALTER TABLE `userlog`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `manager`
--
ALTER TABLE `manager`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `ordertrackhistory`
--
ALTER TABLE `ordertrackhistory`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `productreviews`
--
ALTER TABLE `productreviews`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `subcategory`
--
ALTER TABLE `subcategory`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `userlog`
--
ALTER TABLE `userlog`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
