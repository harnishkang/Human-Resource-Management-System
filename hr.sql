-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 28, 2019 at 07:19 AM
-- Server version: 10.1.34-MariaDB
-- PHP Version: 5.6.37

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hr`
--

-- --------------------------------------------------------

--
-- Table structure for table `allowances`
--

CREATE TABLE `allowances` (
  `id` int(11) NOT NULL,
  `t_id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `desig` varchar(50) NOT NULL,
  `trav_purp` varchar(100) NOT NULL,
  `recomm` varchar(50) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `allowchild`
--

CREATE TABLE `allowchild` (
  `id` int(11) NOT NULL,
  `parentid` int(11) NOT NULL,
  `fromval` varchar(250) NOT NULL,
  `toval` varchar(250) NOT NULL,
  `vehicle` varchar(250) NOT NULL,
  `totkms` int(11) NOT NULL,
  `totamt` double(10,8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `allowchild`
--

INSERT INTO `allowchild` (`id`, `parentid`, `fromval`, `toval`, `vehicle`, `totkms`, `totamt`) VALUES
(1, 2, 'office', 'office', 'two', 10, 25.00000000),
(2, 2, 'office', 'office', 'four', 10, 50.00000000),
(3, 3, 'office', 'office', 'two', 10, 25.00000000),
(4, 3, 'office', 'office', 'four', 10, 50.00000000);

-- --------------------------------------------------------

--
-- Table structure for table `allowence_table`
--

CREATE TABLE `allowence_table` (
  `t_id` int(11) NOT NULL,
  `sr` int(11) NOT NULL,
  `date` date NOT NULL,
  `frm` varchar(100) DEFAULT NULL,
  `two` varchar(100) DEFAULT NULL,
  `total_km` float DEFAULT NULL,
  `total_amt` float DEFAULT NULL,
  `vehicle` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `allowparent`
--

CREATE TABLE `allowparent` (
  `id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `designation` varchar(250) NOT NULL,
  `travel` varchar(250) NOT NULL,
  `recom` varchar(250) NOT NULL,
  `dt` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `allowparent`
--

INSERT INTO `allowparent` (`id`, `name`, `designation`, `travel`, `recom`, `dt`) VALUES
(1, '13', '1', 'marketing', '13', '2019-09-20'),
(2, '13', '1', 'marketing', '13', '2019-09-20'),
(3, '13', '1', 'marketing', '13', '2019-09-20');

-- --------------------------------------------------------

--
-- Table structure for table `appointletter`
--

CREATE TABLE `appointletter` (
  `id` int(11) NOT NULL,
  `empnm` varchar(350) NOT NULL,
  `dt` date NOT NULL,
  `ctc` decimal(18,2) NOT NULL,
  `joindt` date NOT NULL,
  `comp` varchar(250) NOT NULL,
  `desig` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `appointletter`
--

INSERT INTO `appointletter` (`id`, `empnm`, `dt`, `ctc`, `joindt`, `comp`, `desig`) VALUES
(22, '', '0000-00-00', '0.00', '0000-00-00', '', ''),
(23, 'Harnish Kang', '2019-09-22', '50000.00', '2019-09-23', 'infotech', 'Software Developer'),
(24, '', '0000-00-00', '0.00', '0000-00-00', '', ''),
(25, '', '0000-00-00', '0.00', '0000-00-00', '', ''),
(26, '', '0000-00-00', '0.00', '0000-00-00', '', ''),
(27, '', '0000-00-00', '0.00', '0000-00-00', '', ''),
(28, '', '0000-00-00', '0.00', '0000-00-00', '', ''),
(29, '', '0000-00-00', '0.00', '0000-00-00', '', ''),
(30, '', '0000-00-00', '0.00', '0000-00-00', '', ''),
(31, '', '0000-00-00', '0.00', '0000-00-00', '', ''),
(32, '', '0000-00-00', '0.00', '0000-00-00', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `attend_dummy`
--

CREATE TABLE `attend_dummy` (
  `id` int(20) NOT NULL DEFAULT '0',
  `name` varchar(20) NOT NULL,
  `dt` date NOT NULL,
  `empid` int(11) NOT NULL,
  `present` char(1) NOT NULL,
  `absent` char(1) NOT NULL,
  `lv` char(1) NOT NULL,
  `half` char(1) NOT NULL,
  `off` char(1) NOT NULL,
  `seqno` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `attend_dummy`
--

INSERT INTO `attend_dummy` (`id`, `name`, `dt`, `empid`, `present`, `absent`, `lv`, `half`, `off`, `seqno`) VALUES
(30, 'Harnish', '2019-09-01', 13, 'N', 'N', 'N', 'N', 'Y', 1),
(48, 'Harnish', '2019-09-02', 13, 'Y', 'N', 'N', 'N', 'N', 1),
(58, 'Harnish', '2019-09-03', 13, 'Y', 'N', 'N', 'N', 'N', 1),
(66, 'Harnish', '2019-09-04', 13, 'Y', 'N', 'N', 'N', 'N', 1),
(74, 'Harnish', '2019-09-05', 13, 'Y', 'N', 'N', 'N', 'N', 1),
(82, 'Harnish', '2019-09-06', 13, 'Y', 'N', 'N', 'N', 'N', 1),
(40, 'Harnish', '2019-09-07', 13, 'N', 'N', 'N', 'N', 'Y', 1),
(32, 'Harnish', '2019-09-08', 13, 'N', 'N', 'N', 'N', 'Y', 1),
(50, 'Harnish', '2019-09-09', 13, 'Y', 'N', 'N', 'N', 'N', 1),
(60, 'Harnish', '2019-09-10', 13, 'N', 'Y', 'N', 'N', 'N', 1),
(68, 'Harnish', '2019-09-11', 13, 'Y', 'N', 'N', 'N', 'N', 1),
(76, 'Harnish', '2019-09-12', 13, 'Y', 'N', 'N', 'N', 'N', 1),
(84, 'Harnish', '2019-09-13', 13, 'Y', 'N', 'N', 'N', 'N', 1),
(42, 'Harnish', '2019-09-14', 13, 'N', 'N', 'N', 'N', 'Y', 1),
(34, 'Harnish', '2019-09-15', 13, 'N', 'N', 'N', 'N', 'Y', 1),
(52, 'Harnish', '2019-09-16', 13, 'Y', 'N', 'N', 'N', 'N', 1),
(62, 'Harnish', '2019-09-17', 13, 'Y', 'N', 'N', 'N', 'N', 1),
(70, 'Harnish', '2019-09-18', 13, 'Y', 'N', 'N', 'N', 'N', 1),
(78, 'Harnish', '2019-09-19', 13, 'Y', 'N', 'N', 'N', 'N', 1),
(86, 'Harnish', '2019-09-20', 13, 'Y', 'N', 'N', 'N', 'N', 1),
(44, 'Harnish', '2019-09-21', 13, 'N', 'N', 'N', 'N', 'Y', 1),
(36, 'Harnish', '2019-09-22', 13, 'N', 'N', 'N', 'N', 'Y', 1),
(54, 'Harnish', '2019-09-23', 13, 'Y', 'N', 'N', 'N', 'N', 1),
(64, 'Harnish', '2019-09-24', 13, 'Y', 'N', 'N', 'N', 'N', 1),
(72, 'Harnish', '2019-09-25', 13, 'Y', 'N', 'N', 'N', 'N', 1),
(80, 'Harnish', '2019-09-26', 13, 'Y', 'N', 'N', 'N', 'N', 1),
(88, 'Harnish', '2019-09-27', 13, 'Y', 'N', 'N', 'N', 'N', 1),
(46, 'Harnish', '2019-09-28', 13, 'N', 'N', 'N', 'N', 'Y', 1),
(38, 'Harnish', '2019-09-29', 13, 'N', 'N', 'N', 'N', 'Y', 1),
(56, 'Harnish', '2019-09-30', 13, 'Y', 'N', 'N', 'N', 'N', 1),
(31, 'sam', '2019-09-01', 14, 'N', 'N', 'N', 'N', 'Y', 2),
(49, 'sam', '2019-09-02', 14, 'Y', 'N', 'N', 'N', 'N', 2),
(59, 'sam', '2019-09-03', 14, 'N', 'N', 'Y', 'N', 'N', 2),
(67, 'sam', '2019-09-04', 14, 'Y', 'N', 'N', 'N', 'N', 2),
(75, 'sam', '2019-09-05', 14, 'Y', 'N', 'N', 'N', 'N', 2),
(83, 'sam', '2019-09-06', 14, 'Y', 'N', 'N', 'N', 'N', 2),
(41, 'sam', '2019-09-07', 14, 'N', 'N', 'N', 'N', 'Y', 2),
(33, 'sam', '2019-09-08', 14, 'N', 'N', 'N', 'N', 'Y', 2),
(51, 'sam', '2019-09-09', 14, 'Y', 'N', 'N', 'N', 'N', 2),
(61, 'sam', '2019-09-10', 14, 'Y', 'N', 'N', 'N', 'N', 2),
(69, 'sam', '2019-09-11', 14, 'Y', 'N', 'N', 'N', 'N', 2),
(77, 'sam', '2019-09-12', 14, 'Y', 'N', 'N', 'N', 'N', 2),
(85, 'sam', '2019-09-13', 14, 'Y', 'N', 'N', 'N', 'N', 2),
(43, 'sam', '2019-09-14', 14, 'N', 'N', 'N', 'N', 'Y', 2),
(35, 'sam', '2019-09-15', 14, 'N', 'N', 'N', 'N', 'Y', 2),
(53, 'sam', '2019-09-16', 14, 'Y', 'N', 'N', 'N', 'N', 2),
(63, 'sam', '2019-09-17', 14, 'Y', 'N', 'N', 'N', 'N', 2),
(71, 'sam', '2019-09-18', 14, 'Y', 'N', 'N', 'N', 'N', 2),
(79, 'sam', '2019-09-19', 14, 'Y', 'N', 'N', 'N', 'N', 2),
(87, 'sam', '2019-09-20', 14, 'Y', 'N', 'N', 'N', 'N', 2),
(45, 'sam', '2019-09-21', 14, 'N', 'N', 'N', 'N', 'Y', 2),
(37, 'sam', '2019-09-22', 14, 'N', 'N', 'N', 'N', 'Y', 2),
(55, 'sam', '2019-09-23', 14, 'Y', 'N', 'N', 'N', 'N', 2),
(65, 'sam', '2019-09-24', 14, 'Y', 'N', 'N', 'N', 'N', 2),
(73, 'sam', '2019-09-25', 14, 'Y', 'N', 'N', 'N', 'N', 2),
(81, 'sam', '2019-09-26', 14, 'Y', 'N', 'N', 'N', 'N', 2),
(89, 'sam', '2019-09-27', 14, 'Y', 'N', 'N', 'N', 'N', 2),
(47, 'sam', '2019-09-28', 14, 'N', 'N', 'N', 'N', 'Y', 2),
(39, 'sam', '2019-09-29', 14, 'N', 'N', 'N', 'N', 'Y', 2),
(57, 'sam', '2019-09-30', 14, 'Y', 'N', 'N', 'N', 'N', 2);

-- --------------------------------------------------------

--
-- Table structure for table `billtyp`
--

CREATE TABLE `billtyp` (
  `billtyp` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `billtyp`
--

INSERT INTO `billtyp` (`billtyp`) VALUES
('Electricity'),
('Water');

-- --------------------------------------------------------

--
-- Table structure for table `city_master`
--

CREATE TABLE `city_master` (
  `id` int(11) NOT NULL,
  `city` varchar(250) NOT NULL,
  `stid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `city_master`
--

INSERT INTO `city_master` (`id`, `city`, `stid`) VALUES
(1, 'Chandigarh', 1);

-- --------------------------------------------------------

--
-- Table structure for table `companybills`
--

CREATE TABLE `companybills` (
  `id` int(11) NOT NULL,
  `billdt` date NOT NULL,
  `duedt` date NOT NULL,
  `typ` varchar(250) NOT NULL,
  `rem` varchar(1500) NOT NULL,
  `amt` double(12,2) NOT NULL,
  `paidto` int(11) NOT NULL,
  `postedby` varchar(250) NOT NULL,
  `postedon` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `companybills`
--

INSERT INTO `companybills` (`id`, `billdt`, `duedt`, `typ`, `rem`, `amt`, `paidto`, `postedby`, `postedon`) VALUES
(1, '2019-09-20', '2019-09-24', '0', '', 1234.00, 13, 'admin', '2019-09-22'),
(2, '2019-09-11', '2019-09-12', 'electricity', 'dfefefe', 1000.00, 13, 'admin', '2019-09-25');

-- --------------------------------------------------------

--
-- Table structure for table `daily_attend`
--

CREATE TABLE `daily_attend` (
  `id` int(20) NOT NULL,
  `name` varchar(20) NOT NULL,
  `dt` date NOT NULL,
  `empid` int(11) NOT NULL,
  `present` char(1) NOT NULL,
  `absent` char(1) NOT NULL,
  `lv` char(1) NOT NULL,
  `half` char(1) NOT NULL,
  `off` char(1) NOT NULL,
  `seqno` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `daily_attend`
--

INSERT INTO `daily_attend` (`id`, `name`, `dt`, `empid`, `present`, `absent`, `lv`, `half`, `off`, `seqno`) VALUES
(30, 'Harnish', '2019-09-01', 13, 'N', 'N', 'N', 'N', 'Y', 0),
(31, 'sam', '2019-09-01', 14, 'N', 'N', 'N', 'N', 'Y', 0),
(32, 'Harnish', '2019-09-08', 13, 'N', 'N', 'N', 'N', 'Y', 0),
(33, 'sam', '2019-09-08', 14, 'N', 'N', 'N', 'N', 'Y', 0),
(34, 'Harnish', '2019-09-15', 13, 'N', 'N', 'N', 'N', 'Y', 0),
(35, 'sam', '2019-09-15', 14, 'N', 'N', 'N', 'N', 'Y', 0),
(36, 'Harnish', '2019-09-22', 13, 'N', 'N', 'N', 'N', 'Y', 0),
(37, 'sam', '2019-09-22', 14, 'N', 'N', 'N', 'N', 'Y', 0),
(38, 'Harnish', '2019-09-29', 13, 'N', 'N', 'N', 'N', 'Y', 0),
(39, 'sam', '2019-09-29', 14, 'N', 'N', 'N', 'N', 'Y', 0),
(40, 'Harnish', '2019-09-07', 13, 'N', 'N', 'N', 'N', 'Y', 0),
(41, 'sam', '2019-09-07', 14, 'N', 'N', 'N', 'N', 'Y', 0),
(42, 'Harnish', '2019-09-14', 13, 'N', 'N', 'N', 'N', 'Y', 0),
(43, 'sam', '2019-09-14', 14, 'N', 'N', 'N', 'N', 'Y', 0),
(44, 'Harnish', '2019-09-21', 13, 'N', 'N', 'N', 'N', 'Y', 0),
(45, 'sam', '2019-09-21', 14, 'N', 'N', 'N', 'N', 'Y', 0),
(46, 'Harnish', '2019-09-28', 13, 'N', 'N', 'N', 'N', 'Y', 0),
(47, 'sam', '2019-09-28', 14, 'N', 'N', 'N', 'N', 'Y', 0),
(48, 'Harnish', '2019-09-02', 13, 'Y', 'N', 'N', 'N', 'N', 0),
(49, 'sam', '2019-09-02', 14, 'Y', 'N', 'N', 'N', 'N', 0),
(50, 'Harnish', '2019-09-09', 13, 'Y', 'N', 'N', 'N', 'N', 0),
(51, 'sam', '2019-09-09', 14, 'Y', 'N', 'N', 'N', 'N', 0),
(52, 'Harnish', '2019-09-16', 13, 'Y', 'N', 'N', 'N', 'N', 0),
(53, 'sam', '2019-09-16', 14, 'Y', 'N', 'N', 'N', 'N', 0),
(54, 'Harnish', '2019-09-23', 13, 'Y', 'N', 'N', 'N', 'N', 0),
(55, 'sam', '2019-09-23', 14, 'Y', 'N', 'N', 'N', 'N', 0),
(56, 'Harnish', '2019-09-30', 13, 'Y', 'N', 'N', 'N', 'N', 0),
(57, 'sam', '2019-09-30', 14, 'Y', 'N', 'N', 'N', 'N', 0),
(58, 'Harnish', '2019-09-03', 13, 'Y', 'N', 'N', 'N', 'N', 0),
(59, 'sam', '2019-09-03', 14, 'N', 'N', 'Y', 'N', 'N', 0),
(60, 'Harnish', '2019-09-10', 13, 'N', 'Y', 'N', 'N', 'N', 0),
(61, 'sam', '2019-09-10', 14, 'Y', 'N', 'N', 'N', 'N', 0),
(62, 'Harnish', '2019-09-17', 13, 'Y', 'N', 'N', 'N', 'N', 0),
(63, 'sam', '2019-09-17', 14, 'Y', 'N', 'N', 'N', 'N', 0),
(64, 'Harnish', '2019-09-24', 13, 'Y', 'N', 'N', 'N', 'N', 0),
(65, 'sam', '2019-09-24', 14, 'Y', 'N', 'N', 'N', 'N', 0),
(66, 'Harnish', '2019-09-04', 13, 'Y', 'N', 'N', 'N', 'N', 0),
(67, 'sam', '2019-09-04', 14, 'Y', 'N', 'N', 'N', 'N', 0),
(68, 'Harnish', '2019-09-11', 13, 'Y', 'N', 'N', 'N', 'N', 0),
(69, 'sam', '2019-09-11', 14, 'Y', 'N', 'N', 'N', 'N', 0),
(70, 'Harnish', '2019-09-18', 13, 'Y', 'N', 'N', 'N', 'N', 0),
(71, 'sam', '2019-09-18', 14, 'Y', 'N', 'N', 'N', 'N', 0),
(72, 'Harnish', '2019-09-25', 13, 'Y', 'N', 'N', 'N', 'N', 0),
(73, 'sam', '2019-09-25', 14, 'Y', 'N', 'N', 'N', 'N', 0),
(74, 'Harnish', '2019-09-05', 13, 'Y', 'N', 'N', 'N', 'N', 0),
(75, 'sam', '2019-09-05', 14, 'Y', 'N', 'N', 'N', 'N', 0),
(76, 'Harnish', '2019-09-12', 13, 'Y', 'N', 'N', 'N', 'N', 0),
(77, 'sam', '2019-09-12', 14, 'Y', 'N', 'N', 'N', 'N', 0),
(78, 'Harnish', '2019-09-19', 13, 'Y', 'N', 'N', 'N', 'N', 0),
(79, 'sam', '2019-09-19', 14, 'Y', 'N', 'N', 'N', 'N', 0),
(80, 'Harnish', '2019-09-26', 13, 'Y', 'N', 'N', 'N', 'N', 0),
(81, 'sam', '2019-09-26', 14, 'Y', 'N', 'N', 'N', 'N', 0),
(82, 'Harnish', '2019-09-06', 13, 'Y', 'N', 'N', 'N', 'N', 0),
(83, 'sam', '2019-09-06', 14, 'Y', 'N', 'N', 'N', 'N', 0),
(84, 'Harnish', '2019-09-13', 13, 'Y', 'N', 'N', 'N', 'N', 0),
(85, 'sam', '2019-09-13', 14, 'Y', 'N', 'N', 'N', 'N', 0),
(86, 'Harnish', '2019-09-20', 13, 'Y', 'N', 'N', 'N', 'N', 0),
(87, 'sam', '2019-09-20', 14, 'Y', 'N', 'N', 'N', 'N', 0),
(88, 'Harnish', '2019-09-27', 13, 'Y', 'N', 'N', 'N', 'N', 0),
(89, 'sam', '2019-09-27', 14, 'Y', 'N', 'N', 'N', 'N', 0);

-- --------------------------------------------------------

--
-- Table structure for table `deptt`
--

CREATE TABLE `deptt` (
  `id` int(11) NOT NULL,
  `deptnm` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `deptt`
--

INSERT INTO `deptt` (`id`, `deptnm`) VALUES
(1, 'Information Technology'),
(2, 'Administration'),
(3, 'Accounts'),
(4, 'Sales');

-- --------------------------------------------------------

--
-- Table structure for table `desig_master`
--

CREATE TABLE `desig_master` (
  `id` int(11) NOT NULL,
  `desig` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `desig_master`
--

INSERT INTO `desig_master` (`id`, `desig`) VALUES
(1, 'Software Developer'),
(2, 'Sr. Software Developer');

-- --------------------------------------------------------

--
-- Table structure for table `empidproof`
--

CREATE TABLE `empidproof` (
  `id` int(11) NOT NULL,
  `idimg` longblob NOT NULL,
  `idimg1` longblob NOT NULL,
  `empimgid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `empimg`
--

CREATE TABLE `empimg` (
  `id` int(11) NOT NULL,
  `empimg` longblob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `id` int(11) NOT NULL,
  `fname` varchar(20) NOT NULL,
  `lname` varchar(20) NOT NULL,
  `address1` varchar(50) NOT NULL,
  `address2` varchar(50) NOT NULL,
  `city` int(11) NOT NULL,
  `state` int(11) NOT NULL,
  `pincode` int(10) NOT NULL,
  `contact` int(10) NOT NULL,
  `email` varchar(50) NOT NULL,
  `mstatus` varchar(10) NOT NULL,
  `dob` varchar(20) NOT NULL,
  `qual` varchar(50) NOT NULL,
  `add_qual` varchar(50) NOT NULL,
  `designation` int(11) NOT NULL,
  `basic_pay` int(5) NOT NULL,
  `jdt` varchar(20) NOT NULL,
  `pt` varchar(10) DEFAULT NULL,
  `years` int(5) NOT NULL,
  `company` varchar(50) NOT NULL,
  `remark1` varchar(500) NOT NULL,
  `status` varchar(1) NOT NULL DEFAULT 'N',
  `empid` int(11) NOT NULL,
  `seqno` int(11) NOT NULL,
  `depttid` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`id`, `fname`, `lname`, `address1`, `address2`, `city`, `state`, `pincode`, `contact`, `email`, `mstatus`, `dob`, `qual`, `add_qual`, `designation`, `basic_pay`, `jdt`, `pt`, `years`, `company`, `remark1`, `status`, `empid`, `seqno`, `depttid`) VALUES
(13, 'Harnish', 'Kang', 'Chandigarh', '', 1, 1, 160022, 2147483647, 'admin@gmail.com', 'Married', '12/08/1991', 'mca', 'bca', 1, 50000, '2019-03-01', 'temporary', 4, 'wfefef', 'fefefe', 'N', 26, 1, 1),
(14, 'sam', 'Kang', 'Chandigarh', '', 1, 1, 160022, 2147483647, 'sam@gmail.com', 'Married', '12/08/1991', 'mca', 'bca', 2, 50000, '2019-03-01', 'permanent', 4, 'wfefef', 'fefefe', 'N', 27, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `guestwalk`
--

CREATE TABLE `guestwalk` (
  `id` int(11) NOT NULL,
  `guestname` varchar(250) NOT NULL,
  `timein` time NOT NULL,
  `timeout` time NOT NULL,
  `tomeet` varchar(250) NOT NULL,
  `rem` varchar(2000) NOT NULL,
  `dt` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `guestwalk`
--

INSERT INTO `guestwalk` (`id`, `guestname`, `timein`, `timeout`, `tomeet`, `rem`, `dt`) VALUES
(1, '0', '11:08:24', '11:09:04', '13', 'xsfsafdfdfdgf', '2019-09-22'),
(2, 'me', '11:08:56', '11:09:03', '13', 'xsfsafdfdfdgf', '2019-09-22'),
(3, 'me', '01:19:58', '01:20:02', '13', 'test', '2019-09-25');

-- --------------------------------------------------------

--
-- Table structure for table `leaveform`
--

CREATE TABLE `leaveform` (
  `id` int(11) NOT NULL,
  `name` varchar(350) NOT NULL,
  `designation` varchar(250) NOT NULL,
  `reason` varchar(250) NOT NULL,
  `fulltype` varchar(25) NOT NULL,
  `halftype` varchar(25) NOT NULL,
  `noleave` int(11) NOT NULL,
  `fromdt` date NOT NULL,
  `todt` date NOT NULL,
  `daytype` varchar(150) NOT NULL,
  `applydt` date NOT NULL,
  `rem` varchar(2000) NOT NULL,
  `approved` char(1) NOT NULL,
  `approvedby` varchar(250) NOT NULL,
  `approvedon` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `leaveform`
--

INSERT INTO `leaveform` (`id`, `name`, `designation`, `reason`, `fulltype`, `halftype`, `noleave`, `fromdt`, `todt`, `daytype`, `applydt`, `rem`, `approved`, `approvedby`, `approvedon`) VALUES
(2, '13', '1', 'personal', 'N', 'N', 2, '2019-09-22', '2019-09-25', '', '2019-09-22', 'Personal work', 'Y', 'admin', '2019-09-22');

-- --------------------------------------------------------

--
-- Table structure for table `menuoptions`
--

CREATE TABLE `menuoptions` (
  `id` int(11) NOT NULL,
  `menu` varchar(250) NOT NULL,
  `submenu` varchar(250) NOT NULL,
  `menuorder` int(11) NOT NULL,
  `linkpage` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `menuoptions`
--

INSERT INTO `menuoptions` (`id`, `menu`, `submenu`, `menuorder`, `linkpage`) VALUES
(24, 'Attendance Management', 'Attendance Management', 1, 'daily-attend'),
(25, 'Attendance Management', 'Upload Data', 2, 'daily-attend'),
(26, 'Attendance Management', 'View Data', 3, 'view-attend'),
(27, 'Attendance Management', 'Monthly Attendance', 4, 'monthly-attend'),
(28, 'Attendance Management', 'Monthly Leaves', 5, 'monthleave'),
(29, 'Payroll', 'Payroll', 1, 'salary'),
(30, 'Payroll', 'Salary', 2, 'salary'),
(31, 'Payroll', 'Allowances', 3, 'allowances'),
(32, 'Forms', 'Forms', 1, 'leave'),
(33, 'Forms', 'Leave Form', 2, 'leave'),
(34, 'Forms', 'Appointment Letter', 3, 'appointment'),
(35, 'Forms', 'Promotion Letter', 4, 'promotion'),
(36, 'Forms', 'Demotion Letter', 5, 'demotion'),
(37, 'Expense Management', 'Expense Management', 1, 'companybills'),
(38, 'Expense Management', 'Company Bills', 2, 'companybills'),
(39, 'Expense Management', 'Personal Bills', 3, 'personalbills'),
(40, 'Reports', 'Reports', 1, 'empreport'),
(41, 'Reports', 'Employee Detail', 2, 'empreport'),
(42, 'Reports', 'Company Bills', 3, 'compbillreport'),
(43, 'Reports', 'Personal Bills', 4, 'personalbillreport'),
(44, 'Reports', 'Leave Applications', 5, 'leaveapp'),
(45, 'Walkins', 'Walkins', 1, 'empwalk'),
(46, 'Walkins', 'Employee Walkin', 1, 'empwalk'),
(47, 'Walkins', 'Guest Walkin', 2, 'guestwalk'),
(48, 'Users', 'Users', 1, 'createuser'),
(49, 'Users', 'Create User', 1, 'createuser'),
(50, 'Users', 'User Rights', 2, 'userrights');

-- --------------------------------------------------------

--
-- Table structure for table `personalbills`
--

CREATE TABLE `personalbills` (
  `billdt` date NOT NULL,
  `relto` varchar(250) NOT NULL,
  `rem` varchar(2000) NOT NULL,
  `amt` double(12,2) NOT NULL,
  `postedon` date NOT NULL,
  `postedby` varchar(250) NOT NULL,
  `concper` varchar(250) NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `personalbills`
--

INSERT INTO `personalbills` (`billdt`, `relto`, `rem`, `amt`, `postedon`, `postedby`, `concper`, `id`) VALUES
('2019-09-20', 'Personal', 'dfefefe', 1000.00, '2019-09-22', 'admin', 'ABC', 1),
('2019-09-20', 'Personal', 'dfefefe', 1000.00, '2019-09-22', 'admin', 'ABC', 2);

-- --------------------------------------------------------

--
-- Table structure for table `state_master`
--

CREATE TABLE `state_master` (
  `id` int(11) NOT NULL,
  `state` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `state_master`
--

INSERT INTO `state_master` (`id`, `state`) VALUES
(1, 'Chandigarh');

-- --------------------------------------------------------

--
-- Table structure for table `timeinout`
--

CREATE TABLE `timeinout` (
  `id` int(11) NOT NULL,
  `empid` int(11) NOT NULL,
  `empnm` varchar(250) NOT NULL,
  `dt` date NOT NULL,
  `timeinstatus` varchar(150) NOT NULL,
  `timeoutstatus` varchar(150) NOT NULL,
  `timein` time NOT NULL,
  `timeout` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `timeinout`
--

INSERT INTO `timeinout` (`id`, `empid`, `empnm`, `dt`, `timeinstatus`, `timeoutstatus`, `timein`, `timeout`) VALUES
(1, 13, 'Harnish Kang', '2019-09-22', 'status', 'status', '00:00:00', '00:00:00'),
(2, 13, 'Harnish Kang', '2019-09-25', 'status', 'status', '00:00:00', '00:00:00'),
(3, 14, 'sam Kang', '2019-09-25', 'status', 'status', '00:00:00', '00:00:00'),
(4, 13, 'Harnish Kang', '2019-09-27', 'status', 'status', '00:00:00', '00:00:00'),
(5, 14, 'sam Kang', '2019-09-27', 'status', 'status', '00:00:00', '00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `upload_timesheet`
--

CREATE TABLE `upload_timesheet` (
  `id` int(30) NOT NULL,
  `name` varchar(50) NOT NULL,
  `date` date NOT NULL,
  `time_in` time NOT NULL,
  `time_out` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `userrights`
--

CREATE TABLE `userrights` (
  `id` int(11) NOT NULL,
  `usrid` int(11) NOT NULL,
  `uname` varchar(250) NOT NULL,
  `menu` varchar(250) NOT NULL,
  `submenu` varchar(250) NOT NULL,
  `menuorder` int(11) NOT NULL,
  `linkpage` varchar(250) NOT NULL,
  `rights` char(1) NOT NULL DEFAULT 'N'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `userrights`
--

INSERT INTO `userrights` (`id`, `usrid`, `uname`, `menu`, `submenu`, `menuorder`, `linkpage`, `rights`) VALUES
(75, 1, 'admin', 'Employee Detail', 'Employee Detail', 1, 'empdet', 'Y'),
(76, 1, 'admin', 'Employee Detail', 'Add New Employee', 2, 'empdet', 'Y'),
(77, 1, 'admin', 'Employee Detail', 'View Employee Data', 3, 'empdet', 'Y'),
(78, 1, 'admin', 'Attendance Management', 'Attendance Management', 1, 'daily-attend', 'Y'),
(79, 1, 'admin', 'Attendance Management', 'Upload Data', 2, 'daily-attend', 'Y'),
(80, 1, 'admin', 'Attendance Management', 'View Data', 3, 'view-attend', 'Y'),
(81, 1, 'admin', 'Attendance Management', 'Monthly Attendance', 4, 'monthly-attend', 'Y'),
(82, 1, 'admin', 'Attendance Management', 'Monthly Leaves', 5, 'monthleave', 'Y'),
(83, 1, 'admin', 'Payroll', 'Payroll', 1, 'salary', 'Y'),
(84, 1, 'admin', 'Payroll', 'Salary', 2, 'salary', 'Y'),
(85, 1, 'admin', 'Payroll', 'Allowances', 3, 'allowances', 'Y'),
(86, 1, 'admin', 'Forms', 'Forms', 1, 'leave', 'Y'),
(87, 1, 'admin', 'Forms', 'Leave Form', 2, 'leave', 'Y'),
(88, 1, 'admin', 'Forms', 'Appointment Letter', 3, 'appointment', 'Y'),
(89, 1, 'admin', 'Forms', 'Promotion Letter', 4, 'promotion', 'Y'),
(90, 1, 'admin', 'Forms', 'Demotion Letter', 5, 'demotion', 'Y'),
(91, 1, 'admin', 'Expense Management', 'Expense Management', 1, 'companybills', 'Y'),
(92, 1, 'admin', 'Expense Management', 'Company Bills', 2, 'companybills', 'Y'),
(93, 1, 'admin', 'Expense Management', 'Personal Bills', 3, 'personalbills', 'Y'),
(94, 1, 'admin', 'Reports', 'Reports', 1, 'empreport', 'Y'),
(95, 1, 'admin', 'Reports', 'Employee Detail', 2, 'empreport', 'Y'),
(96, 1, 'admin', 'Reports', 'Company Bills', 3, 'compbillreport', 'Y'),
(97, 1, 'admin', 'Reports', 'Personal Bills', 4, 'personalbillreport', 'Y'),
(98, 1, 'admin', 'Reports', 'Leave Applications', 5, 'leaveapp', 'Y'),
(99, 1, 'admin', 'Walkins', 'Walkins', 1, 'empwalk', 'Y'),
(100, 1, 'admin', 'Walkins', 'Employee Walkin', 2, 'empwalk', 'Y'),
(101, 1, 'admin', 'Walkins', 'Guest Walkin', 3, 'guestwalk', 'Y'),
(102, 1, 'admin', 'Users', 'Users', 1, 'createuser', 'Y'),
(103, 1, 'admin', 'Users', 'Create User', 2, 'createuser', 'Y'),
(104, 1, 'admin', 'Users', 'User Rights', 3, 'userrights', 'Y'),
(105, 14, 'sam', 'Attendance Management', 'Attendance Management', 1, 'daily-attend', 'Y'),
(106, 14, 'sam', 'Attendance Management', 'Upload Data', 2, 'daily-attend', 'N'),
(107, 14, 'sam', 'Attendance Management', 'View Data', 3, 'view-attend', 'Y'),
(108, 14, 'sam', 'Attendance Management', 'Monthly Attendance', 4, 'monthly-attend', 'N'),
(109, 14, 'sam', 'Attendance Management', 'Monthly Leaves', 5, 'monthleave', 'N'),
(110, 14, 'sam', 'Payroll', 'Payroll', 1, 'salary', 'N'),
(111, 14, 'sam', 'Payroll', 'Salary', 2, 'salary', 'N'),
(112, 14, 'sam', 'Payroll', 'Allowances', 3, 'allowances', 'N'),
(113, 14, 'sam', 'Forms', 'Forms', 1, 'leave', 'N'),
(114, 14, 'sam', 'Forms', 'Leave Form', 2, 'leave', 'N'),
(115, 14, 'sam', 'Forms', 'Appointment Letter', 3, 'appointment', 'N'),
(116, 14, 'sam', 'Forms', 'Promotion Letter', 4, 'promotion', 'N'),
(117, 14, 'sam', 'Forms', 'Demotion Letter', 5, 'demotion', 'N'),
(118, 14, 'sam', 'Expense Management', 'Expense Management', 1, 'companybills', 'N'),
(119, 14, 'sam', 'Expense Management', 'Company Bills', 2, 'companybills', 'N'),
(120, 14, 'sam', 'Expense Management', 'Personal Bills', 3, 'personalbills', 'N'),
(121, 14, 'sam', 'Reports', 'Reports', 1, 'empreport', 'N'),
(122, 14, 'sam', 'Reports', 'Employee Detail', 2, 'empreport', 'N'),
(123, 14, 'sam', 'Reports', 'Company Bills', 3, 'compbillreport', 'N'),
(124, 14, 'sam', 'Reports', 'Personal Bills', 4, 'personalbillreport', 'N'),
(125, 14, 'sam', 'Reports', 'Leave Applications', 5, 'leaveapp', 'N'),
(126, 14, 'sam', 'Walkins', 'Walkins', 1, 'empwalk', 'N'),
(127, 14, 'sam', 'Walkins', 'Employee Walkin', 1, 'empwalk', 'N'),
(128, 14, 'sam', 'Walkins', 'Guest Walkin', 2, 'guestwalk', 'N'),
(129, 14, 'sam', 'Users', 'Users', 1, 'createuser', 'N'),
(130, 14, 'sam', 'Users', 'Create User', 1, 'createuser', 'N'),
(131, 14, 'sam', 'Users', 'User Rights', 2, 'userrights', 'N');

-- --------------------------------------------------------

--
-- Table structure for table `usrdetail`
--

CREATE TABLE `usrdetail` (
  `fname` varchar(30) NOT NULL,
  `lname` varchar(30) NOT NULL,
  `uname` varchar(30) NOT NULL,
  `pswd` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `cont` varchar(150) NOT NULL,
  `status` varchar(100) NOT NULL,
  `createdon` date NOT NULL,
  `id` int(11) NOT NULL,
  `empid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `usrdetail`
--

INSERT INTO `usrdetail` (`fname`, `lname`, `uname`, `pswd`, `email`, `cont`, `status`, `createdon`, `id`, `empid`) VALUES
('admin', 'admin', 'admin', 'pass123', 'admin@gmail.com', '', '', '0000-00-00', 1, 13),
('sam', 'Kang', 'sam', 'sam@1234', 'sam@gmail.com', '9876554678', 'active', '2019-09-23', 14, 14);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `allowances`
--
ALTER TABLE `allowances`
  ADD PRIMARY KEY (`t_id`);

--
-- Indexes for table `allowchild`
--
ALTER TABLE `allowchild`
  ADD PRIMARY KEY (`id`),
  ADD KEY `parentid` (`parentid`);

--
-- Indexes for table `allowparent`
--
ALTER TABLE `allowparent`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `appointletter`
--
ALTER TABLE `appointletter`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `city_master`
--
ALTER TABLE `city_master`
  ADD PRIMARY KEY (`id`),
  ADD KEY `stid` (`stid`);

--
-- Indexes for table `companybills`
--
ALTER TABLE `companybills`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `daily_attend`
--
ALTER TABLE `daily_attend`
  ADD PRIMARY KEY (`id`,`name`,`dt`),
  ADD KEY `empid` (`empid`);

--
-- Indexes for table `deptt`
--
ALTER TABLE `deptt`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `desig_master`
--
ALTER TABLE `desig_master`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `empidproof`
--
ALTER TABLE `empidproof`
  ADD PRIMARY KEY (`id`),
  ADD KEY `empimgid` (`empimgid`);

--
-- Indexes for table `empimg`
--
ALTER TABLE `empimg`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`id`),
  ADD KEY `empid` (`empid`),
  ADD KEY `depttid` (`depttid`),
  ADD KEY `state` (`state`),
  ADD KEY `city` (`city`),
  ADD KEY `designation` (`designation`);

--
-- Indexes for table `guestwalk`
--
ALTER TABLE `guestwalk`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `leaveform`
--
ALTER TABLE `leaveform`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menuoptions`
--
ALTER TABLE `menuoptions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `personalbills`
--
ALTER TABLE `personalbills`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `state_master`
--
ALTER TABLE `state_master`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `timeinout`
--
ALTER TABLE `timeinout`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `userrights`
--
ALTER TABLE `userrights`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `usrdetail`
--
ALTER TABLE `usrdetail`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `allowances`
--
ALTER TABLE `allowances`
  MODIFY `t_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `allowchild`
--
ALTER TABLE `allowchild`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `allowparent`
--
ALTER TABLE `allowparent`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `appointletter`
--
ALTER TABLE `appointletter`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `city_master`
--
ALTER TABLE `city_master`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `companybills`
--
ALTER TABLE `companybills`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `daily_attend`
--
ALTER TABLE `daily_attend`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=90;

--
-- AUTO_INCREMENT for table `deptt`
--
ALTER TABLE `deptt`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `desig_master`
--
ALTER TABLE `desig_master`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `empidproof`
--
ALTER TABLE `empidproof`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `empimg`
--
ALTER TABLE `empimg`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `guestwalk`
--
ALTER TABLE `guestwalk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `leaveform`
--
ALTER TABLE `leaveform`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `menuoptions`
--
ALTER TABLE `menuoptions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `personalbills`
--
ALTER TABLE `personalbills`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `state_master`
--
ALTER TABLE `state_master`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `timeinout`
--
ALTER TABLE `timeinout`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `userrights`
--
ALTER TABLE `userrights`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=132;

--
-- AUTO_INCREMENT for table `usrdetail`
--
ALTER TABLE `usrdetail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `allowchild`
--
ALTER TABLE `allowchild`
  ADD CONSTRAINT `allowchild_ibfk_1` FOREIGN KEY (`parentid`) REFERENCES `allowparent` (`id`);

--
-- Constraints for table `city_master`
--
ALTER TABLE `city_master`
  ADD CONSTRAINT `city_master_ibfk_1` FOREIGN KEY (`stid`) REFERENCES `state_master` (`id`);

--
-- Constraints for table `daily_attend`
--
ALTER TABLE `daily_attend`
  ADD CONSTRAINT `daily_attend_ibfk_1` FOREIGN KEY (`empid`) REFERENCES `employee` (`id`);

--
-- Constraints for table `empidproof`
--
ALTER TABLE `empidproof`
  ADD CONSTRAINT `empidproof_ibfk_1` FOREIGN KEY (`empimgid`) REFERENCES `empimg` (`id`);

--
-- Constraints for table `employee`
--
ALTER TABLE `employee`
  ADD CONSTRAINT `employee_ibfk_1` FOREIGN KEY (`empid`) REFERENCES `empimg` (`id`),
  ADD CONSTRAINT `employee_ibfk_2` FOREIGN KEY (`depttid`) REFERENCES `deptt` (`id`),
  ADD CONSTRAINT `employee_ibfk_3` FOREIGN KEY (`state`) REFERENCES `state_master` (`id`),
  ADD CONSTRAINT `employee_ibfk_4` FOREIGN KEY (`city`) REFERENCES `city_master` (`id`),
  ADD CONSTRAINT `employee_ibfk_5` FOREIGN KEY (`designation`) REFERENCES `desig_master` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
