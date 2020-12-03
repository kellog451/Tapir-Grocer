
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tapir_grocer`
--
CREATE DATABASE IF NOT EXISTS `tapir_grocer` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `tapir_grocer`;

-- --------------------------------------------------------

--
-- Table structure for table `check_in_log`
--

CREATE TABLE `check_in_log` (
  `No` int(11) NOT NULL,
  `Names` varchar(200) NOT NULL,
  `IC_Number` varchar(50) NOT NULL,
  `Temperature` float NOT NULL,
  `Date_and_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `check_in_log`
--

INSERT INTO `check_in_log` (`No`, `Names`, `IC_Number`, `Temperature`, `Date_and_time`) VALUES
(1, 'Shrijayi Mandal', 'B1237890', 36.5, '2020-12-03 15:06:16'),
(7, 'Imakit Michael', 'Q9999999', 38.2, '2020-12-03 15:27:10'),
(8, 'John Carter', 'F4567385', 36.8, '2020-12-03 15:28:21'),
(9, 'Billy Stern', 'Q8888888', 36.9, '2020-12-03 15:37:09');

-- --------------------------------------------------------

--
-- Table structure for table `location_owners`
--

CREATE TABLE `location_owners` (
  `user_name` varchar(500) NOT NULL,
  `ic` varchar(50) NOT NULL,
  `user_password` varchar(10000) NOT NULL,
  `store_name` varchar(500) NOT NULL,
  `store_location` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `location_owners`
--

INSERT INTO `location_owners` (`user_name`, `ic`, `user_password`, `store_name`, `store_location`) VALUES
('Shrijayi Mandal', 'B1237890', '$2y$10$aLlpCPvjEAkDoLOTCqHpV.nblhnJRz6LUSZjzkbOzGT631CSYmFY.', 'Tapir Grocer KL', 'KL'),
('Billy Stern', 'Q8888888', '$2y$10$mINdg6ydKV2In49Mnd2c2uIit04LbHwYD8haL5X8xq.AYlMEcWb1S', 'Tapir Grocer Selangor', 'Selangor'),
('Michael Faraday', 'Q9999999', '$2y$10$axpRTfqEhzg4SFTBICgkDObPiuP1/2cD0AlG/L9VT5dvLirylDYgC', 'Tapir Grocer MidValley', 'KL');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `check_in_log`
--
ALTER TABLE `check_in_log`
  ADD PRIMARY KEY (`No`);

--
-- Indexes for table `location_owners`
--
ALTER TABLE `location_owners`
  ADD PRIMARY KEY (`ic`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `check_in_log`
--
ALTER TABLE `check_in_log`
  MODIFY `No` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
