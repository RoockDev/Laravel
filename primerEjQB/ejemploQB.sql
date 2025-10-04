-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 30-09-2025 a las 19:39:43
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
-- Base de datos: `ejemploQB`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `coches`
--

CREATE TABLE `coches` (
  `matricula` varchar(10) NOT NULL,
  `marca` varchar(20) NOT NULL,
  `modelo` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `coches`
--

INSERT INTO `coches` (`matricula`, `marca`, `modelo`) VALUES
('100A', 'Citroen', 'C3'),
('200B', 'Citroen', 'C5'),
('300C', 'Peugeot', '205'),
('400D', 'Peugeot', '405'),
('500E', 'Renault', 'Megane'),
('600F', 'Renault', 'Laguna'),
('6298F', 'Cit', 'C5'),
('700I', 'Opel', 'Insignia'),
('800J', 'Seat', 'León');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personas`
--

CREATE TABLE `personas` (
  `dni` varchar(10) NOT NULL,
  `nombre` varchar(20) NOT NULL,
  `tfno` varchar(20) NOT NULL,
  `edad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `personas`
--

INSERT INTO `personas` (`dni`, `nombre`, `tfno`, `edad`) VALUES
('1A', 'Noelia', '2345', 32),
('2B', 'Alfredo', '435', 33),
('3C', 'Sergio', '3', 36),
('4D', 'Marta', '4', 45),
('5E', 'Víctor', '5', 25),
('6F', 'Álvaro', '6', 30),
('7G', 'Cristina', '435', 34),
('8H', 'Jaime', '1234', 12),
('9I', 'Ian', '1234', 39);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personas_id_auto`
--

CREATE TABLE `personas_id_auto` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `tfno` varchar(50) NOT NULL,
  `edad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `personas_id_auto`
--

INSERT INTO `personas_id_auto` (`id`, `nombre`, `tfno`, `edad`) VALUES
(1, 'Chubaca', '23456', 324),
(2, 'Obi-Wan', '435', 180),
(3, 'Leia', '435', 180),
(4, 'Luke', '435', 180),
(5, 'Han Solo', '435', 180),
(6, 'Qui-Gon', '435', 180),
(7, 'Anakin', '435', 180);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `propiedades`
--

CREATE TABLE `propiedades` (
  `dni` varchar(10) NOT NULL,
  `matricula` varchar(10) NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `propiedades`
--

INSERT INTO `propiedades` (`dni`, `matricula`, `id`) VALUES
('1A', '100A', 1),
('1A', '200B', 2),
('2B', '300C', 3),
('3C', '400D', 4),
('4D', '500E', 5);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `coches`
--
ALTER TABLE `coches`
  ADD PRIMARY KEY (`matricula`);

--
-- Indices de la tabla `personas`
--
ALTER TABLE `personas`
  ADD PRIMARY KEY (`dni`);

--
-- Indices de la tabla `personas_id_auto`
--
ALTER TABLE `personas_id_auto`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `propiedades`
--
ALTER TABLE `propiedades`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `personas_id_auto`
--
ALTER TABLE `personas_id_auto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `propiedades`
--
ALTER TABLE `propiedades`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
