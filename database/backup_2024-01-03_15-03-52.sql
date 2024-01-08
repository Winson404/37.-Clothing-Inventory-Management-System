DROP TABLE IF EXISTS announcement;

CREATE TABLE `announcement` (
  `actId` int(11) NOT NULL AUTO_INCREMENT,
  `actName` text NOT NULL,
  `actDate` varchar(20) NOT NULL,
  `date_added` datetime NOT NULL,
  PRIMARY KEY (`actId`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

INSERT INTO announcement VALUES("2","Activity 5","2022-12-23","0000-00-00 00:00:00");
INSERT INTO announcement VALUES("3","Activity 3","2022-12-10","2022-12-11 00:00:00");
INSERT INTO announcement VALUES("4","Activity 2","2022-12-11","2022-12-11 00:00:00");
INSERT INTO announcement VALUES("5","Lorem ipsum, dolor sit amet consectetur adipisicing elit. Rem, ipsum delectus voluptatum? Molestias aut inventore eaque, maxime numquam dignissimos asperiores, voluptatibus consectetur distinctio excepturi odit architecto, saepe enim sunt, molestiae.","2022-12-11","2022-12-11 00:00:00");
INSERT INTO announcement VALUES("6","sample","2022-12-27","2022-12-27 00:00:00");
INSERT INTO announcement VALUES("8","gfdgfd","2023-01-06","2022-12-27 00:00:00");
INSERT INTO announcement VALUES("9","Announcement sample","2023-01-09","2023-01-16 00:00:00");
INSERT INTO announcement VALUES("10","SAMple","2023-01-24","2023-01-16 00:00:00");
INSERT INTO announcement VALUES("11","yhfng","2023-02-13","2023-02-05 00:00:00");
INSERT INTO announcement VALUES("12","smaple","2023-07-28","2023-07-08 00:00:00");
INSERT INTO announcement VALUES("13","sadsadsa","2023-07-29","2023-07-08 07:51:00");
INSERT INTO announcement VALUES("14","samples","2023-09-07","2023-09-20 08:26:00");
INSERT INTO announcement VALUES("16","dsadsadasdsa","2023-11-16","2023-10-24 15:58:49");
INSERT INTO announcement VALUES("17","akoa kinis","2023-12-09","2023-10-24 15:59:24");
INSERT INTO announcement VALUES("18","dfss","2023-12-18","2023-12-18 06:48:00");
INSERT INTO announcement VALUES("19","Smaple","2023-12-26","2023-12-18 19:03:50");
INSERT INTO announcement VALUES("20","dsa","2023-12-28","2023-12-18 19:17:01");



DROP TABLE IF EXISTS log_history;

CREATE TABLE `log_history` (
  `log_Id` int(11) NOT NULL AUTO_INCREMENT,
  `user_Id` int(11) NOT NULL,
  `login_time` varchar(100) NOT NULL,
  `logout_time` varchar(100) NOT NULL,
  PRIMARY KEY (`log_Id`)
) ENGINE=InnoDB AUTO_INCREMENT=97 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

INSERT INTO log_history VALUES("63","66","2024-01-02 07:42 PM","2024-01-02 08:01:09");
INSERT INTO log_history VALUES("64","66","2024-01-02 08:01 PM","2024-01-02 08:01:29");
INSERT INTO log_history VALUES("65","72","2024-01-02 08:01 PM","2024-01-02 08:03:01");
INSERT INTO log_history VALUES("66","66","2024-01-02 08:03 PM","2024-01-02 08:43:30");
INSERT INTO log_history VALUES("67","66","2024-01-02 08:45 PM","2024-01-02 08:52:43");
INSERT INTO log_history VALUES("68","72","2024-01-02 08:52 PM","2024-01-02 09:06:51");
INSERT INTO log_history VALUES("69","66","2024-01-02 09:50 PM","2024-01-02 09:51:36");
INSERT INTO log_history VALUES("70","72","2024-01-02 09:53 PM","2024-01-02 10:11:51");
INSERT INTO log_history VALUES("71","72","2024-01-02 10:42 PM","2024-01-03 12:54:34");
INSERT INTO log_history VALUES("72","66","2024-01-03 12:54 AM","2024-01-03 12:59:20");
INSERT INTO log_history VALUES("73","72","2024-01-03 12:59 AM","2024-01-03 12:59:44");
INSERT INTO log_history VALUES("74","66","2024-01-03 12:59 AM","2024-01-03 01:03:22");
INSERT INTO log_history VALUES("75","72","2024-01-03 01:03 AM","2024-01-03 01:04:54");
INSERT INTO log_history VALUES("76","66","2024-01-03 01:04 AM","2024-01-03 01:13:18");
INSERT INTO log_history VALUES("77","72","2024-01-03 01:13 AM","2024-01-03 01:18:56");
INSERT INTO log_history VALUES("78","66","2024-01-03 01:19 AM","2024-01-03 01:30:59");
INSERT INTO log_history VALUES("79","72","2024-01-03 01:31 AM","2024-01-03 01:33:48");
INSERT INTO log_history VALUES("80","66","2024-01-03 01:33 AM","2024-01-03 01:55:54");
INSERT INTO log_history VALUES("81","66","2024-01-03 02:07 AM","2024-01-03 02:14:45");
INSERT INTO log_history VALUES("82","72","2024-01-03 02:14 AM","2024-01-03 02:14:57");
INSERT INTO log_history VALUES("83","72","2024-01-03 02:15 AM","2024-01-03 02:19:09");
INSERT INTO log_history VALUES("84","72","2024-01-03 02:15 AM","2024-01-03 02:19:09");
INSERT INTO log_history VALUES("85","66","2024-01-03 02:19 AM","2024-01-03 02:29:51");
INSERT INTO log_history VALUES("86","66","2024-01-03 02:30 AM","");
INSERT INTO log_history VALUES("87","66","2024-01-03 12:48 PM","2024-01-03 12:58:48");
INSERT INTO log_history VALUES("88","66","2024-01-03 01:00 PM","2024-01-03 01:14:51");
INSERT INTO log_history VALUES("89","72","2024-01-03 01:14 PM","2024-01-03 01:27:48");
INSERT INTO log_history VALUES("90","72","2024-01-03 01:28 PM","2024-01-03 01:47:48");
INSERT INTO log_history VALUES("91","72","2024-01-03 01:49 PM","2024-01-03 01:55:11");
INSERT INTO log_history VALUES("92","66","2024-01-03 01:55 PM","2024-01-03 02:05:25");
INSERT INTO log_history VALUES("93","72","2024-01-03 02:05 PM","2024-01-03 02:08:00");
INSERT INTO log_history VALUES("94","66","2024-01-03 02:50 PM","2024-01-03 02:54:59");
INSERT INTO log_history VALUES("95","72","2024-01-03 02:55 PM","2024-01-03 03:03:01");
INSERT INTO log_history VALUES("96","66","2024-01-03 02:55 PM","");



DROP TABLE IF EXISTS products;

CREATE TABLE `products` (
  `prod_ID` int(11) NOT NULL AUTO_INCREMENT,
  `prod_name` varchar(100) NOT NULL,
  `prod_desc` text NOT NULL,
  `prod_size` varchar(50) NOT NULL,
  `prod_color` varchar(50) NOT NULL,
  `prod_qty` int(11) NOT NULL,
  `prod_qty_orig` int(11) NOT NULL,
  `prod_price` int(11) NOT NULL,
  `supplier_ID` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`prod_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO products VALUES("1","Product 11","New Desc","Small","Pink","158","200","200","4","2024-01-02 19:37:09");
INSERT INTO products VALUES("3","Product 1","Product 1Product 1","Large","Pink","0","200","2","1","2024-01-02 20:32:28");
INSERT INTO products VALUES("4","Product 3","Sample","Small","Balck","200","200","100","3","2024-01-03 01:07:32");
INSERT INTO products VALUES("5","Product 4","Product 4 Descriptions","Large","Pink","188","200","100","1","2024-01-03 01:13:56");
INSERT INTO products VALUES("6","Product 5","dsadsada","Dsadasdsa","Dsadasdas","200","200","4343","1","2024-01-03 02:50:14");
INSERT INTO products VALUES("7","Smaplefsdfs","sample","Small","Green","200","200","100","4","2024-01-03 14:54:19");



DROP TABLE IF EXISTS requisition;

CREATE TABLE `requisition` (
  `req_ID` int(11) NOT NULL AUTO_INCREMENT,
  `emp_ID` int(11) NOT NULL,
  `prod_ID` int(11) NOT NULL,
  `req_qty` int(11) NOT NULL,
  `requirements` varchar(255) NOT NULL,
  `reason` text NOT NULL,
  `notes` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0 COMMENT '0=Pending, 1=Approved,2=Rejected',
  `is_deleted` int(11) NOT NULL DEFAULT 0 COMMENT '0=Not Deleted, 1=Not Deleted',
  `delivery_date` date NOT NULL,
  `request_date` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`req_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO requisition VALUES("1","87","1","20","Sample2","Sample2","Sample2","1","1","2024-01-15","2024-01-02 23:04:54");
INSERT INTO requisition VALUES("4","72","5","12","Sample","Sample","Sample","1","0","2024-01-18","2024-01-03 00:01:51");
INSERT INTO requisition VALUES("6","87","3","200","Sample","Sample","Sample","1","0","2024-01-19","2024-01-03 03:35:41");
INSERT INTO requisition VALUES("8","72","1","22","dsadas","dsfd","fdsfsd","1","0","2024-01-25","2024-01-03 14:55:23");



DROP TABLE IF EXISTS suppliers;

CREATE TABLE `suppliers` (
  `supplier_ID` int(11) NOT NULL AUTO_INCREMENT,
  `f_name` varchar(50) NOT NULL,
  `m_name` varchar(50) NOT NULL,
  `l_name` varchar(50) NOT NULL,
  `address` text NOT NULL,
  `contact` varchar(30) NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`supplier_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO suppliers VALUES("1","Supplier 1s2","Supplier 1s2","Supplier 1s2","Supplier S2","93594289632221","2024-01-02 19:12:14");
INSERT INTO suppliers VALUES("3","Supplier 2","Supplier 2","Supplier 2","Supplier 2","93594289631","2023-12-19 14:17:09");
INSERT INTO suppliers VALUES("4","Supplier 3","Supplier 3","Supplier 3","Supplier 3","1231231321","2024-01-02 19:08:28");



DROP TABLE IF EXISTS users;

CREATE TABLE `users` (
  `user_Id` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(255) NOT NULL,
  `middlename` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `suffix` varchar(255) NOT NULL,
  `dob` varchar(255) NOT NULL,
  `age` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `contact` varchar(100) NOT NULL,
  `birthplace` varchar(255) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `civilstatus` varchar(50) NOT NULL,
  `occupation` varchar(50) NOT NULL,
  `religion` varchar(100) NOT NULL,
  `house_no` varchar(255) NOT NULL,
  `street_name` varchar(255) NOT NULL,
  `purok` varchar(255) NOT NULL,
  `zone` varchar(255) NOT NULL,
  `barangay` varchar(255) NOT NULL,
  `municipality` varchar(255) NOT NULL,
  `province` varchar(255) NOT NULL,
  `region` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `user_type` varchar(50) NOT NULL DEFAULT 'User',
  `verification_code` int(11) NOT NULL,
  `date_registered` datetime NOT NULL,
  PRIMARY KEY (`user_Id`)
) ENGINE=InnoDB AUTO_INCREMENT=89 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO users VALUES("66","Admins","Admin","Admin","Admin","2023-10-11","1 Week Old","admin@gmail.com","9359428963","Female","Male","Single","Admin","Bible Baptist Church","Dsas","Admin","Admin","Dsa","Admin","Admin","Admins","Admins","2.jpg","0192023a7bbd73250516f069df18b500","Admin","374025","2022-11-25 00:00:00");
INSERT INTO users VALUES("72","Employee","User","User","Jr","2022-12-21","5 Days Old","employee@gmail.com","9359428963","Gfdgfdg","Male","Married","Gfdgfdgd","Buddhist","Gfdg","Fdg","Gdfgdg","Gfdg","Dfgd","Fdgdg","Fdg","Dfg","2.jpg","0192023a7bbd73250516f069df18b500","Employee","295016","2022-12-27 00:00:00");
INSERT INTO users VALUES("86","SampleSample Sample","Sample Sample Sample","Sample Sample","Sample","2008-02-27","15 Years Old","sonerwin12@gmail.com","9123456789","Samplef Fsdfsd","Male","Single","Sampleff Fsdfds","Evangelical Christianity","Fdfds Fdsf","Fsfsdfsdds ","Sf Fsdff","Fsdfsdfsdfs Fdsf Sfs","Fdsfd Fsfs Fs","Fdsfds","Fsdffdsf","Sdfsd","pexels-photo-2379005.jpeg","0192023a7bbd73250516f069df18b500","Employee","0","2023-12-18 19:19:29");
INSERT INTO users VALUES("87","Leste","Leste","Leste","Leste","1986-02-26","37 Years Old","adminLeste@gmail.com","9123456789","Leste","Female","Widow/ER","Leste","Iglesia Ni Cristo","Leste","Leste","Leste","Leste","Leste","Leste","Leste","Leste","4.jpg","83e7921e87b1df559db9c4d2ad9b2697","Employee","0","2023-12-18 19:22:55");
INSERT INTO users VALUES("88","Dsad","Asdasd","Sadsa","Dasda","1979-03-07","44 Years Old","sonerwin8@gmail.com","9359428963","Dadsa","Female","Married","Dsadasda","Buddhist","Dsad","Sadasd","Asdadsad","Sadsa","Dasda","Dsadas","Medellindsadasdas","Dasdasd","1.jpg","0192023a7bbd73250516f069df18b500","Employee","0","2024-01-02 20:14:43");



