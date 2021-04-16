-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th10 01, 2020 lúc 05:46 AM
-- Phiên bản máy phục vụ: 10.4.13-MariaDB
-- Phiên bản PHP: 7.4.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `dam`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `binh_luan`
--

CREATE TABLE `binh_luan` (
  `id` int(11) NOT NULL,
  `noi_dung` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ma_hh` int(11) NOT NULL,
  `ma_kh` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `ngay_bl` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `hang_hoa`
--

CREATE TABLE `hang_hoa` (
  `id` int(11) NOT NULL,
  `ten_hh` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `don_gia` float NOT NULL,
  `giam_gia` float NOT NULL,
  `hinh` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ngay_nhap` date NOT NULL,
  `mo_ta` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `dac_biet` bit(1) NOT NULL,
  `so_luot_xem` int(11) DEFAULT NULL,
  `ma_loai` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `hang_hoa`
--

INSERT INTO `hang_hoa` (`id`, `ten_hh`, `don_gia`, `giam_gia`, `hinh`, `ngay_nhap`, `mo_ta`, `dac_biet`, `so_luot_xem`, `ma_loai`) VALUES
(25, 'Iphone 11 Pro Max', 14000000, 12, 'public/image/product/5f6d71912bfdb-iphone11.jpg', '2020-07-23', '            Bản đặc biệt                    ', b'1', 1, 1),
(26, 'Samsung Galaxy s10', 10900000, 8, 'public/image/product/5f6d71f33c663-samsungs10.png', '2020-09-25', '                 Bản đặc biệt                ', b'1', 1, 2),
(27, 'Iphone X S Max', 12500000, 9, 'public/image/product/5f6d726d4a949-iphonexsmax.png', '2020-09-25', '          Bảo hành 1 đổi 1 trong vòng 1 tháng                      ', b'1', 1, 1),
(37, 'Iphone 11 Pro Max 512G', 26000000, 11, 'public/image/product/5f6db569726de-iphone11pm.jpg', '2020-09-22', '                 Bảo hành chọn đời phần cứng               ', b'0', 1, 1),
(40, 'Iphone X 64G', 9600000, 11, 'public/image/product/5f6db65205253-iphonex_w.png', '2020-06-12', '           Bảo hành phần cứng chọn đời                     ', b'1', 1, 1),
(41, 'Iphone 11 64G', 14600000, 10, 'public/image/product/5f6db6e545a11-iphone11_w.jpg', '2020-09-25', '     Bảo hành chọn đời phần cứng                           ', b'1', 1, 1),
(51, 'SamSung S20 Untral', 23000000, 9, 'public/image/product/5f6eb2a347d6e-5f300fd1256bd-thumb_S20_demo_2.jpg', '2020-09-25', '                       Bảo hành chọn đời phần cứng         ', b'0', 1, 2),
(52, 'Samsung Galaxy Note 10', 10900000, 9, 'public/image/product/5f6eb32321f83-ss_note_10.jpg', '2020-09-26', '                 Tặng phiếu quà tặng trị giá lên đến 3 triệu đồng               ', b'1', 1, 2),
(53, 'SamSung Note 20 Untral 5G', 23000000, 12, 'public/image/product/5f6eb3a05978d-note20.jpg', '2020-05-22', '          Bảo hành 1 đổi 1 trong vòng 3 tháng                      ', b'0', 1, 2);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `khach_hang`
--

CREATE TABLE `khach_hang` (
  `id` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `mat_khau` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `ho_ten` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `kich_hoat` bit(1) NOT NULL,
  `hinh` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `vai_tro` bit(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `khach_hang`
--

INSERT INTO `khach_hang` (`id`, `mat_khau`, `ho_ten`, `kich_hoat`, `hinh`, `email`, `vai_tro`) VALUES
('ps1', '123456789', 'Hoàng Quốc Bảo Việt', b'1', 'public/image/khach_hang/5f72087433011-87559561_219037232826776_616655835103232000_n.jpg', 'viet@gmail.com', b'1'),
('ps2', '123456789', 'Đào Ánh Tuyết ', b'1', 'public/image/khach_hang/5f74634e954b0-vk.jpg', 'tuyet@gmail.com', b'1'),
('ps3', '123456789', 'Chúc Anh Quân', b'0', 'public/image/khach_hang/5f74ab4d63a2e-anh1.jpg', 'quan@gmail.com', b'0'),
('ps4', '123456789', 'Nguyễn Đức Thắng', b'0', 'public/image/khach_hang/5f7456b110d9a-anh5.jpg', 'thang@gmail.com', b'0');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `loai_hang`
--

CREATE TABLE `loai_hang` (
  `id` int(11) NOT NULL,
  `ten_loai` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `loai_hang`
--

INSERT INTO `loai_hang` (`id`, `ten_loai`) VALUES
(1, 'Iphone'),
(2, 'samsung'),
(23, 'Phụ kiện'),
(25, 'Đồng hồ');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `binh_luan`
--
ALTER TABLE `binh_luan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_binh_luan_hang_hoa` (`ma_hh`),
  ADD KEY `FK_binh_luan_khach_hang` (`ma_kh`);

--
-- Chỉ mục cho bảng `hang_hoa`
--
ALTER TABLE `hang_hoa`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_hang_hoa_loai` (`ma_loai`);

--
-- Chỉ mục cho bảng `khach_hang`
--
ALTER TABLE `khach_hang`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `loai_hang`
--
ALTER TABLE `loai_hang`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `binh_luan`
--
ALTER TABLE `binh_luan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `hang_hoa`
--
ALTER TABLE `hang_hoa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT cho bảng `loai_hang`
--
ALTER TABLE `loai_hang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `binh_luan`
--
ALTER TABLE `binh_luan`
  ADD CONSTRAINT `FK_binh_luan_hang_hoa` FOREIGN KEY (`ma_hh`) REFERENCES `hang_hoa` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_binh_luan_khach_hang` FOREIGN KEY (`ma_kh`) REFERENCES `khach_hang` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `hang_hoa`
--
ALTER TABLE `hang_hoa`
  ADD CONSTRAINT `FK_hang_hoa_loai` FOREIGN KEY (`ma_loai`) REFERENCES `loai_hang` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
