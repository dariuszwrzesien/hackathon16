# Hackathon 2016

## HOW TO START

```
cd /var/www
git clone git@vm-git.fp.lan:dwrzesien/vm-hackathon16.git
cd /var/www/vm-hackathon16
vagrant up
cd /var/www/vm-hackathon16/hackathon16
git clone git@vm-git.fp.lan:mksiazek/Hackathon.git .
composer install
```

Add this to hosts file:
`192.168.56.101 hackathon16.dev`

## DATABASE

### Drop current database

```
$: php bin/console doctrine:schema:drop --force
```

### Update database schema

```
$: php bin/console doctrine:schema:update --force
```