-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 07 Bulan Mei 2024 pada 16.23
-- Versi server: 10.4.25-MariaDB
-- Versi PHP: 8.1.10

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
-- Struktur dari tabel `orders`
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
  `shipping_status` varchar(20) NOT NULL DEFAULT 'pending',
  `sales` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `name`, `number`, `email`, `method`, `address`, `total_products`, `total_price`, `placed_on`, `delivery`, `payment_status`, `shipping_status`, `sales`) VALUES
(10, 3, 'skiau', '0123455789', 'skiau@gmail.com', 'cash on delivery', 'flat no. 12, 12, bogor, Indonesia - 16320', ', Americano (1) ', 19000, '19-Mar-2024', '', 'completed', 'indelivery', NULL),
(11, 3, 'dONTOL', '089135172', 'keceonly@gmail.com', 'cash on delivery', 'flat no. 12, jl. kampus hijau, cikarang, indonesia - 16320', ', Americano (1) ', 19000, '19-Mar-2024', '', 'completed', 'Brewing', NULL),
(12, 3, 'skiau', '0812878754', 'skiau@gmail.com', 'cash on delivery', 'flat no. 9, 12, bogor, Indonesia - 16320', ', Americano (1) ', 19000, '19-Mar-2024', '', 'pending', 'Brewing', NULL),
(13, 3, 'Claudya PutriAn', '086435356', 'claudyaananda@gmail.com', 'cash_on_delivery', 'flat no. 9, jl. kampus hijau, cikarang, Indonesia - 12345', ', Americano (1) ', 19000, '19-Mar-2024', '', 'pending', 'Brewing', NULL),
(14, 3, 'dONTOL', '87213612', 'klodii@gmail.com', 'gopay', 'flat no. 12, jl. kampus hijau, cikarang, Indonesia - 16320', ', Americano (1) ', 19000, '19-Mar-2024', '', 'pending', 'In Delivery', NULL),
(24, 5, 'tayon', '12312323', 'tayon@gmail.com', 'Gopay', 'Jl. Gajah mada no.23, Bekasi, 123445', 'Moccacino (1) ', 48900, '23-Mar-2024', 'Grab', 'completed', 'Complete', NULL),
(25, 5, 'eldwinnn', '085111312', 'tayon@gmail.com', 'Gopay', 'Jl. Sudirman no.55, Bekasi, 12355', 'Americano (1) , Matcha frappe (1) , Sweet sunset (1) , Fanta float (1) , Cookies & Cream (1) , Sandwich (1) , Cookies (1) , Muffin (1) ', 303000, '23-Mar-2024', 'Grab', 'completed', 'Complete', NULL),
(26, 5, 'eldwin', '1235343', 'tayon@gmail.com', 'Gopay', 'Jl. Entah No.666, Bekasi, 124343', 'Sweet release (1) , Cappucino (1) ', 85200, '25-Mar-2024', 'Grab', 'completed', 'In Delivery', NULL),
(27, 5, 'DASD', '133', 'tayon@gmail.com', 'Gopay', 'jL.AKSDASD, BEKA9S, 23123', 'Cappucino (2) ', 65400, '26-Mar-2024', 'Grab', 'pending', 'pending', NULL),
(28, 5, 'tes', '3123', 'tayon@gmail.com', 'Gopay', 'kasdpasd, oaskd, 3138', 'Espresso (1) ', 37900, '26-Mar-2024', 'Grab', 'pending', 'pending', NULL),
(29, 5, 'aosdj', '453', 'tayon@gmail.com', 'Gopay', 'Jl.asdkasd, 9808, 909', 'Cappucino (1) , Espresso (1) , Croissant (1) ', 100600, '26-Mar-2024', 'Grab', 'pending', 'pending', NULL),
(30, 5, 'aosdj', '453', 'tayon@gmail.com', 'Gopay', 'Jl.asdkasd, 9808, 909', 'Cappucino (1) , Espresso (1) , Croissant (1) ', 100600, '26-Mar-2024', 'Go Send', 'pending', 'pending', NULL),
(31, 5, 'llklhlh', '454564', 'tayon@gmail.com', 'Gopay', 'jl.hjhjh, Betkgk, 9898', 'Cappucino (1) , Espresso (1) ', 62100, '26-Mar-2024', 'Grab', 'paid', 'pending', 'John');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
