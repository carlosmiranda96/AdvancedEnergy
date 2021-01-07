-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 06-01-2021 a las 06:55:01
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
(28, '2021-01-06 03:53:48', '2021-01-06 03:53:48', 'Lector QR', NULL, NULL, 2, 7, 4),
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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
