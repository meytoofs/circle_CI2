# install
- set DATABASE_URL in .env
    - Créer un fichier .env.local à la racine
    - y coller `DATABASE_URL=mysql://db_user:db_password@127.0.0.1:3306/db_name?serverVersion=5.7`
    - remplacer db_user et db_password au besoin
    - remplacer le nom de la database (se_nourrir_demain)
- install:
```
composer install
yarn install
yarn build 
php bin/console doctrine:database:create
php bin/console doctrine:migration:migrate
```
