
## Propriétés du champ lui-même

### Propriétés immanentes

Un champ dispose d'un **nom**, pouvant être vide s'il est indexé par un tableau,
et d'une **adresse** étant unique.

Le nom est composé de la manière suivante: **[a-zA-Z_][a-zA-Z_0-9]\*** et ne doit
pas être un mot-clef.

L'adresse est la position dans l'arbre Dabsic en partant de la racine générale.

Le séparateur d'adresse est le symbole **.** point. En interne, Dabsic peut
établir certains noeuds à des noms commencant par le séparateur d'adresse,
interdisant depuis l'espace Dabsic leur accès - car n'étant pas des adresses valides.
Votre programme ainsi est susceptible de subir leurs effets, et vous les verrez
peut-être dans certaines implémentations lors de la sérialisation d'un ensemble
Dabsic.

La casse du nom des champs n'a pas d'importance en Dabsic. Cependant, d'autres formats de configuration importables en Dabsic peuvent générer des collisions, ainsi le fait d'ignorer la casse des noms est une propriété du parseur de Dabsic et non du système de stockage. Le fait d'ignorer la casse peut-être annulé avec **-Cno-ignore-case** dans l'interprète ou via la mise à **false** du paramètre **ignore_case** qui devrait exister lors d'un import de Dabsic dans un projet utilisateur.

Un champ Dabsic est susceptible d'être volatile, c'est à dire de voir ses valeurs
changer en fonction d'éléments exterieurs au programme - ici, en l'occurence, programme faisant référence à la partie Dabsic. En effet, les champs Dabsic peuvent être reliés à des valeurs situés dans le projet utilisateur. Ces valeurs peuvent donc évoluer sans que Dabsic les manipule directement. De plus, si le projet utilisateur est multithreadé, cela signifie qu'il peut y avoir conflit d'accès sur ces variables en cas d'interpretation de Dabsic en simultanné avec un accès à ses variables.

### Propriétés explicites

