-- source WeddingBoard/db_schema/schema.sql

DROP DATABASE IF EXISTS WeddingBoardDB;
CREATE DATABASE WeddingBoardDB;
USE WeddingBoardDB;

CREATE TABLE WBUSER(
  UUsername VARCHAR(40) NOT NULL,
  UPassword CHAR(60) NOT NULL,
  UFirstName VARCHAR(60),
  ULastName VARCHAR(60),
  PRIMARY KEY (UUsername)
) ENGINE=Innodb;

CREATE TABLE WEDDING_BOARD(
  WPin CHAR(12) NOT NULL,
  WUsername VARCHAR(40) NOT NULL,
  WPassword VARCHAR(60),
  WTitle VARCHAR(20),
  WBackgroundColor CHAR(6),
  WForegroundColor CHAR(6),
  WFontColor CHAR(6),
  WIsHoneyCombShape BIT DEFAULT 0,
  PRIMARY KEY (WPin),
  FOREIGN KEY (WUsername) REFERENCES WBUSER(UUsername)
) ENGINE=Innodb;

CREATE TABLE PICTURE(
  PFilePath VARCHAR(256) NOT NULL,
  PPin CHAR(12) NOT NULL,
  PCaption VARCHAR(300),
  PRIMARY KEY (PFilePath),
  FOREIGN KEY (PPin) REFERENCES WEDDING_BOARD(WPin)
);

INSERT INTO WBUSER (UUsername, UPassword, UFirstName, ULastName)
VALUES ('user', 'blah', 'UserF', 'UserL');
INSERT INTO WBUSER (UUsername, UPassword, UFirstName, ULastName)
VALUES ('john_smith', 'wow', 'John', 'Smith');
INSERT INTO WBUSER (UUsername, UPassword, UFirstName, ULastName)
VALUES ('jane_doe1', 'ok1', 'Jane', 'Doe');

INSERT INTO WEDDING_BOARD(WPin, WPassword, WUsername, WTitle, WBackgroundColor, WForegroundColor, WFontColor, WIsHoneyCombShape)
VALUES ('123456789101', 'my_pass', 'user', 'my_board', '0f116e', '2bbded', 'ffffff', FALSE);
INSERT INTO WEDDING_BOARD(WPin, WPassword, WUsername, WTitle, WBackgroundColor, WForegroundColor, WFontColor, WIsHoneyCombShape)
VALUES ('123456789102', 'my_other_pass', 'user', 'my_second_board', '5d146b', 'caabdb', 'ffffff', TRUE);
INSERT INTO WEDDING_BOARD(WPin, WPassword, WUsername, WTitle, WBackgroundColor, WForegroundColor, WFontColor, WIsHoneyCombShape)
VALUES ('123456789103', 'my_pass', 'john_smith', 'board', 'f2b749', 'fffcf7', '000000', FALSE);
