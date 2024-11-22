composer install
bin/console doctrine:schema:create
bin/console --no-interaction doctrine:migrations:migrate