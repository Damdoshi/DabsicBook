#### Type

Un champ Dabsic peut disposer d'une valeur. Cette valeur peut être d'un type dans
une liste restreinte. Le type peut etre explicite ou implicite.

* int, integer: Un nombre entier, positif, négatif ou nul, sur 64 bits. Les représentations acceptées pour les entiers sont binaire, hexadecimal, décimal et octal. Seule
la notation décimale peut-être combinée avec l'opérateur unaire moins **-**.

```dabsic
Champ0 = 0b11001 '24
Champ1 = 0x2A '42
Champ2 = 0x2a '42
Champ3 = 424
Champ4 = 010 '8
```

Lors d'une explicitation de type integer, il est possible de préciser une étendue
acceptable. L'assignation d'une valeur n'étant pas dans cette amplitude lèvera
alors une erreur. Il est possible d'utiliser des valeurs depuis les champs
à la conditon que ces champs soient éternaux (Voir spécificateurs). Ils devraient
certainement aussi être constants.

```dabsic
ChampZ:integer[-5, +10] = 7
eternal Seuil=10
ChampY:integer[Seuil - 10, Seuil + 10] = 7
```

Un comportement spécifique est reservé aux opérateurs unaires ++ et -- concernant
les amplitudes: les seuils agiront comme limites sans lever d'erreur.

* bool, boolean: Un nombre entier, pouvant prendre seulement les valeurs 0 et 1,
associé aux mot-clefs **true** et **false**. Le stockage sous jacent est un int.

* real: Un nombre flottant, positif, négatif ou nul. Les représentations acceptées pour les flottants sont la forme décimale classique et la notation scientifique. Le stockage sous jacent est un double. Il est possible d'utiliser le suffixe % à la suite
d'un nombre littéral pour indiquer que la valeur est un pourcentage et doit
donc être ramené entre 0 et 1 (partant du principe qu'elle et entre 0 et 100).

```dabsic
Champ5 = 4.7
Champ6 = 5.
Champ7 = .42
Champ8 = 5e8
Champ9 = 70%
```

De la même manière que les champs entiers, les champs réels peuvent avoir
une étendue précisée à la création. Le comportement est identique mais les valeurs
seuils sont des réels eux aussi.

* string: Une chaine de caractères. Il s'agit au niveau du format d'une chaine de
caractère C typique, et tous les caractères d'échappement du C sont disponible ainsi
que la notation octale **\0**. La notation hexadécimale **\x** est également disponible ainsi
que la notation unicode exploitant **\u**.

```dabsic
ChampA = "Je vais bien.\n"
ChampB = "Je sais même intégrer des symboles bizarres \01."
ChampC = "Je sais même intégrer des symboles très bizarres \xFF."
ChampD = "Et gérer des formats quand même assez nul. \uABCD."
```

* address: L'adresse d'un champ Dabsic. Il s'agit d'une chaine de caractère respectant les limitations du nom des champs et établie via l'opérateur de récupération d'adresse.

```dabsic
ChampE = "Valeur"
ChampF = &[].ChampE 'Actuellement indisponible, assuré par AddressOf probablement temporairement
ChampG = AddressOf([].ChampE) 'Actuellement disponible, probablement temporairement
```

Il est possible de définir des adresses invalides, menant vers des champs
sans existence. Ces champs ne peuvent pas être lu mais peuvent tout à fait
être écrit et créé à la volée. L'accès en lecture à une référence invalide
passe le programme en mode erreur. Il est possible d'a la place de créer
l'élément lu en établissant l'option **-Cignore-bad-ref**. Le mot clef
**Exists** permet de vérifier l'existence d'un champ.
Le mot clef **NULL** peut être utilisé pour établir la valeur d'un champ
adresse à une adresse invalide de manière certaine. **NULL** ne peut être rendu
valide.

* class: Indique que le champ respecte la construction imposée par un autre champ. La classe en question est précisée. Une classe disposant de constructeurs, l'établissement de la valeur du champ se fait par son appel.

```dabsic
ChampH = [].TheClass("Name")
```

* enum: Indique que le champ comporte des constantes symboliques. L'énumération en
question est précisée si elle existe déjà, sinon elle peut être déterminée à la volée.

```dabsic
ChampI:enum[BON,BRUTE,TRUAND] = TRUAND
ChampJ:enum [].Couleur = [].Couleur.ROUGE
```

##### Considération sur le formatage des litteraux

Etant donné que l'aspect configuration est important en Dabsic, je m'interroge
sur la possibilité de conserver l'information du formatage original afin
lors de regénération de la configuration pouvoir utiliser le format qui convient.

La première version de Dabsic le faisait, mais sur les conseils avisés - cependant
trop peu connaisseur des éventuels enjeux de Dabsic - de l'un de mes professeurs,
cela a été retiré dès les recherches sur la V2 commencé.

La version actuelle est capable de regénérer les expressions de constantes menant
aux résultats, mais pas la mise en forme des litteraux.

Il semble évident, mais cela n'est peut etre ni utile ni suffisament bon marché,
que des valeurs écrites en binaire ou en hexadécimal sont mieux représentés ainsi
qu'en décimal.

#### Options sur les types

Il est possible d'établir l'option **-Cexplicit-types** qui oblige à définir le type
de tous les champs. Il est également possible d'interdire d'expliciter les types
des champs, avec l'option **-Cno-explicit-types**.
