# --------------------------------------------------------
#
# Structure de la table `madgames_categorie`
#


CREATE TABLE `madgames_categorie` (
    `id`  TINYINT(4)  NOT NULL AUTO_INCREMENT,
    `nom` VARCHAR(20) NOT NULL DEFAULT '',
    PRIMARY KEY (`id`)
)
    ENGINE = ISAM;


#
# Contenu de la table `madgames_categorie`
#

INSERT INTO `madgames_categorie`
VALUES (1, 'Puzzles');
INSERT INTO `madgames_categorie`
VALUES (2, 'Sport');
INSERT INTO `madgames_categorie`
VALUES (3, 'Shoot\'em up');
INSERT INTO `madgames_categorie`
VALUES (4, 'Réflexion');


# --------------------------------------------------------
#
# Structure de la table `madgames`
#

CREATE TABLE `madgames` (
    `id`          INT(11)      NOT NULL AUTO_INCREMENT,
    `cid`         TINYINT(4)   NOT NULL DEFAULT '0',
    `nom`         VARCHAR(100) NOT NULL DEFAULT '',
    `description` TINYTEXT     NOT NULL,
    `url_img`     TINYTEXT     NOT NULL,
    `url_swf`     TINYTEXT     NOT NULL,
    `width`       INT(4)       NOT NULL DEFAULT '0',
    `height`      INT(4)       NOT NULL DEFAULT '0',
    PRIMARY KEY (`id`)
)
    ENGINE = ISAM;


#
# Contenu de la table `madgames`
#

INSERT INTO `madgames`
VALUES (1, 1, 'Battleships', 'Bataille navale', 'http://www.miniclip.com/Images/battleshipssmallicon.gif', 'http://freegaming.de/fungames/miniclip/battleships/battleships.swf', 572, 375);
INSERT INTO `madgames`
VALUES (2, 1, 'Bunch', '', 'http://www.miniclip.com/Images/bunchsmallicon.gif', 'http://www.miniclip.com/gamefiles0304/BunchWeb1.swf', 537, 390);
INSERT INTO `madgames`
VALUES (3, 1, 'Detonator', '', 'http://www.miniclip.com/Images/detonatorsmallicon.jpg', 'http://www.miniclip.com/gamefiles0304/detonator_HS.swf', 552, 346);
INSERT INTO `madgames`
VALUES (4, 2, 'MiniGolf', '', 'http://www.miniclip.com/Images/minigolfmedicon.jpg', 'http://www.miniclip.com/minigolf/minigolf.swf', 582, 332);
INSERT INTO `madgames`
VALUES (5, 2, 'RuralRacer', '', 'http://www.miniclip.com/Images/ruralracermedicon.jpg', 'http://www.miniclip.com/gamefiles0304/ruralracer.swf', 570, 400);
INSERT INTO `madgames`
VALUES (6, 1, 'Smashing', 'Casse brique', 'http://www.miniclip.com/Images/smashingsmallicon.jpg', 'http://www.miniclip.com/gamefiles0304/smashing.swf', 608, 456);
INSERT INTO `madgames`
VALUES (7, 3, 'Paintball', '', 'http://www.miniclip.com/Images/paintsmallicon.gif', 'http://www.miniclip.com/gamefiles0304/stressgame.swf', 554, 415);
INSERT INTO `madgames`
VALUES (8, 1, 'Tetris', '', 'http://www.miniclip.com/Images/tetrissmallicon.gif', 'http://www.miniclip.com/gamefiles0304/Tetris_HS.swf', 465, 360);
INSERT INTO `madgames`
VALUES (9, 1, 'Flashman', 'Le célèbre jeux pacman', 'http://www.miniclip.com/Images/flashsmallicon.gif', 'http://www.miniclip.com/gamefiles0304/flashman_HS.swf', 427, 469);
INSERT INTO `madgames`
VALUES (10, 1, 'Magic Balls', '', 'http://www.miniclip.com/Images/magicsmallicon.gif', 'http://www.miniclip.com/gamefiles0304/magicballs_HS.swf', 394, 500);
INSERT INTO `madgames`
VALUES (11, 4, 'Mahjong', '', 'http://www.t45ol.com/images/screenshot/937.jpg', 'http://sd165.sivit.org/random_5320/files/937.swf', 600, 450);
INSERT INTO `madgames`
VALUES (12, 4, 'Mastermind', '', 'http://www.t45ol.com/images/screenshot/786.jpg', 'http://sd165.sivit.org/random_5320/files/786.swf', 600, 450);
INSERT INTO `madgames`
VALUES (13, 4, 'Rubik\'s Cube', '', 'http://www.t45ol.com/images/screenshot/the_cube.jpg', 'http://sd206.sivit.org/random_5320/files/oida_cube.swf', 600, 450);
INSERT INTO `madgames`
VALUES (14, 4, 'Connect 4', '', 'http://www.t45ol.com/images/screenshot/connect4.jpg', 'http://www.become.co.uk/connect5.swf', 600, 450);
INSERT INTO `madgames`
VALUES (15, 1, 'Pipes', '', 'http://www.t45ol.com/images/screenshot/pipes.jpg', 'http://sd206.sivit.org/random_5320/files/pipes.swf', 600, 450);
INSERT INTO `madgames`
VALUES (16, 3, 'Hybrid Fighter', '', 'http://www.t45ol.com/images/screenshot/933.jpg', 'http://sd165.sivit.org/random_5320/files/933.swf', 600, 450);
