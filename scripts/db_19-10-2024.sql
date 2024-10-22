-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         10.4.32-MariaDB - mariadb.org binary distribution
-- SO del servidor:              Win64
-- HeidiSQL Versión:             12.8.0.6908
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Volcando estructura para tabla sigesco_2.auxiliar_tipo_archivos
CREATE TABLE IF NOT EXISTS `auxiliar_tipo_archivos` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `requerido` int(11) unsigned NOT NULL DEFAULT 0,
  `orden` int(11) unsigned NOT NULL DEFAULT 0,
  `edit` int(11) DEFAULT 0,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando datos para la tabla sigesco_2.auxiliar_tipo_archivos: ~12 rows (aproximadamente)
DELETE FROM `auxiliar_tipo_archivos`;
INSERT INTO `auxiliar_tipo_archivos` (`id`, `nombre`, `requerido`, `orden`, `edit`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 'Anexo 1_1', 1, 1, 0, '2024-01-30 16:41:06', '2024-10-07 00:13:39', NULL),
	(2, 'Anexo 8', 0, 2, 0, '2024-01-30 16:41:14', '2024-08-25 01:37:14', NULL),
	(3, 'Anexo 9', 0, 3, 0, '2024-01-30 16:41:22', '2024-08-25 01:37:15', NULL),
	(4, 'Anexo 10', 0, 4, 0, '2024-01-30 16:41:27', '2024-08-25 01:37:15', NULL),
	(5, 'Anexo 11', 0, 5, 0, '2024-01-30 16:41:30', '2024-08-25 01:37:16', NULL),
	(6, 'Anexo 12', 0, 6, 0, '2024-01-30 16:41:45', '2024-08-25 01:37:16', NULL),
	(7, 'Anexo 19', 0, 7, 0, '2024-01-30 16:41:52', '2024-01-30 16:42:15', NULL),
	(8, 'CV Documentado', 0, 9, 0, '2024-01-30 16:42:03', '2024-08-25 01:37:18', NULL),
	(9, 'Titulo Profesional', 0, 8, 0, '2024-01-30 16:42:03', '2024-08-25 01:37:19', NULL),
	(10, 'Reclamo', 0, 10, 1, '2024-02-08 16:42:03', '2024-02-08 16:42:03', NULL),
	(11, 'Acta firmada', 0, 11, 2, '2024-06-16 13:17:31', '2024-06-16 13:17:33', NULL),
	(12, 'Documentos consolidado', 0, 12, 2, '2024-08-25 12:39:21', '2024-08-25 12:39:30', NULL);

-- Volcando estructura para tabla sigesco_2.auxiliar_tipo_convocatoria
CREATE TABLE IF NOT EXISTS `auxiliar_tipo_convocatoria` (
  `tipo_id` int(11) DEFAULT NULL,
  `descripcion` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` datetime DEFAULT NULL,
  KEY `tipo_id` (`tipo_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando datos para la tabla sigesco_2.auxiliar_tipo_convocatoria: ~2 rows (aproximadamente)
DELETE FROM `auxiliar_tipo_convocatoria`;
INSERT INTO `auxiliar_tipo_convocatoria` (`tipo_id`, `descripcion`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 'PUN AUX', '2023-11-16 15:31:03', '2024-10-09 23:21:27', '2024-10-09 23:21:26'),
	(2, 'EVALUACIÓN DE EXPEDIENTE', '2023-11-16 15:31:03', '2023-11-21 14:29:49', NULL);

-- Volcando estructura para tabla sigesco_2.tipo_archivos
CREATE TABLE IF NOT EXISTS `tipo_archivos` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) DEFAULT NULL,
  `requerido` int(11) unsigned NOT NULL DEFAULT 0,
  `orden` int(11) unsigned NOT NULL DEFAULT 0,
  `edit` int(11) DEFAULT 0,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla sigesco_2.tipo_archivos: ~12 rows (aproximadamente)
DELETE FROM `tipo_archivos`;
INSERT INTO `tipo_archivos` (`id`, `nombre`, `requerido`, `orden`, `edit`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 'Anexo 1', 1, 1, 0, '2024-01-30 16:41:06', '2024-01-30 16:42:12', NULL),
	(2, 'Anexo 8', 0, 2, 0, '2024-01-30 16:41:14', '2024-08-25 01:37:14', NULL),
	(3, 'Anexo 9', 0, 3, 0, '2024-01-30 16:41:22', '2024-08-25 01:37:15', NULL),
	(4, 'Anexo 10', 0, 4, 0, '2024-01-30 16:41:27', '2024-08-25 01:37:15', NULL),
	(5, 'Anexo 11', 0, 5, 0, '2024-01-30 16:41:30', '2024-08-25 01:37:16', NULL),
	(6, 'Anexo 12', 0, 6, 0, '2024-01-30 16:41:45', '2024-08-25 01:37:16', NULL),
	(7, 'Anexo 19', 0, 7, 0, '2024-01-30 16:41:52', '2024-01-30 16:42:15', NULL),
	(8, 'CV Documentado', 0, 9, 0, '2024-01-30 16:42:03', '2024-08-25 01:37:18', NULL),
	(9, 'Titulo Profesional', 0, 8, 0, '2024-01-30 16:42:03', '2024-08-25 01:37:19', NULL),
	(10, 'Reclamo', 0, 10, 1, '2024-02-08 16:42:03', '2024-02-08 16:42:03', NULL),
	(11, 'Acta firmada', 0, 11, 2, '2024-06-16 13:17:31', '2024-06-16 13:17:33', NULL),
	(12, 'Documentos consolidado', 0, 12, 2, '2024-08-25 12:39:21', '2024-08-25 12:39:30', NULL);

-- Volcando estructura para tabla sigesco_2.tipo_convocatoria
CREATE TABLE IF NOT EXISTS `tipo_convocatoria` (
  `tipo_id` int(11) DEFAULT NULL,
  `descripcion` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` datetime DEFAULT NULL,
  KEY `tipo_id` (`tipo_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando datos para la tabla sigesco_2.tipo_convocatoria: ~2 rows (aproximadamente)
DELETE FROM `tipo_convocatoria`;
INSERT INTO `tipo_convocatoria` (`tipo_id`, `descripcion`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 'PUN', '2023-11-16 15:31:03', '2023-11-21 14:29:28', NULL),
	(2, 'EVALUACIÓN DE EXPEDIENTE', '2023-11-16 15:31:03', '2023-11-21 14:29:49', NULL);

-- Volcando estructura para tabla sigesco_2.tipo_usuarios
CREATE TABLE IF NOT EXISTS `tipo_usuarios` (
  `tus_id` int(11) NOT NULL AUTO_INCREMENT,
  `tus_usuariodescrip` varchar(225) DEFAULT NULL,
  `tus_fechaRegistro` datetime DEFAULT NULL,
  `tus_fechaModificacion` datetime DEFAULT NULL,
  `tus_estado` int(1) DEFAULT NULL,
  `tus_flag` int(1) DEFAULT NULL,
  PRIMARY KEY (`tus_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- Volcando datos para la tabla sigesco_2.tipo_usuarios: ~5 rows (aproximadamente)
DELETE FROM `tipo_usuarios`;
INSERT INTO `tipo_usuarios` (`tus_id`, `tus_usuariodescrip`, `tus_fechaRegistro`, `tus_fechaModificacion`, `tus_estado`, `tus_flag`) VALUES
	(1, 'ADMINISTRADOR', NULL, NULL, 1, 0),
	(2, 'ESPECIALISTA ADMINISTRADOR', '2022-07-04 08:55:35', NULL, 1, 1),
	(3, 'ESPECIALISTA EVALUADOR', '2022-10-03 11:08:57', NULL, 1, 1),
	(4, 'ESPECIALISTA ADJUDICADOR', NULL, NULL, 1, 1),
	(5, 'ESPECIALISTA ADM. DE PERSONAL', '2024-04-27 01:56:02', NULL, 1, 1);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
