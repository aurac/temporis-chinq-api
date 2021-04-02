# Prérequis

PHP 7.4

PostgreSQL 12.6

[composer](https://getcomposer.org/download/)

[Symfony CLI](https://symfony.com/download)

# Setup l'environnement

Créer un fichier .env.local à la racine du projet. Ajouter la ligne:

    DATABASE_URL="postgresql://db_user:db_password@127.0.0.1:5432/db_name?serverVersion=12&charset=utf8".
    
Modifier les informations db_user, db_password et db_name avec les informations de connexion à votre base de données.

# Installation des dépendences

Lancer la commande suivante afin d'installer les dépendences requises au projet:

    composer install

# Création et initialisation de la base de données

Lancer la commande suivante afin de créer la base de données grâce aux informations présente dans le fichier .env.local:

    php bin/console doctrine:database:create

Lancer la commande suivante afin de générer les tables et les données initiales dans la base de données:

    php bin/console doctrine:migrations:migrate

**Optionnel**: Lancer la commande suivante afin de remplir la table des cartes avec des données de test:

        php bin/console doctrine:fixtures:load --group=cards --append

# Démarrer le serveur local

Lancer la commande suivante afin de démarrer le serveur web local fourni par symfony:

    symfony server:start
