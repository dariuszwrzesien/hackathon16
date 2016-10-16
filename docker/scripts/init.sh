# install composer dependencies
composer install

# setting godmode for required folders
chown -R nobody:nogroup /var/www/symfony/var/cache
chown -R nobody:nogroup /var/www/symfony/var/logs
chmod -R 777 /var/www/symfony/var/cache
chmod -R 777 /var/www/symfony/var/logs

# initialize database
php /var/www/symfony/bin/console doctrine:database:create
php /var/www/symfony/bin/console doctrine:schema:update --force
php /var/www/symfony/bin/console doctrine:fixtures:load --no-interaction
