## Fonctions integrés

Il existe des opérateurs dont la syntaxe n'est pas sans rappeler celle des fonctions
mais qui sont integrés à l'interprète, à la manière de l'opérateur sizeof du C.

| Symboles | Fonction |
| -------- | -------- |
| Exists | Vérifie si une adresse existe. Renvoi un booléen. |
| AddressOf | Equivalent de l'opérateur unaire préfixe &. Renvoi l'adresse du champ passé en paramètre. |
| NameOf | Renvoi le nom du champ passé en paramètre. |
| HaveValue | Renvoi vrai si le champ passé en paramètre dispose d'une valeur. |
| NbrChildren | Renvoi le nombre d'enfants du noeud passé en paramètre. |
| NbrCases | Renvoi le nombre de cases du tableau passé en paramètre. |
| IsEmpty | Renvoi vrai si le champ passé est vide. |
| Length | Renvoi la longueur de la chaine de caractères passée en paramètre. |
| IndexOf | Renvoi l'index de l'élément de tableau passé en paramètre. |
| IsRead | Renvoi vrai si le champ passé en paramètre est en train d'être lu. |
| IsWritten | Renvoi vrai si le champ passé en paramètre est en train d'être écrit. |
| integer, int | Tentative de conversion en entier. |
| string | Tentative de conversion en chaine de caractère. |
| real | Tentative de conversion en flottant. |
