CREATE DATABASE databazaChorob;

USE databazaChorob;


-- Create Nemocnica table
CREATE TABLE Nemocnica (
    Nemocnica_ID INT AUTO_INCREMENT PRIMARY KEY,
    Nazov VARCHAR(50) NOT NULL,
    Stat VARCHAR(50) NOT NULL,
    Mesto VARCHAR(50) NOT NULL,
    Pocet_Lozok INT NOT NULL
);

-- Create Priznak table
CREATE TABLE Priznak (
    Priznak_ID INT  AUTO_INCREMENT  PRIMARY KEY,
    Nazov VARCHAR(50) NOT NULL,
    Popis VARCHAR(50) NOT NULL,
    Oblast VARCHAR(50) NOT NULL,
    Zavaznost VARCHAR(50) NOT NULL
);

-- Create Pacient table
CREATE TABLE Pacient (
    Pacient_ID INT AUTO_INCREMENT PRIMARY KEY,
    Rodne_cislo INT NOT NULL,
    Meno VARCHAR(50) NOT NULL,
    Priezvisko VARCHAR(50) NOT NULL,
    Datum_narodenie VARCHAR(50) NOT NULL,
    Nemocnica_ID INT,
    FOREIGN KEY (Nemocnica_ID) REFERENCES Nemocnica(Nemocnica_ID)
);

-- Create Choroba table
CREATE TABLE Choroba (
    Choroba_ID INT AUTO_INCREMENT PRIMARY KEY,
    Nazov VARCHAR(50) NOT NULL,
    Typ VARCHAR(50) NOT NULL,
    Trvanie INT NOT NULL,
    Inkubacna_doba INT NOT NULL,
    Priznak_ID INT,
    FOREIGN KEY (Priznak_ID) REFERENCES Priznak(Priznak_ID)
);

-- Create Choroba_Pacient junction table
CREATE TABLE Choroba_Pacient (
    Choroba_ID INT,
    Pacient_ID INT,
    PRIMARY KEY (Choroba_ID, Pacient_ID),
    FOREIGN KEY (Choroba_ID) REFERENCES Choroba(Choroba_ID),
    FOREIGN KEY (Pacient_ID) REFERENCES Pacient(Pacient_ID)
);


INSERT INTO Nemocnica ( Nazov, Stat, Mesto, Pocet_Lozok)
VALUES ( 'Nemocnica Bratislava', 'Slovensko', 'Bratislava', 500),
       ('Nemocnica Kosice', 'Slovensko', 'Kosice', 300),
       ('Nemocnica Zilina', 'Slovensko', 'Zilina', 200);

INSERT INTO Priznak ( Nazov, Popis, Oblast, Zavaznost)
VALUES ('Horucka', 'Teplota tela vyssia ako 38°C', 'Telesny', 'Vysoka'),
       ( 'Kasel', 'Suchy alebo mokry kasel', 'Dychaci', 'Stredna'),
       ( 'Bolest hrdla', 'Bolest alebo neprijemne pocity v hrdle', 'Dychaci', 'Nizka');

INSERT INTO Pacient ( Rodne_cislo, Meno, Priezvisko, Datum_narodenie, Nemocnica_ID)
VALUES ( 950215/1234, 'Peter', 'Novak', '1995-02-15', 2),
       ( 880512/5678, 'Anna', 'Hrivnakova', '1988-05-12', 2),
       ( 910320/9876, 'Jozef', 'Sekeres', '1991-03-20', 1);

INSERT INTO Choroba ( Nazov, Typ, Trvanie, Inkubacna_doba, Priznak_ID)
VALUES ( 'Chrípka', 'Virova', 7, 2, 1),
       ('Angina', 'Bakterialna', 10, 3, 1),
       ( 'Bronchitida', 'Virova', 14, 5, 2);

INSERT INTO Choroba_Pacient (Choroba_ID, Pacient_ID)
VALUES (1, 1),
       (2, 2),
       (3, 3);