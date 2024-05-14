-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 09, 2023 at 12:05 AM
-- Server version: 5.7.44
-- PHP Version: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `paripand_final_project`
--

-- --------------------------------------------------------

--
-- Table structure for table `all_tickers`
--

CREATE TABLE `all_tickers` (
  `Ticker_ID` tinyint(3) UNSIGNED NOT NULL,
  `TickerName` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `company_details`
--

CREATE TABLE `company_details` (
  `Ticker_ID` tinyint(1) UNSIGNED NOT NULL,
  `Company_Name` varchar(1000) NOT NULL,
  `Primary_Exchange` varchar(1000) NOT NULL,
  `Currency_Name` varchar(1000) NOT NULL,
  `Market_Cap` double NOT NULL,
  `Logo` varchar(1000) NOT NULL,
  `Location` varchar(1000) NOT NULL,
  `Description` longtext NOT NULL,
  `Homepage` varchar(1000) NOT NULL,
  `List_Date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `company_news`
--

CREATE TABLE `company_news` (
  `Ticker_ID` tinyint(1) UNSIGNED NOT NULL,
  `Date_Published` date NOT NULL,
  `Publisher` varchar(100) NOT NULL,
  `Title` varchar(1000) NOT NULL,
  `URL` varchar(1000) NOT NULL,
  `Description` longtext NOT NULL,
  `Author` varchar(50) NOT NULL,
  `Article_Image` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `widget_data`
--

CREATE TABLE `widget_data` (
  `Username` varchar(10) NOT NULL,
  `Widget_ID` tinyint(1) UNSIGNED NOT NULL,
  `Color` varchar(7) NOT NULL,
  `Ticker_ID` tinyint(3) UNSIGNED NOT NULL,
  `Date` date NOT NULL,
  `Open_Price` double NOT NULL,
  `Close_Price` double NOT NULL,
  `High_Price` double NOT NULL,
  `Low_Price` double NOT NULL,
  `Transactions` bigint(10) UNSIGNED NOT NULL,
  `Trading_Volume` bigint(10) UNSIGNED NOT NULL,
  `VWAP` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `all_tickers`
--
ALTER TABLE `all_tickers`
  ADD PRIMARY KEY (`Ticker_ID`);

--
-- Indexes for table `company_details`
--
ALTER TABLE `company_details`
  ADD KEY `fk_ID` (`Ticker_ID`);

--
-- Indexes for table `company_news`
--
ALTER TABLE `company_news`
  ADD KEY `news_tickerID` (`Ticker_ID`);

--
-- Indexes for table `widget_data`
--
ALTER TABLE `widget_data`
  ADD PRIMARY KEY (`Widget_ID`) USING BTREE,
  ADD KEY `hp_tickerID` (`Ticker_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `all_tickers`
--
ALTER TABLE `all_tickers`
  MODIFY `Ticker_ID` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `widget_data`
--
ALTER TABLE `widget_data`
  MODIFY `Widget_ID` tinyint(1) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `company_details`
--
ALTER TABLE `company_details`
  ADD CONSTRAINT `fk_ID` FOREIGN KEY (`Ticker_ID`) REFERENCES `all_tickers` (`Ticker_ID`);

--
-- Constraints for table `company_news`
--
ALTER TABLE `company_news`
  ADD CONSTRAINT `news_tickerID` FOREIGN KEY (`Ticker_ID`) REFERENCES `all_tickers` (`Ticker_ID`);

--
-- Constraints for table `widget_data`
--
ALTER TABLE `widget_data`
  ADD CONSTRAINT `hp_tickerID` FOREIGN KEY (`Ticker_ID`) REFERENCES `all_tickers` (`Ticker_ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
