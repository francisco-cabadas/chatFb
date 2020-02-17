-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 08-01-2020 a las 00:22:01
-- Versión del servidor: 5.5.24-log
-- Versión de PHP: 7.2.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `minifb`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mensajes`
--

CREATE TABLE `mensajes` (
  `identificador` varchar(40) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `texto` varchar(300) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Volcado de datos para la tabla `mensajes`
--

INSERT INTO `mensajes` (`identificador`, `texto`, `fecha`) VALUES
('fran', 'hola1', '2020-01-07 22:50:39'),
('fran', 'houhnohn', '2020-01-07 22:50:44'),
('peter', 'holaaaaaaaaaaa', '2020-01-07 22:51:09'),
('peter', 'iyughuighuihiu', '2020-01-07 22:51:15');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id` int(11) NOT NULL,
  `identificador` varchar(40) COLLATE utf8_spanish_ci NOT NULL,
  `contrasenna` varchar(80) COLLATE utf8_spanish_ci NOT NULL,
  `codigoCookie` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `tipoUsuario` int(11) NOT NULL,
  `nombre` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `apellidos` varchar(50) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id`, `identificador`, `contrasenna`, `codigoCookie`, `tipoUsuario`, `nombre`, `apellidos`) VALUES
(1, 'fran', '1234', 'fran83132', 1, 'FRANCISCO', 'cabadas'),
(2, 'peter', '1234', 'peter96157', 0, 'señor', 'street');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `mensajes`
--
ALTER TABLE `mensajes`
  ADD PRIMARY KEY (`identificador`,`fecha`),
  ADD KEY `identificador` (`identificador`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `identificador` (`identificador`),
  ADD UNIQUE KEY `identificador_3` (`identificador`),
  ADD KEY `identificador_2` (`identificador`),
  ADD KEY `identificador_4` (`identificador`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `mensajes`
--
ALTER TABLE `mensajes`
  ADD CONSTRAINT `mensajes_ibfk_1` FOREIGN KEY (`identificador`) REFERENCES `usuario` (`identificador`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
