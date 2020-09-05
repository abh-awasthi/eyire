

CREATE TABLE `sms_template` (
  `id` int(11) NOT NULL,
  `tag` varchar(50) NOT NULL,
  `template` mediumtext NOT NULL,
  `comments` varchar(1024) DEFAULT NULL,
  `active` varchar(10) NOT NULL,
  `is_exception_for_length` int(1) NOT NULL DEFAULT '0',
  `create_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sms_template`
--

INSERT INTO `sms_template` (`id`, `tag`, `template`, `comments`, `active`, `is_exception_for_length`, `create_date`) VALUES
(1, 'new_vendor_creation', 'Welcome dear %s, thanks for joining 247around network. Hope to have a long lasting relationship with you. 247around 9555000247', NULL, '0', 0, '2019-09-16 12:20:41'),
(2, 'add_new_booking', 'Your %s %s is confirmed on %s, ID %s. For support call %s. 247Around, %s Service Partner. Download Jobcard %s', NULL, '1', 1, '2019-05-13 07:48:06'),
(3, 'complete_booking', 'Your %s %s completed (%s). Enjoyed Service? Yes, miss call on 01140849145. If not, 01140849146. 247Around, %s Service Partner', NULL, '1', 1, '2019-04-02 04:51:44'),
(4, 'cancel_booking', 'Dear Customer, Sorry! Your %s %s is cancelled in our system. You did not do this? Contact us on %s. To re-book call 9555000247', NULL, '1', 1, '2020-01-03 05:12:52'),
(5, 'reschedule_booking', 'Reschedule request received for %s(%s) to %s. If reschedule is fake, give missed call @ 01140849136 or call 9555000247', NULL, '0', 0, '2019-09-16 12:20:05'),
(6, 'new_snapdeal_booking', 'Got it! Request for %s is confirmed for %s,%s. 247around India\'s 1st Multibrand Appliance Care & Snapdeal Partner 9555000247', NULL, '1', 0, '2017-02-15 19:54:53'),
(7, 'sd_shipped_free', 'Congratulations for buying %s from Snapdeal, your product has been shipped. Please call 9555000247 for %s. 247around.', 'SMS for shipped products where installation is free', '1', 0, '2016-06-13 14:02:34'),
(8, 'sd_shipped_ac', 'Congratulations for buying Air Conditioner from Snapdeal, your product has been shipped. Please call 9555000247 for installation @ %s. 247around. T&C apply.', 'SMS for shipped AC where installation is paid', '1', 0, '2016-06-13 14:02:44'),
(9, 'service_centre_assigned', 'Your booking is assigned to 247around service center. Engineer will visit in the time slot. Queries? Call %s.', NULL, '0', 0, '2019-09-16 12:18:39'),
(10, 'call_not_picked', 'Hello %s! 247around specialist tried to reach you for your %s service request. Please call @ 9555000247 and we would be glad to help you.', NULL, '1', 0, '2016-07-26 08:29:13'),
(11, 'vendor_invoice_mailed', 'Dear Partner, %s Invoice for %s, Amount Rs. %s was sent to your email id. Kindly review and let us know if any issue. 247around Team', 'SMS sent after generating monthly invoices', '0', 0, '2019-09-16 12:19:41'),
(12, 'payment_made_to_vendor', 'Dear 247around Partner, Payment against Invoices for %s are settled now. Please call us for any issues @ 9555000247.', 'send sms to vendor once payment is made', '0', 0, '2020-05-14 13:32:40'),
(13, 'new_booking_for_vendor', 'Congrats! You Have New Booking For %s On Email From 247Around. Pls Assign Engineer. Dont Forget To Smile When You Meet Customer. 247Around - 8130572244', 'Send SMS to vendor on new booking', '0', 0, '2016-09-22 06:39:02'),
(14, 'complete_booking_snapdeal', 'Your %s request is completed by 247around. If you are HAPPY with the service, give miss call @ %s. If not, give miss call @ %s.', NULL, '1', 0, '2017-06-12 18:40:40'),
(15, 'call_not_picked_snapdeal', 'Hello %s! 247around, Snapdeal Partner, tried to reach you for your %s installation. Please call @ 9555000247 for installation. Thank you.', NULL, '1', 0, '2016-07-26 08:27:25'),
(16, 'call_not_picked_other', 'Dear Customer, we were unable to contact you for your %s. Call will be cancelled after 3 attempts. Call@9555000247. 247around', NULL, '1', 0, '2018-10-12 12:22:53'),
(17, 'missed_call_confirmed', 'Thank you for the delivery confirmation, %s Installation & Demo of your %s would be done %s. Installation Powered by 247around.com', 'SMS sent when customer gives a missed call to confirm delivery', '1', 0, '2016-09-22 10:05:25'),
(18, 'sd_shipped_missed_call_initial', 'Give missed call after delivery for %s Installation %s. Installation Charges %s. Installation by 247around, Snapdeal Partner', '1st SMS sent to customer when SD shipped file is uploaded.', '1', 0, '2017-02-15 04:26:48'),
(20, 'missed_call_booking_not_found', 'Oops, we could not find your booking. Please give missed call from your registered mobile no for Installation & Demo. Installation Powered by 247around.com.', 'SMS sent when missed call is received but no booking is found for user', '1', 0, '2016-09-22 07:07:24'),
(21, 'sd_delivered_missed_call_initial', 'Give missed call after delivery for %s Installation %s. Installation Charges %s. Installation by 247around, Snapdeal Partner', '1st SMS sent to customer when SD delivered file is uploaded.', '1', 0, '2017-02-15 04:26:48'),
(22, 'sd_edd_missed_call_reminder', 'Give missed call after delivery for %s Installation %s. Installation Charges %s. Installation by 247around, Snapdeal Partner', 'Reminder SMS to SD customer before EDD for delivery confirmation', '1', 0, '2017-02-18 09:02:04'),
(24, 'partner_missed_call_welcome_sms', 'We have received your request for Installation / Repair. Our team will call you soon to get your complete details. 247around.', NULL, '1', 0, '2016-12-31 10:02:15'),
(25, 'home_theater_repair', 'Thank you, your %s Service is confirmed. Please contact %s for your service center visit. Address %s. 9555000247, 247around', '', '1', 1, '2019-11-26 09:00:01'),
(26, 'paytm_shipped_missed_call_initial', 'Give missed call after delivery for %s Installation %s. Installation Charges %s. Installation by 247around, Paytm Partner', '1st SMS sent to customer when Paytm shipped file is uploaded.', '1', 0, '2017-04-08 15:34:54'),
(28, 'missed_call_initial_prod_desc_not_found', 'Give missed call after delivery for %s %s %s. 247around, %s Partner', '1st SMS sent to customer when shipped file is uploaded and prod desc is not found.', '1', 0, '2019-12-18 12:54:22'),
(29, 'completed_promotional_sms_1', 'We are delighted to have served you in the past. Avail Rs. %s discount on your next appliance repair. Book on 9555000247 | goo.gl/m0iAcS | www.247around.com.', 'Sms sent when booking status is completed and month is even for promotional sms', '1', 0, '2017-05-25 13:29:52'),
(30, 'completed_promotional_sms_2', 'We are delighted to have served you in past & added Rs. %s balance. Use it in your next appliance repair. Book on 9555000247 | goo.gl/m0iAcS | www.247around.com.', 'Sms sent when booking status is completed and month is odd for promotional sms', '1', 0, '2017-05-25 12:47:13'),
(31, 'poor_rating_on_completion', 'Hmm! You Rated Us %d. We Would Come Back With Better Experience. Book MultiBrand Appliance Installation & Repair on www.247around.com or Android App 9555000247', 'send this sms for poor rating on completed booking', '1', 0, '2017-05-16 15:59:13'),
(32, 'avg_rating_on_completion', 'Hmm! You Rated Us %d. We Would Come Back With Better Experience. Book MultiBrand Appliance Installation & Repair on www.247around.com or Android App 9555000247', 'send this sms on average rating on completed booking', '0', 0, '2019-09-16 12:20:52'),
(33, 'good_rating_on_completion', 'Wow! You Rated Us %d. Appreciate Your Feedback. For MultiBrand Appliance Installation and Repair, Call 9555000247 | www.247around.com | http://goo.gl/m0iAcS', 'send this sms on good rating on completed booking', '0', 0, '2019-09-16 12:13:42'),
(34, 'partner_missed_call_for_installation', 'Give missed call after delivery for %s %s %s. %s Charges %s. 247around, %s Partner', 'SMS sent to customer when shipped/delivered file is uploaded.', '1', 0, '2019-12-18 12:54:13'),
(35, 'missed_call_rating_sms', 'Your request is completed by 247around. If you are HAPPY with the service, give miss call @ %s. If not, give miss call @ %s. 247around.', 'Rating SMS template, taken through Missed Call', '1', 0, '2017-06-08 07:32:33'),
(36, 'booking_details_to_dealer', 'New Request for %s %s from %s confirmed for %s. ID %s. Contact Customer@%s', 'Send sms To dealer When New booking created', '1', 0, '2018-10-12 12:22:53'),
(37, 'prepaid_low_balance', 'Dear partner, your current balance %s is running low. Please recharge your account urgently for uninterrupted service. 247around Team', 'Send sms to Partners for low balance', '0', 0, '2019-09-16 12:19:53'),
(38, 'rescheduled_confirmation_sms', 'Reschedule request received for %s(%s) to %s. If reschedule is fake, give missed call @ 01140849136.', 'Send When SF rescheduled a booking, to confirm is reschedule fake?', '0', 0, '2019-09-16 12:08:20'),
(39, 'prepaid_negative_balance', 'Your 247Around account is Suspended because of -ve balance (Rs %s) & all services are Stopped. Please recharge your account Immediately. 247around Team', '', '0', 0, '2019-09-16 12:20:17'),
(40, 'customer_qr_download', 'Get 5 Percent Cashback On Your %s Booking. Download QR Code from %s Or Engineer Job Card & Pay On Paytm App. Use Paytm even if technician refuses and asks for Cash. 5 Percent Discount ONLY available on Payments made through Paytm. %s 247around', '', '0', 1, '2019-09-16 12:09:18'),
(41, 'customer_paid_invoice', 'Rs. %s received for %s. Download invoice from %s. Pay through Paytm for 5 Percent Cashback. 9555000247, 247around', '', '1', 0, '2018-10-12 12:22:53'),
(42, 'customer_paid_invoice_pdf_not_generated', 'We have received payment of Rs. %s against Booking ID %s. Get 5 Percent Cashback when you make payment through Paytm. 9555000247, 247around.', '', '1', 0, '2018-03-27 09:29:19'),
(43, 'cashback_processed_to_customer', 'Congrats, Your cashback of Rs. %s for Booking ID %s has been processed. Hope to serve you soon again, 9555000247 247Around.', NULL, '1', 0, '2018-04-24 11:19:18'),
(47, 'gateway_payment_link_sms', 'Dear Customer, Please click on this link %s to complete the payment of %s for 247around.', '', '1', 0, '2018-04-04 09:06:43'),
(48, 'customer_not_reachable_for_rating', 'Hello %s! 247around team tried to reach you for feedback. If service was good, give missed call %s. If not, give miss call %s', 'Send to Customer, when marked by no reachable in case of rating', '0', 0, '2019-09-16 12:12:43'),
(49, 'flipkart_google_sms', 'Give missed call for Google Home (Smart Speaker & Home Assistant) Demo @ 01139595247. Demo by 247around, Flipkart Partner.', '', '1', 0, '2018-04-25 05:52:28'),
(50, 'flipkart_google_scheduled_sms', 'Kudos to you for placing Google Home demo request. Check Super Answer Video from Google http://bit.ly/2L9kYZy | http://bit.ly/2s4PzAc | http://bit.ly/2INmjUE - 247around Flipkart Partner', '', '1', 0, '2018-07-12 06:08:32'),
(51, 'cp_outstanding_sms', 'Dear Partner, Buyback balance %s is LOW. Please deposit funds in 247around Bank Account to continue getting orders. 247around Team.', '', '1', 0, '2018-07-06 10:30:34'),
(52, 'sms_to_vendor_poc', '%s', '', '1', 0, '2018-10-04 11:46:59'),
(53, 'broadcast_sms_to_vendor', '%s', '', '1', 0, '2018-12-04 04:50:59'),
(54, 'upcountry_add_new_booking', 'Your %s %s is confirmed and will be completed in 3 working days. ID %s. For Support call %s. 247Around, %s Service Partner. Download Jobcard %s', NULL, '1', 1, '2019-05-13 07:48:06'),
(55, 'sms_to_dealer_on_booking_cancelled', 'Request of %s for %s with booking_id %s is cancelled.', 'when booking cancelled and booking related to dealer,inform dealer about booking.', '1', 0, '2019-02-28 10:59:59'),
(56, 'sms_to_dealer_on_booking_completion', 'Request of %s for %s with booking_id %s is completed.', 'when booking completed and booking related to dealer,inform dealer about booking.', '1', 0, '2019-02-28 10:59:40'),
(57, 'sms_requested_customer_tag', 'Request of %s for %s is placed. You’ll get SMS on delivery. Thanks, 247around, %s.', '', '0', 0, '2019-09-16 12:19:13'),
(58, 'sms_requested_dealer_sms_tag', 'Request of %s for %s %s is placed. You’ll get an SMS on delivery. Thanks, 247around, 9555000247', '', '0', 0, '2019-09-16 12:19:01'),
(59, 'sms_delivered_customer_tag', 'Expected delivery of %s, %s is today. Engineer will visit in time slot. 247around %s.', '', '0', 0, '2019-09-16 12:17:31'),
(60, 'send_whatsapp_number_tag', 'Dear Customer, To confirm your repair booking please Whatsapp %s %s Bill on %s. 247around %s Service Partner', NULL, '0', 0, '2019-09-16 12:18:50'),
(61, 'sms_to_dealer_on_booking_completed_cancelled', 'Request of %s for %s with booking_id %s is %s.', NULL, '1', 0, '2019-04-15 18:59:32'),
(62, 'sms_oow_spare_parts_customer_tag', 'Request of your payable %s for %s is placed. You will get SMS on delivery. 247around, %s.', '', '1', 0, '2019-05-15 11:18:57'),
(63, 'sms_in_warranty_spare_parts_customer_tag', 'Request of your free %s for %s is placed. You will get SMS on delivery. 247around, %s.', '', '0', 0, '2019-09-16 12:12:01'),
(64, 'videocon_not_picked_sms', 'Dear Customer, We were unable to contact you. To confirm booking Whatsapp your %s %s bill on %s. 247around, %s Partner.', NULL, '0', 0, '2019-09-16 12:13:12'),
(65, 'videocon_cancelled_booking_sms', 'Sorry! Your %s booking is cancelled. For support call %s, 247around %s Service Partner.', NULL, '1', 0, '2019-06-05 11:15:17'),
(66, 'booking_details_to_sf', 'Booking - %s, %s, %s, %s/%s, %s, %s. 247around', NULL, '1', 1, '2019-11-22 11:47:52'),
(67, 'engineer_login_sms_template', ' Hi %S,Your Engineer Login is created.User Id - %s,Password - %s. download engineer app from https://tinyurl.com/y5lm3k2g ', NULL, '1', 0, '2019-08-12 05:47:20'),
(68, 'appliance_installation_video_link', 'Hi %s,\r\nClick on the link to watch Installation demo video of %s link - %s\r\n247around', NULL, '1', 0, '2019-11-04 12:32:16'),
(69, 'send_complete_whatsapp_number_tag', 'Dear %s, %s of your %s is completed against booking id: %s on %s by %s. Thank you for choosing us! 247around, %s Service Partner', NULL, '1', 1, '2020-03-19 13:36:00'),
(70, 'send_notification_on_engg_assign', ' Hi %s, Booking ID- %s is assigned to you . ', 'This is used to send to notification to engg when booking is assigned to him', '1', 0, '2019-08-06 09:44:24'),
(71, 'booking_cancel_otp_sms', 'Dear Customer,\r\n\r\nYour one time password for booking cancellation is %s.', NULL, '1', 0, '2020-05-27 03:57:57'),
(72, 'booking_reschedule_otp_sms', 'Dear Customer,\r\n\r\nYour one time password for booking reschedule is %s.', NULL, '1', 0, '2020-05-27 03:57:57');


ALTER TABLE `sms_template`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `tag` (`tag`);


ALTER TABLE `sms_template`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;
