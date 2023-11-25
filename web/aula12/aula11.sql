CREATE TABLE cliente (
    id    INT          NOT NULL AUTO_INCREMENT PRIMARY KEY,
    nome  VARCHAR(100) NOT NULL,
    saldo DECIMAL(7,2) NOT NULL
) ENGINE=INNODB;

CREATE TABLE movimentacao_saldo (
    id         INT          NOT NULL AUTO_INCREMENT PRIMARY KEY,
    momento    DATETIME     DEFAULT NOW(),
    tipo       CHAR(1)      NOT NULL, -- 'C'=Crédito, 'D'=Débito
    valor      DECIMAL(7,2) NOT NULL,
    origem_id  INT          NOT NULL,
    destino_id INT          NOT NULL,
    CONSTRAINT fk_origem_id
    	FOREIGN KEY ( origem_id ) REFERENCES cliente( id )
        ON UPDATE CASCADE ON DELETE CASCADE,
    CONSTRAINT fk_destino_id
    	FOREIGN KEY ( destino_id ) REFERENCES cliente( id )
        ON UPDATE CASCADE ON DELETE CASCADE
) ENGINE=INNODB;

INSERT INTO cliente ( id, nome, saldo ) VALUES
( NULL, 'Braian',         5000 ),
( NULL, 'Maria Eduarda', 10000 ),
( NULL, 'Bruna',          7500 ),
( NULL, 'Conrado',         800 ),
( NULL, 'Rian',          50000 );