# Préface: Génèse

Laissez moi vous raconter un peu ma vie.

## Cadre initial

Les prémisces de Dabsic sont apparu alors que j'étais en
3ème année à Epitech. Je travaillais sur un projet de C++
qui consistait à programmer un ``R-Type'' en réseau.
Ce projet prenait la suite de ``Babel'' o\`u
nous devions faire un petit client/serveur VOIP.\

J'étais rodé à différentes choses (à un certain niveau) à
l'époque: la conception de bibliothèque, le graphisme et le parsing.
Je développais beaucoup de bibliothèques pour mon propre usage.\

Au départ, elles étaient en C: j'avais ma propre libre de chaine
de caractères, un héritage de l'interdiction de la LibC à Epitech
lors de la première année. Un module pour les arbres, les listes
chainées, les tables de hash, pile et file, un allocateur de débug
ainsi que quelques parseurs de formats simples ainsi qu'un
module d' ``appel dynamique'' me permettant d'appeller n'importe
quelle fonction prenant n'importe quel paramètre à partir d'une
liste chainée de paramètres divers (via un hack de la pile).\

Par la suite, j'ai du passer une partie de celle-ci en C++
et me débarasser de celles qui n'étaient qu'un héritage des
interdictions scolaires... ou qui étaient tout simplement
remplacée par le C++ et sa bibliothèque. Je conservais tout
de même un bel ordonnanceur réseau mono-socket d'écoute
conçu pendant ma 2ème année et ré-écrit en C++ pour ``Babel''.\

Etant ambitieux, souhaitant faire les choses bien et en mettre
le plus possible plein la vue aux assistants pédagogiques,
j'ai souhaité doter mon ``R-Type'' de nombreux niveaux et
rendre possible des éléments divers tels que la configuration
des touches ou du réseau. Pour cela, j'avais besoin
d'un format de fichier qui me permettrait de stocker
ce que je souhaite.\

Je n'étais guère connaisseur en formats binaires et j'avais
déjà réalisé un parseur de XML et apprit par ce biais à ne
plus trop apprécier ce format.\

Etant donné le temps imparti pour le projet (Un peu plus
d'un mois) et devant m'occuper également du graphisme, j'ai
choisi un format simple: le format INI. Mon choix
s'est porté dessus car je trouvais le format clair et beau.\

J'esperais ne pas avoir besoin de disposer d'une hiérarchie,
et lorsque j'en ai eu besoin je m'y suis plié. J'ai détaché
le symbole permettant de fermer la définition d'un scope en INI
pour la mettre en contrebas et lui permettre ainsi de contenir
des éléments.\

Le format de base était né, je l'ai appellé ``Objective INI''.
Je ne connaissais pas JSON à l'époque (ni LISP...), et j'ai découvert ce
dernier lorsqu'on m'a fait remarqué la ressemblance quelque
chose comme un an après avoir établi ce premier format.\

C'était quelque chose de très pauvre mais de déjà très utile:
le format gérait un arbre de chaine de caractère avec des
branches pouvant contenir un fruit étant lui-même une chaine
de caractère. La classe elle-même s'utilisait comme des
tableaux à chaine de caractères de PHP, s'agrandissant toute
seule et se convertissant en entier si néccessaire.\

\pagebreak

## Une source de motivation

Les prémisces de Dabsic sont apparu alors que j'étais en
3ème année à Epitech. Je travaillais sur un projet de C++
qui consistait à programmer un ``R-Type'' en réseau.
Ce projet prenait la suite de ``Babel'' o\`u
nous devions faire un petit client/serveur VOIP.\\

J'étais rodé à différentes choses (à un certain niveau) à
l'époque: la conception de bibliothèque, le graphisme et le parsing.
Je développais beaucoup de bibliothèques pour mon propre usage.\\

Au départ, elles étaient en C: j'avais ma propre libre de chaine
de caractères, un héritage de l'interdiction de la LibC à Epitech
lors de la première année. Un module pour les arbres, les listes
chainées, les tables de hash, pile et file, un allocateur de débug
ainsi que quelques parseurs de formats simples ainsi qu'un
module d' ``appel dynamique'' me permettant d'appeller n'importe
quelle fonction prenant n'importe quel paramètre à partir d'une
liste chainée de paramètres divers (via un hack de la pile).\\

Par la suite, j'ai du passer une partie de celle-ci en C++
et me débarasser de celles qui n'étaient qu'un héritage des
interdictions scolaires... ou qui étaient tout simplement
remplacée par le C++ et sa bibliothèque. Je conservais tout
de même un bel ordonnanceur réseau mono-socket d'écoute
conçu pendant ma 2ème année et ré-écrit en C++ pour ``Babel''.\\

Etant ambitieux, souhaitant faire les choses bien et en mettre
le plus possible plein la vue aux assistants pédagogiques,
j'ai souhaité doter mon ``R-Type'' de nombreux niveaux et
rendre possible des éléments divers tels que la configuration
des touches ou du réseau. Pour cela, j'avais besoin
d'un format de fichier qui me permettrait de stocker
ce que je souhaite.\\

Je n'étais guère connaisseur en formats binaires et j'avais
déjà réalisé un parseur de XML et apprit par ce biais à ne
plus trop apprécier ce format.\\

Etant donné le temps imparti pour le projet (Un peu plus
d'un mois) et devant m'occuper également du graphisme, j'ai
choisi un format simple: le format INI. Mon choix
s'est porté dessus car je trouvais le format clair et beau.\\

J'esperais ne pas avoir besoin de disposer d'une hiérarchie,
et lorsque j'en ai eu besoin je m'y suis plié. J'ai détaché
le symbole permettant de fermer la définition d'un scope en INI
pour la mettre en contrebas et lui permettre ainsi de contenir
des éléments.\\

Le format de base était né, je l'ai appellé ``Objective INI''.
Je ne connaissais pas JSON à l'époque (ni LISP...), et j'ai découvert ce
dernier lorsqu'on m'a fait remarqué la ressemblance quelque
chose comme un an après avoir établi ce premier format.\\

C'était quelque chose de très pauvre mais de déjà très utile:
le format gérait un arbre de chaine de caractère avec des
branches pouvant contenir un fruit étant lui-même une chaine
de caractère. La classe elle-même s'utilisait comme des
tableaux à chaine de caractères de PHP, s'agrandissant toute
seule et se convertissant en entier si néccessaire.\\

## Mon projet de fin d'étude

Tout se n'est pas passé comme je l'esperais, devant faire
des concessions, mon projet de fin d'étude fut un logiciel
de création de cours et d'exercices pour une professeur
d'anglais (qui nous a largué très rapidement), cela faisait
``plus sérieux'' qu'un moteur de jeux vidéos pour un genre
ayant déjà été entérré une fois. Pas de graphismes, pas
de réseau, mais je parvenais à sauver le langage de programmation
en faisant une promesse: il sera très vite finit et fonctionnel.\\

Il le fut. Je m'étais tué à la tache, programmant du matin au soir
lors de mon voyage à l'étranger imposé en 4ème année d'étude,
comme l'aurait fait, je pense, n'importe quel passionné.
Je mettais la touche finale de ``Objective INI 1.0''
fin octobre, soit officiellement 2 mois après l'ouverture
de la ``période de développement'' du projet de fin d'étude et
un an et demi avant la fin du projet. Très rapidement, j'ai
souhaité changer de nom. A la manière de Jay Miner qui ne voulait
pas que son ordinateur porte un nom d'ordinateur tel que ``//c'',
``520ST'', ``TI99'', ``VIC20'' etc. et nomma son ordinateur
``Amiga'', je ne voulais pas d'un nom qui transpire le langage
de programmation. ``Objective'' rappelait evidemment Objective C
et OCaml. INI étant carrément un format crée par Microsoft, cela
ne me plaisait guère non plus. Les autres ``\#'', ``script'', ``++''
ou les noms de scientifiques du passé ne me tentaient guère non
plus.\\

Etant donné que mon langage s'inspirait
beaucoup de Visual Basic et que BASIC était un acronyme, j'ai
souhaité disposer d'un nom qui y ressemble. D'autant que
j'aime beaucoup les ordinateurs et le folklore informatique
des années 70/80... J'ai renommé ``Objective INI'' en ``Dabsic''.\\

BASIC signifie ``Beginner's All-purpose Symbolic Instruction Code''.
Dabsic signifie ``Developer's All-purpose Block-structured Instruction Code''.\\

Il s'agit plus d'une blague qu'autre chose, évidemment. J'aimais
bien la sonorité du nom aussi.\\

Rien ne s'est déroulé correctement pour Dabsic. J'ai programmé
une trentaine de programmes de tests ainsi qu'un ``Pong'' après
avoir programmé un bind avec SFML1.6. Malgré cela, je n'ai
pas réussi à convaincre, dans l'esprit de mes camarades et
de l'équipe d'évaluation, Dabsic ne fonctionnait pas. Seule
ma compagne, Lisa, s'est plongé dans Dabsic et l'a compris
au point de construire un module de GUI pour lui. Dabsic
a été retiré du projet vers Mars suite à l'insistance et le
ressentit qui commencait à s'installer.\\

Lisa et moi avons alors commencé une seconde version de Dabsic
qui règlerait les problèmes les plus évidents: le type unique string,
la lenteur, principalement, avec le soutien du chef du laboratoire
des langages avancés, en Flex/Bison. Néanmoins, devant avant
tout assurer la continuité de notre projet de fin d'étude, cela
est resté à un état embryonnaire, d'autant que nous avions
pas mal de difficultés avec notre nouvel outil.\\

Notre projet de fin d'étude s'est achevé sur un logiciel
inutile: un pseudo IDE dont la plupart des boutons étaient
mort et dans lequel il était impossible de programmer la moindre
réaction car... il n'y avait pas de langage en arrière, juste
des comportements prédéfinis à l'avance pour effectuer notre
démonstration. Un échec cuisant dont la relecture des échanges
de mails et tickets me met encore en colère aujourd'hui.\\

Dabsic était mort et enterré. Mes camarades se rejouissaient
de la réussite de notre ``projet'' qui n'était finalement
qu'un mock partiel de la moitié de ce qu'il aurait pu être.\\

\pagebreak

## Un projet latent


Après le projet de fin d'étude est venu le stage de fin d'étude.
Cette fois, plus question de laisser qui que ce soit au travers
de mon chemin: j'allais travailler pour moi et développer
ce que j'entends.\\

J'ai fondé ``Hanged Bunny Studio'' sous la contrainte: j'étais
déjà auto-entrepreneur mais mon école m'a imposé un autre format,
sans quoi elle refuserait de considérer mon travail comme
mon stage de fin d'étude... Mais au moins, j'avais ce que je voulais.\\

J'ai jeté ma vieille bibliothèque ``bpt'' pour une nouvelle ``HBSL''
et commencé une réimplémentation complète de tous ce que j'avais
fait ces deux dernières années, mais articulé autour de Dabsic.\\

Mon stage fut évidemment trop court, et étant donné que la pile
technologique était assez importante, surtout pour un seul programmeur,
j'ai mis en pause ce travail pour me consacrer à un prototype de jeu
vidéo et le défendre en convention. Dabsic s'est mit a dormir.\\

Une autre raison est que son développement était trop complexe
pour moi de la manière dont j'avais attaqué le sujet: je créais
une sorte de super objet gérant les différents aspects dont
un champ Dabsic était responsable (hors fonctions et opérations)
et la moindre fonction était lourde, longue et devait prendre en
compte trop d'éléments pour que je puisse les avoir tous en tête,
sans parler de l'absence de support écrit... J'ai donc remis Dabsic
de coté.\\

\pagebreak

## Aujourd'hui


Après le projet de fin d'étude est venu le stage de fin d'étude.
Cette fois, plus question de laisser qui que ce soit au travers
de mon chemin: j'allais travailler pour moi et développer
ce que j'entends.\\

J'ai fondé ``Hanged Bunny Studio'' sous la contrainte: j'étais
déjà auto-entrepreneur mais mon école m'a imposé un autre format,
sans quoi elle refuserait de considérer mon travail comme
mon stage de fin d'étude... Mais au moins, j'avais ce que je voulais.\\

J'ai jeté ma vieille bibliothèque ``bpt'' pour une nouvelle ``HBSL''
et commencé une réimplémentation complète de tous ce que j'avais
fait ces deux dernières années, mais articulé autour de Dabsic.\\

Mon stage fut évidemment trop court, et étant donné que la pile
technologique était assez importante, surtout pour un seul programmeur,
j'ai mis en pause ce travail pour me consacrer à un prototype de jeu
vidéo et le défendre en convention. Dabsic s'est mit a dormir.\\

Une autre raison est que son développement était trop complexe
pour moi de la manière dont j'avais attaqué le sujet: je créais
une sorte de super objet gérant les différents aspects dont
un champ Dabsic était responsable (hors fonctions et opérations)
et la moindre fonction était lourde, longue et devait prendre en
compte trop d'éléments pour que je puisse les avoir tous en tête,
sans parler de l'absence de support écrit... J'ai donc remis Dabsic
de coté.\\

\pagebreak

