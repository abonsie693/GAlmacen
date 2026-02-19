-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 26-01-2026 a las 10:14:49
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
-- Base de datos: `comercio`
--

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `generapedido`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `generapedido` (
`Proveedor` varchar(30)
,`Producto` varchar(30)
,`Unidades` bigint(12)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `pedidos`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `pedidos` (
`nombreproducto` varchar(30)
,`precio` float
,`stock` int(11)
,`Proveedor` char(9)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `prodprov`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `prodprov` (
`PRODUCTO` varchar(30)
,`PROVEEDOR` varchar(30)
);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id_producto` int(11) NOT NULL,
  `nombreproducto` varchar(30) DEFAULT NULL,
  `descripcion` varchar(100) DEFAULT NULL,
  `precio` float DEFAULT NULL,
  `stock` int(11) DEFAULT NULL,
  `foto` varchar(100) DEFAULT NULL,
  `pais` varchar(30) DEFAULT NULL,
  `CIF` char(9) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id_producto`, `nombreproducto`, `descripcion`, `precio`, `stock`, `foto`, `pais`, `CIF`) VALUES
(1, 'Procesadores i5', 'Procesadores intel i5', 90, 50, '1_i5.png', 'Corea', 'A12121212'),
(2, 'Disco SSD 1T Kinstong', 'Disco duro 1T Kinstong', 80, 10, '2_ssd-K1.png', 'España', 'B34343434'),
(3, 'Procesador Rizen 7', 'Procesador AMD Rizen 7', 150, 90, '3_ryzen7.png', 'China', 'B34343434'),
(4, 'Rartón logitech cable', 'Ratón óptico con cable', 7, 100, '4_ratonlogitech.png', 'Japón', 'A12121212'),
(5, 'Impresora Laserjet M209d', 'Impresora láser monocromo para oficina', 90, 10, '5_impresora.png', 'Japón', 'C56565656');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedores`
--

CREATE TABLE `proveedores` (
  `CIFprov` char(9) NOT NULL,
  `nombreprov` varchar(30) DEFAULT NULL,
  `direccion` varchar(100) DEFAULT NULL,
  `nacionalidad` varchar(30) DEFAULT NULL,
  `representante` varchar(30) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `telefono` varchar(9) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `proveedores`
--

INSERT INTO `proveedores` (`CIFprov`, `nombreprov`, `direccion`, `nacionalidad`, `representante`, `email`, `telefono`) VALUES
('A12121212', 'Zara', 'C/ Luz 5', 'España', 'A. Pérez', 'aperez@mail.com', '612121212'),
('B34343434', 'Mercadona', 'C/ Luna 3', 'España', 'C. García', 'cgarcia@mail.com', '634343434'),
('C56565656', 'Carrefour', 'C/ Sol 1', 'España', 'J. Sánchez', 'jsanchez@mail.com', '656565656'),
('Q3435367J', 'El Corte Inglés', 'Avda de los ingleses, 34', 'Española', 'Paco López', 'cingles@mail.com', '950323636');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id_producto`),
  ADD KEY `CIF_idx` (`CIF`);

--
-- Indices de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  ADD PRIMARY KEY (`CIFprov`);

-- --------------------------------------------------------

--
-- Estructura para la vista `generapedido`
--
DROP TABLE IF EXISTS `generapedido`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `generapedido`  AS SELECT `proveedores`.`nombreprov` AS `Proveedor`, `pedidos`.`nombreproducto` AS `Producto`, `pedidos`.`stock`* 3 AS `Unidades` FROM (`pedidos` join `proveedores`) WHERE `proveedores`.`CIFprov` = `pedidos`.`Proveedor` ORDER BY `proveedores`.`nombreprov` ASC ;

-- --------------------------------------------------------

--
-- Estructura para la vista `pedidos`
--
DROP TABLE IF EXISTS `pedidos`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `pedidos`  AS SELECT `productos`.`nombreproducto` AS `nombreproducto`, `productos`.`precio` AS `precio`, `productos`.`stock` AS `stock`, `productos`.`CIF` AS `Proveedor` FROM `productos` WHERE `productos`.`stock` <= 20 ;

-- --------------------------------------------------------

--
-- Estructura para la vista `prodprov`
--
DROP TABLE IF EXISTS `prodprov`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `prodprov`  AS SELECT `productos`.`nombreproducto` AS `PRODUCTO`, `proveedores`.`nombreprov` AS `PROVEEDOR` FROM (`productos` join `proveedores`) WHERE `productos`.`CIF` = `proveedores`.`CIFprov` ORDER BY `proveedores`.`nombreprov` ASC ;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `CIF` FOREIGN KEY (`CIF`) REFERENCES `proveedores` (`CIFprov`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
