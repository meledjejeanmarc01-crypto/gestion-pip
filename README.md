# Projet d'Investissement Public — Côte d'Ivoire

Projet Laravel 13 **complet et prêt à installer** : ce dossier est un vrai squelette
Laravel (composer.json, artisan, config/, storage/, tests/...) sur lequel mon code
applicatif a déjà été fusionné (migrations, modèles, contrôleurs, routes, vues,
temps réel, carte). Il ne manque que `vendor/` et `node_modules/`, générés par
`composer install` / `npm install` (trop volumineux pour être livrés dans le zip).

## 1. Installation

```bash
cd civ-invest-app-complet
composer install
npm install

composer require laravel/reverb
php artisan reverb:install
```

Copiez le contenu de `.env.example.additions` dans votre fichier `.env`
(créé automatiquement par `composer install`), puis renseignez vos identifiants
MySQL (`DB_DATABASE=suivi_investissement_ci`, etc.) et créez cette base dans
phpMyAdmin/HeidiSQL si elle n'existe pas encore.

```bash
php artisan key:generate
php artisan migrate --seed
```

Le seeder crée automatiquement :
- les 31 régions de Côte d'Ivoire avec leurs coordonnées GPS (pour la carte)
- les 8 secteurs d'investissement
- un compte administrateur : `admin@plan.gouv.ci` / `MotDePasse@2026` (à changer après connexion)

## 2. Lancer l'application

Trois terminaux en parallèle, à la racine du projet :

```bash
php artisan serve            # http://127.0.0.1:8000
php artisan reverb:start     # serveur temps réel (WebSocket)
npm run dev                  # compilation CSS/JS à chaud
```

## 3. Temps réel

Chaque création/mise à jour de projet ou décaissement diffuse un événement
(`App\Events\ProjetMisAJour`, `App\Events\DecaissementEnregistre`) sur le canal
`projets.suivi` via Laravel Reverb. Le tableau de bord et la carte écoutent ce
canal avec Laravel Echo et se mettent à jour **sans recharger la page**.

## 4. Carte de la Côte d'Ivoire

`/carte` affiche une carte Leaflet (fond OpenStreetMap) centrée sur le pays, avec
un marqueur par région — taille selon le nombre de projets, couleur selon
l'avancement moyen. Les coordonnées des 31 régions sont dans
`database/seeders/RegionSeeder.php`.

## 5. Images incluses

- `public/images/infrastructures/*.svg` — une illustration vectorielle originale
  par secteur (routes, santé, éducation, agriculture, énergie, eau potable,
  transports, développement local), affichées sur le tableau de bord. Ce sont
  des créations originales (pas des photos), libres d'usage — vous pouvez les
  remplacer par de vraies photographies si vous le souhaitez, en gardant les
  mêmes noms de fichiers.

## 6. Logos officiels — ⚠️ à remplacer vous-même

`public/images/armoiries-ci.svg` et `public/images/logo-ministere-plan.svg`
sont des **gabarits provisoires** que j'ai dessinés, PAS les vrais fichiers
officiels. Je n'ai techniquement pas pu télécharger les fichiers réels des
armoiries de la République et du logo du Ministère de l'Économie, du Plan et
du Développement dans cet environnement (pas d'accès aux sites/hébergeurs
d'images). Pour les avoir en haute qualité :
- Armoiries : site de la Présidence de la République de Côte d'Ivoire, ou
  Wikipédia (article « Armoiries de la Côte d'Ivoire », fichiers libres de droit).
- Logo du Ministère : site officiel plan.gouv.ci ou tout document officiel du
  Ministère.

Téléchargez ces fichiers puis **remplacez** (même nom, même dossier) :
- `public/images/armoiries-ci.svg` (ou renommez en `.png` et adaptez le chemin
  dans `resources/views/auth/login.blade.php` et `layouts/app.blade.php`)
- `public/images/logo-ministere-plan.svg`

## 7. Modules livrés

- Authentification, 8 rôles utilisateurs, contrôle d'accès par rôle (middleware `role:`)
- Structures, hiérarchie géographique complète, secteurs
- CRUD des projets (créer/modifier/supprimer) avec filtres, budgets,
  décaissements, dépenses (avec pièce justificative), tâches/activités
- **Bailleurs** : liste, création, modification, total décaissé par bailleur
- **Indicateurs** : ajout/mise à jour par projet (valeur cible vs réalisée)
- **Documents** : dépôt de fichiers par projet (pièces administratives,
  décisions d'inscription au budget), téléchargement, suppression
- **Rapports** : générateur avec filtres (région, département, secteur, type
  de rapport), historique des rapports générés, export via impression
  navigateur (Ctrl+P → Enregistrer en PDF)
- Tableau de bord temps réel (KPI, graphiques Chart.js, illustrations sectorielles)
- Carte interactive du territoire (Leaflet)

## 8. Reste à compléter

- Export PDF/Excel natif (Laravel-DomPDF / Maatwebsite Excel) pour remplacer
  l'impression navigateur des rapports
- Interface de gestion des utilisateurs et des structures
- Policies Laravel en complément du middleware `role`
