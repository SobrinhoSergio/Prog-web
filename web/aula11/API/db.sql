CREATE TABLE games (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(60) NOT NULL UNIQUE,
    genero VARCHAR(30) NOT NULL,
    ano INT NOT NULL
) ENGINE=INNODB;

INSERT INTO games (id, nome, genero, ano) VALUES
(NULL, 'Jogo 1', 'Genero 1', 2023 ),
(NULL, 'Jogo 2', 'Genero 2', 2021 ),
(NULL, 'Jogo 3', 'Genero 3', 2020 ),
(NULL, 'Jogo 4', 'Genero 4', 2019 ),
(NULL, 'Jogo 5', 'Genero 5', 2023 );

