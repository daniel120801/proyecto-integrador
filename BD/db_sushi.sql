-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 15-07-2024 a las 20:55:20
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.0.28
CREATE DATABASE db_sushi;
use db_sushi;

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
CREATE  PROCEDURE  IF NOT EXISTS `Actualizar_pedido` (IN `idDetpedido` INT, IN `idProducto` INT, IN `nombreproducto` VARCHAR(255), IN `cantidad` INT, IN `precio` FLOAT)   BEGIN
		UPDATE producto
        SET nombre = nombreproducto
        WHERE PK_producto = idProducto;
   
        UPDATE detalle_pedido
        SET detalle_pedido.cantidad = cantidad, precio = precio WHERE PK_detpedido =IdDetpedido;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE IF NOT EXISTS `agregar_producto` (IN `id_producto` INT, IN `id_pedido` INT)   BEGIN
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
CREATE TABLE IF NOT EXISTS `categoria` (
  `PK_categoria` int(11) NOT NULL,
  `nombre_categoria` varchar(100) NOT NULL
);

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

CREATE TABLE  IF NOT EXISTS `detalle_pedido` (
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
(16, 1, 39, 2, 193),
(19, 1, 59, 3, 55),
(20, 1, 55, 2, 138);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedido`
--

CREATE TABLE IF NOT EXISTS `pedido` (
  `PK_pedido` int(11) NOT NULL,
  `FK_usuario` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `tipo_pedido` int(11) NOT NULL,
  `direccion` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `pedido`
--

INSERT INTO `pedido` (`PK_pedido`, `FK_usuario`, `fecha`, `tipo_pedido`, `direccion`) VALUES
(1, 1, '2024-05-11', 1, '123 Main St'),
(2, 2, '2024-05-12', 2, '456 Oak St'),
(3, 3, '2024-05-13', 1, '789 Pine St'),
(4, 4, '2024-05-14', 2, '321 Maple St'),
(5, 5, '2024-05-15', 1, '654 Elm St'),
(6, 6, '2024-05-16', 2, '987 Birch St'),
(7, 7, '2024-05-17', 1, '147 Cedar St'),
(8, 8, '2024-05-18', 2, '258 Spruce St'),
(9, 9, '2024-05-19', 1, '369 Fir St'),
(10, 10, '2024-05-20', 2, '741 Willow St');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE  IF NOT EXISTS `producto` (
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

CREATE TABLE IF NOT EXISTS `resenas` (
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
(10, 10, 4, 'Mochi ice cream was a nice treat.', '2024-05-10');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE IF NOT EXISTS `usuarios` (
  `PK_id` int(11) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `apellido` varchar(45) NOT NULL,
  `tipo_Usuario` varchar(45) NOT NULL,
  `Correo` varchar(150) NOT NULL,
  `contrasena` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`PK_id`, `nombre`, `apellido`, `tipo_Usuario`, `Correo`, `contrasena`) VALUES
(1, 'John', 'Doe', 'customer', 'john.doe@example.com', 'password1'),
(2, 'Jane', 'Smith', 'customer', 'jane.smith@example.com', 'password2'),
(3, 'Alice', 'Brown', 'customer', 'alice.brown@example.com', 'password3'),
(4, 'Bob', 'Johnson', 'admin', 'bob.johnson@example.com', 'password4'),
(5, 'Charlie', 'Davis', 'customer', 'charlie.davis@example.com', 'password5'),
(6, 'Eve', 'Martinez', 'customer', 'eve.martinez@example.com', 'password6'),
(7, 'Frank', 'Clark', 'admin', 'frank.clark@example.com', 'password7'),
(8, 'Grace', 'Rodriguez', 'customer', 'grace.rodriguez@example.com', 'password8'),
(9, 'Henry', 'Lewis', 'customer', 'henry.lewis@example.com', 'password9'),
(10, 'Ivy', 'Walker', 'customer', 'ivy.walker@example.com', 'password10');

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
  MODIFY `PK_detpedido` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `pedido`
--
ALTER TABLE `pedido`
  MODIFY `PK_pedido` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `PK_producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT de la tabla `resenas`
--
ALTER TABLE `resenas`
  MODIFY `PK_resenas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `PK_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

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
