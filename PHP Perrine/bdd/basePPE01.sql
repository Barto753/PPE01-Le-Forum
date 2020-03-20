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
dateMessage DATETIME,
idUser INT,
idDiscussion INT,
PRIMARY KEY(idMessage));

CREATE TABLE IF NOT EXISTS Discussion(
idDiscussion INT AUTO_INCREMENT,
titreDiscussion VARCHAR(64),
texteDiscussion TEXT,
dateDiscussion DATETIME,
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
("Michel", "michel@mail.fr", "single-man-circle.png", "1234", 0, 0, 0, "null", "2000-01-01"),
("Hub_59", "hubert59@mail.fr", "single-man-circle.png", "5678", 0, 0, 0, "null", "2000-01-01"),
("Pingu", "pingu@mail.fr", "single-woman-circle.png", "AZERTY", 1, 0, 0, "null", "2000-01-01"),
("Q63", "q63@mail.fr", "single-man-circle.png", "WXCVBN", 1, 0, 0, "null", "2000-01-01"),
("MlleLola", "mlola@mail.fr", "single-woman-circle.png", "h3ll0", 0, 0, 1, "insultes", "2220-01-01");

INSERT INTO CategorieDiscussion(nomCategorie) VALUES
("Chien"),
("Chat"),
("Rongeur"),
("Oiseau"),
("Reptile"),
("Cheval"),
("Poisson");

INSERT INTO Discussion(titreDiscussion, texteDiscussion, dateDiscussion, isClosed, idCategorie, idUser) VALUES
("Nourrir son chiot", "Que donner à manger à un chiot ?", "2018-06-10", 1, 1, 1),
("Balader un chien dangereux", "Faut-il mettre une muselière à un berger allemand ?", "2019-08-24", 0, 1, 2),
("Voyager avec un chat", "Salut, comment je pourrais me déplacer avec mon chat lors de mes voyages selon vous ?", "2017-12-23", 0, 2, 3),
("Chat ne perdant pas ses poils", "Quelle race ne perd pas trop ses poils car je suis alergique ?", "2019-07-04", 0, 2, 2), 
("Cage pour hamster russe", "Bonjour, voici mon problème, j'ai du changer de cage en URGENCE pour mes deux petits hamsters. Ils n'ont jamais été habitué a grimper au grillage comme vous pouvez le voir. Comment je peux faire en sorte qu'il", "2020-03-02", 0, 3, 1), 
("Gerbille blessée", "Bonsoir, mon chat a blessé une gerbille à la queue, elle a saigné, que dois je faire...??", "2018-02-18", 0, 3, 4),
("Nourrir un perroquet", "Qu'est-ce que les perroquets mangent ?", "2019-05-17", 0, 4, 5),
("Pourquoi mon serpent a doublé de volume ?", "Un matin j'ai retrouvé mon boa sur mon canapé et il était très gros..", "2019-02-01", 0, 5, 1),
("J'adore les chevaux", "Pourquoi mon cheval est vert ?", "2016-04-11", 0, 6, 2), 
("Mon poisson rouge a sauté", "Pourquoi mon poisson adore sauter en dehors du bocal ?", "2017-03-11", 0, 7, 3);   

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
("De quelle race est ton hamster ?", "2019-10-08", 3, 6),
("Bonjour, je crois que ça mange des graines", "2019-06-09", 4, 7),
("Mais non ça mange du guacamole !", "2019-07-23", 2, 7),
("Il a mangé ton chat !", "2020-03-18", 5, 8),
("C'est surement parce qu'il devient fou", "2017-10-28", 1, 9),
("Son bocal est de quelle forme ?", "2018-01-04", 3, 9);

