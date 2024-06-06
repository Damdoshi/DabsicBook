
# Arbre Dabsic

Dans la section précédente, vous avez été introduit à différents
formats de configuration dont Dabsic. Dans cette section, nous
allons étudier de manière plus poussé les différents aspects
de ce dernier.

Etant donné la nature versatile des champs Dabsic, certains termes
seront utilisés à la place de **champ**.

- Le terme **noeud** (Node, en anglais) sera utilisé pour un champ
disposant d'enfants sous la forme de table (donc, avec une organisation clef valeur
où la clef est librement décidée)
- Le terme **tableau** (Array, en anglais) sera utilisé pour un champ
disposant d'enfants sous la forme de tableau (donc, avec un index sous forme
d'entier, contingu et commencant à zéro)
- Le terme **filet** (Net, en anglais) sera utilisé pour un champ étant
à la fois un tableau et un noeud.
- Le terme **champ** (Field, en anglais) sera donc utilisé pour les champs
n'étant ni des tableaux ni des noeuds - ou dans le cas où cette distinction
n'aurait pas d'importance.
- Le terme **fonction** (Function, en anglais) sera utilisé pour définir un
champ dont la valeur est une fonction. Une fonction peut-être un tableau
et un noeud, bien que je ne vois à l'heure actuelle de raison pour cela.

Concernant l'état des champs, voici également quelques qualificatifs utiles:

- Un champ est **vide** s'il ne contient ni valeur, ni tableau, ni enfants.
- Une **adresse** marque la distance entre un champ vis à vis de la racine globale.
- La **racine globale** s'écrit **[]** et n'a aucun parent, l'intégralité des
champs sont ses descendants.
- La **racine locale** s'écrit **[.]** et est la racine du fichier d'où viennent
les champs.
- L'objet contexte s'écrit **this**, **[#]** ou encore **.** lors que seul. L'objet
contexte est le parent du champ en cours de définition.

Concernant Dabsic en général, voici quelques termes:
- Le **projet utilisateur** est le nom donné au logiciel qui exploiterait Dabsic
comme langage de script. C'est un logiciel susceptible d'appeler les fonctions écrites
en Dabsic, de voir ses fonctions appelées par Dabsic, de travailler sur des valeurs
partagées avec Dabsic.

Il est possible d'interdire à un champ d'être à la fois un tableau et un noeud
avec l'option **-Cnode-array-mutual-exclusion**, ou encore d'interdire à un
champ d'être autre chose que l'un des trois seulement avec **-Cno-cumulative-function**. Enfin, il est possible d'interdire à un champ d'être vide avec **-Cno-empty-field**.

