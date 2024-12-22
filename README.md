# Installation du Projet Symfony

Guide rapide pour installer ce projet Symfony sur un nouvel ordinateur.

## Prérequis

- **PHP** (≥ 8.1)
- **Composer**
- **Symfony CLI** (optionnel)
- Serveur web (Apache/Nginx ou Symfony server intégré)
- Base de données (MySQL/PostgreSQL/SQLite)
- **Node.js** et **npm** (si Webpack Encore est utilisé)

## Étapes d'Installation

### 1. Cloner le Projet


git clone https://github.com/votre-utilisateur/votre-repo.git
cd votre-repo

### 2. Installer les Dépendances PHP

```composer install```

### 3. Configurer les Variables d'Environnement

Copiez le fichier .env.example en .env :

```cp .env.example .env```

Modifiez le fichier .env pour définir la connexion à la base de données :

```DATABASE_URL="mysql://username:password@127.0.0.1:3306/nom_de_la_base"```

### 4. Configurer la Base de Données

Créez la base de données et appliquez les migrations :

```php bin/console doctrine:database:create```

```php bin/console doctrine:migrations:migrate```

### 5. Installer les Assets (si applicable)

```npm install```
```npm run dev```

### 6. Lancer le Serveur Symfony

```symfony serve```

Ou utilisez le serveur PHP intégré :

```php -S 127.0.0.1:8000 -t public```

### 7. Accéder au Projet

Ouvrez http://127.0.0.1:8000 dans votre navigateur.

<br><br><br>
PS : L'authentification ne fonctionne pas 😭