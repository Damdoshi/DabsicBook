
\chapter{Fil d'execution concurrent et ressources}

L'un des soucis de l'execution en parrallèle est l'accès concurentiel
aux ressources. Voici un exemple trivial:

\begin{itemize}
  \item Il faut libérer une ressource et celle-ci est disponible via
    un pointeur.
  \item Le fil d'execution teste si le pointeur est NULL.
  \item Si il ne l'est pas, il copie l'adresse de celui ci
    et le met a NULL pour éviter qu'un autre fil ne cherche
    à le libérer.
  \item Il libère la ressource.
\end{itemize}

La question est la suivante: Etant donné que les fil d'exectuion
sont appellé par le système dans un ordre et pour une durée qu'il
n'est pas possible de connaitre dans notre programme, comment
s'assurer qu'un fil d'execution ne va pas faire le test du pointeur
à NULL et entrer dans la condition avant que son prédécesseur
l'ayant fait ne le mette a NULL?

Le problème vient de la non-atomicité de la condition: plusieurs
opérations sont néccessaires de manière à bloquer l'accès à une
ressource. Pour régler le problème, il existe un objet appellé
sémaphore exploitant une capacité de verrouillage de nos processeur
et qui permet d'effectuer un test atomique.

Chaque champ Dabsic contient une semaphore, faisant de ceux-là
des éléments verrouillable.

Petit détail: un champ peut être revérouillé plusieurs
fois par le fil d'execution l'ayant déjà vérrouillé. Les sémaphores
sont donc ``re-entrante''.

Les mot-clefs suivant sont disponibles:

\begin{itemize}
  \item ``\verb!TryLock()!'', ``\verb!TenteVerrou()!'' demande à effectuer une demande de verrou
    sur un champ. Il prend un champ en paramètre le champ à tenter
    de verrouiller et retourne le niveau de verrouillage. Si le niveau est de 0,
    c'est qu'il n'a pas pu le verrouiller. Prend en paramètre le champ à vérrouiller.
    
  \item ``\verb!Lock()!'', ``\verb!Verrouille()!'' demande à poser un verrou. Si le champ
    est déjà verrouillé par un autre thread, il attend qu'il se déverrouille,
    sinon il le verrouille ou augmente son niveau de verrouillage.

    Ce mot-clef prend le champ comme premier paramètre. Il est possible de
    préciser un temps d'attente maximal comme deuxième paramètre.
    La valeur de retour est le niveau de verrouillage. Si il reste inchangé,
    c'est qu'il n'a pas été verrouillé ou reverrouillé.

  \item ``\verb!Unlock()!'', ``\verb!Déverrouille()!'' demande à déverouiller un champ.
    Retourne un entier indiquant le niveau de verrouillage. Si celui-ci
    est de 0, c'est qu'aucun verrou ne demeure. Si le niveau de verrouillage
    est déjà 0 lorsque le déverrouillage est demandé, une alerte est levée.
    Plus de détails dans la suite du livre.

  \item ``\verb!LockLevel()!'', ``\verb!NiveauVerrou()!'' demande à récupérer le niveau
    de verrouillage d'un champ.

  \item ``\verb!LockHolder()!'', ``\verb!Verrouilleur()!'' permet de récuperer l'identifiant
    du fil d'execution ayant verrouillé le champ passé en paramètre.
\end{itemize}

Verrouiller a un impact direct sur les possibilités des autres fils d'execution
sur les éléments protégés: il passe tous ces champs en ``\verb!hard!'' et dans une forme
dégradé de ``\verb!eternal!'' : le champ et ses fils sont éternaux, néanmoins les parents
du champ ne le deviennent pas. Ce procédé a pour conséquence que si une suppression
de la hiérarchie a lieu, alors le champ est susceptible de devenir orphelin.
Ces changements ne sont valable que pour les autres fil d'execution : le fil courant
a accès aux champs comme d'habitude.

Lors du déverouillage du champ ramenant le niveau de verrouillage a zéro, tous
les champs orphelins sont supprimés.

Dernier point. Lorsqu'un fil d'execution retourne dans la reserve de fils, tous
les champs qu'il a vérrouillé sont déverrouillés et une alerte est levée. Cette
alerte peut-être désactivée avec l'option \verb!--authorize-implicite-unlock!.
