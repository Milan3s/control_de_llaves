-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 07-10-2025 a las 11:44:44
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
-- Base de datos: `control_de_llaves`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleados`
--

CREATE TABLE `empleados` (
  `id_empleado` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `apellidos` varchar(150) NOT NULL,
  `telefono1` varchar(20) NOT NULL,
  `telefono2` varchar(20) DEFAULT NULL,
  `id_empresa` int(10) UNSIGNED NOT NULL,
  `fecha_registro` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `empleados`
--

INSERT INTO `empleados` (`id_empleado`, `nombre`, `apellidos`, `telefono1`, `telefono2`, `id_empresa`, `fecha_registro`) VALUES
(1, 'Carlos', 'Pérez Gómez', '600111222', NULL, 1, '2025-09-21 13:40:53'),
(2, 'María', 'López Sánchez', '600333444', '911223344', 2, '2025-09-21 13:40:53'),
(3, 'Javier', 'Martínez Ruiz', '600555666', NULL, 3, '2025-09-21 13:40:53'),
(4, 'Laura', 'García Fernández', '600777888', NULL, 4, '2025-09-21 13:40:53'),
(5, 'Ana', 'Torres Delgado', '600999000', '933112233', 5, '2025-09-21 13:40:53'),
(6, 'Pedro', 'Ramírez Castro', '611222333', NULL, 6, '2025-09-21 13:40:53');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empresas`
--

CREATE TABLE `empresas` (
  `id_empresa` int(10) UNSIGNED NOT NULL,
  `nombre_empresa` varchar(150) NOT NULL,
  `direccion` varchar(200) DEFAULT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `creado_en` timestamp NOT NULL DEFAULT current_timestamp(),
  `actualizado_en` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `empresas`
--

INSERT INTO `empresas` (`id_empresa`, `nombre_empresa`, `direccion`, `telefono`, `email`, `creado_en`, `actualizado_en`) VALUES
(1, 'Tech Solutions S.A.', 'Calle Innovación 123, Madrid', '910000111', 'contacto@techsolutions.com', '2025-09-21 13:40:21', '2025-09-21 13:40:21'),
(2, 'Construcciones López S.L.', 'Av. de la Construcción 45, Sevilla', '955222333', 'info@construccioneslopez.com', '2025-09-21 13:40:21', '2025-09-21 13:40:21'),
(3, 'Seguridad Total S.A.', 'Calle Seguridad 9, Barcelona', '932123456', 'seguridad@totalsa.com', '2025-09-21 13:40:21', '2025-09-21 13:40:21'),
(4, 'Automóviles Martínez S.L.', 'Av. del Motor 77, Valencia', '963111222', 'ventas@automartinez.com', '2025-09-21 13:40:21', '2025-09-21 13:40:21'),
(5, 'Hospital Central', 'Calle Salud 101, Málaga', '952654321', 'administracion@hospitalcentral.com', '2025-09-21 13:40:21', '2025-09-21 13:40:21'),
(6, 'Logística Express S.A.', 'Calle Transporte 202, Bilbao', '944987654', 'info@logisticaexpress.com', '2025-09-21 13:40:21', '2025-09-21 13:40:21');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `incidencias`
--

CREATE TABLE `incidencias` (
  `id_incidencia` int(10) UNSIGNED NOT NULL,
  `id_llave` int(10) UNSIGNED NOT NULL,
  `id_empleado` int(10) UNSIGNED NOT NULL,
  `tipo_incidencia` enum('perdida','daniada','retraso','otra') NOT NULL,
  `descripcion` text DEFAULT NULL,
  `fecha_incidencia` timestamp NOT NULL DEFAULT current_timestamp(),
  `resuelta` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `incidencias`
--

INSERT INTO `incidencias` (`id_incidencia`, `id_llave`, `id_empleado`, `tipo_incidencia`, `descripcion`, `fecha_incidencia`, `resuelta`) VALUES
(1, 7, 5, 'perdida', 'se ha perdido la llave devuelvela', '2025-09-24 11:35:54', 0),
(2, 8, 5, 'perdida', 'x', '2025-09-24 11:41:19', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `llaves`
--

CREATE TABLE `llaves` (
  `id_llave` int(10) UNSIGNED NOT NULL,
  `codigo_llave` varchar(50) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `id_empleado` int(10) UNSIGNED DEFAULT NULL,
  `id_empresa` int(10) UNSIGNED NOT NULL,
  `hora_cogido` datetime DEFAULT NULL,
  `hora_dejado` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `llaves`
--

INSERT INTO `llaves` (`id_llave`, `codigo_llave`, `descripcion`, `id_empleado`, `id_empresa`, `hora_cogido`, `hora_dejado`) VALUES
(7, 'LL-001', 'Llave principal oficina Madrid', 1, 1, '2025-09-20 08:00:00', '2025-09-20 17:00:00'),
(8, 'LL-002', 'Llave almacén Sevilla', 2, 2, '2025-09-19 09:15:00', '2025-09-19 18:30:00'),
(9, 'LL-003', 'Llave acceso cámaras Barcelona', 3, 3, '2025-09-25 16:12:05', NULL),
(10, 'LL-004', 'Llave taller mecánico Valencia', 4, 4, '2025-09-22 09:00:00', '2025-09-22 17:30:00'),
(11, 'LL-005', 'Llave quirófano Málaga', 5, 5, NULL, NULL),
(12, 'LL-006', 'Llave depósito Bilbao', 2, 2, NULL, NULL),
(15, 'LL-007', 'Llave del Mercedes', 5, 4, '2025-10-01 00:04:00', '2025-10-08 02:07:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id_rol` tinyint(3) UNSIGNED NOT NULL,
  `nombre_rol` varchar(50) NOT NULL,
  `descripcion` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id_rol`, `nombre_rol`, `descripcion`) VALUES
(1, 'admin', 'Acceso total, gestiona usuarios y catálogo'),
(2, 'seguridad', 'Registra retiradas y depósitos de llaves'),
(3, 'consulta', 'Solo consulta informes y registros'),
(5, 'lector', 'Solo usuario de lectura');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(10) UNSIGNED NOT NULL,
  `nombre_usuario` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `id_rol` tinyint(3) UNSIGNED NOT NULL,
  `activo` tinyint(1) NOT NULL DEFAULT 1,
  `fecha_creacion` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `nombre_usuario`, `email`, `password`, `id_rol`, `activo`, `fecha_creacion`) VALUES
(1, 'admin', 'admin@gmail.com', '$2y$10$LlgTnaBZgCUmk.8C1InuHupnrUCbPpyI7BUoHRnb4/AEcQSVD9A2S', 3, 1, '2025-09-30 21:59:42'),
(3, 'tester', 'tester@gmail.com', '$2y$10$9NIHyDcl0TQx5GAuhNl95enKCeQQAxwWoXoQFQJsbfbYO33QylnVq', 3, 1, '2025-09-30 22:22:29');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `empleados`
--
ALTER TABLE `empleados`
  ADD PRIMARY KEY (`id_empleado`),
  ADD KEY `fk_empleado_empresa` (`id_empresa`);

--
-- Indices de la tabla `empresas`
--
ALTER TABLE `empresas`
  ADD PRIMARY KEY (`id_empresa`);

--
-- Indices de la tabla `incidencias`
--
ALTER TABLE `incidencias`
  ADD PRIMARY KEY (`id_incidencia`),
  ADD KEY `fk_incidencia_llave` (`id_llave`),
  ADD KEY `fk_incidencia_empleado` (`id_empleado`);

--
-- Indices de la tabla `llaves`
--
ALTER TABLE `llaves`
  ADD PRIMARY KEY (`id_llave`),
  ADD KEY `fk_llave_empleado` (`id_empleado`),
  ADD KEY `fk_llave_empresa` (`id_empresa`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id_rol`),
  ADD UNIQUE KEY `uq_nombre_rol` (`nombre_rol`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`),
  ADD UNIQUE KEY `uq_nombre_usuario` (`nombre_usuario`),
  ADD UNIQUE KEY `uq_email` (`email`),
  ADD KEY `fk_usuario_rol` (`id_rol`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `empleados`
--
ALTER TABLE `empleados`
  MODIFY `id_empleado` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `empresas`
--
ALTER TABLE `empresas`
  MODIFY `id_empresa` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `incidencias`
--
ALTER TABLE `incidencias`
  MODIFY `id_incidencia` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `llaves`
--
ALTER TABLE `llaves`
  MODIFY `id_llave` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id_rol` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `empleados`
--
ALTER TABLE `empleados`
  ADD CONSTRAINT `fk_empleado_empresa` FOREIGN KEY (`id_empresa`) REFERENCES `empresas` (`id_empresa`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `incidencias`
--
ALTER TABLE `incidencias`
  ADD CONSTRAINT `fk_incidencia_empleado` FOREIGN KEY (`id_empleado`) REFERENCES `empleados` (`id_empleado`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_incidencia_llave` FOREIGN KEY (`id_llave`) REFERENCES `llaves` (`id_llave`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `llaves`
--
ALTER TABLE `llaves`
  ADD CONSTRAINT `fk_llave_empleado` FOREIGN KEY (`id_empleado`) REFERENCES `empleados` (`id_empleado`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_llave_empresa` FOREIGN KEY (`id_empresa`) REFERENCES `empresas` (`id_empresa`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `fk_usuario_rol` FOREIGN KEY (`id_rol`) REFERENCES `roles` (`id_rol`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
