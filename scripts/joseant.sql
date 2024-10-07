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


INSERT INTO `modulos` (`mdl_id`, `mdl_nombre`, `mdl_ruta`, `mdl_icono`, `mdl_hijode`, `mdl_orden`, `mdl_fechaRegistro`, `mdl_fechaModificacion`, `mdl_estado`, `mdl_flag`) VALUES (22, 'AUXILIARES', '', '.', 0, 7, '2022-07-04 08:57:16', NULL, 1, 1);
INSERT INTO `modulos` (`mdl_id`, `mdl_nombre`, `mdl_ruta`, `mdl_icono`, `mdl_hijode`, `mdl_orden`, `mdl_fechaRegistro`, `mdl_fechaModificacion`, `mdl_estado`, `mdl_flag`) VALUES (23, 'PERIODOS', 'admin/auxiliares/periodos', '.', 22, 7.7, '2022-07-04 08:57:52', NULL, 1, 1);
INSERT INTO `modulos` (`mdl_id`, `mdl_nombre`, `mdl_ruta`, `mdl_icono`, `mdl_hijode`, `mdl_orden`, `mdl_fechaRegistro`, `mdl_fechaModificacion`, `mdl_estado`, `mdl_flag`) VALUES (24, 'PROCESOS', 'admin/auxiliares/procesos', '.', 22, 7.8, '2022-07-04 08:58:57', NULL, 1, 1);
INSERT INTO `modulos` (`mdl_id`, `mdl_nombre`, `mdl_ruta`, `mdl_icono`, `mdl_hijode`, `mdl_orden`, `mdl_fechaRegistro`, `mdl_fechaModificacion`, `mdl_estado`, `mdl_flag`) VALUES (25, 'GRUPO DE INSCRIPCIÓN', 'admin/auxiliares/grupoinscripcion', '.', 22, 7.9, '2022-07-14 15:00:04', '2022-07-18 17:23:08', 1, 1);


INSERT INTO `permisos` (`modulos_mdl_id`, `tipo_usuarios_tus_id`, `per_fechaRegistro`, `per_fechaModificacion`, `per_estado`, `per_flag`) VALUES (22, 2, '2022-07-04 08:57:16', '2022-07-04 08:59:12', 1, 1);
INSERT INTO `permisos` (`modulos_mdl_id`, `tipo_usuarios_tus_id`, `per_fechaRegistro`, `per_fechaModificacion`, `per_estado`, `per_flag`) VALUES (23, 2, '2022-07-04 08:57:16', '2022-07-04 08:59:12', 1, 1);
INSERT INTO `permisos` (`modulos_mdl_id`, `tipo_usuarios_tus_id`, `per_fechaRegistro`, `per_fechaModificacion`, `per_estado`, `per_flag`) VALUES (24, 2, '2022-07-04 08:57:16', '2022-07-04 08:59:12', 1, 1);
INSERT INTO `permisos` (`modulos_mdl_id`, `tipo_usuarios_tus_id`, `per_fechaRegistro`, `per_fechaModificacion`, `per_estado`, `per_flag`) VALUES (25, 2, '2022-07-04 08:57:16', '2022-07-04 08:59:12', 1, 1);


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
