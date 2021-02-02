CREATE TABLE usuario(
  id_usuario INT NOT NULL AUTO_INCREMENT,
  nome VARCHAR(100) NOT NULL,
  email VARCHAR(150) NOT NULL,
  senha VARCHAR(150) NOT NULL,
  status BOOLEAN NOT NULL DEFAULT true,
  cadastro TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (id_usuario)
);


CREATE TABLE token(
    id_token INT NOT NULL AUTO_INCREMENT,
    id_usuario INT NOT NULL,
    token TEXT NOT NULL,
    ip VARCHAR(100) NOT NULL,
    data_expira TIMESTAMP NOT NULL,
    data TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id_token),
    FOREIGN KEY (id_usuario) REFERENCES usuario(id_usuario)
);


CREATE TABLE categoria(
    id_categoria INT NOT NULL AUTO_INCREMENT,
    nome VARCHAR(150) NOT NULL,
    PRIMARY KEY (id_categoria)
);


CREATE TABLE atuacao (
    id_atuacao INT NOT NULL AUTO_INCREMENT,
    nome VARCHAR(150) NOT NULL,
    PRIMARY KEY (id_atuacao)
);

CREATE TABLE etnia (
    id_etnia INT NOT NULL AUTO_INCREMENT,
    nome VARCHAR(150) NOT NULL,
    PRIMARY KEY (id_etnia)
);


CREATE TABLE fornecedor (
    id_fornecedor INT NOT NULL AUTO_INCREMENT,
    id_categoria INT NOT NULL,
    observacao TEXT NULL DEFAULT NULL,
    telefone TEXT NULL DEFAULT NULL,
    cidade VARCHAR(150) NULL DEFAULT NULL,
    email VARCHAR(150) NULL DEFAULT NULL,
    PRIMARY KEY (id_fornecedor),
    FOREIGN KEY (id_categoria) REFERENCES categoria(id_categoria)
);


CREATE TABLE modelo(
    id_modelo INT NOT NULL AUTO_INCREMENT,
    id_atuacao INT NOT NULL,
    id_etnia INT NOT NULL,
    nome VARCHAR(150) NOT NULL,
    cpf VARCHAR(100) NULL DEFAULT NULL,
    dataNascimento DATE NOT NULL,
    sexo ENUM('masculino', 'feminino') NOT NULL,
    manequim VARCHAR(50) NULL DEFAULT NULL,
    altura VARCHAR(50) NULL DEFAULT NULL,
    calcado VARCHAR(50) NULL DEFAULT NULL,
    telefone TEXT NULL DEFAULT NULL,
    estado VARCHAR(3) NOT NULL,
    cidade VARCHAR(150) NOT NULL,
    PRIMARY KEY (id_modelo),
    FOREIGN KEY (id_atuacao) REFERENCES atuacao(id_atuacao),
    FOREIGN KEY (id_etnia) REFERENCES etnia(id_etnia)
);

CREATE TABLE foto(
    id_foto INT NOT NULL AUTO_INCREMENT,
    id_modelo INT NOT NULL,
    imagem VARCHAR(150) NOT NULL,
    PRIMARY KEY (id_foto),
    FOREIGN KEY (id_modelo) REFERENCES modelo (id_modelo)
);
