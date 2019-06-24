CREATE DATABASE `tsc`;

CREATE TABLE `tsc`.`tsc_account` (
  `UserIndex` int(11) NOT NULL,
  `Username` varchar(20) NOT NULL,
  `Email` varchar(60) NOT NULL,
  `Password` varchar(200) NOT NULL,
  `Picture` longblob DEFAULT NULL,
  `Valid` tinyint(1) NOT NULL DEFAULT 0,
  `Mode` varchar(30) NOT NULL DEFAULT 'normal'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `tsc`.`tsc_code` (
  `CodeIndex` int(11) NOT NULL,
  `UserIndex` int(11) NOT NULL,
  `CodeContent` longtext NOT NULL,
  `Date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `Permission` tinyint(1) NOT NULL,
  `Valid` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `tsc`.`tsc_comment` (
  `CommentIndex` int(11) NOT NULL,
  `UserIndex` int(11) NOT NULL,
  `Time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `PostIndex` int(11) NOT NULL,
  `CommentContent` text NOT NULL,
  `Valid` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `tsc`.`tsc_post` (
  `PostIndex` int(11) NOT NULL,
  `UserIndex` int(11) NOT NULL,
  `CodeIndex` int(11) NOT NULL,
  `Date` timestamp NOT NULL DEFAULT current_timestamp(),
  `Title` varchar(50) NOT NULL,
  `PostContent` text NOT NULL,
  `Category` tinyint(1) NOT NULL,
  `Stars` int(11) NOT NULL,
  `Permission` tinyint(1) NOT NULL,
  `Valid` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `tsc`.`tsc_rating` (
  `RatingIndex` int(11) NOT NULL,
  `PostIndex` int(11) NOT NULL,
  `UserIndex` int(11) NOT NULL,
  `Stars` int(11) NOT NULL,
  `Valid` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `tsc`.`tsc_reply` (
  `ReplyIndex` int(11) NOT NULL,
  `UserIndex` int(11) NOT NULL,
  `CommentIndex` int(11) NOT NULL,
  `Time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `ReplyContent` text NOT NULL,
  `Valid` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


ALTER TABLE `tsc`.`tsc_account`
  ADD PRIMARY KEY (`UserIndex`),
  ADD UNIQUE KEY `UserIndex` (`UserIndex`),
  ADD UNIQUE KEY `Username` (`Username`),
  ADD UNIQUE KEY `Email` (`Email`);

ALTER TABLE `tsc`.`tsc_code`
  ADD PRIMARY KEY (`CodeIndex`,`UserIndex`) USING BTREE,
  ADD UNIQUE KEY `CodeIndex` (`CodeIndex`),
  ADD KEY `UserIndex` (`UserIndex`);

ALTER TABLE `tsc`.`tsc_comment`
  ADD PRIMARY KEY (`CommentIndex`,`UserIndex`,`PostIndex`),
  ADD UNIQUE KEY `CommentIndex` (`CommentIndex`),
  ADD KEY `UserIndex` (`UserIndex`),
  ADD KEY `PostIndex` (`PostIndex`);

ALTER TABLE `tsc`.`tsc_post`
  ADD PRIMARY KEY (`PostIndex`,`UserIndex`,`CodeIndex`) USING BTREE,
  ADD UNIQUE KEY `PostIndex` (`PostIndex`),
  ADD KEY `UserIndex` (`UserIndex`),
  ADD KEY `CodeIndex` (`CodeIndex`);

ALTER TABLE `tsc`.`tsc_rating`
  ADD PRIMARY KEY (`RatingIndex`,`PostIndex`,`UserIndex`);

ALTER TABLE `tsc`.`tsc_reply`
  ADD PRIMARY KEY (`ReplyIndex`,`UserIndex`,`CommentIndex`),
  ADD UNIQUE KEY `ReplyIndex` (`ReplyIndex`);


ALTER TABLE `tsc`.`tsc_account`
  MODIFY `UserIndex` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `tsc`.`tsc_code`
  MODIFY `CodeIndex` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `tsc`.`tsc_comment`
  MODIFY `CommentIndex` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `tsc`.`tsc_post`
  MODIFY `PostIndex` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `tsc`.`tsc_rating`
  MODIFY `RatingIndex` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `tsc`.`tsc_reply`
  MODIFY `ReplyIndex` int(11) NOT NULL AUTO_INCREMENT;


ALTER TABLE `tsc`.`tsc_code`
  ADD CONSTRAINT `tsc_code_ibfk_1` FOREIGN KEY (`UserIndex`) REFERENCES `tsc`.`tsc_account` (`UserIndex`);

ALTER TABLE `tsc`.`tsc_comment`
  ADD CONSTRAINT `tsc_comment_ibfk_1` FOREIGN KEY (`UserIndex`) REFERENCES `tsc`.`tsc_account` (`UserIndex`),
  ADD CONSTRAINT `tsc_comment_ibfk_2` FOREIGN KEY (`PostIndex`) REFERENCES `tsc`.`tsc_post` (`PostIndex`);

ALTER TABLE `tsc`.`tsc_post`
  ADD CONSTRAINT `tsc_post_ibfk_1` FOREIGN KEY (`UserIndex`) REFERENCES `tsc`.`tsc_account` (`UserIndex`),
  ADD CONSTRAINT `tsc_post_ibfk_2` FOREIGN KEY (`CodeIndex`) REFERENCES `tsc`.`tsc`.`tsc_code` (`CodeIndex`);

ALTER TABLE `tsc`.`tsc_rating`
  ADD CONSTRAINT `tsc_rating_ibfk_1` FOREIGN KEY (`PostIndex`) REFERENCES `tsc`.`tsc_post` (`PostIndex`),
  ADD CONSTRAINT `tsc_rating_ibfk_2` FOREIGN KEY (`UserIndex`) REFERENCES `tsc`.`tsc_account` (`UserIndex`);

ALTER TABLE `tsc`.`tsc_reply`
  ADD CONSTRAINT `tsc_reply_ibfk_1` FOREIGN KEY (`UserIndex`) REFERENCES `tsc`.`tsc_account` (`UserIndex`),
  ADD CONSTRAINT `tsc_reply_ibfk_2` FOREIGN KEY (`CommentIndex`) REFERENCES `tsc`.`tsc_comment` (`CommentIndex`);
COMMIT;
