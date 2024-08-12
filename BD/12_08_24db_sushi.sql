-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 12-08-2024 a las 21:12:15
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
-- Base de datos: `db_sushi`
--

DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `Actualizar_pedido` (IN `idDetpedido` INT, IN `idProducto` INT, IN `nombreproducto` VARCHAR(255), IN `cantidad` INT, IN `precio` FLOAT)   BEGIN
		UPDATE producto
        SET nombre = nombreproducto
        WHERE PK_producto = idProducto;
   
        UPDATE detalle_pedido
        SET detalle_pedido.cantidad = cantidad, precio = precio WHERE PK_detpedido =IdDetpedido;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `agregar_producto` (IN `id_producto` INT, IN `id_pedido` INT)   BEGIN
    DECLARE id_ INT;
    DECLARE precio_ INT;

    SELECT PK_detpedido
    INTO id_
    FROM detalle_pedido
    WHERE FK_producto = id_producto AND FK_pedido = id_pedido;

    IF id_ IS NULL THEN
        SELECT precio
        INTO precio_
        FROM producto
        WHERE PK_producto = id_producto;

        INSERT INTO detalle_pedido (
            FK_pedido,
            FK_producto,
            cantidad,
            precio
        )
        VALUES (
            id_pedido,
            id_producto,
            1,
            precio_
        );
    ELSE
        UPDATE detalle_pedido
        SET cantidad = cantidad + 1
        WHERE PK_detpedido = id_;
    END IF;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `PK_categoria` int(11) NOT NULL,
  `nombre_categoria` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`PK_categoria`, `nombre_categoria`) VALUES
(14, 'Entradas'),
(15, 'Rollos Naturales'),
(16, 'Kombos y Postres');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_pedido`
--

CREATE TABLE `detalle_pedido` (
  `PK_detpedido` int(11) NOT NULL,
  `FK_pedido` int(11) NOT NULL,
  `FK_producto` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `detalle_pedido`
--

INSERT INTO `detalle_pedido` (`PK_detpedido`, `FK_pedido`, `FK_producto`, `cantidad`, `precio`) VALUES
(12, 1, 54, 5, 100),
(16, 1, 39, 4, 193),
(19, 1, 59, 3, 55),
(20, 1, 55, 2, 138),
(22, 15, 41, 3, 85),
(23, 15, 43, 1, 165),
(24, 16, 46, 1, 81),
(25, 17, 46, 1, 81),
(26, 18, 39, 1, 193),
(27, 18, 40, 1, 75),
(28, 19, 44, 1, 120),
(29, 20, 47, 1, 138),
(30, 20, 57, 1, 170),
(31, 20, 43, 1, 165),
(32, 20, 58, 1, 55),
(33, 20, 44, 1, 120),
(34, 21, 46, 1, 81),
(35, 21, 54, 2, 145),
(36, 21, 51, 1, 154),
(37, 21, 61, 1, 99),
(38, 21, 43, 1, 165),
(39, 22, 47, 1, 138),
(40, 22, 57, 1, 170),
(41, 23, 39, 1, 193),
(42, 24, 46, 1, 81),
(43, 25, 46, 1, 81);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedido`
--

CREATE TABLE `pedido` (
  `PK_pedido` int(11) NOT NULL,
  `FK_usuario` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `tipo_pedido` varchar(100) NOT NULL,
  `direccion` varchar(100) NOT NULL,
  `metodo_pago` varchar(100) DEFAULT NULL,
  `estado_pedido` varchar(50) NOT NULL DEFAULT 'terminado'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `pedido`
--

INSERT INTO `pedido` (`PK_pedido`, `FK_usuario`, `fecha`, `tipo_pedido`, `direccion`, `metodo_pago`, `estado_pedido`) VALUES
(1, 1, '2024-05-11', '1', '123 Main St', 'TARJETA', 'en espera'),
(2, 2, '2024-05-12', '2', '456 Oak St', 'TARJETA', 'cancelado'),
(3, 3, '2024-05-13', '1', '789 Pine St', 'TARJETA', 'terminado'),
(4, 4, '2024-05-14', '2', '321 Maple St', 'TARJETA', 'terminado'),
(5, 5, '2024-05-15', '1', '654 Elm St', 'TARJETA', 'terminado'),
(6, 6, '2024-05-16', '2', '987 Birch St', 'TARJETA', 'terminado'),
(7, 7, '2024-05-17', '1', '147 Cedar St', 'TARJETA', 'terminado'),
(8, 8, '2024-05-18', '2', '258 Spruce St', 'TARJETA', 'terminado'),
(9, 9, '2024-05-19', '1', '369 Fir St', 'TARJETA', 'terminado'),
(10, 10, '2024-05-20', '2', '741 Willow St', 'TARJETA', 'terminado'),
(15, 6, '2024-08-10', '0', '', NULL, 'en espera'),
(16, 6, '2024-08-10', '0', '', NULL, 'terminado'),
(17, 6, '2024-08-10', '0', '', NULL, 'terminado'),
(18, 14, '2024-08-11', '0', 'Calle Ejemplo 123, Ciudad', 'tarjeta', 'en espera'),
(19, 1, '2024-08-12', '0', '', 'tarjeta', 'en espera'),
(20, 6, '2024-08-12', '0', '', 'tarjeta', 'cancelado'),
(21, 6, '2024-08-12', '0', '', 'tarjeta', 'en espera'),
(22, 6, '2024-08-12', '0', 'city club', 'tarjeta', 'en espera'),
(23, 1, '2024-08-12', '0', 'sdghjkl', 'tarjeta', 'terminado'),
(24, 1, '2024-08-12', '0', '', NULL, 'terminado'),
(25, 1, '2024-08-12', '0', 'Calle Ejemplo 123, Ciudad', 'tarjeta', 'en espera');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `PK_producto` int(11) NOT NULL,
  `nombre` varchar(255) DEFAULT NULL,
  `direccion_imagen` text NOT NULL,
  `precio` int(11) NOT NULL,
  `descripcion` varchar(250) DEFAULT NULL,
  `estado` varchar(100) NOT NULL,
  `FK_categoria` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`PK_producto`, `nombre`, `direccion_imagen`, `precio`, `descripcion`, `estado`, `FK_categoria`) VALUES
(38, 'YAKI-TORI', 'img/Yaki tori.jpg', 109, 'Brochetas de pollo en salsa dulce (4)', 'No disponible', 14),
(39, 'YAKI-EBY', 'img/Yaki ehy.jpg', 193, 'Brochetas de camarón empanizadas (6)', 'disponible', 14),
(40, 'KUSHIAGE', 'img/kushiage.jpg', 75, 'Brochetas de plátano y queso crema en pasta tempura (4)', 'disponible', 14),
(41, 'KUSHIAGE TENSAI', 'img/Kushiage tensai.jpg', 85, 'Brochetas de queso empanizadas (6)', 'disponible', 14),
(42, 'CHUN-KUN', 'img/chun-kun.jpg', 112, 'Rollos de pasta ojaldre, rellenos de pollo y vegetales (3)', 'disponible', 14),
(43, 'TUNA TOWER', 'img/Tuna tower.jpg', 165, 'Torre de spicy tuna, tampico, aguacate y arroz, coronado con tobiko, masago y furikake', 'disponible', 14),
(44, 'DRAGON ', 'img/Drangon Ball.jpg', 120, 'Bola de arroz empanizada rellena de queso crema y marisco a elegir (camarón, surimi o cangrejo) con tampico', 'disponible', 14),
(45, 'EDAMAME', 'img/Edamame.jpg', 85, 'Vaina de soja verde al vapor con sal marina', 'No disponible', 14),
(46, 'VEGETARIANO ROLL', 'img/sushi-vegetariano.jpg', 81, 'Aguacate, pepino, zanahoria y queso crema por dentro', 'disponible', 15),
(47, 'SAKE ROLL', 'img/Sake roll.jpg', 138, 'Salmón por fuera, surimi, aguacate, pepino y queso crema por dentro con salsa de anguila', 'disponible', 15),
(48, 'CALIFORNIA ROLL', 'img/California Roll.jpg', 108, 'Aguacate, pepino, queso crema y mariscos a elegir por dentro', 'disponible', 15),
(49, 'CLUB SUSHI ROLL', 'img/Club sushi.jpg', 108, 'Arroz y furikake por fuera, aguacate, pepino, queso crema y marisco a elegir por dentro', 'disponible', 15),
(50, 'MEXICO ROLL', 'img/Mexico roll.jpg', 131, 'Aguacate, queso crema y masago por fuera, pepino, queso crema y marisco a elegir por dentro', 'disponible', 15),
(51, 'PACÍFICO ROLL', 'img/Pacifico Roll.jpg', 154, 'Camarón por fuera, cangrejo, aguacate, pepino y queso crema por dentro', 'disponible', 15),
(52, 'SOUTH BEACH ROLL', 'img/South Beach.jpg', 162, 'Aguacate y queso crema por fuera, camarón a la plancha por dentro, bañado con aderezo spicy y salsa de mango picosita', 'disponible', 15),
(53, 'PAU PAU ', 'img/Pau Pau.jpg', 158, 'Cangrejo por fuera, tampico, aguacate y queso crema por dentro, encima trozos de camarón empanizado con aderezo chipotle', 'disponible', 15),
(54, 'KOMBO 3', 'img/Kombo 1.jpg', 145, 'Medio rollo empanizado de camarón, surimi o pollo con pepino, aguacate y queso crema por dentro. Medio yakimeshi de pollo. Té helado o refresco', 'disponible', 16),
(55, 'KOMBO 2', 'img/Kombo 2.jpg', 138, 'Yaki-Eby (3) o Yaki-tori (3). Medio yakimeshi de pollo. Té helado o refresco', 'disponible', 16),
(56, 'KOMBO 3', 'img/Kombo 3.jpg', 181, 'Tiritas de pollo empanizadas. Medio yakimeshi de res. Té helado o refresco', 'disponible', 16),
(57, 'KOMBO 4', 'img/Kombo 4.jpg', 170, 'Medio rollo a elegir. Medio yakimeshi de pollo. Té helado o refresco', 'disponible', 16),
(58, 'Helado de Chocolate', 'img/Chocolate.jpg', 55, '', 'disponible', 16),
(59, 'Helado de Vainilla', 'img/Vainilla.jpg', 55, '', 'disponible', 16),
(60, 'Helado Tempura', 'img/Tempura.jpg', 78, '', 'disponible', 16),
(61, 'Brownie con nieve', 'img/Brownie.jpg', 99, '', 'disponible', 16);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `resenas`
--

CREATE TABLE `resenas` (
  `PK_resenas` int(11) NOT NULL,
  `FK_usuarios` int(11) NOT NULL,
  `calificacion` int(11) NOT NULL,
  `comentario` varchar(500) NOT NULL,
  `fecha` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `resenas`
--

INSERT INTO `resenas` (`PK_resenas`, `FK_usuarios`, `calificacion`, `comentario`, `fecha`) VALUES
(1, 1, 5, 'Delicious sushi rolls!', '2024-05-01'),
(2, 2, 4, 'Fresh and tasty sashimi.', '2024-05-02'),
(3, 3, 5, 'Best nigiri I ever had.', '2024-05-03'),
(4, 4, 3, 'The temaki was a bit spicy for my taste.', '2024-05-04'),
(5, 5, 5, 'Philadelphia roll is my favorite.', '2024-05-05'),
(6, 6, 4, 'Eel maki was great.', '2024-05-06'),
(7, 7, 5, 'Loved the ikura gunkan.', '2024-05-07'),
(8, 8, 4, 'Veggie roll was good.', '2024-05-08'),
(9, 9, 5, 'Combo set A is a great deal.', '2024-05-09'),
(11, 1, 5, 'Exelente servicio', '2024-08-12'),
(12, 6, 1, '', '2024-08-12'),
(13, 6, 1, '', '2024-08-12');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `PK_id` int(11) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `apellido` varchar(45) NOT NULL,
  `tipo_Usuario` varchar(45) NOT NULL DEFAULT 'visitante',
  `direccion` varchar(255) NOT NULL DEFAULT 'no asignada',
  `Correo` varchar(150) NOT NULL,
  `contrasena` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`PK_id`, `nombre`, `apellido`, `tipo_Usuario`, `direccion`, `Correo`, `contrasena`) VALUES
(1, 'Leo', 'Vargas', 'visitante', 'meico china', 'john.doe@example.com', '432'),
(2, 'Jane', 'Smith', 'visitante', 'no asignada', 'jane.smith@example.com', '123'),
(3, 'Alice', 'Brown', 'visitante', 'no asignada', 'alice.brown@example.com', '123'),
(4, 'Bob', 'Johnson', 'visitante', 'no asignada', 'bob.johnson@example.com', '123'),
(5, 'Charlie', 'Davis', 'visitante', 'no asignada', 'charlie.davis@example.com', '123'),
(6, 'Eve', 'Martinez', 'admin', 'no asignada', 'eve.martinez@example.com', '123'),
(7, 'Frank', 'Clark', 'visitante', 'no asignada', 'frank.clark@example.com', '123'),
(8, 'Grace', 'Rodriguez', 'visitante', 'no asignada', 'grace.rodriguez@example.com', '123'),
(9, 'Henry', 'Lewis', 'visitante', 'no asignada', 'henry.lewis@example.com', '123'),
(10, 'Ivy', 'Walker', 'visitante', 'no asignada', 'ivy.walker@example.com', '123'),
(11, 'Dandi', 'F', 'visitante', 'no asignada', 'asd@asd', '123'),
(12, 'Dandi', 'F', 'visitante', 'no asignada', 'asd@asd', '123'),
(13, 'asdfg', 'ghjkl', 'visitante', 'no asignada', 'fghjkl#@DFGHJKL', '123'),
(14, 'Leobardo ', 'Vargas', 'visitante', 'no asignada', 'ldvr@gmail.com', '123'),
(15, 'sghjk', 'dfghjkl;', 'visitante', 'no asignada', 'fghjkl@a', '123'),
(16, 'Dandi', 'Vargas', 'visitante', 'UTNC', 'asd@asd', '123');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`PK_categoria`),
  ADD UNIQUE KEY `PK_categoria` (`PK_categoria`);

--
-- Indices de la tabla `detalle_pedido`
--
ALTER TABLE `detalle_pedido`
  ADD PRIMARY KEY (`PK_detpedido`),
  ADD UNIQUE KEY `PK_detpedido` (`PK_detpedido`),
  ADD KEY `detalle_pedido_fk1` (`FK_pedido`),
  ADD KEY `detalle_pedido_fk2` (`FK_producto`);

--
-- Indices de la tabla `pedido`
--
ALTER TABLE `pedido`
  ADD PRIMARY KEY (`PK_pedido`),
  ADD UNIQUE KEY `PK_pedido` (`PK_pedido`),
  ADD KEY `pedido_fk1` (`FK_usuario`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`PK_producto`),
  ADD UNIQUE KEY `PK_producto` (`PK_producto`),
  ADD KEY `producto_fk5` (`FK_categoria`);

--
-- Indices de la tabla `resenas`
--
ALTER TABLE `resenas`
  ADD PRIMARY KEY (`PK_resenas`),
  ADD UNIQUE KEY `PK_resenas` (`PK_resenas`),
  ADD KEY `resenas_fk1` (`FK_usuarios`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`PK_id`),
  ADD UNIQUE KEY `PK_id` (`PK_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `PK_categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `detalle_pedido`
--
ALTER TABLE `detalle_pedido`
  MODIFY `PK_detpedido` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT de la tabla `pedido`
--
ALTER TABLE `pedido`
  MODIFY `PK_pedido` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `PK_producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT de la tabla `resenas`
--
ALTER TABLE `resenas`
  MODIFY `PK_resenas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `PK_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `detalle_pedido`
--
ALTER TABLE `detalle_pedido`
  ADD CONSTRAINT `detalle_pedido_fk1` FOREIGN KEY (`FK_pedido`) REFERENCES `pedido` (`PK_pedido`),
  ADD CONSTRAINT `detalle_pedido_fk2` FOREIGN KEY (`FK_producto`) REFERENCES `producto` (`PK_producto`);

--
-- Filtros para la tabla `pedido`
--
ALTER TABLE `pedido`
  ADD CONSTRAINT `pedido_fk1` FOREIGN KEY (`FK_usuario`) REFERENCES `usuarios` (`PK_id`);

--
-- Filtros para la tabla `producto`
--
ALTER TABLE `producto`
  ADD CONSTRAINT `producto_fk5` FOREIGN KEY (`FK_categoria`) REFERENCES `categoria` (`PK_categoria`);

--
-- Filtros para la tabla `resenas`
--
ALTER TABLE `resenas`
  ADD CONSTRAINT `resenas_fk1` FOREIGN KEY (`FK_usuarios`) REFERENCES `usuarios` (`PK_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;