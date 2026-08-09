# Kôvo API — Test Technique Backend

API REST développée avec Laravel .

## Stack technique

- Laravel 13
- MySQL (local) / PostgreSQL (production)
- Laravel Sanctum (authentification par token)

## Endpoints

| Méthode | Endpoint         | Description                     | Authentification |
|---------|------------------|----------------------------------|-------------------|
| POST    | /api/register    | Inscription d'un utilisateur     | Non               |
| POST    | /api/login       | Connexion                        | Non               |
| GET     | /api/profile     | Récupérer le profil connecté     | Oui (Bearer token)|
| PUT     | /api/profile     | Mettre à jour le profil          | Oui (Bearer token)|

## Installation locale

1. Cloner le repo
   
   git clone https://github.com/Mohamed00077/Test_technique_Backend_Kovo.git
   cd Test_technique_Backend_Kovo
  

2. Installer les dépendances
   
   composer install
  

3. Copier le fichier d'environnement et générer la clé
  
   cp .env.example .env
   php artisan key:generate
  

4. Configurer la base de données dans `.env`
   .env
   DB_CONNECTION=mysql | pgsql (En prod)
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=kovo_api
   DB_USERNAME=root
   DB_PASSWORD=
  

5. Créer la base de données puis migrer
   
   CREATE DATABASE kovo_api;
  
   
   php artisan migrate
   

6. Lancer le serveur
   
   php artisan serve
  

## Déploiement

Le service est hébergé sur le plan gratuit de Render : après 15 minutes 
d'inactivité, il se met en veille. La première requête suivante peut prendre 
30-50 secondes le temps du redémarrage.

- URL API : https://kovo-api.onrender.com

## Documentation API
- URL Documentation : https://kovo-api.onrender.com/api/documentation


## Auteur

*Diabagate Mohamed*