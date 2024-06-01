
\chapter{Orienté objet}

Dabsic dispose de mécanismes généralement associé à la
programmation objet. Vous avez déjà vu qu'il était possible
de limiter l'accès à certains champs d'un noeud à l'aide
de mot-clefs, cela sans pour autant disposer d'une sémantique
de type objet.

Il est possible d'aller plus loin.

Pour commencer, qui dit objet dit déclaration. Jusqu'ici,
bien que nous ayons parlé de types construit, déclaration
était synonyme d'instanciation.

\section{Déclarer un type}

Pour déclarer un type, il suffit de faire comme d'habitude:

\begin{verbatim}
[Pair
  First
  Second = 42
]
\end{verbatim}

Nous avons défini un type autant qu'une instance appellé
``Pair'' comprenant deux attributs ``First'' et ``Second''.
``Second'' dispose d'une valeur par défaut qui est 42.
Nous pouvons donc écrire maintenant:\\

\begin{verbatim}
[struct Pair PseudoAge
  First = "Pseudo"
  Second = 27
]
\end{verbatim}

Notez que l'absence de définition de type dans la déclaration
permet à l'assignation d'être correcte. Par ailleurs, il aurait
été tout à fait possible de ne pas mettre un entier mais autre
chose en ``Second'' car même si la valeur par défaut est un entier,
le champ n'est pas ``strict''.

Evidemment, je recommande fortement que les types soient
éternaux, constant et dur (``\verb!eternal!'', ``\verb!const!'', ``\verb!hard!'')
et cela récursivement (``\verb|!|'').
Vous pouvez pour cela utiliser le mot-clef valise ``\verb!declare!''!

Il est également possible d'ajouter ``\verb!named!'' de manière
à indiquer que le type est fortement lié à son nom et que les compatibilités
implicites lié au contenu du type avec d'autres types doivent être refusée.

``\verb!declare!'' a une autre propriété: Les champs auquel il est
spécifié ``\verb!declare!'' sont non executable et ne provoqueront
pas d'alertes si certaines fonctions ne sont pas implémentés.
(Voir plus bas, les fonctions virtuelles pures en Dabsic)
\\

\begin{verbatim}
[declare Pair
  First
  Second
]
\end{verbatim}

Est ainsi l'équivalent de :\\

\begin{verbatim}
[declare Pair
  First
  Second
]
\end{verbatim}

Pour terminer, il est bien entendu possible d'étendre le champ
du type en ajoutant des champs à l'intérieur. Ces champs
n'entrent pas en compte lorsqu'il s'agira de considérer
ce champ comme étant du type original : autrement dit, qui
peut le plus peut le moins.

\section{L'encapsulation}

Il est possible d'encapsuler des champs à la manière du C++.

\begin{itemize}
  \item ``\verb!private!'' : Il est possible de rendre un champ
    privé, c'est à dire invisible, sans possibilité de lecture
    ni d'écriture. Il s'agit d'un simple synonyme de ``hidden''
    en Dabsic.
  \item ``\verb!protected!'' : Le champ est ``\verb!private!'' sauf pour
    les champs dont le type est un dérivé du type courant.
    Plus de détails dans la section ``Héritage''.
  \item ``\verb!public!'' : Le champ conserve ses droits tel quel,
    c'est le comportement par défaut, donc ce mot-clef ne
    devrait pas être très utilisé, a priori.
\end{itemize}

Ces mot-clefs sont utilisables comme préfixe du nom de champs,
de la même manière que les types, spécificateurs et autres.
Contrairement au C++, ils ne sont donc pas ``scopés'', agissant
sur tous les éléments situé en dessous d'eux. Néanmoins,
il est possible de les appliquer à des noeuds pour ne pas
avoir à trop les répéter.

\section{Surcharge d'opérateurs}

La surcharge d'opérateur consiste à apporter la possibilité
de lier un appel de fonction à une opération normalement
invalide telle que la suivante:\\

\begin{verbatim}
[Pair
  First = 0
  Second = 0
  Pair Operator+(const Pair) = [Function
    Pair p
    
    p.First = First + Pair.First
    p.Second = Second + Pair.Second
    Return p
  ]
]

struct Pair A
struct Pair B

Main = [Function
  Return A + B
]
\end{verbatim}

Le main retournera donc une pair contenant le resultat
des deux opérations sur les deux attributs. Sans la
précision apportée par la fonction ``\verb!Operator+!'', il
aurait été impossible de résoudre l'opération et l'interprète
aurait lancé une erreur.

Il est possible de surcharger n'importe quel opérateur
dont l'utilisation ne serait pas légale autrement.
L'ordre de priorité des opérateurs reste conservée.

En plus des opérateurs connus, vous avez la possiblité
de définir de nouveaux opérateurs binaires. Ces opérateurs
partageront la même priorité et celle-ci sera plus
basse que le dernier opérateur binaire défini par Dabsic.
Pour cela, procédez de la même manière :\\

\begin{verbatim}
[Type
  '...
  Type Operator=D(Type) = [Function
    '...
  ]
]

'...

Main = [Function
  Return A =D B 'Operateur sourire entre A et B
]
\end{verbatim}

Ne vous étonnez pas de ce fait si il vous arrive
de voir précisé ``Cannot find operatorLOL'' dans
certaines alertes: ne comprenant pas ce qui était
en vérité supposé être une variable ``LOL'' (mais
vous avez oublié d'écrire l'opérateur), l'interprète
tentera de voir si il ne s'agit pas d'un opérateur.

\section{Héritage}

Un champ Dabsic peut hériter d'un autre champ Dabsic.
Dans les faits, il s'agit presque d'une simple
composition avec quelques arrangements. Voici la
syntaxe pour hériter d'un champ :\\

\begin{verbatim}
[Parent
  Attribute = 42
  Yell = [Function
    "I am the Parent"
  ]
]

[Enfant : Parent
  Hold = [Function
    "I am holding!"
  ]
]
\end{verbatim}

L'héritage  ressemble d'une certaine façons à ``\verb!struct!'' à la
différence qu'il n'inclut pas le contenu du type parent
dans le champ : à la place, il crée un noeud factice dont
la gestion est laissée à l'interprète et qui permet de ce
fait de disposer de plusieurs champs du même nom en les
dissociant par leur classe d'origine. Ainsi, si l'on
déroule l'héritage décrit précédemment, voici ce qui
apparait dans la mémoire de l'interprète :\\

\begin{verbatim}
[Enfant
  [struct ..Parent
    Attribute = 42
    Yell = [Functon
      "I am the parent"
    ]
  ]
  Hold = [Function
    "I am holding!"
  ]
]
\end{verbatim}

Constatez donc que ``Parent'' n'est pas tout à fait dans
``Enfant'': il a son propre noeud préfixé d'un ``\verb!.!'' point.
Cette nuance permet à l'interprète d'avoir le comportement
attendu lorsqu'on écrit ensuite :\\

\begin{verbatim}
Main = [Function
  Enfant i

  i.Yell()
  "The attribute is ", i.Attribute, "."
]
\end{verbatim}

Qui affichera bien ``I am the parent'' suivi de ``The attribute is 42.''.
\\

Il est possible d'hériter de plusieurs types. En cas de conflit de nom,
il convient au type enfant de préciser ou mène son interface :\\

\begin{verbatim}
[Guitar
  Name = "The Guitar"
  Play = [Function
    "Blues!"
  ]
]

[Electricity
  Name = "Electricity"
  Play = [Function
    "Buzz!"
  ]
]

[ElectricGuitar : Guitar, Electricity
  Name = .Electricity.Name
  Play = [Function
    Guitar.Play
    Electricity.Play
    "Rock'n roll!"
  ]
]
\end{verbatim}

Si aucune précision n'est fournie, l'interprète lancera
une erreur.

Remarquez que toutes les méthodes sont possible: tant
que l'enfant marque lui-même un champ portant le nom
conflictueux, le problème est résolu. Ainsi, ici,
``\verb!Name!'' est une référence vers le ``\verb!Name!'' de ``\verb!Electricity!''
et Play un champ tout neuf qui va se servir à sa guise
des éléments parents.

Notez qu'il est possible, et cela de la même manière qu'en
C++, de préciser avant le type une règle d'encapsulation:
``\verb!public!'', ``\verb!private!'' ou ``\verb!protected!''. ``\verb!public!'' est
la règle par défaut.

Lors d'un héritage en diamant, les classes mères communes
sont automatiquement aggregée pour n'en former qu'une seule,
à moins de spécifier ``\verb!exclusive!'' comme règle supplémentaire
d'encapsulation.

Lors du stockage d'un type dérivé dans un tableau
ou lorsqu'on le passe en paramètre, il ballade avec lui les
éléments dont il dérivé et la résolution des symboles se fait
par le bas, de ce fait, par nature, tous les éléments sont
``\verb!virtual!'', pour employer un terme C++. Dès lors qu'un élément
existe en aval, il est prioriétaire.

A propos de ``\verb!virtual!'', il existe en C++ les fameuses fonctions
virtuelles pures, qui permettent d'établir un ``\verb!contrat!'', c'est
à dire de modeler une interface sans l'implémenter. J'ignore
si vous vous êtes posé la question, mais bien avant dans ce
livre, je vous ai montré qu'il était possible de déclarer
un champ sans lui assigner de valeur :\\

\begin{verbatim}
[Node
  FirstField
  SecondField
]
\end{verbatim}

Il s'agit ici de simples champs: que se passerait il si ces
champs étaient des fonctions ou des opérations ?\\

\begin{verbatim}
[Node
  integer Func(int x)
]
\end{verbatim}

Comme nous l'avons vu plus haut, un champ contenant une
opération ou une fonction est constant, ainsi il n'est
pas possible de réassigner ce champ... il sembleriat perdu
sans un autre usage. Cet usage est le suivant, il établit
l'obligation de l'existence d'une fonction dans un type
dérivant du type courant. La création d'une instance
d'un type dont les fonctions virtuelles pures n'ont
pas été résolues provoque la levée d'une alerte par
l'interprète.

\section{Constructeur et destructeur}

Par défaut, aucun constructeur ou destructeur n'existe: les champs
sont tels qu'ils ont été défini, considérant qu'il est possible
de leur donner des valeurs par défaut non pas seulement dans
la ``classe mère'' mais également dans les ``classes enfants''.

Il est possible de définir une fonction qui sera appellée
par la fonction de création (Dont il n'a pas encore été sujet
ici) et une autre par la fonction de destruction.

La fonction de construction doit s'appeller ``\verb!Build!'' et
la fonction de destruction ``\verb!Destroy!''. Ces noms de fonction
sont des mot-clefs ne pouvant être utilisé que par les
outils de création et suppréssion de Dabsic.

Les opérations de type ``\verb!operator=!'' ou move constructor
en C++ peuvent être réalisé à partir de surcharge d'opérateurs
``\verb![=]!'' et ``\verb!<-!''.

Il est également possible de définir des fonctions qui
seront appellé en cas d'appel à la fonction de création
en appellant l'une de ses fonctions ``Copy'': celle-ci
devant prendre en paramètre une référence sur une instance
constante du même type qu'elle. Il est également
possible d'en définir pour une construction par déplacement
avec la fonction ``Become'' prenant comme paramètre
une référence sur une instance du même type qui sera
vidé à la fin de l'opération.

Par défaut, aucune de ces fonctions n'existe, ainsi, il
n'est pas utile de les définir afin de faire disparaitre
un éventuel comportement par défaut de l'interprète.
