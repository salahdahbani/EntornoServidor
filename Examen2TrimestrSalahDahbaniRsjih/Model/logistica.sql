-- phpMyAdmin SQL Dump
-- version 5.2.1deb3
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 15-02-2026 a las 14:50:09
-- Versión del servidor: 10.11.13-MariaDB-0ubuntu0.24.04.1
-- Versión de PHP: 8.3.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `logistica`
--
CREATE DATABASE IF NOT EXISTS `logistica` DEFAULT CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci;
USE `logistica`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ciudad`
--

CREATE TABLE `ciudad` (
  `id` int(11) NOT NULL,
  `nombre` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci;

--
-- Volcado de datos para la tabla `ciudad`
--

INSERT INTO `ciudad` (`id`, `nombre`) VALUES
(1, 'Madrid'),
(2, 'Barcelona'),
(3, 'Valencia'),
(4, 'Sevilla'),
(5, 'Zaragoza'),
(6, 'Málaga'),
(7, 'Murcia'),
(8, 'Oviedo'),
(9, 'Gijón'),
(10, 'A Coruña');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `transporte`
--

CREATE TABLE `transporte` (
  `id` int(11) NOT NULL,
  `origen` int(11) NOT NULL,
  `destino` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `empresa` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci;

--
-- Volcado de datos para la tabla `transporte`
--

INSERT INTO `transporte` (`id`, `origen`, `destino`, `fecha`, `empresa`) VALUES
(1, 1, 2, '2024-01-15', 'Transportes S.A.'),
(2, 2, 3, '2024-01-16', 'Logística Express'),
(3, 3, 4, '2024-01-17', 'Express Transport'),
(4, 4, 5, '2024-01-18', 'Transporte Rápido'),
(5, 5, 6, '2024-01-19', 'Logística Global'),
(6, 6, 7, '2024-01-20', 'Transportes S.A.'),
(7, 7, 8, '2024-01-21', 'Logística Express'),
(8, 8, 9, '2024-01-22', 'Express Transport'),
(9, 9, 10, '2024-01-23', 'Transporte Rápido'),
(10, 10, 1, '2024-01-24', 'Logística Global'),
(11, 4, 1, '2026-02-28', 'Agerul'),
(12, 4, 7, '2026-02-28', 'CocaCola'),
(13, 6, 4, '2026-02-28', 'PcComponentes'),
(14, 4, 1, '2026-02-25', 'SuperCarmela'),
(15, 6, 1, '2026-02-25', 'Cruzcampo'),
(16, 9, 8, '2026-02-25', 'PcComponentes'),
(17, 7, 8, '2026-03-01', 'Transporte Rápido');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `ciudad`
--
ALTER TABLE `ciudad`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `transporte`
--
ALTER TABLE `transporte`
  ADD PRIMARY KEY (`id`),
  ADD KEY `transporte_fk_1` (`origen`),
  ADD KEY `transporte_fk_2` (`destino`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `ciudad`
--
ALTER TABLE `ciudad`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `transporte`
--
ALTER TABLE `transporte`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `transporte`
--
ALTER TABLE `transporte`
  ADD CONSTRAINT `transporte_fk_1` FOREIGN KEY (`origen`) REFERENCES `ciudad` (`id`),
  ADD CONSTRAINT `transporte_fk_2` FOREIGN KEY (`destino`) REFERENCES `ciudad` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
