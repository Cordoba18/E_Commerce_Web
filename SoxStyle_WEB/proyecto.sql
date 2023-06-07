-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 02-05-2023 a las 18:14:29
-- Versión del servidor: 10.4.25-MariaDB
-- Versión de PHP: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `proyecto`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carrito`
--

CREATE TABLE `carrito` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_productos` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `carrito`
--

INSERT INTO `carrito` (`id`, `id_user`, `id_productos`) VALUES
(1, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `favoritos`
--

CREATE TABLE `favoritos` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_productos` int(11) NOT NULL,
  `fecha` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `favoritos`
--

INSERT INTO `favoritos` (`id`, `id_user`, `id_productos`, `fecha`) VALUES
(1, 2, 2, '2011-11-11'),
(2, 2, 1, '2011-11-11');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `filtros_busqueda`
--

CREATE TABLE `filtros_busqueda` (
  `id` int(11) NOT NULL,
  `nombre` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `filtros_busqueda`
--

INSERT INTO `filtros_busqueda` (`id`, `nombre`) VALUES
(1, 'zapatillas'),
(2, 'pantalones'),
(3, 'camisas'),
(4, 'baloncesto');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `img` varchar(255) NOT NULL,
  `precio` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `nombre`, `img`, `precio`) VALUES
(1, 'esfera', 'img/1.png', '200000'),
(2, 'edi2', 'img/2.png', '200000'),
(3, 'edi3', 'img/3.png', '200000'),
(4, 'edi4', 'img/4.png', '200000'),
(5, 'edi5', 'img/5.png', '200000'),
(6, 'edi6', 'img/6.png', '200000'),
(7, 'edi7', 'img/7.png', '200000'),
(8, 'edi8', 'img/8.png', '200000'),
(9, 'edi9', 'img/9.png', '200000');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos_filtros`
--

CREATE TABLE `productos_filtros` (
  `id` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `id_filtro` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `productos_filtros`
--

INSERT INTO `productos_filtros` (`id`, `id_producto`, `id_filtro`) VALUES
(1, 1, 1),
(2, 2, 2),
(3, 3, 1),
(4, 4, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `rol` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id`, `rol`) VALUES
(1, 'Cliente'),
(2, 'Administrador');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `slider`
--

CREATE TABLE `slider` (
  `id` int(11) NOT NULL,
  `url` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `slider`
--

INSERT INTO `slider` (`id`, `url`) VALUES
(1, 'img/nike-baner.jpg'),
(2, 'img/converse-baner.jpg'),
(3, 'img/topper-baner.jpg'),
(4, 'img/munich-baner.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `apellido` varchar(45) NOT NULL,
  `fecha_nacimiento` date NOT NULL,
  `email` varchar(45) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `rol` int(11) NOT NULL,
  `estado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `apellido`, `fecha_nacimiento`, `email`, `pass`, `rol`, `estado`) VALUES
(1, 'Jorge Andres', 'Carrillo Pulido', '2004-11-30', 'Jorge@gmail.com', '$2y$10$tQ7V02ZdQkd7UfftnYfK7uL5AMPPN8T/ScZhmAocf17vZkKhPVURG', 1, 1),
(2, 'Andres', 'Carrillo', '2004-03-11', 'AndresJota@gmail.com', '$2y$10$GroyjXqHtIrRW30iabMfr.Bqswo/yKSyIBtIntmXz3fsni3bF4v9K', 1, 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `carrito`
--
ALTER TABLE `carrito`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_producto_carrito` (`id_productos`);

--
-- Indices de la tabla `favoritos`
--
ALTER TABLE `favoritos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ID_ID_PRODUCTOS` (`id_productos`);

--
-- Indices de la tabla `filtros_busqueda`
--
ALTER TABLE `filtros_busqueda`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `productos_filtros`
--
ALTER TABLE `productos_filtros`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_productos_filtros_productos` (`id_producto`),
  ADD KEY `id_filtros_filtro` (`id_filtro`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `slider`
--
ALTER TABLE `slider`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rol_id_rol` (`rol`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `carrito`
--
ALTER TABLE `carrito`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `favoritos`
--
ALTER TABLE `favoritos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `filtros_busqueda`
--
ALTER TABLE `filtros_busqueda`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `productos_filtros`
--
ALTER TABLE `productos_filtros`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `slider`
--
ALTER TABLE `slider`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `carrito`
--
ALTER TABLE `carrito`
  ADD CONSTRAINT `id_producto_carrito` FOREIGN KEY (`id_productos`) REFERENCES `productos` (`id`);

--
-- Filtros para la tabla `favoritos`
--
ALTER TABLE `favoritos`
  ADD CONSTRAINT `ID_ID_PRODUCTOS` FOREIGN KEY (`id_productos`) REFERENCES `productos` (`id`);

--
-- Filtros para la tabla `productos_filtros`
--
ALTER TABLE `productos_filtros`
  ADD CONSTRAINT `id_filtros_filtro` FOREIGN KEY (`id_filtro`) REFERENCES `filtros_busqueda` (`id`),
  ADD CONSTRAINT `id_productos_filtros_productos` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id`);

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `rol_id_rol` FOREIGN KEY (`rol`) REFERENCES `roles` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
