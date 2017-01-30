#Catlink

Nicknixer/linkcat based on Symfony Framework

##Installing and setting up

- clone the repo 

$ git clone https://github.com/Nicknixer/catlink.git

- install vendors 

$ composer install 

or

$ php composer.phar install 

- create database. (Maybe you'll need to configure your database connection information in app/config/parameters.yml)

$ php bin/console doctrine:database:create

- now you are ready to run the server

$ php bin/console server:run