# contact-test
## Using Symfony 4 and PHP 7
* To clone the project : `git clone https://github.com/vayouva/contact-test`
* Set up the database in the`.env` file : `DATABASE_URL=mysql://username:password@127.0.0.1:3306/itefficience`
* Set up the mailer in the`.env` file : `MAILER_URL=gmail://username@gmail.com:password@localhost`
* Create the database using : `php bin/console doctrine:database:create`
* Loading the fixtures : `php bin/console doctrine:fixtures:load`

----