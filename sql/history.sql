-- phpMyAdmin SQL Dump
-- version 4.2.12deb2+deb8u2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 01, 2017 at 06:39 AM
-- Server version: 10.0.28-MariaDB-0+deb8u1
-- PHP Version: 5.6.29-0+deb8u1

SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `beta`
--

-- --------------------------------------------------------

--
-- Table structure for table `history`
--

CREATE TABLE IF NOT EXISTS `history` (
`history_id` int(20) unsigned NOT NULL,
  `auth_id` int(20) unsigned NOT NULL,
  `history_request_time` int(11) unsigned NOT NULL,
  `history_request` varchar(255) NOT NULL,
  `history_request_type` varchar(20) NOT NULL,
  `history_request_params` text NOT NULL,
  `history_remote_address` varchar(60) NOT NULL,
  `history_remote_browser` varchar(100) NOT NULL
) ENGINE=InnoDB;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `history`
--
ALTER TABLE `history`
 ADD PRIMARY KEY (`history_id`), ADD KEY `auth_id` (`auth_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `history`
--
ALTER TABLE `history`
MODIFY `history_id` int(20) unsigned NOT NULL AUTO_INCREMENT;SET FOREIGN_KEY_CHECKS=1;

