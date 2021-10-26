-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th10 26, 2021 lúc 04:35 PM
-- Phiên bản máy phục vụ: 10.4.21-MariaDB
-- Phiên bản PHP: 8.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `qlnhanvien`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `loainv`
--

CREATE TABLE `loainv` (
  `MaLoaiNV` varchar(5) NOT NULL,
  `TenLoaiNV` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `loainv`
--

INSERT INTO `loainv` (`MaLoaiNV`, `TenLoaiNV`) VALUES
('LNV01', 'Hậu cần'),
('LNV02', 'Làm chính');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `nguoidung`
--

CREATE TABLE `nguoidung` (
  `user` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `nguoidung`
--

INSERT INTO `nguoidung` (`user`, `password`) VALUES
('huypham', '123456');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `nhanvien`
--

CREATE TABLE `nhanvien` (
  `MaNV` varchar(5) NOT NULL,
  `Ho` varchar(40) NOT NULL,
  `Ten` varchar(10) NOT NULL,
  `NgaySinh` date NOT NULL,
  `GioiTinh` tinyint(1) NOT NULL,
  `DiaChi` varchar(50) NOT NULL,
  `Anh` varchar(50) NOT NULL,
  `MaLoaiNV` varchar(5) NOT NULL,
  `MaPhong` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `nhanvien`
--

INSERT INTO `nhanvien` (`MaNV`, `Ho`, `Ten`, `NgaySinh`, `GioiTinh`, `DiaChi`, `Anh`, `MaLoaiNV`, `MaPhong`) VALUES
('NV002', 'Thái Văn', 'Nam', '2000-10-11', 1, '55 vạn giã', 'ta.jpg', 'LNV02', 'P0002'),
('NV003', 'Lê xuân', 'Đại', '2021-10-17', 1, '  33 cam lâm', 'cuong.jpg', 'LNV01', 'P0001'),
('NV004', 'Lê xuân', 'Đại', '2021-10-17', 1, '   33 cam lâm ', 'rose.jpg', 'LNV01', 'P0001'),
('NV005', 'Bùi Văn', 'Việt', '2021-10-08', 1, ' 1 lê hồng phong', 'gai.jpg', 'LNV02', 'P0002'),
('NV006', 'Hồ Đại', 'Phương', '2021-10-20', 1, '  33 trần phú', 'jisoon.jpg', 'LNV01', 'P0001'),
('NV007', 'lê', 'thuận', '2021-10-22', 1, '  33 ngọc hiệp', 'amee.jpg', 'LNV01', 'P0001'),
('NV008', 'Võ Lương Sỹ', 'Hoàng', '2021-10-14', 1, '  33 thái nguyên', 'wowy.jpg', 'LNV01', 'P0001');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `phongban`
--

CREATE TABLE `phongban` (
  `MaPhong` varchar(5) NOT NULL,
  `TenPhong` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `phongban`
--

INSERT INTO `phongban` (`MaPhong`, `TenPhong`) VALUES
('P0001', 'Phòng nhân sự'),
('P0002', 'Phòng tài chính');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `loainv`
--
ALTER TABLE `loainv`
  ADD PRIMARY KEY (`MaLoaiNV`);

--
-- Chỉ mục cho bảng `nguoidung`
--
ALTER TABLE `nguoidung`
  ADD PRIMARY KEY (`user`);

--
-- Chỉ mục cho bảng `nhanvien`
--
ALTER TABLE `nhanvien`
  ADD PRIMARY KEY (`MaNV`),
  ADD KEY `MaLoaiNV` (`MaLoaiNV`),
  ADD KEY `MaPhong` (`MaPhong`);

--
-- Chỉ mục cho bảng `phongban`
--
ALTER TABLE `phongban`
  ADD PRIMARY KEY (`MaPhong`);

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `nhanvien`
--
ALTER TABLE `nhanvien`
  ADD CONSTRAINT `nhanvien_ibfk_1` FOREIGN KEY (`MaLoaiNV`) REFERENCES `loainv` (`MaLoaiNV`),
  ADD CONSTRAINT `nhanvien_ibfk_2` FOREIGN KEY (`MaPhong`) REFERENCES `phongban` (`MaPhong`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
