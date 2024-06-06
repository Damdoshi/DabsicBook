
# Fonctions

Dabsic permet de définir des fonctions. Une fonction est une unique opération
ou une série d'opérations dont le résultat est entièrement calculé - en dehors
des constantes - à l'execution.

Considérez l'opération et la fonction suivante. Un champ est perçu comme une
fonction par l'adjonction de parenthèses à la suite du nom du champ. Une définition
des paramètres pourra être inseré entre ces parenthèses.

```dabsic
ElementA=5
ElementB=7
Operation=ElementA * ElementB
Fonction()=ElementA * ElementB
```

Les champs Operation et Fonction pourraient tout à fait renvoyer la même valeur. Il
y a tout de même une différence majeure: Operation sera calculé une unique fois
lors de la lecture du fichier, tandis que Fonction sera calculé lorsqu'un appel
sera fait.

Qu'est ce que cela change? Cela veut dire qu'on peut dire avec certitude
que Operation vaut 35, tandis que pour Fonction, cela dépendra de la valeur
de ElementA et ElementB au mêment de l'appel.

La définition du type de retour est optionnelle. Rendre explicite ce type
est néanmoins indispensable si vous souhaitez utiliser efficacement **strict**
ou des forces de type.

## Fonctions en lignes

Une fonction en ligne est une fonction écrite comme une simple expression.
Ces fonctions ne peuvent effectuer d'assignation et ne permettent pas l'usage
de structures de contrôles autre que l'opérateur ternaire. Il est cependant
possible d'employer la récursion.

L'avantage des fonctions en ligne est leur simplicité d'écriture.

```dabsic
Abs(int v):integer = v * (v > 0 ? +1 : -1)
Factoriel(int v):integer = v <= 1 ? 1 : v * Factoriel(v - 1)
```

Il n'est pas non plus immédiatement possible d'afficher du texte, néanmoins
comme vous pouvez appeler des fonctions, rien n'empeche d'appeler
une fonction qui affiche.

## Fonctions en bloc

Une fonction en bloc est une fonction permettant de basculer Dabsic dans
un autre mode. Dans une fonction en bloc, il devient possible d'écrire
des structures de contrôle. Une fonction en bloc peut ne pas disposer de parenthèses
écrites à la suite de son nom: c'est équivalent à **()**.

Ci-dessous, un exemple de création de fonction en bloc **Hello** affichant
un texte suivi du paramètre. Une autre fonction, **IAm** effectue une lecture.

Remarquez qu'il n'y a pas de terminateur d'instruction: en Dabsic, le saut
de ligne joue ce rôle.

```dabsic
Hello(string nom) = [Function
  "Bonjour ", nom
]

IAm() = [Function
  string nom

  ?"Je suis ", nom
  Hello(nom)
]
```

### Entrées et sorties

L'opérateur **$** permet d'écrire sur la sortie standard. Si le premier élément
que l'on souhaite écrire est une chaine de caractère littérale, il est possible
de l'omettre. Ici, **nom** sera affiché à la suite de "Bonjour ". Aucun travail
supplémentaire n'est néccessaire.

*L'idée de pouvoir écrire directement sans opérateurs provient du dialecte
C de Terrence Andrew Davis **HolyC**, développé pour **TempleOS**.*

Il est possible de commencer l'instruction par l'opérateur **!**, dans ce cas,
l'écriture s'effectuera sur la sortie d'erreur.

Ces écritures sont automatiquement suivis d'un saut de ligne.

Il est possible de commencer l'instruction par l'opérateur **?**, dans ce cas,
c'est une lecture sur l'entrée standard qui sera faite. Les chaines de caractère
en dur devant alors correspondre et les variables devenant des receptacles
d'entrées utilisateurs, à la façon de *scanf*. L'incomplétion des paramètres
passe le programme en mode erreur.

### Déclaration de variables

Comme vous avez pu le voir dans la fonction IAm, la déclaration de variable
fonctionne sur le principe du type en premier suivi du nom. Le type est optionnel,
sauf lorsque vous employez une politique de type qui l'empeche.

```dabsic
Main = [Function
  string v = "bêtise"
  i

  i = 42
  v = "réponse"
  "La ", v, " est ", i, "."
]
```

La déclaration de variables est obligatoire, à moins que l'option
**-Coptionnal-variable-declaration** ne soit précisée. Les types
déclarables sont les mêmes que ceux de l'arbre Dabsic.

### Opérations

Il est possible bien etendu d'écrire des opérations sur une ligne d'instruction.
Les opérateurs disponibles sont les opérateurs d'assignation en bas priorité,
ainsi que tous les opérateurs précisé dans la section sur les opérateurs.

```dabsic
Main = [Function
  string i

  string = (string)(5 - 2) # " petits cochons\n"
  "Les ", string
]
```

Les opérations d'assignement générales sont celle-ci:

| Symboles | Fonction |
| -------- | -------- |
| = | Assignation totale. Valeur, tableau et noeud sont copiés de droite à gauche. |
| (=) | Assignation de la valeur de droite dans la valeur de gauche. |
| {=} | Assignation du tableau de droite dans le tableau de gauche. |
| [=] | Assignation du noeud de droite dans le noeud de gauche. |

Il est également possible d'effectuer des combinaisons d'assignation et
d'opérateurs binaires. Sauf précision, seule la valeur des champs est concernée.

| Symboles | Fonction |
| -------- | -------- |
| ||= | Opération d'OU INCLUSIF logique. |
| ^^= | Opération d'OU EXCLUSIF logique. |
| &&= | Opération ET logique. |
| |= | Opération d'OU INCLUSIF binaire. |
| ^= | Opération d'OU EXCLUSIF binaire. |
| &= | Opération ET binaire. |
| <<= | Opération de décalage binaire gauche. |
| >>= | Opération de décalage binaire droite. |

