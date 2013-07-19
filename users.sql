-- phpMyAdmin SQL Dump
-- version 2.11.3deb1ubuntu1.3
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 12, 2013 at 09:19 AM
-- Server version: 5.0.96
-- PHP Version: 5.2.4-2ubuntu5.27

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Database: `facebook-discount`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(6) NOT NULL auto_increment,
  `couponCode` varchar(64) collate utf8_bin NOT NULL,
  `appwallpost` tinyint(1) NOT NULL default '0',
  `fbid` varchar(64) collate utf8_bin NOT NULL,
  `name` varchar(64) collate utf8_bin NOT NULL,
  `first_name` varchar(64) collate utf8_bin NOT NULL,
  `last_name` varchar(64) collate utf8_bin NOT NULL,
  `email` varchar(128) collate utf8_bin NOT NULL,
  `link` varchar(128) collate utf8_bin NOT NULL,
  `image` varchar(128) collate utf8_bin NOT NULL,
  `gender` varchar(32) collate utf8_bin NOT NULL,
  `locale` varchar(12) collate utf8_bin NOT NULL,
  `timeStamp` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `fbid` (`fbid`),
  UNIQUE KEY `couponCode` (`couponCode`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=21 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `couponCode`, `appwallpost`, `fbid`, `name`, `first_name`, `last_name`, `email`, `link`, `image`, `gender`, `locale`, `timeStamp`) VALUES
(20, 'FB10K-LXMNQ3NB', 0, '100002348822747', 'Gaiter Jones', 'Gaiter', 'Jones', 'paj@gaiterjones.com', 'http://www.facebook.com/gaiter.jones', 'Array', 'male', 'en_GB', '2013-06-11 18:37:28');
