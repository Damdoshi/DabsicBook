
### [].Multimedia.Coordinate

Ce type est composé par défaut de trois nombres réels mais dispose de spécialisation permettant d'être limité
à un ensemble inférieur de coordonnées et d'être limités aux types entiers.

La construction d'un type coordonnées peut se faire de plusieurs manières:

- De manière explicite, en invoquant le type:

[].Multimedia.Coordinate Size = 5, 3

- De manière implicite, en créant un champ disposant d'un nom attendu et qui sera chargé par une fonction standard:

Size = 5, 3

La manière implicite est préférable lorsque vous utilisez un format standard. Une erreur de typage entrainera
une erreur lors de la lecture du fichier.

Un type Coordinate étant composé de trois valeurs, l'omission de plusieurs d'entre elles entrainera la mise à zéro
des coordonnées omises. Ainsi, dans l'exemple ci-dessus, les coordonnées sont X=5, Y=3, Z=0.

### [].Multimedia.Area

Ce type est composé de deux Coordinates, formant sa position et sa taille. Son format est le suivant:

[[].Multimedia.Area ImpactZone
  [].Multimedia.Coordinate Position = 3, 3
  [].Multimedia.Coordinate Size = 1, 2
]

Ou plus simplement, si ce champ est manipulé par un format attendant un ensemble de valeur spécifique:

[ImpactZone
  Position = 3, 3
  Size = 1, 2
]

Un Area peut également être construit via la définition d'un seul champ:

[].Multimedia.Area ImpactZone = 3, 3, 1, 3

Ou encore, si le champ est attendu à un format donné:

ImpactZone = 3, 3, 1, 2

Le nombre de dimension étant déduit automatiquement via une division par deux de la largeur du tableau.
Une valeur impaire sera interpretée comme une erreur de syntaxe.

Les formats en lignes étant moins clairs en général que les formats explicite, nous vous décourageons d'y faire appel lorsqu'aucun bénéfice de lisibilité n'est fait.
