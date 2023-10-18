CREATE TABLE `postulaciones` (
	`id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
	`nombre` VARCHAR(255) NULL DEFAULT NULL,
	`apellido_paterno` VARCHAR(255) NULL DEFAULT NULL,
	`apellido_materno` VARCHAR(255) NULL DEFAULT NULL,
	`numero_documento` VARCHAR(255) NULL DEFAULT NULL,
	`tipo_documento` INT(11) NULL DEFAULT NULL,
	`genero` VARCHAR(255) NULL DEFAULT NULL,
	`estado_civil` VARCHAR(255) NULL DEFAULT NULL,
	`nacionalidad` VARCHAR(255) NULL DEFAULT NULL,
	`fecha_nacimiento` DATE NULL DEFAULT NULL,
	`correo` VARCHAR(255) NULL DEFAULT NULL,
	`numero_celular` VARCHAR(255) NULL DEFAULT NULL,
	`numero_telefono` VARCHAR(255) NULL DEFAULT NULL,
	`via` VARCHAR(255) NULL DEFAULT NULL,
	`nombre_via` VARCHAR(255) NULL DEFAULT NULL,
	`zona` VARCHAR(255) NULL DEFAULT NULL,
	`direccion` VARCHAR(255) NULL DEFAULT NULL,
	`fecha_registro` DATETIME NULL DEFAULT NULL,
	`uid` VARCHAR(255) NULL DEFAULT NULL,
	`distrito_id` INT(11) NULL DEFAULT NULL,
	`especialidad_id` INT(11) UNSIGNED NOT NULL,
	`convocatoria_id` INT(11) UNSIGNED NOT NULL,
	`created_at` DATETIME NULL DEFAULT current_timestamp(),
	`updated_at` DATETIME NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
	`deleted_at` DATETIME NULL DEFAULT NULL,
	PRIMARY KEY (`id`) USING BTREE
);


CREATE TABLE `postulacion_especializaciones` (
	`id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
	`tipo_especializacion` VARCHAR(255) NULL DEFAULT NULL,
	`tema_especializacion` VARCHAR(255) NULL DEFAULT NULL,
	`nombre_entidad` VARCHAR(255) NULL DEFAULT NULL,
	`fecha_inicio` DATE NULL DEFAULT NULL,
	`fecha_termino` DATE NULL DEFAULT NULL,
	`numero_horas` INT(11) NULL DEFAULT '0',
	`postulacion_id` INT(11) UNSIGNED NOT NULL,
	`created_at` DATETIME NULL DEFAULT current_timestamp(),
	`updated_at` DATETIME NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
	`deleted_at` DATETIME NULL DEFAULT NULL,
	PRIMARY KEY (`id`) USING BTREE
);

CREATE TABLE `postulacion_formaciones_academicas` (
	`id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
	`nivel_educativo` VARCHAR(255) NULL DEFAULT NULL,
	`grado_academico` VARCHAR(255) NULL DEFAULT NULL,
	`universidad` VARCHAR(255) NULL DEFAULT NULL,
	`carrera_profesional` VARCHAR(255) NULL DEFAULT NULL,
	`registro_titulo`  VARCHAR(255) NULL DEFAULT NULL,
	`rd_titulo`  VARCHAR(255) NULL DEFAULT NULL,
	`obtencion_grado` VARCHAR(255) NULL DEFAULT NULL,
	`postulacion_id` INT(11) UNSIGNED NOT NULL,
	`created_at` DATETIME NULL DEFAULT current_timestamp(),
	`updated_at` DATETIME NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
	`deleted_at` DATETIME NULL DEFAULT NULL,
	PRIMARY KEY (`id`) USING BTREE
);

CREATE TABLE `postulacion_experiencias_laborales` (
	`id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
	`institucion_educativa` VARCHAR(255) NULL DEFAULT NULL,
	`sector` VARCHAR(255) NULL DEFAULT NULL,
	`puesto` VARCHAR(255) NULL DEFAULT NULL,
	`numero_rd` VARCHAR(255) NULL DEFAULT NULL,
	`numero_contrato`  VARCHAR(255) NULL DEFAULT NULL,
	`postulacion_id` INT(11) UNSIGNED NOT NULL,
	`created_at` DATETIME NULL DEFAULT current_timestamp(),
	`updated_at` DATETIME NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
	`deleted_at` DATETIME NULL DEFAULT NULL,
	PRIMARY KEY (`id`) USING BTREE
);


CREATE TABLE `postulacion_archivos` (
	`id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
	`nombre` VARCHAR(255) NULL DEFAULT NULL,
	`url` TEXT NULL DEFAULT NULL,
	`formato` VARCHAR(255) NULL DEFAULT NULL,
	`peso` INT(11) UNSIGNED DEFAULT '0',
	`tipo_id` INT(11) UNSIGNED DEFAULT '0',
	`postulacion_id` INT(11) UNSIGNED DEFAULT '0',
	`created_at` DATETIME NULL DEFAULT current_timestamp(),
	`updated_at` DATETIME NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
	`deleted_at` DATETIME NULL DEFAULT NULL,
	PRIMARY KEY (`id`) USING BTREE
);
