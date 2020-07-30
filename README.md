Setup (Linux)
========

- [install docker engine](https://docs.docker.com/engine/install/ubuntu/)

- [install docker-compose](https://docs.docker.com/compose/)

- Run: ```docker-compose -d```

- Run: ```docker exec -it web-server bash```
    
    Inside container:
  
    * Run: ```composer install```
    
    * Run: ```php bin/console doctrine:database:create```
    
    * Run: ```php bin/console doctrine:schema:update --force```
  
    * Run: ```php bin/console cache:clear --env=prod```
    
    * Run: ```chown www-data:www-data app/sqlite.db```
  
    * Run: ```chown -R www-data:www-data var/cache```
      
    * Run: ```chown -R www-data:www-data var/logs```
      
    * Run: ```chown -R www-data:www-data var/sessions```
