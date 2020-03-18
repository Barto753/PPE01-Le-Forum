DROP DATABASE IF EXISTS bdd_forum;

CREATE DATABASE IF NOT EXISTS bdd_forum
CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

USE bdd_forum;

CREATE TABLE IF NOT EXISTS Utilisateur(
idUser INT AUTO_INCREMENT,  
pseudo VARCHAR(64),  
email VARCHAR(64),
cheminAvatar VARCHAR(64), 
password VARCHAR(64),
isAdmin TINYINT,
isConnected TINYINT,
isBanned TINYINT,
motifBan VARCHAR(64),
dateFinBan DATETIME,
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

INSERT INTO Utilisateur(pseudo, email, cheminAvatar, password, isAdmin, isConnected, isBanned, motifBan, dateFinBan) VALUES
("Michel", "michel@mail.fr", "null", "1234", 0, 0, 0, "null", "2000-01-01"),
("Hub_59", "hubert59@mail.fr", "null", "5678", 0, 0, 0, "null", "2000-01-01"),
("Pingu", "pingu@mail.fr", "null", "AZERTY", 1, 0, 0, "null", "2000-01-01"),
("Q63", "q63@mail.fr", "null", "WXCVBN", 1, 0, 0, "null", "2000-01-01"),
("MlleLola", "mlola@mail.fr", "null", "h3ll0", 0, 0, 0, "null", "2000-01-01");

INSERT INTO CategorieDiscussion(nomCategorie) VALUES
("Chien"),
("Chat"),
("Rongeur"),
("Oiseau"),
("Reptile"),
("Cheval")
("Poisson");

INSERT INTO Discussion(titreDiscussion, texteDiscussion, dateDiscussion, isClosed, idCategorie, idUser) VALUES
("Nourrir son chiot", "Que donner à manger à un chiot ?", "2018-06-10", 0, 1, 1),
("Balader un chien dangereux", "Faut-il mettre une muselière à un berger allemand ?", "2019-08-24", 0, 1, 2),
("Voyager avec un chat", "Salut, comment je pourrais me déplacer avec mon chat lors de mes voyages selon vous ?", "2017-12-23", 0, 2, 3),
("Chat ne perdant pas ses poils", "Quelle race ne perd pas trop ses poils car je suis alergique ?", "2019-07-04", 0, 2, 2), 
("Cage pour souris", "Quelle taille pour une cage avec 6 souris ?", "2020-03-02", 0, 3, 1), 
("Longévité d'un hamster", "Combien de temps vivent les hamster ?", "2018-02-18", 0, 3, 4); 

INSERT INTO Message(texteMessage, dateMessage, idUser, idDiscussion) VALUES
("Quel âge a ton chiot ?", "2018-07-11", 2, 1),
("S'il vient de naitre, juste du lait.", "2018-08-015", 3, 1),
("Si tu te balades en ville oui.", "2019-10-22", 3, 2),
("Non pas besoin avec cette race.", "2020-02-04", 1, 2), 
("Achète un sac spécial.", "2018-01-31", 1, 3), 
("Avec tes jambes LOL", "2018-07-17", 2, 3), 
("Les sphynx n'ont pas de poils.","2019-09-21", 3, 4),
("Oui, j'avoue les chats sphynx.","2020-01-12", 4, 4), 
("Au moins 8m2.", "2020-03-04", 2, 5), 
("5 mètres carrés je pense.", "2020-02-25", 4, 5), 
("Pas plus de 5/6 ans.", "2019-06-19", 1, 6),
("De quelle race es ton hamster ?", "2019-10-08", 3, 6);

