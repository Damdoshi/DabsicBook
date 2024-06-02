# Hello world

Dabsic étant un langage de programmation dont la nature est avant
tout de s'ajouter à un programme, il n'est normalement pas supposé
comporter de fonction **main**, néanmoins, par respect pour cette
tradition, voici un **Hello World** en Dabsic, écrit de la
manière la plus concise possible:

```dabsic
'Version courte
Main = [Function
  "Hello, world!"
]
```

Notez qu'il est tout à fait possible d'être plus exigeant:

```dabsic
'Version longue
strict int Main(node argv) = [Function
  "Hello world!"
  return 0
]

Ou d'omettre **strict** mais de l'ajouter au lancement de
l'interprete avec l'option **-Wstrict** comme comportement par
défaut de toutes les déclarations.

Vous aurez certainement remarqué les phrases précédés du symbole
**!**, il s'agit de commentaires en lignes. Le commentaire s'achève
lorsqu'une nouvelle ligne est commencée.

<?=$PAGE; ?>
<?=page_break(); ?>
