-- 参与用户
DROP TABLE IF EXISTS `wildidea_wi_chat_join`;
CREATE TABLE `wildidea_wi_chat_join` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '参与ID',
  `user_id` int(11) NOT NULL COMMENT '参与用户UID',
  `user_name` varchar(100) NOT NULL COMMENT '参与用户UNAME',
  `ip` int(11) DEFAULT NULL COMMENT '首次参加时的IP',
  `create_time` int(11) DEFAULT NULL COMMENT '首次参与时间',
  PRIMARY KEY(`id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

-- 消息内容
DROP TABLE IF EXISTS `wildidea_wi_chat_content`;
CREATE TABLE `wildidea_wi_chat_content` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '消息ID',
  `from_uid` int(11) NOT NULL COMMENT '发送消息者UID',
  `from_uname` varchar(100) NOT NULL COMMENT '发送消息者UNAME',
  `content` text NOT NULL COMMENT '消息内容',
  `ip` int(11) DEFAULT NULL COMMENT '发送消息时的IP',
  `create_time` int(11) DEFAULT NULL COMMENT '消息发送时间',
  `state` tinyint(1) NOT NULL DEFAULT 1 COMMENT '消息状态',
  PRIMARY KEY(`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;
