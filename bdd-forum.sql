DROP DATABASE IF EXISTS bdd_forum;

CREATE DATABASE IF NOT EXISTS bdd_forum
CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

USE bdd_forum;

CREATE TABLE IF NOT EXISTS TypeBannissement(
idType INT,
libelle VARCHAR(64),
PRIMARY KEY (idType));

CREATE TABLE IF NOT EXISTS Bannissement(
idBannissement INT,
dateDebut DATE,
dateFin DATE,
idType INT,
idUser INT,
PRIMARY KEY(idBannissement));

CREATE TABLE IF NOT EXISTS Utilisateur(
idUser INT AUTO_INCREMENT,  
pseudo VARCHAR(64),  
email VARCHAR(64),
cheminAvatar VARCHAR(64), 
password VARCHAR(64),
isAdmin TINYINT,
isConnected TINYINT,
PRIMARY KEY(idUser));

CREATE TABLE IF NOT EXISTS Message(
idMessage INT AUTO_INCREMENT,
texteMessage VARCHAR(64),
datePublication DATE,
idUser INT,
idDiscussion INT,
PRIMARY KEY(idMessage));

CREATE TABLE IF NOT EXISTS Discussion(
idDiscussion INT AUTO_INCREMENT,
titreDiscussion VARCHAR(64),
isClosed TINYINT,
idCategorie INT,
PRIMARY KEY(idDiscussion));

CREATE TABLE IF NOT EXISTS CategorieDiscussion(
idCategorie INT AUTO_INCREMENT,
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
ADD CONSTRAINT Discussion_idCategorie
FOREIGN KEY (idCategorie)
REFERENCES CategorieDiscussion(idCategorie);

ALTER TABLE Bannissement
ADD CONSTRAINT Bannissement_idType
FOREIGN KEY (idType)
REFERENCES TypeBannissement(idType);

ALTER TABLE Bannissement
ADD CONSTRAINT Bannissement_idUser
FOREIGN KEY (idUser)
REFERENCES Utilisateur(idUser);

