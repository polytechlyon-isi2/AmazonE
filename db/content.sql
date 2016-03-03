INSERT INTO t_categories VALUES (1, "CD", "Un CD (abréviation de « Compact Disc » en anglais), ou disque compact, est un disque optique utilisé pour stocker des données sous forme numérique. Le Compact Disc a été développé par Sony et Philips et lancé en 1982.");
INSERT INTO t_categories VALUES (2, "Blu-ray", "Le disque Blu-ray (abréviation officielle « BD ») est un format de disque numérique breveté et commercialisé par l’industriel japonais Sony permettant de stocker et restituer des vidéogrammes en haute définition. Sa dénomination provient du type de rayon laser qu’il exploite, de couleur spectrale proche du bleu.");

INSERT INTO t_subcategories VALUES (1, "Blues", 1);
INSERT INTO t_subcategories VALUES (2, "Classique", 1);
INSERT INTO t_subcategories VALUES (3, "Country", 1);
INSERT INTO t_subcategories VALUES (4, "Electro", 1);

INSERT INTO t_subcategories VALUES (5, "Enfant", 2);
INSERT INTO t_subcategories VALUES (6, "Action", 2);
INSERT INTO t_subcategories VALUES (7, "Western", 2);
INSERT INTO t_subcategories VALUES (8, "Horreur", 2);

INSERT INTO t_items VALUES (1, "The Best Of The Blues", "Pas de description.", 6.99, "http://ecx.images-amazon.com/images/I/71HMMoNIcAL._SX355_.jpg", 1);
INSERT INTO t_items VALUES (2, "Blues On The Bayou", "Pas de description.", 7.99, "http://ecx.images-amazon.com/images/I/81AhFsJ1cTL._SL1403_.jpg", 1);

INSERT INTO t_items VALUES (3, "50 Chefs-d'Oeuvre de la Musique Classique", "Pas de description.", 18.99, "http://www.chartsinfrance.net/style/covers1/5/2/50cmulqu_50-chefs-d-oeuvre-de-la-musique-classique.jpg", 2);
INSERT INTO t_items VALUES (4, "Je n'aime pas le classique, mais ça j'aime bien !", "Pas de description.", 6.99, "http://ecx.images-amazon.com/images/I/51cvr5DacOL.jpg", 2);

INSERT INTO t_items VALUES (5, "Country Greats", "Pas de description.", 7.99, "http://ecx.images-amazon.com/images/I/81%2BrS6HlEXL._SL1500_.jpg", 3);
INSERT INTO t_items VALUES (6, "Country Line Dance", "Pas de description.", 12.99, "http://ecx.images-amazon.com/images/I/81LCpPz%2BjbL._SY355_.jpg", 3);

INSERT INTO t_items VALUES (7, "Electro Pop Louange", "Pas de description.", 21, "http://ecx.images-amazon.com/images/I/51bD2vNUA-L._SL500_AA280_.jpg", 4);
INSERT INTO t_items VALUES (8, "Live in Paris", "Pas de description.", 17, "http://www.coverdude.com/covers/the-beatles-live-in-paris-65-front-cover-39263.jpg", 4);

INSERT INTO t_items VALUES (9, "L'Age de glace", "Il y a vingt mille ans, à l'aube de l'ère glaciaire, trois créatures particulièrement mal assorties se retrouvent liées par un caprice du destin. Sid, un paresseux gouailleur et poltron, Manfred, un gigantesque mammouth solitaire et grognon, et Diego, un sinistre tigre aux dents de sabre, font équipe, bien malgré eux, pour ramener un bébé humain dans sa tribu.", 25.99, "http://ecx.images-amazon.com/images/I/816nO-6%2Bo2L._SX342_.jpg", 5);
INSERT INTO t_items VALUES (10, "Les enfants de Timpelbach", "L'histoire commence dans un petit village hors du temps, perdu au milieu des montagnes, le village de Timpelbach. Un matin, les enfants se réveillent et tous leurs parents ont mystérieusement disparus. Seuls et livrés à eux-mêmes, ils doivent redoubler d'ingéniosité pour essayer de gérer leur vie comme des grands. Mais bien vite, deux clans rivaux se forment, et l'affrontement va devenir inévitable...", 11.06, "http://ecx.images-amazon.com/images/I/71hn1u06JFL._SX342_.jpg", 5);

INSERT INTO t_items VALUES (11, "Last Action Hero", "Danny Madigan est passionné de cinéma et en particulier des aventures de Jack Slater, son héros de film d'action préféré. Grâce à un billet magique, le jeune Danny est entraîné de l'autre côté de l'écran, pour vivre en direct les aventures de son héros. Mais les choses se compliquent lorsque des personnes mal intentionnées s'emparent du billet magique...", 8.49, "http://images3.static-bluray.com/movies/covers/8050_front.jpg", 6);
INSERT INTO t_items VALUES (12, "Night Run", "À Brooklyn, Jimmy Conlon, mafieux et tueur à gages qu'on surnommait autrefois le Fossoyeur, n'est pas au mieux de sa forme. Ami de longue date du caïd Shawn Maguire, Jimmy, qui a aujourd'hui 55 ans, est hanté par ses crimes - et traqué par un inspecteur de police qui, depuis 30 ans, n'a jamais renoncé à l'appréhender. Et ces derniers temps, il semble que le whisky soit le seul réconfort de Jimmy. Mais lorsqu'il apprend que sa prochaine mission consiste à éliminer Mike, son fils qu'il n'a pas revu depuis des années, Jimmy doit choisir entre la famille mafieuse qu'il s'est construite et la vraie famille qu'il a abandonnée il y a bien longtemps. Tandis que Mike est en cavale, Jimmy comprend que pour racheter ses fautes passées, il lui faut sans doute protéger son fils du sort funeste qui l'attend lui-même désormais? Alors qu'il n'est plus en sécurité nulle part, Jimmy ne dispose que d'une seule nuit pour résoudre son conflit de loyautés et s'amender enfin.", 11.55, "http://ecx.images-amazon.com/images/I/81%2BuvTggWSL._SY500_.jpg", 6);

INSERT INTO t_items VALUES (13, "Sur la piste des Mohawks", "Tandis que treize colonies d'Amérique du Nord se soulèvent contre l'Angleterre et demandent leur indépendence sous une bannière commune, Lana Martin s'installe dans la ferme isolée de son mari, Gil. Les conditions de vie y sont rudes, mais le voisinage avec les indiens Mohawks se déroule paisiblement. Du moins jusqu'à que ces derniers, manipulés par les Anglais, déterrent la hache de guerre. Chassés de leurs terres, les Martin se réfugient chez la veuve d'un général, dont ils se mettent au service. Mais, bientôt, les Mohawks s'engagent dans de nouvelles offensives. Si la première est repoussée au prix de lourdes pertes, la suivante s'annonce dévastatrice...", 14.99, "http://sidoniscalysta.com/431/sur-la-piste-des-mohawks-blu-ray.jpg", 7);
INSERT INTO t_items VALUES (14, "Cowboys", "Dans l'ouest sauvage, mieux vaut grandir vite si l'on ne veut pas finir dans la gueule du Chacal. Cet adage, Will Anderson y pense lorsqu'il se voit obligé d'embaucher onze adolescents pour conduire son troupeau à travers la prairie. Il va apprendre à ces gamins comment soigner, étriller, panser les bêtes, regrouper et maîtriser un troupeau de 1500 têtes. Dures leçons d'un maître à la poigne de fer, compensées par la découverte des femmes et du whisky. --Ce texte fait référence à une édition épuisée ou non disponible de ce titre.", 9.33, "http://ecx.images-amazon.com/images/I/91XQ9KXY6EL._SL1500_.jpg", 7);

INSERT INTO t_items VALUES (15, "Le Bal de l'horreur", "Trois ans après le massacre de sa famille par un dangereux psychopathe, Donna a enfin repris une existence normal et se prépare à vivre la soirée la plus importante de l'année : le bal de promo du lycée. Ce qu'elle ignore, c'est que Richard Fenton, le tueur, s'est échappé de l'asile pour la retrouver. Le détective Winn se lance à sa poursuite pour éviter le pire, mais Fenton a de l'avance. alors que la fête bat son plein, le tueur passe à l'attaque...", 8.53, "http://ecx.images-amazon.com/images/I/51aHlvhIx-L._SY445_.jpg", 8);
INSERT INTO t_items VALUES (16, "Poltergeist", "Lorsque les Bowen emménagent dans leur nouvelle maison, ils sont rapidement confrontés à des phénomènes étranges. Une présence hante les lieux. Une nuit, leur plus jeune fille, Maddie, disparaît. Pour avoir une chance de la revoir, tous vont devoir mener un combat acharné contre un terrifiant poltergeist...", 14, "http://images4.static-bluray.com/movies/covers/136297_front.jpg", 8);

/* raw password is 'john' */
insert into t_users values
(1, 'JohnDoe', '', '%qUgq3NAYfC1MKwrW?yevbE', 'ROLE_USER');
/* raw password is 'jane' */
insert into t_users values
(2, 'JaneDoe', '', '%qUgq3NAYfC1MKwrW?yevbE', 'ROLE_USER');
/* raw password is '@dm1n' */
insert into t_users values
(3, 'admin', '', '%qUgq3NAYfC1MKwrW?yevbE', 'ROLE_ADMIN');