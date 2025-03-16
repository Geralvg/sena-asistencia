-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 16-03-2025 a las 02:36:14
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
-- Base de datos: `sena_asistencias`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `apprentices`
--

CREATE TABLE `apprentices` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `group_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `apprentices`
--

INSERT INTO `apprentices` (`id`, `name`, `group_id`) VALUES
(1, 'mateo', 1),
(2, 'bran', 1),
(3, 'geral', 1),
(4, 'mateo', 1),
(5, 'bran', 1),
(6, 'mateo', 1),
(7, 'brandon', 1),
(8, 'geral', 1),
(9, 'julian', 1),
(10, 'mario', 2),
(11, 'daniel', 2),
(12, 'sebastian', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `attendances`
--

CREATE TABLE `attendances` (
  `id` int(11) NOT NULL,
  `apprentice_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `status` enum('present','absent') NOT NULL,
  `attendance_hours` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `attendances`
--

INSERT INTO `attendances` (`id`, `apprentice_id`, `class_id`, `status`, `attendance_hours`) VALUES
(5, 1, 5, 'present', 8),
(6, 2, 5, 'present', 8),
(7, 3, 5, 'absent', NULL),
(8, 4, 5, 'present', 8),
(9, 5, 5, 'present', 8),
(10, 6, 5, 'present', 8),
(11, 7, 5, 'present', 8),
(12, 8, 5, 'present', 8),
(13, 9, 5, 'absent', NULL),
(14, 1, 4, 'present', 5),
(15, 2, 4, 'present', 5),
(16, 3, 4, 'absent', NULL),
(17, 4, 4, 'present', 5),
(18, 5, 4, 'present', 5),
(19, 6, 4, 'present', 5),
(20, 7, 4, 'present', 5),
(21, 8, 4, 'present', 5),
(22, 9, 4, 'absent', NULL),
(23, 1, 2, 'present', 3),
(24, 2, 2, 'present', 3),
(25, 3, 2, 'absent', NULL),
(26, 4, 2, 'present', 3),
(27, 5, 2, 'present', 3),
(28, 6, 2, 'present', 3),
(29, 7, 2, 'present', 3),
(30, 8, 2, 'present', 3),
(31, 9, 2, 'absent', NULL),
(32, 10, 6, 'present', 8),
(33, 11, 6, 'absent', NULL),
(34, 12, 6, 'present', 8),
(35, 10, 6, 'present', 9),
(36, 11, 6, 'absent', NULL),
(37, 12, 6, 'present', 9),
(38, 10, 6, 'present', 3),
(39, 11, 6, 'absent', NULL),
(40, 12, 6, 'present', 3),
(41, 10, 6, 'present', 12),
(42, 11, 6, 'present', 12),
(43, 12, 6, 'present', 12);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `centers`
--

CREATE TABLE `centers` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `regional_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `centers`
--

INSERT INTO `centers` (`id`, `name`, `regional_id`) VALUES
(1, 'cpic', 1),
(2, 'akjajajja', 1),
(3, 'holaaaa', 1),
(4, 'mecanizado', 3),
(5, 'cafetera', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `classes`
--

CREATE TABLE `classes` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `date` date NOT NULL,
  `group_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `classes`
--

INSERT INTO `classes` (`id`, `name`, `date`, `group_id`) VALUES
(2, 'nose', '2025-03-11', 1),
(4, 'gym_sena', '2025-03-26', 1),
(5, 'holaaaa', '2025-03-19', 1),
(6, 'desarrollo', '2025-03-22', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `environments`
--

CREATE TABLE `environments` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `center_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `environments`
--

INSERT INTO `environments` (`id`, `name`, `center_id`) VALUES
(1, 'sistemas 1', 1),
(2, 'sistemas 1', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `groups`
--

CREATE TABLE `groups` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `program_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `groups`
--

INSERT INTO `groups` (`id`, `name`, `program_id`) VALUES
(1, '2873707', 2),
(2, '2789999', 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `instructors`
--

CREATE TABLE `instructors` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `instructors`
--

INSERT INTO `instructors` (`id`, `name`, `user_id`) VALUES
(1, 'geraldine 456', 7),
(2, 'german', 10);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `programs`
--

CREATE TABLE `programs` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `center_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `programs`
--

INSERT INTO `programs` (`id`, `name`, `center_id`) VALUES
(2, 'adso', 1),
(3, 'biomedica', 4),
(4, 'diseño', 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `regionals`
--

CREATE TABLE `regionals` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `regionals`
--

INSERT INTO `regionals` (`id`, `name`) VALUES
(1, 'caldas'),
(2, 'antioquia'),
(3, 'bogota'),
(4, 'chinchina');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('super_admin','coordinator','instructor') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`, `created_at`) VALUES
(2, 'admin', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'super_admin', '2025-03-13 00:57:03'),
(3, 'brandon', '$2y$10$xE2DHrn4wbi6p9qi6K.IQO82yOexHc/NJZA8sbgNPvwfWdUsBIiSO', 'coordinator', '2025-03-13 00:58:07'),
(4, 'geral', '$2y$10$rb2vAnaI6ZtHCj3qdEvweOhphmM/XAobLJ/vLlT.MVlLYp0/q4tm.', 'instructor', '2025-03-13 00:58:16'),
(5, 'geral1234', '$2y$10$00hUd1LMaGoNFdG9Yvs1Ge7u5Rennd7RUJUCxCw3ymRgsY9Am6WWS', 'instructor', '2025-03-13 01:28:32'),
(7, 'geral789', '$2y$10$eWHPPMrM.YnnvxQtA./pl.JcYgIPoP58l024fxn2q7aojsphKxHUG', 'instructor', '2025-03-13 01:30:51'),
(8, 'juan', '$2y$10$tJV2gHR.fXFlh3ZVzFRjxe./XKlYwddgqSTsOJlq96x1iXMsUEQe.', 'coordinator', '2025-03-13 02:57:17'),
(9, 'pepe', '$2y$10$P8b6295POoo6sIKvEhBWde1rt.J1.B4o/xOQ/5i8rx2NH1cVI3Pue', 'coordinator', '2025-03-13 04:52:59'),
(10, 'german', '$2y$10$JAmTzmsOxM5irDzF/hJCmOq9mu5T.WsIukrvKLgu7Ta0rBbnI0l7y', 'instructor', '2025-03-13 05:02:11');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `apprentices`
--
ALTER TABLE `apprentices`
  ADD PRIMARY KEY (`id`),
  ADD KEY `group_id` (`group_id`);

--
-- Indices de la tabla `attendances`
--
ALTER TABLE `attendances`
  ADD PRIMARY KEY (`id`),
  ADD KEY `apprentice_id` (`apprentice_id`),
  ADD KEY `class_id` (`class_id`);

--
-- Indices de la tabla `centers`
--
ALTER TABLE `centers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `regional_id` (`regional_id`);

--
-- Indices de la tabla `classes`
--
ALTER TABLE `classes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_class_group` (`group_id`);

--
-- Indices de la tabla `environments`
--
ALTER TABLE `environments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `center_id` (`center_id`);

--
-- Indices de la tabla `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`),
  ADD KEY `program_id` (`program_id`);

--
-- Indices de la tabla `instructors`
--
ALTER TABLE `instructors`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indices de la tabla `programs`
--
ALTER TABLE `programs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `center_id` (`center_id`);

--
-- Indices de la tabla `regionals`
--
ALTER TABLE `regionals`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `apprentices`
--
ALTER TABLE `apprentices`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `attendances`
--
ALTER TABLE `attendances`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT de la tabla `centers`
--
ALTER TABLE `centers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `classes`
--
ALTER TABLE `classes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `environments`
--
ALTER TABLE `environments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `groups`
--
ALTER TABLE `groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `instructors`
--
ALTER TABLE `instructors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `programs`
--
ALTER TABLE `programs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `regionals`
--
ALTER TABLE `regionals`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `apprentices`
--
ALTER TABLE `apprentices`
  ADD CONSTRAINT `apprentices_ibfk_1` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`);

--
-- Filtros para la tabla `attendances`
--
ALTER TABLE `attendances`
  ADD CONSTRAINT `attendances_ibfk_1` FOREIGN KEY (`apprentice_id`) REFERENCES `apprentices` (`id`),
  ADD CONSTRAINT `attendances_ibfk_2` FOREIGN KEY (`class_id`) REFERENCES `classes` (`id`);

--
-- Filtros para la tabla `centers`
--
ALTER TABLE `centers`
  ADD CONSTRAINT `centers_ibfk_1` FOREIGN KEY (`regional_id`) REFERENCES `regionals` (`id`);

--
-- Filtros para la tabla `classes`
--
ALTER TABLE `classes`
  ADD CONSTRAINT `fk_class_group` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`);

--
-- Filtros para la tabla `environments`
--
ALTER TABLE `environments`
  ADD CONSTRAINT `environments_ibfk_1` FOREIGN KEY (`center_id`) REFERENCES `centers` (`id`);

--
-- Filtros para la tabla `groups`
--
ALTER TABLE `groups`
  ADD CONSTRAINT `groups_ibfk_1` FOREIGN KEY (`program_id`) REFERENCES `programs` (`id`);

--
-- Filtros para la tabla `instructors`
--
ALTER TABLE `instructors`
  ADD CONSTRAINT `instructors_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `programs`
--
ALTER TABLE `programs`
  ADD CONSTRAINT `programs_ibfk_1` FOREIGN KEY (`center_id`) REFERENCES `centers` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
