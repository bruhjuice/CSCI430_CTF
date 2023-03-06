CREATE SCHEMA IF NOT EXISTS `CSCI430CTF` DEFAULT CHARACTER SET utf8mb4;
USE CSCI430CTF;

CREATE TABLE `users` (
`username` varchar(100) NOT NULL,
`password` varchar(100) NOT NULL,
`salt` int NOT NULL,
`balance` DECIMAL(65,2) NOT NULL,
`closed` boolean NOT NULL,
PRIMARY KEY (`username`)
);

INSERT INTO  users (username, password, salt, balance, closed)
VALUES	('testUsername', 'testPassword', 3, 0, true);

CREATE USER 'allpowerfulbeing'@'localhost' IDENTIFIED BY 'ihavepower';
GRANT SELECT, INSERT, UPDATE ON CSCI430CTF.* TO 'allpowerfulbeing'@'localhost';



