
#### Format INI

Voici ce qu'il est possible de faire en INI:\

```ini
#Commentaires
NomDuChamp=Valeur
NomDuChamp=Valeur,Valeur,Valeur #Commentaires
[Categorie]
NomDuChamp=Valeur
```

Un champ INI peut-être une valeur ou un tableau. Un tableau n'est pas forcement
perçu comme un tableau par le format: cela peut tout à fait être percu comme
une grande chaine de caratère.

Il est possible également de spécifier une catégorie, mais la catégorie globale n'est accessible qu'à partir du début du fichier. Les sous-catégories ne sont pas possibles
autrement qu'en créant des catégories portant des noms qui impliquent
implicitement qu'il existe une hiérarchie.

Une valeur INI est souvent une chaine de caractère non échappée, il est donc
possible d'écrire des entiers et des flottants mais cela implique une analyse
au delà du format par le programme utilisateur. Il est possible aussi souvent
d'utiliser les chaînes C afin de pouvoir utiliser n'importe quel symbole.

Le saut de ligne est le séparateur.

Il y a de nombreux dialectes INI imposant certaines choses ou non. L'un
des dialectes INI le plus populaire aujourd'hui est certainement TOML.

