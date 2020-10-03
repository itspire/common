# Itspire - Common

Itspire Common Classes

## Installing dependencies

```bash
docker run --rm -v $(pwd):/build -w /build registry.itspire.fr/devops/docker-webservers/composer:1.6.0 install --ignore-platform-reqs
```

## Running tests

### Manually

```bash
docker run --rm -v $(pwd):/build -w /build registry.itspire.fr/devops/docker-webservers/php-fpm-dev:1.6.0 /opt/.phpstorm_helpers/phpunit.php --configuration /opt/project/phpunit.xml
```

### via PHPStorm

TODO
