CREATE TABLE categoria (
    id INT NOT NULL AUTO_INCREMENT,
    nome VARCHAR(60) NOT NULL,
    CONSTRAINT `pk_categoria` PRIMARY KEY( id ),
    CONSTRAINT `unq_categoria__nome` UNIQUE( nome )
) ENGINE=INNODB;

CREATE TABLE materia_prima (
    id INT NOT NULL AUTO_INCREMENT,
    descricao VARCHAR(60) NOT NULL,
	quantidade INT NOT NULL DEFAULT 0,
    custo DECIMAL(6, 2) NOT NULL,
    categoria_id INT NOT NULL,
    CONSTRAINT `pk_materia_prima` PRIMARY KEY( id ),
    CONSTRAINT `unq_materia_prima__descricao` UNIQUE( descricao ),
    CONSTRAINT `fk_materia_prima__categoria_id` FOREIGN KEY ( categoria_id )
    	REFERENCES categoria( id ) ON UPDATE CASCADE ON DELETE RESTRICT
) ENGINE=INNODB;

