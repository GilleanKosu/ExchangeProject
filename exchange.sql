-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 24-02-2019 a las 19:52:06
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
(2, 'Malaga');

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
('20190224184655', '2019-02-24 18:47:47');

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
  `ciudad_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `user`
--

INSERT INTO `user` (`id`, `password`, `email`, `roles`, `nombre_usuario`, `apellidos`, `tiempo_usuario`, `ciudad_id`) VALUES
(1, 'asdfasdf', 'asdfasdf', '[]', NULL, NULL, NULL, NULL),
(3, '$argon2i$v=19$m=1024,t=2,p=2$aHBzb2g1Z1Y1LlBNMzdKbQ$beNWKHr9uUPWaKNa7SabZKXggxL/mYK8G5naDiPu9Wc', 'judas@gmail.com', '[]', NULL, NULL, NULL, NULL),
(4, '$argon2i$v=19$m=1024,t=2,p=2$RHlVTXlvTDFOLkwzdUt1bg$UyNfUtEAg4bni2dN/f24+DLTeZyXAKvIwg5LPCib6AE', 'adfadfasdf', '[]', 'asdfadfasdf', 'adfadfadf', 0, 2),
(5, '$argon2i$v=19$m=1024,t=2,p=2$d1JqMW5vclJaNVF6VVlSdw$CNjQRCpu1ySxQFMG/2ZD9Nl4x5PwW1lRoO957dApu2c', 'guizomel@gmail.com', '[]', 'Jose', 'Melguizo', 0, 1),
(6, '$argon2i$v=19$m=1024,t=2,p=2$elN3RUUvWWc1dXVLVmMwVQ$2TysFDOonqFATJ3q3GJOgEIpTpsSUZFQXvtrKXpdiDM', 'cosa@gmail.com', '[]', 'cosacosa', 'cosacosa', 0, 1);

--
-- Índices para tablas volcadas
--

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
-- AUTO_INCREMENT de la tabla `ciudad`
--
ALTER TABLE `ciudad`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `FK_8D93D649E8608214` FOREIGN KEY (`ciudad_id`) REFERENCES `ciudad` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
