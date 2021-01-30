-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 29-01-2021 a las 18:07:45
-- Versión del servidor: 10.4.17-MariaDB
-- Versión de PHP: 7.4.14

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

--
-- Volcado de datos para la tabla `equipostrabajos`
--

INSERT INTO `equipostrabajos` (`id`, `created_at`, `updated_at`, `codigo`, `placa`, `marca`, `modelo`, `año`, `descripcion`) VALUES
(1, '2021-01-29 22:35:43', '2021-01-29 22:35:43', 'EQ.01', 'P0256CFH', 'Toyota', '4Runner', '2003', NULL),
(2, '2021-01-29 22:36:32', '2021-01-29 22:44:15', 'EQ.02', 'P-432899', 'Mitsubishi', 'L200', '2018', NULL),
(3, '2021-01-29 22:37:04', '2021-01-29 22:44:08', 'EQ.03', 'P-773188', 'Kia', 'K2700', '2017', NULL),
(4, '2021-01-29 22:37:33', '2021-01-29 22:43:57', 'EQ.04', 'P-809615', 'Chevrolet', 'NP300', '2018', NULL),
(5, '2021-01-29 22:38:01', '2021-01-29 22:43:48', 'EQ.05', 'P-837082', 'Kia', 'K700 4x4', '2018', NULL),
(6, '2021-01-29 22:38:26', '2021-01-29 22:43:32', 'EQ.06', 'P-872967', 'Volkswagen', 'Saveiro', '2018', NULL),
(7, '2021-01-29 22:38:50', '2021-01-29 22:43:23', 'EQ.07', 'M-346407', 'Honda', 'Moto', '2018', NULL),
(8, '2021-01-29 22:39:13', '2021-01-29 22:43:11', 'EQ.08', 'P-853603', 'Kia', 'K2700', '2019', NULL),
(9, '2021-01-29 22:39:44', '2021-01-29 22:42:59', 'EQ.09', 'P-858189', 'Kia', 'K3000 Furgón', '2019', NULL),
(10, '2021-01-29 22:40:12', '2021-01-29 22:43:03', 'EQ.10', 'P-933077', 'Kia', 'K2700 4x4', '2020', NULL),
(11, '2021-01-29 22:41:00', '2021-01-29 22:42:59', 'EQ.11', 'P-933082', 'Kia', 'k2700 4x4 F', '2020', NULL),
(12, '2021-01-29 22:41:24', '2021-01-29 22:42:36', 'EQ.12', 'P-934177', 'Kia', 'K2700', '2020', NULL),
(13, '2021-01-29 22:41:44', '2021-01-29 22:41:44', 'EQ.13', 'P-900554', 'Kia', 'k2700', '2020', NULL),
(14, '2021-01-29 22:42:07', '2021-01-29 22:42:07', 'EQ.14', 'P-997444', 'Mazda', 'BT-50', '2021', NULL);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
