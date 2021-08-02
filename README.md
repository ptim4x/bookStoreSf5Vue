
<h1 align="center">Test Technique Dev Symfony</h1>

## Projet demandé 

cf [Doc Test Technique](./doc/Test%20technique%20Dev%20Symfony.pdf).

## Prérequis

- `docker` et `docker-compose` installé en local.
- Port http://localhost:80 disponible.

## Lancement container docker

   ```bash
   docker-compose up -d
   ```

## Installation du jeux d'essai (Fixtures)

   ```bash
   docker exec php-fpm bin/console doctrine:fixtures:load -n
   ```

## Urls utilisables

- Front (Vuejs) : http://localhost
- Api : http://localhost/api
- Admin : http://localhost/admin
    - email: admin@example.com
    - password: admin

## Arrêt du container docker

   ```bash
   docker-compose down
   ```
