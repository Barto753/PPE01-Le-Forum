CREATE DATABASE bbd_forum
CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

USE bdd_forum;

CREATE TABLE Utilisateur(
idUser INT AUTO_INCREMENT,  
pseudo VARCHAR(64),  
email VARCHAR(64),
cheminAvatar VARCHAR(64), 
password VARCHAR(64),
isAdmin TINYINT,
isConnected TINYINT,
PRIMARY KEY(idUser));

CREATE TABLE Bannissement_Utilisateur


CREATE TABLE Bannissement(
idBannissement INT,
typeBannissement VARCHAR(64),
dateDebut DATE,
dateFin DATE,
PRIMARY KEY(idBannissement));

CREATE TABLE Message(
idMessage INT,
texteMessage VARCHAR(64),
idUser INT,
idDiscussion INT,
PRIMARY KEY(idMessage));

CREATE TABLE Discussion(
idDiscussion INT,
titreDiscussion VARCHAR(64),
isBloque TINYINT,
idSujet INT,
PRIMARY KEY(idDiscussion));

CREATE TABLE CategorieDiscussion(
idCategorie INT,
nomCategorie VARCHAR(64),
PRIMARY KEY(idCategorie));



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

