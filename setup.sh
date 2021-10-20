#! /bin/bash
cp .env.example .env

./sail down --rmi all -v || true

./sail build

./sail up -d

./sail composer install

./sail artisan key:generate

./sail artisan migrate --seed
