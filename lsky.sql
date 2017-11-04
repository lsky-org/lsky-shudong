--
-- Table structure for table `article`
--

DROP TABLE IF EXISTS `article`;
CREATE TABLE `article` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `name` char(32) COLLATE utf8_unicode_ci NOT NULL COMMENT '名字',
  `sex` tinyint(1) NOT NULL DEFAULT '1' COMMENT '性别，1：男，2：女，0：未知',
  `qq` char(32) COLLATE utf8_unicode_ci NOT NULL COMMENT 'QQ',
  `content` text COLLATE utf8_unicode_ci NOT NULL COMMENT '树洞内容',
  `ip` char(32) COLLATE utf8_unicode_ci NOT NULL COMMENT 'IP',
  `is_anonymous` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否匿名',
  `send_time` int(11) NOT NULL COMMENT '发布时间',
  `is_delete` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否删除',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;