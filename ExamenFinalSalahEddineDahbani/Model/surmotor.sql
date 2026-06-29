-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 08-06-2023 a las 10:56:11
-- Versión del servidor: 10.4.27-MariaDB
-- Versión de PHP: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `surmotor`
--
CREATE DATABASE IF NOT EXISTS `surmotor` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `surmotor`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `coche`
--

CREATE TABLE `coche` (
  `id` int(11) NOT NULL,
  `modelo` varchar(30) NOT NULL,
  `unidades` int(11) NOT NULL,
  `concesionario` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `coche`
--

INSERT INTO `coche` (`id`, `modelo`, `unidades`, `concesionario`) VALUES
(1, 'Alfa Romeo', 4, 'Alcala'),
(2, 'Alfa Romeo', 4, 'Palacios'),
(4, 'Fiat Punto', 3, 'Utrera'),
(5, 'Renault Clio', 5, 'DosHermanas'),
(6, 'Volkswagen Golf', 1, 'Utrera'),
(9, 'Toyota Corolla', 2, 'Utrera'),
(10, 'Seat Ibiza', 3, 'Alcala'),
(11, 'Opel Corsa', 4, 'Moron'),
(12, 'Ford Fiesta', 2, 'Palacios');



--
-- Indices de la tabla `coche`
--
ALTER TABLE `coche`
  ADD PRIMARY KEY (`id`);


--
-- AUTO_INCREMENT de la tabla `coche`
--
ALTER TABLE `coche`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;


COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
