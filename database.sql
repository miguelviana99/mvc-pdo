-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 02-07-2024 a las 17:01:16
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `crud-mvc-oop-pdo`
--
CREATE DATABASE IF NOT EXISTS `crud-mvc-oop-pdo` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `crud-mvc-oop-pdo`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `players`
--

CREATE TABLE `players` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` text NOT NULL,
  `number` smallint(5) UNSIGNED DEFAULT NULL,
  `team_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `players`
--

INSERT INTO `players` VALUES
(6, 'Blob', 23, 8),
(7, 'Pedro', 45, 8),
(8, 'Juan', 22, 9),
(9, 'Miguel', 53, 9),
(10, 'Maria', 75, 9),
(11, 'Laura', 64, 9),
(12, 'Miguel', 86, 10),
(13, 'Maria', 2, 10),
(14, 'Laura', 56, 10);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `teams`
--

CREATE TABLE `teams` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` text DEFAULT NULL,
  `city` text DEFAULT NULL,
  `sport` text DEFAULT NULL,
  `foundation_date` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `teams`
--

INSERT INTO `teams` VALUES
(8, 'Equipo 1', 'Madrid', 'Football', '2024-07-02 16:56:05'),
(9, 'Equipo 2', 'Valencia', 'Basketball', '2024-07-02 16:56:05'),
(10, 'Equipo 3', 'Barcelona', 'Football', '2024-07-02 16:56:09'),
(11, 'Equipo 4', 'Sevilla', 'Basketball', '2024-07-02 16:56:09');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `players`
--
ALTER TABLE `players`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_team_id` (`team_id`);

--
-- Indices de la tabla `teams`
--
ALTER TABLE `teams`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `players`
--
ALTER TABLE `players`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `teams`
--
ALTER TABLE `teams`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `players`
--
ALTER TABLE `players`
  ADD CONSTRAINT `fk_team_id` FOREIGN KEY (`team_id`) REFERENCES `teams` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
