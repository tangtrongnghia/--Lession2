-- phpMyAdmin SQL Dump
-- version 4.9.10
-- https://www.phpmyadmin.net/
--
-- Máy chủ: localhost:3306
-- Thời gian đã tạo: Th10 12, 2022 lúc 10:58 AM
-- Phiên bản máy phục vụ: 5.7.33
-- Phiên bản PHP: 7.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `lampart`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(1, 'Nước Hoa Nam'),
(2, 'Nước Hoa Nữ'),
(3, 'Nước Hoa Unisex');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `category_id` int(11) NOT NULL,
  `thumb` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `products`
--

INSERT INTO `products` (`id`, `name`, `category_id`, `thumb`) VALUES
(1, 'Product 1', 1, 'uploads/sua-tam-nuoc-hoa-chanel-bleu-de-chanel-gel-de-douche-shower-gel-200ml-5eb6654ae8248-09052020150946.jpg'),
(2, 'Product 2', 2, 'uploads/Narciso-Rodriguez-For-Her-EDP-100ML_t6av-n0.jpg'),
(3, 'Product 3', 3, 'uploads/santal_33_b0bc726f259d47a28716355e89e11b71_master.jpg'),
(4, 'Product 4', 1, 'uploads/versace.jpg'),
(5, 'Product 5', 2, 'uploads/carolina-herrera-good-girl-eau-de-parfum-80ml_3e83d631aecf4d5fbb1fca4e34e383a2_master.jpg'),
(6, 'Product 6', 2, 'uploads/jean-paul-gaultier-scandal-50ml_f1c6f3a8165a4273a7739921e34999d7_master.jpg'),
(7, 'Product 7', 1, 'uploads/jazz.png'),
(8, 'Product 1 copy', 1, 'uploads/sua-tam-nuoc-hoa-chanel-bleu-de-chanel-gel-de-douche-shower-gel-200ml-5eb6654ae8248-09052020150946.jpg'),
(11, 'Product 6 copy', 2, 'uploads/jean-paul-gaultier-scandal-50ml_f1c6f3a8165a4273a7739921e34999d7_master.jpg'),
(12, 'Product 1 copy', 1, 'uploads/sua-tam-nuoc-hoa-chanel-bleu-de-chanel-gel-de-douche-shower-gel-200ml-5eb6654ae8248-09052020150946.jpg'),
(13, 'Product 13', 3, 'uploads/santal_33_b0bc726f259d47a28716355e89e11b71_master.jpg'),
(15, 'Product 13 copy', 3, 'uploads/santal_33_b0bc726f259d47a28716355e89e11b71_master.jpg');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `fk_products_categories` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
