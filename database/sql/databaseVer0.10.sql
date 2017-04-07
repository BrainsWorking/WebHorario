DROP DATABASE webHorario;

CREATE DATABASE IF NOT EXISTS webHorario;
USE webHorario;

-- -----------------------------------------------------
-- Table `webHorario`.`cargos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `webHorario`.`cargos` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`id`));


-- -----------------------------------------------------
-- Table `webHorario`.`funcionarios`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `webHorario`.`funcionarios` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(255) NOT NULL,
  `sexo` ENUM('M', 'F') NOT NULL,
  `cpf` VARCHAR(20) NOT NULL,
  `data_nascimento` DATE NOT NULL,
  `endereco` VARCHAR(255) NOT NULL,
  `foto` VARCHAR(255) NOT NULL,
  `email` VARCHAR(255) NOT NULL,
  `password` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`id`));


-- -----------------------------------------------------
-- Table `webHorario`.`cargos_funcionarios`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `webHorario`.`cargos_funcionarios` (
  `cargo_id` INT(11) NOT NULL,
  `funcionario_id` INT(11) NOT NULL,
  PRIMARY KEY (`cargo_id`, `funcionario_id`),
  INDEX `funcionario_id` (`funcionario_id` ASC),
  CONSTRAINT `cargos_funcionarios_ibfk_1`
    FOREIGN KEY (`cargo_id`)
    REFERENCES `webHorario`.`cargos` (`id`)
    ON DELETE RESTRICT
    ON UPDATE CASCADE,
  CONSTRAINT `cargos_funcionarios_ibfk_2`
    FOREIGN KEY (`funcionario_id`)
    REFERENCES `webHorario`.`funcionarios` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE);


-- -----------------------------------------------------
-- Table `webHorario`.`turnos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `webHorario`.`turnos` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`id`));


-- -----------------------------------------------------
-- Table `webHorario`.`cursos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `webHorario`.`cursos` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(255) NOT NULL,
  `iniciais` CHAR(5) NOT NULL,
  `turno_id` INT(11) NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `turno_id` (`turno_id` ASC),
  CONSTRAINT `cursos_ibfk_1`
    FOREIGN KEY (`turno_id`)
    REFERENCES `webHorario`.`turnos` (`id`)
    ON DELETE RESTRICT
    ON UPDATE CASCADE);


-- -----------------------------------------------------
-- Table `webHorario`.`disciplinas`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `webHorario`.`disciplinas` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(255) NOT NULL,
  `iniciais` CHAR(5) NOT NULL,
  `cargaHoraria` INT(11) NOT NULL,
  PRIMARY KEY (`id`));


-- -----------------------------------------------------
-- Table `webHorario`.`cursos_disciplinas`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `webHorario`.`cursos_disciplinas` (
  `curso_id` INT(11) NOT NULL,
  `disciplina_id` INT(11) NOT NULL,
  PRIMARY KEY (`curso_id`, `disciplina_id`),
  INDEX `disciplina_id` (`disciplina_id` ASC),
  CONSTRAINT `cursos_disciplinas_ibfk_1`
    FOREIGN KEY (`curso_id`)
    REFERENCES `webHorario`.`cursos` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `cursos_disciplinas_ibfk_2`
    FOREIGN KEY (`disciplina_id`)
    REFERENCES `webHorario`.`disciplinas` (`id`)
    ON DELETE RESTRICT
    ON UPDATE CASCADE);


-- -----------------------------------------------------
-- Table `webHorario`.`horarios`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `webHorario`.`horarios` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `inicio` TIME NOT NULL,
  `fim` TIME NOT NULL,
  PRIMARY KEY (`id`));


-- -----------------------------------------------------
-- Table `webHorario`.`instituicoes`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `webHorario`.`instituicoes` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(255) NOT NULL,
  `cnpj` VARCHAR(20) NOT NULL,
  PRIMARY KEY (`id`));


-- -----------------------------------------------------
-- Table `webHorario`.`semestres`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `webHorario`.`semestres` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(255) NOT NULL,
  `inicio` DATE NOT NULL,
  `fim` DATE NOT NULL,
  PRIMARY KEY (`id`));


-- -----------------------------------------------------
-- Table `webHorario`.`telefones`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `webHorario`.`telefones` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `numero` VARCHAR(30) NOT NULL,
  `funcionario_id` INT(11) NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `funcionario_id` (`funcionario_id` ASC),
  CONSTRAINT `telefones_ibfk_1`
    FOREIGN KEY (`funcionario_id`)
    REFERENCES `webHorario`.`funcionarios` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE);


-- -----------------------------------------------------
-- Table `webHorario`.`turnos_horarios`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `webHorario`.`turnos_horarios` (
  `turno_id` INT(11) NOT NULL,
  `horario_id` INT(11) NOT NULL,
  PRIMARY KEY (`turno_id`, `horario_id`),
  INDEX `horario_id` (`horario_id` ASC),
  CONSTRAINT `turnos_horarios_ibfk_1`
    FOREIGN KEY (`turno_id`)
    REFERENCES `webHorario`.`turnos` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `turnos_horarios_ibfk_2`
    FOREIGN KEY (`horario_id`)
    REFERENCES `webHorario`.`horarios` (`id`)
    ON DELETE RESTRICT
    ON UPDATE RESTRICT);