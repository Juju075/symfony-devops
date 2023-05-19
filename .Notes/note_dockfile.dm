Un dockerfile est un fichier texte (donc versionable) de description qui permet de
générer une image. Il est basé sur une image standard auquel on ajoute les
éléments propres à l’application que l’on veut déployer.


FROM permet de définir depuis quelle base votre image va être créée

LABEL maintainer permet de définir l’auteur de l’image

RUN permet de lancer une commande, mais aura aussi pour effet de créer une
image intermédiaire.

ADD permet de copier un fichier depuis la machine hôte ou depuis une URL

EXPOSE permet d’exposer un port du container vers l’extérieur

CMD détermine la commande qui sera exécutée lorsque le container
démarrera

ENTRYPOINT permet d’ajouter une commande qui sera exécutée par défaut

WORKDIR permet de définir le dossier de travail pour toutes les autres
commandes (par exemple RUN, CMD, ENTRYPOINT et ADD)
ENV permet de définir des variables d’environnements qui pourront ensuite
être modifiées grâce au paramètre de la commande run --env <key>=
<value>

VOLUMES permet de créer un point de montage qui permettra de persister les
données. On pourra alors choisir de monter ce volume dans un dossier
spécifique en utilisant la commande run -v