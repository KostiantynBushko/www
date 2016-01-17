ALTER TABLE `EavObject`
ADD COLUMN `eyeExamRequestID` INT(10) UNSIGNED NULL DEFAULT NULL COMMENT '' AFTER `shippingServiceID`;

CREATE TABLE `EyeExamRequest` (
  `ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `eavObjectID` int(10) unsigned DEFAULT NULL,
  `date` date DEFAULT NULL,
  `time` time DEFAULT NULL,
  `lastModifiedTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `protectedFields` text CHARACTER SET utf8,
  PRIMARY KEY (`ID`),
  KEY `requestDate` (`date`),
  KEY `EavObject_EyeExamRequest_idx` (`eavObjectID`),
  CONSTRAINT `EavObject_EyeExamRequest` FOREIGN KEY (`eavObjectID`) REFERENCES `EavObject` (`ID`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE `EyeExamSchedule` (
  `ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `isVisible` tinyint(1) NOT NULL DEFAULT '1',
  `doctorName` varchar(255) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `time` time DEFAULT NULL,
  `comment` text,
  `eyeExamRequestID` int(10) unsigned DEFAULT NULL,
  `lastModifiedTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `protectedFields` text,
  PRIMARY KEY (`ID`),
  KEY `date_time_idx` (`date`,`time`),
  KEY `EyeExamSchedule_eyeExamRequest_idx` (`eyeExamRequestID`),
  CONSTRAINT `EyeExamSchedule_eyeExamRequest` FOREIGN KEY (`eyeExamRequestID`) REFERENCES `EyeExamRequest` (`ID`) ON DELETE SET NULL ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

ALTER TABLE `EavObject`
ADD INDEX `EyeExamRequest_EavObject` (`eyeExamRequestID` ASC)  COMMENT '';

ALTER TABLE `EavObject`
ADD CONSTRAINT `EyeExamRequest_EavObject`
  FOREIGN KEY (`eyeExamRequestID`)
  REFERENCES `EyeExamRequest` (`ID`)
  ON DELETE CASCADE
  ON UPDATE CASCADE;