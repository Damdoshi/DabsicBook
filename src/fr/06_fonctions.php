
\chapter{Fonctions}

Ce chapitre traite des fonctions et va donc aborder les
structures de contrôle du Dabsic au sein d'une fonction
ainsi que les aspects non déclaratif du langage (Cela a
déjà été fait par la partie Opération, il s'agit ici de
le faire a fond.

\section{Déclarer un champ contenant une fonction}

Comme vous avez pu le voir précédemment, la déclaration
est plutôt simple:\\

\begin{verbatim}
Type Field(Params) = [Function
  ...
]
\end{verbatim}

Le fonctionnement est exactement le même qu'avec une
opération: le type de la valeur est le type de la valeur
de retour de la fonction et il est possible de préciser
des paramètres.

\section{Remplir sa fonction}

Une ligne d'instruction Dabsic s'achève sur un simple saut de ligne.
Pas de ``\verb!;!'' à la manière du C. Si vous souhaitez chainer les opérations,
vous pouvez utiliser l'opérateur virgule ``\verb!,!''.

L'opération la plus simple à réaliser est l'écriture d'une chaine
de caractère littérale sur la sortie standard: il suffit de l'écrire:\\

\begin{verbatim}
Main = [Function
  "Hello, world!"
]
\end{verbatim}

En fait, toutes les lignes d'instruction commencant par une chaine
de caractère en dur sont considérées comme des lignes servant
exclusivement à afficher. Un saut de ligne est ajouté automatiquement
à la fin de chacun de ces instructions. Il est possible d'afficher
d'autres choses que des chaines par la suite: il suffit d'écrire
ce qu'on veut afficher séparé par des virgules:\\

\begin{verbatim}
Age = 42
Main = [Function
  "Bonjour, j'ai ", Age, " ans!"
]
\end{verbatim}

Il est possible de changer de sortie pour les données écrites de
cette manière, il suffit pour cela d'utiliser l'option --straight-output=value
ou value est un file descriptor.

Je rappelle que l'écriture de commentaires se fait avec le caractère ``\verb!\!''.
Le commentaire s'arrête à la fin de la ligne.

\subsection{Déclarer des variables}

Une variable est un champ dont l'existence est lié à l'execution
d'une fonction. Une fois la fonction terminée, la variable disparait.

La déclaration d'une variable est identique à celle d'un champ, à l'exception
du fait qu'elle à lieu dans une fonction:

\begin{verbatim}
Main = [Function
  i

  i = 42
  "J'ai ", i, " ns"
  Return ExitSuccess
]
\end{verbatim}

Déclarer ses variables est obligatoire, à moins de
spécifier \verb!--var-declaration-is-optionnal!.

\subsection{Opérations}

Il est possible bien entendu d'écrire des opérations sur une ligne
d'instruction:

\begin{verbatim}
Main = [Function
  string i

  string = (42 + 37 * 3) # " petits cochons\n"
  Print(i)
  Return ExitSuccess
]
\end{verbatim}

\subsection{Scopes}

Différents scopes ou ``point de vue'' sont considérable depuis
l'intérieur d'une fonction. Qu'est ce que cela change?

C'est très simple: lorsque nous cherchons à accéder à une
variable, à un champ, il arrive que des symboles soient
identique, et dans ces cas la, il est important de définir
qui a la priorité.

A la manière du C, en Dabsic, c'est l'élément le plus proche
qui a la priorité. Voici l'ordre:

\begin{itemize}
  \item Variables locales d'une fonction.
  \item Champs issu du point de vue articiel (Mot-clef ``\verb!With!'').
  \item Champs issu du point de vue du champ contenant la fonction.
  \item Champs issu du point de vue de la racine.
\end{itemize}

Si nous sommes dans ce cas-ci:\\

\begin{verbatim}
Field = 84
[Node
  Field = 21
  Func = [Function
    Field = 42

    "My value is ", Field
  ]
]
\end{verbatim}

Executer Func affichera 42. Si l'on retire juste la
déclaration de variable locale, alors cela affichera 21.
Si on retire également \verb![].Node.Field!, alors cela affichera
84.
    
\section{Les conditions}

\subsection{Conditions métier}

Les structures de contrôle classiques sont bien entendu
disponible. Voici la syntaxe du bloc conditionnel:\\

\begin{verbatim}
Field(x) = [Function
  If x == 0
    ``x vaut 0''
    Return
  EndIf
  If x == 1
    ``x vaut 1''
  ElseIf (x == 2)
    ``x vaut 2''
  Else
    ``x vaut '', x
  EndIf
]
\end{verbatim}

Les mot-clefs ``\verb!if!'' et ``\verb!si!'' sont disponibles pour
ouvrir la condition. ``\verb!elseif!'', ``\verb!elif!'', ``\verb!sinonsi!'',
``\verb!ousi!'' pour chainer une condition et ``\verb!else!'', ``\verb!sinon!''
pour le cas où toutes les conditions précedentes étaient
fausses.

Les mot-clefs ``\verb!endif!'', ``\verb!finsi!'' ferment le bloc
conditionnel.

\subsection{Conditions d'erreur}

Il existe en Dabsic un cas particulier de condition:
les conditions de rattrapage d'erreur. Celle-ci sont
une réponse à un cas fréquent source d'erreur dans de
nombreux langages.
Prenons comme exemple le cas du C en programmation système:

\begin{itemize}
  \item Une variété de fonctions retourne un état,
    à la manière des appels système et donc retourne 0 en
    cas de succès et une autre valeur (souvent négative,
    typiquement -1) en cas d'erreur.
  \item Une variété de fonctions retourne un entier
    dont la valeur d'erreur est 0.
  \item Une variété de fonctions retourne un entier
    dont aucune valeur n'est une valeur d'erreur
    et il faut vérifier errno.
\end{itemize}

Toutes ces fonctions retournent un int!

Bien entendu, il est possible de vérifier errno directement
et systématiquement, mais cela entre en conflit avec
une habitude d'écriture solide et répandue, à savoir:\\

\begin{verbatim}
int main(void)
{
  int fd;

  if ((fd = open("file", O_RDONLY)) == -1)
    return (EXIT_FAILURE);
  return (EXIT_SUCCESS);
}
\end{verbatim}

Cette manière d'écrire combine la partie active et
la partie gestion d'erreur de manière concise.

Notez que \verb!EXIT_FAILURE! va valoir 1 sur une large
variété de système et \verb!EXIT_SUCCESS! 0, ce qui est
encore une posture différente de celles évoqués
précédemments...
\\
Plusieurs langages tel Go ont pris la décision
de permettre aux fonctions de renvoyer plusieurs
valeurs. De même, en C++, il est possible de renvoyer
des pairs, par exemple.
Je trouve, personnellement, que bien que ces solutions
présentent un certain interet, je ne parviens pas à
me faire au sens qu'elles auraient en C, à savoir,
faire retourner d'une fonction une structure a deux éléments
contenant deux informations...
Le concept, l'idée de errno me plait et si il
présente certains désavantages peut certainement
s'améliorer dans le cadre d'un langage de plus
haut niveau.
\\
De ce fait, afin de régler ce problème, Dabsic met en place
une méthode de bloc conditionnel spécifique à
la gestion d'erreur, ainis, on peut écrire:\\

\begin{verbatim}
string ReadFile(string file) = [Function
  String str
  Int fd

  OnError fd = Open(file)
    "Cannot open file", file
    Return ""
  EndError
  ...
  Return str
]
\end{verbatim}

Ici, nous avons une fonction qui prend en paramètre une
chaine de caractère contenant un nom de fichier et
qui tente de l'ouvrir.

La fonction open dispose de deux sorties: sa valeur
retournée et la valeur d'erreur. Le bloc conditionnel
``\verb!OnError!'' fonctionne comme un ``\verb!If!'', à la différence
qu'il travaille sur la valeur d'erreur... en terme
simple, il va donc vérifier errno.

Il y a tout de même une difference avec une simple
verification de errno dans le sens où il n'y a pas
besoin d'écraser ce ``\verb!errno!'' en cas du succès pour
s'assurer d'une compréhension du langage, des mot-clefs
sont présent pour expliciter un certain ensemble de choses.

\begin{itemize}
  \item ``\verb!Return!'' a en effet un sens supplémentaire
    par rapport aux autres langages: il signifie renvoyer
    une valeur ET tout s'est bien passé.
    
  \item ``\verb!Report!'' ne retourne pas de valeur mais indique
    qu'une erreur s'est produite et qu'aucun traitement
    (excepté des messages d'erreurs) n'ont été effectué
    pour récuperer sur cette erreur.

    Tous les messages écrits par ailleurs entre une
    erreur jusqu'à un ``Return'' sont loggés par Dabsic
    comme faisant partie de l'explication de l'erreur.

    ``\verb!Report!'' prend une adresse vers un objet de type
    ``\verb!Error!'' en paramètre. Plus d'informations vous
    seront donné sur cet objet plus bas dans ce livre.
    Il est possible d'omettre ce paramètre afin de
    renvoyer le code erreur de la fonction ayant échoué
    ainsi que diverses informations.

  \item ``\verb!StartReport!'' demande l'ouverture du logging
    d'erreur: Dabsic comprend qu'on passe en traitement
    d'erreur et va se mettre à logger les messages.
    ``\verb!Report!'' ouvre également le logging d'erreur, si
    il n'est pas déjà ouvert.
    L'information du fichier et de la ligne de l'erreur
    est automatiquement enregistrée lorsque le logging
    s'ouvre.
    Il est possible, tout comme avec ``\verb!Report!'' de
    passer en paramètre un objet. L'unique différence
    étant qu'on ne quitte pas la fonction.
  \item ``\verb!StopReport!'' force l'arrêt du logging d'erreurs.
    Comme vu précédemment, ``\verb!Return!'' provoque le même
    effet.
\end{itemize}

Voici un exemple:\\

\begin{verbatim}
int Open = [Function
  ... Do things ...
  If read_rights == false
    StartReport SystemError.PermissionDenied
    "Permission denied"
    Report
  EndError
  ... Do things ...
  Return fd
]

string LoadFile(string file) = [Function
  int fd

  OnError fd = Open(file)
    "Cannot open file", file
    Report 
  EndError
]

int LoadNumberFromFile(string file) = [Function
  string content

  OnError content = LoadFile(file)
    "Cannot load file", file
    Report MyGame.Cannot
  EndError
]

int Main(string argv[]) = [Function
  int nbr

  If size(argv) <> 2
    "This program needs one parameter."
    Return ExitFailure
  EndIf
  OnError nbr = LoadNumberFromFile(argv[1])
    "Cannot retrieve number from file ", argv[1]
    Return ExitFailure
  EndError
  Return nbr    
]
\end{verbatim}

Si le main reviens dans la fonction l'ayant appellé avec un Report,
l'interprète lèvera une alerte annoncant qu'une erreur n'a pas
été traitée.

Plus d'informations vous seront donné par la suite sur
la gestion d'erreur, principalement les types et autres
mot-clefs disponibles à employer. (Par exemple, parcourir
les logs, récuperer le code erreur, le mot clef ``throw'',
l'enrichissement progressif et automatique du prototype
en fonction des erreurs envoyés non gérées, etc.)

\subsection{Filtre}

Il arrive que dans un programme, un très large de choix
soit possible pour une valeur. Dans ces cas là, il n'est
pas rare de trouver une série de bloc conditionnels se
chainant ou une fourchette type ``switch'' en C.

Personnellement, ma préférence va en général sur le
tableau de pointeurs sur fonctions, et ma valeur est
très souvent de ce fait une énumération. Cela est valable
pour mon C et mon C++, néanmoins, il existe dans d'autres
langages des réponses que je trouve également interessante.

Prenons le cas de trois langages extremement éloigné autant
dans leurs philosophie applicative que dans leur génèse:
Microsoft Visual Basic 6, OCaml et le C.

Nous allons programmer une suite de fibonacci un peu
spéciale: elle utilisera switch et renverra -1 si le
paramètre est supérieur à 10 et inférieur à 20. -2 si
elle est supérieur a 20

Commencons en C:\\

\begin{verbatim}
int fibo(int n)
{
  if (n > 20)
    return (-2);
  if (n > 10)
    return (-1);
  switch (n)
  {
    case 0:
    case 1:
      return (1);
    default:
      return (fibo(n - 1) + fibo(n - 2));
  }
  return (0); /* Never used */
}
\end{verbatim}

En OCaml, il est possible de construire un filtre pour une
valeur, cela ressemble à ceci:\\

\begin{verbatim}
let rec fibo n =
  if (n > 10) (
    if (n > 20)
      -2
    else
      -1
  ) else match n with
    | 0 -> 1
    | 1 -> 1
    | _ -> fibo(n - 1) + fibo( - 2)
    ;;
\end{verbatim}

En Visual Basic:\\

\begin{verbatim}
Function Fibo(ByVal n As Integer) As Integer
  I as Integer

  Select Case
    Case Is > 20
      I = -2
    Case 10 to 20
      I = -1
    Case 0, 1
      I = 1
    Case Else
      I = Fibo(n - 1) + Fibo(n - 2)
  End Select
  Return I
End Function
\end{verbatim}

Faisons les comptes:

\begin{itemize}
  \item En C, il est possible de traiter
    avec le même code deux cas - d'un autre coté, pour
    effectuer des traitements séparés, il faut utiliser
    ``\verb!break!'' ou alors faire comme ici, utiliser ``\verb!return!''.
    Les cas liés à 20 et a 10 doivent être traité séparement
    car il n'est pas possible de traiter des étendues de valeur
    en C avec ``\verb!switch!''.
    De plus, cela n'est pas mit en relief ici, mais il
    n'est pas possible de traiter autre chose que des
    entiers avec ``\verb!switch!''.
    Pour finir, on connait quelques applications originales
    mais détournées du switch, tel que la fameuse Duff's device.
    
  \item En OCaml, il est possible de traiter aisément
    deux cas séparés sans avoir à gérer un retour manuellement,
    que cela soit avec break ou return. (La nature fonctionnelle
    de Ocaml jouant bien entendu un fort rôle).
    De plus, le filtre d'OCaml gère également de nombreux
    types.
    Néanmoins, il n'est pas possible de traiter des
    étendues de valeur.

  \item En Visual Basic 6, chaque cas est parfaitement
    séparé, comme en OCaml. De nombreux types peuvent
    être traités et il est possible de traiter des
    étendues de valeur.
    Il est même possible à la manière du C de spécifier
    plusieurs valeurs pour un même traitement, il suffit
    d'utiliser ``\verb!Case!'' suivit des valeurs séparés par
    des virgules.
\end{itemize}

Bien entendu, il reste préférables d'utiliser un tableau de
pointeurs sur fonctions dans de très nombreux cas car c'est
plus synthétique et que la complexité de l'implémentation
ne laisse aucun doute... Néanmoins le reste du temps, lorsque
nous avons un certain nombre de valeurs à vérifier ainsi
que des étendues, la syntaxe de Visual Basic 6 est à mon
sens la meilleure. Evidemment, elle ne permet pas les mêmes
optimisations, mais pour Dabsic, cela ne devrait pas être
un problème.

Voici donc la syntaxe en Dabsic:\\

\begin{verbatim}
Fibo(int n) = [Function
  int value

  value = Switch (n)
    Case Is > 20
      Return -20
    Case 10 To 20
      Return -10
    Case 0, 1
      Return 1
    Last
      Return Fibo(n - 1) + Fibo(n - 2)
  EndMatch
  Return 1
]
\end{verbatim}

\subsection{Point de vue temporaire}

En C, C++, et dans beaucoup d'autres langages... et a priori,
plus fortement même dans Dabsic, il n'est pas rare d'avoir à
accéder à un élément dans une hiérarchie profonde. Or, tel que
l'a dit Linus (Un homme ayant eu suffisament de volonté pour
créer son propre système d'exploitation malgré les remarques
du type ``Pourquoi ne pas travailler plutôt avec X (Au pif,
GNU ou n'importe quel BSD de l'époque)'', ou ``Pourquoi
réinventer la roue? (Comme si le pneu avait été inventé direct)''):\\

\begin{verbatim}
[..] Things like twenty lines of

foobar[(index + 1) % BLAH]->spork.vomit[12]->field_name = <expr>;
\end{verbatim}

with the only difference in the \verb!field_name!, except for one line where
we have a typo and see 11 instead of intended 12, are responsible for quite
a few of such overruns.\\

Ce genre de construction est sujette aux erreurs, sans parler
du fait que sans manipulations du compilateur (si elles existent),
un tel code serait sous-optimal du fait de ses répétitions.

Ainsi, la solution la plus habituelle consiste à créer une
variable locale qui retiendra la destination et à s'en servir
comme ``raccourci'', ainsi:\\

\begin{verbatim}
MyCpp().Really()[47].Looks->Like.Java = -42;
MyCpp().Really()[47].Looks->Like.Shit = -42;
\end{verbatim}

Devient:\\

\begin{verbatim}
Type &big = MyCpp().Really()[47].Looks->Like;

big.Java = -42;
big.Shit = -42;
\end{verbatim}

Ce qui est plus court, moins sujet à l'erreur et plus rapide.
Cette pratique est tout à fait correcte, néanmoins, je tiens
à ajouter un autre design remplissant cette tache. Ce design
provient lui-aussi de Visual Basic.

Etant donné que Dabsic propose une structure hiérarchique
plutôt simple où tout est dans quelque chose, jusqu'à remonter
à la racine, il est possible d'effectuer ceci:\\

\begin{verbatim}
[I
  [Have
    [A
      [Very
        [Long
          [Hiearchy
            Word
            AnotherWord
            [Again
              DeepDeepness
            ]
          ]
        ]
      ]
    ]
  ]
]

Main = [Function
  With I.Have.A.Very.Long.Hierarchy
    Word = 42
    AnotherWord = 84
  EndWith
]
\end{verbatim}

Ce qui vous rappellera certainement ``\verb!using!'' en C++ mais
est syntaxiquement plus proche du propre mot-clef ``\verb!With!''
de Visual Basic.

Il est possible d'inclure des blocs ``\verb!With!'' dans d'autres,
mais dans ce cas, attention: cela déplace le point de vue
à nouveau! De ce fait, certains appels ne sont plus possible,
contrairement à ``\verb!using!'' qui permet de mélanger plusieurs
points de vue:\\

\begin{verbatim}
Main = [Function
  With I.Have.A.Very.Long.Hierarchy
    Word = 42
    AnotherWord = 84
    With Again
      DeepDeepness = 168 'Valide
      Word = -42 'Invalide!
    EndWidth
  EndWith
]
\end{verbatim}

L'appel au champ Word devient invalide car le point dans vue
a été déplacé dans Again par ``\verb!With!''.

Ce point de vue est un point de vue supplémentaire, s'ajoutant
aux autres: le point de vu local, associé à la position
de la fonction reste valide, de même que le point de vue
artificiel lié à l'héritage si vous êtes dans un objet (Voir plus bas)

\section{Les boucles}

\subsection{Boucle simple}

Comme dans tous langage de programmation, il existe en
Dabsic le moyen d'effectuer un traitement répétitif.
Voici une boucle simple:\\

\begin{verbatim}
Field(int n) = [Function
  int i

  i = 0
  While i < n do
    "n='', i
    i += 1
  EndWhile
]
\end{verbatim}

La foncton prend en paramètre un nombre de tour à faire et
affiche a chaque tour le numéro du tour.

Le mot-clef ``\verb!do!'' n'est pas optionnel. Il permet
la distinction entre cette boucle et la boucle détaillée
dans la partie suivante.

Les mot-clefs ``\verb!while!'', ``\verb!tantque!'' sont disponibles
pour ouvrir le bloc de la boucle, ``\verb!do!'' et ``\verb!repete!'' pour
fermer la condition, tandis que ``\verb!endwhile!'',
``\verb!wend!'' et ``\verb!fintantque!'' ferment la boucle.

\subsection{Boucle à un cas minimum}

Dans une boucle simple, le test pour boucler est effectuée
dès le départ, avant même l'entrée dans la boucle.
Il est parfois utile de placer ce test à la fin, de manière
à assurer l'execution de l'intérieur de la boucle au moins
une fois:\\

\begin{verbatim}
Field(int n) = [Function
  int i

  i = 0
  Do
    ``n='', i
    i += 1
  While i < n
]
\end{verbatim}

Cette fonction affichera toujours au moins ``\verb!n=0!''.

\subsection{Boucle à intervale}

La boucle à intervale combine les trois aspects
les plus fréquents des boucles: l'initialisation,
la comparaison et la modification:\\

\begin{verbatim}
Field(int n) = [Function
  int i

  For i = 0 To i < n Step n += 1
    ``n='', i
  EndFor
]
\end{verbatim}

Cette fonction fait exactement la même chose que cette
de la boucle simple décrite précédemment mais est plus
concise.

Les mot-clefs ``\verb!for!'' et ``\verb!pour!'' peuvent ouvrir la boucle,
``\verb!to!'' et ``\verb!à!'' préfixent la condition, ``\verb!step!'' et ``\verb!pas!''
déterminent la modification à effectuer sur la variable
de boucle et enfin ``\verb!endfor!'', ``\verb!next!'', ``\verb!finpour!'' ou
``\verb!suivant!'' terminent la boucle.

\subsection{Boucle sur contenu}

Une boucle sur contenu est une manière de parcourir
une table ou un tableau de manière très simple, sans
avoir à définir de variables ou de pas:\\

\begin{verbatim}
Array = [Array 0 1 2 3 4 5 ]

Count(a) = [Function
  int i = 0

  Foreach[] a as b
    i += b
  Next
  "La somme des éléments du tableau ", name(a) , " est ", i, "."
]

Main() = [Function
  Count(Array)
  Return ExitSuccess
]
\end{verbatim}

Cette fonction affiche ``Le tableau Array comporte 6 elements.''.
L'itération se fait sur les éléments du tableau si foreach
est suivi de crochets, sinon il se fait sur la table.

``\verb!foreach!'', ``\verb!pourchaque!'' peuvent être utilisés au choix.
Le bloc est refermé de la même manière qu'un bloc ``\verb!for!''.
Le mot clef ``\verb!as!'' ou ``\verb!aka!'' permettent de definir le nom
de l'élément actuel de l'itération.

Les mot-clef ``\verb!forall!'' et ``\verb!pourtout!'' itèrent sur tout
le tableau et toute la table.

Notez que l'ordre d'itération n'est garanti que pour
``\verb!foreach[]!'' où l'ordre de la table est respecté.
Dans les autres cas, l'ordre est indéfini.

\section{Execution parrallèle}

\subsection{Dispatcher du travail}

Il est possible en Dabsic de demander une execution en
parrallèle, dans les faits, il s'agit d'enregistrer un ordre
dans une file d'attente inspecté par une reserve de fils
d'execution. L'exemple ci-dessous vous montre comment lancer
une tache sur un ensemble de donnée:\\

\begin{verbatim}
Array = [Array 0 1 2 3 4 5 6 7 8 9 ]

void Treatment(array A, int n) = [Function
  int total
  int i

  For i = n, total = 0 To i < size(A) Step i += 1
    total += A[i]
  Next
  ``Result is ``, total
]

Main() = [Function
  Foreach[] Array as i
    // Treatment(Array, index(i)) 'Cette ligne de code est lancée en parrallèle
  Next
  Return ExitSuccess
]
\end{verbatim}

L'opérateur ``\verb!//!'' indique le lancement en parrallèle d'une ligne de code.
Dans l'exemple, cette ligne contient un appel de fonction, de ce fait,
la boucle du main arrive très vite à sa fin étant donné qu'elle ne fait
qu'empiler des demandes de traitement. Les différents fils d'execution
travaillent en arrière pour accomplir les demandes.

``\verb!Return!'' revet ici un sens supplémentaire: il va attendre que les fils d'execution
aient accompli leur tache avant de quitter la fonction.
``\verb!Report!'', au contraire, va les arrêter de force avant de quitter la fonction.

Il est possible de simplement les attendre avant de continuer l'execution
avec le mot clef ``\verb!WaitTasksCompletion!'', ou de forcer l'arret de leur traitement
avec ``\verb!StopTaskCompletion!''. Les mot-clefs ``\verb!AttendFinTravail!'' et ``\verb!ArrêteTravail!''
peuvent également être utilisé.

La demande d'attente peut optionnellement prendre en paramètre un temps maximal.
Cette demande s'utile par ailleurs comme une fonction et renvoit le temps non
consommé. Par exemple, si on lui passe 5 et que les fils ont terminé après 2.2 secondes,
alors 2.8 sera retourné. Si aucun pramètre n'est envoyé, 0 sera toujours renvoyé.

Le mécanisme d'execution en parrallèle est localisé: si on lance une execution
parrallèle dans une execution parrallèle, seule la locale est impactée par
les éventuelles attentes ou demande d'arret.

Il est possible d'annuler de force le mécanisme liant les fils d'execution
aux ``\verb!Return!'' et ``\verb!Report!'' locaux, cela en utilisant le symbole ``\verb|/!/|'' à la place de ``\verb!//!''.
En ce cas, les fils d'execution sont lié au programme seul.

Un fil d'execution s'éteint une fois la ligne de code avec laquelle il était
associé executé. Il est possible également à l'interieur du fil d'execution
de demander explicitement l'arrêt du fil avec le mot-clef ``\verb!StopCurrentThread!''
ou ``\verb!ArrêtFilCourrant!''.

