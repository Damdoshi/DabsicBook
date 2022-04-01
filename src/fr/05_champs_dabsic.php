# Champs Dabsic

\section{Comparaisons}

Les champs Dabsic sont le tissu de l'Arbre Dabsic.
Ils sont à la fois les variables d'un langage de programmation
traditionnel mais également les attributs de la structure
globale de l'environnement.\\

Les champs Dabsic peuvent contenir une valeur, d'autres champs
Dabsic rangé à la manière d'un tableau, d'autres champs Dabsic
organisé d'après leurs noms: Notez que ces possibiités ne sont
pas exclusives! Il est tout à fait possible de disposer d'un
champ Dabsic étant une valeur et un tableau ou une table.\\

\begin{itemize}
  \item Si l'on établit une comparaison avec le format INI, voici
    ce qu'il est possible de faire avec un champ INI:\\
    \begin{itemize}
      \item \verb!NomDuChamp=Valeur!
      \item \verb!NomDuChamp=Valeur,Valeur,Valeur!
    \end{itemize}
    \vspace{\baselineskip}
    Un champ INI peut-être une valeur ou un tableau.\\

  \item Si l'on compare maintenant avec JSON, voici l'étendu de ses
    possibilités:
    \begin{itemize}
      \item \verb!'nom_du_champ':'valeur'!
      \item \verb!'nom_du_champ':{ { json }, { json }, { json } }!
      \item \verb!'nom_du_champ':{ 'nom': { json }, 'nom': { json } }!
    \end{itemize}
    \vspace{\baselineskip}
    Un champ JSON peut-être une valeur, un tableau ou une table.
    Dans le cas d'une table, l'une des entrées peut éventuellement être utilisé
    pour représenter la valeur du champ lui-même et un autre un tableau.\\

  \item Le même travail avec XML:
    \begin{itemize}
      \item \begin{verbatim}
<nom_du_champ attribut="" attribut="">
  <XML><XML>
</nom_du_champ>
\end{verbatim}
    \end{itemize}
    \vspace{\baselineskip}
    Un champ XML peut contenir une table (les attributs) ainsi qu'un tableau.
    Comme en JSON, un attribut peut être utilisé pour contenir la valeur du champ.\\

  \item En Dabsic, voici differentes façons de faire:
    \begin{itemize}
      \item Déclaration d'un champ valeur:
        \verb!Dabsic = Valeur!
      \item Déclaration d'un champ table:
      \begin{verbatim}
[Dabsic
  ...
]
        \end{verbatim}
      \item Déclaration d'un champ tableau:
        \begin{verbatim}
Dabsic = [Array
  ...
]
{Dabsic
  ...
}
        \end{verbatim}
      \item Mélange des trois, version groupée dans la déclaration:
        \begin{verbatim}
[Dabsic = [Array = Valeur
    Dabsic
    Dabsic
    Dabsic
  ]
  Dabsic = ...
  [Dabsic = ...
    ...
  ]
]
\end{verbatim}

	\newpage
      \item Mélange des trois, Version éclatée:
        \begin{verbatim}
[Dabsic = Valeur
  Dabsic = ...
  Dabsic = ...
  This = [Array
    ...
  ]
]
\end{verbatim}
		\vspace{\baselineskip}
        This étant ici un mot-clef indiquant que la modification est a
        effectuer sur le champ ``parent''.
    \end{itemize}
\end{itemize}
\vspace{\baselineskip}

Plusieurs constats sont à faire: tous les formats ne permettent pas
la même richesse, ou en tous cas, pas toujours d'une manière directe.
Il est bien sur possible de simuler en INI une table: il suffit de créer
un tableau contenant les noms des champs supposée former cette table
mais cela tient du bricolage à la maintenance complexe et le lien
de parenté n'apparait pas clairement.\\

JSON règle le problème par une approche hiérarchique, élément commun
à XML et Dabsic. Néanmoins, il faut choisir entre valeur, table et
tableau où alors construire par dessus une convention: un champ sera
toujours une table et il y aura toujours un champ value et un champ
array.\\

XML embarque dans la balise les propriétés de la balise et enserre entre
la tête et la queue de la balise des éléments pouvant être considéré comme
un tableau. Ainsi, en ajoutant un attribut valeur, il est possible d'atteindre
le niveau d'agglomérat de Dabsic, néanmoins l'approche à une limite
critique: la verbosité. Voici quelques cas typique:

\begin{itemize}
  \item
  \begin{verbatim}
<MotherMarkup Property="">
  <Thing value="Value" />
  <Thing value="Value" />
  <Thing value="Value" />
</MotherMarkup>
\end{verbatim}
	\vspace{\baselineskip}
  \item
  \begin{verbatim}
<MotherMarkup Property="">
  <FirstThing>Value</FirstThing>
  <SecondThing>Value</SecondThing>
  <ThirdThing>Value</ThirdThing>
</MotherMarkup>
\end{verbatim}
\vspace{\baselineskip}
\end{itemize}

Ce qui peut être écrit bien plus simplement en JSON ou en Dabsic
de la façon suivante, dans un cas comme dans l'autre:
\begin{itemize}
  \item
  \begin{verbatim}
[MotherMarkup = [Array Value Value Value ]
  Property=""
]
\end{verbatim}
\vspace{\baselineskip}
\end{itemize}

XML est largement inspiré par HTML, format où le contenu brut
est modelé par les balises: la donnée n'est pas simplement un
ensemble de valeur rangé.\\

De plus, en HTML, la fermeture d'une balise est optionnelle: on ferme
si l'on souhaite que l'effet de la balise cesse.\\

Au départ, les sites webs, documents graphiques mis en page
par le HTML, était majoritairement constitué de contenu et les
préprocesseurs étaient moins répandus: il y avait peu de balise,
et il pouvait faire sens donc d'écrire complètement le nom de
la balise que l'on fermait dans le symbole de fermeture.\\

Objectivement, le format de LISP est tout à fait suffisant pour
représenter n'importe quel arbre:\\
\begin{itemize}
  \item Lisp: \verb!(clef ...contenu... )!
  \item JSON: \verb!'clef' : { ...contenu ... }!
  \item Dabsic: \verb![clef ...contenu... ]!
  \item XML: \verb!<clef> ...contenu... </clef>!
\end{itemize}
\vspace{\baselineskip}

Aujourd'hui, la majorité des sites webs utilisent PHP, ce qui
rend extremement facile le découpage de nos fichiers sources
(En réalité, c'était déjà facile et faisable avec du script
shell ou le préprocesseur de C, mais il fallait un UNIX, ce qui
était loin d'être évident à l'époque) et les balises représentent
une très large majorité de nos sources, le contenu étant
généralement situé en base de donnée. La répétition est donc
devenue, à mon sens, inutile. La monté en force de format
comme JSON est une conséquence directe de la désillusion envers
la qualité de XML comme format efficace.\\

En résumé, la communauté technique réalise que XML
est un format fait-et c'est pour ça qu'il a été conçu à la base-
pour s'insérer dans un document, et que ce n'est
pas efficace pour représenter un ensemble de données.\\

Il est possible d'argumenter sur l'intêret du format du champ
Dabsic, après tout, le coté tableau et le coté table, en
particulier, sont fortement séparé et la valeur est également
un peu à part: c'est vrai. En soi, cette liaison même peut
être critiquée. Cela dit, les éléments du langage considère un
champ Dabsic comme étant ces trois éléments, quand bien
même ils sembleraient être issu d'un montage comme on
pourrait le faire en JSON ou en XML.\\

Etant donné la nature versatile d'un champ Dabsic, certains
termes seront parfois utilisé à la place de ``champ'':

\begin{itemize}
  \item Un noeud (Node, en anglais) est un champ disposant
    d'enfants sous la forme de table (donc, \verb!clef:valeur!)
    \vspace{\baselineskip}
  \item Un tableau (Array, en anglais) est un champ disposant
    d'enfants sous la forme de tableau (\verb!index:valeur!)
    \vspace{\baselineskip}
   \item Un filet (Net, en anglais) est un champ étant à la fois
    un tableau et un noeud.
    \vspace{\baselineskip}
  \item Le terme champ seul sous entendra donc champ sans
    enfants, ni sous la forme de table, ni sous la forme de
    tableau, ou alors ou cette spécificité sera sans importance
    dans le contexte ou le mot est employé.
    \vspace{\baselineskip}
\end{itemize}

\newpage

\section{Plus d'informations sur le champ}

Un champ Dabsic peut donc contenir une valeur, un tableau
de champs Dabsic (ou de simples valeurs) ainsi qu'une table
de champs Dabsic. Ce ne sont pas les seules caractéristiques
des champs Dabsic : un champ Dabsic dispose de types et
de propriétés diverses, sa valeur n'est pas néccessairement
constante et son établissement peut-être fonction de
paramètres, etc. ! Voici une liste des propriétés et fonctionnalités
supplémentaires dont disposent les champs Dabsic.

\subsection{Simple déclaration}

Un champ Dabsic est un élément potentiellement très riche mais
pas néccessairement, un champ peut tout à fait être vide dans
tous les sens du terme et être denué de propriétés diverses, par
exemple :

\begin{verbatim}
[MotherField
  Field
  OtherField
]
\end{verbatim}

Les champs ``\verb!Field!'' et ``\verb!OtherField!'' existent mais n'ont
d'autres propriétés que leur nom et ne contiennent rien.

Un champ Dabsic dispose dans la majorité des cas de son propre nom
(c'est le cas lorsqu'ils sont déclaré manuellement dans une table),
ce nom peut être composé de lettres, de chiffres et du caractère ``\verb!_!''
underscore. Le premier caractère du nom ne peut pas être un chiffre.

Il existe des champs commencant par le symbole ``\verb!.!'' point, il
s'agit de champs reservés au fonctionnement du langage qui ne
sont pas visible directement par vos programmes (ils peuvent
néanmoins en subir les effets)

Pour assigner une valeur à un champ, il est possible d'utiliser
les symboles ``\verb!=!'' ou ``\verb!:=!''.

\verb|/!\| J'aurai aimé ignorer la casse des champs (comme avec les
mot-clefs, quoi), mais cela entre peut etre en conflit avec la
possiblité laissée par HBSL de former un arbre Dabsic a partir
de XML, Lua, INI/whatever.

\newpage

\subsection{Type de valeur et force du type du valeur}

Un champ Dabsic peut disposer d'un type et d'une force associé.
Un type est la nature de la valeur contenue. Dabsic gère nativement
un ensemble restreint de types dont voici la liste:

\begin{itemize}
  \item Le type ``\verb!bool!'', ``\verb!boolean!'', ``\verb!booléen!'' est un booléen. En terme C, il s'agit
    d'une énumération pouvant être vraie ou fausse. Un booléen
    litteral s'écrit ``\verb!True!'' (ou ``\verb!Vrai!''à ou ``\verb!False!'' (``\verb!Faux!''), qui sont tous deux
    des mot-clefs. Exemples:\\

\begin{verbatim}
    Field = True
    OtherField = FALSE
\end{verbatim}
\vspace{\baselineskip}

  \item Le type ``\verb!int!'', ``\verb!integer!'', ``\verb!entier!'' est un entier naturel. En terme C, il
    s'agit d'un \verb!int64_t!. Un entier naturel littéral peut-être
    écrit en binaire, octal, décimal ou hexadécimal. Un littéral
    écrit en binaire commence par 0b, en octal par 0, en hexadécimal
    par 0x et il n'y a pas de préfixe pour le décimal, en faisant
    le format par défaut.
    Exemples:\\

\begin{verbatim}
    Field0 = 0b11001      ' 24
    Field1 = 0x2a         ' 42
    Field2 = 424          ' 424
    Field3 = 010          ' 8
\end{verbatim}
	\vspace{\baselineskip}

    Je m'interroge sur l'intêret de conserver le formatage original
    des littéraux: Dabsic étant également un format de configuration
    et non pas seulement un langage (potentiellement un environnement
    comme décrit plus bas), il convient à mon sens de considérer
    que la méthode d'écriture est porteur de sens, à l'instar des
    droits Unix et de l'octal. Le fichier est susceptible d'être
    regénéré ou d'être parcouru à l'execution comme un FS.
	\vspace{\baselineskip}

  \item Le type ``\verb!real!'', ``\verb!réel!'' est un nombre réel. En terme C, il s'agit
    d'un double. Un nombre réel litteral s'écrit en décimal et doit
    comporter le symbole ``\verb!.!''. Il peut commencer par ce symbole comme
    terminé par celui-ci. Un suffixe ``\verb!e!'' indique également un réel.
    Exemples:\\

\begin{verbatim}
    Field0 = 4.2
    Field1 = 4.
    Field2 =.2
    Field3 = 2e4
\end{verbatim}
	\vspace{\baselineskip}

    De la même manière, conserver le formatage d'origine du champ
    me semble interessant.
    
    \newpage
    
  \item Le type ``\verb!string!'', ``\verb!texte!'' est une chaîne de caractères. En terme C++,
    il s'agit d'une \verb!std::string!. Une chaine de caractère littérale
    en Dabsic utilise le même format qu'en C, à savoir être cerclé
    par l'opérateur guillemet et utiliser anti-slash comme opérateur
    d'échapement. Exemples:\\

\begin{verbatim}
    Field0 = "Je vais bien."
    Field1 = "Je saute une \n ligne."
    Field2 = "Je comporte des caractères originaux \032."
\end{verbatim}
	\vspace{\baselineskip}

    L'objet string est tout à fait à même de contenir des caractères
    unicode et les manipulations qui lui sont associés considère les
    caractères unicode comme un seul et unique et non comme un montage
    multi-caractère: en somme, tout se passe comme si nous étions en
    ASCII, mais nous sommes en UTF-8.
    \vspace{\baselineskip}

  \item Un champ Dabsic peut également être d'un type construit, cela
    en prefixant l'adresse du type construit du mot clef ``\verb!struct!''.
    En terme pratique, cela importe à l'interieur du champ le contenu
    du type défini. Plus d'informations sont disponibles plus bas. Il
    n'est pas néccessaire (En tous cas, dans la version décrite ici)
    d'écrire un litteral pour un type construit car celui-ci charge
    dans le noeud sa définition : il faudrait donc redefinir ses
    valeurs en déclarant des champs équivalent.
\end{itemize}

\newpage

La force associé au respect du type de ces valeurs peut-être changée
à l'aide des mot-clefs suivants :

\begin{itemize}
  \item Le mot-clef ``\verb!weak!'', ``\verb!faible!'' permet d'indiquer que la valeur est
    faiblement typée. Cette force de type est celle par défaut si
    l'interprète est lancé sans option.

    La force de type ``\verb!weak!'' établit que la valeur peut-être
    convertie en n'importe quel autre type. Attention, contrairement
    à d'autres langage au typage faible tel que PHP ou Javascript,
    Dabsic effectuera une vérification qu'une convertion à belle et bien
    eu lieu!

    Ainsi, convertir ``\verb!string!'' en entier renverra une erreur
    et non 0 comme c'est le cas dans ces autres langages. Convertir
    ``\verb!string!'' en booléen ne sera valide que si la chaine contient
    ``\verb!true!'', ``\verb!false!'' ou un entier pouvant évoluer vers un booléen
    de manière légale.

    Notez que contrairement au C ou au C++, un entier étant convertit
    en booléen l'est pleinement: n'importe quelle valeur non nulle
    est vraie et égal à ``\verb!True!'' ! Ainsi \verb!2 == ``True''! est vrai.

    L'idée est que la faiblesse du typage est un outils permettant
    de flexibiliser le plus possible les manipulations mais que
    cela ne doit en aucun cas devenir une source d'erreur.

    Bien que cela soit le comportement par défaut, il est possible de
    l'expliciter avec le flag \verb!-Wweak! indiquant que tous les champs
    non explicité ont un type de force faible.
    \vspace{\baselineskip}

  \item Le mot-clef ``\verb!soft!'' permet d'indiquer que la valeur peut-être
    convertie si la convertion ne détruit pas la précision de la valeur.
    En ce sens, la hiérarchie est la suivante:

\begin{verbatim}
    bool < int < real < string
\end{verbatim}

    Notez qu'un booléen promu en entier ou réel vaudra 0 ou 1, et
    ``\verb!False!'' et ``\verb!True!'' si il est promu en chaine de caractère.

    Il est possible d'utiliser l'option suivante pour
    modifier le comportement par défaut de l'interprète : l'option \verb!-Wsoft!
    assigne la force de type douce à tous les champs dont la force de
    type n'est pas spécifiée.
    \vspace{\baselineskip}

  \item Le mot-clef ``\verb!strong!'' permet d'indiquer que la valeur ne
    peut subir d'opération qu'avec des valeurs du même type. Autrement dit,
    une opération entre un réel et un nombre entier aboutira à une erreur,
    tandis qu'avec ``\verb!soft!'', l'entier aurait été convertit en réel.

    Il est possible d'utiliser l'option suivante pour modifier le
    comportement par défaut de l'interprète : l'option \verb!-Wstrong!
    assigne la force de type forte à tous les champs dont la force de
    type n'est pas spécifiée.
    \vspace{\baselineskip}

  \item Le mot-clef ``\verb!strict!'' ne change pas la force du type lui-même
    mais interdit le changement du type d'un champ. C'est à dire que dans
    le cas suivant :\\

\begin{verbatim}
    soft int Field = 42
    Main = [Function
      Field = 4.2
    ]
\end{verbatim}
	\vspace{\baselineskip}

    Le champ Field à la fin de la fonction Main est devenu un nombre
    réel. Si ce champ avait été à la place ``\verb!strict int!'', alors
    l'opération aurait renvoyé une erreur. Notez que le mot-clef
    ``\verb!strict!''. Notez que strict n'aura pas interdit une conversion
    depuis le type entier vers un autre car la force du type est
    ``\verb!weak!''. Pour indiquer l'impossibilité d'assigner et de convertir,
    vous devez préciser ``\verb!strict strong int!''.

    Le mot-clef ``\verb!flexible!'' est l'inverse du mot clef strict et
    est le comportement par défaut.

    Il est possible d'utiliser l'option \verb!-Wstrict! pour que tous les champs
    dont la rigueur n'est pas précisé passe en ``\verb!strict!''.
    \vspace{\baselineskip}

  \item Le mot clef ``\verb!hard!'' est la combinaison de ``\verb!strict!'' et ``\verb!strong!''.
    L'option -Whard passe tous les champs dont ni la rigueur ni la force
    du type ne sont précisé en dur. De la même manière, \verb!-Whard! est la
    combinaison de \verb!-Wstrict! et \verb!-Wstrong!.

\end{itemize}
\vspace{\baselineskip}

Les options \verb!-Wno-weak!, \verb!-Wno-flexible!, \verb!-Wno-soft!, \verb!-Wno-strong!, \verb!-Wno-strict!
et \verb!-Wno-hard! forcent l'interprète à lancer une alerte en cas d'utilisation
des mot-clefs weak, flexible, soft, strong, strict ou hard. Il est possible
également d'interdire l'explicitation de la force du type avec
\verb!-Wno-explicit-type-strenght!, ainsi, seul la force définie par configuration sera possible.\\

Ces types sont utilisable sur les champs mais également sur les tableaux:\\

\begin{verbatim}
Field = [type Array
  ...
]
\end{verbatim}

Préciser un type impose le respect de ce type à tous les éléments de
celui-ci.

\newpage

\subsection{Addresses et références}

Un champ peut contenir autre chose qu'une valeur et contenir une adresse.
Ce champ est alors un alias sur le champ dont il contient l'adresse. Voici
la syntaxe :\\
\begin{verbatim}
[Node = [Array 0 1 2 3 ]
  Integer = 42
  Reference = .Integer
  Index = this[3]
]
Main = [Function
  Print([].Node.Reference, "\n")
  Print(Node.Reference, "\n")
  Print(Node[3], "\n")
  Print(Node.Index, "\n")
]
\end{verbatim}

``Reference'' est une reference sur ``\verb!Integer!''. Appeller la fonction
main va donc afficher deux fois ``\verb!42\n!'' puis deux fois ``\verb!3\n!''.

Notez les deux manières de joindre le champ ``\verb!Reference!'': la première
utilise le symbole ``\verb![]!'' qui en Dabsic correspond à la racine:
l'adresse est donc absolue. La seconde façon utilise le préfixe ``\verb!.!''
et est donc une adresse relative. Il est également possible d'utiliser
le mot-clef ``\verb!this!'' pour représenter le champ courant.
Deux ``\verb!.!'' d'affilé (ou plus) indique une remontée dans la hiérarchie
d'autant de ``\verb!.!'' surnuméraire.

Dans l'exemple précédent, l'adresse est récuperée à partir d'une
adresse litterale, mais ce n'est pas la seule façon : il est également
possible de récuperer une adresse depuis une autre référence :

\begin{verbatim}
[Node
  Integer = 42
  Reference = .Integer
  OtherRef = .Reference
]
Main = [Function
  Print(.Node.OtherRef, "\n")
]
\end{verbatim}

Attention, ici, nous ne créeons pas une référence sur une référence,
mais récupérons simplement l'adresse contenu par ``Reference'' pour
l'assigner à ``OtherReg''. Ainsi, ici, ``Reference'' et ``OtherRef''
sont équivalent tout deux à ``Integer''.

Le typage d'une référence est celui de l'élément pointé et cela en
tous point à l'exception d'un seul : si la référence est stricte,
alors son type ne peut pas être changé lors d'une réassignation
à une autre adresse. Ainsi, même si la référence est censé prendre
le type du champ dont elle a l'adresse, il est possible de créer
des références dédiés à l'aide du mot clef strict, et ainsi obtenir
le comportement du C ou du C++. L'option \verb!-Wall-ref-are-strict! permet
de considérer par défaut que toutes les références sont strictes.

\newpage

Est considéré invalide toute référence ne menant pas à un champ
existant : cela n'empeche pas l'assignation, par exemple :

\begin{verbatim}
Reference = .Field
Main = [Function
  Print(Reference, ``\n'')
  ' Création du noeud [].Field et assignation à 42
  Print(Reference, ``\n'')
]
\end{verbatim}

Par défaut, ce programme génère une erreur et l'execution s'arrête.
Néanmoins, avec l'option \verb!--ignore-bad-ref!, au lieu de s'arrêter,
l'interprète va envoyer une alerte sur la sortie d'erreur et
continuer normalement l'execution. Une valeur par défaut
dépendant du type sera retournée si un type était précisé,
sinon l'état indéfini sera retourné.
Ici, nous aurons donc une erreur sur stderr suivit de ``\verb!42\n!''
sur la sortie standard.\\

Il est bien entendu tout à fait possible de vérifier la validité
d'une référence avant d'y avoir accès : le mot-clef ``\verb!valid!'',
utilisable telle une fonction :\\

\begin{verbatim}
Shell> ./dabsic
Reference = .Unknown
int Main = [Function
  Return Valid(Reference)
]^D
Shell> echo \$?
0
\end{verbatim}

De plus, le mot-clef \verb!NULL! est disponible afin d'assigner une
adresse invalide à une référence sans avoir à prendre le risque
d'en créer une : \verb!NULL! sera toujours invalide.

Pour finir, gardez à l'esprit qu'une reference est une reference
sur un champ et non sur une valeur et qu'il est donc possible
d'acceder au contenu de celui-ci si il s'agit d'un noeud ou
d'un tableau.

Dans la même veine, un tableau peut très bien être un tableau
de référence... Et être l'élément de base d'un graphe complexe.

\subsection{Specificateurs}

Un champ Dabsic ou une déclaration de tableau peut disposer
de plusieurs propriétés:

\begin{itemize}
  \item \verb!specificator Field = 42 'The value is specified!
  \item \verb!Field2 = [specificator Array ... ] 'The array is!
        \verb!                                   'specified!
\end{itemize}
\vspace{\baselineskip}

Voici une liste des spécificateurs:

\begin{itemize}
  \item ``\verb!const!'' interdit toute modification de la valeur du champ
    ou des valeurs contenu par le tableau.
    L'option \verb!-Wconst! indique que par défaut, tous les champs sont
    constants. Notez qu'un tableau constant est solide.
    La constance est extremement importante pour les performences:
    une opération mathématique entre éléments constants fournira
    toujours le même résultat, donc il sera possible de ne pas
    recalculer le résultat la prochaine fois!
    \vspace{\baselineskip}
  \item ``\verb!mutable!'' indique qu'il est possible de modifier la valeur du champ
    ou les valeurs stockés dans le tableau.
    L'option \verb!-Wno-mutable! demande à l'interprète de lancer
    une alerte si ce mot-clef est utilisé.
    \vspace{\baselineskip}

  \item ``\verb!solid!'' indique qu'aucun enfant ne peut être ajouté à
    l'élément solide.
    L'option \verb!-Wsolid! indique que par défaut, tous les champs
    sont solides, ainsi leur forme est fixe après le parsing
    initial.
    ``\verb!solid!'' peut également être utilisé sur une référence pour
    indiquer qu'elle ne peut pas être réassignée.
    \vspace{\baselineskip}
  \item ``\verb!stretchable!'' indique qu'il est possible de créer
    de nouveaux enfants au champ.
    L'option \verb!-Wno-stretchable! demande à l'interprète de lancer
    une alerte si ce mot-clef est utilisé.
    \vspace{\baselineskip}

  \item ``\verb!eternal!'' indique que le champ ne peut pas être supprimé.
    Rendre un champ éternel implique que tous ses parents sont éternels.
    L'option \verb!-Weternal! indique que tous les champs sont éternels.
    Un tableau eternel est solide.
    Pour information, la racine est éternelle.
    \vspace{\baselineskip}
\end{itemize}

Le symbole ``\verb|!|'' placé immédiatement après le spécificateur indique
que celui-ci doit être étendu aux enfants : par défaut, la portée
est limitée au champ seul. Les références ne sont bien entendus
pas traversé par ces specificateurs étant donné que ce qu'ils
poitent n'est pas néccessairement enfant du champ.\\

Pour arrêter la propagation récursive de ces specificateurs, il est
bien entendu possible d'utiliser le specificateur inverse avec
l'opérateur de récursion ``\verb|!|'' mais également en utilisant ces
mot-clefs qui annulent l'effet de specificateur par famille :\\

\begin{itemize}
  \item ``\verb!default_write_access!'', ou ``\verb!defaultwriteaccess!'' indique
    qu'il faut restorer les droits d'écriture par défaut de l'interprète.
    L'option \verb!-Wno-default-write-access! demande à l'interprète de
    lancer une alerte si ce mot-clef est utilisé.
    \vspace{\baselineskip}
  \item ``\verb!default_solidity!'', ou ``\verb!defaultsolidity!'' indique
    qu'il faut restorer la solidité par défaut de l'interprète.
    L'option \verb!-Wno-default-solidity! demande à l'interprète de
    lancer une alerte si ce mot-clef est utilisé.
    \vspace{\baselineskip}
\end{itemize}

Ces mot-clefs sont à utiliser ou non avec l'opérateur de récursion ``\verb|!|''.

Je ne recommande pas l'utilisation massive de constructions
utilisant la récursion de specificateur puis l'annulation etc. car
cela génère un suivi complexe. Néanmoins si vous en avez besoin,
c'est possible.

\newpage

\subsection{Opérations}

Dabsic permet de ne pas se contenter d'écrire des valeurs
littérales ou des adresses : il est tout à fait possible
d'écrire des opérations à la place de simples valeurs.\\

Vous remarquerez que ces opérations sont finalement des
fonctions d'une unique ligne. Voici quelques exemples :

\begin{verbatim}
' Defining things
Answer = 42
Offset = 1

' Fields I will use
TheAnswer = Answer
ModAnswer = (Answer + Offset) * 3
\end{verbatim}
\vspace{\baselineskip}
\newpage

Un très large ensemble d'opérateurs sont disponibles et utilisables.
Voici une liste des opérateurs binaires disponibles par ordre croissant de priorité:\\

\begin{tabular}{c|c|c|c}
  \hline
  Priorité & Symbole & Sens de lecture & Description\\
  \hline
  0 & ``\verb!,!'' & \verb!->! &
  Effectue les opérations dans l'ordre et retourne l'opérande le plus à droite.
  Ce sens d'execution est différent de celui du C et de ses héritiers.
  \\
  %
  \hline
  %
  1 & ``\verb!=!'', ``\verb!:=!'', ``\verb!equal!'', ``\verb!égal!'' &
  Assigne l'opérande de droite à l'opérande de gauche.
  Retourne l'opérande de gauche.
  \\
  %
  1 & ``\verb!<-!'', ``\verb!become!'', ``\verb!devient!'' &
  Déplace l'opérande de droite vers l'opérande de gauche. Dans les faits, l'opérande
  de droite est maintenant indéfini et l'opérande de gauche dispose de sa valeur.
  \\
  %
  1 & ``\verb![=]!'', ``\verb![All=]!'' & \verb!<-! &
  Assigne récursivement tous les champs contenu par le champ de droite au champ de gauche.
  Le champ lui-même est assigné.
  Retourne l'opérande de gauche.
  \\
  %
  1 & ``\verb![A=]!'', ``\verb![Array=]!'' & \verb!<-! &
  Assigne récursivement tous les champs contenu par le tableau du champ de droite au
  tableau du champ de gauche.
  Retourne l'opérande de gauche.
  \\
  %
  1 & ``\verb![H=]!'', ``\verb![Hash=]!'' & \verb!<-! &
  Assigne récursivement tous les champs contenu par le noeud du champ de droite au
  noeud du champ de gauche.
  Retourne l'opérande de gauche.
  \\
  %
  1 & ``\verb!||=!'', ``\verb!or=!'', ``\verb!ou=!'' & \verb!<-! &
  Assigne à l'opérande de gauche le résultat de l'opération gauche \verb!||! droite.
  Retourne l'opérande de gauche.
  \\
  %
  1 & ``\verb!^^=!'', ``\verb!xor=!'', ``\verb!oux=!'' & \verb!<-! &
  Assigne à l'opérande de gauche le résultat de l'opération gauche \verb!^^! droite.
  Retourne l'opérande de gauche.
  \\
  %
  1 & ``\verb!&&=!'', ``\verb!and=!'', ``\verb!et=!'' & \verb!<-! &
  Assigne à l'opérande de gauche le résultat de l'opération gauche \verb!&&! droite.
  Retourne l'opérande de gauche.
  \\
    %
  1 & ``\verb!|=!'' & \verb!<-! &
  Assigne à l'opérande de gauche le résultat de l'opération gauche \verb!|! droite.
  Retourne l'opérande de gauche.
  \\
  %
  1 & ``\verb!^=!'' & \verb!<-! &
  Assigne à l'opérande de gauche le résultat de l'opération gauche \verb!^! droite.
  Retourne l'opérande de gauche.
  \\
  %
  1 & ``\verb!&=!'' & \verb!<-! &
  Assigne à l'opérande de gauche le résultat de l'opération gauche \verb!&! droite.
  Retourne l'opérande de gauche.
  \\
  %
  1 & ``\verb!<<=!'' & \verb!<-! &
  Assigne à l'opérande de gauche le résultat de l'opération gauche \verb!<<! droite.
  Retourne l'opérande de gauche.
  \\
  %
  1 & ``\verb!\>\>\=!'' & \verb!<-! &
  Assigne à l'opérande de gauche le résultat de l'opération gauche \verb!>>! droite.
  Retourne l'opérande de gauche.
  \\
  %
  1 & ``\verb!+=!'' & \verb!<-! &
  Assigne à l'opérande de gauche le résultat de l'opération gauche \verb!+! droite.
  Retourne l'opérande de gauche.
  \\
  %
  1 & ``\verb!-=!'' & \verb!<-! &
  Assigne à l'opérande de gauche le résultat de l'opération gauche \verb!-! droite.
  Retourne l'opérande de gauche.
  \\
  %
  1 & ``\verb!*=!'' & \verb!<-! &
  Assigne à l'opérande de gauche le résultat de l'opération gauche \verb!*! droite.
  Retourne l'opérande de gauche.
  \\
  %
  1 & ``\verb!/=!'' & \verb!<-! &
  Assigne à l'opérande de gauche le résultat de l'opération gauche \verb!/! droite.
  Retourne l'opérande de gauche.
  \\
  %
  1 & ``\verb!\%=!'' & \verb!<-! &
  Assigne à l'opérande de gauche le résultat de l'opération gauche \verb!\%! droite.
  Retourne l'opérande de gauche.
  \\
  %
  1 & ``\verb!**=!'' & \verb!<-! &
  Assigne à l'opérande de gauche le résultat de l'opération gauche \verb!**! droite.
  Retourne l'opérande de gauche.
  \\
  %
  1 & ``\verb!#=!'' & \verb!<-! &
  Assigne à l'opérande de gauche le résultat de l'opération gauche \verb!#! droite.
  Retourne l'opérande de gauche.
  \\
  %
  \hline
  %
  2 & ``\verb!?!'' ``\verb!:!'' & -> &
  Effectue un test sur l'opérande de gauche de ``\verb!?!'', si celui ci est vrai, alors
  l'opérande situé entre ``\verb!?!'' et ``\verb!:!'' est executé et retourné, sinon c'est
  celui à droite de ``\verb!:!''.\\
  %
  \hline
  %
  3 & ``\verb!||!'', ``\verb!.OR.!'', ``\verb!or!'', ``\verb!ou!'' & \verb!->! &
  Effectue l'opération \verb!OU INCLUSIF! entre l'évaluation comme booléen de
  l'opérateur de gauche et l'évaluation comme booléen de l'opérateur de droite.
  L'opérande de droite n'est pas évaluée si l'opérande de gauche est vrai.
  Retourne un booléen contenant le résultat.\\
  %
  3 & ``\verb!^^!'', ``\verb!.XOR.!'', ``\verb!xor!'', ``\verb!oux!'' & -> &
  Effectue l'opération \verb!OU EXCLUSIF! entre l'évaluation comme booléen de
  l'opérateur de gauche et l'évaluation comme booléen de l'opérateur de droite.
  Retourne un booléen contenant le résultat.\\
  %
  \hline
  %
  4 & ``\verb!&&!'', ``\verb!.AND.!'', ``\verb!and!'', ``\verb!et!'' & \verb!->! &
  Effectue l'opération \verb!ET! entre l'évaluation comme booléen de
  l'opérateur de gauche et l'évaluation comme booléen de l'opérateur de droite.
  L'opérande de droite n'est pas évaluée si l'opérande de gauche est faux.
  Retourne un booléen contenant le résultat.\\
  %
  \hline
  %
  5 & ``\verb!==!'', ``\verb!.EQ.!'', ``\verb!equal to!'', ``\verb!égal à!'' & \verb!->! &
  Teste l'égalité entre l'opérateur de gauche et de droite.
  Retourne un booléen contenant le résultat.\\
  %
  5 & ``\verb|!=|'', ``\verb!<\>!'', ``\verb!.NE.!'', ``\verb!unlike!'', ``\verb!différent de!'' & \verb!->! &
  Teste la différence entre l'opérateur de gauche et de droite.
  Retourne un booléen contenant le résultat.\\
  %
  5 & ``\verb!<=!'', ``\verb!.LE.!'' & \verb!->! &
  Teste que l'opérateur de gauche est inférieur ou égal à celui de droite.
  Retourne un booléen contenant le résultat.\\
  %
  5 & ``\verb!>=!'', ``\verb!.GE.!'' & \verb!->! &
  Teste que l'opérateur de gauche est supérieur ou égal à celui de droite.
  Retourne un booléen contenant le résultat.\\
  %
  5 & ``\verb!<!'', ``\verb!.LT.!'', ``\verb!lesser than!'', ``\verb!inférieur à!'' & \verb!->! &
  Teste que l'opérateur de gauche est inférieur à celui de droite.
  Retourne un booléen contenant le résultat.\\
  %
  5 & ``\verb!\>!'', ``\verb!.GT.!'', ``\verb!greater than!'', ``\verb!supérieur à!'' & \verb!->! &
  Teste que l'opérateur de gauche est supérieur à celui de droite.
  Retourne un booléen contenant le résultat.\\
  %
  \hline
  %
  6 & ``\verb!|!'' & \verb!->! &
  Effectue une opération \verb!OU INCLUSIF bit à bit! entre l'opérande de gauche et de droite.
  Cette opération n'est possible que sur des entiers. Retourne un entier.\\
  %
  6 & ``\verb!^!'' & \verb!->! &
  Effectue une opération \verb!OU EXCLUSIF bit à bit! entre l'opérande de gauche et de droite.
  Cette opération n'est possible que sur des entiers. Retourne un entier.\\
  %
  \hline
  %
  7 & ``\verb!&!'' & \verb!->! &
  Effectue une opération \verb!ET bit à bit! entre l'opérande de gauche et de droite.
  Cette opération n'est possible que sur des etniers. Retourne un entier.\\
  %
  \hline
  %
  8 & ``\verb!<<!'' & \verb!->! &
  Cette opération peut être effectuée sur une chaine de caractère à gauche et
  un entier à droite ou deux entiers.
  Si il s'agit de deux entiers, il s'agit d'un décalage binaire vers la gauche.
  Si il s'agit d'une chaine de caractère et d'un entier, il s'agit d'un décalage
  à gauche des caractères.
  Les excedents sont tronqués.
  Cette opération retourne un résultat du même type que l'opérande de gauche.\\
  %
  8 & ``\verb!\>>!'' & \verb!->! &
  Cette opération peut être effectuée sur une chaine de caractère à gauche et
  un entier à droite ou deux entiers.
  Si il s'agit de deux entiers, il s'agit d'un décalage binaire vers la droite.
  Si il s'agit d'une chaine de caractère et d'un entier, il s'agit d'un décalage
  à droite des caractères.
  Les excedents sont tronqués.
  Cette opération retourne un résultat du même type que l'opérande de gauche.\\
  %
  \hline
  %
  9 & ``\verb!+!'' & \verb!->! &
  Cette opération effectue une addition entre l'opérande de gauche et l'opérande
  de droite. Le résultat est du type de l'opérande de gauche. Cette opération
  n'est possible que sur des entiers et des réels.\\
  %
  9 & ``\verb!-!'' & \verb!->! &
  Cette opération effectue une soustraction entre l'opérande de gauche et l'opérande
  de droite. Le résultat est du type de l'opérande de gauche. Cette opération
  n'est possible que sur des entiers et des réels.\\
  %
  \hline
  %
  10 & ``\verb!*!'', ``\verb!x!'' & \verb!->! &
  Cette opération effectue une multiplication entre l'opérande de gauche et l'opérande
  de droite. Le résultat est du type de l'opérande de gauche. Cette opération
  n'est possible que sur des entiers et des réels.\\
  %
  10 & ``\verb!/!'', ``\verb!:!'' & \verb!->! &
  Cette opération effectue une division entre l'opérande de gauche et l'opérande
  de droite. Le résultat est du type de l'opérande de gauche. Cette opération
  n'est possible que sur des entiers et des réels.\\
  %
  10 & ``\verb!\%!'' & \verb!->! &
  Cette opération effectue un modulo entre l'opérande de gauche et l'opérande
  de droite. Le résultat est du type de l'opérande de gauche. Cette opération
  n'est possible que sur des entiers et des réels.\\
  %
  \hline
  %
  11 & ``\verb!**!'', ``\verb!pow!'' & \verb!->! &
  Cette opération effectue un modulo entre l'opérande de gauche et l'opérande
  de droite. Le résultat est du type de l'opérande de gauche. Cette opération
  n'est possible que sur des entiers et des réels.\\
  %
  \hline
  %
  12 & ``\verb!#!'' & \verb!->! &
  Cette opération concatène l'opérande de gauche avec l'opérande de droite.
  Le résultat est une chaine de caractère. Cette opération est possible
  avec tous les types.
  Cette opération est conçu de manière à ne créer qu'une seule chaine
  finale et aucune chaine intermédiaire (à l'exception des résidu de
  conversion des opérandes).\\
  %
  \hline
  %
\end{tabular}

Attention: Tous les opérateurs binaires précisés précédemment doivent être
précédé et suivi d'un espace.

Un ensemble d'opérateur unaire et spéciaux sont également disponibles.


%%%%%%%%%%%%%%%%%%%%%%%% ON NE PEUT PAS FAIRE DE ITEMIZE DANS UN TABLEAU
%%%%% ON CHECKERA PLUS TARD
%%%%%%%%%%%%%%%%%%%%%%%%%%%%
\begin{tabular}{c|c}
  \hline
  Symbole & Description\\
  \hline
  ``\verb!+!'' & L'opérateur unaire \verb!+! à son sens mathématique, il conserve le signe de son opérande.\\
  %
  ``\verb!-!'' & L'opérateur unaire \verb!-! à son sens mathématique, il inverse le signe de son opérande.\\
  %
  ``\verb![]!'' & L'opérateur crochet dispose de deux sens. Il peut s'utiliser de deux différentes façons :
%  \begin{itemize}
%    \item variable = field[42]
%    \item
%	Client = ``Gerard''
%      [Gerard
%        Age = 42
%        
%      ]
%      [Charles
%        Age = 23
%      ]
%      AgeClient = [Client].Age
%  \end{itemize}
  
  La première ligne est un usage traditionnel de l'opérateur crochet: pour accéder à un index
  de tableau.
  La seconde est l'équivalent d'un accès à un attribut/champ d'une structure ou ici en
  l'occurence de l'arbre Dabsic, mais à la place de le définir littéralement, une
  indirection est crée à l'aide d'une variable.
  Ce comportement rappellera certainement celui des références. A défaut d'être totalement
  efficace, il est néanmoins plus facile à comprendre pour les débutants.

  Le champ (donné directement ou via une opération) peut contenir une série
  d'indirection type ``Gerard.Champ.AutreChamp''. Si la valeur contenue
  est invalide, alors le programme s'arrête. Il est possible de forcer
  le programme à continuer avec l'option --ignore-bad-address, en ce cas,
  le programme reprend à la ligne suivante et écrit un message d'erreur
  sur la sortie d'erreur.
  Si le champ visé n'existe pas, le même comportement intervient et
  peut-être désactivé de la même manière, néanmoins le message d'erreur
  sera différent.
  \\
  %
  ``\verb!()!'' & L'opérateur parenthèse, à moins d'être disposé directement à la suite d'une opérande
  dispose de son sens de mathématique et agit comme modificateur de priorité de l'opération.
  
  Dans le cas contraire, il s'agit de l'opérateur d'appel de fonction.
  
  Notez qu'en Dabsic, cet opérateur est optionnel si la fonction ne prend pas de paramètre
  (Il s'agit par exemple d'un simple champ contenant une opération). Il est également
  optionnel si la fonction n'en prend qu'un seul et que l'appel est effectué avec
  l'apparence d'une assignation (En utilisant ``= A'' plutôt que ``(A)'').

  Le contenu de ces parenthèses lors d'un appel de fonction peut être disposé de deux
  façons distinctes:
%  \begin{itemize}
%    \item A la manière du C, en séparant les paramètres et en les placant dans l'ordre
%      défini de la fonction: MaFonction(a, b, c)
%      
%      De cette manière, les paramètres optionnels peuvent être demandé en ne placant
%      tout simplement rien comme paramètre: MaFonction(a, , c)
%    \item A la manière du Logo, en placant devant chaque paramètre son nom suivi de
%      l'opérateur ``='' et dans ce cas, l'ordre n'a aucune importance, et pour
%      spécifier l'utilisation d'un paramètre optionnel, il suffit de ne pas spécifier
%      le paramètre: MaFonction(premier=a, dernier=c)
%  \end{itemize}
  \\
  %
  ``\verb!(type)!'', ``\verb!type()!'' & L'opérateur de conversion permet de forcer la modification
  d'un type. La conversion est toujours effectuée, même si celle-ci est falacieuse.
  Dans le cas d'une conversion invalide, le pavillon d'erreur est levé et peut-être
  attrapé par la structure de contrôle adaptée comme décrit plus bas dans la
  section des structure de contrôle.
  La première syntaxe est celle du C et de ses dérivés: on place l'opérateur en préfixe.
  La seconde syntaxe est celle des langages fonctionnels, on utilise le type comme
  une fonction.
  Le résultat est le même et une pure préférence.
  La constance est transmise telle quelle.\\
  %
  \hline
  %
\end{tabular}

Certains ``operateur'' (dans le sens, opérateur comme sizeof en C) sont également
disponible:

\begin{tabular}{c|c}
  \hline
  Symbole & Description\\
  \hline
  %
  ``\verb!valid()!'' & L'opérateur de validité retourne un booléen indiquant si la référence
  passée en paramètre est valide ou non. Si la référence est solide et que le champ
  pointé est éternel, alors le booléen sera constant.\\
  %
  ``\verb!array_size()!'', ``\verb!arraysize()!'', ``\verb!size()!'' & Cet opérateur de mesure retourne un entier
  contenant la taille du tableau du champ. Cet entier est constant si le tableau est solide.\\
  %
  ``\verb!hash_size()!, ``\verb!hashsize()!'' & Cet opérateur de mesure retourne un entier contenant
  le nombre d'élément dans la table du champ. Cet entier est constant si la table est solide.\\
  %
  ``\verb!name()!'' & Cet opérateur retourne une chaine de caractère contenant le nom du champ,
  une alerte est lancé si le champ ne dispose pas de nom.\\
  %
  ``\verb!index()!'' & Cet opérateur retourne l'index où est situé le champ,
  une alerte est lancé si le champ ne dispose pas d'index.\\
  %
  ``\verb!is_read()!'', ``\verb!isread()!'' & Cet opérateur retourne un booléen indiquant si le champ courant est
  en train d'être lu.\\
  %
  ``\verb!is_written()!'', ``\verb!iswritten()!'' & Cet opérateur retourne un booléen indiquant si le champ courant
  est en train d'être écrit.\\
  %
  \hline
  %
\end{tabular}

%\begin{tabular}{c|c}

Un spécificateur spécifique aux opérations et fonctions est disponible,
il s'agit du spécificateur ``pure''. Une opération pure indique un
ensemble de chose:

\begin{itemize}
  \item Toutes les fonctions, opérations, champs appelées ou lus par
    l'opération courante sont purs et éternels.
  \item Aucune assignation n'est effectuée par l'opération en dehors
    des variables locales (si celle-ci est une fonciton) et de la
    valeur de retour. Les paramètres ne sont pas modifié si ce sont
    des références.
\end{itemize}

Notez qu'une valeur constante est pure par définition.

Il est possible d'utiliser le mot-clef ``record'' sur une fonction pure.
Celui-ci demande à l'interprète de garder en mémoire les résultats déjà
calculés de la fonction. Utilisez ce mot-clef avec parcimonie afin de
ne pas stocker des résultats inutiles si votre fonction peut prendre
une très large variété de paramètre: ils seront tous enregistré!

Il n'est pas utile d'utiliser ``record'' si la fonction ne prend pas de
paramètre: le résultat est stocké par nature grace au mécanisme
d'optimisation lié à la constance.

Un champ contenant une opération/fonction est constante. Ainsi, il n'est pas possible
d'écraser une opération en la remplacant par une valeur ou une autre
opération. Il est néanmoins possible d'utiliser l'opérateur d'assignation ``\verb!=!''
sur une opération si celle-ci comporte un unique paramètre. L'opérande
de droite est alors passée en paramètre à l'opération.

Dernier détail: si vous souhaitez indiquer qu'une opération ne retourne rien,
il vous suffit d'écrire void: l'interprète lancera une alerte si vous
cherchez à récuperer une éventuelle valeur retournée.

\subsection{Paramètres}

La valeur d'un champ peut donc être fonction d'une opération.
Cette opération peut prendre des paramètres, ceux-là sont définis à la suite
du nom du champ:\\

\verb!int Field(int x) = x + 1!\\

La déclaration des variables est tout à fait similaire à la déclaration
du contenu d'une table, à la différence qu'il est possible d'utiliser
l'opérateur ``\verb!,!'' virgule pour chainer les déclarations.

Les paramètres pouvant également être des tableaux, afin de specifier
qu'un tableau est attendu, il est possible d'utiliser le mot-clef
``\verb!array!'' en complément des autres mot-clefs disponibles (type,
etc.). Ajouter des crochets à la fin du nom de la variable indique
également qu'il s'agit d'un tableau.
Il est de plus possible de préciser des informations à propos de
ce tableau:

\begin{itemize}
  \item ``\verb![0-42]!'' indique une taille entre 0 et 42.
  \item ``\verb![-50]!'' indique une taille maximale de 50.
  \item ``\verb![84]!'' ou ``\verb![84-]!'' indique une taille minimale de 84.
  \item ``\verb![]!'' ou une absence de crochet indique que n'importe
    quel taille est valide. Notez que du coup, un champ n'étant
    pas un tableau peut-être donnée et la précision ``array''
    est purement sémantique car aucune vérification ne saurait
    être faite.
\end{itemize}

Les paramètres pouvant également être des table, il est possible
de specifier un type construit, cela amènera l'interprète à faire
un test de compatibilité entre le champ envoyé et le type.

Il est possible de préciser qu'un paramètre est passé par référence
en ajoutant le symbole ``\verb!.!'' en préfixe de nom de variable.

Ainsi, il est possible d'écrire:

\begin{itemize}
  \item Quelques fonctions simples:
    \verb!void PutPixel(int pixels[], int x, int y, int w, int color) := pixels[x + w * y] = color!
    \verb!void Factoriel(int n) := n <= 1 ? 1 : n * Factoriel(n - 1)!
  \item Une fonction avec des paramètres par défaut:
    \verb!pure int Mul(int x = 0, int y = 0) := x * y!
  \item Une fonction avec des références en paramètre:
    \verb!void Swap(int .x, int .y) := x = x ^ y, y = x ^ y, x = x ^ y!
\end{itemize}

\subsection{Tableaux}

Comme vu précédemment, la déclaration d'un tableau est la suivante:\\

\begin{verbatim}
Field = [Array
  ...
]
\end{verbatim}

Il est possible de préciser un large ensemble de règles de manière
à renforcer l'environnement, y compris la taille du tableau:\\

\begin{verbatim}
Field = [hard int Array[20]
  1 2 3 4 5 6 42
]
\end{verbatim}

Ici, un tableau comprenant 20 cellules est créé: celui-ci n'est
pas redimensionnable, ses éléments sont des entiers constant.
Les valeurs non précisées se voient assigner la dernière valeur
renseignée, soit ici 42.\\

Les tableaux ne sont pas exclusivement des planches de valeur!
Les éléments indéxés sont des champs, comme le reste, ainsi il
est même possible d'écrire:\\

\begin{verbatim}
TheArray = [Array
  [Field
    Data = 42
  ]
  [Field
    Dance = "Jerk"
  ]
  [Field
    CreditRatio = 2.1
  ]
]
\end{verbatim}

Nous avons créé ici un tableau contenant 3 champs indexés. Ces
trois champs sont des tables contenant d'autres champs.
Remarquez ici la ré-utiisation du nom ``Field'': étant
donné que le nom n'est pas utilisé pour indexer ces noeuds,
il est possible d'en avoir plusieurs dans le même scope
avec le même nom et de faire ce genre de chose:\\

\verb!string GetName(x) = name(TheArray[x])!\\

