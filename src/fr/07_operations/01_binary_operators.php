## Opérateurs binaires

Un très large ensemble d'opérateur est disponible. Ces opérateurs
ne comportent pas les opérations d'asignations qui ne sont pas possibles
dans un contexte d'expression, mais seulement dans un contexte de fonction.

Ces opérateurs d'assignation sont étudiés plus tard dans le cadre des
fonctions Dabsic.

Ci-dessous, la liste des
opérateurs binaires disponibles, par ordre croissant de priorité:

| Symboles | Fonction |
| -------- | ---------|
| ? : | L'opérateur ternaire permet d'executer une expression ou une autre en fonction du résultat de la première expression. |
| ||, or, or | Opérateur logique OU INCLUSIF. |
| ^^, xor, oux | Opérateur logique OU EXCLUSIF. |
| &&, and, et | Opérateur logique ET. |
| (==), (vaut) | Opérateur de comparaison de valeur entre le champ de gauche et le champ de droite. Vrai si égal. |
| ==, vaut | Opérateur de compariason totale entre le filet de gauche et le filet de droite, compare également les valeurs. Vrai si égal. |
| (!=), (\<\>) | Opérateur de comparaison de valeur entre le champ de gauche et le champ de droite. Vrai si différend. |
| !=, \<\> | Opérateur de comparaison totale entre le filet de gauche et le filet de droite, compare également les valeurs. Vrai si différend. |
| <= | Teste si l'opérande de gauche est inférieure ou égale à l'opérande de droite. |
| < | Teste si l'opérande de gauche est inférieure à l'opérande de droite. |
| >= | Teste si l'opérande de gauche est supérieure ou égale à l'opérande de droite. |
| > | Teste si l'opérande de gauche est supérieure à l'opérande de droite. |    
| \| | Opérateur binaire ou inclusif. S'effectue sur des entiers. |
| ^ | Opérateur binaire ou exclusif. S'effectue sur des entiers. |
| & | Opérateur binaire et. S'effectue sur des entiers. |
| << | Opérateur de décalage binaire vers la gauche. S'effectue sur des entiers. |
| >> | Opérateur de décalage binaire vers la droite. S'effectue sur des entiers. |
| + | Opérateur d'addition. Sur entiers et réels. |
| - | Opérateur de soustraction. Sur entiers et réels. |
| * | Opérateur de multiplication. Sur entiers et réels. |
| / | Opérateur de division. Sur entiers et réels. |
| % | Opérateur de modulo. Sur entiers et réels. Attention, placé à l'arrière d'un littéral, c'est un suffixe et non l'opérateur modulo. |
| ** | Opérateur puissance. Sur entiers et réels. |
| # | Opérateur de concaténation. Sur chaine de caractères et adresses. |
| in, ∈, dans | Opérateur de test d'appartenance. Teste si l'opérande de gauche est dans l'opérande de droite, enfant du noeud ou du tableau. |
| {in}, {∈}, {dans} | Opérateur de test d'appartenance. Teste si l'opérande de gauche est dans l'opérande de droite, enfant du tableau. |
| [in], [∈], [dans] | Opérateur de test d'appartenance. Teste si l'opérande de gauche est dans l'opérande de droite, enfant du noeud. |
| out, ∉, !∈, dehors | Opérateur de test d'appartenance. Teste si l'opérande de gauche n'est pas dans l'opérande de droite, enfant du noeud ou du tableau. |
| {out}, {∉}, {!∈}, {dehors} | Opérateur de test d'appartenance. Teste si l'opérande de gauche n'est pas dans l'opérande de droite, enfant du tableau. |
| [out], [∉], [!∈], [dehors] | Opérateur de test d'appartenance. Teste si l'opérande de gauche n'est pas dans l'opérande de droite, enfant du noeud. |

### Spécificités des opérateurs de comparaison en Dabsic

Les opérateurs de comparaison en Dabsic ne fonctionnent pas deux à deux comme
en C ou d'autres langages mais via leurs deux voisins. Considerez l'exemple suivant:

```dabsic
Champ0 = 1 < 2 < 3
Champ1 = 3 > 2 < 5
Champ2 = 9 - 2 == 7 == 2 + 5
```
Les valeurs correspondent à ce que nous sommes en droit d'espérer. Dans le premier
champ, 1 est comparé a 2, et le résultat est vrai. Ensuite 2 est comparé à 3 et
le résultat est vrai. Comme toutes les comparaisons sont vraies, le résultat est
vrai. En C, 1 < 2 aurait entrainé la comparaison entre vrai et 3, ce n'est pas
le cas en Dabsic.
