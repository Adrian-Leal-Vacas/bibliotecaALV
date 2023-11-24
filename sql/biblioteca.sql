-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 16-11-2023 a las 14:12:08
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

DROP DATABASE IF EXISTS `biblioteca`;
CREATE DATABASE `biblioteca`;
USE `biblioteca`;

--
-- Base de datos: `biblioteca`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `libros`
--

CREATE TABLE `libros` (
  `id` int(11) NOT NULL,
  `isbn` varchar(30) NOT NULL,
  `titulo` varchar(100) NOT NULL,
  `autor` varchar(100) NOT NULL,
  `editorial` varchar(60) NOT NULL,
  `enPrestamo` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Esta es la tabla de registro de los libros';

--
-- Volcado de datos para la tabla `libros`
--

INSERT INTO `libros` (`id`, `isbn`, `titulo`, `autor`, `editorial`, `enPrestamo`) VALUES
(1, '978-84-08-26792-8', 'El arte de ser nosotros', 'Inma Rubiales', 'Editorial Planeta', NULL),
(2, '978-1982118100', 'To Kill a Mockingbird', 'Harper Lee', 'Harper Perennial Modern Classics', NULL),
(3, '978-0544003415', 'The Lord of the Rings', 'J.R.R. Tolkien', 'Houghton Mifflin Harcourt', NULL),
(4, '978-0061120084', '1984', 'George Orwell', 'HarperCollins', NULL),
(5, '978-1400032716', 'The Great Gatsby', 'F. Scott Fitzgerald', 'Scribner', NULL),
(6, '978-0062315007', 'The Catcher in the Rye', 'J.D. Salinger', 'Little, Brown and Company', NULL),
(7, '978-0385490814', 'To Kill a Mockingbird', 'Dan Brown', 'Anchor', NULL),
(8, '978-0307277671', 'Pride and Prejudice', 'Jane Austen', 'Vintage Classics', NULL),
(9, '978-0141987534', 'War and Peace', 'Leo Tolstoy', 'Penguin Classics', NULL),
(10, '978-0451524935', 'Moby-Dick', 'Herman Melville', 'Signet Classics', NULL),
(11, '978-0060558129', 'The Hobbit', 'J.R.R. Tolkien', 'HarperCollins', NULL),
(12, '978-0743273565', 'The Great Gatsby', 'F. Scott Fitzgerald', 'Scribner', NULL),
(13, '978-0679645698', 'The Catcher in the Rye', 'J.D. Salinger', 'Little, Brown and Company', NULL),
(14, '978-0553803716', 'To Kill a Mockingbird', 'Dan Brown', 'Doubleday', NULL),
(15, '978-0385514239', 'Pride and Prejudice', 'Jane Austen', 'Delacorte Press', NULL),
(16, '978-0140449492', 'War and Peace', 'Leo Tolstoy', 'Penguin Classics', NULL),
(17, '978-0142000670', 'Moby-Dick', 'Herman Melville', 'Penguin Classics', NULL),
(18, '978-0345538376', 'The Hobbit', 'J.R.R. Tolkien', 'Del Rey', NULL),
(19, '978-0199535603', 'The Great Gatsby', 'F. Scott Fitzgerald', 'Oxford University Press', NULL),
(20, '978-0316769532', 'The Catcher in the Rye', 'J.D. Salinger', 'Back Bay Books', NULL),
(21, '978-0140620624', 'To Kill a Mockingbird', 'Dan Brown', 'Penguin Classics', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `prestamos`
--

CREATE TABLE `prestamos` (
  `id_usuario` int(11) NOT NULL,
  `id_libros` int(11) NOT NULL,
  `finPrestamo` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Esta es la tabla de prestamos de los libros';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `apellido1` varchar(30) NOT NULL,
  `apellido2` varchar(30) DEFAULT NULL,
  `usuario` varchar(30) NOT NULL,
  `contraseña` varchar(200) NOT NULL,
  `email` varchar(60) NOT NULL,
  `fechaReg` date DEFAULT curdate(),
  `rol` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Esta es la tabla de registro de los usuarios';

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `apellido1`, `apellido2`, `usuario`, `contraseña`, `email`, `fechaReg`, `rol`) VALUES
(1, 'adrian', 'leal', 'Vacas', 'adrian', '$2y$10$sK1V3EsqdWZjF/kQTkC5muZ1WGLKnQIIpwoIoURORtsVbDcDmJSPu', 'leal.adrian.vacas@gmail.com', '2023-10-12', 'administrador'),
(2, 'usuario', 'usuario', '', 'usuario', '$2y$10$/EBGDjeET8AMlsa5Rl/qVOzv23SncGWhuLsM0bv7/bwnB8HUdHsIC', 'usuario@gmail.com', '2023-10-31', 'lector');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `libros`
--
ALTER TABLE `libros`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `isbn` (`isbn`) USING BTREE;

--
-- Indices de la tabla `prestamos`
--
ALTER TABLE `prestamos`
  ADD PRIMARY KEY (`id_usuario`,`id_libros`),
  ADD KEY `id_libros` (`id_libros`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `usuario` (`usuario`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `libros`
--
ALTER TABLE `libros`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `prestamos`
--
ALTER TABLE `prestamos`
  ADD CONSTRAINT `prestamos_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`),
  ADD CONSTRAINT `prestamos_ibfk_2` FOREIGN KEY (`id_libros`) REFERENCES `libros` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
