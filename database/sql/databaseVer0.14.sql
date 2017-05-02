DROP DATABASE IF EXISTS nexvf4wcb2h7psvd;
CREATE DATABASE nexvf4wcb2h7psvd DEFAULT CHARACTER SET utf8 DEFAULT COLLATE utf8_general_ci;
USE nexvf4wcb2h7psvd;

CREATE TABLE instituicoes(
	id INT NOT NULL AUTO_INCREMENT,
	nome VARCHAR(255) NOT NULL,
	cep CHAR(9) NOT NULL,
	endereco VARCHAR(255) NOT NULL,
	telefone VARCHAR(20) NOT NULL,
	CONSTRAINT PRIMARY KEY(id)
);

CREATE TABLE cargos(
	id INT NOT NULL AUTO_INCREMENT,
	nome VARCHAR(255) NOT NULL,
	sigla VARCHAR(6),
	CONSTRAINT PRIMARY KEY(id)
);

CREATE TABLE funcionarios(
	id INT NOT NULL AUTO_INCREMENT,
	nome VARCHAR(255) NOT NULL,
	sexo ENUM('M', 'F', 'I') NOT NULL,
	cpf CHAR(11) NOT NULL UNIQUE,
	rg CHAR(9),
	data_nascimento DATE NOT NULL,
	endereco VARCHAR(255) NOT NULL,
	foto VARCHAR(255),
	prontuario VARCHAR(255) NOT NULL UNIQUE,
	email VARCHAR(255) NOT NULL UNIQUE,
	`password` VARCHAR(255) NOT NULL,
	remember_token CHAR(100),	
	deleted_at TIMESTAMP NULL,
	CONSTRAINT PRIMARY KEY(id)
);

CREATE TABLE telefones(
	id INT NOT NULL AUTO_INCREMENT,
	numero VARCHAR(16) NOT NULL,
	funcionario_id INT NOT NULL,
	CONSTRAINT PRIMARY KEY(id),
	CONSTRAINT FOREIGN KEY(funcionario_id)
	REFERENCES funcionarios(id)
	ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE cargos_funcionarios(
	cargo_id INT NOT NULL,
	funcionario_id INT NOT NULL,
	CONSTRAINT PRIMARY KEY(cargo_id, funcionario_id),
	CONSTRAINT FOREIGN KEY(cargo_id)
	REFERENCES cargos(id)
	ON DELETE RESTRICT ON UPDATE CASCADE,
	CONSTRAINT FOREIGN KEY(funcionario_id)
	REFERENCES funcionarios(id)
	ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE turnos(
	id INT NOT NULL AUTO_INCREMENT,
	nome VARCHAR(255) NOT NULL,
	CONSTRAINT PRIMARY KEY(id)
);

CREATE TABLE horarios(
	id INT NOT NULL AUTO_INCREMENT,
	inicio TIME NOT NULL,
	fim TIME NOT NULL,
	CONSTRAINT PRIMARY KEY(id)
);

CREATE TABLE turnos_horarios(
	turno_id INT NOT NULL,
	horario_id INT NOT NULL,
	CONSTRAINT PRIMARY KEY(turno_id, horario_id),
	CONSTRAINT FOREIGN KEY(turno_id)
	REFERENCES turnos(id)
	ON DELETE CASCADE ON UPDATE CASCADE,
	CONSTRAINT FOREIGN KEY(horario_id)
	REFERENCES horarios(id)
	ON DELETE RESTRICT ON UPDATE RESTRICT
);

CREATE TABLE cursos(
	id INT NOT NULL AUTO_INCREMENT,
	nome VARCHAR(255) NOT NULL,
	sigla CHAR(5) NOT NULL UNIQUE,
	turno_id INT NOT NULL,
	funcionario_id INT,
	CONSTRAINT PRIMARY KEY(id),
	CONSTRAINT FOREIGN KEY(turno_id)
	REFERENCES turnos(id)
	ON DELETE RESTRICT ON UPDATE CASCADE,
	CONSTRAINT FOREIGN KEY(funcionario_id)
	REFERENCES funcionarios(id)
	ON DELETE RESTRICT ON UPDATE CASCADE
);

CREATE TABLE disciplinas(
	id INT NOT NULL AUTO_INCREMENT,
	nome VARCHAR(255) NOT NULL,
	sigla CHAR(5) NOT NULL UNIQUE,
	aulasSemanais INT NOT NULL,
	CONSTRAINT PRIMARY KEY(id)
);

CREATE TABLE tiposSala(
	id INT NOT NULL AUTO_INCREMENT,
	nome VARCHAR(255) NOT NULL,
	descricao VARCHAR(255) NOT NULL,
	CONSTRAINT PRIMARY KEY(id)
);

CREATE TABLE disciplinas_tiposSala(
	disciplina_id INT NOT NULL,
	tipoSala_id INT NOT NULL,
	CONSTRAINT PRIMARY KEY(disciplina_id, tipoSala_id),
	CONSTRAINT FOREIGN KEY(disciplina_id)
	REFERENCES disciplinas(id)
	ON DELETE RESTRICT ON UPDATE CASCADE,
	CONSTRAINT FOREIGN KEY(tipoSala_id)
	REFERENCES tiposSala(id)
	ON DELETE RESTRICT ON UPDATE CASCADE
);

CREATE TABLE semestres(
	id INT NOT NULL AUTO_INCREMENT,
	nome VARCHAR(255) NOT NULL,
	inicio DATE NOT NULL,
	fim DATE NOT NULL,
	fpaInicio DATE NOT NULL,
	fpaFim DATE NOT NULL,
	CONSTRAINT PRIMARY KEY(id)
);

CREATE TABLE cursos_disciplinas(
	curso_id INT NOT NULL,
	disciplina_id INT NOT NULL,
	CONSTRAINT PRIMARY KEY(curso_id, disciplina_id),
	CONSTRAINT FOREIGN KEY(curso_id)
	REFERENCES cursos(id)
	ON DELETE CASCADE ON UPDATE CASCADE,
	CONSTRAINT FOREIGN KEY(disciplina_id)
	REFERENCES disciplinas(id)
	ON DELETE RESTRICT ON UPDATE CASCADE
);

CREATE TABLE disciplinas_semestres(
	semestre_id INT NOT NULL,
	disciplina_id INT NOT NULL,
	CONSTRAINT PRIMARY KEY(semestre_id, disciplina_id),
	CONSTRAINT FOREIGN KEY(semestre_id)
	REFERENCES semestres(id)
	ON DELETE CASCADE ON UPDATE CASCADE,
	CONSTRAINT FOREIGN KEY(disciplina_id)
	REFERENCES disciplinas(id)
	ON DELETE RESTRICT ON UPDATE CASCADE
);

CREATE TABLE fpas(
	id INT NOT NULL AUTO_INCREMENT,
	horario_id INT NOT NULL,
	semestre_id INT NOT NULL,
	disciplina_id INT NOT NULL,
	funcionario_id INT NOT NULL, 
	diaSemana ENUM ('SEG', 'TER', 'QUA', 'QUI', 'SEX', 'SAB'),
	CONSTRAINT PRIMARY KEY (id),
	CONSTRAINT FOREIGN KEY (horario_id)
	REFERENCES horarios(id)
	ON DELETE CASCADE ON UPDATE CASCADE,
	CONSTRAINT FOREIGN KEY(semestre_id)
	REFERENCES semestres(id)
	ON DELETE CASCADE ON UPDATE CASCADE,
	CONSTRAINT FOREIGN KEY(disciplina_id)
	REFERENCES disciplinas(id)
	ON DELETE RESTRICT ON UPDATE CASCADE,
	CONSTRAINT FOREIGN KEY(funcionario_id)
	REFERENCES funcionarios(id)
	ON DELETE RESTRICT ON UPDATE CASCADE

);


START TRANSACTION;
# FUNCIONARIOS
INSERT INTO `funcionarios` (`id`, `nome`, `sexo`, `cpf`, `data_nascimento`, `endereco`, `foto`, `prontuario`, `email`, `password`, `rg`) VALUES 
(1, 'Fulano'  , 'M', '11111111111', '1990-09-12', 'Em casa', 'null.jpg', '1501111', 'fulano@webhorario.com'  , '$2y$10$8bhPBEPB4mwGOvE.GLC7cOj8xKC7VgTBM43JgcfcF9oYJzX8lUQuS', '111111111'),
(2, 'Ciclana' , 'F', '22222222222', '1990-09-12', 'Em casa', 'null.jpg', '1502222', 'ciclano@webhorario.com' , '$2y$10$8bhPBEPB4mwGOvE.GLC7cOj8xKC7VgTBM43JgcfcF9oYJzX8lUQuS', '222222222'),
(3, 'Beltrano', 'M', '33333333333', '1990-09-12', 'Em casa', 'null.jpg', '1503333', 'beltrano@webhorario.com', '$2y$10$8bhPBEPB4mwGOvE.GLC7cOj8xKC7VgTBM43JgcfcF9oYJzX8lUQuS', '333333333');

# TELEFONES DOS FUNCIONARIOS
INSERT INTO `telefones` (`id`, `numero`, `funcionario_id`) VALUES
(1, '1112345678' , 1),
(2, '12912345678', 1),
(3, '12998743210', 2),
(4, '1236698745' , 3);

# CARGOS
INSERT INTO `cargos` (`id`, `nome`, `sigla`) VALUES 
(1, 'Professor', null),
(2, 'Diretor Educacional', 'DAE'),
(3, 'Secretaria', 'CRA');

# CARGOS DOS FUNCIONARIOS
INSERT INTO `cargos_funcionarios` (`funcionario_id`, `cargo_id`) VALUES 
(1, 1), (1, 2),
(2, 2),
(3, 1);

#SEMESTRES
INSERT INTO `semestres` (`id`, `nome`, `inicio`, `fim`, `fpaInicio`, `fpaFim`) VALUES
(1, '2017-1','2017-01-01', '2017-06-20', '2016-10-15', '2016-12-24'),
(2, '2017-2','2017-07-01', '2017-12-24', '2017-05-15', '2017-06-28');

# TURNOS
INSERT INTO `turnos` (`id`, `nome`) VALUES
(1, 'Matutino'),
(2, 'Vespertino'),
(3, 'Noturno'),
(4, 'Integral');

# CURSOS
INSERT INTO `cursos` (`id`, `nome`, `sigla`, `turno_id`, `funcionario_id`) VALUES
(1, 'Física', 'FIS', 1, 1),
(2, 'Informática para Internet', 'WEB', 2, null),
(3, 'Análise e Desenvolvimento de Sistemas', 'ADS', 3, 2),
(4, 'Informática Integrado ao Ensino Médio', 'INF', 4, 3);

# DISCIPLINAS
INSERT INTO `disciplinas` (`id`, `nome`, `sigla`, `aulasSemanais`) VALUES
( 1, 'Lógica'        , 'LOG', 2),
( 2, 'Física'        , 'FIS', 4),
( 3, 'Matemática'    , 'MAT', 2),
( 4, 'Web'           , 'WEB', 2),
( 5, 'Projeto'       , 'PRJ', 4),
( 6, 'Estatística'   , 'EST', 2),
( 7, 'Geometria'     , 'GEO', 4),
( 8, 'História'      , 'HIS', 2),
( 9, 'Termodinâmica' , 'TRM', 4),
(10, 'Banco de Dados', 'BDD', 2);


# DISCIPLINAS DO SEMESTRE
INSERT INTO `disciplinas_semestres` (`semestre_id`, `disciplina_id`) VALUES
(1,1), (1,2), (1,3), (1,4), (1, 5), (1,6), (1,7),
(2,8), (2,9), (2,4), (2,7), (2,10);

# HORARIOS
INSERT INTO `horarios` (`id`, `inicio`, `fim`) VALUES
( 1, '06:00', '07:00'),
( 2, '07:00', '08:00'),
( 3, '08:00', '09:00'),
( 4, '09:00', '10:00'),
( 5, '13:00', '14:00'),
( 6, '14:00', '15:00'),
( 7, '15:00', '16:00'),
( 8, '16:00', '17:00'),
( 9, '19:00', '20:00'),
(10, '20:00', '21:00'),
(11, '21:00', '22:00'),
(12, '22:00', '23:00');

# HORÁRIOS DO TURNO
INSERT INTO `turnos_horarios` (`turno_id`, `horario_id`) VALUES
( 1,  1),
( 1,  2),
( 1,  3),
( 1,  4),
( 2,  5),
( 2,  6),
( 2,  7),
( 2,  8),
( 3,  9),
( 3, 10),
( 3, 11),
( 3, 12),
( 4,  1),
( 4,  2),
( 4,  3),
( 4,  4),
( 4,  5),
( 4,  6),
( 4,  7),
( 4,  8),
( 4,  9);
COMMIT;
