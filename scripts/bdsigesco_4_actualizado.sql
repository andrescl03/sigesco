/*
Navicat MySQL Data Transfer

Source Server         : LOCALHOST
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : bdsigesco_4

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2023-12-10 02:22:30
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for archivos_detalle
-- ----------------------------
DROP TABLE IF EXISTS `archivos_detalle`;
CREATE TABLE `archivos_detalle` (
  `adt_id` int(11) NOT NULL AUTO_INCREMENT,
  `adt_nombreArchivo` varchar(250) DEFAULT NULL,
  `adt_extensionArchivo` varchar(15) DEFAULT NULL,
  `adt_tipoArchivo` int(1) DEFAULT NULL COMMENT '(1: documento o adjunto, 2: anexo o fut) ',
  `adt_procedenciaArchivo` int(1) DEFAULT NULL COMMENT '(1: mpv, 2: interno) ',
  `adt_fechaCreacionArchivo` datetime DEFAULT NULL,
  `adt_fechaModificacionArchivo` datetime DEFAULT NULL,
  `adt_estado` int(1) DEFAULT NULL COMMENT '(1: activo 0 : eliminado)',
  `expedientes_exp_id` int(11) NOT NULL,
  PRIMARY KEY (`adt_id`),
  KEY `fk_archivos_detalle_expedientes1_idx` (`expedientes_exp_id`),
  CONSTRAINT `fk_archivos_detalle_expedientes1` FOREIGN KEY (`expedientes_exp_id`) REFERENCES `expedientes` (`exp_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=280 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of archivos_detalle
-- ----------------------------
INSERT INTO `archivos_detalle` VALUES ('3', 'archivos/adjuntos/2022/Setiembre/ad4c7771bedf02f8a94af7edc3f0137bd3.pdf', 'pdf', '1', '1', '2022-09-28 04:32:08', null, '1', '2');
INSERT INTO `archivos_detalle` VALUES ('4', 'archivos/tramites/2022/Setiembre/tr4c7771bedf02f8a94af7edc3f0137bd3.pdf', 'pdf', '2', '1', '2022-09-28 04:32:08', null, '1', '2');
INSERT INTO `archivos_detalle` VALUES ('5', 'archivos/adjuntos/2022/Setiembre/ad128c14f2f078ce3d9a2675a2bd1e73d8.pdf', 'pdf', '1', '1', '2022-09-28 04:39:25', null, '1', '3');
INSERT INTO `archivos_detalle` VALUES ('6', 'archivos/tramites/2022/Setiembre/tr128c14f2f078ce3d9a2675a2bd1e73d8.pdf', 'pdf', '2', '1', '2022-09-28 04:39:25', null, '1', '3');
INSERT INTO `archivos_detalle` VALUES ('7', 'archivos/adjuntos/2022/Setiembre/adc5a275ae4d2fbee23262d770622bdedc.pdf', 'pdf', '1', '1', '2022-09-28 05:50:03', null, '1', '4');
INSERT INTO `archivos_detalle` VALUES ('8', 'archivos/tramites/2022/Setiembre/trc5a275ae4d2fbee23262d770622bdedc.pdf', 'pdf', '2', '1', '2022-09-28 05:50:03', null, '1', '4');
INSERT INTO `archivos_detalle` VALUES ('9', 'archivos/adjuntos/2022/Setiembre/adcf309e299412d12add7b25f83d406937.pdf', 'pdf', '1', '1', '2022-09-28 05:50:03', null, '1', '5');
INSERT INTO `archivos_detalle` VALUES ('10', 'archivos/tramites/2022/Setiembre/trcf309e299412d12add7b25f83d406937.pdf', 'pdf', '2', '1', '2022-09-28 05:50:03', null, '1', '5');
INSERT INTO `archivos_detalle` VALUES ('11', 'archivos/adjuntos/2022/Setiembre/ad09b1db0e6e5412440ca5f2709efdc4e8.pdf', 'pdf', '1', '1', '2022-09-28 12:45:49', null, '1', '6');
INSERT INTO `archivos_detalle` VALUES ('12', 'archivos/subsanacion/2022/Setiembre/sub16593509b1db0e6e5412440ca5f2709efdc4e8.pdf', 'pdf', '1', '1', '2022-09-28 12:45:49', null, '1', '6');
INSERT INTO `archivos_detalle` VALUES ('13', 'archivos/tramites/2022/Setiembre/tr09b1db0e6e5412440ca5f2709efdc4e8.pdf', 'pdf', '2', '1', '2022-09-28 12:45:49', null, '1', '6');
INSERT INTO `archivos_detalle` VALUES ('14', 'archivos/adjuntos/2022/Setiembre/ad39a066071bd5a20f0a8610bc7af38bbc.pdf', 'pdf', '1', '1', '2022-09-28 12:45:49', null, '1', '7');
INSERT INTO `archivos_detalle` VALUES ('15', 'archivos/tramites/2022/Setiembre/tr39a066071bd5a20f0a8610bc7af38bbc.pdf', 'pdf', '2', '1', '2022-09-28 12:45:49', null, '1', '7');
INSERT INTO `archivos_detalle` VALUES ('16', 'archivos/adjuntos/2022/Setiembre/ad4c7771bedf02f8a94af7edc3f0137bd3.pdf', 'pdf', '1', '1', '2022-09-29 00:51:49', null, '1', '8');
INSERT INTO `archivos_detalle` VALUES ('17', 'archivos/tramites/2022/Setiembre/tr4c7771bedf02f8a94af7edc3f0137bd3.pdf', 'pdf', '2', '1', '2022-09-29 00:51:49', null, '1', '8');
INSERT INTO `archivos_detalle` VALUES ('18', 'archivos/adjuntos/2022/Setiembre/ad4c7771bedf02f8a94af7edc3f0137bd3.pdf', 'pdf', '1', '1', '2022-09-29 01:15:12', null, '1', '9');
INSERT INTO `archivos_detalle` VALUES ('19', 'archivos/tramites/2022/Setiembre/tr4c7771bedf02f8a94af7edc3f0137bd3.pdf', 'pdf', '2', '1', '2022-09-29 01:15:12', null, '1', '9');
INSERT INTO `archivos_detalle` VALUES ('20', 'archivos/adjuntos/2022/Setiembre/ad84f42a5b014a23b884f36dd6b33af7fb.pdf', 'pdf', '1', '1', '2022-09-29 01:15:12', null, '1', '10');
INSERT INTO `archivos_detalle` VALUES ('21', 'archivos/tramites/2022/Setiembre/tr84f42a5b014a23b884f36dd6b33af7fb.pdf', 'pdf', '2', '1', '2022-09-29 01:15:12', null, '1', '10');
INSERT INTO `archivos_detalle` VALUES ('22', 'archivos/adjuntos/2022/Setiembre/ada8198ffe8ce95d1a9dbbe4ce9228f2d0.pdf', 'pdf', '1', '1', '2022-09-29 01:15:12', null, '1', '11');
INSERT INTO `archivos_detalle` VALUES ('23', 'archivos/tramites/2022/Setiembre/tra8198ffe8ce95d1a9dbbe4ce9228f2d0.pdf', 'pdf', '2', '1', '2022-09-29 01:15:12', null, '1', '11');
INSERT INTO `archivos_detalle` VALUES ('24', 'archivos/adjuntos/2022/Setiembre/add7bee0cf6a3101d5ea20924ac8f71b1c.pdf', 'pdf', '1', '1', '2022-09-29 01:15:12', null, '1', '12');
INSERT INTO `archivos_detalle` VALUES ('25', 'archivos/tramites/2022/Setiembre/trd7bee0cf6a3101d5ea20924ac8f71b1c.pdf', 'pdf', '2', '1', '2022-09-29 01:15:12', null, '1', '12');
INSERT INTO `archivos_detalle` VALUES ('26', 'archivos/adjuntos/2022/Setiembre/ad4c7771bedf02f8a94af7edc3f0137bd3.pdf', 'pdf', '1', '1', '2022-09-29 10:31:55', null, '1', '13');
INSERT INTO `archivos_detalle` VALUES ('27', 'archivos/tramites/2022/Setiembre/tr4c7771bedf02f8a94af7edc3f0137bd3.pdf', 'pdf', '2', '1', '2022-09-29 10:31:55', null, '1', '13');
INSERT INTO `archivos_detalle` VALUES ('28', 'archivos/adjuntos/2022/Setiembre/ad87e0f77a453d7127d0398f6f8fb55226.pdf', 'pdf', '1', '1', '2022-10-03 17:40:06', null, '1', '14');
INSERT INTO `archivos_detalle` VALUES ('29', 'archivos/tramites/2022/Setiembre/tr87e0f77a453d7127d0398f6f8fb55226.pdf', 'pdf', '2', '1', '2022-10-03 17:40:06', null, '1', '14');
INSERT INTO `archivos_detalle` VALUES ('30', 'archivos/adjuntos/2022/Setiembre/adcdc2dde3084d5a28d750e7927eab6730.pdf', 'pdf', '1', '1', '2022-10-05 11:23:43', null, '1', '15');
INSERT INTO `archivos_detalle` VALUES ('31', 'archivos/tramites/2022/Setiembre/trcdc2dde3084d5a28d750e7927eab6730.pdf', 'pdf', '2', '1', '2022-10-05 11:23:43', null, '1', '15');
INSERT INTO `archivos_detalle` VALUES ('32', 'archivos/adjuntos/2022/Setiembre/adbd7383e5c0f9c6077c6ee18bb9276e2a.pdf', 'pdf', '1', '1', '2022-10-05 11:23:44', null, '1', '16');
INSERT INTO `archivos_detalle` VALUES ('33', 'archivos/tramites/2022/Setiembre/trbd7383e5c0f9c6077c6ee18bb9276e2a.pdf', 'pdf', '2', '1', '2022-10-05 11:23:44', null, '1', '16');
INSERT INTO `archivos_detalle` VALUES ('34', 'archivos/adjuntos/2022/Setiembre/ad4c7771bedf02f8a94af7edc3f0137bd3.pdf', 'pdf', '1', '1', '2022-10-05 11:23:44', null, '1', '17');
INSERT INTO `archivos_detalle` VALUES ('35', 'archivos/tramites/2022/Setiembre/tr4c7771bedf02f8a94af7edc3f0137bd3.pdf', 'pdf', '2', '1', '2022-10-05 11:23:44', null, '1', '17');
INSERT INTO `archivos_detalle` VALUES ('36', 'archivos/adjuntos/2022/Setiembre/ad193fcc2732dd64e85a6ceaacf9f5bc61.pdf', 'pdf', '1', '1', '2022-10-05 11:23:44', null, '1', '18');
INSERT INTO `archivos_detalle` VALUES ('37', 'archivos/tramites/2022/Setiembre/tr193fcc2732dd64e85a6ceaacf9f5bc61.pdf', 'pdf', '2', '1', '2022-10-05 11:23:44', null, '1', '18');
INSERT INTO `archivos_detalle` VALUES ('38', 'archivos/adjuntos/2022/Setiembre/addc536af199945cd2e00034bf936b8882.pdf', 'pdf', '1', '1', '2022-10-05 11:23:44', null, '1', '19');
INSERT INTO `archivos_detalle` VALUES ('39', 'archivos/tramites/2022/Setiembre/trdc536af199945cd2e00034bf936b8882.pdf', 'pdf', '2', '1', '2022-10-05 11:23:44', null, '1', '19');
INSERT INTO `archivos_detalle` VALUES ('40', 'archivos/adjuntos/2022/Setiembre/ad9f142768a3f1e8502ed25b15f3c5f78b.pdf', 'pdf', '1', '1', '2022-10-05 11:23:44', null, '1', '20');
INSERT INTO `archivos_detalle` VALUES ('41', 'archivos/tramites/2022/Setiembre/tr9f142768a3f1e8502ed25b15f3c5f78b.pdf', 'pdf', '2', '1', '2022-10-05 11:23:44', null, '1', '20');
INSERT INTO `archivos_detalle` VALUES ('42', 'archivos/adjuntos/2022/Setiembre/ad830d864d4753373770120d1825ad4599.pdf', 'pdf', '1', '1', '2022-10-05 11:23:44', null, '1', '21');
INSERT INTO `archivos_detalle` VALUES ('43', 'archivos/tramites/2022/Setiembre/tr830d864d4753373770120d1825ad4599.pdf', 'pdf', '2', '1', '2022-10-05 11:23:44', null, '1', '21');
INSERT INTO `archivos_detalle` VALUES ('44', 'archivos/adjuntos/2022/Setiembre/ad2a36f3ecbfb20378e5c0f5eb7b271e88.pdf', 'pdf', '1', '1', '2022-10-05 11:23:45', null, '1', '22');
INSERT INTO `archivos_detalle` VALUES ('45', 'archivos/tramites/2022/Setiembre/tr2a36f3ecbfb20378e5c0f5eb7b271e88.pdf', 'pdf', '2', '1', '2022-10-05 11:23:45', null, '1', '22');
INSERT INTO `archivos_detalle` VALUES ('46', 'archivos/adjuntos/2022/Setiembre/ad664c5b5b7dc28a820cfde3e128d8d7f2.pdf', 'pdf', '1', '1', '2022-10-05 11:23:45', null, '1', '23');
INSERT INTO `archivos_detalle` VALUES ('47', 'archivos/tramites/2022/Setiembre/tr664c5b5b7dc28a820cfde3e128d8d7f2.pdf', 'pdf', '2', '1', '2022-10-05 11:23:45', null, '1', '23');
INSERT INTO `archivos_detalle` VALUES ('48', 'archivos/adjuntos/2022/Setiembre/ad1b8eeb81213a61edc0315b2accda7486.pdf', 'pdf', '1', '1', '2022-10-05 11:23:45', null, '1', '24');
INSERT INTO `archivos_detalle` VALUES ('49', 'archivos/tramites/2022/Setiembre/tr1b8eeb81213a61edc0315b2accda7486.pdf', 'pdf', '2', '1', '2022-10-05 11:23:45', null, '1', '24');
INSERT INTO `archivos_detalle` VALUES ('50', 'archivos/adjuntos/2022/Setiembre/adee4342c2d0fb782a612339a1beb7cacb.pdf', 'pdf', '1', '1', '2022-10-05 11:23:45', null, '1', '25');
INSERT INTO `archivos_detalle` VALUES ('51', 'archivos/tramites/2022/Setiembre/tree4342c2d0fb782a612339a1beb7cacb.pdf', 'pdf', '2', '1', '2022-10-05 11:23:45', null, '1', '25');
INSERT INTO `archivos_detalle` VALUES ('52', 'archivos/adjuntos/2022/Setiembre/adb222de11e3b8bf5633d55d6630309d83.pdf', 'pdf', '1', '1', '2022-10-05 11:23:45', null, '1', '26');
INSERT INTO `archivos_detalle` VALUES ('53', 'archivos/tramites/2022/Setiembre/trb222de11e3b8bf5633d55d6630309d83.pdf', 'pdf', '2', '1', '2022-10-05 11:23:45', null, '1', '26');
INSERT INTO `archivos_detalle` VALUES ('54', 'archivos/adjuntos/2022/Setiembre/adf975de5848324a4131d89dc1a75a7470.pdf', 'pdf', '1', '1', '2022-10-05 11:23:45', null, '1', '27');
INSERT INTO `archivos_detalle` VALUES ('55', 'archivos/tramites/2022/Setiembre/trf975de5848324a4131d89dc1a75a7470.pdf', 'pdf', '2', '1', '2022-10-05 11:23:45', null, '1', '27');
INSERT INTO `archivos_detalle` VALUES ('56', 'archivos/adjuntos/2022/Setiembre/ad6aa8d50190f39710c67181703d379691.pdf', 'pdf', '1', '1', '2022-10-05 11:23:46', null, '1', '28');
INSERT INTO `archivos_detalle` VALUES ('57', 'archivos/tramites/2022/Setiembre/tr6aa8d50190f39710c67181703d379691.pdf', 'pdf', '2', '1', '2022-10-05 11:23:46', null, '1', '28');
INSERT INTO `archivos_detalle` VALUES ('58', 'archivos/adjuntos/2022/Setiembre/ada330559225e5f37c7b9784e81a1eecb2.pdf', 'pdf', '1', '1', '2022-10-05 11:23:46', null, '1', '29');
INSERT INTO `archivos_detalle` VALUES ('59', 'archivos/tramites/2022/Setiembre/tra330559225e5f37c7b9784e81a1eecb2.pdf', 'pdf', '2', '1', '2022-10-05 11:23:46', null, '1', '29');
INSERT INTO `archivos_detalle` VALUES ('60', 'archivos/adjuntos/2022/Setiembre/ad4552eaeee9b9278e8d08ca1d462eea1c.pdf', 'pdf', '1', '1', '2022-10-05 11:23:46', null, '1', '30');
INSERT INTO `archivos_detalle` VALUES ('61', 'archivos/tramites/2022/Setiembre/tr4552eaeee9b9278e8d08ca1d462eea1c.pdf', 'pdf', '2', '1', '2022-10-05 11:23:46', null, '1', '30');
INSERT INTO `archivos_detalle` VALUES ('62', 'archivos/adjuntos/2022/Setiembre/adc97977e6cd27a5ea483ae0218fccc2f6.pdf', 'pdf', '1', '1', '2022-10-05 11:57:52', null, '1', '31');
INSERT INTO `archivos_detalle` VALUES ('63', 'archivos/tramites/2022/Setiembre/trc97977e6cd27a5ea483ae0218fccc2f6.pdf', 'pdf', '2', '1', '2022-10-05 11:57:52', null, '1', '31');
INSERT INTO `archivos_detalle` VALUES ('64', 'archivos/adjuntos/2022/Setiembre/ad09b1db0e6e5412440ca5f2709efdc4e8.pdf', 'pdf', '1', '1', '2022-10-05 11:57:52', null, '1', '32');
INSERT INTO `archivos_detalle` VALUES ('65', 'archivos/subsanacion/2022/Setiembre/sub16593509b1db0e6e5412440ca5f2709efdc4e8.pdf', 'pdf', '1', '1', '2022-10-05 11:57:52', null, '1', '32');
INSERT INTO `archivos_detalle` VALUES ('66', 'archivos/tramites/2022/Setiembre/tr09b1db0e6e5412440ca5f2709efdc4e8.pdf', 'pdf', '2', '1', '2022-10-05 11:57:52', null, '1', '32');
INSERT INTO `archivos_detalle` VALUES ('67', 'archivos/adjuntos/2022/Setiembre/ad75006f7fc613cbfd38b116f111117ab4.pdf', 'pdf', '1', '1', '2022-10-05 11:57:52', null, '1', '33');
INSERT INTO `archivos_detalle` VALUES ('68', 'archivos/tramites/2022/Setiembre/tr75006f7fc613cbfd38b116f111117ab4.pdf', 'pdf', '2', '1', '2022-10-05 11:57:52', null, '1', '33');
INSERT INTO `archivos_detalle` VALUES ('69', 'archivos/adjuntos/2022/Setiembre/ad4c87267275178d5b62ce8fa42c0d94f3.pdf', 'pdf', '1', '1', '2022-10-05 11:57:52', null, '1', '34');
INSERT INTO `archivos_detalle` VALUES ('70', 'archivos/tramites/2022/Setiembre/tr4c87267275178d5b62ce8fa42c0d94f3.pdf', 'pdf', '2', '1', '2022-10-05 11:57:52', null, '1', '34');
INSERT INTO `archivos_detalle` VALUES ('71', 'archivos/adjuntos/2022/Setiembre/ad3ee0a0ad881584a9ed87afdf72480b09.pdf', 'pdf', '1', '1', '2022-10-05 11:57:52', null, '1', '35');
INSERT INTO `archivos_detalle` VALUES ('72', 'archivos/tramites/2022/Setiembre/tr3ee0a0ad881584a9ed87afdf72480b09.pdf', 'pdf', '2', '1', '2022-10-05 11:57:52', null, '1', '35');
INSERT INTO `archivos_detalle` VALUES ('73', 'archivos/adjuntos/2022/Setiembre/adc85deed21f19de43d91d385adde3832d.pdf', 'pdf', '1', '1', '2022-10-05 11:57:53', null, '1', '36');
INSERT INTO `archivos_detalle` VALUES ('74', 'archivos/tramites/2022/Setiembre/trc85deed21f19de43d91d385adde3832d.pdf', 'pdf', '2', '1', '2022-10-05 11:57:53', null, '1', '36');
INSERT INTO `archivos_detalle` VALUES ('75', 'archivos/adjuntos/2022/Setiembre/ad879c03532665284c9e2e580debd09e9d.pdf', 'pdf', '1', '1', '2022-10-05 11:57:53', null, '1', '37');
INSERT INTO `archivos_detalle` VALUES ('76', 'archivos/tramites/2022/Setiembre/tr879c03532665284c9e2e580debd09e9d.pdf', 'pdf', '2', '1', '2022-10-05 11:57:53', null, '1', '37');
INSERT INTO `archivos_detalle` VALUES ('77', 'archivos/adjuntos/2022/Setiembre/ad368d4df534d4587df89f8d7c01de7146.pdf', 'pdf', '1', '1', '2022-10-05 11:57:53', null, '1', '38');
INSERT INTO `archivos_detalle` VALUES ('78', 'archivos/tramites/2022/Setiembre/tr368d4df534d4587df89f8d7c01de7146.pdf', 'pdf', '2', '1', '2022-10-05 11:57:53', null, '1', '38');
INSERT INTO `archivos_detalle` VALUES ('79', 'archivos/adjuntos/2022/Setiembre/ad39a066071bd5a20f0a8610bc7af38bbc.pdf', 'pdf', '1', '1', '2022-10-05 11:57:53', null, '1', '39');
INSERT INTO `archivos_detalle` VALUES ('80', 'archivos/tramites/2022/Setiembre/tr39a066071bd5a20f0a8610bc7af38bbc.pdf', 'pdf', '2', '1', '2022-10-05 11:57:53', null, '1', '39');
INSERT INTO `archivos_detalle` VALUES ('81', 'archivos/adjuntos/2022/Setiembre/add7bee0cf6a3101d5ea20924ac8f71b1c.pdf', 'pdf', '1', '1', '2022-10-05 11:57:53', null, '1', '40');
INSERT INTO `archivos_detalle` VALUES ('82', 'archivos/tramites/2022/Setiembre/trd7bee0cf6a3101d5ea20924ac8f71b1c.pdf', 'pdf', '2', '1', '2022-10-05 11:57:53', null, '1', '40');
INSERT INTO `archivos_detalle` VALUES ('83', 'archivos/adjuntos/2022/Setiembre/ad4af7005ffc18c966ab9340f229fc013f.pdf', 'pdf', '1', '1', '2022-10-05 11:57:53', null, '1', '41');
INSERT INTO `archivos_detalle` VALUES ('84', 'archivos/tramites/2022/Setiembre/tr4af7005ffc18c966ab9340f229fc013f.pdf', 'pdf', '2', '1', '2022-10-05 11:57:53', null, '1', '41');
INSERT INTO `archivos_detalle` VALUES ('85', 'archivos/adjuntos/2022/Setiembre/adadc762f0c91098d2370ca02064f25007.pdf', 'pdf', '1', '1', '2022-10-05 11:57:54', null, '1', '42');
INSERT INTO `archivos_detalle` VALUES ('86', 'archivos/tramites/2022/Setiembre/tradc762f0c91098d2370ca02064f25007.pdf', 'pdf', '2', '1', '2022-10-05 11:57:54', null, '1', '42');
INSERT INTO `archivos_detalle` VALUES ('91', 'archivos/adjuntos/2022/Agosto/ade56f217513983f730fa4c572dd7321ab.pdf', 'pdf', '1', '1', '2022-10-05 23:36:26', null, '1', '45');
INSERT INTO `archivos_detalle` VALUES ('92', 'archivos/tramites/2022/Agosto/tre56f217513983f730fa4c572dd7321ab.pdf', 'pdf', '2', '1', '2022-10-05 23:36:26', null, '1', '45');
INSERT INTO `archivos_detalle` VALUES ('93', 'archivos/adjuntos/2022/Agosto/ad242fda64ee2e9e075d9a777ea335905c.pdf', 'pdf', '1', '1', '2022-10-05 23:37:54', null, '1', '46');
INSERT INTO `archivos_detalle` VALUES ('94', 'archivos/tramites/2022/Agosto/tr242fda64ee2e9e075d9a777ea335905c.pdf', 'pdf', '2', '1', '2022-10-05 23:37:54', null, '1', '46');
INSERT INTO `archivos_detalle` VALUES ('95', 'archivos/adjuntos/2022/Agosto/ad59633d8a39c667e1e7db12113d2d8296.pdf', 'pdf', '1', '1', '2022-10-05 23:38:57', null, '1', '47');
INSERT INTO `archivos_detalle` VALUES ('96', 'archivos/subsanacion/2022/Agosto/sub12460459633d8a39c667e1e7db12113d2d8296.pdf', 'pdf', '1', '1', '2022-10-05 23:38:57', null, '1', '47');
INSERT INTO `archivos_detalle` VALUES ('97', 'archivos/subsanacion/2022/Agosto/sub21513759633d8a39c667e1e7db12113d2d8296.pdf', 'pdf', '1', '1', '2022-10-05 23:38:57', null, '1', '47');
INSERT INTO `archivos_detalle` VALUES ('98', 'archivos/tramites/2022/Agosto/tr59633d8a39c667e1e7db12113d2d8296.pdf', 'pdf', '2', '1', '2022-10-05 23:38:57', null, '1', '47');
INSERT INTO `archivos_detalle` VALUES ('99', 'archivos/adjuntos/2022/Agosto/adfdefe1ffa128f500fc09668181531f4c.pdf', 'pdf', '1', '1', '2022-10-05 23:38:57', null, '1', '48');
INSERT INTO `archivos_detalle` VALUES ('100', 'archivos/tramites/2022/Agosto/trfdefe1ffa128f500fc09668181531f4c.pdf', 'pdf', '2', '1', '2022-10-05 23:38:57', null, '1', '48');
INSERT INTO `archivos_detalle` VALUES ('101', 'archivos/adjuntos/2022/Agosto/adcd7f551a5f3d3882319693452858b86f.pdf', 'pdf', '1', '1', '2022-10-05 23:38:57', null, '1', '49');
INSERT INTO `archivos_detalle` VALUES ('102', 'archivos/tramites/2022/Agosto/trcd7f551a5f3d3882319693452858b86f.pdf', 'pdf', '2', '1', '2022-10-05 23:38:57', null, '1', '49');
INSERT INTO `archivos_detalle` VALUES ('103', 'archivos/adjuntos/2022/Agosto/ad2a6ef481fe0cb1ac8f539676dba50818.pdf', 'pdf', '1', '1', '2022-10-05 23:38:57', null, '1', '50');
INSERT INTO `archivos_detalle` VALUES ('104', 'archivos/tramites/2022/Agosto/tr2a6ef481fe0cb1ac8f539676dba50818.pdf', 'pdf', '2', '1', '2022-10-05 23:38:57', null, '1', '50');
INSERT INTO `archivos_detalle` VALUES ('105', 'archivos/adjuntos/2022/Agosto/ad9694c73d8b0124b77f7d93378b6d8730.pdf', 'pdf', '1', '1', '2022-10-05 23:38:57', null, '1', '51');
INSERT INTO `archivos_detalle` VALUES ('106', 'archivos/tramites/2022/Agosto/tr9694c73d8b0124b77f7d93378b6d8730.pdf', 'pdf', '2', '1', '2022-10-05 23:38:57', null, '1', '51');
INSERT INTO `archivos_detalle` VALUES ('107', 'archivos/adjuntos/2022/Agosto/adf9289cf00f6088f7ff9a971954ab9676.pdf', 'pdf', '1', '1', '2022-10-05 23:38:58', null, '1', '52');
INSERT INTO `archivos_detalle` VALUES ('108', 'archivos/tramites/2022/Agosto/trf9289cf00f6088f7ff9a971954ab9676.pdf', 'pdf', '2', '1', '2022-10-05 23:38:58', null, '1', '52');
INSERT INTO `archivos_detalle` VALUES ('109', 'archivos/adjuntos/2022/Agosto/ad43332587ca4787d434c7f6933d68038d.pdf', 'pdf', '1', '1', '2022-10-05 23:38:58', null, '1', '53');
INSERT INTO `archivos_detalle` VALUES ('110', 'archivos/tramites/2022/Agosto/tr43332587ca4787d434c7f6933d68038d.pdf', 'pdf', '2', '1', '2022-10-05 23:38:58', null, '1', '53');
INSERT INTO `archivos_detalle` VALUES ('111', 'archivos/adjuntos/2022/Agosto/ad1e2f1e2aa2151d591c696d1e6427212d.pdf', 'pdf', '1', '1', '2022-10-05 23:38:58', null, '1', '54');
INSERT INTO `archivos_detalle` VALUES ('112', 'archivos/tramites/2022/Agosto/tr1e2f1e2aa2151d591c696d1e6427212d.pdf', 'pdf', '2', '1', '2022-10-05 23:38:58', null, '1', '54');
INSERT INTO `archivos_detalle` VALUES ('113', 'archivos/adjuntos/2022/Agosto/ad3aa841b3cafe7b6485b57601d3c949ce.pdf', 'pdf', '1', '1', '2022-10-05 23:38:58', null, '1', '55');
INSERT INTO `archivos_detalle` VALUES ('114', 'archivos/tramites/2022/Agosto/tr3aa841b3cafe7b6485b57601d3c949ce.pdf', 'pdf', '2', '1', '2022-10-05 23:38:58', null, '1', '55');
INSERT INTO `archivos_detalle` VALUES ('115', 'archivos/adjuntos/2022/Agosto/ada92f7599b45395f2b3c5b1515abeec45.pdf', 'pdf', '1', '1', '2022-10-05 23:41:26', null, '1', '56');
INSERT INTO `archivos_detalle` VALUES ('116', 'archivos/tramites/2022/Agosto/tra92f7599b45395f2b3c5b1515abeec45.pdf', 'pdf', '2', '1', '2022-10-05 23:41:26', null, '1', '56');
INSERT INTO `archivos_detalle` VALUES ('117', 'archivos/adjuntos/2022/Agosto/ad577ddbd8c357c0b2f80b5e2c8502fa90.pdf', 'pdf', '1', '1', '2022-10-05 23:41:26', null, '1', '57');
INSERT INTO `archivos_detalle` VALUES ('118', 'archivos/tramites/2022/Agosto/tr577ddbd8c357c0b2f80b5e2c8502fa90.pdf', 'pdf', '2', '1', '2022-10-05 23:41:26', null, '1', '57');
INSERT INTO `archivos_detalle` VALUES ('119', 'archivos/adjuntos/2022/Agosto/ada25d2c5582bc55622482f96aab22aac2.pdf', 'pdf', '1', '1', '2022-10-05 23:41:26', null, '1', '58');
INSERT INTO `archivos_detalle` VALUES ('120', 'archivos/tramites/2022/Agosto/tra25d2c5582bc55622482f96aab22aac2.pdf', 'pdf', '2', '1', '2022-10-05 23:41:26', null, '1', '58');
INSERT INTO `archivos_detalle` VALUES ('121', 'archivos/adjuntos/2022/Agosto/ad9fff191eeea4e3c4a37506a075384fd7.pdf', 'pdf', '1', '1', '2022-10-05 23:41:26', null, '1', '59');
INSERT INTO `archivos_detalle` VALUES ('122', 'archivos/tramites/2022/Agosto/tr9fff191eeea4e3c4a37506a075384fd7.pdf', 'pdf', '2', '1', '2022-10-05 23:41:26', null, '1', '59');
INSERT INTO `archivos_detalle` VALUES ('123', 'archivos/adjuntos/2022/Agosto/ad27c465333a0c7506db9044777ca2fd35.pdf', 'pdf', '1', '1', '2022-10-05 23:41:27', null, '1', '60');
INSERT INTO `archivos_detalle` VALUES ('124', 'archivos/tramites/2022/Agosto/tr27c465333a0c7506db9044777ca2fd35.pdf', 'pdf', '2', '1', '2022-10-05 23:41:27', null, '1', '60');
INSERT INTO `archivos_detalle` VALUES ('125', 'archivos/adjuntos/2022/Agosto/adc4f7fdb3da7bbfdefbb05f3d93feb1ea.pdf', 'pdf', '1', '1', '2022-10-05 23:41:27', null, '1', '61');
INSERT INTO `archivos_detalle` VALUES ('126', 'archivos/tramites/2022/Agosto/trc4f7fdb3da7bbfdefbb05f3d93feb1ea.pdf', 'pdf', '2', '1', '2022-10-05 23:41:27', null, '1', '61');
INSERT INTO `archivos_detalle` VALUES ('127', 'archivos/adjuntos/2022/Agosto/add36629a0af9bbcb1c31c95a9380b5567.pdf', 'pdf', '1', '1', '2022-10-05 23:41:27', null, '1', '62');
INSERT INTO `archivos_detalle` VALUES ('128', 'archivos/tramites/2022/Agosto/trd36629a0af9bbcb1c31c95a9380b5567.pdf', 'pdf', '2', '1', '2022-10-05 23:41:27', null, '1', '62');
INSERT INTO `archivos_detalle` VALUES ('129', 'archivos/adjuntos/2022/Agosto/ad619f5914b0b72b4249eb4af51d541bb7.pdf', 'pdf', '1', '1', '2022-10-05 23:41:27', null, '1', '63');
INSERT INTO `archivos_detalle` VALUES ('130', 'archivos/tramites/2022/Agosto/tr619f5914b0b72b4249eb4af51d541bb7.pdf', 'pdf', '2', '1', '2022-10-05 23:41:27', null, '1', '63');
INSERT INTO `archivos_detalle` VALUES ('131', 'archivos/adjuntos/2022/Agosto/ade0c9fffffc806745e656695f8ebc7a04.pdf', 'pdf', '1', '1', '2022-10-05 23:41:27', null, '1', '64');
INSERT INTO `archivos_detalle` VALUES ('132', 'archivos/tramites/2022/Agosto/tre0c9fffffc806745e656695f8ebc7a04.pdf', 'pdf', '2', '1', '2022-10-05 23:41:27', null, '1', '64');
INSERT INTO `archivos_detalle` VALUES ('133', 'archivos/adjuntos/2022/Agosto/ad33f86266586bc593ea3203885afc2582.pdf', 'pdf', '1', '1', '2022-10-05 23:41:27', null, '1', '65');
INSERT INTO `archivos_detalle` VALUES ('134', 'archivos/tramites/2022/Agosto/tr33f86266586bc593ea3203885afc2582.pdf', 'pdf', '2', '1', '2022-10-05 23:41:27', null, '1', '65');
INSERT INTO `archivos_detalle` VALUES ('135', 'archivos/adjuntos/2022/Agosto/ad928f368eade94f1cbd51d36bd72228be.pdf', 'pdf', '1', '1', '2022-10-05 23:54:01', null, '1', '66');
INSERT INTO `archivos_detalle` VALUES ('136', 'archivos/tramites/2022/Agosto/tr928f368eade94f1cbd51d36bd72228be.pdf', 'pdf', '2', '1', '2022-10-05 23:54:01', null, '1', '66');
INSERT INTO `archivos_detalle` VALUES ('137', 'archivos/adjuntos/2022/Agosto/ad8d54d8a2156b1417aeb21c990f64f191.pdf', 'pdf', '1', '1', '2022-10-05 23:54:01', null, '1', '67');
INSERT INTO `archivos_detalle` VALUES ('138', 'archivos/tramites/2022/Agosto/tr8d54d8a2156b1417aeb21c990f64f191.pdf', 'pdf', '2', '1', '2022-10-05 23:54:01', null, '1', '67');
INSERT INTO `archivos_detalle` VALUES ('139', 'archivos/adjuntos/2022/Agosto/adfd25c31fb6f21403866fc362ec479a1c.pdf', 'pdf', '1', '1', '2022-10-05 23:54:01', null, '1', '68');
INSERT INTO `archivos_detalle` VALUES ('140', 'archivos/tramites/2022/Agosto/trfd25c31fb6f21403866fc362ec479a1c.pdf', 'pdf', '2', '1', '2022-10-05 23:54:01', null, '1', '68');
INSERT INTO `archivos_detalle` VALUES ('141', 'archivos/adjuntos/2022/Setiembre/ad3025a44a271f617639af6020716d00c5.pdf', 'pdf', '1', '1', '2022-10-11 09:46:21', null, '1', '69');
INSERT INTO `archivos_detalle` VALUES ('142', 'archivos/tramites/2022/Setiembre/tr3025a44a271f617639af6020716d00c5.pdf', 'pdf', '2', '1', '2022-10-11 09:46:21', null, '1', '69');
INSERT INTO `archivos_detalle` VALUES ('143', 'archivos/adjuntos/2022/Setiembre/ad6d78f6e796bdf8986570e7794b00d6c7.pdf', 'pdf', '1', '1', '2022-10-11 09:46:22', null, '1', '70');
INSERT INTO `archivos_detalle` VALUES ('144', 'archivos/tramites/2022/Setiembre/tr6d78f6e796bdf8986570e7794b00d6c7.pdf', 'pdf', '2', '1', '2022-10-11 09:46:22', null, '1', '70');
INSERT INTO `archivos_detalle` VALUES ('145', 'archivos/adjuntos/2022/Setiembre/adf18e75c991d510c3a2688519ee1596b9.pdf', 'pdf', '1', '1', '2022-10-11 09:46:22', null, '1', '71');
INSERT INTO `archivos_detalle` VALUES ('146', 'archivos/tramites/2022/Setiembre/trf18e75c991d510c3a2688519ee1596b9.pdf', 'pdf', '2', '1', '2022-10-11 09:46:22', null, '1', '71');
INSERT INTO `archivos_detalle` VALUES ('147', 'archivos/adjuntos/2022/Setiembre/ad128c14f2f078ce3d9a2675a2bd1e73d8.pdf', 'pdf', '1', '1', '2022-10-11 09:46:22', null, '1', '72');
INSERT INTO `archivos_detalle` VALUES ('148', 'archivos/tramites/2022/Setiembre/tr128c14f2f078ce3d9a2675a2bd1e73d8.pdf', 'pdf', '2', '1', '2022-10-11 09:46:22', null, '1', '72');
INSERT INTO `archivos_detalle` VALUES ('149', 'archivos/adjuntos/2022/Setiembre/ad83fc94b624b8c9d5a49e655d27dd5e6a.pdf', 'pdf', '1', '1', '2022-10-11 09:46:22', null, '1', '73');
INSERT INTO `archivos_detalle` VALUES ('150', 'archivos/tramites/2022/Setiembre/tr83fc94b624b8c9d5a49e655d27dd5e6a.pdf', 'pdf', '2', '1', '2022-10-11 09:46:22', null, '1', '73');
INSERT INTO `archivos_detalle` VALUES ('151', 'archivos/adjuntos/2022/Setiembre/ad1a30bfa339909508d4b46ad1de65cb10.pdf', 'pdf', '1', '1', '2022-10-11 09:46:22', null, '1', '74');
INSERT INTO `archivos_detalle` VALUES ('152', 'archivos/tramites/2022/Setiembre/tr1a30bfa339909508d4b46ad1de65cb10.pdf', 'pdf', '2', '1', '2022-10-11 09:46:22', null, '1', '74');
INSERT INTO `archivos_detalle` VALUES ('153', 'archivos/adjuntos/2022/Setiembre/ad602cc7a6849e9d42672d7a961bf5bf78.pdf', 'pdf', '1', '1', '2022-10-11 09:46:22', null, '1', '75');
INSERT INTO `archivos_detalle` VALUES ('154', 'archivos/tramites/2022/Setiembre/tr602cc7a6849e9d42672d7a961bf5bf78.pdf', 'pdf', '2', '1', '2022-10-11 09:46:22', null, '1', '75');
INSERT INTO `archivos_detalle` VALUES ('155', 'archivos/adjuntos/2022/Setiembre/add920cfe33c564aacd68f2657a26b7f7e.pdf', 'pdf', '1', '1', '2022-10-11 09:46:22', null, '1', '76');
INSERT INTO `archivos_detalle` VALUES ('156', 'archivos/tramites/2022/Setiembre/trd920cfe33c564aacd68f2657a26b7f7e.pdf', 'pdf', '2', '1', '2022-10-11 09:46:22', null, '1', '76');
INSERT INTO `archivos_detalle` VALUES ('157', 'archivos/adjuntos/2022/Setiembre/adf3369dc4471ff32032a8e5345cb84927.pdf', 'pdf', '1', '1', '2022-10-11 09:46:23', null, '1', '77');
INSERT INTO `archivos_detalle` VALUES ('158', 'archivos/tramites/2022/Setiembre/trf3369dc4471ff32032a8e5345cb84927.pdf', 'pdf', '2', '1', '2022-10-11 09:46:23', null, '1', '77');
INSERT INTO `archivos_detalle` VALUES ('159', 'archivos/adjuntos/2022/Setiembre/ad8b7faf3f6ae59e6082b2a6031c350e03.pdf', 'pdf', '1', '1', '2022-10-11 09:46:23', null, '1', '78');
INSERT INTO `archivos_detalle` VALUES ('160', 'archivos/tramites/2022/Setiembre/tr8b7faf3f6ae59e6082b2a6031c350e03.pdf', 'pdf', '2', '1', '2022-10-11 09:46:23', null, '1', '78');
INSERT INTO `archivos_detalle` VALUES ('161', 'archivos/adjuntos/2022/Setiembre/ad66511600343879bc0811ad08100e8c53.pdf', 'pdf', '1', '1', '2022-10-11 09:46:23', null, '1', '79');
INSERT INTO `archivos_detalle` VALUES ('162', 'archivos/tramites/2022/Setiembre/tr66511600343879bc0811ad08100e8c53.pdf', 'pdf', '2', '1', '2022-10-11 09:46:23', null, '1', '79');
INSERT INTO `archivos_detalle` VALUES ('163', 'archivos/adjuntos/2022/Setiembre/adf7573246f08512c3eeec9cf0c4347c0b.pdf', 'pdf', '1', '1', '2022-10-11 09:46:23', null, '1', '80');
INSERT INTO `archivos_detalle` VALUES ('164', 'archivos/tramites/2022/Setiembre/trf7573246f08512c3eeec9cf0c4347c0b.pdf', 'pdf', '2', '1', '2022-10-11 09:46:23', null, '1', '80');
INSERT INTO `archivos_detalle` VALUES ('165', 'archivos/adjuntos/2022/Setiembre/ad1cde81ae8bb125ccd34881a2241264ed.pdf', 'pdf', '1', '1', '2022-10-11 09:46:23', null, '1', '81');
INSERT INTO `archivos_detalle` VALUES ('166', 'archivos/tramites/2022/Setiembre/tr1cde81ae8bb125ccd34881a2241264ed.pdf', 'pdf', '2', '1', '2022-10-11 09:46:23', null, '1', '81');
INSERT INTO `archivos_detalle` VALUES ('167', 'archivos/adjuntos/2022/Setiembre/ad9ffd972e7e402b4f8430a169fce78745.pdf', 'pdf', '1', '1', '2022-10-11 09:46:23', null, '1', '82');
INSERT INTO `archivos_detalle` VALUES ('168', 'archivos/tramites/2022/Setiembre/tr9ffd972e7e402b4f8430a169fce78745.pdf', 'pdf', '2', '1', '2022-10-11 09:46:23', null, '1', '82');
INSERT INTO `archivos_detalle` VALUES ('169', 'archivos/adjuntos/2022/Setiembre/adfa783f7a527b9c5718ba5244803bb785.pdf', 'pdf', '1', '1', '2022-10-11 09:46:24', null, '1', '83');
INSERT INTO `archivos_detalle` VALUES ('170', 'archivos/tramites/2022/Setiembre/trfa783f7a527b9c5718ba5244803bb785.pdf', 'pdf', '2', '1', '2022-10-11 09:46:24', null, '1', '83');
INSERT INTO `archivos_detalle` VALUES ('171', 'archivos/adjuntos/2022/Setiembre/adeb42113defe6ffaf1361e3baf2ae8d9f.pdf', 'pdf', '1', '1', '2022-10-11 09:46:24', null, '1', '84');
INSERT INTO `archivos_detalle` VALUES ('172', 'archivos/tramites/2022/Setiembre/treb42113defe6ffaf1361e3baf2ae8d9f.pdf', 'pdf', '2', '1', '2022-10-11 09:46:24', null, '1', '84');
INSERT INTO `archivos_detalle` VALUES ('173', 'archivos/adjuntos/2022/Setiembre/adb2008f0e3765dcd08ae0a2df1fa43990.pdf', 'pdf', '1', '1', '2022-10-11 09:46:24', null, '1', '85');
INSERT INTO `archivos_detalle` VALUES ('174', 'archivos/tramites/2022/Setiembre/trb2008f0e3765dcd08ae0a2df1fa43990.pdf', 'pdf', '2', '1', '2022-10-11 09:46:24', null, '1', '85');
INSERT INTO `archivos_detalle` VALUES ('175', 'archivos/adjuntos/2022/Setiembre/ad73c695870e50b2e9eb8ac4b0a5db4092.pdf', 'pdf', '1', '1', '2022-10-11 09:46:24', null, '1', '86');
INSERT INTO `archivos_detalle` VALUES ('176', 'archivos/tramites/2022/Setiembre/tr73c695870e50b2e9eb8ac4b0a5db4092.pdf', 'pdf', '2', '1', '2022-10-11 09:46:24', null, '1', '86');
INSERT INTO `archivos_detalle` VALUES ('177', 'archivos/adjuntos/2022/Setiembre/ad0f80a482cba2a749305b8b0cc9dbf902.pdf', 'pdf', '1', '1', '2022-10-11 09:46:24', null, '1', '87');
INSERT INTO `archivos_detalle` VALUES ('178', 'archivos/tramites/2022/Setiembre/tr0f80a482cba2a749305b8b0cc9dbf902.pdf', 'pdf', '2', '1', '2022-10-11 09:46:24', null, '1', '87');
INSERT INTO `archivos_detalle` VALUES ('179', 'archivos/adjuntos/2022/Setiembre/ad010e10bdeeb42c4f27edb5cc0b806684.pdf', 'pdf', '1', '1', '2022-10-11 09:46:24', null, '1', '88');
INSERT INTO `archivos_detalle` VALUES ('180', 'archivos/tramites/2022/Setiembre/tr010e10bdeeb42c4f27edb5cc0b806684.pdf', 'pdf', '2', '1', '2022-10-11 09:46:24', null, '1', '88');
INSERT INTO `archivos_detalle` VALUES ('181', 'archivos/adjuntos/2022/Setiembre/adbcef7f82f2aafb1c68d71302de033cf7.pdf', 'pdf', '1', '1', '2022-10-11 09:46:24', null, '1', '89');
INSERT INTO `archivos_detalle` VALUES ('182', 'archivos/tramites/2022/Setiembre/trbcef7f82f2aafb1c68d71302de033cf7.pdf', 'pdf', '2', '1', '2022-10-11 09:46:24', null, '1', '89');
INSERT INTO `archivos_detalle` VALUES ('183', 'archivos/adjuntos/2022/Setiembre/ad3a7a35041eca0025da5a8ef7248748f9.pdf', 'pdf', '1', '1', '2022-10-11 09:46:25', null, '1', '90');
INSERT INTO `archivos_detalle` VALUES ('184', 'archivos/tramites/2022/Setiembre/tr3a7a35041eca0025da5a8ef7248748f9.pdf', 'pdf', '2', '1', '2022-10-11 09:46:25', null, '1', '90');
INSERT INTO `archivos_detalle` VALUES ('185', 'archivos/adjuntos/2022/Setiembre/adfcc69f865727ab3ddb25f5f37ac6e72f.pdf', 'pdf', '1', '1', '2022-10-11 09:46:25', null, '1', '91');
INSERT INTO `archivos_detalle` VALUES ('186', 'archivos/tramites/2022/Setiembre/trfcc69f865727ab3ddb25f5f37ac6e72f.pdf', 'pdf', '2', '1', '2022-10-11 09:46:25', null, '1', '91');
INSERT INTO `archivos_detalle` VALUES ('187', 'archivos/adjuntos/2022/Setiembre/addb3dbeffba8b6a5dd25951ab9434cda5.pdf', 'pdf', '1', '1', '2022-10-11 09:46:25', null, '1', '92');
INSERT INTO `archivos_detalle` VALUES ('188', 'archivos/tramites/2022/Setiembre/trdb3dbeffba8b6a5dd25951ab9434cda5.pdf', 'pdf', '2', '1', '2022-10-11 09:46:25', null, '1', '92');
INSERT INTO `archivos_detalle` VALUES ('189', 'archivos/adjuntos/2022/Setiembre/adbb7f45e2cd27e6fbe9ad531dabe17713.pdf', 'pdf', '1', '1', '2022-10-11 09:46:25', null, '1', '93');
INSERT INTO `archivos_detalle` VALUES ('190', 'archivos/tramites/2022/Setiembre/trbb7f45e2cd27e6fbe9ad531dabe17713.pdf', 'pdf', '2', '1', '2022-10-11 09:46:25', null, '1', '93');
INSERT INTO `archivos_detalle` VALUES ('191', 'archivos/adjuntos/2022/Setiembre/ad4d9cecf8fea9a9e115d8a90a808a527d.pdf', 'pdf', '1', '1', '2022-10-11 09:46:25', null, '1', '94');
INSERT INTO `archivos_detalle` VALUES ('192', 'archivos/tramites/2022/Setiembre/tr4d9cecf8fea9a9e115d8a90a808a527d.pdf', 'pdf', '2', '1', '2022-10-11 09:46:25', null, '1', '94');
INSERT INTO `archivos_detalle` VALUES ('193', 'archivos/adjuntos/2022/Setiembre/ad7f72fcdfe6d4de9cf3718c6cc7110035.pdf', 'pdf', '1', '1', '2022-10-11 09:46:25', null, '1', '95');
INSERT INTO `archivos_detalle` VALUES ('194', 'archivos/tramites/2022/Setiembre/tr7f72fcdfe6d4de9cf3718c6cc7110035.pdf', 'pdf', '2', '1', '2022-10-11 09:46:25', null, '1', '95');
INSERT INTO `archivos_detalle` VALUES ('195', 'archivos/adjuntos/2022/Setiembre/adc445bf581552f9ea65ec7d39dd72798f.pdf', 'pdf', '1', '1', '2022-10-11 09:46:26', null, '1', '96');
INSERT INTO `archivos_detalle` VALUES ('196', 'archivos/tramites/2022/Setiembre/trc445bf581552f9ea65ec7d39dd72798f.pdf', 'pdf', '2', '1', '2022-10-11 09:46:26', null, '1', '96');
INSERT INTO `archivos_detalle` VALUES ('197', 'archivos/adjuntos/2022/Agosto/adc4ea74ffca447cdd96c56ca866e7e23c.pdf', 'pdf', '1', '1', '2022-10-11 09:46:26', null, '1', '97');
INSERT INTO `archivos_detalle` VALUES ('198', 'archivos/tramites/2022/Agosto/trc4ea74ffca447cdd96c56ca866e7e23c.pdf', 'pdf', '2', '1', '2022-10-11 09:46:26', null, '1', '97');
INSERT INTO `archivos_detalle` VALUES ('199', 'archivos/adjuntos/2022/Agosto/ad501bef7993c35dfd5170046a35443967.pdf', 'pdf', '1', '1', '2022-10-11 09:46:26', null, '1', '98');
INSERT INTO `archivos_detalle` VALUES ('200', 'archivos/tramites/2022/Agosto/tr501bef7993c35dfd5170046a35443967.pdf', 'pdf', '2', '1', '2022-10-11 09:46:26', null, '1', '98');
INSERT INTO `archivos_detalle` VALUES ('201', 'archivos/adjuntos/2022/Agosto/ad90780a86d425ac625c13e0b7c48c2836.pdf', 'pdf', '1', '1', '2022-10-11 09:46:26', null, '1', '99');
INSERT INTO `archivos_detalle` VALUES ('202', 'archivos/tramites/2022/Agosto/tr90780a86d425ac625c13e0b7c48c2836.pdf', 'pdf', '2', '1', '2022-10-11 09:46:26', null, '1', '99');
INSERT INTO `archivos_detalle` VALUES ('203', 'archivos/adjuntos/2022/Agosto/adb28a714311d84ee6f42ecee492a6a351.pdf', 'pdf', '1', '1', '2022-10-11 09:46:26', null, '1', '100');
INSERT INTO `archivos_detalle` VALUES ('204', 'archivos/tramites/2022/Agosto/trb28a714311d84ee6f42ecee492a6a351.pdf', 'pdf', '2', '1', '2022-10-11 09:46:26', null, '1', '100');
INSERT INTO `archivos_detalle` VALUES ('205', 'archivos/adjuntos/2022/Agosto/ad7f737dbe711393c4971f0a0978037a8d.pdf', 'pdf', '1', '1', '2022-10-11 09:46:26', null, '1', '101');
INSERT INTO `archivos_detalle` VALUES ('206', 'archivos/tramites/2022/Agosto/tr7f737dbe711393c4971f0a0978037a8d.pdf', 'pdf', '2', '1', '2022-10-11 09:46:26', null, '1', '101');
INSERT INTO `archivos_detalle` VALUES ('207', 'archivos/adjuntos/2022/Agosto/ad37c7538516621ebaf6cbf017e304412c.pdf', 'pdf', '1', '1', '2022-10-11 09:46:26', null, '1', '102');
INSERT INTO `archivos_detalle` VALUES ('208', 'archivos/tramites/2022/Agosto/tr37c7538516621ebaf6cbf017e304412c.pdf', 'pdf', '2', '1', '2022-10-11 09:46:26', null, '1', '102');
INSERT INTO `archivos_detalle` VALUES ('209', 'archivos/adjuntos/2022/Setiembre/ad1a30bfa339909508d4b46ad1de65cb10.pdf', 'pdf', '1', '1', '2022-10-11 09:49:07', null, '1', '103');
INSERT INTO `archivos_detalle` VALUES ('210', 'archivos/tramites/2022/Setiembre/tr1a30bfa339909508d4b46ad1de65cb10.pdf', 'pdf', '2', '1', '2022-10-11 09:49:07', null, '1', '103');
INSERT INTO `archivos_detalle` VALUES ('211', 'archivos/adjuntos/2022/Setiembre/adf3369dc4471ff32032a8e5345cb84927.pdf', 'pdf', '1', '1', '2022-10-11 09:49:07', null, '1', '104');
INSERT INTO `archivos_detalle` VALUES ('212', 'archivos/tramites/2022/Setiembre/trf3369dc4471ff32032a8e5345cb84927.pdf', 'pdf', '2', '1', '2022-10-11 09:49:07', null, '1', '104');
INSERT INTO `archivos_detalle` VALUES ('213', 'archivos/adjuntos/2022/Setiembre/adf7573246f08512c3eeec9cf0c4347c0b.pdf', 'pdf', '1', '1', '2022-10-11 09:49:07', null, '1', '105');
INSERT INTO `archivos_detalle` VALUES ('214', 'archivos/tramites/2022/Setiembre/trf7573246f08512c3eeec9cf0c4347c0b.pdf', 'pdf', '2', '1', '2022-10-11 09:49:07', null, '1', '105');
INSERT INTO `archivos_detalle` VALUES ('215', 'archivos/adjuntos/2022/Setiembre/ad415242d32199eb935968c77290249268.pdf', 'pdf', '1', '1', '2022-10-11 09:55:34', null, '1', '106');
INSERT INTO `archivos_detalle` VALUES ('216', 'archivos/tramites/2022/Setiembre/tr415242d32199eb935968c77290249268.pdf', 'pdf', '2', '1', '2022-10-11 09:55:34', null, '1', '106');
INSERT INTO `archivos_detalle` VALUES ('217', 'archivos/adjuntos/2022/Setiembre/ad63c00a64d05569a81b9211170e4d83c3.pdf', 'pdf', '1', '1', '2022-10-11 09:55:34', null, '1', '107');
INSERT INTO `archivos_detalle` VALUES ('218', 'archivos/tramites/2022/Setiembre/tr63c00a64d05569a81b9211170e4d83c3.pdf', 'pdf', '2', '1', '2022-10-11 09:55:34', null, '1', '107');
INSERT INTO `archivos_detalle` VALUES ('219', 'archivos/adjuntos/2022/Setiembre/ad179ff5f347e77b48f7c9f0b467bf6676.pdf', 'pdf', '1', '1', '2022-10-11 09:55:34', null, '1', '108');
INSERT INTO `archivos_detalle` VALUES ('220', 'archivos/tramites/2022/Setiembre/tr179ff5f347e77b48f7c9f0b467bf6676.pdf', 'pdf', '2', '1', '2022-10-11 09:55:34', null, '1', '108');
INSERT INTO `archivos_detalle` VALUES ('221', 'archivos/adjuntos/2022/Setiembre/ade7d2031778f70a29e8b8fac27361d90b.pdf', 'pdf', '1', '1', '2022-10-11 09:55:34', null, '1', '109');
INSERT INTO `archivos_detalle` VALUES ('222', 'archivos/tramites/2022/Setiembre/tre7d2031778f70a29e8b8fac27361d90b.pdf', 'pdf', '2', '1', '2022-10-11 09:55:34', null, '1', '109');
INSERT INTO `archivos_detalle` VALUES ('223', 'archivos/adjuntos/2022/Setiembre/adcacc0ebb654288602e12fca65269ec11.pdf', 'pdf', '1', '1', '2022-10-11 09:55:35', null, '1', '110');
INSERT INTO `archivos_detalle` VALUES ('224', 'archivos/tramites/2022/Setiembre/trcacc0ebb654288602e12fca65269ec11.pdf', 'pdf', '2', '1', '2022-10-11 09:55:35', null, '1', '110');
INSERT INTO `archivos_detalle` VALUES ('225', 'archivos/adjuntos/2022/Setiembre/adc806b28aba5ba0e7ae237d73c5afaf49.pdf', 'pdf', '1', '1', '2022-10-11 09:55:35', null, '1', '111');
INSERT INTO `archivos_detalle` VALUES ('226', 'archivos/tramites/2022/Setiembre/trc806b28aba5ba0e7ae237d73c5afaf49.pdf', 'pdf', '2', '1', '2022-10-11 09:55:35', null, '1', '111');
INSERT INTO `archivos_detalle` VALUES ('227', 'archivos/adjuntos/2022/Setiembre/ad2dc974e0d49b4e0db7651c94960ae4b8.pdf', 'pdf', '1', '1', '2022-10-11 09:55:35', null, '1', '112');
INSERT INTO `archivos_detalle` VALUES ('228', 'archivos/tramites/2022/Setiembre/tr2dc974e0d49b4e0db7651c94960ae4b8.pdf', 'pdf', '2', '1', '2022-10-11 09:55:35', null, '1', '112');
INSERT INTO `archivos_detalle` VALUES ('229', 'archivos/adjuntos/2022/Setiembre/adc5a275ae4d2fbee23262d770622bdedc.pdf', 'pdf', '1', '1', '2022-10-11 09:55:35', null, '1', '113');
INSERT INTO `archivos_detalle` VALUES ('230', 'archivos/tramites/2022/Setiembre/trc5a275ae4d2fbee23262d770622bdedc.pdf', 'pdf', '2', '1', '2022-10-11 09:55:35', null, '1', '113');
INSERT INTO `archivos_detalle` VALUES ('231', 'archivos/adjuntos/2022/Setiembre/ad111c99fc22d539e0eccd0049b74ab1f9.pdf', 'pdf', '1', '1', '2022-10-11 09:55:35', null, '1', '114');
INSERT INTO `archivos_detalle` VALUES ('232', 'archivos/tramites/2022/Setiembre/tr111c99fc22d539e0eccd0049b74ab1f9.pdf', 'pdf', '2', '1', '2022-10-11 09:55:35', null, '1', '114');
INSERT INTO `archivos_detalle` VALUES ('233', 'archivos/adjuntos/2022/Setiembre/ad1f7053c151783cdcaf980b5a9323e595.pdf', 'pdf', '1', '1', '2022-10-11 09:55:35', null, '1', '115');
INSERT INTO `archivos_detalle` VALUES ('234', 'archivos/tramites/2022/Setiembre/tr1f7053c151783cdcaf980b5a9323e595.pdf', 'pdf', '2', '1', '2022-10-11 09:55:35', null, '1', '115');
INSERT INTO `archivos_detalle` VALUES ('235', 'archivos/adjuntos/2022/Setiembre/ad7cd481e830d847ce7536e798ba89cb16.pdf', 'pdf', '1', '1', '2022-10-13 15:02:46', null, '1', '116');
INSERT INTO `archivos_detalle` VALUES ('236', 'archivos/tramites/2022/Setiembre/tr7cd481e830d847ce7536e798ba89cb16.pdf', 'pdf', '2', '1', '2022-10-13 15:02:46', null, '1', '116');
INSERT INTO `archivos_detalle` VALUES ('237', 'archivos/adjuntos/2022/Setiembre/ad68bd7460e8d11d4263552191b07eb23b.pdf', 'pdf', '1', '1', '2022-10-13 15:02:46', null, '1', '117');
INSERT INTO `archivos_detalle` VALUES ('238', 'archivos/tramites/2022/Setiembre/tr68bd7460e8d11d4263552191b07eb23b.pdf', 'pdf', '2', '1', '2022-10-13 15:02:46', null, '1', '117');
INSERT INTO `archivos_detalle` VALUES ('239', 'archivos/adjuntos/2022/Setiembre/ad080a7cf40971015e1ff91a8c74ff3d93.pdf', 'pdf', '1', '1', '2022-10-13 15:02:46', null, '1', '118');
INSERT INTO `archivos_detalle` VALUES ('240', 'archivos/tramites/2022/Setiembre/tr080a7cf40971015e1ff91a8c74ff3d93.pdf', 'pdf', '2', '1', '2022-10-13 15:02:46', null, '1', '118');
INSERT INTO `archivos_detalle` VALUES ('241', 'archivos/adjuntos/2022/Setiembre/ad502dfd3bb22ab982d7e38e428757aa44.pdf', 'pdf', '1', '1', '2022-10-13 15:02:47', null, '1', '119');
INSERT INTO `archivos_detalle` VALUES ('242', 'archivos/tramites/2022/Setiembre/tr502dfd3bb22ab982d7e38e428757aa44.pdf', 'pdf', '2', '1', '2022-10-13 15:02:47', null, '1', '119');
INSERT INTO `archivos_detalle` VALUES ('243', 'archivos/adjuntos/2022/Setiembre/adf7a15a40174923490af6e44dae939b3e.pdf', 'pdf', '1', '1', '2022-10-13 15:02:47', null, '1', '120');
INSERT INTO `archivos_detalle` VALUES ('244', 'archivos/tramites/2022/Setiembre/trf7a15a40174923490af6e44dae939b3e.pdf', 'pdf', '2', '1', '2022-10-13 15:02:47', null, '1', '120');
INSERT INTO `archivos_detalle` VALUES ('245', 'archivos/adjuntos/2022/Setiembre/addef9891f5bc6487ca335cd3cff7e1630.pdf', 'pdf', '1', '1', '2022-10-13 15:02:47', null, '1', '121');
INSERT INTO `archivos_detalle` VALUES ('246', 'archivos/tramites/2022/Setiembre/trdef9891f5bc6487ca335cd3cff7e1630.pdf', 'pdf', '2', '1', '2022-10-13 15:02:47', null, '1', '121');
INSERT INTO `archivos_detalle` VALUES ('247', 'archivos/adjuntos/2022/Setiembre/adff081f9ac6a3c7bc6d9089a45215fd48.pdf', 'pdf', '1', '1', '2022-10-13 15:02:47', null, '1', '122');
INSERT INTO `archivos_detalle` VALUES ('248', 'archivos/tramites/2022/Setiembre/trff081f9ac6a3c7bc6d9089a45215fd48.pdf', 'pdf', '2', '1', '2022-10-13 15:02:47', null, '1', '122');
INSERT INTO `archivos_detalle` VALUES ('249', 'archivos/adjuntos/2022/Setiembre/ad42223a8414570f8a66b3edf44d5fcddb.pdf', 'pdf', '1', '1', '2022-10-13 15:02:47', null, '1', '123');
INSERT INTO `archivos_detalle` VALUES ('250', 'archivos/tramites/2022/Setiembre/tr42223a8414570f8a66b3edf44d5fcddb.pdf', 'pdf', '2', '1', '2022-10-13 15:02:47', null, '1', '123');
INSERT INTO `archivos_detalle` VALUES ('251', 'archivos/adjuntos/2022/Setiembre/ad8067514e961e33253afd124524401232.pdf', 'pdf', '1', '1', '2022-10-13 15:02:47', null, '1', '124');
INSERT INTO `archivos_detalle` VALUES ('252', 'archivos/tramites/2022/Setiembre/tr8067514e961e33253afd124524401232.pdf', 'pdf', '2', '1', '2022-10-13 15:02:47', null, '1', '124');
INSERT INTO `archivos_detalle` VALUES ('253', 'archivos/adjuntos/2022/Julio/ad1e63f39d56f4c0552fe67b63004be135.pdf', 'pdf', '1', '1', '2022-10-13 15:15:22', null, '1', '125');
INSERT INTO `archivos_detalle` VALUES ('254', 'archivos/tramites/2022/Julio/tr1e63f39d56f4c0552fe67b63004be135.pdf', 'pdf', '2', '1', '2022-10-13 15:15:22', null, '1', '125');
INSERT INTO `archivos_detalle` VALUES ('255', 'archivos/adjuntos/2022/Julio/ade216b58cdf5f4854f0d60969c2bd628b.pdf', 'pdf', '1', '1', '2022-10-13 15:15:22', null, '1', '126');
INSERT INTO `archivos_detalle` VALUES ('256', 'archivos/tramites/2022/Julio/tre216b58cdf5f4854f0d60969c2bd628b.pdf', 'pdf', '2', '1', '2022-10-13 15:15:22', null, '1', '126');
INSERT INTO `archivos_detalle` VALUES ('257', 'archivos/adjuntos/2022/Julio/adb2a75af30accc2f6da5395ffee5f66f2.pdf', 'pdf', '1', '1', '2022-10-13 15:15:22', null, '1', '127');
INSERT INTO `archivos_detalle` VALUES ('258', 'archivos/tramites/2022/Julio/trb2a75af30accc2f6da5395ffee5f66f2.pdf', 'pdf', '2', '1', '2022-10-13 15:15:22', null, '1', '127');
INSERT INTO `archivos_detalle` VALUES ('259', 'archivos/adjuntos/2022/Julio/ad658224206b9d3e93b94ecec85be7b90c.pdf', 'pdf', '1', '1', '2022-10-13 15:15:22', null, '1', '128');
INSERT INTO `archivos_detalle` VALUES ('260', 'archivos/subsanacion/2022/Julio/sub153339658224206b9d3e93b94ecec85be7b90c.pdf', 'pdf', '1', '1', '2022-10-13 15:15:22', null, '1', '128');
INSERT INTO `archivos_detalle` VALUES ('261', 'archivos/tramites/2022/Julio/tr658224206b9d3e93b94ecec85be7b90c.pdf', 'pdf', '2', '1', '2022-10-13 15:15:22', null, '1', '128');
INSERT INTO `archivos_detalle` VALUES ('262', 'archivos/adjuntos/2022/Julio/adaf59e3dc5d6a18fea754d8c121f133ad.pdf', 'pdf', '1', '1', '2022-10-13 15:15:22', null, '1', '129');
INSERT INTO `archivos_detalle` VALUES ('263', 'archivos/tramites/2022/Julio/traf59e3dc5d6a18fea754d8c121f133ad.pdf', 'pdf', '2', '1', '2022-10-13 15:15:22', null, '1', '129');
INSERT INTO `archivos_detalle` VALUES ('264', 'archivos/adjuntos/2022/Julio/adcbebc280b44fb364fd32fcda03c02590.pdf', 'pdf', '1', '1', '2022-10-13 15:15:23', null, '1', '130');
INSERT INTO `archivos_detalle` VALUES ('265', 'archivos/tramites/2022/Julio/trcbebc280b44fb364fd32fcda03c02590.pdf', 'pdf', '2', '1', '2022-10-13 15:15:23', null, '1', '130');
INSERT INTO `archivos_detalle` VALUES ('266', 'archivos/adjuntos/2022/Julio/ad6c445212851f2e46d5c6cd46a3b74dfb.pdf', 'pdf', '1', '1', '2022-10-13 15:15:23', null, '1', '131');
INSERT INTO `archivos_detalle` VALUES ('267', 'archivos/tramites/2022/Julio/tr6c445212851f2e46d5c6cd46a3b74dfb.pdf', 'pdf', '2', '1', '2022-10-13 15:15:23', null, '1', '131');
INSERT INTO `archivos_detalle` VALUES ('268', 'archivos/adjuntos/2022/Julio/addac63647f84e0986c6fca99d38711b70.pdf', 'pdf', '1', '1', '2022-10-13 15:15:23', null, '1', '132');
INSERT INTO `archivos_detalle` VALUES ('269', 'archivos/tramites/2022/Julio/trdac63647f84e0986c6fca99d38711b70.pdf', 'pdf', '2', '1', '2022-10-13 15:15:23', null, '1', '132');
INSERT INTO `archivos_detalle` VALUES ('270', 'archivos/adjuntos/2022/Julio/ad4041b543d898bb178869cee5c4be4c2a.pdf', 'pdf', '1', '1', '2022-10-13 15:15:23', null, '1', '133');
INSERT INTO `archivos_detalle` VALUES ('271', 'archivos/tramites/2022/Julio/tr4041b543d898bb178869cee5c4be4c2a.pdf', 'pdf', '2', '1', '2022-10-13 15:15:23', null, '1', '133');
INSERT INTO `archivos_detalle` VALUES ('272', 'archivos/adjuntos/2022/Julio/ad2f19e764d98f43444d174fd558cfce68.pdf', 'pdf', '1', '1', '2022-10-13 15:15:23', null, '1', '134');
INSERT INTO `archivos_detalle` VALUES ('273', 'archivos/tramites/2022/Julio/tr2f19e764d98f43444d174fd558cfce68.pdf', 'pdf', '2', '1', '2022-10-13 15:15:23', null, '1', '134');
INSERT INTO `archivos_detalle` VALUES ('274', 'archivos/adjuntos/2022/Julio/add8524aee090ab697af4ef0db189008fe.pdf', 'pdf', '1', '1', '2022-10-13 15:15:23', null, '1', '135');
INSERT INTO `archivos_detalle` VALUES ('275', 'archivos/tramites/2022/Julio/trd8524aee090ab697af4ef0db189008fe.pdf', 'pdf', '2', '1', '2022-10-13 15:15:23', null, '1', '135');
INSERT INTO `archivos_detalle` VALUES ('276', 'archivos/adjuntos/2022/Setiembre/ad8044e0cfe8ca0a167d7f2e784bd3d7d3.pdf', 'pdf', '1', '1', '2022-11-21 20:14:10', null, '1', '136');
INSERT INTO `archivos_detalle` VALUES ('277', 'archivos/tramites/2022/Setiembre/tr8044e0cfe8ca0a167d7f2e784bd3d7d3.pdf', 'pdf', '2', '1', '2022-11-21 20:14:10', null, '1', '136');
INSERT INTO `archivos_detalle` VALUES ('278', 'archivos/adjuntos/2022/Setiembre/ad7cd481e830d847ce7536e798ba89cb16.pdf', 'pdf', '1', '1', '2022-11-21 20:14:11', null, '1', '137');
INSERT INTO `archivos_detalle` VALUES ('279', 'archivos/tramites/2022/Setiembre/tr7cd481e830d847ce7536e798ba89cb16.pdf', 'pdf', '2', '1', '2022-11-21 20:14:11', null, '1', '137');

-- ----------------------------
-- Table structure for asignacion_expediente_pun
-- ----------------------------
DROP TABLE IF EXISTS `asignacion_expediente_pun`;
CREATE TABLE `asignacion_expediente_pun` (
  `aep_id` int(11) NOT NULL AUTO_INCREMENT,
  `expedientes_exp_id` int(11) NOT NULL,
  `cuadro_pun_exp_cpe_id` int(11) NOT NULL,
  `aep_tipoAsignacion` int(1) DEFAULT NULL COMMENT '1: asignacion automatica\n2: asignacion manual',
  `aep_fechaCreacion` datetime DEFAULT NULL,
  `aep_fechaModificacion` datetime DEFAULT NULL,
  `aep_estado` int(1) DEFAULT NULL,
  PRIMARY KEY (`aep_id`),
  KEY `fk_asignacion_expediente_pun_expedientes1_idx` (`expedientes_exp_id`),
  KEY `fk_asignacion_expediente_pun_cuadro_pun_exp1_idx` (`cuadro_pun_exp_cpe_id`),
  CONSTRAINT `fk_asignacion_expediente_pun_cuadro_pun_exp1` FOREIGN KEY (`cuadro_pun_exp_cpe_id`) REFERENCES `cuadro_pun_exp` (`cpe_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_asignacion_expediente_pun_expedientes1` FOREIGN KEY (`expedientes_exp_id`) REFERENCES `expedientes` (`exp_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=122 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of asignacion_expediente_pun
-- ----------------------------
INSERT INTO `asignacion_expediente_pun` VALUES ('1', '15', '63', '1', '2022-10-05 11:23:43', null, '1');
INSERT INTO `asignacion_expediente_pun` VALUES ('2', '16', '58', '1', '2022-10-05 11:23:44', null, '1');
INSERT INTO `asignacion_expediente_pun` VALUES ('3', '17', '61', '1', '2022-10-05 11:23:44', null, '1');
INSERT INTO `asignacion_expediente_pun` VALUES ('4', '18', '59', '1', '2022-10-05 11:23:44', null, '1');
INSERT INTO `asignacion_expediente_pun` VALUES ('5', '19', '64', '1', '2022-10-05 11:23:44', null, '1');
INSERT INTO `asignacion_expediente_pun` VALUES ('6', '20', '55', '1', '2022-10-05 11:23:44', '2022-10-05 11:24:38', '0');
INSERT INTO `asignacion_expediente_pun` VALUES ('7', '21', '62', '1', '2022-10-05 11:23:44', null, '1');
INSERT INTO `asignacion_expediente_pun` VALUES ('8', '22', '56', '1', '2022-10-05 11:23:45', null, '1');
INSERT INTO `asignacion_expediente_pun` VALUES ('9', '23', '65', '1', '2022-10-05 11:23:45', null, '1');
INSERT INTO `asignacion_expediente_pun` VALUES ('10', '24', '66', '1', '2022-10-05 11:23:45', '2022-10-05 11:24:38', '0');
INSERT INTO `asignacion_expediente_pun` VALUES ('11', '25', '62', '1', '2022-10-05 11:23:45', null, '1');
INSERT INTO `asignacion_expediente_pun` VALUES ('12', '26', '53', '1', '2022-10-05 11:23:45', null, '1');
INSERT INTO `asignacion_expediente_pun` VALUES ('13', '27', '67', '1', '2022-10-05 11:23:45', null, '1');
INSERT INTO `asignacion_expediente_pun` VALUES ('14', '28', '60', '1', '2022-10-05 11:23:46', null, '1');
INSERT INTO `asignacion_expediente_pun` VALUES ('15', '29', '54', '1', '2022-10-05 11:23:46', null, '1');
INSERT INTO `asignacion_expediente_pun` VALUES ('16', '30', '57', '1', '2022-10-05 11:23:46', null, '1');
INSERT INTO `asignacion_expediente_pun` VALUES ('17', '31', '68', '1', '2022-10-05 11:57:52', null, '1');
INSERT INTO `asignacion_expediente_pun` VALUES ('18', '32', '69', '1', '2022-10-05 11:57:52', null, '1');
INSERT INTO `asignacion_expediente_pun` VALUES ('19', '33', '104', '1', '2022-10-05 11:57:52', null, '1');
INSERT INTO `asignacion_expediente_pun` VALUES ('20', '34', '103', '1', '2022-10-05 11:57:52', null, '1');
INSERT INTO `asignacion_expediente_pun` VALUES ('21', '35', '101', '1', '2022-10-05 11:57:52', null, '1');
INSERT INTO `asignacion_expediente_pun` VALUES ('22', '36', '70', '1', '2022-10-05 11:57:53', null, '1');
INSERT INTO `asignacion_expediente_pun` VALUES ('23', '37', '68', '1', '2022-10-05 11:57:53', null, '1');
INSERT INTO `asignacion_expediente_pun` VALUES ('24', '38', '100', '1', '2022-10-05 11:57:53', null, '1');
INSERT INTO `asignacion_expediente_pun` VALUES ('25', '39', '69', '1', '2022-10-05 11:57:53', null, '1');
INSERT INTO `asignacion_expediente_pun` VALUES ('26', '40', '69', '1', '2022-10-05 11:57:53', null, '1');
INSERT INTO `asignacion_expediente_pun` VALUES ('27', '41', '102', '1', '2022-10-05 11:57:53', null, '1');
INSERT INTO `asignacion_expediente_pun` VALUES ('28', '42', '68', '1', '2022-10-05 11:57:54', null, '1');
INSERT INTO `asignacion_expediente_pun` VALUES ('29', '45', '105', '1', '2022-10-05 23:36:26', null, '1');
INSERT INTO `asignacion_expediente_pun` VALUES ('30', '46', '105', '1', '2022-10-05 23:37:54', null, '1');
INSERT INTO `asignacion_expediente_pun` VALUES ('31', '47', '106', '1', '2022-10-05 23:38:57', null, '1');
INSERT INTO `asignacion_expediente_pun` VALUES ('32', '48', '107', '1', '2022-10-05 23:38:57', null, '1');
INSERT INTO `asignacion_expediente_pun` VALUES ('33', '49', '108', '1', '2022-10-05 23:38:57', null, '1');
INSERT INTO `asignacion_expediente_pun` VALUES ('34', '50', '109', '1', '2022-10-05 23:38:57', '2022-10-06 00:10:08', '0');
INSERT INTO `asignacion_expediente_pun` VALUES ('35', '51', '110', '1', '2022-10-05 23:38:57', '2022-10-06 00:10:39', '0');
INSERT INTO `asignacion_expediente_pun` VALUES ('36', '52', '107', '1', '2022-10-05 23:38:58', null, '1');
INSERT INTO `asignacion_expediente_pun` VALUES ('37', '53', '111', '1', '2022-10-05 23:38:58', null, '1');
INSERT INTO `asignacion_expediente_pun` VALUES ('38', '54', '112', '1', '2022-10-05 23:38:58', null, '1');
INSERT INTO `asignacion_expediente_pun` VALUES ('39', '55', '113', '1', '2022-10-05 23:38:58', null, '1');
INSERT INTO `asignacion_expediente_pun` VALUES ('40', '56', '114', '1', '2022-10-05 23:41:26', null, '1');
INSERT INTO `asignacion_expediente_pun` VALUES ('41', '57', '115', '1', '2022-10-05 23:41:26', null, '1');
INSERT INTO `asignacion_expediente_pun` VALUES ('42', '58', '116', '1', '2022-10-05 23:41:26', null, '1');
INSERT INTO `asignacion_expediente_pun` VALUES ('43', '59', '117', '1', '2022-10-05 23:41:27', null, '1');
INSERT INTO `asignacion_expediente_pun` VALUES ('44', '60', '115', '1', '2022-10-05 23:41:27', null, '1');
INSERT INTO `asignacion_expediente_pun` VALUES ('45', '61', '118', '1', '2022-10-05 23:41:27', null, '1');
INSERT INTO `asignacion_expediente_pun` VALUES ('46', '62', '119', '1', '2022-10-05 23:41:27', null, '1');
INSERT INTO `asignacion_expediente_pun` VALUES ('47', '63', '120', '1', '2022-10-05 23:41:27', null, '1');
INSERT INTO `asignacion_expediente_pun` VALUES ('48', '64', '121', '1', '2022-10-05 23:41:27', null, '1');
INSERT INTO `asignacion_expediente_pun` VALUES ('49', '65', '122', '1', '2022-10-05 23:41:28', null, '1');
INSERT INTO `asignacion_expediente_pun` VALUES ('50', '66', '123', '1', '2022-10-05 23:54:01', null, '1');
INSERT INTO `asignacion_expediente_pun` VALUES ('51', '67', '119', '1', '2022-10-05 23:54:01', null, '1');
INSERT INTO `asignacion_expediente_pun` VALUES ('52', '68', '124', '1', '2022-10-05 23:54:01', null, '1');
INSERT INTO `asignacion_expediente_pun` VALUES ('53', '69', '79', '1', '2022-10-11 09:46:21', null, '1');
INSERT INTO `asignacion_expediente_pun` VALUES ('54', '70', '79', '1', '2022-10-11 09:46:22', null, '1');
INSERT INTO `asignacion_expediente_pun` VALUES ('55', '71', '85', '1', '2022-10-11 09:46:22', null, '1');
INSERT INTO `asignacion_expediente_pun` VALUES ('56', '72', '86', '1', '2022-10-11 09:46:22', null, '1');
INSERT INTO `asignacion_expediente_pun` VALUES ('57', '73', '73', '1', '2022-10-11 09:46:22', null, '1');
INSERT INTO `asignacion_expediente_pun` VALUES ('58', '74', '76', '1', '2022-10-11 09:46:22', '2022-10-11 09:48:23', '0');
INSERT INTO `asignacion_expediente_pun` VALUES ('59', '75', '77', '1', '2022-10-11 09:46:22', null, '1');
INSERT INTO `asignacion_expediente_pun` VALUES ('60', '76', '82', '1', '2022-10-11 09:46:22', null, '1');
INSERT INTO `asignacion_expediente_pun` VALUES ('61', '77', '75', '1', '2022-10-11 09:46:23', '2022-10-11 09:48:23', '0');
INSERT INTO `asignacion_expediente_pun` VALUES ('62', '78', '87', '1', '2022-10-11 09:46:23', null, '1');
INSERT INTO `asignacion_expediente_pun` VALUES ('63', '79', '84', '1', '2022-10-11 09:46:23', null, '1');
INSERT INTO `asignacion_expediente_pun` VALUES ('64', '80', '71', '1', '2022-10-11 09:46:23', '2022-10-11 09:48:17', '0');
INSERT INTO `asignacion_expediente_pun` VALUES ('65', '81', '85', '1', '2022-10-11 09:46:23', null, '1');
INSERT INTO `asignacion_expediente_pun` VALUES ('66', '82', '72', '1', '2022-10-11 09:46:23', null, '1');
INSERT INTO `asignacion_expediente_pun` VALUES ('67', '83', '77', '1', '2022-10-11 09:46:24', null, '1');
INSERT INTO `asignacion_expediente_pun` VALUES ('68', '84', '77', '1', '2022-10-11 09:46:24', null, '1');
INSERT INTO `asignacion_expediente_pun` VALUES ('69', '85', '82', '1', '2022-10-11 09:46:24', null, '1');
INSERT INTO `asignacion_expediente_pun` VALUES ('70', '86', '80', '1', '2022-10-11 09:46:24', null, '1');
INSERT INTO `asignacion_expediente_pun` VALUES ('71', '87', '88', '1', '2022-10-11 09:46:24', null, '1');
INSERT INTO `asignacion_expediente_pun` VALUES ('72', '88', '83', '1', '2022-10-11 09:46:24', null, '1');
INSERT INTO `asignacion_expediente_pun` VALUES ('73', '89', '81', '1', '2022-10-11 09:46:24', null, '1');
INSERT INTO `asignacion_expediente_pun` VALUES ('74', '90', '77', '1', '2022-10-11 09:46:25', null, '1');
INSERT INTO `asignacion_expediente_pun` VALUES ('75', '91', '85', '1', '2022-10-11 09:46:25', null, '1');
INSERT INTO `asignacion_expediente_pun` VALUES ('76', '92', '72', '1', '2022-10-11 09:46:25', null, '1');
INSERT INTO `asignacion_expediente_pun` VALUES ('77', '93', '72', '1', '2022-10-11 09:46:25', null, '1');
INSERT INTO `asignacion_expediente_pun` VALUES ('78', '94', '74', '1', '2022-10-11 09:46:25', null, '1');
INSERT INTO `asignacion_expediente_pun` VALUES ('79', '95', '74', '1', '2022-10-11 09:46:25', null, '1');
INSERT INTO `asignacion_expediente_pun` VALUES ('80', '96', '78', '1', '2022-10-11 09:46:26', null, '1');
INSERT INTO `asignacion_expediente_pun` VALUES ('81', '97', '73', '1', '2022-10-11 09:46:26', null, '1');
INSERT INTO `asignacion_expediente_pun` VALUES ('82', '98', '85', '1', '2022-10-11 09:46:26', null, '1');
INSERT INTO `asignacion_expediente_pun` VALUES ('83', '99', '82', '1', '2022-10-11 09:46:26', null, '1');
INSERT INTO `asignacion_expediente_pun` VALUES ('84', '100', '85', '1', '2022-10-11 09:46:26', null, '1');
INSERT INTO `asignacion_expediente_pun` VALUES ('85', '101', '82', '1', '2022-10-11 09:46:26', null, '1');
INSERT INTO `asignacion_expediente_pun` VALUES ('86', '102', '78', '1', '2022-10-11 09:46:26', null, '1');
INSERT INTO `asignacion_expediente_pun` VALUES ('87', '103', '76', '1', '2022-10-11 09:49:07', null, '1');
INSERT INTO `asignacion_expediente_pun` VALUES ('88', '104', '75', '1', '2022-10-11 09:49:07', null, '1');
INSERT INTO `asignacion_expediente_pun` VALUES ('89', '105', '71', '1', '2022-10-11 09:49:07', '2022-10-11 09:49:41', '0');
INSERT INTO `asignacion_expediente_pun` VALUES ('90', '106', '125', '1', '2022-10-11 09:55:34', null, '1');
INSERT INTO `asignacion_expediente_pun` VALUES ('91', '107', '126', '1', '2022-10-11 09:55:34', null, '1');
INSERT INTO `asignacion_expediente_pun` VALUES ('92', '108', '127', '1', '2022-10-11 09:55:34', null, '1');
INSERT INTO `asignacion_expediente_pun` VALUES ('93', '109', '126', '1', '2022-10-11 09:55:34', null, '1');
INSERT INTO `asignacion_expediente_pun` VALUES ('94', '110', '128', '1', '2022-10-11 09:55:35', null, '1');
INSERT INTO `asignacion_expediente_pun` VALUES ('95', '111', '129', '1', '2022-10-11 09:55:35', null, '1');
INSERT INTO `asignacion_expediente_pun` VALUES ('96', '112', '129', '1', '2022-10-11 09:55:35', null, '1');
INSERT INTO `asignacion_expediente_pun` VALUES ('97', '113', '130', '1', '2022-10-11 09:55:35', null, '1');
INSERT INTO `asignacion_expediente_pun` VALUES ('98', '114', '131', '1', '2022-10-11 09:55:35', null, '1');
INSERT INTO `asignacion_expediente_pun` VALUES ('99', '115', '132', '1', '2022-10-11 09:55:35', null, '1');
INSERT INTO `asignacion_expediente_pun` VALUES ('100', '116', '98', '1', '2022-10-13 15:02:46', '2022-10-13 15:04:24', '0');
INSERT INTO `asignacion_expediente_pun` VALUES ('101', '117', '94', '1', '2022-10-13 15:02:46', null, '1');
INSERT INTO `asignacion_expediente_pun` VALUES ('102', '118', '94', '1', '2022-10-13 15:02:46', null, '1');
INSERT INTO `asignacion_expediente_pun` VALUES ('103', '119', '93', '1', '2022-10-13 15:02:47', null, '1');
INSERT INTO `asignacion_expediente_pun` VALUES ('104', '120', '96', '1', '2022-10-13 15:02:47', null, '1');
INSERT INTO `asignacion_expediente_pun` VALUES ('105', '121', '96', '1', '2022-10-13 15:02:47', null, '1');
INSERT INTO `asignacion_expediente_pun` VALUES ('106', '122', '92', '1', '2022-10-13 15:02:47', null, '1');
INSERT INTO `asignacion_expediente_pun` VALUES ('107', '123', '91', '1', '2022-10-13 15:02:47', null, '1');
INSERT INTO `asignacion_expediente_pun` VALUES ('108', '124', '90', '1', '2022-10-13 15:02:47', null, '1');
INSERT INTO `asignacion_expediente_pun` VALUES ('109', '125', '133', '1', '2022-10-13 15:15:22', null, '1');
INSERT INTO `asignacion_expediente_pun` VALUES ('110', '126', '134', '1', '2022-10-13 15:15:22', null, '1');
INSERT INTO `asignacion_expediente_pun` VALUES ('111', '127', '135', '1', '2022-10-13 15:15:22', null, '1');
INSERT INTO `asignacion_expediente_pun` VALUES ('112', '128', '135', '1', '2022-10-13 15:15:22', null, '1');
INSERT INTO `asignacion_expediente_pun` VALUES ('113', '129', '136', '1', '2022-10-13 15:15:22', null, '1');
INSERT INTO `asignacion_expediente_pun` VALUES ('114', '130', '137', '1', '2022-10-13 15:15:23', null, '1');
INSERT INTO `asignacion_expediente_pun` VALUES ('115', '131', '135', '1', '2022-10-13 15:15:23', null, '1');
INSERT INTO `asignacion_expediente_pun` VALUES ('116', '132', '137', '1', '2022-10-13 15:15:23', null, '1');
INSERT INTO `asignacion_expediente_pun` VALUES ('117', '133', '138', '1', '2022-10-13 15:15:23', null, '1');
INSERT INTO `asignacion_expediente_pun` VALUES ('118', '134', '139', '1', '2022-10-13 15:15:23', null, '1');
INSERT INTO `asignacion_expediente_pun` VALUES ('119', '135', '140', '1', '2022-10-13 15:15:23', null, '1');
INSERT INTO `asignacion_expediente_pun` VALUES ('120', '136', '99', '1', '2022-11-21 20:14:10', null, '1');
INSERT INTO `asignacion_expediente_pun` VALUES ('121', '137', '98', '1', '2022-11-21 20:14:11', null, '1');

-- ----------------------------
-- Table structure for aux_adjudicacion
-- ----------------------------
DROP TABLE IF EXISTS `aux_adjudicacion`;
CREATE TABLE `aux_adjudicacion` (
  `adjudicacionID` int(11) NOT NULL,
  `plazaID` bigint(20) DEFAULT NULL,
  `docenteID` int(11) DEFAULT NULL,
  `fechaAsignacion` datetime DEFAULT NULL,
  `expediente` varchar(30) DEFAULT NULL,
  `numExpediente` varchar(10) DEFAULT NULL,
  `claveExpediente` varchar(5) DEFAULT NULL,
  `fechaInicio` date DEFAULT NULL,
  `fechaTermino` date DEFAULT NULL,
  `puntaje` varchar(6) DEFAULT NULL,
  `firma_1` tinyint(4) DEFAULT NULL,
  `firma_2` tinyint(4) DEFAULT NULL,
  `firma_3` tinyint(4) DEFAULT NULL,
  `firma_4` tinyint(4) DEFAULT NULL,
  `firma_5` tinyint(4) DEFAULT NULL,
  `registradoPor` varchar(20) DEFAULT NULL,
  `fecha` year(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of aux_adjudicacion
-- ----------------------------

-- ----------------------------
-- Table structure for convocatorias
-- ----------------------------
DROP TABLE IF EXISTS `convocatorias`;
CREATE TABLE `convocatorias` (
  `con_id` int(11) NOT NULL AUTO_INCREMENT,
  `con_numero` varchar(25) DEFAULT NULL,
  `con_anio` varchar(4) DEFAULT NULL,
  `con_fechainicio` date DEFAULT NULL,
  `con_fechafin` date DEFAULT NULL,
  `con_estado` int(1) DEFAULT NULL,
  `con_tipo` int(4) DEFAULT NULL,
  `con_horainicio` time DEFAULT NULL,
  `con_horafin` time DEFAULT NULL,
  PRIMARY KEY (`con_id`),
  KEY `fk_con_tipo` (`con_tipo`),
  CONSTRAINT `fk_con_tipo` FOREIGN KEY (`con_tipo`) REFERENCES `tipo_convocatoria` (`tipo_id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of convocatorias
-- ----------------------------
INSERT INTO `convocatorias` VALUES ('1', '1', '2022', '2022-09-22', '2022-09-29', '0', '1', null, null);
INSERT INTO `convocatorias` VALUES ('2', '2', '2022', '2022-10-01', '2022-10-07', '0', '1', null, null);
INSERT INTO `convocatorias` VALUES ('3', '3', '2022', '2022-09-26', '2022-09-29', '0', '1', null, null);
INSERT INTO `convocatorias` VALUES ('4', '4', '2022', '2022-09-28', '2022-09-29', '0', '1', null, null);
INSERT INTO `convocatorias` VALUES ('5', '5', '2022', '2022-10-11', '2022-10-18', '0', '1', null, null);
INSERT INTO `convocatorias` VALUES ('6', '6', '2022', '2023-09-01', '2023-09-01', '0', '1', null, null);
INSERT INTO `convocatorias` VALUES ('7', '7', '2022', '2023-10-10', '2023-10-10', '0', '1', null, null);
INSERT INTO `convocatorias` VALUES ('8', '8', '2022', '0000-00-00', '0000-00-00', '0', '1', null, null);
INSERT INTO `convocatorias` VALUES ('9', '9', '2022', '2023-11-21', '2023-11-21', '0', '1', null, null);
INSERT INTO `convocatorias` VALUES ('10', '10', '2022', '2023-11-22', '2023-11-30', '1', '1', '17:00:00', '21:15:00');
INSERT INTO `convocatorias` VALUES ('11', '10', '2022', '2023-11-14', '2023-11-23', '1', '1', '15:25:00', '13:10:00');
INSERT INTO `convocatorias` VALUES ('12', '10', '2022', '2023-11-15', '2023-11-08', '1', '1', '12:00:00', '12:00:00');
INSERT INTO `convocatorias` VALUES ('13', '10', '2022', '2023-11-09', '2023-09-27', '1', '1', '12:00:00', '12:00:00');
INSERT INTO `convocatorias` VALUES ('14', '10', '2022', '2023-11-16', '2023-11-01', '1', '1', '12:00:00', '12:00:00');
INSERT INTO `convocatorias` VALUES ('15', '10', '2022', '2023-11-20', '2023-11-23', '1', '1', '12:00:00', '12:00:00');

-- ----------------------------
-- Table structure for convocatorias_detalle
-- ----------------------------
DROP TABLE IF EXISTS `convocatorias_detalle`;
CREATE TABLE `convocatorias_detalle` (
  `cde_id` int(11) NOT NULL AUTO_INCREMENT,
  `convocatorias_con_id` int(11) NOT NULL,
  `grupo_inscripcion_gin_id` int(11) NOT NULL,
  `cde_estado` int(1) DEFAULT NULL,
  PRIMARY KEY (`cde_id`),
  KEY `fk_convocatorias_detalle_convocatorias1_idx` (`convocatorias_con_id`),
  KEY `fk_convocatorias_detalle_grupo_inscripcion1_idx` (`grupo_inscripcion_gin_id`),
  CONSTRAINT `fk_convocatorias_detalle_convocatorias1` FOREIGN KEY (`convocatorias_con_id`) REFERENCES `convocatorias` (`con_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_convocatorias_detalle_grupo_inscripcion1` FOREIGN KEY (`grupo_inscripcion_gin_id`) REFERENCES `grupo_inscripcion` (`gin_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of convocatorias_detalle
-- ----------------------------
INSERT INTO `convocatorias_detalle` VALUES ('1', '1', '1', '1');
INSERT INTO `convocatorias_detalle` VALUES ('2', '1', '4', '1');
INSERT INTO `convocatorias_detalle` VALUES ('3', '1', '6', '1');
INSERT INTO `convocatorias_detalle` VALUES ('4', '1', '7', '1');
INSERT INTO `convocatorias_detalle` VALUES ('5', '2', '1', '1');
INSERT INTO `convocatorias_detalle` VALUES ('6', '2', '3', '1');
INSERT INTO `convocatorias_detalle` VALUES ('7', '3', '14', '1');
INSERT INTO `convocatorias_detalle` VALUES ('8', '3', '13', '1');
INSERT INTO `convocatorias_detalle` VALUES ('9', '4', '8', '1');
INSERT INTO `convocatorias_detalle` VALUES ('10', '4', '10', '1');
INSERT INTO `convocatorias_detalle` VALUES ('11', '1', '15', '1');
INSERT INTO `convocatorias_detalle` VALUES ('12', '5', '1', '1');
INSERT INTO `convocatorias_detalle` VALUES ('13', '5', '3', '1');
INSERT INTO `convocatorias_detalle` VALUES ('14', '5', '8', '1');
INSERT INTO `convocatorias_detalle` VALUES ('15', '6', '1', '1');
INSERT INTO `convocatorias_detalle` VALUES ('16', '6', '2', '1');
INSERT INTO `convocatorias_detalle` VALUES ('17', '6', '12', '1');
INSERT INTO `convocatorias_detalle` VALUES ('18', '7', '1', '1');
INSERT INTO `convocatorias_detalle` VALUES ('19', '7', '5', '1');
INSERT INTO `convocatorias_detalle` VALUES ('20', '8', '2', '1');
INSERT INTO `convocatorias_detalle` VALUES ('21', '9', '1', '1');
INSERT INTO `convocatorias_detalle` VALUES ('22', '10', '2', '1');
INSERT INTO `convocatorias_detalle` VALUES ('23', '11', '2', '1');
INSERT INTO `convocatorias_detalle` VALUES ('24', '12', '2', '1');
INSERT INTO `convocatorias_detalle` VALUES ('25', '13', '3', '1');
INSERT INTO `convocatorias_detalle` VALUES ('26', '14', '2', '1');
INSERT INTO `convocatorias_detalle` VALUES ('27', '15', '1', '1');

-- ----------------------------
-- Table structure for criterios_ficha
-- ----------------------------
DROP TABLE IF EXISTS `criterios_ficha`;
CREATE TABLE `criterios_ficha` (
  `cfi_id` int(11) NOT NULL,
  `cfi_descripcion` longtext,
  `cfi_tipoColumna` varchar(45) DEFAULT NULL,
  `cfi_padre` int(11) DEFAULT NULL,
  `cfi_maxPuntaje` double DEFAULT NULL,
  `cfi_rangoInicio` int(11) DEFAULT NULL,
  `cfi_rangoFin` int(11) DEFAULT NULL,
  `cfi_tipoInput` varchar(45) DEFAULT NULL,
  `cfi_etiquetaInput` varchar(45) DEFAULT NULL,
  `cfi_limite` double DEFAULT NULL,
  `cfi_multiplicador` double DEFAULT NULL,
  `cfi_estado` varchar(45) DEFAULT NULL,
  `ficha_fic_id` int(11) NOT NULL,
  PRIMARY KEY (`cfi_id`),
  KEY `fk_criterios_ficha_ficha1_idx` (`ficha_fic_id`),
  CONSTRAINT `fk_criterios_ficha_ficha1` FOREIGN KEY (`ficha_fic_id`) REFERENCES `ficha` (`fic_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of criterios_ficha
-- ----------------------------
INSERT INTO `criterios_ficha` VALUES ('1', 'Formación Académica y Profesional', 'RUBRO', '0', '45', '1', '14', '', '', null, '0', '1', '1');
INSERT INTO `criterios_ficha` VALUES ('2', 'Estudios de pregrado', 'CRITERIO', '1', '0', '0', '0', '', '', null, '0', '1', '1');
INSERT INTO `criterios_ficha` VALUES ('3', 'Otro Título Profesional Pedagógico o Título de Segunda Especialidad en Educación, no afín al nivel o ciclo de la especialidad que postula', 'SUBCRITERIO', '2', '5', '3', '3', 'checkbox', '', null, '5', '1', '1');
INSERT INTO `criterios_ficha` VALUES ('4', 'Título Profesional Universitario no Pedagógico, afín al nivel o ciclo de la especialidad que postula', 'SUBCRITERIO', '2', '5', '4', '4', 'checkbox', '', null, '5', '1', '1');
INSERT INTO `criterios_ficha` VALUES ('5', 'Título Profesional Técnico', 'SUBCRITERIO', '2', '4', '5', '5', 'checkbox', '', null, '4', '1', '1');
INSERT INTO `criterios_ficha` VALUES ('6', 'Estudios de pregrado en educación financiados a través de PRONABEC', 'SUBCRITERIO', '2', '3', '6', '6', 'checkbox', '', null, '3', '1', '1');
INSERT INTO `criterios_ficha` VALUES ('7', 'Constancia de quinto superior de su promoción en sus estudios pedagógicos.', 'SUBCRITERIO', '2', '3', '7', '7', 'checkbox', '', null, '3', '1', '1');
INSERT INTO `criterios_ficha` VALUES ('8', 'Constancia de tercio superior de su promoción en sus estudios pedagógicos.', 'SUBCRITERIO', '2', '2', '8', '8', 'checkbox', '', null, '2', '1', '1');
INSERT INTO `criterios_ficha` VALUES ('9', 'Estudios de posgrado', 'CRITERIO', '1', '0', '0', '0', '', '', null, '0', '1', '1');
INSERT INTO `criterios_ficha` VALUES ('10', 'Grado de Doctor registrado en SUNEDU', 'SUBCRITERIO', '9', '10', '10', '10', 'checkbox', '', null, '10', '1', '1');
INSERT INTO `criterios_ficha` VALUES ('11', 'Estudios concluidos de Doctorado', 'SUBCRITERIO', '9', '6', '11', '11', 'checkbox', '', null, '6', '1', '1');
INSERT INTO `criterios_ficha` VALUES ('12', 'Grado de Maestro/Magister registrado en SUNEDU en área', 'SUBCRITERIO', '9', '6', '12', '12', 'checkbox', '', null, '6', '1', '1');
INSERT INTO `criterios_ficha` VALUES ('13', 'Estudios concluidos de Maestría', 'SUBCRITERIO', '9', '4', '13', '13', 'checkbox', '', null, '4', '1', '1');
INSERT INTO `criterios_ficha` VALUES ('14', 'Diplomado de Posgrado (hasta un máximo de tres (3) diplomados) - 3 puntos c/u', 'SUBCRITERIO', '9', '9', '14', '14', 'select+', '# de diplomados', '3', '3', '1', '1');
INSERT INTO `criterios_ficha` VALUES ('15', 'Formación Continua', 'RUBRO', '0', '30', '15', '24', '', '', null, '0', '1', '1');
INSERT INTO `criterios_ficha` VALUES ('16', 'Programas de Formación Docente, Actualización, Especialización o Segunda Especialización, afín al área curricular o campo de conocimiento que postula', 'CRITERIO', '15', '0', '0', '0', '', '', null, '0', '1', '1');
INSERT INTO `criterios_ficha` VALUES ('17', '- Realizado en los últimos cinco (5) años.\r\n- Presenciales, virtuales o semipresenciales.\r\n- Duración mínima de 126 horas cronológicas o 7 créditos.\r\n- Dos (2) puntos por cada certificación hasta un máximo de seis (6).', 'SUBCRITERIO', '16', '12', '17', '17', 'select+', '# de certificados', '6', '2', '1', '1');
INSERT INTO `criterios_ficha` VALUES ('18', 'Cursos o Módulos de Formación Docente, afín al área curricular o campo de conocimiento que postula', 'CRITERIO', '15', '0', '0', '0', '', '', null, '0', '1', '1');
INSERT INTO `criterios_ficha` VALUES ('19', '- Realizado en los últimos cinco (05) años.\r\n- Presenciales, virtuales o semipresenciales.\r\n- Duración mínima de 36 horas cronológicas.\r\n- Dos (2) puntos por cada certificación hasta un máximo de cuatro (4).', 'SUBCRITERIO', '18', '8', '19', '19', 'select+', '# de certificados', '4', '2', '1', '1');
INSERT INTO `criterios_ficha` VALUES ('20', 'Talleres de capacitación, seminarios y congresos', 'CRITERIO', '15', '0', '0', '0', '', '', null, '0', '1', '1');
INSERT INTO `criterios_ficha` VALUES ('21', '- Realizado en los últimos cinco (5) años.\r\n- Duración mínima de 16 horas cronológicas.\r\n- Presenciales, virtuales o semipresenciales.\r\n- Dos (2) puntos por cada certificación hasta un máximo de tres (3)', 'SUBCRITERIO', '20', '6', '21', '21', 'select+', '# de certificados', '3', '2', '1', '1');
INSERT INTO `criterios_ficha` VALUES ('22', 'Otros programas de formación continua, incluyendo temas de pedagogía', 'CRITERIO', '15', '0', '0', '0', '', '', null, '0', '1', '1');
INSERT INTO `criterios_ficha` VALUES ('23', '- Cursos de Ofimática igual o mayores a 24 horas o su equivalente en créditos.', 'SUBCRITERIO', '22', '2', '23', '23', 'checkbox', '', null, '2', '1', '1');
INSERT INTO `criterios_ficha` VALUES ('24', '- Certificación de dominio de idioma extranjero.\n Mínimo Nivel Intermedio Certificación emitida por un centro de idiomas certificado.', 'SUBCRITERIO', '22', '2', '24', '24', 'checkbox', '', null, '2', '1', '1');
INSERT INTO `criterios_ficha` VALUES ('25', 'Experiencia Laboral', 'RUBRO', '0', '20', '25', '35', '', '', null, '0', '1', '1');
INSERT INTO `criterios_ficha` VALUES ('26', '', 'PRE_SUBCRITERIO', '25', '20', '26', '33', '', '', null, '0', '1', '1');
INSERT INTO `criterios_ficha` VALUES ('27', 'Experiencia Laboral docente, en la modalidad educativa o el nivel educativo o ciclo al que postula, durante los meses de marzo a diciembre, teniendo en cuenta', 'CRITERIO', '26', '0', '0', '0', '', '', null, '0', '1', '1');
INSERT INTO `criterios_ficha` VALUES ('28', '- Corresponde 0.20 puntos por cada mes acreditado de labor en IE ubicada en zona urbana.', 'POST_SUBCRITERIO', '27', '0', '0', '0', 'number', '# de meses', null, '0.2', '1', '1');
INSERT INTO `criterios_ficha` VALUES ('29', '- Corresponde 0.30 puntos por cada mes acreditado de labor en IE ubicada en zona de frontera.', 'POST_SUBCRITERIO', '27', '0', '0', '0', 'number', '# de meses', null, '0.3', '1', '1');
INSERT INTO `criterios_ficha` VALUES ('30', '- Corresponde 0.30 puntos por cada mes acreditado de labor en IE ubicada en zona rural.', 'POST_SUBCRITERIO', '27', '0', '0', '0', 'number', '# de meses', null, '0.3', '1', '1');
INSERT INTO `criterios_ficha` VALUES ('31', '- Corresponde 0.40 puntos por cada mes acreditado de labor en IE ubicada en zona VRAEM.', 'POST_SUBCRITERIO', '27', '0', '0', '0', 'number', '# de meses', null, '0.4', '1', '1');
INSERT INTO `criterios_ficha` VALUES ('32', 'Experiencia laboral como PEC', 'CRITERIO', '26', '0', '0', '0', '', '', null, '0', '1', '1');
INSERT INTO `criterios_ficha` VALUES ('33', 'Corresponde 0.20 puntos por cada mes acreditado de labor.', 'SUBCRITERIO', '32', '0', '0', '0', 'number', '# de meses', null, '0.2', '1', '1');
INSERT INTO `criterios_ficha` VALUES ('34', 'Experiencia profesional como practicante', 'CRITERIO', '25', '0', '0', '0', '', '', null, '0', '1', '1');
INSERT INTO `criterios_ficha` VALUES ('35', 'Corresponde 0.20 puntos por cada mes acreditado de labor.', 'SUBCRITERIO', '34', '2', '35', '35', 'number', '# de meses', null, '0.2', '1', '1');
INSERT INTO `criterios_ficha` VALUES ('36', 'Méritos', 'RUBRO', '0', '5', '36', '41', '', '', null, '0', '1', '1');
INSERT INTO `criterios_ficha` VALUES ('37', '', 'PRE_SUBCRITERIO', '36', '5', '37', '41', '', '', null, '0', '1', '1');
INSERT INTO `criterios_ficha` VALUES ('38', 'Felicitación por desempeño o trabajo destacado en el campo pedagógico', 'CRITERIO', '37', '0', '0', '0', '', '', null, '0', '1', '1');
INSERT INTO `criterios_ficha` VALUES ('39', '- Resolución Ministerial o Directoral emitida por MINEDU (3 puntos).', 'POST_SUBCRITERIO', '38', '0', '0', '0', 'checkbox', '', null, '3', '1', '1');
INSERT INTO `criterios_ficha` VALUES ('40', '- Resolución Directoral Regional o de UGEL (2 puntos).', 'POST_SUBCRITERIO', '38', '0', '0', '0', 'checkbox', '', null, '2', '1', '1');
INSERT INTO `criterios_ficha` VALUES ('41', '- Resolución Institucional (1 punto).', 'POST_SUBCRITERIO', '38', '0', '0', '0', 'checkbox', '', null, '1', '1', '1');

-- ----------------------------
-- Table structure for cuadro_pun_exp
-- ----------------------------
DROP TABLE IF EXISTS `cuadro_pun_exp`;
CREATE TABLE `cuadro_pun_exp` (
  `cpe_id` int(11) NOT NULL AUTO_INCREMENT,
  `cpe_tipoCuadro` int(1) DEFAULT NULL COMMENT '1: PUN\n2. EXPEDIENTE',
  `cpe_anio` varchar(4) DEFAULT NULL,
  `cpe_documento` varchar(15) DEFAULT NULL,
  `cpe_apaterno` varchar(200) DEFAULT NULL,
  `cpe_amaterno` varchar(200) DEFAULT NULL,
  `cpe_apellidos` varchar(400) DEFAULT NULL,
  `cpe_nombres` varchar(200) DEFAULT NULL,
  `cpe_s1` varchar(15) DEFAULT NULL,
  `cpe_s2` varchar(15) DEFAULT NULL,
  `cpe_s3` varchar(15) DEFAULT NULL,
  `cpe_s4` varchar(15) DEFAULT NULL,
  `cpe_s5` varchar(15) DEFAULT NULL,
  `cpe_orden` int(11) DEFAULT NULL,
  `cpe_sepresento` int(1) DEFAULT NULL COMMENT '0: no se presento\n1: se presento\n2: solo registrado',
  `cpe_enviadoeval` int(1) DEFAULT NULL COMMENT '0: no enviado\n1: enviado',
  `cpe_fechaCarga` datetime DEFAULT NULL,
  `cpe_fechaModificacion` datetime DEFAULT NULL,
  `cpe_estado` int(1) DEFAULT NULL,
  `grupo_inscripcion_gin_id` int(11) NOT NULL,
  PRIMARY KEY (`cpe_id`),
  KEY `fk_cuadropun_grupo_inscripcion1_idx` (`grupo_inscripcion_gin_id`),
  CONSTRAINT `fk_cuadropun_grupo_inscripcion10` FOREIGN KEY (`grupo_inscripcion_gin_id`) REFERENCES `grupo_inscripcion` (`gin_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=141 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of cuadro_pun_exp
-- ----------------------------
INSERT INTO `cuadro_pun_exp` VALUES ('53', '1', '2022', '15944085', 'CASTAÑEDA', 'AGUEDO', 'CASTAÑEDA AGUEDO', 'CARMEN DEL PILAR', '12', '13', '14', '0', '0', '1', '1', '1', '2022-10-05 10:37:15', '2022-10-05 11:24:57', '1', '1');
INSERT INTO `cuadro_pun_exp` VALUES ('54', '1', '2022', '47025341', 'LEDESMA', 'AGURTO', 'LEDESMA AGURTO', 'SILVIA MARGOTH', '12', '13', '14', '0', '0', '2', '1', '1', '2022-10-05 10:37:15', '2022-10-05 11:24:57', '1', '1');
INSERT INTO `cuadro_pun_exp` VALUES ('55', '1', '2022', '41004937', 'MUÑOZ', 'AGUSTÍN', 'MUÑOZ AGUSTÍN', 'JANETH MARLENI', '12', '13', '14', '0', '0', '3', '0', '0', '2022-10-05 10:37:15', '2022-10-05 11:24:57', '1', '1');
INSERT INTO `cuadro_pun_exp` VALUES ('56', '1', '2022', '20111245', 'BENDEZU', 'AMARO', 'BENDEZU AMARO', 'HUGO JAIME', '12', '13', '14', '0', '0', '4', '1', '1', '2022-10-05 10:37:15', '2022-10-05 11:24:57', '1', '1');
INSERT INTO `cuadro_pun_exp` VALUES ('57', '1', '2022', '09329335', 'BAUTISTA', 'ANTICONA', 'BAUTISTA ANTICONA', 'CELINDA ESTHER', '12', '13', '14', '0', '0', '5', '1', '1', '2022-10-05 10:37:15', '2022-10-05 11:24:57', '1', '1');
INSERT INTO `cuadro_pun_exp` VALUES ('58', '1', '2022', '07683102', 'GARMA', 'CARDENAS', 'GARMA CARDENAS', 'CARMEN ROSA', '12', '13', '14', '0', '0', '6', '1', '1', '2022-10-05 10:37:15', '2022-10-05 11:24:57', '1', '1');
INSERT INTO `cuadro_pun_exp` VALUES ('59', '1', '2022', '06767000', 'ESCOBAR', 'CONDEÑA', 'ESCOBAR CONDEÑA', 'GUILMAR ASUNCION', '12', '13', '14', '0', '0', '7', '1', '1', '2022-10-05 10:37:15', '2022-10-05 11:24:57', '1', '1');
INSERT INTO `cuadro_pun_exp` VALUES ('60', '1', '2022', '41542924', 'SOLIS', 'CORALES', 'SOLIS CORALES', 'JAVIER LUIS', '12', '13', '14', '0', '0', '8', '1', '1', '2022-10-05 10:37:15', '2022-10-05 11:24:57', '1', '1');
INSERT INTO `cuadro_pun_exp` VALUES ('61', '1', '2022', '08125552', 'RIVERA', 'CUZCO', 'RIVERA CUZCO', 'MADELEINE HAYDEE', '12', '13', '14', '0', '0', '9', '1', '1', '2022-10-05 10:37:15', '2022-10-05 11:24:57', '1', '1');
INSERT INTO `cuadro_pun_exp` VALUES ('62', '1', '2022', '21080783', 'LAVADO', 'DE LA CRUZ', 'LAVADO DE LA CRUZ', 'JUAN MANUEL', '12', '13', '14', '0', '0', '10', '1', '1', '2022-10-05 10:37:15', '2022-10-05 11:24:57', '1', '1');
INSERT INTO `cuadro_pun_exp` VALUES ('63', '1', '2022', '09076839', 'JAUREGUI', 'FALCON DE ANDRADE', 'JAUREGUI FALCON DE ANDRADE', 'NELLY NIEVES', '12', '13', '14', '0', '0', '11', '1', '1', '2022-10-05 10:37:15', '2022-10-05 11:24:57', '1', '1');
INSERT INTO `cuadro_pun_exp` VALUES ('64', '1', '2022', '71004124', 'ESCRIBA', 'GAMBOA', 'ESCRIBA GAMBOA', 'MILAGROS DE LOS ÁNGELES', '12', '13', '14', '0', '0', '12', '1', '1', '2022-10-05 10:37:15', '2022-10-05 11:24:57', '1', '1');
INSERT INTO `cuadro_pun_exp` VALUES ('65', '1', '2022', '41665991', 'JAUREGUI', 'GOMEZ', 'JAUREGUI GOMEZ', 'MARISOL MILAGROS', '12', '13', '14', '0', '0', '13', '1', '1', '2022-10-05 10:37:15', '2022-10-05 11:24:57', '1', '1');
INSERT INTO `cuadro_pun_exp` VALUES ('66', '1', '2022', '10366340', 'ROBLES', 'GONZALES', 'ROBLES GONZALES', 'MARITA LUCILA', '12', '13', '14', '0', '0', '14', '0', '0', '2022-10-05 10:37:15', '2022-10-05 11:24:57', '1', '1');
INSERT INTO `cuadro_pun_exp` VALUES ('67', '1', '2022', '09326612', 'CORNEJO', 'GUEVARA', 'CORNEJO GUEVARA', 'MARIA ELENA', '12', '13', '14', '0', '0', '15', '1', '1', '2022-10-05 10:37:15', '2022-10-05 11:24:57', '1', '1');
INSERT INTO `cuadro_pun_exp` VALUES ('68', '1', '2022', '20034928', 'ROJAS', 'GUILLEN', 'ROJAS GUILLEN', 'MIRYAM KARIM', '12', '13', '14', '0', '0', '1', '1', '1', '2022-10-05 10:37:15', '2022-10-05 11:58:04', '1', '4');
INSERT INTO `cuadro_pun_exp` VALUES ('69', '1', '2022', '07054303', 'ANGELES', 'MACAVILCA', 'ANGELES MACAVILCA', 'ALBERTO REYNOLDI', '12', '13', '14', '0', '0', '2', '1', '1', '2022-10-05 10:37:15', '2022-10-05 11:58:04', '1', '4');
INSERT INTO `cuadro_pun_exp` VALUES ('70', '1', '2022', '19991524', 'ALIAGA', 'MARMOLEJO', 'ALIAGA MARMOLEJO', 'MORAYMA ÚRSULA', '12', '13', '14', '0', '0', '3', '1', '1', '2022-10-05 10:37:15', '2022-10-05 11:58:04', '1', '4');
INSERT INTO `cuadro_pun_exp` VALUES ('71', '1', '2022', '07968040', 'HARO', 'MIÑANO', 'HARO MIÑANO', 'MARIA GLORIA', '12', '13', '14', '0', '0', '1', '0', '0', '2022-10-05 10:37:15', '2022-10-11 09:50:51', '1', '6');
INSERT INTO `cuadro_pun_exp` VALUES ('72', '1', '2022', '09247360', 'CARRIZALES', 'MORENO', 'CARRIZALES MORENO', 'FELIX AGUSTIN', '12', '13', '14', '0', '0', '2', '1', '1', '2022-10-05 10:37:15', '2022-10-11 09:50:51', '1', '6');
INSERT INTO `cuadro_pun_exp` VALUES ('73', '1', '2022', '09095947', 'NICHO', 'NAPA', 'NICHO NAPA', 'YRENE YSABEL', '12', '13', '14', '0', '0', '3', '1', '1', '2022-10-05 10:37:15', '2022-10-11 09:50:51', '1', '6');
INSERT INTO `cuadro_pun_exp` VALUES ('74', '1', '2022', '08867819', 'HERNANDEZ', 'PARADO', 'HERNANDEZ PARADO', 'WUILVER GABRIEL', '12', '13', '14', '0', '0', '4', '1', '1', '2022-10-05 10:37:15', '2022-10-11 09:50:51', '1', '6');
INSERT INTO `cuadro_pun_exp` VALUES ('75', '1', '2022', '07275186', 'DIAZ', 'RODRIGUEZ', 'DIAZ RODRIGUEZ', 'REBECA NELLY', '12', '13', '14', '0', '0', '5', '1', '1', '2022-10-05 10:37:15', '2022-10-11 09:50:51', '1', '6');
INSERT INTO `cuadro_pun_exp` VALUES ('76', '1', '2022', '70457623', 'RIOS', 'ROSALES', 'RIOS ROSALES', 'MARÍA PÍA', '12', '13', '14', '0', '0', '6', '1', '1', '2022-10-05 10:37:15', '2022-10-11 09:50:51', '1', '6');
INSERT INTO `cuadro_pun_exp` VALUES ('77', '1', '2022', '09512157', 'PEREZ', 'SALGADO', 'PEREZ SALGADO', 'LUCAS NESTOR', '12', '13', '14', '0', '0', '7', '1', '1', '2022-10-05 10:37:15', '2022-10-11 09:50:51', '1', '6');
INSERT INTO `cuadro_pun_exp` VALUES ('78', '1', '2022', '08293556', 'MORENO', 'SANCHEZ', 'MORENO SANCHEZ', 'LILA LUZ', '12', '13', '14', '0', '0', '8', '1', '1', '2022-10-05 10:37:15', '2022-10-11 09:50:51', '1', '6');
INSERT INTO `cuadro_pun_exp` VALUES ('79', '1', '2022', '04065092', 'HUARINGA', 'SANTIAGO', 'HUARINGA SANTIAGO', 'HAYDEE GLADYS', '12', '13', '14', '0', '0', '9', '1', '1', '2022-10-05 10:37:15', '2022-10-11 09:50:51', '1', '6');
INSERT INTO `cuadro_pun_exp` VALUES ('80', '1', '2022', '42972596', 'CRUCES', 'SARRIA', 'CRUCES SARRIA', 'KATHERINE ISABEL', '12', '13', '14', '0', '0', '10', '1', '1', '2022-10-05 10:37:15', '2022-10-11 09:50:51', '1', '6');
INSERT INTO `cuadro_pun_exp` VALUES ('81', '1', '2022', '16586080', 'GOMEZ', 'SIPION', 'GOMEZ SIPION', 'MARY CRUZ', '12', '13', '14', '0', '0', '11', '1', '1', '2022-10-05 10:37:15', '2022-10-11 09:50:51', '1', '6');
INSERT INTO `cuadro_pun_exp` VALUES ('82', '1', '2022', '09333438', 'PATRICIO', 'SUDARIO', 'PATRICIO SUDARIO', 'PEDRO PAULINO', '12', '13', '14', '0', '0', '12', '1', '1', '2022-10-05 10:37:15', '2022-10-11 09:50:51', '1', '6');
INSERT INTO `cuadro_pun_exp` VALUES ('83', '1', '2022', '41129346', 'HUARCAYA', 'VALENTIN', 'HUARCAYA VALENTIN', 'JUAN FELICIANO', '12', '13', '14', '0', '0', '13', '1', '1', '2022-10-05 10:37:15', '2022-10-11 09:50:51', '1', '6');
INSERT INTO `cuadro_pun_exp` VALUES ('84', '1', '2022', '42349100', 'CORNEJO', 'VARGAS', 'CORNEJO VARGAS', 'JAVIER ELEODORO', '12', '13', '14', '0', '0', '14', '1', '1', '2022-10-05 10:37:15', '2022-10-11 09:50:51', '1', '6');
INSERT INTO `cuadro_pun_exp` VALUES ('85', '1', '2022', '16128674', 'ESCALANTE', 'VILLANUEVA', 'ESCALANTE VILLANUEVA', 'JUDITH ROSARIO', '12', '13', '14', '0', '0', '15', '1', '1', '2022-10-05 10:37:15', '2022-10-11 09:50:51', '1', '6');
INSERT INTO `cuadro_pun_exp` VALUES ('86', '1', '2022', '07913657', 'SANCHEZ', 'VILLAR', 'SANCHEZ VILLAR', 'CARMEN ROSA', '12', '13', '14', '0', '0', '16', '1', '1', '2022-10-05 10:37:15', '2022-10-11 09:50:51', '1', '6');
INSERT INTO `cuadro_pun_exp` VALUES ('87', '1', '2022', '41660893', 'ASCANIO', 'YSHUISA', 'ASCANIO YSHUISA', 'DEISSY MAGALI', '12', '13', '14', '0', '0', '17', '1', '1', '2022-10-05 10:37:15', '2022-10-11 09:50:51', '1', '6');
INSERT INTO `cuadro_pun_exp` VALUES ('88', '1', '2022', '08288872', 'VILLANUEVA', 'VELASQUEZ', 'VILLANUEVA VELASQUEZ', 'ANGELITA', '12', '13', '14', '0', '0', '18', '1', '1', '2022-10-05 10:37:15', '2022-10-11 09:50:51', '1', '6');
INSERT INTO `cuadro_pun_exp` VALUES ('89', '1', '2022', '09099691', 'CÓRDOVA', 'JESÚS', 'CÓRDOVA JESÚS', 'ROMÁN', '12', '13', '14', '0', '0', '1', '0', '0', '2022-10-05 10:37:15', '2022-10-13 15:04:44', '1', '7');
INSERT INTO `cuadro_pun_exp` VALUES ('90', '1', '2022', '09201805', 'HUALLPA', 'CACERES', 'HUALLPA CACERES', 'ALICIA', '12', '13', '14', '0', '0', '2', '1', '1', '2022-10-05 10:37:15', '2022-10-13 15:04:44', '1', '7');
INSERT INTO `cuadro_pun_exp` VALUES ('91', '1', '2022', '09207009', 'REQUEJO', 'VASQUEZ', 'REQUEJO VASQUEZ', 'ROSA', '12', '13', '14', '0', '0', '3', '1', '1', '2022-10-05 10:37:15', '2022-10-13 15:04:44', '1', '7');
INSERT INTO `cuadro_pun_exp` VALUES ('92', '1', '2022', '10657021', 'CARPIO', 'SANCHEZ', 'CARPIO SANCHEZ', 'NICOLAS', '12', '13', '14', '0', '0', '4', '1', '1', '2022-10-05 10:37:15', '2022-10-13 15:04:44', '1', '7');
INSERT INTO `cuadro_pun_exp` VALUES ('93', '1', '2022', '10678533', 'VERÓNICA', 'POMA', 'VERÓNICA POMA', 'LUISA', '12', '13', '14', '0', '0', '5', '1', '1', '2022-10-05 10:37:15', '2022-10-13 15:04:44', '1', '7');
INSERT INTO `cuadro_pun_exp` VALUES ('94', '1', '2022', '10763119', 'CERDAN', '', 'CERDAN', 'FRANCISCO', '12', '13', '14', '0', '0', '6', '1', '1', '2022-10-05 10:37:15', '2022-10-13 15:04:44', '1', '7');
INSERT INTO `cuadro_pun_exp` VALUES ('95', '1', '2022', '21802177', 'TASAYCO', 'ATUNCAR', 'TASAYCO ATUNCAR', 'MANUEL', '12', '13', '14', '0', '0', '7', '0', '0', '2022-10-05 10:37:15', '2022-10-13 15:04:44', '1', '7');
INSERT INTO `cuadro_pun_exp` VALUES ('96', '1', '2022', '21876096', 'ROSPIGLIOSI', '', 'ROSPIGLIOSI', 'GERMÁN', '12', '13', '14', '0', '0', '8', '1', '1', '2022-10-05 10:37:15', '2022-10-13 15:04:44', '1', '7');
INSERT INTO `cuadro_pun_exp` VALUES ('97', '1', '2022', '31543158', 'ROCA', 'TAPIA', 'ROCA TAPIA', 'CLETO', '12', '13', '14', '0', '0', '9', '0', '0', '2022-10-05 10:37:15', '2022-10-13 15:04:44', '1', '7');
INSERT INTO `cuadro_pun_exp` VALUES ('98', '1', '2022', '40713080', 'ROJAS', 'SHUPINGAHUA', 'ROJAS SHUPINGAHUA', 'PERCY', '12', '13', '14', '0', '0', '10', '1', '1', '2022-10-05 10:37:15', '2022-11-21 20:17:18', '1', '7');
INSERT INTO `cuadro_pun_exp` VALUES ('99', '1', '2022', '41077305', 'SANDOVAL', 'PÉREZ', 'SANDOVAL PÉREZ', 'MARCELA', '12', '13', '14', '0', '0', '11', '1', '1', '2022-10-05 10:37:15', '2022-11-21 20:17:18', '1', '7');
INSERT INTO `cuadro_pun_exp` VALUES ('100', '1', '2022', '41603575', 'ARBIZU', 'RODRIGUEZ', 'ARBIZU RODRIGUEZ', 'EMILY', '12', '13', '14', '0', '0', '4', '1', '1', '2022-10-05 10:37:15', '2022-10-05 11:58:04', '1', '4');
INSERT INTO `cuadro_pun_exp` VALUES ('101', '1', '2022', '43416085', 'BECERRA', 'BOLAÑOS', 'BECERRA BOLAÑOS', 'MANUELA', '12', '13', '14', '0', '0', '5', '1', '1', '2022-10-05 10:37:15', '2022-10-05 11:58:04', '1', '4');
INSERT INTO `cuadro_pun_exp` VALUES ('102', '1', '2022', '45940353', 'HUAMANI', 'DURAND', 'HUAMANI DURAND', 'GRETA', '12', '13', '14', '0', '0', '6', '1', '1', '2022-10-05 10:37:15', '2022-10-05 11:58:04', '1', '4');
INSERT INTO `cuadro_pun_exp` VALUES ('103', '1', '2022', '71248172', 'MAGALLANES', 'ORMEÑO', 'MAGALLANES ORMEÑO', 'ROSA', '12', '13', '14', '0', '0', '7', '1', '1', '2022-10-05 10:37:15', '2022-10-05 11:58:04', '1', '4');
INSERT INTO `cuadro_pun_exp` VALUES ('104', '1', '2022', '72123517', 'GUILLEN', 'NOLBERTO', 'GUILLEN NOLBERTO', 'YESSENIA', '12', '13', '14', '0', '0', '8', '1', '1', '2022-10-05 10:37:15', '2022-10-05 11:58:04', '1', '4');
INSERT INTO `cuadro_pun_exp` VALUES ('105', '2', '2022', '20991248', null, null, 'QUIÑONES SUAREZ', 'NORMA ERLINDA', null, null, null, null, null, null, '1', '1', '2022-10-05 23:36:26', '2022-10-06 00:01:55', '1', '1');
INSERT INTO `cuadro_pun_exp` VALUES ('106', '2', '2022', '09667051', null, null, 'AGUILAR BARRANTES', 'WILSON', null, null, null, null, null, null, '1', '1', '2022-10-05 23:38:57', '2022-10-06 00:02:28', '1', '1');
INSERT INTO `cuadro_pun_exp` VALUES ('107', '2', '2022', '09095947', null, null, 'NICHO NAPA', 'YRENE YSABEL', null, null, null, null, null, null, '1', '1', '2022-10-05 23:38:57', '2022-10-06 00:05:55', '1', '1');
INSERT INTO `cuadro_pun_exp` VALUES ('108', '2', '2022', '09554915', null, null, 'BENDEZU VEGA', 'OCTAVIO ALCIBIADES', null, null, null, null, null, null, '1', '1', '2022-10-05 23:38:57', '2022-10-06 00:08:33', '1', '1');
INSERT INTO `cuadro_pun_exp` VALUES ('109', '2', '2022', '10357907', null, null, 'RODAS TELLO', 'CESAR AUGUSTO', null, null, null, null, null, null, '2', '0', '2022-10-05 23:38:57', null, '1', '1');
INSERT INTO `cuadro_pun_exp` VALUES ('110', '2', '2022', '09652817', null, null, 'LLANOS ALMONACID', 'SABY OFELIA', null, null, null, null, null, null, '2', '0', '2022-10-05 23:38:57', null, '1', '1');
INSERT INTO `cuadro_pun_exp` VALUES ('111', '2', '2022', '10763119', null, null, 'CERDAN', 'FRANCISCO', null, null, null, null, null, null, '1', '1', '2022-10-05 23:38:58', '2022-10-06 00:10:44', '1', '1');
INSERT INTO `cuadro_pun_exp` VALUES ('112', '2', '2022', '09512157', null, null, 'PEREZ SALGADO', 'LUCAS NESTOR', null, null, null, null, null, null, '2', '0', '2022-10-05 23:38:58', null, '1', '1');
INSERT INTO `cuadro_pun_exp` VALUES ('113', '2', '2022', '08288872', null, null, 'VILLANUEVA  VELASQUEZ', 'ANGELITA', null, null, null, null, null, null, '2', '0', '2022-10-05 23:38:58', null, '1', '1');
INSERT INTO `cuadro_pun_exp` VALUES ('114', '2', '2022', '10119136', null, null, 'PAITAN COMPI', 'ELIZABETH LUCÍA', null, null, null, null, null, null, '1', '1', '2022-10-05 23:41:26', '2022-10-06 00:40:49', '1', '15');
INSERT INTO `cuadro_pun_exp` VALUES ('115', '2', '2022', '47395488', null, null, 'VILLALOBOS CACERES', 'BERSABET YANIRA', null, null, null, null, null, null, '1', '1', '2022-10-05 23:41:26', '2022-10-06 00:40:49', '1', '15');
INSERT INTO `cuadro_pun_exp` VALUES ('116', '2', '2022', '09332301', null, null, 'DAMIAN CHUMBE', 'FELIMON ANGEL', null, null, null, null, null, null, '1', '1', '2022-10-05 23:41:26', '2022-10-06 00:40:49', '1', '15');
INSERT INTO `cuadro_pun_exp` VALUES ('117', '2', '2022', '09427758', null, null, 'VEGA HUANCA', 'JACQUELINE TEODORA', null, null, null, null, null, null, '1', '1', '2022-10-05 23:41:26', '2022-10-06 00:40:49', '1', '15');
INSERT INTO `cuadro_pun_exp` VALUES ('118', '2', '2022', '10678533', null, null, 'POMA', 'LUISA VERÓNICA', null, null, null, null, null, null, '1', '1', '2022-10-05 23:41:27', '2022-10-06 00:40:49', '1', '15');
INSERT INTO `cuadro_pun_exp` VALUES ('119', '2', '2022', '08867819', null, null, 'HERNANDEZ PARADO', 'WUILVER GABRIEL', null, null, null, null, null, null, '1', '1', '2022-10-05 23:41:27', '2022-10-06 00:40:49', '1', '15');
INSERT INTO `cuadro_pun_exp` VALUES ('120', '2', '2022', '31543158', null, null, 'ROCA TAPIA', 'CLETO', null, null, null, null, null, null, '1', '1', '2022-10-05 23:41:27', '2022-10-06 00:40:49', '1', '15');
INSERT INTO `cuadro_pun_exp` VALUES ('121', '2', '2022', '09784963', null, null, 'SANTIAGO ESPINOZA', 'CESAR ALBERTO', null, null, null, null, null, null, '1', '1', '2022-10-05 23:41:27', '2022-10-06 00:40:49', '1', '15');
INSERT INTO `cuadro_pun_exp` VALUES ('122', '2', '2022', '10723417', null, null, 'VALLADOLID ZETA', 'NANCY DEL PILAR', null, null, null, null, null, null, '1', '1', '2022-10-05 23:41:27', '2022-10-06 00:40:49', '1', '15');
INSERT INTO `cuadro_pun_exp` VALUES ('123', '2', '2022', '09652817', null, null, 'LLANOS ALMONACID', 'SABY OFELIA', null, null, null, null, null, null, '1', '1', '2022-10-05 23:54:01', '2022-10-06 00:40:49', '1', '15');
INSERT INTO `cuadro_pun_exp` VALUES ('124', '2', '2022', '09554915', null, null, 'BENDEZU VEGA', 'OCTAVIO ALCIBIADES', null, null, null, null, null, null, '1', '1', '2022-10-05 23:54:01', '2022-10-06 00:40:49', '1', '15');
INSERT INTO `cuadro_pun_exp` VALUES ('125', '2', '2022', '10351990', null, null, 'SALAZAR', 'ELVA RUTH', null, null, null, null, null, null, '1', '1', '2022-10-11 09:55:34', '2022-10-11 09:56:06', '1', '15');
INSERT INTO `cuadro_pun_exp` VALUES ('126', '2', '2022', '09770531', null, null, 'ÑAUPARI', 'MILAGROS MARITZA', null, null, null, null, null, null, '1', '1', '2022-10-11 09:55:34', '2022-10-11 09:56:06', '1', '15');
INSERT INTO `cuadro_pun_exp` VALUES ('127', '2', '2022', '21802177', null, null, 'TASAYCO ATUNCAR', 'MANUEL', null, null, null, null, null, null, '1', '1', '2022-10-11 09:55:34', '2022-10-11 09:56:06', '1', '15');
INSERT INTO `cuadro_pun_exp` VALUES ('128', '2', '2022', '10678533', null, null, 'POMA', 'LUISA VERÓNICA', null, null, null, null, null, null, '1', '1', '2022-10-11 09:55:35', '2022-10-11 09:56:06', '1', '15');
INSERT INTO `cuadro_pun_exp` VALUES ('129', '2', '2022', '09569343', null, null, 'VEGA VILLAORDUÑA', 'NAIBETO', null, null, null, null, null, null, '1', '1', '2022-10-11 09:55:35', '2022-10-11 09:56:06', '1', '15');
INSERT INTO `cuadro_pun_exp` VALUES ('130', '2', '2022', '09652817', null, null, 'LLANOS ALMONACID', 'SABY OFELIA', null, null, null, null, null, null, '1', '1', '2022-10-11 09:55:35', '2022-10-11 09:56:06', '1', '15');
INSERT INTO `cuadro_pun_exp` VALUES ('131', '2', '2022', '09099691', null, null, 'CÓRDOVA JESÚS', 'ROMÁN', null, null, null, null, null, null, '1', '1', '2022-10-11 09:55:35', '2022-10-11 09:56:06', '1', '15');
INSERT INTO `cuadro_pun_exp` VALUES ('132', '2', '2022', '10130084', null, null, 'CAUNALLA CALLOHUANCA', 'NELLY CAROLINA', null, null, null, null, null, null, '1', '1', '2022-10-11 09:55:35', '2022-10-11 09:56:06', '1', '15');
INSERT INTO `cuadro_pun_exp` VALUES ('133', '2', '2022', '09652817', null, null, 'LLANOS ALMONACID', 'SABY OFELIA', null, null, null, null, null, null, '1', '1', '2022-10-13 15:15:22', '2022-10-13 15:16:05', '1', '15');
INSERT INTO `cuadro_pun_exp` VALUES ('134', '2', '2022', '41695705', null, null, 'ESPINOZA OSTOS', 'MARITHSABEL', null, null, null, null, null, null, '1', '1', '2022-10-13 15:15:22', '2022-10-13 15:16:05', '1', '15');
INSERT INTO `cuadro_pun_exp` VALUES ('135', '2', '2022', '04073637', null, null, 'VALERIO QUINTO', 'MARIA VICTORIA', null, null, null, null, null, null, '1', '1', '2022-10-13 15:15:22', '2022-10-13 15:16:05', '1', '15');
INSERT INTO `cuadro_pun_exp` VALUES ('136', '2', '2022', '28993058', null, null, 'SERMEÑO CAMARA', 'RAUL JOSE', null, null, null, null, null, null, '1', '1', '2022-10-13 15:15:22', '2022-10-13 15:16:05', '1', '15');
INSERT INTO `cuadro_pun_exp` VALUES ('137', '2', '2022', '10418815', null, null, 'GONZALES GUERRA', 'ANGELA ROSARIO', null, null, null, null, null, null, '1', '1', '2022-10-13 15:15:23', '2022-10-13 15:16:05', '1', '15');
INSERT INTO `cuadro_pun_exp` VALUES ('138', '2', '2022', '09204166', null, null, 'ALBORNOZ CHAVEZ', 'ANA MARIA', null, null, null, null, null, null, '1', '1', '2022-10-13 15:15:23', '2022-10-13 15:16:05', '1', '15');
INSERT INTO `cuadro_pun_exp` VALUES ('139', '2', '2022', '10764838', null, null, 'MALAVER YUPANQUI', 'RAFAEL', null, null, null, null, null, null, '1', '1', '2022-10-13 15:15:23', '2022-10-13 15:16:05', '1', '15');
INSERT INTO `cuadro_pun_exp` VALUES ('140', '2', '2022', '09793633', null, null, 'CASTILLO VILLANUEVA', 'FANNY MARGOT', null, null, null, null, null, null, '1', '1', '2022-10-13 15:15:23', '2022-10-13 15:16:05', '1', '15');

-- ----------------------------
-- Table structure for especialidades
-- ----------------------------
DROP TABLE IF EXISTS `especialidades`;
CREATE TABLE `especialidades` (
  `esp_id` int(11) NOT NULL AUTO_INCREMENT,
  `esp_descripcion` varchar(250) DEFAULT NULL,
  `esp_estado` int(1) DEFAULT NULL COMMENT '0: inactivo\n1: activo',
  `niveles_niv_id` int(11) NOT NULL,
  PRIMARY KEY (`esp_id`),
  KEY `fk_especialidades_niveles1_idx` (`niveles_niv_id`),
  CONSTRAINT `fk_especialidades_niveles1` FOREIGN KEY (`niveles_niv_id`) REFERENCES `niveles` (`niv_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of especialidades
-- ----------------------------
INSERT INTO `especialidades` VALUES ('1', '-', '1', '1');
INSERT INTO `especialidades` VALUES ('2', '-', '1', '2');
INSERT INTO `especialidades` VALUES ('3', 'Educación Física', '1', '2');
INSERT INTO `especialidades` VALUES ('4', 'Aula de Innovación Pedagógica', '1', '2');
INSERT INTO `especialidades` VALUES ('5', 'Matemática', '1', '3');
INSERT INTO `especialidades` VALUES ('6', 'Ciencias Sociales', '1', '3');
INSERT INTO `especialidades` VALUES ('7', 'Desarrollo Personal, Ciudadanía y Cívica', '1', '3');
INSERT INTO `especialidades` VALUES ('8', 'Ciencia y Tecnología', '1', '3');
INSERT INTO `especialidades` VALUES ('9', 'Comunicación', '1', '3');
INSERT INTO `especialidades` VALUES ('10', 'Educación Religiosa', '1', '3');
INSERT INTO `especialidades` VALUES ('11', 'Inglés', '1', '3');
INSERT INTO `especialidades` VALUES ('12', 'Arte y Cultura', '1', '3');
INSERT INTO `especialidades` VALUES ('13', 'Educación Física', '1', '3');
INSERT INTO `especialidades` VALUES ('14', 'Aula de Innovación Pedagógica', '1', '3');
INSERT INTO `especialidades` VALUES ('15', '-', '1', '4');

-- ----------------------------
-- Table structure for evaluacion_ficha
-- ----------------------------
DROP TABLE IF EXISTS `evaluacion_ficha`;
CREATE TABLE `evaluacion_ficha` (
  `efi_id` int(11) NOT NULL AUTO_INCREMENT,
  `efi_puntaje` varchar(45) DEFAULT NULL,
  `efi_fechaInicioEval` datetime DEFAULT NULL,
  `efi_fechaInicioCierre` datetime DEFAULT NULL,
  `efi_estado` int(1) DEFAULT NULL,
  `evaluacion_pun_exp_epe_id` int(11) NOT NULL,
  `criterios_ficha_cfi_id` int(11) NOT NULL,
  PRIMARY KEY (`efi_id`),
  KEY `fk_evaluacion_ficha_evaluacion_pun_exp1_idx` (`evaluacion_pun_exp_epe_id`),
  KEY `fk_evaluacion_ficha_criterios_ficha1_idx` (`criterios_ficha_cfi_id`),
  CONSTRAINT `fk_evaluacion_ficha_criterios_ficha1` FOREIGN KEY (`criterios_ficha_cfi_id`) REFERENCES `criterios_ficha` (`cfi_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_evaluacion_ficha_evaluacion_pun_exp1` FOREIGN KEY (`evaluacion_pun_exp_epe_id`) REFERENCES `evaluacion_pun_exp` (`epe_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of evaluacion_ficha
-- ----------------------------

-- ----------------------------
-- Table structure for evaluacion_pun_exp
-- ----------------------------
DROP TABLE IF EXISTS `evaluacion_pun_exp`;
CREATE TABLE `evaluacion_pun_exp` (
  `epe_id` int(11) NOT NULL AUTO_INCREMENT,
  `epe_tipoevaluacion` int(1) DEFAULT NULL COMMENT '1: preliminar\n2: final',
  `epe_especialistaAsignado` varchar(12) DEFAULT NULL,
  `epe_fechaAsignacion` datetime DEFAULT NULL,
  `epe_fechaApertura` datetime DEFAULT NULL COMMENT 'fecha de inicio de evaluacion',
  `epe_fechaCierre` datetime DEFAULT NULL COMMENT 'fecha de cierre de evaluacion',
  `epe_fechaModificacion` datetime DEFAULT NULL,
  `epe_estadoEvaluacion` int(1) DEFAULT NULL COMMENT '1: abierto\n0: cerrado',
  `epe_estado` int(1) DEFAULT NULL,
  `postulacion_id` int(11) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`epe_id`)
) ENGINE=InnoDB AUTO_INCREMENT=82 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of evaluacion_pun_exp
-- ----------------------------
INSERT INTO `evaluacion_pun_exp` VALUES ('1', '1', '43597360', '2022-10-05 11:53:06', '2022-10-05 11:48:56', null, '2022-10-05 11:53:06', '1', '1', '0');
INSERT INTO `evaluacion_pun_exp` VALUES ('2', '1', '45146572', '2022-10-09 23:26:23', '2022-10-05 11:49:21', null, '2022-10-09 23:26:23', '1', '1', '0');
INSERT INTO `evaluacion_pun_exp` VALUES ('3', '1', '45146572', '2022-10-05 11:49:21', '2022-10-05 11:49:21', null, null, '1', '1', '0');
INSERT INTO `evaluacion_pun_exp` VALUES ('4', '1', '45146572', '2022-10-05 11:49:21', '2022-10-05 11:49:21', null, null, '1', '1', '0');
INSERT INTO `evaluacion_pun_exp` VALUES ('5', '1', '45146572', '2022-10-05 11:49:21', '2022-10-05 11:49:21', null, null, '1', '1', '0');
INSERT INTO `evaluacion_pun_exp` VALUES ('6', '1', '47649297', '2022-10-05 11:49:30', '2022-10-05 11:49:30', null, null, '1', '1', '0');
INSERT INTO `evaluacion_pun_exp` VALUES ('7', '1', '47649297', '2022-10-05 11:49:30', '2022-10-05 11:49:30', null, null, '1', '1', '0');
INSERT INTO `evaluacion_pun_exp` VALUES ('8', '1', '47649297', '2022-10-05 11:49:30', '2022-10-05 11:49:30', null, null, '1', '1', '0');
INSERT INTO `evaluacion_pun_exp` VALUES ('9', '1', '47649297', '2022-10-05 11:49:30', '2022-10-05 11:49:30', null, null, '1', '1', '0');
INSERT INTO `evaluacion_pun_exp` VALUES ('10', '1', '43597360', '2022-10-05 11:49:36', '2022-10-05 11:49:36', null, null, '1', '1', '0');
INSERT INTO `evaluacion_pun_exp` VALUES ('11', '1', '43597360', '2022-10-05 11:49:36', '2022-10-05 11:49:36', null, null, '1', '1', '0');
INSERT INTO `evaluacion_pun_exp` VALUES ('12', '1', '43597360', '2022-10-05 11:49:36', '2022-10-05 11:49:36', null, null, '1', '1', '0');
INSERT INTO `evaluacion_pun_exp` VALUES ('13', '1', '43597360', '2022-10-05 11:49:36', '2022-10-05 11:49:36', null, null, '1', '1', '0');
INSERT INTO `evaluacion_pun_exp` VALUES ('16', '1', '43597360', '2022-10-05 11:58:25', '2022-10-05 11:58:25', null, null, '1', '1', '0');
INSERT INTO `evaluacion_pun_exp` VALUES ('17', '1', '43597360', '2022-10-05 11:58:25', '2022-10-05 11:58:25', null, null, '1', '1', '0');
INSERT INTO `evaluacion_pun_exp` VALUES ('18', '1', '43597360', '2022-10-05 11:58:25', '2022-10-05 11:58:25', null, null, '1', '1', '0');
INSERT INTO `evaluacion_pun_exp` VALUES ('19', '1', '45146572', '2022-10-05 11:58:33', '2022-10-05 11:58:33', null, null, '1', '1', '0');
INSERT INTO `evaluacion_pun_exp` VALUES ('20', '1', '45146572', '2022-10-05 11:58:33', '2022-10-05 11:58:33', null, null, '1', '1', '0');
INSERT INTO `evaluacion_pun_exp` VALUES ('21', '1', '45146572', '2022-10-05 11:58:33', '2022-10-05 11:58:33', null, null, '1', '1', '0');
INSERT INTO `evaluacion_pun_exp` VALUES ('22', '1', '47649297', '2022-10-05 11:58:38', '2022-10-05 11:58:38', null, null, '1', '1', '0');
INSERT INTO `evaluacion_pun_exp` VALUES ('23', '1', '47649297', '2022-10-05 11:58:38', '2022-10-05 11:58:38', null, null, '1', '1', '0');
INSERT INTO `evaluacion_pun_exp` VALUES ('24', '1', '43597360', '2022-10-11 10:09:19', '2022-10-06 00:39:50', null, '2022-10-11 10:09:19', '1', '1', '0');
INSERT INTO `evaluacion_pun_exp` VALUES ('25', '1', '43597360', '2022-10-06 00:41:10', '2022-10-06 00:41:10', null, null, '1', '1', '0');
INSERT INTO `evaluacion_pun_exp` VALUES ('26', '1', '43597360', '2022-10-06 00:41:10', '2022-10-06 00:41:10', null, null, '1', '1', '0');
INSERT INTO `evaluacion_pun_exp` VALUES ('27', '1', '43597360', '2022-10-06 00:41:10', '2022-10-06 00:41:10', null, null, '1', '1', '0');
INSERT INTO `evaluacion_pun_exp` VALUES ('28', '1', '43597360', '2022-10-06 00:41:10', '2022-10-06 00:41:10', null, null, '1', '1', '0');
INSERT INTO `evaluacion_pun_exp` VALUES ('29', '1', '43597360', '2022-10-06 00:41:10', '2022-10-06 00:41:10', null, null, '1', '1', '0');
INSERT INTO `evaluacion_pun_exp` VALUES ('30', '1', '43597360', '2022-10-11 10:09:19', '2022-10-06 00:47:27', null, '2022-10-11 10:09:19', '1', '1', '0');
INSERT INTO `evaluacion_pun_exp` VALUES ('31', '1', '45146572', '2022-10-06 00:47:27', '2022-10-06 00:47:27', null, null, '1', '1', '0');
INSERT INTO `evaluacion_pun_exp` VALUES ('32', '1', '47649297', '2022-10-06 00:50:39', '2022-10-06 00:50:39', null, null, '1', '1', '0');
INSERT INTO `evaluacion_pun_exp` VALUES ('33', '1', '43769349', '2022-10-11 10:09:01', '2022-10-11 10:09:01', null, null, '1', '1', '0');
INSERT INTO `evaluacion_pun_exp` VALUES ('34', '1', '43597360', '2022-10-11 10:09:59', '2022-10-11 10:09:59', null, null, '1', '1', '0');
INSERT INTO `evaluacion_pun_exp` VALUES ('35', '1', '43597360', '2022-10-11 10:09:59', '2022-10-11 10:09:59', null, null, '1', '1', '0');
INSERT INTO `evaluacion_pun_exp` VALUES ('36', '1', '43597360', '2022-10-11 10:09:59', '2022-10-11 10:09:59', null, null, '1', '1', '0');
INSERT INTO `evaluacion_pun_exp` VALUES ('37', '1', '43597360', '2022-10-11 10:09:59', '2022-10-11 10:09:59', null, null, '1', '1', '0');
INSERT INTO `evaluacion_pun_exp` VALUES ('38', '1', '43597360', '2022-10-11 10:09:59', '2022-10-11 10:09:59', null, null, '1', '1', '0');
INSERT INTO `evaluacion_pun_exp` VALUES ('39', '1', '43769349', '2022-10-11 10:10:53', '2022-10-11 10:10:08', null, '2022-10-11 10:10:53', '1', '1', '0');
INSERT INTO `evaluacion_pun_exp` VALUES ('40', '1', '43769349', '2022-10-11 10:10:53', '2022-10-11 10:10:08', null, '2022-10-11 10:10:53', '1', '1', '0');
INSERT INTO `evaluacion_pun_exp` VALUES ('41', '1', '43769349', '2022-10-11 10:10:53', '2022-10-11 10:10:08', null, '2022-10-11 10:10:53', '1', '1', '0');
INSERT INTO `evaluacion_pun_exp` VALUES ('42', '1', '43769349', '2022-10-11 10:10:53', '2022-10-11 10:10:08', null, '2022-10-11 10:10:53', '1', '1', '0');
INSERT INTO `evaluacion_pun_exp` VALUES ('43', '1', '43769349', '2022-10-11 10:10:53', '2022-10-11 10:10:08', null, '2022-10-11 10:10:53', '1', '1', '0');
INSERT INTO `evaluacion_pun_exp` VALUES ('44', '1', '47649297', '2022-10-11 10:10:17', '2022-10-11 10:10:17', null, null, '1', '1', '0');
INSERT INTO `evaluacion_pun_exp` VALUES ('45', '1', '47649297', '2022-10-11 10:10:17', '2022-10-11 10:10:17', null, null, '1', '1', '0');
INSERT INTO `evaluacion_pun_exp` VALUES ('46', '1', '47649297', '2022-10-11 10:10:17', '2022-10-11 10:10:17', null, null, '1', '1', '0');
INSERT INTO `evaluacion_pun_exp` VALUES ('47', '1', '47649297', '2022-10-11 10:10:17', '2022-10-11 10:10:17', null, null, '1', '1', '0');
INSERT INTO `evaluacion_pun_exp` VALUES ('48', '1', '47649297', '2022-10-11 10:10:17', '2022-10-11 10:10:17', null, null, '1', '1', '0');
INSERT INTO `evaluacion_pun_exp` VALUES ('49', '1', '43769349', '2022-10-11 10:11:19', '2022-10-11 10:11:19', null, null, '1', '1', '0');
INSERT INTO `evaluacion_pun_exp` VALUES ('50', '1', '43769349', '2022-10-11 10:11:19', '2022-10-11 10:11:19', null, null, '1', '1', '0');
INSERT INTO `evaluacion_pun_exp` VALUES ('51', '1', '43769349', '2022-10-11 10:12:06', '2022-10-11 10:12:06', null, null, '1', '1', '0');
INSERT INTO `evaluacion_pun_exp` VALUES ('52', '1', '43769349', '2022-10-11 10:12:06', '2022-10-11 10:12:06', null, null, '1', '1', '0');
INSERT INTO `evaluacion_pun_exp` VALUES ('53', '1', '43769349', '2022-10-11 10:12:06', '2022-10-11 10:12:06', null, null, '1', '1', '0');
INSERT INTO `evaluacion_pun_exp` VALUES ('54', '1', '43769349', '2022-10-11 10:12:06', '2022-10-11 10:12:06', null, null, '1', '1', '0');
INSERT INTO `evaluacion_pun_exp` VALUES ('55', '1', '43769349', '2022-10-11 10:12:06', '2022-10-11 10:12:06', null, null, '1', '1', '0');
INSERT INTO `evaluacion_pun_exp` VALUES ('56', '1', '43769349', '2022-10-11 10:12:06', '2022-10-11 10:12:06', null, null, '1', '1', '0');
INSERT INTO `evaluacion_pun_exp` VALUES ('57', '1', '43769349', '2022-10-11 10:12:06', '2022-10-11 10:12:06', null, null, '1', '1', '0');
INSERT INTO `evaluacion_pun_exp` VALUES ('58', '1', '43769349', '2022-10-11 10:12:06', '2022-10-11 10:12:06', null, null, '1', '1', '0');
INSERT INTO `evaluacion_pun_exp` VALUES ('59', '1', '43769349', '2022-10-11 10:12:06', '2022-10-11 10:12:06', null, null, '1', '1', '0');
INSERT INTO `evaluacion_pun_exp` VALUES ('60', '1', '43769349', '2022-10-11 10:12:06', '2022-10-11 10:12:06', null, null, '1', '1', '0');
INSERT INTO `evaluacion_pun_exp` VALUES ('61', '1', '45146572', '2022-10-11 10:12:16', '2022-10-11 10:12:16', null, null, '1', '1', '0');
INSERT INTO `evaluacion_pun_exp` VALUES ('62', '1', '45146572', '2022-10-11 10:12:16', '2022-10-11 10:12:16', null, null, '1', '1', '0');
INSERT INTO `evaluacion_pun_exp` VALUES ('63', '1', '45146572', '2022-10-11 10:12:16', '2022-10-11 10:12:16', null, null, '1', '1', '0');
INSERT INTO `evaluacion_pun_exp` VALUES ('64', '1', '45146572', '2022-10-11 10:12:16', '2022-10-11 10:12:16', null, null, '1', '1', '0');
INSERT INTO `evaluacion_pun_exp` VALUES ('65', '1', '45146572', '2022-10-13 15:09:41', '2022-10-13 15:08:34', null, '2022-10-13 15:09:41', '1', '1', '0');
INSERT INTO `evaluacion_pun_exp` VALUES ('66', '1', '43597360', '2022-10-13 15:09:06', '2022-10-13 15:08:34', null, '2022-10-13 15:09:06', '1', '1', '0');
INSERT INTO `evaluacion_pun_exp` VALUES ('67', '1', '43597360', '2022-10-13 15:09:06', '2022-10-13 15:08:34', null, '2022-10-13 15:09:06', '1', '1', '0');
INSERT INTO `evaluacion_pun_exp` VALUES ('68', '1', '43597360', '2022-10-13 15:09:06', '2022-10-13 15:08:34', null, '2022-10-13 15:09:06', '1', '1', '0');
INSERT INTO `evaluacion_pun_exp` VALUES ('69', '1', '43597360', '2022-10-13 15:09:06', '2022-10-13 15:08:34', null, '2022-10-13 15:09:06', '1', '1', '0');
INSERT INTO `evaluacion_pun_exp` VALUES ('70', '1', '43597360', '2022-10-13 15:09:06', '2022-10-13 15:08:34', null, '2022-10-13 15:09:06', '1', '1', '0');
INSERT INTO `evaluacion_pun_exp` VALUES ('71', '1', '45146572', '2022-10-13 15:16:41', '2022-10-13 15:16:41', null, null, '1', '1', '0');
INSERT INTO `evaluacion_pun_exp` VALUES ('72', '1', '45146572', '2022-10-13 15:16:41', '2022-10-13 15:16:41', null, null, '1', '1', '0');
INSERT INTO `evaluacion_pun_exp` VALUES ('73', '1', '45146572', '2022-10-13 15:16:41', '2022-10-13 15:16:41', null, null, '1', '1', '0');
INSERT INTO `evaluacion_pun_exp` VALUES ('74', '1', '45146572', '2022-10-13 15:16:41', '2022-10-13 15:16:41', null, null, '1', '1', '0');
INSERT INTO `evaluacion_pun_exp` VALUES ('75', '1', '45146572', '2022-10-13 15:16:41', '2022-10-13 15:16:41', null, null, '1', '1', '0');
INSERT INTO `evaluacion_pun_exp` VALUES ('76', '1', '45146572', '2022-10-13 15:16:41', '2022-10-13 15:16:41', null, null, '1', '1', '0');
INSERT INTO `evaluacion_pun_exp` VALUES ('77', '1', '45146572', '2022-10-13 15:16:41', '2022-10-13 15:16:41', null, null, '1', '1', '0');
INSERT INTO `evaluacion_pun_exp` VALUES ('78', '1', '45146572', '2022-10-13 15:16:41', '2022-10-13 15:16:41', null, null, '1', '1', '0');
INSERT INTO `evaluacion_pun_exp` VALUES ('81', '1', '43597360', '2023-11-22 15:28:53', '2023-11-22 15:28:53', null, null, '1', '1', '1');

-- ----------------------------
-- Table structure for expedientes
-- ----------------------------
DROP TABLE IF EXISTS `expedientes`;
CREATE TABLE `expedientes` (
  `exp_id` int(11) NOT NULL AUTO_INCREMENT,
  `exp_numero` varchar(10) DEFAULT NULL,
  `exp_anio` int(4) DEFAULT NULL,
  `exp_codigo` varchar(25) DEFAULT NULL,
  `exp_remitente` varchar(250) DEFAULT NULL,
  `exp_documento` varchar(15) DEFAULT NULL,
  `exp_telefono1` varchar(12) DEFAULT NULL,
  `exp_telefono2` varchar(12) DEFAULT NULL,
  `exp_correo` varchar(400) DEFAULT NULL,
  `exp_esprinicipal` int(1) DEFAULT NULL,
  `exp_tipo` int(1) DEFAULT NULL COMMENT '1: evaluacion inicial\r\n2. reclamo',
  `exp_fechaCreacion` datetime DEFAULT NULL,
  `exp_fechaModificacion` datetime DEFAULT NULL,
  `exp_estado` int(1) DEFAULT NULL,
  PRIMARY KEY (`exp_id`)
) ENGINE=InnoDB AUTO_INCREMENT=138 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of expedientes
-- ----------------------------
INSERT INTO `expedientes` VALUES ('2', '59691', '2022', 'MPT2022-EXT-0059691', 'MADELEINE HAYDEE RIVERA CUZCO', '08125552', '999350067', '', 'mrivera@ugel05.edu.pe', '1', '1', '2022-09-28 04:32:08', null, '1');
INSERT INTO `expedientes` VALUES ('3', '59890', '2022', 'MPT2022-EXT-0059890', 'CARMEN ROSA SANCHEZ VILLAR', '07913657', '979886931', '', 'd07913657o@aprendoencasa.pe', '1', '1', '2022-09-28 04:39:25', null, '1');
INSERT INTO `expedientes` VALUES ('4', '59814', '2022', 'MPT2022-EXT-0059814', 'SABY OFELIA LLANOS ALMONACID', '09652817', '922396570', '', 'sllanos@ugel05.edu.pe', '1', '1', '2022-09-28 05:50:03', null, '1');
INSERT INTO `expedientes` VALUES ('5', '57940', '2022', 'MPT2022-EXT-0057940', 'SABY OFELIA LLANOS ALMONACID', '09652817', '922396570', '', 'sllanos@ugel05.edu.pe', '1', '1', '2022-09-28 05:50:03', null, '1');
INSERT INTO `expedientes` VALUES ('6', '58759', '2022', 'MPT2022-EXT-0058759', 'ALBERTO REYNOLDI ANGELES MACAVILCA', '07054303', '997405571', '', 'aangeles@ugel05.edu.pe', '1', '1', '2022-09-28 12:45:49', null, '1');
INSERT INTO `expedientes` VALUES ('7', '55671', '2022', 'MPT2022-EXT-0055671', 'ALBERTO REYNOLDI ANGELES MACAVILCA', '07054303', '997405571', '', 'aangeles@ugel05.edu.pe', '1', '1', '2022-09-28 12:45:49', null, '1');
INSERT INTO `expedientes` VALUES ('8', '59691', '2022', 'MPT2022-EXT-0059691', 'MADELEINE HAYDEE RIVERA CUZCO', '08125552', '999350067', '', 'mrivera@ugel05.edu.pe', '1', '1', '2022-09-29 00:51:49', null, '1');
INSERT INTO `expedientes` VALUES ('9', '59691', '2022', 'MPT2022-EXT-0059691', 'MADELEINE HAYDEE RIVERA CUZCO', '08125552', '999350067', '', 'mrivera@ugel05.edu.pe', '1', '1', '2022-09-29 01:15:12', null, '1');
INSERT INTO `expedientes` VALUES ('10', '57575', '2022', 'MPT2022-EXT-0057575', 'SABY OFELIA LLANOS ALMONACID', '09652817', '922396570', '', 'sllanos@ugel05.edu.pe', '1', '1', '2022-09-29 01:15:12', null, '1');
INSERT INTO `expedientes` VALUES ('11', '57153', '2022', 'MPT2022-EXT-0057153', 'SABY OFELIA LLANOS ALMONACID', '09652817', '922396570', '', 'sllanos@ugel05.edu.pe', '1', '1', '2022-09-29 01:15:12', null, '1');
INSERT INTO `expedientes` VALUES ('12', '55381', '2022', 'MPT2022-EXT-0055381', 'ALBERTO REYNOLDI ANGELES MACAVILCA', '07054303', '997405571', '', 'aangeles@ugel05.edu.pe', '1', '1', '2022-09-29 01:15:12', null, '1');
INSERT INTO `expedientes` VALUES ('13', '59691', '2022', 'MPT2022-EXT-0059691', 'MADELEINE HAYDEE RIVERA CUZCO', '08125552', '999350067', '', 'mrivera@ugel05.edu.pe', '1', '1', '2022-09-29 10:31:55', null, '1');
INSERT INTO `expedientes` VALUES ('14', '58563', '2022', 'MPT2022-EXT-0058563', 'MARISOL VERA ALVAREZ', '09560564', '966799294', '', 'marisolveraalvarez@hotmail.com', '1', '1', '2022-10-03 17:40:06', null, '1');
INSERT INTO `expedientes` VALUES ('15', '59944', '2022', 'MPT2022-EXT-0059944', 'NELLY NIEVES JAUREGUI FALCON DE ANDRADE', '09076839', '015949733', '965411521', 'njauregui@ugel05.edu.pe', '1', '1', '2022-10-05 11:23:43', null, '1');
INSERT INTO `expedientes` VALUES ('16', '59730', '2022', 'MPT2022-EXT-0059730', 'CARMEN ROSA GARMA CARDENAS', '07683102', '987985267', '932247552', 'camu_geminis@hotmail.com', '1', '1', '2022-10-05 11:23:44', null, '1');
INSERT INTO `expedientes` VALUES ('17', '59691', '2022', 'MPT2022-EXT-0059691', 'MADELEINE HAYDEE RIVERA CUZCO', '08125552', '999350067', '', 'mrivera@ugel05.edu.pe', '1', '1', '2022-10-05 11:23:44', null, '1');
INSERT INTO `expedientes` VALUES ('18', '59536', '2022', 'MPT2022-EXT-0059536', 'GUILMAR ASUNCION ESCOBAR CONDEÑA', '06767000', '947290899', '', 'gescobar@ugel05.edu.pe', '1', '1', '2022-10-05 11:23:44', null, '1');
INSERT INTO `expedientes` VALUES ('19', '59323', '2022', 'MPT2022-EXT-0059323', 'MILAGROS DE LOS ÁNGELES ESCRIBA GAMBOA', '71004124', '980973694', '', 'laescribae@gmail.com', '1', '1', '2022-10-05 11:23:44', null, '1');
INSERT INTO `expedientes` VALUES ('20', '59029', '2022', 'MPT2022-EXT-0059029', 'JANETH MARLENI MUÑOZ AGUSTÍN', '41004937', '927593834', '', 'mashosita@gmail.com', '1', '1', '2022-10-05 11:23:44', null, '1');
INSERT INTO `expedientes` VALUES ('21', '58926', '2022', 'MPT2022-EXT-0058926', 'JUAN MANUEL LAVADO DE LA CRUZ', '21080783', '964011034', '', 'juanlavado1961@gmail.com', '1', '1', '2022-10-05 11:23:44', null, '1');
INSERT INTO `expedientes` VALUES ('22', '58811', '2022', 'MPT2022-EXT-0058811', 'HUGO JAIME BENDEZU AMARO', '20111245', '985843645', '', 'hbendezu@ugel05.edu.pe', '1', '1', '2022-10-05 11:23:45', null, '1');
INSERT INTO `expedientes` VALUES ('23', '57952', '2022', 'MPT2022-EXT-0057952', 'MARISOL MILAGROS JAUREGUI GOMEZ', '41665991', '944269662', '', 'mmjaureguig@gmail.com', '1', '1', '2022-10-05 11:23:45', null, '1');
INSERT INTO `expedientes` VALUES ('24', '57852', '2022', 'MPT2022-EXT-0057852', 'MARITA LUCILA ROBLES GONZALES', '10366340', '013925420', '986036960', 'marirreth311061@gmail.com', '1', '1', '2022-10-05 11:23:45', null, '1');
INSERT INTO `expedientes` VALUES ('25', '57604', '2022', 'MPT2022-EXT-0057604', 'JUAN MANUEL LAVADO DE LA CRUZ', '21080783', '964011034', '', 'juan.lavado1961@gmail.com', '1', '1', '2022-10-05 11:23:45', null, '1');
INSERT INTO `expedientes` VALUES ('26', '57340', '2022', 'MPT2022-EXT-0057340', 'CARMEN DEL PILAR CASTAÑEDA AGUEDO', '15944085', '977517252', '', 'ccastaneda@ugel05.edu.pe', '1', '1', '2022-10-05 11:23:45', null, '1');
INSERT INTO `expedientes` VALUES ('27', '57257', '2022', 'MPT2022-EXT-0057257', 'MARIA ELENA CORNEJO GUEVARA', '09326612', '918042109', '997509666', 'mcornejo@ugel05.edu.pe', '1', '1', '2022-10-05 11:23:45', null, '1');
INSERT INTO `expedientes` VALUES ('28', '57184', '2022', 'MPT2022-EXT-0057184', 'JAVIER LUIS SOLIS CORALES', '41542924', '991995222', '993692808', 'javiersoliscorales1@gmail.com', '1', '1', '2022-10-05 11:23:46', null, '1');
INSERT INTO `expedientes` VALUES ('29', '55691', '2022', 'MPT2022-EXT-0055691', 'SILVIA MARGOTH LEDESMA AGURTO', '47025341', '916984381', '', 'feyalegria39@hotmail.com', '1', '1', '2022-10-05 11:23:46', null, '1');
INSERT INTO `expedientes` VALUES ('30', '55600', '2022', 'MPT2022-EXT-0055600', 'CELINDA ESTHER BAUTISTA ANTICONA', '09329335', '945156982', '', 'feyalegria26.2020@gmail.com', '1', '1', '2022-10-05 11:23:46', null, '1');
INSERT INTO `expedientes` VALUES ('31', '60105', '2022', 'MPT2022-EXT-0060105', 'MIRYAM KARIM ROJAS GUILLEN', '20034928', '969679175', '', 'mrojas@ugel05.edu.pe', '1', '1', '2022-10-05 11:57:52', null, '1');
INSERT INTO `expedientes` VALUES ('32', '58759', '2022', 'MPT2022-EXT-0058759', 'ALBERTO REYNOLDI ANGELES MACAVILCA', '07054303', '997405571', '', 'aangeles@ugel05.edu.pe', '1', '1', '2022-10-05 11:57:52', null, '1');
INSERT INTO `expedientes` VALUES ('33', '58432', '2022', 'MPT2022-EXT-0058432', 'YESSENIA GUILLEN NOLBERTO', '72123517', '902239530', '', 'cuteguillen@gmail.com', '1', '1', '2022-10-05 11:57:52', null, '1');
INSERT INTO `expedientes` VALUES ('34', '57589', '2022', 'MPT2022-EXT-0057589', 'ROSA MAGALLANES ORMEÑO', '71248172', '951653074', '', 'ie158santamaria.gestion2022@gmail.com', '1', '1', '2022-10-05 11:57:52', null, '1');
INSERT INTO `expedientes` VALUES ('35', '57449', '2022', 'MPT2022-EXT-0057449', 'MANUELA BECERRA BOLAÑOS', '43416085', '969532493', '', 'manuelabecerrabolanos9@gmail.com', '1', '1', '2022-10-05 11:57:52', null, '1');
INSERT INTO `expedientes` VALUES ('36', '56943', '2022', 'MPT2022-EXT-0056943', 'MORAYMA ÚRSULA ALIAGA MARMOLEJO', '19991524', '981530086', '', 'maliaga@ugel05.edu.pe', '1', '1', '2022-10-05 11:57:53', null, '1');
INSERT INTO `expedientes` VALUES ('37', '56413', '2022', 'MPT2022-EXT-0056413', 'MIRYAM KARIM ROJAS GUILLEN', '20034928', '969679175', '', 'mrojas@ugel05.edu.pe', '1', '1', '2022-10-05 11:57:53', null, '1');
INSERT INTO `expedientes` VALUES ('38', '55724', '2022', 'MPT2022-EXT-0055724', 'EMILY ARBIZU RODRIGUEZ', '41603575', '997782913', '', 'earbizu@ugel05.edu.pe', '1', '1', '2022-10-05 11:57:53', null, '1');
INSERT INTO `expedientes` VALUES ('39', '55671', '2022', 'MPT2022-EXT-0055671', 'ALBERTO REYNOLDI ANGELES MACAVILCA', '07054303', '997405571', '', 'aangeles@ugel05.edu.pe', '1', '1', '2022-10-05 11:57:53', null, '1');
INSERT INTO `expedientes` VALUES ('40', '55381', '2022', 'MPT2022-EXT-0055381', 'ALBERTO REYNOLDI ANGELES MACAVILCA', '07054303', '997405571', '', 'aangeles@ugel05.edu.pe', '1', '1', '2022-10-05 11:57:53', null, '1');
INSERT INTO `expedientes` VALUES ('41', '55298', '2022', 'MPT2022-EXT-0055298', 'GRETA HUAMANI DURAND', '45940353', '977892488', '', 'fiorecasella09@gmail.com', '1', '1', '2022-10-05 11:57:53', null, '1');
INSERT INTO `expedientes` VALUES ('42', '55188', '2022', 'MPT2022-EXT-0055188', 'MIRYAM KARIM ROJAS GUILLEN', '20034928', '969679175', '', 'mrojas@ugel05.edu.pe', '1', '1', '2022-10-05 11:57:54', null, '1');
INSERT INTO `expedientes` VALUES ('45', '55068', '2022', 'MPT2022-EXT-0055068', 'NORMA ERLINDA QUIÑONES SUAREZ', '20991248', '943997770', '', 'nquinones@ugel05.edu.pe', '1', '1', '2022-10-05 23:36:26', null, '1');
INSERT INTO `expedientes` VALUES ('46', '51965', '2022', 'MPT2022-EXT-0051965', 'NORMA ERLINDA QUIÑONES SUAREZ', '20991248', '943997770', '', 'nquinones@ugel05.edu.pe', '1', '1', '2022-10-05 23:37:54', null, '1');
INSERT INTO `expedientes` VALUES ('47', '55081', '2022', 'MPT2022-EXT-0055081', 'WILSON AGUILAR BARRANTES', '09667051', '961452420', '961452420', 'wilson2172abw@gmail.com', '1', '1', '2022-10-05 23:38:57', null, '1');
INSERT INTO `expedientes` VALUES ('48', '55047', '2022', 'MPT2022-EXT-0055047', 'YRENE YSABEL NICHO NAPA', '09095947', '951676235', '', 'ynicho@ugel05.edu.pe', '1', '1', '2022-10-05 23:38:57', null, '1');
INSERT INTO `expedientes` VALUES ('49', '55037', '2022', 'MPT2022-EXT-0055037', 'OCTAVIO ALCIBIADES BENDEZU VEGA', '09554915', '955364711', '', 'granoctavio2@hotmail.com', '1', '1', '2022-10-05 23:38:57', null, '1');
INSERT INTO `expedientes` VALUES ('50', '54983', '2022', 'MPT2022-EXT-0054983', 'CESAR AUGUSTO RODAS TELLO', '10357907', '940193610', '', 'crodas@ugel05.edu.pe', '1', '1', '2022-10-05 23:38:57', null, '1');
INSERT INTO `expedientes` VALUES ('51', '54932', '2022', 'MPT2022-EXT-0054932', 'SABY OFELIA LLANOS ALMONACID', '09652817', '922396570', '', 'sllanos@ugel05.edu.pe', '1', '1', '2022-10-05 23:38:57', null, '1');
INSERT INTO `expedientes` VALUES ('52', '54770', '2022', 'MPT2022-EXT-0054770', 'YRENE YSABEL NICHO NAPA', '09095947', '951676235', '', 'ynicho@ugel05.edu.pe', '1', '1', '2022-10-05 23:38:58', null, '1');
INSERT INTO `expedientes` VALUES ('53', '54729', '2022', 'MPT2022-EXT-0054729', 'FRANCISCO CERDAN', '10763119', '945964252', '', 'fabanto@ugel05.edu.pe', '1', '1', '2022-10-05 23:38:58', null, '1');
INSERT INTO `expedientes` VALUES ('54', '54702', '2022', 'MPT2022-EXT-0054702', 'LUCAS NESTOR PEREZ SALGADO', '09512157', '977416413', '', 'lperez@ugel05.edu.pe', '1', '1', '2022-10-05 23:38:58', null, '1');
INSERT INTO `expedientes` VALUES ('55', '54696', '2022', 'MPT2022-EXT-0054696', 'ANGELITA VILLANUEVA  VELASQUEZ', '08288872', '996871218', '', 'avillanueva@ugel05.edu.pe', '1', '1', '2022-10-05 23:38:58', null, '1');
INSERT INTO `expedientes` VALUES ('56', '54668', '2022', 'MPT2022-EXT-0054668', 'ELIZABETH LUCÍA PAITAN COMPI', '10119136', '987924689', '', 'epaitancompi@gmail.com', '1', '1', '2022-10-05 23:41:26', null, '1');
INSERT INTO `expedientes` VALUES ('57', '54646', '2022', 'MPT2022-EXT-0054646', 'BERSABET YANIRA VILLALOBOS CACERES', '47395488', '926819536', '', 'mesadepartes.ie0009jma@gmail.com', '1', '1', '2022-10-05 23:41:26', null, '1');
INSERT INTO `expedientes` VALUES ('58', '54621', '2022', 'MPT2022-EXT-0054621', 'FELIMON ANGEL DAMIAN CHUMBE', '09332301', '994455872', '', 'fadch_66@hotmail.com', '1', '1', '2022-10-05 23:41:26', null, '1');
INSERT INTO `expedientes` VALUES ('59', '54647', '2022', 'MPT2022-EXT-0054647', 'JACQUELINE TEODORA VEGA HUANCA', '09427758', '945520374', '', 'jvega@ugel05.edu.pe', '1', '1', '2022-10-05 23:41:26', null, '1');
INSERT INTO `expedientes` VALUES ('60', '54616', '2022', 'MPT2022-EXT-0054616', 'BERSABET YANIRA VILLALOBOS CACERES', '47395488', '926819536', '', 'mesadepartes.ie0009jma@gmail.com', '1', '1', '2022-10-05 23:41:27', null, '1');
INSERT INTO `expedientes` VALUES ('61', '54573', '2022', 'MPT2022-EXT-0054573', 'LUISA VERÓNICA POMA', '10678533', '965768588', '965768588', 'llahuana@ugel05.edu.pe', '1', '1', '2022-10-05 23:41:27', null, '1');
INSERT INTO `expedientes` VALUES ('62', '54556', '2022', 'MPT2022-EXT-0054556', 'WUILVER GABRIEL HERNANDEZ PARADO', '08867819', '960733869', '', 'mesadepartes.ie1044@gmail.com', '1', '1', '2022-10-05 23:41:27', null, '1');
INSERT INTO `expedientes` VALUES ('63', '54558', '2022', 'MPT2022-EXT-0054558', 'CLETO ROCA TAPIA', '31543158', '945196092', '', 'mesadepartes151mb@gmail.com', '1', '1', '2022-10-05 23:41:27', null, '1');
INSERT INTO `expedientes` VALUES ('64', '54544', '2022', 'MPT2022-EXT-0054544', 'CESAR ALBERTO SANTIAGO ESPINOZA', '09784963', '948896378', '', 'csantiago@ugel05.edu.pe', '1', '1', '2022-10-05 23:41:27', null, '1');
INSERT INTO `expedientes` VALUES ('65', '54499', '2022', 'MPT2022-EXT-0054499', 'NANCY DEL PILAR VALLADOLID ZETA', '10723417', '985628522', '', 'nvalladolid@ugel05.edu.pe', '1', '1', '2022-10-05 23:41:27', null, '1');
INSERT INTO `expedientes` VALUES ('66', '54427', '2022', 'MPT2022-EXT-0054427', 'SABY OFELIA LLANOS ALMONACID', '09652817', '922396570', '', 'sllanos@ugel05.edu.pe', '1', '1', '2022-10-05 23:54:01', null, '1');
INSERT INTO `expedientes` VALUES ('67', '54236', '2022', 'MPT2022-EXT-0054236', 'WUILVER GABRIEL HERNANDEZ PARADO', '08867819', '960733869', '', 'mesadepartes.ie1044@gmail.com', '1', '1', '2022-10-05 23:54:01', null, '1');
INSERT INTO `expedientes` VALUES ('68', '54232', '2022', 'MPT2022-EXT-0054232', 'OCTAVIO ALCIBIADES BENDEZU VEGA', '09554915', '955364711', '', 'granoctavio2@hotmail.com', '1', '1', '2022-10-05 23:54:01', null, '1');
INSERT INTO `expedientes` VALUES ('69', '60127', '2022', 'MPT2022-EXT-0060127', 'HAYDEE GLADYS HUARINGA SANTIAGO', '04065092', '947453496', '', 'hhuaringa@ugel05.edu.pe', '1', '1', '2022-10-11 09:46:21', null, '1');
INSERT INTO `expedientes` VALUES ('70', '60123', '2022', 'MPT2022-EXT-0060123', 'HAYDEE GLADYS HUARINGA SANTIAGO', '04065092', '947453496', '', 'hhuaringa@ugel05.edu.pe', '1', '1', '2022-10-11 09:46:22', null, '1');
INSERT INTO `expedientes` VALUES ('71', '60090', '2022', 'MPT2022-EXT-0060090', 'JUDITH ROSARIO ESCALANTE VILLANUEVA', '16128674', '991275445', '', 'jescalante@ugel05.edu.pe', '1', '1', '2022-10-11 09:46:22', null, '1');
INSERT INTO `expedientes` VALUES ('72', '59890', '2022', 'MPT2022-EXT-0059890', 'CARMEN ROSA SANCHEZ VILLAR', '07913657', '979886931', '', 'd07913657o@aprendoencasa.pe', '1', '1', '2022-10-11 09:46:22', null, '1');
INSERT INTO `expedientes` VALUES ('73', '59654', '2022', 'MPT2022-EXT-0059654', 'YRENE YSABEL NICHO NAPA', '09095947', '951676235', '', 'ynicho@ugel05.edu.pe', '1', '1', '2022-10-11 09:46:22', null, '1');
INSERT INTO `expedientes` VALUES ('74', '59433', '2022', 'MPT2022-EXT-0059433', 'MARÍA PÍA RIOS ROSALES', '70457623', '936881576', '', 'mariapiariosrosales@gmail.com', '1', '1', '2022-10-11 09:46:22', null, '1');
INSERT INTO `expedientes` VALUES ('75', '59276', '2022', 'MPT2022-EXT-0059276', 'LUCAS NESTOR PEREZ SALGADO', '09512157', '977416413', '', 'lperez@ugel05.edu.pe', '1', '1', '2022-10-11 09:46:22', null, '1');
INSERT INTO `expedientes` VALUES ('76', '59151', '2022', 'MPT2022-EXT-0059151', 'PEDRO PAULINO PATRICIO SUDARIO', '09333438', '991577645', '', 'ppatricio@ugel05.edu.pe', '1', '1', '2022-10-11 09:46:22', null, '1');
INSERT INTO `expedientes` VALUES ('77', '58879', '2022', 'MPT2022-EXT-0058879', 'REBECA NELLY DIAZ RODRIGUEZ', '07275186', '997272012', '', 'rdiaz@ugel05.edu.pe', '1', '1', '2022-10-11 09:46:23', null, '1');
INSERT INTO `expedientes` VALUES ('78', '58514', '2022', 'MPT2022-EXT-0058514', 'DEISSY MAGALI ASCANIO YSHUISA', '41660893', '933323408', '013870628', 'deissymagali@gmail.com', '1', '1', '2022-10-11 09:46:23', null, '1');
INSERT INTO `expedientes` VALUES ('79', '57968', '2022', 'MPT2022-EXT-0057968', 'JAVIER ELEODORO CORNEJO VARGAS', '42349100', '936060714', '', 'javiercornejovargas@gmail.com', '1', '1', '2022-10-11 09:46:23', null, '1');
INSERT INTO `expedientes` VALUES ('80', '57889', '2022', 'MPT2022-EXT-0057889', 'MARIA GLORIA HARO MIÑANO', '07968040', '948177855', '', 'mharo@ugel05.edu.pe', '1', '1', '2022-10-11 09:46:23', null, '1');
INSERT INTO `expedientes` VALUES ('81', '57888', '2022', 'MPT2022-EXT-0057888', 'JUDITH ROSARIO ESCALANTE VILLANUEVA', '16128674', '991275445', '', 'jescalante@ugel05.edu.pe', '1', '1', '2022-10-11 09:46:23', null, '1');
INSERT INTO `expedientes` VALUES ('82', '57890', '2022', 'MPT2022-EXT-0057890', 'FELIX AGUSTIN CARRIZALES MORENO', '09247360', '988878398', '', 'fcarrizales@ugel05.edu.pe', '1', '1', '2022-10-11 09:46:23', null, '1');
INSERT INTO `expedientes` VALUES ('83', '57599', '2022', 'MPT2022-EXT-0057599', 'LUCAS NESTOR PEREZ SALGADO', '09512157', '977416413', '', 'lperez@ugel05.edu.pe', '1', '1', '2022-10-11 09:46:24', null, '1');
INSERT INTO `expedientes` VALUES ('84', '57451', '2022', 'MPT2022-EXT-0057451', 'LUCAS NESTOR PEREZ SALGADO', '09512157', '977416413', '', 'lperez@ugel05.edu.pe', '1', '1', '2022-10-11 09:46:24', null, '1');
INSERT INTO `expedientes` VALUES ('85', '57272', '2022', 'MPT2022-EXT-0057272', 'PEDRO PAULINO PATRICIO SUDARIO', '09333438', '991577645', '', 'ppatricio@ugel05.edu.pe', '1', '1', '2022-10-11 09:46:24', null, '1');
INSERT INTO `expedientes` VALUES ('86', '57003', '2022', 'MPT2022-EXT-0057003', 'KATHERINE ISABEL CRUCES SARRIA', '42972596', '956986837', '', 'katherinecruces4@gmail.com', '1', '1', '2022-10-11 09:46:24', null, '1');
INSERT INTO `expedientes` VALUES ('87', '56952', '2022', 'MPT2022-EXT-0056952', 'ANGELITA VILLANUEVA  VELASQUEZ', '08288872', '996871218', '', 'avillanueva@ugel05.edu.pe', '1', '1', '2022-10-11 09:46:24', null, '1');
INSERT INTO `expedientes` VALUES ('88', '56468', '2022', 'MPT2022-EXT-0056468', 'JUAN FELICIANO HUARCAYA VALENTIN', '41129346', '970973620', '', 'jhuarcaya@ugel05.edu.pe', '1', '1', '2022-10-11 09:46:24', null, '1');
INSERT INTO `expedientes` VALUES ('89', '56285', '2022', 'MPT2022-EXT-0056285', 'MARY CRUZ GOMEZ SIPION', '16586080', '990111783', '', 'mgomez@ugel05.edu.pe', '1', '1', '2022-10-11 09:46:24', null, '1');
INSERT INTO `expedientes` VALUES ('90', '56231', '2022', 'MPT2022-EXT-0056231', 'LUCAS NESTOR PEREZ SALGADO', '09512157', '977416413', '', 'lperez@ugel05.edu.pe', '1', '1', '2022-10-11 09:46:25', null, '1');
INSERT INTO `expedientes` VALUES ('91', '56107', '2022', 'MPT2022-EXT-0056107', 'JUDITH ROSARIO ESCALANTE VILLANUEVA', '16128674', '991275445', '', 'jescalante@ugel05.edu.pe', '1', '1', '2022-10-11 09:46:25', null, '1');
INSERT INTO `expedientes` VALUES ('92', '55823', '2022', 'MPT2022-EXT-0055823', 'FELIX AGUSTIN CARRIZALES MORENO', '09247360', '988878398', '', 'fcarrizales@ugel05.edu.pe', '1', '1', '2022-10-11 09:46:25', null, '1');
INSERT INTO `expedientes` VALUES ('93', '55821', '2022', 'MPT2022-EXT-0055821', 'FELIX AGUSTIN CARRIZALES MORENO', '09247360', '988878398', '', 'fcarrizales@ugel05.edu.pe', '1', '1', '2022-10-11 09:46:25', null, '1');
INSERT INTO `expedientes` VALUES ('94', '55255', '2022', 'MPT2022-EXT-0055255', 'WUILVER GABRIEL HERNANDEZ PARADO', '08867819', '960733869', '', 'mesadepartes.ie1044@gmail.com', '1', '1', '2022-10-11 09:46:25', null, '1');
INSERT INTO `expedientes` VALUES ('95', '55222', '2022', 'MPT2022-EXT-0055222', 'WUILVER GABRIEL HERNANDEZ PARADO', '08867819', '960733869', '', 'mesadepartes.ie1044@gmail.com', '1', '1', '2022-10-11 09:46:25', null, '1');
INSERT INTO `expedientes` VALUES ('96', '55182', '2022', 'MPT2022-EXT-0055182', 'LILA LUZ MORENO SANCHEZ', '08293556', '990991498', '014595927', 'lmoreno@ugel05.edu.pe', '1', '1', '2022-10-11 09:46:26', null, '1');
INSERT INTO `expedientes` VALUES ('97', '51638', '2022', 'MPT2022-EXT-0051638', 'YRENE YSABEL NICHO NAPA', '09095947', '951676235', '', 'ynicho@ugel05.edu.pe', '1', '1', '2022-10-11 09:46:26', null, '1');
INSERT INTO `expedientes` VALUES ('98', '50941', '2022', 'MPT2022-EXT-0050941', 'JUDITH ROSARIO ESCALANTE VILLANUEVA', '16128674', '991275445', '', 'jescalante@ugel05.edu.pe', '1', '1', '2022-10-11 09:46:26', null, '1');
INSERT INTO `expedientes` VALUES ('99', '50003', '2022', 'MPT2022-EXT-0050003', 'PEDRO PAULINO PATRICIO SUDARIO', '09333438', '991577645', '', 'ppatricio@ugel05.edu.pe', '1', '1', '2022-10-11 09:46:26', null, '1');
INSERT INTO `expedientes` VALUES ('100', '49851', '2022', 'MPT2022-EXT-0049851', 'JUDITH ROSARIO ESCALANTE VILLANUEVA', '16128674', '991275445', '', 'jescalante@ugel05.edu.pe', '1', '1', '2022-10-11 09:46:26', null, '1');
INSERT INTO `expedientes` VALUES ('101', '49478', '2022', 'MPT2022-EXT-0049478', 'PEDRO PAULINO PATRICIO SUDARIO', '09333438', '991577645', '', 'ppatricio@ugel05.edu.pe', '1', '1', '2022-10-11 09:46:26', null, '1');
INSERT INTO `expedientes` VALUES ('102', '49277', '2022', 'MPT2022-EXT-0049277', 'LILA LUZ MORENO SANCHEZ', '08293556', '990991498', '014595927', 'lmoreno@ugel05.edu.pe', '1', '1', '2022-10-11 09:46:26', null, '1');
INSERT INTO `expedientes` VALUES ('103', '59433', '2022', 'MPT2022-EXT-0059433', 'MARÍA PÍA RIOS ROSALES', '70457623', '936881576', '', 'mariapiariosrosales@gmail.com', '1', '1', '2022-10-11 09:49:07', null, '1');
INSERT INTO `expedientes` VALUES ('104', '58879', '2022', 'MPT2022-EXT-0058879', 'REBECA NELLY DIAZ RODRIGUEZ', '07275186', '997272012', '', 'rdiaz@ugel05.edu.pe', '1', '1', '2022-10-11 09:49:07', null, '1');
INSERT INTO `expedientes` VALUES ('105', '57889', '2022', 'MPT2022-EXT-0057889', 'MARIA GLORIA HARO MIÑANO', '07968040', '948177855', '', 'mharo@ugel05.edu.pe', '1', '1', '2022-10-11 09:49:07', null, '1');
INSERT INTO `expedientes` VALUES ('106', '60106', '2022', 'MPT2022-EXT-0060106', 'ELVA RUTH SALAZAR', '10351990', '959364898', '', 'emunguia@ugel05.edu.pe', '1', '1', '2022-10-11 09:55:34', null, '1');
INSERT INTO `expedientes` VALUES ('107', '60056', '2022', 'MPT2022-EXT-0060056', 'MILAGROS MARITZA ÑAUPARI', '09770531', '958547343', '', 'mfernandez@ugel05.edu.pe', '1', '1', '2022-10-11 09:55:34', null, '1');
INSERT INTO `expedientes` VALUES ('108', '60049', '2022', 'MPT2022-EXT-0060049', 'MANUEL TASAYCO ATUNCAR', '21802177', '984178048', '', 'mtasayco@ugel05.edu.pe', '1', '1', '2022-10-11 09:55:34', null, '1');
INSERT INTO `expedientes` VALUES ('109', '60020', '2022', 'MPT2022-EXT-0060020', 'MILAGROS MARITZA ÑAUPARI', '09770531', '958547343', '', 'mfernandez@ugel05.edu.pe', '1', '1', '2022-10-11 09:55:34', null, '1');
INSERT INTO `expedientes` VALUES ('110', '60017', '2022', 'MPT2022-EXT-0060017', 'LUISA VERÓNICA POMA', '10678533', '965768588', '965768588', 'llahuana@ugel05.edu.pe', '1', '1', '2022-10-11 09:55:35', null, '1');
INSERT INTO `expedientes` VALUES ('111', '59893', '2022', 'MPT2022-EXT-0059893', 'NAIBETO VEGA VILLAORDUÑA', '09569343', '970888692', '', 'secundariamesadepartesiefbc@gmail.com', '1', '1', '2022-10-11 09:55:35', null, '1');
INSERT INTO `expedientes` VALUES ('112', '59866', '2022', 'MPT2022-EXT-0059866', 'NAIBETO VEGA VILLAORDUÑA', '09569343', '970888692', '', 'secundariamesadepartesiefbc@gmail.com', '1', '1', '2022-10-11 09:55:35', null, '1');
INSERT INTO `expedientes` VALUES ('113', '59814', '2022', 'MPT2022-EXT-0059814', 'SABY OFELIA LLANOS ALMONACID', '09652817', '922396570', '', 'sllanos@ugel05.edu.pe', '1', '1', '2022-10-11 09:55:35', null, '1');
INSERT INTO `expedientes` VALUES ('114', '59705', '2022', 'MPT2022-EXT-0059705', 'ROMÁN CÓRDOVA JESÚS', '09099691', '994540290', '', 'rcordova@ugel05.edu.pe', '1', '1', '2022-10-11 09:55:35', null, '1');
INSERT INTO `expedientes` VALUES ('115', '59354', '2022', 'MPT2022-EXT-0059354', 'NELLY CAROLINA CAUNALLA CALLOHUANCA', '10130084', '994495469', '', 'ncaunalla@ugel05.edu.pe', '1', '1', '2022-10-11 09:55:35', null, '1');
INSERT INTO `expedientes` VALUES ('116', '57950', '2022', 'MPT2022-EXT-0057950', 'PERCY ROJAS SHUPINGAHUA', '40713080', '959197297', '959197297', 'falconi09@hotmail.com', '1', '1', '2022-10-13 15:02:46', null, '1');
INSERT INTO `expedientes` VALUES ('117', '57706', '2022', 'MPT2022-EXT-0057706', 'FRANCISCO CERDAN', '10763119', '945964252', '', 'fabanto@ugel05.edu.pe', '1', '1', '2022-10-13 15:02:46', null, '1');
INSERT INTO `expedientes` VALUES ('118', '57615', '2022', 'MPT2022-EXT-0057615', 'FRANCISCO CERDAN', '10763119', '945964252', '', 'fabanto@ugel05.edu.pe', '1', '1', '2022-10-13 15:02:46', null, '1');
INSERT INTO `expedientes` VALUES ('119', '57282', '2022', 'MPT2022-EXT-0057282', 'LUISA VERÓNICA POMA', '10678533', '965768588', '965768588', 'llahuana@ugel05.edu.pe', '1', '1', '2022-10-13 15:02:47', null, '1');
INSERT INTO `expedientes` VALUES ('120', '56471', '2022', 'MPT2022-EXT-0056471', 'GERMÁN ROSPIGLIOSI', '21876096', '987145240', '', 'ggaldos@ugel05.edu.pe', '1', '1', '2022-10-13 15:02:47', null, '1');
INSERT INTO `expedientes` VALUES ('121', '56470', '2022', 'MPT2022-EXT-0056470', 'GERMÁN ROSPIGLIOSI', '21876096', '987145240', '', 'ggaldos@ugel05.edu.pe', '1', '1', '2022-10-13 15:02:47', null, '1');
INSERT INTO `expedientes` VALUES ('122', '56306', '2022', 'MPT2022-EXT-0056306', 'NICOLAS CARPIO SANCHEZ', '10657021', '940145581', '', 'ncarpio@ugel05.edu.pe', '1', '1', '2022-10-13 15:02:47', null, '1');
INSERT INTO `expedientes` VALUES ('123', '55615', '2022', 'MPT2022-EXT-0055615', 'ROSA REQUEJO VASQUEZ', '09207009', '968033225', '968033225', 'rrequejo@feyalegria37.edu.pe', '1', '1', '2022-10-13 15:02:47', null, '1');
INSERT INTO `expedientes` VALUES ('124', '55258', '2022', 'MPT2022-EXT-0055258', 'ALICIA HUALLPA CACERES', '09201805', '992944331', '', 'tramiteshb112@gmail.com', '1', '1', '2022-10-13 15:02:47', null, '1');
INSERT INTO `expedientes` VALUES ('125', '44790', '2022', 'MPT2022-EXT-0044790', 'SABY OFELIA LLANOS ALMONACID', '09652817', '922396570', '', 'sllanos@ugel05.edu.pe', '1', '1', '2022-10-13 15:15:22', null, '1');
INSERT INTO `expedientes` VALUES ('126', '44771', '2022', 'MPT2022-EXT-0044771', 'MARITHSABEL ESPINOZA OSTOS', '41695705', '981928291', '', 'mespinozao@ugel05.edu.pe', '1', '1', '2022-10-13 15:15:22', null, '1');
INSERT INTO `expedientes` VALUES ('127', '44764', '2022', 'MPT2022-EXT-0044764', 'MARIA VICTORIA VALERIO QUINTO', '04073637', '937763652', '', 'valerioquintov@gmail.com', '1', '1', '2022-10-13 15:15:22', null, '1');
INSERT INTO `expedientes` VALUES ('128', '44753', '2022', 'MPT2022-EXT-0044753', 'MARIA VICTORIA VALERIO QUINTO', '04073637', '937763652', '', 'valerioquintov@gmail.com', '1', '1', '2022-10-13 15:15:22', null, '1');
INSERT INTO `expedientes` VALUES ('129', '44752', '2022', 'MPT2022-EXT-0044752', 'RAUL JOSE SERMEÑO CAMARA', '28993058', '993453130', '013888369', 'mesadepartesramiropriale@gmail.com', '1', '1', '2022-10-13 15:15:22', null, '1');
INSERT INTO `expedientes` VALUES ('130', '44741', '2022', 'MPT2022-EXT-0044741', 'ANGELA ROSARIO GONZALES GUERRA', '10418815', '941435405', '', 'agonzales@ugel05.edu.pe', '1', '1', '2022-10-13 15:15:23', null, '1');
INSERT INTO `expedientes` VALUES ('131', '44714', '2022', 'MPT2022-EXT-0044714', 'MARIA VICTORIA VALERIO QUINTO', '04073637', '937763652', '', 'valerioquintov@gmail.com', '1', '1', '2022-10-13 15:15:23', null, '1');
INSERT INTO `expedientes` VALUES ('132', '44700', '2022', 'MPT2022-EXT-0044700', 'ANGELA ROSARIO GONZALES GUERRA', '10418815', '941435405', '', 'agonzales@ugel05.edu.pe', '1', '1', '2022-10-13 15:15:23', null, '1');
INSERT INTO `expedientes` VALUES ('133', '44630', '2022', 'MPT2022-EXT-0044630', 'ANA MARIA ALBORNOZ CHAVEZ', '09204166', '999966352', '', 'aalbornoz@ugel05.edu.pe', '1', '1', '2022-10-13 15:15:23', null, '1');
INSERT INTO `expedientes` VALUES ('134', '44508', '2022', 'MPT2022-EXT-0044508', 'RAFAEL MALAVER YUPANQUI', '10764838', '960736102', '972052354', 'ramayu2012@hotmail.com', '1', '1', '2022-10-13 15:15:23', null, '1');
INSERT INTO `expedientes` VALUES ('135', '44289', '2022', 'MPT2022-EXT-0044289', 'FANNY MARGOT CASTILLO VILLANUEVA', '09793633', '997754261', '', 'fannycastillovillanueva@gmail.com', '1', '1', '2022-10-13 15:15:23', null, '1');
INSERT INTO `expedientes` VALUES ('136', '58352', '2022', 'MPT2022-EXT-0058352', 'MARCELA SANDOVAL PÉREZ', '41077305', '993332353', '', 'eventosycatering81@gmail.com', '1', '1', '2022-11-21 20:14:10', null, '1');
INSERT INTO `expedientes` VALUES ('137', '57950', '2022', 'MPT2022-EXT-0057950', 'PERCY ROJAS SHUPINGAHUA', '40713080', '959197297', '959197297', 'falconi09@hotmail.com', '1', '1', '2022-11-21 20:14:11', null, '1');

-- ----------------------------
-- Table structure for ficha
-- ----------------------------
DROP TABLE IF EXISTS `ficha`;
CREATE TABLE `ficha` (
  `fic_id` int(11) NOT NULL AUTO_INCREMENT,
  `fic_descripcion` varchar(50) DEFAULT NULL,
  `fic_estado` int(1) DEFAULT NULL,
  PRIMARY KEY (`fic_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ficha
-- ----------------------------
INSERT INTO `ficha` VALUES ('1', 'Ficha 2022 - Anexo 10', '1');

-- ----------------------------
-- Table structure for grupo_inscripcion
-- ----------------------------
DROP TABLE IF EXISTS `grupo_inscripcion`;
CREATE TABLE `grupo_inscripcion` (
  `gin_id` int(11) NOT NULL AUTO_INCREMENT,
  `procesos_pro_id` int(11) NOT NULL,
  `periodos_per_id` int(11) NOT NULL,
  `especialidades_esp_id` int(11) NOT NULL,
  `gin_estado` int(1) DEFAULT NULL,
  PRIMARY KEY (`gin_id`),
  KEY `fk_grupo_inscripcion_procesos1_idx` (`procesos_pro_id`),
  KEY `fk_grupo_inscripcion_especialidades1_idx` (`especialidades_esp_id`),
  KEY `fk_grupo_inscripcion_periodos1_idx` (`periodos_per_id`),
  CONSTRAINT `fk_grupo_inscripcion_especialidades1` FOREIGN KEY (`especialidades_esp_id`) REFERENCES `especialidades` (`esp_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_grupo_inscripcion_periodos1` FOREIGN KEY (`periodos_per_id`) REFERENCES `periodos` (`per_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_grupo_inscripcion_procesos1` FOREIGN KEY (`procesos_pro_id`) REFERENCES `procesos` (`pro_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of grupo_inscripcion
-- ----------------------------
INSERT INTO `grupo_inscripcion` VALUES ('1', '1', '1', '1', '1');
INSERT INTO `grupo_inscripcion` VALUES ('2', '1', '1', '2', '1');
INSERT INTO `grupo_inscripcion` VALUES ('3', '1', '1', '3', '1');
INSERT INTO `grupo_inscripcion` VALUES ('4', '1', '1', '4', '1');
INSERT INTO `grupo_inscripcion` VALUES ('5', '1', '1', '5', '1');
INSERT INTO `grupo_inscripcion` VALUES ('6', '1', '1', '6', '1');
INSERT INTO `grupo_inscripcion` VALUES ('7', '1', '1', '7', '1');
INSERT INTO `grupo_inscripcion` VALUES ('8', '1', '1', '8', '1');
INSERT INTO `grupo_inscripcion` VALUES ('9', '1', '1', '9', '1');
INSERT INTO `grupo_inscripcion` VALUES ('10', '1', '1', '10', '1');
INSERT INTO `grupo_inscripcion` VALUES ('11', '1', '1', '11', '1');
INSERT INTO `grupo_inscripcion` VALUES ('12', '1', '1', '12', '1');
INSERT INTO `grupo_inscripcion` VALUES ('13', '1', '1', '13', '1');
INSERT INTO `grupo_inscripcion` VALUES ('14', '1', '1', '14', '1');
INSERT INTO `grupo_inscripcion` VALUES ('15', '1', '1', '15', '0');

-- ----------------------------
-- Table structure for localie
-- ----------------------------
DROP TABLE IF EXISTS `localie`;
CREATE TABLE `localie` (
  `loc_id` int(11) NOT NULL,
  `loc_codigo` varchar(7) DEFAULT NULL,
  `loc_red` int(2) DEFAULT NULL,
  `loc_gestion` varchar(100) DEFAULT NULL,
  `loc_depgest` varchar(100) DEFAULT NULL,
  `loc_distrito` varchar(100) DEFAULT NULL,
  `loc_cpoblado` varchar(150) DEFAULT NULL,
  `loc_direccion` varchar(200) DEFAULT NULL,
  `loc_referencia` varchar(200) DEFAULT NULL,
  `loc_web` varchar(100) DEFAULT NULL,
  `loc_aniocreacion` int(4) DEFAULT NULL,
  `loc_rdcreacion` varchar(80) DEFAULT NULL,
  `loc_convenio` int(1) DEFAULT '0',
  `loc_latitudx` double DEFAULT NULL,
  `loc_longitudy` double DEFAULT NULL,
  `loc_estado` int(1) DEFAULT '1',
  `loc_aniobaja` int(4) DEFAULT '2100',
  `loc_uscreado` int(11) DEFAULT NULL,
  `loc_fcreado` datetime DEFAULT NULL,
  `loc_usmodif` int(11) DEFAULT NULL,
  `loc_fmodif` datetime DEFAULT NULL,
  PRIMARY KEY (`loc_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of localie
-- ----------------------------
INSERT INTO `localie` VALUES ('1', '323769', '1', 'Pública de gestión directa', 'Pública - Sector Educación', 'San Juan de Lurigancho', 'ZARATE', 'AVENIDA CAJAMARQUILLA S/N', '', '', '1979', 'R.D.Zonal. 01  Nº 03629', '0', '-12.02285', '-76.98596', '1', '0', '0', '0000-00-00 00:00:00', '1', '2021-06-17 10:17:49');
INSERT INTO `localie` VALUES ('2', '323793', '1', 'Pública de gestión directa', 'Pública - Sector Educación', 'San Juan de Lurigancho', 'ZARATE', 'JIRON YACHAYHUASI S/N', '', '', '1979', 'R.D.Z. 01 Nº 03629', '0', '-12.02552', '-76.99776', '1', '0', '0', '0000-00-00 00:00:00', '1', '2018-04-27 15:58:28');
INSERT INTO `localie` VALUES ('3', '323953', '1', 'Pública de gestión directa', 'Pública - Sector Educación', 'San Juan de Lurigancho', 'MANGOMARCA', 'AVENIDA TEMPLO DE LUNA S/N', '', '', '1982', 'R.D.Z. Nº 03878', '0', '-12.0102', '-76.9799', '1', '0', '0', '0000-00-00 00:00:00', '1', '2018-04-27 15:59:03');
INSERT INTO `localie` VALUES ('4', '324014', '1', 'Pública de gestión directa', 'Pública - Otro Sector Público', 'San Juan de Lurigancho', 'MANGOMARCA', 'JIRON SOCHIN MZ C1 LOTE 35', '', '', '1985', 'R.D.Z. Nº 00571 Y R.D. USE 03 Nº 00148', '0', '-12.00852', '-76.98364', '1', '0', '0', '0000-00-00 00:00:00', '1', '2018-04-27 16:00:35');
INSERT INTO `localie` VALUES ('5', '325419', '1', 'Pública de gestión directa', 'Pública - Sector Educación', 'San Juan de Lurigancho', 'ZARATE', 'JIRON LOS AMAUTAS 248', '', '', '1965', 'R.M. Nº  01505 Y R.M.Nº138', '0', '-12.02861', '-77.00994', '1', '0', '0', '0000-00-00 00:00:00', '1', '2018-04-27 16:13:14');
INSERT INTO `localie` VALUES ('6', '325278', '1', 'Pública de gestión directa', 'Pública - Otro Sector Público', 'San Juan de Lurigancho', 'MANGOMARCA', 'AVENIDA LAS LOMAS S/N', '', '', '1978', 'R.D.Nº 02944 Y R.D USE 05 N° 00265', '0', '-12.01139', '-76.98282', '1', '0', '0', '0000-00-00 00:00:00', '1', '2018-04-27 16:12:16');
INSERT INTO `localie` VALUES ('7', '325259', '1', 'Pública de gestión directa', 'Pública - Sector Educación', 'San Juan de Lurigancho', 'ZARATE', 'AVENIDA GRAN CHIMU S/N', '', '', '1970', 'R.M. Nº 01937 Y  R.D. Nº 03667', '0', '-12.02482', '-76.9974', '1', '0', '0', '0000-00-00 00:00:00', '1', '2018-04-27 16:11:03');
INSERT INTO `localie` VALUES ('8', '324561', '1', 'Pública de gestión directa', 'Pública - Sector Educación', 'San Juan de Lurigancho', 'MANGOMARCA', 'JIRON PALLKA', '', '', '1979', 'R.D. Nº 00734 Y R.D.Z. Nº 05333 Y RDR N°2175', '0', '-12.01538', '-76.9852', '1', '0', '0', '0000-00-00 00:00:00', '1', '2018-04-27 16:04:59');
INSERT INTO `localie` VALUES ('9', '324429', '1', 'Pública de gestión directa', 'Pública - Sector Educación', 'San Juan de Lurigancho', 'ZARATE', 'AVENIDA LOS AMAUTAS 1560', '', '', '1972', 'R.M. Nº 01287 Y R.D.USE 03 Nº 00771', '0', '-12.02453', '-76.98722', '1', '0', '0', '0000-00-00 00:00:00', '1', '2018-04-27 16:02:16');
INSERT INTO `localie` VALUES ('10', '325179', '1', 'Pública de gestión directa', 'Pública - Sector Educación', 'San Juan de Lurigancho', 'ZARATE', 'JIRON HUILLCA QUIRO 441', '', '', '1969', 'R.M. Nº 09919 Y R.M. Nº 02503', '0', '-12.02404', '-76.99925', '1', '0', '0', '0000-00-00 00:00:00', '1', '2018-04-27 16:08:33');
INSERT INTO `localie` VALUES ('11', '325099', '1', 'Pública de gestión directa', 'Pública - Sector Educación', 'San Juan de Lurigancho', 'ZARATE', 'AVENIDA GRAN CHIMU S/N', '', '', '1975', 'R.Depar.Nº 01692', '0', '-12.02424', '-76.98456', '1', '0', '0', '0000-00-00 00:00:00', '1', '2018-04-27 16:06:55');
INSERT INTO `localie` VALUES ('12', '566116', '1', 'Pública de gestión directa', 'Pública - Sector Educación', 'San Juan de Lurigancho', 'MANGOMARCA', 'AVENIDA TEMPLO DE LUNA S/N', '', '', '1992', 'R.D.Z. Nº 01402', '0', '-12.01911', '-76.98481', '1', '0', '0', '0000-00-00 00:00:00', '1', '2018-04-27 16:13:58');
INSERT INTO `localie` VALUES ('13', '323986', '2', 'Pública de gestión directa', 'Pública - Sector Educación', 'San Juan de Lurigancho', 'CAMPOY', 'CAMPOY MZ C1', '', '', '2000', 'R.D. USE 05 Nº 03590', '0', '-12.01911', '-76.96828', '1', '0', '0', '0000-00-00 00:00:00', '1', '2018-04-27 16:14:39');
INSERT INTO `localie` VALUES ('14', '326796', '2', 'Pública de gestión directa', 'Pública - Sector Educación', 'San Juan de Lurigancho', 'CAMPOY', 'AVENIDA LOS PROCERES MZ M LOTE 15', '', '', '1985', 'R.D. USE 03 Nº 03323', '0', '-12.01408', '-76.96331', '1', '0', '0', '0000-00-00 00:00:00', '1', '2021-08-03 15:29:24');
INSERT INTO `localie` VALUES ('15', '324226', '2', 'Pública de gestión directa', 'Pública - Sector Educación', 'San Juan de Lurigancho', '28 DE JULIO', 'CALLE LOS HALCONES S/N', '', '', '1991', 'R.D. USE 03 Nº 00013', '0', '-12.02185', '-76.97813', '1', '0', '0', '0000-00-00 00:00:00', '1', '2018-04-27 16:15:23');
INSERT INTO `localie` VALUES ('16', '327965', '2', 'Pública de gestión directa', 'Pública - Sector Educación', 'San Juan de Lurigancho', 'CAMPOY', 'CALLE 8 S/N MZ J LOTE 11 ETAPA III', '', '', '1992', 'R.M.Nº 0309', '0', '-12.01579', '-76.96293', '1', '0', '0', '0000-00-00 00:00:00', '1', '2021-08-03 15:29:35');
INSERT INTO `localie` VALUES ('17', '324325', '2', 'Pública de gestión directa', 'Pública - Sector Educación', 'San Antonio', 'LA VIZCACHERA', 'AVENIDA LOS 5 VIAJEROS S/N', '', '', '1992', 'R.D.Nº 01418', '0', '-12.00723', '-76.95588', '1', '0', '0', '0000-00-00 00:00:00', '1', '2018-04-27 16:16:01');
INSERT INTO `localie` VALUES ('18', '324467', '2', 'Pública de gestión directa', 'Pública - Sector Educación', 'San Juan de Lurigancho', 'CAMPOY', 'AVENIDA D MZ Q, LOTE 1-2', '', '', '1974', 'R.D.Zonal 01Nº 01189', '0', '-12.01871', '-76.96763', '1', '0', '0', '0000-00-00 00:00:00', '1', '2018-04-27 16:16:37');
INSERT INTO `localie` VALUES ('19', '324472', '2', 'Pública de gestión directa', 'Pública - Sector Educación', 'San Juan de Lurigancho', 'CAMPOY', 'AVENIDA PRINCIPAL MZ D LOTE 6', '', '', '1974', 'R.D.Zonal 01Nº 01191', '0', '-12.02081', '-76.95637', '1', '0', '0', '0000-00-00 00:00:00', '1', '2018-04-27 16:17:26');
INSERT INTO `localie` VALUES ('20', '324486', '2', 'Pública de gestión directa', 'Pública - Sector Educación', 'San Juan de Lurigancho', 'CAMPOY', 'AVENIDA PRINCIPAL S/N', '', '', '1974', 'R.D.Z. Nº 01190 Y R.D.Nº 01093', '0', '-12.02449', '-76.97901', '1', '0', '0', '0000-00-00 00:00:00', '1', '2018-04-27 16:18:32');
INSERT INTO `localie` VALUES ('21', '324995', '2', 'Pública de gestión directa', 'Pública - Sector Educación', 'San Juan de Lurigancho', 'CAMPOY', 'CAMPOY MZ G ZONA III', '', '', '1988', 'R.D.Nº 00155', '0', '-12.01577', '-76.96509', '1', '0', '0', '0000-00-00 00:00:00', '1', '2018-04-27 16:20:23');
INSERT INTO `localie` VALUES ('22', '324858', '2', 'Pública de gestión directa', 'Pública - Sector Educación', 'San Juan de Lurigancho', 'CAMPOY', 'PARQUE 6 SECTOR III MZ S, LOTE G', '', '', '1986', 'R.D.Zonal 01 Nº 01394', '0', '-12.01124', '-76.96067', '1', '0', '0', '0000-00-00 00:00:00', '1', '2018-04-27 16:19:41');
INSERT INTO `localie` VALUES ('23', '325315', '2', 'Pública de gestión directa', 'Pública - Sector Educación', 'San Juan de Lurigancho', 'CAMPOY', 'AVENIDA LOS PROCERES MZ R LOTE 15', '', '', '1992', 'R.D.USE 03 Nº 01682', '0', '-12.01253', '-76.96254', '1', '0', '0', '0000-00-00 00:00:00', '1', '2018-04-27 16:21:12');
INSERT INTO `localie` VALUES ('24', '323750', '3', 'Pública de gestión directa', 'Pública - Sector Educación', 'San Juan de Lurigancho', 'CAJA DE AGUA', 'JIRON PASCO S/N', '', '', '1967', 'R.M.  Nº 02646', '0', '-12.03118', '-77.01698', '1', '0', '0', '0000-00-00 00:00:00', '1', '2018-04-27 16:25:10');
INSERT INTO `localie` VALUES ('25', '323788', '3', 'Pública de gestión directa', 'Pública - Sector Educación', 'San Juan de Lurigancho', 'CHACARILLA DE OTERO', 'PASAJE RAUL PORRAS BARRENECHEA S/N', '', '', '1996', 'R.D. Nº 00961', '0', '-12.0242', '-77.01139', '1', '0', '0', '0000-00-00 00:00:00', '1', '2018-04-27 16:25:50');
INSERT INTO `localie` VALUES ('26', '323830', '3', 'Pública de gestión directa', 'Pública - Sector Educación', 'San Juan de Lurigancho', 'LAS FLORES', 'JIRON LOS EBANOS S/N', '', '', '1980', 'R.D.Nº 01058', '0', '-12.00575', '-77.01436', '1', '0', '0', '0000-00-00 00:00:00', '1', '2018-04-27 16:26:32');
INSERT INTO `localie` VALUES ('27', '323849', '3', 'Pública de gestión directa', 'Pública - Sector Educación', 'San Juan de Lurigancho', 'SAN HILARION', 'JIRON LAS GROCELLAS 1740', '', '', '1981', 'R.D.Zonal 01Nº 03188', '0', '-12.00595', '-77.00965', '1', '0', '0', '0000-00-00 00:00:00', '1', '2018-04-27 16:27:06');
INSERT INTO `localie` VALUES ('28', '323873', '3', 'Pública de gestión directa', 'Pública - Sector Educación', 'San Juan de Lurigancho', 'LAS VIOLETAS', 'JIRON LOS RICINOS S/N', '', '', '1981', 'R.D.Z. Nº 03188', '0', '-12.01479', '-77.008', '1', '0', '0', '0000-00-00 00:00:00', '1', '2018-04-27 16:28:18');
INSERT INTO `localie` VALUES ('29', '323910', '3', 'Pública de gestión directa', 'Pública - Sector Educación', 'San Juan de Lurigancho', 'SAN HILARION', 'JIRON LAS ORTIGAS S/N', '', '', '1982', 'R.D.Z. Nº 02811', '0', '-12.00288', '-77.0104', '1', '0', '0', '0000-00-00 00:00:00', '1', '2018-04-27 16:29:13');
INSERT INTO `localie` VALUES ('30', '324047', '3', 'Pública de gestión directa', 'Pública - Sector Educación', 'San Juan de Lurigancho', 'CAJA DE AGUA', 'AVENIDA PROCERES DE LA INDEPENDENCIA S/N', '', '', '1986', 'R.D.Zonal 01 Nº 01255', '0', '-12.03125', '-77.01241', '1', '0', '0', '0000-00-00 00:00:00', '1', '2018-04-27 16:30:10');
INSERT INTO `localie` VALUES ('31', '324269', '3', 'Pública de gestión directa', 'Pública - Sector Educación', 'San Juan de Lurigancho', 'LAS FLORES DE LIMA', 'JIRON LAS ORTIGAS S/N', '', '', '1991', 'R.D. Nº 01222', '0', '-12.00935', '-77.00776', '1', '0', '0', '0000-00-00 00:00:00', '1', '2018-04-27 16:30:54');
INSERT INTO `localie` VALUES ('32', '326782', '3', 'Pública de gestión privada', 'Pública - En convenio', 'San Juan de Lurigancho', 'CHACARILLA DE OTERO', 'PASAJE RAUL PORRAS BARRENECHEA S/N', '', '', '1966', 'R.M. Nº 03714 Y R.D. Nº 01381-95', '0', '-12.02277', '-77.01005', '1', '0', '0', '0000-00-00 00:00:00', '1', '2018-04-27 17:47:40');
INSERT INTO `localie` VALUES ('33', '324603', '3', 'Pública de gestión directa', 'Pública - Sector Educación', 'San Juan de Lurigancho', 'SAN HILARION', 'JIRON LAS RIMARINAS', '', '', '1981', 'R.D.Z. Nº 00881 Y R.D.N°3152-11', '0', '-12.0059', '-77.00737', '1', '0', '0', '0000-00-00 00:00:00', '1', '2018-04-27 16:36:19');
INSERT INTO `localie` VALUES ('34', '325184', '3', 'Pública de gestión directa', 'Pública - Sector Educación', 'San Juan de Lurigancho', 'ASCURRUN', 'PLAZA PRINCIPAL EL PUEBLITO', '', '', '1958', 'R.M. Nº 18073 Y R.D.Z. 02 Nº 03796', '0', '-12.018', '-77.00373', '1', '0', '0', '0000-00-00 00:00:00', '1', '2018-04-27 16:43:21');
INSERT INTO `localie` VALUES ('35', '325202', '3', 'Pública de gestión directa', 'Pública - Sector Educación', 'San Juan de Lurigancho', 'CAJA DE AGUA', 'AVENIDA PROCERES DE LA INDEPENDENCIA S/N', '', '', '1964', 'R.M.Nº 03845 Y R.D.N°436', '0', '-12.02992', '-77.0122', '1', '0', '0', '0000-00-00 00:00:00', '1', '2018-04-27 17:33:59');
INSERT INTO `localie` VALUES ('36', '324405', '3', 'Pública de gestión directa', 'Pública - Sector Educación', 'San Juan de Lurigancho', 'CAJA DE AGUA', 'AVENIDA RIMAC S/N', '', '', '1966', 'R.M. Nº 02919', '0', '-12.03152', '-77.01524', '1', '0', '0', '0000-00-00 00:00:00', '1', '2018-04-27 16:31:32');
INSERT INTO `localie` VALUES ('37', '324981', '3', 'Pública de gestión directa', 'Pública - Sector Educación', 'San Juan de Lurigancho', 'LAS FLORES', 'AVENIDA CANTO GRANDE S/N', '', '', '1972', 'R.M. Nº 00118 Y R.M. Nº 000997', '0', '-12.01763', '-77.01364', '1', '0', '0', '0000-00-00 00:00:00', '1', '2018-04-27 16:38:56');
INSERT INTO `localie` VALUES ('38', '324434', '3', 'Pública de gestión directa', 'Pública - Sector Educación', 'San Juan de Lurigancho', '15 DE ENERO', 'JIRON SAN MARTIN S/N', '', '', '1972', 'R.M. Nº 00118 Y R.D.Z. Nº 04436', '0', '-12.00923', '-77.01744', '1', '0', '0', '0000-00-00 00:00:00', '1', '2018-04-27 16:32:53');
INSERT INTO `localie` VALUES ('39', '325438', '3', 'Pública de gestión directa', 'Pública - Sector Educación', 'San Juan de Lurigancho', 'LAS FLORES DE LIMA', 'JIRON LAS CAROLINAS MZ L1 LOTE 1', '', '', '1974', 'R.D.Zonal 01 Nº 00978 Y R.D.Zonal 01 Nº 00978', '0', '-12.00952', '-77.00917', '1', '0', '0', '0000-00-00 00:00:00', '1', '2018-04-27 17:46:39');
INSERT INTO `localie` VALUES ('40', '324636', '3', 'Pública de gestión directa', 'Pública - Sector Educación', 'San Juan de Lurigancho', 'LAS VIOLETAS', 'JIRON LAS SENSITIVAS S/N', '', '', '1982', 'R.D.Z. Nº 00378 Y R.D. Nº 00046', '0', '-12.01095', '-77.00628', '1', '0', '0', '0000-00-00 00:00:00', '1', '2018-04-27 16:37:07');
INSERT INTO `localie` VALUES ('41', '324518', '3', 'Pública de gestión directa', 'Pública - Sector Educación', 'San Juan de Lurigancho', 'CHACARILLA DE OTERO', 'AVENIDA MIGUEL GRAU S/N', '', '', '1976', 'R.D.Z.Nº 03133', '0', '-12.02155', '-77.00724', '1', '0', '0', '0000-00-00 00:00:00', '1', '2018-04-27 16:34:16');
INSERT INTO `localie` VALUES ('42', '325198', '3', 'Pública de gestión directa', 'Pública - Sector Educación', 'San Juan de Lurigancho', 'CAJA DE AGUA', 'JIRON AREQUIPA S/N', '', '', '1973', 'R.Depar. Nº 02084', '0', '-12.02764', '-77.01384', '1', '0', '0', '0000-00-00 00:00:00', '1', '2018-04-27 16:44:31');
INSERT INTO `localie` VALUES ('43', '325221', '3', 'Pública de gestión directa', 'Pública - Sector Educación', 'San Juan de Lurigancho', 'LAS FLORES', 'JIRON LOS EBANOS S/N', '', '', '1976', 'R.D.Zonal 01 Nº 04050 Y R.D. Zonal  01Nº 000996', '0', '-12.00536', '-77.014', '1', '0', '0', '0000-00-00 00:00:00', '1', '2018-04-27 17:35:12');
INSERT INTO `localie` VALUES ('44', '327611', '3', 'Pública de gestión privada', 'Pública - En convenio', 'San Juan de Lurigancho', 'CHACARILLA DE OTERO', 'PASAJE HIPOLITO UNANUE S/N', '', '', '1967', 'R.M.Nº 00904', '0', '-12.025', '-77.01039', '1', '0', '0', '0000-00-00 00:00:00', '1', '2018-04-27 17:48:35');
INSERT INTO `localie` VALUES ('45', '325075', '3', 'Pública de gestión directa', 'Pública - Sector Educación', 'San Juan de Lurigancho', 'SAN HILARION', 'CALLE LAS MANDRAGORAS 417', '', '', '1989', 'R.Depar. Nº 01268', '0', '-12.00572', '-77.00984', '1', '0', '0', '0000-00-00 00:00:00', '1', '2018-04-27 16:41:22');
INSERT INTO `localie` VALUES ('46', '325018', '3', 'Pública de gestión directa', 'Pública - Sector Educación', 'San Juan de Lurigancho', 'LAS FLORES', 'JIRON JOSE ANTONIO ENCINAS 400', '', '', '1982', 'R.D.Zonal 01 Nº 04502', '0', '-12.01896', '-77.01046', '1', '0', '0', '0000-00-00 00:00:00', '1', '2018-04-27 16:40:02');
INSERT INTO `localie` VALUES ('47', '323892', '4', 'Pública de gestión directa', 'Pública - Sector Educación', 'San Juan de Lurigancho', 'SANTA FE DE TOTORITAS', 'PASAJE LAS ORQUIDEAS S/N', '', '', '0', '', '0', '-11.99729', '-76.9959', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00');
INSERT INTO `localie` VALUES ('48', '323854', '4', 'Pública de gestión directa', 'Pública - Sector Educación', 'San Juan de Lurigancho', 'HUAYRONA', 'JIRON PIEDRA BIGUA S/N', '', '', '0', '', '0', '-11.99352', '-77.00265', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00');
INSERT INTO `localie` VALUES ('49', '323868', '4', 'Pública de gestión directa', 'Pública - Sector Educación', 'San Juan de Lurigancho', 'ASCURRUN', 'JIRON LOS CISNES S/N', '', '', '0', '', '0', '-12.0153', '-77.00028', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00');
INSERT INTO `localie` VALUES ('50', '323967', '4', 'Pública de gestión directa', 'Pública - Sector Educación', 'San Juan de Lurigancho', 'INCA MANCO CAPAC', 'JIRON BIGUA S/N', '', '', '0', '', '0', '-11.99893', '-77.0021', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00');
INSERT INTO `localie` VALUES ('51', '324194', '4', 'Pública de gestión directa', 'Pública - Sector Educación', 'San Juan de Lurigancho', 'SAN CARLOS', 'CALLE LOS ZAFIROS S/N', '', '', '0', '', '0', '-11.98802', '-77.0077', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00');
INSERT INTO `localie` VALUES ('52', '324306', '4', 'Pública de gestión directa', 'Pública - Sector Educación', 'San Juan de Lurigancho', 'JORGE BASADRE', 'JIRON LAS GRAVAS 2460', '', '', '0', '', '0', '-11.99104', '-77.00926', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00');
INSERT INTO `localie` VALUES ('53', '325443', '4', 'Pública de gestión directa', 'Pública - Sector Educación', 'San Juan de Lurigancho', 'HORIZONTE DE ZARATE', 'MZ D LOTE 10 ETAPA I', '', '', '0', '', '0', '-12.01521', '-76.99814', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00');
INSERT INTO `localie` VALUES ('54', '324491', '4', 'Pública de gestión directa', 'Pública - Sector Educación', 'San Juan de Lurigancho', 'SAN HILARION', 'JIRON LAS GRAVAS 2032', '', '', '0', '', '0', '-11.9988', '-77.00728', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00');
INSERT INTO `localie` VALUES ('55', '324943', '4', 'Pública de gestión directa', 'Pública - Sector Educación', 'San Juan de Lurigancho', 'SANTA ROSA DEL SAUCE', 'AVENIDA LAS ROSAS S/N', '', '', '0', '', '0', '-12.00857', '-76.9894', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00');
INSERT INTO `localie` VALUES ('56', '324599', '4', 'Pública de gestión directa', 'Pública - Sector Educación', 'San Juan de Lurigancho', 'INCA MANCO CAPAC', 'JIRON ENERGITAS S/N MZ A ETAPA II', '', '', '0', '', '0', '-12.0086', '-76.99784', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00');
INSERT INTO `localie` VALUES ('57', '686294', '4', 'Pública de gestión directa', 'Pública - Sector Educación', 'San Juan de Lurigancho', 'LOS SAUCES SEGUNDO', 'MZ H LOTE 20', '', '', '0', '', '0', '-12.0055', '-76.9907', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00');
INSERT INTO `localie` VALUES ('58', '325339', '4', 'Pública de gestión directa', 'Pública - Sector Educación', 'San Juan de Lurigancho', 'SANTA FE DE TOTORITAS', 'JIRON LOS GIRASOLES S/N', '', '', '0', '', '0', '-11.9969', '-76.99678', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00');
INSERT INTO `localie` VALUES ('59', '324679', '4', 'Pública de gestión directa', 'Pública - Sector Educación', 'San Juan de Lurigancho', 'INCA MANCO CAPAC', 'JIRON REJALGAR 785', '', '', '0', '', '0', '-12.00389', '-76.99677', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00');
INSERT INTO `localie` VALUES ('60', '324924', '4', 'Pública de gestión directa', 'Pública - Sector Educación', 'San Juan de Lurigancho', 'LAS FLORES 78', 'JIRON LAS GRAVAS CUADRA 18', '', '', '0', '', '0', '-12.00325', '-77.00542', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00');
INSERT INTO `localie` VALUES ('61', '324938', '4', 'Pública de gestión directa', 'Pública - Sector Educación', 'San Juan de Lurigancho', 'SAN CARLOS', 'AVENIDA JORGE BASADRE MZ V-1 LOTE 1-22', '', '', '0', '', '0', '-11.98876', '-77.00652', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00');
INSERT INTO `localie` VALUES ('62', '325155', '4', 'Pública de gestión directa', 'Pública - Sector Educación', 'San Juan de Lurigancho', 'EL SAUCE', 'EL SAUCE MZ A LOTE S-N', '', '', '0', '', '0', '-12.00636', '-76.99214', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00');
INSERT INTO `localie` VALUES ('63', '324523', '4', 'Pública de gestión directa', 'Pública - Sector Educación', 'San Juan de Lurigancho', 'INCA MANCO CAPAC', 'JIRON LOS JASPES MZ I4 LOTE 1', '', '', '0', '', '0', '-11.99875', '-76.99966', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00');
INSERT INTO `localie` VALUES ('64', '324537', '4', 'Pública de gestión directa', 'Pública - Sector Educación', 'San Juan de Lurigancho', 'ASCURRUN', 'PASAJE LOS COLIBRIS S/N', '', '', '0', '', '0', '-12.01368', '-76.99923', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00');
INSERT INTO `localie` VALUES ('65', '324580', '4', 'Pública de gestión directa', 'Pública - Sector Educación', 'San Juan de Lurigancho', 'HUAYRONA', 'JIRON CANTO RODADO 620', '', '', '0', '', '0', '-11.99336', '-77.00213', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00');
INSERT INTO `localie` VALUES ('66', '823489', '4', 'Pública de gestión directa', 'Pública - Sector Educación', 'San Juan de Lurigancho', 'SAN GABRIEL', 'MZ X LOTE 1', '', '', '0', '', '0', '-11.98839', '-77.000345', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00');
INSERT INTO `localie` VALUES ('67', '616055', '4', 'Pública de gestión directa', 'Pública - Sector Educación', 'San Juan de Lurigancho', 'ZARATE', 'JIRON LOS URUBUES MZ I LOTE 11', '', '', '0', '', '0', '-12.0165', '-76.9968', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00');
INSERT INTO `localie` VALUES ('68', '325061', '4', 'Pública de gestión directa', 'Pública - Sector Educación', 'San Juan de Lurigancho', 'SAN HILARION', 'JIRON AGUA MARINA 121', '', '', '0', '', '0', '-11.99463', '-77.00968', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00');
INSERT INTO `localie` VALUES ('69', '323825', '5', 'Pública de gestión directa', 'Pública - Sector Educación', 'San Juan de Lurigancho', 'CANTO REY', 'AVENIDA LOS CIRUELOS S/N', '', '', '0', '', '0', '-11.98121', '-76.99889', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00');
INSERT INTO `localie` VALUES ('70', '324028', '5', 'Pública de gestión directa', 'Pública - Sector Educación', 'San Juan de Lurigancho', 'VILLA HUANTA', 'HUANTA MZ P LOTE 1', '', '', '0', '', '0', '-11.98614', '-76.99467', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00');
INSERT INTO `localie` VALUES ('71', '324090', '5', 'Pública de gestión directa', 'Pública - Sector Educación', 'San Juan de Lurigancho', 'ISRAEL', 'CALLE 12 Y 7 MZ L', '', '', '0', '', '0', '-11.9751', '-76.98832', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00');
INSERT INTO `localie` VALUES ('72', '324108', '5', 'Pública de gestión directa', 'Pública - Sector Educación', 'San Juan de Lurigancho', 'MIGUEL GRAU', 'JIRON ALMIRANTE GRAU MZ A LOTE 13', '', '', '0', '', '0', '-11.98002', '-76.99051', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00');
INSERT INTO `localie` VALUES ('73', '324231', '5', 'Pública de gestión directa', 'Pública - Sector Educación', 'San Juan de Lurigancho', 'JUAN PABLO II', '32', '', '', '0', '', '0', '-11.98328', '-76.97595', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00');
INSERT INTO `localie` VALUES ('74', '324151', '5', 'Pública de gestión directa', 'Pública - Sector Educación', 'San Juan de Lurigancho', 'JUAN PABLO II', 'AVENIDA PROLONGACION SAN MARTIN MZ S-2 LOTE 00', '', '', '0', '', '0', '-11.98147', '-76.98431', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00');
INSERT INTO `localie` VALUES ('75', '324293', '5', 'Pública de gestión directa', 'Pública - Sector Educación', 'San Juan de Lurigancho', 'JUAN PABLO II', 'AVENIDA LOS GRANADOS S/N', '', '', '0', '', '0', '-11.98024', '-76.98066', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00');
INSERT INTO `localie` VALUES ('76', '324349', '5', 'Pública de gestión directa', 'Pública - Sector Educación', 'San Juan de Lurigancho', 'JUAN PABLO II', 'CALLE JUAN PABLO II ZONA III', '', '', '0', '', '0', '-11.98241', '-76.97975', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00');
INSERT INTO `localie` VALUES ('77', '324387', '5', 'Pública de gestión directa', 'Pública - Sector Educación', 'San Juan de Lurigancho', 'SAGRADO MADERO', 'COOPERATIVA SAGRADA FAMILIA MZ Z, LOTE 2', '', '', '0', '', '0', '-11.97656', '-76.98838', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00');
INSERT INTO `localie` VALUES ('78', '748287', '5', 'Pública de gestión directa', 'Pública - Sector Educación', 'San Juan de Lurigancho', 'EL ARENAL  DE CANTO GRANDE', 'MZ K LOTE 13 SECTOR ARENAL ALTO', '', '', '0', '', '0', '-11.97945', '-76.98678', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00');
INSERT INTO `localie` VALUES ('79', '325320', '5', 'Pública de gestión directa', 'Pública - Sector Educación', 'San Juan de Lurigancho', 'HUANTA', 'AVENIDA HEROES DE LA BREÑA S/N', '', '', '0', '', '0', '-11.98795', '-76.99409', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00');
INSERT INTO `localie` VALUES ('80', '324797', '5', 'Pública de gestión directa', 'Pública - Sector Educación', 'San Juan de Lurigancho', 'ISRAEL', 'AVENIDA ISRAEL MZ M LOTE 13', '', '', '0', '', '0', '-11.97429', '-76.9883', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00');
INSERT INTO `localie` VALUES ('81', '324815', '5', 'Pública de gestión directa', 'Pública - Sector Educación', 'San Juan de Lurigancho', 'EL PORVENIR', 'EL PORVENIR MZ F', '', '', '0', '', '0', '-11.97338', '-76.98937', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00');
INSERT INTO `localie` VALUES ('82', '324820', '5', 'Pública de gestión directa', 'Pública - Sector Educación', 'San Juan de Lurigancho', 'JUAN PABLO II', 'JIRON LOS GRANADOS MZ Q2 LOTE 1', '', '', '0', '', '0', '-11.98039', '-76.97831', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00');
INSERT INTO `localie` VALUES ('83', '325235', '5', 'Pública de gestión directa', 'Pública - Sector Educación', 'San Juan de Lurigancho', 'CANTO REY', 'JIRON LOS CIRUELOS 898', '', '', '0', '', '0', '-11.98021', '-76.99826', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00');
INSERT INTO `localie` VALUES ('84', '325481', '5', 'Pública de gestión directa', 'Pública - Sector Educación', 'San Juan de Lurigancho', 'JUAN PABLO II', 'AVENIDA PROLONGACION SAN MARTIN S/N', '', '', '0', '', '0', '-11.98258', '-76.98487', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00');
INSERT INTO `localie` VALUES ('85', '325382', '5', 'Pública de gestión directa', 'Pública - Otro Sector Público', 'San Juan de Lurigancho', 'HUANTA', 'AVENIDA SANTA ROSA S/N', '', '', '0', '', '0', '-11.99104', '-76.99741', '1', '0', '0', '0000-00-00 00:00:00', '1', '2021-08-03 15:30:10');
INSERT INTO `localie` VALUES ('86', '325056', '5', 'Pública de gestión directa', 'Pública - Sector Educación', 'San Juan de Lurigancho', 'CANTO GRANDE', 'AVENIDA SANTA ROSA S/N', '', '', '0', '', '0', '-11.98351', '-76.98918', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00');
INSERT INTO `localie` VALUES ('87', '325037', '5', 'Pública de gestión directa', 'Pública - Sector Educación', 'San Juan de Lurigancho', 'HUANTA', 'OTROS MZ P LOTE 13', '', '', '0', '', '0', '-11.98525', '-76.99396', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00');
INSERT INTO `localie` VALUES ('88', '324071', '6', 'Pública de gestión directa', 'Pública - Sector Educación', 'San Juan de Lurigancho', 'SANTA MARIA', 'SANTA MARIA MZ L1', '', '', '0', '', '0', '-11.96256', '-76.97868', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00');
INSERT INTO `localie` VALUES ('89', '714329', '6', 'Pública de gestión directa', 'Pública - Sector Educación', 'San Juan de Lurigancho', 'LOS HERALDOS', 'CALLE LAS LILAS MZ D', '', '', '0', '', '0', '-11.96521', '-76.98631', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00');
INSERT INTO `localie` VALUES ('90', '324132', '6', 'Pública de gestión directa', 'Pública - Sector Educación', 'San Juan de Lurigancho', 'EDUARDO DE LA PINIELLA', 'EDUARDO DE LA PINELLA MZ C10 LOTE 6', '', '', '0', '', '0', '-11.96987', '-76.99183', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00');
INSERT INTO `localie` VALUES ('91', '324165', '6', 'Pública de gestión directa', 'Pública - Sector Educación', 'San Juan de Lurigancho', 'MARISCAL CACERES', 'MZ B-9,B-17', '', '', '0', '', '0', '-11.96079', '-76.98174', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00');
INSERT INTO `localie` VALUES ('92', '325122', '6', 'Pública de gestión directa', 'Pública - Sector Educación', 'San Juan de Lurigancho', 'SEÑOR DE LOS MILAGROS', 'JIRON LOS LIRIOS S/N', '', '', '0', '', '0', '-11.97221', '-76.98478', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00');
INSERT INTO `localie` VALUES ('93', '325462', '6', 'Pública de gestión directa', 'Pública - Sector Educación', 'San Juan de Lurigancho', 'SANTA MARIA', 'CALLE D MZ V-2 ETAPA II', '', '', '0', '', '0', '-11.96587', '-76.97091', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00');
INSERT INTO `localie` VALUES ('94', '325358', '6', 'Pública de gestión directa', 'Pública - Sector Educación', 'San Juan de Lurigancho', 'MARISCAL CACERES', 'MARISCAL CACERES MZ D8', '', '', '0', '', '0', '-11.95837', '-76.98055', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00');
INSERT INTO `localie` VALUES ('95', '325495', '6', 'Pública de gestión directa', 'Pública - Sector Educación', 'San Juan de Lurigancho', '27 DE MARZO', 'PUEBLO JOVEN 27 DE MARZO S/N LOTE CEI', '', '', '0', '', '0', '-11.9605', '-76.978', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00');
INSERT INTO `localie` VALUES ('96', '586336', '6', 'Pública de gestión directa', 'Pública - Sector Educación', 'San Juan de Lurigancho', '27 DE MARZO', 'PASAJE PROGRESO S/N MZ O LOTE CE', '', '', '0', '', '0', '-11.9596', '-76.9763', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00');
INSERT INTO `localie` VALUES ('97', '686307', '6', 'Pública de gestión directa', 'Pública - Sector Educación', 'San Juan de Lurigancho', 'SANTA MARIA', 'PARCELA II MZ I-3 LOTE 11', '', '', '0', '', '0', '-11.9641', '-76.968', '1', '0', '0', '0000-00-00 00:00:00', '1', '2018-04-17 10:32:12');
INSERT INTO `localie` VALUES ('98', '777034', '6', 'Pública de gestión directa', 'Pública - Sector Educación', 'San Juan de Lurigancho', 'MARISCAL CACERES - AMPLIACION SANTA MARIA', 'MZ F3 LOTE 08 ETAPA II Y III SECTOR IV', '', '', '0', '', '0', '-11.96806', '-76.96926', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00');
INSERT INTO `localie` VALUES ('99', '777053', '6', 'Pública de gestión directa', 'Pública - Sector Educación', 'San Juan de Lurigancho', '27  DE MARZO - AMPLIACION LA ROCA', 'AVENIDA LAS FLORES S/N ETAPA II', '', '', '0', '', '0', '-11.96097', '-76.972887', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00');
INSERT INTO `localie` VALUES ('100', '777072', '6', 'Pública de gestión directa', 'Pública - Sector Educación', 'San Juan de Lurigancho', 'SEÑOR DE LOS MILAGROS', 'MZ K LOTE 5 SECTOR COMBATE DE ANGAMOS AA.HH.', '', '', '0', '', '0', '-11.966774', '-76.981002', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00');
INSERT INTO `localie` VALUES ('101', '324684', '6', 'Pública de gestión directa', 'Pública - Sector Educación', 'San Juan de Lurigancho', 'HUANCARAY', 'AVENIDA CENTRO CIVICO S/N', '', '', '0', '', '0', '-11.96656', '-76.98921', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00');
INSERT INTO `localie` VALUES ('102', '324698', '6', 'Pública de gestión directa', 'Pública - Sector Educación', 'San Juan de Lurigancho', 'LA UNION', 'MZ K LOTE 7', '', '', '0', '', '0', '-11.96846', '-76.98844', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00');
INSERT INTO `localie` VALUES ('103', '324839', '6', 'Pública de gestión directa', 'Pública - Sector Educación', 'San Juan de Lurigancho', 'SANTA MARIA', 'CALLE D S/N', '', '', '0', '', '0', '-11.96602', '-76.97705', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00');
INSERT INTO `localie` VALUES ('104', '324896', '6', 'Pública de gestión directa', 'Pública - Sector Educación', 'San Juan de Lurigancho', 'JAIME ZUBIETA', 'JAIME ZUBIETA MZ F, LOTE 2-3', '', '', '0', '', '0', '-11.96425', '-76.98743', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00');
INSERT INTO `localie` VALUES ('105', '324288', '6', 'Pública de gestión directa', 'Pública - Sector Educación', 'San Juan de Lurigancho', 'SEÑOR DE LOS MILAGROS', 'JIRON LOS LIRIOS S/N', '', '', '0', '', '0', '-11.97221', '-76.98478', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00');
INSERT INTO `localie` VALUES ('106', '325301', '6', 'Pública de gestión directa', 'Pública - Sector Educación', 'San Juan de Lurigancho', 'LA UNION', 'AVENIDA CIRCUNVALACION S/N', '', '', '0', '', '0', '-11.96994', '-76.98804', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00');
INSERT INTO `localie` VALUES ('107', '325377', '7', 'Pública de gestión directa', 'Pública - Sector Educación', 'San Juan de Lurigancho', 'CRUZ DE MOTUPE', 'PARQUE PRINCIPAL S/N', '', '', '0', '', '0', '-11.94205', '-76.97654', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00');
INSERT INTO `localie` VALUES ('108', '324085', '7', 'Pública de gestión directa', 'Pública - Sector Educación', 'San Juan de Lurigancho', 'MARISCAL CACERES', 'MARISCAL CACERES MZ R5', '', '', '0', '', '0', '-11.94787', '-76.97786', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00');
INSERT INTO `localie` VALUES ('109', '324127', '7', 'Pública de gestión directa', 'Pública - Sector Educación', 'San Juan de Lurigancho', 'MARISCAL CACERES', 'JIRON LAS LILAS S/N', '', '', '0', '', '0', '-11.94989', '-76.97907', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00');
INSERT INTO `localie` VALUES ('110', '324245', '7', 'Pública de gestión directa', 'Pública - Sector Educación', 'San Juan de Lurigancho', 'MARISCAL CACERES', 'MARISCAL CACERES MZ MY ETAPA II', '', '', '0', '', '0', '-11.94755', '-76.98271', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00');
INSERT INTO `localie` VALUES ('111', '325283', '7', 'Pública de gestión directa', 'Pública - Sector Educación', 'San Antonio', 'JICAMARCA', 'JICAMARCA MZ H LOTE 4', '', '', '0', '', '0', '-11.93263', '-76.96549', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00');
INSERT INTO `localie` VALUES ('112', '324274', '7', 'Pública de gestión directa', 'Pública - Sector Educación', 'San Juan de Lurigancho', 'CRUZ DE MOTUPE', 'CRUZ DE MOTUPE MZ C', '', '', '0', '', '0', '-11.94074', '-76.97163', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00');
INSERT INTO `localie` VALUES ('113', '324311', '7', 'Pública de gestión directa', 'Pública - Sector Educación', 'San Juan de Lurigancho', 'MARISCAL CACERES', 'MARISCAL CACERES MZ K8 SECTOR II', '', '', '0', '', '0', '-11.95168', '-76.98309', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00');
INSERT INTO `localie` VALUES ('114', '324368', '7', 'Pública de gestión directa', 'Pública - Sector Educación', 'San Juan de Lurigancho', 'MARISCAL CACERES', 'JIRON PEREZ DE TUDELA S/N', '', '', '0', '', '0', '-11.95593', '-76.97915', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00');
INSERT INTO `localie` VALUES ('115', '324373', '7', 'Pública de gestión directa', 'Pública - Sector Educación', 'San Juan de Lurigancho', 'CESAR VALLEJO', 'CESAR VALLEJO MZ U, LOTE 1', '', '', '0', '', '0', '-11.94018', '-76.96667', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00');
INSERT INTO `localie` VALUES ('116', '324392', '7', 'Pública de gestión directa', 'Pública - Sector Educación', 'San Juan de Lurigancho', 'TUPAC AMARU 2', 'TUPAC AMARU II MZ H LOTE 1', '', '', '0', '', '0', '-11.956', '-76.97738', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00');
INSERT INTO `localie` VALUES ('117', '324919', '7', 'Pública de gestión directa', 'Pública - Sector Educación', 'San Juan de Lurigancho', 'CIUDAD LOS CONSTRUCTORES', 'MZ Z', '', '', '0', '', '0', '-11.95313', '-76.97713', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00');
INSERT INTO `localie` VALUES ('118', '779877', '7', 'Pública de gestión directa', 'Pública - Sector Educación', 'San Juan de Lurigancho', 'AMP. PRIMERO DE MAYO', 'AGRUPACIËN FAMILIAR AMP. PRIMERO DE MAYO MZ P LOTE 01', '', '', '0', '', '0', '-11.94283', '-76.96775', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00');
INSERT INTO `localie` VALUES ('119', '797937', '7', 'Pública de gestión directa', 'Pública - Sector Educación', 'San Juan de Lurigancho', 'MARISCAL CACERES -  CIUDAD LOS CONSTRUCTORES', 'PASAJE 86 S/N LOTE EDUCACIÓN PROGRAMA ETAPA 1ERA. SECTOR IV', '', '', '0', '', '0', '-11.948966', '-76.974768', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00');
INSERT INTO `localie` VALUES ('120', '324764', '7', 'Pública de gestión directa', 'Pública - Sector Educación', 'San Juan de Lurigancho', 'CRUZ DE MOTUPE', 'CALLE 60 MZ J', '', '', '0', '', '0', '-11.93999', '-76.97648', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00');
INSERT INTO `localie` VALUES ('121', '324877', '7', 'Pública de gestión directa', 'Pública - Sector Educación', 'San Juan de Lurigancho', 'SAN JOSE OBRERO', 'AVENIDA AMPLIACION S/N', '', '', '0', '', '0', '-11.94764', '-76.9757', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00');
INSERT INTO `localie` VALUES ('122', '324882', '7', 'Pública de gestión directa', 'Pública - Sector Educación', 'San Juan de Lurigancho', 'MONTENEGRO', 'AVENIDA PROLONGACION WIESSE S/N', '', '', '0', '', '0', '-11.93795', '-76.97173', '1', '0', '0', '0000-00-00 00:00:00', '1', '2023-03-01 10:35:58');
INSERT INTO `localie` VALUES ('123', '325160', '7', 'Pública de gestión directa', 'Pública - Sector Educación', 'San Juan de Lurigancho', 'JAVIER PEREZ DE CUELLAR', 'AVENIDA NACIONES UNIDAS S/N', '', '', '0', '', '0', '-11.95569', '-76.97284', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00');
INSERT INTO `localie` VALUES ('124', '325136', '7', 'Pública de gestión directa', 'Pública - Sector Educación', 'San Juan de Lurigancho', 'CESAR VALLEJO', 'CESAR VALLEJO MZ P LOTE 2', '', '', '0', '', '0', '-11.9401', '-76.96548', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00');
INSERT INTO `localie` VALUES ('125', '324900', '7', 'Pública de gestión directa', 'Pública - Sector Educación', 'San Juan de Lurigancho', 'MARISCAL CACERES', 'AVENIDA CIRCUNVALACION MZ D', '', '', '0', '', '0', '-11.95498', '-76.98109', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00');
INSERT INTO `localie` VALUES ('126', '325396', '7', 'Pública de gestión directa', 'Pública - Sector Educación', 'San Juan de Lurigancho', 'MARISCAL CACERES', 'AVENIDA CENTRAL MZ N6 LOTE 1', '', '', '0', '', '0', '-11.94893', '-76.97999', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00');
INSERT INTO `localie` VALUES ('127', '802439', '7', 'Pública de gestión directa', 'Pública - Sector Educación', 'San Juan de Lurigancho', 'CESAR VALLEJO', 'MZ V LOTE 1', '', '', '0', '', '0', '-11.938035', '-76.966609', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00');
INSERT INTO `localie` VALUES ('128', '823427', '7', 'Pública de gestión directa', 'Pública - Sector Educación', 'San Juan de Lurigancho', 'CRUZ DE MOTUPE', 'MZ D LOTE 15 ETAPA II GRUPO 5', '', '', '0', '', '0', '-11.939186', '-76.973312', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00');
INSERT INTO `localie` VALUES ('129', '823432', '7', 'Pública de gestión directa', 'Pública - Sector Educación', 'San Juan de Lurigancho', 'CRUZ DE MOTUPE', 'MZ D LOTE 15 ETAPA II GRUPO 5', '', '', '0', '', '0', '-11.944346', '-76.974944', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00');
INSERT INTO `localie` VALUES ('130', '510011', '7', 'Pública de gestión directa', 'Pública - Sector Educación', 'San Juan de Lurigancho', 'CRUZ DE MOTUPE', 'CRUZ DE MOTUPE GRUPO 5', '', '', '0', '', '0', '-11.9403', '-76.97498', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00');
INSERT INTO `localie` VALUES ('131', '324033', '16', 'Pública de gestión directa', 'Pública - Sector Educación', 'San Juan de Lurigancho', 'SU SANTIDAD JUAN PABLO II', 'AVENIDA EL PARQUE S/N', '', '', '0', '', '0', '-11.94085', '-76.99273', '1', '0', '0', '0000-00-00 00:00:00', '1', '2021-06-11 11:43:27');
INSERT INTO `localie` VALUES ('132', '324052', '8', 'Pública de gestión directa', 'Pública - Sector Educación', 'San Juan de Lurigancho', '10 DE OCTUBRE', 'AVENIDA FRAY DIEGO DE BARRANCA MZ A5 LOTE 12-10', '', '', '0', '', '0', '-11.94752', '-76.98744', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00');
INSERT INTO `localie` VALUES ('133', '324113', '8', 'Pública de gestión directa', 'Pública - Sector Educación', 'San Juan de Lurigancho', 'CRUZ DE MOTUPE', 'CALLE 67 MZ ANF', '', '', '0', '', '0', '-11.9368', '-76.97806', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00');
INSERT INTO `localie` VALUES ('134', '324207', '8', 'Pública de gestión directa', 'Pública - Sector Educación', 'San Juan de Lurigancho', 'CRUZ DE MOTUPE', 'MOTUPE', '', '', '0', '', '0', '-11.93699', '-76.97613', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00');
INSERT INTO `localie` VALUES ('135', '324250', '16', 'Pública de gestión directa', 'Pública - Sector Educación', 'San Juan de Lurigancho', 'JOSE CARLOS MARIATEGUI', 'JOSE CARLOS MARIATEGUI MZ X LOTE 3 ETAPA V', '', '', '0', '', '0', '-11.93097', '-76.99123', '1', '0', '0', '0000-00-00 00:00:00', '1', '2021-06-11 11:44:34');
INSERT INTO `localie` VALUES ('136', '324170', '8', 'Pública de gestión directa', 'Pública - Sector Educación', 'San Juan de Lurigancho', '10 DE OCTUBRE', 'AVENIDA DEL PARQUE S/N', '', '', '0', '', '0', '-11.9421', '-76.99019', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00');
INSERT INTO `localie` VALUES ('137', '324189', '16', 'Pública de gestión directa', 'Pública - Sector Educación', 'San Juan de Lurigancho', 'CASA BLANCA', 'MZ N17 - V44 LOTE E-5', '', '', '0', '', '0', '-11.94062', '-76.99747', '1', '0', '0', '0000-00-00 00:00:00', '1', '2021-06-11 11:44:21');
INSERT INTO `localie` VALUES ('138', '324330', '16', 'Pública de gestión directa', 'Pública - Sector Educación', 'San Juan de Lurigancho', 'LAS GALERAS', 'LAS GALERAS MZ Q5 LOTE EI5', '', '', '0', '', '0', '-11.93844', '-76.99129', '1', '0', '0', '0000-00-00 00:00:00', '1', '2021-06-11 11:44:44');
INSERT INTO `localie` VALUES ('139', '326843', '8', 'Pública de gestión privada', 'Pública - En convenio', 'San Juan de Lurigancho', 'MONTENEGRO', 'MONTENEGRO MZ LMNÑOP-1', '', '', '0', '', '0', '-11.93701', '-76.97254', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00');
INSERT INTO `localie` VALUES ('140', '713848', '8', 'Pública de gestión directa', 'Pública - Sector Educación', 'San Juan de Lurigancho', '10 DE MARZO', '10 DE MARZO', '', '', '0', '', '0', '-11.93228', '-76.97823', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00');
INSERT INTO `localie` VALUES ('141', '325344', '16', 'Pública de gestión directa', 'Pública - Sector Educación', 'San Juan de Lurigancho', 'SU SANTIDAD JUAN PABLO II', 'JIRON DELTA S/N', '', '', '0', '', '0', '-11.93857', '-76.99729', '1', '0', '0', '0000-00-00 00:00:00', '1', '2021-06-11 11:45:33');
INSERT INTO `localie` VALUES ('142', '742940', '16', 'Pública de gestión directa', 'Pública - Sector Educación', 'San Juan de Lurigancho', 'JOSE CARLOS MARIATEGUI', 'MZ E LOTE 3 ZONA 4', '', '', '0', '', '0', '-11.93617', '-76.98775', '1', '0', '0', '0000-00-00 00:00:00', '1', '2022-05-18 11:00:47');
INSERT INTO `localie` VALUES ('143', '777048', '8', 'Pública de gestión directa', 'Pública - Sector Educación', 'San Juan de Lurigancho', 'MARISCAL CACERES', 'MZ E LOTE 1 SECTOR III', '', '', '0', '', '0', '-11.94034', '-76.98262', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00');
INSERT INTO `localie` VALUES ('144', '777067', '16', 'Pública de gestión directa', 'Pública - Sector Educación', 'San Juan de Lurigancho', 'PROYECTO INTEGRAL NUEVO SAN JUAN', 'MZ C LOTE 34 SECTOR CRISTO REY', '', '', '0', '', '0', '-11.93936', '-77.01093', '1', '0', '0', '0000-00-00 00:00:00', '1', '2021-06-11 11:46:21');
INSERT INTO `localie` VALUES ('145', '777086', '16', 'Pública de gestión directa', 'Pública - Sector Educación', 'San Juan de Lurigancho', 'INTEGRACION SOLIDARIDAD Y PROGRESO', 'MZ J LOTE 8 SECTOR ANTONIO RAYMONDI', '', '', '0', '', '0', '-11.94222', '-77.00367', '1', '0', '0', '0000-00-00 00:00:00', '1', '2021-06-11 11:46:34');
INSERT INTO `localie` VALUES ('146', '777543', '8', 'Pública de gestión directa', 'Pública - Sector Educación', 'San Juan de Lurigancho', 'INTEGRACION, SOLIDARIDAD Y PROGRESO', 'MZ H LOTE 9 SECTOR LOS JARDINES AA.HH.', '', '', '0', '', '0', '-11.94576', '-76.99278', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00');
INSERT INTO `localie` VALUES ('147', '777661', '16', 'Pública de gestión directa', 'Pública - Sector Educación', 'San Juan de Lurigancho', 'SANTA MARIA DE JESUS PROYECTO INTEGRAL NUEVO SAN J', 'PARCELA - A MZ F LOTE 03 SECTOR HUAYRONA', '', '', '0', '', '0', '-11.93908', '-77.01463', '1', '0', '0', '0000-00-00 00:00:00', '1', '2021-06-11 11:46:44');
INSERT INTO `localie` VALUES ('148', '325400', '8', 'Pública de gestión directa', 'Pública - Sector Educación', 'San Juan de Lurigancho', 'SU SANTIDAD JUAN PABLO II', 'JIRON PARALELO S/N', '', '', '0', '', '0', '-11.94396', '-76.99146', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00');
INSERT INTO `localie` VALUES ('149', '324778', '8', 'Pública de gestión directa', 'Pública - Sector Educación', 'San Juan de Lurigancho', 'JOSE CARLOS MARIATEGUI', 'AVENIDA AMPLIACION OESTE S/N', '', '', '0', '', '0', '-11.94065', '-76.985', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00');
INSERT INTO `localie` VALUES ('150', '324844', '8', 'Pública de gestión directa', 'Pública - Sector Educación', 'San Juan de Lurigancho', '10 DE OCTUBRE', 'JIRON EL PEÑON S/N', '', '', '0', '', '0', '-11.9474', '-76.99004', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00');
INSERT INTO `localie` VALUES ('151', '324962', '16', 'Pública de gestión directa', 'Pública - Sector Educación', 'San Juan de Lurigancho', 'JOSE CARLOS MARIATEGUI', 'JIRON DEL PARQUE S/N', '', '', '0', '', '0', '-11.9351', '-76.98799', '1', '0', '0', '0000-00-00 00:00:00', '1', '2021-06-11 11:45:06');
INSERT INTO `localie` VALUES ('152', '325240', '16', 'Pública de gestión directa', 'Pública - Sector Educación', 'San Juan de Lurigancho', 'SAUL CANTORAL HUAMANI', 'AVENIDA SAUL CANTORAL HUAMANI S/N', '', '', '0', '', '0', '-11.9391', '-77.00205', '1', '0', '0', '0000-00-00 00:00:00', '1', '2021-06-11 11:45:23');
INSERT INTO `localie` VALUES ('153', '326838', '16', 'Pública de gestión privada', 'Pública - En convenio', 'San Juan de Lurigancho', 'JUAN PABLO II', 'AVENIDA EL MERCADO S/N', '', '', '0', '', '0', '-11.94028', '-76.99114', '1', '0', '0', '0000-00-00 00:00:00', '1', '2021-06-11 11:45:48');
INSERT INTO `localie` VALUES ('154', '823494', '8', 'Pública de gestión directa', 'Pública - Sector Educación', 'San Juan de Lurigancho', 'CRUZ DE MOTUPE', 'MZ I LOTE 21', '', '', '0', '', '0', '-11.938783', '-76.98027', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00');
INSERT INTO `localie` VALUES ('155', '598117', '8', 'Privada', 'Privada - Parroquial', 'San Juan de Lurigancho', 'SAUL CANTORAL HUAMANI', 'MZ A-3 LOTE 05', '', '', '0', '', '0', '-11.9393', '-77.0016', '0', '0', '0', '0000-00-00 00:00:00', '1', '2021-06-17 01:11:51');
INSERT INTO `localie` VALUES ('156', '645722', '8', 'Privada', 'Privada - Parroquial', 'San Juan de Lurigancho', '10 DE OCTUBRE', 'CALLE FRANCISCO INGA S/N MZ B11', '', '', '0', '', '0', '-11.94895', '-76.98897', '0', '0', '0', '0000-00-00 00:00:00', '1', '2021-07-23 00:10:06');
INSERT INTO `localie` VALUES ('157', '714013', '8', 'Privada', 'Privada - Particular', 'San Juan de Lurigancho', 'JOSE CARLOS MARIATEGUI', 'CALLE 55 MZ I8 LOTE 3 ZONA I', '', '', '0', '', '0', '-11.94291', '-76.98698', '0', '0', '0', '0000-00-00 00:00:00', '1', '2021-06-11 12:27:32');
INSERT INTO `localie` VALUES ('158', '510006', '16', 'Pública de gestión directa', 'Pública - Sector Educación', 'San Juan de Lurigancho', 'CASA BLANCA', 'JIRON DELTA S/N', '', '', '0', '', '0', '-11.9397', '-77.0003', '1', '0', '0', '0000-00-00 00:00:00', '1', '2021-06-11 11:46:01');
INSERT INTO `localie` VALUES ('159', '323887', '9', 'Pública de gestión directa', 'Pública - Sector Educación', 'San Juan de Lurigancho', 'HUASCAR', 'PASAJE SANTA ROSA S/N', '', '', '0', '', '0', '-11.96581', '-77.01079', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00');
INSERT INTO `localie` VALUES ('160', '323905', '9', 'Pública de gestión directa', 'Pública - Sector Educación', 'San Juan de Lurigancho', 'HUASCAR', 'AVENIDA CANTO GRANDE S/N', '', '', '0', '', '0', '-11.961', '-77.0019', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00');
INSERT INTO `localie` VALUES ('161', '323948', '9', 'Pública de gestión directa', 'Pública - Sector Educación', 'San Juan de Lurigancho', 'LAS TERRAZAS', 'MZ Q LOTE 15', '', '', '0', '', '0', '-11.97328', '-77.01349', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00');
INSERT INTO `localie` VALUES ('162', '325508', '9', 'Pública de gestión directa', 'Pública - Sector Educación', 'San Juan de Lurigancho', 'LA MANO DE DIOS', 'HUASCAR MZ B, LOTE 01', '', '', '0', '', '0', '-11.9517', '-77.006', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00');
INSERT INTO `localie` VALUES ('163', '324542', '9', 'Pública de gestión directa', 'Pública - Sector Educación', 'San Juan de Lurigancho', '9 DE OCTUBRE', 'AVENIDA FRANCISCO BOLOGNESI S/N', '', '', '0', '', '0', '-11.95843', '-77.00013', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00');
INSERT INTO `localie` VALUES ('164', '326819', '9', 'Pública de gestión privada', 'Pública - En convenio', 'San Juan de Lurigancho', 'HUASCAR', 'HUASCAR S/N', '', '', '0', '', '0', '-11.96953', '-77.01032', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00');
INSERT INTO `localie` VALUES ('165', '325264', '9', 'Pública de gestión directa', 'Pública - Sector Educación', 'San Juan de Lurigancho', 'HUASCAR', 'AVENIDA FRANCISCO BOLOGNESI S/N', '', '', '0', '', '0', '-11.9651', '-77.00436', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00');
INSERT INTO `localie` VALUES ('166', '715994', '9', 'Pública de gestión directa', 'Pública - Sector Educación', 'San Juan de Lurigancho', 'UPIS  - HUASCAR GRUPO 16', 'UPIS - HUASCAR GRUPO 16 SECTOR B', '', '', '0', '', '0', '-11.95484', '-77.00299', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00');
INSERT INTO `localie` VALUES ('167', '748112', '9', 'Pública de gestión directa', 'Pública - Sector Educación', 'San Juan de Lurigancho', 'UPIS HUASCAR - GRUPO 10', 'UPIS HUASCAR - GRUPO 10 SECTOR A AA.HH.', '', '', '0', '', '0', '-11.962435', '-77.005214', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00');
INSERT INTO `localie` VALUES ('168', '777656', '9', 'Pública de gestión directa', 'Pública - Sector Educación', 'San Juan de Lurigancho', 'CANTO GRANDE - UNIDAD 2A', 'CALLE LOTE EDUCACIËN S/N MZ Y', '', '', '0', '', '0', '-11.969889', '-77.008032', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00');
INSERT INTO `localie` VALUES ('169', '324759', '9', 'Pública de gestión directa', 'Pública - Sector Educación', 'San Juan de Lurigancho', 'MACHUPICCHU', 'JIRON QUILLABAMBA 281', '', '', '0', '', '0', '-11.97143', '-77.00932', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00');
INSERT INTO `localie` VALUES ('170', '324976', '9', 'Pública de gestión directa', 'Pública - Sector Educación', 'San Juan de Lurigancho', 'LAS TERRAZAS', 'AVENIDA LOS LIBERTADORES S/N', '', '', '0', '', '0', '-11.97313', '-77.01367', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00');
INSERT INTO `localie` VALUES ('171', '324575', '9', 'Pública de gestión directa', 'Pública - Sector Educación', 'San Juan de Lurigancho', 'HUASCAR', 'AVENIDA JOSE C MARIATEGUI S/N ALT PARADERO S/N', '', '', '0', '', '0', '-11.9584', '-77.00505', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00');
INSERT INTO `localie` VALUES ('172', '324617', '9', 'Pública de gestión directa', 'Pública - Sector Educación', 'San Juan de Lurigancho', 'HUASCAR', 'AVENIDA SAN MARTIN S/N', '', '', '0', '', '0', '-11.96496', '-77.01058', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00');
INSERT INTO `localie` VALUES ('173', '324721', '9', 'Pública de gestión directa', 'Pública - Sector Educación', 'San Juan de Lurigancho', 'HUASCAR', 'AVENIDA LOS NARDOS SECTOR B GRUPO 18', '', '', '0', '', '0', '-11.95079', '-77.00391', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00');
INSERT INTO `localie` VALUES ('174', '823446', '9', 'Pública de gestión directa', 'Pública - Sector Educación', 'San Juan de Lurigancho', 'BELEN', 'MZ ED', '', '', '0', '', '0', '-11.964646', '-77.015952', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00');
INSERT INTO `localie` VALUES ('175', '325103', '9', 'Pública de gestión directa', 'Pública - Sector Educación', 'San Juan de Lurigancho', 'HUASCAR SECTOR A', 'AVENIDA 12 S/N', '', '', '0', '', '0', '-11.96662', '-77.00535', '1', '0', '0', '0000-00-00 00:00:00', '1', '2021-08-03 15:58:09');
INSERT INTO `localie` VALUES ('176', '325457', '10', 'Pública de gestión directa', 'Pública - Sector Educación', 'San Juan de Lurigancho', 'BAYOVAR', 'BAYOVAR MZ 58, LOTE 8', '', '', '0', '', '0', '-11.95366', '-76.99542', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00');
INSERT INTO `localie` VALUES ('177', '323929', '10', 'Pública de gestión directa', 'Pública - Sector Educación', 'San Juan de Lurigancho', 'ARRIBA PERU', 'PARQUE CENTRAL S/N', '', '', '0', '', '0', '-11.95728', '-76.99501', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00');
INSERT INTO `localie` VALUES ('178', '323934', '10', 'Pública de gestión directa', 'Pública - Sector Educación', 'San Juan de Lurigancho', 'BAYOVAR', 'BAYOVAR', '', '', '0', '', '0', '-11.95079', '-76.99181', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00');
INSERT INTO `localie` VALUES ('179', '323991', '10', 'Pública de gestión directa', 'Pública - Sector Educación', 'San Juan de Lurigancho', 'PROYECTOS ESPECIALES', 'JIRON SEVILLA S/N', '', '', '0', '', '0', '-11.95743', '-76.99156', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00');
INSERT INTO `localie` VALUES ('180', '325363', '10', 'Pública de gestión directa', 'Pública - Sector Educación', 'San Juan de Lurigancho', '5 DE NOVIEMBRE', 'MARISCAL CACERES MZ N LOTE N-4', '', '', '0', '', '0', '-11.96085', '-76.99029', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00');
INSERT INTO `localie` VALUES ('181', '324212', '10', 'Pública de gestión directa', 'Pública - Sector Educación', 'San Juan de Lurigancho', 'HORACIO ZEBALLOS', 'HORACIO ZEVALLOS S/N', '', '', '0', '', '0', '-11.96288', '-76.99184', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00');
INSERT INTO `localie` VALUES ('182', '748697', '10', 'Pública de gestión directa', 'Pública - Sector Educación', 'San Juan de Lurigancho', 'PROYECTOS ESPECIALES', 'MZ G LOTE 3 ETAPA I AA.HH.', '', '', '0', '', '0', '-11.961651', '-76.998608', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00');
INSERT INTO `localie` VALUES ('183', '797923', '10', 'Pública de gestión directa', 'Pública - Sector Educación', 'San Juan de Lurigancho', 'AMPLIACION BAYOVAR', 'AVENIDA 30 DE JUNIO PARELA - A S/N MZ R LOTE 1 SECTOR CRUZ BLANCA', '', '', '0', '', '0', '-11.951065', '-76.998852', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00');
INSERT INTO `localie` VALUES ('184', '325424', '10', 'Pública de gestión directa', 'Pública - Sector Educación', 'San Juan de Lurigancho', 'BAYOVAR', 'AVENIDA 1 DE MAYO S/N', '', '', '0', '', '0', '-11.95306', '-76.99228', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00');
INSERT INTO `localie` VALUES ('185', '324702', '10', 'Pública de gestión directa', 'Pública - Sector Educación', 'San Juan de Lurigancho', 'PROYECTOS ESPECIALES', 'AVENIDA REPUBLICA DE POLONIA S/N', '', '', '0', '', '0', '-11.95744', '-76.98961', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00');
INSERT INTO `localie` VALUES ('186', '324740', '10', 'Pública de gestión directa', 'Pública - Sector Educación', 'San Juan de Lurigancho', 'ARRIBA PERU', 'CALLE ROTEROAM S/N', '', '', '0', '', '0', '-11.95741', '-76.993', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00');
INSERT INTO `localie` VALUES ('187', '324783', '10', 'Pública de gestión directa', 'Pública - Sector Educación', 'San Juan de Lurigancho', 'PROYECTOS ESPECIALES', 'AVENIDA REPUBLICA DE POLONIA MZ W4 LOTE 1', '', '', '0', '', '0', '-11.96231', '-76.99322', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00');
INSERT INTO `localie` VALUES ('188', '324957', '10', 'Pública de gestión directa', 'Pública - Sector Educación', 'San Juan de Lurigancho', 'BUENOS AIRES', 'CALLE RUAM S/N', '', '', '0', '', '0', '-11.96441', '-76.99267', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00');
INSERT INTO `localie` VALUES ('189', '326824', '10', 'Pública de gestión privada', 'Pública - En convenio', 'San Juan de Lurigancho', 'ARRIBA PERU', 'AVENIDA NACIONES UNIDAS MZ 37-38', '', '', '0', '', '0', '-11.95877', '-76.99457', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00');
INSERT INTO `localie` VALUES ('190', '325023', '10', 'Pública de gestión directa', 'Pública - Sector Educación', 'San Juan de Lurigancho', 'HUASCAR', 'AVENIDA 1 DE MAYO S/N', '', '', '0', '', '0', '-11.95086', '-76.99035', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00');
INSERT INTO `localie` VALUES ('191', '323806', '11', 'Pública de gestión directa', 'Pública - Sector Educación', 'San Juan de Lurigancho', 'CANTO CHICO', 'AVENIDA LIMA MZ C LOTE 44', '', '', '0', '', '0', '-12.00682', '-77.01813', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00');
INSERT INTO `localie` VALUES ('192', '323774', '11', 'Pública de gestión directa', 'Pública - Sector Educación', 'San Juan de Lurigancho', 'SAN HILARION', 'JIRON LAS SABILAS S/N', '', '', '0', '', '0', '-12.00082', '-77.01207', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00');
INSERT INTO `localie` VALUES ('193', '324009', '11', 'Pública de gestión directa', 'Pública - Sector Educación', 'San Juan de Lurigancho', 'SAN HILARION', 'JIRON CRIPTON MZ E1 LOTE 01', '', '', '0', '', '0', '-11.9978', '-77.01774', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00');
INSERT INTO `localie` VALUES ('194', '324354', '11', 'Pública de gestión directa', 'Pública - Sector Educación', 'San Juan de Lurigancho', 'SAN FERNANDO', 'AMPLIACION SAN FERNANDO', '', '', '0', '', '0', '-11.9757', '-77.0206', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00');
INSERT INTO `localie` VALUES ('195', '325476', '11', 'Pública de gestión directa', 'Pública - Sector Educación', 'San Juan de Lurigancho', 'SAN IGNACIO', 'CALLE PIMPINELA MZ D LOTE 22', '', '', '0', '', '0', '-11.99094', '-77.01365', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00');
INSERT INTO `localie` VALUES ('196', '325141', '11', 'Pública de gestión directa', 'Pública - Sector Educación', 'San Juan de Lurigancho', 'LOS ANGELES', 'JIRON LAS NEBULOSAS S/N', '', '', '0', '', '0', '-11.98712', '-77.00951', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00');
INSERT INTO `localie` VALUES ('197', '324504', '11', 'Pública de gestión directa', 'Pública - Sector Educación', 'San Juan de Lurigancho', 'SANTA ELIZABETH', 'JIRON LOS CENTAUROS S/N', '', '', '0', '', '0', '-11.98801', '-77.0143', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00');
INSERT INTO `localie` VALUES ('198', '324622', '11', 'Pública de gestión directa', 'Pública - Sector Educación', 'San Juan de Lurigancho', 'SANTA ELIZABETH', 'JIRON NEVADO DE HUASCARAN S/N', '', '', '0', '', '0', '-11.98142', '-77.01833', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00');
INSERT INTO `localie` VALUES ('199', '324863', '11', 'Pública de gestión directa', 'Pública - Sector Educación', 'San Juan de Lurigancho', 'AYACUCHO', 'MZ Q MZ Q', '', '', '0', '', '0', '-11.98882', '-77.01726', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00');
INSERT INTO `localie` VALUES ('200', '324453', '11', 'Pública de gestión directa', 'Pública - Sector Educación', 'San Juan de Lurigancho', 'SAN HILARION', 'JIRON LOS GERMANIOS S/N', '', '', '0', '', '0', '-11.99519', '-77.01636', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00');
INSERT INTO `localie` VALUES ('201', '686312', '11', 'Pública de gestión directa', 'Pública - Sector Educación', 'San Juan de Lurigancho', 'SEÑOR DE LUREN', 'SEÑOR DE LUREN', '', '', '0', '', '0', '-11.9876', '-77.0208', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00');
INSERT INTO `localie` VALUES ('202', '324410', '11', 'Pública de gestión directa', 'Pública - Sector Educación', 'San Juan de Lurigancho', 'CANTO CHICO', 'PASAJE TUMBES S/N', '', '', '0', '', '0', '-12.00468', '-77.01691', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00');
INSERT INTO `localie` VALUES ('203', '325117', '11', 'Pública de gestión directa', 'Pública - Sector Educación', 'San Juan de Lurigancho', 'CANTO BELLO', 'AVENIDA CANTO BELLO S/N', '', '', '0', '', '0', '-11.97725', '-77.0184', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00');
INSERT INTO `localie` VALUES ('204', '324660', '11', 'Pública de gestión directa', 'Pública - Sector Educación', 'San Juan de Lurigancho', 'GANIMEDES', 'JIRON MARTE Y PLUTON S/N', '', '', '0', '', '0', '-11.98397', '-77.01347', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00');
INSERT INTO `localie` VALUES ('205', '324735', '11', 'Pública de gestión directa', 'Pública - Sector Educación', 'San Juan de Lurigancho', 'SAN HILARION', 'JIRON LOS JOBOS S/N', '', '', '0', '', '0', '-11.99997', '-77.0125', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00');
INSERT INTO `localie` VALUES ('206', '324801', '11', 'Pública de gestión directa', 'Pública - Sector Educación', 'San Juan de Lurigancho', 'MANTARO', 'JIRON LAS ACASIAS S/N', '', '', '0', '', '0', '-11.99332', '-77.01188', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00');
INSERT INTO `localie` VALUES ('207', '324556', '11', 'Pública de gestión directa', 'Pública - Sector Educación', 'San Juan de Lurigancho', 'NUEVO PERU', 'AVENIDA NUEVO PERU MZ D LOTE 8-9', '', '', '0', '', '0', '-12.00197', '-77.01857', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00');
INSERT INTO `localie` VALUES ('208', '566060', '11', 'Pública de gestión directa', 'Pública - Sector Educación', 'San Juan de Lurigancho', 'SAN IGNACIO', 'AVENIDA MZ L LOTE 16', '', '', '0', '', '0', '-11.993', '-77.014', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00');
INSERT INTO `localie` VALUES ('209', '325042', '11', 'Pública de gestión directa', 'Pública - Sector Educación', 'San Juan de Lurigancho', 'SAN CARLOS', 'JIRON GALAXIA Y EL SOL S/N', '', '', '0', '', '0', '-11.98373', '-77.01021', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00');
INSERT INTO `localie` VALUES ('210', '323811', '12', 'Pública de gestión directa', 'Pública - Sector Educación', 'San Juan de Lurigancho', 'CANTO GRANDE', 'AVENIDA LAS HORTENCIAS 200', '', '', '0', '', '0', '-11.97192', '-77.00232', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00');
INSERT INTO `localie` VALUES ('211', '324716', '12', 'Pública de gestión directa', 'Pública - Sector Educación', 'San Juan de Lurigancho', 'LOS ALAMOS', 'PARQUE PRINCIPAL S/N', '', '', '0', '', '0', '-11.9642', '-76.99807', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00');
INSERT INTO `localie` VALUES ('212', '325004', '12', 'Pública de gestión directa', 'Pública - Sector Educación', 'San Juan de Lurigancho', 'LOS PINOS', 'AVENIDA REPUBLICA DE POLONIA S/N', '', '', '0', '', '0', '-11.97641', '-77.004', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00');
INSERT INTO `localie` VALUES ('213', '324655', '12', 'Pública de gestión directa', 'Pública - Sector Educación', 'San Juan de Lurigancho', 'JESUS OROPEZA', 'PARQUE JESUS OROPEZA CHONTA S/N', '', '', '0', '', '0', '-11.96671', '-77.00184', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00');
INSERT INTO `localie` VALUES ('214', '324448', '12', 'Pública de gestión directa', 'Pública - Sector Educación', 'San Juan de Lurigancho', 'CANTO GRANDE', 'AVENIDA LAS HORTENCIAS 200', '', '', '0', '', '0', '-11.97175', '-77.00238', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00');
INSERT INTO `localie` VALUES ('215', '324641', '12', 'Pública de gestión directa', 'Pública - Sector Educación', 'San Juan de Lurigancho', 'MARISCAL LUZURRIAGA', 'JIRON RIO SANTA MZ C LOTE 11', '', '', '0', '', '0', '-11.96855', '-76.9985', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00');
INSERT INTO `localie` VALUES ('216', '325297', '12', 'Pública de gestión directa', 'Pública - Sector Educación', 'San Juan de Lurigancho', 'LOS PINOS', 'AVENIDA WIESE S/N', '', '', '0', '', '0', '-11.97646', '-77.00293', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00');
INSERT INTO `localie` VALUES ('217', '325080', '12', 'Pública de gestión directa', 'Pública - Sector Educación', 'San Juan de Lurigancho', 'LOS PINOS', 'AVENIDA REPUBLICA DE POLONIA S/N', '', '', '0', '', '0', '-11.97696', '-77.00457', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00');
INSERT INTO `localie` VALUES ('218', '714701', '12', 'Pública de gestión directa', 'Pública - Sector Educación', 'San Juan de Lurigancho', 'JESUS OROPEZA', 'JESUS OROPEZA CHONTA MZ H LOTE 4', '', '', '0', '', '0', '-11.96742', '-77.00152', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00');
INSERT INTO `localie` VALUES ('219', '304718', '13', 'Pública de gestión directa', 'Pública - Sector Educación', 'El Agustino', 'CANAN', 'NAZARETH', '', '', '0', '', '0', '-12.02803', '-76.98938', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00');
INSERT INTO `localie` VALUES ('220', '304742', '13', 'Pública de gestión directa', 'Pública - Sector Educación', 'El Agustino', 'LA MENACHO', 'AVENIDA JOSE CARLOS MARIATEGUI S/N', '', '', '0', '', '0', '-12.03934', '-76.99667', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00');
INSERT INTO `localie` VALUES ('221', '304817', '13', 'Pública de gestión directa', 'Pública - Sector Educación', 'El Agustino', 'BETANIA', 'JIRON LOS ARTESANOS 140', '', '', '0', '', '0', '-12.02776', '-76.99299', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00');
INSERT INTO `localie` VALUES ('222', '304803', '13', 'Pública de gestión directa', 'Pública - Sector Educación', 'El Agustino', 'VICENTELO BAJO', 'PASAJE ALBERTO GAMARRA MALLMA S/N', '', '', '0', '', '0', '-12.0299', '-77.00307', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00');
INSERT INTO `localie` VALUES ('223', '304841', '13', 'Pública de gestión directa', 'Pública - Sector Educación', 'El Agustino', 'MARIA HERRERA DE ACOSTA', 'CALLE PLACIDO JIMENEZ Y LOS FICUS MZ C LOTE 1', '', '', '0', '', '0', '-12.0372', '-77.00614', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00');
INSERT INTO `localie` VALUES ('224', '304884', '13', 'Pública de gestión directa', 'Pública - Sector Educación', 'El Agustino', 'VICENTELO BAJO', 'INDEPENDENCIA MZ D LOTE 19', '', '', '0', '', '0', '-12.02855', '-76.997', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00');
INSERT INTO `localie` VALUES ('225', '304921', '13', 'Pública de gestión directa', 'Pública - Sector Educación', 'El Agustino', 'ANCIETA BAJA', 'LOS BRILLANTES', '', '', '0', '', '0', '-12.03325', '-77.00318', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00');
INSERT INTO `localie` VALUES ('226', '304916', '13', 'Pública de gestión directa', 'Pública - Sector Educación', 'El Agustino', 'LA PRIMAVERA', 'CALLE LOS LIRIOS 105', '', '', '0', '', '0', '-12.03454', '-77.00591', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00');
INSERT INTO `localie` VALUES ('227', '304983', '13', 'Pública de gestión directa', 'Pública - Sector Educación', 'El Agustino', 'LA ATARJEA', 'CALLE AGUA MARINA S/N', '', '', '0', '', '0', '-12.03328', '-76.98871', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00');
INSERT INTO `localie` VALUES ('228', '304860', '13', 'Pública de gestión directa', 'Pública - Sector Educación', 'El Agustino', 'TAYACAJA', 'CALLE LOS ALGARROBOS MZ Q', '', '', '0', '', '0', '-12.03787', '-76.99053', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00');
INSERT INTO `localie` VALUES ('229', '304879', '13', 'Pública de gestión directa', 'Pública - Sector Educación', 'El Agustino', 'LA MENACHO', 'AVENIDA LOS ALGARROBOS S/N', '', '', '0', '', '0', '-12.03924', '-76.99658', '1', '0', '0', '0000-00-00 00:00:00', '1', '2022-04-27 13:01:07');
INSERT INTO `localie` VALUES ('230', '304898', '13', 'Pública de gestión directa', 'Pública - Sector Educación', 'El Agustino', 'HUANCAYO', 'CALLE CARACOL 1040', '', '', '0', '', '0', '-12.03069', '-76.99713', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00');
INSERT INTO `localie` VALUES ('231', '304935', '13', 'Pública de gestión directa', 'Pública - Sector Educación', 'El Agustino', 'ANCIETA BAJA', 'CALLE 7 DE JUNIO MZ A LOTE 49', '', '', '0', '', '0', '-12.03166', '-77.00763', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00');
INSERT INTO `localie` VALUES ('232', '305138', '13', 'Pública de gestión directa', 'Pública - Sector Educación', 'El Agustino', 'VILLA HERMOSA', 'AVENIDA CESAR VALLEJO 1390', '', '', '0', '', '0', '-12.0351', '-76.9935', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00');
INSERT INTO `localie` VALUES ('233', '304756', '14', 'Pública de gestión directa', 'Pública - Sector Educación', 'El Agustino', 'LA CORPORACION', 'JIRON MARIANO BALDARRAGO S/N', '', '', '0', '', '0', '-12.0514', '-76.99937', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00');
INSERT INTO `localie` VALUES ('234', '304940', '14', 'Pública de gestión directa', 'Pública - Sector Educación', 'El Agustino', 'SANTOYO', 'JIRON CAJACAY', '', '', '0', '', '0', '-12.05019', '-77.00619', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00');
INSERT INTO `localie` VALUES ('235', '304704', '14', 'Pública de gestión directa', 'Pública - Sector Educación', 'El Agustino', 'VILLA HERMOSA', 'PARQUE PROGRESO S/N', '', '', '0', '', '0', '-12.0408', '-76.98958', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00');
INSERT INTO `localie` VALUES ('236', '304822', '14', 'Pública de gestión directa', 'Pública - Sector Educación', 'El Agustino', 'NOCHETO', 'PASAJE AMAUTA S/N MZ D2 LOTE 1', '', '', '0', '', '0', '-12.04507', '-76.9855', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00');
INSERT INTO `localie` VALUES ('237', '304836', '14', 'Pública de gestión directa', 'Pública - Sector Educación', 'El Agustino', 'CATALINA HUANCA', 'JIRON TERESA GONZALES DE FANNING S/N', '', '', '0', '', '0', '-12.05106', '-76.99548', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00');
INSERT INTO `localie` VALUES ('238', '304855', '14', 'Pública de gestión directa', 'Pública - Sector Educación', 'El Agustino', 'ANCIETA ALTA', 'CALLE CANADA MZ D LOTE 10 ZONA II', '', '', '0', '', '0', '-12.04267', '-76.99784', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00');
INSERT INTO `localie` VALUES ('239', '305119', '14', 'Pública de gestión directa', 'Pública - Sector Educación', 'El Agustino', 'LA PRADERA', 'MZ RR LOTE 23 ZONA I', '', '', '0', '', '0', '-12.03029', '-76.96282', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00');
INSERT INTO `localie` VALUES ('240', '304799', '14', 'Pública de gestión directa', 'Pública - Sector Educación', 'El Agustino', 'EL INDEPENDIENTE', 'JIRON ALONSO PALOMINO 228', '', '', '0', '', '0', '-12.05187', '-77.00178', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00');
INSERT INTO `localie` VALUES ('241', '304959', '14', 'Pública de gestión directa', 'Pública - Sector Educación', 'El Agustino', 'ANCIETA ALTA', 'CALLE 21 MZ H4', '', '', '0', '', '0', '-12.04472', '-77.00309', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00');
INSERT INTO `localie` VALUES ('242', '304964', '14', 'Pública de gestión directa', 'Pública - Sector Educación', 'El Agustino', 'VILLA HERMOSA', 'JIRON AGUAS VERDES S/N', '', '', '0', '', '0', '-12.04202', '-76.9892', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00');
INSERT INTO `localie` VALUES ('243', '305162', '14', 'Pública de gestión privada', 'Pública - En convenio', 'El Agustino', 'VILLA HERMOSA', 'RIO CHEPEN', '', '', '0', '', '0', '-12.04198', '-76.98976', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00');
INSERT INTO `localie` VALUES ('244', '305020', '14', 'Pública de gestión directa', 'Pública - Sector Educación', 'El Agustino', 'SANTA ISABEL', 'AVENIDA INDEPENDENCIA 586', '', '', '0', '', '0', '-12.05531', '-77.00129', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00');
INSERT INTO `localie` VALUES ('245', '304997', '14', 'Pública de gestión directa', 'Pública - Sector Educación', 'El Agustino', 'ANCIETA ALTA', 'AVENIDA RIVA AGUERO 1575', '', '', '0', '', '0', '-12.04543', '-76.99866', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00');
INSERT INTO `localie` VALUES ('246', '305039', '14', 'Pública de gestión directa', 'Pública - Sector Educación', 'El Agustino', 'LA CORPORACION', 'JIRON MARIANO BALDARRAGA S/N', '', '', '0', '', '0', '-12.05135', '-76.99814', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00');
INSERT INTO `localie` VALUES ('247', '305082', '14', 'Pública de gestión directa', 'Pública - Sector Educación', 'El Agustino', 'ANCIETA ALTA', 'AVENIDA RIVA AGUERO 1758', '', '', '0', '', '0', '-12.04317', '-76.99724', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00');
INSERT INTO `localie` VALUES ('248', '510935', '14', 'Pública de gestión directa', 'Pública - Sector Educación', 'El Agustino', 'CORPORACIÓN', 'MARIANO BALDERRAGO MZ M LOTE 25', '', '', '0', '', '0', '-12.04996', '-77.00027', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00');
INSERT INTO `localie` VALUES ('249', '305001', '15', 'Pública de gestión directa', 'Pública - Sector Educación', 'El Agustino', 'SANTA ISABEL', 'CALLE INCA RIPAC S/N', '', '', '0', '', '0', '-12.05145', '-77.00453', '1', '0', '0', '0000-00-00 00:00:00', '1', '2021-06-15 12:27:37');
INSERT INTO `localie` VALUES ('250', '304723', '15', 'Pública de gestión directa', 'Pública - Sector Educación', 'El Agustino', 'SAN CAYETANO', 'CALLE ZAPOTE S/N', '', '', '0', '', '0', '-12.05725', '-77.0048', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00');
INSERT INTO `localie` VALUES ('251', '304902', '15', 'Pública de gestión directa', 'Pública - Sector Educación', 'Ate', 'VALDIVIESO', 'JIRON MELITON CARBAJAL 547', '', '', '0', '', '0', '-12.06213', '-76.98832', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00');
INSERT INTO `localie` VALUES ('252', '304978', '15', 'Pública de gestión directa', 'Pública - Sector Educación', 'El Agustino', 'SANTOYO', 'JIRON CERRO AZUL 2126', '', '', '0', '', '0', '-12.05064', '-77.00895', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00');
INSERT INTO `localie` VALUES ('253', '305015', '15', 'Pública de gestión directa', 'Pública - Sector Educación', 'El Agustino', 'SANTOYO', 'AVENIDA RIVA AGUERO 517', '', '', '0', '', '0', '-12.05479', '-77.00436', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00');
INSERT INTO `localie` VALUES ('254', '305096', '15', 'Pública de gestión directa', 'Pública - Sector Educación', 'El Agustino', 'SAN CAYETANO', 'AVENIDA RIVA AGUERO 176', '', '', '0', '', '0', '-12.05809', '-77.00658', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00');
INSERT INTO `localie` VALUES ('255', '305044', '15', 'Pública de gestión directa', 'Pública - Sector Educación', 'El Agustino', 'SAN PEDRO', 'JIRON ABRAHAM VALDELOMAR 565', '', '', '0', '', '0', '-12.05965', '-77.0024', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00');
INSERT INTO `localie` VALUES ('256', '305100', '15', 'Pública de gestión directa', 'Pública - Sector Educación', 'El Agustino', 'LA ATARJEA', 'CALLE GUADALUPE S/N', '', '', '0', '', '0', '-12.05427', '-77.00689', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00');
INSERT INTO `localie` VALUES ('257', '304761', '15', 'Pública de gestión directa', 'Pública - Sector Educación', 'El Agustino', '7 DE OCTUBRE', 'PASAJE LOS ANGELES S/N', '', '', '0', '', '0', '-12.05639', '-76.99427', '1', '0', '0', '0000-00-00 00:00:00', '1', '2019-09-13 15:06:09');
INSERT INTO `localie` VALUES ('258', '305063', '15', 'Pública de gestión directa', 'Pública - Sector Educación', 'El Agustino', '7 DE OCTUBRE', 'AVENIDA GARCILAZO DE LA VEGA 1151', '', '', '0', '', '0', '-12.0597', '-76.9969', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00');
INSERT INTO `localie` VALUES ('259', '305077', '15', 'Pública de gestión directa', 'Pública - Sector Educación', 'El Agustino', 'SAN CAYETANO', 'JIRON SIMON BOLIVAR 125', '', '', '0', '', '0', '-12.05666', '-77.00763', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00');
INSERT INTO `localie` VALUES ('260', '304775', '15', 'Pública de gestión directa', 'Pública - Sector Educación', 'El Agustino', 'EL AGUSTINO', 'AVENIDA GARCILAZO DE LA VEGA 320', '', '', '0', '', '0', '-12.06069', '-77.0037', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00');
INSERT INTO `localie` VALUES ('261', '304780', '15', 'Pública de gestión directa', 'Pública - Sector Educación', 'El Agustino', 'SAN PEDRO', 'AVENIDA 15 DE ABRIL 344', '', '', '0', '', '0', '-12.05957', '-77.00421', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00');
INSERT INTO `localie` VALUES ('262', '305124', '15', 'Pública de gestión directa', 'Pública - Sector Educación', 'El Agustino', 'SANTOYO', 'JIRON PATIVILCA S/N', '', '', '0', '', '0', '-12.05076', '-77.01079', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00');
INSERT INTO `localie` VALUES ('263', '714225', '15', 'Privada', 'Privada - Parroquial', 'El Agustino', '7 DE OCTUBRE', 'GARCILAZO DE LA VEGA', '', '', '0', '', '0', '-12.05879', '-76.99526', '0', '0', '0', '0000-00-00 00:00:00', '1', '2021-08-02 16:15:23');
INSERT INTO `localie` VALUES ('264', '714287', '15', 'Pública de gestión directa', 'Pública - Otro Sector Público', 'El Agustino', 'SANTOYO', 'JIRON LLAMELLIN 330', '', '', '0', '', '0', '-12.05292', '-77.00809', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00');
INSERT INTO `localie` VALUES ('265', '305124', null, null, null, null, null, null, null, null, null, null, '0', null, null, '1', '0', '0', '2021-08-03 10:04:58', null, null);
INSERT INTO `localie` VALUES ('266', '840827', '9', 'Pública de gestión directa', 'Pública - Sector Educación', 'San Juan de Lurigancho', 'LOS AMAUTAS - HUASCAR', 'Mz G Lote 1', '', '', '0', '', '0', '-11.96679', '-77.00556', '1', '0', '0', '2021-08-03 15:44:16', '1', '2021-08-03 16:26:47');
INSERT INTO `localie` VALUES ('267', '304879', '0', '', 'Elegir...', '0', '', '', '', '', '0', '', '0', '0', '0', '0', '0', '0', '2022-04-27 12:56:05', '1', '2022-04-27 13:01:25');
INSERT INTO `localie` VALUES ('268', '858191', '5', 'Pública de gestión directa', 'Pública - Sector Educación', 'San Juan de Lurigancho', 'SAN JUAN DE LURIGANCHO', 'CACTUS DE AYACUCHO', '', '', '0', '', '0', '0', '0', '1', '0', '0', '2023-02-20 10:20:10', '1', '2023-04-19 15:36:41');
INSERT INTO `localie` VALUES ('269', '858191', null, null, null, null, null, null, null, null, null, null, '0', null, null, '1', '0', '0', '2023-02-20 10:22:04', null, null);

-- ----------------------------
-- Table structure for modalidades
-- ----------------------------
DROP TABLE IF EXISTS `modalidades`;
CREATE TABLE `modalidades` (
  `mod_id` int(11) NOT NULL AUTO_INCREMENT,
  `mod_nombre` varchar(250) DEFAULT NULL,
  `mod_abreviatura` varchar(25) DEFAULT NULL,
  `mod_estado` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`mod_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of modalidades
-- ----------------------------
INSERT INTO `modalidades` VALUES ('1', 'Educación Básica Regular', 'EBR', '1');
INSERT INTO `modalidades` VALUES ('2', 'Programa de Intervención Temprana', 'PRITE', '1');
INSERT INTO `modalidades` VALUES ('3', 'Educación Básica Especial', 'EBE', '1');
INSERT INTO `modalidades` VALUES ('4', 'Educación Básica Alternativa', 'EBA', '1');
INSERT INTO `modalidades` VALUES ('5', 'Educación Técnico Productiva', 'ETP', '1');
INSERT INTO `modalidades` VALUES ('6', 'OTROS', 'VARIOS', '1');

-- ----------------------------
-- Table structure for modularie
-- ----------------------------
DROP TABLE IF EXISTS `modularie`;
CREATE TABLE `modularie` (
  `mod_id` int(11) NOT NULL,
  `mod_codigo` varchar(7) DEFAULT NULL,
  `mod_nombre` varchar(150) DEFAULT NULL,
  `mod_nivel` varchar(100) DEFAULT NULL,
  `mod_flagnivel` int(2) DEFAULT NULL,
  `mod_modform` varchar(100) DEFAULT NULL,
  `mod_modformabrev` varchar(100) DEFAULT NULL,
  `mod_turno` varchar(25) DEFAULT NULL,
  `mod_aniocreacion` int(4) DEFAULT NULL,
  `mod_rdcreacion` varchar(80) DEFAULT NULL,
  `mod_telefono` varchar(9) DEFAULT NULL,
  `mod_correo` varchar(100) DEFAULT NULL,
  `mod_convenio` int(1) DEFAULT '0',
  `mod_estado` int(1) DEFAULT '1',
  `mod_aniobaja` int(4) DEFAULT '2100',
  `mod_uscreado` int(11) DEFAULT NULL,
  `mod_fcreado` datetime DEFAULT NULL,
  `mod_usmodif` int(11) DEFAULT NULL,
  `mod_fmodif` datetime DEFAULT NULL,
  `localie_loc_id` int(11) NOT NULL,
  PRIMARY KEY (`mod_id`),
  KEY `fk_modularie_localie1_idx` (`localie_loc_id`),
  CONSTRAINT `fk_modularie_localie1` FOREIGN KEY (`localie_loc_id`) REFERENCES `localie` (`loc_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of modularie
-- ----------------------------
INSERT INTO `modularie` VALUES ('1', '0335273', '017 CUNA JARDIN', 'Inicial', '1', 'Educació', 'EBR', 'Mañana-Tarde', '0', '', '2539610', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '1', '2018-04-09 10:54:55', '233');
INSERT INTO `modularie` VALUES ('2', '0335364', '0015 LAS AZUCENAS', 'Inicial', '1', 'Educació', 'EBR', 'Mañana-Tarde', '0', '', '3749565', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '24');
INSERT INTO `modularie` VALUES ('3', '0335380', '0038 VIRGEN MEDALLA MILAGROSA', 'Inicial', '1', 'Educació', 'EBR', 'Mañana', '0', '', '0', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '1', '2022-05-11 13:38:40', '191');
INSERT INTO `modularie` VALUES ('4', '0335398', '0039 JOSE MARIA ARGUEDAS', 'Inicial', '1', 'Educació', 'EBR', 'Mañana-Tarde', '0', '', '3892935', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '210');
INSERT INTO `modularie` VALUES ('5', '0335406', '0036 MADRE MARIA AUXILIADORA', 'Inicial', '1', 'Educació', 'EBR', 'Mañana-Tarde', '0', '', '4591986', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '25');
INSERT INTO `modularie` VALUES ('6', '0335422', '0063 VIRGEN DE LOURDES', 'Inicial', '1', 'Educació', 'EBR', 'Mañana-Tarde', '0', '', '3769519', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '47');
INSERT INTO `modularie` VALUES ('7', '0339457', '1169 ALMIRANTE MIGUEL GRAU S', 'Inicial', '1', 'Educació', 'EBR', 'Mañana-Tarde', '0', '', '0', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '1', '2021-06-16 11:52:17', '249');
INSERT INTO `modularie` VALUES ('8', '0482406', '0041 EL BOSQUECITO', 'Inicial', '1', 'Educació', 'EBR', 'Mañana', '0', '', '3871070', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '69');
INSERT INTO `modularie` VALUES ('9', '0496513', '0032 NIÑO JESUS DE ZARATE', 'Inicial', '1', 'Educació', 'EBR', 'Mañana-Tarde', '0', '', '2539610', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '1', '2021-06-16 14:47:51', '1');
INSERT INTO `modularie` VALUES ('10', '0496679', '0009 JOSE MARIA ARGUEDAS', 'Inicial', '1', 'Educació', 'EBR', 'Mañana-Tarde', '0', '', '3646949', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '219');
INSERT INTO `modularie` VALUES ('11', '0496687', '013 SANTA ROSITA', 'Inicial', '1', 'Educació', 'EBR', 'Mañana-Tarde', '0', '', '3851858', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '220');
INSERT INTO `modularie` VALUES ('12', '0510529', '035 ISABEL FLORES DE OLIVA', 'Inicial', '1', 'Educació', 'EBR', 'Mañana-Tarde', '0', '', '3767474', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '192');
INSERT INTO `modularie` VALUES ('13', '0511204', '010 MARTIR OLAYA', 'Inicial', '1', 'Educació', 'EBR', 'Mañana-Tarde', '0', '', '3277370', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '250');
INSERT INTO `modularie` VALUES ('14', '0524090', '0040', 'Inicial', '1', 'Educació', 'EBR', 'Mañana', '0', '', '0', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '176');
INSERT INTO `modularie` VALUES ('15', '0524199', '0037 SANTA ROSA', 'Inicial', '1', 'Educació', 'EBR', 'Mañana-Tarde', '0', '', '2866207', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '1', '2018-04-09 11:34:00', '2');
INSERT INTO `modularie` VALUES ('16', '0525790', '1025 MARIA PARADO DE BELLIDO', 'Inicial', '1', 'Educació', 'EBR', 'Mañana-Tarde', '0', '', '3271429', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '234');
INSERT INTO `modularie` VALUES ('17', '0537878', '0043 JUAN PABLO II', 'Inicial', '1', 'Educació', 'EBR', 'Mañana-Tarde', '0', '', '4597218', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '26');
INSERT INTO `modularie` VALUES ('18', '0556654', '08 VILLA HERMOSA', 'Inicial', '1', 'Educació', 'EBR', 'Mañana-Tarde', '0', '', '5949733', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '235');
INSERT INTO `modularie` VALUES ('19', '0562058', '114 VIRGEN DE CHAPI', 'Inicial', '1', 'Educació', 'EBR', 'Mañana-Tarde', '0', '', '', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '251');
INSERT INTO `modularie` VALUES ('20', '0562082', '069 NOCHETO LUIS ENRIQUE VI', 'Inicial', '1', 'Educació', 'EBR', 'Mañana-Tarde', '0', '', '3620911', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '236');
INSERT INTO `modularie` VALUES ('21', '0562140', '068', 'Inicial', '1', 'Educació', 'EBR', 'Mañana-Tarde', '0', '', '4589184', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '221');
INSERT INTO `modularie` VALUES ('22', '0589895', '0062', 'Inicial', '1', 'Educació', 'EBR', 'Mañana-Tarde', '0', '', '6547734', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '159');
INSERT INTO `modularie` VALUES ('23', '0590042', '00057 PASITOS DE JESUS', 'Inicial', '1', 'Educació', 'EBR', 'Mañana-Tarde', '0', '', '2867042', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '48');
INSERT INTO `modularie` VALUES ('24', '0590257', '067 SANTISIMA CRUZ DE MOTUPE', 'Inicial', '1', 'Educació', 'EBR', 'Mañana', '0', '', '4598490', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '222');
INSERT INTO `modularie` VALUES ('25', '0590968', '0070 HUASCAR', 'Inicial', '1', 'Educació', 'EBR', 'Mañana-Tarde', '0', '', '2860500', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '160');
INSERT INTO `modularie` VALUES ('26', '0590992', '0073 ARRIBA PERU', 'Inicial', '1', 'Educació', 'EBR', 'Mañana-Tarde', '0', '', '0', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '177');
INSERT INTO `modularie` VALUES ('27', '0591024', '0051 LOS PASTORCITOS DE NUESTRA SEÑORA DE FATIMA', 'Inicial', '1', 'Educació', 'EBR', 'Mañana-Tarde', '0', '', '3766170', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '27');
INSERT INTO `modularie` VALUES ('28', '0591057', '060 CORAZON DE JESUS', 'Inicial', '1', 'Educació', 'EBR', 'Mañana-Tarde', '0', '', '5790302', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '1', '2022-05-11 13:39:14', '49');
INSERT INTO `modularie` VALUES ('29', '0591081', '0061 LAS VIOLETAS', 'Inicial', '1', 'Educació', 'EBR', 'Mañana-Tarde', '0', '', '6379666', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '28');
INSERT INTO `modularie` VALUES ('30', '0605477', '076 MICAELA BASTIDAS', 'Inicial', '1', 'Educació', 'EBR', 'Mañana', '0', '', '0', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '237');
INSERT INTO `modularie` VALUES ('31', '0605535', '081', 'Inicial', '1', 'Educació', 'EBR', 'Mañana', '0', '', '4598619', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '223');
INSERT INTO `modularie` VALUES ('32', '0607267', '0071 VIRGEN DEL CARMEN', 'Inicial', '1', 'Educació', 'EBR', 'Mañana-Tarde', '0', '', '4586648', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '29');
INSERT INTO `modularie` VALUES ('33', '0607374', '0079 CUNA JARDIN', 'Inicial', '1', 'Educació', 'EBR', 'Mañana-Tarde', '0', '', '0', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '178');
INSERT INTO `modularie` VALUES ('34', '0607382', '0080 LAS TERRAZAS', 'Inicial', '1', 'Educació', 'EBR', 'Mañana-Tarde', '0', '', '3879400', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '161');
INSERT INTO `modularie` VALUES ('35', '0631697', '0083', 'Inicial', '1', 'Educació', 'EBR', 'Mañana-Tarde', '0', '', '4977469', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '3');
INSERT INTO `modularie` VALUES ('36', '0631721', '0084 VIRGEN MARIA', 'Inicial', '1', 'Educació', 'EBR', 'Mañana-Tarde', '0', '', '4586406', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '50');
INSERT INTO `modularie` VALUES ('37', '0647693', '0092', 'Inicial', '1', 'Educació', 'EBR', 'Mañana-Tarde', '0', '', '0', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '179');
INSERT INTO `modularie` VALUES ('38', '0647701', '093 NIÑOS DE LA VIRGEN DEL ROSARIO', 'Inicial', '1', 'Educació', 'EBR', 'Mañana-Tarde', '0', '', '3891283', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '1', '2022-05-11 13:40:32', '193');
INSERT INTO `modularie` VALUES ('39', '0647727', '0086 CAMPOY', 'Inicial', '1', 'Educació', 'EBR', 'Mañana-Tarde', '0', '', '0', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '13');
INSERT INTO `modularie` VALUES ('40', '0664276', '0149 JORGE CIEZA LACHOS', 'Inicial', '1', 'Educació', 'EBR', 'Mañana', '0', '', '3790761', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '1', '2022-06-16 12:37:56', '4');
INSERT INTO `modularie` VALUES ('41', '0664326', 'MAMA ELSA', 'Inicial', '1', 'Educació', 'EBR', 'Mañana', '0', '', '3860500', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '14');
INSERT INTO `modularie` VALUES ('42', '0664466', '098', 'Inicial', '1', 'Educació', 'EBR', 'Mañana', '0', '', '0', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '70');
INSERT INTO `modularie` VALUES ('43', '0664474', '0099 KAROL WOJTYLA', 'Inicial', '1', 'Educació', 'EBR', 'Mañana-Tarde', '0', '', '3929592', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '131');
INSERT INTO `modularie` VALUES ('44', '0665257', '0101 RAYITO DE LUZ', 'Inicial', '1', 'Educació', 'EBR', 'Mañana-Tarde', '0', '', '3765087', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '30');
INSERT INTO `modularie` VALUES ('45', '0665349', '102 VIRGEN DEL ROSARIO', 'Inicial', '1', 'Educació', 'EBR', 'Mañana-Tarde', '0', '', '3923622', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '132');
INSERT INTO `modularie` VALUES ('46', '0665356', '0105 YOY MARINA GARATE BARDALES', 'Inicial', '1', 'Educació', 'EBR', 'Mañana-Tarde', '0', '', '6516053', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '107');
INSERT INTO `modularie` VALUES ('47', '0665364', '0107 ISRAEL', 'Inicial', '1', 'Educació', 'EBR', 'Mañana-Tarde', '0', '', '7512208', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '71');
INSERT INTO `modularie` VALUES ('48', '0665778', '0104', 'Inicial', '1', 'Educació', 'EBR', 'Mañana-Tarde', '0', '', '0', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '88');
INSERT INTO `modularie` VALUES ('49', '0665786', '106 INDOAMERICA', 'Inicial', '1', 'Educació', 'EBR', 'Mañana-Tarde', '0', '', '2537565', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '108');
INSERT INTO `modularie` VALUES ('50', '0742379', '0108', 'Inicial', '1', 'Educació', 'EBR', 'Mañana-Tarde', '0', '', '3885570', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '72');
INSERT INTO `modularie` VALUES ('51', '0742387', '0109', 'Inicial', '1', 'Educació', 'EBR', 'Mañana-Tarde', '0', '', '0', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '133');
INSERT INTO `modularie` VALUES ('52', '0762310', '0111', 'Inicial', '1', 'Educació', 'EBR', 'Mañana', '0', '', '7996495', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '109');
INSERT INTO `modularie` VALUES ('53', '0762351', '0110', 'Inicial', '1', 'Educació', 'EBR', 'Mañana', '0', '', '0', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '180');
INSERT INTO `modularie` VALUES ('54', '0762393', '0112', 'Inicial', '1', 'Educació', 'EBR', 'Mañana-Tarde', '0', '', '0', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '89');
INSERT INTO `modularie` VALUES ('55', '0762922', '084 COQUITO', 'Inicial', '1', 'Educació', 'EBR', 'Mañana', '0', '', '2864885', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '238');
INSERT INTO `modularie` VALUES ('56', '0776518', '0115 06', 'Inicial', '1', 'Educació', 'EBR', 'Mañana', '0', '', '6478606', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '134');
INSERT INTO `modularie` VALUES ('57', '0776542', '115-7 KUMAMOTO', 'Inicial', '1', 'Educació', 'EBR', 'Mañana-Tarde', '0', '', '0', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '1', '2022-05-11 13:43:09', '181');
INSERT INTO `modularie` VALUES ('58', '0776575', '0115 08 WILLIAM DYER AMPUDIA', 'Inicial', '1', 'Educació', 'EBR', 'Mañana-Tarde', '0', '', '0', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '15');
INSERT INTO `modularie` VALUES ('59', '0776609', '115-9 NUEVA ESPERANZA', 'Inicial', '1', 'Educació', 'EBR', 'Mañana', '0', '', '3044829', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '1', '2022-05-11 13:55:13', '73');
INSERT INTO `modularie` VALUES ('60', '0776633', '0115 10 MUNDO DEL SABER', 'Inicial', '1', 'Educació', 'EBR', 'Mañana-Tarde', '0', '', '3927598', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '110');
INSERT INTO `modularie` VALUES ('61', '0776666', '115-11 SAGRADO CORAZON DE JESUS', 'Inicial', '1', 'Educació', 'EBR', 'Mañana-Tarde', '0', '', '3924482', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '1', '2022-05-11 13:55:40', '135');
INSERT INTO `modularie` VALUES ('62', '0777490', '0113 DIVINO NIÑO JESUS', 'Inicial', '1', 'Educació', 'EBR', 'Mañana-Tarde', '0', '', '6349769', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '90');
INSERT INTO `modularie` VALUES ('63', '0777524', 'SAN ANTONIO DE JICAMARCA', 'Inicial', '1', 'Educació', 'EBR', 'Tarde', '0', '', '3923509', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '111');
INSERT INTO `modularie` VALUES ('64', '0777557', '115', 'Inicial', '1', 'Educació', 'EBR', 'Mañana', '0', '', '3306468', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '74');
INSERT INTO `modularie` VALUES ('65', '0777581', '0115 01 LA SEMILLITA', 'Inicial', '1', 'Educació', 'EBR', 'Mañana-Tarde', '0', '', '0', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '91');
INSERT INTO `modularie` VALUES ('66', '0777615', '0115 02 NIÑO JESUS MARISCAL CHAPERITO', 'Inicial', '1', 'Educació', 'EBR', 'Mañana-Tarde', '0', '', '3924776', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '1', '2022-05-11 13:42:20', '136');
INSERT INTO `modularie` VALUES ('67', '0777649', '115-3 ANGELITOS DE CASABLANCA', 'Inicial', '1', 'Educació', 'EBR', 'Mañana', '0', '', '3930817', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '137');
INSERT INTO `modularie` VALUES ('68', '0777706', '115-5 REPUBLICA HELENICA', 'Inicial', '1', 'Educació', 'EBR', 'Mañana', '0', '', '6328298', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '51');
INSERT INTO `modularie` VALUES ('69', '0840256', 'PADRE CARLOS', 'Inicial', '1', 'Educació', 'EBR', 'Mañana', '0', '', '3862300', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '16');
INSERT INTO `modularie` VALUES ('70', '0846071', '0115 12 FLORES DE LIMA', 'Inicial', '1', 'Educació', 'EBR', 'Mañana-Tarde', '0', '', '3768693', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '31');
INSERT INTO `modularie` VALUES ('71', '0846105', '115-13 VIRGEN DE LAS MERCEDES', 'Inicial', '1', 'Educació', 'EBR', 'Mañana', '0', '', '3921584', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '112');
INSERT INTO `modularie` VALUES ('72', '0846139', '0115 14 LOS RUISEÑORES', 'Inicial', '1', 'Educació', 'EBR', 'Mañana', '0', '', '3878419', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '92');
INSERT INTO `modularie` VALUES ('73', '0846162', '115-15 NIÑO JESUS', 'Inicial', '1', 'Educació', 'EBR', 'Mañana', '0', '', '0', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '1', '2022-05-11 13:56:25', '75');
INSERT INTO `modularie` VALUES ('74', '0846196', '115-16 VIRGEN DEL CARMEN', 'Inicial', '1', 'Educació', 'EBR', 'Mañana', '0', '', '4580720', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '1', '2022-05-11 13:56:43', '52');
INSERT INTO `modularie` VALUES ('75', '0846220', '115-17 SAN JUDAS TADEO', 'Inicial', '1', 'Educació', 'EBR', 'Mañana-Tarde', '0', '', '3420775', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '53');
INSERT INTO `modularie` VALUES ('76', '0846253', '115-18 JUANA ALARCO DE DAMMERT', 'Inicial', '1', 'Educació', 'EBR', 'Mañana-Tarde', '0', '', '7477056', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '1', '2022-05-11 13:57:04', '113');
INSERT INTO `modularie` VALUES ('77', '0846287', '0115 19 MAMA LUCIE', 'Inicial', '1', 'Educació', 'EBR', 'Mañana', '0', '', '0', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '17');
INSERT INTO `modularie` VALUES ('78', '0846311', '0115 20', 'Inicial', '1', 'Educació', 'EBR', 'Mañana-Tarde', '0', '', '0', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '138');
INSERT INTO `modularie` VALUES ('79', '0846345', '0115 21', 'Inicial', '1', 'Educació', 'EBR', 'Mañana', '0', '', '0', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '76');
INSERT INTO `modularie` VALUES ('80', '0846378', '0115 22 SANTISIMA VIRGEN DE LOURDES', 'Inicial', '1', 'Educació', 'EBR', 'Mañana', '0', '', '0', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '194');
INSERT INTO `modularie` VALUES ('81', '0846816', '0115 23 SEÑOR DE LOS MILAGROS', 'Inicial', '1', 'Educació', 'EBR', 'Mañana', '0', '', '0', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '114');
INSERT INTO `modularie` VALUES ('82', '0900589', '115-24 SEMILLITA DEL SABER', 'Inicial', '1', 'Educació', 'EBR', 'Mañana', '0', '', '3927573', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '1', '2022-05-11 13:57:26', '115');
INSERT INTO `modularie` VALUES ('83', '0903237', '1046 JULIO RAMON RIBEYRO', 'Inicial', '1', 'Educació', 'EBR', 'Mañana', '0', '', '0', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '252');
INSERT INTO `modularie` VALUES ('84', '0903260', '1170', 'Inicial', '1', 'Educació', 'EBR', 'Mañana', '0', '', '3276579', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '253');
INSERT INTO `modularie` VALUES ('85', '0903328', 'GRAN MARISCAL ANDRES AVELINO CACERES DORREGARAY', 'Inicial', '1', 'Educació', 'EBR', 'Mañana-Tarde', '0', '', '3890533', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '1', '2021-06-17 16:07:51', '254');
INSERT INTO `modularie` VALUES ('86', '0904565', '', 'Inicial', '1', 'Educació', 'EBR', 'Mañana', '0', '', '', '', '0', '0', '0', '0', '0000-00-00 00:00:00', '1', '2021-08-02 16:15:32', '263');
INSERT INTO `modularie` VALUES ('87', '1008887', '0098 PERU JAPON', 'Inicial', '1', 'Educació', 'EBR', 'Mañana', '0', '', '3856225', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '224');
INSERT INTO `modularie` VALUES ('88', '1062702', '127 SAN JOSE', 'Inicial', '1', 'Educació', 'EBR', 'Mañana-Tarde', '0', '', '3856243', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '225');
INSERT INTO `modularie` VALUES ('89', '1062785', '1177 HEROES DEL CENEPA', 'Inicial', '1', 'Educació', 'EBR', 'Mañana', '0', '', '6941464', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '255');
INSERT INTO `modularie` VALUES ('90', '1062827', 'HOGAR SAN MARTIN', 'Inicial', '1', 'Educació', 'EBR', 'Mañana-Tarde', '0', '', '3271857', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '256');
INSERT INTO `modularie` VALUES ('91', '1062868', 'LA PRADERA II', 'Inicial', '1', 'Educació', 'EBR', 'Mañana-Tarde', '0', '', '7319452', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '239');
INSERT INTO `modularie` VALUES ('92', '1066794', '0049 ANTONIA MORENO DE CACERES', 'Inicial', '1', 'Educació', 'EBR', 'Mañana-Tarde', '0', '', '4029533', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '240');
INSERT INTO `modularie` VALUES ('93', '1066836', '115 TORIBIO RODRIGUEZ DE MENDOZA', 'Inicial', '1', 'Educació', 'EBR', 'Mañana-Tarde', '0', '', '3856446', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '226');
INSERT INTO `modularie` VALUES ('94', '1066877', '1047 JUANA INFANTES VERA', 'Inicial', '1', 'Educació', 'EBR', 'Mañana-Tarde', '0', '', '4780253', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '227');
INSERT INTO `modularie` VALUES ('95', '1070432', '0115 25 CUNA DE JESUS', 'Inicial', '1', 'Educació', 'EBR', 'Mañana-Tarde', '0', '', '3767718', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '77');
INSERT INTO `modularie` VALUES ('96', '1070473', '0115 26', 'Inicial', '1', 'Educació', 'EBR', 'Mañana-Tarde', '0', '', '0', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '93');
INSERT INTO `modularie` VALUES ('97', '1070515', '115-27 MI PEQUEÑO MUNDO', 'Inicial', '1', 'Educació', 'EBR', 'Mañana-Tarde', '0', '', '0', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '1', '2022-06-16 12:39:34', '116');
INSERT INTO `modularie` VALUES ('98', '1070556', '0115 28 NIÑO JESUS DE SAN IGNACIO', 'Inicial', '1', 'Educació', 'EBR', 'Mañana-Tarde', '0', '', '3874202', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '195');
INSERT INTO `modularie` VALUES ('99', '1070598', '115 29 LOS ANGELITOS', 'Inicial', '1', 'Educació', 'EBR', 'Mañana', '0', '', '6574867', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '94');
INSERT INTO `modularie` VALUES ('100', '1070630', 'FE Y ALEGRIA 04', 'Inicial', '1', 'Educació', 'EBR', 'Mañana-Tarde', '0', '', '3750517', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '32');
INSERT INTO `modularie` VALUES ('101', '1070671', '171-05 LOS ANGELES', 'Inicial', '1', 'Educació', 'EBR', 'Mañana-Tarde', '0', '', '6245241', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '1', '2022-05-11 14:07:09', '196');
INSERT INTO `modularie` VALUES ('102', '1188366', '046 LOS LIBERTADORES DE AYACUCHO', 'Inicial', '1', 'Educació', 'EBR', 'Mañana-Tarde', '0', '', '', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '1', '2019-09-13 15:03:58', '257');
INSERT INTO `modularie` VALUES ('103', '1188408', '1044 MARIA REICHE NEWMANN', 'Inicial', '1', 'Educació', 'EBR', 'Mañana', '0', '', '0', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '241');
INSERT INTO `modularie` VALUES ('104', '1192723', '144', 'Inicial', '1', 'Educació', 'EBR', 'Mañana-Tarde', '0', '', '3893214', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '211');
INSERT INTO `modularie` VALUES ('105', '1192921', 'FE Y ALEGRIA 37', 'Inicial', '1', 'Educació', 'EBR', 'Mañana-Tarde', '0', '', '3851858', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '139');
INSERT INTO `modularie` VALUES ('106', '1222140', '115 31 GOTITAS DE AMOR', 'Inicial', '1', 'Educació', 'EBR', 'Mañana', '0', '', '0', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '95');
INSERT INTO `modularie` VALUES ('107', '1225705', '1045 NUESTRA SEÑORA DE FATIMA', 'Inicial', '1', 'Educació', 'EBR', 'Mañana', '0', '', '3623641', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '242');
INSERT INTO `modularie` VALUES ('108', '1261270', '1186 SANTA ROSA DE LIMA MILAGROSA', 'Inicial', '1', 'Educació', 'EBR', 'Mañana-Tarde', '0', '', '', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '1', '2022-06-17 10:41:45', '258');
INSERT INTO `modularie` VALUES ('109', '1261379', '117 SIGNOS DE FE', 'Inicial', '1', 'Educació', 'EBR', 'Mañana-Tarde', '0', '', '3887137', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '162');
INSERT INTO `modularie` VALUES ('110', '1329044', '10 DE MARZO', 'Inicial', '1', 'Educació', 'EBR', 'Mañana-Tarde', '0', '', '2864803', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '140');
INSERT INTO `modularie` VALUES ('111', '1454958', '27 DE MARZO', 'Inicial', '1', 'Educació', 'EBR', 'Mañana', '0', '', '3382084', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '96');
INSERT INTO `modularie` VALUES ('112', '1470855', 'SAUL CANTORAL HUAMANI', 'Inicial', '1', 'Educació', 'EBR', 'Mañana', '0', '', '3923766', '', '0', '0', '0', '0', '0000-00-00 00:00:00', '1', '2021-06-17 01:11:48', '155');
INSERT INTO `modularie` VALUES ('113', '1494616', '1174 VIRGEN DEL CARMEN', 'Inicial', '1', 'Educació', 'EBR', 'Mañana', '0', '', '3760027', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '5');
INSERT INTO `modularie` VALUES ('114', '1500685', '100', 'Inicial', '1', 'Educació', 'EBR', 'Mañana', '0', '', '3883064', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '197');
INSERT INTO `modularie` VALUES ('115', '1501022', 'FE Y ALEGRIA 39', 'Inicial', '1', 'Educació', 'EBR', 'Mañana', '0', '', '3620621', '', '0', '0', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '243');
INSERT INTO `modularie` VALUES ('116', '1501287', 'CASA BLANCA DE JESUS', 'Inicial', '1', 'Educació', 'EBR', 'Mañana', '0', '', '3922620', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '141');
INSERT INTO `modularie` VALUES ('117', '1501378', 'ASOCIACION RELIGIOSA MARIA Y JESUS', 'Inicial', '1', 'Educació', 'EBR', 'Mañana', '0', '', '0', '', '0', '0', '0', '0', '0000-00-00 00:00:00', '1', '2021-06-17 16:21:34', '157');
INSERT INTO `modularie` VALUES ('118', '1502293', '0132 TORIBIO DE LUZURIAGA Y MEJIA', 'Inicial', '1', 'Educació', 'EBR', 'Mañana-Tarde', '0', '', '3882762', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '198');
INSERT INTO `modularie` VALUES ('119', '1502301', 'CABO GC. MARTIN ESQUICHA BERNEDO', 'Inicial', '1', 'Educació', 'EBR', 'Mañana-Tarde', '0', '', '4592587', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '1', '2022-05-11 14:07:29', '6');
INSERT INTO `modularie` VALUES ('120', '1502939', '1187 SAN CAYETANO', 'Inicial', '1', 'Educació', 'EBR', 'Mañana-Tarde', '0', '', '3077327', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '259');
INSERT INTO `modularie` VALUES ('121', '1502947', '1171 JORGE BASADRE GROHMANN', 'Inicial', '1', 'Educació', 'EBR', 'Mañana', '0', '', '3271630', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '244');
INSERT INTO `modularie` VALUES ('122', '1503101', '116 ABRAHAM VALDELOMAR', 'Inicial', '1', 'Educació', 'EBR', 'Mañana-Tarde', '0', '', '3889251', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '163');
INSERT INTO `modularie` VALUES ('123', '1503549', '0161 MOISES COLONIA TRINIDAD', 'Inicial', '1', 'Educació', 'EBR', 'Mañana', '0', '', '3881929', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '1', '2022-05-11 14:05:14', '199');
INSERT INTO `modularie` VALUES ('124', '1503929', 'ANTENOR ORREGO ESPINOZA', 'Inicial', '1', 'Educació', 'EBR', 'Mañana-Tarde', '0', '', '4890318', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '7');
INSERT INTO `modularie` VALUES ('125', '1504026', 'FE Y ALEGRIA 25', 'Inicial', '1', 'Educació', 'EBR', 'Mañana-Tarde', '0', '', '3871500', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '164');
INSERT INTO `modularie` VALUES ('126', '1532738', '0130 HEROES DEL CENEPA', 'Inicial', '1', 'Educació', 'EBR', 'Mañana-Tarde', '0', '', '4582823', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '33');
INSERT INTO `modularie` VALUES ('127', '1532746', '0140 SANTIAGO ANTUNEZ DE MAYOLO', 'Inicial', '1', 'Educació', 'EBR', 'Mañana-Tarde', '0', '', '3877748', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '212');
INSERT INTO `modularie` VALUES ('128', '1535566', 'FRANCISCO BOLOGNESI CERVANTES', 'Inicial', '1', 'Educació', 'EBR', 'Mañana-Tarde', '0', '', '3870750', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '165');
INSERT INTO `modularie` VALUES ('129', '1537745', '0092 ALFRED NOBEL', 'Inicial', '1', 'Educació', 'EBR', 'Mañana', '0', '', '4597913', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '54');
INSERT INTO `modularie` VALUES ('130', '1538891', '0136 SANTA ROSA MILAGROSA', 'Inicial', '1', 'Educació', 'EBR', 'Mañana', '0', '', '3742958', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '213');
INSERT INTO `modularie` VALUES ('131', '1560234', '1173 JULIO CESAR TELLO', 'Inicial', '1', 'Educació', 'EBR', 'Mañana', '0', '', '4583083', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '34');
INSERT INTO `modularie` VALUES ('132', '1569961', '170 SANTA ROSA DEL SAUCE', 'Inicial', '1', 'Educació', 'EBR', 'Mañana', '0', '', '4590152', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '1', '2022-05-11 14:05:55', '55');
INSERT INTO `modularie` VALUES ('133', '1572890', '', 'Inicial', '1', 'Educació', 'EBR', 'Mañana', '0', '', '', '', '0', '0', '0', '0', '0000-00-00 00:00:00', '1', '2021-08-02 16:16:46', '156');
INSERT INTO `modularie` VALUES ('134', '1578632', '0128 LA LIBERTAD', 'Inicial', '1', 'Educació', 'EBR', 'Mañana', '0', '', '3750183', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '56');
INSERT INTO `modularie` VALUES ('135', '1578871', '0087 JOSE MARIA ARGUEDAS', 'Inicial', '1', 'Educació', 'EBR', 'Mañana-Tarde', '0', '', '3881100', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '200');
INSERT INTO `modularie` VALUES ('136', '1621903', 'SAN MARTIN DE PORRES', 'Inicial', '1', 'Educació', 'EBR', 'Mañana', '0', '', '0', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '57');
INSERT INTO `modularie` VALUES ('137', '1621911', 'RAYITO DE SOL', 'Inicial', '1', 'Educació', 'EBR', 'Mañana-Tarde', '0', '', '0', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '97');
INSERT INTO `modularie` VALUES ('138', '1621929', '0167 MARIA REICHE', 'Inicial', '1', 'Educació', 'EBR', 'Mañana', '0', '', '0', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '117');
INSERT INTO `modularie` VALUES ('139', '1621937', 'JESUSITO', 'Inicial', '1', 'Educació', 'EBR', 'Mañana', '0', '', '4586406', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '201');
INSERT INTO `modularie` VALUES ('140', '1634021', '1179 TOMAS ALVA EDISON', 'Inicial', '1', 'Educació', 'EBR', 'Mañana', '0', '', '3888187', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '35');
INSERT INTO `modularie` VALUES ('141', '1637479', 'REINO DE LOS NIÑOS', 'Inicial', '1', 'Educació', 'EBR', 'Mañana', '0', '', '4598490', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '166');
INSERT INTO `modularie` VALUES ('142', '1646447', '047 SEÑOR DE LOS MILAGROS', 'Inicial', '1', 'Educació', 'EBR', 'Mañana', '0', '', '3245385', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '260');
INSERT INTO `modularie` VALUES ('143', '1646454', '0085 JOSE DE LA TORRE UGARTE', 'Inicial', '1', 'Educació', 'EBR', 'Mañana-Tarde', '0', '', '3856238', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '228');
INSERT INTO `modularie` VALUES ('144', '1650258', '122 ANDRES AVELINO CACERES', 'Inicial', '1', 'Educació', 'EBR', 'Mañana', '0', '', '4593325', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '8');
INSERT INTO `modularie` VALUES ('145', '1660604', 'MI PEQUEÑO ANGELITO', 'Inicial', '1', 'Educació', 'EBR', 'Mañana', '0', '', '3928063', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '142');
INSERT INTO `modularie` VALUES ('146', '1665496', 'LAS SEMILLITAS', 'Inicial', '1', 'Educació', 'EBR', 'Mañana', '0', '', '4591986', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '167');
INSERT INTO `modularie` VALUES ('147', '1665637', 'SEMILLITAS DE LA PAZ', 'Inicial', '1', 'Educació', 'EBR', 'Mañana', '0', '', '', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '78');
INSERT INTO `modularie` VALUES ('148', '1666031', 'MI SEGUNDO HOGAR', 'Inicial', '1', 'Educació', 'EBR', 'Mañana', '0', '', '0', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '182');
INSERT INTO `modularie` VALUES ('149', '1693407', 'GOTITAS DE AMOR', 'Inicial', '1', 'Educació', 'EBR', 'Mañana', '0', '', '7940754', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '98');
INSERT INTO `modularie` VALUES ('150', '1693415', 'NIÑO MANUELITO - A', 'Inicial', '1', 'Educació', 'EBR', 'Mañana', '0', '', '0', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '143');
INSERT INTO `modularie` VALUES ('151', '1693423', 'MIS PRIMEROS PASOS - AZUL', 'Inicial', '1', 'Educació', 'EBR', 'Mañana', '0', '', '0', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '99');
INSERT INTO `modularie` VALUES ('152', '1693431', 'CRISTO REY - A', 'Inicial', '1', 'Educació', 'EBR', 'Mañana', '0', '', '3620621', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '144');
INSERT INTO `modularie` VALUES ('153', '1693449', 'HUELLITAS DE JESUS', 'Inicial', '1', 'Educació', 'EBR', 'Mañana', '0', '', '0', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '100');
INSERT INTO `modularie` VALUES ('154', '1693456', 'ESPERANZA DEL PERU', 'Inicial', '1', 'Educació', 'EBR', 'Mañana', '0', '', '6984493', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '145');
INSERT INTO `modularie` VALUES ('155', '1694033', 'ESTRELLITA DE BELEN - A', 'Inicial', '1', 'Educació', 'EBR', 'Mañana', '0', '', '0', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '146');
INSERT INTO `modularie` VALUES ('156', '1694215', 'JOYITAS DE MARIA - I', 'Inicial', '1', 'Educació', 'EBR', 'Mañana', '0', '', '6379666', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '168');
INSERT INTO `modularie` VALUES ('157', '1694223', 'JULIA VALENZUELA - I', 'Inicial', '1', 'Educació', 'EBR', 'Mañana', '0', '', '0', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '147');
INSERT INTO `modularie` VALUES ('158', '1696830', 'PASITOS DEL SABER', 'Inicial', '1', 'Educació', 'EBR', 'Mañana', '0', '', '6389058', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '118');
INSERT INTO `modularie` VALUES ('159', '1716752', 'LOS NIÑOS DE JESUS', 'Inicial', '1', 'Educació', 'EBR', 'Mañana', '0', '', '0', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '183');
INSERT INTO `modularie` VALUES ('160', '1716760', 'JOYITAS DE JESUS', 'Inicial', '1', 'Educació', 'EBR', 'Mañana', '0', '', '0', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '119');
INSERT INTO `modularie` VALUES ('161', '1748573', 'CASITA AMIGA DE RURICANCHO', 'Inicial', '1', 'Educació', 'EBR', 'Mañana-Tarde', '0', '', '0', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '128');
INSERT INTO `modularie` VALUES ('162', '1748581', 'CAMINITO DE MOTUPE', 'Inicial', '1', 'Educació', 'EBR', 'Mañana-Tarde', '0', '', '3384527', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '129');
INSERT INTO `modularie` VALUES ('163', '1748599', 'EL HOGAR DE JOSE Y MARIA', 'Inicial', '1', 'Educació', 'EBR', 'Mañana-Tarde', '0', '', '4598314', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '174');
INSERT INTO `modularie` VALUES ('164', '0334896', '0009 JOSE MARIA ARGUEDAS', 'Primaria', '2', 'Educació', 'EBR', 'Mañana-Tarde', '0', '', '0', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '219');
INSERT INTO `modularie` VALUES ('165', '0334987', '0043 SAN CRISTOBAL', 'Primaria', '2', 'Educació', 'EBR', 'Mañana', '0', '', '3528497', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '36');
INSERT INTO `modularie` VALUES ('166', '0334995', 'FE Y ALEGRIA 04', 'Primaria', '2', 'Educació', 'EBR', 'Mañana-Tarde', '0', '', '3750517', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '32');
INSERT INTO `modularie` VALUES ('167', '0335000', '0045 SAN ANTONIO', 'Primaria', '2', 'Educació', 'EBR', 'Mañana', '0', '', '0', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '202');
INSERT INTO `modularie` VALUES ('168', '0335018', '046 LOS LIBERTADORES DE AYACUCHO', 'Primaria', '2', 'Educació', 'EBR', 'Mañana-Tarde', '0', '', '0', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '1', '2019-09-13 15:04:04', '257');
INSERT INTO `modularie` VALUES ('169', '0335026', '047 SEÑOR DE LOS MILAGROS', 'Primaria', '2', 'Educació', 'EBR', 'Mañana', '0', '', '0', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '260');
INSERT INTO `modularie` VALUES ('170', '0335034', '048 SAN JUAN BOSCO', 'Primaria', '2', 'Educació', 'EBR', 'Mañana-Tarde', '0', '', '0', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '261');
INSERT INTO `modularie` VALUES ('171', '0335042', '0049 ANTONIA MORENO DE CACERES', 'Primaria', '2', 'Educació', 'EBR', 'Mañana-Tarde', '0', '', '0', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '240');
INSERT INTO `modularie` VALUES ('172', '0335067', '0069 MACHU PICCHU', 'Primaria', '2', 'Educació', 'EBR', 'Mañana', '0', '', '0', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '169');
INSERT INTO `modularie` VALUES ('173', '0335083', '0071 NUESTRA SEÑORA DE LA MERCED', 'Primaria', '2', 'Educació', 'EBR', 'Mañana', '0', '', '3760696', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '37');
INSERT INTO `modularie` VALUES ('174', '0335091', '0073 BENITO JUAREZ', 'Primaria', '2', 'Educació', 'EBR', 'Mañana-Tarde', '0', '', '4582847', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '9');
INSERT INTO `modularie` VALUES ('175', '0335109', '0076 MARIA AUXILIADORA', 'Primaria', '2', 'Educació', 'EBR', 'Mañana', '0', '', '2865956', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '38');
INSERT INTO `modularie` VALUES ('176', '0335117', '0085 JOSE DE LA TORRE UGARTE', 'Primaria', '2', 'Educació', 'EBR', 'Mañana-Tarde', '0', '', '0', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '228');
INSERT INTO `modularie` VALUES ('177', '0335125', '0086 JOSE MARIA ARGUEDAS', 'Primaria', '2', 'Educació', 'EBR', 'Mañana-Tarde', '0', '', '0', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '214');
INSERT INTO `modularie` VALUES ('178', '0335133', '0087 JOSE MARIA ARGUEDAS', 'Primaria', '2', 'Educació', 'EBR', 'Mañana-Tarde', '0', '', '0', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '200');
INSERT INTO `modularie` VALUES ('179', '0335141', '0088 NUESTRA SRA. DEL CARMEN', 'Primaria', '2', 'Educació', 'EBR', 'Mañana-Tarde', '0', '', '3861918', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '18');
INSERT INTO `modularie` VALUES ('180', '0335158', '0089 MANUEL GONZALES PRADA', 'Primaria', '2', 'Educació', 'EBR', 'Mañana', '0', '', '3862264', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '19');
INSERT INTO `modularie` VALUES ('181', '0335166', '0090 DANIEL ALCIDES CARRION', 'Primaria', '2', 'Educació', 'EBR', 'Mañana-Tarde', '0', '', '3861247', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '20');
INSERT INTO `modularie` VALUES ('182', '0335174', '0091 SANTA FE', 'Primaria', '2', 'Educació', 'EBR', 'Mañana-Tarde', '0', '', '2531816', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '58');
INSERT INTO `modularie` VALUES ('183', '0335182', '0092 ALFRED NOBEL', 'Primaria', '2', 'Educació', 'EBR', 'Mañana', '0', '', '4597913', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '54');
INSERT INTO `modularie` VALUES ('184', '0338087', '1025 MARIA PARADO DE BELLIDO', 'Primaria', '2', 'Educació', 'EBR', 'Mañana-Tarde', '0', '', '0', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '234');
INSERT INTO `modularie` VALUES ('185', '0338467', '1044 MARIA REICHE NEWMANN', 'Primaria', '2', 'Educació', 'EBR', 'Mañana', '0', '', '0', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '241');
INSERT INTO `modularie` VALUES ('186', '0338491', '1045 NUESTRA SEÑORA DE FATIMA', 'Primaria', '2', 'Educació', 'EBR', 'Mañana-Tarde', '0', '', '0', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '242');
INSERT INTO `modularie` VALUES ('187', '0338517', '1046 JULIO RAMON RIBEYRO', 'Primaria', '2', 'Educació', 'EBR', 'Mañana', '0', '', '0', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '252');
INSERT INTO `modularie` VALUES ('188', '0338525', '1047 JUANA INFANTES VERA', 'Primaria', '2', 'Educació', 'EBR', 'Mañana-Tarde', '0', '', '0', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '227');
INSERT INTO `modularie` VALUES ('189', '0339432', '1168 GRAN MARISCAL RAMON CASTILLA', 'Primaria', '2', 'Educació', 'EBR', 'Mañana-Tarde', '0', '', '0', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '245');
INSERT INTO `modularie` VALUES ('190', '0339440', '1169 ALMIRANTE MIGUEL GRAU SEMINARIO', 'Primaria', '2', 'Educació', 'EBR', 'Mañana', '0', '', '0', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '1', '2021-06-16 11:51:56', '249');
INSERT INTO `modularie` VALUES ('191', '0339465', '1170', 'Primaria', '2', 'Educació', 'EBR', 'Mañana', '0', '', '0', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '253');
INSERT INTO `modularie` VALUES ('192', '0339499', '1171 JORGE BASADRE GROHMANN', 'Primaria', '2', 'Educació', 'EBR', 'Mañana', '0', '', '0', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '244');
INSERT INTO `modularie` VALUES ('193', '0339507', '1172 CIRO ALEGRIA', 'Primaria', '2', 'Educació', 'EBR', 'Mañana-Tarde', '0', '', '0', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '10');
INSERT INTO `modularie` VALUES ('194', '0339523', '1173 JULIO CESAR TELLO', 'Primaria', '2', 'Educació', 'EBR', 'Mañana', '0', '', '4583083', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '34');
INSERT INTO `modularie` VALUES ('195', '0339549', '1174 VIRGEN DEL CARMEN', 'Primaria', '2', 'Educació', 'EBR', 'Mañana', '0', '', '3760027', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '5');
INSERT INTO `modularie` VALUES ('196', '0339572', 'GLORIOSOS HUSARES DE JUNIN', 'Primaria', '2', 'Educació', 'EBR', 'Mañana-Tarde', '0', '', '0', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '246');
INSERT INTO `modularie` VALUES ('197', '0339606', '1177 HEROES DEL CENEPA', 'Primaria', '2', 'Educació', 'EBR', 'Mañana-Tarde', '0', '', '0', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '255');
INSERT INTO `modularie` VALUES ('198', '0339622', '1178 JAVIER HERAUD', 'Primaria', '2', 'Educació', 'EBR', 'Mañana', '0', '', '4584367', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '42');
INSERT INTO `modularie` VALUES ('199', '0339655', '1179 TOMAS ALVA EDISON', 'Primaria', '2', 'Educació', 'EBR', 'Mañana', '0', '', '3888187', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '35');
INSERT INTO `modularie` VALUES ('200', '0339697', '1181 ALBERT EINSTEIN', 'Primaria', '2', 'Educació', 'EBR', 'Mañana', '0', '', '4585926', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '43');
INSERT INTO `modularie` VALUES ('201', '0339796', '1186 SANTA ROSA DE LIMA MILAGROSA', 'Primaria', '2', 'Educació', 'EBR', 'Mañana-Tarde', '0', '', '0', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '1', '2022-06-17 10:41:54', '258');
INSERT INTO `modularie` VALUES ('202', '0339804', '1187 SAN CAYETANO', 'Primaria', '2', 'Educació', 'EBR', 'Mañana-Tarde', '0', '', '0', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '259');
INSERT INTO `modularie` VALUES ('203', '0466508', '0093 FERNANDO BELAUNDE TERRY', 'Primaria', '2', 'Educació', 'EBR', 'Mañana-Tarde', '0', '', '0', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '1', '2022-04-27 13:08:36', '229');
INSERT INTO `modularie` VALUES ('204', '0478404', '0098 PERU JAPON', 'Primaria', '2', 'Educació', 'EBR', 'Mañana', '0', '', '0', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '224');
INSERT INTO `modularie` VALUES ('205', '0496521', 'ANTENOR ORREGO ESPINOZA', 'Primaria', '2', 'Educació', 'EBR', 'Mañana-Tarde', '0', '', '4890318', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '7');
INSERT INTO `modularie` VALUES ('206', '0496570', '102', 'Primaria', '2', 'Educació', 'EBR', 'Mañana', '0', '', '4584730', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '41');
INSERT INTO `modularie` VALUES ('207', '0509901', '0120 MANUEL ROBLES ALARCON', 'Primaria', '2', 'Educació', 'EBR', 'Mañana-Tarde', '0', '', '0', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '184');
INSERT INTO `modularie` VALUES ('208', '0510206', 'CABO GC. MARTIN ESQUICHA BERNEDO', 'Primaria', '2', 'Educació', 'EBR', 'Tarde', '0', '', '4592587', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '1', '2022-05-11 14:07:33', '6');
INSERT INTO `modularie` VALUES ('209', '0510305', '116 ABRAHAM VALDELOMAR', 'Primaria', '2', 'Educació', 'EBR', 'Mañana-Tarde', '0', '', '0', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '163');
INSERT INTO `modularie` VALUES ('210', '0510404', 'FE Y ALEGRIA 25', 'Primaria', '2', 'Educació', 'EBR', 'Mañana-Tarde', '0', '', '0', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '164');
INSERT INTO `modularie` VALUES ('211', '0510503', '114 VIRGEN DE CHAPI', 'Primaria', '2', 'Educació', 'EBR', 'Mañana-Tarde', '0', '', '0', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '251');
INSERT INTO `modularie` VALUES ('212', '0510602', '115 TORIBIO RODRIGUEZ DE MENDOZA', 'Primaria', '2', 'Educació', 'EBR', 'Mañana-Tarde', '0', '', '0', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '226');
INSERT INTO `modularie` VALUES ('213', '0510701', '112 HEROES DE LA BREÑA', 'Primaria', '2', 'Educació', 'EBR', 'Mañana-Tarde', '0', '', '0', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '230');
INSERT INTO `modularie` VALUES ('214', '0510800', '0113 DANIEL ALOMIA ROBLES', 'Primaria', '2', 'Educació', 'EBR', 'Mañana', '0', '', '4582753', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '1', '2022-05-11 14:07:57', '39');
INSERT INTO `modularie` VALUES ('215', '0518548', '110 SAN MARCOS', 'Primaria', '2', 'Educació', 'EBR', 'Mañana', '0', '', '3760886', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '64');
INSERT INTO `modularie` VALUES ('216', '0518647', '100', 'Primaria', '2', 'Educació', 'EBR', 'Mañana', '0', '', '0', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '197');
INSERT INTO `modularie` VALUES ('217', '0528281', '121 VIRGEN DE FATIMA', 'Primaria', '2', 'Educació', 'EBR', 'Mañana-Tarde', '0', '', '0', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '207');
INSERT INTO `modularie` VALUES ('218', '0528380', '122 ANDRES AVELINO CACERES', 'Primaria', '2', 'Educació', 'EBR', 'Mañana', '0', '', '4593325', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '8');
INSERT INTO `modularie` VALUES ('219', '0541011', '125 RICARDO PALMA', 'Primaria', '2', 'Educació', 'EBR', 'Mañana-Tarde', '0', '', '0', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '171');
INSERT INTO `modularie` VALUES ('220', '0541110', '126 JAVIER PEREZ DE CUELLAR', 'Primaria', '2', 'Educació', 'EBR', 'Mañana', '0', '', '3872825', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '65');
INSERT INTO `modularie` VALUES ('221', '0541219', 'FE Y ALEGRIA 26', 'Primaria', '2', 'Educació', 'EBR', 'Tarde', '0', '', '0', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '189');
INSERT INTO `modularie` VALUES ('222', '0556241', 'FRANCISCO BOLOGNESI CERVANTES', 'Primaria', '2', 'Educació', 'EBR', 'Mañana-Tarde', '0', '', '0', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '165');
INSERT INTO `modularie` VALUES ('223', '0556548', '109 INCA MANCO CAPAC', 'Primaria', '2', 'Educació', 'EBR', 'Mañana', '0', '', '3880947', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '63');
INSERT INTO `modularie` VALUES ('224', '0584946', '127 SAN JOSE', 'Primaria', '2', 'Educació', 'EBR', 'Mañana-Tarde', '0', '', '0', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '225');
INSERT INTO `modularie` VALUES ('225', '0587279', '0130 HEROES DEL CENEPA', 'Primaria', '2', 'Educació', 'EBR', 'Mañana', '0', '', '4582823', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '33');
INSERT INTO `modularie` VALUES ('226', '0587303', '0128 LA LIBERTAD', 'Primaria', '2', 'Educació', 'EBR', 'Mañana', '0', '', '3750183', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '56');
INSERT INTO `modularie` VALUES ('227', '0590109', '0132 TORIBIO DE LUZURIAGA Y MEJIA', 'Primaria', '2', 'Educació', 'EBR', 'Mañana', '0', '', '0', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '198');
INSERT INTO `modularie` VALUES ('228', '0590133', '131 MONITOR HUASCAR', 'Primaria', '2', 'Educació', 'EBR', 'Mañana', '0', '', '0', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '172');
INSERT INTO `modularie` VALUES ('229', '0607416', '0134 MARIO FLORIAN', 'Primaria', '2', 'Educació', 'EBR', 'Mañana', '0', '', '4591539', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '40');
INSERT INTO `modularie` VALUES ('230', '0607424', '0135 TORIBIO RODRIGUEZ DE MENDOZA', 'Primaria', '2', 'Educació', 'EBR', 'Mañana', '0', '', '0', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '215');
INSERT INTO `modularie` VALUES ('231', '0607432', '0136 SANTA ROSA MILAGROSA', 'Primaria', '2', 'Educació', 'EBR', 'Mañana', '0', '', '0', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '213');
INSERT INTO `modularie` VALUES ('232', '0607440', '0137 MIGUEL GRAU SEMINARIO', 'Primaria', '2', 'Educació', 'EBR', 'Mañana', '0', '', '0', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '204');
INSERT INTO `modularie` VALUES ('233', '0607457', '0138 PROCERES DE LA INDEPENDENCIA', 'Primaria', '2', 'Educació', 'EBR', 'Mañana', '0', '', '3762541', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '59');
INSERT INTO `modularie` VALUES ('234', '0607465', '139 GRAN AMAUTA MARIATEGUI', 'Primaria', '2', 'Educació', 'EBR', 'Mañana', '0', '', '3931804', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '1', '2022-05-11 13:57:51', '101');
INSERT INTO `modularie` VALUES ('235', '0629261', '142 MARTIR DANIEL ALCIDES CARRION', 'Primaria', '2', 'Educació', 'EBR', 'Mañana-Tarde', '0', '', '0', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '1', '2022-05-11 13:58:41', '185');
INSERT INTO `modularie` VALUES ('236', '0629295', '0141 VIRGEN DE COCHARCAS', 'Primaria', '2', 'Educació', 'EBR', 'Mañana-Tarde', '0', '', '0', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '102');
INSERT INTO `modularie` VALUES ('237', '0632299', '144', 'Primaria', '2', 'Educació', 'EBR', 'Mañana-Tarde', '0', '', '0', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '211');
INSERT INTO `modularie` VALUES ('238', '0632323', '145 INDEPENDENCIA AMERICANA', 'Primaria', '2', 'Educació', 'EBR', 'Mañana-Tarde', '0', '', '0', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '173');
INSERT INTO `modularie` VALUES ('239', '0632356', '0146 SU SANTIDAD JUAN PABLO II', 'Primaria', '2', 'Educació', 'EBR', 'Mañana', '0', '', '0', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '148');
INSERT INTO `modularie` VALUES ('240', '0647784', '0147 CAPITAN E.P. LUIS ALBERTO GARCIA ROJAS', 'Primaria', '2', 'Educació', 'EBR', 'Mañana', '0', '', '0', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '1', '2022-05-11 13:59:12', '205');
INSERT INTO `modularie` VALUES ('241', '0647792', '0148 MAESTRO VICTOR RAUL HAYA DE LA TORRE', 'Primaria', '2', 'Educació', 'EBR', 'Mañana', '0', '', '0', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '1', '2022-05-11 13:59:42', '186');
INSERT INTO `modularie` VALUES ('242', '0664284', '0149 JORGE CIEZA LACHOS', 'Primaria', '2', 'Educació', 'EBR', 'Mañana', '0', '', '3790761', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '1', '2022-06-16 12:38:06', '4');
INSERT INTO `modularie` VALUES ('243', '0664482', '0150 HEROES DE LA BREÑA', 'Primaria', '2', 'Educació', 'EBR', 'Mañana', '0', '', '', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '79');
INSERT INTO `modularie` VALUES ('244', '0664490', '0151 MICAELA BASTIDAS', 'Primaria', '2', 'Educació', 'EBR', 'Mañana', '0', '', '0', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '120');
INSERT INTO `modularie` VALUES ('245', '0664508', '0152 JOSE CARLOS MARIATEGUI', 'Primaria', '2', 'Educació', 'EBR', 'Mañana-Tarde', '0', '', '0', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '149');
INSERT INTO `modularie` VALUES ('246', '0665372', '0154 CARLOS NORIEGA JIMENEZ', 'Primaria', '2', 'Educació', 'EBR', 'Mañana-Tarde', '0', '', '3893214', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '80');
INSERT INTO `modularie` VALUES ('247', '0665398', '0156 EL PORVENIR', 'Primaria', '2', 'Educació', 'EBR', 'Mañana', '0', '', '6081617', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '81');
INSERT INTO `modularie` VALUES ('248', '0665406', '0171-10', 'Primaria', '2', 'Educació', 'EBR', 'Mañana-Tarde', '0', '', '', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '82');
INSERT INTO `modularie` VALUES ('249', '0665414', '0158 SANTA MARIA', 'Primaria', '2', 'Educació', 'EBR', 'Mañana', '0', '', '3888781', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '103');
INSERT INTO `modularie` VALUES ('250', '0665422', '0159 10 DE OCTUBRE', 'Primaria', '2', 'Educació', 'EBR', 'Mañana-Tarde', '0', '', '0', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '150');
INSERT INTO `modularie` VALUES ('251', '0665430', '0160 SOLIDARIDAD I', 'Primaria', '2', 'Educació', 'EBR', 'Mañana', '0', '', '0', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '22');
INSERT INTO `modularie` VALUES ('252', '0665448', '0161 MOISES COLONIA TRINIDAD', 'Primaria', '2', 'Educació', 'EBR', 'Mañana', '0', '', '0', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '1', '2022-05-11 14:05:18', '199');
INSERT INTO `modularie` VALUES ('253', '0665455', 'FE Y ALEGRIA 32', 'Primaria', '2', 'Educació', 'EBR', 'Mañana-Tarde', '0', '', '0', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '153');
INSERT INTO `modularie` VALUES ('254', '0697557', '0162 SAN JOSE OBRERO', 'Primaria', '2', 'Educació', 'EBR', 'Mañana', '0', '', '0', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '121');
INSERT INTO `modularie` VALUES ('255', '0703124', '0163 CORONEL NESTOR ESCUDERO OTERO', 'Primaria', '2', 'Educació', 'EBR', 'Mañana-Tarde', '0', '', '0', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '122');
INSERT INTO `modularie` VALUES ('256', '0703132', '0164 EL AMAUTA', 'Primaria', '2', 'Educació', 'EBR', 'Mañana-Tarde', '0', '', '3876300', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '104');
INSERT INTO `modularie` VALUES ('257', '0762468', 'ANTONIA MORENO DE CACERES', 'Primaria', '2', 'Educació', 'EBR', 'Mañana-Tarde', '0', '', '0', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '126');
INSERT INTO `modularie` VALUES ('258', '0762500', 'FE Y ALEGRIA 37', 'Primaria', '2', 'Educació', 'EBR', 'Mañana-Tarde', '0', '', '0', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '139');
INSERT INTO `modularie` VALUES ('259', '0762658', '0168 AMISTAD PERU JAPON', 'Primaria', '2', 'Educació', 'EBR', 'Mañana', '0', '', '3761082', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '60');
INSERT INTO `modularie` VALUES ('260', '0762757', '134 RAMIRO PRIALE', 'Primaria', '2', 'Educació', 'EBR', 'Mañana', '0', '', '0', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '231');
INSERT INTO `modularie` VALUES ('261', '0775296', 'FE Y ALEGRIA 39', 'Primaria', '2', 'Educació', 'EBR', 'Tarde', '0', '', '0', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '243');
INSERT INTO `modularie` VALUES ('262', '0777110', '170 SANTA ROSA DEL SAUCE', 'Primaria', '2', 'Educació', 'EBR', 'Mañana', '0', '', '4590152', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '1', '2022-05-11 14:06:00', '55');
INSERT INTO `modularie` VALUES ('263', '0777144', '0171 BUENOS AIRES', 'Primaria', '2', 'Educació', 'EBR', 'Mañana', '0', '', '0', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '188');
INSERT INTO `modularie` VALUES ('264', '0777177', 'CASA BLANCA DE JESUS', 'Primaria', '2', 'Educació', 'EBR', 'Mañana-Tarde', '0', '', '0', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '141');
INSERT INTO `modularie` VALUES ('265', '0777201', '0171-01 JUAN VELASCO ALVARADO', 'Primaria', '2', 'Educació', 'EBR', 'Mañana-Tarde', '0', '', '0', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '151');
INSERT INTO `modularie` VALUES ('266', '0777235', '0171 02', 'Primaria', '2', 'Educació', 'EBR', 'Tarde', '0', '', '0', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '1', '2022-05-11 14:06:23', '170');
INSERT INTO `modularie` VALUES ('267', '0777268', '0171-03', 'Primaria', '2', 'Educació', 'EBR', 'Mañana-Tarde', '0', '', '0', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '105');
INSERT INTO `modularie` VALUES ('268', '0826024', 'SAN ANTONIO DE JICAMARCA', 'Primaria', '2', 'Educació', 'EBR', 'Tarde', '0', '', '0', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '111');
INSERT INTO `modularie` VALUES ('269', '0826081', '0140 SANTIAGO ANTUNEZ DE MAYOLO', 'Primaria', '2', 'Educació', 'EBR', 'Mañana-Tarde', '0', '', '0', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '212');
INSERT INTO `modularie` VALUES ('270', '0826115', '0169', 'Primaria', '2', 'Educació', 'EBR', 'Mañana', '0', '', '3876718', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '61');
INSERT INTO `modularie` VALUES ('271', '0826263', '0119 CANTO BELLO', 'Primaria', '2', 'Educació', 'EBR', 'Mañana', '0', '', '0', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '203');
INSERT INTO `modularie` VALUES ('272', '0826321', '0153 ALEJANDRO SANCHEZ ARTEAGA', 'Primaria', '2', 'Educació', 'EBR', 'Mañana', '0', '', '0', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '187');
INSERT INTO `modularie` VALUES ('273', '0826479', '1182 EL BOSQUE', 'Primaria', '2', 'Educació', 'EBR', 'Mañana-Tarde', '0', '', '3878900', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '83');
INSERT INTO `modularie` VALUES ('274', '0826834', '0155 JOSE ANTONIO ENCINAS FRANCO', 'Primaria', '2', 'Educació', 'EBR', 'Mañana-Tarde', '0', '', '0', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '206');
INSERT INTO `modularie` VALUES ('275', '0835033', 'GRAN MARISCAL ANDRES AVELINO CACERES DORREGARAY', 'Primaria', '2', 'Educació', 'EBR', 'Mañana-Tarde', '0', '', '0', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '1', '2021-06-17 16:08:30', '254');
INSERT INTO `modularie` VALUES ('276', '0846014', '166 KAROL WOJTYLA', 'Primaria', '2', 'Educació', 'EBR', 'Mañana', '0', '', '0', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '125');
INSERT INTO `modularie` VALUES ('277', '0846048', '0167 MARIA REICHE', 'Primaria', '2', 'Educació', 'EBR', 'Mañana', '0', '', '0', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '117');
INSERT INTO `modularie` VALUES ('278', '0847087', '171-05 LOS ANGELES', 'Primaria', '2', 'Educació', 'EBR', 'Mañana-Tarde', '0', '', '0', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '1', '2022-05-11 14:07:13', '196');
INSERT INTO `modularie` VALUES ('279', '0902049', '1183 SAUL CANTORAL HUAMANI', 'Primaria', '2', 'Educació', 'EBR', 'Mañana-Tarde', '0', '', '0', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '152');
INSERT INTO `modularie` VALUES ('280', '1063023', 'LA PRADERA II', 'Primaria', '2', 'Educació', 'EBR', 'Mañana-Tarde', '0', '', '0', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '239');
INSERT INTO `modularie` VALUES ('281', '1070275', '171 - 4 CONSUELO SOLEDAD CRISANTO SALINAS', 'Primaria', '2', 'Educació', 'EBR', 'Mañana-Tarde', '0', '', '0', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '1', '2022-05-11 14:06:47', '124');
INSERT INTO `modularie` VALUES ('282', '1070358', '0171 08', 'Primaria', '2', 'Educació', 'EBR', 'Mañana-Tarde', '0', '', '0', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '123');
INSERT INTO `modularie` VALUES ('283', '1070390', '0171-07 COVARRUBIA LAFUENTE', 'Primaria', '2', 'Educació', 'EBR', 'Mañana-Tarde', '0', '', '4581655', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '62');
INSERT INTO `modularie` VALUES ('284', '1258649', '117 SIGNOS DE FE', 'Primaria', '2', 'Educació', 'EBR', 'Mañana-Tarde', '0', '', '0', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '162');
INSERT INTO `modularie` VALUES ('285', '1454966', '27 DE MARZO', 'Primaria', '2', 'Educació', 'EBR', 'Mañana', '0', '', '0', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '96');
INSERT INTO `modularie` VALUES ('286', '1500982', '10 DE MARZO', 'Primaria', '2', 'Educació', 'EBR', 'Mañana-Tarde', '0', '', '0', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '140');
INSERT INTO `modularie` VALUES ('287', '1502038', 'ASOCIACION RELIGIOSA MARIA Y JESUS', 'Primaria', '2', 'Educació', 'EBR', 'Mañana', '0', '', '0', '', '0', '0', '0', '0', '0000-00-00 00:00:00', '1', '2021-06-17 16:21:38', '157');
INSERT INTO `modularie` VALUES ('288', '0334672', 'NICOLAS DE PIEROLA', 'Secundaria', '3', 'Educació', 'EBR', 'Mañana', '0', '', '0', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '262');
INSERT INTO `modularie` VALUES ('289', '0336578', '1178 JAVIER HERAUD', 'Secundaria', '3', 'Educació', 'EBR', 'Mañana', '0', '', '0', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '42');
INSERT INTO `modularie` VALUES ('290', '0336586', 'JOSE CARLOS MARIATEGUI', 'Secundaria', '3', 'Educació', 'EBR', 'Mañana', '0', '', '0', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '247');
INSERT INTO `modularie` VALUES ('291', '0336610', 'NICOLAS COPERNICO', 'Secundaria', '3', 'Educació', 'EBR', 'Mañana-Tarde', '0', '', '0', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '216');
INSERT INTO `modularie` VALUES ('292', '0336628', 'ANTENOR ORREGO ESPINOZA', 'Secundaria', '3', 'Educació', 'EBR', 'Mañana-Tarde', '0', '', '0', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '7');
INSERT INTO `modularie` VALUES ('293', '0336891', 'FE Y ALEGRIA 05', 'Secundaria', '3', 'Educació', 'EBR', 'Mañana-Tarde', '0', '', '0', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '44');
INSERT INTO `modularie` VALUES ('294', '0519645', 'GRAN MARISCAL ANDRES A.CACERES D.', 'Secundaria', '3', 'Educació', 'EBR', 'Mañana-Tarde', '0', '', '0', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '1', '2021-06-11 12:25:04', '254');
INSERT INTO `modularie` VALUES ('295', '0535724', 'FE Y ALEGRIA 25', 'Secundaria', '3', 'Educació', 'EBR', 'Mañana-Tarde', '0', '', '0', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '164');
INSERT INTO `modularie` VALUES ('296', '0555946', '1174 VIRGEN DEL CARMEN', 'Secundaria', '3', 'Educació', 'EBR', 'Tarde', '0', '', '0', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '5');
INSERT INTO `modularie` VALUES ('297', '0556340', '0071 NUESTRA SEÑORA DE LA MERCED', 'Secundaria', '3', 'Educació', 'EBR', 'Mañana', '0', '', '0', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '37');
INSERT INTO `modularie` VALUES ('298', '0556449', '1181 ALBERT EINSTEIN', 'Secundaria', '3', 'Educació', 'EBR', 'Tarde', '0', '', '0', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '43');
INSERT INTO `modularie` VALUES ('299', '0578260', '0085 JOSE DE LA TORRE UGARTE', 'Secundaria', '3', 'Educació', 'EBR', 'Mañana-Tarde', '0', '', '0', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '228');
INSERT INTO `modularie` VALUES ('300', '0578278', '1171 JORGE BASADRE GROHMANN', 'Secundaria', '3', 'Educació', 'EBR', 'Tarde', '0', '', '0', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '244');
INSERT INTO `modularie` VALUES ('301', '0578443', '1179 TOMAS ALVA EDISON', 'Secundaria', '3', 'Educació', 'EBR', 'Mañana', '0', '', '0', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '35');
INSERT INTO `modularie` VALUES ('302', '0578450', 'FE Y ALEGRIA 26', 'Secundaria', '3', 'Educació', 'EBR', 'Mañana', '0', '', '0', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '189');
INSERT INTO `modularie` VALUES ('303', '0578468', 'CABO GC. MARTIN ESQUICHA BERNEDO', 'Secundaria', '3', 'Educació', 'EBR', 'Mañana', '0', '', '0', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '1', '2022-05-11 14:07:38', '6');
INSERT INTO `modularie` VALUES ('304', '0578492', '0076 MARIA AUXILIADORA', 'Secundaria', '3', 'Educació', 'EBR', 'Mañana', '0', '', '0', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '38');
INSERT INTO `modularie` VALUES ('305', '0578500', '0086 JOSE MARIA ARGUEDAS', 'Secundaria', '3', 'Educació', 'EBR', 'Mañana-Tarde', '0', '', '0', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '214');
INSERT INTO `modularie` VALUES ('306', '0578518', '0089 MANUEL GONZALES PRADA', 'Secundaria', '3', 'Educació', 'EBR', 'Tarde', '0', '', '0', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '19');
INSERT INTO `modularie` VALUES ('307', '0578526', '0092 ALFRED NOBEL', 'Secundaria', '3', 'Educació', 'EBR', 'Tarde', '0', '', '0', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '54');
INSERT INTO `modularie` VALUES ('308', '0578534', '0113 DANIEL ALOMIA ROBLES', 'Secundaria', '3', 'Educació', 'EBR', 'Tarde', '0', '', '0', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '1', '2022-05-11 14:08:01', '39');
INSERT INTO `modularie` VALUES ('309', '0578542', '122 ANDRES AVELINO CACERES', 'Secundaria', '3', 'Educació', 'EBR', 'Tarde', '0', '', '0', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '8');
INSERT INTO `modularie` VALUES ('310', '0578559', '1173 JULIO CESAR TELLO', 'Secundaria', '3', 'Educació', 'EBR', 'Mañana', '0', '', '0', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '34');
INSERT INTO `modularie` VALUES ('311', '0607531', '0087 JOSE MARIA ARGUEDAS', 'Secundaria', '3', 'Educació', 'EBR', 'Mañana-Tarde', '0', '', '0', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '200');
INSERT INTO `modularie` VALUES ('312', '0607549', '0091 SANTA FE', 'Secundaria', '3', 'Educació', 'EBR', 'Mañana-Tarde', '0', '', '0', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '58');
INSERT INTO `modularie` VALUES ('313', '0607556', '109 INCA MANCO CAPAC', 'Secundaria', '3', 'Educació', 'EBR', 'Tarde', '0', '', '0', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '63');
INSERT INTO `modularie` VALUES ('314', '0607697', '1182 EL BOSQUE', 'Secundaria', '3', 'Educació', 'EBR', 'Mañana-Tarde', '0', '', '0', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '83');
INSERT INTO `modularie` VALUES ('315', '0642892', 'FRANCISCO BOLOGNESI CERVANTES', 'Secundaria', '3', 'Educació', 'EBR', 'Mañana-Tarde', '0', '', '0', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '165');
INSERT INTO `modularie` VALUES ('316', '0642926', '0090 DANIEL ALCIDES CARRION', 'Secundaria', '3', 'Educació', 'EBR', 'Mañana-Tarde', '0', '', '0', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '20');
INSERT INTO `modularie` VALUES ('317', '0663971', '112 HEROES DE LA BREÑA', 'Secundaria', '3', 'Educació', 'EBR', 'Mañana-Tarde', '0', '', '0', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '230');
INSERT INTO `modularie` VALUES ('318', '0664292', '0128 LA LIBERTAD', 'Secundaria', '3', 'Educació', 'EBR', 'Tarde', '0', '', '0', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '56');
INSERT INTO `modularie` VALUES ('319', '0664748', '142 MARTIR DANIEL ALCIDES CARRION', 'Secundaria', '3', 'Educació', 'EBR', 'Mañana-Tarde', '0', '', '0', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '1', '2022-05-11 13:58:45', '185');
INSERT INTO `modularie` VALUES ('320', '0664912', '0009 JOSE MARIA ARGUEDAS', 'Secundaria', '3', 'Educació', 'EBR', 'Mañana-Tarde', '0', '', '0', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '219');
INSERT INTO `modularie` VALUES ('321', '0665265', '110 SAN MARCOS', 'Secundaria', '3', 'Educació', 'EBR', 'Mañana', '0', '', '0', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '64');
INSERT INTO `modularie` VALUES ('322', '0665273', '126 JAVIER PEREZ DE CUELLAR', 'Secundaria', '3', 'Educació', 'EBR', 'Tarde', '0', '', '0', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '65');
INSERT INTO `modularie` VALUES ('323', '0665281', '0130 HEROES DEL CENEPA', 'Secundaria', '3', 'Educació', 'EBR', 'Tarde', '0', '', '0', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '33');
INSERT INTO `modularie` VALUES ('324', '0665463', '0120 MANUEL ROBLES ALARCON', 'Secundaria', '3', 'Educació', 'EBR', 'Mañana-Tarde', '0', '', '0', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '184');
INSERT INTO `modularie` VALUES ('325', '0665471', '0132 TORIBIO DE LUZURIAGA Y MEJIA', 'Secundaria', '3', 'Educació', 'EBR', 'Tarde', '0', '', '0', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '198');
INSERT INTO `modularie` VALUES ('326', '0665489', '0151 MICAELA BASTIDAS', 'Secundaria', '3', 'Educació', 'EBR', 'Tarde', '0', '', '0', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '120');
INSERT INTO `modularie` VALUES ('327', '0703215', '116 ABRAHAM VALDELOMAR', 'Secundaria', '3', 'Educació', 'EBR', 'Mañana-Tarde', '0', '', '0', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '163');
INSERT INTO `modularie` VALUES ('328', '0703223', '131 MONITOR HUASCAR', 'Secundaria', '3', 'Educació', 'EBR', 'Tarde', '0', '', '0', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '172');
INSERT INTO `modularie` VALUES ('329', '0703231', '0152 JOSE CARLOS MARIATEGUI', 'Secundaria', '3', 'Educació', 'EBR', 'Mañana-Tarde', '0', '', '0', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '149');
INSERT INTO `modularie` VALUES ('330', '0703249', '0146 SU SANTIDAD JUAN PABLO II', 'Secundaria', '3', 'Educació', 'EBR', 'Tarde', '0', '', '0', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '148');
INSERT INTO `modularie` VALUES ('331', '0703256', '0137 MIGUEL GRAU SEMINARIO', 'Secundaria', '3', 'Educació', 'EBR', 'Tarde', '0', '', '0', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '204');
INSERT INTO `modularie` VALUES ('332', '0725523', '046 LOS LIBERTADORES DE AYACUCHO', 'Secundaria', '3', 'Educació', 'EBR', 'Tarde', '0', '', '0', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '1', '2019-09-13 15:04:10', '257');
INSERT INTO `modularie` VALUES ('333', '0728196', '0135 TORIBIO RODRIGUEZ DE MENDOZA', 'Secundaria', '3', 'Educació', 'EBR', 'Tarde', '0', '', '0', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '215');
INSERT INTO `modularie` VALUES ('334', '0728337', '145 INDEPENDENCIA AMERICANA', 'Secundaria', '3', 'Educació', 'EBR', 'Tarde', '0', '', '0', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '173');
INSERT INTO `modularie` VALUES ('335', '0762849', '121 VIRGEN DE FATIMA', 'Secundaria', '3', 'Educació', 'EBR', 'Tarde', '0', '', '0', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '207');
INSERT INTO `modularie` VALUES ('336', '0762856', '125 RICARDO PALMA', 'Secundaria', '3', 'Educació', 'EBR', 'Tarde', '0', '', '0', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '171');
INSERT INTO `modularie` VALUES ('337', '0762864', '0138 PROCERES DE LA INDEPENDENCIA', 'Secundaria', '3', 'Educació', 'EBR', 'Tarde', '0', '', '0', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '59');
INSERT INTO `modularie` VALUES ('338', '0762880', 'FE Y ALEGRIA 37', 'Secundaria', '3', 'Educació', 'EBR', 'Mañana-Tarde', '0', '', '0', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '139');
INSERT INTO `modularie` VALUES ('339', '0762906', 'ANTONIA MORENO DE CACERES', 'Secundaria', '3', 'Educació', 'EBR', 'Mañana-Tarde', '0', '', '0', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '126');
INSERT INTO `modularie` VALUES ('340', '0762914', 'RAMIRO PRIALE PRIALE', 'Secundaria', '3', 'Educació', 'EBR', 'Mañana-Tarde', '0', '', '0', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '106');
INSERT INTO `modularie` VALUES ('341', '0775320', 'FE Y ALEGRIA 39', 'Secundaria', '3', 'Educació', 'EBR', 'Mañana', '0', '', '0', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '243');
INSERT INTO `modularie` VALUES ('342', '0777656', '0148 MAESTRO VICTOR RAUL HAYA DE LA TORRE', 'Secundaria', '3', 'Educació', 'EBR', 'Tarde', '0', '', '0', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '1', '2022-05-11 13:59:46', '186');
INSERT INTO `modularie` VALUES ('343', '0777680', '0073 BENITO JUAREZ', 'Secundaria', '3', 'Educació', 'EBR', 'Tarde', '0', '', '0', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '9');
INSERT INTO `modularie` VALUES ('344', '0777714', '157 CAPITAN F.A.P. JOSE ABELARDO QU', 'Secundaria', '3', 'Educació', 'EBR', 'Mañana', '0', '', '0', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '84');
INSERT INTO `modularie` VALUES ('345', '0778738', '0159 10 DE OCTUBRE', 'Secundaria', '3', 'Educació', 'EBR', 'Mañana-Tarde', '0', '', '0', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '150');
INSERT INTO `modularie` VALUES ('346', '0778761', '0161 MOISES COLONIA TRINIDAD', 'Secundaria', '3', 'Educació', 'EBR', 'Mañana', '0', '', '0', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '1', '2022-05-11 14:05:23', '199');
INSERT INTO `modularie` VALUES ('347', '0778795', '0163 CORONEL NESTOR ESCUDERO OTERO', 'Secundaria', '3', 'Educació', 'EBR', 'Mañana-Tarde', '0', '', '0', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '122');
INSERT INTO `modularie` VALUES ('348', '0900647', 'FE Y ALEGRIA 32', 'Secundaria', '3', 'Educació', 'EBR', 'Tarde', '0', '', '0', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '153');
INSERT INTO `modularie` VALUES ('349', '0900670', '0069 MACHU PICCHU', 'Secundaria', '3', 'Educació', 'EBR', 'Tarde', '0', '', '0', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '169');
INSERT INTO `modularie` VALUES ('350', '0900704', '100', 'Secundaria', '3', 'Educació', 'EBR', 'Tarde', '0', '', '0', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '197');
INSERT INTO `modularie` VALUES ('351', '0900738', '0134 MARIO FLORIAN', 'Secundaria', '3', 'Educació', 'EBR', 'Mañana-Tarde', '0', '', '0', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '40');
INSERT INTO `modularie` VALUES ('352', '0900761', '0136 SANTA ROSA MILAGROSA', 'Secundaria', '3', 'Educació', 'EBR', 'Tarde', '0', '', '0', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '213');
INSERT INTO `modularie` VALUES ('353', '0900795', '139 GRAN AMAUTA MARIATEGUI', 'Secundaria', '3', 'Educació', 'EBR', 'Tarde', '0', '', '0', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '1', '2022-05-11 13:57:56', '101');
INSERT INTO `modularie` VALUES ('354', '0900829', '0143 SOLIDARIDAD II', 'Secundaria', '3', 'Educació', 'EBR', 'Mañana', '0', '', '0', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '21');
INSERT INTO `modularie` VALUES ('355', '0900852', '0150 HEROES DE LA BREÑA', 'Secundaria', '3', 'Educació', 'EBR', 'Tarde', '0', '', '0', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '79');
INSERT INTO `modularie` VALUES ('356', '0900886', '0153 ALEJANDRO SANCHEZ ARTEAGA', 'Secundaria', '3', 'Educació', 'EBR', 'Tarde', '0', '', '0', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '187');
INSERT INTO `modularie` VALUES ('357', '0900910', '0154 CARLOS NORIEGA JIMENEZ', 'Secundaria', '3', 'Educació', 'EBR', 'Tarde', '0', '', '0', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '80');
INSERT INTO `modularie` VALUES ('358', '0900944', '0164 EL AMAUTA', 'Secundaria', '3', 'Educació', 'EBR', 'Tarde', '0', '', '0', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '104');
INSERT INTO `modularie` VALUES ('359', '0900977', '166 KAROL WOJTYLA', 'Secundaria', '3', 'Educació', 'EBR', 'Tarde', '0', '', '0', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '125');
INSERT INTO `modularie` VALUES ('360', '0901009', '0171-01 JUAN VELASCO ALVARADO', 'Secundaria', '3', 'Educació', 'EBR', 'Mañana-Tarde', '0', '', '0', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '151');
INSERT INTO `modularie` VALUES ('361', '0901017', 'SAN ANTONIO DE JICAMARCA', 'Secundaria', '3', 'Educació', 'EBR', 'Tarde', '0', '', '0', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '111');
INSERT INTO `modularie` VALUES ('362', '0901033', '0119 CANTO BELLO', 'Secundaria', '3', 'Educació', 'EBR', 'Tarde', '0', '', '0', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '203');
INSERT INTO `modularie` VALUES ('363', '0901066', '0147 CAPITAN E.P. LUIS ALBERTO GARCIA ROJAS', 'Secundaria', '3', 'Educació', 'EBR', 'Tarde', '0', '', '0', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '1', '2022-05-11 13:59:16', '205');
INSERT INTO `modularie` VALUES ('364', '0901082', 'SOLIDARIDAD III', 'Secundaria', '3', 'Educació', 'EBR', 'Mañana', '0', '', '0', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '23');
INSERT INTO `modularie` VALUES ('365', '0901090', '0158 SANTA MARIA', 'Secundaria', '3', 'Educació', 'EBR', 'Tarde', '0', '', '0', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '103');
INSERT INTO `modularie` VALUES ('366', '0901124', '0171 02', 'Secundaria', '3', 'Educació', 'EBR', 'Mañana', '0', '', '0', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '1', '2022-05-11 14:06:29', '170');
INSERT INTO `modularie` VALUES ('367', '1008929', '1025 MARIA PARADO DE BELLIDO', 'Secundaria', '3', 'Educació', 'EBR', 'Mañana-Tarde', '0', '', '0', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '234');
INSERT INTO `modularie` VALUES ('368', '1063106', '0098 PERU JAPON', 'Secundaria', '3', 'Educació', 'EBR', 'Tarde', '0', '', '0', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '224');
INSERT INTO `modularie` VALUES ('369', '1063148', '115 TORIBIO RODRIGUEZ DE MENDOZA', 'Secundaria', '3', 'Educació', 'EBR', 'Mañana-Tarde', '0', '', '0', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '226');
INSERT INTO `modularie` VALUES ('370', '1063221', '134 RAMIRO PRIALE', 'Secundaria', '3', 'Educació', 'EBR', 'Mañana', '0', '', '0', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '231');
INSERT INTO `modularie` VALUES ('371', '1063262', '1044 MARIA REICHE NEWMANN', 'Secundaria', '3', 'Educació', 'EBR', 'Mañana', '0', '', '0', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '241');
INSERT INTO `modularie` VALUES ('372', '1063304', '1047 JUANA INFANTES VERA', 'Secundaria', '3', 'Educació', 'EBR', 'Mañana-Tarde', '0', '', '0', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '227');
INSERT INTO `modularie` VALUES ('373', '1063346', 'GLORIOSOS HUSARES DE JUNIN', 'Secundaria', '3', 'Educació', 'EBR', 'Mañana-Tarde', '0', '', '0', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '246');
INSERT INTO `modularie` VALUES ('374', '1070036', '0162 SAN JOSE OBRERO', 'Secundaria', '3', 'Educació', 'EBR', 'Tarde', '0', '', '0', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '121');
INSERT INTO `modularie` VALUES ('375', '1070077', '0149 JORGE CIEZA LACHOS', 'Secundaria', '3', 'Educació', 'EBR', 'Mañana', '0', '', '0', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '1', '2022-06-16 12:38:13', '4');
INSERT INTO `modularie` VALUES ('376', '1070119', '0168 AMISTAD PERU JAPON', 'Secundaria', '3', 'Educació', 'EBR', 'Tarde', '0', '', '0', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '60');
INSERT INTO `modularie` VALUES ('377', '1070150', '0169', 'Secundaria', '3', 'Educació', 'EBR', 'Tarde', '0', '', '0', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '61');
INSERT INTO `modularie` VALUES ('378', '1070192', '1183 SAUL CANTORAL HUAMANI', 'Secundaria', '3', 'Educació', 'EBR', 'Mañana', '0', '', '0', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '152');
INSERT INTO `modularie` VALUES ('379', '1071919', '0156 EL PORVENIR', 'Secundaria', '3', 'Educació', 'EBR', 'Tarde', '0', '', '0', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '81');
INSERT INTO `modularie` VALUES ('380', '1073212', '0045 SAN ANTONIO', 'Secundaria', '3', 'Educació', 'EBR', 'Mañana', '0', '', '0', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '202');
INSERT INTO `modularie` VALUES ('381', '1223023', '170 SANTA ROSA DEL SAUCE', 'Secundaria', '3', 'Educació', 'EBR', 'Tarde', '0', '', '0', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '1', '2022-05-11 14:06:05', '55');
INSERT INTO `modularie` VALUES ('382', '1227461', 'LA PRADERA II', 'Secundaria', '3', 'Educació', 'EBR', 'Mañana-Tarde', '0', '', '0', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '239');
INSERT INTO `modularie` VALUES ('383', '1501451', '117 SIGNOS DE FE', 'Secundaria', '3', 'Educació', 'EBR', 'Mañana-Tarde', '0', '', '0', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '162');
INSERT INTO `modularie` VALUES ('384', '1720390', 'CESAR VALLEJO', 'Secundaria', '3', 'Educació', 'EBR', 'Mañana', '0', '', '0', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '127');
INSERT INTO `modularie` VALUES ('385', '1720416', 'CASA BLANCA DE JESUS', 'Secundaria', '3', 'Educació', 'EBR', 'Tarde', '0', '', '0', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '141');
INSERT INTO `modularie` VALUES ('386', '1748730', 'SAN GABRIEL', 'Secundaria', '3', 'Educació', 'EBR', 'Mañana', '0', '', '0', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '66');
INSERT INTO `modularie` VALUES ('387', '1748748', 'TUPAC AMARU II', 'Secundaria', '3', 'Educació', 'EBR', 'Mañana', '0', '', '0', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '154');
INSERT INTO `modularie` VALUES ('388', '0901801', 'PRITE LOS ANGELITOS', 'Básica Especial', '4', 'Programa', 'PRITE', 'Mañana', '0', '', '0', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '67');
INSERT INTO `modularie` VALUES ('389', '0901777', 'PRITE CRUZ DE MOTUPE', 'Básica Especial', '4', 'Programa', 'PRITE', 'Mañana', '0', '', '0', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '130');
INSERT INTO `modularie` VALUES ('390', '0901835', 'PRITE CANTO GRANDE', 'Básica Especial', '4', 'Programa', 'PRITE', 'Mañana', '0', '', '0', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '158');
INSERT INTO `modularie` VALUES ('392', '1230994', 'PRITE AYUDAME', 'Básica Especial', '4', 'Programa', 'PRITE', 'Mañana', '0', '', '0', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '248');
INSERT INTO `modularie` VALUES ('393', '1737386', 'SAN MATIAS DE JESUS', 'Básica Especial - Inicial', '5', 'Educació', 'EBE', 'Mañana-Tarde', '0', '', '0', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '11');
INSERT INTO `modularie` VALUES ('394', '1737394', 'FE Y ALEGRIA 37', 'Básica Especial - Inicial', '5', 'Educació', 'EBE', 'Mañana-Tarde', '0', '', '0', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '139');
INSERT INTO `modularie` VALUES ('395', '1737402', 'LOS PINOS', 'Básica Especial - Inicial', '5', 'Educació', 'EBE', 'Mañana-Tarde', '0', '', '0', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '217');
INSERT INTO `modularie` VALUES ('396', '1737410', 'HIPOLITO UNANUE', 'Básica Especial - Inicial', '5', 'Educació', 'EBE', 'Mañana-Tarde', '0', '', '0', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '232');
INSERT INTO `modularie` VALUES ('397', '1737428', 'SEÑOR DE LA ESPERANZA', 'Básica Especial - Inicial', '5', 'Educació', 'EBE', 'Mañana-Tarde', '0', '', '0', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '175');
INSERT INTO `modularie` VALUES ('398', '0478438', 'SAN MATIAS DE JESUS', 'Básica Especial - Primaria', '6', 'Educació', 'EBE', 'Mañana-Tarde', '0', '', '0', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '11');
INSERT INTO `modularie` VALUES ('399', '1072297', 'FE Y ALEGRIA 37', 'Básica Especial - Primaria', '6', 'Educació', 'EBE', 'Mañana-Tarde', '0', '', '0', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '139');
INSERT INTO `modularie` VALUES ('400', '0664755', 'LOS PINOS', 'Básica Especial - Primaria', '6', 'Educació', 'EBE', 'Mañana-Tarde', '0', '', '0', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '217');
INSERT INTO `modularie` VALUES ('401', '0605493', 'HIPOLITO UNANUE', 'Básica Especial - Primaria', '6', 'Educació', 'EBE', 'Mañana-Tarde', '0', '', '0', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '232');
INSERT INTO `modularie` VALUES ('402', '0664771', 'SEÑOR DE LA ESPERANZA', 'Básica Especial - Primaria', '6', 'Educació', 'EBE', 'Mañana-Tarde', '0', '', '0', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '175');
INSERT INTO `modularie` VALUES ('403', '0664763', 'FE Y ALEGRIA 25', 'Básica Especial - Primaria', '6', 'Educació', 'EBE', 'Mañana-Tarde', '0', '', '0', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '164');
INSERT INTO `modularie` VALUES ('404', '0334458', 'CEBA - 1172 CIRO ALEGRIA', 'Básica Alternativa - Inicial e Intermedio', '7', 'Educació', 'EBA', 'Mañana-Tarde', '0', '', '0', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '10');
INSERT INTO `modularie` VALUES ('405', '0334466', 'CEBA - 1175 GLORIOSOS HUSARES DE JUNIN', 'Básica Alternativa - Inicial e Intermedio', '7', 'Educació', 'EBA', 'Mañana-Tarde', '0', '', '0', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '246');
INSERT INTO `modularie` VALUES ('406', '0556647', 'CEBA - 1181 ALBERT EINSTEIN', 'Básica Alternativa - Inicial e Intermedio', '7', 'Educació', 'EBA', 'Mañana-Tarde', '0', '', '0', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '43');
INSERT INTO `modularie` VALUES ('407', '0607564', 'CEBA - 0086 JOSE MARIA ARGUEDAS', 'Básica Alternativa - Inicial e Intermedio', '7', 'Educació', 'EBA', 'Mañana-Tarde', '0', '', '0', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '214');
INSERT INTO `modularie` VALUES ('408', '0632208', 'CEBA - FRANCISCO BOLOGNESI CERVANTES', 'Básica Alternativa - Inicial e Intermedio', '7', 'Educació', 'EBA', 'Mañana-Tarde', '0', '', '0', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '165');
INSERT INTO `modularie` VALUES ('409', '0665620', 'CEBA - 115 TORIBIO RODRIGUEZ DE MENDOZA', 'Básica Alternativa - Inicial e Intermedio', '7', 'Educació', 'EBA', 'Mañana-Tarde', '0', '', '0', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '226');
INSERT INTO `modularie` VALUES ('410', '0697532', 'CEBA - 1173 JULIO CESAR TELLO', 'Básica Alternativa - Inicial e Intermedio', '7', 'Educació', 'EBA', 'Mañana-Tarde', '0', '', '0', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '34');
INSERT INTO `modularie` VALUES ('411', '0703207', 'CEBA - 122 ANDRES AVELINO CACERES', 'Básica Alternativa - Inicial e Intermedio', '7', 'Educació', 'EBA', 'Mañana-Tarde', '0', '', '0', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '8');
INSERT INTO `modularie` VALUES ('412', '0777292', 'CEBA - 0137 MIGUEL GRAU SEMINARIO', 'Básica Alternativa - Inicial e Intermedio', '7', 'Educació', 'EBA', 'Mañana-Tarde', '0', '', '0', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '204');
INSERT INTO `modularie` VALUES ('413', '0900613', 'CEBA - 0151 MICAELA BASTIDAS', 'Básica Alternativa - Inicial e Intermedio', '7', 'Educació', 'EBA', 'Mañana-Tarde', '0', '', '0', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '120');
INSERT INTO `modularie` VALUES ('414', '0901058', 'CEBA - 109 INCA MANCO CAPAC', 'Básica Alternativa - Inicial e Intermedio', '7', 'Educació', 'EBA', 'Mañana-Tarde', '0', '', '0', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '63');
INSERT INTO `modularie` VALUES ('415', '1063064', 'CEBA - GRAN MARISCAL ANDRES AVELINO CACERES DORREGARAY', 'Básica Alternativa - Inicial e Intermedio', '7', 'Educació', 'EBA', 'Mañana-Tarde', '0', '', '0', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '254');
INSERT INTO `modularie` VALUES ('416', '1501907', 'CEBA - MANUEL GONZALES PRADA', 'Básica Alternativa - Inicial e Intermedio', '7', 'Educació', 'EBA', 'Mañana-Tarde', '0', '', '0', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '85');
INSERT INTO `modularie` VALUES ('417', '0337873', 'CEBA - GRAN MARISCAL ANDRES AVELINO CACERES DORREGARAY', 'Básica Alternativa - Avanzado', '8', 'Educació', 'EBA', 'Mañana-Tarde', '0', '', '0', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '254');
INSERT INTO `modularie` VALUES ('418', '0495515', 'CEBA - 1175 GLORIOSOS HUSARES DE JUNIN', 'Básica Alternativa - Avanzado', '8', 'Educació', 'EBA', 'Mañana-Tarde', '0', '', '0', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '246');
INSERT INTO `modularie` VALUES ('419', '0495523', 'CEBA - 1045 NUESTRA SEÑORA DE FATIMA', 'Básica Alternativa - Avanzado', '8', 'Educació', 'EBA', 'Mañana-Tarde', '0', '', '0', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '242');
INSERT INTO `modularie` VALUES ('420', '0607580', 'CEBA - 0086 JOSE MARIA ARGUEDAS', 'Básica Alternativa - Avanzado', '8', 'Educació', 'EBA', 'Mañana-Tarde', '0', '', '0', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '214');
INSERT INTO `modularie` VALUES ('421', '0607598', 'CEBA - 1181 ALBERT EINSTEIN', 'Básica Alternativa - Avanzado', '8', 'Educació', 'EBA', 'Noche', '0', '', '0', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '43');
INSERT INTO `modularie` VALUES ('422', '0643049', 'CEBA - FRANCISCO BOLOGNESI CERVANTES', 'Básica Alternativa - Avanzado', '8', 'Educació', 'EBA', 'Mañana-Tarde', '0', '', '0', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '165');
INSERT INTO `modularie` VALUES ('423', '0697540', 'CEBA - 1173 JULIO CESAR TELLO', 'Básica Alternativa - Avanzado', '8', 'Educació', 'EBA', 'Noche', '0', '', '0', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '34');
INSERT INTO `modularie` VALUES ('424', '0703314', 'CEBA - 122 ANDRES AVELINO CACERES', 'Básica Alternativa - Avanzado', '8', 'Educació', 'EBA', 'Noche', '0', '', '0', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '8');
INSERT INTO `modularie` VALUES ('425', '0901660', 'CEBA - 0146 SU SANTIDAD JUAN PABLO II', 'Básica Alternativa - Avanzado', '8', 'Educació', 'EBA', 'Mañana-Tarde', '0', '', '0', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '148');
INSERT INTO `modularie` VALUES ('426', '0901744', 'CEBA - 109 INCA MANCO CAPAC', 'Básica Alternativa - Avanzado', '8', 'Educació', 'EBA', 'Noche', '0', '', '0', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '63');
INSERT INTO `modularie` VALUES ('427', '1008523', 'CEBA - 115 TORIBIO RODRIGUEZ DE MENDOZA', 'Básica Alternativa - Avanzado', '8', 'Educació', 'EBA', 'Mañana-Tarde', '0', '', '0', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '226');
INSERT INTO `modularie` VALUES ('428', '1065325', 'CEBA - 0151 MICAELA BASTIDAS', 'Básica Alternativa - Avanzado', '8', 'Educació', 'EBA', 'Mañana-Tarde', '0', '', '0', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '120');
INSERT INTO `modularie` VALUES ('429', '1258607', 'CEBA - 0137 MIGUEL GRAU SEMINARIO', 'Básica Alternativa - Avanzado', '8', 'Educació', 'EBA', 'Noche', '0', '', '0', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '204');
INSERT INTO `modularie` VALUES ('430', '1315332', 'CEBA - PILOTO MADRE TERESA DE CALCUTA', 'Básica Alternativa - Avanzado', '8', 'Educació', 'EBA', 'Mañana-Tarde', '0', '', '0', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '60');
INSERT INTO `modularie` VALUES ('431', '1359850', 'CEBA - ANTENOR ORREGO ESPINOZA', 'Básica Alternativa - Avanzado', '8', 'Educació', 'EBA', 'Mañana-Tarde', '0', '', '0', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '7');
INSERT INTO `modularie` VALUES ('432', '1503911', 'CEBA - MANUEL GONZALES PRADA', 'Básica Alternativa - Avanzado', '8', 'Educació', 'EBA', 'Mañana-Tarde', '0', '', '0', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '85');
INSERT INTO `modularie` VALUES ('433', '0901819', 'MANGOMARCA', 'Técnico Productiva', '9', 'Educació', 'ETP', 'Mañana-Tarde', '0', '', '0', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '12');
INSERT INTO `modularie` VALUES ('434', '1221985', '090 DANIEL ALCIDES CARRION', 'Técnico Productiva', '9', 'Educació', 'ETP', 'Mañana-Tarde', '0', '', '0', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '20');
INSERT INTO `modularie` VALUES ('435', '0901850', 'TECNICO SAN HILARION', 'Técnico Productiva', '9', 'Educació', 'ETP', 'Mañana-Tarde', '0', '', '0', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '45');
INSERT INTO `modularie` VALUES ('436', '0482398', 'MICAELA BASTIDAS', 'Técnico Productiva', '9', 'Educació', 'ETP', 'Mañana-Tarde', '0', '', '0', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '46');
INSERT INTO `modularie` VALUES ('437', '0901892', 'SEÑOR DE LOS MILAGROS', 'Técnico Productiva', '9', 'Educació', 'ETP', 'Mañana-Tarde', '0', '', '0', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '68');
INSERT INTO `modularie` VALUES ('438', '1072172', 'JUAN PABLO II', 'Técnico Productiva', '9', 'Educació', 'ETP', 'Mañana-Tarde', '0', '', '0', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '86');
INSERT INTO `modularie` VALUES ('439', '0901876', 'HUANTA', 'Técnico Productiva', '9', 'Educació', 'ETP', 'Tarde-Noche', '0', '', '0', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '87');
INSERT INTO `modularie` VALUES ('440', '1223221', '163 NESTOR ESCUDERO OTERO', 'Técnico Productiva', '9', 'Educació', 'ETP', 'Noche', '0', '', '0', '', '0', '0', '0', '0', '0000-00-00 00:00:00', '1', '2023-03-01 08:48:48', '122');
INSERT INTO `modularie` VALUES ('441', '1191808', 'FE Y ALEGRIA 32', 'Técnico Productiva', '9', 'Educació', 'ETP', 'Mañana-Noche', '0', '', '0', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '153');
INSERT INTO `modularie` VALUES ('442', '0901918', 'FE Y ALEGRIA 25', 'Técnico Productiva', '9', 'Educació', 'ETP', 'Mañana-Tarde', '0', '', '0', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '164');
INSERT INTO `modularie` VALUES ('443', '0901843', 'BAYOVAR', 'Técnico Productiva', '9', 'Educació', 'ETP', 'Mañana-Tarde', '0', '', '0', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '190');
INSERT INTO `modularie` VALUES ('444', '0901926', 'SAGRADA FAMILIA', 'Técnico Productiva', '9', 'Educació', 'ETP', 'Mañana-Noche', '0', '', '0', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '208');
INSERT INTO `modularie` VALUES ('445', '1072131', 'INDUSTRIAL SAN CARLOS', 'Técnico Productiva', '9', 'Educació', 'ETP', 'Mañana-Noche', '0', '', '0', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '209');
INSERT INTO `modularie` VALUES ('446', '0901884', 'JESUS OROPEZA CHONTA', 'Técnico Productiva', '9', 'Educació', 'ETP', 'Mañana-Tarde', '0', '', '0', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '218');
INSERT INTO `modularie` VALUES ('447', '0332767', 'EL AGUSTINO', 'Técnico Productiva', '9', 'Educació', 'ETP', 'Tarde-Noche', '0', '', '0', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '1', '2021-08-02 16:37:07', '242');
INSERT INTO `modularie` VALUES ('448', '1501832', 'BARBONES', 'Técnico Productiva', '9', 'Educació', 'ETP', 'Mañana', '0', '', '0', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '264');
INSERT INTO `modularie` VALUES ('449', '0901900', 'JOSE OLAYA', 'Técnico Productiva', '9', 'Educació', 'ETP', '', '0', '', '0', '', '0', '1', '0', '0', '0000-00-00 00:00:00', '0', '0000-00-00 00:00:00', '85');
INSERT INTO `modularie` VALUES ('451', '1762947', '0119 CANTO BELLO', 'Inicial', '1', null, 'EBR', 'Mañana', '0', '', '0', '', '0', '1', '0', '0', '2021-06-17 12:31:05', '1', '2021-06-17 14:47:00', '203');
INSERT INTO `modularie` VALUES ('453', '1789320', 'NICOLAS DE PIEROLA', 'Primaria', '2', null, 'EBR', 'Mañana', '2021', '', '', '', '0', '1', '0', '0', '2021-08-02 16:22:11', '1', '2021-08-03 11:59:46', '262');
INSERT INTO `modularie` VALUES ('457', '1772177', '134 RAMIRO PRIALE', 'Inicial', '1', null, 'EBR', 'Mañana', '2019', '', '', '', '0', '1', '0', '0', '2021-08-03 11:58:04', '1', '2021-08-03 11:59:00', '231');
INSERT INTO `modularie` VALUES ('458', '1769959', '0158 SANTA MARIA', 'Inicial', '1', null, 'EBR', 'Mañana', '2019', '', '', '', '0', '1', '0', '0', '2021-08-03 15:35:03', null, null, '103');
INSERT INTO `modularie` VALUES ('459', '1788264', 'CEBA - FE Y ALEGRIA 32', 'Básica Alternativa - Avanzado', '8', null, 'EBA', 'Noche', '2021', '', '', '', '0', '1', '0', '0', '2021-08-03 15:39:24', null, null, '153');
INSERT INTO `modularie` VALUES ('460', '1501212', 'PRITE HERMANO ANDRES', 'Básica Especial', '4', null, 'PRITE', null, '0', null, null, null, '0', '1', '0', '0', '2021-08-03 15:44:16', null, null, '266');
INSERT INTO `modularie` VALUES ('461', '1792746', 'CEBA - PILOTO MADRE TERESA DE CALCUTA', 'Básica Alternativa - Inicial e Intermedio', '7', null, 'EBA', 'Mañana-Tarde', '2021', '', '', '', '0', '1', '0', '0', '2022-01-11 09:28:48', null, null, '60');
INSERT INTO `modularie` VALUES ('462', '0466508', '0093 FBT', 'Primaria', '2', null, 'EBR', '', '0', '', '', '', '0', '0', '0', '0', '2022-04-27 12:56:05', '1', '2022-04-27 13:08:57', '267');
INSERT INTO `modularie` VALUES ('463', '1223221', '163  NESTOR ESCUDERO OTERO', 'Técnico Productiva', '9', null, 'ETP', null, '0', null, null, null, '0', '1', '0', '0', '2023-02-20 10:20:10', null, null, '268');

-- ----------------------------
-- Table structure for modulos
-- ----------------------------
DROP TABLE IF EXISTS `modulos`;
CREATE TABLE `modulos` (
  `mdl_id` int(11) NOT NULL AUTO_INCREMENT,
  `mdl_nombre` varchar(150) DEFAULT NULL,
  `mdl_ruta` varchar(150) DEFAULT NULL,
  `mdl_icono` varchar(150) DEFAULT NULL,
  `mdl_hijode` int(11) DEFAULT NULL,
  `mdl_orden` double DEFAULT NULL,
  `mdl_fechaRegistro` datetime DEFAULT NULL,
  `mdl_fechaModificacion` datetime DEFAULT NULL,
  `mdl_estado` int(1) DEFAULT NULL,
  `mdl_flag` int(1) DEFAULT NULL,
  PRIMARY KEY (`mdl_id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of modulos
-- ----------------------------
INSERT INTO `modulos` VALUES ('1', 'ADMINISTRAR', null, 'fas fa-tasks', '0', '1', null, null, '1', '0');
INSERT INTO `modulos` VALUES ('2', 'GRUPOS', 'administracion/tusuarios', 'far fa-object-group', '1', '1.2', null, null, '1', '0');
INSERT INTO `modulos` VALUES ('3', 'MODULOS', 'administracion/modulos', 'fas fa-th-large', '1', '1.3', null, null, '1', '0');
INSERT INTO `modulos` VALUES ('4', 'PERMISOS', 'administracion/permisos', 'fas fa-user-check', '1', '1.4', null, null, '1', '0');
INSERT INTO `modulos` VALUES ('5', 'USUARIOS', 'administracion/usuarios', 'fas fa-user', '1', '1.5', null, null, '1', '0');
INSERT INTO `modulos` VALUES ('6', 'CONFIGURACIÓN', '', '.', '0', '6', '2022-07-04 08:57:16', null, '1', '1');
INSERT INTO `modulos` VALUES ('7', 'PERIODOS', 'configuracion/periodos', '.', '6', '6.7', '2022-07-04 08:57:52', null, '1', '1');
INSERT INTO `modulos` VALUES ('8', 'PROCESOS', 'configuracion/procesos', '.', '6', '6.8', '2022-07-04 08:58:57', null, '1', '1');
INSERT INTO `modulos` VALUES ('9', 'GRUPO DE INSCRIPCIÓN', 'configuracion/grupoinscripcion', '.', '6', '6.9', '2022-07-14 15:00:04', '2022-07-18 17:23:08', '1', '1');
INSERT INTO `modulos` VALUES ('10', 'PRUEBA PUN', 'configuracion/pun', '.', '6', '6.1', '2022-07-14 15:01:50', null, '1', '1');
INSERT INTO `modulos` VALUES ('11', 'CONVOCATORIAS', '', '.', '0', '11', '2022-07-18 17:22:44', null, '1', '1');
INSERT INTO `modulos` VALUES ('12', 'REGISTRO CONVOCATORIA', 'convocatorias/listar', '.', '11', '11.12', '2022-07-18 17:24:52', null, '1', '1');
INSERT INTO `modulos` VALUES ('13', 'CARGAR EXPEDIENTES', 'convocatorias/cargarexpedientes', '.', '11', '11.13', '2022-07-20 01:31:54', null, '1', '1');
INSERT INTO `modulos` VALUES ('14', 'EVALUACIÓN', '', '.', '0', '14', '2022-07-25 22:33:16', null, '1', '1');
INSERT INTO `modulos` VALUES ('15', 'EVALUACIÓN DE POSTULANTES', 'evaluacion/convocatoria', '.', '14', '14.15', '2022-07-25 22:33:47', '2022-09-29 11:05:55', '1', '1');
INSERT INTO `modulos` VALUES ('17', 'PLAZAS', 'configuracion/plazas', '.', '6', '6.17', '2022-07-25 22:34:15', null, '1', '1');
INSERT INTO `modulos` VALUES ('18', 'ADJUDICACIÓN', '', '.', '0', '18', '2022-07-25 22:34:30', null, '1', '1');
INSERT INTO `modulos` VALUES ('19', 'ADJUDICACIÓN', '/', '.', '18', '18.19', '2022-07-25 22:34:39', null, '1', '1');
INSERT INTO `modulos` VALUES ('21', 'COLEGIOS', 'configuracion/colegios', '.', '6', '6.21', '2022-07-25 22:34:39', null, '1', '1');

-- ----------------------------
-- Table structure for niveles
-- ----------------------------
DROP TABLE IF EXISTS `niveles`;
CREATE TABLE `niveles` (
  `niv_id` int(11) NOT NULL AUTO_INCREMENT,
  `niv_descripcion` varchar(250) DEFAULT NULL,
  `niv_estado` int(1) DEFAULT NULL,
  `modalidad_mod_id` int(11) NOT NULL,
  PRIMARY KEY (`niv_id`),
  KEY `fk_niveles_modalidad1_idx` (`modalidad_mod_id`),
  CONSTRAINT `fk_niveles_modalidad1` FOREIGN KEY (`modalidad_mod_id`) REFERENCES `modalidades` (`mod_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of niveles
-- ----------------------------
INSERT INTO `niveles` VALUES ('1', 'Inicial', '1', '1');
INSERT INTO `niveles` VALUES ('2', 'Primaria', '1', '1');
INSERT INTO `niveles` VALUES ('3', 'Secundaria', '1', '1');
INSERT INTO `niveles` VALUES ('4', '(*)', '1', '6');

-- ----------------------------
-- Table structure for periodos
-- ----------------------------
DROP TABLE IF EXISTS `periodos`;
CREATE TABLE `periodos` (
  `per_id` int(11) NOT NULL,
  `per_anio` int(4) DEFAULT NULL,
  `per_nombre` varchar(500) DEFAULT NULL,
  `per_default` int(1) NOT NULL,
  `per_estado` int(1) DEFAULT NULL COMMENT '0: inactivo\n1: activo',
  PRIMARY KEY (`per_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of periodos
-- ----------------------------
INSERT INTO `periodos` VALUES ('1', '2022', 'Año del Fortalecimiento de la Soberanía Nacional', '1', '1');

-- ----------------------------
-- Table structure for periodo_fichas
-- ----------------------------
DROP TABLE IF EXISTS `periodo_fichas`;
CREATE TABLE `periodo_fichas` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) DEFAULT NULL,
  `plantilla` text,
  `tipo_id` int(11) unsigned DEFAULT '0',
  `periodo_id` int(11) unsigned DEFAULT '0',
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of periodo_fichas
-- ----------------------------
INSERT INTO `periodo_fichas` VALUES ('1', 'Anexo 13', '{\"sections\":[{\"id\":278487897935,\"name\":\"Formaci\\u00f3n Acad\\u00e9mica y Profesional\",\"position\":0,\"score\":\"38\",\"groups\":[{\"id\":510700731415,\"name\":\"Estudios de posgrado\",\"type_id\":1,\"position\":0,\"score\":\"38\",\"questions\":[{\"id\":669901504318,\"name\":\"Grado de Doctor. (m\\u00e1ximo 1)\",\"position\":0,\"score\":\"10\",\"options\":[]},{\"id\":471685961826,\"name\":\"Estudios concluidos de Doctorado\",\"position\":0,\"score\":\"7\",\"options\":[]},{\"id\":1386041234498,\"name\":\"Grado de Maestro\\/Magister. (m\\u00e1ximo 1)\",\"position\":0,\"score\":\"8\",\"options\":[]},{\"id\":461785294614,\"name\":\"Estudios concluidos de Maestr\\u00eda\",\"position\":0,\"score\":\"5\",\"options\":[]},{\"id\":299944151858,\"name\":\"Diplomado\\/Especializaci\\u00f3n, a nivel de Posgrado (hasta un m\\u00e1ximo de dos(2)\",\"position\":0,\"score\":\"3\",\"options\":[]}]},{\"id\":966180316910,\"name\":\"Estudios de pregrado\",\"type_id\":1,\"position\":0,\"score\":0,\"questions\":[{\"id\":210214086833,\"name\":\"Otro T\\u00edtulo Profesional Pedag\\u00f3gico o T\\u00edtulo de Segunda Especialidad en Educaci\\u00f3n, no af\\u00edn al nivel o ciclo de la especialidad que postula (m\\u00e1ximo 1)\",\"position\":0,\"score\":\"6\",\"options\":[]},{\"id\":929587823747,\"name\":\"Otro T\\u00edtulo Universitario no Pedag\\u00f3gico (m\\u00e1ximo 1)\",\"position\":0,\"score\":\"5\",\"options\":[]},{\"id\":1184435783500,\"name\":\"Otro T\\u00edtulo Profesional T\\u00e9cnico (m\\u00e1ximo 1)\",\"position\":0,\"score\":\"3\",\"options\":[]}]}]},{\"id\":641888213236,\"name\":\"Formaci\\u00f3n Continua\",\"position\":0,\"score\":\"3\",\"groups\":[{\"id\":359612152638,\"name\":\"Talleres, capacitaci\\u00f3n, seminarios o congresos\",\"type_id\":1,\"position\":0,\"score\":0,\"questions\":[{\"id\":1493827940389,\"name\":\"Realizado en los \\u00faltimos cinco (5) a\\u00f1os.\\nDuraci\\u00f3n m\\u00ednima de 16 horas pedag\\u00f3gicas.\\nPresenciales, virtuales o semipresenciales.\\nM\\u00e1ximo de tres (3)\",\"position\":0,\"score\":\"1\",\"options\":[]},{\"id\":1389722125327,\"name\":\"Tiene de 4 a m\\u00e1s a\\u00f1os adicionales al m\\u00ednimo requerido\",\"position\":0,\"score\":0,\"options\":[]}]}]},{\"id\":1570308861059,\"name\":\"Experiencia Laboral\",\"position\":0,\"score\":\"24\",\"groups\":[{\"id\":141790068280,\"name\":\"Experiencia Laboral docente,\\ndurante los meses de marzo a diciembre, teniendo en cuenta\",\"type_id\":1,\"position\":0,\"score\":0,\"questions\":[{\"id\":1384426154455,\"name\":\"Corresponde 0.20 puntos por cada mes acreditado de labor en IE ubicada en zona urbana. Corresponde 0.30 puntos por cada mes acreditado de labor en IE ubicada en zona de frontera. Corresponde 0.30 puntos por cada mes acreditado de labor en IE ubicada en zona rural. Corresponde 0.40 puntos por cada mes acreditado de labor en IE ubicada en zona VRAEM.\",\"position\":0,\"score\":\"20\",\"options\":[]},{\"id\":1040688223918,\"name\":\"Tiene de 4 a m\\u00e1s a\\u00f1os adicionales al m\\u00ednimo requerido\",\"position\":0,\"score\":0,\"options\":[]}]},{\"id\":1590150668232,\"name\":\"Experiencia laboral como PEC\",\"type_id\":1,\"position\":0,\"score\":0,\"questions\":[{\"id\":1300044711716,\"name\":\"Corresponde 0.10 puntos por cada mes acreditado (solo para postular al\\nnivel inicial).\",\"position\":0,\"score\":\"4\",\"options\":[]},{\"id\":861982020443,\"name\":\"Tiene de 4 a m\\u00e1s a\\u00f1os adicionales al m\\u00ednimo requerido\",\"position\":0,\"score\":0,\"options\":[]}]}]},{\"id\":107797951453,\"name\":\"M\\u00e9ritos\",\"position\":0,\"score\":\"5\",\"groups\":[{\"id\":1610513886669,\"name\":\"Felicitaci\\u00f3n por desempe\\u00f1o o trabajo destacado en el campo pedag\\u00f3gico\",\"type_id\":\"2\",\"position\":0,\"score\":\"5\",\"questions\":[{\"id\":891404070946,\"name\":\"Resoluci\\u00f3n Ministerial emitida por MINEDU (3 puntos). Resoluci\\u00f3n emitida por la DRE o de UGEL (2 puntos)\",\"position\":0,\"score\":\"5\",\"options\":[{\"id\":1390888961065,\"name\":\"CUMPLE\",\"position\":0},{\"id\":731080771893,\"name\":\"NO CUMPLE\",\"position\":0}]},{\"id\":1194430752118,\"name\":\"Cumple con el tercer Cursos y\\/o Estudios de Especializaci\\u00f3n\",\"position\":0,\"score\":0,\"options\":[{\"id\":1302903470264,\"name\":\"CUMPLE\",\"position\":0},{\"id\":480164883418,\"name\":\"NO CUMPLE\",\"position\":0}]}]}]}]}', '0', '1', '2023-10-31 04:17:49', '2023-10-31 07:17:44', null);
INSERT INTO `periodo_fichas` VALUES ('2', 'Anexo 14', '{\"sections\":[{\"id\":1209307724712,\"name\":\"FORMACI0N ACADEMICA\",\"position\":0,\"score\":\"52\",\"groups\":[{\"id\":564889126834,\"name\":\"1.1 Estudios de pregrado\",\"position\":0,\"score\":\"3\",\"questions\":[{\"id\":1362724145467,\"name\":\"T\\u00edtulo profesional\",\"position\":0,\"score\":\"7\",\"answers\":[]},{\"id\":1092942509780,\"name\":\"T\\u00edtulo profesional t\\u00e9cnico\",\"position\":0,\"score\":\"6\",\"answers\":[]},{\"id\":1192888700698,\"name\":\"T\\u00edtulo t\\u00e9cnico\",\"position\":0,\"score\":\"5\",\"answers\":[]}]},{\"id\":729231710471,\"name\":\"1.2 Estudios de posgrado\",\"position\":0,\"score\":0,\"questions\":[{\"id\":997400661726,\"name\":\"Grado de doctor\",\"position\":0,\"score\":\"3\",\"answers\":[]},{\"id\":1470842958033,\"name\":\"Estudios de doctorado\",\"position\":0,\"score\":\"2\",\"answers\":[]},{\"id\":1350515465517,\"name\":\"Grado de maestro\\/mag\\u00edster\",\"position\":0,\"score\":\"2\",\"answers\":[]},{\"id\":42703057291,\"name\":\"Estudios concluidos de maestr\\u00eda\",\"position\":0,\"score\":\"1\",\"answers\":[]}]},{\"id\":585788727369,\"name\":\"1.3 Capacitaci\\u00f3n y actualizaci\\u00f3n en la especialidad\",\"position\":0,\"score\":0,\"questions\":[{\"id\":743906276429,\"name\":\"Programas afines a la especialidad con duraci\\u00f3n mayor a 96 horas o su equivalente en cr\\u00e9ditos. Dos (2) puntos por cada 96 horas acumuladas en los \\u00faltimos 5 a\\u00f1os, hasta 12 puntos.\",\"position\":0,\"score\":\"12\",\"answers\":[]},{\"id\":1461227966461,\"name\":\"Programas afines a la especialidad con duraci\\u00f3n\\nigual o mayor a 16 horas y hasta 96 horas o su\\nequivalente en cr\\u00e9ditos. Un (1) punto por cada 16 horas acumuladas en los\\n\\u00faltimos 5 a\\u00f1os, hasta 8 puntos.\",\"position\":0,\"score\":\"8\",\"answers\":[]}]},{\"id\":97700825143,\"name\":\"1.4 Otros programas de formaci\\u00f3n continua, incluyendo temas de pedagog\\u00eda\",\"position\":0,\"score\":0,\"questions\":[{\"id\":175989034156,\"name\":\"Programas con duraci\\u00f3n mayor a 96 horas o su\\nequivalente en cr\\u00e9ditos Dos (2) puntos por cada 96 horas acumuladas en los\\n\\u00faltimos 5 a\\u00f1os, hasta 6 puntos\",\"position\":0,\"score\":\"6\",\"answers\":[]},{\"id\":1542708142724,\"name\":\"Programas con duraci\\u00f3n igual o mayor a 16 horas y\\nhasta 96 horas o su equivalente en cr\\u00e9ditos. Un (1) punto por cada 16 horas acumuladas en los\\n\\u00faltimos 5 a\\u00f1os, hasta 4 puntos\",\"position\":0,\"score\":\"4\",\"answers\":[]},{\"id\":409491722610,\"name\":\"Cursos de Ofim\\u00e1tica igual o mayores a 24 horas o\\nsu equivalente en cr\\u00e9ditos. 1 punto por cada 24 horas acumuladas en los \\u00faltimos 5\\na\\u00f1os, hasta 4 puntos\",\"position\":0,\"score\":\"4\",\"answers\":[]},{\"id\":184167895204,\"name\":\"Certificaci\\u00f3n de dominio del idioma ingl\\u00e9s. Nivel Avanzado\",\"position\":0,\"score\":\"4\",\"answers\":[]},{\"id\":491086770935,\"name\":\"Lenguas Originarias. Incorporados en el RNDBLO\",\"position\":0,\"score\":\"4\",\"answers\":[]}]}]},{\"id\":107168914640,\"name\":\"2. EXPERIENCIA LABORAL\",\"position\":0,\"score\":\"40\",\"groups\":[{\"id\":1064372763231,\"name\":\"2.1 Experiencia laboral en el sector productivo (IIEE o privadas)  \",\"position\":0,\"score\":0,\"questions\":[{\"id\":1502895473448,\"name\":\"Tres (3) puntos por cada a\\u00f1o de experiencia profesional\\nno docente en el sector productivo de la especialidad en\\nlos \\u00faltimos 10 a\\u00f1os.\",\"position\":0,\"score\":\"30\",\"answers\":[]}]},{\"id\":73426368134,\"name\":\"2.2 Experiencia docente en Educaci\\u00f3n Superior o\\nT\\u00e9cnico \\u2013 productiva\",\"position\":0,\"score\":0,\"questions\":[{\"id\":716200461622,\"name\":\"Un (1) punto por a\\u00f1o de experiencia docente dentro de\\nlos \\u00faltimos 10 a\\u00f1os.\",\"position\":0,\"score\":\"10\",\"answers\":[]}]}]},{\"id\":790085968000,\"name\":\"3. M\\u00c9RITOS\",\"position\":0,\"score\":\"8\",\"groups\":[{\"id\":1264032213169,\"name\":\"Reconocimiento o felicitaci\\u00f3n por logro o\\ncontribuci\\u00f3n en la gesti\\u00f3n o pr\\u00e1ctica pedag\\u00f3gica o\\nproyecto de innovaci\\u00f3n o investigaci\\u00f3n.\",\"position\":0,\"score\":0,\"questions\":[{\"id\":1181679959004,\"name\":\"Dos (2) puntos por cada reconocimiento, hasta 8 puntos\",\"position\":0,\"score\":\"8\",\"answers\":[]}]}]}]}', '0', '1', '2023-10-31 04:17:58', '2023-10-31 06:42:08', null);

-- ----------------------------
-- Table structure for permisos
-- ----------------------------
DROP TABLE IF EXISTS `permisos`;
CREATE TABLE `permisos` (
  `modulos_mdl_id` int(11) NOT NULL,
  `tipo_usuarios_tus_id` int(11) NOT NULL,
  `per_fechaRegistro` datetime DEFAULT NULL,
  `per_fechaModificacion` datetime DEFAULT NULL,
  `per_estado` int(1) DEFAULT NULL,
  `per_flag` int(1) DEFAULT NULL,
  KEY `fk_permisos_modulos1_idx` (`modulos_mdl_id`),
  KEY `fk_permisos_tipo_usuarios1_idx` (`tipo_usuarios_tus_id`),
  CONSTRAINT `fk_permisos_modulos1` FOREIGN KEY (`modulos_mdl_id`) REFERENCES `modulos` (`mdl_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_permisos_tipo_usuarios1` FOREIGN KEY (`tipo_usuarios_tus_id`) REFERENCES `tipo_usuarios` (`tus_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of permisos
-- ----------------------------
INSERT INTO `permisos` VALUES ('1', '1', null, null, '1', '0');
INSERT INTO `permisos` VALUES ('2', '1', null, null, '1', '0');
INSERT INTO `permisos` VALUES ('3', '1', null, null, '1', '0');
INSERT INTO `permisos` VALUES ('4', '1', null, null, '1', '0');
INSERT INTO `permisos` VALUES ('5', '1', null, null, '1', '0');
INSERT INTO `permisos` VALUES ('6', '2', '2022-07-04 08:57:16', '2022-07-04 08:59:12', '1', '1');
INSERT INTO `permisos` VALUES ('7', '2', '2022-07-04 08:57:52', '2022-07-04 08:59:12', '1', '1');
INSERT INTO `permisos` VALUES ('8', '2', '2022-07-04 08:58:57', '2022-07-04 08:59:13', '1', '1');
INSERT INTO `permisos` VALUES ('9', '2', '2022-07-14 15:00:04', '2022-07-14 15:01:59', '1', '1');
INSERT INTO `permisos` VALUES ('10', '2', '2022-07-14 15:01:50', '2022-07-14 15:01:57', '1', '1');
INSERT INTO `permisos` VALUES ('11', '2', '2022-07-18 17:22:44', '2022-07-18 17:25:21', '1', '1');
INSERT INTO `permisos` VALUES ('12', '2', '2022-07-18 17:24:52', '2022-07-18 17:25:22', '1', '1');
INSERT INTO `permisos` VALUES ('13', '2', '2022-07-20 01:31:54', '2022-07-20 01:32:02', '1', '1');
INSERT INTO `permisos` VALUES ('14', '2', '2022-07-25 22:33:16', '2022-07-25 22:34:46', '1', '1');
INSERT INTO `permisos` VALUES ('15', '2', '2022-07-25 22:33:47', '2022-07-25 22:34:46', '1', '1');
INSERT INTO `permisos` VALUES ('17', '2', '2022-07-25 22:34:15', '2022-07-25 22:34:48', '1', '1');
INSERT INTO `permisos` VALUES ('18', '2', '2022-07-25 22:34:30', '2022-07-25 22:34:49', '1', '1');
INSERT INTO `permisos` VALUES ('19', '2', '2022-07-25 22:34:39', '2022-07-25 22:34:50', '1', '1');
INSERT INTO `permisos` VALUES ('6', '3', '2022-10-03 11:08:57', null, '0', '1');
INSERT INTO `permisos` VALUES ('10', '2', '2022-10-03 11:08:57', null, '0', '1');
INSERT INTO `permisos` VALUES ('7', '3', '2022-10-03 11:08:57', null, '0', '1');
INSERT INTO `permisos` VALUES ('8', '3', '2022-10-03 11:08:57', null, '0', '1');
INSERT INTO `permisos` VALUES ('9', '3', '2022-10-03 11:08:57', null, '0', '1');
INSERT INTO `permisos` VALUES ('11', '3', '2022-10-03 11:08:57', null, '0', '1');
INSERT INTO `permisos` VALUES ('12', '3', '2022-10-03 11:08:57', null, '0', '1');
INSERT INTO `permisos` VALUES ('13', '3', '2022-10-03 11:08:57', null, '0', '1');
INSERT INTO `permisos` VALUES ('14', '3', '2022-10-03 11:08:57', '2022-10-03 11:11:30', '1', '1');
INSERT INTO `permisos` VALUES ('15', '3', '2022-10-03 11:08:57', '2022-10-03 11:11:32', '1', '1');
INSERT INTO `permisos` VALUES ('17', '3', '2022-10-03 11:08:57', null, '0', '1');
INSERT INTO `permisos` VALUES ('18', '3', '2022-10-03 11:08:57', null, '0', '1');
INSERT INTO `permisos` VALUES ('21', '2', '2022-10-03 11:08:57', null, '1', '1');
INSERT INTO `permisos` VALUES ('19', '2', '2022-10-03 11:08:57', null, '1', '1');

-- ----------------------------
-- Table structure for plazas
-- ----------------------------
DROP TABLE IF EXISTS `plazas`;
CREATE TABLE `plazas` (
  `plz_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `codigoPlaza` varchar(40) DEFAULT NULL,
  `codigoModular` varchar(8) DEFAULT NULL,
  `ie` varchar(150) DEFAULT NULL,
  `mod_id` int(11) DEFAULT NULL,
  `especialidad` text,
  `cargo` varchar(40) DEFAULT NULL,
  `caracteristica` varchar(50) DEFAULT NULL,
  `tipo` varchar(50) DEFAULT NULL,
  `jornada` tinyint(3) DEFAULT NULL,
  `tipo_vacante` varchar(200) DEFAULT NULL,
  `motivo_vacante` varchar(8000) DEFAULT NULL,
  `observacion` text,
  `fecha_reg` datetime DEFAULT NULL,
  `tipo_id` int(11) DEFAULT NULL,
  `registrado_por` varchar(20) DEFAULT NULL,
  `fecha` year(4) DEFAULT NULL,
  `estado` tinyint(1) DEFAULT NULL,
  `modificado_por` varchar(20) DEFAULT NULL,
  `fecha_mod` datetime DEFAULT NULL,
  `fecha_publicacion` datetime DEFAULT NULL,
  PRIMARY KEY (`plz_id`),
  KEY `modalidades` (`mod_id`) USING BTREE,
  KEY `tipo_convocatoria` (`tipo_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of plazas
-- ----------------------------
INSERT INTO `plazas` VALUES ('1', '213123123', '123123', 'asd', '1', 'asdsad', 'asdsa', 'dsadas', 'dsadsa', '23', 'sadasdsad', 'asd', 'sad', '2023-11-14 13:09:47', '1', 'sasad', '0000', '1', 'asdsad', '2023-11-21 13:09:58', '2023-11-29 13:10:01');

-- ----------------------------
-- Table structure for postulaciones
-- ----------------------------
DROP TABLE IF EXISTS `postulaciones`;
CREATE TABLE `postulaciones` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) DEFAULT NULL,
  `apellido_paterno` varchar(255) DEFAULT NULL,
  `apellido_materno` varchar(255) DEFAULT NULL,
  `numero_documento` varchar(255) DEFAULT NULL,
  `tipo_documento` int(11) DEFAULT NULL,
  `genero` varchar(255) DEFAULT NULL,
  `estado_civil` varchar(255) DEFAULT NULL,
  `nacionalidad` varchar(255) DEFAULT NULL,
  `fecha_nacimiento` date DEFAULT NULL,
  `correo` varchar(255) DEFAULT NULL,
  `numero_celular` varchar(255) DEFAULT NULL,
  `numero_telefono` varchar(255) DEFAULT NULL,
  `via` varchar(255) DEFAULT NULL,
  `nombre_via` varchar(255) DEFAULT NULL,
  `zona` varchar(255) DEFAULT NULL,
  `direccion` varchar(255) DEFAULT NULL,
  `fecha_registro` datetime DEFAULT NULL,
  `uid` varchar(255) DEFAULT NULL,
  `distrito_id` int(11) DEFAULT NULL,
  `convocatoria_id` int(11) unsigned NOT NULL,
  `inscripcion_id` int(11) unsigned NOT NULL DEFAULT '0',
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of postulaciones
-- ----------------------------
INSERT INTO `postulaciones` VALUES ('1', 'GUILMAR ASUNCION', 'ESCOBAR', 'CONDEÑA', '06767000', '1', 'M', 'casado', 'Peruana', '2005-11-16', 'andrescarrion199603@gmail.com', '922403829', '922403', 'aa3213', 'aa21321', 'aaa', 'asdasdad', '2023-11-21 17:11:07', '655d2afb1502b1', '150117', '15', '1', '2023-11-21 17:11:07', '2023-11-21 17:11:07', null);

-- ----------------------------
-- Table structure for postulacion_archivos
-- ----------------------------
DROP TABLE IF EXISTS `postulacion_archivos`;
CREATE TABLE `postulacion_archivos` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) DEFAULT NULL,
  `url` text,
  `formato` varchar(255) DEFAULT NULL,
  `peso` int(11) unsigned DEFAULT '0',
  `tipo_id` int(11) unsigned DEFAULT '0',
  `postulacion_id` int(11) unsigned DEFAULT '0',
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of postulacion_archivos
-- ----------------------------
INSERT INTO `postulacion_archivos` VALUES ('1', 'INFORME-2DO-PRODUCTO-DANILO-CARRION-LAVA.pdf', '/uploads/1700604667655d2afb14b8e-INFORME-2DO-PRODUCTO-DANILO-CARRION-LAVA.pdf', 'pdf', '646393', '1', '1', '2023-11-21 17:11:07', '2023-11-21 17:11:07', null);

-- ----------------------------
-- Table structure for postulacion_especializaciones
-- ----------------------------
DROP TABLE IF EXISTS `postulacion_especializaciones`;
CREATE TABLE `postulacion_especializaciones` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `tipo_especializacion` varchar(255) DEFAULT NULL,
  `tema_especializacion` varchar(255) DEFAULT NULL,
  `nombre_entidad` varchar(255) DEFAULT NULL,
  `fecha_inicio` date DEFAULT NULL,
  `fecha_termino` date DEFAULT NULL,
  `numero_horas` int(11) DEFAULT '0',
  `postulacion_id` int(11) unsigned NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of postulacion_especializaciones
-- ----------------------------
INSERT INTO `postulacion_especializaciones` VALUES ('1', 'Pública', '321321', '3213213', '2023-11-14', '2023-11-29', '22', '1', '2023-11-21 17:11:07', '2023-11-21 17:11:07', null);

-- ----------------------------
-- Table structure for postulacion_experiencias_laborales
-- ----------------------------
DROP TABLE IF EXISTS `postulacion_experiencias_laborales`;
CREATE TABLE `postulacion_experiencias_laborales` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `institucion_educativa` varchar(255) DEFAULT NULL,
  `sector` varchar(255) DEFAULT NULL,
  `puesto` varchar(255) DEFAULT NULL,
  `numero_rd` varchar(255) DEFAULT NULL,
  `numero_contrato` varchar(255) DEFAULT NULL,
  `postulacion_id` int(11) unsigned NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of postulacion_experiencias_laborales
-- ----------------------------
INSERT INTO `postulacion_experiencias_laborales` VALUES ('1', '21321321', 'Pública', 'Docente', '213213', '2132132', '1', '2023-11-21 17:11:07', '2023-11-21 17:11:07', null);

-- ----------------------------
-- Table structure for postulacion_formaciones_academicas
-- ----------------------------
DROP TABLE IF EXISTS `postulacion_formaciones_academicas`;
CREATE TABLE `postulacion_formaciones_academicas` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `nivel_educativo` varchar(255) DEFAULT NULL,
  `grado_academico` varchar(255) DEFAULT NULL,
  `universidad` varchar(255) DEFAULT NULL,
  `carrera_profesional` varchar(255) DEFAULT NULL,
  `registro_titulo` varchar(255) DEFAULT NULL,
  `rd_titulo` varchar(255) DEFAULT NULL,
  `obtencion_grado` varchar(255) DEFAULT NULL,
  `postulacion_id` int(11) unsigned NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of postulacion_formaciones_academicas
-- ----------------------------
INSERT INTO `postulacion_formaciones_academicas` VALUES ('1', 'Técnico superior', 'Estudiante', 'UPN', 'Ingenieria ambiental', '213', '2132132', '13213213', '1', '2023-11-21 17:11:07', '2023-11-21 17:11:07', null);

-- ----------------------------
-- Table structure for procesos
-- ----------------------------
DROP TABLE IF EXISTS `procesos`;
CREATE TABLE `procesos` (
  `pro_id` int(11) NOT NULL AUTO_INCREMENT,
  `pro_descripcion` varchar(500) DEFAULT NULL,
  `pro_default` int(1) NOT NULL,
  `pro_estado` int(1) DEFAULT NULL COMMENT '0: inactivo\n1: activo',
  PRIMARY KEY (`pro_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of procesos
-- ----------------------------
INSERT INTO `procesos` VALUES ('1', 'Contrato Docente', '1', '1');
INSERT INTO `procesos` VALUES ('2', 'Contrato Auxiliar de Educación', '0', '0');

-- ----------------------------
-- Table structure for tipo_convocatoria
-- ----------------------------
DROP TABLE IF EXISTS `tipo_convocatoria`;
CREATE TABLE `tipo_convocatoria` (
  `tipo_id` int(11) DEFAULT NULL,
  `descripcion` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` datetime DEFAULT NULL,
  KEY `tipo_id` (`tipo_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tipo_convocatoria
-- ----------------------------
INSERT INTO `tipo_convocatoria` VALUES ('1', 'PUN', '2023-11-21 14:22:54', '2023-11-21 14:22:54', null);
INSERT INTO `tipo_convocatoria` VALUES ('2', 'EVALUACIÓN DE EXPEDIENTE', '2023-11-21 14:22:54', '2023-11-21 14:22:54', null);

-- ----------------------------
-- Table structure for tipo_usuarios
-- ----------------------------
DROP TABLE IF EXISTS `tipo_usuarios`;
CREATE TABLE `tipo_usuarios` (
  `tus_id` int(11) NOT NULL AUTO_INCREMENT,
  `tus_usuariodescrip` varchar(225) DEFAULT NULL,
  `tus_fechaRegistro` datetime DEFAULT NULL,
  `tus_fechaModificacion` datetime DEFAULT NULL,
  `tus_estado` int(1) DEFAULT NULL,
  `tus_flag` int(1) DEFAULT NULL,
  PRIMARY KEY (`tus_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tipo_usuarios
-- ----------------------------
INSERT INTO `tipo_usuarios` VALUES ('1', 'ADMINISTRADOR', null, null, '1', '0');
INSERT INTO `tipo_usuarios` VALUES ('2', 'ESPECIALISTA ADMINISTRADOR', '2022-07-04 08:55:35', null, '1', '1');
INSERT INTO `tipo_usuarios` VALUES ('3', 'ESPECIALISTA EVALUADOR', '2022-10-03 11:08:57', null, '1', '1');

-- ----------------------------
-- Table structure for ubigeo_peru_departments
-- ----------------------------
DROP TABLE IF EXISTS `ubigeo_peru_departments`;
CREATE TABLE `ubigeo_peru_departments` (
  `id` varchar(2) NOT NULL,
  `name` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ubigeo_peru_departments
-- ----------------------------
INSERT INTO `ubigeo_peru_departments` VALUES ('01', 'Amazonas');
INSERT INTO `ubigeo_peru_departments` VALUES ('02', 'Áncash');
INSERT INTO `ubigeo_peru_departments` VALUES ('03', 'Apurímac');
INSERT INTO `ubigeo_peru_departments` VALUES ('04', 'Arequipa');
INSERT INTO `ubigeo_peru_departments` VALUES ('05', 'Ayacucho');
INSERT INTO `ubigeo_peru_departments` VALUES ('06', 'Cajamarca');
INSERT INTO `ubigeo_peru_departments` VALUES ('07', 'Callao');
INSERT INTO `ubigeo_peru_departments` VALUES ('08', 'Cusco');
INSERT INTO `ubigeo_peru_departments` VALUES ('09', 'Huancavelica');
INSERT INTO `ubigeo_peru_departments` VALUES ('10', 'Huánuco');
INSERT INTO `ubigeo_peru_departments` VALUES ('11', 'Ica');
INSERT INTO `ubigeo_peru_departments` VALUES ('12', 'Junín');
INSERT INTO `ubigeo_peru_departments` VALUES ('13', 'La Libertad');
INSERT INTO `ubigeo_peru_departments` VALUES ('14', 'Lambayeque');
INSERT INTO `ubigeo_peru_departments` VALUES ('15', 'Lima');
INSERT INTO `ubigeo_peru_departments` VALUES ('16', 'Loreto');
INSERT INTO `ubigeo_peru_departments` VALUES ('17', 'Madre de Dios');
INSERT INTO `ubigeo_peru_departments` VALUES ('18', 'Moquegua');
INSERT INTO `ubigeo_peru_departments` VALUES ('19', 'Pasco');
INSERT INTO `ubigeo_peru_departments` VALUES ('20', 'Piura');
INSERT INTO `ubigeo_peru_departments` VALUES ('21', 'Puno');
INSERT INTO `ubigeo_peru_departments` VALUES ('22', 'San Martín');
INSERT INTO `ubigeo_peru_departments` VALUES ('23', 'Tacna');
INSERT INTO `ubigeo_peru_departments` VALUES ('24', 'Tumbes');
INSERT INTO `ubigeo_peru_departments` VALUES ('25', 'Ucayali');

-- ----------------------------
-- Table structure for ubigeo_peru_districts
-- ----------------------------
DROP TABLE IF EXISTS `ubigeo_peru_districts`;
CREATE TABLE `ubigeo_peru_districts` (
  `id` varchar(6) NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  `province_id` varchar(4) DEFAULT NULL,
  `department_id` varchar(2) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ubigeo_peru_districts
-- ----------------------------
INSERT INTO `ubigeo_peru_districts` VALUES ('010101', 'Chachapoyas', '0101', '01');
INSERT INTO `ubigeo_peru_districts` VALUES ('010102', 'Asunción', '0101', '01');
INSERT INTO `ubigeo_peru_districts` VALUES ('010103', 'Balsas', '0101', '01');
INSERT INTO `ubigeo_peru_districts` VALUES ('010104', 'Cheto', '0101', '01');
INSERT INTO `ubigeo_peru_districts` VALUES ('010105', 'Chiliquin', '0101', '01');
INSERT INTO `ubigeo_peru_districts` VALUES ('010106', 'Chuquibamba', '0101', '01');
INSERT INTO `ubigeo_peru_districts` VALUES ('010107', 'Granada', '0101', '01');
INSERT INTO `ubigeo_peru_districts` VALUES ('010108', 'Huancas', '0101', '01');
INSERT INTO `ubigeo_peru_districts` VALUES ('010109', 'La Jalca', '0101', '01');
INSERT INTO `ubigeo_peru_districts` VALUES ('010110', 'Leimebamba', '0101', '01');
INSERT INTO `ubigeo_peru_districts` VALUES ('010111', 'Levanto', '0101', '01');
INSERT INTO `ubigeo_peru_districts` VALUES ('010112', 'Magdalena', '0101', '01');
INSERT INTO `ubigeo_peru_districts` VALUES ('010113', 'Mariscal Castilla', '0101', '01');
INSERT INTO `ubigeo_peru_districts` VALUES ('010114', 'Molinopampa', '0101', '01');
INSERT INTO `ubigeo_peru_districts` VALUES ('010115', 'Montevideo', '0101', '01');
INSERT INTO `ubigeo_peru_districts` VALUES ('010116', 'Olleros', '0101', '01');
INSERT INTO `ubigeo_peru_districts` VALUES ('010117', 'Quinjalca', '0101', '01');
INSERT INTO `ubigeo_peru_districts` VALUES ('010118', 'San Francisco de Daguas', '0101', '01');
INSERT INTO `ubigeo_peru_districts` VALUES ('010119', 'San Isidro de Maino', '0101', '01');
INSERT INTO `ubigeo_peru_districts` VALUES ('010120', 'Soloco', '0101', '01');
INSERT INTO `ubigeo_peru_districts` VALUES ('010121', 'Sonche', '0101', '01');
INSERT INTO `ubigeo_peru_districts` VALUES ('010201', 'Bagua', '0102', '01');
INSERT INTO `ubigeo_peru_districts` VALUES ('010202', 'Aramango', '0102', '01');
INSERT INTO `ubigeo_peru_districts` VALUES ('010203', 'Copallin', '0102', '01');
INSERT INTO `ubigeo_peru_districts` VALUES ('010204', 'El Parco', '0102', '01');
INSERT INTO `ubigeo_peru_districts` VALUES ('010205', 'Imaza', '0102', '01');
INSERT INTO `ubigeo_peru_districts` VALUES ('010206', 'La Peca', '0102', '01');
INSERT INTO `ubigeo_peru_districts` VALUES ('010301', 'Jumbilla', '0103', '01');
INSERT INTO `ubigeo_peru_districts` VALUES ('010302', 'Chisquilla', '0103', '01');
INSERT INTO `ubigeo_peru_districts` VALUES ('010303', 'Churuja', '0103', '01');
INSERT INTO `ubigeo_peru_districts` VALUES ('010304', 'Corosha', '0103', '01');
INSERT INTO `ubigeo_peru_districts` VALUES ('010305', 'Cuispes', '0103', '01');
INSERT INTO `ubigeo_peru_districts` VALUES ('010306', 'Florida', '0103', '01');
INSERT INTO `ubigeo_peru_districts` VALUES ('010307', 'Jazan', '0103', '01');
INSERT INTO `ubigeo_peru_districts` VALUES ('010308', 'Recta', '0103', '01');
INSERT INTO `ubigeo_peru_districts` VALUES ('010309', 'San Carlos', '0103', '01');
INSERT INTO `ubigeo_peru_districts` VALUES ('010310', 'Shipasbamba', '0103', '01');
INSERT INTO `ubigeo_peru_districts` VALUES ('010311', 'Valera', '0103', '01');
INSERT INTO `ubigeo_peru_districts` VALUES ('010312', 'Yambrasbamba', '0103', '01');
INSERT INTO `ubigeo_peru_districts` VALUES ('010401', 'Nieva', '0104', '01');
INSERT INTO `ubigeo_peru_districts` VALUES ('010402', 'El Cenepa', '0104', '01');
INSERT INTO `ubigeo_peru_districts` VALUES ('010403', 'Río Santiago', '0104', '01');
INSERT INTO `ubigeo_peru_districts` VALUES ('010501', 'Lamud', '0105', '01');
INSERT INTO `ubigeo_peru_districts` VALUES ('010502', 'Camporredondo', '0105', '01');
INSERT INTO `ubigeo_peru_districts` VALUES ('010503', 'Cocabamba', '0105', '01');
INSERT INTO `ubigeo_peru_districts` VALUES ('010504', 'Colcamar', '0105', '01');
INSERT INTO `ubigeo_peru_districts` VALUES ('010505', 'Conila', '0105', '01');
INSERT INTO `ubigeo_peru_districts` VALUES ('010506', 'Inguilpata', '0105', '01');
INSERT INTO `ubigeo_peru_districts` VALUES ('010507', 'Longuita', '0105', '01');
INSERT INTO `ubigeo_peru_districts` VALUES ('010508', 'Lonya Chico', '0105', '01');
INSERT INTO `ubigeo_peru_districts` VALUES ('010509', 'Luya', '0105', '01');
INSERT INTO `ubigeo_peru_districts` VALUES ('010510', 'Luya Viejo', '0105', '01');
INSERT INTO `ubigeo_peru_districts` VALUES ('010511', 'María', '0105', '01');
INSERT INTO `ubigeo_peru_districts` VALUES ('010512', 'Ocalli', '0105', '01');
INSERT INTO `ubigeo_peru_districts` VALUES ('010513', 'Ocumal', '0105', '01');
INSERT INTO `ubigeo_peru_districts` VALUES ('010514', 'Pisuquia', '0105', '01');
INSERT INTO `ubigeo_peru_districts` VALUES ('010515', 'Providencia', '0105', '01');
INSERT INTO `ubigeo_peru_districts` VALUES ('010516', 'San Cristóbal', '0105', '01');
INSERT INTO `ubigeo_peru_districts` VALUES ('010517', 'San Francisco de Yeso', '0105', '01');
INSERT INTO `ubigeo_peru_districts` VALUES ('010518', 'San Jerónimo', '0105', '01');
INSERT INTO `ubigeo_peru_districts` VALUES ('010519', 'San Juan de Lopecancha', '0105', '01');
INSERT INTO `ubigeo_peru_districts` VALUES ('010520', 'Santa Catalina', '0105', '01');
INSERT INTO `ubigeo_peru_districts` VALUES ('010521', 'Santo Tomas', '0105', '01');
INSERT INTO `ubigeo_peru_districts` VALUES ('010522', 'Tingo', '0105', '01');
INSERT INTO `ubigeo_peru_districts` VALUES ('010523', 'Trita', '0105', '01');
INSERT INTO `ubigeo_peru_districts` VALUES ('010601', 'San Nicolás', '0106', '01');
INSERT INTO `ubigeo_peru_districts` VALUES ('010602', 'Chirimoto', '0106', '01');
INSERT INTO `ubigeo_peru_districts` VALUES ('010603', 'Cochamal', '0106', '01');
INSERT INTO `ubigeo_peru_districts` VALUES ('010604', 'Huambo', '0106', '01');
INSERT INTO `ubigeo_peru_districts` VALUES ('010605', 'Limabamba', '0106', '01');
INSERT INTO `ubigeo_peru_districts` VALUES ('010606', 'Longar', '0106', '01');
INSERT INTO `ubigeo_peru_districts` VALUES ('010607', 'Mariscal Benavides', '0106', '01');
INSERT INTO `ubigeo_peru_districts` VALUES ('010608', 'Milpuc', '0106', '01');
INSERT INTO `ubigeo_peru_districts` VALUES ('010609', 'Omia', '0106', '01');
INSERT INTO `ubigeo_peru_districts` VALUES ('010610', 'Santa Rosa', '0106', '01');
INSERT INTO `ubigeo_peru_districts` VALUES ('010611', 'Totora', '0106', '01');
INSERT INTO `ubigeo_peru_districts` VALUES ('010612', 'Vista Alegre', '0106', '01');
INSERT INTO `ubigeo_peru_districts` VALUES ('010701', 'Bagua Grande', '0107', '01');
INSERT INTO `ubigeo_peru_districts` VALUES ('010702', 'Cajaruro', '0107', '01');
INSERT INTO `ubigeo_peru_districts` VALUES ('010703', 'Cumba', '0107', '01');
INSERT INTO `ubigeo_peru_districts` VALUES ('010704', 'El Milagro', '0107', '01');
INSERT INTO `ubigeo_peru_districts` VALUES ('010705', 'Jamalca', '0107', '01');
INSERT INTO `ubigeo_peru_districts` VALUES ('010706', 'Lonya Grande', '0107', '01');
INSERT INTO `ubigeo_peru_districts` VALUES ('010707', 'Yamon', '0107', '01');
INSERT INTO `ubigeo_peru_districts` VALUES ('020101', 'Huaraz', '0201', '02');
INSERT INTO `ubigeo_peru_districts` VALUES ('020102', 'Cochabamba', '0201', '02');
INSERT INTO `ubigeo_peru_districts` VALUES ('020103', 'Colcabamba', '0201', '02');
INSERT INTO `ubigeo_peru_districts` VALUES ('020104', 'Huanchay', '0201', '02');
INSERT INTO `ubigeo_peru_districts` VALUES ('020105', 'Independencia', '0201', '02');
INSERT INTO `ubigeo_peru_districts` VALUES ('020106', 'Jangas', '0201', '02');
INSERT INTO `ubigeo_peru_districts` VALUES ('020107', 'La Libertad', '0201', '02');
INSERT INTO `ubigeo_peru_districts` VALUES ('020108', 'Olleros', '0201', '02');
INSERT INTO `ubigeo_peru_districts` VALUES ('020109', 'Pampas Grande', '0201', '02');
INSERT INTO `ubigeo_peru_districts` VALUES ('020110', 'Pariacoto', '0201', '02');
INSERT INTO `ubigeo_peru_districts` VALUES ('020111', 'Pira', '0201', '02');
INSERT INTO `ubigeo_peru_districts` VALUES ('020112', 'Tarica', '0201', '02');
INSERT INTO `ubigeo_peru_districts` VALUES ('020201', 'Aija', '0202', '02');
INSERT INTO `ubigeo_peru_districts` VALUES ('020202', 'Coris', '0202', '02');
INSERT INTO `ubigeo_peru_districts` VALUES ('020203', 'Huacllan', '0202', '02');
INSERT INTO `ubigeo_peru_districts` VALUES ('020204', 'La Merced', '0202', '02');
INSERT INTO `ubigeo_peru_districts` VALUES ('020205', 'Succha', '0202', '02');
INSERT INTO `ubigeo_peru_districts` VALUES ('020301', 'Llamellin', '0203', '02');
INSERT INTO `ubigeo_peru_districts` VALUES ('020302', 'Aczo', '0203', '02');
INSERT INTO `ubigeo_peru_districts` VALUES ('020303', 'Chaccho', '0203', '02');
INSERT INTO `ubigeo_peru_districts` VALUES ('020304', 'Chingas', '0203', '02');
INSERT INTO `ubigeo_peru_districts` VALUES ('020305', 'Mirgas', '0203', '02');
INSERT INTO `ubigeo_peru_districts` VALUES ('020306', 'San Juan de Rontoy', '0203', '02');
INSERT INTO `ubigeo_peru_districts` VALUES ('020401', 'Chacas', '0204', '02');
INSERT INTO `ubigeo_peru_districts` VALUES ('020402', 'Acochaca', '0204', '02');
INSERT INTO `ubigeo_peru_districts` VALUES ('020501', 'Chiquian', '0205', '02');
INSERT INTO `ubigeo_peru_districts` VALUES ('020502', 'Abelardo Pardo Lezameta', '0205', '02');
INSERT INTO `ubigeo_peru_districts` VALUES ('020503', 'Antonio Raymondi', '0205', '02');
INSERT INTO `ubigeo_peru_districts` VALUES ('020504', 'Aquia', '0205', '02');
INSERT INTO `ubigeo_peru_districts` VALUES ('020505', 'Cajacay', '0205', '02');
INSERT INTO `ubigeo_peru_districts` VALUES ('020506', 'Canis', '0205', '02');
INSERT INTO `ubigeo_peru_districts` VALUES ('020507', 'Colquioc', '0205', '02');
INSERT INTO `ubigeo_peru_districts` VALUES ('020508', 'Huallanca', '0205', '02');
INSERT INTO `ubigeo_peru_districts` VALUES ('020509', 'Huasta', '0205', '02');
INSERT INTO `ubigeo_peru_districts` VALUES ('020510', 'Huayllacayan', '0205', '02');
INSERT INTO `ubigeo_peru_districts` VALUES ('020511', 'La Primavera', '0205', '02');
INSERT INTO `ubigeo_peru_districts` VALUES ('020512', 'Mangas', '0205', '02');
INSERT INTO `ubigeo_peru_districts` VALUES ('020513', 'Pacllon', '0205', '02');
INSERT INTO `ubigeo_peru_districts` VALUES ('020514', 'San Miguel de Corpanqui', '0205', '02');
INSERT INTO `ubigeo_peru_districts` VALUES ('020515', 'Ticllos', '0205', '02');
INSERT INTO `ubigeo_peru_districts` VALUES ('020601', 'Carhuaz', '0206', '02');
INSERT INTO `ubigeo_peru_districts` VALUES ('020602', 'Acopampa', '0206', '02');
INSERT INTO `ubigeo_peru_districts` VALUES ('020603', 'Amashca', '0206', '02');
INSERT INTO `ubigeo_peru_districts` VALUES ('020604', 'Anta', '0206', '02');
INSERT INTO `ubigeo_peru_districts` VALUES ('020605', 'Ataquero', '0206', '02');
INSERT INTO `ubigeo_peru_districts` VALUES ('020606', 'Marcara', '0206', '02');
INSERT INTO `ubigeo_peru_districts` VALUES ('020607', 'Pariahuanca', '0206', '02');
INSERT INTO `ubigeo_peru_districts` VALUES ('020608', 'San Miguel de Aco', '0206', '02');
INSERT INTO `ubigeo_peru_districts` VALUES ('020609', 'Shilla', '0206', '02');
INSERT INTO `ubigeo_peru_districts` VALUES ('020610', 'Tinco', '0206', '02');
INSERT INTO `ubigeo_peru_districts` VALUES ('020611', 'Yungar', '0206', '02');
INSERT INTO `ubigeo_peru_districts` VALUES ('020701', 'San Luis', '0207', '02');
INSERT INTO `ubigeo_peru_districts` VALUES ('020702', 'San Nicolás', '0207', '02');
INSERT INTO `ubigeo_peru_districts` VALUES ('020703', 'Yauya', '0207', '02');
INSERT INTO `ubigeo_peru_districts` VALUES ('020801', 'Casma', '0208', '02');
INSERT INTO `ubigeo_peru_districts` VALUES ('020802', 'Buena Vista Alta', '0208', '02');
INSERT INTO `ubigeo_peru_districts` VALUES ('020803', 'Comandante Noel', '0208', '02');
INSERT INTO `ubigeo_peru_districts` VALUES ('020804', 'Yautan', '0208', '02');
INSERT INTO `ubigeo_peru_districts` VALUES ('020901', 'Corongo', '0209', '02');
INSERT INTO `ubigeo_peru_districts` VALUES ('020902', 'Aco', '0209', '02');
INSERT INTO `ubigeo_peru_districts` VALUES ('020903', 'Bambas', '0209', '02');
INSERT INTO `ubigeo_peru_districts` VALUES ('020904', 'Cusca', '0209', '02');
INSERT INTO `ubigeo_peru_districts` VALUES ('020905', 'La Pampa', '0209', '02');
INSERT INTO `ubigeo_peru_districts` VALUES ('020906', 'Yanac', '0209', '02');
INSERT INTO `ubigeo_peru_districts` VALUES ('020907', 'Yupan', '0209', '02');
INSERT INTO `ubigeo_peru_districts` VALUES ('021001', 'Huari', '0210', '02');
INSERT INTO `ubigeo_peru_districts` VALUES ('021002', 'Anra', '0210', '02');
INSERT INTO `ubigeo_peru_districts` VALUES ('021003', 'Cajay', '0210', '02');
INSERT INTO `ubigeo_peru_districts` VALUES ('021004', 'Chavin de Huantar', '0210', '02');
INSERT INTO `ubigeo_peru_districts` VALUES ('021005', 'Huacachi', '0210', '02');
INSERT INTO `ubigeo_peru_districts` VALUES ('021006', 'Huacchis', '0210', '02');
INSERT INTO `ubigeo_peru_districts` VALUES ('021007', 'Huachis', '0210', '02');
INSERT INTO `ubigeo_peru_districts` VALUES ('021008', 'Huantar', '0210', '02');
INSERT INTO `ubigeo_peru_districts` VALUES ('021009', 'Masin', '0210', '02');
INSERT INTO `ubigeo_peru_districts` VALUES ('021010', 'Paucas', '0210', '02');
INSERT INTO `ubigeo_peru_districts` VALUES ('021011', 'Ponto', '0210', '02');
INSERT INTO `ubigeo_peru_districts` VALUES ('021012', 'Rahuapampa', '0210', '02');
INSERT INTO `ubigeo_peru_districts` VALUES ('021013', 'Rapayan', '0210', '02');
INSERT INTO `ubigeo_peru_districts` VALUES ('021014', 'San Marcos', '0210', '02');
INSERT INTO `ubigeo_peru_districts` VALUES ('021015', 'San Pedro de Chana', '0210', '02');
INSERT INTO `ubigeo_peru_districts` VALUES ('021016', 'Uco', '0210', '02');
INSERT INTO `ubigeo_peru_districts` VALUES ('021101', 'Huarmey', '0211', '02');
INSERT INTO `ubigeo_peru_districts` VALUES ('021102', 'Cochapeti', '0211', '02');
INSERT INTO `ubigeo_peru_districts` VALUES ('021103', 'Culebras', '0211', '02');
INSERT INTO `ubigeo_peru_districts` VALUES ('021104', 'Huayan', '0211', '02');
INSERT INTO `ubigeo_peru_districts` VALUES ('021105', 'Malvas', '0211', '02');
INSERT INTO `ubigeo_peru_districts` VALUES ('021201', 'Caraz', '0212', '02');
INSERT INTO `ubigeo_peru_districts` VALUES ('021202', 'Huallanca', '0212', '02');
INSERT INTO `ubigeo_peru_districts` VALUES ('021203', 'Huata', '0212', '02');
INSERT INTO `ubigeo_peru_districts` VALUES ('021204', 'Huaylas', '0212', '02');
INSERT INTO `ubigeo_peru_districts` VALUES ('021205', 'Mato', '0212', '02');
INSERT INTO `ubigeo_peru_districts` VALUES ('021206', 'Pamparomas', '0212', '02');
INSERT INTO `ubigeo_peru_districts` VALUES ('021207', 'Pueblo Libre', '0212', '02');
INSERT INTO `ubigeo_peru_districts` VALUES ('021208', 'Santa Cruz', '0212', '02');
INSERT INTO `ubigeo_peru_districts` VALUES ('021209', 'Santo Toribio', '0212', '02');
INSERT INTO `ubigeo_peru_districts` VALUES ('021210', 'Yuracmarca', '0212', '02');
INSERT INTO `ubigeo_peru_districts` VALUES ('021301', 'Piscobamba', '0213', '02');
INSERT INTO `ubigeo_peru_districts` VALUES ('021302', 'Casca', '0213', '02');
INSERT INTO `ubigeo_peru_districts` VALUES ('021303', 'Eleazar Guzmán Barron', '0213', '02');
INSERT INTO `ubigeo_peru_districts` VALUES ('021304', 'Fidel Olivas Escudero', '0213', '02');
INSERT INTO `ubigeo_peru_districts` VALUES ('021305', 'Llama', '0213', '02');
INSERT INTO `ubigeo_peru_districts` VALUES ('021306', 'Llumpa', '0213', '02');
INSERT INTO `ubigeo_peru_districts` VALUES ('021307', 'Lucma', '0213', '02');
INSERT INTO `ubigeo_peru_districts` VALUES ('021308', 'Musga', '0213', '02');
INSERT INTO `ubigeo_peru_districts` VALUES ('021401', 'Ocros', '0214', '02');
INSERT INTO `ubigeo_peru_districts` VALUES ('021402', 'Acas', '0214', '02');
INSERT INTO `ubigeo_peru_districts` VALUES ('021403', 'Cajamarquilla', '0214', '02');
INSERT INTO `ubigeo_peru_districts` VALUES ('021404', 'Carhuapampa', '0214', '02');
INSERT INTO `ubigeo_peru_districts` VALUES ('021405', 'Cochas', '0214', '02');
INSERT INTO `ubigeo_peru_districts` VALUES ('021406', 'Congas', '0214', '02');
INSERT INTO `ubigeo_peru_districts` VALUES ('021407', 'Llipa', '0214', '02');
INSERT INTO `ubigeo_peru_districts` VALUES ('021408', 'San Cristóbal de Rajan', '0214', '02');
INSERT INTO `ubigeo_peru_districts` VALUES ('021409', 'San Pedro', '0214', '02');
INSERT INTO `ubigeo_peru_districts` VALUES ('021410', 'Santiago de Chilcas', '0214', '02');
INSERT INTO `ubigeo_peru_districts` VALUES ('021501', 'Cabana', '0215', '02');
INSERT INTO `ubigeo_peru_districts` VALUES ('021502', 'Bolognesi', '0215', '02');
INSERT INTO `ubigeo_peru_districts` VALUES ('021503', 'Conchucos', '0215', '02');
INSERT INTO `ubigeo_peru_districts` VALUES ('021504', 'Huacaschuque', '0215', '02');
INSERT INTO `ubigeo_peru_districts` VALUES ('021505', 'Huandoval', '0215', '02');
INSERT INTO `ubigeo_peru_districts` VALUES ('021506', 'Lacabamba', '0215', '02');
INSERT INTO `ubigeo_peru_districts` VALUES ('021507', 'Llapo', '0215', '02');
INSERT INTO `ubigeo_peru_districts` VALUES ('021508', 'Pallasca', '0215', '02');
INSERT INTO `ubigeo_peru_districts` VALUES ('021509', 'Pampas', '0215', '02');
INSERT INTO `ubigeo_peru_districts` VALUES ('021510', 'Santa Rosa', '0215', '02');
INSERT INTO `ubigeo_peru_districts` VALUES ('021511', 'Tauca', '0215', '02');
INSERT INTO `ubigeo_peru_districts` VALUES ('021601', 'Pomabamba', '0216', '02');
INSERT INTO `ubigeo_peru_districts` VALUES ('021602', 'Huayllan', '0216', '02');
INSERT INTO `ubigeo_peru_districts` VALUES ('021603', 'Parobamba', '0216', '02');
INSERT INTO `ubigeo_peru_districts` VALUES ('021604', 'Quinuabamba', '0216', '02');
INSERT INTO `ubigeo_peru_districts` VALUES ('021701', 'Recuay', '0217', '02');
INSERT INTO `ubigeo_peru_districts` VALUES ('021702', 'Catac', '0217', '02');
INSERT INTO `ubigeo_peru_districts` VALUES ('021703', 'Cotaparaco', '0217', '02');
INSERT INTO `ubigeo_peru_districts` VALUES ('021704', 'Huayllapampa', '0217', '02');
INSERT INTO `ubigeo_peru_districts` VALUES ('021705', 'Llacllin', '0217', '02');
INSERT INTO `ubigeo_peru_districts` VALUES ('021706', 'Marca', '0217', '02');
INSERT INTO `ubigeo_peru_districts` VALUES ('021707', 'Pampas Chico', '0217', '02');
INSERT INTO `ubigeo_peru_districts` VALUES ('021708', 'Pararin', '0217', '02');
INSERT INTO `ubigeo_peru_districts` VALUES ('021709', 'Tapacocha', '0217', '02');
INSERT INTO `ubigeo_peru_districts` VALUES ('021710', 'Ticapampa', '0217', '02');
INSERT INTO `ubigeo_peru_districts` VALUES ('021801', 'Chimbote', '0218', '02');
INSERT INTO `ubigeo_peru_districts` VALUES ('021802', 'Cáceres del Perú', '0218', '02');
INSERT INTO `ubigeo_peru_districts` VALUES ('021803', 'Coishco', '0218', '02');
INSERT INTO `ubigeo_peru_districts` VALUES ('021804', 'Macate', '0218', '02');
INSERT INTO `ubigeo_peru_districts` VALUES ('021805', 'Moro', '0218', '02');
INSERT INTO `ubigeo_peru_districts` VALUES ('021806', 'Nepeña', '0218', '02');
INSERT INTO `ubigeo_peru_districts` VALUES ('021807', 'Samanco', '0218', '02');
INSERT INTO `ubigeo_peru_districts` VALUES ('021808', 'Santa', '0218', '02');
INSERT INTO `ubigeo_peru_districts` VALUES ('021809', 'Nuevo Chimbote', '0218', '02');
INSERT INTO `ubigeo_peru_districts` VALUES ('021901', 'Sihuas', '0219', '02');
INSERT INTO `ubigeo_peru_districts` VALUES ('021902', 'Acobamba', '0219', '02');
INSERT INTO `ubigeo_peru_districts` VALUES ('021903', 'Alfonso Ugarte', '0219', '02');
INSERT INTO `ubigeo_peru_districts` VALUES ('021904', 'Cashapampa', '0219', '02');
INSERT INTO `ubigeo_peru_districts` VALUES ('021905', 'Chingalpo', '0219', '02');
INSERT INTO `ubigeo_peru_districts` VALUES ('021906', 'Huayllabamba', '0219', '02');
INSERT INTO `ubigeo_peru_districts` VALUES ('021907', 'Quiches', '0219', '02');
INSERT INTO `ubigeo_peru_districts` VALUES ('021908', 'Ragash', '0219', '02');
INSERT INTO `ubigeo_peru_districts` VALUES ('021909', 'San Juan', '0219', '02');
INSERT INTO `ubigeo_peru_districts` VALUES ('021910', 'Sicsibamba', '0219', '02');
INSERT INTO `ubigeo_peru_districts` VALUES ('022001', 'Yungay', '0220', '02');
INSERT INTO `ubigeo_peru_districts` VALUES ('022002', 'Cascapara', '0220', '02');
INSERT INTO `ubigeo_peru_districts` VALUES ('022003', 'Mancos', '0220', '02');
INSERT INTO `ubigeo_peru_districts` VALUES ('022004', 'Matacoto', '0220', '02');
INSERT INTO `ubigeo_peru_districts` VALUES ('022005', 'Quillo', '0220', '02');
INSERT INTO `ubigeo_peru_districts` VALUES ('022006', 'Ranrahirca', '0220', '02');
INSERT INTO `ubigeo_peru_districts` VALUES ('022007', 'Shupluy', '0220', '02');
INSERT INTO `ubigeo_peru_districts` VALUES ('022008', 'Yanama', '0220', '02');
INSERT INTO `ubigeo_peru_districts` VALUES ('030101', 'Abancay', '0301', '03');
INSERT INTO `ubigeo_peru_districts` VALUES ('030102', 'Chacoche', '0301', '03');
INSERT INTO `ubigeo_peru_districts` VALUES ('030103', 'Circa', '0301', '03');
INSERT INTO `ubigeo_peru_districts` VALUES ('030104', 'Curahuasi', '0301', '03');
INSERT INTO `ubigeo_peru_districts` VALUES ('030105', 'Huanipaca', '0301', '03');
INSERT INTO `ubigeo_peru_districts` VALUES ('030106', 'Lambrama', '0301', '03');
INSERT INTO `ubigeo_peru_districts` VALUES ('030107', 'Pichirhua', '0301', '03');
INSERT INTO `ubigeo_peru_districts` VALUES ('030108', 'San Pedro de Cachora', '0301', '03');
INSERT INTO `ubigeo_peru_districts` VALUES ('030109', 'Tamburco', '0301', '03');
INSERT INTO `ubigeo_peru_districts` VALUES ('030201', 'Andahuaylas', '0302', '03');
INSERT INTO `ubigeo_peru_districts` VALUES ('030202', 'Andarapa', '0302', '03');
INSERT INTO `ubigeo_peru_districts` VALUES ('030203', 'Chiara', '0302', '03');
INSERT INTO `ubigeo_peru_districts` VALUES ('030204', 'Huancarama', '0302', '03');
INSERT INTO `ubigeo_peru_districts` VALUES ('030205', 'Huancaray', '0302', '03');
INSERT INTO `ubigeo_peru_districts` VALUES ('030206', 'Huayana', '0302', '03');
INSERT INTO `ubigeo_peru_districts` VALUES ('030207', 'Kishuara', '0302', '03');
INSERT INTO `ubigeo_peru_districts` VALUES ('030208', 'Pacobamba', '0302', '03');
INSERT INTO `ubigeo_peru_districts` VALUES ('030209', 'Pacucha', '0302', '03');
INSERT INTO `ubigeo_peru_districts` VALUES ('030210', 'Pampachiri', '0302', '03');
INSERT INTO `ubigeo_peru_districts` VALUES ('030211', 'Pomacocha', '0302', '03');
INSERT INTO `ubigeo_peru_districts` VALUES ('030212', 'San Antonio de Cachi', '0302', '03');
INSERT INTO `ubigeo_peru_districts` VALUES ('030213', 'San Jerónimo', '0302', '03');
INSERT INTO `ubigeo_peru_districts` VALUES ('030214', 'San Miguel de Chaccrampa', '0302', '03');
INSERT INTO `ubigeo_peru_districts` VALUES ('030215', 'Santa María de Chicmo', '0302', '03');
INSERT INTO `ubigeo_peru_districts` VALUES ('030216', 'Talavera', '0302', '03');
INSERT INTO `ubigeo_peru_districts` VALUES ('030217', 'Tumay Huaraca', '0302', '03');
INSERT INTO `ubigeo_peru_districts` VALUES ('030218', 'Turpo', '0302', '03');
INSERT INTO `ubigeo_peru_districts` VALUES ('030219', 'Kaquiabamba', '0302', '03');
INSERT INTO `ubigeo_peru_districts` VALUES ('030220', 'José María Arguedas', '0302', '03');
INSERT INTO `ubigeo_peru_districts` VALUES ('030301', 'Antabamba', '0303', '03');
INSERT INTO `ubigeo_peru_districts` VALUES ('030302', 'El Oro', '0303', '03');
INSERT INTO `ubigeo_peru_districts` VALUES ('030303', 'Huaquirca', '0303', '03');
INSERT INTO `ubigeo_peru_districts` VALUES ('030304', 'Juan Espinoza Medrano', '0303', '03');
INSERT INTO `ubigeo_peru_districts` VALUES ('030305', 'Oropesa', '0303', '03');
INSERT INTO `ubigeo_peru_districts` VALUES ('030306', 'Pachaconas', '0303', '03');
INSERT INTO `ubigeo_peru_districts` VALUES ('030307', 'Sabaino', '0303', '03');
INSERT INTO `ubigeo_peru_districts` VALUES ('030401', 'Chalhuanca', '0304', '03');
INSERT INTO `ubigeo_peru_districts` VALUES ('030402', 'Capaya', '0304', '03');
INSERT INTO `ubigeo_peru_districts` VALUES ('030403', 'Caraybamba', '0304', '03');
INSERT INTO `ubigeo_peru_districts` VALUES ('030404', 'Chapimarca', '0304', '03');
INSERT INTO `ubigeo_peru_districts` VALUES ('030405', 'Colcabamba', '0304', '03');
INSERT INTO `ubigeo_peru_districts` VALUES ('030406', 'Cotaruse', '0304', '03');
INSERT INTO `ubigeo_peru_districts` VALUES ('030407', 'Ihuayllo', '0304', '03');
INSERT INTO `ubigeo_peru_districts` VALUES ('030408', 'Justo Apu Sahuaraura', '0304', '03');
INSERT INTO `ubigeo_peru_districts` VALUES ('030409', 'Lucre', '0304', '03');
INSERT INTO `ubigeo_peru_districts` VALUES ('030410', 'Pocohuanca', '0304', '03');
INSERT INTO `ubigeo_peru_districts` VALUES ('030411', 'San Juan de Chacña', '0304', '03');
INSERT INTO `ubigeo_peru_districts` VALUES ('030412', 'Sañayca', '0304', '03');
INSERT INTO `ubigeo_peru_districts` VALUES ('030413', 'Soraya', '0304', '03');
INSERT INTO `ubigeo_peru_districts` VALUES ('030414', 'Tapairihua', '0304', '03');
INSERT INTO `ubigeo_peru_districts` VALUES ('030415', 'Tintay', '0304', '03');
INSERT INTO `ubigeo_peru_districts` VALUES ('030416', 'Toraya', '0304', '03');
INSERT INTO `ubigeo_peru_districts` VALUES ('030417', 'Yanaca', '0304', '03');
INSERT INTO `ubigeo_peru_districts` VALUES ('030501', 'Tambobamba', '0305', '03');
INSERT INTO `ubigeo_peru_districts` VALUES ('030502', 'Cotabambas', '0305', '03');
INSERT INTO `ubigeo_peru_districts` VALUES ('030503', 'Coyllurqui', '0305', '03');
INSERT INTO `ubigeo_peru_districts` VALUES ('030504', 'Haquira', '0305', '03');
INSERT INTO `ubigeo_peru_districts` VALUES ('030505', 'Mara', '0305', '03');
INSERT INTO `ubigeo_peru_districts` VALUES ('030506', 'Challhuahuacho', '0305', '03');
INSERT INTO `ubigeo_peru_districts` VALUES ('030601', 'Chincheros', '0306', '03');
INSERT INTO `ubigeo_peru_districts` VALUES ('030602', 'Anco_Huallo', '0306', '03');
INSERT INTO `ubigeo_peru_districts` VALUES ('030603', 'Cocharcas', '0306', '03');
INSERT INTO `ubigeo_peru_districts` VALUES ('030604', 'Huaccana', '0306', '03');
INSERT INTO `ubigeo_peru_districts` VALUES ('030605', 'Ocobamba', '0306', '03');
INSERT INTO `ubigeo_peru_districts` VALUES ('030606', 'Ongoy', '0306', '03');
INSERT INTO `ubigeo_peru_districts` VALUES ('030607', 'Uranmarca', '0306', '03');
INSERT INTO `ubigeo_peru_districts` VALUES ('030608', 'Ranracancha', '0306', '03');
INSERT INTO `ubigeo_peru_districts` VALUES ('030609', 'Rocchacc', '0306', '03');
INSERT INTO `ubigeo_peru_districts` VALUES ('030610', 'El Porvenir', '0306', '03');
INSERT INTO `ubigeo_peru_districts` VALUES ('030611', 'Los Chankas', '0306', '03');
INSERT INTO `ubigeo_peru_districts` VALUES ('030701', 'Chuquibambilla', '0307', '03');
INSERT INTO `ubigeo_peru_districts` VALUES ('030702', 'Curpahuasi', '0307', '03');
INSERT INTO `ubigeo_peru_districts` VALUES ('030703', 'Gamarra', '0307', '03');
INSERT INTO `ubigeo_peru_districts` VALUES ('030704', 'Huayllati', '0307', '03');
INSERT INTO `ubigeo_peru_districts` VALUES ('030705', 'Mamara', '0307', '03');
INSERT INTO `ubigeo_peru_districts` VALUES ('030706', 'Micaela Bastidas', '0307', '03');
INSERT INTO `ubigeo_peru_districts` VALUES ('030707', 'Pataypampa', '0307', '03');
INSERT INTO `ubigeo_peru_districts` VALUES ('030708', 'Progreso', '0307', '03');
INSERT INTO `ubigeo_peru_districts` VALUES ('030709', 'San Antonio', '0307', '03');
INSERT INTO `ubigeo_peru_districts` VALUES ('030710', 'Santa Rosa', '0307', '03');
INSERT INTO `ubigeo_peru_districts` VALUES ('030711', 'Turpay', '0307', '03');
INSERT INTO `ubigeo_peru_districts` VALUES ('030712', 'Vilcabamba', '0307', '03');
INSERT INTO `ubigeo_peru_districts` VALUES ('030713', 'Virundo', '0307', '03');
INSERT INTO `ubigeo_peru_districts` VALUES ('030714', 'Curasco', '0307', '03');
INSERT INTO `ubigeo_peru_districts` VALUES ('040101', 'Arequipa', '0401', '04');
INSERT INTO `ubigeo_peru_districts` VALUES ('040102', 'Alto Selva Alegre', '0401', '04');
INSERT INTO `ubigeo_peru_districts` VALUES ('040103', 'Cayma', '0401', '04');
INSERT INTO `ubigeo_peru_districts` VALUES ('040104', 'Cerro Colorado', '0401', '04');
INSERT INTO `ubigeo_peru_districts` VALUES ('040105', 'Characato', '0401', '04');
INSERT INTO `ubigeo_peru_districts` VALUES ('040106', 'Chiguata', '0401', '04');
INSERT INTO `ubigeo_peru_districts` VALUES ('040107', 'Jacobo Hunter', '0401', '04');
INSERT INTO `ubigeo_peru_districts` VALUES ('040108', 'La Joya', '0401', '04');
INSERT INTO `ubigeo_peru_districts` VALUES ('040109', 'Mariano Melgar', '0401', '04');
INSERT INTO `ubigeo_peru_districts` VALUES ('040110', 'Miraflores', '0401', '04');
INSERT INTO `ubigeo_peru_districts` VALUES ('040111', 'Mollebaya', '0401', '04');
INSERT INTO `ubigeo_peru_districts` VALUES ('040112', 'Paucarpata', '0401', '04');
INSERT INTO `ubigeo_peru_districts` VALUES ('040113', 'Pocsi', '0401', '04');
INSERT INTO `ubigeo_peru_districts` VALUES ('040114', 'Polobaya', '0401', '04');
INSERT INTO `ubigeo_peru_districts` VALUES ('040115', 'Quequeña', '0401', '04');
INSERT INTO `ubigeo_peru_districts` VALUES ('040116', 'Sabandia', '0401', '04');
INSERT INTO `ubigeo_peru_districts` VALUES ('040117', 'Sachaca', '0401', '04');
INSERT INTO `ubigeo_peru_districts` VALUES ('040118', 'San Juan de Siguas', '0401', '04');
INSERT INTO `ubigeo_peru_districts` VALUES ('040119', 'San Juan de Tarucani', '0401', '04');
INSERT INTO `ubigeo_peru_districts` VALUES ('040120', 'Santa Isabel de Siguas', '0401', '04');
INSERT INTO `ubigeo_peru_districts` VALUES ('040121', 'Santa Rita de Siguas', '0401', '04');
INSERT INTO `ubigeo_peru_districts` VALUES ('040122', 'Socabaya', '0401', '04');
INSERT INTO `ubigeo_peru_districts` VALUES ('040123', 'Tiabaya', '0401', '04');
INSERT INTO `ubigeo_peru_districts` VALUES ('040124', 'Uchumayo', '0401', '04');
INSERT INTO `ubigeo_peru_districts` VALUES ('040125', 'Vitor', '0401', '04');
INSERT INTO `ubigeo_peru_districts` VALUES ('040126', 'Yanahuara', '0401', '04');
INSERT INTO `ubigeo_peru_districts` VALUES ('040127', 'Yarabamba', '0401', '04');
INSERT INTO `ubigeo_peru_districts` VALUES ('040128', 'Yura', '0401', '04');
INSERT INTO `ubigeo_peru_districts` VALUES ('040129', 'José Luis Bustamante Y Rivero', '0401', '04');
INSERT INTO `ubigeo_peru_districts` VALUES ('040201', 'Camaná', '0402', '04');
INSERT INTO `ubigeo_peru_districts` VALUES ('040202', 'José María Quimper', '0402', '04');
INSERT INTO `ubigeo_peru_districts` VALUES ('040203', 'Mariano Nicolás Valcárcel', '0402', '04');
INSERT INTO `ubigeo_peru_districts` VALUES ('040204', 'Mariscal Cáceres', '0402', '04');
INSERT INTO `ubigeo_peru_districts` VALUES ('040205', 'Nicolás de Pierola', '0402', '04');
INSERT INTO `ubigeo_peru_districts` VALUES ('040206', 'Ocoña', '0402', '04');
INSERT INTO `ubigeo_peru_districts` VALUES ('040207', 'Quilca', '0402', '04');
INSERT INTO `ubigeo_peru_districts` VALUES ('040208', 'Samuel Pastor', '0402', '04');
INSERT INTO `ubigeo_peru_districts` VALUES ('040301', 'Caravelí', '0403', '04');
INSERT INTO `ubigeo_peru_districts` VALUES ('040302', 'Acarí', '0403', '04');
INSERT INTO `ubigeo_peru_districts` VALUES ('040303', 'Atico', '0403', '04');
INSERT INTO `ubigeo_peru_districts` VALUES ('040304', 'Atiquipa', '0403', '04');
INSERT INTO `ubigeo_peru_districts` VALUES ('040305', 'Bella Unión', '0403', '04');
INSERT INTO `ubigeo_peru_districts` VALUES ('040306', 'Cahuacho', '0403', '04');
INSERT INTO `ubigeo_peru_districts` VALUES ('040307', 'Chala', '0403', '04');
INSERT INTO `ubigeo_peru_districts` VALUES ('040308', 'Chaparra', '0403', '04');
INSERT INTO `ubigeo_peru_districts` VALUES ('040309', 'Huanuhuanu', '0403', '04');
INSERT INTO `ubigeo_peru_districts` VALUES ('040310', 'Jaqui', '0403', '04');
INSERT INTO `ubigeo_peru_districts` VALUES ('040311', 'Lomas', '0403', '04');
INSERT INTO `ubigeo_peru_districts` VALUES ('040312', 'Quicacha', '0403', '04');
INSERT INTO `ubigeo_peru_districts` VALUES ('040313', 'Yauca', '0403', '04');
INSERT INTO `ubigeo_peru_districts` VALUES ('040401', 'Aplao', '0404', '04');
INSERT INTO `ubigeo_peru_districts` VALUES ('040402', 'Andagua', '0404', '04');
INSERT INTO `ubigeo_peru_districts` VALUES ('040403', 'Ayo', '0404', '04');
INSERT INTO `ubigeo_peru_districts` VALUES ('040404', 'Chachas', '0404', '04');
INSERT INTO `ubigeo_peru_districts` VALUES ('040405', 'Chilcaymarca', '0404', '04');
INSERT INTO `ubigeo_peru_districts` VALUES ('040406', 'Choco', '0404', '04');
INSERT INTO `ubigeo_peru_districts` VALUES ('040407', 'Huancarqui', '0404', '04');
INSERT INTO `ubigeo_peru_districts` VALUES ('040408', 'Machaguay', '0404', '04');
INSERT INTO `ubigeo_peru_districts` VALUES ('040409', 'Orcopampa', '0404', '04');
INSERT INTO `ubigeo_peru_districts` VALUES ('040410', 'Pampacolca', '0404', '04');
INSERT INTO `ubigeo_peru_districts` VALUES ('040411', 'Tipan', '0404', '04');
INSERT INTO `ubigeo_peru_districts` VALUES ('040412', 'Uñon', '0404', '04');
INSERT INTO `ubigeo_peru_districts` VALUES ('040413', 'Uraca', '0404', '04');
INSERT INTO `ubigeo_peru_districts` VALUES ('040414', 'Viraco', '0404', '04');
INSERT INTO `ubigeo_peru_districts` VALUES ('040501', 'Chivay', '0405', '04');
INSERT INTO `ubigeo_peru_districts` VALUES ('040502', 'Achoma', '0405', '04');
INSERT INTO `ubigeo_peru_districts` VALUES ('040503', 'Cabanaconde', '0405', '04');
INSERT INTO `ubigeo_peru_districts` VALUES ('040504', 'Callalli', '0405', '04');
INSERT INTO `ubigeo_peru_districts` VALUES ('040505', 'Caylloma', '0405', '04');
INSERT INTO `ubigeo_peru_districts` VALUES ('040506', 'Coporaque', '0405', '04');
INSERT INTO `ubigeo_peru_districts` VALUES ('040507', 'Huambo', '0405', '04');
INSERT INTO `ubigeo_peru_districts` VALUES ('040508', 'Huanca', '0405', '04');
INSERT INTO `ubigeo_peru_districts` VALUES ('040509', 'Ichupampa', '0405', '04');
INSERT INTO `ubigeo_peru_districts` VALUES ('040510', 'Lari', '0405', '04');
INSERT INTO `ubigeo_peru_districts` VALUES ('040511', 'Lluta', '0405', '04');
INSERT INTO `ubigeo_peru_districts` VALUES ('040512', 'Maca', '0405', '04');
INSERT INTO `ubigeo_peru_districts` VALUES ('040513', 'Madrigal', '0405', '04');
INSERT INTO `ubigeo_peru_districts` VALUES ('040514', 'San Antonio de Chuca', '0405', '04');
INSERT INTO `ubigeo_peru_districts` VALUES ('040515', 'Sibayo', '0405', '04');
INSERT INTO `ubigeo_peru_districts` VALUES ('040516', 'Tapay', '0405', '04');
INSERT INTO `ubigeo_peru_districts` VALUES ('040517', 'Tisco', '0405', '04');
INSERT INTO `ubigeo_peru_districts` VALUES ('040518', 'Tuti', '0405', '04');
INSERT INTO `ubigeo_peru_districts` VALUES ('040519', 'Yanque', '0405', '04');
INSERT INTO `ubigeo_peru_districts` VALUES ('040520', 'Majes', '0405', '04');
INSERT INTO `ubigeo_peru_districts` VALUES ('040601', 'Chuquibamba', '0406', '04');
INSERT INTO `ubigeo_peru_districts` VALUES ('040602', 'Andaray', '0406', '04');
INSERT INTO `ubigeo_peru_districts` VALUES ('040603', 'Cayarani', '0406', '04');
INSERT INTO `ubigeo_peru_districts` VALUES ('040604', 'Chichas', '0406', '04');
INSERT INTO `ubigeo_peru_districts` VALUES ('040605', 'Iray', '0406', '04');
INSERT INTO `ubigeo_peru_districts` VALUES ('040606', 'Río Grande', '0406', '04');
INSERT INTO `ubigeo_peru_districts` VALUES ('040607', 'Salamanca', '0406', '04');
INSERT INTO `ubigeo_peru_districts` VALUES ('040608', 'Yanaquihua', '0406', '04');
INSERT INTO `ubigeo_peru_districts` VALUES ('040701', 'Mollendo', '0407', '04');
INSERT INTO `ubigeo_peru_districts` VALUES ('040702', 'Cocachacra', '0407', '04');
INSERT INTO `ubigeo_peru_districts` VALUES ('040703', 'Dean Valdivia', '0407', '04');
INSERT INTO `ubigeo_peru_districts` VALUES ('040704', 'Islay', '0407', '04');
INSERT INTO `ubigeo_peru_districts` VALUES ('040705', 'Mejia', '0407', '04');
INSERT INTO `ubigeo_peru_districts` VALUES ('040706', 'Punta de Bombón', '0407', '04');
INSERT INTO `ubigeo_peru_districts` VALUES ('040801', 'Cotahuasi', '0408', '04');
INSERT INTO `ubigeo_peru_districts` VALUES ('040802', 'Alca', '0408', '04');
INSERT INTO `ubigeo_peru_districts` VALUES ('040803', 'Charcana', '0408', '04');
INSERT INTO `ubigeo_peru_districts` VALUES ('040804', 'Huaynacotas', '0408', '04');
INSERT INTO `ubigeo_peru_districts` VALUES ('040805', 'Pampamarca', '0408', '04');
INSERT INTO `ubigeo_peru_districts` VALUES ('040806', 'Puyca', '0408', '04');
INSERT INTO `ubigeo_peru_districts` VALUES ('040807', 'Quechualla', '0408', '04');
INSERT INTO `ubigeo_peru_districts` VALUES ('040808', 'Sayla', '0408', '04');
INSERT INTO `ubigeo_peru_districts` VALUES ('040809', 'Tauria', '0408', '04');
INSERT INTO `ubigeo_peru_districts` VALUES ('040810', 'Tomepampa', '0408', '04');
INSERT INTO `ubigeo_peru_districts` VALUES ('040811', 'Toro', '0408', '04');
INSERT INTO `ubigeo_peru_districts` VALUES ('050101', 'Ayacucho', '0501', '05');
INSERT INTO `ubigeo_peru_districts` VALUES ('050102', 'Acocro', '0501', '05');
INSERT INTO `ubigeo_peru_districts` VALUES ('050103', 'Acos Vinchos', '0501', '05');
INSERT INTO `ubigeo_peru_districts` VALUES ('050104', 'Carmen Alto', '0501', '05');
INSERT INTO `ubigeo_peru_districts` VALUES ('050105', 'Chiara', '0501', '05');
INSERT INTO `ubigeo_peru_districts` VALUES ('050106', 'Ocros', '0501', '05');
INSERT INTO `ubigeo_peru_districts` VALUES ('050107', 'Pacaycasa', '0501', '05');
INSERT INTO `ubigeo_peru_districts` VALUES ('050108', 'Quinua', '0501', '05');
INSERT INTO `ubigeo_peru_districts` VALUES ('050109', 'San José de Ticllas', '0501', '05');
INSERT INTO `ubigeo_peru_districts` VALUES ('050110', 'San Juan Bautista', '0501', '05');
INSERT INTO `ubigeo_peru_districts` VALUES ('050111', 'Santiago de Pischa', '0501', '05');
INSERT INTO `ubigeo_peru_districts` VALUES ('050112', 'Socos', '0501', '05');
INSERT INTO `ubigeo_peru_districts` VALUES ('050113', 'Tambillo', '0501', '05');
INSERT INTO `ubigeo_peru_districts` VALUES ('050114', 'Vinchos', '0501', '05');
INSERT INTO `ubigeo_peru_districts` VALUES ('050115', 'Jesús Nazareno', '0501', '05');
INSERT INTO `ubigeo_peru_districts` VALUES ('050116', 'Andrés Avelino Cáceres Dorregaray', '0501', '05');
INSERT INTO `ubigeo_peru_districts` VALUES ('050201', 'Cangallo', '0502', '05');
INSERT INTO `ubigeo_peru_districts` VALUES ('050202', 'Chuschi', '0502', '05');
INSERT INTO `ubigeo_peru_districts` VALUES ('050203', 'Los Morochucos', '0502', '05');
INSERT INTO `ubigeo_peru_districts` VALUES ('050204', 'María Parado de Bellido', '0502', '05');
INSERT INTO `ubigeo_peru_districts` VALUES ('050205', 'Paras', '0502', '05');
INSERT INTO `ubigeo_peru_districts` VALUES ('050206', 'Totos', '0502', '05');
INSERT INTO `ubigeo_peru_districts` VALUES ('050301', 'Sancos', '0503', '05');
INSERT INTO `ubigeo_peru_districts` VALUES ('050302', 'Carapo', '0503', '05');
INSERT INTO `ubigeo_peru_districts` VALUES ('050303', 'Sacsamarca', '0503', '05');
INSERT INTO `ubigeo_peru_districts` VALUES ('050304', 'Santiago de Lucanamarca', '0503', '05');
INSERT INTO `ubigeo_peru_districts` VALUES ('050401', 'Huanta', '0504', '05');
INSERT INTO `ubigeo_peru_districts` VALUES ('050402', 'Ayahuanco', '0504', '05');
INSERT INTO `ubigeo_peru_districts` VALUES ('050403', 'Huamanguilla', '0504', '05');
INSERT INTO `ubigeo_peru_districts` VALUES ('050404', 'Iguain', '0504', '05');
INSERT INTO `ubigeo_peru_districts` VALUES ('050405', 'Luricocha', '0504', '05');
INSERT INTO `ubigeo_peru_districts` VALUES ('050406', 'Santillana', '0504', '05');
INSERT INTO `ubigeo_peru_districts` VALUES ('050407', 'Sivia', '0504', '05');
INSERT INTO `ubigeo_peru_districts` VALUES ('050408', 'Llochegua', '0504', '05');
INSERT INTO `ubigeo_peru_districts` VALUES ('050409', 'Canayre', '0504', '05');
INSERT INTO `ubigeo_peru_districts` VALUES ('050410', 'Uchuraccay', '0504', '05');
INSERT INTO `ubigeo_peru_districts` VALUES ('050411', 'Pucacolpa', '0504', '05');
INSERT INTO `ubigeo_peru_districts` VALUES ('050412', 'Chaca', '0504', '05');
INSERT INTO `ubigeo_peru_districts` VALUES ('050501', 'San Miguel', '0505', '05');
INSERT INTO `ubigeo_peru_districts` VALUES ('050502', 'Anco', '0505', '05');
INSERT INTO `ubigeo_peru_districts` VALUES ('050503', 'Ayna', '0505', '05');
INSERT INTO `ubigeo_peru_districts` VALUES ('050504', 'Chilcas', '0505', '05');
INSERT INTO `ubigeo_peru_districts` VALUES ('050505', 'Chungui', '0505', '05');
INSERT INTO `ubigeo_peru_districts` VALUES ('050506', 'Luis Carranza', '0505', '05');
INSERT INTO `ubigeo_peru_districts` VALUES ('050507', 'Santa Rosa', '0505', '05');
INSERT INTO `ubigeo_peru_districts` VALUES ('050508', 'Tambo', '0505', '05');
INSERT INTO `ubigeo_peru_districts` VALUES ('050509', 'Samugari', '0505', '05');
INSERT INTO `ubigeo_peru_districts` VALUES ('050510', 'Anchihuay', '0505', '05');
INSERT INTO `ubigeo_peru_districts` VALUES ('050511', 'Oronccoy', '0505', '05');
INSERT INTO `ubigeo_peru_districts` VALUES ('050601', 'Puquio', '0506', '05');
INSERT INTO `ubigeo_peru_districts` VALUES ('050602', 'Aucara', '0506', '05');
INSERT INTO `ubigeo_peru_districts` VALUES ('050603', 'Cabana', '0506', '05');
INSERT INTO `ubigeo_peru_districts` VALUES ('050604', 'Carmen Salcedo', '0506', '05');
INSERT INTO `ubigeo_peru_districts` VALUES ('050605', 'Chaviña', '0506', '05');
INSERT INTO `ubigeo_peru_districts` VALUES ('050606', 'Chipao', '0506', '05');
INSERT INTO `ubigeo_peru_districts` VALUES ('050607', 'Huac-Huas', '0506', '05');
INSERT INTO `ubigeo_peru_districts` VALUES ('050608', 'Laramate', '0506', '05');
INSERT INTO `ubigeo_peru_districts` VALUES ('050609', 'Leoncio Prado', '0506', '05');
INSERT INTO `ubigeo_peru_districts` VALUES ('050610', 'Llauta', '0506', '05');
INSERT INTO `ubigeo_peru_districts` VALUES ('050611', 'Lucanas', '0506', '05');
INSERT INTO `ubigeo_peru_districts` VALUES ('050612', 'Ocaña', '0506', '05');
INSERT INTO `ubigeo_peru_districts` VALUES ('050613', 'Otoca', '0506', '05');
INSERT INTO `ubigeo_peru_districts` VALUES ('050614', 'Saisa', '0506', '05');
INSERT INTO `ubigeo_peru_districts` VALUES ('050615', 'San Cristóbal', '0506', '05');
INSERT INTO `ubigeo_peru_districts` VALUES ('050616', 'San Juan', '0506', '05');
INSERT INTO `ubigeo_peru_districts` VALUES ('050617', 'San Pedro', '0506', '05');
INSERT INTO `ubigeo_peru_districts` VALUES ('050618', 'San Pedro de Palco', '0506', '05');
INSERT INTO `ubigeo_peru_districts` VALUES ('050619', 'Sancos', '0506', '05');
INSERT INTO `ubigeo_peru_districts` VALUES ('050620', 'Santa Ana de Huaycahuacho', '0506', '05');
INSERT INTO `ubigeo_peru_districts` VALUES ('050621', 'Santa Lucia', '0506', '05');
INSERT INTO `ubigeo_peru_districts` VALUES ('050701', 'Coracora', '0507', '05');
INSERT INTO `ubigeo_peru_districts` VALUES ('050702', 'Chumpi', '0507', '05');
INSERT INTO `ubigeo_peru_districts` VALUES ('050703', 'Coronel Castañeda', '0507', '05');
INSERT INTO `ubigeo_peru_districts` VALUES ('050704', 'Pacapausa', '0507', '05');
INSERT INTO `ubigeo_peru_districts` VALUES ('050705', 'Pullo', '0507', '05');
INSERT INTO `ubigeo_peru_districts` VALUES ('050706', 'Puyusca', '0507', '05');
INSERT INTO `ubigeo_peru_districts` VALUES ('050707', 'San Francisco de Ravacayco', '0507', '05');
INSERT INTO `ubigeo_peru_districts` VALUES ('050708', 'Upahuacho', '0507', '05');
INSERT INTO `ubigeo_peru_districts` VALUES ('050801', 'Pausa', '0508', '05');
INSERT INTO `ubigeo_peru_districts` VALUES ('050802', 'Colta', '0508', '05');
INSERT INTO `ubigeo_peru_districts` VALUES ('050803', 'Corculla', '0508', '05');
INSERT INTO `ubigeo_peru_districts` VALUES ('050804', 'Lampa', '0508', '05');
INSERT INTO `ubigeo_peru_districts` VALUES ('050805', 'Marcabamba', '0508', '05');
INSERT INTO `ubigeo_peru_districts` VALUES ('050806', 'Oyolo', '0508', '05');
INSERT INTO `ubigeo_peru_districts` VALUES ('050807', 'Pararca', '0508', '05');
INSERT INTO `ubigeo_peru_districts` VALUES ('050808', 'San Javier de Alpabamba', '0508', '05');
INSERT INTO `ubigeo_peru_districts` VALUES ('050809', 'San José de Ushua', '0508', '05');
INSERT INTO `ubigeo_peru_districts` VALUES ('050810', 'Sara Sara', '0508', '05');
INSERT INTO `ubigeo_peru_districts` VALUES ('050901', 'Querobamba', '0509', '05');
INSERT INTO `ubigeo_peru_districts` VALUES ('050902', 'Belén', '0509', '05');
INSERT INTO `ubigeo_peru_districts` VALUES ('050903', 'Chalcos', '0509', '05');
INSERT INTO `ubigeo_peru_districts` VALUES ('050904', 'Chilcayoc', '0509', '05');
INSERT INTO `ubigeo_peru_districts` VALUES ('050905', 'Huacaña', '0509', '05');
INSERT INTO `ubigeo_peru_districts` VALUES ('050906', 'Morcolla', '0509', '05');
INSERT INTO `ubigeo_peru_districts` VALUES ('050907', 'Paico', '0509', '05');
INSERT INTO `ubigeo_peru_districts` VALUES ('050908', 'San Pedro de Larcay', '0509', '05');
INSERT INTO `ubigeo_peru_districts` VALUES ('050909', 'San Salvador de Quije', '0509', '05');
INSERT INTO `ubigeo_peru_districts` VALUES ('050910', 'Santiago de Paucaray', '0509', '05');
INSERT INTO `ubigeo_peru_districts` VALUES ('050911', 'Soras', '0509', '05');
INSERT INTO `ubigeo_peru_districts` VALUES ('051001', 'Huancapi', '0510', '05');
INSERT INTO `ubigeo_peru_districts` VALUES ('051002', 'Alcamenca', '0510', '05');
INSERT INTO `ubigeo_peru_districts` VALUES ('051003', 'Apongo', '0510', '05');
INSERT INTO `ubigeo_peru_districts` VALUES ('051004', 'Asquipata', '0510', '05');
INSERT INTO `ubigeo_peru_districts` VALUES ('051005', 'Canaria', '0510', '05');
INSERT INTO `ubigeo_peru_districts` VALUES ('051006', 'Cayara', '0510', '05');
INSERT INTO `ubigeo_peru_districts` VALUES ('051007', 'Colca', '0510', '05');
INSERT INTO `ubigeo_peru_districts` VALUES ('051008', 'Huamanquiquia', '0510', '05');
INSERT INTO `ubigeo_peru_districts` VALUES ('051009', 'Huancaraylla', '0510', '05');
INSERT INTO `ubigeo_peru_districts` VALUES ('051010', 'Hualla', '0510', '05');
INSERT INTO `ubigeo_peru_districts` VALUES ('051011', 'Sarhua', '0510', '05');
INSERT INTO `ubigeo_peru_districts` VALUES ('051012', 'Vilcanchos', '0510', '05');
INSERT INTO `ubigeo_peru_districts` VALUES ('051101', 'Vilcas Huaman', '0511', '05');
INSERT INTO `ubigeo_peru_districts` VALUES ('051102', 'Accomarca', '0511', '05');
INSERT INTO `ubigeo_peru_districts` VALUES ('051103', 'Carhuanca', '0511', '05');
INSERT INTO `ubigeo_peru_districts` VALUES ('051104', 'Concepción', '0511', '05');
INSERT INTO `ubigeo_peru_districts` VALUES ('051105', 'Huambalpa', '0511', '05');
INSERT INTO `ubigeo_peru_districts` VALUES ('051106', 'Independencia', '0511', '05');
INSERT INTO `ubigeo_peru_districts` VALUES ('051107', 'Saurama', '0511', '05');
INSERT INTO `ubigeo_peru_districts` VALUES ('051108', 'Vischongo', '0511', '05');
INSERT INTO `ubigeo_peru_districts` VALUES ('060101', 'Cajamarca', '0601', '06');
INSERT INTO `ubigeo_peru_districts` VALUES ('060102', 'Asunción', '0601', '06');
INSERT INTO `ubigeo_peru_districts` VALUES ('060103', 'Chetilla', '0601', '06');
INSERT INTO `ubigeo_peru_districts` VALUES ('060104', 'Cospan', '0601', '06');
INSERT INTO `ubigeo_peru_districts` VALUES ('060105', 'Encañada', '0601', '06');
INSERT INTO `ubigeo_peru_districts` VALUES ('060106', 'Jesús', '0601', '06');
INSERT INTO `ubigeo_peru_districts` VALUES ('060107', 'Llacanora', '0601', '06');
INSERT INTO `ubigeo_peru_districts` VALUES ('060108', 'Los Baños del Inca', '0601', '06');
INSERT INTO `ubigeo_peru_districts` VALUES ('060109', 'Magdalena', '0601', '06');
INSERT INTO `ubigeo_peru_districts` VALUES ('060110', 'Matara', '0601', '06');
INSERT INTO `ubigeo_peru_districts` VALUES ('060111', 'Namora', '0601', '06');
INSERT INTO `ubigeo_peru_districts` VALUES ('060112', 'San Juan', '0601', '06');
INSERT INTO `ubigeo_peru_districts` VALUES ('060201', 'Cajabamba', '0602', '06');
INSERT INTO `ubigeo_peru_districts` VALUES ('060202', 'Cachachi', '0602', '06');
INSERT INTO `ubigeo_peru_districts` VALUES ('060203', 'Condebamba', '0602', '06');
INSERT INTO `ubigeo_peru_districts` VALUES ('060204', 'Sitacocha', '0602', '06');
INSERT INTO `ubigeo_peru_districts` VALUES ('060301', 'Celendín', '0603', '06');
INSERT INTO `ubigeo_peru_districts` VALUES ('060302', 'Chumuch', '0603', '06');
INSERT INTO `ubigeo_peru_districts` VALUES ('060303', 'Cortegana', '0603', '06');
INSERT INTO `ubigeo_peru_districts` VALUES ('060304', 'Huasmin', '0603', '06');
INSERT INTO `ubigeo_peru_districts` VALUES ('060305', 'Jorge Chávez', '0603', '06');
INSERT INTO `ubigeo_peru_districts` VALUES ('060306', 'José Gálvez', '0603', '06');
INSERT INTO `ubigeo_peru_districts` VALUES ('060307', 'Miguel Iglesias', '0603', '06');
INSERT INTO `ubigeo_peru_districts` VALUES ('060308', 'Oxamarca', '0603', '06');
INSERT INTO `ubigeo_peru_districts` VALUES ('060309', 'Sorochuco', '0603', '06');
INSERT INTO `ubigeo_peru_districts` VALUES ('060310', 'Sucre', '0603', '06');
INSERT INTO `ubigeo_peru_districts` VALUES ('060311', 'Utco', '0603', '06');
INSERT INTO `ubigeo_peru_districts` VALUES ('060312', 'La Libertad de Pallan', '0603', '06');
INSERT INTO `ubigeo_peru_districts` VALUES ('060401', 'Chota', '0604', '06');
INSERT INTO `ubigeo_peru_districts` VALUES ('060402', 'Anguia', '0604', '06');
INSERT INTO `ubigeo_peru_districts` VALUES ('060403', 'Chadin', '0604', '06');
INSERT INTO `ubigeo_peru_districts` VALUES ('060404', 'Chiguirip', '0604', '06');
INSERT INTO `ubigeo_peru_districts` VALUES ('060405', 'Chimban', '0604', '06');
INSERT INTO `ubigeo_peru_districts` VALUES ('060406', 'Choropampa', '0604', '06');
INSERT INTO `ubigeo_peru_districts` VALUES ('060407', 'Cochabamba', '0604', '06');
INSERT INTO `ubigeo_peru_districts` VALUES ('060408', 'Conchan', '0604', '06');
INSERT INTO `ubigeo_peru_districts` VALUES ('060409', 'Huambos', '0604', '06');
INSERT INTO `ubigeo_peru_districts` VALUES ('060410', 'Lajas', '0604', '06');
INSERT INTO `ubigeo_peru_districts` VALUES ('060411', 'Llama', '0604', '06');
INSERT INTO `ubigeo_peru_districts` VALUES ('060412', 'Miracosta', '0604', '06');
INSERT INTO `ubigeo_peru_districts` VALUES ('060413', 'Paccha', '0604', '06');
INSERT INTO `ubigeo_peru_districts` VALUES ('060414', 'Pion', '0604', '06');
INSERT INTO `ubigeo_peru_districts` VALUES ('060415', 'Querocoto', '0604', '06');
INSERT INTO `ubigeo_peru_districts` VALUES ('060416', 'San Juan de Licupis', '0604', '06');
INSERT INTO `ubigeo_peru_districts` VALUES ('060417', 'Tacabamba', '0604', '06');
INSERT INTO `ubigeo_peru_districts` VALUES ('060418', 'Tocmoche', '0604', '06');
INSERT INTO `ubigeo_peru_districts` VALUES ('060419', 'Chalamarca', '0604', '06');
INSERT INTO `ubigeo_peru_districts` VALUES ('060501', 'Contumaza', '0605', '06');
INSERT INTO `ubigeo_peru_districts` VALUES ('060502', 'Chilete', '0605', '06');
INSERT INTO `ubigeo_peru_districts` VALUES ('060503', 'Cupisnique', '0605', '06');
INSERT INTO `ubigeo_peru_districts` VALUES ('060504', 'Guzmango', '0605', '06');
INSERT INTO `ubigeo_peru_districts` VALUES ('060505', 'San Benito', '0605', '06');
INSERT INTO `ubigeo_peru_districts` VALUES ('060506', 'Santa Cruz de Toledo', '0605', '06');
INSERT INTO `ubigeo_peru_districts` VALUES ('060507', 'Tantarica', '0605', '06');
INSERT INTO `ubigeo_peru_districts` VALUES ('060508', 'Yonan', '0605', '06');
INSERT INTO `ubigeo_peru_districts` VALUES ('060601', 'Cutervo', '0606', '06');
INSERT INTO `ubigeo_peru_districts` VALUES ('060602', 'Callayuc', '0606', '06');
INSERT INTO `ubigeo_peru_districts` VALUES ('060603', 'Choros', '0606', '06');
INSERT INTO `ubigeo_peru_districts` VALUES ('060604', 'Cujillo', '0606', '06');
INSERT INTO `ubigeo_peru_districts` VALUES ('060605', 'La Ramada', '0606', '06');
INSERT INTO `ubigeo_peru_districts` VALUES ('060606', 'Pimpingos', '0606', '06');
INSERT INTO `ubigeo_peru_districts` VALUES ('060607', 'Querocotillo', '0606', '06');
INSERT INTO `ubigeo_peru_districts` VALUES ('060608', 'San Andrés de Cutervo', '0606', '06');
INSERT INTO `ubigeo_peru_districts` VALUES ('060609', 'San Juan de Cutervo', '0606', '06');
INSERT INTO `ubigeo_peru_districts` VALUES ('060610', 'San Luis de Lucma', '0606', '06');
INSERT INTO `ubigeo_peru_districts` VALUES ('060611', 'Santa Cruz', '0606', '06');
INSERT INTO `ubigeo_peru_districts` VALUES ('060612', 'Santo Domingo de la Capilla', '0606', '06');
INSERT INTO `ubigeo_peru_districts` VALUES ('060613', 'Santo Tomas', '0606', '06');
INSERT INTO `ubigeo_peru_districts` VALUES ('060614', 'Socota', '0606', '06');
INSERT INTO `ubigeo_peru_districts` VALUES ('060615', 'Toribio Casanova', '0606', '06');
INSERT INTO `ubigeo_peru_districts` VALUES ('060701', 'Bambamarca', '0607', '06');
INSERT INTO `ubigeo_peru_districts` VALUES ('060702', 'Chugur', '0607', '06');
INSERT INTO `ubigeo_peru_districts` VALUES ('060703', 'Hualgayoc', '0607', '06');
INSERT INTO `ubigeo_peru_districts` VALUES ('060801', 'Jaén', '0608', '06');
INSERT INTO `ubigeo_peru_districts` VALUES ('060802', 'Bellavista', '0608', '06');
INSERT INTO `ubigeo_peru_districts` VALUES ('060803', 'Chontali', '0608', '06');
INSERT INTO `ubigeo_peru_districts` VALUES ('060804', 'Colasay', '0608', '06');
INSERT INTO `ubigeo_peru_districts` VALUES ('060805', 'Huabal', '0608', '06');
INSERT INTO `ubigeo_peru_districts` VALUES ('060806', 'Las Pirias', '0608', '06');
INSERT INTO `ubigeo_peru_districts` VALUES ('060807', 'Pomahuaca', '0608', '06');
INSERT INTO `ubigeo_peru_districts` VALUES ('060808', 'Pucara', '0608', '06');
INSERT INTO `ubigeo_peru_districts` VALUES ('060809', 'Sallique', '0608', '06');
INSERT INTO `ubigeo_peru_districts` VALUES ('060810', 'San Felipe', '0608', '06');
INSERT INTO `ubigeo_peru_districts` VALUES ('060811', 'San José del Alto', '0608', '06');
INSERT INTO `ubigeo_peru_districts` VALUES ('060812', 'Santa Rosa', '0608', '06');
INSERT INTO `ubigeo_peru_districts` VALUES ('060901', 'San Ignacio', '0609', '06');
INSERT INTO `ubigeo_peru_districts` VALUES ('060902', 'Chirinos', '0609', '06');
INSERT INTO `ubigeo_peru_districts` VALUES ('060903', 'Huarango', '0609', '06');
INSERT INTO `ubigeo_peru_districts` VALUES ('060904', 'La Coipa', '0609', '06');
INSERT INTO `ubigeo_peru_districts` VALUES ('060905', 'Namballe', '0609', '06');
INSERT INTO `ubigeo_peru_districts` VALUES ('060906', 'San José de Lourdes', '0609', '06');
INSERT INTO `ubigeo_peru_districts` VALUES ('060907', 'Tabaconas', '0609', '06');
INSERT INTO `ubigeo_peru_districts` VALUES ('061001', 'Pedro Gálvez', '0610', '06');
INSERT INTO `ubigeo_peru_districts` VALUES ('061002', 'Chancay', '0610', '06');
INSERT INTO `ubigeo_peru_districts` VALUES ('061003', 'Eduardo Villanueva', '0610', '06');
INSERT INTO `ubigeo_peru_districts` VALUES ('061004', 'Gregorio Pita', '0610', '06');
INSERT INTO `ubigeo_peru_districts` VALUES ('061005', 'Ichocan', '0610', '06');
INSERT INTO `ubigeo_peru_districts` VALUES ('061006', 'José Manuel Quiroz', '0610', '06');
INSERT INTO `ubigeo_peru_districts` VALUES ('061007', 'José Sabogal', '0610', '06');
INSERT INTO `ubigeo_peru_districts` VALUES ('061101', 'San Miguel', '0611', '06');
INSERT INTO `ubigeo_peru_districts` VALUES ('061102', 'Bolívar', '0611', '06');
INSERT INTO `ubigeo_peru_districts` VALUES ('061103', 'Calquis', '0611', '06');
INSERT INTO `ubigeo_peru_districts` VALUES ('061104', 'Catilluc', '0611', '06');
INSERT INTO `ubigeo_peru_districts` VALUES ('061105', 'El Prado', '0611', '06');
INSERT INTO `ubigeo_peru_districts` VALUES ('061106', 'La Florida', '0611', '06');
INSERT INTO `ubigeo_peru_districts` VALUES ('061107', 'Llapa', '0611', '06');
INSERT INTO `ubigeo_peru_districts` VALUES ('061108', 'Nanchoc', '0611', '06');
INSERT INTO `ubigeo_peru_districts` VALUES ('061109', 'Niepos', '0611', '06');
INSERT INTO `ubigeo_peru_districts` VALUES ('061110', 'San Gregorio', '0611', '06');
INSERT INTO `ubigeo_peru_districts` VALUES ('061111', 'San Silvestre de Cochan', '0611', '06');
INSERT INTO `ubigeo_peru_districts` VALUES ('061112', 'Tongod', '0611', '06');
INSERT INTO `ubigeo_peru_districts` VALUES ('061113', 'Unión Agua Blanca', '0611', '06');
INSERT INTO `ubigeo_peru_districts` VALUES ('061201', 'San Pablo', '0612', '06');
INSERT INTO `ubigeo_peru_districts` VALUES ('061202', 'San Bernardino', '0612', '06');
INSERT INTO `ubigeo_peru_districts` VALUES ('061203', 'San Luis', '0612', '06');
INSERT INTO `ubigeo_peru_districts` VALUES ('061204', 'Tumbaden', '0612', '06');
INSERT INTO `ubigeo_peru_districts` VALUES ('061301', 'Santa Cruz', '0613', '06');
INSERT INTO `ubigeo_peru_districts` VALUES ('061302', 'Andabamba', '0613', '06');
INSERT INTO `ubigeo_peru_districts` VALUES ('061303', 'Catache', '0613', '06');
INSERT INTO `ubigeo_peru_districts` VALUES ('061304', 'Chancaybaños', '0613', '06');
INSERT INTO `ubigeo_peru_districts` VALUES ('061305', 'La Esperanza', '0613', '06');
INSERT INTO `ubigeo_peru_districts` VALUES ('061306', 'Ninabamba', '0613', '06');
INSERT INTO `ubigeo_peru_districts` VALUES ('061307', 'Pulan', '0613', '06');
INSERT INTO `ubigeo_peru_districts` VALUES ('061308', 'Saucepampa', '0613', '06');
INSERT INTO `ubigeo_peru_districts` VALUES ('061309', 'Sexi', '0613', '06');
INSERT INTO `ubigeo_peru_districts` VALUES ('061310', 'Uticyacu', '0613', '06');
INSERT INTO `ubigeo_peru_districts` VALUES ('061311', 'Yauyucan', '0613', '06');
INSERT INTO `ubigeo_peru_districts` VALUES ('070101', 'Callao', '0701', '07');
INSERT INTO `ubigeo_peru_districts` VALUES ('070102', 'Bellavista', '0701', '07');
INSERT INTO `ubigeo_peru_districts` VALUES ('070103', 'Carmen de la Legua Reynoso', '0701', '07');
INSERT INTO `ubigeo_peru_districts` VALUES ('070104', 'La Perla', '0701', '07');
INSERT INTO `ubigeo_peru_districts` VALUES ('070105', 'La Punta', '0701', '07');
INSERT INTO `ubigeo_peru_districts` VALUES ('070106', 'Ventanilla', '0701', '07');
INSERT INTO `ubigeo_peru_districts` VALUES ('070107', 'Mi Perú', '0701', '07');
INSERT INTO `ubigeo_peru_districts` VALUES ('080101', 'Cusco', '0801', '08');
INSERT INTO `ubigeo_peru_districts` VALUES ('080102', 'Ccorca', '0801', '08');
INSERT INTO `ubigeo_peru_districts` VALUES ('080103', 'Poroy', '0801', '08');
INSERT INTO `ubigeo_peru_districts` VALUES ('080104', 'San Jerónimo', '0801', '08');
INSERT INTO `ubigeo_peru_districts` VALUES ('080105', 'San Sebastian', '0801', '08');
INSERT INTO `ubigeo_peru_districts` VALUES ('080106', 'Santiago', '0801', '08');
INSERT INTO `ubigeo_peru_districts` VALUES ('080107', 'Saylla', '0801', '08');
INSERT INTO `ubigeo_peru_districts` VALUES ('080108', 'Wanchaq', '0801', '08');
INSERT INTO `ubigeo_peru_districts` VALUES ('080201', 'Acomayo', '0802', '08');
INSERT INTO `ubigeo_peru_districts` VALUES ('080202', 'Acopia', '0802', '08');
INSERT INTO `ubigeo_peru_districts` VALUES ('080203', 'Acos', '0802', '08');
INSERT INTO `ubigeo_peru_districts` VALUES ('080204', 'Mosoc Llacta', '0802', '08');
INSERT INTO `ubigeo_peru_districts` VALUES ('080205', 'Pomacanchi', '0802', '08');
INSERT INTO `ubigeo_peru_districts` VALUES ('080206', 'Rondocan', '0802', '08');
INSERT INTO `ubigeo_peru_districts` VALUES ('080207', 'Sangarara', '0802', '08');
INSERT INTO `ubigeo_peru_districts` VALUES ('080301', 'Anta', '0803', '08');
INSERT INTO `ubigeo_peru_districts` VALUES ('080302', 'Ancahuasi', '0803', '08');
INSERT INTO `ubigeo_peru_districts` VALUES ('080303', 'Cachimayo', '0803', '08');
INSERT INTO `ubigeo_peru_districts` VALUES ('080304', 'Chinchaypujio', '0803', '08');
INSERT INTO `ubigeo_peru_districts` VALUES ('080305', 'Huarocondo', '0803', '08');
INSERT INTO `ubigeo_peru_districts` VALUES ('080306', 'Limatambo', '0803', '08');
INSERT INTO `ubigeo_peru_districts` VALUES ('080307', 'Mollepata', '0803', '08');
INSERT INTO `ubigeo_peru_districts` VALUES ('080308', 'Pucyura', '0803', '08');
INSERT INTO `ubigeo_peru_districts` VALUES ('080309', 'Zurite', '0803', '08');
INSERT INTO `ubigeo_peru_districts` VALUES ('080401', 'Calca', '0804', '08');
INSERT INTO `ubigeo_peru_districts` VALUES ('080402', 'Coya', '0804', '08');
INSERT INTO `ubigeo_peru_districts` VALUES ('080403', 'Lamay', '0804', '08');
INSERT INTO `ubigeo_peru_districts` VALUES ('080404', 'Lares', '0804', '08');
INSERT INTO `ubigeo_peru_districts` VALUES ('080405', 'Pisac', '0804', '08');
INSERT INTO `ubigeo_peru_districts` VALUES ('080406', 'San Salvador', '0804', '08');
INSERT INTO `ubigeo_peru_districts` VALUES ('080407', 'Taray', '0804', '08');
INSERT INTO `ubigeo_peru_districts` VALUES ('080408', 'Yanatile', '0804', '08');
INSERT INTO `ubigeo_peru_districts` VALUES ('080501', 'Yanaoca', '0805', '08');
INSERT INTO `ubigeo_peru_districts` VALUES ('080502', 'Checca', '0805', '08');
INSERT INTO `ubigeo_peru_districts` VALUES ('080503', 'Kunturkanki', '0805', '08');
INSERT INTO `ubigeo_peru_districts` VALUES ('080504', 'Langui', '0805', '08');
INSERT INTO `ubigeo_peru_districts` VALUES ('080505', 'Layo', '0805', '08');
INSERT INTO `ubigeo_peru_districts` VALUES ('080506', 'Pampamarca', '0805', '08');
INSERT INTO `ubigeo_peru_districts` VALUES ('080507', 'Quehue', '0805', '08');
INSERT INTO `ubigeo_peru_districts` VALUES ('080508', 'Tupac Amaru', '0805', '08');
INSERT INTO `ubigeo_peru_districts` VALUES ('080601', 'Sicuani', '0806', '08');
INSERT INTO `ubigeo_peru_districts` VALUES ('080602', 'Checacupe', '0806', '08');
INSERT INTO `ubigeo_peru_districts` VALUES ('080603', 'Combapata', '0806', '08');
INSERT INTO `ubigeo_peru_districts` VALUES ('080604', 'Marangani', '0806', '08');
INSERT INTO `ubigeo_peru_districts` VALUES ('080605', 'Pitumarca', '0806', '08');
INSERT INTO `ubigeo_peru_districts` VALUES ('080606', 'San Pablo', '0806', '08');
INSERT INTO `ubigeo_peru_districts` VALUES ('080607', 'San Pedro', '0806', '08');
INSERT INTO `ubigeo_peru_districts` VALUES ('080608', 'Tinta', '0806', '08');
INSERT INTO `ubigeo_peru_districts` VALUES ('080701', 'Santo Tomas', '0807', '08');
INSERT INTO `ubigeo_peru_districts` VALUES ('080702', 'Capacmarca', '0807', '08');
INSERT INTO `ubigeo_peru_districts` VALUES ('080703', 'Chamaca', '0807', '08');
INSERT INTO `ubigeo_peru_districts` VALUES ('080704', 'Colquemarca', '0807', '08');
INSERT INTO `ubigeo_peru_districts` VALUES ('080705', 'Livitaca', '0807', '08');
INSERT INTO `ubigeo_peru_districts` VALUES ('080706', 'Llusco', '0807', '08');
INSERT INTO `ubigeo_peru_districts` VALUES ('080707', 'Quiñota', '0807', '08');
INSERT INTO `ubigeo_peru_districts` VALUES ('080708', 'Velille', '0807', '08');
INSERT INTO `ubigeo_peru_districts` VALUES ('080801', 'Espinar', '0808', '08');
INSERT INTO `ubigeo_peru_districts` VALUES ('080802', 'Condoroma', '0808', '08');
INSERT INTO `ubigeo_peru_districts` VALUES ('080803', 'Coporaque', '0808', '08');
INSERT INTO `ubigeo_peru_districts` VALUES ('080804', 'Ocoruro', '0808', '08');
INSERT INTO `ubigeo_peru_districts` VALUES ('080805', 'Pallpata', '0808', '08');
INSERT INTO `ubigeo_peru_districts` VALUES ('080806', 'Pichigua', '0808', '08');
INSERT INTO `ubigeo_peru_districts` VALUES ('080807', 'Suyckutambo', '0808', '08');
INSERT INTO `ubigeo_peru_districts` VALUES ('080808', 'Alto Pichigua', '0808', '08');
INSERT INTO `ubigeo_peru_districts` VALUES ('080901', 'Santa Ana', '0809', '08');
INSERT INTO `ubigeo_peru_districts` VALUES ('080902', 'Echarate', '0809', '08');
INSERT INTO `ubigeo_peru_districts` VALUES ('080903', 'Huayopata', '0809', '08');
INSERT INTO `ubigeo_peru_districts` VALUES ('080904', 'Maranura', '0809', '08');
INSERT INTO `ubigeo_peru_districts` VALUES ('080905', 'Ocobamba', '0809', '08');
INSERT INTO `ubigeo_peru_districts` VALUES ('080906', 'Quellouno', '0809', '08');
INSERT INTO `ubigeo_peru_districts` VALUES ('080907', 'Kimbiri', '0809', '08');
INSERT INTO `ubigeo_peru_districts` VALUES ('080908', 'Santa Teresa', '0809', '08');
INSERT INTO `ubigeo_peru_districts` VALUES ('080909', 'Vilcabamba', '0809', '08');
INSERT INTO `ubigeo_peru_districts` VALUES ('080910', 'Pichari', '0809', '08');
INSERT INTO `ubigeo_peru_districts` VALUES ('080911', 'Inkawasi', '0809', '08');
INSERT INTO `ubigeo_peru_districts` VALUES ('080912', 'Villa Virgen', '0809', '08');
INSERT INTO `ubigeo_peru_districts` VALUES ('080913', 'Villa Kintiarina', '0809', '08');
INSERT INTO `ubigeo_peru_districts` VALUES ('080914', 'Megantoni', '0809', '08');
INSERT INTO `ubigeo_peru_districts` VALUES ('081001', 'Paruro', '0810', '08');
INSERT INTO `ubigeo_peru_districts` VALUES ('081002', 'Accha', '0810', '08');
INSERT INTO `ubigeo_peru_districts` VALUES ('081003', 'Ccapi', '0810', '08');
INSERT INTO `ubigeo_peru_districts` VALUES ('081004', 'Colcha', '0810', '08');
INSERT INTO `ubigeo_peru_districts` VALUES ('081005', 'Huanoquite', '0810', '08');
INSERT INTO `ubigeo_peru_districts` VALUES ('081006', 'Omachaç', '0810', '08');
INSERT INTO `ubigeo_peru_districts` VALUES ('081007', 'Paccaritambo', '0810', '08');
INSERT INTO `ubigeo_peru_districts` VALUES ('081008', 'Pillpinto', '0810', '08');
INSERT INTO `ubigeo_peru_districts` VALUES ('081009', 'Yaurisque', '0810', '08');
INSERT INTO `ubigeo_peru_districts` VALUES ('081101', 'Paucartambo', '0811', '08');
INSERT INTO `ubigeo_peru_districts` VALUES ('081102', 'Caicay', '0811', '08');
INSERT INTO `ubigeo_peru_districts` VALUES ('081103', 'Challabamba', '0811', '08');
INSERT INTO `ubigeo_peru_districts` VALUES ('081104', 'Colquepata', '0811', '08');
INSERT INTO `ubigeo_peru_districts` VALUES ('081105', 'Huancarani', '0811', '08');
INSERT INTO `ubigeo_peru_districts` VALUES ('081106', 'Kosñipata', '0811', '08');
INSERT INTO `ubigeo_peru_districts` VALUES ('081201', 'Urcos', '0812', '08');
INSERT INTO `ubigeo_peru_districts` VALUES ('081202', 'Andahuaylillas', '0812', '08');
INSERT INTO `ubigeo_peru_districts` VALUES ('081203', 'Camanti', '0812', '08');
INSERT INTO `ubigeo_peru_districts` VALUES ('081204', 'Ccarhuayo', '0812', '08');
INSERT INTO `ubigeo_peru_districts` VALUES ('081205', 'Ccatca', '0812', '08');
INSERT INTO `ubigeo_peru_districts` VALUES ('081206', 'Cusipata', '0812', '08');
INSERT INTO `ubigeo_peru_districts` VALUES ('081207', 'Huaro', '0812', '08');
INSERT INTO `ubigeo_peru_districts` VALUES ('081208', 'Lucre', '0812', '08');
INSERT INTO `ubigeo_peru_districts` VALUES ('081209', 'Marcapata', '0812', '08');
INSERT INTO `ubigeo_peru_districts` VALUES ('081210', 'Ocongate', '0812', '08');
INSERT INTO `ubigeo_peru_districts` VALUES ('081211', 'Oropesa', '0812', '08');
INSERT INTO `ubigeo_peru_districts` VALUES ('081212', 'Quiquijana', '0812', '08');
INSERT INTO `ubigeo_peru_districts` VALUES ('081301', 'Urubamba', '0813', '08');
INSERT INTO `ubigeo_peru_districts` VALUES ('081302', 'Chinchero', '0813', '08');
INSERT INTO `ubigeo_peru_districts` VALUES ('081303', 'Huayllabamba', '0813', '08');
INSERT INTO `ubigeo_peru_districts` VALUES ('081304', 'Machupicchu', '0813', '08');
INSERT INTO `ubigeo_peru_districts` VALUES ('081305', 'Maras', '0813', '08');
INSERT INTO `ubigeo_peru_districts` VALUES ('081306', 'Ollantaytambo', '0813', '08');
INSERT INTO `ubigeo_peru_districts` VALUES ('081307', 'Yucay', '0813', '08');
INSERT INTO `ubigeo_peru_districts` VALUES ('090101', 'Huancavelica', '0901', '09');
INSERT INTO `ubigeo_peru_districts` VALUES ('090102', 'Acobambilla', '0901', '09');
INSERT INTO `ubigeo_peru_districts` VALUES ('090103', 'Acoria', '0901', '09');
INSERT INTO `ubigeo_peru_districts` VALUES ('090104', 'Conayca', '0901', '09');
INSERT INTO `ubigeo_peru_districts` VALUES ('090105', 'Cuenca', '0901', '09');
INSERT INTO `ubigeo_peru_districts` VALUES ('090106', 'Huachocolpa', '0901', '09');
INSERT INTO `ubigeo_peru_districts` VALUES ('090107', 'Huayllahuara', '0901', '09');
INSERT INTO `ubigeo_peru_districts` VALUES ('090108', 'Izcuchaca', '0901', '09');
INSERT INTO `ubigeo_peru_districts` VALUES ('090109', 'Laria', '0901', '09');
INSERT INTO `ubigeo_peru_districts` VALUES ('090110', 'Manta', '0901', '09');
INSERT INTO `ubigeo_peru_districts` VALUES ('090111', 'Mariscal Cáceres', '0901', '09');
INSERT INTO `ubigeo_peru_districts` VALUES ('090112', 'Moya', '0901', '09');
INSERT INTO `ubigeo_peru_districts` VALUES ('090113', 'Nuevo Occoro', '0901', '09');
INSERT INTO `ubigeo_peru_districts` VALUES ('090114', 'Palca', '0901', '09');
INSERT INTO `ubigeo_peru_districts` VALUES ('090115', 'Pilchaca', '0901', '09');
INSERT INTO `ubigeo_peru_districts` VALUES ('090116', 'Vilca', '0901', '09');
INSERT INTO `ubigeo_peru_districts` VALUES ('090117', 'Yauli', '0901', '09');
INSERT INTO `ubigeo_peru_districts` VALUES ('090118', 'Ascensión', '0901', '09');
INSERT INTO `ubigeo_peru_districts` VALUES ('090119', 'Huando', '0901', '09');
INSERT INTO `ubigeo_peru_districts` VALUES ('090201', 'Acobamba', '0902', '09');
INSERT INTO `ubigeo_peru_districts` VALUES ('090202', 'Andabamba', '0902', '09');
INSERT INTO `ubigeo_peru_districts` VALUES ('090203', 'Anta', '0902', '09');
INSERT INTO `ubigeo_peru_districts` VALUES ('090204', 'Caja', '0902', '09');
INSERT INTO `ubigeo_peru_districts` VALUES ('090205', 'Marcas', '0902', '09');
INSERT INTO `ubigeo_peru_districts` VALUES ('090206', 'Paucara', '0902', '09');
INSERT INTO `ubigeo_peru_districts` VALUES ('090207', 'Pomacocha', '0902', '09');
INSERT INTO `ubigeo_peru_districts` VALUES ('090208', 'Rosario', '0902', '09');
INSERT INTO `ubigeo_peru_districts` VALUES ('090301', 'Lircay', '0903', '09');
INSERT INTO `ubigeo_peru_districts` VALUES ('090302', 'Anchonga', '0903', '09');
INSERT INTO `ubigeo_peru_districts` VALUES ('090303', 'Callanmarca', '0903', '09');
INSERT INTO `ubigeo_peru_districts` VALUES ('090304', 'Ccochaccasa', '0903', '09');
INSERT INTO `ubigeo_peru_districts` VALUES ('090305', 'Chincho', '0903', '09');
INSERT INTO `ubigeo_peru_districts` VALUES ('090306', 'Congalla', '0903', '09');
INSERT INTO `ubigeo_peru_districts` VALUES ('090307', 'Huanca-Huanca', '0903', '09');
INSERT INTO `ubigeo_peru_districts` VALUES ('090308', 'Huayllay Grande', '0903', '09');
INSERT INTO `ubigeo_peru_districts` VALUES ('090309', 'Julcamarca', '0903', '09');
INSERT INTO `ubigeo_peru_districts` VALUES ('090310', 'San Antonio de Antaparco', '0903', '09');
INSERT INTO `ubigeo_peru_districts` VALUES ('090311', 'Santo Tomas de Pata', '0903', '09');
INSERT INTO `ubigeo_peru_districts` VALUES ('090312', 'Secclla', '0903', '09');
INSERT INTO `ubigeo_peru_districts` VALUES ('090401', 'Castrovirreyna', '0904', '09');
INSERT INTO `ubigeo_peru_districts` VALUES ('090402', 'Arma', '0904', '09');
INSERT INTO `ubigeo_peru_districts` VALUES ('090403', 'Aurahua', '0904', '09');
INSERT INTO `ubigeo_peru_districts` VALUES ('090404', 'Capillas', '0904', '09');
INSERT INTO `ubigeo_peru_districts` VALUES ('090405', 'Chupamarca', '0904', '09');
INSERT INTO `ubigeo_peru_districts` VALUES ('090406', 'Cocas', '0904', '09');
INSERT INTO `ubigeo_peru_districts` VALUES ('090407', 'Huachos', '0904', '09');
INSERT INTO `ubigeo_peru_districts` VALUES ('090408', 'Huamatambo', '0904', '09');
INSERT INTO `ubigeo_peru_districts` VALUES ('090409', 'Mollepampa', '0904', '09');
INSERT INTO `ubigeo_peru_districts` VALUES ('090410', 'San Juan', '0904', '09');
INSERT INTO `ubigeo_peru_districts` VALUES ('090411', 'Santa Ana', '0904', '09');
INSERT INTO `ubigeo_peru_districts` VALUES ('090412', 'Tantara', '0904', '09');
INSERT INTO `ubigeo_peru_districts` VALUES ('090413', 'Ticrapo', '0904', '09');
INSERT INTO `ubigeo_peru_districts` VALUES ('090501', 'Churcampa', '0905', '09');
INSERT INTO `ubigeo_peru_districts` VALUES ('090502', 'Anco', '0905', '09');
INSERT INTO `ubigeo_peru_districts` VALUES ('090503', 'Chinchihuasi', '0905', '09');
INSERT INTO `ubigeo_peru_districts` VALUES ('090504', 'El Carmen', '0905', '09');
INSERT INTO `ubigeo_peru_districts` VALUES ('090505', 'La Merced', '0905', '09');
INSERT INTO `ubigeo_peru_districts` VALUES ('090506', 'Locroja', '0905', '09');
INSERT INTO `ubigeo_peru_districts` VALUES ('090507', 'Paucarbamba', '0905', '09');
INSERT INTO `ubigeo_peru_districts` VALUES ('090508', 'San Miguel de Mayocc', '0905', '09');
INSERT INTO `ubigeo_peru_districts` VALUES ('090509', 'San Pedro de Coris', '0905', '09');
INSERT INTO `ubigeo_peru_districts` VALUES ('090510', 'Pachamarca', '0905', '09');
INSERT INTO `ubigeo_peru_districts` VALUES ('090511', 'Cosme', '0905', '09');
INSERT INTO `ubigeo_peru_districts` VALUES ('090601', 'Huaytara', '0906', '09');
INSERT INTO `ubigeo_peru_districts` VALUES ('090602', 'Ayavi', '0906', '09');
INSERT INTO `ubigeo_peru_districts` VALUES ('090603', 'Córdova', '0906', '09');
INSERT INTO `ubigeo_peru_districts` VALUES ('090604', 'Huayacundo Arma', '0906', '09');
INSERT INTO `ubigeo_peru_districts` VALUES ('090605', 'Laramarca', '0906', '09');
INSERT INTO `ubigeo_peru_districts` VALUES ('090606', 'Ocoyo', '0906', '09');
INSERT INTO `ubigeo_peru_districts` VALUES ('090607', 'Pilpichaca', '0906', '09');
INSERT INTO `ubigeo_peru_districts` VALUES ('090608', 'Querco', '0906', '09');
INSERT INTO `ubigeo_peru_districts` VALUES ('090609', 'Quito-Arma', '0906', '09');
INSERT INTO `ubigeo_peru_districts` VALUES ('090610', 'San Antonio de Cusicancha', '0906', '09');
INSERT INTO `ubigeo_peru_districts` VALUES ('090611', 'San Francisco de Sangayaico', '0906', '09');
INSERT INTO `ubigeo_peru_districts` VALUES ('090612', 'San Isidro', '0906', '09');
INSERT INTO `ubigeo_peru_districts` VALUES ('090613', 'Santiago de Chocorvos', '0906', '09');
INSERT INTO `ubigeo_peru_districts` VALUES ('090614', 'Santiago de Quirahuara', '0906', '09');
INSERT INTO `ubigeo_peru_districts` VALUES ('090615', 'Santo Domingo de Capillas', '0906', '09');
INSERT INTO `ubigeo_peru_districts` VALUES ('090616', 'Tambo', '0906', '09');
INSERT INTO `ubigeo_peru_districts` VALUES ('090701', 'Pampas', '0907', '09');
INSERT INTO `ubigeo_peru_districts` VALUES ('090702', 'Acostambo', '0907', '09');
INSERT INTO `ubigeo_peru_districts` VALUES ('090703', 'Acraquia', '0907', '09');
INSERT INTO `ubigeo_peru_districts` VALUES ('090704', 'Ahuaycha', '0907', '09');
INSERT INTO `ubigeo_peru_districts` VALUES ('090705', 'Colcabamba', '0907', '09');
INSERT INTO `ubigeo_peru_districts` VALUES ('090706', 'Daniel Hernández', '0907', '09');
INSERT INTO `ubigeo_peru_districts` VALUES ('090707', 'Huachocolpa', '0907', '09');
INSERT INTO `ubigeo_peru_districts` VALUES ('090709', 'Huaribamba', '0907', '09');
INSERT INTO `ubigeo_peru_districts` VALUES ('090710', 'Ñahuimpuquio', '0907', '09');
INSERT INTO `ubigeo_peru_districts` VALUES ('090711', 'Pazos', '0907', '09');
INSERT INTO `ubigeo_peru_districts` VALUES ('090713', 'Quishuar', '0907', '09');
INSERT INTO `ubigeo_peru_districts` VALUES ('090714', 'Salcabamba', '0907', '09');
INSERT INTO `ubigeo_peru_districts` VALUES ('090715', 'Salcahuasi', '0907', '09');
INSERT INTO `ubigeo_peru_districts` VALUES ('090716', 'San Marcos de Rocchac', '0907', '09');
INSERT INTO `ubigeo_peru_districts` VALUES ('090717', 'Surcubamba', '0907', '09');
INSERT INTO `ubigeo_peru_districts` VALUES ('090718', 'Tintay Puncu', '0907', '09');
INSERT INTO `ubigeo_peru_districts` VALUES ('090719', 'Quichuas', '0907', '09');
INSERT INTO `ubigeo_peru_districts` VALUES ('090720', 'Andaymarca', '0907', '09');
INSERT INTO `ubigeo_peru_districts` VALUES ('090721', 'Roble', '0907', '09');
INSERT INTO `ubigeo_peru_districts` VALUES ('090722', 'Pichos', '0907', '09');
INSERT INTO `ubigeo_peru_districts` VALUES ('090723', 'Santiago de Tucuma', '0907', '09');
INSERT INTO `ubigeo_peru_districts` VALUES ('100101', 'Huanuco', '1001', '10');
INSERT INTO `ubigeo_peru_districts` VALUES ('100102', 'Amarilis', '1001', '10');
INSERT INTO `ubigeo_peru_districts` VALUES ('100103', 'Chinchao', '1001', '10');
INSERT INTO `ubigeo_peru_districts` VALUES ('100104', 'Churubamba', '1001', '10');
INSERT INTO `ubigeo_peru_districts` VALUES ('100105', 'Margos', '1001', '10');
INSERT INTO `ubigeo_peru_districts` VALUES ('100106', 'Quisqui (Kichki)', '1001', '10');
INSERT INTO `ubigeo_peru_districts` VALUES ('100107', 'San Francisco de Cayran', '1001', '10');
INSERT INTO `ubigeo_peru_districts` VALUES ('100108', 'San Pedro de Chaulan', '1001', '10');
INSERT INTO `ubigeo_peru_districts` VALUES ('100109', 'Santa María del Valle', '1001', '10');
INSERT INTO `ubigeo_peru_districts` VALUES ('100110', 'Yarumayo', '1001', '10');
INSERT INTO `ubigeo_peru_districts` VALUES ('100111', 'Pillco Marca', '1001', '10');
INSERT INTO `ubigeo_peru_districts` VALUES ('100112', 'Yacus', '1001', '10');
INSERT INTO `ubigeo_peru_districts` VALUES ('100113', 'San Pablo de Pillao', '1001', '10');
INSERT INTO `ubigeo_peru_districts` VALUES ('100201', 'Ambo', '1002', '10');
INSERT INTO `ubigeo_peru_districts` VALUES ('100202', 'Cayna', '1002', '10');
INSERT INTO `ubigeo_peru_districts` VALUES ('100203', 'Colpas', '1002', '10');
INSERT INTO `ubigeo_peru_districts` VALUES ('100204', 'Conchamarca', '1002', '10');
INSERT INTO `ubigeo_peru_districts` VALUES ('100205', 'Huacar', '1002', '10');
INSERT INTO `ubigeo_peru_districts` VALUES ('100206', 'San Francisco', '1002', '10');
INSERT INTO `ubigeo_peru_districts` VALUES ('100207', 'San Rafael', '1002', '10');
INSERT INTO `ubigeo_peru_districts` VALUES ('100208', 'Tomay Kichwa', '1002', '10');
INSERT INTO `ubigeo_peru_districts` VALUES ('100301', 'La Unión', '1003', '10');
INSERT INTO `ubigeo_peru_districts` VALUES ('100307', 'Chuquis', '1003', '10');
INSERT INTO `ubigeo_peru_districts` VALUES ('100311', 'Marías', '1003', '10');
INSERT INTO `ubigeo_peru_districts` VALUES ('100313', 'Pachas', '1003', '10');
INSERT INTO `ubigeo_peru_districts` VALUES ('100316', 'Quivilla', '1003', '10');
INSERT INTO `ubigeo_peru_districts` VALUES ('100317', 'Ripan', '1003', '10');
INSERT INTO `ubigeo_peru_districts` VALUES ('100321', 'Shunqui', '1003', '10');
INSERT INTO `ubigeo_peru_districts` VALUES ('100322', 'Sillapata', '1003', '10');
INSERT INTO `ubigeo_peru_districts` VALUES ('100323', 'Yanas', '1003', '10');
INSERT INTO `ubigeo_peru_districts` VALUES ('100401', 'Huacaybamba', '1004', '10');
INSERT INTO `ubigeo_peru_districts` VALUES ('100402', 'Canchabamba', '1004', '10');
INSERT INTO `ubigeo_peru_districts` VALUES ('100403', 'Cochabamba', '1004', '10');
INSERT INTO `ubigeo_peru_districts` VALUES ('100404', 'Pinra', '1004', '10');
INSERT INTO `ubigeo_peru_districts` VALUES ('100501', 'Llata', '1005', '10');
INSERT INTO `ubigeo_peru_districts` VALUES ('100502', 'Arancay', '1005', '10');
INSERT INTO `ubigeo_peru_districts` VALUES ('100503', 'Chavín de Pariarca', '1005', '10');
INSERT INTO `ubigeo_peru_districts` VALUES ('100504', 'Jacas Grande', '1005', '10');
INSERT INTO `ubigeo_peru_districts` VALUES ('100505', 'Jircan', '1005', '10');
INSERT INTO `ubigeo_peru_districts` VALUES ('100506', 'Miraflores', '1005', '10');
INSERT INTO `ubigeo_peru_districts` VALUES ('100507', 'Monzón', '1005', '10');
INSERT INTO `ubigeo_peru_districts` VALUES ('100508', 'Punchao', '1005', '10');
INSERT INTO `ubigeo_peru_districts` VALUES ('100509', 'Puños', '1005', '10');
INSERT INTO `ubigeo_peru_districts` VALUES ('100510', 'Singa', '1005', '10');
INSERT INTO `ubigeo_peru_districts` VALUES ('100511', 'Tantamayo', '1005', '10');
INSERT INTO `ubigeo_peru_districts` VALUES ('100601', 'Rupa-Rupa', '1006', '10');
INSERT INTO `ubigeo_peru_districts` VALUES ('100602', 'Daniel Alomía Robles', '1006', '10');
INSERT INTO `ubigeo_peru_districts` VALUES ('100603', 'Hermílio Valdizan', '1006', '10');
INSERT INTO `ubigeo_peru_districts` VALUES ('100604', 'José Crespo y Castillo', '1006', '10');
INSERT INTO `ubigeo_peru_districts` VALUES ('100605', 'Luyando', '1006', '10');
INSERT INTO `ubigeo_peru_districts` VALUES ('100606', 'Mariano Damaso Beraun', '1006', '10');
INSERT INTO `ubigeo_peru_districts` VALUES ('100607', 'Pucayacu', '1006', '10');
INSERT INTO `ubigeo_peru_districts` VALUES ('100608', 'Castillo Grande', '1006', '10');
INSERT INTO `ubigeo_peru_districts` VALUES ('100609', 'Pueblo Nuevo', '1006', '10');
INSERT INTO `ubigeo_peru_districts` VALUES ('100610', 'Santo Domingo de Anda', '1006', '10');
INSERT INTO `ubigeo_peru_districts` VALUES ('100701', 'Huacrachuco', '1007', '10');
INSERT INTO `ubigeo_peru_districts` VALUES ('100702', 'Cholon', '1007', '10');
INSERT INTO `ubigeo_peru_districts` VALUES ('100703', 'San Buenaventura', '1007', '10');
INSERT INTO `ubigeo_peru_districts` VALUES ('100704', 'La Morada', '1007', '10');
INSERT INTO `ubigeo_peru_districts` VALUES ('100705', 'Santa Rosa de Alto Yanajanca', '1007', '10');
INSERT INTO `ubigeo_peru_districts` VALUES ('100801', 'Panao', '1008', '10');
INSERT INTO `ubigeo_peru_districts` VALUES ('100802', 'Chaglla', '1008', '10');
INSERT INTO `ubigeo_peru_districts` VALUES ('100803', 'Molino', '1008', '10');
INSERT INTO `ubigeo_peru_districts` VALUES ('100804', 'Umari', '1008', '10');
INSERT INTO `ubigeo_peru_districts` VALUES ('100901', 'Puerto Inca', '1009', '10');
INSERT INTO `ubigeo_peru_districts` VALUES ('100902', 'Codo del Pozuzo', '1009', '10');
INSERT INTO `ubigeo_peru_districts` VALUES ('100903', 'Honoria', '1009', '10');
INSERT INTO `ubigeo_peru_districts` VALUES ('100904', 'Tournavista', '1009', '10');
INSERT INTO `ubigeo_peru_districts` VALUES ('100905', 'Yuyapichis', '1009', '10');
INSERT INTO `ubigeo_peru_districts` VALUES ('101001', 'Jesús', '1010', '10');
INSERT INTO `ubigeo_peru_districts` VALUES ('101002', 'Baños', '1010', '10');
INSERT INTO `ubigeo_peru_districts` VALUES ('101003', 'Jivia', '1010', '10');
INSERT INTO `ubigeo_peru_districts` VALUES ('101004', 'Queropalca', '1010', '10');
INSERT INTO `ubigeo_peru_districts` VALUES ('101005', 'Rondos', '1010', '10');
INSERT INTO `ubigeo_peru_districts` VALUES ('101006', 'San Francisco de Asís', '1010', '10');
INSERT INTO `ubigeo_peru_districts` VALUES ('101007', 'San Miguel de Cauri', '1010', '10');
INSERT INTO `ubigeo_peru_districts` VALUES ('101101', 'Chavinillo', '1011', '10');
INSERT INTO `ubigeo_peru_districts` VALUES ('101102', 'Cahuac', '1011', '10');
INSERT INTO `ubigeo_peru_districts` VALUES ('101103', 'Chacabamba', '1011', '10');
INSERT INTO `ubigeo_peru_districts` VALUES ('101104', 'Aparicio Pomares', '1011', '10');
INSERT INTO `ubigeo_peru_districts` VALUES ('101105', 'Jacas Chico', '1011', '10');
INSERT INTO `ubigeo_peru_districts` VALUES ('101106', 'Obas', '1011', '10');
INSERT INTO `ubigeo_peru_districts` VALUES ('101107', 'Pampamarca', '1011', '10');
INSERT INTO `ubigeo_peru_districts` VALUES ('101108', 'Choras', '1011', '10');
INSERT INTO `ubigeo_peru_districts` VALUES ('110101', 'Ica', '1101', '11');
INSERT INTO `ubigeo_peru_districts` VALUES ('110102', 'La Tinguiña', '1101', '11');
INSERT INTO `ubigeo_peru_districts` VALUES ('110103', 'Los Aquijes', '1101', '11');
INSERT INTO `ubigeo_peru_districts` VALUES ('110104', 'Ocucaje', '1101', '11');
INSERT INTO `ubigeo_peru_districts` VALUES ('110105', 'Pachacutec', '1101', '11');
INSERT INTO `ubigeo_peru_districts` VALUES ('110106', 'Parcona', '1101', '11');
INSERT INTO `ubigeo_peru_districts` VALUES ('110107', 'Pueblo Nuevo', '1101', '11');
INSERT INTO `ubigeo_peru_districts` VALUES ('110108', 'Salas', '1101', '11');
INSERT INTO `ubigeo_peru_districts` VALUES ('110109', 'San José de Los Molinos', '1101', '11');
INSERT INTO `ubigeo_peru_districts` VALUES ('110110', 'San Juan Bautista', '1101', '11');
INSERT INTO `ubigeo_peru_districts` VALUES ('110111', 'Santiago', '1101', '11');
INSERT INTO `ubigeo_peru_districts` VALUES ('110112', 'Subtanjalla', '1101', '11');
INSERT INTO `ubigeo_peru_districts` VALUES ('110113', 'Tate', '1101', '11');
INSERT INTO `ubigeo_peru_districts` VALUES ('110114', 'Yauca del Rosario', '1101', '11');
INSERT INTO `ubigeo_peru_districts` VALUES ('110201', 'Chincha Alta', '1102', '11');
INSERT INTO `ubigeo_peru_districts` VALUES ('110202', 'Alto Laran', '1102', '11');
INSERT INTO `ubigeo_peru_districts` VALUES ('110203', 'Chavin', '1102', '11');
INSERT INTO `ubigeo_peru_districts` VALUES ('110204', 'Chincha Baja', '1102', '11');
INSERT INTO `ubigeo_peru_districts` VALUES ('110205', 'El Carmen', '1102', '11');
INSERT INTO `ubigeo_peru_districts` VALUES ('110206', 'Grocio Prado', '1102', '11');
INSERT INTO `ubigeo_peru_districts` VALUES ('110207', 'Pueblo Nuevo', '1102', '11');
INSERT INTO `ubigeo_peru_districts` VALUES ('110208', 'San Juan de Yanac', '1102', '11');
INSERT INTO `ubigeo_peru_districts` VALUES ('110209', 'San Pedro de Huacarpana', '1102', '11');
INSERT INTO `ubigeo_peru_districts` VALUES ('110210', 'Sunampe', '1102', '11');
INSERT INTO `ubigeo_peru_districts` VALUES ('110211', 'Tambo de Mora', '1102', '11');
INSERT INTO `ubigeo_peru_districts` VALUES ('110301', 'Nasca', '1103', '11');
INSERT INTO `ubigeo_peru_districts` VALUES ('110302', 'Changuillo', '1103', '11');
INSERT INTO `ubigeo_peru_districts` VALUES ('110303', 'El Ingenio', '1103', '11');
INSERT INTO `ubigeo_peru_districts` VALUES ('110304', 'Marcona', '1103', '11');
INSERT INTO `ubigeo_peru_districts` VALUES ('110305', 'Vista Alegre', '1103', '11');
INSERT INTO `ubigeo_peru_districts` VALUES ('110401', 'Palpa', '1104', '11');
INSERT INTO `ubigeo_peru_districts` VALUES ('110402', 'Llipata', '1104', '11');
INSERT INTO `ubigeo_peru_districts` VALUES ('110403', 'Río Grande', '1104', '11');
INSERT INTO `ubigeo_peru_districts` VALUES ('110404', 'Santa Cruz', '1104', '11');
INSERT INTO `ubigeo_peru_districts` VALUES ('110405', 'Tibillo', '1104', '11');
INSERT INTO `ubigeo_peru_districts` VALUES ('110501', 'Pisco', '1105', '11');
INSERT INTO `ubigeo_peru_districts` VALUES ('110502', 'Huancano', '1105', '11');
INSERT INTO `ubigeo_peru_districts` VALUES ('110503', 'Humay', '1105', '11');
INSERT INTO `ubigeo_peru_districts` VALUES ('110504', 'Independencia', '1105', '11');
INSERT INTO `ubigeo_peru_districts` VALUES ('110505', 'Paracas', '1105', '11');
INSERT INTO `ubigeo_peru_districts` VALUES ('110506', 'San Andrés', '1105', '11');
INSERT INTO `ubigeo_peru_districts` VALUES ('110507', 'San Clemente', '1105', '11');
INSERT INTO `ubigeo_peru_districts` VALUES ('110508', 'Tupac Amaru Inca', '1105', '11');
INSERT INTO `ubigeo_peru_districts` VALUES ('120101', 'Huancayo', '1201', '12');
INSERT INTO `ubigeo_peru_districts` VALUES ('120104', 'Carhuacallanga', '1201', '12');
INSERT INTO `ubigeo_peru_districts` VALUES ('120105', 'Chacapampa', '1201', '12');
INSERT INTO `ubigeo_peru_districts` VALUES ('120106', 'Chicche', '1201', '12');
INSERT INTO `ubigeo_peru_districts` VALUES ('120107', 'Chilca', '1201', '12');
INSERT INTO `ubigeo_peru_districts` VALUES ('120108', 'Chongos Alto', '1201', '12');
INSERT INTO `ubigeo_peru_districts` VALUES ('120111', 'Chupuro', '1201', '12');
INSERT INTO `ubigeo_peru_districts` VALUES ('120112', 'Colca', '1201', '12');
INSERT INTO `ubigeo_peru_districts` VALUES ('120113', 'Cullhuas', '1201', '12');
INSERT INTO `ubigeo_peru_districts` VALUES ('120114', 'El Tambo', '1201', '12');
INSERT INTO `ubigeo_peru_districts` VALUES ('120116', 'Huacrapuquio', '1201', '12');
INSERT INTO `ubigeo_peru_districts` VALUES ('120117', 'Hualhuas', '1201', '12');
INSERT INTO `ubigeo_peru_districts` VALUES ('120119', 'Huancan', '1201', '12');
INSERT INTO `ubigeo_peru_districts` VALUES ('120120', 'Huasicancha', '1201', '12');
INSERT INTO `ubigeo_peru_districts` VALUES ('120121', 'Huayucachi', '1201', '12');
INSERT INTO `ubigeo_peru_districts` VALUES ('120122', 'Ingenio', '1201', '12');
INSERT INTO `ubigeo_peru_districts` VALUES ('120124', 'Pariahuanca', '1201', '12');
INSERT INTO `ubigeo_peru_districts` VALUES ('120125', 'Pilcomayo', '1201', '12');
INSERT INTO `ubigeo_peru_districts` VALUES ('120126', 'Pucara', '1201', '12');
INSERT INTO `ubigeo_peru_districts` VALUES ('120127', 'Quichuay', '1201', '12');
INSERT INTO `ubigeo_peru_districts` VALUES ('120128', 'Quilcas', '1201', '12');
INSERT INTO `ubigeo_peru_districts` VALUES ('120129', 'San Agustín', '1201', '12');
INSERT INTO `ubigeo_peru_districts` VALUES ('120130', 'San Jerónimo de Tunan', '1201', '12');
INSERT INTO `ubigeo_peru_districts` VALUES ('120132', 'Saño', '1201', '12');
INSERT INTO `ubigeo_peru_districts` VALUES ('120133', 'Sapallanga', '1201', '12');
INSERT INTO `ubigeo_peru_districts` VALUES ('120134', 'Sicaya', '1201', '12');
INSERT INTO `ubigeo_peru_districts` VALUES ('120135', 'Santo Domingo de Acobamba', '1201', '12');
INSERT INTO `ubigeo_peru_districts` VALUES ('120136', 'Viques', '1201', '12');
INSERT INTO `ubigeo_peru_districts` VALUES ('120201', 'Concepción', '1202', '12');
INSERT INTO `ubigeo_peru_districts` VALUES ('120202', 'Aco', '1202', '12');
INSERT INTO `ubigeo_peru_districts` VALUES ('120203', 'Andamarca', '1202', '12');
INSERT INTO `ubigeo_peru_districts` VALUES ('120204', 'Chambara', '1202', '12');
INSERT INTO `ubigeo_peru_districts` VALUES ('120205', 'Cochas', '1202', '12');
INSERT INTO `ubigeo_peru_districts` VALUES ('120206', 'Comas', '1202', '12');
INSERT INTO `ubigeo_peru_districts` VALUES ('120207', 'Heroínas Toledo', '1202', '12');
INSERT INTO `ubigeo_peru_districts` VALUES ('120208', 'Manzanares', '1202', '12');
INSERT INTO `ubigeo_peru_districts` VALUES ('120209', 'Mariscal Castilla', '1202', '12');
INSERT INTO `ubigeo_peru_districts` VALUES ('120210', 'Matahuasi', '1202', '12');
INSERT INTO `ubigeo_peru_districts` VALUES ('120211', 'Mito', '1202', '12');
INSERT INTO `ubigeo_peru_districts` VALUES ('120212', 'Nueve de Julio', '1202', '12');
INSERT INTO `ubigeo_peru_districts` VALUES ('120213', 'Orcotuna', '1202', '12');
INSERT INTO `ubigeo_peru_districts` VALUES ('120214', 'San José de Quero', '1202', '12');
INSERT INTO `ubigeo_peru_districts` VALUES ('120215', 'Santa Rosa de Ocopa', '1202', '12');
INSERT INTO `ubigeo_peru_districts` VALUES ('120301', 'Chanchamayo', '1203', '12');
INSERT INTO `ubigeo_peru_districts` VALUES ('120302', 'Perene', '1203', '12');
INSERT INTO `ubigeo_peru_districts` VALUES ('120303', 'Pichanaqui', '1203', '12');
INSERT INTO `ubigeo_peru_districts` VALUES ('120304', 'San Luis de Shuaro', '1203', '12');
INSERT INTO `ubigeo_peru_districts` VALUES ('120305', 'San Ramón', '1203', '12');
INSERT INTO `ubigeo_peru_districts` VALUES ('120306', 'Vitoc', '1203', '12');
INSERT INTO `ubigeo_peru_districts` VALUES ('120401', 'Jauja', '1204', '12');
INSERT INTO `ubigeo_peru_districts` VALUES ('120402', 'Acolla', '1204', '12');
INSERT INTO `ubigeo_peru_districts` VALUES ('120403', 'Apata', '1204', '12');
INSERT INTO `ubigeo_peru_districts` VALUES ('120404', 'Ataura', '1204', '12');
INSERT INTO `ubigeo_peru_districts` VALUES ('120405', 'Canchayllo', '1204', '12');
INSERT INTO `ubigeo_peru_districts` VALUES ('120406', 'Curicaca', '1204', '12');
INSERT INTO `ubigeo_peru_districts` VALUES ('120407', 'El Mantaro', '1204', '12');
INSERT INTO `ubigeo_peru_districts` VALUES ('120408', 'Huamali', '1204', '12');
INSERT INTO `ubigeo_peru_districts` VALUES ('120409', 'Huaripampa', '1204', '12');
INSERT INTO `ubigeo_peru_districts` VALUES ('120410', 'Huertas', '1204', '12');
INSERT INTO `ubigeo_peru_districts` VALUES ('120411', 'Janjaillo', '1204', '12');
INSERT INTO `ubigeo_peru_districts` VALUES ('120412', 'Julcán', '1204', '12');
INSERT INTO `ubigeo_peru_districts` VALUES ('120413', 'Leonor Ordóñez', '1204', '12');
INSERT INTO `ubigeo_peru_districts` VALUES ('120414', 'Llocllapampa', '1204', '12');
INSERT INTO `ubigeo_peru_districts` VALUES ('120415', 'Marco', '1204', '12');
INSERT INTO `ubigeo_peru_districts` VALUES ('120416', 'Masma', '1204', '12');
INSERT INTO `ubigeo_peru_districts` VALUES ('120417', 'Masma Chicche', '1204', '12');
INSERT INTO `ubigeo_peru_districts` VALUES ('120418', 'Molinos', '1204', '12');
INSERT INTO `ubigeo_peru_districts` VALUES ('120419', 'Monobamba', '1204', '12');
INSERT INTO `ubigeo_peru_districts` VALUES ('120420', 'Muqui', '1204', '12');
INSERT INTO `ubigeo_peru_districts` VALUES ('120421', 'Muquiyauyo', '1204', '12');
INSERT INTO `ubigeo_peru_districts` VALUES ('120422', 'Paca', '1204', '12');
INSERT INTO `ubigeo_peru_districts` VALUES ('120423', 'Paccha', '1204', '12');
INSERT INTO `ubigeo_peru_districts` VALUES ('120424', 'Pancan', '1204', '12');
INSERT INTO `ubigeo_peru_districts` VALUES ('120425', 'Parco', '1204', '12');
INSERT INTO `ubigeo_peru_districts` VALUES ('120426', 'Pomacancha', '1204', '12');
INSERT INTO `ubigeo_peru_districts` VALUES ('120427', 'Ricran', '1204', '12');
INSERT INTO `ubigeo_peru_districts` VALUES ('120428', 'San Lorenzo', '1204', '12');
INSERT INTO `ubigeo_peru_districts` VALUES ('120429', 'San Pedro de Chunan', '1204', '12');
INSERT INTO `ubigeo_peru_districts` VALUES ('120430', 'Sausa', '1204', '12');
INSERT INTO `ubigeo_peru_districts` VALUES ('120431', 'Sincos', '1204', '12');
INSERT INTO `ubigeo_peru_districts` VALUES ('120432', 'Tunan Marca', '1204', '12');
INSERT INTO `ubigeo_peru_districts` VALUES ('120433', 'Yauli', '1204', '12');
INSERT INTO `ubigeo_peru_districts` VALUES ('120434', 'Yauyos', '1204', '12');
INSERT INTO `ubigeo_peru_districts` VALUES ('120501', 'Junin', '1205', '12');
INSERT INTO `ubigeo_peru_districts` VALUES ('120502', 'Carhuamayo', '1205', '12');
INSERT INTO `ubigeo_peru_districts` VALUES ('120503', 'Ondores', '1205', '12');
INSERT INTO `ubigeo_peru_districts` VALUES ('120504', 'Ulcumayo', '1205', '12');
INSERT INTO `ubigeo_peru_districts` VALUES ('120601', 'Satipo', '1206', '12');
INSERT INTO `ubigeo_peru_districts` VALUES ('120602', 'Coviriali', '1206', '12');
INSERT INTO `ubigeo_peru_districts` VALUES ('120603', 'Llaylla', '1206', '12');
INSERT INTO `ubigeo_peru_districts` VALUES ('120604', 'Mazamari', '1206', '12');
INSERT INTO `ubigeo_peru_districts` VALUES ('120605', 'Pampa Hermosa', '1206', '12');
INSERT INTO `ubigeo_peru_districts` VALUES ('120606', 'Pangoa', '1206', '12');
INSERT INTO `ubigeo_peru_districts` VALUES ('120607', 'Río Negro', '1206', '12');
INSERT INTO `ubigeo_peru_districts` VALUES ('120608', 'Río Tambo', '1206', '12');
INSERT INTO `ubigeo_peru_districts` VALUES ('120609', 'Vizcatan del Ene', '1206', '12');
INSERT INTO `ubigeo_peru_districts` VALUES ('120701', 'Tarma', '1207', '12');
INSERT INTO `ubigeo_peru_districts` VALUES ('120702', 'Acobamba', '1207', '12');
INSERT INTO `ubigeo_peru_districts` VALUES ('120703', 'Huaricolca', '1207', '12');
INSERT INTO `ubigeo_peru_districts` VALUES ('120704', 'Huasahuasi', '1207', '12');
INSERT INTO `ubigeo_peru_districts` VALUES ('120705', 'La Unión', '1207', '12');
INSERT INTO `ubigeo_peru_districts` VALUES ('120706', 'Palca', '1207', '12');
INSERT INTO `ubigeo_peru_districts` VALUES ('120707', 'Palcamayo', '1207', '12');
INSERT INTO `ubigeo_peru_districts` VALUES ('120708', 'San Pedro de Cajas', '1207', '12');
INSERT INTO `ubigeo_peru_districts` VALUES ('120709', 'Tapo', '1207', '12');
INSERT INTO `ubigeo_peru_districts` VALUES ('120801', 'La Oroya', '1208', '12');
INSERT INTO `ubigeo_peru_districts` VALUES ('120802', 'Chacapalpa', '1208', '12');
INSERT INTO `ubigeo_peru_districts` VALUES ('120803', 'Huay-Huay', '1208', '12');
INSERT INTO `ubigeo_peru_districts` VALUES ('120804', 'Marcapomacocha', '1208', '12');
INSERT INTO `ubigeo_peru_districts` VALUES ('120805', 'Morococha', '1208', '12');
INSERT INTO `ubigeo_peru_districts` VALUES ('120806', 'Paccha', '1208', '12');
INSERT INTO `ubigeo_peru_districts` VALUES ('120807', 'Santa Bárbara de Carhuacayan', '1208', '12');
INSERT INTO `ubigeo_peru_districts` VALUES ('120808', 'Santa Rosa de Sacco', '1208', '12');
INSERT INTO `ubigeo_peru_districts` VALUES ('120809', 'Suitucancha', '1208', '12');
INSERT INTO `ubigeo_peru_districts` VALUES ('120810', 'Yauli', '1208', '12');
INSERT INTO `ubigeo_peru_districts` VALUES ('120901', 'Chupaca', '1209', '12');
INSERT INTO `ubigeo_peru_districts` VALUES ('120902', 'Ahuac', '1209', '12');
INSERT INTO `ubigeo_peru_districts` VALUES ('120903', 'Chongos Bajo', '1209', '12');
INSERT INTO `ubigeo_peru_districts` VALUES ('120904', 'Huachac', '1209', '12');
INSERT INTO `ubigeo_peru_districts` VALUES ('120905', 'Huamancaca Chico', '1209', '12');
INSERT INTO `ubigeo_peru_districts` VALUES ('120906', 'San Juan de Iscos', '1209', '12');
INSERT INTO `ubigeo_peru_districts` VALUES ('120907', 'San Juan de Jarpa', '1209', '12');
INSERT INTO `ubigeo_peru_districts` VALUES ('120908', 'Tres de Diciembre', '1209', '12');
INSERT INTO `ubigeo_peru_districts` VALUES ('120909', 'Yanacancha', '1209', '12');
INSERT INTO `ubigeo_peru_districts` VALUES ('130101', 'Trujillo', '1301', '13');
INSERT INTO `ubigeo_peru_districts` VALUES ('130102', 'El Porvenir', '1301', '13');
INSERT INTO `ubigeo_peru_districts` VALUES ('130103', 'Florencia de Mora', '1301', '13');
INSERT INTO `ubigeo_peru_districts` VALUES ('130104', 'Huanchaco', '1301', '13');
INSERT INTO `ubigeo_peru_districts` VALUES ('130105', 'La Esperanza', '1301', '13');
INSERT INTO `ubigeo_peru_districts` VALUES ('130106', 'Laredo', '1301', '13');
INSERT INTO `ubigeo_peru_districts` VALUES ('130107', 'Moche', '1301', '13');
INSERT INTO `ubigeo_peru_districts` VALUES ('130108', 'Poroto', '1301', '13');
INSERT INTO `ubigeo_peru_districts` VALUES ('130109', 'Salaverry', '1301', '13');
INSERT INTO `ubigeo_peru_districts` VALUES ('130110', 'Simbal', '1301', '13');
INSERT INTO `ubigeo_peru_districts` VALUES ('130111', 'Victor Larco Herrera', '1301', '13');
INSERT INTO `ubigeo_peru_districts` VALUES ('130201', 'Ascope', '1302', '13');
INSERT INTO `ubigeo_peru_districts` VALUES ('130202', 'Chicama', '1302', '13');
INSERT INTO `ubigeo_peru_districts` VALUES ('130203', 'Chocope', '1302', '13');
INSERT INTO `ubigeo_peru_districts` VALUES ('130204', 'Magdalena de Cao', '1302', '13');
INSERT INTO `ubigeo_peru_districts` VALUES ('130205', 'Paijan', '1302', '13');
INSERT INTO `ubigeo_peru_districts` VALUES ('130206', 'Rázuri', '1302', '13');
INSERT INTO `ubigeo_peru_districts` VALUES ('130207', 'Santiago de Cao', '1302', '13');
INSERT INTO `ubigeo_peru_districts` VALUES ('130208', 'Casa Grande', '1302', '13');
INSERT INTO `ubigeo_peru_districts` VALUES ('130301', 'Bolívar', '1303', '13');
INSERT INTO `ubigeo_peru_districts` VALUES ('130302', 'Bambamarca', '1303', '13');
INSERT INTO `ubigeo_peru_districts` VALUES ('130303', 'Condormarca', '1303', '13');
INSERT INTO `ubigeo_peru_districts` VALUES ('130304', 'Longotea', '1303', '13');
INSERT INTO `ubigeo_peru_districts` VALUES ('130305', 'Uchumarca', '1303', '13');
INSERT INTO `ubigeo_peru_districts` VALUES ('130306', 'Ucuncha', '1303', '13');
INSERT INTO `ubigeo_peru_districts` VALUES ('130401', 'Chepen', '1304', '13');
INSERT INTO `ubigeo_peru_districts` VALUES ('130402', 'Pacanga', '1304', '13');
INSERT INTO `ubigeo_peru_districts` VALUES ('130403', 'Pueblo Nuevo', '1304', '13');
INSERT INTO `ubigeo_peru_districts` VALUES ('130501', 'Julcan', '1305', '13');
INSERT INTO `ubigeo_peru_districts` VALUES ('130502', 'Calamarca', '1305', '13');
INSERT INTO `ubigeo_peru_districts` VALUES ('130503', 'Carabamba', '1305', '13');
INSERT INTO `ubigeo_peru_districts` VALUES ('130504', 'Huaso', '1305', '13');
INSERT INTO `ubigeo_peru_districts` VALUES ('130601', 'Otuzco', '1306', '13');
INSERT INTO `ubigeo_peru_districts` VALUES ('130602', 'Agallpampa', '1306', '13');
INSERT INTO `ubigeo_peru_districts` VALUES ('130604', 'Charat', '1306', '13');
INSERT INTO `ubigeo_peru_districts` VALUES ('130605', 'Huaranchal', '1306', '13');
INSERT INTO `ubigeo_peru_districts` VALUES ('130606', 'La Cuesta', '1306', '13');
INSERT INTO `ubigeo_peru_districts` VALUES ('130608', 'Mache', '1306', '13');
INSERT INTO `ubigeo_peru_districts` VALUES ('130610', 'Paranday', '1306', '13');
INSERT INTO `ubigeo_peru_districts` VALUES ('130611', 'Salpo', '1306', '13');
INSERT INTO `ubigeo_peru_districts` VALUES ('130613', 'Sinsicap', '1306', '13');
INSERT INTO `ubigeo_peru_districts` VALUES ('130614', 'Usquil', '1306', '13');
INSERT INTO `ubigeo_peru_districts` VALUES ('130701', 'San Pedro de Lloc', '1307', '13');
INSERT INTO `ubigeo_peru_districts` VALUES ('130702', 'Guadalupe', '1307', '13');
INSERT INTO `ubigeo_peru_districts` VALUES ('130703', 'Jequetepeque', '1307', '13');
INSERT INTO `ubigeo_peru_districts` VALUES ('130704', 'Pacasmayo', '1307', '13');
INSERT INTO `ubigeo_peru_districts` VALUES ('130705', 'San José', '1307', '13');
INSERT INTO `ubigeo_peru_districts` VALUES ('130801', 'Tayabamba', '1308', '13');
INSERT INTO `ubigeo_peru_districts` VALUES ('130802', 'Buldibuyo', '1308', '13');
INSERT INTO `ubigeo_peru_districts` VALUES ('130803', 'Chillia', '1308', '13');
INSERT INTO `ubigeo_peru_districts` VALUES ('130804', 'Huancaspata', '1308', '13');
INSERT INTO `ubigeo_peru_districts` VALUES ('130805', 'Huaylillas', '1308', '13');
INSERT INTO `ubigeo_peru_districts` VALUES ('130806', 'Huayo', '1308', '13');
INSERT INTO `ubigeo_peru_districts` VALUES ('130807', 'Ongon', '1308', '13');
INSERT INTO `ubigeo_peru_districts` VALUES ('130808', 'Parcoy', '1308', '13');
INSERT INTO `ubigeo_peru_districts` VALUES ('130809', 'Pataz', '1308', '13');
INSERT INTO `ubigeo_peru_districts` VALUES ('130810', 'Pias', '1308', '13');
INSERT INTO `ubigeo_peru_districts` VALUES ('130811', 'Santiago de Challas', '1308', '13');
INSERT INTO `ubigeo_peru_districts` VALUES ('130812', 'Taurija', '1308', '13');
INSERT INTO `ubigeo_peru_districts` VALUES ('130813', 'Urpay', '1308', '13');
INSERT INTO `ubigeo_peru_districts` VALUES ('130901', 'Huamachuco', '1309', '13');
INSERT INTO `ubigeo_peru_districts` VALUES ('130902', 'Chugay', '1309', '13');
INSERT INTO `ubigeo_peru_districts` VALUES ('130903', 'Cochorco', '1309', '13');
INSERT INTO `ubigeo_peru_districts` VALUES ('130904', 'Curgos', '1309', '13');
INSERT INTO `ubigeo_peru_districts` VALUES ('130905', 'Marcabal', '1309', '13');
INSERT INTO `ubigeo_peru_districts` VALUES ('130906', 'Sanagoran', '1309', '13');
INSERT INTO `ubigeo_peru_districts` VALUES ('130907', 'Sarin', '1309', '13');
INSERT INTO `ubigeo_peru_districts` VALUES ('130908', 'Sartimbamba', '1309', '13');
INSERT INTO `ubigeo_peru_districts` VALUES ('131001', 'Santiago de Chuco', '1310', '13');
INSERT INTO `ubigeo_peru_districts` VALUES ('131002', 'Angasmarca', '1310', '13');
INSERT INTO `ubigeo_peru_districts` VALUES ('131003', 'Cachicadan', '1310', '13');
INSERT INTO `ubigeo_peru_districts` VALUES ('131004', 'Mollebamba', '1310', '13');
INSERT INTO `ubigeo_peru_districts` VALUES ('131005', 'Mollepata', '1310', '13');
INSERT INTO `ubigeo_peru_districts` VALUES ('131006', 'Quiruvilca', '1310', '13');
INSERT INTO `ubigeo_peru_districts` VALUES ('131007', 'Santa Cruz de Chuca', '1310', '13');
INSERT INTO `ubigeo_peru_districts` VALUES ('131008', 'Sitabamba', '1310', '13');
INSERT INTO `ubigeo_peru_districts` VALUES ('131101', 'Cascas', '1311', '13');
INSERT INTO `ubigeo_peru_districts` VALUES ('131102', 'Lucma', '1311', '13');
INSERT INTO `ubigeo_peru_districts` VALUES ('131103', 'Marmot', '1311', '13');
INSERT INTO `ubigeo_peru_districts` VALUES ('131104', 'Sayapullo', '1311', '13');
INSERT INTO `ubigeo_peru_districts` VALUES ('131201', 'Viru', '1312', '13');
INSERT INTO `ubigeo_peru_districts` VALUES ('131202', 'Chao', '1312', '13');
INSERT INTO `ubigeo_peru_districts` VALUES ('131203', 'Guadalupito', '1312', '13');
INSERT INTO `ubigeo_peru_districts` VALUES ('140101', 'Chiclayo', '1401', '14');
INSERT INTO `ubigeo_peru_districts` VALUES ('140102', 'Chongoyape', '1401', '14');
INSERT INTO `ubigeo_peru_districts` VALUES ('140103', 'Eten', '1401', '14');
INSERT INTO `ubigeo_peru_districts` VALUES ('140104', 'Eten Puerto', '1401', '14');
INSERT INTO `ubigeo_peru_districts` VALUES ('140105', 'José Leonardo Ortiz', '1401', '14');
INSERT INTO `ubigeo_peru_districts` VALUES ('140106', 'La Victoria', '1401', '14');
INSERT INTO `ubigeo_peru_districts` VALUES ('140107', 'Lagunas', '1401', '14');
INSERT INTO `ubigeo_peru_districts` VALUES ('140108', 'Monsefu', '1401', '14');
INSERT INTO `ubigeo_peru_districts` VALUES ('140109', 'Nueva Arica', '1401', '14');
INSERT INTO `ubigeo_peru_districts` VALUES ('140110', 'Oyotun', '1401', '14');
INSERT INTO `ubigeo_peru_districts` VALUES ('140111', 'Picsi', '1401', '14');
INSERT INTO `ubigeo_peru_districts` VALUES ('140112', 'Pimentel', '1401', '14');
INSERT INTO `ubigeo_peru_districts` VALUES ('140113', 'Reque', '1401', '14');
INSERT INTO `ubigeo_peru_districts` VALUES ('140114', 'Santa Rosa', '1401', '14');
INSERT INTO `ubigeo_peru_districts` VALUES ('140115', 'Saña', '1401', '14');
INSERT INTO `ubigeo_peru_districts` VALUES ('140116', 'Cayalti', '1401', '14');
INSERT INTO `ubigeo_peru_districts` VALUES ('140117', 'Patapo', '1401', '14');
INSERT INTO `ubigeo_peru_districts` VALUES ('140118', 'Pomalca', '1401', '14');
INSERT INTO `ubigeo_peru_districts` VALUES ('140119', 'Pucala', '1401', '14');
INSERT INTO `ubigeo_peru_districts` VALUES ('140120', 'Tuman', '1401', '14');
INSERT INTO `ubigeo_peru_districts` VALUES ('140201', 'Ferreñafe', '1402', '14');
INSERT INTO `ubigeo_peru_districts` VALUES ('140202', 'Cañaris', '1402', '14');
INSERT INTO `ubigeo_peru_districts` VALUES ('140203', 'Incahuasi', '1402', '14');
INSERT INTO `ubigeo_peru_districts` VALUES ('140204', 'Manuel Antonio Mesones Muro', '1402', '14');
INSERT INTO `ubigeo_peru_districts` VALUES ('140205', 'Pitipo', '1402', '14');
INSERT INTO `ubigeo_peru_districts` VALUES ('140206', 'Pueblo Nuevo', '1402', '14');
INSERT INTO `ubigeo_peru_districts` VALUES ('140301', 'Lambayeque', '1403', '14');
INSERT INTO `ubigeo_peru_districts` VALUES ('140302', 'Chochope', '1403', '14');
INSERT INTO `ubigeo_peru_districts` VALUES ('140303', 'Illimo', '1403', '14');
INSERT INTO `ubigeo_peru_districts` VALUES ('140304', 'Jayanca', '1403', '14');
INSERT INTO `ubigeo_peru_districts` VALUES ('140305', 'Mochumi', '1403', '14');
INSERT INTO `ubigeo_peru_districts` VALUES ('140306', 'Morrope', '1403', '14');
INSERT INTO `ubigeo_peru_districts` VALUES ('140307', 'Motupe', '1403', '14');
INSERT INTO `ubigeo_peru_districts` VALUES ('140308', 'Olmos', '1403', '14');
INSERT INTO `ubigeo_peru_districts` VALUES ('140309', 'Pacora', '1403', '14');
INSERT INTO `ubigeo_peru_districts` VALUES ('140310', 'Salas', '1403', '14');
INSERT INTO `ubigeo_peru_districts` VALUES ('140311', 'San José', '1403', '14');
INSERT INTO `ubigeo_peru_districts` VALUES ('140312', 'Tucume', '1403', '14');
INSERT INTO `ubigeo_peru_districts` VALUES ('150101', 'Lima', '1501', '15');
INSERT INTO `ubigeo_peru_districts` VALUES ('150102', 'Ancón', '1501', '15');
INSERT INTO `ubigeo_peru_districts` VALUES ('150103', 'Ate', '1501', '15');
INSERT INTO `ubigeo_peru_districts` VALUES ('150104', 'Barranco', '1501', '15');
INSERT INTO `ubigeo_peru_districts` VALUES ('150105', 'Breña', '1501', '15');
INSERT INTO `ubigeo_peru_districts` VALUES ('150106', 'Carabayllo', '1501', '15');
INSERT INTO `ubigeo_peru_districts` VALUES ('150107', 'Chaclacayo', '1501', '15');
INSERT INTO `ubigeo_peru_districts` VALUES ('150108', 'Chorrillos', '1501', '15');
INSERT INTO `ubigeo_peru_districts` VALUES ('150109', 'Cieneguilla', '1501', '15');
INSERT INTO `ubigeo_peru_districts` VALUES ('150110', 'Comas', '1501', '15');
INSERT INTO `ubigeo_peru_districts` VALUES ('150111', 'El Agustino', '1501', '15');
INSERT INTO `ubigeo_peru_districts` VALUES ('150112', 'Independencia', '1501', '15');
INSERT INTO `ubigeo_peru_districts` VALUES ('150113', 'Jesús María', '1501', '15');
INSERT INTO `ubigeo_peru_districts` VALUES ('150114', 'La Molina', '1501', '15');
INSERT INTO `ubigeo_peru_districts` VALUES ('150115', 'La Victoria', '1501', '15');
INSERT INTO `ubigeo_peru_districts` VALUES ('150116', 'Lince', '1501', '15');
INSERT INTO `ubigeo_peru_districts` VALUES ('150117', 'Los Olivos', '1501', '15');
INSERT INTO `ubigeo_peru_districts` VALUES ('150118', 'Lurigancho', '1501', '15');
INSERT INTO `ubigeo_peru_districts` VALUES ('150119', 'Lurin', '1501', '15');
INSERT INTO `ubigeo_peru_districts` VALUES ('150120', 'Magdalena del Mar', '1501', '15');
INSERT INTO `ubigeo_peru_districts` VALUES ('150121', 'Pueblo Libre', '1501', '15');
INSERT INTO `ubigeo_peru_districts` VALUES ('150122', 'Miraflores', '1501', '15');
INSERT INTO `ubigeo_peru_districts` VALUES ('150123', 'Pachacamac', '1501', '15');
INSERT INTO `ubigeo_peru_districts` VALUES ('150124', 'Pucusana', '1501', '15');
INSERT INTO `ubigeo_peru_districts` VALUES ('150125', 'Puente Piedra', '1501', '15');
INSERT INTO `ubigeo_peru_districts` VALUES ('150126', 'Punta Hermosa', '1501', '15');
INSERT INTO `ubigeo_peru_districts` VALUES ('150127', 'Punta Negra', '1501', '15');
INSERT INTO `ubigeo_peru_districts` VALUES ('150128', 'Rímac', '1501', '15');
INSERT INTO `ubigeo_peru_districts` VALUES ('150129', 'San Bartolo', '1501', '15');
INSERT INTO `ubigeo_peru_districts` VALUES ('150130', 'San Borja', '1501', '15');
INSERT INTO `ubigeo_peru_districts` VALUES ('150131', 'San Isidro', '1501', '15');
INSERT INTO `ubigeo_peru_districts` VALUES ('150132', 'San Juan de Lurigancho', '1501', '15');
INSERT INTO `ubigeo_peru_districts` VALUES ('150133', 'San Juan de Miraflores', '1501', '15');
INSERT INTO `ubigeo_peru_districts` VALUES ('150134', 'San Luis', '1501', '15');
INSERT INTO `ubigeo_peru_districts` VALUES ('150135', 'San Martín de Porres', '1501', '15');
INSERT INTO `ubigeo_peru_districts` VALUES ('150136', 'San Miguel', '1501', '15');
INSERT INTO `ubigeo_peru_districts` VALUES ('150137', 'Santa Anita', '1501', '15');
INSERT INTO `ubigeo_peru_districts` VALUES ('150138', 'Santa María del Mar', '1501', '15');
INSERT INTO `ubigeo_peru_districts` VALUES ('150139', 'Santa Rosa', '1501', '15');
INSERT INTO `ubigeo_peru_districts` VALUES ('150140', 'Santiago de Surco', '1501', '15');
INSERT INTO `ubigeo_peru_districts` VALUES ('150141', 'Surquillo', '1501', '15');
INSERT INTO `ubigeo_peru_districts` VALUES ('150142', 'Villa El Salvador', '1501', '15');
INSERT INTO `ubigeo_peru_districts` VALUES ('150143', 'Villa María del Triunfo', '1501', '15');
INSERT INTO `ubigeo_peru_districts` VALUES ('150201', 'Barranca', '1502', '15');
INSERT INTO `ubigeo_peru_districts` VALUES ('150202', 'Paramonga', '1502', '15');
INSERT INTO `ubigeo_peru_districts` VALUES ('150203', 'Pativilca', '1502', '15');
INSERT INTO `ubigeo_peru_districts` VALUES ('150204', 'Supe', '1502', '15');
INSERT INTO `ubigeo_peru_districts` VALUES ('150205', 'Supe Puerto', '1502', '15');
INSERT INTO `ubigeo_peru_districts` VALUES ('150301', 'Cajatambo', '1503', '15');
INSERT INTO `ubigeo_peru_districts` VALUES ('150302', 'Copa', '1503', '15');
INSERT INTO `ubigeo_peru_districts` VALUES ('150303', 'Gorgor', '1503', '15');
INSERT INTO `ubigeo_peru_districts` VALUES ('150304', 'Huancapon', '1503', '15');
INSERT INTO `ubigeo_peru_districts` VALUES ('150305', 'Manas', '1503', '15');
INSERT INTO `ubigeo_peru_districts` VALUES ('150401', 'Canta', '1504', '15');
INSERT INTO `ubigeo_peru_districts` VALUES ('150402', 'Arahuay', '1504', '15');
INSERT INTO `ubigeo_peru_districts` VALUES ('150403', 'Huamantanga', '1504', '15');
INSERT INTO `ubigeo_peru_districts` VALUES ('150404', 'Huaros', '1504', '15');
INSERT INTO `ubigeo_peru_districts` VALUES ('150405', 'Lachaqui', '1504', '15');
INSERT INTO `ubigeo_peru_districts` VALUES ('150406', 'San Buenaventura', '1504', '15');
INSERT INTO `ubigeo_peru_districts` VALUES ('150407', 'Santa Rosa de Quives', '1504', '15');
INSERT INTO `ubigeo_peru_districts` VALUES ('150501', 'San Vicente de Cañete', '1505', '15');
INSERT INTO `ubigeo_peru_districts` VALUES ('150502', 'Asia', '1505', '15');
INSERT INTO `ubigeo_peru_districts` VALUES ('150503', 'Calango', '1505', '15');
INSERT INTO `ubigeo_peru_districts` VALUES ('150504', 'Cerro Azul', '1505', '15');
INSERT INTO `ubigeo_peru_districts` VALUES ('150505', 'Chilca', '1505', '15');
INSERT INTO `ubigeo_peru_districts` VALUES ('150506', 'Coayllo', '1505', '15');
INSERT INTO `ubigeo_peru_districts` VALUES ('150507', 'Imperial', '1505', '15');
INSERT INTO `ubigeo_peru_districts` VALUES ('150508', 'Lunahuana', '1505', '15');
INSERT INTO `ubigeo_peru_districts` VALUES ('150509', 'Mala', '1505', '15');
INSERT INTO `ubigeo_peru_districts` VALUES ('150510', 'Nuevo Imperial', '1505', '15');
INSERT INTO `ubigeo_peru_districts` VALUES ('150511', 'Pacaran', '1505', '15');
INSERT INTO `ubigeo_peru_districts` VALUES ('150512', 'Quilmana', '1505', '15');
INSERT INTO `ubigeo_peru_districts` VALUES ('150513', 'San Antonio', '1505', '15');
INSERT INTO `ubigeo_peru_districts` VALUES ('150514', 'San Luis', '1505', '15');
INSERT INTO `ubigeo_peru_districts` VALUES ('150515', 'Santa Cruz de Flores', '1505', '15');
INSERT INTO `ubigeo_peru_districts` VALUES ('150516', 'Zúñiga', '1505', '15');
INSERT INTO `ubigeo_peru_districts` VALUES ('150601', 'Huaral', '1506', '15');
INSERT INTO `ubigeo_peru_districts` VALUES ('150602', 'Atavillos Alto', '1506', '15');
INSERT INTO `ubigeo_peru_districts` VALUES ('150603', 'Atavillos Bajo', '1506', '15');
INSERT INTO `ubigeo_peru_districts` VALUES ('150604', 'Aucallama', '1506', '15');
INSERT INTO `ubigeo_peru_districts` VALUES ('150605', 'Chancay', '1506', '15');
INSERT INTO `ubigeo_peru_districts` VALUES ('150606', 'Ihuari', '1506', '15');
INSERT INTO `ubigeo_peru_districts` VALUES ('150607', 'Lampian', '1506', '15');
INSERT INTO `ubigeo_peru_districts` VALUES ('150608', 'Pacaraos', '1506', '15');
INSERT INTO `ubigeo_peru_districts` VALUES ('150609', 'San Miguel de Acos', '1506', '15');
INSERT INTO `ubigeo_peru_districts` VALUES ('150610', 'Santa Cruz de Andamarca', '1506', '15');
INSERT INTO `ubigeo_peru_districts` VALUES ('150611', 'Sumbilca', '1506', '15');
INSERT INTO `ubigeo_peru_districts` VALUES ('150612', 'Veintisiete de Noviembre', '1506', '15');
INSERT INTO `ubigeo_peru_districts` VALUES ('150701', 'Matucana', '1507', '15');
INSERT INTO `ubigeo_peru_districts` VALUES ('150702', 'Antioquia', '1507', '15');
INSERT INTO `ubigeo_peru_districts` VALUES ('150703', 'Callahuanca', '1507', '15');
INSERT INTO `ubigeo_peru_districts` VALUES ('150704', 'Carampoma', '1507', '15');
INSERT INTO `ubigeo_peru_districts` VALUES ('150705', 'Chicla', '1507', '15');
INSERT INTO `ubigeo_peru_districts` VALUES ('150706', 'Cuenca', '1507', '15');
INSERT INTO `ubigeo_peru_districts` VALUES ('150707', 'Huachupampa', '1507', '15');
INSERT INTO `ubigeo_peru_districts` VALUES ('150708', 'Huanza', '1507', '15');
INSERT INTO `ubigeo_peru_districts` VALUES ('150709', 'Huarochiri', '1507', '15');
INSERT INTO `ubigeo_peru_districts` VALUES ('150710', 'Lahuaytambo', '1507', '15');
INSERT INTO `ubigeo_peru_districts` VALUES ('150711', 'Langa', '1507', '15');
INSERT INTO `ubigeo_peru_districts` VALUES ('150712', 'Laraos', '1507', '15');
INSERT INTO `ubigeo_peru_districts` VALUES ('150713', 'Mariatana', '1507', '15');
INSERT INTO `ubigeo_peru_districts` VALUES ('150714', 'Ricardo Palma', '1507', '15');
INSERT INTO `ubigeo_peru_districts` VALUES ('150715', 'San Andrés de Tupicocha', '1507', '15');
INSERT INTO `ubigeo_peru_districts` VALUES ('150716', 'San Antonio', '1507', '15');
INSERT INTO `ubigeo_peru_districts` VALUES ('150717', 'San Bartolomé', '1507', '15');
INSERT INTO `ubigeo_peru_districts` VALUES ('150718', 'San Damian', '1507', '15');
INSERT INTO `ubigeo_peru_districts` VALUES ('150719', 'San Juan de Iris', '1507', '15');
INSERT INTO `ubigeo_peru_districts` VALUES ('150720', 'San Juan de Tantaranche', '1507', '15');
INSERT INTO `ubigeo_peru_districts` VALUES ('150721', 'San Lorenzo de Quinti', '1507', '15');
INSERT INTO `ubigeo_peru_districts` VALUES ('150722', 'San Mateo', '1507', '15');
INSERT INTO `ubigeo_peru_districts` VALUES ('150723', 'San Mateo de Otao', '1507', '15');
INSERT INTO `ubigeo_peru_districts` VALUES ('150724', 'San Pedro de Casta', '1507', '15');
INSERT INTO `ubigeo_peru_districts` VALUES ('150725', 'San Pedro de Huancayre', '1507', '15');
INSERT INTO `ubigeo_peru_districts` VALUES ('150726', 'Sangallaya', '1507', '15');
INSERT INTO `ubigeo_peru_districts` VALUES ('150727', 'Santa Cruz de Cocachacra', '1507', '15');
INSERT INTO `ubigeo_peru_districts` VALUES ('150728', 'Santa Eulalia', '1507', '15');
INSERT INTO `ubigeo_peru_districts` VALUES ('150729', 'Santiago de Anchucaya', '1507', '15');
INSERT INTO `ubigeo_peru_districts` VALUES ('150730', 'Santiago de Tuna', '1507', '15');
INSERT INTO `ubigeo_peru_districts` VALUES ('150731', 'Santo Domingo de Los Olleros', '1507', '15');
INSERT INTO `ubigeo_peru_districts` VALUES ('150732', 'Surco', '1507', '15');
INSERT INTO `ubigeo_peru_districts` VALUES ('150801', 'Huacho', '1508', '15');
INSERT INTO `ubigeo_peru_districts` VALUES ('150802', 'Ambar', '1508', '15');
INSERT INTO `ubigeo_peru_districts` VALUES ('150803', 'Caleta de Carquin', '1508', '15');
INSERT INTO `ubigeo_peru_districts` VALUES ('150804', 'Checras', '1508', '15');
INSERT INTO `ubigeo_peru_districts` VALUES ('150805', 'Hualmay', '1508', '15');
INSERT INTO `ubigeo_peru_districts` VALUES ('150806', 'Huaura', '1508', '15');
INSERT INTO `ubigeo_peru_districts` VALUES ('150807', 'Leoncio Prado', '1508', '15');
INSERT INTO `ubigeo_peru_districts` VALUES ('150808', 'Paccho', '1508', '15');
INSERT INTO `ubigeo_peru_districts` VALUES ('150809', 'Santa Leonor', '1508', '15');
INSERT INTO `ubigeo_peru_districts` VALUES ('150810', 'Santa María', '1508', '15');
INSERT INTO `ubigeo_peru_districts` VALUES ('150811', 'Sayan', '1508', '15');
INSERT INTO `ubigeo_peru_districts` VALUES ('150812', 'Vegueta', '1508', '15');
INSERT INTO `ubigeo_peru_districts` VALUES ('150901', 'Oyon', '1509', '15');
INSERT INTO `ubigeo_peru_districts` VALUES ('150902', 'Andajes', '1509', '15');
INSERT INTO `ubigeo_peru_districts` VALUES ('150903', 'Caujul', '1509', '15');
INSERT INTO `ubigeo_peru_districts` VALUES ('150904', 'Cochamarca', '1509', '15');
INSERT INTO `ubigeo_peru_districts` VALUES ('150905', 'Navan', '1509', '15');
INSERT INTO `ubigeo_peru_districts` VALUES ('150906', 'Pachangara', '1509', '15');
INSERT INTO `ubigeo_peru_districts` VALUES ('151001', 'Yauyos', '1510', '15');
INSERT INTO `ubigeo_peru_districts` VALUES ('151002', 'Alis', '1510', '15');
INSERT INTO `ubigeo_peru_districts` VALUES ('151003', 'Allauca', '1510', '15');
INSERT INTO `ubigeo_peru_districts` VALUES ('151004', 'Ayaviri', '1510', '15');
INSERT INTO `ubigeo_peru_districts` VALUES ('151005', 'Azángaro', '1510', '15');
INSERT INTO `ubigeo_peru_districts` VALUES ('151006', 'Cacra', '1510', '15');
INSERT INTO `ubigeo_peru_districts` VALUES ('151007', 'Carania', '1510', '15');
INSERT INTO `ubigeo_peru_districts` VALUES ('151008', 'Catahuasi', '1510', '15');
INSERT INTO `ubigeo_peru_districts` VALUES ('151009', 'Chocos', '1510', '15');
INSERT INTO `ubigeo_peru_districts` VALUES ('151010', 'Cochas', '1510', '15');
INSERT INTO `ubigeo_peru_districts` VALUES ('151011', 'Colonia', '1510', '15');
INSERT INTO `ubigeo_peru_districts` VALUES ('151012', 'Hongos', '1510', '15');
INSERT INTO `ubigeo_peru_districts` VALUES ('151013', 'Huampara', '1510', '15');
INSERT INTO `ubigeo_peru_districts` VALUES ('151014', 'Huancaya', '1510', '15');
INSERT INTO `ubigeo_peru_districts` VALUES ('151015', 'Huangascar', '1510', '15');
INSERT INTO `ubigeo_peru_districts` VALUES ('151016', 'Huantan', '1510', '15');
INSERT INTO `ubigeo_peru_districts` VALUES ('151017', 'Huañec', '1510', '15');
INSERT INTO `ubigeo_peru_districts` VALUES ('151018', 'Laraos', '1510', '15');
INSERT INTO `ubigeo_peru_districts` VALUES ('151019', 'Lincha', '1510', '15');
INSERT INTO `ubigeo_peru_districts` VALUES ('151020', 'Madean', '1510', '15');
INSERT INTO `ubigeo_peru_districts` VALUES ('151021', 'Miraflores', '1510', '15');
INSERT INTO `ubigeo_peru_districts` VALUES ('151022', 'Omas', '1510', '15');
INSERT INTO `ubigeo_peru_districts` VALUES ('151023', 'Putinza', '1510', '15');
INSERT INTO `ubigeo_peru_districts` VALUES ('151024', 'Quinches', '1510', '15');
INSERT INTO `ubigeo_peru_districts` VALUES ('151025', 'Quinocay', '1510', '15');
INSERT INTO `ubigeo_peru_districts` VALUES ('151026', 'San Joaquín', '1510', '15');
INSERT INTO `ubigeo_peru_districts` VALUES ('151027', 'San Pedro de Pilas', '1510', '15');
INSERT INTO `ubigeo_peru_districts` VALUES ('151028', 'Tanta', '1510', '15');
INSERT INTO `ubigeo_peru_districts` VALUES ('151029', 'Tauripampa', '1510', '15');
INSERT INTO `ubigeo_peru_districts` VALUES ('151030', 'Tomas', '1510', '15');
INSERT INTO `ubigeo_peru_districts` VALUES ('151031', 'Tupe', '1510', '15');
INSERT INTO `ubigeo_peru_districts` VALUES ('151032', 'Viñac', '1510', '15');
INSERT INTO `ubigeo_peru_districts` VALUES ('151033', 'Vitis', '1510', '15');
INSERT INTO `ubigeo_peru_districts` VALUES ('160101', 'Iquitos', '1601', '16');
INSERT INTO `ubigeo_peru_districts` VALUES ('160102', 'Alto Nanay', '1601', '16');
INSERT INTO `ubigeo_peru_districts` VALUES ('160103', 'Fernando Lores', '1601', '16');
INSERT INTO `ubigeo_peru_districts` VALUES ('160104', 'Indiana', '1601', '16');
INSERT INTO `ubigeo_peru_districts` VALUES ('160105', 'Las Amazonas', '1601', '16');
INSERT INTO `ubigeo_peru_districts` VALUES ('160106', 'Mazan', '1601', '16');
INSERT INTO `ubigeo_peru_districts` VALUES ('160107', 'Napo', '1601', '16');
INSERT INTO `ubigeo_peru_districts` VALUES ('160108', 'Punchana', '1601', '16');
INSERT INTO `ubigeo_peru_districts` VALUES ('160110', 'Torres Causana', '1601', '16');
INSERT INTO `ubigeo_peru_districts` VALUES ('160112', 'Belén', '1601', '16');
INSERT INTO `ubigeo_peru_districts` VALUES ('160113', 'San Juan Bautista', '1601', '16');
INSERT INTO `ubigeo_peru_districts` VALUES ('160201', 'Yurimaguas', '1602', '16');
INSERT INTO `ubigeo_peru_districts` VALUES ('160202', 'Balsapuerto', '1602', '16');
INSERT INTO `ubigeo_peru_districts` VALUES ('160205', 'Jeberos', '1602', '16');
INSERT INTO `ubigeo_peru_districts` VALUES ('160206', 'Lagunas', '1602', '16');
INSERT INTO `ubigeo_peru_districts` VALUES ('160210', 'Santa Cruz', '1602', '16');
INSERT INTO `ubigeo_peru_districts` VALUES ('160211', 'Teniente Cesar López Rojas', '1602', '16');
INSERT INTO `ubigeo_peru_districts` VALUES ('160301', 'Nauta', '1603', '16');
INSERT INTO `ubigeo_peru_districts` VALUES ('160302', 'Parinari', '1603', '16');
INSERT INTO `ubigeo_peru_districts` VALUES ('160303', 'Tigre', '1603', '16');
INSERT INTO `ubigeo_peru_districts` VALUES ('160304', 'Trompeteros', '1603', '16');
INSERT INTO `ubigeo_peru_districts` VALUES ('160305', 'Urarinas', '1603', '16');
INSERT INTO `ubigeo_peru_districts` VALUES ('160401', 'Ramón Castilla', '1604', '16');
INSERT INTO `ubigeo_peru_districts` VALUES ('160402', 'Pebas', '1604', '16');
INSERT INTO `ubigeo_peru_districts` VALUES ('160403', 'Yavari', '1604', '16');
INSERT INTO `ubigeo_peru_districts` VALUES ('160404', 'San Pablo', '1604', '16');
INSERT INTO `ubigeo_peru_districts` VALUES ('160501', 'Requena', '1605', '16');
INSERT INTO `ubigeo_peru_districts` VALUES ('160502', 'Alto Tapiche', '1605', '16');
INSERT INTO `ubigeo_peru_districts` VALUES ('160503', 'Capelo', '1605', '16');
INSERT INTO `ubigeo_peru_districts` VALUES ('160504', 'Emilio San Martín', '1605', '16');
INSERT INTO `ubigeo_peru_districts` VALUES ('160505', 'Maquia', '1605', '16');
INSERT INTO `ubigeo_peru_districts` VALUES ('160506', 'Puinahua', '1605', '16');
INSERT INTO `ubigeo_peru_districts` VALUES ('160507', 'Saquena', '1605', '16');
INSERT INTO `ubigeo_peru_districts` VALUES ('160508', 'Soplin', '1605', '16');
INSERT INTO `ubigeo_peru_districts` VALUES ('160509', 'Tapiche', '1605', '16');
INSERT INTO `ubigeo_peru_districts` VALUES ('160510', 'Jenaro Herrera', '1605', '16');
INSERT INTO `ubigeo_peru_districts` VALUES ('160511', 'Yaquerana', '1605', '16');
INSERT INTO `ubigeo_peru_districts` VALUES ('160601', 'Contamana', '1606', '16');
INSERT INTO `ubigeo_peru_districts` VALUES ('160602', 'Inahuaya', '1606', '16');
INSERT INTO `ubigeo_peru_districts` VALUES ('160603', 'Padre Márquez', '1606', '16');
INSERT INTO `ubigeo_peru_districts` VALUES ('160604', 'Pampa Hermosa', '1606', '16');
INSERT INTO `ubigeo_peru_districts` VALUES ('160605', 'Sarayacu', '1606', '16');
INSERT INTO `ubigeo_peru_districts` VALUES ('160606', 'Vargas Guerra', '1606', '16');
INSERT INTO `ubigeo_peru_districts` VALUES ('160701', 'Barranca', '1607', '16');
INSERT INTO `ubigeo_peru_districts` VALUES ('160702', 'Cahuapanas', '1607', '16');
INSERT INTO `ubigeo_peru_districts` VALUES ('160703', 'Manseriche', '1607', '16');
INSERT INTO `ubigeo_peru_districts` VALUES ('160704', 'Morona', '1607', '16');
INSERT INTO `ubigeo_peru_districts` VALUES ('160705', 'Pastaza', '1607', '16');
INSERT INTO `ubigeo_peru_districts` VALUES ('160706', 'Andoas', '1607', '16');
INSERT INTO `ubigeo_peru_districts` VALUES ('160801', 'Putumayo', '1608', '16');
INSERT INTO `ubigeo_peru_districts` VALUES ('160802', 'Rosa Panduro', '1608', '16');
INSERT INTO `ubigeo_peru_districts` VALUES ('160803', 'Teniente Manuel Clavero', '1608', '16');
INSERT INTO `ubigeo_peru_districts` VALUES ('160804', 'Yaguas', '1608', '16');
INSERT INTO `ubigeo_peru_districts` VALUES ('170101', 'Tambopata', '1701', '17');
INSERT INTO `ubigeo_peru_districts` VALUES ('170102', 'Inambari', '1701', '17');
INSERT INTO `ubigeo_peru_districts` VALUES ('170103', 'Las Piedras', '1701', '17');
INSERT INTO `ubigeo_peru_districts` VALUES ('170104', 'Laberinto', '1701', '17');
INSERT INTO `ubigeo_peru_districts` VALUES ('170201', 'Manu', '1702', '17');
INSERT INTO `ubigeo_peru_districts` VALUES ('170202', 'Fitzcarrald', '1702', '17');
INSERT INTO `ubigeo_peru_districts` VALUES ('170203', 'Madre de Dios', '1702', '17');
INSERT INTO `ubigeo_peru_districts` VALUES ('170204', 'Huepetuhe', '1702', '17');
INSERT INTO `ubigeo_peru_districts` VALUES ('170301', 'Iñapari', '1703', '17');
INSERT INTO `ubigeo_peru_districts` VALUES ('170302', 'Iberia', '1703', '17');
INSERT INTO `ubigeo_peru_districts` VALUES ('170303', 'Tahuamanu', '1703', '17');
INSERT INTO `ubigeo_peru_districts` VALUES ('180101', 'Moquegua', '1801', '18');
INSERT INTO `ubigeo_peru_districts` VALUES ('180102', 'Carumas', '1801', '18');
INSERT INTO `ubigeo_peru_districts` VALUES ('180103', 'Cuchumbaya', '1801', '18');
INSERT INTO `ubigeo_peru_districts` VALUES ('180104', 'Samegua', '1801', '18');
INSERT INTO `ubigeo_peru_districts` VALUES ('180105', 'San Cristóbal', '1801', '18');
INSERT INTO `ubigeo_peru_districts` VALUES ('180106', 'Torata', '1801', '18');
INSERT INTO `ubigeo_peru_districts` VALUES ('180201', 'Omate', '1802', '18');
INSERT INTO `ubigeo_peru_districts` VALUES ('180202', 'Chojata', '1802', '18');
INSERT INTO `ubigeo_peru_districts` VALUES ('180203', 'Coalaque', '1802', '18');
INSERT INTO `ubigeo_peru_districts` VALUES ('180204', 'Ichuña', '1802', '18');
INSERT INTO `ubigeo_peru_districts` VALUES ('180205', 'La Capilla', '1802', '18');
INSERT INTO `ubigeo_peru_districts` VALUES ('180206', 'Lloque', '1802', '18');
INSERT INTO `ubigeo_peru_districts` VALUES ('180207', 'Matalaque', '1802', '18');
INSERT INTO `ubigeo_peru_districts` VALUES ('180208', 'Puquina', '1802', '18');
INSERT INTO `ubigeo_peru_districts` VALUES ('180209', 'Quinistaquillas', '1802', '18');
INSERT INTO `ubigeo_peru_districts` VALUES ('180210', 'Ubinas', '1802', '18');
INSERT INTO `ubigeo_peru_districts` VALUES ('180211', 'Yunga', '1802', '18');
INSERT INTO `ubigeo_peru_districts` VALUES ('180301', 'Ilo', '1803', '18');
INSERT INTO `ubigeo_peru_districts` VALUES ('180302', 'El Algarrobal', '1803', '18');
INSERT INTO `ubigeo_peru_districts` VALUES ('180303', 'Pacocha', '1803', '18');
INSERT INTO `ubigeo_peru_districts` VALUES ('190101', 'Chaupimarca', '1901', '19');
INSERT INTO `ubigeo_peru_districts` VALUES ('190102', 'Huachon', '1901', '19');
INSERT INTO `ubigeo_peru_districts` VALUES ('190103', 'Huariaca', '1901', '19');
INSERT INTO `ubigeo_peru_districts` VALUES ('190104', 'Huayllay', '1901', '19');
INSERT INTO `ubigeo_peru_districts` VALUES ('190105', 'Ninacaca', '1901', '19');
INSERT INTO `ubigeo_peru_districts` VALUES ('190106', 'Pallanchacra', '1901', '19');
INSERT INTO `ubigeo_peru_districts` VALUES ('190107', 'Paucartambo', '1901', '19');
INSERT INTO `ubigeo_peru_districts` VALUES ('190108', 'San Francisco de Asís de Yarusyacan', '1901', '19');
INSERT INTO `ubigeo_peru_districts` VALUES ('190109', 'Simon Bolívar', '1901', '19');
INSERT INTO `ubigeo_peru_districts` VALUES ('190110', 'Ticlacayan', '1901', '19');
INSERT INTO `ubigeo_peru_districts` VALUES ('190111', 'Tinyahuarco', '1901', '19');
INSERT INTO `ubigeo_peru_districts` VALUES ('190112', 'Vicco', '1901', '19');
INSERT INTO `ubigeo_peru_districts` VALUES ('190113', 'Yanacancha', '1901', '19');
INSERT INTO `ubigeo_peru_districts` VALUES ('190201', 'Yanahuanca', '1902', '19');
INSERT INTO `ubigeo_peru_districts` VALUES ('190202', 'Chacayan', '1902', '19');
INSERT INTO `ubigeo_peru_districts` VALUES ('190203', 'Goyllarisquizga', '1902', '19');
INSERT INTO `ubigeo_peru_districts` VALUES ('190204', 'Paucar', '1902', '19');
INSERT INTO `ubigeo_peru_districts` VALUES ('190205', 'San Pedro de Pillao', '1902', '19');
INSERT INTO `ubigeo_peru_districts` VALUES ('190206', 'Santa Ana de Tusi', '1902', '19');
INSERT INTO `ubigeo_peru_districts` VALUES ('190207', 'Tapuc', '1902', '19');
INSERT INTO `ubigeo_peru_districts` VALUES ('190208', 'Vilcabamba', '1902', '19');
INSERT INTO `ubigeo_peru_districts` VALUES ('190301', 'Oxapampa', '1903', '19');
INSERT INTO `ubigeo_peru_districts` VALUES ('190302', 'Chontabamba', '1903', '19');
INSERT INTO `ubigeo_peru_districts` VALUES ('190303', 'Huancabamba', '1903', '19');
INSERT INTO `ubigeo_peru_districts` VALUES ('190304', 'Palcazu', '1903', '19');
INSERT INTO `ubigeo_peru_districts` VALUES ('190305', 'Pozuzo', '1903', '19');
INSERT INTO `ubigeo_peru_districts` VALUES ('190306', 'Puerto Bermúdez', '1903', '19');
INSERT INTO `ubigeo_peru_districts` VALUES ('190307', 'Villa Rica', '1903', '19');
INSERT INTO `ubigeo_peru_districts` VALUES ('190308', 'Constitución', '1903', '19');
INSERT INTO `ubigeo_peru_districts` VALUES ('200101', 'Piura', '2001', '20');
INSERT INTO `ubigeo_peru_districts` VALUES ('200104', 'Castilla', '2001', '20');
INSERT INTO `ubigeo_peru_districts` VALUES ('200105', 'Catacaos', '2001', '20');
INSERT INTO `ubigeo_peru_districts` VALUES ('200107', 'Cura Mori', '2001', '20');
INSERT INTO `ubigeo_peru_districts` VALUES ('200108', 'El Tallan', '2001', '20');
INSERT INTO `ubigeo_peru_districts` VALUES ('200109', 'La Arena', '2001', '20');
INSERT INTO `ubigeo_peru_districts` VALUES ('200110', 'La Unión', '2001', '20');
INSERT INTO `ubigeo_peru_districts` VALUES ('200111', 'Las Lomas', '2001', '20');
INSERT INTO `ubigeo_peru_districts` VALUES ('200114', 'Tambo Grande', '2001', '20');
INSERT INTO `ubigeo_peru_districts` VALUES ('200115', 'Veintiseis de Octubre', '2001', '20');
INSERT INTO `ubigeo_peru_districts` VALUES ('200201', 'Ayabaca', '2002', '20');
INSERT INTO `ubigeo_peru_districts` VALUES ('200202', 'Frias', '2002', '20');
INSERT INTO `ubigeo_peru_districts` VALUES ('200203', 'Jilili', '2002', '20');
INSERT INTO `ubigeo_peru_districts` VALUES ('200204', 'Lagunas', '2002', '20');
INSERT INTO `ubigeo_peru_districts` VALUES ('200205', 'Montero', '2002', '20');
INSERT INTO `ubigeo_peru_districts` VALUES ('200206', 'Pacaipampa', '2002', '20');
INSERT INTO `ubigeo_peru_districts` VALUES ('200207', 'Paimas', '2002', '20');
INSERT INTO `ubigeo_peru_districts` VALUES ('200208', 'Sapillica', '2002', '20');
INSERT INTO `ubigeo_peru_districts` VALUES ('200209', 'Sicchez', '2002', '20');
INSERT INTO `ubigeo_peru_districts` VALUES ('200210', 'Suyo', '2002', '20');
INSERT INTO `ubigeo_peru_districts` VALUES ('200301', 'Huancabamba', '2003', '20');
INSERT INTO `ubigeo_peru_districts` VALUES ('200302', 'Canchaque', '2003', '20');
INSERT INTO `ubigeo_peru_districts` VALUES ('200303', 'El Carmen de la Frontera', '2003', '20');
INSERT INTO `ubigeo_peru_districts` VALUES ('200304', 'Huarmaca', '2003', '20');
INSERT INTO `ubigeo_peru_districts` VALUES ('200305', 'Lalaquiz', '2003', '20');
INSERT INTO `ubigeo_peru_districts` VALUES ('200306', 'San Miguel de El Faique', '2003', '20');
INSERT INTO `ubigeo_peru_districts` VALUES ('200307', 'Sondor', '2003', '20');
INSERT INTO `ubigeo_peru_districts` VALUES ('200308', 'Sondorillo', '2003', '20');
INSERT INTO `ubigeo_peru_districts` VALUES ('200401', 'Chulucanas', '2004', '20');
INSERT INTO `ubigeo_peru_districts` VALUES ('200402', 'Buenos Aires', '2004', '20');
INSERT INTO `ubigeo_peru_districts` VALUES ('200403', 'Chalaco', '2004', '20');
INSERT INTO `ubigeo_peru_districts` VALUES ('200404', 'La Matanza', '2004', '20');
INSERT INTO `ubigeo_peru_districts` VALUES ('200405', 'Morropon', '2004', '20');
INSERT INTO `ubigeo_peru_districts` VALUES ('200406', 'Salitral', '2004', '20');
INSERT INTO `ubigeo_peru_districts` VALUES ('200407', 'San Juan de Bigote', '2004', '20');
INSERT INTO `ubigeo_peru_districts` VALUES ('200408', 'Santa Catalina de Mossa', '2004', '20');
INSERT INTO `ubigeo_peru_districts` VALUES ('200409', 'Santo Domingo', '2004', '20');
INSERT INTO `ubigeo_peru_districts` VALUES ('200410', 'Yamango', '2004', '20');
INSERT INTO `ubigeo_peru_districts` VALUES ('200501', 'Paita', '2005', '20');
INSERT INTO `ubigeo_peru_districts` VALUES ('200502', 'Amotape', '2005', '20');
INSERT INTO `ubigeo_peru_districts` VALUES ('200503', 'Arenal', '2005', '20');
INSERT INTO `ubigeo_peru_districts` VALUES ('200504', 'Colan', '2005', '20');
INSERT INTO `ubigeo_peru_districts` VALUES ('200505', 'La Huaca', '2005', '20');
INSERT INTO `ubigeo_peru_districts` VALUES ('200506', 'Tamarindo', '2005', '20');
INSERT INTO `ubigeo_peru_districts` VALUES ('200507', 'Vichayal', '2005', '20');
INSERT INTO `ubigeo_peru_districts` VALUES ('200601', 'Sullana', '2006', '20');
INSERT INTO `ubigeo_peru_districts` VALUES ('200602', 'Bellavista', '2006', '20');
INSERT INTO `ubigeo_peru_districts` VALUES ('200603', 'Ignacio Escudero', '2006', '20');
INSERT INTO `ubigeo_peru_districts` VALUES ('200604', 'Lancones', '2006', '20');
INSERT INTO `ubigeo_peru_districts` VALUES ('200605', 'Marcavelica', '2006', '20');
INSERT INTO `ubigeo_peru_districts` VALUES ('200606', 'Miguel Checa', '2006', '20');
INSERT INTO `ubigeo_peru_districts` VALUES ('200607', 'Querecotillo', '2006', '20');
INSERT INTO `ubigeo_peru_districts` VALUES ('200608', 'Salitral', '2006', '20');
INSERT INTO `ubigeo_peru_districts` VALUES ('200701', 'Pariñas', '2007', '20');
INSERT INTO `ubigeo_peru_districts` VALUES ('200702', 'El Alto', '2007', '20');
INSERT INTO `ubigeo_peru_districts` VALUES ('200703', 'La Brea', '2007', '20');
INSERT INTO `ubigeo_peru_districts` VALUES ('200704', 'Lobitos', '2007', '20');
INSERT INTO `ubigeo_peru_districts` VALUES ('200705', 'Los Organos', '2007', '20');
INSERT INTO `ubigeo_peru_districts` VALUES ('200706', 'Mancora', '2007', '20');
INSERT INTO `ubigeo_peru_districts` VALUES ('200801', 'Sechura', '2008', '20');
INSERT INTO `ubigeo_peru_districts` VALUES ('200802', 'Bellavista de la Unión', '2008', '20');
INSERT INTO `ubigeo_peru_districts` VALUES ('200803', 'Bernal', '2008', '20');
INSERT INTO `ubigeo_peru_districts` VALUES ('200804', 'Cristo Nos Valga', '2008', '20');
INSERT INTO `ubigeo_peru_districts` VALUES ('200805', 'Vice', '2008', '20');
INSERT INTO `ubigeo_peru_districts` VALUES ('200806', 'Rinconada Llicuar', '2008', '20');
INSERT INTO `ubigeo_peru_districts` VALUES ('210101', 'Puno', '2101', '21');
INSERT INTO `ubigeo_peru_districts` VALUES ('210102', 'Acora', '2101', '21');
INSERT INTO `ubigeo_peru_districts` VALUES ('210103', 'Amantani', '2101', '21');
INSERT INTO `ubigeo_peru_districts` VALUES ('210104', 'Atuncolla', '2101', '21');
INSERT INTO `ubigeo_peru_districts` VALUES ('210105', 'Capachica', '2101', '21');
INSERT INTO `ubigeo_peru_districts` VALUES ('210106', 'Chucuito', '2101', '21');
INSERT INTO `ubigeo_peru_districts` VALUES ('210107', 'Coata', '2101', '21');
INSERT INTO `ubigeo_peru_districts` VALUES ('210108', 'Huata', '2101', '21');
INSERT INTO `ubigeo_peru_districts` VALUES ('210109', 'Mañazo', '2101', '21');
INSERT INTO `ubigeo_peru_districts` VALUES ('210110', 'Paucarcolla', '2101', '21');
INSERT INTO `ubigeo_peru_districts` VALUES ('210111', 'Pichacani', '2101', '21');
INSERT INTO `ubigeo_peru_districts` VALUES ('210112', 'Plateria', '2101', '21');
INSERT INTO `ubigeo_peru_districts` VALUES ('210113', 'San Antonio', '2101', '21');
INSERT INTO `ubigeo_peru_districts` VALUES ('210114', 'Tiquillaca', '2101', '21');
INSERT INTO `ubigeo_peru_districts` VALUES ('210115', 'Vilque', '2101', '21');
INSERT INTO `ubigeo_peru_districts` VALUES ('210201', 'Azángaro', '2102', '21');
INSERT INTO `ubigeo_peru_districts` VALUES ('210202', 'Achaya', '2102', '21');
INSERT INTO `ubigeo_peru_districts` VALUES ('210203', 'Arapa', '2102', '21');
INSERT INTO `ubigeo_peru_districts` VALUES ('210204', 'Asillo', '2102', '21');
INSERT INTO `ubigeo_peru_districts` VALUES ('210205', 'Caminaca', '2102', '21');
INSERT INTO `ubigeo_peru_districts` VALUES ('210206', 'Chupa', '2102', '21');
INSERT INTO `ubigeo_peru_districts` VALUES ('210207', 'José Domingo Choquehuanca', '2102', '21');
INSERT INTO `ubigeo_peru_districts` VALUES ('210208', 'Muñani', '2102', '21');
INSERT INTO `ubigeo_peru_districts` VALUES ('210209', 'Potoni', '2102', '21');
INSERT INTO `ubigeo_peru_districts` VALUES ('210210', 'Saman', '2102', '21');
INSERT INTO `ubigeo_peru_districts` VALUES ('210211', 'San Anton', '2102', '21');
INSERT INTO `ubigeo_peru_districts` VALUES ('210212', 'San José', '2102', '21');
INSERT INTO `ubigeo_peru_districts` VALUES ('210213', 'San Juan de Salinas', '2102', '21');
INSERT INTO `ubigeo_peru_districts` VALUES ('210214', 'Santiago de Pupuja', '2102', '21');
INSERT INTO `ubigeo_peru_districts` VALUES ('210215', 'Tirapata', '2102', '21');
INSERT INTO `ubigeo_peru_districts` VALUES ('210301', 'Macusani', '2103', '21');
INSERT INTO `ubigeo_peru_districts` VALUES ('210302', 'Ajoyani', '2103', '21');
INSERT INTO `ubigeo_peru_districts` VALUES ('210303', 'Ayapata', '2103', '21');
INSERT INTO `ubigeo_peru_districts` VALUES ('210304', 'Coasa', '2103', '21');
INSERT INTO `ubigeo_peru_districts` VALUES ('210305', 'Corani', '2103', '21');
INSERT INTO `ubigeo_peru_districts` VALUES ('210306', 'Crucero', '2103', '21');
INSERT INTO `ubigeo_peru_districts` VALUES ('210307', 'Ituata', '2103', '21');
INSERT INTO `ubigeo_peru_districts` VALUES ('210308', 'Ollachea', '2103', '21');
INSERT INTO `ubigeo_peru_districts` VALUES ('210309', 'San Gaban', '2103', '21');
INSERT INTO `ubigeo_peru_districts` VALUES ('210310', 'Usicayos', '2103', '21');
INSERT INTO `ubigeo_peru_districts` VALUES ('210401', 'Juli', '2104', '21');
INSERT INTO `ubigeo_peru_districts` VALUES ('210402', 'Desaguadero', '2104', '21');
INSERT INTO `ubigeo_peru_districts` VALUES ('210403', 'Huacullani', '2104', '21');
INSERT INTO `ubigeo_peru_districts` VALUES ('210404', 'Kelluyo', '2104', '21');
INSERT INTO `ubigeo_peru_districts` VALUES ('210405', 'Pisacoma', '2104', '21');
INSERT INTO `ubigeo_peru_districts` VALUES ('210406', 'Pomata', '2104', '21');
INSERT INTO `ubigeo_peru_districts` VALUES ('210407', 'Zepita', '2104', '21');
INSERT INTO `ubigeo_peru_districts` VALUES ('210501', 'Ilave', '2105', '21');
INSERT INTO `ubigeo_peru_districts` VALUES ('210502', 'Capazo', '2105', '21');
INSERT INTO `ubigeo_peru_districts` VALUES ('210503', 'Pilcuyo', '2105', '21');
INSERT INTO `ubigeo_peru_districts` VALUES ('210504', 'Santa Rosa', '2105', '21');
INSERT INTO `ubigeo_peru_districts` VALUES ('210505', 'Conduriri', '2105', '21');
INSERT INTO `ubigeo_peru_districts` VALUES ('210601', 'Huancane', '2106', '21');
INSERT INTO `ubigeo_peru_districts` VALUES ('210602', 'Cojata', '2106', '21');
INSERT INTO `ubigeo_peru_districts` VALUES ('210603', 'Huatasani', '2106', '21');
INSERT INTO `ubigeo_peru_districts` VALUES ('210604', 'Inchupalla', '2106', '21');
INSERT INTO `ubigeo_peru_districts` VALUES ('210605', 'Pusi', '2106', '21');
INSERT INTO `ubigeo_peru_districts` VALUES ('210606', 'Rosaspata', '2106', '21');
INSERT INTO `ubigeo_peru_districts` VALUES ('210607', 'Taraco', '2106', '21');
INSERT INTO `ubigeo_peru_districts` VALUES ('210608', 'Vilque Chico', '2106', '21');
INSERT INTO `ubigeo_peru_districts` VALUES ('210701', 'Lampa', '2107', '21');
INSERT INTO `ubigeo_peru_districts` VALUES ('210702', 'Cabanilla', '2107', '21');
INSERT INTO `ubigeo_peru_districts` VALUES ('210703', 'Calapuja', '2107', '21');
INSERT INTO `ubigeo_peru_districts` VALUES ('210704', 'Nicasio', '2107', '21');
INSERT INTO `ubigeo_peru_districts` VALUES ('210705', 'Ocuviri', '2107', '21');
INSERT INTO `ubigeo_peru_districts` VALUES ('210706', 'Palca', '2107', '21');
INSERT INTO `ubigeo_peru_districts` VALUES ('210707', 'Paratia', '2107', '21');
INSERT INTO `ubigeo_peru_districts` VALUES ('210708', 'Pucara', '2107', '21');
INSERT INTO `ubigeo_peru_districts` VALUES ('210709', 'Santa Lucia', '2107', '21');
INSERT INTO `ubigeo_peru_districts` VALUES ('210710', 'Vilavila', '2107', '21');
INSERT INTO `ubigeo_peru_districts` VALUES ('210801', 'Ayaviri', '2108', '21');
INSERT INTO `ubigeo_peru_districts` VALUES ('210802', 'Antauta', '2108', '21');
INSERT INTO `ubigeo_peru_districts` VALUES ('210803', 'Cupi', '2108', '21');
INSERT INTO `ubigeo_peru_districts` VALUES ('210804', 'Llalli', '2108', '21');
INSERT INTO `ubigeo_peru_districts` VALUES ('210805', 'Macari', '2108', '21');
INSERT INTO `ubigeo_peru_districts` VALUES ('210806', 'Nuñoa', '2108', '21');
INSERT INTO `ubigeo_peru_districts` VALUES ('210807', 'Orurillo', '2108', '21');
INSERT INTO `ubigeo_peru_districts` VALUES ('210808', 'Santa Rosa', '2108', '21');
INSERT INTO `ubigeo_peru_districts` VALUES ('210809', 'Umachiri', '2108', '21');
INSERT INTO `ubigeo_peru_districts` VALUES ('210901', 'Moho', '2109', '21');
INSERT INTO `ubigeo_peru_districts` VALUES ('210902', 'Conima', '2109', '21');
INSERT INTO `ubigeo_peru_districts` VALUES ('210903', 'Huayrapata', '2109', '21');
INSERT INTO `ubigeo_peru_districts` VALUES ('210904', 'Tilali', '2109', '21');
INSERT INTO `ubigeo_peru_districts` VALUES ('211001', 'Putina', '2110', '21');
INSERT INTO `ubigeo_peru_districts` VALUES ('211002', 'Ananea', '2110', '21');
INSERT INTO `ubigeo_peru_districts` VALUES ('211003', 'Pedro Vilca Apaza', '2110', '21');
INSERT INTO `ubigeo_peru_districts` VALUES ('211004', 'Quilcapuncu', '2110', '21');
INSERT INTO `ubigeo_peru_districts` VALUES ('211005', 'Sina', '2110', '21');
INSERT INTO `ubigeo_peru_districts` VALUES ('211101', 'Juliaca', '2111', '21');
INSERT INTO `ubigeo_peru_districts` VALUES ('211102', 'Cabana', '2111', '21');
INSERT INTO `ubigeo_peru_districts` VALUES ('211103', 'Cabanillas', '2111', '21');
INSERT INTO `ubigeo_peru_districts` VALUES ('211104', 'Caracoto', '2111', '21');
INSERT INTO `ubigeo_peru_districts` VALUES ('211105', 'San Miguel', '2111', '21');
INSERT INTO `ubigeo_peru_districts` VALUES ('211201', 'Sandia', '2112', '21');
INSERT INTO `ubigeo_peru_districts` VALUES ('211202', 'Cuyocuyo', '2112', '21');
INSERT INTO `ubigeo_peru_districts` VALUES ('211203', 'Limbani', '2112', '21');
INSERT INTO `ubigeo_peru_districts` VALUES ('211204', 'Patambuco', '2112', '21');
INSERT INTO `ubigeo_peru_districts` VALUES ('211205', 'Phara', '2112', '21');
INSERT INTO `ubigeo_peru_districts` VALUES ('211206', 'Quiaca', '2112', '21');
INSERT INTO `ubigeo_peru_districts` VALUES ('211207', 'San Juan del Oro', '2112', '21');
INSERT INTO `ubigeo_peru_districts` VALUES ('211208', 'Yanahuaya', '2112', '21');
INSERT INTO `ubigeo_peru_districts` VALUES ('211209', 'Alto Inambari', '2112', '21');
INSERT INTO `ubigeo_peru_districts` VALUES ('211210', 'San Pedro de Putina Punco', '2112', '21');
INSERT INTO `ubigeo_peru_districts` VALUES ('211301', 'Yunguyo', '2113', '21');
INSERT INTO `ubigeo_peru_districts` VALUES ('211302', 'Anapia', '2113', '21');
INSERT INTO `ubigeo_peru_districts` VALUES ('211303', 'Copani', '2113', '21');
INSERT INTO `ubigeo_peru_districts` VALUES ('211304', 'Cuturapi', '2113', '21');
INSERT INTO `ubigeo_peru_districts` VALUES ('211305', 'Ollaraya', '2113', '21');
INSERT INTO `ubigeo_peru_districts` VALUES ('211306', 'Tinicachi', '2113', '21');
INSERT INTO `ubigeo_peru_districts` VALUES ('211307', 'Unicachi', '2113', '21');
INSERT INTO `ubigeo_peru_districts` VALUES ('220101', 'Moyobamba', '2201', '22');
INSERT INTO `ubigeo_peru_districts` VALUES ('220102', 'Calzada', '2201', '22');
INSERT INTO `ubigeo_peru_districts` VALUES ('220103', 'Habana', '2201', '22');
INSERT INTO `ubigeo_peru_districts` VALUES ('220104', 'Jepelacio', '2201', '22');
INSERT INTO `ubigeo_peru_districts` VALUES ('220105', 'Soritor', '2201', '22');
INSERT INTO `ubigeo_peru_districts` VALUES ('220106', 'Yantalo', '2201', '22');
INSERT INTO `ubigeo_peru_districts` VALUES ('220201', 'Bellavista', '2202', '22');
INSERT INTO `ubigeo_peru_districts` VALUES ('220202', 'Alto Biavo', '2202', '22');
INSERT INTO `ubigeo_peru_districts` VALUES ('220203', 'Bajo Biavo', '2202', '22');
INSERT INTO `ubigeo_peru_districts` VALUES ('220204', 'Huallaga', '2202', '22');
INSERT INTO `ubigeo_peru_districts` VALUES ('220205', 'San Pablo', '2202', '22');
INSERT INTO `ubigeo_peru_districts` VALUES ('220206', 'San Rafael', '2202', '22');
INSERT INTO `ubigeo_peru_districts` VALUES ('220301', 'San José de Sisa', '2203', '22');
INSERT INTO `ubigeo_peru_districts` VALUES ('220302', 'Agua Blanca', '2203', '22');
INSERT INTO `ubigeo_peru_districts` VALUES ('220303', 'San Martín', '2203', '22');
INSERT INTO `ubigeo_peru_districts` VALUES ('220304', 'Santa Rosa', '2203', '22');
INSERT INTO `ubigeo_peru_districts` VALUES ('220305', 'Shatoja', '2203', '22');
INSERT INTO `ubigeo_peru_districts` VALUES ('220401', 'Saposoa', '2204', '22');
INSERT INTO `ubigeo_peru_districts` VALUES ('220402', 'Alto Saposoa', '2204', '22');
INSERT INTO `ubigeo_peru_districts` VALUES ('220403', 'El Eslabón', '2204', '22');
INSERT INTO `ubigeo_peru_districts` VALUES ('220404', 'Piscoyacu', '2204', '22');
INSERT INTO `ubigeo_peru_districts` VALUES ('220405', 'Sacanche', '2204', '22');
INSERT INTO `ubigeo_peru_districts` VALUES ('220406', 'Tingo de Saposoa', '2204', '22');
INSERT INTO `ubigeo_peru_districts` VALUES ('220501', 'Lamas', '2205', '22');
INSERT INTO `ubigeo_peru_districts` VALUES ('220502', 'Alonso de Alvarado', '2205', '22');
INSERT INTO `ubigeo_peru_districts` VALUES ('220503', 'Barranquita', '2205', '22');
INSERT INTO `ubigeo_peru_districts` VALUES ('220504', 'Caynarachi', '2205', '22');
INSERT INTO `ubigeo_peru_districts` VALUES ('220505', 'Cuñumbuqui', '2205', '22');
INSERT INTO `ubigeo_peru_districts` VALUES ('220506', 'Pinto Recodo', '2205', '22');
INSERT INTO `ubigeo_peru_districts` VALUES ('220507', 'Rumisapa', '2205', '22');
INSERT INTO `ubigeo_peru_districts` VALUES ('220508', 'San Roque de Cumbaza', '2205', '22');
INSERT INTO `ubigeo_peru_districts` VALUES ('220509', 'Shanao', '2205', '22');
INSERT INTO `ubigeo_peru_districts` VALUES ('220510', 'Tabalosos', '2205', '22');
INSERT INTO `ubigeo_peru_districts` VALUES ('220511', 'Zapatero', '2205', '22');
INSERT INTO `ubigeo_peru_districts` VALUES ('220601', 'Juanjuí', '2206', '22');
INSERT INTO `ubigeo_peru_districts` VALUES ('220602', 'Campanilla', '2206', '22');
INSERT INTO `ubigeo_peru_districts` VALUES ('220603', 'Huicungo', '2206', '22');
INSERT INTO `ubigeo_peru_districts` VALUES ('220604', 'Pachiza', '2206', '22');
INSERT INTO `ubigeo_peru_districts` VALUES ('220605', 'Pajarillo', '2206', '22');
INSERT INTO `ubigeo_peru_districts` VALUES ('220701', 'Picota', '2207', '22');
INSERT INTO `ubigeo_peru_districts` VALUES ('220702', 'Buenos Aires', '2207', '22');
INSERT INTO `ubigeo_peru_districts` VALUES ('220703', 'Caspisapa', '2207', '22');
INSERT INTO `ubigeo_peru_districts` VALUES ('220704', 'Pilluana', '2207', '22');
INSERT INTO `ubigeo_peru_districts` VALUES ('220705', 'Pucacaca', '2207', '22');
INSERT INTO `ubigeo_peru_districts` VALUES ('220706', 'San Cristóbal', '2207', '22');
INSERT INTO `ubigeo_peru_districts` VALUES ('220707', 'San Hilarión', '2207', '22');
INSERT INTO `ubigeo_peru_districts` VALUES ('220708', 'Shamboyacu', '2207', '22');
INSERT INTO `ubigeo_peru_districts` VALUES ('220709', 'Tingo de Ponasa', '2207', '22');
INSERT INTO `ubigeo_peru_districts` VALUES ('220710', 'Tres Unidos', '2207', '22');
INSERT INTO `ubigeo_peru_districts` VALUES ('220801', 'Rioja', '2208', '22');
INSERT INTO `ubigeo_peru_districts` VALUES ('220802', 'Awajun', '2208', '22');
INSERT INTO `ubigeo_peru_districts` VALUES ('220803', 'Elías Soplin Vargas', '2208', '22');
INSERT INTO `ubigeo_peru_districts` VALUES ('220804', 'Nueva Cajamarca', '2208', '22');
INSERT INTO `ubigeo_peru_districts` VALUES ('220805', 'Pardo Miguel', '2208', '22');
INSERT INTO `ubigeo_peru_districts` VALUES ('220806', 'Posic', '2208', '22');
INSERT INTO `ubigeo_peru_districts` VALUES ('220807', 'San Fernando', '2208', '22');
INSERT INTO `ubigeo_peru_districts` VALUES ('220808', 'Yorongos', '2208', '22');
INSERT INTO `ubigeo_peru_districts` VALUES ('220809', 'Yuracyacu', '2208', '22');
INSERT INTO `ubigeo_peru_districts` VALUES ('220901', 'Tarapoto', '2209', '22');
INSERT INTO `ubigeo_peru_districts` VALUES ('220902', 'Alberto Leveau', '2209', '22');
INSERT INTO `ubigeo_peru_districts` VALUES ('220903', 'Cacatachi', '2209', '22');
INSERT INTO `ubigeo_peru_districts` VALUES ('220904', 'Chazuta', '2209', '22');
INSERT INTO `ubigeo_peru_districts` VALUES ('220905', 'Chipurana', '2209', '22');
INSERT INTO `ubigeo_peru_districts` VALUES ('220906', 'El Porvenir', '2209', '22');
INSERT INTO `ubigeo_peru_districts` VALUES ('220907', 'Huimbayoc', '2209', '22');
INSERT INTO `ubigeo_peru_districts` VALUES ('220908', 'Juan Guerra', '2209', '22');
INSERT INTO `ubigeo_peru_districts` VALUES ('220909', 'La Banda de Shilcayo', '2209', '22');
INSERT INTO `ubigeo_peru_districts` VALUES ('220910', 'Morales', '2209', '22');
INSERT INTO `ubigeo_peru_districts` VALUES ('220911', 'Papaplaya', '2209', '22');
INSERT INTO `ubigeo_peru_districts` VALUES ('220912', 'San Antonio', '2209', '22');
INSERT INTO `ubigeo_peru_districts` VALUES ('220913', 'Sauce', '2209', '22');
INSERT INTO `ubigeo_peru_districts` VALUES ('220914', 'Shapaja', '2209', '22');
INSERT INTO `ubigeo_peru_districts` VALUES ('221001', 'Tocache', '2210', '22');
INSERT INTO `ubigeo_peru_districts` VALUES ('221002', 'Nuevo Progreso', '2210', '22');
INSERT INTO `ubigeo_peru_districts` VALUES ('221003', 'Polvora', '2210', '22');
INSERT INTO `ubigeo_peru_districts` VALUES ('221004', 'Shunte', '2210', '22');
INSERT INTO `ubigeo_peru_districts` VALUES ('221005', 'Uchiza', '2210', '22');
INSERT INTO `ubigeo_peru_districts` VALUES ('230101', 'Tacna', '2301', '23');
INSERT INTO `ubigeo_peru_districts` VALUES ('230102', 'Alto de la Alianza', '2301', '23');
INSERT INTO `ubigeo_peru_districts` VALUES ('230103', 'Calana', '2301', '23');
INSERT INTO `ubigeo_peru_districts` VALUES ('230104', 'Ciudad Nueva', '2301', '23');
INSERT INTO `ubigeo_peru_districts` VALUES ('230105', 'Inclan', '2301', '23');
INSERT INTO `ubigeo_peru_districts` VALUES ('230106', 'Pachia', '2301', '23');
INSERT INTO `ubigeo_peru_districts` VALUES ('230107', 'Palca', '2301', '23');
INSERT INTO `ubigeo_peru_districts` VALUES ('230108', 'Pocollay', '2301', '23');
INSERT INTO `ubigeo_peru_districts` VALUES ('230109', 'Sama', '2301', '23');
INSERT INTO `ubigeo_peru_districts` VALUES ('230110', 'Coronel Gregorio Albarracín Lanchipa', '2301', '23');
INSERT INTO `ubigeo_peru_districts` VALUES ('230111', 'La Yarada los Palos', '2301', '23');
INSERT INTO `ubigeo_peru_districts` VALUES ('230201', 'Candarave', '2302', '23');
INSERT INTO `ubigeo_peru_districts` VALUES ('230202', 'Cairani', '2302', '23');
INSERT INTO `ubigeo_peru_districts` VALUES ('230203', 'Camilaca', '2302', '23');
INSERT INTO `ubigeo_peru_districts` VALUES ('230204', 'Curibaya', '2302', '23');
INSERT INTO `ubigeo_peru_districts` VALUES ('230205', 'Huanuara', '2302', '23');
INSERT INTO `ubigeo_peru_districts` VALUES ('230206', 'Quilahuani', '2302', '23');
INSERT INTO `ubigeo_peru_districts` VALUES ('230301', 'Locumba', '2303', '23');
INSERT INTO `ubigeo_peru_districts` VALUES ('230302', 'Ilabaya', '2303', '23');
INSERT INTO `ubigeo_peru_districts` VALUES ('230303', 'Ite', '2303', '23');
INSERT INTO `ubigeo_peru_districts` VALUES ('230401', 'Tarata', '2304', '23');
INSERT INTO `ubigeo_peru_districts` VALUES ('230402', 'Héroes Albarracín', '2304', '23');
INSERT INTO `ubigeo_peru_districts` VALUES ('230403', 'Estique', '2304', '23');
INSERT INTO `ubigeo_peru_districts` VALUES ('230404', 'Estique-Pampa', '2304', '23');
INSERT INTO `ubigeo_peru_districts` VALUES ('230405', 'Sitajara', '2304', '23');
INSERT INTO `ubigeo_peru_districts` VALUES ('230406', 'Susapaya', '2304', '23');
INSERT INTO `ubigeo_peru_districts` VALUES ('230407', 'Tarucachi', '2304', '23');
INSERT INTO `ubigeo_peru_districts` VALUES ('230408', 'Ticaco', '2304', '23');
INSERT INTO `ubigeo_peru_districts` VALUES ('240101', 'Tumbes', '2401', '24');
INSERT INTO `ubigeo_peru_districts` VALUES ('240102', 'Corrales', '2401', '24');
INSERT INTO `ubigeo_peru_districts` VALUES ('240103', 'La Cruz', '2401', '24');
INSERT INTO `ubigeo_peru_districts` VALUES ('240104', 'Pampas de Hospital', '2401', '24');
INSERT INTO `ubigeo_peru_districts` VALUES ('240105', 'San Jacinto', '2401', '24');
INSERT INTO `ubigeo_peru_districts` VALUES ('240106', 'San Juan de la Virgen', '2401', '24');
INSERT INTO `ubigeo_peru_districts` VALUES ('240201', 'Zorritos', '2402', '24');
INSERT INTO `ubigeo_peru_districts` VALUES ('240202', 'Casitas', '2402', '24');
INSERT INTO `ubigeo_peru_districts` VALUES ('240203', 'Canoas de Punta Sal', '2402', '24');
INSERT INTO `ubigeo_peru_districts` VALUES ('240301', 'Zarumilla', '2403', '24');
INSERT INTO `ubigeo_peru_districts` VALUES ('240302', 'Aguas Verdes', '2403', '24');
INSERT INTO `ubigeo_peru_districts` VALUES ('240303', 'Matapalo', '2403', '24');
INSERT INTO `ubigeo_peru_districts` VALUES ('240304', 'Papayal', '2403', '24');
INSERT INTO `ubigeo_peru_districts` VALUES ('250101', 'Calleria', '2501', '25');
INSERT INTO `ubigeo_peru_districts` VALUES ('250102', 'Campoverde', '2501', '25');
INSERT INTO `ubigeo_peru_districts` VALUES ('250103', 'Iparia', '2501', '25');
INSERT INTO `ubigeo_peru_districts` VALUES ('250104', 'Masisea', '2501', '25');
INSERT INTO `ubigeo_peru_districts` VALUES ('250105', 'Yarinacocha', '2501', '25');
INSERT INTO `ubigeo_peru_districts` VALUES ('250106', 'Nueva Requena', '2501', '25');
INSERT INTO `ubigeo_peru_districts` VALUES ('250107', 'Manantay', '2501', '25');
INSERT INTO `ubigeo_peru_districts` VALUES ('250201', 'Raymondi', '2502', '25');
INSERT INTO `ubigeo_peru_districts` VALUES ('250202', 'Sepahua', '2502', '25');
INSERT INTO `ubigeo_peru_districts` VALUES ('250203', 'Tahuania', '2502', '25');
INSERT INTO `ubigeo_peru_districts` VALUES ('250204', 'Yurua', '2502', '25');
INSERT INTO `ubigeo_peru_districts` VALUES ('250301', 'Padre Abad', '2503', '25');
INSERT INTO `ubigeo_peru_districts` VALUES ('250302', 'Irazola', '2503', '25');
INSERT INTO `ubigeo_peru_districts` VALUES ('250303', 'Curimana', '2503', '25');
INSERT INTO `ubigeo_peru_districts` VALUES ('250304', 'Neshuya', '2503', '25');
INSERT INTO `ubigeo_peru_districts` VALUES ('250305', 'Alexander Von Humboldt', '2503', '25');
INSERT INTO `ubigeo_peru_districts` VALUES ('250401', 'Purus', '2504', '25');

-- ----------------------------
-- Table structure for ubigeo_peru_provinces
-- ----------------------------
DROP TABLE IF EXISTS `ubigeo_peru_provinces`;
CREATE TABLE `ubigeo_peru_provinces` (
  `id` varchar(4) NOT NULL,
  `name` varchar(45) NOT NULL,
  `department_id` varchar(2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ubigeo_peru_provinces
-- ----------------------------
INSERT INTO `ubigeo_peru_provinces` VALUES ('0101', 'Chachapoyas', '01');
INSERT INTO `ubigeo_peru_provinces` VALUES ('0102', 'Bagua', '01');
INSERT INTO `ubigeo_peru_provinces` VALUES ('0103', 'Bongará', '01');
INSERT INTO `ubigeo_peru_provinces` VALUES ('0104', 'Condorcanqui', '01');
INSERT INTO `ubigeo_peru_provinces` VALUES ('0105', 'Luya', '01');
INSERT INTO `ubigeo_peru_provinces` VALUES ('0106', 'Rodríguez de Mendoza', '01');
INSERT INTO `ubigeo_peru_provinces` VALUES ('0107', 'Utcubamba', '01');
INSERT INTO `ubigeo_peru_provinces` VALUES ('0201', 'Huaraz', '02');
INSERT INTO `ubigeo_peru_provinces` VALUES ('0202', 'Aija', '02');
INSERT INTO `ubigeo_peru_provinces` VALUES ('0203', 'Antonio Raymondi', '02');
INSERT INTO `ubigeo_peru_provinces` VALUES ('0204', 'Asunción', '02');
INSERT INTO `ubigeo_peru_provinces` VALUES ('0205', 'Bolognesi', '02');
INSERT INTO `ubigeo_peru_provinces` VALUES ('0206', 'Carhuaz', '02');
INSERT INTO `ubigeo_peru_provinces` VALUES ('0207', 'Carlos Fermín Fitzcarrald', '02');
INSERT INTO `ubigeo_peru_provinces` VALUES ('0208', 'Casma', '02');
INSERT INTO `ubigeo_peru_provinces` VALUES ('0209', 'Corongo', '02');
INSERT INTO `ubigeo_peru_provinces` VALUES ('0210', 'Huari', '02');
INSERT INTO `ubigeo_peru_provinces` VALUES ('0211', 'Huarmey', '02');
INSERT INTO `ubigeo_peru_provinces` VALUES ('0212', 'Huaylas', '02');
INSERT INTO `ubigeo_peru_provinces` VALUES ('0213', 'Mariscal Luzuriaga', '02');
INSERT INTO `ubigeo_peru_provinces` VALUES ('0214', 'Ocros', '02');
INSERT INTO `ubigeo_peru_provinces` VALUES ('0215', 'Pallasca', '02');
INSERT INTO `ubigeo_peru_provinces` VALUES ('0216', 'Pomabamba', '02');
INSERT INTO `ubigeo_peru_provinces` VALUES ('0217', 'Recuay', '02');
INSERT INTO `ubigeo_peru_provinces` VALUES ('0218', 'Santa', '02');
INSERT INTO `ubigeo_peru_provinces` VALUES ('0219', 'Sihuas', '02');
INSERT INTO `ubigeo_peru_provinces` VALUES ('0220', 'Yungay', '02');
INSERT INTO `ubigeo_peru_provinces` VALUES ('0301', 'Abancay', '03');
INSERT INTO `ubigeo_peru_provinces` VALUES ('0302', 'Andahuaylas', '03');
INSERT INTO `ubigeo_peru_provinces` VALUES ('0303', 'Antabamba', '03');
INSERT INTO `ubigeo_peru_provinces` VALUES ('0304', 'Aymaraes', '03');
INSERT INTO `ubigeo_peru_provinces` VALUES ('0305', 'Cotabambas', '03');
INSERT INTO `ubigeo_peru_provinces` VALUES ('0306', 'Chincheros', '03');
INSERT INTO `ubigeo_peru_provinces` VALUES ('0307', 'Grau', '03');
INSERT INTO `ubigeo_peru_provinces` VALUES ('0401', 'Arequipa', '04');
INSERT INTO `ubigeo_peru_provinces` VALUES ('0402', 'Camaná', '04');
INSERT INTO `ubigeo_peru_provinces` VALUES ('0403', 'Caravelí', '04');
INSERT INTO `ubigeo_peru_provinces` VALUES ('0404', 'Castilla', '04');
INSERT INTO `ubigeo_peru_provinces` VALUES ('0405', 'Caylloma', '04');
INSERT INTO `ubigeo_peru_provinces` VALUES ('0406', 'Condesuyos', '04');
INSERT INTO `ubigeo_peru_provinces` VALUES ('0407', 'Islay', '04');
INSERT INTO `ubigeo_peru_provinces` VALUES ('0408', 'La Uniòn', '04');
INSERT INTO `ubigeo_peru_provinces` VALUES ('0501', 'Huamanga', '05');
INSERT INTO `ubigeo_peru_provinces` VALUES ('0502', 'Cangallo', '05');
INSERT INTO `ubigeo_peru_provinces` VALUES ('0503', 'Huanca Sancos', '05');
INSERT INTO `ubigeo_peru_provinces` VALUES ('0504', 'Huanta', '05');
INSERT INTO `ubigeo_peru_provinces` VALUES ('0505', 'La Mar', '05');
INSERT INTO `ubigeo_peru_provinces` VALUES ('0506', 'Lucanas', '05');
INSERT INTO `ubigeo_peru_provinces` VALUES ('0507', 'Parinacochas', '05');
INSERT INTO `ubigeo_peru_provinces` VALUES ('0508', 'Pàucar del Sara Sara', '05');
INSERT INTO `ubigeo_peru_provinces` VALUES ('0509', 'Sucre', '05');
INSERT INTO `ubigeo_peru_provinces` VALUES ('0510', 'Víctor Fajardo', '05');
INSERT INTO `ubigeo_peru_provinces` VALUES ('0511', 'Vilcas Huamán', '05');
INSERT INTO `ubigeo_peru_provinces` VALUES ('0601', 'Cajamarca', '06');
INSERT INTO `ubigeo_peru_provinces` VALUES ('0602', 'Cajabamba', '06');
INSERT INTO `ubigeo_peru_provinces` VALUES ('0603', 'Celendín', '06');
INSERT INTO `ubigeo_peru_provinces` VALUES ('0604', 'Chota', '06');
INSERT INTO `ubigeo_peru_provinces` VALUES ('0605', 'Contumazá', '06');
INSERT INTO `ubigeo_peru_provinces` VALUES ('0606', 'Cutervo', '06');
INSERT INTO `ubigeo_peru_provinces` VALUES ('0607', 'Hualgayoc', '06');
INSERT INTO `ubigeo_peru_provinces` VALUES ('0608', 'Jaén', '06');
INSERT INTO `ubigeo_peru_provinces` VALUES ('0609', 'San Ignacio', '06');
INSERT INTO `ubigeo_peru_provinces` VALUES ('0610', 'San Marcos', '06');
INSERT INTO `ubigeo_peru_provinces` VALUES ('0611', 'San Miguel', '06');
INSERT INTO `ubigeo_peru_provinces` VALUES ('0612', 'San Pablo', '06');
INSERT INTO `ubigeo_peru_provinces` VALUES ('0613', 'Santa Cruz', '06');
INSERT INTO `ubigeo_peru_provinces` VALUES ('0701', 'Prov. Const. del Callao', '07');
INSERT INTO `ubigeo_peru_provinces` VALUES ('0801', 'Cusco', '08');
INSERT INTO `ubigeo_peru_provinces` VALUES ('0802', 'Acomayo', '08');
INSERT INTO `ubigeo_peru_provinces` VALUES ('0803', 'Anta', '08');
INSERT INTO `ubigeo_peru_provinces` VALUES ('0804', 'Calca', '08');
INSERT INTO `ubigeo_peru_provinces` VALUES ('0805', 'Canas', '08');
INSERT INTO `ubigeo_peru_provinces` VALUES ('0806', 'Canchis', '08');
INSERT INTO `ubigeo_peru_provinces` VALUES ('0807', 'Chumbivilcas', '08');
INSERT INTO `ubigeo_peru_provinces` VALUES ('0808', 'Espinar', '08');
INSERT INTO `ubigeo_peru_provinces` VALUES ('0809', 'La Convención', '08');
INSERT INTO `ubigeo_peru_provinces` VALUES ('0810', 'Paruro', '08');
INSERT INTO `ubigeo_peru_provinces` VALUES ('0811', 'Paucartambo', '08');
INSERT INTO `ubigeo_peru_provinces` VALUES ('0812', 'Quispicanchi', '08');
INSERT INTO `ubigeo_peru_provinces` VALUES ('0813', 'Urubamba', '08');
INSERT INTO `ubigeo_peru_provinces` VALUES ('0901', 'Huancavelica', '09');
INSERT INTO `ubigeo_peru_provinces` VALUES ('0902', 'Acobamba', '09');
INSERT INTO `ubigeo_peru_provinces` VALUES ('0903', 'Angaraes', '09');
INSERT INTO `ubigeo_peru_provinces` VALUES ('0904', 'Castrovirreyna', '09');
INSERT INTO `ubigeo_peru_provinces` VALUES ('0905', 'Churcampa', '09');
INSERT INTO `ubigeo_peru_provinces` VALUES ('0906', 'Huaytará', '09');
INSERT INTO `ubigeo_peru_provinces` VALUES ('0907', 'Tayacaja', '09');
INSERT INTO `ubigeo_peru_provinces` VALUES ('1001', 'Huánuco', '10');
INSERT INTO `ubigeo_peru_provinces` VALUES ('1002', 'Ambo', '10');
INSERT INTO `ubigeo_peru_provinces` VALUES ('1003', 'Dos de Mayo', '10');
INSERT INTO `ubigeo_peru_provinces` VALUES ('1004', 'Huacaybamba', '10');
INSERT INTO `ubigeo_peru_provinces` VALUES ('1005', 'Huamalíes', '10');
INSERT INTO `ubigeo_peru_provinces` VALUES ('1006', 'Leoncio Prado', '10');
INSERT INTO `ubigeo_peru_provinces` VALUES ('1007', 'Marañón', '10');
INSERT INTO `ubigeo_peru_provinces` VALUES ('1008', 'Pachitea', '10');
INSERT INTO `ubigeo_peru_provinces` VALUES ('1009', 'Puerto Inca', '10');
INSERT INTO `ubigeo_peru_provinces` VALUES ('1010', 'Lauricocha ', '10');
INSERT INTO `ubigeo_peru_provinces` VALUES ('1011', 'Yarowilca ', '10');
INSERT INTO `ubigeo_peru_provinces` VALUES ('1101', 'Ica ', '11');
INSERT INTO `ubigeo_peru_provinces` VALUES ('1102', 'Chincha ', '11');
INSERT INTO `ubigeo_peru_provinces` VALUES ('1103', 'Nasca ', '11');
INSERT INTO `ubigeo_peru_provinces` VALUES ('1104', 'Palpa ', '11');
INSERT INTO `ubigeo_peru_provinces` VALUES ('1105', 'Pisco ', '11');
INSERT INTO `ubigeo_peru_provinces` VALUES ('1201', 'Huancayo ', '12');
INSERT INTO `ubigeo_peru_provinces` VALUES ('1202', 'Concepción ', '12');
INSERT INTO `ubigeo_peru_provinces` VALUES ('1203', 'Chanchamayo ', '12');
INSERT INTO `ubigeo_peru_provinces` VALUES ('1204', 'Jauja ', '12');
INSERT INTO `ubigeo_peru_provinces` VALUES ('1205', 'Junín ', '12');
INSERT INTO `ubigeo_peru_provinces` VALUES ('1206', 'Satipo ', '12');
INSERT INTO `ubigeo_peru_provinces` VALUES ('1207', 'Tarma ', '12');
INSERT INTO `ubigeo_peru_provinces` VALUES ('1208', 'Yauli ', '12');
INSERT INTO `ubigeo_peru_provinces` VALUES ('1209', 'Chupaca ', '12');
INSERT INTO `ubigeo_peru_provinces` VALUES ('1301', 'Trujillo ', '13');
INSERT INTO `ubigeo_peru_provinces` VALUES ('1302', 'Ascope ', '13');
INSERT INTO `ubigeo_peru_provinces` VALUES ('1303', 'Bolívar ', '13');
INSERT INTO `ubigeo_peru_provinces` VALUES ('1304', 'Chepén ', '13');
INSERT INTO `ubigeo_peru_provinces` VALUES ('1305', 'Julcán ', '13');
INSERT INTO `ubigeo_peru_provinces` VALUES ('1306', 'Otuzco ', '13');
INSERT INTO `ubigeo_peru_provinces` VALUES ('1307', 'Pacasmayo ', '13');
INSERT INTO `ubigeo_peru_provinces` VALUES ('1308', 'Pataz ', '13');
INSERT INTO `ubigeo_peru_provinces` VALUES ('1309', 'Sánchez Carrión ', '13');
INSERT INTO `ubigeo_peru_provinces` VALUES ('1310', 'Santiago de Chuco ', '13');
INSERT INTO `ubigeo_peru_provinces` VALUES ('1311', 'Gran Chimú ', '13');
INSERT INTO `ubigeo_peru_provinces` VALUES ('1312', 'Virú ', '13');
INSERT INTO `ubigeo_peru_provinces` VALUES ('1401', 'Chiclayo ', '14');
INSERT INTO `ubigeo_peru_provinces` VALUES ('1402', 'Ferreñafe ', '14');
INSERT INTO `ubigeo_peru_provinces` VALUES ('1403', 'Lambayeque ', '14');
INSERT INTO `ubigeo_peru_provinces` VALUES ('1501', 'Lima ', '15');
INSERT INTO `ubigeo_peru_provinces` VALUES ('1502', 'Barranca ', '15');
INSERT INTO `ubigeo_peru_provinces` VALUES ('1503', 'Cajatambo ', '15');
INSERT INTO `ubigeo_peru_provinces` VALUES ('1504', 'Canta ', '15');
INSERT INTO `ubigeo_peru_provinces` VALUES ('1505', 'Cañete ', '15');
INSERT INTO `ubigeo_peru_provinces` VALUES ('1506', 'Huaral ', '15');
INSERT INTO `ubigeo_peru_provinces` VALUES ('1507', 'Huarochirí ', '15');
INSERT INTO `ubigeo_peru_provinces` VALUES ('1508', 'Huaura ', '15');
INSERT INTO `ubigeo_peru_provinces` VALUES ('1509', 'Oyón ', '15');
INSERT INTO `ubigeo_peru_provinces` VALUES ('1510', 'Yauyos ', '15');
INSERT INTO `ubigeo_peru_provinces` VALUES ('1601', 'Maynas ', '16');
INSERT INTO `ubigeo_peru_provinces` VALUES ('1602', 'Alto Amazonas ', '16');
INSERT INTO `ubigeo_peru_provinces` VALUES ('1603', 'Loreto ', '16');
INSERT INTO `ubigeo_peru_provinces` VALUES ('1604', 'Mariscal Ramón Castilla ', '16');
INSERT INTO `ubigeo_peru_provinces` VALUES ('1605', 'Requena ', '16');
INSERT INTO `ubigeo_peru_provinces` VALUES ('1606', 'Ucayali ', '16');
INSERT INTO `ubigeo_peru_provinces` VALUES ('1607', 'Datem del Marañón ', '16');
INSERT INTO `ubigeo_peru_provinces` VALUES ('1608', 'Putumayo', '16');
INSERT INTO `ubigeo_peru_provinces` VALUES ('1701', 'Tambopata ', '17');
INSERT INTO `ubigeo_peru_provinces` VALUES ('1702', 'Manu ', '17');
INSERT INTO `ubigeo_peru_provinces` VALUES ('1703', 'Tahuamanu ', '17');
INSERT INTO `ubigeo_peru_provinces` VALUES ('1801', 'Mariscal Nieto ', '18');
INSERT INTO `ubigeo_peru_provinces` VALUES ('1802', 'General Sánchez Cerro ', '18');
INSERT INTO `ubigeo_peru_provinces` VALUES ('1803', 'Ilo ', '18');
INSERT INTO `ubigeo_peru_provinces` VALUES ('1901', 'Pasco ', '19');
INSERT INTO `ubigeo_peru_provinces` VALUES ('1902', 'Daniel Alcides Carrión ', '19');
INSERT INTO `ubigeo_peru_provinces` VALUES ('1903', 'Oxapampa ', '19');
INSERT INTO `ubigeo_peru_provinces` VALUES ('2001', 'Piura ', '20');
INSERT INTO `ubigeo_peru_provinces` VALUES ('2002', 'Ayabaca ', '20');
INSERT INTO `ubigeo_peru_provinces` VALUES ('2003', 'Huancabamba ', '20');
INSERT INTO `ubigeo_peru_provinces` VALUES ('2004', 'Morropón ', '20');
INSERT INTO `ubigeo_peru_provinces` VALUES ('2005', 'Paita ', '20');
INSERT INTO `ubigeo_peru_provinces` VALUES ('2006', 'Sullana ', '20');
INSERT INTO `ubigeo_peru_provinces` VALUES ('2007', 'Talara ', '20');
INSERT INTO `ubigeo_peru_provinces` VALUES ('2008', 'Sechura ', '20');
INSERT INTO `ubigeo_peru_provinces` VALUES ('2101', 'Puno ', '21');
INSERT INTO `ubigeo_peru_provinces` VALUES ('2102', 'Azángaro ', '21');
INSERT INTO `ubigeo_peru_provinces` VALUES ('2103', 'Carabaya ', '21');
INSERT INTO `ubigeo_peru_provinces` VALUES ('2104', 'Chucuito ', '21');
INSERT INTO `ubigeo_peru_provinces` VALUES ('2105', 'El Collao ', '21');
INSERT INTO `ubigeo_peru_provinces` VALUES ('2106', 'Huancané ', '21');
INSERT INTO `ubigeo_peru_provinces` VALUES ('2107', 'Lampa ', '21');
INSERT INTO `ubigeo_peru_provinces` VALUES ('2108', 'Melgar ', '21');
INSERT INTO `ubigeo_peru_provinces` VALUES ('2109', 'Moho ', '21');
INSERT INTO `ubigeo_peru_provinces` VALUES ('2110', 'San Antonio de Putina ', '21');
INSERT INTO `ubigeo_peru_provinces` VALUES ('2111', 'San Román ', '21');
INSERT INTO `ubigeo_peru_provinces` VALUES ('2112', 'Sandia ', '21');
INSERT INTO `ubigeo_peru_provinces` VALUES ('2113', 'Yunguyo ', '21');
INSERT INTO `ubigeo_peru_provinces` VALUES ('2201', 'Moyobamba ', '22');
INSERT INTO `ubigeo_peru_provinces` VALUES ('2202', 'Bellavista ', '22');
INSERT INTO `ubigeo_peru_provinces` VALUES ('2203', 'El Dorado ', '22');
INSERT INTO `ubigeo_peru_provinces` VALUES ('2204', 'Huallaga ', '22');
INSERT INTO `ubigeo_peru_provinces` VALUES ('2205', 'Lamas ', '22');
INSERT INTO `ubigeo_peru_provinces` VALUES ('2206', 'Mariscal Cáceres ', '22');
INSERT INTO `ubigeo_peru_provinces` VALUES ('2207', 'Picota ', '22');
INSERT INTO `ubigeo_peru_provinces` VALUES ('2208', 'Rioja ', '22');
INSERT INTO `ubigeo_peru_provinces` VALUES ('2209', 'San Martín ', '22');
INSERT INTO `ubigeo_peru_provinces` VALUES ('2210', 'Tocache ', '22');
INSERT INTO `ubigeo_peru_provinces` VALUES ('2301', 'Tacna ', '23');
INSERT INTO `ubigeo_peru_provinces` VALUES ('2302', 'Candarave ', '23');
INSERT INTO `ubigeo_peru_provinces` VALUES ('2303', 'Jorge Basadre ', '23');
INSERT INTO `ubigeo_peru_provinces` VALUES ('2304', 'Tarata ', '23');
INSERT INTO `ubigeo_peru_provinces` VALUES ('2401', 'Tumbes ', '24');
INSERT INTO `ubigeo_peru_provinces` VALUES ('2402', 'Contralmirante Villar ', '24');
INSERT INTO `ubigeo_peru_provinces` VALUES ('2403', 'Zarumilla ', '24');
INSERT INTO `ubigeo_peru_provinces` VALUES ('2501', 'Coronel Portillo ', '25');
INSERT INTO `ubigeo_peru_provinces` VALUES ('2502', 'Atalaya ', '25');
INSERT INTO `ubigeo_peru_provinces` VALUES ('2503', 'Padre Abad ', '25');
INSERT INTO `ubigeo_peru_provinces` VALUES ('2504', 'Purús', '25');

-- ----------------------------
-- Table structure for usuarios
-- ----------------------------
DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE `usuarios` (
  `usu_id` int(11) NOT NULL AUTO_INCREMENT,
  `usu_nombre` varchar(150) DEFAULT NULL,
  `usu_apellidos` varchar(150) DEFAULT NULL,
  `usu_dni` varchar(8) DEFAULT NULL,
  `usu_pass` varchar(225) DEFAULT NULL,
  `usu_fechaRegistro` datetime DEFAULT NULL,
  `usu_fechaModificacion` datetime DEFAULT NULL,
  `usu_estado` int(1) DEFAULT NULL,
  `usu_flag` int(1) DEFAULT NULL,
  `tipo_usuarios_tus_id` int(11) NOT NULL,
  PRIMARY KEY (`usu_id`),
  KEY `fk_usuarios_tipo_usuarios1_idx` (`tipo_usuarios_tus_id`),
  CONSTRAINT `fk_usuarios_tipo_usuarios1` FOREIGN KEY (`tipo_usuarios_tus_id`) REFERENCES `tipo_usuarios` (`tus_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of usuarios
-- ----------------------------
INSERT INTO `usuarios` VALUES ('1', 'Administrador', null, 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', null, null, '1', '0', '1');
INSERT INTO `usuarios` VALUES ('2', 'LUIS ALBERTO', 'ARRASCUE BAZAN', '45146572', 'fe4c8fb5f6863a3e986dc09a63ba6f97c83be861', '2022-07-04 08:56:16', null, '1', '1', '2');
INSERT INTO `usuarios` VALUES ('3', 'LUIS ALBERTO', 'CARLOS TORRES', '47649297', '7bc716dd4a426baace7baead51b7e7fedfc15d97', '2022-10-03 11:08:36', null, '1', '1', '2');
INSERT INTO `usuarios` VALUES ('4', 'ZARELA FRANCISCA', 'PINILLOS MIÑANO', '43769349', '2085377fddb8486bc2d79b578503d33c24f6847a', '2022-10-03 11:10:11', null, '1', '1', '3');
INSERT INTO `usuarios` VALUES ('5', 'JOHANA LADIS', 'MENDOZA QUISPE', '43597360', '9aefefa502c1c2073b46ab251f039ffaa9a937fd', '2022-10-03 11:11:05', null, '1', '1', '3');
