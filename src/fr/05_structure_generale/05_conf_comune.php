
### Passage d'un format à un autre

Plusieurs constats sont à faire: tous les formats ne permettent pas
la même richesse, ou en tous cas, pas toujours d'une manière directe.

Il est bien sur possible de simuler en INI une table: il suffit de créer
un tableau contenant les noms des champs supposée former cette table
mais cela tient du bricolage à la maintenance complexe et le lien
de parenté n'apparait pas clairement.\

JSON règle le problème par une approche hiérarchique, élément commun
à XML et Dabsic. Néanmoins, il faut choisir entre valeur, table et
tableau où alors construire par dessus une convention: un champ sera
toujours une table et il y aura toujours un champ value et un champ
array.\

XML embarque dans la balise les propriétés de la balise et enserre entre
la tête et la queue de la balise des éléments pouvant être considéré comme
un tableau. Ainsi, en ajoutant un attribut valeur, il est possible d'atteindre
le niveau d'agglomérat de Dabsic, néanmoins l'approche à une limite
critique: la verbosité. Le tableau qui est l'une des formes les plus communes
de stockage est qui est la plus efficace en devient la moins efficace. D'un autre
coté, les obligations syntaxique permettant l'existence des tableaux
empêchent d'utiliser les noms des balises comme identifiant car non unique.

Voici quelques configurations équivalente dans leur propos:

```xml
<Parent Attribut1="" Attribut2="">
    <Thing value="Value" />
    <Thing value="Value" />
    <Thing value="Value" />
</Parent>
```

```ini
[Parent]
Attribut1=""
Attribut2=""
Data=Value,Value,Value
```

```json
{
"Parent": {
  "Attribut1":"",
  "Attribut2":"",
  "Data":["Value", "Value", "Value"}
}
```

```dabsic
{Parent = [Node
   Attribut1 = ""
   Attribut2 = ""
 ]
 "Value", "Value", "Value"
}
```

Pour des raisons d'intérêt historique, il m'est impossible de ne pas faire
remarquer que le format de LISP, maximalement simple, est tout à fait suffisant
pour représenter n'importe quel arbre. Evidemment, sans soutien logiciel spécifique,
celui ci n'est pas évalué comme un équivalant des données ci-dessus.

```lisp
(Parent
  (table (Attribut1 "") (Attribut2 ""))
  (array "Value" "Value" "Value")
)
```
