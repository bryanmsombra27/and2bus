-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 20-11-2019 a las 06:46:08
-- Versión del servidor: 10.1.40-MariaDB
-- Versión de PHP: 7.3.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `an2bus`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `basecentral`
--

CREATE TABLE `basecentral` (
  `id` int(11) NOT NULL,
  `noSerie` varchar(16) COLLATE utf8_spanish2_ci NOT NULL,
  `idUsuario` int(11) NOT NULL,
  `saldo` int(4) NOT NULL,
  `ultimaFecha` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tarjeta`
--

CREATE TABLE `tarjeta` (
  `id` int(11) NOT NULL,
  `noSerie` varchar(16) COLLATE utf8_spanish2_ci NOT NULL,
  `idUsuario` int(11) NOT NULL,
  `saldo` int(4) DEFAULT NULL,
  `ultimaFecha` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `transacciones`
--

CREATE TABLE `transacciones` (
  `noFolio` varchar(30) COLLATE utf8_spanish2_ci NOT NULL,
  `importe` int(4) NOT NULL,
  `status` varchar(10) COLLATE utf8_spanish2_ci NOT NULL,
  `code` int(10) NOT NULL,
  `cardInfo` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `fecha` date NOT NULL,
  `noSerie` varchar(16) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usrtrans`
--

CREATE TABLE `usrtrans` (
  `idUsuario` int(11) DEFAULT NULL,
  `noFolio` varchar(30) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `fecha` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `idUsuario` int(11) NOT NULL,
  `nombre` varchar(40) COLLATE utf8_spanish2_ci NOT NULL,
  `apellidoPaterno` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
  `apellidoMaterno` varchar(20) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `telefono` varchar(10) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `correoElectronico` varchar(30) COLLATE utf8_spanish2_ci NOT NULL,
  `contrasena` varchar(65) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`idUsuario`, `nombre`, `apellidoPaterno`, `apellidoMaterno`, `telefono`, `correoElectronico`, `contrasena`) VALUES
(1, 'Kevin David', 'Meneses', 'Ramirez', '7441943324', 'kdmr1998@gmail.com', '$2y$10$eChGzldZzohxQ2Vx4WigG./TTIyym8i7/AlJIXKp/iJbz.umQYWA6'),
(2, 'Yesenia Yadira', 'Ramirez', 'Moreno', '4518102', 'yesenia@gmail.com', '$2y$10$fLXYWAxoqOai.wX3qobTHOHuOcSR3zKR34QoD7tqom2gPNtd5aFey'),
(3, 'Aide', 'Mendoza', 'Meraz', '3016300', 'aide@gmail.com', '$2y$10$9w4ROJAF4kIrdq9iwE6F2.2QODFmWmCszGMqoaPnpCz35pMbnTdxO'),
(4, 'Fernando', 'Hernandez', 'Lorenzo', '1161525', 'fer@gmail.com', '$2y$10$7LPTFky3SYZnTY3WBxzbQu5nqZrt9i7iNiSiXdc/F7UnvlhfBcssy'),
(5, 'Mateo', 'Nava', 'Hernandez', '3016300', 'mateo@gmail.com', '$2y$10$m5GMdApksgqgDbsJh7tKNOXcMWwkpuIjkMtKTd8fCcKfFC4HJMpma'),
(6, 'Cutberta', 'Ruiz', 'Moreno', '3016300', 'cube@gmail.com', '$2y$10$b69c1AqVdO6tiq3uvme/6.s/TRNX9q1efl0Op5k27pg0WXyeD/Kvy'),
(7, 'Andres', 'Morales', 'jr', '4518102', 'evo@gmail.com', '$2y$10$GW98P/Vhu/1ZS/rwXGOHTOiFg9ZKqC8NVVxJ.KdVdas65XYOQZQP6');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `basecentral`
--
ALTER TABLE `basecentral`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `noSerie` (`noSerie`);

--
-- Indices de la tabla `tarjeta`
--
ALTER TABLE `tarjeta`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `noSerie` (`noSerie`),
  ADD KEY `idUsuario` (`idUsuario`);

--
-- Indices de la tabla `transacciones`
--
ALTER TABLE `transacciones`
  ADD PRIMARY KEY (`noFolio`);

--
-- Indices de la tabla `usrtrans`
--
ALTER TABLE `usrtrans`
  ADD KEY `idUsuario` (`idUsuario`),
  ADD KEY `noFolio` (`noFolio`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`idUsuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `basecentral`
--
ALTER TABLE `basecentral`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tarjeta`
--
ALTER TABLE `tarjeta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `idUsuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `tarjeta`
--
ALTER TABLE `tarjeta`
  ADD CONSTRAINT `tarjeta_ibfk_1` FOREIGN KEY (`idUsuario`) REFERENCES `usuario` (`idUsuario`);

--
-- Filtros para la tabla `usrtrans`
--
ALTER TABLE `usrtrans`
  ADD CONSTRAINT `usrtrans_ibfk_1` FOREIGN KEY (`idUsuario`) REFERENCES `usuario` (`idUsuario`),
  ADD CONSTRAINT `usrtrans_ibfk_2` FOREIGN KEY (`noFolio`) REFERENCES `transacciones` (`noFolio`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
