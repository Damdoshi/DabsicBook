
Ces types sont utilisable sur les champs mais également sur les tableaux:\

\begin{verbatim}
Field = [type Array
  ...
]
\end{verbatim}

Préciser un type impose le respect de ce type à tous les éléments de
celui-ci.

\newpage

\subsection{Addresses et références}

Un champ peut contenir autre chose qu'une valeur et contenir une adresse.
Ce champ est alors un alias sur le champ dont il contient l'adresse. Voici
la syntaxe :\
\begin{verbatim}
[Node = [Array 0 1 2 3 ]
  Integer = 42
  Reference = .Integer
  Index = this[3]
]
Main = [Function
  Print([].Node.Reference, "\n")
  Print(Node.Reference, "\n")
  Print(Node[3], "\n")
  Print(Node.Index, "\n")
]
\end{verbatim}

``Reference'' est une reference sur ``\verb!Integer!''. Appeller la fonction
main va donc afficher deux fois ``\verb!42\n!'' puis deux fois ``\verb!3\n!''.

Notez les deux manières de joindre le champ ``\verb!Reference!'': la première
utilise le symbole ``\verb![]!'' qui en Dabsic correspond à la racine:
l'adresse est donc absolue. La seconde façon utilise le préfixe ``\verb!.!''
et est donc une adresse relative. Il est également possible d'utiliser
le mot-clef ``\verb!this!'' pour représenter le champ courant.
Deux ``\verb!.!'' d'affilé (ou plus) indique une remontée dans la hiérarchie
d'autant de ``\verb!.!'' surnuméraire.

Dans l'exemple précédent, l'adresse est récuperée à partir d'une
adresse litterale, mais ce n'est pas la seule façon : il est également
possible de récuperer une adresse depuis une autre référence :

\begin{verbatim}
[Node
  Integer = 42
  Reference = .Integer
  OtherRef = .Reference
]
Main = [Function
  Print(.Node.OtherRef, "\n")
]
\end{verbatim}

Attention, ici, nous ne créeons pas une référence sur une référence,
mais récupérons simplement l'adresse contenu par ``Reference'' pour
l'assigner à ``OtherReg''. Ainsi, ici, ``Reference'' et ``OtherRef''
sont équivalent tout deux à ``Integer''.

Le typage d'une référence est celui de l'élément pointé et cela en
tous point à l'exception d'un seul : si la référence est stricte,
alors son type ne peut pas être changé lors d'une réassignation
à une autre adresse. Ainsi, même si la référence est censé prendre
le type du champ dont elle a l'adresse, il est possible de créer
des références dédiés à l'aide du mot clef strict, et ainsi obtenir
le comportement du C ou du C++. L'option \verb!-Wall-ref-are-strict! permet
de considérer par défaut que toutes les références sont strictes.

\newpage

Est considéré invalide toute référence ne menant pas à un champ
existant : cela n'empeche pas l'assignation, par exemple :

\begin{verbatim}
Reference = .Field
Main = [Function
  Print(Reference, ``\n'')
  ' Création du noeud [].Field et assignation à 42
  Print(Reference, ``\n'')
]
\end{verbatim}

Par défaut, ce programme génère une erreur et l'execution s'arrête.
Néanmoins, avec l'option \verb!--ignore-bad-ref!, au lieu de s'arrêter,
l'interprète va envoyer une alerte sur la sortie d'erreur et
continuer normalement l'execution. Une valeur par défaut
dépendant du type sera retournée si un type était précisé,
sinon l'état indéfini sera retourné.
Ici, nous aurons donc une erreur sur stderr suivit de ``\verb!42\n!''
sur la sortie standard.\

Il est bien entendu tout à fait possible de vérifier la validité
d'une référence avant d'y avoir accès : le mot-clef ``\verb!valid!'',
utilisable telle une fonction :\

\begin{verbatim}
Shell> ./dabsic
Reference = .Unknown
int Main = [Function
  Return Valid(Reference)
]^D
Shell> echo \$?
0
\end{verbatim}

De plus, le mot-clef \verb!NULL! est disponible afin d'assigner une
adresse invalide à une référence sans avoir à prendre le risque
d'en créer une : \verb!NULL! sera toujours invalide.

Pour finir, gardez à l'esprit qu'une reference est une reference
sur un champ et non sur une valeur et qu'il est donc possible
d'acceder au contenu de celui-ci si il s'agit d'un noeud ou
d'un tableau.

Dans la même veine, un tableau peut très bien être un tableau
de référence... Et être l'élément de base d'un graphe complexe.

\subsection{Specificateurs}

Un champ Dabsic ou une déclaration de tableau peut disposer
de plusieurs propriétés:

\begin{itemize}
  \item \verb!specificator Field = 42 'The value is specified!
  \item \verb!Field2 = [specificator Array ... ] 'The array is!
        \verb!                                   'specified!
\end{itemize}
\vspace{\baselineskip}

Voici une liste des spécificateurs:

\begin{itemize}
  \item ``\verb!const!'' interdit toute modification de la valeur du champ
    ou des valeurs contenu par le tableau.
    L'option \verb!-Wconst! indique que par défaut, tous les champs sont
    constants. Notez qu'un tableau constant est solide.
    La constance est extremement importante pour les performences:
    une opération mathématique entre éléments constants fournira
    toujours le même résultat, donc il sera possible de ne pas
    recalculer le résultat la prochaine fois!
    \vspace{\baselineskip}
  \item ``\verb!mutable!'' indique qu'il est possible de modifier la valeur du champ
    ou les valeurs stockés dans le tableau.
    L'option \verb!-Wno-mutable! demande à l'interprète de lancer
    une alerte si ce mot-clef est utilisé.
    \vspace{\baselineskip}

  \item ``\verb!solid!'' indique qu'aucun enfant ne peut être ajouté à
    l'élément solide.
    L'option \verb!-Wsolid! indique que par défaut, tous les champs
    sont solides, ainsi leur forme est fixe après le parsing
    initial.
    ``\verb!solid!'' peut également être utilisé sur une référence pour
    indiquer qu'elle ne peut pas être réassignée.
    \vspace{\baselineskip}
  \item ``\verb!stretchable!'' indique qu'il est possible de créer
    de nouveaux enfants au champ.
    L'option \verb!-Wno-stretchable! demande à l'interprète de lancer
    une alerte si ce mot-clef est utilisé.
    \vspace{\baselineskip}

  \item ``\verb!eternal!'' indique que le champ ne peut pas être supprimé.
    Rendre un champ éternel implique que tous ses parents sont éternels.
    L'option \verb!-Weternal! indique que tous les champs sont éternels.
    Un tableau eternel est solide.
    Pour information, la racine est éternelle.
    \vspace{\baselineskip}
\end{itemize}

Le symbole ``\verb|!|'' placé immédiatement après le spécificateur indique
que celui-ci doit être étendu aux enfants : par défaut, la portée
est limitée au champ seul. Les références ne sont bien entendus
pas traversé par ces specificateurs étant donné que ce qu'ils
poitent n'est pas néccessairement enfant du champ.\

Pour arrêter la propagation récursive de ces specificateurs, il est
bien entendu possible d'utiliser le specificateur inverse avec
l'opérateur de récursion ``\verb|!|'' mais également en utilisant ces
mot-clefs qui annulent l'effet de specificateur par famille :\

\begin{itemize}
  \item ``\verb!default_write_access!'', ou ``\verb!defaultwriteaccess!'' indique
    qu'il faut restorer les droits d'écriture par défaut de l'interprète.
    L'option \verb!-Wno-default-write-access! demande à l'interprète de
    lancer une alerte si ce mot-clef est utilisé.
    \vspace{\baselineskip}
  \item ``\verb!default_solidity!'', ou ``\verb!defaultsolidity!'' indique
    qu'il faut restorer la solidité par défaut de l'interprète.
    L'option \verb!-Wno-default-solidity! demande à l'interprète de
    lancer une alerte si ce mot-clef est utilisé.
    \vspace{\baselineskip}
\end{itemize}

Ces mot-clefs sont à utiliser ou non avec l'opérateur de récursion ``\verb|!|''.

Je ne recommande pas l'utilisation massive de constructions
utilisant la récursion de specificateur puis l'annulation etc. car
cela génère un suivi complexe. Néanmoins si vous en avez besoin,
c'est possible.

\newpage

\subsection{Opérations}

Dabsic permet de ne pas se contenter d'écrire des valeurs
littérales ou des adresses : il est tout à fait possible
d'écrire des opérations à la place de simples valeurs.\

Vous remarquerez que ces opérations sont finalement des
fonctions d'une unique ligne. Voici quelques exemples :

\begin{verbatim}
' Defining things
Answer = 42
Offset = 1

' Fields I will use
TheAnswer = Answer
ModAnswer = (Answer + Offset) * 3
\end{verbatim}
\vspace{\baselineskip}
\newpage

Un très large ensemble d'opérateurs sont disponibles et utilisables.
Voici une liste des opérateurs binaires disponibles par ordre croissant de priorité:\

\begin{tabular}{c|c|c|c}
  \hline
  Priorité & Symbole & Sens de lecture & Description\
  \hline
  0 & ``\verb!,!'' & \verb!->! &
  Effectue les opérations dans l'ordre et retourne l'opérande le plus à droite.
  Ce sens d'execution est différent de celui du C et de ses héritiers.
  \
  %
  \hline
  %
  1 & ``\verb!=!'', ``\verb!:=!'', ``\verb!equal!'', ``\verb!égal!'' &
  Assigne l'opérande de droite à l'opérande de gauche.
  Retourne l'opérande de gauche.
  \
  %
  1 & ``\verb!<-!'', ``\verb!become!'', ``\verb!devient!'' &
  Déplace l'opérande de droite vers l'opérande de gauche. Dans les faits, l'opérande
  de droite est maintenant indéfini et l'opérande de gauche dispose de sa valeur.
  \
  %
  1 & ``\verb![=]!'', ``\verb![All=]!'' & \verb!<-! &
  Assigne récursivement tous les champs contenu par le champ de droite au champ de gauche.
  Le champ lui-même est assigné.
  Retourne l'opérande de gauche.
  \
  %
  1 & ``\verb![A=]!'', ``\verb![Array=]!'' & \verb!<-! &
  Assigne récursivement tous les champs contenu par le tableau du champ de droite au
  tableau du champ de gauche.
  Retourne l'opérande de gauche.
  \
  %
  1 & ``\verb![H=]!'', ``\verb![Hash=]!'' & \verb!<-! &
  Assigne récursivement tous les champs contenu par le noeud du champ de droite au
  noeud du champ de gauche.
  Retourne l'opérande de gauche.
  \
  %
  1 & ``\verb!||=!'', ``\verb!or=!'', ``\verb!ou=!'' & \verb!<-! &
  Assigne à l'opérande de gauche le résultat de l'opération gauche \verb!||! droite.
  Retourne l'opérande de gauche.
  \
  %
  1 & ``\verb!^^=!'', ``\verb!xor=!'', ``\verb!oux=!'' & \verb!<-! &
  Assigne à l'opérande de gauche le résultat de l'opération gauche \verb!^^! droite.
  Retourne l'opérande de gauche.
  \
  %
  1 & ``\verb!&&=!'', ``\verb!and=!'', ``\verb!et=!'' & \verb!<-! &
  Assigne à l'opérande de gauche le résultat de l'opération gauche \verb!&&! droite.
  Retourne l'opérande de gauche.
  \
    %
  1 & ``\verb!|=!'' & \verb!<-! &
  Assigne à l'opérande de gauche le résultat de l'opération gauche \verb!|! droite.
  Retourne l'opérande de gauche.
  \
  %
  1 & ``\verb!^=!'' & \verb!<-! &
  Assigne à l'opérande de gauche le résultat de l'opération gauche \verb!^! droite.
  Retourne l'opérande de gauche.
  \
  %
  1 & ``\verb!&=!'' & \verb!<-! &
  Assigne à l'opérande de gauche le résultat de l'opération gauche \verb!&! droite.
  Retourne l'opérande de gauche.
  \
  %
  1 & ``\verb!<<=!'' & \verb!<-! &
  Assigne à l'opérande de gauche le résultat de l'opération gauche \verb!<<! droite.
  Retourne l'opérande de gauche.
  \
  %
  1 & ``\verb!\>\>\=!'' & \verb!<-! &
  Assigne à l'opérande de gauche le résultat de l'opération gauche \verb!>>! droite.
  Retourne l'opérande de gauche.
  \
  %
  1 & ``\verb!+=!'' & \verb!<-! &
  Assigne à l'opérande de gauche le résultat de l'opération gauche \verb!+! droite.
  Retourne l'opérande de gauche.
  \
  %
  1 & ``\verb!-=!'' & \verb!<-! &
  Assigne à l'opérande de gauche le résultat de l'opération gauche \verb!-! droite.
  Retourne l'opérande de gauche.
  \
  %
  1 & ``\verb!*=!'' & \verb!<-! &
  Assigne à l'opérande de gauche le résultat de l'opération gauche \verb!*! droite.
  Retourne l'opérande de gauche.
  \
  %
  1 & ``\verb!/=!'' & \verb!<-! &
  Assigne à l'opérande de gauche le résultat de l'opération gauche \verb!/! droite.
  Retourne l'opérande de gauche.
  \
  %
  1 & ``\verb!\%=!'' & \verb!<-! &
  Assigne à l'opérande de gauche le résultat de l'opération gauche \verb!\%! droite.
  Retourne l'opérande de gauche.
  \
  %
  1 & ``\verb!**=!'' & \verb!<-! &
  Assigne à l'opérande de gauche le résultat de l'opération gauche \verb!**! droite.
  Retourne l'opérande de gauche.
  \
  %
  1 & ``\verb!#=!'' & \verb!<-! &
  Assigne à l'opérande de gauche le résultat de l'opération gauche \verb!#! droite.
  Retourne l'opérande de gauche.
  \
  %
  \hline
  %
  2 & ``\verb!?!'' ``\verb!:!'' & -> &
  Effectue un test sur l'opérande de gauche de ``\verb!?!'', si celui ci est vrai, alors
  l'opérande situé entre ``\verb!?!'' et ``\verb!:!'' est executé et retourné, sinon c'est
  celui à droite de ``\verb!:!''.\
  %
  \hline
  %
  3 & ``\verb!||!'', ``\verb!.OR.!'', ``\verb!or!'', ``\verb!ou!'' & \verb!->! &
  Effectue l'opération \verb!OU INCLUSIF! entre l'évaluation comme booléen de
  l'opérateur de gauche et l'évaluation comme booléen de l'opérateur de droite.
  L'opérande de droite n'est pas évaluée si l'opérande de gauche est vrai.
  Retourne un booléen contenant le résultat.\
  %
  3 & ``\verb!^^!'', ``\verb!.XOR.!'', ``\verb!xor!'', ``\verb!oux!'' & -> &
  Effectue l'opération \verb!OU EXCLUSIF! entre l'évaluation comme booléen de
  l'opérateur de gauche et l'évaluation comme booléen de l'opérateur de droite.
  Retourne un booléen contenant le résultat.\
  %
  \hline
  %
  4 & ``\verb!&&!'', ``\verb!.AND.!'', ``\verb!and!'', ``\verb!et!'' & \verb!->! &
  Effectue l'opération \verb!ET! entre l'évaluation comme booléen de
  l'opérateur de gauche et l'évaluation comme booléen de l'opérateur de droite.
  L'opérande de droite n'est pas évaluée si l'opérande de gauche est faux.
  Retourne un booléen contenant le résultat.\
  %
  \hline
  %
  5 & ``\verb!==!'', ``\verb!.EQ.!'', ``\verb!equal to!'', ``\verb!égal à!'' & \verb!->! &
  Teste l'égalité entre l'opérateur de gauche et de droite.
  Retourne un booléen contenant le résultat.\
  %
  5 & ``\verb|!=|'', ``\verb!<\>!'', ``\verb!.NE.!'', ``\verb!unlike!'', ``\verb!différent de!'' & \verb!->! &
  Teste la différence entre l'opérateur de gauche et de droite.
  Retourne un booléen contenant le résultat.\
  %
  5 & ``\verb!<=!'', ``\verb!.LE.!'' & \verb!->! &
  Teste que l'opérateur de gauche est inférieur ou égal à celui de droite.
  Retourne un booléen contenant le résultat.\
  %
  5 & ``\verb!>=!'', ``\verb!.GE.!'' & \verb!->! &
  Teste que l'opérateur de gauche est supérieur ou égal à celui de droite.
  Retourne un booléen contenant le résultat.\
  %
  5 & ``\verb!<!'', ``\verb!.LT.!'', ``\verb!lesser than!'', ``\verb!inférieur à!'' & \verb!->! &
  Teste que l'opérateur de gauche est inférieur à celui de droite.
  Retourne un booléen contenant le résultat.\
  %
  5 & ``\verb!\>!'', ``\verb!.GT.!'', ``\verb!greater than!'', ``\verb!supérieur à!'' & \verb!->! &
  Teste que l'opérateur de gauche est supérieur à celui de droite.
  Retourne un booléen contenant le résultat.\
  %
  \hline
  %
  6 & ``\verb!|!'' & \verb!->! &
  Effectue une opération \verb!OU INCLUSIF bit à bit! entre l'opérande de gauche et de droite.
  Cette opération n'est possible que sur des entiers. Retourne un entier.\
  %
  6 & ``\verb!^!'' & \verb!->! &
  Effectue une opération \verb!OU EXCLUSIF bit à bit! entre l'opérande de gauche et de droite.
  Cette opération n'est possible que sur des entiers. Retourne un entier.\
  %
  \hline
  %
  7 & ``\verb!&!'' & \verb!->! &
  Effectue une opération \verb!ET bit à bit! entre l'opérande de gauche et de droite.
  Cette opération n'est possible que sur des etniers. Retourne un entier.\
  %
  \hline
  %
  8 & ``\verb!<<!'' & \verb!->! &
  Cette opération peut être effectuée sur une chaine de caractère à gauche et
  un entier à droite ou deux entiers.
  Si il s'agit de deux entiers, il s'agit d'un décalage binaire vers la gauche.
  Si il s'agit d'une chaine de caractère et d'un entier, il s'agit d'un décalage
  à gauche des caractères.
  Les excedents sont tronqués.
  Cette opération retourne un résultat du même type que l'opérande de gauche.\
  %
  8 & ``\verb!\>>!'' & \verb!->! &
  Cette opération peut être effectuée sur une chaine de caractère à gauche et
  un entier à droite ou deux entiers.
  Si il s'agit de deux entiers, il s'agit d'un décalage binaire vers la droite.
  Si il s'agit d'une chaine de caractère et d'un entier, il s'agit d'un décalage
  à droite des caractères.
  Les excedents sont tronqués.
  Cette opération retourne un résultat du même type que l'opérande de gauche.\
  %
  \hline
  %
  9 & ``\verb!+!'' & \verb!->! &
  Cette opération effectue une addition entre l'opérande de gauche et l'opérande
  de droite. Le résultat est du type de l'opérande de gauche. Cette opération
  n'est possible que sur des entiers et des réels.\
  %
  9 & ``\verb!-!'' & \verb!->! &
  Cette opération effectue une soustraction entre l'opérande de gauche et l'opérande
  de droite. Le résultat est du type de l'opérande de gauche. Cette opération
  n'est possible que sur des entiers et des réels.\
  %
  \hline
  %
  10 & ``\verb!*!'', ``\verb!x!'' & \verb!->! &
  Cette opération effectue une multiplication entre l'opérande de gauche et l'opérande
  de droite. Le résultat est du type de l'opérande de gauche. Cette opération
  n'est possible que sur des entiers et des réels.\
  %
  10 & ``\verb!/!'', ``\verb!:!'' & \verb!->! &
  Cette opération effectue une division entre l'opérande de gauche et l'opérande
  de droite. Le résultat est du type de l'opérande de gauche. Cette opération
  n'est possible que sur des entiers et des réels.\
  %
  10 & ``\verb!\%!'' & \verb!->! &
  Cette opération effectue un modulo entre l'opérande de gauche et l'opérande
  de droite. Le résultat est du type de l'opérande de gauche. Cette opération
  n'est possible que sur des entiers et des réels.\
  %
  \hline
  %
  11 & ``\verb!**!'', ``\verb!pow!'' & \verb!->! &
  Cette opération effectue un modulo entre l'opérande de gauche et l'opérande
  de droite. Le résultat est du type de l'opérande de gauche. Cette opération
  n'est possible que sur des entiers et des réels.\
  %
  \hline
  %
  12 & ``\verb!#!'' & \verb!->! &
  Cette opération concatène l'opérande de gauche avec l'opérande de droite.
  Le résultat est une chaine de caractère. Cette opération est possible
  avec tous les types.
  Cette opération est conçu de manière à ne créer qu'une seule chaine
  finale et aucune chaine intermédiaire (à l'exception des résidu de
  conversion des opérandes).\
  %
  \hline
  %
\end{tabular}

Attention: Tous les opérateurs binaires précisés précédemment doivent être
précédé et suivi d'un espace.

Un ensemble d'opérateur unaire et spéciaux sont également disponibles.


%%%%%%%%%%%%%%%%%%%%%%%% ON NE PEUT PAS FAIRE DE ITEMIZE DANS UN TABLEAU
%%%%% ON CHECKERA PLUS TARD
%%%%%%%%%%%%%%%%%%%%%%%%%%%%
\begin{tabular}{c|c}
  \hline
  Symbole & Description\
  \hline
  ``\verb!+!'' & L'opérateur unaire \verb!+! à son sens mathématique, il conserve le signe de son opérande.\
  %
  ``\verb!-!'' & L'opérateur unaire \verb!-! à son sens mathématique, il inverse le signe de son opérande.\
  %
  ``\verb![]!'' & L'opérateur crochet dispose de deux sens. Il peut s'utiliser de deux différentes façons :
%  \begin{itemize}
%    \item variable = field[42]
%    \item
%	Client = ``Gerard''
%      [Gerard
%        Age = 42
%        
%      ]
%      [Charles
%        Age = 23
%      ]
%      AgeClient = [Client].Age
%  \end{itemize}
  
  La première ligne est un usage traditionnel de l'opérateur crochet: pour accéder à un index
  de tableau.
  La seconde est l'équivalent d'un accès à un attribut/champ d'une structure ou ici en
  l'occurence de l'arbre Dabsic, mais à la place de le définir littéralement, une
  indirection est crée à l'aide d'une variable.
  Ce comportement rappellera certainement celui des références. A défaut d'être totalement
  efficace, il est néanmoins plus facile à comprendre pour les débutants.

  Le champ (donné directement ou via une opération) peut contenir une série
  d'indirection type ``Gerard.Champ.AutreChamp''. Si la valeur contenue
  est invalide, alors le programme s'arrête. Il est possible de forcer
  le programme à continuer avec l'option --ignore-bad-address, en ce cas,
  le programme reprend à la ligne suivante et écrit un message d'erreur
  sur la sortie d'erreur.
  Si le champ visé n'existe pas, le même comportement intervient et
  peut-être désactivé de la même manière, néanmoins le message d'erreur
  sera différent.
  \
  %
  ``\verb!()!'' & L'opérateur parenthèse, à moins d'être disposé directement à la suite d'une opérande
  dispose de son sens de mathématique et agit comme modificateur de priorité de l'opération.
  
  Dans le cas contraire, il s'agit de l'opérateur d'appel de fonction.
  
  Notez qu'en Dabsic, cet opérateur est optionnel si la fonction ne prend pas de paramètre
  (Il s'agit par exemple d'un simple champ contenant une opération). Il est également
  optionnel si la fonction n'en prend qu'un seul et que l'appel est effectué avec
  l'apparence d'une assignation (En utilisant ``= A'' plutôt que ``(A)'').

  Le contenu de ces parenthèses lors d'un appel de fonction peut être disposé de deux
  façons distinctes:
%  \begin{itemize}
%    \item A la manière du C, en séparant les paramètres et en les placant dans l'ordre
%      défini de la fonction: MaFonction(a, b, c)
%      
%      De cette manière, les paramètres optionnels peuvent être demandé en ne placant
%      tout simplement rien comme paramètre: MaFonction(a, , c)
%    \item A la manière du Logo, en placant devant chaque paramètre son nom suivi de
%      l'opérateur ``='' et dans ce cas, l'ordre n'a aucune importance, et pour
%      spécifier l'utilisation d'un paramètre optionnel, il suffit de ne pas spécifier
%      le paramètre: MaFonction(premier=a, dernier=c)
%  \end{itemize}
  \
  %
  ``\verb!(type)!'', ``\verb!type()!'' & L'opérateur de conversion permet de forcer la modification
  d'un type. La conversion est toujours effectuée, même si celle-ci est falacieuse.
  Dans le cas d'une conversion invalide, le pavillon d'erreur est levé et peut-être
  attrapé par la structure de contrôle adaptée comme décrit plus bas dans la
  section des structure de contrôle.
  La première syntaxe est celle du C et de ses dérivés: on place l'opérateur en préfixe.
  La seconde syntaxe est celle des langages fonctionnels, on utilise le type comme
  une fonction.
  Le résultat est le même et une pure préférence.
  La constance est transmise telle quelle.\
  %
  \hline
  %
\end{tabular}

Certains ``operateur'' (dans le sens, opérateur comme sizeof en C) sont également
disponible:

\begin{tabular}{c|c}
  \hline
  Symbole & Description\
  \hline
  %
  ``\verb!valid()!'' & L'opérateur de validité retourne un booléen indiquant si la référence
  passée en paramètre est valide ou non. Si la référence est solide et que le champ
  pointé est éternel, alors le booléen sera constant.\
  %
  ``\verb!array_size()!'', ``\verb!arraysize()!'', ``\verb!size()!'' & Cet opérateur de mesure retourne un entier
  contenant la taille du tableau du champ. Cet entier est constant si le tableau est solide.\
  %
  ``\verb!hash_size()!, ``\verb!hashsize()!'' & Cet opérateur de mesure retourne un entier contenant
  le nombre d'élément dans la table du champ. Cet entier est constant si la table est solide.\
  %
  ``\verb!name()!'' & Cet opérateur retourne une chaine de caractère contenant le nom du champ,
  une alerte est lancé si le champ ne dispose pas de nom.\
  %
  ``\verb!index()!'' & Cet opérateur retourne l'index où est situé le champ,
  une alerte est lancé si le champ ne dispose pas d'index.\
  %
  ``\verb!is_read()!'', ``\verb!isread()!'' & Cet opérateur retourne un booléen indiquant si le champ courant est
  en train d'être lu.\
  %
  ``\verb!is_written()!'', ``\verb!iswritten()!'' & Cet opérateur retourne un booléen indiquant si le champ courant
  est en train d'être écrit.\
  %
  \hline
  %
\end{tabular}

%\begin{tabular}{c|c}

Un spécificateur spécifique aux opérations et fonctions est disponible,
il s'agit du spécificateur ``pure''. Une opération pure indique un
ensemble de chose:

\begin{itemize}
  \item Toutes les fonctions, opérations, champs appelées ou lus par
    l'opération courante sont purs et éternels.
  \item Aucune assignation n'est effectuée par l'opération en dehors
    des variables locales (si celle-ci est une fonciton) et de la
    valeur de retour. Les paramètres ne sont pas modifié si ce sont
    des références.
\end{itemize}

Notez qu'une valeur constante est pure par définition.

Il est possible d'utiliser le mot-clef ``record'' sur une fonction pure.
Celui-ci demande à l'interprète de garder en mémoire les résultats déjà
calculés de la fonction. Utilisez ce mot-clef avec parcimonie afin de
ne pas stocker des résultats inutiles si votre fonction peut prendre
une très large variété de paramètre: ils seront tous enregistré!

Il n'est pas utile d'utiliser ``record'' si la fonction ne prend pas de
paramètre: le résultat est stocké par nature grace au mécanisme
d'optimisation lié à la constance.

Un champ contenant une opération/fonction est constante. Ainsi, il n'est pas possible
d'écraser une opération en la remplacant par une valeur ou une autre
opération. Il est néanmoins possible d'utiliser l'opérateur d'assignation ``\verb!=!''
sur une opération si celle-ci comporte un unique paramètre. L'opérande
de droite est alors passée en paramètre à l'opération.

Dernier détail: si vous souhaitez indiquer qu'une opération ne retourne rien,
il vous suffit d'écrire void: l'interprète lancera une alerte si vous
cherchez à récuperer une éventuelle valeur retournée.

\subsection{Paramètres}

La valeur d'un champ peut donc être fonction d'une opération.
Cette opération peut prendre des paramètres, ceux-là sont définis à la suite
du nom du champ:\

\verb!int Field(int x) = x + 1!\

La déclaration des variables est tout à fait similaire à la déclaration
du contenu d'une table, à la différence qu'il est possible d'utiliser
l'opérateur ``\verb!,!'' virgule pour chainer les déclarations.

Les paramètres pouvant également être des tableaux, afin de specifier
qu'un tableau est attendu, il est possible d'utiliser le mot-clef
``\verb!array!'' en complément des autres mot-clefs disponibles (type,
etc.). Ajouter des crochets à la fin du nom de la variable indique
également qu'il s'agit d'un tableau.
Il est de plus possible de préciser des informations à propos de
ce tableau:

\begin{itemize}
  \item ``\verb![0-42]!'' indique une taille entre 0 et 42.
  \item ``\verb![-50]!'' indique une taille maximale de 50.
  \item ``\verb![84]!'' ou ``\verb![84-]!'' indique une taille minimale de 84.
  \item ``\verb![]!'' ou une absence de crochet indique que n'importe
    quel taille est valide. Notez que du coup, un champ n'étant
    pas un tableau peut-être donnée et la précision ``array''
    est purement sémantique car aucune vérification ne saurait
    être faite.
\end{itemize}

Les paramètres pouvant également être des table, il est possible
de specifier un type construit, cela amènera l'interprète à faire
un test de compatibilité entre le champ envoyé et le type.

Il est possible de préciser qu'un paramètre est passé par référence
en ajoutant le symbole ``\verb!.!'' en préfixe de nom de variable.

Ainsi, il est possible d'écrire:

\begin{itemize}
  \item Quelques fonctions simples:
    \verb!void PutPixel(int pixels[], int x, int y, int w, int color) := pixels[x + w * y] = color!
    \verb!void Factoriel(int n) := n <= 1 ? 1 : n * Factoriel(n - 1)!
  \item Une fonction avec des paramètres par défaut:
    \verb!pure int Mul(int x = 0, int y = 0) := x * y!
  \item Une fonction avec des références en paramètre:
    \verb!void Swap(int .x, int .y) := x = x ^ y, y = x ^ y, x = x ^ y!
\end{itemize}

\subsection{Tableaux}

Comme vu précédemment, la déclaration d'un tableau est la suivante:\

\begin{verbatim}
Field = [Array
  ...
]
\end{verbatim}

Il est possible de préciser un large ensemble de règles de manière
à renforcer l'environnement, y compris la taille du tableau:\

\begin{verbatim}
Field = [hard int Array[20]
  1 2 3 4 5 6 42
]
\end{verbatim}

Ici, un tableau comprenant 20 cellules est créé: celui-ci n'est
pas redimensionnable, ses éléments sont des entiers constant.
Les valeurs non précisées se voient assigner la dernière valeur
renseignée, soit ici 42.\

Les tableaux ne sont pas exclusivement des planches de valeur!
Les éléments indéxés sont des champs, comme le reste, ainsi il
est même possible d'écrire:\

\begin{verbatim}
TheArray = [Array
  [Field
    Data = 42
  ]
  [Field
    Dance = "Jerk"
  ]
  [Field
    CreditRatio = 2.1
  ]
]
\end{verbatim}

Nous avons créé ici un tableau contenant 3 champs indexés. Ces
trois champs sont des tables contenant d'autres champs.
Remarquez ici la ré-utiisation du nom ``Field'': étant
donné que le nom n'est pas utilisé pour indexer ces noeuds,
il est possible d'en avoir plusieurs dans le même scope
avec le même nom et de faire ce genre de chose:\

\verb!string GetName(x) = name(TheArray[x])!\

<?=page_break(); ?>
