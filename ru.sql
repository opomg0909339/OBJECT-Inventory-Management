-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1
-- 產生時間： 2024-09-19 16:05:24
-- 伺服器版本： 10.4.32-MariaDB
-- PHP 版本： 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `ru`
--

-- --------------------------------------------------------

--
-- 資料表結構 `commodity`
--

CREATE TABLE `commodity` (
  `ID` int(11) NOT NULL,
  `ITEMNUMBER` varchar(20) NOT NULL,
  `NUMBER` varchar(10) NOT NULL,
  `STYLE` varchar(5) NOT NULL,
  `SIZE` int(5) NOT NULL,
  `QUANTITY` int(10) NOT NULL,
  `REMARK` varchar(20) NOT NULL,
  `PRICE` int(10) NOT NULL,
  `COST` int(10) NOT NULL,
  `MATERIAL` varchar(20) NOT NULL,
  `UNIT` varchar(10) NOT NULL,
  `TITLE` varchar(50) NOT NULL,
  `BRAND` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 傾印資料表的資料 `commodity`
--

INSERT INTO `commodity` (`ID`, `ITEMNUMBER`, `NUMBER`, `STYLE`, `SIZE`, `QUANTITY`, `REMARK`, `PRICE`, `COST`, `MATERIAL`, `UNIT`, `TITLE`, `BRAND`) VALUES
(3, '418-B-10', '418', 'B', 10, 50, '2024-05-10', 360, 173, 'C', '盒/3入', '美樂蒂女童印花內褲', 'AL'),
(4, '418-B-4', '418', 'B', 4, 10, '2024-05-10', 360, 360, 'C', '盒/3入', '美樂蒂女童印花內褲', 'AL'),
(5, '418-A-4', '418', 'A', 4, 10, '2024-05-10', 360, 173, 'C', '盒/3入', '美樂蒂女童印花內褲', 'AL'),
(6, '418-A-6', '418', 'A', 6, 150, '2024-05-10', 360, 173, 'C', '盒/3入', '美樂蒂女童印花內褲', 'AL'),
(7, '418-A-8', '418', 'A', 8, 20, '2024-05-10', 360, 173, 'C', '盒/3入', '美樂蒂女童印花內褲', 'AL'),
(8, '418-A-10', '418', 'A', 10, 355, '2024-05-10', 360, 173, 'C', '盒/3入', '美樂蒂女童印花內褲', 'AL'),
(9, '418-A-12', '418', 'A', 12, 210, '2024-05-10', 360, 173, 'C', '盒/3入', '美樂蒂女童印花內褲', 'AL'),
(10, '418-A-14', '418', 'A', 14, 20, '2024-05-10', 360, 173, 'C', '盒/3入', '美樂蒂女童印花內褲', 'AL'),
(11, '418-A-16', '418', 'A', 16, 20, '2024-05-10', 360, 173, 'C', '盒/3入', '美樂蒂女童印花內褲', 'AL'),
(12, '932620-02-4', '932620', '02', 4, -10, '2024-05-10', 450, 217, 'F', '盒/2入', '蜘蛛人竹纖平口褲', 'AL'),
(13, '932620-02-6', '932620', '02', 6, 10, '2024-05-10', 450, 217, 'F', '盒/2入', '蜘蛛人竹纖平口褲', 'AL'),
(14, '932620-02-8', '932620', '02', 8, 10, '2024-05-10', 450, 217, 'F', '盒/2入', '蜘蛛人竹纖平口褲', 'AL'),
(15, '932620-02-10', '932620', '02', 10, 10, '2024-05-10', 450, 217, 'F', '盒/2入', '蜘蛛人竹纖平口褲', 'AL'),
(16, '932620-02-12', '932620', '02', 12, -20, '2024-05-10', 450, 217, 'F', '盒/2入', '蜘蛛人竹纖平口褲', 'AL'),
(17, '932620-02-14', '932620', '02', 14, 10, '2024-05-10', 450, 217, 'F', '盒/2入', '蜘蛛人竹纖平口褲', 'AL'),
(18, '932620-02-16', '932620', '02', 16, 380, '2024-05-10', 450, 217, 'F', '盒/2入', '蜘蛛人竹纖平口褲', 'AL'),
(19, 'M911003-58-120', 'M911003', '58', 120, 50, '2024-05-14', 490, 220, '聚脂纖維', '件', 'BTIS黑標.男童30S彩色LOGO印花運動棉TEE.牌價980', 'BATIS'),
(20, 'M911003-58-130', 'M911003', '58', 130, 50, '2024-05-14', 490, 220, '聚脂纖維', '件', 'BTIS黑標.男童30S彩色LOGO印花運動棉TEE.牌價980', 'AL'),
(21, 'A99522-10-0', 'A99522', '10', 0, 50, '2024-05-14', 60, 25, '紗布羅紋', '件', '小木馬紗布羅紋手套', 'BENNY');

-- --------------------------------------------------------

--
-- 資料表結構 `customer`
--

CREATE TABLE `customer` (
  `ID` int(10) NOT NULL,
  `AREACODE` varchar(3) NOT NULL,
  `SHOPNAME` varchar(15) NOT NULL,
  `SHOPNUM` varchar(15) NOT NULL,
  `ADDRESS` varchar(50) NOT NULL,
  `PHONE` varchar(15) NOT NULL,
  `CONTACT` varchar(5) NOT NULL,
  `INFORMATION` varchar(30) NOT NULL,
  `AL-NOR` float NOT NULL,
  `BENNY-NOR-E` float NOT NULL,
  `BENNY-NOR-P` float NOT NULL,
  `BENNY-CUT` float NOT NULL,
  `KING-P` float NOT NULL,
  `BIGKIN-NOR` float NOT NULL,
  `SMALLKIN-NOR` float NOT NULL,
  `SMALLKIN-CUT` float NOT NULL,
  `MG-NOR` float NOT NULL,
  `BATIS-NOR` float NOT NULL,
  `BATIS-RED` float NOT NULL,
  `BATIS-CUT` float NOT NULL,
  `BR-NOR` float NOT NULL,
  `BR-CUT` float NOT NULL,
  `MYDNA-NOR` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 傾印資料表的資料 `customer`
--

INSERT INTO `customer` (`ID`, `AREACODE`, `SHOPNAME`, `SHOPNUM`, `ADDRESS`, `PHONE`, `CONTACT`, `INFORMATION`, `AL-NOR`, `BENNY-NOR-E`, `BENNY-NOR-P`, `BENNY-CUT`, `KING-P`, `BIGKIN-NOR`, `SMALLKIN-NOR`, `SMALLKIN-CUT`, `MG-NOR`, `BATIS-NOR`, `BATIS-RED`, `BATIS-CUT`, `BR-NOR`, `BR-CUT`, `MYDNA-NOR`) VALUES
(2, 'T5', '淘氣兄妹', 'DWFVA', '台南市永康區中正南路750號', '062546667', '邱資雲', '', 0.65, 0.55, 0.6, 0.35, 0, 0.5, 0.4, 0.4, 0.4, 0.65, 0, 0.5, 0, 0, 0),
(13, 'C1', '勝輝內衣行', 'AGC-2', '彰化市光復路143巷6號', '047231233', '張勝輝', '', 0.58, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- 資料表結構 `history`
--

CREATE TABLE `history` (
  `ID` int(11) NOT NULL,
  `NUMBER` int(20) NOT NULL,
  `STYLE` varchar(3) NOT NULL,
  `2` int(3) NOT NULL DEFAULT 0,
  `4` int(3) NOT NULL DEFAULT 0,
  `6` int(3) NOT NULL DEFAULT 0,
  `8` int(3) NOT NULL DEFAULT 0,
  `10` int(3) NOT NULL DEFAULT 0,
  `12` int(3) NOT NULL DEFAULT 0,
  `14` int(3) NOT NULL DEFAULT 0,
  `16` int(3) NOT NULL DEFAULT 0,
  `18` int(3) NOT NULL DEFAULT 0,
  `TIME` varchar(20) NOT NULL,
  `TYPE` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 傾印資料表的資料 `history`
--

INSERT INTO `history` (`ID`, `NUMBER`, `STYLE`, `2`, `4`, `6`, `8`, `10`, `12`, `14`, `16`, `18`, `TIME`, `TYPE`) VALUES
(465, 418, 'A', 0, 0, 0, 0, -10, 0, 0, 0, 0, '2024-06-04', '220240604005'),
(466, 932620, '02', 0, 0, 0, 0, 0, 0, 0, -10, 0, '2024-06-04', '220240604005'),
(533, 418, 'A', 0, 0, 0, 0, -10, 0, 0, 0, 0, '2024-06-04', '220240604002'),
(534, 932620, '02', 0, 0, 0, 0, 0, 0, 0, -10, 0, '2024-06-04', '220240604002'),
(544, 418, 'A', 0, 0, 0, 0, 10, 0, 0, 0, 0, '2024-06-04', '220240604003'),
(581, 418, 'A', 0, 0, 0, 0, 10, 0, 0, 0, 0, '2024-06-04', '120240604002'),
(582, 932620, '02', 0, 0, 0, 0, 0, 0, 0, 20, 0, '2024-06-04', '120240604002'),
(583, 418, 'A', 0, 0, 0, 0, 0, 20, 0, 0, 0, '2024-06-04', '120240604002'),
(584, 418, 'A', 0, 0, 0, 0, 0, -10, 0, 0, 0, '2024-06-04', '220240604006'),
(585, 932620, '02', 0, 0, 0, 0, 0, 0, 0, -10, 0, '2024-06-04', '220240604006'),
(586, 418, 'A', 0, 0, 0, 0, -100, 0, 0, 0, 0, '2024-06-04', '220240604006'),
(593, 418, 'A', 0, 0, 0, 0, -20, 0, 0, 0, 0, '2024-06-18', '220240604007'),
(594, 418, 'A', 0, -20, 0, 0, 0, 0, 0, 0, 0, '2024-06-18', '220240604007');

-- --------------------------------------------------------

--
-- 資料表結構 `manufacturer`
--

CREATE TABLE `manufacturer` (
  `ID` int(11) NOT NULL,
  `MANUFACTNUM` varchar(15) NOT NULL,
  `MANUFACTNAME` varchar(20) NOT NULL,
  `ADDRESS` varchar(50) NOT NULL,
  `PHONE` varchar(10) NOT NULL,
  `CONTACT` varchar(10) NOT NULL,
  `INFORMATION` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 傾印資料表的資料 `manufacturer`
--

INSERT INTO `manufacturer` (`ID`, `MANUFACTNUM`, `MANUFACTNAME`, `ADDRESS`, `PHONE`, `CONTACT`, `INFORMATION`) VALUES
(1, 'V2', '大翔服裝有限公司', '高雄市鳳山區文樂街62號', '0932782099', '李海勝', 'BENNY');

-- --------------------------------------------------------

--
-- 資料表結構 `order`
--

CREATE TABLE `order` (
  `ID` int(15) NOT NULL,
  `OD` varchar(20) NOT NULL,
  `SHOPNUM` varchar(10) NOT NULL,
  `ADDRESS` varchar(20) NOT NULL,
  `DATE` varchar(10) NOT NULL,
  `PHONE` varchar(12) NOT NULL,
  `COMMODITY` mediumtext NOT NULL,
  `QUANTITY` int(4) NOT NULL,
  `PRICE` int(10) NOT NULL,
  `CONFIRM` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 傾印資料表的資料 `order`
--

INSERT INTO `order` (`ID`, `OD`, `SHOPNUM`, `ADDRESS`, `DATE`, `PHONE`, `COMMODITY`, `QUANTITY`, `PRICE`, `CONFIRM`) VALUES
(77, '20240604001', 'DWFVA', '台南市永康區中正南路750號', '20240604', '062546667', '418-A-10 美樂蒂女童印花內褲 10 盒/3 360 0.65 2340 一般 + 418-A-6 美樂蒂女童印花內褲 10 盒/3 360 0.65 2340 一般 + 932620-02-4 蜘蛛人竹纖平口褲 10 盒/2 450 0.65 2925 一般 + ', 30, 7605, 1),
(78, '20240604002', 'DWFVA', '台南市永康區中正南路750號', '20240604', '062546667', '', 0, 0, 0),
(79, '220240604001', 'DWFVA', '台南市永康區中正南路750號', '20240604', '062546667', '418-A-10 美樂蒂女童印花內褲 10 盒/3 360 0.65 2340 一般 + 932620-02-16 蜘蛛人竹纖平口褲 10 盒/2 450 0.65 2925 一般 + ', 20, 5265, 0),
(80, '220240604002', 'DWFVA', '台南市永康區中正南路750號', '20240604', '062546667', '418-A-10 美樂蒂女童印花內褲 10 盒/3 360 0.65 2340 一般 + 932620-02-16 蜘蛛人竹纖平口褲 10 盒/2 450 0.65 2925 一般 + ', 20, 5265, 0),
(81, '220240604003', 'DWFVA', '台南市永康區中正南路750號', '20240604', '062546667', '418-A-10 美樂蒂女童印花內褲 10 盒/3 360 0.65 2340 一般 + 932620-02-16 蜘蛛人竹纖平口褲 10 盒/2 450 0.65 2925 一般 + ', 20, 5265, 0),
(82, '220240604004', 'DWFVA', '台南市永康區中正南路750號', '20240604', '062546667', '418-A-10 美樂蒂女童印花內褲 10 盒/3 360 0.65 2340 一般 + ', 10, 2340, 1),
(83, '220240604005', 'DWFVA', '台南市永康區中正南路750號', '20240604', '062546667', '418-A-10 美樂蒂女童印花內褲 10 盒/3 360 0.65 2340 一般 + 932620-02-16 蜘蛛人竹纖平口褲 10 盒/2 450 0.65 2925 一般 + ', 20, 5265, 1),
(84, '220240604006', 'DWFVA', '台南市永康區中正南路750號', '20240604', '062546667', '418-A-12 美樂蒂女童印花內褲 10 盒/3 360 0.65 2340 一般 + 932620-02-16 蜘蛛人竹纖平口褲 10 盒/2 450 0.65 2925 一般 + 418-A-10 美樂蒂女童印花內褲 100 盒/3 360 0.65 23400 一般 + ', 120, 28665, 1),
(85, '220240604007', 'DWFVA', '台南市永康區中正南路750號', '20240604', '062546667', '418-A-10 美樂蒂女童印花內褲 20 盒/3 360 0.65 4680 一般 + 418-A-4 美樂蒂女童印花內褲 20 盒/3 360 0.65 4680 一般 + ', 40, 9360, 1);

-- --------------------------------------------------------

--
-- 資料表結構 `order-com`
--

CREATE TABLE `order-com` (
  `ID` int(10) NOT NULL,
  `NUMBER` varchar(30) NOT NULL,
  `NAME` varchar(10) NOT NULL,
  `QUANTITY` int(5) NOT NULL,
  `UNIT` varchar(3) NOT NULL,
  `PRICE` int(20) NOT NULL,
  `DISCOUNT` float NOT NULL,
  `AMOUNT` int(20) NOT NULL,
  `INFORMATION` varchar(20) NOT NULL,
  `ORDERNUM` varchar(20) NOT NULL,
  `CODE` int(5) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 傾印資料表的資料 `order-com`
--

INSERT INTO `order-com` (`ID`, `NUMBER`, `NAME`, `QUANTITY`, `UNIT`, `PRICE`, `DISCOUNT`, `AMOUNT`, `INFORMATION`, `ORDERNUM`, `CODE`) VALUES
(130, '418-A-10', '美樂蒂女童印花內褲', 10, '盒/3', 360, 0.65, 2340, '一般', '20240604001', 1),
(131, '418-A-6', '美樂蒂女童印花內褲', 10, '盒/3', 360, 0.65, 2340, '一般', '20240604001', 2),
(132, '932620-02-4', '蜘蛛人竹纖平口褲', 10, '盒/2', 450, 0.65, 2925, '一般', '20240604001', 3),
(133, '418-A-10', '美樂蒂女童印花內褲', 10, '盒/3', 360, 0.65, 2340, '一般', '220240604001', 1),
(134, '932620-02-16', '蜘蛛人竹纖平口褲', 10, '盒/2', 450, 0.65, 2925, '一般', '220240604001', 2),
(135, '418-A-10', '美樂蒂女童印花內褲', 10, '盒/3', 360, 0.65, 2340, '一般', '220240604002', 1),
(137, '418-A-10', '美樂蒂女童印花內褲', 10, '盒/3', 360, 0.65, 2340, '一般', '220240604003', 1),
(138, '932620-02-16', '蜘蛛人竹纖平口褲', 10, '盒/2', 450, 0.65, 2925, '一般', '220240604003', 2),
(139, '418-A-10', '美樂蒂女童印花內褲', 10, '盒/3', 360, 0.65, 2340, '一般', '220240604004', 1),
(140, '418-A-10', '美樂蒂女童印花內褲', 10, '盒/3', 360, 0.65, 2340, '一般', '220240604005', 1),
(141, '932620-02-16', '蜘蛛人竹纖平口褲', 10, '盒/2', 450, 0.65, 2925, '一般', '220240604005', 2),
(146, '418-A-12', '美樂蒂女童印花內褲', 10, '盒/3', 360, 0.65, 2340, '一般', '220240604006', 3),
(147, '932620-02-16', '蜘蛛人竹纖平口褲', 10, '盒/2', 450, 0.65, 2925, '一般', '220240604002', 2),
(148, '932620-02-16', '蜘蛛人竹纖平口褲', 10, '盒/2', 450, 0.65, 2925, '一般', '220240604006', 4),
(149, '418-A-10', '美樂蒂女童印花內褲', 100, '盒/3', 360, 0.65, 23400, '一般', '220240604006', 5),
(150, 'A99522-10-0', '小木馬紗布羅紋手套', 10, '件', 60, 0.65, 390, '一般', '120240607001', 1),
(151, '418-A-10', '美樂蒂女童印花內褲', 20, '盒/3', 360, 0.65, 4680, '一般', '220240604007', 1),
(152, '418-A-4', '美樂蒂女童印花內褲', 20, '盒/3', 360, 0.65, 4680, '一般', '220240604007', 2);

-- --------------------------------------------------------

--
-- 資料表結構 `purchase`
--

CREATE TABLE `purchase` (
  `ID` int(15) NOT NULL,
  `OD` varchar(20) NOT NULL,
  `MANUFACTNAME` varchar(30) NOT NULL,
  `MANUFACTNUM` varchar(10) NOT NULL,
  `ADDRESS` varchar(20) NOT NULL,
  `DATE` varchar(10) NOT NULL,
  `PHONE` varchar(15) NOT NULL,
  `COMMODITY` mediumtext NOT NULL,
  `QUANTITY` int(4) NOT NULL,
  `PRICE` int(10) NOT NULL,
  `CONFIRM` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 傾印資料表的資料 `purchase`
--

INSERT INTO `purchase` (`ID`, `OD`, `MANUFACTNAME`, `MANUFACTNUM`, `ADDRESS`, `DATE`, `PHONE`, `COMMODITY`, `QUANTITY`, `PRICE`, `CONFIRM`) VALUES
(17, '120240604001', '大翔服裝有限公司', 'V2', '高雄市鳳山區文樂街62號', '20240604', '0932782099', '932620-02-16 蜘蛛人竹纖平口褲 10 盒/2 217 2170 一般 + 418-A-10 美樂蒂女童印花內褲 20 盒/3 173 3460 一般 + ', 30, 5630, 1),
(18, '120240604002', '大翔服裝有限公司', 'V2', '高雄市鳳山區文樂街62號', '20240604', '0932782099', '418-A-10 美樂蒂女童印花內褲 10 盒/3 173 1730 一般 + 932620-02-16 蜘蛛人竹纖平口褲 20 盒/2 217 4340 一般 + 418-A-12 美樂蒂女童印花內褲 20 盒/3 173 3460 一般 + ', 50, 9530, 1),
(19, '120240607001', '大翔服裝有限公司', 'V2', '高雄市鳳山區文樂街62號', '20240607', '0932782099', 'A99522-10-0 小木馬紗布羅紋手套 10 件 25 250 一般 + ', 10, 250, 1),
(20, '320240607001', '大翔服裝有限公司', 'V2', '高雄市鳳山區文樂街62號', '20240607', '0932782099', '', 0, 0, 0),
(21, '320240607002', '大翔服裝有限公司', 'V2', '高雄市鳳山區文樂街62號', '20240607', '0932782099', 'A99522-10-0 小木馬紗布羅紋手套 10 件 25 250 一般 + ', 10, 250, 1),
(22, '320240607003', '大翔服裝有限公司', 'V2', '高雄市鳳山區文樂街62號', '20240607', '0932782099', '', 0, 0, 0),
(23, '320240607004', '大翔服裝有限公司', 'V2', '高雄市鳳山區文樂街62號', '20240607', '0932782099', '', 0, 0, 0),
(24, '320240607005', '大翔服裝有限公司', 'V2', '高雄市鳳山區文樂街62號', '20240607', '0932782099', 'A99522-10-0 小木馬紗布羅紋手套 10 件 25 250 退貨 + ', 10, 250, 1);

-- --------------------------------------------------------

--
-- 資料表結構 `purchase-com`
--

CREATE TABLE `purchase-com` (
  `ID` int(10) NOT NULL,
  `NUMBER` varchar(30) NOT NULL,
  `NAME` varchar(10) NOT NULL,
  `QUANTITY` int(5) NOT NULL,
  `UNIT` varchar(3) NOT NULL,
  `COST` int(10) NOT NULL,
  `AMOUNT` int(20) NOT NULL,
  `INFORMATION` varchar(20) NOT NULL,
  `ORDERNUM` varchar(20) NOT NULL,
  `CODE` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 傾印資料表的資料 `purchase-com`
--

INSERT INTO `purchase-com` (`ID`, `NUMBER`, `NAME`, `QUANTITY`, `UNIT`, `COST`, `AMOUNT`, `INFORMATION`, `ORDERNUM`, `CODE`) VALUES
(42, '932620-02-16', '蜘蛛人竹纖平口褲', 10, '盒/2', 217, 2170, '一般', '120240604001', 2),
(43, '418-A-10', '美樂蒂女童印花內褲', 20, '盒/3', 173, 3460, '一般', '120240604001', 3),
(44, '418-A-10', '美樂蒂女童印花內褲', 10, '盒/3', 173, 1730, '一般', '120240604002', 1),
(45, '932620-02-16', '蜘蛛人竹纖平口褲', 20, '盒/2', 217, 4340, '一般', '120240604002', 2),
(46, '418-A-12', '美樂蒂女童印花內褲', 20, '盒/3', 173, 3460, '一般', '120240604002', 3),
(47, 'A99522-10-0', '小木馬紗布羅紋手套', 10, '件', 25, 250, '一般', '120240607001', 1),
(49, 'A99522-10-0', '小木馬紗布羅紋手套', 10, '件', 25, 250, '一般', '320240607002', 1),
(50, 'A99522-10-0', '小木馬紗布羅紋手套', 10, '件', 25, 250, '退貨', '320240607005', 1);

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `commodity`
--
ALTER TABLE `commodity`
  ADD PRIMARY KEY (`ID`);

--
-- 資料表索引 `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`ID`);

--
-- 資料表索引 `history`
--
ALTER TABLE `history`
  ADD PRIMARY KEY (`ID`);

--
-- 資料表索引 `manufacturer`
--
ALTER TABLE `manufacturer`
  ADD PRIMARY KEY (`ID`);

--
-- 資料表索引 `order`
--
ALTER TABLE `order`
  ADD UNIQUE KEY `ID` (`ID`);

--
-- 資料表索引 `order-com`
--
ALTER TABLE `order-com`
  ADD PRIMARY KEY (`ID`);

--
-- 資料表索引 `purchase`
--
ALTER TABLE `purchase`
  ADD PRIMARY KEY (`ID`);

--
-- 資料表索引 `purchase-com`
--
ALTER TABLE `purchase-com`
  ADD PRIMARY KEY (`ID`);

--
-- 在傾印的資料表使用自動遞增(AUTO_INCREMENT)
--

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `commodity`
--
ALTER TABLE `commodity`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `customer`
--
ALTER TABLE `customer`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `history`
--
ALTER TABLE `history`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=595;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `manufacturer`
--
ALTER TABLE `manufacturer`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `order`
--
ALTER TABLE `order`
  MODIFY `ID` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `order-com`
--
ALTER TABLE `order-com`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=153;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `purchase`
--
ALTER TABLE `purchase`
  MODIFY `ID` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `purchase-com`
--
ALTER TABLE `purchase-com`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
