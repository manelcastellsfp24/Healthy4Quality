-- phpMyAdmin SQL Dump
-- version 5.2.1deb3
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 08-01-2026 a las 11:34:18
-- Versión del servidor: 8.0.44-0ubuntu0.24.04.1
-- Versión de PHP: 8.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `Restaurante`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Categoria`
--

CREATE TABLE `Categoria` (
  `id_categoria` int NOT NULL,
  `nombre` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `Categoria`
--

INSERT INTO `Categoria` (`id_categoria`, `nombre`) VALUES
(1, 'Bowls'),
(3, 'Entrantes'),
(4, 'Postres'),
(5, 'Bebidas');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Linea_Pedido`
--

CREATE TABLE `Linea_Pedido` (
  `id_linea` int NOT NULL,
  `id_pedido` int DEFAULT NULL,
  `id_producto` int DEFAULT NULL,
  `cantidad` int DEFAULT NULL,
  `precio_unitario` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `Linea_Pedido`
--

INSERT INTO `Linea_Pedido` (`id_linea`, `id_pedido`, `id_producto`, `cantidad`, `precio_unitario`) VALUES
(2, 4, 1, 1, 9.50),
(3, 5, 1, 1, 9.50),
(4, 6, 1, 2, 9.50),
(5, 7, 1, 1, 9.50),
(6, 8, 1, 1, 9.50),
(7, 9, 1, 1, 9.50),
(8, 9, 2, 1, 7.20),
(9, 9, 3, 1, 4.80),
(10, 10, 1, 1, 9.50),
(11, 11, 2, 1, 5.50),
(12, 11, 1, 1, 8.00),
(13, 11, 9, 1, 7.00),
(14, 12, 1, 1, 8.00),
(15, 13, 1, 2, 8.00),
(16, 14, 1, 1, 8.00),
(17, 15, 4, 1, 2.00),
(18, 15, 10, 1, 7.00),
(19, 16, 4, 1, 2.00),
(20, 17, 10, 1, 7.00),
(21, 17, 9, 1, 7.00),
(22, 17, 1, 1, 8.00),
(23, 18, 10, 1, 7.00),
(24, 18, 9, 1, 7.00),
(25, 18, 1, 1, 8.00),
(26, 19, 10, 1, 7.00),
(27, 19, 9, 1, 7.00),
(28, 19, 1, 1, 8.00),
(29, 20, 10, 1, 7.00),
(30, 20, 9, 1, 7.00),
(31, 20, 1, 1, 8.00),
(32, 21, 10, 1, 7.00),
(33, 21, 9, 1, 7.00),
(34, 21, 1, 1, 8.00),
(35, 22, 2, 1, 5.50),
(36, 22, 3, 1, 2.50),
(37, 23, 4, 1, 2.00),
(38, 23, 3, 1, 2.50),
(39, 24, 3, 1, 2.50);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Log`
--

CREATE TABLE `Log` (
  `id_log` int NOT NULL,
  `accion` varchar(100) DEFAULT NULL,
  `descripcion` text,
  `fecha` datetime DEFAULT NULL,
  `id_usuario` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `LogAccion`
--

CREATE TABLE `LogAccion` (
  `id_log` int NOT NULL,
  `id_usuario` int DEFAULT NULL,
  `accion` varchar(255) NOT NULL,
  `detalles` text,
  `fecha` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `LogAccion`
--

INSERT INTO `LogAccion` (`id_log`, `id_usuario`, `accion`, `detalles`, `fecha`) VALUES
(1, 2, 'Crear producto', 'Producto creado: Bebida energética natural, precio: 2', '2025-12-03 18:01:22'),
(2, 2, 'Crear producto', 'Producto creado: Smoothie Red Power, precio: 2.5', '2025-12-03 18:33:26'),
(3, 2, 'Crear producto', 'Producto creado: Smoothie Green Fuel, precio: 2.5', '2025-12-03 18:34:59'),
(4, 2, 'Crear producto', 'Producto creado: Hummus, precio: 5.5', '2025-12-03 18:35:40'),
(5, 2, 'Crear producto', 'Producto creado: Ensalada, precio: 5.5', '2025-12-03 18:37:33'),
(6, 2, 'Editar producto', 'ID: 1, nuevo nombre: Bowl de salmón, nuevo precio: 8', '2025-12-03 18:39:01'),
(7, 2, 'Crear producto', 'Producto creado: Bowl de pollo, precio: 7', '2025-12-03 18:41:01'),
(8, 2, 'Eliminar producto', 'ID producto eliminado: 8', '2025-12-03 18:48:35'),
(9, 2, 'Editar producto', 'ID: 2, nuevo nombre: Ensalada, nuevo precio: 5.5', '2025-12-03 18:49:12'),
(10, 2, 'Crear producto', 'Producto creado: Bowl de merluza, precio: 7', '2025-12-03 18:50:21'),
(11, 2, 'Eliminar producto', 'ID producto eliminado: 6', '2025-12-03 18:52:05'),
(12, 2, 'Editar producto', 'ID: 3, nuevo nombre: Smoothie green fuel, nuevo precio: 2.5', '2025-12-03 18:52:51'),
(13, 2, 'Crear producto', 'Producto creado: Tortitas, precio: 3', '2025-12-03 18:53:33'),
(14, 2, 'Crear producto', 'Producto creado: Helado, precio: 2.5', '2025-12-03 18:53:55'),
(15, 2, 'Editar producto', 'ID: 11, nuevo nombre: Tortitas, nuevo precio: 3.5', '2025-12-03 18:54:15'),
(16, 2, 'Editar producto', 'ID: 1, nuevo nombre: Bowl de salmón, nuevo precio: 8.00', '2025-12-04 17:21:19'),
(17, NULL, 'Actualizar pedido', 'Pedido 3 cambiado a estado \'preparando\'', '2025-12-07 16:34:42'),
(18, NULL, 'Eliminar pedido', 'Pedido 3 eliminado', '2025-12-07 16:35:36');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Oferta`
--

CREATE TABLE `Oferta` (
  `id_oferta` int NOT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `tipo` varchar(50) DEFAULT NULL,
  `valor` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Pedido`
--

CREATE TABLE `Pedido` (
  `id_pedido` int NOT NULL,
  `fecha` datetime DEFAULT NULL,
  `total` decimal(10,2) DEFAULT NULL,
  `estado` varchar(50) DEFAULT NULL,
  `id_usuario` int DEFAULT NULL,
  `descuento` decimal(10,2) NOT NULL DEFAULT '0.00',
  `total_final` decimal(10,2) NOT NULL DEFAULT '0.00',
  `oferta_aplicada` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `Pedido`
--

INSERT INTO `Pedido` (`id_pedido`, `fecha`, `total`, `estado`, `id_usuario`, `descuento`, `total_final`, `oferta_aplicada`) VALUES
(4, '2025-11-25 12:21:37', 9.50, 'pendiente', NULL, 0.00, 0.00, NULL),
(5, '2025-11-25 16:16:08', 9.50, 'pendiente', NULL, 0.00, 0.00, NULL),
(6, '2025-11-25 18:50:16', 19.00, 'pendiente', NULL, 0.00, 0.00, NULL),
(7, '2025-11-25 19:10:30', 9.50, 'pendiente', NULL, 0.00, 0.00, NULL),
(8, '2025-11-26 19:30:26', 9.50, 'pendiente', NULL, 0.00, 0.00, NULL),
(9, '2025-11-26 19:41:05', 21.50, 'pendiente', NULL, 0.00, 0.00, NULL),
(10, '2025-11-30 22:50:08', 9.50, 'pendiente', NULL, 0.00, 0.00, NULL),
(11, '2025-12-04 17:18:49', 20.50, 'pendiente', NULL, 0.00, 0.00, NULL),
(12, '2025-12-07 16:33:25', 8.00, 'pendiente', NULL, 0.00, 0.00, NULL),
(13, '2025-12-07 16:50:40', 16.00, 'pendiente', 2, 0.00, 0.00, NULL),
(14, '2025-12-07 16:52:53', 8.00, 'pendiente', 2, 0.00, 0.00, NULL),
(15, '2025-12-20 16:39:42', 9.00, 'pendiente', 3, 0.00, 0.00, NULL),
(16, '2025-12-20 16:41:02', 2.00, 'pendiente', 3, 0.00, 0.00, NULL),
(17, '2025-12-29 13:34:29', 22.00, 'pendiente', 3, 3.30, 18.70, 'Healthy lunch 15%'),
(18, '2025-12-29 13:42:10', 22.00, 'pendiente', 3, 0.00, 22.00, NULL),
(19, '2025-12-29 14:00:59', 22.00, 'pendiente', 3, 0.00, 22.00, NULL),
(20, '2025-12-30 00:17:57', 22.00, 'pendiente', 3, 0.00, 22.00, NULL),
(21, '2025-12-30 00:28:50', 15.00, 'pendiente', 3, 0.00, 15.00, NULL),
(22, '2025-12-31 15:56:10', 6.80, 'pendiente', 3, 0.00, 6.80, NULL),
(23, '2026-01-07 15:18:24', 3.82, 'pendiente', 3, 0.00, 3.82, NULL),
(24, '2026-01-07 15:32:08', 2.12, 'pendiente', 3, 0.00, 2.12, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Producto`
--

CREATE TABLE `Producto` (
  `id_producto` int NOT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `descripcion` text,
  `precio` decimal(10,2) DEFAULT NULL,
  `id_categoria` int DEFAULT NULL,
  `id_oferta` int DEFAULT NULL,
  `imagen` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `Producto`
--

INSERT INTO `Producto` (`id_producto`, `nombre`, `descripcion`, `precio`, `id_categoria`, `id_oferta`, `imagen`) VALUES
(1, 'Bowl de salmón', 'Bowl de salmón a la plancha\r\ncon quinoa, espinacas,\r\naguacate y huevo mollet.', 8.00, 1, NULL, 'Salmon.png'),
(2, 'Ensalada', 'Ensalada fresca con hojas verdes,\r\ntomate cherry, pepino y dados de\r\nqueso feta.', 5.50, 3, NULL, 'Ensalada.png'),
(3, 'Smoothie green fuel', 'Suave y cremoso, elaborado\r\ncon plátano, espinacas y\r\nproteína vegetal.', 2.50, 5, NULL, 'BebidaVerde.png'),
(4, 'Bebida energética natural', 'Refresca, activa y recarga tu\r\nenergía con nuestra mezcla sin\r\nazúcares añadidos.', 2.00, 5, NULL, 'BebidaEnergetica.png'),
(5, 'Smoothie Red Power', 'Refrescante combinación de frutos rojos, plátano y proteína vegetal.', 2.50, 5, NULL, 'BebidaRoja.png'),
(7, 'Hummus', 'Hummus cremoso elaborado\r\ncon garbanzos y aceite de oliva\r\nvirgen extra, acompañado de\r\nbastones de zanahoria fresca.', 5.50, 3, NULL, 'Hummus.png'),
(9, 'Bowl de pollo', 'Bowl de pollo a la plancha con\r\nquinoa, aguacate, espinacas y\r\ntomates cherry.', 7.00, 1, NULL, 'Pollo.png'),
(10, 'Bowl de merluza', 'Merluza a la plancha con pasta integral, guacamole y\r\naguacate.', 7.00, 1, NULL, 'Merluza.png'),
(11, 'Tortitas', 'Tortitas integrales con crema de\r\ncacahuete, fresas, arándanos y\r\ngranola.', 3.50, 4, NULL, 'Tortitas.png'),
(12, 'Helado', 'Helado proteico acompañado de\r\nfresas, arándanos y almendras\r\nlaminadas.', 2.50, 4, NULL, 'Helado.png');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Usuario`
--

CREATE TABLE `Usuario` (
  `id_usuario` int NOT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `contraseña` varchar(100) DEFAULT NULL,
  `telefono` varchar(30) DEFAULT NULL,
  `rol` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `Usuario`
--

INSERT INTO `Usuario` (`id_usuario`, `nombre`, `email`, `contraseña`, `telefono`, `rol`) VALUES
(2, 'Manel', 'castellsmanel.00@gmail.com', 'Mcfly1995', '663615621', 'admin'),
(3, 'Manel', 'manelcastellsfp24@ibf.cat', '$2y$10$wfe2wRkdHplAqYmS4idW3.eioDFXTmAXh.2vfFodNakkL//7K5JIm', NULL, 'admin'),
(4, 'Manel', 'castellsmanel.00@gmail.com', '$2y$10$tmNsSR4BJiUo7DEpL5k3n.t8aW15TugeCfZdWO.xqLt1EZaZYirMW', NULL, 'cliente');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `Categoria`
--
ALTER TABLE `Categoria`
  ADD PRIMARY KEY (`id_categoria`);

--
-- Indices de la tabla `Linea_Pedido`
--
ALTER TABLE `Linea_Pedido`
  ADD PRIMARY KEY (`id_linea`),
  ADD KEY `id_pedido` (`id_pedido`),
  ADD KEY `id_producto` (`id_producto`);

--
-- Indices de la tabla `Log`
--
ALTER TABLE `Log`
  ADD PRIMARY KEY (`id_log`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `LogAccion`
--
ALTER TABLE `LogAccion`
  ADD PRIMARY KEY (`id_log`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `Oferta`
--
ALTER TABLE `Oferta`
  ADD PRIMARY KEY (`id_oferta`);

--
-- Indices de la tabla `Pedido`
--
ALTER TABLE `Pedido`
  ADD PRIMARY KEY (`id_pedido`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `Producto`
--
ALTER TABLE `Producto`
  ADD PRIMARY KEY (`id_producto`),
  ADD KEY `id_categoria` (`id_categoria`),
  ADD KEY `id_oferta` (`id_oferta`);

--
-- Indices de la tabla `Usuario`
--
ALTER TABLE `Usuario`
  ADD PRIMARY KEY (`id_usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `Categoria`
--
ALTER TABLE `Categoria`
  MODIFY `id_categoria` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `Linea_Pedido`
--
ALTER TABLE `Linea_Pedido`
  MODIFY `id_linea` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT de la tabla `Log`
--
ALTER TABLE `Log`
  MODIFY `id_log` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `LogAccion`
--
ALTER TABLE `LogAccion`
  MODIFY `id_log` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `Oferta`
--
ALTER TABLE `Oferta`
  MODIFY `id_oferta` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `Pedido`
--
ALTER TABLE `Pedido`
  MODIFY `id_pedido` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT de la tabla `Producto`
--
ALTER TABLE `Producto`
  MODIFY `id_producto` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `Usuario`
--
ALTER TABLE `Usuario`
  MODIFY `id_usuario` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `Linea_Pedido`
--
ALTER TABLE `Linea_Pedido`
  ADD CONSTRAINT `Linea_Pedido_ibfk_1` FOREIGN KEY (`id_pedido`) REFERENCES `Pedido` (`id_pedido`),
  ADD CONSTRAINT `Linea_Pedido_ibfk_2` FOREIGN KEY (`id_producto`) REFERENCES `Producto` (`id_producto`);

--
-- Filtros para la tabla `Log`
--
ALTER TABLE `Log`
  ADD CONSTRAINT `Log_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `Usuario` (`id_usuario`);

--
-- Filtros para la tabla `LogAccion`
--
ALTER TABLE `LogAccion`
  ADD CONSTRAINT `LogAccion_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `Usuario` (`id_usuario`);

--
-- Filtros para la tabla `Pedido`
--
ALTER TABLE `Pedido`
  ADD CONSTRAINT `Pedido_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `Usuario` (`id_usuario`);

--
-- Filtros para la tabla `Producto`
--
ALTER TABLE `Producto`
  ADD CONSTRAINT `Producto_ibfk_1` FOREIGN KEY (`id_categoria`) REFERENCES `Categoria` (`id_categoria`),
  ADD CONSTRAINT `Producto_ibfk_2` FOREIGN KEY (`id_oferta`) REFERENCES `Oferta` (`id_oferta`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
