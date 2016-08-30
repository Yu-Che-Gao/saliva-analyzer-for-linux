-- phpMyAdmin SQL Dump
-- version 4.5.0.2
-- http://www.phpmyadmin.net
--
-- 主機: 127.0.0.1
-- 產生時間： 2016-08-17 17:48:18
-- 伺服器版本: 10.0.17-MariaDB
-- PHP 版本： 5.5.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `saliva`
--

-- --------------------------------------------------------

--
-- 資料表結構 `customer`
--

CREATE TABLE `customer` (
  `user_no` int(11) NOT NULL COMMENT '使用者編號',
  `tel_no` varchar(15) NOT NULL COMMENT '電話號碼',
  `user_name` varchar(10) NOT NULL COMMENT '使用者名稱',
  `phone_type` varchar(20) NOT NULL COMMENT '機種',
  `country` varchar(10) NOT NULL COMMENT '國家',
  `mc_start_date` varchar(10) NOT NULL COMMENT 'mc開始日',
  `mc_interval` varchar(10) NOT NULL COMMENT 'mc天數',
  `mc_cycle` int(11) NOT NULL COMMENT 'mc週期',
  `threshold1` int(11) NOT NULL COMMENT '低閾值',
  `threshold2` int(11) NOT NULL COMMENT '高閾值'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 資料表的匯出資料 `customer`
--

INSERT INTO `customer` (`user_no`, `tel_no`, `user_name`, `phone_type`, `country`, `mc_start_date`, `mc_interval`, `mc_cycle`, `threshold1`, `threshold2`) VALUES
(8, '0983377697', '高宇哲', 'Zenfone2', '台灣', '2016-06-23', '10', 1, 100, 300),
(10, '0911128692', 'franktest', 'Sony---D6653---D6653', 'TW', '2016-7-22', '28', 1, 100, 300),
(16, '0936064527', 'How', 'OPPO---A51f---A51f', 'TW', '2016-7-14', '27', 1, 0, 0);

-- --------------------------------------------------------

--
-- 資料表結構 `image`
--

CREATE TABLE `image` (
  `image_no` int(11) NOT NULL COMMENT '影像編號',
  `image_file` varchar(30) NOT NULL,
  `image_date` varchar(10) NOT NULL COMMENT '影像存入日期',
  `image_density` double NOT NULL COMMENT '影像密度',
  `image_pattern` varchar(20) NOT NULL COMMENT '影像ferning pattern',
  `user_no` int(11) NOT NULL COMMENT '使用者編號'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 資料表的匯出資料 `image`
--

INSERT INTO `image` (`image_no`, `image_file`, `image_date`, `image_density`, `image_pattern`, `user_no`) VALUES
(83, '0936064527-2016-08-08.jpeg', '2016-08-08', 0.067348480224609, 'full fern', 16),
(84, '0936064527-2016-08-08.jpeg', '2016-08-08', 0.013519287109375, 'no fern', 16),
(85, '0936064527-2016-08-08.jpeg', '2016-08-08', 0.062633514404297, 'partial fern', 16),
(86, '0936064527-2016-08-08.jpeg', '2016-08-08', 0.094963073730469, 'full fern', 16),
(92, '0936064527-2016-08-09.jpeg', '2016-08-09', 0.015171051025391, 'no fern', 16),
(93, '0936064527-2016-08-09.jpeg', '2016-08-09', 0.096122741699219, 'full fern', 16),
(94, '0936064527-2016-08-09.jpeg', '2016-08-09', 0.050308227539062, 'no fern', 16);

--
-- 已匯出資料表的索引
--

--
-- 資料表索引 `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`user_no`);

--
-- 資料表索引 `image`
--
ALTER TABLE `image`
  ADD PRIMARY KEY (`image_no`);

--
-- 在匯出的資料表使用 AUTO_INCREMENT
--

--
-- 使用資料表 AUTO_INCREMENT `customer`
--
ALTER TABLE `customer`
  MODIFY `user_no` int(11) NOT NULL AUTO_INCREMENT COMMENT '使用者編號', AUTO_INCREMENT=17;
--
-- 使用資料表 AUTO_INCREMENT `image`
--
ALTER TABLE `image`
  MODIFY `image_no` int(11) NOT NULL AUTO_INCREMENT COMMENT '影像編號', AUTO_INCREMENT=95;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
