## Aura Kingdom Web

### Requirements
1. GitHub Account
2. Composer & Git - [Complete steps 1 & 2 on this tutorial](https://www.digitalocean.com/community/tutorials/how-to-install-and-use-composer-on-ubuntu-14-04)
3. PHP 5.5.9 or higher
4. PHP GD extension, not sure if you have it? Run `apt-get install php5-gd; service apache2 restart`

### Setup

Download the latest release and upload the files.

First you need to rename `.env.example` to `.env`

Then set the permissions to 777 for the following directories/files:

- storage/app/
- storage/framework/
- storage/logs/
- bootstrap/cache/
- .env

Next, edit the `.env` file and change the database credentials.

**Note:** You will need to make a new database for the panel to store it's data.

**Note:** Make sure your inside the `aura-kingdom-web` directory when you run the commands.

Run the following command to install all the required packages:
````
composer install
````

The next step is to create all the database tables and default records, run the following command:
````
php artisan migrate --seed
````

Finally, run this last command to generate an application key:
````
php artisan key:generate
````

**Note:** If you receive a 500 error after installation, redo the permissions again.

If you receive any other errors please create an [issue](https://github.com/huludini/aura-kingdom-web/issues).