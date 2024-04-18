-- Criação da tabela "Clientes"
CREATE TABLE Clientes (
    ID INT AUTO_INCREMENT PRIMARY KEY,
    Nome VARCHAR(255),
    CPF VARCHAR(14) UNIQUE
);

-- Criação da tabela "Saldo"
CREATE TABLE Saldo (
    ID INT AUTO_INCREMENT PRIMARY KEY,
    Cliente_ID INT,
    Saldo DECIMAL(10,2),
    FOREIGN KEY (Cliente_ID) REFERENCES Clientes(ID)
);





















SELECT C.ID, C.Nome, C.CPF, S.Saldo 
FROM Clientes C
JOIN Saldo S ON C.ID = S.Cliente_ID;
