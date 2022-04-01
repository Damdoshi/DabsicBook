
\part{Retour sur la philosophie}

Cette partie décrit pêle mêle des éléments de la philosophie
de Dabsic.

\chapter{Beauté et organisation}

Dabsic doit être beau. Evidemment, la beauté est
subjective. De ce fait, il convient de définir ici
ce que cette beauté doit signifier.

La beauté consiste pour moi à disposer d'un set de
construction cohérent : certains symboles jurent si mit cote
à cote. La casse 

\chapter{Trivial et utile}

\section{Trivial}

Une fonctionnalité est triviale si celle ci ne néccessite
pas une mise en place complexe et peut s'expliquer simplement.

Bien entendu, il est possible de s'appuyer dans une moindre
mesure sur d'autres fonctionnalités pour décrire celle-ci,
par exemple :\\

\begin{itemize}
  \item Une constante est une valeur fixe : celle-ci ne peut
    être défini que lors de sa créaton.
  \item Une variable est un espace de stockage en mémoire
    associé à un symbole dans notre programme et contenant
    une valeur.
  \item Un pointeur est un cas particulier de variable
    contenant l'adresse d'une autre variable comme valeur.
  \item Une référence est un pointeur constant.
\end{itemize}

Tant qu'il est possible d'expliquer facilement une notion,
celle-ci est triviale. Bien sur, les retombées peuvent être
riches et il est possible de discuter longtemps sur celle-ci,
néanmoins les concepts s'expriment bien à la base.

Evidemment, si il est néccessaire d'expliquer 25 notions
préalable avant d'en aborder une, cela n'est plus trivial
du tout. La notion étant finalement subjective, je pense
qu'en discuter systématiquement pourrait être une bonne
chose...

Contrairement à ce que beaucoup de gens semblent penser,
si deux camps se forment ``Oui, c'est trivial'' et ``Non,
cela ne l'est pas'', c'est que ce n'est pas trivial.
Une notion est triviale si 75\% des utilisateurs pensent
qu'elle l'est, et ces utilisateurs ne doivent pas être
que des experts (Sinon, tout serait trivial) !

\section{Utile}

Une fonctionnalité est utile si elle est utilisée.
Si elle est présente pour le sport, elle est inutile.

Le problème des fonctionnalité inutile n'est pas tant
qu'elles ne servent pas: elles brouillent en quelque
sorte l'accès aux fonctionnalités utiles, car elles
s'imposent dans les tutoriaux et les manuels, dans
les messages d'erreur...

Certaines fonctionnalités peuvent être plus ou moins
utile, en somme ``indispensable'', ``utile'', ``pratique''
sont des forces différentes d'utilité. Il convient
à mon sens de placer les éléments les plus indispensable
en premier, si certaines fonctionnalités s'avèreraient
plus utiles que d'autres.

Une autre manière d'être inutile n'est pas de ne pas
potentiellement servir à rien mais d'être redondant:
si une fonctionnalité couvre déjà un domaine et qu'une
autre arrive, elle est inutile. Bien sur, peut-être
que la première a besoin d'être retravaillé ou remplacée,
mais en aucun cas laisser les deux ne doit devenir une
habitude.

\chapter{Explicite et peu dense}

\section{Explicite}

Explicite signifie pour moi évident par son design. Une
fonction doit faire une chose et ses options doivent être
limités. Si une fonction devient trop riche, elle doit être séparée
en deux.

Voici un exemple issu de javascript, la fonction date:

\begin{itemize}
  \item Si elle ne prend aucun paramètre, renvoit la date du jour.
  \item Si elle recoit un paramètre, elle retourne la date correspondant
    au timestamp 0 auquel on a ajouté le paramètre.
  \item Si elle recoit trois paramètres, les paramètres sont a priori,
    l'année, le mois et le jour. Le nombre d'année est a priori le nombre
    d'année depuis 1900
  \item Si le paramètre d'année est grand, par exemple, contient 2000,
    alors la fonction n'effectue pas 1900+2000 mais la prend comme une
    année directement.
\end{itemize}

Le comportement de cette fonction n'est clairement pas explicite, et
sous couvert que toutes ces ``sous-fonctions'' servent a renvoyer
une date, ils sont couverts par cette seule fonction.

Les deux premiers cas sont acceptables: le paramètre par défaut est 0,
donc la fonction retourne la date depuis timestamp 0 + le paramètre.

Les deux autres cas n'ont rien à faire la. Au total, il devrait y avoir
deux fonctions: L'une qui manipule un timestamp et une qui forge une date
a partir de paramètre éclatés (le cas 4). Le cas 3 me semble absolument inutile:
ce n'est ni un timestamp, ni une date... c'est quelque chose.

\section{Peu dense}

Le C est un langage assez peu dense, il se passe peu de chose par
ligne. Avec un bon découpage, il se passe assez peu de chose par fonction.

De ce fait, un programme écrit en C simple est facile à suivre.

Certains langages fonctionnels, certaines constructions en C++ (ou en C)
sont faites ainsi:\\

\begin{verbatim}
...
{
  apply(list, condition, action);
}
\end{verbatim}

Où list est un conteneur, condition un pointeur sur fonction/fonction membre/
functor/lambda, et action un autre pointeur sur une fonction sous une forme
quelconque.

Cette forme est compliquée! Elle va par exemple voir parmis tous les éléments
de la liste quels sont les éléments qui respectent condition puis ensuite
leur appliquer action. Eventuellement, on peut imaginer un quatrième paramètre
pour l'action appliqué à ceux qui ne la respectent pas.

Tout ca pour remplacer cette structure parfaitement triviale:\\

\begin{verbatim}
{
  for (init; cond; step) // ou foreach, a la riguer
  {
    if (condition(elem))
    {
      action(elem)
    }
  }
}
\end{verbatim}

Oui, le code au-dessus était plus court et cet exemple est tout
à fait trivial. Néanmoins voyez le ainsi: chaque élément dispose
d'un type plus ou moins long à définir à l'avance.

Parfois, ces types sont tellement long qu'ils sont masqués derrière
des mot-clefs (tel auto ou les templates en C++) pouvant couvrir
autant des données que des fonctions.

On arrive à un code ou le déroulement même est masqué derrière
un ensemble d'appel de fonctions dont la raison d'être n'est
pas le traitement qu'elles fournissent mais leur structure générale.
Bien sur il est toujours possible de comprendre ce code, néanmoins
c'est plus long: il faut parcourir le contexte plus en profondeur
pour n'esperer n'avoir ne serait ce qu'une infime comprehension,
car non, le nom des variables ne sera pas suffisament explicite.

Parfois, c'est la connaissance du langage qui sera insuffisante...
cela peut sembler ridicule, mais étant donné l'étendu de certains
langages aujourd'hui, cela peut tout à fait arriver, d'autant
que la course au code le plus sportif, le plus impressionnant
existe: certaines fonctionnalités de langages peuvent avoir
été utilisé tout simplement parcequ'elles existent, et non pas
parceque c'est elles qui permettaient d'avoir le code le plus
évident/le plus rapide/le plus économe.

Personnellement, j'appelle cela du code constipé: forcez autant
que vous voulez, le sens du code ne sortira pas.

\chapter{Plugins et aggregateur}

Dabsic est autant une bibliothèque qu'un langage de programmation
et il doit être possible et surtout simple de l'inclure dans
un projet écrit dans le même langage que lui, le C++.

\chapter{Verbosité}

\chapter{Souplesse}

\chapter{Versatilité}

