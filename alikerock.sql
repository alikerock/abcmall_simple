-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- 생성 시간: 23-03-08 12:50
-- 서버 버전: 8.0.32
-- PHP 버전: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 데이터베이스: `alikerock`
--

-- --------------------------------------------------------

--
-- 테이블 구조 `admins`
--

CREATE TABLE `admins` (
  `idx` int NOT NULL,
  `userid` varchar(145) DEFAULT NULL,
  `email` varchar(245) DEFAULT NULL,
  `username` varchar(145) DEFAULT NULL,
  `passwd` varchar(200) DEFAULT NULL,
  `regdate` datetime DEFAULT CURRENT_TIMESTAMP,
  `level` tinyint DEFAULT NULL,
  `last_login` datetime DEFAULT NULL,
  `end_login_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- 테이블의 덤프 데이터 `admins`
--

INSERT INTO `admins` (`idx`, `userid`, `email`, `username`, `passwd`, `regdate`, `level`, `last_login`, `end_login_date`) VALUES
(4, 'admin', 'admin@shop.com', '관리자', '33275a8aa48ea918bd53a9181aa975f15ab0d0645398f5918a006d08675c1cb27d5c645dbd084eee56e675e25ba4019f2ecea37ca9e2995b49fcb12c096a032e', '2023-01-01 17:12:32', 100, '2023-03-08 09:21:15', NULL);

-- --------------------------------------------------------

--
-- 테이블 구조 `cart`
--

CREATE TABLE `cart` (
  `cartid` int NOT NULL,
  `pid` int DEFAULT NULL,
  `userid` varchar(100) DEFAULT NULL,
  `ssid` varchar(100) DEFAULT NULL,
  `options` varchar(100) DEFAULT NULL,
  `cnt` int DEFAULT NULL,
  `regdate` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- 테이블의 덤프 데이터 `cart`
--

INSERT INTO `cart` (`cartid`, `pid`, `userid`, `ssid`, `options`, `cnt`, `regdate`) VALUES
(4, 14, '', '1dlmko4mer3er4qqh3qv9j4acs', '14||16', 3, '2023-03-07 17:57:32'),
(5, 14, 'green', 'dj8vj3p5b3udulrbk6nsec5joa', '||', 2, '2023-03-08 11:38:47'),
(6, 12, 'green', 'dj8vj3p5b3udulrbk6nsec5joa', '||', 4, '2023-03-08 11:38:55');

-- --------------------------------------------------------

--
-- 테이블 구조 `category`
--

CREATE TABLE `category` (
  `cid` int NOT NULL,
  `code` varchar(10) DEFAULT NULL,
  `pcode` varchar(10) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `step` tinyint DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- 테이블의 덤프 데이터 `category`
--

INSERT INTO `category` (`cid`, `code`, `pcode`, `name`, `step`) VALUES
(1, 'A0001', 'A0001', '컴퓨터', 1),
(2, 'B0001', 'A0001', '노트북', 2),
(3, 'C0001', 'B0001', '게임용', 3),
(4, 'A0002', '', '핸드폰', 1),
(5, 'D0001', 'A0002', '안드로이드', 2),
(6, 'E0001', 'D0001', '갤러시', 3);

-- --------------------------------------------------------

--
-- 테이블 구조 `coupons`
--

CREATE TABLE `coupons` (
  `cid` int NOT NULL,
  `coupon_name` varchar(100) DEFAULT NULL COMMENT '쿠폰명',
  `coupon_image` varchar(100) DEFAULT NULL COMMENT '쿠폰이미지',
  `coupon_type` tinyint DEFAULT NULL COMMENT '쿠폰타입',
  `coupon_price` double DEFAULT NULL COMMENT '할인금액',
  `coupon_ratio` double DEFAULT NULL COMMENT '할인비율',
  `status` tinyint DEFAULT '0' COMMENT '상태',
  `regdate` datetime DEFAULT NULL COMMENT '등록일',
  `userid` varchar(100) DEFAULT NULL COMMENT '등록한유저',
  `max_value` double DEFAULT NULL COMMENT '최대할인금액',
  `use_min_price` double DEFAULT NULL COMMENT '최소사용금액'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- 테이블의 덤프 데이터 `coupons`
--

INSERT INTO `coupons` (`cid`, `coupon_name`, `coupon_image`, `coupon_type`, `coupon_price`, `coupon_ratio`, `status`, `regdate`, `userid`, `max_value`, `use_min_price`) VALUES
(1, '쿠폰명1', '/pdata/CPN_20230302104146105093.png', 1, 10000, 0, 2, '2023-03-02 10:41:46', 'admin', 10000, 5000);

-- --------------------------------------------------------

--
-- 테이블 구조 `members`
--

CREATE TABLE `members` (
  `mid` int NOT NULL,
  `userid` varchar(145) DEFAULT NULL,
  `email` varchar(245) DEFAULT NULL,
  `username` varchar(145) DEFAULT NULL,
  `passwd` varchar(200) DEFAULT NULL,
  `regdate` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- 테이블의 덤프 데이터 `members`
--

INSERT INTO `members` (`mid`, `userid`, `email`, `username`, `passwd`, `regdate`) VALUES
(1, 'hong', 'hone@gmail.com', '홍길동', 'd404559f602eab6fd602ac7680dacbfaadd13630335e951f097af3900e9de176b6db28512f2e000b9d04fba5133e8b1c6e8df59db3a8ab9d60be4b97cc9e81db', '2023-03-02 11:45:33'),
(3, 'leedo', 'leedo@gmail.com', '이도령', 'd404559f602eab6fd602ac7680dacbfaadd13630335e951f097af3900e9de176b6db28512f2e000b9d04fba5133e8b1c6e8df59db3a8ab9d60be4b97cc9e81db', '2023-03-02 12:01:48'),
(4, 'alikerock3', 'alikerock@gmail.com', '이도령', 'c341a86099f7533dbea125665146569f1ded01dc03d3ca970d18fa7f0c09f57901e276f71bd0425e50f0d1b87b4603a43778d89d94bea7e1fba379d67cc9f203', '2023-03-06 16:22:19'),
(5, 'alikerock3', 'test.@gmai.com', '이도령', '33275a8aa48ea918bd53a9181aa975f15ab0d0645398f5918a006d08675c1cb27d5c645dbd084eee56e675e25ba4019f2ecea37ca9e2995b49fcb12c096a032e', '2023-03-07 18:02:27'),
(6, 'alikerock', 'alikerock@gmail.com', '홍길동', 'c341a86099f7533dbea125665146569f1ded01dc03d3ca970d18fa7f0c09f57901e276f71bd0425e50f0d1b87b4603a43778d89d94bea7e1fba379d67cc9f203', '2023-03-07 22:37:37'),
(7, 'alikerock', 'alikerock@gmail.com', '홍길동', 'c341a86099f7533dbea125665146569f1ded01dc03d3ca970d18fa7f0c09f57901e276f71bd0425e50f0d1b87b4603a43778d89d94bea7e1fba379d67cc9f203', '2023-03-07 22:39:14'),
(8, 'green', 'green@green.com', 'green', 'd2161ae3193879edd9ca8bebb75b4056f275a4dacfa4f42c4778d063e1149f3e0e4176e42eefce573d1a743e89cf5e848ea09d593b3ad4fe41e5e79ea9704733', '2023-03-08 10:45:23');

-- --------------------------------------------------------

--
-- 테이블 구조 `products`
--

CREATE TABLE `products` (
  `pid` int NOT NULL,
  `name` varchar(500) NOT NULL,
  `cate` varchar(100) DEFAULT NULL,
  `content` text,
  `thumbnail` varchar(100) DEFAULT NULL,
  `price` double DEFAULT NULL,
  `sale_price` double DEFAULT NULL,
  `sale_ratio` double DEFAULT NULL,
  `cnt` int DEFAULT NULL,
  `sale_cnt` int DEFAULT NULL,
  `isnew` tinyint DEFAULT NULL,
  `isbest` tinyint DEFAULT NULL,
  `isrecom` tinyint DEFAULT NULL,
  `ismain` tinyint DEFAULT NULL,
  `locate` tinyint DEFAULT NULL,
  `userid` varchar(100) DEFAULT NULL,
  `sale_end_date` datetime DEFAULT NULL,
  `reg_date` datetime DEFAULT NULL,
  `status` tinyint DEFAULT '0',
  `delivery_fee` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- 테이블의 덤프 데이터 `products`
--

INSERT INTO `products` (`pid`, `name`, `cate`, `content`, `thumbnail`, `price`, `sale_price`, `sale_ratio`, `cnt`, `sale_cnt`, `isnew`, `isbest`, `isrecom`, `ismain`, `locate`, `userid`, `sale_end_date`, `reg_date`, `status`, `delivery_fee`) VALUES
(4, '제품명1', 'A0001B0001C0001', '<p>설명 테스트</p>', '/pdata/20230224001626107442.png', 2000, 3000, 40, 100, 0, 1, 0, 1, 1, 1, 'admin', '2023-02-28 00:00:00', '2023-02-24 00:16:26', 0, 1000),
(5, '이도령', 'A0001B0001C0001', '<p>설명 TEST</p>', '/pdata/20230224131659467579.png', 2000, 155, 10, 100, 0, 0, 1, 1, 1, 2, 'admin', '2023-02-28 00:00:00', '2023-02-24 13:16:59', -1, 1000),
(6, '이도령2', 'A0001B0001C0001', '<p>test</p>', '/pdata/20230224132512140495.png', 2000, 1500, 10, 1, 0, 0, 1, 1, 1, 1, 'admin', '2023-02-28 00:00:00', '2023-02-24 13:25:12', 1, 1000),
(7, '제품명2', 'A0001B0001C0001', '<p>test</p>', '/pdata/20230224142405126011.png', 2000, 1500, 10, 100, 0, 1, 1, 1, 0, 1, 'admin', '2023-02-28 00:00:00', '2023-02-24 14:24:05', 1, 1000),
(8, '제품명20230227', 'A0001B0001C0001', '<p>테스트</p>', '/pdata/20230227144453103607.jpg', 5000, 4000, 20, 100, 0, 1, 1, 1, 1, 1, 'admin', '2023-02-28 00:00:00', '2023-02-27 14:44:53', 1, 1000),
(9, '제푸명27', 'A0001B0001C0001', '<p>테스트</p>', '', 5000, 4000, 10, 100, 0, 1, 1, 1, 1, 1, 'admin', '2023-02-28 00:00:00', '2023-02-27 14:48:06', 0, 1000),
(10, '드래그앤드롭상품', 'A0001B0001C0001', '<p>드래그 앤 드롭 상품</p>', '/pdata/20230227165508126843.jpg', 1000, 1000, 10, 100, 0, 1, 1, 1, 1, 1, 'admin', '2023-02-28 00:00:00', '2023-02-27 16:55:08', 1, 1000),
(11, '드래드앤드롭 테스트2', 'A0001B0001C0001', '<p>설명 테스트</p>', '/pdata/20230227170946835950.png', 1000, 1500, 10, 10, 0, 1, 1, 1, 1, 1, 'admin', '2023-02-28 00:00:00', '2023-02-27 17:09:46', 1, 2000),
(12, '제품명0228', 'A0001B0001C0001', '<p>테스트</p>', '/pdata/20230228113658293746.jpg', 1500, 1000, 10, 100, 0, 1, 1, 1, 1, 1, 'admin', '2023-03-31 00:00:00', '2023-02-28 11:36:58', 1, 1000),
(13, '제품명0228-2', 'A0001B0001C0001', '<p>설명 테스트</p>', '/pdata/20230228114814104732.jpg', 1500, 1000, 1000, 100, 0, 1, 1, 1, 1, 2, 'admin', '2023-03-31 00:00:00', '2023-02-28 11:48:14', 1, 1000),
(14, '제품명0228-3', 'A0001B0001C0001', '<p>설명 테스트</p>', '/pdata/20230228143622133026.jpg', 1000, 1000, 10, 100, 0, 1, 1, 1, 1, 1, 'admin', '2023-03-31 00:00:00', '2023-02-28 14:36:22', 1, 2500),
(15, '제품명0302-1', 'A0001B0001C0001', '<p>설명 테스트</p>', '/pdata/20230302100102376946.png', 10000, 9000, 10, 100, 0, 1, 1, 1, 1, 1, 'admin', '2023-03-31 00:00:00', '2023-03-02 10:01:02', 1, 2000),
(16, '제품명0307', 'A0001B0001C0001', '<p>테스트<br></p><p><span style=\"background-color: var(--bs-table-bg); color: var(--bs-table-color); font-family: var(--bs-body-font-family); font-size: var(--bs-body-font-size); font-weight: var(--bs-body-font-weight); text-align: var(--bs-body-text-align);\">테스트</span></p><p>테스트</p><p><br></p>', '/pdata/20230307091055191500.jpg', 5000, 1000, 20, 100, 0, 0, 0, 0, 0, 0, 'admin', '2023-03-31 00:00:00', '2023-03-07 09:10:55', 0, 1000);

-- --------------------------------------------------------

--
-- 테이블 구조 `product_image_table`
--

CREATE TABLE `product_image_table` (
  `imgid` int NOT NULL,
  `pid` int DEFAULT NULL,
  `userid` varchar(100) DEFAULT NULL,
  `filename` varchar(100) DEFAULT NULL,
  `regdate` datetime DEFAULT CURRENT_TIMESTAMP,
  `status` tinyint DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- 테이블의 덤프 데이터 `product_image_table`
--

INSERT INTO `product_image_table` (`imgid`, `pid`, `userid`, `filename`, `regdate`, `status`) VALUES
(1, NULL, 'admin', '20230223151004540171.png', '2023-02-23 15:10:04', 1),
(2, NULL, 'admin', '20230223151108178413.png', '2023-02-23 15:11:08', 1),
(3, NULL, 'admin', '20230223151400209616.png', '2023-02-23 15:14:00', 1),
(4, NULL, 'admin', '20230223153006201610.png', '2023-02-23 15:30:06', 1),
(5, NULL, 'admin', '20230223153530169455.png', '2023-02-23 15:35:30', 1),
(6, NULL, 'admin', '20230223154321172737.png', '2023-02-23 15:43:21', 1),
(7, NULL, 'admin', '20230223154454200851.png', '2023-02-23 15:44:54', 1),
(8, NULL, 'admin', '20230223154523112133.png', '2023-02-23 15:45:23', 1),
(9, NULL, 'admin', '20230223154527442245.png', '2023-02-23 15:45:27', 1),
(10, NULL, 'admin', '20230223154556490730.png', '2023-02-23 15:45:56', 1),
(11, NULL, 'admin', '20230223154600141813.png', '2023-02-23 15:46:00', 1),
(12, NULL, 'admin', '20230223160947184137.png', '2023-02-23 16:09:47', 1),
(13, NULL, 'admin', '20230223161416458054.png', '2023-02-23 16:14:16', 1),
(14, NULL, 'admin', '20230223161555164047.png', '2023-02-23 16:15:55', 1),
(15, NULL, 'admin', '20230223161857205555.png', '2023-02-23 16:18:57', 1),
(16, NULL, 'admin', '20230223162324687622.png', '2023-02-23 16:23:24', 1),
(17, NULL, 'admin', '20230223162534270127.png', '2023-02-23 16:25:34', 1),
(18, NULL, 'admin', '20230223162857122663.png', '2023-02-23 16:28:57', 1),
(19, NULL, 'admin', '20230223162934150417.png', '2023-02-23 16:29:34', 1),
(20, NULL, 'admin', '20230223163005233341.png', '2023-02-23 16:30:05', 0),
(21, NULL, 'admin', '20230223163143100280.png', '2023-02-23 16:31:43', 0),
(22, NULL, 'admin', '20230223163220805098.png', '2023-02-23 16:32:20', 1),
(23, NULL, 'admin', '20230223163703120578.png', '2023-02-23 16:37:03', 1),
(24, NULL, 'admin', '20230223163754177035.png', '2023-02-23 16:37:54', 1),
(25, NULL, 'admin', '20230223163758718351.png', '2023-02-23 16:37:58', 1),
(26, NULL, 'admin', '20230223164008183970.png', '2023-02-23 16:40:08', 0),
(27, NULL, 'admin', '20230223164012125869.png', '2023-02-23 16:40:12', 0),
(28, NULL, 'admin', '20230223164244402317.png', '2023-02-23 16:42:44', 1),
(29, NULL, 'admin', '20230223180640210948.png', '2023-02-23 18:06:40', 1),
(30, NULL, 'admin', '20230223180640497689.png', '2023-02-23 18:06:40', 0),
(31, NULL, 'admin', '20230223181009505784.png', '2023-02-23 18:10:09', 0),
(32, NULL, 'admin', '20230223181043538591.png', '2023-02-23 18:10:43', 0),
(33, NULL, 'admin', '20230223181649206458.png', '2023-02-23 18:16:49', 1),
(34, NULL, 'admin', '20230223181649778411.png', '2023-02-23 18:16:49', 0),
(35, NULL, 'admin', '20230223232325774629.jpg', '2023-02-23 23:23:25', 0),
(36, NULL, 'admin', '20230223232648148414.png', '2023-02-23 23:26:48', 0),
(37, NULL, 'admin', '20230223233136135730.png', '2023-02-23 23:31:36', 0),
(38, NULL, 'admin', '20230223233420187177.png', '2023-02-23 23:34:20', 0),
(39, NULL, 'admin', '20230223233912952653.png', '2023-02-23 23:39:12', 0),
(40, NULL, 'admin', '20230223233940153664.png', '2023-02-23 23:39:40', 0),
(41, NULL, 'admin', '20230223234245560465.png', '2023-02-23 23:42:45', 1),
(42, NULL, 'admin', '20230223234346982800.png', '2023-02-23 23:43:46', 0),
(43, NULL, 'admin', '20230224000803402117.jpg', '2023-02-24 00:08:03', 1),
(44, NULL, 'admin', '20230224000951105230.jpg', '2023-02-24 00:09:51', 1),
(45, NULL, 'admin', '20230224001006345677.png', '2023-02-24 00:10:06', 1),
(46, 4, 'admin', '20230224001624175337.png', '2023-02-24 00:16:24', 1),
(47, 4, 'admin', '20230224001624136848.jpg', '2023-02-24 00:16:24', 1),
(48, NULL, 'admin', '20230224112107737205.png', '2023-02-24 11:21:07', 0),
(49, NULL, 'admin', '20230224112107158239.png', '2023-02-24 11:21:07', 0),
(50, NULL, 'admin', '20230224112130136712.png', '2023-02-24 11:21:30', 0),
(51, NULL, 'admin', '20230224114221198467.png', '2023-02-24 11:42:21', 1),
(52, NULL, 'admin', '20230224115557878659.png', '2023-02-24 11:55:57', 1),
(53, NULL, 'admin', '20230224115710192365.png', '2023-02-24 11:57:10', 1),
(54, NULL, 'admin', '20230224121822552232.png', '2023-02-24 12:18:22', 1),
(55, NULL, 'admin', '20230224121823792678.png', '2023-02-24 12:18:23', 1),
(56, NULL, 'admin', '20230224121824596422.png', '2023-02-24 12:18:24', 1),
(57, NULL, 'admin', '20230224122001101375.png', '2023-02-24 12:20:01', 1),
(58, NULL, 'admin', '20230224122001201054.png', '2023-02-24 12:20:01', 1),
(59, NULL, 'admin', '20230224122127115732.png', '2023-02-24 12:21:27', 1),
(60, NULL, 'admin', '20230224122127927519.png', '2023-02-24 12:21:27', 1),
(61, NULL, 'admin', '20230224122208136016.png', '2023-02-24 12:22:08', 1),
(62, NULL, 'admin', '20230224122208138504.png', '2023-02-24 12:22:08', 1),
(63, NULL, 'admin', '20230224122340170146.png', '2023-02-24 12:23:40', 1),
(64, NULL, 'admin', '20230224122340405511.png', '2023-02-24 12:23:40', 1),
(65, NULL, 'admin', '20230224131648847250.png', '2023-02-24 13:16:48', 1),
(66, NULL, 'admin', '20230224131648110896.png', '2023-02-24 13:16:48', 1),
(67, 6, 'admin', '20230224132506956869.png', '2023-02-24 13:25:06', 1),
(68, 6, 'admin', '20230224132506130152.png', '2023-02-24 13:25:06', 1),
(69, 7, 'admin', '20230224142401251721.png', '2023-02-24 14:24:01', 1),
(70, 7, 'admin', '20230224142401638308.png', '2023-02-24 14:24:01', 1),
(71, 8, 'admin', '20230227144407155037.jpg', '2023-02-27 14:44:07', 1),
(72, NULL, 'admin', '20230227170237730621.png', '2023-02-27 17:02:37', 1),
(73, NULL, 'admin', '20230227170243469263.png', '2023-02-27 17:02:43', 1),
(74, NULL, 'admin', '20230227170251436203.png', '2023-02-27 17:02:51', 1),
(75, NULL, 'admin', '20230227170259682619.png', '2023-02-27 17:02:59', 1),
(76, NULL, 'admin', '20230227170302189266.png', '2023-02-27 17:03:02', 1),
(77, NULL, 'admin', '20230227170313177584.png', '2023-02-27 17:03:13', 1),
(78, NULL, 'admin', '20230227170414170049.png', '2023-02-27 17:04:14', 1),
(79, NULL, 'admin', '20230227170612195334.png', '2023-02-27 17:06:12', 1),
(80, 11, 'admin', '20230227170838126923.png', '2023-02-27 17:08:38', 1),
(81, 11, 'admin', '20230227170843833644.png', '2023-02-27 17:08:43', 1),
(82, NULL, 'admin', '20230227171045124348.png', '2023-02-27 17:10:45', 1),
(83, NULL, 'admin', '20230227171048459832.jpg', '2023-02-27 17:10:48', 1),
(84, NULL, 'admin', '20230227171324161469.png', '2023-02-27 17:13:24', 1),
(85, NULL, 'admin', '20230227171324911055.jpg', '2023-02-27 17:13:24', 1),
(86, NULL, 'admin', '20230228092234192741.jpg', '2023-02-28 09:22:34', 1),
(87, NULL, 'admin', '20230228092434115820.jpg', '2023-02-28 09:24:34', 0),
(88, NULL, 'admin', '20230228092508350195.png', '2023-02-28 09:25:08', 0),
(89, NULL, 'admin', '20230228092556407512.png', '2023-02-28 09:25:56', 0),
(90, NULL, 'admin', '20230228095103662661.jpg', '2023-02-28 09:51:03', 1),
(91, NULL, 'admin', '20230228095158146732.jpg', '2023-02-28 09:51:58', 1),
(92, NULL, 'admin', '20230228105241205530.png', '2023-02-28 10:52:41', 0),
(93, NULL, 'admin', '20230228113631579125.png', '2023-02-28 11:36:31', 1),
(94, NULL, 'admin', '20230228113631189042.png', '2023-02-28 11:36:31', 1),
(95, NULL, 'admin', '20230228114508696063.png', '2023-02-28 11:45:08', 1),
(96, NULL, 'admin', '20230228114513204910.png', '2023-02-28 11:45:13', 1),
(97, 13, 'admin', '20230228114645152014.png', '2023-02-28 11:46:45', 1),
(98, 13, 'admin', '20230228114645122908.png', '2023-02-28 11:46:45', 1),
(99, 14, 'admin', '20230228143537173410.png', '2023-02-28 14:35:37', 1),
(100, NULL, 'admin', '20230228150415208337.jpg', '2023-02-28 15:04:15', 0),
(101, 15, 'admin', '20230302100056150173.jpg', '2023-03-02 10:00:56', 1),
(102, NULL, 'admin', '20230307090937535024.jpg', '2023-03-07 09:09:37', 1),
(103, 16, 'admin', '20230307091052205929.jpg', '2023-03-07 09:10:52', 1);

-- --------------------------------------------------------

--
-- 테이블 구조 `product_options`
--

CREATE TABLE `product_options` (
  `poid` int NOT NULL,
  `pid` int DEFAULT NULL,
  `cate` varchar(100) DEFAULT NULL,
  `option_name` varchar(100) DEFAULT NULL,
  `option_cnt` int DEFAULT NULL,
  `option_price` int DEFAULT NULL,
  `image_url` varchar(300) DEFAULT NULL,
  `status` tinyint DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- 테이블의 덤프 데이터 `product_options`
--

INSERT INTO `product_options` (`poid`, `pid`, `cate`, `option_name`, `option_cnt`, `option_price`, `image_url`, `status`) VALUES
(10, 9, '컬러', '블루', 100, 5000, '/pdata/optiondata/20230227144806774996.jpg', 1),
(11, 9, '컬러', '레드', 100, 4000, '/pdata/optiondata/20230227144806705901.jpg', 1),
(12, 12, '컬러', '블루', 100, 100, '/pdata/optiondata/20230228113658139502.jpg', 1),
(13, 13, '컬러', '블루', 100, 2000, '/pdata/optiondata/20230228114814951430.jpg', 1),
(14, 14, '컬러', '블루', 100, 1000, '/pdata/optiondata/20230228143622204398.jpg', 1),
(15, 14, '사이즈', '대', 100, 2000, '/pdata/optiondata/20230228143622204398.jpg', 1),
(16, 14, '사이즈', '중', 100, 200, '', 1),
(17, 14, '사이즈', '소', 100, 100, '', 1);

-- --------------------------------------------------------

--
-- 테이블 구조 `user_coupons`
--

CREATE TABLE `user_coupons` (
  `ucid` int NOT NULL,
  `couponid` int DEFAULT NULL COMMENT '쿠폰아이디',
  `userid` varchar(100) DEFAULT NULL COMMENT '유저아이디',
  `status` int DEFAULT '1' COMMENT '상태',
  `use_max_date` datetime DEFAULT NULL COMMENT '사용기한',
  `regdate` datetime DEFAULT NULL COMMENT '등록일',
  `reason` varchar(100) DEFAULT NULL COMMENT '쿠폰취득사유'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- 테이블의 덤프 데이터 `user_coupons`
--

INSERT INTO `user_coupons` (`ucid`, `couponid`, `userid`, `status`, `use_max_date`, `regdate`, `reason`) VALUES
(1, 1, 'hong', 1, '2023-04-01 23:59:59', '2023-03-02 11:45:33', '회원가입'),
(2, 1, 'leedo', 1, '2023-04-01 23:59:59', '2023-03-02 12:01:48', '회원가입'),
(3, 1, 'alikerock3', 1, '2023-04-05 23:59:59', '2023-03-06 16:22:19', '회원가입'),
(4, 1, 'alikerock3', 1, '2023-04-06 23:59:59', '2023-03-07 18:02:27', '회원가입'),
(5, 1, 'alikerock', 1, '2023-04-06 23:59:59', '2023-03-07 22:37:37', '회원가입'),
(6, 1, 'alikerock', 1, '2023-04-06 23:59:59', '2023-03-07 22:39:14', '회원가입'),
(7, 1, 'green', 1, '2023-04-07 23:59:59', '2023-03-08 10:45:23', '회원가입');

--
-- 덤프된 테이블의 인덱스
--

--
-- 테이블의 인덱스 `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`idx`);

--
-- 테이블의 인덱스 `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cartid`),
  ADD KEY `cart_pid_IDX` (`pid`),
  ADD KEY `cart_userid_IDX` (`userid`);

--
-- 테이블의 인덱스 `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`cid`);

--
-- 테이블의 인덱스 `coupons`
--
ALTER TABLE `coupons`
  ADD PRIMARY KEY (`cid`);

--
-- 테이블의 인덱스 `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`mid`);

--
-- 테이블의 인덱스 `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`pid`);

--
-- 테이블의 인덱스 `product_image_table`
--
ALTER TABLE `product_image_table`
  ADD PRIMARY KEY (`imgid`);

--
-- 테이블의 인덱스 `product_options`
--
ALTER TABLE `product_options`
  ADD PRIMARY KEY (`poid`),
  ADD KEY `newtable_pid_IDX` (`pid`) USING BTREE;

--
-- 테이블의 인덱스 `user_coupons`
--
ALTER TABLE `user_coupons`
  ADD PRIMARY KEY (`ucid`);

--
-- 덤프된 테이블의 AUTO_INCREMENT
--

--
-- 테이블의 AUTO_INCREMENT `admins`
--
ALTER TABLE `admins`
  MODIFY `idx` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- 테이블의 AUTO_INCREMENT `cart`
--
ALTER TABLE `cart`
  MODIFY `cartid` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- 테이블의 AUTO_INCREMENT `category`
--
ALTER TABLE `category`
  MODIFY `cid` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- 테이블의 AUTO_INCREMENT `coupons`
--
ALTER TABLE `coupons`
  MODIFY `cid` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- 테이블의 AUTO_INCREMENT `members`
--
ALTER TABLE `members`
  MODIFY `mid` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- 테이블의 AUTO_INCREMENT `products`
--
ALTER TABLE `products`
  MODIFY `pid` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- 테이블의 AUTO_INCREMENT `product_image_table`
--
ALTER TABLE `product_image_table`
  MODIFY `imgid` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=104;

--
-- 테이블의 AUTO_INCREMENT `product_options`
--
ALTER TABLE `product_options`
  MODIFY `poid` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- 테이블의 AUTO_INCREMENT `user_coupons`
--
ALTER TABLE `user_coupons`
  MODIFY `ucid` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
