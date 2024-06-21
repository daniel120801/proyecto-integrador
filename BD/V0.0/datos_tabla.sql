USE `db_sushi`;


-- Insert sample data into Categoria
INSERT INTO `Categoria` (`nombre_categoria`) VALUES
('Sushi Rolls'),
('Sashimi'),
('Nigiri'),
('Temaki'),
('Uramaki'),
('Maki'),
('Gunkan'),
('Vegetarian'),
('Combo Sets'),
('Desserts');

-- Insert sample data into producto
INSERT INTO `producto` (`nombre`, `direccion_imagen`, `precio`, `descripcion`, `FK_categoria`) VALUES
('California Roll', 'images/california_roll.jpg', 10, 'Crab, avocado, and cucumber', 1),
('Salmon Sashimi', 'images/salmon_sashimi.jpg', 15, 'Fresh salmon slices', 2),
('Tuna Nigiri', 'images/tuna_nigiri.jpg', 12, 'Tuna over rice', 3),
('Spicy Tuna Temaki', 'images/spicy_tuna_temaki.jpg', 8, 'Spicy tuna hand roll', 4),
('Philadelphia Roll', 'images/philadelphia_roll.jpg', 11, 'Salmon, cream cheese, cucumber', 5),
('Eel Maki', 'images/eel_maki.jpg', 9, 'Eel, avocado, cucumber', 6),
('Ikura Gunkan', 'images/ikura_gunkan.jpg', 14, 'Salmon roe wrapped in seaweed', 7),
('Veggie Roll', 'images/veggie_roll.jpg', 7, 'Cucumber, avocado, carrots', 8),
('Sushi Combo A', 'images/sushi_combo_a.jpg', 25, 'Assorted sushi set', 9),
('Mochi Ice Cream', 'images/mochi_ice_cream.jpg', 6, 'Japanese mochi with ice cream', 10);

-- Insert sample data into usuarios
INSERT INTO `usuarios` (`nombre`, `apellido`, `tipo_Usuario`, `Correo`, `contrasena`) VALUES
('John', 'Doe', 'customer', 'john.doe@example.com', 'password1'),
('Jane', 'Smith', 'customer', 'jane.smith@example.com', 'password2'),
('Alice', 'Brown', 'customer', 'alice.brown@example.com', 'password3'),
('Bob', 'Johnson', 'admin', 'bob.johnson@example.com', 'password4'),
('Charlie', 'Davis', 'customer', 'charlie.davis@example.com', 'password5'),
('Eve', 'Martinez', 'customer', 'eve.martinez@example.com', 'password6'),
('Frank', 'Clark', 'admin', 'frank.clark@example.com', 'password7'),
('Grace', 'Rodriguez', 'customer', 'grace.rodriguez@example.com', 'password8'),
('Henry', 'Lewis', 'customer', 'henry.lewis@example.com', 'password9'),
('Ivy', 'Walker', 'customer', 'ivy.walker@example.com', 'password10');

-- Insert sample data into resenas
INSERT INTO `resenas` (`FK_usuarios`, `calificacion`, `comentario`, `fecha`) VALUES
(1, 5, 'Delicious sushi rolls!', '2024-05-01'),
(2, 4, 'Fresh and tasty sashimi.', '2024-05-02'),
(3, 5, 'Best nigiri I ever had.', '2024-05-03'),
(4, 3, 'The temaki was a bit spicy for my taste.', '2024-05-04'),
(5, 5, 'Philadelphia roll is my favorite.', '2024-05-05'),
(6, 4, 'Eel maki was great.', '2024-05-06'),
(7, 5, 'Loved the ikura gunkan.', '2024-05-07'),
(8, 4, 'Veggie roll was good.', '2024-05-08'),
(9, 5, 'Combo set A is a great deal.', '2024-05-09'),
(10, 4, 'Mochi ice cream was a nice treat.', '2024-05-10');

-- Insert sample data into pedido
INSERT INTO `pedido` (`FK_usuario`, `fecha`, `tipo_pedido`, `direccion`) VALUES
(1, '2024-05-11', 1, '123 Main St'),
(2, '2024-05-12', 2, '456 Oak St'),
(3, '2024-05-13', 1, '789 Pine St'),
(4, '2024-05-14', 2, '321 Maple St'),
(5, '2024-05-15', 1, '654 Elm St'),
(6, '2024-05-16', 2, '987 Birch St'),
(7, '2024-05-17', 1, '147 Cedar St'),
(8, '2024-05-18', 2, '258 Spruce St'),
(9, '2024-05-19', 1, '369 Fir St'),
(10, '2024-05-20', 2, '741 Willow St');

-- Insert sample data into detalle_pedido
INSERT INTO `detalle_pedido` (`FK_pedido`, `FK_producto`, `cantidad`, `precio`) VALUES
(1, 1, 2, 20),
(2, 2, 3, 45),
(3, 3, 1, 12),
(4, 4, 4, 32),
(5, 5, 2, 22),
(6, 6, 3, 27),
(7, 7, 1, 14),
(8, 8, 5, 35),
(9, 9, 2, 50),
(10, 10, 3, 18);
