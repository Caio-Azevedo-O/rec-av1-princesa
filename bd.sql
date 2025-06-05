CREATE DATABASE sistemapets;

USE sistemapets;

CREATE TABLE usuarios(
    ID INT PRIMARY KEY AUTO_INCREMENT,
    usuario TEXT,
    senha TEXT
);
CREATE TABLE clientes(
    ID INT PRIMARY KEY AUTO_INCREMENT,
    nome_cliente TEXT,
    CPF TEXT(11) UNIQUE,
    telefone TEXT(13),
    email TEXT,
    endereco TEXT
);
CREATE TABLE pets(
    ID INT PRIMARY KEY AUTO_INCREMENT,
    nome_pet TEXT,
    raca TEXT,
    idade INT,
    tipo TEXT,
    observacoes TEXT,
    foto TEXT,
    ID_cliente INT,
    FOREIGN KEY(ID_cliente) REFERENCES clientes(ID)
);