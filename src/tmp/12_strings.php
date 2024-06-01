
\part{Bibliothèque standard}

\chapter{Manipulations de chaines de caractères}

La manipulation des chaines de caractères est certainement l'élément le
plus commun dans les bibliothèques standards. Ainsi, il me semble
logique de commencer par là.

En Dabsic, une chaine de caractère est un type du langage,
il ne s'agit pas d'une construction interne comme c'est le
cas en C. Ainsi il n'est pas possible d'interagir directement
avec des éléments qui serait écrit en Dabsic.

Afin de fournir tout de même ce qui est néccessaire, des
bibliothèques sont couplées avec l'interprète. (Vous trouverez
le détail du couplage plus tard dans le livre)

Ci-dessous la liste des fonctions se trouvant dans le pseudo objet ``\verb!string!'':

\begin{tabular}{|c|l|}
  \hline
  Prototype & Description \\
  \hline
  %
  \verb!const int Get(int n)! &
  Renvoit la valeur du caractère (unicode) à la position n.
  Retourne une erreur si n est invalide étant donné la longueur de la chaine.
  ``\verb!Get!'' dispose d'un alter-égo ``\verb!Lit!''.\\
  %
  \verb!int Set(int n, int val)! &
  Assigne la valeur val au caractère situé à la position n dans la chaine.
  Retourne l'ancienne valeur qui était situé là auparavent.
  Retourne une erreur si n est invalide ou vaut ``\verb!\0!''.
  ``\verb!Set!'' dispose d'un alter-égo ``\verb!Ecrit!''.\\
  %
  \verb!string SubString(int left = 0, int width = -1)! &
  Renvoit une chaine de caractère étant une sous-chaine de la chaine originale
  dont le début est situé à left caractère du début de celle-ci et dont la
  longueur est width.
  Si width vaut -1 (Son paramètre par défaut), alors la longueur de la sous
  chaine sera la longueur de la chaine originale - left :\\

%%%%%%%%%%%%%%%%%%%%%%%%%%% ON VERRA PLUS TARD POUR LE CODE DANS LES TABLEAUX
%  \begin{verbatim}
  Main = [Function
    string str = "ABCDEF"

    "1: ", str.SubString(0, 2)
    "2: ", str.SubString(2, 2)
    "3: ", str.SubString(4)
    Return ExitSuccess
  ]
%  \end{verbatim}

  Affichera "AB", "CD" puis "EF" séparé par des sauts de ligne.

  Renvoit une erreur si l'un des paramètres est invalide ou
  si un problème de mémoire a eu lieu.
  \\
  %
  \verb!const string array Split(string array symbols)! &
  Renvoit un tableau de chaines de caractères découpé d'après
  les symboles passé en paramètre:

%%%%%%%%%%%%%%%%%%%%%%%%%%% ON VERRA PLUS TARD POUR LE CODE DANS LES TABLEAUX
%  \begin{verbatim}
  Main = [Function
    string array symbols = [Array "," "!" "{woulala}"]
    string str = "Une, liste! de{woulala} mots"

    Foreach[] str.Split(symbols) as word
      "Mot: ", word
    Next
  ]
%  \end{verbatim}

  Affichera ``Une'', `` liste'', `` de'' puis `` mots'' séparés par
  des sauts de ligne.

  Renvoit une erreur si l'un des paramètres est invalide ou
  si un problème de mémoire a eu lieu. \\
  \hline
\end{tabular}
