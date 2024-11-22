#!/bin/bash

# Installiere Composer-Abhängigkeiten
echo "Installiere Composer-Abhängigkeiten..."
composer install --no-interaction --optimize-autoloader

# Warte, bis die Datenbank bereit ist
#echo "Warte auf die Datenbankverbindung..."
#until nc -z -v -w30 db 3306; do
#  echo "Warte auf MariaDB..."
#  sleep 5
#done

# Führe Datenbankmigrationen aus
echo "Führe Datenbankmigrationen aus..."
php bin/console doctrine:database:create --if-not-exists
php bin/console doctrine:migrations:migrate --no-interaction

# Starte den PHP-FPM-Prozess
echo "Starte PHP-FPM..."
exec "$@"
