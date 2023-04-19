# E-ticket
E-ticket, est une application de réservation de tickets en ligne. Vous devez mettre en place un `API` **RestFull**

## Langage
Les langages qui doivent être utilisés sont, PHP, TypeScript ou Java, en ce qui concerne le framework, vous avez libre choix.

## Architecture
Clean code ou Hexagonal architecture

## Base de données
- PostgreSQL

### Exigences de l'application
* Les utilisateurs doivent pouvoir se connecter à l'application en utilisant leur adresse e-mail et leur mot de passe. S'il s'agit d'un nouvel utilisateur, il doit pouvoir s'inscrire en fournissant les informations nécessaires telles que le nom, l'adresse e-mail et le mot de passe.
* Les utilisateurs doivent pouvoir rechercher des événements disponibles en spécifiant la ville et la date de l'événement. L'application doit renvoyer une liste d'événements correspondants avec les informations suivantes : nom de l'événement, date, heure, emplacement et prix.
* Les utilisateurs doivent pouvoir réserver des tickets pour un événement spécifique en fournissant le nombre de tickets et les informations du titulaire de la carte. L'application doit confirmer la réservation et envoyer un e-mail de confirmation au titulaire de la carte.
* Les administrateurs doivent pouvoir ajouter des événements à l'application en fournissant les informations nécessaires telles que le nom de l'événement, la date, l'heure, l'emplacement et le prix.

### Exigences techniques
* L'application doit être développée en utilisant l'architecture Hexagonal.
* L'application doit être développée en utilisant soit Node.js, PHP ou Java.
* L'application doit utiliser une base de données relationnelle pour stocker les données des utilisateurs, des événements et des réservations.
* L'application doit être testée unitairement et intégrée à l'aide d'une bibliothèque de tests.
* L'application doit être livrée avec un script d'installation et une documentation technique complète.
* L'API doit etre documenter avec **Swagger**

### Tâches
* Créer un diagramme d'architecture Hexagonal pour l'application.
* Créer une base de données relationnelle pour stocker les données des utilisateurs, des événements et des réservations.
* Écrire le code pour les fonctionnalités de connexion et d'inscription des utilisateurs.
* Écrire le code pour les fonctionnalités de recherche d'événements et de réservation de tickets.
* Écrire des tests unitaires et intégrés pour toutes les fonctionnalités.
* Écrire un script d'installation pour l'application et fournir une documentation technique complète.

### Bon à savoir
* Nous évaluerons votre code en fonction des critères suivants:
* Respect de l'architecture Hexagonal.
* Qualité du code et respect des meilleures pratiques de développement.
* Qualité et pertinence des tests unitaires et intégrés.
* Qualité de la documentation technique.
* Respect des exigences fonctionnelles et techniques.
* Capacité à livrer un code fonctionnel et bien testé dans les délais impartis.