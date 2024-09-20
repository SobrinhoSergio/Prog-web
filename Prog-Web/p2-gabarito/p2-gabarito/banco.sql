CREATE DATABASE IF NOT EXISTS `p2` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;

CREATE TABLE autor (
  id          INT            NOT NULL AUTO_INCREMENT PRIMARY KEY,
  nome        VARCHAR(80)    NOT NULL,
  nascimento  DATE           NOT NULL
) ENGINE=INNODB;

CREATE TABLE frase (
  id          INT            NOT NULL AUTO_INCREMENT PRIMARY KEY,
  texto       VARCHAR(1000)  NOT NULL,
  nota        INT            DEFAULT 5, -- De 0 a 5
  autor_id    INT            NOT NULL,
  FOREIGN KEY (autor_id)
    REFERENCES autor(id) ON UPDATE CASCADE ON DELETE CASCADE
) ENGINE=INNODB;

-- EXTRA - dados para teste ---------------------------------------------------

INSERT INTO autor ( nome, nascimento ) VALUES
( 'Fulano',   '10-20-1990' ),
( 'Beltrano', '10-10-1980' );

INSERT INTO frase ( texto, nota, autor_id ) VALUES
( 'Primeira frase', 5, 1 ),
( 'Segunda frase',  4, 1 ),
( 'Terceira frase', 3, 2 ),
( 'Quarta frase',   5, 2 ),
( 'Quinta frase',   4, 2 );

