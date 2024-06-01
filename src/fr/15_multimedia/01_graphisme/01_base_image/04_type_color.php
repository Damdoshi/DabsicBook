
### [].Multimedia.Color.Component

Ce type est un nombre réel pouvant également être manipulé comme un entier
sur 16 ou 8 bits. La construction d'un type composante de couleur est simple
et se fait de la même manière qu'un champ typé. Soit de manière explicite, soit de
manière implicite si manipulée par un format s'attendant à un type précis.

Une composante valide vaut entre 0 et 255 pour une représentation implicite
sur un entier 8 bits. Une composante valide vaut entre -1.0 et +1.0 pour une
représentation sur un réel - et le typage doit être explicite pour éviter
toute ambiguité.

### [].Multimedia.Color

Ce type est composé de cinq composantes de couleurs représentant
le rouge, le vert, le bleu et l'alpha - ou le cyan, le magenta, le jaune, le noir
et l'alpha.

La construction d'un type couleur peut se faire de plusieurs manières, soit
sous la forme d'un noeud comportant des champs nommés Red, Green, Blue, Alpha,
Transparency et Opacity, soit sous la forme d'un tableau de valeurs. Il est
également possible d'employer les mot-clefs Cyan, Magenta, Yellow et Black.
Les deux formats sont mutuellement exclusifs.

Sous la forme de noeuds, l'absence de composantes Red, Green, Blue, Cyan,
Magenta, Yelow ou Black se traduit par une valeur de 0.
L'absence totale d'Alpha, Transparency et Opacity se traduit par une
composante alpha de 255.
Alpha et Opacity sont équivalant: une valeur de 0 implique une transparence
totale et 255 (ou +1.0) une totale opacité. Le
fonctionnement de Transparency est l'inverse. L'existence de ces trois mot-clefs
pour la seule composante alpha est une pure question de confort. Un seul de ces
trois mot-clefs doit être utilisé à la fois.

Sous la forme de tableau de valeurs, les cases du tableau ont le sens suivant:

Color = NiveauDeGris
Color = NiveauDeGris, Alpha
Color = Rouge, Vert, Bleu
Color = Rouge, Vert, Bleu, Alpha

Sont également supporté mais non encouragé les initialisations suivantes:

Color = "#RRVVBB"
Color = "#AARRVVBB"

Pour la construction au format CMJN, le tableau doit commencer par la chaine
"CMJN" suivi de quatre ou cinq cases:

Color = "CMJN", Cyan, Magenta, Yellow, Black
Color = "CMJN", Cyan, Magenta, Yellow, Black, Alpha

