# install composer dependencies
composer install

# setup development environment parameters
cat <<EOT > /var/www/symfony/app/config/parameters.yml
parameters:
    database_host: mysqldb
    database_port: null
    database_name: mydb
    database_user: user
    database_password: userpass
    mailer_transport: smtp
    mailer_host: localhost
    mailer_user: null
    mailer_password: null
    secret: ThisTokenIsNotSoSecretChangeIt
EOT

# setting godmode for required folders
chown -R nobody:nogroup /var/www/symfony/var/cache
chown -R nobody:nogroup /var/www/symfony/var/logs
chmod -R 777 /var/www/symfony/var/cache
chmod -R 777 /var/www/symfony/var/logs

# initialize database
php /var/www/symfony/bin/console doctrine:database:create
php /var/www/symfony/bin/console doctrine:schema:update --force
php /var/www/symfony/bin/console doctrine:fixtures:load --no-interaction
