-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 24, 2024 at 07:18 AM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `nyablak`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` int(100) NOT NULL,
  `quantity` int(100) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `number` varchar(12) NOT NULL,
  `message` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `number` varchar(12) NOT NULL,
  `email` varchar(100) NOT NULL,
  `method` varchar(50) NOT NULL,
  `address` varchar(500) NOT NULL,
  `total_products` varchar(1000) NOT NULL,
  `total_price` int(100) NOT NULL,
  `placed_on` varchar(50) NOT NULL,
  `delivery` varchar(50) NOT NULL,
  `payment_status` varchar(20) NOT NULL DEFAULT 'pending',
  `shipping_status` varchar(20) NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `name`, `number`, `email`, `method`, `address`, `total_products`, `total_price`, `placed_on`, `delivery`, `payment_status`, `shipping_status`) VALUES
(10, 3, 'skiau', '0123455789', 'skiau@gmail.com', 'cash on delivery', 'flat no. 12, 12, bogor, Indonesia - 16320', ', Americano (1) ', 19000, '19-Mar-2024', '', 'completed', 'indelivery'),
(11, 3, 'dONTOL', '089135172', 'keceonly@gmail.com', 'cash on delivery', 'flat no. 12, jl. kampus hijau, cikarang, indonesia - 16320', ', Americano (1) ', 19000, '19-Mar-2024', '', 'completed', 'Brewing'),
(12, 3, 'skiau', '0812878754', 'skiau@gmail.com', 'cash on delivery', 'flat no. 9, 12, bogor, Indonesia - 16320', ', Americano (1) ', 19000, '19-Mar-2024', '', 'pending', 'Brewing'),
(13, 3, 'Claudya PutriAn', '086435356', 'claudyaananda@gmail.com', 'cash_on_delivery', 'flat no. 9, jl. kampus hijau, cikarang, Indonesia - 12345', ', Americano (1) ', 19000, '19-Mar-2024', '', 'pending', 'Brewing'),
(14, 3, 'dONTOL', '87213612', 'klodii@gmail.com', 'gopay', 'flat no. 12, jl. kampus hijau, cikarang, Indonesia - 16320', ', Americano (1) ', 19000, '19-Mar-2024', '', 'pending', 'In Delivery'),
(24, 5, 'tayon', '12312323', 'tayon@gmail.com', 'Gopay', 'Jl. Gajah mada no.23, Bekasi, 123445', 'Moccacino (1) ', 48900, '23-Mar-2024', 'Grab', 'completed', 'Complete'),
(25, 5, 'eldwinnn', '085111312', 'tayon@gmail.com', 'Gopay', 'Jl. Sudirman no.55, Bekasi, 12355', 'Americano (1) , Matcha frappe (1) , Sweet sunset (1) , Fanta float (1) , Cookies & Cream (1) , Sandwich (1) , Cookies (1) , Muffin (1) ', 303000, '23-Mar-2024', 'Grab', 'completed', 'Complete'),
(26, 5, 'eldwin', '1235343', 'tayon@gmail.com', 'Gopay', 'Jl. Entah No.666, Bekasi, 124343', 'Sweet release (1) , Cappucino (1) ', 85200, '25-Mar-2024', 'Grab', 'completed', 'In Delivery'),
(27, 5, 'DASD', '133', 'tayon@gmail.com', 'Gopay', 'jL.AKSDASD, BEKA9S, 23123', 'Cappucino (2) ', 65400, '26-Mar-2024', 'Grab', 'pending', 'pending'),
(28, 5, 'tes', '3123', 'tayon@gmail.com', 'Gopay', 'kasdpasd, oaskd, 3138', 'Espresso (1) ', 37900, '26-Mar-2024', 'Grab', 'pending', 'pending'),
(29, 5, 'aosdj', '453', 'tayon@gmail.com', 'Gopay', 'Jl.asdkasd, 9808, 909', 'Cappucino (1) , Espresso (1) , Croissant (1) ', 100600, '26-Mar-2024', 'Grab', 'pending', 'pending'),
(30, 5, 'aosdj', '453', 'tayon@gmail.com', 'Gopay', 'Jl.asdkasd, 9808, 909', 'Cappucino (1) , Espresso (1) , Croissant (1) ', 100600, '26-Mar-2024', 'Go Send', 'pending', 'pending'),
(31, 5, 'llklhlh', '454564', 'tayon@gmail.com', 'Gopay', 'jl.hjhjh, Betkgk, 9898', 'Cappucino (1) , Espresso (1) ', 62100, '26-Mar-2024', 'Grab', 'pending', 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `type` varchar(50) NOT NULL,
  `price` int(100) NOT NULL,
  `image` varchar(100) NOT NULL,
  `event` varchar(50) DEFAULT NULL,
  `discount` int(11) DEFAULT NULL,
  `stock` int(11) DEFAULT NULL,
  `sold` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `type`, `price`, `image`, `event`, `discount`, `stock`, `sold`) VALUES
(3, 'Espresso', 'Coffee', 19000, 'espresso.png', '', 0, 100, 1),
(4, 'Cappucino', 'Coffee', 22000, 'cappucino.png', '', 0, 99, 1),
(5, 'Double trouble', 'Offer', 40000, 'offer1.png', 'Limited offer', 58000, 100, 0),
(6, 'Moccacino', 'Coffee', 29000, 'moccacino.png', NULL, NULL, 100, 0),
(7, 'Croissant', 'Pastry', 35000, 'croissant.png', NULL, NULL, 100, 0),
(8, 'Sweet release', 'Offer', 40000, 'sweet.png', 'Ramadhan edition', 58000, 100, 0),
(9, 'Cake combo', 'Offer', 45000, 'offer5.png', 'Limited offer', 60000, 100, 0),
(10, 'Morning combo', 'Offer', 40000, 'offer3.png', 'Special morning', 65000, 100, 0),
(11, 'Cookies & Cream', 'Non', 35000, 'cookies.png', NULL, NULL, 100, 0),
(12, 'Fanta float', 'Non', 25000, 'fanta.png', NULL, NULL, 100, 0),
(13, 'Perfect combo', 'Offer', 35000, 'offer4.png', 'Lunch offer', 45000, 100, 0),
(14, 'Americano', 'Coffee', 22000, 'americano.png', NULL, NULL, 100, 0),
(15, 'Matcha frappe', 'Non', 38000, 'matcha.png', NULL, NULL, 100, 0),
(16, 'Muffin', 'Pastry', 32000, 'muffin.png', NULL, NULL, 100, 0),
(17, 'Sandwich', 'Pastry', 34000, 'sandwich.png', NULL, NULL, 100, 0),
(18, 'Cookies', 'Pastry', 30000, 'cookie.png', NULL, NULL, 100, 0),
(19, 'Sweet sunset', 'Non', 44000, 'sunset.png', NULL, NULL, 100, 0);

-- --------------------------------------------------------

--
-- Table structure for table `purchase`
--

CREATE TABLE `purchase` (
  `purchase_id` int(11) NOT NULL,
  `vendor` varchar(100) NOT NULL,
  `address` varchar(500) NOT NULL,
  `email` varchar(500) NOT NULL,
  `phone` varchar(500) NOT NULL,
  `buyer` varchar(500) NOT NULL,
  `date` date NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `bill_status` varchar(100) NOT NULL DEFAULT 'Not Billed',
  `arrival` date NOT NULL,
  `terms` int(11) NOT NULL,
  `arrival_status` varchar(20) NOT NULL,
  `goods_condition` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `purchase`
--

INSERT INTO `purchase` (`purchase_id`, `vendor`, `address`, `email`, `phone`, `buyer`, `date`, `total`, `bill_status`, `arrival`, `terms`, `arrival_status`, `goods_condition`) VALUES
(2, 'asdasd', 'asdad', '123asda', '123', 'asdasd', '2024-04-01', '245.00', 'Not Billed', '2024-04-16', 12, 'Unarrived', 'Perfect'),
(3, 'PT.Indomilk', 'Jl.Karangan 2 No.45', 'indomilk@gmail.com', '021343431', 'John', '2024-04-10', '4425300.00', 'Not Billed', '2024-04-16', 15, 'Unarrived', 'Uncheck'),
(4, 'PT. CoffeeIndo', 'Jl. Kemang no.67', 'coffeeindo@gmail.com', '021313131', 'Dewi', '2024-04-13', '4279000.00', 'Not Billed', '2024-04-20', 12, 'Arrived', 'Incomplete Goods'),
(5, 'sadads', 'afsaf', 'Uki@gmail.com', '08123', 'anim', '2024-04-26', '789663.60', 'Not Billed', '2024-05-03', 2, 'Unarrived', 'Uncheck');

-- --------------------------------------------------------

--
-- Table structure for table `purchase_products`
--

CREATE TABLE `purchase_products` (
  `id` int(11) NOT NULL,
  `purchase_id` int(11) NOT NULL,
  `product_name` varchar(500) NOT NULL,
  `product_price` int(11) NOT NULL,
  `product_qty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `purchase_products`
--

INSERT INTO `purchase_products` (`id`, `purchase_id`, `product_name`, `product_price`, `product_qty`) VALUES
(3, 2, '1', 100, 1),
(4, 2, 'asd', 123, 1),
(5, 3, 'Fresh Milk', 200000, 20),
(6, 3, 'Oat Milk', 23000, 1),
(7, 4, 'Matcha powder', 220000, 4),
(8, 4, 'Hazelnut syrup', 86000, 15),
(9, 4, 'Caramel syrup', 86000, 20),
(10, 5, 'Ganja', 31212, 23);

-- --------------------------------------------------------

--
-- Table structure for table `revenue`
--

CREATE TABLE `revenue` (
  `order_id` int(11) NOT NULL,
  `order_placed` varchar(50) NOT NULL,
  `name` varchar(255) NOT NULL,
  `number` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `total_products` varchar(255) NOT NULL,
  `total_price` int(100) NOT NULL,
  `payment_method` varchar(50) NOT NULL,
  `payment_status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `revenue`
--

INSERT INTO `revenue` (`order_id`, `order_placed`, `name`, `number`, `email`, `address`, `total_products`, `total_price`, `payment_method`, `payment_status`) VALUES
(26, '25-Mar-2024', 'eldwin', '1235343', 'tayon@gmail.com', 'Jl. Entah No.666, Bekasi, 124343', 'Sweet release (1) , Cappucino (1) ', 85200, 'Gopay', 'paid');

-- --------------------------------------------------------

--
-- Table structure for table `salesperson`
--

CREATE TABLE `salesperson` (
  `employee_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `gender` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `salesperson`
--

INSERT INTO `salesperson` (`employee_id`, `name`, `email`, `gender`) VALUES
(1, 'John', 'john@gmail.com', 'Male'),
(2, 'Ryan', 'ryan@gmail.com', 'Male'),
(3, 'Rina', 'rina@gmail.com', 'Female'),
(4, 'Dewi', 'dewi@gmail.com', 'Female'),
(5, 'Ruru', 'ruru@gmail.com', 'Female');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `user_type` varchar(20) NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `user_type`) VALUES
(1, 'Claudya', 'klodi@gmail.com', 'b6f81a53b4cccd34463fc155ab9d38fc', 'user'),
(2, 'klodii', 'klodii@gmail.com', '25d55ad283aa400af464c76d713c07ad', 'admin'),
(3, 'skiau', 'skiau@gmail.com', '25d55ad283aa400af464c76d713c07ad', 'user'),
(4, 'skiaumader', 'sekiau@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 'admin'),
(5, 'tayon', 'tayon@gmail.com', '202cb962ac59075b964b07152d234b70', 'user'),
(6, 'admin1', 'admin@gmail.com', '202cb962ac59075b964b07152d234b70', 'admin'),
(7, 'eldwinn', 'eldwin@gmail.com', '202cb962ac59075b964b07152d234b70', 'user'),
(8, 'soki', 'soki@gmail.com', '202cb962ac59075b964b07152d234b70', 'user'),
(9, 'soki', 'sokii@gmail.com', '202cb962ac59075b964b07152d234b70', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchase`
--
ALTER TABLE `purchase`
  ADD PRIMARY KEY (`purchase_id`);

--
-- Indexes for table `purchase_products`
--
ALTER TABLE `purchase_products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_PURCHASE` (`purchase_id`);

--
-- Indexes for table `revenue`
--
ALTER TABLE `revenue`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `salesperson`
--
ALTER TABLE `salesperson`
  ADD PRIMARY KEY (`employee_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `purchase`
--
ALTER TABLE `purchase`
  MODIFY `purchase_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `purchase_products`
--
ALTER TABLE `purchase_products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `revenue`
--
ALTER TABLE `revenue`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `salesperson`
--
ALTER TABLE `salesperson`
  MODIFY `employee_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `purchase_products`
--
ALTER TABLE `purchase_products`
  ADD CONSTRAINT `FK_PURCHASE` FOREIGN KEY (`purchase_id`) REFERENCES `purchase` (`purchase_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
