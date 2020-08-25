DROP TABLE IF EXISTS `groups`;

#
# Table structure for table 'groups'
#

CREATE TABLE `groups` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

#
# Dumping data for table 'groups'
#

INSERT INTO `groups` (`id`, `name`, `description`) VALUES
     (1,'admin','Administrator'),
     (2,'members','General User');



DROP TABLE IF EXISTS `users`;

#
# Table structure for table 'users'
#

CREATE TABLE `users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(45) NOT NULL,
  `username` varchar(100) NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(254) NOT NULL,
  `activation_selector` varchar(255) DEFAULT NULL,
  `activation_code` varchar(255) DEFAULT NULL,
  `forgotten_password_selector` varchar(255) DEFAULT NULL,
  `forgotten_password_code` varchar(255) DEFAULT NULL,
  `forgotten_password_time` int(11) unsigned DEFAULT NULL,
  `remember_selector` varchar(255) DEFAULT NULL,
  `remember_code` varchar(255) DEFAULT NULL,
  `created_on` int(11) unsigned NOT NULL,
  `last_login` int(11) unsigned DEFAULT NULL,
  `active` tinyint(1) unsigned DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `company` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `uc_email` UNIQUE (`email`),
  CONSTRAINT `uc_activation_selector` UNIQUE (`activation_selector`),
  CONSTRAINT `uc_forgotten_password_selector` UNIQUE (`forgotten_password_selector`),
  CONSTRAINT `uc_remember_selector` UNIQUE (`remember_selector`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


#
# Dumping data for table 'users'
#

INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `email`, `activation_code`, `forgotten_password_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`) VALUES
     ('1','127.0.0.1','administrator','$2y$08$200Z6ZZbp3RAEXoaWcMA6uJOFicwNZaqk4oDhqTUiFXFe63MG.Daa','admin@admin.com','',NULL,'1268889823','1268889823','1', 'Admin','istrator','ADMIN','0');


DROP TABLE IF EXISTS `users_groups`;

#
# Table structure for table 'users_groups'
#

CREATE TABLE `users_groups` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `group_id` mediumint(8) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_users_groups_users1_idx` (`user_id`),
  KEY `fk_users_groups_groups1_idx` (`group_id`),
  CONSTRAINT `uc_users_groups` UNIQUE (`user_id`, `group_id`),
  CONSTRAINT `fk_users_groups_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `fk_users_groups_groups1` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES
     (1,1,1),
     (2,1,2);


DROP TABLE IF EXISTS `login_attempts`;

#
# Table structure for table 'login_attempts'
#

CREATE TABLE `login_attempts` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(45) NOT NULL,
  `login` varchar(100) NOT NULL,
  `time` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


---20-08-2020 Abhishek
ALTER TABLE `users` ADD `gender` VARCHAR(16) NULL DEFAULT NULL AFTER `phone`;
ALTER TABLE `users` ADD `dob` VARCHAR(16) NULL DEFAULT NULL AFTER `gender`, ADD `age` INT(5) NULL DEFAULT NULL AFTER `dob`;
ALTER TABLE `members` ADD `member_user_id` INT(11) NOT NULL AFTER `id`;
CREATE TABLE `members` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `member_user_id` int(11) NOT NULL,
 `form_no` varchar(32) DEFAULT NULL,
 `reg_date` varchar(16) NOT NULL,
 `gurdian_type` varchar(8) NOT NULL,
 `gurdian_name` varchar(62) NOT NULL,
 `address` text,
 `state` int(11) NOT NULL,
 `district` int(11) NOT NULL,
 `city` varchar(32) NOT NULL,
 `village` varchar(32) NOT NULL,
 `pincode` int(11) NOT NULL,
 `alt_number` varchar(16) NOT NULL,
 `idproof` varchar(32) NOT NULL,
 `id_number` varchar(32) NOT NULL,
 `address_proof` varchar(32) NOT NULL,
 `add_id_number` varchar(32) DEFAULT NULL,
 `n_name` varchar(32) NOT NULL,
 `n_relation` varchar(16) NOT NULL,
 `n_gender` varchar(16) NOT NULL,
 `ndob` varchar(16) NOT NULL,
 `n_age` int(5) NOT NULL,
 `n_address` text,
 `bank_name` varchar(64) DEFAULT NULL,
 `ifsc` varchar(16) DEFAULT NULL,
 `account_no` varchar(32) DEFAULT NULL,
 `pan_no` varchar(15) DEFAULT NULL,
 `branch` int(11) NOT NULL,
 `branch_address` varchar(128) DEFAULT NULL,
 `member_type` varchar(16) NOT NULL,
 `num_share` int(11) NOT NULL,
 `applicant_charge` int(11) NOT NULL,
 `total_payable` int(11) NOT NULL,
 PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1



