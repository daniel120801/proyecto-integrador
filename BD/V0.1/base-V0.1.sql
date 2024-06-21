CREATE TABLE IF NOT EXISTS `producto` (
	`PK_producto` int AUTO_INCREMENT NOT NULL UNIQUE,
	`nombre` int NOT NULL,
	`direccion_imagen` text NOT NULL,
	`precio` int NOT NULL,
	`descripcion` varchar(250),
	`FK_categoria` int NOT NULL,
	`estado` varchar(100) NOT NULL,
	PRIMARY KEY (`PK_producto`)
);

CREATE TABLE IF NOT EXISTS `usuarios` (
	`PK_id` int AUTO_INCREMENT NOT NULL UNIQUE,
	`nombre` varchar(45) NOT NULL,
	`apellido` varchar(45) NOT NULL,
	`tipo_Usuario` varchar(45) NOT NULL,
	`Correo` varchar(150) NOT NULL,
	`contrasena` varchar(500) NOT NULL,
	`direccion` varchar(100) NOT NULL,
	PRIMARY KEY (`PK_id`)
);

CREATE TABLE IF NOT EXISTS `Categoria` (
	`PK_categoria` int AUTO_INCREMENT NOT NULL UNIQUE,
	`nombre_categoria` varchar(100) NOT NULL,
	PRIMARY KEY (`PK_categoria`)
);

CREATE TABLE IF NOT EXISTS `resenas` (
	`PK_resenas` int AUTO_INCREMENT NOT NULL UNIQUE,
	`FK_usuarios` int NOT NULL,
	`calificacion` int NOT NULL,
	`comentario` varchar(500) NOT NULL,
	`fecha` date NOT NULL,
	PRIMARY KEY (`PK_resenas`)
);

CREATE TABLE IF NOT EXISTS `pedido` (
	`PK_pedido` int AUTO_INCREMENT NOT NULL UNIQUE,
	`FK_usuario` int NOT NULL,
	`fecha` date NOT NULL,
	`tipo_pedido` int NOT NULL,
	`direccion` varchar(100) NOT NULL,
	`metodo_pago` varchar(100) NOT NULL,
	PRIMARY KEY (`PK_pedido`)
);

CREATE TABLE IF NOT EXISTS `detalle_pedido` (
	`PK_detpedido` int AUTO_INCREMENT NOT NULL UNIQUE,
	`FK_pedido` int NOT NULL,
	`FK_producto` int NOT NULL,
	`cantidad` int NOT NULL,
	`precio` int NOT NULL,
	PRIMARY KEY (`PK_detpedido`)
);

ALTER TABLE `producto` ADD CONSTRAINT `producto_fk5` FOREIGN KEY (`FK_categoria`) REFERENCES `Categoria`(`PK_categoria`);


ALTER TABLE `resenas` ADD CONSTRAINT `resenas_fk1` FOREIGN KEY (`FK_usuarios`) REFERENCES `usuarios`(`PK_id`);
ALTER TABLE `pedido` ADD CONSTRAINT `pedido_fk1` FOREIGN KEY (`FK_usuario`) REFERENCES `usuarios`(`PK_id`);
ALTER TABLE `detalle_pedido` ADD CONSTRAINT `detalle_pedido_fk1` FOREIGN KEY (`FK_pedido`) REFERENCES `pedido`(`PK_pedido`);

ALTER TABLE `detalle_pedido` ADD CONSTRAINT `detalle_pedido_fk2` FOREIGN KEY (`FK_producto`) REFERENCES `producto`(`PK_producto`);