-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Feb 02, 2026 at 04:15 AM
-- Server version: 9.4.0
-- PHP Version: 8.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `estacion90`
--

-- --------------------------------------------------------

--
-- Table structure for table `asignaciones_reparto`
--

CREATE TABLE `asignaciones_reparto` (
  `id` int NOT NULL,
  `id_pedido` int NOT NULL,
  `id_usuario` int NOT NULL,
  `fecha_asignacion` datetime NOT NULL,
  `estado` varchar(50) NOT NULL DEFAULT 'ASIGNADO',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `asignaciones_reparto`
--

INSERT INTO `asignaciones_reparto` (`id`, `id_pedido`, `id_usuario`, `fecha_asignacion`, `estado`, `created_at`, `updated_at`) VALUES
(1, 3, 17, '2025-04-07 12:00:00', 'EN_CAMINO', '2025-04-10 03:13:26', '2025-04-10 03:13:26'),
(2, 4, 18, '2025-04-07 13:00:00', 'ENTREGADO', '2025-04-10 03:13:26', '2025-04-10 03:13:26'),
(3, 10, 17, '2025-04-07 14:00:00', 'ASIGNADO', '2025-04-10 03:13:26', '2025-04-10 03:13:26');

-- --------------------------------------------------------

--
-- Table structure for table `banners`
--

CREATE TABLE `banners` (
  `id` int NOT NULL,
  `url_imagen` varchar(300) NOT NULL,
  `link` varchar(300) NOT NULL COMMENT 'link a redireccion',
  `tipo` int DEFAULT NULL COMMENT '1:banner ,\r\n2:menu15 ,\r\n3:menu20 ,',
  `fecha_inicio` date DEFAULT NULL,
  `fecha_fin` date DEFAULT NULL,
  `id_user_create` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `banners`
--

INSERT INTO `banners` (`id`, `url_imagen`, `link`, `tipo`, `fecha_inicio`, `fecha_fin`, `id_user_create`, `created_at`, `updated_at`) VALUES
(1, '1.png', '/inicio', 1, '2025-07-08', '2026-12-30', 1, '2025-06-06 07:24:39', '2025-08-01 17:22:07'),
(2, '2.png', '/inicio', 1, '2025-07-01', '2026-12-31', 1, '2025-06-06 07:24:39', '2025-08-01 17:22:18'),
(3, '3.png', '/inicio', 1, '2025-07-01', '2025-08-03', 2, '2025-06-06 07:24:39', '2025-07-28 19:45:00'),
(8, '15.png', '', 2, '2025-07-09', '2026-03-13', 23, '2025-07-09 16:49:02', '2025-07-09 16:49:02'),
(9, '20.png', '', 3, '2025-07-09', '2026-05-15', 23, '2025-07-09 16:49:21', '2025-07-09 16:49:21'),
(11, '1753837180_27.png', '', 1, '2025-07-01', '2025-07-08', 1, '2025-07-30 00:59:40', '2025-07-30 01:53:22');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('laravel_cache_356a192b7913b04c54574d18c28d46e6395428ab', 'i:3;', 1762639342),
('laravel_cache_356a192b7913b04c54574d18c28d46e6395428ab:timer', 'i:1762639342;', 1762639342);

-- --------------------------------------------------------

--
-- Table structure for table `categorias`
--

CREATE TABLE `categorias` (
  `id` int NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `descripcion` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `categorias`
--

INSERT INTO `categorias` (`id`, `nombre`, `descripcion`, `created_at`, `updated_at`) VALUES
(1, 'Entrada Menu 90', 'Entradas del menú de 15 soles', '2025-07-16 08:29:32', '2025-04-10 03:05:35'),
(2, 'Entrada Ejecutivo', 'Entradas del menú de 20 soles', '2025-07-16 08:29:32', '2025-04-10 03:05:35'),
(3, 'Fondo Menu 90', 'Fondos del menú de 15 soles', '2025-07-16 08:29:32', '2025-04-10 03:05:35'),
(4, 'Fondo Ejecutivo', 'Fondos del menú de 20 soles', '2025-07-16 08:29:32', '2025-04-10 03:05:35'),
(5, 'Carta', 'Platos a la carta', '2025-05-20 07:14:03', '2025-04-10 03:05:35'),
(6, 'Combos', 'Combos con precio propio', '2025-05-20 07:13:41', '2025-04-10 03:05:35'),
(7, 'Extras', 'Adicionales', '2025-05-20 07:14:13', '2025-05-20 06:58:54'),
(8, 'Caldos', NULL, '2025-06-18 20:03:07', '0000-00-00 00:00:00'),
(9, 'Desayunos', NULL, '2025-06-18 20:03:07', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `comprobantepago`
--

CREATE TABLE `comprobantepago` (
  `id` int NOT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `estado` varchar(5) DEFAULT '1' COMMENT '0: desactivado;\r\n1: activado;',
  `id_user_create` int NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `comprobantepago`
--

INSERT INTO `comprobantepago` (`id`, `nombre`, `estado`, `id_user_create`, `created_at`, `updated_at`) VALUES
(1, 'Boleta', '1', 1, '2025-06-03 17:30:06', '2025-06-03 17:30:06'),
(2, 'Factura', '1', 1, '2025-05-27 23:00:24', '2025-05-27 23:00:24'),
(3, 'Boleta electrónica', '1', 1, '2025-05-27 23:00:24', '2025-05-27 23:00:24'),
(5, 'compro ejemplo', '1', 1, '2025-06-30 09:32:43', '2025-06-30 09:32:43');

-- --------------------------------------------------------

--
-- Table structure for table `configuracion_sistema`
--

CREATE TABLE `configuracion_sistema` (
  `id` int NOT NULL,
  `clave` varchar(50) NOT NULL,
  `valor` varchar(100) NOT NULL,
  `descripcion` text,
  `estado` tinyint(1) DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `configuracion_sistema`
--

INSERT INTO `configuracion_sistema` (`id`, `clave`, `valor`, `descripcion`, `estado`, `created_at`, `updated_at`) VALUES
(1, 'flujo_pedidos_cocina', '0', 'Pedidos van directo a cocina (1=activo, 0=inactivo)', 1, '2025-07-08 15:43:01', '2025-08-31 17:29:23'),
(2, 'flujo_pedidos_despacho', '1', 'Pedidos van directo a despacho (1=activo, 0=inactivo)', 1, '2025-07-08 15:43:01', '2025-08-31 17:29:23'),
(3, 'password_flujo_pedidos', 'admin123', 'Contraseña especial para cambiar flujo de pedidos', 1, '2025-07-08 15:43:01', '2025-07-08 15:43:01'),
(4, 'impresion_automatica', '0', 'Impresion automatica', 1, '2025-08-15 01:49:43', '2025-08-22 06:34:58'),
(5, 'mostrar_pdf', '1', 'Mostrar pdf', 1, '2025-08-15 01:50:07', '2025-08-22 06:35:20');

-- --------------------------------------------------------

--
-- Table structure for table `direccion_user`
--

CREATE TABLE `direccion_user` (
  `id` int NOT NULL,
  `id_user` int NOT NULL,
  `id_distrito` int NOT NULL,
  `empresa` varchar(255) DEFAULT NULL COMMENT 'nombre de la empresa donde trabajas',
  `tipo_nombre` varchar(255) DEFAULT NULL COMMENT 'trabajo, casa, otros;',
  `lat` varchar(255) DEFAULT NULL,
  `lon` varchar(255) DEFAULT NULL,
  `direccion` varchar(255) NOT NULL,
  `referencia` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `direccion_user`
--

INSERT INTO `direccion_user` (`id`, `id_user`, `id_distrito`, `empresa`, `tipo_nombre`, `lat`, `lon`, `direccion`, `referencia`, `created_at`, `updated_at`) VALUES
(4, 4, 14, NULL, 'Casa', NULL, NULL, 'Av. Javier Prado 101', 'Frente a la escuela', '2025-04-12 16:52:11', '2025-04-12 16:52:11'),
(5, 4, 28, NULL, 'Trabajo', NULL, NULL, 'Calle Los Frailes 202', 'Cerca del edificio central', '2025-04-12 16:52:11', '2025-04-12 16:52:11'),
(6, 4, 4, NULL, 'Otros', NULL, NULL, 'Jr. Pardo 303', 'A un costado del banco', '2025-04-12 16:52:11', '2025-04-12 16:52:11'),
(7, 5, 16, NULL, 'Casa', NULL, NULL, 'Av. Alfredo Benavides 404', 'Cerca del supermercado', '2025-04-12 16:52:45', '2025-04-12 16:52:45'),
(8, 5, 17, NULL, 'Trabajo', NULL, NULL, 'Calle Los Pinos 505', 'Junto a la estatua de la Libertad', '2025-04-12 16:52:45', '2025-04-12 16:52:45'),
(9, 5, 34, NULL, 'Otros', NULL, NULL, 'Jr. Los Portales 606', 'Frente al parque central', '2025-04-12 16:52:46', '2025-04-12 16:52:46'),
(10, 23, 4, NULL, 'Casa', '-11.9753448', '-76.8410796', 'Av las casas, nuevas lomas', 'asdd', '2025-06-03 15:24:27', '2025-06-03 15:24:27'),
(11, 1, 3, NULL, 'Casa', '-12.057787343296761', '-76.97673230270397', 'avenida nogales 251 dirección 1', 'frente al condominio nogales referencia 1', '2025-05-28 20:03:52', '2025-05-29 01:03:52'),
(12, 1, 3, NULL, 'Trabajo', '-12.068698934233135', '-76.99545601604066', 'dir', '4   fsdal condominio nogales referencia 1', '2025-05-29 17:50:31', '2025-05-29 17:50:31'),
(13, 23, 2, NULL, 'Trabajo', '-11.9754572', '-76.8410285', 'Pruebas Mz g3 20', 'asdd', '2025-05-29 18:16:50', '2025-05-29 18:16:50'),
(14, 1, 18, NULL, 'Trabajo', '-12.05955001382235', '-77.00687420721053', 'direccion avenida los n345345', 'referencia 250', '2025-05-29 19:32:26', '2025-05-29 19:32:26'),
(15, 1, 4, NULL, 'Trabajo', '-12.147417086506085', '-77.02308150964912', 'avenida arequipa 23432', 'frente a la estacion', '2025-05-30 12:46:09', '2025-05-30 12:46:09'),
(16, 1, 15, NULL, 'Trabajo', '-12.080617244825419', '-77.020375197044', 'ave la victoria', 'referencia la victoria', '2025-06-20 09:16:50', '2025-06-20 09:16:50');

-- --------------------------------------------------------

--
-- Table structure for table `distrito`
--

CREATE TABLE `distrito` (
  `id` int NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `estado` int DEFAULT '1',
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `distrito`
--

INSERT INTO `distrito` (`id`, `nombre`, `estado`, `created_at`, `updated_at`) VALUES
(1, 'Cercado de Lima', 0, '2025-04-12 16:49:51', '2025-11-08 19:50:31'),
(2, 'Ancón', 0, '2025-04-12 16:49:51', '2025-11-08 19:50:32'),
(3, 'Ate', 0, '2025-04-12 16:49:51', '2025-11-08 19:50:35'),
(4, 'Barranco', 0, '2025-04-12 16:49:51', '2025-11-08 19:50:37'),
(5, 'Breña', 0, '2025-04-12 16:49:51', '2025-11-08 19:50:39'),
(6, 'Carabayllo', 0, '2025-04-12 16:49:51', '2025-11-08 19:50:41'),
(7, 'Chaclacayo', 0, '2025-04-12 16:49:51', '2025-11-08 19:50:42'),
(8, 'Chorrillos', 0, '2025-04-12 16:49:51', '2025-11-08 19:50:45'),
(9, 'Cieneguilla', 0, '2025-04-12 16:49:51', '2025-11-08 19:50:47'),
(10, 'Comas', 0, '2025-04-12 16:49:51', '2025-11-08 19:50:49'),
(11, 'El Agustino', 0, '2025-04-12 16:49:51', '2025-11-08 20:13:26'),
(12, 'Independencia', 0, '2025-04-12 16:49:51', '2025-11-08 19:50:57'),
(13, 'Jesús María', 1, '2025-04-12 16:49:51', '2025-04-12 16:49:51'),
(14, 'La Molina', 0, '2025-04-12 16:49:51', '2025-11-08 19:51:03'),
(15, 'La Victoria', 0, '2025-04-12 16:49:51', '2025-11-08 19:51:05'),
(16, 'Lince', 1, '2025-04-12 16:49:51', '2025-04-12 16:49:51'),
(17, 'Los Olivos', 0, '2025-04-12 16:49:51', '2025-11-08 19:51:07'),
(18, 'Lurigancho', 0, '2025-04-12 16:49:51', '2025-11-08 19:51:10'),
(19, 'Lurín', 0, '2025-04-12 16:49:51', '2025-11-08 19:51:12'),
(20, 'Magdalena del Mar', 0, '2025-04-12 16:49:51', '2025-11-08 19:51:13'),
(21, 'Miraflores', 1, '2025-04-12 16:49:51', '2025-04-12 16:49:51'),
(22, 'Pachacamac', 0, '2025-04-12 16:49:51', '2025-11-08 19:51:19'),
(23, 'Pucusana', 0, '2025-04-12 16:49:51', '2025-11-08 19:51:21'),
(24, 'Pueblo Libre', 0, '2025-04-12 16:49:51', '2025-11-08 19:51:22'),
(25, 'Puente Piedra', 0, '2025-04-12 16:49:51', '2025-11-08 19:51:27'),
(26, 'Rímac', 0, '2025-04-12 16:49:51', '2025-11-08 19:51:29'),
(27, 'San Bartolo', 0, '2025-04-12 16:49:51', '2025-11-08 19:51:31'),
(28, 'San Borja', 1, '2025-04-12 16:49:51', '2025-11-08 19:51:55'),
(29, 'San Isidro', 1, '2025-04-12 16:49:51', '2025-04-12 16:49:51'),
(30, 'San Juan de Lurigancho', 0, '2025-04-12 16:49:51', '2025-11-08 19:51:36'),
(31, 'San Juan de Miraflores', 0, '2025-04-12 16:49:51', '2025-11-08 19:51:40'),
(32, 'San Luis', 0, '2025-04-12 16:49:51', '2025-11-08 19:51:41'),
(33, 'San Martín de Porres', 0, '2025-04-12 16:49:51', '2025-11-08 19:51:43'),
(34, 'San Miguel', 0, '2025-04-12 16:49:51', '2025-11-08 19:51:44'),
(35, 'Santa Anita', 0, '2025-04-12 16:49:51', '2025-11-08 19:51:45'),
(36, 'Santa María del Mar', 0, '2025-04-12 16:49:51', '2025-11-08 19:51:46'),
(37, 'Santa Rosa', 0, '2025-04-12 16:49:51', '2025-11-08 19:51:47'),
(38, 'Santiago de Surco', 1, '2025-04-12 16:49:51', '2025-04-12 16:49:51'),
(39, 'Surquillo', 0, '2025-04-12 16:49:51', '2025-11-08 19:52:03'),
(40, 'Villa El Salvador', 0, '2025-04-12 16:49:51', '2025-11-08 19:52:05'),
(41, 'Villa María del Triunfo', 0, '2025-04-12 16:49:51', '2025-11-08 19:52:08');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `historial_estado_pedidos`
--

CREATE TABLE `historial_estado_pedidos` (
  `id` int NOT NULL,
  `id_pedido` int NOT NULL,
  `estado` tinyint NOT NULL,
  `id_user` int DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `historial_estado_pedidos`
--

INSERT INTO `historial_estado_pedidos` (`id`, `id_pedido`, `estado`, `id_user`, `created_at`, `updated_at`) VALUES
(1, 70, 0, 4, '2025-07-09 19:02:52', '2025-07-09 19:02:52'),
(2, 70, 1, 4, '2025-07-09 19:02:52', '2025-07-09 19:02:52'),
(3, 70, 2, 4, '2025-07-09 19:02:52', '2025-07-09 19:02:52'),
(4, 71, 0, 23, '2025-07-09 19:04:24', '2025-07-09 19:04:24'),
(5, 71, 1, 23, '2025-07-09 19:04:24', '2025-07-09 19:04:24'),
(6, 71, 2, 23, '2025-07-09 19:04:24', '2025-07-09 19:04:24'),
(7, 72, 0, 23, '2025-07-12 16:38:23', '2025-07-12 16:38:23'),
(8, 72, 1, 23, '2025-07-12 16:38:23', '2025-07-12 16:38:23'),
(9, 72, 2, 23, '2025-07-12 18:28:30', '2025-07-12 18:28:30'),
(10, 72, 3, 23, '2025-07-12 18:29:01', '2025-07-12 18:29:01'),
(11, 72, 3, 23, '2025-07-12 18:29:04', '2025-07-12 18:29:04'),
(12, 72, 3, 23, '2025-07-12 18:29:04', '2025-07-12 18:29:04'),
(13, 72, 4, 23, '2025-07-12 18:29:07', '2025-07-12 18:29:07'),
(14, 75, 0, 23, '2025-07-13 05:54:52', '2025-07-13 05:54:52'),
(15, 75, 1, 23, '2025-07-13 05:54:52', '2025-07-13 05:54:52'),
(16, 75, 8, 23, '2025-07-13 05:55:38', '2025-07-13 05:55:38'),
(17, 75, 3, 23, '2025-07-13 05:56:32', '2025-07-13 05:56:32'),
(18, 75, 3, 23, '2025-07-13 05:56:34', '2025-07-13 05:56:34'),
(19, 75, 4, 23, '2025-07-13 05:56:38', '2025-07-13 05:56:38'),
(20, 75, 4, 23, '2025-07-13 05:56:39', '2025-07-13 05:56:39'),
(21, 75, 4, 23, '2025-07-13 05:56:40', '2025-07-13 05:56:40'),
(22, 75, 3, 23, '2025-07-13 05:56:42', '2025-07-13 05:56:42'),
(23, 75, 4, 23, '2025-07-13 05:56:49', '2025-07-13 05:56:49'),
(24, 75, 4, 23, '2025-07-13 05:56:50', '2025-07-13 05:56:50'),
(25, 75, 3, 23, '2025-07-13 05:56:52', '2025-07-13 05:56:52'),
(26, 75, 3, 23, '2025-07-13 05:57:03', '2025-07-13 05:57:03'),
(27, 75, 4, 23, '2025-07-13 05:57:05', '2025-07-13 05:57:05'),
(28, 77, 0, NULL, '2025-07-16 16:24:41', '2025-07-16 16:24:41'),
(29, 77, 1, NULL, '2025-07-16 16:24:41', '2025-07-16 16:24:41'),
(30, 78, 0, 1, '2025-07-17 18:06:31', '2025-07-17 18:06:31'),
(31, 78, 1, 1, '2025-07-17 18:06:31', '2025-07-17 18:06:31'),
(32, 79, 0, 1, '2025-07-17 18:12:42', '2025-07-17 18:12:42'),
(33, 79, 1, 1, '2025-07-17 18:12:42', '2025-07-17 18:12:42'),
(34, 79, 2, 1, '2025-07-17 18:12:42', '2025-07-17 18:12:42'),
(35, 79, 3, 1, '2025-07-17 18:16:13', '2025-07-17 18:16:13'),
(36, 79, 4, 1, '2025-07-17 18:16:19', '2025-07-17 18:16:19'),
(37, 79, 4, 1, '2025-07-17 18:17:06', '2025-07-17 18:17:06'),
(38, 79, 3, 1, '2025-07-17 18:17:11', '2025-07-17 18:17:11'),
(39, 79, 3, 1, '2025-07-17 18:17:11', '2025-07-17 18:17:11'),
(40, 79, 3, 1, '2025-07-17 18:17:11', '2025-07-17 18:17:11'),
(41, 79, 3, 1, '2025-07-17 18:17:16', '2025-07-17 18:17:16'),
(42, 79, 4, 1, '2025-07-17 18:18:15', '2025-07-17 18:18:15'),
(43, 80, 0, 1, '2025-07-25 18:58:28', '2025-07-25 18:58:28'),
(44, 80, 1, 1, '2025-07-25 18:58:28', '2025-07-25 18:58:28'),
(45, 80, 2, 1, '2025-07-25 18:58:28', '2025-07-25 18:58:28'),
(46, 81, 0, 1, '2025-07-30 01:04:30', '2025-07-30 01:04:30'),
(47, 81, 1, 1, '2025-07-30 01:04:30', '2025-07-30 01:04:30'),
(48, 81, 2, 1, '2025-07-30 01:04:30', '2025-07-30 01:04:30'),
(49, 82, 0, 1, '2025-07-30 01:06:18', '2025-07-30 01:06:18'),
(50, 82, 1, 1, '2025-07-30 01:06:18', '2025-07-30 01:06:18'),
(51, 82, 2, 1, '2025-07-30 01:06:18', '2025-07-30 01:06:18'),
(52, 83, 0, 1, '2025-07-30 01:10:39', '2025-07-30 01:10:39'),
(53, 83, 1, 1, '2025-07-30 01:10:39', '2025-07-30 01:10:39'),
(54, 83, 2, 1, '2025-07-30 01:10:39', '2025-07-30 01:10:39'),
(55, 84, 0, 1, '2025-07-30 01:12:38', '2025-07-30 01:12:38'),
(56, 84, 1, 1, '2025-07-30 01:12:38', '2025-07-30 01:12:38'),
(57, 84, 2, 1, '2025-07-30 01:17:09', '2025-07-30 01:17:09'),
(58, 84, 3, 1, '2025-07-30 01:23:12', '2025-07-30 01:23:12'),
(59, 83, 3, 1, '2025-07-30 01:23:15', '2025-07-30 01:23:15'),
(60, 82, 3, 1, '2025-07-30 01:23:17', '2025-07-30 01:23:17'),
(61, 81, 3, 1, '2025-07-30 01:23:18', '2025-07-30 01:23:18'),
(62, 84, 3, 1, '2025-07-30 01:25:31', '2025-07-30 01:25:31'),
(63, 81, 4, 1, '2025-07-30 01:26:07', '2025-07-30 01:26:07'),
(64, 82, 4, 1, '2025-07-30 01:26:12', '2025-07-30 01:26:12'),
(65, 83, 4, 1, '2025-07-30 01:26:19', '2025-07-30 01:26:19'),
(66, 84, 4, 1, '2025-07-30 01:26:22', '2025-07-30 01:26:22'),
(67, 84, 4, 1, '2025-07-30 01:26:37', '2025-07-30 01:26:37'),
(68, 84, 5, 17, '2025-07-30 01:30:27', '2025-07-30 01:30:27'),
(69, 84, 6, 17, '2025-07-30 01:31:09', '2025-07-30 01:31:09'),
(70, 83, 5, 17, '2025-07-30 01:31:38', '2025-07-30 01:31:38'),
(71, 83, 6, 17, '2025-07-30 01:31:59', '2025-07-30 01:31:59'),
(72, 82, 5, 17, '2025-07-30 01:32:26', '2025-07-30 01:32:26'),
(73, 82, 6, 17, '2025-07-30 01:32:45', '2025-07-30 01:32:45'),
(74, 81, 5, 17, '2025-07-30 01:33:03', '2025-07-30 01:33:03'),
(75, 81, 6, 17, '2025-07-30 01:33:06', '2025-07-30 01:33:06'),
(76, 85, 0, 1, '2025-07-30 01:49:11', '2025-07-30 01:49:11'),
(77, 85, 1, 1, '2025-07-30 01:49:11', '2025-07-30 01:49:11'),
(78, 85, 2, 1, '2025-07-30 01:49:28', '2025-07-30 01:49:28'),
(79, 85, 3, 1, '2025-07-30 01:50:21', '2025-07-30 01:50:21'),
(80, 85, 4, 1, '2025-07-30 01:50:28', '2025-07-30 01:50:28'),
(81, 85, 4, 1, '2025-07-30 01:50:34', '2025-07-30 01:50:34'),
(82, 85, 5, 17, '2025-07-30 01:51:08', '2025-07-30 01:51:08'),
(83, 85, 6, 17, '2025-07-30 01:51:51', '2025-07-30 01:51:51'),
(84, 86, 0, 1, '2025-07-31 02:40:23', '2025-07-31 02:40:23'),
(85, 86, 1, 1, '2025-07-31 02:40:23', '2025-07-31 02:40:23'),
(86, 86, 9, 1, '2025-07-31 02:40:35', '2025-07-31 02:40:35'),
(87, 87, 0, 1, '2025-07-31 02:41:06', '2025-07-31 02:41:06'),
(88, 87, 1, 1, '2025-07-31 02:41:06', '2025-07-31 02:41:06'),
(89, 87, 2, 1, '2025-07-31 02:41:26', '2025-07-31 02:41:26'),
(90, 88, 0, 1, '2025-07-31 02:51:48', '2025-07-31 02:51:48'),
(91, 88, 1, 1, '2025-07-31 02:51:48', '2025-07-31 02:51:48'),
(92, 88, 2, 1, '2025-07-31 02:52:08', '2025-07-31 02:52:08'),
(93, 87, 3, 1, '2025-07-31 02:53:49', '2025-07-31 02:53:49'),
(94, 87, 4, 1, '2025-07-31 02:53:53', '2025-07-31 02:53:53'),
(95, 88, 3, 1, '2025-07-31 02:54:03', '2025-07-31 02:54:03'),
(96, 88, 4, 1, '2025-07-31 02:54:05', '2025-07-31 02:54:05'),
(97, 89, 0, 1, '2025-07-31 02:55:00', '2025-07-31 02:55:00'),
(98, 89, 1, 1, '2025-07-31 02:55:00', '2025-07-31 02:55:00'),
(99, 89, 2, 1, '2025-07-31 02:55:10', '2025-07-31 02:55:10'),
(100, 78, 2, 23, '2025-07-31 15:33:38', '2025-07-31 15:33:38'),
(101, 90, 0, 23, '2025-07-31 15:36:29', '2025-07-31 15:36:29'),
(102, 90, 1, 23, '2025-07-31 15:36:29', '2025-07-31 15:36:29'),
(103, 90, 2, 23, '2025-07-31 15:38:05', '2025-07-31 15:38:05'),
(104, 90, 3, 23, '2025-07-31 15:39:29', '2025-07-31 15:39:29'),
(105, 90, 4, 23, '2025-07-31 15:39:33', '2025-07-31 15:39:33'),
(106, 90, 5, 17, '2025-07-31 15:39:54', '2025-07-31 15:39:54'),
(107, 91, 0, 23, '2025-08-01 17:44:44', '2025-08-01 17:44:44'),
(108, 91, 1, 23, '2025-08-01 17:44:44', '2025-08-01 17:44:44'),
(109, 92, 0, 23, '2025-08-01 17:55:33', '2025-08-01 17:55:33'),
(110, 92, 1, 23, '2025-08-01 17:55:33', '2025-08-01 17:55:33'),
(111, 93, 0, 1, '2025-08-08 18:33:58', '2025-08-08 18:33:58'),
(112, 93, 1, 1, '2025-08-08 18:33:58', '2025-08-08 18:33:58'),
(113, 93, 2, 1, '2025-08-08 18:34:12', '2025-08-08 18:34:12'),
(114, 94, 0, 1, '2025-08-15 07:27:46', '2025-08-15 07:27:46'),
(115, 94, 1, 1, '2025-08-15 07:27:46', '2025-08-15 07:27:46'),
(116, 94, 2, 1, '2025-08-15 07:28:15', '2025-08-15 07:28:15'),
(117, 94, 2, 1, '2025-08-15 07:28:18', '2025-08-15 07:28:18'),
(118, 94, 3, 1, '2025-08-15 07:29:23', '2025-08-15 07:29:23'),
(119, 95, 0, 1, '2025-08-15 07:45:14', '2025-08-15 07:45:14'),
(120, 95, 1, 1, '2025-08-15 07:45:14', '2025-08-15 07:45:14'),
(121, 96, 0, 1, '2025-08-15 07:51:26', '2025-08-15 07:51:26'),
(122, 96, 1, 1, '2025-08-15 07:51:26', '2025-08-15 07:51:26'),
(123, 96, 2, 1, '2025-08-15 07:51:46', '2025-08-15 07:51:46'),
(124, 96, 2, 1, '2025-08-15 07:51:47', '2025-08-15 07:51:47'),
(125, 96, 3, 1, '2025-08-15 07:55:54', '2025-08-15 07:55:54'),
(126, 95, 2, 1, '2025-08-15 07:56:16', '2025-08-15 07:56:16'),
(127, 95, 2, 1, '2025-08-15 07:56:18', '2025-08-15 07:56:18'),
(128, 97, 0, 1, '2025-08-15 07:58:00', '2025-08-15 07:58:00'),
(129, 97, 1, 1, '2025-08-15 07:58:00', '2025-08-15 07:58:00'),
(130, 97, 1, 1, '2025-08-15 07:58:08', '2025-08-15 07:58:08'),
(131, 97, 2, 1, '2025-08-15 07:58:10', '2025-08-15 07:58:10'),
(132, 97, 2, 1, '2025-08-15 07:58:12', '2025-08-15 07:58:12'),
(133, 97, 3, 1, '2025-08-15 07:58:29', '2025-08-15 07:58:29'),
(134, 95, 3, 1, '2025-08-15 07:58:37', '2025-08-15 07:58:37'),
(135, 98, 0, 1, '2025-08-15 07:59:42', '2025-08-15 07:59:42'),
(136, 98, 1, 1, '2025-08-15 07:59:42', '2025-08-15 07:59:42'),
(137, 98, 1, 1, '2025-08-15 07:59:48', '2025-08-15 07:59:48'),
(138, 98, 2, 1, '2025-08-15 07:59:50', '2025-08-15 07:59:50'),
(139, 98, 2, 1, '2025-08-15 07:59:51', '2025-08-15 07:59:51'),
(140, 98, 3, 1, '2025-08-15 08:00:00', '2025-08-15 08:00:00'),
(141, 99, 0, 1, '2025-08-15 08:03:20', '2025-08-15 08:03:20'),
(142, 99, 1, 1, '2025-08-15 08:03:20', '2025-08-15 08:03:20'),
(143, 99, 2, 1, '2025-08-15 08:03:35', '2025-08-15 08:03:35'),
(144, 99, 2, 1, '2025-08-15 08:03:37', '2025-08-15 08:03:37'),
(145, 97, 4, 1, '2025-08-15 08:08:52', '2025-08-15 08:08:52'),
(146, 98, 4, 1, '2025-08-15 08:10:15', '2025-08-15 08:10:15'),
(147, 96, 4, 1, '2025-08-15 08:10:26', '2025-08-15 08:10:26'),
(148, 95, 4, 1, '2025-08-15 08:10:30', '2025-08-15 08:10:30'),
(149, 94, 4, 1, '2025-08-15 08:10:42', '2025-08-15 08:10:42'),
(150, 99, 3, 1, '2025-08-15 08:11:01', '2025-08-15 08:11:01'),
(151, 100, 0, 1, '2025-08-15 08:19:21', '2025-08-15 08:19:21'),
(152, 100, 1, 1, '2025-08-15 08:19:21', '2025-08-15 08:19:21'),
(153, 101, 0, 1, '2025-08-15 08:19:48', '2025-08-15 08:19:48'),
(154, 101, 1, 1, '2025-08-15 08:19:48', '2025-08-15 08:19:48'),
(155, 102, 0, 1, '2025-08-15 08:20:48', '2025-08-15 08:20:48'),
(156, 102, 1, 1, '2025-08-15 08:20:48', '2025-08-15 08:20:48'),
(157, 100, 2, 1, '2025-08-15 08:21:23', '2025-08-15 08:21:23'),
(158, 100, 2, 1, '2025-08-15 08:21:24', '2025-08-15 08:21:24'),
(159, 101, 2, 1, '2025-08-15 08:21:28', '2025-08-15 08:21:28'),
(160, 101, 2, 1, '2025-08-15 08:21:29', '2025-08-15 08:21:29'),
(161, 102, 2, 1, '2025-08-15 08:21:32', '2025-08-15 08:21:32'),
(162, 102, 2, 1, '2025-08-15 08:21:33', '2025-08-15 08:21:33'),
(163, 102, 3, 1, '2025-08-15 08:21:43', '2025-08-15 08:21:43'),
(164, 101, 3, 1, '2025-08-15 08:21:47', '2025-08-15 08:21:47'),
(165, 100, 3, 1, '2025-08-15 08:21:51', '2025-08-15 08:21:51'),
(166, 103, 3, 1, '2025-08-15 08:22:34', '2025-08-15 08:22:34'),
(167, 103, 1, 1, '2025-08-15 08:22:34', '2025-08-15 08:22:34'),
(168, 103, 2, 1, '2025-08-15 08:22:34', '2025-08-15 08:22:34'),
(169, 104, 3, 1, '2025-08-21 20:46:59', '2025-08-21 20:46:59'),
(170, 104, 1, 1, '2025-08-21 20:46:59', '2025-08-21 20:46:59'),
(171, 104, 2, 1, '2025-08-21 20:46:59', '2025-08-21 20:46:59'),
(172, 105, 3, 1, '2025-08-22 05:47:35', '2025-08-22 05:47:35'),
(173, 105, 1, 1, '2025-08-22 05:47:35', '2025-08-22 05:47:35'),
(174, 105, 2, 1, '2025-08-22 05:47:35', '2025-08-22 05:47:35'),
(175, 106, 3, 1, '2025-08-22 07:20:34', '2025-08-22 07:20:34'),
(176, 106, 1, 1, '2025-08-22 07:20:34', '2025-08-22 07:20:34'),
(177, 106, 2, 1, '2025-08-22 07:20:34', '2025-08-22 07:20:34'),
(178, 107, 3, 1, '2025-08-27 22:44:54', '2025-08-27 22:44:54'),
(179, 107, 1, 1, '2025-08-27 22:44:54', '2025-08-27 22:44:54'),
(180, 107, 2, 1, '2025-08-27 22:44:54', '2025-08-27 22:44:54'),
(181, 107, 3, 1, '2025-08-27 22:45:22', '2025-08-27 22:45:22'),
(182, 107, 4, 1, '2025-08-27 22:45:31', '2025-08-27 22:45:31'),
(183, 108, 3, 1, '2025-08-31 17:19:57', '2025-08-31 17:19:57'),
(184, 108, 1, 1, '2025-08-31 17:19:57', '2025-08-31 17:19:57'),
(185, 108, 2, 1, '2025-08-31 17:19:57', '2025-08-31 17:19:57'),
(186, 108, 3, 1, '2025-08-31 17:20:41', '2025-08-31 17:20:41'),
(187, 108, 4, 1, '2025-08-31 17:20:54', '2025-08-31 17:20:54'),
(188, 108, 5, 18, '2025-08-31 17:22:17', '2025-08-31 17:22:17'),
(189, 108, 6, 18, '2025-08-31 17:22:42', '2025-08-31 17:22:42'),
(190, 109, 3, 1, '2025-11-08 00:48:42', '2025-11-08 00:48:42'),
(191, 109, 1, 1, '2025-11-08 00:48:42', '2025-11-08 00:48:42'),
(192, 109, 2, 1, '2025-11-08 00:48:42', '2025-11-08 00:48:42'),
(193, 110, 3, 1, '2025-11-08 21:19:37', '2025-11-08 21:19:37'),
(194, 110, 1, 1, '2025-11-08 21:19:37', '2025-11-08 21:19:37'),
(195, 110, 2, 1, '2025-11-08 21:19:37', '2025-11-08 21:19:37'),
(196, 111, 3, 1, '2025-11-08 21:20:38', '2025-11-08 21:20:38'),
(197, 111, 1, 1, '2025-11-08 21:20:38', '2025-11-08 21:20:38'),
(198, 111, 2, 1, '2025-11-08 21:20:38', '2025-11-08 21:20:38'),
(199, 112, 3, 1, '2025-11-08 21:21:32', '2025-11-08 21:21:32'),
(200, 112, 1, 1, '2025-11-08 21:21:32', '2025-11-08 21:21:32'),
(201, 112, 2, 1, '2025-11-08 21:21:32', '2025-11-08 21:21:32'),
(202, 113, 3, 1, '2025-11-08 21:29:13', '2025-11-08 21:29:13'),
(203, 113, 1, 1, '2025-11-08 21:29:13', '2025-11-08 21:29:13'),
(204, 113, 2, 1, '2025-11-08 21:29:13', '2025-11-08 21:29:13'),
(205, 114, 3, 1, '2026-02-02 02:46:03', '2026-02-02 02:46:03'),
(206, 114, 1, 1, '2026-02-02 02:46:03', '2026-02-02 02:46:03'),
(207, 114, 2, 1, '2026-02-02 02:46:03', '2026-02-02 02:46:03'),
(208, 115, 3, 1, '2026-02-02 02:47:12', '2026-02-02 02:47:12'),
(209, 115, 1, 1, '2026-02-02 02:47:12', '2026-02-02 02:47:12'),
(210, 115, 2, 1, '2026-02-02 02:47:12', '2026-02-02 02:47:12');

-- --------------------------------------------------------

--
-- Table structure for table `horallegada`
--

CREATE TABLE `horallegada` (
  `id` int NOT NULL,
  `valor` int DEFAULT NULL,
  `inicio_rango` time DEFAULT NULL,
  `fin_rango` time DEFAULT NULL,
  `tipo` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `estado` varchar(5) DEFAULT '1' COMMENT '0: desactivado;\r\n1: activado;',
  `id_user_create` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `horallegada`
--

INSERT INTO `horallegada` (`id`, `valor`, `inicio_rango`, `fin_rango`, `tipo`, `estado`, `id_user_create`, `created_at`, `updated_at`) VALUES
(1, 15, NULL, NULL, 'hora', '0', 1, '2025-11-07 02:35:14', '2025-11-07 02:35:14'),
(2, 30, NULL, NULL, 'hora', '0', 1, '2025-05-27 22:58:53', '2025-11-07 20:24:54'),
(3, 45, NULL, NULL, 'hora', '0', 1, '2025-05-27 22:58:53', '2025-11-07 20:24:56'),
(4, 60, NULL, NULL, 'hora', '0', 1, '2025-06-03 17:39:18', '2025-11-07 20:24:57'),
(5, 75, NULL, NULL, 'hora', '1', 1, '2025-06-03 17:39:25', '2025-11-07 20:24:59'),
(6, NULL, '11:30:00', '12:30:00', 'rango', '1', 1, '2025-11-07 20:25:36', '2025-11-07 20:25:36');

-- --------------------------------------------------------

--
-- Table structure for table `impresiones`
--

CREATE TABLE `impresiones` (
  `id` int NOT NULL,
  `id_pedido` int NOT NULL,
  `estado` enum('pendiente','impreso') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pendiente',
  `fecha_generacion` timestamp NOT NULL,
  `fecha_impresion` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `impresiones`
--

INSERT INTO `impresiones` (`id`, `id_pedido`, `estado`, `fecha_generacion`, `fecha_impresion`, `created_at`, `updated_at`) VALUES
(1, 94, 'impreso', '2025-08-15 07:29:23', '2025-08-22 07:15:52', '2025-08-15 07:29:23', '2025-08-22 07:15:52'),
(2, 96, 'impreso', '2025-08-15 07:55:54', '2025-08-22 07:15:53', '2025-08-15 07:55:54', '2025-08-22 07:15:53'),
(3, 98, 'impreso', '2025-08-15 08:00:00', '2025-08-22 07:15:53', '2025-08-15 08:00:00', '2025-08-22 07:15:53'),
(4, 99, 'impreso', '2025-08-15 08:11:01', '2025-08-22 07:15:54', '2025-08-15 08:11:01', '2025-08-22 07:15:54'),
(5, 100, 'impreso', '2025-08-15 08:21:24', '2025-08-15 09:14:35', '2025-08-15 08:21:24', '2025-08-15 09:14:35'),
(6, 101, 'impreso', '2025-08-15 08:21:29', '2025-08-15 09:14:12', '2025-08-15 08:21:29', '2025-08-15 09:14:12'),
(7, 102, 'impreso', '2025-08-15 08:21:33', '2025-08-15 09:08:06', '2025-08-15 08:21:33', '2025-08-15 09:08:06'),
(8, 103, 'impreso', '2025-08-15 08:22:34', '2025-08-15 09:07:51', '2025-08-15 08:22:34', '2025-08-15 09:07:51'),
(9, 104, 'impreso', '2025-08-21 20:46:59', '2025-08-22 07:15:54', '2025-08-21 20:46:59', '2025-08-22 07:15:54'),
(10, 105, 'impreso', '2025-08-22 05:47:35', '2025-08-22 07:15:59', '2025-08-22 05:47:35', '2025-08-22 07:15:59'),
(11, 106, 'impreso', '2025-08-22 07:20:34', '2025-08-22 07:20:39', '2025-08-22 07:20:34', '2025-08-22 07:20:39'),
(12, 107, 'pendiente', '2025-08-27 22:44:54', NULL, '2025-08-27 22:44:54', '2025-08-27 22:44:54'),
(13, 108, 'pendiente', '2025-08-31 17:19:57', NULL, '2025-08-31 17:19:57', '2025-08-31 17:19:57'),
(14, 109, 'pendiente', '2025-11-08 00:48:42', NULL, '2025-11-08 00:48:42', '2025-11-08 00:48:42'),
(15, 110, 'pendiente', '2025-11-08 21:19:37', '2025-11-08 22:01:25', '2025-11-08 21:19:37', '2025-11-08 22:01:25'),
(16, 111, 'pendiente', '2025-11-08 21:20:38', NULL, '2025-11-08 21:20:38', '2025-11-08 21:20:38'),
(17, 112, 'pendiente', '2025-11-08 21:21:32', '2025-11-08 22:05:16', '2025-11-08 21:21:32', '2025-11-08 22:05:16'),
(18, 113, 'pendiente', '2025-11-08 21:29:13', NULL, '2025-11-08 21:29:13', '2025-11-08 21:29:13'),
(19, 114, 'pendiente', '2026-02-02 02:46:03', NULL, '2026-02-02 02:46:03', '2026-02-02 02:46:03'),
(20, 115, 'pendiente', '2026-02-02 02:47:12', NULL, '2026-02-02 02:47:12', '2026-02-02 02:47:12');

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `id` int NOT NULL,
  `nombre` varchar(250) NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `url_imagen` varchar(500) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id`, `nombre`, `precio`, `url_imagen`, `created_at`, `updated_at`) VALUES
(1, 'Menu 90', 15.00, '1753730575_1752211643012.jpeg', '2025-07-28 19:22:55', '2025-07-28 19:22:55'),
(2, 'Menu Ejecutivo', 27.90, '1753730520_No venimos a hacer lo mismo.png', '2025-07-28 19:22:00', '2025-07-28 19:22:00'),
(4, 'Caldos', 21.00, '1752191096_1.webp', '2025-07-12 01:57:10', '2025-07-12 01:57:10'),
(5, 'Desayunos', 21.00, '1752263202_Captura de pantalla 2025-07-09 114850.png', '2025-07-12 00:46:42', '2025-07-12 00:46:42'),
(6, 'Carta', 21.00, '1752264927_Captura de pantalla 2025-05-31 205649.png', '2025-07-12 01:58:00', '2025-07-12 01:58:00'),
(7, 'Combos', 21.00, '1752519851_Captura de pantalla 2025-07-09 114850.png', '2025-07-14 19:04:11', '2025-07-14 19:04:11');

-- --------------------------------------------------------

--
-- Table structure for table `menu_categorias`
--

CREATE TABLE `menu_categorias` (
  `id` int NOT NULL,
  `menu_id` int NOT NULL,
  `categoria_id` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `menu_categorias`
--

INSERT INTO `menu_categorias` (`id`, `menu_id`, `categoria_id`, `created_at`, `updated_at`) VALUES
(6, 4, 8, '2025-07-12 01:57:10', '2025-07-12 01:57:10'),
(7, 5, 9, '2025-07-12 01:57:28', '2025-07-12 01:57:28'),
(8, 6, 5, '2025-07-12 01:58:00', '2025-07-12 01:58:00'),
(10, 7, 6, '2025-07-17 16:58:17', '2025-07-17 16:58:17'),
(11, 1, 1, '2025-08-01 17:32:16', '2025-08-01 17:32:16'),
(12, 1, 3, '2025-08-01 17:32:16', '2025-08-01 17:32:16'),
(13, 2, 2, '2025-08-01 17:32:32', '2025-08-01 17:32:32'),
(14, 2, 4, '2025-08-01 17:32:32', '2025-08-01 17:32:32');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_reset_tokens`
--

INSERT INTO `password_reset_tokens` (`email`, `token`, `created_at`) VALUES
('aaalenort@gmail.com', '$2y$12$DGnyAZijrJkSHoulUckgMuJWSyxLwst0qjZwVnhSpSjSkQm7LocLi', '2025-05-20 22:58:24');

-- --------------------------------------------------------

--
-- Table structure for table `pedidos`
--

CREATE TABLE `pedidos` (
  `id` int NOT NULL,
  `id_usuario` int DEFAULT NULL,
  `estado` varchar(50) NOT NULL DEFAULT 'PENDIENTE',
  `monto_total` decimal(10,2) NOT NULL DEFAULT '0.00',
  `id_tipopago` int NOT NULL,
  `vuelto` varchar(100) DEFAULT NULL,
  `desea_comprobante` tinyint(1) NOT NULL DEFAULT '0',
  `id_comprobantepago` int DEFAULT NULL,
  `datos_comprobante` varchar(255) DEFAULT NULL,
  `nombre_contacto` varchar(100) DEFAULT NULL,
  `email_contacto` varchar(100) DEFAULT NULL,
  `telefono_contacto` varchar(20) DEFAULT NULL,
  `id_distrito_contacto` int DEFAULT NULL,
  `direccion_contacto` varchar(255) DEFAULT NULL COMMENT 'si tiene usuario, aqui se graba el id_direccion',
  `referencia_contacto` varchar(255) DEFAULT NULL,
  `lat_contacto` varchar(255) DEFAULT NULL,
  `lon_contacto` varchar(255) DEFAULT NULL,
  `comentarios` text,
  `fecha_programada` date DEFAULT NULL,
  `id_horallegada` int DEFAULT NULL,
  `hora_programada` time DEFAULT NULL,
  `id_user_moto` int DEFAULT NULL,
  `ruta_evidencia` varchar(250) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `pedidos`
--

INSERT INTO `pedidos` (`id`, `id_usuario`, `estado`, `monto_total`, `id_tipopago`, `vuelto`, `desea_comprobante`, `id_comprobantepago`, `datos_comprobante`, `nombre_contacto`, `email_contacto`, `telefono_contacto`, `id_distrito_contacto`, `direccion_contacto`, `referencia_contacto`, `lat_contacto`, `lon_contacto`, `comentarios`, `fecha_programada`, `id_horallegada`, `hora_programada`, `id_user_moto`, `ruta_evidencia`, `created_at`, `updated_at`) VALUES
(1, 3, 'PENDIENTE', 16.50, 0, NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-04-07', NULL, '13:00:00', NULL, NULL, '2025-04-10 03:12:31', '2025-04-10 03:12:31'),
(2, 4, 'EN_PREPARACION', 60.00, 0, NULL, 1, 0, '20600123456', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-04-07', NULL, '14:00:00', NULL, NULL, '2025-04-10 03:12:31', '2025-04-10 03:12:31'),
(3, 5, 'REPARTO', 62.00, 0, NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-04-07', NULL, '15:00:00', NULL, NULL, '2025-04-10 03:12:31', '2025-04-10 03:12:31'),
(4, 6, 'ENTREGADO', 33.00, 0, NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-04-07', NULL, '12:30:00', NULL, NULL, '2025-04-10 03:12:31', '2025-04-10 03:12:31'),
(5, 7, 'CANCELADO', 15.00, 0, NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-04-07', NULL, '13:30:00', NULL, NULL, '2025-04-10 03:12:31', '2025-04-10 03:12:31'),
(6, 8, 'PENDIENTE', 60.00, 0, NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-04-09', NULL, '13:00:00', NULL, NULL, '2025-04-10 03:12:31', '2025-04-10 03:12:31'),
(7, 9, 'PENDIENTE', 23.50, 0, NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-04-07', NULL, '14:30:00', NULL, NULL, '2025-04-10 03:12:31', '2025-04-10 03:12:31'),
(8, 10, 'PENDIENTE', 15.00, 0, NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-04-10', NULL, '13:00:00', NULL, NULL, '2025-04-10 03:12:31', '2025-04-10 03:12:31'),
(9, 11, 'EN_PREPARACION', 15.00, 0, NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-04-07', NULL, '15:30:00', NULL, NULL, '2025-04-10 03:12:31', '2025-04-10 03:12:31'),
(10, 12, 'REPARTO', 40.00, 0, NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-04-07', NULL, '16:00:00', NULL, NULL, '2025-04-10 03:12:31', '2025-04-10 03:12:31'),
(11, NULL, '1', 172.52, 2, NULL, 0, NULL, NULL, 'Enrique Ricci', NULL, '97366373', 5, 'Dirección ekemplo', 'Frene', '-12.055814814197', '-76.978068805965', 'Ejemplo de pedido', '2025-05-30', 2, '05:13:56', NULL, NULL, '2025-05-30 09:43:56', '2025-06-30 09:32:10'),
(12, 1, '1', 171.83, 3, NULL, 0, NULL, NULL, 'Alfredo Enrique', 'admin@admin.com', '953761235', 3, 'dir', '4   fsdal condominio nogales referencia 1', '-12.068698934233', '-76.995456016041', 'COMENTARIO', '2025-05-30', 2, '05:32:19', NULL, NULL, '2025-05-30 10:02:19', '2025-06-30 09:32:11'),
(13, NULL, '1', 3.34, 4, NULL, 0, NULL, NULL, 'NOMBRE EJEMPLO', NULL, '92438423', 17, 'e23e23', 'referencia', '-12.054118063171', '-76.975509706109', NULL, '2025-05-30', 2, '05:33:26', NULL, NULL, '2025-05-30 10:03:26', '2025-06-30 09:32:12'),
(14, 1, '1', 211.72, 2, NULL, 0, NULL, NULL, 'Alfredo Enrique', 'admin@admin.com', '953761235', 3, 'dir', '4   fsdal condominio nogales referencia 1', '-12.068698934233', '-76.995456016041', 'comentario', '2025-05-30', 2, '05:43:54', NULL, NULL, '2025-05-30 10:13:54', '2025-06-30 09:32:13'),
(15, 1, '1', 2.17, 3, NULL, 0, NULL, NULL, 'Alfredo Enrique', 'admin@admin.com', '953761235', 3, 'dir', '4   fsdal condominio nogales referencia 1', '-12.068698934233', '-76.995456016041', NULL, '2025-05-30', 4, '06:14:39', NULL, NULL, '2025-05-30 10:14:39', '2025-06-30 09:32:15'),
(16, 1, '1', 21.00, 4, NULL, 0, NULL, NULL, 'Alfredo Enrique', 'admin@admin.com', '953761235', 3, 'dir', '4   fsdal condominio nogales referencia 1', '-12.068698934233', '-76.995456016041', NULL, '2025-05-30', 3, '06:00:03', NULL, NULL, '2025-05-30 10:15:03', '2025-06-30 09:32:16'),
(17, 1, '1', 66.90, 3, NULL, 0, NULL, NULL, 'Alfredo Enrique', 'admin@admin.com', '953761235', 3, 'dir', '4   fsdal condominio nogales referencia 1', '-12.068698934233', '-76.995456016041', 'comentario 10', '2025-05-30', 3, '06:07:15', NULL, NULL, '2025-05-30 10:22:15', '2025-06-30 09:32:17'),
(18, 1, '1', 65.46, 2, NULL, 0, NULL, NULL, 'Alfredo Enrique', 'admin@admin.com', '953761235', 3, 'dir', '4   fsdal condominio nogales referencia 1', '-12.068698934233', '-76.995456016041', NULL, '2025-05-30', 3, '06:08:08', NULL, NULL, '2025-05-30 10:23:08', '2025-06-30 09:32:19'),
(19, 1, '1', 172.63, 3, NULL, 0, NULL, NULL, 'Alfredo Enrique', 'admin@admin.com', '953761235', 3, 'dir', '4   fsdal condominio nogales referencia 1', '-12.068698934233', '-76.995456016041', 'Comentarios', '2025-05-30', 2, '05:55:56', NULL, NULL, '2025-05-30 10:25:56', '2025-06-30 09:32:19'),
(20, 1, '1', 187.16, 1, '200', 0, NULL, NULL, 'Alfredo Enrique', 'admin@admin.com', '953761235', 4, 'avenida arequipa 23432', 'frente a la estacion', '-12.147417086506', '-77.023081509649', 'COMENTARIO', '2025-05-30', 2, '08:17:15', NULL, NULL, '2025-05-30 12:47:15', '2025-06-30 09:32:21'),
(21, 1, '1', 65.46, 2, NULL, 0, NULL, NULL, 'Alfredo Enrique', 'admin@admin.com', '953761235', 4, 'avenida arequipa 23432', 'frente a la estacion', '-12.147417086506', '-77.023081509649', NULL, '2025-05-30', 4, '08:49:02', NULL, NULL, '2025-05-30 12:49:02', '2025-06-30 09:32:24'),
(22, NULL, '1', 16.00, 3, NULL, 0, NULL, NULL, 'NOMBRE EJEMPLO', NULL, '24234', 8, 'direcciin', 'referencia 11111', '-12.054765591418', '-76.98270692881', NULL, '2025-05-30', 2, '08:20:48', NULL, NULL, '2025-05-30 12:50:48', '2025-06-30 09:32:25'),
(23, 1, '1', 77.54, 2, NULL, 0, NULL, NULL, 'Alfredo Enrique', 'admin@admin.com', '953761235', 4, 'avenida arequipa 23432', 'frente a la estacion', '-12.147417086506', '-77.023081509649', NULL, '2025-05-30', 2, '08:24:38', NULL, NULL, '2025-05-30 12:54:38', '2025-06-30 09:32:25'),
(24, 23, 'pendiente', 16.00, 2, NULL, 0, NULL, NULL, 'AaronDev', 'aaron.dev@gmail.com', '956569197', 2, 'Pruebas Mz g3 20', 'asdd', '-11.9754572', '-76.8410285', 'asdd', '2025-05-31', 2, '12:38:49', NULL, NULL, '2025-05-31 17:08:49', '2025-05-31 17:09:32'),
(25, 1, '2', 16.00, 3, NULL, 0, NULL, NULL, 'Alfredo Enrique', 'admin@admin.com', '953761235', 4, 'avenida arequipa 23432', 'frente a la estacion', '-12.147417086506', '-77.023081509649', NULL, '2025-05-31', 3, '14:17:53', NULL, NULL, '2025-05-31 18:32:53', '2025-06-30 09:31:53'),
(26, 1, '2', 8.00, 3, NULL, 0, NULL, NULL, 'Alfredo Enrique', 'admin@admin.com', '953761235', 4, 'avenida arequipa 23432', 'frente a la estacion', '-12.147417086506', '-77.023081509649', NULL, '2025-05-31', 2, '14:04:50', NULL, NULL, '2025-05-31 18:34:50', '2025-06-30 09:31:56'),
(27, 1, '2', 10.00, 3, NULL, 0, NULL, NULL, 'Alfredo Enrique', 'admin@admin.com', '953761235', 4, 'avenida arequipa 23432', 'frente a la estacion', '-12.147417086506', '-77.023081509649', NULL, '2025-05-31', 2, '15:30:20', NULL, NULL, '2025-05-31 20:00:20', '2025-06-30 09:31:58'),
(28, 1, '8', 16.00, 2, NULL, 0, NULL, NULL, 'Alfredo Enrique', 'admin@admin.com', '953761235', 4, 'avenida arequipa 23432', 'frente a la estacion', '-12.147417086506', '-77.023081509649', NULL, '2025-05-31', 4, '16:02:39', NULL, NULL, '2025-05-31 20:02:39', '2025-06-30 09:32:02'),
(29, 1, '8', 16.00, 3, NULL, 0, NULL, NULL, 'Alfredo Enrique', 'admin@admin.com', '953761235', 4, 'avenida arequipa 23432', 'frente a la estacion', '-12.147417086506', '-77.023081509649', NULL, '2025-05-31', 4, '16:04:08', NULL, NULL, '2025-05-31 20:04:08', '2025-06-30 09:32:06'),
(30, 1, 'en_proceso', 22.00, 2, NULL, 0, NULL, NULL, 'Alfredo Enrique', 'admin@admin.com', '953761235', 4, 'avenida arequipa 23432', 'frente a la estacion', '-12.147417086506', '-77.023081509649', NULL, '2025-06-01', 2, '16:39:20', NULL, NULL, '2025-06-01 21:09:20', '2025-06-01 21:10:01'),
(31, 1, '8', 16.00, 2, NULL, 0, NULL, NULL, 'Alfredo Enrique', 'admin@admin.com', '953761235', 3, 'dir', '4   fsdal condominio nogales referencia 1', '-12.068698934233', '-76.995456016041', NULL, '2025-06-03', 2, '12:38:05', NULL, NULL, '2025-06-03 17:08:05', '2025-06-05 09:06:01'),
(32, 1, '2', 16.00, 2, NULL, 0, NULL, NULL, 'Alfredo Enrique', 'admin@admin.com', '953761235', 3, 'dir', '4   fsdal condominio nogales referencia 1', '-12.068698934233', '-76.995456016041', NULL, '2025-06-03', 3, '12:54:57', NULL, NULL, '2025-06-03 17:09:57', '2025-06-06 15:00:44'),
(33, 23, '2', 22.00, 1, '20', 0, NULL, NULL, 'AaronDev', 'aaron.dev@gmail.com', '956569197', 2, 'Pruebas Mz g3 20', 'asdd', '-11.9754572', '-76.8410285', NULL, '2025-06-03', 2, '17:02:38', NULL, NULL, '2025-06-03 21:32:38', '2025-06-06 15:00:49'),
(34, 1, '2', 20.00, 2, NULL, 0, NULL, NULL, 'Alfredo Enrique', 'admin@admin.com', '953761235', 3, 'dir', '4   fsdal condominio nogales referencia 1', '-12.068698934233', '-76.995456016041', NULL, '2025-06-03', 2, '17:10:08', NULL, NULL, '2025-06-03 21:40:08', '2025-06-05 09:05:54'),
(35, 23, '9', 38.00, 3, NULL, 0, NULL, NULL, 'AaronDev', 'aaron.dev@gmail.com', '956569197', 2, 'Pruebas Mz g3 20', 'asdd', '-11.9754572', '-76.8410285', NULL, '2025-06-04', 3, '03:18:36', NULL, NULL, '2025-06-04 07:33:36', '2025-06-04 07:33:55'),
(36, 23, '9', 38.00, 2, NULL, 0, NULL, NULL, 'AaronDev', 'aaron.dev@gmail.com', '956569197', 2, 'Pruebas Mz g3 20', 'asdd', '-11.9754572', '-76.8410285', NULL, '2025-06-04', 4, '05:34:53', NULL, NULL, '2025-06-04 09:34:53', '2025-06-04 09:35:08'),
(37, 1, '9', 12.00, 2, NULL, 0, NULL, NULL, 'Alfredo Enrique', 'admin@admin.com', '953761235', 3, 'dir', '4   fsdal condominio nogales referencia 1', '-12.068698934233', '-76.995456016041', NULL, '2025-06-04', 4, '08:40:45', NULL, NULL, '2025-06-04 12:40:45', '2025-06-04 12:42:21'),
(38, 1, '5', 65.00, 3, NULL, 0, NULL, NULL, 'Alfredo Enrique', 'admin@admin.com', '953761235', 3, 'dir', '4   fsdal condominio nogales referencia 1', '-12.068698934233', '-76.995456016041', NULL, '2025-06-04', 3, '08:26:45', NULL, NULL, '2025-06-04 12:41:45', '2025-06-04 12:43:31'),
(39, 1, '9', 80.00, 3, NULL, 0, NULL, NULL, 'Alfredo Enrique', 'admin@admin.com', '953761235', 3, 'dir', '4   fsdal condominio nogales referencia 1', '-12.068698934233', '-76.995456016041', NULL, '2025-06-04', 4, '09:01:09', NULL, NULL, '2025-06-04 13:01:09', '2025-06-04 13:04:43'),
(40, 1, '2', 12.00, 4, NULL, 0, NULL, NULL, 'Alfredo Enrique', 'admin@admin.com', '953761235', 3, 'dir', '4   fsdal condominio nogales referencia 1', '-12.068698934233', '-76.995456016041', NULL, '2025-06-05', 4, '10:18:54', NULL, NULL, '2025-06-05 14:18:54', '2025-06-05 14:25:46'),
(41, 1, '2', 71.00, 2, NULL, 0, NULL, NULL, 'Alfredo Enrique', 'admin@admin.com', '953761235', 3, 'dir', '4   fsdal condominio nogales referencia 1', '-12.068698934233', '-76.995456016041', NULL, '2025-06-05', 2, '09:49:46', NULL, NULL, '2025-06-05 14:19:46', '2025-06-05 14:29:03'),
(42, 1, '2', 36.00, 2, NULL, 0, NULL, NULL, 'Alfredo Enrique', 'admin@admin.com', '953761235', 3, 'dir', '4   fsdal condominio nogales referencia 1', '-12.068698934233', '-76.995456016041', NULL, '2025-06-05', 3, '10:05:23', NULL, NULL, '2025-06-05 14:20:23', '2025-06-05 14:26:33'),
(43, 1, '8', 91.00, 2, NULL, 0, NULL, NULL, 'Alfredo Enrique', 'admin@admin.com', '953761235', 3, 'dir', '4   fsdal condominio nogales referencia 1', '-12.068698934233', '-76.995456016041', NULL, '2025-06-05', 4, '10:31:10', NULL, NULL, '2025-06-05 14:31:10', '2025-06-05 14:44:24'),
(44, 1, '8', 27.00, 3, NULL, 0, NULL, NULL, 'Alfredo Enrique', 'admin@admin.com', '953761235', 3, 'dir', '4   fsdal condominio nogales referencia 1', '-12.068698934233', '-76.995456016041', NULL, '2025-06-05', 3, '10:16:39', NULL, NULL, '2025-06-05 14:31:39', '2025-06-05 14:43:32'),
(45, 1, '8', 16.00, 2, NULL, 0, NULL, NULL, 'Alfredo Enrique', 'admin@admin.com', '953761235', 3, 'dir', '4   fsdal condominio nogales referencia 1', '-12.068698934233', '-76.995456016041', NULL, '2025-06-05', 3, '10:26:26', NULL, NULL, '2025-06-05 14:41:26', '2025-06-05 14:43:36'),
(46, 1, '9', 27.00, 2, NULL, 0, NULL, NULL, 'Alfredo Enrique', 'admin@admin.com', '953761235', 3, 'dir', '4   fsdal condominio nogales referencia 1', '-12.068698934233', '-76.995456016041', NULL, '2025-06-05', 3, '10:30:47', NULL, NULL, '2025-06-05 14:45:47', '2025-06-05 23:20:31'),
(47, 1, '2', 27.00, 3, NULL, 0, NULL, NULL, 'Alfredo Enrique', 'admin@admin.com', '953761235', 3, 'dir', '4   fsdal condominio nogales referencia 1', '-12.068698934233', '-76.995456016041', NULL, '2025-06-05', 3, '10:31:14', NULL, NULL, '2025-06-05 14:46:14', '2025-06-05 23:20:49'),
(48, 1, '2', 38.00, 2, NULL, 0, NULL, NULL, 'Alfredo Enrique', 'admin@admin.com', '953761235', 3, 'dir', '4   fsdal condominio nogales referencia 1', '-12.068698934233', '-76.995456016041', NULL, '2025-06-05', 3, '10:32:04', NULL, NULL, '2025-06-05 14:47:04', '2025-06-05 23:20:53'),
(49, 1, '9', 16.00, 2, NULL, 0, NULL, NULL, 'Alfredo Enrique', 'admin@admin.com', '953761235', 3, 'dir', '4   fsdal condominio nogales referencia 1', '-12.068698934233', '-76.995456016041', NULL, '2025-06-05', 4, '10:50:35', NULL, NULL, '2025-06-05 14:50:35', '2025-06-05 23:20:56'),
(50, 1, '9', 23.00, 3, NULL, 0, NULL, NULL, 'Alfredo Enrique', 'admin@admin.com', '953761235', 3, 'dir', '4   fsdal condominio nogales referencia 1', '-12.068698934233', '-76.995456016041', NULL, '2025-06-05', 3, '10:36:25', NULL, NULL, '2025-06-05 14:51:25', '2025-06-05 23:20:20'),
(51, 1, '8', 16.00, 2, NULL, 0, NULL, NULL, 'Alfredo Enrique', 'admin@admin.com', '953761235', 3, 'dir', '4   fsdal condominio nogales referencia 1', '-12.068698934233', '-76.995456016041', NULL, '2025-06-05', 3, '19:08:58', NULL, NULL, '2025-06-05 23:23:58', '2025-06-05 23:27:41'),
(52, 1, '2', 31.00, 3, NULL, 0, NULL, NULL, 'Alfredo Enrique', 'admin@admin.com', '953761235', 3, 'dir', '4   fsdal condominio nogales referencia 1', '-12.068698934233', '-76.995456016041', NULL, '2025-06-05', 2, '18:54:40', NULL, NULL, '2025-06-05 23:24:40', '2025-06-05 23:28:06'),
(53, 1, '2', 58.00, 3, NULL, 0, NULL, NULL, 'Alfredo Enrique', 'admin@admin.com', '953761235', 3, 'dir', '4   fsdal condominio nogales referencia 1', '-12.068698934233', '-76.995456016041', NULL, '2025-06-05', 3, '19:10:13', NULL, NULL, '2025-06-05 23:25:13', '2025-06-05 23:27:56'),
(54, 1, '2', 16.00, 2, NULL, 0, NULL, NULL, 'Alfredo Enrique', 'admin@admin.com', '953761235', 3, 'dir', '4   fsdal condominio nogales referencia 1', '-12.068698934233', '-76.995456016041', NULL, '2025-06-06', 3, '07:38:36', NULL, NULL, '2025-06-06 11:53:36', '2025-06-06 15:00:58'),
(55, 1, '2', 28.00, 3, NULL, 0, NULL, NULL, 'Alfredo Enrique', 'admin@admin.com', '953761235', 3, 'dir', '4   fsdal condominio nogales referencia 1', '-12.068698934233', '-76.995456016041', NULL, '2025-06-07', 3, '23:29:19', NULL, NULL, '2025-06-08 03:44:19', '2025-06-30 09:31:31'),
(56, 1, '2', 16.00, 2, NULL, 0, NULL, NULL, 'Alfredo Enrique', 'admin@admin.com', '953761235', 3, 'dir', '4   fsdal condominio nogales referencia 1', '-12.068698934233', '-76.995456016041', NULL, '2025-06-09', 3, '16:12:15', NULL, NULL, '2025-06-09 20:27:15', '2025-06-09 20:29:13'),
(57, 23, '4', 16.00, 2, NULL, 0, NULL, NULL, 'AaronDev', 'aaron.dev@gmail.com', '956569197', 2, 'Pruebas Mz g3 20', 'asdd', '-11.9754572', '-76.8410285', '16', '2025-06-11', 1, '13:51:51', 17, NULL, '2025-06-11 18:36:51', '2025-06-11 18:37:48'),
(58, 1, '4', 16.00, 2, NULL, 1, 1, '64564564', 'Alfredo Enrique', 'admin@admin.com', '953761235', 3, 'dir', '4   fsdal condominio nogales referencia 1', '-12.068698934233', '-76.995456016041', NULL, '2025-06-14', 2, '13:42:04', 18, NULL, '2025-06-14 18:12:04', '2025-06-14 18:20:13'),
(59, 1, '4', 155.23, 2, NULL, 0, NULL, NULL, 'Alfredo Enrique', 'admin@admin.com', '953761235', 3, 'dir', '4   fsdal condominio nogales referencia 1', '-12.068698934233', '-76.995456016041', NULL, '2025-06-16', 3, '07:12:02', 17, NULL, '2025-06-16 11:27:02', '2025-06-16 11:34:06'),
(60, 23, '6', 14.00, 1, '23', 0, NULL, NULL, 'AaronDev', 'aaron.dev@gmail.com', '956569197', 2, 'Pruebas Mz g3 20', 'asdd', '-11.9754572', '-76.8410285', NULL, '2025-06-18', 5, '10:40:20', 17, NULL, '2025-06-18 14:25:20', '2025-06-18 15:23:06'),
(61, 23, '6', 8.00, 3, NULL, 0, NULL, NULL, 'AaronDev', 'aaron.dev@gmail.com', '956569197', 2, 'Pruebas Mz g3 20', 'asdd', '-11.9754572', '-76.8410285', NULL, '2025-06-18', 4, '11:23:36', 17, NULL, '2025-06-18 15:23:36', '2025-06-18 15:24:45'),
(62, 1, '4', 16.00, 2, NULL, 0, NULL, NULL, 'Alfredo Enrique', 'admin@admin.com', '953761235', 3, 'dir', '4   fsdal condominio nogales referencia 1', '-12.068698934233', '-76.995456016041', NULL, '2025-06-20', 5, '05:16:49', 17, NULL, '2025-06-20 09:01:49', '2025-06-20 09:05:47'),
(63, 1, '4', 59.29, 2, NULL, 0, NULL, NULL, 'Alfredo Enrique', 'admin@admin.com', '953761235', 3, 'dir', '4   fsdal condominio nogales referencia 1', '-12.068698934233', '-76.995456016041', NULL, '2025-06-20', 3, '04:55:26', 17, NULL, '2025-06-20 09:10:26', '2025-06-20 09:11:59'),
(64, 1, '4', 3.34, 2, NULL, 0, NULL, NULL, 'Alfredo Enrique', 'admin@admin.com', '953761235', 4, 'avenida arequipa 23432', 'frente a la estacion', '-12.147417086506', '-77.023081509649', NULL, '2025-06-20', 2, '04:43:32', 17, NULL, '2025-06-20 09:13:32', '2025-06-20 09:13:48'),
(65, 1, '6', 10.36, 2, NULL, 0, NULL, NULL, 'Alfredo Enrique', 'admin@admin.com', '953761235', 3, 'avenida nogales 251 dirección 1', 'frente al condominio nogales referencia 1', '-12.057787343297', '-76.976732302704', NULL, '2025-06-20', 2, '04:45:44', 17, NULL, '2025-06-20 09:15:44', '2025-06-20 09:21:38'),
(66, 1, '6', 7.44, 1, '555', 0, NULL, NULL, 'Alfredo Enrique', 'admin@admin.com', '953761235', 15, 'ave la victoria', 'referencia la victoria', '-12.080617244825', '-77.020375197044', NULL, '2025-06-20', 2, '04:47:05', 17, NULL, '2025-06-20 09:17:05', '2025-06-20 09:20:42'),
(67, 1, '6', 16.00, 2, NULL, 0, NULL, NULL, 'Alfredo Enrique', 'admin@admin.com', '953761235', 15, 'ave la victoria', 'referencia la victoria', '-12.080617244825', '-77.020375197044', NULL, '2025-06-21', 3, '19:23:08', 17, NULL, '2025-06-21 23:38:08', '2025-06-21 23:43:05'),
(68, 1, '3', 16.00, 2, NULL, 0, NULL, NULL, 'Alfredo Enrique', 'admin@admin.com', '953761235', 4, 'avenida arequipa 23432', 'frente a la estacion', '-12.147417086506', '-77.023081509649', NULL, '2025-06-25', 3, '12:44:40', 0, NULL, '2025-06-25 16:59:40', '2025-06-25 18:12:08'),
(69, 1, '6', 44.00, 3, NULL, 0, NULL, NULL, 'Alfredo Enrique', 'admin@admin.com', '953761235', 4, 'avenida arequipa 23432', 'frente a la estacion', '-12.147417086506', '-77.023081509649', NULL, '2025-06-25', 2, '12:34:12', 17, NULL, '2025-06-25 17:04:12', '2025-06-25 17:27:15'),
(70, 4, '2', 16.00, 2, NULL, 1, 2, '73776464', 'Lucía Pérez', 'lucia@cliente.com', '900000002', 14, 'Av. Javier Prado 101', 'Frente a la escuela', '0', '0', '16', '2025-07-09', 2, '14:32:52', NULL, NULL, '2025-07-09 19:02:52', '2025-07-09 19:02:52'),
(71, 23, '2', 16.00, 1, '100', 1, 2, '73776464', 'AaronDev', 'aaron.dev@gmail.com', '956569197', 2, 'Pruebas Mz g3 20', 'asdd', '-11.9754572', '-76.8410285', '16', '2025-07-09', 4, '15:04:24', NULL, NULL, '2025-07-09 19:04:24', '2025-07-09 19:04:24'),
(72, 23, '4', 8.00, 3, NULL, 0, NULL, NULL, 'AaronDev', 'aaron.dev@gmail.com', '956569197', 2, 'Pruebas Mz g3 20', 'asdd', '-11.9754572', '-76.8410285', '8', '2025-07-12', 3, '12:23:23', 17, NULL, '2025-07-12 16:38:23', '2025-07-12 18:29:07'),
(75, 23, '4', 16.00, 1, '100', 1, 1, '73776464', 'AaronDev', 'aaron.dev@gmail.com', '956569197', 4, 'Av las casas, nuevas lomas', 'asdd', '-11.9753448', '-76.8410796', NULL, '2025-07-13', 5, '02:09:52', 17, NULL, '2025-07-13 05:54:52', '2025-07-13 05:57:05'),
(77, NULL, '1', 14.00, 1, '100', 0, NULL, NULL, 'Aaron', NULL, '9556569197', 17, 'lima', 'lima', '-11.975426', '-76.8410438', '17 total', '2025-07-16', 5, '12:39:41', NULL, NULL, '2025-07-16 16:24:41', '2025-07-16 16:24:41'),
(78, 1, '2', 13.00, 4, NULL, 0, NULL, NULL, 'Alfredo Enrique', 'admin@admin.com', '953761235', 15, 'ave la victoria', 'referencia la victoria', '-12.080617244825', '-77.020375197044', 'Sin arroz (fresca aparte en una bolsa)', '2025-07-17', 2, '13:36:31', NULL, NULL, '2025-07-17 18:06:31', '2025-07-31 15:33:38'),
(79, 1, '4', 13.00, 4, NULL, 0, NULL, NULL, 'Alfredo Enrique', 'admin@admin.com', '953761235', 18, 'direccion avenida los n345345', 'referencia 250', '-12.059550013822', '-77.006874207211', NULL, '2025-07-17', 4, '14:12:42', 17, NULL, '2025-07-17 18:12:42', '2025-07-17 18:18:15'),
(80, 1, '2', 16.00, 2, NULL, 0, NULL, NULL, 'Alfredo Enrique', 'admin@admin.com', '953761235', 18, 'direccion avenida los n345345', 'referencia 250', '-12.059550013822', '-77.006874207211', NULL, '2025-07-25', 3, '14:43:28', NULL, NULL, '2025-07-25 18:58:28', '2025-07-25 18:58:28'),
(81, 1, '6', 14.00, 2, NULL, 0, NULL, NULL, 'Alfredo Enrique', 'admin@admin.com', '953761235', 18, 'direccion avenida los n345345', 'referencia 250', '-12.059550013822', '-77.006874207211', NULL, '2025-07-29', 2, '20:34:30', 17, NULL, '2025-07-30 01:04:30', '2025-07-30 01:33:06'),
(82, 1, '6', 29.00, 3, NULL, 0, NULL, NULL, 'Alfredo Enrique', 'admin@admin.com', '953761235', 18, 'direccion avenida los n345345', 'referencia 250', '-12.059550013822', '-77.006874207211', NULL, '2025-07-29', 2, '20:36:18', 17, NULL, '2025-07-30 01:06:18', '2025-07-30 01:32:45'),
(83, 1, '6', 14.00, 2, NULL, 0, NULL, NULL, 'Alfredo Enrique', 'admin@admin.com', '953761235', 18, 'direccion avenida los n345345', 'referencia 250', '-12.059550013822', '-77.006874207211', NULL, '2025-07-29', 3, '20:55:39', 17, NULL, '2025-07-30 01:10:39', '2025-07-30 01:31:59'),
(84, 1, '6', 13.00, 3, NULL, 0, NULL, NULL, 'Alfredo Enrique', 'admin@admin.com', '953761235', 18, 'direccion avenida los n345345', 'referencia 250', '-12.059550013822', '-77.006874207211', NULL, '2025-07-29', 2, '20:42:38', 17, NULL, '2025-07-30 01:12:38', '2025-07-30 01:31:09'),
(85, 1, '6', 29.00, 2, NULL, 0, NULL, NULL, 'Alfredo Enrique', 'admin@admin.com', '953761235', 18, 'direccion avenida los n345345', 'referencia 250', '-12.059550013822', '-77.006874207211', NULL, '2025-07-29', 3, '21:34:11', 17, NULL, '2025-07-30 01:49:11', '2025-07-30 01:51:51'),
(86, 1, '9', 14.00, 4, NULL, 0, NULL, NULL, 'Alfredo Enrique', 'admin@admin.com', '953761235', 18, 'direccion avenida los n345345', 'referencia 250', '-12.059550013822', '-77.006874207211', NULL, '2025-07-30', 2, '22:10:23', NULL, NULL, '2025-07-31 02:40:23', '2025-07-31 02:40:35'),
(87, 1, '4', 14.00, 2, NULL, 0, NULL, NULL, 'Alfredo Enrique', 'admin@admin.com', '953761235', 18, 'direccion avenida los n345345', 'referencia 250', '-12.059550013822', '-77.006874207211', NULL, '2025-07-30', 3, '22:26:06', 17, NULL, '2025-07-31 02:41:06', '2025-07-31 02:53:53'),
(88, 1, '4', 13.00, 2, NULL, 0, NULL, NULL, 'Alfredo Enrique', 'admin@admin.com', '953761235', 18, 'direccion avenida los n345345', 'referencia 250', '-12.059550013822', '-77.006874207211', NULL, '2025-07-30', 4, '22:51:48', 17, NULL, '2025-07-31 02:51:48', '2025-07-31 02:54:05'),
(89, 1, '2', 14.00, 3, NULL, 0, NULL, NULL, 'Alfredo Enrique', 'admin@admin.com', '953761235', 18, 'direccion avenida los n345345', 'referencia 250', '-12.059550013822', '-77.006874207211', NULL, '2025-07-30', 3, '22:40:00', NULL, NULL, '2025-07-31 02:55:00', '2025-07-31 02:55:10'),
(90, 23, '5', 29.00, 2, NULL, 0, NULL, NULL, 'AaronDev', 'aaron.dev@gmail.com', '956569197', 4, 'Av las casas, nuevas lomas', 'asdd', '-11.9753448', '-76.8410796', 'asddas', '2025-07-31', 2, '11:06:29', 17, NULL, '2025-07-31 15:36:29', '2025-07-31 15:39:54'),
(91, 23, '1', 8.00, 1, '21', 0, NULL, NULL, 'AaronDev', 'aaron.dev@gmail.com', '956569197', 4, 'Av las casas, nuevas lomas', 'asdd', '-11.9753448', '-76.8410796', NULL, '2025-08-01', 1, '12:59:44', NULL, NULL, '2025-08-01 17:44:44', '2025-08-01 17:44:44'),
(92, 23, '1', 34.00, 2, NULL, 0, NULL, NULL, 'AaronDev', 'aaron.dev@gmail.com', '956569197', 4, 'Av las casas, nuevas lomas', 'asdd', '-11.9753448', '-76.8410796', '34', '2025-08-01', 2, '13:25:33', NULL, NULL, '2025-08-01 17:55:33', '2025-08-01 17:55:33'),
(93, 1, '2', 16.00, 2, NULL, 0, NULL, NULL, 'Alfredo Enrique', 'admin@admin.com', '953761235', 18, 'direccion avenida los n345345', 'referencia 250', '-12.059550013822', '-77.006874207211', NULL, '2025-08-08', 3, '14:18:58', NULL, NULL, '2025-08-08 18:33:58', '2025-08-08 18:34:12'),
(94, 1, '4', 34.00, 3, NULL, 0, NULL, NULL, 'Alfredo Enrique', 'admin@admin.com', '953761235', 18, 'direccion avenida los n345345', 'referencia 250', '-12.059550013822', '-77.006874207211', NULL, '2025-08-15', 2, '02:57:46', 17, NULL, '2025-08-15 07:27:46', '2025-08-15 08:10:42'),
(95, 1, '4', 69.00, 3, NULL, 0, NULL, NULL, 'Alfredo Enrique', 'admin@admin.com', '953761235', 18, 'direccion avenida los n345345', 'referencia 250', '-12.059550013822', '-77.006874207211', NULL, '2025-08-15', 2, '03:15:14', 18, NULL, '2025-08-15 07:45:14', '2025-08-15 08:10:30'),
(96, 1, '4', 77.90, 2, NULL, 0, NULL, NULL, 'Alfredo Enrique', 'admin@admin.com', '953761235', 18, 'direccion avenida los n345345', 'referencia 250', '-12.059550013822', '-77.006874207211', NULL, '2025-08-15', 2, '03:21:26', 18, NULL, '2025-08-15 07:51:26', '2025-08-15 08:10:26'),
(97, 1, '4', 16.00, 2, NULL, 0, NULL, NULL, 'Alfredo Enrique', 'admin@admin.com', '953761235', 18, 'direccion avenida los n345345', 'referencia 250', '-12.059550013822', '-77.006874207211', NULL, '2025-08-15', 1, '03:13:00', 17, NULL, '2025-08-15 07:58:00', '2025-08-15 08:08:52'),
(98, 1, '4', 16.00, 2, NULL, 0, NULL, NULL, 'Alfredo Enrique', 'admin@admin.com', '953761235', 18, 'direccion avenida los n345345', 'referencia 250', '-12.059550013822', '-77.006874207211', NULL, '2025-08-15', 1, '03:14:42', 18, NULL, '2025-08-15 07:59:42', '2025-08-15 08:10:15'),
(99, 1, '3', 8.00, 2, NULL, 0, NULL, NULL, 'Alfredo Enrique', 'admin@admin.com', '953761235', 18, 'direccion avenida los n345345', 'referencia 250', '-12.059550013822', '-77.006874207211', NULL, '2025-08-15', 1, '03:18:20', NULL, NULL, '2025-08-15 08:03:20', '2025-08-15 08:11:01'),
(100, 1, '3', 8.00, 3, NULL, 0, NULL, NULL, 'Alfredo Enrique', 'admin@admin.com', '953761235', 18, 'direccion avenida los n345345', 'referencia 250', '-12.059550013822', '-77.006874207211', NULL, '2025-08-15', 2, '03:49:21', NULL, NULL, '2025-08-15 08:19:21', '2025-08-15 08:21:51'),
(101, 1, '3', 8.00, 2, NULL, 0, NULL, NULL, 'Alfredo Enrique', 'admin@admin.com', '953761235', 18, 'direccion avenida los n345345', 'referencia 250', '-12.059550013822', '-77.006874207211', NULL, '2025-08-15', 3, '04:04:48', NULL, NULL, '2025-08-15 08:19:48', '2025-08-15 08:21:47'),
(102, 1, '3', 8.00, 2, NULL, 0, NULL, NULL, 'Alfredo Enrique', 'admin@admin.com', '953761235', 18, 'direccion avenida los n345345', 'referencia 250', '-12.059550013822', '-77.006874207211', NULL, '2025-08-15', 1, '03:35:48', NULL, NULL, '2025-08-15 08:20:48', '2025-08-15 08:21:43'),
(103, 1, '2', 16.00, 3, NULL, 0, NULL, NULL, 'Alfredo Enrique', 'admin@admin.com', '953761235', 18, 'direccion avenida los n345345', 'referencia 250', '-12.059550013822', '-77.006874207211', NULL, '2025-08-15', 2, '03:52:34', NULL, NULL, '2025-08-15 08:22:34', '2025-08-15 08:22:34'),
(104, 1, '2', 16.00, 2, NULL, 0, NULL, NULL, 'Alfredo Enrique', 'admin@admin.com', '953761235', 18, 'direccion avenida los n345345', 'referencia 250', '-12.059550013822', '-77.006874207211', NULL, '2025-08-21', 3, '16:31:59', NULL, NULL, '2025-08-21 20:46:59', '2025-08-21 20:46:59'),
(105, 1, '2', 16.00, 2, NULL, 0, NULL, NULL, 'Alfredo Enrique', 'admin@admin.com', '953761235', 18, 'direccion avenida los n345345', 'referencia 250', '-12.059550013822', '-77.006874207211', NULL, '2025-08-22', 3, '01:32:35', NULL, NULL, '2025-08-22 05:47:35', '2025-08-22 05:47:35'),
(106, 1, '2', 26.00, 2, NULL, 0, NULL, NULL, 'Alfredo Enrique', 'admin@admin.com', '953761235', 18, 'direccion avenida los n345345', 'referencia 250', '-12.059550013822', '-77.006874207211', NULL, '2025-08-22', 3, '03:05:34', NULL, NULL, '2025-08-22 07:20:34', '2025-08-22 07:20:34'),
(107, 1, '4', 89.90, 3, NULL, 0, NULL, NULL, 'Alfredo Enrique', 'admin@admin.com', '953761235', 18, 'direccion avenida los n345345', 'referencia 250', '-12.059550013822', '-77.006874207211', NULL, '2025-08-27', 2, '18:14:54', 18, NULL, '2025-08-27 22:44:54', '2025-08-27 22:45:31'),
(108, 1, '6', 54.00, 2, NULL, 0, NULL, NULL, 'Alfredo Enrique', 'admin@admin.com', '953761235', 18, 'direccion avenida los n345345', 'referencia 250', '-12.059550013822', '-77.006874207211', NULL, '2025-08-31', 4, '13:19:57', 18, NULL, '2025-08-31 17:19:57', '2025-08-31 17:22:42'),
(109, 1, '2', 8.00, 2, NULL, 0, NULL, NULL, 'Alfredo Enrique', 'admin@admin.com', '953761235', 18, 'direccion avenida los n345345', 'referencia 250', '-12.059550013822', '-77.006874207211', NULL, '2025-11-07', 6, NULL, NULL, NULL, '2025-11-08 00:48:42', '2025-11-08 00:48:42'),
(110, 1, '2', 12.00, 2, NULL, 0, NULL, NULL, 'Alfredo Enrique', 'admin@admin.com', '953761235', 18, 'direccion avenida los n345345', 'referencia 250', '-12.059550013822', '-77.006874207211', NULL, '2025-11-08', 5, '17:34:37', NULL, NULL, '2025-11-08 21:19:37', '2025-11-08 21:19:37'),
(111, 1, '2', 16.00, 3, NULL, 0, NULL, NULL, 'Alfredo Enrique', 'admin@admin.com', '953761235', 18, 'direccion avenida los n345345', 'referencia 250', '-12.059550013822', '-77.006874207211', NULL, '2025-11-08', 6, NULL, NULL, NULL, '2025-11-08 21:20:38', '2025-11-08 21:20:38'),
(112, 1, '2', 8.00, 4, NULL, 0, NULL, NULL, 'Alfredo Enrique', 'admin@admin.com', '953761235', 18, 'direccion avenida los n345345', 'referencia 250', '-12.059550013822', '-77.006874207211', NULL, '2025-11-08', 6, NULL, NULL, NULL, '2025-11-08 21:21:32', '2025-11-08 21:21:32'),
(113, 1, '2', 13.00, 2, NULL, 0, NULL, NULL, 'Alfredo Enrique', 'admin@admin.com', '953761235', 18, 'direccion avenida los n345345', 'referencia 250', '-12.059550013822', '-77.006874207211', NULL, '2025-11-08', 6, NULL, NULL, NULL, '2025-11-08 21:29:13', '2025-11-08 21:29:13'),
(114, 1, '2', 218.00, 4, NULL, 0, NULL, NULL, 'Alfredo Enrique', 'admin@admin.com', '953761235', 18, 'direccion avenida los n345345', 'referencia 250', '-12.059550013822', '-77.006874207211', NULL, '2026-02-01', 5, '23:01:03', NULL, NULL, '2026-02-02 02:46:03', '2026-02-02 02:46:03'),
(115, 1, '2', 42.00, 4, NULL, 0, NULL, NULL, 'Alfredo Enrique', 'admin@admin.com', '953761235', 18, 'direccion avenida los n345345', 'referencia 250', '-12.059550013822', '-77.006874207211', NULL, '2026-02-01', 5, '23:02:12', NULL, NULL, '2026-02-02 02:47:12', '2026-02-02 02:47:12');

-- --------------------------------------------------------

--
-- Table structure for table `pedido_comensales`
--

CREATE TABLE `pedido_comensales` (
  `id` int NOT NULL,
  `id_pedido` int NOT NULL,
  `id_user_cliente` int DEFAULT NULL COMMENT '	en caso tenga un id_user cliente quiere decir que es el cliente, sino, son los compañeros de el	',
  `nombre_comensal` varchar(100) NOT NULL,
  `estado` varchar(5) NOT NULL DEFAULT '0' COMMENT '0: pendiente; 1: confirmado; 2: en preparación; 3: en camino; 4: entregado; 9: rechazado;	',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `pedido_comensales`
--

INSERT INTO `pedido_comensales` (`id`, `id_pedido`, `id_user_cliente`, `nombre_comensal`, `estado`, `created_at`, `updated_at`) VALUES
(1, 1, NULL, 'Comensal 1', '0', '2025-04-10 03:12:45', '2025-04-10 03:12:45'),
(2, 2, NULL, 'Comensal 1', '0', '2025-04-10 03:12:45', '2025-04-10 03:12:45'),
(3, 2, NULL, 'Comensal 2', '0', '2025-04-10 03:12:45', '2025-04-10 03:12:45'),
(4, 2, NULL, 'Comensal 3', '0', '2025-04-10 03:12:45', '2025-04-10 03:12:45'),
(5, 3, NULL, 'Comensal 1', '0', '2025-04-10 03:12:45', '2025-04-10 03:12:45'),
(6, 4, NULL, 'Comensal 1', '0', '2025-04-10 03:12:45', '2025-04-10 03:12:45'),
(7, 4, NULL, 'Comensal 2', '0', '2025-04-10 03:12:45', '2025-04-10 03:12:45'),
(8, 5, NULL, 'Comensal 1', '0', '2025-04-10 03:12:45', '2025-04-10 03:12:45'),
(9, 6, NULL, 'Comensal 1', '0', '2025-04-10 03:12:45', '2025-04-10 03:12:45'),
(10, 6, NULL, 'Comensal 2', '0', '2025-04-10 03:12:45', '2025-04-10 03:12:45'),
(11, 6, NULL, 'Comensal 3', '0', '2025-04-10 03:12:45', '2025-04-10 03:12:45'),
(12, 7, NULL, 'Comensal 1', '0', '2025-04-10 03:12:45', '2025-04-10 03:12:45'),
(13, 8, NULL, 'Comensal 1', '0', '2025-04-10 03:12:45', '2025-04-10 03:12:45'),
(14, 9, NULL, 'Comensal 1', '0', '2025-04-10 03:12:45', '2025-04-10 03:12:45'),
(15, 10, NULL, 'Comensal 1', '0', '2025-04-10 03:12:45', '2025-04-10 03:12:45'),
(16, 10, NULL, 'Comensal 2', '0', '2025-04-10 03:12:45', '2025-04-10 03:12:45'),
(17, 11, NULL, 'JUAN', '0', '2025-05-30 09:43:56', '2025-05-30 09:43:56'),
(18, 11, NULL, 'MARIA', '0', '2025-05-30 09:43:56', '2025-05-30 09:43:56'),
(19, 12, NULL, 'JUAN', '0', '2025-05-30 10:02:19', '2025-05-30 10:02:19'),
(20, 12, NULL, 'MARIA', '0', '2025-05-30 10:02:19', '2025-05-30 10:02:19'),
(21, 13, NULL, 'COMENSAL 1', '0', '2025-05-30 10:03:26', '2025-05-30 10:03:26'),
(22, 14, NULL, 'COMENSAL 1', '0', '2025-05-30 10:13:54', '2025-05-30 10:13:54'),
(23, 14, NULL, 'COMENSAL 2', '0', '2025-05-30 10:13:54', '2025-05-30 10:13:54'),
(24, 15, 1, 'Alfredo Enrique', '0', '2025-05-30 10:14:39', '2025-05-30 10:14:39'),
(25, 16, 1, 'Alfredo Enrique', '0', '2025-05-30 10:15:03', '2025-05-30 10:15:03'),
(26, 17, NULL, 'COMENSAL 1', '0', '2025-05-30 10:22:15', '2025-05-30 10:22:15'),
(27, 17, NULL, 'COMENSAL 2', '0', '2025-05-30 10:22:15', '2025-05-30 10:22:15'),
(28, 18, 1, 'Alfredo Enrique', '0', '2025-05-30 10:23:08', '2025-05-30 10:23:08'),
(29, 19, 1, 'Alfredo Enrique', '0', '2025-05-30 10:25:56', '2025-05-30 10:25:56'),
(30, 19, NULL, 'COMENSAL 2', '0', '2025-05-30 10:25:56', '2025-05-30 10:25:56'),
(31, 19, NULL, 'COMENSAL 3', '0', '2025-05-30 10:25:56', '2025-05-30 10:25:56'),
(32, 20, NULL, 'JUAN', '0', '2025-05-30 12:47:15', '2025-05-30 12:47:15'),
(33, 20, NULL, 'MARCOS', '0', '2025-05-30 12:47:15', '2025-05-30 12:47:15'),
(34, 20, NULL, 'MARÍA', '0', '2025-05-30 12:47:15', '2025-05-30 12:47:15'),
(35, 21, 1, 'Alfredo Enrique', '0', '2025-05-30 12:49:02', '2025-05-30 12:49:02'),
(36, 22, NULL, 'COMENSAL 1', '0', '2025-05-30 12:50:48', '2025-05-30 12:50:48'),
(37, 23, 1, 'Alfredo Enrique', '0', '2025-05-30 12:54:38', '2025-05-30 12:54:38'),
(38, 23, NULL, 'COMENSAL 2', '0', '2025-05-30 12:54:38', '2025-05-30 12:54:38'),
(39, 23, NULL, 'COMENSAL 3', '0', '2025-05-30 12:54:38', '2025-05-30 12:54:38'),
(40, 24, 23, 'AaronDev', '0', '2025-05-31 17:08:49', '2025-05-31 17:08:49'),
(41, 25, NULL, 'COMENSAL 1', '0', '2025-05-31 18:32:53', '2025-05-31 18:32:53'),
(42, 26, 1, 'Alfredo Enrique', '0', '2025-05-31 18:34:50', '2025-05-31 18:34:50'),
(43, 27, 1, 'Alfredo Enrique', '0', '2025-05-31 20:00:20', '2025-05-31 20:00:20'),
(44, 28, 1, 'Alfredo Enrique', '0', '2025-05-31 20:02:39', '2025-05-31 20:02:39'),
(45, 29, 1, 'Alfredo Enrique', '0', '2025-05-31 20:04:08', '2025-05-31 20:04:08'),
(46, 30, NULL, 'COMENSAL 1', '0', '2025-06-01 21:09:20', '2025-06-01 21:09:20'),
(47, 31, 1, 'Alfredo Enrique', '0', '2025-06-03 17:08:05', '2025-06-03 17:08:05'),
(48, 32, 1, 'Alfredo Enrique', '0', '2025-06-03 17:09:57', '2025-06-03 17:09:57'),
(49, 33, 23, 'AaronDev', '0', '2025-06-03 21:32:38', '2025-06-03 21:32:38'),
(50, 34, NULL, 'COMENSAL 1', '0', '2025-06-03 21:40:08', '2025-06-03 21:40:08'),
(51, 35, 23, 'AaronDev', '0', '2025-06-04 07:33:36', '2025-06-04 07:33:36'),
(52, 36, 23, 'AaronDev', '0', '2025-06-04 09:34:53', '2025-06-04 09:34:53'),
(53, 37, NULL, 'COMENSAL 1', '0', '2025-06-04 12:40:45', '2025-06-04 12:40:45'),
(54, 38, 1, 'Alfredo Enrique', '0', '2025-06-04 12:41:45', '2025-06-04 12:41:45'),
(55, 39, 1, 'Alfredo Enrique', '0', '2025-06-04 13:01:09', '2025-06-04 13:01:09'),
(56, 39, NULL, 'COMENSAL 2', '0', '2025-06-04 13:01:09', '2025-06-04 13:01:09'),
(57, 39, NULL, 'COMENSAL 3', '0', '2025-06-04 13:01:09', '2025-06-04 13:01:09'),
(58, 40, NULL, 'COMENSAL 1', '0', '2025-06-05 14:18:54', '2025-06-05 14:18:54'),
(59, 41, 1, 'Alfredo Enrique', '0', '2025-06-05 14:19:46', '2025-06-05 14:19:46'),
(60, 41, NULL, 'COMENSAL 2', '0', '2025-06-05 14:19:46', '2025-06-05 14:19:46'),
(61, 41, NULL, 'COMENSAL 3', '0', '2025-06-05 14:19:46', '2025-06-05 14:19:46'),
(62, 42, 1, 'Alfredo Enrique', '0', '2025-06-05 14:20:23', '2025-06-05 14:20:23'),
(63, 42, NULL, 'COMENSAL 2', '0', '2025-06-05 14:20:23', '2025-06-05 14:20:23'),
(64, 43, 1, 'Alfredo Enrique', '0', '2025-06-05 14:31:10', '2025-06-05 14:31:10'),
(65, 43, NULL, 'COMENSAL 2', '0', '2025-06-05 14:31:10', '2025-06-05 14:31:10'),
(66, 43, NULL, 'COMENSAL 3', '0', '2025-06-05 14:31:10', '2025-06-05 14:31:10'),
(67, 43, NULL, 'COMENSAL 4', '0', '2025-06-05 14:31:10', '2025-06-05 14:31:10'),
(68, 44, 1, 'Alfredo Enrique', '0', '2025-06-05 14:31:39', '2025-06-05 14:31:39'),
(69, 45, 1, 'Alfredo Enrique', '0', '2025-06-05 14:41:26', '2025-06-05 14:41:26'),
(70, 46, 1, 'Alfredo Enrique', '0', '2025-06-05 14:45:47', '2025-06-05 14:45:47'),
(71, 47, 1, 'Alfredo Enrique', '0', '2025-06-05 14:46:14', '2025-06-05 14:46:14'),
(72, 48, 1, 'Alfredo Enrique', '0', '2025-06-05 14:47:04', '2025-06-05 14:47:04'),
(73, 49, 1, 'Alfredo Enrique', '0', '2025-06-05 14:50:35', '2025-06-05 14:50:35'),
(74, 50, 1, 'Alfredo Enrique', '0', '2025-06-05 14:51:25', '2025-06-05 14:51:25'),
(75, 50, NULL, 'COMENSAL 2', '0', '2025-06-05 14:51:25', '2025-06-05 14:51:25'),
(76, 51, 1, 'Alfredo Enrique', '0', '2025-06-05 23:23:58', '2025-06-05 23:23:58'),
(77, 52, 1, 'Alfredo Enrique', '0', '2025-06-05 23:24:40', '2025-06-05 23:24:40'),
(78, 52, NULL, 'COMENSAL 2', '0', '2025-06-05 23:24:40', '2025-06-05 23:24:40'),
(79, 53, 1, 'Alfredo Enrique', '0', '2025-06-05 23:25:13', '2025-06-05 23:25:13'),
(80, 53, NULL, 'COMENSAL 2', '0', '2025-06-05 23:25:13', '2025-06-05 23:25:13'),
(81, 54, 1, 'Alfredo Enrique', '0', '2025-06-06 11:53:36', '2025-06-06 11:53:36'),
(82, 55, NULL, 'Juan', '0', '2025-06-08 03:44:19', '2025-06-08 03:44:19'),
(83, 55, NULL, 'COMENSAL 2', '0', '2025-06-08 03:44:19', '2025-06-08 03:44:19'),
(84, 56, NULL, 'COMENSAL 1', '0', '2025-06-09 20:27:15', '2025-06-09 20:27:15'),
(85, 57, 23, 'AaronDev', '0', '2025-06-11 18:36:51', '2025-06-11 18:36:51'),
(86, 58, 1, 'Alfredo Enrique', '0', '2025-06-14 18:12:04', '2025-06-14 18:12:04'),
(87, 59, NULL, 'COMENSAL 1', '0', '2025-06-16 11:27:02', '2025-06-16 11:27:02'),
(88, 60, 23, 'AaronDev', '0', '2025-06-18 14:25:20', '2025-06-18 14:25:20'),
(89, 61, 23, 'AaronDev', '0', '2025-06-18 15:23:36', '2025-06-18 15:23:36'),
(90, 62, 1, 'Alfredo Enrique', '0', '2025-06-20 09:01:49', '2025-06-20 09:01:49'),
(91, 63, 1, 'Alfredo Enrique', '0', '2025-06-20 09:10:26', '2025-06-20 09:10:26'),
(92, 63, NULL, 'MARCOS', '0', '2025-06-20 09:10:26', '2025-06-20 09:10:26'),
(93, 63, NULL, 'maría', '0', '2025-06-20 09:10:26', '2025-06-20 09:10:26'),
(94, 64, 1, 'Alfredo Enrique', '0', '2025-06-20 09:13:32', '2025-06-20 09:13:32'),
(95, 65, 1, 'Alfredo Enrique', '0', '2025-06-20 09:15:44', '2025-06-20 09:15:44'),
(96, 65, NULL, 'maria', '0', '2025-06-20 09:15:44', '2025-06-20 09:15:44'),
(97, 66, 1, 'Alfredo Enrique', '0', '2025-06-20 09:17:05', '2025-06-20 09:17:05'),
(98, 67, NULL, 'COMENSAL 1', '0', '2025-06-21 23:38:08', '2025-06-21 23:38:08'),
(99, 68, NULL, 'COMENSAL 1', '0', '2025-06-25 16:59:40', '2025-06-25 16:59:40'),
(100, 69, 1, 'Alfredo Enrique', '0', '2025-06-25 17:04:12', '2025-06-25 17:04:12'),
(101, 69, NULL, 'luis', '0', '2025-06-25 17:04:12', '2025-06-25 17:04:12'),
(102, 70, 4, 'Lucía Pérez', '0', '2025-07-09 19:02:52', '2025-07-09 19:02:52'),
(103, 71, 23, 'AaronDev', '0', '2025-07-09 19:04:24', '2025-07-09 19:04:24'),
(104, 72, 23, 'AaronDev', '0', '2025-07-12 16:38:23', '2025-07-12 16:38:23'),
(105, 75, 23, 'AaronDev', '0', '2025-07-13 05:54:52', '2025-07-13 05:54:52'),
(106, 77, NULL, 'COMENSAL 1', '0', '2025-07-16 16:24:41', '2025-07-16 16:24:41'),
(107, 78, 1, 'Christina', '0', '2025-07-17 18:06:31', '2025-07-17 18:06:31'),
(108, 79, 1, 'Alfredo Enrique', '0', '2025-07-17 18:12:42', '2025-07-17 18:12:42'),
(109, 80, 1, 'Alfredo Enrique', '0', '2025-07-25 18:58:28', '2025-07-25 18:58:28'),
(110, 81, 1, 'Alfredo Enrique', '0', '2025-07-30 01:04:30', '2025-07-30 01:04:30'),
(111, 82, 1, 'Alfredo Enrique', '0', '2025-07-30 01:06:18', '2025-07-30 01:06:18'),
(112, 83, 1, 'Alfredo Enrique', '0', '2025-07-30 01:10:39', '2025-07-30 01:10:39'),
(113, 84, 1, 'Alfredo Enrique', '0', '2025-07-30 01:12:38', '2025-07-30 01:12:38'),
(114, 85, 1, 'Alfredo Enrique', '0', '2025-07-30 01:49:11', '2025-07-30 01:49:11'),
(115, 86, 1, 'Alfredo Enrique', '0', '2025-07-31 02:40:23', '2025-07-31 02:40:23'),
(116, 87, 1, 'Alfredo Enrique', '0', '2025-07-31 02:41:06', '2025-07-31 02:41:06'),
(117, 88, 1, 'Alfredo Enrique', '0', '2025-07-31 02:51:48', '2025-07-31 02:51:48'),
(118, 89, 1, 'Alfredo Enrique', '0', '2025-07-31 02:55:00', '2025-07-31 02:55:00'),
(119, 90, 23, 'AaronDev', '0', '2025-07-31 15:36:29', '2025-07-31 15:36:29'),
(120, 91, 23, 'AaronDev', '0', '2025-08-01 17:44:44', '2025-08-01 17:44:44'),
(121, 92, 23, 'AaronDev', '0', '2025-08-01 17:55:33', '2025-08-01 17:55:33'),
(122, 92, NULL, 'COMENSAL 2', '0', '2025-08-01 17:55:33', '2025-08-01 17:55:33'),
(123, 93, 1, 'Alfredo Enrique', '0', '2025-08-08 18:33:58', '2025-08-08 18:33:58'),
(124, 94, NULL, 'Alfredo Enrique', '0', '2025-08-15 07:27:46', '2025-08-15 07:27:46'),
(125, 95, NULL, 'Alfredo Enrique', '0', '2025-08-15 07:45:14', '2025-08-15 07:45:14'),
(126, 96, NULL, 'Alfredo Enrique', '0', '2025-08-15 07:51:26', '2025-08-15 07:51:26'),
(127, 96, NULL, 'COMENSAL 2', '0', '2025-08-15 07:51:26', '2025-08-15 07:51:26'),
(128, 96, NULL, 'COMENSAL 3', '0', '2025-08-15 07:51:26', '2025-08-15 07:51:26'),
(129, 97, NULL, 'Alfredo Enrique', '0', '2025-08-15 07:58:00', '2025-08-15 07:58:00'),
(130, 98, NULL, 'Alfredo Enrique', '0', '2025-08-15 07:59:42', '2025-08-15 07:59:42'),
(131, 99, NULL, 'Alfredo Enrique', '0', '2025-08-15 08:03:20', '2025-08-15 08:03:20'),
(132, 100, NULL, 'Alfredo Enrique', '0', '2025-08-15 08:19:21', '2025-08-15 08:19:21'),
(133, 101, NULL, 'Alfredo Enrique', '0', '2025-08-15 08:19:48', '2025-08-15 08:19:48'),
(134, 102, NULL, 'Alfredo Enrique', '0', '2025-08-15 08:20:48', '2025-08-15 08:20:48'),
(135, 103, NULL, 'Alfredo Enrique', '0', '2025-08-15 08:22:34', '2025-08-15 08:22:34'),
(136, 104, NULL, 'Alfredo Enrique', '0', '2025-08-21 20:46:59', '2025-08-21 20:46:59'),
(137, 105, NULL, 'Alfredo Enrique', '0', '2025-08-22 05:47:35', '2025-08-22 05:47:35'),
(138, 106, NULL, 'Alfredo Enrique', '0', '2025-08-22 07:20:34', '2025-08-22 07:20:34'),
(139, 107, NULL, 'Alfredo Enrique', '0', '2025-08-27 22:44:54', '2025-08-27 22:44:54'),
(140, 107, NULL, 'juan', '0', '2025-08-27 22:44:54', '2025-08-27 22:44:54'),
(141, 107, NULL, 'maria', '0', '2025-08-27 22:44:54', '2025-08-27 22:44:54'),
(142, 108, NULL, 'Alfredo Enrique', '0', '2025-08-31 17:19:57', '2025-08-31 17:19:57'),
(143, 108, NULL, 'COMENSAL 2', '0', '2025-08-31 17:19:57', '2025-08-31 17:19:57'),
(144, 108, NULL, 'COMENSAL 3', '0', '2025-08-31 17:19:57', '2025-08-31 17:19:57'),
(145, 109, NULL, 'Alfredo Enrique', '0', '2025-11-08 00:48:42', '2025-11-08 00:48:42'),
(146, 110, NULL, 'Alfredo Enrique', '0', '2025-11-08 21:19:37', '2025-11-08 21:19:37'),
(147, 111, NULL, 'Alfredo Enrique', '0', '2025-11-08 21:20:38', '2025-11-08 21:20:38'),
(148, 112, NULL, 'Alfredo Enrique', '0', '2025-11-08 21:21:32', '2025-11-08 21:21:32'),
(149, 113, NULL, 'Alfredo Enrique', '0', '2025-11-08 21:29:13', '2025-11-08 21:29:13'),
(150, 114, NULL, 'Alfredo Enrique', '0', '2026-02-02 02:46:03', '2026-02-02 02:46:03'),
(151, 114, NULL, 'COMENSAL 2', '0', '2026-02-02 02:46:03', '2026-02-02 02:46:03'),
(152, 114, NULL, 'COMENSAL 3', '0', '2026-02-02 02:46:03', '2026-02-02 02:46:03'),
(153, 114, NULL, 'COMENSAL 4', '0', '2026-02-02 02:46:03', '2026-02-02 02:46:03'),
(154, 115, NULL, 'Alfredo Enrique', '0', '2026-02-02 02:47:12', '2026-02-02 02:47:12'),
(155, 115, NULL, 'COMENSAL 2', '0', '2026-02-02 02:47:12', '2026-02-02 02:47:12');

-- --------------------------------------------------------

--
-- Table structure for table `pedido_detalles`
--

CREATE TABLE `pedido_detalles` (
  `id` int NOT NULL,
  `id_pedido` int NOT NULL,
  `id_comensal` int DEFAULT NULL,
  `id_producto` int NOT NULL,
  `cantidad` int NOT NULL DEFAULT '1',
  `estado` varchar(5) NOT NULL DEFAULT '0' COMMENT '0: pendiente; 1: confirmado; 2: en preparación; 3: en camino; 4: entregado; 9: rechazado;',
  `precio` decimal(10,2) NOT NULL,
  `id_user_cocinero` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `pedido_detalles`
--

INSERT INTO `pedido_detalles` (`id`, `id_pedido`, `id_comensal`, `id_producto`, `cantidad`, `estado`, `precio`, `id_user_cocinero`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, 1, '0', 0.00, NULL, '2025-04-10 03:13:08', '2025-04-10 03:13:08'),
(2, 1, 1, 31, 1, '0', 0.00, NULL, '2025-04-10 03:13:08', '2025-04-10 03:13:08'),
(3, 1, 1, 74, 1, '0', 1.50, NULL, '2025-04-10 03:13:08', '2025-04-10 03:13:08'),
(4, 2, 2, 16, 1, '0', 0.00, NULL, '2025-04-10 03:13:08', '2025-04-10 03:13:08'),
(5, 2, 2, 51, 1, '0', 0.00, NULL, '2025-04-10 03:13:08', '2025-04-10 03:13:08'),
(6, 2, 3, 17, 1, '0', 0.00, NULL, '2025-04-10 03:13:08', '2025-04-10 03:13:08'),
(7, 2, 3, 52, 1, '0', 0.00, NULL, '2025-04-10 03:13:08', '2025-04-10 03:13:08'),
(8, 2, 4, 18, 1, '0', 0.00, NULL, '2025-04-10 03:13:08', '2025-04-10 03:13:08'),
(9, 2, 4, 53, 1, '0', 0.00, NULL, '2025-04-10 03:13:08', '2025-04-10 03:13:08'),
(10, 3, 5, 71, 1, '0', 60.00, NULL, '2025-04-10 03:13:08', '2025-04-10 03:13:08'),
(11, 3, 5, 75, 1, '0', 2.00, NULL, '2025-04-10 03:13:08', '2025-04-10 03:13:08'),
(12, 4, 6, 3, 1, '0', 0.00, NULL, '2025-04-10 03:13:08', '2025-04-10 03:13:08'),
(13, 4, 6, 32, 1, '0', 0.00, NULL, '2025-04-10 03:13:08', '2025-04-10 03:13:08'),
(14, 4, 6, 74, 1, '0', 1.50, NULL, '2025-04-10 03:13:08', '2025-04-10 03:13:08'),
(15, 4, 7, 4, 1, '0', 0.00, NULL, '2025-04-10 03:13:08', '2025-04-10 03:13:08'),
(16, 4, 7, 33, 1, '0', 0.00, NULL, '2025-04-10 03:13:08', '2025-04-10 03:13:08'),
(17, 4, 7, 74, 1, '0', 1.50, NULL, '2025-04-10 03:13:08', '2025-04-10 03:13:08'),
(18, 5, 8, 5, 1, '0', 0.00, NULL, '2025-04-10 03:13:08', '2025-04-10 03:13:08'),
(19, 5, 8, 34, 1, '0', 0.00, NULL, '2025-04-10 03:13:08', '2025-04-10 03:13:08'),
(20, 6, 9, 1, 1, '0', 0.00, NULL, '2025-04-10 03:13:08', '2025-04-10 03:13:08'),
(21, 6, 9, 31, 1, '0', 0.00, NULL, '2025-04-10 03:13:08', '2025-04-10 03:13:08'),
(22, 6, 10, 2, 1, '0', 0.00, NULL, '2025-04-10 03:13:08', '2025-04-10 03:13:08'),
(23, 6, 10, 32, 1, '0', 0.00, NULL, '2025-04-10 03:13:08', '2025-04-10 03:13:08'),
(24, 6, 11, 3, 1, '0', 0.00, NULL, '2025-04-10 03:13:08', '2025-04-10 03:13:08'),
(25, 6, 11, 33, 1, '0', 0.00, NULL, '2025-04-10 03:13:08', '2025-04-10 03:13:08'),
(26, 7, 12, 19, 1, '0', 0.00, NULL, '2025-04-10 03:13:08', '2025-04-10 03:13:08'),
(27, 7, 12, 54, 1, '0', 0.00, NULL, '2025-04-10 03:13:08', '2025-04-10 03:13:08'),
(28, 7, 12, 74, 1, '0', 1.50, NULL, '2025-04-10 03:13:08', '2025-04-10 03:13:08'),
(29, 7, 12, 75, 1, '0', 2.00, NULL, '2025-04-10 03:13:08', '2025-04-10 03:13:08'),
(30, 8, 13, 6, 1, '0', 0.00, NULL, '2025-04-10 03:13:08', '2025-04-10 03:13:08'),
(31, 8, 13, 35, 1, '0', 0.00, NULL, '2025-04-10 03:13:08', '2025-04-10 03:13:08'),
(32, 9, 14, 7, 1, '0', 0.00, NULL, '2025-04-10 03:13:08', '2025-04-10 03:13:08'),
(33, 9, 14, 36, 1, '0', 0.00, NULL, '2025-04-10 03:13:08', '2025-04-10 03:13:08'),
(34, 10, 15, 20, 1, '0', 0.00, NULL, '2025-04-10 03:13:08', '2025-04-10 03:13:08'),
(35, 10, 15, 55, 1, '0', 0.00, NULL, '2025-04-10 03:13:08', '2025-04-10 03:13:08'),
(36, 10, 16, 21, 1, '0', 0.00, NULL, '2025-04-10 03:13:08', '2025-04-10 03:13:08'),
(37, 10, 16, 56, 1, '0', 0.00, NULL, '2025-04-10 03:13:08', '2025-04-10 03:13:08'),
(38, 11, 17, 33, 1, '1', 19.31, NULL, '2025-05-30 09:43:56', '2025-06-30 09:32:10'),
(39, 11, 17, 19, 1, '0', 11.12, NULL, '2025-05-30 09:43:56', '2025-05-30 09:43:56'),
(40, 11, 17, 86, 2, '0', 50.31, NULL, '2025-05-30 09:43:56', '2025-05-30 09:43:56'),
(41, 11, 18, 87, 1, '0', 50.90, NULL, '2025-05-30 09:43:56', '2025-05-30 09:43:56'),
(42, 12, 19, 33, 1, '1', 19.31, NULL, '2025-05-30 10:02:19', '2025-06-30 09:32:11'),
(43, 12, 19, 86, 2, '0', 50.31, NULL, '2025-05-30 10:02:19', '2025-05-30 10:02:19'),
(44, 12, 20, 87, 1, '0', 50.90, NULL, '2025-05-30 10:02:19', '2025-05-30 10:02:19'),
(45, 13, 21, 4, 1, '1', 2.34, NULL, '2025-05-30 10:03:26', '2025-06-30 09:32:12'),
(46, 14, 22, 33, 1, '1', 19.31, NULL, '2025-05-30 10:13:54', '2025-06-30 09:32:13'),
(47, 14, 22, 19, 1, '0', 11.12, NULL, '2025-05-30 10:13:54', '2025-05-30 10:13:54'),
(48, 14, 22, 87, 1, '0', 50.90, NULL, '2025-05-30 10:13:54', '2025-05-30 10:13:54'),
(49, 14, 22, 76, 2, '0', 44.46, NULL, '2025-05-30 10:13:54', '2025-05-30 10:13:54'),
(50, 14, 23, 87, 1, '0', 50.90, NULL, '2025-05-30 10:13:54', '2025-05-30 10:13:54'),
(51, 15, 24, 2, 1, '1', 1.17, NULL, '2025-05-30 10:14:39', '2025-06-30 09:32:15'),
(52, 16, 25, 19, 1, '1', 11.12, NULL, '2025-05-30 10:15:03', '2025-06-30 09:32:16'),
(53, 16, 25, 53, 1, '0', 31.01, NULL, '2025-05-30 10:15:03', '2025-05-30 10:15:03'),
(54, 17, 26, 2, 1, '1', 1.17, NULL, '2025-05-30 10:22:15', '2025-06-30 09:32:17'),
(55, 17, 26, 33, 1, '0', 19.31, NULL, '2025-05-30 10:22:15', '2025-05-30 10:22:15'),
(56, 17, 27, 87, 1, '0', 50.90, NULL, '2025-05-30 10:22:15', '2025-05-30 10:22:15'),
(57, 18, 28, 4, 1, '0', 2.34, NULL, '2025-05-30 10:23:08', '2025-05-30 10:23:08'),
(58, 18, 28, 53, 1, '0', 31.01, NULL, '2025-05-30 10:23:08', '2025-05-30 10:23:08'),
(59, 18, 28, 76, 1, '1', 44.46, NULL, '2025-05-30 10:23:08', '2025-06-30 09:32:19'),
(60, 19, 29, 2, 1, '0', 1.17, NULL, '2025-05-30 10:25:56', '2025-05-30 10:25:56'),
(61, 19, 29, 76, 2, '0', 44.46, NULL, '2025-05-30 10:25:56', '2025-05-30 10:25:56'),
(62, 19, 30, 19, 1, '1', 11.12, NULL, '2025-05-30 10:25:56', '2025-06-30 09:32:19'),
(63, 19, 30, 53, 1, '0', 31.01, NULL, '2025-05-30 10:25:56', '2025-05-30 10:25:56'),
(64, 19, 31, 4, 1, '0', 2.34, NULL, '2025-05-30 10:25:56', '2025-05-30 10:25:56'),
(65, 19, 31, 52, 1, '0', 30.42, NULL, '2025-05-30 10:25:56', '2025-05-30 10:25:56'),
(66, 19, 31, 71, 1, '0', 41.54, NULL, '2025-05-30 10:25:56', '2025-05-30 10:25:56'),
(67, 20, 32, 4, 1, '1', 2.34, NULL, '2025-05-30 12:47:15', '2025-06-30 09:32:21'),
(68, 20, 32, 33, 1, '0', 19.31, NULL, '2025-05-30 12:47:15', '2025-05-30 12:47:15'),
(69, 20, 32, 86, 2, '0', 50.31, NULL, '2025-05-30 12:47:15', '2025-05-30 12:47:15'),
(70, 20, 33, 5, 1, '0', 9.00, NULL, '2025-05-30 12:47:15', '2025-05-30 12:47:15'),
(71, 20, 33, 71, 1, '0', 41.54, NULL, '2025-05-30 12:47:15', '2025-05-30 12:47:15'),
(72, 20, 34, 34, 1, '0', 15.00, NULL, '2025-05-30 12:47:15', '2025-05-30 12:47:15'),
(73, 20, 34, 19, 1, '1', 11.12, NULL, '2025-05-30 12:47:15', '2025-06-30 09:32:22'),
(74, 21, 35, 33, 1, '0', 19.31, NULL, '2025-05-30 12:49:02', '2025-05-30 12:49:02'),
(75, 21, 35, 17, 1, '1', 9.95, NULL, '2025-05-30 12:49:02', '2025-06-30 09:32:24'),
(76, 21, 35, 76, 1, '0', 44.46, NULL, '2025-05-30 12:49:02', '2025-05-30 12:49:02'),
(77, 22, 36, 5, 1, '0', 9.00, NULL, '2025-05-30 12:50:48', '2025-05-30 12:50:48'),
(78, 22, 36, 33, 1, '1', 19.31, NULL, '2025-05-30 12:50:48', '2025-06-30 09:32:25'),
(79, 23, 37, 6, 1, '0', 5.00, NULL, '2025-05-30 12:54:38', '2025-05-30 12:54:38'),
(80, 23, 37, 34, 1, '1', 15.00, NULL, '2025-05-30 12:54:38', '2025-06-30 09:32:25'),
(81, 23, 38, 33, 1, '0', 19.31, NULL, '2025-05-30 12:54:38', '2025-05-30 12:54:38'),
(82, 23, 38, 17, 1, '0', 9.95, NULL, '2025-05-30 12:54:38', '2025-05-30 12:54:38'),
(83, 23, 39, 71, 1, '0', 41.54, NULL, '2025-05-30 12:54:38', '2025-05-30 12:54:38'),
(84, 24, 40, 5, 1, '0', 7.00, NULL, '2025-05-31 17:08:49', '2025-05-31 17:08:49'),
(85, 24, 40, 35, 1, '0', 9.00, NULL, '2025-05-31 17:08:49', '2025-05-31 17:08:49'),
(86, 25, 41, 5, 1, '2', 7.00, NULL, '2025-05-31 18:32:53', '2025-06-30 09:31:53'),
(87, 25, 41, 34, 1, '2', 13.00, NULL, '2025-05-31 18:32:53', '2025-06-30 09:31:52'),
(88, 26, 42, 5, 1, '2', 7.00, NULL, '2025-05-31 18:34:50', '2025-06-30 09:31:56'),
(89, 27, 43, 6, 1, '2', 9.00, NULL, '2025-05-31 20:00:20', '2025-06-30 09:31:58'),
(90, 28, 44, 4, 1, '2', 7.00, NULL, '2025-05-31 20:02:39', '2025-06-30 09:32:02'),
(91, 28, 44, 35, 1, '9', 9.00, NULL, '2025-05-31 20:02:39', '2025-06-30 09:32:01'),
(92, 29, 45, 4, 1, '2', 7.00, NULL, '2025-05-31 20:04:08', '2025-06-30 09:32:06'),
(93, 29, 45, 36, 1, '9', 12.00, NULL, '2025-05-31 20:04:08', '2025-06-30 09:32:05'),
(94, 30, 46, 3, 1, '0', 9.00, NULL, '2025-06-01 21:09:20', '2025-06-01 21:09:20'),
(95, 30, 46, 33, 1, '0', 10.00, NULL, '2025-06-01 21:09:20', '2025-06-01 21:09:20'),
(96, 30, 46, 75, 2, '0', 3.00, NULL, '2025-06-01 21:09:20', '2025-06-01 21:09:20'),
(97, 31, 47, 4, 1, '9', 7.00, NULL, '2025-06-03 17:08:05', '2025-06-05 09:05:58'),
(98, 31, 47, 35, 1, '2', 9.00, NULL, '2025-06-03 17:08:05', '2025-06-05 09:06:01'),
(99, 32, 48, 6, 1, '2', 9.00, NULL, '2025-06-03 17:09:57', '2025-06-06 15:00:44'),
(100, 32, 48, 35, 1, '2', 9.00, NULL, '2025-06-03 17:09:57', '2025-06-06 15:00:44'),
(101, 33, 49, 5, 1, '2', 7.00, NULL, '2025-06-03 21:32:38', '2025-06-06 15:00:49'),
(102, 33, 49, 34, 1, '2', 13.00, NULL, '2025-06-03 21:32:38', '2025-06-06 15:00:48'),
(103, 33, 49, 74, 2, '2', 3.00, NULL, '2025-06-03 21:32:38', '2025-06-06 15:00:49'),
(104, 34, 50, 87, 1, '2', 19.00, NULL, '2025-06-03 21:40:08', '2025-06-05 09:05:54'),
(105, 35, 51, 1, 1, '0', 11.00, NULL, '2025-06-04 07:33:36', '2025-06-04 07:33:36'),
(106, 35, 51, 32, 1, '0', 11.00, NULL, '2025-06-04 07:33:36', '2025-06-04 07:33:36'),
(107, 35, 51, 75, 2, '0', 11.00, NULL, '2025-06-04 07:33:36', '2025-06-04 07:33:36'),
(108, 36, 52, 1, 1, '0', 11.00, NULL, '2025-06-04 09:34:53', '2025-06-04 09:34:53'),
(109, 36, 52, 32, 1, '0', 11.00, NULL, '2025-06-04 09:34:53', '2025-06-04 09:34:53'),
(110, 36, 52, 76, 2, '0', 11.00, NULL, '2025-06-04 09:34:53', '2025-06-04 09:34:53'),
(111, 37, 53, 1, 1, '0', 11.00, NULL, '2025-06-04 12:40:45', '2025-06-04 12:40:45'),
(112, 38, 54, 17, 1, '0', 11.00, NULL, '2025-06-04 12:41:45', '2025-06-04 12:41:45'),
(113, 38, 54, 53, 1, '0', 11.00, NULL, '2025-06-04 12:41:45', '2025-06-04 12:41:45'),
(114, 38, 54, 72, 1, '0', 11.00, NULL, '2025-06-04 12:41:45', '2025-06-04 12:41:45'),
(115, 38, 54, 76, 3, '0', 11.00, NULL, '2025-06-04 12:41:45', '2025-06-04 12:41:45'),
(116, 39, 55, 1, 1, '0', 11.00, NULL, '2025-06-04 13:01:09', '2025-06-04 13:01:09'),
(117, 39, 55, 32, 1, '0', 11.00, NULL, '2025-06-04 13:01:09', '2025-06-04 13:01:09'),
(118, 39, 55, 76, 3, '0', 11.00, NULL, '2025-06-04 13:01:09', '2025-06-04 13:01:09'),
(119, 39, 56, 1, 1, '0', 11.00, NULL, '2025-06-04 13:01:09', '2025-06-04 13:01:09'),
(120, 39, 56, 53, 1, '0', 11.00, NULL, '2025-06-04 13:01:09', '2025-06-04 13:01:09'),
(121, 39, 57, 87, 1, '0', 11.00, NULL, '2025-06-04 13:01:09', '2025-06-04 13:01:09'),
(122, 40, 58, 87, 1, '2', 11.00, NULL, '2025-06-05 14:18:54', '2025-06-05 14:25:46'),
(123, 41, 59, 1, 1, '2', 11.00, NULL, '2025-06-05 14:19:46', '2025-06-05 14:29:03'),
(124, 41, 59, 32, 1, '2', 11.00, NULL, '2025-06-05 14:19:46', '2025-06-05 14:29:02'),
(125, 41, 59, 87, 1, '2', 11.00, NULL, '2025-06-05 14:19:46', '2025-06-05 14:29:01'),
(126, 41, 59, 72, 1, '2', 11.00, NULL, '2025-06-05 14:19:46', '2025-06-05 14:29:01'),
(127, 41, 60, 1, 1, '0', 11.00, NULL, '2025-06-05 14:19:46', '2025-06-05 14:19:46'),
(128, 41, 61, 1, 1, '0', 11.00, NULL, '2025-06-05 14:19:46', '2025-06-05 14:19:46'),
(129, 41, 61, 72, 1, '0', 11.00, NULL, '2025-06-05 14:19:46', '2025-06-05 14:19:46'),
(130, 42, 62, 1, 1, '2', 11.00, NULL, '2025-06-05 14:20:23', '2025-06-05 14:26:31'),
(131, 42, 62, 32, 1, '2', 11.00, NULL, '2025-06-05 14:20:23', '2025-06-05 14:26:31'),
(132, 42, 63, 17, 1, '2', 11.00, NULL, '2025-06-05 14:20:23', '2025-06-05 14:26:32'),
(133, 42, 63, 53, 1, '2', 11.00, NULL, '2025-06-05 14:20:23', '2025-06-05 14:26:33'),
(134, 43, 64, 32, 1, '2', 11.00, NULL, '2025-06-05 14:31:10', '2025-06-05 14:44:24'),
(135, 43, 64, 17, 1, '9', 11.00, NULL, '2025-06-05 14:31:10', '2025-06-05 14:36:11'),
(136, 43, 64, 87, 1, '9', 11.00, NULL, '2025-06-05 14:31:10', '2025-06-05 14:36:16'),
(137, 43, 64, 76, 2, '9', 11.00, NULL, '2025-06-05 14:31:10', '2025-06-05 14:36:16'),
(138, 43, 65, 87, 1, '9', 11.00, NULL, '2025-06-05 14:31:10', '2025-06-05 14:31:10'),
(139, 43, 66, 87, 1, '9', 11.00, NULL, '2025-06-05 14:31:10', '2025-06-05 14:31:10'),
(140, 43, 67, 1, 1, '9', 11.00, NULL, '2025-06-05 14:31:10', '2025-06-05 14:36:16'),
(141, 43, 67, 32, 1, '9', 11.00, NULL, '2025-06-05 14:31:10', '2025-06-05 14:31:10'),
(142, 44, 68, 1, 1, '2', 11.00, NULL, '2025-06-05 14:31:39', '2025-06-05 14:43:32'),
(143, 44, 68, 32, 1, '9', 11.00, NULL, '2025-06-05 14:31:39', '2025-06-05 14:33:52'),
(144, 44, 68, 87, 1, '9', 11.00, NULL, '2025-06-05 14:31:39', '2025-06-05 14:33:53'),
(145, 45, 69, 1, 1, '2', 11.00, NULL, '2025-06-05 14:41:26', '2025-06-05 14:43:36'),
(146, 45, 69, 32, 1, '9', 11.00, NULL, '2025-06-05 14:41:26', '2025-06-05 14:41:38'),
(147, 46, 70, 1, 1, '9', 11.00, NULL, '2025-06-05 14:45:47', '2025-06-05 23:20:29'),
(148, 46, 70, 32, 1, '9', 11.00, NULL, '2025-06-05 14:45:47', '2025-06-05 23:20:31'),
(149, 46, 70, 76, 1, '9', 11.00, NULL, '2025-06-05 14:45:47', '2025-06-05 23:20:31'),
(150, 47, 71, 1, 1, '2', 11.00, NULL, '2025-06-05 14:46:14', '2025-06-05 23:20:48'),
(151, 47, 71, 32, 1, '2', 11.00, NULL, '2025-06-05 14:46:14', '2025-06-05 23:20:48'),
(152, 47, 71, 76, 1, '2', 11.00, NULL, '2025-06-05 14:46:14', '2025-06-05 23:20:49'),
(153, 48, 72, 1, 1, '2', 11.00, NULL, '2025-06-05 14:47:04', '2025-06-05 23:20:51'),
(154, 48, 72, 32, 1, '2', 11.00, NULL, '2025-06-05 14:47:04', '2025-06-05 23:20:52'),
(155, 48, 72, 76, 2, '2', 11.00, NULL, '2025-06-05 14:47:04', '2025-06-05 23:20:53'),
(156, 49, 73, 1, 1, '9', 11.00, NULL, '2025-06-05 14:50:35', '2025-06-05 23:20:55'),
(157, 49, 73, 32, 1, '9', 11.00, NULL, '2025-06-05 14:50:35', '2025-06-05 23:20:56'),
(158, 50, 74, 87, 1, '9', 11.00, NULL, '2025-06-05 14:51:25', '2025-06-05 23:20:20'),
(159, 50, 75, 87, 1, '9', 11.00, NULL, '2025-06-05 14:51:25', '2025-06-05 23:20:20'),
(160, 51, 76, 1, 1, '9', 11.00, NULL, '2025-06-05 23:23:58', '2025-06-05 23:27:38'),
(161, 51, 76, 35, 1, '2', 10.00, NULL, '2025-06-05 23:23:58', '2025-06-05 23:27:41'),
(162, 52, 77, 4, 1, '2', 10.00, NULL, '2025-06-05 23:24:40', '2025-06-05 23:28:04'),
(163, 52, 77, 35, 1, '2', 10.00, NULL, '2025-06-05 23:24:40', '2025-06-05 23:28:06'),
(164, 52, 78, 4, 1, '2', 10.00, NULL, '2025-06-05 23:24:40', '2025-06-05 23:28:04'),
(165, 52, 78, 35, 1, '2', 10.00, NULL, '2025-06-05 23:24:40', '2025-06-05 23:28:06'),
(166, 53, 79, 4, 1, '2', 10.00, NULL, '2025-06-05 23:25:13', '2025-06-05 23:27:55'),
(167, 53, 79, 35, 1, '2', 10.00, NULL, '2025-06-05 23:25:13', '2025-06-05 23:27:55'),
(168, 53, 79, 76, 2, '2', 11.00, NULL, '2025-06-05 23:25:13', '2025-06-05 23:27:55'),
(169, 53, 80, 18, 1, '2', 11.00, NULL, '2025-06-05 23:25:13', '2025-06-05 23:27:56'),
(170, 53, 80, 53, 1, '2', 11.00, NULL, '2025-06-05 23:25:13', '2025-06-05 23:27:56'),
(171, 54, 81, 4, 1, '2', 7.00, NULL, '2025-06-06 11:53:36', '2025-06-06 15:00:57'),
(172, 54, 81, 34, 1, '2', 13.00, NULL, '2025-06-06 11:53:36', '2025-06-06 15:00:58'),
(173, 55, 82, 4, 1, '2', 7.00, NULL, '2025-06-08 03:44:19', '2025-06-30 09:31:28'),
(174, 55, 82, 35, 1, '2', 9.00, NULL, '2025-06-08 03:44:19', '2025-06-30 09:31:29'),
(175, 55, 82, 74, 1, '2', 3.00, NULL, '2025-06-08 03:44:19', '2025-06-30 09:31:30'),
(176, 55, 82, 77, 1, '2', 3.00, NULL, '2025-06-08 03:44:19', '2025-06-30 09:31:30'),
(177, 55, 83, 7, 1, '2', 6.00, NULL, '2025-06-08 03:44:19', '2025-06-30 09:31:31'),
(178, 56, 84, 5, 1, '2', 7.00, NULL, '2025-06-09 20:27:15', '2025-06-09 20:29:12'),
(179, 56, 84, 35, 1, '2', 9.00, NULL, '2025-06-09 20:27:15', '2025-06-09 20:29:13'),
(180, 57, 85, 4, 1, '2', 10.00, NULL, '2025-06-11 18:36:51', '2025-06-11 18:37:19'),
(181, 57, 85, 35, 1, '2', 10.00, NULL, '2025-06-11 18:36:51', '2025-06-11 18:37:19'),
(182, 58, 86, 5, 1, '2', 7.00, NULL, '2025-06-14 18:12:04', '2025-06-14 18:17:20'),
(183, 58, 86, 36, 1, '2', 12.00, NULL, '2025-06-14 18:12:04', '2025-06-14 18:17:21'),
(184, 59, 87, 4, 1, '2', 2.34, NULL, '2025-06-16 11:27:02', '2025-06-16 11:27:37'),
(185, 59, 87, 34, 1, '2', 15.00, NULL, '2025-06-16 11:27:02', '2025-06-16 11:27:37'),
(186, 59, 87, 76, 2, '2', 44.46, NULL, '2025-06-16 11:27:02', '2025-06-16 11:27:38'),
(187, 59, 87, 86, 1, '2', 50.31, NULL, '2025-06-16 11:27:02', '2025-06-16 11:27:39'),
(188, 60, 88, 34, 1, '2', 13.00, NULL, '2025-06-18 14:25:20', '2025-06-18 14:25:30'),
(189, 61, 89, 4, 1, '2', 7.00, NULL, '2025-06-18 15:23:36', '2025-06-18 15:23:44'),
(190, 62, 90, 4, 1, '2', 2.34, NULL, '2025-06-20 09:01:49', '2025-06-20 09:02:59'),
(191, 62, 90, 36, 1, '2', 21.06, NULL, '2025-06-20 09:01:49', '2025-06-20 09:03:06'),
(192, 63, 91, 8, 1, '2', 4.68, NULL, '2025-06-20 09:10:26', '2025-06-20 09:11:07'),
(193, 63, 91, 33, 1, '2', 19.31, NULL, '2025-06-20 09:10:26', '2025-06-20 09:11:12'),
(194, 63, 92, 72, 1, '2', 42.12, NULL, '2025-06-20 09:10:26', '2025-06-20 09:11:16'),
(195, 63, 93, 2, 1, '2', 1.17, NULL, '2025-06-20 09:10:26', '2025-06-20 09:11:17'),
(196, 64, 94, 4, 1, '2', 2.34, NULL, '2025-06-20 09:13:32', '2025-06-20 09:13:37'),
(197, 65, 95, 8, 1, '2', 4.68, NULL, '2025-06-20 09:15:44', '2025-06-20 09:17:15'),
(198, 65, 96, 8, 1, '2', 4.68, NULL, '2025-06-20 09:15:44', '2025-06-20 09:17:15'),
(199, 66, 97, 11, 1, '2', 6.44, NULL, '2025-06-20 09:17:05', '2025-06-20 09:17:16'),
(200, 67, 98, 8, 1, '2', 4.68, NULL, '2025-06-21 23:38:08', '2025-06-21 23:38:38'),
(201, 67, 98, 32, 1, '2', 18.72, NULL, '2025-06-21 23:38:08', '2025-06-21 23:38:39'),
(202, 68, 99, 9, 1, '2', 7.00, NULL, '2025-06-25 16:59:40', '2025-06-25 17:01:57'),
(203, 68, 99, 35, 1, '2', 9.00, NULL, '2025-06-25 16:59:40', '2025-06-25 17:01:58'),
(204, 69, 100, 9, 1, '2', 7.00, NULL, '2025-06-25 17:04:12', '2025-06-25 17:04:23'),
(205, 69, 100, 35, 1, '2', 9.00, NULL, '2025-06-25 17:04:12', '2025-06-25 17:04:21'),
(206, 69, 101, 72, 1, '2', 28.00, NULL, '2025-06-25 17:04:12', '2025-06-25 17:04:21'),
(207, 70, 102, 9, 1, '0', 7.00, NULL, '2025-07-09 19:02:52', '2025-07-09 19:02:52'),
(208, 70, 102, 36, 1, '0', 12.00, NULL, '2025-07-09 19:02:52', '2025-07-09 19:02:52'),
(209, 71, 103, 5, 1, '0', 7.00, NULL, '2025-07-09 19:04:24', '2025-07-09 19:04:24'),
(210, 71, 103, 35, 1, '0', 9.00, NULL, '2025-07-09 19:04:24', '2025-07-09 19:04:24'),
(211, 72, 104, 4, 1, '2', 7.00, NULL, '2025-07-12 16:38:23', '2025-07-12 18:28:30'),
(212, 75, 105, 4, 1, '2', 7.00, NULL, '2025-07-13 05:54:52', '2025-07-13 05:55:38'),
(213, 75, 105, 36, 1, '9', 12.00, NULL, '2025-07-13 05:54:52', '2025-07-13 05:55:37'),
(214, 77, 106, 109, 1, '0', 13.00, NULL, '2025-07-16 16:24:41', '2025-07-16 16:24:41'),
(215, 77, 106, 77, 1, '0', 3.00, NULL, '2025-07-16 16:24:41', '2025-07-16 16:24:41'),
(216, 78, 107, 177, 1, '2', 12.00, NULL, '2025-07-17 18:06:31', '2025-07-31 15:33:38'),
(217, 79, 108, 177, 1, '0', 12.00, NULL, '2025-07-17 18:12:42', '2025-07-17 18:12:42'),
(218, 80, 109, 5, 1, '0', 7.00, NULL, '2025-07-25 18:58:28', '2025-07-25 18:58:28'),
(219, 80, 109, 34, 1, '0', 13.00, NULL, '2025-07-25 18:58:28', '2025-07-25 18:58:28'),
(220, 81, 110, 109, 1, '0', 13.00, NULL, '2025-07-30 01:04:30', '2025-07-30 01:04:30'),
(221, 82, 111, 72, 1, '0', 28.00, NULL, '2025-07-30 01:06:18', '2025-07-30 01:06:18'),
(222, 83, 112, 109, 1, '0', 13.00, NULL, '2025-07-30 01:10:39', '2025-07-30 01:10:39'),
(223, 84, 113, 103, 1, '2', 12.00, NULL, '2025-07-30 01:12:38', '2025-07-30 01:17:09'),
(224, 85, 114, 72, 1, '2', 28.00, NULL, '2025-07-30 01:49:11', '2025-07-30 01:49:28'),
(225, 86, 115, 109, 1, '9', 13.00, NULL, '2025-07-31 02:40:23', '2025-07-31 02:40:35'),
(226, 87, 116, 109, 1, '2', 13.00, NULL, '2025-07-31 02:41:06', '2025-07-31 02:41:26'),
(227, 88, 117, 103, 1, '2', 12.00, NULL, '2025-07-31 02:51:48', '2025-07-31 02:52:08'),
(228, 89, 118, 109, 1, '2', 13.00, NULL, '2025-07-31 02:55:00', '2025-07-31 02:55:10'),
(229, 90, 119, 72, 1, '2', 28.00, NULL, '2025-07-31 15:36:29', '2025-07-31 15:38:05'),
(230, 91, 120, 5, 1, '0', 7.00, NULL, '2025-08-01 17:44:44', '2025-08-01 17:44:44'),
(231, 92, 121, 5, 1, '0', 7.00, NULL, '2025-08-01 17:55:33', '2025-08-01 17:55:33'),
(232, 92, 121, 36, 1, '0', 12.00, NULL, '2025-08-01 17:55:33', '2025-08-01 17:55:33'),
(233, 92, 121, 74, 1, '0', 1.50, NULL, '2025-08-01 17:55:33', '2025-08-01 17:55:33'),
(234, 92, 122, 9, 1, '0', 7.00, NULL, '2025-08-01 17:55:33', '2025-08-01 17:55:33'),
(235, 92, 122, 35, 1, '0', 9.00, NULL, '2025-08-01 17:55:33', '2025-08-01 17:55:33'),
(236, 93, 123, 4, 1, '2', 7.00, NULL, '2025-08-08 18:33:58', '2025-08-08 18:34:12'),
(237, 93, 123, 34, 1, '2', 13.00, NULL, '2025-08-08 18:33:58', '2025-08-08 18:34:12'),
(238, 94, 124, 18, 1, '2', 5.00, NULL, '2025-08-15 07:27:46', '2025-08-15 07:28:15'),
(239, 94, 124, 72, 1, '2', 28.00, NULL, '2025-08-15 07:27:46', '2025-08-15 07:28:15'),
(240, 95, 125, 16, 1, '2', 9.00, NULL, '2025-08-15 07:45:14', '2025-08-15 07:56:15'),
(241, 95, 125, 103, 1, '2', 12.00, NULL, '2025-08-15 07:45:14', '2025-08-15 07:56:15'),
(242, 95, 125, 109, 1, '2', 13.00, NULL, '2025-08-15 07:45:14', '2025-08-15 07:56:14'),
(243, 95, 125, 72, 1, '2', 28.00, NULL, '2025-08-15 07:45:14', '2025-08-15 07:56:14'),
(244, 95, 125, 74, 1, '2', 1.50, NULL, '2025-08-15 07:45:14', '2025-08-15 07:56:14'),
(245, 95, 125, 77, 1, '2', 5.00, NULL, '2025-08-15 07:45:14', '2025-08-15 07:56:16'),
(246, 96, 126, 19, 1, '2', 11.00, NULL, '2025-08-15 07:51:26', '2025-08-15 07:51:46'),
(247, 96, 126, 35, 1, '2', 9.00, NULL, '2025-08-15 07:51:26', '2025-08-15 07:51:45'),
(248, 96, 126, 74, 1, '2', 1.50, NULL, '2025-08-15 07:51:26', '2025-08-15 07:51:45'),
(249, 96, 126, 77, 1, '2', 5.00, NULL, '2025-08-15 07:51:26', '2025-08-15 07:51:44'),
(250, 96, 127, 5, 1, '2', 7.00, NULL, '2025-08-15 07:51:26', '2025-08-15 07:51:44'),
(251, 96, 127, 36, 1, '2', 12.00, NULL, '2025-08-15 07:51:26', '2025-08-15 07:51:43'),
(252, 96, 128, 72, 1, '2', 28.00, NULL, '2025-08-15 07:51:26', '2025-08-15 07:51:43'),
(253, 97, 129, 4, 1, '2', 7.00, NULL, '2025-08-15 07:58:00', '2025-08-15 07:58:10'),
(254, 97, 129, 34, 1, '2', 13.00, NULL, '2025-08-15 07:58:00', '2025-08-15 07:58:10'),
(255, 98, 130, 4, 1, '2', 7.00, NULL, '2025-08-15 07:59:42', '2025-08-15 07:59:49'),
(256, 98, 130, 35, 1, '2', 9.00, NULL, '2025-08-15 07:59:42', '2025-08-15 07:59:50'),
(257, 99, 131, 9, 1, '2', 7.00, NULL, '2025-08-15 08:03:20', '2025-08-15 08:03:35'),
(258, 100, 132, 5, 1, '2', 7.00, NULL, '2025-08-15 08:19:21', '2025-08-15 08:21:23'),
(259, 101, 133, 9, 1, '2', 7.00, NULL, '2025-08-15 08:19:48', '2025-08-15 08:21:28'),
(260, 102, 134, 9, 1, '2', 7.00, NULL, '2025-08-15 08:20:48', '2025-08-15 08:21:32'),
(261, 103, 135, 4, 1, '0', 7.00, NULL, '2025-08-15 08:22:34', '2025-08-15 08:22:34'),
(262, 103, 135, 35, 1, '0', 9.00, NULL, '2025-08-15 08:22:34', '2025-08-15 08:22:34'),
(263, 104, 136, 5, 1, '0', 7.00, NULL, '2025-08-21 20:46:59', '2025-08-21 20:46:59'),
(264, 104, 136, 34, 1, '0', 13.00, NULL, '2025-08-21 20:46:59', '2025-08-21 20:46:59'),
(265, 105, 137, 5, 1, '0', 7.00, NULL, '2025-08-22 05:47:35', '2025-08-22 05:47:35'),
(266, 105, 137, 34, 1, '0', 13.00, NULL, '2025-08-22 05:47:35', '2025-08-22 05:47:35'),
(267, 106, 138, 103, 1, '0', 12.00, NULL, '2025-08-22 07:20:34', '2025-08-22 07:20:34'),
(268, 106, 138, 109, 1, '0', 13.00, NULL, '2025-08-22 07:20:34', '2025-08-22 07:20:34'),
(269, 107, 139, 4, 1, '0', 7.00, NULL, '2025-08-27 22:44:54', '2025-08-27 22:44:54'),
(270, 107, 139, 58, 1, '0', 8.00, NULL, '2025-08-27 22:44:54', '2025-08-27 22:44:54'),
(271, 107, 139, 103, 1, '0', 12.00, NULL, '2025-08-27 22:44:54', '2025-08-27 22:44:54'),
(272, 107, 139, 74, 3, '0', 1.50, NULL, '2025-08-27 22:44:54', '2025-08-27 22:44:54'),
(273, 107, 140, 103, 1, '0', 12.00, NULL, '2025-08-27 22:44:54', '2025-08-27 22:44:54'),
(274, 107, 141, 72, 1, '0', 28.00, NULL, '2025-08-27 22:44:54', '2025-08-27 22:44:54'),
(275, 108, 142, 5, 1, '0', 7.00, NULL, '2025-08-31 17:19:57', '2025-08-31 17:19:57'),
(276, 108, 142, 34, 1, '0', 13.00, NULL, '2025-08-31 17:19:57', '2025-08-31 17:19:57'),
(277, 108, 142, 74, 1, '0', 1.50, NULL, '2025-08-31 17:19:57', '2025-08-31 17:19:57'),
(278, 108, 143, 9, 1, '0', 7.00, NULL, '2025-08-31 17:19:57', '2025-08-31 17:19:57'),
(279, 108, 144, 72, 1, '0', 28.00, NULL, '2025-08-31 17:19:57', '2025-08-31 17:19:57'),
(280, 109, 145, 4, 1, '0', 7.00, NULL, '2025-11-08 00:48:42', '2025-11-08 00:48:42'),
(281, 110, 146, 32, 1, '0', 11.00, NULL, '2025-11-08 21:19:37', '2025-11-08 21:19:37'),
(282, 111, 147, 4, 1, '0', 7.00, NULL, '2025-11-08 21:20:38', '2025-11-08 21:20:38'),
(283, 111, 147, 32, 1, '0', 11.00, NULL, '2025-11-08 21:20:38', '2025-11-08 21:20:38'),
(284, 112, 148, 9, 1, '0', 7.00, NULL, '2025-11-08 21:21:32', '2025-11-08 21:21:32'),
(285, 113, 149, 36, 1, '0', 12.00, NULL, '2025-11-08 21:29:13', '2025-11-08 21:29:13'),
(286, 114, 150, 72, 1, '0', 28.00, NULL, '2026-02-02 02:46:03', '2026-02-02 02:46:03'),
(287, 114, 150, 74, 15, '0', 1.50, NULL, '2026-02-02 02:46:03', '2026-02-02 02:46:03'),
(288, 114, 150, 77, 20, '0', 5.00, NULL, '2026-02-02 02:46:03', '2026-02-02 02:46:03'),
(289, 114, 151, 72, 1, '0', 28.00, NULL, '2026-02-02 02:46:03', '2026-02-02 02:46:03'),
(290, 114, 152, 72, 1, '0', 28.00, NULL, '2026-02-02 02:46:03', '2026-02-02 02:46:03'),
(291, 114, 153, 72, 1, '0', 28.00, NULL, '2026-02-02 02:46:03', '2026-02-02 02:46:03'),
(292, 115, 154, 72, 1, '0', 28.00, NULL, '2026-02-02 02:47:12', '2026-02-02 02:47:12'),
(293, 115, 155, 109, 1, '0', 13.00, NULL, '2026-02-02 02:47:12', '2026-02-02 02:47:12');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `planeacion_menu`
--

CREATE TABLE `planeacion_menu` (
  `id` int NOT NULL,
  `id_producto` int NOT NULL,
  `fecha_plan` date NOT NULL,
  `stock_diario` int NOT NULL DEFAULT '0',
  `precio` decimal(10,2) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `planeacion_menu`
--

INSERT INTO `planeacion_menu` (`id`, `id_producto`, `fecha_plan`, `stock_diario`, `precio`, `created_at`, `updated_at`) VALUES
(1, 3, '2025-05-03', 15, 1.76, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(2, 11, '2025-05-03', 15, 6.44, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(3, 13, '2025-05-03', 15, 7.61, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(4, 8, '2025-05-03', 15, 4.68, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(5, 1, '2025-05-03', 15, 0.59, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(6, 17, '2025-05-03', 20, 9.95, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(7, 21, '2025-05-03', 20, 12.29, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(8, 27, '2025-05-03', 20, 15.80, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(9, 18, '2025-05-03', 20, 10.53, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(10, 33, '2025-05-03', 15, 19.31, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(11, 32, '2025-05-03', 15, 18.72, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(12, 36, '2025-05-03', 15, 21.06, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(13, 35, '2025-05-03', 15, 20.48, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(14, 31, '2025-05-03', 15, 18.14, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(15, 34, '2025-05-03', 15, 19.89, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(16, 39, '2025-05-03', 20, 22.82, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(17, 64, '2025-05-03', 20, 37.44, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(18, 47, '2025-05-03', 20, 27.50, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(19, 51, '2025-05-03', 20, 29.84, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(20, 65, '2025-05-03', 20, 38.03, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(21, 76, '2025-05-03', 10, 44.46, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(22, 80, '2025-05-03', 10, 46.80, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(23, 79, '2025-05-03', 10, 46.22, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(24, 71, '2025-05-03', 50, 41.54, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(25, 72, '2025-05-03', 50, 42.12, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(26, 73, '2025-05-03', 50, 42.71, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(27, 14, '2025-05-04', 15, 8.19, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(28, 1, '2025-05-04', 15, 0.59, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(29, 5, '2025-05-04', 15, 2.93, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(30, 15, '2025-05-04', 15, 8.78, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(31, 12, '2025-05-04', 15, 7.02, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(32, 20, '2025-05-04', 20, 11.70, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(33, 22, '2025-05-04', 20, 12.87, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(34, 23, '2025-05-04', 20, 13.46, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(35, 16, '2025-05-04', 20, 9.36, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(36, 36, '2025-05-04', 15, 21.06, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(37, 32, '2025-05-04', 15, 18.72, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(38, 33, '2025-05-04', 15, 19.31, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(39, 31, '2025-05-04', 15, 18.14, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(40, 35, '2025-05-04', 15, 20.48, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(41, 34, '2025-05-04', 15, 19.89, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(42, 46, '2025-05-04', 20, 26.91, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(43, 60, '2025-05-04', 20, 35.10, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(44, 55, '2025-05-04', 20, 32.18, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(45, 42, '2025-05-04', 20, 24.57, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(46, 70, '2025-05-04', 20, 40.95, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(47, 80, '2025-05-04', 10, 46.80, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(48, 74, '2025-05-04', 10, 43.29, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(49, 78, '2025-05-04', 10, 45.63, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(50, 79, '2025-05-04', 10, 46.22, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(51, 71, '2025-05-04', 50, 41.54, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(52, 72, '2025-05-04', 50, 42.12, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(53, 73, '2025-05-04', 50, 42.71, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(54, 7, '2025-05-05', 15, 4.10, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(55, 6, '2025-05-05', 15, 3.51, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(56, 13, '2025-05-05', 15, 7.61, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(57, 2, '2025-05-05', 15, 1.17, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(58, 14, '2025-05-05', 15, 8.19, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(59, 20, '2025-05-05', 20, 11.70, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(60, 24, '2025-05-05', 20, 14.04, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(61, 18, '2025-05-05', 20, 10.53, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(62, 22, '2025-05-05', 20, 12.87, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(63, 34, '2025-05-05', 15, 19.89, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(64, 35, '2025-05-05', 15, 20.48, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(65, 36, '2025-05-05', 15, 21.06, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(66, 32, '2025-05-05', 15, 18.72, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(67, 31, '2025-05-05', 15, 18.14, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(68, 33, '2025-05-05', 15, 19.31, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(69, 41, '2025-05-05', 20, 23.99, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(70, 61, '2025-05-05', 20, 35.69, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(71, 51, '2025-05-05', 20, 29.84, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(72, 66, '2025-05-05', 20, 38.61, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(73, 69, '2025-05-05', 20, 40.37, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(74, 76, '2025-05-05', 10, 44.46, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(75, 80, '2025-05-05', 10, 46.80, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(76, 78, '2025-05-05', 10, 45.63, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(77, 71, '2025-05-05', 50, 41.54, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(78, 72, '2025-05-05', 50, 42.12, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(79, 73, '2025-05-05', 50, 42.71, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(80, 10, '2025-05-06', 15, 5.85, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(81, 8, '2025-05-06', 15, 4.68, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(82, 9, '2025-05-06', 15, 5.27, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(83, 13, '2025-05-06', 15, 7.61, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(84, 14, '2025-05-06', 15, 8.19, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(85, 22, '2025-05-06', 20, 12.87, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(86, 24, '2025-05-06', 20, 14.04, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(87, 17, '2025-05-06', 20, 9.95, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(88, 20, '2025-05-06', 20, 11.70, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(89, 36, '2025-05-06', 15, 21.06, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(90, 31, '2025-05-06', 15, 18.14, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(91, 32, '2025-05-06', 15, 18.72, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(92, 33, '2025-05-06', 15, 19.31, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(93, 35, '2025-05-06', 15, 20.48, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(94, 34, '2025-05-06', 15, 19.89, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(95, 44, '2025-05-06', 20, 25.74, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(96, 54, '2025-05-06', 20, 31.59, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(97, 39, '2025-05-06', 20, 22.82, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(98, 56, '2025-05-06', 20, 32.76, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(99, 58, '2025-05-06', 20, 33.93, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(100, 76, '2025-05-06', 10, 44.46, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(101, 77, '2025-05-06', 10, 45.05, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(102, 78, '2025-05-06', 10, 45.63, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(103, 71, '2025-05-06', 50, 41.54, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(104, 72, '2025-05-06', 50, 42.12, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(105, 73, '2025-05-06', 50, 42.71, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(106, 3, '2025-05-07', 15, 1.76, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(107, 7, '2025-05-07', 15, 4.10, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(108, 4, '2025-05-07', 15, 2.34, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(109, 14, '2025-05-07', 15, 8.19, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(110, 5, '2025-05-07', 15, 2.93, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(111, 23, '2025-05-07', 20, 13.46, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(112, 21, '2025-05-07', 20, 12.29, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(113, 17, '2025-05-07', 20, 9.95, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(114, 20, '2025-05-07', 20, 11.70, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(115, 35, '2025-05-07', 15, 20.48, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(116, 36, '2025-05-07', 15, 21.06, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(117, 31, '2025-05-07', 15, 18.14, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(118, 33, '2025-05-07', 15, 19.31, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(119, 32, '2025-05-07', 15, 18.72, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(120, 34, '2025-05-07', 15, 19.89, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(121, 42, '2025-05-07', 20, 24.57, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(122, 69, '2025-05-07', 20, 40.37, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(123, 53, '2025-05-07', 20, 31.01, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(124, 62, '2025-05-07', 20, 36.27, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(125, 54, '2025-05-07', 20, 31.59, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(126, 75, '2025-05-07', 10, 43.88, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(127, 77, '2025-05-07', 10, 45.05, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(128, 74, '2025-05-07', 10, 43.29, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(129, 71, '2025-05-07', 50, 41.54, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(130, 72, '2025-05-07', 50, 42.12, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(131, 73, '2025-05-07', 50, 42.71, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(132, 3, '2025-05-08', 15, 1.76, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(133, 7, '2025-05-08', 15, 4.10, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(134, 10, '2025-05-08', 15, 5.85, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(135, 11, '2025-05-08', 15, 6.44, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(136, 2, '2025-05-08', 15, 1.17, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(137, 17, '2025-05-08', 20, 9.95, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(138, 24, '2025-05-08', 20, 14.04, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(139, 27, '2025-05-08', 20, 15.80, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(140, 16, '2025-05-08', 20, 9.36, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(141, 36, '2025-05-08', 15, 21.06, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(142, 34, '2025-05-08', 15, 19.89, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(143, 35, '2025-05-08', 15, 20.48, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(144, 32, '2025-05-08', 15, 18.72, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(145, 31, '2025-05-08', 15, 18.14, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(146, 33, '2025-05-08', 15, 19.31, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(147, 39, '2025-05-08', 20, 22.82, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(148, 43, '2025-05-08', 20, 25.16, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(149, 47, '2025-05-08', 20, 27.50, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(150, 50, '2025-05-08', 20, 29.25, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(151, 69, '2025-05-08', 20, 40.37, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(152, 80, '2025-05-08', 10, 46.80, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(153, 77, '2025-05-08', 10, 45.05, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(154, 79, '2025-05-08', 10, 46.22, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(155, 71, '2025-05-08', 50, 41.54, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(156, 72, '2025-05-08', 50, 42.12, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(157, 73, '2025-05-08', 50, 42.71, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(158, 5, '2025-05-09', 15, 2.93, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(159, 13, '2025-05-09', 15, 7.61, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(160, 10, '2025-05-09', 15, 5.85, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(161, 8, '2025-05-09', 15, 4.68, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(162, 15, '2025-05-09', 15, 8.78, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(163, 20, '2025-05-09', 20, 11.70, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(164, 30, '2025-05-09', 20, 17.55, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(165, 23, '2025-05-09', 20, 13.46, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(166, 24, '2025-05-09', 20, 14.04, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(167, 35, '2025-05-09', 15, 20.48, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(168, 32, '2025-05-09', 15, 18.72, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(169, 34, '2025-05-09', 15, 19.89, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(170, 31, '2025-05-09', 15, 18.14, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(171, 33, '2025-05-09', 15, 19.31, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(172, 36, '2025-05-09', 15, 21.06, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(173, 61, '2025-05-09', 20, 35.69, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(174, 68, '2025-05-09', 20, 39.78, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(175, 52, '2025-05-09', 20, 30.42, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(176, 42, '2025-05-09', 20, 24.57, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(177, 48, '2025-05-09', 20, 28.08, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(178, 79, '2025-05-09', 10, 46.22, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(179, 77, '2025-05-09', 10, 45.05, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(180, 75, '2025-05-09', 10, 43.88, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(181, 74, '2025-05-09', 10, 43.29, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(182, 71, '2025-05-09', 50, 41.54, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(183, 72, '2025-05-09', 50, 42.12, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(184, 73, '2025-05-09', 50, 42.71, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(185, 2, '2025-05-10', 15, 1.17, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(186, 8, '2025-05-10', 15, 4.68, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(187, 4, '2025-05-10', 15, 2.34, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(188, 13, '2025-05-10', 15, 7.61, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(189, 10, '2025-05-10', 15, 5.85, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(190, 29, '2025-05-10', 20, 16.97, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(191, 26, '2025-05-10', 20, 15.21, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(192, 16, '2025-05-10', 20, 9.36, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(193, 23, '2025-05-10', 20, 13.46, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(194, 32, '2025-05-10', 15, 18.72, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(195, 31, '2025-05-10', 15, 18.14, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(196, 35, '2025-05-10', 15, 20.48, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(197, 33, '2025-05-10', 15, 19.31, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(198, 36, '2025-05-10', 15, 21.06, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(199, 34, '2025-05-10', 15, 19.89, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(200, 67, '2025-05-10', 20, 39.20, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(201, 64, '2025-05-10', 20, 37.44, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(202, 53, '2025-05-10', 20, 31.01, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(203, 43, '2025-05-10', 20, 25.16, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(204, 50, '2025-05-10', 20, 29.25, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(205, 78, '2025-05-10', 10, 45.63, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(206, 76, '2025-05-10', 10, 44.46, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(207, 77, '2025-05-10', 10, 45.05, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(208, 80, '2025-05-10', 10, 46.80, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(209, 71, '2025-05-10', 50, 41.54, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(210, 72, '2025-05-10', 50, 42.12, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(211, 73, '2025-05-10', 50, 42.71, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(212, 13, '2025-05-11', 15, 7.61, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(213, 15, '2025-05-11', 15, 8.78, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(214, 7, '2025-05-11', 15, 4.10, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(215, 4, '2025-05-11', 15, 2.34, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(216, 2, '2025-05-11', 15, 1.17, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(217, 17, '2025-05-11', 20, 9.95, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(218, 26, '2025-05-11', 20, 15.21, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(219, 29, '2025-05-11', 20, 16.97, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(220, 24, '2025-05-11', 20, 14.04, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(221, 34, '2025-05-11', 15, 19.89, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(222, 36, '2025-05-11', 15, 21.06, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(223, 35, '2025-05-11', 15, 20.48, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(224, 31, '2025-05-11', 15, 18.14, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(225, 33, '2025-05-11', 15, 19.31, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(226, 32, '2025-05-11', 15, 18.72, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(227, 37, '2025-05-11', 20, 21.65, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(228, 43, '2025-05-11', 20, 25.16, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(229, 70, '2025-05-11', 20, 40.95, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(230, 46, '2025-05-11', 20, 26.91, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(231, 47, '2025-05-11', 20, 27.50, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(232, 80, '2025-05-11', 10, 46.80, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(233, 77, '2025-05-11', 10, 45.05, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(234, 79, '2025-05-11', 10, 46.22, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(235, 71, '2025-05-11', 50, 41.54, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(236, 72, '2025-05-11', 50, 42.12, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(237, 73, '2025-05-11', 50, 42.71, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(238, 5, '2025-05-12', 15, 2.93, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(239, 7, '2025-05-12', 15, 4.10, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(240, 13, '2025-05-12', 15, 7.61, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(241, 4, '2025-05-12', 15, 2.34, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(242, 1, '2025-05-12', 15, 0.59, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(243, 20, '2025-05-12', 20, 11.70, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(244, 21, '2025-05-12', 20, 12.29, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(245, 27, '2025-05-12', 20, 15.80, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(246, 28, '2025-05-12', 20, 16.38, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(247, 36, '2025-05-12', 15, 21.06, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(248, 31, '2025-05-12', 15, 18.14, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(249, 32, '2025-05-12', 15, 18.72, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(250, 35, '2025-05-12', 15, 20.48, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(251, 34, '2025-05-12', 15, 19.89, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(252, 33, '2025-05-12', 15, 19.31, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(253, 53, '2025-05-12', 20, 31.01, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(254, 54, '2025-05-12', 20, 31.59, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(255, 43, '2025-05-12', 20, 25.16, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(256, 58, '2025-05-12', 20, 33.93, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(257, 51, '2025-05-12', 20, 29.84, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(258, 80, '2025-05-12', 10, 46.80, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(259, 74, '2025-05-12', 10, 43.29, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(260, 78, '2025-05-12', 10, 45.63, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(261, 76, '2025-05-12', 10, 44.46, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(262, 71, '2025-05-12', 50, 41.54, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(263, 72, '2025-05-12', 50, 42.12, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(264, 73, '2025-05-12', 50, 42.71, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(265, 6, '2025-05-13', 15, 3.51, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(266, 13, '2025-05-13', 15, 7.61, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(267, 3, '2025-05-13', 15, 1.76, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(268, 9, '2025-05-13', 15, 5.27, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(269, 7, '2025-05-13', 15, 4.10, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(270, 18, '2025-05-13', 20, 10.53, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(271, 25, '2025-05-13', 20, 14.63, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(272, 29, '2025-05-13', 20, 16.97, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(273, 28, '2025-05-13', 20, 16.38, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(274, 36, '2025-05-13', 15, 21.06, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(275, 34, '2025-05-13', 15, 19.89, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(276, 31, '2025-05-13', 15, 18.14, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(277, 32, '2025-05-13', 15, 18.72, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(278, 33, '2025-05-13', 15, 19.31, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(279, 35, '2025-05-13', 15, 20.48, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(280, 49, '2025-05-13', 20, 28.67, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(281, 47, '2025-05-13', 20, 27.50, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(282, 42, '2025-05-13', 20, 24.57, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(283, 59, '2025-05-13', 20, 34.52, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(284, 46, '2025-05-13', 20, 26.91, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(285, 74, '2025-05-13', 10, 43.29, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(286, 76, '2025-05-13', 10, 44.46, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(287, 78, '2025-05-13', 10, 45.63, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(288, 71, '2025-05-13', 50, 41.54, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(289, 72, '2025-05-13', 50, 42.12, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(290, 73, '2025-05-13', 50, 42.71, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(291, 4, '2025-05-14', 15, 2.34, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(292, 6, '2025-05-14', 15, 3.51, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(293, 1, '2025-05-14', 15, 0.59, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(294, 8, '2025-05-14', 15, 4.68, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(295, 12, '2025-05-14', 15, 7.02, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(296, 26, '2025-05-14', 20, 15.21, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(297, 16, '2025-05-14', 20, 9.36, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(298, 30, '2025-05-14', 20, 17.55, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(299, 25, '2025-05-14', 20, 14.63, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(300, 31, '2025-05-14', 15, 18.14, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(301, 36, '2025-05-14', 15, 21.06, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(302, 34, '2025-05-14', 15, 19.89, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(303, 35, '2025-05-14', 15, 20.48, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(304, 32, '2025-05-14', 15, 18.72, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(305, 33, '2025-05-14', 15, 19.31, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(306, 61, '2025-05-14', 20, 35.69, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(307, 47, '2025-05-14', 20, 27.50, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(308, 51, '2025-05-14', 20, 29.84, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(309, 59, '2025-05-14', 20, 34.52, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(310, 43, '2025-05-14', 20, 25.16, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(311, 74, '2025-05-14', 10, 43.29, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(312, 80, '2025-05-14', 10, 46.80, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(313, 77, '2025-05-14', 10, 45.05, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(314, 75, '2025-05-14', 10, 43.88, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(315, 71, '2025-05-14', 50, 41.54, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(316, 72, '2025-05-14', 50, 42.12, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(317, 73, '2025-05-14', 50, 42.71, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(318, 8, '2025-05-15', 15, 4.68, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(319, 9, '2025-05-15', 15, 5.27, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(320, 1, '2025-05-15', 15, 0.59, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(321, 3, '2025-05-15', 15, 1.76, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(322, 6, '2025-05-15', 15, 3.51, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(323, 29, '2025-05-15', 20, 16.97, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(324, 27, '2025-05-15', 20, 15.80, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(325, 25, '2025-05-15', 20, 14.63, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(326, 20, '2025-05-15', 20, 11.70, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(327, 36, '2025-05-15', 15, 21.06, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(328, 31, '2025-05-15', 15, 18.14, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(329, 34, '2025-05-15', 15, 19.89, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(330, 32, '2025-05-15', 15, 18.72, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(331, 33, '2025-05-15', 15, 19.31, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(332, 35, '2025-05-15', 15, 20.48, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(333, 55, '2025-05-15', 20, 32.18, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(334, 43, '2025-05-15', 20, 25.16, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(335, 39, '2025-05-15', 20, 22.82, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(336, 69, '2025-05-15', 20, 40.37, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(337, 46, '2025-05-15', 20, 26.91, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(338, 75, '2025-05-15', 10, 43.88, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(339, 78, '2025-05-15', 10, 45.63, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(340, 77, '2025-05-15', 10, 45.05, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(341, 71, '2025-05-15', 50, 41.54, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(342, 72, '2025-05-15', 50, 42.12, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(343, 73, '2025-05-15', 50, 42.71, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(344, 8, '2025-05-16', 15, 4.68, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(345, 11, '2025-05-16', 15, 6.44, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(346, 7, '2025-05-16', 15, 4.10, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(347, 2, '2025-05-16', 15, 1.17, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(348, 4, '2025-05-16', 15, 2.34, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(349, 20, '2025-05-16', 20, 11.70, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(350, 27, '2025-05-16', 20, 15.80, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(351, 22, '2025-05-16', 20, 12.87, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(352, 30, '2025-05-16', 20, 17.55, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(353, 36, '2025-05-16', 15, 21.06, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(354, 35, '2025-05-16', 15, 20.48, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(355, 33, '2025-05-16', 15, 19.31, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(356, 31, '2025-05-16', 15, 18.14, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(357, 34, '2025-05-16', 15, 19.89, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(358, 32, '2025-05-16', 15, 18.72, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(359, 58, '2025-05-16', 20, 33.93, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(360, 65, '2025-05-16', 20, 38.03, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(361, 56, '2025-05-16', 20, 32.76, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(362, 39, '2025-05-16', 20, 22.82, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(363, 57, '2025-05-16', 20, 33.35, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(364, 75, '2025-05-16', 10, 43.88, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(365, 79, '2025-05-16', 10, 46.22, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(366, 77, '2025-05-16', 10, 45.05, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(367, 71, '2025-05-16', 50, 41.54, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(368, 72, '2025-05-16', 50, 42.12, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(369, 73, '2025-05-16', 50, 42.71, '2025-05-29 14:29:14', '2025-04-10 08:12:05'),
(371, 18, '2025-05-19', 5, 10.53, '2025-05-29 14:29:14', '2025-05-19 21:10:35'),
(372, 3, '2025-05-19', 3, 1.76, '2025-05-29 14:29:14', '2025-05-19 21:17:05'),
(373, 31, '2025-05-19', 5, 18.14, '2025-05-29 14:29:14', '2025-05-19 21:31:40'),
(374, 58, '2025-05-19', 5, 33.93, '2025-05-29 14:29:14', '2025-05-19 21:42:34'),
(375, 34, '2025-05-19', 5, 19.89, '2025-05-29 14:29:14', '2025-05-19 21:42:53'),
(376, 80, '2025-05-19', 5, 46.80, '2025-05-29 14:29:14', '2025-05-19 21:43:22'),
(377, 86, '2025-05-19', 50, 50.31, '2025-05-29 14:29:14', '2025-05-19 21:51:53'),
(378, 22, '2025-05-19', 5, 12.87, '2025-05-29 14:29:14', '2025-05-19 21:52:29'),
(379, 63, '2025-05-19', 6, 36.86, '2025-05-29 14:29:14', '2025-05-19 21:52:37'),
(380, 10, '2025-05-19', 6, 5.85, '2025-05-29 14:29:14', '2025-05-19 21:56:55'),
(381, 20, '2025-05-19', 6, 11.70, '2025-05-29 14:29:14', '2025-05-19 21:57:39'),
(382, 58, '2025-05-19', 10, 33.93, '2025-05-29 14:29:14', '2025-05-19 21:57:46'),
(383, 2, '2025-05-19', 12, 1.17, '2025-05-29 14:29:14', '2025-05-19 23:26:30'),
(385, 2, '2025-05-20', 5, 1.17, '2025-05-29 14:29:14', '2025-05-20 01:53:46'),
(386, 3, '2025-05-20', 55, 1.76, '2025-05-29 14:29:14', '2025-05-20 01:53:54'),
(387, 7, '2025-05-20', 5, 4.10, '2025-05-29 14:29:14', '2025-05-20 01:54:00'),
(388, 18, '2025-05-20', 10, 10.53, '2025-05-29 14:29:14', '2025-05-20 01:54:06'),
(389, 33, '2025-05-20', 100, 19.31, '2025-05-29 14:29:14', '2025-05-20 01:54:10'),
(390, 34, '2025-05-20', 5, 19.89, '2025-05-29 14:29:14', '2025-05-20 01:54:14'),
(391, 53, '2025-05-20', 5, 31.01, '2025-05-29 14:29:14', '2025-05-20 01:54:16'),
(392, 54, '2025-05-20', 5, 31.59, '2025-05-29 14:29:14', '2025-05-20 01:54:19'),
(393, 72, '2025-05-20', 5, 42.12, '2025-05-29 14:29:14', '2025-05-20 01:54:25'),
(394, 73, '2025-05-20', 10, 42.71, '2025-05-29 14:29:14', '2025-05-20 01:54:32'),
(395, 75, '2025-05-20', 100, 43.88, '2025-05-29 14:29:14', '2025-05-20 01:54:40'),
(396, 77, '2025-05-20', 10, 45.05, '2025-05-29 14:29:14', '2025-05-20 01:54:45'),
(397, 72, '2025-05-19', 12, 42.12, '2025-05-29 14:29:14', '2025-05-20 01:57:03'),
(398, 2, '2025-05-30', 12, 1.17, '2025-05-30 09:41:14', '2025-05-20 01:57:27'),
(400, 87, '2025-05-20', 12, 50.90, '2025-05-29 14:29:14', '2025-05-20 21:13:38'),
(410, 4, '2025-05-30', 5, 2.34, '2025-05-30 09:41:14', '2025-05-21 09:24:14'),
(411, 17, '2025-05-30', 10, 9.95, '2025-05-30 09:41:14', '2025-05-21 09:24:19'),
(412, 19, '2025-05-30', 5, 11.12, '2025-05-30 09:41:14', '2025-05-21 09:24:23'),
(413, 33, '2025-05-30', 25, 19.31, '2025-05-30 09:41:14', '2025-05-21 09:24:29'),
(414, 53, '2025-05-30', 15, 31.01, '2025-05-30 09:41:14', '2025-05-21 09:24:37'),
(415, 52, '2025-05-30', 15, 30.42, '2025-05-30 09:41:14', '2025-05-21 09:24:40'),
(416, 55, '2025-05-30', 15, 32.18, '2025-05-30 09:41:14', '2025-05-21 09:24:43'),
(417, 87, '2025-05-30', 5, 50.90, '2025-05-30 09:41:14', '2025-05-21 09:25:15'),
(418, 71, '2025-05-30', 15, 41.54, '2025-05-30 09:41:14', '2025-05-21 09:25:24'),
(419, 86, '2025-05-30', 20, 50.31, '2025-05-30 09:41:14', '2025-05-21 09:25:31'),
(420, 76, '2025-05-30', 20, 44.46, '2025-05-30 09:41:14', '2025-05-21 09:25:37'),
(424, 75, '2025-05-22', 11, 18.72, '2025-05-29 14:29:14', '2025-05-22 18:47:41'),
(425, 52, '2025-05-22', 11, 18.72, '2025-05-29 14:29:14', '2025-05-22 18:47:47'),
(426, 31, '2025-05-22', 11, 18.72, '2025-05-29 14:29:14', '2025-05-22 18:47:49'),
(427, 17, '2025-05-22', 11, 18.72, '2025-05-29 14:29:14', '2025-05-22 18:47:51'),
(429, 4, '2025-05-20', 1, 2.34, '2025-05-29 14:29:14', '2025-05-22 19:21:07'),
(431, 7, '2025-05-22', 11, 25.74, '2025-05-29 14:29:14', '2025-05-22 21:58:02'),
(432, 71, '2025-05-22', 11, 259.74, '2025-05-29 14:29:14', '2025-05-22 22:58:31'),
(433, 72, '2025-05-22', 11, 25.74, '2025-05-29 14:29:14', '2025-05-22 22:58:42'),
(450, 5, '2025-06-03', 20, 7.00, '2025-06-03 16:42:53', '2025-05-30 12:32:37'),
(451, 7, '2025-06-03', 18, 6.00, '2025-06-03 16:42:53', '2025-05-30 12:33:01'),
(452, 16, '2025-06-03', 18, 9.00, '2025-06-03 16:42:53', '2025-05-30 12:33:39'),
(453, 19, '2025-06-03', 15, 11.00, '2025-06-03 16:42:53', '2025-05-30 12:33:46'),
(454, 4, '2025-06-03', 19, 7.00, '2025-06-03 16:42:53', '2025-05-30 12:33:54'),
(455, 6, '2025-06-03', 19, 9.00, '2025-06-03 16:42:53', '2025-05-30 12:34:00'),
(456, 9, '2025-06-03', 19, 7.00, '2025-06-03 16:42:53', '2025-05-30 12:34:06'),
(457, 28, '2025-06-03', 15, 10.00, '2025-06-03 16:42:53', '2025-05-30 12:34:17'),
(458, 32, '2025-06-03', 20, 11.00, '2025-06-03 16:42:53', '2025-05-30 12:34:26'),
(459, 53, '2025-06-03', 12, 11.00, '2025-06-03 16:42:53', '2025-05-30 12:34:37'),
(460, 87, '2025-06-03', 8, 19.00, '2025-06-03 16:42:53', '2025-05-30 12:34:50'),
(461, 72, '2025-06-03', 5, 28.00, '2025-06-03 16:42:53', '2025-05-30 12:34:59'),
(462, 74, '2025-06-03', 15, 3.00, '2025-06-03 16:42:53', '2025-05-30 12:35:06'),
(463, 77, '2025-06-03', 20, 3.00, '2025-06-03 16:42:53', '2025-05-30 12:35:16'),
(464, 54, '2025-06-03', 5, 12.00, '2025-06-03 16:42:53', '2025-05-30 12:35:25'),
(465, 34, '2025-06-03', 14, 13.00, '2025-06-03 16:42:53', '2025-05-30 12:35:31'),
(466, 56, '2025-06-03', 20, 8.00, '2025-06-03 16:42:53', '2025-05-30 12:35:36'),
(467, 36, '2025-06-03', 20, 12.00, '2025-06-03 16:42:53', '2025-05-30 12:35:44'),
(468, 57, '2025-06-03', 14, 9.00, '2025-06-03 16:42:53', '2025-05-30 12:35:52'),
(469, 58, '2025-06-03', 12, 8.00, '2025-06-03 16:42:53', '2025-05-30 12:35:57'),
(470, 35, '2025-06-03', 12, 9.00, '2025-06-03 16:42:53', '2025-05-30 12:36:05'),
(471, 18, '2025-06-03', 5, 5.00, '2025-06-03 16:42:53', '2025-05-30 12:36:10'),
(472, 5, '2025-05-30', 15, 9.00, '2025-05-30 12:37:09', '2025-05-30 12:37:09'),
(473, 16, '2025-05-30', 14, 9.00, '2025-05-30 12:37:18', '2025-05-30 12:37:18'),
(474, 34, '2025-05-30', 2, 15.00, '2025-05-30 12:37:28', '2025-05-30 12:37:28'),
(475, 73, '2025-05-30', 2, 12.00, '2025-05-30 12:37:40', '2025-05-30 12:37:40'),
(476, 6, '2025-05-30', 5, 5.00, '2025-05-30 12:38:54', '2025-05-30 12:38:54'),
(477, 7, '2025-05-30', 6, 4.00, '2025-05-30 12:38:58', '2025-05-30 12:38:58'),
(478, 56, '2025-05-30', 5, 5.00, '2025-05-30 12:39:29', '2025-05-30 12:39:29'),
(479, 54, '2025-05-30', 5, 5.00, '2025-05-30 12:39:33', '2025-05-30 12:39:33'),
(480, 3, '2025-06-01', 15, 9.00, '2025-06-01 21:05:03', '2025-06-01 21:05:03'),
(481, 5, '2025-06-01', 20, 5.00, '2025-06-01 21:05:13', '2025-06-01 21:05:13'),
(482, 33, '2025-06-01', 15, 10.00, '2025-06-01 21:06:07', '2025-06-01 21:06:07'),
(483, 35, '2025-06-01', 8, 8.00, '2025-06-01 21:06:14', '2025-06-01 21:06:14'),
(484, 75, '2025-06-01', 10, 3.00, '2025-06-01 21:08:11', '2025-06-01 21:08:11'),
(485, 1, '2025-06-04', 11, 11.00, '2025-06-04 07:33:11', '2025-06-04 07:33:11'),
(486, 17, '2025-06-04', 11, 11.00, '2025-06-04 07:33:12', '2025-06-04 07:33:12'),
(487, 32, '2025-06-04', 11, 11.00, '2025-06-04 07:33:12', '2025-06-04 07:33:12'),
(488, 53, '2025-06-04', 11, 11.00, '2025-06-04 07:33:13', '2025-06-04 07:33:13'),
(489, 87, '2025-06-04', 11, 11.00, '2025-06-04 07:33:15', '2025-06-04 07:33:15'),
(490, 72, '2025-06-04', 11, 11.00, '2025-06-04 07:33:16', '2025-06-04 07:33:16'),
(492, 76, '2025-06-04', 11, 11.00, '2025-06-04 09:27:59', '2025-06-04 09:27:59'),
(495, 19, '2025-06-02', 5, 11.12, '2025-06-04 09:35:32', '2025-06-04 09:35:32'),
(496, 7, '2025-06-02', 6, 4.00, '2025-06-04 09:35:32', '2025-06-04 09:35:32'),
(497, 34, '2025-06-02', 2, 15.00, '2025-06-04 09:35:32', '2025-06-04 09:35:32'),
(498, 56, '2025-06-02', 5, 5.00, '2025-06-04 09:35:32', '2025-06-04 09:35:32'),
(499, 87, '2025-06-02', 5, 50.90, '2025-06-04 09:35:32', '2025-06-04 09:35:32'),
(500, 73, '2025-06-02', 2, 12.00, '2025-06-04 09:35:32', '2025-06-04 09:35:32'),
(501, 86, '2025-06-02', 20, 50.31, '2025-06-04 09:35:33', '2025-06-04 09:35:33'),
(502, 2, '2025-06-02', 12, 1.17, '2025-06-04 09:35:36', '2025-06-04 09:35:36'),
(503, 4, '2025-06-02', 5, 2.34, '2025-06-04 09:35:36', '2025-06-04 09:35:36'),
(504, 5, '2025-06-02', 15, 9.00, '2025-06-04 09:35:36', '2025-06-04 09:35:36'),
(505, 6, '2025-06-02', 5, 5.00, '2025-06-04 09:35:36', '2025-06-04 09:35:36'),
(506, 16, '2025-06-02', 14, 9.00, '2025-06-04 09:35:36', '2025-06-04 09:35:36'),
(507, 17, '2025-06-02', 10, 9.95, '2025-06-04 09:35:36', '2025-06-04 09:35:36'),
(508, 33, '2025-06-02', 25, 19.31, '2025-06-04 09:35:36', '2025-06-04 09:35:36'),
(509, 52, '2025-06-02', 15, 30.42, '2025-06-04 09:35:36', '2025-06-04 09:35:36'),
(510, 53, '2025-06-02', 15, 31.01, '2025-06-04 09:35:36', '2025-06-04 09:35:36'),
(511, 54, '2025-06-02', 5, 5.00, '2025-06-04 09:35:36', '2025-06-04 09:35:36'),
(512, 55, '2025-06-02', 15, 32.18, '2025-06-04 09:35:36', '2025-06-04 09:35:36'),
(513, 71, '2025-06-02', 15, 41.54, '2025-06-04 09:35:36', '2025-06-04 09:35:36'),
(514, 76, '2025-06-02', 20, 44.46, '2025-06-04 09:35:36', '2025-06-04 09:35:36'),
(515, 1, '2025-06-05', 11, 11.00, '2025-06-04 09:40:43', '2025-06-04 09:40:43'),
(516, 17, '2025-06-05', 11, 11.00, '2025-06-04 09:40:43', '2025-06-04 09:40:43'),
(517, 32, '2025-06-05', 11, 11.00, '2025-06-04 09:40:43', '2025-06-04 09:40:43'),
(518, 53, '2025-06-05', 11, 11.00, '2025-06-04 09:40:43', '2025-06-04 09:40:43'),
(520, 72, '2025-06-05', 11, 11.00, '2025-06-04 09:40:43', '2025-06-04 09:40:43'),
(521, 76, '2025-06-05', 11, 11.00, '2025-06-04 09:40:43', '2025-06-04 09:40:43'),
(522, 87, '2025-06-05', 11, 11.00, '2025-06-04 09:40:48', '2025-06-04 09:40:48'),
(523, 4, '2025-06-06', 19, 7.00, '2025-06-04 14:06:34', '2025-06-04 14:06:34'),
(524, 5, '2025-06-06', 20, 7.00, '2025-06-04 14:06:34', '2025-06-04 14:06:34'),
(525, 6, '2025-06-06', 19, 9.00, '2025-06-04 14:06:34', '2025-06-04 14:06:34'),
(526, 7, '2025-06-06', 18, 6.00, '2025-06-04 14:06:34', '2025-06-04 14:06:34'),
(527, 9, '2025-06-06', 19, 7.00, '2025-06-04 14:06:34', '2025-06-04 14:06:34'),
(528, 16, '2025-06-06', 18, 9.00, '2025-06-04 14:06:34', '2025-06-04 14:06:34'),
(529, 18, '2025-06-06', 5, 5.00, '2025-06-04 14:06:34', '2025-06-04 14:06:34'),
(530, 19, '2025-06-06', 15, 11.00, '2025-06-04 14:06:34', '2025-06-04 14:06:34'),
(531, 28, '2025-06-06', 15, 10.00, '2025-06-04 14:06:34', '2025-06-04 14:06:34'),
(532, 32, '2025-06-06', 20, 11.00, '2025-06-04 14:06:34', '2025-06-04 14:06:34'),
(533, 34, '2025-06-06', 14, 13.00, '2025-06-04 14:06:34', '2025-06-04 14:06:34'),
(534, 35, '2025-06-06', 12, 9.00, '2025-06-04 14:06:34', '2025-06-04 14:06:34'),
(535, 36, '2025-06-06', 20, 12.00, '2025-06-04 14:06:34', '2025-06-04 14:06:34'),
(536, 53, '2025-06-06', 12, 11.00, '2025-06-04 14:06:34', '2025-06-04 14:06:34'),
(537, 54, '2025-06-06', 5, 12.00, '2025-06-04 14:06:34', '2025-06-04 14:06:34'),
(538, 56, '2025-06-06', 20, 8.00, '2025-06-04 14:06:34', '2025-06-04 14:06:34'),
(539, 57, '2025-06-06', 14, 9.00, '2025-06-04 14:06:34', '2025-06-04 14:06:34'),
(540, 58, '2025-06-06', 12, 8.00, '2025-06-04 14:06:34', '2025-06-04 14:06:34'),
(541, 87, '2025-06-06', 8, 19.00, '2025-06-04 14:06:34', '2025-06-04 14:06:34'),
(542, 72, '2025-06-06', 5, 28.00, '2025-06-04 14:06:34', '2025-06-04 14:06:34'),
(543, 74, '2025-06-06', 15, 3.00, '2025-06-04 14:06:34', '2025-06-04 14:06:34'),
(544, 77, '2025-06-06', 20, 3.00, '2025-06-04 14:06:34', '2025-06-04 14:06:34'),
(545, 4, '2025-06-07', 19, 7.00, '2025-06-04 14:06:56', '2025-06-04 14:06:56'),
(546, 5, '2025-06-07', 20, 7.00, '2025-06-04 14:06:56', '2025-06-04 14:06:56'),
(547, 6, '2025-06-07', 19, 9.00, '2025-06-04 14:06:56', '2025-06-04 14:06:56'),
(548, 7, '2025-06-07', 18, 6.00, '2025-06-04 14:06:56', '2025-06-04 14:06:56'),
(549, 9, '2025-06-07', 19, 7.00, '2025-06-04 14:06:56', '2025-06-04 14:06:56'),
(550, 16, '2025-06-07', 18, 9.00, '2025-06-04 14:06:56', '2025-06-04 14:06:56'),
(551, 18, '2025-06-07', 5, 5.00, '2025-06-04 14:06:56', '2025-06-04 14:06:56'),
(552, 19, '2025-06-07', 15, 11.00, '2025-06-04 14:06:56', '2025-06-04 14:06:56'),
(553, 28, '2025-06-07', 15, 10.00, '2025-06-04 14:06:56', '2025-06-04 14:06:56'),
(554, 32, '2025-06-07', 20, 11.00, '2025-06-04 14:06:56', '2025-06-04 14:06:56'),
(555, 34, '2025-06-07', 14, 13.00, '2025-06-04 14:06:56', '2025-06-04 14:06:56'),
(556, 35, '2025-06-07', 12, 9.00, '2025-06-04 14:06:56', '2025-06-04 14:06:56'),
(557, 36, '2025-06-07', 20, 12.00, '2025-06-04 14:06:56', '2025-06-04 14:06:56'),
(558, 53, '2025-06-07', 12, 11.00, '2025-06-04 14:06:56', '2025-06-04 14:06:56'),
(559, 54, '2025-06-07', 5, 12.00, '2025-06-04 14:06:56', '2025-06-04 14:06:56'),
(560, 56, '2025-06-07', 20, 8.00, '2025-06-04 14:06:56', '2025-06-04 14:06:56'),
(561, 57, '2025-06-07', 14, 9.00, '2025-06-04 14:06:56', '2025-06-04 14:06:56'),
(562, 58, '2025-06-07', 12, 8.00, '2025-06-04 14:06:56', '2025-06-04 14:06:56'),
(563, 87, '2025-06-07', 8, 19.00, '2025-06-04 14:06:56', '2025-06-04 14:06:56'),
(564, 72, '2025-06-07', 5, 28.00, '2025-06-04 14:06:56', '2025-06-04 14:06:56'),
(565, 74, '2025-06-07', 15, 3.00, '2025-06-04 14:06:56', '2025-06-04 14:06:56'),
(566, 77, '2025-06-07', 20, 3.00, '2025-06-04 14:06:56', '2025-06-04 14:06:56'),
(567, 4, '2025-06-05', 11, 10.00, '2025-06-05 23:18:48', '2025-06-05 23:18:48'),
(568, 18, '2025-06-05', 10, 11.00, '2025-06-05 23:18:53', '2025-06-05 23:18:53'),
(569, 35, '2025-06-05', 11, 10.00, '2025-06-05 23:18:58', '2025-06-05 23:18:58'),
(570, 4, '2025-06-09', 19, 7.00, '2025-06-09 20:26:22', '2025-06-09 20:26:22'),
(571, 5, '2025-06-09', 20, 7.00, '2025-06-09 20:26:22', '2025-06-09 20:26:22'),
(572, 6, '2025-06-09', 19, 9.00, '2025-06-09 20:26:22', '2025-06-09 20:26:22'),
(573, 7, '2025-06-09', 18, 6.00, '2025-06-09 20:26:22', '2025-06-09 20:26:22'),
(574, 9, '2025-06-09', 19, 7.00, '2025-06-09 20:26:22', '2025-06-09 20:26:22'),
(575, 16, '2025-06-09', 18, 9.00, '2025-06-09 20:26:22', '2025-06-09 20:26:22'),
(576, 18, '2025-06-09', 5, 5.00, '2025-06-09 20:26:22', '2025-06-09 20:26:22'),
(577, 19, '2025-06-09', 15, 11.00, '2025-06-09 20:26:22', '2025-06-09 20:26:22'),
(578, 28, '2025-06-09', 15, 10.00, '2025-06-09 20:26:22', '2025-06-09 20:26:22'),
(579, 32, '2025-06-09', 20, 11.00, '2025-06-09 20:26:22', '2025-06-09 20:26:22'),
(580, 34, '2025-06-09', 14, 13.00, '2025-06-09 20:26:22', '2025-06-09 20:26:22'),
(581, 35, '2025-06-09', 12, 9.00, '2025-06-09 20:26:22', '2025-06-09 20:26:22'),
(582, 36, '2025-06-09', 20, 12.00, '2025-06-09 20:26:22', '2025-06-09 20:26:22'),
(583, 53, '2025-06-09', 12, 11.00, '2025-06-09 20:26:22', '2025-06-09 20:26:22'),
(584, 54, '2025-06-09', 5, 12.00, '2025-06-09 20:26:22', '2025-06-09 20:26:22'),
(585, 56, '2025-06-09', 20, 8.00, '2025-06-09 20:26:22', '2025-06-09 20:26:22'),
(586, 57, '2025-06-09', 14, 9.00, '2025-06-09 20:26:22', '2025-06-09 20:26:22'),
(587, 58, '2025-06-09', 12, 8.00, '2025-06-09 20:26:22', '2025-06-09 20:26:22'),
(588, 87, '2025-06-09', 8, 19.00, '2025-06-09 20:26:22', '2025-06-09 20:26:22'),
(589, 72, '2025-06-09', 5, 28.00, '2025-06-09 20:26:22', '2025-06-09 20:26:22'),
(590, 74, '2025-06-09', 15, 3.00, '2025-06-09 20:26:22', '2025-06-09 20:26:22'),
(591, 77, '2025-06-09', 20, 3.00, '2025-06-09 20:26:22', '2025-06-09 20:26:22'),
(592, 1, '2025-06-11', 11, 11.00, '2025-06-11 18:36:22', '2025-06-11 18:36:22'),
(593, 17, '2025-06-11', 11, 11.00, '2025-06-11 18:36:22', '2025-06-11 18:36:22'),
(594, 32, '2025-06-11', 11, 11.00, '2025-06-11 18:36:22', '2025-06-11 18:36:22'),
(595, 53, '2025-06-11', 11, 11.00, '2025-06-11 18:36:22', '2025-06-11 18:36:22'),
(596, 72, '2025-06-11', 11, 11.00, '2025-06-11 18:36:22', '2025-06-11 18:36:22'),
(597, 76, '2025-06-11', 11, 11.00, '2025-06-11 18:36:22', '2025-06-11 18:36:22'),
(598, 87, '2025-06-11', 11, 11.00, '2025-06-11 18:36:22', '2025-06-11 18:36:22'),
(599, 4, '2025-06-11', 11, 10.00, '2025-06-11 18:36:22', '2025-06-11 18:36:22'),
(600, 18, '2025-06-11', 10, 11.00, '2025-06-11 18:36:22', '2025-06-11 18:36:22'),
(601, 35, '2025-06-11', 11, 10.00, '2025-06-11 18:36:22', '2025-06-11 18:36:22'),
(602, 4, '2025-06-14', 19, 7.00, '2025-06-14 18:11:21', '2025-06-14 18:11:21'),
(603, 5, '2025-06-14', 20, 7.00, '2025-06-14 18:11:21', '2025-06-14 18:11:21'),
(604, 6, '2025-06-14', 19, 9.00, '2025-06-14 18:11:21', '2025-06-14 18:11:21'),
(605, 7, '2025-06-14', 18, 6.00, '2025-06-14 18:11:21', '2025-06-14 18:11:21'),
(606, 9, '2025-06-14', 19, 7.00, '2025-06-14 18:11:21', '2025-06-14 18:11:21'),
(607, 16, '2025-06-14', 18, 9.00, '2025-06-14 18:11:21', '2025-06-14 18:11:21'),
(608, 18, '2025-06-14', 5, 5.00, '2025-06-14 18:11:21', '2025-06-14 18:11:21'),
(609, 19, '2025-06-14', 15, 11.00, '2025-06-14 18:11:21', '2025-06-14 18:11:21'),
(610, 28, '2025-06-14', 15, 10.00, '2025-06-14 18:11:21', '2025-06-14 18:11:21'),
(611, 32, '2025-06-14', 20, 11.00, '2025-06-14 18:11:21', '2025-06-14 18:11:21'),
(612, 34, '2025-06-14', 14, 13.00, '2025-06-14 18:11:21', '2025-06-14 18:11:21'),
(613, 35, '2025-06-14', 12, 9.00, '2025-06-14 18:11:21', '2025-06-14 18:11:21'),
(614, 36, '2025-06-14', 20, 12.00, '2025-06-14 18:11:21', '2025-06-14 18:11:21'),
(615, 53, '2025-06-14', 12, 11.00, '2025-06-14 18:11:21', '2025-06-14 18:11:21'),
(616, 54, '2025-06-14', 5, 12.00, '2025-06-14 18:11:21', '2025-06-14 18:11:21'),
(617, 56, '2025-06-14', 20, 8.00, '2025-06-14 18:11:21', '2025-06-14 18:11:21'),
(618, 57, '2025-06-14', 14, 9.00, '2025-06-14 18:11:21', '2025-06-14 18:11:21'),
(619, 58, '2025-06-14', 12, 8.00, '2025-06-14 18:11:21', '2025-06-14 18:11:21'),
(620, 87, '2025-06-14', 8, 19.00, '2025-06-14 18:11:21', '2025-06-14 18:11:21'),
(621, 72, '2025-06-14', 5, 28.00, '2025-06-14 18:11:21', '2025-06-14 18:11:21'),
(622, 74, '2025-06-14', 15, 3.00, '2025-06-14 18:11:21', '2025-06-14 18:11:21'),
(623, 77, '2025-06-14', 20, 3.00, '2025-06-14 18:11:21', '2025-06-14 18:11:21'),
(624, 19, '2025-06-16', 5, 11.12, '2025-06-16 11:24:18', '2025-06-16 11:24:18'),
(625, 7, '2025-06-16', 6, 4.00, '2025-06-16 11:24:18', '2025-06-16 11:24:18'),
(626, 34, '2025-06-16', 2, 15.00, '2025-06-16 11:24:18', '2025-06-16 11:24:18'),
(627, 56, '2025-06-16', 5, 5.00, '2025-06-16 11:24:18', '2025-06-16 11:24:18'),
(628, 87, '2025-06-16', 5, 50.90, '2025-06-16 11:24:18', '2025-06-16 11:24:18'),
(629, 73, '2025-06-16', 2, 12.00, '2025-06-16 11:24:18', '2025-06-16 11:24:18'),
(630, 86, '2025-06-16', 20, 50.31, '2025-06-16 11:24:18', '2025-06-16 11:24:18'),
(631, 2, '2025-06-16', 12, 1.17, '2025-06-16 11:24:18', '2025-06-16 11:24:18'),
(632, 4, '2025-06-16', 5, 2.34, '2025-06-16 11:24:18', '2025-06-16 11:24:18'),
(633, 5, '2025-06-16', 15, 9.00, '2025-06-16 11:24:18', '2025-06-16 11:24:18'),
(634, 6, '2025-06-16', 5, 5.00, '2025-06-16 11:24:18', '2025-06-16 11:24:18'),
(635, 16, '2025-06-16', 14, 9.00, '2025-06-16 11:24:18', '2025-06-16 11:24:18'),
(636, 17, '2025-06-16', 10, 9.95, '2025-06-16 11:24:18', '2025-06-16 11:24:18'),
(637, 33, '2025-06-16', 25, 19.31, '2025-06-16 11:24:18', '2025-06-16 11:24:18'),
(638, 52, '2025-06-16', 15, 30.42, '2025-06-16 11:24:18', '2025-06-16 11:24:18'),
(639, 53, '2025-06-16', 15, 31.01, '2025-06-16 11:24:18', '2025-06-16 11:24:18'),
(640, 54, '2025-06-16', 5, 5.00, '2025-06-16 11:24:18', '2025-06-16 11:24:18'),
(641, 55, '2025-06-16', 15, 32.18, '2025-06-16 11:24:18', '2025-06-16 11:24:18'),
(642, 71, '2025-06-16', 15, 41.54, '2025-06-16 11:24:18', '2025-06-16 11:24:18'),
(643, 76, '2025-06-16', 20, 44.46, '2025-06-16 11:24:18', '2025-06-16 11:24:18'),
(644, 4, '2025-06-18', 19, 7.00, '2025-06-18 14:20:19', '2025-06-18 14:20:19'),
(645, 5, '2025-06-18', 20, 7.00, '2025-06-18 14:20:19', '2025-06-18 14:20:19'),
(646, 6, '2025-06-18', 19, 9.00, '2025-06-18 14:20:19', '2025-06-18 14:20:19'),
(647, 7, '2025-06-18', 18, 6.00, '2025-06-18 14:20:19', '2025-06-18 14:20:19'),
(648, 9, '2025-06-18', 19, 7.00, '2025-06-18 14:20:19', '2025-06-18 14:20:19'),
(649, 16, '2025-06-18', 18, 9.00, '2025-06-18 14:20:19', '2025-06-18 14:20:19'),
(650, 18, '2025-06-18', 5, 5.00, '2025-06-18 14:20:19', '2025-06-18 14:20:19'),
(651, 19, '2025-06-18', 15, 11.00, '2025-06-18 14:20:19', '2025-06-18 14:20:19'),
(652, 28, '2025-06-18', 15, 10.00, '2025-06-18 14:20:19', '2025-06-18 14:20:19'),
(653, 32, '2025-06-18', 20, 11.00, '2025-06-18 14:20:19', '2025-06-18 14:20:19'),
(654, 34, '2025-06-18', 14, 13.00, '2025-06-18 14:20:19', '2025-06-18 14:20:19'),
(655, 35, '2025-06-18', 12, 9.00, '2025-06-18 14:20:19', '2025-06-18 14:20:19'),
(656, 36, '2025-06-18', 20, 12.00, '2025-06-18 14:20:19', '2025-06-18 14:20:19'),
(657, 53, '2025-06-18', 12, 11.00, '2025-06-18 14:20:19', '2025-06-18 14:20:19'),
(658, 54, '2025-06-18', 5, 12.00, '2025-06-18 14:20:19', '2025-06-18 14:20:19'),
(659, 56, '2025-06-18', 20, 8.00, '2025-06-18 14:20:19', '2025-06-18 14:20:19'),
(660, 57, '2025-06-18', 14, 9.00, '2025-06-18 14:20:19', '2025-06-18 14:20:19'),
(661, 58, '2025-06-18', 12, 8.00, '2025-06-18 14:20:19', '2025-06-18 14:20:19'),
(662, 87, '2025-06-18', 8, 19.00, '2025-06-18 14:20:19', '2025-06-18 14:20:19'),
(663, 72, '2025-06-18', 5, 28.00, '2025-06-18 14:20:19', '2025-06-18 14:20:19'),
(664, 74, '2025-06-18', 15, 3.00, '2025-06-18 14:20:19', '2025-06-18 14:20:19'),
(665, 77, '2025-06-18', 20, 3.00, '2025-06-18 14:20:19', '2025-06-18 14:20:19'),
(666, 8, '2025-06-20', 15, 4.68, '2025-06-20 09:00:36', '2025-06-20 09:00:36');
INSERT INTO `planeacion_menu` (`id`, `id_producto`, `fecha_plan`, `stock_diario`, `precio`, `created_at`, `updated_at`) VALUES
(667, 11, '2025-06-20', 15, 6.44, '2025-06-20 09:00:36', '2025-06-20 09:00:36'),
(668, 7, '2025-06-20', 15, 4.10, '2025-06-20 09:00:36', '2025-06-20 09:00:36'),
(669, 2, '2025-06-20', 15, 1.17, '2025-06-20 09:00:36', '2025-06-20 09:00:36'),
(670, 4, '2025-06-20', 15, 2.34, '2025-06-20 09:00:36', '2025-06-20 09:00:36'),
(671, 20, '2025-06-20', 20, 11.70, '2025-06-20 09:00:36', '2025-06-20 09:00:36'),
(672, 27, '2025-06-20', 20, 15.80, '2025-06-20 09:00:36', '2025-06-20 09:00:36'),
(673, 22, '2025-06-20', 20, 12.87, '2025-06-20 09:00:36', '2025-06-20 09:00:36'),
(674, 30, '2025-06-20', 20, 17.55, '2025-06-20 09:00:36', '2025-06-20 09:00:36'),
(675, 36, '2025-06-20', 15, 21.06, '2025-06-20 09:00:36', '2025-06-20 09:00:36'),
(676, 35, '2025-06-20', 15, 20.48, '2025-06-20 09:00:36', '2025-06-20 09:00:36'),
(677, 33, '2025-06-20', 15, 19.31, '2025-06-20 09:00:36', '2025-06-20 09:00:36'),
(678, 31, '2025-06-20', 15, 18.14, '2025-06-20 09:00:36', '2025-06-20 09:00:36'),
(679, 34, '2025-06-20', 15, 19.89, '2025-06-20 09:00:36', '2025-06-20 09:00:36'),
(680, 32, '2025-06-20', 15, 18.72, '2025-06-20 09:00:36', '2025-06-20 09:00:36'),
(681, 58, '2025-06-20', 20, 33.93, '2025-06-20 09:00:36', '2025-06-20 09:00:36'),
(682, 65, '2025-06-20', 20, 38.03, '2025-06-20 09:00:36', '2025-06-20 09:00:36'),
(683, 56, '2025-06-20', 20, 32.76, '2025-06-20 09:00:36', '2025-06-20 09:00:36'),
(684, 39, '2025-06-20', 20, 22.82, '2025-06-20 09:00:36', '2025-06-20 09:00:36'),
(685, 57, '2025-06-20', 20, 33.35, '2025-06-20 09:00:36', '2025-06-20 09:00:36'),
(686, 75, '2025-06-20', 10, 43.88, '2025-06-20 09:00:36', '2025-06-20 09:00:36'),
(687, 79, '2025-06-20', 10, 46.22, '2025-06-20 09:00:36', '2025-06-20 09:00:36'),
(688, 77, '2025-06-20', 10, 45.05, '2025-06-20 09:00:36', '2025-06-20 09:00:36'),
(689, 71, '2025-06-20', 50, 41.54, '2025-06-20 09:00:36', '2025-06-20 09:00:36'),
(690, 72, '2025-06-20', 50, 42.12, '2025-06-20 09:00:36', '2025-06-20 09:00:36'),
(691, 73, '2025-06-20', 50, 42.71, '2025-06-20 09:00:36', '2025-06-20 09:00:36'),
(692, 93, '2025-06-20', 5, 14.00, '2025-06-20 09:26:29', '2025-06-20 09:26:29'),
(693, 98, '2025-06-20', 12, 10.00, '2025-06-20 09:26:37', '2025-06-20 09:26:37'),
(694, 8, '2025-06-21', 15, 4.68, '2025-06-21 23:36:42', '2025-06-21 23:36:42'),
(695, 11, '2025-06-21', 15, 6.44, '2025-06-21 23:36:42', '2025-06-21 23:36:42'),
(696, 7, '2025-06-21', 15, 4.10, '2025-06-21 23:36:42', '2025-06-21 23:36:42'),
(697, 2, '2025-06-21', 15, 1.17, '2025-06-21 23:36:42', '2025-06-21 23:36:42'),
(698, 4, '2025-06-21', 15, 2.34, '2025-06-21 23:36:42', '2025-06-21 23:36:42'),
(699, 20, '2025-06-21', 20, 11.70, '2025-06-21 23:36:42', '2025-06-21 23:36:42'),
(700, 27, '2025-06-21', 20, 15.80, '2025-06-21 23:36:42', '2025-06-21 23:36:42'),
(701, 22, '2025-06-21', 20, 12.87, '2025-06-21 23:36:42', '2025-06-21 23:36:42'),
(702, 30, '2025-06-21', 20, 17.55, '2025-06-21 23:36:42', '2025-06-21 23:36:42'),
(703, 36, '2025-06-21', 15, 21.06, '2025-06-21 23:36:42', '2025-06-21 23:36:42'),
(704, 35, '2025-06-21', 15, 20.48, '2025-06-21 23:36:42', '2025-06-21 23:36:42'),
(705, 33, '2025-06-21', 15, 19.31, '2025-06-21 23:36:42', '2025-06-21 23:36:42'),
(706, 31, '2025-06-21', 15, 18.14, '2025-06-21 23:36:42', '2025-06-21 23:36:42'),
(707, 34, '2025-06-21', 15, 19.89, '2025-06-21 23:36:42', '2025-06-21 23:36:42'),
(708, 32, '2025-06-21', 15, 18.72, '2025-06-21 23:36:42', '2025-06-21 23:36:42'),
(709, 58, '2025-06-21', 20, 33.93, '2025-06-21 23:36:42', '2025-06-21 23:36:42'),
(710, 65, '2025-06-21', 20, 38.03, '2025-06-21 23:36:42', '2025-06-21 23:36:42'),
(711, 56, '2025-06-21', 20, 32.76, '2025-06-21 23:36:42', '2025-06-21 23:36:42'),
(712, 39, '2025-06-21', 20, 22.82, '2025-06-21 23:36:42', '2025-06-21 23:36:42'),
(713, 57, '2025-06-21', 20, 33.35, '2025-06-21 23:36:42', '2025-06-21 23:36:42'),
(714, 75, '2025-06-21', 10, 43.88, '2025-06-21 23:36:42', '2025-06-21 23:36:42'),
(715, 79, '2025-06-21', 10, 46.22, '2025-06-21 23:36:42', '2025-06-21 23:36:42'),
(716, 77, '2025-06-21', 10, 45.05, '2025-06-21 23:36:42', '2025-06-21 23:36:42'),
(717, 71, '2025-06-21', 50, 41.54, '2025-06-21 23:36:42', '2025-06-21 23:36:42'),
(718, 72, '2025-06-21', 50, 42.12, '2025-06-21 23:36:42', '2025-06-21 23:36:42'),
(719, 73, '2025-06-21', 50, 42.71, '2025-06-21 23:36:42', '2025-06-21 23:36:42'),
(720, 93, '2025-06-21', 5, 14.00, '2025-06-21 23:36:42', '2025-06-21 23:36:42'),
(721, 98, '2025-06-21', 12, 10.00, '2025-06-21 23:36:42', '2025-06-21 23:36:42'),
(722, 4, '2025-06-25', 19, 7.00, '2025-06-25 16:51:04', '2025-06-25 16:51:04'),
(723, 5, '2025-06-25', 20, 7.00, '2025-06-25 16:51:04', '2025-06-25 16:51:04'),
(724, 6, '2025-06-25', 19, 9.00, '2025-06-25 16:51:04', '2025-06-25 16:51:04'),
(725, 7, '2025-06-25', 18, 6.00, '2025-06-25 16:51:04', '2025-06-25 16:51:04'),
(726, 9, '2025-06-25', 19, 7.00, '2025-06-25 16:51:04', '2025-06-25 16:51:04'),
(727, 16, '2025-06-25', 18, 9.00, '2025-06-25 16:51:04', '2025-06-25 16:51:04'),
(728, 18, '2025-06-25', 5, 5.00, '2025-06-25 16:51:04', '2025-06-25 16:51:04'),
(729, 19, '2025-06-25', 15, 11.00, '2025-06-25 16:51:04', '2025-06-25 16:51:04'),
(730, 28, '2025-06-25', 15, 10.00, '2025-06-25 16:51:04', '2025-06-25 16:51:04'),
(731, 32, '2025-06-25', 20, 11.00, '2025-06-25 16:51:04', '2025-06-25 16:51:04'),
(732, 34, '2025-06-25', 14, 13.00, '2025-06-25 16:51:04', '2025-06-25 16:51:04'),
(733, 35, '2025-06-25', 12, 9.00, '2025-06-25 16:51:04', '2025-06-25 16:51:04'),
(734, 36, '2025-06-25', 20, 12.00, '2025-06-25 16:51:04', '2025-06-25 16:51:04'),
(735, 53, '2025-06-25', 12, 11.00, '2025-06-25 16:51:04', '2025-06-25 16:51:04'),
(736, 54, '2025-06-25', 5, 12.00, '2025-06-25 16:51:04', '2025-06-25 16:51:04'),
(737, 56, '2025-06-25', 20, 8.00, '2025-06-25 16:51:04', '2025-06-25 16:51:04'),
(738, 57, '2025-06-25', 14, 9.00, '2025-06-25 16:51:04', '2025-06-25 16:51:04'),
(739, 58, '2025-06-25', 12, 8.00, '2025-06-25 16:51:04', '2025-06-25 16:51:04'),
(740, 87, '2025-06-25', 8, 19.00, '2025-06-25 16:51:04', '2025-06-25 16:51:04'),
(741, 72, '2025-06-25', 5, 28.00, '2025-06-25 16:51:04', '2025-06-25 16:51:04'),
(742, 74, '2025-06-25', 15, 3.00, '2025-06-25 16:51:04', '2025-06-25 16:51:04'),
(743, 77, '2025-06-25', 20, 3.00, '2025-06-25 16:51:04', '2025-06-25 16:51:04'),
(744, 4, '2025-06-26', 19, 7.00, '2025-06-25 21:27:38', '2025-06-25 21:27:38'),
(745, 5, '2025-06-26', 20, 7.00, '2025-06-25 21:27:38', '2025-06-25 21:27:38'),
(746, 6, '2025-06-26', 19, 9.00, '2025-06-25 21:27:38', '2025-06-25 21:27:38'),
(747, 7, '2025-06-26', 18, 6.00, '2025-06-25 21:27:38', '2025-06-25 21:27:38'),
(748, 9, '2025-06-26', 19, 7.00, '2025-06-25 21:27:38', '2025-06-25 21:27:38'),
(749, 16, '2025-06-26', 18, 9.00, '2025-06-25 21:27:38', '2025-06-25 21:27:38'),
(750, 18, '2025-06-26', 5, 5.00, '2025-06-25 21:27:38', '2025-06-25 21:27:38'),
(751, 19, '2025-06-26', 15, 11.00, '2025-06-25 21:27:38', '2025-06-25 21:27:38'),
(752, 28, '2025-06-26', 15, 10.00, '2025-06-25 21:27:38', '2025-06-25 21:27:38'),
(753, 32, '2025-06-26', 20, 11.00, '2025-06-25 21:27:38', '2025-06-25 21:27:38'),
(754, 34, '2025-06-26', 14, 13.00, '2025-06-25 21:27:38', '2025-06-25 21:27:38'),
(755, 35, '2025-06-26', 12, 9.00, '2025-06-25 21:27:38', '2025-06-25 21:27:38'),
(756, 36, '2025-06-26', 20, 12.00, '2025-06-25 21:27:38', '2025-06-25 21:27:38'),
(757, 53, '2025-06-26', 12, 11.00, '2025-06-25 21:27:38', '2025-06-25 21:27:38'),
(758, 54, '2025-06-26', 5, 12.00, '2025-06-25 21:27:38', '2025-06-25 21:27:38'),
(759, 56, '2025-06-26', 20, 8.00, '2025-06-25 21:27:38', '2025-06-25 21:27:38'),
(760, 57, '2025-06-26', 14, 9.00, '2025-06-25 21:27:38', '2025-06-25 21:27:38'),
(761, 58, '2025-06-26', 12, 8.00, '2025-06-25 21:27:38', '2025-06-25 21:27:38'),
(762, 87, '2025-06-26', 8, 19.00, '2025-06-25 21:27:38', '2025-06-25 21:27:38'),
(763, 72, '2025-06-26', 5, 28.00, '2025-06-25 21:27:38', '2025-06-25 21:27:38'),
(764, 74, '2025-06-26', 15, 3.00, '2025-06-25 21:27:38', '2025-06-25 21:27:38'),
(765, 77, '2025-06-26', 20, 3.00, '2025-06-25 21:27:38', '2025-06-25 21:27:38'),
(766, 4, '2025-06-30', 19, 7.00, '2025-06-30 09:31:14', '2025-06-30 09:31:14'),
(767, 5, '2025-06-30', 20, 7.00, '2025-06-30 09:31:14', '2025-06-30 09:31:14'),
(768, 6, '2025-06-30', 19, 9.00, '2025-06-30 09:31:14', '2025-06-30 09:31:14'),
(769, 7, '2025-06-30', 18, 6.00, '2025-06-30 09:31:14', '2025-06-30 09:31:14'),
(770, 9, '2025-06-30', 19, 7.00, '2025-06-30 09:31:14', '2025-06-30 09:31:14'),
(771, 16, '2025-06-30', 18, 9.00, '2025-06-30 09:31:14', '2025-06-30 09:31:14'),
(772, 18, '2025-06-30', 5, 5.00, '2025-06-30 09:31:14', '2025-06-30 09:31:14'),
(773, 19, '2025-06-30', 15, 11.00, '2025-06-30 09:31:14', '2025-06-30 09:31:14'),
(774, 28, '2025-06-30', 15, 10.00, '2025-06-30 09:31:14', '2025-06-30 09:31:14'),
(775, 32, '2025-06-30', 20, 11.00, '2025-06-30 09:31:14', '2025-06-30 09:31:14'),
(776, 34, '2025-06-30', 14, 13.00, '2025-06-30 09:31:14', '2025-06-30 09:31:14'),
(777, 35, '2025-06-30', 12, 9.00, '2025-06-30 09:31:14', '2025-06-30 09:31:14'),
(778, 36, '2025-06-30', 20, 12.00, '2025-06-30 09:31:14', '2025-06-30 09:31:14'),
(779, 53, '2025-06-30', 12, 11.00, '2025-06-30 09:31:14', '2025-06-30 09:31:14'),
(780, 54, '2025-06-30', 5, 12.00, '2025-06-30 09:31:14', '2025-06-30 09:31:14'),
(781, 56, '2025-06-30', 20, 8.00, '2025-06-30 09:31:14', '2025-06-30 09:31:14'),
(782, 57, '2025-06-30', 14, 9.00, '2025-06-30 09:31:14', '2025-06-30 09:31:14'),
(783, 58, '2025-06-30', 12, 8.00, '2025-06-30 09:31:14', '2025-06-30 09:31:14'),
(784, 87, '2025-06-30', 8, 19.00, '2025-06-30 09:31:14', '2025-06-30 09:31:14'),
(785, 72, '2025-06-30', 5, 28.00, '2025-06-30 09:31:14', '2025-06-30 09:31:14'),
(786, 74, '2025-06-30', 15, 3.00, '2025-06-30 09:31:14', '2025-06-30 09:31:14'),
(787, 77, '2025-06-30', 20, 3.00, '2025-06-30 09:31:14', '2025-06-30 09:31:14'),
(788, 4, '2025-07-02', 19, 7.00, '2025-07-02 16:42:26', '2025-07-02 16:42:26'),
(789, 5, '2025-07-02', 20, 7.00, '2025-07-02 16:42:26', '2025-07-02 16:42:26'),
(790, 6, '2025-07-02', 19, 9.00, '2025-07-02 16:42:26', '2025-07-02 16:42:26'),
(791, 7, '2025-07-02', 18, 6.00, '2025-07-02 16:42:26', '2025-07-02 16:42:26'),
(792, 9, '2025-07-02', 19, 7.00, '2025-07-02 16:42:26', '2025-07-02 16:42:26'),
(793, 16, '2025-07-02', 18, 9.00, '2025-07-02 16:42:26', '2025-07-02 16:42:26'),
(794, 18, '2025-07-02', 5, 5.00, '2025-07-02 16:42:26', '2025-07-02 16:42:26'),
(795, 19, '2025-07-02', 15, 11.00, '2025-07-02 16:42:26', '2025-07-02 16:42:26'),
(796, 28, '2025-07-02', 15, 10.00, '2025-07-02 16:42:26', '2025-07-02 16:42:26'),
(797, 32, '2025-07-02', 20, 11.00, '2025-07-02 16:42:26', '2025-07-02 16:42:26'),
(798, 34, '2025-07-02', 14, 13.00, '2025-07-02 16:42:26', '2025-07-02 16:42:26'),
(799, 35, '2025-07-02', 12, 9.00, '2025-07-02 16:42:26', '2025-07-02 16:42:26'),
(800, 36, '2025-07-02', 20, 12.00, '2025-07-02 16:42:26', '2025-07-02 16:42:26'),
(801, 53, '2025-07-02', 12, 11.00, '2025-07-02 16:42:26', '2025-07-02 16:42:26'),
(802, 54, '2025-07-02', 5, 12.00, '2025-07-02 16:42:26', '2025-07-02 16:42:26'),
(803, 56, '2025-07-02', 20, 8.00, '2025-07-02 16:42:26', '2025-07-02 16:42:26'),
(804, 57, '2025-07-02', 14, 9.00, '2025-07-02 16:42:26', '2025-07-02 16:42:26'),
(805, 58, '2025-07-02', 12, 8.00, '2025-07-02 16:42:26', '2025-07-02 16:42:26'),
(806, 87, '2025-07-02', 8, 19.00, '2025-07-02 16:42:26', '2025-07-02 16:42:26'),
(807, 72, '2025-07-02', 5, 28.00, '2025-07-02 16:42:26', '2025-07-02 16:42:26'),
(808, 74, '2025-07-02', 15, 3.00, '2025-07-02 16:42:26', '2025-07-02 16:42:26'),
(809, 77, '2025-07-02', 20, 3.00, '2025-07-02 16:42:26', '2025-07-02 16:42:26'),
(810, 4, '2025-07-08', 19, 7.00, '2025-07-08 14:05:05', '2025-07-08 14:05:05'),
(811, 5, '2025-07-08', 20, 7.00, '2025-07-08 14:05:05', '2025-07-08 14:05:05'),
(812, 6, '2025-07-08', 19, 9.00, '2025-07-08 14:05:05', '2025-07-08 14:05:05'),
(813, 7, '2025-07-08', 18, 6.00, '2025-07-08 14:05:05', '2025-07-08 14:05:05'),
(814, 9, '2025-07-08', 19, 7.00, '2025-07-08 14:05:05', '2025-07-08 14:05:05'),
(815, 16, '2025-07-08', 18, 9.00, '2025-07-08 14:05:05', '2025-07-08 14:05:05'),
(816, 18, '2025-07-08', 5, 5.00, '2025-07-08 14:05:05', '2025-07-08 14:05:05'),
(817, 19, '2025-07-08', 15, 11.00, '2025-07-08 14:05:05', '2025-07-08 14:05:05'),
(818, 28, '2025-07-08', 15, 10.00, '2025-07-08 14:05:05', '2025-07-08 14:05:05'),
(819, 32, '2025-07-08', 20, 11.00, '2025-07-08 14:05:05', '2025-07-08 14:05:05'),
(820, 34, '2025-07-08', 14, 13.00, '2025-07-08 14:05:05', '2025-07-08 14:05:05'),
(821, 35, '2025-07-08', 12, 9.00, '2025-07-08 14:05:05', '2025-07-08 14:05:05'),
(822, 36, '2025-07-08', 20, 12.00, '2025-07-08 14:05:05', '2025-07-08 14:05:05'),
(823, 53, '2025-07-08', 12, 11.00, '2025-07-08 14:05:05', '2025-07-08 14:05:05'),
(824, 54, '2025-07-08', 5, 12.00, '2025-07-08 14:05:05', '2025-07-08 14:05:05'),
(825, 56, '2025-07-08', 20, 8.00, '2025-07-08 14:05:05', '2025-07-08 14:05:05'),
(826, 57, '2025-07-08', 14, 9.00, '2025-07-08 14:05:05', '2025-07-08 14:05:05'),
(827, 58, '2025-07-08', 12, 8.00, '2025-07-08 14:05:05', '2025-07-08 14:05:05'),
(828, 87, '2025-07-08', 8, 19.00, '2025-07-08 14:05:05', '2025-07-08 14:05:05'),
(829, 72, '2025-07-08', 5, 28.00, '2025-07-08 14:05:05', '2025-07-08 14:05:05'),
(830, 74, '2025-07-08', 15, 3.00, '2025-07-08 14:05:05', '2025-07-08 14:05:05'),
(831, 77, '2025-07-08', 20, 3.00, '2025-07-08 14:05:05', '2025-07-08 14:05:05'),
(851, 4, '2025-07-09', 19, 7.00, '2025-07-09 18:20:35', '2025-07-09 18:20:35'),
(852, 5, '2025-07-09', 20, 7.00, '2025-07-09 18:20:35', '2025-07-09 18:20:35'),
(853, 6, '2025-07-09', 19, 9.00, '2025-07-09 18:20:35', '2025-07-09 18:20:35'),
(854, 7, '2025-07-09', 18, 6.00, '2025-07-09 18:20:35', '2025-07-09 18:20:35'),
(855, 9, '2025-07-09', 19, 7.00, '2025-07-09 18:20:35', '2025-07-09 18:20:35'),
(856, 16, '2025-07-09', 18, 9.00, '2025-07-09 18:20:35', '2025-07-09 18:20:35'),
(857, 18, '2025-07-09', 5, 5.00, '2025-07-09 18:20:35', '2025-07-09 18:20:35'),
(858, 19, '2025-07-09', 15, 11.00, '2025-07-09 18:20:35', '2025-07-09 18:20:35'),
(859, 28, '2025-07-09', 15, 10.00, '2025-07-09 18:20:35', '2025-07-09 18:20:35'),
(860, 32, '2025-07-09', 20, 11.00, '2025-07-09 18:20:35', '2025-07-09 18:20:35'),
(861, 34, '2025-07-09', 14, 13.00, '2025-07-09 18:20:35', '2025-07-09 18:20:35'),
(862, 35, '2025-07-09', 12, 9.00, '2025-07-09 18:20:35', '2025-07-09 18:20:35'),
(863, 36, '2025-07-09', 20, 12.00, '2025-07-09 18:20:35', '2025-07-09 18:20:35'),
(864, 53, '2025-07-09', 12, 11.00, '2025-07-09 18:20:35', '2025-07-09 18:20:35'),
(865, 54, '2025-07-09', 5, 12.00, '2025-07-09 18:20:35', '2025-07-09 18:20:35'),
(866, 56, '2025-07-09', 20, 8.00, '2025-07-09 18:20:35', '2025-07-09 18:20:35'),
(867, 57, '2025-07-09', 14, 9.00, '2025-07-09 18:20:35', '2025-07-09 18:20:35'),
(868, 58, '2025-07-09', 12, 8.00, '2025-07-09 18:20:35', '2025-07-09 18:20:35'),
(873, 4, '2025-07-10', 19, 7.00, '2025-07-09 20:15:31', '2025-07-09 20:15:31'),
(886, 53, '2025-07-10', 12, 11.00, '2025-07-09 20:15:31', '2025-07-09 20:15:31'),
(887, 54, '2025-07-10', 5, 12.00, '2025-07-09 20:15:31', '2025-07-09 20:15:31'),
(888, 56, '2025-07-10', 20, 8.00, '2025-07-09 20:15:31', '2025-07-09 20:15:31'),
(889, 57, '2025-07-10', 14, 9.00, '2025-07-09 20:15:31', '2025-07-09 20:15:31'),
(890, 58, '2025-07-10', 12, 8.00, '2025-07-09 20:15:31', '2025-07-09 20:15:31'),
(891, 117, '2025-07-10', 20, 15.00, '2025-07-09 20:16:38', '2025-07-09 20:16:38'),
(892, 11, '2025-07-10', 20, 15.00, '2025-07-09 20:17:05', '2025-07-09 20:17:05'),
(893, 130, '2025-07-10', 30, 15.00, '2025-07-09 20:17:34', '2025-07-09 20:17:34'),
(894, 132, '2025-07-10', 20, 15.00, '2025-07-09 20:17:53', '2025-07-09 20:17:53'),
(895, 133, '2025-07-10', 20, 15.00, '2025-07-09 20:18:11', '2025-07-09 20:18:11'),
(896, 191, '2025-07-10', 10, 20.00, '2025-07-09 20:18:48', '2025-07-09 20:18:48'),
(897, 196, '2025-07-10', 15, 20.00, '2025-07-09 20:19:15', '2025-07-09 20:19:15'),
(898, 195, '2025-07-10', 20, 20.00, '2025-07-09 20:19:30', '2025-07-09 20:19:30'),
(899, 162, '2025-07-10', 20, 15.00, '2025-07-09 20:19:57', '2025-07-09 20:19:57'),
(900, 153, '2025-07-10', 20, 15.00, '2025-07-09 20:20:10', '2025-07-09 20:20:10'),
(901, 46, '2025-07-10', 20, 15.00, '2025-07-09 20:20:38', '2025-07-09 20:20:38'),
(902, 4, '2025-07-12', 19, 7.00, '2025-07-12 16:33:08', '2025-07-12 16:33:08'),
(903, 5, '2025-07-12', 20, 7.00, '2025-07-12 16:33:08', '2025-07-12 16:33:08'),
(904, 6, '2025-07-12', 19, 9.00, '2025-07-12 16:33:08', '2025-07-12 16:33:08'),
(905, 7, '2025-07-12', 18, 6.00, '2025-07-12 16:33:08', '2025-07-12 16:33:08'),
(906, 9, '2025-07-12', 19, 7.00, '2025-07-12 16:33:08', '2025-07-12 16:33:08'),
(907, 16, '2025-07-12', 18, 9.00, '2025-07-12 16:33:08', '2025-07-12 16:33:08'),
(908, 18, '2025-07-12', 5, 5.00, '2025-07-12 16:33:08', '2025-07-12 16:33:08'),
(909, 19, '2025-07-12', 15, 11.00, '2025-07-12 16:33:08', '2025-07-12 16:33:08'),
(910, 28, '2025-07-12', 15, 10.00, '2025-07-12 16:33:08', '2025-07-12 16:33:08'),
(911, 32, '2025-07-12', 20, 11.00, '2025-07-12 16:33:08', '2025-07-12 16:33:08'),
(912, 34, '2025-07-12', 14, 13.00, '2025-07-12 16:33:08', '2025-07-12 16:33:08'),
(913, 35, '2025-07-12', 12, 9.00, '2025-07-12 16:33:08', '2025-07-12 16:33:08'),
(914, 36, '2025-07-12', 20, 12.00, '2025-07-12 16:33:08', '2025-07-12 16:33:08'),
(915, 53, '2025-07-12', 12, 11.00, '2025-07-12 16:33:08', '2025-07-12 16:33:08'),
(916, 54, '2025-07-12', 5, 12.00, '2025-07-12 16:33:08', '2025-07-12 16:33:08'),
(917, 56, '2025-07-12', 20, 8.00, '2025-07-12 16:33:08', '2025-07-12 16:33:08'),
(918, 57, '2025-07-12', 14, 9.00, '2025-07-12 16:33:08', '2025-07-12 16:33:08'),
(919, 58, '2025-07-12', 12, 8.00, '2025-07-12 16:33:08', '2025-07-12 16:33:08'),
(920, 87, '2025-07-12', 8, 19.00, '2025-07-12 16:33:08', '2025-07-12 16:33:08'),
(921, 72, '2025-07-12', 5, 28.00, '2025-07-12 16:33:08', '2025-07-12 16:33:08'),
(922, 74, '2025-07-12', 15, 3.00, '2025-07-12 16:33:08', '2025-07-12 16:33:08'),
(923, 77, '2025-07-12', 20, 3.00, '2025-07-12 16:33:08', '2025-07-12 16:33:08'),
(924, 4, '2025-07-13', 19, 7.00, '2025-07-13 05:48:33', '2025-07-13 05:48:33'),
(925, 5, '2025-07-13', 20, 7.00, '2025-07-13 05:48:33', '2025-07-13 05:48:33'),
(926, 6, '2025-07-13', 19, 9.00, '2025-07-13 05:48:33', '2025-07-13 05:48:33'),
(927, 7, '2025-07-13', 18, 6.00, '2025-07-13 05:48:33', '2025-07-13 05:48:33'),
(928, 9, '2025-07-13', 19, 7.00, '2025-07-13 05:48:33', '2025-07-13 05:48:33'),
(929, 16, '2025-07-13', 18, 9.00, '2025-07-13 05:48:33', '2025-07-13 05:48:33'),
(930, 18, '2025-07-13', 5, 5.00, '2025-07-13 05:48:33', '2025-07-13 05:48:33'),
(931, 19, '2025-07-13', 15, 11.00, '2025-07-13 05:48:33', '2025-07-13 05:48:33'),
(932, 28, '2025-07-13', 15, 10.00, '2025-07-13 05:48:33', '2025-07-13 05:48:33'),
(933, 32, '2025-07-13', 20, 11.00, '2025-07-13 05:48:33', '2025-07-13 05:48:33'),
(934, 34, '2025-07-13', 14, 13.00, '2025-07-13 05:48:33', '2025-07-13 05:48:33'),
(935, 35, '2025-07-13', 12, 9.00, '2025-07-13 05:48:33', '2025-07-13 05:48:33'),
(936, 36, '2025-07-13', 20, 12.00, '2025-07-13 05:48:33', '2025-07-13 05:48:33'),
(937, 53, '2025-07-13', 12, 11.00, '2025-07-13 05:48:33', '2025-07-13 05:48:33'),
(938, 54, '2025-07-13', 5, 12.00, '2025-07-13 05:48:33', '2025-07-13 05:48:33'),
(939, 56, '2025-07-13', 20, 8.00, '2025-07-13 05:48:33', '2025-07-13 05:48:33'),
(940, 57, '2025-07-13', 14, 9.00, '2025-07-13 05:48:33', '2025-07-13 05:48:33'),
(941, 58, '2025-07-13', 12, 8.00, '2025-07-13 05:48:33', '2025-07-13 05:48:33'),
(942, 4, '2025-07-14', 19, 7.00, '2025-07-14 14:35:58', '2025-07-14 14:35:58'),
(943, 53, '2025-07-14', 12, 11.00, '2025-07-14 14:35:58', '2025-07-14 14:35:58'),
(944, 54, '2025-07-14', 5, 12.00, '2025-07-14 14:35:58', '2025-07-14 14:35:58'),
(945, 56, '2025-07-14', 20, 8.00, '2025-07-14 14:35:58', '2025-07-14 14:35:58'),
(946, 57, '2025-07-14', 14, 9.00, '2025-07-14 14:35:58', '2025-07-14 14:35:58'),
(947, 58, '2025-07-14', 12, 8.00, '2025-07-14 14:35:58', '2025-07-14 14:35:58'),
(948, 117, '2025-07-14', 20, 15.00, '2025-07-14 14:35:58', '2025-07-14 14:35:58'),
(949, 11, '2025-07-14', 20, 15.00, '2025-07-14 14:35:58', '2025-07-14 14:35:58'),
(950, 130, '2025-07-14', 30, 15.00, '2025-07-14 14:35:58', '2025-07-14 14:35:58'),
(951, 132, '2025-07-14', 20, 15.00, '2025-07-14 14:35:58', '2025-07-14 14:35:58'),
(952, 133, '2025-07-14', 20, 15.00, '2025-07-14 14:35:58', '2025-07-14 14:35:58'),
(953, 191, '2025-07-14', 10, 20.00, '2025-07-14 14:35:58', '2025-07-14 14:35:58'),
(954, 196, '2025-07-14', 15, 20.00, '2025-07-14 14:35:58', '2025-07-14 14:35:58'),
(955, 195, '2025-07-14', 20, 20.00, '2025-07-14 14:35:58', '2025-07-14 14:35:58'),
(956, 162, '2025-07-14', 20, 15.00, '2025-07-14 14:35:58', '2025-07-14 14:35:58'),
(957, 153, '2025-07-14', 20, 15.00, '2025-07-14 14:35:58', '2025-07-14 14:35:58'),
(958, 46, '2025-07-14', 20, 15.00, '2025-07-14 14:35:58', '2025-07-14 14:35:58'),
(959, 4, '2025-07-16', 19, 7.00, '2025-07-16 16:19:29', '2025-07-16 16:19:29'),
(960, 5, '2025-07-16', 20, 7.00, '2025-07-16 16:19:29', '2025-07-16 16:19:29'),
(961, 6, '2025-07-16', 19, 9.00, '2025-07-16 16:19:29', '2025-07-16 16:19:29'),
(962, 7, '2025-07-16', 18, 6.00, '2025-07-16 16:19:29', '2025-07-16 16:19:29'),
(963, 9, '2025-07-16', 19, 7.00, '2025-07-16 16:19:29', '2025-07-16 16:19:29'),
(964, 16, '2025-07-16', 18, 9.00, '2025-07-16 16:19:29', '2025-07-16 16:19:29'),
(965, 18, '2025-07-16', 5, 5.00, '2025-07-16 16:19:29', '2025-07-16 16:19:29'),
(966, 19, '2025-07-16', 15, 11.00, '2025-07-16 16:19:29', '2025-07-16 16:19:29'),
(967, 28, '2025-07-16', 15, 10.00, '2025-07-16 16:19:29', '2025-07-16 16:19:29'),
(968, 32, '2025-07-16', 20, 11.00, '2025-07-16 16:19:29', '2025-07-16 16:19:29'),
(969, 34, '2025-07-16', 14, 13.00, '2025-07-16 16:19:29', '2025-07-16 16:19:29'),
(970, 35, '2025-07-16', 12, 9.00, '2025-07-16 16:19:29', '2025-07-16 16:19:29'),
(971, 36, '2025-07-16', 20, 12.00, '2025-07-16 16:19:29', '2025-07-16 16:19:29'),
(972, 53, '2025-07-16', 12, 11.00, '2025-07-16 16:19:29', '2025-07-16 16:19:29'),
(973, 54, '2025-07-16', 5, 12.00, '2025-07-16 16:19:29', '2025-07-16 16:19:29'),
(974, 56, '2025-07-16', 20, 8.00, '2025-07-16 16:19:29', '2025-07-16 16:19:29'),
(975, 57, '2025-07-16', 14, 9.00, '2025-07-16 16:19:29', '2025-07-16 16:19:29'),
(976, 58, '2025-07-16', 12, 8.00, '2025-07-16 16:19:29', '2025-07-16 16:19:29'),
(977, 87, '2025-07-16', 8, 19.00, '2025-07-16 16:19:29', '2025-07-16 16:19:29'),
(978, 72, '2025-07-16', 5, 28.00, '2025-07-16 16:19:29', '2025-07-16 16:19:29'),
(979, 74, '2025-07-16', 15, 3.00, '2025-07-16 16:19:29', '2025-07-16 16:19:29'),
(980, 77, '2025-07-16', 20, 3.00, '2025-07-16 16:19:29', '2025-07-16 16:19:29'),
(981, 109, '2025-07-16', 33, 13.00, '2025-07-16 16:19:46', '2025-07-16 16:19:46'),
(982, 103, '2025-07-16', 3, 12.00, '2025-07-16 16:19:46', '2025-07-16 16:19:46'),
(996, 4, '2025-07-17', 19, 7.00, '2025-07-17 16:40:47', '2025-07-17 16:40:47'),
(997, 5, '2025-07-17', 20, 7.00, '2025-07-17 16:40:47', '2025-07-17 16:40:47'),
(1016, 74, '2025-07-17', 15, 3.00, '2025-07-17 16:40:47', '2025-07-17 16:40:47'),
(1017, 77, '2025-07-17', 20, 3.00, '2025-07-17 16:40:47', '2025-07-17 16:40:47'),
(1018, 103, '2025-07-17', 11, 12.00, '2025-07-17 16:41:31', '2025-07-17 16:41:31'),
(1019, 108, '2025-07-17', 11, 16.00, '2025-07-17 16:41:33', '2025-07-17 16:41:33'),
(1020, 92, '2025-07-17', 11, 11.00, '2025-07-17 16:41:48', '2025-07-17 16:41:48'),
(1021, 93, '2025-07-17', 11, 11.00, '2025-07-17 16:41:50', '2025-07-17 16:41:50'),
(1025, 100, '2025-07-17', 11, 14.00, '2025-07-17 16:42:30', '2025-07-17 16:42:30'),
(1027, 89, '2025-07-17', 11, 11.00, '2025-07-17 16:44:36', '2025-07-17 16:44:36'),
(1028, 71, '2025-07-17', 11, 60.00, '2025-07-17 16:44:39', '2025-07-17 16:44:39'),
(1030, 119, '2025-07-17', 10, 7.00, '2025-07-17 17:45:07', '2025-07-17 17:45:07'),
(1031, 133, '2025-07-17', 10, 7.00, '2025-07-17 17:45:24', '2025-07-17 17:45:24'),
(1032, 191, '2025-07-17', 10, 20.00, '2025-07-17 17:46:27', '2025-07-17 17:46:27'),
(1033, 195, '2025-07-17', 10, 20.00, '2025-07-17 17:46:52', '2025-07-17 17:46:52'),
(1034, 47, '2025-07-17', 10, 11.00, '2025-07-17 17:50:40', '2025-07-17 17:50:40'),
(1035, 177, '2025-07-17', 10, 12.00, '2025-07-17 17:51:17', '2025-07-17 17:51:17'),
(1036, 42, '2025-07-17', 10, 12.00, '2025-07-17 17:51:57', '2025-07-17 17:51:57'),
(1037, 50, '2025-07-17', 15, 12.00, '2025-07-17 17:52:14', '2025-07-17 17:52:14'),
(1038, 67, '2025-07-17', 5, 27.90, '2025-07-17 17:53:17', '2025-07-17 17:53:17'),
(1039, 51, '2025-07-17', 10, 27.90, '2025-07-17 17:53:39', '2025-07-17 17:53:39'),
(1040, 197, '2025-07-17', 10, 27.90, '2025-07-17 17:54:26', '2025-07-17 17:54:26'),
(1041, 4, '2025-07-18', 19, 7.00, '2025-07-18 15:44:50', '2025-07-18 15:44:50'),
(1042, 53, '2025-07-18', 12, 11.00, '2025-07-18 15:44:50', '2025-07-18 15:44:50'),
(1043, 54, '2025-07-18', 5, 12.00, '2025-07-18 15:44:50', '2025-07-18 15:44:50'),
(1044, 56, '2025-07-18', 20, 8.00, '2025-07-18 15:44:50', '2025-07-18 15:44:50'),
(1045, 57, '2025-07-18', 14, 9.00, '2025-07-18 15:44:50', '2025-07-18 15:44:50'),
(1046, 58, '2025-07-18', 12, 8.00, '2025-07-18 15:44:50', '2025-07-18 15:44:50'),
(1047, 117, '2025-07-18', 20, 15.00, '2025-07-18 15:44:50', '2025-07-18 15:44:50'),
(1048, 11, '2025-07-18', 20, 15.00, '2025-07-18 15:44:50', '2025-07-18 15:44:50'),
(1049, 130, '2025-07-18', 30, 15.00, '2025-07-18 15:44:50', '2025-07-18 15:44:50'),
(1050, 132, '2025-07-18', 20, 15.00, '2025-07-18 15:44:50', '2025-07-18 15:44:50'),
(1051, 133, '2025-07-18', 20, 15.00, '2025-07-18 15:44:50', '2025-07-18 15:44:50'),
(1052, 191, '2025-07-18', 10, 20.00, '2025-07-18 15:44:50', '2025-07-18 15:44:50'),
(1053, 196, '2025-07-18', 15, 20.00, '2025-07-18 15:44:50', '2025-07-18 15:44:50'),
(1054, 195, '2025-07-18', 20, 20.00, '2025-07-18 15:44:50', '2025-07-18 15:44:50'),
(1055, 162, '2025-07-18', 20, 15.00, '2025-07-18 15:44:50', '2025-07-18 15:44:50'),
(1056, 153, '2025-07-18', 20, 15.00, '2025-07-18 15:44:50', '2025-07-18 15:44:50'),
(1057, 46, '2025-07-18', 20, 15.00, '2025-07-18 15:44:50', '2025-07-18 15:44:50'),
(1058, 4, '2025-07-21', 19, 7.00, '2025-07-21 17:42:44', '2025-07-21 17:42:44'),
(1059, 5, '2025-07-21', 20, 7.00, '2025-07-21 17:42:44', '2025-07-21 17:42:44'),
(1060, 6, '2025-07-21', 19, 9.00, '2025-07-21 17:42:44', '2025-07-21 17:42:44'),
(1061, 7, '2025-07-21', 18, 6.00, '2025-07-21 17:42:44', '2025-07-21 17:42:44'),
(1062, 9, '2025-07-21', 19, 7.00, '2025-07-21 17:42:44', '2025-07-21 17:42:44'),
(1063, 16, '2025-07-21', 18, 9.00, '2025-07-21 17:42:44', '2025-07-21 17:42:44'),
(1064, 18, '2025-07-21', 5, 5.00, '2025-07-21 17:42:44', '2025-07-21 17:42:44'),
(1065, 19, '2025-07-21', 15, 11.00, '2025-07-21 17:42:44', '2025-07-21 17:42:44'),
(1066, 28, '2025-07-21', 15, 10.00, '2025-07-21 17:42:44', '2025-07-21 17:42:44'),
(1067, 32, '2025-07-21', 20, 11.00, '2025-07-21 17:42:44', '2025-07-21 17:42:44'),
(1068, 34, '2025-07-21', 14, 13.00, '2025-07-21 17:42:44', '2025-07-21 17:42:44'),
(1069, 35, '2025-07-21', 12, 9.00, '2025-07-21 17:42:44', '2025-07-21 17:42:44'),
(1070, 36, '2025-07-21', 20, 12.00, '2025-07-21 17:42:44', '2025-07-21 17:42:44'),
(1071, 53, '2025-07-21', 12, 11.00, '2025-07-21 17:42:44', '2025-07-21 17:42:44'),
(1072, 54, '2025-07-21', 5, 12.00, '2025-07-21 17:42:44', '2025-07-21 17:42:44'),
(1073, 56, '2025-07-21', 20, 8.00, '2025-07-21 17:42:44', '2025-07-21 17:42:44'),
(1074, 57, '2025-07-21', 14, 9.00, '2025-07-21 17:42:44', '2025-07-21 17:42:44'),
(1075, 58, '2025-07-21', 12, 8.00, '2025-07-21 17:42:44', '2025-07-21 17:42:44'),
(1076, 87, '2025-07-21', 8, 19.00, '2025-07-21 17:42:44', '2025-07-21 17:42:44'),
(1077, 72, '2025-07-21', 5, 28.00, '2025-07-21 17:42:44', '2025-07-21 17:42:44'),
(1078, 74, '2025-07-21', 15, 3.00, '2025-07-21 17:42:44', '2025-07-21 17:42:44'),
(1079, 77, '2025-07-21', 20, 3.00, '2025-07-21 17:42:44', '2025-07-21 17:42:44'),
(1080, 4, '2025-07-22', 19, 7.00, '2025-07-22 21:04:14', '2025-07-22 21:04:14'),
(1081, 5, '2025-07-22', 20, 7.00, '2025-07-22 21:04:14', '2025-07-22 21:04:14'),
(1082, 6, '2025-07-22', 19, 9.00, '2025-07-22 21:04:14', '2025-07-22 21:04:14'),
(1083, 7, '2025-07-22', 18, 6.00, '2025-07-22 21:04:14', '2025-07-22 21:04:14'),
(1084, 9, '2025-07-22', 19, 7.00, '2025-07-22 21:04:14', '2025-07-22 21:04:14'),
(1085, 16, '2025-07-22', 18, 9.00, '2025-07-22 21:04:14', '2025-07-22 21:04:14'),
(1086, 18, '2025-07-22', 5, 5.00, '2025-07-22 21:04:14', '2025-07-22 21:04:14'),
(1087, 19, '2025-07-22', 15, 11.00, '2025-07-22 21:04:14', '2025-07-22 21:04:14'),
(1088, 28, '2025-07-22', 15, 10.00, '2025-07-22 21:04:14', '2025-07-22 21:04:14'),
(1089, 32, '2025-07-22', 20, 11.00, '2025-07-22 21:04:14', '2025-07-22 21:04:14'),
(1090, 34, '2025-07-22', 14, 13.00, '2025-07-22 21:04:14', '2025-07-22 21:04:14'),
(1091, 35, '2025-07-22', 12, 9.00, '2025-07-22 21:04:14', '2025-07-22 21:04:14'),
(1092, 36, '2025-07-22', 20, 12.00, '2025-07-22 21:04:14', '2025-07-22 21:04:14'),
(1093, 53, '2025-07-22', 12, 11.00, '2025-07-22 21:04:14', '2025-07-22 21:04:14'),
(1094, 54, '2025-07-22', 5, 12.00, '2025-07-22 21:04:14', '2025-07-22 21:04:14'),
(1095, 56, '2025-07-22', 20, 8.00, '2025-07-22 21:04:14', '2025-07-22 21:04:14'),
(1096, 57, '2025-07-22', 14, 9.00, '2025-07-22 21:04:14', '2025-07-22 21:04:14'),
(1097, 58, '2025-07-22', 12, 8.00, '2025-07-22 21:04:14', '2025-07-22 21:04:14'),
(1098, 87, '2025-07-22', 8, 19.00, '2025-07-22 21:04:14', '2025-07-22 21:04:14'),
(1099, 72, '2025-07-22', 5, 28.00, '2025-07-22 21:04:14', '2025-07-22 21:04:14'),
(1100, 74, '2025-07-22', 15, 3.00, '2025-07-22 21:04:14', '2025-07-22 21:04:14'),
(1101, 77, '2025-07-22', 20, 3.00, '2025-07-22 21:04:14', '2025-07-22 21:04:14'),
(1102, 4, '2025-07-25', 19, 7.00, '2025-07-25 18:55:11', '2025-07-25 18:55:11'),
(1103, 5, '2025-07-25', 20, 7.00, '2025-07-25 18:55:11', '2025-07-25 18:55:11'),
(1104, 6, '2025-07-25', 19, 9.00, '2025-07-25 18:55:11', '2025-07-25 18:55:11'),
(1105, 7, '2025-07-25', 18, 6.00, '2025-07-25 18:55:11', '2025-07-25 18:55:11'),
(1106, 9, '2025-07-25', 19, 7.00, '2025-07-25 18:55:11', '2025-07-25 18:55:11'),
(1107, 16, '2025-07-25', 18, 9.00, '2025-07-25 18:55:11', '2025-07-25 18:55:11'),
(1108, 18, '2025-07-25', 5, 5.00, '2025-07-25 18:55:11', '2025-07-25 18:55:11'),
(1109, 19, '2025-07-25', 15, 11.00, '2025-07-25 18:55:11', '2025-07-25 18:55:11'),
(1110, 28, '2025-07-25', 15, 10.00, '2025-07-25 18:55:11', '2025-07-25 18:55:11'),
(1111, 32, '2025-07-25', 20, 11.00, '2025-07-25 18:55:11', '2025-07-25 18:55:11'),
(1112, 34, '2025-07-25', 14, 13.00, '2025-07-25 18:55:11', '2025-07-25 18:55:11'),
(1113, 35, '2025-07-25', 12, 9.00, '2025-07-25 18:55:11', '2025-07-25 18:55:11'),
(1114, 36, '2025-07-25', 20, 12.00, '2025-07-25 18:55:11', '2025-07-25 18:55:11'),
(1115, 53, '2025-07-25', 12, 11.00, '2025-07-25 18:55:11', '2025-07-25 18:55:11'),
(1116, 54, '2025-07-25', 5, 12.00, '2025-07-25 18:55:11', '2025-07-25 18:55:11'),
(1117, 56, '2025-07-25', 20, 8.00, '2025-07-25 18:55:11', '2025-07-25 18:55:11'),
(1118, 57, '2025-07-25', 14, 9.00, '2025-07-25 18:55:11', '2025-07-25 18:55:11'),
(1119, 58, '2025-07-25', 12, 8.00, '2025-07-25 18:55:11', '2025-07-25 18:55:11'),
(1120, 87, '2025-07-25', 8, 19.00, '2025-07-25 18:55:11', '2025-07-25 18:55:11'),
(1121, 72, '2025-07-25', 5, 28.00, '2025-07-25 18:55:11', '2025-07-25 18:55:11'),
(1122, 74, '2025-07-25', 15, 3.00, '2025-07-25 18:55:11', '2025-07-25 18:55:11'),
(1123, 77, '2025-07-25', 20, 3.00, '2025-07-25 18:55:11', '2025-07-25 18:55:11'),
(1124, 109, '2025-07-25', 33, 13.00, '2025-07-25 18:55:11', '2025-07-25 18:55:11'),
(1125, 103, '2025-07-25', 3, 12.00, '2025-07-25 18:55:11', '2025-07-25 18:55:11'),
(1126, 4, '2025-07-26', 19, 7.00, '2025-07-26 15:43:11', '2025-07-26 15:43:11'),
(1127, 53, '2025-07-26', 12, 11.00, '2025-07-26 15:43:11', '2025-07-26 15:43:11'),
(1128, 54, '2025-07-26', 5, 12.00, '2025-07-26 15:43:11', '2025-07-26 15:43:11'),
(1129, 56, '2025-07-26', 20, 8.00, '2025-07-26 15:43:11', '2025-07-26 15:43:11'),
(1130, 57, '2025-07-26', 14, 9.00, '2025-07-26 15:43:11', '2025-07-26 15:43:11'),
(1131, 58, '2025-07-26', 12, 8.00, '2025-07-26 15:43:11', '2025-07-26 15:43:11'),
(1132, 117, '2025-07-26', 20, 15.00, '2025-07-26 15:43:11', '2025-07-26 15:43:11'),
(1133, 11, '2025-07-26', 20, 15.00, '2025-07-26 15:43:11', '2025-07-26 15:43:11'),
(1134, 130, '2025-07-26', 30, 15.00, '2025-07-26 15:43:11', '2025-07-26 15:43:11'),
(1135, 132, '2025-07-26', 20, 15.00, '2025-07-26 15:43:11', '2025-07-26 15:43:11'),
(1136, 133, '2025-07-26', 20, 15.00, '2025-07-26 15:43:11', '2025-07-26 15:43:11'),
(1137, 191, '2025-07-26', 10, 20.00, '2025-07-26 15:43:11', '2025-07-26 15:43:11'),
(1138, 196, '2025-07-26', 15, 20.00, '2025-07-26 15:43:11', '2025-07-26 15:43:11'),
(1139, 195, '2025-07-26', 20, 20.00, '2025-07-26 15:43:11', '2025-07-26 15:43:11'),
(1140, 162, '2025-07-26', 20, 15.00, '2025-07-26 15:43:11', '2025-07-26 15:43:11'),
(1141, 153, '2025-07-26', 20, 15.00, '2025-07-26 15:43:11', '2025-07-26 15:43:11'),
(1142, 46, '2025-07-26', 20, 15.00, '2025-07-26 15:43:11', '2025-07-26 15:43:11'),
(1143, 4, '2025-07-28', 19, 7.00, '2025-07-28 19:13:04', '2025-07-28 19:13:04'),
(1144, 5, '2025-07-28', 20, 7.00, '2025-07-28 19:13:04', '2025-07-28 19:13:04'),
(1145, 6, '2025-07-28', 19, 9.00, '2025-07-28 19:13:04', '2025-07-28 19:13:04'),
(1146, 7, '2025-07-28', 18, 6.00, '2025-07-28 19:13:04', '2025-07-28 19:13:04'),
(1147, 9, '2025-07-28', 19, 7.00, '2025-07-28 19:13:04', '2025-07-28 19:13:04'),
(1148, 16, '2025-07-28', 18, 9.00, '2025-07-28 19:13:04', '2025-07-28 19:13:04'),
(1149, 18, '2025-07-28', 5, 5.00, '2025-07-28 19:13:04', '2025-07-28 19:13:04'),
(1150, 19, '2025-07-28', 15, 11.00, '2025-07-28 19:13:04', '2025-07-28 19:13:04'),
(1151, 28, '2025-07-28', 15, 10.00, '2025-07-28 19:13:04', '2025-07-28 19:13:04'),
(1152, 32, '2025-07-28', 20, 11.00, '2025-07-28 19:13:04', '2025-07-28 19:13:04'),
(1153, 34, '2025-07-28', 14, 13.00, '2025-07-28 19:13:04', '2025-07-28 19:13:04'),
(1154, 35, '2025-07-28', 12, 9.00, '2025-07-28 19:13:04', '2025-07-28 19:13:04'),
(1155, 36, '2025-07-28', 20, 12.00, '2025-07-28 19:13:04', '2025-07-28 19:13:04'),
(1156, 53, '2025-07-28', 12, 11.00, '2025-07-28 19:13:04', '2025-07-28 19:13:04'),
(1157, 54, '2025-07-28', 5, 12.00, '2025-07-28 19:13:04', '2025-07-28 19:13:04'),
(1158, 56, '2025-07-28', 20, 8.00, '2025-07-28 19:13:04', '2025-07-28 19:13:04'),
(1159, 57, '2025-07-28', 14, 9.00, '2025-07-28 19:13:04', '2025-07-28 19:13:04'),
(1160, 58, '2025-07-28', 12, 8.00, '2025-07-28 19:13:04', '2025-07-28 19:13:04'),
(1161, 87, '2025-07-28', 8, 19.00, '2025-07-28 19:13:04', '2025-07-28 19:13:04'),
(1162, 72, '2025-07-28', 5, 28.00, '2025-07-28 19:13:04', '2025-07-28 19:13:04'),
(1163, 74, '2025-07-28', 15, 3.00, '2025-07-28 19:13:04', '2025-07-28 19:13:04'),
(1164, 77, '2025-07-28', 20, 3.00, '2025-07-28 19:13:04', '2025-07-28 19:13:04'),
(1165, 109, '2025-07-28', 33, 13.00, '2025-07-28 19:13:04', '2025-07-28 19:13:04'),
(1166, 103, '2025-07-28', 3, 12.00, '2025-07-28 19:13:04', '2025-07-28 19:13:04'),
(1167, 4, '2025-07-29', 19, 7.00, '2025-07-30 00:25:06', '2025-07-30 00:25:06'),
(1168, 5, '2025-07-29', 20, 7.00, '2025-07-30 00:25:06', '2025-07-30 00:25:06'),
(1169, 6, '2025-07-29', 19, 9.00, '2025-07-30 00:25:06', '2025-07-30 00:25:06'),
(1170, 7, '2025-07-29', 18, 6.00, '2025-07-30 00:25:06', '2025-07-30 00:25:06'),
(1171, 9, '2025-07-29', 19, 7.00, '2025-07-30 00:25:06', '2025-07-30 00:25:06'),
(1172, 16, '2025-07-29', 18, 9.00, '2025-07-30 00:25:06', '2025-07-30 00:25:06'),
(1173, 18, '2025-07-29', 5, 5.00, '2025-07-30 00:25:06', '2025-07-30 00:25:06'),
(1174, 19, '2025-07-29', 15, 11.00, '2025-07-30 00:25:06', '2025-07-30 00:25:06'),
(1175, 28, '2025-07-29', 15, 10.00, '2025-07-30 00:25:06', '2025-07-30 00:25:06'),
(1176, 32, '2025-07-29', 20, 11.00, '2025-07-30 00:25:06', '2025-07-30 00:25:06'),
(1177, 34, '2025-07-29', 14, 13.00, '2025-07-30 00:25:06', '2025-07-30 00:25:06'),
(1178, 35, '2025-07-29', 12, 9.00, '2025-07-30 00:25:06', '2025-07-30 00:25:06'),
(1179, 36, '2025-07-29', 20, 12.00, '2025-07-30 00:25:06', '2025-07-30 00:25:06'),
(1180, 53, '2025-07-29', 12, 11.00, '2025-07-30 00:25:06', '2025-07-30 00:25:06'),
(1181, 54, '2025-07-29', 5, 12.00, '2025-07-30 00:25:06', '2025-07-30 00:25:06'),
(1182, 56, '2025-07-29', 20, 8.00, '2025-07-30 00:25:06', '2025-07-30 00:25:06'),
(1183, 57, '2025-07-29', 14, 9.00, '2025-07-30 00:25:06', '2025-07-30 00:25:06'),
(1184, 58, '2025-07-29', 12, 8.00, '2025-07-30 00:25:06', '2025-07-30 00:25:06'),
(1185, 87, '2025-07-29', 8, 19.00, '2025-07-30 00:25:06', '2025-07-30 00:25:06'),
(1186, 72, '2025-07-29', 5, 28.00, '2025-07-30 00:25:06', '2025-07-30 00:25:06'),
(1187, 74, '2025-07-29', 15, 3.00, '2025-07-30 00:25:06', '2025-07-30 00:25:06'),
(1188, 77, '2025-07-29', 20, 3.00, '2025-07-30 00:25:06', '2025-07-30 00:25:06'),
(1189, 109, '2025-07-29', 33, 13.00, '2025-07-30 00:25:06', '2025-07-30 00:25:06'),
(1190, 103, '2025-07-29', 3, 12.00, '2025-07-30 00:25:06', '2025-07-30 00:25:06'),
(1191, 138, '2025-07-29', 5, 7.50, '2025-07-30 01:42:10', '2025-07-30 01:42:10'),
(1192, 4, '2025-07-30', 19, 7.00, '2025-07-31 02:39:26', '2025-07-31 02:39:26'),
(1193, 5, '2025-07-30', 20, 7.00, '2025-07-31 02:39:26', '2025-07-31 02:39:26'),
(1194, 6, '2025-07-30', 19, 9.00, '2025-07-31 02:39:26', '2025-07-31 02:39:26'),
(1195, 7, '2025-07-30', 18, 6.00, '2025-07-31 02:39:26', '2025-07-31 02:39:26'),
(1196, 9, '2025-07-30', 19, 7.00, '2025-07-31 02:39:26', '2025-07-31 02:39:26'),
(1197, 16, '2025-07-30', 18, 9.00, '2025-07-31 02:39:26', '2025-07-31 02:39:26'),
(1198, 18, '2025-07-30', 5, 5.00, '2025-07-31 02:39:26', '2025-07-31 02:39:26'),
(1199, 19, '2025-07-30', 15, 11.00, '2025-07-31 02:39:26', '2025-07-31 02:39:26'),
(1200, 28, '2025-07-30', 15, 10.00, '2025-07-31 02:39:26', '2025-07-31 02:39:26'),
(1201, 32, '2025-07-30', 20, 11.00, '2025-07-31 02:39:26', '2025-07-31 02:39:26'),
(1202, 34, '2025-07-30', 14, 13.00, '2025-07-31 02:39:26', '2025-07-31 02:39:26'),
(1203, 35, '2025-07-30', 12, 9.00, '2025-07-31 02:39:26', '2025-07-31 02:39:26'),
(1204, 36, '2025-07-30', 20, 12.00, '2025-07-31 02:39:26', '2025-07-31 02:39:26'),
(1205, 53, '2025-07-30', 12, 11.00, '2025-07-31 02:39:26', '2025-07-31 02:39:26'),
(1206, 54, '2025-07-30', 5, 12.00, '2025-07-31 02:39:26', '2025-07-31 02:39:26'),
(1207, 56, '2025-07-30', 20, 8.00, '2025-07-31 02:39:26', '2025-07-31 02:39:26'),
(1208, 57, '2025-07-30', 14, 9.00, '2025-07-31 02:39:26', '2025-07-31 02:39:26'),
(1209, 58, '2025-07-30', 12, 8.00, '2025-07-31 02:39:26', '2025-07-31 02:39:26'),
(1210, 87, '2025-07-30', 8, 19.00, '2025-07-31 02:39:26', '2025-07-31 02:39:26'),
(1211, 72, '2025-07-30', 5, 28.00, '2025-07-31 02:39:26', '2025-07-31 02:39:26'),
(1212, 74, '2025-07-30', 15, 3.00, '2025-07-31 02:39:26', '2025-07-31 02:39:26'),
(1213, 77, '2025-07-30', 20, 3.00, '2025-07-31 02:39:26', '2025-07-31 02:39:26'),
(1214, 109, '2025-07-30', 33, 13.00, '2025-07-31 02:39:26', '2025-07-31 02:39:26'),
(1215, 103, '2025-07-30', 3, 12.00, '2025-07-31 02:39:26', '2025-07-31 02:39:26'),
(1233, 4, '2025-07-31', 19, 7.00, '2025-07-31 15:35:41', '2025-07-31 15:35:41'),
(1234, 5, '2025-07-31', 20, 7.00, '2025-07-31 15:35:41', '2025-07-31 15:35:41'),
(1235, 6, '2025-07-31', 19, 9.00, '2025-07-31 15:35:41', '2025-07-31 15:35:41'),
(1236, 7, '2025-07-31', 18, 6.00, '2025-07-31 15:35:41', '2025-07-31 15:35:41'),
(1237, 9, '2025-07-31', 19, 7.00, '2025-07-31 15:35:41', '2025-07-31 15:35:41'),
(1238, 16, '2025-07-31', 18, 9.00, '2025-07-31 15:35:41', '2025-07-31 15:35:41'),
(1239, 18, '2025-07-31', 5, 5.00, '2025-07-31 15:35:41', '2025-07-31 15:35:41'),
(1240, 19, '2025-07-31', 15, 11.00, '2025-07-31 15:35:41', '2025-07-31 15:35:41'),
(1241, 28, '2025-07-31', 15, 10.00, '2025-07-31 15:35:41', '2025-07-31 15:35:41'),
(1242, 32, '2025-07-31', 20, 11.00, '2025-07-31 15:35:41', '2025-07-31 15:35:41'),
(1243, 34, '2025-07-31', 14, 13.00, '2025-07-31 15:35:41', '2025-07-31 15:35:41'),
(1244, 35, '2025-07-31', 12, 9.00, '2025-07-31 15:35:41', '2025-07-31 15:35:41'),
(1245, 36, '2025-07-31', 20, 12.00, '2025-07-31 15:35:41', '2025-07-31 15:35:41'),
(1246, 53, '2025-07-31', 12, 11.00, '2025-07-31 15:35:41', '2025-07-31 15:35:41'),
(1247, 54, '2025-07-31', 5, 12.00, '2025-07-31 15:35:41', '2025-07-31 15:35:41'),
(1248, 56, '2025-07-31', 20, 8.00, '2025-07-31 15:35:41', '2025-07-31 15:35:41'),
(1249, 57, '2025-07-31', 14, 9.00, '2025-07-31 15:35:41', '2025-07-31 15:35:41'),
(1250, 58, '2025-07-31', 12, 8.00, '2025-07-31 15:35:41', '2025-07-31 15:35:41'),
(1251, 87, '2025-07-31', 8, 19.00, '2025-07-31 15:35:41', '2025-07-31 15:35:41'),
(1252, 72, '2025-07-31', 5, 28.00, '2025-07-31 15:35:41', '2025-07-31 15:35:41'),
(1253, 74, '2025-07-31', 15, 3.00, '2025-07-31 15:35:41', '2025-07-31 15:35:41'),
(1254, 77, '2025-07-31', 20, 3.00, '2025-07-31 15:35:41', '2025-07-31 15:35:41'),
(1255, 4, '2025-08-01', 19, 7.00, '2025-08-01 14:27:25', '2025-08-01 14:27:25'),
(1256, 5, '2025-08-01', 20, 7.00, '2025-08-01 14:27:25', '2025-08-01 14:27:25'),
(1257, 6, '2025-08-01', 19, 9.00, '2025-08-01 14:27:25', '2025-08-01 14:27:25'),
(1258, 7, '2025-08-01', 18, 6.00, '2025-08-01 14:27:25', '2025-08-01 14:27:25'),
(1259, 9, '2025-08-01', 19, 7.00, '2025-08-01 14:27:25', '2025-08-01 14:27:25'),
(1260, 16, '2025-08-01', 18, 9.00, '2025-08-01 14:27:25', '2025-08-01 14:27:25'),
(1261, 18, '2025-08-01', 5, 5.00, '2025-08-01 14:27:25', '2025-08-01 14:27:25'),
(1262, 19, '2025-08-01', 15, 11.00, '2025-08-01 14:27:25', '2025-08-01 14:27:25'),
(1263, 28, '2025-08-01', 15, 10.00, '2025-08-01 14:27:25', '2025-08-01 14:27:25'),
(1264, 32, '2025-08-01', 20, 11.00, '2025-08-01 14:27:25', '2025-08-01 14:27:25'),
(1265, 34, '2025-08-01', 14, 13.00, '2025-08-01 14:27:25', '2025-08-01 14:27:25'),
(1266, 35, '2025-08-01', 12, 9.00, '2025-08-01 14:27:25', '2025-08-01 14:27:25'),
(1267, 36, '2025-08-01', 20, 12.00, '2025-08-01 14:27:25', '2025-08-01 14:27:25'),
(1268, 53, '2025-08-01', 12, 11.00, '2025-08-01 14:27:25', '2025-08-01 14:27:25'),
(1269, 54, '2025-08-01', 5, 12.00, '2025-08-01 14:27:25', '2025-08-01 14:27:25'),
(1270, 56, '2025-08-01', 20, 8.00, '2025-08-01 14:27:25', '2025-08-01 14:27:25'),
(1271, 57, '2025-08-01', 14, 9.00, '2025-08-01 14:27:25', '2025-08-01 14:27:25'),
(1272, 58, '2025-08-01', 12, 8.00, '2025-08-01 14:27:25', '2025-08-01 14:27:25'),
(1273, 87, '2025-08-01', 8, 19.00, '2025-08-01 14:27:25', '2025-08-01 14:27:25'),
(1274, 72, '2025-08-01', 5, 28.00, '2025-08-01 14:27:25', '2025-08-01 14:27:25'),
(1275, 74, '2025-08-01', 15, 3.00, '2025-08-01 14:27:25', '2025-08-01 14:27:25'),
(1276, 77, '2025-08-01', 20, 3.00, '2025-08-01 14:27:25', '2025-08-01 14:27:25'),
(1277, 102, '2025-08-01', 12, 19.00, '2025-08-01 17:37:13', '2025-08-01 17:37:13'),
(1278, 104, '2025-08-01', 12, 20.00, '2025-08-01 17:37:16', '2025-08-01 17:37:16'),
(1279, 103, '2025-08-01', 12, 12.00, '2025-08-01 17:37:19', '2025-08-01 17:37:19'),
(1280, 107, '2025-08-01', 12, 16.00, '2025-08-01 17:37:22', '2025-08-01 17:37:22'),
(1281, 109, '2025-08-01', 12, 13.00, '2025-08-01 17:37:25', '2025-08-01 17:37:25'),
(1282, 4, '2025-08-08', 19, 7.00, '2025-08-08 18:33:16', '2025-08-08 18:33:16'),
(1283, 5, '2025-08-08', 20, 7.00, '2025-08-08 18:33:16', '2025-08-08 18:33:16'),
(1284, 6, '2025-08-08', 19, 9.00, '2025-08-08 18:33:16', '2025-08-08 18:33:16'),
(1285, 7, '2025-08-08', 18, 6.00, '2025-08-08 18:33:16', '2025-08-08 18:33:16'),
(1286, 9, '2025-08-08', 19, 7.00, '2025-08-08 18:33:16', '2025-08-08 18:33:16'),
(1287, 16, '2025-08-08', 18, 9.00, '2025-08-08 18:33:16', '2025-08-08 18:33:16'),
(1288, 18, '2025-08-08', 5, 5.00, '2025-08-08 18:33:16', '2025-08-08 18:33:16'),
(1289, 19, '2025-08-08', 15, 11.00, '2025-08-08 18:33:16', '2025-08-08 18:33:16'),
(1290, 28, '2025-08-08', 15, 10.00, '2025-08-08 18:33:16', '2025-08-08 18:33:16'),
(1291, 32, '2025-08-08', 20, 11.00, '2025-08-08 18:33:16', '2025-08-08 18:33:16'),
(1292, 34, '2025-08-08', 14, 13.00, '2025-08-08 18:33:16', '2025-08-08 18:33:16'),
(1293, 35, '2025-08-08', 12, 9.00, '2025-08-08 18:33:16', '2025-08-08 18:33:16'),
(1294, 36, '2025-08-08', 20, 12.00, '2025-08-08 18:33:16', '2025-08-08 18:33:16'),
(1295, 53, '2025-08-08', 12, 11.00, '2025-08-08 18:33:16', '2025-08-08 18:33:16'),
(1296, 54, '2025-08-08', 5, 12.00, '2025-08-08 18:33:16', '2025-08-08 18:33:16'),
(1297, 56, '2025-08-08', 20, 8.00, '2025-08-08 18:33:16', '2025-08-08 18:33:16'),
(1298, 57, '2025-08-08', 14, 9.00, '2025-08-08 18:33:16', '2025-08-08 18:33:16'),
(1299, 58, '2025-08-08', 12, 8.00, '2025-08-08 18:33:16', '2025-08-08 18:33:16'),
(1300, 87, '2025-08-08', 8, 19.00, '2025-08-08 18:33:16', '2025-08-08 18:33:16'),
(1301, 72, '2025-08-08', 5, 28.00, '2025-08-08 18:33:16', '2025-08-08 18:33:16'),
(1302, 74, '2025-08-08', 15, 3.00, '2025-08-08 18:33:16', '2025-08-08 18:33:16'),
(1303, 77, '2025-08-08', 20, 3.00, '2025-08-08 18:33:16', '2025-08-08 18:33:16'),
(1304, 109, '2025-08-08', 33, 13.00, '2025-08-08 18:33:16', '2025-08-08 18:33:16'),
(1305, 103, '2025-08-08', 3, 12.00, '2025-08-08 18:33:16', '2025-08-08 18:33:16'),
(1306, 4, '2025-08-12', 19, 7.00, '2025-08-12 05:42:15', '2025-08-12 05:42:15'),
(1307, 5, '2025-08-12', 20, 7.00, '2025-08-12 05:42:15', '2025-08-12 05:42:15'),
(1308, 6, '2025-08-12', 19, 9.00, '2025-08-12 05:42:15', '2025-08-12 05:42:15'),
(1309, 7, '2025-08-12', 18, 6.00, '2025-08-12 05:42:15', '2025-08-12 05:42:15'),
(1310, 9, '2025-08-12', 19, 7.00, '2025-08-12 05:42:15', '2025-08-12 05:42:15'),
(1311, 16, '2025-08-12', 18, 9.00, '2025-08-12 05:42:15', '2025-08-12 05:42:15'),
(1312, 18, '2025-08-12', 5, 5.00, '2025-08-12 05:42:15', '2025-08-12 05:42:15'),
(1313, 19, '2025-08-12', 15, 11.00, '2025-08-12 05:42:15', '2025-08-12 05:42:15'),
(1314, 28, '2025-08-12', 15, 10.00, '2025-08-12 05:42:15', '2025-08-12 05:42:15'),
(1315, 32, '2025-08-12', 20, 11.00, '2025-08-12 05:42:15', '2025-08-12 05:42:15'),
(1316, 34, '2025-08-12', 14, 13.00, '2025-08-12 05:42:15', '2025-08-12 05:42:15'),
(1317, 35, '2025-08-12', 12, 9.00, '2025-08-12 05:42:15', '2025-08-12 05:42:15'),
(1318, 36, '2025-08-12', 20, 12.00, '2025-08-12 05:42:15', '2025-08-12 05:42:15'),
(1319, 53, '2025-08-12', 12, 11.00, '2025-08-12 05:42:15', '2025-08-12 05:42:15'),
(1320, 54, '2025-08-12', 5, 12.00, '2025-08-12 05:42:15', '2025-08-12 05:42:15'),
(1321, 56, '2025-08-12', 20, 8.00, '2025-08-12 05:42:15', '2025-08-12 05:42:15'),
(1322, 57, '2025-08-12', 14, 9.00, '2025-08-12 05:42:15', '2025-08-12 05:42:15'),
(1323, 58, '2025-08-12', 12, 8.00, '2025-08-12 05:42:15', '2025-08-12 05:42:15'),
(1324, 87, '2025-08-12', 8, 19.00, '2025-08-12 05:42:15', '2025-08-12 05:42:15'),
(1325, 72, '2025-08-12', 5, 28.00, '2025-08-12 05:42:15', '2025-08-12 05:42:15'),
(1326, 74, '2025-08-12', 15, 3.00, '2025-08-12 05:42:15', '2025-08-12 05:42:15'),
(1327, 77, '2025-08-12', 20, 3.00, '2025-08-12 05:42:15', '2025-08-12 05:42:15'),
(1328, 109, '2025-08-12', 33, 13.00, '2025-08-12 05:42:15', '2025-08-12 05:42:15'),
(1329, 103, '2025-08-12', 3, 12.00, '2025-08-12 05:42:15', '2025-08-12 05:42:15'),
(1330, 4, '2025-08-14', 19, 7.00, '2025-08-15 02:12:52', '2025-08-15 02:12:52'),
(1331, 5, '2025-08-14', 20, 7.00, '2025-08-15 02:12:52', '2025-08-15 02:12:52'),
(1332, 6, '2025-08-14', 19, 9.00, '2025-08-15 02:12:52', '2025-08-15 02:12:52'),
(1333, 7, '2025-08-14', 18, 6.00, '2025-08-15 02:12:52', '2025-08-15 02:12:52'),
(1334, 9, '2025-08-14', 19, 7.00, '2025-08-15 02:12:52', '2025-08-15 02:12:52'),
(1335, 16, '2025-08-14', 18, 9.00, '2025-08-15 02:12:52', '2025-08-15 02:12:52'),
(1336, 18, '2025-08-14', 5, 5.00, '2025-08-15 02:12:52', '2025-08-15 02:12:52'),
(1337, 19, '2025-08-14', 15, 11.00, '2025-08-15 02:12:52', '2025-08-15 02:12:52'),
(1338, 28, '2025-08-14', 15, 10.00, '2025-08-15 02:12:52', '2025-08-15 02:12:52'),
(1339, 32, '2025-08-14', 20, 11.00, '2025-08-15 02:12:52', '2025-08-15 02:12:52'),
(1340, 34, '2025-08-14', 14, 13.00, '2025-08-15 02:12:52', '2025-08-15 02:12:52'),
(1341, 35, '2025-08-14', 12, 9.00, '2025-08-15 02:12:52', '2025-08-15 02:12:52'),
(1342, 36, '2025-08-14', 20, 12.00, '2025-08-15 02:12:52', '2025-08-15 02:12:52'),
(1343, 53, '2025-08-14', 12, 11.00, '2025-08-15 02:12:52', '2025-08-15 02:12:52'),
(1344, 54, '2025-08-14', 5, 12.00, '2025-08-15 02:12:52', '2025-08-15 02:12:52'),
(1345, 56, '2025-08-14', 20, 8.00, '2025-08-15 02:12:52', '2025-08-15 02:12:52'),
(1346, 57, '2025-08-14', 14, 9.00, '2025-08-15 02:12:52', '2025-08-15 02:12:52'),
(1347, 58, '2025-08-14', 12, 8.00, '2025-08-15 02:12:52', '2025-08-15 02:12:52'),
(1348, 87, '2025-08-14', 8, 19.00, '2025-08-15 02:12:52', '2025-08-15 02:12:52'),
(1349, 72, '2025-08-14', 5, 28.00, '2025-08-15 02:12:52', '2025-08-15 02:12:52'),
(1350, 74, '2025-08-14', 15, 3.00, '2025-08-15 02:12:52', '2025-08-15 02:12:52'),
(1351, 77, '2025-08-14', 20, 3.00, '2025-08-15 02:12:52', '2025-08-15 02:12:52'),
(1352, 109, '2025-08-14', 33, 13.00, '2025-08-15 02:12:52', '2025-08-15 02:12:52'),
(1353, 103, '2025-08-14', 3, 12.00, '2025-08-15 02:12:52', '2025-08-15 02:12:52'),
(1354, 4, '2025-08-15', 19, 7.00, '2025-08-15 06:04:23', '2025-08-15 06:04:23'),
(1355, 5, '2025-08-15', 20, 7.00, '2025-08-15 06:04:23', '2025-08-15 06:04:23'),
(1356, 6, '2025-08-15', 19, 9.00, '2025-08-15 06:04:23', '2025-08-15 06:04:23'),
(1357, 7, '2025-08-15', 18, 6.00, '2025-08-15 06:04:23', '2025-08-15 06:04:23'),
(1358, 9, '2025-08-15', 19, 7.00, '2025-08-15 06:04:23', '2025-08-15 06:04:23'),
(1359, 16, '2025-08-15', 18, 9.00, '2025-08-15 06:04:23', '2025-08-15 06:04:23'),
(1360, 18, '2025-08-15', 5, 5.00, '2025-08-15 06:04:23', '2025-08-15 06:04:23'),
(1361, 19, '2025-08-15', 15, 11.00, '2025-08-15 06:04:23', '2025-08-15 06:04:23'),
(1362, 28, '2025-08-15', 15, 10.00, '2025-08-15 06:04:23', '2025-08-15 06:04:23'),
(1363, 32, '2025-08-15', 20, 11.00, '2025-08-15 06:04:23', '2025-08-15 06:04:23'),
(1364, 34, '2025-08-15', 14, 13.00, '2025-08-15 06:04:23', '2025-08-15 06:04:23'),
(1365, 35, '2025-08-15', 12, 9.00, '2025-08-15 06:04:23', '2025-08-15 06:04:23'),
(1366, 36, '2025-08-15', 20, 12.00, '2025-08-15 06:04:23', '2025-08-15 06:04:23'),
(1367, 53, '2025-08-15', 12, 11.00, '2025-08-15 06:04:23', '2025-08-15 06:04:23'),
(1368, 54, '2025-08-15', 5, 12.00, '2025-08-15 06:04:23', '2025-08-15 06:04:23'),
(1369, 56, '2025-08-15', 20, 8.00, '2025-08-15 06:04:23', '2025-08-15 06:04:23'),
(1370, 57, '2025-08-15', 14, 9.00, '2025-08-15 06:04:23', '2025-08-15 06:04:23'),
(1371, 58, '2025-08-15', 12, 8.00, '2025-08-15 06:04:23', '2025-08-15 06:04:23'),
(1372, 87, '2025-08-15', 8, 19.00, '2025-08-15 06:04:23', '2025-08-15 06:04:23'),
(1373, 72, '2025-08-15', 5, 28.00, '2025-08-15 06:04:23', '2025-08-15 06:04:23'),
(1374, 74, '2025-08-15', 15, 3.00, '2025-08-15 06:04:23', '2025-08-15 06:04:23'),
(1375, 77, '2025-08-15', 20, 3.00, '2025-08-15 06:04:23', '2025-08-15 06:04:23'),
(1376, 109, '2025-08-15', 33, 13.00, '2025-08-15 06:04:23', '2025-08-15 06:04:23'),
(1377, 103, '2025-08-15', 3, 12.00, '2025-08-15 06:04:23', '2025-08-15 06:04:23'),
(1378, 4, '2025-08-21', 19, 7.00, '2025-08-21 20:45:17', '2025-08-21 20:45:17');
INSERT INTO `planeacion_menu` (`id`, `id_producto`, `fecha_plan`, `stock_diario`, `precio`, `created_at`, `updated_at`) VALUES
(1379, 5, '2025-08-21', 20, 7.00, '2025-08-21 20:45:17', '2025-08-21 20:45:17'),
(1380, 6, '2025-08-21', 19, 9.00, '2025-08-21 20:45:17', '2025-08-21 20:45:17'),
(1381, 7, '2025-08-21', 18, 6.00, '2025-08-21 20:45:17', '2025-08-21 20:45:17'),
(1382, 9, '2025-08-21', 19, 7.00, '2025-08-21 20:45:17', '2025-08-21 20:45:17'),
(1383, 16, '2025-08-21', 18, 9.00, '2025-08-21 20:45:17', '2025-08-21 20:45:17'),
(1384, 18, '2025-08-21', 5, 5.00, '2025-08-21 20:45:17', '2025-08-21 20:45:17'),
(1385, 19, '2025-08-21', 15, 11.00, '2025-08-21 20:45:17', '2025-08-21 20:45:17'),
(1386, 28, '2025-08-21', 15, 10.00, '2025-08-21 20:45:17', '2025-08-21 20:45:17'),
(1387, 32, '2025-08-21', 20, 11.00, '2025-08-21 20:45:17', '2025-08-21 20:45:17'),
(1388, 34, '2025-08-21', 14, 13.00, '2025-08-21 20:45:17', '2025-08-21 20:45:17'),
(1389, 35, '2025-08-21', 12, 9.00, '2025-08-21 20:45:17', '2025-08-21 20:45:17'),
(1390, 36, '2025-08-21', 20, 12.00, '2025-08-21 20:45:17', '2025-08-21 20:45:17'),
(1391, 53, '2025-08-21', 12, 11.00, '2025-08-21 20:45:17', '2025-08-21 20:45:17'),
(1392, 54, '2025-08-21', 5, 12.00, '2025-08-21 20:45:17', '2025-08-21 20:45:17'),
(1393, 56, '2025-08-21', 20, 8.00, '2025-08-21 20:45:17', '2025-08-21 20:45:17'),
(1394, 57, '2025-08-21', 14, 9.00, '2025-08-21 20:45:17', '2025-08-21 20:45:17'),
(1395, 58, '2025-08-21', 12, 8.00, '2025-08-21 20:45:17', '2025-08-21 20:45:17'),
(1396, 87, '2025-08-21', 8, 19.00, '2025-08-21 20:45:17', '2025-08-21 20:45:17'),
(1397, 72, '2025-08-21', 5, 28.00, '2025-08-21 20:45:17', '2025-08-21 20:45:17'),
(1398, 74, '2025-08-21', 15, 3.00, '2025-08-21 20:45:17', '2025-08-21 20:45:17'),
(1399, 77, '2025-08-21', 20, 3.00, '2025-08-21 20:45:17', '2025-08-21 20:45:17'),
(1400, 109, '2025-08-21', 33, 13.00, '2025-08-21 20:45:17', '2025-08-21 20:45:17'),
(1401, 103, '2025-08-21', 3, 12.00, '2025-08-21 20:45:17', '2025-08-21 20:45:17'),
(1402, 4, '2025-08-22', 19, 7.00, '2025-08-21 20:45:25', '2025-08-21 20:45:25'),
(1403, 5, '2025-08-22', 20, 7.00, '2025-08-21 20:45:25', '2025-08-21 20:45:25'),
(1404, 6, '2025-08-22', 19, 9.00, '2025-08-21 20:45:25', '2025-08-21 20:45:25'),
(1405, 7, '2025-08-22', 18, 6.00, '2025-08-21 20:45:25', '2025-08-21 20:45:25'),
(1406, 9, '2025-08-22', 19, 7.00, '2025-08-21 20:45:25', '2025-08-21 20:45:25'),
(1407, 16, '2025-08-22', 18, 9.00, '2025-08-21 20:45:25', '2025-08-21 20:45:25'),
(1408, 18, '2025-08-22', 5, 5.00, '2025-08-21 20:45:25', '2025-08-21 20:45:25'),
(1409, 19, '2025-08-22', 15, 11.00, '2025-08-21 20:45:25', '2025-08-21 20:45:25'),
(1410, 28, '2025-08-22', 15, 10.00, '2025-08-21 20:45:25', '2025-08-21 20:45:25'),
(1411, 32, '2025-08-22', 20, 11.00, '2025-08-21 20:45:25', '2025-08-21 20:45:25'),
(1412, 34, '2025-08-22', 14, 13.00, '2025-08-21 20:45:25', '2025-08-21 20:45:25'),
(1413, 35, '2025-08-22', 12, 9.00, '2025-08-21 20:45:25', '2025-08-21 20:45:25'),
(1414, 36, '2025-08-22', 20, 12.00, '2025-08-21 20:45:25', '2025-08-21 20:45:25'),
(1415, 53, '2025-08-22', 12, 11.00, '2025-08-21 20:45:25', '2025-08-21 20:45:25'),
(1416, 54, '2025-08-22', 5, 12.00, '2025-08-21 20:45:25', '2025-08-21 20:45:25'),
(1417, 56, '2025-08-22', 20, 8.00, '2025-08-21 20:45:25', '2025-08-21 20:45:25'),
(1418, 57, '2025-08-22', 14, 9.00, '2025-08-21 20:45:25', '2025-08-21 20:45:25'),
(1419, 58, '2025-08-22', 12, 8.00, '2025-08-21 20:45:25', '2025-08-21 20:45:25'),
(1420, 87, '2025-08-22', 8, 19.00, '2025-08-21 20:45:25', '2025-08-21 20:45:25'),
(1421, 72, '2025-08-22', 5, 28.00, '2025-08-21 20:45:25', '2025-08-21 20:45:25'),
(1422, 74, '2025-08-22', 15, 3.00, '2025-08-21 20:45:25', '2025-08-21 20:45:25'),
(1423, 77, '2025-08-22', 20, 3.00, '2025-08-21 20:45:25', '2025-08-21 20:45:25'),
(1424, 109, '2025-08-22', 33, 13.00, '2025-08-21 20:45:25', '2025-08-21 20:45:25'),
(1425, 103, '2025-08-22', 3, 12.00, '2025-08-21 20:45:25', '2025-08-21 20:45:25'),
(1426, 4, '2025-08-23', 19, 7.00, '2025-08-21 20:45:32', '2025-08-21 20:45:32'),
(1427, 5, '2025-08-23', 20, 7.00, '2025-08-21 20:45:32', '2025-08-21 20:45:32'),
(1428, 6, '2025-08-23', 19, 9.00, '2025-08-21 20:45:32', '2025-08-21 20:45:32'),
(1429, 7, '2025-08-23', 18, 6.00, '2025-08-21 20:45:32', '2025-08-21 20:45:32'),
(1430, 9, '2025-08-23', 19, 7.00, '2025-08-21 20:45:32', '2025-08-21 20:45:32'),
(1431, 16, '2025-08-23', 18, 9.00, '2025-08-21 20:45:32', '2025-08-21 20:45:32'),
(1432, 18, '2025-08-23', 5, 5.00, '2025-08-21 20:45:32', '2025-08-21 20:45:32'),
(1433, 19, '2025-08-23', 15, 11.00, '2025-08-21 20:45:32', '2025-08-21 20:45:32'),
(1434, 28, '2025-08-23', 15, 10.00, '2025-08-21 20:45:32', '2025-08-21 20:45:32'),
(1435, 32, '2025-08-23', 20, 11.00, '2025-08-21 20:45:32', '2025-08-21 20:45:32'),
(1436, 34, '2025-08-23', 14, 13.00, '2025-08-21 20:45:32', '2025-08-21 20:45:32'),
(1437, 35, '2025-08-23', 12, 9.00, '2025-08-21 20:45:32', '2025-08-21 20:45:32'),
(1438, 36, '2025-08-23', 20, 12.00, '2025-08-21 20:45:32', '2025-08-21 20:45:32'),
(1439, 53, '2025-08-23', 12, 11.00, '2025-08-21 20:45:32', '2025-08-21 20:45:32'),
(1440, 54, '2025-08-23', 5, 12.00, '2025-08-21 20:45:32', '2025-08-21 20:45:32'),
(1441, 56, '2025-08-23', 20, 8.00, '2025-08-21 20:45:32', '2025-08-21 20:45:32'),
(1442, 57, '2025-08-23', 14, 9.00, '2025-08-21 20:45:32', '2025-08-21 20:45:32'),
(1443, 58, '2025-08-23', 12, 8.00, '2025-08-21 20:45:32', '2025-08-21 20:45:32'),
(1444, 87, '2025-08-23', 8, 19.00, '2025-08-21 20:45:32', '2025-08-21 20:45:32'),
(1445, 72, '2025-08-23', 5, 28.00, '2025-08-21 20:45:32', '2025-08-21 20:45:32'),
(1446, 74, '2025-08-23', 15, 3.00, '2025-08-21 20:45:32', '2025-08-21 20:45:32'),
(1447, 77, '2025-08-23', 20, 3.00, '2025-08-21 20:45:32', '2025-08-21 20:45:32'),
(1448, 109, '2025-08-23', 33, 13.00, '2025-08-21 20:45:32', '2025-08-21 20:45:32'),
(1449, 103, '2025-08-23', 3, 12.00, '2025-08-21 20:45:32', '2025-08-21 20:45:32'),
(1450, 4, '2025-08-24', 19, 7.00, '2025-08-21 20:45:38', '2025-08-21 20:45:38'),
(1451, 5, '2025-08-24', 20, 7.00, '2025-08-21 20:45:38', '2025-08-21 20:45:38'),
(1452, 6, '2025-08-24', 19, 9.00, '2025-08-21 20:45:38', '2025-08-21 20:45:38'),
(1453, 7, '2025-08-24', 18, 6.00, '2025-08-21 20:45:38', '2025-08-21 20:45:38'),
(1454, 9, '2025-08-24', 19, 7.00, '2025-08-21 20:45:38', '2025-08-21 20:45:38'),
(1455, 16, '2025-08-24', 18, 9.00, '2025-08-21 20:45:38', '2025-08-21 20:45:38'),
(1456, 18, '2025-08-24', 5, 5.00, '2025-08-21 20:45:38', '2025-08-21 20:45:38'),
(1457, 19, '2025-08-24', 15, 11.00, '2025-08-21 20:45:38', '2025-08-21 20:45:38'),
(1458, 28, '2025-08-24', 15, 10.00, '2025-08-21 20:45:38', '2025-08-21 20:45:38'),
(1459, 32, '2025-08-24', 20, 11.00, '2025-08-21 20:45:38', '2025-08-21 20:45:38'),
(1460, 34, '2025-08-24', 14, 13.00, '2025-08-21 20:45:38', '2025-08-21 20:45:38'),
(1461, 35, '2025-08-24', 12, 9.00, '2025-08-21 20:45:38', '2025-08-21 20:45:38'),
(1462, 36, '2025-08-24', 20, 12.00, '2025-08-21 20:45:38', '2025-08-21 20:45:38'),
(1463, 53, '2025-08-24', 12, 11.00, '2025-08-21 20:45:38', '2025-08-21 20:45:38'),
(1464, 54, '2025-08-24', 5, 12.00, '2025-08-21 20:45:38', '2025-08-21 20:45:38'),
(1465, 56, '2025-08-24', 20, 8.00, '2025-08-21 20:45:38', '2025-08-21 20:45:38'),
(1466, 57, '2025-08-24', 14, 9.00, '2025-08-21 20:45:38', '2025-08-21 20:45:38'),
(1467, 58, '2025-08-24', 12, 8.00, '2025-08-21 20:45:38', '2025-08-21 20:45:38'),
(1468, 87, '2025-08-24', 8, 19.00, '2025-08-21 20:45:38', '2025-08-21 20:45:38'),
(1469, 72, '2025-08-24', 5, 28.00, '2025-08-21 20:45:38', '2025-08-21 20:45:38'),
(1470, 74, '2025-08-24', 15, 3.00, '2025-08-21 20:45:38', '2025-08-21 20:45:38'),
(1471, 77, '2025-08-24', 20, 3.00, '2025-08-21 20:45:38', '2025-08-21 20:45:38'),
(1472, 109, '2025-08-24', 33, 13.00, '2025-08-21 20:45:38', '2025-08-21 20:45:38'),
(1473, 103, '2025-08-24', 3, 12.00, '2025-08-21 20:45:38', '2025-08-21 20:45:38'),
(1474, 4, '2025-08-27', 19, 7.00, '2025-08-27 22:37:50', '2025-08-27 22:37:50'),
(1475, 5, '2025-08-27', 20, 7.00, '2025-08-27 22:37:50', '2025-08-27 22:37:50'),
(1476, 6, '2025-08-27', 19, 9.00, '2025-08-27 22:37:50', '2025-08-27 22:37:50'),
(1477, 7, '2025-08-27', 18, 6.00, '2025-08-27 22:37:50', '2025-08-27 22:37:50'),
(1478, 9, '2025-08-27', 19, 7.00, '2025-08-27 22:37:50', '2025-08-27 22:37:50'),
(1479, 16, '2025-08-27', 18, 9.00, '2025-08-27 22:37:50', '2025-08-27 22:37:50'),
(1480, 18, '2025-08-27', 5, 5.00, '2025-08-27 22:37:50', '2025-08-27 22:37:50'),
(1481, 19, '2025-08-27', 15, 11.00, '2025-08-27 22:37:50', '2025-08-27 22:37:50'),
(1482, 28, '2025-08-27', 15, 10.00, '2025-08-27 22:37:50', '2025-08-27 22:37:50'),
(1483, 32, '2025-08-27', 20, 11.00, '2025-08-27 22:37:50', '2025-08-27 22:37:50'),
(1484, 34, '2025-08-27', 14, 13.00, '2025-08-27 22:37:50', '2025-08-27 22:37:50'),
(1485, 35, '2025-08-27', 12, 9.00, '2025-08-27 22:37:50', '2025-08-27 22:37:50'),
(1486, 36, '2025-08-27', 20, 12.00, '2025-08-27 22:37:50', '2025-08-27 22:37:50'),
(1487, 53, '2025-08-27', 12, 11.00, '2025-08-27 22:37:50', '2025-08-27 22:37:50'),
(1488, 54, '2025-08-27', 5, 12.00, '2025-08-27 22:37:50', '2025-08-27 22:37:50'),
(1489, 56, '2025-08-27', 20, 8.00, '2025-08-27 22:37:50', '2025-08-27 22:37:50'),
(1490, 57, '2025-08-27', 14, 9.00, '2025-08-27 22:37:50', '2025-08-27 22:37:50'),
(1491, 58, '2025-08-27', 12, 8.00, '2025-08-27 22:37:50', '2025-08-27 22:37:50'),
(1492, 87, '2025-08-27', 8, 19.00, '2025-08-27 22:37:50', '2025-08-27 22:37:50'),
(1493, 72, '2025-08-27', 5, 28.00, '2025-08-27 22:37:50', '2025-08-27 22:37:50'),
(1494, 74, '2025-08-27', 15, 3.00, '2025-08-27 22:37:50', '2025-08-27 22:37:50'),
(1495, 77, '2025-08-27', 20, 3.00, '2025-08-27 22:37:50', '2025-08-27 22:37:50'),
(1496, 109, '2025-08-27', 33, 13.00, '2025-08-27 22:37:50', '2025-08-27 22:37:50'),
(1497, 103, '2025-08-27', 3, 12.00, '2025-08-27 22:37:50', '2025-08-27 22:37:50'),
(1498, 4, '2025-08-31', 19, 7.00, '2025-08-31 17:14:47', '2025-08-31 17:14:47'),
(1499, 5, '2025-08-31', 20, 7.00, '2025-08-31 17:14:47', '2025-08-31 17:14:47'),
(1500, 6, '2025-08-31', 19, 9.00, '2025-08-31 17:14:47', '2025-08-31 17:14:47'),
(1501, 7, '2025-08-31', 18, 6.00, '2025-08-31 17:14:47', '2025-08-31 17:14:47'),
(1502, 9, '2025-08-31', 19, 7.00, '2025-08-31 17:14:47', '2025-08-31 17:14:47'),
(1503, 16, '2025-08-31', 18, 9.00, '2025-08-31 17:14:47', '2025-08-31 17:14:47'),
(1504, 18, '2025-08-31', 5, 5.00, '2025-08-31 17:14:47', '2025-08-31 17:14:47'),
(1505, 19, '2025-08-31', 15, 11.00, '2025-08-31 17:14:47', '2025-08-31 17:14:47'),
(1506, 28, '2025-08-31', 15, 10.00, '2025-08-31 17:14:47', '2025-08-31 17:14:47'),
(1507, 32, '2025-08-31', 20, 11.00, '2025-08-31 17:14:47', '2025-08-31 17:14:47'),
(1508, 34, '2025-08-31', 14, 13.00, '2025-08-31 17:14:47', '2025-08-31 17:14:47'),
(1509, 35, '2025-08-31', 12, 9.00, '2025-08-31 17:14:47', '2025-08-31 17:14:47'),
(1510, 36, '2025-08-31', 20, 12.00, '2025-08-31 17:14:47', '2025-08-31 17:14:47'),
(1511, 53, '2025-08-31', 12, 11.00, '2025-08-31 17:14:47', '2025-08-31 17:14:47'),
(1512, 54, '2025-08-31', 5, 12.00, '2025-08-31 17:14:47', '2025-08-31 17:14:47'),
(1513, 56, '2025-08-31', 20, 8.00, '2025-08-31 17:14:47', '2025-08-31 17:14:47'),
(1514, 57, '2025-08-31', 14, 9.00, '2025-08-31 17:14:47', '2025-08-31 17:14:47'),
(1515, 58, '2025-08-31', 12, 8.00, '2025-08-31 17:14:47', '2025-08-31 17:14:47'),
(1516, 87, '2025-08-31', 8, 19.00, '2025-08-31 17:14:47', '2025-08-31 17:14:47'),
(1517, 72, '2025-08-31', 5, 28.00, '2025-08-31 17:14:47', '2025-08-31 17:14:47'),
(1518, 74, '2025-08-31', 15, 3.00, '2025-08-31 17:14:47', '2025-08-31 17:14:47'),
(1519, 77, '2025-08-31', 20, 3.00, '2025-08-31 17:14:47', '2025-08-31 17:14:47'),
(1520, 109, '2025-08-31', 33, 13.00, '2025-08-31 17:14:47', '2025-08-31 17:14:47'),
(1521, 103, '2025-08-31', 3, 12.00, '2025-08-31 17:14:47', '2025-08-31 17:14:47'),
(1522, 4, '2025-11-06', 19, 7.00, '2025-11-07 00:15:55', '2025-11-07 00:15:55'),
(1523, 5, '2025-11-06', 20, 7.00, '2025-11-07 00:15:55', '2025-11-07 00:15:55'),
(1524, 6, '2025-11-06', 19, 9.00, '2025-11-07 00:15:55', '2025-11-07 00:15:55'),
(1525, 7, '2025-11-06', 18, 6.00, '2025-11-07 00:15:55', '2025-11-07 00:15:55'),
(1526, 9, '2025-11-06', 19, 7.00, '2025-11-07 00:15:55', '2025-11-07 00:15:55'),
(1527, 16, '2025-11-06', 18, 9.00, '2025-11-07 00:15:55', '2025-11-07 00:15:55'),
(1528, 18, '2025-11-06', 5, 5.00, '2025-11-07 00:15:55', '2025-11-07 00:15:55'),
(1529, 19, '2025-11-06', 15, 11.00, '2025-11-07 00:15:55', '2025-11-07 00:15:55'),
(1530, 28, '2025-11-06', 15, 10.00, '2025-11-07 00:15:55', '2025-11-07 00:15:55'),
(1531, 32, '2025-11-06', 20, 11.00, '2025-11-07 00:15:55', '2025-11-07 00:15:55'),
(1532, 34, '2025-11-06', 14, 13.00, '2025-11-07 00:15:55', '2025-11-07 00:15:55'),
(1533, 35, '2025-11-06', 12, 9.00, '2025-11-07 00:15:55', '2025-11-07 00:15:55'),
(1534, 36, '2025-11-06', 20, 12.00, '2025-11-07 00:15:55', '2025-11-07 00:15:55'),
(1535, 53, '2025-11-06', 12, 11.00, '2025-11-07 00:15:55', '2025-11-07 00:15:55'),
(1536, 54, '2025-11-06', 5, 12.00, '2025-11-07 00:15:55', '2025-11-07 00:15:55'),
(1537, 56, '2025-11-06', 20, 8.00, '2025-11-07 00:15:55', '2025-11-07 00:15:55'),
(1538, 57, '2025-11-06', 14, 9.00, '2025-11-07 00:15:55', '2025-11-07 00:15:55'),
(1539, 58, '2025-11-06', 12, 8.00, '2025-11-07 00:15:55', '2025-11-07 00:15:55'),
(1540, 87, '2025-11-06', 8, 19.00, '2025-11-07 00:15:55', '2025-11-07 00:15:55'),
(1541, 72, '2025-11-06', 5, 28.00, '2025-11-07 00:15:55', '2025-11-07 00:15:55'),
(1542, 74, '2025-11-06', 15, 3.00, '2025-11-07 00:15:55', '2025-11-07 00:15:55'),
(1543, 77, '2025-11-06', 20, 3.00, '2025-11-07 00:15:55', '2025-11-07 00:15:55'),
(1544, 109, '2025-11-06', 33, 13.00, '2025-11-07 00:15:55', '2025-11-07 00:15:55'),
(1545, 103, '2025-11-06', 3, 12.00, '2025-11-07 00:15:55', '2025-11-07 00:15:55'),
(1546, 4, '2025-11-07', 19, 7.00, '2025-11-08 00:45:01', '2025-11-08 00:45:01'),
(1547, 5, '2025-11-07', 20, 7.00, '2025-11-08 00:45:01', '2025-11-08 00:45:01'),
(1548, 6, '2025-11-07', 19, 9.00, '2025-11-08 00:45:01', '2025-11-08 00:45:01'),
(1549, 7, '2025-11-07', 18, 6.00, '2025-11-08 00:45:01', '2025-11-08 00:45:01'),
(1550, 9, '2025-11-07', 19, 7.00, '2025-11-08 00:45:01', '2025-11-08 00:45:01'),
(1551, 16, '2025-11-07', 18, 9.00, '2025-11-08 00:45:01', '2025-11-08 00:45:01'),
(1552, 18, '2025-11-07', 5, 5.00, '2025-11-08 00:45:01', '2025-11-08 00:45:01'),
(1553, 19, '2025-11-07', 15, 11.00, '2025-11-08 00:45:01', '2025-11-08 00:45:01'),
(1554, 28, '2025-11-07', 15, 10.00, '2025-11-08 00:45:01', '2025-11-08 00:45:01'),
(1555, 32, '2025-11-07', 20, 11.00, '2025-11-08 00:45:01', '2025-11-08 00:45:01'),
(1556, 34, '2025-11-07', 14, 13.00, '2025-11-08 00:45:01', '2025-11-08 00:45:01'),
(1557, 35, '2025-11-07', 12, 9.00, '2025-11-08 00:45:01', '2025-11-08 00:45:01'),
(1558, 36, '2025-11-07', 20, 12.00, '2025-11-08 00:45:01', '2025-11-08 00:45:01'),
(1559, 53, '2025-11-07', 12, 11.00, '2025-11-08 00:45:01', '2025-11-08 00:45:01'),
(1560, 54, '2025-11-07', 5, 12.00, '2025-11-08 00:45:01', '2025-11-08 00:45:01'),
(1561, 56, '2025-11-07', 20, 8.00, '2025-11-08 00:45:01', '2025-11-08 00:45:01'),
(1562, 57, '2025-11-07', 14, 9.00, '2025-11-08 00:45:01', '2025-11-08 00:45:01'),
(1563, 58, '2025-11-07', 12, 8.00, '2025-11-08 00:45:01', '2025-11-08 00:45:01'),
(1564, 87, '2025-11-07', 8, 19.00, '2025-11-08 00:45:01', '2025-11-08 00:45:01'),
(1565, 72, '2025-11-07', 5, 28.00, '2025-11-08 00:45:01', '2025-11-08 00:45:01'),
(1566, 74, '2025-11-07', 15, 3.00, '2025-11-08 00:45:01', '2025-11-08 00:45:01'),
(1567, 77, '2025-11-07', 20, 3.00, '2025-11-08 00:45:01', '2025-11-08 00:45:01'),
(1568, 109, '2025-11-07', 33, 13.00, '2025-11-08 00:45:01', '2025-11-08 00:45:01'),
(1569, 103, '2025-11-07', 3, 12.00, '2025-11-08 00:45:01', '2025-11-08 00:45:01'),
(1570, 4, '2025-11-08', 19, 7.00, '2025-11-08 19:52:50', '2025-11-08 19:52:50'),
(1571, 5, '2025-11-08', 20, 7.00, '2025-11-08 19:52:50', '2025-11-08 19:52:50'),
(1572, 6, '2025-11-08', 19, 9.00, '2025-11-08 19:52:50', '2025-11-08 19:52:50'),
(1573, 7, '2025-11-08', 18, 6.00, '2025-11-08 19:52:50', '2025-11-08 19:52:50'),
(1574, 9, '2025-11-08', 19, 7.00, '2025-11-08 19:52:50', '2025-11-08 19:52:50'),
(1575, 16, '2025-11-08', 18, 9.00, '2025-11-08 19:52:50', '2025-11-08 19:52:50'),
(1576, 18, '2025-11-08', 5, 5.00, '2025-11-08 19:52:50', '2025-11-08 19:52:50'),
(1577, 19, '2025-11-08', 15, 11.00, '2025-11-08 19:52:50', '2025-11-08 19:52:50'),
(1578, 28, '2025-11-08', 15, 10.00, '2025-11-08 19:52:50', '2025-11-08 19:52:50'),
(1579, 32, '2025-11-08', 20, 11.00, '2025-11-08 19:52:50', '2025-11-08 19:52:50'),
(1580, 34, '2025-11-08', 14, 13.00, '2025-11-08 19:52:50', '2025-11-08 19:52:50'),
(1581, 35, '2025-11-08', 12, 9.00, '2025-11-08 19:52:50', '2025-11-08 19:52:50'),
(1582, 36, '2025-11-08', 20, 12.00, '2025-11-08 19:52:50', '2025-11-08 19:52:50'),
(1583, 53, '2025-11-08', 12, 11.00, '2025-11-08 19:52:50', '2025-11-08 19:52:50'),
(1584, 54, '2025-11-08', 5, 12.00, '2025-11-08 19:52:50', '2025-11-08 19:52:50'),
(1585, 56, '2025-11-08', 20, 8.00, '2025-11-08 19:52:50', '2025-11-08 19:52:50'),
(1586, 57, '2025-11-08', 14, 9.00, '2025-11-08 19:52:50', '2025-11-08 19:52:50'),
(1587, 58, '2025-11-08', 12, 8.00, '2025-11-08 19:52:50', '2025-11-08 19:52:50'),
(1588, 87, '2025-11-08', 8, 19.00, '2025-11-08 19:52:50', '2025-11-08 19:52:50'),
(1589, 72, '2025-11-08', 5, 28.00, '2025-11-08 19:52:50', '2025-11-08 19:52:50'),
(1590, 74, '2025-11-08', 15, 3.00, '2025-11-08 19:52:50', '2025-11-08 19:52:50'),
(1591, 77, '2025-11-08', 20, 3.00, '2025-11-08 19:52:50', '2025-11-08 19:52:50'),
(1592, 109, '2025-11-08', 33, 13.00, '2025-11-08 19:52:50', '2025-11-08 19:52:50'),
(1593, 103, '2025-11-08', 3, 12.00, '2025-11-08 19:52:50', '2025-11-08 19:52:50'),
(1594, 4, '2026-01-23', 19, 7.00, '2026-01-23 18:56:13', '2026-01-23 18:56:13'),
(1595, 5, '2026-01-23', 20, 7.00, '2026-01-23 18:56:13', '2026-01-23 18:56:13'),
(1596, 6, '2026-01-23', 19, 9.00, '2026-01-23 18:56:13', '2026-01-23 18:56:13'),
(1597, 7, '2026-01-23', 18, 6.00, '2026-01-23 18:56:13', '2026-01-23 18:56:13'),
(1598, 9, '2026-01-23', 19, 7.00, '2026-01-23 18:56:13', '2026-01-23 18:56:13'),
(1599, 16, '2026-01-23', 18, 9.00, '2026-01-23 18:56:13', '2026-01-23 18:56:13'),
(1600, 18, '2026-01-23', 5, 5.00, '2026-01-23 18:56:13', '2026-01-23 18:56:13'),
(1601, 19, '2026-01-23', 15, 11.00, '2026-01-23 18:56:13', '2026-01-23 18:56:13'),
(1602, 28, '2026-01-23', 15, 10.00, '2026-01-23 18:56:13', '2026-01-23 18:56:13'),
(1603, 32, '2026-01-23', 20, 11.00, '2026-01-23 18:56:13', '2026-01-23 18:56:13'),
(1604, 34, '2026-01-23', 14, 13.00, '2026-01-23 18:56:13', '2026-01-23 18:56:13'),
(1605, 35, '2026-01-23', 12, 9.00, '2026-01-23 18:56:13', '2026-01-23 18:56:13'),
(1606, 36, '2026-01-23', 20, 12.00, '2026-01-23 18:56:13', '2026-01-23 18:56:13'),
(1607, 53, '2026-01-23', 12, 11.00, '2026-01-23 18:56:13', '2026-01-23 18:56:13'),
(1608, 54, '2026-01-23', 5, 12.00, '2026-01-23 18:56:13', '2026-01-23 18:56:13'),
(1609, 56, '2026-01-23', 20, 8.00, '2026-01-23 18:56:13', '2026-01-23 18:56:13'),
(1610, 57, '2026-01-23', 14, 9.00, '2026-01-23 18:56:13', '2026-01-23 18:56:13'),
(1611, 58, '2026-01-23', 12, 8.00, '2026-01-23 18:56:13', '2026-01-23 18:56:13'),
(1619, 4, '2026-01-31', 19, 7.00, '2026-01-31 18:41:57', '2026-01-31 18:41:57'),
(1620, 5, '2026-01-31', 20, 7.00, '2026-01-31 18:41:57', '2026-01-31 18:41:57'),
(1621, 6, '2026-01-31', 19, 9.00, '2026-01-31 18:41:57', '2026-01-31 18:41:57'),
(1622, 7, '2026-01-31', 18, 6.00, '2026-01-31 18:41:57', '2026-01-31 18:41:57'),
(1623, 9, '2026-01-31', 19, 7.00, '2026-01-31 18:41:57', '2026-01-31 18:41:57'),
(1624, 16, '2026-01-31', 18, 9.00, '2026-01-31 18:41:57', '2026-01-31 18:41:57'),
(1625, 18, '2026-01-31', 5, 5.00, '2026-01-31 18:41:57', '2026-01-31 18:41:57'),
(1626, 19, '2026-01-31', 15, 11.00, '2026-01-31 18:41:57', '2026-01-31 18:41:57'),
(1627, 28, '2026-01-31', 15, 10.00, '2026-01-31 18:41:57', '2026-01-31 18:41:57'),
(1628, 32, '2026-01-31', 20, 11.00, '2026-01-31 18:41:57', '2026-01-31 18:41:57'),
(1629, 34, '2026-01-31', 14, 13.00, '2026-01-31 18:41:57', '2026-01-31 18:41:57'),
(1630, 35, '2026-01-31', 12, 9.00, '2026-01-31 18:41:57', '2026-01-31 18:41:57'),
(1631, 36, '2026-01-31', 20, 12.00, '2026-01-31 18:41:57', '2026-01-31 18:41:57'),
(1632, 53, '2026-01-31', 12, 11.00, '2026-01-31 18:41:57', '2026-01-31 18:41:57'),
(1633, 54, '2026-01-31', 5, 12.00, '2026-01-31 18:41:57', '2026-01-31 18:41:57'),
(1634, 56, '2026-01-31', 20, 8.00, '2026-01-31 18:41:57', '2026-01-31 18:41:57'),
(1635, 57, '2026-01-31', 14, 9.00, '2026-01-31 18:41:57', '2026-01-31 18:41:57'),
(1636, 58, '2026-01-31', 12, 8.00, '2026-01-31 18:41:57', '2026-01-31 18:41:57'),
(1637, 87, '2026-01-31', 8, 19.00, '2026-01-31 18:41:57', '2026-01-31 18:41:57'),
(1638, 72, '2026-01-31', 5, 28.00, '2026-01-31 18:41:57', '2026-01-31 18:41:57'),
(1639, 74, '2026-01-31', 15, 3.00, '2026-01-31 18:41:57', '2026-01-31 18:41:57'),
(1640, 77, '2026-01-31', 20, 3.00, '2026-01-31 18:41:57', '2026-01-31 18:41:57'),
(1641, 109, '2026-01-31', 33, 13.00, '2026-01-31 18:41:57', '2026-01-31 18:41:57'),
(1642, 103, '2026-01-31', 3, 12.00, '2026-01-31 18:41:57', '2026-01-31 18:41:57'),
(1644, 5, '2026-02-01', 20, 7.00, '2026-02-01 23:15:00', '2026-02-01 23:15:00'),
(1645, 6, '2026-02-01', 19, 9.00, '2026-02-01 23:15:00', '2026-02-01 23:15:00'),
(1646, 7, '2026-02-01', 18, 6.00, '2026-02-01 23:15:00', '2026-02-01 23:15:00'),
(1647, 9, '2026-02-01', 19, 7.00, '2026-02-01 23:15:00', '2026-02-01 23:15:00'),
(1648, 16, '2026-02-01', 18, 9.00, '2026-02-01 23:15:00', '2026-02-01 23:15:00'),
(1649, 18, '2026-02-01', 5, 5.00, '2026-02-01 23:15:00', '2026-02-01 23:15:00'),
(1650, 19, '2026-02-01', 15, 11.00, '2026-02-01 23:15:00', '2026-02-01 23:15:00'),
(1651, 28, '2026-02-01', 15, 10.00, '2026-02-01 23:15:00', '2026-02-01 23:15:00'),
(1652, 32, '2026-02-01', 20, 11.00, '2026-02-01 23:15:00', '2026-02-01 23:15:00'),
(1653, 34, '2026-02-01', 14, 13.00, '2026-02-01 23:15:00', '2026-02-01 23:15:00'),
(1654, 35, '2026-02-01', 12, 9.00, '2026-02-01 23:15:00', '2026-02-01 23:15:00'),
(1655, 36, '2026-02-01', 20, 12.00, '2026-02-01 23:15:00', '2026-02-01 23:15:00'),
(1656, 53, '2026-02-01', 12, 11.00, '2026-02-01 23:15:00', '2026-02-01 23:15:00'),
(1657, 54, '2026-02-01', 5, 12.00, '2026-02-01 23:15:00', '2026-02-01 23:15:00'),
(1658, 56, '2026-02-01', 20, 8.00, '2026-02-01 23:15:00', '2026-02-01 23:15:00'),
(1659, 57, '2026-02-01', 14, 9.00, '2026-02-01 23:15:00', '2026-02-01 23:15:00'),
(1660, 58, '2026-02-01', 12, 8.00, '2026-02-01 23:15:00', '2026-02-01 23:15:00'),
(1661, 87, '2026-02-01', 8, 19.00, '2026-02-01 23:15:00', '2026-02-01 23:15:00'),
(1662, 72, '2026-02-01', 5, 28.00, '2026-02-01 23:15:00', '2026-02-01 23:15:00'),
(1663, 74, '2026-02-01', 15, 3.00, '2026-02-01 23:15:00', '2026-02-01 23:15:00'),
(1664, 77, '2026-02-01', 20, 3.00, '2026-02-01 23:15:00', '2026-02-01 23:15:00'),
(1665, 109, '2026-02-01', 33, 13.00, '2026-02-01 23:15:00', '2026-02-01 23:15:00'),
(1666, 103, '2026-02-01', 3, 12.00, '2026-02-01 23:15:00', '2026-02-01 23:15:00'),
(1667, 4, '2026-02-01', 17, 9.00, '2026-02-02 02:49:11', '2026-02-02 02:49:11');

-- --------------------------------------------------------

--
-- Table structure for table `popup`
--

CREATE TABLE `popup` (
  `id` int NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `url_imagen` varchar(500) NOT NULL,
  `link` varchar(500) NOT NULL COMMENT 'hacia donde se redireccionará',
  `veces_dia` int NOT NULL DEFAULT '1',
  `id_user_create` int NOT NULL,
  `fecha_visible` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `popup`
--

INSERT INTO `popup` (`id`, `nombre`, `url_imagen`, `link`, `veces_dia`, `id_user_create`, `fecha_visible`, `created_at`, `updated_at`) VALUES
(4, 'ClinicaPruebas', 'access/images/popular-img/1747948270_Captura de pantalla 2025-03-15 120822.png', 'https://pruebas.com', 3, 19, '2025-05-21', '2025-05-23 02:11:10', '2025-05-23 02:11:10'),
(5, 'sdadsdsssssssssss', 'access/images/popular-img/1748093868_WhatsApp Image 2025-05-23 at 12.27.27 PM.jpeg', 'https://pruebas.com', 1, 19, '2025-05-24', '2025-05-24 13:37:48', '2025-05-24 18:37:48'),
(9, 'sdadsd', 'access/images/popular-img/1748030264_WhatsApp Image 2025-05-23 at 12.27.27 PM.jpeg', 'https://pruebas.com', 1, 23, '2025-05-23', '2025-05-24 00:57:44', '2025-05-24 00:57:44'),
(10, 'asdad', 'access/images/popular-img/1748117890_Captura de pantalla 2025-05-24 a las 9.31.08 a. m..png', 'https://pruebas.com', 1, 23, '2025-05-24', '2025-05-24 20:18:10', '2025-05-25 01:18:10'),
(11, 'ClinicaPruebas', 'access/images/popular-img/1748120192_Captura de pantalla 2025-05-24 a las 9.31.08 a. m..png', 'https://pruebas.com', 1, 23, '2025-05-24', '2025-05-25 01:56:32', '2025-05-25 01:56:32'),
(12, 'ClinicaPruebas', 'access/images/popular-img/1748132202_pexels-fotios-photos-1540258.jpg', 'https://pruebas.com', 1, 23, '2025-05-25', '2025-05-25 05:16:42', '2025-05-25 05:16:42'),
(13, 'Pruebass', 'access/images/popular-img/1748607829_240cbafbcf556c99f4dabf45b0418de6.jpg', 'https://estacion90.pe', 2, 23, '2025-07-17', '2025-07-17 15:15:22', '2025-07-17 15:15:22');

-- --------------------------------------------------------

--
-- Table structure for table `popup_dia`
--

CREATE TABLE `popup_dia` (
  `id` int NOT NULL,
  `id_user_cliente` int NOT NULL,
  `id_popup` int NOT NULL,
  `fecha` date NOT NULL,
  `cant_vistas` int NOT NULL COMMENT 'aquí se iría acumulando la cantidad de vistas que ya tiene',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `popup_dia`
--

INSERT INTO `popup_dia` (`id`, `id_user_cliente`, `id_popup`, `fecha`, `cant_vistas`, `created_at`, `updated_at`) VALUES
(1, 23, 2, '2025-05-22', 3, '2025-05-22 22:56:38', '2025-05-23 03:56:38'),
(2, 23, 5, '2025-05-22', 1, '2025-05-23 03:56:41', '2025-05-23 03:56:41'),
(3, 1, 2, '2025-05-23', 3, '2025-05-23 00:23:55', '2025-05-23 05:23:55'),
(4, 23, 2, '2025-05-23', 1, '2025-05-23 21:10:45', '2025-05-23 21:10:45'),
(5, 23, 8, '2025-05-23', 1, '2025-05-23 21:46:48', '2025-05-23 21:46:48'),
(6, 1, 8, '2025-05-23', 1, '2025-05-23 21:52:26', '2025-05-23 21:52:26'),
(7, 23, 5, '2025-05-24', 1, '2025-05-24 18:38:24', '2025-05-24 18:38:24'),
(8, 21, 5, '2025-05-24', 1, '2025-05-24 18:47:12', '2025-05-24 18:47:12'),
(9, 1, 5, '2025-05-24', 1, '2025-05-25 01:11:43', '2025-05-25 01:11:43'),
(10, 21, 10, '2025-05-24', 1, '2025-05-25 01:58:39', '2025-05-25 01:58:39'),
(11, 1, 10, '2025-05-24', 1, '2025-05-25 02:54:05', '2025-05-25 02:54:05'),
(12, 1, 13, '2025-05-27', 1, '2025-05-27 13:30:44', '2025-05-27 13:30:44'),
(13, 23, 6, '2025-05-29', 2, '2025-05-29 14:14:56', '2025-05-29 19:14:56'),
(14, 23, 13, '2025-07-16', 2, '2025-07-16 16:31:27', '2025-07-16 16:31:27'),
(15, 26, 13, '2025-07-17', 2, '2025-07-17 15:15:55', '2025-07-17 15:15:55'),
(16, 23, 13, '2025-07-17', 2, '2025-07-17 15:17:59', '2025-07-17 15:17:59'),
(17, 1, 13, '2025-07-17', 2, '2025-07-17 17:59:35', '2025-07-17 17:59:35');

-- --------------------------------------------------------

--
-- Table structure for table `productos`
--

CREATE TABLE `productos` (
  `id` int NOT NULL,
  `id_categoria` int NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `descripcion` varchar(255) DEFAULT NULL,
  `imagen` varchar(255) DEFAULT NULL,
  `precio` decimal(10,2) NOT NULL,
  `stock` int NOT NULL DEFAULT '0',
  `estado` tinyint(1) DEFAULT NULL,
  `id_user_create` int DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `productos`
--

INSERT INTO `productos` (`id`, `id_categoria`, `nombre`, `descripcion`, `imagen`, `precio`, `stock`, `estado`, `id_user_create`, `created_at`, `updated_at`) VALUES
(1, 1, 'Ensalada mixta', 'Mix de vegetales cocidos', 'access/images/popular-img/1749580113_68487951a6b69.jpg', 0.00, 100, 1, NULL, '2025-06-10 18:29:08', '2025-06-10 18:29:08'),
(2, 1, 'Sopa de verduras', NULL, 'access/images/popular-img/sopa-verduras.png', 0.00, 100, 0, NULL, '2025-07-08 21:53:15', '2025-07-08 21:53:15'),
(3, 1, 'Ensalada de fideos', 'Fideos con pollo', 'access/images/popular-img/1749595092_6848b3d4e6b38.jpg', 0.00, 100, 0, NULL, '2025-07-08 21:53:43', '2025-07-08 21:53:43'),
(4, 1, 'Papa a la huancaína', 'descripcion de la papa', 'access/images/popular-img/papa-huancaina.png', 5.00, 0, 1, NULL, '2026-01-31 18:48:34', '2026-01-31 18:48:34'),
(5, 1, 'Tequeños', 'táquenos', 'access/images/popular-img/1748608704_6839a6c0ac93e.png', 0.00, 100, 1, NULL, '2025-05-30 12:38:24', '2025-05-30 12:38:24'),
(6, 1, 'Crema de zapallo', NULL, 'access/images/popular-img/causa.jpg', 0.00, 100, 0, NULL, '2025-07-08 20:53:18', '2025-07-08 20:53:18'),
(7, 1, 'Ensalada rusa', NULL, 'access/images/popular-img/causa.jpg', 0.00, 100, 0, NULL, '2025-06-10 18:17:58', '2025-06-10 18:17:58'),
(8, 1, 'Caldo de gallina', '1111', 'access/images/popular-img/gallina.jpg', 15.00, 0, 1, NULL, '2025-07-08 20:42:29', '2025-07-08 20:42:29'),
(9, 1, 'Ensalada de fideos', 'Fideos con pollo deshilachado y un toque de mayonesa', 'access/images/popular-img/1749580038_684879067dc54.jpg', 0.00, 100, 1, NULL, '2025-06-10 18:27:18', '2025-06-10 18:27:18'),
(10, 1, 'Ocopa', 'Ocopa al estilo arequipeño con papa, aceituna y huevo', 'access/images/popular-img/1749579609_6848775991096.jpg', 0.00, 100, 1, NULL, '2025-06-10 18:20:09', '2025-06-10 18:20:09'),
(11, 1, 'Wantan relleno', 'Masa wantan relleno con pollo acompañado con salsa BBQ', 'access/images/popular-img/1749579793_6848781144f71.jpg', 0.00, 100, 1, NULL, '2025-06-10 18:23:13', '2025-06-10 18:23:13'),
(12, 1, 'Mollejitas anticucheras', 'Mollejitas enticucheras con salsa huancaina', 'access/images/popular-img/1769885110_697e4db6713b8.jpg', 0.00, 0, 1, NULL, '2026-01-31 18:45:10', '2026-01-31 18:45:10'),
(13, 1, 'Choclo con queso', NULL, 'access/images/popular-img/causa.jpg', 0.00, 100, 1, NULL, '2025-05-10 18:34:12', '2025-04-10 03:05:53'),
(14, 1, 'Ensalada caprese', NULL, 'access/images/popular-img/causa.jpg', 0.00, 100, 0, NULL, '2025-07-08 21:58:31', '2025-07-08 21:58:31'),
(15, 1, 'Crema de champiñones', NULL, 'access/images/popular-img/causa.jpg', 0.00, 100, 0, NULL, '2025-07-08 20:53:08', '2025-07-08 20:53:08'),
(16, 2, 'Ceviche pescado', 'Ceviche de pescado', 'access/images/popular-img/ceviche-mixto.png', 20.00, 0, 1, NULL, '2025-07-09 15:54:59', '2025-07-09 15:54:59'),
(17, 2, 'Tiradito de pescado', NULL, 'access/images/popular-img/tiradito.png', 0.00, 100, 1, NULL, '2025-05-10 18:34:12', '2025-04-10 03:05:53'),
(18, 2, 'Papa rellena especial', NULL, 'access/images/popular-img/papa-rellena.png', 0.00, 100, 1, NULL, '2025-05-10 18:34:12', '2025-04-10 03:05:53'),
(19, 2, 'Leche de tigre', NULL, 'access/images/popular-img/leche-tigre.png', 0.00, 100, 1, NULL, '2025-05-10 18:34:12', '2025-04-10 03:05:53'),
(20, 2, 'Causa acevichada', NULL, 'access/images/popular-img/causa.jpg', 0.00, 100, 1, NULL, '2025-05-10 18:34:12', '2025-04-10 03:05:53'),
(21, 2, 'Tequeños de lomo', NULL, 'access/images/popular-img/tequenos.jpg', 0.00, 100, 1, NULL, '2025-05-10 18:34:12', '2025-04-10 03:05:53'),
(22, 2, 'Pulpo al olivo', NULL, 'access/images/popular-img/causa.jpg', 0.00, 100, 1, NULL, '2025-05-10 18:34:12', '2025-04-10 03:05:53'),
(23, 2, 'Cusa de pollo', 'Papa amarilla con palta y huevo', 'access/images/popular-img/1749593932_6848af4c263a8.jpeg', 0.00, 100, 1, NULL, '2025-06-10 22:18:52', '2025-06-10 22:18:52'),
(24, 2, 'Alitas BBQ', 'Alitas de pollo en salsa BBQ con ensalada fresca', 'access/images/popular-img/1749579446_684876b615293.jpg', 0.00, 100, 1, NULL, '2025-06-10 18:17:26', '2025-06-10 18:17:26'),
(25, 2, 'Wantán frito', NULL, 'access/images/popular-img/1769995753_697ffde910d8d.jpg', 0.00, 0, 1, NULL, '2026-02-02 01:29:13', '2026-02-02 01:29:13'),
(26, 2, 'Sashimi', NULL, 'access/images/popular-img/causa.jpg', 0.00, 100, 0, NULL, '2025-07-09 00:07:25', '2025-07-09 00:07:25'),
(27, 2, 'Ensalada César con pollo', NULL, 'access/images/popular-img/causa.jpg', 0.00, 100, 1, NULL, '2025-05-10 18:34:12', '2025-04-10 03:05:53'),
(28, 2, 'Palta rellena', 'Deliciosa palta rellena de pollo', 'access/images/popular-img/1749595197_6848b43db0583.jpeg', 0.00, 100, 1, NULL, '2025-06-10 22:39:57', '2025-06-10 22:39:57'),
(29, 2, 'Brochetas de pollo', NULL, 'access/images/popular-img/causa.jpg', 0.00, 100, 0, NULL, '2025-07-08 23:48:59', '2025-07-08 23:48:59'),
(30, 2, 'Causa langostinos', NULL, 'access/images/popular-img/causa.jpg', 0.00, 100, 1, NULL, '2025-05-10 18:34:12', '2025-04-10 03:05:53'),
(31, 3, 'Arroz con pollo', NULL, 'access/images/popular-img/arroz-pollo.png', 0.00, 100, 1, NULL, '2025-05-10 18:34:12', '2025-04-10 03:05:53'),
(32, 3, 'Tallarin rojo con pollo', NULL, 'access/images/popular-img/tallarin-rojo.png', 0.00, 100, 1, NULL, '2025-05-10 18:34:12', '2025-04-10 03:05:53'),
(33, 3, 'Seco de pollo c/frejoles', 'Seco de pollo con frejoles', 'access/images/popular-img/seco-pollo.png', 15.00, 0, 1, NULL, '2025-07-08 23:12:14', '2025-07-08 23:12:14'),
(34, 3, 'Pollo al horno c/puré', 'Pollo al horno con puré de papas', 'access/images/popular-img/1749588662_68489ab6b1d4f.jpg', 15.00, 0, 1, NULL, '2025-07-08 23:04:17', '2025-07-08 23:04:17'),
(35, 3, 'Estofado de pollo', 'Estofado de pollo', 'access/images/popular-img/estofado.png', 15.00, 0, 1, NULL, '2025-07-08 22:52:37', '2025-07-08 22:52:37'),
(36, 3, 'Tallarines verdes c/bisteck', 'Tallarines verdes con bisteck', 'access/images/popular-img/tallarin-verde.png', 15.00, 0, 1, NULL, '2025-07-08 23:16:54', '2025-07-08 23:16:54'),
(37, 3, 'Arroz chaufa', NULL, 'access/images/popular-img/chaufa.png', 0.00, 100, 1, NULL, '2025-05-10 18:34:12', '2025-04-10 03:05:53'),
(38, 3, 'Lentejas con hígado', 'Lentejas con hígado', 'access/images/popular-img/causa.jpg', 12.00, 0, 1, NULL, '2025-07-08 22:39:47', '2025-07-08 22:39:47'),
(39, 3, 'Ají de gallina', NULL, 'access/images/popular-img/aji.png', 0.00, 100, 1, NULL, '2025-05-10 18:34:12', '2025-04-10 03:05:53'),
(40, 3, 'Caigua rellena', NULL, 'access/images/popular-img/causa.jpg', 0.00, 100, 1, NULL, '2025-05-10 18:34:12', '2025-04-10 03:05:53'),
(41, 3, 'Tallarín saltado pollo', NULL, 'access/images/popular-img/causa.jpg', 0.00, 100, 1, NULL, '2025-05-10 18:34:12', '2025-04-10 03:05:53'),
(42, 3, 'Filete de pollo con verduras cocidas', 'Pollo a la plancha con verduras cocidas y arroz blanco', 'access/images/popular-img/1749577046_68486d56efedd.jpg', 0.00, 100, 1, NULL, '2025-06-10 17:37:26', '2025-06-10 17:37:26'),
(43, 3, 'Picante de carne', NULL, 'access/images/popular-img/causa.jpg', 0.00, 100, 1, NULL, '2025-05-10 18:34:12', '2025-04-10 03:05:53'),
(44, 3, 'Pollo saltado', 'Pollo saltado al wok con papas fritas y arroz', 'access/images/popular-img/1749579301_68487625cf6c4.jpg', 0.00, 100, 1, NULL, '2025-06-10 18:15:01', '2025-06-10 18:15:01'),
(45, 3, 'Arroz tapado', 'Arroz con carne molida, plátano frito y huevo frito montado', 'access/images/popular-img/1749576948_68486cf472744.jpg', 0.00, 100, 1, NULL, '2025-06-10 17:35:48', '2025-06-10 17:35:48'),
(46, 3, 'Chanfainita', 'cambia la foto', 'access/images/popular-img/1749590261_6848a0f53c5cb.jpg', 0.00, 100, 1, NULL, '2025-06-10 21:17:41', '2025-06-10 21:17:41'),
(47, 3, 'Cau cau', 'Cau cau con arroz blanco', 'access/images/popular-img/1749578833_684874514205f.jpg', 0.00, 100, 1, NULL, '2025-06-10 18:07:13', '2025-06-10 18:07:13'),
(48, 3, 'Sopa seca', NULL, 'access/images/popular-img/causa.jpg', 0.00, 100, 1, NULL, '2025-05-10 18:34:12', '2025-04-10 03:05:53'),
(49, 3, 'Escabeche de pollo', 'Pollo al escabeche con arroz y camote', 'access/images/popular-img/1749579122_6848757276737.jpg', 0.00, 100, 1, NULL, '2025-06-10 18:12:02', '2025-06-10 18:12:02'),
(50, 3, 'Carapulcra c/sopa seca', 'Carapulcra con sopa seca', 'access/images/popular-img/causa.jpg', 15.00, 0, 1, NULL, '2025-07-08 23:25:30', '2025-07-08 23:25:30'),
(51, 4, 'Lomo saltado', 'Con papas fritas y arroz', 'access/images/popular-img/1749590845_6848a33d9644b.jpg', 0.00, 100, 1, NULL, '2025-06-10 21:27:26', '2025-06-10 21:27:26'),
(52, 4, 'Tacu Tacu', 'Arroz en tacu tacu', 'access/images/popular-img/1749591916_6848a76c55bcf.jpeg', 0.00, 100, 1, NULL, '2025-06-10 21:45:16', '2025-06-10 21:45:16'),
(53, 4, 'Pescado frito', NULL, 'access/images/popular-img/pescado-frito.png', 0.00, 100, 0, NULL, '2025-06-10 21:31:44', '2025-06-10 21:31:44'),
(54, 4, 'Carapulcra', 'Carapoulcra', 'access/images/popular-img/1749592108_6848a82cc80cc.jpeg', 0.00, 100, 1, NULL, '2025-06-10 21:48:29', '2025-06-10 21:48:29'),
(55, 4, 'Seco de cabrito', NULL, 'access/images/popular-img/seco-cabrito.png', 0.00, 100, 0, NULL, '2025-06-10 21:31:14', '2025-06-10 21:31:14'),
(56, 4, 'Arroz con mariscos', 'sss', 'access/images/popular-img/1752095759_686edc0f63856.jpg', 20.00, 0, 1, NULL, '2025-07-09 21:15:59', '2025-07-09 21:15:59'),
(57, 4, 'Pollada 90', 'Con papas doradas,arroz y ensalada', 'access/images/popular-img/1749591428_6848a58421cc8.jpg', 0.00, 100, 1, NULL, '2025-06-10 21:37:08', '2025-06-10 21:37:08'),
(58, 4, 'Milanesa de pollo', 'Con papas fritas y ensalada', 'access/images/popular-img/1749591379_6848a55323543.jpg', 0.00, 100, 1, NULL, '2025-06-10 21:36:19', '2025-06-10 21:36:19'),
(59, 4, 'Arroz con pato', 'Pato tierno con arroz verde y sasrza criolla', 'access/images/popular-img/1749580427_68487a8b706b3.jpg', 0.00, 100, 1, NULL, '2025-06-10 18:33:47', '2025-06-10 18:33:47'),
(60, 4, 'Lasagna de carne', 'Con bastante queso', 'access/images/popular-img/1749591489_6848a5c18aa2a.jpg', 0.00, 100, 1, NULL, '2025-06-10 21:38:10', '2025-06-10 21:38:10'),
(61, 4, 'Arroz con chancho', 'Chanchito crocante con su ensaldita', 'access/images/popular-img/1749591789_6848a6edecd11.jpeg', 27.90, 100, 1, NULL, '2025-06-10 22:03:28', '2025-06-10 22:03:28'),
(62, 4, 'Rocoto relleno', NULL, 'access/images/popular-img/causa.jpg', 0.00, 100, 0, NULL, '2025-06-10 21:31:26', '2025-06-10 21:31:26'),
(63, 4, 'Duo de pastas con lomo', 'Al pesto y huancaina', 'access/images/popular-img/1749595229_6848b45d1c142.jpeg', 0.00, 100, 1, NULL, '2025-06-10 22:40:29', '2025-06-10 22:40:29'),
(64, 4, 'Chancho al cilindro', NULL, 'access/images/popular-img/causa.jpg', 0.00, 100, 0, NULL, '2025-06-10 21:30:34', '2025-06-10 21:30:34'),
(65, 4, 'Cabrito con frijoles', 'Delicioso cabrito norteño con frejoles', 'access/images/popular-img/1749590177_6848a0a1af9fd.jpg', 0.00, 100, 1, NULL, '2025-06-10 21:16:18', '2025-06-10 21:16:18'),
(66, 4, 'Asado con puré', 'De carne coin arroz', 'access/images/popular-img/1749591605_6848a63551082.jpeg', 0.00, 100, 1, NULL, '2025-06-10 21:40:05', '2025-06-10 21:40:05'),
(67, 4, 'Arroz con langostinos', 'Arroz arricotado con langostinos', 'access/images/popular-img/1749590126_6848a06e404c1.jpg', 0.00, 100, 1, NULL, '2025-06-10 21:15:27', '2025-06-10 21:15:27'),
(68, 4, 'Cordero al palo', NULL, 'access/images/popular-img/causa.jpg', 0.00, 100, 0, NULL, '2025-06-10 21:31:02', '2025-06-10 21:31:02'),
(69, 4, 'Trucha frita', 'Con arroz y sarza criolla', 'access/images/popular-img/1749590728_6848a2c87576b.jpg', 0.00, 100, 1, NULL, '2025-06-10 21:25:29', '2025-06-10 21:25:29'),
(70, 4, 'Chaufa amazónico', 'con cecina y chorizo de la selva', 'access/images/popular-img/1749590602_6848a24a53683.jpeg', 0.00, 100, 1, NULL, '2025-06-10 21:23:22', '2025-06-10 21:23:22'),
(71, 6, 'Combo Familiar', '4 fondos + 4 bebidas', 'access/images/popular-img/causa.jpg', 60.00, 50, 1, NULL, '2025-05-20 07:17:44', '2025-04-10 03:05:53'),
(72, 6, 'Combo Pareja', '2 fondos + 2 bebidas', 'access/images/popular-img/causa.jpg', 35.00, 50, 1, NULL, '2025-05-20 07:17:44', '2025-04-10 03:05:53'),
(73, 6, 'Combo Ejecutivo', '1 fondo + bebida + postre', 'access/images/popular-img/causa.jpg', 25.00, 50, 1, NULL, '2025-05-20 07:17:44', '2025-04-10 03:05:53'),
(74, 7, 'Marciano fresa', NULL, 'access/images/popular-img/causa.jpg', 1.50, 200, 1, NULL, '2025-05-20 07:16:40', '2025-04-10 03:05:53'),
(75, 7, 'Marciano mango', NULL, 'access/images/popular-img/causa.jpg', 1.50, 200, 1, NULL, '2025-05-20 07:16:40', '2025-04-10 03:05:53'),
(76, 7, 'Inca Kola 500 ml helada', NULL, 'access/images/popular-img/causa.jpg', 2.00, 200, 1, NULL, '2025-05-20 07:16:40', '2025-04-10 03:05:53'),
(77, 7, 'Coca‑Cola 600 ml', 'Coca cola 600 ml', 'access/images/popular-img/1752079308_686e9bcc830de.jpg', 5.00, 0, 1, NULL, '2025-07-09 16:41:48', '2025-07-09 16:41:48'),
(78, 7, 'Inca Kola 500 ml sin helar', NULL, 'access/images/popular-img/causa.jpg', 2.00, 200, 1, NULL, '2025-05-20 07:16:40', '2025-04-10 03:05:53'),
(79, 7, 'Coca‑Cola 600 ml sin azúcar', 'Coca - cola 600 ml sin azúcar', 'access/images/popular-img/1752079395_686e9c23f197e.png', 6.00, 0, 1, NULL, '2025-07-09 16:43:16', '2025-07-09 16:43:16'),
(80, 7, 'Chicha morada jarra', 'Chicha de maíz morado con piña', 'access/images/popular-img/1752096111_686edd6fce2b3.jpg', 18.00, 0, 1, NULL, '2025-07-09 21:21:52', '2025-07-09 21:21:52'),
(81, 1, 'ejemplo 10', 'descripcion', 'productos/HLdJjO8SlW1nei4zjhP8Jd9MWDkGtlFKDEN8bGky.png', 1.00, 150, 0, 1, '2025-05-12 15:23:36', '2025-05-12 20:23:36'),
(82, 1, 'ejemplo tinq', 'asdasd', 'access/images/popular-img/1747155629_68237aad0bdc9.png', 23.00, 90, 0, 21, '2025-05-13 17:00:44', '2025-05-13 22:00:44'),
(83, 7, 'dasdad', 'QWQ', 'access/images/popular-img/1752105005_686f002dd5f97.jpg', 12.00, 0, 0, 1, '2025-07-14 20:33:11', '2025-07-14 20:33:11'),
(84, 7, 'dd', 'sadasd', 'access/images/popular-img/1747155805_68237b5d76a7c.png', 21.00, 12, 0, 1, '2025-07-08 21:56:09', '2025-07-08 21:56:09'),
(85, 1, 'ejemplo 20254', 'descripcion general', 'access/images/popular-img/1747155709_68237afd89856.png', 1.00, 125, 0, 1, '2025-05-20 18:02:48', '2025-05-20 23:02:48'),
(86, 7, 'Jugo de maracuyá jarra', 'jugo de maracuya esencia', 'access/images/popular-img/1747673465_682b61791d487.jpg', 18.00, 0, 1, 1, '2025-07-09 16:35:06', '2025-07-09 16:35:06'),
(87, 5, 'CartaProd', '111', 'access/images/popular-img/1747757152_682ca860751e5.jpg', 11.00, 22, 0, 23, '2025-06-10 20:08:36', '2025-06-10 20:08:36'),
(88, 7, 'Jugo Maracuyá vaso', 'Jugo de maracuya vaso', 'access/images/popular-img/1748019095_6830a7976ed6c.jpg', 7.00, 0, 1, 1, '2025-07-09 16:36:06', '2025-07-09 16:36:06'),
(89, 6, 'Combo primavera', 'ceviche mixto + tiradito de maracuya + chaufa amazonico', 'access/images/popular-img/1752078729_686e9989de7e4.png', 0.00, 0, 1, 1, '2025-07-09 16:32:10', '2025-07-09 16:32:10'),
(90, 7, 'Chicha morada vaso', 'Chicha de maíz morado con piña', 'access/images/popular-img/1752096053_686edd351e26d.jpg', 7.00, 0, 1, 23, '2025-07-09 21:20:53', '2025-07-09 21:20:53'),
(91, 5, 'PRUEBASHEIC', '11', 'access/images/popular-img/1749583078_684884e63ca61.jpg', 11.00, 11, 1, 23, '2025-06-10 19:17:58', '2025-06-10 19:17:58'),
(92, 5, 'Estacionpruebas1', 'sadsd', 'access/images/popular-img/1749583430_684886467aac1.jpg', 11.00, 11, 1, 23, '2025-06-10 19:23:51', '2025-06-10 19:23:51'),
(93, 5, 'Estacionpruebas2', 'pruebas', 'access/images/popular-img/1749583566_684886ce3fd87.jpg', 11.00, 11, 1, 23, '2025-06-10 19:26:06', '2025-06-10 19:26:06'),
(94, 5, '11', '11', 'access/images/popular-img/1749586089_684890a984959.jpg', 11.00, 11, 0, 23, '2025-07-08 20:24:37', '2025-07-08 20:24:37'),
(95, 5, '11', '11', 'access/images/popular-img/1749586108_684890bced246.png', 11.00, 11, 0, 23, '2025-07-08 20:25:11', '2025-07-08 20:25:11'),
(96, 4, 'Lomo con tallarines a la huancaina', 'Tallarines con salda huancaina y lomo saltado', 'access/images/popular-img/1749592985_6848ab992a8de.jpg', 27.90, 10, 1, 1, '2025-06-10 22:03:05', '2025-06-10 22:03:05'),
(97, 4, 'Milanesa con pasata en huancaina', 'Coditos en salsa huancaina y milanesa de pollo', 'access/images/popular-img/1749594060_6848afcc57527.jpeg', 0.00, 4, 1, 1, '2025-06-10 22:21:00', '2025-06-10 22:21:00'),
(98, 5, 'ejemplo 10', 'fdgfdg', 'access/images/popular-img/1752078695_686e996748d5d.png', 0.00, 0, 1, 1, '2025-07-09 16:31:35', '2025-07-09 16:31:35'),
(99, 5, 'carta 2', 'carta 2', 'access/images/popular-img/1747889746_682eae52af775.jpg', 10.00, 10, 0, 1, '2025-07-09 01:09:13', '2025-07-09 01:09:13'),
(100, 5, 'ejemplo 10', 'arroz con pollo', 'access/images/popular-img/1749534668_6847c7cc5257a.png', 14.00, 10, 1, 1, '2025-06-10 10:51:08', '2025-06-10 10:51:08'),
(101, 5, 'Arroz con langostinos', 'Arroz completo con mariscos Arroz completo con mariscos Arroz completo con mariscos', 'access/images/popular-img/1752023334_686dc12654850.jpg', 30.00, 0, 1, 1, '2025-07-09 01:08:55', '2025-07-09 01:08:55'),
(102, 8, 'Caldo de verduras', 'descripcion', 'access/images/popular-img/1750355115_68544caba320e.jpg', 19.00, 1, 1, 1, '2025-06-19 22:45:15', '2025-06-19 22:45:15'),
(103, 8, 'Caldo dieta', 'c', 'access/images/popular-img/1750355308_68544d6c9392c.jpg', 12.00, 1, 1, 1, '2025-06-19 22:48:28', '2025-06-19 22:48:28'),
(104, 8, 'caldo de gallina', 'descripcion', 'access/images/popular-img/1750355378_68544db27b04b.jpg', 20.00, 2, 1, 1, '2025-06-19 22:49:38', '2025-06-19 22:49:38'),
(105, 8, 'Caldo de pollo', 'd', 'access/images/popular-img/1750355397_68544dc5e5da5.jpg', 14.00, 1, 1, 1, '2025-06-19 22:49:57', '2025-06-19 22:49:57'),
(106, 8, 'Caldo completo', 'dd', 'access/images/popular-img/1750355440_68544df03c968.jpg', 123.00, 1, 1, 1, '2025-06-19 22:50:40', '2025-06-19 22:50:40'),
(107, 9, 'Pan con pejerrey', 'Pejerrey arrebozado con lechuga, sarza y tártara en pan ciabatta. Café o jugo a elección', 'access/images/popular-img/1752077849_686e96194779a.jpeg', 16.00, 0, 1, 1, '2025-07-09 16:17:29', '2025-07-09 16:17:29'),
(108, 9, 'Pan con chicharrón', 'Chicharrón de panceta, camote frito y sarza en pan frances. Café o jugo a elección', 'access/images/popular-img/1752078333_686e97fdde49a.jpg', 16.00, 0, 1, 1, '2025-07-09 16:25:34', '2025-07-09 16:25:34'),
(109, 9, 'Lomito al jugo', 'Lomito salteado con cebolla, tomate y ají amarillo, en pan ciabatta. Café o jugo a elección.', 'access/images/popular-img/1752078301_686e97dd0c2e2.jpg', 13.00, 0, 1, 1, '2025-07-09 16:25:01', '2025-07-09 16:25:01'),
(110, 9, 'Huachana', 'Salchicha de huacho revuelto con huevo en pan ciabatta. Café o jugo a elección,', 'access/images/popular-img/1752078427_686e985bf3cdd.jpeg', 8.00, 0, 1, 1, '2025-07-09 16:27:08', '2025-07-09 16:27:08'),
(111, 5, 'Carta 6', '6', 'access/images/popular-img/1750357742_685456eeca78e.jpg', 15.00, 44, 1, 1, '2025-06-19 23:29:02', '2025-06-19 23:29:02'),
(112, 5, 'carta 7', '7', 'access/images/popular-img/1750357768_6854570849858.jpg', 23.00, 1, 1, 1, '2025-06-19 23:29:28', '2025-06-19 23:29:28'),
(113, 5, 'carta 8', 'c', 'access/images/popular-img/1750357871_6854576f95fc6.jpg', 16.00, 1, 1, 1, '2025-06-19 23:30:31', '2025-06-19 23:31:11'),
(114, 8, 'caldos', '111', 'access/images/popular-img/1752007407_686d82ef0f4ad.png', 11.00, 0, 1, 23, '2025-07-08 20:43:27', '2025-07-08 20:43:27'),
(115, 1, 'Sopa a la minuta', 'sopa  a la minuta', 'access/images/popular-img/1752084871_686eb1877ca4a.jpg', 15.00, 0, 1, 1, '2025-07-09 18:14:31', '2025-07-09 18:14:31'),
(116, 1, 'Palta rellena', 'Palta rellena', NULL, 15.00, 0, 1, 1, '2025-07-08 20:48:18', '2025-07-08 20:48:18'),
(117, 1, 'Ensalada de casa', 'Ensalada de casa', NULL, 15.00, 0, 1, 1, '2025-07-08 20:49:07', '2025-07-08 20:49:07'),
(118, 1, 'Ensalada cesar', 'Ensalada cesar', NULL, 15.00, 0, 1, 1, '2025-07-08 21:52:26', '2025-07-08 21:52:26'),
(119, 1, 'Sancochado', 'Sopa sancochado', NULL, 15.00, 0, 1, 1, '2025-07-08 21:54:06', '2025-07-08 21:54:06'),
(120, 1, 'Alitas BBQ', 'Alitas BBQ', 'access/images/popular-img/1752083869_686ead9d815fe.png', 15.00, 0, 1, 1, '2025-07-09 17:57:50', '2025-07-09 17:57:50'),
(121, 1, 'Causa de pollo', 'Causa de pollo', NULL, 15.00, 0, 1, 1, '2025-07-08 21:55:21', '2025-07-08 21:55:21'),
(122, 1, 'Ensalada delicia', 'Ensalada delicia', NULL, 15.00, 0, 1, 1, '2025-07-08 21:55:52', '2025-07-08 21:55:52'),
(123, 1, 'Sopa de sémola', 'Sopa de sémola', NULL, 15.00, 0, 1, 1, '2025-07-08 21:56:52', '2025-07-08 21:56:52'),
(124, 1, 'Patacones', 'Patacones con cocona', NULL, 15.00, 0, 1, 1, '2025-07-08 21:57:17', '2025-07-08 21:57:17'),
(125, 1, 'Alitas broaster', 'Alitas broaster', NULL, 15.00, 0, 1, 1, '2025-07-08 21:57:54', '2025-07-08 21:57:54'),
(126, 1, 'Ocopa', 'Ocopa', NULL, 15.00, 0, 0, 1, '2025-07-08 21:58:59', '2025-07-08 21:58:59'),
(127, 1, 'Wantan relleno', 'Wantan relleno', NULL, 15.00, 0, 0, 1, '2025-07-08 22:28:27', '2025-07-08 22:28:27'),
(128, 1, 'Sopa morón', 'Sopa morón con menudencia', NULL, 15.00, 0, 0, 1, '2025-07-08 22:27:36', '2025-07-08 22:27:36'),
(129, 1, 'Sopa morón', 'sopa de morón con menudencia', NULL, 15.00, 0, 0, 1, '2025-07-08 22:27:55', '2025-07-08 22:27:55'),
(130, 1, 'Sopa moron', 'sopo moron con menudencia', NULL, 15.00, 0, 1, 1, '2025-07-08 22:02:29', '2025-07-08 22:02:29'),
(131, 1, 'Sopa morón', 'sopa morón con menudencia', NULL, 15.00, 0, 0, 1, '2025-07-08 22:28:08', '2025-07-08 22:28:08'),
(132, 1, 'Soltero de queso', 'Soltero de queso', NULL, 15.00, 0, 1, 1, '2025-07-08 22:30:16', '2025-07-08 22:30:16'),
(133, 1, 'Causa de atún', 'Causa de atún', NULL, 15.00, 0, 1, 1, '2025-07-08 22:30:43', '2025-07-08 22:30:43'),
(134, 1, 'Alitas Thai', 'Alitas Thai', NULL, 15.00, 0, 1, 1, '2025-07-08 22:31:20', '2025-07-08 22:31:20'),
(135, 1, 'Chicharrón de pota', 'Chicharrón de pota', NULL, 15.00, 0, 1, 1, '2025-07-08 22:31:47', '2025-07-08 22:31:47'),
(136, 1, 'Menestrón', 'Sopa menestron', NULL, 15.00, 0, 1, 1, '2025-07-08 22:32:41', '2025-07-08 22:32:41'),
(137, 1, 'Alitas acevichadas', 'Alitas de pollo acevichadas', 'access/images/popular-img/1752085971_686eb5d3544e6.jpg', 15.00, 0, 1, 1, '2025-07-09 18:32:51', '2025-07-09 18:32:51'),
(138, 1, 'Aguadito', 'Sopa aguadito', 'access/images/popular-img/1752083721_686ead0982cbf.jpg', 7.50, 0, 1, 1, '2025-07-30 01:39:53', '2025-07-30 01:39:53'),
(139, 1, 'Ceviche de pota', 'Ceviche de pota', NULL, 15.00, 0, 1, 1, '2025-07-08 22:35:04', '2025-07-08 22:35:04'),
(140, 1, 'Salpicón de atún', 'Salpicón de atún', NULL, 15.00, 0, 1, 1, '2025-07-08 22:35:53', '2025-07-08 22:35:53'),
(141, 1, 'Sopa de frejol con carne', 'Sopa de frejol con carne', NULL, 15.00, 0, 1, 1, '2025-07-08 22:36:39', '2025-07-08 22:36:39'),
(142, 1, 'Ensalada fresca', 'Ensalada de verduras fresca', NULL, 15.00, 0, 1, 1, '2025-07-08 22:37:18', '2025-07-08 22:37:18'),
(143, 1, 'Huevo a la reina', 'Huevo a la reina', NULL, 15.00, 0, 1, 1, '2025-07-08 22:37:52', '2025-07-08 22:37:52'),
(144, 3, 'Pollo c/champiñones', 'Pollo en salsa de champiñones', NULL, 15.00, 0, 1, 1, '2025-07-08 22:54:35', '2025-07-08 22:54:35'),
(145, 3, 'Locro con filete de pollo', 'Locro con filete de pollo', NULL, 15.00, 0, 1, 1, '2025-07-08 22:44:14', '2025-07-08 22:44:14'),
(146, 3, 'Pollo a la olla c/puré de espinaca', 'Pollo a la olla con puré de espinaca', NULL, 15.00, 0, 1, 1, '2025-07-08 22:45:24', '2025-07-08 22:45:24'),
(147, 3, 'Patita con maní', 'Patita con maní', NULL, 15.00, 0, 1, 1, '2025-07-08 22:46:18', '2025-07-08 22:46:18'),
(148, 3, 'Lomito salteado', 'Lomito salteado', NULL, 15.00, 0, 1, 1, '2025-07-08 23:18:49', '2025-07-08 23:18:49'),
(149, 3, 'Pasta corta al Alfredo con filete de pollo', 'Pasta corta al Alfredo con filete de pollo', NULL, 15.00, 0, 1, 1, '2025-07-08 22:48:37', '2025-07-08 22:48:37'),
(150, 3, 'Sudado de pescado', 'Sudado de pescado del día', NULL, 15.00, 0, 1, 1, '2025-07-08 22:49:17', '2025-07-08 22:49:17'),
(151, 3, 'Pollo strogonof', 'Pollo strogonof', NULL, 15.00, 0, 1, 1, '2025-07-08 22:50:24', '2025-07-08 22:50:24'),
(152, 3, 'Pollo a la olla c/camote glaseado', 'Pollo a la olla con camote glaseado', NULL, 15.00, 0, 1, 1, '2025-07-08 22:54:09', '2025-07-08 22:54:09'),
(153, 3, 'Vainita salteada c/carne', 'Vainita salteada con carne', NULL, 15.00, 0, 1, 1, '2025-07-08 23:46:07', '2025-07-08 23:46:07'),
(154, 3, 'Arroz a la jardinera con carne', 'Arroz a la jardinera', NULL, 15.00, 0, 1, 1, '2025-07-08 22:52:15', '2025-07-08 22:52:15'),
(155, 3, 'Chuleta BBQ', 'Chuleta de cerdo en salsa BBQ', NULL, 15.00, 0, 1, 1, '2025-07-08 22:53:45', '2025-07-08 22:53:45'),
(156, 3, 'Broaster c/papas fritas', 'Pollo broaster con papas fritas', NULL, 15.00, 0, 1, 1, '2025-07-08 23:03:42', '2025-07-08 23:03:42'),
(157, 3, 'Pescado a la chorrillana', 'Pesca del día a la chorrillana', NULL, 15.00, 0, 1, 1, '2025-07-08 23:05:12', '2025-07-08 23:05:12'),
(158, 3, 'Pollo salteado c/lentejas', 'Pollo salteado con lentejas', NULL, 15.00, 0, 1, 1, '2025-07-08 23:07:01', '2025-07-08 23:07:01'),
(159, 3, 'Ceviche de pollo', 'Ceviche de pollo', NULL, 15.00, 0, 1, 1, '2025-07-08 23:08:30', '2025-07-08 23:08:30'),
(160, 3, 'Olliquito con carne', 'Olluquito con carne', NULL, 15.00, 0, 1, 1, '2025-07-08 23:09:19', '2025-07-08 23:09:19'),
(161, 3, 'Escabeche de pescado', 'Escabeche de pescado', NULL, 15.00, 0, 1, 1, '2025-07-08 23:10:42', '2025-07-08 23:10:42'),
(162, 3, 'Churrasco c/papas fritas', 'Churrasco con papas fritas', NULL, 15.00, 0, 1, 1, '2025-07-08 23:11:35', '2025-07-08 23:11:35'),
(163, 3, 'Pollo al horno c/arroz arabe', 'Pollo al horno con arroz árabe', NULL, 15.00, 0, 1, 1, '2025-07-08 23:13:27', '2025-07-08 23:13:27'),
(164, 3, 'Pollo al maní', 'Pollo al maní', NULL, 15.00, 0, 1, 1, '2025-07-08 23:14:21', '2025-07-08 23:14:21'),
(165, 3, 'Tallarines verdes c/filete de pollo', 'Tallarines verdes con filete de pollo', NULL, 15.00, 0, 1, 1, '2025-07-08 23:17:23', '2025-07-08 23:17:23'),
(166, 3, 'Chijaukay con verduras', 'Pollo chijaukay con verduras', NULL, 15.00, 0, 1, 1, '2025-07-08 23:18:14', '2025-07-08 23:18:14'),
(167, 3, 'Hamburguesa c/papas', 'Hamburguesa de carne con papas', NULL, 15.00, 0, 1, 1, '2025-07-08 23:19:35', '2025-07-08 23:19:35'),
(168, 3, 'Pollo al horno c/arveja', 'Pollo al horno con arveja partida', NULL, 15.00, 0, 1, 1, '2025-07-08 23:20:35', '2025-07-08 23:20:35'),
(169, 3, 'Chicharrón de pollo', 'Chicharrón de pollo', NULL, 15.00, 0, 1, 1, '2025-07-08 23:21:49', '2025-07-08 23:21:49'),
(170, 3, 'Hígado encebollado c/arverja', 'Higado encebollado c/arverja', NULL, 15.00, 0, 1, 1, '2025-07-08 23:22:45', '2025-07-08 23:22:45'),
(171, 3, 'Pollo al sillao c/camote', 'Pollo al sillao con camote', NULL, 15.00, 0, 1, 1, '2025-07-08 23:23:36', '2025-07-08 23:23:36'),
(172, 3, 'Pasta a la bologñesa', 'Pasta a la bologñesa', NULL, 15.00, 0, 1, 1, '2025-07-08 23:24:54', '2025-07-08 23:24:54'),
(173, 3, 'Pollo a la olla c/garbanzo', 'Pollo a la olla con garbanzo', NULL, 15.00, 0, 1, 1, '2025-07-08 23:26:12', '2025-07-08 23:26:12'),
(174, 3, 'Arroz con cerdo', 'Arroz con cerdo', NULL, 15.00, 0, 1, 1, '2025-07-08 23:26:34', '2025-07-08 23:26:34'),
(175, 3, 'Lenteja con pollo a la olla', 'Lenteja con pollo a la olla', NULL, 15.00, 0, 1, 1, '2025-07-08 23:28:48', '2025-07-08 23:28:48'),
(176, 3, 'Pasta corta en salsa blanca c/filete', 'Pasta corta en salsa blanca con filete de pollo', NULL, 15.00, 0, 1, 1, '2025-07-08 23:30:28', '2025-07-08 23:30:28'),
(177, 3, 'Teriyaki c/camote glaseado', 'Teriyaki con camote glaseado', NULL, 15.00, 0, 1, 1, '2025-07-08 23:31:21', '2025-07-08 23:31:21'),
(178, 3, 'Pachamanca a la olla', 'Pachamanca de pollo', NULL, 15.00, 0, 1, 1, '2025-07-08 23:31:46', '2025-07-08 23:31:46'),
(179, 3, 'Tallarines verdes c/pollo al horno', 'Tallarines verdes con pollo al horno', NULL, 15.00, 0, 1, 1, '2025-07-08 23:32:26', '2025-07-08 23:32:26'),
(180, 3, 'Mondonguito a la italiana', 'Mondonguito a la italiana', 'access/images/popular-img/1769885151_697e4ddf2479e.jpg', 15.00, 0, 1, 1, '2026-01-31 18:45:51', '2026-01-31 18:45:51'),
(181, 3, 'Guiso de trigo con churrasco', 'Guiso de trigo con churrasco', NULL, 15.00, 0, 1, 1, '2025-07-08 23:33:33', '2025-07-08 23:33:33'),
(182, 3, 'Seco de pollo c/pallares', 'Seco de pollo con pallares', NULL, 15.00, 0, 1, 1, '2025-07-08 23:34:51', '2025-07-08 23:34:51'),
(183, 3, 'Arroz a la cubana', 'Arroz a la cubana con plátano y huevo frito', NULL, 15.00, 0, 1, 1, '2025-07-08 23:35:31', '2025-07-08 23:35:31'),
(184, 3, 'Guiso de quinua c/pollo a la olla', 'Guiso de quinua con pollo a la olla', NULL, 15.00, 0, 1, 1, '2025-07-08 23:39:39', '2025-07-08 23:39:39'),
(185, 3, 'Mostrito', 'Mostrito', NULL, 15.00, 0, 1, 1, '2025-07-08 23:40:16', '2025-07-08 23:40:16'),
(186, 3, 'Teriyaki c/puré', 'Pollo teriyaki con puré', NULL, 15.00, 0, 1, 1, '2025-07-08 23:41:17', '2025-07-08 23:41:17'),
(187, 3, 'Arroz a la jardinera c/pollo al horno', 'Arroz a la jardinera con pollo al horno', NULL, 15.00, 0, 1, 1, '2025-07-08 23:44:26', '2025-07-08 23:44:26'),
(188, 3, 'Ensalada rusa c/pollo al horno', 'Ensalada rusa con pollo al horno', NULL, 15.00, 0, 1, 1, '2025-07-08 23:45:34', '2025-07-08 23:45:34'),
(189, 3, 'Vainita salteada c/pollo', 'Vainita salteada con pollo', NULL, 15.00, 0, 1, 1, '2025-07-08 23:46:34', '2025-07-08 23:46:34'),
(190, 3, 'Pepian de choclo con churrasco', 'Pepian de choclo con churrasco', NULL, 15.00, 0, 1, 1, '2025-07-08 23:47:54', '2025-07-08 23:47:54'),
(191, 2, 'Papa a la huancaina', 'Papa a la huancaina', NULL, 20.00, 0, 1, 1, '2025-07-09 00:08:09', '2025-07-09 00:08:09'),
(192, 4, 'Ceviche de pescado', 'Ceviche de pescado', NULL, 20.00, 0, 1, 1, '2025-07-09 15:44:57', '2025-07-09 15:44:57'),
(193, 2, 'Palta rellena', 'Palta rellena', NULL, 20.00, 0, 0, 1, '2025-07-09 15:55:43', '2025-07-09 15:55:43'),
(194, 4, 'Osobuco en salsa huancaina', 'Osobuco en salsa huancaina', NULL, 20.00, 0, 1, 1, '2025-07-09 15:56:57', '2025-07-09 15:56:57'),
(195, 2, 'Chicharron de pota', 'Chicharron de pota', NULL, 20.00, 0, 1, 1, '2025-07-09 15:57:34', '2025-07-09 15:57:34'),
(196, 2, 'Ceviche de pota', 'Ceviche de pota', NULL, 20.00, 0, 1, 1, '2025-07-09 15:58:05', '2025-07-09 15:58:05'),
(197, 4, 'Coditos a la huancaina c/Milanesa Napolitana', 'Coditos  a la huancaina con milanesa de pollo en salsa napolitana', NULL, 20.00, 0, 1, 1, '2025-07-09 16:04:41', '2025-07-09 16:04:41'),
(198, 4, 'Pasta en salsa de hongos con pollo a las finas hierbas', 'Pasta en salsa de hongos con trozos de pollo y finas hiervas', NULL, 20.00, 0, 1, 1, '2025-07-09 16:06:33', '2025-07-09 16:06:33'),
(199, 4, 'Yakimeshi con chasiu y nabo encurtido', 'Yakimeshi con chasiu y nabo encurtido', NULL, 20.00, 0, 1, 1, '2025-07-09 16:08:06', '2025-07-09 16:08:06'),
(200, 9, 'Butifarra', 'Jamón del país artesanal, lecuga, mayonesa y sarza criolla en pan frances. Café o jugo a elección,', 'access/images/popular-img/1752078518_686e98b6935a5.jpeg', 10.00, 0, 1, 1, '2025-07-09 16:28:38', '2025-07-09 16:28:38'),
(201, 9, 'Triple clásico', 'Huevo, palta, tomate y mayonesa en pan blanco. Café o jugo a elección.', 'access/images/popular-img/1752078651_686e993babf34.png', 8.00, 0, 1, 1, '2025-07-09 16:30:51', '2025-07-09 16:30:51'),
(202, 1, 'Pruebas', 'Pruebas', NULL, 12.00, 0, 1, 23, '2025-08-01 17:24:25', '2025-08-01 17:24:25');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `descripcion` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `nombre`, `descripcion`, `created_at`, `updated_at`) VALUES
(1, 'ADMIN', 'Administrador de la plataforma', '2025-04-09 13:57:58', '2025-04-09 13:57:58'),
(2, 'CLIENTE', 'Cliente que realiza pedidos', '2025-04-09 13:57:58', '2025-04-09 13:57:58'),
(3, 'REPARTIDOR', 'Repartidor motorizado', '2025-04-09 13:57:58', '2025-04-09 13:57:58'),
(4, 'CHEF', 'Personal de cocina', '2025-04-09 13:57:58', '2025-04-09 13:57:58'),
(5, 'MARKETING', 'rol de marketing', '2025-07-16 08:30:15', '0000-00-00 00:00:00'),
(6, 'IMPRESION', NULL, '2025-08-14 23:27:59', '2025-08-14 23:27:59');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('qtU86fKr59EeX2rXxbLJmnzePZGGrqfYV6lt1Tjd', 1, '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiWm5UcUtqZjl4M0NsaDBZaXR3MmtocFdzdEFvazU3bXNObmpWaXBIcSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NjA6Imh0dHBzOi8vZXN0YWNpb245MC50ZXN0L2FwaS9tZW51c2VtYW5hP3N0YXJ0X2RhdGU9MjAyNi0wMS0yNiI7czo1OiJyb3V0ZSI7Tjt9czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTtzOjQ6ImF1dGgiO2E6MTp7czoyMToicGFzc3dvcmRfY29uZmlybWVkX2F0IjtpOjE3NzAwMDUyOTk7fX0=', 1770005528);

-- --------------------------------------------------------

--
-- Table structure for table `tipopago`
--

CREATE TABLE `tipopago` (
  `id` int NOT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `estado` varchar(5) DEFAULT '1' COMMENT '0: desactivado;\r\n1: activado;',
  `id_user_create` int NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tipopago`
--

INSERT INTO `tipopago` (`id`, `nombre`, `estado`, `id_user_create`, `created_at`, `updated_at`) VALUES
(1, 'Efectivo', '1', 1, '2025-06-03 17:30:14', '2025-06-03 17:30:14'),
(2, 'Tarjeta', '1', 1, '2025-05-27 23:01:34', '2025-05-27 23:01:34'),
(3, 'Plin', '1', 1, '2025-05-27 23:01:34', '2025-05-27 23:01:34'),
(4, 'Yape', '1', 1, '2025-06-03 15:23:38', '2025-06-03 15:23:38'),
(5, 'ejemplo', '0', 1, '2025-06-03 17:38:20', '2025-06-03 17:38:20');

-- --------------------------------------------------------

--
-- Table structure for table `tmp_pedidos`
--

CREATE TABLE `tmp_pedidos` (
  `id` int NOT NULL,
  `session_id` varchar(255) NOT NULL,
  `id_usuario` int DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tmp_pedido_comensales`
--

CREATE TABLE `tmp_pedido_comensales` (
  `id` int NOT NULL,
  `id_tmp_pedido` int NOT NULL,
  `nombre_comensal` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `apellido` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_rol` int DEFAULT NULL,
  `telefono` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `imagen` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_direccion` int DEFAULT NULL,
  `id_user_create` int DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `estado` tinyint(1) NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `apellido`, `email`, `id_rol`, `telefono`, `imagen`, `id_direccion`, `id_user_create`, `email_verified_at`, `password`, `estado`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Alfredo Enrique', 'Ricci Ale', 'admin@admin.com', 1, '953761235', '', 14, 1, NULL, '$2y$12$oCz4GCB5pOAF4lnWxUsSIOCMwYsvidSXeFJdMigrddktrDJD./mL2', 1, NULL, '2025-03-23 04:54:29', '2025-07-17 18:06:21'),
(2, 'Admin Dos', 'dos', 'admin@estacion90.com', 1, '999222222', '', NULL, NULL, NULL, '$2y$12$/Y8Rl1ol6Dp3kngvTC9jDenWRhhTJxuyDHRzroGqe0jsUnHbKE7r6', 1, NULL, '2025-04-10 03:08:43', '2025-07-16 12:59:04'),
(3, 'Carlos García', 'sss', 'carlos@cliente.com', 2, '900000001', '', NULL, NULL, NULL, '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2uC/1.6j8i', 1, NULL, '2025-04-10 03:08:43', '2025-07-15 17:49:29'),
(4, 'Lucía Pérez', NULL, 'lucia@cliente.com', 2, '900000002', '', 4, NULL, NULL, '$2y$12$TxaJxkaBUe9CJxb4W7XKGOqFkT4jponiBqok1A5lYJtKgRVkzjxpK', 1, NULL, '2025-04-10 03:08:43', '2025-04-10 03:08:43'),
(5, 'María López', NULL, 'maria@cliente.com', 2, '900000003', '', 7, NULL, NULL, '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2uC/1.6j8i', 0, NULL, '2025-04-10 03:08:43', '2025-04-10 03:08:43'),
(6, 'José Díaz', NULL, 'jose@cliente.com', 2, '900000004', '', NULL, NULL, NULL, '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2uC/1.6j8i', 0, NULL, '2025-04-10 03:08:43', '2025-04-10 03:08:43'),
(7, 'Ana Torres', NULL, 'ana@cliente.com', 2, '900000005', '', NULL, NULL, NULL, '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2uC/1.6j8i', 0, NULL, '2025-04-10 03:08:43', '2025-04-10 03:08:43'),
(8, 'Pedro Ramos', NULL, 'pedro@cliente.com', 2, '900000006', '', NULL, NULL, NULL, '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2uC/1.6j8i', 0, NULL, '2025-04-10 03:08:43', '2025-04-10 03:08:43'),
(9, 'Sofía Nuñez', NULL, 'sofia@cliente.com', 2, '900000007', '', NULL, NULL, NULL, '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2uC/1.6j8i', 0, NULL, '2025-04-10 03:08:43', '2025-04-10 03:08:43'),
(10, 'Luis Castro', NULL, 'luis@cliente.com', 2, '900000008', '', NULL, NULL, NULL, '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2uC/1.6j8i', 0, NULL, '2025-04-10 03:08:43', '2025-04-10 03:08:43'),
(11, 'Elena Rojas', NULL, 'elena@cliente.com', 2, '900000009', '', NULL, NULL, NULL, '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2uC/1.6j8i', 0, NULL, '2025-04-10 03:08:43', '2025-04-10 03:08:43'),
(12, 'Diego Vega', NULL, 'diego@cliente.com', 2, '900000010', '', NULL, NULL, NULL, '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2uC/1.6j8i', 0, NULL, '2025-04-10 03:08:43', '2025-04-10 03:08:43'),
(13, 'Chef Juan', 'ape', 'juan@chef.com', 4, '988111111', '', NULL, NULL, NULL, '$2y$12$/Y8Rl1ol6Dp3kngvTC9jDenWRhhTJxuyDHRzroGqe0jsUnHbKE7r6', 0, NULL, '2025-04-10 03:08:43', '2025-05-11 00:25:49'),
(14, 'Chef Rosa', 'www', 'rosa@chef.com', 4, '988222222', '', NULL, NULL, NULL, '$2y$12$S6m84jofEpOYioRwn.TuW.KLGaJy7xKstfSoRCzMkZc5oNocIhSWi', 1, NULL, '2025-04-10 03:08:43', '2025-06-30 09:30:08'),
(15, 'Chef Mario', NULL, 'mario@chef.com', 4, '988333333', '', NULL, NULL, NULL, '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2uC/1.6j8i', 0, NULL, '2025-04-10 03:08:43', '2025-04-10 03:08:43'),
(16, 'Chef Carla', NULL, 'carla@chef.com', 4, '988444444', '', NULL, NULL, NULL, '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2uC/1.6j8i', 0, NULL, '2025-04-10 03:08:43', '2025-04-10 03:08:43'),
(17, 'Repartidor Luis', 'ape', 'luis@reparto.com', 3, '977111111', '', NULL, NULL, NULL, '$2y$12$/Y8Rl1ol6Dp3kngvTC9jDenWRhhTJxuyDHRzroGqe0jsUnHbKE7r6', 1, NULL, '2025-04-10 03:08:43', '2025-05-10 23:19:14'),
(18, 'Repartidor Ana', 'dd', 'ana@reparto.com', 3, '977222222', '', NULL, NULL, NULL, '$2y$12$Iaixb8tGzugbuFpLxlpENOkbtrIyBuuWa7BnFVl5nnScWy5Y5Hbn.', 1, NULL, '2025-04-10 03:08:43', '2025-08-15 08:09:19'),
(19, 'ejemplo', 'apellido', 'ejempli@admin.com', 1, '953761235', '', NULL, NULL, NULL, '$2y$12$NjaOeVbVfwA4ZSgjDpfZL./aAJhbVwZdUHq24n4gtZLNvrq1sdrn.', 1, NULL, '2025-05-10 21:48:55', '2025-05-10 21:48:55'),
(20, 'ejemplo', 'ejemplo', 'ejemplo4@admin.com', 1, '984635527', '', NULL, NULL, NULL, '$2y$12$zMUF3OIgEyk9gSkiffh0vOIBT1PlbcoVXzBqAapzuKMR/0cmk17QC', 1, NULL, '2025-05-10 21:50:22', '2025-05-10 21:57:06'),
(21, 'ejemplo', 'e', 'ejemplo5@admin.com', 1, '938748484', '1748302875.png', NULL, NULL, NULL, '$2y$12$0c.rPjuiw3AItIuxMEOzVuo.FUfTLQgvjkZtXzx8NWeZm30grxb9W', 1, NULL, '2025-05-10 22:02:48', '2025-05-27 04:41:15'),
(22, 'ejemplo', '6', 'ejemplo6@admin.com', 1, '923423423', '', NULL, 21, NULL, '$2y$12$89euMAuKQEfMr5ezb2H6GOp9ZsgbDW4FX87heejr7nXyHRGxg26Ci', 1, NULL, '2025-05-10 22:04:51', '2025-05-10 22:04:51'),
(23, 'AaronDev', 'Xdsakasd', 'aaron.dev@gmail.com', 1, '956569197', '1748278148.jpg', 10, NULL, NULL, '$2y$12$/Y8Rl1ol6Dp3kngvTC9jDenWRhhTJxuyDHRzroGqe0jsUnHbKE7r6', 1, '2L6ImNbdFX0cRkVItDjPrZHKR1QmcVIVXdjkHvvycOjGlMnEZpLkykVKjLeD', '2025-05-13 18:05:11', '2025-07-13 05:53:59'),
(25, 'Aaron', 'Aquino', 'aaron.dsev@gmail.com', 5, '956569222', 'access/images/default-avatar.png', NULL, 23, NULL, '$2y$12$v/.jry6UMKkrLmGUhiVoi.qaom.j/WAlID8zhyB8oiZDrtxjdjK/W', 1, NULL, '2025-07-15 18:06:46', '2025-07-15 18:06:46'),
(26, 'Aaron', 'Marketing', 'marketing@estacion90.pe', 5, '956569197', NULL, NULL, 23, NULL, '$2y$12$j9FRtPTRrz5q2hAlillQ2OnTo8YR7xHjrxerxQ/I6./2mE.v5oZqC', 1, NULL, '2025-07-17 14:37:12', '2025-07-17 14:37:12'),
(27, 'Prueba', 'Marketing', 'prueba@estacion90.pe', 5, '945494944', NULL, NULL, 23, NULL, '$2y$12$/fVRDG8Lw0ux3z3cQfp0fODAEBPp/plgW56It6YY6J7oP7HfSRIrO', 1, NULL, '2025-07-17 15:12:44', '2025-07-17 15:12:44'),
(32, 'impresion', 'impresion', 'impresion@gmail.com', 6, '9237234', NULL, NULL, 1, NULL, '$2y$12$mfWEIgo12ki7fGrh15wouOdWXQ8csCKsdYiurWxUPlohlvnXTZv9a', 1, NULL, '2025-08-14 23:29:45', '2025-08-14 23:29:45');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `asignaciones_reparto`
--
ALTER TABLE `asignaciones_reparto`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_asignaciones_reparto_pedido` (`id_pedido`);

--
-- Indexes for table `banners`
--
ALTER TABLE `banners`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comprobantepago`
--
ALTER TABLE `comprobantepago`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `configuracion_sistema`
--
ALTER TABLE `configuracion_sistema`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `clave` (`clave`);

--
-- Indexes for table `direccion_user`
--
ALTER TABLE `direccion_user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_direccion_user_distrito` (`id_distrito`);

--
-- Indexes for table `distrito`
--
ALTER TABLE `distrito`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `historial_estado_pedidos`
--
ALTER TABLE `historial_estado_pedidos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `horallegada`
--
ALTER TABLE `horallegada`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `impresiones`
--
ALTER TABLE `impresiones`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `impresiones_id_pedido_unique` (`id_pedido`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menu_categorias`
--
ALTER TABLE `menu_categorias`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_menu_categoria` (`menu_id`,`categoria_id`),
  ADD KEY `categoria_id` (`categoria_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_pedidos_distrito_contacto` (`id_distrito_contacto`);

--
-- Indexes for table `pedido_comensales`
--
ALTER TABLE `pedido_comensales`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_pedido_comensales_pedido` (`id_pedido`);

--
-- Indexes for table `pedido_detalles`
--
ALTER TABLE `pedido_detalles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_pedido_detalles_pedido` (`id_pedido`),
  ADD KEY `fk_pedido_detalles_comensal` (`id_comensal`),
  ADD KEY `fk_pedido_detalles_producto` (`id_producto`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `planeacion_menu`
--
ALTER TABLE `planeacion_menu`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_planeacion_menu_producto` (`id_producto`);

--
-- Indexes for table `popup`
--
ALTER TABLE `popup`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `popup_dia`
--
ALTER TABLE `popup_dia`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_productos_categoria` (`id_categoria`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `tipopago`
--
ALTER TABLE `tipopago`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tmp_pedidos`
--
ALTER TABLE `tmp_pedidos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_session_id` (`session_id`);

--
-- Indexes for table `tmp_pedido_comensales`
--
ALTER TABLE `tmp_pedido_comensales`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_tmp_pedido_comensales_tmp_pedido` (`id_tmp_pedido`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `fk_users_rol` (`id_rol`),
  ADD KEY `fk_users_direccion` (`id_direccion`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `asignaciones_reparto`
--
ALTER TABLE `asignaciones_reparto`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `banners`
--
ALTER TABLE `banners`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `comprobantepago`
--
ALTER TABLE `comprobantepago`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `configuracion_sistema`
--
ALTER TABLE `configuracion_sistema`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `direccion_user`
--
ALTER TABLE `direccion_user`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `distrito`
--
ALTER TABLE `distrito`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `historial_estado_pedidos`
--
ALTER TABLE `historial_estado_pedidos`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=211;

--
-- AUTO_INCREMENT for table `horallegada`
--
ALTER TABLE `horallegada`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `impresiones`
--
ALTER TABLE `impresiones`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `menu_categorias`
--
ALTER TABLE `menu_categorias`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=116;

--
-- AUTO_INCREMENT for table `pedido_comensales`
--
ALTER TABLE `pedido_comensales`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=156;

--
-- AUTO_INCREMENT for table `pedido_detalles`
--
ALTER TABLE `pedido_detalles`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=294;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `planeacion_menu`
--
ALTER TABLE `planeacion_menu`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1668;

--
-- AUTO_INCREMENT for table `popup`
--
ALTER TABLE `popup`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `popup_dia`
--
ALTER TABLE `popup_dia`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=203;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tipopago`
--
ALTER TABLE `tipopago`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tmp_pedidos`
--
ALTER TABLE `tmp_pedidos`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tmp_pedido_comensales`
--
ALTER TABLE `tmp_pedido_comensales`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `asignaciones_reparto`
--
ALTER TABLE `asignaciones_reparto`
  ADD CONSTRAINT `fk_asignaciones_reparto_pedido` FOREIGN KEY (`id_pedido`) REFERENCES `pedidos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `direccion_user`
--
ALTER TABLE `direccion_user`
  ADD CONSTRAINT `fk_direccion_user_distrito` FOREIGN KEY (`id_distrito`) REFERENCES `distrito` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `impresiones`
--
ALTER TABLE `impresiones`
  ADD CONSTRAINT `impresiones_id_pedido_foreign` FOREIGN KEY (`id_pedido`) REFERENCES `pedidos` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `menu_categorias`
--
ALTER TABLE `menu_categorias`
  ADD CONSTRAINT `menu_categorias_ibfk_1` FOREIGN KEY (`menu_id`) REFERENCES `menu` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `menu_categorias_ibfk_2` FOREIGN KEY (`categoria_id`) REFERENCES `categorias` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `pedidos`
--
ALTER TABLE `pedidos`
  ADD CONSTRAINT `fk_pedidos_distrito_contacto` FOREIGN KEY (`id_distrito_contacto`) REFERENCES `distrito` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `pedido_comensales`
--
ALTER TABLE `pedido_comensales`
  ADD CONSTRAINT `fk_pedido_comensales_pedido` FOREIGN KEY (`id_pedido`) REFERENCES `pedidos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pedido_detalles`
--
ALTER TABLE `pedido_detalles`
  ADD CONSTRAINT `fk_pedido_detalles_comensal` FOREIGN KEY (`id_comensal`) REFERENCES `pedido_comensales` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_pedido_detalles_pedido` FOREIGN KEY (`id_pedido`) REFERENCES `pedidos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_pedido_detalles_producto` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `planeacion_menu`
--
ALTER TABLE `planeacion_menu`
  ADD CONSTRAINT `fk_planeacion_menu_producto` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `fk_productos_categoria` FOREIGN KEY (`id_categoria`) REFERENCES `categorias` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `tmp_pedido_comensales`
--
ALTER TABLE `tmp_pedido_comensales`
  ADD CONSTRAINT `fk_tmp_pedido_comensales_tmp_pedido` FOREIGN KEY (`id_tmp_pedido`) REFERENCES `tmp_pedidos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `fk_users_direccion` FOREIGN KEY (`id_direccion`) REFERENCES `direccion_user` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_users_rol` FOREIGN KEY (`id_rol`) REFERENCES `roles` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
