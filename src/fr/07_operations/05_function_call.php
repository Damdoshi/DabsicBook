
## Appel de fonction

Enfin, l'opérateur d'appel de fonction, unaire et suffixant:

| Symboles | Fonction |
| -------- | -------- |
| ( ) | Des expressions séparées par des virgules peuvent être passées entre ces parenthèses. L'opérande suffixée est perçue comme une fonction a qui sont envoyé les paramètres. |

### Appel de fonction sans paramètres

L'opérateur parenthèse pour l'appel de fonction est optionnel si la fonction ne prend
pas de paramètres ou si ceux là ont tous des valeurs par défaut.

### Assignation à une fonction d'une valeur

L'assignation à un champ prenant une fonction provoque par ailleurs aussi un appel de fonction, si cette fonction ne prend qu'un seul paramètre. Le résultat de l'expression servira de paramètre.

### Passage de paramètres

Les paramètres peuvent être passé de plusieurs manières à une fonction. La
première syntaxe est la plus classique: les paramètres sont passés dans l'ordre
indiqué par le prototype de la fonction.

Dabsic permettant de donner des valeurs par défaut aux paramètres manquants, il
est possible d'omettre le passage de certains paramètres. Les paramètres manquants
d'une fonction peuvent être n'importe lesquels.

```dabsic
Puissance(real x, real y):real = x ** y
Clamp(int x, int min = 0, int max = 100):int = x < min ? min : x > max ? max : x

Resultat1=Puissance(5, 3)
Resultat2=Clamp(5, -4, 18)
Resultat3=Clamp(50, , 89)
Resultat4=Clamp(50, -10)
Resultat5=Clamp(50)
```

Il est également possible d'employer le passage par paramètre nommé. Cet appel
permet la création de fonctions prenant en paramètres énormément d'arguments
pouvant être souvent omis sans que l'appel de fonction n'en devienne systématiquement
indigeste.


```dabsic
OperationComplexe(int a, int b = 5, int c, int d = 7, int e = 0, int f = -1) = [Function ... ]

Resultat6=OperationComplexe(f = 7, a = 47 + 2, c = 50)
```
