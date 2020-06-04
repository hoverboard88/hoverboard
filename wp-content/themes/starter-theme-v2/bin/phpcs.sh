#!/bin/bash

# Runs phpcs test
composer install --dev
./vendor/bin/phpcs ./*.php ./modules/**/*.php ./inc/*.php ./templates/*.php --standard=WordPress -n --exclude=WordPress.PHP.DontExtract