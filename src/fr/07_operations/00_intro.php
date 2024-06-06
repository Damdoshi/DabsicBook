
# Opérations

Dabsic permet de ne pas se contenter d'écrire des valeurs littérales ou
des adreesses : il est tout à fait possible décrire des opérations à la
place de simples valeurs.

La possibilité d'écrire des expressions n'est pas tout à fait équivalente
au fait d'écrire des fonctions, car les fonctions ne sont pas déterminées
dès la lecture du code source, tandis que les expressions sont résolues.

L'avantage d'une expression sur une simple valeur littérale étant bien sur
la lisibilité, la justification de la valeur d'un champ par rapport à un contexte.

```dabsic
Coefficient = 3
Base = 5
Index = 10
Projection = Coefficient * Index + Base
'Exemple de fonction. Si Coefficient et Base changent plus tard
'pour un même x, le résulat sera différent.
FonctionEnLigne(integer x) = Coefficient * x + Base
```

