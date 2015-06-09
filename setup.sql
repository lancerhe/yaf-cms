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

-- ----------------------------
-- Table structure for `page`
-- ----------------------------
DROP TABLE IF EXISTS `page`;
CREATE TABLE `page` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL DEFAULT '',
  `cname` varchar(255) NOT NULL DEFAULT '',
  `keyword` varchar(255) DEFAULT NULL,
  `desc` varchar(255) DEFAULT NULL,
  `content` text,
  `createtime` int(10) unsigned NOT NULL DEFAULT '0',
  `updatetime` int(10) unsigned NOT NULL DEFAULT '0',
  `deleted` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of page
-- ----------------------------
INSERT INTO `page` VALUES ('15', '公司简介', 'aboutus', '岚岛装饰', '岚岛装饰', null, '0', '1433674902', '0');
INSERT INTO `page` VALUES ('16', '联系我们', 'contact', '联系我们', '联系我们', '<p>福州市晋安区琯尾街金鸡山路28号1幢2层</p><p>传真:0591-87877028</p><p>电话:0591-87811008</p><p>QQ：872545904</p><p>黄小姐：13799331008</p>', '0', '1433644047', '0');

-- ----------------------------
-- Table structure for `article_cate`
-- ----------------------------
DROP TABLE IF EXISTS `article_cate`;
CREATE TABLE `article_cate` (
  `cid` int(11) NOT NULL AUTO_INCREMENT,
  `cname` varchar(20) NOT NULL DEFAULT '',
  `name` varchar(20) NOT NULL DEFAULT '',
  `fid` int(11) NOT NULL DEFAULT '0',
  `createtime` int(10) unsigned NOT NULL DEFAULT '0',
  `updatetime` int(10) unsigned NOT NULL DEFAULT '0',
  `deleted` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`cid`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of article_cate
-- ----------------------------
INSERT INTO `article_cate` VALUES ('1', 'case', '装修案例', '0', '0', '1433674433', '0');
INSERT INTO `article_cate` VALUES ('2', 'material', '装修材料', '0', '0', '1433675085', '0');
INSERT INTO `article_cate` VALUES ('3', 'house', '家装案例', '1', '0', '1433674471', '0');
INSERT INTO `article_cate` VALUES ('4', 'frock', '工装案例', '1', '0', '1433674433', '0');
INSERT INTO `article_cate` VALUES ('5', 'europeanism', '欧式风格', '3', '0', '1433674425', '0');
INSERT INTO `article_cate` VALUES ('6', 'hydropower', '水电', '2', '0', '1433675089', '0');

-- ----------------------------
-- Table structure for `article`
-- ----------------------------
DROP TABLE IF EXISTS `article`;
CREATE TABLE `article` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cid` mediumint(5) NOT NULL DEFAULT '0',
  `title` varchar(255) DEFAULT NULL,
  `intro` text,
  `keyword` varchar(255) DEFAULT NULL,
  `desc` text,
  `content` text,
  `thumbnails` varchar(255) DEFAULT '',
  `hasimage` tinyint(1) NOT NULL DEFAULT '0',
  `views` int(11) NOT NULL DEFAULT '0',
  `top` tinyint(3) NOT NULL DEFAULT '0',
  `createtime` int(10) NOT NULL DEFAULT '0',
  `updatetime` int(10) NOT NULL DEFAULT '0',
  `publishdate` date NOT NULL DEFAULT '0000-00-00',
  `deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of article
-- ----------------------------
INSERT INTO `article` VALUES ('2', '3', '家装案例0', '家装案例0', '家装案例0', '家装案例0', '<p>家装案例0</p>', '[\"20150607\\/14336893826582.jpg\"]', '1', '0', '0', '1433684261', '1433689824', '2015-07-01', '0');
INSERT INTO `article` VALUES ('3', '4', '工装案例0', '工装案例0', '工装案例0', '工装案例0', '<p>工装案例0</p>', '[]', '0', '0', '0', '1433685593', '1433689932', '2015-06-10', '0');
INSERT INTO `article` VALUES ('4', '1', '装修案例1', '装修案例1', '装修案例1', '装修案例1', '<p>装修案例1</p>', '[]', '0', '0', '0', '1433831716', '1433831716', '2015-06-09', '0');
INSERT INTO `article` VALUES ('5', '1', '装修案例2', '装修案例2', '装修案例2', '装修案例2', '<p>装修案例2</p>', '[]', '0', '0', '0', '1433831725', '1433831725', '2015-06-16', '0');
INSERT INTO `article` VALUES ('6', '1', '装修案例3', '装修案例3', '装修案例3', '装修案例3', '<p>装修案例3</p>', '[]', '0', '0', '0', '1433832488', '1433832488', '2015-06-10', '0');
INSERT INTO `article` VALUES ('7', '3', '家装案例1', '家装案例1', '家装案例1', '家装案例1', '<p>家装案例1</p>', '[]', '0', '0', '0', '1433832511', '1433832511', '2015-06-11', '0');
INSERT INTO `article` VALUES ('8', '3', '家装案例2', '家装案例2', '家装案例2', '家装案例2', '<p>家装案例2</p>', '[]', '0', '0', '0', '1433832522', '1433832522', '2015-06-10', '0');
INSERT INTO `article` VALUES ('9', '3', '家装案例3', '家装案例3', '家装案例3', '家装案例3', '<p>家装案例3</p>', '[]', '0', '0', '0', '1433832539', '1433832539', '2015-06-18', '0');
INSERT INTO `article` VALUES ('10', '5', '欧式风格1', '欧式风格1', '欧式风格1', '欧式风格1', '<p>欧式风格1</p>', '[]', '0', '0', '0', '1433832566', '1433832566', '2015-06-10', '0');
INSERT INTO `article` VALUES ('11', '5', '欧式风格2', '欧式风格2', '欧式风格2', '欧式风格2', '<p>欧式风格2</p>', '[]', '0', '0', '0', '1433832579', '1433832579', '2015-06-11', '0');
INSERT INTO `article` VALUES ('12', '5', '欧式风格3', '欧式风格3', '欧式风格3', '欧式风格3', '<p>欧式风格3</p>', '[]', '0', '0', '0', '1433832591', '1433832591', '2015-06-20', '0');
INSERT INTO `article` VALUES ('13', '5', '欧式风格4', '欧式风格3', '欧式风格4', '欧式风格4', '<p>欧式风格3</p>', '[]', '0', '0', '0', '1433832607', '1433832620', '2015-06-26', '0');
INSERT INTO `article` VALUES ('14', '4', '工装案例1', '工装案例1', '工装案例1', '工装案例1', '<p>工装案例1</p>', '[]', '0', '0', '0', '1433832634', '1433832634', '2015-06-10', '0');
INSERT INTO `article` VALUES ('15', '4', '工装案例2', '工装案例2', '工装案例2', '工装案例2', '<p>工装案例2</p>', '[]', '0', '0', '0', '1433832649', '1433832649', '2015-06-10', '0');
INSERT INTO `article` VALUES ('16', '4', '工装案例3', '工装案例3', '工装案例3', '工装案例3', '<p>工装案例3</p>', '[]', '0', '0', '0', '1433832661', '1433832661', '2015-06-17', '0');
INSERT INTO `article` VALUES ('17', '2', '装修材料1', '装修材料1', '装修材料1', '装修材料1', '<p>装修材料1</p>', '[]', '0', '0', '0', '1433832675', '1433832675', '2015-06-18', '0');
INSERT INTO `article` VALUES ('18', '2', '装修材料2', '装修材料2', '装修材料2', '装修材料2', '<p>装修材料2</p>', '[]', '0', '0', '0', '1433832700', '1433832700', '2015-06-27', '0');
INSERT INTO `article` VALUES ('19', '2', '装修材料3', '装修材料3', '装修材料3', '装修材料3', '<p>装修材料3</p>', '[]', '0', '0', '0', '1433832717', '1433832717', '2015-06-27', '0');
INSERT INTO `article` VALUES ('20', '6', '水电1', '水电1', '水电1', '水电1', '<p>水电1</p>', '[]', '0', '0', '0', '1433832729', '1433832729', '2015-07-02', '0');
INSERT INTO `article` VALUES ('21', '6', '水电2', '水电2', '水电2', '水电2', '<p>水电2</p>', '[]', '0', '0', '0', '1433832740', '1433832740', '2015-06-26', '0');
INSERT INTO `article` VALUES ('22', '6', '水电3', '水电3', '水电3', '水电3', '<p>水电3</p>', '[]', '0', '0', '0', '1433832752', '1433832752', '2015-07-02', '0');