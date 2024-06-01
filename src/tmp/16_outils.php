
\part{Outils associé à Dabsic}

\chapter{Coupleur de fonctions}

\section{Couplage par enveloppage}

Un coupleur de fonction est disponible dans l'implémentation
de Dabsic: il s'agit d'un chargeur de bibliothèque dynamique
qui va inspecter un dossier établi par configuration pour
trouver ce qu'il lui faut.

Ce qu'il lui faut, ce sont donc des bibliothèques dynamiques
contenant une table de définition récupérable via une fonction
dont le prototype C et l'environnement serait le suivant
(la fonction \verb!wrap_strchr! est un exemple):\\

\begin{verbatim}
typedef struct                  s_dynamic_function
{
  void                          *c_function;
  char                          dabsic_prototype[256];
}                               t_dynamic_function;

typedef struct                  s_function_list
{
  int32_t                       func_count;
  const t_dynamic_function      *list;
}                               t_function_list;

int64_t                         wrap_strchr(const char          *str,
                                            size_t              len,
                                            int64_t             chr)
{
  (void)len;
  return (strchr(str, chr));
}

t_dynamic_function              gl_dynamic_function[N] =
{
  {
    &wrap_strchr,
    "integer strchr(const string &str, int char)"
  },
  .etc.
};

const t_function_list           *dabsic_dynamic_functions(void)
{
  static const t_function_list  lst =
  {
    sizeof(gl_dynamic_function) / sizeof(gl_dynamic_function[0]),
    &gl_dynamic_function[0]
  };
  return (&lst);
}
\end{verbatim}

La fonction ``\verb!dabsic_dynamic_functions!'' sera recherché par
l'interprète qui l'appellera pour en retirer la liste des
fonctions contenus par la bibliothèque dynamique et dont
la méthode d'appel sera définie par l'attribut
``\verb!dabsic_prototype!'' dans ``\verb!t_dynamic_function!''.

Le pointeur \verb!c_function!, quand à lui, doit être une représentation
C de la fonction Dabsic : par exemple, ici, le premier paramètre
est une chaine de caractère, alors la fonction recoit un pointeur
vers la donnée suivi de la taille de la donnée. Ensuite,
la fonction est supposée recevoir un entier, ce qui est représenté
par un \verb!int64_t! dans cette fonction.
Si celle-ci avait prit un réel, elle aurait recu un double.

Un champ dont le type n'est pas clairement traduit dans le
prototype sera passé en tant que pointeur vers l'interface
champ de Dabsic. Dans mon implémnetation actuelle, il s'agit
donc d'un pointeur vers ``\verb!hbs::Node!''.

Dabsic ignore complètement ce qu'il se passe dans une
bibliothèque externe, ainsi, il convient de faire attention
lorsqu'elles sont ajoutés. Les erreurs classiques
types erreur de segmentation, division par zéro, demande
explicite d'arret du programme ou tube cassé
peuvent être rattrapé par Dabsic si certains aménagement
sont fait. Il est possible de spécifier un temps maximal
passé dans une fonction avec \verb!--maximum-mods-time=n! ou n
est un nombre entier positif de secondes.

Deux séries de dossiers sont inspecté par
l'interprète : \verb!DABSIC_LIBRARY_PATH! et \verb!DABSIC_UNSTABLE_LIBRARY_PATH!
sont des variables d'environnement contenant ces séries.
La seconde série sera protégée par les garde-fous de Dabsic.

Evidemment, ces garde-fous ne peuvent pas tout rattraper,
ont un certain cout en terme de performances et certaines
conséquences d'une erreur dans un module peuvent compromettre
la stabilité de l'interprète et le faire planter malgré tout
à terme.

Ces garde-fous sont réalisé à partir de signaux et de sauts longs
dont la zone d'atterissage est situé après l'appel à une fonction
externe. En cas d'erreur, l'erreur est ignorée et le programme
reprend après l'appel de la fonction. La valeur de retour renvoyé
est alors une valeur par défaut fonction du type du champ de
reception.

\section{Couplage direct}

La possibilité d'établir un couplage direct entre du script et
une fonction compilée m'a interessé dès ma première année
d'étude et avait donné naissance à l'époque à une fonction
que j'avais appellé ``\verb!dcall!'', pour ``\verb!Damdoshi call!'' mais
surtout pour ``\verb!dynamic call!''.

Pourquoi ``\verb!dynamique!'' ? \`A priori, les appels de fonctions
ont toujours lieu à l'execution...

Tout simplement parceque la formation des paramétres n'est
pas dynamique en fait, elle est définie par le programme.
L'idée de l'appel dynamique est de passer une liste de
paramètre, contenu par exemple par une liste chainée, à une
fonction mais pas en tant que liste... bel et bien en tant
que paramètres normaux. En gros :\\

\begin{verbatim}
Retour Fonction(string a, int b, real c, struct *d)
{
  ..
}

Liste = { "Coucou!", 42, 5.7, &data };
Retour = DCall(Fonction, Liste)
\end{verbatim}

L'interet ? Pouvoir appeller n'importe quelle fonction
sans avoir à la typer dans son programme directement,
mais en pouvant disposer de sa définition dans une chaine
de caractère... Par exemple issu du chargement du fichier
en-tête (.h) dans laquelle elle est décrite.
A l'aide de la bibliothèque dlfcn, il est déjà possible
de disposer d'une adresse de fonction à pratir de son
nom... Reste alors à l'appeller.

A l'aide de ce système, il devient possible de construire
une enveloppe pour n'importe quelle bibliothèque compilée
sans avoir à le faire...

L'implémentation en 32 bits est triviale, suffisament pour
avoir pu le faire à l'époque. En 64 bits avec le ``\verb!fast-call!'',
c'est plus complexe (Mon implem actuelle couvre seulement des cas
triviaux sous Linux), mais voici déjà la méthode deployée
pour le 32 bits:\\

\begin{verbatim}
parameter* dcall(callsign *signature, size_t (*func)(), const callstack *params)
{
  register parameter *ucall asm(``rsi'');
  register const callnode *i asm(``edx'');
  register size_t eax asm(``eax'');
  register void (*fax)() asm(``eax'');

  (void)signature;
  ucall = &ucall_param;
  for (i = params->last; i != NULL; i = i->prev)
  {
    eax = i->parameter.bin;
    asm("push \%eax");
  }
  fax = func;
  (void)fax;
  asm("call *\%eax");
  for (i = params->last; i != NULL; i = i->prev)
    asm("add $4, \%esp");
  ucall->bin = eax;
  return (&ucall_param);
}
\end{verbatim}

Le code réel est disponible sur SourceForge, dans la lib BPT2 et
s'appelle ``\verb!ucall!''.

Au-delà de Dabsic, je pense que cette fonctionnalité (passer
d'une description en donnée d'une fonction à la possibilité
d'un appel) serait une belle adjonction à la LibC. Après, ce
n'est que mon humble avis.

\chapter{Environnement Dabsic}

Comme cela a été vu lorsqu'il a été question d'établir
un programme Dabsic en réseau, Dabsic est en mesure
d'agir comme démon. Il peut donc être employé comme
serveur de configuration: via un module de communication
que des services peuvent ajouter, il peuvent échanger
avec l'environnement Dabsic des informations comme
leur état ou leur configuration.

L'idée est de disposer en tant qu'administrateur d'une
plateforme unifiée pour traiter les aspects configuration
et monitoring des services d'une plateforme. Il est
de plus également possible de définir des programmes
d'interactions à l'aide de fonctions.

\section{Shell Dabsic}

Le shell Dabsic est un peu similaire à la console de débug
de Visual Basic ou de Javascript: il s'agit simplement
d'un endroit ou il est possible d'explorer les données,
d'executer une commande et de voir ce qui a été envoyé
sur les différentes sorties du programme.

Le shell Dabsic s'active avec l'option \verb!--shell!. Cela
provoque la création de deux fichiers: un fichier
standard ``\verb!dabout!'' et une fifo ``\verb!dabin!'' sur lesquels
vous pouvez lire et écrire. Vous pouvez ensuite utiliser
le binaire ``\verb!dash!'' en lui passant en paramètre les
deux fichiers dans l'ordre ci-dessus afin de vous
en servir.

En plus de toutes commandes dépendant presque intégralement
du programme que vous parcourez, il est possible
d'executer certaines commandes:

\begin{itemize}
  \item ``\verb!cd!'' permet de déplacer le point de vue.
  \item ``\verb!pwd!'' permet de connaitre la position du point de vue.
  \item ``\verb!ls!'' permet d'afficher le contenu du noeud où se
    trouve le point de vue.
\end{itemize}

Le shell dispose d'un agent spécialement pour lui dans
l'arbre Dabsic, il s'agit de l'agent... ``\verb!Shell!''.
A moins que son attribution de ticket ne soit re-spécifiée,
il est le détenteur du ticket ``\verb!Master!''.

