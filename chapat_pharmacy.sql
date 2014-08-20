/*
Navicat MySQL Data Transfer

Source Server         : Local
Source Server Version : 50516
Source Host           : localhost:3306
Source Database       : chapat_pharmacy

Target Server Type    : MYSQL
Target Server Version : 50516
File Encoding         : 65001

Date: 2014-08-16 13:06:14
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `be_acl_actions`
-- ----------------------------
DROP TABLE IF EXISTS `be_acl_actions`;
CREATE TABLE `be_acl_actions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(254) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of be_acl_actions
-- ----------------------------

-- ----------------------------
-- Table structure for `be_acl_groups`
-- ----------------------------
DROP TABLE IF EXISTS `be_acl_groups`;
CREATE TABLE `be_acl_groups` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `lft` int(10) unsigned NOT NULL DEFAULT '0',
  `rgt` int(10) unsigned NOT NULL DEFAULT '0',
  `name` varchar(254) NOT NULL,
  `link` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`),
  KEY `lft` (`lft`),
  KEY `rgt` (`rgt`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of be_acl_groups
-- ----------------------------
INSERT INTO `be_acl_groups` VALUES ('1', '1', '4', 'Member', null);
INSERT INTO `be_acl_groups` VALUES ('2', '2', '3', 'Administrator', null);

-- ----------------------------
-- Table structure for `be_acl_permissions`
-- ----------------------------
DROP TABLE IF EXISTS `be_acl_permissions`;
CREATE TABLE `be_acl_permissions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `aro_id` int(10) unsigned NOT NULL DEFAULT '0',
  `aco_id` int(10) unsigned NOT NULL DEFAULT '0',
  `allow` char(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `aro_id` (`aro_id`),
  KEY `aco_id` (`aco_id`),
  CONSTRAINT `be_acl_permissions_ibfk_1` FOREIGN KEY (`aro_id`) REFERENCES `be_acl_groups` (`id`) ON DELETE CASCADE,
  CONSTRAINT `be_acl_permissions_ibfk_2` FOREIGN KEY (`aco_id`) REFERENCES `be_acl_resources` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of be_acl_permissions
-- ----------------------------
INSERT INTO `be_acl_permissions` VALUES ('1', '2', '1', 'Y');

-- ----------------------------
-- Table structure for `be_acl_permission_actions`
-- ----------------------------
DROP TABLE IF EXISTS `be_acl_permission_actions`;
CREATE TABLE `be_acl_permission_actions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `access_id` int(10) unsigned NOT NULL DEFAULT '0',
  `axo_id` int(10) unsigned NOT NULL DEFAULT '0',
  `allow` char(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `access_id` (`access_id`),
  KEY `axo_id` (`axo_id`),
  CONSTRAINT `be_acl_permission_actions_ibfk_1` FOREIGN KEY (`access_id`) REFERENCES `be_acl_permissions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `be_acl_permission_actions_ibfk_2` FOREIGN KEY (`axo_id`) REFERENCES `be_acl_actions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of be_acl_permission_actions
-- ----------------------------

-- ----------------------------
-- Table structure for `be_acl_resources`
-- ----------------------------
DROP TABLE IF EXISTS `be_acl_resources`;
CREATE TABLE `be_acl_resources` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `lft` int(10) unsigned NOT NULL DEFAULT '0',
  `rgt` int(10) unsigned NOT NULL DEFAULT '0',
  `name` varchar(254) NOT NULL,
  `link` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`),
  KEY `lft` (`lft`),
  KEY `rgt` (`rgt`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of be_acl_resources
-- ----------------------------
INSERT INTO `be_acl_resources` VALUES ('1', '1', '22', 'Site', null);
INSERT INTO `be_acl_resources` VALUES ('2', '2', '21', 'Control Panel', null);
INSERT INTO `be_acl_resources` VALUES ('3', '3', '20', 'System', null);
INSERT INTO `be_acl_resources` VALUES ('4', '14', '15', 'Members', null);
INSERT INTO `be_acl_resources` VALUES ('5', '4', '13', 'Access Control', null);
INSERT INTO `be_acl_resources` VALUES ('6', '16', '17', 'Settings', null);
INSERT INTO `be_acl_resources` VALUES ('7', '18', '19', 'Utilities', null);
INSERT INTO `be_acl_resources` VALUES ('8', '11', '12', 'Permissions', null);
INSERT INTO `be_acl_resources` VALUES ('9', '9', '10', 'Groups', null);
INSERT INTO `be_acl_resources` VALUES ('10', '7', '8', 'Resources', null);
INSERT INTO `be_acl_resources` VALUES ('11', '5', '6', 'Actions', null);

-- ----------------------------
-- Table structure for `be_backups`
-- ----------------------------
DROP TABLE IF EXISTS `be_backups`;
CREATE TABLE `be_backups` (
  `backup_id` int(11) NOT NULL AUTO_INCREMENT,
  `file` varchar(100) NOT NULL,
  `backup_date` datetime NOT NULL,
  PRIMARY KEY (`backup_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of be_backups
-- ----------------------------

-- ----------------------------
-- Table structure for `be_groups`
-- ----------------------------
DROP TABLE IF EXISTS `be_groups`;
CREATE TABLE `be_groups` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `locked` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `disabled` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  CONSTRAINT `be_groups_ibfk_1` FOREIGN KEY (`id`) REFERENCES `be_acl_groups` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of be_groups
-- ----------------------------
INSERT INTO `be_groups` VALUES ('1', '1', '0');
INSERT INTO `be_groups` VALUES ('2', '1', '0');

-- ----------------------------
-- Table structure for `be_preferences`
-- ----------------------------
DROP TABLE IF EXISTS `be_preferences`;
CREATE TABLE `be_preferences` (
  `name` varchar(254) NOT NULL,
  `value` text NOT NULL,
  KEY `name` (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of be_preferences
-- ----------------------------
INSERT INTO `be_preferences` VALUES ('default_user_group', '1');
INSERT INTO `be_preferences` VALUES ('smtp_host', '');
INSERT INTO `be_preferences` VALUES ('keep_error_logs_for', '30');
INSERT INTO `be_preferences` VALUES ('email_protocol', 'sendmail');
INSERT INTO `be_preferences` VALUES ('use_registration_captcha', '0');
INSERT INTO `be_preferences` VALUES ('page_debug', '0');
INSERT INTO `be_preferences` VALUES ('automated_from_name', 'BPharmacy');
INSERT INTO `be_preferences` VALUES ('allow_user_registration', '1');
INSERT INTO `be_preferences` VALUES ('use_login_captcha', '0');
INSERT INTO `be_preferences` VALUES ('site_name', 'Pharmacy App');
INSERT INTO `be_preferences` VALUES ('automated_from_email', 'noreply@pharmacy.com');
INSERT INTO `be_preferences` VALUES ('account_activation_time', '7');
INSERT INTO `be_preferences` VALUES ('allow_user_profiles', '0');
INSERT INTO `be_preferences` VALUES ('activation_method', 'email');
INSERT INTO `be_preferences` VALUES ('autologin_period', '30');
INSERT INTO `be_preferences` VALUES ('min_password_length', '8');
INSERT INTO `be_preferences` VALUES ('smtp_user', '');
INSERT INTO `be_preferences` VALUES ('smtp_pass', '');
INSERT INTO `be_preferences` VALUES ('email_mailpath', '/usr/sbin/sendmail');
INSERT INTO `be_preferences` VALUES ('smtp_port', '25');
INSERT INTO `be_preferences` VALUES ('smtp_timeout', '5');
INSERT INTO `be_preferences` VALUES ('email_wordwrap', '1');
INSERT INTO `be_preferences` VALUES ('email_wrapchars', '76');
INSERT INTO `be_preferences` VALUES ('email_mailtype', 'html');
INSERT INTO `be_preferences` VALUES ('email_charset', 'utf-8');
INSERT INTO `be_preferences` VALUES ('bcc_batch_mode', '0');
INSERT INTO `be_preferences` VALUES ('bcc_batch_size', '200');
INSERT INTO `be_preferences` VALUES ('login_field', 'both');
INSERT INTO `be_preferences` VALUES ('meta_keywords', 'BPharmacy');
INSERT INTO `be_preferences` VALUES ('meta_description', 'BPharmacy');
INSERT INTO `be_preferences` VALUES ('offline_message', '');
INSERT INTO `be_preferences` VALUES ('theme', 'default');
INSERT INTO `be_preferences` VALUES ('site_status', '1');
INSERT INTO `be_preferences` VALUES ('date_format', 'Y-m-d');
INSERT INTO `be_preferences` VALUES ('date_time_format', 'Y-m-d H:i:s');
INSERT INTO `be_preferences` VALUES ('backup_path', 'backups');
INSERT INTO `be_preferences` VALUES ('google_analytics_tracking_code', '');
INSERT INTO `be_preferences` VALUES ('activate_google_analytics', '0');

-- ----------------------------
-- Table structure for `be_resources`
-- ----------------------------
DROP TABLE IF EXISTS `be_resources`;
CREATE TABLE `be_resources` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `locked` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  CONSTRAINT `be_resources_ibfk_1` FOREIGN KEY (`id`) REFERENCES `be_acl_resources` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of be_resources
-- ----------------------------
INSERT INTO `be_resources` VALUES ('1', '1');
INSERT INTO `be_resources` VALUES ('2', '1');
INSERT INTO `be_resources` VALUES ('3', '1');
INSERT INTO `be_resources` VALUES ('4', '1');
INSERT INTO `be_resources` VALUES ('5', '1');
INSERT INTO `be_resources` VALUES ('6', '1');
INSERT INTO `be_resources` VALUES ('7', '1');
INSERT INTO `be_resources` VALUES ('8', '1');
INSERT INTO `be_resources` VALUES ('9', '1');
INSERT INTO `be_resources` VALUES ('10', '1');
INSERT INTO `be_resources` VALUES ('11', '1');

-- ----------------------------
-- Table structure for `be_shortcuts`
-- ----------------------------
DROP TABLE IF EXISTS `be_shortcuts`;
CREATE TABLE `be_shortcuts` (
  `shortcut_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `link` text NOT NULL,
  `new_window` tinyint(4) NOT NULL,
  `display_order` int(11) NOT NULL,
  `added_date` datetime NOT NULL,
  `status` tinyint(4) NOT NULL,
  PRIMARY KEY (`shortcut_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of be_shortcuts
-- ----------------------------

-- ----------------------------
-- Table structure for `be_users`
-- ----------------------------
DROP TABLE IF EXISTS `be_users`;
CREATE TABLE `be_users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(32) NOT NULL,
  `password` varchar(40) NOT NULL,
  `email` varchar(254) NOT NULL,
  `active` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `group` int(10) unsigned DEFAULT NULL,
  `activation_key` varchar(32) DEFAULT NULL,
  `last_visit` datetime DEFAULT NULL,
  `created` datetime NOT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`),
  KEY `password` (`password`),
  KEY `group` (`group`),
  CONSTRAINT `be_users_ibfk_1` FOREIGN KEY (`group`) REFERENCES `be_acl_groups` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of be_users
-- ----------------------------
INSERT INTO `be_users` VALUES ('1', 'admin', 'c40903e9e4834faee347289c2b14ec9c503321dd', 'doors.bikash@gmail.com', '1', '2', null, '2014-08-16 05:46:11', '2014-07-25 23:56:56', null);
INSERT INTO `be_users` VALUES ('4', 'bikash', 'c40903e9e4834faee347289c2b14ec9c503321dd', 'bikash_mi@yonefu.info', '1', '1', null, '2014-07-26 10:59:53', '2014-07-26 03:04:27', null);

-- ----------------------------
-- Table structure for `be_user_profiles`
-- ----------------------------
DROP TABLE IF EXISTS `be_user_profiles`;
CREATE TABLE `be_user_profiles` (
  `user_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`user_id`),
  CONSTRAINT `be_user_profiles_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `be_users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of be_user_profiles
-- ----------------------------
INSERT INTO `be_user_profiles` VALUES ('1');
INSERT INTO `be_user_profiles` VALUES ('4');

-- ----------------------------
-- Table structure for `ci_sessions`
-- ----------------------------
DROP TABLE IF EXISTS `ci_sessions`;
CREATE TABLE `ci_sessions` (
  `session_id` varchar(40) NOT NULL DEFAULT '0',
  `ip_address` varchar(16) NOT NULL DEFAULT '0',
  `user_agent` varchar(50) NOT NULL,
  `user_data` text NOT NULL,
  `last_activity` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`session_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ci_sessions
-- ----------------------------

-- ----------------------------
-- Table structure for `email_templates`
-- ----------------------------
DROP TABLE IF EXISTS `email_templates`;
CREATE TABLE `email_templates` (
  `email_template_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `slug_name` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `body` text NOT NULL,
  `created_date` datetime NOT NULL,
  `modified_date` datetime NOT NULL,
  PRIMARY KEY (`email_template_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of email_templates
-- ----------------------------

-- ----------------------------
-- Table structure for `layouts`
-- ----------------------------
DROP TABLE IF EXISTS `layouts`;
CREATE TABLE `layouts` (
  `layout_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  PRIMARY KEY (`layout_id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of layouts
-- ----------------------------

-- ----------------------------
-- Table structure for `master_manufacturer`
-- ----------------------------
DROP TABLE IF EXISTS `master_manufacturer`;
CREATE TABLE `master_manufacturer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `manufacturer_name` varchar(40) DEFAULT NULL,
  `address` varchar(50) DEFAULT NULL,
  `country` varchar(20) DEFAULT NULL,
  `pan_no` varchar(255) DEFAULT NULL,
  `telephone_no` int(11) DEFAULT NULL,
  `created_datetime` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `delete_flag` tinyint(1) DEFAULT '0',
  `modified_by` int(11) DEFAULT NULL,
  `modified_datetime` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of master_manufacturer
-- ----------------------------
INSERT INTO `master_manufacturer` VALUES ('1', 'Glaxo', 'kathmandu', 'Nepal', null, null, '2014-07-24 10:31:14', '1', '0', '1', '2014-07-24 10:31:14');
INSERT INTO `master_manufacturer` VALUES ('2', 'Aristo Pharmaceuticals', 'knbar fila, daman', 'Nepal', null, null, '2014-07-27 08:18:41', '1', '0', '1', '2014-07-27 08:18:41');
INSERT INTO `master_manufacturer` VALUES ('3', 'Lalit Pharmaceuticals', 'Balukha tole, lalitpur -19', 'Nepal', '300987278', '533964', '2014-07-27 16:01:25', '1', '0', '1', '2014-07-27 16:04:56');

-- ----------------------------
-- Table structure for `master_pack`
-- ----------------------------
DROP TABLE IF EXISTS `master_pack`;
CREATE TABLE `master_pack` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pack_description` varchar(25) DEFAULT NULL,
  `created_datetime` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `delete_flag` tinyint(1) DEFAULT '0',
  `modified_by` int(11) DEFAULT NULL,
  `modified_datetime` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of master_pack
-- ----------------------------
INSERT INTO `master_pack` VALUES ('1', 'Cream', '2014-07-27 08:42:18', '1', '0', '1', '2014-07-27 08:42:18');
INSERT INTO `master_pack` VALUES ('2', 'powder', '2014-07-27 08:43:04', '1', '1', '1', '2014-07-27 08:43:04');
INSERT INTO `master_pack` VALUES ('3', 'Powder', '2014-07-27 08:43:19', '1', '0', '1', '2014-07-27 08:43:19');
INSERT INTO `master_pack` VALUES ('4', 'Tablet', '2014-07-27 08:43:32', '1', '0', '1', '2014-07-27 08:43:32');
INSERT INTO `master_pack` VALUES ('5', 'Capsule', '2014-07-27 08:43:44', '1', '0', '1', '2014-07-27 08:43:44');
INSERT INTO `master_pack` VALUES ('6', '1\'s', '2014-07-27 16:21:12', '1', '0', '1', '2014-07-27 16:21:12');
INSERT INTO `master_pack` VALUES ('7', '2\'s', '2014-07-27 16:21:31', '1', '0', '1', '2014-07-27 16:21:31');
INSERT INTO `master_pack` VALUES ('8', '5\'s', '2014-07-27 16:21:37', '1', '0', '1', '2014-07-27 16:21:37');
INSERT INTO `master_pack` VALUES ('9', '10\'s', '2014-07-27 16:22:00', '1', '0', '1', '2014-07-27 16:22:00');
INSERT INTO `master_pack` VALUES ('10', '15\'s', '2014-07-27 16:22:10', '1', '0', '1', '2014-07-27 16:22:10');

-- ----------------------------
-- Table structure for `master_supplier`
-- ----------------------------
DROP TABLE IF EXISTS `master_supplier`;
CREATE TABLE `master_supplier` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `supplier_name` varchar(40) DEFAULT NULL,
  `address` varchar(50) DEFAULT NULL,
  `contactno` varchar(20) DEFAULT NULL,
  `created_datetime` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `delete_flag` tinyint(1) DEFAULT '0',
  `modified_by` int(11) DEFAULT NULL,
  `modified_date` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of master_supplier
-- ----------------------------
INSERT INTO `master_supplier` VALUES ('1', 'National Health Care', 'Birgunj, Nepal', '98411277777', '2014-07-26 11:38:18', '1', '0', '1', '2014-07-27');
INSERT INTO `master_supplier` VALUES ('2', 'Win-Medicare Pvt. Ltd', 'New Delhi, India', '1100 19', '2014-07-26 11:40:25', '1', '0', '1', '2014-07-26');
INSERT INTO `master_supplier` VALUES ('3', 'Instyle Pharma pvt ltd', 'Chhetrapati, behind hotel harati', '4266121', '2014-08-11 22:19:34', '1', '0', '1', '2014-08-11');
INSERT INTO `master_supplier` VALUES ('4', 'New road Pharmacy', 'bakhudole, lalitpru', '014245562', '2014-08-11 22:20:41', '1', '0', '1', '2014-08-11');

-- ----------------------------
-- Table structure for `pages`
-- ----------------------------
DROP TABLE IF EXISTS `pages`;
CREATE TABLE `pages` (
  `page_id` int(11) NOT NULL AUTO_INCREMENT,
  `page_title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `image_name` varchar(255) NOT NULL,
  `meta_keywords` text NOT NULL,
  `meta_description` text NOT NULL,
  `created_date` datetime NOT NULL,
  `modified_date` datetime NOT NULL,
  `slug_id` int(11) NOT NULL,
  `slug_name` varchar(250) NOT NULL,
  `status` tinyint(4) NOT NULL,
  PRIMARY KEY (`page_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of pages
-- ----------------------------
INSERT INTO `pages` VALUES ('1', 'Home', '<p>Please log on.</p>', '', '', '', '2014-07-31 17:05:56', '0000-00-00 00:00:00', '1', 'home', '1');

-- ----------------------------
-- Table structure for `settings`
-- ----------------------------
DROP TABLE IF EXISTS `settings`;
CREATE TABLE `settings` (
  `setting_id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(100) NOT NULL,
  `key` varchar(100) NOT NULL,
  `value` text NOT NULL,
  PRIMARY KEY (`setting_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of settings
-- ----------------------------

-- ----------------------------
-- Table structure for `slugs`
-- ----------------------------
DROP TABLE IF EXISTS `slugs`;
CREATE TABLE `slugs` (
  `slug_id` int(11) NOT NULL AUTO_INCREMENT,
  `slug_name` varchar(250) NOT NULL,
  `route` varchar(255) NOT NULL,
  PRIMARY KEY (`slug_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of slugs
-- ----------------------------
INSERT INTO `slugs` VALUES ('1', 'home', 'page/index/1');

-- ----------------------------
-- Table structure for `tbl_item`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_item`;
CREATE TABLE `tbl_item` (
  `item_id` int(11) NOT NULL AUTO_INCREMENT,
  `item_code` varchar(100) DEFAULT NULL,
  `item_description` varchar(255) DEFAULT NULL,
  `manufacture_id` int(11) DEFAULT NULL,
  `supplier_id` int(11) DEFAULT NULL,
  `pack_id` int(11) DEFAULT NULL,
  `manufactured_date` date DEFAULT NULL,
  `expiry_date` date DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `cost_price` float DEFAULT NULL,
  `sell_price` float DEFAULT NULL COMMENT 'sellprice->MRP',
  `currency` varchar(10) DEFAULT NULL,
  `remarks` varchar(255) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_datetime` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `delete_flag` tinyint(4) DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `modified_datetime` datetime DEFAULT NULL,
  PRIMARY KEY (`item_id`),
  KEY `supplier_id` (`supplier_id`),
  KEY `tbl_item_ibfk_2` (`manufacture_id`),
  KEY `pack_id` (`pack_id`),
  CONSTRAINT `tbl_item_ibfk_1` FOREIGN KEY (`supplier_id`) REFERENCES `master_supplier` (`id`),
  CONSTRAINT `tbl_item_ibfk_2` FOREIGN KEY (`manufacture_id`) REFERENCES `master_manufacturer` (`id`),
  CONSTRAINT `tbl_item_ibfk_3` FOREIGN KEY (`pack_id`) REFERENCES `master_pack` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tbl_item
-- ----------------------------
INSERT INTO `tbl_item` VALUES ('1', '010045', 'PROTOGYL DF SUSPs 50ml', null, null, '4', null, null, null, null, null, null, '', '1', '2014-07-27 18:56:35', '0', '1', '2014-07-27 18:56:35');
INSERT INTO `tbl_item` VALUES ('2', '010075', 'NORMA 20 CAPS', null, null, '10', null, null, null, null, null, null, '', '1', '2014-07-27 18:57:52', '0', '1', '2014-07-27 18:57:52');

-- ----------------------------
-- Table structure for `tbl_purchase`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_purchase`;
CREATE TABLE `tbl_purchase` (
  `purchase_master_id` int(11) NOT NULL AUTO_INCREMENT,
  `invoice_no` varchar(255) DEFAULT NULL,
  `total` float DEFAULT NULL,
  `less_discount` float DEFAULT NULL,
  `net_total` float DEFAULT NULL,
  `received_by` varchar(255) DEFAULT NULL,
  `supplier_id` int(11) DEFAULT NULL,
  `memo_type` varchar(100) DEFAULT NULL COMMENT 'cash/credit',
  `created_by` int(11) DEFAULT NULL,
  `created_datetime` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `delete_flag` tinyint(4) DEFAULT NULL,
  `modified_by` int(11) NOT NULL,
  `modified_datetime` datetime DEFAULT NULL,
  PRIMARY KEY (`purchase_master_id`),
  KEY `supplier_id` (`supplier_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tbl_purchase
-- ----------------------------
INSERT INTO `tbl_purchase` VALUES ('1', '3098', '0', '0', '0', '0', '1', 'cash', '1', '2014-08-15 21:16:47', '0', '1', '2014-08-15 21:16:47');

-- ----------------------------
-- Table structure for `tbl_purchase_detail`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_purchase_detail`;
CREATE TABLE `tbl_purchase_detail` (
  `purchase_detail_id` int(11) NOT NULL AUTO_INCREMENT,
  `purchase_master_id` int(11) DEFAULT NULL,
  `item_code` varchar(25) DEFAULT NULL,
  `item_description` varchar(255) DEFAULT NULL,
  `pack` int(11) DEFAULT NULL,
  `batch` varchar(50) DEFAULT NULL,
  `expiry_date` date DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `cc_rate` float DEFAULT NULL,
  `amount` float DEFAULT NULL,
  `mrp` float DEFAULT NULL,
  `created_datetime` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT NULL,
  `delete_flag` tinyint(4) DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `modified_datetime` datetime DEFAULT NULL,
  PRIMARY KEY (`purchase_detail_id`),
  KEY `purchase_master_id` (`purchase_master_id`),
  KEY `pack` (`pack`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tbl_purchase_detail
-- ----------------------------
INSERT INTO `tbl_purchase_detail` VALUES ('1', '1', 'btekls', 'sphinx', '1', '23kjk', '0000-00-00', '0', '0', '0', '0', '2014-08-15 21:17:14', '1', '0', '1', '2014-08-15 21:17:14');
INSERT INTO `tbl_purchase_detail` VALUES ('2', '1', 'sdjf7878', 'cetamol', '2', 'uiui', '0000-00-00', '0', '0', '0', '0', '2014-08-15 21:17:35', '1', '0', '1', '2014-08-15 21:17:35');

-- ----------------------------
-- Table structure for `tbl_sales_detail`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_sales_detail`;
CREATE TABLE `tbl_sales_detail` (
  `sales_detail_id` int(11) NOT NULL DEFAULT '0',
  `sales_master_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `price` float DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `created_datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` int(11) NOT NULL,
  `delete_flag` tinyint(1) DEFAULT '0',
  `modified_by` int(11) DEFAULT NULL,
  `modified_datetime` datetime DEFAULT NULL,
  PRIMARY KEY (`sales_detail_id`),
  KEY `fk_salesdtl_sales_mst_id` (`sales_master_id`),
  KEY `fk_salesdtl_item_id` (`item_id`),
  CONSTRAINT `tbl_sales_detail_ibfk_1` FOREIGN KEY (`sales_master_id`) REFERENCES `tbl_sales_master` (`sales_master_id`),
  CONSTRAINT `tbl_sales_detail_ibfk_2` FOREIGN KEY (`item_id`) REFERENCES `tbl_item` (`item_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tbl_sales_detail
-- ----------------------------

-- ----------------------------
-- Table structure for `tbl_sales_master`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_sales_master`;
CREATE TABLE `tbl_sales_master` (
  `sales_master_id` int(11) NOT NULL DEFAULT '0',
  `sales_date` date DEFAULT NULL,
  `amount` float DEFAULT NULL,
  `sold_by` varchar(50) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `delete_flag` tinyint(1) DEFAULT '0',
  `modified_by` int(11) DEFAULT NULL,
  `modified_datetime` datetime DEFAULT NULL,
  PRIMARY KEY (`sales_master_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tbl_sales_master
-- ----------------------------