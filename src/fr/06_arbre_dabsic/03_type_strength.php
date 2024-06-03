
#### Force du type

Un champ Dabsic disposant d'une valeur et donc d'un type dispose également
d'une force de type. Cette force indique la manière dont le champ peut être percu.
Les spécificateurs **weak**, **soft** et **strong** indiquent les lectures
autorisés de la valeur tandis que **strict** indique l'interdiction d'écriture
d'un autre type.

* Le niveau **weak** indique que le champ est faiblement typé. Cette force est
celle par défaut.

Le mot clef **weak** établi que la valeur contenue par le champ peut être converti
en n'importe quel autre type. Dabsic sera capable d'indiquer qu'une erreur de
conversion a eu lieu.

Ainsi, convertir une chaine de caractère non éligible en entier passera Dabsic
en mode erreur au lieu de seulement renvoyer 0 comme résultat de conversion - comme
le font PHP et Javascript.

Convertir une chaine de caractère en booléen ne sera valide que si la chaine
contient **true**, **false** (sans sensibilité de casse) ou un entier pouvant
évoluer vers un booléen de manière légale.

Notez que contrairement à certains C et au C++, en entier étant convertit en
booléen l'est pleinement: n'importe quel valeur non nulle est vraie et égale à
**true**. Ainsi, 2 == **true** renvoi vrai.

L'idée est que la faiblesse du typage doit permettre de généraliser plus encore
les traitements sans pour autant devenir une source d'erreurs difficiles à
diagnostiquer et résoudre.

Bien que cela soit le comportement par défaut, il est possible de l'expliciter avec
l'option **-Cweak**, indiquant que tous les champs non explicité on un type de force
faible. L'option **-Cno-weak** interdit l'usage du mot clef **weak**.

* Le niveau **soft** permet d'indiquer que la valeur d'un champ peut-être convertie
si la convertion ne détruit pas la précision de la valeur. En ce sens, la hiérarchie
est la suivante: *bool < int < real < string*.

Notez qu'un booléen promu en entier ou réel vaudra 0 ou 1 et **false** et **true**
s'il est promu en chaine de caractère.

Il est possible d'utiliser l'option **-Csoft** pour forcer le typage doux à l'ensemble
des champs à la force de type implicite.  L'option **-Cno-soft** interdit l'usage du mot clef **soft**.

* Le niveau **strong** permet d'indiquer que la valeur ne peut subir aucune
opération de conversion et n'être manipulée qu'avec des valeurs du même type qu'elle.
Autrement dit, une opération entre un réel et un nombre entier aboutira à une
erreur tandis qu'avec **soft**, l'entier aurait été converti en réel.

Il est possible d'utiliser **-Cstrong** afin de forcer le passage des champs
à la force de type implicite en niveau **strong**. L'option **-Cno-strong** interdit l'usage du mot clef **strong**.

* Le spécificateur **strict** empeche le changement du type de la valeur
contenue par le noeud. Elle interdit l'opération d'écriture d'un autre type sur le
noeud. Par exemple, dans le cas suivant:

```dabsic
soft int Champ0 = 42
Main = [Function
  Champ0 = 4.2
]
```

Le champ Champ0 à la fin de la fonction Main est devenu un nombre réel. Si
ce champ avait été **strict**, alors l'opération aurait renvoyé une erreur.

Le mot clef **flexible** est l'inverse du mot clef strict et est le comportement
par défaut.

Il est possible d'utiliser l'option **-Cstrict** pour que tous les champs
dont la rigueur n'est pas précisée et dont les types déductibles passent en
**strict**. Il est possible d'utiliser **-Cstrict-explicit-types** pour ne
passer en **strict** que ceux dont le type a été explicitement défini.

Un champ sans type et **strict** se fixera sur le premier type venu.

Les options **-Cno-strict** et **-Cno-flexible** interdisent respectivement les mot
clefs **strict** et **flexible**.

* Le spécificateur **hard** equivaut à **strong strict**. **-Chard** est
l'équivalent de **-Cstrict** combiné à **-Cstrong**. L'option **-Cno-hard** interdit
le mot clef **hard**.

Il est également possible d'interdire l'explicitation de la force de type avec
l'option **-Cno-explicit-type-strength**.


