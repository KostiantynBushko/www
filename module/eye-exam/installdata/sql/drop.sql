ALTER TABLE `EavObject` DROP FOREIGN KEY `EyeExamRequest_EavObject`;
ALTER TABLE `EavObject` DROP COLUMN `eyeExamRequestID`, DROP INDEX `EyeExamRequest_EavObject`;


DROP TABLE `EyeExamSchedule`;
DROP TABLE `EyeExamRequest`;
