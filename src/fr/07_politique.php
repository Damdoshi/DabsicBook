
\chapter{Politiques d'accès}

\section{Scope}

Un scope Dabsic est le contenu entier d'un champ en tant
qu'enfant de ce champ. Il est possible de limiter l'accès
à certains champs en fonction du champs d'où la tentative
d'accès est effectuée. Ces limitations passent par l'emploi
de mot-clefs associés:

\begin{itemize}
  \item ``\verb!hidden!'' indique que le champ ne peut-être ni
    lu ni écrit, ni listé ailleurs que depuis le scope courant.
    C'est exactement comme si il n'existait pas, à l'exception
    du fait que toute tentative pour créer un champ du même
    nom se soldera par un échec: l'interprète lancera une
    alerte et le champ ne sera pas créé.
  \item ``\verb!slot!'' indique que le champ ne peut-être écrit
    que dans le scope courant et est visible.
  \item ``\verb!peek!'' indique que le champ ne peut-être lu
    que par le scope courant et est visible.
\end{itemize}

\section{Utilisateurs}

Il est possible de limiter l'accès à un noeud (et à son
contenu quel qu'il soit) à partir d'un modèle plus fin
que les limitations lié au scope: au lieu d'une position,
c'est l'agent (l'incarnation d'un fil d'execution) ou
son groupe qui sera le critère discriminant.

\subsection{Etablir des droits}

Pour parvenir à ce résultat, nous allons définir un champ
spécial: il s'agit bien d'un champ normal, à l'exception
de son nom qui est imposé, et non pas d'une syntaxe spéciale.
D'une certaine façon, il est possible de considérer cet
aspect comme un aspect integré à Dabsic au lieu d'être
Dabsic lui-même: néanmoins il s'agit bien toujours du langage
et ce qui va être configuré aura un impact direct sur
les manipulations habituelles possibles.

``\verb!.access!'' permet de définir des accès fins:
le noeud va contenir des champs dont les noms
peuvent être des agents ou des possesseurs
de tickets. La valeur de ses champs peut-être noté de la
façon suivante:\\

\begin{verbatim}
[.access
  Player = Read, Write
]
\end{verbatim}

Ci-dessous, les autorisations pouvant être utilisé,
elles vous rappelleront certainement les ACL:

\begin{itemize}
  \item ``\verb!Administrate!'' indique qu'il est possible de changer les droits
  \item ``\verb!Extend!'' indique qu'il est possible d'ajouter des champs
  \item ``\verb!Crop!'' indique qu'il est possible d'effacer des champs
  \item ``\verb!Read!'' indique que la lecture est possible.
  \item ``\verb!Write!'' indique que l'écriture est possible.
  \item ``\verb!Visible!'' indique que le champ est visible,
    il apparait lorsqu'on liste le noeud parent ou
    lorsqu'on le parcoure.
  \item ``\verb!Execute!'' indique qu'il est possible d'appeller
    des fonctions.
  \item ``\verb!All!'' donne tous les droits
  \item ``\verb!None!'', ``\verb!Nothing!'' explicite l'absence complète de droit
\end{itemize}

Il est tout à fait possible d'établir un profil type et
de construire une référence vers ce profil. Ce profil
devra être préfixé d'un ``\verb!.!'', comme le champ ``\verb!.access'!'
et se situer a coté des noms d'agents, de groupes et
possesseurs de tickets.

De plus, il est possible de définir un noeud supplémentaire
``\verb!.exception!'' indiquant des droits écrasant les droits
précédents. Cela peut-être utile pour établir une blacklist:

\begin{verbatim}
[.access
  .assistants = Visible, Read, Write, Extend, Crop, Execute
  .leader = All
  .old = Visible, Read, Extend, Execute
  Thor = .leader
  Iopi = .old
  Koala = .assistants
  Authorized = .assistants
]
[.exception
  Banned = Nothing
  UnpopularKoala = Read, Execute
]
\end{verbatim}

En cas de spécification de droits pour un ticket suivi ou
précédé d'une spécification de droits pour un agent, les
droits assignés à l'agent sont prioritaires au sein
d'un même block ``\verb!.access!'' ou ``\verb!.exception!''.

Donc, sachant que, par exemple:

\begin{itemize}
  \item Thor et Iopi ont tous les deux un ticket Koala
  \item Tous les possesseurs du ticket UnpopularKoala ont également
    un ticket Koala.
\end{itemize}

Voici les droits d'accès finaux:

\begin{itemize}
  \item Thor peut tout faire.
  \item Iopi peut voir, lire, ajouter des éléments et executer des fonctions
  \item Les tickets koalas en général peuvent tout faire sauf administrer
  \item Les tickets koalas impopulaires peuvent lire et executer des fonctions,
    mais il faut qu'ils sachent quoi faire parcequ'ils ne peuvent
    pas voir ce qu'il se passe!
  \item Les possesseurs du ticket ``\verb!Authorized!'' peuvent faire comme
    les koalas.
  \item Les possesseurs du ticket ``\verb!Banned!'' n'ont accès à rien et
    n'ont aucune visibilité.
\end{itemize}

Notez que les noms des utilisateurs et tickets doivent tous
être unique, y compris entre eux. Une alerte sera lancé par l'interprète
en cas d'erreur. La priorité donnée en cas d'erreur est ticket > agent.

Différents tickets définis par le système sont détaillés plus bas,
ces tickets donnent des accès inaltérable et agissant partout.

\subsection{Créer des agents et des tickets}

Nous avons défini des droits basé sur des agents/utilisateurs
ainsi que des groupes. Nous avons dans l'exemple précédent
deux agents: Thor et Iopi ainsi que deux groupes: Koala et
UnpopularKoala.

La définition des agents est faite dans le champ ``\verb!.agents!''
situé à la racine. Les valeurs passés aux agents
sont les tickets. Voici un exemple:\\

\begin{verbatim}
[.agents
  Damdoshi
  Koneko = Cat
  Admin = Administrator
]
\end{verbatim}

Nous avons donc trois utilisateurs, Admin, Koneko et Damdoshi.
Koneko dispose du ticket ``Cat'' qui est un ticket défini
par l'auteur du programme.

Admin dispose du ticket ``Administrator'', qui est un ticket
établit par Dabsic et qui donne les droits d'accès sur
l'intégralité de l'arbre en dehors de toute limitation de scope.
Plusieurs tickets existent par défaut:

\begin{itemize}
  \item ``Moderator'' permet de distribuer et reprendre des tickets,
    d'ajouter, retirer et modifier des groupes et agents à
    l'exception du ticket ``Master''.
  \item ``Administrator'' donne tous les droits d'accès lié
    aux utilisateurs, groupes et tickets. Il permet également
    à un agent de devenir un autre agent.
  \item ``Developer'' donne tous les droits d'accès lié
    aux scopes ou à l'héritage.
  \item ``Monitor'' donne tous les droits d'accès lié au
    réseau.
  \item ``Master'' est un ticket cumulant ``Moderator'',
    ``Administrator'', ``Developer'' et ``Monitor''. Il
    ne peut y avoir qu'un seul ``Master'' distribué et
    cela doit être fait en dur. Notez que disposer
    d'un ``Master'' n'est pas obligatoire.
\end{itemize}
