const Encore = require('@symfony/webpack-encore');

Encore
    // Configure l'environnement d'exécution (dev ou prod)
    .configureRuntimeEnvironment('dev')  // Ou 'prod' selon l'environnement
    // Définir le répertoire de sortie des fichiers compilés
    .setOutputPath('public/build/')
    // Définir le répertoire public pour l'accès aux fichiers dans le navigateur
    .setPublicPath('/build')
    // Ajouter le fichier CSS principal
    .addStyleEntry('app', './assets/styles/app.css')
    // Utiliser PostCSS (nécessaire pour Tailwind CSS)
    .enablePostCssLoader()
    // Activer les sourcemaps en mode développement
    .enableSourceMaps(!Encore.isProduction())
    // Générer des fichiers versionnés en production
    .enableVersioning(Encore.isProduction())

    // Active la méthode pour générer un fichier `runtime.js` unique
    .enableSingleRuntimeChunk();  // Ajoutez cette ligne pour résoudre l'erreur

module.exports = Encore.getWebpackConfig();
