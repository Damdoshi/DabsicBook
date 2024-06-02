
#### JSON

Voici ce qu'il est possible de faire en JSON:

```json
{
  "nom_du_champ":"valeur",
  "nom_du_champ":{ "nom": { ... }, "nom": { ... } }
  "nom_du_champ":[ { ... }, { ... }, { ... } ],
  "nom_du_champ":[ [ ... ], [ ... ], [ ... ] ]
}
```

Un champ JSON peut-être une valeur, un tableau ou une table. Il n'est pas
possible d'écrire des commentaires en JSON. Une valeur peut-être un nombre
entier, un flottant ou une chaine de caractère.

Les étiquettes des champs étant des chaines de caractères avec guillemets,
aucun caractère n'est inutilisable. Cette qualité est aussi un défaut d'un
point de vue facilité: l'obligation de placer des guillemets systématiquement.

La racine d'un format JSON peut etre un tableau ou une table. Cela est
établi par le caractère d'ouverture du JSON, comme pour n'impotre quel champ.

Le séparateur de champ est la virgule.
