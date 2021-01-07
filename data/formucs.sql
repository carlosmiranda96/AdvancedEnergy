-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 06-01-2021 a las 07:11:03
-- Versión del servidor: 10.4.14-MariaDB
-- Versión de PHP: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `advanced`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `formuc`
--

CREATE TABLE `formucs` (
  `id` int(11) NOT NULL,
  `sintoma` varchar(200) NOT NULL,
  `puntos` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `formuc`
--

INSERT INTO `formucs` (`id`, `sintoma`, `puntos`) VALUES
(1, 'Tos', 1),
(2, 'Escalofrios', 1),
(3, 'Diarrea', 1),
(4, 'Dolor de garganta', 1),
(5, 'Dolor de cuerpo / Malestar general', 1),
(6, 'Dolor de cabeza', 1),
(7, 'Fiebre mayor a 37.8 grados C', 1),
(8, 'Perdida de Olfato y/o Gusto', 1),
(9, 'Dolor en la nariz al respirar', 1),
(10, 'Dificultad para respirar (Como si no entrara aire al pecho)', 1),
(11, 'Siente fatiga con solo caminar o hablar', 1),
(12, 'Has viajado o estado en un área o zona afectada por COVID 19 en los últimos 8 dias', 1),
(13, 'Has estado en contacto directo o cuidado a algún paciente que ha dado positivo COVID 19 en los ultimos 8 dias', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `formuc`
--
ALTER TABLE `formucs`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `formuc`
--
ALTER TABLE `formucs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
