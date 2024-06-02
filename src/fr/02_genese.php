# Préface: Génèse

Cette section est à propos du contexte de création de Dabsic
et j'en suis le sujet. Vous pouvez tout à fait la sauter.

## Cadre initial

Les prémisces de Dabsic, simple format, sont apparu alors que j'étais en
3ème année à l'Epitech. Je travaillais sur un projet de C++
qui consistait à programmer un ``R-Type'' en réseau.
Ce projet prenait la suite de ``Babel'' o\`u
nous devions faire un client/serveur VOIP, inspiré de Skype.\

J'étais rodé à différentes choses (à un certain niveau) à
l'époque: la conception de bibliothèque, le graphisme et le parsing.
Je développais beaucoup de bibliothèques pour mon propre usage.\

Au départ, elles étaient en C: Epitech nous amenant à programmer nos
propres bibliothèques, nous avions tous une bibliothèque de chaine
de caractères et pour les listes chaînés. Ces bibliothèques personnelles
étaient néanmoins abandonnées en fin d'année par la plupart des élèves, mais
de mon coté, j'avais choisi de continuer à les développer.
Un module pour les arbres, les tables de hash, pile et file,
un allocateur de débug ainsi que quelques parseurs de formats simples ainsi qu'un
module d' ``appel dynamique'' me permettant d'appeller n'importe
quelle fonction prenant n'importe quel paramètre à partir d'une
liste chainée de paramètres divers, via de l'assembleur x86 en ligne.\

Par la suite, j'ai du passer une partie de celle-ci en C++
et me débarasser de celles qui n'étaient plus pertinentes...
Je conservais tout de même l'essentiel dont un bel ordonnanceur réseau mono-socket
d'écoute conçu pendant ma 2ème année et ré-écrit en C++ pour ``Babel''.\

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
s'est porté dessus car je trouvais le format clair et beau.
Il était suffisament primitif pour que j'y parvienne.\

J'esperais ne pas avoir besoin de disposer d'une hiérarchie, mais
nous en avons finalement eu besoin. Je m'y suis plié. J'ai détaché
le symbole permettant de fermer la définition d'un groupe en INI
pour la mettre en contrebas et lui permettre ainsi de contenir
des éléments.\

Le format de base était né, je l'ai appellé ``Objective INI''.
Je ne connaissais pas JSON à l'époque (ni LISP...), et j'ai découvert ce
dernier lorsqu'on m'a fait remarqué la ressemblance quelque
chose comme un an après avoir établi ce premier format. Entre-temps,
j'avais développé quelques spécificités rendant une compatibilité
naïve impossible.\

La première version était quelque chose de très pauvre mais
de déjà très utile: le format gérait un arbre de chaine de
caractère avec des branches pouvant contenir un fruit étant
lui-même une chaine de caractère. La classe elle-même s'utilisait comme des
tableaux à chaine de caractères de PHP, s'agrandissant toute
seule et se convertissant en entier si néccessaire. La surcharge
d'opérateur du C++ permettait de disposer d'un typage et d'un accès
confortable.\

\pagebreak

## Une source de motivation

Notre ``R-Type'' fut un fiasco. ``Babel'' n'ayant pas
été mieux, allié au fait que j'avais boudé les autres langages de
programmation orientés objets, je me suis retrouvé au rattrapage
de programmation orienté objet, un bien moche palmarès, qu'ironiquement,
j'allais pouvoir faire en C++.\

Le rattrapage consistait à programmer un serveur POP3 et un
serveur SMTP. Temps imparti: vendredi 19h jusqu'à dimanche 10h.
J'ai pris mon ordonnanceur réseau du ``Babel'' et
mon format de fichier du ``R-Type'', le reste était pur
transaction. Alors que ``Mendoza'' m'aurait terrassé si j'y
étais allé seul, doté de mes deux outils, il n'avait été
finalement qu'un petit projet sympa.\

Autour de moi, mes camarades, le plus souvent armé de Java
(sans restriction) ou de C\# (Avec les outils SMTP/POP interdit)
avaient échoué. Nombre d'entre eux avaient passé une ou deux
nuits blanches. Cela m'a donné envie de continuer à faire
évoluer ces outils.\

Il m'a fallu choisir un projet de fin d'étude et cela m'a
donné à réflechir. Ce que je souhaitais faire, techniquement,
c'est mettre à profit mes deux travaux qu'étaient ``bpt::OIni'' et
``bpt::NetCom''. Devoir choisir m'a amené à me rappeller
les raisons qui m'ont amené dans mon école: je souhaitais
créer un studio de jeux vidéos. Je voulais distribuer des jeux
et des moteurs, des éditeurs, ce genre de chose.\

J'ai reparcouru quelques programmes que j'avais fait auparavent.
Avant d'être à Epitech, j'avais programmé en PHP, en C et
en Visual Basic. J'avais fait deux jeux en Visual Basic dont
un jeu d'aventure. En relisant le code source de celui-ci, je
me rendit compte que le design du langage et les facilités
(parfois outrancière, parfois mal considéré par les programmeurs
de langages ``plus sérieux'') m'avaient amené à mettre en
place une structure cohérente, dédiée mais extensible.\

Mon choix était finalement tout vu: je souhaitais transformer
``Objective INI'' en langage de programmation et le doter
de manipulations réseaux transparentes en vue de réaliser
un moteur pour jeux d'aventures basé dessus. Il y aurait un
IDE graphique dans la veine de RPG Maker, avec un éditeur
de texte en plus façon Visual Basic 6. Le langage devra
permettre la mise en place simple par un débutant comme
je l'étais.\

## Mon projet de fin d'étude

Tout se n'est pas passé comme je l'esperais, devant faire
des concessions, mon projet de fin d'étude fut un logiciel
de création de cours et d'exercices pour une professeur
d'anglais (qui nous a largué très rapidement), cela faisait
``plus sérieux'' qu'un moteur de jeux vidéos pour un genre
ayant déjà été entérré une fois. Pas de graphismes, pas
de réseau, mais je parvenais à sauver le langage de programmation
en faisant une promesse: il sera très vite finit et fonctionnel.
Pour mettre toutes les chances de mon coté, je décidais de
commencer avec 4 mois d'avance.\

Je m'étais tué à la tache, programmant du matin jusqu'à
ce que la nuit soit déjà bien avancée. Au départ, lors d'un
stage de fin d'année et ensuite lors de mon voyage à l'étranger imposé
en 4ème année d'étude.
Je mettais la touche finale de ``Objective INI 1.0''
fin octobre, soit officiellement 2 mois après l'ouverture
de la ``période de développement'' du projet de fin d'étude et
un an et demi avant la fin du projet. Très rapidement, j'ai
souhaité changer de nom. A la manière de Jay Miner qui ne voulait
pas que son ordinateur porte un nom d'ordinateur tel que ``//c'',
``520ST'', ``TI99'', ``VIC20'' etc. et nomma son ordinateur
``Amiga'', je ne voulais pas d'un nom qui transpire le langage
de programmation.
``Objective'' rappelait evidemment Objective C
et OCaml. INI étant carrément un format crée par Microsoft, cela
ne me plaisait guère non plus. Les autres ``\#'', ``script'', ``++''
ou les noms de scientifiques du passé ne me tentaient guère non
plus.\

Etant donné que mon langage s'inspirait
beaucoup de Visual Basic et que BASIC était un acronyme, j'ai
souhaité disposer d'un nom qui y ressemble. D'autant que
j'aime beaucoup les ordinateurs et le folklore informatique
des années 70/80... J'ai renommé ``Objective INI'' en ``Dabsic''.
Autant dire qu'au jeu de ne pas donner un nom de langage à mon langage,
je me suis raté - mais j'aime ce que j'ai trouvé.\

BASIC signifie ``Beginner's All-purpose Symbolic Instruction Code''.
Dabsic signifie à l'origine ``Developer's All-purpose Block-structured Instruction Code''.
Depuis peu, je me demande si le D ne pourrait pas être celui de "DSL"
signifiant "Domain Specific Language", étant donné sa destination première
consistant à servir de support de configuration dynamique.
\

Rien ne s'est déroulé correctement pour Dabsic. J'ai programmé
une trentaine de programmes de tests ainsi qu'un ``Pong'' après
avoir programmé une liaison avec SFML1.6. Malgré cela, je n'ai
pas réussi à convaincre, dans l'esprit de mes camarades et
de l'équipe d'évaluation, Dabsic ne pouvait pas fonctionner. Seule
ma compagne, Lisa, s'est plongé dans Dabsic et l'a compris
et a construit un module de GUI pour lui. Dabsic
a été retiré du projet vers Mars suite à l'insistance et le
ressentit qui commencait à s'installer.\

Lisa et moi avons alors commencé une seconde version de Dabsic
qui règlerait les problèmes les plus évidents: le type interne unique string,
la lenteur, principalement, avec le soutien du chef du laboratoire
des langages avancés, en Flex/Bison. Néanmoins, devant avant
tout assurer la continuité de notre projet de fin d'étude, cela
est resté à un état embryonnaire, d'autant que nous avions
pas mal de difficultés avec notre nouvel outil.\

Notre projet de fin d'étude s'est achevé sur un logiciel
inutile: un pseudo IDE dont la quasi totalité des boutons étaient
mort et dans lequel il était impossible de programmer la moindre
réaction car... il n'y avait pas de langage en arrière, juste
des comportements prédéfinis à l'avance pour effectuer notre
démonstration. Un échec cuisant dont la relecture des échanges
de mails et tickets me met encore en colère aujourd'hui.\

Dabsic était mort et enterré. Mes camarades se rejouissaient
de la réussite de notre ``projet'' qui n'était finalement
qu'un mock partiel de la moitié de ce qu'il aurait pu être.\

\pagebreak

## Un projet latent

Après le projet de fin d'étude est venu le stage de fin d'étude.
Cette fois, plus question de laisser qui que ce soit au travers
de mon chemin: j'allais travailler pour moi et développer
ce que j'entends.\

J'ai fondé ``Hanged Bunny Studio'' sous la contrainte: j'étais
déjà auto-entrepreneur mais mon école m'a imposé un autre format,
sans quoi elle refuserait de considérer mon travail comme
mon stage de fin d'étude... Mais au moins, j'avais ce que je voulais.\

J'ai jeté ma vieille bibliothèque ``bpt'' pour une nouvelle ``HBSL''
et commencé une réimplémentation complète de tous ce que j'avais
fait ces deux dernières années, mais articulé autour de Dabsic.\

Mon stage fut évidemment trop court, et étant donné que la pile
technologique que j'avais décidé était assez importante,
surtout pour un seul programmeur, j'ai mis en pause ce travail
pour me consacrer à un prototype de jeu vidéo et le défendre en
convention. Dabsic s'est mit a dormir.\

Une autre raison est que son développement était trop complexe
pour moi de la manière dont j'avais attaqué le sujet: je créais
une sorte de super objet gérant les différents aspects dont
un champ Dabsic était responsable (hors fonctions et opérations)
et la moindre fonction était lourde, longue et devait prendre en
compte trop d'éléments pour que je puisse les avoir tous en tête,
sans parler de l'absence de support écrit... Cette troisième version
ne verra jamais le jour.\

\pagebreak

## Aujourd'hui

J'ai repris Dabsic en vue d'en faire une quatrième version il y a quelques années.
Ma technique fut différente: je mettais de coté toute tentative
d'implémenter totalement en une fois l'ensemble des fonctionnalités
que j'espèrais y voir - et favorisait une structure générale C à une structure C++.
Cette quatrième version n'est pas terminée à ce jour mais est tout de
même employé pour différents aspects déjà fonctionnel. Les parties
langages sont mouvantes mais il est possible de s'en servir.
\

Ensuite, ce livre. Il sert deux propos: définir une base
sur laquelle me reposer quand j'ai besoin d'implémenter un
aspect auquel j'ai pensé: plutôt que de me rappeller ou
de parcourir un TODO au format fumeux et à la longueur infinie.\

Le deuxième propos est tout simplement le partage. Ce projet
a souffert d'une forte apprehension par le passé: la distance
et le manque de confiance de chacun envers les autres (envers
moi, j'imagine, surtout) a mené le projet vers un arret
brutal alors que bien qu'il fut loin d'être parfait, ce train
tenait bien dans ses rails.\

La version de Dabsic décrite dans ce livre est bien plus
vaste que la version originale développée alors que j'étais
étudiant. Elle est probablement bancale sur differents aspects,
améliorable sur d'autres et peut tout à fait certainement
être enrichie de nouveaux aspects.\

De même, l'implémentation est actuellement à ma seule
charge et n'aboutira certainement pas...
Lorsque j'étais étudiant, surtout à l'étranger,
je disposais d'un temps quasiment infini, aujourd'hui, c'est
très différent: comme de très nombreux développeur, j'ai une famille,
un travail, diverses obligations et projets, outre celui-ci... et il faut
que je m'en accomode. Ce livre est aussi une façon, au-delà
du simple partage d'idée, de générer de l'intêret et peut-être,
j'espère, de former une équipe ou une communauté pouvant
contribuer à la création de ce langage de programmation.\

<?=$PAGE; ?>
<?=page_break(); ?>


