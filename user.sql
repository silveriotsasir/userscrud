-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 12-01-2017 a las 20:55:59
-- Versión del servidor: 10.1.16-MariaDB
-- Versión de PHP: 5.5.38

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `ciclo`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `userName` varchar(20) COLLATE utf8_bin NOT NULL,
  `password` varchar(100) COLLATE utf8_bin NOT NULL,
  `name` varchar(20) COLLATE utf8_bin NOT NULL,
  `surnames` varchar(50) COLLATE utf8_bin NOT NULL,
  `email` varchar(20) COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `user`
--

INSERT INTO `user` (`id`, `userName`, `password`, `name`, `surnames`, `email`) VALUES
(1, 'kelevra', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 'silver', 'cardona', 'silveriotsasir@icse.'),
(2, 'piteco', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 'victor', 'sarmiento', 'piteco@gmail.com'),
(3, 'yeray', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 'yeray', 'ramos', 'yeray@gmail.com'),
(4, 'carlos', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 'carlos', 'alfonso', 'carlos@gmail.com'),
(5, 'aaron', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 'aaron', 'gonzalez', 'aaron@gmail.com'),
(6, 'besay', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 'besay', 'lopez', 'besay@gmail.com'),
(7, 'abian', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 'abian', 'bor', 'abian@gmail.com');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
