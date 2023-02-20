-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 08, 2023 at 10:31 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bd`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `Cerinta3a` ()   BEGIN
SELECT * 
FROM furnizori
WHERE upper(ORAS) LIKE '%J%'
ORDER BY NUMEF;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `Cerinta3b` ()   BEGIN
SELECT* 
FROM componente
WHERE UPPER(culoare) IN ('ALB', 'NEGRU', 'GALBEN')
ORDER BY masa DESC;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `Cerinta4a` ()   BEGIN
SELECT f.numef as "Nume Furnizori", p.numep as "Nume Proiecte", c.numec as "Nume Componente", f.oras as "Oras"
FROM livrari l
JOIN furnizori f ON(f.idf = l.idf)
JOIN proiecte p ON(p.idp = l.idp)
JOIN componente c ON(c.idc = l.idc)
WHERE c.oras = f.oras AND f.oras = p.oras ;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `Cerinta4b` ()   BEGIN
SELECT  DISTINCT CONCAT(l1.idp ,' -- ', l2.idp)   as "Perechi"
FROM livrari l1 JOIN livrari l2 ON (l1.idc = l2.idc)
WHERE l1.idf != l2.idf AND l1.cantitate = l2.cantitate AND l1.um = l2.um AND l1.idp < l2.idp;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `Cerinta5a` ()   BEGIN
SELECT c1.NUMEC AS "NUMEC", l1.CANTITATE as "CANTITATE"
FROM livrari l1 JOIN componente c1  ON (l1.idc = c1.idc)
WHERE NOT EXISTS ( SELECT * 
                      FROM livrari l2
                      WHERE l1.cantitate < l2.cantitate);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `Cerinta5b` (IN `comCol` VARCHAR(20))   BEGIN
SELECT DISTINCT l.IDC AS "IDC" , p.NUMEP AS "NUMEP"
FROM proiecte p JOIN livrari l 
                ON(l.idp = p.idp)
WHERE l.idc IN ( SELECT idc 
                 FROM componente
                 WHERE UPPER(CULOARE) = comCol);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `Cerinta6a` ()   BEGIN
SELECT IDP as ID_PROJ, idc as ID_COMP, um AS UM, SUM(CANTITATE) as SUMA_CANT
FROM livrari JOIN proiecte USING(IDP)
GROUP BY IDP,IDC,um
order by IDP,IDC;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `Cerinta6b` ()   BEGIN
SELECT  um as "UM" , MIN(cantitate) as "CANT_MIN", ROUND(AVG(CANTITATE),2) as "CANT_MED" , MAX(cantitate) as "CANT_MAX"
FROM livrari
WHERE idc='C1'
GROUP BY um;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `exemplu` (IN `comCol` VARCHAR(20))   BEGIN
SELECT DISTINCT l.IDC AS "IDC" , p.NUMEP AS "NUMEP"
FROM proiecte p JOIN livrari l 
                ON(l.idp = p.idp)
WHERE l.idc IN ( SELECT idc 
                 FROM componente
                 WHERE UPPER(CULOARE) = comCol);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `exemplu2` (IN `id_c` VARCHAR(20))   BEGIN
SELECT  um as "UM" , MIN(cantitate) as "CANT_MIN", ROUND(AVG(CANTITATE),2) as "CANT_MED" , MAX(cantitate) as "CANT_MAX"
FROM livrari
WHERE idc=id_c
GROUP BY um;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `exemplu3` (IN `litera` VARCHAR(1))   BEGIN
SELECT * 
FROM furnizori
WHERE LOCATE(ORAS,litera)!=0
ORDER BY NUMEF;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `componente`
--

CREATE TABLE `componente` (
  `IDC` varchar(20) NOT NULL CHECK (substr(`IDC`,1,1) = 'C'),
  `NUMEC` varchar(100) DEFAULT NULL,
  `CULOARE` varchar(20) DEFAULT NULL CHECK (`CULOARE` in ('alb','rosu','galben','verde','albastru','negru') and (`CULOARE` <> 'albastru' or substr(`ORAS`,1,1) = 'C')),
  `MASA` int(10) DEFAULT NULL,
  `ORAS` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `componente`
--

INSERT INTO `componente` (`IDC`, `NUMEC`, `CULOARE`, `MASA`, `ORAS`) VALUES
('C1', 'Instalatie Electrica', 'rosu', 10001, 'Targu-Jiu'),
('C2', 'Bijuterie', 'albastru', 300, 'Constanta'),
('C213', 'Crema Ciocolata	', 'albastru', 450, 'Craiova'),
('C3', 'Glob Portelan	', 'rosu', 20, 'Sibiu'),
('C4', 'Zapada Artificiala	', 'alb', 1000, 'Sibiu'),
('C5', 'Fulgi de Nea Artificiali	', 'alb', 1000, 'Sibiu'),
('C6', 'Lamai', 'galben', 6000, 'Targu-Jiu'),
('C7', 'Pahar Sticla	', 'galben', 60, 'Targu-Jiu'),
('C8', 'Pamant pentru flori	', 'negru', 1000, 'Bucuresti'),
('C90', 'Figurina Mos Craciun', 'verde', 100, 'Cluj-Napoca'),
('C91', 'Caiet Matematica	', 'verde', 30, 'Targoviste');

-- --------------------------------------------------------

--
-- Table structure for table `furnizori`
--

CREATE TABLE `furnizori` (
  `IDF` varchar(20) NOT NULL CHECK (substr(`IDF`,1,1) = 'F'),
  `NUMEF` varchar(100) DEFAULT NULL,
  `STARE` int(3) DEFAULT NULL,
  `ORAS` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `furnizori`
--

INSERT INTO `furnizori` (`IDF`, `NUMEF`, `STARE`, `ORAS`) VALUES
('F0', 'Enigma SRL', 12, 'Targu-Jiu'),
('F1', 'Home-Deco Cluj-Napoca SRL', 2, 'Cluj-Napoca'),
('F122', 'Dedeman US', 1, 'Jersey City'),
('F123', 'Prim', 1, 'Sibiu'),
('F2', 'Dedeman US', 34, 'Johnsontown'),
('F3', 'Lidl Romania SRL', 2, 'Cluj-Napoca'),
('F4', 'Carrefour RO SRL', 43, 'Cluj-Napoca'),
('F56', 'Succes SRL', 2, 'Targu-Jiu'),
('F7', 'Sushi Rolls - Asian Food', 21, 'Tokyo'),
('F91', 'Pigna SRL', 12, 'Bucuresti');

-- --------------------------------------------------------

--
-- Table structure for table `livrari`
--

CREATE TABLE `livrari` (
  `IDF` varchar(20) NOT NULL,
  `IDC` varchar(20) NOT NULL,
  `IDP` varchar(20) NOT NULL,
  `CANTITATE` int(10) DEFAULT NULL,
  `um` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `livrari`
--

INSERT INTO `livrari` (`IDF`, `IDC`, `IDP`, `CANTITATE`, `um`) VALUES
('F1', 'C1', 'P1', 10, 'M2'),
('F1', 'C4', 'P3', 20, 'M2'),
('F1', 'C6', 'P1', 100, 'KG'),
('F1', 'C90', 'P3', 200, 'KG'),
('F123', 'C213', 'P312', 5, 'BUC'),
('F2', 'C1', 'P1', 130, 'M2'),
('F3', 'C4', 'P2', 20, 'M2'),
('F3', 'C5', 'P2', 10, 'KG'),
('F3', 'C6', 'P1', 100, 'KG'),
('F4', 'C1', 'P1', 1220, 'KG'),
('F4', 'C90', 'P2', 200, 'KG'),
('F56', 'C1', 'P2', 20, 'M2'),
('F56', 'C6', 'P1', 100, 'KG'),
('F7', 'C1', 'P3', 10, 'KG'),
('F7', 'C1', 'P312', 220, 'KG'),
('F91', 'C91', 'P91', 200, 'FILE');

-- --------------------------------------------------------

--
-- Table structure for table `proiecte`
--

CREATE TABLE `proiecte` (
  `IDP` varchar(20) NOT NULL CHECK (substr(`IDP`,1,1) = 'P'),
  `NUMEP` varchar(100) DEFAULT NULL,
  `ORAS` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `proiecte`
--

INSERT INTO `proiecte` (`IDP`, `NUMEP`, `ORAS`) VALUES
('P0', 'Renovare Casa', 'Targu-Jiu'),
('P1', 'Stand de Limonada	', 'Sibiu'),
('P110', 'DIY ornamente Craciun	', 'Targu-Jiu'),
('P2', 'Aranjament de Craciun	', 'Targu-Jiu'),
('P3', 'Home Decor pentru Craciun	', 'Cluj-Napoca'),
('P312', 'Tort Ciocolata	', 'Craiova'),
('P91', 'Tema Matematica', 'Pitesti');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `componente`
--
ALTER TABLE `componente`
  ADD PRIMARY KEY (`IDC`);

--
-- Indexes for table `furnizori`
--
ALTER TABLE `furnizori`
  ADD PRIMARY KEY (`IDF`);

--
-- Indexes for table `livrari`
--
ALTER TABLE `livrari`
  ADD PRIMARY KEY (`IDF`,`IDC`,`IDP`),
  ADD KEY `IDC` (`IDC`),
  ADD KEY `IDP` (`IDP`);

--
-- Indexes for table `proiecte`
--
ALTER TABLE `proiecte`
  ADD PRIMARY KEY (`IDP`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `livrari`
--
ALTER TABLE `livrari`
  ADD CONSTRAINT `livrari_ibfk_1` FOREIGN KEY (`IDF`) REFERENCES `furnizori` (`IDF`),
  ADD CONSTRAINT `livrari_ibfk_2` FOREIGN KEY (`IDC`) REFERENCES `componente` (`IDC`),
  ADD CONSTRAINT `livrari_ibfk_3` FOREIGN KEY (`IDP`) REFERENCES `proiecte` (`IDP`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
