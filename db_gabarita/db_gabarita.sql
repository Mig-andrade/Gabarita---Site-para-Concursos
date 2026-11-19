
CREATE DATABASE db_gabarita;
USE db_gabarita;

CREATE TABLE tb_questoes (
  `id` int NOT NULL AUTO_INCREMENT,
  `materia` varchar(100) NOT NULL,
  `banca` varchar(100) NOT NULL,
  `dificuldade` varchar(20) NOT NULL,
  `ano` int NOT NULL,
  `enunciado` text NOT NULL,
  `alt_a` text NOT NULL,
  `alt_b` text NOT NULL,
  `alt_c` text NOT NULL,
  `alt_d` text NOT NULL,
  `alt_correta` char(1) NOT NULL,
  PRIMARY KEY (`id`)
);

INSERT INTO `tb_questoes` (`id`, `materia`, `banca`, `dificuldade`, `ano`, `enunciado`, `alt_a`, `alt_b`, `alt_c`, `alt_d`, `alt_correta`) VALUES
	(1, 'Direito Constitucional', 'FGV', 'Média', 2025, 'Quem é o chefe supremo das Forças Armadas no Brasil, segundo a CF/88?', 'O Ministro da Defesa', 'O Presidente da República', 'O Comandante do Exército', 'O Presidente do Senado', 'B'),
	(2, 'Direito Constitucional', 'FGV', 'Média', 2025, 'Qual o remédio constitucional cabível para garantir o conhecimento de informações relativas à pessoa do impetrante, constantes de registros de entidades governamentais?', 'Mandado de Segurança', 'Habeas Corpus', 'Mandado de Injunção', 'Habeas Data', 'D'),
	(3, 'Raciocínio Lógico', 'Cebraspe', 'Fácil', 2023, 'Se a proposição "Nenhum cientista é preguiçoso" for verdadeira, qual das seguintes afirmações é necessariamente correta?', 'Todos os preguiçosos são cientistas', 'Se João é preguiçoso, ele não é cientista', 'Alguns cientistas são preguiçosos', 'Todo cientista é determinado', 'B'),
	(4, 'Direito Administrativo', 'Cebraspe', 'Difícil', 2024, 'O atributo do ato administrativo que impõe a obrigação de submissão do administrado, independentemente de sua concordância, é a:', 'Presunção de legitimidade', 'Imperatividade', 'Autoexecutoriedade', 'Tipicidade', 'B'),
	(5, 'Língua Portuguesa', 'FGV', 'Fácil', 2024, 'Assinale a alternativa em que a palavra tenha sido acentuada seguindo a mesma regra de "público":', 'Café', 'História', 'Mágico', 'Também', 'C');

CREATE TABLE tb_usuarios (
  `id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(100) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `nome` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
);

INSERT INTO `tb_usuarios` (`id`, `email`, `senha`, `nome`) VALUES
	(2, 'miguelzito2020@gmail.com', '$2y$10$F4bJuK6JQfocJWhgGSbguevXSH9hrJTKGhs65PWzocVcGlDJwVeWm', NULL),
	(3, 'nathan@gmail.com', '$2y$10$SyP96SXa1vvTOVgatQc72eXBZNKlWzIM0XDakyNcdNpBSQIRawtsS', NULL);

