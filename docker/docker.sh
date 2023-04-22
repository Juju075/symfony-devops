php bin/console doctrine:migrations:migrate --no-interaction
php bin/console doctrine:fixtures
exec apache2-foreground
