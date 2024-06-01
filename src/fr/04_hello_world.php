# Hello world


Dabsic étant un langage de programmation dont la nature est avant
tout de s'ajouter à un programme, il n'est normalement pas supposé
comporter de fonction ``main'', néanmoins, par respect pour cette
tradition, voici un ``Hello World'' en Dabsic, écrit de la
manière la plus concise possible:

\begin{verbatim}
'Version courte
Main = [Function
  "Hello, world!"
]
\end{verbatim}

Notez qu'il est tout à fait possible d'être plus exigeant:

\begin{verbatim}
'Version longue
strict int Main(string argv[]) = [Function
  "Hello world!"
  return 0
]
\end{verbatim}

Ou d'omettre ``\verb!strict!'' mais de l'ajouter au lancement de
l'interprete avec l'option \verb!-Wstrict! comme comportement par
défaut de toutes les déclarations.

Vous aurez certainement remarqué les phrases précédés du symbole
"\verb!'!", il s'agit de commentaires.

<?=page_break(); ?>
