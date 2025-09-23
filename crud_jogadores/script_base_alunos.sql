/*
Modelo de base de dados inicial para a implementação do CRUD Jogadores
*/
CREATE DATABASE IF NOT EXISTS crud_jogadores;
USE crud_jogadores;

/* TABELA times */
CREATE TABLE IF NOT EXISTS times ( 
  id int AUTO_INCREMENT NOT NULL, 
  nome varchar(70) NOT NULL,
  estado varchar(2) NOT NULL, /* UF do estado de origem do clube */
  CONSTRAINT pk_times PRIMARY KEY (id) 
);

/* Limpa a tabela antes de inserir */
DELETE FROM times;

/* INSERTs times */
INSERT INTO times (nome, estado) VALUES ('Flamengo', 'RJ');
INSERT INTO times (nome, estado) VALUES ('Palmeiras', 'SP');
INSERT INTO times (nome, estado) VALUES ('Grêmio', 'RS');
INSERT INTO times (nome, estado) VALUES ('Bahia', 'BA');

/* TABELA jogadores */
CREATE TABLE IF NOT EXISTS jogadores (
  id int AUTO_INCREMENT NOT NULL, 
  nome varchar(70) NOT NULL, 
  idade int NOT NULL,
  estrangeiro varchar(1) NOT NULL, /* S=Sim, N=Não */
  id_time int NOT NULL, 
  CONSTRAINT pk_jogadores PRIMARY KEY (id)
);


ALTER TABLE jogadores ADD CONSTRAINT FOREIGN KEY (id_time) REFERENCES times (id);


CREATE TABLE IF NOT EXISTS posicoes (
  id INT AUTO_INCREMENT NOT NULL,
  nome VARCHAR(50) NOT NULL,
  CONSTRAINT pk_posicoes PRIMARY KEY (id)
);

-- Insira algumas posições
INSERT INTO posicoes (nome) VALUES ('Goleiro');
INSERT INTO posicoes (nome) VALUES ('Zagueiro');
INSERT INTO posicoes (nome) VALUES ('Lateral');
INSERT INTO posicoes (nome) VALUES ('Volante');
INSERT INTO posicoes (nome) VALUES ('Meio-campo');
INSERT INTO posicoes (nome) VALUES ('Ponta');
INSERT INTO posicoes (nome) VALUES ('Centroavante');

ALTER TABLE jogadores ADD COLUMN id_posicao INT NOT NULL;
ALTER TABLE jogadores ADD CONSTRAINT fk_posicao FOREIGN KEY (id_posicao) REFERENCES posicoes(id);

