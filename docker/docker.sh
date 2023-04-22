php bin/console doctrine:migrations:migrate --no-interaction
php bin/console doctrine:fixtures:load
exec apache2-foreground
