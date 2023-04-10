<div align="center">
<a href="https://discord.gg/rX3aShUHdg" target="_blank">
    <img src="https://i.imgur.com/9ePNdJ4.png" alt="Atom HK"/><br>
    Join the official Atom CMS Discord server
</a>
</div>


**Disclaimer**

Atom HK is purely an educational project. I am not responsible for how or where Atom HK is being used.

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
Atom HK supports [Atom CMS](https://github.com/ObjectRetros/atomcms) out of the box, but since it's a standalone application, you can use it for any CMS you'd want. All that is required from you is to modify it a bit, so it matches your database structure.

### Installation
The following things is required to setup Atom HK
- PHP 8.1 or above [PHP Downloads](https://www.php.net/downloads.php)
- Composer v2 [Composer Download](https://getcomposer.org/download/)
- NPM (LTS) [Node Download](https://nodejs.org/en/download/)
- An Arcturus Morningstar database [Database repository](https://git.krews.org/morningstar/arcturus-morningstar-base-database)
- A free API key from (Tiny MCE)[https://www.tiny.cloud/auth/signup/]

*You must also run the housekeeping through a subdomain or a total seperate domain, as you will not be able to run both the housekeeping and your CMS on the exact same domain name.*

Once you've downloaded and setup the mentioned things above, it's time to do the following:<br>
Open you CMD (Command Prompt) and navigate into the path where you want the housekeeping to be located at, and run the commands listed below

#### Windows
```
[Https] git clone https://github.com/ObjectRetros/atomhk.git
[SSH - Recommended] git clone git@github.com:ObjectRetros/atomhk.git
cd atomhk
copy .env.example .env
composer install 
npm install && npm run build (for development you run: npm run dev)
php artisan key:generate (if you are using Atom CMS you should copy the APP_KEY from there)
php artisan migrate --seed

Don't forget to put your Tiny MCE API key inside the "housekeeping_settings" table

Create a new IIS site and link it to the public folder of the housekeeping.
```

#### Required permissions
Please make sure the atomhk folder is granted "Full control" for both the IUSR & the IIS_IUSRS.

Here's a GIF of me doing it on a different folder: [https://gyazo.com/7d5f38525a762c1b26bbd7552ca93478](https://gyazo.com/7d5f38525a762c1b26bbd7552ca93478) the principle is the same, you just do it on the "atomhk" folder.


#### Required extensions
Please verify the following extensions are enabled inside your php.ini file. If they have a ";" in front of them it means that they're commented out and not enabled. Simply remove the ";" to enable them.
```
extension=curl
extension=fileinfo
extension=gd
extension=mbstring
extension=openssl
extension=pdo_mysql
extension=sockets
```

#### Linux
```
[Https] git clone https://github.com/ObjectRetros/atomhk.git
[SSH - Recommended] git clone git@github.com:ObjectRetros/atomhk.git
cd atomhk
cp .env.example .env
composer install
npm install && npm run build (for development you run: npm run dev)
php artisan key:generate (if you are using Atom CMS you should copy the APP_KEY from there)
php artisan migrate --seed

Don't forget to put your Tiny MCE API key inside the "housekeeping_settings" table
```

#### Required permissions
Grant necessary permissions to used folders. Within your atomhk directory, enter the 4 commands below.
```
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

**Important!** If you are using the housekeeping in production, dont forget to change the following within your .env file:
```
APP_ENV=local to APP_ENV=production
APP_DEBUG=true to APP_DEBUG=false
```

#### Setup your own hotel from scatch:
Have you always wanted to setup your own hotel from scratch, but are unsure how? Then  you can follow my **three** parts series on DevBest which will take you through any step necessary to get everything up and running.

- Part 1: [https://devbest.com/threads/how-to-set-up-a-retro-in-2022-iis-nitro-html5-part-1.92532/](https://devbest.com/threads/how-to-set-up-a-retro-in-2022-iis-nitro-html5-part-1.92532/)
- Part 2: [https://devbest.com/threads/how-to-set-up-a-retro-in-2022-iis-nitro-html5-part-2.92533/](https://devbest.com/threads/how-to-set-up-a-retro-in-2022-iis-nitro-html5-part-2.92533/)
- Part 3: [https://devbest.com/threads/how-to-set-up-a-retro-in-2022-iis-nitro-html5-part-3.92543/](https://devbest.com/threads/how-to-set-up-a-retro-in-2022-iis-nitro-html5-part-3.92543/)

#### Credits
- Object - Creating the housekeeping
- Kasja - Helping with design, ideas & GFX
- Bop for releasing Icon panel template
