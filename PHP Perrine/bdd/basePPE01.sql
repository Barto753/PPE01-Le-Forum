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
texteDiscussion VARCHAR(64),
datePublicationDiscussion DATE,
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

INSERT INTO Utilisateur(pseudo, email, cheminAvatar, password, isAdmin, isConnected)
VALUES("Michel63", "michel63@mail.fr", "null", "1234", 0, 0),
("Hubert59", "hubert59@mail.fr", "null", "5678", 0, 0),
("TrapQueen", "trapqueen@mail.fr", "null", "AZERTY", 1, 0),
("Barto", "barto63@mail.fr", "null", "WXCVBN", 1, 0);

INSERT INTO Discussion(titreDiscussion, texteDiscussion, datePublicationDiscussion, isClosed, idCategorie, idUser) VALUES
("Colorer en bleu un texte", "Bonjour, je n'arrive pas à colorer en bleu un texte en CSS pour mon site de poneys. Pouvez-vous m'aider ?", "2015-08-11", 0, 1, 1),
("Centrer un titre", "Salut, comment on centre un titre en CSS ?", "2016-04-12", 0, 1, 2);
("Appeler une méthode static", "Comment on appelle une méthode static en PHP ?", "2014-05-22", 0, 2, 2);
("Synthaxe boucle for", "Hello tout le monde, quelle est la synthaxe d'une boucle for en Java ?", "2018-11-02", 0, 3, 1);

INSERT INTO CategorieDiscussion(idCategorie, nomCategorie) VALUES
(1, "CSS"),
(2, "PHP"),
(3, "Java");

INSERT INTO Message(texteMessage, datePublication, idUser, idDiscussion) VALUES
("Je crois que c'est -> font-color:blue", "2019-10-12", 3, 1);