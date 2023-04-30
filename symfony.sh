php bin/console doctrine:migrations:migrate --no-interaction
# fixture pour la production
php bin/console doctrine:fixtures:load
exec apache2-foreground
