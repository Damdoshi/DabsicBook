
### Conclusion

Dabsic est le format disposant du champ le plus capable de tous les formats
présentés ici. En terme de stockage, il ne comporte aucun défaut majeur, à l'instar
du format JSON, contrairement à INI et XML qui impliquent structurellement des limitations genantes.

Le seul avantage dicsutable de JSON étant le format de labels, pouvant incorporer n'importe quel caractère car étant des chaines littérales C. Cet avantage peut-être percu comme un défaut car il apporte une complexité de traitement supplémentaire et une liberté pouvant devenir contreproductive, plus encore aujourd'hui à l'ère des caractères unicode ressemblant à des caractères ASCII.

Il est bien sur possible d'argumenter sur l'intêret du format du champ
Dabsic, après tout, le coté tableau et le coté table, en
particulier, sont fortement séparé et la valeur est également
un peu à part: c'est vrai. En soi, cette liaison même peut être critiquée car
elle permet certaines structures dont la complexité pourrait être excessive.

Cette liaison cependant permet d'assurer la généricité de tous les objets
manipulés en Dabsic: tous sont des champs.
