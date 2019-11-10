# Requirements
 - install nodejs
 - install yarn
 - install composer
# - Local setup 
run:
```bash
cd app 
composer install
php bin/console doctrine:schema:update --dump-sql --force
php bin/console doctrine:fixtures:load
yarn install
php bin/console server:run
yarn encore dev --watch
```  