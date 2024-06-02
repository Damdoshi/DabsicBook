
#### Dabsic

Voici maintenant le fonctionnement de Dabsic, pour ce qui est de sa partie *données*. Pour commencer, les commentaires en ligne commencent par le caractère **'**. Les
commentaires en bloc s'ouvrent et se ferment avec **[\*** et **\*]**. La racine en Dabsic est notée **[]**.

Un champ Dabsic peut exister et ne rien contenir du tout.

Un champ Dabsic peut contenir une valeur. Cette valeur peut-être une chaine de caractères, un entier, un flottant ou l'adresse d'un autre noeud. Cette valeur peut-être passée directement ou via le résultat d'une expression.

```dabsic
Champ0 'Champ vide
Champ1 = "Valeur"
Champ2 = 47 + 3
Champ3 = 5.6 * Champ2
Champ4 = Champ1 # "Cool" 'Champ4 va valoir "ValeurCool"
Champ5 = &Champ2 'Champ5 vaut l'adresse de Champ2. C'est un pointeur vers [].Champ2
```

Une table Dabsic commence par son ouverture à l'aide du caratère **[**, suivi
immédiatement du nom du noeud. Jusqu'à la fermeture via **]**, d'autres champs
peuvent être déclarés. Il est également possible d'utiliser la syntaxe avec
le symbole **=** comme pour les valeurs, suivi de **[Node**.

```dabsic
[NoeudA
  Champ = "Valeur"
]
[NoeudB
  [Noeud = 50
    Champ = "Valeur"
  ]
]
NoeudC = [Node

]
```

Remarquez-ci dessus que [].NoeudB.Noeud contient des champs et en plus, dispose
d'une valeur.

Un tableau Dabsic commence par son ouverture à l'aide du caractère **{**, suivi
immédiatement du nom du tableau. Jusqu'à la fermeture via **]**, des
valeurs peuvent être écrites, séparées par des virgules. Il est également
possible d'utiliser la syntaxe avec le symbole **=** comme pour les valeurs,
suivi de **[Array** ou simplement de valeurs séparées par des virgles.

Avec la notation **{** et **[Array**, la possibilité d'omettre le séparateur
virgule est à l'étude.

Il est également possible d'ouvrir un noeud ou un tableau à la place d'une valeur.

```dabsic
{TableauA = 42
  "Valeur",
  4,
  6.7,
  [
    Champ1 = 5
    Champ2 = 7
  ],
  &[].TableauC,
  { 1, 2, 3 }
}
TableauB = [Array = 84
  1, 2, 3
]
TableauC = "Salut?", "Oui, salut"
```

Remarquez que [].TableauA est un tableau mais contient également une valeur, la
valeur 42. De même, [].TableauB contient une valeur, la valeur 84. [].TableauC de
son coté ne contient aucune valeur immédiate, mais est un tableau de trois cases.

Notez que ni le noeud présent dans [].TableauA[3], ni le tableau de [].TableauA[5]
ne portent de nom. Il est possible
de leur préciser un nom cependant! Cela pourrait servir dans le cas d'une recherche
par nom d'un champ, via l'opérateur **[#** servant à chercher le premier parent
porteur d'un nom spécifique.

Ci-dessous, des exemples de champs combinant tableau, table et valeur:

```dabsic
[Champ1 = [Array = "ValeurDeChamp1"
    1, 2, 3
  ]
  ChampZ = "Valeur"
]
{Champ2 = [Node = "ValeurDeChamp2"
     Champ = "Valeur"
  ]
  1, 2, 3
}
[Champ3 = "ValeurDeChamp3"
   Champ = "Valeur"
   {This 1, 2, 3}
]
```

Dans cet exemple, **This** est un mot-clef indiquant que le tableau est en fait, le champ **Champ3**.


