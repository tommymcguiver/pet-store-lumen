# Pet Store

A Pet store microservice

## Getting Started

These instructions will get you a copy of the project up and running on your local machine.

### Running the project

With Docker:

```
git clone https://github.com/NizarBerjawi/pet-store-lumen.git

cd /path/to/pet-store-lumen

cp .docker/local/docker-compose.yml.example .docker/local/docker-compose.yml
```

Fill out the environment variables in `docker-compose.yml` and then run:

```
cd /path/to/pet-store-lumen

docker-compose -f .docker/local/docker-compose.yml up

```

After docker finished building and the container is up and running, run this from a different terminal:

```
cd /path/to/pet-store-lumen

docker-compose -f .docker/local/docker-compose.yml run pet.server php artisan migrate
```


After docker is done building, you can access the API at `localhost:8080` and the database at host: `127.0.0.1` using the credentials you set in the docker-compose.yml file.

## Built With

- [Lumen](https://lumen.laravel.com/) - The web framework used

## Authors

- **Nizar El Berjawi**
