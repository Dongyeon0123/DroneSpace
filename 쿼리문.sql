		CREATE DATABASE dbwork;
		
		USE dbwork;


                CREATE TABLE `admins` (
                  `adminid` varchar(50) NOT NULL,
                  `adpassword` varchar(255) NOT NULL,
                  `adname` varchar(50) NOT NULL,
                  PRIMARY KEY (`adminid`)
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

                CREATE TABLE `applications` (
                  `application_id` int(11) NOT NULL AUTO_INCREMENT,
                  `recruitnum` int(11) NOT NULL,
                  `memberid` varchar(255) NOT NULL,
                  `resume_id` int(11) NOT NULL,
                  `message` text NOT NULL,
                  `apply_date` datetime DEFAULT current_timestamp(),
                  PRIMARY KEY (`application_id`)
                ) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

                CREATE TABLE `commenttbl` (
                  `commentnum` int(11) NOT NULL AUTO_INCREMENT,
                  `memberid` varchar(255) DEFAULT NULL,
                  `commentcontent` text DEFAULT NULL,
                  `postnum` int(11) DEFAULT NULL,
                  `commentdate` datetime DEFAULT current_timestamp(),
                  PRIMARY KEY (`commentnum`),
                  KEY `postnum` (`postnum`),
                  KEY `memberid` (`memberid`),
                  CONSTRAINT `commenttbl_ibfk_1` FOREIGN KEY (`postnum`) REFERENCES `post` (`postnum`),
                  CONSTRAINT `commenttbl_ibfk_2` FOREIGN KEY (`memberid`) REFERENCES `membertbl` (`memberid`) ON DELETE CASCADE
                ) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

                CREATE TABLE `comment_likes` (
                  `id` int(11) NOT NULL AUTO_INCREMENT,
                  `commentnum` int(11) DEFAULT NULL,
                  `memberid` varchar(255) DEFAULT NULL,
                  PRIMARY KEY (`id`),
                  KEY `commentnum` (`commentnum`),
                  KEY `memberid` (`memberid`),
                  CONSTRAINT `comment_likes_ibfk_1` FOREIGN KEY (`commentnum`) REFERENCES `commenttbl` (`commentnum`) ON DELETE CASCADE,
                  CONSTRAINT `comment_likes_ibfk_2` FOREIGN KEY (`memberid`) REFERENCES `membertbl` (`memberid`) ON DELETE CASCADE
                ) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

                CREATE TABLE `likes` (
                  `likeid` int(11) NOT NULL AUTO_INCREMENT,
                  `postnum` int(11) NOT NULL,
                  `memberid` varchar(255) NOT NULL,
                  PRIMARY KEY (`likeid`),
                  KEY `postnum` (`postnum`),
                  KEY `memberid` (`memberid`),
                  CONSTRAINT `likes_ibfk_1` FOREIGN KEY (`postnum`) REFERENCES `post` (`postnum`),
                  CONSTRAINT `likes_ibfk_2` FOREIGN KEY (`memberid`) REFERENCES `membertbl` (`memberid`)
                ) ENGINE=InnoDB AUTO_INCREMENT=148 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

                CREATE TABLE `membertbl` (
                  `memberid` varchar(255) NOT NULL,
                  `password` varchar(255) NOT NULL,
                  `name` varchar(255) NOT NULL,
                  `email` varchar(255) NOT NULL,
                  `cernum` int(11) DEFAULT NULL,
                  `license_image` varchar(255) DEFAULT NULL,
                  `identification_photo` varchar(255) DEFAULT NULL,
                  PRIMARY KEY (`memberid`),
                  UNIQUE KEY `cernum` (`cernum`)
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

                CREATE TABLE `post` (
                  `postnum` int(11) NOT NULL AUTO_INCREMENT,
                  `posttitle` varchar(255) DEFAULT NULL,
                  `memberid` varchar(255) DEFAULT NULL,
                  `postcontent` varchar(255) DEFAULT NULL,
                  `postdate` date DEFAULT NULL,
                  PRIMARY KEY (`postnum`),
                  KEY `memberid` (`memberid`),
                  CONSTRAINT `post_ibfk_1` FOREIGN KEY (`memberid`) REFERENCES `membertbl` (`memberid`) ON DELETE CASCADE
                ) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

                CREATE TABLE `questions` (
                  `id` int(11) NOT NULL AUTO_INCREMENT,
                  `username` varchar(255) NOT NULL,
                  `question` text NOT NULL,
                  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
                  PRIMARY KEY (`id`)
                ) ENGINE=InnoDB AUTO_INCREMENT=54 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

                CREATE TABLE `recruitment` (
                  `recruitnum` int(11) NOT NULL AUTO_INCREMENT,
                  `memberid` varchar(255) NOT NULL,
                  `title` varchar(255) NOT NULL,
                  `description` text NOT NULL,
                  `region` varchar(255) NOT NULL,
                  `qualifications` text NOT NULL,
                  `company_name` varchar(255) NOT NULL,
                  `working_period` varchar(255) NOT NULL,
                  `contact_name` varchar(255) NOT NULL,
                  `contact_phone` varchar(255) NOT NULL,
                  `contact_email` varchar(255) NOT NULL,
                  `postdate` datetime DEFAULT current_timestamp(),
                  `working_hours_start` time NOT NULL,
                  `working_hours_end` time NOT NULL,
                  PRIMARY KEY (`recruitnum`)
                ) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

                CREATE TABLE `recruitment_likes` (
                  `id` int(11) NOT NULL AUTO_INCREMENT,
                  `recruitnum` int(11) NOT NULL,
                  `memberid` varchar(255) NOT NULL,
                  PRIMARY KEY (`id`),
                  KEY `recruitnum` (`recruitnum`),
                  CONSTRAINT `recruitment_likes_ibfk_1` FOREIGN KEY (`recruitnum`) REFERENCES `recruitment` (`recruitnum`) ON DELETE CASCADE
                ) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

                CREATE TABLE `replies` (
                  `id` int(11) NOT NULL AUTO_INCREMENT,
                  `questionid` int(11) NOT NULL,
                  `reply` text NOT NULL,
                  `adminid` varchar(50) NOT NULL,
                  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
                  PRIMARY KEY (`id`),
                  KEY `questionid` (`questionid`),
                  KEY `adminid` (`adminid`),
                  CONSTRAINT `replies_ibfk_1` FOREIGN KEY (`questionid`) REFERENCES `questions` (`id`) ON DELETE CASCADE,
                  CONSTRAINT `replies_ibfk_2` FOREIGN KEY (`adminid`) REFERENCES `admins` (`adminid`)
                ) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

                CREATE TABLE `resumes` (
                  `resume_id` int(11) NOT NULL AUTO_INCREMENT,
                  `memberid` varchar(255) NOT NULL,
                  `name` varchar(255) NOT NULL,
                  `birthdate` date NOT NULL,
                  `phone` varchar(50) NOT NULL,
                  `address` text NOT NULL,
                  `education_level` varchar(255) NOT NULL,
                  `university_name` varchar(255) DEFAULT NULL,
                  `certifications` text DEFAULT NULL,
                  `experience` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`experience`)),
                  `resume_photo` varchar(255) DEFAULT NULL,
                  PRIMARY KEY (`resume_id`),
                  KEY `memberid` (`memberid`),
                  CONSTRAINT `resumes_ibfk_1` FOREIGN KEY (`memberid`) REFERENCES `membertbl` (`memberid`) ON DELETE CASCADE
                ) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
                
                select * from membertbl;
                select * from post;
                select * from commenttbl;
                select * from questions;
                select * from resumes;