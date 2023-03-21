<h3 align="center"> Tout mes commits se trouve sur mon Github perso </h3>

# <p align="center">Projet "E-commerce Store"</p>
Ce projet est une application web d'e-commerce qui permet aux utilisateurs de parcourir les produits disponibles, de les trier en fonction de différents critères et de les ajouter à leur panier.

## Fonctionnalités
### Partie back-office administrateur (EASY ADMIN)
- CRUD de produits (Create, Read, Update, Delete)
- CRUD de catégories de produits
- CRUD de users (Create, Read, Update, Delete)

### Partie front-office
- Inscription / connexion utilisateurs
- Afficher une page d’accueil avec la liste des catégories de produits
- Chaque catégorie de produits doit avoir une URL dédiée (dynamique)
- Sur chaque page de catégorie de produits, il doit y avoir la liste des produits liés à cette catégorie
- Possibilité de trier la page catégorie de produits du + cher au - cher
- Possibilité de trier la page catégorie de produits du - cher au + cher
- Sur la page produit, afficher les détails du produit
- Il faut afficher d’autres produits de la même catégorie sur la page produit
- Possibilité d'ajouter/supprimer des produits au panier (session)
- Créer une page panier avec un récapitulatif des produits en session
- Lors de la soumission du panier, enregistrer la commande (utilisateur, produit(s) et quantité) et retirer les stocks de produits

### Bonus 
- Gestion error 404

# <p align="center">Setup Symphony</p>
```bash
symphony new nomDuFichier
```

```bash
composer require maker --dev
```

```bash
composer require twig
```
```bash
composer require orm
```
<hr>


# <p align="center">Setup db</p>

## 🔗 Link db

Copier le fichier ``.env`` en fichier ``env.local``
<br>
Commenter la l.28
<br>
Décommenter la l.27 et changer les infos de la db, puis la créer

## 🛠️ Create table
```bash
php bin/console make:entity
```
Choisir le nom de sa table et de ses colones

## 🛠️ Create db and push
       
```bash
php bin/console doctrine:database:create
```

```bash
php bin/console make:migration
```

```bash
php bin/console doctrine:migrations:migrate
```
<hr>

# <p align="center">Setup Fixtures  </p>

```bash
php bin/console make:fixture
```
Rentrer les infos des tables dans le fichier ``src/DataFixtures/AppFixtures.php``
```bash
php bin/console doctrine:fixture:load
```
