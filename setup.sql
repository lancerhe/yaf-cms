SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `manager`
-- ----------------------------
DROP TABLE IF EXISTS `manager`;
CREATE TABLE `manager` (
  `mid` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` char(32) NOT NULL,
  `name` varchar(20) NOT NULL,
  `lastloginip` char(16) NOT NULL,
  `lastlogouttime` int(10) unsigned NOT NULL DEFAULT '0',
  `createtime` int(10) unsigned NOT NULL DEFAULT '0',
  `updatetime` int(10) unsigned NOT NULL DEFAULT '0',
  `deleted` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`mid`),
  UNIQUE KEY `username` (`username`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of manager
-- ----------------------------
INSERT INTO `manager` VALUES ('1', 'admin', '21232f297a57a5a743894a0e4a801fc3', '超级管理员', '', '0', '1418538199', '1418560261', '0');

-- ----------------------------
-- Table structure for `setting`
-- ----------------------------
DROP TABLE IF EXISTS `setting`;
CREATE TABLE `setting` (
  `key` varchar(50) NOT NULL,
  `value` text NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of setting
-- ----------------------------
INSERT INTO `setting` VALUES ('site_name', '内容管理系统DEMO标题');
INSERT INTO `setting` VALUES ('site_keywords', 'Demo, CMS, Keywords');
INSERT INTO `setting` VALUES ('site_descrip', '内容管理系统DEMO网站描述');
INSERT INTO `setting` VALUES ('site_copyright', '版权所有 &copy; 内容管理系统');
INSERT INTO `setting` VALUES ('site_icp', '闽ICP2001');
INSERT INTO `setting` VALUES ('site_phone', '0591-83566954');
INSERT INTO `setting` VALUES ('site_address', '福建省...');
INSERT INTO `setting` VALUES ('site_qq', '408623955');
