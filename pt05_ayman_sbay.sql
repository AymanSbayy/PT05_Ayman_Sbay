-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 21-10-2023 a las 18:16:53
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `pt04_ayman_sbay`
--
CREATE DATABASE IF NOT EXISTS `pt04_ayman_sbay` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `pt04_ayman_sbay`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `articles`
--

DROP TABLE IF EXISTS `articles`;
CREATE TABLE IF NOT EXISTS `articles` (
  `ID` int(2) NOT NULL,
  `art` text NOT NULL,
  `Títol` text NOT NULL,
  `user_dni` varchar(9) DEFAULT NULL,
  PRIMARY KEY (`ID`),
  KEY `user_dni` (`user_dni`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `articles`
--

INSERT INTO `articles` (`ID`, `art`, `Títol`, `user_dni`) VALUES
(1, 'Descobreix com el ioga pot millorar la teva salut', 'Els Beneficis del Ioga', '39986307W'),
(2, 'dkjjglkdjgkldsglksnfksklfsa', 'Hola', '39986307W'),
(3, 'Pepe se esta cambiando', 'Pepe', '39986307W'),
(4, 'hfgjfgjfgjgfjfgjf', 'gfjfghjfgj', '39986307W'),
(6, ',fnajsfnasdnfsdfsadfasdfasfd', 'Els Beneficis del Ioga', '39986307W'),
(7, 'Descobreix les joies culturals i culinàries d\'aquesta ciutat espanyola.', 'Guia de Barcelona: Cultura i Gastronomia', NULL),
(8, 'Consells pràctics per a una gestió financera efectiva.', 'Com Estalviar Dinero de Manera Inteligente', NULL),
(9, 'Introducció a les tècniques i trucs de la fotografia.', 'El Món de la Fotografia', NULL),
(10, 'Un viatge a través del temps per conèixer aquests increïbles animals prehistòrics.', 'La Història dels Dinosaures', NULL),
(11, 'Explora la bellesa de les muntanyes suïsses i les seves activitats.', 'Destins de Muntanya: Els Alps Suïssos', NULL),
(12, 'Cures de la pell i secrets per a una tez saludable.', 'Consells per a una Pell Radiant', NULL),
(13, 'Co fer de l\'exercici una part integral de la teva rutina diària.', 'Els Efectes de l\'Exercici en la Salu', NULL),
(14, 'Com la IA està canviant la nostra societat.', 'La Revolució Tecnològica: L\'Impacte de la Intel·ligència Artificial', NULL),
(15, 'Com explorar el món sense trencar la butxaca.', 'Viatjar Amb Pressupost: Consells i Trucs', NULL),
(16, 'tègies per comunicar-te eficaçment.', 'Com Millorar les Teves Habilitats de Comunicació', NULL),
(17, 'Delicioses receptes i beneficis per a la salut de la dieta mediterrània.', 'L\'Art de la Cuina Mediterrània', NULL),
(18, 'Una mirada a la natura majestuosa d\'aquesta regió sud-americana.', 'La Màgia de la Patagònia Argentina', NULL),
(19, 'Com ser més eficient en la teva vida quotidiana.', 'Estratègies per la Productivitat Personal', NULL),
(20, 'Descobreix el procés de creació cinematogràfica.', 'L\'Univers del Cinema: Com Fer una Pel·lícula', NULL),
(21, 'Consells i trucs per crear i mantenir un jardí exuberant.', 'L\'Art de la Jardineria', NULL),
(22, 'Un recorregut per aquesta espectacular regió italiana a la vora del mar.\r\n', 'La Bellesa de la Costa Amalfitana', NULL),
(23, 'Reflexions sobre la presa de decisions morals i ètiques.\r\n', 'Com Prendre Decisions Ètiques', NULL),
(24, 'Les últimes notícies sobre la missió a Mart', 'La Ciència de l\'Espai: L\'Exploració de Mart', NULL),
(25, 'Probando si esto funcionaaaaa jejeje', 'Article De Prova', '39986307W'),
(26, 'probandoprobandoprobandoprobandoprobandoprobandoprobandoprobandoprobandoprobandoprobandoprobandoprobando', 'Article De Proba3', '39986307W'),
(27, 'rwfasdffsfsad', 'wrqwrqwer', '39986307W'),
(28, 'dfsdfsfsf', 'Article De Prova', '40960076C'),
(29, 'adasdadasd', 'adasdsa', '22222222A'),
(30, 'PEPEPEPEPEPEPPEPEPEPEPEPEPEPE', 'PEPEPEPEP', '44444444E');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuaris`
--

DROP TABLE IF EXISTS `usuaris`;
CREATE TABLE IF NOT EXISTS `usuaris` (
  `DNI` varchar(9) NOT NULL,
  `Nom` varchar(25) NOT NULL,
  `Correu` varchar(100) NOT NULL,
  `Contraseña` varchar(255) NOT NULL,
  PRIMARY KEY (`DNI`),
  UNIQUE KEY `Correu` (`Correu`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuaris`
--

INSERT INTO `usuaris` (`DNI`, `Nom`, `Correu`, `Contraseña`) VALUES
('22222222A', 'lelele', 'lelele@gmail.com', '$2y$10$esdWJYSO/IsW5WDxYiXchedEUfNmF6ZWpME9vBWQ/1jYlnxmGqLlK'),
('39986307W', 'Ayman', 'ayman.zekkari2@gmail.com', '$2y$10$XmcXHtzESfxn.IMlCsucR.54x9nVi9/Bd.4VtQOxGOZ0nSWaVceGC'),
('40960076C', 'Abdel', 'a.sbay@institutsapalomera.cat', '$2y$10$P5Sqz8O.SMIUjjTQ8p74quOkLO/EnLVgSEQNdUPSaPrJ3bLioLwpu'),
('44444444E', 'Pepe', 'pepee@gmail.com', '$2y$10$7rfKwxgTB13ebaV9UlRqOOlrpFUNM5y8lGqq6TED1zJGdWKA291SS'),
('54810851B', 'Proba', 'proba@gmail.com', '$2y$10$kS16qoAHfezOrGxow5Y1uuM/XrG4bbTKSf3uTWlVtXbXX84TCTKam'),
('62488789C', 'Kakakak', 'kakaka@gmail.com', '$2y$10$0glmlgqheT7sBDVF4fslf.bXfFZvuffuP7VK/jb4xU2o3ATsZp8A2');

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `articles`
--
ALTER TABLE `articles`
  ADD CONSTRAINT `user_dni` FOREIGN KEY (`user_dni`) REFERENCES `usuaris` (`DNI`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
