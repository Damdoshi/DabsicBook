
\chapter{Manipulations de noeuds}

Les noeuds sont un élément central de Dabsic car
ils forment l'élément de configuration principal de
celui-ci.

La création de noeuds peut-être réalisée massivement
ou non en Dabsic. Trois choix sont possibles:

\begin{itemize}
  \item Permettre la modification de l'arbre lors d'un accès
    en écriture ou en lecture. Pour cela, il suffit de commencer
    l'écriture d'une adresse Dabsic par \verb!|:!\\

    \begin{verbatim}
    Main = [Function
      |[].Node.Field = 42
      |Node = 21
    ]
    \end{verbatim}

    Donnera:\\
    \begin{verbatim}
    [Node = 21
      Field = 42
    ]
    \end{verbatim}
    
  \item Permettre la modification dans une sous-partie d'une
    fonction:\\

    \begin{verbatim}
    Main = [Function
      StartForge
        [].Node.Field = 42
        Node = 21
      EndForge
    ]
    \end{verbatim}

    ``\verb!StartForge!'', ``\verb!DebutForge!'' et ``\verb!EndForge!'', ``\verb!FinForge!''
    permettent de signaler que dans le bloc, il est possible
    d'écrire et lire des blocs n'existant pas, provoquant ainsi
    leur création.
    

  \item Permettre la modification n'importe ou à l'aide
    de l'option de l'interprète \verb!--no-forge-required!.
\end{itemize}

Il est possible de retirer un noeud (et tout ses enfants)
à l'aide du mot clef ``\verb!Tear()!'' ou ``\verb!Arrache()!''. La cible
doit être marqué comme modifiable, donc, être préfixé de ``\verb!|!'',
être dans un bloc ``\verb!Forge!'' ou alors être dans un environnement
entièrement modifiable.

Bien entendu, les champs dont les spécificités font
qu'il n'est pas possible de les étendre ou de les supprimer
ne sont malgré tout pas modifiable et une alerte sera
lanca par l'interprète en cas de tentative.
