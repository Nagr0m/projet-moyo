## Description
Projet de fin de formation de développeur multimédia.

## Pré-requis
Assurez-vous d'avoir [**composer**](https://github.com/composer/composer) et [**npm**](https://github.com/npm/npm) d'installé globalement sur votre machine.  
*Environnement : PHP 7.1*
## Installation
### Base de données
Créer une base de données vide dédiée au projet (*par défaut MySQL, interclassement `utf8mb4_general_ci`, moteur InnoDB*).
### Variables d'environnement
Dupliquer le fichier `.env.example` en `.env` à la racine du projet. Et remplir les champs du fichier en remplaçant les données d'exemple.
### (Optionnel) Inscription Google ReCaptcha
Pour utiliser les pages contact/commentaires du projet, il faut récupérer les clés publiques et privées en enregistrant l'application à [ce lien](https://www.google.com/recaptcha/admin) et entrer les clés dans ces valeurs du `.env` :
```
RECAPTCHA_PUBLIC=
RECAPTCHA_SECRET=
```
### Installation
Entrer la commande :
```
composer first-install
```

## Crédits
- [Laravel](https://github.com/laravel/laravel)
- [MaterializeCSS](https://github.com/Dogfalo/materialize)
- [Normalize.css](https://github.com/necolas/normalize.css)
- [Grillade.css](https://knacss.com/grillade/)
- [Typicons](https://github.com/stephenhutchings/typicons.font)
