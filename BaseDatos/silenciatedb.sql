-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 13-08-2026 a las 06:36:02
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `silenciatedb`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `agendasonora`
--

CREATE TABLE `agendasonora` (
  `Mes` varchar(20) NOT NULL,
  `Dia` varchar(20) NOT NULL,
  `Hora` time NOT NULL,
  `Grupo` varchar(100) NOT NULL,
  `Promedio` decimal(5,2) NOT NULL,
  `Min` decimal(5,2) NOT NULL,
  `Max` decimal(5,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `agendasonora`
--

INSERT INTO `agendasonora` (`Mes`, `Dia`, `Hora`, `Grupo`, `Promedio`, `Min`, `Max`) VALUES
('Junio', '3', '07:31:05', '11-1', 41.90, 32.37, 58.19),
('Junio', '3', '07:37:25', '8-1', 40.70, 31.28, 58.71),
('Junio', '3', '07:49:40', '8-1', 42.40, 35.71, 56.42),
('Junio', '3', '07:50:50', '11-1', 40.37, 36.60, 45.42),
('Junio', '3', '07:52:05', '11-4', 38.96, 36.03, 41.57),
('Junio', '3', '07:52:27', '10-4', 40.27, 38.57, 44.21),
('Junio', '3', '07:52:59', '10-4', 46.51, 37.11, 56.11),
('Junio', '3', '07:53:26', '10-4', 40.76, 37.12, 46.92),
('Junio', '3', '07:54:19', '10-2', 40.89, 37.41, 49.67),
('Junio', '3', '07:55:02', '10-1', 38.40, 34.50, 48.96),
('Junio', '3', '07:56:16', '10-1', 43.50, 36.83, 54.40),
('Junio', '3', '07:58:31', '10-2', 40.41, 35.22, 51.62),
('Junio', '3', '07:59:23', '11-4', 37.75, 34.01, 43.63),
('Junio', '3', '08:07:09', '10-1', 39.72, 33.23, 51.49),
('Junio', '11', '21:36:56', '9-1', 32.00, 31.25, 32.75),
('Junio', '11', '22:04:34', '10-4', 32.61, 31.25, 48.25),
('Junio', '11', '22:09:44', '11-1', 32.03, 31.25, 32.75),
('Junio', '11', '22:56:21', '10-2', 32.53, 31.26, 48.19),
('Junio', '11', '23:00:49', '10-1', 30.00, 30.00, 30.00),
('Junio', '11', '23:01:31', '10-1', 30.00, 30.00, 30.00),
('Junio', '11', '23:04:58', '10-1', 30.00, 30.00, 30.00),
('Junio', '11', '23:05:41', '11-3', 30.00, 30.00, 30.00),
('Junio', '11', '23:07:25', '10-4', 30.00, 30.00, 30.00),
('Junio', '11', '23:08:27', '10-1', 30.00, 30.00, 30.00),
('Junio', '11', '23:11:01', '9-1', 99.96, 97.84, 100.00),
('Junio', '11', '23:11:43', '10-1', 99.76, 97.84, 100.00),
('Junio', '11', '23:14:29', '10-1', 99.91, 97.84, 100.00),
('Junio', '11', '23:16:38', '11-3', 30.00, 30.00, 30.00),
('Junio', '11', '23:18:02', '10-1', 30.00, 30.00, 30.00),
('Junio', '11', '23:22:57', '11-3', 30.00, 30.00, 30.00),
('Junio', '11', '23:24:20', '10-2', 30.00, 30.00, 30.00),
('Junio', '11', '23:25:03', '10-4', 30.00, 30.00, 30.00),
('Junio', '11', '23:26:03', '10-2', 30.00, 30.00, 30.00),
('Junio', '11', '23:27:48', '8-1', 30.00, 30.00, 30.00),
('Junio', '11', '23:30:19', '9-1', 30.00, 30.00, 30.00),
('Junio', '11', '23:33:13', '9-3', 30.00, 30.00, 30.00),
('Junio', '11', '23:33:48', '10-1', 0.00, 0.00, 0.00),
('Junio', '11', '23:34:50', '10-1', 71.87, 47.90, 88.74),
('Junio', '11', '23:35:27', '10-1', 66.27, 50.50, 82.66),
('Junio', '11', '23:35:42', '9-1', 61.76, 51.12, 86.49),
('Junio', '11', '23:36:27', '10-1', 29.11, 10.43, 45.08),
('Junio', '11', '23:54:20', '10-1', 42.97, 33.76, 52.50),
('Junio', '11', '23:56:33', '11-3', 30.70, 10.00, 47.68),
('Junio', '18', '19:16:33', '11-2', 36.75, 19.46, 48.19),
('Agosto', '12', '21:32:04', '1-1', 23.95, 14.43, 31.91),
('Agosto', '12', '21:36:27', '8-3', 25.18, 12.82, 37.81),
('Agosto', '12', '22:18:15', '3-4', 21.83, 11.96, 30.35),
('Agosto', '12', '22:18:27', '5-4', 23.19, 14.33, 29.70),
('Agosto', '12', '22:22:01', '4-4', 21.31, 13.46, 31.19),
('Agosto', '12', '22:45:36', '5-2', 20.03, 10.00, 31.15);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `promedioactual`
--

CREATE TABLE `promedioactual` (
  `PROMEDIO` decimal(5,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `promedioactual`
--

INSERT INTO `promedioactual` (`PROMEDIO`) VALUES
(20);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `promedios_grado`
--

CREATE TABLE `promedios_grado` (
  `id` int(11) NOT NULL,
  `grado` int(11) NOT NULL,
  `suma` decimal(10,2) DEFAULT 0.00,
  `cantidad` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `promedios_grado`
--

INSERT INTO `promedios_grado` (`id`, `grado`, `suma`, `cantidad`) VALUES
(1, 1, 326.45, 7),
(2, 2, 418.72, 9),
(3, 3, 287.36, 6),
(4, 4, 512.84, 11),
(5, 5, 411.61, 9),
(6, 6, 467.23, 10),
(7, 7, 354.91, 7),
(8, 8, 584.67, 12),
(9, 9, 441.35, 9),
(10, 10, 623.48, 13),
(11, 11, 506.79, 10);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `promediototal`
--

CREATE TABLE `promediototal` (
  `id` int(11) NOT NULL,
  `numero` decimal(10,2) NOT NULL DEFAULT 0.00,
  `total` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `promediototal`
--

INSERT INTO `promediototal` (`id`, `numero`, `total`) VALUES
(1, 86.36, 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `registro`
--

CREATE TABLE `registro` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `usuario` varchar(50) NOT NULL,
  `email` varchar(150) NOT NULL,
  `contrasena` varchar(255) NOT NULL,
  `rol` varchar(20) NOT NULL DEFAULT 'usuario',
  `fecha_registro` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `registro`
--

INSERT INTO `registro` (`id`, `nombre`, `usuario`, `email`, `contrasena`, `rol`, `fecha_registro`) VALUES
(1, 'sebastian', 'sebasChika', 'sebastianalejandro8062@gmail.com', 'CHICA2020', 'usuario', '2026-06-12 04:48:54'),
(8, 'sebastiana', 'sebasChikas', 'sebastianalejandro8062@gmail.comm', 'CHICA20202', 'usuario', '2026-06-12 04:50:17'),
(10, 'elPepe', 'miusuario', 'chico@gmail.ocom', '123534234', 'usuario', '2026-06-12 04:51:44'),
(11, 'andrea Chica', 'SebasTeAmo123', 'andreachica2014@gmail.com', 'sebasteamo123', 'usuario', '2026-06-19 00:14:04'),
(12, 'Cecilia ', 'chila', 'chila@gmail.com', '220', 'usuario', '2026-06-19 00:20:11'),
(15, 'sebasChikaa', 'chilaAA', 'zapati@gmail.com', '220', 'usuario', '2026-08-13 03:50:34'),
(16, 'sebastian chikaa', 'sebaschikaa', 'sebaschikaa@gmail.com', '$2y$10$Amxsrg0DlFmAeOJEztZRA.qFO8BnapdwhvuwGIjuGMScCztYhgkua', 'usuario', '2026-08-13 04:16:46'),
(17, 'Sebastian Alejandro Chica Arias', 'sebastianchikaa', 'sebastianchikaa@gmail.com', '$2y$10$UEyTtHc6BlgTelbpEU8bqu6bNikEkJ0/zUO1b3sn3kMv/.P9L6tG6', 'usuario', '2026-08-13 04:19:09');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `promedios_grado`
--
ALTER TABLE `promedios_grado`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `grado` (`grado`);

--
-- Indices de la tabla `promediototal`
--
ALTER TABLE `promediototal`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `registro`
--
ALTER TABLE `registro`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `usuario` (`usuario`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `promedios_grado`
--
ALTER TABLE `promedios_grado`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `registro`
--
ALTER TABLE `registro`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
