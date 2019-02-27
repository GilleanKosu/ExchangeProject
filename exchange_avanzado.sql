-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 27-02-2019 a las 10:43:40
-- Versión del servidor: 10.1.35-MariaDB
-- Versión de PHP: 7.2.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `exchange`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `id` int(11) NOT NULL,
  `nombre_categoria` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`id`, `nombre_categoria`) VALUES
(1, 'Peluqueria'),
(2, 'Jardineria'),
(3, 'Reparacion'),
(4, 'Enseñanza');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ciudad`
--

CREATE TABLE `ciudad` (
  `id` int(11) NOT NULL,
  `nombre_c` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `ciudad`
--

INSERT INTO `ciudad` (`id`, `nombre_c`) VALUES
(1, 'Barcelona'),
(2, 'Malaga'),
(3, 'Granada');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migration_versions`
--

CREATE TABLE `migration_versions` (
  `version` varchar(14) COLLATE utf8mb4_unicode_ci NOT NULL,
  `executed_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `migration_versions`
--

INSERT INTO `migration_versions` (`version`, `executed_at`) VALUES
('20190222154657', '2019-02-22 15:47:14'),
('20190222170926', '2019-02-22 17:09:36'),
('20190222171649', '2019-02-22 17:18:04'),
('20190224113942', '2019-02-24 11:40:44'),
('20190224115430', '2019-02-24 11:55:03'),
('20190224132652', '2019-02-24 13:27:14'),
('20190224184655', '2019-02-24 18:47:47'),
('20190225100449', '2019-02-25 10:05:17'),
('20190226011107', '2019-02-26 01:12:28'),
('20190226012608', '2019-02-26 01:26:23'),
('20190226013002', '2019-02-26 01:30:28'),
('20190226073512', '2019-02-26 07:35:42'),
('20190226073618', '2019-02-26 07:36:40'),
('20190226095418', '2019-02-26 09:55:28'),
('20190227010145', '2019-02-27 01:02:28');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servicio`
--

CREATE TABLE `servicio` (
  `id` int(11) NOT NULL,
  `id_categoria_id` int(11) DEFAULT NULL,
  `duracion_servicio` int(11) DEFAULT NULL,
  `descripcion_servicio` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `horas_dia` int(11) DEFAULT NULL,
  `hora_servicio` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ciudad_servicio_id` int(11) DEFAULT NULL,
  `date` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `valoracion` decimal(3,0) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `servicio`
--

INSERT INTO `servicio` (`id`, `id_categoria_id`, `duracion_servicio`, `descripcion_servicio`, `horas_dia`, `hora_servicio`, `ciudad_servicio_id`, `date`, `valoracion`) VALUES
(1, 1, 1, 'Corte de pelo y tinte', 2, NULL, 1, '20190220', '0'),
(2, 1, 5, 'adsfasdfafd', 5, NULL, 1, '20190222', '0'),
(3, 2, 3, 'Un fantastico servicio de jardineria', 3, NULL, 3, '20190227', '5'),
(4, 4, 2, 'Doy clases particulares a domicilio por 10 euros la hora', 2, NULL, 1, '20190225', '0'),
(5, 1, 3, 'asdfasdfasdf', 3, NULL, 3, '20190226', '0'),
(6, 3, 3, 'hola que tal estamos', 3, NULL, 2, '20190226', '0'),
(7, 1, 4, 'Lujan', 4, NULL, 2, '20190226', '0'),
(8, 1, 5, 'asdfasdfasdfasdfasdfadfasdfasdfasdfadfasdfasdfasdfasdfasdf', 5, NULL, 1, '20190227', '2'),
(9, 1, 1, 'El gordo sabe de lo que habla', 1, NULL, 2, '20190227', '3'),
(10, 4, 1, 'Enseño a tu hijo a fumar marihuana', 1, NULL, 3, '20190227', '4'),
(11, 1, 3, 'funciona ya joder', 3, NULL, 2, '20190227', '1'),
(12, 1, 1, 'COSA', 1, NULL, 2, '20190227', NULL),
(13, 4, 4, 'bababababs', 4, NULL, 2, '20190227', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servicio_user`
--

CREATE TABLE `servicio_user` (
  `servicio_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `servicio_user`
--

INSERT INTO `servicio_user` (`servicio_id`, `user_id`) VALUES
(1, 6),
(6, 6),
(7, 6),
(8, 6),
(9, 6),
(10, 6),
(11, 6),
(12, 6),
(13, 6);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `nombre_usuario` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `apellidos` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tiempo_usuario` int(11) DEFAULT NULL,
  `ciudad_id` int(11) DEFAULT NULL,
  `imagen_usuario` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `user`
--

INSERT INTO `user` (`id`, `password`, `email`, `roles`, `nombre_usuario`, `apellidos`, `tiempo_usuario`, `ciudad_id`, `imagen_usuario`) VALUES
(4, '$argon2i$v=19$m=1024,t=2,p=2$RHlVTXlvTDFOLkwzdUt1bg$UyNfUtEAg4bni2dN/f24+DLTeZyXAKvIwg5LPCib6AE', 'adfadfasdf', '[]', 'asdfadfasdf', 'adfadfadf', 0, 2, NULL),
(6, '$argon2i$v=19$m=1024,t=2,p=2$NEw1NS9hRFI4Q1l4TERTZg$4Vk8BOBRtELg6Fw4J/R1Ez5ry9IrQgv/ig4PDRajmmE', 'cosa@gmail.com', '[]', 'coso', 'cosacosa', 0, 2, ''),
(7, '$argon2i$v=19$m=1024,t=2,p=2$SXEuQWpuc3U1ekVSbTl3SA$gq1l3OCHO9GtO0gipNFguUTu1zEZjgmXgeI0VL73mTc', 'antonio@gmail.com', '[]', 'adfadsfasdf', 'admin', 0, 1, 'Screenshot_3.png'),
(8, '$argon2i$v=19$m=1024,t=2,p=2$TndtcE9xQ2MvRjJvYm50TA$Je26Yr16c4K75q8gfKjGv1EWHhBTIoKQ1PYHQLywqEA', 'antonio123@gmail.com', '[]', 'Antonio', 'Garcia', 0, 2, NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `ciudad`
--
ALTER TABLE `ciudad`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `migration_versions`
--
ALTER TABLE `migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Indices de la tabla `servicio`
--
ALTER TABLE `servicio`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_CB86F22A10560508` (`id_categoria_id`),
  ADD KEY `IDX_CB86F22A9E424EC2` (`ciudad_servicio_id`);

--
-- Indices de la tabla `servicio_user`
--
ALTER TABLE `servicio_user`
  ADD PRIMARY KEY (`servicio_id`,`user_id`),
  ADD KEY `IDX_BA1E266C71CAA3E7` (`servicio_id`),
  ADD KEY `IDX_BA1E266CA76ED395` (`user_id`);

--
-- Indices de la tabla `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_8D93D649E7927C74` (`email`),
  ADD KEY `IDX_8D93D649E8608214` (`ciudad_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `ciudad`
--
ALTER TABLE `ciudad`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `servicio`
--
ALTER TABLE `servicio`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `servicio`
--
ALTER TABLE `servicio`
  ADD CONSTRAINT `FK_CB86F22A10560508` FOREIGN KEY (`id_categoria_id`) REFERENCES `categoria` (`id`),
  ADD CONSTRAINT `FK_CB86F22A9E424EC2` FOREIGN KEY (`ciudad_servicio_id`) REFERENCES `ciudad` (`id`);

--
-- Filtros para la tabla `servicio_user`
--
ALTER TABLE `servicio_user`
  ADD CONSTRAINT `FK_BA1E266C71CAA3E7` FOREIGN KEY (`servicio_id`) REFERENCES `servicio` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_BA1E266CA76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `FK_8D93D649E8608214` FOREIGN KEY (`ciudad_id`) REFERENCES `ciudad` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
