# SGSPIP — Système de Gestion et de Suivi des Projets d’Investissement Public

## 📌 Présentation

**SGSPIP** est une application web destinée à la **gestion, au suivi et au pilotage des projets d’investissement public en Côte d’Ivoire**.

L’application permet de centraliser les informations relatives aux projets d’investissement public, depuis leur planification jusqu’à leur clôture. Elle facilite le suivi de l’avancement physique, des budgets, des décaissements, des dépenses, des tâches et des indicateurs de performance.

SGSPIP a pour objectif d’améliorer la **centralisation des données**, le **suivi des projets**, le **reporting** et l’aide à la **prise de décision**.

---

## 🎯 Objectifs du projet

Le système permet notamment de :

* Centraliser les informations relatives aux projets d’investissement public.
* Suivre l’état d’avancement des projets.
* Suivre les budgets prévisionnels.
* Enregistrer les décaissements financiers.
* Suivre les dépenses liées aux projets.
* Gérer les tâches et leur progression.
* Suivre les indicateurs de performance.
* Gérer les structures responsables des projets.
* Organiser les projets selon leur localisation géographique.
* Gérer les secteurs d’intervention et les bailleurs.
* Faciliter la production d'informations nécessaires au reporting.
* Fournir un tableau de bord permettant de visualiser les principales statistiques.

---

## 🚀 Fonctionnalités

### 🔐 Authentification et gestion des utilisateurs

Le système dispose d'un système d'authentification permettant de sécuriser l'accès à l'application.

Les utilisateurs peuvent être associés à différents rôles, notamment :

* `admin_national`
* `responsable_national`
* `responsable_regional`
* `responsable_departemental`
* `responsable_projet`
* `agent_financier`
* `agent_suivi_evaluation`
* `decideur`

La gestion des rôles permet d'adapter les accès aux différentes responsabilités des utilisateurs.

---

### 📊 Tableau de bord

Le tableau de bord permet de visualiser rapidement :

* Le nombre total de projets.
* Les projets en cours.
* Les projets terminés.
* Les projets en retard.
* Le budget prévisionnel.
* Les décaissements.
* Les dépenses.
* L'avancement physique moyen.
* La répartition des projets par région.
* La répartition des projets par secteur.
* Les projets récemment enregistrés.

---

### 📁 Gestion des projets

Chaque projet peut contenir différentes informations :

* Intitulé du projet.
* Description.
* Localisation.
* Secteur.
* Structure responsable.
* Bailleurs.
* Coût prévisionnel.
* Dates de début et de fin.
* Statut.
* Niveau d'avancement physique.
* Informations complémentaires.

Les projets peuvent être suivis tout au long de leur cycle de vie.

---

### 💰 Gestion financière

SIGPIP permet de gérer les informations financières associées aux projets :

* Budgets prévisionnels.
* Décaissements.
* Dépenses.
* Montants financiers.
* Suivi de l'exécution financière.

Ces informations permettent de comparer les prévisions avec les réalisations.

---

### ✅ Gestion des tâches

Les tâches permettent de décomposer les projets en différentes activités.

Le système permet notamment de suivre :

* Les tâches d'un projet.
* Leur état d'avancement.
* Leur période d'exécution.
* Leur responsable.
* Leur progression.

---

### 📈 Indicateurs de performance

Les indicateurs permettent de mesurer les performances des projets.

Ils peuvent être utilisés pour suivre :

* Les objectifs.
* Les résultats attendus.
* Les valeurs prévues.
* Les valeurs réalisées.
* Les taux d'avancement.

---

### 🌍 Gestion géographique

Le système prend en compte l'organisation administrative de la Côte d'Ivoire.

Les données géographiques peuvent être organisées selon :

```text
District
   └── Région
        └── Département
             └── Sous-préfecture
                  └── Commune
```

Cette organisation permet de rattacher les projets à leur localisation administrative.

---

### 🏢 Structures

Le système permet de gérer les structures intervenant dans les projets d'investissement public.

Une structure peut être associée à :

* Des utilisateurs.
* Des projets.
* Des responsabilités administratives.

---

### 🤝 Secteurs et bailleurs

SGSPIP permet également de gérer :

* Les secteurs d'intervention.
* Les bailleurs de fonds.
* Les relations entre projets, secteurs et bailleurs.

---

### 📄 Documents

Les documents liés aux projets peuvent être centralisés dans l'application afin de faciliter leur consultation et leur gestion.

---

## 🗄️ Structure de la base de données

La base de données utilisée par SGSPIP est **MySQL**.

Les principales tables sont :

| Table              | Description                    |
| ------------------ | ------------------------------ |
| `users`            | Utilisateurs du système        |
| `structures`       | Structures administratives     |
| `districts`        | Districts de Côte d'Ivoire     |
| `regions`          | Régions                        |
| `departements`     | Départements                   |
| `sous_prefectures` | Sous-préfectures               |
| `communes`         | Communes                       |
| `secteurs`         | Secteurs d'intervention        |
| `bailleurs`        | Bailleurs de fonds             |
| `projets`          | Projets d'investissement       |
| `budgets`          | Budgets des projets            |
| `decaissements`    | Décaissements financiers       |
| `depenses`         | Dépenses                       |
| `taches`           | Tâches des projets             |
| `indicateurs`      | Indicateurs de performance     |
| `documents`        | Documents associés aux projets |

### Relations principales

```text
District
   │
   └── Région
          │
          └── Département
                  │
                  └── Sous-préfecture
                          │
                          └── Commune

Projet
 ├── Région
 ├── Secteur
 ├── Bailleurs
 ├── Budget
 ├── Décaissements
 ├── Dépenses
 ├── Tâches
 ├── Indicateurs
 └── Documents
```

---

## 🛠️ Technologies utilisées

### Backend

* **PHP 8.3+**
* **Laravel 13**

### Frontend

* **HTML5**
* **CSS3**
* **JavaScript**
* **Blade**
* **Vite**

### Base de données

* **MySQL**
* **Eloquent ORM**

### Gestion des dépendances

* **Composer**
* **NPM**

### Gestion de versions

* **Git**
* **GitHub**

---

## 📋 Prérequis

Avant d'installer SGSPIP, assurez-vous d'avoir installé :

* PHP 8.3 ou supérieur
* Composer
* Node.js
* NPM
* MySQL
* Git

Vérifiez les installations avec :

```bash
php -v
composer -V
node -v
npm -v
git --version
```

---

## ⚙️ Installation

### 1. Cloner le projet

```bash
git clone https://github.com/meledjejeanmarc01-crypto/gestion-pip.git
```

Entrer dans le dossier :

```bash
cd gestion-pip
```

---

### 2. Installer les dépendances PHP

```bash
composer install
```

---

### 3. Installer les dépendances JavaScript

```bash
npm install
```

---

### 4. Configurer le fichier `.env`

Copier le fichier d'exemple :

### Windows PowerShell

```powershell
Copy-Item .env.example .env
```

### Linux / macOS

```bash
cp .env.example .env
```

---

### 5. Générer la clé Laravel

```bash
php artisan key:generate
```

---

### 6. Configurer MySQL

Créer une base de données MySQL nommée :

```text
suivi_investissement_ci
```

Puis modifier les informations suivantes dans `.env` :

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=suivi_investissement_ci
DB_USERNAME=root
DB_PASSWORD=
```

Adaptez `DB_USERNAME` et `DB_PASSWORD` à votre installation MySQL.

---

### 7. Exécuter les migrations

```bash
php artisan migrate
```

---

### 8. Insérer les données initiales

```bash
php artisan db:seed
```

Les Seeders permettent notamment d'initialiser les données géographiques et les secteurs/bailleurs.

---

### 9. Installer et compiler les ressources frontend

Pour le développement :

```bash
npm run dev
```

Pour une version de production :

```bash
npm run build
```

---

### 10. Démarrer le serveur Laravel

Dans un autre terminal :

```bash
php artisan serve
```

L'application sera généralement accessible à :

```text
http://127.0.0.1:8000
```

---

## 🔑 Compte administrateur

Un compte administrateur peut être créé dans la base de données ou via un Seeder.

Exemple de rôle administrateur :

```text
admin_national
```

Pour des raisons de sécurité, **aucun mot de passe réel ne doit être enregistré dans ce README**.

---

## 📂 Architecture du projet

```text
gestion-pip/
│
├── app/
│   ├── Http/
│   │   └── Controllers/
│   ├── Models/
│   └── ...
│
├── bootstrap/
│
├── config/
│
├── database/
│   ├── migrations/
│   ├── seeders/
│   └── ...
│
├── public/
│
├── resources/
│   ├── views/
│   ├── css/
│   └── js/
│
├── routes/
│   └── web.php
│
├── storage/
│
├── tests/
│
├── .env.example
├── artisan
├── composer.json
├── package.json
└── README.md
```

---

## 🔄 Cycle de suivi d'un projet

Le fonctionnement général peut être représenté ainsi :

```text
Planification
      ↓
Enregistrement du projet
      ↓
Validation
      ↓
Budgétisation
      ↓
Exécution
      ↓
Décaissements
      ↓
Suivi des tâches
      ↓
Mesure des indicateurs
      ↓
Évaluation
      ↓
Clôture du projet
```

---

## 📊 Reporting

SGSPIP facilite le reporting grâce à la centralisation des informations relatives aux projets.

Les responsables peuvent notamment consulter :

* L'état des projets.
* L'avancement physique.
* L'exécution financière.
* Les dépenses.
* Les décaissements.
* Les indicateurs.
* La répartition géographique.
* Les projets en retard.

Ces informations peuvent contribuer à la prise de décision et au pilotage des investissements publics.

---

## 🔒 Sécurité

Le projet applique les mécanismes de sécurité fournis par Laravel, notamment :

* Authentification.
* Hachage des mots de passe.
* Protection CSRF.
* Validation des données.
* Gestion des sessions.
* Contrôle des accès selon les rôles.

### Important

Le fichier `.env` contient des informations sensibles et ne doit **jamais** être publié sur GitHub.

Le projet doit utiliser :

```text
.env
```

pour la configuration locale et :

```text
.env.example
```

pour fournir un modèle de configuration sans informations sensibles.

---

## 🚧 Évolutions prévues

Les évolutions possibles du projet comprennent :

* Carte interactive de la Côte d'Ivoire.
* Géolocalisation des infrastructures.
* Notifications en temps réel.
* Génération de rapports PDF.
* Export Excel.
* Statistiques avancées.
* Graphiques interactifs.
* Historique des modifications.
* Système de notifications.
* Amélioration du contrôle des permissions.
* Déploiement sur un serveur de production.

---

## 🎓 Contexte académique

Ce projet est réalisé dans le cadre d'un **projet de formation / stage de BTS** portant sur la conception et la mise en place d'un système de gestion et de suivi des projets d'investissement public.

Il constitue une application de démonstration destinée à illustrer l'utilisation de technologies web modernes pour la gestion des données, le suivi des projets et l'aide à la décision.

---

## 👨‍💻 Auteur

**Jean Marc Meledje**

GitHub :

**meledjejeanmarc01-crypto**

Projet :

**SGSPIP — Système Gestion et Suivi des Projets d'Investissement Public**

---

## 📄 Licence

Ce projet est destiné à un usage académique et de démonstration.

Toute utilisation, modification ou redistribution dans un contexte professionnel doit respecter les droits et autorisations applicables.

---

## ⭐ Remerciements

Merci à toutes les personnes ayant contribué à la conception, au développement, aux tests et à l'amélioration de SIGPIP.

---

## 📌 Dépôt GitHub

Le code source du projet est disponible sur GitHub :

https://github.com/meledjejeanmarc01-crypto/gestion-pip
