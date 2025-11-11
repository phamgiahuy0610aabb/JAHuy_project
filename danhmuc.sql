-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th10 04, 2025 lúc 03:07 AM
-- Phiên bản máy phục vụ: 10.4.32-MariaDB
-- Phiên bản PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `qlnhathuoc`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `danhmuc`
--

CREATE TABLE `danhmuc` (
  `MaDM` int(11) NOT NULL,
  `TenDM` varchar(100) NOT NULL,
  `MoTa` text DEFAULT NULL,
  `TrangThai` tinyint(4) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `danhmuc`
--

INSERT INTO `danhmuc` (`MaDM`, `TenDM`, `MoTa`, `TrangThai`) VALUES
(1, 'Hot Sale', 'Sản phẩm đang giảm giá', 1),
(2, 'Dược phẩm & Thiết bị y tế', 'Danh mục bao gồm thuốc và thiết bị y tế gia đình', 1),
(3, 'Mỹ phẩm Gia Hy ', 'đẻ dùng ', 1),
(4, 'Thiết bị, dụng cụ y tế', 'Máy đo, thiết bị y tế gia đình', 1),
(5, 'Dược mỹ phẩm', 'Sản phẩm làm đẹp có dược tính', 1),
(6, 'Chăm sóc cá nhân', 'Sản phẩm vệ sinh, chăm sóc cơ thể', 1),
(7, 'Chăm sóc trẻ em', 'Sản phẩm dành cho trẻ nhỏ', 1),
(8, 'Hot Sale', 'Sản phẩm đang giảm giá', 1),
(9, 'Thuốc', 'Các loại thuốc kê đơn và không kê đơn', 1),
(10, 'Thực phẩm chức năng', 'Bổ sung vitamin và khoáng chất', 1),
(11, 'Thiết bị, dụng cụ y tế', 'Máy đo, thiết bị y tế gia đình', 1),
(12, 'Dược mỹ phẩm', 'Sản phẩm làm đẹp có dược tính', 1),
(13, 'Chăm sóc cá nhân', 'Sản phẩm vệ sinh, chăm sóc cơ thể', 1),
(14, 'Chăm sóc trẻ em', 'Sản phẩm dành cho trẻ nhỏ', 1),
(16, '075205017546', 'phamgiahuy', 1);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `danhmuc`
--
ALTER TABLE `danhmuc`
  ADD PRIMARY KEY (`MaDM`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `danhmuc`
--
ALTER TABLE `danhmuc`
  MODIFY `MaDM` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
