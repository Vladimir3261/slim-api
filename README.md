Installation
--
- clone this repository
- run

```bash
composer install
```
- edit config file located in root directory (.env). Example:
```dotenv
mode=dev
db_host=localhost
db_port=3306
db_name=slim
db_user=root
db_password=123456
db_encoding=utf8
```
- Run migrations (this command will create database tables) 

 ```bash
php vendor/bin/phinx migrate -c migrate.php
```
      
- run server (dev mode)

```bash
composer start
```

 If you use SSL certificate - enable ssl validation in:
 
 ```./src/middleware.php```
 
 # Using docker
 
- Run container:

```bash
docker-compose up
```

This command will start several containers that includes:
 - php-fpm
 - nginx
 - mysql-server (for this will be created volume called silm_mysql)
 
 Apply migrations:
 
    docker-compose exec php php vendor/bin/phinx migrate -c migrate.php
 
 For run docker containers as daemon add flag ```-d```
 
    docker-compose up -d

For first time docker-compose will build containers, so it can tool little more time, that in compose up
docker will be use already created containers. To build new containers run docker with flag ```--build```

    docker-compose up --build
    
-  Note: For recreate mysql container you should remove created volume.


Stop containers

    docker-compose down

.env file for local development and .env file for docker containers is separated,
 so if you add some specific configuration to docker application, add that config in .docker-env file

# Migrations

Add new migration:
    
    php vendor/bin/phinx create Message -c migrate.php
    
 Run migrations:
 
    php vendor/bin/phinx migrate -c migrate.php

Rollback migrations:

    php vendor/bin/phinx rollback -c migrate.php