
#### XML

Voici ce qu'il est possible - en partie - de faire en XML. XML peut-être
étendu de diverses manières qui n'ajoutent pas néccessairement à sa lisibilité
ni à sa sécurité.

```xml
<nom_du_champ attribut="" attribut="">
    Valeurs brutes &symbole;
    <!-- commentaire -->
    <balise_sans_contenu />
</nom_du_champ>
```

Un champ XML peut contenir une table (les attributs) ainsi qu'un tableau. Un champ
XML est également toujours un tableau, sauf si ce champ est auto-fermé, c'est à dire
comporte un slash en fin de balise. Si un champ XML est un tableau, son contenu
peut être constitué de valeurs brutes récupérés en l'état ou de nouvelles balises.

Une balise XML se fermant implique la répétition de sa nature précédé d'un slash,
ce qui est particulièrement verbeux.

Le nom d'une balise XML est plus proche d'un type que d'une étiquette indiquant
le sens de celle-ci: il s'agit en général de la nature de celle-ci. Un attribut
**id** viendra éventuellement compléter la balise pour lui donner une identité.

Les éléments sous la forme **&xxx;** sont étendues à la lecture, à la manière
d'une macro C, permettant certaines attaques comme celles des milliards de rire,
ce qui limite énormément leur utilisation.

Les champs, tableaux ou non ne peuvent avoir de valeurs. La pratique commune étant
d'utiliser les attributs comme valeur quand c'est possible - ce qui n'est pas
systématiquement le cas. En effet, il n'est pas rare que l'on ai besoin de tableaux
de valeurs, ce que les attributs ne permettent pas de faire. Il n'est pas non
plus possible d'utiliser les valeurs brutes comme étant des cases de tableaux
car celle-ci sont concaténnées à la lecture.

L'usage le plus commun est alors d'ouvrir et fermer des balises de l'une des manières
suivantes:

```xml
<tableau_a>
    <champ value="value" />
    <champ value="value" />
    <champ value="value" />
</tableau_a>
<tableau_b>
    <value>value</value>
    <value>value</value>
    <value>value</value>
</tableau_b>
```

Ce qui en plus d'être particulièrement inefficace à le défaut de prendre le risque
d'un élément situé dans l'espacement prenne la place d'une valeur. Pour encore
enfoncer le clou, les valeurs sont toutes au format string, même les entiers.
Le besoin de répétition pour la création de tableau est certainement la raison
pour laquelle les noms des balises ne peuvent être des identifiants.

Pour finir, le format des commentaires n'est pas spécialement élégant. On peut
ajouter qu'un fichier XML doit forcement s'ouvrir sur un **DOCTYPE** dont le
format n'est une balise XML afin de préciser des éléments comme la version du
langage.

XML a été conçu afin de rigidifier les usages de SGML (HTML) pour en simplifier l'analyse par logiciel et en faire un format de données plutôt qu'un format de document,
ce qui a neutralisé ses qualités et mis en exergue ses défauts. En effet, SGML
incorpore des facilités comme la fermeture automatique de balise, et implique un
cas d'utilisation strictement document: le contenu majoritaire est censé être
le texte brut. Ainsi, un site web, historiquement, comporte bien plus de texte
brut que de balises. En XML, il n'y a presque plus de texte brut!

Il, comme le dit un illustre inconnu, *combine l'efficacité des formats textes à la lisibilité des formats binaires*. 

Là où cela devient problématique, c'est qu'il existe de nombreux logiciels qui
exploitent XML et qui n'en deviennent pas mauvais pour autant: XML ne partira pas.

