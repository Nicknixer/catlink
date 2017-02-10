#Catlink

Nicknixer/linkcat based on Symfony Framework

##Some screenshots

Homepage

![alt tag](http://s8.hostingkartinok.com/uploads/images/2017/02/26c4ac4a88fac1e53b2006cb338736bf.png)

Sitepage

![alt tag](http://s8.hostingkartinok.com/uploads/images/2017/02/7c95f2a922da785f1f0f25dec5195e3f.png)

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


##Tests

To load test data to database:

$ php bin/console doctrine:fixtures:load

To run the tests:

$ phpunit