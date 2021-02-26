#!/bin/bash

# Runs phpcs test
composer install --dev
./vendor/bin/phpcs ./**/*.php --ignore=./vendor --standard=WordPress -n --exclude=WordPress.PHP.DontExtract
