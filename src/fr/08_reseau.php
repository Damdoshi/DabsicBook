
\chapter{Réseau}

L'un des points les plus interessant de Dabsic est sa
mise en réseau automatique. Il s'agit tout simplement
de déployer l'interprète en mode démon en lui passant
un programme. L'interprète va alors ouvrir deux prises
réseau sur le port 55989 (\verb!0xDAB5!) en TCP et UDP en écoute.

Le lancement en serveur s'effectue avec l'option \verb!--network!,
en tant que démon avec \verb!--daemon!. Les ports peuvent être
modifiée avec \verb!--tcp-socket=port! et \verb!--udp-socket=port!.

Qui dit serveur Dabsic dit également client Dabsic.
Le lancement en client se fait avec \verb!--ip=ip --tcp-port=n!
et \verb!--udp-port=m!, les deux précisions de port étant
optionnel (par défaut, les deux valent 55989).

Le TCP sert à faire transiter des données en masses,
tandis que l'UDP fait transiter l'information de
changement ponctuel ou d'obsolescence.

\section{Agent réseau}

Un agent réseau peut-être défini dans l'environnement
Dabsic, il s'appelle tout simplement ``\verb!Network!''.

Cet agent est celui qui est utilisé par tous ceux qui
se connectent. L'état dans lequel il se trouve doit
leur permettre ensuite de s'autentifier comme étant
un autre agent: un joueur, un modérateur, etc.

\section{Scope}

Il existe un spécificateur réseau venant s'ajouter
à tous les autres spécifiateurs: il s'agit de ``\verb!local!''.

``\verb!Local!'' signifie que chaque agent instance d'un agent
dispose de sa propre copie. (De ce fait, )

``\verb!Shared!'' signifie que chaque type d'agent dispose
de sa propre copie. Les données sont donc sur le serveur.

Tous les autres champs sont partagés par défaut et ses
données sont donc sur le serveur.

