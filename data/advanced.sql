-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 11-01-2021 a las 17:19:26
-- Versión del servidor: 10.4.16-MariaDB
-- Versión de PHP: 7.4.12

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
-- Estructura de tabla para la tabla `autorizacionusuarios`
--

CREATE TABLE `autorizacionusuarios` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `idusuario` int(11) NOT NULL,
  `idpermiso` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cargos`
--

CREATE TABLE `cargos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `cargo` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `idDepartamento` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `departamentos`
--

CREATE TABLE `departamentos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `departamento` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nivel` int(11) NOT NULL,
  `dependencia` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dias`
--

CREATE TABLE `dias` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `dia` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dias_feriados`
--

CREATE TABLE `dias_feriados` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `fecha` date NOT NULL,
  `descripcion` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleados`
--

CREATE TABLE `empleados` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `fechaingreso` date NOT NULL,
  `codigo` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nombre1` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nombre2` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `apellido1` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `apellido2` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `apellido3` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nombreCompleto` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `direccion` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `correo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telefono` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `celular` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fechanacimiento` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `idgenero` int(11) NOT NULL,
  `idestadocivil` int(11) NOT NULL,
  `idmunicipio` int(11) NOT NULL,
  `estado` tinyint(1) NOT NULL,
  `toquen` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `empleados`
--

INSERT INTO `empleados` (`id`, `created_at`, `updated_at`, `fechaingreso`, `codigo`, `nombre1`, `nombre2`, `apellido1`, `apellido2`, `apellido3`, `nombreCompleto`, `foto`, `direccion`, `correo`, `telefono`, `celular`, `fechanacimiento`, `idgenero`, `idestadocivil`, `idmunicipio`, `estado`, `toquen`) VALUES
(1, '2020-12-11 05:03:17', '2020-12-11 05:03:17', '2016-04-01', 'AE-001', 'Alejandro', 'Eduardo', 'Bellas', 'Mayer', NULL, 'Alejandro Eduardo Bellas Mayer', 'fotoempleado/DqS3r4jlizX6NqPPRwQOSrY1nCGUXfCPUpLuYQgF.jpeg', NULL, NULL, NULL, NULL, NULL, 1, 1, 110, 1, 'eyJpdiI6ImVKaFZaMWlz'),
(2, '2020-12-11 05:04:26', '2020-12-11 05:04:58', '2016-04-01', 'AE-002', 'Hasdy', 'Salvador', 'Muñoz', 'Montoya', NULL, 'Hasdy Salvador Muñoz Montoya', 'fotoempleado/AkktZ9n7CVspPiXmqWz31yJzJ4U71iOllgabakXN.jpeg', NULL, NULL, NULL, NULL, NULL, 1, 1, 110, 0, 'eyJpdiI6Ik5UeXgvYldJ'),
(3, '2020-12-11 05:06:45', '2020-12-11 05:06:45', '2017-08-01', 'AE-003', 'Denis', 'Iván', 'Herrera', NULL, NULL, 'Denis Iván Herrera', 'fotoempleado/perfilDefault.jpg', NULL, NULL, NULL, NULL, NULL, 1, 1, 110, 1, 'eyJpdiI6ImxtQkhnTUFN'),
(4, '2020-12-11 05:07:59', '2020-12-11 05:07:59', '2017-08-01', 'AE-004', 'Jose', 'Carlos', 'Calderón', 'Melendez', NULL, 'Jose Carlos Calderón Melendez', 'fotoempleado/PZdIJ5lAKxKvfB48n0z4KTDWmNc1wwZvmKCPjc6J.jpeg', NULL, NULL, NULL, NULL, NULL, 1, 1, 110, 1, 'eyJpdiI6ImRMMVpTWlBM'),
(5, '2020-12-11 05:09:37', '2020-12-11 05:09:37', '2017-08-01', 'AE-005', 'José', 'Miguel', 'Rodríguez', 'Romero', NULL, 'José Miguel Rodríguez Romero', 'fotoempleado/NGcoUkp6FUnJhtu8aqGgozuvcm5sKFMkihDbrCsG.jpeg', NULL, NULL, NULL, NULL, NULL, 1, 1, 110, 1, 'eyJpdiI6IjRMZ2pmTmpt'),
(6, '2020-12-11 05:10:42', '2020-12-11 05:10:42', '2017-09-07', 'AE-006', 'Santos', 'Alexander', 'Ramirez', 'Rivera', NULL, 'Santos Alexander Ramirez Rivera', 'fotoempleado/Pp6vBFdylGSgU6SEFPkyPwTKhTzMu27RNSsjTbEg.jpeg', NULL, NULL, NULL, NULL, NULL, 1, 1, 110, 1, 'eyJpdiI6IkZEQVd1QSt5'),
(7, '2020-12-11 05:11:31', '2020-12-11 05:11:31', '2017-10-09', 'AE-007', 'Francisco', 'Antonio', 'Cardona', 'Bernal', NULL, 'Francisco Antonio Cardona Bernal', 'fotoempleado/EoclcejOq74jaDd2ZyAbvpcTQ05RxdmAEUOnkxIY.jpeg', NULL, NULL, NULL, NULL, NULL, 1, 1, 110, 1, 'eyJpdiI6InlNTmJuL3NS'),
(8, '2020-12-11 05:12:31', '2020-12-11 05:12:31', '2017-12-04', 'AE-008', 'Ana', 'Beatriz', 'Castillo', 'Hernández', NULL, 'Ana Beatriz Castillo Hernández', 'fotoempleado/nVF0DkPrSjlrMc570dem5lDfcFsIFyQxe5Rhg92M.jpeg', NULL, NULL, NULL, NULL, NULL, 2, 1, 110, 1, 'eyJpdiI6InBnemFrOGwr'),
(9, '2020-12-11 05:13:18', '2020-12-11 05:13:18', '2018-01-01', 'AE-009', 'Abimael', 'Fernando', 'Pérez', 'Pérez', NULL, 'Abimael Fernando Pérez Pérez', 'fotoempleado/pIFeIaF6DDPpZMFawxSYOO8psqakT7dZqHAc4cfX.jpeg', NULL, NULL, NULL, NULL, NULL, 1, 1, 110, 1, 'eyJpdiI6IlM4V1BLQzAz'),
(10, '2020-12-11 05:14:21', '2020-12-11 05:14:21', '2018-01-01', 'AE-010', 'Aura', 'Raquel', 'Hernández', NULL, 'Fernández', 'Aura Raquel Hernández de Fernández', 'fotoempleado/5oHPWyUJSef5BUWKQp8Xx1PLtppIdQxN73gTVL7M.jpeg', NULL, NULL, NULL, NULL, NULL, 2, 1, 110, 1, 'eyJpdiI6Im9Kc1UweUtL'),
(11, '2020-12-11 05:15:07', '2020-12-11 05:15:07', '2018-01-01', 'AE-011', 'Dennis', 'Mardoqueo', 'Oxlaj', 'Oliva', NULL, 'Dennis Mardoqueo Oxlaj Oliva', 'fotoempleado/bqNbDmPspTkB8LOP6kMStpJYUyJctMW2NCidJiIG.jpeg', NULL, NULL, NULL, NULL, NULL, 1, 1, 110, 1, 'eyJpdiI6IkhaV0VTRmRl'),
(12, '2020-12-11 05:16:50', '2020-12-11 05:17:00', '2018-01-01', 'AE-012', 'Diego', 'Samuel', 'Terraza', 'Cobo', NULL, 'Diego Samuel Terraza Cobo', 'fotoempleado/JiMHwH6x8WXShiJiBxwNoullJ4LwyxKzweWGukw7.jpeg', NULL, NULL, NULL, NULL, NULL, 1, 1, 110, 1, 'eyJpdiI6IkdZOE13d1ZU'),
(13, '2020-12-11 05:18:00', '2020-12-11 05:18:00', '2018-01-01', 'AE-013', 'Hugo', 'Horacio', 'Martínez', 'Muyuz', NULL, 'Hugo Horacio Martínez Muyuz', 'fotoempleado/CZ0dtnsB805VJQlGQo1ZdAywb4zMJj5koZj1DTIU.jpeg', NULL, NULL, NULL, NULL, NULL, 1, 1, 110, 1, 'eyJpdiI6IjFGRE54Sytq'),
(14, '2020-12-11 05:18:49', '2020-12-11 05:18:49', '2018-02-20', 'AE-014', 'Edwin', 'René', 'Rivas', 'Miranda', NULL, 'Edwin René Rivas Miranda', 'fotoempleado/1EhcAxcr3zKDHpddLCh1ZFUJ6iwRx0j1Ax0dgrvh.jpeg', NULL, NULL, NULL, NULL, NULL, 1, 1, 110, 1, 'eyJpdiI6IkhmVzVuY2xq'),
(15, '2020-12-11 05:19:44', '2020-12-11 05:19:44', '2018-04-25', 'AE-015', 'Elvis', 'Antonio', 'García', 'Pérez', NULL, 'Elvis Antonio García Pérez', 'fotoempleado/4QETCUp2DIulYHkFLqlDBHJToy9Ucglns1QFzpHq.jpeg', NULL, NULL, NULL, NULL, NULL, 1, 1, 110, 1, 'eyJpdiI6Ik15SThiYXlR'),
(16, '2020-12-11 05:21:48', '2020-12-11 05:21:48', '2018-06-01', 'AE-016', 'Alberto', 'José', 'Girón', 'Garcés', 'Marcilla', 'Alberto José Girón Garcés de Marcilla', 'fotoempleado/0fl6FJjRpomjGPvqln8YFoqoBf2yONFwsA04Vmag.jpeg', NULL, NULL, NULL, NULL, NULL, 1, 1, 110, 1, 'eyJpdiI6IllmZFkvMVNU'),
(17, '2020-12-11 05:22:44', '2020-12-11 05:22:44', '2018-07-02', 'AE-017', 'David', 'Antonio', 'Rosales', 'Vásquez', NULL, 'David Antonio Rosales Vásquez', 'fotoempleado/mJ6JismthLnyu1sMwzG6pGWGCPT6L61HdgWv6gbc.jpeg', NULL, NULL, NULL, NULL, NULL, 1, 1, 110, 1, 'eyJpdiI6IkN2NUwxczk2'),
(18, '2020-12-11 05:23:49', '2020-12-11 05:23:49', '2018-07-02', 'AE-018', 'Roberto', 'Carlos', 'Vásquez', 'Rosales', NULL, 'Roberto Carlos Vásquez Rosales', 'fotoempleado/qhDgXyhDsIYJt3FLuMt0amvYbXG0BeaF4AzmlIhS.jpeg', NULL, NULL, NULL, NULL, NULL, 1, 1, 110, 1, 'eyJpdiI6ImdhWkEwdThZ'),
(19, '2020-12-11 05:24:33', '2020-12-11 05:24:33', '2018-09-03', 'AE-019', 'Javier', 'Antonio', 'Castillo', 'Hernández', NULL, 'Javier Antonio Castillo Hernández', 'fotoempleado/RfXTWeMt6oEBdY0pHuS6omf0jTyeApANRG2wwGfh.jpeg', NULL, NULL, NULL, NULL, NULL, 1, 1, 110, 1, 'eyJpdiI6InNSL0tZWExq'),
(20, '2020-12-11 05:25:22', '2020-12-11 05:25:22', '2018-09-08', 'AE-020', 'Walter', 'Enrique', 'Soriano', 'Cruz', NULL, 'Walter Enrique Soriano Cruz', 'fotoempleado/EZaRZUgVktunSCpiwyK3q2GNzxOonZn0CeYppNXf.jpeg', NULL, NULL, NULL, NULL, NULL, 1, 1, 110, 1, 'eyJpdiI6Ilo3N09OZU1n'),
(21, '2020-12-11 05:26:46', '2020-12-11 05:26:46', '2018-09-14', 'AE-021', 'José', 'David de Jesús', 'Sandoval', 'López', NULL, 'José David de Jesús Sandoval López', 'fotoempleado/lXZjAQDtbLZjl1nHL4EswqXKjcrKesYSDgTeQgfH.jpeg', NULL, NULL, NULL, NULL, NULL, 1, 1, 110, 1, 'eyJpdiI6IkVKNk1HWjcz'),
(22, '2020-12-11 05:27:44', '2020-12-11 05:27:44', '2018-09-17', 'AE-022', 'Yanira', 'Evelyn', 'Peña', NULL, NULL, 'Yanira Evelyn Peña', 'fotoempleado/JFyMY3nFm0Q3iGePGvfyZX34ky8u4rkgGVS4AoK0.jpeg', NULL, NULL, NULL, NULL, NULL, 1, 1, 110, 1, 'eyJpdiI6IjFnWjVMTjJ2'),
(23, '2020-12-11 05:28:18', '2020-12-11 05:41:40', '2018-10-05', 'AE-023', 'Nelvin', 'Daniel', 'Arias', 'Diaz', NULL, 'Nelvin Daniel Arias Diaz', 'fotoempleado/kpeIEOaZ0rnFcSt4w38ivPQjZLQ5q9Yu24Tdoh1m.jpeg', NULL, NULL, NULL, NULL, NULL, 1, 1, 110, 1, 'eyJpdiI6InlDcmt1MGtj'),
(24, '2020-12-11 05:29:20', '2020-12-11 05:29:20', '2018-10-22', 'AE-024', 'Emérita', 'Sarai', 'Monterroza', NULL, 'Gamez', 'Emérita Sarai Monterroza de Gamez', 'fotoempleado/yV4rJI6iHUsc40R8wuS4kMlpUBmMO63GOibFLw8n.jpeg', NULL, NULL, NULL, NULL, NULL, 2, 1, 110, 1, 'eyJpdiI6IjBnMVdwN1M3'),
(25, '2020-12-11 05:30:06', '2020-12-11 05:30:06', '2018-10-22', 'AE-025', 'Manuel', 'Antonio', 'Rodas', 'Rodriguez', NULL, 'Manuel Antonio Rodas Rodriguez', 'fotoempleado/yqKc3O5bWZKu2ujfi3eiWjHSM8cRxLooNPenycVA.jpeg', NULL, NULL, NULL, NULL, NULL, 2, 1, 110, 1, 'eyJpdiI6IlRjUFQrTk9a'),
(26, '2020-12-11 05:42:49', '2020-12-11 05:42:49', '2018-10-29', 'AE-026', 'Jacquelinne', 'Marili', 'Osorio', 'Castillo', NULL, 'Jacquelinne Marili Osorio Castillo', 'fotoempleado/GAcbfHMnXFUanyZ9QAVRCIRueBMwguHs2DoOZBTa.jpeg', NULL, NULL, NULL, NULL, NULL, 2, 1, 110, 1, 'eyJpdiI6Ino5MEMySjQy'),
(27, '2020-12-11 05:43:32', '2020-12-11 05:43:32', '2018-11-26', 'AE-027', 'Carlos', 'Alfredo', 'Méndez', 'Portillo', NULL, 'Carlos Alfredo Méndez Portillo', 'fotoempleado/UZeBRMst4JznMpfm1kElbIWny1Kx9zglCDJr7tuM.jpeg', NULL, NULL, NULL, NULL, NULL, 1, 1, 110, 1, 'eyJpdiI6Inc2Z09NT3Zs'),
(28, '2020-12-11 05:44:23', '2020-12-11 05:44:23', '2018-11-26', 'AE-028', 'José', 'Tomás', 'Aquino', 'Morales', NULL, 'José Tomás Aquino Morales', 'fotoempleado/maq5XFeiYR5Ngw8n1ElbryDvvSeA5JCxiQHpoIBm.jpeg', NULL, NULL, NULL, NULL, NULL, 1, 1, 110, 1, 'eyJpdiI6IlZJZFJudTcz'),
(29, '2020-12-11 05:45:07', '2020-12-11 05:45:07', '2018-11-26', 'AE-029', 'Lázaro', NULL, 'Carias', NULL, NULL, 'Lázaro Carias', 'fotoempleado/Oo3p0jPq3UhoXsjQPJrOUiccvpX60xqOCnq3weze.jpeg', NULL, NULL, NULL, NULL, NULL, 1, 1, 110, 1, 'eyJpdiI6IjUraEZjS0xo'),
(30, '2020-12-11 05:45:57', '2020-12-11 05:45:57', '2018-12-28', 'AE-030', 'Marcos', 'Enrique', 'Rivas', 'Tejada', NULL, 'Marcos Enrique Rivas Tejada', 'fotoempleado/VDh1kP4J0qNyqtkB49gdNilvaOJDdHzw8OFqhqqS.jpeg', NULL, NULL, NULL, NULL, NULL, 1, 1, 110, 1, 'eyJpdiI6IlpQc2JQaTRL'),
(31, '2020-12-11 05:46:50', '2020-12-11 05:46:50', '2019-01-21', 'AE-031', 'José', 'Angel', 'Guadrón', 'Guevara', NULL, 'José Angel Guadrón Guevara', 'fotoempleado/os3QMXO4E57t2NuoX0IZBO7ABrYZ7fg5ZSkdTm9Z.jpeg', NULL, NULL, NULL, NULL, NULL, 1, 1, 110, 1, 'eyJpdiI6ImxqeGFYN0VP'),
(32, '2020-12-11 05:48:15', '2020-12-11 05:48:15', '2019-02-01', 'AE-032', 'Christian', 'Rafael', 'Mejía', 'Chevez', NULL, 'Christian Rafael Mejía Chevez', 'fotoempleado/djwUSXV3CJWNkxjLuQkXY0DTCwKbGilQNmpuM6xP.jpeg', NULL, NULL, NULL, NULL, NULL, 1, 1, 110, 1, 'eyJpdiI6IjhpWGltT2lm'),
(33, '2020-12-11 05:49:09', '2020-12-11 05:49:09', '2019-02-27', 'AE-033', 'Jairo', 'Isaac', 'Donis', 'Palma', NULL, 'Jairo Isaac Donis Palma', 'fotoempleado/SeZlS02QU7HDq4CnylKqJC31shZkNKl1JgmtKC3b.jpeg', NULL, NULL, NULL, NULL, NULL, 1, 1, 110, 1, 'eyJpdiI6ImJDK1JkTjJW'),
(34, '2020-12-11 05:50:09', '2020-12-11 05:50:09', '2019-02-28', 'AE-034', 'Carlos', 'Humberto', 'Fernández', 'Polanco', NULL, 'Carlos Humberto Fernández Polanco', 'fotoempleado/xMfnKsFyo6xMq2kudhpbgvojoGKZYbATeSAVI6jT.jpeg', NULL, NULL, NULL, NULL, NULL, 1, 1, 110, 1, 'eyJpdiI6IlNxV0E2L0Fi'),
(35, '2020-12-11 05:51:03', '2020-12-11 05:51:03', '2019-04-04', 'AE-035', 'Héctor', 'David', 'Romero', 'Aguilar', NULL, 'Héctor David Romero Aguilar', 'fotoempleado/PLOZ0DBkR9g4R2O9jex4A9qr0a81XCWknUoZZVH6.jpeg', NULL, NULL, NULL, NULL, NULL, 1, 1, 110, 1, 'eyJpdiI6ImhRYjdhbmQ2'),
(36, '2020-12-11 05:52:01', '2020-12-11 05:52:01', '2019-04-22', 'AE-036', 'Wilber', 'Alcides', 'Castillo', 'Nufio', NULL, 'Wilber Alcides Castillo Nufio', 'fotoempleado/YoMpnBr18WyrRaa6vUKuBg8i1wtNVXGUABJghoBK.jpeg', NULL, NULL, NULL, NULL, NULL, 1, 1, 110, 1, 'eyJpdiI6Im5acjh4RzlU'),
(37, '2020-12-11 05:52:55', '2020-12-11 05:52:55', '2019-05-07', 'AE-037', 'Luis', 'Ernesto', 'Sandoval', 'Martínez', NULL, 'Luis Ernesto Sandoval Martínez', 'fotoempleado/GoUXZ7xrMCosnXAitLPsvm9duNAdgj712kb8U1ay.jpeg', NULL, NULL, NULL, NULL, NULL, 1, 1, 110, 1, 'eyJpdiI6IlRqdFZremJ2'),
(38, '2020-12-11 05:53:43', '2020-12-11 05:53:43', '2019-05-30', 'AE-038', 'Douglas', 'Omar', 'Montano', 'Hernández', NULL, 'Douglas Omar Montano Hernández', 'fotoempleado/U0wopzVnXLrpNWdvSEORZEh1SLaXvGGsEIn6Xq3p.jpeg', NULL, NULL, NULL, NULL, NULL, 1, 1, 110, 1, 'eyJpdiI6IjR0dGhJRHZK'),
(39, '2020-12-11 05:55:05', '2020-12-11 05:55:05', '2019-06-06', 'AE-039', 'Fernando', 'José', 'Alvarado', 'Vaquero', NULL, 'Fernando José Alvarado Vaquero', 'fotoempleado/perfilDefault.jpg', NULL, NULL, NULL, NULL, NULL, 1, 1, 110, 1, 'eyJpdiI6IkpyS0ZWMThP'),
(40, '2020-12-11 05:55:38', '2020-12-11 05:55:38', '2019-08-01', 'AE-040', 'Edgar', 'Dennys', 'Pérez', 'Chicas', NULL, 'Edgar Dennys Pérez Chicas', 'fotoempleado/perfilDefault.jpg', NULL, NULL, NULL, NULL, NULL, 1, 1, 110, 1, 'eyJpdiI6InJIUHRPVUM3'),
(41, '2020-12-11 05:56:16', '2020-12-11 05:56:16', '2019-08-01', 'AE-041', 'Elías', 'Israel', 'Carias', 'Patriz', NULL, 'Elías Israel Carias Patriz', 'fotoempleado/perfilDefault.jpg', NULL, NULL, NULL, NULL, NULL, 1, 1, 110, 1, 'eyJpdiI6Ikw2ZWZBSHZF'),
(42, '2020-12-11 05:56:53', '2020-12-11 05:56:53', '2019-08-01', 'AE-042', 'Luis', 'Alonso', 'Valdez', NULL, NULL, 'Luis Alonso Valdez', 'fotoempleado/perfilDefault.jpg', NULL, NULL, NULL, NULL, NULL, 2, 1, 110, 1, 'eyJpdiI6Inc2WnhORFFD'),
(43, '2020-12-11 05:57:42', '2020-12-11 05:57:42', '2019-09-23', 'AE-043', 'Amilcar', 'Heriberto', 'Rosales', 'Flores', NULL, 'Amilcar Heriberto Rosales Flores', 'fotoempleado/ssbGYhlOApwyDlfD0vSjFMRo2lPGPjiiSSbilWeb.jpeg', NULL, NULL, NULL, NULL, NULL, 1, 1, 110, 1, 'eyJpdiI6Ii9LOHBRWGhx'),
(44, '2020-12-11 05:58:34', '2020-12-11 05:58:34', '2019-10-21', 'AE-044', 'José', 'Erick', 'Duán', 'Soriano', NULL, 'José Erick Duán Soriano', 'fotoempleado/perfilDefault.jpg', NULL, NULL, NULL, NULL, NULL, 1, 1, 110, 1, 'eyJpdiI6IkczV1UyRkJh'),
(45, '2020-12-11 05:59:27', '2020-12-11 05:59:27', '2019-11-25', 'AE-045', 'Vilma', 'Haydee', 'Portillo', NULL, 'Oliva', 'Vilma Haydee Portillo de Oliva', 'fotoempleado/qmixXwQXqTqnI1iSOKZZPeb470BR9gY7JBMdc6QT.jpeg', NULL, NULL, NULL, NULL, NULL, 2, 1, 110, 1, 'eyJpdiI6IklhK1IyK1Bq'),
(46, '2020-12-11 06:00:07', '2020-12-11 06:00:07', '2019-12-16', 'AE-046', 'Rafael', 'Stanley', 'Pérez', NULL, NULL, 'Rafael Stanley Pérez', 'fotoempleado/perfilDefault.jpg', NULL, NULL, NULL, NULL, NULL, 1, 1, 110, 1, 'eyJpdiI6IkNCUm8wNGV3'),
(47, '2020-12-11 06:01:06', '2020-12-11 06:01:06', '2019-12-16', 'AE-047', 'Roberto', 'Alfonso', 'Tobar', 'Hernández', NULL, 'Roberto Alfonso Tobar Hernández', 'fotoempleado/perfilDefault.jpg', NULL, NULL, NULL, NULL, NULL, 1, 1, 110, 1, 'eyJpdiI6Imp6Qnp3QzBD'),
(48, '2020-12-11 06:01:37', '2020-12-11 06:01:37', '2019-12-16', 'AE-048', 'Ventura', 'Navidad', 'Cruz', NULL, NULL, 'Ventura Navidad Cruz', 'fotoempleado/perfilDefault.jpg', NULL, NULL, NULL, NULL, NULL, 1, 1, 110, 1, 'eyJpdiI6Ik44YmdVczk5'),
(49, '2020-12-11 06:03:27', '2020-12-11 06:03:27', '2020-02-10', 'AE-049', 'Rosa', 'Elena', 'Lovo', 'Ayala', NULL, 'Rosa Elena Lovo Ayala', 'fotoempleado/perfilDefault.jpg', NULL, NULL, NULL, NULL, NULL, 1, 1, 110, 1, 'eyJpdiI6IjVrN2pBNmZL'),
(50, '2020-12-11 06:04:09', '2020-12-11 06:04:09', '2020-02-21', 'AE-050', 'José', 'Arturo', 'Ordoñez', NULL, NULL, 'José Arturo Ordoñez', 'fotoempleado/perfilDefault.jpg', NULL, NULL, NULL, NULL, NULL, 1, 1, 110, 1, 'eyJpdiI6IkY1djgxMVYy'),
(51, '2020-12-11 06:05:19', '2020-12-11 06:06:50', '2020-03-04', 'AE-051', 'Amílcar', 'Enrique', 'Marroquín', 'Villalta', NULL, 'Amílcar Enrique Marroquín Villalta', 'fotoempleado/4xJmmlpNtk2Zrdx8pad5IaFBBHYpQFTnIsLdVsAr.jpeg', NULL, NULL, NULL, NULL, NULL, 1, 1, 110, 1, 'eyJpdiI6Ik9qeitZcmNM'),
(52, '2020-12-11 06:07:42', '2020-12-11 06:07:42', '2020-03-16', 'AE-052', 'Segio', 'Alejandro', 'Meléndez', 'Carillo', NULL, 'Segio Alejandro Meléndez Carillo', 'fotoempleado/i6nPgMThxco0oZm4GGlAwRsXgHKsKMcQc6bVQpQz.jpeg', NULL, NULL, NULL, NULL, NULL, 1, 1, 110, 1, 'eyJpdiI6IldFSW4zNVFL'),
(53, '2020-12-11 06:08:23', '2020-12-11 06:08:23', '2020-03-17', 'AE-053', 'Ernesto', 'Antonio', 'Castro', 'Sánchez', NULL, 'Ernesto Antonio Castro Sánchez', 'fotoempleado/perfilDefault.jpg', NULL, NULL, NULL, NULL, NULL, 1, 1, 110, 1, 'eyJpdiI6Ik1ncDA0TEY4'),
(54, '2020-12-11 06:09:15', '2020-12-11 06:09:15', '2020-04-16', 'AE-054', 'Luis', 'Mario', 'Alarcón', 'Aguirre', NULL, 'Luis Mario Alarcón Aguirre', 'fotoempleado/vXbS6WNwMS4oFg0CaxwB3V5TpGIqK7AckclqbvUo.jpeg', NULL, NULL, NULL, NULL, NULL, 1, 1, 110, 1, 'eyJpdiI6IjlOMGlSOXc1'),
(55, '2020-12-11 06:10:11', '2020-12-11 06:10:11', '2020-06-16', 'AE-055', 'Jaime', 'Alexander', 'Martínez', 'Martínez', NULL, 'Jaime Alexander Martínez Martínez', 'fotoempleado/21OP9zraJya5Eqn8QVfU9TRAuMLPdbkBSH5P5Zox.jpeg', NULL, NULL, NULL, NULL, NULL, 1, 1, 110, 1, 'eyJpdiI6Ijc4ZHlaZDVY'),
(56, '2020-12-11 06:11:21', '2020-12-11 06:11:21', '2020-07-01', 'AE-056', 'Ana', 'Beatriz', 'Girón', 'Lavagnino', NULL, 'Ana Beatriz Girón Lavagnino', 'fotoempleado/0Lep35ANGjZoEwt8BrqpQnCOTXMUnRr3lSdIEjdR.jpeg', NULL, NULL, NULL, NULL, NULL, 2, 1, 110, 1, 'eyJpdiI6InhMTzFLQjdW'),
(57, '2020-12-11 06:12:06', '2020-12-11 06:12:06', '2020-07-06', 'AE-057', 'Eduardo', 'Jeremías', 'Martínez', 'Contreras', NULL, 'Eduardo Jeremías Martínez Contreras', 'fotoempleado/egBpilIYpOjGDaSq2yfR18DYdwY4270jHcprnkj7.jpeg', NULL, NULL, NULL, NULL, NULL, 1, 1, 110, 1, 'eyJpdiI6InhjcjY0SHpI'),
(58, '2020-12-11 06:12:50', '2020-12-11 06:12:50', '2020-07-20', 'AE-058', 'Oscar', 'Ernesto', 'López', 'Ortiz', NULL, 'Oscar Ernesto López Ortiz', 'fotoempleado/T8HDoZgzAYR0dHwpPIW6lUcTKnUWTFu0oGsOP25B.jpeg', NULL, NULL, NULL, NULL, NULL, 1, 1, 110, 1, 'eyJpdiI6ImpNMjVGcjRO'),
(59, '2020-12-11 06:13:44', '2020-12-11 06:13:44', '2020-07-23', 'AE-059', 'Karla', 'Michelle', 'Galdámez', 'Vásquez', NULL, 'Karla Michelle Galdámez Vásquez', 'fotoempleado/cRab6dDzjAX7kGsOe78rw91XqP0aGGsQKnudZM9z.jpeg', NULL, NULL, NULL, NULL, NULL, 1, 1, 110, 1, 'eyJpdiI6IkZSUWNiN1Yz'),
(60, '2020-12-11 06:15:08', '2020-12-11 06:15:08', '2020-07-23', 'AE-060', 'Oscar', 'Miguel', 'Vargas', 'Nájera', NULL, 'Oscar Miguel Vargas Nájera', 'fotoempleado/NPtCPG1Md6lqmshVAXuYeBU4BQHm6IucUs8ol2CJ.jpeg', NULL, NULL, NULL, NULL, NULL, 1, 1, 110, 1, 'eyJpdiI6InoyaVdxZ2l2'),
(61, '2020-12-11 06:16:02', '2020-12-11 06:16:02', '2020-07-24', 'AE-061', 'Oscar', 'Julián', 'Portillo', 'Arbues', NULL, 'Oscar Julián Portillo Arbues', 'fotoempleado/RwTzGrMcDryuxTUTF5NrTiTNOUruPfOW9dwEtIZq.jpeg', NULL, NULL, NULL, NULL, NULL, 1, 1, 110, 1, 'eyJpdiI6IjJuSGZhT29T'),
(62, '2020-12-11 06:16:44', '2020-12-11 06:16:44', '2020-08-01', 'AE-062', 'Rubén', 'Eliazar', 'López', 'Ortiz', NULL, 'Rubén Eliazar López Ortiz', 'fotoempleado/F3GzAk7aFvi5xxncniyve6ViStTu6yN4LnshWelV.jpeg', NULL, NULL, NULL, NULL, NULL, 1, 1, 110, 1, 'eyJpdiI6ImZlYlJHdEor'),
(63, '2020-12-11 06:17:25', '2020-12-11 06:17:25', '2020-08-15', 'AE-063', 'Juan', 'Carlos', 'Santos', 'Cruz', NULL, 'Juan Carlos Santos Cruz', 'fotoempleado/8FtpUUdHsHClRFX1CwRxDbsCVA2R6tMHFcB0wPaR.jpeg', NULL, NULL, NULL, NULL, NULL, 1, 1, 110, 1, 'eyJpdiI6IlpVanJ1dENZ'),
(64, '2020-12-11 06:18:15', '2020-12-11 06:18:15', '2020-08-17', 'AE-064', 'Gerardo', 'Enrique', 'Payés', 'Cruz', NULL, 'Gerardo Enrique Payés Cruz', 'fotoempleado/O6upH3I16aPZclMj8mNOOBDZEUiE6arFGSh5z1ry.jpeg', NULL, NULL, NULL, NULL, NULL, 1, 1, 110, 1, 'eyJpdiI6IlloTTVFYUZF'),
(65, '2020-12-11 06:19:10', '2020-12-11 06:19:10', '2020-08-17', 'AE-065', 'Nelson', 'Moisés', 'Elías', 'López', NULL, 'Nelson Moisés Elías López', 'fotoempleado/CuYb5YCdPYsCSRtjkVvwakY9ZU9XvcSRpT4mH68k.jpeg', NULL, NULL, NULL, NULL, NULL, 1, 1, 110, 1, 'eyJpdiI6IlZFWTRoNlFh'),
(66, '2020-12-11 06:20:01', '2020-12-11 06:20:01', '2020-08-18', 'AE-066', 'Jose', 'Luis', 'Pérez', 'Sion', NULL, 'Jose Luis Pérez Sion', 'fotoempleado/lYvaJQLg8hnmrNTykvdHnWniJuC8ccqZOwMlzpww.jpeg', NULL, NULL, NULL, NULL, NULL, 1, 1, 110, 1, 'eyJpdiI6InRXYWRVam5a'),
(67, '2020-12-11 06:20:45', '2020-12-11 06:20:45', '2020-08-19', 'AE-067', 'Julio', 'Gerson', 'Calderón', 'Flores', NULL, 'Julio Gerson Calderón Flores', 'fotoempleado/mN0rmBq1o1BbbGMhI6GsM4bdbPwiACosZkMcH00t.jpeg', NULL, NULL, NULL, NULL, NULL, 1, 1, 110, 1, 'eyJpdiI6IjBHVFc2Zlcr'),
(68, '2020-12-11 06:21:51', '2020-12-11 06:21:51', '2020-09-01', 'AE-068', 'Wilber', 'Alexis', 'Hernández', 'Sánchez', NULL, 'Wilber Alexis Hernández Sánchez', 'fotoempleado/Z49aSn8bG0PQJcRp8rRbikHmA4615zlaowOeSpWT.jpeg', NULL, NULL, NULL, NULL, NULL, 1, 1, 110, 1, 'eyJpdiI6InpOdXUwSWk1'),
(69, '2020-12-11 06:22:43', '2020-12-11 06:22:43', '2020-09-04', 'AE-069', 'Rene', 'Samuel', 'Sandoval', 'Martínez', NULL, 'Rene Samuel Sandoval Martínez', 'fotoempleado/perfilDefault.jpg', NULL, NULL, NULL, NULL, NULL, 2, 1, 110, 1, 'eyJpdiI6ImFhVkNFeGRM'),
(70, '2020-12-11 06:23:23', '2020-12-11 06:23:23', '2020-10-01', 'AE-070', 'David', 'Daniel', 'Hidalgo', 'Pineda', NULL, 'David Daniel Hidalgo Pineda', 'fotoempleado/perfilDefault.jpg', NULL, NULL, NULL, NULL, NULL, 1, 1, 110, 1, 'eyJpdiI6IjZZVHRkMWth'),
(71, '2020-12-11 06:24:14', '2020-12-11 06:24:14', '2020-10-14', 'AE-071', 'José', 'Rogelio', 'Rubio', 'Méndez', NULL, 'José Rogelio Rubio Méndez', 'fotoempleado/TSIPbpKQrNBbazsvsq0JjmHprYfIVn31OBomWznX.jpeg', NULL, NULL, NULL, NULL, NULL, 1, 1, 110, 1, 'eyJpdiI6InRiaTZqYUo0'),
(72, '2020-12-11 06:24:58', '2020-12-11 06:24:58', '2020-10-21', 'AE-072', 'Brenda', 'Margarita', 'Mendoza', NULL, 'Cañas', 'Brenda Margarita Mendoza de Cañas', 'fotoempleado/pcWWZFabFoSnMvtAPtO5R6irC2lzN8fuPh78wKyW.jpeg', NULL, NULL, NULL, NULL, NULL, 2, 1, 110, 1, 'eyJpdiI6ImVibVBCWE83'),
(73, '2020-12-11 06:25:36', '2020-12-11 06:25:36', '2020-10-26', 'AE-073', 'Carlos', 'Alexander', 'Miranda', 'Oliva', NULL, 'Carlos Alexander Miranda Oliva', 'fotoempleado/XsrCc6bMuwJjxNExPvfsbR8HRNuvgr6UvpipFG6M.jpeg', NULL, NULL, NULL, NULL, NULL, 1, 1, 110, 1, 'eyJpdiI6Ino4ajZxVkR1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleado_documentos`
--

CREATE TABLE `empleado_documentos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `idempleado` int(11) NOT NULL,
  `idtipodocumento` int(11) NOT NULL,
  `numerodocumento` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fechaexpedicion` date DEFAULT NULL,
  `fechavencimiento` date DEFAULT NULL,
  `foto` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `empleado_documentos`
--

INSERT INTO `empleado_documentos` (`id`, `created_at`, `updated_at`, `idempleado`, `idtipodocumento`, `numerodocumento`, `fechaexpedicion`, `fechavencimiento`, `foto`) VALUES
(1, '2021-01-06 05:36:04', '2021-01-06 05:36:04', 3, 1, '06142045-8', NULL, NULL, NULL),
(2, '2021-01-06 05:37:35', '2021-01-06 05:37:35', 3, 1, '1', NULL, NULL, NULL),
(3, '2021-01-06 20:17:49', '2021-01-06 20:17:49', 4, 1, '1234574-5', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleado_documentos_fotos`
--

CREATE TABLE `empleado_documentos_fotos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `idempleadodocumento` int(11) NOT NULL,
  `foto` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `empleado_documentos_fotos`
--

INSERT INTO `empleado_documentos_fotos` (`id`, `created_at`, `updated_at`, `idempleadodocumento`, `foto`) VALUES
(1, '2021-01-06 05:36:36', '2021-01-06 05:36:36', 1, '1609889796.png');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleado_empresas`
--

CREATE TABLE `empleado_empresas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `idempleado` int(11) NOT NULL,
  `idcargo` int(11) NOT NULL,
  `idubicacion` int(11) NOT NULL,
  `idgrupohorario` int(11) NOT NULL,
  `salario` int(11) DEFAULT NULL,
  `horasextras` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleado_referencias`
--

CREATE TABLE `empleado_referencias` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `tipo` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nombre` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contacto` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `idempleado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleado_users`
--

CREATE TABLE `empleado_users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `idusuario` int(11) NOT NULL,
  `idempleado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `empleado_users`
--

INSERT INTO `empleado_users` (`id`, `created_at`, `updated_at`, `idusuario`, `idempleado`) VALUES
(1, '2021-01-06 20:17:14', '2021-01-07 23:25:47', 2, 4),
(2, '2021-01-07 23:25:58', '2021-01-07 23:25:58', 1, 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `equiposfotos`
--

CREATE TABLE `equiposfotos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `idequipohistorial` int(11) NOT NULL,
  `imagen` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `equiposhistorials`
--

CREATE TABLE `equiposhistorials` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `instante` timestamp NULL DEFAULT NULL,
  `idequipotrabajo` int(11) NOT NULL,
  `idempleado` int(11) NOT NULL,
  `kilometraje` int(11) DEFAULT NULL,
  `combustible` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `extinguidor` tinyint(1) DEFAULT NULL,
  `botiquin` tinyint(1) DEFAULT NULL,
  `equiposeguridad` tinyint(1) DEFAULT NULL,
  `observaciones` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `idusuario` int(11) NOT NULL,
  `latitud` double NOT NULL,
  `longitud` double NOT NULL,
  `uso` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `equiposhistorials`
--

INSERT INTO `equiposhistorials` (`id`, `created_at`, `updated_at`, `instante`, `idequipotrabajo`, `idempleado`, `kilometraje`, `combustible`, `extinguidor`, `botiquin`, `equiposeguridad`, `observaciones`, `idusuario`, `latitud`, `longitud`, `uso`) VALUES
(1, '2021-01-07 15:59:25', '2021-01-07 15:59:25', '2021-01-07 15:59:25', 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, 1, 13.6698395, -89.2941542, NULL),
(2, '2021-01-07 16:01:28', '2021-01-07 16:01:28', '2021-01-07 16:01:28', 2, 3, NULL, NULL, NULL, NULL, NULL, NULL, 1, 13.6698395, -89.2941542, NULL),
(8, '2021-01-11 16:11:25', '2021-01-11 22:11:39', '2021-01-11 16:11:25', 3, 62, 4578689, '1/4', 1, 1, 1, 'Prueba', 1, 13.6698658, -89.29412909999999, 'Oficina');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `equipostrabajos`
--

CREATE TABLE `equipostrabajos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `codigo` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `placa` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `marca` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `modelo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `año` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `descripcion` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `equipostrabajos`
--

INSERT INTO `equipostrabajos` (`id`, `created_at`, `updated_at`, `codigo`, `placa`, `marca`, `modelo`, `año`, `descripcion`) VALUES
(1, '2021-01-06 04:40:37', '2021-01-06 04:40:37', 'EQ-01', 'P-12345', 'Honda', 'Doble Cabina', '2021', 'Vehiculo de gerencia'),
(2, '2021-01-07 20:56:19', '2021-01-07 20:56:19', 'EQ-02', 'P-80020', 'Panel', 'Blanco', '2020', 'KIa'),
(3, '2021-01-07 20:56:33', '2021-01-07 20:56:33', 'EQ-03', 'P-123456', 'Honda', 'Gris', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `equipo_mantenimientos`
--

CREATE TABLE `equipo_mantenimientos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `idequipo` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `kilometraje` int(11) NOT NULL,
  `pkMantenimiento` int(11) NOT NULL,
  `pfMantenimiento` date NOT NULL,
  `descripcion` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `monto` double NOT NULL,
  `tipomantenimiento` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estadocivils`
--

CREATE TABLE `estadocivils` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `estadocivil` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `estadocivils`
--

INSERT INTO `estadocivils` (`id`, `created_at`, `updated_at`, `estadocivil`) VALUES
(1, NULL, NULL, 'Soltero/a');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `formuas`
--

CREATE TABLE `formuas` (
  `id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `fecha` date NOT NULL,
  `nombrecompleto` varchar(100) NOT NULL,
  `dui` varchar(20) DEFAULT NULL,
  `idgenero` int(11) DEFAULT NULL,
  `empresa` varchar(50) DEFAULT NULL,
  `otraempresa` varchar(50) DEFAULT NULL,
  `proyecto` varchar(80) DEFAULT NULL,
  `temperatura` float DEFAULT NULL,
  `comentarios` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `formuas`
--

INSERT INTO `formuas` (`id`, `created_at`, `updated_at`, `fecha`, `nombrecompleto`, `dui`, `idgenero`, `empresa`, `otraempresa`, `proyecto`, `temperatura`, `comentarios`) VALUES
(29, '2021-01-07 03:40:29', '2021-01-07 03:40:29', '2021-01-06', 'Denis Iván Herrera', '06142045-8', NULL, 'Advanced Energy', NULL, 'Administración', 35.2, NULL),
(30, '2021-01-07 20:29:18', '2021-01-07 20:29:18', '2021-01-07', 'Denis Iván Herrera', '06142045-8', NULL, 'Advanced Energy', NULL, 'Administración', 35.2, NULL),
(31, '2021-01-07 20:34:15', '2021-01-07 20:34:15', '2021-01-07', 'Denis Iván Herrera', '06142045-8', NULL, 'Advanced Energy', NULL, 'Administración', NULL, NULL),
(32, '2021-01-07 20:40:45', '2021-01-07 20:40:45', '2021-01-07', 'Denis Iván Herrera', '06142045-8', NULL, 'Advanced Energy', NULL, 'Administración', NULL, NULL),
(33, '2021-01-07 20:46:18', '2021-01-07 20:46:18', '2021-01-07', 'Denis Iván Herrera', '06142045-8', NULL, 'Advanced Energy', NULL, 'Administración', 35.6, NULL),
(34, '2021-01-07 20:50:35', '2021-01-07 20:50:35', '2021-01-07', 'Denis Iván Herrera', '06142045-8', NULL, 'Advanced Energy', NULL, 'Administración', 35.5, NULL),
(35, '2021-01-07 20:51:20', '2021-01-07 20:51:20', '2021-01-07', 'Denis Iván Herrera', '06142045-8', NULL, 'Advanced Energy', NULL, 'Administración', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `formubs`
--

CREATE TABLE `formubs` (
  `id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `idformua` int(11) NOT NULL,
  `idformuc` int(11) NOT NULL,
  `si` char(2) DEFAULT NULL,
  `no` char(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `formubs`
--

INSERT INTO `formubs` (`id`, `created_at`, `updated_at`, `idformua`, `idformuc`, `si`, `no`) VALUES
(183, '2021-01-07 03:40:29', '2021-01-07 03:40:29', 29, 1, NULL, 'NO'),
(184, '2021-01-07 03:40:29', '2021-01-07 03:40:29', 29, 2, NULL, 'NO'),
(185, '2021-01-07 03:40:29', '2021-01-07 03:40:29', 29, 3, NULL, 'NO'),
(186, '2021-01-07 03:40:29', '2021-01-07 03:40:29', 29, 4, NULL, 'NO'),
(187, '2021-01-07 03:40:29', '2021-01-07 03:40:29', 29, 5, NULL, 'NO'),
(188, '2021-01-07 03:40:29', '2021-01-07 03:40:29', 29, 6, NULL, 'NO'),
(189, '2021-01-07 03:40:29', '2021-01-07 03:40:29', 29, 7, NULL, 'NO'),
(190, '2021-01-07 03:40:29', '2021-01-07 03:40:29', 29, 8, NULL, 'NO'),
(191, '2021-01-07 03:40:29', '2021-01-07 03:40:29', 29, 9, NULL, 'NO'),
(192, '2021-01-07 03:40:29', '2021-01-07 03:40:29', 29, 10, NULL, 'NO'),
(193, '2021-01-07 03:40:29', '2021-01-07 03:40:29', 29, 11, NULL, 'NO'),
(194, '2021-01-07 03:40:29', '2021-01-07 03:40:29', 29, 12, NULL, 'NO'),
(195, '2021-01-07 03:40:29', '2021-01-07 03:40:29', 29, 13, NULL, 'NO'),
(196, '2021-01-07 20:29:18', '2021-01-07 20:29:18', 30, 1, NULL, 'NO'),
(197, '2021-01-07 20:29:18', '2021-01-07 20:29:18', 30, 2, NULL, 'NO'),
(198, '2021-01-07 20:29:18', '2021-01-07 20:29:18', 30, 3, NULL, 'NO'),
(199, '2021-01-07 20:29:18', '2021-01-07 20:29:18', 30, 4, NULL, 'NO'),
(200, '2021-01-07 20:29:18', '2021-01-07 20:29:18', 30, 5, NULL, 'NO'),
(201, '2021-01-07 20:29:18', '2021-01-07 20:29:18', 30, 6, NULL, 'NO'),
(202, '2021-01-07 20:29:18', '2021-01-07 20:29:18', 30, 7, NULL, 'NO'),
(203, '2021-01-07 20:29:18', '2021-01-07 20:29:18', 30, 8, NULL, 'NO'),
(204, '2021-01-07 20:29:18', '2021-01-07 20:29:18', 30, 9, NULL, 'NO'),
(205, '2021-01-07 20:29:18', '2021-01-07 20:29:18', 30, 10, NULL, 'NO'),
(206, '2021-01-07 20:29:18', '2021-01-07 20:29:18', 30, 11, NULL, 'NO'),
(207, '2021-01-07 20:29:18', '2021-01-07 20:29:18', 30, 12, NULL, 'NO'),
(208, '2021-01-07 20:29:18', '2021-01-07 20:29:18', 30, 13, NULL, 'NO'),
(209, '2021-01-07 20:34:15', '2021-01-07 20:34:15', 31, 1, NULL, 'NO'),
(210, '2021-01-07 20:34:15', '2021-01-07 20:34:15', 31, 2, NULL, 'NO'),
(211, '2021-01-07 20:34:15', '2021-01-07 20:34:15', 31, 3, NULL, 'NO'),
(212, '2021-01-07 20:34:15', '2021-01-07 20:34:15', 31, 4, NULL, 'NO'),
(213, '2021-01-07 20:34:15', '2021-01-07 20:34:15', 31, 5, NULL, 'NO'),
(214, '2021-01-07 20:34:15', '2021-01-07 20:34:15', 31, 6, NULL, 'NO'),
(215, '2021-01-07 20:34:15', '2021-01-07 20:34:15', 31, 7, NULL, 'NO'),
(216, '2021-01-07 20:34:15', '2021-01-07 20:34:15', 31, 8, NULL, 'NO'),
(217, '2021-01-07 20:34:15', '2021-01-07 20:34:15', 31, 9, NULL, 'NO'),
(218, '2021-01-07 20:34:15', '2021-01-07 20:34:15', 31, 10, NULL, 'NO'),
(219, '2021-01-07 20:34:15', '2021-01-07 20:34:15', 31, 11, NULL, 'NO'),
(220, '2021-01-07 20:34:15', '2021-01-07 20:34:15', 31, 12, NULL, 'NO'),
(221, '2021-01-07 20:34:15', '2021-01-07 20:34:15', 31, 13, NULL, 'NO'),
(222, '2021-01-07 20:40:45', '2021-01-07 20:40:45', 32, 1, NULL, 'NO'),
(223, '2021-01-07 20:40:45', '2021-01-07 20:40:45', 32, 2, NULL, 'NO'),
(224, '2021-01-07 20:40:45', '2021-01-07 20:40:45', 32, 3, NULL, 'NO'),
(225, '2021-01-07 20:40:45', '2021-01-07 20:40:45', 32, 4, NULL, 'NO'),
(226, '2021-01-07 20:40:45', '2021-01-07 20:40:45', 32, 5, NULL, 'NO'),
(227, '2021-01-07 20:40:45', '2021-01-07 20:40:45', 32, 6, NULL, 'NO'),
(228, '2021-01-07 20:40:45', '2021-01-07 20:40:45', 32, 7, NULL, 'NO'),
(229, '2021-01-07 20:40:45', '2021-01-07 20:40:45', 32, 8, NULL, 'NO'),
(230, '2021-01-07 20:40:45', '2021-01-07 20:40:45', 32, 9, NULL, 'NO'),
(231, '2021-01-07 20:40:45', '2021-01-07 20:40:45', 32, 10, NULL, 'NO'),
(232, '2021-01-07 20:40:45', '2021-01-07 20:40:45', 32, 11, NULL, 'NO'),
(233, '2021-01-07 20:40:45', '2021-01-07 20:40:45', 32, 12, NULL, 'NO'),
(234, '2021-01-07 20:40:45', '2021-01-07 20:40:45', 32, 13, NULL, 'NO'),
(235, '2021-01-07 20:46:18', '2021-01-07 20:46:18', 33, 1, NULL, 'NO'),
(236, '2021-01-07 20:46:18', '2021-01-07 20:46:18', 33, 2, NULL, 'NO'),
(237, '2021-01-07 20:46:18', '2021-01-07 20:46:18', 33, 3, NULL, 'NO'),
(238, '2021-01-07 20:46:18', '2021-01-07 20:46:18', 33, 4, NULL, 'NO'),
(239, '2021-01-07 20:46:18', '2021-01-07 20:46:18', 33, 5, NULL, 'NO'),
(240, '2021-01-07 20:46:18', '2021-01-07 20:46:18', 33, 6, NULL, 'NO'),
(241, '2021-01-07 20:46:18', '2021-01-07 20:46:18', 33, 7, NULL, 'NO'),
(242, '2021-01-07 20:46:18', '2021-01-07 20:46:18', 33, 8, NULL, 'NO'),
(243, '2021-01-07 20:46:18', '2021-01-07 20:46:18', 33, 9, NULL, 'NO'),
(244, '2021-01-07 20:46:18', '2021-01-07 20:46:18', 33, 10, NULL, 'NO'),
(245, '2021-01-07 20:46:18', '2021-01-07 20:46:18', 33, 11, NULL, 'NO'),
(246, '2021-01-07 20:46:18', '2021-01-07 20:46:18', 33, 12, NULL, 'NO'),
(247, '2021-01-07 20:46:18', '2021-01-07 20:46:18', 33, 13, NULL, 'NO'),
(248, '2021-01-07 20:50:35', '2021-01-07 20:50:35', 34, 1, NULL, 'NO'),
(249, '2021-01-07 20:50:35', '2021-01-07 20:50:35', 34, 2, NULL, 'NO'),
(250, '2021-01-07 20:50:35', '2021-01-07 20:50:35', 34, 3, NULL, 'NO'),
(251, '2021-01-07 20:50:35', '2021-01-07 20:50:35', 34, 4, NULL, 'NO'),
(252, '2021-01-07 20:50:35', '2021-01-07 20:50:35', 34, 5, NULL, 'NO'),
(253, '2021-01-07 20:50:35', '2021-01-07 20:50:35', 34, 6, NULL, 'NO'),
(254, '2021-01-07 20:50:35', '2021-01-07 20:50:35', 34, 7, NULL, 'NO'),
(255, '2021-01-07 20:50:35', '2021-01-07 20:50:35', 34, 8, NULL, 'NO'),
(256, '2021-01-07 20:50:35', '2021-01-07 20:50:35', 34, 9, NULL, 'NO'),
(257, '2021-01-07 20:50:35', '2021-01-07 20:50:35', 34, 10, NULL, 'NO'),
(258, '2021-01-07 20:50:35', '2021-01-07 20:50:35', 34, 11, NULL, 'NO'),
(259, '2021-01-07 20:50:35', '2021-01-07 20:50:35', 34, 12, NULL, 'NO'),
(260, '2021-01-07 20:50:35', '2021-01-07 20:50:35', 34, 13, NULL, 'NO'),
(261, '2021-01-07 20:51:20', '2021-01-07 20:51:20', 35, 1, NULL, 'NO'),
(262, '2021-01-07 20:51:20', '2021-01-07 20:51:20', 35, 2, NULL, 'NO'),
(263, '2021-01-07 20:51:20', '2021-01-07 20:51:20', 35, 3, NULL, 'NO'),
(264, '2021-01-07 20:51:20', '2021-01-07 20:51:20', 35, 4, 'SI', NULL),
(265, '2021-01-07 20:51:20', '2021-01-07 20:51:20', 35, 5, 'SI', NULL),
(266, '2021-01-07 20:51:20', '2021-01-07 20:51:20', 35, 6, 'SI', NULL),
(267, '2021-01-07 20:51:20', '2021-01-07 20:51:20', 35, 7, NULL, 'NO'),
(268, '2021-01-07 20:51:20', '2021-01-07 20:51:20', 35, 8, NULL, 'NO'),
(269, '2021-01-07 20:51:20', '2021-01-07 20:51:20', 35, 9, NULL, 'NO'),
(270, '2021-01-07 20:51:20', '2021-01-07 20:51:20', 35, 10, NULL, 'NO'),
(271, '2021-01-07 20:51:20', '2021-01-07 20:51:20', 35, 11, NULL, 'NO'),
(272, '2021-01-07 20:51:20', '2021-01-07 20:51:20', 35, 12, NULL, 'NO'),
(273, '2021-01-07 20:51:20', '2021-01-07 20:51:20', 35, 13, NULL, 'NO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `formucs`
--

CREATE TABLE `formucs` (
  `id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `sintoma` varchar(200) NOT NULL,
  `puntos` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `formucs`
--

INSERT INTO `formucs` (`id`, `created_at`, `updated_at`, `sintoma`, `puntos`) VALUES
(1, NULL, NULL, 'Tos', 1),
(2, NULL, NULL, 'Escalofrios', 1),
(3, NULL, NULL, 'Diarrea', 1),
(4, NULL, NULL, 'Dolor de garganta', 1),
(5, NULL, NULL, 'Dolor de cuerpo / Malestar general', 1),
(6, NULL, NULL, 'Dolor de cabeza', 1),
(7, NULL, NULL, 'Fiebre mayor a 37.8 grados C', 1),
(8, NULL, NULL, 'Perdida de Olfato y/o Gusto', 1),
(9, NULL, NULL, 'Dolor en la nariz al respirar', 1),
(10, NULL, NULL, 'Dificultad para respirar (Como si no entrara aire al pecho)', 1),
(11, NULL, NULL, 'Siente fatiga con solo caminar o hablar', 1),
(12, NULL, NULL, 'Has viajado o estado en un área o zona afectada por COVID 19 en los últimos 8 dias', 1),
(13, NULL, NULL, 'Has estado en contacto directo o cuidado a algún paciente que ha dado positivo COVID 19 en los ultimos 8 dias', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `generos`
--

CREATE TABLE `generos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `genero` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `generos`
--

INSERT INTO `generos` (`id`, `created_at`, `updated_at`, `genero`) VALUES
(1, NULL, NULL, 'Masculino'),
(2, NULL, NULL, 'Femenino');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grupohorarios`
--

CREATE TABLE `grupohorarios` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `nombre` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grupohorariosds`
--

CREATE TABLE `grupohorariosds` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `idgrupohorario` int(11) NOT NULL,
  `iddia` int(11) NOT NULL,
  `horainicio` time NOT NULL,
  `horafin` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `marcacionesempleados`
--

CREATE TABLE `marcacionesempleados` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `idempleado` int(11) NOT NULL,
  `idusuario` int(11) NOT NULL,
  `tipo` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fecha` date DEFAULT NULL,
  `instante` time DEFAULT NULL,
  `observaciones` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `idubicacion` int(11) NOT NULL,
  `latitud` double NOT NULL,
  `longitud` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `marcacionesempleados`
--

INSERT INTO `marcacionesempleados` (`id`, `created_at`, `updated_at`, `idempleado`, `idusuario`, `tipo`, `fecha`, `instante`, `observaciones`, `idubicacion`, `latitud`, `longitud`) VALUES
(30, '2021-01-05 22:29:07', '2021-01-05 22:29:07', 3, 1, 'Salida', '2021-01-05', '16:29:07', NULL, 1, 13.670018899999999, -89.29421169999999),
(31, '2021-01-05 22:29:15', '2021-01-05 22:29:15', 3, 1, 'Entrada', '2021-01-05', '16:29:15', NULL, 1, 13.670018899999999, -89.29421169999999),
(32, '2021-01-05 22:29:17', '2021-01-05 22:29:17', 3, 1, 'Salida', '2021-01-05', '16:29:17', NULL, 1, 13.670018899999999, -89.29421169999999),
(33, '2021-01-05 22:29:20', '2021-01-05 22:29:20', 3, 1, 'Entrada', '2021-01-05', '16:29:20', NULL, 1, 13.670018899999999, -89.29421169999999),
(34, '2021-01-05 22:29:22', '2021-01-05 22:29:22', 3, 1, 'Salida', '2021-01-05', '16:29:22', NULL, 1, 13.670018899999999, -89.29421169999999),
(35, '2021-01-05 22:29:24', '2021-01-05 22:29:24', 3, 1, 'Entrada', '2021-01-05', '16:29:24', NULL, 1, 13.670018899999999, -89.29421169999999),
(36, '2021-01-05 22:29:26', '2021-01-05 22:29:26', 3, 1, 'invalido', '2021-01-05', '16:29:26', NULL, 1, 13.670018899999999, -89.29421169999999),
(37, '2021-01-06 14:22:54', '2021-01-06 14:22:54', 3, 1, 'Entrada', '2021-01-06', '08:22:54', NULL, 1, 13.6717333, -89.29269099999999),
(38, '2021-01-06 14:23:09', '2021-01-06 14:23:09', 3, 1, 'Salida', '2021-01-06', '08:23:09', NULL, 1, 13.6717333, -89.29269099999999),
(39, '2021-01-06 14:23:12', '2021-01-06 14:23:12', 3, 1, 'Entrada', '2021-01-06', '08:23:12', NULL, 1, 13.6717333, -89.29269099999999),
(40, '2021-01-06 16:16:00', '2021-01-06 16:16:00', 3, 1, 'Salida', '2021-01-06', '10:16:00', NULL, 1, 13.6717333, -89.29269099999999),
(41, '2021-01-06 16:16:03', '2021-01-06 16:16:03', 3, 1, 'Entrada', '2021-01-06', '10:16:03', NULL, 1, 13.6717333, -89.29269099999999),
(42, '2021-01-06 16:18:27', '2021-01-06 16:18:27', 3, 1, 'Salida', '2021-01-06', '10:18:27', NULL, 1, 13.6717333, -89.29269099999999),
(43, '2021-01-07 14:30:19', '2021-01-07 14:30:19', 3, 1, 'Entrada', '2021-01-07', '08:30:19', NULL, 1, 13.6698367, -89.2941534),
(44, '2021-01-07 14:35:32', '2021-01-07 14:35:32', 3, 1, 'Salida', '2021-01-07', '08:35:32', NULL, 1, 13.6698367, -89.2941534),
(45, '2021-01-07 14:36:38', '2021-01-07 14:36:38', 3, 1, 'Entrada', '2021-01-07', '08:36:38', NULL, 1, 13.6698367, -89.2941534),
(46, '2021-01-07 14:36:40', '2021-01-07 14:36:40', 3, 1, 'Salida', '2021-01-07', '08:36:40', NULL, 1, 13.6698367, -89.2941534),
(47, '2021-01-07 14:36:43', '2021-01-07 14:36:43', 3, 1, 'Entrada', '2021-01-07', '08:36:43', NULL, 1, 13.6698367, -89.2941534),
(48, '2021-01-07 15:27:29', '2021-01-07 15:27:29', 4, 1, 'Entrada', '2021-01-07', '09:27:29', NULL, 1, 13.670018899999999, -89.29421169999999),
(49, '2021-01-07 15:27:44', '2021-01-07 15:27:44', 4, 1, 'Salida', '2021-01-07', '09:27:44', NULL, 1, 13.670018899999999, -89.29421169999999),
(50, '2021-01-07 15:28:27', '2021-01-07 15:28:27', 4, 1, 'Entrada', '2021-01-07', '09:28:27', NULL, 1, 13.670018899999999, -89.29421169999999),
(51, '2021-01-07 15:47:37', '2021-01-07 15:47:37', 4, 1, 'Salida', '2021-01-07', '09:47:37', NULL, 1, 13.670018899999999, -89.29421169999999),
(52, '2021-01-07 15:55:28', '2021-01-07 15:55:28', 4, 1, 'Entrada', '2021-01-07', '09:55:28', NULL, 1, 13.6698395, -89.2941542),
(53, '2021-01-07 16:40:56', '2021-01-07 16:40:56', 4, 1, 'Salida', '2021-01-07', '10:40:56', NULL, 1, 13.670018899999999, -89.29421169999999),
(54, '2021-01-07 16:42:05', '2021-01-07 16:42:05', 1, 3, 'Entrada', '2021-01-07', '10:42:05', NULL, 1, 13.6698391, -89.2941576),
(55, '2021-01-07 17:26:17', '2021-01-07 17:26:17', 5, 1, 'Entrada', '2021-01-07', '11:26:17', NULL, 1, 13.670018899999999, -89.29421169999999),
(56, '2021-01-07 17:43:20', '2021-01-07 17:43:20', 5, 1, 'Salida', '2021-01-07', '11:43:20', NULL, 1, 13.669816299999999, -89.2939152),
(57, '2021-01-07 17:55:48', '2021-01-07 17:55:48', 5, 1, 'Entrada', '2021-01-07', '11:55:48', NULL, 1, 13.670018899999999, -89.29421169999999),
(58, '2021-01-07 18:23:27', '2021-01-07 18:23:27', 5, 1, 'Salida', '2021-01-07', '12:23:27', NULL, 1, 13.6698423, -89.2939699),
(59, '2021-01-08 18:08:04', '2021-01-08 18:08:04', 5, 1, 'Salida', '2021-01-08', '12:08:04', NULL, 1, 13.6698749, -89.29412169999999),
(60, '2021-01-08 18:08:12', '2021-01-08 18:08:12', 5, 1, 'Entrada', '2021-01-08', '12:08:12', NULL, 1, 13.6698749, -89.29412169999999),
(61, '2021-01-08 18:08:19', '2021-01-08 18:08:19', 5, 1, 'Salida', '2021-01-08', '12:08:19', NULL, 1, 13.6698749, -89.29412169999999),
(62, '2021-01-11 15:28:52', '2021-01-11 15:28:52', 5, 1, 'Entrada', '2021-01-11', '09:28:52', NULL, 1, 13.670018899999999, -89.29421169999999),
(63, '2021-01-11 15:37:10', '2021-01-11 15:37:10', 5, 1, 'Salida', '2021-01-11', '09:37:10', NULL, 1, 13.670018899999999, -89.29421169999999);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2020_10_27_152110_create_empleados_table', 1),
(5, '2020_10_27_152523_create_cargos_table', 1),
(6, '2020_10_27_153754_create_autorizacionusuarios_table', 1),
(7, '2020_10_27_153817_create_permisos_table', 1),
(8, '2020_10_27_153851_create_marcacionesempleados_table', 1),
(9, '2020_10_27_153905_create_equiposhistorials_table', 1),
(10, '2020_10_27_154018_create_grupohorarios_table', 1),
(11, '2020_10_27_154054_create_equipostrabajos_table', 1),
(12, '2020_10_27_154106_create_equiposfotos_table', 1),
(13, '2020_10_27_160014_create_ubicacions_table', 1),
(14, '2020_10_28_135203_create_sessions_table', 1),
(15, '2020_11_06_195359_create_dias_table', 1),
(16, '2020_11_06_195417_create_grupohorariosds_table', 1),
(17, '2020_11_06_220014_create_departamentos_table', 1),
(18, '2020_11_11_040837_create_modulos_table', 1),
(19, '2020_11_11_042215_create_svdepartamentos_table', 1),
(20, '2020_11_11_042234_create_svmunicipios_table', 1),
(21, '2020_11_11_042437_create_tipodocumentos_table', 1),
(22, '2020_11_11_042500_create_empleado_documentos_table', 1),
(23, '2020_11_11_152250_create_estadocivils_table', 1),
(24, '2020_11_11_152307_create_generos_table', 1),
(25, '2020_11_13_170031_create_empleado_users_table', 1),
(26, '2020_11_13_170137_create_empleado_empresas_table', 1),
(27, '2020_11_13_170653_create_empleado_referencias_table', 1),
(28, '2020_11_26_160626_create_pais_table', 1),
(29, '2020_11_26_160941_create_dias_feriados_table', 1),
(30, '2020_11_26_215240_create_empleado_documentos_fotos_table', 1),
(31, '2020_12_18_182744_create_equipo_mantenimientos_table', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `modulos`
--

CREATE TABLE `modulos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `modulo` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ruta` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `icono` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nivel` int(11) DEFAULT NULL,
  `dependencia` int(11) DEFAULT NULL,
  `orden` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `modulos`
--

INSERT INTO `modulos` (`id`, `created_at`, `updated_at`, `modulo`, `ruta`, `icono`, `nivel`, `dependencia`, `orden`) VALUES
(1, NULL, NULL, 'General', 'general', '<i class=\"fas fa-qrcode fa-3x\"></i>', NULL, NULL, NULL),
(2, NULL, NULL, 'RRHH', 'rrhh', '<i class=\"fas fa-users fa-3x\"></i>', NULL, NULL, NULL),
(3, NULL, NULL, 'Ingenieria', 'ingenieria.index', '<i class=\"fab fa-wpforms fa-3x\"></i>', NULL, NULL, NULL),
(4, NULL, NULL, 'Reportes', 'reportes', '<i class=\"fas fa-file-signature fa-3x\"></i>', NULL, NULL, NULL),
(5, '2021-01-06 03:36:19', '2021-01-06 03:39:01', 'Inicio', 'inicio', '<i class=\"fas fa-home\"></i>', 1, 0, 1),
(6, '2021-01-06 03:36:35', '2021-01-06 03:39:44', 'Gestión', NULL, '<i class=\"fas fa-user-cog\"></i>', 1, 0, 2),
(7, '2021-01-06 03:37:03', '2021-01-06 03:40:22', 'General', NULL, '<i class=\"far fa-window-maximize\"></i>', 1, 0, 3),
(8, '2021-01-06 03:37:12', '2021-01-06 03:45:11', 'Finanzas', NULL, '<i class=\"fas fa-dollar-sign\"></i>', 1, 0, 4),
(9, '2021-01-06 03:37:26', '2021-01-06 03:45:39', 'Bodega e Inventario', NULL, '<i class=\"fas fa-dolly-flatbed\"></i>', 1, 0, 5),
(10, '2021-01-06 03:37:37', '2021-01-06 03:45:56', 'Ingenieria', NULL, '<i class=\"far fa-window-maximize\"></i>', 1, 0, 6),
(11, '2021-01-06 03:37:47', '2021-01-06 03:46:06', 'Proyectos y supervisión', NULL, '<i class=\"far fa-window-maximize\"></i>', 1, 0, 7),
(12, '2021-01-06 03:37:57', '2021-01-06 03:46:11', 'Operación y mantenimiento', NULL, '<i class=\"far fa-window-maximize\"></i>', 1, 0, 8),
(13, '2021-01-06 03:38:04', '2021-01-06 03:46:21', 'Obra civil', NULL, '<i class=\"far fa-window-maximize\"></i>', 1, 0, 9),
(14, '2021-01-06 03:38:20', '2021-01-06 03:46:37', 'Recursos humanos', NULL, '<i class=\"fas fa-users\"></i>', 1, 0, 10),
(15, '2021-01-06 03:38:38', '2021-01-06 03:46:59', 'Informes', NULL, '<i class=\"far fa-file-alt\"></i>', 1, 0, 11),
(16, '2021-01-06 03:47:26', '2021-01-06 03:47:26', 'Inicio', NULL, NULL, 2, 6, 1),
(17, '2021-01-06 03:47:52', '2021-01-06 03:47:52', 'Estructura de menú', 'modulos.index', NULL, 3, 16, 1),
(19, '2021-01-06 03:49:20', '2021-01-06 03:49:20', 'Autorizaciones', NULL, NULL, 3, 16, 2),
(20, '2021-01-06 03:49:41', '2021-01-06 03:49:41', 'Por usuario', 'autorizacion.usuario', NULL, 4, 19, 1),
(21, '2021-01-06 03:49:53', '2021-01-06 03:49:53', 'Por grupo', 'autorizacion.grupo', NULL, 4, 19, 2),
(22, '2021-01-06 03:50:36', '2021-01-06 03:50:36', 'General', NULL, NULL, 2, 6, 2),
(23, '2021-01-06 03:51:01', '2021-01-06 03:51:01', 'Usuarios', 'usuarios.index', NULL, 3, 22, 1),
(24, '2021-01-06 03:51:35', '2021-01-06 03:51:35', 'Grupos', NULL, NULL, 3, 22, 2),
(25, '2021-01-06 03:53:18', '2021-01-06 03:53:18', 'Gestión vehiculos', NULL, NULL, 2, 7, 1),
(26, '2021-01-06 03:53:29', '2021-01-06 03:53:29', 'Calendario', NULL, NULL, 2, 7, 2),
(27, '2021-01-06 03:53:36', '2021-01-06 03:53:36', 'Correo', NULL, NULL, 2, 7, 3),
(28, '2021-01-06 03:53:48', '2021-01-07 21:10:11', 'Aplicación', 'load.aplicacion', NULL, 2, 7, 4),
(29, '2021-01-06 03:54:04', '2021-01-06 09:52:44', 'Vehiculos', 'equipos.index', NULL, 3, 25, 1),
(30, '2021-01-06 03:55:47', '2021-01-06 03:55:47', 'Mantenimientos', NULL, NULL, 3, 25, 2),
(31, '2021-01-06 03:55:59', '2021-01-06 03:55:59', 'Control de vehiculos', NULL, NULL, 3, 25, 3),
(32, '2021-01-06 03:56:37', '2021-01-06 03:56:37', 'Asistencia', NULL, NULL, 2, 14, 1),
(33, '2021-01-06 03:56:49', '2021-01-06 03:56:49', 'Empleados', 'empleados.index', NULL, 2, 14, 2),
(34, '2021-01-06 03:57:21', '2021-01-06 03:57:21', 'Vacaciones', NULL, NULL, 2, 14, 3),
(35, '2021-01-06 03:57:27', '2021-01-06 03:57:27', 'Permisos', NULL, NULL, 2, 14, 4),
(36, '2021-01-06 03:57:43', '2021-01-06 03:57:43', 'Formularios', NULL, NULL, 2, 14, 5),
(37, '2021-01-06 03:57:52', '2021-01-06 10:59:50', 'Covid-19', 'formulario.covid', NULL, 3, 36, 1),
(38, '2021-01-06 03:58:59', '2021-01-06 03:58:59', 'Ubicación', NULL, NULL, 2, 6, 3),
(39, '2021-01-06 03:59:08', '2021-01-06 03:59:08', 'Empleado', NULL, NULL, 2, 6, 4),
(40, '2021-01-06 03:59:14', '2021-01-06 03:59:14', 'Empresa', NULL, NULL, 2, 6, 5),
(41, '2021-01-06 03:59:28', '2021-01-06 03:59:28', 'Recursos humanos', NULL, NULL, 2, 6, 6),
(42, '2021-01-06 03:59:42', '2021-01-06 03:59:42', 'Herramientas', NULL, NULL, 2, 6, 7),
(43, '2021-01-06 03:59:50', '2021-01-06 03:59:50', 'Formularios', NULL, NULL, 3, 42, 1),
(44, '2021-01-06 04:00:32', '2021-01-06 04:00:32', 'Departamentos', 'departamento.index', NULL, 3, 40, 1),
(45, '2021-01-06 04:01:25', '2021-01-06 04:01:25', 'Cargos', 'cargos.index', NULL, 3, 40, 2),
(46, '2021-01-06 04:01:43', '2021-01-06 04:01:43', 'Proyectos', 'ubicacion.index', NULL, 3, 40, 3),
(47, '2021-01-06 08:59:53', '2021-01-06 08:59:53', 'Paises', 'pais.index', NULL, 3, 38, 1),
(48, '2021-01-06 09:00:14', '2021-01-06 09:00:14', 'Departamentos', 'svdepartamento.index', NULL, 3, 38, 2),
(49, '2021-01-06 09:03:35', '2021-01-06 09:03:35', 'Municipios', 'svmunicipio.index', NULL, 3, 38, 3),
(50, '2021-01-06 09:04:20', '2021-01-06 09:04:20', 'Tipo documento', 'tipodocumento.index', NULL, 3, 39, 1),
(51, '2021-01-06 09:04:32', '2021-01-06 09:04:32', 'Estado civil', 'estadocivil.index', NULL, 3, 39, 2),
(52, '2021-01-06 09:04:49', '2021-01-06 09:04:49', 'Genero', 'genero.index', NULL, 3, 39, 3),
(53, '2021-01-06 09:05:39', '2021-01-06 09:05:39', 'Dias laborales', 'dias.index', NULL, 3, 41, 1),
(54, '2021-01-06 09:06:00', '2021-01-06 09:06:00', 'Dias feriados', 'diasFeriados.index', NULL, 3, 41, 2),
(55, '2021-01-06 09:06:38', '2021-01-06 09:06:38', 'Horarios laborales', 'grupohorario.index', NULL, 3, 41, 3),
(56, '2021-01-06 09:08:47', '2021-01-06 09:08:47', 'General', NULL, NULL, 2, 15, 1),
(57, '2021-01-06 09:09:19', '2021-01-06 09:09:19', 'Gestión vehiculos', NULL, NULL, 3, 56, 1),
(58, '2021-01-06 09:09:33', '2021-01-06 09:09:33', 'Control vehiculos', NULL, NULL, 4, 57, 1),
(59, '2021-01-06 09:09:52', '2021-01-06 09:09:52', 'Recursos humanos', NULL, NULL, 2, 15, 2),
(60, '2021-01-06 09:10:08', '2021-01-06 09:10:08', 'Asistencia', NULL, NULL, 3, 59, 1),
(61, '2021-01-06 11:26:05', '2021-01-06 11:26:05', 'Productos', NULL, NULL, 2, 9, 1),
(62, '2021-01-06 11:26:16', '2021-01-06 11:26:16', 'Entradas/Salidas', NULL, NULL, 2, 9, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pais`
--

CREATE TABLE `pais` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `pais` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `pais`
--

INSERT INTO `pais` (`id`, `created_at`, `updated_at`, `pais`) VALUES
(1, NULL, NULL, 'El Salvador');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permisos`
--

CREATE TABLE `permisos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `nombre` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ruta` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `idmodulo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payload` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int(11) NOT NULL,
  `name` bigint(20) UNSIGNED DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `foto` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `idrol` text COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`, `name`, `email`, `foto`, `idrol`) VALUES
('1qnP1jbmF9DBgXc7TuVLkoKlGzbjArUZWVLUFCGr', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/87.0.4280.88 Safari/537.36', 'YToxMDp7czo2OiJfdG9rZW4iO3M6NDA6Img0SzB1WEJFWEtZUFo3VTJDSk5ibHd0OW1wa3RjbXEwSEozTkowc2giO3M6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjQwOiJodHRwOi8vbG9jYWxob3N0L3ZlcnNpb24vdXN1YXJpb3MvY3JlYXRlIjt9czo3OiJ1c2VyX2lkIjtpOjE7czo0OiJuYW1lIjtzOjEwOiJTdXBlcnZpc29yIjtzOjU6ImVtYWlsIjtzOjIwOiJzdXBlcnZpc29yQGdtYWlsLmNvbSI7czo0OiJmb3RvIjtzOjQwOiJzdG9yYWdlL2FwcC9mb3RvcGVyZmlsL3BlcmZpbERlZmF1bHQuanBnIjtzOjU6Imlkcm9sIjtpOjE7czo2OiJidXNjYXIiO2I6MTtzOjc6Im1lbnVfaWQiO3M6MjoiMjMiO30=', 1609888468, NULL, NULL, NULL, NULL),
('CHEFbi24hcI4XdjSdyepZitU5zW5D0PHAz4T4QWi', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/87.0.4280.88 Safari/537.36', 'YToxMDp7czo2OiJfdG9rZW4iO3M6NDA6IktZVFk4U2JWVEpzMlRiN05ibjJVcHlqRE5wT08zTHZuYVgzblExUGgiO3M6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjM0OiJodHRwOi8vbG9jYWxob3N0L3ZlcnNpb24vZXF1aXBvcy8xIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo3OiJ1c2VyX2lkIjtpOjE7czo0OiJuYW1lIjtzOjEwOiJTdXBlcnZpc29yIjtzOjU6ImVtYWlsIjtzOjIwOiJzdXBlcnZpc29yQGdtYWlsLmNvbSI7czo0OiJmb3RvIjtzOjQwOiJzdG9yYWdlL2FwcC9mb3RvcGVyZmlsL3BlcmZpbERlZmF1bHQuanBnIjtzOjU6Imlkcm9sIjtpOjE7czo2OiJidXNjYXIiO2I6MTtzOjc6Im1lbnVfaWQiO3M6MjoiMjkiO30=', 1609886440, NULL, NULL, NULL, NULL),
('CYrmConRz1ck56XQxTJODO6KPJPqfnz1FN3n0jP7', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/87.0.4280.88 Safari/537.36', 'YToxMDp7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDE6Imh0dHA6Ly9sb2NhbGhvc3QvQWR2YW5jZWRFbmVyZ3kvZXF1aXBvcy8zIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo2OiJfdG9rZW4iO3M6NDA6Ik5pNHNscFN4aExORWhTd0JvSGMyWHc4OXVPb1RaTVk2b0NHMkw0c1giO3M6NzoidXNlcl9pZCI7aToxO3M6NDoibmFtZSI7czoxMDoiU3VwZXJ2aXNvciI7czo1OiJlbWFpbCI7czoyMDoic3VwZXJ2aXNvckBnbWFpbC5jb20iO3M6NDoiZm90byI7czo2Nzoic3RvcmFnZS9hcHAvZm90b3BlcmZpbC9VUzRwOXJJbjBRV2lMNTlyUElHQjN3eFlwS0ZhdVJteTZSeFNueEJaLnBuZyI7czo1OiJpZHJvbCI7aToxO3M6NzoibWVudV9pZCI7czoyOiIyOSI7czo2OiJidXNjYXIiO2I6MTt9', 1610129885, NULL, NULL, NULL, NULL),
('E3o4SzyTP9IRJcXgP8q5NAf1eBQ4xgBEMDfYjHog', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/87.0.4280.88 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiMXc3cDZHWGUwUXlnaVNqR0Nsek1PWG4wek9tdlpFc2tNbnBzUkRqMSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDE6Imh0dHA6Ly9sb2NhbGhvc3QvdmVyc2lvbi9hcGkvZm9ybS9jb3ZpZC8zIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1609889696, NULL, NULL, NULL, NULL),
('EGgARUBCaHB1vOyNujWOPPpcGSvnlaNotliDk8nG', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/87.0.4280.88 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiY2NjYWpSSmloRFBiNmdjVmFZVGh2bmEyWXN0b1BuSU1waEJNNmdLcyI7czoxMjoiY29kaWdvQ2FybmV0IjtzOjY6IkFFLTAwMyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1609886450, NULL, NULL, NULL, NULL),
('EoCUAXAA3EXcTkv0ZuSDYq3AyHlUPyWIpUiKUx4d', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/87.0.4280.88 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiaHNkVGpheU1ubjRaT3ZWQWZKelhCSTBSTTdOZGhYcm1VcThDRUdBVCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjQ6Imh0dHA6Ly9sb2NhbGhvc3QvdmVyc2lvbiI7fX0=', 1609889239, NULL, NULL, NULL, NULL),
('eWSX50UJs8Qb16k8moUY8uBALioR4AWMEPX3b2LR', NULL, '::1', 'Mozilla/5.0 (Linux; Android 6.0; Nexus 5 Build/MRA58N) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/87.0.4280.88 Mobile Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiZmxSRHJnUWVMcXhCSFBJNmtWQ1dwbGt4YVlKOTZmdUI3MGNha3o1MSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDE6Imh0dHA6Ly9sb2NhbGhvc3QvdmVyc2lvbi9hcGkvZm9ybS9jb3ZpZC8zIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1609890880, NULL, NULL, NULL, NULL),
('feeJJ52ufCGjw1yjpq9jeOdcdgJUIOLpayBglHHk', NULL, '192.168.2.164', 'Mozilla/5.0 (Linux; Android 10; SM-A217M) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.198 Mobile Safari/537.36', 'YToxMDp7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NTk6Imh0dHBzOi8vMTkyLjE2OC4yLjk4L0FkdmFuY2VkRW5lcmd5L2VxdWlwb3NoaXN0b3JpYWwvMS9lZGl0Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo2OiJfdG9rZW4iO3M6NDA6IjV5eHk5Yjdkc0dBNDJQQVRJYU5XZHdBVTg2VlZUWDd3UHBEMzI3eU4iO3M6NzoidXNlcl9pZCI7aToxO3M6NDoibmFtZSI7czoxMDoiU3VwZXJ2aXNvciI7czo1OiJlbWFpbCI7czoyMDoic3VwZXJ2aXNvckBnbWFpbC5jb20iO3M6NDoiZm90byI7czo2Nzoic3RvcmFnZS9hcHAvZm90b3BlcmZpbC9VUzRwOXJJbjBRV2lMNTlyUElHQjN3eFlwS0ZhdVJteTZSeFNueEJaLnBuZyI7czo1OiJpZHJvbCI7aToxO3M6NzoibWVudV9pZCI7czoyOiIyOCI7czo2OiJidXNjYXIiO2I6MTt9', 1610035168, NULL, NULL, NULL, NULL),
('fhtpuFIG95JEB3Uvq8Qauq4vqHZzQ3SGCIatH623', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/87.0.4280.88 Safari/537.36', 'YToxMDp7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzg6Imh0dHA6Ly9sb2NhbGhvc3QvQWR2YW5jZWRFbmVyZ3kvaW5pY2lvIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo2OiJfdG9rZW4iO3M6NDA6ImFLb0hsVVhHaVlyaUtxSzNNRnkwMTA3VFhmdFpuUVlzVzdNcGV6VFoiO3M6NzoidXNlcl9pZCI7aToxO3M6NDoibmFtZSI7czoxMDoiU3VwZXJ2aXNvciI7czo1OiJlbWFpbCI7czoyMDoic3VwZXJ2aXNvckBnbWFpbC5jb20iO3M6NDoiZm90byI7czo2Nzoic3RvcmFnZS9hcHAvZm90b3BlcmZpbC9VUzRwOXJJbjBRV2lMNTlyUElHQjN3eFlwS0ZhdVJteTZSeFNueEJaLnBuZyI7czo1OiJpZHJvbCI7aToxO3M6NzoibWVudV9pZCI7czoxOiI1IjtzOjY6ImJ1c2NhciI7YjoxO30=', 1610381782, NULL, NULL, NULL, NULL),
('FwhuGiMSDCOES5wfxuuLeyZU7u3KwnBKY1AXSZ2i', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/87.0.4280.88 Safari/537.36', 'YToxMDp7czo2OiJfdG9rZW4iO3M6NDA6IjZOWkF3d1NKWThaTWhZQkxmWXpFQmNFYkNmSjJUODk2T3V2dlFYanciO3M6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjMxOiJodHRwOi8vbG9jYWxob3N0L3ZlcnNpb24vaW5pY2lvIjt9czo3OiJ1c2VyX2lkIjtpOjE7czo0OiJuYW1lIjtzOjEwOiJTdXBlcnZpc29yIjtzOjU6ImVtYWlsIjtzOjIwOiJzdXBlcnZpc29yQGdtYWlsLmNvbSI7czo0OiJmb3RvIjtzOjQwOiJzdG9yYWdlL2FwcC9mb3RvcGVyZmlsL3BlcmZpbERlZmF1bHQuanBnIjtzOjU6Imlkcm9sIjtpOjE7czo2OiJidXNjYXIiO2I6MTtzOjc6Im1lbnVfaWQiO3M6MToiNSI7fQ==', 1609886523, NULL, NULL, NULL, NULL),
('HAsmrvJYUg0kGw2GThivU2OErIXHxmdxrjJnxzC4', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/87.0.4280.88 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiQWNvMEgybGI0cVFvY3p1b3EyY054Rlg4QTRlRm55cEVXU3hDUm1xTSI7czoxMjoiY29kaWdvQ2FybmV0IjtzOjY6IkFFLTAwMyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1609891731, NULL, NULL, NULL, NULL),
('HDYGOozPmCeOHgTEsFy2to7IVXT9tLEGsXuuCw3H', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/87.0.4280.88 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiODRrYVdXeENSc3RwbmxzYjIzWGtZU1NaZUJ4UUlzMzk1emZMV2g3ciI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDE6Imh0dHA6Ly9sb2NhbGhvc3QvdmVyc2lvbi9hcGkvZm9ybS9jb3ZpZC8zIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1609891074, NULL, NULL, NULL, NULL),
('KIHCn2cwidTNCxXhb0XLc2SgkeTQ50B9rCP9CP7d', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/87.0.4280.88 Safari/537.36', 'YTozOntzOjk6Il9wcmV2aW91cyI7YToxOntzOjM6InVybCI7czoyNDoiaHR0cDovL2xvY2FsaG9zdC92ZXJzaW9uIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo2OiJfdG9rZW4iO3M6NDA6Ijd6a3hPdnV2c01nTFdIc20zZ1hLNU9HdU9VcjVKV1JpZmx0NFBPSFgiO30=', 1609884962, NULL, NULL, NULL, NULL),
('L42w5pBBDOTPJgd1Z0Ctit0CoLmSR2Iyn6ER5UEp', NULL, '192.168.2.164', 'Mozilla/5.0 (Linux; Android 10; SM-A217M) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.198 Mobile Safari/537.36', 'YToxMDp7czo2OiJfdG9rZW4iO3M6NDA6InRiNlo3Z0Q3RHBiY0RkMU1hdHZDdE8ybDJWM05DMFNqZU5USW4ydkYiO3M6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjQ0OiJodHRwOi8vMTkyLjE2OC4yLjk4L0FkdmFuY2VkRW5lcmd5L2VxdWlwb3MvMyI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NzoidXNlcl9pZCI7aToxO3M6NDoibmFtZSI7czoxMDoiU3VwZXJ2aXNvciI7czo1OiJlbWFpbCI7czoyMDoic3VwZXJ2aXNvckBnbWFpbC5jb20iO3M6NDoiZm90byI7czo2Nzoic3RvcmFnZS9hcHAvZm90b3BlcmZpbC9VUzRwOXJJbjBRV2lMNTlyUElHQjN3eFlwS0ZhdVJteTZSeFNueEJaLnBuZyI7czo1OiJpZHJvbCI7aToxO3M6NzoibWVudV9pZCI7czoyOiIyOSI7czo2OiJidXNjYXIiO2I6MTt9', 1610380765, NULL, NULL, NULL, NULL),
('MvbidNWkaqQtqKiiRAECFbUHrLCKzRa8BEImC7oa', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/87.0.4280.88 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiNXlnWDlVMmdMVXdvdmFXdHlQT25xVEIyaU9QbUdFRXY3YXpLYU1BMSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDE6Imh0dHA6Ly9sb2NhbGhvc3QvdmVyc2lvbi9hcGkvZm9ybS9jb3ZpZC8zIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czoxMjoiY29kaWdvQ2FybmV0IjtzOjY6IkFFLTAwMyI7fQ==', 1609889052, NULL, NULL, NULL, NULL),
('nZgyjA5MO2XNGJmwq9agS3TFcWmu3kLD24LH7B1T', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/87.0.4280.88 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiMjJUcjR5S3E5YzVkMVVMYmVubGpSM3ZZTkdzQ3RndlNwcVVjZmpWRSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzE6Imh0dHA6Ly9sb2NhbGhvc3QvYWR2YW5jZWRlbmVyZ3kiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1610061106, NULL, NULL, NULL, NULL),
('oTVhuAbOfkCgABufRvka7i6gVBHdq4jISgjpCex8', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/87.0.4280.88 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoia0FWZ21jbWx5alNQa1hrWjBkS3RsT0R5TUJIclFiZVFaQldsZjdZVCI7czoxMjoiY29kaWdvQ2FybmV0IjtzOjY6IkFFLTAwMyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NjY6Imh0dHA6Ly9sb2NhbGhvc3QvdmVyc2lvbi9hcGkvYXNpc3RlbmNpYT9hPTMmYj1leUpwZGlJNklteHRRa2huVFVGTiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1609886274, NULL, NULL, NULL, NULL),
('Ou4JSIVzHjz77erKgiFxbpfZNdIWU3DASbgKmzI8', NULL, '192.168.2.98', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/87.0.4280.88 Safari/537.36', 'YToxMDp7czo2OiJfdG9rZW4iO3M6NDA6InJDbFFqRUZrUk5aZ1ZNdkVZOUFGVzZTT083UFFlaDg3M1NVSUlXRHYiO3M6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjQ2OiJodHRwczovLzE5Mi4xNjguMi45OC9BZHZhbmNlZEVuZXJneS9hcGxpY2FjaW9uIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo3OiJ1c2VyX2lkIjtpOjE7czo0OiJuYW1lIjtzOjEwOiJTdXBlcnZpc29yIjtzOjU6ImVtYWlsIjtzOjIwOiJzdXBlcnZpc29yQGdtYWlsLmNvbSI7czo0OiJmb3RvIjtzOjY3OiJzdG9yYWdlL2FwcC9mb3RvcGVyZmlsL1VTNHA5ckluMFFXaUw1OXJQSUdCM3d4WXBLRmF1Um15NlJ4U254QloucG5nIjtzOjU6Imlkcm9sIjtpOjE7czo3OiJtZW51X2lkIjtzOjI6IjI4IjtzOjY6ImJ1c2NhciI7YjoxO30=', 1610121358, NULL, NULL, NULL, NULL),
('QkrxJOyk9Eo2IhyTJUqPFhGgVKdJIYj5xX7HwShO', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/87.0.4280.88 Safari/537.36', 'YToyOntzOjY6Il90b2tlbiI7czo0MDoiQU5BZHE5cDJYNk9qT3BzN216QTJ2Z3Jhb3JreThlM3BpRUlQaEZRcSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1609886532, NULL, NULL, NULL, NULL),
('rVfgSMaLDUO3ZjNhJ0z3RnzaaOF65JGPz1l04tqm', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/87.0.4280.88 Safari/537.36', 'YToxMDp7czo2OiJfdG9rZW4iO3M6NDA6InhnNW5sT0hLZjdwbG5TbXQ3R29pdFlCNG1ma3ZEdWVJQ2ZnalNkeEQiO3M6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjQxOiJodHRwOi8vbG9jYWxob3N0L3ZlcnNpb24vZW1wbGVhZG9zLzMvZWRpdCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NzoidXNlcl9pZCI7aToxO3M6NDoibmFtZSI7czoxMDoiU3VwZXJ2aXNvciI7czo1OiJlbWFpbCI7czoyMDoic3VwZXJ2aXNvckBnbWFpbC5jb20iO3M6NDoiZm90byI7czo2Nzoic3RvcmFnZS9hcHAvZm90b3BlcmZpbC9VUzRwOXJJbjBRV2lMNTlyUElHQjN3eFlwS0ZhdVJteTZSeFNueEJaLnBuZyI7czo1OiJpZHJvbCI7aToxO3M6NjoiYnVzY2FyIjtiOjE7czo3OiJtZW51X2lkIjtzOjI6IjMzIjt9', 1609890607, NULL, NULL, NULL, NULL),
('UoqR174YR6dIi8eRaM4DS3oC1rGqmwnB2bNnqA4T', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/87.0.4280.88 Safari/537.36', 'YToxMDp7czo2OiJfdG9rZW4iO3M6NDA6IlQxa21TZDYyY00wOFdjZFFJZUE5S1NTRWZUWWxlSHQzZm9kbUd5dW0iO3M6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjMxOiJodHRwOi8vbG9jYWxob3N0L3ZlcnNpb24vaW5pY2lvIjt9czo3OiJ1c2VyX2lkIjtpOjE7czo0OiJuYW1lIjtzOjEwOiJTdXBlcnZpc29yIjtzOjU6ImVtYWlsIjtzOjIwOiJzdXBlcnZpc29yQGdtYWlsLmNvbSI7czo0OiJmb3RvIjtzOjY3OiJzdG9yYWdlL2FwcC9mb3RvcGVyZmlsL1VTNHA5ckluMFFXaUw1OXJQSUdCM3d4WXBLRmF1Um15NlJ4U254QloucG5nIjtzOjU6Imlkcm9sIjtpOjE7czo2OiJidXNjYXIiO2I6MTtzOjc6Im1lbnVfaWQiO3M6MToiNSI7fQ==', 1609889953, NULL, NULL, NULL, NULL),
('VhLOCCocaYIoe65Zxf2JvQ2FGXnyWvWLkKt6LlSJ', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/87.0.4280.88 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiOW1EZ3pxVEU3WTBTbzNDbmxYeFlUdDA2dkdxb09RZEZjMjl4WTFsViI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjQ6Imh0dHA6Ly9sb2NhbGhvc3QvdmVyc2lvbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1609891023, NULL, NULL, NULL, NULL),
('yAmYZFfyWLeatLLLzWxWUWIOAMlyefkeD6SSbjSJ', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/87.0.4280.88 Safari/537.36', 'YToyOntzOjY6Il90b2tlbiI7czo0MDoiZkF6dXVNaElGSG5FaDJxNjRiMjVRbkhMdUxnM1B0UG5pc0lESjNWTiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1609891720, NULL, NULL, NULL, NULL),
('ZDir4XRXS1TTEzlPMLKVV4CknNgbtbBveN3qYl50', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/87.0.4280.88 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiNzk0VUhKck51VEZUMDhrclloM3NHWUVPQXN1d1pjUmFHWVFxMUs2OCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDE6Imh0dHA6Ly9sb2NhbGhvc3QvdmVyc2lvbi9hcGkvZm9ybS9jb3ZpZC8zIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1609890537, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `svdepartamentos`
--

CREATE TABLE `svdepartamentos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `codigo` varchar(2) COLLATE utf8mb4_unicode_ci NOT NULL,
  `departamento` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `idpais` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `svdepartamentos`
--

INSERT INTO `svdepartamentos` (`id`, `created_at`, `updated_at`, `codigo`, `departamento`, `idpais`) VALUES
(1, NULL, NULL, '01', 'Ahuachapan', 1),
(2, NULL, NULL, '02', 'Santa Ana', 1),
(3, NULL, NULL, '03', 'Son Sonate', 1),
(4, NULL, NULL, '04', 'Chalatenango', 1),
(5, NULL, NULL, '05', 'La Libertad', 1),
(6, NULL, NULL, '06', 'San Salvador', 1),
(7, NULL, NULL, '07', 'Cuscatlan', 1),
(8, NULL, NULL, '08', 'La Paz', 1),
(9, NULL, NULL, '09', 'Cabañas', 1),
(10, NULL, NULL, '10', 'San Vicente', 1),
(11, NULL, NULL, '11', 'Usulutan', 1),
(12, NULL, NULL, '12', 'San Miguel', 1),
(13, NULL, NULL, '13', 'Morazán', 1),
(14, NULL, NULL, '14', 'La Unión', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `svmunicipios`
--

CREATE TABLE `svmunicipios` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `codigo` varchar(4) COLLATE utf8mb4_unicode_ci NOT NULL,
  `municipio` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `iddepartamento` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `svmunicipios`
--

INSERT INTO `svmunicipios` (`id`, `created_at`, `updated_at`, `codigo`, `municipio`, `iddepartamento`) VALUES
(1, NULL, NULL, '0101', 'Ahuachapan', 1),
(2, NULL, NULL, '0102', 'Apaneca', 1),
(3, NULL, NULL, '0103', 'Atiquizaya', 1),
(4, NULL, NULL, '0104', 'Concepción de Ataco', 1),
(5, NULL, NULL, '0105', 'El Refugio', 1),
(6, NULL, NULL, '0106', 'Guaymango', 1),
(7, NULL, NULL, '0107', 'Jujutla', 1),
(8, NULL, NULL, '0108', 'San Francisco Menéndez', 1),
(9, NULL, NULL, '0109', 'San Lorenzo', 1),
(10, NULL, NULL, '0110', 'San Pedro Puxtla', 1),
(11, NULL, NULL, '0111', 'Tacuba', 1),
(12, NULL, NULL, '0112', 'Turín', 1),
(13, NULL, NULL, '0201', 'Candelaria de la Frontera', 2),
(14, NULL, NULL, '0202', 'Chalchuapa', 2),
(15, NULL, NULL, '0203', 'Coatepeque', 2),
(16, NULL, NULL, '0204', 'El Congo', 2),
(17, NULL, NULL, '0205', 'El Porvenir', 2),
(18, NULL, NULL, '0206', 'Masahuat', 2),
(19, NULL, NULL, '0207', 'Metapán', 2),
(20, NULL, NULL, '0208', 'San Antonio Pajonal', 2),
(21, NULL, NULL, '0209', 'San Sebastián Salitrillo', 2),
(22, NULL, NULL, '0210', 'Santa Ana', 2),
(23, NULL, NULL, '0211', 'Santa Rosa Guachipilín', 2),
(24, NULL, NULL, '0212', 'Santiago de la Frontera', 2),
(25, NULL, NULL, '0213', 'Texistepeque', 2),
(26, NULL, NULL, '0301', 'Acajutla', 3),
(27, NULL, NULL, '0302', 'Armenia', 3),
(28, NULL, NULL, '0303', 'Caluco', 3),
(29, NULL, NULL, '0304', 'Cuisnahuat', 3),
(30, NULL, NULL, '0305', 'Izalco', 3),
(31, NULL, NULL, '0306', 'Juayúa', 3),
(32, NULL, NULL, '0307', 'Nahuizalco', 3),
(33, NULL, NULL, '0308', 'Nahulingo', 3),
(34, NULL, NULL, '0309', 'Salcoatitán', 3),
(35, NULL, NULL, '0310', 'San Antonio del Monte', 3),
(36, NULL, NULL, '0311', 'San Julián', 3),
(37, NULL, NULL, '0312', 'Santa Catarina Masahuat', 3),
(38, NULL, NULL, '0313', 'Santa Isabel Ishuatán', 3),
(39, NULL, NULL, '0314', 'Santo Domingo de Guzmán', 3),
(40, NULL, NULL, '0315', 'Sonsonate', 3),
(41, NULL, NULL, '0316', 'Sonzacate', 3),
(42, NULL, NULL, '0401', 'Agua Caliente', 4),
(43, NULL, NULL, '0402', 'Arcatao', 4),
(44, NULL, NULL, '0403', 'Azacualpa', 4),
(45, NULL, NULL, '0404', 'Chalatenango', 4),
(46, NULL, NULL, '0405', 'Citalá', 4),
(47, NULL, NULL, '0406', 'Comalapa', 4),
(48, NULL, NULL, '0407', 'Concepción Quezaltepeque', 4),
(49, NULL, NULL, '0408', 'Dulce Nombre de María', 4),
(50, NULL, NULL, '0409', 'El Carrizal', 4),
(51, NULL, NULL, '0410', 'El Paraíso', 4),
(52, NULL, NULL, '0411', 'La Laguna', 4),
(53, NULL, NULL, '0412', 'La Palma', 4),
(54, NULL, NULL, '0413', 'La Reina', 4),
(55, NULL, NULL, '0414', 'Las Vueltas', 4),
(56, NULL, NULL, '0415', 'Nombre de Jesús', 4),
(57, NULL, NULL, '0416', 'Nueva Concepción', 4),
(58, NULL, NULL, '0417', 'Nueva Trinidad', 4),
(59, NULL, NULL, '0418', 'Ojos de Agua', 4),
(60, NULL, NULL, '0419', 'Potonico', 4),
(61, NULL, NULL, '0420', 'San Antonio de la Cruz', 4),
(62, NULL, NULL, '0421', 'San Antonio Los Ranchos', 4),
(63, NULL, NULL, '0422', 'San Fernando', 4),
(64, NULL, NULL, '0423', 'San Francisco Lempa', 4),
(65, NULL, NULL, '0424', 'San Francisco Morazán', 4),
(66, NULL, NULL, '0425', 'San Ignacio', 4),
(67, NULL, NULL, '0426', 'San Isidro Labrador', 4),
(68, NULL, NULL, '0427', 'San José Cancasque / Cancasque', 4),
(69, NULL, NULL, '0428', 'San José Las Flores / Las Flores', 4),
(70, NULL, NULL, '0429', 'San Luis del Carmen', 4),
(71, NULL, NULL, '0430', 'San Miguel de Mercedes', 4),
(72, NULL, NULL, '0431', 'San Rafael', 4),
(73, NULL, NULL, '0432', 'Santa Rita', 4),
(74, NULL, NULL, '0433', 'Tejutla', 4),
(75, NULL, NULL, '0501', 'Antiguo Cuscatlán', 5),
(76, NULL, NULL, '0502', 'Chiltiupán', 5),
(77, NULL, NULL, '0503', 'Ciudad Arce', 5),
(78, NULL, NULL, '0504', 'Colón', 5),
(79, NULL, NULL, '0505', 'Comasagua', 5),
(80, NULL, NULL, '0506', 'Huizúcar', 5),
(81, NULL, NULL, '0507', 'Jayaque', 5),
(82, NULL, NULL, '0508', 'Jicalapa', 5),
(83, NULL, NULL, '0509', 'La Libertad', 5),
(84, NULL, NULL, '0510', 'Nuevo Cuscatlán', 5),
(85, NULL, NULL, '0511', 'Santa Tecla', 5),
(86, NULL, NULL, '0512', 'Quezaltepeque', 5),
(87, NULL, NULL, '0513', '34f5', 5),
(88, NULL, NULL, '0514', 'San José Villanueva', 5),
(89, NULL, NULL, '0515', 'San Juan Opico', 5),
(90, NULL, NULL, '0516', 'San Matías', 5),
(91, NULL, NULL, '0517', 'San Pablo Tacachico', 5),
(92, NULL, NULL, '0518', 'Talnique', 5),
(93, NULL, NULL, '0519', 'Tamanique', 5),
(94, NULL, NULL, '0520', 'Teotepeque', 5),
(95, NULL, NULL, '0521', 'Tepecoyo', 5),
(96, NULL, NULL, '0522', 'Zaragoza', 5),
(97, NULL, NULL, '0601', 'Aguilares', 6),
(98, NULL, NULL, '0602', 'Apopa', 6),
(99, NULL, NULL, '0603', 'Ayutuxtepeque', 6),
(100, NULL, NULL, '0604', 'Cuscatancingo', 6),
(101, NULL, NULL, '0605', 'Cuscatancingo', 6),
(102, NULL, NULL, '0606', 'El Paisnal', 6),
(103, NULL, NULL, '0607', 'Guazapa', 6),
(104, NULL, NULL, '0608', 'Mejicanos', 6),
(105, NULL, NULL, '0609', 'Nejapa', 6),
(106, NULL, NULL, '0610', 'Panchimalco', 6),
(107, NULL, NULL, '0611', 'Rosario de Mora', 6),
(108, NULL, NULL, '0612', 'San Marcos', 6),
(109, NULL, NULL, '0613', 'San Martín', 6),
(110, NULL, NULL, '0614', 'San Salvador', 6),
(111, NULL, NULL, '0615', 'Santiago Texacuangos', 6),
(112, NULL, NULL, '0616', 'Santo Tomás', 6),
(113, NULL, NULL, '0617', 'Soyapango', 6),
(114, NULL, NULL, '0618', 'Tonacatepeque', 6),
(115, NULL, NULL, '0619', 'Delgado', 6);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipodocumentos`
--

CREATE TABLE `tipodocumentos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `tipodocumento` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `tipodocumentos`
--

INSERT INTO `tipodocumentos` (`id`, `created_at`, `updated_at`, `tipodocumento`) VALUES
(1, NULL, NULL, 'DUI');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ubicacions`
--

CREATE TABLE `ubicacions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `codigo` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descripcion` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `latitud` double NOT NULL,
  `longitud` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `ubicacions`
--

INSERT INTO `ubicacions` (`id`, `created_at`, `updated_at`, `codigo`, `descripcion`, `latitud`, `longitud`) VALUES
(1, '2021-01-06 04:02:47', '2021-01-08 00:29:40', 'Admin', 'Administración', 13.669850748462096, -89.29407103989004),
(2, '2021-01-08 00:30:15', '2021-01-08 00:30:15', 'Opico', 'Opico power', 13.681291951322976, -89.25588168594932);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `idrol` int(11) NOT NULL,
  `estado` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `foto`, `remember_token`, `created_at`, `updated_at`, `idrol`, `estado`) VALUES
(1, 'Supervisor', 'supervisor@gmail.com', NULL, 'eyJpdiI6ImVWd2VETWt2amROT05kbUtFdDEzRmc9PSIsInZhbHVlIjoiSmcwWDhWdHRJc3FoN1RHSnJWcWZYQT09IiwibWFjIjoiMDVjYWZkM2U0MWZiNjkwYWE1MTZhMmRjNWY5MGVhOWZiNzVjZGY4MWM3YTQyMzBmOWJkYTdkNTA4OTgxYTg2OSJ9', 'fotoperfil/US4p9rIn0QWiL59rPIGB3wxYpKFauRmy6RxSnxBZ.png', NULL, NULL, '2021-01-06 05:38:42', 1, 1),
(2, 'Carlos Miranda', 'amiranda@ae-energiasolar.com', NULL, 'eyJpdiI6Ims0cVo3VTl5bFpGNGUrQWlWS3Q0UXc9PSIsInZhbHVlIjoiNDJoUVY5aUtXUUNsU21UTFNLVkNnZz09IiwibWFjIjoiYzQxOWFkODA5MjZmNGM0ODRkMDA1NTY3NmNjMDJkNjhjNDBkMDc5MGQ0NGFlZjVmYWE5NzA2YzZlOGNiMDA1NyJ9', 'fotoperfil/perfilDefault.jpg', NULL, '2021-01-07 05:14:27', '2021-01-07 05:14:27', 0, 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `autorizacionusuarios`
--
ALTER TABLE `autorizacionusuarios`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `cargos`
--
ALTER TABLE `cargos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `departamentos`
--
ALTER TABLE `departamentos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `dias`
--
ALTER TABLE `dias`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `dias_feriados`
--
ALTER TABLE `dias_feriados`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `empleados`
--
ALTER TABLE `empleados`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `empleado_documentos`
--
ALTER TABLE `empleado_documentos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `empleado_documentos_fotos`
--
ALTER TABLE `empleado_documentos_fotos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `empleado_empresas`
--
ALTER TABLE `empleado_empresas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `empleado_referencias`
--
ALTER TABLE `empleado_referencias`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `empleado_users`
--
ALTER TABLE `empleado_users`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `equiposfotos`
--
ALTER TABLE `equiposfotos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `equiposhistorials`
--
ALTER TABLE `equiposhistorials`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `equipostrabajos`
--
ALTER TABLE `equipostrabajos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `equipo_mantenimientos`
--
ALTER TABLE `equipo_mantenimientos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `estadocivils`
--
ALTER TABLE `estadocivils`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indices de la tabla `formuas`
--
ALTER TABLE `formuas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `formubs`
--
ALTER TABLE `formubs`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `formucs`
--
ALTER TABLE `formucs`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `generos`
--
ALTER TABLE `generos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `grupohorarios`
--
ALTER TABLE `grupohorarios`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `grupohorariosds`
--
ALTER TABLE `grupohorariosds`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `marcacionesempleados`
--
ALTER TABLE `marcacionesempleados`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `modulos`
--
ALTER TABLE `modulos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `pais`
--
ALTER TABLE `pais`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indices de la tabla `permisos`
--
ALTER TABLE `permisos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `sessions`
--
ALTER TABLE `sessions`
  ADD UNIQUE KEY `sessions_id_unique` (`id`),
  ADD KEY `sessions_name_index` (`name`);

--
-- Indices de la tabla `svdepartamentos`
--
ALTER TABLE `svdepartamentos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `svmunicipios`
--
ALTER TABLE `svmunicipios`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tipodocumentos`
--
ALTER TABLE `tipodocumentos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `ubicacions`
--
ALTER TABLE `ubicacions`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `autorizacionusuarios`
--
ALTER TABLE `autorizacionusuarios`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `cargos`
--
ALTER TABLE `cargos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `departamentos`
--
ALTER TABLE `departamentos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `dias`
--
ALTER TABLE `dias`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `dias_feriados`
--
ALTER TABLE `dias_feriados`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `empleados`
--
ALTER TABLE `empleados`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- AUTO_INCREMENT de la tabla `empleado_documentos`
--
ALTER TABLE `empleado_documentos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `empleado_documentos_fotos`
--
ALTER TABLE `empleado_documentos_fotos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `empleado_empresas`
--
ALTER TABLE `empleado_empresas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `empleado_referencias`
--
ALTER TABLE `empleado_referencias`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `empleado_users`
--
ALTER TABLE `empleado_users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `equiposfotos`
--
ALTER TABLE `equiposfotos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `equiposhistorials`
--
ALTER TABLE `equiposhistorials`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `equipostrabajos`
--
ALTER TABLE `equipostrabajos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `equipo_mantenimientos`
--
ALTER TABLE `equipo_mantenimientos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `estadocivils`
--
ALTER TABLE `estadocivils`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `formuas`
--
ALTER TABLE `formuas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT de la tabla `formubs`
--
ALTER TABLE `formubs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=274;

--
-- AUTO_INCREMENT de la tabla `formucs`
--
ALTER TABLE `formucs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `generos`
--
ALTER TABLE `generos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `grupohorarios`
--
ALTER TABLE `grupohorarios`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `grupohorariosds`
--
ALTER TABLE `grupohorariosds`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `marcacionesempleados`
--
ALTER TABLE `marcacionesempleados`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT de la tabla `modulos`
--
ALTER TABLE `modulos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT de la tabla `pais`
--
ALTER TABLE `pais`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `permisos`
--
ALTER TABLE `permisos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `svdepartamentos`
--
ALTER TABLE `svdepartamentos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `svmunicipios`
--
ALTER TABLE `svmunicipios`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=116;

--
-- AUTO_INCREMENT de la tabla `tipodocumentos`
--
ALTER TABLE `tipodocumentos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `ubicacions`
--
ALTER TABLE `ubicacions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
