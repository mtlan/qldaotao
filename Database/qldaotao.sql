-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th7 15, 2021 lúc 03:42 AM
-- Phiên bản máy phục vụ: 10.4.19-MariaDB
-- Phiên bản PHP: 8.0.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `qldaotao`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `ma_admin` varchar(100) NOT NULL,
  `password_admin` varchar(100) NOT NULL,
  `hoten_admin` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `admin`
--

INSERT INTO `admin` (`id`, `ma_admin`, `password_admin`, `hoten_admin`) VALUES
(1, 'AD_01', '123456', 'Admin01');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `dangkyhoc`
--

CREATE TABLE `dangkyhoc` (
  `id` int(11) NOT NULL,
  `masv` varchar(100) NOT NULL,
  `hocky` varchar(100) NOT NULL,
  `namhoc` varchar(100) NOT NULL,
  `thoigian` date NOT NULL,
  `lophocphan_id` int(11) NOT NULL,
  `diem` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `dangkyhoc`
--

INSERT INTO `dangkyhoc` (`id`, `masv`, `hocky`, `namhoc`, `thoigian`, `lophocphan_id`, `diem`) VALUES
(80, '17it152', 'I', '2017-2018', '2021-07-15', 29, '8 8 8');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `giangvien`
--

CREATE TABLE `giangvien` (
  `id` int(11) NOT NULL,
  `magv` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `giangvien`
--

INSERT INTO `giangvien` (`id`, `magv`, `password`) VALUES
(1, 'GV01', '123456');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `hocphan`
--

CREATE TABLE `hocphan` (
  `id` int(11) NOT NULL,
  `tenhp` varchar(255) NOT NULL,
  `sotc` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `hocphan`
--

INSERT INTO `hocphan` (`id`, `tenhp`, `sotc`) VALUES
(21, 'Lập trình java', 3),
(22, 'Cở sở dữ liệu và giải thuật', 2),
(23, 'Xử lý tính hiệu số', 2),
(24, 'Công nghệ web cơ bản', 2),
(25, 'Cở sở dữ liệu và giải thuật', 2);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `lophocphan`
--

CREATE TABLE `lophocphan` (
  `id` int(11) NOT NULL,
  `tenlop` varchar(100) NOT NULL,
  `soluong` int(11) NOT NULL,
  `namhoc` varchar(100) NOT NULL,
  `hocky` varchar(50) NOT NULL,
  `hocphan_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `lophocphan`
--

INSERT INTO `lophocphan` (`id`, `tenlop`, `soluong`, `namhoc`, `hocky`, `hocphan_id`) VALUES
(29, 'WEB-2017', 20, '2017-2018', 'I', 24),
(32, 'JAVA-2019', 40, '2019-2020', 'I', 21);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `thongtinsv`
--

CREATE TABLE `thongtinsv` (
  `id` int(11) NOT NULL,
  `masv` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `hoten` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `thongtinsv`
--

INSERT INTO `thongtinsv` (`id`, `masv`, `password`, `hoten`) VALUES
(1, '17it152', '123456', 'Mai Trúc Lân'),
(2, '17it169', '123456', 'Nguyễn Văn Châu');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `dangkyhoc`
--
ALTER TABLE `dangkyhoc`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `giangvien`
--
ALTER TABLE `giangvien`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `hocphan`
--
ALTER TABLE `hocphan`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `lophocphan`
--
ALTER TABLE `lophocphan`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `thongtinsv`
--
ALTER TABLE `thongtinsv`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `dangkyhoc`
--
ALTER TABLE `dangkyhoc`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=124;

--
-- AUTO_INCREMENT cho bảng `giangvien`
--
ALTER TABLE `giangvien`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `hocphan`
--
ALTER TABLE `hocphan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT cho bảng `lophocphan`
--
ALTER TABLE `lophocphan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT cho bảng `thongtinsv`
--
ALTER TABLE `thongtinsv`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
