-- phpMyAdmin SQL Dump
-- version phpStudy 2014
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2017 年 04 月 20 日 10:39
-- 服务器版本: 5.5.53
-- PHP 版本: 5.4.45

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `jyt`
--

-- --------------------------------------------------------

--
-- 表的结构 `activitys`
--

CREATE TABLE IF NOT EXISTS `activitys` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ActivityId` varchar(255) DEFAULT NULL,
  `Image` varchar(255) DEFAULT NULL,
  `Url` varchar(255) DEFAULT NULL,
  `CreatTime` datetime DEFAULT NULL,
  `Commercial` varchar(255) DEFAULT NULL,
  `orderid` int(5) NOT NULL COMMENT '排列顺序',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=gb2312 AUTO_INCREMENT=13 ;

--
-- 转存表中的数据 `activitys`
--

INSERT INTO `activitys` (`id`, `ActivityId`, `Image`, `Url`, `CreatTime`, `Commercial`, `orderid`) VALUES
(9, '7b4a386b-0195-4580-8ad6-241397425e99', 'UpLoad/b42beb7e-5b5d-4635-9502-e398a9f9bed3.jpg', 'http://www.baidu.com', '2015-09-06 13:59:38', 'admin', 0),
(11, 'b9e68256-24b4-47e1-b70a-e8015104090e', 'UpLoad/1e5f2c67-6a1e-4fd2-a418-20dfa0ad88aa.jpg', 'http://www.baidu.com', '2015-09-06 14:00:20', 'admin', 0),
(12, 'BJXeupACykwq2FG3o35B', 'uploads/image/20170417/1492406845.jpg', 'http://www.baidu.com', '2017-04-17 10:56:18', NULL, 1);

-- --------------------------------------------------------

--
-- 表的结构 `adminuser`
--

CREATE TABLE IF NOT EXISTS `adminuser` (
  `Id` varchar(100) NOT NULL,
  `Number` varchar(100) DEFAULT NULL,
  `Password` varchar(500) DEFAULT NULL,
  `Module` varchar(1000) DEFAULT NULL,
  `CreatTime` datetime DEFAULT NULL,
  `StandbyOne` varchar(500) DEFAULT NULL,
  `StandbyTwo` varchar(500) DEFAULT NULL,
  `StandbyThree` varchar(500) DEFAULT NULL,
  `StandbyFore` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=gb2312;

--
-- 转存表中的数据 `adminuser`
--

INSERT INTO `adminuser` (`Id`, `Number`, `Password`, `Module`, `CreatTime`, `StandbyOne`, `StandbyTwo`, `StandbyThree`, `StandbyFore`) VALUES
('123', 'admin', 'admin', NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- 表的结构 `appversion`
--

CREATE TABLE IF NOT EXISTS `appversion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `iosVersion` varchar(100) DEFAULT NULL,
  `iosPath` varchar(100) DEFAULT NULL,
  `androidVersion` varchar(100) DEFAULT NULL,
  `androidPath` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=gb2312 AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `appversion`
--

INSERT INTO `appversion` (`id`, `iosVersion`, `iosPath`, `androidVersion`, `androidPath`) VALUES
(1, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- 表的结构 `banknochangeflag`
--

CREATE TABLE IF NOT EXISTS `banknochangeflag` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Commercial` varchar(255) DEFAULT NULL,
  `State` varchar(255) DEFAULT NULL,
  `ChangeTime` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=gb2312 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `browsing`
--

CREATE TABLE IF NOT EXISTS `browsing` (
  `Id` varchar(100) NOT NULL DEFAULT '',
  `CommodityId` varchar(100) DEFAULT NULL,
  `UserId` varchar(100) DEFAULT NULL,
  `CreatTime` datetime DEFAULT NULL,
  `StandbyOne` varchar(500) DEFAULT NULL,
  `StandbyTwo` varchar(500) DEFAULT NULL,
  `StandbyThree` varchar(500) DEFAULT NULL,
  `StandbyFore` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=gb2312;

--
-- 转存表中的数据 `browsing`
--

INSERT INTO `browsing` (`Id`, `CommodityId`, `UserId`, `CreatTime`, `StandbyOne`, `StandbyTwo`, `StandbyThree`, `StandbyFore`) VALUES
('2079c7e8-e6bd-4f5b-baf3-ff0cc7a57f06', '437fc53e-89fb-4036-9e0a-52d73102e47b', 'a5730119-a3f7-422a-8214-ff666da29ccd', '2015-08-11 15:24:37', NULL, NULL, NULL, NULL),
('3ef79607-fc65-46ae-94b1-248c63935902', '437fc53e-89fb-4036-9e0a-52d73102e47b', 'a5730119-a3f7-422a-8214-ff666da29ccd', '2015-08-11 16:10:21', NULL, NULL, NULL, NULL),
('4eae727c-f6a5-4e26-a787-7e696978c5c4', '437fc53e-89fb-4036-9e0a-52d73102e47b', 'a5730119-a3f7-422a-8214-ff666da29ccd', '2015-08-11 16:19:41', NULL, NULL, NULL, NULL),
('4effcf7c-235c-4f2b-bd92-b3118b9c9eb5', '437fc53e-89fb-4036-9e0a-52d73102e47b', 'a5730119-a3f7-422a-8214-ff666da29ccd', '2015-08-11 16:00:47', NULL, NULL, NULL, NULL),
('85835fa1-7f21-4b4e-b4f1-b5db1883d60e', '437fc53e-89fb-4036-9e0a-52d73102e47b', 'a5730119-a3f7-422a-8214-ff666da29ccd', '2015-08-11 15:36:38', NULL, NULL, NULL, NULL),
('a043bd07-9f1f-4e7a-918f-9e521fd88a66', '6c55cecb-0795-4044-95a4-c1fce8370265', NULL, '2015-12-10 14:22:48', NULL, NULL, NULL, NULL),
('ba0bee17-1159-4305-8757-54ebc39bbf19', '437fc53e-89fb-4036-9e0a-52d73102e47b', 'a5730119-a3f7-422a-8214-ff666da29ccd', '2015-08-11 15:17:19', NULL, NULL, NULL, NULL),
('c7cae440-02fe-4c95-b881-42d72933d676', NULL, NULL, '2015-12-10 14:21:49', NULL, NULL, NULL, NULL),
('d96ad911-7467-4d7b-bd14-894248d91524', '437fc53e-89fb-4036-9e0a-52d73102e47b', 'a5730119-a3f7-422a-8214-ff666da29ccd', '2015-08-11 16:12:49', NULL, NULL, NULL, NULL),
('f6639e19-6058-4e7c-a74a-58cb36b54fc1', '437fc53e-89fb-4036-9e0a-52d73102e47b', 'a5730119-a3f7-422a-8214-ff666da29ccd', '2015-08-11 16:25:33', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- 表的结构 `collect`
--

CREATE TABLE IF NOT EXISTS `collect` (
  `Id` varchar(100) NOT NULL DEFAULT '',
  `CommodityId` varchar(100) DEFAULT NULL,
  `UserId` varchar(100) DEFAULT NULL,
  `CreatTime` datetime DEFAULT NULL,
  `StandbyOne` varchar(500) DEFAULT NULL,
  `StandbyTwo` varchar(500) DEFAULT NULL,
  `StandbyThree` varchar(500) DEFAULT NULL,
  `StandbyFore` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=gb2312;

--
-- 转存表中的数据 `collect`
--

INSERT INTO `collect` (`Id`, `CommodityId`, `UserId`, `CreatTime`, `StandbyOne`, `StandbyTwo`, `StandbyThree`, `StandbyFore`) VALUES
('1873401d-c3ca-4171-945f-b918961b69a6', '883c83e0-4768-4fcf-83c2-84b0c316f9b9', '15902736382', '2015-12-10 14:09:26', NULL, NULL, NULL, NULL),
('29e6ceba-dfbb-44fb-af8f-1897c9b992fb', '851b35b3-84cd-490d-a3c4-d581e09a4f35', '(null)', '2015-12-09 14:13:26', NULL, NULL, NULL, NULL),
('36aea600-76bb-4ec0-add2-b29f9771799c', 'bf1f8ad5-1120-4b84-acfb-69fef0accef8', '15912345678', '2015-08-12 14:37:35', NULL, NULL, NULL, NULL),
('3809e303-d696-4404-abc6-cb3c1eda2870', '159052c4-1271-4d95-a30c-4183d712c678', '100000', '2015-08-28 17:30:11', NULL, NULL, NULL, NULL),
('3f98910b-524e-4678-8f77-ee101b259fae', '8e06c093-b457-4cd2-a6ec-091d9405d88f', '5724c1c7-eec8-4c55-955c-58ba0b83a0ab', '2015-10-28 10:16:30', NULL, NULL, NULL, NULL),
('40c44ffc-32c8-4530-ba2b-c871e2af06b9', '8e06c093-b457-4cd2-a6ec-091d9405d88f', '823a1f7f-c7fe-4b47-9767-7b2800b5ea43', '2015-11-11 21:34:43', NULL, NULL, NULL, NULL),
('451b0a19-3d39-44e9-808c-196eef64c089', '8e06c093-b457-4cd2-a6ec-091d9405d88f', 'c5ed4568-39dc-4d7b-8d41-fab9f4b19c1b', '2015-11-09 10:38:56', NULL, NULL, NULL, NULL),
('4ba7a5e1-e2bc-4acf-8dd1-c114f9b332d2', '8e06c093-b457-4cd2-a6ec-091d9405d88f', '128b5458-4e88-43e0-9528-b4c63adb40e2', '2015-12-07 13:15:54', NULL, NULL, NULL, NULL),
('5559d36f-e85e-4e77-9749-4bffef325bd8', '159052c4-1271-4d95-a30c-4183d712c678', '90bd24b7-1597-495f-ae7c-43f1dc22f553', '2015-08-27 16:38:02', NULL, NULL, NULL, NULL),
('5febb6fb-5be0-4e03-bd3f-86d41f01f6ae', '8e06c093-b457-4cd2-a6ec-091d9405d88f', 'c5ed4568-39dc-4d7b-8d41-fab9f4b19c1b', '2015-11-12 09:41:28', NULL, NULL, NULL, NULL),
('6a910109-a078-4610-a582-bae43feb7a64', '8e06c093-b457-4cd2-a6ec-091d9405d88f', 'c5ed4568-39dc-4d7b-8d41-fab9f4b19c1b', '2015-11-09 10:38:58', NULL, NULL, NULL, NULL),
('6c21834a-bc84-4818-9117-953ea77c7b23', '8e06c093-b457-4cd2-a6ec-091d9405d88f', '037cab80-eaf3-4464-ba64-b63b3f8ce913', '2015-11-05 16:04:54', NULL, NULL, NULL, NULL),
('6d956d7c-4a50-48c2-9e9d-4da5e0cfc734', 'b8fd47f1-2f93-43ed-bd10-d23faa81fe50', '5abc4eb6-2f52-4726-a328-3f352e340676', '2015-11-20 10:37:39', NULL, NULL, NULL, NULL),
('6e7d31a8-02b9-42c0-baea-34cd15f7e493', '8e06c093-b457-4cd2-a6ec-091d9405d88f', 'c5ed4568-39dc-4d7b-8d41-fab9f4b19c1b', '2015-11-12 09:41:26', NULL, NULL, NULL, NULL),
('70c4e085-9584-4e0a-9140-56b7163a1cb7', '437fc53e-89fb-4036-9e0a-52d73102e47b', '100000', '2015-08-23 12:43:35', NULL, NULL, NULL, NULL),
('75973b68-1abc-4bfe-b855-723efdc3003b', '7253ef6f-3df4-4ecd-a910-989f7244a071', '5724c1c7-eec8-4c55-955c-58ba0b83a0ab', '2015-09-06 17:08:01', NULL, NULL, NULL, NULL),
('7958ae48-2512-4467-90c6-980181b7c6bc', '437fc53e-89fb-4036-9e0a-52d73102e47b', '15912345678', '2015-08-12 14:37:22', NULL, NULL, NULL, NULL),
('7c211a45-5e92-47db-a776-3ee053c0a19a', 'dd3482d7-a5cf-4d0a-86e2-3dcda1d4e52b', '13797067530', '2015-12-20 14:19:21', NULL, NULL, NULL, NULL),
('7c69e2e1-e0c6-4407-99c1-e723a5e31e2f', '159052c4-1271-4d95-a30c-4183d712c678', '128b5458-4e88-43e0-9528-b4c63adb40e2', '2015-11-02 16:02:13', NULL, NULL, NULL, NULL),
('803a17dd-0735-4356-b21d-68895132d9cf', 'dd3482d7-a5cf-4d0a-86e2-3dcda1d4e52b', 'bcf9a7a8-5e6f-4a89-9992-39e047bf41f4', '2017-04-12 09:17:18', NULL, NULL, NULL, NULL),
('84b2c794-9490-4dff-a858-329dfe89f3ea', '437fc53e-89fb-4036-9e0a-52d73102e47b', 'a5730119-a3f7-422a-8214-ff666da29ccd', '2015-07-28 10:52:31', NULL, NULL, NULL, NULL),
('8ce04084-e716-4136-adc5-b8d10e80d77c', 'e9b09e38-d110-4e13-be03-fd80c744e4f9', '90bd24b7-1597-495f-ae7c-43f1dc22f553', '2015-08-27 16:36:09', NULL, NULL, NULL, NULL),
('8efbfa84-0e09-433b-9409-b26c5b329567', '851b35b3-84cd-490d-a3c4-d581e09a4f35', '823a1f7f-c7fe-4b47-9767-7b2800b5ea43', '2015-12-09 11:48:54', NULL, NULL, NULL, NULL),
('9106cdb5-0d18-45a1-ba0a-ea51d014afba', '437fc53e-89fb-4036-9e0a-52d73102e47b', '03d56612-d159-4e5d-9ee1-f419b818f3a8', '2015-08-19 22:07:49', NULL, NULL, NULL, NULL),
('94bea13d-30c3-4cb7-9aa5-e937b33d890d', '01a15fbc-fec2-42ee-9eed-d749cfe1c0d2', '100000', '2015-08-27 14:42:19', NULL, NULL, NULL, NULL),
('a30f2e15-0af4-41a2-b263-a8a6caab7c68', 'c7f9d350-d830-4231-867c-2f2baa928e99', '5abc4eb6-2f52-4726-a328-3f352e340676', '2015-11-23 11:40:48', NULL, NULL, NULL, NULL),
('a4d7f76a-e109-42cf-8040-58d460afde3c', '51033380-74ba-4c4a-bb9e-0a61f2e04165', 'bcf9a7a8-5e6f-4a89-9992-39e047bf41f4', '2017-04-08 15:53:46', NULL, NULL, NULL, NULL),
('c22f0c15-0a0f-4529-864f-a6cb45d195eb', '159052c4-1271-4d95-a30c-4183d712c678', 'f163cac2-3ecd-488a-9998-669f00b0e574', '2015-08-29 14:17:40', NULL, NULL, NULL, NULL),
('c599524e-1496-48f4-b268-ed8a19d52700', '159052c4-1271-4d95-a30c-4183d712c678', '100000', '2015-08-31 21:38:58', NULL, NULL, NULL, NULL),
('c839c5c9-b376-4747-908b-45ce2fb6d661', '159052c4-1271-4d95-a30c-4183d712c678', '03d56612-d159-4e5d-9ee1-f419b818f3a8', '2015-08-30 20:38:13', NULL, NULL, NULL, NULL),
('d440446f-7901-47b0-8843-7f1df4697f78', '8e06c093-b457-4cd2-a6ec-091d9405d88f', 'acd13c2c-6f49-4e8a-a9b1-4a4ecd9b40aa', '2015-10-28 10:18:23', NULL, NULL, NULL, NULL),
('d4b6b69e-035b-4739-92e0-f45c2844cd01', '67bf2de4-9827-4a5f-822f-8eda5bd31936', '5abc4eb6-2f52-4726-a328-3f352e340676', '2015-11-23 11:08:36', NULL, NULL, NULL, NULL),
('e4dce3a0-7dde-4e7c-99b9-b1115c721546', '8e06c093-b457-4cd2-a6ec-091d9405d88f', '823a1f7f-c7fe-4b47-9767-7b2800b5ea43', '2015-11-11 21:34:55', NULL, NULL, NULL, NULL),
('e5ed336f-90b2-446c-a264-f9d6cf518e62', '8e06c093-b457-4cd2-a6ec-091d9405d88f', 'c5ed4568-39dc-4d7b-8d41-fab9f4b19c1b', '2015-11-09 10:38:58', NULL, NULL, NULL, NULL),
('eb66c412-e9cf-4539-9713-f47a9a1de612', '437fc53e-89fb-4036-9e0a-52d73102e47b', 'a5730119-a3f7-422a-8214-ff666da29ccd', '2015-07-28 12:25:01', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- 表的结构 `comment`
--

CREATE TABLE IF NOT EXISTS `comment` (
  `Id` varchar(100) NOT NULL DEFAULT '',
  `CommodityId` varchar(100) DEFAULT NULL,
  `Content` varchar(5000) DEFAULT NULL,
  `UserId` varchar(100) DEFAULT NULL,
  `UserName` varchar(100) DEFAULT NULL,
  `CreatTime` datetime DEFAULT NULL,
  `ContentType` varchar(100) DEFAULT NULL,
  `StandbyOne` varchar(500) DEFAULT NULL,
  `StandbyTwo` varchar(500) DEFAULT NULL,
  `StandbyThree` varchar(500) DEFAULT NULL,
  `StandbyFore` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=gb2312;

--
-- 转存表中的数据 `comment`
--

INSERT INTO `comment` (`Id`, `CommodityId`, `Content`, `UserId`, `UserName`, `CreatTime`, `ContentType`, `StandbyOne`, `StandbyTwo`, `StandbyThree`, `StandbyFore`) VALUES
('1', '8XB6oxzyJXFdGJUSCBZH', '酒不多 味道很多', '67ff3ef1-cb5b-49da-a458-94e527ed3295', 'zs', '2015-08-08 23:17:35', NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- 表的结构 `commercialuser`
--

CREATE TABLE IF NOT EXISTS `commercialuser` (
  `Id` varchar(100) NOT NULL DEFAULT '',
  `Commercial` varchar(255) DEFAULT NULL COMMENT '商户帐号',
  `PassWord` varchar(255) DEFAULT NULL,
  `CommercialName` varchar(100) DEFAULT NULL COMMENT '商户名称',
  `CommercialSite` varchar(500) DEFAULT NULL COMMENT '商户地址',
  `Linkman` varchar(100) DEFAULT NULL COMMENT '联系人',
  `Phone` varchar(100) DEFAULT NULL COMMENT '联系电话',
  `Lng` varchar(100) DEFAULT NULL,
  `Lat` varchar(100) DEFAULT NULL,
  `CreatTime` datetime DEFAULT NULL COMMENT '创建时间',
  `JiuQian` varchar(100) DEFAULT NULL,
  `LoginState` varchar(100) DEFAULT NULL,
  `Sex` varchar(100) DEFAULT NULL,
  `HeadPortrait` varchar(255) DEFAULT NULL,
  `BirthDate` varchar(255) DEFAULT NULL,
  `NickName` varchar(100) DEFAULT NULL,
  `CommercialImg` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=gb2312;

--
-- 转存表中的数据 `commercialuser`
--

INSERT INTO `commercialuser` (`Id`, `Commercial`, `PassWord`, `CommercialName`, `CommercialSite`, `Linkman`, `Phone`, `Lng`, `Lat`, `CreatTime`, `JiuQian`, `LoginState`, `Sex`, `HeadPortrait`, `BirthDate`, `NickName`, `CommercialImg`) VALUES
('01a8502d-2168-4953-b9f1-f07de0e58289', 'test1', 'eG98QqEdy3A=', '广埠屯提货点', '广埠屯电脑城', '吴', '13554563265', '114.370338', '30.528998', '2015-11-23 10:39:42', '20', '1', '男', NULL, NULL, '自然有料海鸭蛋', NULL),
('1', 'admin', 'K6CG7IXQGv4=', '冰雪城', '光谷', '管理员', '1337788888', '116.33139', '39.897445', '2015-08-08 23:14:36', '29', '1', '女', NULL, '2015-10-01', 'aaa', 'UpLoad/f3831464-f733-4c6d-bffe-c0c1bdd872cb.png'),
('2968ecb8-4d48-46a4-b865-7ba91122cbb5', 'ggd', '6u1n1q7jQ5A=', '玖易提光谷店', '湖北省武汉洪山区东湖开发区珞瑜路889号(光谷转盘旁) ', 'ggd', '13377885663', '114.412598', '30.511986', '2015-11-01 21:51:23', '0', '1', NULL, NULL, NULL, NULL, 'UpLoad/e0f986fa-fdaf-4f25-872e-ea8a272fc338.png'),
('7e4f3c40-19b3-4ac4-8874-b4ae70017859', 'test2', '2UMrrOVqS7k=', '创业街自提点', '创业街10栋', '二哥', '13554562312', '114.424673', '30.506059', '2016-01-25 10:01:13', NULL, '1', NULL, NULL, NULL, NULL, NULL),
('b6d4e5e7-a568-4dc0-94df-1405db03f9e6', 'test', 'SiQu8unOTKY=', '测试测试', '武汉兆富国际', '123', '1355555555', '114.356014', '30.534412', '2015-09-06 15:15:23', '0', '1', '男', NULL, '2015-11-05', '测试', NULL),
('f5282fbb-4c64-4606-9885-3307bd47f879', 'test3', 'tJ1Dvgx60NU=', '中南路提货点', '中南路提货点', '活动室', '13523236521', '114.339512', '30.54376', '2016-01-25 10:03:11', NULL, '1', NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- 表的结构 `commodity`
--

CREATE TABLE IF NOT EXISTS `commodity` (
  `Id` varchar(100) NOT NULL,
  `Title` varchar(100) DEFAULT NULL COMMENT '商品标题',
  `Explains` varchar(1000) DEFAULT NULL,
  `Particular` longtext,
  `Images` varchar(500) DEFAULT NULL,
  `NewPrice` varchar(100) DEFAULT NULL,
  `OldPrice` varchar(100) DEFAULT NULL,
  `Standard` varchar(100) DEFAULT NULL,
  `Colour` varchar(100) DEFAULT NULL,
  `JiuQianMax` varchar(255) DEFAULT NULL,
  `JiuQian` varchar(100) DEFAULT NULL COMMENT '酒钱数',
  `RecommendIndex` varchar(100) DEFAULT NULL COMMENT '推荐指数',
  `CommentNumber` varchar(100) DEFAULT NULL,
  `Grade` varchar(100) DEFAULT NULL,
  `ActivityType` varchar(100) DEFAULT NULL COMMENT '活动类型',
  `TwoImg` varchar(100) DEFAULT NULL,
  `CommodityType` varchar(100) DEFAULT NULL COMMENT '商品类型',
  `CommodityNumber` varchar(100) DEFAULT NULL,
  `Period` varchar(100) DEFAULT NULL,
  `Column` varchar(100) DEFAULT NULL,
  `Commercial` varchar(100) DEFAULT NULL,
  `CreatTime` datetime DEFAULT NULL,
  `CommodityClass` varchar(500) DEFAULT NULL COMMENT 'CommodityClass',
  `del` varchar(500) DEFAULT '0' COMMENT '1上架0未上架',
  `SJJiuQian` varchar(500) DEFAULT NULL COMMENT '商家酒钱',
  `StandbyFore` varchar(500) DEFAULT NULL,
  `orderid` int(10) NOT NULL COMMENT '排列顺序',
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=gb2312;

--
-- 转存表中的数据 `commodity`
--

INSERT INTO `commodity` (`Id`, `Title`, `Explains`, `Particular`, `Images`, `NewPrice`, `OldPrice`, `Standard`, `Colour`, `JiuQianMax`, `JiuQian`, `RecommendIndex`, `CommentNumber`, `Grade`, `ActivityType`, `TwoImg`, `CommodityType`, `CommodityNumber`, `Period`, `Column`, `Commercial`, `CreatTime`, `CommodityClass`, `del`, `SJJiuQian`, `StandbyFore`, `orderid`) VALUES
('01a15fbc-fec2-42ee-9eed-d749cfe1c0d2', '雪花勇闯天涯', NULL, '“雪花啤酒勇闯天涯”活动是由华润雪花啤酒中国（有限）公司独立创新的具有原创性的品牌推广活动，它不仅是国内啤酒品牌大规模、广区域的一次全国范围的品牌推广活动，更是雪花啤酒为回馈中国啤酒爱好者所创立的一个独特的文化品牌。', '["uploads/image/20170419/1492590770.jpg"]', '4.5', '5.0', NULL, NULL, NULL, '0.5', '1', NULL, NULL, '0', NULL, '0', '24', NULL, NULL, 'admin', '2015-08-27 14:41:40', '1', '1', '', NULL, 0),
('159052c4-1271-4d95-a30c-4183d712c678', '王朝珍藏橡木桶', NULL, NULL, '["uploads/image/20170419/1492584034.jpg","uploads/image/20170419/1492585222.jpg"]', '78', '128', NULL, NULL, NULL, '50', '1', NULL, NULL, '0', NULL, '0', '6', NULL, NULL, 'admin', '2015-08-27 16:16:13', '2', '0', '', NULL, 0),
('1ae8fa75-bc87-475f-9aee-a706ab68b2fc', '40.8°英国诗贝（ＳＰＥＹ）皇金精选单一纯麦苏格兰威士忌700ml+欧文羊年', NULL, '英国五大皇宫内贩售品牌，球星欧文烫金版硬松木礼盒 单一麦芽精选', '["uploads/image/20170419/1492591504.jpg","uploads/image/20170419/1492588047.jpg","uploads/image/20170419/1492582851.jpg"]', '0.01', '1299', NULL, NULL, NULL, '20', '2', NULL, NULL, '0', NULL, '0', NULL, NULL, NULL, 'admin', '2015-11-26 16:55:45', '2', '0', '1', NULL, 0),
('4717e728-1a65-4660-a1a7-6353791b1b5b', '40°法国人头马1898特优香槟干邑700ml', NULL, '40°法国人头马1898特优香槟干邑700ml', '["uploads/image/20170419/1492591682.jpg","uploads/image/20170419/1492588060.jpg"]', '0.01', '3313', NULL, NULL, NULL, '20', '2', NULL, NULL, '0', NULL, '0', NULL, NULL, NULL, 'admin', '2015-11-26 16:46:20', '2', '1', '1', NULL, 0),
('4cH7HMKee5pDIMlX0hub', '天使之手moscato dile意大利进口女士甜白葡萄酒 微起泡气泡红酒', NULL, NULL, '["uploads/image/20170419/1492584860.jpg","uploads/image/20170419/1492584395.jpg"]', '22', '2432', NULL, NULL, NULL, '2', '1', NULL, NULL, '0', NULL, '0', NULL, NULL, NULL, NULL, '2017-04-19 09:13:18', '1', '0', '4', NULL, 3),
('51033380-74ba-4c4a-bb9e-0a61f2e04165', '百加得冰锐 鸡尾酒 Bacardi 预调朗姆酒', NULL, NULL, '["uploads/image/20170419/1492583726.jpg","uploads/image/20170419/1492583776.jpg"]', '11', '11.8', '瓶', NULL, NULL, '1', '8', NULL, NULL, '0', NULL, '0', NULL, NULL, NULL, 'admin', '2015-09-06 14:28:18', '3', '1', '0.5', NULL, 0),
('5221b912-acbf-4b3b-bd1c-4deff051b6e8', '40.8°英国诗贝（ＳＰＥＹ）皇金精选单一纯麦苏格兰威士忌700ml简易纸筒装', NULL, '单一麦芽加白兰地，英国皇室与法国贵族的碰撞。套装优惠', '["uploads/image/20170419/1492589819.jpg"]', '0.01', '719', NULL, NULL, NULL, '20', '1', NULL, NULL, '0', NULL, '0', NULL, NULL, NULL, 'admin', '2015-11-26 17:06:41', '2', '1', '1', NULL, 0),
('536913a7-fef3-4594-8d6a-597076565058', '墨西哥原装进口黄啤酒 科罗娜CORONA特级啤酒', NULL, NULL, '["uploads/image/20170419/1492588747.jpg"]', '15', '18', '瓶', NULL, NULL, '3', '9', NULL, NULL, '0', NULL, '0', NULL, NULL, NULL, 'admin', '2015-09-06 14:32:24', '3', '0', '1', NULL, 0),
('5ada2022-9235-4f52-9bad-fe9ad83a0fe9', '40°法国马爹利凯旋珍享特级干邑白兰地礼盒', NULL, '源自1715年的卓越传统', '["uploads/image/20170419/1492592166.jpg","uploads/image/20170419/1492591790.jpg"]', '0.01', '4569', NULL, NULL, NULL, '20', '1', NULL, NULL, '0', NULL, '0', NULL, NULL, NULL, 'admin', '2015-11-26 16:42:52', '2', '1', '1', NULL, 0),
('5ba99c98-f33b-4d9d-9c8b-2244d66a0747', '法国瑞斯金爵', NULL, NULL, '["uploads/image/20170419/1492590333.jpg","uploads/image/20170419/1492592524.jpg","uploads/image/20170419/1492586107.jpg"]', '68', '128', NULL, NULL, NULL, '60', '1', NULL, NULL, '0', NULL, '0', NULL, NULL, NULL, 'admin', '2015-09-06 14:37:39', '2', '1', '', NULL, 0),
('5dd8b37a-2e69-4820-90a6-9db931624f62', '40°水晶头骨伏特加世界杯手绘限量版（冠军队）750ml', NULL, '40°水晶头骨伏特加世界杯手绘限量版（冠军队）750ml', '["uploads/image/20170419/1492588357.jpg","uploads/image/20170419/1492588358.jpg","uploads/image/20170419/1492584487.jpg"]', '0.01', '899', NULL, NULL, NULL, '20', '3', NULL, NULL, '0', NULL, '0', NULL, NULL, NULL, 'admin', '2015-11-26 17:04:44', '1', '1', '1', NULL, 0),
('626d7b52-bc53-45db-9bf1-4e4667c59f85', '40°加拿大水晶头骨伏特加1750ml', NULL, '玩的就是酷炫 喝的就是霸气', '["uploads/image/20170419/1492588249.jpg","uploads/image/20170419/1492586092.jpg","uploads/image/20170419/1492587468.jpg","uploads/image/20170419/1492589667.jpg"]', '0.01', '899', NULL, NULL, NULL, '20', '2', NULL, NULL, '0', NULL, '0', NULL, NULL, NULL, 'admin', '2015-11-26 17:01:50', '1', '1', '1', NULL, 0),
('66368fea-af22-439e-bbde-e52af1fc4847', '法国瑞斯紫爵红葡萄酒 原瓶进口红酒', NULL, NULL, '["uploads/image/20170419/1492584828.jpg","uploads/image/20170419/1492590858.jpg","uploads/image/20170419/1492592278.jpg"]', '128', '368', '瓶', NULL, NULL, '60', '3', NULL, NULL, '0', NULL, '0', NULL, NULL, NULL, 'admin', '2015-12-10 15:18:15', '2', '0', '5', NULL, 0),
('67bf2de4-9827-4a5f-822f-8eda5bd31936', '张裕黄金纬度', NULL, NULL, '["uploads/image/20170419/1492590597.jpg","uploads/image/20170419/1492584178.jpg","uploads/image/20170419/1492587928.jpg","uploads/image/20170419/1492588298.jpg"]', '53', '78', NULL, NULL, NULL, '25', '3', NULL, NULL, '0', NULL, '0', NULL, NULL, NULL, 'admin', '2015-09-06 15:04:04', '2', '1', '', NULL, 0),
('69dffb20-5811-4e81-949c-fc1b71f79ec7', '43°达尔维尼15年单一麦芽苏格兰威士忌700ml', NULL, '气味芬芳 口感顺滑', '["uploads/image/20170419/1492591578.jpg","uploads/image/20170419/1492592744.jpg","uploads/image/20170419/1492589558.jpg","uploads/image/20170419/1492585151.jpg"]', '0.01', '665', NULL, NULL, NULL, '20', '5', NULL, NULL, '0', NULL, '0', NULL, NULL, NULL, 'admin', '2015-11-26 17:09:07', '1', '1', '1', NULL, 0),
('6c55cecb-0795-4044-95a4-c1fce8370265', '长城星级系列干红葡萄酒 三星赤霞珠红酒', NULL, NULL, '["uploads/image/20170419/1492586849.jpg","uploads/image/20170419/1492589101.jpg","uploads/image/20170419/1492588086.jpg"]', '98', '108', NULL, NULL, NULL, '30', '6', NULL, NULL, '0', NULL, '0', NULL, NULL, NULL, 'admin', '2015-12-10 13:46:32', '2', '0', '8', NULL, 0),
('6fcf7aa0-ca96-4f7e-a05c-6d7f26349956', '40°法国轩尼诗VSOP干邑白兰地乐享装礼盒700ml', NULL, '追寻梦想，畅享不一样的情怀', '["uploads/image/20170419/1492588238.jpg","uploads/image/20170419/1492589838.jpg","uploads/image/20170419/1492591521.jpg","uploads/image/20170419/1492585244.jpg"]', '0.01', '379', NULL, NULL, NULL, '20', '2', NULL, NULL, '0', NULL, '0', NULL, NULL, NULL, 'admin', '2015-11-26 17:19:42', '2', '1', '1', NULL, 0),
('6fdfef77-2b0e-4085-8f51-d29330833146', '40°英国芝华士18年苏格兰威士忌礼盒700ml', NULL, '体现了力量与优雅和谐统一的珍贵品质', '["uploads/image/20170419/1492589436.jpg","uploads/image/20170419/1492587952.jpg"]', '0.01', '659', NULL, NULL, NULL, '20', '2', NULL, NULL, '0', NULL, '0', NULL, NULL, NULL, 'admin', '2015-11-26 17:10:23', '1', '1', '1', NULL, 0),
('7253ef6f-3df4-4ecd-a910-989f7244a071', '长城精致解百纳', NULL, NULL, '["uploads/image/20170419/1492584658.jpg","uploads/image/20170419/1492583282.jpg"]', '58', '98', NULL, NULL, NULL, '40', '4', NULL, NULL, '0', NULL, '0', NULL, NULL, NULL, 'admin', '2015-09-06 14:59:36', '2', '1', '', NULL, 0),
('7f8e568a-24b1-4048-a069-072aa0a13fae', '40°布拉德X.O.白兰地700ml', NULL, '纯正法国血统 新颖酿造工艺', '["uploads/image/20170419/1492589839.jpg","uploads/image/20170419/1492584070.jpg"]', '0.01', '599', NULL, NULL, NULL, '20', '6', NULL, NULL, '0', NULL, '0', NULL, NULL, NULL, 'admin', '2015-11-26 17:13:11', '1', '1', '1', NULL, 0),
('850ff9ad-2801-4fa0-a1bd-07171fcf2ecc', '40°卡杜15年单一麦芽苏格兰威士忌700ml', NULL, '带有冬天阳光的气息，口感爽滑。', '["uploads/image/20170419/1492592031.jpg","uploads/image/20170419/1492589769.jpg","uploads/image/20170419/1492587961.jpg","uploads/image/20170419/1492588641.jpg"]', '0.01', '598', NULL, NULL, NULL, '20', '8', NULL, NULL, '0', NULL, '0', NULL, NULL, NULL, 'admin', '2015-11-26 17:14:25', '1', '1', '1', NULL, 0),
('851b35b3-84cd-490d-a3c4-d581e09a4f35', '40°美国杰克丹尼田纳西州威士忌礼盒700ml*2', NULL, '芳香馥郁 口感柔和顺口', '["uploads/image/20170419/1492586090.jpg","uploads/image/20170419/1492590612.jpg","uploads/image/20170419/1492584583.jpg"]', '0.01', '369', NULL, NULL, NULL, '20', '6', NULL, NULL, '0', NULL, '0', NULL, NULL, NULL, 'admin', '2015-11-26 17:20:59', '2', '1', '1', NULL, 0),
('85f664da-1c87-4e8e-ba9d-5973468523d7', '法国金羊', NULL, NULL, '["uploads/image/20170419/1492589225.jpg","uploads/image/20170419/1492586396.jpg"]', '48', '78', NULL, NULL, NULL, '30', '1', NULL, NULL, '0', NULL, '0', NULL, NULL, NULL, 'admin', '2015-09-06 14:46:40', '2', '1', '', NULL, 0),
('883c83e0-4768-4fcf-83c2-84b0c316f9b9', '张裕特选级解百纳干红 优质国产红酒 解百纳葡萄酒', NULL, NULL, '["uploads/image/20170419/1492586953.jpg","uploads/image/20170419/1492591696.jpg","uploads/image/20170419/1492591624.jpg"]', '108', '118', NULL, NULL, NULL, '28', '5', NULL, NULL, '0', NULL, '0', NULL, NULL, NULL, 'admin', '2015-12-10 13:57:49', '2', '0', '3', NULL, 0),
('8b94f1d5-4848-4333-bca3-184709cf269a', '38°墨西哥Torero牌龙舌兰750ml', NULL, '38°墨西哥Torero牌龙舌兰750ml', '["uploads/image/20170419/1492591407.jpg","uploads/image/20170419/1492592236.jpg"]', '0.01', '3188', NULL, NULL, NULL, '20', '2', NULL, NULL, '0', NULL, '0', NULL, NULL, NULL, 'admin', '2015-11-26 16:48:32', '2', '1', '1', NULL, 0),
('8e06c093-b457-4cd2-a6ec-091d9405d88f', '白云边15年', NULL, NULL, '["uploads/image/20170419/1492586556.jpg","uploads/image/20170419/1492589689.jpg","uploads/image/20170419/1492588982.jpg"]', '0.01', '178', NULL, NULL, NULL, '20', '1', NULL, NULL, '0', NULL, '0', NULL, NULL, NULL, 'admin', '2015-09-06 15:08:11', '1', '1', '1', NULL, 0),
('8XB6oxzyJXFdGJUSCBZH', '123', NULL, NULL, '["uploads/image/20170419/1492575135.jpg"]', '23', '23', NULL, NULL, NULL, '1', '1', NULL, NULL, '0', NULL, '0', NULL, NULL, NULL, NULL, '2017-04-19 09:32:02', '3', '0', '', NULL, 5),
('mJDZ3DZ202BdInpppz0q', '天使之手moscato dile意大利进口女士甜白葡萄酒 微起泡气泡红酒 ', NULL, NULL, '["uploads/image/20170419/1492592124.jpg"]', '0.01', '263', NULL, NULL, NULL, '1', '1', NULL, NULL, '0', NULL, '0', NULL, NULL, NULL, NULL, '2017-04-14 10:49:38', '2', '0', '2', NULL, 2),
('pKfHwiaNRO', '女士型红酒双支白起泡气泡酒半甜型果酒葡萄酒', NULL, NULL, '["uploads/image/20170419/1492586055.jpg"]', '0.01', '69', NULL, NULL, NULL, '1', '1', NULL, NULL, '0', NULL, '0', NULL, NULL, NULL, NULL, '2017-04-14 10:33:52', '2', '0', '2', NULL, 1),
('vIoBNWSm3ohrwiunZYfj', '城市的夜晚霓虹灯璀璨', NULL, NULL, '["uploads/image/20170419/1492569058.jpg","uploads/image/20170419/1492572786.jpg","uploads/image/20170419/1492589207.png","uploads/image/20170419/1492586643.jpg"]', '123', '12', NULL, NULL, NULL, '234', '1', NULL, NULL, '0', NULL, '0', NULL, NULL, NULL, NULL, '2017-04-19 09:26:44', '1', '0', '12', NULL, 4);

-- --------------------------------------------------------

--
-- 表的结构 `commodityclass`
--

CREATE TABLE IF NOT EXISTS `commodityclass` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ClassName` varchar(255) DEFAULT NULL,
  `CreatTime` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=gb2312 AUTO_INCREMENT=4 ;

--
-- 转存表中的数据 `commodityclass`
--

INSERT INTO `commodityclass` (`id`, `ClassName`, `CreatTime`) VALUES
(1, '白酒', '2015-08-30 00:17:26'),
(2, '红酒', '2015-08-30 00:17:51'),
(3, '啤酒', '2015-08-30 00:18:04');

-- --------------------------------------------------------

--
-- 表的结构 `commoditydetails`
--

CREATE TABLE IF NOT EXISTS `commoditydetails` (
  `id` varchar(255) NOT NULL,
  `Details` text,
  `CreatTime` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=gb2312;

--
-- 转存表中的数据 `commoditydetails`
--

INSERT INTO `commoditydetails` (`id`, `Details`, `CreatTime`) VALUES
('01a15fbc-fec2-42ee-9eed-d749cfe1c0d2', '雪花勇闯天涯！', '2017-04-14 11:24:01'),
('159052c4-1271-4d95-a30c-4183d712c678', '<p><img src="/upload/image/20150831/6357657895003800007289901.jpg" title="9c16fdfaaf51f3de1e296fa390eef01f3b29795a.jpg" alt="9c16fdfaaf51f3de1e296fa390eef01f3b29795a.jpg"/></p><p>11</p>', '2015-08-31 00:49:13'),
('51033380-74ba-4c4a-bb9e-0a61f2e04165', '<p>最时尚预调鸡尾酒，冰锐自提，随机发货！</p><p><strong>重要提示：</strong>由于易提点库存原因，各种口味先提者先得哦！</p><p><img src="/upload/image/20151210/6358534724709100004677665.jpg"/><img src="/upload/image/20151210/6358534725399400005780537.jpg"/></p><p><img src="http://222.187.226.10:803/upload/image/20151210/6358534742391300009557709.jpg"/><img src="http://222.187.226.10:803/upload/image/20151210/6358534742994000004194132.jpg"/><img src="http://222.187.226.10:803/upload/image/20151210/6358534743087300004104979.jpg"/><img src="http://222.187.226.10:803/upload/image/20151210/6358534742931600004253568.jpg"/><img src="http://222.187.226.10:803/upload/image/20151210/6358534743065000001877267.jpg"/><img src="/upload/image/20151210/6358534811102500008898335.jpg"/><img src="/upload/image/20151210/6358534743595100001372065.jpg"/><img src="/upload/image/20151210/6358534743879900001388686.jpg"/><img src="/upload/image/20151210/6358534743968800001015452.jpg"/><img src="/upload/image/20151210/6358534744127700002623526.jpg"/><img src="/upload/image/20151210/6358534755055600003666710.jpg"/><img src="/upload/image/20151210/6358534759898800002573783.jpg"/><img src="/upload/image/20151210/6358534759960200003986930.jpg"/><img src="/upload/image/20151210/6358534765559200003152592.jpg"/><img src="/upload/image/20151210/6358534765544200007667451.jpg"/></p>', '2015-12-10 12:35:45'),
('536913a7-fef3-4594-8d6a-597076565058', '<p><img title="0011.jpg" alt="0011.jpg" src="/upload/image/20151210/6358535092797900005710375.jpg"/></p><p><img title="TB2GGHaeVXXXXaIXXXXXXXXXXXX_!!2386428115.jpg" src="http://222.187.226.10:803/upload/image/20151210/6358535096127800006260587.jpg"/><img title="TB2Gie5eVXXXXb_XXXXXXXXXXXX_!!2386428115.jpg" src="/upload/image/20151210/6358535096069200002305931.jpg"/><img title="TB2rSjKeXXXXXXAXpXXXXXXXXXX-2386428115 (1).jpg" alt="TB2rSjKeXXXXXXAXpXXXXXXXXXX-2386428115 (1).jpg" src="/upload/image/20151210/6358535100279100005537371.jpg"/><img title="TB2oHMDfXXXXXaiXpXXXXXXXXXX_!!2386428115.jpg" alt="TB2oHMDfXXXXXaiXpXXXXXXXXXX_!!2386428115.jpg" src="/upload/image/20151210/6358535102115300007798115.jpg"/></p><p>&nbsp;</p><p>&nbsp;</p>', '2015-11-11 09:49:07'),
('5ba99c98-f33b-4d9d-9c8b-2244d66a0747', '<p><span style="color: rgb(35, 35, 35); font-family: Verdana, Tahoma, Arial, &#39;Helvetica Neue&#39;, Helvetica, sans-serif; font-size: 12px; background-color: rgb(255, 255, 255);">法国瑞斯金爵<span style="color: rgb(35, 35, 35); font-family: Verdana, Tahoma, Arial, &#39;Helvetica Neue&#39;, Helvetica, sans-serif; font-size: 12px; background-color: rgb(255, 255, 255);">法国瑞斯金爵<span style="color: rgb(35, 35, 35); font-family: Verdana, Tahoma, Arial, &#39;Helvetica Neue&#39;, Helvetica, sans-serif; font-size: 12px; background-color: rgb(255, 255, 255);">法国瑞斯金爵<span style="color: rgb(35, 35, 35); font-family: Verdana, Tahoma, Arial, &#39;Helvetica Neue&#39;, Helvetica, sans-serif; font-size: 12px; background-color: rgb(255, 255, 255);">法国瑞斯金爵<span style="color: rgb(35, 35, 35); font-family: Verdana, Tahoma, Arial, &#39;Helvetica Neue&#39;, Helvetica, sans-serif; font-size: 12px; background-color: rgb(255, 255, 255);">法国瑞斯金爵<span style="color: rgb(35, 35, 35); font-family: Verdana, Tahoma, Arial, &#39;Helvetica Neue&#39;, Helvetica, sans-serif; font-size: 12px; background-color: rgb(255, 255, 255);">法国瑞斯金爵</span></span></span></span></span></span></p>', '2015-11-11 09:49:18'),
('66368fea-af22-439e-bbde-e52af1fc4847', '<p>&nbsp;超级返利，直返53%！</p><p>原瓶进口，口感超好！适合日常用餐，聚会，自用养生！是一款难得的法国餐酒！</p><p><img title="Image 16.jpg" alt="Image 16.jpg" src="/upload/image/20151210/6358535756087300009875840.jpg"/></p><p><img title="紫爵1.jpg" src="/upload/image/20151210/6358535753524500001556034.jpg"/></p><p><img title="紫爵2.jpg" src="/upload/image/20151210/6358535753606100007738402.jpg"/></p><p></p>', '2015-12-10 15:23:13'),
('664f6dee-d9ab-4821-8e8d-77fe3ce416a4', '<p>使得法国豆腐干</p><p><img src="/upload/image/20150830/6357657501501987368286880.jpg" title="9c16fdfaaf51f3de1e296fa390eef01f3b29795a.jpg" alt="9c16fdfaaf51f3de1e296fa390eef01f3b29795a.jpg"/></p>', '2015-08-30 23:28:08'),
('67bf2de4-9827-4a5f-822f-8eda5bd31936', '<p><span style="color: rgb(35, 35, 35); font-family: Verdana, Tahoma, Arial, &#39;Helvetica Neue&#39;, Helvetica, sans-serif; font-size: 12px; background-color: rgb(255, 255, 255);">张裕黄金纬度<span style="color: rgb(35, 35, 35); font-family: Verdana, Tahoma, Arial, &#39;Helvetica Neue&#39;, Helvetica, sans-serif; font-size: 12px; background-color: rgb(255, 255, 255);">张裕黄金纬度<span style="color: rgb(35, 35, 35); font-family: Verdana, Tahoma, Arial, &#39;Helvetica Neue&#39;, Helvetica, sans-serif; font-size: 12px; background-color: rgb(255, 255, 255);">张裕黄金纬度<span style="color: rgb(35, 35, 35); font-family: Verdana, Tahoma, Arial, &#39;Helvetica Neue&#39;, Helvetica, sans-serif; font-size: 12px; background-color: rgb(255, 255, 255);">张裕黄金纬度<span style="color: rgb(35, 35, 35); font-family: Verdana, Tahoma, Arial, &#39;Helvetica Neue&#39;, Helvetica, sans-serif; font-size: 12px; background-color: rgb(255, 255, 255);">张裕黄金纬度<span style="color: rgb(35, 35, 35); font-family: Verdana, Tahoma, Arial, &#39;Helvetica Neue&#39;, Helvetica, sans-serif; font-size: 12px; background-color: rgb(255, 255, 255);">张裕黄金纬度<span style="color: rgb(35, 35, 35); font-family: Verdana, Tahoma, Arial, &#39;Helvetica Neue&#39;, Helvetica, sans-serif; font-size: 12px; background-color: rgb(255, 255, 255);">张裕黄金纬度<span style="color: rgb(35, 35, 35); font-family: Verdana, Tahoma, Arial, &#39;Helvetica Neue&#39;, Helvetica, sans-serif; font-size: 12px; background-color: rgb(255, 255, 255);">张裕黄金纬度<span style="color: rgb(35, 35, 35); font-family: Verdana, Tahoma, Arial, &#39;Helvetica Neue&#39;, Helvetica, sans-serif; font-size: 12px; background-color: rgb(255, 255, 255);">张裕黄金纬度</span></span></span></span></span></span></span></span></span></p>', '2015-11-11 09:47:59'),
('6c55cecb-0795-4044-95a4-c1fce8370265', '<p>&nbsp;<img title="TB2XoKJfXXXXXauXXXXXXXXXXXX_!!478630281.jpg" alt="TB2XoKJfXXXXXauXXXXXXXXXXXX_!!478630281.jpg" src="/upload/image/20151210/6358535207293900005289014.jpg"/><img title="TB206iqfXXXXXa6XpXXXXXXXXXX_!!478630281.jpg" alt="TB206iqfXXXXXa6XpXXXXXXXXXX_!!478630281.jpg" src="/upload/image/20151210/6358535210203400009267834.jpg"/><img title="TB2YXyBfXXXXXctXXXXXXXXXXXX_!!478630281.jpg" alt="TB2YXyBfXXXXXctXXXXXXXXXXXX_!!478630281.jpg" src="/upload/image/20151210/6358535212163200003882290.jpg"/><img title="TB22jBZhVXXXXacXXXXXXXXXXXX_!!478630281.jpg" alt="TB22jBZhVXXXXacXXXXXXXXXXXX_!!478630281.jpg" src="/upload/image/20151210/6358535214035900005328469.jpg"/><img title="TB2yJaOfXXXXXXzXXXXXXXXXXXX_!!478630281.jpg" alt="TB2yJaOfXXXXXXzXXXXXXXXXXXX_!!478630281.jpg" src="/upload/image/20151210/6358535215740200009965514.jpg"/><img title="TB2OneBfXXXXXccXXXXXXXXXXXX_!!478630281.jpg" alt="TB2OneBfXXXXXccXXXXXXXXXXXX_!!478630281.jpg" src="/upload/image/20151210/6358535220684000002227832.jpg"/><img title="TB2d8OvfXXXXXXNXpXXXXXXXXXX_!!478630281.jpg" alt="TB2d8OvfXXXXXXNXpXXXXXXXXXX_!!478630281.jpg" src="/upload/image/20151210/6358535224645600007453677.jpg"/></p>', '2015-12-10 13:50:59'),
('7253ef6f-3df4-4ecd-a910-989f7244a071', '<p><span style="color: rgb(35, 35, 35); font-family: Verdana, Tahoma, Arial, &#39;Helvetica Neue&#39;, Helvetica, sans-serif; font-size: 12px; background-color: rgb(255, 255, 255);">长城精致解百纳<span style="color: rgb(35, 35, 35); font-family: Verdana, Tahoma, Arial, &#39;Helvetica Neue&#39;, Helvetica, sans-serif; font-size: 12px; background-color: rgb(255, 255, 255);">长城精致解百纳<span style="color: rgb(35, 35, 35); font-family: Verdana, Tahoma, Arial, &#39;Helvetica Neue&#39;, Helvetica, sans-serif; font-size: 12px; background-color: rgb(255, 255, 255);">长城精致解百纳<span style="color: rgb(35, 35, 35); font-family: Verdana, Tahoma, Arial, &#39;Helvetica Neue&#39;, Helvetica, sans-serif; font-size: 12px; background-color: rgb(255, 255, 255);">长城精致解百纳<span style="color: rgb(35, 35, 35); font-family: Verdana, Tahoma, Arial, &#39;Helvetica Neue&#39;, Helvetica, sans-serif; font-size: 12px; background-color: rgb(255, 255, 255);">长城精致解百纳<span style="color: rgb(35, 35, 35); font-family: Verdana, Tahoma, Arial, &#39;Helvetica Neue&#39;, Helvetica, sans-serif; font-size: 12px; background-color: rgb(255, 255, 255);">长城精致解百纳<span style="color: rgb(35, 35, 35); font-family: Verdana, Tahoma, Arial, &#39;Helvetica Neue&#39;, Helvetica, sans-serif; font-size: 12px; background-color: rgb(255, 255, 255);">长城精致解百纳<span style="color: rgb(35, 35, 35); font-family: Verdana, Tahoma, Arial, &#39;Helvetica Neue&#39;, Helvetica, sans-serif; font-size: 12px; background-color: rgb(255, 255, 255);">长城精致解百纳<span style="color: rgb(35, 35, 35); font-family: Verdana, Tahoma, Arial, &#39;Helvetica Neue&#39;, Helvetica, sans-serif; font-size: 12px; background-color: rgb(255, 255, 255);">长城精致解百纳</span></span></span></span></span></span></span></span></span></p>', '2015-11-11 09:48:10'),
('85f664da-1c87-4e8e-ba9d-5973468523d7', '<p><span style="color: rgb(35, 35, 35); font-family: Verdana, Tahoma, Arial, &#39;Helvetica Neue&#39;, Helvetica, sans-serif; font-size: 12px; background-color: rgb(255, 255, 255);">法国金羊<span style="color: rgb(35, 35, 35); font-family: Verdana, Tahoma, Arial, &#39;Helvetica Neue&#39;, Helvetica, sans-serif; font-size: 12px; background-color: rgb(255, 255, 255);">法国金羊<span style="color: rgb(35, 35, 35); font-family: Verdana, Tahoma, Arial, &#39;Helvetica Neue&#39;, Helvetica, sans-serif; font-size: 12px; background-color: rgb(255, 255, 255);">法国金羊<span style="color: rgb(35, 35, 35); font-family: Verdana, Tahoma, Arial, &#39;Helvetica Neue&#39;, Helvetica, sans-serif; font-size: 12px; background-color: rgb(255, 255, 255);">法国金羊<span style="color: rgb(35, 35, 35); font-family: Verdana, Tahoma, Arial, &#39;Helvetica Neue&#39;, Helvetica, sans-serif; font-size: 12px; background-color: rgb(255, 255, 255);">法国金羊<span style="color: rgb(35, 35, 35); font-family: Verdana, Tahoma, Arial, &#39;Helvetica Neue&#39;, Helvetica, sans-serif; font-size: 12px; background-color: rgb(255, 255, 255);">法国金羊<span style="color: rgb(35, 35, 35); font-family: Verdana, Tahoma, Arial, &#39;Helvetica Neue&#39;, Helvetica, sans-serif; font-size: 12px; background-color: rgb(255, 255, 255);">法国金羊</span></span></span></span></span></span></span></p>', '2015-11-11 09:48:43'),
('883c83e0-4768-4fcf-83c2-84b0c316f9b9', '<p>&nbsp;<img title="TB2tobBeVXXXXadXXXXXXXXXXXX_!!1098719708.jpg" alt="TB2tobBeVXXXXadXXXXXXXXXXXX_!!1098719708.jpg" src="/upload/image/20151210/6358535268900600009147860.jpg"/><img title="TB2kSHIeVXXXXXZXXXXXXXXXXXX_!!1098719708.jpg" alt="TB2kSHIeVXXXXXZXXXXXXXXXXXX_!!1098719708.jpg" src="/upload/image/20151210/6358535271026200007411133.jpg"/><img title="TB23smReVXXXXaIXpXXXXXXXXXX_!!1098719708.jpg" alt="TB23smReVXXXXaIXpXXXXXXXXXX_!!1098719708.jpg" src="/upload/image/20151210/6358535272230400008225489.jpg"/><img title="TB24XhHhXXXXXXdXpXXXXXXXXXX_!!754161514.jpg" alt="TB24XhHhXXXXXXdXpXXXXXXXXXX_!!754161514.jpg" src="/upload/image/20151210/6358535282592000004817685.jpg"/><img title="TB2L0JUhXXXXXaIXXXXXXXXXXXX_!!754161514.jpg" src="/upload/image/20151210/6358535288779100008905384.jpg"/><img title="TB2L0JUhXXXXXaIXXXXXXXXXXXX_!!754161515.jpg" src="http://222.187.226.10:803/upload/image/20151210/6358535288782300001662047.jpg"/><img title="TB2kt0GhXXXXXXAXpXXXXXXXXXX_!!754161514.jpg" alt="TB2kt0GhXXXXXXAXpXXXXXXXXXX_!!754161514.jpg" src="/upload/image/20151210/6358535294922200001294324.jpg"/><img title="TB2WYJzhXXXXXbvXpXXXXXXXXXX_!!754161514.jpg" alt="TB2WYJzhXXXXXbvXpXXXXXXXXXX_!!754161514.jpg" src="/upload/image/20151210/6358535312131300006336054.jpg"/><img title="TB28KVQhXXXXXX6XXXXXXXXXXXX_!!754161514.jpg" alt="TB28KVQhXXXXXX6XXXXXXXXXXXX_!!754161514.jpg" src="/upload/image/20151210/6358535313321800005490859.jpg"/><img title="TB2Do4PhXXXXXaRXXXXXXXXXXXX_!!754161514.jpg" alt="TB2Do4PhXXXXXaRXXXXXXXXXXXX_!!754161514.jpg" src="/upload/image/20151210/6358535296206000005061804.jpg"/><img title="TB2zThAhXXXXXaOXpXXXXXXXXXX_!!754161514.jpg" alt="TB2zThAhXXXXXaOXpXXXXXXXXXX_!!754161514.jpg" src="/upload/image/20151210/6358535301420100001855601.jpg"/><img title="TB2_bRChXXXXXX3XpXXXXXXXXXX_!!754161514.jpg" alt="TB2_bRChXXXXXX3XpXXXXXXXXXX_!!754161514.jpg" src="/upload/image/20151210/6358535305486900002193353.jpg"/><img title="TB2WLJqhXXXXXcZXpXXXXXXXXXX_!!754161514.jpg" alt="TB2WLJqhXXXXXcZXpXXXXXXXXXX_!!754161514.jpg" src="/upload/image/20151210/6358535306503900007484189.jpg"/><img title="TB2oEdPhXXXXXbHXXXXXXXXXXXX_!!754161514.jpg" alt="TB2oEdPhXXXXXbHXXXXXXXXXXXX_!!754161514.jpg" src="/upload/image/20151210/6358535307822800003978614.jpg"/></p><p></p>', '2015-12-10 14:05:38'),
('8e06c093-b457-4cd2-a6ec-091d9405d88f', '<p><span style="color: rgb(35, 35, 35); font-family: Verdana, Tahoma, Arial, &#39;Helvetica Neue&#39;, Helvetica, sans-serif; font-size: 12px; background-color: rgb(255, 255, 255);"><span style="font-weight: 700; color: rgb(192, 0, 0); padding-right: 3px; font-family: tahoma, arial, 宋体; letter-spacing: 0.6666666865348816px; line-height: 28px; text-indent: 26px;">白云边酒</span><span style="color: rgb(34, 34, 34); font-family: tahoma, arial, 宋体; font-size: 13px; letter-spacing: 0.6666666865348816px; line-height: 28px; text-indent: 26px;">集茅台酱香、沪州老窖浓香、汾酒清香于一体，系独创出的一种“兼香型”白酒，闻之清香，进口浓香，回昧酱香，三香俱全，酒液清澈，酱浓谐调，醇甜爽厚，回味绵长，尤因酒脂指标偏高、醛指标偏低，且酒质厚、味醇浓、无杂质、扑鼻香，因此，白云边酒被全国酒界誉为 “湖北茅台”。畅销全国，部分产品还出口到港、澳及东南亚地区。李白诗：南湖秋水夜无烟， 耐可乘流直上天； 且就洞庭赊月色， 将船买酒白云边。湖北省白云边酒厂生产的白云边酒即以“白云边”三字名之。湖北白云边集团于1997年隆重推出六种新产品，风味独特，42°精装白云边为五年陈酿，45°精品白云边为九年陈酿，45°珍品白云边为十五年陈酿，位居白云边极品之列；32°精品白云边为九年陈酿；40°白云边金酒、银酒还开展了金、银酒送大奖的酬宾活动。</span><span style="color: rgb(35, 35, 35); font-family: Verdana, Tahoma, Arial, &#39;Helvetica Neue&#39;, Helvetica, sans-serif; font-size: 12px; background-color: rgb(255, 255, 255);"><span style="color: rgb(35, 35, 35); font-family: Verdana, Tahoma, Arial, &#39;Helvetica Neue&#39;, Helvetica, sans-serif; font-size: 12px; background-color: rgb(255, 255, 255);"><span style="color: rgb(35, 35, 35); font-family: Verdana, Tahoma, Arial, &#39;Helvetica Neue&#39;, Helvetica, sans-serif; font-size: 12px; background-color: rgb(255, 255, 255);"><span style="color: rgb(35, 35, 35); font-family: Verdana, Tahoma, Arial, &#39;Helvetica Neue&#39;, Helvetica, sans-serif; font-size: 12px; background-color: rgb(255, 255, 255);"><span style="color: rgb(35, 35, 35); font-family: Verdana, Tahoma, Arial, &#39;Helvetica Neue&#39;, Helvetica, sans-serif; font-size: 12px; background-color: rgb(255, 255, 255);"><span style="color: rgb(35, 35, 35); font-family: Verdana, Tahoma, Arial, &#39;Helvetica Neue&#39;, Helvetica, sans-serif; font-size: 12px; background-color: rgb(255, 255, 255);"><span style="color: rgb(35, 35, 35); font-family: Verdana, Tahoma, Arial, &#39;Helvetica Neue&#39;, Helvetica, sans-serif; font-size: 12px; background-color: rgb(255, 255, 255);"><span style="color: rgb(35, 35, 35); font-family: Verdana, Tahoma, Arial, &#39;Helvetica Neue&#39;, Helvetica, sans-serif; font-size: 12px; background-color: rgb(255, 255, 255);"><span style="color: rgb(35, 35, 35); font-family: Verdana, Tahoma, Arial, &#39;Helvetica Neue&#39;, Helvetica, sans-serif; font-size: 12px; background-color: rgb(255, 255, 255);"><span style="color: rgb(35, 35, 35); font-family: Verdana, Tahoma, Arial, &#39;Helvetica Neue&#39;, Helvetica, sans-serif; font-size: 12px; background-color: rgb(255, 255, 255);"><span style="color: rgb(35, 35, 35); font-family: Verdana, Tahoma, Arial, &#39;Helvetica Neue&#39;, Helvetica, sans-serif; font-size: 12px; background-color: rgb(255, 255, 255);"><span style="color: rgb(35, 35, 35); font-family: Verdana, Tahoma, Arial, &#39;Helvetica Neue&#39;, Helvetica, sans-serif; font-size: 12px; background-color: rgb(255, 255, 255);"><span style="color: rgb(35, 35, 35); font-family: Verdana, Tahoma, Arial, &#39;Helvetica Neue&#39;, Helvetica, sans-serif; font-size: 12px; background-color: rgb(255, 255, 255);"><span style="color: rgb(35, 35, 35); font-family: Verdana, Tahoma, Arial, &#39;Helvetica Neue&#39;, Helvetica, sans-serif; font-size: 12px; background-color: rgb(255, 255, 255);"><span style="color: rgb(35, 35, 35); font-family: Verdana, Tahoma, Arial, &#39;Helvetica Neue&#39;, Helvetica, sans-serif; font-size: 12px; background-color: rgb(255, 255, 255);"><span style="color: rgb(35, 35, 35); font-family: Verdana, Tahoma, Arial, &#39;Helvetica Neue&#39;, Helvetica, sans-serif; font-size: 12px; background-color: rgb(255, 255, 255);"><span style="color: rgb(35, 35, 35); font-family: Verdana, Tahoma, Arial, &#39;Helvetica Neue&#39;, Helvetica, sans-serif; font-size: 12px; background-color: rgb(255, 255, 255);"><span style="color: rgb(35, 35, 35); font-family: Verdana, Tahoma, Arial, &#39;Helvetica Neue&#39;, Helvetica, sans-serif; font-size: 12px; background-color: rgb(255, 255, 255);"><span style="color: rgb(35, 35, 35); font-family: Verdana, Tahoma, Arial, &#39;Helvetica Neue&#39;, Helvetica, sans-serif; font-size: 12px; background-color: rgb(255, 255, 255);"></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></p><p><span style="color: rgb(35, 35, 35); font-family: Verdana, Tahoma, Arial, &#39;Helvetica Neue&#39;, Helvetica, sans-serif; font-size: 12px; background-color: rgb(255, 255, 255);"><span style="color: rgb(35, 35, 35); font-family: Verdana, Tahoma, Arial, &#39;Helvetica Neue&#39;, Helvetica, sans-serif; font-size: 12px; background-color: rgb(255, 255, 255);"><span style="color: rgb(35, 35, 35); font-family: Verdana, Tahoma, Arial, &#39;Helvetica Neue&#39;, Helvetica, sans-serif; font-size: 12px; background-color: rgb(255, 255, 255);"><span style="color: rgb(35, 35, 35); font-family: Verdana, Tahoma, Arial, &#39;Helvetica Neue&#39;, Helvetica, sans-serif; font-size: 12px; background-color: rgb(255, 255, 255);"><span style="color: rgb(35, 35, 35); font-family: Verdana, Tahoma, Arial, &#39;Helvetica Neue&#39;, Helvetica, sans-serif; font-size: 12px; background-color: rgb(255, 255, 255);"><span style="color: rgb(35, 35, 35); font-family: Verdana, Tahoma, Arial, &#39;Helvetica Neue&#39;, Helvetica, sans-serif; font-size: 12px; background-color: rgb(255, 255, 255);"><span style="color: rgb(35, 35, 35); font-family: Verdana, Tahoma, Arial, &#39;Helvetica Neue&#39;, Helvetica, sans-serif; font-size: 12px; background-color: rgb(255, 255, 255);"><span style="color: rgb(35, 35, 35); font-family: Verdana, Tahoma, Arial, &#39;Helvetica Neue&#39;, Helvetica, sans-serif; font-size: 12px; background-color: rgb(255, 255, 255);"><span style="color: rgb(35, 35, 35); font-family: Verdana, Tahoma, Arial, &#39;Helvetica Neue&#39;, Helvetica, sans-serif; font-size: 12px; background-color: rgb(255, 255, 255);"><span style="color: rgb(35, 35, 35); font-family: Verdana, Tahoma, Arial, &#39;Helvetica Neue&#39;, Helvetica, sans-serif; font-size: 12px; background-color: rgb(255, 255, 255);"><span style="color: rgb(35, 35, 35); font-family: Verdana, Tahoma, Arial, &#39;Helvetica Neue&#39;, Helvetica, sans-serif; font-size: 12px; background-color: rgb(255, 255, 255);"><span style="color: rgb(35, 35, 35); font-family: Verdana, Tahoma, Arial, &#39;Helvetica Neue&#39;, Helvetica, sans-serif; font-size: 12px; background-color: rgb(255, 255, 255);"><span style="color: rgb(35, 35, 35); font-family: Verdana, Tahoma, Arial, &#39;Helvetica Neue&#39;, Helvetica, sans-serif; font-size: 12px; background-color: rgb(255, 255, 255);"><span style="color: rgb(35, 35, 35); font-family: Verdana, Tahoma, Arial, &#39;Helvetica Neue&#39;, Helvetica, sans-serif; font-size: 12px; background-color: rgb(255, 255, 255);"><span style="color: rgb(35, 35, 35); font-family: Verdana, Tahoma, Arial, &#39;Helvetica Neue&#39;, Helvetica, sans-serif; font-size: 12px; background-color: rgb(255, 255, 255);"><span style="color: rgb(35, 35, 35); font-family: Verdana, Tahoma, Arial, &#39;Helvetica Neue&#39;, Helvetica, sans-serif; font-size: 12px; background-color: rgb(255, 255, 255);"><span style="color: rgb(35, 35, 35); font-family: Verdana, Tahoma, Arial, &#39;Helvetica Neue&#39;, Helvetica, sans-serif; font-size: 12px; background-color: rgb(255, 255, 255);"><span style="color: rgb(35, 35, 35); font-family: Verdana, Tahoma, Arial, &#39;Helvetica Neue&#39;, Helvetica, sans-serif; font-size: 12px; background-color: rgb(255, 255, 255);"><span style="color: rgb(35, 35, 35); font-family: Verdana, Tahoma, Arial, &#39;Helvetica Neue&#39;, Helvetica, sans-serif; font-size: 12px; background-color: rgb(255, 255, 255);"><span style="color: rgb(35, 35, 35); font-family: Verdana, Tahoma, Arial, &#39;Helvetica Neue&#39;, Helvetica, sans-serif; font-size: 12px; background-color: rgb(255, 255, 255);"></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></p><p style="text-align: center;"><img src="/upload/image/20151120/6358361912764800009417267.jpg" style="width: 268px; height: 244px;" title="2.jpg" width="268" height="244"/></p><p style="text-align: center;"><img src="/upload/image/20151120/6358361912765600007944685.jpg" style="width: 243px; height: 266px;" title="1.jpg" width="243" height="266"/></p><p><span style="color: rgb(35, 35, 35); font-family: Verdana, Tahoma, Arial, &#39;Helvetica Neue&#39;, Helvetica, sans-serif; font-size: 12px; background-color: rgb(255, 255, 255);"><span style="color: rgb(35, 35, 35); font-family: Verdana, Tahoma, Arial, &#39;Helvetica Neue&#39;, Helvetica, sans-serif; font-size: 12px; background-color: rgb(255, 255, 255);"><span style="color: rgb(35, 35, 35); font-family: Verdana, Tahoma, Arial, &#39;Helvetica Neue&#39;, Helvetica, sans-serif; font-size: 12px; background-color: rgb(255, 255, 255);"><span style="color: rgb(35, 35, 35); font-family: Verdana, Tahoma, Arial, &#39;Helvetica Neue&#39;, Helvetica, sans-serif; font-size: 12px; background-color: rgb(255, 255, 255);"><span style="color: rgb(35, 35, 35); font-family: Verdana, Tahoma, Arial, &#39;Helvetica Neue&#39;, Helvetica, sans-serif; font-size: 12px; background-color: rgb(255, 255, 255);"><span style="color: rgb(35, 35, 35); font-family: Verdana, Tahoma, Arial, &#39;Helvetica Neue&#39;, Helvetica, sans-serif; font-size: 12px; background-color: rgb(255, 255, 255);"><span style="color: rgb(35, 35, 35); font-family: Verdana, Tahoma, Arial, &#39;Helvetica Neue&#39;, Helvetica, sans-serif; font-size: 12px; background-color: rgb(255, 255, 255);"><span style="color: rgb(35, 35, 35); font-family: Verdana, Tahoma, Arial, &#39;Helvetica Neue&#39;, Helvetica, sans-serif; font-size: 12px; background-color: rgb(255, 255, 255);"><span style="color: rgb(35, 35, 35); font-family: Verdana, Tahoma, Arial, &#39;Helvetica Neue&#39;, Helvetica, sans-serif; font-size: 12px; background-color: rgb(255, 255, 255);"><span style="color: rgb(35, 35, 35); font-family: Verdana, Tahoma, Arial, &#39;Helvetica Neue&#39;, Helvetica, sans-serif; font-size: 12px; background-color: rgb(255, 255, 255);"><span style="color: rgb(35, 35, 35); font-family: Verdana, Tahoma, Arial, &#39;Helvetica Neue&#39;, Helvetica, sans-serif; font-size: 12px; background-color: rgb(255, 255, 255);"><span style="color: rgb(35, 35, 35); font-family: Verdana, Tahoma, Arial, &#39;Helvetica Neue&#39;, Helvetica, sans-serif; font-size: 12px; background-color: rgb(255, 255, 255);"><span style="color: rgb(35, 35, 35); font-family: Verdana, Tahoma, Arial, &#39;Helvetica Neue&#39;, Helvetica, sans-serif; font-size: 12px; background-color: rgb(255, 255, 255);"><span style="color: rgb(35, 35, 35); font-family: Verdana, Tahoma, Arial, &#39;Helvetica Neue&#39;, Helvetica, sans-serif; font-size: 12px; background-color: rgb(255, 255, 255);"><span style="color: rgb(35, 35, 35); font-family: Verdana, Tahoma, Arial, &#39;Helvetica Neue&#39;, Helvetica, sans-serif; font-size: 12px; background-color: rgb(255, 255, 255);"><span style="color: rgb(35, 35, 35); font-family: Verdana, Tahoma, Arial, &#39;Helvetica Neue&#39;, Helvetica, sans-serif; font-size: 12px; background-color: rgb(255, 255, 255);"><span style="color: rgb(35, 35, 35); font-family: Verdana, Tahoma, Arial, &#39;Helvetica Neue&#39;, Helvetica, sans-serif; font-size: 12px; background-color: rgb(255, 255, 255);"><span style="color: rgb(35, 35, 35); font-family: Verdana, Tahoma, Arial, &#39;Helvetica Neue&#39;, Helvetica, sans-serif; font-size: 12px; background-color: rgb(255, 255, 255);"><span style="color: rgb(35, 35, 35); font-family: Verdana, Tahoma, Arial, &#39;Helvetica Neue&#39;, Helvetica, sans-serif; font-size: 12px; background-color: rgb(255, 255, 255);"><span style="color: rgb(35, 35, 35); font-family: Verdana, Tahoma, Arial, &#39;Helvetica Neue&#39;, Helvetica, sans-serif; font-size: 12px; background-color: rgb(255, 255, 255);"><br/></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span></span><br/></p>', '2015-11-09 10:38:13'),
('92c048d7-c9d5-424a-8ffc-da54ffdc5de7', '<p>&nbsp;</p><p><img title="TB2sJ80hVXXXXccXXXXXXXXXXXX-414148352.jpg" src="/upload/image/20151210/6358534340060500007763998.jpg"/></p><p><img title="TB2xqVZhVXXXXcrXXXXXXXXXXXX-4141483521.jpg" src="/upload/image/20151210/6358534340104300001462758.jpg"/></p><p><img title="TB2tcVShVXXXXXBXpXXXXXXXXXX-414148352.jpg" src="/upload/image/20151210/6358534343501900005466860.jpg"/></p><p><img title="TB2tsV1hVXXXXchXXXXXXXXXXXX-414148352.jpg" src="/upload/image/20151210/6358534343520200004181247.jpg"/></p><p><img title="TB2iTfObFXXXXaXXXXXXXXXXXXX-414148352.jpg" src="/upload/image/20151210/6358534343525800007694572.jpg"/></p><p><img title="TB2gep7bFXXXXbvXXXXXXXXXXXX-414148352.jpg" src="/upload/image/20151210/6358534346781300008804986.jpg"/></p><p><img title="TB2gIV_bFXXXXX8XXXXXXXXXXXX-414148352.jpg" src="/upload/image/20151210/6358534346798000002817545.jpg"/></p><p><img title="TB2epXYbFXXXXccXpXXXXXXXXXX-414148352.jpg" src="/upload/image/20151210/6358534346805400002032698.jpg"/></p><p><img title="TB2JOd.bFXXXXaKXXXXXXXXXXXX-414148352.jpg" src="/upload/image/20151210/6358534346930000001913827.jpg"/></p><p><img title="TB2LD86bFXXXXbeXpXXXXXXXXXX-414148352.jpg" src="/upload/image/20151210/6358534346964100003640772.jpg"/></p><p></p>', '2015-12-10 11:24:41'),
('a04f599d-8b4f-4c01-9e41-0162ba0dff22', '<p>42.8度毛铺苦荞酒黑荞500ml瓶装</p><p>劲酒集团正品。<span style="color: rgb(192, 0, 0);"><strong>每瓶超级返利<span style="color: rgb(255, 0, 0); font-size: 24px;">10</span>元！</strong></span>&nbsp;</p><p>&nbsp;</p><p><img title="图像 44.jpg" src="/upload/image/20151210/6358534014257500003839198.jpg"/></p><p><img title="图像 45.jpg" src="/upload/image/20151210/6358534014268300008040259.jpg"/></p><p><img title="细节.jpg" src="/upload/image/20151210/6358534014294100008795388.jpg"/></p><p><img title="图像 48.jpg" src="/upload/image/20151210/6358534014431000002404995.jpg"/></p><p><img title="图像 46.jpg" src="/upload/image/20151210/6358534014539300006800983.jpg"/></p><p><img title="图像 49.jpg" src="/upload/image/20151210/6358534014668900002668020.jpg"/></p><p></p>', '2015-12-10 10:31:03'),
('a8d9add9-a9c2-4e61-b0ce-b65cb3cf2172', '<p><span style="color: rgb(35, 35, 35); font-family: Verdana, Tahoma, Arial, &#39;Helvetica Neue&#39;, Helvetica, sans-serif; font-size: 12px; background-color: rgb(255, 255, 255);">长城至醇<span style="color: rgb(35, 35, 35); font-family: Verdana, Tahoma, Arial, &#39;Helvetica Neue&#39;, Helvetica, sans-serif; font-size: 12px; background-color: rgb(255, 255, 255);">长城至醇<span style="color: rgb(35, 35, 35); font-family: Verdana, Tahoma, Arial, &#39;Helvetica Neue&#39;, Helvetica, sans-serif; font-size: 12px; background-color: rgb(255, 255, 255);">长城至醇<span style="color: rgb(35, 35, 35); font-family: Verdana, Tahoma, Arial, &#39;Helvetica Neue&#39;, Helvetica, sans-serif; font-size: 12px; background-color: rgb(255, 255, 255);">长城至醇<span style="color: rgb(35, 35, 35); font-family: Verdana, Tahoma, Arial, &#39;Helvetica Neue&#39;, Helvetica, sans-serif; font-size: 12px; background-color: rgb(255, 255, 255);">长城至醇<span style="color: rgb(35, 35, 35); font-family: Verdana, Tahoma, Arial, &#39;Helvetica Neue&#39;, Helvetica, sans-serif; font-size: 12px; background-color: rgb(255, 255, 255);">长城至醇<span style="color: rgb(35, 35, 35); font-family: Verdana, Tahoma, Arial, &#39;Helvetica Neue&#39;, Helvetica, sans-serif; font-size: 12px; background-color: rgb(255, 255, 255);">长城至醇<span style="color: rgb(35, 35, 35); font-family: Verdana, Tahoma, Arial, &#39;Helvetica Neue&#39;, Helvetica, sans-serif; font-size: 12px; background-color: rgb(255, 255, 255);">长城至醇</span></span></span></span></span></span></span></span></p>', '2015-11-11 09:48:20'),
('b8fd47f1-2f93-43ed-bd10-d23faa81fe50', '<p><span style="color: rgb(35, 35, 35); font-family: Verdana, Tahoma, Arial, &#39;Helvetica Neue&#39;, Helvetica, sans-serif; font-size: 12px; background-color: rgb(255, 255, 255);">白云边12年<span style="color: rgb(35, 35, 35); font-family: Verdana, Tahoma, Arial, &#39;Helvetica Neue&#39;, Helvetica, sans-serif; font-size: 12px; background-color: rgb(255, 255, 255);">白云边12年<span style="color: rgb(35, 35, 35); font-family: Verdana, Tahoma, Arial, &#39;Helvetica Neue&#39;, Helvetica, sans-serif; font-size: 12px; background-color: rgb(255, 255, 255);">白云边12年<span style="color: rgb(35, 35, 35); font-family: Verdana, Tahoma, Arial, &#39;Helvetica Neue&#39;, Helvetica, sans-serif; font-size: 12px; background-color: rgb(255, 255, 255);">白云边12年<span style="color: rgb(35, 35, 35); font-family: Verdana, Tahoma, Arial, &#39;Helvetica Neue&#39;, Helvetica, sans-serif; font-size: 12px; background-color: rgb(255, 255, 255);">白云边12年<span style="color: rgb(35, 35, 35); font-family: Verdana, Tahoma, Arial, &#39;Helvetica Neue&#39;, Helvetica, sans-serif; font-size: 12px; background-color: rgb(255, 255, 255);">白云边12年<span style="color: rgb(35, 35, 35); font-family: Verdana, Tahoma, Arial, &#39;Helvetica Neue&#39;, Helvetica, sans-serif; font-size: 12px; background-color: rgb(255, 255, 255);">白云边12年<span style="color: rgb(35, 35, 35); font-family: Verdana, Tahoma, Arial, &#39;Helvetica Neue&#39;, Helvetica, sans-serif; font-size: 12px; background-color: rgb(255, 255, 255);">白云边12年<span style="color: rgb(35, 35, 35); font-family: Verdana, Tahoma, Arial, &#39;Helvetica Neue&#39;, Helvetica, sans-serif; font-size: 12px; background-color: rgb(255, 255, 255);">白云边12年</span></span></span></span></span></span></span></span></span></p>', '2015-11-11 09:47:48'),
('be9b40d4-067b-4110-b516-cabcdc117543', '<p>&nbsp;<img title="843420784.jpg" alt="843420784.jpg" src="/upload/image/20151210/6358535129763800003385164.jpg"/><img title="TB2iOBSfpXXXXbmXXXXXXXXXXXX_!!843420784.jpg" alt="TB2iOBSfpXXXXbmXXXXXXXXXXXX_!!843420784.jpg" src="/upload/image/20151210/6358535130929300001784840.jpg"/><img title="02.jpg" alt="02.jpg" src="/upload/image/20151210/6358535141127000009783053.jpg"/><img title="04.jpg" alt="04.jpg" src="/upload/image/20151210/6358535142449000003735969.jpg"/></p>', '2015-12-10 13:36:03'),
('c7f9d350-d830-4231-867c-2f2baa928e99', '<p><span style="color: rgb(35, 35, 35); font-family: Verdana, Tahoma, Arial, &#39;Helvetica Neue&#39;, Helvetica, sans-serif; font-size: 12px; background-color: rgb(255, 255, 255);">奔富洛神<span style="color: rgb(35, 35, 35); font-family: Verdana, Tahoma, Arial, &#39;Helvetica Neue&#39;, Helvetica, sans-serif; font-size: 12px; background-color: rgb(255, 255, 255);">奔富洛神<span style="color: rgb(35, 35, 35); font-family: Verdana, Tahoma, Arial, &#39;Helvetica Neue&#39;, Helvetica, sans-serif; font-size: 12px; background-color: rgb(255, 255, 255);">奔富洛神<span style="color: rgb(35, 35, 35); font-family: Verdana, Tahoma, Arial, &#39;Helvetica Neue&#39;, Helvetica, sans-serif; font-size: 12px; background-color: rgb(255, 255, 255);">奔富洛神<span style="color: rgb(35, 35, 35); font-family: Verdana, Tahoma, Arial, &#39;Helvetica Neue&#39;, Helvetica, sans-serif; font-size: 12px; background-color: rgb(255, 255, 255);">奔富洛神<span style="color: rgb(35, 35, 35); font-family: Verdana, Tahoma, Arial, &#39;Helvetica Neue&#39;, Helvetica, sans-serif; font-size: 12px; background-color: rgb(255, 255, 255);">奔富洛神</span></span></span></span></span></span></p>', '2015-11-11 09:48:31'),
('dd3482d7-a5cf-4d0a-86e2-3dcda1d4e52b', '<p>\r\n	<br />\r\n</p>\r\n<p>\r\n	法国梦德城堡干红。城堡级AOC！是庄园主自己确定的比普通AOC品质更高更严的标准！\r\n</p>\r\n<p>\r\n	因此城堡级AOC比普通法国AOC品质更好！价格差不多，更具性价比！\r\n</p>\r\n<p>\r\n	<br />\r\n</p>\r\n<p>\r\n	梦德城堡干红是一款获金奖的产品，因此也获得法国专业酒评杂志《HACHETTE》推荐！\r\n</p>\r\n<p>\r\n	提酒客对家代理这款市场价上千多的好酒，原产地直供，经过多次谈判，终于可以让您以最优惠的价格品尝过！\r\n</p>\r\n<p>\r\n	每瓶只要268元！通过APP返利，可直接返利98元。\r\n</p>\r\n<p>\r\n	<br />\r\n</p>\r\n<p>\r\n	原装实木箱，进口未拆箱，高端大气有品位。一箱6瓶，绝对是替代茅台五粮液的送礼佳品！\r\n</p>\r\n<p>\r\n	<br />\r\n</p>\r\n<h3>\r\n	<span>商品特点</span> \r\n</h3>\r\n<div class="infoImg">\r\n	<p>\r\n		<img alt="" src="http://img07.jiuxian.com/brandlogo/2017/0227/3c841a05d1a541b29fcf9cd701017ef2.jpg" /><img alt="" src="http://img08.jiuxian.com/brandlogo/2017/0227/8fba7c8ae82e47759011e6562e2c1979.jpg" /><img alt="" src="http://img06.jiuxian.com/brandlogo/2017/0227/e9b94364d609420288dc7feab580d269.jpg" /><img alt="" src="http://img08.jiuxian.com/brandlogo/2017/0227/115c2b7e083c4fd886792d7de6f8c5ea.jpg" style="height:656px;width:790px;" /><img alt="" src="http://img06.jiuxian.com/brandlogo/2017/0227/0dc11f17683d4d41a2249e8707130cd7.jpg" /> \r\n	</p>\r\n</div>\r\n<p>\r\n	<br />\r\n</p>\r\n<p>\r\n	<img title="001.jpg" src="/upload/image/20151210/6358535864855200007178443.jpg" /> \r\n</p>\r\n<p>\r\n	<img title="002.jpg" src="/upload/image/20151210/6358535864884500003919480.jpg" /> \r\n</p>\r\n<p>\r\n	<br />\r\n</p>', '2015-12-10 15:46:02'),
('e5777f9a-d069-4cc7-99be-0fe6d87bc2ea', '<p><span style="color: rgb(35, 35, 35); font-family: Verdana, Tahoma, Arial, &#39;Helvetica Neue&#39;, Helvetica, sans-serif; font-size: 12px; background-color: rgb(255, 255, 255);">法国瑞斯银爵<span style="color: rgb(35, 35, 35); font-family: Verdana, Tahoma, Arial, &#39;Helvetica Neue&#39;, Helvetica, sans-serif; font-size: 12px; background-color: rgb(255, 255, 255);">法国瑞斯银爵<span style="color: rgb(35, 35, 35); font-family: Verdana, Tahoma, Arial, &#39;Helvetica Neue&#39;, Helvetica, sans-serif; font-size: 12px; background-color: rgb(255, 255, 255);">法国瑞斯银爵<span style="color: rgb(35, 35, 35); font-family: Verdana, Tahoma, Arial, &#39;Helvetica Neue&#39;, Helvetica, sans-serif; font-size: 12px; background-color: rgb(255, 255, 255);">法国瑞斯银爵<span style="color: rgb(35, 35, 35); font-family: Verdana, Tahoma, Arial, &#39;Helvetica Neue&#39;, Helvetica, sans-serif; font-size: 12px; background-color: rgb(255, 255, 255);">法国瑞斯银爵<span style="color: rgb(35, 35, 35); font-family: Verdana, Tahoma, Arial, &#39;Helvetica Neue&#39;, Helvetica, sans-serif; font-size: 12px; background-color: rgb(255, 255, 255);">法国瑞斯银爵<span style="color: rgb(35, 35, 35); font-family: Verdana, Tahoma, Arial, &#39;Helvetica Neue&#39;, Helvetica, sans-serif; font-size: 12px; background-color: rgb(255, 255, 255);">法国瑞斯银爵</span></span></span></span></span></span></span></p>', '2015-11-11 09:48:56'),
('mJDZ3DZ202BdInpppz0q', '<img style="max-width:750.0px;" src="https://img.alicdn.com/imgextra/i2/2629966267/TB2T_L6eypnpuFjSZFkXXc4ZpXa_%21%212629966267.jpg" align="absmiddle" /><img style="max-width:750.0px;" src="https://img.alicdn.com/imgextra/i2/2629966267/TB2QAfTestnpuFjSZFKXXalFFXa_%21%212629966267.jpg" align="absmiddle" /><img style="max-width:750.0px;" src="https://img.alicdn.com/imgextra/i2/2629966267/TB2B5z9etXnpuFjSZFoXXXLcpXa_%21%212629966267.jpg" align="absmiddle" /><img style="max-width:750.0px;" src="https://img.alicdn.com/imgextra/i2/2629966267/TB21RY6eC0mpuFjSZPiXXbssVXa_%21%212629966267.jpg" align="absmiddle" /><img style="max-width:750.0px;" src="https://img.alicdn.com/imgextra/i2/2629966267/TB22F6JextmpuFjSZFqXXbHFpXa_%21%212629966267.jpg" class="" align="absmiddle" height="400" width="750" /><img style="max-width:750.0px;" src="https://img.alicdn.com/imgextra/i4/2629966267/TB2UEF8dR0kpuFjSsppXXcGTXXa_%21%212629966267.jpg" class="" align="absmiddle" height="750" width="750" /><img style="max-width:750.0px;" src="https://img.alicdn.com/imgextra/i4/2629966267/TB2kJRIdSBjpuFjy1XdXXaooVXa_%21%212629966267.jpg" class="" align="absmiddle" height="750" width="750" />', '2017-04-14 11:09:06'),
('pKfHwiaNRO', '<img class="desc_anchor img-ks-lazyload" id="desc-module-2" src="https://assets.alicdn.com/kissy/1.0.0/build/imglazyload/spaceball.gif" /><img src="https://img.alicdn.com/imgextra/i2/1657921350/TB2eoRHbOGO.eBjSZFEXXcy9VXa_%21%211657921350.jpg" style="line-height:1.5;" class="img-ks-lazyload" align="absmiddle" /><img src="https://img.alicdn.com/imgextra/i3/1657921350/TB2PqCVaJuO.eBjSZFCXXXULFXa_%21%211657921350.jpg" style="line-height:1.5;" class="img-ks-lazyload" align="absmiddle" /><img src="https://img.alicdn.com/imgextra/i1/1657921350/TB2HcKOaUWO.eBjSZPcXXbopVXa_%21%211657921350.jpg" style="line-height:1.5;" class="img-ks-lazyload" align="absmiddle" /><img src="https://img.alicdn.com/imgextra/i3/1657921350/TB2sIvzaq9I.eBjy0FeXXXqwFXa_%21%211657921350.jpg" style="line-height:1.5;" class="img-ks-lazyload" align="absmiddle" /><img src="https://img.alicdn.com/imgextra/i3/1657921350/TB2R_aUaOGO.eBjSZFPXXcKCXXa_%21%211657921350.jpg" style="line-height:1.5;" class="img-ks-lazyload" align="absmiddle" /><img src="https://img.alicdn.com/imgextra/i1/1657921350/TB2OyvBaseJ.eBjy0FiXXXqapXa_%21%211657921350.jpg" style="line-height:1.5;" class="img-ks-lazyload" align="absmiddle" /><img src="https://img.alicdn.com/imgextra/i2/1657921350/TB2nSHHar5K.eBjy0FnXXaZzVXa_%21%211657921350.jpg" style="line-height:1.5;" class="img-ks-lazyload" align="absmiddle" /><img src="https://img.alicdn.com/imgextra/i1/1657921350/TB2nN2Aar5K.eBjy0FfXXbApVXa_%21%211657921350.jpg" style="line-height:1.5;" class="img-ks-lazyload" align="absmiddle" /><img src="https://img.alicdn.com/imgextra/i4/1657921350/TB2fiuVaSiK.eBjSZFsXXbxZpXa_%21%211657921350.jpg" style="line-height:1.5;" class="img-ks-lazyload" align="absmiddle" /><img src="https://img.alicdn.com/imgextra/i3/1657921350/TB2VQCVaQ5M.eBjSZFrXXXPgVXa_%21%211657921350.jpg" style="line-height:1.5;" class="img-ks-lazyload" align="absmiddle" /><img src="https://img.alicdn.com/imgextra/i4/1657921350/TB299C5aICO.eBjSZFzXXaRiVXa_%21%211657921350.jpg" style="line-height:1.5;" class="img-ks-lazyload" align="absmiddle" /><img src="https://img.alicdn.com/imgextra/i1/1657921350/TB2HbCSaLOM.eBjSZFqXXculVXa_%21%211657921350.jpg" style="line-height:1.5;" class="img-ks-lazyload" align="absmiddle" /><img src="https://img.alicdn.com/imgextra/i1/1657921350/TB26TTBaCuJ.eBjy0FgXXXBBXXa_%21%211657921350.jpg" style="line-height:1.5;" class="img-ks-lazyload" align="absmiddle" /><img src="https://img.alicdn.com/imgextra/i4/1657921350/TB2A4DIasaK.eBjSspjXXXL.XXa_%21%211657921350.jpg" style="line-height:1.5;" class="img-ks-lazyload" align="absmiddle" /><img src="https://img.alicdn.com/imgextra/i4/1657921350/TB2NriYaRyN.eBjSZFgXXXmGXXa_%21%211657921350.jpg" style="line-height:1.5;" class="img-ks-lazyload" align="absmiddle" /><img src="https://img.alicdn.com/imgextra/i1/1657921350/TB29DKSaPm2.eBjSZFtXXX56VXa_%21%211657921350.jpg" style="line-height:1.5;" class="img-ks-lazyload" align="absmiddle" /><img src="https://img.alicdn.com/imgextra/i1/1657921350/TB2e6zJawSI.eBjy1XcXXc1jXXa_%21%211657921350.jpg" style="line-height:1.5;" class="img-ks-lazyload" align="absmiddle" />', '2017-04-14 11:08:07');

-- --------------------------------------------------------

--
-- 表的结构 `commoditystock`
--

CREATE TABLE IF NOT EXISTS `commoditystock` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Stock` int(11) DEFAULT NULL,
  `CommodityId` varchar(255) DEFAULT NULL,
  `CommercialUser` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=gb2312 AUTO_INCREMENT=27 ;

--
-- 转存表中的数据 `commoditystock`
--

INSERT INTO `commoditystock` (`id`, `Stock`, `CommodityId`, `CommercialUser`) VALUES
(3, 77, '8e06c093-b457-4cd2-a6ec-091d9405d88f', 'admin'),
(4, 1, '8e06c093-b457-4cd2-a6ec-091d9405d88f', 'test'),
(5, 4, '7253ef6f-3df4-4ecd-a910-989f7244a071', 'test'),
(6, 5, '536913a7-fef3-4594-8d6a-597076565058', 'test'),
(7, 100, '8e06c093-b457-4cd2-a6ec-091d9405d88f', 'ggd'),
(8, 20, 'b8fd47f1-2f93-43ed-bd10-d23faa81fe50', 'ggd'),
(9, 30, '67bf2de4-9827-4a5f-822f-8eda5bd31936', 'ggd'),
(10, 50, '7253ef6f-3df4-4ecd-a910-989f7244a071', 'ggd'),
(11, 100, 'a8d9add9-a9c2-4e61-b0ce-b65cb3cf2172', 'ggd'),
(12, 100, 'c7f9d350-d830-4231-867c-2f2baa928e99', 'ggd'),
(13, 20, '01a15fbc-fec2-42ee-9eed-d749cfe1c0d2', 'ggd'),
(14, 20, '85f664da-1c87-4e8e-ba9d-5973468523d7', 'ggd'),
(15, 10, 'e5777f9a-d069-4cc7-99be-0fe6d87bc2ea', 'ggd'),
(16, 50, '8e06c093-b457-4cd2-a6ec-091d9405d88f', 'test1'),
(17, 50, 'b8fd47f1-2f93-43ed-bd10-d23faa81fe50', 'test1'),
(18, 50, '67bf2de4-9827-4a5f-822f-8eda5bd31936', 'test1'),
(19, 98, 'dd3482d7-a5cf-4d0a-86e2-3dcda1d4e52b', 'admin'),
(20, 97, 'dd3482d7-a5cf-4d0a-86e2-3dcda1d4e52b', 'test1'),
(21, 99, 'dd3482d7-a5cf-4d0a-86e2-3dcda1d4e52b', 'test'),
(22, 99, 'dd3482d7-a5cf-4d0a-86e2-3dcda1d4e52b', 'ggd'),
(23, 99, 'dd3482d7-a5cf-4d0a-86e2-3dcda1d4e52b', 'test2'),
(24, 99, '66368fea-af22-439e-bbde-e52af1fc4847', 'test2'),
(25, 99, 'dd3482d7-a5cf-4d0a-86e2-3dcda1d4e52b', 'test3'),
(26, 99, '66368fea-af22-439e-bbde-e52af1fc4847', 'test3');

-- --------------------------------------------------------

--
-- 表的结构 `expense`
--

CREATE TABLE IF NOT EXISTS `expense` (
  `Id` varchar(100) NOT NULL,
  `Usnumber` varchar(100) DEFAULT NULL,
  `CreateTime` datetime DEFAULT NULL,
  `Number` int(11) DEFAULT NULL,
  `Commodity` varchar(500) DEFAULT NULL,
  `Money` varchar(500) DEFAULT NULL,
  `Commercial` varchar(100) DEFAULT NULL,
  `StandbyOne` varchar(500) DEFAULT NULL,
  `StandbyTwo` varchar(500) DEFAULT NULL,
  `StandbyThree` varchar(500) DEFAULT NULL,
  `StandbyFore` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=gb2312;

-- --------------------------------------------------------

--
-- 表的结构 `gutuidevices`
--

CREATE TABLE IF NOT EXISTS `gutuidevices` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ClientId` varchar(500) DEFAULT NULL,
  `DeviceType` varchar(255) DEFAULT NULL,
  `Account` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=gb2312 AUTO_INCREMENT=18 ;

--
-- 转存表中的数据 `gutuidevices`
--

INSERT INTO `gutuidevices` (`id`, `ClientId`, `DeviceType`, `Account`) VALUES
(1, '12345678900', '0', '13554142951'),
(2, '864121017036350', '0', NULL),
(4, '4fa07b4986eeb5b3d4648b48f09b5c04', '0', '13554110890'),
(5, 'cc36b58846f10ac2ca3236b85a7e8c80', '0', '13872213857'),
(6, '352746067439226', '0', '13618633380'),
(7, '860954025331635', '0', '13260539571'),
(8, 'f973e1c83194d262cdbda07c0b369509', '0', '13797067530'),
(9, '44b459ea4d4989d146e7fcc2bf4e320f', '0', '13307133041'),
(10, 'eeb0ac6981c0153c2280210bb3d5b033', '0', '15902736382'),
(11, '3a735db8d5ae8dbfdd463be97819a5d3', '0', '13554090436'),
(12, '976b06d07f8cfce39f083b5242637d4b', '0', '15629009555'),
(13, 'c8c9612c5c0f43f3065f8172b5a9bb73', '0', '18064017548'),
(14, NULL, NULL, NULL),
(15, NULL, NULL, NULL),
(16, NULL, NULL, NULL),
(17, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- 表的结构 `memberuser`
--

CREATE TABLE IF NOT EXISTS `memberuser` (
  `Id` varchar(100) NOT NULL,
  `UserName` varchar(100) DEFAULT NULL,
  `Alias` varchar(100) DEFAULT NULL,
  `Age` varchar(100) DEFAULT NULL,
  `Sex` varchar(100) DEFAULT NULL,
  `Phone` varchar(100) DEFAULT NULL,
  `IdNumber` varchar(100) DEFAULT NULL,
  `Account` varchar(100) DEFAULT NULL,
  `Password` varchar(500) DEFAULT NULL,
  `CreatTime` datetime DEFAULT NULL,
  `Image` varchar(500) DEFAULT NULL,
  `BgImage` varchar(500) DEFAULT NULL,
  `Balance` varchar(500) DEFAULT NULL,
  `JiuQian` varchar(500) DEFAULT NULL,
  `StandbyTwo` varchar(500) DEFAULT NULL,
  `StandbyThree` varchar(500) DEFAULT NULL,
  `StandbyFore` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=gb2312;

--
-- 转存表中的数据 `memberuser`
--

INSERT INTO `memberuser` (`Id`, `UserName`, `Alias`, `Age`, `Sex`, `Phone`, `IdNumber`, `Account`, `Password`, `CreatTime`, `Image`, `BgImage`, `Balance`, `JiuQian`, `StandbyTwo`, `StandbyThree`, `StandbyFore`) VALUES
('5abc4eb6-2f52-4726-a328-3f352e340676', 'wu', '不知道', NULL, NULL, NULL, NULL, '13554090436', 'SPhDOacwzcI=', NULL, NULL, NULL, NULL, '451.94', NULL, NULL, NULL),
('67ff3ef1-cb5b-49da-a458-94e527ed3295', '张三', NULL, '', '', '13554142951', '', '13554142951', '6u1n1q7jQ5A=', NULL, '', NULL, '', NULL, NULL, NULL, NULL),
('823a1f7f-c7fe-4b47-9767-7b2800b5ea43', 'ak47', 'ak47', NULL, NULL, NULL, NULL, '13797067530', 'KemNEbrl93w=', NULL, NULL, '2130837584', NULL, '459.74', NULL, NULL, NULL),
('901e83bb-2a4f-4ab1-b72b-e4a08a0eb77a', 'wuleizhangyu', NULL, NULL, NULL, '13618633380', NULL, '13618633380', 'pxCHVqhnVl0=', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('99aefa94-ee93-42a4-85df-d0aa8c55ebea', '真的', NULL, NULL, NULL, '13207129329', NULL, '13207129329', 'HUX+7VtHgb0=', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('bcf9a7a8-5e6f-4a89-9992-39e047bf41f4', '玲', '馨馨', '2012-10-07', '女', '13645789656', NULL, '13872213857', 'HUX+7VtHgb0=', NULL, 'this is a test.', '2130837594', NULL, '60', NULL, NULL, NULL),
('be85ca31-fe7d-4c1e-9683-d3f15d25e103', NULL, '风天翊翔', NULL, NULL, NULL, NULL, '18064017548', 'PFDHURMJoeTdqzGy43SGUg==', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('c5ed4568-39dc-4d7b-8d41-fab9f4b19c1b', NULL, 'Wang', NULL, NULL, NULL, NULL, '13554110890', 'PXWVqYv/gJ1e7qlmi0f0pQ==', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('f163cac2-3ecd-488a-9998-669f00b0e574', '张超', '张超', '2015-08-28', '男', '15629009555', NULL, '15629009555', 'Qk3VCOFdNnw=', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('f2b39800-234d-47d1-a2f4-83f896c9f380', '春节快乐', NULL, NULL, NULL, '13260539571', NULL, '13260539571', 'HUX+7VtHgb0=', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- 表的结构 `messagecolumn`
--

CREATE TABLE IF NOT EXISTS `messagecolumn` (
  `Id` varchar(100) NOT NULL,
  `Title` varchar(100) DEFAULT NULL,
  `Content` longtext,
  `Images` varchar(500) DEFAULT NULL,
  `CreateTime` datetime DEFAULT NULL,
  `StandbyOne` varchar(500) DEFAULT NULL,
  `StandbyTwo` varchar(500) DEFAULT NULL,
  `StandbyThree` varchar(500) DEFAULT NULL,
  `StandbyFore` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=gb2312;

-- --------------------------------------------------------

--
-- 表的结构 `ordercommodity`
--

CREATE TABLE IF NOT EXISTS `ordercommodity` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `OrderId` varchar(100) DEFAULT NULL,
  `CommodityId` varchar(100) DEFAULT NULL,
  `Quantity` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=gb2312 AUTO_INCREMENT=242 ;

--
-- 转存表中的数据 `ordercommodity`
--

INSERT INTO `ordercommodity` (`id`, `OrderId`, `CommodityId`, `Quantity`) VALUES
(170, '2016bb3d-253d-4cda-9195-4e2352dc72b4', '8e06c093-b457-4cd2-a6ec-091d9405d88f', '1'),
(171, '95368120-4ac7-42ce-9564-7bd15982fac7', '8e06c093-b457-4cd2-a6ec-091d9405d88f', '1'),
(173, 'aca2238b-326c-41cd-b30c-8d1322453113', '8e06c093-b457-4cd2-a6ec-091d9405d88f', '1'),
(174, '7453e1cc-4d79-42df-9800-17f66abb4f10', '8e06c093-b457-4cd2-a6ec-091d9405d88f', '1'),
(175, 'f20e38d2-3326-4235-a3bb-6f561d5a1773', '8e06c093-b457-4cd2-a6ec-091d9405d88f', '1'),
(176, '1d2e1e25-6567-42fd-924a-e712ab5844cf', '8e06c093-b457-4cd2-a6ec-091d9405d88f', '1'),
(177, '99775bf2-9244-4a59-b865-d106492e7fe4', '8e06c093-b457-4cd2-a6ec-091d9405d88f', '1'),
(178, '77bfc59f-0f30-4661-b9f1-cfef260916a2', '8e06c093-b457-4cd2-a6ec-091d9405d88f', '1'),
(179, '7ec9b3bb-20f1-450e-9580-307bb975dcd1', '8e06c093-b457-4cd2-a6ec-091d9405d88f', '1'),
(180, '0b150969-2226-4399-8296-acd7010b8e85', '8e06c093-b457-4cd2-a6ec-091d9405d88f', '4'),
(181, '58d53a7b-8e93-4b87-945d-4d1dd3a5aa34', '8e06c093-b457-4cd2-a6ec-091d9405d88f', '1'),
(182, '5647de37-07ce-472a-887e-8f7457ab138f', '8e06c093-b457-4cd2-a6ec-091d9405d88f', '4'),
(183, '4cf7fa74-a079-4c30-98d2-d1ddbb627e67', '8e06c093-b457-4cd2-a6ec-091d9405d88f', '4'),
(184, '864de6da-42fb-4008-a485-17adf9e46a21', '8e06c093-b457-4cd2-a6ec-091d9405d88f', '4'),
(185, 'd8d43c96-f84c-472e-a9fa-8c758bd05078', '8e06c093-b457-4cd2-a6ec-091d9405d88f', '1'),
(186, 'fbeaa618-40cb-4f1b-ae42-7a37c675373e', '8e06c093-b457-4cd2-a6ec-091d9405d88f', '1'),
(187, '816bdcc6-6731-431a-8f73-e1adf8004234', '8e06c093-b457-4cd2-a6ec-091d9405d88f', '1'),
(188, '784ed7fa-f8df-4f82-b11e-051a2dc79bd9', '8e06c093-b457-4cd2-a6ec-091d9405d88f', '1'),
(189, '04dccc81-9898-4fc5-8030-16c91287e587', '8e06c093-b457-4cd2-a6ec-091d9405d88f', '3'),
(190, '2016eae0-f317-476a-aa39-64d66f2d2a47', '8e06c093-b457-4cd2-a6ec-091d9405d88f', '1'),
(191, 'dddb5ceb-01db-49c6-9238-65bf918a0a0a', '8e06c093-b457-4cd2-a6ec-091d9405d88f', '1'),
(192, 'cd00d2ae-1339-424a-adb1-62261b5ceb29', 'b8fd47f1-2f93-43ed-bd10-d23faa81fe50', '5'),
(193, '971190dd-0385-4456-97bd-aafb3b9b7712', 'dd3482d7-a5cf-4d0a-86e2-3dcda1d4e52b', '1'),
(194, 'af22992c-9ba2-4b7b-84a2-0c2eb26eb946', 'b8fd47f1-2f93-43ed-bd10-d23faa81fe50', '5'),
(195, 'af22992c-9ba2-4b7b-84a2-0c2eb26eb946', 'dd3482d7-a5cf-4d0a-86e2-3dcda1d4e52b', '1'),
(196, '8623833c-f29f-4d25-8013-b8e65f3a390a', '6c55cecb-0795-4044-95a4-c1fce8370265', '1'),
(197, '0d7e09c3-cb78-469d-b1b3-a68c41e4c95e', '6c55cecb-0795-4044-95a4-c1fce8370265', '1'),
(198, 'adb8cb92-f47b-4ee7-8271-3cbf9f4302d9', 'dd3482d7-a5cf-4d0a-86e2-3dcda1d4e52b', '1'),
(199, 'cef397fc-fa66-4b1a-96ba-d0718626e601', '851b35b3-84cd-490d-a3c4-d581e09a4f35', '1'),
(200, 'cef397fc-fa66-4b1a-96ba-d0718626e601', '66368fea-af22-439e-bbde-e52af1fc4847', '1'),
(201, 'cef397fc-fa66-4b1a-96ba-d0718626e601', 'be9b40d4-067b-4110-b516-cabcdc117543', '1'),
(202, '9f52586c-1675-4f28-844f-27ad9538b2df', 'b8fd47f1-2f93-43ed-bd10-d23faa81fe50', '5'),
(203, '9f52586c-1675-4f28-844f-27ad9538b2df', 'dd3482d7-a5cf-4d0a-86e2-3dcda1d4e52b', '1'),
(204, 'a4df52db-cf46-49f4-ae97-16a66bc9fda4', '851b35b3-84cd-490d-a3c4-d581e09a4f35', '1'),
(205, 'a4df52db-cf46-49f4-ae97-16a66bc9fda4', '66368fea-af22-439e-bbde-e52af1fc4847', '1'),
(206, '9559dfff-d82a-4629-a95c-120f42fd2359', 'dd3482d7-a5cf-4d0a-86e2-3dcda1d4e52b', '1'),
(207, '6561a09e-dbbb-4bf9-af29-67fa62320598', '66368fea-af22-439e-bbde-e52af1fc4847', '1'),
(210, 'c16af399-26b5-47a0-aaf3-3c07f9fab8f4', 'dd3482d7-a5cf-4d0a-86e2-3dcda1d4e52b', '1'),
(211, '32fba6a9-0ccd-4d30-8f3e-eaf5e8729c2d', 'dd3482d7-a5cf-4d0a-86e2-3dcda1d4e52b', '1'),
(212, '6aa305f3-22d8-4e17-a217-3f6188d5434e', 'dd3482d7-a5cf-4d0a-86e2-3dcda1d4e52b', '1'),
(213, '7faa0415-b6e3-4962-80a9-6d69ff800362', 'dd3482d7-a5cf-4d0a-86e2-3dcda1d4e52b', '1'),
(214, '6e8080f7-7ef1-4116-a67e-a4e9572e0e4b', 'dd3482d7-a5cf-4d0a-86e2-3dcda1d4e52b', '1'),
(215, '2129a679-ad31-469c-b5d2-1388c77a05e8', 'dd3482d7-a5cf-4d0a-86e2-3dcda1d4e52b', '1'),
(216, 'cc9245c4-04e6-4e59-a429-70677d0ba842', 'dd3482d7-a5cf-4d0a-86e2-3dcda1d4e52b', '1'),
(217, '2ecf86bc-49e0-48ab-a096-8ee4ef382951', 'dd3482d7-a5cf-4d0a-86e2-3dcda1d4e52b', '1'),
(218, '0424674c-604a-400f-8ca9-32079cc63ef9', 'dd3482d7-a5cf-4d0a-86e2-3dcda1d4e52b', '1'),
(219, '46b8ef26-022c-4d6c-a211-dfd96046a0e0', 'dd3482d7-a5cf-4d0a-86e2-3dcda1d4e52b', '1'),
(220, '9a650ecf-67b7-47dd-9575-f02586e33dd3', '8e06c093-b457-4cd2-a6ec-091d9405d88f', '1'),
(221, 'a11559c0-2cd4-4797-8190-37fd74720b24', '92c048d7-c9d5-424a-8ffc-da54ffdc5de7', '2'),
(222, 'db405714-0616-4e12-8b5f-d878c044b1c0', '6c55cecb-0795-4044-95a4-c1fce8370265', '1'),
(223, '26f3463e-0299-4cec-8fb5-5acf8308dd13', '883c83e0-4768-4fcf-83c2-84b0c316f9b9', '1'),
(224, '366b9c49-04c1-49ff-8cad-24486fe2e2ba', 'dd3482d7-a5cf-4d0a-86e2-3dcda1d4e52b', '1'),
(225, 'e27930df-95c6-4c64-a021-56614cb5c90a', 'dd3482d7-a5cf-4d0a-86e2-3dcda1d4e52b', '1'),
(226, 'd5f24719-6ee7-4cdb-9834-b20c06ba7c85', 'dd3482d7-a5cf-4d0a-86e2-3dcda1d4e52b', '1'),
(227, '7fe3831c-01c0-461f-84d8-44816623001c', '8e06c093-b457-4cd2-a6ec-091d9405d88f', '1'),
(228, '9a6af452-d9bd-48ac-8a64-499da85ce0e9', '8e06c093-b457-4cd2-a6ec-091d9405d88f', '1'),
(234, '9b898a14-b7af-41c6-b99f-71a1a6da0859', '66368fea-af22-439e-bbde-e52af1fc4847', '1'),
(235, '6639df4f-016b-4e49-8cb0-4774bc4b7ce5', '66368fea-af22-439e-bbde-e52af1fc4847', '1'),
(238, '5fec75b0-3e9f-464d-9be3-9c6aba0e09a9', 'dd3482d7-a5cf-4d0a-86e2-3dcda1d4e52b', '1'),
(239, '19873db7-ff18-498b-996d-846df3e5a479', 'dd3482d7-a5cf-4d0a-86e2-3dcda1d4e52b', '1'),
(240, '7a187b87-c5ca-4186-a73b-5c5f9b9e7971', 'a04f599d-8b4f-4c01-9e41-0162ba0dff22', '6'),
(241, '7a187b87-c5ca-4186-a73b-5c5f9b9e7971', 'dd3482d7-a5cf-4d0a-86e2-3dcda1d4e52b', '1');

-- --------------------------------------------------------

--
-- 表的结构 `orderform`
--

CREATE TABLE IF NOT EXISTS `orderform` (
  `Id` varchar(100) NOT NULL,
  `OrderId` varchar(255) DEFAULT NULL COMMENT '订单号',
  `Invoice` varchar(100) DEFAULT NULL COMMENT '是否需要发票',
  `UserId` varchar(100) DEFAULT NULL,
  `CreatTime` datetime DEFAULT NULL,
  `Site` varchar(1000) DEFAULT NULL,
  `TakeUser` varchar(1000) DEFAULT NULL,
  `TakePhone` varchar(1000) DEFAULT NULL,
  `TakeWay` varchar(500) DEFAULT NULL,
  `Remark` varchar(500) DEFAULT NULL,
  `PaymentType` varchar(500) DEFAULT NULL COMMENT '付款状态',
  `State` varchar(500) DEFAULT NULL COMMENT '订单状态',
  `PayAmount` varchar(500) DEFAULT NULL,
  `Commercial` varchar(500) DEFAULT NULL COMMENT '商户',
  `StandbyThree` varchar(500) DEFAULT NULL,
  `StandbyFore` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=gb2312;

--
-- 转存表中的数据 `orderform`
--

INSERT INTO `orderform` (`Id`, `OrderId`, `Invoice`, `UserId`, `CreatTime`, `Site`, `TakeUser`, `TakePhone`, `TakeWay`, `Remark`, `PaymentType`, `State`, `PayAmount`, `Commercial`, `StandbyThree`, `StandbyFore`) VALUES
('020f1393-0dad-43e5-9a9e-e8478e37b83b', 'e27930df-95c6-4c64-a021-56614cb5c90a', NULL, '13554090436', '2016-01-15 10:57:58', NULL, NULL, NULL, NULL, NULL, '1', '1', '0.0', NULL, NULL, NULL),
('0bfe3d11-e028-45ec-bc2f-43995244b29d', '7fe3831c-01c0-461f-84d8-44816623001c', NULL, '13554090436', '2016-01-15 10:59:22', NULL, NULL, NULL, NULL, NULL, '1', '1', '0.0', NULL, NULL, NULL),
('0c6c81f6-8b46-4548-b63e-dbad40f78aad', 'c16af399-26b5-47a0-aaf3-3c07f9fab8f4', NULL, '13872213857', '2015-12-25 13:48:59', NULL, NULL, NULL, NULL, NULL, '1', '8', '0.01', 'admin', NULL, NULL),
('0e6f4a4d-a80f-45bd-99ea-c25b3bae859f', '6561a09e-dbbb-4bf9-af29-67fa62320598', NULL, '13797067530', '2015-12-20 14:35:54', NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, NULL, NULL, NULL),
('1925ff89-129f-4523-b68d-571c7bfb67a5', '816bdcc6-6731-431a-8f73-e1adf8004234', NULL, '13797067530', '2015-11-21 20:58:06', NULL, NULL, NULL, NULL, NULL, '1', '1', '0.01', NULL, NULL, NULL),
('1d7d8220-a165-4f74-950b-40ab73c023cf', 'd5f24719-6ee7-4cdb-9834-b20c06ba7c85', NULL, '13554090436', '2016-01-15 10:58:25', NULL, NULL, NULL, NULL, NULL, '1', '1', '0.0', NULL, NULL, NULL),
('22173561-f5d0-46e0-bbb5-574e99fc48d0', '971190dd-0385-4456-97bd-aafb3b9b7712', NULL, '15902736382', '2015-12-12 13:47:16', NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL),
('22a5338f-b163-46ef-b028-430798996704', '19873db7-ff18-498b-996d-846df3e5a479', NULL, '13797067530', '2017-04-11 21:21:42', NULL, NULL, NULL, NULL, NULL, NULL, '5', NULL, NULL, NULL, NULL),
('2c45fe94-389a-445f-8d2b-f9b30c79625f', '6aa305f3-22d8-4e17-a217-3f6188d5434e', NULL, '13554090436', '2015-12-28 17:56:51', NULL, NULL, NULL, NULL, NULL, NULL, '5', NULL, NULL, NULL, NULL),
('30519689-51c5-468e-bdb5-d4ddaca7b858', '0d7e09c3-cb78-469d-b1b3-a68c41e4c95e', NULL, '15902736382', '2015-12-12 14:37:22', NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL),
('347d3761-5309-49d5-a7cb-c6a0c54e6455', 'cef397fc-fa66-4b1a-96ba-d0718626e601', NULL, '13797067530', '2015-12-12 16:50:43', NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, NULL, NULL, NULL),
('39d6ea9e-2318-4a26-a0c8-295c534f4d6c', 'a4df52db-cf46-49f4-ae97-16a66bc9fda4', NULL, '13797067530', '2015-12-12 17:03:33', NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, NULL, NULL, NULL),
('5e4554fb-273a-4c27-9dda-51eb57f9da30', '7faa0415-b6e3-4962-80a9-6d69ff800362', NULL, '13554090436', '2015-12-28 17:57:29', NULL, NULL, NULL, NULL, NULL, NULL, '5', NULL, NULL, NULL, NULL),
('6b59f410-535c-4d54-b816-7b834f63a599', '6e8080f7-7ef1-4116-a67e-a4e9572e0e4b', NULL, '13554090436', '2015-12-28 17:58:45', NULL, NULL, NULL, NULL, NULL, NULL, '5', NULL, NULL, NULL, NULL),
('7032aa90-e5a4-46d7-a39a-18681cf1a887', 'cc9245c4-04e6-4e59-a429-70677d0ba842', NULL, '13554090436', '2015-12-28 18:02:53', NULL, NULL, NULL, NULL, NULL, '1', '8', '0.01', 'test1', NULL, NULL),
('72babe32-f4ce-47f7-8beb-db5c33954157', '366b9c49-04c1-49ff-8cad-24486fe2e2ba', NULL, '15902736382', '2016-01-06 20:17:19', NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, NULL, NULL, NULL),
('73007ebe-c90d-486f-8dcd-07ed69aa5d98', 'dddb5ceb-01db-49c6-9238-65bf918a0a0a', NULL, '13797067530', '2015-11-23 22:19:28', NULL, NULL, NULL, NULL, NULL, NULL, '5', NULL, NULL, NULL, NULL),
('74d49913-6223-4e0b-acb0-0a772fdbdf52', '6639df4f-016b-4e49-8cb0-4774bc4b7ce5', NULL, '13872213857', '2017-04-11 17:13:46', NULL, NULL, NULL, NULL, NULL, '1', '1', '0.0', NULL, NULL, NULL),
('76381be0-cff4-4fba-a3f4-598ee7fbbd5c', 'af22992c-9ba2-4b7b-84a2-0c2eb26eb946', NULL, '13797067530', '2015-12-12 13:52:22', NULL, NULL, NULL, NULL, NULL, NULL, '5', NULL, NULL, NULL, NULL),
('7996889e-cbab-4ab7-8367-1db6fc637f69', 'a11559c0-2cd4-4797-8190-37fd74720b24', NULL, '15902736382', '2016-01-06 20:09:20', NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, NULL, NULL, NULL),
('79ce55d2-c8b7-4fd7-a869-dcc6b29a75cc', '8623833c-f29f-4d25-8013-b8e65f3a390a', NULL, '15902736382', '2015-12-12 14:35:55', NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL),
('7bdd873d-e7ba-4fec-9b95-4e05d5f65582', '58d53a7b-8e93-4b87-945d-4d1dd3a5aa34', NULL, '13797067530', '2015-11-17 23:29:04', NULL, NULL, NULL, NULL, NULL, '1', '8', '0.0', 'admin', NULL, NULL),
('7d99502e-ad6c-447a-99a0-f33e102da61a', '2ecf86bc-49e0-48ab-a096-8ee4ef382951', NULL, '13554090436', '2015-12-28 21:15:25', NULL, NULL, NULL, NULL, NULL, '1', '1', '0.0', NULL, NULL, NULL),
('854bebd0-99b2-4e85-8bbe-8169593d3215', '9b898a14-b7af-41c6-b99f-71a1a6da0859', NULL, '13872213857', '2017-04-11 17:13:28', NULL, NULL, NULL, NULL, NULL, '1', '1', '0.0', NULL, NULL, NULL),
('883e53dd-0bea-4dd9-bdda-e4378b8424c2', '26f3463e-0299-4cec-8fb5-5acf8308dd13', NULL, '15902736382', '2016-01-06 20:15:21', NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, NULL, NULL, NULL),
('975c2ac6-6cb6-4144-ae5c-2d00cd01b574', 'd8d43c96-f84c-472e-a9fa-8c758bd05078', NULL, '13554090436', '2015-11-20 11:19:28', NULL, NULL, NULL, NULL, NULL, '1', '8', '0.01', 'admin', NULL, NULL),
('97cd71ed-10e0-48d1-b897-3dab266b962c', '32fba6a9-0ccd-4d30-8f3e-eaf5e8729c2d', NULL, '13872213857', '2015-12-25 14:09:14', NULL, NULL, NULL, NULL, NULL, '1', '8', '0.01', 'test1', NULL, NULL),
('9a11cf48-ea0a-4605-91a3-903dd59843d0', '2129a679-ad31-469c-b5d2-1388c77a05e8', NULL, '13554090436', '2015-12-28 18:00:00', NULL, NULL, NULL, NULL, NULL, NULL, '5', NULL, NULL, NULL, NULL),
('9a5f4d28-6381-4238-bc5d-94fa89b61ab1', '9a6af452-d9bd-48ac-8a64-499da85ce0e9', NULL, '13554090436', '2016-01-15 10:59:42', NULL, NULL, NULL, NULL, NULL, '1', '1', '0.0', NULL, NULL, NULL),
('a687476c-24c5-4617-bbb7-0280d00afd64', 'adb8cb92-f47b-4ee7-8271-3cbf9f4302d9', NULL, '15902736382', '2015-12-12 14:53:45', NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL),
('a6aeb03d-a7b5-474a-9c49-ebd5392105b5', '864de6da-42fb-4008-a485-17adf9e46a21', NULL, '13797067530', '2015-11-17 23:50:18', NULL, NULL, NULL, NULL, NULL, '1', '1', '0.0', NULL, NULL, NULL),
('a79f6d72-62b1-42af-9a79-f675e168cdfb', '9a650ecf-67b7-47dd-9575-f02586e33dd3', NULL, '15902736382', '2016-01-06 20:05:16', NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, NULL, NULL, NULL),
('af17a9ce-2191-44c0-a814-620e96bb18bf', '5fec75b0-3e9f-464d-9be3-9c6aba0e09a9', NULL, '13797067530', '2017-04-11 21:04:44', NULL, NULL, NULL, NULL, NULL, NULL, '5', NULL, NULL, NULL, NULL),
('b0b932a5-e506-4a5f-85f9-f06cb2509232', '4cf7fa74-a079-4c30-98d2-d1ddbb627e67', NULL, '13797067530', '2015-11-17 23:46:57', NULL, NULL, NULL, NULL, NULL, '1', '8', '0.0', 'admin', NULL, NULL),
('b2ca1604-3129-4dc1-9f9d-36a3355dc601', '9559dfff-d82a-4629-a95c-120f42fd2359', NULL, '13797067530', '2015-12-20 14:19:35', NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, NULL, NULL, NULL),
('b3210e88-0a4c-4220-a21b-0baa99f80b63', '784ed7fa-f8df-4f82-b11e-051a2dc79bd9', NULL, '13554090436', '2015-11-23 10:26:47', NULL, NULL, NULL, NULL, NULL, NULL, '5', NULL, NULL, NULL, NULL),
('bea78111-3e96-4a1e-bf3c-69f9eab252d6', '2016eae0-f317-476a-aa39-64d66f2d2a47', NULL, '13554090436', '2015-11-23 11:12:40', NULL, NULL, NULL, NULL, NULL, NULL, '5', NULL, NULL, NULL, NULL),
('bf0a89af-0ac5-48ff-b264-99d6ba2a136b', 'cd00d2ae-1339-424a-adb1-62261b5ceb29', NULL, '13797067530', '2015-12-10 16:23:52', NULL, NULL, NULL, NULL, NULL, NULL, '5', NULL, NULL, NULL, NULL),
('c8214b81-0bf6-4fac-ac1e-5e158116491a', 'fbeaa618-40cb-4f1b-ae42-7a37c675373e', NULL, '13797067530', '2015-11-20 11:40:27', NULL, NULL, NULL, NULL, NULL, '1', '1', '0.01', NULL, NULL, NULL),
('cac5ed75-ac93-43b0-a613-0f2ef17f74a5', 'db405714-0616-4e12-8b5f-d878c044b1c0', NULL, '15902736382', '2016-01-06 20:11:47', NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, NULL, NULL, NULL),
('d05ac660-d69b-4a60-83a2-ae640238a294', '0b150969-2226-4399-8296-acd7010b8e85', NULL, '13797067530', '2015-11-17 23:14:06', NULL, NULL, NULL, NULL, NULL, '1', '8', '0.0', 'admin', NULL, NULL),
('d2bf6d1a-e23a-47d0-bde3-db8a3307c901', '7a187b87-c5ca-4186-a73b-5c5f9b9e7971', NULL, '13872213857', '2017-04-12 09:14:18', NULL, NULL, NULL, NULL, NULL, NULL, '5', NULL, NULL, NULL, NULL),
('dd1ee29a-1391-4b68-8587-375ba4987c23', '5647de37-07ce-472a-887e-8f7457ab138f', NULL, '13797067530', '2015-11-17 23:34:38', NULL, NULL, NULL, NULL, NULL, '1', '8', '0.0', 'admin', NULL, NULL),
('eba6437f-5caa-4e12-a71e-e18e91ee2828', '04dccc81-9898-4fc5-8030-16c91287e587', NULL, '13554090436', '2015-11-23 11:12:15', NULL, NULL, NULL, NULL, NULL, NULL, '5', NULL, NULL, NULL, NULL),
('f669de47-10f4-46dd-b254-b52abcbd2278', '0424674c-604a-400f-8ca9-32079cc63ef9', NULL, '(null)', '2016-01-06 20:02:03', NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, NULL, NULL, NULL),
('f7929c28-f63d-486e-9b08-a783b4c7b91b', '9f52586c-1675-4f28-844f-27ad9538b2df', NULL, '13797067530', '2015-12-12 16:54:52', NULL, NULL, NULL, NULL, NULL, NULL, '5', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- 表的结构 `pickuplist`
--

CREATE TABLE IF NOT EXISTS `pickuplist` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Commercial` varchar(255) DEFAULT NULL,
  `orderId` varchar(255) DEFAULT NULL,
  `pickUpTime` datetime DEFAULT NULL,
  `jiuQian` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=gb2312 AUTO_INCREMENT=26 ;

--
-- 转存表中的数据 `pickuplist`
--

INSERT INTO `pickuplist` (`id`, `Commercial`, `orderId`, `pickUpTime`, `jiuQian`) VALUES
(12, 'admin', '2016bb3d-253d-4cda-9195-4e2352dc72b4', '2015-11-08 22:53:50', '0'),
(13, 'admin', '95368120-4ac7-42ce-9564-7bd15982fac7', '2015-11-09 10:28:20', '1'),
(14, 'admin', 'aca2238b-326c-41cd-b30c-8d1322453113', '2015-11-09 10:35:43', '1'),
(15, 'admin', 'd8d43c96-f84c-472e-a9fa-8c758bd05078', '2015-11-24 15:21:07', '1'),
(16, 'admin', '4cf7fa74-a079-4c30-98d2-d1ddbb627e67', '2015-12-01 21:24:41', '4'),
(17, 'admin', '5647de37-07ce-472a-887e-8f7457ab138f', '2015-12-02 21:49:21', '4'),
(18, 'admin', '58d53a7b-8e93-4b87-945d-4d1dd3a5aa34', '2015-12-02 22:06:03', '1'),
(19, 'admin', '99775bf2-9244-4a59-b865-d106492e7fe4', '2015-12-02 22:08:46', '1'),
(20, 'admin', '1d2e1e25-6567-42fd-924a-e712ab5844cf', '2015-12-02 22:14:31', '1'),
(21, 'admin', '77bfc59f-0f30-4661-b9f1-cfef260916a2', '2015-12-02 22:16:18', '1'),
(22, 'admin', '0b150969-2226-4399-8296-acd7010b8e85', '2015-12-02 22:26:47', '4'),
(23, 'admin', 'c16af399-26b5-47a0-aaf3-3c07f9fab8f4', '2015-12-25 13:54:25', '10'),
(24, 'test1', '32fba6a9-0ccd-4d30-8f3e-eaf5e8729c2d', '2015-12-25 14:14:06', '10'),
(25, 'test1', 'cc9245c4-04e6-4e59-a429-70677d0ba842', '2016-01-15 10:55:16', '10');

-- --------------------------------------------------------

--
-- 表的结构 `pickupmoney`
--

CREATE TABLE IF NOT EXISTS `pickupmoney` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Commercial` varchar(255) DEFAULT NULL,
  `RealName` varchar(255) DEFAULT NULL,
  `BankName` varchar(255) DEFAULT NULL,
  `BankNo` varchar(255) DEFAULT NULL,
  `ApplyTime` datetime DEFAULT NULL,
  `CreatTime` datetime DEFAULT NULL,
  `State` varchar(255) DEFAULT '0',
  `ApplyMonery` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=gb2312 AUTO_INCREMENT=7 ;

--
-- 转存表中的数据 `pickupmoney`
--

INSERT INTO `pickupmoney` (`id`, `Commercial`, `RealName`, `BankName`, `BankNo`, `ApplyTime`, `CreatTime`, `State`, `ApplyMonery`) VALUES
(2, 'admin', '张三', '张三', '13412342314', '2015-10-21 00:01:04', '2015-10-21 00:01:37', NULL, '0'),
(3, 'admin', 'Zzz', 'Zzz', 'Xxxx', '2015-11-05 09:49:53', '2015-11-05 09:50:07', NULL, '1'),
(4, 'admin', '汪龙', '中国银行', '420111197910225553', '2015-11-12 09:44:49', '2015-11-12 09:44:57', NULL, '1'),
(5, 'admin', '汪龙', '中国银行', '420111197910225553', '2015-11-12 09:45:02', '2015-11-12 09:45:10', NULL, '1'),
(6, 'admin', '汪龙', '民生', '420111197910225553', '2015-11-12 09:45:58', '2015-11-12 09:46:06', NULL, '2');

-- --------------------------------------------------------

--
-- 表的结构 `pmw_admin`
--

CREATE TABLE IF NOT EXISTS `pmw_admin` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT COMMENT '信息id',
  `username` varchar(30) NOT NULL COMMENT '用户名',
  `password` char(32) NOT NULL COMMENT '密码',
  `nickname` char(32) NOT NULL COMMENT '昵称',
  `question` tinyint(1) unsigned NOT NULL COMMENT '登录提问',
  `answer` varchar(50) NOT NULL COMMENT '登录回答',
  `levelname` tinyint(1) unsigned NOT NULL COMMENT '级别',
  `checkadmin` enum('true','false') NOT NULL COMMENT '审核',
  `loginip` char(20) NOT NULL COMMENT '登录IP',
  `logintime` int(10) unsigned NOT NULL COMMENT '登录时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `pmw_admin`
--

INSERT INTO `pmw_admin` (`id`, `username`, `password`, `nickname`, `question`, `answer`, `levelname`, `checkadmin`, `loginip`, `logintime`) VALUES
(1, 'admin', 'c3284d0f94606de1fd2af172aba15bf3', '', 0, '', 1, 'true', '0.0.0.0', 1492677807);

-- --------------------------------------------------------

--
-- 表的结构 `pmw_admingroup`
--

CREATE TABLE IF NOT EXISTS `pmw_admingroup` (
  `id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT COMMENT '管理组id',
  `groupname` varchar(30) NOT NULL COMMENT '管理组名称',
  `description` text NOT NULL COMMENT '管理组描述',
  `groupsite` varchar(30) NOT NULL COMMENT '默认进入站',
  `checkinfo` set('true','false') NOT NULL COMMENT '审核状态',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- 转存表中的数据 `pmw_admingroup`
--

INSERT INTO `pmw_admingroup` (`id`, `groupname`, `description`, `groupsite`, `checkinfo`) VALUES
(1, '超级管理员', '超级管理员组', '1', 'true'),
(2, '站点管理员', '站点管理员组', '1', 'true'),
(3, '文章发布员', '文章发布员组', '1', 'true');

-- --------------------------------------------------------

--
-- 表的结构 `pmw_adminnotes`
--

CREATE TABLE IF NOT EXISTS `pmw_adminnotes` (
  `uname` varchar(30) NOT NULL COMMENT '用户名',
  `body` mediumtext NOT NULL COMMENT '便签内容',
  `posttime` int(10) unsigned NOT NULL COMMENT '提交时间',
  `postip` varchar(30) NOT NULL COMMENT '提交IP',
  PRIMARY KEY (`uname`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `pmw_failedlogin`
--

CREATE TABLE IF NOT EXISTS `pmw_failedlogin` (
  `username` char(30) NOT NULL COMMENT '用户名',
  `ip` char(15) NOT NULL COMMENT '登录IP',
  `time` int(10) unsigned NOT NULL COMMENT '登录时间',
  `num` tinyint(1) NOT NULL COMMENT '失败次数',
  `isadmin` tinyint(1) NOT NULL COMMENT '是否是管理员',
  PRIMARY KEY (`username`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `pmw_lnk`
--

CREATE TABLE IF NOT EXISTS `pmw_lnk` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT COMMENT '快捷方式id',
  `lnkname` varchar(30) NOT NULL COMMENT '快捷方式名称',
  `lnklink` varchar(50) NOT NULL COMMENT '跳转链接',
  `lnkico` varchar(50) NOT NULL COMMENT 'ico地址',
  `orderid` smallint(5) unsigned NOT NULL COMMENT '排列排序',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- 转存表中的数据 `pmw_lnk`
--

INSERT INTO `pmw_lnk` (`id`, `lnkname`, `lnklink`, `lnkico`, `orderid`) VALUES
(1, '所有订单', 'infoclass.php', 'templates/images/lnkBg01.png', 1),
(2, '已付订单', 'infolist.php', 'templates/images/lnkBg02.png', 2),
(3, '未付订单', 'infoimg.php', 'templates/images/lnkBg03.png', 3),
(4, '活动管理', 'goods.php', 'templates/images/lnkBg04.png', 4),
(9, '提现记录', '', 'templates/images/lnkBg03.png', 5);

-- --------------------------------------------------------

--
-- 表的结构 `pmw_site`
--

CREATE TABLE IF NOT EXISTS `pmw_site` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT COMMENT '站点ID',
  `sitename` varchar(30) NOT NULL COMMENT '站点名称',
  `sitekey` varchar(30) NOT NULL COMMENT '站点标识',
  `sitelang` varchar(50) NOT NULL COMMENT '站点语言包',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `pmw_site`
--

INSERT INTO `pmw_site` (`id`, `sitename`, `sitekey`, `sitelang`) VALUES
(1, '默认站点', 'zh_CN', 'zh_CN');

-- --------------------------------------------------------

--
-- 表的结构 `pmw_sysevent`
--

CREATE TABLE IF NOT EXISTS `pmw_sysevent` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '信息id',
  `uname` varchar(30) NOT NULL COMMENT '用户名',
  `siteid` tinyint(1) unsigned NOT NULL COMMENT '站点id',
  `model` varchar(30) NOT NULL COMMENT '操作模块',
  `classid` int(10) unsigned NOT NULL COMMENT '栏目id',
  `action` varchar(10) NOT NULL COMMENT '执行操作',
  `posttime` int(10) NOT NULL COMMENT '操作时间',
  `ip` varchar(20) NOT NULL COMMENT '操作ip',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=229 ;

--
-- 转存表中的数据 `pmw_sysevent`
--

INSERT INTO `pmw_sysevent` (`id`, `uname`, `siteid`, `model`, `classid`, `action`, `posttime`, `ip`) VALUES
(1, 'admin', 1, 'admin', 0, 'all', 1487570822, '0.0.0.0'),
(2, 'admin', 1, 'upload_filemgr_sql', 0, 'all', 1487570826, '0.0.0.0'),
(3, 'admin', 1, 'infoclass', 0, 'all', 1487570827, '0.0.0.0'),
(4, 'admin', 1, 'login', 0, '', 1488762836, '0.0.0.0'),
(5, 'admin', 1, 'nav', 0, 'all', 1488762843, '0.0.0.0'),
(6, 'admin', 1, 'login', 0, '', 1488950612, '0.0.0.0'),
(7, 'admin', 1, 'infoclass', 0, 'all', 1488950862, '0.0.0.0'),
(8, 'admin', 1, 'infolist', 0, 'all', 1488963855, '0.0.0.0'),
(9, 'admin', 1, 'infoimg', 0, 'all', 1488963859, '0.0.0.0'),
(10, 'admin', 1, 'login', 0, '', 1489397538, '0.0.0.0'),
(11, 'admin', 1, 'web_config', 0, 'all', 1489397543, '0.0.0.0'),
(12, 'admin', 1, 'web_config', 0, 'all', 1489397881, '0.0.0.0'),
(13, 'admin', 1, 'login', 0, '', 1489647640, '0.0.0.0'),
(14, 'admin', 1, 'web_config', 0, 'all', 1489647650, '0.0.0.0'),
(15, 'admin', 1, 'web_config', 0, 'all', 1489647967, '0.0.0.0'),
(16, 'admin', 1, 'web_config', 0, 'all', 1489648063, '0.0.0.0'),
(17, 'admin', 1, 'web_config', 0, 'all', 1489648163, '0.0.0.0'),
(18, 'admin', 1, 'site', 0, 'all', 1489648184, '0.0.0.0'),
(19, 'admin', 1, 'admin', 0, 'all', 1489648186, '0.0.0.0'),
(20, 'admin', 1, 'database_backup', 0, 'all', 1489648190, '0.0.0.0'),
(21, 'admin', 1, 'infoclass', 0, 'all', 1489648195, '0.0.0.0'),
(22, 'admin', 1, 'fragment', 0, 'all', 1489648197, '0.0.0.0'),
(23, 'admin', 1, 'diymodel', 0, 'all', 1489648206, '0.0.0.0'),
(24, 'admin', 1, 'diyfield', 0, 'all', 1489648208, '0.0.0.0'),
(25, 'admin', 1, 'web_config', 0, 'all', 1489648242, '0.0.0.0'),
(26, 'admin', 1, 'web_config', 0, 'all', 1489648320, '0.0.0.0'),
(27, 'admin', 1, 'logout', 0, 'all', 1489648325, '0.0.0.0'),
(28, 'admin', 1, 'login', 0, '', 1489648340, '0.0.0.0'),
(29, 'admin', 1, 'infolist', 0, 'all', 1489648349, '0.0.0.0'),
(30, 'admin', 1, 'web_config', 0, 'all', 1489648426, '0.0.0.0'),
(31, 'admin', 1, 'nav', 0, 'all', 1489649020, '0.0.0.0'),
(32, 'admin', 1, 'maintype', 0, 'all', 1489649045, '0.0.0.0'),
(33, 'admin', 1, 'maintype', 0, 'all', 1489651461, '0.0.0.0'),
(34, 'admin', 1, 'login', 0, '', 1489731638, '0.0.0.0'),
(35, 'admin', 1, 'web_config', 0, 'all', 1489731662, '0.0.0.0'),
(36, 'admin', 1, 'login', 0, '', 1489731775, '0.0.0.0'),
(37, 'admin', 1, 'web_config', 0, 'all', 1489731781, '0.0.0.0'),
(38, 'admin', 1, 'login', 0, '', 1489986943, '0.0.0.0'),
(39, 'admin', 1, 'infoimg', 0, 'all', 1489986950, '0.0.0.0'),
(40, 'admin', 1, 'infolist', 0, 'all', 1489986965, '0.0.0.0'),
(41, 'admin', 1, 'diymodel', 0, 'all', 1489986977, '0.0.0.0'),
(42, 'admin', 1, 'info', 0, 'all', 1489986980, '0.0.0.0'),
(43, 'admin', 1, 'member', 0, 'all', 1489986986, '0.0.0.0'),
(44, 'admin', 1, 'userfavorite', 0, 'all', 1489986987, '0.0.0.0'),
(45, 'admin', 1, 'usercomment', 0, 'all', 1489986989, '0.0.0.0'),
(46, 'admin', 1, 'job', 0, 'all', 1489986991, '0.0.0.0'),
(47, 'admin', 1, 'cascade', 0, 'all', 1489986991, '0.0.0.0'),
(48, 'admin', 1, 'nav', 0, 'all', 1489986995, '0.0.0.0'),
(49, 'admin', 1, 'diymenu', 0, 'all', 1489986997, '0.0.0.0'),
(50, 'admin', 1, 'mobile', 0, 'all', 1489986999, '0.0.0.0'),
(51, 'admin', 1, 'editfile', 0, 'all', 1489987000, '0.0.0.0'),
(52, 'admin', 1, 'admin', 0, 'all', 1489987006, '0.0.0.0'),
(53, 'admin', 1, 'site', 0, 'all', 1489987013, '0.0.0.0'),
(54, 'admin', 1, 'web_config', 0, 'all', 1489987015, '0.0.0.0'),
(55, 'admin', 1, 'infolist', 0, 'all', 1489987026, '0.0.0.0'),
(56, 'admin', 1, 'infosrc', 0, 'all', 1489987031, '0.0.0.0'),
(57, 'admin', 1, 'infolist', 0, 'all', 1489987128, '0.0.0.0'),
(58, 'admin', 1, 'login', 0, '', 1490676961, '0.0.0.0'),
(59, 'admin', 1, 'help', 0, 'all', 1490676967, '0.0.0.0'),
(60, 'admin', 1, 'login', 0, '', 1491363042, '0.0.0.0'),
(61, 'admin', 1, 'help', 0, 'all', 1491363048, '0.0.0.0'),
(62, 'admin', 1, 'sysevent', 0, 'all', 1491386078, '0.0.0.0'),
(63, 'admin', 1, 'infoclass', 0, 'all', 1491386080, '0.0.0.0'),
(64, 'admin', 1, 'info', 0, 'all', 1491386083, '0.0.0.0'),
(65, 'admin', 1, 'infolist', 0, 'all', 1491386086, '0.0.0.0'),
(66, 'admin', 1, 'infoimg', 0, 'all', 1491386097, '0.0.0.0'),
(67, 'admin', 1, 'message', 0, 'all', 1491386111, '0.0.0.0'),
(68, 'admin', 1, 'login', 0, '', 1491459328, '0.0.0.0'),
(69, 'admin', 1, 'login', 0, '', 1491975786, '0.0.0.0'),
(70, 'admin', 1, 'web_config', 0, 'all', 1491975825, '0.0.0.0'),
(71, 'admin', 1, 'web_config', 0, 'all', 1491975895, '0.0.0.0'),
(72, 'admin', 1, 'admin', 0, 'all', 1491976086, '0.0.0.0'),
(73, 'admin', 1, 'web_config', 0, 'all', 1491976090, '0.0.0.0'),
(74, 'admin', 1, 'admin', 0, 'all', 1491976235, '0.0.0.0'),
(75, 'admin', 1, 'web_config', 0, 'all', 1491976237, '0.0.0.0'),
(76, 'admin', 1, 'admin', 0, 'all', 1491976866, '0.0.0.0'),
(77, 'admin', 1, 'web_config', 0, 'all', 1491976869, '0.0.0.0'),
(78, 'admin', 1, 'web_config', 0, 'all', 1491977206, '0.0.0.0'),
(79, 'admin', 1, 'admin', 0, 'all', 1491977449, '0.0.0.0'),
(80, 'admin', 1, 'web_config', 0, 'all', 1491977451, '0.0.0.0'),
(81, 'admin', 1, 'web_config', 0, 'all', 1491979160, '0.0.0.0'),
(82, 'admin', 1, 'admin', 0, 'all', 1491979167, '0.0.0.0'),
(83, 'admin', 1, 'admin', 0, 'all', 1491979247, '0.0.0.0'),
(84, 'admin', 1, 'message', 0, 'all', 1491980489, '0.0.0.0'),
(85, 'admin', 1, 'admin', 0, 'all', 1491980888, '0.0.0.0'),
(86, 'admin', 1, 'web_config', 0, 'all', 1491980890, '0.0.0.0'),
(87, 'admin', 1, 'infolist', 0, 'all', 1491988048, '0.0.0.0'),
(88, 'admin', 1, 'admin', 0, 'all', 1491988811, '0.0.0.0'),
(89, 'admin', 1, 'infolist', 0, 'all', 1491991490, '0.0.0.0'),
(90, 'admin', 1, 'infolist', 0, 'all', 1491991586, '0.0.0.0'),
(91, 'admin', 1, 'infolist', 0, 'all', 1491991686, '0.0.0.0'),
(92, 'admin', 1, 'infolist', 0, 'all', 1491991852, '0.0.0.0'),
(93, 'admin', 1, 'infolist', 0, 'all', 1491992028, '0.0.0.0'),
(94, 'admin', 1, 'infolist', 0, 'all', 1491992115, '0.0.0.0'),
(95, 'admin', 1, 'infolist', 0, 'all', 1491992183, '0.0.0.0'),
(96, 'admin', 1, 'infolist', 0, 'all', 1491992250, '0.0.0.0'),
(97, 'admin', 1, 'login', 0, '', 1492045643, '0.0.0.0'),
(98, 'admin', 1, 'infolist', 0, 'all', 1492045682, '0.0.0.0'),
(99, 'admin', 1, 'admin', 0, 'all', 1492046575, '0.0.0.0'),
(100, 'admin', 1, 'web_config', 0, 'all', 1492046579, '0.0.0.0'),
(101, 'admin', 1, 'message', 0, 'all', 1492047396, '0.0.0.0'),
(102, 'admin', 1, 'message', 0, 'all', 1492047542, '0.0.0.0'),
(103, 'admin', 1, 'message', 0, 'all', 1492047666, '0.0.0.0'),
(104, 'admin', 1, 'message', 0, 'all', 1492047728, '0.0.0.0'),
(105, 'admin', 1, 'web_config', 0, 'all', 1492047895, '0.0.0.0'),
(106, 'admin', 1, 'infolist', 0, 'all', 1492047929, '0.0.0.0'),
(107, 'admin', 1, 'infolist', 0, 'all', 1492048225, '0.0.0.0'),
(108, 'admin', 1, 'infolist', 0, 'all', 1492049922, '0.0.0.0'),
(109, 'admin', 1, 'infolist', 0, 'all', 1492049992, '0.0.0.0'),
(110, 'admin', 1, 'infolist', 0, 'all', 1492050097, '0.0.0.0'),
(111, 'admin', 1, 'infolist', 0, 'all', 1492050285, '0.0.0.0'),
(112, 'admin', 1, 'infolist', 0, 'all', 1492050468, '0.0.0.0'),
(113, 'admin', 1, 'infolist', 0, 'all', 1492050809, '0.0.0.0'),
(114, 'admin', 1, 'infolist', 0, 'all', 1492051003, '0.0.0.0'),
(115, 'admin', 1, 'infolist', 0, 'all', 1492051134, '0.0.0.0'),
(116, 'admin', 1, 'infolist', 0, 'all', 1492051305, '0.0.0.0'),
(117, 'admin', 1, 'infolist', 0, 'all', 1492051749, '0.0.0.0'),
(118, 'admin', 1, 'infolist', 0, 'all', 1492052291, '0.0.0.0'),
(119, 'admin', 1, 'infolist', 0, 'all', 1492052478, '0.0.0.0'),
(120, 'admin', 1, 'infolist', 0, 'all', 1492052788, '0.0.0.0'),
(121, 'admin', 1, 'infolist', 0, 'all', 1492052900, '0.0.0.0'),
(122, 'admin', 1, 'infolist', 0, 'all', 1492053617, '0.0.0.0'),
(123, 'admin', 1, 'infolist', 0, 'all', 1492053730, '0.0.0.0'),
(124, 'admin', 1, 'infolist', 0, 'all', 1492053808, '0.0.0.0'),
(125, 'admin', 1, 'infolist', 0, 'all', 1492053933, '0.0.0.0'),
(126, 'admin', 1, 'infolist', 0, 'all', 1492054079, '0.0.0.0'),
(127, 'admin', 1, 'infolist', 0, 'all', 1492054196, '0.0.0.0'),
(128, 'admin', 1, 'infolist', 0, 'all', 1492054261, '0.0.0.0'),
(129, 'admin', 1, 'infolist', 0, 'all', 1492054335, '0.0.0.0'),
(130, 'admin', 1, 'infolist', 0, 'all', 1492054549, '0.0.0.0'),
(131, 'admin', 1, 'infolist', 0, 'all', 1492054676, '0.0.0.0'),
(132, 'admin', 1, 'infolist', 0, 'all', 1492055237, '0.0.0.0'),
(133, 'admin', 1, 'message', 0, 'all', 1492055241, '0.0.0.0'),
(134, 'admin', 1, 'message', 0, 'all', 1492055367, '0.0.0.0'),
(135, 'admin', 1, 'infolist', 0, 'all', 1492055370, '0.0.0.0'),
(136, 'admin', 1, 'message', 0, 'all', 1492055542, '0.0.0.0'),
(137, 'admin', 1, 'infolist', 0, 'all', 1492055551, '0.0.0.0'),
(138, 'admin', 1, 'infolist', 0, 'all', 1492056053, '0.0.0.0'),
(139, 'admin', 1, 'infolist', 0, 'all', 1492056195, '0.0.0.0'),
(140, 'admin', 1, 'infolist', 0, 'all', 1492056256, '0.0.0.0'),
(141, 'admin', 1, 'infolist', 0, 'all', 1492056318, '0.0.0.0'),
(142, 'admin', 1, 'message', 0, 'all', 1492060010, '0.0.0.0'),
(143, 'admin', 1, 'infolist', 0, 'all', 1492060018, '0.0.0.0'),
(144, 'admin', 1, 'infolist', 0, 'all', 1492061234, '0.0.0.0'),
(145, 'admin', 1, 'message', 0, 'all', 1492061247, '0.0.0.0'),
(146, 'admin', 1, 'infolist', 0, 'all', 1492072336, '0.0.0.0'),
(147, 'admin', 1, 'help', 0, 'all', 1492075659, '0.0.0.0'),
(148, 'admin', 1, 'message', 0, 'all', 1492081540, '0.0.0.0'),
(149, 'admin', 1, 'login', 0, '', 1492133521, '0.0.0.0'),
(150, 'admin', 1, 'admin', 0, 'all', 1492133530, '0.0.0.0'),
(151, 'admin', 1, 'web_config', 0, 'all', 1492133532, '0.0.0.0'),
(152, 'admin', 1, 'message', 0, 'all', 1492133584, '0.0.0.0'),
(153, 'admin', 1, 'message', 0, 'all', 1492137329, '0.0.0.0'),
(154, 'admin', 1, 'message', 0, 'all', 1492138036, '0.0.0.0'),
(155, 'admin', 1, 'message', 0, 'all', 1492138215, '0.0.0.0'),
(156, 'admin', 1, 'message', 0, 'all', 1492139291, '0.0.0.0'),
(157, 'admin', 1, 'message', 0, 'all', 1492139963, '0.0.0.0'),
(158, 'admin', 1, 'message', 0, 'all', 1492140142, '0.0.0.0'),
(159, 'admin', 1, 'message', 0, 'all', 1492140248, '0.0.0.0'),
(160, 'admin', 1, 'message', 0, 'all', 1492140812, '0.0.0.0'),
(161, 'admin', 1, 'message', 0, 'all', 1492140876, '0.0.0.0'),
(162, 'admin', 1, 'message', 0, 'all', 1492141031, '0.0.0.0'),
(163, 'admin', 1, 'message', 0, 'all', 1492141984, '0.0.0.0'),
(164, 'admin', 1, 'message', 0, 'all', 1492142045, '0.0.0.0'),
(165, 'admin', 1, 'message', 0, 'all', 1492142138, '0.0.0.0'),
(166, 'admin', 1, 'message', 0, 'all', 1492142553, '0.0.0.0'),
(167, 'admin', 1, 'message', 0, 'all', 1492142637, '0.0.0.0'),
(168, 'admin', 1, 'message', 0, 'all', 1492142718, '0.0.0.0'),
(169, 'admin', 1, 'message', 0, 'all', 1492143673, '0.0.0.0'),
(170, 'admin', 1, 'message', 0, 'all', 1492144405, '0.0.0.0'),
(171, 'admin', 1, 'message', 0, 'all', 1492144550, '0.0.0.0'),
(172, 'admin', 1, 'message', 0, 'all', 1492144899, '0.0.0.0'),
(173, 'admin', 1, 'admin', 0, 'all', 1492147558, '0.0.0.0'),
(174, 'admin', 1, 'login', 0, '', 1492148111, '0.0.0.0'),
(175, 'admin', 1, 'message', 0, 'all', 1492165286, '0.0.0.0'),
(176, 'admin', 1, 'message', 0, 'all', 1492165471, '0.0.0.0'),
(177, 'admin', 1, 'message', 0, 'all', 1492165533, '0.0.0.0'),
(178, 'admin', 1, 'login', 0, '', 1492390877, '0.0.0.0'),
(179, 'admin', 1, 'message', 0, 'all', 1492400689, '0.0.0.0'),
(180, 'admin', 1, 'message', 0, 'all', 1492400755, '0.0.0.0'),
(181, 'admin', 1, 'message', 0, 'all', 1492400842, '0.0.0.0'),
(182, 'admin', 1, 'message', 0, 'all', 1492400906, '0.0.0.0'),
(183, 'admin', 1, 'message', 0, 'all', 1492400981, '0.0.0.0'),
(184, 'admin', 1, 'message', 0, 'all', 1492401042, '0.0.0.0'),
(185, 'admin', 1, 'message', 0, 'all', 1492416979, '0.0.0.0'),
(186, 'admin', 1, 'message', 0, 'all', 1492417061, '0.0.0.0'),
(187, 'admin', 1, 'message', 0, 'all', 1492417280, '0.0.0.0'),
(188, 'admin', 1, 'message', 0, 'all', 1492417552, '0.0.0.0'),
(189, 'admin', 1, 'message', 0, 'all', 1492417834, '0.0.0.0'),
(190, 'admin', 1, 'message', 0, 'all', 1492418418, '0.0.0.0'),
(191, 'admin', 1, 'message', 0, 'all', 1492419029, '0.0.0.0'),
(192, 'admin', 1, 'message', 0, 'all', 1492420593, '0.0.0.0'),
(193, 'admin', 1, 'message', 0, 'all', 1492421023, '0.0.0.0'),
(194, 'admin', 1, 'admin', 0, 'all', 1492421158, '0.0.0.0'),
(195, 'admin', 1, 'web_config', 0, 'all', 1492421160, '0.0.0.0'),
(196, 'admin', 1, 'message', 0, 'all', 1492421250, '0.0.0.0'),
(197, 'admin', 1, 'admin', 0, 'all', 1492421713, '0.0.0.0'),
(198, 'admin', 1, 'message', 0, 'all', 1492421717, '0.0.0.0'),
(199, 'admin', 1, 'admin', 0, 'all', 1492421868, '0.0.0.0'),
(200, 'admin', 1, 'message', 0, 'all', 1492421898, '0.0.0.0'),
(201, 'admin', 1, 'message', 0, 'all', 1492422178, '0.0.0.0'),
(202, 'admin', 1, 'message', 0, 'all', 1492424555, '0.0.0.0'),
(203, 'admin', 1, 'message', 0, 'all', 1492425269, '0.0.0.0'),
(204, 'admin', 1, 'message', 0, 'all', 1492425609, '0.0.0.0'),
(205, 'admin', 1, 'login', 0, '', 1492432969, '0.0.0.0'),
(206, 'admin', 1, 'message', 0, 'all', 1492432993, '0.0.0.0'),
(207, 'admin', 1, 'login', 0, '', 1492433469, '0.0.0.0'),
(208, 'admin', 1, 'login', 0, '', 1492433564, '0.0.0.0'),
(209, 'admin', 1, 'login', 0, '', 1492493354, '0.0.0.0'),
(210, 'admin', 1, 'message', 0, 'all', 1492493366, '0.0.0.0'),
(211, 'admin', 1, 'message', 0, 'all', 1492507938, '0.0.0.0'),
(212, 'admin', 1, 'login', 0, '', 1492563958, '0.0.0.0'),
(213, 'admin', 1, 'web_config', 0, 'all', 1492570320, '0.0.0.0'),
(214, 'admin', 1, 'admin', 0, 'all', 1492570416, '0.0.0.0'),
(215, 'admin', 1, 'web_config', 0, 'all', 1492570417, '0.0.0.0'),
(216, 'admin', 1, 'web_config', 0, 'all', 1492586677, '0.0.0.0'),
(217, 'admin', 1, 'message', 0, 'all', 1492592942, '0.0.0.0'),
(218, 'admin', 1, 'message', 0, 'all', 1492593157, '0.0.0.0'),
(219, 'admin', 1, 'message', 0, 'all', 1492593271, '0.0.0.0'),
(220, 'admin', 1, 'message', 0, 'all', 1492593678, '0.0.0.0'),
(221, 'admin', 1, 'login', 0, '', 1492654880, '0.0.0.0'),
(222, 'admin', 1, 'message', 0, 'all', 1492660999, '0.0.0.0'),
(223, 'admin', 1, 'message', 0, 'all', 1492667478, '0.0.0.0'),
(224, 'admin', 1, 'message', 0, 'all', 1492669208, '0.0.0.0'),
(225, 'admin', 1, 'login', 0, '', 1492677807, '0.0.0.0'),
(226, 'admin', 1, 'message', 0, 'all', 1492682136, '0.0.0.0'),
(227, 'admin', 1, 'message', 0, 'all', 1492682245, '0.0.0.0'),
(228, 'admin', 1, 'message', 0, 'all', 1492682342, '0.0.0.0');

-- --------------------------------------------------------

--
-- 表的结构 `pmw_uploads`
--

CREATE TABLE IF NOT EXISTS `pmw_uploads` (
  `id` mediumint(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '上传信息id',
  `name` varchar(30) NOT NULL COMMENT '文件名称',
  `path` varchar(100) NOT NULL COMMENT '文件路径',
  `size` int(10) NOT NULL COMMENT '文件大小',
  `type` enum('image','soft','media') NOT NULL COMMENT '文件类型',
  `posttime` int(10) NOT NULL COMMENT '上传日期',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=103 ;

--
-- 转存表中的数据 `pmw_uploads`
--

INSERT INTO `pmw_uploads` (`id`, `name`, `path`, `size`, `type`, `posttime`) VALUES
(1, '1492049178.jpg', 'uploads/image/20170413/1492049178.jpg', 66988, 'image', 1492046509),
(2, '1492055429.jpg', 'uploads/image/20170413/1492055429.jpg', 66988, 'image', 1492046636),
(3, '1492059881.jpg', 'uploads/image/20170413/1492059881.jpg', 66988, 'image', 1492055387),
(4, '1492089344.jpg', 'uploads/image/20170413/1492089344.jpg', 66988, 'image', 1492081535),
(5, '1492141876.jpg', 'uploads/image/20170414/1492141876.jpg', 41745, 'image', 1492137305),
(6, '1492142200.jpg', 'uploads/image/20170414/1492142200.jpg', 64194, 'image', 1492138014),
(7, '1492142912.jpg', 'uploads/image/20170414/1492142912.jpg', 64194, 'image', 1492138197),
(8, '1492406845.jpg', 'uploads/image/20170417/1492406845.jpg', 66420, 'image', 1492397829),
(9, '1492514653.jpg', 'uploads/image/20170418/1492514653.jpg', 41745, 'image', 1492509304),
(10, '1492517376.jpg', 'uploads/image/20170418/1492517376.jpg', 64194, 'image', 1492509305),
(11, '1492519309.jpg', 'uploads/image/20170418/1492519309.jpg', 41745, 'image', 1492509522),
(12, '1492516635.jpg', 'uploads/image/20170418/1492516635.jpg', 64194, 'image', 1492509524),
(13, '1492514602.jpg', 'uploads/image/20170418/1492514602.jpg', 22471, 'image', 1492510302),
(14, '1492517573.jpg', 'uploads/image/20170418/1492517573.jpg', 41745, 'image', 1492510303),
(15, '1492511803.jpg', 'uploads/image/20170418/1492511803.jpg', 64194, 'image', 1492510304),
(16, '1492512136.jpg', 'uploads/image/20170418/1492512136.jpg', 41745, 'image', 1492510970),
(17, '1492513806.jpg', 'uploads/image/20170418/1492513806.jpg', 64194, 'image', 1492510971),
(18, '1492518966.jpg', 'uploads/image/20170418/1492518966.jpg', 64194, 'image', 1492511143),
(19, '1492520919.jpg', 'uploads/image/20170418/1492520919.jpg', 41745, 'image', 1492511144),
(20, '1492515550.jpg', 'uploads/image/20170418/1492515550.jpg', 22471, 'image', 1492511265),
(21, '1492514439.jpg', 'uploads/image/20170418/1492514439.jpg', 41745, 'image', 1492511266),
(22, '1492567066.jpg', 'uploads/image/20170419/1492567066.jpg', 22471, 'image', 1492564598),
(23, '1492565276.jpg', 'uploads/image/20170419/1492565276.jpg', 41745, 'image', 1492564599),
(24, '1492568085.jpg', 'uploads/image/20170419/1492568085.jpg', 64194, 'image', 1492564600),
(25, '1492569058.jpg', 'uploads/image/20170419/1492569058.jpg', 22471, 'image', 1492565250),
(29, '1492589207.png', 'uploads/image/20170419/1492589207.png', 512716, 'image', 1492582261),
(27, '1492572786.jpg', 'uploads/image/20170419/1492572786.jpg', 64194, 'image', 1492565253),
(28, '1492575135.jpg', 'uploads/image/20170419/1492575135.jpg', 41745, 'image', 1492565532),
(30, '1492582999.jpg', 'uploads/image/20170419/1492582999.jpg', 64194, 'image', 1492582262),
(31, '1492586643.jpg', 'uploads/image/20170419/1492586643.jpg', 66420, 'image', 1492582263),
(32, '1492584860.jpg', 'uploads/image/20170419/1492584860.jpg', 66988, 'image', 1492582312),
(33, '1492584395.jpg', 'uploads/image/20170419/1492584395.jpg', 64194, 'image', 1492582313),
(55, '1492588357.jpg', 'uploads/image/20170419/1492588357.jpg', 146802, 'image', 1492582735),
(35, '1492592124.jpg', 'uploads/image/20170419/1492592124.jpg', 64194, 'image', 1492582357),
(54, '1492586055.jpg', 'uploads/image/20170419/1492586055.jpg', 8050, 'image', 1492582708),
(37, '1492590770.jpg', 'uploads/image/20170419/1492590770.jpg', 342267, 'image', 1492582440),
(38, '1492584034.jpg', 'uploads/image/20170419/1492584034.jpg', 199843, 'image', 1492582465),
(39, '1492585222.jpg', 'uploads/image/20170419/1492585222.jpg', 120334, 'image', 1492582475),
(40, '1492591504.jpg', 'uploads/image/20170419/1492591504.jpg', 146802, 'image', 1492582504),
(41, '1492588047.jpg', 'uploads/image/20170419/1492588047.jpg', 130353, 'image', 1492582505),
(42, '1492582851.jpg', 'uploads/image/20170419/1492582851.jpg', 150838, 'image', 1492582506),
(43, '1492591682.jpg', 'uploads/image/20170419/1492591682.jpg', 106909, 'image', 1492582534),
(44, '1492588060.jpg', 'uploads/image/20170419/1492588060.jpg', 155054, 'image', 1492582535),
(45, '1492583726.jpg', 'uploads/image/20170419/1492583726.jpg', 76513, 'image', 1492582559),
(46, '1492583776.jpg', 'uploads/image/20170419/1492583776.jpg', 102352, 'image', 1492582560),
(47, '1492589819.jpg', 'uploads/image/20170419/1492589819.jpg', 359992, 'image', 1492582587),
(48, '1492588747.jpg', 'uploads/image/20170419/1492588747.jpg', 131008, 'image', 1492582616),
(49, '1492592166.jpg', 'uploads/image/20170419/1492592166.jpg', 103305, 'image', 1492582639),
(50, '1492591790.jpg', 'uploads/image/20170419/1492591790.jpg', 123018, 'image', 1492582641),
(51, '1492590333.jpg', 'uploads/image/20170419/1492590333.jpg', 130353, 'image', 1492582668),
(52, '1492592524.jpg', 'uploads/image/20170419/1492592524.jpg', 41631, 'image', 1492582669),
(53, '1492586107.jpg', 'uploads/image/20170419/1492586107.jpg', 54869, 'image', 1492582671),
(56, '1492588358.jpg', 'uploads/image/20170419/1492588358.jpg', 150838, 'image', 1492582736),
(57, '1492584487.jpg', 'uploads/image/20170419/1492584487.jpg', 46218, 'image', 1492582737),
(58, '1492588249.jpg', 'uploads/image/20170419/1492588249.jpg', 150838, 'image', 1492582767),
(59, '1492586092.jpg', 'uploads/image/20170419/1492586092.jpg', 204093, 'image', 1492582769),
(60, '1492587468.jpg', 'uploads/image/20170419/1492587468.jpg', 101145, 'image', 1492582770),
(61, '1492589667.jpg', 'uploads/image/20170419/1492589667.jpg', 70481, 'image', 1492582771),
(62, '1492584828.jpg', 'uploads/image/20170419/1492584828.jpg', 150838, 'image', 1492582794),
(63, '1492590858.jpg', 'uploads/image/20170419/1492590858.jpg', 76513, 'image', 1492582796),
(64, '1492592278.jpg', 'uploads/image/20170419/1492592278.jpg', 478849, 'image', 1492582797),
(65, '1492590597.jpg', 'uploads/image/20170419/1492590597.jpg', 150838, 'image', 1492582818),
(66, '1492584178.jpg', 'uploads/image/20170419/1492584178.jpg', 88681, 'image', 1492582819),
(67, '1492587928.jpg', 'uploads/image/20170419/1492587928.jpg', 102955, 'image', 1492582821),
(68, '1492588298.jpg', 'uploads/image/20170419/1492588298.jpg', 82027, 'image', 1492582822),
(69, '1492591578.jpg', 'uploads/image/20170419/1492591578.jpg', 150838, 'image', 1492582847),
(70, '1492592744.jpg', 'uploads/image/20170419/1492592744.jpg', 359992, 'image', 1492582848),
(71, '1492589558.jpg', 'uploads/image/20170419/1492589558.jpg', 204093, 'image', 1492582849),
(72, '1492585151.jpg', 'uploads/image/20170419/1492585151.jpg', 101145, 'image', 1492582850),
(73, '1492586849.jpg', 'uploads/image/20170419/1492586849.jpg', 300727, 'image', 1492582879),
(74, '1492589101.jpg', 'uploads/image/20170419/1492589101.jpg', 29251, 'image', 1492582880),
(75, '1492588086.jpg', 'uploads/image/20170419/1492588086.jpg', 68148, 'image', 1492582881),
(76, '1492588238.jpg', 'uploads/image/20170419/1492588238.jpg', 123018, 'image', 1492582911),
(77, '1492589838.jpg', 'uploads/image/20170419/1492589838.jpg', 617084, 'image', 1492582912),
(78, '1492591521.jpg', 'uploads/image/20170419/1492591521.jpg', 70481, 'image', 1492582914),
(79, '1492585244.jpg', 'uploads/image/20170419/1492585244.jpg', 25305, 'image', 1492582915),
(80, '1492589436.jpg', 'uploads/image/20170419/1492589436.jpg', 155054, 'image', 1492582941),
(81, '1492587952.jpg', 'uploads/image/20170419/1492587952.jpg', 347163, 'image', 1492582942),
(82, '1492584658.jpg', 'uploads/image/20170419/1492584658.jpg', 100077, 'image', 1492582965),
(83, '1492583282.jpg', 'uploads/image/20170419/1492583282.jpg', 150838, 'image', 1492582967),
(84, '1492589839.jpg', 'uploads/image/20170419/1492589839.jpg', 131008, 'image', 1492582993),
(85, '1492584070.jpg', 'uploads/image/20170419/1492584070.jpg', 67006, 'image', 1492582994),
(86, '1492592031.jpg', 'uploads/image/20170419/1492592031.jpg', 150838, 'image', 1492583019),
(87, '1492589769.jpg', 'uploads/image/20170419/1492589769.jpg', 573097, 'image', 1492583020),
(88, '1492587961.jpg', 'uploads/image/20170419/1492587961.jpg', 66988, 'image', 1492583021),
(89, '1492588641.jpg', 'uploads/image/20170419/1492588641.jpg', 114803, 'image', 1492583022),
(90, '1492586090.jpg', 'uploads/image/20170419/1492586090.jpg', 127495, 'image', 1492583053),
(91, '1492590612.jpg', 'uploads/image/20170419/1492590612.jpg', 103305, 'image', 1492583054),
(92, '1492584583.jpg', 'uploads/image/20170419/1492584583.jpg', 204093, 'image', 1492583056),
(93, '1492589225.jpg', 'uploads/image/20170419/1492589225.jpg', 328263, 'image', 1492583104),
(94, '1492586396.jpg', 'uploads/image/20170419/1492586396.jpg', 68148, 'image', 1492583105),
(95, '1492586953.jpg', 'uploads/image/20170419/1492586953.jpg', 35786, 'image', 1492583140),
(96, '1492591696.jpg', 'uploads/image/20170419/1492591696.jpg', 39355, 'image', 1492583141),
(97, '1492591624.jpg', 'uploads/image/20170419/1492591624.jpg', 46218, 'image', 1492583142),
(98, '1492591407.jpg', 'uploads/image/20170419/1492591407.jpg', 617084, 'image', 1492583182),
(99, '1492592236.jpg', 'uploads/image/20170419/1492592236.jpg', 70481, 'image', 1492583183),
(100, '1492586556.jpg', 'uploads/image/20170419/1492586556.jpg', 258556, 'image', 1492583210),
(101, '1492589689.jpg', 'uploads/image/20170419/1492589689.jpg', 35786, 'image', 1492583211),
(102, '1492588982.jpg', 'uploads/image/20170419/1492588982.jpg', 70481, 'image', 1492583212);

-- --------------------------------------------------------

--
-- 表的结构 `pmw_webconfig`
--

CREATE TABLE IF NOT EXISTS `pmw_webconfig` (
  `siteid` smallint(5) unsigned NOT NULL DEFAULT '1' COMMENT '站点id',
  `varname` varchar(50) NOT NULL COMMENT '变量名称',
  `varinfo` varchar(80) NOT NULL COMMENT '参数说明',
  `vargroup` smallint(5) unsigned NOT NULL COMMENT '所属组',
  `vartype` char(10) NOT NULL COMMENT '变量类型',
  `varvalue` text NOT NULL COMMENT '变量值',
  `orderid` smallint(5) unsigned NOT NULL COMMENT '排列排序',
  PRIMARY KEY (`varname`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `pmw_webconfig`
--

INSERT INTO `pmw_webconfig` (`siteid`, `varname`, `varinfo`, `vargroup`, `vartype`, `varvalue`, `orderid`) VALUES
(1, 'cfg_webname', '网站名称', 0, 'string', '玖易提后台登录管理系统', 1),
(1, 'cfg_weburl', '网站地址', 0, 'string', 'http://localhost:81', 2),
(1, 'cfg_webpath', '网站目录', 0, 'string', '/jiuyiti/', 3),
(1, 'cfg_author', '网站作者', 0, 'string', 'admin', 4),
(1, 'cfg_generator', '程序引擎', 0, 'string', 'PHPMyWind CMS', 5),
(1, 'cfg_seotitle', 'SEO标题', 0, 'string', '', 6),
(1, 'cfg_keyword', '关键字设置', 0, 'string', '', 7),
(1, 'cfg_description', '网站描述', 0, 'bstring', '', 8),
(1, 'cfg_copyright', '版权信息', 0, 'bstring', 'Copyright © 2010 - 2015 phpMyWind.com All Rights Reserved', 9),
(1, 'cfg_hotline', '客服热线', 0, 'string', '400-800-8888', 10),
(1, 'cfg_icp', '备案编号', 0, 'string', '', 11),
(1, 'cfg_webswitch', '启用站点', 0, 'bool', 'Y', 12),
(1, 'cfg_switchshow', '关闭说明', 0, 'bstring', '对不起，网站维护，请稍后登录。<br />网站维护期间对您造成的不便，请谅解！', 13),
(1, 'cfg_upload_img_type', '上传图片类型', 1, 'string', 'gif|png|jpg|bmp', 23),
(1, 'cfg_upload_soft_type', '上传软件类型', 1, 'string', 'zip|gz|rar|iso|doc|xls|ppt|wps|txt', 24),
(1, 'cfg_upload_media_type', '上传媒体类型', 1, 'string', 'swf|flv|mpg|mp3|rm|rmvb|wmv|wma|wav', 25),
(1, 'cfg_max_file_size', '上传文件大小', 1, 'string', '2097152', 26),
(1, 'cfg_imgresize', '自动缩略图方式　<br />(是"裁切",否"填充")', 1, 'bool', 'Y', 27),
(1, 'cfg_countcode', '流量统计代码', 1, 'bstring', '', 28),
(1, 'cfg_qqcode', '在线QQ　<br />(多个用","分隔)', 1, 'bstring', '', 29),
(1, 'cfg_mysql_type', '数据库类型(支持mysql和mysqli)', 2, 'string', 'mysqli', 40),
(1, 'cfg_pagenum', '每页显示记录数', 2, 'string', '20', 41),
(1, 'cfg_timezone', '服务器时区设置', 2, 'string', '8', 42),
(1, 'cfg_mobile', '自动跳转手机版', 2, 'bool', 'Y', 43),
(1, 'cfg_member', '开启会员功能', 2, 'bool', 'Y', 44),
(1, 'cfg_oauth', '开启一键登录', 2, 'bool', 'Y', 45),
(1, 'cfg_comment', '开启文章评论', 2, 'bool', 'Y', 46),
(1, 'cfg_maintype', '开启二级类别', 2, 'bool', 'N', 47),
(1, 'cfg_typefold', '类别默认折叠', 2, 'bool', 'N', 48),
(1, 'cfg_quicktool', '管理页工具条', 2, 'bool', 'Y', 49),
(1, 'cfg_diserror', 'PHP错误显示', 2, 'bool', 'Y', 50),
(1, 'cfg_isreurl', '是否启用伪静态', 3, 'bool', 'Y', 60),
(1, 'cfg_reurl_index', '首页规则', 3, 'string', 'index.html', 61),
(1, 'cfg_reurl_about', '关于我们页', 3, 'string', '{about}-{cid}-{page}.html', 62),
(1, 'cfg_reurl_news', '新闻中心页', 3, 'string', '{news}-{cid}-{page}.html', 63),
(1, 'cfg_reurl_newsshow', '新闻内容页', 3, 'string', '{newsshow}-{cid}-{id}-{page}.html', 64),
(1, 'cfg_reurl_product', '产品展示页', 3, 'string', '{product}-{cid}-{page}.html', 65),
(1, 'cfg_reurl_productshow', '产品内容页', 3, 'string', '{productshow}-{cid}-{id}-{page}.html', 66),
(1, 'cfg_reurl_case', '案例展示页', 3, 'string', '{case}-{cid}-{page}.html', 67),
(1, 'cfg_reurl_caseshow', '案例内容页', 3, 'string', '{caseshow}-{cid}-{id}-{page}.html', 68),
(1, 'cfg_reurl_join', '人才招聘页', 3, 'string', '{join}-{page}.html', 69),
(1, 'cfg_reurl_joinshow', '招聘内容页', 3, 'string', '{joinshow}-{id}.html', 70),
(1, 'cfg_reurl_message', '客户留言页', 3, 'string', '{message}-{page}.html', 71),
(1, 'cfg_reurl_contact', '联系我们页', 3, 'string', '{contact}-{cid}-{page}.html', 72),
(1, 'cfg_reurl_soft', '软件下载页', 3, 'string', '{soft}-{cid}-{page}.html', 73),
(1, 'cfg_reurl_softshow', '软件内容页', 3, 'string', '{softshow}-{cid}-{id}-{page}.html', 74),
(1, 'cfg_reurl_goods', '商品展示页', 3, 'string', '{goods}-{cid}-{tid}-{page}.html', 75),
(1, 'cfg_reurl_goodsshow', '商品内容页', 3, 'string', '{goodsshow}-{cid}-{tid}-{id}-{page}.html', 76),
(1, 'cfg_reurl_vote', '投票内容页', 3, 'string', '{vote}-{id}.html', 77),
(1, 'cfg_reurl_custom', '自定义规则', 3, 'string', '{file}.html', 78),
(1, 'cfg_auth_key', '网站标识码', 4, 'string', 'YjLUiZrBrQqdDnSk', 90),
(1, 'cfg_alipay_uname', '支付宝帐户', 4, 'string', '', 91),
(1, 'cfg_alipay_partner', '支付宝合作身份者ID', 4, 'string', '', 92),
(1, 'cfg_alipay_key', '支付宝安全检验码', 4, 'string', '', 93),
(1, 'cfg_qq_appid', 'QQ登录组件AppID', 4, 'string', '', 94),
(1, 'cfg_qq_appkey', 'QQ登录组件AppKey', 4, 'string', '', 95),
(1, 'cfg_weibo_appid', '微博登录组件AppID', 4, 'string', '', 96),
(1, 'cfg_weibo_appkey', '微博登录组件AppKey', 4, 'string', '', 97),
(1, 'cfg_address', '公司地址', 0, 'string', '', 98),
(1, 'cfg_jishu', '技术支持', 0, 'string', '武汉众睿科技', 99);

-- --------------------------------------------------------

--
-- 表的结构 `pushmessage`
--

CREATE TABLE IF NOT EXISTS `pushmessage` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `MessageId` varchar(255) DEFAULT NULL,
  `Message` text,
  `Account` varchar(255) DEFAULT NULL,
  `Title` varchar(255) DEFAULT NULL,
  `CreatTime` datetime DEFAULT NULL,
  `MessageType` varchar(255) DEFAULT NULL,
  `Commercial` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=gb2312 AUTO_INCREMENT=57 ;

--
-- 转存表中的数据 `pushmessage`
--

INSERT INTO `pushmessage` (`id`, `MessageId`, `Message`, `Account`, `Title`, `CreatTime`, `MessageType`, `Commercial`) VALUES
(8, '7fd1b2ee-6724-4e4d-b346-43e52fd35e12', '222222222', ',13554110890,', '111111111', '2015-09-06 16:17:16', NULL, 'admin'),
(10, 'bee01223-87dc-43aa-9120-b5828f88d6e2', 'testy不', ',13797067530,', 'test', '2015-09-07 20:23:50', NULL, 'admin'),
(12, 'a7c0d797-40d3-4bb4-acd5-fdb103e602a2', '{"Auth":"","CreatTime":"2015-10-26 22:20:41","Message":"dgsdgsd"}', 'qweqwe', 'adfad', '2015-10-27 20:52:02', '1', NULL),
(13, '6a79ed08-8041-4883-ab8a-576824a91e8f', '{"Auth":"","CreatTime":"2015-10-26 22:20:41","Message":"fdsf","Money":"","Title":"sad"}', 'qweqwe', 'adfad', '2015-10-27 20:52:42', '1', NULL),
(14, 'e9f51055-e53a-4907-8d35-0ec9caed8567', '{"Auth":"","CreatTime":"2015-10-26 22:20:41","Message":"fdsf","Money":"","Title":"sad"}', 'qweqwe', 'adfad', '2015-10-27 20:52:48', '1', NULL),
(15, '0ae0c4dc-4e7b-4206-a67d-31428282e6a6', '{"Auth":"","CreatTime":"2015-10-26 22:20:41","Message":"fdsf","Money":"","Title":"sad"}', 'qweqwe', 'adfad', '2015-10-27 21:10:19', '1', NULL),
(16, '5b8ef116-66bf-4416-bc68-c25e524896d4', '{"Auth":"","CreatTime":"2015-10-26 22:20:41","Message":"fdsf","Money":"","Title":"sad"}', 'qweqwe', 'adfad', '2015-10-27 21:10:19', '1', NULL),
(17, '68542aba-5ba8-4a93-b8bd-4068b11c2826', '{Auth:,CreatTime:2015-10-26 22:20:41,Message:fdsf,Money:,Title:sad}', 'qweqwe', 'adfad', '2015-10-27 21:10:40', '1', NULL),
(18, '75d71b64-b06a-4bec-bebd-a16f24657391', '{"Auth":"","CreatTime":"2015-10-26 22:20:41","Message":"fdsf","Money":"","Title":"sad"}', 'qweqwe', 'adfad', '2015-10-27 21:20:05', '1', NULL),
(19, 'da0bab38-b959-4b5f-bbd3-93edbd198a3b', '{"Auth":"","CreatTime":"2015-10-26 22:20:41","Message":"fdsf","Money":"","Title":"sad"}', 'qweqwe', 'adfad', '2015-10-27 21:47:02', '1', NULL),
(20, 'd833fabf-87fa-41bd-8500-4455f1bf9106', '{"Auth":"","CreatTime":"2015-10-27 22:25:37","Message":"aaa","Money":"","Title":"aaa"}', '2525', 'aaa', '2015-10-27 22:25:52', '1', NULL),
(21, '0499e480-d065-49d1-b2bb-481937107a7f', '{"Auth":"","CreatTime":"2015-11-05 10:05:54","Message":"Ggg","Money":"","Title":"Aaa"}', 'Hjsn', 'Aaa', '2015-11-05 10:06:09', '1', NULL),
(24, '572c29d1-441a-4ec1-b74c-2b0912da919b', '222', ',13554110890,', '111', '2015-11-11 10:25:36', NULL, 'admin'),
(25, 'f5b2a672-b3ec-402c-bded-2326737007e0', '222', ',13554090436,', '111', '2015-11-11 10:27:03', NULL, 'admin'),
(26, 'eb784d32-a6c6-42a6-a350-dfb66cbc22b6', '您已成功提走了订单号为d8d43c96-f84c-472e-a9fa-8c758bd05078的商品', '13554090436', '提货通知', '2015-11-24 15:21:08', '0', NULL),
(27, '01078765-d85b-4aa9-bbde-bdd0094df344', '222', '13554090436', '111', '2015-11-24 15:26:54', NULL, 'admin'),
(28, '8841f68b-ee1c-453a-b72a-ef595a532be3', '内容内容内容内容内容', '13554090436', '广告标题广告标题广告标题', '2015-11-27 09:11:44', NULL, 'admin'),
(29, '1696694b-24e8-4cf9-a70f-51038dfca8ff', '4565464456', ',13554090436,', '1212313121', '2015-11-27 09:13:25', NULL, 'admin'),
(30, 'f0e99c32-9225-464b-a134-dd57287c356d', '您已成功提走了订单号为4cf7fa74-a079-4c30-98d2-d1ddbb627e67的商品', '13797067530', '提货通知', '2015-12-01 21:24:42', '0', NULL),
(31, 'b1e6959d-58ec-45dd-9a30-f27b298a451f', '{"Auth":"aaa","CreatTime":"2015-12-01 21:26:11","Message":"白云边12年，好酒","Money":"","Title":"白云边12年"}', '13797067530', '白云边12年', '2015-12-01 21:25:41', '1', NULL),
(32, 'f28ae25a-53da-45f9-9496-c8504a234f25', '{"Auth":"aaa","CreatTime":"2015-12-01 21:30:48","Message":"白云边12年，好酒","Money":"","Title":"白云边12年"}', '13797067530', '白云边12年', '2015-12-01 21:30:18', '1', NULL),
(33, '035c5aa1-92a8-465c-9334-9901fccaf912', '{"Auth":"aaa","CreatTime":"2015-12-01 21:37:04","Message":"白云边12年，好酒","Money":"","Title":"白云边12年"}', '13797067530', '白云边12年', '2015-12-01 21:36:35', '1', NULL),
(34, 'e0661d62-c25c-40d0-8f18-68a89dc95c81', '{"Auth":"aaa","CreatTime":"2015-12-01 21:38:22","Message":"白云边12年，好酒","Money":"","Title":"白云边12年"}', '13797067530', '白云边12年', '2015-12-01 21:37:53', '1', NULL),
(35, '220fd914-7987-4ed4-a8bf-a0ec5fc6b1a7', '{"Auth":"aaa","CreatTime":"2015-12-01 21:48:58","Message":"白云边12年，好酒","Money":"","Title":"白云边12年"}', '13797067530', '白云边12年', '2015-12-01 21:48:28', '1', NULL),
(36, 'f38849c4-9545-48d7-a9ce-587acc162238', '{"Auth":"aaa","CreatTime":"2015-12-01 22:09:16","Message":"白云边12年，好酒","Money":"","Title":"白云边12年"}', '13797067530', '白云边12年', '2015-12-01 22:08:47', '1', NULL),
(37, '784da03d-ede4-43a7-a277-fae5bcdc0627', '您已成功提走了订单号为5647de37-07ce-472a-887e-8f7457ab138f的商品', '13797067530', '提货通知', '2015-12-02 21:49:22', '0', NULL),
(38, '0d707a48-ed78-4bad-bf06-e532c67f4a6b', '{"Auth":"aaa","CreatTime":"2015-12-02 21:50:43","Message":"白云边测试，测试","Money":"","Title":"白云边12年，测试测试"}', '13797067530', '白云边12年，测试测试', '2015-12-02 21:50:11', '1', NULL),
(40, '3015b967-4780-4364-b2a6-d17b75601381', '{"Auth":"aaa","CreatTime":"2015-12-02 21:55:45","Message":"白云边测试，测试","Money":"","Title":"白云边12年，测试测试"}', '13797067530', '白云边12年，测试测试', '2015-12-02 21:55:14', '1', NULL),
(42, 'bd769649-cb12-40b0-b88d-d64e8782d70d', '{"Auth":"aaa","CreatTime":"2015-12-02 21:58:18","Message":"白云边测试，测试","Money":"","Title":"白云边12年，测试测试"}', '13797067530', '白云边12年，测试测试', '2015-12-02 21:57:47', '1', NULL),
(44, '28742c01-7ff9-4d6f-8da2-ab84e2e8644c', '您已成功提走了订单号为58d53a7b-8e93-4b87-945d-4d1dd3a5aa34的商品', '13797067530', '提货通知', '2015-12-02 22:06:03', '0', NULL),
(45, '09fc6fbd-ce1f-4fdf-a1a4-abd586b2668f', '{"Auth":"aaa","CreatTime":"2015-12-02 22:07:19","Message":"战火纷飞回家","Money":"","Title":"阿迪"}', '13797067530', '阿迪', '2015-12-02 22:06:48', '1', NULL),
(46, 'ab1b5222-1bab-40ca-9122-3a9a07842a3c', '您已成功提走了订单号为99775bf2-9244-4a59-b865-d106492e7fe4的商品', '13797067530', '提货通知', '2015-12-02 22:08:46', '0', NULL),
(47, 'f0a24b3e-de75-4382-ac2f-7f43a8a0d212', '您已成功提走了订单号为1d2e1e25-6567-42fd-924a-e712ab5844cf的商品', '13797067530', '提货通知', '2015-12-02 22:14:32', '0', NULL),
(48, '9a33afb0-54d6-4a9b-8cc0-d24cabcd7a30', '您已成功提走了订单号为77bfc59f-0f30-4661-b9f1-cfef260916a2的商品', '13797067530', '提货通知', '2015-12-02 22:16:18', '0', NULL),
(49, '5a794972-8722-4ba1-ad41-463ea3931886', '您已成功提走了订单号为0b150969-2226-4399-8296-acd7010b8e85的商品', '13797067530', '提货通知', '2015-12-02 22:26:47', '0', NULL),
(50, '41c3d1bf-af0b-4330-b10b-69e2549e64ae', '{"Auth":"aaa","CreatTime":"2015-12-10 18:12:42","Message":"fjhcg","Money":"","Title":"dgg"}', '13797067530', 'dgg', '2015-12-10 18:12:45', '1', NULL),
(52, 'aaaafdbd-7739-47d9-940c-bf3c84e60e3d', '您已成功提走了订单号为c16af399-26b5-47a0-aaf3-3c07f9fab8f4的商品', '13872213857', '提货通知', '2015-12-25 13:54:25', '0', NULL),
(53, '408b0c1a-a5a0-4a9e-9f65-799e4bef654b', '您已成功提走了订单号为32fba6a9-0ccd-4d30-8f3e-eaf5e8729c2d的商品', '13872213857', '提货通知', '2015-12-25 14:14:06', '0', NULL),
(54, '511a5d0d-5364-4b43-9b45-e64a3dde6e83', '您已成功提走了订单号为cc9245c4-04e6-4e59-a429-70677d0ba842的商品', '13554090436', '提货通知', '2016-01-15 10:55:18', '0', NULL),
(56, '05xRKBQRQlEOQ4TZJpW3', '111111111111111', '1111111', '11111111111111', '2017-04-17 04:31:21', NULL, NULL);

-- --------------------------------------------------------

--
-- 表的结构 `shoppingcart`
--

CREATE TABLE IF NOT EXISTS `shoppingcart` (
  `Id` varchar(100) NOT NULL DEFAULT '',
  `CommodityId` varchar(100) DEFAULT NULL,
  `CommodityNumber` varchar(100) DEFAULT NULL,
  `UserId` varchar(100) DEFAULT NULL,
  `CreatTime` datetime DEFAULT NULL,
  `StandbyOne` varchar(500) DEFAULT NULL,
  `StandbyTwo` varchar(500) DEFAULT NULL,
  `StandbyThree` varchar(500) DEFAULT NULL,
  `StandbyFore` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=gb2312;

--
-- 转存表中的数据 `shoppingcart`
--

INSERT INTO `shoppingcart` (`Id`, `CommodityId`, `CommodityNumber`, `UserId`, `CreatTime`, `StandbyOne`, `StandbyTwo`, `StandbyThree`, `StandbyFore`) VALUES
('05166a22-b114-4235-b50d-97b28411a179', '3efccaf7-fd35-4dd9-ac26-9723c3840d12', '1', '114f50f1-8734-4b84-972e-d5173009d5ea', '2015-08-27 16:39:22', NULL, NULL, NULL, NULL),
('290ac8d7-e0a7-400f-92a7-75a8aebc560d', 'a1e65bd1-9501-4ba9-baa2-92881ab81dff', '1', '15902736382', '2015-12-10 12:52:29', NULL, NULL, NULL, NULL),
('293830c7-416a-4728-8436-9a206868c4df', '159052c4-1271-4d95-a30c-4183d712c678', '3', '100000', '2015-08-28 17:30:28', NULL, NULL, NULL, NULL),
('2c958cfe-8cdb-4a31-a697-5184fb32b9dc', 'e9b09e38-d110-4e13-be03-fd80c744e4f9', '2', '5724c1c7-eec8-4c55-955c-58ba0b83a0ab', '2015-09-04 17:07:57', NULL, NULL, NULL, NULL),
('2d1631fb-ab9f-4e77-b0ed-f73e9439ed2a', '159052c4-1271-4d95-a30c-4183d712c678', '1', '100000', '2015-09-02 21:11:59', NULL, NULL, NULL, NULL),
('2d36ea63-c486-4dd2-af6f-5c193f1fc9e9', 'dd3482d7-a5cf-4d0a-86e2-3dcda1d4e52b', '1', '823a1f7f-c7fe-4b47-9767-7b2800b5ea43', '2015-12-12 10:26:49', NULL, NULL, NULL, NULL),
('2f11117d-3cab-4195-9e03-ff7f997609d3', '66368fea-af22-439e-bbde-e52af1fc4847', '1', '13797067530', '2015-12-12 16:50:11', NULL, NULL, NULL, NULL),
('4025eebd-2732-4767-a961-618b2d9bd5bd', '8e06c093-b457-4cd2-a6ec-091d9405d88f', '1', '(null)', '2015-09-08 19:48:49', NULL, NULL, NULL, NULL),
('4283a28b-6add-4d2f-b4cf-9b130122e0e2', '06fb365f-3329-4780-bebc-0ff3f039ede1', '1', '100000', '2015-08-28 19:13:49', NULL, NULL, NULL, NULL),
('428ce0c1-be06-480e-9f08-65595f548a4e', 'e9b09e38-d110-4e13-be03-fd80c744e4f9', '1', '90bd24b7-1597-495f-ae7c-43f1dc22f553', '2015-08-27 16:35:50', NULL, NULL, NULL, NULL),
('438e0f1f-5796-48a3-a735-ae3f5b6705da', '66368fea-af22-439e-bbde-e52af1fc4847', '1', 'bcf9a7a8-5e6f-4a89-9992-39e047bf41f4', '2017-04-12 09:18:52', NULL, NULL, NULL, NULL),
('4a8cd42c-ed36-4066-8567-d21264158400', '8e06c093-b457-4cd2-a6ec-091d9405d88f', '1', '03d56612-d159-4e5d-9ee1-f419b818f3a8', '2015-09-07 21:27:07', NULL, NULL, NULL, NULL),
('53b3659b-ccbb-41b5-a175-fb349879265f', 'a8d9add9-a9c2-4e61-b0ce-b65cb3cf2172', '11', 'b05dc9f5-39ae-4550-874d-a8c5e6aec11d', '2015-11-05 22:59:44', NULL, NULL, NULL, NULL),
('550b30cd-713f-46e4-bb17-4cd4c990644a', '437fc53e-89fb-4036-9e0a-52d73102e47b', '1', '100000', '2015-08-27 15:04:16', NULL, NULL, NULL, NULL),
('587926d4-e07a-4c31-82a7-8241042f63d2', 'e9b09e38-d110-4e13-be03-fd80c744e4f9', '1', '03d56612-d159-4e5d-9ee1-f419b818f3a8', '2015-09-01 21:49:13', NULL, NULL, NULL, NULL),
('58e6655d-d62d-49a6-99d0-996164bd9795', '25fe2151-983f-454a-8dbe-97675d876eec', '1', '100000', '2015-08-28 17:37:24', NULL, NULL, NULL, NULL),
('5d0f1fab-2faa-4538-bc31-1bf6b6b1d516', '437fc53e-89fb-4036-9e0a-52d73102e47b', '1', '100000', '2015-08-23 12:42:43', NULL, NULL, NULL, NULL),
('5f503443-76c5-4438-a82f-8e29f62a743f', '8e06c093-b457-4cd2-a6ec-091d9405d88f', '2', '5724c1c7-eec8-4c55-955c-58ba0b83a0ab', '2015-11-02 09:46:05', NULL, NULL, NULL, NULL),
('64b37676-3c04-43f5-af00-ce64ca84add9', 'bf1f8ad5-1120-4b84-acfb-69fef0accef8', '1', '100000', '2015-08-22 16:51:07', NULL, NULL, NULL, NULL),
('6541d7c8-8e4c-42a1-993f-b929e7f45e3f', NULL, NULL, NULL, '2015-10-28 22:29:24', NULL, NULL, NULL, NULL),
('6a6fb7cb-f1bb-4519-8fe2-149da90938b6', '8e06c093-b457-4cd2-a6ec-091d9405d88f', '1', '128b5458-4e88-43e0-9528-b4c63adb40e2', '2015-11-02 15:38:20', NULL, NULL, NULL, NULL),
('6cc3510a-4fc2-4b69-a6bc-851b51981e2f', '159052c4-1271-4d95-a30c-4183d712c678', '4', '100000', '2015-09-02 21:54:56', NULL, NULL, NULL, NULL),
('71e3b3a4-1489-4e5c-8c4c-ccdec7e189ab', '9725ae48-0357-4dd3-9660-eecab7756667', '1', '5724c1c7-eec8-4c55-955c-58ba0b83a0ab', '2015-09-06 09:22:02', NULL, NULL, NULL, NULL),
('744658b7-24fc-479d-bbb3-7bed7430442a', 'a985cddf-f12c-4192-b016-41a02f7d2311', '1', '03d56612-d159-4e5d-9ee1-f419b818f3a8', '2015-09-01 21:49:26', NULL, NULL, NULL, NULL),
('78aa59fb-075c-49cb-8109-7248a9543d11', '25fe2151-983f-454a-8dbe-97675d876eec', '1', '100000', '2015-08-28 17:07:55', NULL, NULL, NULL, NULL),
('7aa262c9-f5d4-4239-94a5-9cedb683f4c9', '437fc53e-89fb-4036-9e0a-52d73102e47b', '1', '100000', '2015-08-27 15:04:13', NULL, NULL, NULL, NULL),
('7d59597e-9f37-426d-8f6e-52c347b71e77', '85f664da-1c87-4e8e-ba9d-5973468523d7', '1', '03d56612-d159-4e5d-9ee1-f419b818f3a8', '2015-10-28 21:20:02', NULL, NULL, NULL, NULL),
('86dd6024-1c17-431d-afb1-7603ca97cbf4', 'e9b09e38-d110-4e13-be03-fd80c744e4f9', '1', 'acd13c2c-6f49-4e8a-a9b1-4a4ecd9b40aa', '2015-09-05 17:32:23', NULL, NULL, NULL, NULL),
('8c8f7fdb-5034-4a15-9cea-ebe215c4571f', '159052c4-1271-4d95-a30c-4183d712c678', '1', '037cab80-eaf3-4464-ba64-b63b3f8ce913', '2015-08-29 12:50:30', NULL, NULL, NULL, NULL),
('92e1f326-e0d9-482d-a8c6-823746b3cb5d', 'a985cddf-f12c-4192-b016-41a02f7d2311', '1', 'f163cac2-3ecd-488a-9998-669f00b0e574', '2015-08-29 14:23:09', NULL, NULL, NULL, NULL),
('a1f4710e-d61f-45e5-8f10-62c35a6d6664', 'a04f599d-8b4f-4c01-9e41-0162ba0dff22', '1', '13797067530', '2015-12-12 16:53:27', NULL, NULL, NULL, NULL),
('a5c6ee95-41b2-4cd4-b064-afa30881a6c1', '67bf2de4-9827-4a5f-822f-8eda5bd31936', '3', '03d56612-d159-4e5d-9ee1-f419b818f3a8', '2015-10-28 21:03:45', NULL, NULL, NULL, NULL),
('aa7aba7e-a2db-4ac6-9603-f4392d1af019', '159052c4-1271-4d95-a30c-4183d712c678', '4', '128b5458-4e88-43e0-9528-b4c63adb40e2', '2015-11-02 16:20:02', NULL, NULL, NULL, NULL),
('acfbc92d-a83d-4c63-aeeb-ef0611e6d281', 'b8fd47f1-2f93-43ed-bd10-d23faa81fe50', '2', '03d56612-d159-4e5d-9ee1-f419b818f3a8', '2015-10-28 22:45:31', NULL, NULL, NULL, NULL),
('adfa8c64-8300-48ff-a2b2-3277f74a09c3', 'b8fd47f1-2f93-43ed-bd10-d23faa81fe50', '5', '823a1f7f-c7fe-4b47-9767-7b2800b5ea43', '2015-11-10 20:11:36', NULL, NULL, NULL, NULL),
('b13f3cd8-4a91-4f3b-a7b8-faab106bb342', '8e06c093-b457-4cd2-a6ec-091d9405d88f', '1', '(null)', '2015-09-08 20:03:48', NULL, NULL, NULL, NULL),
('b1d1991c-5dc6-433a-8032-06ce2fbfd184', '3fca76b8-d4d0-4f28-ba4a-797b56751716', '1', '5724c1c7-eec8-4c55-955c-58ba0b83a0ab', '2015-09-06 09:21:36', NULL, NULL, NULL, NULL),
('b26226a7-40dc-4bc4-90ff-19ab67063c72', 'b8fd47f1-2f93-43ed-bd10-d23faa81fe50', '11', 'f2b39800-234d-47d1-a2f4-83f896c9f380', '2015-09-06 17:06:30', NULL, NULL, NULL, NULL),
('b958ad3c-8fa8-48da-8aff-d221d8128da0', '25fe2151-983f-454a-8dbe-97675d876eec', '1', '100000', '2015-08-28 17:08:23', NULL, NULL, NULL, NULL),
('ba7c8682-3ffe-4933-979f-75c85580a5f9', '159052c4-1271-4d95-a30c-4183d712c678', '1', 'acd13c2c-6f49-4e8a-a9b1-4a4ecd9b40aa', '2015-09-05 17:33:01', NULL, NULL, NULL, NULL),
('c173a81c-4985-45fd-b3cc-fbdc519c08f9', '8e06c093-b457-4cd2-a6ec-091d9405d88f', '1', '(null)', '2015-09-08 20:06:04', NULL, NULL, NULL, NULL),
('c58ac585-5e0f-4f6b-bf2c-2a6548457c99', 'e9b09e38-d110-4e13-be03-fd80c744e4f9', '2', '5724c1c7-eec8-4c55-955c-58ba0b83a0ab', '2015-09-06 09:19:57', NULL, NULL, NULL, NULL),
('c9860bd8-ad46-4033-97e5-cc4147864461', '92c048d7-c9d5-424a-8ffc-da54ffdc5de7', '1', '13797067530', '2015-12-12 16:53:20', NULL, NULL, NULL, NULL),
('c9de72f7-dd30-435c-8ca7-3ebf90a49be2', '159052c4-1271-4d95-a30c-4183d712c678', '1', '100000', '2015-09-02 21:56:45', NULL, NULL, NULL, NULL),
('d330d84f-100b-4602-be4a-0d424ffbc540', 'be9b40d4-067b-4110-b516-cabcdc117543', '1', '13797067530', '2015-12-12 16:50:21', NULL, NULL, NULL, NULL),
('d5a96dcd-771d-4473-92ff-88a3e231aebc', 'e9b09e38-d110-4e13-be03-fd80c744e4f9', '3', '5724c1c7-eec8-4c55-955c-58ba0b83a0ab', '2015-09-04 17:08:10', NULL, NULL, NULL, NULL),
('db3d0d0d-c3f7-43cb-b4ac-5ef2911cd511', '851b35b3-84cd-490d-a3c4-d581e09a4f35', '2', '(null)', '2015-12-09 16:23:57', NULL, NULL, NULL, NULL),
('e46022d9-b26f-4d29-8eec-1a316498c173', '67bf2de4-9827-4a5f-822f-8eda5bd31936', '1', '128b5458-4e88-43e0-9528-b4c63adb40e2', '2015-11-02 15:51:17', NULL, NULL, NULL, NULL),
('e8c7df3f-c87d-4e0a-beca-97a477579033', '437fc53e-89fb-4036-9e0a-52d73102e47b', '1', 'a5730119-a3f7-422a-8214-ff666da29ccd', '2015-08-22 12:48:29', NULL, NULL, NULL, NULL),
('ee986833-3f59-48b0-b6ac-8ffbe674029f', 'b8fd47f1-2f93-43ed-bd10-d23faa81fe50', '13', '100000', '2015-11-07 22:06:09', NULL, NULL, NULL, NULL),
('f6ba1f88-4710-4603-9ebe-4d8b860232af', '8e06c093-b457-4cd2-a6ec-091d9405d88f', '1', '15912345678', '2015-09-08 19:42:15', NULL, NULL, NULL, NULL),
('f910be11-46f5-4c04-8bb4-bffee3367996', '851b35b3-84cd-490d-a3c4-d581e09a4f35', '1', '13797067530', '2015-12-09 11:51:35', NULL, NULL, NULL, NULL),
('feaf1f54-580e-4f82-82c6-532bf7dec9b8', 'dd3482d7-a5cf-4d0a-86e2-3dcda1d4e52b', '1', '5abc4eb6-2f52-4726-a328-3f352e340676', '2015-12-28 17:56:40', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- 表的结构 `upapp`
--

CREATE TABLE IF NOT EXISTS `upapp` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `appName` varchar(255) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `version` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=gb2312 AUTO_INCREMENT=3 ;

--
-- 转存表中的数据 `upapp`
--

INSERT INTO `upapp` (`id`, `appName`, `url`, `version`) VALUES
(1, 'wine', '/Content/1118-wine.apk', '1.0'),
(2, 'WineSeller', '/Content/1118-WineSeller.apk', '1.0');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
