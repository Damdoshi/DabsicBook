
\part{Champs d'applications}

Dabsic est versatile, comme n'importe quel langage de programmation,
mais par sa nature déclarative, il est particulierement adapté
aux programmes néccessitant un large ensemble de définition tel
que les jeux vidéo ou la programmation web.

\appendix

\chapter{Glossaire}

\chapter{Options}

\begin{tabular}{|l|c|}
  \hline
  Option & Explication\\
  \hline
  %
  \verb!-Wsnake_case! &
  Force le style serpent sur l'ensemble des mot-clefs et symboles. Le style serpent est le suivant:
  \verb!this_is_the_snake_case!
  Evidement, l'interprète n'est pas devin : ici, il se contentera d'interdire les majuscules isolées.
  \\
  %
  \verb!-WcamelCase! &
  Force le style Camel minuscule sur l'ensemble des mot-clefs et symboles. Le style camel minuscule
  est le suivant:
  \verb!thisIsTheLowerCamelCase!
  Evidement, l'interprète n'est pas devin: ici, il se contentera d'interdire la capitalisation
  de la première lettre (sauf si le reste du mot est également en majuscule) et les underscores (sauf
  en première et dernière position)
  \\
  %
  \verb!-WPascalCase! &
  Force le style Pascal sur l'ensemble des mot-clefs et symboles. Le style Pascal:
  \verb!ThisIsThePascalCase!
  Evidemment, l'interprète n'est pas devine: ici, il se contentera de vérifier que la première
  lettre est capitalisée et l'absence d'underscore. (sauf en première et dernière position) \\
  \hline
  %
  \end{tabular}
  
\end{document}

