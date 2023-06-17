
DROP TABLE IF EXISTS `academic_data`;

CREATE TABLE `academic_data` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `academic_domain_title` varchar(255) DEFAULT NULL,
  `academic_domain_data` text DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `timestamp` timestamp NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;




DROP TABLE IF EXISTS `academic_qualification`;

CREATE TABLE `academic_qualification` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `degree` text DEFAULT NULL,
  `research` text DEFAULT NULL,
  `university` text DEFAULT NULL,
  `major_field` text DEFAULT NULL,
  `file` text DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;




DROP TABLE IF EXISTS `assign_module`;

CREATE TABLE `assign_module` (
  `assign_module_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_role` varchar(300) DEFAULT NULL,
  `menu_page` varchar(300) DEFAULT NULL,
  `assign_module_add_date` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`assign_module_id`)
) ENGINE=InnoDB AUTO_INCREMENT=316 DEFAULT CHARSET=latin1;

INSERT INTO `assign_module` VALUES("69","manager","executive_summary.php","2023-06-12 17:04:44");
INSERT INTO `assign_module` VALUES("70","manager","research.php ","2023-06-12 17:04:44");
INSERT INTO `assign_module` VALUES("71","manager","academic.php","2023-06-12 17:04:44");
INSERT INTO `assign_module` VALUES("72","manager","other_contributions.php","2023-06-12 17:04:44");
INSERT INTO `assign_module` VALUES("73","manager","personal_mission.php","2023-06-12 17:04:44");
INSERT INTO `assign_module` VALUES("74","manager","academic_qualification.php","2023-06-12 17:04:44");
INSERT INTO `assign_module` VALUES("75","manager","professional_experience.php","2023-06-12 17:04:44");
INSERT INTO `assign_module` VALUES("280","administrator","assign_rights.php","2023-06-17 15:29:06");
INSERT INTO `assign_module` VALUES("281","administrator","add_remove_user_roles.php","2023-06-17 15:29:06");
INSERT INTO `assign_module` VALUES("282","administrator","users.php","2023-06-17 15:29:06");
INSERT INTO `assign_module` VALUES("283","administrator","backup.php","2023-06-17 15:29:06");
INSERT INTO `assign_module` VALUES("284","administrator","executive_summary.php","2023-06-17 15:29:06");
INSERT INTO `assign_module` VALUES("285","administrator","research.php ","2023-06-17 15:29:06");
INSERT INTO `assign_module` VALUES("286","administrator","academic.php","2023-06-17 15:29:06");
INSERT INTO `assign_module` VALUES("287","administrator","other_contributions.php","2023-06-17 15:29:06");
INSERT INTO `assign_module` VALUES("288","administrator","personal_mission.php","2023-06-17 15:29:06");
INSERT INTO `assign_module` VALUES("289","administrator","academic_qualification.php","2023-06-17 15:29:06");
INSERT INTO `assign_module` VALUES("290","administrator","professional_experience.php","2023-06-17 15:29:06");
INSERT INTO `assign_module` VALUES("291","administrator","generate_pdf.php","2023-06-17 15:29:06");
INSERT INTO `assign_module` VALUES("292","administrator","statement_teaching.php","2023-06-17 15:29:06");
INSERT INTO `assign_module` VALUES("293","administrator","taught_course_details.php","2023-06-17 15:29:06");
INSERT INTO `assign_module` VALUES("294","administrator","course_develop.php","2023-06-17 15:29:06");
INSERT INTO `assign_module` VALUES("295","administrator","curriculum_develop.php","2023-06-17 15:29:06");
INSERT INTO `assign_module` VALUES("296","administrator","traning_conducted.php","2023-06-17 15:29:06");
INSERT INTO `assign_module` VALUES("297","administrator","research_profile.php","2023-06-17 15:29:06");
INSERT INTO `assign_module` VALUES("298","administrator","research_statement.php","2023-06-17 15:29:06");
INSERT INTO `assign_module` VALUES("299","administrator","research_output.php","2023-06-17 15:29:06");
INSERT INTO `assign_module` VALUES("300","administrator","books_authored.php","2023-06-17 15:29:06");
INSERT INTO `assign_module` VALUES("301","administrator","funded_researchprojects.php","2023-06-17 15:29:06");
INSERT INTO `assign_module` VALUES("302","administrator","funded_researchprojects.php","2023-06-17 15:29:06");
INSERT INTO `assign_module` VALUES("303","administrator","patents.php","2023-06-17 15:29:06");
INSERT INTO `assign_module` VALUES("304","administrator","research_supervision.php","2023-06-17 15:29:06");
INSERT INTO `assign_module` VALUES("305","administrator","reviewer_ofresearcharticles.php","2023-06-17 15:29:06");
INSERT INTO `assign_module` VALUES("306","administrator","external_examiner.php","2023-06-17 15:29:06");
INSERT INTO `assign_module` VALUES("307","administrator","collaboration_established.php","2023-06-17 15:29:06");
INSERT INTO `assign_module` VALUES("308","administrator","initiatives_taken.php","2023-06-17 15:29:06");
INSERT INTO `assign_module` VALUES("309","administrator","conferences/exhibitions_organized(as organizer).php","2023-06-17 15:29:06");
INSERT INTO `assign_module` VALUES("310","administrator","member_technicalcommitteeofinternationalconference.php","2023-06-17 15:29:06");
INSERT INTO `assign_module` VALUES("311","administrator","awards_&Honors.php","2023-06-17 15:29:06");
INSERT INTO `assign_module` VALUES("312","administrator","professional_trainingsconductedforindustry.php","2023-06-17 15:29:06");
INSERT INTO `assign_module` VALUES("313","administrator","other_Services.php","2023-06-17 15:29:06");
INSERT INTO `assign_module` VALUES("314","administrator","list_ofjournalarticles.php","2023-06-17 15:29:06");
INSERT INTO `assign_module` VALUES("315","administrator","papers_presentedinconferences.php","2023-06-17 15:29:06");



DROP TABLE IF EXISTS `assign_user_role`;

CREATE TABLE `assign_user_role` (
  `assign_user_role_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `user_role` varchar(300) DEFAULT NULL,
  `assign_user_role_remarks` text DEFAULT NULL,
  `assign_user_role_add_date` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`assign_user_role_id`)
) ENGINE=InnoDB AUTO_INCREMENT=563 DEFAULT CHARSET=latin1;

INSERT INTO `assign_user_role` VALUES("192","1","administrator","Assign by User: moixx.ansari43@gmail.com","2021-02-07 19:24:59");
INSERT INTO `assign_user_role` VALUES("193","2","employee","Manager registration by moixx.ansari43@gmail.com","2021-02-22 17:05:09");
INSERT INTO `assign_user_role` VALUES("194","4","manager","Self registration","2021-04-16 01:51:58");
INSERT INTO `assign_user_role` VALUES("195","5","manager","Self registration","2021-04-16 02:38:11");
INSERT INTO `assign_user_role` VALUES("196","7","employee","Manager registration by breezesports1@gmail.com","2021-04-16 05:36:30");
INSERT INTO `assign_user_role` VALUES("197","8","employee","Manager registration by breezesports1@gmail.com","2021-04-16 10:21:38");
INSERT INTO `assign_user_role` VALUES("198","9","employee","Manager registration by moixx.ansari43@gmail.com","2021-04-16 14:26:09");
INSERT INTO `assign_user_role` VALUES("199","10","manager","Self registration","2021-05-23 13:16:21");
INSERT INTO `assign_user_role` VALUES("200","14","employee","Manager registration by shoaib5290@gmail.com","2021-05-23 13:19:17");
INSERT INTO `assign_user_role` VALUES("204","17","employee","Assign by User: ","2021-05-30 13:51:39");
INSERT INTO `assign_user_role` VALUES("205","20","employee","Manager registration by moiz.iqbal55@gmail.com","2021-06-17 17:08:53");
INSERT INTO `assign_user_role` VALUES("206","21","employee","Manager registration by moiz.iqbal55@gmail.com","2021-06-20 22:25:02");
INSERT INTO `assign_user_role` VALUES("207","24","employee","Manager registration by breezesports1@gmail.com","2021-06-25 04:30:47");
INSERT INTO `assign_user_role` VALUES("208","10000","employee","Manager registration by moiz.iqbal55@gmail.com","2021-07-06 13:41:17");
INSERT INTO `assign_user_role` VALUES("209","10003","employee","Manager registration by breezesports1@gmail.com","2021-07-06 13:47:48");
INSERT INTO `assign_user_role` VALUES("210","10007","employee","Manager registration by breezesports1@gmail.com","2021-07-07 16:03:18");
INSERT INTO `assign_user_role` VALUES("211","10008","employee","Manager registration by moixx.ansari43@gmail.com","2021-08-09 02:35:02");
INSERT INTO `assign_user_role` VALUES("212","10009","employee","Manager registration by moixx.ansari43@gmail.com","2021-08-10 12:41:14");
INSERT INTO `assign_user_role` VALUES("213","10010","employee","Manager registration by moixx.ansari43@gmail.com","2021-08-10 12:47:47");
INSERT INTO `assign_user_role` VALUES("214","10011","employee","Manager registration by moixx.ansari43@gmail.com","2021-08-10 12:51:40");
INSERT INTO `assign_user_role` VALUES("215","10012","employee","Manager registration by moixx.ansari43@gmail.com","2021-08-10 13:00:42");
INSERT INTO `assign_user_role` VALUES("216","10013","employee","Manager registration by moixx.ansari43@gmail.com","2021-08-10 13:01:44");
INSERT INTO `assign_user_role` VALUES("217","10014","employee","Manager registration by moixx.ansari43@gmail.com","2021-08-10 13:03:08");
INSERT INTO `assign_user_role` VALUES("218","10015","employee","Manager registration by moixx.ansari43@gmail.com","2021-08-10 13:03:50");
INSERT INTO `assign_user_role` VALUES("219","10016","employee","Manager registration by moixx.ansari43@gmail.com","2021-08-10 13:08:34");
INSERT INTO `assign_user_role` VALUES("220","10017","employee","Manager registration by moixx.ansari43@gmail.com","2021-08-10 13:10:17");
INSERT INTO `assign_user_role` VALUES("221","10018","employee","Manager registration by moixx.ansari43@gmail.com","2021-08-10 13:11:07");
INSERT INTO `assign_user_role` VALUES("222","10019","employee","Manager registration by moixx.ansari43@gmail.com","2021-08-10 13:11:59");
INSERT INTO `assign_user_role` VALUES("223","10020","employee","Manager registration by moixx.ansari43@gmail.com","2021-08-10 13:13:47");
INSERT INTO `assign_user_role` VALUES("224","10022","employee","Manager registration by moixx.ansari43@gmail.com","2021-08-10 13:17:56");
INSERT INTO `assign_user_role` VALUES("225","10023","employee","Manager registration by moixx.ansari43@gmail.com","2021-08-10 13:18:49");
INSERT INTO `assign_user_role` VALUES("226","10025","employee","Manager registration by moixx.ansari43@gmail.com","2021-08-10 13:21:07");
INSERT INTO `assign_user_role` VALUES("227","10026","employee","Manager registration by moixx.ansari43@gmail.com","2021-08-10 13:23:51");
INSERT INTO `assign_user_role` VALUES("228","10027","employee","Manager registration by moixx.ansari43@gmail.com","2021-08-10 13:26:06");
INSERT INTO `assign_user_role` VALUES("229","10028","employee","Manager registration by moixx.ansari43@gmail.com","2021-08-10 15:41:47");
INSERT INTO `assign_user_role` VALUES("230","10029","employee","Manager registration by moixx.ansari43@gmail.com","2021-08-10 15:43:01");
INSERT INTO `assign_user_role` VALUES("231","10030","employee","Manager registration by moixx.ansari43@gmail.com","2021-08-10 15:44:15");
INSERT INTO `assign_user_role` VALUES("234","10035","employee","Manager registration by moixx.ansari43@gmail.com","2021-08-11 17:55:34");
INSERT INTO `assign_user_role` VALUES("235","10037","free plan","self created signup","2021-08-13 01:37:16");
INSERT INTO `assign_user_role` VALUES("237","10039","employee","Manager registration by mdilawar02@gmail.com","2021-09-01 13:43:28");
INSERT INTO `assign_user_role` VALUES("238","10040","employee","Manager registration by mdilawar02@gmail.com","2021-09-02 12:39:29");
INSERT INTO `assign_user_role` VALUES("239","10041","employee","Manager registration by mdilawar02@gmail.com","2021-09-02 12:41:46");
INSERT INTO `assign_user_role` VALUES("240","10042","employee","Manager registration by mdilawar02@gmail.com","2021-09-02 12:43:01");
INSERT INTO `assign_user_role` VALUES("242","10046","employee","Manager registration by mdilawar02@gmail.com","2021-09-02 15:21:12");
INSERT INTO `assign_user_role` VALUES("243","10043","employee","Assign by User: moixx.ansari43@gmail.com","2021-09-02 16:38:41");
INSERT INTO `assign_user_role` VALUES("244","10047","employee","Manager registration by mdilawar02@gmail.com","2021-09-09 10:51:15");
INSERT INTO `assign_user_role` VALUES("245","10048","employee","Manager registration by moixx.ansari43@gmail.com","2021-09-09 17:28:16");
INSERT INTO `assign_user_role` VALUES("246","10049","free plan","self created signup","2021-09-10 03:09:22");
INSERT INTO `assign_user_role` VALUES("247","10050","employee","Manager registration by attendanceja@gmail.com","2021-09-10 03:32:08");
INSERT INTO `assign_user_role` VALUES("249","10051","manager","Assign by User: Attendanceja@gmail.com","2021-09-10 03:33:58");
INSERT INTO `assign_user_role` VALUES("254","10052","employee","Manager registration by moixx.ansari43@gmail.com","2021-09-13 18:13:17");
INSERT INTO `assign_user_role` VALUES("255","10053","free plan","self created signup","2021-09-13 19:16:17");
INSERT INTO `assign_user_role` VALUES("256","10054","employee","Manager registration by moixx.ansari43@gmail.com","2021-09-15 00:05:49");
INSERT INTO `assign_user_role` VALUES("261","10055","employee","Manager registration by moiz.iqbal55@gmail.com","2021-09-20 19:16:17");
INSERT INTO `assign_user_role` VALUES("269","10032","employee","Assign by User: moixx.ansari43@gmail.com","2021-09-22 14:20:58");
INSERT INTO `assign_user_role` VALUES("271","10056","administrator","Assign by User: moixx.ansari43@gmail.com","2021-09-22 14:21:39");
INSERT INTO `assign_user_role` VALUES("273","10057","manager","Assign by User: moixx.ansari43@gmail.com","2021-09-22 14:22:44");
INSERT INTO `assign_user_role` VALUES("277","10058","free plan","Assign by User: moixx.ansari43@gmail.com","2021-10-05 17:17:21");
INSERT INTO `assign_user_role` VALUES("278","10060","employee","Manager registration by res.sureshut@live.com","2021-10-05 17:30:36");
INSERT INTO `assign_user_role` VALUES("280","10062","employee","Manager registration by moixx.ansari43@gmail.com","2021-10-15 18:25:22");
INSERT INTO `assign_user_role` VALUES("281","10063","free plan","self created signup","2021-10-20 03:32:51");
INSERT INTO `assign_user_role` VALUES("287","10038","manager","Assign by User: moixx.ansari43@gmail.com","2021-10-26 12:17:54");
INSERT INTO `assign_user_role` VALUES("288","10038","free plan","Assign by User: moixx.ansari43@gmail.com","2021-10-26 12:17:54");
INSERT INTO `assign_user_role` VALUES("289","10064","employee","Manager registration by moixx.ansari43@gmail.com","2021-10-27 16:06:55");
INSERT INTO `assign_user_role` VALUES("290","10065","free plan","self created signup","2021-10-31 13:00:11");
INSERT INTO `assign_user_role` VALUES("294","10067","employee","Manager registration by talhaasghar91@hotmail.com","2021-11-01 14:24:46");
INSERT INTO `assign_user_role` VALUES("295","10068","employee","Manager registration by talhaasghar91@hotmail.com","2021-11-01 15:13:59");
INSERT INTO `assign_user_role` VALUES("296","10069","employee","Manager registration by talhaasghar91@hotmail.com","2021-11-01 16:04:00");
INSERT INTO `assign_user_role` VALUES("297","10070","employee","Manager registration by talhaasghar91@hotmail.com","2021-11-01 16:28:24");
INSERT INTO `assign_user_role` VALUES("298","10071","employee","Manager registration by talhaasghar91@hotmail.com","2021-11-01 16:30:27");
INSERT INTO `assign_user_role` VALUES("299","10072","employee","Manager registration by talhaasghar91@hotmail.com","2021-11-01 16:32:02");
INSERT INTO `assign_user_role` VALUES("300","10074","employee","Manager registration by talhaasghar91@hotmail.com","2021-11-01 16:43:14");
INSERT INTO `assign_user_role` VALUES("301","10075","employee","Manager registration by talhaasghar91@hotmail.com","2021-11-01 16:52:59");
INSERT INTO `assign_user_role` VALUES("302","10076","employee","Manager registration by moixx.ansari43@gmail.com","2021-11-01 18:00:09");
INSERT INTO `assign_user_role` VALUES("303","10077","free plan","self created signup","2021-11-03 09:36:07");
INSERT INTO `assign_user_role` VALUES("307","10081","employee","Manager registration by a1@3atextile.com","2021-11-03 15:54:55");
INSERT INTO `assign_user_role` VALUES("311","10078","manager","Assign by User: moixx.ansari43@gmail.com","2021-11-04 11:50:32");
INSERT INTO `assign_user_role` VALUES("312","10078","free plan","Assign by User: moixx.ansari43@gmail.com","2021-11-04 11:50:32");
INSERT INTO `assign_user_role` VALUES("313","10082","employee","Manager registration by manager@cgit.pk","2021-11-08 18:58:48");
INSERT INTO `assign_user_role` VALUES("314","10083","free plan","self created signup","2021-11-12 18:32:32");
INSERT INTO `assign_user_role` VALUES("321","10061","employee","Assign by User: moixx.ansari43@gmail.com","2021-11-16 19:26:40");
INSERT INTO `assign_user_role` VALUES("322","10084","free plan","self created signup","2021-11-18 05:51:14");
INSERT INTO `assign_user_role` VALUES("323","10085","free plan","self created signup","2021-11-23 20:52:34");
INSERT INTO `assign_user_role` VALUES("324","10086","free plan","self created signup","2021-11-28 06:27:38");
INSERT INTO `assign_user_role` VALUES("325","10087","employee","Manager registration by jullygundran@gmail.com","2021-11-28 06:56:51");
INSERT INTO `assign_user_role` VALUES("326","10088","free plan","self created signup","2021-12-02 13:09:00");
INSERT INTO `assign_user_role` VALUES("327","10089","employee","Manager registration by muhammadamir999@gmail.com","2021-12-02 13:24:04");
INSERT INTO `assign_user_role` VALUES("328","10091","free plan","self created signup","2021-12-13 02:31:17");
INSERT INTO `assign_user_role` VALUES("329","10092","free plan","self created signup","2021-12-30 23:43:42");
INSERT INTO `assign_user_role` VALUES("330","10093","free plan","self created signup","2022-01-21 06:32:32");
INSERT INTO `assign_user_role` VALUES("335","10096","employee","Manager registration by admin@paradise.com","2022-01-24 18:34:40");
INSERT INTO `assign_user_role` VALUES("336","10097","employee","Manager registration by admin@paradise.com","2022-01-24 18:44:17");
INSERT INTO `assign_user_role` VALUES("337","10098","employee","Manager registration by admin@paradise.com","2022-01-24 18:47:29");
INSERT INTO `assign_user_role` VALUES("338","10099","employee","Manager registration by admin@paradise.com","2022-01-24 18:53:58");
INSERT INTO `assign_user_role` VALUES("339","10100","employee","Manager registration by admin@paradise.com","2022-01-24 19:01:04");
INSERT INTO `assign_user_role` VALUES("340","10101","employee","Manager registration by admin@paradise.com","2022-01-24 19:05:33");
INSERT INTO `assign_user_role` VALUES("341","10102","employee","Manager registration by admin@paradise.com","2022-01-24 19:11:19");
INSERT INTO `assign_user_role` VALUES("342","10103","employee","Manager registration by admin@paradise.com","2022-01-24 19:15:18");
INSERT INTO `assign_user_role` VALUES("343","10104","employee","Manager registration by admin@paradise.com","2022-01-24 19:18:03");
INSERT INTO `assign_user_role` VALUES("344","10105","employee","Manager registration by admin@paradise.com","2022-01-24 19:20:41");
INSERT INTO `assign_user_role` VALUES("345","10106","employee","Manager registration by admin@paradise.com","2022-01-24 19:22:38");
INSERT INTO `assign_user_role` VALUES("346","10107","employee","Manager registration by admin@paradise.com","2022-01-24 19:24:32");
INSERT INTO `assign_user_role` VALUES("347","10108","employee","Manager registration by admin@paradise.com","2022-01-24 19:27:33");
INSERT INTO `assign_user_role` VALUES("348","10109","employee","Manager registration by admin@paradise.com","2022-01-24 19:42:38");
INSERT INTO `assign_user_role` VALUES("354","10066","manager","Assign by User: moixx.ansari43@gmail.com","2022-01-27 19:55:16");
INSERT INTO `assign_user_role` VALUES("355","10066","free plan","Assign by User: moixx.ansari43@gmail.com","2022-01-27 19:55:16");
INSERT INTO `assign_user_role` VALUES("357","10110","employee","Assign by User: talhaasghar91@hotmail.com","2022-01-31 13:38:43");
INSERT INTO `assign_user_role` VALUES("359","10111","manager","Assign by User: moixx.ansari43@gmail.com","2022-01-31 18:19:02");
INSERT INTO `assign_user_role` VALUES("360","10111","free plan","Assign by User: moixx.ansari43@gmail.com","2022-01-31 18:19:02");
INSERT INTO `assign_user_role` VALUES("361","10113","employee","Manager registration by oxpertecautomations@gmail.com","2022-01-31 18:34:55");
INSERT INTO `assign_user_role` VALUES("363","10118","manager","Assign by User: moixx.ansari43@gmail.com","2022-02-07 20:18:49");
INSERT INTO `assign_user_role` VALUES("364","10118","free plan","Assign by User: moixx.ansari43@gmail.com","2022-02-07 20:18:49");
INSERT INTO `assign_user_role` VALUES("366","10119","manager","Assign by User: moixx.ansari43@gmail.com","2022-02-09 04:04:51");
INSERT INTO `assign_user_role` VALUES("367","10119","free plan","Assign by User: moixx.ansari43@gmail.com","2022-02-09 04:04:51");
INSERT INTO `assign_user_role` VALUES("369","10120","manager","Assign by User: moixx.ansari43@gmail.com","2022-02-18 19:20:09");
INSERT INTO `assign_user_role` VALUES("370","10120","free plan","Assign by User: moixx.ansari43@gmail.com","2022-02-18 19:20:09");
INSERT INTO `assign_user_role` VALUES("371","10121","free plan","self created signup","2022-02-20 09:26:10");
INSERT INTO `assign_user_role` VALUES("372","10122","free plan","self created signup","2022-02-21 14:42:19");
INSERT INTO `assign_user_role` VALUES("373","10123","employee","Manager registration by moixx.ansari43@gmail.com","2022-03-05 18:18:26");
INSERT INTO `assign_user_role` VALUES("375","10124","manager","Assign by User: moixx.ansari43@gmail.com","2022-03-14 18:03:08");
INSERT INTO `assign_user_role` VALUES("376","10124","free plan","Assign by User: moixx.ansari43@gmail.com","2022-03-14 18:03:08");
INSERT INTO `assign_user_role` VALUES("377","10125","free plan","self created signup","2022-03-16 01:33:53");
INSERT INTO `assign_user_role` VALUES("378","10126","free plan","self created signup","2022-04-03 11:18:54");
INSERT INTO `assign_user_role` VALUES("379","10127","free plan","self created signup","2022-04-04 17:21:11");
INSERT INTO `assign_user_role` VALUES("380","10128","free plan","self created signup","2022-04-05 14:04:43");
INSERT INTO `assign_user_role` VALUES("381","10129","employee","Manager registration by lenguaje.noel07@gmail.com","2022-04-05 14:11:14");
INSERT INTO `assign_user_role` VALUES("382","10131","employee","Manager registration by lenguaje.noel07@gmail.com","2022-04-05 14:13:10");
INSERT INTO `assign_user_role` VALUES("383","10132","employee","Manager registration by lenguaje.noel07@gmail.com","2022-04-05 14:14:14");
INSERT INTO `assign_user_role` VALUES("384","10133","employee","Manager registration by lenguaje.noel07@gmail.com","2022-04-05 14:15:19");
INSERT INTO `assign_user_role` VALUES("385","10134","employee","Manager registration by lenguaje.noel07@gmail.com","2022-04-05 14:41:06");
INSERT INTO `assign_user_role` VALUES("386","10135","employee","Manager registration by lenguaje.noel07@gmail.com","2022-04-05 14:43:39");
INSERT INTO `assign_user_role` VALUES("387","10136","free plan","self created signup","2022-04-12 13:07:17");
INSERT INTO `assign_user_role` VALUES("388","10137","free plan","self created signup","2022-04-12 13:12:40");
INSERT INTO `assign_user_role` VALUES("389","10138","free plan","self created signup","2022-04-14 04:58:29");
INSERT INTO `assign_user_role` VALUES("390","10139","free plan","self created signup","2022-04-22 02:29:09");
INSERT INTO `assign_user_role` VALUES("391","10140","free plan","self created signup","2022-04-22 21:47:00");
INSERT INTO `assign_user_role` VALUES("392","10141","free plan","self created signup","2022-04-24 00:26:51");
INSERT INTO `assign_user_role` VALUES("394","10143","free plan","self created signup","2022-05-16 21:18:46");
INSERT INTO `assign_user_role` VALUES("395","10144","free plan","self created signup","2022-05-18 12:48:17");
INSERT INTO `assign_user_role` VALUES("396","10145","free plan","self created signup","2022-05-19 11:31:34");
INSERT INTO `assign_user_role` VALUES("397","10146","free plan","self created signup","2022-06-09 23:08:04");
INSERT INTO `assign_user_role` VALUES("398","10148","employee","Manager registration by ramishqamar89@hotmail.com","2022-06-10 10:39:52");
INSERT INTO `assign_user_role` VALUES("399","10149","free plan","self created signup","2022-06-12 14:46:04");
INSERT INTO `assign_user_role` VALUES("401","10150","manager","Assign by User: moixx.ansari43@gmail.com","2022-06-17 03:28:36");
INSERT INTO `assign_user_role` VALUES("402","10150","free plan","Assign by User: moixx.ansari43@gmail.com","2022-06-17 03:28:36");
INSERT INTO `assign_user_role` VALUES("403","10151","employee","Manager registration by paulsmith@toptechdigital.com","2022-06-17 03:34:01");
INSERT INTO `assign_user_role` VALUES("404","10152","free plan","self created signup","2022-06-19 05:14:06");
INSERT INTO `assign_user_role` VALUES("405","10153","free plan","self created signup","2022-07-16 13:09:13");
INSERT INTO `assign_user_role` VALUES("406","10154","free plan","self created signup","2022-07-17 00:17:50");
INSERT INTO `assign_user_role` VALUES("407","10155","free plan","self created signup","2022-07-18 00:16:53");
INSERT INTO `assign_user_role` VALUES("408","10156","free plan","self created signup","2022-07-18 18:12:54");
INSERT INTO `assign_user_role` VALUES("411","10095","employee","Assign by User: moixx.ansari43@gmail.com","2022-07-28 16:21:32");
INSERT INTO `assign_user_role` VALUES("415","10142","employee","Assign by User: moixx.ansari43@gmail.com","2022-07-28 16:23:06");
INSERT INTO `assign_user_role` VALUES("416","10157","free plan","self created signup","2022-08-22 09:21:20");
INSERT INTO `assign_user_role` VALUES("417","10158","employee","Manager registration by moixx.ansari43@gmail.com","2022-08-22 17:21:47");
INSERT INTO `assign_user_role` VALUES("418","10159","free plan","self created signup","2022-08-27 14:08:07");
INSERT INTO `assign_user_role` VALUES("419","10161","employee","Manager registration by temidopeakintomide@gmail.com","2022-08-27 14:34:38");
INSERT INTO `assign_user_role` VALUES("422","10162","employee","Assign by User: temidopeakintomide@gmail.com","2022-08-29 12:53:25");
INSERT INTO `assign_user_role` VALUES("423","10163","free plan","self created signup","2022-09-08 08:03:45");
INSERT INTO `assign_user_role` VALUES("424","10164","employee","Manager registration by kushal@jrgroupfiji.com","2022-09-08 08:08:04");
INSERT INTO `assign_user_role` VALUES("425","10165","free plan","self created signup","2022-09-15 09:17:58");
INSERT INTO `assign_user_role` VALUES("426","10166","free plan","self created signup","2022-09-24 14:20:20");
INSERT INTO `assign_user_role` VALUES("427","10167","employee","Manager registration by ahsan.muhammad@bawakir.com","2022-09-24 14:24:47");
INSERT INTO `assign_user_role` VALUES("428","10168","free plan","self created signup","2022-10-03 20:12:46");
INSERT INTO `assign_user_role` VALUES("429","10094","free plan","Assign by User: moixx.ansari43@gmail.com","2022-10-08 15:27:39");
INSERT INTO `assign_user_role` VALUES("430","10172","employee","Manager registration by admin@paradise.com","2022-10-12 13:46:10");
INSERT INTO `assign_user_role` VALUES("431","10173","employee","Manager registration by admin@paradise.com","2022-10-12 14:15:25");
INSERT INTO `assign_user_role` VALUES("432","10174","employee","Manager registration by admin@paradise.com","2022-10-12 14:19:58");
INSERT INTO `assign_user_role` VALUES("433","10175","employee","Manager registration by admin@paradise.com","2022-10-12 14:22:50");
INSERT INTO `assign_user_role` VALUES("434","10176","employee","Manager registration by admin@paradise.com","2022-10-12 15:49:27");
INSERT INTO `assign_user_role` VALUES("435","10179","employee","Manager registration by admin@paradise.com","2022-10-12 15:58:22");
INSERT INTO `assign_user_role` VALUES("436","10180","employee","Manager registration by admin@paradise.com","2022-10-12 16:05:11");
INSERT INTO `assign_user_role` VALUES("437","10181","employee","Manager registration by admin@paradise.com","2022-10-12 16:20:34");
INSERT INTO `assign_user_role` VALUES("438","10182","employee","Manager registration by admin@paradise.com","2022-10-12 16:41:01");
INSERT INTO `assign_user_role` VALUES("439","10183","employee","Manager registration by admin@paradise.com","2022-10-12 16:46:39");
INSERT INTO `assign_user_role` VALUES("440","10184","employee","Manager registration by admin@paradise.com","2022-10-12 16:59:38");
INSERT INTO `assign_user_role` VALUES("441","10185","employee","Manager registration by admin@paradise.com","2022-10-12 17:04:38");
INSERT INTO `assign_user_role` VALUES("442","10186","employee","Manager registration by admin@paradise.com","2022-10-12 17:07:45");
INSERT INTO `assign_user_role` VALUES("443","10187","employee","Manager registration by admin@paradise.com","2022-10-12 17:11:10");
INSERT INTO `assign_user_role` VALUES("444","10188","employee","Manager registration by admin@paradise.com","2022-10-12 17:14:49");
INSERT INTO `assign_user_role` VALUES("445","10190","employee","Manager registration by admin@paradise.com","2022-10-12 17:32:25");
INSERT INTO `assign_user_role` VALUES("446","10191","free plan","self created signup","2022-10-13 12:01:07");
INSERT INTO `assign_user_role` VALUES("447","10192","employee","Manager registration by admin@paradise.com","2022-10-17 09:46:42");
INSERT INTO `assign_user_role` VALUES("448","10193","employee","Manager registration by admin@paradise.com","2022-10-17 10:06:41");
INSERT INTO `assign_user_role` VALUES("449","10194","employee","Manager registration by admin@paradise.com","2022-10-19 11:38:29");
INSERT INTO `assign_user_role` VALUES("450","10195","free plan","self created signup","2022-10-21 08:51:40");
INSERT INTO `assign_user_role` VALUES("451","10196","employee","Manager registration by admin@paradise.com","2022-10-22 10:10:41");
INSERT INTO `assign_user_role` VALUES("452","10197","employee","Manager registration by admin@paradise.com","2022-10-24 10:24:31");
INSERT INTO `assign_user_role` VALUES("453","10198","employee","Manager registration by admin@paradise.com","2022-10-25 18:14:43");
INSERT INTO `assign_user_role` VALUES("454","10199","employee","Manager registration by admin@paradise.com","2022-10-25 18:16:00");
INSERT INTO `assign_user_role` VALUES("455","10200","employee","Manager registration by admin@paradise.com","2022-10-25 18:17:22");
INSERT INTO `assign_user_role` VALUES("456","10201","employee","Manager registration by admin@paradise.com","2022-10-25 18:18:22");
INSERT INTO `assign_user_role` VALUES("457","10202","employee","Manager registration by admin@paradise.com","2022-10-25 18:19:14");
INSERT INTO `assign_user_role` VALUES("458","10203","employee","Manager registration by admin@paradise.com","2022-10-25 18:20:05");
INSERT INTO `assign_user_role` VALUES("459","10204","employee","Manager registration by admin@paradise.com","2022-10-25 18:20:51");
INSERT INTO `assign_user_role` VALUES("460","10205","employee","Manager registration by admin@paradise.com","2022-10-25 18:21:37");
INSERT INTO `assign_user_role` VALUES("461","10206","employee","Manager registration by admin@paradise.com","2022-10-29 10:24:04");
INSERT INTO `assign_user_role` VALUES("463","10207","manager","Assign by User: admin@paradise.com","2022-11-08 14:02:25");
INSERT INTO `assign_user_role` VALUES("464","10207","employee","Assign by User: admin@paradise.com","2022-11-08 14:02:25");
INSERT INTO `assign_user_role` VALUES("465","10207","free plan","Assign by User: admin@paradise.com","2022-11-08 14:02:25");
INSERT INTO `assign_user_role` VALUES("467","10208","employee","Assign by User: admin@paradise.com","2022-11-08 14:11:46");
INSERT INTO `assign_user_role` VALUES("468","10209","employee","Manager registration by admin@paradise.com","2022-11-09 10:25:38");
INSERT INTO `assign_user_role` VALUES("469","10210","free plan","self created signup","2022-11-10 23:16:01");
INSERT INTO `assign_user_role` VALUES("470","10211","free plan","self created signup","2022-11-15 20:52:00");
INSERT INTO `assign_user_role` VALUES("471","10212","employee","Manager registration by johnsmith@gmail.com","2022-11-15 20:55:57");
INSERT INTO `assign_user_role` VALUES("472","10214","free plan","self created signup","2022-11-27 09:58:49");
INSERT INTO `assign_user_role` VALUES("473","10215","free plan","self created signup","2022-12-05 14:59:40");
INSERT INTO `assign_user_role` VALUES("474","10216","free plan","self created signup","2022-12-17 18:25:49");
INSERT INTO `assign_user_role` VALUES("475","10217","employee","Manager registration by moixx.ansari43@gmail.com","2022-12-19 12:05:56");
INSERT INTO `assign_user_role` VALUES("476","10218","free plan","self created signup","2022-12-20 01:19:26");
INSERT INTO `assign_user_role` VALUES("477","10219","free plan","self created signup","2022-12-27 22:59:44");
INSERT INTO `assign_user_role` VALUES("478","10220","employee","Manager registration by moixx.ansari43@gmail.com","2023-01-12 18:28:23");
INSERT INTO `assign_user_role` VALUES("479","10221","employee","Manager registration by moixx.ansari43@gmail.com","2023-01-14 16:50:55");
INSERT INTO `assign_user_role` VALUES("497","10222","administrator","Assign by User: moixx.ansari43@gmail.com","2023-01-19 16:27:01");
INSERT INTO `assign_user_role` VALUES("498","10222","manager","Assign by User: moixx.ansari43@gmail.com","2023-01-19 16:27:01");
INSERT INTO `assign_user_role` VALUES("499","10222","employee","Assign by User: moixx.ansari43@gmail.com","2023-01-19 16:27:01");
INSERT INTO `assign_user_role` VALUES("500","10225","employee","Manager registration by aneezaamir4@gmail.com","2023-01-19 16:34:46");
INSERT INTO `assign_user_role` VALUES("502","10228","free plan","self created signup","2023-01-23 17:25:53");
INSERT INTO `assign_user_role` VALUES("503","10229","employee","Manager registration by moixx.ansari43@gmail.com","2023-01-24 09:47:51");
INSERT INTO `assign_user_role` VALUES("504","10230","employee","Manager registration by moixx.ansari43@gmail.com","2023-01-24 10:59:20");
INSERT INTO `assign_user_role` VALUES("505","10231","free plan","self created signup","2023-01-25 00:34:44");
INSERT INTO `assign_user_role` VALUES("506","10232","employee","Manager registration by moixx.ansari43@gmail.com","2023-01-26 12:16:47");
INSERT INTO `assign_user_role` VALUES("507","10233","free plan","self created signup","2023-01-27 13:37:15");
INSERT INTO `assign_user_role` VALUES("508","10234","employee","Manager registration by moixx.ansari43@gmail.com","2023-01-30 11:01:52");
INSERT INTO `assign_user_role` VALUES("510","10236","employee","Manager registration by moixx.ansari43@gmail.com","2023-02-04 11:51:11");
INSERT INTO `assign_user_role` VALUES("511","10237","employee","Manager registration by moixx.ansari43@gmail.com","2023-02-04 11:52:53");
INSERT INTO `assign_user_role` VALUES("512","10238","free plan","self created signup","2023-02-07 14:19:38");
INSERT INTO `assign_user_role` VALUES("513","10239","free plan","self created signup","2023-02-07 14:34:19");
INSERT INTO `assign_user_role` VALUES("514","10240","free plan","self created signup","2023-02-07 14:38:24");
INSERT INTO `assign_user_role` VALUES("517","10227","employee","Assign by User: moixx.ansari43@gmail.com","2023-02-07 18:26:40");
INSERT INTO `assign_user_role` VALUES("518","10235","employee","Assign by User: moixx.ansari43@gmail.com","2023-02-07 18:26:46");
INSERT INTO `assign_user_role` VALUES("519","10241","free plan","self created signup","2023-02-14 16:11:27");
INSERT INTO `assign_user_role` VALUES("520","10242","employee","Manager registration by moixx.ansari43@gmail.com","2023-02-18 10:33:32");
INSERT INTO `assign_user_role` VALUES("521","10243","employee","Manager registration by moixx.ansari43@gmail.com","2023-02-18 13:28:41");
INSERT INTO `assign_user_role` VALUES("522","10244","employee","Manager registration by moixx.ansari43@gmail.com","2023-02-18 13:30:37");
INSERT INTO `assign_user_role` VALUES("523","10245","employee","Manager registration by moixx.ansari43@gmail.com","2023-02-21 09:30:22");
INSERT INTO `assign_user_role` VALUES("524","10246","employee","Manager registration by moixx.ansari43@gmail.com","2023-02-25 11:28:10");
INSERT INTO `assign_user_role` VALUES("525","10247","employee","Manager registration by moixx.ansari43@gmail.com","2023-02-25 11:29:43");
INSERT INTO `assign_user_role` VALUES("526","10248","employee","Manager registration by moixx.ansari43@gmail.com","2023-02-25 11:31:21");
INSERT INTO `assign_user_role` VALUES("527","10249","employee","Manager registration by moixx.ansari43@gmail.com","2023-02-25 11:33:06");
INSERT INTO `assign_user_role` VALUES("528","10250","employee","Manager registration by moixx.ansari43@gmail.com","2023-02-25 11:35:25");
INSERT INTO `assign_user_role` VALUES("529","10251","employee","Manager registration by moixx.ansari43@gmail.com","2023-02-25 11:37:28");
INSERT INTO `assign_user_role` VALUES("530","10252","employee","Manager registration by moixx.ansari43@gmail.com","2023-02-28 10:57:29");
INSERT INTO `assign_user_role` VALUES("531","10253","free plan","self created signup","2023-03-01 07:21:21");
INSERT INTO `assign_user_role` VALUES("532","10255","employee","Manager registration by hameedmustafa2001@gmail.com","2023-03-01 07:28:50");
INSERT INTO `assign_user_role` VALUES("533","10256","employee","Manager registration by moixx.ansari43@gmail.com","2023-03-02 09:21:20");
INSERT INTO `assign_user_role` VALUES("534","10257","employee","Manager registration by moixx.ansari43@gmail.com","2023-03-02 09:23:16");
INSERT INTO `assign_user_role` VALUES("535","10262","free plan","self created signup","2023-03-04 10:55:34");
INSERT INTO `assign_user_role` VALUES("536","10263","free plan","self created signup","2023-03-04 11:43:15");
INSERT INTO `assign_user_role` VALUES("537","10264","free plan","self created signup","2023-03-04 15:25:15");
INSERT INTO `assign_user_role` VALUES("538","10266","free plan","self created signup","2023-03-04 15:27:36");
INSERT INTO `assign_user_role` VALUES("539","10267","free plan","self created signup","2023-03-04 15:43:04");
INSERT INTO `assign_user_role` VALUES("540","10268","employee","Manager registration by moixx.ansari43@gmail.com","2023-03-04 16:56:28");
INSERT INTO `assign_user_role` VALUES("541","10269","employee","Manager registration by moixx.ansari43@gmail.com","2023-03-13 10:15:50");
INSERT INTO `assign_user_role` VALUES("542","10270","free plan","self created signup","2023-03-15 18:40:01");
INSERT INTO `assign_user_role` VALUES("543","10272","employee","Manager registration by ceo.cgit.pk@gmail.com","2023-03-15 18:43:40");
INSERT INTO `assign_user_role` VALUES("545","10274","employee","Assign by User: ceo.cgit.pk@gmail.com","2023-03-15 19:00:02");
INSERT INTO `assign_user_role` VALUES("546","10275","employee","Manager registration by moixx.ansari43@gmail.com","2023-03-18 12:04:29");
INSERT INTO `assign_user_role` VALUES("547","10276","employee","Manager registration by moixx.ansari43@gmail.com","2023-03-18 12:08:04");
INSERT INTO `assign_user_role` VALUES("548","10277","employee","Manager registration by moixx.ansari43@gmail.com","2023-03-22 14:23:03");
INSERT INTO `assign_user_role` VALUES("549","10278","employee","Manager registration by moixx.ansari43@gmail.com","2023-06-10 12:36:32");
INSERT INTO `assign_user_role` VALUES("550","10280","employee","Manager registration by moixx.ansari43@gmail.com","2023-06-10 12:42:21");
INSERT INTO `assign_user_role` VALUES("554","10284","user","Manager registration by moixx.ansari43@gmail.com","2023-06-10 13:20:03");
INSERT INTO `assign_user_role` VALUES("555","10287","user","Manager registration by moixx.ansari43@gmail.com","2023-06-10 13:21:51");
INSERT INTO `assign_user_role` VALUES("556","10291","user","Manager registration by moixx.ansari43@gmail.com","2023-06-10 13:22:58");
INSERT INTO `assign_user_role` VALUES("557","10292","user","Manager registration by moixx.ansari43@gmail.com","2023-06-10 13:23:56");
INSERT INTO `assign_user_role` VALUES("558","10283","administrator","Assign by User: moixx.ansari43@gmail.com","2023-06-12 17:05:07");
INSERT INTO `assign_user_role` VALUES("559","10293","user","Manager registration by moixx.ansari43@gmail.com","2023-06-14 13:10:34");
INSERT INTO `assign_user_role` VALUES("560","10294","user","Manager registration by moixx.ansari43@gmail.com","2023-06-14 13:20:53");
INSERT INTO `assign_user_role` VALUES("561","10295","user","Manager registration by moixx.ansari43@gmail.com","2023-06-14 13:21:12");
INSERT INTO `assign_user_role` VALUES("562","10305","user","Manager registration by moixx.ansari43@gmail.com","2023-06-14 13:22:54");



DROP TABLE IF EXISTS `books_authored`;

CREATE TABLE `books_authored` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `authors` text DEFAULT NULL,
  `chapter` text DEFAULT NULL,
  `year` text DEFAULT NULL,
  `book` text DEFAULT NULL,
  `doi` varchar(255) DEFAULT NULL,
  `publisher` varchar(255) DEFAULT NULL,
  `document` text DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;




DROP TABLE IF EXISTS `certifications`;

CREATE TABLE `certifications` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cdegree` text DEFAULT NULL,
  `cresearch` text DEFAULT NULL,
  `cuniversity` text DEFAULT NULL,
  `cmajor_field` text DEFAULT NULL,
  `file` text DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;




DROP TABLE IF EXISTS `curriculum_develop`;

CREATE TABLE `curriculum_develop` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `institute` text DEFAULT NULL,
  `position` text DEFAULT NULL,
  `duties` text DEFAULT NULL,
  `year_from` varchar(255) DEFAULT NULL,
  `year_to` varchar(255) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;




DROP TABLE IF EXISTS `develop_course_details`;

CREATE TABLE `develop_course_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` text DEFAULT NULL,
  `credit_hour` text DEFAULT NULL,
  `phd_ms_bs` text DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;




DROP TABLE IF EXISTS `executive_summary`;

CREATE TABLE `executive_summary` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `summary` text DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;




DROP TABLE IF EXISTS `funded_research_projects`;

CREATE TABLE `funded_research_projects` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` text DEFAULT NULL,
  `investigator` varchar(255) DEFAULT NULL,
  `amount` varchar(255) DEFAULT NULL,
  `sponsor` text DEFAULT NULL,
  `partner` varchar(255) DEFAULT NULL,
  `publisher` varchar(255) DEFAULT NULL,
  `duration` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;




DROP TABLE IF EXISTS `journal_articles`;

CREATE TABLE `journal_articles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` text DEFAULT NULL,
  `year` text DEFAULT NULL,
  `journal` text DEFAULT NULL,
  `impact` varchar(255) DEFAULT NULL,
  `doi` varchar(255) DEFAULT NULL,
  `corresponding` text DEFAULT NULL,
  `file` text DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;




DROP TABLE IF EXISTS `menus`;

CREATE TABLE `menus` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(400) DEFAULT NULL,
  `page` varchar(400) DEFAULT NULL,
  `parent_id` varchar(300) DEFAULT NULL,
  `icon` varchar(300) NOT NULL DEFAULT 'fa fa-link',
  `sort_order` varchar(20) DEFAULT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=118 DEFAULT CHARSET=latin1;

INSERT INTO `menus` VALUES("4","Permissions","assign_rights.php","5","fa fa-unlock-alt\n",NULL,"2019-02-06 00:47:33");
INSERT INTO `menus` VALUES("5","Manage","#",NULL,"fa fa-users","3","2019-02-06 00:47:58");
INSERT INTO `menus` VALUES("6","role management","add_remove_user_roles.php","5","fa fa-cog",NULL,"2019-02-06 01:33:23");
INSERT INTO `menus` VALUES("7","User","users.php","5","fa fa-user\n\n",NULL,"2019-02-06 01:33:23");
INSERT INTO `menus` VALUES("37","Preferences","","0","fa fa-cogs\n",NULL,"2020-01-11 19:04:00");
INSERT INTO `menus` VALUES("51","Database Backup","backup.php","37","fa fa-refresh\n",NULL,"2021-02-22 00:41:31");
INSERT INTO `menus` VALUES("75","1. Highlights of Profile","","","fa fa-files-o\n\n",NULL,"2023-06-10 11:44:03");
INSERT INTO `menus` VALUES("76","(1.1) Executive Summary","executive_summary.php","75","fa fa-file-o\n\n",NULL,"2023-06-10 11:53:40");
INSERT INTO `menus` VALUES("77","(1.2) Research ","research.php ","75","fa fa-file-o\n\n",NULL,"2023-06-10 11:55:15");
INSERT INTO `menus` VALUES("78","(1.3) Academic","academic.php","75","fa fa-file-text-o\n\n",NULL,"2023-06-10 11:56:45");
INSERT INTO `menus` VALUES("79","(1.4) Other contributions","other_contributions.php","75","fa fa-file\n\n",NULL,"2023-06-10 11:59:37");
INSERT INTO `menus` VALUES("80","(2) Personal mission","","","fa fa-credit-card\n\n",NULL,"2023-06-12 13:29:04");
INSERT INTO `menus` VALUES("81","Personal Mission","personal_mission.php","80","fa fa-file\n\n",NULL,"2023-06-12 13:30:31");
INSERT INTO `menus` VALUES("82","(3) Academic Qualification","","","fa fa-file\n\n",NULL,"2023-06-12 14:29:28");
INSERT INTO `menus` VALUES("83","Academic Qualification","academic_qualification.php","82","fa fa-file\n\n",NULL,"2023-06-12 14:30:18");
INSERT INTO `menus` VALUES("84","(4) Professional Experience","","","fa fa-file-text\n\n",NULL,"2023-06-12 16:48:20");
INSERT INTO `menus` VALUES("85","Professional Experience","professional_experience.php","84","fa fa-file-text-o\n\n",NULL,"2023-06-12 16:49:17");
INSERT INTO `menus` VALUES("86","Generate PDF","","","fa fa-file-pdf-o\n\n",NULL,"2023-06-13 11:18:53");
INSERT INTO `menus` VALUES("87","Generate PDF","generate_pdf.php","86","fa fa-file-pdf-o\n\n",NULL,"2023-06-13 11:19:26");
INSERT INTO `menus` VALUES("88","(5) Teaching Profile","","","fa fa-user-circle\n\n",NULL,"2023-06-13 15:06:28");
INSERT INTO `menus` VALUES("89","(5.1) Statement of Teaching:","statement_teaching.php","88","fa fa-file-text\n\n",NULL,"2023-06-13 15:07:33");
INSERT INTO `menus` VALUES("90","(5.2) Detail of Courses Taught","taught_course_details.php","88","fa fa-file-text-o\n\n",NULL,"2023-06-13 15:09:52");
INSERT INTO `menus` VALUES("91","(5.3) Detail of New Courses Developed","course_develop.php","88","fa fa-file\n\n",NULL,"2023-06-13 15:10:56");
INSERT INTO `menus` VALUES("92","(5.4) Curriculum Development & Review","curriculum_develop.php","88","fa fa-file\n\n",NULL,"2023-06-13 15:12:05");
INSERT INTO `menus` VALUES("93","(5.5) Trainings & Certificates (Attended) / Conducted ","traning_conducted.php","88","fa fa-file-o\n\n",NULL,"2023-06-13 15:14:14");
INSERT INTO `menus` VALUES("94","(6) Research Profile","","","fa fa-file\n\n",NULL,"2023-06-13 15:19:52");
INSERT INTO `menus` VALUES("95","(6) Research Profile","research_profile.php","94","fa fa-file-text\n\n",NULL,"2023-06-13 15:21:51");
INSERT INTO `menus` VALUES("96","(6.1) Research statement","research_statement.php","94","fa fa-file-text\n\n",NULL,"2023-06-13 15:22:52");
INSERT INTO `menus` VALUES("97","(6.2) Research Out Put","research_output.php","94","fa fa-file\n\n",NULL,"2023-06-13 15:47:30");
INSERT INTO `menus` VALUES("98","(6.3) Books Chapters authored","books_authored.php","94","fa fa-book\n\n",NULL,"2023-06-13 15:48:26");
INSERT INTO `menus` VALUES("99","(7) Administration/Other Contributions","","","fa fa-address-book-o\n\n",NULL,"2023-06-13 15:49:58");
INSERT INTO `menus` VALUES("100","(6.4) Funded Research Projects (in progress)","funded_researchprojects.php","94","fa fa-file\n\n",NULL,"2023-06-13 16:03:57");
INSERT INTO `menus` VALUES("101","(6.5) Funded Research Projects (completed)","funded_researchprojects.php","95","fa fa-file\n\n",NULL,"2023-06-13 16:05:54");
INSERT INTO `menus` VALUES("102","(6.6) Patents ","patents.php","94","fa fa-file\n\n",NULL,"2023-06-13 16:09:46");
INSERT INTO `menus` VALUES("103","(6.7) Research Supervision","research_supervision.php","94","fa fa-file\n\n",NULL,"2023-06-13 16:19:02");
INSERT INTO `menus` VALUES("104","(6.8) Reviewer of research articles","reviewer_ofresearcharticles.php","94","fa fa-book\n\n",NULL,"2023-06-13 16:23:09");
INSERT INTO `menus` VALUES("105","(6.9) External Examiner/Referee of MS/PhD Thesis","external_examiner.php","94","fa fa-book\n\n",NULL,"2023-06-13 16:26:19");
INSERT INTO `menus` VALUES("106","(7.1) MOU’s/ Collaboration established with National and International Organization ","collaboration_established.php","99","fa fa-book\n\n",NULL,"2023-06-13 16:29:01");
INSERT INTO `menus` VALUES("107","(7.2) Initiatives Taken ","initiatives_taken.php","99","fa fa-file-text-o\n\n",NULL,"2023-06-13 16:33:42");
INSERT INTO `menus` VALUES("109","(7.3) Conferences/Exhibitions Organized (As Organizer)","conferences/exhibitions_organized(as organizer).php","99","fa fa-file\n\n",NULL,"2023-06-13 16:36:44");
INSERT INTO `menus` VALUES("110","(7.4) Member technical committee of international conference","member_technicalcommitteeofinternationalconference.php","99","fa fa-file\n\n",NULL,"2023-06-13 16:38:36");
INSERT INTO `menus` VALUES("111","(7.5) Awards & Honors ","awards_&Honors.php","99","fa fa-file\n\n",NULL,"2023-06-13 16:40:25");
INSERT INTO `menus` VALUES("112","(7.6) Professional trainings Conducted for Industry","professional_trainingsconductedforindustry.php","99","fa fa-file\n\n",NULL,"2023-06-13 16:41:37");
INSERT INTO `menus` VALUES("113","(7.7) Other Services","other_Services.php","99","fa ",NULL,"2023-06-13 16:42:37");
INSERT INTO `menus` VALUES("114","(8) List of Journal Articles","","","fa fa-file\n\n",NULL,"2023-06-13 16:48:36");
INSERT INTO `menus` VALUES("115","(8) List of Journal Articles","list_ofjournalarticles.php","114","fa fa-file\n\n",NULL,"2023-06-13 16:49:46");
INSERT INTO `menus` VALUES("116","(9) Papers presented in Conferences","","","fa fa-file\n\n",NULL,"2023-06-13 16:50:52");
INSERT INTO `menus` VALUES("117","(9) Papers presented in Conferences","papers_presentedinconferences.php","116","fa fa-file\n\n",NULL,"2023-06-13 16:51:34");



DROP TABLE IF EXISTS `notifications`;

CREATE TABLE `notifications` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(300) DEFAULT NULL,
  `user_id` varchar(300) DEFAULT NULL,
  `manager_id` varchar(300) DEFAULT NULL,
  `subscription_id` varchar(300) DEFAULT NULL,
  `text` longtext DEFAULT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;




DROP TABLE IF EXISTS `other_contributions`;

CREATE TABLE `other_contributions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `contributions_domain_title` varchar(255) DEFAULT NULL,
  `contributions_domain_data` text DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `timestamp` timestamp NULL DEFAULT current_timestamp(),
  `file` text DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;




DROP TABLE IF EXISTS `personal_mission`;

CREATE TABLE `personal_mission` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `summary` text DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;




DROP TABLE IF EXISTS `presented_conferences`;

CREATE TABLE `presented_conferences` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `author` text DEFAULT NULL,
  `title` text DEFAULT NULL,
  `held_at` text DEFAULT NULL,
  `conference_title` text DEFAULT NULL,
  `file` text DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;




DROP TABLE IF EXISTS `professional_experience`;

CREATE TABLE `professional_experience` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `institute` text DEFAULT NULL,
  `position` text DEFAULT NULL,
  `duties` text DEFAULT NULL,
  `year_from` varchar(255) DEFAULT NULL,
  `year_to` varchar(255) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp(),
  `file` text DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;




DROP TABLE IF EXISTS `research_data`;

CREATE TABLE `research_data` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `research_domain_title` varchar(255) DEFAULT NULL,
  `research_domain_data` text DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `timestamp` timestamp NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;




DROP TABLE IF EXISTS `research_interests`;

CREATE TABLE `research_interests` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `research_interests` text DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;




DROP TABLE IF EXISTS `research_output`;

CREATE TABLE `research_output` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `details` text DEFAULT NULL,
  `number` text DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;




DROP TABLE IF EXISTS `research_profile`;

CREATE TABLE `research_profile` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `summary` text DEFAULT NULL,
  `statement` text DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;




DROP TABLE IF EXISTS `research_supervision`;

CREATE TABLE `research_supervision` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `year` varchar(255) DEFAULT NULL,
  `class` varchar(255) DEFAULT NULL,
  `role` varchar(255) DEFAULT NULL,
  `file` text DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;




DROP TABLE IF EXISTS `responses`;

CREATE TABLE `responses` (
  `id` int(11) NOT NULL,
  `json` longtext DEFAULT NULL,
  `platform` varchar(400) DEFAULT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;




DROP TABLE IF EXISTS `roaster`;

CREATE TABLE `roaster` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `emp_id` varchar(300) DEFAULT NULL,
  `work_assigned` text DEFAULT NULL,
  `dated` date DEFAULT NULL,
  `times` longtext DEFAULT NULL,
  `open_time` varchar(300) DEFAULT NULL,
  `close_time` varchar(300) DEFAULT NULL,
  `business_id` varchar(300) DEFAULT NULL,
  `remarks` text DEFAULT NULL,
  `user_id` varchar(300) DEFAULT NULL,
  `timestamp` timestamp NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=latin1;

INSERT INTO `roaster` VALUES("1","10028","ye kam krna","2021-08-16","{\"opening_time\":\"09:00\",\"closing_time\":\"17:30\"}","09:00:00","17:30:00","7","Added by moixx.ansari43@gmail.com","1","2021-08-20 17:27:58");
INSERT INTO `roaster` VALUES("2","10028","","2021-08-17","{\"opening_time\":\"\",\"closing_time\":\"\"}","","","7","Added by moixx.ansari43@gmail.com","1","2021-08-20 17:27:58");
INSERT INTO `roaster` VALUES("3","10028","","2021-08-18","{\"opening_time\":\"\",\"closing_time\":\"\"}","","","7","Added by moixx.ansari43@gmail.com","1","2021-08-20 17:27:58");
INSERT INTO `roaster` VALUES("4","10028","","2021-08-19","{\"opening_time\":\"\",\"closing_time\":\"\"}","","","7","Added by moixx.ansari43@gmail.com","1","2021-08-20 17:27:58");
INSERT INTO `roaster` VALUES("5","10028","","2021-08-20","{\"opening_time\":\"\",\"closing_time\":\"\"}","","","7","Added by moixx.ansari43@gmail.com","1","2021-08-20 17:27:58");
INSERT INTO `roaster` VALUES("6","10028","","2021-08-21","{\"opening_time\":\"\",\"closing_time\":\"\"}","","","7","Added by moixx.ansari43@gmail.com","1","2021-08-20 17:27:58");
INSERT INTO `roaster` VALUES("7","10028","","2021-08-22","{\"opening_time\":\"\",\"closing_time\":\"\"}","","","7","Added by moixx.ansari43@gmail.com","1","2021-08-20 17:27:58");
INSERT INTO `roaster` VALUES("8","10028","to work something","2021-09-06","{\"opening_time\":\"09:00\",\"closing_time\":\"12:00\"}","09:00:00","12:00:00","7","Added by moixx.ansari43@gmail.com","1","2021-09-10 03:03:34");
INSERT INTO `roaster` VALUES("9","10028","","2021-09-07","{\"opening_time\":\"\",\"closing_time\":\"\"}","","","7","Added by moixx.ansari43@gmail.com","1","2021-09-10 03:03:34");
INSERT INTO `roaster` VALUES("10","10028","","2021-09-08","{\"opening_time\":\"\",\"closing_time\":\"\"}","","","7","Added by moixx.ansari43@gmail.com","1","2021-09-10 03:03:34");
INSERT INTO `roaster` VALUES("11","10028","","2021-09-09","{\"opening_time\":\"\",\"closing_time\":\"\"}","","","7","Added by moixx.ansari43@gmail.com","1","2021-09-10 03:03:34");
INSERT INTO `roaster` VALUES("12","10028","","2021-09-10","{\"opening_time\":\"\",\"closing_time\":\"\"}","","","7","Added by moixx.ansari43@gmail.com","1","2021-09-10 03:03:34");
INSERT INTO `roaster` VALUES("13","10028","","2021-09-11","{\"opening_time\":\"\",\"closing_time\":\"\"}","","","7","Added by moixx.ansari43@gmail.com","1","2021-09-10 03:03:34");
INSERT INTO `roaster` VALUES("14","10028","","2021-09-12","{\"opening_time\":\"\",\"closing_time\":\"\"}","","","7","Added by moixx.ansari43@gmail.com","1","2021-09-10 03:03:34");
INSERT INTO `roaster` VALUES("15","10051","","2021-09-06","{\"opening_time\":\"\",\"closing_time\":\"\"}","","","11","Added by attendanceja@gmail.com","10049","2021-09-10 03:37:02");
INSERT INTO `roaster` VALUES("16","10051","","2021-09-07","{\"opening_time\":\"\",\"closing_time\":\"\"}","","","11","Added by attendanceja@gmail.com","10049","2021-09-10 03:37:02");
INSERT INTO `roaster` VALUES("17","10051","","2021-09-08","{\"opening_time\":\"\",\"closing_time\":\"\"}","","","11","Added by attendanceja@gmail.com","10049","2021-09-10 03:37:02");
INSERT INTO `roaster` VALUES("18","10051","","2021-09-09","{\"opening_time\":\"\",\"closing_time\":\"\"}","","","11","Added by attendanceja@gmail.com","10049","2021-09-10 03:37:02");
INSERT INTO `roaster` VALUES("19","10051","","2021-09-10","{\"opening_time\":\"\",\"closing_time\":\"\"}","","","11","Added by attendanceja@gmail.com","10049","2021-09-10 03:37:02");
INSERT INTO `roaster` VALUES("20","10051","Change light bulbs","2021-09-11","{\"opening_time\":\"\",\"closing_time\":\"\"}","","","11","Added by attendanceja@gmail.com","10049","2021-09-10 03:37:02");
INSERT INTO `roaster` VALUES("21","10051","Stocktake","2021-09-12","{\"opening_time\":\"\",\"closing_time\":\"\"}","","","11","Added by attendanceja@gmail.com","10049","2021-09-10 03:37:02");
INSERT INTO `roaster` VALUES("22","1","work harder","2022-02-07","{\"opening_time\":\"09:00:00\",\"closing_time\":\"20:00\"}","09:00:00","20:00:00","7","Added by moixx.ansari43@gmail.com","1","2022-02-07 20:13:40");
INSERT INTO `roaster` VALUES("23","1","","2022-02-08","{\"opening_time\":\"\",\"closing_time\":\"\"}","","","7","Added by moixx.ansari43@gmail.com","1","2022-02-07 20:13:40");
INSERT INTO `roaster` VALUES("24","1","","2022-02-09","{\"opening_time\":\"\",\"closing_time\":\"\"}","","","7","Added by moixx.ansari43@gmail.com","1","2022-02-07 20:13:40");
INSERT INTO `roaster` VALUES("25","1","","2022-02-10","{\"opening_time\":\"\",\"closing_time\":\"\"}","","","7","Added by moixx.ansari43@gmail.com","1","2022-02-07 20:13:40");
INSERT INTO `roaster` VALUES("26","1","","2022-02-11","{\"opening_time\":\"\",\"closing_time\":\"\"}","","","7","Added by moixx.ansari43@gmail.com","1","2022-02-07 20:13:40");
INSERT INTO `roaster` VALUES("27","1","","2022-02-12","{\"opening_time\":\"\",\"closing_time\":\"\"}","","","7","Added by moixx.ansari43@gmail.com","1","2022-02-07 20:13:40");
INSERT INTO `roaster` VALUES("28","1","","2022-02-13","{\"opening_time\":\"\",\"closing_time\":\"\"}","","","7","Added by moixx.ansari43@gmail.com","1","2022-02-07 20:13:40");
INSERT INTO `roaster` VALUES("29","1","inception","2022-02-14","{\"opening_time\":\"15:00\",\"closing_time\":\"17:00\"}","15:00:00","17:00:00","8","Added by moixx.ansari43@gmail.com","1","2022-02-16 05:22:11");
INSERT INTO `roaster` VALUES("30","1","","2022-02-15","{\"opening_time\":\"\",\"closing_time\":\"\"}","","","8","Added by moixx.ansari43@gmail.com","1","2022-02-16 05:22:11");
INSERT INTO `roaster` VALUES("31","1","","2022-02-16","{\"opening_time\":\"\",\"closing_time\":\"\"}","","","8","Added by moixx.ansari43@gmail.com","1","2022-02-16 05:22:11");
INSERT INTO `roaster` VALUES("32","1","","2022-02-17","{\"opening_time\":\"\",\"closing_time\":\"\"}","","","8","Added by moixx.ansari43@gmail.com","1","2022-02-16 05:22:11");
INSERT INTO `roaster` VALUES("33","1","","2022-02-18","{\"opening_time\":\"\",\"closing_time\":\"\"}","","","8","Added by moixx.ansari43@gmail.com","1","2022-02-16 05:22:11");
INSERT INTO `roaster` VALUES("34","1","","2022-02-19","{\"opening_time\":\"\",\"closing_time\":\"\"}","","","8","Added by moixx.ansari43@gmail.com","1","2022-02-16 05:22:11");
INSERT INTO `roaster` VALUES("35","1","","2022-02-20","{\"opening_time\":\"\",\"closing_time\":\"\"}","","","8","Added by moixx.ansari43@gmail.com","1","2022-02-16 05:22:11");
INSERT INTO `roaster` VALUES("36","1","north","2022-08-15","{\"opening_time\":\"\",\"closing_time\":\"\"}","","","7","Added by moixx.ansari43@gmail.com","1","2022-08-16 21:36:35");
INSERT INTO `roaster` VALUES("37","1","","2022-08-16","{\"opening_time\":\"\",\"closing_time\":\"\"}","","","7","Added by moixx.ansari43@gmail.com","1","2022-08-16 21:36:35");
INSERT INTO `roaster` VALUES("38","1","","2022-08-17","{\"opening_time\":\"\",\"closing_time\":\"\"}","","","7","Added by moixx.ansari43@gmail.com","1","2022-08-16 21:36:35");
INSERT INTO `roaster` VALUES("39","1","","2022-08-18","{\"opening_time\":\"\",\"closing_time\":\"\"}","","","7","Added by moixx.ansari43@gmail.com","1","2022-08-16 21:36:35");
INSERT INTO `roaster` VALUES("40","1","","2022-08-19","{\"opening_time\":\"\",\"closing_time\":\"\"}","","","7","Added by moixx.ansari43@gmail.com","1","2022-08-16 21:36:35");
INSERT INTO `roaster` VALUES("41","1","","2022-08-20","{\"opening_time\":\"\",\"closing_time\":\"\"}","","","7","Added by moixx.ansari43@gmail.com","1","2022-08-16 21:36:35");
INSERT INTO `roaster` VALUES("42","1","","2022-08-21","{\"opening_time\":\"\",\"closing_time\":\"\"}","","","7","Added by moixx.ansari43@gmail.com","1","2022-08-16 21:36:35");
INSERT INTO `roaster` VALUES("43","1","developer","2022-08-29","{\"opening_time\":\"15:53\",\"closing_time\":\"15:55\"}","15:53:00","15:55:00","7","Added by moixx.ansari43@gmail.com","1","2022-08-31 15:53:25");
INSERT INTO `roaster` VALUES("44","1","","2022-08-30","{\"opening_time\":\"\",\"closing_time\":\"\"}","","","7","Added by moixx.ansari43@gmail.com","1","2022-08-31 15:53:25");
INSERT INTO `roaster` VALUES("45","1","","2022-08-31","{\"opening_time\":\"\",\"closing_time\":\"\"}","","","7","Added by moixx.ansari43@gmail.com","1","2022-08-31 15:53:25");
INSERT INTO `roaster` VALUES("46","1","","2022-09-01","{\"opening_time\":\"\",\"closing_time\":\"\"}","","","7","Added by moixx.ansari43@gmail.com","1","2022-08-31 15:53:25");
INSERT INTO `roaster` VALUES("47","1","","2022-09-02","{\"opening_time\":\"\",\"closing_time\":\"\"}","","","7","Added by moixx.ansari43@gmail.com","1","2022-08-31 15:53:25");
INSERT INTO `roaster` VALUES("48","1","","2022-09-03","{\"opening_time\":\"\",\"closing_time\":\"\"}","","","7","Added by moixx.ansari43@gmail.com","1","2022-08-31 15:53:25");
INSERT INTO `roaster` VALUES("49","1","","2022-09-04","{\"opening_time\":\"\",\"closing_time\":\"\"}","","","7","Added by moixx.ansari43@gmail.com","1","2022-08-31 15:53:25");



DROP TABLE IF EXISTS `statement_teaching`;

CREATE TABLE `statement_teaching` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `statement_teaching_text` text DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;




DROP TABLE IF EXISTS `taught_course_details`;

CREATE TABLE `taught_course_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` text DEFAULT NULL,
  `credit_hour` text DEFAULT NULL,
  `teaching_hour` text DEFAULT NULL,
  `phd_ms_bs` text DEFAULT NULL,
  `year` varchar(255) DEFAULT NULL,
  `document` text DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;




DROP TABLE IF EXISTS `traning_conducted`;

CREATE TABLE `traning_conducted` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `details` text DEFAULT NULL,
  `file` text DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;




DROP TABLE IF EXISTS `user_roles`;

CREATE TABLE `user_roles` (
  `user_role_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_role_name` varchar(300) DEFAULT NULL,
  `user_role_status` varchar(300) NOT NULL DEFAULT 'enable',
  `user_role_add_date` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`user_role_id`),
  UNIQUE KEY `user_role_name` (`user_role_name`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

INSERT INTO `user_roles` VALUES("1","administrator","enable","2019-02-08 00:26:05");
INSERT INTO `user_roles` VALUES("5","manager","enable","2019-02-08 01:02:24");
INSERT INTO `user_roles` VALUES("8","employee","enable","2020-12-15 14:35:12");
INSERT INTO `user_roles` VALUES("9","free plan","enable","2021-08-13 01:38:37");



DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(300) CHARACTER SET latin1 NOT NULL,
  `user_first_name` varchar(300) DEFAULT NULL,
  `user_last_name` varchar(300) DEFAULT NULL,
  `user_email` varchar(400) CHARACTER SET latin1 DEFAULT NULL,
  `user_phone` varchar(300) CHARACTER SET latin1 DEFAULT NULL,
  `user_password` text CHARACTER SET latin1 DEFAULT NULL,
  `user_dob` date DEFAULT NULL,
  `user_extra` longtext CHARACTER SET latin1 DEFAULT NULL,
  `user_address` text CHARACTER SET latin1 DEFAULT NULL,
  `user_cnic` varchar(300) CHARACTER SET latin1 DEFAULT NULL,
  `designation` varchar(300) CHARACTER SET utf8 COLLATE utf8_general_mysql500_ci DEFAULT NULL,
  `user_type` varchar(400) DEFAULT NULL,
  `salary_mode` varchar(300) DEFAULT NULL,
  `user_team` text DEFAULT NULL,
  `user_join_date` date DEFAULT NULL,
  `user_company_name` varchar(400) DEFAULT NULL,
  `user_email_verification` varchar(400) DEFAULT NULL,
  `user_billing_type` varchar(400) DEFAULT NULL,
  `device_id` varchar(300) DEFAULT NULL,
  `is_multiple` varchar(100) DEFAULT NULL,
  `user_timing` longtext DEFAULT NULL,
  `user_status` varchar(300) CHARACTER SET latin1 NOT NULL DEFAULT 'enable',
  `is_verify` varchar(300) DEFAULT 'no',
  `verify_token` varchar(500) DEFAULT NULL,
  `user_created_id` int(11) DEFAULT NULL,
  `user_add_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `user_pic` varchar(300) CHARACTER SET latin1 DEFAULT 'default.png',
  `notification_id` longtext DEFAULT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `user_email` (`user_email`)
) ENGINE=InnoDB AUTO_INCREMENT=10306 DEFAULT CHARSET=utf32;

INSERT INTO `users` VALUES("1","admin","moiz iqbal","muhammad iqbal","moixx.ansari43@gmail.com","923226224202","202cb962ac59075b964b07152d234b70","1994-08-19","{\"age\":\"321\",\"domicile\":\"123\",\"cnic\":\"123\",\"tts_service\":\"231\",\"assistant_professor\":\"213\",\"mid_term_review\":\"23\",\"department\":\"123\",\"phd_experience\":\"aewwr\"}","House 66 B Block Gulberg Colony12","","CEO & Founder",NULL,"fixed","Development","2017-09-17",NULL,NULL,NULL,"2cbbc099194b8451","yes","[{\"mon\":{\"opening_time\":\"09:00:00\",\"closing_time\":\"17:00:00\"}},{\"tue\":{\"opening_time\":\"\",\"closing_time\":\"\"}},{\"wed\":{\"opening_time\":\"\",\"closing_time\":\"\"}},{\"thu\":{\"opening_time\":\"\",\"closing_time\":\"\"}},{\"fri\":{\"opening_time\":\"12:30:00\",\"closing_time\":\"18:30:00\"}},{\"sat\":{\"opening_time\":\"\",\"closing_time\":\"\"}},{\"sun\":{\"opening_time\":\"\",\"closing_time\":\"\"}}]","enable","yes",NULL,"1","2019-02-06 16:23:46","17975473606207a66402d88.png","fSa4QZFjS6ONJxFigBi2jx:APA91bE7mIO6WtRaD--8GF5RdWPfHsOL6Rq4msXqGW0zAJFPSe1AwO9lMns7ewOE5IYC_8MOhJ8uGx1qdXpK8hnKuthU9HUjcdNfxME1uTdV3gDSNCILgtTisP_RNKfLBjLlbkVKL5aA");
INSERT INTO `users` VALUES("10283","usama1_64842","usama1","ehsan1","usamaa.ehsan1@gmail.com","03096347913","202cb962ac59075b964b07152d234b70","0000-00-00","null",NULL,NULL,"",NULL,"","","0000-00-00",NULL,NULL,NULL,"",NULL,NULL,"enable","no",NULL,"1","2023-06-10 12:46:37","24461512464842a5d17945.png",NULL);
INSERT INTO `users` VALUES("10284","usama2_64843","usama2","ehsan2","usamaa.ehsan@gmail.com12","03096347913","202cb962ac59075b964b07152d234b70",NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,"enable","no",NULL,"1","2023-06-10 13:20:03","1610154226648432d1cd8e2.png",NULL);
INSERT INTO `users` VALUES("10292","ali_64843","ali","akram","ali@gmaol.com","03096347913","202cb962ac59075b964b07152d234b70",NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,"enable","no",NULL,"1","2023-06-10 13:23:56","16471612486484331caed96.png",NULL);
INSERT INTO `users` VALUES("10305","usama_64897","usama","ehsan","usamaa.ehsan@gmail.com","03096347913","1967b01c0a7d4c635be140742cc128d8",NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,"enable","no",NULL,"1","2023-06-14 13:22:54","2037639893648978de626db.png",NULL);
