CREATE TABLE `auxiliar_tipo_convocatoria` (
	`tipo_id` INT(11) NULL DEFAULT NULL,
	`descripcion` VARCHAR(255) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
	`created_at` DATETIME NULL DEFAULT current_timestamp(),
	`updated_at` DATETIME NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
	`deleted_at` DATETIME NULL DEFAULT NULL,
	INDEX `tipo_id` (`tipo_id`) USING BTREE
);

INSERT INTO `auxiliar_tipo_convocatoria` (`tipo_id`, `descripcion`, `created_at`, `updated_at`, `deleted_at`) VALUES (1, 'PUN', '2023-11-16 15:31:03', '2023-11-21 14:29:28', NULL);
INSERT INTO `auxiliar_tipo_convocatoria` (`tipo_id`, `descripcion`, `created_at`, `updated_at`, `deleted_at`) VALUES (2, 'EVALUACIÓN DE EXPEDIENTE', '2023-11-16 15:31:03', '2023-11-21 14:29:49', NULL);

SELECT*FROM auxiliar_tipo_convocatoria;

CREATE TABLE `auxiliar_convocatorias` (
	`con_id` INT(11) NOT NULL AUTO_INCREMENT,
	`con_numero` VARCHAR(25) NULL DEFAULT NULL COLLATE 'utf8_general_ci',
	`con_anio` VARCHAR(4) NULL DEFAULT NULL COLLATE 'utf8_general_ci',
	`con_fechainicio` DATE NULL DEFAULT NULL,
	`con_fechafin` DATE NULL DEFAULT NULL,
	`con_estado` INT(1) NULL DEFAULT NULL,
	`con_tipo` INT(4) NULL DEFAULT NULL,
	`con_horainicio` TIME NULL DEFAULT NULL,
	`con_horafin` TIME NULL DEFAULT NULL,
	`con_fechainicio_reclamo` DATE NULL DEFAULT NULL,
	`con_fechafin_reclamo` DATE NULL DEFAULT NULL,
	`con_horainicio_reclamo` TIME NULL DEFAULT NULL,
	`con_horafin_reclamo` TIME NULL DEFAULT NULL,
	PRIMARY KEY (`con_id`) USING BTREE,
	INDEX `fk_auxiliar_con_tipo` (`con_tipo`) USING BTREE,
	CONSTRAINT `fk_auxiliar_con_tipo` FOREIGN KEY (`con_tipo`) REFERENCES `auxiliar_tipo_convocatoria` (`tipo_id`) ON UPDATE RESTRICT ON DELETE RESTRICT
);

INSERT INTO `auxiliar_convocatorias` (`con_id`, `con_numero`, `con_anio`, `con_fechainicio`, `con_fechafin`, `con_estado`, `con_tipo`, `con_horainicio`, `con_horafin`, `con_fechainicio_reclamo`, `con_fechafin_reclamo`, `con_horainicio_reclamo`, `con_horafin_reclamo`) VALUES (1, '1', '2024', '2024-06-18', '2024-10-07', 1, 2, '15:51:00', '18:51:00', '2024-09-28', '2024-10-30', '15:51:00', '15:51:00');

SELECT*FROM auxiliar_convocatorias;

CREATE TABLE `auxiliar_convocatorias_detalle` (
	`cde_id` INT(11) NOT NULL AUTO_INCREMENT,
	`convocatorias_con_id` INT(11) NOT NULL,
	`grupo_inscripcion_gin_id` INT(11) NOT NULL,
	`cde_estado` INT(1) NULL DEFAULT NULL,
	PRIMARY KEY (`cde_id`) USING BTREE,
	INDEX `fk_auxiliar_convocatorias_detalle_convocatorias1_idx` (`convocatorias_con_id`) USING BTREE,
	INDEX `fk_auxiliar_convocatorias_detalle_grupo_inscripcion1_idx` (`grupo_inscripcion_gin_id`) USING BTREE,
	CONSTRAINT `fk_auxiliar_convocatorias_detalle_convocatorias1` FOREIGN KEY (`convocatorias_con_id`) REFERENCES `convocatorias` (`con_id`) ON UPDATE NO ACTION ON DELETE NO ACTION,
	CONSTRAINT `fk_auxiliar_convocatorias_detalle_grupo_inscripcion1` FOREIGN KEY (`grupo_inscripcion_gin_id`) REFERENCES `grupo_inscripcion` (`gin_id`) ON UPDATE NO ACTION ON DELETE NO ACTION
);

SELECT*FROM auxiliar_convocatorias_detalle;

INSERT INTO `grupo_inscripcion` (`procesos_pro_id`, `periodos_per_id`, `especialidades_esp_id`, `gin_estado`) VALUES (2, 1, 1, 1);

SELECT*FROM grupo_inscripcion;

INSERT INTO `auxiliar_convocatorias_detalle` (`convocatorias_con_id`, `grupo_inscripcion_gin_id`, `cde_estado`) VALUES (1, 1, 1);


CREATE TABLE `auxiliar_postulaciones` (
	`id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
	`nombre` VARCHAR(255) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
	`apellido_paterno` VARCHAR(255) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
	`apellido_materno` VARCHAR(255) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
	`numero_documento` VARCHAR(255) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
	`tipo_documento` INT(11) NULL DEFAULT NULL,
	`genero` VARCHAR(255) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
	`estado_civil` VARCHAR(255) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
	`nacionalidad` VARCHAR(255) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
	`fecha_nacimiento` DATE NULL DEFAULT NULL,
	`correo` VARCHAR(255) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
	`numero_celular` VARCHAR(255) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
	`numero_telefono` VARCHAR(255) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
	`via` VARCHAR(255) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
	`nombre_via` VARCHAR(255) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
	`zona` VARCHAR(255) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
	`direccion` VARCHAR(255) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
	`fecha_registro` DATETIME NULL DEFAULT NULL,
	`uid` VARCHAR(255) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
	`numero_expediente` VARCHAR(255) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
	`nombre_zona` VARCHAR(255) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
	`distrito` VARCHAR(255) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
	`provincia` VARCHAR(255) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
	`departamento` VARCHAR(255) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
	`zona_id` INT(11) NULL DEFAULT '0',
	`via_id` INT(11) NULL DEFAULT '0',
	`estado_adjudicacion` INT(11) NULL DEFAULT '0',
	`estado` VARCHAR(255) NULL DEFAULT 'enviado' COLLATE 'utf8mb4_general_ci',
	`distrito_id` INT(11) NULL DEFAULT NULL,
	`convocatoria_id` INT(11) UNSIGNED NOT NULL,
	`inscripcion_id` INT(11) UNSIGNED NOT NULL DEFAULT '0',
	`created_at` DATETIME NULL DEFAULT current_timestamp(),
	`updated_at` DATETIME NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
	`deleted_at` DATETIME NULL DEFAULT NULL,
	`afiliacion` VARCHAR(255) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
	`cuss` VARCHAR(255) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
	`intentos_adjudicacion` INT(11) NULL DEFAULT '0',
	`fecha_reclamo` DATETIME NULL DEFAULT NULL,
	`numero_expediente_reclamo` VARCHAR(255) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
	PRIMARY KEY (`id`) USING BTREE
);

SELECT*FROM auxiliar_postulaciones;

CREATE TABLE `auxiliar_postulacion_archivos` (
	`id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
	`nombre` VARCHAR(255) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
	`url` TEXT NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
	`formato` VARCHAR(255) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
	`peso` INT(11) UNSIGNED NULL DEFAULT '0',
	`tipo_id` INT(11) UNSIGNED NULL DEFAULT '0',
	`postulacion_id` INT(11) UNSIGNED NULL DEFAULT '0',
	`created_at` DATETIME NULL DEFAULT current_timestamp(),
	`updated_at` DATETIME NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
	`deleted_at` DATETIME NULL DEFAULT NULL,
	PRIMARY KEY (`id`) USING BTREE
);
CREATE TABLE `auxiliar_postulacion_especializaciones` (
	`id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
	`tipo_especializacion` VARCHAR(255) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
	`tema_especializacion` VARCHAR(255) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
	`nombre_entidad` VARCHAR(255) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
	`fecha_inicio` DATE NULL DEFAULT NULL,
	`fecha_termino` DATE NULL DEFAULT NULL,
	`numero_horas` INT(11) NULL DEFAULT '0',
	`postulacion_id` INT(11) UNSIGNED NOT NULL,
	`created_at` DATETIME NULL DEFAULT current_timestamp(),
	`updated_at` DATETIME NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
	`deleted_at` DATETIME NULL DEFAULT NULL,
	PRIMARY KEY (`id`) USING BTREE
);
CREATE TABLE `auxiliar_postulacion_evaluaciones` (
	`id` INT(11) NOT NULL AUTO_INCREMENT,
	`plantilla` TEXT NULL DEFAULT NULL COLLATE 'utf8_general_ci',
	`puntaje` DECIMAL(9,2) NULL DEFAULT NULL,
	`estado` INT(11) UNSIGNED NULL DEFAULT '0',
	`orden` INT(11) UNSIGNED NULL DEFAULT '0',
	`promedio` INT(11) UNSIGNED NULL DEFAULT '0',
	`prelacion_id` INT(11) NULL DEFAULT '0',
	`bonificacion_id` INT(11) NULL DEFAULT '0',
	`fecha_registro` DATETIME NULL DEFAULT NULL,
	`ficha_id` INT(11) UNSIGNED NULL DEFAULT '0',
	`postulacion_id` INT(11) UNSIGNED NULL DEFAULT '0',
	`created_at` DATETIME NULL DEFAULT current_timestamp(),
	`updated_at` DATETIME NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
	`deleted_at` DATETIME NULL DEFAULT NULL,
	PRIMARY KEY (`id`) USING BTREE
);
CREATE TABLE `auxiliar_postulacion_experiencias_laborales` (
	`id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
	`institucion_educativa` VARCHAR(255) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
	`sector` VARCHAR(255) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
	`puesto` VARCHAR(255) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
	`numero_rd` VARCHAR(255) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
	`cantidad_mesesrd` INT(11) NULL DEFAULT '0',
	`fechatermino_rd` DATE NULL DEFAULT NULL,
	`fechainicio_rd` DATE NULL DEFAULT NULL,
	`numero_contrato` VARCHAR(255) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
	`postulacion_id` INT(11) UNSIGNED NOT NULL,
	`created_at` DATETIME NULL DEFAULT current_timestamp(),
	`updated_at` DATETIME NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
	`deleted_at` DATETIME NULL DEFAULT NULL,
	PRIMARY KEY (`id`) USING BTREE
);
CREATE TABLE `auxiliar_postulacion_formaciones_academicas` (
	`id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
	`nivel_educativo` VARCHAR(255) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
	`grado_academico` VARCHAR(255) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
	`universidad` VARCHAR(255) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
	`carrera_profesional` VARCHAR(255) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
	`registro_titulo` VARCHAR(255) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
	`rd_titulo` VARCHAR(255) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
	`mencion_grado_academico` VARCHAR(255) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
	`mencion_academico` VARCHAR(255) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
	`subnivel` VARCHAR(255) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
	`estadoestudio_educativo` VARCHAR(255) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
	`tipoestudio_educativo` VARCHAR(255) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
	`obtencion_grado` VARCHAR(255) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
	`postulacion_id` INT(11) UNSIGNED NOT NULL,
	`created_at` DATETIME NULL DEFAULT current_timestamp(),
	`updated_at` DATETIME NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
	`deleted_at` DATETIME NULL DEFAULT NULL,
	PRIMARY KEY (`id`) USING BTREE
);


-- INSERT INTO `modulos` (`mdl_id`, `mdl_nombre`, `mdl_ruta`, `mdl_icono`, `mdl_hijode`, `mdl_orden`, `mdl_fechaRegistro`, `mdl_fechaModificacion`, `mdl_estado`, `mdl_flag`) VALUES (22, 'AUXILIARES', '', '.', 0, 7, '2022-07-04 08:57:16', NULL, 1, 1);
-- INSERT INTO `modulos` (`mdl_id`, `mdl_nombre`, `mdl_ruta`, `mdl_icono`, `mdl_hijode`, `mdl_orden`, `mdl_fechaRegistro`, `mdl_fechaModificacion`, `mdl_estado`, `mdl_flag`) VALUES (23, 'PERIODOS', 'admin/auxiliares/periodos', '.', 22, 7.7, '2022-07-04 08:57:52', NULL, 1, 1);
-- INSERT INTO `modulos` (`mdl_id`, `mdl_nombre`, `mdl_ruta`, `mdl_icono`, `mdl_hijode`, `mdl_orden`, `mdl_fechaRegistro`, `mdl_fechaModificacion`, `mdl_estado`, `mdl_flag`) VALUES (24, 'PROCESOS', 'admin/auxiliares/procesos', '.', 22, 7.8, '2022-07-04 08:58:57', NULL, 1, 1);
-- INSERT INTO `modulos` (`mdl_id`, `mdl_nombre`, `mdl_ruta`, `mdl_icono`, `mdl_hijode`, `mdl_orden`, `mdl_fechaRegistro`, `mdl_fechaModificacion`, `mdl_estado`, `mdl_flag`) VALUES (25, 'GRUPO DE INSCRIPCIÓN', 'admin/auxiliares/grupoinscripcion', '.', 22, 7.9, '2022-07-14 15:00:04', '2022-07-18 17:23:08', 1, 1);


-- INSERT INTO `permisos` (`modulos_mdl_id`, `tipo_usuarios_tus_id`, `per_fechaRegistro`, `per_fechaModificacion`, `per_estado`, `per_flag`) VALUES (22, 2, '2022-07-04 08:57:16', '2022-07-04 08:59:12', 1, 1);
-- INSERT INTO `permisos` (`modulos_mdl_id`, `tipo_usuarios_tus_id`, `per_fechaRegistro`, `per_fechaModificacion`, `per_estado`, `per_flag`) VALUES (23, 2, '2022-07-04 08:57:16', '2022-07-04 08:59:12', 1, 1);
-- INSERT INTO `permisos` (`modulos_mdl_id`, `tipo_usuarios_tus_id`, `per_fechaRegistro`, `per_fechaModificacion`, `per_estado`, `per_flag`) VALUES (24, 2, '2022-07-04 08:57:16', '2022-07-04 08:59:12', 1, 1);
-- INSERT INTO `permisos` (`modulos_mdl_id`, `tipo_usuarios_tus_id`, `per_fechaRegistro`, `per_fechaModificacion`, `per_estado`, `per_flag`) VALUES (25, 2, '2022-07-04 08:57:16', '2022-07-04 08:59:12', 1, 1);


/****** 06/10/2024 **********/


CREATE TABLE `auxiliar_tipo_archivos` (
	`id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
	`nombre` VARCHAR(255) NULL DEFAULT NULL COLLATE 'utf8mb4_unicode_ci',
	`requerido` INT(11) UNSIGNED NOT NULL DEFAULT '0',
	`orden` INT(11) UNSIGNED NOT NULL DEFAULT '0',
	`edit` INT(11) NULL DEFAULT '0',
	`created_at` DATETIME NULL DEFAULT current_timestamp(),
	`updated_at` DATETIME NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
	`deleted_at` DATETIME NULL DEFAULT NULL,
	PRIMARY KEY (`id`) USING BTREE
);

INSERT INTO `auxiliar_tipo_archivos` (`id`, `nombre`, `requerido`, `orden`, `edit`, `created_at`, `updated_at`, `deleted_at`) VALUES (1, 'Anexo 1', 1, 1, 0, '2024-01-30 16:41:06', '2024-01-30 16:42:12', NULL);
INSERT INTO `auxiliar_tipo_archivos` (`id`, `nombre`, `requerido`, `orden`, `edit`, `created_at`, `updated_at`, `deleted_at`) VALUES (2, 'Anexo 8', 0, 2, 0, '2024-01-30 16:41:14', '2024-08-25 01:37:14', NULL);
INSERT INTO `auxiliar_tipo_archivos` (`id`, `nombre`, `requerido`, `orden`, `edit`, `created_at`, `updated_at`, `deleted_at`) VALUES (3, 'Anexo 9', 0, 3, 0, '2024-01-30 16:41:22', '2024-08-25 01:37:15', NULL);
INSERT INTO `auxiliar_tipo_archivos` (`id`, `nombre`, `requerido`, `orden`, `edit`, `created_at`, `updated_at`, `deleted_at`) VALUES (4, 'Anexo 10', 0, 4, 0, '2024-01-30 16:41:27', '2024-08-25 01:37:15', NULL);
INSERT INTO `auxiliar_tipo_archivos` (`id`, `nombre`, `requerido`, `orden`, `edit`, `created_at`, `updated_at`, `deleted_at`) VALUES (5, 'Anexo 11', 0, 5, 0, '2024-01-30 16:41:30', '2024-08-25 01:37:16', NULL);
INSERT INTO `auxiliar_tipo_archivos` (`id`, `nombre`, `requerido`, `orden`, `edit`, `created_at`, `updated_at`, `deleted_at`) VALUES (6, 'Anexo 12', 0, 6, 0, '2024-01-30 16:41:45', '2024-08-25 01:37:16', NULL);
INSERT INTO `auxiliar_tipo_archivos` (`id`, `nombre`, `requerido`, `orden`, `edit`, `created_at`, `updated_at`, `deleted_at`) VALUES (7, 'Anexo 19', 0, 7, 0, '2024-01-30 16:41:52', '2024-01-30 16:42:15', NULL);
INSERT INTO `auxiliar_tipo_archivos` (`id`, `nombre`, `requerido`, `orden`, `edit`, `created_at`, `updated_at`, `deleted_at`) VALUES (8, 'CV Documentado', 0, 9, 0, '2024-01-30 16:42:03', '2024-08-25 01:37:18', NULL);
INSERT INTO `auxiliar_tipo_archivos` (`id`, `nombre`, `requerido`, `orden`, `edit`, `created_at`, `updated_at`, `deleted_at`) VALUES (9, 'Titulo Profesional', 0, 8, 0, '2024-01-30 16:42:03', '2024-08-25 01:37:19', NULL);
INSERT INTO `auxiliar_tipo_archivos` (`id`, `nombre`, `requerido`, `orden`, `edit`, `created_at`, `updated_at`, `deleted_at`) VALUES (10, 'Reclamo', 0, 10, 1, '2024-02-08 16:42:03', '2024-02-08 16:42:03', NULL);
INSERT INTO `auxiliar_tipo_archivos` (`id`, `nombre`, `requerido`, `orden`, `edit`, `created_at`, `updated_at`, `deleted_at`) VALUES (11, 'Acta firmada', 0, 11, 2, '2024-06-16 13:17:31', '2024-06-16 13:17:33', NULL);
INSERT INTO `auxiliar_tipo_archivos` (`id`, `nombre`, `requerido`, `orden`, `edit`, `created_at`, `updated_at`, `deleted_at`) VALUES (12, 'Documentos consolidado', 0, 12, 2, '2024-08-25 12:39:21', '2024-08-25 12:39:30', NULL);


/************* 09/10/2024 ****************/


CREATE TABLE `auxiliar_bonificaciones` (
	`id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
	`nombre` VARCHAR(255) NULL DEFAULT NULL COLLATE 'utf8mb4_unicode_ci',
	`puntaje` DECIMAL(9,2) NULL DEFAULT '0.00',
	`descripcion` TEXT NULL DEFAULT NULL COLLATE 'utf8mb4_unicode_ci',
	`created_at` DATETIME NULL DEFAULT current_timestamp(),
	`updated_at` DATETIME NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
	`deleted_at` DATETIME NULL DEFAULT NULL,
	PRIMARY KEY (`id`) USING BTREE
);

INSERT INTO `auxiliar_bonificaciones` (`id`, `nombre`, `puntaje`, `descripcion`, `created_at`, `updated_at`, `deleted_at`) VALUES (1, '15% Ley N 29973 por condicion de discapacidad', 15.00, NULL, '2024-03-12 01:35:43', '2024-03-12 01:37:31', NULL);
INSERT INTO `auxiliar_bonificaciones` (`id`, `nombre`, `puntaje`, `descripcion`, `created_at`, `updated_at`, `deleted_at`) VALUES (2, '10% Ley N 29948 por ser licenciado de las FFAA', 10.00, NULL, '2024-03-12 01:35:43', '2024-03-12 01:37:37', NULL);
INSERT INTO `auxiliar_bonificaciones` (`id`, `nombre`, `puntaje`, `descripcion`, `created_at`, `updated_at`, `deleted_at`) VALUES (3, '20% Ley N 27674 por ser deportistas calificados de alto nivel a la administracion publica', 20.00, NULL, '2024-03-12 01:35:43', '2024-03-12 01:37:44', NULL);
INSERT INTO `auxiliar_bonificaciones` (`id`, `nombre`, `puntaje`, `descripcion`, `created_at`, `updated_at`, `deleted_at`) VALUES (4, '16% Ley N 27674 por ser deportistas calificados de alto nivel a la administracion publica', 16.00, NULL, '2024-03-12 01:35:43', '2024-03-12 01:37:44', NULL);
INSERT INTO `auxiliar_bonificaciones` (`id`, `nombre`, `puntaje`, `descripcion`, `created_at`, `updated_at`, `deleted_at`) VALUES (5, '12% Ley N 27674 por ser deportistas calificados de alto nivel a la administracion publica', 12.00, NULL, '2024-03-12 01:35:43', '2024-03-12 01:37:44', NULL);
INSERT INTO `auxiliar_bonificaciones` (`id`, `nombre`, `puntaje`, `descripcion`, `created_at`, `updated_at`, `deleted_at`) VALUES (6, '8% Ley N 27674 por ser deportistas calificados de alto nivel a la administracion publica', 8.00, NULL, '2024-03-12 01:35:43', '2024-03-12 01:37:44', NULL);
INSERT INTO `auxiliar_bonificaciones` (`id`, `nombre`, `puntaje`, `descripcion`, `created_at`, `updated_at`, `deleted_at`) VALUES (7, '4% Ley N 27674 por ser deportistas calificados de alto nivel a la administracion publica', 4.00, NULL, '2024-03-12 01:35:43', '2024-03-12 01:37:44', NULL);
INSERT INTO `auxiliar_bonificaciones` (`id`, `nombre`, `puntaje`, `descripcion`, `created_at`, `updated_at`, `deleted_at`) VALUES (8, 'Sin Bonificacion', 0.00, NULL, '2024-03-12 01:35:43', '2024-03-12 01:37:44', NULL);


CREATE TABLE `auxiliar_especialidad_prelaciones` (
	`id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
	`prelacion` VARCHAR(255) NULL DEFAULT NULL COLLATE 'utf8mb4_unicode_ci',
	`especialidad_id` INT(11) UNSIGNED NOT NULL DEFAULT '0',
	`created_at` DATETIME NULL DEFAULT current_timestamp(),
	`updated_at` DATETIME NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
	`deleted_at` DATETIME NULL DEFAULT NULL,
	PRIMARY KEY (`id`) USING BTREE
);


INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (1, 'A', 1, '2024-02-20 12:05:07', '2024-02-20 12:05:31', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (2, 'B', 1, '2024-02-20 12:05:09', '2024-02-20 12:05:33', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (3, 'C', 1, '2024-02-20 12:05:11', '2024-02-20 12:05:33', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (4, 'D', 1, '2024-02-20 12:05:13', '2024-02-20 12:05:34', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (5, 'E', 1, '2024-02-20 12:05:40', '2024-02-20 12:05:42', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (6, 'A', 2, '2024-02-20 12:05:48', '2024-02-20 12:06:00', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (7, 'B', 2, '2024-02-20 12:05:51', '2024-02-20 12:06:01', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (8, 'C', 2, '2024-02-20 12:05:54', '2024-02-20 12:06:02', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (9, 'D', 2, '2024-02-20 12:05:55', '2024-02-20 12:06:02', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (10, 'A', 3, '2024-02-22 11:30:57', '2024-02-22 11:31:14', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (11, 'B', 3, '2024-02-22 11:31:00', '2024-02-22 11:31:14', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (12, 'C', 3, '2024-02-22 11:31:01', '2024-02-22 11:31:15', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (13, 'D', 3, '2024-02-22 11:31:02', '2024-02-22 11:31:16', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (14, 'A', 13, '2024-02-22 11:31:45', '2024-02-22 11:31:46', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (15, 'B', 13, '2024-02-22 11:31:47', '2024-02-22 11:31:51', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (16, 'C', 13, '2024-02-22 11:31:48', '2024-02-22 11:31:52', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (17, 'D', 13, '2024-02-22 11:31:49', '2024-02-22 11:31:53', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (18, 'A', 4, '2024-02-22 11:32:20', '2024-02-22 11:32:29', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (19, 'B', 4, '2024-02-22 11:32:24', '2024-02-22 11:32:30', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (20, 'C', 4, '2024-02-22 11:32:25', '2024-02-22 11:32:30', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (21, 'D', 4, '2024-02-22 11:32:26', '2024-02-22 11:32:31', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (22, 'E', 4, '2024-02-22 11:32:27', '2024-02-22 11:32:41', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (23, 'A', 14, '2024-02-22 11:33:03', '2024-02-22 11:33:06', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (24, 'B', 14, '2024-02-22 11:33:07', '2024-02-22 11:33:13', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (25, 'C', 14, '2024-02-22 11:33:08', '2024-02-22 11:33:14', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (26, 'D', 14, '2024-02-22 11:33:08', '2024-02-22 11:33:14', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (27, 'E', 14, '2024-02-22 11:33:09', '2024-02-22 11:33:15', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (28, 'A', 9, '2024-02-22 11:33:39', '2024-02-22 11:33:49', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (29, 'B', 9, '2024-02-22 11:33:40', '2024-02-22 11:33:50', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (30, 'C', 9, '2024-02-22 11:33:42', '2024-02-22 11:33:50', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (31, 'D', 9, '2024-02-22 11:33:43', '2024-02-22 11:33:51', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (32, 'A', 5, '2024-02-22 11:34:26', '2024-02-22 11:34:33', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (33, 'B', 5, '2024-02-22 11:34:27', '2024-02-22 11:34:34', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (34, 'C', 5, '2024-02-22 11:34:30', '2024-02-22 11:34:35', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (35, 'D', 5, '2024-02-22 11:34:31', '2024-02-22 11:34:37', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (36, 'A', 6, '2024-02-22 11:35:01', '2024-02-22 11:35:07', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (37, 'B', 6, '2024-02-22 11:35:03', '2024-02-22 11:35:07', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (38, 'C', 6, '2024-02-22 11:35:04', '2024-02-22 11:35:08', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (39, 'D', 6, '2024-02-22 11:35:05', '2024-02-22 11:35:09', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (40, 'A', 7, '2024-02-22 11:35:36', '2024-02-22 11:35:56', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (41, 'B', 7, '2024-02-22 11:35:43', '2024-02-22 11:35:57', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (42, 'C', 7, '2024-02-22 11:35:53', '2024-02-22 11:35:59', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (43, 'D', 7, '2024-02-22 11:35:54', '2024-02-22 11:36:00', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (44, 'A', 12, '2024-02-22 11:36:27', '2024-02-22 11:36:32', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (45, 'B', 12, '2024-02-22 11:36:28', '2024-02-22 11:36:33', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (46, 'C', 12, '2024-02-22 11:36:29', '2024-02-22 11:36:34', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (47, 'D', 12, '2024-02-22 11:36:30', '2024-02-22 11:36:34', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (48, 'A', 10, '2024-02-22 11:36:47', '2024-02-22 11:36:57', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (49, 'B', 10, '2024-02-22 11:36:48', '2024-02-22 11:36:58', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (50, 'C', 10, '2024-02-22 11:36:49', '2024-02-22 11:36:59', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (51, 'D', 10, '2024-02-22 11:36:50', '2024-02-22 11:36:59', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (52, 'E', 10, '2024-02-22 11:37:02', '2024-02-22 11:37:04', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (53, 'A', 8, '2024-02-22 11:37:22', '2024-02-22 11:37:28', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (54, 'B', 8, '2024-02-22 11:37:23', '2024-02-22 11:37:29', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (55, 'C', 8, '2024-02-22 11:37:24', '2024-02-22 11:37:30', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (56, 'D', 8, '2024-02-22 11:37:25', '2024-02-22 11:37:31', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (57, 'A', 11, '2024-02-22 11:39:41', '2024-02-22 11:39:56', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (58, 'B', 11, '2024-02-22 11:39:43', '2024-02-22 11:39:57', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (59, 'C', 11, '2024-02-22 11:39:44', '2024-02-22 11:39:58', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (60, 'D', 11, '2024-02-22 11:39:45', '2024-02-22 11:39:58', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (61, 'E', 11, '2024-02-22 11:39:46', '2024-02-22 11:39:59', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (62, 'F', 11, '2024-02-22 11:39:50', '2024-02-22 11:40:08', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (63, 'G', 11, '2024-02-22 11:39:50', '2024-02-22 11:40:09', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (64, 'H', 11, '2024-02-22 11:39:51', '2024-02-22 11:40:25', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (65, 'A', 23, '2024-02-22 11:40:43', '2024-02-22 11:41:00', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (66, 'B', 23, '2024-02-22 11:40:45', '2024-02-22 11:41:00', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (67, 'C', 23, '2024-02-22 11:40:53', '2024-02-22 11:41:01', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (68, 'D', 23, '2024-02-22 11:40:54', '2024-02-22 11:41:02', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (69, 'E', 23, '2024-02-22 11:41:10', '2024-02-22 11:41:11', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (70, 'A', 26, '2024-02-22 11:41:24', '2024-02-22 11:41:43', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (71, 'B', 26, '2024-02-22 11:41:30', '2024-02-22 11:41:44', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (72, 'C', 26, '2024-02-22 11:41:33', '2024-02-22 11:41:45', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (73, 'D', 26, '2024-02-22 11:41:35', '2024-02-22 11:41:46', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (74, 'E', 26, '2024-02-22 11:41:41', '2024-02-22 11:41:46', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (75, 'A', 21, '2024-02-22 11:42:52', '2024-02-22 11:42:56', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (76, 'B', 21, '2024-02-22 11:42:53', '2024-02-22 11:42:57', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (77, 'C', 21, '2024-02-22 11:42:54', '2024-02-22 11:42:58', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (78, 'D', 21, '2024-02-22 11:42:55', '2024-02-22 11:42:58', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (79, 'A', 22, '2024-02-22 11:43:10', '2024-02-22 11:43:18', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (80, 'B', 22, '2024-02-22 11:43:12', '2024-02-22 11:43:19', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (81, 'C', 22, '2024-02-22 11:43:13', '2024-02-22 11:43:19', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (82, 'D', 22, '2024-02-22 11:43:14', '2024-02-22 11:43:20', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (83, 'E', 22, '2024-02-22 11:43:30', '2024-02-22 11:43:31', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (84, 'A', 17, '2024-02-22 11:43:52', '2024-02-22 11:44:02', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (85, 'B', 17, '2024-02-22 11:43:56', '2024-02-22 11:44:03', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (86, 'C', 17, '2024-02-22 11:43:58', '2024-02-22 11:44:04', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (87, 'D', 17, '2024-02-22 11:43:59', '2024-02-22 11:44:04', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (88, 'E', 17, '2024-02-22 11:44:00', '2024-02-22 11:44:05', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (89, 'A', 16, '2024-02-22 11:44:28', '2024-02-22 11:44:38', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (90, 'B', 16, '2024-02-22 11:44:31', '2024-02-22 11:44:38', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (91, 'C', 16, '2024-02-22 11:44:33', '2024-02-22 11:44:39', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (92, 'D', 16, '2024-02-22 11:44:35', '2024-02-22 11:44:40', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (93, 'E', 16, '2024-02-22 11:44:36', '2024-02-22 11:44:41', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (94, 'A', 20, '2024-02-22 11:44:56', '2024-02-22 11:45:01', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (95, 'B', 20, '2024-02-22 11:44:56', '2024-02-22 11:45:02', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (96, 'C', 20, '2024-02-22 11:44:57', '2024-02-22 11:45:02', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (97, 'D', 20, '2024-02-22 11:44:58', '2024-02-22 11:45:03', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (98, 'E', 20, '2024-02-22 11:44:59', '2024-02-22 11:45:04', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (99, 'A', 19, '2024-02-22 11:45:24', '2024-02-22 11:45:31', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (100, 'B', 19, '2024-02-22 11:45:26', '2024-02-22 11:45:31', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (101, 'C', 19, '2024-02-22 11:45:27', '2024-02-22 11:45:32', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (102, 'D', 19, '2024-02-22 11:45:27', '2024-02-22 11:45:33', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (103, 'E', 19, '2024-02-22 11:45:28', '2024-02-22 11:45:33', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (104, 'A', 18, '2024-02-22 11:46:24', '2024-02-22 11:46:37', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (105, 'B', 18, '2024-02-22 11:46:25', '2024-02-22 11:46:38', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (106, 'C', 18, '2024-02-22 11:46:25', '2024-02-22 11:46:38', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (107, 'D', 18, '2024-02-22 11:46:26', '2024-02-22 11:46:40', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (108, 'E', 18, '2024-02-22 11:46:29', '2024-02-22 11:46:40', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (109, 'A', 24, '2024-02-22 11:47:54', '2024-02-22 11:47:57', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (110, 'B', 24, '2024-02-22 11:47:56', '2024-02-22 11:47:58', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (111, 'A', 53, '2024-02-22 11:49:29', '2024-02-22 11:49:37', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (112, 'B', 53, '2024-02-22 11:49:33', '2024-02-22 11:49:38', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (113, 'C', 53, '2024-02-22 11:49:34', '2024-02-22 11:49:38', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (114, 'D', 53, '2024-02-22 11:49:35', '2024-02-22 11:49:39', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (115, 'E', 53, '2024-02-22 11:50:33', '2024-02-22 11:50:39', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (116, 'A', 52, '2024-02-22 11:50:41', '2024-02-22 11:50:46', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (117, 'B', 52, '2024-02-22 11:50:41', '2024-02-22 11:50:47', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (118, 'C', 52, '2024-02-22 11:50:42', '2024-02-22 11:50:47', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (119, 'D', 52, '2024-02-22 11:50:43', '2024-02-22 11:50:48', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (120, 'E', 52, '2024-02-22 11:50:44', '2024-02-22 11:50:49', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (121, 'A', 27, '2024-02-22 11:55:58', '2024-02-22 11:55:58', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (122, 'B', 27, '2024-02-22 11:55:58', '2024-02-22 11:55:58', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (123, 'C', 27, '2024-02-22 11:55:58', '2024-02-22 11:55:58', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (124, 'D', 27, '2024-02-22 11:55:58', '2024-02-22 11:55:58', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (125, 'E', 27, '2024-02-22 11:55:58', '2024-02-22 11:55:58', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (126, 'A', 28, '2024-02-22 11:55:58', '2024-02-22 11:55:58', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (127, 'B', 28, '2024-02-22 11:55:58', '2024-02-22 11:55:58', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (128, 'C', 28, '2024-02-22 11:55:58', '2024-02-22 11:55:58', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (129, 'D', 28, '2024-02-22 11:55:58', '2024-02-22 11:55:58', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (130, 'E', 28, '2024-02-22 11:55:58', '2024-02-22 11:55:58', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (131, 'A', 29, '2024-02-22 11:55:58', '2024-03-11 21:11:27', '2024-03-11 16:11:27');
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (132, 'B', 29, '2024-02-22 11:55:58', '2024-03-11 21:11:18', '2024-03-11 16:11:18');
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (133, 'C', 29, '2024-02-22 11:55:58', '2024-03-11 21:11:13', '2024-03-11 16:11:13');
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (134, 'D', 29, '2024-02-22 11:55:58', '2024-03-11 21:11:07', '2024-03-11 16:11:07');
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (135, 'E', 29, '2024-02-22 11:55:58', '2024-03-11 21:10:59', '2024-03-11 16:10:59');
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (136, 'A', 30, '2024-02-22 11:55:58', '2024-02-22 11:55:58', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (137, 'B', 30, '2024-02-22 11:55:58', '2024-02-22 11:55:58', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (138, 'C', 30, '2024-02-22 11:55:58', '2024-02-22 11:55:58', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (139, 'D', 30, '2024-02-22 11:55:58', '2024-02-22 11:55:58', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (140, 'E', 30, '2024-02-22 11:55:58', '2024-02-22 11:55:58', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (141, 'A', 31, '2024-02-22 11:55:58', '2024-02-22 11:55:58', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (142, 'B', 31, '2024-02-22 11:55:58', '2024-02-22 11:55:58', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (143, 'C', 31, '2024-02-22 11:55:58', '2024-02-22 11:55:58', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (144, 'D', 31, '2024-02-22 11:55:58', '2024-02-22 11:55:58', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (145, 'E', 31, '2024-02-22 11:55:58', '2024-02-22 11:55:58', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (146, 'A', 32, '2024-02-22 11:55:58', '2024-02-22 11:55:58', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (147, 'B', 32, '2024-02-22 11:55:58', '2024-02-22 11:55:58', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (148, 'C', 32, '2024-02-22 11:55:58', '2024-02-22 11:55:58', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (149, 'D', 32, '2024-02-22 11:55:58', '2024-02-22 11:55:58', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (150, 'E', 32, '2024-02-22 11:55:58', '2024-02-22 11:55:58', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (151, 'A', 33, '2024-02-22 11:55:58', '2024-02-22 11:55:58', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (152, 'B', 33, '2024-02-22 11:55:58', '2024-02-22 11:55:58', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (153, 'C', 33, '2024-02-22 11:55:58', '2024-02-22 11:55:58', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (154, 'D', 33, '2024-02-22 11:55:58', '2024-02-22 11:55:58', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (155, 'E', 33, '2024-02-22 11:55:58', '2024-02-22 11:55:58', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (156, 'A', 34, '2024-02-22 11:55:58', '2024-02-22 11:55:58', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (157, 'B', 34, '2024-02-22 11:55:58', '2024-02-22 11:55:58', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (158, 'C', 34, '2024-02-22 11:55:58', '2024-02-22 11:55:58', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (159, 'D', 34, '2024-02-22 11:55:58', '2024-02-22 11:55:58', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (160, 'E', 34, '2024-02-22 11:55:58', '2024-02-22 11:55:58', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (161, 'A', 35, '2024-02-22 11:55:58', '2024-02-22 11:55:58', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (162, 'B', 35, '2024-02-22 11:55:58', '2024-02-22 11:55:58', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (163, 'C', 35, '2024-02-22 11:55:58', '2024-02-22 11:55:58', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (164, 'D', 35, '2024-02-22 11:55:58', '2024-02-22 11:55:58', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (165, 'E', 35, '2024-02-22 11:55:58', '2024-02-22 11:55:58', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (166, 'A', 36, '2024-02-22 11:55:58', '2024-02-22 11:55:58', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (167, 'B', 36, '2024-02-22 11:55:58', '2024-02-22 11:55:58', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (168, 'C', 36, '2024-02-22 11:55:58', '2024-02-22 11:55:58', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (169, 'D', 36, '2024-02-22 11:55:58', '2024-02-22 11:55:58', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (170, 'E', 36, '2024-02-22 11:55:58', '2024-02-22 11:55:58', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (171, 'A', 37, '2024-02-22 11:55:58', '2024-02-22 11:55:58', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (172, 'B', 37, '2024-02-22 11:55:58', '2024-02-22 11:55:58', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (173, 'C', 37, '2024-02-22 11:55:58', '2024-02-22 11:55:58', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (174, 'D', 37, '2024-02-22 11:55:58', '2024-02-22 11:55:58', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (175, 'E', 37, '2024-02-22 11:55:58', '2024-02-22 11:55:58', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (176, 'A', 38, '2024-02-22 11:55:58', '2024-02-22 11:55:58', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (177, 'B', 38, '2024-02-22 11:55:58', '2024-02-22 11:55:58', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (178, 'C', 38, '2024-02-22 11:55:58', '2024-02-22 11:55:58', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (179, 'D', 38, '2024-02-22 11:55:58', '2024-02-22 11:55:58', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (180, 'E', 38, '2024-02-22 11:55:58', '2024-02-22 11:55:58', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (181, 'A', 39, '2024-02-22 11:58:11', '2024-02-22 11:58:11', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (182, 'B', 39, '2024-02-22 11:58:11', '2024-02-22 11:58:11', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (183, 'A', 40, '2024-02-22 11:58:11', '2024-02-22 11:58:11', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (184, 'B', 40, '2024-02-22 11:58:11', '2024-02-22 11:58:11', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (185, 'A', 41, '2024-02-22 11:58:11', '2024-02-22 11:58:11', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (186, 'B', 41, '2024-02-22 11:58:11', '2024-02-22 11:58:11', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (187, 'A', 42, '2024-02-22 11:58:11', '2024-02-22 11:58:11', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (188, 'B', 42, '2024-02-22 11:58:11', '2024-02-22 11:58:11', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (189, 'A', 43, '2024-02-22 11:58:11', '2024-02-22 11:58:11', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (190, 'B', 43, '2024-02-22 11:58:11', '2024-02-22 11:58:11', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (191, 'A', 44, '2024-02-22 11:58:11', '2024-02-22 11:58:11', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (192, 'B', 44, '2024-02-22 11:58:11', '2024-02-22 11:58:11', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (193, 'A', 45, '2024-02-22 11:58:11', '2024-02-22 11:58:11', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (194, 'B', 45, '2024-02-22 11:58:11', '2024-02-22 11:58:11', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (195, 'A', 46, '2024-02-22 11:58:11', '2024-02-22 11:58:11', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (196, 'B', 46, '2024-02-22 11:58:11', '2024-02-22 11:58:11', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (197, 'A', 47, '2024-02-22 11:58:11', '2024-02-22 11:58:11', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (198, 'B', 47, '2024-02-22 11:58:11', '2024-02-22 11:58:11', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (199, 'A', 48, '2024-02-22 11:58:11', '2024-02-22 11:58:11', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (200, 'B', 48, '2024-02-22 11:58:11', '2024-02-22 11:58:11', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (201, 'A', 49, '2024-02-22 11:58:49', '2024-02-22 11:59:41', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (202, 'B', 49, '2024-02-22 11:58:51', '2024-02-22 11:59:41', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (203, 'C', 49, '2024-02-22 11:58:52', '2024-02-22 11:59:42', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (204, 'D', 49, '2024-02-22 11:58:53', '2024-02-22 11:59:42', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (205, 'E', 49, '2024-02-22 11:59:44', '2024-02-22 11:59:46', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (207, 'C', 39, '2024-02-24 00:06:19', '2024-02-24 00:06:22', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (208, 'C', 40, '2024-02-24 00:06:23', '2024-02-24 00:06:27', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (209, 'C', 41, '2024-02-24 00:06:29', '2024-02-24 00:06:32', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (210, 'C', 42, '2024-02-24 00:06:35', '2024-02-24 00:06:38', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (211, 'C', 43, '2024-02-24 00:06:40', '2024-02-24 00:06:43', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (212, 'C', 44, '2024-02-24 00:06:47', '2024-02-24 00:06:49', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (213, 'C', 45, '2024-02-24 00:06:52', '2024-02-24 00:06:54', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (214, 'C', 46, '2024-02-24 00:06:57', '2024-02-24 00:07:00', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (215, 'C', 47, '2024-02-24 00:07:02', '2024-02-24 00:07:06', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (216, 'C', 48, '2024-02-24 00:07:08', '2024-02-24 00:07:11', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (217, 'F', 27, '2024-03-01 04:09:13', '2024-03-01 04:09:21', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (218, 'F', 28, '2024-03-01 04:09:37', '2024-03-01 04:10:09', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (219, 'F', 29, '2024-03-01 04:10:10', '2024-03-11 21:10:45', '2024-03-11 16:10:45');
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (220, 'F', 30, '2024-03-01 04:10:14', '2024-03-01 04:10:16', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (221, 'F', 31, '2024-03-01 04:10:17', '2024-03-01 04:10:19', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (222, 'F', 32, '2024-03-01 04:10:20', '2024-03-01 04:10:21', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (223, 'F', 33, '2024-03-01 04:10:22', '2024-03-01 04:10:23', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (224, 'F', 34, '2024-03-01 04:10:26', '2024-03-01 04:10:29', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (225, 'F', 35, '2024-03-01 04:10:32', '2024-03-01 04:10:33', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (226, 'F', 36, '2024-03-01 04:10:37', '2024-03-01 04:10:39', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (227, 'F', 37, '2024-03-01 04:10:42', '2024-03-01 04:10:43', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (228, 'F', 38, '2024-03-01 04:10:45', '2024-03-01 04:10:47', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (229, 'F', 49, '2024-03-01 04:10:50', '2024-03-01 04:10:51', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (230, 'G', 49, '2024-03-11 19:45:24', '2024-03-11 19:45:24', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (231, 'H', 49, '2024-03-11 19:45:44', '2024-03-11 19:45:44', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (232, 'I', 49, '2024-03-11 19:45:59', '2024-03-11 19:45:59', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (233, 'J', 49, '2024-03-11 19:46:18', '2024-03-11 19:46:18', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (234, 'K', 49, '2024-03-11 19:51:44', '2024-03-11 19:51:44', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (235, 'G', 29, '2024-03-11 19:53:02', '2024-03-11 21:10:51', '2024-03-11 16:10:51');
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (236, 'G', 30, '2024-03-11 21:10:02', '2024-03-12 12:09:40', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (237, 'H', 30, '2024-03-11 21:10:18', '2024-03-12 12:09:44', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (238, 'I', 30, '2024-03-11 21:10:34', '2024-03-12 12:09:47', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (239, 'J', 30, '2024-03-11 21:11:54', '2024-03-12 12:10:22', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (240, 'K', 30, '2024-03-11 21:12:22', '2024-03-12 12:10:23', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (241, 'A', 54, '2024-03-11 21:14:29', '2024-03-11 21:14:29', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (242, 'B', 54, '2024-03-11 21:14:42', '2024-03-11 21:14:42', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (243, 'C', 54, '2024-03-11 21:14:53', '2024-03-11 21:14:53', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (244, 'D', 54, '2024-03-11 21:15:05', '2024-03-11 21:15:05', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (245, 'E', 54, '2024-03-11 21:15:16', '2024-03-11 21:15:16', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (246, 'F', 54, '2024-03-11 21:15:32', '2024-03-11 21:15:32', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (247, 'G', 54, '2024-03-11 21:15:50', '2024-03-11 21:15:50', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (248, 'H', 54, '2024-03-11 21:16:02', '2024-03-11 21:16:02', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (249, 'I', 54, '2024-03-11 21:16:14', '2024-03-11 21:16:14', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (250, 'J', 54, '2024-03-11 21:16:29', '2024-03-11 21:16:29', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (251, 'K', 54, '2024-03-11 21:16:43', '2024-03-11 21:16:43', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (252, 'G', 37, '2024-03-11 21:19:38', '2024-03-11 21:19:38', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (253, 'H', 37, '2024-03-11 21:19:51', '2024-03-11 21:19:51', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (254, 'I', 37, '2024-03-11 21:20:07', '2024-03-11 21:20:07', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (255, 'J', 37, '2024-03-11 21:20:29', '2024-03-11 21:20:29', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (257, 'K', 37, '2024-03-11 21:21:35', '2024-03-11 21:21:35', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (258, 'G', 34, '2024-03-11 21:22:57', '2024-03-11 21:22:57', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (259, 'H', 34, '2024-03-11 21:23:18', '2024-03-11 21:23:18', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (260, 'I', 34, '2024-03-11 21:23:51', '2024-03-11 21:23:51', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (261, 'K', 34, '2024-03-11 21:24:20', '2024-03-12 12:12:42', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (262, 'J', 34, '2024-03-11 21:24:55', '2024-03-12 12:12:42', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (263, 'A', 56, '2024-03-11 21:36:15', '2024-03-11 21:36:15', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (264, 'B', 56, '2024-03-11 21:36:28', '2024-03-11 21:36:28', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (265, 'C', 56, '2024-03-11 21:36:41', '2024-03-11 21:36:41', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (266, 'D', 56, '2024-03-11 21:36:54', '2024-03-11 21:36:54', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (267, 'E', 56, '2024-03-11 21:37:05', '2024-03-11 21:37:05', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (268, 'F', 56, '2024-03-11 21:37:25', '2024-03-11 21:37:25', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (269, 'G', 56, '2024-03-11 21:37:50', '2024-03-11 21:37:50', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (270, 'H', 56, '2024-03-11 21:38:01', '2024-03-11 21:38:01', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (271, 'F', 1, '2024-02-20 12:05:40', '2024-02-20 12:05:42', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (272, 'E', 2, '2024-02-20 12:05:55', '2024-02-20 12:06:02', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (273, 'F', 2, '2024-02-20 12:05:55', '2024-02-20 12:06:02', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (274, 'E', 3, '2024-02-22 11:31:02', '2024-02-22 11:31:16', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (275, 'F', 3, '2024-02-22 11:31:02', '2024-02-22 11:31:16', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (276, 'G', 3, '2024-02-22 11:31:02', '2024-02-22 11:31:16', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (277, 'H', 3, '2024-02-22 11:31:02', '2024-02-22 11:31:16', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (278, 'I', 3, '2024-02-22 11:31:02', '2024-02-22 11:31:16', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (279, 'J', 3, '2024-02-22 11:31:02', '2024-02-22 11:31:16', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (280, 'K', 3, '2024-02-22 11:31:02', '2024-02-22 11:31:16', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (281, 'L', 3, '2024-02-22 11:31:02', '2024-02-22 11:31:16', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (282, 'M', 3, '2024-02-22 11:31:02', '2024-02-22 11:31:16', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (283, 'N', 3, '2024-02-22 11:31:02', '2024-02-22 11:31:16', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (284, 'O', 3, '2024-02-22 11:31:02', '2024-02-22 11:31:16', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (285, 'P', 3, '2024-02-22 11:31:02', '2024-02-22 11:31:16', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (287, 'F', 4, '2024-02-22 11:32:27', '2024-02-22 11:32:41', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (288, 'G', 4, '2024-02-22 11:32:27', '2024-02-22 11:32:41', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (289, 'H', 4, '2024-02-22 11:32:27', '2024-02-22 11:32:41', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (290, 'I', 4, '2024-02-22 11:32:27', '2024-02-22 11:32:41', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (291, 'E', 9, '2024-02-22 11:33:43', '2024-02-22 11:33:51', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (292, 'F', 9, '2024-02-22 11:33:43', '2024-02-22 11:33:51', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (293, 'G', 9, '2024-02-22 11:33:43', '2024-02-22 11:33:51', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (294, 'H', 9, '2024-02-22 11:33:43', '2024-02-22 11:33:51', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (295, 'I', 9, '2024-02-22 11:33:43', '2024-02-22 11:33:51', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (296, 'J', 9, '2024-02-22 11:33:43', '2024-02-22 11:33:51', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (297, 'K', 9, '2024-02-22 11:33:43', '2024-02-22 11:33:51', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (300, 'E', 5, '2024-02-22 11:34:31', '2024-02-22 11:34:37', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (301, 'F', 5, '2024-02-22 11:34:31', '2024-02-22 11:34:37', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (302, 'G', 5, '2024-02-22 11:34:31', '2024-02-22 11:34:37', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (303, 'H', 5, '2024-02-22 11:34:31', '2024-02-22 11:34:37', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (304, 'I', 5, '2024-02-22 11:34:31', '2024-02-22 11:34:37', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (305, 'J', 5, '2024-02-22 11:34:31', '2024-02-22 11:34:37', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (306, 'K', 5, '2024-02-22 11:34:31', '2024-02-22 11:34:37', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (307, 'L', 5, '2024-02-22 11:34:31', '2024-02-22 11:34:37', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (308, 'M', 5, '2024-02-22 11:34:31', '2024-02-22 11:34:37', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (309, 'N', 5, '2024-02-22 11:34:31', '2024-02-22 11:34:37', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (310, 'O', 5, '2024-02-22 11:34:31', '2024-02-22 11:34:37', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (311, 'P', 5, '2024-02-22 11:34:31', '2024-02-22 11:34:37', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (312, 'Q', 5, '2024-02-22 11:34:31', '2024-02-22 11:34:37', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (313, 'E', 6, '2024-02-22 11:35:05', '2024-02-22 11:35:09', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (314, 'F', 6, '2024-02-22 11:35:05', '2024-02-22 11:35:09', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (315, 'G', 6, '2024-02-22 11:35:05', '2024-02-22 11:35:09', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (316, 'H', 6, '2024-02-22 11:35:05', '2024-02-22 11:35:09', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (317, 'E', 7, '2024-02-22 11:35:54', '2024-02-22 11:36:00', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (318, 'F', 7, '2024-02-22 11:35:54', '2024-02-22 11:36:00', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (319, 'G', 7, '2024-02-22 11:35:54', '2024-02-22 11:36:00', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (320, 'E', 12, '2024-02-22 11:36:34', '2024-02-22 11:36:34', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (321, 'F', 12, '2024-02-22 11:36:34', '2024-02-22 11:36:34', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (322, 'G', 12, '2024-02-22 11:36:34', '2024-02-22 11:36:34', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (323, 'H', 12, '2024-02-22 11:36:34', '2024-02-22 11:36:34', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (324, 'I', 12, '2024-02-22 11:36:34', '2024-02-22 11:36:34', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (325, 'J', 12, '2024-02-22 11:36:34', '2024-02-22 11:36:34', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (327, 'F', 10, '2024-02-22 11:37:04', '2024-03-12 12:01:50', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (328, 'G', 10, '2024-02-22 11:37:04', '2024-03-12 12:01:50', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (329, 'H', 10, '2024-02-22 11:37:04', '2024-03-12 12:01:50', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (330, 'I', 10, '2024-02-22 11:37:04', '2024-03-12 12:01:50', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (331, 'J', 10, '2024-02-22 11:37:04', '2024-03-12 12:01:50', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (332, 'K', 10, '2024-02-22 11:37:04', '2024-03-12 12:01:50', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (333, 'E', 8, '2024-02-22 11:37:25', '2024-02-22 11:37:25', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (334, 'F', 8, '2024-02-22 11:37:25', '2024-02-22 11:37:25', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (335, 'G', 8, '2024-02-22 11:37:25', '2024-02-22 11:37:25', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (336, 'H', 8, '2024-02-22 11:37:25', '2024-02-22 11:37:25', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (337, 'I', 8, '2024-02-22 11:37:25', '2024-02-22 11:37:25', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (338, 'J', 8, '2024-02-22 11:37:25', '2024-02-22 11:37:25', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (339, 'K', 8, '2024-02-22 11:37:25', '2024-02-22 11:37:25', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (340, 'L', 8, '2024-02-22 11:37:25', '2024-02-22 11:37:25', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (341, 'M', 8, '2024-02-22 11:37:25', '2024-02-22 11:37:25', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (342, 'N', 8, '2024-02-22 11:37:25', '2024-02-22 11:37:25', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (343, 'O', 8, '2024-02-22 11:37:25', '2024-02-22 11:37:25', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (344, 'P', 8, '2024-02-22 11:37:25', '2024-02-22 11:37:25', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (345, 'Q', 8, '2024-02-22 11:37:25', '2024-02-22 11:37:25', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (346, 'R', 8, '2024-02-22 11:37:25', '2024-02-22 11:37:25', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (347, 'S', 8, '2024-02-22 11:37:25', '2024-02-22 11:37:25', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (348, 'T', 8, '2024-02-22 11:37:25', '2024-02-22 11:37:25', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (349, 'U', 8, '2024-02-22 11:37:25', '2024-02-22 11:37:25', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (352, 'G', 27, '2024-03-01 04:09:13', '2024-03-01 04:09:21', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (353, 'H', 27, '2024-03-01 04:09:13', '2024-03-01 04:09:21', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (354, 'I', 27, '2024-03-01 04:09:13', '2024-03-01 04:09:21', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (355, 'J', 27, '2024-03-01 04:09:13', '2024-03-01 04:09:21', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (356, 'K', 27, '2024-03-01 04:09:13', '2024-03-01 04:09:21', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (357, 'G', 28, '2024-03-01 04:09:37', '2024-03-12 12:08:15', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (358, 'H', 28, '2024-03-01 04:09:37', '2024-03-12 12:08:15', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (359, 'I', 28, '2024-03-01 04:09:37', '2024-03-12 12:08:15', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (360, 'J', 28, '2024-03-01 04:09:37', '2024-03-12 12:08:15', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (361, 'K', 28, '2024-03-01 04:09:37', '2024-03-12 12:08:15', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (362, 'H', 29, '2024-03-11 19:53:02', '2024-03-12 12:08:53', '2024-03-11 16:10:51');
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (363, 'I', 29, '2024-03-11 19:53:02', '2024-03-12 12:08:53', '2024-03-11 16:10:51');
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (364, 'J', 29, '2024-03-11 19:53:02', '2024-03-12 12:08:53', '2024-03-11 16:10:51');
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (365, 'K', 29, '2024-03-11 19:53:02', '2024-03-12 12:08:53', '2024-03-11 16:10:51');
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (366, 'G', 31, '2024-03-01 04:10:17', '2024-03-01 04:10:17', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (367, 'H', 31, '2024-03-01 04:10:17', '2024-03-01 04:10:17', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (368, 'I', 31, '2024-03-01 04:10:17', '2024-03-01 04:10:17', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (369, 'J', 31, '2024-03-01 04:10:17', '2024-03-01 04:10:17', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (370, 'K', 31, '2024-03-01 04:10:17', '2024-03-01 04:10:17', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (371, 'G', 32, '2024-03-01 04:10:20', '2024-03-01 04:10:21', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (372, 'H', 32, '2024-03-01 04:10:20', '2024-03-01 04:10:21', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (373, 'I', 32, '2024-03-01 04:10:20', '2024-03-01 04:10:21', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (374, 'J', 32, '2024-03-01 04:10:20', '2024-03-01 04:10:21', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (375, 'K', 32, '2024-03-01 04:10:20', '2024-03-01 04:10:21', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (376, 'G', 33, '2024-03-01 04:10:22', '2024-03-01 04:10:22', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (377, 'H', 33, '2024-03-01 04:10:22', '2024-03-01 04:10:22', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (378, 'I', 33, '2024-03-01 04:10:22', '2024-03-01 04:10:22', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (379, 'J', 33, '2024-03-01 04:10:22', '2024-03-01 04:10:22', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (380, 'K', 33, '2024-03-01 04:10:22', '2024-03-01 04:10:22', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (381, 'G', 35, '2024-03-01 04:10:32', '2024-03-01 04:10:32', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (382, 'H', 35, '2024-03-01 04:10:32', '2024-03-01 04:10:32', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (383, 'I', 35, '2024-03-01 04:10:32', '2024-03-01 04:10:32', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (384, 'J', 35, '2024-03-01 04:10:32', '2024-03-01 04:10:32', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (385, 'K', 35, '2024-03-01 04:10:32', '2024-03-01 04:10:32', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (386, 'G', 36, '2024-03-01 04:10:37', '2024-03-01 04:10:37', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (387, 'H', 36, '2024-03-01 04:10:37', '2024-03-01 04:10:37', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (388, 'I', 36, '2024-03-01 04:10:37', '2024-03-01 04:10:37', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (389, 'J', 36, '2024-03-01 04:10:37', '2024-03-01 04:10:37', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (390, 'K', 36, '2024-03-01 04:10:37', '2024-03-01 04:10:37', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (391, 'G', 38, '2024-03-01 04:10:47', '2024-03-01 04:10:47', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (392, 'H', 38, '2024-03-01 04:10:47', '2024-03-01 04:10:47', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (393, 'I', 38, '2024-03-01 04:10:47', '2024-03-01 04:10:47', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (394, 'J', 38, '2024-03-01 04:10:47', '2024-03-01 04:10:47', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (395, 'K', 38, '2024-03-01 04:10:47', '2024-03-01 04:10:47', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (396, 'C', 24, '2024-02-22 11:47:56', '2024-02-22 11:47:58', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (397, 'D', 24, '2024-02-22 11:47:56', '2024-02-22 11:47:58', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (398, 'E', 24, '2024-02-22 11:47:56', '2024-02-22 11:47:58', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (399, 'A', 57, '2024-03-12 07:22:43', '2024-03-12 07:22:43', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (400, 'B', 57, '2024-03-12 07:22:43', '2024-03-12 07:22:43', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (401, 'C', 57, '2024-03-12 07:22:43', '2024-03-12 07:22:43', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (402, 'D', 57, '2024-03-12 07:22:43', '2024-03-12 07:22:43', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (403, 'E', 57, '2024-03-12 07:22:43', '2024-03-12 07:22:43', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (404, 'D', 39, '2024-02-24 00:06:22', '2024-02-24 00:06:22', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (405, 'E', 39, '2024-02-24 00:06:22', '2024-02-24 00:06:22', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (406, 'F', 39, '2024-02-24 00:06:22', '2024-02-24 00:06:22', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (407, 'G', 39, '2024-02-24 00:06:22', '2024-02-24 00:06:22', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (408, 'H', 39, '2024-02-24 00:06:22', '2024-02-24 00:06:22', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (409, 'D', 40, '2024-02-24 00:06:22', '2024-03-12 12:25:38', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (410, 'E', 40, '2024-02-24 00:06:22', '2024-03-12 12:25:38', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (411, 'F', 40, '2024-02-24 00:06:22', '2024-03-12 12:25:38', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (412, 'G', 40, '2024-02-24 00:06:22', '2024-03-12 12:25:38', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (413, 'H', 40, '2024-02-24 00:06:22', '2024-03-12 12:25:38', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (414, 'D', 41, '2024-02-24 00:06:32', '2024-02-24 00:06:32', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (415, 'E', 41, '2024-02-24 00:06:32', '2024-02-24 00:06:32', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (416, 'F', 41, '2024-02-24 00:06:32', '2024-02-24 00:06:32', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (417, 'G', 41, '2024-02-24 00:06:32', '2024-02-24 00:06:32', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (418, 'H', 41, '2024-02-24 00:06:32', '2024-02-24 00:06:32', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (419, 'D', 42, '2024-02-24 00:06:35', '2024-02-24 00:06:35', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (420, 'E', 42, '2024-02-24 00:06:35', '2024-02-24 00:06:35', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (421, 'F', 42, '2024-02-24 00:06:35', '2024-02-24 00:06:35', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (422, 'G', 42, '2024-02-24 00:06:35', '2024-02-24 00:06:35', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (423, 'H', 42, '2024-02-24 00:06:35', '2024-02-24 00:06:35', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (424, 'D', 43, '2024-02-24 00:06:40', '2024-02-24 00:06:40', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (425, 'E', 43, '2024-02-24 00:06:40', '2024-02-24 00:06:40', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (426, 'F', 43, '2024-02-24 00:06:40', '2024-02-24 00:06:40', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (427, 'G', 43, '2024-02-24 00:06:40', '2024-02-24 00:06:40', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (428, 'H', 43, '2024-02-24 00:06:40', '2024-02-24 00:06:40', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (429, 'D', 44, '2024-02-24 00:06:47', '2024-02-24 00:06:47', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (430, 'E', 44, '2024-02-24 00:06:47', '2024-02-24 00:06:47', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (431, 'F', 44, '2024-02-24 00:06:47', '2024-02-24 00:06:47', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (432, 'G', 44, '2024-02-24 00:06:47', '2024-02-24 00:06:47', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (433, 'H', 44, '2024-02-24 00:06:47', '2024-02-24 00:06:47', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (434, 'D', 45, '2024-02-24 00:06:52', '2024-02-24 00:06:52', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (435, 'E', 45, '2024-02-24 00:06:52', '2024-02-24 00:06:52', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (436, 'F', 45, '2024-02-24 00:06:52', '2024-02-24 00:06:52', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (437, 'G', 45, '2024-02-24 00:06:52', '2024-02-24 00:06:52', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (438, 'H', 45, '2024-02-24 00:06:52', '2024-02-24 00:06:52', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (439, 'D', 46, '2024-02-24 00:06:57', '2024-02-24 00:06:57', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (440, 'E', 46, '2024-02-24 00:06:57', '2024-02-24 00:06:57', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (441, 'F', 46, '2024-02-24 00:06:57', '2024-02-24 00:06:57', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (442, 'G', 46, '2024-02-24 00:06:57', '2024-02-24 00:06:57', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (443, 'H', 46, '2024-02-24 00:06:57', '2024-02-24 00:06:57', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (444, 'D', 47, '2024-02-24 00:07:02', '2024-02-24 00:07:02', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (445, 'E', 47, '2024-02-24 00:07:02', '2024-02-24 00:07:02', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (446, 'F', 47, '2024-02-24 00:07:02', '2024-02-24 00:07:02', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (447, 'G', 47, '2024-02-24 00:07:02', '2024-02-24 00:07:02', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (448, 'H', 47, '2024-02-24 00:07:02', '2024-02-24 00:07:02', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (449, 'D', 48, '2024-02-24 00:07:08', '2024-02-24 00:07:08', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (450, 'E', 48, '2024-02-24 00:07:08', '2024-02-24 00:07:08', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (451, 'F', 48, '2024-02-24 00:07:08', '2024-02-24 00:07:08', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (452, 'G', 48, '2024-02-24 00:07:08', '2024-02-24 00:07:08', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (453, 'H', 48, '2024-02-24 00:07:08', '2024-02-24 00:07:08', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (454, 'A', 55, '2024-03-12 20:40:31', '2024-03-12 20:40:31', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (455, 'B', 55, '2024-03-12 20:40:55', '2024-03-12 20:40:55', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (456, 'C', 55, '2024-03-12 20:41:10', '2024-03-12 20:41:10', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (457, 'D', 55, '2024-03-12 20:42:46', '2024-03-12 20:42:46', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (458, 'E', 55, '2024-03-12 20:43:06', '2024-03-12 20:43:06', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (459, 'A', 58, '2024-03-18 22:12:24', '2024-03-18 22:12:24', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (460, 'B', 58, '2024-03-18 22:13:04', '2024-03-18 22:13:04', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (461, 'C', 58, '2024-03-18 22:13:13', '2024-03-18 22:13:13', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (462, 'D', 58, '2024-03-18 22:13:25', '2024-03-18 22:13:25', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (463, 'E', 58, '2024-03-18 22:13:34', '2024-03-18 22:13:34', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (464, 'F', 58, '2024-03-18 22:14:00', '2024-03-18 22:14:00', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (465, 'G', 58, '2024-03-18 22:14:09', '2024-03-18 22:14:09', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (466, 'H', 58, '2024-03-18 22:14:20', '2024-03-18 22:14:20', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (467, 'I', 58, '2024-03-18 22:14:35', '2024-03-18 22:14:35', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (468, 'J', 58, '2024-03-18 22:14:44', '2024-03-18 22:14:44', NULL);
INSERT INTO `auxiliar_especialidad_prelaciones` (`id`, `prelacion`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (469, 'K', 58, '2024-03-18 22:14:58', '2024-03-18 22:14:58', NULL);



CREATE TABLE `auxiliar_periodo_fichas` (
	`id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
	`nombre` VARCHAR(255) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
	`plantilla` TEXT NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
	`tipo_id` INT(11) UNSIGNED NULL DEFAULT '0',
	`periodo_id` INT(11) UNSIGNED NULL DEFAULT '0',
	`descripcion` VARCHAR(255) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
	`promedio` INT(11) UNSIGNED NULL DEFAULT '0',
	`orden` INT(11) UNSIGNED NULL DEFAULT '0',
	`created_at` DATETIME NULL DEFAULT current_timestamp(),
	`updated_at` DATETIME NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
	`deleted_at` DATETIME NULL DEFAULT NULL,
	PRIMARY KEY (`id`) USING BTREE
);

INSERT INTO `auxiliar_periodo_fichas` (`id`, `nombre`, `plantilla`, `tipo_id`, `periodo_id`, `descripcion`, `promedio`, `orden`, `created_at`, `updated_at`, `deleted_at`) VALUES (1, 'Anexo 13', '{"sections":[{"id":278487897935,"name":"Formaci\\u00f3n Acad\\u00e9mica y Profesional","position":0,"score":"47","groups":[{"id":510700731415,"name":"Estudios de posgrado","type_id":1,"position":0,"score":"38","questions":[{"id":669901504318,"name":"Grado de Doctor. (m\\u00e1ximo 1)","position":0,"score":"10","options":[{"id":904426686744,"name":"3 cursos","position":0,"score":"1","type":0},{"id":690401995183,"name":"6 cursos","position":0,"score":"2","type":0},{"id":574092590529,"name":"9 cursos","position":0,"score":"3","type":0}],"type":"selectiva","observation_status":1},{"id":471685961826,"name":"Estudios concluidos de Doctorado","position":0,"score":"7","options":[],"type":"marcado"},{"id":1386041234498,"name":"Grado de Maestro\\/Magister. (m\\u00e1ximo 1)","position":0,"score":"8","options":[],"type":"marcado"},{"id":461785294614,"name":"Estudios concluidos de Maestr\\u00eda","position":0,"score":"5","options":[],"type":"numerico"},{"id":299944151858,"name":"Diplomado\\/Especializaci\\u00f3n, a nivel de Posgrado (hasta un m\\u00e1ximo de dos(2)","position":0,"score":"3","options":[],"type":"marcado"}]},{"id":966180316910,"name":"Estudios de pregrado","type_id":1,"position":0,"score":0,"questions":[{"id":210214086833,"name":"Otro T\\u00edtulo Profesional Pedag\\u00f3gico o T\\u00edtulo de Segunda Especialidad en Educaci\\u00f3n, no af\\u00edn al nivel o ciclo de la especialidad que postula (m\\u00e1ximo 1)","position":0,"score":"6","options":[],"type":"numerico"},{"id":929587823747,"name":"Otro T\\u00edtulo Universitario no Pedag\\u00f3gico (m\\u00e1ximo 1)","position":0,"score":"5","options":[],"type":"numerico"},{"id":1184435783500,"name":"Otro T\\u00edtulo Profesional T\\u00e9cnico (m\\u00e1ximo 1)","position":0,"score":"3","options":[],"type":"numerico"}]}]},{"id":641888213236,"name":"Formaci\\u00f3n Continua","position":0,"score":"3","groups":[{"id":359612152638,"name":"Talleres, capacitaci\\u00f3n, seminarios o congresos","type_id":1,"position":0,"score":0,"questions":[{"id":1493827940389,"name":"Realizado en los \\u00faltimos cinco (5) a\\u00f1os.\\nDuraci\\u00f3n m\\u00ednima de 16 horas pedag\\u00f3gicas.\\nPresenciales, virtuales o semipresenciales.\\nM\\u00e1ximo de tres (3)","position":0,"score":"1","options":[],"type":"numerico"},{"id":1389722125327,"name":"Tiene de 4 a m\\u00e1s a\\u00f1os adicionales al m\\u00ednimo requerido","position":0,"score":"2","options":[],"type":"numerico"}]}]},{"id":1570308861059,"name":"Experiencia Laboral","position":0,"score":"24","groups":[{"id":141790068280,"name":"Experiencia Laboral docente,\\ndurante los meses de marzo a diciembre, teniendo en cuenta","type_id":1,"position":0,"score":0,"questions":[{"id":1384426154455,"name":"Corresponde 0.20 puntos por cada mes acreditado de labor en IE ubicada en zona urbana. Corresponde 0.30 puntos por cada mes acreditado de labor en IE ubicada en zona de frontera. Corresponde 0.30 puntos por cada mes acreditado de labor en IE ubicada en zona rural. Corresponde 0.40 puntos por cada mes acreditado de labor en IE ubicada en zona VRAEM.","position":0,"score":"13","options":[],"type":"numerico"},{"id":1040688223918,"name":"Tiene de 4 a m\\u00e1s a\\u00f1os adicionales al m\\u00ednimo requerido","position":0,"score":"4","options":[],"type":"numerico"}]},{"id":1590150668232,"name":"Experiencia laboral como PEC","type_id":1,"position":0,"score":0,"questions":[{"id":1300044711716,"name":"Corresponde 0.10 puntos por cada mes acreditado (solo para postular al\\nnivel inicial).","position":0,"score":"4","options":[],"type":"numerico"},{"id":861982020443,"name":"Tiene de 4 a m\\u00e1s a\\u00f1os adicionales al m\\u00ednimo requerido","position":0,"score":"3","options":[],"type":"numerico"}]}]},{"id":107797951453,"name":"M\\u00e9ritos","position":0,"score":"8","groups":[{"id":1610513886669,"name":"Felicitaci\\u00f3n por desempe\\u00f1o o trabajo destacado en el campo pedag\\u00f3gico","type_id":"2","position":0,"score":"5","questions":[{"id":891404070946,"name":"Resoluci\\u00f3n Ministerial emitida por MINEDU (3 puntos). Resoluci\\u00f3n emitida por la DRE o de UGEL (2 puntos)","position":0,"score":"5","options":[],"type":"numerico"},{"id":1194430752118,"name":"Cumple con el tercer Cursos y\\/o Estudios de Especializaci\\u00f3n","position":0,"score":"3","options":[],"type":"numerico"}]}]}]}', 0, 1, NULL, 0, 0, '2023-10-31 04:17:49', '2023-11-23 18:03:29', NULL);
INSERT INTO `auxiliar_periodo_fichas` (`id`, `nombre`, `plantilla`, `tipo_id`, `periodo_id`, `descripcion`, `promedio`, `orden`, `created_at`, `updated_at`, `deleted_at`) VALUES (2, 'Anexo 14', '{"sections":[{"id":1209307724712,"name":"FORMACI0N ACADEMICA","position":0,"score":"52","groups":[{"id":564889126834,"name":"1.1 Estudios de pregrado","position":0,"score":"3","questions":[{"id":1362724145467,"name":"T\\u00edtulo profesional","position":0,"score":"7","answers":[]},{"id":1092942509780,"name":"T\\u00edtulo profesional t\\u00e9cnico","position":0,"score":"6","answers":[]},{"id":1192888700698,"name":"T\\u00edtulo t\\u00e9cnico","position":0,"score":"5","answers":[]}]},{"id":729231710471,"name":"1.2 Estudios de posgrado","position":0,"score":0,"questions":[{"id":997400661726,"name":"Grado de doctor","position":0,"score":"3","answers":[]},{"id":1470842958033,"name":"Estudios de doctorado","position":0,"score":"2","answers":[]},{"id":1350515465517,"name":"Grado de maestro\\/mag\\u00edster","position":0,"score":"2","answers":[]},{"id":42703057291,"name":"Estudios concluidos de maestr\\u00eda","position":0,"score":"1","answers":[]}]},{"id":585788727369,"name":"1.3 Capacitaci\\u00f3n y actualizaci\\u00f3n en la especialidad","position":0,"score":0,"questions":[{"id":743906276429,"name":"Programas afines a la especialidad con duraci\\u00f3n mayor a 96 horas o su equivalente en cr\\u00e9ditos. Dos (2) puntos por cada 96 horas acumuladas en los \\u00faltimos 5 a\\u00f1os, hasta 12 puntos.","position":0,"score":"12","answers":[]},{"id":1461227966461,"name":"Programas afines a la especialidad con duraci\\u00f3n\\nigual o mayor a 16 horas y hasta 96 horas o su\\nequivalente en cr\\u00e9ditos. Un (1) punto por cada 16 horas acumuladas en los\\n\\u00faltimos 5 a\\u00f1os, hasta 8 puntos.","position":0,"score":"8","answers":[]}]},{"id":97700825143,"name":"1.4 Otros programas de formaci\\u00f3n continua, incluyendo temas de pedagog\\u00eda","position":0,"score":0,"questions":[{"id":175989034156,"name":"Programas con duraci\\u00f3n mayor a 96 horas o su\\nequivalente en cr\\u00e9ditos Dos (2) puntos por cada 96 horas acumuladas en los\\n\\u00faltimos 5 a\\u00f1os, hasta 6 puntos","position":0,"score":"6","answers":[]},{"id":1542708142724,"name":"Programas con duraci\\u00f3n igual o mayor a 16 horas y\\nhasta 96 horas o su equivalente en cr\\u00e9ditos. Un (1) punto por cada 16 horas acumuladas en los\\n\\u00faltimos 5 a\\u00f1os, hasta 4 puntos","position":0,"score":"4","answers":[]},{"id":409491722610,"name":"Cursos de Ofim\\u00e1tica igual o mayores a 24 horas o\\nsu equivalente en cr\\u00e9ditos. 1 punto por cada 24 horas acumuladas en los \\u00faltimos 5\\na\\u00f1os, hasta 4 puntos","position":0,"score":"4","answers":[]},{"id":184167895204,"name":"Certificaci\\u00f3n de dominio del idioma ingl\\u00e9s. Nivel Avanzado","position":0,"score":"4","answers":[]},{"id":491086770935,"name":"Lenguas Originarias. Incorporados en el RNDBLO","position":0,"score":"4","answers":[]}]}]},{"id":107168914640,"name":"2. EXPERIENCIA LABORAL","position":0,"score":"40","groups":[{"id":1064372763231,"name":"2.1 Experiencia laboral en el sector productivo (IIEE o privadas)  ","position":0,"score":0,"questions":[{"id":1502895473448,"name":"Tres (3) puntos por cada a\\u00f1o de experiencia profesional\\nno docente en el sector productivo de la especialidad en\\nlos \\u00faltimos 10 a\\u00f1os.","position":0,"score":"30","answers":[]}]},{"id":73426368134,"name":"2.2 Experiencia docente en Educaci\\u00f3n Superior o\\nT\\u00e9cnico \\u2013 productiva","position":0,"score":0,"questions":[{"id":716200461622,"name":"Un (1) punto por a\\u00f1o de experiencia docente dentro de\\nlos \\u00faltimos 10 a\\u00f1os.","position":0,"score":"10","answers":[]}]}]},{"id":790085968000,"name":"3. M\\u00c9RITOS","position":0,"score":"8","groups":[{"id":1264032213169,"name":"Reconocimiento o felicitaci\\u00f3n por logro o\\ncontribuci\\u00f3n en la gesti\\u00f3n o pr\\u00e1ctica pedag\\u00f3gica o\\nproyecto de innovaci\\u00f3n o investigaci\\u00f3n.","position":0,"score":0,"questions":[{"id":1181679959004,"name":"Dos (2) puntos por cada reconocimiento, hasta 8 puntos","position":0,"score":"8","answers":[]}]}]}]}', 0, 1, NULL, 0, 0, '2023-10-31 04:17:58', '2023-10-31 06:42:08', NULL);
INSERT INTO `auxiliar_periodo_fichas` (`id`, `nombre`, `plantilla`, `tipo_id`, `periodo_id`, `descripcion`, `promedio`, `orden`, `created_at`, `updated_at`, `deleted_at`) VALUES (3, 'VERIFICACION DE REQUISITOS Y ANEXOS', '{"sections":[{"id":1237951341916,"name":"VERIFCACION DE DECLARACIONES JURADAS Y REQUISITOS DE POSTULACION","position":0,"score":0,"groups":[{"id":163531500789,"name":"DECLARACION JURADA PARA EL PROCEDIMIENTO DE CONTRATACION","position":0,"score":0,"questions":[{"id":870192728131,"name":"ANEXO 1","position":0,"score":0,"type":"selectiva","caption":"","options":[{"id":987748361071,"name":"SI","position":0,"score":"SI","type":0},{"id":538878973142,"name":"NO","position":0,"score":"NO","type":0}],"observation_status":0},{"id":411567189611,"name":"ANEXO 8","position":0,"score":0,"type":"selectiva","caption":"","options":[{"id":1412087759085,"name":"SI","position":0,"score":"SI","type":0},{"id":1575913150107,"name":"NO","position":0,"score":"NO","type":0}],"observation_status":0},{"id":1112177157822,"name":"ANEXO 9","position":0,"score":0,"type":"selectiva","caption":"","options":[{"id":1007849779325,"name":"SI","position":0,"score":"SI","type":0},{"id":1455364586206,"name":"NO","position":0,"score":"NO","type":0}],"observation_status":0},{"id":723462394977,"name":"ANEXO 10","position":0,"score":0,"type":"selectiva","caption":"","options":[{"id":1137682102744,"name":"SI","position":0,"score":"SI","type":0},{"id":874887501536,"name":"NO","position":0,"score":"NO","type":0}],"observation_status":0},{"id":182154597883,"name":"ANEXO 11","position":0,"score":0,"type":"selectiva","caption":"","options":[{"id":478911223097,"name":"SI","position":0,"score":"SI","type":0},{"id":1105819821203,"name":"NO","position":0,"score":"NO","type":0}],"observation_status":0},{"id":1050707463348,"name":"ANEXO 12","position":0,"score":0,"type":"selectiva","caption":"","options":[{"id":1597923029304,"name":"SI","position":0,"score":"SI","type":0},{"id":1582477019133,"name":"NO","position":0,"score":"NO","type":0}],"observation_status":0},{"id":977690039610,"name":"ANEXO 19","position":0,"score":0,"type":"selectiva","caption":"","options":[{"id":377549188076,"name":"SI","position":0,"score":"SI","type":0},{"id":1642668109939,"name":"NO","position":0,"score":"NO","type":0}]}]},{"id":1119624230166,"name":"REQUISITOS DE POSTULACION","position":0,"score":0,"questions":[{"id":8397841200,"name":"CUMPLE CON LOS REQUISTOS DE FORMACION ACADEMICA","position":0,"score":0,"type":"selectiva","caption":"","options":[{"id":52807048410,"name":"SI","position":0,"score":"SI","type":0},{"id":1109077113773,"name":"NO","position":0,"score":"NO","type":0}],"observation_status":0},{"id":330440918281,"name":"GOZAR DE BUENA SALUD FISICA, MENTAL ","position":0,"score":0,"type":"selectiva","caption":"","options":[{"id":669222148190,"name":"SI","position":0,"score":"SI","type":0},{"id":1488840169896,"name":"NO","position":0,"score":"NO","type":0}]},{"id":242372701436,"name":"TENER MENOS DE 65 A\\u00d1OS","position":0,"score":0,"type":"selectiva","caption":"","options":[{"id":1376120608046,"name":"SI","position":0,"score":"SI","type":0},{"id":384635973727,"name":"NO","position":0,"score":"NO","type":0}]}]},{"id":226103097551,"name":"OBSERVACIONES DE LA EVALUACION DE ANEXOS Y REQUISTOS DE POSTULACION","position":0,"score":0,"questions":[{"id":1646950579742,"name":"OBSERVACIONES","position":0,"score":0,"type":"","caption":"","options":[],"observation_status":1}]},{"id":312266934399,"name":"SOLO PARA POSTULANTES DE LA ESPECIALIDAD DE EDUCACION PARA EL TRABAJO EBR Y EBA","position":0,"score":0,"questions":[{"id":1684916438476,"name":"COLOCAR LA ESPECIALIDAD A  CUAL POSTULA, Ejemplo: COMPUTACION INFORMATIVA","position":0,"score":0,"type":"","caption":"","options":[],"observation_status":1}]}]}]}', 1, 1, 'CRITERIOS PARA LA EBALUACION DEL EXPEDIENTE PARA EB', NULL, 1, '2024-01-24 15:55:04', '2024-02-21 04:54:14', NULL);
INSERT INTO `auxiliar_periodo_fichas` (`id`, `nombre`, `plantilla`, `tipo_id`, `periodo_id`, `descripcion`, `promedio`, `orden`, `created_at`, `updated_at`, `deleted_at`) VALUES (4, 'ANEXO 13', '{"sections":[{"id":1203873109654,"name":"Formaci\\u00f3n Acad\\u00e9mica y Profesional   ","position":0,"score":"37","groups":[{"id":1199214565349,"name":"Estudios de posgrado","position":0,"score":0,"questions":[{"id":1297574005842,"name":"Grado de doctor. (maximo 1)","position":0,"score":"13","type":"marcado","caption":"","options":[]},{"id":159484498423,"name":"Grado de maestro\\/magister. (maximo 1)","position":0,"score":"10","type":"marcado","caption":"","options":[]},{"id":928553246660,"name":"Diplomados en gestion pedagogica con un minimo de 24 creditos, equivalente a 384 horas academicas. (maximo 2) (*)","position":0,"score":"2","type":"numerico","caption":"","options":[]}]},{"id":1498583199528,"name":"Estudios de pregrado","position":0,"score":0,"questions":[{"id":692757282660,"name":"Otro titulo profesional pedagogico o titulo de segunda especialidad en educacion, no afin al nivel o ciclo de la especialidad que postula (maximo 1)","position":0,"score":"5","type":"marcado","caption":"","options":[]},{"id":1356583357539,"name":"Otro titulo universitario no pedag\\u00f3gico (m\\u00e1ximo 1)","position":0,"score":"4","type":"marcado","caption":"","options":[]},{"id":585626961491,"name":"Otro titulo profesional tecnico (maximo 1)","position":0,"score":"3","type":"marcado","caption":"","options":[]}]}]},{"id":625306891395,"name":"Formacion Continua","position":0,"score":"2","groups":[{"id":670688487461,"name":"Capacitaciones en gestion pedagogicaa","position":0,"score":0,"questions":[{"id":331965645410,"name":". Realizado en los \\u00faltimos cinco (5) a\\u00f1os.\\n. Duraci\\u00f3n m\\u00ednima de 16 horas pedag\\u00f3gicas.\\n. Otorgadas a treves de las plataformas de Edutalentos y PeruEduca. (**)\\n. Maximo cero punto cinco por c\\/u (0.5 c\\/u)","position":0,"score":"2","type":"numerico","caption":"","options":[]}]}]},{"id":27484193690,"name":"Experiencia Laboral","position":0,"score":"26","groups":[{"id":857521860493,"name":"Experiencia Laboral docente, durante los meses de marzo a diciembre, teniendo en cuenta","position":0,"score":0,"questions":[{"id":598524453338,"name":". Corresponde 0.20 puntos por cada mes acreditado de labor e IE ubicada en zona urbana.\\n. Corresponde 0.30 puntos por cada mes acreditado de labor e IE ubicada en zona de frontera.\\n. Corresponde 0.30 puntos por cada mes acreditado de labor e IE ubicada en zona rural.\\n. Corresponde 0.40 puntos por cada mes acreditado de labor e IE ubicada en zona VRAEM.","position":0,"score":"22","type":"numerico","caption":"","options":[]}]},{"id":1376331317040,"name":"Experiencia laboral como PEC ","position":0,"score":0,"questions":[{"id":987450625236,"name":"Corresponde 0.10 puntos por cada mes acreditado (solo para postular al nivel incial).","position":0,"score":"4","type":"numerico","caption":"","options":[]}]}]},{"id":79804937665,"name":"Meritos","position":0,"score":"4","groups":[{"id":1233420791348,"name":"Felicitacion por desempe\\u00f1o o trabajo destacado en el campo pedagogico ","position":0,"score":0,"questions":[{"id":315887324634,"name":"Resoluci\\u00f3n Ministerial emitida por Minedu (3 puntos)\\nResolucion emitida por la DRE (2 puntos)\\nResolucion emitida por la UGEL (1 punto)","position":0,"score":"5","type":"numerico","caption":"","options":[]}]}]}]}', 1, 1, 'CRITERIOS PARA LA EVALUACION DEL EXPEDEINTE PARA EB', 1, 2, '2024-01-24 16:31:26', '2024-02-02 15:45:01', NULL);
INSERT INTO `auxiliar_periodo_fichas` (`id`, `nombre`, `plantilla`, `tipo_id`, `periodo_id`, `descripcion`, `promedio`, `orden`, `created_at`, `updated_at`, `deleted_at`) VALUES (5, 'ANEXO 13', NULL, 1, 1, 'CRITERIOS PARA LA EVALUACION DEL EXPEDEINTE PARA EB', 1, 2, '2024-01-24 16:31:26', '2024-01-24 16:32:45', '2024-01-24 16:46:20');
INSERT INTO `auxiliar_periodo_fichas` (`id`, `nombre`, `plantilla`, `tipo_id`, `periodo_id`, `descripcion`, `promedio`, `orden`, `created_at`, `updated_at`, `deleted_at`) VALUES (6, 'ANEXO 13', NULL, 1, 1, 'CRITERIOS PARA LA EVALUACION DEL EXPEDEINTE PARA EB', 1, 2, '2024-01-24 16:31:26', '2024-01-24 16:33:37', '2024-01-24 16:47:12');
INSERT INTO `auxiliar_periodo_fichas` (`id`, `nombre`, `plantilla`, `tipo_id`, `periodo_id`, `descripcion`, `promedio`, `orden`, `created_at`, `updated_at`, `deleted_at`) VALUES (7, 'VERIFICACION DE REQUISITOS Y ANEXOS', '{"sections":[{"id":470486782910,"name":"DECLARACION JURADA PARA EL PROCEDIMIENTO DE CONTRATACION EVALUACION DE REQUISITOS","position":0,"score":0,"groups":[{"id":1126068013226,"name":"DECLARACION JURADA PARA EL PROCEDIMIENTO DE CONTRATACION","position":0,"score":0,"questions":[{"id":1590284599228,"name":"ANEXO 1","position":0,"score":0,"type":"selectiva","caption":"","options":[{"id":103008244695,"name":"SI","position":0,"score":"SI","type":0,"value":"SI"},{"id":731249719258,"name":"NO","position":0,"score":"NO","type":0,"value":"NO"}]},{"id":393860204063,"name":"ANEXO 8","position":0,"score":0,"type":"selectiva","caption":"","options":[{"id":414253371856,"name":"SI","position":0,"score":"SI","type":0,"value":"SI"},{"id":1322003185481,"name":"NO","position":0,"score":"NO","type":0,"value":"NO"}]},{"id":436753462886,"name":"ANEXO 9","position":0,"score":0,"type":"selectiva","caption":"","options":[{"id":1290615613557,"name":"SI","position":0,"score":"SI","type":0,"value":"SI"},{"id":884365859124,"name":"NO","position":0,"score":"NO","type":0,"value":"NO"}]},{"id":560315126537,"name":"ANEXO 10","position":0,"score":0,"type":"selectiva","caption":"","options":[{"id":1184086433529,"name":"SI","position":0,"score":"SI","type":0,"value":"SI"},{"id":1335614364738,"name":"NO","position":0,"score":"NO","type":0,"value":"NO"}]},{"id":1446123059450,"name":"ANEXO 11","position":0,"score":0,"type":"selectiva","caption":"","options":[{"id":1042881706620,"name":"SI","position":0,"score":"SI","type":0,"value":"SI"},{"id":919001509219,"name":"NO","position":0,"score":"NO","type":0,"value":"NO"}]},{"id":1115149893673,"name":"ANEXO 12","position":0,"score":0,"type":"selectiva","caption":"","options":[{"id":1177110403683,"name":"SI","position":0,"score":"SI","type":0,"value":"SI"},{"id":943931675174,"name":"NO","position":0,"score":"NO","type":0,"value":"NO"}]},{"id":205294231878,"name":"ANEXO 19 ","position":0,"score":0,"type":"selectiva","caption":"","options":[{"id":1052072915812,"name":"SI","position":0,"score":"SI","type":0,"value":"SI"},{"id":475517986940,"name":"NO","position":0,"score":"NO","type":0,"value":"NO"}]}]},{"id":818968513459,"name":"REQUISITOS DE POSTULACION","position":0,"score":0,"questions":[{"id":214839674665,"name":"CUMPLE CON LOS REQUISTOS DE FORMACION ACADEMICA","position":0,"score":0,"type":"selectiva","caption":"","options":[{"id":104703092966,"name":"SI","position":0,"score":"SI","type":0,"value":"SI"},{"id":369611396746,"name":"NO","position":0,"score":"NO","type":0,"value":"NO"}]},{"id":1459119722685,"name":"GOZAR DE BUENA SALUD FISICA, MENTAL ","position":0,"score":0,"type":"selectiva","caption":"","options":[{"id":739988015853,"name":"SI","position":0,"score":"SI","type":0,"value":"SI"},{"id":770973244968,"name":"NO","position":0,"score":"NO","type":0,"value":"NO"}]},{"id":978017259351,"name":"TENER MENOS DE 65 A\\u00d1OS","position":0,"score":0,"type":"selectiva","caption":"","options":[{"id":702828421135,"name":"SI","position":0,"score":"SI","type":0,"value":"SI"},{"id":264349586133,"name":"NO","position":0,"score":"NO","type":0,"value":"NO"}]}]},{"id":1678345141015,"name":"OBSERVACIONES DE LA EVALUACION DE ANEXOS Y REQUISTOS DE POSTULACION","position":0,"score":0,"questions":[{"id":257004498332,"name":"OBSERVACIONES","position":0,"score":0,"type":"","caption":"","options":[],"observation_status":1}]},{"id":455455144400,"name":"ATENCION DE RECLAMOS","position":0,"score":0,"questions":[{"id":1580816677438,"name":"ABSOLUCI\\u00d3N","position":0,"score":0,"type":"","caption":"","options":[],"observation_status":1}]}]}]}', 2, 1, 'VERIFCACION DE DECLARACIONES JURADAS Y REQUISITOS DE POSTULACION', NULL, 1, '2024-02-21 21:29:48', '2024-02-23 05:06:39', NULL);
INSERT INTO `auxiliar_periodo_fichas` (`id`, `nombre`, `plantilla`, `tipo_id`, `periodo_id`, `descripcion`, `promedio`, `orden`, `created_at`, `updated_at`, `deleted_at`) VALUES (8, 'ANEXO 13', '{"sections":[{"id":207752221455,"name":"Formaci\\u00f3n Acad\\u00e9mica y Profesional   ","position":0,"score":"37","groups":[{"id":1143898068385,"name":"Estudios de posgrado","position":0,"score":0,"questions":[{"id":1629259870114,"name":"Grado de doctor. (maximo 1)","position":0,"score":"13","type":"marcado","caption":"","options":[]},{"id":80255713750,"name":"Grado de maestro\\/magister. (maximo 1)","position":0,"score":"10","type":"marcado","caption":"","options":[]},{"id":1360007189556,"name":"Diplomados en gestion pedagogica con un minimo de 24 creditos, equivalente a 384 horas academicas. (maximo 2) (*)","position":0,"score":"2","type":"tabla","caption":"","options":[{"id":1032163820826,"name":"Numero de Diplomados en gesti\\u00f3n pedag\\u00f3gica ","position":0,"score":"1","type":0,"value":0}]}]},{"id":1257600664039,"name":"Estudios de pregrado","position":0,"score":0,"questions":[{"id":775366147443,"name":"Otro titulo profesional pedagogico o titulo de segunda especialidad en educacion, no afin al nivel o ciclo de la especialidad que postula (maximo 1)","position":0,"score":"5","type":"marcado","caption":"","options":[]},{"id":699156501807,"name":"Otro titulo universitario no pedag\\u00f3gico (m\\u00e1ximo 1)","position":0,"score":"4","type":"marcado","caption":"","options":[]},{"id":1251965517168,"name":"Otro titulo profesional tecnico (maximo 1)","position":0,"score":"3","type":"marcado","caption":"","options":[]}]}]},{"id":1143523629478,"name":"Formacion Continua","position":0,"score":"2","groups":[{"id":359620756223,"name":"Capacitaciones en gesti\\u00f3n pedag\\u00f3gica","position":0,"score":0,"questions":[{"id":310268756973,"name":". Realizado en los \\u00faltimos cinco (5) a\\u00f1os.\\n. Duraci\\u00f3n m\\u00ednima de 16 horas pedag\\u00f3gicas.\\n. Otorgadas a treves de las plataformas de Edutalentos y PeruEduca. (**)\\n. M\\u00e1ximo cero punto cinco por c\\/u (0.5 c\\/u)","position":0,"score":"2","type":"tabla","caption":"","options":[{"id":803809034027,"name":"Capacitaciones en gesti\\u00f3n pedag\\u00f3gica","position":0,"score":"0.5","type":0,"value":0}]}]}]},{"id":300666912752,"name":"Experiencia Laboral","position":0,"score":"26","groups":[{"id":1232102657288,"name":"Experiencia Laboral docente, durante los meses de marzo a diciembre, teniendo en cuenta","position":0,"score":0,"questions":[{"id":1418604861666,"name":". Corresponde 0.20 puntos por cada mes acreditado de labor e IE ubicada en zona urbana.\\n. Corresponde 0.30 puntos por cada mes acreditado de labor e IE ubicada en zona de frontera.\\n. Corresponde 0.30 puntos por cada mes acreditado de labor e IE ubicada en zona rural.\\n. Corresponde 0.40 puntos por cada mes acreditado de labor e IE ubicada en zona VRAEM.","position":0,"score":"22","type":"tabla","caption":"","options":[{"id":1676327179724,"name":"IE ubicada en zona urbana.","position":0,"score":"0.20","type":0,"value":0},{"id":1290440167478,"name":"IE ubicada en zona de frontera.","position":0,"score":"0.30","type":0,"value":0},{"id":518503077797,"name":"IE ubicada en zona rural.","position":0,"score":"0.30","type":0,"value":0},{"id":40688090651,"name":"IE ubicada en zona VRAEM.","position":0,"score":"0.40","type":0,"value":0}]},{"id":582818689989,"name":"Experiencia laboral como PEC. Corresponde 0.10 puntos por cada mes acreditado (solo para postular al nivel incial).","position":0,"score":"4","type":"tabla","caption":"","options":[{"id":456732417903,"name":"Experiencia laboral como PEC.","position":0,"score":"0.10","type":0,"value":0}]}]}]},{"id":1153399758787,"name":"Meritos","position":0,"score":"4","groups":[{"id":199711859350,"name":"Felicitacion por desempe\\u00f1o o trabajo destacado en el campo pedagogico ","position":0,"score":0,"questions":[{"id":595969020639,"name":"Resoluci\\u00f3n Ministerial emitida por Minedu (3 puntos)\\nResoluci\\u00f3n emitida por la DRE (2 puntos)\\nResoluci\\u00f3n emitida por la UGEL (1 punto)","position":0,"score":"5","type":"tabla","caption":"","options":[{"id":800101949053,"name":"Resoluci\\u00f3n Ministerial emitida por Minedu ","position":0,"score":"3","type":0,"value":0},{"id":1024277226530,"name":"Resoluci\\u00f3n emitida por la DRE","position":0,"score":"2","type":0,"value":0},{"id":720742198912,"name":"Resoluci\\u00f3n emitida por la UGEL","position":0,"score":"1","type":0,"value":0}]}]}]}]}', 2, 1, 'CRITERIOS PARA LA EVALUACION DEL EXPEDEINTE PARA EB', 1, 2, '2024-02-21 21:42:51', '2024-02-22 15:53:22', NULL);
INSERT INTO `auxiliar_periodo_fichas` (`id`, `nombre`, `plantilla`, `tipo_id`, `periodo_id`, `descripcion`, `promedio`, `orden`, `created_at`, `updated_at`, `deleted_at`) VALUES (9, 'ANEXO 14', '{"sections":[{"id":595084005667,"name":"Formaci\\u00f3n Acad\\u00e9mica","position":0,"score":"27","groups":[{"id":253506608010,"name":"1.1 Estudios de posgrado","position":0,"score":0,"questions":[{"id":1482726842774,"name":"Grado de doctor","position":0,"score":"13","type":"marcado","caption":"","options":[]},{"id":1176059903384,"name":"Grado de maestro\\/magister","position":0,"score":"10","type":"marcado","caption":"","options":[]},{"id":1460246217982,"name":"Diplomas en gesti\\u00f3n pedag\\u00f3gica con un m\\u00ednimo de 24 cr\\u00e9ditos, equivalente a 384 horas acad\\u00e9micas. (m\\u00e1ximo 2) (*)","position":0,"score":"2","type":"tabla","caption":"","options":[{"id":348288272991,"name":"Numero de Diplomas en gesti\\u00f3n pedag\\u00f3gica","position":0,"score":"1","type":0,"value":0}]}]},{"id":745645765089,"name":"1.2 Estudio de pregrado","position":0,"score":0,"questions":[{"id":598717051062,"name":"Otro titulo pedagogico o de licenciado en educacion.","position":0,"score":"7","type":"marcado","caption":"","options":[]},{"id":433528913849,"name":"Titulo profesional tecnico ","position":0,"score":"6","type":"marcado","caption":"","options":[]},{"id":304515777145,"name":"Titulo tecnico ","position":0,"score":"5","type":"marcado","caption":"","options":[]}]}]},{"id":371872321735,"name":"Formaci\\u00f3n Acad\\u00e9mica ","position":0,"score":"28","groups":[{"id":668105709799,"name":"1.3 Capacitaci\\u00f3n y actualizaci\\u00f3n en la especialidad ","position":0,"score":0,"questions":[{"id":62874284766,"name":"Programas afines a la especialidad con duraci\\u00f3n mayor a 96 horas o su equivalente en cr\\u00e9ditos. \\nDos (2) puntos por cada 96 horas acumuladas en los \\u00faltimos 5 a\\u00f1os, hasta 10 puntos.","position":0,"score":"10","type":"tabla","caption":"","options":[{"id":1305618795386,"name":"Numero de a\\u00f1os","position":0,"score":"2","type":0,"value":0}]},{"id":1617062375205,"name":"Programas afines a la especialidad con una duraci\\u00f3n igual o mayor a 16 horas y hasta 96 horas o su equivalente en cr\\u00e9ditos. Un (1) punto por cada 16 horas acumuladas en los \\u00faltimos 5 a\\u00f1os, hasta 3 puntos","position":0,"score":"3","type":"tabla","caption":"","options":[{"id":261575648119,"name":"Numero de a\\u00f1os","position":0,"score":"1","type":0,"value":0}]}]},{"id":574902563655,"name":"1.4 Otros programas de formaci\\u00f3n continua , incluyendo temas de pedagog\\u00eda","position":0,"score":0,"questions":[{"id":921615439120,"name":"Capacitaci\\u00f3n en gesti\\u00f3n pedag\\u00f3gica\\n. Realizado en los \\u00faltimos cinco (5) a\\u00f1os. \\n. Duraci\\u00f3n m\\u00ednima de 16 horas pedag\\u00f3gicas.\\n. Otorgadas a trav\\u00e9s de las plataformas de Edutalentos y PeruEduca.(**)\\nMaximo cero punto cinco por c\\/u (0.5 c\\/u).","position":0,"score":"6","type":"tabla","caption":"","options":[{"id":1529787247784,"name":"Numero de Capacitaci\\u00f3n en gesti\\u00f3n pedag\\u00f3gica","position":0,"score":"0.5","type":0,"value":0}]},{"id":1443304787992,"name":"Certificado de dominio de idioma ingles. Nivel avanzado","position":0,"score":"4","type":"marcado","caption":"","options":[]},{"id":1171741841902,"name":"Lenguas Originarias. Incorporados en el RNDBLO","position":0,"score":"4","type":"marcado","caption":"","options":[]}]}]},{"id":1145209997311,"name":"Experiencia laboral ","position":0,"score":"40","groups":[{"id":140119065055,"name":"2.1 Experiencia laboral en el sector productivo (IIEE o privadas).","position":0,"score":0,"questions":[{"id":984185155717,"name":"Tres (3) puntos por cada a\\u00f1o de experiencia profesional no docente en el sector productivo de la especialidad en los \\u00faltimos 10 a\\u00f1os. (un a\\u00f1o equivale a 12 meses)","position":0,"score":"30","type":"tabla","caption":"","options":[{"id":912413003999,"name":"Numeros de A\\u00f1os de experiencia.","position":0,"score":"3","type":0,"value":0}]}]},{"id":337906027982,"name":"2.2 Experiencia docente en Educaci\\u00f3n Superior o T\\u00e9cnico - productiva.","position":0,"score":0,"questions":[{"id":464024253048,"name":"Un (1) punto por a\\u00f1o de experiencia docente dentro de los ultimos 10 a\\u00f1os.","position":0,"score":"10","type":"tabla","caption":"","options":[{"id":770175585554,"name":"Numeros de A\\u00f1os de experiencia.","position":0,"score":"1","type":0,"value":0}]}]}]},{"id":1461131871246,"name":"Meritos ","position":0,"score":"5","groups":[{"id":636882438125,"name":"3.1 Felicitacion por desempe\\u00f1o o trabajo destacado en el campo pedagogico","position":0,"score":0,"questions":[{"id":1424116385388,"name":"Resoluci\\u00f3n Ministerial emitida por Minedu (3 puntos)\\nResoluci\\u00f3n emitida por la DRE (2 puntos)\\nResoluci\\u00f3n emitida por la UGEL (1 punto)","position":0,"score":"5","type":"tabla","caption":"","options":[{"id":237023734072,"name":"Numero de Resoluci\\u00f3n Ministerial emitida por Minedu ","position":0,"score":"3","type":0,"value":0},{"id":1355269693238,"name":"Numero de Resoluci\\u00f3n emitida por la DRE","position":0,"score":"2","type":0,"value":0},{"id":814216501861,"name":"Numero de Resoluci\\u00f3n emitida por la UGEL","position":0,"score":"1","type":0,"value":0}]}]}]}]}', 2, 1, 'CRITERIOS PARA LA EVALUACION DEL EXPEDEINTE PARA ETP', 1, 2, '2024-02-22 14:32:27', '2024-02-22 15:47:22', NULL);
INSERT INTO `auxiliar_periodo_fichas` (`id`, `nombre`, `plantilla`, `tipo_id`, `periodo_id`, `descripcion`, `promedio`, `orden`, `created_at`, `updated_at`, `deleted_at`) VALUES (10, 'asdsadsadsa', NULL, 2, 1, 'dsadsadsa', NULL, 1, '2024-06-22 18:12:46', '2024-06-22 18:13:52', '2024-06-22 18:13:52');
INSERT INTO `auxiliar_periodo_fichas` (`id`, `nombre`, `plantilla`, `tipo_id`, `periodo_id`, `descripcion`, `promedio`, `orden`, `created_at`, `updated_at`, `deleted_at`) VALUES (11, 'FICHA DE EVALUACION ANEXO 13', NULL, 2, 1, 'FICHA DE EVALUACION ANEXO 13', NULL, 1, '2024-06-22 21:04:20', '2024-06-22 21:04:20', NULL);


CREATE TABLE `auxiliar_periodo_ficha_especialidades` (
	`periodo_ficha_id` INT(11) UNSIGNED NULL DEFAULT '0',
	`especialidad_id` INT(11) UNSIGNED NULL DEFAULT '0',
	`created_at` DATETIME NULL DEFAULT current_timestamp(),
	`updated_at` DATETIME NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
	`deleted_at` DATETIME NULL DEFAULT NULL
);

INSERT INTO `auxiliar_periodo_ficha_especialidades` (`periodo_ficha_id`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (5, 1, '2024-01-24 16:31:26', '2024-01-24 16:31:26', NULL);
INSERT INTO `auxiliar_periodo_ficha_especialidades` (`periodo_ficha_id`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (5, 2, '2024-01-24 16:31:26', '2024-01-24 16:31:26', NULL);
INSERT INTO `auxiliar_periodo_ficha_especialidades` (`periodo_ficha_id`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (5, 3, '2024-01-24 16:31:26', '2024-01-24 16:31:26', NULL);
INSERT INTO `auxiliar_periodo_ficha_especialidades` (`periodo_ficha_id`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (5, 4, '2024-01-24 16:31:26', '2024-01-24 16:31:26', NULL);
INSERT INTO `auxiliar_periodo_ficha_especialidades` (`periodo_ficha_id`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (5, 5, '2024-01-24 16:31:26', '2024-01-24 16:31:26', NULL);
INSERT INTO `auxiliar_periodo_ficha_especialidades` (`periodo_ficha_id`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (5, 6, '2024-01-24 16:31:26', '2024-01-24 16:31:26', NULL);
INSERT INTO `auxiliar_periodo_ficha_especialidades` (`periodo_ficha_id`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (5, 7, '2024-01-24 16:31:26', '2024-01-24 16:31:26', NULL);
INSERT INTO `auxiliar_periodo_ficha_especialidades` (`periodo_ficha_id`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (5, 8, '2024-01-24 16:31:26', '2024-01-24 16:31:26', NULL);
INSERT INTO `auxiliar_periodo_ficha_especialidades` (`periodo_ficha_id`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (5, 9, '2024-01-24 16:31:26', '2024-01-24 16:31:26', NULL);
INSERT INTO `auxiliar_periodo_ficha_especialidades` (`periodo_ficha_id`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (5, 10, '2024-01-24 16:31:26', '2024-01-24 16:31:26', NULL);
INSERT INTO `auxiliar_periodo_ficha_especialidades` (`periodo_ficha_id`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (5, 11, '2024-01-24 16:31:26', '2024-01-24 16:31:26', NULL);
INSERT INTO `auxiliar_periodo_ficha_especialidades` (`periodo_ficha_id`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (5, 12, '2024-01-24 16:31:26', '2024-01-24 16:31:26', NULL);
INSERT INTO `auxiliar_periodo_ficha_especialidades` (`periodo_ficha_id`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (5, 13, '2024-01-24 16:31:26', '2024-01-24 16:31:26', NULL);
INSERT INTO `auxiliar_periodo_ficha_especialidades` (`periodo_ficha_id`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (5, 14, '2024-01-24 16:31:26', '2024-01-24 16:31:26', NULL);
INSERT INTO `auxiliar_periodo_ficha_especialidades` (`periodo_ficha_id`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (5, 15, '2024-01-24 16:31:26', '2024-01-24 16:31:26', NULL);
INSERT INTO `auxiliar_periodo_ficha_especialidades` (`periodo_ficha_id`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (6, 1, '2024-01-24 16:31:26', '2024-01-24 16:31:26', NULL);
INSERT INTO `auxiliar_periodo_ficha_especialidades` (`periodo_ficha_id`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (6, 2, '2024-01-24 16:31:26', '2024-01-24 16:31:26', NULL);
INSERT INTO `auxiliar_periodo_ficha_especialidades` (`periodo_ficha_id`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (6, 3, '2024-01-24 16:31:26', '2024-01-24 16:31:26', NULL);
INSERT INTO `auxiliar_periodo_ficha_especialidades` (`periodo_ficha_id`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (6, 4, '2024-01-24 16:31:26', '2024-01-24 16:31:26', NULL);
INSERT INTO `auxiliar_periodo_ficha_especialidades` (`periodo_ficha_id`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (6, 5, '2024-01-24 16:31:26', '2024-01-24 16:31:26', NULL);
INSERT INTO `auxiliar_periodo_ficha_especialidades` (`periodo_ficha_id`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (6, 6, '2024-01-24 16:31:26', '2024-01-24 16:31:26', NULL);
INSERT INTO `auxiliar_periodo_ficha_especialidades` (`periodo_ficha_id`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (6, 7, '2024-01-24 16:31:26', '2024-01-24 16:31:26', NULL);
INSERT INTO `auxiliar_periodo_ficha_especialidades` (`periodo_ficha_id`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (6, 8, '2024-01-24 16:31:26', '2024-01-24 16:31:26', NULL);
INSERT INTO `auxiliar_periodo_ficha_especialidades` (`periodo_ficha_id`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (6, 9, '2024-01-24 16:31:26', '2024-01-24 16:31:26', NULL);
INSERT INTO `auxiliar_periodo_ficha_especialidades` (`periodo_ficha_id`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (6, 10, '2024-01-24 16:31:26', '2024-01-24 16:31:26', NULL);
INSERT INTO `auxiliar_periodo_ficha_especialidades` (`periodo_ficha_id`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (6, 11, '2024-01-24 16:31:26', '2024-01-24 16:31:26', NULL);
INSERT INTO `auxiliar_periodo_ficha_especialidades` (`periodo_ficha_id`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (6, 12, '2024-01-24 16:31:26', '2024-01-24 16:31:26', NULL);
INSERT INTO `auxiliar_periodo_ficha_especialidades` (`periodo_ficha_id`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (6, 13, '2024-01-24 16:31:26', '2024-01-24 16:31:26', NULL);
INSERT INTO `auxiliar_periodo_ficha_especialidades` (`periodo_ficha_id`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (6, 14, '2024-01-24 16:31:26', '2024-01-24 16:31:26', NULL);
INSERT INTO `auxiliar_periodo_ficha_especialidades` (`periodo_ficha_id`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (6, 15, '2024-01-24 16:31:26', '2024-01-24 16:31:26', NULL);
INSERT INTO `auxiliar_periodo_ficha_especialidades` (`periodo_ficha_id`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (3, 1, '2024-02-01 13:10:34', '2024-02-01 13:10:34', NULL);
INSERT INTO `auxiliar_periodo_ficha_especialidades` (`periodo_ficha_id`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (3, 2, '2024-02-01 13:10:34', '2024-02-01 13:10:34', NULL);
INSERT INTO `auxiliar_periodo_ficha_especialidades` (`periodo_ficha_id`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (3, 3, '2024-02-01 13:10:34', '2024-02-01 13:10:34', NULL);
INSERT INTO `auxiliar_periodo_ficha_especialidades` (`periodo_ficha_id`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (3, 4, '2024-02-01 13:10:34', '2024-02-01 13:10:34', NULL);
INSERT INTO `auxiliar_periodo_ficha_especialidades` (`periodo_ficha_id`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (3, 5, '2024-02-01 13:10:34', '2024-02-01 13:10:34', NULL);
INSERT INTO `auxiliar_periodo_ficha_especialidades` (`periodo_ficha_id`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (3, 6, '2024-02-01 13:10:34', '2024-02-01 13:10:34', NULL);
INSERT INTO `auxiliar_periodo_ficha_especialidades` (`periodo_ficha_id`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (3, 7, '2024-02-01 13:10:34', '2024-02-01 13:10:34', NULL);
INSERT INTO `auxiliar_periodo_ficha_especialidades` (`periodo_ficha_id`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (3, 8, '2024-02-01 13:10:34', '2024-02-01 13:10:34', NULL);
INSERT INTO `auxiliar_periodo_ficha_especialidades` (`periodo_ficha_id`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (3, 9, '2024-02-01 13:10:34', '2024-02-01 13:10:34', NULL);
INSERT INTO `auxiliar_periodo_ficha_especialidades` (`periodo_ficha_id`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (3, 10, '2024-02-01 13:10:34', '2024-02-01 13:10:34', NULL);
INSERT INTO `auxiliar_periodo_ficha_especialidades` (`periodo_ficha_id`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (3, 11, '2024-02-01 13:10:34', '2024-02-01 13:10:34', NULL);
INSERT INTO `auxiliar_periodo_ficha_especialidades` (`periodo_ficha_id`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (3, 12, '2024-02-01 13:10:34', '2024-02-01 13:10:34', NULL);
INSERT INTO `auxiliar_periodo_ficha_especialidades` (`periodo_ficha_id`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (3, 13, '2024-02-01 13:10:34', '2024-02-01 13:10:34', NULL);
INSERT INTO `auxiliar_periodo_ficha_especialidades` (`periodo_ficha_id`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (3, 14, '2024-02-01 13:10:34', '2024-02-01 13:10:34', NULL);
INSERT INTO `auxiliar_periodo_ficha_especialidades` (`periodo_ficha_id`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (3, 25, '2024-02-01 13:10:34', '2024-02-01 13:10:34', NULL);
INSERT INTO `auxiliar_periodo_ficha_especialidades` (`periodo_ficha_id`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (3, 15, '2024-02-01 13:10:34', '2024-02-01 13:10:34', NULL);
INSERT INTO `auxiliar_periodo_ficha_especialidades` (`periodo_ficha_id`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (3, 16, '2024-02-01 13:10:34', '2024-02-01 13:10:34', NULL);
INSERT INTO `auxiliar_periodo_ficha_especialidades` (`periodo_ficha_id`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (3, 17, '2024-02-01 13:10:34', '2024-02-01 13:10:34', NULL);
INSERT INTO `auxiliar_periodo_ficha_especialidades` (`periodo_ficha_id`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (3, 18, '2024-02-01 13:10:34', '2024-02-01 13:10:34', NULL);
INSERT INTO `auxiliar_periodo_ficha_especialidades` (`periodo_ficha_id`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (3, 19, '2024-02-01 13:10:34', '2024-02-01 13:10:34', NULL);
INSERT INTO `auxiliar_periodo_ficha_especialidades` (`periodo_ficha_id`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (3, 20, '2024-02-01 13:10:34', '2024-02-01 13:10:34', NULL);
INSERT INTO `auxiliar_periodo_ficha_especialidades` (`periodo_ficha_id`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (3, 21, '2024-02-01 13:10:34', '2024-02-01 13:10:34', NULL);
INSERT INTO `auxiliar_periodo_ficha_especialidades` (`periodo_ficha_id`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (3, 22, '2024-02-01 13:10:34', '2024-02-01 13:10:34', NULL);
INSERT INTO `auxiliar_periodo_ficha_especialidades` (`periodo_ficha_id`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (3, 23, '2024-02-01 13:10:34', '2024-02-01 13:10:34', NULL);
INSERT INTO `auxiliar_periodo_ficha_especialidades` (`periodo_ficha_id`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (3, 26, '2024-02-01 13:10:34', '2024-02-01 13:10:34', NULL);
INSERT INTO `auxiliar_periodo_ficha_especialidades` (`periodo_ficha_id`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (3, 24, '2024-02-01 13:10:34', '2024-02-01 13:10:34', NULL);
INSERT INTO `auxiliar_periodo_ficha_especialidades` (`periodo_ficha_id`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (4, 1, '2024-02-22 14:33:15', '2024-02-22 14:33:15', NULL);
INSERT INTO `auxiliar_periodo_ficha_especialidades` (`periodo_ficha_id`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (4, 2, '2024-02-22 14:33:15', '2024-02-22 14:33:15', NULL);
INSERT INTO `auxiliar_periodo_ficha_especialidades` (`periodo_ficha_id`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (4, 3, '2024-02-22 14:33:15', '2024-02-22 14:33:15', NULL);
INSERT INTO `auxiliar_periodo_ficha_especialidades` (`periodo_ficha_id`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (4, 4, '2024-02-22 14:33:15', '2024-02-22 14:33:15', NULL);
INSERT INTO `auxiliar_periodo_ficha_especialidades` (`periodo_ficha_id`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (4, 5, '2024-02-22 14:33:15', '2024-02-22 14:33:15', NULL);
INSERT INTO `auxiliar_periodo_ficha_especialidades` (`periodo_ficha_id`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (4, 6, '2024-02-22 14:33:15', '2024-02-22 14:33:15', NULL);
INSERT INTO `auxiliar_periodo_ficha_especialidades` (`periodo_ficha_id`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (4, 7, '2024-02-22 14:33:15', '2024-02-22 14:33:15', NULL);
INSERT INTO `auxiliar_periodo_ficha_especialidades` (`periodo_ficha_id`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (4, 8, '2024-02-22 14:33:15', '2024-02-22 14:33:15', NULL);
INSERT INTO `auxiliar_periodo_ficha_especialidades` (`periodo_ficha_id`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (4, 9, '2024-02-22 14:33:15', '2024-02-22 14:33:15', NULL);
INSERT INTO `auxiliar_periodo_ficha_especialidades` (`periodo_ficha_id`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (4, 10, '2024-02-22 14:33:15', '2024-02-22 14:33:15', NULL);
INSERT INTO `auxiliar_periodo_ficha_especialidades` (`periodo_ficha_id`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (4, 11, '2024-02-22 14:33:15', '2024-02-22 14:33:15', NULL);
INSERT INTO `auxiliar_periodo_ficha_especialidades` (`periodo_ficha_id`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (4, 12, '2024-02-22 14:33:15', '2024-02-22 14:33:15', NULL);
INSERT INTO `auxiliar_periodo_ficha_especialidades` (`periodo_ficha_id`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (4, 13, '2024-02-22 14:33:15', '2024-02-22 14:33:15', NULL);
INSERT INTO `auxiliar_periodo_ficha_especialidades` (`periodo_ficha_id`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (4, 14, '2024-02-22 14:33:15', '2024-02-22 14:33:15', NULL);
INSERT INTO `auxiliar_periodo_ficha_especialidades` (`periodo_ficha_id`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (4, 25, '2024-02-22 14:33:15', '2024-02-22 14:33:15', NULL);
INSERT INTO `auxiliar_periodo_ficha_especialidades` (`periodo_ficha_id`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (4, 15, '2024-02-22 14:33:15', '2024-02-22 14:33:15', NULL);
INSERT INTO `auxiliar_periodo_ficha_especialidades` (`periodo_ficha_id`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (4, 16, '2024-02-22 14:33:15', '2024-02-22 14:33:15', NULL);
INSERT INTO `auxiliar_periodo_ficha_especialidades` (`periodo_ficha_id`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (4, 17, '2024-02-22 14:33:15', '2024-02-22 14:33:15', NULL);
INSERT INTO `auxiliar_periodo_ficha_especialidades` (`periodo_ficha_id`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (4, 18, '2024-02-22 14:33:15', '2024-02-22 14:33:15', NULL);
INSERT INTO `auxiliar_periodo_ficha_especialidades` (`periodo_ficha_id`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (4, 19, '2024-02-22 14:33:15', '2024-02-22 14:33:15', NULL);
INSERT INTO `auxiliar_periodo_ficha_especialidades` (`periodo_ficha_id`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (4, 20, '2024-02-22 14:33:15', '2024-02-22 14:33:15', NULL);
INSERT INTO `auxiliar_periodo_ficha_especialidades` (`periodo_ficha_id`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (4, 21, '2024-02-22 14:33:15', '2024-02-22 14:33:15', NULL);
INSERT INTO `auxiliar_periodo_ficha_especialidades` (`periodo_ficha_id`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (4, 22, '2024-02-22 14:33:15', '2024-02-22 14:33:15', NULL);
INSERT INTO `auxiliar_periodo_ficha_especialidades` (`periodo_ficha_id`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (4, 23, '2024-02-22 14:33:15', '2024-02-22 14:33:15', NULL);
INSERT INTO `auxiliar_periodo_ficha_especialidades` (`periodo_ficha_id`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (4, 26, '2024-02-22 14:33:15', '2024-02-22 14:33:15', NULL);
INSERT INTO `auxiliar_periodo_ficha_especialidades` (`periodo_ficha_id`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (4, 24, '2024-02-22 14:33:15', '2024-02-22 14:33:15', NULL);
INSERT INTO `auxiliar_periodo_ficha_especialidades` (`periodo_ficha_id`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (9, 39, '2024-03-12 17:20:02', '2024-03-12 17:20:02', NULL);
INSERT INTO `auxiliar_periodo_ficha_especialidades` (`periodo_ficha_id`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (9, 40, '2024-03-12 17:20:02', '2024-03-12 17:20:02', NULL);
INSERT INTO `auxiliar_periodo_ficha_especialidades` (`periodo_ficha_id`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (9, 41, '2024-03-12 17:20:02', '2024-03-12 17:20:02', NULL);
INSERT INTO `auxiliar_periodo_ficha_especialidades` (`periodo_ficha_id`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (9, 42, '2024-03-12 17:20:02', '2024-03-12 17:20:02', NULL);
INSERT INTO `auxiliar_periodo_ficha_especialidades` (`periodo_ficha_id`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (9, 43, '2024-03-12 17:20:02', '2024-03-12 17:20:02', NULL);
INSERT INTO `auxiliar_periodo_ficha_especialidades` (`periodo_ficha_id`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (9, 44, '2024-03-12 17:20:02', '2024-03-12 17:20:02', NULL);
INSERT INTO `auxiliar_periodo_ficha_especialidades` (`periodo_ficha_id`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (9, 45, '2024-03-12 17:20:02', '2024-03-12 17:20:02', NULL);
INSERT INTO `auxiliar_periodo_ficha_especialidades` (`periodo_ficha_id`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (9, 46, '2024-03-12 17:20:02', '2024-03-12 17:20:02', NULL);
INSERT INTO `auxiliar_periodo_ficha_especialidades` (`periodo_ficha_id`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (9, 47, '2024-03-12 17:20:02', '2024-03-12 17:20:02', NULL);
INSERT INTO `auxiliar_periodo_ficha_especialidades` (`periodo_ficha_id`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (9, 48, '2024-03-12 17:20:02', '2024-03-12 17:20:02', NULL);
INSERT INTO `auxiliar_periodo_ficha_especialidades` (`periodo_ficha_id`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (9, 56, '2024-03-12 17:20:02', '2024-03-12 17:20:02', NULL);
INSERT INTO `auxiliar_periodo_ficha_especialidades` (`periodo_ficha_id`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (7, 1, '2024-03-18 21:32:06', '2024-03-18 21:32:06', NULL);
INSERT INTO `auxiliar_periodo_ficha_especialidades` (`periodo_ficha_id`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (7, 2, '2024-03-18 21:32:06', '2024-03-18 21:32:06', NULL);
INSERT INTO `auxiliar_periodo_ficha_especialidades` (`periodo_ficha_id`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (7, 3, '2024-03-18 21:32:06', '2024-03-18 21:32:06', NULL);
INSERT INTO `auxiliar_periodo_ficha_especialidades` (`periodo_ficha_id`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (7, 4, '2024-03-18 21:32:06', '2024-03-18 21:32:06', NULL);
INSERT INTO `auxiliar_periodo_ficha_especialidades` (`periodo_ficha_id`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (7, 5, '2024-03-18 21:32:06', '2024-03-18 21:32:06', NULL);
INSERT INTO `auxiliar_periodo_ficha_especialidades` (`periodo_ficha_id`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (7, 6, '2024-03-18 21:32:06', '2024-03-18 21:32:06', NULL);
INSERT INTO `auxiliar_periodo_ficha_especialidades` (`periodo_ficha_id`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (7, 7, '2024-03-18 21:32:06', '2024-03-18 21:32:06', NULL);
INSERT INTO `auxiliar_periodo_ficha_especialidades` (`periodo_ficha_id`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (7, 8, '2024-03-18 21:32:06', '2024-03-18 21:32:06', NULL);
INSERT INTO `auxiliar_periodo_ficha_especialidades` (`periodo_ficha_id`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (7, 9, '2024-03-18 21:32:06', '2024-03-18 21:32:06', NULL);
INSERT INTO `auxiliar_periodo_ficha_especialidades` (`periodo_ficha_id`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (7, 10, '2024-03-18 21:32:06', '2024-03-18 21:32:06', NULL);
INSERT INTO `auxiliar_periodo_ficha_especialidades` (`periodo_ficha_id`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (7, 11, '2024-03-18 21:32:06', '2024-03-18 21:32:06', NULL);
INSERT INTO `auxiliar_periodo_ficha_especialidades` (`periodo_ficha_id`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (7, 12, '2024-03-18 21:32:06', '2024-03-18 21:32:06', NULL);
INSERT INTO `auxiliar_periodo_ficha_especialidades` (`periodo_ficha_id`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (7, 13, '2024-03-18 21:32:06', '2024-03-18 21:32:06', NULL);
INSERT INTO `auxiliar_periodo_ficha_especialidades` (`periodo_ficha_id`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (7, 14, '2024-03-18 21:32:06', '2024-03-18 21:32:06', NULL);
INSERT INTO `auxiliar_periodo_ficha_especialidades` (`periodo_ficha_id`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (7, 25, '2024-03-18 21:32:06', '2024-03-18 21:32:06', NULL);
INSERT INTO `auxiliar_periodo_ficha_especialidades` (`periodo_ficha_id`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (7, 27, '2024-03-18 21:32:06', '2024-03-18 21:32:06', NULL);
INSERT INTO `auxiliar_periodo_ficha_especialidades` (`periodo_ficha_id`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (7, 28, '2024-03-18 21:32:06', '2024-03-18 21:32:06', NULL);
INSERT INTO `auxiliar_periodo_ficha_especialidades` (`periodo_ficha_id`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (7, 29, '2024-03-18 21:32:06', '2024-03-18 21:32:06', NULL);
INSERT INTO `auxiliar_periodo_ficha_especialidades` (`periodo_ficha_id`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (7, 30, '2024-03-18 21:32:06', '2024-03-18 21:32:06', NULL);
INSERT INTO `auxiliar_periodo_ficha_especialidades` (`periodo_ficha_id`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (7, 31, '2024-03-18 21:32:06', '2024-03-18 21:32:06', NULL);
INSERT INTO `auxiliar_periodo_ficha_especialidades` (`periodo_ficha_id`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (7, 32, '2024-03-18 21:32:06', '2024-03-18 21:32:06', NULL);
INSERT INTO `auxiliar_periodo_ficha_especialidades` (`periodo_ficha_id`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (7, 33, '2024-03-18 21:32:06', '2024-03-18 21:32:06', NULL);
INSERT INTO `auxiliar_periodo_ficha_especialidades` (`periodo_ficha_id`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (7, 34, '2024-03-18 21:32:06', '2024-03-18 21:32:06', NULL);
INSERT INTO `auxiliar_periodo_ficha_especialidades` (`periodo_ficha_id`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (7, 35, '2024-03-18 21:32:06', '2024-03-18 21:32:06', NULL);
INSERT INTO `auxiliar_periodo_ficha_especialidades` (`periodo_ficha_id`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (7, 36, '2024-03-18 21:32:06', '2024-03-18 21:32:06', NULL);
INSERT INTO `auxiliar_periodo_ficha_especialidades` (`periodo_ficha_id`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (7, 37, '2024-03-18 21:32:06', '2024-03-18 21:32:06', NULL);
INSERT INTO `auxiliar_periodo_ficha_especialidades` (`periodo_ficha_id`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (7, 38, '2024-03-18 21:32:06', '2024-03-18 21:32:06', NULL);
INSERT INTO `auxiliar_periodo_ficha_especialidades` (`periodo_ficha_id`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (7, 49, '2024-03-18 21:32:06', '2024-03-18 21:32:06', NULL);
INSERT INTO `auxiliar_periodo_ficha_especialidades` (`periodo_ficha_id`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (7, 54, '2024-03-18 21:32:06', '2024-03-18 21:32:06', NULL);
INSERT INTO `auxiliar_periodo_ficha_especialidades` (`periodo_ficha_id`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (7, 58, '2024-03-18 21:32:06', '2024-03-18 21:32:06', NULL);
INSERT INTO `auxiliar_periodo_ficha_especialidades` (`periodo_ficha_id`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (7, 15, '2024-03-18 21:32:06', '2024-03-18 21:32:06', NULL);
INSERT INTO `auxiliar_periodo_ficha_especialidades` (`periodo_ficha_id`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (7, 16, '2024-03-18 21:32:06', '2024-03-18 21:32:06', NULL);
INSERT INTO `auxiliar_periodo_ficha_especialidades` (`periodo_ficha_id`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (7, 17, '2024-03-18 21:32:06', '2024-03-18 21:32:06', NULL);
INSERT INTO `auxiliar_periodo_ficha_especialidades` (`periodo_ficha_id`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (7, 18, '2024-03-18 21:32:06', '2024-03-18 21:32:06', NULL);
INSERT INTO `auxiliar_periodo_ficha_especialidades` (`periodo_ficha_id`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (7, 19, '2024-03-18 21:32:06', '2024-03-18 21:32:06', NULL);
INSERT INTO `auxiliar_periodo_ficha_especialidades` (`periodo_ficha_id`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (7, 20, '2024-03-18 21:32:06', '2024-03-18 21:32:06', NULL);
INSERT INTO `auxiliar_periodo_ficha_especialidades` (`periodo_ficha_id`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (7, 21, '2024-03-18 21:32:06', '2024-03-18 21:32:06', NULL);
INSERT INTO `auxiliar_periodo_ficha_especialidades` (`periodo_ficha_id`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (7, 22, '2024-03-18 21:32:06', '2024-03-18 21:32:06', NULL);
INSERT INTO `auxiliar_periodo_ficha_especialidades` (`periodo_ficha_id`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (7, 23, '2024-03-18 21:32:06', '2024-03-18 21:32:06', NULL);
INSERT INTO `auxiliar_periodo_ficha_especialidades` (`periodo_ficha_id`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (7, 26, '2024-03-18 21:32:06', '2024-03-18 21:32:06', NULL);
INSERT INTO `auxiliar_periodo_ficha_especialidades` (`periodo_ficha_id`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (7, 50, '2024-03-18 21:32:06', '2024-03-18 21:32:06', NULL);
INSERT INTO `auxiliar_periodo_ficha_especialidades` (`periodo_ficha_id`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (7, 51, '2024-03-18 21:32:06', '2024-03-18 21:32:06', NULL);
INSERT INTO `auxiliar_periodo_ficha_especialidades` (`periodo_ficha_id`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (7, 52, '2024-03-18 21:32:06', '2024-03-18 21:32:06', NULL);
INSERT INTO `auxiliar_periodo_ficha_especialidades` (`periodo_ficha_id`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (7, 53, '2024-03-18 21:32:06', '2024-03-18 21:32:06', NULL);
INSERT INTO `auxiliar_periodo_ficha_especialidades` (`periodo_ficha_id`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (7, 55, '2024-03-18 21:32:06', '2024-03-18 21:32:06', NULL);
INSERT INTO `auxiliar_periodo_ficha_especialidades` (`periodo_ficha_id`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (7, 24, '2024-03-18 21:32:06', '2024-03-18 21:32:06', NULL);
INSERT INTO `auxiliar_periodo_ficha_especialidades` (`periodo_ficha_id`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (7, 39, '2024-03-18 21:32:06', '2024-03-18 21:32:06', NULL);
INSERT INTO `auxiliar_periodo_ficha_especialidades` (`periodo_ficha_id`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (7, 40, '2024-03-18 21:32:06', '2024-03-18 21:32:06', NULL);
INSERT INTO `auxiliar_periodo_ficha_especialidades` (`periodo_ficha_id`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (7, 41, '2024-03-18 21:32:06', '2024-03-18 21:32:06', NULL);
INSERT INTO `auxiliar_periodo_ficha_especialidades` (`periodo_ficha_id`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (7, 42, '2024-03-18 21:32:06', '2024-03-18 21:32:06', NULL);
INSERT INTO `auxiliar_periodo_ficha_especialidades` (`periodo_ficha_id`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (7, 43, '2024-03-18 21:32:06', '2024-03-18 21:32:06', NULL);
INSERT INTO `auxiliar_periodo_ficha_especialidades` (`periodo_ficha_id`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (7, 44, '2024-03-18 21:32:06', '2024-03-18 21:32:06', NULL);
INSERT INTO `auxiliar_periodo_ficha_especialidades` (`periodo_ficha_id`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (7, 45, '2024-03-18 21:32:06', '2024-03-18 21:32:06', NULL);
INSERT INTO `auxiliar_periodo_ficha_especialidades` (`periodo_ficha_id`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (7, 46, '2024-03-18 21:32:06', '2024-03-18 21:32:06', NULL);
INSERT INTO `auxiliar_periodo_ficha_especialidades` (`periodo_ficha_id`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (7, 47, '2024-03-18 21:32:06', '2024-03-18 21:32:06', NULL);
INSERT INTO `auxiliar_periodo_ficha_especialidades` (`periodo_ficha_id`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (7, 48, '2024-03-18 21:32:06', '2024-03-18 21:32:06', NULL);
INSERT INTO `auxiliar_periodo_ficha_especialidades` (`periodo_ficha_id`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (7, 56, '2024-03-18 21:32:06', '2024-03-18 21:32:06', NULL);
INSERT INTO `auxiliar_periodo_ficha_especialidades` (`periodo_ficha_id`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (7, 57, '2024-03-18 21:32:06', '2024-03-18 21:32:06', NULL);
INSERT INTO `auxiliar_periodo_ficha_especialidades` (`periodo_ficha_id`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (8, 1, '2024-03-18 21:32:13', '2024-03-18 21:32:13', NULL);
INSERT INTO `auxiliar_periodo_ficha_especialidades` (`periodo_ficha_id`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (8, 2, '2024-03-18 21:32:13', '2024-03-18 21:32:13', NULL);
INSERT INTO `auxiliar_periodo_ficha_especialidades` (`periodo_ficha_id`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (8, 3, '2024-03-18 21:32:13', '2024-03-18 21:32:13', NULL);
INSERT INTO `auxiliar_periodo_ficha_especialidades` (`periodo_ficha_id`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (8, 4, '2024-03-18 21:32:13', '2024-03-18 21:32:13', NULL);
INSERT INTO `auxiliar_periodo_ficha_especialidades` (`periodo_ficha_id`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (8, 5, '2024-03-18 21:32:13', '2024-03-18 21:32:13', NULL);
INSERT INTO `auxiliar_periodo_ficha_especialidades` (`periodo_ficha_id`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (8, 6, '2024-03-18 21:32:13', '2024-03-18 21:32:13', NULL);
INSERT INTO `auxiliar_periodo_ficha_especialidades` (`periodo_ficha_id`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (8, 7, '2024-03-18 21:32:13', '2024-03-18 21:32:13', NULL);
INSERT INTO `auxiliar_periodo_ficha_especialidades` (`periodo_ficha_id`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (8, 8, '2024-03-18 21:32:13', '2024-03-18 21:32:13', NULL);
INSERT INTO `auxiliar_periodo_ficha_especialidades` (`periodo_ficha_id`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (8, 9, '2024-03-18 21:32:13', '2024-03-18 21:32:13', NULL);
INSERT INTO `auxiliar_periodo_ficha_especialidades` (`periodo_ficha_id`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (8, 10, '2024-03-18 21:32:13', '2024-03-18 21:32:13', NULL);
INSERT INTO `auxiliar_periodo_ficha_especialidades` (`periodo_ficha_id`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (8, 11, '2024-03-18 21:32:13', '2024-03-18 21:32:13', NULL);
INSERT INTO `auxiliar_periodo_ficha_especialidades` (`periodo_ficha_id`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (8, 12, '2024-03-18 21:32:13', '2024-03-18 21:32:13', NULL);
INSERT INTO `auxiliar_periodo_ficha_especialidades` (`periodo_ficha_id`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (8, 13, '2024-03-18 21:32:13', '2024-03-18 21:32:13', NULL);
INSERT INTO `auxiliar_periodo_ficha_especialidades` (`periodo_ficha_id`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (8, 14, '2024-03-18 21:32:13', '2024-03-18 21:32:13', NULL);
INSERT INTO `auxiliar_periodo_ficha_especialidades` (`periodo_ficha_id`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (8, 25, '2024-03-18 21:32:13', '2024-03-18 21:32:13', NULL);
INSERT INTO `auxiliar_periodo_ficha_especialidades` (`periodo_ficha_id`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (8, 27, '2024-03-18 21:32:13', '2024-03-18 21:32:13', NULL);
INSERT INTO `auxiliar_periodo_ficha_especialidades` (`periodo_ficha_id`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (8, 28, '2024-03-18 21:32:13', '2024-03-18 21:32:13', NULL);
INSERT INTO `auxiliar_periodo_ficha_especialidades` (`periodo_ficha_id`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (8, 29, '2024-03-18 21:32:13', '2024-03-18 21:32:13', NULL);
INSERT INTO `auxiliar_periodo_ficha_especialidades` (`periodo_ficha_id`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (8, 30, '2024-03-18 21:32:13', '2024-03-18 21:32:13', NULL);
INSERT INTO `auxiliar_periodo_ficha_especialidades` (`periodo_ficha_id`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (8, 31, '2024-03-18 21:32:13', '2024-03-18 21:32:13', NULL);
INSERT INTO `auxiliar_periodo_ficha_especialidades` (`periodo_ficha_id`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (8, 32, '2024-03-18 21:32:13', '2024-03-18 21:32:13', NULL);
INSERT INTO `auxiliar_periodo_ficha_especialidades` (`periodo_ficha_id`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (8, 33, '2024-03-18 21:32:13', '2024-03-18 21:32:13', NULL);
INSERT INTO `auxiliar_periodo_ficha_especialidades` (`periodo_ficha_id`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (8, 34, '2024-03-18 21:32:13', '2024-03-18 21:32:13', NULL);
INSERT INTO `auxiliar_periodo_ficha_especialidades` (`periodo_ficha_id`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (8, 35, '2024-03-18 21:32:13', '2024-03-18 21:32:13', NULL);
INSERT INTO `auxiliar_periodo_ficha_especialidades` (`periodo_ficha_id`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (8, 36, '2024-03-18 21:32:13', '2024-03-18 21:32:13', NULL);
INSERT INTO `auxiliar_periodo_ficha_especialidades` (`periodo_ficha_id`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (8, 37, '2024-03-18 21:32:13', '2024-03-18 21:32:13', NULL);
INSERT INTO `auxiliar_periodo_ficha_especialidades` (`periodo_ficha_id`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (8, 38, '2024-03-18 21:32:13', '2024-03-18 21:32:13', NULL);
INSERT INTO `auxiliar_periodo_ficha_especialidades` (`periodo_ficha_id`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (8, 49, '2024-03-18 21:32:13', '2024-03-18 21:32:13', NULL);
INSERT INTO `auxiliar_periodo_ficha_especialidades` (`periodo_ficha_id`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (8, 54, '2024-03-18 21:32:13', '2024-03-18 21:32:13', NULL);
INSERT INTO `auxiliar_periodo_ficha_especialidades` (`periodo_ficha_id`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (8, 58, '2024-03-18 21:32:13', '2024-03-18 21:32:13', NULL);
INSERT INTO `auxiliar_periodo_ficha_especialidades` (`periodo_ficha_id`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (8, 15, '2024-03-18 21:32:13', '2024-03-18 21:32:13', NULL);
INSERT INTO `auxiliar_periodo_ficha_especialidades` (`periodo_ficha_id`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (8, 16, '2024-03-18 21:32:13', '2024-03-18 21:32:13', NULL);
INSERT INTO `auxiliar_periodo_ficha_especialidades` (`periodo_ficha_id`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (8, 17, '2024-03-18 21:32:13', '2024-03-18 21:32:13', NULL);
INSERT INTO `auxiliar_periodo_ficha_especialidades` (`periodo_ficha_id`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (8, 18, '2024-03-18 21:32:13', '2024-03-18 21:32:13', NULL);
INSERT INTO `auxiliar_periodo_ficha_especialidades` (`periodo_ficha_id`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (8, 19, '2024-03-18 21:32:13', '2024-03-18 21:32:13', NULL);
INSERT INTO `auxiliar_periodo_ficha_especialidades` (`periodo_ficha_id`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (8, 20, '2024-03-18 21:32:13', '2024-03-18 21:32:13', NULL);
INSERT INTO `auxiliar_periodo_ficha_especialidades` (`periodo_ficha_id`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (8, 21, '2024-03-18 21:32:13', '2024-03-18 21:32:13', NULL);
INSERT INTO `auxiliar_periodo_ficha_especialidades` (`periodo_ficha_id`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (8, 22, '2024-03-18 21:32:13', '2024-03-18 21:32:13', NULL);
INSERT INTO `auxiliar_periodo_ficha_especialidades` (`periodo_ficha_id`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (8, 23, '2024-03-18 21:32:13', '2024-03-18 21:32:13', NULL);
INSERT INTO `auxiliar_periodo_ficha_especialidades` (`periodo_ficha_id`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (8, 26, '2024-03-18 21:32:13', '2024-03-18 21:32:13', NULL);
INSERT INTO `auxiliar_periodo_ficha_especialidades` (`periodo_ficha_id`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (8, 50, '2024-03-18 21:32:13', '2024-03-18 21:32:13', NULL);
INSERT INTO `auxiliar_periodo_ficha_especialidades` (`periodo_ficha_id`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (8, 51, '2024-03-18 21:32:13', '2024-03-18 21:32:13', NULL);
INSERT INTO `auxiliar_periodo_ficha_especialidades` (`periodo_ficha_id`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (8, 52, '2024-03-18 21:32:13', '2024-03-18 21:32:13', NULL);
INSERT INTO `auxiliar_periodo_ficha_especialidades` (`periodo_ficha_id`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (8, 53, '2024-03-18 21:32:13', '2024-03-18 21:32:13', NULL);
INSERT INTO `auxiliar_periodo_ficha_especialidades` (`periodo_ficha_id`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (8, 55, '2024-03-18 21:32:13', '2024-03-18 21:32:13', NULL);
INSERT INTO `auxiliar_periodo_ficha_especialidades` (`periodo_ficha_id`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (8, 24, '2024-03-18 21:32:13', '2024-03-18 21:32:13', NULL);
INSERT INTO `auxiliar_periodo_ficha_especialidades` (`periodo_ficha_id`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (10, 57, '2024-06-22 18:12:46', '2024-06-22 18:12:46', NULL);
INSERT INTO `auxiliar_periodo_ficha_especialidades` (`periodo_ficha_id`, `especialidad_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (11, 57, '2024-06-22 21:04:20', '2024-06-22 21:04:20', NULL);

/****** 13-10-2024 ***********/

/** ACTUALIZACION DE MODULOS **/
INSERT INTO `modulos` VALUES ('22', 'DOCENTES', '', '.', '0', '2', '2024-10-13 20:34:39', '2024-10-13 20:34:39', '1', '1');
INSERT INTO `modulos` VALUES ('23', 'AUXILIARES', '', '.', '0', '3', '2024-10-13 20:34:39', '2024-10-13 20:34:39', '1', '1');

UPDATE `modulos` SET mdl_hijode = 22, mdl_orden = 2.1 WHERE mdl_id = 6;
UPDATE `modulos` SET mdl_hijode = 22, mdl_orden = 2.2  WHERE mdl_id = 11;
UPDATE `modulos` SET mdl_hijode = 22, mdl_orden = 2.3  WHERE mdl_id = 14;
UPDATE `modulos` SET mdl_hijode = 22, mdl_orden = 2.4  WHERE mdl_id = 18;

UPDATE `modulos` SET mdl_orden = 2.11  WHERE mdl_id = 7;
UPDATE `modulos` SET mdl_orden = 2.12  WHERE mdl_id = 8;
UPDATE `modulos` SET mdl_orden = 2.13  WHERE mdl_id = 9;
UPDATE `modulos` SET mdl_orden = 2.14  WHERE mdl_id = 10;
UPDATE `modulos` SET mdl_orden = 2.15  WHERE mdl_id = 17;
UPDATE `modulos` SET mdl_orden = 2.16  WHERE mdl_id = 21;

UPDATE `modulos` SET mdl_orden = 2.31  WHERE mdl_id = 15;
UPDATE `modulos` SET mdl_orden = 2.41  WHERE mdl_id = 19;

INSERT INTO `modulos` VALUES ('24', 'CONFIGURACIÓN', '', '.', '23', 3.1, '2024-10-13 20:34:39', '2024-10-13 20:34:39', '1', '1');
INSERT INTO `modulos` VALUES ('25', 'CONVOCATORIAS', '', '.', '23', 3.2, '2024-10-13 20:34:39', '2024-10-13 20:34:39', '1', '1');
INSERT INTO `modulos` VALUES ('26', 'EVALUACIÓN', '', '.', '23', 3.3, '2024-10-13 20:34:39', '2024-10-13 20:34:39', '1', '1');
INSERT INTO `modulos` VALUES ('27', 'ADJUDICACIÓN', '', '.', '23', 3.4, '2024-10-13 20:34:39', '2024-10-13 20:34:39', '1', '1');

INSERT INTO `modulos` VALUES ('28', 'PERIODOS', 'admin/auxiliares/periodos', '.', '24', 3.11, '2024-10-13 20:34:39', '2024-10-13 20:34:39', '1', '1');
INSERT INTO `modulos` VALUES ('29', 'PROCESOS', 'admin/auxiliares/procesos', '.', '24', 3.12, '2024-10-13 20:34:39', '2024-10-13 20:34:39', '1', '1');
INSERT INTO `modulos` VALUES ('30', 'GRUPO DE INSCRIPCIÓN', 'admin/auxiliares/grupoinscripcion', '.', '24', 3.13, '2024-10-13 20:34:39', '2024-10-13 20:34:39', '1', '1');
INSERT INTO `modulos` VALUES ('31', 'PLAZAS', 'admin/auxiliares/plazas', '.', '24', 3.14, '2024-10-13 20:34:39', '2024-10-13 20:34:39', '1', '1');
INSERT INTO `modulos` VALUES ('32', 'COLEGIOS', 'admin/auxiliares/colegios', '.', '24', 3.15, '2024-10-13 20:34:39', '2024-10-13 20:34:39', '1', '1');

INSERT INTO `modulos` VALUES ('33', 'REGISTRO CONVOCATORIAS', 'admin/auxiliares/convocatorias', '.', '25', 3.21, '2024-10-13 20:34:39', '2024-10-13 20:34:39', '1', '1');
INSERT INTO `modulos` VALUES ('34', 'EVALUACIÓN DE POSTULANTES', 'admin/auxiliares/evaluaciones', '.', '26', 3.31, '2024-10-13 20:34:39', '2024-10-13 20:34:39', '1', '1');
INSERT INTO `modulos` VALUES ('35', 'ADJUDICACIÓN', 'admin/auxiliares/adjudicaciones', '.', '27', 3.41, '2024-10-13 20:34:39', '2024-10-13 20:34:39', '1', '1');

/** ACTUALIZACION DE PERMISOS usuario_id 47649297 tipo_usuario 2**/
INSERT INTO `permisos` (`modulos_mdl_id`, `tipo_usuarios_tus_id`, `per_fechaRegistro`, `per_fechaModificacion`, `per_estado`, `per_flag`) VALUES (1, 2, '2024-10-13 20:08:57', '2024-10-13 20:08:57', 1, 1);
INSERT INTO `permisos` (`modulos_mdl_id`, `tipo_usuarios_tus_id`, `per_fechaRegistro`, `per_fechaModificacion`, `per_estado`, `per_flag`) VALUES (2, 2, '2024-10-13 20:08:57', '2024-10-13 20:08:57', 1, 1);
INSERT INTO `permisos` (`modulos_mdl_id`, `tipo_usuarios_tus_id`, `per_fechaRegistro`, `per_fechaModificacion`, `per_estado`, `per_flag`) VALUES (3, 2, '2024-10-13 20:08:57', '2024-10-13 20:08:57', 1, 1);
INSERT INTO `permisos` (`modulos_mdl_id`, `tipo_usuarios_tus_id`, `per_fechaRegistro`, `per_fechaModificacion`, `per_estado`, `per_flag`) VALUES (4, 2, '2024-10-13 20:08:57', '2024-10-13 20:08:57', 1, 1);
INSERT INTO `permisos` (`modulos_mdl_id`, `tipo_usuarios_tus_id`, `per_fechaRegistro`, `per_fechaModificacion`, `per_estado`, `per_flag`) VALUES (5, 2, '2024-10-13 20:08:57', '2024-10-13 20:08:57', 1, 1);

INSERT INTO `permisos` (`modulos_mdl_id`, `tipo_usuarios_tus_id`, `per_fechaRegistro`, `per_fechaModificacion`, `per_estado`, `per_flag`) VALUES (22, 2, '2024-10-13 20:08:57', '2024-10-13 20:08:57', 1, 1);
INSERT INTO `permisos` (`modulos_mdl_id`, `tipo_usuarios_tus_id`, `per_fechaRegistro`, `per_fechaModificacion`, `per_estado`, `per_flag`) VALUES (23, 2, '2024-10-13 20:08:57', '2024-10-13 20:08:57', 1, 1);
INSERT INTO `permisos` (`modulos_mdl_id`, `tipo_usuarios_tus_id`, `per_fechaRegistro`, `per_fechaModificacion`, `per_estado`, `per_flag`) VALUES (24, 2, '2024-10-13 20:08:57', '2024-10-13 20:08:57', 1, 1);
INSERT INTO `permisos` (`modulos_mdl_id`, `tipo_usuarios_tus_id`, `per_fechaRegistro`, `per_fechaModificacion`, `per_estado`, `per_flag`) VALUES (25, 2, '2024-10-13 20:08:57', '2024-10-13 20:08:57', 1, 1);
INSERT INTO `permisos` (`modulos_mdl_id`, `tipo_usuarios_tus_id`, `per_fechaRegistro`, `per_fechaModificacion`, `per_estado`, `per_flag`) VALUES (26, 2, '2024-10-13 20:08:57', '2024-10-13 20:08:57', 1, 1);
INSERT INTO `permisos` (`modulos_mdl_id`, `tipo_usuarios_tus_id`, `per_fechaRegistro`, `per_fechaModificacion`, `per_estado`, `per_flag`) VALUES (27, 2, '2024-10-13 20:08:57', '2024-10-13 20:08:57', 1, 1);
INSERT INTO `permisos` (`modulos_mdl_id`, `tipo_usuarios_tus_id`, `per_fechaRegistro`, `per_fechaModificacion`, `per_estado`, `per_flag`) VALUES (28, 2, '2024-10-13 20:08:57', '2024-10-13 20:08:57', 1, 1);
INSERT INTO `permisos` (`modulos_mdl_id`, `tipo_usuarios_tus_id`, `per_fechaRegistro`, `per_fechaModificacion`, `per_estado`, `per_flag`) VALUES (29, 2, '2024-10-13 20:08:57', '2024-10-13 20:08:57', 1, 1);
INSERT INTO `permisos` (`modulos_mdl_id`, `tipo_usuarios_tus_id`, `per_fechaRegistro`, `per_fechaModificacion`, `per_estado`, `per_flag`) VALUES (30, 2, '2024-10-13 20:08:57', '2024-10-13 20:08:57', 1, 1);
INSERT INTO `permisos` (`modulos_mdl_id`, `tipo_usuarios_tus_id`, `per_fechaRegistro`, `per_fechaModificacion`, `per_estado`, `per_flag`) VALUES (31, 2, '2024-10-13 20:08:57', '2024-10-13 20:08:57', 1, 1);
INSERT INTO `permisos` (`modulos_mdl_id`, `tipo_usuarios_tus_id`, `per_fechaRegistro`, `per_fechaModificacion`, `per_estado`, `per_flag`) VALUES (32, 2, '2024-10-13 20:08:57', '2024-10-13 20:08:57', 1, 1);
INSERT INTO `permisos` (`modulos_mdl_id`, `tipo_usuarios_tus_id`, `per_fechaRegistro`, `per_fechaModificacion`, `per_estado`, `per_flag`) VALUES (33, 2, '2024-10-13 20:08:57', '2024-10-13 20:08:57', 1, 1);
INSERT INTO `permisos` (`modulos_mdl_id`, `tipo_usuarios_tus_id`, `per_fechaRegistro`, `per_fechaModificacion`, `per_estado`, `per_flag`) VALUES (34, 2, '2024-10-13 20:08:57', '2024-10-13 20:08:57', 1, 1);
INSERT INTO `permisos` (`modulos_mdl_id`, `tipo_usuarios_tus_id`, `per_fechaRegistro`, `per_fechaModificacion`, `per_estado`, `per_flag`) VALUES (35, 2, '2024-10-13 20:08:57', '2024-10-13 20:08:57', 1, 1);


/**  PUN EN AUXILIARES 19-10-2024  ***/

CREATE TABLE `auxiliar_evaluacion_pun_exp` (
	`epe_id` INT(11) NOT NULL AUTO_INCREMENT,
	`epe_tipoevaluacion` INT(1) NULL DEFAULT NULL COMMENT '1: preliminar\n2: final',
	`epe_especialistaAsignado` VARCHAR(12) NULL DEFAULT NULL COLLATE 'utf8_general_ci',
	`epe_fechaAsignacion` DATETIME NULL DEFAULT NULL,
	`epe_fechaApertura` DATETIME NULL DEFAULT NULL COMMENT 'fecha de inicio de evaluacion',
	`epe_fechaCierre` DATETIME NULL DEFAULT NULL COMMENT 'fecha de cierre de evaluacion',
	`epe_fechaModificacion` DATETIME NULL DEFAULT NULL,
	`epe_estadoEvaluacion` INT(1) NULL DEFAULT NULL COMMENT '1: abierto\n0: cerrado',
	`epe_estado` INT(1) NULL DEFAULT NULL,
	`postulacion_id` INT(11) UNSIGNED NOT NULL DEFAULT '0',
	`convocatorias_con_id` INT(11) NULL DEFAULT '0',
	PRIMARY KEY (`epe_id`) USING BTREE,
	INDEX `idx_auxiliar_epe_especialistaAsignado` (`epe_especialistaAsignado`) USING BTREE
);

CREATE TABLE `auxiliar_cuadro_pun_exp` (
	`cpe_id` INT(11) NOT NULL AUTO_INCREMENT,
	`cpe_tipoCuadro` INT(1) NULL DEFAULT NULL COMMENT '1: PUN 2. EXPEDIENTE',
	`cpe_anio` VARCHAR(4) NULL DEFAULT NULL COLLATE 'utf8_general_ci',
	`cpe_documento` VARCHAR(15) NULL DEFAULT NULL COLLATE 'utf8_general_ci',
	`cpe_apaterno` VARCHAR(200) NULL DEFAULT NULL COLLATE 'utf8_general_ci',
	`cpe_amaterno` VARCHAR(200) NULL DEFAULT NULL COLLATE 'utf8_general_ci',
	`cpe_apellidos` VARCHAR(400) NULL DEFAULT NULL COLLATE 'utf8_general_ci',
	`cpe_nombres` VARCHAR(200) NULL DEFAULT NULL COLLATE 'utf8_general_ci',
	`cpe_s1` VARCHAR(15) NULL DEFAULT NULL COLLATE 'utf8_general_ci',
	`cpe_s2` VARCHAR(15) NULL DEFAULT NULL COLLATE 'utf8_general_ci',
	`cpe_s3` VARCHAR(15) NULL DEFAULT NULL COLLATE 'utf8_general_ci',
	`cpe_s4` VARCHAR(15) NULL DEFAULT NULL COLLATE 'utf8_general_ci',
	`cpe_s5` VARCHAR(15) NULL DEFAULT NULL COLLATE 'utf8_general_ci',
	`cpe_orden` INT(11) NULL DEFAULT NULL,
	`cpe_sepresento` INT(1) NULL DEFAULT NULL COMMENT '0: no se presento 1: se presento 2: solo registrado',
	`cpe_enviadoeval` INT(1) NULL DEFAULT NULL COMMENT '0: no enviado 1: enviado',
	`cpe_fechaCarga` DATETIME NULL DEFAULT NULL,
	`cpe_fechaModificacion` DATETIME NULL DEFAULT NULL,
	`cpe_estado` INT(1) NULL DEFAULT NULL,
	`grupo_inscripcion_gin_id` INT(11) NOT NULL,
	`afiliacion` VARCHAR(200) NULL DEFAULT NULL COLLATE 'utf8_general_ci',
	`cuss` VARCHAR(200) NULL DEFAULT NULL COLLATE 'utf8_general_ci',
	PRIMARY KEY (`cpe_id`) USING BTREE,
	INDEX `fk_auxiliar_cuadropun_grupo_inscripcion1_idx` (`grupo_inscripcion_gin_id`) USING BTREE,
	CONSTRAINT `fk_auxiliar_cuadropun_grupo_inscripcion10` FOREIGN KEY (`grupo_inscripcion_gin_id`) REFERENCES `grupo_inscripcion` (`gin_id`) ON UPDATE NO ACTION ON DELETE NO ACTION
);

CREATE TABLE `auxiliar_adjudicaciones` (
	`id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
	`postulacion_id` INT(11) UNSIGNED NOT NULL DEFAULT '0',
	`plaza_id` INT(11) UNSIGNED NOT NULL DEFAULT '0',
	`observacion` VARCHAR(255) NULL DEFAULT NULL COLLATE 'utf8_general_ci',
	`fecha_liberacion` DATETIME NULL DEFAULT NULL,
	`estado` INT(11) NULL DEFAULT '1',
	`fecha_inicio` DATE NULL DEFAULT NULL,
	`fecha_final` DATE NULL DEFAULT NULL,
	`fecha_registro` DATETIME NULL DEFAULT NULL,
	`created_at` DATETIME NULL DEFAULT current_timestamp(),
	`updated_at` DATETIME NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
	`deleted_at` DATETIME NULL DEFAULT NULL,
	PRIMARY KEY (`id`) USING BTREE
);

CREATE TABLE `auxiliar_adjudicaciones_usuario_firmas` (
	`id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
	`usuario_id` INT(11) UNSIGNED NULL DEFAULT '0',
	`parent_id` INT(11) UNSIGNED NULL DEFAULT '0',
	`created_at` DATETIME NULL DEFAULT current_timestamp(),
	`updated_at` DATETIME NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
	`deleted_at` DATETIME NULL DEFAULT NULL,
	PRIMARY KEY (`id`) USING BTREE
);

CREATE TABLE `auxiliar_adjudicacion_firmas` (
	`adjudicacion_id` INT(11) UNSIGNED NULL DEFAULT '0',
	`usuario_id` INT(11) UNSIGNED NULL DEFAULT '0',
	`created_at` DATETIME NULL DEFAULT current_timestamp(),
	`updated_at` DATETIME NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
	`deleted_at` DATETIME NULL DEFAULT NULL
);

CREATE TABLE `auxiliar_plazas` (
	`plz_id` BIGINT(20) NOT NULL AUTO_INCREMENT,
	`codigoPlaza` VARCHAR(40) NULL DEFAULT NULL COLLATE 'utf8_general_ci',
	`codigoModular` VARCHAR(8) NULL DEFAULT NULL COLLATE 'utf8_general_ci',
	`ie` VARCHAR(150) NULL DEFAULT NULL COLLATE 'utf8_general_ci',
	`mod_id` INT(11) NULL DEFAULT NULL,
	`especialidad` TEXT NULL DEFAULT NULL COLLATE 'utf8_general_ci',
	`cargo` VARCHAR(40) NULL DEFAULT NULL COLLATE 'utf8_general_ci',
	`caracteristica` VARCHAR(50) NULL DEFAULT NULL COLLATE 'utf8_general_ci',
	`tipo` VARCHAR(50) NULL DEFAULT NULL COLLATE 'utf8_general_ci',
	`jornada` TINYINT(3) NULL DEFAULT NULL,
	`tipo_vacante` VARCHAR(200) NULL DEFAULT NULL COLLATE 'utf8_general_ci',
	`motivo_vacante` VARCHAR(8000) NULL DEFAULT NULL COLLATE 'utf8_general_ci',
	`observacion` TEXT NULL DEFAULT NULL COLLATE 'utf8_general_ci',
	`fecha_reg` DATETIME NULL DEFAULT NULL,
	`tipo_id` INT(11) NULL DEFAULT NULL,
	`registrado_por` VARCHAR(20) NULL DEFAULT NULL COLLATE 'utf8_general_ci',
	`fecha` YEAR NULL DEFAULT NULL,
	`estado` TINYINT(1) NULL DEFAULT NULL,
	`modificado_por` VARCHAR(20) NULL DEFAULT NULL COLLATE 'utf8_general_ci',
	`fecha_mod` DATETIME NULL DEFAULT NULL,
	`fecha_publicacion` DATETIME NULL DEFAULT NULL,
	`tipo_proceso` INT(11) NULL DEFAULT '0',
	`tipo_convocatoria` INT(11) NULL DEFAULT '0',
	`periodo_id` INT(11) NULL DEFAULT '0',
	`nivel_id` INT(11) NULL DEFAULT '0',
	`colegio_id` INT(11) NULL DEFAULT '0',
	`codigo_plaza` VARCHAR(255) NULL DEFAULT NULL COLLATE 'utf8_general_ci',
	`deleted_at` DATETIME NULL DEFAULT NULL,
	`nivel` VARCHAR(255) NULL DEFAULT NULL COLLATE 'utf8_general_ci',
	`codigo_modular` VARCHAR(255) NULL DEFAULT NULL COLLATE 'utf8_general_ci',
	`especialidad_general` VARCHAR(255) NULL DEFAULT NULL COLLATE 'utf8_general_ci',
	`fecha_inicio` DATE NULL DEFAULT NULL,
	`fecha_fin` DATE NULL DEFAULT NULL,
	`plaza_nombrada` TINYINT(1) NULL DEFAULT NULL,
	PRIMARY KEY (`plz_id`) USING BTREE,
	INDEX `modalidades` (`mod_id`) USING BTREE,
	INDEX `tipo_convocatoria` (`tipo_id`) USING BTREE
);

/** AUXILIARES 26-10-2024  ***/

ALTER TABLE grupo_inscripcion ADD COLUMN gin_correlative INT(11) NULL DEFAULT '0';

/*
	admin/auxiliares/periodos
	admin/auxiliares/procesos
	admin/auxiliares/grupoinscripcion
	admin/auxiliares/plazas
	admin/auxiliares/colegios
	admin/auxiliares/convocatorias
	admin/auxiliares/evaluaciones
	admin/auxiliares/adjudicaciones
*/

/*** 03/11/2024 *****/
UPDATE grupo_inscripcion SET gin_correlative = gin_id WHERE procesos_pro_id = 1;
