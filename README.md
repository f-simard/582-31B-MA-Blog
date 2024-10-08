# 582-31B-MA-Blog
Projet Programmation avancée

## TP3
Le TP3 applique les privilèges aux différentes actions, ajoute un journal de bord qui enregistre les pages accédées par chaque utilisateur et ajoute la fonctionnalité d'ajouter un avatar au profil.

### Privilèges et utulisateurs
Les administrateurs ont tous les droits d'ajout, modification et suppression.
Les utilisateurs enregistrés peuvent ajouter des articles; modifier et supprimer ceux dont ils sont l'auteur. Ils peuvent aussi modifier leur profil, à l'exception de leur username et avatar.
Les invités peuvent consulter les articles et se créer un compte.

###Liens
Le log est accessible dans le menu Admin

###Fonctionnalité au choix
La fonctionnalité ajoutée est celle pour téléverser des images à la création d’un compte. Celle-ci est utilisée comme avatar. Elle est visible dans le profil de l’utilisateur
**Note** : Le chemin pour sauvegarder les fichiers est *hardcodé* sur WebDev mais elle est dynamique dans le fichier github.


### Liens
https://e2396414.webdev.cmaisonneuve.qc.ca/blog/

## TP2
Le sujet du TP2 2 est le même que celui du TP1. L'entiéreté du projet a été modifié en MVC.

### Note
Les catégories et tages peuvent être modifiés.

### WebDev
Je n’arrive pas à afficher les autres pages autres que l’accueil.
J’ai tenté de mettre des echos afin de déterminer si
* On entre dans /route/web.php : OUI
* Les routes sont enregistrées : OUI
* On dispatch : OUI

Seule la route ‘’ (sans url) retourne une page. Si un autre contrôleur est mis dans la route ‘’, la page est retournée.
Le message d’erreur indique que le fichier ne peut être retourné.

L'erreur semble venir du fichier .htaccess. Sur la version locale, si l'utilisateur écrit n'importe quoi après le chemin vers le dossier contenant le index.php, une page erreur 404 est retournée. Cependant, sur webdev, le message est "File not found.".

## Instruction d'installation

Le dossier Diagram contient le schema ER, et les requêtes SQL pour créer les tables dans workbench et dans phpMyAdmin (_webdev).
Git: https://github.com/f-simard/582-31B-MA-Blog.
Webdev: https://e2396414.webdev.cmaisonneuve.qc.ca/blog/


## Annexe (TP1)
Le sujet choisi est un site de blog.
L'utilisateur peut voir et écrire des articles.
Chaque article peut seulement avoir été écrit par une personne. Ils contiennent minalement un titre, un contenu. Les tags et les catégories sont facultatifs. Les catégories sont tirées d'une liste établie par les administrateurs. Les tags peuvent être ajoutés librement. La liste est "case-sensitive". Les autres champs tels la date de création sont remplis automatiquement à la création de l'article.
Le titre, contenu d'un article peuvent être modifié par l'auteur de l'article. L'horodage de mise à jour est modifié. L'horodage de la création reste inchangée.
Les administrateurs ont des droits en plus tels que supprimer un article, modifier la liste des catégories et des tags. Toutes ces actions sont dans le panneau admin.
À court terme, l'auteur est rempli manuellement dans le formulaire en entrant un nom d'utilisateur. Cependant, il sera rempli automatiquement lorsqu'un système d'authentification sera mis en place.
Il en va de même pour la modification des catégories et des tags. Tout le monde peut effectuer ces modifications jusqu'à ce que l'authentification soit implémentée.


### Note
Pour ce TP, les catégories et les tags ne peuvent pas être modifiés.
