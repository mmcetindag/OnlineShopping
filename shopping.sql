-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 24 May 2018, 00:53:33
-- Sunucu sürümü: 10.1.32-MariaDB
-- PHP Sürümü: 7.2.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `shopping`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` text NOT NULL,
  `password` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Tablo döküm verisi `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`) VALUES
(1, 'admin', 'e10adc3949ba59abbe56e057f20f883e');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `buy`
--

CREATE TABLE `buy` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` text NOT NULL,
  `email` text NOT NULL,
  `mobile` text NOT NULL,
  `city` text NOT NULL,
  `pincode` int(6) NOT NULL,
  `address` text NOT NULL,
  `booked_time` int(11) NOT NULL,
  `dispatch_time` int(11) NOT NULL,
  `status` text NOT NULL,
  `status_code` int(1) NOT NULL,
  `product_stack` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `active` varchar(1) NOT NULL,
  `buy_id` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Tablo döküm verisi `cart`
--

INSERT INTO `cart` (`id`, `product_id`, `user_id`, `active`, `buy_id`) VALUES
(1, 7, 1, 'n', '1'),
(3, 7, 2, 'n', '2'),
(7, 5, 4, 'n', '8'),
(8, 5, 4, 'n', '8'),
(9, 5, 4, 'n', '8'),
(10, 3, 4, 'n', '8'),
(15, 7, 4, 'n', '8'),
(16, 7, 4, 'n', '8'),
(17, 7, 4, 'n', '8'),
(18, 3, 4, 'n', '8'),
(20, 5, 4, 'n', '8'),
(21, 5, 4, 'n', '8'),
(22, 5, 3, 'n', '15'),
(23, 5, 3, 'n', '15'),
(24, 2, 3, 'n', '15'),
(25, 2, 3, 'n', '15'),
(27, 9, 3, 'n', '15'),
(28, 6, 5, 'n', '19'),
(31, 6, 5, 'n', '19'),
(32, 6, 5, 'n', '19'),
(33, 9, 3, 'n', '15'),
(34, 9, 3, 'n', '15'),
(35, 13, 3, 'n', '15'),
(38, 21, 3, 'n', '15');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `image` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Tablo döküm verisi `category`
--

INSERT INTO `category` (`id`, `name`, `image`) VALUES
(6, 'Laptops', 'images/36fd799c06a9d1a711ba55670f3aefed/1.jpg'),
(7, 'Desktops', 'images/e68fb1e9008c60cdeac1e5d05b033c4a/desk.jpg'),
(8, 'Tablets', 'images/dd2e5d802b9cc1d8989e005a06a69da7/tablets.jpg'),
(9, 'Mobile Phones', 'images/4fbbbe4a9309a39e6724119a2a6b45ab/mobile.jpg');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `offer`
--

CREATE TABLE `offer` (
  `id` int(11) NOT NULL,
  `image` text NOT NULL,
  `link` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Tablo döküm verisi `offer`
--

INSERT INTO `offer` (`id`, `image`, `link`) VALUES
(1, 'images/380c49c7b9529fb733a281b35b016344/slider.jpg', 'http://localhost/shopping/products.php'),
(2, 'images/92432409ee9a252770e4343be3dc5ea4/slider2.jpg', 'http://localhost/shopping/product.php?id=18'),
(3, 'images/4637ae9a01c19ee196dd3498925e4f90/slider3.jpg', 'http://localhost/shopping/category.php?id=6');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `name` text NOT NULL,
  `image` text NOT NULL,
  `description` text NOT NULL,
  `mp` int(11) NOT NULL,
  `sp` int(11) NOT NULL,
  `off` varchar(4) NOT NULL,
  `shipping` int(11) NOT NULL,
  `tags` text NOT NULL,
  `stock` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Tablo döküm verisi `product`
--

INSERT INTO `product` (`id`, `category_id`, `name`, `image`, `description`, `mp`, `sp`, `off`, `shipping`, `tags`, `stock`) VALUES
(13, 6, 'LENOVO Ideapad 320s-14IKB', 'images/27ac6c4d0df02266f12cf8a65f13a12c/lenova.jpg', 'Top features: \r\n\r\n- Intel&reg; Pentium&trade; processor helps you complete tasks with ease \r\n\r\n- Portable design for easy computing on the move \r\n\r\n- Immersive audio to bring music and videos to life', 500, 250, '50', 50, 'laptop', 49),
(14, 6, 'ACER Nitro 5 15', 'images/55e0673317b0ab54996d61ecea834471/acer-nitro.jpg', 'Top features: \r\n\r\n- 7th generation processor delivers speed and power \r\n\r\n- Range of ports grant freedom for gaming peripherals \r\n\r\n- NVIDIA GeForce GTX graphics card creates smooth gameplay \r\n\r\n- Dolby Audio Premium adjusts sound for complete immersion \r\n\r\nThe Acer Nitro 5 15.6&amp;amp;amp;quot; Gaming Laptop is part of our Gaming range, which features the most powerful PCs available today. It has superior graphics and processing performance to suit the most demanding gamer.', 600, 400, '20', 0, 'laptops', 50),
(15, 6, 'HP Pavilion x360', 'images/d3faa88a0a5d6f43ef9e78215e1860e3/hp.jpg', 'Everyday: All-rounder for work and play\r\nWindows 10\r\nIntel&reg; Pentium&reg; Gold 4415U Processor\r\nRAM: 4 GB / Storage: 128 GB SSD\r\nBattery life: Up to 10.5 hours', 480, 400, '20', 50, 'laptop', 100),
(16, 6, 'DELL Inspiron 5000', 'images/4ce7f644fce06f311960f062eaa6037b/dell.jpg', 'Gaming: Play the latest titles\r\nIntel&reg; Core&trade; i7-7700HQ processor\r\nRAM: 8 GB / Storage: 1 TB HDD &amp;amp; 128 GB SSD\r\nGraphics: NVIDIA GeForce GTX 1050M 4 GB\r\nFull HD display', 800, 720, '10', 25, 'laptops', 1),
(17, 7, 'LENOVO Legion Y520 Gaming PC', 'images/34ba0488591bc54704d5ffe56def3f48/lenovopc.jpg', 'Gaming: Play the latest titles\r\nWindows 10\r\nIntel&reg; Core&trade; i3-7100 Processor\r\nRAM: 8 GB / Storage: 1 TB HDD\r\nGraphics: NVIDIA GeForce GTX 1050 Ti', 500, 250, '50', 50, 'desktops', 25),
(18, 7, 'APPLE iMac', 'images/2d4797c41df8cfde162da2f820036c18/apple-imac.jpg', 'macOS\r\nIntel&reg; Core&trade; i5 processor\r\nRAM: 8 GB / Storage: 1 TB HDD\r\nGraphics: Intel&reg; Iris&trade;\r\nWith built-in WiFi', 1000, 800, '20', 50, 'apple', 15),
(19, 7, 'MSI Infinite Gaming PC', 'images/7dec5422c8c1dc16b33fe7f3aa8839b2/msi.jpg', 'MSI Infinite Gaming PC', 600, 500, '12', 55, 'msi', 50),
(20, 9, 'SAMSUNG Galaxy S9', 'images/325a31066bbc1081d58b7c1fdfe2d2c3/s9.jpg', 'Android 8.0 (Oreo)\r\n5.8&amp;amp;quot; Quad HD Super AMOLED touchscreen\r\n12 MP camera\r\nExynos 9810 processor\r\nBattery capacity: 3000 mAh', 750, 700, '5', 55, 's9', 2),
(21, 9, 'HONOR 9 Lite', 'images/07590782c75ca249b92c49cc9e8e6564/honot.jpg', 'Android 8.0 (Oreo)\r\n13 MP camera &amp;amp;amp; Full HD recording\r\n2.3 GHz octa-core processor\r\nBattery capacity: 3000 mAh', 160, 160, '50', 50, 'honor', 2),
(22, 8, 'APPLE 9.7 iPad', 'images/8fb3f20c26f41c366f1c397937e8cc7c/ipad.jpg', 'iOS 11\r\nRetina display\r\nStore up to 6 hours of HD video / up to 7500 photos\r\nBattery life: Up to 10 hours\r\nCompatible with Apple Pencil', 300, 270, '10', 50, 'tablets', 210),
(23, 8, 'HUAWEI MediaPad T3', 'images/69cd604517246dc346e056b6a94963ee/huewei.jpg', 'Android 7.0 (Nougat)\r\nHD Ready display\r\nStore up to 3 hours of HD video / up to 3700 photos\r\nBattery life: Up to 16 hours\r\nmicroSD card reader', 120, 108, '10', 55, 'tablets', 50);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `fullname` text NOT NULL,
  `email` text NOT NULL,
  `phone` text NOT NULL,
  `password` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Tablo döküm verisi `user`
--

INSERT INTO `user` (`id`, `fullname`, `email`, `phone`, `password`) VALUES
(3, 'Mustafa &Ccedil;etindaÄŸ', 'mmcetindag@gmail.com', '05531437323', '6fff22926275b72888d47f1124bc7045'),
(4, 'Mustafa', 'm@gmail.com', '05531437323', '3fde6bb0541387e4ebdadf7c2ff31123'),
(5, 'Atacan KULLABCI', 'atacankullabci@gmail.com', '05383071809', '827ccb0eea8a706c4c34a16891f84e7b');

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `buy`
--
ALTER TABLE `buy`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `offer`
--
ALTER TABLE `offer`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Tablo için AUTO_INCREMENT değeri `buy`
--
ALTER TABLE `buy`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Tablo için AUTO_INCREMENT değeri `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- Tablo için AUTO_INCREMENT değeri `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Tablo için AUTO_INCREMENT değeri `offer`
--
ALTER TABLE `offer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Tablo için AUTO_INCREMENT değeri `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- Tablo için AUTO_INCREMENT değeri `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
