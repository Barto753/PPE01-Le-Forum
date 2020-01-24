CREATE DATABASE bbd_forum
CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

USE bdd_forum;

CREATE TABLE Utilisateur(
idUser INT, 
prenom VARCHAR(64), 
pseudo VARCHAR(64), 
dateNaissance DATE, 
mail VARCHAR(64),
avatar VARCHAR(64), 
password VARCHAR(64),
bannissement TINYINT,
connexion TINYINT,
isAdmin TINYINT,
PRIMARY KEY(idUser));

CREATE TABLE Message(
idMessage INT,
texteMessage VARCHAR(64),
idUser INT,
idDiscussion INT,
PRIMARY KEY(idMessage));

CREATE TABLE Discussion(
idDiscussion INT,
nomDiscussion VARCHAR(64),
idSujet INT,
PRIMARY KEY(idDiscussion));

CREATE TABLE SujetDiscussion(
idSujet INT,
nomSujet VARCHAR(64),
PRIMARY KEY(idSujet));

ALTER TABLE Message
ADD CONSTRAINT Message_idUser
FOREIGN KEY (idUser)
REFERENCES Utilisateur(idUser);

ALTER TABLE Message
ADD CONSTRAINT Message_idDiscussion
FOREIGN KEY (idDiscussion)
REFERENCES Discussion(idDiscussion);

ALTER TABLE Discussion
ADD CONSTRAINT Discussion_idSujet
FOREIGN KEY (idSujet)
REFERENCES SujetDiscussion(idSujet);

