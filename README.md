# Kôvo API — Test Technique Backend

API REST développée avec Laravel .

## Stack technique

- Laravel 13
- MySQL
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
   \`\`\`bash
   git clone https://github.com/Mohamed00077/Test_technique_Backend_Kovo.git
   cd kovo-api
   \`\`\`

2. Installer les dépendances
   \`\`\`bash
   composer install
   \`\`\`

3. Copier le fichier d'environnement et générer la clé
   \`\`\`bash
   cp .env.example .env
   php artisan key:generate
   \`\`\`

4. Configurer la base de données dans `.env`
   \`\`\`env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=kovo_api
   DB_USERNAME=root
   DB_PASSWORD=
   \`\`\`

5. Créer la base de données puis migrer
   \`\`\`sql
   CREATE DATABASE kovo_api;
   \`\`\`
   \`\`\`bash
   php artisan migrate
   \`\`\`

6. Lancer le serveur
   \`\`\`bash
   php artisan serve
   \`\`\`

## Déploiement

- URL API : 

## Documentation API



## Auteur

*Diabagate Mohamed*