
#### Portée du type

Il est possible d'utiliser des types explicites à différents endroits.
L'endroit le plus évident est avant ou après la définition du champ.

```dabsic
integer Value1 = 5
Value2:integer = 10
```

Il est également possible d'imposer un type à l'ensemble des éléments d'un
tableau en placant cette définition peu ou prou au même endroit. Dans le cas
d'un tableau écrit directement comme une série de valeur dans un champ,
le type s'impose d'orès et déjà à l'ensemble des cases. Dans le cas d'un
tableau écrit différement, voici comment procéder:

```dabsic
{integer Array1
  1, 2, 3
}
{Array2:integer
  1, 2, 3
}
Array3 = [integer Array
  1, 2, 3
]
```
