-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th4 17, 2022 lúc 07:39 PM
-- Phiên bản máy phục vụ: 10.4.22-MariaDB
-- Phiên bản PHP: 8.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `amthucbanh`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `binhluan_sp`
--

CREATE TABLE `binhluan_sp` (
  `id_bl` int(11) NOT NULL,
  `id_sp_bl` int(11) NOT NULL,
  `id_kh_bl` int(11) NOT NULL,
  `noidung_bl` longtext NOT NULL,
  `ten_admin_bl` varchar(200) NOT NULL,
  `noidung_traloi` longtext NOT NULL,
  `ngay_bl` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `binhluan_sp`
--

INSERT INTO `binhluan_sp` (`id_bl`, `id_sp_bl`, `id_kh_bl`, `noidung_bl`, `ten_admin_bl`, `noidung_traloi`, `ngay_bl`) VALUES
(1, 8, 1, 'sản phẩm tuyệt vời', 'Đỗ Xuân Mạnh', 'Cảm ơn quý khách đã tin tưởng và sử dụng sản phẩm của chúng tôi.Chúc quý khách ngon miệng!!!', '2022-04-17 15:53:10');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `dangky_sp`
--

CREATE TABLE `dangky_sp` (
  `id_dangky` int(11) NOT NULL,
  `ten_kh` varchar(100) NOT NULL,
  `email_kh` varchar(50) NOT NULL,
  `matkhau_kh` varchar(50) NOT NULL,
  `diachi_kh` varchar(100) NOT NULL,
  `hinhanh_kh` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `dangky_sp`
--

INSERT INTO `dangky_sp` (`id_dangky`, `ten_kh`, `email_kh`, `matkhau_kh`, `diachi_kh`, `hinhanh_kh`) VALUES
(1, 'Mạnh', 'manhchi847@gmail.com', '12345', 'Hà Nội', 'https://wallpapercave.com/wp/wp7479802.jpg');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `danhmucbaiviet_sp`
--

CREATE TABLE `danhmucbaiviet_sp` (
  `id_danhmuc_bv` int(11) NOT NULL,
  `id_admin_bv` int(11) NOT NULL,
  `ten_danhmuc_bv` varchar(200) NOT NULL,
  `ten_admin_bv` varchar(200) NOT NULL,
  `thutu_bv` varchar(200) NOT NULL,
  `hinhanh_bv` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `danhmucbaiviet_sp`
--

INSERT INTO `danhmucbaiviet_sp` (`id_danhmuc_bv`, `id_admin_bv`, `ten_danhmuc_bv`, `ten_admin_bv`, `thutu_bv`, `hinhanh_bv`) VALUES
(2, 1, 'Bánh mì Pew Pew', 'Đỗ Xuân Mạnh', '1', '1650201670_tiem-banh-mi-pewpew.jpg');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `danhmuc_sanpham`
--

CREATE TABLE `danhmuc_sanpham` (
  `id_danhmuc` int(11) NOT NULL,
  `id_admin` int(11) NOT NULL,
  `tendanhmuc` varchar(200) NOT NULL,
  `tenadmin` varchar(200) NOT NULL,
  `thutu` varchar(50) NOT NULL,
  `hinhanh_dm` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `danhmuc_sanpham`
--

INSERT INTO `danhmuc_sanpham` (`id_danhmuc`, `id_admin`, `tendanhmuc`, `tenadmin`, `thutu`, `hinhanh_dm`) VALUES
(6, 1, 'Bánh ngọt', 'Đỗ Xuân Mạnh', '1', '1650197998_sukemdau.jpg'),
(7, 1, 'Bánh mặn', 'Đỗ Xuân Mạnh', '2', '1650198155_bg.jpg'),
(8, 1, 'Trà sữa', 'Đỗ Xuân Mạnh', '3', '1650198173_bubble-tea-7107131_1280.png'),
(9, 1, 'Cà phê', 'Đỗ Xuân Mạnh', '4', '1650201230_coffee-1569682_1920.jpg'),
(11, 1, 'Đồ ăn vặt', 'Đỗ Xuân Mạnh', '5', '1650198241_snack.png'),
(12, 1, 'Nước ngọt', 'Đỗ Xuân Mạnh', '6', '1650201255_drink.jpg');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `sanpham_sp`
--

CREATE TABLE `sanpham_sp` (
  `id_sp` int(11) NOT NULL,
  `id_admin_sp` int(11) NOT NULL,
  `id_danhmuc` int(11) NOT NULL,
  `ten_admin_sp` varchar(200) NOT NULL,
  `ten_sp` varchar(100) NOT NULL,
  `gia_sp` varchar(200) NOT NULL,
  `soluong_sp` varchar(100) NOT NULL,
  `noidung_sp` longtext NOT NULL,
  `hinhanh_sp` varchar(200) NOT NULL,
  `ma_sp` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `sanpham_sp`
--

INSERT INTO `sanpham_sp` (`id_sp`, `id_admin_sp`, `id_danhmuc`, `ten_admin_sp`, `ten_sp`, `gia_sp`, `soluong_sp`, `noidung_sp`, `hinhanh_sp`, `ma_sp`) VALUES
(8, 1, 6, 'Đỗ Xuân Mạnh', 'Bánh Sinh Nhật', '100000', '5', 'Bánh sinh nhật truyền thống', '1650177703_banh kem sinh nhat.jpg', 1),
(9, 1, 6, 'Đỗ Xuân Mạnh', 'Humberger', '40000', '50', 'Humberger truyền thống', '1650201447_humberger.jpg', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `user_full` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `user_mail` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `user_pass` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `user_level` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `user`
--

INSERT INTO `user` (`user_id`, `user_full`, `user_mail`, `user_pass`, `user_level`) VALUES
(1, 'Đỗ Xuân Mạnh', 'domanh011020@gmail.com', '12345', 1),
(2, 'Đỗ Xuân Mạnh', 'manhchi847@gmail.com', '12345', 1);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `binhluan_sp`
--
ALTER TABLE `binhluan_sp`
  ADD PRIMARY KEY (`id_bl`);

--
-- Chỉ mục cho bảng `dangky_sp`
--
ALTER TABLE `dangky_sp`
  ADD PRIMARY KEY (`id_dangky`);

--
-- Chỉ mục cho bảng `danhmucbaiviet_sp`
--
ALTER TABLE `danhmucbaiviet_sp`
  ADD PRIMARY KEY (`id_danhmuc_bv`);

--
-- Chỉ mục cho bảng `danhmuc_sanpham`
--
ALTER TABLE `danhmuc_sanpham`
  ADD PRIMARY KEY (`id_danhmuc`);

--
-- Chỉ mục cho bảng `sanpham_sp`
--
ALTER TABLE `sanpham_sp`
  ADD PRIMARY KEY (`id_sp`);

--
-- Chỉ mục cho bảng `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `user_mail` (`user_mail`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `binhluan_sp`
--
ALTER TABLE `binhluan_sp`
  MODIFY `id_bl` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `dangky_sp`
--
ALTER TABLE `dangky_sp`
  MODIFY `id_dangky` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `danhmucbaiviet_sp`
--
ALTER TABLE `danhmucbaiviet_sp`
  MODIFY `id_danhmuc_bv` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `danhmuc_sanpham`
--
ALTER TABLE `danhmuc_sanpham`
  MODIFY `id_danhmuc` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT cho bảng `sanpham_sp`
--
ALTER TABLE `sanpham_sp`
  MODIFY `id_sp` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT cho bảng `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
