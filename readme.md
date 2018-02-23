# Laravel Blog Example (TDD)
This is a Laravel app example using tdd

## Set up
1.- Clone this repository.

2.- Copy .env.example contents into a new file called .env and config according the server.
```sh
$ cat .env.example > .env
```

3.- Run the following setup commands:
```sh
$ composer install
$ php artisan key:generate
```

4.- Run optimization commands (Production)
```sh
$ php artisan route:cache
$ php artisan config:cache
$ php artisan optimize
```

## Maintenance
```sh
$ php artisan down --message="Server on maintenance, please wait a few seconds" --retry=60
```

## Contributing
Commit structure:

{commit type}: { Commit description }

## Examples and commit types:
feat: Add beta sequence

fix: Remove broken confirmation message

style: Convert tabs to spaces

docs: Explain hat wobble

chore: Add Oyster build script

test: Ensure Tayne retains clothing

refactor: Share logic between 4d3d3d3 and flarhgunnstow