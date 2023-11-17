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


/****************************** 29-10-23  ******************************/
ALTER TABLE postulaciones ADD COLUMN `inscripcion_id` INT(11) UNSIGNED NOT NULL DEFAULT '0' AFTER `convocatoria_id`;
ALTER TABLE postulaciones DROP COLUMN especialidad_id;


/****************************** 31-10-23  ******************************/
CREATE TABLE `periodo_fichas` (
	`id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
	`nombre` VARCHAR(255) NULL DEFAULT NULL,
	`plantilla` TEXT NULL DEFAULT NULL,
	`tipo_id` INT(11) UNSIGNED DEFAULT '0',
	`periodo_id` INT(11) UNSIGNED DEFAULT '0',
	`created_at` DATETIME NULL DEFAULT current_timestamp(),
	`updated_at` DATETIME NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
	`deleted_at` DATETIME NULL DEFAULT NULL,
	PRIMARY KEY (`id`) USING BTREE
);

INSERT INTO `periodo_fichas` (`id`, `nombre`, `plantilla`, `tipo_id`, `periodo_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (1, 'Anexo 13', '{"sections":[{"id":278487897935,"name":"Formaci\\u00f3n Acad\\u00e9mica y Profesional","position":0,"score":"38","groups":[{"id":510700731415,"name":"Estudios de posgrado","type_id":1,"position":0,"score":"38","questions":[{"id":669901504318,"name":"Grado de Doctor. (m\\u00e1ximo 1)","position":0,"score":"10","options":[]},{"id":471685961826,"name":"Estudios concluidos de Doctorado","position":0,"score":"7","options":[]},{"id":1386041234498,"name":"Grado de Maestro\\/Magister. (m\\u00e1ximo 1)","position":0,"score":"8","options":[]},{"id":461785294614,"name":"Estudios concluidos de Maestr\\u00eda","position":0,"score":"5","options":[]},{"id":299944151858,"name":"Diplomado\\/Especializaci\\u00f3n, a nivel de Posgrado (hasta un m\\u00e1ximo de dos(2)","position":0,"score":"3","options":[]}]},{"id":966180316910,"name":"Estudios de pregrado","type_id":1,"position":0,"score":0,"questions":[{"id":210214086833,"name":"Otro T\\u00edtulo Profesional Pedag\\u00f3gico o T\\u00edtulo de Segunda Especialidad en Educaci\\u00f3n, no af\\u00edn al nivel o ciclo de la especialidad que postula (m\\u00e1ximo 1)","position":0,"score":"6","options":[]},{"id":929587823747,"name":"Otro T\\u00edtulo Universitario no Pedag\\u00f3gico (m\\u00e1ximo 1)","position":0,"score":"5","options":[]},{"id":1184435783500,"name":"Otro T\\u00edtulo Profesional T\\u00e9cnico (m\\u00e1ximo 1)","position":0,"score":"3","options":[]}]}]},{"id":641888213236,"name":"Formaci\\u00f3n Continua","position":0,"score":"3","groups":[{"id":359612152638,"name":"Talleres, capacitaci\\u00f3n, seminarios o congresos","type_id":1,"position":0,"score":0,"questions":[{"id":1493827940389,"name":"Realizado en los \\u00faltimos cinco (5) a\\u00f1os.\\nDuraci\\u00f3n m\\u00ednima de 16 horas pedag\\u00f3gicas.\\nPresenciales, virtuales o semipresenciales.\\nM\\u00e1ximo de tres (3)","position":0,"score":"1","options":[]},{"id":1389722125327,"name":"Tiene de 4 a m\\u00e1s a\\u00f1os adicionales al m\\u00ednimo requerido","position":0,"score":0,"options":[]}]}]},{"id":1570308861059,"name":"Experiencia Laboral","position":0,"score":"24","groups":[{"id":141790068280,"name":"Experiencia Laboral docente,\\ndurante los meses de marzo a diciembre, teniendo en cuenta","type_id":1,"position":0,"score":0,"questions":[{"id":1384426154455,"name":"Corresponde 0.20 puntos por cada mes acreditado de labor en IE ubicada en zona urbana. Corresponde 0.30 puntos por cada mes acreditado de labor en IE ubicada en zona de frontera. Corresponde 0.30 puntos por cada mes acreditado de labor en IE ubicada en zona rural. Corresponde 0.40 puntos por cada mes acreditado de labor en IE ubicada en zona VRAEM.","position":0,"score":"20","options":[]},{"id":1040688223918,"name":"Tiene de 4 a m\\u00e1s a\\u00f1os adicionales al m\\u00ednimo requerido","position":0,"score":0,"options":[]}]},{"id":1590150668232,"name":"Experiencia laboral como PEC","type_id":1,"position":0,"score":0,"questions":[{"id":1300044711716,"name":"Corresponde 0.10 puntos por cada mes acreditado (solo para postular al\\nnivel inicial).","position":0,"score":"4","options":[]},{"id":861982020443,"name":"Tiene de 4 a m\\u00e1s a\\u00f1os adicionales al m\\u00ednimo requerido","position":0,"score":0,"options":[]}]}]},{"id":107797951453,"name":"M\\u00e9ritos","position":0,"score":"5","groups":[{"id":1610513886669,"name":"Felicitaci\\u00f3n por desempe\\u00f1o o trabajo destacado en el campo pedag\\u00f3gico","type_id":"2","position":0,"score":"5","questions":[{"id":891404070946,"name":"Resoluci\\u00f3n Ministerial emitida por MINEDU (3 puntos). Resoluci\\u00f3n emitida por la DRE o de UGEL (2 puntos)","position":0,"score":"5","options":[{"id":1390888961065,"name":"CUMPLE","position":0},{"id":731080771893,"name":"NO CUMPLE","position":0}]},{"id":1194430752118,"name":"Cumple con el tercer Cursos y\\/o Estudios de Especializaci\\u00f3n","position":0,"score":0,"options":[{"id":1302903470264,"name":"CUMPLE","position":0},{"id":480164883418,"name":"NO CUMPLE","position":0}]}]}]}]}', 0, 1, '2023-10-31 04:17:49', '2023-10-31 07:17:44', NULL);
INSERT INTO `periodo_fichas` (`id`, `nombre`, `plantilla`, `tipo_id`, `periodo_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (2, 'Anexo 14', '{"sections":[{"id":1209307724712,"name":"FORMACI0N ACADEMICA","position":0,"score":"52","groups":[{"id":564889126834,"name":"1.1 Estudios de pregrado","position":0,"score":"3","questions":[{"id":1362724145467,"name":"T\\u00edtulo profesional","position":0,"score":"7","answers":[]},{"id":1092942509780,"name":"T\\u00edtulo profesional t\\u00e9cnico","position":0,"score":"6","answers":[]},{"id":1192888700698,"name":"T\\u00edtulo t\\u00e9cnico","position":0,"score":"5","answers":[]}]},{"id":729231710471,"name":"1.2 Estudios de posgrado","position":0,"score":0,"questions":[{"id":997400661726,"name":"Grado de doctor","position":0,"score":"3","answers":[]},{"id":1470842958033,"name":"Estudios de doctorado","position":0,"score":"2","answers":[]},{"id":1350515465517,"name":"Grado de maestro\\/mag\\u00edster","position":0,"score":"2","answers":[]},{"id":42703057291,"name":"Estudios concluidos de maestr\\u00eda","position":0,"score":"1","answers":[]}]},{"id":585788727369,"name":"1.3 Capacitaci\\u00f3n y actualizaci\\u00f3n en la especialidad","position":0,"score":0,"questions":[{"id":743906276429,"name":"Programas afines a la especialidad con duraci\\u00f3n mayor a 96 horas o su equivalente en cr\\u00e9ditos. Dos (2) puntos por cada 96 horas acumuladas en los \\u00faltimos 5 a\\u00f1os, hasta 12 puntos.","position":0,"score":"12","answers":[]},{"id":1461227966461,"name":"Programas afines a la especialidad con duraci\\u00f3n\\nigual o mayor a 16 horas y hasta 96 horas o su\\nequivalente en cr\\u00e9ditos. Un (1) punto por cada 16 horas acumuladas en los\\n\\u00faltimos 5 a\\u00f1os, hasta 8 puntos.","position":0,"score":"8","answers":[]}]},{"id":97700825143,"name":"1.4 Otros programas de formaci\\u00f3n continua, incluyendo temas de pedagog\\u00eda","position":0,"score":0,"questions":[{"id":175989034156,"name":"Programas con duraci\\u00f3n mayor a 96 horas o su\\nequivalente en cr\\u00e9ditos Dos (2) puntos por cada 96 horas acumuladas en los\\n\\u00faltimos 5 a\\u00f1os, hasta 6 puntos","position":0,"score":"6","answers":[]},{"id":1542708142724,"name":"Programas con duraci\\u00f3n igual o mayor a 16 horas y\\nhasta 96 horas o su equivalente en cr\\u00e9ditos. Un (1) punto por cada 16 horas acumuladas en los\\n\\u00faltimos 5 a\\u00f1os, hasta 4 puntos","position":0,"score":"4","answers":[]},{"id":409491722610,"name":"Cursos de Ofim\\u00e1tica igual o mayores a 24 horas o\\nsu equivalente en cr\\u00e9ditos. 1 punto por cada 24 horas acumuladas en los \\u00faltimos 5\\na\\u00f1os, hasta 4 puntos","position":0,"score":"4","answers":[]},{"id":184167895204,"name":"Certificaci\\u00f3n de dominio del idioma ingl\\u00e9s. Nivel Avanzado","position":0,"score":"4","answers":[]},{"id":491086770935,"name":"Lenguas Originarias. Incorporados en el RNDBLO","position":0,"score":"4","answers":[]}]}]},{"id":107168914640,"name":"2. EXPERIENCIA LABORAL","position":0,"score":"40","groups":[{"id":1064372763231,"name":"2.1 Experiencia laboral en el sector productivo (IIEE o privadas)  ","position":0,"score":0,"questions":[{"id":1502895473448,"name":"Tres (3) puntos por cada a\\u00f1o de experiencia profesional\\nno docente en el sector productivo de la especialidad en\\nlos \\u00faltimos 10 a\\u00f1os.","position":0,"score":"30","answers":[]}]},{"id":73426368134,"name":"2.2 Experiencia docente en Educaci\\u00f3n Superior o\\nT\\u00e9cnico \\u2013 productiva","position":0,"score":0,"questions":[{"id":716200461622,"name":"Un (1) punto por a\\u00f1o de experiencia docente dentro de\\nlos \\u00faltimos 10 a\\u00f1os.","position":0,"score":"10","answers":[]}]}]},{"id":790085968000,"name":"3. M\\u00c9RITOS","position":0,"score":"8","groups":[{"id":1264032213169,"name":"Reconocimiento o felicitaci\\u00f3n por logro o\\ncontribuci\\u00f3n en la gesti\\u00f3n o pr\\u00e1ctica pedag\\u00f3gica o\\nproyecto de innovaci\\u00f3n o investigaci\\u00f3n.","position":0,"score":0,"questions":[{"id":1181679959004,"name":"Dos (2) puntos por cada reconocimiento, hasta 8 puntos","position":0,"score":"8","answers":[]}]}]}]}', 0, 1, '2023-10-31 04:17:58', '2023-10-31 06:42:08', NULL);





/****************************** 15-11-23  ******************************/

-- Añadir la columna con_tipo
ALTER TABLE convocatorias
ADD COLUMN con_tipo int(4) DEFAULT NULL;

-- Añadir la restricción de clave externa
ALTER TABLE convocatorias
ADD CONSTRAINT fk_con_tipo
FOREIGN KEY (con_tipo)
REFERENCES tipo_convocatoria(tipo_id);

-- registramos una nueva tabla
CREATE TABLE `tipo_convocatoria` (
  `tipo_id` int(11) DEFAULT NULL,
  `descripcion` varchar(255) DEFAULT NULL,
  `created_at` DATETIME NULL DEFAULT current_timestamp(),
  `updated_at` DATETIME NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` DATETIME NULL DEFAULT NULL,
  KEY `tipo_id` (`tipo_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `tipo_convocatoria` (`tipo_id`, `descripcion`) VALUES (1, 'PUN');
INSERT INTO `tipo_convocatoria` (`tipo_id`, `descripcion`) VALUES (2, 'EVALUACIÓN DE EXPEDIENTE');


/*********** 16/11/2023 **********/

ALTER TABLE evaluacion_pun_exp ADD COLUMN `postulacion_id` INT(11) UNSIGNED NOT NULL DEFAULT '0' AFTER `epe_estado`;
ALTER TABLE evaluacion_pun_exp DROP COLUMN convocatorias_con_id;
ALTER TABLE evaluacion_pun_exp DROP FOREIGN KEY fk_evaluacion_pun_exp_cuadro_pun_exp1;
ALTER TABLE evaluacion_pun_exp DROP INDEX fk_evaluacion_pun_exp_cuadro_pun_exp1_idx;
ALTER TABLE evaluacion_pun_exp DROP COLUMN cuadro_pun_exp_cpe_id;
SELECT*FROM evaluacion_pun_exp;

