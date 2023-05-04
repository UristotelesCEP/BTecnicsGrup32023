-- MySQL Workbench Forward Engineeringg

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema 112_2023
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema 112_2023
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `112_2023` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_as_cs ;
USE `112_2023` ;

-- -----------------------------------------------------
-- Table `112_2023`.`tipus_incidents`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `112_2023`.`tipus_incidents` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nom` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `nom_UNIQUE` (`nom` ASC) VISIBLE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `112_2023`.`incidents`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `112_2023`.`incidents` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `codi` VARCHAR(45) NOT NULL,
  `nom` VARCHAR(256) NOT NULL,
  `definicio` VARCHAR(256) NULL,
  `instruccions` VARCHAR(256) NULL,
  `tipus_incidents_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_incidents_tipus_incidents_idx` (`tipus_incidents_id` ASC) VISIBLE,
  UNIQUE INDEX `codi_UNIQUE` (`codi` ASC) VISIBLE,
  CONSTRAINT `fk_incidents_tipus_incidents`
    FOREIGN KEY (`tipus_incidents_id`)
    REFERENCES `112_2023`.`tipus_incidents` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `112_2023`.`provincies`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `112_2023`.`provincies` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nom` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `nom_UNIQUE` (`nom` ASC) VISIBLE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `112_2023`.`comarques`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `112_2023`.`comarques` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nom` VARCHAR(45) NOT NULL,
  `provincies_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_comarques_provincies1_idx` (`provincies_id` ASC) VISIBLE,
  CONSTRAINT `fk_comarques_provincies1`
    FOREIGN KEY (`provincies_id`)
    REFERENCES `112_2023`.`provincies` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `112_2023`.`municipis`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `112_2023`.`municipis` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nom` VARCHAR(45) NOT NULL,
  `comarques_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_municipis_comarques1_idx` (`comarques_id` ASC) VISIBLE,
  CONSTRAINT `fk_municipis_comarques1`
    FOREIGN KEY (`comarques_id`)
    REFERENCES `112_2023`.`comarques` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `112_2023`.`tipus_usuaris`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `112_2023`.`tipus_usuaris` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nom` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `nom_UNIQUE` (`nom` ASC) VISIBLE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `112_2023`.`usuaris`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `112_2023`.`usuaris` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `username` VARCHAR(45) NOT NULL,
  `contrasenya` VARCHAR(256) NOT NULL,
  `nom` VARCHAR(45) NOT NULL,
  `cognoms` VARCHAR(45) NOT NULL,
  `tipus_usuaris_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `username_UNIQUE` (`username` ASC) VISIBLE,
  INDEX `fk_usuaris_tipus_usuaris1_idx` (`tipus_usuaris_id` ASC) VISIBLE,
  CONSTRAINT `fk_usuaris_t.nipus_usuaris1`
    FOREIGN KEY (`tipus_usuaris_id`)
    REFERENCES `112_2023`.`tipus_usuaris` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `112_2023`.`interlocutors`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `112_2023`.`interlocutors` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `telefon` VARCHAR(45) NOT NULL,
  `antecedents` VARCHAR(256) NULL,
  `nom` VARCHAR(45) NULL,
  `cognoms` VARCHAR(45) NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `telefon_UNIQUE` (`telefon` ASC) VISIBLE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `112_2023`.`tipus_localitzacions`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `112_2023`.`tipus_localitzacions` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nom` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `nom_UNIQUE` (`nom` ASC) VISIBLE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `112_2023`.`estat_expedients`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `112_2023`.`estat_expedients` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `estat` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `estat_UNIQUE` (`estat` ASC) VISIBLE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `112_2023`.`expedients`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `112_2023`.`expedients` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `codi` VARCHAR(45) NOT NULL,
  `estat_expedients_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `codi_UNIQUE` (`codi` ASC) VISIBLE,
  INDEX `fk_expedients_estat_expedients1_idx` (`estat_expedients_id` ASC) VISIBLE,
  CONSTRAINT `fk_expedients_estat_expedients1`
    FOREIGN KEY (`estat_expedients_id`)
    REFERENCES `112_2023`.`estat_expedients` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `112_2023`.`cartes_trucades`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `112_2023`.`cartes_trucades` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `codi_trucada` VARCHAR(45) NOT NULL,
  `data_hora_trucada` DATETIME NOT NULL,
  `durada` INT NOT NULL,
  `interlocutors_id` INT NULL,
  `telefon` VARCHAR(45) NULL,
  `nom` VARCHAR(45) NULL,
  `cognoms` VARCHAR(45) NULL,
  `nota_comuna` TEXT NOT NULL,
  `tipus_localitzacions_id` INT NOT NULL,
  `decripcio_localitzacio` VARCHAR(256) NULL,
  `detall_localitzacio` VARCHAR(256) NULL,
  `altres_ref_localitzacio` VARCHAR(256) NULL,
  `municipis_id` INT NULL,
  `provincies_id` INT NULL,
  `incidents_id` INT NOT NULL,
  `expedients_id` INT NOT NULL,
  `usuaris_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `codi_trucada_UNIQUE` (`codi_trucada` ASC) VISIBLE,
  INDEX `fk_cartes_trucades_tipus_localitzacions1_idx` (`tipus_localitzacions_id` ASC) VISIBLE,
  INDEX `fk_cartes_trucades_municipis1_idx` (`municipis_id` ASC) VISIBLE,
  INDEX `fk_cartes_trucades_provincies1_idx` (`provincies_id` ASC) VISIBLE,
  INDEX `fk_cartes_trucades_incidents1_idx` (`incidents_id` ASC) VISIBLE,
  INDEX `fk_cartes_trucades_expedients1_idx` (`expedients_id` ASC) VISIBLE,
  INDEX `fk_cartes_trucades_usuaris1_idx` (`usuaris_id` ASC) VISIBLE,
  INDEX `fk_cartes_trucades_interlocutors1_idx` (`interlocutors_id` ASC) VISIBLE,
  CONSTRAINT `fk_cartes_trucades_tipus_localitzacions1`
    FOREIGN KEY (`tipus_localitzacions_id`)
    REFERENCES `112_2023`.`tipus_localitzacions` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_cartes_trucades_municipis1`
    FOREIGN KEY (`municipis_id`)
    REFERENCES `112_2023`.`municipis` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_cartes_trucades_provincies1`
    FOREIGN KEY (`provincies_id`)
    REFERENCES `112_2023`.`provincies` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_cartes_trucades_incidents1`
    FOREIGN KEY (`incidents_id`)
    REFERENCES `112_2023`.`incidents` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_cartes_trucades_expedients1`
    FOREIGN KEY (`expedients_id`)
    REFERENCES `112_2023`.`expedients` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_cartes_trucades_usuaris1`
    FOREIGN KEY (`usuaris_id`)
    REFERENCES `112_2023`.`usuaris` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_cartes_trucades_interlocutors1`
    FOREIGN KEY (`interlocutors_id`)
    REFERENCES `112_2023`.`interlocutors` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `112_2023`.`agencies`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `112_2023`.`agencies` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nom` VARCHAR(256) NOT NULL,
  `carrer` VARCHAR(256) NULL,
  `codi_postal` VARCHAR(45) NULL,
  `correu` VARCHAR(45) NULL,
  `municipis_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_agencies_municipis1_idx` (`municipis_id` ASC) VISIBLE,
  CONSTRAINT `fk_agencies_municipis1`
    FOREIGN KEY (`municipis_id`)
    REFERENCES `112_2023`.`municipis` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `112_2023`.`estat_agencies`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `112_2023`.`estat_agencies` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `estat` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `estat_UNIQUE` (`estat` ASC) VISIBLE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `112_2023`.`cartes_trucades_has_agencies`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `112_2023`.`cartes_trucades_has_agencies` (
  `cartes_trucades_id` INT NOT NULL,
  `agencies_id` INT NOT NULL,
  `estat_agencies_id` INT NOT NULL,
  PRIMARY KEY (`cartes_trucades_id`, `agencies_id`),
  INDEX `fk_cartes_trucades_has_agencies_agencies1_idx` (`agencies_id` ASC) VISIBLE,
  INDEX `fk_cartes_trucades_has_agencies_cartes_trucades1_idx` (`cartes_trucades_id` ASC) VISIBLE,
  INDEX `fk_cartes_trucades_has_agencies_estat_agencies1_idx` (`estat_agencies_id` ASC) VISIBLE,
  CONSTRAINT `fk_cartes_trucades_has_agencies_cartes_trucades1`
    FOREIGN KEY (`cartes_trucades_id`)
    REFERENCES `112_2023`.`cartes_trucades` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_cartes_trucades_has_agencies_agencies1`
    FOREIGN KEY (`agencies_id`)
    REFERENCES `112_2023`.`agencies` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_cartes_trucades_has_agencies_estat_agencies1`
    FOREIGN KEY (`estat_agencies_id`)
    REFERENCES `112_2023`.`estat_agencies` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;


INSERT INTO usuaris (username, contrasenya, nom, cognoms, tipus_usuaris_id)
VALUES
('usuari1', 'a', 'Nom1', 'Cognom1', 1),
('usuari2', 'a', 'Nom2', 'Cognom2', 2),
('usuari3', 'a', 'Nom3', 'Cognom3', 3),
('pol12', 'a', 'pol', 'sanchez', 3),
('marc12', 'a', 'marc', 'sanchez', 3),
('joan12', 'a', 'joan', 'marli', 3),
('martina12', 'a', 'martina', 'marlo', 3),
('joana12', 'a', 'joana', 'gomez', 3),
('polici12', 'a', 'polici', 'gomez', 3);


INSERT INTO `tipus_usuaris` VALUES (3,'Administrador Sistema'),(1,'Operador 112'),(2,'Supervisor 112');
