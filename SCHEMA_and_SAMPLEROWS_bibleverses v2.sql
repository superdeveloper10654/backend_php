-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: May 08, 2023 at 11:39 AM
-- Server version: 5.7.36
-- PHP Version: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `acts238qb`
--

-- --------------------------------------------------------

--
-- Table structure for table `bibleverses`
--

DROP TABLE IF EXISTS `bibleverses`;
CREATE TABLE IF NOT EXISTS `bibleverses` (
  `verseid` int(11) NOT NULL AUTO_INCREMENT,
  `refcode` varchar(9) NOT NULL DEFAULT '',
  `refpretty` varchar(40) NOT NULL DEFAULT '',
  `transcode` varchar(10) NOT NULL DEFAULT '',
  `versetext` text NOT NULL,
  `istest` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`verseid`)
) ENGINE=MyISAM AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bibleverses`
--

INSERT INTO `bibleverses` (`verseid`, `refcode`, `refpretty`, `transcode`, `versetext`, `istest`) VALUES
(1, '044002001', 'Acts 2:1 KJV', 'KJV', 'And when the day of Pentecost was fully come, they were all with one accord in one place.', 0),
(2, '044002004', 'Acts 2:4 KJV', 'KJV', 'And they were all filled with the Holy Ghost, and began to speak with other tongues, as the Spirit gave them utterance.', 0),
(3, '044002017', 'Acts 2:17 KJV', 'KJV', 'And it shall come to pass in the last days, saith God, I will pour out of my Spirit upon all flesh: and your sons and your daughters shall prophesy, and your young men shall see visions, and your old men shall dream dreams.', 0),
(4, '044002038', 'Acts 2:38 KJV', 'KJV', 'Then Peter said unto them, \"Repent, and be baptized every one of you in the name of Jesus Christ for the remission of sins, and ye shall receive the gift of the Holy Ghost.\"', 0),
(5, '044002039', 'Acts 2:39 KJV', 'KJV', 'For the promise is unto you, and to your children, and to all that are afar off, even as many as the LORD our God shall call.', 0),
(6, '044002040', 'Acts 2:40 KJV', 'KJV', 'And with many other words did he testify and exhort, saying, Save yourselves from this untoward generation.', 0),
(7, '044004013', 'Acts 4:13 KJV', 'KJV', 'Now when they saw the boldness of Peter and John, and perceived that they were unlearned and ignorant men, they marvelled; and they took knowledge of them, that they had been with Jesus.', 0),
(8, '044001008', 'Acts 1:8 KJV', 'KJV', 'But ye shall receive power, after that the Holy Ghost is come upon you: and ye shall be witnesses unto me both in Jerusalem, and in all Judaea, and in Samaria, and unto the uttermost part of the earth.', 0),
(9, '044010034', 'Acts 10:34 KJV', 'KJV', 'Then Peter opened his mouth, and said, \"Of a truth I perceive that God is no respecter of persons.\"', 0),
(10, '044010044', 'Acts 10:44 KJV', 'KJV', 'While Peter yet spake these words, the Holy Ghost fell on all them which heard the word.', 0),
(11, '044010045', 'Acts 10:45 KJV', 'KJV', 'And they of the circumcision which believed were astonished, as many as came with Peter, because that on the Gentiles also was poured out the gift of the Holy Ghost.', 0),
(12, '044010048', 'Acts 10:48 KJV', 'KJV', 'And he commanded them to be baptized in the name of the Lord. Then prayed they him to tarry certain days.\r\n', 0),
(13, '044019002', 'Acts 19:2 KJV', 'KJV', 'He said unto them, Have ye received the Holy Ghost since ye believed? And they said unto him, We have not so much as heard whether there be any Holy Ghost.', 0),
(14, '044020028', 'Acts 20:28 KJV', 'KJV', 'Take heed therefore unto yourselves, and to all the flock, over the which the Holy Ghost hath made you overseers, to feed the church of God, which he hath purchased with his own blood.', 0),
(15, '044019005', 'Acts 19:5 KJV', 'KJV', 'When they heard this, they were baptized in the name of the Lord Jesus.', 0),
(16, '044019006', 'Acts 19:6 KJV', 'KJV', 'And when Paul had laid his hands upon them, the Holy Ghost came on them; and they spake with tongues, and prophesied.', 0),
(17, 'TEST01', 'TEST01', 'TEST', 'Mike has a pretty but mean cat!', 1),
(18, 'TEST02', 'TEST02', 'TEST', 'We went to the movies on Friday.', 1),
(19, 'TEST03', 'TEST03', 'TEST', 'We want Mike to get a dog.', 1),
(20, 'TEST04', 'TEST04', 'TEST', 'Did you see the show about the dog?', 1),
(21, 'TEST05', 'TEST05', 'TEST', 'Did you see the show about hunting deer?', 1);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
