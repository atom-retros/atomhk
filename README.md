<div align="center">
<img src="https://i.imgur.com/9ePNdJ4.png" alt="Atom HK"/>
</div>

### What is Atom HK?
Atom HK is a standalone Habbo retro housekeeping, aiming to provide an easy and solid experience for you and your staff to manage various aspects of your hotel. It offers an easy development experience thanks to the use of Laravel & Bootstrap.

*Standalone means it is its own project / application, rather than being implemented directly into the CMS*

**What technologies is being used?**
- Laravel 9.x (Latest as of August 2022)
  [Laravel docs](https://laravel.com/docs/9.x).
- Vite [Vite docs](https://vitejs.dev/).
- Bootstrap
  [Bootstrap docs](https://getbootstrap.com/docs/4.0/getting-started/introduction/).
  
Laravel was chosen as its backend, due to it being robust and battle tested "in the real world" on top up that it has a huge community to back it, with tons of free (& paid) learning resources and its solid documentation that other projects' normally lack. Combine those things together and you'll be able to build anything you want even as a beginner, you dont need to be a PHP expert or a frontend master to work with Atom HK!

If you are new to Laravel, then theres luckily tons of resources online to help you learn it. One of the best options is those two video courses. 
- https://laracasts.com/series/laravel-8-from-scratch
- https://laracasts.com/series/whats-new-in-laravel-9

### Why was Atom HK made?
Atom HK was made to bring the retro community a solid base to build a housekeeping from. As previously mentioned Atom HK is a standalone housekeeping, allowing you to use it on any CMS with little to no edits.

### CMS Support
Atom HK can be used for any CMS you'd like, all you have to do is modifying to match your database structure. Out of the box Atom HK will support Atom CMS, which you can find here: [https://github.com/ObjectRetros/atomcms](https://github.com/ObjectRetros/atomcms)

### Setup guide
To install Atom HK you'll need the following:
- PHP 8.1 or above [PHP Downloads](https://www.php.net/downloads.php)
- Composer v2 [Composer Download](https://getcomposer.org/download/)
- NPM (LTS) [Node Download](https://nodejs.org/en/download/)
- An Arcturus Morningstar database [Database repository](https://git.krews.org/morningstar/arcturus-morningstar-base-database)

It's recommended to run the housekeeping through a subdomain or a total seperate domain, as you will not be able to run both the housekeeping and your CMS on the exact same domain.

After all of the above has been installed you've to do the following:
- Open CMD and navigate into the path you want the housekeeping to be located at, and run the commands listed below

#### Windows
```
[Https] git clone https://github.com/ObjectRetros/atomhk.git
[SSH - Recommended] git clone git@github.com:ObjectRetros/atomhk.git
cd atomhk
copy .env.example .env
composer install 
npm install && npm run dev (for production you run: npm run build)
php artisan key:generate
php artisan migrate --seed

If you are using the housekeeping in production, dont forget to set the:
- APP_ENV=local to APP_ENV=production
- APP_DEBUG=true to APP_DEBUG=false
```
For IIS - You must link your site to the public folder of the housekeeping, Also make sure the atomhk folder is granted "Full control" for both the IUSR & the IIS_IUSRS.

**For production**

#### Required extensions
Please verify the following extensions are enabled inside your php.ini file. If they have a ";" in front of them it means that they're commented out and not enabled. Simply remove the ";" to enable them.
```
- sockets
```

#### Linux
```
[Https] git clone https://github.com/ObjectRetros/atomhk.git
[SSH - Recommended] git clone git@github.com:ObjectRetros/atomhk.git
cd atomhk
cp .env.example .env
composer install
npm install && npm run dev (for production you run: npm run build)
php artisan key:generate
php artisan migrate --seed

If you are using the housekeeping in production, dont forget to set the:
- APP_ENV=local to APP_ENV=production
- APP_DEBUG=true to APP_DEBUG=false

Grant necessary permissions to used folders. Within your atomhk directory, enter the 4 commands below.

sudo chown -R $USER:www-data storage
sudo chown -R $USER:www-data bootstrap/cache
chmod -R 775 storage
chmod -R 775 bootstrap/cache
```

#### Required extensions

Please install the following extensions by running the command below:
```
sudo apt-get install -y php8.1-cli php8.1-common php8.1-mysql php8.1-zip php8.1-gd php8.1-mbstring php8.1-curl php8.1-xml php8.1-bcmath php8.1-sockets php8.1-gd php8.1-fileinfo
```

For NGINX you can copy the config from here: [Deploy a site on nginx](https://laravel.com/docs/9.x/deployment#nginx


#### Credits
- Object - Creating the housekeeping
- Kasja - Helping with design, ideas & GFX
- Bop for releasing Icon panel template (based of SB panel)
