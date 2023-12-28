composer install
bin/console doctrine:schema:create
bin/console doctrine:migrations:migrate