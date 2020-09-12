# Simple Social Network API

## C'est quoi ce projet ?

Ce projet c'est un TP pour la plateforme [Made](https://made.alwaysdata.net/). Il a pour intérêt de s'entrainer à respecter les principes SOLID, à implémenter la Clean Architecture et à coder en TDD. Il s'agit d'une API de réseau social qui fonctionne sur un système similaire à Twitter. On développera par la suite une SPA qui consommera l'API de ce projet.

## La liste des use-cases

Voici une checklist des use-cases du projet :
- [X] Se connecter
- [X] Se déconnecter
- [X] S'inscrire
- [X] Modifier son profil
- [X] Créer un post
- [X] Éditer un post
- [X] Supprimer un post
- [X] Voir un profil
- [X] S'abonner à un utilisateur
- [ ] Se désabonner d'un utilisateur
- [X] Chercher un utilisateur
- [ ] Afficher un fil d'actualités
- [ ] Bannir un utilisateur (admin)
- [ ] Supprimer un post (admin)
- [ ] Supprimer un utilisateur (admin)

## Ce repository n'est qu'une solution possible parmi une infinité

Dans ce repository, j'implémente la clean architecture à ma façon. Il n'y a pas qu'une façon de faire de la clean architecture puisqu'il ne s'agit en réalité que d'un concept qui vise à séparer le code métier des dépendances d'infrastructures ou d'interface utilisateur. Par ailleurs, j'ai ici fait le choix de coder cette API avec le langage PHP et le framework Laravel.

### Pourquoi Laravel ?

En réalité, je n'ai pas choisi Laravel car je le pensais plus adapté mais parce que je voulais voir comment adapter Laravel à ce type d'architecture. Finalement, je suis resté sur une structure de dossiers propre à Laravel et je n'ai pas trop joué avec mais on voit que mon code métier, situé dans le dossier `domain`, est bien agnostique de Laravel.

## Aller plus loin

Si vous souhaitez aller plus loin, voici quelques idées de fonctionnalités que vous pourriez implémenter :
- une image de profil ;
- un système de suggestions de relations ;
- suppression du compte (obligatoire pour un vrai projet)...

## J'ai trouvé des erreurs dans la correction

Si vous trouvez des erreurs ou que vous trouvez que certaines parties du code manquent de rigueur, n'hésitez surtout pas à faire une issue voir même une pull request pour la corriger.
