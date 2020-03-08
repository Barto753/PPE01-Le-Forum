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
texteMessage TEXT,
dateMessage DATE,
idUser INT,
idDiscussion INT,
PRIMARY KEY(idMessage));

CREATE TABLE IF NOT EXISTS Discussion(
idDiscussion INT AUTO_INCREMENT,
titreDiscussion VARCHAR(64),
texteDiscussion TEXT,
dateDiscussion DATE,
isClosed TINYINT,
idCategorie INT,
idUser INT,
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

ALTER TABLE Discussion
ADD CONSTRAINT Discussion_idUser
FOREIGN KEY (idUser)
REFERENCES Utilisateur(idUser);

ALTER TABLE Bannissement
ADD CONSTRAINT Bannissement_idType
FOREIGN KEY (idType)
REFERENCES TypeBannissement(idType);

ALTER TABLE Bannissement
ADD CONSTRAINT Bannissement_idUser
FOREIGN KEY (idUser)
REFERENCES Utilisateur(idUser);

INSERT INTO Utilisateur(pseudo, email, cheminAvatar, password, isAdmin, isConnected) VALUES
("Michel63", "michel63@mail.fr", "null", "1234", 0, 0),
("Hubert59", "hubert59@mail.fr", "null", "5678", 0, 0),
("Pingu", "pingu@mail.fr", "null", "AZERTY", 1, 0),
("Q63", "q63@mail.fr", "null", "WXCVBN", 1, 0);

INSERT INTO CategorieDiscussion(nomCategorie) VALUES
("CSS"),
("PHP"),
("Java");

INSERT INTO Discussion(titreDiscussion, texteDiscussion, dateDiscussion, isClosed, idCategorie, idUser) VALUES
("Colorer en bleu un texte", "Je n'arrive pas à colorer en bleu un texte en CSS.", "2014-08-11", 0, 1, 1),
("Centrer un titre", "Salut, comment on centre un titre en CSS ?", "2016-04-12", 0, 1, 2),
("Appeler une méthode static", "Comment on appelle une méthode static en PHP ?", "2017-05-22", 0, 2, 2),
("Synthaxe boucle for", "Hello, quelle est la synthaxe d'une boucle for en Java ?", "2019-11-02", 0, 3, 1);

INSERT INTO Message(texteMessage, dateMessage, idUser, idDiscussion) VALUES
("Je crois que c'est -> color:blue;", "2014-10-12", 3, 1), #Pingu rep Michel
("Salut, c'est color:blue", "2014-11-22", 2, 1), #Hubert rep Michel
("Pour centrer un texte c'est text-align:center", "2016-04-17", 1, 2), #Michel rep Hubert
("Je sais pas", "2017-03-07", 4, 2), #Q rep Hubert
("Blabla", "2017-07-23", 1, 3), #Michel rep Hubert
("Bonjour","2017-09-21", 4, 3), #Barto rep Hubert
("HELLO","2019-12-02", 2, 4), #Hubert rep Michel
("Pouet", "2020-02-18", 3, 4); #Pingu rep Michel