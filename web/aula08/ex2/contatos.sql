CREATE TABLE contato (
    id INT NOT NULL AUTO_INCREMENT,
    nome VARCHAR(100) NOT NULL,
    telefone CHAR(10) NOT NULL,
    CONSTRAINT pk_contato PRIMARY KEY( id )
) ENGINE=INNODB;

INSERT INTO contato ( id, nome, telefone ) VALUES
( NULL, 'Ana',    '993949384' ),
( NULL, 'Bia',    '988847374' ),
( NULL, 'Carla',  '977777777' ),
( NULL, 'Cosme',  '988888888' ),
( NULL, 'Darlan', '988889999' ),
( NULL, 'Diego',  '987777777' );