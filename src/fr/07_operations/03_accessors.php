## Accesseurs

Ci-dessous, les accesseurs, dont l'opérateur unaire suffixant crochets:

| Symboles | Fonction |
| -------- | -------- |
| . | Opérateur d'accès à un enfant du noeud de gauche dont on connait le nom. |
| -> | Opérateur d'accès à un enfant du noeud pointé par le champ de gauche et dont on connait le nom. |
| [ ] | Opérateur d'accès à un enfant du noeud ou à un enfant du tableau - en fonction du type de valeur passé entre les crochets. Le nom ou l'index de l'élément accédé n'est pas immédiatement écrit mais contenu par une variable. |
| { } | Opérateur d'accès à un ensemble de bits. Deux valeurs sont attendues, la deuxième étant optionnelle, le séparateur étant la virgule. La première valeur est la position du premier bit à récupérer, la seconde valeur est le nombre de bit. En cas d'absence de la seconde valeur, la longueur est de 1. Les types supportés sont les entiers, les doubles et les strings.
