# DabsicBook
The Dabsic Programming Language book


Idée à ajouter:
- Lorsqu'on envoi un tableau à une fonction dont le paramètre n'est pas un tableau, concevoir un système permettant de boucler automatiquement sur chaque valeur du tableau. Si plusieurs tableaux sont passé en paramètre, provoquer autant de boucles. Peut etre specifier ce comportement avec un mot clef (un foreach sous forme d'opérateur unaire par exemple, ou un spécificateur de paramètre dans la signature de fonction, ca serait pas mal) ?
- Etudier les fonctions de PHP de type in_array pour voir comment en faire des opérateurs en Dabsic
- Voir comment ajouter la création à la volée de noeud et tableaux comme opérande: on doit pouvoir les copier ou récupérer des références constantes dessus - tout comme sur des valeurs litterales => renommer .parameters pour en faire un .variables ? et ca sera un tableau dont le sommet contient les variables actuelles, comme ca, ca gere la recursion nativement et simplifie la gestion des contextes: local deviendra le noeud contneant la fonction ou l'expression et artif par defaut sera local et modifiable via With.
- 
