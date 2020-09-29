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


---Abhishek 22-08-2020
CREATE TABLE plan_types ( `id` INT(11) NOT NULL AUTO_INCREMENT ,  `plan_type` VARCHAR(16) NOT NULL ,  `created_on` DATETIME NULL DEFAULT NULL ,    PRIMARY KEY  (`id`)) ENGINE = InnoDB;

INSERT INTO `plan_types` (`id`, `plan_type`, `created_on`) VALUES (NULL, 'FD', NULL);

INSERT INTO `plan_types` (`id`, `plan_type`, `created_on`) VALUES (NULL, 'RD', NULL);

INSERT INTO `plan_types` (`id`, `plan_type`, `created_on`) VALUES (NULL, 'DAILY', NULL);

INSERT INTO `plan_types` (`id`, `plan_type`, `created_on`) VALUES (NULL, 'MIS', NULL);

CREATE TABLE plan_duration_interest ( `id` INT(11) NOT NULL AUTO_INCREMENT ,  `plan_type_id` INT(11) NOT NULL ,  `plan_year` INT(5) NOT NULL ,  `interest_type` INT(11) NOT NULL ,    PRIMARY KEY  (`id`)) ENGINE = InnoDB;

CREATE TABLE interest_types ( `id` INT(11) NOT NULL AUTO_INCREMENT ,  `interest_type` VARCHAR(32) NOT NULL ,    PRIMARY KEY  (`id`)) ENGINE = InnoDB;

---Abhishek 25-08-2020---
CREATE TABLE `plan_master` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `plan_type` int(11) NOT NULL,
 `plan_no` varchar(32) NOT NULL,
 `plan_name` varchar(64) NOT NULL,
 `plan_year` int(5) NOT NULL,
 `plan_months` int(5) NOT NULL,
 `plan_days` int(5) NOT NULL,
 `plan_pre_maturity_month` int(5) NOT NULL,
 `plan_pre_maturity_percent` int(5) NOT NULL,
 `plan_multiple` int(11) NOT NULL,
 `minimum_amount` int(5) NOT NULL,
 `interest_types` varchar(8) NOT NULL,
 `integrest_rate_general` int(5) NOT NULL,
 `interest_rate_slp` int(5) NOT NULL,
 `monthly_amount` int(5) NOT NULL DEFAULT '0',
 `quarterly_amount` int(5) NOT NULL DEFAULT '0',
 `half_yr_amount` int(5) NOT NULL DEFAULT '0',
 `yearly_amount` int(5) NOT NULL DEFAULT '0',
 `daily_amount` int(5) NOT NULL DEFAULT '0',
 `monthly_percent_mis` int(5) NOT NULL DEFAULT '0',
 `plan_status` int(2) NOT NULL DEFAULT '1',
 `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
 `created_by` int(11) NOT NULL,
 PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2


-- ABhay 30 Aug
--
-- Table structure for table `voucher_receipt_entry`
--

CREATE TABLE `voucher_receipt_entry` (
  `receipt_id` int NOT NULL,
  `voucher_id` int NOT NULL,
  `cr_account_id` int NOT NULL,
  `dr_account_id` int NOT NULL,
  `is_same_branch` int NOT NULL,
  `create_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `voucher_receipt_entry`
--
ALTER TABLE `voucher_receipt_entry`
  ADD PRIMARY KEY (`receipt_id`),
  ADD UNIQUE KEY `voucher_id` (`voucher_id`),
  ADD KEY `cr_account_id` (`cr_account_id`),
  ADD KEY `dr_account_id` (`dr_account_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `voucher_receipt_entry`
--
ALTER TABLE `voucher_receipt_entry`
  MODIFY `receipt_id` int NOT NULL AUTO_INCREMENT;
COMMIT;












CREATE TABLE `voucher_details` (
  `id` int NOT NULL,
  `voucher_date` date NOT NULL,
  `cr_branch_id` int NOT NULL,
  `dr_branch_id` int NOT NULL,
  `type_id` int NOT NULL,
  `transfer_amount` decimal(10,2) NOT NULL,
  `narration` varchar(256) DEFAULT NULL,
  `cheque_no` varchar(28) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `transaction_id` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `transaction_date` date DEFAULT NULL,
  `create_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` int NOT NULL,
  `approved_by` int NOT NULL DEFAULT '0',
  `approved_date` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `voucher_details`
--
ALTER TABLE `voucher_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `dr_branch_id` (`dr_branch_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `voucher_details`
--
ALTER TABLE `voucher_details`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;
COMMIT;

--Abhay sep-10
ALTER TABLE `account_type` ADD `account_tye` INT(11) NULL AFTER `account_name`, ADD `branch_id` INT(11) NULL DEFAULT NULL AFTER `account_tye`;

-- Abhishek 05-september--
ALTER TABLE `users` ADD `is_member` INT(2) NOT NULL DEFAULT '0' AFTER `age`;
ALTER TABLE `users` ADD `is_employee` INT(2) NOT NULL DEFAULT '0' AFTER `is_member`;

--Abhay 21 Sept
ALTER TABLE `voucher_details` ADD `is_approved` INT(11) NOT NULL DEFAULT '1' AFTER `approved_date`;
--
-- Table structure for table `voucher_details_unapproved`
--

CREATE TABLE `voucher_details_unapproved` (
  `id` int NOT NULL,
  `voucher_date` date NOT NULL,
  `cr_branch_id` int NOT NULL,
  `dr_branch_id` int NOT NULL,
  `type_id` int NOT NULL,
  `narration` varchar(256) DEFAULT NULL,
  `create_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` int NOT NULL,
  `approved_by` int DEFAULT NULL,
  `approved_date` timestamp NULL DEFAULT NULL,
  `is_approved` int NOT NULL DEFAULT '0',
  `actual_voucher_id` bigint DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `voucher_receipt_entry_unapproved`
--

CREATE TABLE `voucher_receipt_entry_unapproved` (
  `receipt_id` int NOT NULL,
  `voucher_id` int NOT NULL,
  `cr_account_id` int NOT NULL,
  `dr_account_id` int NOT NULL,
  `amount` decimal(10,2) NOT NULL DEFAULT '0.00',
  `is_same_branch` int NOT NULL,
  `create_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `voucher_transaction_details_unapproved`
--

CREATE TABLE `voucher_transaction_details_unapproved` (
  `id` int NOT NULL,
  `voucher_id` int NOT NULL,
  `transaction_id` varchar(128) DEFAULT NULL,
  `transaction_date` date DEFAULT NULL,
  `cheque_no` varchar(128) DEFAULT NULL,
  `total_amount` decimal(10,2) NOT NULL,
  `create_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `voucher_details_unapproved`
--
ALTER TABLE `voucher_details_unapproved`
  ADD PRIMARY KEY (`id`),
  ADD KEY `dr_branch_id` (`dr_branch_id`);

--
-- Indexes for table `voucher_receipt_entry_unapproved`
--
ALTER TABLE `voucher_receipt_entry_unapproved`
  ADD PRIMARY KEY (`receipt_id`),
  ADD UNIQUE KEY `voucher_id` (`voucher_id`),
  ADD KEY `cr_account_id` (`cr_account_id`),
  ADD KEY `dr_account_id` (`dr_account_id`);

--
-- Indexes for table `voucher_transaction_details_unapproved`
--
ALTER TABLE `voucher_transaction_details_unapproved`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `voucher_details_unapproved`
--
ALTER TABLE `voucher_details_unapproved`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `voucher_receipt_entry_unapproved`
--
ALTER TABLE `voucher_receipt_entry_unapproved`
  MODIFY `receipt_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `voucher_transaction_details_unapproved`
--
ALTER TABLE `voucher_transaction_details_unapproved`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;
COMMIT;

--ABhay 29 Sept
ALTER TABLE `voucher_transaction_details_unapproved` ADD `cheque_date` DATE NULL DEFAULT NULL AFTER `cheque_no`, ADD `cheque_submission_date` DATE NULL DEFAULT NULL AFTER `cheque_date`, ADD `cheque_approve_date` DATE NULL DEFAULT NULL AFTER `cheque_submission_date`;
ALTER TABLE `voucher_transaction_details` ADD `cheque_date` DATE NULL DEFAULT NULL AFTER `cheque_no`, ADD `cheque_submission_date` DATE NULL DEFAULT NULL AFTER `cheque_date`, ADD `cheque_approve_date` DATE NULL DEFAULT NULL AFTER `cheque_submission_date`;
ALTER TABLE `voucher_transaction_details_unapproved` ADD `payment_mode` INT NOT NULL AFTER `voucher_id`;
ALTER TABLE `voucher_transaction_details` ADD `payment_mode` INT NOT NULL AFTER `voucher_id`;













