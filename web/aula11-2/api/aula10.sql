CREATE TABLE game (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(60) NOT NULL UNIQUE,
    genero VARCHAR(30) NOT NULL, -- TO-DO: normalizar :)
    ano INT NOT NULL
) ENGINE=INNODB;

CREATE TABLE autor (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(60) NOT NULL,
    nascimento DATE NOT NULL,
) ENGINE=INNODB;

CREATE TABLE frase (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    texto VARCHAR(1000) NOT NULL,
    nota int DEFAULT 5,
    autor_id int not null,
    foreign key (autor_id) references autor (id) on update cascade on delete cascade
) ENGINE=INNODB;



INSERT INTO game ( id, nome, genero, ano ) VALUES
( NULL, 'Baldur\'s Gate 3', 'RPG',      2023 ),
( NULL, 'Cyber Punk 2077',  'RPG',      2021 ),
( NULL, 'GTA 6 Beta',       'Ação',     2024 ),
( NULL, 'Zelda: TODK',      'Aventura', 2023 ),
( NULL, 'Alan Wake 2',      'Terror',   2023 );


