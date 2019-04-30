# contact-test
## Using Symfony 4 and PHP 7
* To clone the project : 
```
git clone https://github.com/vayouva/contact-test`
```
* Set up the database in the`.env` file : 
```
DATABASE_URL=mysql://username:password@127.0.0.1:3306/itefficience
```
* Set up the mailer in the `.env` file : 
``` 
MAILER_URL=gmail://username@gmail.com:password@localhost
```
* Set up the mailer in the `swiftmailer.yaml` file :  
``` 
username: 'username@gmail.com' password: 'password'
```
* Set up the dev environment : 
```
composer require symfony/web-server-bundle --dev
```
* Create the database using : 
```
php bin/console doctrine:database:create
```
* Migrate the database : 
```
php bin/console make:migration
```
then 
``` php bin/console doctrine:migrations:migrate```
* Loading the data to the database : 
``` 
php bin/console doctrine:fixtures:load
```
* Run the code : 
```
php bin/console server:run
```
----