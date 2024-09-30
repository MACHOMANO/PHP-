create database if not exists atv_dupla2;

USE atv_dupla2;

CREATE TABLE notas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(255) NOT NULL,
    conteudo TEXT NOT NULL,
    data_criacao DATE NOT NULL,
    data_modificacao DATE NOT NULL
    
);
