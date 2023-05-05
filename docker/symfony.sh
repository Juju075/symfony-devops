#php bin/console doctrine:migrations:migrate --no-interaction
# fixture pour la production
#php bin/console doctrine:fixtures:load
# start web server
exec apache2-foreground
