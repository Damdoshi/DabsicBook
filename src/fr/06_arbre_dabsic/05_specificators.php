
#### Autres spécificateurs

Le symbole **!** peut-être placé immédiatement après un spécificateur afin
d'indiquer que son effet doit être récursivement imposé à tous les champs enfants.

##### const - Constance de la valeur

Le spécificateur **const** indique que la valeur du champ ne peut pas être
modifiée. L'option **-Cconst** permet de passer tous les champs en champ constants.
La constance a un impact important sur les performances: les opérations n'intégrant
que des constantes n'étant jamais recalculées, le gain est remarquable. Les
opérations intégrant peu d'éléments non constants peuvent voir leurs résultats
placé en cache.

Les fonctions sont constantes.

##### mutable - Transformabilité de la valeur

Le spécificateur **mutable** indique que la valeur du champ peut être modifiée.
C'est le comportement par défaut. Il est possible d'interdire ce mot clef avec
l'option **-Cno-mutable**.

##### fixed - Constance du tableau et du noeud

Le spécificateur **fixed** (précédemment, **solid**) indique qu'aucun enfant
ne peut être ajouté à l'élément, que cela soit un tableau ou un noeud. L'option
**-Csolid** établi ce comportement comme étant celui par défaut. Autrement dit,
l'architecture du champ devient fixe.

##### fluid - Transformabilité du tableau et du noeud

Le spécificateur **fluid**  (précédemment, **stretchable**) indique qu'il
est possible d'ajouter des enfants à l'élément, que cela soit en tant que tableau
ou en tant que noeud. L'option **-Cno-fluid** interdit ce mot clef.

##### eternal - Interdiction de suppression d'un noeud

Le spécificateur **eternal** indique que le champ ne peut être supprimé.
Rendre un champ éternel rend néccessairement éternel tous ses parents.
L'option **-Ceternal** indique que tous les champs sont eternels. La racine globale
est éternelle.

##### class, struct - Définition d'une classe ou d'une structure

Les mot clefs **class** et **struct** servent à définir une classe ou une structure
et incorporent également un changement de comportement à la manière des spécificateurs.

Un champ **class** est éternel, fixé et l'ensemble de ses champs sont constants, soit
la combinaison de **eternal fixed const!**. En somme, il s'agit d'une définition
définitive.

Il est possible de respecifier à la suite de class pour casser certains de ces
comportements, cependant, ce n'est pas recommandé. Le retrait de fixed peut servir
à permettre la programmation par prototype.

L'option **-Cno-class-respecification** empeche tout ajout de spécificateur
qui viendrait casser ceux imposé par **class**.

La différence entre **class** et **struct** est la manière dont les données
peuvent être sérialisé en binaire. **struct** implique une absence de bourrage.

##### safe

Le mot-clef **safe** indique que la valeur portée par le champ est traitée
pour être sûre. Ce mot clef n'indique pas en quoi cette valeur est sûre, simplement
il assure la transmission du spécificateur et permet de rejeter une valeur
qui ne serait pas marqué comme telle si une fonction indique néccessiter une
valeur traitée. Les éléments marqués comme sûrs ne peuvent pas se retrouver
dans une opération avec des éléménts sans marquage sûr.

Un mot clef spécialisé permet d'effectuer la transition.

##### unsafe

Le mot-clef **unsafe** indique que la valeur portée par le champ n'est pas
traitée et peut comporter des éléments insécurisé. Un champ marqué **unsafe**
ne peut pas être utilisé dans une opération avec des éléments marqué comme
sûr, ni être passé en paramètre si le prototype néccessite une valeur marquée comme
sûre.

L'option **-Cdefault-unsafe** permet d'indiquer que tous les champs sans spécificateur
de sûreté sont **unsafe**.

===========================
NOTE: N'est ce pas mieux de sortir seulement un mot clef unsafe ?
Comme ca, on évite d'avoir a mettre *safe* partout. Ou alors on permet les deux.
