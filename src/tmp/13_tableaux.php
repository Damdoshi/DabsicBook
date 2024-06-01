
\chapter{Manipulations de tableaux}

De la même façon que les chaines de caractères. Une différence
entre les chaines et les tableaux existe néanmoins: une chaine
de caractère est un objet, une valeur, tandis que les tableaux
sont structurels, ainsi, les fonctions ci-dessous ne sont
pas ``dans'' les tableaux, mais de véritables mot-clefs du
langage.

\begin{tabular}{|c|l|}
  \hline
  Prototype & Description\\
  \hline
  \verb!int Resize(array &ar, int size)! &
  Cette fonction redimensionne le tableau passé en paramètre afin
  qu'il contienne size éléments. Les éléments surnuméraires sont
  détruit si le tableau était plus grand que size. Sinon ils
  sont initialisé avec une valeur par défaut.
  Les fonctions de construction/destruction sont appellées si
  il y a matière.
  Retourne le nombre d'élément ajouté. (Le résultat est négatif
  si des éléments ont été enlevé)
  Retourne une erreur en cas de problème de mémoire ou de paramètre
  invalide.
  \\
  %
  \verb!int PushBack(array &ar, elem)! &
  Cette fonction ajoute elem à la fin de ar.
  Retourne une erreur en cas de problème de mémoire ou de paramètre
  invalide.
  \\
  %
  \verb!int PushFront(array &ar, elem)! &
  Cette fonction ajoute elem au debut de ar.
  Retourne une erreur en cas de problème de mémoire ou de paramètre
  invalide.
  \\
  %
  \verb!int PopBack(array &ar)! &
  Cette fonction retire un élément à la fin de ar.
  Retourne une erreur en cas de problème de mémoire ou de paramètre
  invalide.
  \\
  %
  \verb!int PopFront(array &ar)! &
  Cette fonction retire un élément au début de ar.
  Retourne une erreur en cas de problème de mémoire ou de paramètre
  invalide. \\
  \hline
\end{tabular}
