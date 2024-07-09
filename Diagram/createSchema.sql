CREATE SCHEMA IF NOT EXISTS `blog` DEFAULT CHARACTER SET utf8 ;
USE `blog` ;

-- Créer les tables dans l'ordre si elle n'existe pas
CREATE TABLE IF NOT EXISTS `blog`.`User` (
  `idUser` INT NOT NULL AUTO_INCREMENT,
  `username` VARCHAR(45) NOT NULL,
  `lastName` VARCHAR(45) NULL,
  `firstName` VARCHAR(20) NULL,
  `email` VARCHAR(100) NULL,
  `password` VARCHAR(45) NULL,
  `isAdmin` INT DEFAULT 0,
  
  PRIMARY KEY (`idUser`));
  
  -- source pour l'horodate: https://dev.mysql.com/doc/refman/8.4/en/timestamp-initialization.html
  CREATE TABLE IF NOT EXISTS `blog`.`Article` (
  `idArticle` INT NOT NULL AUTO_INCREMENT,
  `idUser` INT NOT NULL,
  `title` VARCHAR(120) NOT NULL,
  `content` TEXT NULL,
  `createTimestamp` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updateTimestamp` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  
	PRIMARY KEY (`idArticle`),
	FOREIGN KEY (`idUser`) REFERENCES `blog`.`user` (`idUser`)
);

CREATE TABLE IF NOT EXISTS `blog`.`Category` (
  `idCategory` INT NOT NULL AUTO_INCREMENT,
  `label` VARCHAR(45) NOT NULL,
    PRIMARY KEY (`idCategory`)
);

CREATE TABLE IF NOT EXISTS `blog`.`Tag` (
  `idTag` INT NOT NULL AUTO_INCREMENT,
  `label` VARCHAR(45) NOT NULL,
    PRIMARY KEY (`idTag`)
);
    
CREATE TABLE IF NOT EXISTS `blog`.`Article_has_Category` (
	`idArticle` INT NOT NULL,
    `idCategory` INT NOT NULL,
    
    PRIMARY KEY (`idArticle`, `idCategory`),
	FOREIGN KEY (`idArticle`) REFERENCES `blog`.`Article` (`idArticle`),
	FOREIGN KEY (`idCategory`) REFERENCES `blog`.`Category` (`idCategory`)
);

CREATE TABLE IF NOT EXISTS `blog`.`Article_has_Tag` (
	`idArticle` INT NOT NULL,
    `idTag` INT NOT NULL,
    
	PRIMARY KEY (`idArticle`, `idTag`),
	FOREIGN KEY (`idArticle`) REFERENCES `blog`.`Article` (`idArticle`),
	FOREIGN KEY (`idTag`) REFERENCES `blog`.`Tag` (`idTag`)
);